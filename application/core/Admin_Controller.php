<?php

class Admin_Controller extends CI_Controller{
    /*
     */
    public function __construct(){
        parent::__construct();

        //-> START - Verifica se ele está logado
        $logado = $this->session->userdata("logado");
        if ($logado != TRUE){
            redirect(base_url('nsgestst'));
        }
        //-> END - Verifica se ele está logado
        
        //-> START - Verifica se ele está acessando uma rota existente
        /*$array = $this->router->routes;
        $check = 0;
	    foreach($array as $ar => $key){
	        $ex = [];
	        if (strpos($ar, '/') !== false) {
	            $ex = explode('/', $ar);
            }else{
                $ex[0] = $ar;
            }
            if(strlen($ex[0]) >= 32){
    	        if($this->uri->segment(1) == $ex[0]){
    	            $check = 1;
    	        }
            }
	    }
	    if($check == 0){
	        //$this->block('ROTA');
	    }
	    //-> END - Verifica se ele está acessando uma rota existente
        
        //-> START - Verifica se ele tem permissão de acessar isso*/
        
        /*$retorno = $this->fireWall();
        if($retorno != 1){
            $this->block('PERMISSAO');
        }*/
        //-> END - Verifica se ele tem permissão de acessar isso
        $this->logger();
    }
    
    public function limpa($val){
	    $helper = array(",", ".", "(", ")", "+", "-", " ", "/", "_");
        return str_replace($helper, "", $val);
	}
    
    //Carrega a view de header
    public function header($id = null, $manual = null, $head = null){
        $this->load->database();
        $this->load->model('permissoes');
        $this->load->model('usuarios');
        
        if($head != null){
            $this->session->set_userdata('header', 1);
            $this->session->set_userdata('footer', 1);
        }else{
            $this->session->unset_userdata('header');
            $this->session->unset_userdata('footer');
        }
        
        $userid = $this->session->userdata("user_id");
        $usuario = $this->usuarios->usuarioId($userid);
        if($usuario['super'] == 1){
            $super = 1;
        } else {
            $super = 0;
        }
        
        $dados['perm'] = $this->permissoes->getPermissoes($usuario['perfil']);
        $dados['super'] = $super;
        $dados['idpag'] = $id;
        
        $this->load->view('recursos/restrito/header', $dados);
    }
    
    //Carrega a view de footer
    public function footer(){
        $this->load->view('recursos/restrito/footer');
    }
    
    //Carrega a view de header2
    public function header2(){
        $this->load->view('recursos/restrito/header2');
    }
    
    //Carrega a view de footer 2 
    public function footer2(){
        $this->load->view('recursos/restrito/footer2');
    }
    
    //Registra os controllers e funções que estão sendo acessadas
    public function logger(){
        $this->load->database();
        $this->load->model('logger');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'nome_log'          => $this->session->userdata('nome'),
            'datahora_log'      => date('d/m/Y H:i:s'),
            'usuario_id'        => $this->session->userdata('user_id'),
            'controller_log'    => $this->uri->segment(1) . "/" . $this->uri->segment(2),
        );
        
        $this->logger->adicionarLog($log);
        
    }
    
    //Função que recebe um elemento e uma string, e retorno o elemento formatado conforme a string pede
    public function mascara($element, $mask){
        if($mask == "cpf"){
            $retorno = substr($element, 0, 3) . "." . substr($element, 3, 3) . "." . substr($element, 6, 3). "-" . substr($element, 9);
        }else if($mask == "tel"){
            if(strlen($element) == 11){
                $retorno = "(" . substr($element, 0, 2) . ") " . substr($element, 2, 5) . "-" . substr($element, 7);
            }else{
                $retorno = "(" . substr($element, 0, 2) . ") " . substr($element, 2, 4) . "-" . substr($element, 6);
            }
        }
        
        return $retorno;
    }
    
    private function block($tip){
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->database();
        $this->load->model('logger');
        $this->load->model('usuarios');
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
        	$ip = $_SERVER['REMOTE_ADDR'];  
        }

        $log = array(
                'log_ip'        => $ip,
                'log_user_id'   => $this->session->userdata('user_id'),
                'log_nome'      => $this->session->userdata('nome'),
                'log_data'      => date('Y-m-d'),
                'log_hora'      => date('H:i:s'),
                'log_funcao'    => $this->uri->uri_string(),
                'log_tipo'      => $tip,
            );
            
        $this->logger->logBlock($log);
        
        $user = $this->usuarios->usuarioId($log['log_user_id']);
        $user['ativo'] = 2;
        $this->usuarios->atualizarUsuario($user, $log['log_user_id']);
        
        $this->load->config('email');
        $this->load->library('email');
        $this->load->model("sendemail");
        $mailbody = $this->sendemail->avisoBlock($log);
        
        $this->email->from('contato@nsolucoes.digital', 'Ecommerce - Suporte');
        $this->email->to('guilherme.326@hotmail.com');
        
        $this->email->subject('Atividade suspeita na área administrativa');
        $this->email->message($mailbody);
        
        $this->email->send();
        
        redirect(base_url('215521f1d88d23d4411a877b4d4a0d87'));
    }
    
    //Função que vai verificar as permissões da sessão
    private function fireWall(){
        $this->load->database();
        $this->load->model('permissoes');
        
        $perm = $this->permissoes->getPermissoes($this->session->userdata('user_id'));
        
        /*
        Array ( 
        [perfilusuario_id] => 2 
        [perfilusuario_nome] => gfg sdfgsdfg sdf gdf gsdf gfsd gdsf gsdf 
        [perfilusuario_islive] => 0 
        [perfilusuario_alive] => 0 
        [perfilusuario_dashboard] => 1 
        [perfilusuario_live] => 1 
        [perfilusuario_premios] => 1 
        [perfilusuario_transacoes] => 1 
        [perfilusuario_reembolso] => 1 
        [perfilusuario_relatorios] => 1 
        [perfilusuario_campanhas] => 1 
        [perfilusuario_definicao] => 1 
        [perfilusuario_usuarios] => 1 
        [perfilusuario_tipousuario] => 1 
        [perfilusuario_site] => 1 
        [perfilusuario_create] => 2021-04-05 
        [perfilusuario_ativo] => 1 
        */
        $z = $this->permissoes->setUrl($this->uri->segment(1));
        $retorno = 0;
        if($perm['perfilusuario_ativo'] == 1){
            if($z['cryptourls_local'] == 'dash'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'live'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'premios'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'transacoes'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'reembolso'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'relatorios'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'campanhas'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'definicao'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'usuarios'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'tipousuario'){
                $retorno = 1;
            }elseif($z['cryptourls_local'] == 'site'){
                $retorno = 1;
            }
        }else{
            $retorno = 0;
        }
        return $retorno;
    }
    
    function mask($val, $mask)    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
        
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            
            else{
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        
        return $maskared;

    }
    
    function limpa($valor){
        $lixo = array(".", "-", "\"", "/", ",", "_");
        $limpo = str_replace($lixo, "", $valor);
        return $limpo;
    }
    function mascararNumero($numero, $tipo){
        
        if(strlen($numero) == 11){
	        $mask = '###.###.###-##';
	    }elseif(strlen($numero) == 14){
	        $mask = '##.###.###/####-##';
	    }
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($numero[$k])) {
                    $maskared .= $numero[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }  
        return $maskared;
    }
}
