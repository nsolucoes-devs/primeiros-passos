<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpromocoes extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('produtos');
        $this->load->model('departamentos');
        $this->load->model('promocoes');
    }
    
    public function promocoes(){
        
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('0216886b85e598a495cf53b303ec5b54/f/' . $filtro . '/');
            $config["total_rows"] = $this->promocoes->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['promocoes']  = $this->promocoes->getAllFiltro($filtro, 10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('0216886b85e598a495cf53b303ec5b54/n/');
            $config["total_rows"] = $this->promocoes->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['promocoes']  = $this->promocoes->getAll(10, $page);
        
        }

        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $this->header(2);
        $this->load->view('restrito/promocoes', $data);
        $this->footer();
    }
    
    public function cadastro(){
        
        
        $data['departamentos'] = $this->departamentos->getAll();
        $data['produtos'] = $this->produtos->getAll();
        
        $this->header(2);
        $this->load->view('restrito/promocao', $data);
        $this->footer();
    }
    
    public function edita(){
        
        
        $id = $this->uri->segment(2);
        
        $data['promocao']       = $this->promocoes->get($id);
        $data['departamentos']  = $this->departamentos->getAll();
        $data['produtos']       = $this->produtos->getAll();
        
        $this->header(2);
        $this->load->view('restrito/editapromocao', $data);
        $this->footer();
    }
    
    public function ver(){
        
        
        $id = $this->uri->segment(2);
        
        $data['promocao']       = $this->promocoes->get($id);
        $data['departamentos']  = $this->departamentos->getAll();
        $data['produtos']       = $this->produtos->getAll();
        
        $this->header(2);
        $this->load->view('restrito/verpromocao', $data);
        $this->footer();
    }
    
    public function insert(){
        
        
                $itens = $this->input->post('produtos');
        $cont = 0;
        $produtos = "";
        $departamentos = "";
        
        if($itens){
            foreach($itens as $i){
                if($cont == 0){
                    $produtos .= $i;    
                } else {
                    $produtos .= '¬' . $i;
                }
                $cont++;
            }
        }
        
        $itens2 = $this->input->post('departamentos');
        $cont2 = 0;
        
        if($itens2){
            foreach($itens2 as $i){
                if($cont2 == 0){
                    $departamentos .= $i;    
                } else {
                    $departamentos .= '¬' . $i;
                }
                $cont2++;
            }
        } 
        
        $promocao = array(
            'promocao_titulo'           => $this->input->post('titulo'),
            'promocao_preco'            => $this->input->post('preco'),
            'promocao_preco_ativo'      => $this->input->post('preco_ativo'),
            'promocao_desconto'         => $this->input->post('desconto'),
            'promocao_desconto_ativo'   => $this->input->post('desconto_ativo'),
            'promocao_datainicial'      => $this->input->post('datainicial'),
            'promocao_datafinal'        => $this->input->post('datafinal'),
            'promocao_datafinal_ativo'  => $this->input->post('datafinal_ativo'),
            'promocao_cupom'            => $this->input->post('cupom'),
            'promocao_cupom_ativo'      => $this->input->post('cupom_ativo'),
            'promocao_produtos'         => $produtos,
            'promocao_departamentos'    => $departamentos,
            
        );
        
        $this->promocoes->insert($promocao);
        
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('0216886b85e598a495cf53b303ec5b54'));
    }
    
    
    public function update(){
        
        
        $id = $this->input->post('id');
        
        $itens = $this->input->post('produtos');
        $cont = 0;
        $produtos = "";
        $departamentos = "";
        
        if($itens){
            foreach($itens as $i){
                if($cont == 0){
                    $produtos .= $i;    
                } else {
                    $produtos .= '¬' . $i;
                }
                $cont++;
            }
        }
        
        $itens2 = $this->input->post('departamentos');
        $cont2 = 0;
        
        if($itens2){
            foreach($itens2 as $i){
                if($cont2 == 0){
                    $departamentos .= $i;    
                } else {
                    $departamentos .= '¬' . $i;
                }
                $cont2++;
            }
        } 
        
        $promocao = array(
            'promocao_titulo'           => $this->input->post('titulo'),
            'promocao_preco'            => $this->input->post('preco'),
            'promocao_preco_ativo'      => $this->input->post('preco_ativo'),
            'promocao_desconto'         => $this->input->post('desconto'),
            'promocao_desconto_ativo'   => $this->input->post('desconto_ativo'),
            'promocao_datainicial'      => $this->input->post('datainicial'),
            'promocao_datafinal'        => $this->input->post('datafinal'),
            'promocao_datafinal_ativo'  => $this->input->post('datafinal_ativo'),
            'promocao_cupom'            => $this->input->post('cupom'),
            'promocao_cupom_ativo'      => $this->input->post('cupom_ativo'),
            'promocao_produtos'         => $produtos,
            'promocao_departamentos'    => $departamentos,
            
        );
        
        $this->session->set_userdata('alert', 2);
        
        $this->promocoes->update($id, $promocao);
        
        redirect(base_url('0216886b85e598a495cf53b303ec5b54'));
    }
    
    public function delete(){
	    
	    
	    $id = $this->input->post('id');
	    $senha = md5($this->input->post('senha'));
	    
	    if($senha == $this->session->userdata('senha')){
	        $this->session->set_userdata('alert', 3);
	        $this->promocoes->delete($id);    
	    } else {
	        $this->logBlock();
	        $this->session->set_userdata('alert', 4);
	    }
	    
	    redirect(base_url('0216886b85e598a495cf53b303ec5b54'), 'refresh');
	}
	
	public function logBlock(){
        $this->load->model('Logger');
        $this->load->model('usuarios');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'log_ip'             => $_SERVER['REMOTE_ADDR'],
            'log_user_id'        => $this->session->userdata('user_id'),
            'log_nome'           => $this->session->userdata('nome'),
            'log_data'           => date('Y-m-d'),
            'log_hora'           => date('H:i:s'),
            'log_funcao'         => '0216886b85e598a495cf53b303ec5b54',  
            'log_tipo'           => 'SENHA',  
        );
        
        
        if($this->session->userdata('user_block')){
            $cont = $this->session->userdata('user_block');
            $this->session->set_userdata('user_block', $cont + 1);
        } else {
            $this->session->set_userdata('user_block', 1);
        }
        
        if($this->session->userdata('user_block') >= 3){
            $user_content = array(
                'ativo' => 0,
            );
            $this->usuarios->atualizarUsuario($user_content, $this->session->userdata('user_id'));
            
            $this->session->unset_userdata('user_block');
            
            redirect(base_url('dc28f82848daefd26e2f0f38094d5818'));
        }
        
        
        $this->logger->logBlock($log);
    }
    
}