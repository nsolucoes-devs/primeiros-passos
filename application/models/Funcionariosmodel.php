<?php

class Funcionariosmodel extends CI_Model  {
    
    //Recupera todos os funcionarios do banco
    public function getFuncionarios(){
        $funcionarios = $this->db->get('funcionarios');
        
        return $funcionarios->result_array();
    }
    
    public function getFuncionariosS(){
        $this->db->select("id_funcionario, nome_funcionario, loja_id, comissao_funcionario, perfil");
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
	
	//Pega os nomes de Lojas do banco
// 	public function getLojaNome(){
// 	    $this->db->where('loja_id');
// 	    $query = $this->db->get('');
// 	}
    
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
	    $this->db->where('cpf_funcionario', $cpf);
	    $query = $this->db->get('funcionarios');
	    
	    return $query->row_array();
	}
	
	//Atualiza um funcionario baseado no id
	public function atualizarFuncionario($funcionario, $id){
	    $this->db->where('id_funcionario', $id);
	    $this->db->update('funcionarios', $funcionario);
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
	
	public function getAllFuncionariosFiltro($filter, $limit, $start){
        $this->db->like('nome_funcionario', $filter, 'both');
        $this->db->order_by('id_funcionario', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('funcionarios');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('funcionarios')->row_array();
        return $a['pages'];
    }
    
    public function getAllFuncionarios($limit, $start){
        $this->db->order_by('id_funcionario', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('funcionarios');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('nome_funcionario', $filter, 'both');
        $a = $this->db->get('funcionarios')->row_array();
        return $a['pages'];
    }
    
    /*Funções feitas por Anderson Moreira em 04/01/2022*/
    public function modalAddFuncionario(){
        $this->db->select('id, nome');
        $a = $this->db->get('loja')->result_array();
        $c = $this->db->get('perfilusuario')->result_array();
        
        $html = "<div class='modal-content'>
            <form action=".base_url('appendFuncionarios')." method='post'>
            <div class='modal-header' style='background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);'>
            <h4 class='modal-title' style='color: white; display: inline;'>ADICIONAR FUNCIONÁRIO</h4>
            <button type='button' style='color: white' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <div class='row'>
            <div class='col-md-9 form-group'>
            <label><b>Nome completo: </b></label>
            <input type='text' id='nomeModal' name='nomeModal' class='form-control' required>
            </div> 
            <div class='col-md-3 form-group'>
            <label><b>CPF: </b></label>
            <input type='text' id='cpfModal' name='cpfModal' class='form-control' required>
            </div> 
            </div>
            <div class='row'>
            <div class='col-md-4 form-group'>
            <label><b>CEP: </b></label>
            <input onfocusout='buscaCEP()' id='cepModal' name='cepModal' class='form-control' required>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Número: </b></label>
            <input id='numeroModal' name='numeroModal' class='form-control' required>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Complemento: </b></label>
            <input id='complModal' name='complModal' class='form-control' required>
            </div>
            <div class='col-md-12 form-group'>
            <label><b>Logradouro: </b></label>
            <input type='text' id='lograModal' name='lograModal' class='form-control' readonly required>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Bairro: </b></label>
            <input type='text' id='bairroModal' name='bairroModal' class='form-control' readonly required>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Cidade: </b></label>
            <input type='text' id='cidadeModal' name='cidadeModal' class='form-control' readonly required>
            </div> 
            <div class='col-md-2 form-group'>
            <label><b>Estado:</b></label>
            <input type='text' id='estadoModal' name='estadoModal' class='form-control' readonly required>
            </div>
            </div>
                <div class='row'>
                    <div class='col-md-8 form-group'>
                        <label><b>Loja: </b></label>
                            <select id='lojaModal' name='lojaModal' class='form-control'>";
                                foreach($a as $l){ 
                                    $html .= "<option value='".$l['id']."'>".$l['nome']."</option>";
                                }   
                            $html .= "</select>
                    </div>
                    <div class='col-md-4 form-group'>
                        <label><b>Comissão: </b></label>
                        <input type='text' id='comissaoModal' name='comissaoModal' class='form-control' required>
                    </div>  
                </div>
                <div class='row'>
                    <div class='col-md-12 form-group'>
                        <label><b>Cargo: </b></label>
                            <select id='perfilModal' name='perfilModal' class='form-control'>";
                                foreach($c as $p){ 
                                    $html .= "<option value='".$p['perfilusuario_id']."'>".$p['perfilusuario_nome']."</option>";
                                }   
                            $html .= "</select>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
            <button type='submit' class='btn btn-primary'>Salvar</button>
            <button type='button' class='btn btn-danger' onclick='modalDispose()'>Cancelar</button>
            </div>
            </form>
            </div>";
        return $html;
    }
    
    public function modaleditFuncionario($id){
        $this->db->select('id, nome');
        $a = $this->db->get('loja')->result_array();
        
        $this->db->where('id_funcionario', $id);
        $b = $this->db->get('funcionarios')->row_array();
        
        $b['cpf_funcionario'] = $this->mascara($b['cpf_funcionario'], "cpf");
        $b['cep_id'] = $this->mascara($b['cep_id'], "cep");
        $c = $this->db->get('perfilusuario')->result_array();
        
        $html = "<div class='modal-content'>
            <form action=".base_url('appendFuncionarios')." method='post'>
            <input type='hidden' id='idModal' name='idModal' class='form-control' value='".$b['id_funcionario']."'>
            <div class='modal-header' style='background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);'>
            <h4 class='modal-title' style='color: white; display: inline;'>EDITAR FUNCIONÁRIO</h4>
            <button type='button' style='color: white' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <div class='col-md-12 form-group'>
            <label><b>Usuário: </b></label>
            <input style='width:60%;' type='text' id='loginModal' name='loginModal' class='form-control' value='".$b['login_funcionario']."' readonly>
            <button style='margin-top:-6%; float:right' type='button' class='btn btn-primary' onclick='alterarSenha(".$id.")'>Alterar Senha</button>
            </div>
            <div class='row'>
            <div class='col-md-8 form-group'>
            <label><b>Nome completo: </b></label>
            <input type='text' id='nomeModal' name='nomeModal' class='form-control' value='".$b['nome_funcionario']."' required>
            </div> 
            <div class='col-md-4 form-group'>
            <label><b>CPF: </b></label>
            <input type='text' id='cpfModal' name='cpfModal' class='form-control' value='".$b['cpf_funcionario']."' required>
            </div> 
            </div>
            <div class='row'>
            <div class='col-md-4 form-group'>
            <label><b>CEP: </b></label>
            <input onfocusout='buscaCEP()' id='cepModal' name='cepModal' class='form-control' value='".$b['cep_id']."' required>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Número: </b></label>
            <input id='numeroModal' name='numeroModal' class='form-control' value='".$b['numero_funcionario']."' required>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Complemento: </b></label>
            <input id='complModal' name='complModal' class='form-control' value='".$b['complemento_funcionario']."' >
            </div>
            <div class='col-md-12 form-group'>
            <label><b>Logradouro: </b></label>
            <input type='text' id='lograModal' name='lograModal' class='form-control' readonly value='".$b['endereco_funcionario']."' required>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Bairro: </b></label>
            <input type='text' id='bairroModal' name='bairroModal' class='form-control' readonly value='".$b['nome_funcionario']."' required>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Cidade: </b></label>
            <input type='text' id='cidadeModal' name='cidadeModal' class='form-control' readonly value='".$b['cidade_id']."' required>
            </div> 
            <div class='col-md-2 form-group'>
            <label><b>Estado:</b></label>
            <input type='text' id='estadoModal' name='estadoModal' class='form-control' readonly value='".$b['estado_id']."' required>
            </div>
            </div>
            <div class='row'>
                <div class='col-md-8 form-group'>
                    <label><b>Loja: </b></label>
                    <select id='lojaModal' name='lojaModal' class='form-control'>";
                        foreach($a as $l){ 
                            if($b['loja_id'] == $l['id']){
                                $html .= "<option selected value='".$l['id']."'>".$l['nome']."</option>";
                            }else{
                                $html .= "<option value='".$l['id']."'>".$l['nome']."</option>";
                            }
                        }
                    $html .= "</select>
                </div>
                <div class='col-md-4 form-group'>
                    <label><b>Comissão: </b></label>
                    <input type='text' id='comissaoModal' name='comissaoModal' class='form-control' value='".$b['comissao_funcionario']."' required>
                </div>  
            </div>
            <div class='row'>
                <div class='col-md-12 form-group'>
                    <label><b>Cargo: </b></label>
                        <select id='perfilModal' name='perfilModal' class='form-control'>";
                            foreach($c as $p){ 
                                $html .= "<option"; 
                                if($p['perfilusuario_id'] == $b['perfil']){
                                    $html .=" selected";
                                } $html .=" value='".$p['perfilusuario_id']."'>".$p['perfilusuario_nome']."</option>";
                            }   
                        $html .= "</select>
                </div>
            </div>
            </div>
            <div class='modal-footer'>
            <button type='submit' class='btn btn-primary'>Editar</button>
            <button type='button' class='btn btn-danger' onclick='modalDispose()'>Cancelar</button>
            </div>
            </form>
            </div>";
            
        return $html;
    }
    
    public function modalseeFuncionario($id){
        $this->db->select('id, nome');
        $a = $this->db->get('loja')->result_array();
        
        $this->db->where('id_funcionario', $id);
        $b = $this->db->get('funcionarios')->row_array();
        
        $b['cpf_funcionario'] = $this->mascara($b['cpf_funcionario'], "cpf");
        $b['cep_id'] = $this->mascara($b['cep_id'], "cep");
        
        $this->db->where('perfilusuario_id', $b['perfil']);
        $b['perfil'] = $this->db->get('perfilusuario')->row_array();
        $b['perfil'] = $b['perfil']['perfilusuario_nome'];
        
        $html = "<div class='modal-content'>
            <div class='modal-header' style='background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);'>
            <h4 class='modal-title' style='color: white; display: inline;'>VER FUNCIONÁRIO</h4>
            <button type='button' style='color: white' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <div class='col-md-12 form-group'>
            <label><b>Usuário: </b></label>
            <input type='text' id='loginModal' name='loginModal' class='form-control' value='".$b['login_funcionario']."' readonly>
            </div>
            <div class='row'>
            <div class='col-md-8 form-group'>
            <label><b>Nome completo: </b></label>
            <input readonly type='text' id='nomeModal' name='nomeModal' class='form-control' value='".$b['nome_funcionario']."'>
            </div> 
            <div class='col-md-4 form-group'>
            <label><b>CPF: </b></label>
            <input readonly type='text' id='cpfModal' name='cpfModal' class='form-control' value='".$b['cpf_funcionario']."'>
            </div> 
            </div>
            <div class='row'>
            <div class='col-md-4 form-group'>
            <label><b>CEP: </b></label>
            <input readonly onfocusout='buscaCEP()' id='cepModal' name='cepModal' class='form-control' value='".$b['cep_id']."'>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Número: </b></label>
            <input readonly id='numeroModal' name='numeroModal' class='form-control' value='".$b['numero_funcionario']."'>
            </div>
            <div class='col-md-4 form-group'>
            <label><b>Complemento: </b></label>
            <input readonly id='complModal' name='complModal' class='form-control' value='".$b['complemento_funcionario']."' >
            </div>
            <div class='col-md-12 form-group'>
            <label><b>Logradouro: </b></label>
            <input readonly type='text' id='lograModal' name='lograModal' class='form-control' value='".$b['endereco_funcionario']."'>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Bairro: </b></label>
            <input readonly type='text' id='bairroModal' name='bairroModal' class='form-control' value='".$b['nome_funcionario']."'>
            </div> 
            <div class='col-md-5 form-group'>
            <label><b>Cidade: </b></label>
            <input readonly type='text' id='cidadeModal' name='cidadeModal' class='form-control' value='".$b['cidade_id']."'>
            </div> 
            <div class='col-md-2 form-group'>
            <label><b>Estado:</b></label>
            <input readonly type='text' id='estadoModal' name='estadoModal' class='form-control' value='".$b['estado_id']."'>
            </div>
            </div>
            <div class='row'>
                <div class='col-md-8 form-group'>
                    <label><b>Loja: </b></label>
                    <select id='lojaModal' name='lojaModal' class='form-control' readonly>";
                        foreach($a as $l){ 
                            if($b['loja_id'] == $l['id']){
                                $html .= "<option selected value='".$l['id']."'>".$l['nome']."</option>";
                            }else{
                                $html .= "<option value='".$l['id']."'>".$l['nome']."</option>";
                            }
                        }
                    $html .= "</select>
                </div>
                <div class='col-md-4 form-group'>
                    <label><b>Comissão: </b></label>
                    <input readonly type='text' id='comissaoModal' name='comissaoModal' class='form-control' value='".$b['comissao_funcionario']."'>
                </div>  
            </div>
            <div class='row'>
                <div class='col-md-12 form-group'>
                    <label><b>Cargo: </b></label>
                    <input readonly type='text' id='perfilModal' name='perfilModal' class='form-control' value='".$b['perfil']."'>
                </div>
            </div>
            </div>
            <div class='modal-footer'>
            <button type='button' class='btn btn-danger' onclick='modalDispose()'>Fechar</button>
            </div>
            </div>";
        return $html;
    }
    
    public function delFuncionario($id){
        $this->db->where('cpf_funcionario', $id);
	    return $this->db->delete('funcionarios');
    }
    
    public function appendFuncionario($dados){
        $this->db->replace('funcionarios', $dados);
    }
    
    public function updatePass($dados){
        $this->db->where('id_funcionario', $dados['newIdModal']);
	    $a =  $this->db->get('funcionarios')->row_array();
	    $a['senha_funcionario'] = md5($dados['passModal']);
	    return $this->db->replace('funcionarios', $a);
    }
    
    public function mascara($element, $mask){
        if($mask == "cpf"){
            $retorno = substr($element, 0, 3) . "." . substr($element, 3, 3) . "." . substr($element, 6, 3). "-" . substr($element, 9);
        }else if($mask == "tel"){
            if(strlen($element) == 11){
                $retorno = "(" . substr($element, 0, 2) . ") " . substr($element, 2, 5) . "-" . substr($element, 7);
            }else{
                $retorno = "(" . substr($element, 0, 2) . ") " . substr($element, 2, 4) . "-" . substr($element, 6);
            }
        }else if($mask == "cep"){
            $retorno = substr($element, 0, 5) . "-" . substr($element, 5, 3);
        }
        
        return $retorno;
    }
    /*Fim Funções feitas por Anderson Moreira em 04/01/2022*/
}