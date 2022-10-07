<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('promocoes');
	    $this->load->model('configs');
	    $this->load->model('produtos');
	    $this->load->model('departamentos');
	    $this->load->model('opcoes');
	    $this->load->model('promocoes');
	    $this->load->library("pagination");
    }
    
	public function aguarde(){
	    $this->load->view('aguarde');
	}
	
	public function errorPage(){
	    $this->output->set_status_header('404');
	    $this->load->view('errorPage');
	}
	
	public function resgataCEP(){
	    $this->load->database();
	    $this->load->model('clientes');
	    
	    $cep = $this->clientes->getCEP($this->input->post('cep'));
	    
	    echo json_encode($cep);
	}
	
	public function inserirSolicitacao(){
	    $this->load->database();
	    $this->load->model('produtos');
	    
	    $solicitacao = array(
	        'solicitacao_tipo'          => $this->input->post('tipo'),
	        'solicitacao_nome'          => $this->input->post('nome'),
	        'solicitacao_telefone'      => $this->limpa($this->input->post('telefone')),
	        'solicitacao_cep'           => $this->limpa($this->input->post('cep')),
	        'solicitacao_rua'           => $this->input->post('rua'),
	        'solicitacao_complemento'   => $this->input->post('complemento'),
	        'solicitacao_numero'        => $this->input->post('numero'),
	        'solicitacao_bairro'        => $this->input->post('bairro'),
	        'solicitacao_cidade'        => $this->input->post('cidade'),
	        'solicitacao_estado'        => $this->input->post('estado'),
	        'solicitacao_empresa'       => $this->input->post('empresa'),
	        'solicitacao_cnpj'          => $this->limpa($this->input->post('cnpj')),
	        'solicitacao_mensagem'      => $this->input->post('mensagem'),
	        'solicitacao_status'        => 'Aberta',
	    );
	    
	    $this->produtos->insertSolicitacao($solicitacao);
	    
	    redirect(base_url(''));
	}

    public function produtoPromocao($produto){
        $valor          = null;
        $porcentagem    = null;
        
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
		
		return $array;
    }

	//Função que leva para a página inicial
	public function index(){
	    //$this->acesso();
	    
		$site = $this->configs->getSite();
		$cont            = 0;
		$relacionados    = [];
		$produtos        = $this->produtos->getAllIndex();
		
		
        for($i=0; $i<8; $i++){
            $produto = $this->produtos->getProdutoSiteRand();
            if(isset($produto['produto_id'])){
                $valor = $this->produtos->getValorSite($produto['produto_id']);
        	    $porcentagem = $this->produtos->getPromocaoSite($produto['produto_id'], $valor);
        	    $nome_departamento = $this->produtos->getDepartamentoLista($produto['produto_departamentos']);
                $relacionados[$i] = array(
                    'produto_id'            => $produto['produto_id'],
                    'produto_nome'          => $produto['produto_nome'],
                    'produto_valor'         => $porcentagem['valorOriginal'],
                    'produto_departamento'  => $nome_departamento,
                );
                
                if($valor != $porcentagem['precoNovo']){
                    $relacionados[$i]['produto_promocao']    = $porcentagem['precoNovo'];
                    $relacionados[$i]['produto_porcentagem'] = $porcentagem['porcentagem'];
                }
            }
        }
	    
	    if($data['valor'] == $data['porcentagem']['precoNovo']){
	        unset($data['porcentagem']);
	    }else{
	        $data['valor'] = $data['porcentagem']['precoNovo'];
	    }
	    
        
        
		$data['produtos']   = $relacionados;
	    $data['whats']      = $site['whats'];
	    $data['site']       = $site;
	    
	    $this->header();
	    $this->load->view('home', $data);
	    $this->footer();
	}
	
	public function contato(){
	    $this->load->database();
	    $this->load->model('configs');
	    $this->load->model('produtos');
	    $this->load->model('departamentos');
	    
		$site = $this->configs->getSite();
		
		$data = array(
		    'facebook'              => $site['facebook'],
		    'instagram'             => $site['instagram'],
		    'twitter'               => $site['twitter'],
		    'endereco'              => $site['endereco'],
		    'email'                 => $site['email'],
		    'whats'                 => $site['whats'],
		    'telefone'              => $site['telefone'],
		    'nome_empresa'          => $site['nome_empresa'],
		    'cnpj'                  => $site['cnpj'],
		    'chave'                 => $this->configs->getChave(1),
		);
		
		if ($this->session->userdata('mensagem_contato')){
		    $data['mensagem_contato'] = $this->session->userdata('mensagem_contato');
		    $this->session->unset_userdata('mensagem_contato');
		}else{
		    $data['mensagem_contato'] = null;
		}
	    
	    $this->header();
	    $this->load->view('contato', $data);
	    $this->footer();
	}
	
    public function acesso(){
        $this->load->database();
        $this->load->model('acessomodel');
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $ano    =   date('Y');
        $mes    =   date('m');
        $dia    =   date('d');
        $hora   =   date('H');
        $min    =   date('i');
        
        $id = $ano . $mes . $dia . $hora;
        
        $acesso = $this->acessomodel->get($id);
        
        if($acesso != null){
            if($acesso['min_'.$min] == null){
                $acesso['min_'.$min] = 1;
            } else {
                $acesso['min_'.$min]    =  $acesso['min_'.$min] + 1;    
            }
            $acesso['dia']          = $acesso['dia'] + 1;
            $acesso['hora']         = $acesso['hora'] + 1;
            
            $this->acessomodel->update($id, $acesso);
        } else {
            $acesso = array(
                'acesso_id' => $id,
                'dia'       => 1,
                'hora'      => 1,
                'min_'.$min => 1,
            );
            $this->acessomodel->insert($acesso);
        }
    }
    
    public function solicitaReembolso(){
        $this->load->database();
        $this->load->model('cadastrosmodel');
        date_default_timezone_set('America/Sao_Paulo');
        
        $titulo         = $this->upload('titulo', $this->input->post('cpf'));
        $comprovante    = $this->upload('comprovante', $this->input->post('cpf'));
        $cupom          = $this->upload('cupom', $this->input->post('cpf'));
        
        $data = array(
            'reembolso_data'            => date('Y-m-d'),
            'reembolso_nome'            => $this->input->post('nome'),
            'reembolso_cpf'             => $this->limpa($this->input->post('cpf')),
            'reembolso_rg'              => $this->input->post('rg'),
            'reembolso_nascimento'      => $this->input->post('nascimento'),
            'reembolso_titulo'          => $titulo,
            'reembolso_nomemae'         => $this->input->post('nome_mae'),
            'reembolso_datamae'         => $this->input->post('data_mae'),
            'reembolso_nomepai'         => $this->input->post('nome_pai'),
            'reembolso_datapai'         => $this->input->post('data_pai'),
            'reembolso_rua'             => $this->input->post('rua'),
            'reembolso_numero'          => $this->input->post('numero'),
            'reembolso_bairro'          => $this->input->post('bairro'),
            'reembolso_complemento'     => $this->input->post('complemento'),
            'reembolso_cep'             => $this->limpa($this->input->post('cep')),
            'reembolso_cidade'          => $this->input->post('cidade'),
            'reembolso_uf'              => $this->input->post('uf'),
            'reembolso_comprovante'     => $comprovante,
            'reembolso_email'           => $this->input->post('email'),
            'reembolso_telefone'        => $this->limpa($this->input->post('telefone')),
            'reembolso_celular'         => $this->limpa($this->input->post('celular')),
            'reembolso_codigo'          => $this->input->post('codigo'),
            'reembolso_datacompra'      => $this->input->post('data_compra'),
            'reembolso_quantidade'      => $this->input->post('quantidade'),
            'reembolso_valortotal'      => str_replace('.', ',', str_replace('.', '', $this->input->post('valor_total'))),
            'reembolso_pedido_id'       => $this->input->post('id_pedido'),
            'reembolso_cupom'           => $cupom,
            'reembolso_banco'           => $this->input->post('banco'),
            'reembolso_agencia'         => $this->input->post('agencia'),
            'reembolso_conta'           => $this->input->post('conta'),
            'reembolso_digito'          => $this->input->post('digito'),
            'reembolso_status'          => '1',
            'reembolso_motivo'          => $this->input->post('motivo'),
        );
        
        $id = $this->cadastrosmodel->reembolso($data);
        
        $historico_devolucao = array(
            'historico_data'        =>  date('Y-m-d'),
            'historico_hora'        =>  date('H:i'),
            'historico_pedido_id'   =>  $this->input->post('id_pedido'),
            'historico_comentario'  =>  'Sua solicitacão será analisada, aguarde por favor',
            'historico_status'      =>  1,
            'historico_reembolso_id'=>  $id,
        );
        
        $this->cadastrosmodel->insertHistoricoDevolucao($historico_devolucao);
        
        $data['reembolso_protocolo'] = sprintf("%'015d", date('Ymd').$id);
        
        $this->cadastrosmodel->editReembolso($data, $id);
        
        /* FUNÇÃO DE E-MAIL */
        
        redirect($this->input->post('callback'));
    }
    
    function upload($file, $filename){
        $config['upload_path']          = 'imagens/reembolso/';
        $config['allowed_types']        = '*';
        $config['file_name']            = preg_replace('/[^0-9]/', '', $filename);
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload($file)){
                $error = array('error' => $this->upload->display_errors());
        }else{
                $data = array('upload_data' => $this->upload->data());
                return 'imagens/reembolso/'.$data['upload_data']['file_name'];
        }
    }
    
	private function limpa($val){
	    $helper = array(",", ".", "(", ")", "+", "-", " ", "/");
        return str_replace($helper, "", $val);
	}
	
	private function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k]))
                $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i]))  
                $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
    
    function enviaEmail(){
        $this->load->database();
        $this->load->model('configs');
        $gestoremail = $this->configs->getEmail(1);
        
        $site = $this->configs->getSite();
        
        $nome = $this->input->post('name');
        $emailcliente = $this->input->post('email');
        $mensagem = $this->input->post('message');
    	    
    	$dados = array(
    	    "nome"    => $nome,
    	    "email"   => $emailcliente,
    	    "message" => $mensagem,
     	);
     	
     	$config = array(
            'protocol'      => $gestoremail['email_protocol'],
            'smtp_host'     => $gestoremail['email_host'],
            'smtp_port'     => $gestoremail['email_port'],
            'smtp_timeout'  => $gestoremail['email_timeout'],
            'smtp_user'     => $gestoremail['email_user'],
            'smtp_pass'     => $gestoremail['email_pass'],
            'charset'       => $gestoremail['email_charset'],
            'newline'       => "\r\n",  
            'mailtype'      => 'html',    
            'validation'    => TRUE,
        );
        
        $assunto = $site['nome_empresa'];
 	
        $this->load->library('email');
        $this->load->model("sendemail");
        $mailbody = $this->sendemail->contatos($dados);

        $this->email->initialize($config);
        
        $this->email->from($gestoremail['email_user'], 'Email contato');
        $this->email->to($gestoremail['email_user']); 
        $this->email->subject($assunto);
        $this->email->message($mailbody);  
        
        $this->email->send();
        $this->email->print_debugger();
        
        $this->session->set_userdata('mensagem_contato', 1);
        
        redirect(base_url('inicio/contato'));
    }
    
}
