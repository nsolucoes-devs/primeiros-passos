<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends CI_Model {
    
    public function getAll(){
        $estados = $this->db->get('estados');
        return $estados->result_array();
    }
    
    public function getAllCidade(){
        $cidades = $this->db->get('cidades');
        return $cidades->result_array();
    }
    
    public function populaCidades($id){
        $this->db->where('estado_id', $id);
        $cidades = $this->db->get('cidades');
        return $cidades->result_array();
    }
    
    public function getEstado($id){
        $this->db->where('id_estado', $id);
        $estado = $this->db->get('estados');
        return $estado->row_array();
    }
    
    public function getCidade($id){
        $this->db->where('id_cidade', $id);
        $cidade = $this->db->get('cidades');
        return $cidade->row_array();
    }
}