<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logger extends CI_Model {
	
	public function adicionarLog($log){
	    $this->db->insert('log_acesso', $log);
	}

    public function addLogReabertura($log){
        $this->db->insert('log_reabertura', $log);
    }
    
    public function logcancelamento($log){
        $this->db->insert('log_cancelamento', $log);
    }
    
    public function logconfirmacao($log){
        $this->db->insert('log_confirmacao', $log);
    }
    
    public function logProduto($log){
        $this->db->insert('log_produto', $log);
    }
    
    public function logCliente($log){
        $this->db->insert('log_cliente', $log);
    }
    
    public function logUsuario($log){
        $this->db->insert('log_usuario', $log);
    }
    
    public function logTipoUsuario($log){
        $this->db->insert('log_tipousuario', $log);
    }
    
    public function logedicaovalor($log){
        $this->db->insert('log_edicao_valor', $log);
    }
    
    public function getEdicoesById($id){
        $this->db->where('log_id_sorteio', $id);
        return $this->db->get('log_edicao_valor')->result_array();
    }
    
    public function getEdicoes(){
        return $this->db->get('log_edicao_valor')->result_array();
    }
    
    public function logEstorno($log){
        $this->db->insert('log_estorno', $log);
    }
    
    public function logBlock($log){
        $this->db->insert('log_block', $log);
    }
}