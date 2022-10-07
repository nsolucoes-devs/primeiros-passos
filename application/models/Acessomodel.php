<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessomodel extends CI_Model {
    
    public function get($id){
        $this->db->where('acesso_id', $id);
        $data = $this->db->get('acessos');
        return $data->row_array();
    }
    
    public function update($id, $new){
        $this->db->where('acesso_id', $id);
        $this->db->update('acessos', $new);
    }
    
    public function insert($new){
        $this->db->insert('acessos', $new);
    }
    
    public function getVenda($id){
        $this->db->where('acesso_venda_id', $id);
        $data = $this->db->get('acessos_venda');
        return $data->row_array();
    }
    
    public function updateVenda($id, $new){
        $this->db->where('acesso_venda_id', $id);
        $this->db->update('acessos_venda', $new);
    }
    
    public function insertVenda($new){
        $this->db->insert('acessos_venda', $new);
    }
    
}