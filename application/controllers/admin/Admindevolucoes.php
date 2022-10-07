<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindevolucoes extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('devolucoes');
        $this->load->model('cadastrosmodel');
    }
    
    public function devolucoes(){
        
        $this->load->library("pagination");
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(4) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(5))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('aec5e956c610cf9b6445c40befc0e850/f/' . $filtro . '/');
            $config["total_rows"] = $this->devolucoes->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 6;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
    
            $devolucoes  = $this->devolucoes->getAllFiltro($filtro,10, $page);
            $data['filtro']      = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('aec5e956c610cf9b6445c40befc0e850/n');
            $config["total_rows"] = $this->devolucoes->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 5;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    
            $devolucoes  = $this->devolucoes->getAll(10, $page);
        }
        
        $cont_devolucao = 0;
        
        foreach($devolucoes as $d){
            $status = $this->cadastrosmodel->getStatusById($d['reembolso_status']);
            
            $devolucoes[$cont_devolucao] = array(
                'reembolso_id'          => $d['reembolso_id'],
                'reembolso_protocolo'   => $d['reembolso_protocolo'],
                'reembolso_nome'        => $d['reembolso_nome'],
                'reembolso_cpf'         => $d['reembolso_cpf'],
                'reembolso_data'        => $d['reembolso_data'],
                'reembolso_email'       => $d['reembolso_email'],
                'reembolso_celular'     => $d['reembolso_celular'],
                'reembolso_status'      => $status['nomeStatusCompra'],
            );
            $cont_devolucao++;
        }
        
        if($this->session->userdata('msg')){
            $data['msg'] = $this->session->userdata('msg');
            $this->session->unset_userdata('msg');
        }
        
        $data['status'] = $this->cadastrosmodel->getStatus();
        $data['devolucoes'] = $devolucoes;
        
        $this->header(4);
        $this->load->view('restrito/devolucoes', $data);
        $this->footer();
    }
    
    public function getReembolso(){
        
        
        $reembolso = $this->devolucoes->getReembolso($this->input->post('id'));
        
        echo json_encode($reembolso);
    }
    
    public function alterarStatus(){
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $reembolso = $this->devolucoes->getReembolso($this->input->post('id_reembolso'));
        $reembolso['reembolso_status'] = $this->input->post('status_enviar');
        $senha = md5($this->input->post('senha'));
        
        if($senha == $this->session->userdata('senha')){
            
            // #10 - Chamada da função para gerar log de estorno.
            
	        $dados = array(
	            'reembolso_pedido_id'    => $reembolso['reembolso_pedido_id'],    
	            'reembolso_protocolo'    => $reembolso['reembolso_protocolo'],    
	            'reembolso_status'       => $reembolso['reembolso_status'],    
	        );
	        $this->logEstorno($dados);
	        
	        // Fim #10
	        
	        $historico = array(
	            'historico_data'        => date('Y-m-d'),    
	            'historico_hora'        => date('H:i:s'),
	            'historico_comentario'  => $this->input->post('comentario_enviar'),
	            'historico_pedido_id'   => $reembolso['reembolso_pedido_id'],
	            'historico_reembolso_id'=> $reembolso['reembolso_id'],
	            'historico_status'      => $this->input->post('status_enviar'),
	        );
	        
	        $this->cadastrosmodel->insertHistoricoDevolucao($historico);

            $this->devolucoes->editReembolso($reembolso, $this->input->post('id_reembolso'));
            $this->session->set_userdata('msg', 1);
            redirect(base_url('aec5e956c610cf9b6445c40befc0e850'));
        } else {
            
            $this->session->set_userdata('msg', 2);
            $this->logBlock();
            redirect(base_url('aec5e956c610cf9b6445c40befc0e850'));
        }
        
    }
    
    public function adicionarStatus(){
        
        
        $novo = array(
            'tipoStatusCompra'  => 'Devolucao',
            'nomeStatusCompra'  => $this->input->post('novo_status'),
        );
        
        $this->cadastrosmodel->insertStatus($novo);
        
        redirect(base_url('aec5e956c610cf9b6445c40befc0e850'));
    }
    
    
    public function logEstorno($dados){
        $this->load->model('Logger');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'log_ip'             => $_SERVER['REMOTE_ADDR'],
            'log_user_id'        => $this->session->userdata('user_id'),
            'log_user_nome'      => $this->session->userdata('nome'),
            'log_data'           => date('Y-m-d'),
            'log_hora'           => date('H:i:s'),
            'log_pedido_id'      => $dados['reembolso_pedido_id'],  
            'log_protocolo'      => $dados['reembolso_protocolo'],  
            'log_status'         => $dados['reembolso_status'],  
        );
        
        $this->logger->logEstorno($log);
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
            'log_funcao'         => 'aec5e956c610cf9b6445c40befc0e850',  
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