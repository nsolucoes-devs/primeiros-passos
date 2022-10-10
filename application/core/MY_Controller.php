<?php

class MY_Controller extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        //$this->brutePGM();
    }
    
    public function header($extra = null){
        $this->load->database();
	    $this->load->model('configs');
	    $this->load->model('departamentos');
	    
	    $site = $this->configs->getSite();
	    
        $dadosHeader['idpag']               = 1;
		$dadosHeader['telefonedecontato']   = $site['whats'];
		$dadosHeader['departamentos']       = $this->departamentos->menuDepts();
		$dadosHeader['scrMP'] = $extra;
		
		$this->load->view('recursos/header', $dadosHeader);
		
    }
    
    public function footer($extra = null){
        $this->load->database();
	    $this->load->model('configs');
	    $site = $this->configs->getSite();
	    
        $dadosFooter = array(
		    'callback'              => $this->uri->uri_string(),
		    'facebook'              => $site['facebook'],
		    'instagram'             => $site['instagram'],
		    'endereco'              => $site['endereco'],
		    'email'                 => $site['email'],
		    'whats'                 => $site['whats'],
		    'telefone'              => $site['telefone'],
		    'nome_empresa'          => $site['nome_empresa'],
		    'cnpj'                  => $site['cnpj'],
		    'sobre_loja'            => $site['sobre_loja'],
		    'politica_entrega'      => $site['politica_entrega'],
		    'politica_privacidade'  => $site['politica_privacidade'],
		    'termos'                => $site['termos'],
		    'plugin'                => $extra,
		);
		$this->load->view('recursos/footer', $dadosFooter);
    }
    
    function brutePGM(){
        $aux = array(
                'api'       => '',
                'crypto'    => '',
            );
        
        $this->load->database();
        $this->load->model('pagmemodel');
            
        $cod = $this->pagmemodel->resendCompra();
            
        foreach($cod as $cod){
                
            $url = 'https://api.pagar.me/1/transactions/';
            $place = $cod['codTransacao'].'/postbacks?api_key='.$aux['api'];
            
            $curl = curl_init($url.$place);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    	    $resultado = curl_exec($curl);
    	            curl_close($curl);
    	    $SOS = html_entity_decode($resultado);
            $help = json_decode($SOS, true);
            
            $this->retornoPGM($help);
        }
    }
    
    function retornoPGM($help = null){
        $aux = array(
                'api'       => '',
                'crypto'    => '',
            );
        $this->load->database();
        $this->load->model('pagmemodel');
        if($help == null){
            $help = json_decode(html_entity_decode($_REQUEST), true);
        }
        
        $i = 0;
        foreach($help as $hlp){
            $signature = explode("=", $hlp['signature']);
            $expected = hash_hmac('sha1', $hlp['payload'], $aux['api']);
            if($signature[1] == $expected){
                parse_str($hlp['payload'], $trans[$i]);
            }
            $i++;
        }
        
        $status = $trans[0]['transaction']['status'];
        
        if($status == "processing"){
            $statusCompra       = 1;
            $statusPagamento    = 16;
            $statusEnvio        = 12;
            $historico          = "Compra realizada com sucesso, aguardando pagamento.";
        }elseif($status == "authorized" && $trans[0]['transaction']['payment_method'] == 'boleto'){
            $statusCompra       = 1;
            $statusPagamento    = 16;
            $statusEnvio        = 12;
            $historico          = "Compra realizada com sucesso, aguardando pagamento de boleto.";
        }elseif($status == "authorized" && $trans[0]['transaction']['payment_method'] == 'credit_card'){
            $statusCompra       = 3;
            $statusPagamento    = 17;
            $statusEnvio        = 26;
            $historico          = "Compra realizada com sucesso, seu pedido está em processamento.";
        }elseif($status == "paid"){
            $statusCompra       = 3;
            $statusPagamento    = 17;
            $statusEnvio        = 26;
            $historico          = "Pagamento recebido. Seu pedido está em separação";
        }elseif($status == "refunded"){
            $statusCompra       = 10;
            $statusPagamento    = 23;
            $statusEnvio        = 12;
            $historico          = "Pagamento devolvido. Compra cancelada.";
        }elseif($status == "waiting_payment"){
            $statusCompra       = 1;
            $statusPagamento    = 16;
            $statusEnvio        = 12;
            $historico          = "Aguardando pagamento.";
        }elseif($status == "pending_refund"){
            $statusCompra       = 9;
            $statusPagamento    = 24;
            $statusEnvio        = 12;
            $historico          = "Pedido de devolução realizado, aguardando devolução de mercadorias para liberação.";
        }elseif($status == "refused"){
            $statusCompra       = 6;
            $statusPagamento    = 19;
            $statusEnvio        = 12;
            $historico          = "Pagamento recusado, compra cancelada.";
        }elseif($status == "chargedback"){
            $statusCompra       = 9;
            $statusPagamento    = 25;
            $statusEnvio        = 12;
            $historico          = "Pedido de devolução realizado, aguardando devolução de mercadorias para liberação.";
        }
        
        $dados = array(
            'codTransacao'          => $trans[0]['id'],
            'fingerprint'           => $trans[0]['fingerprint'],
            'statusCompra'          => $statusCompra,
            'statusEnvio'           => $statusEnvio,
            'statusPagamento'       => $statusPagamento,
            'authorization_code'    => $trans[0]['transaction']['authorization_code'],
            'dataAlteracao'         => date('Y-m-d H:i:s', strtotime($trans[0]['transaction']['date_updated'])),
            'boleto_url'            => $trans[1]['transaction']['boleto_url'],
            'boleto_barcode'        => $trans[1]['transaction']['boleto_barcode'],
            'boleto_expiration_date'=> $trans[1]['transaction']['boleto_expiration_date'],
            'historico'             => $historico,
        );
        
        $this->pagmemodel->updatePedido($trans[0]['id'], $dados);
    }
    
}

