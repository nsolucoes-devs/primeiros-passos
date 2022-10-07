<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminprodutos extends Admin_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('produtos');
        $this->load->model('departamentos');
        $this->load->model('marcas');
        $this->load->model('opcoes');
        $this->load->model('estoque');
        $this->load->model('lojasmodel');
        $this->load->model('usuarios');
    }
    
    public function produtos(){
        $this->load->library("pagination");
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('391a027a8fef2eba4487a00156901156/f/' . $filtro . '/');
            $config["total_rows"] = $this->produtos->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['produtos']  = $this->produtos->getAllProdutosFiltro($filtro, 10, $page);
            $data['filtro']    = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('391a027a8fef2eba4487a00156901156/n/');
            $config["total_rows"] = $this->produtos->get_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['produtos']  = $this->produtos->getAllProdutos(10, $page);
        }

        if($this->session->userdata('alert')){
            $data['alert'] = $this->session->userdata('alert');
            $this->session->unset_userdata('alert');
        }
        
        $this->header(2);
        $this->load->view('restrito/produtos', $data);
        $this->footer();
    }
    
    public function cadastrarProduto(){
        $data['marcas']         = $this->marcas->getAllAtivos();
        $data['produtos']       = $this->produtos->getAll();
        $data['departamentos']  = $this->departamentos->getAll();
        $data['tamanhos']       = $this->opcoes->getAllTamanhos();
        $data['cores']          = $this->opcoes->getAllCores();
        $data['estoques']       = $this->estoque->getAll();
        $data['lojas']          = $this->lojasmodel->getlojas();
        
        
		$this->header(2);
		$this->load->view('restrito/produto', $data);
		$this->footer();
	}
    
    private function limpaValor($valor){
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
    
    public function editaProduto(){
	    
	    $id = $this->uri->segment(2);
	    
	    $data['produto']        = $this->produtos->get($id);
	    $data['produtos']       = $this->produtos->getAll();
        $data['departamentos']  = $this->departamentos->getAll();
        $data['marcas']         = $this->marcas->getAllAtivos();
        $data['tamanhos']       = $this->opcoes->getAllTamanhos();
        $data['cores']          = $this->opcoes->getAllCores();
        $data['lojas']          = $this->lojasmodel->getlojas();
        
        $data['estoques'] = $this->estoque->getNomeProd($data['produto']['produto_nome']);
        
        
        $produto_id = $data['produto']['produto_id'];
        
    
        $estoque_lojas = $this->estoque->getEstoquePorLoja($data['produto']['produto_nome']);
      
        $data['estoque_lojas'] = $estoque_lojas;

		$this->header(2);
		$this->load->view('restrito/editaproduto', $data);
		$this->footer();
	}
	
	public function excluirProduto(){
	    
	    $dados = array(
	        'usuario'   => $_SESSION['user_id'],
	        'senha'     => $_POST['senha'],
	        );
	    $res = $this->usuarios->validar2($dados);
	    
	    if($res > 0){
	        $this->session->set_userdata('alert', 3);
	        // #5 - Chamada da função para gerar log de produto, quando der certo a senha e concluir a exclusão.
	        $produto = $this->produtos->get($_POST['id']);
	        $dados = array(
	            'produto_id'    => $_POST['id'],    
	            'produto_nome'  => $produto['produto_nome'],
	        );
	        $this->logProduto($dados);
	        // Fim #5
	        
	        $this->produtos->delete($_POST['id']);    
	    } else {
	        $this->logBlock();
	        $this->session->set_userdata('alert', 4);
	    }
	    redirect(base_url('391a027a8fef2eba4487a00156901156'), 'refresh');
	}
	
	public function excluirImagem(){
	    $id        = $this->input->post('excluirimagem');
	    $idproduto = $this->input->post('idproduto');

	    $dados = array (
	        'produto_imagens_opcional' . $id => null, 
	    );
	    
        $produto = $this->produtos->get($idproduto);

	    unlink($produto['produto_imagens_opcional'. $id]);
	    
	    $this->produtos->update($idproduto, $dados);   
	    
	    
	    
	    redirect(base_url('ba641dd761d2b77e2dd91ebff5201646/'.$idproduto), 'refresh');
	}
	
	public function updateProduto(){
	    $id = $this->input->post('id');
	    
	    $config['upload_path']          = './imagens/produtos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['overwrite']            = true;
        $config['file_name']            = $id . '.jpg';
        
        $produtos_imagens = $this->produtos->get($id);
        
        $estoqueid = $this->estoque->getNomeProd(mb_strtoupper($this->input->post('nome')));
        $quantidade = 0;
        
        foreach($estoqueid as $est){
        
            $quantidade = $quantidade + $est['estoque_quantidade'];
            
        }
        $desc = $this->input->post('desc');
       
	    $produto = array(
            'produto_nome'                      => mb_strtoupper($this->input->post('nome')),
            'produto_modelo'                    => mb_strtoupper($this->input->post('modelo')),
            'produto_codigo'                    => $this->input->post('codigo'),
            'produto_fabricante'                => mb_strtoupper($this->input->post('fabricante')),
            'produto_habilitado'                => $this->input->post('habilitado'),
            'produto_quantidade'                => $quantidade,
            'produto_estoque_minimo'            => $this->input->post('minimo'),
            'produto_minimo_venda'              => $this->input->post('minimo_venda'),
            'produto_preco_promocao'            => $this->limpaValor($this->input->post('preco_promocao')),
            'produto_preco_promocao_ativo'      => $this->input->post('preco_promocao_ativo'),
            'produto_desconto'                  => $this->input->post('desconto'),
            'produto_desconto_ativo'            => $this->input->post('desconto_ativo'),
            'produto_datainicial_promocao'      => $this->input->post('datainicial_promocao'),
            'produto_datafinal_promocao'        => $this->input->post('datafinal_promocao'),
            'produto_datafinal_promocao_ativo'  => $this->input->post('datafinal_promocao_ativo'),
            'produto_cupom'                     => $this->input->post('cupom'),
            'produto_cupom_ativo'               => $this->input->post('cupom_ativo'),
            'produto_marca_id'                  => $this->input->post('marca'),
            'produto_departamentos'             => $this->montarArray($this->input->post('departamentos')),
            'produto_relacionados'              => $this->montarArray($this->input->post('relacionados')),
            'produto_tamanhos'                  => $this->input->post('tamanhos'),
            'produto_cores'                     => $this->input->post('cores'),
            'produto_variacoes'                 => $this->montarArray($this->input->post('variacoes')),
            'produto_reduzir'                   => $this->input->post('reduzir'),
            'produto_un_medida'                 => $this->input->post('medida'),
            'produto_comprimento'               => $this->input->post('comprimento'),
            'produto_largura'                   => $this->input->post('largura'),
            'produto_altura'                    => $this->input->post('altura'),
            'produto_un_peso'                   => $this->input->post('un_peso'),
            'produto_peso'                      => $this->input->post('peso'),
            'produto_sku'                       => $this->input->post('sku'),
            'produto_ncm'                       => $this->input->post('ncm'),
            'produto_cest'                      => $this->input->post('cest'),
            'produto_upc'                       => $this->input->post('upc'),
            'produto_ean'                       => $this->input->post('ean'),
            'produto_jan'                       => $this->input->post('jan'),
            'produto_isbn'                      => $this->input->post('isbn'),
            'produto_especifico'                => $this->input->post('produto_especifico'),
            'produto_idloja'                    => $this->input->post('produto_especificoid'),
            'produto_mpn'                       => $this->input->post('mpn'),
            'produto_detalhes'                  => $desc,
        );
        
        for ($i=1; $i <=5; $i++){
            if (!empty($_FILES['opcional' . $i]['name'])){
                $produto['produto_imagens_opcional' . $i] = 'imagens/produtos/opcionais/' . $id . "-" . $i . ".jpg";
                $this->uploadOpcionais('opcional' . $i, $id . "-" . $i);
            }else if($produtos_imagens['produto_imagens_opcional' . $i] != null) {
                $produto['produto_imagens_opcional' . $i] = $produtos_imagens['produto_imagens_opcional' . $i];
            }else {
                $produto['produto_imagens_opcional' . $i] = null;
            }
        }
        
        $this->load->library('upload', $config);
        
        $this->upload->do_upload('imagem');
        
        $this->produtos->update($id, $produto);
        $this->session->set_userdata('alert', 2);
        
        redirect(base_url('391a027a8fef2eba4487a00156901156'));
	}
	
	public function verProduto(){
	    $id = $this->uri->segment(2);
	    
	    $data['produto']        = $this->produtos->get($id);
	    $data['produtos']       = $this->produtos->getAll();
        $data['departamentos']  = $this->departamentos->getAll();
        $data['marcas']         = $this->marcas->getAllAtivos();
        $data['tamanhos']       = $this->opcoes->getAllTamanhos();
        $data['cores']          = $this->opcoes->getAllCores();

        $data['estoques'] = $this->estoque->getNomeProd($data['produto']['produto_nome']);
        $quantidade = 0;
        
        
        $estoque_lojas = $this->estoque->getEstoquePorLoja($data['produto']['produto_nome']);
      
        $data['estoque_lojas'] = $estoque_lojas;
        
        foreach($data['estoques'] as $est){    
            $quantidade = $quantidade + $est['estoque_quantidade'];
        }
        
		$this->header(2);
		$this->load->view('restrito/verproduto', $data);
		$this->footer();
	}
    
    public function novoProduto(){
        $id = $this->input->post('id');
        
        $config['upload_path']          = './imagens/produtos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000;
        $config['overwrite']            = true;
        $config['file_name']            = $id . '.jpg';

        $estoqueid = $this->estoque->getNomeProd(mb_strtoupper($this->input->post('nome')));
        $quantidade = 0;
        
        foreach($estoqueid as $est){
        
            $quantidade = $quantidade + $est['estoque_quantidade'];
            
        }

        $new = array(
            'produto_nome'                      => mb_strtoupper($this->input->post('nome')),
            'produto_modelo'                    => mb_strtoupper($this->input->post('modelo')),
            'produto_codigo'                    => mb_strtoupper($this->input->post('codigo')),
            'produto_fabricante'                => mb_strtoupper($this->input->post('fabricante')),
            'produto_valor'                     => $this->limpaValor($this->input->post('valor')),
            'produto_quantidade'                => $quantidade,
            'produto_preco_promocao'            => $this->limpaValor($this->input->post('preco_promocao')),
            'produto_preco_promocao_ativo'      => $this->input->post('preco_promocao_ativo'),
            'produto_desconto'                  => $this->input->post('desconto'),
            'produto_desconto_ativo'            => $this->input->post('desconto_ativo'),
            'produto_datainicial_promocao'      => $this->input->post('datainicial_promocao'),
            'produto_datafinal_promocao'        => $this->input->post('datafinal_promocao'),
            'produto_datafinal_promocao_ativo'  => $this->input->post('datafinal_promocao_ativo'),
            'produto_cupom'                     => $this->input->post('cupom'),
            'produto_cupom_ativo'               => $this->input->post('cupom_ativo'),
            'produto_marca_id'                  => $this->input->post('marca'),
            'produto_departamentos'             => $this->montarArray($this->input->post('departamentos')),
            'produto_relacionados'              => $this->montarArray($this->input->post('relacionados')),
            'produto_tamanhos'                  => $this->input->post('tamanhos'),
            'produto_cores'                     => $this->input->post('cores'),
            'produto_variacoes'                 => $this->montarArray($this->input->post('variacoes')),
            'produto_habilitado'                => $this->input->post('habilitado'),
            //'produto_estoque_minimo'            => $this->input->post('minimo'),
            //'produto_minimo_venda'              => $this->input->post('minimo_venda'),
            //'produto_reduzir'                   => $this->input->post('reduzir'),
            'produto_un_medida'                 => $this->input->post('medida'),
            'produto_comprimento'               => $this->input->post('comprimento'),
            'produto_largura'                   => $this->input->post('largura'),
            'produto_altura'                    => $this->input->post('altura'),
            'produto_un_peso'                   => $this->input->post('un_peso'),
            'produto_peso'                      => $this->input->post('peso'),
            'produto_sku'                       => $this->input->post('sku'),
            'produto_ncm'                       => $this->input->post('ncm'),
            'produto_cest'                      => $this->input->post('cest'),
            'produto_upc'                       => $this->input->post('upc'),
            'produto_ean'                       => $this->input->post('ean'),
            'produto_jan'                       => $this->input->post('jan'),
            'produto_isbn'                      => $this->input->post('isbn'),
            'produto_mpn'                       => $this->input->post('mpn'),
            'produto_detalhes'                  => $this->input->post('desc'),
        );
        
        $id = $this->produtos->insert($new);
        $config['file_name'] = $id . '.jpg';
        
        for ($i=1; $i <=5; $i++){
            if (!empty($_FILES['opcional' . $i]['name'])){
               $produto['produto_imagens_opcional' . $i] = 'imagens/produtos/opcionais/' . $id . "-" . $i . ".jpg";
                $this->uploadOpcionais('opcional' . $i, $id . "-" . $i);
            }else {
                $produto['produto_imagens_opcional' . $i] = null;
            }
        } 
        
        $this->produtos->update($id, $produto);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('imagem');
        $this->session->set_userdata('alert', 1);
        
        redirect(base_url('391a027a8fef2eba4487a00156901156'));
    }
    
    public function montarArray($itens){
        $array  = "";
        $cont   = 0;
        if($itens){
            foreach($itens as $i){
                if($cont == 0){
                    $array .= $i;    
                } else {
                    $array .= '¬' . $i;
                }
                $cont++;
            }
        }
        return $array;
    }
    
    public function uploadOpcionais($file, $name){
        $config2['upload_path']          = './imagens/produtos/opcionais/';
        $config2['allowed_types']        = 'gif|jpg|png|jpeg';
        $config2['max_size']             = '10000';
        $config2['overwrite']            = true;
        $config2['file_name']            = $name . '.jpg';
        
        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);
        
        $this->upload->do_upload($file);
    }
    
    public function logProduto($dados){
        $this->load->model('Logger');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'logproduto_ip'             => $_SERVER['REMOTE_ADDR'],
            'logproduto_user_id'        => $this->session->userdata('user_id'),
            'logproduto_data'           => date('Y-m-d'),
            'logproduto_hora'           => date('H:i:s'),
            'logproduto_produto_nome'   => $dados['produto_nome'],  
            'logproduto_produto_id'     => $dados['produto_id'],  
        );
        
        $this->logger->logProduto($log);
    }
    
    public function logBlock(){
        $this->load->model('Logger');
        $this->load->model('usuarios');
        date_default_timezone_set('America/Sao_Paulo');
        
        $log = array(
            'log_ip'             => $_SERVER['REMOTE_ADDR'],
            'log_user_id'        => $this->session->userdata('user_id'),
            'log_nome'           => $this->session->userdata('nome'),
            'log_data'           => date('Y-m-d'),
            'log_hora'           => date('H:i:s'),
            'log_funcao'         => '391a027a8fef2eba4487a00156901156',  
            'log_tipo'           => 'SENHA',  
        );
        
        
        if($this->session->userdata('user_block')){
            $cont = $this->session->userdata('user_block');
            $this->session->set_userdata('user_block', $cont + 1);
        } else {
            $this->session->set_userdata('user_block', 1);
        }
        
        if($this->session->userdata('user_block') >= 3){
            $user_content = array(
                'ativo' => 0,
            );
            $this->usuarios->atualizarUsuario($user_content, $this->session->userdata('user_id'));
            
            $this->session->unset_userdata('user_block');
            
            redirect(base_url('dc28f82848daefd26e2f0f38094d5818'));
        }
        
        
        $this->logger->logBlock($log);
    }
}