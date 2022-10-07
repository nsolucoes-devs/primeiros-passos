<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configs extends CI_Model {
    
    public function testeBD(){
        $result = true;
        return $result;
    }
    
    
    public function updateSite($new){
        $this->db->where('id', 1);
        $this->db->update('site', $new);
    }
    
    public function insertSite($new){
        $this->db->insert('site', $new);
    }
    
    public function getSite(){
        $this->db->where('id', 1);
        $data = $this->db->get('site');
        return $data->row_array();
    }

    public function atualizaConfig($config){
	    $this->db->where('id', $config['id']);
	    $this->db->update('configs', $config);
	}
	
	public function adicionarConfig($config){
	    $this->db->insert('configs', $config);
        return $this->db->insert_id();
	}
	
	public function gestor($dados){
	    return $this->db->replace('gestorpagamento', $dados);
	}
	
	public function updateChave($id, $chave){
	    $this->db->where('chave_id', $id);
	    $this->db->update('chaves', $chave);
	}
	
	public function getChave($id){
	    $this->db->where('chave_id', $id);
	    return $this->db->get('chaves')->row_array();
	}
	
	public function getGestor(){
	    return $this->db->get('gestorpagamento')->result_array();
	}
	
	public function getEmail($id){
	    $this->db->where('email_id', $id);
	    return $this->db->get('email')->row_array();
	}
	
	public function updateEmail($id, $new){
	    $this->db->where('email_id', $id);
	    $this->db->update('email', $new);
	}
}