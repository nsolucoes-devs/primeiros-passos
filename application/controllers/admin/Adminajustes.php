<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminajustes extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('correiosmodel');
        $this->load->model('configs');
        $this->load->model('gestor');
        $this->load->model('formaspagamento');
        $this->load->model('lojasmodel');
        $this->load->model('vendedores');
    }
    
    public function pagamentos(){
        
        
        $this->load->library("pagination");
        
        $filtro = "";
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(4) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(5))); 
        }
        
        $config                 = array();
        $config["per_page"]     = 10;
        $config["total_rows"]   = $this->vendedores->get_count($filtro);
        $uri_segment            = 6;
        
        if($filtro){
            $config["base_url"] = base_url('8fb192af45f75504361d0011c1677415/f/' . $filtro . '/');
        } else {
            $config["base_url"] = base_url('8fb192af45f75504361d0011c1677415/n/');
            $uri_segment = 5;
        }
            
        $config["uri_segment"] = $uri_segment; 
            
        $this->pagination->initialize($config);
            
        $data['links'] = $this->pagination->create_links();
            
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
    
        $data['vendedores']  = $this->vendedores->getAllPagination($filtro, 10, $page);
        $data['filtro']    = $filtro;

        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }else {
            $data['alert'] = null;
        }
        
        $dados = array(
            'correios'          => $this->correiosmodel->dados(),
            'pagamentos'        => $this->configs->getGestor(),
            'chave'             => $this->configs->getChave(1),
            'chave2'            => $this->configs->getChave(2),
            'email'             => $this->configs->getEmail(1),
            'formas_pagamento'  => $this->formaspagamento->getFormas(),
            'vendedores'        => $data['vendedores'],
            'links'             => $data['links'],
            'filtro'            => $data['filtro'],
            'alert'             => $data['alert'],
        );
        
        $this->header(6);
        $this->load->view('restrito/configuracoes', $dados);
        $this->footer();
        
    }
    
    public function atualizarCorreios(){
        
        
        for($i = 1; $i <= 9;$i++){
            $ceporigem          = $this->input->post('cep' . $i);
            $status             = $this->input->post('status' . $i);
            $contrato           = $this->input->post('contrato' . $i);
            $valor              = $this->input->post('valor' . $i);
            $valor1             = str_replace(".", "", $valor);
            $valor2             = str_replace(",", ".", $valor1);
            $estados            = "";
            $entregaextra       = $this->input->post('entregamais'. $i);
            
            if($i == 8 || $i == 9){
                $cont = 0;

                if(isset($_REQUEST['estados' . $i])){
                    foreach($_REQUEST['estados' . $i] as $e){
                        if($cont == 0){
                            $estados .= $e;    
                        } else {
                            $estados .= '¬' . $e;    
                        }
                        $cont++;
                    }
                }
            }
            
            $correio = array(
                'cepOrigem'         =>  $this->limpa($ceporigem),
                'dadosAtivo'        =>  $status,
                'contratoCorreio'   =>  $contrato,
                'valorMinimo'       =>  $valor2,
                'regiaoGratis'      =>  $estados,
                'dias_entrega_extra'=>  $entregaextra
            );
            
            $this->correiosmodel->update($i, $correio);
        }
        
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
    
    function gestorPG(){
        

        if($this->input->post('gestor') !== null){
            $gestor                 = $this->input->post('gestor');
        }else{
            $gestor                 = null;
        }
        if($this->input->post('publickey') !== null){
            $gestor_publickey       = $this->input->post('publickey');
        }else{
            $gestor_publickey       = null;
        }
        if($this->input->post('privatekey') !== null){
            $gestor_privatekey      = $this->input->post('privatekey');
        }else{
            $gestor_privatekey      = null;
        }
        if($this->input->post('acesstoken') !== null){
            $gestor_acesstoken      = $this->input->post('acesstoken');
        }else{
            $gestor_acesstoken      = null;
        }
        if($this->input->post('clientid') !== null){
            $gestor_clientid        = $this->input->post('clientid');
        }else{
            $gestor_clientid        = null;
        }
        if($this->input->post('clientsecret') !== null){
            $gestor_clientsecret    = $this->input->post('clientsecret');
        }else{
            $gestor_clientsecret    = null;
        }
        if($this->input->post('emailPag') !== null){
            $gestor_email           = $this->input->post('emailPag');
        }else{
            $gestor_email           = null;
        }
        if($this->input->post('sandboxId') !== null){
            $gestor_sandbox           = "1";
        }else{
            $gestor_sandbox           = "0";
        }

        $dados = array(
            'idgestor'              => 1,
            'gestor'                => $gestor,
            'gestor_publickey'      => $gestor_publickey,
            'gestor_privatekey'     => $gestor_privatekey,
            'gestor_acesstoken'     => $gestor_acesstoken,
            'gestor_clientid'       => $gestor_clientid,
            'gestor_clientsecret'   => $gestor_clientsecret,
            'gestor_email'          => $gestor_email,
            'gestor_sandbox'        => $gestor_sandbox,
        );
        
        $this->configs->gestor($dados);
        redirect('8fb192af45f75504361d0011c1677415');
        
    }
    
    public function chaves(){
        
        
        $id = $this->input->post('google-id');
        
        $chave = array(
            'chave_key'     => $this->input->post('google-key'), 
        );
        
        $this->configs->updateChave($id, $chave);
        
        $chave = array(
            'chave_key'     => $this->input->post('google-key2'), 
        );
        
        $this->configs->updateChave(2, $chave);
        
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
    
    public function insertEmail(){
        
        
        $email = array (
            'email_protocol' => $this->input->post('email_protocol'),
            'email_user'     => $this->input->post('email_user'),
            'email_pass'     => $this->input->post('email_pass'),
            'email_host'     => $this->input->post('email_host'),
            'email_port'     => $this->input->post('email_port'),
            'email_timeout'  => $this->input->post('email_timeout'),
            'email_charset'  => $this->input->post('email_charset'),
        );
        
        $this->configs->updateEmail(1, $email);
        
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
    
    public function getDinamicoGestor(){
        
        
        $a = $this->gestor->get($this->input->post('gestor'));
        
        echo json_encode($a);
    }
    
    public function atualizarFormasPag(){
        
        
        $cont = $this->input->post('cont');
        
       
        
        for ($aux = 0; $aux< $_POST['cont']; $aux++){
            $formas[$aux] = array(
                    'nome_forma'            => $_POST['nome_forma'.$aux],
                    'acrescimo_forma'       => $_POST['cartao_crescimo'.$aux],
                    'ativo_forma'          => $_POST['cartao_ativo'.$aux],
            );
            
            $id[$aux] = $_POST['id_'.$aux];
        }
       
        $this->formaspagamento->updatenew($formas, $id);
        
        redirect(base_url('8fb192af45f75504361d0011c1677415'));
    }
    
    function newFormaLista() {
        
	    $aux = $_POST['row'] + 1;
	    $html = "";
	    $html .=   "<br>
                    <div class='row' id='perguntaForma".$aux."'>
                    <div class='col-md-2' style='text-align:-webkit-center;'>
                    <button id='buttonForma".$aux."' type='button' class='btn btn-success' onclick='novaForma(".$aux.")'>
                    <i class='fa fa-plus' aria-hidden='true'></i>
                    </button>
                    </div>
                    <div class='col-md-10'>
                    <div class='row' style='padding: 0 25px;'>
                    <div class='col-md-3 form-group'>
                    <label><b>Nome:</b></label>
                    <input id='nome_forma' name='nome_forma[]' type='text' class='form-control' value=''>
                    </div>
                    <div class='col-md-2 '>
                    <label><b>Exibir:</b></label>
                    <select id='cartao_ativo' name='cartao_ativo[]' class='form-control'>
                    <option value='1'>Ativo</option>
                    <option value='1'>Inativo</option>
                    </select>
                    </div>
                    <div class='col-md-2 form-group'>
                    <label><b>% de acrescimo:</b></label>
                    <input id='cartao_acrescimo' name='cartao_crescimo[]' type='text' class='form-control' value=''>
                    </div>        
                    <div class='col-md-1 form-group'>
                    <label><b>Vezes:</b></label>
                    <input id='cartao_vezes' name='cartao_vezes[]' type='text' class='form-control' value=''>
                    </div>
                    <div class='col-md-2 form-group'>
                    <label><b>% de desconto:</b></label>
                    <input id='cartao_desconto' name='cartao_desconto[]' type='text' class='form-control' value=''>
                    </div>
                    <div class='col-md-2 form-group'>
                    <label><b>Desconto Ativo:</b></label>
                    <select id='cartao_desconto_ativo' name='cartao_desconto_ativo[]' class='form-control'>        
                    <option value='1'>Ativo</option>
                    <option value='0'>Inativo</option>
                    </select>
                    </div>
                    </div>
                    </div>
                    </div>";
        echo json_encode($html);
    }
}