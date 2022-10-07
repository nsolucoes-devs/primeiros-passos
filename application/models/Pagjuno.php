<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagjuno extends CI_Model {
	
	public function sessaoJuno($dados){
	    $this->db->replace('juno', $dados);
	}
	
	public function recuperaJuno(){
	    $aux = $this->db->get('juno');
	    return $aux->row_array();
	}
    
}