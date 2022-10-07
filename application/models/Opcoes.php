<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opcoes extends CI_Model {
    
    public function insert($new){
        $this->db->insert('opcoes', $new);
        return $this->db->insert_id();
    }
    
    public function update($id, $new){
        $this->db->where('opcao_id', $id);
        $this->db->update('opcoes', $new);
    }
    
    public function get($id){
        $this->db->where('opcao_id', $id);
        return $this->db->get('opcoes')->row_array();
    }
    
    public function getAllTamanhos(){
        $this->db->where('opcao_categoria', 'Tamanho');
        return $this->db->get('opcoes')->result_array();
    }
    
    public function getAllCores(){
        $this->db->where('opcao_categoria', 'Cor');
        return $this->db->get('opcoes')->result_array();
    }
    
    public function getAllByOp($op){
        $this->db->where('opcao_categoria', $op);
        return $this->db->get('opcoes')->result_array();
    }
    
    public function getAllOpcoesFiltro($filter, $limit, $start){
        if($filter){
            $this->db->like('opcao_nome', $filter, 'both');    
            $this->db->like('opcao_categoria', $filter, 'both');
        }
        
        $this->db->order_by('opcao_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('opcoes');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        
        if($filter){
            $this->db->like('opcao_nome', $filter, 'both');    
            $this->db->like('opcao_categoria', $filter, 'both');
        }
        
        $a = $this->db->get('opcoes')->row_array();
        return $a['pages'];
    }

    public function delete($id){
        $this->db->where('opcao_id', $id);
        $this->db->delete('opcoes');
    }
}