<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinhomodel extends CI_Model {
    
    public function insert($new){
        $this->db->insert('historicocompras', $new);
        return $this->db->insert_id();
    }
    
    public function tempcart($ipaddress){
	    $this->db->where("ipHostRemote", $ipaddress);
        $aux = $this->db->get("tempcart")->row_array();
        if($aux != null || $aux != "" ){
            return $aux;
        }else{
            $this->db->order_by("idTempCart", "asc");
            $this->db->limit(1);
            $aux = $this->db->get("tempcart")->row_array();
            $id = rand(100, 100000);
            $dados = array(
                'idTempCart'        => $id,
                'ipHostRemote'      => $ipaddress,
                'dataHoraCompra'    => date('Y-m-d H:i:s'),
                'listProdutosId'    => "",  
                'qtdProdutos'       => "",  
                'statusCompra'      => "",
            );
            $this->db->insert('tempcart', $dados);
            return $dados;
        }
    }
    
    // #4 Função Gui - Retornar o status de compra, a partir de um id.
    public function getStatus($id){
        $this->db->select('nomeStatusCompra');
        $this->db->where('idStatusCompra', $id);
        $data = $this->db->get('statuscompras');
        return $data->row_array();
    }
    // #4 Final
    
    public function cartshopping($ipaddress){
        $this->db->where("ipHostRemote", $ipaddress);
        $aux = $this->db->get("cartshopping")->row_array();
        if($aux != null || $aux != "" ){
            return $aux;
        }else{
            $this->db->order_by("idTempCart", "asc");
            $this->db->limit(1);
            $aux = $this->db->get("cartshopping")->row_array();
            $id = rand(100, 100000);
            $dados = array(
                'idTempCart'        => $id,
                'ipHostRemote'      => $ipaddress,
                'dataHoraCompra'    => date('Y-m-d H:i:s'),
                'listProdutosId'   => "",  
                'qtdProdutos'       => "",  
                'statusCompra'      => "",
            );
            $this->db->insert('cartshopping', $dados);
            return $dados;
        }
    }
    
    public function updateTempcart($carrinho){
        $this->db->replace('tempcart', $carrinho);
    }
    
    public function updateCartShopping($carrinho){
        $this->db->replace('cartshopping', $carrinho);
    }
    
    public function rescueProduct($id){
        $this->db->select('produto_id, produto_valor, produto_quantidade, produto_nome, produto_modelo, produto_preco_promocao, produto_preco_promocao_ativo,produto_desconto, produto_desconto_ativo, produto_cupom_ativo, produto_cupom, produto_datainicial_promocao, produto_datafinal_promocao, produto_datafinal_promocao_ativo, produto_tamanhos, produto_cores');
        $this->db->where('produto_id', $id);
        $produto = $this->db->get('produtos')->row_array();
        $produto['produto_valor'] = $this->produtoPromocao($produto);    
        
        
        return $produto;
    }
    
    
    public function produtoPromocao($produto){
        $valor          = null;
        
        $this->db->where('promocao_datainicial  <=', date('Y-m-d'));
        $itens = $this->db->get('promocoes')->result_array();
        
        $promocoes  = [];
        $cont       = 0;
        
        foreach($itens as $i){
            if($i['promocao_datafinal_ativo'] == 1){
                if($i['promocao_datafinal'] >= date('Y-m-d')){
                    $promocoes[$cont] = array(
                        'promocao_preco'            => $i['promocao_preco'],
                        'promocao_preco_ativo'      => $i['promocao_preco_ativo'],
                        'promocao_desconto'         => $i['promocao_desconto'],
                        'promocao_desconto_ativo'   => $i['promocao_desconto_ativo'],
                        'promocao_cupom'            => $i['promocao_cupom'],
                        'promocao_cupom_ativo'      => $i['promocao_cupom_ativo'],
                        'promocao_produtos'         => $i['promocao_produtos'],
                        'promocao_datainicial'      => $i['promocao_datainicial'],
                        'promocao_datafinal'        => $i['promocao_datafinal'],
                        'promocao_datafinal_ativo'  => $i['promocao_datafinal_ativo'],
                    );
                }
            } else {
                $promocoes[$cont] = array(
                    'promocao_preco'            => $i['promocao_preco'],
                    'promocao_preco_ativo'      => $i['promocao_preco_ativo'],
                    'promocao_desconto'         => $i['promocao_desconto'],
                    'promocao_desconto_ativo'   => $i['promocao_desconto_ativo'],
                    'promocao_cupom'            => $i['promocao_cupom'],
                    'promocao_cupom_ativo'      => $i['promocao_cupom_ativo'],
                    'promocao_produtos'         => $i['promocao_produtos'],
                    'promocao_datainicial'      => $i['promocao_datainicial'],
                    'promocao_datafinal'        => $i['promocao_datafinal'],
                    'promocao_datafinal_ativo'  => $i['promocao_datafinal_ativo'],
                );
            }
            $cont++;
        }
        
        foreach($promocoes as $promo){
            $aux_produtos = explode('¬', $promo['promocao_produtos']);
            foreach($aux_produtos as $a){
                if($a == $produto['produto_id']){
                    
                    if($promo['promocao_cupom_ativo'] == 0){
            		    if($promo['promocao_preco_ativo'] == 1){
            		        $valor = $promo['promocao_preco'];
            		    } else if($promo['promocao_desconto_ativo'] == 1){
            		        $valor = $produto['produto_valor'] - (($promo['promocao_desconto']/100) * $produto['produto_valor']);
            		    }
            		}
                }
            }
        }
        
        if($valor == null){ 
            $boolean = true;
            if($produto['produto_datainicial_promocao'] > date('Y-m-d')){
                $boolean = false;
            }
            if($produto['produto_datafinal_promocao_ativo'] == 1){
                if($produto['produto_datafinal_promocao'] < date('Y-m-d')){
                    $boolean = false;
                }
            }
            if($boolean == true){
                if($produto['produto_cupom_ativo'] == 0){
        		    if($produto['produto_preco_promocao_ativo'] == 1){
        		        $valor = $produto['produto_preco_promocao'];
        		    } else if($produto['produto_desconto_ativo'] == 1){
        		        $desconto = $produto['produto_desconto'];
        		        $valor = $produto['produto_valor'] - (($produto['produto_desconto']/100) * $produto['produto_valor']);
        		    }
        		}
            }
        }
        
        if($valor == null){ 
            $valor = $produto['produto_valor'];   
        }

		
		return $valor;
    }
    
    
    public function cartunico($produto, $quantidade, $id, $cor, $tamanho){
        
        $aux = $this->getProdutoSite($produto);
        $valor = $this->getValorSite($aux['produto_id']);
        $opcao = "padrão";
            
        if($cor){
            $opcao = 'cor&' . $cor;
        }
        if($tamanho){
            $opcao = 'tamanho&' . $tamanho;
        }
        
        if($id != 0){
            $this->db->where('idTemp', $id);
            $cart = $this->db->get('cartunico')->row_array();
            if (strpos($cart['listProdutosId'], $produto) !== false) {
                $qtd = "";
                $t = "";
                $a = explode("¬", $cart['listProdutosId']);
                $b = explode("¬", $cart['qtdProdutos']);
                for($i=0; $i <count($a); $i++){
                    if($produto == $a[$i]){
                        $b[$i] = $b[$i]+ $quantidade;
                    }
                    $qtd .= $b[$i];
                    
                    if($i+1 <count($a)){
                        $qtd.= "¬";
                    }
                }
                
                $guiteste = (float)$cart['valorTotal'] + ((int)$quantidade * (float)$valor);
                
                $produto            = $cart['listProdutosId'];
                $quantidade         = $qtd;
                $precosCompra       = $cart['vlrProdutos'];
                $opcoes             = $cart['opProdutos'];
                $valorTotal         = $guiteste;
                $pesoTotal          = (float)$cart['pesoTotal'] + ((int)$quantidade * (float)$aux['produto_peso']);
                $alturaTotal        = (float)$cart['alturaTotal'] + ((int)$quantidade * (float)$aux['produto_altura']);
                $comprimentoTotal   = (float)$cart['comprimentoTotal'] + ((int)$quantidade * (float)$aux['produto_comprimento']);
                $larguraTotal       = (float)$cart['larguraTotal'] + ((int)$quantidade * (float)$aux['produto_largura']);
                
            }else{
                $guiteste = (float)$cart['valorTotal'] + ((int)$quantidade * (float)$valor);
                
                $produto            = $cart['listProdutosId']."¬".$produto;
                $quantidade         = $cart['qtdProdutos']."¬".$quantidade;
                $precosCompra       = $cart['vlrProdutos']."¬".$valor;
                $opcoes             = $cart['opProdutos'] . "¬" . $opcao;
                $valorTotal         = $guiteste;
                $pesoTotal          = (float)$cart['pesoTotal'] + ((int)$quantidade * (float)$aux['produto_peso']);
                $alturaTotal        = (float)$cart['alturaTotal'] + ((int)$quantidade * (float)$aux['produto_altura']);
                $comprimentoTotal   = (float)$cart['comprimentoTotal'] + ((int)$quantidade * (float)$aux['produto_comprimento']);
                $larguraTotal       = (float)$cart['larguraTotal'] + ((int)$quantidade * (float)$aux['produto_largura']);
                
            }

            $dados = array(
                'idTemp'            => $id,
                'listProdutosId'    => $produto,
                'qtdProdutos'       => $quantidade,
                'vlrProdutos'       => $precosCompra,
                'opProdutos'        => $opcoes,
                'valorTotal'        => $valorTotal,
                'pesoTotal'         => $pesoTotal,
                'alturaTotal'       => $alturaTotal,
                'comprimentoTotal'  => $comprimentoTotal,
                'larguraTotal'      => $larguraTotal,
                'desconto'          => null,
            );
            
            $this->db->replace('cartunico', $dados);
        }else{
            
            $id = rand(11111111111, 99999999999);
            
            $dados = array(
                'idTemp'            => $id,
                'listProdutosId'    => $produto,
                'qtdProdutos'       => $quantidade,
                'vlrProdutos'       => $valor,
                'opProdutos'        => $opcao,
                'valorTotal'        => $quantidade * $valor,
                'pesoTotal'         => $quantidade * $aux['produto_peso'],
                'alturaTotal'       => $quantidade * $aux['produto_altura'],
                'comprimentoTotal'  => $quantidade * $aux['produto_comprimento'],
                'larguraTotal'      => $quantidade * $aux['produto_largura'],
                'desconto'          => null,
            );
            
            $this->db->insert('cartunico', $dados);
            $this->session->set_userdata('carrinho', $id);
        }
    }
    
        
    public function getProdutoSite($id){
        $this->db->select("produto_id, produto_nome, produto_modelo, produto_detalhes, produto_imagens_opcional1, produto_imagens_opcional2, produto_imagens_opcional3, produto_imagens_opcional4, produto_imagens_opcional5, produto_tamanhos, produto_cores, produto_variacoes, produto_especifico, produto_idloja, produto_habilitado, produto_departamentos");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['tamanhos'] = explode("¬", $a['produto_tamanhos']);
        $a['cores'] = explode("¬", $a['produto_cores']);
        unset($a['produto_tamanhos']);
        unset($a['produto_cores']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        return $a;
    }
    
    public function getEstoqueSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();

        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto");
        $this->db->where('estoque_loja =', 25);
        $this->db->where('estoque_produto =', $a['produto_nome']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        //$estoques['estoque_quantidade'] = 80;
        
        return $estoques['estoque_quantidade'];
    }
    
    public function getValorSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $this->db->select("estoque_valor");
        $this->db->where('estoque_loja =', 25);
        $this->db->where('estoque_produto =', $a['produto_nome']);
        $this->db->order_by("estoque_id", 'DESC');
        $this->db->limit(1);
        $estoques = $this->db->get('estoque')->row_array();
        
        //$estoques['estoque_valor'] = 80;
        
        return $estoques['estoque_valor'];
    }
    
    public function getTamanhosSite($id){
        $this->db->select("produto_tamanhos");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['tamanhos'] = explode("¬", $a['produto_tamanhos']);
        unset($a['produto_tamanhos']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        /*$a = array(
            '0' => "Pequeno",
            '1' => "Medio",
            '2' => "Grande",
            );*/
        
        return $a;
    }
    
    public function getCoresSite($id){
        $this->db->select("produto_tamanhos");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['cores'] = explode("¬", $a['produto_cores']);
        unset($a['produto_cores']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        /*$a = array(
            '0' => "Vermelho",
            '1' => "Azul",
            '2' => "Preto",
            );*/
        
        return $a;
    }
    
    public function getRelacionadoSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $rells = explode(" ", $a['produto_nome']);
        $relacionados = array();
        for($i=0; $i<count($rells); $i++){
            $this->db->select("produto_id, produto_nome");
            $this->db->like('produto_nome', $rells[$i]);
            $helper = $this->db->get('produtos')->result_array();
            $relacionados = array_merge($relacionados, $helper);
        }
        $relacionados = array_map("unserialize", array_unique(array_map("serialize", $relacionados)));
        return $relacionados;
    }
    
    public function getPromocaoSite($id, $valor){
        $this->db->select("produto_preco_promocao, produto_preco_promocao_ativo, produto_desconto, produto_desconto_ativo, produto_datainicial_promocao, produto_datafinal_promocao, produto_datafinal_promocao_ativo");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        if($a['produto_preco_promocao_ativo'] == 1){
            $newPrice = $a['produto_preco_promocao'];
            $desconto = 100 - ($newPrice*100)/$valor;
        }elseif($a['produto_desconto_ativo'] == 1){
            $newPrice = ($valor * (1-($a['produto_desconto']/100)));
            $desconto = $a['produto_desconto'];
        }elseif($a['produto_datafinal_promocao_ativo'] == 1){
            $hoje = date('Y-m-d');
            if($a['produto_datainicial_promocao'] <=  $hoje){
                if($a['produto_datafinal_promocao'] >=  $hoje){
                    $newPrice = ($valor * (1-($a['produto_desconto']/100)));
                    $desconto = $a['produto_desconto'];
                }else{
                    $newPrice = $valor;
                    $desconto = 0;
                }
            }else{
                $newPrice = $valor;
                $desconto = 0;
            }
        }else{
            $newPrice = $valor;
            $desconto = 0;
        }
        
        $promocao = array(
            'precoNovo'     => $newPrice,
            'porcentagem'   => $desconto,
            'valorOriginal' => $valor,
        );
        return $promocao;
    }
    
    public function getDepartamentoLista($lista){
        $lista = explode("¬", $lista);
        for($i=0; $i<count($lista); $i++){
            $this->db->select("departamento_nome");
            $this->db->where("departamento_id", $lista[$i]);
            $a[$i] = $this->db->get('departamentos')->row_array();
        }
        $a = implode(" - ", $a);
        return $a;
    }
    
    
    // Criado por gui -  Função para contar a quantidade de produtos no carrinho
    public function contcarrinho($id){
        $this->db->where('idTemp', $id);
        $this->db->select('qtdProdutos');
        $a =  $this->db->get('cartunico')->row_array();
        
        if($a){
            $aux = explode('¬', $a['qtdProdutos']);    
            $resultado = array_sum($aux);
        } else {
            $resultado = 0;
        }
        
        return $resultado;
    }
    //
    
    public function carrinho($id){
        $this->db->select('listProdutosId, qtdProdutos, vlrProdutos, valorTotal, desconto, opProdutos');
        $this->db->where('idTemp', $id);
        $a =  $this->db->get('cartunico')->row_array();
        return $a;
    }
    
    public function updateCartUnico($carrinho){
        $this->db->replace('cartunico', $carrinho);
    }
    
    public function rescueProduct2($id){
        $this->db->select('produto_id, produto_valor, produto_largura, produto_altura, produto_comprimento, produto_peso, produto_preco_promocao, produto_preco_promocao_ativo,produto_desconto, produto_desconto_ativo, produto_cupom_ativo, produto_cupom, produto_datainicial_promocao, produto_datafinal_promocao, produto_datafinal_promocao_ativo');
        $this->db->where('produto_id', $id);
        $produto = $this->db->get('produtos')->row_array();
        $produto['produto_valor'] = $this->produtoPromocao($produto);    
        
        
        
        return $produto;
    }
    
    public function clearCartUnico($id){
        $this->session->unset_userdata('carrinho');
        $this->session->unset_userdata('carrinho');
        $this->db->where('idTemp', $id);
        return $this->db->get('cartunico')->row_array();
    }
    
    public function updateCompra($dados){
        $this->db->replace('historicocompras', $dados);
    }
    
    public function historico($dados){
        // #1 Função criado por gui : Diminuir a quantidade de produtos no estoque do produto;
        $aux_produtos   = explode('¬', $dados['listProdutosId']);
        $aux_quantidade = explode('¬', $dados['qtdProdutos']);
        $aux_op         = explode('¬', $dados['opProdutos']);
        
        $cont = 0;
        
        
        foreach($aux_produtos as $a){
            $finalT   = "";
            $finalC   = "";
            
            $this->db->where('produto_id', $a);
            $produto = $this->db->get('produtos')->row_array();
            
            if($produto['produto_reduzir'] == 1){
                if($aux_op[$cont] != 'padrão'){ 
                    $aux_estoque = explode('&', $aux_op[$cont]);
                    if($aux_estoque[0] == 'tamanho'){
                        $aux_produto = explode('¬', $produto['produto_tamanhos']);
                        foreach($aux_produto as $t){
                            $auxproduto = explode('&', $t);
                            if($auxproduto[0] == $aux_estoque[1]){
                                $calc    = intval($auxproduto[1]) - intval($aux_quantidade[$cont]);
                                if($finalT == ""){
                                    $finalT = $aux_estoque[1] . '&' . $calc;
                                } else {
                                    $finalT .= '¬' . $aux_estoque[1] . '&' . $calc;
                                }
                            } else {
                                if($finalT == ""){
                                    $finalT = $t;
                                } else {
                                    $finalT .= '¬' . $t; 
                                }
                            }
                        }
                    } else {
                        $aux_produto = explode('¬', $produto['produto_cores']);
                        foreach($aux_produto as $t){
                            $auxproduto = explode('&', $t);
                            if($auxproduto[0] == $aux_estoque[1]){
                                $calc    = intval($auxproduto[1]) - intval($aux_quantidade[$cont]);
                                if($finalC == ""){
                                    $finalC = $aux_estoque[1] . '&' . $calc;
                                } else {
                                    $finalC .= '¬' . $aux_estoque[1] . '&' . $calc;
                                }
                            } else {
                                if($finalC == ""){
                                    $finalC = $t;
                                } else {
                                    $finalC .= '¬' . $t; 
                                }
                            }
                        }
                    }
                    
                }
                
                
                $produto_reducao = array(
                    'produto_quantidade' => $produto['produto_quantidade'] - $aux_quantidade[$cont],
                    'produto_tamanhos'   => $finalT,
                    'produto_cores'      => $finalC,
                );
                $this->db->where('produto_id', $a);
                $this->db->update('produtos', $produto_reducao);
            }
            $cont++;
            
            
        }
        
        // #1 Final função por gui
        
        // #2 Função criado por gui : Inserir histórico padrão inicial no pedido, na tabela historico_pedido,
        $historico = array(
            'historico_pedido_id'   => $dados['id_pedido'],
            'historico_data'        => date('Y-m-d'),
            'historico_hora'        => date('H:i'),
            'historico_comentario'  => 'Pedido realizado com sucesso, aguardando pagamento.',
            'historico_status'      => 0,
            'historico_notificar'   => 1,
        );
        
        $this->db->insert('historico_pedido', $historico);
        // #2 Final função por gui
    }
    
    public function compra($dados, $id){
        date_default_timezone_set('America/Sao_Paulo');
        
        $this->db->insert('historicocompras', $dados);
        $id_pedido = $this->db->insert_id();
        
        $this->session->unset_userdata('carrinho');
        $this->session->set_userdata('finalcompra', $id_pedido);
        
        $content = array(
            'listProdutosId'    => $dados['listProdutosId'],
            'qtdProdutos'       => $dados['qtdProdutos'],
            'id_pedido'         => $id_pedido,
            'opProdutos'        => $dados['opProdutos'],
        );
        
        $this->historico($content);
        
        $this->db->where('idTemp', $id);
        $this->db->delete('cartunico');
        
        return $id_pedido;
    }
    
    public function deletePedido($id){
        $this->db->where('idcompra', $id);
        $this->db->delete('historicocompras');
    }
    
    public function getByCep($cep){
        $this->db->where('cep', $cep);
        $data = $this->db->get('cep'); 
        return $data->row_array();
    }
    
    public function rescueCompra($id){
        $this->db->select('listProdutosId, qtdProdutos, valorCompra as valorTotal, cepCompra, formaEnvio, formaPagamento, desconto, opProdutos');
        $this->db->where('idcompra', $id);
        $a =  $this->db->get('historicocompras')->row_array();
        return $a;
    }
    
    public function retriveCompra($id){
        
        $this->db->where('idcompra', $id);
        $a = $this->db->get('historicocompras')->row_array();
        
        $this->db->where('cliente_id', $a['idClient']);
        $cliente = $this->db->get('cliente')->row_array();
        if (strpos($a['listProdutosId'], "¬") !== false){
            $produtos = explode("¬", $a['listProdutosId']);
            $quantidade = explode("¬", $a['qtdProdutos']);
        }else{
            $produtos = $a['listProdutosId'];
            $quantidade = $a['qtdProdutos'];
        }
        
        if(is_array($produtos)){
            $count = count($produtos);
        }else{
            $count = 1;
        }
        
        for($i=0; $i<$count; $i++){
            
            $this->db->where('produto_id', $produtos[$i]);
            $valor = $this->db->get('produtos')->row_array();
            $compra[$i] = array(
                'produto'       => $valor['produto_nome'],
                'valor'         => $valor['produto_valor'],
                'quantidade'    => $quantidade[$i],
                );
        }
        $frete = array(
                'produto'       => 'Frete '.$a['formaEnvio'],
                'valor'         => $a['valorFrete'],
                'quantidade'    => 1,
                );
        
        
        $dados = array(
            'senderName'    => $cliente['cliente_nome'],
            'senderCPF'     => $cliente['cliente_cpf'],
            //'senderEmail'   => $cliente['cliente_email'],
            'senderEmail'   => 'email@sandbox.pagseguro.com.br',
            'compra'        => $compra,
            'frete'         => $frete,
            'valorTotal'    => (float)$a['valorFrete'] + (float)$a['valorCompra']
            );
        
        return $dados;
    }
    
    public function getPedido($id){
        $this->db->where('idcompra', $id);
        return $this->db->get('historicocompras')->row_array();
    }
    
    public function cardHolder($id){
        $this->db->select('cliente_nome, cliente_cpf, cliente_nascimento');
        $this->db->where('cliente_id', $id);
        $data = $this->db->get('cliente'); 
        return $data->row_array();
    }
    
    public function getCompra($id){
        $this->db->where('idcompra', $id);
        $a = $this->db->get('historicocompras')->row_array();

        if($a['formaPagamento'] == 'cartao'){
            $forma = 'credit_card';
        }elseif($a['formaPagamento'] == 'boleto'){
            $forma = 'boleto';
        }elseif($a['formaPagamento'] == 'pix'){
            $forma = 'pix';
        }
        $this->db->select('cliente_nome,  cliente_telefone, cliente_cpf, cliente_email, cliente_nascimento, cliente_estado, cliente_endereco, cliente_numero, cliente_complemento, cliente_cidade, cliente_bairro');
        $this->db->where('cliente_id', $a['idClient']);
        $b = $this->db->get('cliente')->row_array();

        if($b['cliente_complemento'] == '' || $b['cliente_complemento'] == null ){
            $complemento = 'sem';
        }else{
            $complemento = $b['cliente_complemento'];
        }
        
        
        //$compra['reference_key'] = md5($a['idcompra']);                       // 
        $compra['amount'] = (($a['valorCompra']+$a['valorFrete'])-$a['desconto'])*100;             // Valor da transação (em centavos) a ser transacionado pelo Checkout. Mínimo 100 (1 real)
        $compra['postback_url'] = base_url('pagamentoSTN/retornoPGM');          // 
        $compra['createToken'] = 'true';                                        // Habilita a geração do token para autorização da transação. Caso você deseje apenas utilizar o checkout como formulário, deixe esse atributo com o valor false, e realize a transação normalmente no seu backend.
        $compra['paymentMethods'] = $forma;                                     // Meios de pagamento disponíveis no Checkout. credit_card, boleto, pix
        $compra['customerData'] = 'false';                                      // Caso não deseje capturar dados do cliente pelo Checkout, setar como false. Senão, true.
        $compra['customer.external_id'] = $a['idClient'];                       // Id do cliente na loja

        $compra['customer.name'] = $b['cliente_nome'];                          // Nome
        $compra['customer.type'] = 'individual';                                // Tipo de cliente (individual ou corporation)
        $compra['customer.country'] = 'br';                                     // País de origem do cliente
        $compra['customer.email'] = $b['cliente_email'];                        // Email do cliente
        $compra['customer.documents.type'] = 'cpf';                             // Tipo do documento (CPF ou CNPJ)
        $compra['customer.documents.number'] = $b['cliente_cpf'];               // Número do documento (CPF ou CNPJ)
        $compra['customer.phone_numbers'] = "['+55".$b['cliente_telefone']."']";// Lista de telefones do cliente. Array "['+5511888889999', '+5511888889999']"
        $compra['customer.birthday'] = $b['cliente_nascimento'];                // Data de nascimento do cliente

        //shipping //Informações de entrega (obrigatório quando há bens físicos entre os itens vendidos)
        $envio['shipping.name'] = $b['cliente_nome'];                           // Nome do comprador
        $envio['shipping.fee'] = $a['valorFrete']*100;                              // Taxa de envio cobrada do comprador. Por exemplo, se a taxa de envio é de dez reais e três centavos (R$37,29), o valor deve ser fornecido como ‘3729’
        //$envio['shipping.delivery_date'] = strtotime(date("Y-m-d", strtotime($date)) . " +15 day");     // Não consta na documentação  //delivery_date: '<?php echo $envio['shipping.delivery_date'];
        $envio['shipping.expedited'] = 'false';                                 // Não consta na documentação
        //shipping.address // Dados de endereço de cobrança
        $envio['shipping.address.country'] = 'br';                              // País. Deve seguir o padão ISO 3166-1 alpha-2
        $envio['shipping.address.state'] = $b['cliente_estado'];                // Estado
        $envio['shipping.address.city'] = $b['cliente_cidade'];                 // Cidade
        $envio['shipping.address.neighborhood'] = $b['cliente_bairro'];         // Bairro
        $envio['shipping.address.street'] = $b['cliente_endereco'];             // Rua
        $envio['shipping.address.street_number'] = $b['cliente_numero'];        // Número
        $envio['shipping.address.zipcode'] = $a['cepCompra'];                   // CEP DE ENTREGA
        $envio['shipping.address.complementary'] = $complemento;                // Dados complementares, não pode ser vazio e nem nulo
        
        
        if (strpos($a['listProdutosId'], "¬") !== false){
            $produtos = explode("¬", $a['listProdutosId']);
            $quantidade = explode("¬", $a['qtdProdutos']);
            $flag = 2;
        }else{
            $produtos = $a['listProdutosId'];
            $quantidade = $a['qtdProdutos'];
            $flag = 1;
        }
        
        /*
        if($flag == 2){
            for($i=0; $i<count($produtos); $i++ ){
                $this->db->select('produto_nome, produto_valor');
                $this->db->where('produto_id', $produtos[$i]);
                $c = $this->db->get('produtos')->row_array();
                $produto[$i]['item.id'] = $i;                                           // Número de identificação na loja
                $produto[$i]['item.title'] = $c['produto_nome'];                        // Nome do item vendido
                $produto[$i]['item.unit_price'] = $c['produto_valor'];                   // Valor unitário em centavos
                $produto[$i]['item.quantity'] = $quantidade[$i];                        // Número de unidades vendidas
                $produto[$i]['item.tangible'] = 'true';
            }
        }else{
                $this->db->select('produto_nome, produto_valor');
                $this->db->where('produto_id', $produtos);
                $c = $this->db->get('produtos')->row_array();
                
                $produto['item.id'] = 1;                                        // Número de identificação na loja
                $produto['item.title'] = $c['produto_nome'];                    // Nome do item vendido
                $produto['item.unit_price'] = $c['produto_valor'];              // Valor unitário em centavos
                $produto['item.quantity'] = $quantidade;                        // Número de unidades vendidas
                $produto['item.tangible'] = 'true';
        }
        */
        $produto['item.id'] = 1;                                        // Número de identificação na loja
        $produto['item.title'] = 'Teste';                    // Nome do item vendido
        $produto['item.unit_price'] = 5000;              // Valor unitário em centavos
        $produto['item.quantity'] = 1;                        // Número de unidades vendidas
        $produto['item.tangible'] = 'true';
                
        $data = array(
            'compra'    => $compra,
            'envio'     => $envio,
            'produto'   => $produto,
            );
        
        return $data;
    }
    
    public function getCarrinho($id){
        $this->db->where('idTemp', $id);
        return $this->db->get('cartunico')->row_array();
    }
    
    public function getCarrinhoMininum($id){
        $this->db->select('idTemp, listProdutosId, qtdProdutos');
        $this->db->where('idTemp', $id);
        return $this->db->get('cartunico')->row_array();
    }
    
    public function getDesconto($id){
        $this->db->select('desconto');
        $this->db->where('idTemp', $id);
        return $this->db->get('cartunico')->row_array();
    }
}