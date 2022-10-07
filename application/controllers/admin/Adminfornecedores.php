<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminfornecedores extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('fornecedoresmodel');
        $this->load->model('vendedores');
    }
	
	//Chama a view de listagem de fornecedores passando o array de fornecedores
	public function listaFornecedores(){

	    $this->load->library("pagination");
        
        
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('admin/adminfornecedores/listaFornecedores/f/' . $filtro . '/');
            $config["total_rows"] = $this->fornecedoresmodel->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['fornecedores']  = $this->fornecedoresmodel->getAllFornecedoresFiltro($filtro, 10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('admin/adminfornecedores/listaFornecedores/n/');
            $config["total_rows"] = $this->fornecedoresmodel->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['fornecedores']  = $this->fornecedoresmodel->getAllFornecedores(10, $page);
        }
	    
	    $data['fornecedores'] = $this->fornecedoresmodel->getFornecedores();
	    
	    $this->header(8);
	    $this->load->view('restrito/fornecedores', $data);
	    $this->footer();
	    
	}
	
	public function cadastroFornecedor(){
	    $data['vendedores'] = $this->vendedores->getAll();
	        
	    $this->header(8);
	    $this->load->view('restrito/fornecedoresCad', $data); 
	    $this->footer();
	    
	}
	
	public function editFornecedor(){
	    $id = $this->uri->segment(4);
	    
	    $a = $this->fornecedoresmodel->getFornecedoresId($id);
	    $a['cnpj_fornecedor']       = $this->mascararNumero($a['cnpj_fornecedor'], "documento");
	    $a['tel_fixo_fornecedor']   = $this->mascararNumero($a['tel_fixo_fornecedor'], "telefone");
	    $a['tel_cel_fornecedor']    = $this->mascararNumero($a['tel_cel_fornecedor'], "telefone");
	    $a['cep_fornecedor']        = $this->mascararNumero($a['cep_fornecedor'], "cep");
	    
	    $data['fornecedor'] = $a;
	    $data['vendedores'] = $this->vendedores->getAll();
	    
	    $this->header(8);
	    $this->load->view('restrito/fornecedoresEdit', $data); 
	    $this->footer();
	    
	}
	
	public function insertFornecedor(){
	    
	    
	    $new = array(
	        'nome_fornecedor'         => $this->input->post('cad-nome'),
	        'cnpj_fornecedor'         => $this->limpa($this->input->post('cad-cnpj')),
	        'razao_fornecedor'        => $this->input->post('cad-razao'),
	        'endereco_fornecedor'     => $this->input->post('cad-rua').'¬'. $this->input->post('cad-numero').'¬'.$this->input->post('cad-bairro').'¬'.$this->input->post('cad-cidade').'¬'.$this->input->post('cad-estado'),
	        'vendedor_fornecedor'     => $this->input->post('cad-vendedor'),
	        'inscricao_fornecedor'    => $this->limpa($this->input->post('cad-inscricao')),
	        'tel_fixo_fornecedor'     => $this->limpa($this->input->post('cad-telfixo')),
	        'tel_cel_fornecedor'      => $this->limpa($this->input->post('cad-telcelular')),
	        'cep_fornecedor'          => $this->limpa($this->input->post('cad-cep')),
	        'complemento_fornecedor'  => $this->input->post('cad-complemento'),
	    );
	    
	    $this->fornecedoresmodel->addFornecedor($new);
	    
	    Redirect('admin/adminfornecedores/listaFornecedores');
	    
	}
	
	public function updateFornecedor(){
	    $id = $this->input->post('id-edit');
	    $new = array(
    	    'id_fornecedor'                         => $_POST['id-edit'],
    	    'nome_fornecedor'                       => $_POST['edit-nome'],
    	    'razao_fornecedor'                      => $_POST['edit-razao'],
    	    'cnpj_fornecedor'                       => $this->limpa($_POST['edit-cnpj']),
    	    'inscricao_fornecedor'                  => $this->limpa($_POST['edit-inscricao']),
    	    'cep_fornecedor'                        => $this->limpa($_POST['edit-cep']),
    	    'endereco_fornecedor'                   => $_POST['edit-rua'],
    	    'numero_fornecedor'                     => $_POST['edit-numero'],
    	    'bairro_fornecedor'                     => $_POST['edit-bairro'],
    	    'cidade_fornecedor'                     => $_POST['edit-cidade'],
    	    'estado_fornecedor'                     => $_POST['edit-estado'], 
    	    'complemento_fornecedor'                => $_POST['edit-complemento'],
    	    'tel_fixo_fornecedor'                   => $this->limpa($_POST['edit-telfixo']),
    	    'tel_cel_fornecedor'                    => $this->limpa($_POST['edit-telcelular']),
    	    //'vendedor_fornecedor'                   => $_POST['edit-vendedor'],
	    );
	    $this->fornecedoresmodel->editFornecedor($id, $new);
	    redirect('admin/adminfornecedores/listaFornecedores');
	}
	
	public function excluirFornecedor(){
	    
	    
	    $id = $this->input->post('id_excluir');
	    
	    $this->fornecedoresmodel->excluir($id);
	    
	    Redirect('admin/adminfornecedores/listaFornecedores');
	    
	}
	
	public function verFornecedor(){
	    $id = $this->uri->segment(4);
	    
	    $a = $this->fornecedoresmodel->getFornecedoresId($id);
	    $a['cnpj_fornecedor']       = $this->mascararNumero($a['cnpj_fornecedor'], "documento");
	    $a['tel_fixo_fornecedor']   = $this->mascararNumero($a['tel_fixo_fornecedor'], "telefone");
	    $a['tel_cel_fornecedor']    = $this->mascararNumero($a['tel_cel_fornecedor'], "telefone");
	    $a['cep_fornecedor']        = $this->mascararNumero($a['cep_fornecedor'], "cep");
	    
	    $data['fornecedor'] = $a;
	    
	    $this->header(8);
	    $this->load->view('restrito/fornecedoresVer', $data); 
	    $this->footer();
	}
	
}

?>
