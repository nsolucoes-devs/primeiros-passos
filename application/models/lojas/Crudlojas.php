<?php

class Crudlojas extends CI_Model  {
    
    
    //Recupera todas as lojas do banco
    public function getLojas(){
        $lojas = $this->db->get('loja')->result_array();
        return $lojas;
    }
    
    //EXCLUI UMA LOJA BASEADO NO ID
    public function excluirLoja($id){
	    $this->db->where('id_loja', $id);
	    $this->db->delete('loja');
	}
	
	//BUSCA UMA LOJA PELO CNPJ
	public function mostrarLojaCnpj($cnpj){
	    $this->db->where('cnpj', $cnpj);
	    $query = $this->db->get('loja');
	    
	    return $query->row_array();
	}
	
	//BUSCA UMA LOJA PELO CNPJ
	public function mostrarLojaCnpj2($cnpj){
	    $this->db->where('cnpj', $cnpj);
	    $query = $this->db->get('loja');
	    
	    if($query){
	       return 1;
	    }else{
	        return 2;
	    }
	}
	
	//CADASTRA UMA LOJA
    public function cadastrarLoja($loja){
        $this->db->insert('loja', $loja);
        $id = $this->db->insert_id();
        
        return $id;
    }
    
    //PEGAR LOJA UNICA PELO ID
    public function getLojaUnica($id){
        $this->db->where('id', $id);
        $lojaUnica = $this->db->get('loja');
        
        return $lojaUnica->row_array();
    }
    
    //Atualizaa uma loja baseada no id
	public function atualizarLoja($loja, $id){
	    $this->db->where('id', $id);
	    $update = $this->db->update('loja', $loja);
	    
	    return $update['id'];
	}
}

?>