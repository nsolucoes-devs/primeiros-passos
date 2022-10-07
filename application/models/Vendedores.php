<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores extends CI_Model {
    
    public function insert($new){
        $this->db->insert('vendedores', $new);
        return $this->db->insert_id();
    }
    
    public function update($id, $new){
        $this->db->where('vendedor_id', $id);
        $this->db->update('vendedores', $new);
    }
    
    public function get($id){
        $this->db->where('vendedor_id', $id);
        return $this->db->get('vendedores')->row_array();
    }
    
    public function delete($id){
        $this->db->where('vendedor_id', $id);
        $this->db->delete('vendedores');
    }
    
    public function getAll(){
        return $this->db->get('vendedores')->result_array();
    }
    
    public function getAllPrioridade(){
        $this->db->order_by('vendedor_prioridade', 'ASC');
        return $this->db->get('vendedores')->result_array();
    }
    
    public function getAllPagination($filter, $limit, $start){
        if($filter){
            $this->db->like('vendedor_nome', $filter, 'both');
            $this->db->like('vendedor_whats', $filter, 'both');
        }
        $this->db->order_by('vendedor_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('vendedores')->result_array();
    }

    public function get_count($filter) {
        $this->db->select(" COUNT(*) as pages");
        if($filter){
            $this->db->like('vendedor_nome', $filter, 'both');
            $this->db->like('vendedor_whats', $filter, 'both');
        }
        $a = $this->db->get('vendedores')->row_array();
        return $a['pages'];
    }

    
}