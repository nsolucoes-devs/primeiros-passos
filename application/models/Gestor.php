<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestor extends CI_Model {
    
    public function get($id){
        $this->db->where('gestor', $id);
        return $this->db->get('gestorpagamento')->row_array();
    }

    
}