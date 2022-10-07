<?php

class Mensagemmodel extends CI_Model{
    
    //-> Função que vai pegar a última inserção no banco
    public function getLast(){
        $this->db->order_by("sms_id", "desc");
        return $this->db->get('mensagem_sms')->row_array();
    }
    
    //-> Função que vai inserir um novo sms_mensagem
    public function insertSMS($sms){
        $this->db->insert('mensagem_sms', $sms);
        return $this->db->insert_id();
    }
}