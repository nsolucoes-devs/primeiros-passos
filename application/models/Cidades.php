<?php

class Cidades extends CI_Model  {
    
    
    //Recupera todos as cidades do banco
    public function getCidades(){
        $cidades = $this->db->get('cidades');
        
        return $cidades->result_array();
    }
	
	//Pega cidades com base no id do estado
    public function getCidadesPorEstado(){
        $id_estado = $this->input->post('id_estado');
        $this->db->where('estado_id', $id_estado);
        $cidades = $this->db->get('cidades');
        
        return $cidades->result_array();
    }
    
    //Pega cidade pelo id
    public function getCidadeId($id){
        $this->db->where('id_cidade', $id);
        $cidade = $this->db->get('cidades');
        
        return $cidade->row_array();
    }
}

?>