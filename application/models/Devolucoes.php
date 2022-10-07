<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucoes extends CI_Model {

    public function getAllReembolso(){
        $data = $this->db->get('reembolso');
        return $data->result_array();
    }
    
    public function getReembolso($id){
        $this->db->where('reembolso_id', $id);
        $data = $this->db->get('reembolso');
        return $data->row_array();
    }

    public function reembolso($data){
        $this->db->insert('reembolso ', $data);
        return $this->db->insert_id();
    }
    
    public function editReembolso($data, $id){
        $this->db->where('reembolso_id', $id);
        $this->db->update('reembolso', $data);
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('reembolso')->row_array();
        return $a['pages'];
    }
    
    public function getAll($limit, $start){
        $this->db->select('reembolso_id, reembolso_protocolo, reembolso_nome, reembolso_cpf, reembolso_data, reembolso_email, reembolso_celular, reembolso_status');
        $this->db->order_by('reembolso_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('reembolso');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('reembolso_protocolo', $filter, 'both');
        $this->db->or_like('reembolso_nome', $filter, 'both');
        $this->db->or_like('reembolso_cpf', $filter, 'both');
        $this->db->or_like('reembolso_data', $filter, 'both');
        $this->db->or_like('reembolso_email', $filter, 'both');
        $this->db->or_like('reembolso_celular', $filter, 'both');
        $this->db->or_like('reembolso_status', $filter, 'both');
        $a = $this->db->get('reembolso')->row_array();
        return $a['pages'];
    }
    
    public function getAllFiltro($filter, $limit, $start){
        $this->db->select('reembolso_id, reembolso_protocolo, reembolso_nome, reembolso_cpf, reembolso_data, reembolso_email, reembolso_celular, reembolso_status');
        $this->db->join('statuscompras', 'reembolso.reembolso_status = statuscompras.idStatusCompra');
        $this->db->like('reembolso_protocolo', $filter, 'both');
        $this->db->or_like('reembolso_nome', $filter, 'both');
        $this->db->or_like('reembolso_cpf', $filter, 'both');
        $this->db->or_like('reembolso_data', $filter, 'both');
        $this->db->or_like('reembolso_email', $filter, 'both');
        $this->db->or_like('reembolso_celular', $filter, 'both');
        $this->db->or_like('reembolso_status', $filter, 'both');
        $this->db->or_like('nomeStatusCompra', $filter, 'both');
        $this->db->order_by('reembolso_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('reembolso');
        return $data->result_array();
    }
    
}
    