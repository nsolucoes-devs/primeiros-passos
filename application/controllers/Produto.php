<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('promocoes');
	    $this->load->model('configs');
	    $this->load->model('produtos');
	    $this->load->model('departamentos');
	    $this->load->model('opcoes');
	    $this->load->library("pagination");
    }

    public function produtoPromocao($produto){
        $valor          = null;
        $porcentagem    = null;
        
        if($produto){
            $promocoes = $this->promocoes->getAllAtivos();
            
            foreach($promocoes as $promo){
                $aux_produtos = explode('¬', $promo['promocao_produtos']);
                foreach($aux_produtos as $a){
                    if($a == $produto['produto_id']){
                        
                        if($promo['promocao_cupom_ativo'] == 0){
                		    if($promo['promocao_preco_ativo'] == 1){
                		        $valor = $promo['promocao_preco'];
                		        $porcentagem = 100 - (($promo['promocao_preco'] * 100) / $produto['produto_valor']); 
                		    } else if($promo['promocao_desconto_ativo'] == 1){
                		        $porcentagem = $promo['promocao_desconto'];
                		        $valor = $produto['produto_valor'] - (($promo['promocao_desconto']/100) * $produto['produto_valor']);
                		    }
                		}
                    }
                }
            }
            
            if($valor == null){ 
                $boolean = true;
                if($produto['produto_datainicial_promocao'] > date('Y-m-d')){
                    $boolean = false;
                }
                if($produto['produto_datafinal_promocao_ativo'] == 1){
                    if($produto['produto_datafinal_promocao'] < date('Y-m-d')){
                        $boolean = false;
                    }
                }
                if($boolean == true){
                    if($produto['produto_cupom_ativo'] == 0){
            		    if($produto['produto_preco_promocao_ativo'] == 1){
            		        $valor = $produto['produto_preco_promocao'];
            		        $porcentagem = 100 - (($produto['produto_preco_promocao'] * 100) / $produto['produto_valor']); 
            		    } else if($produto['produto_desconto_ativo'] == 1){
            		        $desconto = $produto['produto_desconto'];
            		        $porcentagem = $produto['produto_desconto'];
            		        $valor = $produto['produto_valor'] - (($produto['produto_desconto']/100) * $produto['produto_valor']);
            		    }
            		}
                }
            }
    		
    		$array = array(
    		    'valor'         => $valor,
    		    'porcentagem'   => $porcentagem,
    		);
        }
		return $array;
    }
        
        
    public function verProduto(){
		/*$data['produto'] = $this->produtos->getAtivo($this->uri->segment(2));
        $produtos       = $relacionados = $tamanhos = $cores = [];
        $cont           = $cont2 = $cont3 = 0;
        if($data['produto']['produto_tamanhos']){
            $aux_tamanho = explode('¬', $data['produto']['produto_tamanhos']);
            foreach($aux_tamanho as $t){
                $aux2_tamanho = explode('&', $t);
                $tamanhos[$cont2] = array(
                    'nome'      => $aux2_tamanho[0],
                    'estoque'   => $aux2_tamanho[1],    
                );
                $cont2++;
            }
        }
        if($data['produto']['produto_cores']){
            $aux_cores = explode('¬', $data['produto']['produto_cores']);
            foreach($aux_cores as $c){
                $aux2_cor = explode('&', $c);
                $cores[$cont3] = array(
                    'nome'      => $aux2_cor[0],
                    'estoque'   => $aux2_cor[1],    
                );
                $cont3++;
            }
        }
        if($data['produto']['produto_variacoes']) {
            $aux_variacoes = explode('¬', $data['produto']['produto_variacoes']);
            foreach($aux_variacoes as $a_v){
                $produtos[$cont2] = $this->produtos->get($a_v);
                $cont2++;
            }
            $data['variacoes'] = true;
        } else {
    		$produtos       = $this->produtos->getAllAleatorio();
        }
        if(is_array($produtos)){
            foreach($produtos as $prt){    
    		    if($prt){
    		        if(preg_match('/¬/', $prt['produto_departamentos'])){
        		        $aux_departamentos = explode('¬', $prt['produto_departamentos']);
        		        $departamento = $this->departamentos->get($aux_departamentos[0]);
        		        $nome_departamento = $departamento['departamento_nome'];
        		    } else {
        		        $nome_departamento = null;
        		    }
    		    
    		        $promo  = $this->produtoPromocao($prt);
    		    
    		        $relacionados[$cont] = array(
        		        'produto_id'            => $prt['produto_id'],
        		        'produto_nome'          => $prt['produto_nome'],
        		        'produto_valor'         => $prt['produto_valor'],
        		        'produto_promocao'      => $promo['valor'],
        		        'produto_porcentagem'   => $promo['porcentagem'],
        		        'produto_departamento'  => $nome_departamento,
        		    );
        		    
        		    $cont++;
    		    }
    		}
        }
		$data['relacionados']   = $relacionados;
		$data['tamanhos']       = $tamanhos;
		$data['cores']          = $cores;
		$data['mensagem']       = "Mr.CellStore Agradece sua visita.%0AEstou no site, quero comprar o produto " . mb_strtolower($data['produto']['produto_nome']) . ", modelo: " . mb_strtolower($data['produto']['produto_modelo']) . ', no valor de R$' . number_format($data['produto']['produto_valor'], 2,',','.') . '.';
	    $this->header();
	    $this->load->view('produto', $data);
	    $this->footer();*/
	    
	    
	    $data['produto'] = $this->produtos->getProdutoSite($this->uri->segment(2));
	    //$data['relacionados'] = $this->produtos->getRelacionadoSite($this->uri->segment(2));
	    $data['tamanhos'] = $this->produtos->getTamanhosSite($this->uri->segment(2));
	    $data['cores'] = $this->produtos->getCoresSite($this->uri->segment(2));
	    $data['estoque'] = $this->produtos->getEstoqueSite($this->uri->segment(2));
	    $data['valor'] = $this->produtos->getValorSite($this->uri->segment(2));
	    $data['porcentagem'] = $this->produtos->getPromocaoSite($this->uri->segment(2), $data['valor']);
	    
	    /*
	        ***** Dados de chamada para WhatsApp
	        ** Dev: Anderson Moreira
	        ** Data: 05/11/2022
	    */
	    $aux = $this->configs->getSite();
	    $data['whats'] = $aux['whats'];
	    $data['whats'] = '3491601226';
	    /*
	        ***** Fim dados de chamada para WhatsApp
	    */
	    if($data['valor'] == $data['porcentagem']['precoNovo']){
	        unset($data['porcentagem']);
	    }else{
	        $data['valor'] = $data['porcentagem']['precoNovo'];
	    }
	    
	    $this->header();
	    $this->load->view('produto', $data);
	    $this->footer();
    }
    
    public function relacionados(){
        $data['relacionados'] = $this->produtos->getRelacionadoSite($_POST['id']);
        echo $this->load->view('relacionados', $data, true);
    }
    
    public function buscar(){
        $this->load->library("pagination");
        
        $categoria  = mb_strtoupper(urldecode($this->uri->segment(3))); 
        $filtro     = mb_strtoupper(urldecode($this->uri->segment(4))); 
        
        $config = array();
        $config["base_url"] = base_url('produto/buscar/' . $categoria . '/' . $filtro . '/');
        $config["total_rows"] = $this->produtos->get_countBuscaFiltro($categoria, $filtro);
        $config["per_page"] = 20;
        $config["uri_segment"] = 5;
        
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $produtos    = $this->produtos->getAllBuscaFiltro($categoria, $filtro, 20, $page);
        $data['filtro']     = $filtro;

		$relacionados = [];
		$cont = 0;
		
		
		foreach($produtos as $p){    
		    if($p){
		        if($p['produto_departamentos']){
    		        $aux_departamentos = explode('¬', $p['produto_departamentos']);
    		        $departamento = $this->departamentos->get($aux_departamentos[0]);
    		        $nome_departamento = $departamento['departamento_nome'];
    		    } else {
    		        $nome_departamento = null;
    		    }
		    
		        $promo              = $this->produtoPromocao($p);
		        $valor_promo        = $promo['valor'];
		        $porcentagem_promo  = $promo['porcentagem'];
		    
		    
		        $relacionados[$cont] = array(
    		        'produto_id'            => $p['produto_id'],
    		        'produto_nome'          => $p['produto_nome'],
    		        'produto_valor'         => $p['produto_valor'],
    		        'produto_promocao'      => $valor_promo,
    		        'produto_porcentagem'   => $porcentagem_promo,
    		        'produto_departamento'  => $nome_departamento,
    		    );
    		    
    		    $cont++;
		    }
		}

		$data['produtos'] = $relacionados;
	    
	    $this->header();
	    $this->load->view('buscar', $data);
	    $this->footer();
    }
    
    function buscaProdutos(){
        
        if(array_key_exists("busca",$_POST)){
            $termo = mb_strtoupper($_POST['busca']);
            $this->session->set_userdata('termo', $termo);
        }elseif(array_key_exists("termo",$_SESSION)){
            $termo = mb_strtoupper($_SESSION['termo']);
            $this->session->set_userdata('termo', $termo);
        }else{
            redirect(base_url());
        }
        
        
        $start = $this->uri->segment(3, 0);
        $stop = 20;
        $produtos = $this->produtos->retrieveBusca($termo, $start, $stop);
        $rows = $this->produtos->countBusca($termo);
        
        $config = array();
        $config["base_url"] = base_url('produto/buscaProdutos/');
        $config["total_rows"] = $rows['count'];
        $config["per_page"] = $stop;
        
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
		
        $cont = 0;
        
        $data = array(
            'links'     => $links,
            'produtos'  => $produtos,
            );
        
	    $this->header();
	    $this->load->view('buscar', $data);
	    $this->footer();
	    
	}
    
    function buscaDepartamentos(){
        if($this->input->get('busca') != ""){
            $termo = mb_strtoupper($this->input->get('busca'));
            $this->session->set_userdata('termo', $termo);
        }else{
            $termo = $this->session->userdata('termo');
        }
        
        $site = $this->configs->getSite();
        if($this->uri->segment('3')){
            $start = $this->uri->segment('3');
        }else{
            $start = 0;
        }
        $stop = 20;
        
        $produtos = $this->produtos->retrieveDepartamento($termo, $start, $stop);
        $rows = $this->produtos->countDepartamento($termo);
        
        $config = array();
        $config["base_url"] = base_url('produto/buscaDepartamentos/');
        $config["total_rows"] = $rows['count'];
        $config["per_page"] = $stop;
        
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        
        $cont = 0;
        $relacionados = null;
        if(is_array($produtos)){
            foreach($produtos as $prt){    
    		    if($prt){
    		        if($prt['produto_departamentos']){
        		        $aux_departamentos = explode('¬', $prt['produto_departamentos']);
        		        $departamento = $this->departamentos->get($aux_departamentos[0]);
        		        $nome_departamento = $departamento['departamento_nome'];
        		    } else {
        		        $nome_departamento = null;
        		    }
    		    
    		        $promo              = $this->produtoPromocao($prt);
    		        $valor_promo        = $promo['valor'];
    		        $porcentagem_promo  = $promo['porcentagem'];
    		    
    		        $relacionados[$cont] = array(
        		        'produto_id'            => $prt['produto_id'],
        		        'produto_nome'          => $prt['produto_nome'],
        		        'produto_valor'         => $prt['produto_valor'],
        		        'produto_promocao'      => $valor_promo,
        		        'produto_porcentagem'   => $porcentagem_promo,
        		        'produto_departamento'  => $nome_departamento,
        		    );
        		    
        		    $cont++;
    		    }else{
    		        $relacionados[0] = "";
    		    }
            }
		    
        }
        $this->session->set_userdata('dept', $termo);
        
		$data['produtos'] = $relacionados;
		
	    $this->header();
	    $this->load->view('buscar', $data);
	    $this->footer();
    }
    
}