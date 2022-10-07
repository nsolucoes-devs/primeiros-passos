<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends MY_Controller {
    
    public function pagamentos(){
        $this->load->database();
        $this->load->model('correiosmodel');
        $this->load->model('configs');
        
        $correios = $this->correiosmodel->dados();
        $gestores = $this->configs->getGestor();
        $dados = array(
            'correios'      => $correios,
            'pagamentos'    => $gestores,
            );
        
        
        $this->header(6);
        $this->load->view('restrito/configuracoes', $dados);
        $this->footer();
        
    }
    
    public function atualizarCorreios(){
        $this->load->database();
        $this->load->model('correiosmodel');
        $this->load->model('configs');
        
        for($i = 1; $i <= 8;$i++){
            $ceporigem          = $this->input->post('cep' . $i);
            $status             = $this->input->post('status' . $i);
            $contrato           = $this->input->post('contrato' . $i);
            $valor              = $this->input->post('valor' . $i);
            $valor1             = str_replace(".", "", $valor);
            $valor2             = str_replace(",", ".", $valor1);
            $estados            = "";
            
            if($i == 7 || $i == 8){
                $cont = 0;
                foreach($_REQUEST['estados' . $i] as $e){
                    if($cont == 0){
                        $estados .= $e;    
                    } else {
                        $estados .= '¬' . $e;    
                    }
                    $cont++;
                }
            }
            
            $correio = array(
                'cepOrigem'         =>  $this->limpa($ceporigem),
                'dadosAtivo'        =>  $status,
                'contratoCorreio'   =>  $contrato,
                'valorMinimo'       =>  $valor2,
                'regiaoGratis'      =>  $estados,
            );
            
            $this->correiosmodel->update($i, $correio);
        }
        
        redirect(base_url('d969bcbee24a8b06fb0453da855c768a'));
    }
    
    function gestorPG(){
        $this->load->database();
        $this->load->model('configs');

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
        redirect('d969bcbee24a8b06fb0453da855c768a');
        
    }
    
}