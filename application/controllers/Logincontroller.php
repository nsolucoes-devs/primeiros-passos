<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincontroller extends MY_Controller {
    
    public function telaLogin(){
        $this->load->database();
        $this->load->model('configs');
        
        if(array_key_exists('mensagem_erro', $this->session->userdata())){
	        $dados['erro'] = $this->session->userdata('mensagem_erro');
	        $this->session->unset_userdata('mensagem_erro');
	    }
        
        $dados['chave'] = $this->configs->getChave(2);
        $this->load->view('restrito/login', $dados);
    }
    
    public function telaLogin2(){
        $this->load->database();
        $this->load->model('configs');
        
        if(array_key_exists('mensagem_erro', $this->session->userdata())){
	        $erro = $this->session->userdata('mensagem_erro');
	        $this->session->unset_userdata('mensagem_erro');
	    }
	    
	    
        if(!isset($erro)){
            $erro = 0;
        }
        $dados = array(
            'erro' => $erro,
        );
        
        $dados['chave'] = $this->configs->getChave(2);
        
        $this->load->view('restrito/login2', $dados);
    }
    
    public function validar2(){
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('usuarios');
        $this->load->model('logger');
        
        // RETIRA OS DADOS DO FORMULARIO E PREPARA PARA VERIFICAR
        $user = $this->input->post("login");
        $senha = MD5($this->input->post("senha"));
        $url = $this->input->post("url");
        
        $teste = true;
        //$this->input->post('g-recaptcha-response')
        
        if($teste){
            
        // VERIFICA DADOS DO USUARIO NO BANCO
        $login = $this->usuarios->logar($user);
        if($login != null){

            // SE DADOS ESTAO CORRETOS VERIFICA A SENHA
            if($senha == $login['senha_usuario']){

                // VERIFICA SE O USUÁRIO NÃO ESTÁ BLOQUEADO
                if($login['ativo'] != 0){
    
                    $id = $login['id_usuario'];
    
                    if($id != 0){
                        
                        
                        
                        //GERA OS DADOS DA SESSAO E INICIALIZA O COOKIE
                        $sessao = array(
                    	    'logado'        => TRUE,
                    	    'user_id'       => $login['id_usuario'],
                    	    'func_id'       => $login['usuario_funcionario_id'],
                    	    'nome'          => $login['nome_usuario'],
                    	    'perfil'        => $login['perfil'],
                    	    'senha'         => $login['senha_usuario'],
                    	    'super'         => $login['super'],
                    	    'loja_id'       => $login['loja_id'],
                    	    'foto'          => $login['foto'],
                        );
                        $this->session->set_userdata($sessao);
                        
                        if($login['perfil'] == 3){
                            redirect(base_url('106a6c241b8797f52e1e77317b96a201'));
                        }elseif($login['perfil'] == 10){
                            redirect(base_url('954d03a8bbb7febfcd39f9e071407b4b'));
                        }elseif($login['perfil'] == 9){

                            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                            $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                            $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
                            $auxfooter = 0;
                            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
                                redirect(base_url('pdv/indexMob'));
                            } else {
                                redirect(base_url('pdv'));
                            }
                            
                        }

                    }else{
                        $erro = $this->input->get("erro");
                        $this->telaLogin($erro);
                    }
                }else{
                    // SE ESTIVER BLOQUEADO INFORMA ERRO
                    $this->session->set_userdata('mensagem_erro', 5);
                    redirect(base_url('nsgestst'), 'refresh');
                }
        
            }else{
                
                //ERRO DE SENHA INCORRETA
                $this->session->set_userdata('mensagem_erro', 2);
                redirect(base_url('nsgestst'), 'refresh');
            }
        }else{
            
            //ERRO DE USUÁRIO INCORRETO
            $this->session->set_userdata('mensagem_erro', 1);
            redirect(base_url('nsgestst'), 'refresh');
        }
        
        } else {
            //ERRO DE CAPTCHA NÃO VERIFICADO
            $this->session->set_userdata('mensagem_erro', 4);
            redirect(base_url('nsgestst'), 'refresh');    
        }
        
    }
    
    public function validar(){
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('usuarios');
        $this->load->model('logger');
        
        $teste = "true";
        //$teste = $this->input->post('g-recaptcha-response');
        if($teste == "true"){
            $login = $this->usuarios->login($_POST);
            if(array_key_exists("erro", $login)){
                //ERRO COM USUÁRIO OU SENHA
                $this->session->set_userdata('mensagem_erro', $login['erro']);
                redirect(base_url('nsgestst'), 'refresh'); 
            }else{
                $sessao = array(
            	    'logado'        => TRUE,
            	    'user_id'       => $login['id_usuario'],
            	    'func_id'       => $login['usuario_funcionario_id'],
            	    'nome'          => $login['nome_usuario'],
            	    'perfil'        => $login['perfil'],
            	    'super'         => $login['super'],
            	    'loja_id'       => $login['loja_id'],
                );
                $this->session->set_userdata($sessao);
                
                if($login['perfil'] == 3){
                    redirect(base_url('106a6c241b8797f52e1e77317b96a201'));
                }elseif($login['perfil'] == 10){
                    redirect(base_url('954d03a8bbb7febfcd39f9e071407b4b'));
                }elseif($login['perfil'] == 9){
                    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
                    $auxfooter = 0;
                    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
                        redirect(base_url('pdv/indexMob'));
                    } else {
                        redirect(base_url('pdv'));
                    }
                    
                }else{
                    session_destroy(); 
                    redirect(base_url('nsgestst'), 'refresh');
                }
                
            }
        }else{
            //ERRO DE CAPTCHA NÃO VERIFICADO
            $this->session->set_userdata('mensagem_erro', "CAPTCHA NÃO VERIFICADO");
            redirect(base_url('nsgestst'), 'refresh'); 
        }
    }
    
    //Função que vai deslogar do painel administrativo e encerrar a sessão
    public function sair(){
        $check = $this->session->userdata('sorteio');
        session_destroy();
        if($check != 0){
            redirect(base_url('nspartnerst'), 'refresh');
        } else {
            redirect(base_url('nsgestst'), 'refresh');    
        }
        
    }
    
    public function validaCredencial(){
        $this->load->database();
        $this->load->model('usuarios');
        $html = $this->usuarios->validar($_POST);
        echo json_encode($html);
    }
}