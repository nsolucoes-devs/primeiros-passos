<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends MY_Controller {
 
        public function insert(){
            $this->load->database();
            $this->load->model('carrinhomodel');
            
            $produto        = $this->input->post('idProduto');
            $quantidade     = $this->input->post('quantidade');
            $ipaddress = '';
            
            if($this->session->userdata('user_id')){
                $ipaddress = $this->session->userdata('user_id');
                $cliente = 'online';
                $aux = $this->carrinhomodel->cartshopping($ipaddress);
            }else{
                $ipaddress = $this-> retrieveIp();
                $cliente = 'offline';
                $aux = $this->carrinhomodel->tempcart($ipaddress);
            }    
            
            if($aux['listProdutosId'] != ""){
                $aux['listProdutosId'] .= "¬".$produto;
                $aux['qtdProdutos'] .= "¬".$quantidade;
            }else{
                $aux['listProdutosId'] = $produto;
                $aux['qtdProdutos'] = $quantidade;
            }
            
            if($cliente == 'offline'){
                $carrinho = array(
                    'idTempCart'        => $aux['idTempCart'],
                    'ipHostRemote'      => $aux['ipHostRemote'],
                    'dataHoraCompra'    => $aux['dataHoraCompra'],
                    'listProdutosId'    => $aux['listProdutosId'],  
                    'qtdProdutos'       => $aux['qtdProdutos'],  
                    'statusCompra'      => '1' 
                );
                $this->carrinhomodel->updateTempcart($carrinho);
            }else{
                $carrinho = array(
                    'idcard'            => $aux['idcard'],
                    'idClient'          => $aux['idClient'],
                    'dataHoraCompra'    => $aux['dataHoraCompra'],
                    'listProdutosId'    => $aux['listaProdutosId'],  
                    'qtdProdutos'       => $aux['qtdProdutos'],  
                    'statusCompra'      => '1'  
                );
                $this->carrinhomodel->updateCartShopping($carrinho);
            }
        $this->carrinhoView($carrinho);
        }
        
        public function carrinhoView($carrinho = null){
            $this->load->database();
            $this->load->model('carrinhomodel');
            $this->load->model('produtos');
            
            if($carrinho == null){
                $listacarrinho = array();
                $cliente = "";
                $cart = "";
                $dados['vazio'] = true;
            }else{
                $produtos       = explode("¬", $carrinho['listProdutosId']);
                $quantidades    = explode("¬", $carrinho['qtdProdutos']);
                
                if($this->session->userdata('user_id')){
                    $cliente        = $carrinho['idClient'];
                    $cart           = "U-".$carrinho['idcard']; 
                }else{
                    $cliente        = $carrinho['ipHostRemote'];
                    $cart           = "T-".$carrinho['idTempCart'];
                }
                for($i = 0; $i < count($produtos); $i++){
                    $aux = $this->carrinhomodel->rescueProduct($produtos[$i]);
                    $listacarrinho[$i] = array(
                        'idProduto'     => $produtos[$i],
                        'produto'       => $aux['produto_nome'],
                        'modelo'        => $aux['produto_modelo'],
                        'valor'         => $aux['produto_valor'],
                        'quantidade'    => $quantidades[$i],
                        );
                }
            }
            $dados['listacarrinho'] = $listacarrinho;
            $dados['cliente'] = $cliente;
            $dados['carrinho'] = $cart;

            $dadosHeader['idpag']               = "";
        	$dadosHeader['configs']             = "";
        	$dadosHeader['telefonedecontato']   = "";
        	$dadosHeader['produtos']            = $this->produtos->getAll();
        	
        	$dadosFooter = array(
        	    'facebook'  => "",
        	    'instagram' => "",
        	    'youtube'   => "",
        	);
	    
	        $this->load->view('recursos/header', $dadosHeader);
	        $this->load->view('carrinho', $dados);
	        $this->load->view('recursos/footer', $dadosFooter);
        }
        
        function retrieveIp(){
            $ipaddress = '';
            
            if(isset($_SERVER['HTTP_CLIENT_IP'])){
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            }elseif(isset($_SERVER['HTTP_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            }elseif(isset($_SERVER['REMOTE_ADDR'])){
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            }else{
                $ipaddress = 'UNKNOWN';
            }
            
            return $ipaddress;
        }
        
        

}