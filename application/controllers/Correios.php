<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correios extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('correiosmodel');
        $this->load->model('carrinhomodel');
    }
    
    public function updateCorreios(){
        $dados = array(
            'idDadosCorreios'   => $this->input->post('idDadosCorreios'),
            'cdServico'         => $this->input->post('cdServico'),
            'tipoServico'       => $this->input->post('tipoServico'),
            'cepOrigem'         => $this->input->post('cepOrigem'),
            'dadosAtivo'        => $this->input->post('dadosAtivo'), 
        );
        $this->correiosmodel->updateDados($dados);
    }
    
    public function frete(){
        if($this->input->post('carrinho') !== null){
            $caixa = $this->carrinhomodel->caixa($this->input->post('carrinho'));
        }else{
            $caixa = array(
                'altura'        => 10.0,
                'largura'       => 25.0,
                'comprimento'   => 30.0,
                'peso'          => '1,0',
                'diametro'      => "",
                );
        }
        $dados = $this->correiosmodel->dados();
        $i=0;
        foreach($dados as $dds){
            if($dds['dadosAtivo'] == 1){
                $nCdServico             =   $dds['cdServico'];
                $sCepOrigem             =   $dds['cepOrigem'];
                //$sCepDestino            =   '38082230';
                $nVlPeso                =   '2,357';
                $nVlComprimento         =   15.0;//Comprimento da encomenda (incluindo embalagem), em centímetros.
                $nVlAltura              =   15.0;//Altura da encomenda (incluindo embalagem), em centímetros. 
                $nVlLargura             =   15.0;//Largura da encomenda (incluindo embalagem), em centímetros
                $nVlDiametro            =   15.0;//Diâmetro da encomenda (incluindo embalagem), em centímetros.
                $sCepDestino            =   $this->input->post('cep');
                //$nVlPeso                =   $caixa['peso'];
                //$nVlComprimento         =   $caixa['comprimento'];
                //$nVlAltura              =   $caixa['altura'];
                //$nVlLargura             =   $caixa['largura'];
                //$nVlDiametro            =   $caixa['diametro'];
                
                $this->session->set_userdata("cep", $sCepDestino);
            
                $frete = $this->calcfrete($nCdServico, $sCepOrigem, $sCepDestino, $nVlPeso, $nVlComprimento, $nVlAltura, $nVlLargura, $nVlDiametro);
                
                $aux[$i] = array(
                    'servico'   => $dds['tipoServico'],
                    'valor'     => $frete['cServico']['Valor'],
                    'prazo'     => $frete['cServico']['PrazoEntrega'],
                    );
                $i++; 
            }
        }
        echo json_encode($aux);
    }

    public function calcfrete($nCdServico, $sCepOrigem, $sCepDestino, $nVlPeso, $nVlComprimento, $nVlAltura, $nVlLargura, $nVlDiametro){

        $nCdFormato             =   1; //1 – Formato caixa/pacote //2 – Formato rolo/prisma //3 – Envelope
        $sCdMaoPropria          =   'N';//Valores possíveis: S ou N (S – Sim, N – Não)
        $nVlValorDeclarado      =   0;//Se não optar pelo serviço informar zero.
        $sCdAvisoRecebimento    =   'N';//Valores possíveis: S ou N (S – Sim, N – Não)
        $StrRetorno             =   'xml';
        
        $correio = "https://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdServico=$nCdServico&sCepOrigem=$sCepOrigem&sCepDestino=$sCepDestino&nVlPeso=$nVlPeso&nCdFormato=$nCdFormato&nVlComprimento=$nVlComprimento&nVlAltura=$nVlAltura&nVlLargura=$nVlLargura&nVlDiametro=$nVlDiametro&sCdMaoPropria=$sCdMaoPropria&nVlValorDeclarado=$nVlValorDeclarado&sCdAvisoRecebimento=$sCdAvisoRecebimento&StrRetorno=$StrRetorno";

        $ch = curl_init($correio);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        $xml = simplexml_load_string($res);
        curl_close($ch);
        return json_decode(json_encode($xml), true);
    }
}