<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvendedores extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('vendedores');
    }
    
    public function vendedores(){
        
        $this->load->library("pagination");
        
        $filtro = "";
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(4) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(5))); 
        }
        
        $config                 = array();
        $config["per_page"]     = 10;
        $config["total_rows"]   = $this->vendedores->get_count($filtro);
        $uri_segment            = 6;
        
        if($filtro){
            $config["base_url"] = base_url('admin/adminvendedores/vendedores/f/' . $filtro . '/');
        } else {
            $config["base_url"] = base_url('admin/adminvendedores/vendedores/n/');
            $uri_segment = 5;
        }
            
        $config["uri_segment"] = $uri_segment; 
            
        $this->pagination->initialize($config);
            
        $data['links'] = $this->pagination->create_links();
            
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
    
        $data['vendedores']  = $this->vendedores->getAllPagination($filtro, 10, $page);
        $data['filtro']    = $filtro;

        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }else {
            $data['alert'] = null;
        }

        $this->header(2);
        $this->load->view('restrito/vendedores', $data);
        $this->footer();
    }
    
    public function insertVendedor(){
        
        
        $vendedor = array(
            'vendedor_nome'         => $this->input->post('cad_nome'),    
            'vendedor_whats'        => $this->limpa($this->input->post('cad_whats')),
            'vendedor_prioridade'   => $this->input->post('cad_prioridade'),
        );
        
        $id = $this->vendedores->insert($vendedor);
        
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
    
    public function updateVendedor(){
        
        
        $id    = $this->input->post('id_editar');
        
        $vendedor = array(
            'vendedor_nome'         => $this->input->post('editar_nome'),    
            'vendedor_whats'        => $this->limpa($this->input->post('editar_whats')),
            'vendedor_prioridade'   => $this->input->post('editar_prioridade'),
        );
        
        $this->vendedores->update($id, $vendedor);
    
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
	
	public function excluirVendedor(){
	   
        
       $this->vendedores->delete($this->input->post('id_excluir'));
        
       $this->session->set_userdata('alert', 3);
            
       redirect(base_url('8fb192af45f75504361d0011c1677415'));
	}
	
	public function getVendedorId(){
	    
	    
	    $id = $this->input->post('id');
	    
	    $a = $this->vendedores->get($id);
	    
	    echo json_encode($a);
	}
    
}