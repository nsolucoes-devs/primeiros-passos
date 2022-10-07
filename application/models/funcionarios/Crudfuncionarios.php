<?php

class Crudfuncionarios extends CI_Model  {
    
    //Recupera todos os funcionarios do banco
    public function getFuncionarios(){
        $funcionarios = $this->db->get('funcionarios');
        
        return $funcionarios->result_array();
    }
    
    //Recupera todos os vendedores do banco
    public function getVendedores(){
        if($this->session->userdata('tipo_pessoa') == 3){
            $this->db->where('loja_id', $this->session->userdata('loja_id'));
        }
        $this->db->where('tipo_id', 2);
        $vendedores = $this->db->get('funcionarios');
        
        return $vendedores->result_array();
    }
    
    //Recupera todos os administradores do banco
    public function getAdministradores(){
        $this->db->where('tipo_id', 1);
        $administradores = $this->db->get('funcionarios');
        
        return $administradores->result_array();
    }
    
    //Recupera todos os gerentes do banco
    public function getGerentes(){
        $this->db->where('tipo_id', 3);
        $gerentes = $this->db->get('funcionarios');
        
        return $gerentes->result_array();
    }
    
    //Recupera todos os gerentes e vendedores do banco
    public function getGerentesVendedores(){
        $this->db->where('tipo_id', 3);
        $this->db->where('tipo_id', 2);
        $gerentes = $this->db->get('funcionarios');
        
        return $gerentes->result_array();
    }
    
    //Pega um funcionario baseado no id
    public function getFuncionarioUnico($id){
        $this->db->where('id_funcionario', $id);
        $funcionario = $this->db->get('funcionarios');
        
        return $funcionario->row_array();
    }
    
    //Insere um funcionario no banco de dados
    public function cadastrarFuncionario($funcionario){
        $this->db->insert('funcionarios', $funcionario);
        $id = $this->db->insert_id();
        
        return $id;
    }
    
    //Busca um funcionario de acordo com o CPF
	public function getFuncionarioCpf($cpf){
	    $this->db->where('cpfcnpj_funcionario', $cpf);
	    $query = $this->db->get('funcionarios');
	    
	    return $query->row_array();
	}
	
	//Atualiza um funcionario baseado no id
	public function atualizarFuncionario($funcionario, $id){
	    $this->db->where('id_funcionario', $id);
	    $update = $this->db->update('funcionarios', $funcionario);
	}
	
	//Exclui um fornecedor baseado no id
    public function excluirFuncionario($id){
	    $this->db->where('id_funcionario', $id);
	    $this->db->delete('funcionarios');
	}
	
	//Recebe o id de um funcionario e reseta a senha dele
	public function resetarSenha($id){
	    $funcionario = array(
	        'senha_funcionario' => MD5("cellstore123"),
	    );
	    
	    $this->db->where('id_funcionario', $id);
	    $update = $this->db->update('funcionarios', $funcionario);
	}
}