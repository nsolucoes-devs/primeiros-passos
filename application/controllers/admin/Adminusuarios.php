<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminusuarios extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('usuarios');
        $this->load->model('tipousuarios');
        $this->load->model('funcionariosmodel');
    }
    
    public function usuarios(){
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('0d658457c62859e2c93026f9f70ce219/f/' . $filtro . '/');
            $config["total_rows"] = $this->usuarios->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['usuarios']  = $this->usuarios->getAllUsuariosFiltro($filtro,10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('0d658457c62859e2c93026f9f70ce219/n/');
            $config["total_rows"] = $this->usuarios->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['usuarios']  = $this->usuarios->getAllUsuarios(10, $page);
        }
        
        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $data['tipos'] = $this->tipousuarios->getAllTipo();
        $data['funcionarios'] = $this->funcionariosmodel->getFuncionarios();

        $this->header(3);
        $this->load->view('restrito/usuarios', $data);
        $this->footer();
    }
    
    public function adicionarAdmin(){
        $usuario = array(
            'nome_usuario'  => $this->input->post('nome'),
            'login_usuario' => $this->input->post('login'),
            'senha_usuario' => MD5($this->input->post('senha')),
            'perfil'        => 3,
            'telefone'      => $this->limpa($this->input->post('tel')),
            'email'         => $this->input->post('email'),
            'ativo'         => 1,
            'usuario_funcionario_id' => $this->input->post('funcionario'),
        );
        
        $this->session->set_userdata('alert', 1);
        
        $id = $this->usuarios->adicionarUsuario($usuario);

        redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    }
    
    public function getUserData(){
        $id = $this->input->post('id');
        
        $user = $this->usuarios->usuarioId($id);
        
        echo json_encode($user);
    }
    
    
    public function editAdmin(){
        $id = $this->input->post('user_id');
        $old = $this->usuarios->usuarioId($id);

        if($this->input->post('senha') != ""){
            $senha = MD5($this->input->post('senha'));
        }else{
            $senha = $old['senha_usuario'];
        }
        
        $usuario = array(
            'nome_usuario'  => $this->input->post('nome'),
            'login_usuario' => $this->input->post('login'),
            'senha_usuario' => $senha,
            'perfil'        => 3,/*$this->input->post('permissao')*/
            'telefone'      => $this->limpa($this->input->post('tel')),
            'email'         => $this->input->post('email'),
            'super'         => $old['super'],
            'ativo'         => $old['ativo'],
            'usuario_funcionario' => $this->input->post('funcionario'),
        );
        
        $this->session->set_userdata('alert', 2);
        
        $this->usuarios->atualizarUsuario($usuario, $id);
        
        redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    }
    
    public function excluirAdmin(){
        $id = $this->input->post('id_excluir');
        $senha = md5($this->input->post('senha'));
	    
	    if($senha == $this->session->userdata('senha')){
	        $this->session->set_userdata('alert', 3);
	        
	        // #8 - Chamada da função para gerar log de usuario bloqueado.
            
	        $usuario_content = $this->usuarios->get($id);
	        $dados = array(
	            'id_usuario'    => $id,    
	            'nome_usuario'  => $usuario_content['nome_usuario'],
	        );
	        $this->logUsuario($dados);
	        
	        // Fim #8
	        
	        $usuario = array(
	            'ativo'     => 0,    
	        );
	        
	        $this->usuarios->atualizarUsuario($usuario, $id);
	    } else {
	        $this->logBlock();
	        $this->session->set_userdata('alert', 4);
	    }

        redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    }
    
    public function excluirusuario(){
    $id = $_POST['id'];
    $html = $this->usuarios->excluirUsuario($id);
    echo json_encode($html);
    }
    
    
    public function desbloquearAdmin(){


        $id = $this->input->post('id_excluir2');
        $senha = md5($this->input->post('senha2'));
	    
	    if($senha == $this->session->userdata('senha')){
	        $this->session->set_userdata('alert', 5);
	        
	        // #8 - Chamada da função para gerar log de usuário desbloqueado.
            
	        $usuario_content = $this->usuarios->get($id);
	        $dados = array(
	            'id_usuario'    => $id,    
	            'nome_usuario'  => $usuario_content['nome_usuario'],
	        );
	        $this->logUsuario($dados);
	        
	        // Fim #8
	        
	        $usuario = array(
	            'ativo'     =>  1,    
	        );
	        
	        $this->usuarios->atualizarUsuario($usuario, $id);
	    } else {
	        $this->logBlock();
	        $this->session->set_userdata('alert', 4);
	    }

        redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    }
    
    public function alterarSenha(){

        
        $usuario['senha_usuario'] = MD5($this->input->post('senha'));
        
        $this->usuarios->atualizarUsuario($usuario, $this->session->userdata('user_id'));
        
        $this->session->set_userdata('senha', $usuario['senha_usuario']);
        $this->session->set_userdata('msg', 1);
        
        redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    }
    
    
    
    public function logUsuario($dados){
        $this->load->model('Logger');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'logusuario_ip'             => $_SERVER['REMOTE_ADDR'],
            'logusuario_user_id'        => $this->session->userdata('user_id'),
            'logusuario_data'           => date('Y-m-d'),
            'logusuario_hora'           => date('H:i:s'),
            'logusuario_usuario_nome'   => $dados['nome_usuario'],  
            'logusuario_usuario_id'     => $dados['id_usuario'],  
        );
        
        $this->logger->logUsuario($log);
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
            'log_funcao'         => '0d658457c62859e2c93026f9f70ce219',  
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
    
    
    
    
    