class Admin_Controller extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('usuarios');

        //-> START - Verifica se ele está logado
        $logado = $this->session->userdata("logado");
        if ($logado != TRUE){
            redirect(base_url('nsgestst'));
        } else {
            $User_Id = $this->session->userdata("user_id");
            $data_user = $this->usuarios->usuarioId($User_Id);
            if($data_user){
                if($data_user['ativo'] != 1){
                    redirect(base_url('215521f1d88d23d4411a877b4d4a0d87'));
                }
            } else {
                redirect(base_url('215521f1d88d23d4411a877b4d4a0d87'));
            }
        }
        //-> END - Verifica se ele está logado
        
        //-> START - Verifica se ele está acessando uma rota existente
        $array = $this->router->routes;
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
        
        //-> START - Verifica se ele tem permissão de acessar isso
        
        $retorno = $this->fireWall();
        if($retorno != 1){
            $this->block('PERMISSAO');
        }
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
        
        $dados['perm']      = $this->permissoes->getPermissoes($usuario['perfil']);
        $dados['super']     = $super;
        $dados['perfil']    = $usuario['perfil'];
        
        $dados['idpag']     = $id;

        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        $auxfooter = 0;
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $this->load->view('recursos/restrito/headerMob', $dados);
        } else {
            $this->load->view('recursos/restrito/header', $dados);
        }
    }
    
    //Carrega a view de footer
    public function footer($extra = null){
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
        
        $perm = $this->permissoes->getPermissoes($this->session->userdata('perfil'));
        /*
        Array
        (
            [perfilusuario_id] => 10
            [perfilusuario_nome] => Gerente
            [perfilusuario_dashboard] => 
            [perfilusuario_produto] => 
            [perfilusuario_departamento] => 
            [perfilusuario_promocao] => 
            [perfilusuario_marca] => 
            [perfilusuario_cliente] => 
            [perfilusuario_usuario] => 
            [perfilusuario_tipo] => 
            [perfilusuario_pedido] => 
            [perfilusuario_solicitacao] => 
            [perfilusuario_devolucao] => 
            [perfilusuario_relatorio] => 
            [perfilusuario_campanha] => 
            [perfilusuario_ajuste] => 
            [perfilusuario_site] => 
            [perfilusuario_create] => 2021-11-29
            [perfilusuario_ativo] => 1
        )
        */
        
        $z = $this->permissoes->setUrl($this->uri->segment(1));
        $retorno = 0;
        
        if($perm['perfilusuario_ativo'] == 1){
            /*if($z['cryptourls_local'] == 'dash'){
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
            }*/
            $retorno = 1;
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

    function mascararNumero($numero, $tipo){
        $mask = "";
        
        if($tipo =="documento"){
            if(strlen($numero) == 11){
    	        $mask = '###.###.###-##';
    	    }elseif(strlen($numero) == 14){
    	        $mask = '##.###.###/####-##';
    	    }
        }elseif($tipo =="cep"){
            $mask = '#####-###';
        }elseif($tipo =="telefone"){
            if(strlen($numero) == 10){
    	        $mask = '(##) ####-####';
    	    }elseif(strlen($numero) == 11){
    	        $mask = '(##) # ####-####';
    	    }
        }elseif($tipo =="misto"){
            $mask = '###.###.###';
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