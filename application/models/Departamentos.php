<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos extends CI_Model {
    
    public function insert($new){
        $this->db->insert('departamentos', $new);
        return $this->db->insert_id();
    }
    
    public function getAll(){
        $data = $this->db->get('departamentos');
        return $data->result_array();
    }
    
    public function getAllOnly(){
        $this->db->where('departamento_pai', 0);
        $data = $this->db->get('departamentos');
        return $data->result_array();
    }
    
    public function get($id){
        $this->db->where('departamento_id', $id);
        $data = $this->db->get('departamentos');
        return $data->row_array();
    }
    
    public function update($id, $new){
        $this->db->where('departamento_id', $id);
        $this->db->update('departamentos', $new);
    }
    
    public function delete($id){
        $this->db->where('departamento_id', $id);
        $this->db->delete('departamentos');
    }
    
    public function getAllDepartamentos($limit, $start){
        $this->db->select('departamento_id, departamento_nome, departamento_situacao');
        $this->db->order_by('departamento_id', 'desc');
        $this->db->where('departamento_pai', 0);
        $this->db->limit($limit, $start);
        $data = $this->db->get('departamentos');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $this->db->where('departamento_pai', 0);
        $a = $this->db->get('departamentos')->row_array();
        return $a['pages'];
    }
    
    public function getAllDepartamentosFiltro($filter, $limit, $start){
        $this->db->select('departamento_id, departamento_nome, departamento_situacao');
        $this->db->join('status', 'departamentos.departamento_situacao = status.status_id');
        $this->db->like('departamento_nome', $filter, 'both');
        $this->db->or_like('departamento_situacao', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $this->db->where('departamento_pai', 0);
        $this->db->order_by('departamento_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('departamentos');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('departamento_nome', $filter, 'both');
        $this->db->or_like('departamento_situacao', $filter, 'both');
        $this->db->where('departamento_pai', 0);
        $a = $this->db->get('departamentos')->row_array();
        return $a['pages'];
    }
    
    
    ///////////////////////
    // Sub departamentos //
    ///////////////////////
    
    
    public function getAllSubDepartamentos($limit, $start){
        $this->db->order_by('departamento_id', 'desc');
        $this->db->where('departamento_pai !=', 0);
        $this->db->limit($limit, $start);
        $data = $this->db->get('departamentos');
        return $data->result_array();
    }
    
    public function get_countSub() {
        $this->db->select(" COUNT(*) as pages");
        $this->db->where('departamento_pai !=', 0);
        $a = $this->db->get('departamentos')->row_array();
        return $a['pages'];
    }
    
    public function getAllSubDepartamentosFiltro($filter, $limit, $start){
        $this->db->where('departamento_pai !=', 0);
        $this->db->like('departamento_nome', $filter, 'both');
        $this->db->order_by('departamento_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('departamentos')->result_array();
    }
    
    public function get_countSubFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->where('departamento_pai !=', 0);
        $this->db->like('departamento_nome', $filter, 'both');
        $a = $this->db->get('departamentos')->row_array();
        return $a['pages'];
    }
    
    public function insertSub($new){
        $this->db->insert('departamentos', $new);
        return $this->db->insert_id();
    }
    
    public function updateSub($id, $new){
        $this->db->where('departamento_id', $id);
        $this->db->update('departamentos', $new);
    }
    
    public function deleteSub($id){
        $this->db->where('departamento_id', $id);
        $this->db->delete('departamentos');
    }
    
    public function getAllSub(){
        $this->db->where('departamento_pai !=', 0);
        return $this->db->get('departamentos')->result_array();
    }
    
    public function getSub($id){
        $this->db->where('departamento_id', $id);
        $this->db->where('departamento_pai !=', 0);
        return $this->db->get('departamentos')->row_array();
    }
    
    ///////////////////////////////
    // Novos scripts para header //
    ///////////////////////////////
    
    public function menuDepts(){
        $this->db->select('departamento_id, departamento_nome');
        $this->db->where('departamento_onmenu', 1);
        $this->db->where('departamento_pai', 0);
        $aux = $this->db->get('departamentos')->result_array();
        
        $this->db->select('departamento_id, departamento_nome, departamento_pai');
        $this->db->where('departamento_onmenu', 1);
        $this->db->where('departamento_pai !=', 0);
        $this->db->order_by('departamento_pai', 'ASC');
        $aux2 = $this->db->get('departamentos')->result_array();
        
        $a = [];
        
        for($i=0; $i<count($aux); $i++){
            $a[$i] = array(
		        'departamento'      => $aux[$i]['departamento_nome'],
		        'departamento_id'   => $aux[$i]['departamento_id'],
		        );
		    $pos = 0;      
            for($j=0; $j<count($aux2); $j++){
                if($aux[$i]['departamento_id'] == $aux2[$j]['departamento_pai']){
                    $a[$i]['subs'][$pos] = array(
                        'nome'  => $aux2[$j]['departamento_nome'],
                        'id'    => $aux2[$j]['departamento_id'],
                    );
                    $pos++;
                }
            }
        }
        return $a;
    }
    
    
}