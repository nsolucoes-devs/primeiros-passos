<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrito extends Admin_Controller {

    public function indexAdmin(){
        $this->load->database();
	    $this->load->model('usuarios');
        $this->load->model('acessomodel');
        $this->load->model('comprasmodel');
        $this->load->model('lojas/Crudlojas');
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $ano        =   date('Y');
        $mes        =   date('m');
        $dia        =   date('d');
        $horaatual  =   date('H');
        $datacerto  =   date('Y');
        
        $diaanterior =  date('Ymd', strtotime("-1 days",strtotime(date('d-m-Y'))));
        
        $hora = null;
        $horav = null;
        $horaa = null;
        $horaav = null;
        
        for($i = 0 ;$i < 24; $i++){
            if($i < 10){
                $teste = $this->acessomodel->get($diaanterior . '0' . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horaa .= $hour . ',';
            } else {
                $teste = $this->acessomodel->get($diaanterior . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horaa .= $hour . ',';
            }
        }
        
        for($i = 0 ;$i < 24; $i++){
            if($i < 10){
                $teste = $this->acessomodel->getVenda($diaanterior . '0' . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horaav .= $hour . ',';
            } else {
                $teste = $this->acessomodel->getVenda($diaanterior . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horaav .= $hour . ',';
            }
        }
        
        for($i = 0 ;$i < 24; $i++){
            if($i < 10){
                $teste = $this->acessomodel->get($ano.$mes.$dia . '0' . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $hora .= $hour . ',';
            } else {
                $teste = $this->acessomodel->get($ano.$mes.$dia . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $hora .= $hour . ',';
            }
        }
        
        for($i = 0 ;$i < 24; $i++){
            if($i < 10){
                $teste = $this->acessomodel->getVenda($ano.$mes.$dia . '0' . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horav .= $hour . ',';
            } else {
                $teste = $this->acessomodel->getVenda($ano.$mes.$dia . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horav .= $hour . ',';
            }
        }
        
        for($i = 0 ;$i < 24; $i++){
            if($i < 10){
                $teste = $this->acessomodel->getVenda($ano.$mes.$dia . '0' . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horav .= $hour . ',';
            } else {
                $teste = $this->acessomodel->getVenda($ano.$mes.$dia . $i);
                $hour = $teste != null ? $teste['hora'] : '0';
                $horav .= $hour . ',';
            }
        }
        
        $min = null;
        
        $teste = $this->acessomodel->get($ano.$mes.$dia.$horaatual);
        for($x = 0; $x <= 60;$x++){
            $soma = 0;
            if($teste) { 
                if($x < 9){
                    for($y = 1; $y <= 5; $y++){
                        if($x < 60) { 
                            $soma = $soma + $teste['min_0' . $x];
                        }
                        $x++;
                    } 
                } else {
                    for($y = 1; $y <= 5; $y++){
                        if($x < 60) { 
                            $soma = $soma + $teste['min_' . $x];
                        }
                        $x++;
                    } 
                }
                $x--;
                $min .= $soma . ',';
            }
        }
        
        $minv = null;
        
        $teste2 = $this->acessomodel->getVenda($ano.$mes.$dia.$horaatual);
        for($x = 0; $x <= 60;$x++){
            $soma = 0;
            if($teste2) { 
                if($x < 9){
                    for($y = 1; $y <= 5; $y++){
                        if($x < 60) {
                            $soma = $soma + $teste2['min_0' . $x];
                        }
                        $x++;
                    } 
                } else {
                    for($y = 1; $y <= 5; $y++){
                        if($x < 60) {
                            $soma = $soma + $teste2['min_' . $x];
                        }
                        $x++;
                    } 
                }
                $x--;
                $minv .= $soma . ',';
            }
        }
        
        $data['minv']           = $minv;
        $data['min']            = $min;
        $data['hora']           = $hora;
        $data['horav']          = $horav;
        $data['horaa']          = $horaa;
        $data['horaav']         = $horaav;
        $data['usuario']        = $this->usuarios->usuarioId($this->session->userdata('user_id'));
        $data['pedidos_cont']   = $this->comprasmodel->relatorioindex();
        $data['lojas']          = $this->Crudlojas->getLojas();
        
        $this->header(1);
        $this->load->view('restrito/index', $data);
        $this->footer();
    }
    
    public function getUltimosPedidos(){
        $loja_id = $this->input->post('loja_id');
         $this->load->model('comprasmodel');
         $pedidos = $this->comprasmodel->relatorioindex($loja_id);
         
         for($aux=0; $aux < count($pedidos['pedidos']); $aux++) {
             
             $pedidos['pedidos'][$aux]['valor'] = 'R$ '. number_format($pedidos['pedidos'][$aux]['valor'], 2, ',','.');
             $pedidos['pedidos'][$aux]['data']  =  date('d/m/Y H:i', strtotime($pedidos['pedidos'][$aux]['data']));
         }
         
        echo json_encode($pedidos['pedidos']);
    }


    
    public function getDiasInfo(){
        $this->load->database();
        $this->load->model('comprasmodel');
        
        $dias = $this->input->post('dias');
        $loja_id = $this->input->post('loja_id');
        
        $infos = $this->comprasmodel->indexdias($dias, $loja_id);
        
        echo json_encode($infos);
    }
    
    
   	
	

    
    //Função que realiza as máscaras
    
    public function configs($success = null, $error = null){
        $this->load->database();
        $this->load->model('configs');
        
        if($success != null){
            $data['success'] = $success;
        }else{
            $data['success'] = null;
        }
        if($error != null){
            $data['error'] = $error;
        }else{
            $data['error'] = null;
        }
        $data['configtermo'] = $this->configs->getConfigPag(1);
        $data['configres'] = $this->configs->getConfigPag(2);
        $data['confighome'] = $this->configs->getConfigPag(3);
        $data['configcon'] = $this->configs->getConfigPag(4);
        $data['configreg'] = $this->configs->getConfigPag(5);
        $data['configpri'] = $this->configs->getConfigPag(15);
        
        
        
        $this->header(6);
        $this->load->view('restrito/configs', $data);
        $this->footer();
    }
    
    public function atualizaConfigs(){
        $this->load->database();
        $this->load->model('configs');
        
        $configOLD = $this->configs->getConfig();
        
        if($_FILES['banner']['name'] == null){
            $helper = $configOLD['banner'];
        }else{
            $helper = $this->do_upload($_FILES['banner']);
            if($helper == 1){
                $this->configs(null, 1);
            }
        }
        
        if($this->input->post('sub1') == null){
            $sub1 = $configOLD['subtitulo1'];
        }else{
            $sub1 = $this->input->post('sub1');
        }
        
        if($this->input->post('tit1') == null){
            $tit1 = $configOLD['titulo1'];
        }else{
            $tit1 = $this->input->post('tit1');
        }
        
        if($this->input->post('sub2') == null){
            $sub2 = $configOLD['subtitulo2'];
        }else{
            $sub2 = $this->input->post('sub2');
        }
        
        if($this->input->post('tit2') == null){
            $tit2 = $configOLD['titulo2'];
        }else{
            $tit2 = $this->input->post('tit2');
        }
        
        $config = array(
                'banner'        => $helper,
                'subtitulo1'    => $sub1,
                'titulo1'       => $tit1,
                'subtitulo2'    => $sub2,
                'titulo2'       => $tit2,
            );
        
        $this->configs->atualizaConfig($config);
        
        $this->configs(1, null);
    }
    

    



    


    function do_upload(){
	    
        $config['upload_path']          = 'imagens/banners/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 4000;
        $config['file_name']            = date('d-m-Y_H:m:s');
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('banner'))
        {
        $error = array('error' => $this->upload->display_errors());
            return 1;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return $config['upload_path'].$this->upload->data('file_name');
        }
    }
    
    function do_upload2(){
	    
        $config['upload_path']          = 'imagens/banners/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 4000;
        $config['file_name']            = date('d-m-Y_H:m:s');
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('banner2'))
        {
        $error = array('error' => $this->upload->display_errors());
            return 1;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return $config['upload_path'].$this->upload->data('file_name');
        }
    }
    
    function do_upload3(){
	    
        $config['upload_path']          = 'imagens/banners/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 4000;
        $config['file_name']            = date('d-m-Y_H:m:s');
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('banner3'))
        {
        $error = array('error' => $this->upload->display_errors());
            return 1;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return $config['upload_path'].$this->upload->data('file_name');
        }
    }


    
    
    

    
    public function estornarVenda(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->database();
        $this->load->model('crudparticipantes');
	    $this->load->model('sorteios');
	    $this->load->model('usuarios');
	    $this->load->model('logger');
	    
	    $id = $this->input->post('id_estorno');
	    $sen = MD5($this->input->post('senha_estorno'));
	    $user = $this->usuarios->getAll();
	    $aux = false;
	    
	    foreach($user as $us){
	        if($us['senha_usuario'] == $sen){
	            $aux = true;
	        }
	    }
	    
	    if($aux){
	        $part = $this->crudparticipantes->getPartId($id);
    	    
    	    $log = array(
    	            'log_user_id'       => $this->session->userdata('user_id'),
    	            'log_user_nome'     => $this->session->userdata('nome'),
    	            'log_venda_id'      => $id,
    	            'log_venda_nome'    => $part['nome_participante'],
    	            'log_data'          => date('d/m/Y'),
    	            'log_hora'          => date('H:i:s'),
    	        );
    	        
    	    $this->logger->logEstorno($log);
    	    
    	    $code = $part['ps_code'];
    	    $token = 'da4fd358-f1d9-4106-8977-cb62961ced5f8f56994a4a20a56ce88f580b8a7716e9b28b-f409-4515-ad34-bac7ca845ffe';
    	    $email = 'excalibur.personalizacoes@gmail.com';
            $url = "https://ws.pagseguro.uol.com.br/v2/transactions/refunds?email=".$email."&token=".$token."&transactionCode=".$code;
            $header = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $retorno = curl_exec($curl);
            curl_close($curl);
            
            $xml = simplexml_load_string($retorno);
            var_dump($xml);
            
            $this->financeiro();
	    }else{
	        $this->financeiro(1);
	    }
    }
    
    function upload($file, $filename){
        $config['upload_path']          = 'imagens/ganhadores/';
        $config['allowed_types']        = '*';
        $config['file_name']            = preg_replace('/[^0-9]/', '', $filename);
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload($file)){
                $error = array('error' => $this->upload->display_errors());
        }else{
                $data = array('upload_data' => $this->upload->data());
                return $data['upload_data']['file_name'];
        }
    }
    
    

    private function Money($valor){
        return number_format($valor, 2, ',', '.');
    }
}