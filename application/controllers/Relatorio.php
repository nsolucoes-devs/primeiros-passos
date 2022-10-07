<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends MY_Controller {
    
    public function pedidosDetalhado(){
        $this->load->view('restrito/relatorios/pedidosdetalhado');
    }
    
    public function pedidoSintetico(){
        $this->load->view('restrito/relatorios/pedidosintetico');
    }
    
    public function entrega(){
        $this->load->view('restrito/relatorios/entrega');
    }
   
}