<?php

class Estados extends CI_Model  {
    
    //Recupera todos os Estados do banco
    public function getEstados(){
        $estados = $this->db->get('estados');
        return $estados->result_array();
    }
    
    //Pega estado pelo id
    public function getEstadoId($id){
        $this->db->where('id_estado', $id);
        $estado = $this->db->get('estados');
        
        return $estado->row_array();
    }
	
}

?>