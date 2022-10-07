<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedoresmodel extends CI_Model {
    
    public function getFornecedores(){
        $data = $this->db->get('fornecedores');
        return $data->result_array();
    }
    
    public function getFornecedoresId($id){
        $this->db->where('id_fornecedor', $id);
        $data = $this->db->get('fornecedores');
        return $data->row_array();
    }
    
    public function addFornecedor($new){
        $this->db->insert('fornecedores', $new);
    }
    
    public function editFornecedor($id, $new){
        $this->db->where('id_fornecedor', $id);
        $this->db->update('fornecedores', $new);
    }
    
    public function excluirFornecedor($id){
	    $this->db->where('id', $id);
        $this->db->delete('fornecedores');
	}
	
	public function excluir($id){
	    $this->db->where('Id_fornecedor', $id);
        $this->db->delete('fornecedores');
	}
	
	public function getAllFornecedoresFiltro($filter, $limit, $start){
        $this->db->like('nome_fornecedor', $filter, 'both');
        $this->db->order_by('id_fornecedor', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('fornecedores');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('fornecedores')->row_array();
        return $a['pages'];
    }
    
    public function getAllFornecedores($limit, $start){
        $this->db->order_by('id_fornecedor', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('fornecedores');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('nome_fornecedor', $filter, 'both');
        $a = $this->db->get('fornecedores')->row_array();
        return $a['pages'];
    }
    
}