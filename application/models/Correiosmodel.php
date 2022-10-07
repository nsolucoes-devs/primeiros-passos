<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correiosmodel extends CI_Model {
    
    public function dados(){
        return $this->db->get('dadosCorreios')->result_array();
    }
    
    public function updateDados($dados){
        $this->db->update('dadosCorreios', $dados);
    }
    
    public function update($id, $dados){
        $this->db->where('idDadosCorreios', $id);
        $this->db->update('dadosCorreios', $dados);
    }
    
    public function frete($id){
        $this->db->select('valorTotal, pesoTotal, qtdProdutos, listProdutosId');
        $this->db->where('idTemp', $id);
        $aux = $this->db->get('cartunico')->row_array();
        
        $this->db->where('cep', $this->session->userdata('cliente_cep'));
        $cep = $this->db->get('cep')->row_array();

        $caixas = $this->calcCaixa($aux['listProdutosId'], $aux['qtdProdutos']);
        
        $this->db->where('dadosAtivo', 1);
        $this->db->where('idDadosCorreios >', 5);
        $this->db->where('idDadosCorreios >', 5);
        $a = $this->db->get('dadosCorreios')->result_array();
        $frete = $this->calcfrete($caixas);
        if($a){
            $diasextra = $a[0]['dias_entrega_extra'];    
        } else {
            $diasextra = 0;    
        }
        $diasFrete = 0;
        
        for($i=0; $i<count($frete); $i++){
            if($frete[$i]['erro'] != 0){
                $dados[$frete[$i]['servico']] = array('id' => 1, 'nome' => "Não foi possível calcular", 'msg' => "Não foi possível calcular", 'valor' => "Não foi possível calcular");
            }else{
                $dados[$frete[$i]['servico']] = array('id' => $i + 2, 'nome' => $frete[$i]['servico'], 'dias' => $frete[$i]['prazo']+$diasextra+1, 'valor' => $frete[$i]['valor']);
                
                if($frete[$i]['prazo'] > $diasFrete){
                    $diasFrete = $frete[$i]['prazo'];
                }
            }
        }
        
        
        
        foreach($a as $gratis ){
            if($gratis['cdServico'] == "00000"){
                $dias = $gratis['dias_entrega_extra']+1;
            }
            
            if($gratis['cdServico'] == "00001"){
                if($gratis['valorMinimo'] <= $aux['valorTotal']){
                    $dados['GRATIS'] = array('id' => 0, 'nome' => 'GRATIS', 'dias' => $gratis['dias_entrega_extra']+$diasFrete+1, 'valor' => 00.00);
                }
            }
            
            if($gratis['cdServico'] == "00002"){
                $regiao = explode("¬", $gratis['regiaoGratis']);
                $uf = explode("/", $cep['cep_cidadeuf']);
                if(in_array($uf[1] , $regiao)){
                    $dados['GRATIS'] = array('id' => 0, 'nome' => 'GRATIS', 'dias' => $gratis['dias_entrega_extra']+$diasFrete+1, 'valor' => 00.00);
                }
            }
            
            if($gratis['cdServico'] == "00003"){
                $regiao = explode("¬", $gratis['regiaoGratis']);
                if($cep){
                    $uf = explode("/", $cep['cep_cidadeuf']);
                    if(in_array($uf[1] , $regiao)){
                        if($gratis['valorMinimo'] <= $aux['valorTotal']){
                            $dados['GRATIS'] = array('id' => 0, 'nome' => 'GRATIS', 'dias' => $gratis['dias_entrega_extra']+$diasFrete+1, 'valor' => 00.00);
                        }
                    }
                }
            }
        }
        
        if($cep){
            $ufNovo = explode("/", $cep['cep_cidadeuf']);
        
            if($ufNovo[0] == 'Uberaba'){
                $dados['LOJA'] = array('id' => 33, 'nome' => 'Retirar na loja', 'dias' => 0, 'valor' => 00.00);
                $dados['MOTOBOY'] = array('id' => 34, 'nome' => 'Motoboy', 'dias' => 0, 'valor' => 00.00);
            }
        }
        
        return $dados;
    }

    
    public function calcCaixa($produtos, $quantidades, $peso = null){
        if(strpos($produtos, "¬")){
            $z = explode("¬", $produtos);
            $x = count($z);
        }else{
            $z[0] = $produtos;
            $x = 1;
        }
        if(strpos($quantidades, "¬")){
            $y = explode("¬", $quantidades);
            if(count($y) < $x){
                $x = count($y);
            }
        }else{
            $y[0] = $quantidades;
            $x = 1;
        }
        
        $helper = $volCub = $peso = 0;
        
        for($i = 0; $i < $x; $i++){
            $this->db->select('produto_comprimento, produto_largura, produto_altura, produto_peso');
            $this->db->where('produto_id', $z[$i]);
            $w = $this->db->get('produtos')->row_array();
            $vol = $w['produto_comprimento'] * $w['produto_largura'] * $w['produto_altura'];  
            $vol = $vol * $y[$i];
            $helper = $helper + $vol;
            $peso = ceil($peso + ($w['produto_peso'] * $y[$i])) ;
        }
        $caixa = 1;
        $volCub = ceil(pow($helper, 1/3));
        $flag = 0;
        
        while($flag == 0){
                if($peso < 1){
                    $peso = 1;
                }
                if($volCub < 11){
                    $volCub = 11;
                }
                
                if($volCub*3 > 200){
                    $volCub = ceil($volCub/2);
                    $peso = ceil($peso/2);
                    $caixa++;
                }elseif($peso > 30){
                    $volCub = ceil($volCub/2);
                    $peso = ceil($peso/2);
                    $caixa++;
                }elseif($volCub*3 <= 200 && $peso <= 30){
                    $flag = 1;
                }
                
        }
        
        $dados = array(
            'caixas'        => $caixa,
            'peso'          => $peso,
            'comprimento'   => $volCub,
            'altura'        => $volCub,
            'largura'       => $volCub,
            );
            
        if($volCub < 15){
            $dados['comprimento'] = 15;
        }
        
        return $dados;
    }

    function calcfrete($dados){
        $this->db->select('cdServico, tipoServico, cepOrigem');
        $this->db->where('dadosAtivo', 1);
        $this->db->where('idDadosCorreios <', 6);
        $a = $this->db->get('dadosCorreios')->result_array();
        $i=0;
        foreach($a as $correio){
            $nCdServico             =   $correio['cdServico'];
            $sCepOrigem             =   $correio['cepOrigem'];
            $sCepDestino            =   $this->session->userdata('cliente_cep');
            $nVlPeso                =   $dados['peso'];
            $nVlComprimento         =   $dados['comprimento'];//Comprimento da encomenda (incluindo embalagem), em centímetros.
            $nVlAltura              =   $dados['altura'];//Altura da encomenda (incluindo embalagem), em centímetros. 
            $nVlLargura             =   $dados['largura'];//Largura da encomenda (incluindo embalagem), em centímetros
            
            $frete = $this->chamaCorreio($nCdServico, $sCepOrigem, $sCepDestino, $nVlPeso, $nVlComprimento, $nVlAltura, $nVlLargura);
            
            $valor = $frete['cServico']['Valor'];
            
            if($frete['cServico']['Erro'] != 0){
                $aux[$i] = array(
                    'servico'   => $correio['tipoServico'],
                    'erro'      => $frete['cServico']['MsgErro'],
                    );
            }else{
                $aux[$i] = array(
                    'servico'   => $correio['tipoServico'],
                    'valor'     => $dados['caixas'] * (str_replace (",", ".", $valor)),
                    'prazo'     => $frete['cServico']['PrazoEntrega'],
                    'erro'      => 0,
                );
            }
            $i++;
        }
        return $aux;
    }

    public function chamaCorreio($nCdServico, $sCepOrigem, $sCepDestino, $nVlPeso, $nVlComprimento, $nVlAltura, $nVlLargura){

        $nCdFormato             =   1; //1 – Formato caixa/pacote //2 – Formato rolo/prisma //3 – Envelope
        $sCdMaoPropria          =   'N';//Valores possíveis: S ou N (S – Sim, N – Não)
        $nVlValorDeclarado      =   0;//Se não optar pelo serviço informar zero.
        $sCdAvisoRecebimento    =   'N';//Valores possíveis: S ou N (S – Sim, N – Não)
        $StrRetorno             =   'xml';
        
        $correio = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdServico=$nCdServico&sCepOrigem=$sCepOrigem&sCepDestino=$sCepDestino&nVlPeso=$nVlPeso&nCdFormato=$nCdFormato&nVlComprimento=$nVlComprimento&nVlAltura=$nVlAltura&nVlLargura=$nVlLargura&sCdMaoPropria=$sCdMaoPropria&nVlValorDeclarado=$nVlValorDeclarado&sCdAvisoRecebimento=$sCdAvisoRecebimento&StrRetorno=$StrRetorno";
                //  http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdServico=$nCdServico&sCepOrigem=$sCepOrigem&sCepDestino=$sCepDestino&nVlPeso=$nVlPeso&nCdFormato=$nCdFormato&nVlComprimento=$nVlComprimento&nVlAltura=$nVlAltura&nVlLargura=$nVlLargura&sCdMaoPropria=$sCdMaoPropria&nVlValorDeclarado=$nVlValorDeclarado&sCdAvisoRecebimento=$sCdAvisoRecebimento&StrRetorno=$StrRetorno";
        $ch = curl_init($correio);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        $xml = simplexml_load_string($res);
        curl_close($ch);
        return json_decode(json_encode($xml), true);
    }
    
    public function relatorioFrete(){
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $pedidos        = [];
        
        foreach($result as $aux){
            $this->db->select('cliente_nome, cliente_cpf, cliente_cidade, cliente_estado');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $total_geral = $total_geral + $aux['valorFrete'];
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
                $cpf_cliente        = $cliente['cliente_cpf'];
                $cidade_cliente     = $cliente['cliente_cidade'];
                $estado_cliente     = $cliente['cliente_estado'];
            } else {
                $nome_cliente       = 'Cliente excluído';
                $cpf_cliente        = 'Cliente excluído';
                $cidade_cliente     = 'Cliente excluído';
                $estado_cliente     = 'Cliente excluído';
            }
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente_nome'  => $nome_cliente,
                'cliente_cpf'   => $cpf_cliente,
                'cliente_cidade'=> $cidade_cliente,
                'cliente_estado'=> $estado_cliente,
                'data'          => $aux['dataCompra'],
                'valor'         => $aux['valorCompra'],
                'frete'         => $aux['valorFrete'],
                'desconto'      => $aux['desconto'],
            );
            $i++;
        }
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
    
    public function relatorioFreteFiltros($filtros){
        if($filtros['datainicio']){
            $this->db->where('dataCompra >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('dataCompra <=', $filtros['datafim']);
        }
        $result         = $this->db->get('historicocompras')->result_array();
        $i              = 0;
        $total_geral    = 0;
        $pedidos        = [];
        
        foreach($result as $aux){
            $this->db->select('cliente_nome, cliente_cpf, cliente_cidade, cliente_estado');
            $this->db->where('cliente_id', $aux['idClient']);
            $cliente = $this->db->get('cliente')->row_array();
            
            $total_geral = $total_geral + $aux['valorFrete'];
            
            $aux_endereco = explode('¬', $aux['enderecoCompra']);
            
            if($cliente){
                $nome_cliente       = $cliente['cliente_nome'];
                $cpf_cliente        = $cliente['cliente_cpf'];
                $cidade_cliente     = $cliente['cliente_cidade'];
                $estado_cliente     = $cliente['cliente_estado'];
            } else {
                $nome_cliente       = 'Cliente excluído';
                $cpf_cliente        = 'Cliente excluído';
                $cidade_cliente     = 'Cliente excluído';
                $estado_cliente     = 'Cliente excluído';
            }
            
            $pedidos[$i] = array(
                'idpedido'      => $aux['idcompra'],
                'cliente_nome'  => $nome_cliente,
                'cliente_cpf'   => $cpf_cliente,
                'cliente_cidade'=> $cidade_cliente,
                'cliente_estado'=> $estado_cliente,
                'data'          => $aux['dataCompra'],
                'valor'         => $aux['valorCompra'],
                'frete'         => $aux['valorFrete'],
                'desconto'      => $aux['desconto'],
            );
            $i++;
        }
        $data['pedidos']        = $pedidos;
        $data['total_geral']    = $total_geral;
        
        return $data;
    }
       
}





