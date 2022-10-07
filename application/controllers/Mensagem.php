<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem extends MY_Controller {
    
    //-> Função que vai incluir as coisas necessárias para as demais funções
    public function include(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->database();
    }
    
    //-> Função que vai chamar a tela de envio de SMS em massa
    public function sms($sucesso = null){
        $this->include();
        
        $data = array(
                'sucesso'   => $sucesso,
                'status'    => array(
                                    0 => array('id' => 0, 'nome' => 'Análise'),
                                    1 => array('id' => 1, 'nome' => 'Aprovado'),
                                    2 => array('id' => 2, 'nome' => 'Negado'),
                                    3 => array('id' => 3, 'nome' => 'Estornado'),
                                    4 => array('id' => 4, 'nome' => 'Não Concluído'),
                                    5 => array('id' => 5, 'nome' => 'Cancelado'),
                                ),
            );
        
            
        $this->header(5);
        $this->load->view('restrito/mensagemSMS', $data);
        $this->footer();
    }
    
    public function sendSMS(){
        $this->include();
        
        $filtros = array(
                'sorteio'   => ($this->input->post('sorteio') != "") ? $this->input->post('sorteio') : null,
                'status'    => ($this->input->post('status') != "") ? $this->input->post('status') : null,
                'inicio'    => ($this->input->post('inicio') != "") ? $this->input->post('inicio') : null,
                'final'     => ($this->input->post('final') != "") ? $this->input->post('final') : null,
            );
        
        $message = array(
                'sms_mensagem'          => $this->input->post('mensagem'),
                'sms_user_id'           => $this->session->userdata('user_id'),
                'sms_user_nome'         => $this->session->userdata('nome'),
                'sms_filtro_sorteio'    => $filtros['sorteio'],
                'sms_filtro_status'     => $filtros['status'],
                'sms_filtro_de'         => $filtros['inicio'],
                'sms_filtro_ate'        => $filtros['final'],
                'sms_data'              => date('d/m/Y'),
                'sms_hora'              => date('H:i:s'),
            );
        
        $message['sms_id'] = $this->msg->insertSMS($message);
        
        $participantes = $this->cpt->getFiltred($filtros);
        
        foreach($participantes as $pt){
            $this->enviasms($pt, $message['sms_mensagem']);
        }
        
        $this->sms(1);
    }
    
    private function enviasms($dados, $msg){
	    ob_start(); //Necessário para não dar erro de headers already sent
        $url = 'sms.shortcode.com.br/app/modulo/api/index.php';             // Url para envio do curl
        $url = str_replace(PHP_EOL, "", $url);                              //Necessário para que a url não dê problema
        $post_data = array(                                                 //Dados requisitados pela API do sms
            'action' => 'sendsms',                                          //O que deve ser feito
            'token' => 'f64451b5eaf052b8da75bafe0bc5286a',                  //Token da conta do sms
            'tipo' => '3',                                                  //Para mais informações, acessar a documentação da api
            'msg' => $msg,                                                  //Mensagem
            'numbers' => $dados['fone_participante']                        //Telefone para quem deseja enviar. Apenas números e sem os 2 digítos do país.
            );
            
        // Configuração e execução do curl. Caso dê erro, favor verificar o valor da variável result    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}