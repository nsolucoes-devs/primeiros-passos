<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Model {
    
    public function insert($new){
        $this->db->insert('marcas', $new);
        return $this->db->insert_id();
    }
    
    public function update($id, $new){
        $this->db->where('marca_id', $id);
        $this->db->update('marcas', $new);
    }
    
    public function getAllAtivos(){
        $this->db->where('marca_ativo', 1);
        return $this->db->get('marcas')->result_array();
    }
    
    public function getAllMarcasFiltro($filter, $limit, $start){
        $this->db->select('marca_id, marca_nome, marca_ativo');
        $this->db->like('marca_nome', $filter, 'both');
        $this->db->order_by('marca_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('marcas');
        return $data->result_array();
    }
    
    public function getAllMarcas($limit, $start){
        $this->db->select('marca_id, marca_nome, marca_ativo');
        $this->db->order_by('marca_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('marcas');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('marcas')->row_array();
        return $a['pages'];
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('marca_nome', $filter, 'both');
        $a = $this->db->get('marcas')->row_array();
        return $a['pages'];
    }

    public function delete($id){
        $this->db->where('marca_id', $id);
        $this->db->delete('marcas');
    }
}