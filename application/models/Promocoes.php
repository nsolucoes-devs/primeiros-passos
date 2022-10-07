<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Promocoes extends CI_Model {

    public function insert($new){
        $this->db->insert('promocoes', $new);
    }
    
    public function update($id, $new){
        $this->db->where('promocao_id', $id);
        $this->db->update('promocoes', $new);
    }
    
    public function delete($id){
        $this->db->where('promocao_id', $id);
        $this->db->delete('promocoes');
    }
    
    public function getAllAtivos(){
        $this->db->where('promocao_datainicial  <=', date('Y-m-d'));
        $itens = $this->db->get('promocoes')->result_array();
        
        $promocoes  = [];
        $cont       = 0;
        
        foreach($itens as $i){
            if($i['promocao_datafinal_ativo'] == 1){
                if($i['promocao_datafinal'] >= date('Y-m-d')){
                    $promocoes[$cont] = array(
                        'promocao_preco'            => $i['promocao_preco'],
                        'promocao_preco_ativo'      => $i['promocao_preco_ativo'],
                        'promocao_desconto'         => $i['promocao_desconto'],
                        'promocao_desconto_ativo'   => $i['promocao_desconto_ativo'],
                        'promocao_cupom'            => $i['promocao_cupom'],
                        'promocao_cupom_ativo'      => $i['promocao_cupom_ativo'],
                        'promocao_produtos'         => $i['promocao_produtos'],
                        'promocao_datainicial'      => $i['promocao_datainicial'],
                        'promocao_datafinal'        => $i['promocao_datafinal'],
                        'promocao_datafinal_ativo'  => $i['promocao_datafinal_ativo'],
                    );
                }
            } else {
                $promocoes[$cont] = array(
                    'promocao_preco'            => $i['promocao_preco'],
                    'promocao_preco_ativo'      => $i['promocao_preco_ativo'],
                    'promocao_desconto'         => $i['promocao_desconto'],
                    'promocao_desconto_ativo'   => $i['promocao_desconto_ativo'],
                    'promocao_cupom'            => $i['promocao_cupom'],
                    'promocao_cupom_ativo'      => $i['promocao_cupom_ativo'],
                    'promocao_produtos'         => $i['promocao_produtos'],
                    'promocao_datainicial'      => $i['promocao_datainicial'],
                    'promocao_datafinal'        => $i['promocao_datafinal'],
                    'promocao_datafinal_ativo'  => $i['promocao_datafinal_ativo'],
                );
            }
            $cont++;
        }
        
        return $promocoes;
    }
    
    
    public function get($id){
        $this->db->where('promocao_id', $id);
        return $this->db->get('promocoes')->row_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('promocoes')->row_array();
        return $a['pages'];
    }
    
    public function getAll($limit, $start){
        $this->db->select('promocao_id, promocao_titulo, promocao_datainicial, promocao_datafinal, promocao_preco, promocao_desconto');
        $this->db->order_by('promocao_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('promocoes');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('promocao_titulo', $filter, 'both');
        $this->db->or_like('promocao_datainicial', $filter, 'both');
        $this->db->or_like('promocao_datafinal', $filter, 'both');
        $this->db->or_like('promocao_preco', $filter, 'both');
        $this->db->or_like('promocao_desconto', $filter, 'both');
        $a = $this->db->get('promocoes')->row_array();
        return $a['pages'];
    }
    
    public function getAllFiltro($filter, $limit, $start){
        $this->db->select('promocao_id, promocao_titulo, promocao_datainicial, promocao_datafinal, promocao_preco, promocao_desconto');
        $this->db->like('promocao_titulo', $filter, 'both');
        $this->db->or_like('promocao_datainicial', $filter, 'both');
        $this->db->or_like('promocao_datafinal', $filter, 'both');
        $this->db->or_like('promocao_preco', $filter, 'both');
        $this->db->or_like('promocao_desconto', $filter, 'both');
        $this->db->order_by('promocao_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('promocoes');
        return $data->result_array();
    }
 
    
}