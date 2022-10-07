<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminopcoes extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('opcoes');
        $this->load->model('produtos');
    }
    
    public function opcoes(){
        
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(4) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(5))); 
        }
        
        $config = array();
        $config["per_page"] = 10;
        $config["total_rows"] = $this->opcoes->get_countFiltro($filtro);
        
        $urlSegment = 6;
        
        if($filtro){
            $config["base_url"] = base_url('admin/adminopcoes/opcoes/f/' . $filtro . '/');
            
            $data['filtro']    = $filtro;
        } else {
            $config["base_url"] = base_url('admin/adminopcoes/opcoes/n/');
            
            $urlSegment = 5;
        }  
            
        $config["uri_segment"] = $urlSegment;
        
        $this->pagination->initialize($config);
        
        $data['links'] = $this->pagination->create_links();
        
        $page = ($this->uri->segment($urlSegment)) ? $this->uri->segment($urlSegment) : 0;

        $data['opcoes']  = $this->opcoes->getAllOpcoesFiltro($filtro, 10, $page);
        
        if($this->session->userdata('produtosmarca')){
            $data['produtosmarca'] = $this->session->userdata('produtosmarca');
            $this->session->unset_userdata('produtosmarca');
        }else {
            $data['produtosmarca'] = null;
        }
        
        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }else {
            $data['alert'] = null;
        }
        
        $this->header(2);
        $this->load->view('restrito/opcoes', $data);
        $this->footer();
    }
    
    public function insertOpcao(){
        
        
        $opcao = array(
            'opcao_nome'         => $this->input->post('nome'),    
            'opcao_categoria'    => $this->input->post('categoria'),
        );
        
        $this->opcoes->insert($opcao);
        
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('admin/adminopcoes/opcoes'));
    }
    
    public function updateOpcao(){
        
        
        $id = $this->input->post('id_editar');
        
        $marca = array(
            'opcao_nome'        => $this->input->post('editarNome'),
            'opcao_categoria'   => $this->input->post('editarCategoria'),
        );
        
        $this->opcoes->update($id, $marca);
    
        redirect(base_url('admin/adminopcoes/opcoes'));
    }
	
	public function excluirOpcao(){
	   
	    
	   $produtos = $this->produtos->getAll();
	   $id = $this->input->post('id_excluir');
	   
	   $itens = "";
	   $existe = false;
	   
	   $tamanhos = $this->produtos->getAllProdutosByOpcaoTamanho($id);
	   
	   $cores = $this->produtos->getAllProdutosByOpcaoCor($id);
	   
	   foreach($tamanhos as $p){
	        $itens .="<br>". $p['produto_nome'] . " <br>";
            $existe = true;
	   }
	   
	   foreach($cores as $p){
	        $itens .="<br>". $p['produto_nome'] . " <br>";
            $existe = true;
	   }
          
       if ($existe == true){
           $this->session->set_userdata('produtosmarca', $itens);
       }else{
            $this->opcoes->delete($id);
        
            $this->session->set_userdata('alert', 3);
       }
            
       redirect(base_url('admin/adminopcoes/opcoes'));
	}
	
	public function dinamicoAdicionarOpcao(){
        
        
        $opcao = array(
            'opcao_nome'        => $this->input->post('nome'),    
            'opcao_categoria'   => $this->input->post('categoria'),    
        );
        
        $id = $this->opcoes->insert($opcao);
        
        $array = array(
            'id'        => $id,
            'nome'      => $this->input->post('nome'),
            'categoria' => $this->input->post('categoria'),   
        );
        
        echo json_encode($array);
    }
    
    public function dinamicoAdicionarSelected(){
        

        echo json_encode($this->opcoes->getAllByOp($this->input->post('categoria')));
    }
    
}