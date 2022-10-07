<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lojasmodel extends CI_Model {
    
	public function getlojas(){
	   return $this->db->get('loja')->result_array();
	}
	
	public function getloja($id){
	    $this->db->where('id', $id);
	    return $this->db->get('loja')->row_array();
	}
	
	public function updateloja($id, $new){
	    $this->db->where('id', $id);
	    $this->db->update('loja', $new);
	}
	
	public function insertloja($new){
	    $this->db->insert('loja', $new);
	}
	
	public function excluirloja($id){
	    $this->db->where('id', $id);
        $this->db->delete('loja');
	}
	
}