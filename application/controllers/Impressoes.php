<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressoes extends Admin_Controller {
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
    }
    
    public function geraCupom($id){
        
        if($id != null){
            
            $this->load->database();
            $this->load->model('pdv/caixamodel');
            $a = $this->caixamodel->lojaCupom($id);
            
            if($a != null) {
                $data = array(
                    'venda'         => $a['venda'],
                    'loja'          => $a['loja'],
                    'vendedor'      => $a['vendedor'],
                    'cliente'       => $a['cliente'],
                    'desconto'      => $a['desconto'],
                    'frete'         => $a['frete'],
                    'lastValue'     => $a['lastValue'],
                    'pagamento'     => $a['pagamento'],
                );
                
                if($a['acrescimo'] != '0.00' && $a['acrescimo'] != 0.00){
                    $data['acrescimo'] = $a['acrescimo'];
                }
                    
                $this->load->view('relatorio/cupom', $data);
            } else {
                echo "<script>window.close();</script>";
            }
        } else {
            echo "<script>window.close();</script>";
        }
    }
    
    public function fechaCaixa(){
        $this->load->database();
        $this->load->model('pdv/caixamodel');
        $loja = $this->caixamodel->lojaCupom2($this->session->userdata("loja_id"));
        $vendas = $this->caixamodel->vendasDia($this->session->userdata("loja_id"));
        //$loja = $this->caixamodel->lojaCupom(25);
        //$vendas = $this->caixamodel->vendasDia(25);
        $fechado = $this->caixamodel->formasCash($this->session->userdata("loja_id"));
        $data = array(
            'dia'       => date('d-m-Y'),
            'loja'      => $loja,
            'vendas'    => $vendas,
            'formas'    => $fechado,
            );
        $this->load->view('relatorio/fechamentoCaixa', $data);
    }
}