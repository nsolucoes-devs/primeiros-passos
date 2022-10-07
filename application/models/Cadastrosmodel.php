<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastrosmodel extends CI_Model {

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
    
    public function insertHistoricoDevolucao($new){
        $this->db->insert('historico_devolucao', $new);
    }
    
    public function getStatusById($id){
        $this->db->where('idStatusCompra', $id);
        return $this->db->get('statuscompras')->row_array();
    }
    
    public function getStatus(){
        $this->db->where('tipoStatusCompra', 'Devolucao');
        return $this->db->get('statuscompras')->result_array();
    }
    
    public function insertStatus($new){
        $this->db->insert('statuscompras', $new);
    }
}
    