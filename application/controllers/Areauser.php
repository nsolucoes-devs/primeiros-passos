<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areauser extends MY_Controller {
    
    public function include(){
        $this->load->database();
	    $this->load->model('configs');
	    $this->load->model('clientes');
	    $this->load->model('produtos');
	    $this->load->model('departamentos');
    }
    
    public function entrar(){
        $this->include();
		
		if($this->session->userdata('msg')){
		    $data['msg'] = $this->session->userdata('msg');
		    $this->session->unset_userdata('msg');
		} else {
		    $data['msg'] = null;
		}
		
		$data['chave'] = $this->configs->getChave(1);
		
		if($this->session->userdata('cliente_logado') == 1){
		    redirect(base_url('92e97566397e7d998f610c34726e7a20'));
		} else {
		    $this->header();
            $this->load->view('login', $data);
            $this->footer();
		}
    }
    
    
    public function login(){
        $this->include();
        
        $login = $this->limpa($this->input->post('login'));
        $senha = $this->input->post('pass');
        $aux = 0;
        
        if($this->clientes->getSenhaLogin($login, md5($senha))){
            $cliente = $this->clientes->getCPF($login);
            
            if($cliente['cliente_ativo'] == 0){
                $this->session->set_userdata('msg', 2);
                redirect(base_url('entrar'));
            } else {
                $this->session->set_userdata('cliente_logado', 1);
                $this->session->set_userdata('cliente_user_id', $cliente['cliente_id']);
                $this->session->set_userdata('cliente_nome', $cliente['cliente_nome']);
                if($cliente['cliente_cep'] != null){
                    $this->session->set_userdata('cliente_cep', $cliente['cliente_cep']);    
                    } else {
                        $this->session->set_userdata('cliente_cep', '00000000');    
                    }
                    
                    
                    if($cliente['cliente_cep'] == null || $cliente['cliente_cep'] == ""){
                        $aux++;
                    } else if($cliente['cliente_endereco'] == null || $cliente['cliente_endereco'] == ""){
                        $aux++;
                    } else if($cliente['cliente_numero'] == null || $cliente['cliente_numero'] == ""){
                        $aux++;
                    } else if($cliente['cliente_bairro'] == null || $cliente['cliente_bairro'] == ""){
                        $aux++;
                    } else if($cliente['cliente_cidade'] == null || $cliente['cliente_cidade'] == ""){
                        $aux++;
                    } else if($cliente['cliente_estado'] == null || $cliente['cliente_estado'] == ""){
                        $aux++;
                    } else if($cliente['cliente_email'] == null || $cliente['cliente_email'] == ""){
                        $aux++;
                    } else if($cliente['cliente_nascimento'] == null || $cliente['cliente_nascimento'] == ""){
                        $aux++;
                    }
                    
                    if($aux > 0){
                        $this->session->set_userdata('cliente_sem_endereco', 1);
                    } else {
                        $this->session->set_userdata('cliente_sem_endereco', 0);
                    }
                    
                    redirect(base_url('92e97566397e7d998f610c34726e7a20'));
                }
            } else {
                $this->session->set_userdata('msg', 1);
                redirect(base_url('entrar'));
            }
    }
    
    public function verPedido(){
        $this->include();
        $this->load->model('comprasmodel');
        
        $id = $this->input->get_post('id_pedido');
        
        $data['pedido'] = $this->comprasmodel->pedido($id);
        
        $cliente_nome = explode(' ',$data['pedido']['cliente']);
        
        $total = $data['pedido']['total'] + $data['pedido']['frete_valor'] - $data['pedido']['desconto'];
        	
        $data['mensagem'] = "🧑🏻‍💻%2A**Pedido pelo site/app**%2A📦%0A%0A%2AMr.CellStore Agradece seu pedido!🤝%2A%0A%0A◾️Cliente: ".$cliente_nome[0].
        	"%0A◾Frete: R$".number_format($data['pedido']['frete_valor'], 2,',','.') . " - " . $data['pedido']['e_cep'] ."%0A◾️Nº do pedido: ".$id.'%0A◾Data/hora: '.date('d/m/Y H:i', strtotime($data['pedido']['cadastro'])).'%0A💰Total: R$'.number_format($total,2,',','.');

        $data['mensagem'] = $data['mensagem'] . '%0A%0A%2AITENS:%2A';
        
        
        
        foreach($data['pedido']['produtos'] as $p){
            $Prodnome   = '%0A◾' . ucwords(mb_strtolower($p['produto_nome']));
            $Prodquant  = '%0AQtd: ' . $p['produto_quantidade'] . '  Valor Unit.: R$' . number_format($p['produto_valor'], 2,',','.') . '%0A';
            
            $data['mensagem'] = $data['mensagem'] . $Prodnome;
            $data['mensagem'] = $data['mensagem'] .  $Prodquant;
        }
        
        $data['mensagem'] = $data['mensagem'] . '%0A%0AQuero prosseguir com o pagamento do pedido';
            
        $this->header();
        $this->load->view('pedido', $data);
        $this->footer();
    }
    
    
    public function principal(){
        $this->include();
        $this->load->model('comprasmodel');
        $this->load->model('produtos');
	    
	    if($this->session->userdata('cliente_logado') == 1){
	        
    	    $data['cliente'] = $this->clientes->get($this->session->userdata('cliente_user_id'));
    	    $data['pedidos'] = $this->comprasmodel->pedidosPublico($this->session->userdata('cliente_user_id'));
    	    $data['chave']   = $this->configs->getChave(1);
    	    $site = $this->configs->getSite();
    		
    		if($this->session->userdata('msg')){
    		    $data['msg'] = $this->session->userdata('msg');
    		    $this->session->unset_userdata('msg');
    		} else {
    		    $data['msg'] = null;
    		}
		
		    $this->header();
            $this->load->view('principaluser', $data);
            $this->footer();
		} else {
		    redirect(base_url('entrar'));
		}
    }
    
    
    public function insertCliente(){
        $this->load->database();
        $this->load->model('clientes');
        
        $senha = md5($this->input->post('senha_cadastro'));
        $cliente = $this->clientes->getCPF($this->limpa($this->input->post('cpf_cadastro')));
        $nome = $this->input->post('nome_cadastro');
        $senha = $this->input->post('senha_cadastro');
        
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
                    'cliente_nome'          => mb_strtoupper($this->input->post('nome_cadastro')),    
                    'cliente_cpf'           => $this->limpa($this->input->post('cpf_cadastro')),
                    'cliente_senha'         => md5($senha),
                    'cliente_ativo'         => 1,
                    'cliente_datacadastro'  => date('Y-m-d'),
                );
                
                $id = $this->clientes->insert($cliente);
                
                $this->session->set_userdata('cliente_user_id', $id);
                $this->session->set_userdata('cliente_nome', $this->input->post('nome_cadastro'));
                $this->session->set_userdata('cliente_logado', 1);
                $this->session->set_userdata('cliente_sem_endereco', 1);
                }   
            }
        }else{
            $this->session->set_userdata('msg', 7);
        }
        
      redirect(base_url('92e97566397e7d998f610c34726e7a20'));
    }
    
    public function updateClienteDados(){
        $this->load->database();
        $this->load->model('clientes');
        
        $id = $this->input->post('id');
        
        $cliente = array(
          'cliente_nome'        => mb_strtoupper($this->input->post('nome')),  
          'cliente_nascimento'  => $this->input->post('nascimento'),  
          'cliente_email'       => mb_strtoupper($this->input->post('email')),  
          'cliente_telefone'    => $this->limpa($this->input->post('telefone')),  
          'cliente_genero'      => mb_strtoupper($this->input->post('genero')),  
        );
        
        $this->session->set_userdata('cliente_nome', $this->input->post('nome'));
        
        $this->clientes->update($id, $cliente);
        
        $this->session->set_userdata('msg', 1);
        
        redirect(base_url('92e97566397e7d998f610c34726e7a20'));
    }
    
    public function redefinirSenha(){
        $this->load->database();
        $this->load->model('clientes');
        
        $senha = md5($this->input->post('senha_nova'));
        $nova_senha = $this->input->post('senha_nova');
        $id         = $this->input->post('id_redifinir');
        
            
        if (strlen ($nova_senha) >= 6){
            
            $cliente = array(
              'cliente_senha' => $senha,  
            );
            $this->clientes->update($id, $cliente);
        }
        
        $this->session->set_userdata('msg', 3);
        
        redirect(base_url('92e97566397e7d998f610c34726e7a20'));
    }
    
    public function updateClienteEndereco(){
        $this->load->database();
        $this->load->model('clientes');
        
        $id = $this->input->post('id2');
        
        $cliente = array(
          'cliente_cep'         => $this->limpa($this->input->post('cep')),  
          'cliente_endereco'    => mb_strtoupper($this->input->post('endereco')),  
          'cliente_numero'      => $this->input->post('numero'),  
          'cliente_cidade'      => mb_strtoupper($this->input->post('cidade')),  
          'cliente_bairro'      => mb_strtoupper($this->input->post('bairro')),  
          'cliente_estado'      => mb_strtoupper($this->input->post('estado')),  
          'cliente_complemento' => mb_strtoupper($this->input->post('complemento')), 
        );
        
        $this->clientes->update($id, $cliente);
        
        $this->session->set_userdata('msg', 2);
        
        redirect(base_url('conta#endereco'));
    }
    
    public function deslogar(){
        $this->session->unset_userdata('cliente_user_id');
        $this->session->unset_userdata('cliente_logado');
        $this->session->unset_userdata('cliente_nome');
        $this->session->unset_userdata('cliente_cep');
        
        redirect(base_url());
    }
    
    public function esquecerSenha(){
        $this->include();
        
        $cpf    = $this->limpa($this->input->post('cpf-esquecer'));
        $email  = mb_strtoupper($this->input->post('email-esquecer'));
        
        $cliente = $this->clientes->getCPF($cpf);
        if($cliente){
            if($cliente['cliente_email'] == $email || $cliente['cliente_email'] == mb_strtolower($email)){
                $this->session->set_userdata('msg', 5);
                $dados = array(
                    'nome'          => $cliente['cliente_nome'],
                    'senha'         => $cliente['cliente_cpf'],
                    'email'         => $cliente['cliente_email'],
                );
                
                $cliente_novo = array(
                    'cliente_senha' =>    md5($cliente['cliente_cpf']), 
                );
                    
                $this->clientes->update($cliente['cliente_id'], $cliente_novo);
                $this->enviaEsqueceuEmail($dados);
                
            } else {
                $this->session->set_userdata('msg', 6);
            }
        } else {
            $this->session->set_userdata('msg', 4);
        }
        
        redirect(base_url('2b1e190210df261675c4b801bc6e8989'));
        
    }
    
    function enviaEsqueceuEmail($dados){
        $this->load->database();
        $this->load->model('configs');
        
        $site = $this->configs->getSite();
        $gestoremail = $this->configs->getEmail(1);
        
	    $data = array(
	        'nome'          => $dados['nome'],
	        'senha'         => $dados['senha'],
	        'whats'         => $site['whats'],
	        'empresa'       => $site['nome_empresa'],
	    );
    	   
        $email = $dados['email'];
            
        $config = array(
            'protocol'      => $gestoremail['email_protocol'],
            'smtp_host'     => $gestoremail['email_host'],
            'smtp_port'     => $gestoremail['email_port'],
            'smtp_timeout'  => $gestoremail['email_timeout'],
            'smtp_user'     => $gestoremail['email_user'],
            'smtp_pass'     => $gestoremail['email_pass'],
            'charset'       => $gestoremail['email_charset'],
            'newline'   => "\r\n",  
            'mailtype'  => 'html',    
            'validation'  => TRUE,
        );
        
        $assunto = $site['nome_empresa'] . ' Redefinição de Senha';
        
        /*
        $config = array(
            'protocol'  => 'smtp',
            //'smtp_host' => 'smtp-relay.gmail.com',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_timeout' => '10',
            'smtp_user' => 'contato@showdasorte.com',
            //'smtp_user' => 'suporte@showdasorte.com',
            'smtp_pass' => 'dev#admin@2021',
            'charset'   => 'iso-8859-1',
            'newline'   => "\r\n",  
            'mailtype'  => 'html',    
            'validate'  => TRUE,
        );
        */
        
	    
	    
        $this->load->library('email');
        $this->load->model("sendemail");
        $mailbody = $this->sendemail->esqueceuSenha($data);

        $this->email->initialize($config);
        
        $this->email->from($gestoremail['email_user'], 'Email Nsolucoes');
        $this->email->to($email); 
        $this->email->subject($assunto);
        $this->email->message($mailbody);  
        
        $this->email->send();
        $this->email->print_debugger();
	    
	}
    
    
    private function limpa($val){
	    $helper = array(",", ".", "(", ")", "+", "-", " ", "/");
        return str_replace($helper, "", $val);
	}
}