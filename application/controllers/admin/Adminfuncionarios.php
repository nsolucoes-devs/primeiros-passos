<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminfuncionarios extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('lojasmodel');
        $this->load->model('funcionariosmodel');
    }
	
	//Chama a view de listagem de fornecedores passando o array de fornecedores
	public function listaFuncionarios(){
	    $this->load->library("pagination");
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('admin/adminfuncionarios/listaFuncionarios/f/' . $filtro . '/');
            $config["total_rows"] = $this->funcionariosmodel->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['funcionarios']  = $this->funcionariosmodel->getAllFuncionariosFiltro($filtro, 10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('admin/adminfuncionarios/listaFuncionarios/n/');
            $config["total_rows"] = $this->funcionariosmodel->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['funcionarios']  = $this->funcionariosmodel->getAllFuncionarios(10, $page);
        }
	    
	    $data['lojas'] = $this->lojasmodel->getlojas();
	    $data['funcionarios'] = $this->funcionariosmodel->getFuncionarios();
	    
	    $this->header(8);
	    $this->load->view('restrito/funcionariosVer', $data);
	    $this->footer();
	}
	
	//Cadastro funcionario
	public function insertFuncionarios(){
	    $new = array(
	        'nome_funcionario'        => $this->input->post('cad-nome'),
	        'cpf_funcionario'         => $this->input->post('cad-cpf'),
	        /*'cep_id'                  => $this->input->post('cad-cep'),*/
	        'cidade_id'               => $this->input->post('cad-cidade'),
	        'estado_id'               => $this->input->post('cad-estado'),
	        'loja_id'                 => $this->input->post('cad-lojas'),
	        'comissao_funcionario'    => $this->input->post('cad-comissao'),
	        );
	    
	    $this->funcionariosmodel->cadastrarFuncionario($new);
	    
	    Redirect('admin/adminfuncionarios/listaFuncionarios');
	    
	}
	
	//Edicao funcionario
	/*public function editFuncionarios(){
        $id = $this->input->post('id_editar');
        
        $new = array(
	        'nome_funcionario'        => $this->input->post('nome-edit'),
	        'cpf_funcionario'         => $this->input->post('cpf-edit'),
	       /* 'cep_id'                  => $this->input->post('cep-edit'),
	        'cidade_id'               => $this->input->post('cidade-edit'),
	        'estado_id'               => $this->input->post('estado-edit'),
	        'loja_id'                 => $this->input->post('lojas-edit'),
	        'comissao_funcionario'    => $this->input->post('comissao-edit'),
	        );
        
        $this->funcionariosmodel->atualizarFuncionario($new, $id);
        
        Redirect('admin/adminfuncionarios/listaFuncionarios');
    }*/
	
	public function getFuncionarioUnico(){
	    $id = $this->input->post('id');
	    
	    $a = $this->funcionariosmodel->getFuncionarioUnico($id);
	    
	    echo json_encode($a);
	}
	
	public function excluirfuncionario(){
	    $id = $this->input->post('id_excluir');
	    
	    $this->funcionariosmodel->excluirFuncionario($id);
        
        Redirect('admin/adminfuncionarios/listaFuncionarios');
	}
	
	/*Funções feitas por Anderson Moreira em 04/01/2022*/
	public function addFuncionario(){
	    $html = $this->funcionariosmodel->modalAddFuncionario();
	    echo json_encode($html);
	}
	public function editFuncionario(){
	    $html = $this->funcionariosmodel->modaleditFuncionario($_POST['id']);
	    echo json_encode($html);
	}
    public function seeFuncionario(){
	    $html = $this->funcionariosmodel->modalseeFuncionario($_POST['id']);
	    echo json_encode($html);
	}
    public function delFuncionario(){
	    $html = $this->funcionariosmodel->excluirFuncionario($_POST['id']);
	    echo json_encode($html);
	}
	
	public function appendFuncionario(){
	    $aux = explode(" ", $_POST['nomeModal']);
	    $login = $aux[0].".".$aux[count($aux)-1];
    	$dados = array(
    	    'nome_funcionario'          => $_POST['nomeModal'],
    	    'cidade_id'                 => $_POST['cidadeModal'],
    	    'estado_id'                 => $_POST['estadoModal'],
    	    'cpf_funcionario'           => $this->limpa($_POST['cpfModal']),
    	    'perfil'                    => $_POST['perfilModal'],
    	    'tipo_id'                   => 3,
    	    'loja_id'                   => $_POST['lojaModal'],
    	    'comissao_funcionario'      => $_POST['comissaoModal'],
    	    'cep_id'                    => $this->limpa($_POST['cepModal']),
    	    'endereco_funcionario'      => $_POST['lograModal'],
    	    'numero_funcionario'        => $_POST['numeroModal'],
    	    'complemento_funcionario'   => $_POST['complModal'],
    	    'bairro_funcionario'        => $_POST['bairroModal'],
    	    'senha_funcionario'         => md5($_POST['cpfModal']),
    	    'login_funcionario'         => $this->tirarAcentos(strtolower($login)),
    	    'data_ultimasenha'          => date('Y-m-d H:i:s'),
	    );
	    
	    if(isset($_POST['idModal'])){
	        $dados['id_funcionario'] = $_POST['idModal'];
	    }
	    
	    $this->funcionariosmodel->appendFuncionario($dados);
	    redirect(base_url('admin/adminfuncionarios/listaFuncionarios'));
	}
	
	public function newSenha(){
	    $html = $this->funcionariosmodel->updatePass($_POST);
	    redirect(base_url('admin/adminfuncionarios/listaFuncionarios'));
	}
	
	public function limpa($val){
	    $helper = array(",", ".", "(", ")", "+", "-", " ", "/", "_");
        return str_replace($helper, "", $val);
	}
	
	function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
	/*Fim das Funções feitas por Anderson Moreira em 04/01/2022*/
}

?>
