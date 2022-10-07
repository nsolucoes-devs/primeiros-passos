<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminclientes extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('clientes');
        $this->load->model('lojasmodel');
    }
    
        
    public function clientes(){
        
        $this->load->library("pagination");
        
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('d2fb359e7478da4e7ec01ef527bdeb53/f/' . $filtro . '/');
            $config["total_rows"] = $this->clientes->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['clientes']  = $this->clientes->getAllClientesFiltro($filtro, 10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('d2fb359e7478da4e7ec01ef527bdeb53/n/');
            $config["total_rows"] = $this->clientes->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['clientes']  = $this->clientes->getAllClientes(10, $page);
        }
        
        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $this->header(3);
        $this->load->view('restrito/clientes', $data);
        $this->footer();
    }
    
    public function verCliente(){
        
        $this->load->model('comprasmodel');
        
        $id = $this->uri->segment(2);
        
        $data['cliente'] = $this->clientes->get($id);
        $data['pedidos'] = $this->comprasmodel->getAllPedidoByCliente($id);
        
        $this->header(3);
        $this->load->view('restrito/vercliente', $data);
        $this->footer();
    }
    
    public function cadastroCliente(){
        
        
        $data['lojas'] = $this->lojasmodel->getlojas();
        
        $this->header(3);
        $this->load->view('restrito/cliente', $data);
        $this->footer();
    }
    
    public function insertCliente(){
        $this->load->database();
        $this->load->model('clientes');
        
        $senha = md5($this->input->post('senha'));
        $cliente = $this->clientes->getCPF($this->limpa($this->input->post('cpf')));
        $nome = $this->input->post('nome');
        
        if($nome != null || $nome != ""){
            if($cliente){
                $this->session->set_userdata('msg', 3);
            } else {
                if ($senha == ""){
                     $this->session->set_userdata('msg', 10);
                }else if (strlen ($senha) < 6){
                     $this->session->set_userdata('msg', 8);
                }else{
                $cliente = array(
                    'cliente_nome'          => mb_strtoupper($this->input->post('nome')),    
                    'cliente_cpf'           => removerCaracteresEspeciaiss($this->input->post('cpf')),
                    
                    
                    'cliente_nascimento'       => $this->input->post('nascimento'),
                    'cliente_email'            => $this->input->post('email'),
                    'cliente_telefone'         => removerCaracteresEspeciaiss($this->input->post('telefone')),
                    'cliente_genero'           => $this->input->post('genero'),
                    'cliente_cep'              => removerCaracteresEspeciaiss($this->input->post('cep')),
                    'cliente_endereco'         => $this->input->post('rua'),
                    'cliente_numero'           => $this->input->post('numero'),
                    'cliente_loja'             => $this->input->post('lojas'),
                    'cliente_complemento'      => $this->input->post('complemento'),
                    'cliente_bairro'           => $this->input->post('bairro'),
                    'cliente_cidade'           => $this->input->post('cidade'),
                    'cliente_estado'           => $this->input->post('estado'),
                    
                    
                    'cliente_senha'         => md5($this->input->post('senha')),
                    'cliente_ativo'         => 1,
                    'cliente_datacadastro'  => date('Y-m-d'),
                );
                
                $id = $this->clientes->insert($cliente);
                
                }   
            }
        }else{
            $this->session->set_userdata('msg', 7);
        }
        
      redirect(base_url('d2fb359e7478da4e7ec01ef527bdeb53'));
    }
    
    public function bloquearCliente(){
        
        
        $id = $this->input->post('id');
        $senha = md5($this->input->post('senha'));
        
        if($senha == $this->session->userdata('senha')){
           $cliente = array(
                'cliente_ativo' => 0,
            );
            
            // #6 - Chamada da função para gerar log de cliente bloqueado.
            
	        $client_content = $this->clientes->get($id);
	        $dados = array(
	            'cliente_id'    =>  $id,    
	            'cliente_nome'  =>  $client_content['cliente_nome'],
	            'status'        => 'Bloquear',
	        );
	        $this->logCliente($dados);
	        
	        // Fim #6
            
            
            $this->clientes->update($id, $cliente);
            
            $this->session->set_userdata('alert', 1);
        } else {
            $this->logBlock();
            $this->session->set_userdata('alert', 2);
        }
        
        redirect(base_url('d2fb359e7478da4e7ec01ef527bdeb53'));
        
    }
    
    public function desbloquearCliente(){
        
        
        $id = $this->input->post('id2');
        $senha = md5($this->input->post('senha2'));
        
        if($senha == $this->session->userdata('senha')){
           $cliente = array(
                'cliente_ativo' => 1,
            );
            
            // #7 - Chamada da função para gerar log de cliente desbloqueado.
            
	        $client_content = $this->clientes->get($id);
	        $dados = array(
	            'cliente_id'    => $id,    
	            'cliente_nome'  => $client_content['cliente_nome'],
	            'status'        => 'desbloquear',
	        );
	        $this->logCliente($dados);
	        
	        // Fim #7
            
            $this->clientes->update($id, $cliente);
            
            $this->session->set_userdata('alert', 3);
        } else {
            $this->logBlock();
            $this->session->set_userdata('alert', 4);
        }
        
        redirect(base_url('d2fb359e7478da4e7ec01ef527bdeb53'));
        
    }
    
    public function dinamicoGetCliente(){
        
        
        echo json_encode($this->clientes->get($this->input->post('id')));
    }
    
    
    public function logCliente($dados){
        $this->load->model('Logger');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'logcliente_ip'             => $_SERVER['REMOTE_ADDR'],
            'logcliente_user_id'        => $this->session->userdata('user_id'),
            'logcliente_data'           => date('Y-m-d'),
            'logcliente_hora'           => date('H:i:s'),
            'logcliente_cliente_nome'   => $dados['cliente_nome'],  
            'logcliente_cliente_id'     => $dados['cliente_id'],  
            'logcliente_tipo'           => $dados['status'],  
        );
        
        $this->logger->logCliente($log);
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
            'log_funcao'         => 'd2fb359e7478da4e7ec01ef527bdeb53',  
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
    
    public function excluircliente(){
        
        
    $id = $this->uri->segment(4);

    $this->clientes->excluirCliente($id);
    
    redirect(base_url('d2fb359e7478da4e7ec01ef527bdeb53'));
    
    }
    
    public function editarcliente(){
        
        
        $id = $this->uri->segment(4);
        
        $data['lojas'] = $this->lojasmodel->getlojas();
        $data['cliente'] = $this->clientes->get($id);
        
        $this->header(3);
        $this->load->view('restrito/editacliente', $data);
        $this->footer();
    }
    
    public function updateCliente(){
	    
	    
	    $id = $this->input->post('id');
	    
	    $new = array(
	        'cliente_nome'        => $this->input->post('nome'),
	        'cliente_cpf'         => removerCaracteresEspeciaiss($this->input->post('cpf')),
	        'cliente_nascimento'  => $this->input->post('nascimento'),
	        'cliente_email'       => $this->input->post('email'),
	        'cliente_telefone'    => removerCaracteresEspeciaiss($this->input->post('telefone')),
	        'cliente_genero'      => $this->input->post('genero'),
	        'cliente_loja'        => $this->input->post('lojas'),
	        'cliente_senha'       => md5($this->input->post('senha')),
	        'cliente_cep'         => removerCaracteresEspeciaiss($this->input->post('cep')),
	        'cliente_endereco'    => $this->input->post('rua'),
	        'cliente_numero'      => $this->input->post('numero'),
	        'cliente_bairro'      => $this->input->post('bairro'),
	        'cliente_cidade'      => $this->input->post('cidade'),
	        'cliente_estado'      => $this->input->post('estado'),
	        'cliente_complemento' => $this->input->post('complemento'),
	        'cliente_datacadastro'=> date('Y-m-d'),
	    );
	    
	    $this->clientes->update($id, $new);
	    
	    Redirect('admin/adminclientes/clientes');
	    
	}
}