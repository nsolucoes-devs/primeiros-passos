<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprasmodel extends CI_Model {
    
    public function testeGuiExcluir(){
        return $this->db->get('historicocompras')->result_array();
    }
    
    public function updateHistoricoGui($id, $new){
        $this->db->where('idcompra', $id);
        $this->db->update('historicocompras', $new);
    }
    
    public function getPedido($id){
        $this->db->where('idcompra', $id);
        return $this->db->get('historicocompras')->row_array();
    }
    
    public function pedidos(){
            
        $result = $this->db->get('historicocompras')->result_array();
        $i=0;
        foreach($result as $aux){
            
            $this->db->where('cliente_id', $aux['idClient']);
            $this->db->select('cliente_nome');
            $nome = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusCompra']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome['cliente_nome'],
                'total'         => $aux['valorCompra'],
                'cadastro'      => $aux['dataCompra'],
                'modificacao'   => $aux['dataAlteracao'],
                'status'        => $sts['nomeStatusCompra'],
                'desconto'      => $aux['desconto'],
                'forma'         => $aux['formaPagamento'],
                'boletoCDBar'   => $aux['boleto_barcode'],
                'boletoURL'     => $aux['boleto_url'],
                'vencimento'    => $aux['boleto_expiration_date'],
            );
            $i++;
        }
        
        return $pedidos;
    }
    
    public function insertHistorico($historico){
        $this->db->insert('historico_pedido', $historico);
    }
    
    public function updatePedido($id, $pedido){
        $this->db->where('idcompra', $id);
        $this->db->update('historicocompras', $pedido);
    }
    
    public function deleteHistorico($id){
        $this->db->where('historico_id', $id);
        $this->db->delete('historico_pedido');
    }
    
    public function excluirPedido($id){
	    $this->db->where('idcompra', $id);
	    $dados = $this->db->get('historicocompras')->row_array();

	    $dados['formaPagamento']    = "Venda Desfeita";
	    $dados['statusCompra']      = "7";
	    $dados['statusEnvio']       = "26";
	    $dados['statusPagamento']   = "27";
	    $dados['dataAlteracao']     = date('Y-m-d H:i:s');
	    
	    $this->db->replace('historicocompras', $dados);
	    
	}
    
    public function relatorioPedidos(){
            
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $pedidos        = [];
        
        foreach($result as $aux){
            $this->db->select('cliente_nome, cliente_cpf');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            $total_geral = $total_geral + ($aux['valorCompra'] + $aux['valorFrete'] - $aux['desconto']);
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
                $cpf_cliente        = $cliente['cliente_cpf'];
            } else {
                $nome_cliente       = 'Cliente excluído';
                $cpf_cliente        = 'Cliente excluído';
            }
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome_cliente,
                'cpf'           => $cpf_cliente,
                'total'         => $aux['valorCompra'] + $aux['valorFrete'] - $aux['desconto'],
                'cadastro'      => $aux['dataCompra'],
                'status'        => $sts['nomeStatusCompra'],
                'forma'         => $aux['formaPagamento'],
                'e_endereco'    => $this->validarEndereco($aux_endereco, 0),
                'e_numero'      => $aux['numeroEndereco'],
                'e_complemento' => $this->validarEndereco($aux_endereco, 1),
                'e_bairro'      => $this->validarEndereco($aux_endereco, 2),
                'e_cidade'      => $this->validarEndereco($aux_endereco, 3),
                'e_estado'      => $this->validarEndereco($aux_endereco, 4),
                'e_cep'         => $aux['cepCompra'],
                'desconto'      => $aux['desconto'],
            );
            $i++;
        }
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
    
    public function relatorioGerente($filtros){
        
        if($filtros['id_funcionario'] != null){
             $this->db->where('id_funcionario', $filtros['id_funcionario']);
            $funcionario = $this->db->get('funcionarios')->row_array();
        } else {
            $funcionario = null;
        }
        
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($funcionario['loja_id']){
            $this->db->where('loja_id', $funcionario['loja_id']);
        }
        $this->db->where('statusPagamento', 17);
        $this->db->select('idcompra, dataCompra, desconto, valorCompra, datacompra, statusPagamento, loja_id');
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $total_comissao = 0;
        $pedidos        = [];
        
        $this->db->select('nome');
        $this->db->where('id', $funcionario['loja_id']);
        $loja = $this->db->get('loja')->row_array();
        
        $this->db->select('perfil');
        $this->db->where('usuario_funcionario_id', $funcionario['id_funcionario']);
        $usuario = $this->db->get('usuarios')->row_array();
        
        $this->db->select('perfilusuario_nome');
        $this->db->where('perfilusuario_id', $usuario['perfil']);
        $perfil = $this->db->get('perfilusuario')->row_array();
        
        foreach($result as $aux){
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            
            $total_geral    = $total_geral + ($aux['valorCompra'] - $aux['desconto']);
            $total_comissao = $total_comissao +  (($aux['valorCompra'] * $funcionario['comissao_funcionario']) / 100);
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'total'         => 'R$ '. number_format(($aux['valorCompra'] - $aux['desconto']), 2, ',','.'),
                'datacompra'    => date('d/m/Y H:i', strtotime($aux['dataCompra'])),
                'comissaov'         => 'R$ '. number_format(($aux['valorCompra'] * $funcionario['comissao_funcionario']) / 100, 2, ',','.'),
                'status'        => $sts['nomeStatusCompra'],
            );
            $i++;
        }
        
        $data['pedidos']            = $pedidos;
        $data['vendedor']           = $funcionario['nome_funcionario'];
        $data['loja']               = $loja['nome'];
        $data['perfil']             = $perfil['perfilusuario_nome'];
        $data['total_geral']        = 'R$ '. number_format($total_geral, 2, ',','.');
        $data['total_comissao']     = 'R$ '. number_format($total_comissao, 2, ',','.');
        $data['perc_comissao']      = $funcionario['comissao_funcionario']. ' %';
        
        if($filtros['datainicio']){
            $data['datainicio']    = date('d/m/Y H:i', strtotime($filtros['datainicio']));
        }
        if($filtros['datafim']){
            $data['datafim']        = date('d/m/Y H:i', strtotime($filtros['datafim']));
        }
        
        return $data;
    }
    
    public function relatorioFuncionario($filtros){
        
        $this->db->where('id_funcionario', $filtros['id_usuario']);
        $funcionario = $this->db->get('funcionarios')->row_array();
        
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($filtros['id_usuario']){
            $this->db->where('vendedor_id', $filtros['id_usuario']);
        }
        if($funcionario['loja_id']){
            $this->db->where('loja_id', $funcionario['loja_id']);
        }
        $this->db->where('statusPagamento', 17);
        
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $total_comissao = 0;
        $pedidos        = [];
        
        
        $this->db->select('perfil');
        $this->db->where('usuario_funcionario_id', $funcionario['id_funcionario']);
        $usuario = $this->db->get('usuarios')->row_array();
        
        $this->db->select('perfilusuario_nome');
        $this->db->where('perfilusuario_id', $usuario['perfil']);
        $perfil = $this->db->get('perfilusuario')->row_array();
        
        $this->db->select('nome');
        $this->db->where('id', $funcionario['loja_id']);
        $loja = $this->db->get('loja')->row_array();
        
        foreach($result as $aux){
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            
            $total_geral    = $total_geral + ($aux['valorCompra'] - $aux['desconto']);
            $total_comissao = $total_comissao +  (($aux['valorCompra'] * $funcionario['comissao_funcionario']) / 100);
            
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'total'         => 'R$ '. number_format(($aux['valorCompra'] - $aux['desconto']), 2, ',','.'),
                'datacompra'    => date('d/m/Y H:i', strtotime($aux['dataCompra'])),
                'comissaov'         => 'R$ '. number_format(($aux['valorCompra'] * $funcionario['comissao_funcionario']) / 100, 2, ',','.'),
                'status'        => $sts['nomeStatusCompra'],
            );
            $i++;
        }
        
        $data['pedidos']            = $pedidos;
        $data['vendedor']           = $funcionario['nome_funcionario'];
        $data['total_geral']        = 'R$ '. number_format($total_geral, 2, ',','.');
        $data['total_comissao']     = 'R$ '. number_format($total_comissao, 2, ',','.');
        $data['perc_comissao']      = $funcionario['comissao_funcionario']. ' %';
        $data['perc_comissao']      = $funcionario['comissao_funcionario']. ' %';
        $data['vendedor']           = $funcionario['nome_funcionario'];
        $data['perfil']             = $perfil['perfilusuario_nome'];
        $data['loja']               = $loja['nome'];
        
        if($filtros['datainicio']){
            $data['datainicio']    = date('d/m/Y H:i', strtotime($filtros['datainicio']));
        }
        if($filtros['datafim']){
            $data['datafim']        = date('d/m/Y H:i', strtotime($filtros['datafim']));
        }
        
        return $data;
    }
    
    public function relatorioVendas($filtros){
        
        if($filtros['forma']){
            $this->db->where('id_forma', $filtros['forma']);
            $this->db->select('nome_forma');
            $hur = $this->db->get('formas_pagamento')->row_array();
            $forma = $hur['nome_forma'];
            
            $this->db->like('formaPagamento', $forma, "both");
        }
        
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($filtros['loja']){
            $this->db->where('loja_id', $filtros['loja']);
        }
        
        if(isset($filtros['status'])){
            $this->db->where('statusPagamento', $filtros['status']);   
        }else{
             $this->db->where('statusPagamento <', 25);   
        }
        
        $this->db->select('idcompra, idClient, dataCompra, desconto, valorCompra, valorFrete, valorAcrescimo, datacompra, statusPagamento, formaPagamento,');
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $total_comissao = 0;
        $pedidos        = [];
        
        
        $this->db->select('nome');
        $this->db->where('id', $filtros['loja']);
        $loja = $this->db->get('loja')->row_array();
        
        $this->db->select('id_forma, nome_forma');
        $formasPgts = $this->db->get('formas_pagamento')->result_array();
            
        foreach($result as $aux){
            
            $this->db->select('cliente_nome, cliente_cpf');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
            } else {
                $nome_cliente       = 'Cliente excluído';
            }
            
            for($auxf = 0; $auxf < count($formasPgts); $auxf++){
              if(stripos($aux['formaPagamento'], $formasPgts[$auxf]['nome_forma']) != false) 
              {
                  $formasPgts[$auxf]['contvenda'] += 1;
                  $formasPgts[$auxf]['contvalor'] += $aux['valorCompra'] - $aux['desconto'];
              }
            }
            
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'        => $nome_cliente,
                'total'         => 'R$ '. number_format(($aux['valorCompra']), 2, ',','.'),
                'datacompra'    => date('d/m/Y H:i', strtotime($aux['dataCompra'])),
                'status'        => $sts['nomeStatusCompra'],
                'forma'         => $aux['formaPagamento'],
                'desconto'      => 'R$ '. number_format(($aux['desconto']), 2, ',','.'),
                'frete'      => 'R$ '. number_format(($aux['valorFrete']), 2, ',','.'),
                'acrescimo'     => 'R$ '. number_format(($aux['valorAcrescimo']), 2, ',','.'),
                'final'         => 'R$ '. number_format(($aux['valorCompra'] + $aux['valorFrete'] + $aux['valorAcrescimo'] - $aux['desconto']), 2, ',','.'),
            );
            $total_geral += ($aux['valorCompra'] - $aux['desconto']);
            $i++;
        }
        
        $data['formasPgts'] = $formasPgts;
        $data['pedidos']            = $pedidos;
        $data['loja']               = $loja['nome'];
        $data['total_geral']        = 'R$ '. number_format($total_geral, 2, ',','.');
        
        if($filtros['datainicio']){
            $data['datainicio']     = date('d/m/Y H:i', strtotime($filtros['datainicio']));
        } else {$data['datainicio']     = 0;
            
        }
        if($filtros['datafim']){
            $data['datafim']        = date('d/m/Y H:i', strtotime($filtros['datafim']));
        } else { $data['datafim']     = 0;}
        
        return $data;
    }
    
    public function relatorioPedidosFiltros($filtros){
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($filtros['forma_pagamento']){
            $this->db->where('formaPagamento', $filtros['forma_pagamento']);
        }
        if($filtros['status']){
            $this->db->where('statusPagamento', $filtros['status']);    
        }
        if($filtros['estado']){
            $this->db->join('cep', 'historicocompras.cepCompra = cep.cep');
            $this->db->like('cep_cidadeuf', '/'.$filtros['estado']);  
        }
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $pedidos        = [];
        
        
        foreach($result as $aux){
            $this->db->select('cliente_nome, cliente_cpf');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            $total_geral = $total_geral + ($aux['valorCompra'] + $aux['valorFrete'] + $aux['valorAcrescimo'] - $aux['desconto']);
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
                $cpf_cliente        = $cliente['cliente_cpf'];
            } else {
                $nome_cliente       = 'Cliente excluído';
                $cpf_cliente        = 'Cliente excluído';
            }
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome_cliente,
                'cpf'           => $cpf_cliente,
                'total'         => $aux['valorCompra'] + $aux['valorFrete'] + $aux['valorAcrescimo'] - $aux['desconto'],
                'cadastro'      => $aux['dataCompra'],
                'status'        => $sts['nomeStatusCompra'],
                'forma'         => $aux['formaPagamento'],
                'e_endereco'    => $this->validarEndereco($aux_endereco, 0),
                'e_numero'      => $aux['numeroEndereco'],
                'e_complemento' => $this->validarEndereco($aux_endereco, 1),
                'e_bairro'      => $this->validarEndereco($aux_endereco, 2),
                'e_cidade'      => $this->validarEndereco($aux_endereco, 3),
                'e_estado'      => $this->validarEndereco($aux_endereco, 4),
                'e_cep'         => $aux['cepCompra'],
            );
            $i++;
        }
        
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
    
    public function relatorioPedidosDetalhado(){
        $this->db->select('
        idcompra, idClient, datacompra, desconto, 
        valorCompra, valorFrete, valorAcrescimo, 
        statusPagamento, formaPagamento
        ');
        $this->db->group_start(); 
        $this->db->where('datacompra >=', date("Y-m-10 00:00:00"));
        $this->db->group_end(); 
        $this->db->order_by('idcompra', 'DESC');
        $historico = $this->db->get('historicocompras')->result_array();

        $aux_cont = 0;
        $pedidos = [];
        $total_geral = 0;
        
        foreach($historico as $aux){ 
            $auxproduto     = explode('¬', $aux['listProdutosId']);
            $auxquantidade  = explode('¬', $aux['qtdProdutos']);
            $auxvalor       = explode('¬', $aux['vlrProdutos']);
        
            $cont = 0;
            $produtos = [];
            $total = 0;
            
            foreach($auxproduto as $a){
                $this->db->where('produto_id', $a);
                $produto = $this->db->get('produtos')->row_array();
                if($produto){
                    $produtos[$cont] = array(
                        'produto_nome'          =>  $produto['produto_nome'],   
                        'produto_codigo'        =>  $produto['produto_codigo'],   
                        'produto_modelo'        =>  $produto['produto_modelo'],
                        'produto_peso'          =>  $produto['produto_peso'],
                        'produto_un_peso'       =>  $produto['produto_un_peso'],
                        'produto_valor'         =>  $auxvalor[$cont],
                        'produto_quantidade'    =>  $auxquantidade[$cont],
                    );
                }
                $cont++;
            }
            
            
            $this->db->select('cliente_nome, cliente_cpf, cliente_email, cliente_telefone');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            $total_geral = $total_geral + ($aux['valorCompra'] + $aux['valorFrete'] + $aux['valorAcrescimo'] - $aux['desconto']);
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
                $cpf_cliente        = $cliente['cliente_cpf'];
                $telefone_cliente   = $cliente['cliente_telefone'];
                $email_cliente      = $cliente['cliente_email'];
            } else {
                $nome_cliente       = 'Cliente excluído';
                $cpf_cliente        = 'Cliente excluído';
                $telefone_cliente   = 'Cliente excluído';
                $email_cliente      = 'Cliente excluído';
            }
            
            $pedidos[$aux_cont] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome_cliente,
                'cpf'           => $cpf_cliente,
                'telefone'      => $telefone_cliente,
                'email'         => $email_cliente,
                'e_endereco'    => $this->validarEndereco($aux_endereco, 0),
                'e_numero'      => $aux['numeroEndereco'],
                'e_complemento' => $this->validarEndereco($aux_endereco, 1),
                'e_bairro'      => $this->validarEndereco($aux_endereco, 2),
                'e_cidade'      => $this->validarEndereco($aux_endereco, 3),
                'e_estado'      => $this->validarEndereco($aux_endereco, 4),
                'e_cep'         => $aux['cepCompra'],
                'total'         => $aux['valorCompra'] + $aux['valorAcrescimo'] + $aux['valorFrete'] - $aux['desconto'],
                'cadastro'      => $aux['dataCompra'],
                'status'        => $sts['nomeStatusCompra'],
                'forma'         => $aux['formaPagamento'],
                'frete'         => $aux['formaEnvio'],
                'acrescimo'     => $aux['valorAcrescimo'],
                'produtos'      => $produtos,
                'total_produto' => $aux['valorCompra'],
                'frete_valor'   => $aux['valorFrete'],
                'desconto'      => $aux['desconto'],
            );
            $aux_cont++;
        }
        
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
    
    public function relatorioPedidosDetalhadoFiltros($filtros){
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($filtros['forma_pagamento']){
            $this->db->where('formaPagamento', $filtros['forma_pagamento']);
        }
        if($filtros['status']){
            $this->db->where('statusPagamento', $filtros['status']);    
        }
        if($filtros['estado']){
            $this->db->join('cep', 'historicocompras.cepCompra = cep.cep');
            $this->db->like('cep_cidadeuf', '/'.$filtros['estado']);  
        }
        $historico = $this->db->get('historicocompras')->result_array();
        
        echo '<pre>';
        print_r($historico);
        echo '</pre>';

        $aux_cont       = 0;
        $pedidos        = [];
        $total_geral    = 0;
        
        foreach($historico as $aux){ 

            $auxproduto     = explode('¬', $aux['listProdutosId']);
            $auxquantidade  = explode('¬', $aux['qtdProdutos']);
            $auxvalor       = explode('¬', $aux['vlrProdutos']);
        
            $cont = 0;
            $produtos = [];
            $total = 0;
            
            foreach($auxproduto as $a){
                $boolean_produto = false;
                
                if($filtros['produto']){
                    if($filtros['produto'] == $a){
                        $boolean_produto = true;
                        
                        $this->db->where('produto_id', $a);
                        $produto = $this->db->get('produtos')->row_array();
                        if($produto){
                           $produtos[$cont] = array(
                                'produto_nome'          =>  $produto['produto_nome'],   
                                'produto_codigo'        =>  $produto['produto_codigo'],   
                                'produto_modelo'        =>  $produto['produto_modelo'],
                                'produto_peso'          =>  $produto['produto_peso'],
                                'produto_un_peso'       =>  $produto['produto_un_peso'],
                                'produto_valor'         =>  $auxvalor[$cont],
                                'produto_quantidade'    =>  $auxquantidade[$cont],
                            ); 
                        }
                        $cont++;
                    }
                } else {
                    $boolean_produto = true;
                    $this->db->where('produto_id', $a);
                    $produto = $this->db->get('produtos')->row_array();
                    if($produto){
                        $produtos[$cont] = array(
                            'produto_nome'          =>  $produto['produto_nome'],   
                            'produto_codigo'        =>  $produto['produto_codigo'],   
                            'produto_modelo'        =>  $produto['produto_modelo'],
                            'produto_peso'          =>  $produto['produto_peso'],
                            'produto_un_peso'       =>  $produto['produto_un_peso'],
                            'produto_valor'         =>  $auxvalor[$cont],
                            'produto_quantidade'    =>  $auxquantidade[$cont],
                        );
                    }
                    $cont++;
                }
                
            }
            
            if($boolean_produto == true){
                $this->db->select('cliente_nome, cliente_cpf, cliente_telefone, cliente_email');
                $this->db->where('cliente_id', $aux['idClient']);
                $cliente = $this->db->get('cliente')->row_array();
                
                $this->db->where('idStatusCompra', $aux['statusPagamento']);
                $this->db->select('nomeStatusCompra');
                $sts = $this->db->get('statuscompras')->row_array();
                
                $total_geral = $total_geral + ($aux['valorCompra'] + $aux['valorFrete'] - $aux['desconto']);
                
                $aux_endereco = explode('¬', $aux['enderecoCompra']);
                
                if($cliente){
                    $nome_cliente       = $cliente['cliente_nome'];
                    $cpf_cliente        = $cliente['cliente_cpf'];
                    $telefone_cliente   = $cliente['cliente_telefone'];
                    $email_cliente      = $cliente['cliente_email'];
                } else {
                    $nome_cliente       = 'Cliente excluído';
                    $cpf_cliente        = 'Cliente excluído';
                    $telefone_cliente   = 'Cliente excluído';
                    $email_cliente      = 'Cliente excluído';
                }
                
                $pedidos[$aux_cont] = array(
                    'idpedido'      => $aux['idcompra'],
                    'cliente'       => $nome_cliente,
                    'cpf'           => $cpf_cliente,
                    'telefone'      => $telefone_cliente,
                    'email'         => $email_cliente,
                    'e_endereco'    => $this->validarEndereco($aux_endereco, 0),
                    'e_numero'      => $aux['numeroEndereco'],
                    'e_complemento' => $this->validarEndereco($aux_endereco, 1),
                    'e_bairro'      => $this->validarEndereco($aux_endereco, 2),
                    'e_cidade'      => $this->validarEndereco($aux_endereco, 3),
                    'e_estado'      => $this->validarEndereco($aux_endereco, 4),
                    'e_cep'         => $aux['cepCompra'],
                    'total'         => $aux['valorCompra'] + $aux['valorFrete'] + $aux['valorAcrescimo'] - $aux['desconto'],
                    'cadastro'      => $aux['dataCompra'],
                    'status'        => $sts['nomeStatusCompra'],
                    'forma'         => $aux['formaPagamento'],
                    'frete'         => $aux['formaEnvio'],
                    'acrescimo'     => $aux['valorAcrescimo'],
                    'produtos'      => $produtos,
                    'total_produto' => $aux['valorCompra'],
                    'frete_valor'   => $aux['valorFrete'],
                    'desconto'      => $aux['desconto'],
                );
                $aux_cont++;
            }
        }
        
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
    
    public function relatorioVendasProdutosDetalhado(){
        $produtos = $this->db->get('produtos')->result_array();
        $historico = $this->db->get('historicocompras')->result_array();
        
        $cont = 0;
        $itens = [];
        
        $g_quantidade         = 0;
        $g_total              = 0;
        $g_total_aprovado     = 0;
        $g_total_negado       = 0;
        $g_total_aguardando   = 0;
        
        foreach($produtos as $p){
            
            $quantidade         = 0;
            $total              = 0;
            $total_aprovado     = 0;
            $total_negado       = 0;
            $total_aguardando   = 0;
            
            foreach($historico as $h){
                $auxprodutos    = explode('¬', $h['listProdutosId']);
                $auxquantidade  = explode('¬', $h['qtdProdutos']);
                $auxvalor       = explode('¬', $h['vlrProdutos']);
                
                $cont2 = 0;
                foreach($auxprodutos as $aux){
                    
                    if($p['produto_id'] == $aux){
                        if($h['statusPagamento'] == 16){
                            $total_aguardando   = $total_aguardando + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_aguardando = $g_total_aguardando + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        } else if($h['statusPagamento'] == 19){
                            $total_negado       = $total_negado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_negado     = $g_total_negado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        } else if($h['statusPagamento'] == 17){
                            $total_aprovado     = $total_aprovado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_aprovado   = $g_total_aprovado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        }
                    }
                    
                    $cont2++;
                }

            }
            $itens[$cont] = array(
                'nome'              => $p['produto_nome'],
                'quantidade'        => $quantidade,
                'total'             => $total,
                'total_aprovado'    => $total_aprovado,
                'total_negado'      => $total_negado,
                'total_aguardando'  => $total_aguardando,
            );
            $cont++;
        }
        
        $geral = array(
            'itens'                 => $itens,
            'g_quantidade'          => $g_quantidade,
            'g_total'               => $g_total,
            'g_total_aprovado'      => $g_total_aprovado,
            'g_total_negado'        => $g_total_negado,
            'g_total_aguardando'    => $g_total_aguardando,
        );
        
        return $geral;
        
    }
    
    public function relatorioVendasProdutosDetalhadoFiltros($filtros){
        if($filtros['produto']){
            $this->db->where('produto_id', $filtros['produto']);
        }
        $produtos = $this->db->get('produtos')->result_array();
        
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        if($filtros['forma_pagamento']){
            $this->db->where('formaPagamento', $filtros['forma_pagamento']);
        }
        if($filtros['status']){
            $this->db->where('statusPagamento', $filtros['status']);    
        }
        if($filtros['estado']){
            $this->db->join('cep', 'historicocompras.cepCompra = cep.cep');
            $this->db->like('cep_cidadeuf', '/'.$filtros['estado']);    
        }
        $historico = $this->db->get('historicocompras')->result_array();
        
        $cont = 0;
        $itens = [];
        
        $g_quantidade         = 0;
        $g_total              = 0;
        $g_total_aprovado     = 0;
        $g_total_negado       = 0;
        $g_total_aguardando   = 0;
        
        foreach($produtos as $p){
            
            $quantidade         = 0;
            $total              = 0;
            $total_aprovado     = 0;
            $total_negado       = 0;
            $total_aguardando   = 0;
            
            foreach($historico as $h){
                $auxprodutos    = explode('¬', $h['listProdutosId']);
                $auxquantidade  = explode('¬', $h['qtdProdutos']);
                $auxvalor       = explode('¬', $h['vlrProdutos']);
                
                $cont2 = 0;
                foreach($auxprodutos as $aux){
                    
                    if($p['produto_id'] == $aux){
                        if($h['statusPagamento'] == 16){
                            $total_aguardando   = $total_aguardando + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_aguardando = $g_total_aguardando + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        } else if($h['statusPagamento'] == 19){
                            $total_negado       = $total_negado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_negado     = $g_total_negado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        } else if($h['statusPagamento'] == 17){
                            $total_aprovado     = $total_aprovado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $total              = $total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $quantidade         = $quantidade + $auxquantidade[$cont2];
                            $g_quantidade       = $g_quantidade + $auxquantidade[$cont2];
                            $g_total            = $g_total + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                            $g_total_aprovado   = $g_total_aprovado + ($auxvalor[$cont2] * $auxquantidade[$cont2]);
                        }
                    }
                    
                    $cont2++;
                }

            }
            $itens[$cont] = array(
                'nome'              => $p['produto_nome'],
                'quantidade'        => $quantidade,
                'total'             => $total,
                'total_aprovado'    => $total_aprovado,
                'total_negado'      => $total_negado,
                'total_aguardando'  => $total_aguardando,
            );
            $cont++;
        }
        
        $geral = array(
            'itens'                 => $itens,
            'g_quantidade'          => $g_quantidade,
            'g_total'               => $g_total,
            'g_total_aprovado'      => $g_total_aprovado,
            'g_total_negado'        => $g_total_negado,
            'g_total_aguardando'    => $g_total_aguardando,
        );
        
        return $geral;
        
    }
    
    public function indexdias($dias, $loja_id){
        $this->db->select(" COUNT(*) as pages");
        if($dias == 1){
            $this->db->where('cliente_datacadastro', date('Y-m-d'));  
        } else {
            $this->db->where('cliente_datacadastro <=', date('Y-m-d'));  
            $this->db->where('cliente_datacadastro >=', date('Y-m-d', strtotime('-' . $dias . ' days', strtotime(date('Y-m-d')))));
        }
        $clientes = $this->db->get('cliente')->row_array();
        
        
        $g_total_aprovado       = 0;
        $g_total_negado         = 0;
        $g_total_analise        = 0;
        if($loja_id == 'all'){
            $whereLojaId = ['>', 0];
            
        }else{
            $whereLojaId = ['=', $loja_id];
            
        }
        
        if($dias == 1){
            $this->db->where('dataCompra <=', date('Y-m-d') . ' 23:59:00');  
            $this->db->where('dataCompra >=', date('Y-m-d') . ' 00:00:00');  
            $this->db->where('loja_id '.$whereLojaId[0], $whereLojaId[1]);
        } else {
            $this->db->where('dataCompra <=', date('Y-m-d') . ' 23:59:00');  
            $this->db->where('dataCompra >=', date('Y-m-d', strtotime('-' . $dias . ' days', strtotime(date('Y-m-d')))) . ' 00:00:00');
            $this->db->where('loja_id '.$whereLojaId[0], $whereLojaId[1]);
        }
        $historico = $this->db->get('historicocompras')->result_array();
        
        foreach($historico as $h){

            if($h['statusPagamento'] == 19){
                $g_total_negado     = $g_total_negado + ($h['valorCompra'] + $aux['valorAcrescimo'] + $h['valorFrete'] - $h['desconto']);
            } else if($h['statusPagamento'] == 17){
                $g_total_aprovado   = $g_total_aprovado +  ($h['valorCompra'] + $aux['valorAcrescimo'] + $h['valorFrete'] - $h['desconto']);
            } else if($h['statusPagamento'] == 16){
                $g_total_analise    = $g_total_analise +  ($h['valorCompra'] + $aux['valorAcrescimo'] + $h['valorFrete'] - $h['desconto']);
            }

        }

        
        $data = array(
            'clientes'          => $clientes['pages'],
            'total_aprovado'    => $g_total_aprovado,    
            'total_negado'      => $g_total_negado,
            'total_analise'     => $g_total_analise,
        );
        
        return $data;
    }
    
    public function relatorioIndex($loja_id=false){
        $this->db->select(" COUNT(*) as pages");
        $clientes = $this->db->get('cliente')->row_array();
        
        $this->db->order_by('dataCompra', 'desc');
        $this->db->limit(5);
        
          if($loja_id){
            if($loja_id == 'all'){
                $this->db->where('loja_id >', 0);
            }else{
                
                $this->db->where('loja_id =', $loja_id);
                
            }
             
             
        }
        
        
        $historico2 = $this->db->get('historicocompras')->result_array();
        
      
        $historico = $this->db->get('historicocompras')->result_array();
        
       
        
        $g_total_aprovado       = 0;
        $g_total_negado         = 0;
        $g_total_analise        = 0;
        $g_forma_cartao         = 0;
        $g_forma_boleto         = 0;
        $ac = $al = $ap = $am = $ba = $ce = $df = $es = $go = $ma = $mt = $ms = $mg = $pa = $pb = $pr = $pe = $pi = $rj = $rn = $rs = $ro = $rr = $sc = $sp = $se = $to = 0;
        $pedidos    = [];
        $cont1      = 0;
        
        
        
        foreach($historico as $h){
            $aux_endereco = explode('¬', $h['enderecoCompra']);
            
            if(count($aux_endereco) >= 5){
                if($aux_endereco[4] == 'AC'){
                    $ac++;
                } else if($aux_endereco[4] == 'AL'){
                    $al++;
                } else if($aux_endereco[4] == 'AP'){
                    $ap++;
                } else if($aux_endereco[4] == 'AM'){
                    $am++;
                } else if($aux_endereco[4] == 'BA'){
                    $ba++;
                } else if($aux_endereco[4] == 'CE'){
                    $ce++;
                } else if($aux_endereco[4] == 'DF'){
                    $df++;
                } else if($aux_endereco[4] == 'ES'){
                    $es++;
                } else if($aux_endereco[4] == 'GO'){
                    $go++;
                } else if($aux_endereco[4] == 'MA'){
                    $ma++;
                } else if($aux_endereco[4] == 'MT'){
                    $mt++;
                } else if($aux_endereco[4] == 'MS'){
                    $ms++;
                } else if($aux_endereco[4] == 'MG'){
                    $mg++;
                } else if($aux_endereco[4] == 'PA'){
                    $pa++;
                } else if($aux_endereco[4] == 'PB'){
                    $pb++;
                } else if($aux_endereco[4] == 'PR'){
                    $pr++;
                } else if($aux_endereco[4] == 'PE'){
                    $pe++;
                } else if($aux_endereco[4] == 'PI'){
                    $pi++;
                } else if($aux_endereco[4] == 'RJ'){
                    $rj++;
                } else if($aux_endereco[4] == 'RN'){
                    $rn++;
                } else if($aux_endereco[4] == 'RS'){
                    $rs++;
                } else if($aux_endereco[4] == 'RO'){
                    $ro++;
                } else if($aux_endereco[4] == 'RR'){
                    $rr++;
                } else if($aux_endereco[4] == 'SC'){
                    $sc++;
                } else if($aux_endereco[4] == 'SP'){
                    $sp++;
                } else if($aux_endereco[4] == 'SE'){
                    $se++;
                } else if($aux_endereco[4] == 'TO'){
                    $to++;
                } 
            }
            
            if($h['formaPagamento'] == 'com o vendedor'){
                $g_forma_cartao++;
            } 
            
        }
        
        foreach($historico2 as $h){
            $this->db->select('cliente_nome');
            $this->db->where('cliente_id', $h['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('id', $h['loja_id']);
            $loja = $this->db->get('loja')->row_array();
        
            
            $this->db->where('idStatusCompra', $h['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
            } else {
                $nome_cliente       = 'Cliente excluído';
            }
            
            $pedidos[$cont1] = array(
                'id'        => $h['idcompra'],
                'nome'      => $nome_cliente,
                'data'      => $h['dataCompra'],
                'valor'     => $h['valorCompra'] + $h['valorFrete'] - $h['desconto'],
                'status'    => $sts['nomeStatusCompra'],
                'loja'      => $loja ? $loja['nome'] : 'Loja não encontrada',
            );
            $cont1++;
        }
        
        $geral = array(
            'total_cartao'      => $g_forma_cartao,    
            'total_boleto'      => $g_forma_boleto,    
            'pedidos'           => $pedidos,
            'ac'                => $ac,
            'al'                => $al,
            'ap'                => $ap,
            'am'                => $am,
            'ba'                => $ba,
            'ce'                => $ce,
            'df'                => $df,
            'es'                => $es,
            'go'                => $go,
            'ma'                => $ma,
            'mt'                => $mt,
            'ms'                => $ms,
            'mg'                => $mg,
            'pa'                => $pa,
            'pb'                => $pb,
            'pr'                => $pr,
            'pe'                => $pe,
            'pi'                => $pi,
            'rj'                => $rj,
            'rn'                => $rn,
            'rs'                => $rs,
            'ro'                => $ro,
            'rr'                => $rr,
            'sc'                => $sc,
            'sp'                => $sp,
            'se'                => $se,
            'to'                => $to,
        );
            
        return $geral;
        
    }
    
    // Listagem de pedidos no público, na área de usuários logados.
    public function pedidosPublico($id){
        $this->db->where('idClient', $id);
        $this->db->order_by('idCompra', 'desc');
        $historico = $this->db->get('historicocompras')->result_array();
        
        $pedidos    = [];
        $cont1      = 0;
        
        foreach($historico as $h){
            $this->db->where('idStatusCompra', $h['statusCompra']);
            $this->db->select('nomeStatusCompra');
            $stscompra = $this->db->get('statuscompras')->row_array();
            
            if($stscompra){
                $stscompra = $stscompra['nomeStatusCompra'];
            } else {
                $stscompra = 'Status não encontrado';
            }
            
            $pedidos[$cont1] = array(
                'id'        => $h['idcompra'],
                'data'      => $h['dataCompra'],
                'valor'     => $h['valorCompra'] + $h['valorFrete'] + $aux['valorAcrescimo'] - $h['desconto'],
                'status'    => $stscompra,
            );
            $cont1++;
        }
        return $pedidos;
    }
    
    public function pedido($id){
        $this->db->where('idcompra', $id);
        $aux = $this->db->get('historicocompras')->row_array();

        $this->db->where('cliente_id', $aux['idClient']);
        $this->db->select('cliente_nome, cliente_cpf, cliente_email, cliente_telefone, cliente_endereco, cliente_cep, cliente_numero, cliente_bairro, cliente_cidade, cliente_estado, cliente_complemento');
        $cliente = $this->db->get('cliente')->row_array();
        
        $auxproduto     = explode('¬', $aux['listProdutosId']);
        $auxquantidade  = explode('¬', $aux['qtdProdutos']);
        $auxvalor       = explode('¬', $aux['vlrProdutos']);
        
        if($aux['opProdutos'] == null){
            $aux['opProdutos'] = "";
        }
        
        $auxop          = explode('¬', $aux['opProdutos']);
        
        $cont = 0;
        $produtos = [];
        $total = 0;
        $opcao = 'padrão';
        
        for($i=0; $i < count($auxop); $i++){
            if($auxop[$i] != 'padrão'){
                $auxop2 = explode('&', $auxop[$i]);
                $opcao = ucfirst(mb_strtolower($auxop2[0])) . ': ' . $auxop2[0];
            }
        }
        
        foreach($auxproduto as $a){
            
            $this->db->where('produto_id', $a);
            $produto = $this->db->get('produtos')->row_array();
            
            if($produto){
               $produtos[$cont] = array(
                    'produto_id'            =>  $produto['produto_id'], 
                    'produto_nome'          =>  $produto['produto_nome'],   
                    'produto_modelo'        =>  $produto['produto_modelo'],
                    'produto_peso'          =>  $produto['produto_peso'],
                    'produto_un_peso'       =>  $produto['produto_un_peso'],
                    'produto_valor'         =>  $auxvalor[$cont],
                    'produto_quantidade'    =>  $auxquantidade[$cont],
                    'produto_opcao'         =>  $opcao,
                );
                $cont++; 
            } 
        }
        

        $this->db->where('idStatusCompra', $aux['statusCompra']);
        $this->db->select('nomeStatusCompra');
        $stscompra = $this->db->get('statuscompras')->row_array();
        if($stscompra){
            $stscompra = $stscompra['nomeStatusCompra'];
        } else {
            $stscompra = 'Status não encontrado';
        }

        $this->db->where('idStatusCompra', $aux['statusEnvio']);
        $this->db->select('nomeStatusCompra');
        $stsenvio = $this->db->get('statuscompras')->row_array();
        if($stsenvio){
            $stsenvio = $stsenvio['nomeStatusCompra'];
        } else {
            $stsenvio = 'Status não encontrado';
        }
        
        $this->db->where('historico_pedido_id', $aux['idcompra']);
        $this->db->order_by("historico_data", "desc");
        $this->db->order_by("historico_hora", "desc");
        $historico = $this->db->get('historico_pedido')->result_array();
        
        $historicos = [];
        $cont_historico = 0;
        
        foreach($historico as $h){
            if($h['historico_notificar'] == 1){
                $notificar = 'Sim';
            } else {
                $notificar = 'Não';
            }
            
            $this->db->where('idStatusCompra', $h['historico_status']);
            $status = $this->db->get('statuscompras')->row_array();
            
            $historicos[$cont_historico] = array(
                'historico_data'        => date('d/m/Y', strtotime($h['historico_data'])), 
                'historico_hora'        => date('H:i', strtotime($h['historico_hora'])),
                'historico_comentario'  => $h['historico_comentario'],
                'historico_id'          => $h['historico_id'],
                'historico_notificar'   => $notificar,
                'historico_status'      => $status['nomeStatusCompra'],
            );
            $cont_historico++;
        }
        
        $this->db->where('reembolso_pedido_id', $id);
        $devolucao = $this->db->get('reembolso')->row_array();
        if($devolucao){
            $cont_devolucao     = 0;
            $existe_devolucao   = 1;
            $this->db->where('historico_pedido_id', $id);
            $this->db->order_by("historico_data", "desc");
            $this->db->order_by("historico_hora", "desc");
            $historico_devolucao = $this->db->get('historico_devolucao')->result_array();
            foreach($historico_devolucao as $h){
                $this->db->where('idStatusCompra', $h['historico_status']);
                $status_devolucao = $this->db->get('statuscompras')->row_array();
                
                echo $status_devolucao['nomeStatusCompra'];
                
                $historico_devolucao[$cont_devolucao] = array(
                    'historico_data'            => $h['historico_data'],
                    'historico_hora'            => $h['historico_hora'],
                    'historico_comentario'      => $h['historico_comentario'],
                    'historico_status'          => $status_devolucao['nomeStatusCompra'],
                );
                $cont_devolucao++;
            }
        } else {
            $historico_devolucao    = null;
            $existe_devolucao       = 0;
        }
        
        if($cliente){
            $nome_cliente       = $cliente['cliente_nome'];
            $cpf_cliente        = $cliente['cliente_cpf'];
            $telefone_cliente   = $cliente['cliente_telefone'];
            $email_cliente      = $cliente['cliente_email'];
            $endereco_cliente   = $cliente['cliente_endereco'];
            $numero_cliente     = $cliente['cliente_numero'];
            $bairro_cliente     = $cliente['cliente_bairro'];
            $cidade_cliente     = $cliente['cliente_cidade'];
            $estado_cliente     = $cliente['cliente_estado'];
            $cep_cliente        = $cliente['cliente_cep'];
            $complemento_cliente= $cliente['cliente_complemento'];
        } else {
            $nome_cliente       = 'Cliente não encontrado';
            $cpf_cliente        = 'Cliente não encontrado';
            $telefone_cliente   = 'Cliente não encontrado';
            $email_cliente      = 'Cliente não encontrado';
            $endereco_cliente   = 'Cliente não encontrado';
            $numero_cliente     = 'Cliente não encontrado';
            $bairro_cliente     = 'Cliente não encontrado';
            $cidade_cliente     = 'Cliente não encontrado';
            $cep_cliente        = 'Cliente não encontrado';
            $estado_cliente     = 'Cliente não encontrado';
            $complemento_cliente= 'Cliente não encontrado';
        }
        
        $aux_endereco = explode('¬', $aux['enderecoCompra']);
        
        $pedido = array(
            'idpedido'              => $aux['idcompra'],
            'cliente'               => $nome_cliente,
            'cpf'                   => $cpf_cliente,
            'telefone'              => $telefone_cliente,
            'email'                 => $email_cliente,
            'complemento'           => $complemento_cliente,
            'e_endereco'            => $this->validarEndereco($aux_endereco, 0),
            'e_numero'              => $aux['numeroEndereco'],
            'e_complemento'         => $this->validarEndereco($aux_endereco, 1),
            'e_bairro'              => $this->validarEndereco($aux_endereco, 2),
            'e_cidade'              => $this->validarEndereco($aux_endereco, 3),
            'e_estado'              => $this->validarEndereco($aux_endereco, 4),
            'e_cep'                 => $aux['cepCompra'],
            'total'                 => $aux['valorCompra'],
            'cadastro'              => $aux['dataCompra'],
            'modificacao'           => $aux['dataAlteracao'],
            'status'                => $stscompra,
            'frete_situacao'        => $stsenvio,
            'forma'                 => $aux['formaPagamento'],
            'frete'                 => $aux['formaEnvio'],
            'endereco'              => $endereco_cliente,
            'numero'                => $numero_cliente,
            'bairro'                => $bairro_cliente,
            'cidade'                => $cidade_cliente,
            'estado'                => $estado_cliente,
            'cep'                   => $cep_cliente,
            'produtos'              => $produtos,
            'frete_valor'           => $aux['valorFrete'],
            'acrescimo'             => $aux['valorAcrescimo'],
            'historico'             => $historicos,
            'devolucao'             => $existe_devolucao,
            'historico_devolucao'   => $historico_devolucao,
            'desconto'              => $aux['desconto'],
            'boleto'                => $aux['boleto_url'],
            'codigoBarras'          => $aux['boleto_barcode'],
            'vencimento'            => $aux['boleto_expiration_date'],
            'boletoCDBar'           => $aux['boleto_barcode'],
        );
        
        return $pedido;
    }
    
    public function getAllPedidoByCliente($id){
        $this->db->order_by('idcompra', 'desc');
        $this->db->where('idClient', $id);
        $historico = $this->db->get('historicocompras')->result_array();
        
        $pedido = [];
        $cont2 = 0;
        
        foreach($historico as $aux){
            
            $this->db->where('idStatusCompra', $aux['statusCompra']);
            $this->db->select('nomeStatusCompra');
            $stscompra = $this->db->get('statuscompras')->row_array();
            if($stscompra){
                $stscompra = $stscompra['nomeStatusCompra'];
            } else {
                $stscompra = 'Status não encontrado';
            }
            
        
            
            $pedido[$cont2] = array(
                'idpedido'      => $aux['idcompra'],
                'total'         => $aux['valorCompra'],
                'data'          => $aux['dataCompra'],
                'status'        => $stscompra,
                'frete_valor'   => $aux['valorFrete'],
                'desconto'      => $aux['desconto'],
            );
            
            $cont2++;
        }
        
        return $pedido;
    }
    
    public function getAllPedidos($limit, $start, $loja_id, $filter){
        $this->db->select('idcompra, idClient, valorCompra, dataCompra, statusPagamento, statusCompra, desconto, valorFrete, loja_id, formaPagamento');
        /*if($filter != 0){
            $this->db->like('idcompra', $filter, 'none');
            $this->db->or_like('valorCompra', $filter, 'both');
            $this->db->or_like('dataCompra', $filter, 'both');
            $this->db->or_like('statusPagamento', $filter, 'both');
        }*/
        $this->db->order_by('dataCompra', 'desc');
        $this->db->limit($limit, $start);
        if($loja_id != 'all' && $loja_id != NULL){
            $this->db->where('loja_id =', $loja_id);
        }
        $data = $this->db->get('historicocompras')->result_array();
        
        $pedidos = null;
        
        $i=0;
        foreach($data as $aux){
            $this->db->select('cliente_nome');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $stscompra = $this->db->get('statuscompras')->row_array();
            if($stscompra){
                $stscompra = $stscompra['nomeStatusCompra'];
            } else {
                $stscompra = 'Status não encontrado';
            }
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
            } else {
                $nome_cliente       = 'Cliente excluído';
            }
            
            $this->db->where('id', $aux['loja_id']);
            $loja = $this->db->get('loja')->row_array();
            
            if($loja){
                $lojanome = $loja['nome'];
            }else{
                $lojanome = "Loja não encontrada.";
            }
            
            
            if(mb_strrpos($aux['formaPagamento'], "Loja")){
                $pdv = "Sim";
            }else{
                $pdv = "Não";
            }
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome_cliente,
                'total'         => $aux['valorCompra'] + $aux['valorFrete'] - $aux['desconto'],
                'cadastro'      => $aux['dataCompra'],
                'status'        => $stscompra,
                'pdv'           => $pdv,
                'loja'          => $lojanome,
            );
            $i++;
        }
        
        return $pedidos;
    }
    
    public function get_count($loja_id) {
        $this->db->select(" COUNT(*) as pages");
        if($loja_id != 'all' && $loja_id != NULL){
            $this->db->where('loja_id =', $loja_id);
        }
        $a = $this->db->get('historicocompras')->row_array();
        return $a['pages'];
    }
    
    public function getAllPedidosFiltro($filter, $limit, $start, $loja_id){
        $this->db->select('idcompra, idClient, valorCompra, dataCompra, statusPagamento, valorFrete, desconto, loja_id');
        $this->db->join('statuscompras', 'historicocompras.statusPagamento = statuscompras.idStatusCompra');
        $this->db->join('cliente', 'historicocompras.idClient = cliente.cliente_id');
        if($filter != 0){
            $this->db->like('idcompra', $filter, 'both');
            $this->db->or_like('idClient', $filter, 'both');
            $this->db->or_like('valorCompra', $filter, 'both');
            $this->db->or_like('dataCompra', $filter, 'both');
            $this->db->or_like('statusPagamento', $filter, 'both');
            $this->db->or_like('cliente_nome', $filter, 'both');
            $this->db->or_like('nomeStatusCompra', $filter, 'both');
        }
        
        $this->db->order_by('idcompra', 'desc');
        $this->db->limit($limit, $start);

        if($loja_id != 'all' && $loja_id != NULL){
            $this->db->where('loja_id =', $loja_id);
        }
        $data = $this->db->get('historicocompras')->result_array();
        
        $pedidos = null;
        $i=0;
        
        foreach($data as $aux){
            $this->db->select('cliente_nome');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $this->db->where('idStatusCompra', $aux['statusPagamento']);
            $this->db->select('nomeStatusCompra');
            $sts = $this->db->get('statuscompras')->row_array();
            
            if($sts){
                $sts = $sts['nomeStatusCompra'];
            } else {
                $sts = 'Status não encontrado';
            }
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
            } else {
                $nome_cliente       = 'Cliente excluído';
            }
                $this->db->where('id', $aux['loja_id']);
            $loja = $this->db->get('loja')->row_array();
                
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente'       => $nome_cliente,
                'total'         => $aux['valorCompra'] + $aux['valorFrete'] - $aux['desconto'],
                'cadastro'      => $aux['dataCompra'],
                'status'        => $sts,
                'loja'          => $loja ? $loja['nome'] : 'Loja não encontrada',
                
            );
            $i++;
        }
        
        return $pedidos;
    }
    
    /*public function getAllPedidosFiltro($filter, $limit, $start, $loja_id){
        $this->db->select('idcompra, idClient, valorCompra, dataCompra, statusPagamento, valorFrete, desconto, loja_id');
        if($filter != 0){
            $this->db->like('idcompra', $filter, 'none');
            
            $this->db->or_like('idClient', $filter, 'both');
            
            $this->db->or_like('valorCompra', $filter, 'both');
            
            $this->db->or_like('dataCompra', $filter, 'both');
            
            $this->db->or_like('statusPagamento', $filter, 'both');
            
            $this->db->or_like('cliente_nome', $filter, 'both');
            
            $this->db->or_like('nomeStatusCompra', $filter, 'both');
        }
        $data = $this->db->get('historicocompras')->result_array();
        
    }*/
    
    public function get_countFiltro($filter, $loja_id) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->join('statuscompras', 'historicocompras.statusPagamento = statuscompras.idStatusCompra');
        $this->db->join('cliente', 'historicocompras.idClient = cliente.cliente_id');
        if($filter != 0){
            $this->db->like('idcompra', $filter, 'both');
            $this->db->or_like('idClient', $filter, 'both');
            $this->db->or_like('valorCompra', $filter, 'both');
            $this->db->or_like('dataCompra', $filter, 'both');
            $this->db->or_like('statusPagamento', $filter, 'both');
            $this->db->or_like('cliente_nome', $filter, 'both');
            $this->db->or_like('nomeStatusCompra', $filter, 'both');
        }
        if($loja_id != 'all'){
            $this->db->where('loja_id =', $loja_id);
        }
        $a = $this->db->get('historicocompras')->row_array();
        return $a['pages'];
    }
    
    public function getProdutosAll(){
        $this->db->select("produto_id, produto_nome");
        $a = $this->db->get('produtos')->result_array();
        return $a;
    }
    
    public function getProduto($id){
        $this->db->select("produto_valor");
        $this->db->where('produto_id', $id);
        return $this->db->get('produtos')->row_array();
    }
    
    public function retrievePedido($id){
        $this->db->where('idcompra', $id);
        $a = $this->db->get('historicocompras')->row_array();
        return $a;
    }
    
    public function validarEndereco($endereco, $position){
        if(isset($endereco[$position])){
            return $endereco[$position];
        } else {
            return "Não encontrado";
        }
    }
    
    public function get_countTroca($id, $data){
        $this->db->select(" COUNT(troca_id) as pages");
        if($data){
            $this->db->where('troca_data >=', $data);
            $this->db->where('troca_data <=', $data);
        }
        if($id != 'all'){
            $this->db->where('troca_loja_id =', $id);
        }
        $a = $this->db->get('trocas')->row_array();
        return $a['pages'];
    }
    
    public function getAllTrocas($limit, $start, $id, $data){
        if($data){
            $this->db->where('troca_data >=', $data);
            $this->db->where('troca_data <=', $data);
        }
        if($id != 'all'){
            $this->db->where('troca_loja_id =', $id);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('troca_id', 'DESC');
        $a = $this->db->get('trocas')->result_array();
        
        
        if($a){
            for($i=0; $i<count($a); $i++){
                $produtoGarList = $produtoDevList = "";
                $helper = explode("¬", $a[$i]['troca_produtosLista']);
                for($j=0; $j<count($helper); $j++){
                    if($j>0){
                        $produtoGarList .= " | ";
                    }
                    $this->db->where('produto_id =', $helper[$j]);
                    $prod = $this->db->get('produtos')->row_array();
                    if($prod){
                        $produtoGarList .= $prod['produto_nome'];
                    }
                }
                
                $lobster = explode("¬", $a[$i]['troca_produtoEntrada']);
                for($k=0; $k<count($lobster); $k++){
                    if($k>0){
                        $produtoDevList .= " | ";
                    }
                    $this->db->where('produto_id =', $lobster[$k]);
                    $prod = $this->db->get('produtos')->row_array();
                    if($prod){
                        $produtoDevList .= $prod['produto_nome'];
                    }
                }
                
                if($a[$i]['troca_diferenca'] > 0){
                    $isDif = "Sim";
                    $this->db->where('id_forma =', $a[$i]['troca_diferPagam']);
                    $pag = $this->db->get('formas_pagamento')->row_array();
                    $dife = "R$ ".number_format($a[$i]['troca_diferenca'], "2", ",", " ")." - ".$pag['nome_forma'];
                }else{
                    $isDif = "Não";
                    $dife = "----";
                }
                
                $this->db->where('cliente_id', $a[$i]['troca_ClienteID']);
                $this->db->select('cliente_nome');
                $nomeCliente = $this->db->get('cliente')->row_array();
                
                $trocas[$i] = array(
                    'troca_id'      => $a[$i]['troca_id'],
                    'troca_Cliente' => $nomeCliente['cliente_nome'],
                    'produtosG'     => $produtoGarList,
                    'produtosD'     => $produtoDevList,
                    'isDiferenca'   => $isDif,
                    'diferenca'     => $dife,
                    'data'          => date("d/m/Y", strtotime($a[$i]['troca_data'])),
                );
            }
        }else{
            $trocas = null;
        }
        return $trocas;
    }
    
}