<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {
    
    function logar($user){
        $this->db->where('login_usuario', $user);
	    $userid = $this->db->get('usuarios')->row_array();
	    
	    if($userid['usuario_funcionario_id'] != 0){
	        $this->db->where('id_funcionario', $userid['usuario_funcionario_id']);
	        $a = $this->db->get('funcionarios')->row_array();
	        
	    }else{
	        $a['loja_id'] = 0;
	    }
	    $userid['loja_id'] = $a['loja_id'];
	    
	    return $userid;
    }
    
    //função que pega um usuario com base no id
	public function usuarioId($id){
	    $this->db->where('id_usuario', $id);
	    $userid = $this->db->get('usuarios');
	    return $userid->row_array();
	}
	
	//função que pega todos os usuários
	public function getUsuarios(){
	    $this->db->where('super', 0);
	    $userid = $this->db->get('usuarios');
	    return $userid->result_array();
	}
	
	public function get($id){
	    $this->db->where('id_usuario', $id);
	    $userid = $this->db->get('usuarios');
	    return $userid->row_array();
	}
	
	public function getAll(){
	    $userid = $this->db->get('usuarios');
	    return $userid->result_array();
	}
	
	public function adicionarUsuario($user){
	    if($user['usuario_funcionario_id'] != 0){
    	    $this->db->where('id_funcionario', $user['usuario_funcionario_id']);
    	    $func = $this->db->get('funcionarios')->row_array();
    	    $user['usuario_funcionario'] = $func['nome_funcionario'];
	    }
	    $this->db->insert('usuarios', $user);
	    return $this->db->insert_id();
	}
	
	public function excluirUsuario($id){
	    $this->db->where('id_usuario', $id);
	    $this->db->delete('usuarios');
	}
	
	public function atualizarUsuario($us, $id){
	    $this->db->where('id_usuario', $id);
	    $this->db->update('usuarios', $us);
	}
	
	public function getAllUsuarios($limit, $start){
        $this->db->select('id_usuario, nome_usuario, login_usuario, email, telefone, ativo');
        $this->db->order_by('id_usuario', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('usuarios');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('usuarios')->row_array();
        return $a['pages'];
    }
    
    public function getAllUsuariosFiltro($filter, $limit, $start){
        $this->db->select('id_usuario, nome_usuario, login_usuario, email, telefone, ativo');
        $this->db->join('status_cliente', 'usuarios.ativo = status_cliente.status_id');
        $this->db->like('nome_usuario', $filter, 'both');
        $this->db->or_like('login_usuario', $filter, 'both');
        $this->db->or_like('email', $filter, 'both');
        $this->db->or_like('telefone', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $this->db->order_by('id_usuario', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('usuarios');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('nome_usuario', $filter, 'both');
        $this->db->or_like('login_usuario', $filter, 'both');
        $this->db->or_like('email', $filter, 'both');
        $this->db->or_like('telefone', $filter, 'both');
        $a = $this->db->get('usuarios')->row_array();
        return $a['pages'];
    }
	
	public function validar($dados){
	    $this->db->where('login_usuario', $dados['usuario']);
	    $this->db->where('senha_usuario', md5($dados['senha']));
	    $userid = $this->db->get('usuarios')->result_array();
	    return count($userid);
	}
	
	public function validar2($dados){
	    $this->db->where('id_usuario', $dados['usuario']);
	    $this->db->where('senha_usuario', md5($dados['senha']));
	    $userid = $this->db->get('usuarios')->result_array();
	    return count($userid);
	}
	
	public function login($dados){
	    //[login] => super.admin [senha] => ac#devns3001
	    $this->db->where('login_usuario', $dados['login']);
	    $user = $this->db->get('usuarios')->row_array();
	    if(is_array($user)){
	        if(md5($dados['senha']) == $user['senha_usuario']){
	            if($user['ativo'] == 1){
	                $data = array(
	                    'id_usuario'                => $user['id_usuario'],
	                    'usuario_funcionario_id'    => $user['usuario_funcionario_id'],
	                    'nome_usuario'              => $user['nome_usuario'],
	                    'perfil'                    => $user['perfil'],
	                    'super'                     => $user['super'],
	                    'loja_id'                   => null,
	                    );
	                    return $data;
	            }else{
	                $data['erro'] = "Usuário bloqueado, contate o gerente!";
	                return $data;    
	            }
	        }else{
	            $data['erro'] = "Senha inválida!";
	            return $data;
	        }
	    }else{
	        $this->db->where('login_funcionario', $dados['login']);
	        $user = $this->db->get('funcionarios')->row_array();
	        if(is_array($user)){
	            if(md5($dados['senha']) == $user['senha_funcionario']){
	                if($user['ativo'] == 1){
	                    $data = array(
                            'id_usuario'                => $user['id_funcionario'],	                        
	                        'usuario_funcionario_id'    => $user['id_funcionario'],
	                        'nome_usuario'              => $user['nome_funcionario'],
	                        'perfil'                    => $user['perfil'],
	                        'super'                     => "null",
	                        'loja_id'                   => $user['loja_id'],
	                    );
	                    return $data;
    	            }else{
    	                $data['erro'] = "Usuário bloqueado, contate o gerente!";
    	                return $data;    
    	            }
	        }else{
	            $data['erro'] = "Senha inválida!";
	            return $data;
	        }
	        }else{
	            $data['erro'] = "Usuário não encontrado!";
	            return $data;
	        }
	    }
	}
}