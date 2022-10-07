<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindepartamentos extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('departamentos');
    }
    
    public function departamentos(){
        
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('48b6bbfcf12b55d9b0e4c2ded7384bff/f/' . $filtro . '/');
            $config["total_rows"] = $this->departamentos->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['departamentos']  = $this->departamentos->getAllDepartamentosFiltro($filtro, 10, $page);
            $data['filtro']         = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('48b6bbfcf12b55d9b0e4c2ded7384bff/n/');
            $config["total_rows"] = $this->departamentos->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['departamentos']  = $this->departamentos->getAllDepartamentos(10, $page);
        }
        
        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $this->header(2);
        $this->load->view('restrito/departamentos', $data);
        $this->footer();
    }
    
    public function caddepartamento(){
        
        
        $data['subdepartamento'] = $this->departamentos->getAllSub();
        
        $this->header(2);
        $this->load->view('restrito/caddepartamento', $data);
        $this->footer();
    }
    
    public function editadepartamento(){
        
        
        $id = $this->uri->segment(2);
        
        $data['departamento'] = $this->departamentos->get($id);
        $data['subdepartamento'] = $this->departamentos->getAllSub();
        
        $this->header(2);
        $this->load->view('restrito/editadepartamento', $data);
        $this->footer();
    }
    
    public function departamento(){
        
        
        $id = $this->uri->segment(2);
        
        $data['departamento'] = $this->departamentos->get($id);
        $data['subdepartamento'] = $this->departamentos->getAllSub();
        
        $this->header(2);
        $this->load->view('restrito/verdepartamento', $data);
        $this->footer();
    }
    
    public function insert(){
        
        
        if($this->input->post('onmenu') == null || $this->input->post('onmenu') == 0){
            $onmenu = 0;
        } else {
            $onmenu = 1;
        }
        
        $departamento = array(
            'departamento_nome'         => $this->input->post('nome'),    
            'departamento_descricao'    => $this->input->post('descricao'),
            'departamento_pai'          => 0,
            'departamento_situacao'     => $this->input->post('situacao'),
            'departamento_onmenu'       => $onmenu,
        );
        
        $this->departamentos->insert($departamento);
        
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('48b6bbfcf12b55d9b0e4c2ded7384bff'));
    }
    
    public function update(){
        
        
        $id = $this->input->post('id');
        
        if($this->input->post('onmenu') == null || $this->input->post('onmenu') == ""){
            $onmenu = 0;
        } else {
            $onmenu = 1;
        }
        
        $departamento = array(
            'departamento_nome'         => $this->input->post('nome'),    
            'departamento_descricao'    => $this->input->post('descricao'),
            'departamento_pai'          => 0,
            'departamento_situacao'     => $this->input->post('situacao'),
            'departamento_onmenu'       => $onmenu,
        );
        
        $this->departamentos->update($id, $departamento);
        
        $this->session->set_userdata('alert', 2);
        
        redirect(base_url('48b6bbfcf12b55d9b0e4c2ded7384bff'));
    }
    
    public function delete(){
        
        
        $id = $this->input->post('id');
        
        $this->departamentos->delete($id);
        
        $this->session->set_userdata('alert', 3);
        
        redirect(base_url('48b6bbfcf12b55d9b0e4c2ded7384bff'));
    }
    
    
    /////////////////////////////////////////////////////////////////////////
    ////////////////////////// SUB DEPARTAMENTOS /////////////////////////////
    /////////////////////////////////////////////////////////////////////////
    
    public function subDepartamentos(){
        
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('admin/admindepartamentos/subDepartamentos/f/' . $filtro . '/');
            $config["total_rows"] = $this->departamentos->get_countSubFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 6;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
    
            $data['subdepartamentos']  = $this->departamentos->getAllSubDepartamentosFiltro($filtro, 10, $page);
            $data['filtro']         = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('admin/admindepartamentos/subDepartamentos/n/');
            $config["total_rows"] = $this->departamentos->get_countSub();
            $config["per_page"] = 10;
            $config["uri_segment"] = 5;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    
            $data['subdepartamentos']  = $this->departamentos->getAllSubDepartamentos(10, $page);
        }
        
        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $data['departamentos'] = $this->departamentos->getAllOnly();
        
        $this->header(2);
        $this->load->view('restrito/subdepartamentos', $data);
        $this->footer();
    }
    
    
    public function deleteSub(){
        
        
        $id = $this->input->post('id');
        
        $departamentos = $this->departamentos->getAll();
        
        foreach($departamentos as $d){
            $aux = explode('¬', $d['departamento_sub_id']);
            foreach($aux as $a){
                if($a == $id){
                    $this->session->set_userdata('alert', 4);
                    redirect(base_url('admin/admindepartamentos/subDepartamentos'));
                }
            }
        }
        
        $this->departamentos->deleteSub($id);
        
        $this->session->set_userdata('alert', 3);
        
        redirect(base_url('admin/admindepartamentos/subDepartamentos'));
    }
    
    
    public function insertSub(){
        
        
        if($this->input->post('onmenu') == null || $this->input->post('onmenu') == 0){
            $onmenu = 0;
        } else {
            $onmenu = 1;
        }
        
        $departamento = array(
            'departamento_nome'         => $this->input->post('nome'),    
            'departamento_descricao'    => $this->input->post('descricao'),
            'departamento_pai'          => $this->input->post('departamento'),
            'departamento_situacao'     => 1,
            'departamento_onmenu'       => $onmenu,
        );
        
        $this->departamentos->insert($departamento);
        
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('admin/admindepartamentos/subDepartamentos'));
    }
    
    public function editSub(){
        
        
        if($this->input->post('onmenu') == null || $this->input->post('onmenu') == 0){
            $onmenu = 0;
        } else {
            $onmenu = 1;
        }
        
        $departamento = array(
            'departamento_nome'         => $this->input->post('nome'),    
            'departamento_descricao'    => $this->input->post('descricao'),
            'departamento_pai'          => $this->input->post('departamento'),
            'departamento_situacao'     => 1,
            'departamento_onmenu'       => $onmenu,
        );
        
        $this->departamentos->update($departamento);
        
        $this->session->set_userdata('alert', 2);
        
        redirect(base_url('admin/admindepartamentos/subDepartamentos'));
    }
}