<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlojas extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('lojasmodel');
    }
    
    public function verLoja(){
        
        
        $data['lojas'] = $this->lojasmodel->getlojas();
        
        $this->header(8);
        $this->load->view('restrito/lojas', $data);
        $this->footer();
    }
    
    public function getlojaid(){
        
        
        $a = $this->lojasmodel->getloja($this->input->post('loja'));
        
        echo json_encode($a);
    }
    
    public function editloja(){
        
        
        $id = $this->input->post('id-loja-modal2');
        
        $new = array(
            'nome'             => $this->input->post('nome-loja-modal2'),
            'cep'              => $this->input->post('cep-loja-modal2'),
            'cidade'           => $this->input->post('cidade-loja-modal2'),
            'rua'              => $this->input->post('rua-loja-modal2'),
            'numero'           => $this->input->post('numero-loja-modal2'),
            'bairro'           => $this->input->post('bairro-loja-modal2'),
            'telefone'         => $this->input->post('tel-loja-modal2'),
            'estoque_separado' => $this->input->post('estoque-loja-modal2'),
        );
        
        $this->lojasmodel->updateloja($id, $new);
        
        redirect(base_url('admin/adminlojas/verLoja'));
    }
    
    public function cadloja(){
        
        
        $new = array(
            'nome'             => $this->input->post('cad-nome-loja'),
            'cep'              => $this->input->post('cad-cep-loja'),
            'cidade'           => $this->input->post('cad-cidade-loja'),
            'rua'              => $this->input->post('cad-rua-loja'),
            'numero'           => $this->input->post('cad-num-loja'),
            'bairro'           => $this->input->post('cad-bairro-loja'),
            'telefone'         => $this->input->post('cad-tel-loja'),
            'estoque_separado' => $this->input->post('cad-estoque-loja'),
        );
        
        $this->lojasmodel->insertloja($new);
        
        redirect(base_url('admin/adminlojas/verLoja'));
    }
    
    public function excluirloja(){
        $this->t_include();
        
        $id = $this->input->post('id-loja-ex');
        
        $this->lojasmodel->excluirloja($id);
        
        redirect(base_url('admin/adminlojas/verLoja'));
    }
}

?>