/*
<?php if(isset($frete)) { ?>
<div class="col-md-12" style="padding-right: 0!important">
<?php $flag = 0; foreach($frete as $f){ ?>
<?php if(isset($f['msg']) && $flag == 0){ $flag = 1;?>
<p style=" margin: 0"><?php echo $f['msg'];?></p>
<?php } else { ?>
<?php if($f['nome'] == 'Retirar na loja'){ ?>
<div class="radio">
<label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: black!important;"><?php echo $f['nome'] ?></b>: Apenas para grande SP - Grátis</label>
</div>
<?php } else if($f['nome'] == 'Motoboy'){ ?>
<div class="radio">
<label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: black!important;"><?php echo $f['nome'] ?></b>: Apenas para grande SP - Grátis</label>
</div>
<?php } else if($f['nome'] == 'TRANSPORTADORA'){ ?>
<div class="radio">
<label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: black!important;"><?php echo $f['nome'] ?>: </b><input style="display: none" type="text" name="outro_frete" id="outro_frete" placeholder="Digite a transportadora" class="form-control"></label>
</div>
<?php } else { ?>
<div class="radio">
<label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: black!important;"><?php echo $f['nome'] ?></b>: Entrega em <?php echo $f['dias'] ?> dia(s) - R$<?php echo number_format($f['valor'],2,',','.') ?></label>
</div>
<?php } ?>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
*/