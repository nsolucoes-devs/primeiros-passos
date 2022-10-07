<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpedidos extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('comprasmodel');
        $this->load->model('carrinhomodel');
        $this->load->model('clientes');
        $this->load->model('produtos');
        $this->load->model('usuarios');
        $this->load->model('lojas/crudlojas');
        date_default_timezone_set('America/Sao_Paulo');
    }
    
    public function pedidos(){
        
        $this->load->library("pagination");
        /*
        $filtro = $this->input->post('filtro');
        $loja_id = $this->input->post('loja_id');
        $filtro = mb_strtoupper($filtro);
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        $data['loja_id'] = $loja_id;
        
        if($filtro){
            $config = array();
            $config["base_url"] = base_url('954d03a8bbb7febfcd39f9e071407b4b/f/' . $filtro . '/');
            $config["total_rows"] = $this->comprasmodel->get_countFiltro($filtro, $loja_id);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['vendas']  = $this->comprasmodel->getAllPedidosFiltro($filtro, 10, $page, $loja_id);
            $data['filtro']  = $filtro;
        } else {
            $config = array();
            $config["base_url"] = base_url('954d03a8bbb7febfcd39f9e071407b4b/n/');
            $config["total_rows"] = $this->comprasmodel->get_count($loja_id);
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['vendas']  = $this->comprasmodel->getAllPedidos(10, $page, $loja_id);
        }
        $data['lojas'] = $this->crudlojas->getLojas();

        if($this->session->userdata('alert_pedido_novo')){
            $data['alert'] = $this->session->userdata('alert_pedido_novo');
            $this->session->unset_userdata('alert_pedido_novo');
        } else {
            $data['alert'] = null;
        }
        */
        /*if($this->input->post('filtro')){
            $filtro = $this->input->post('filtro');
        }else{
            
        }*/
        $filtro = 0;
        
        if($this->input->post('loja_id') !== null){
            $this->session->set_userdata('identificacaoLoja', $this->input->post('loja_id'));
            $id = $_SESSION['identificacaoLoja'];
        }else{
            if(array_key_exists('identificacaoLoja', $_SESSION)){
                $id = $_SESSION['identificacaoLoja'];
            }else{
                $id = "all";
            }
        }
        
        if($this->uri->segment(2)){
            $page = $this->uri->segment(2);
        }else{
            $page = 0;
        }
        
        $config = array(
            'base_url'      => base_url('954d03a8bbb7febfcd39f9e071407b4b'),
            'total_rows'    => $this->comprasmodel->get_countFiltro($filtro, $id),
            'per_page'      => 10,
            'uri_segment'   => 2,
        );
        $this->pagination->initialize($config);
        
        $data = array(
            'vendas' => $this->comprasmodel->getAllPedidos(10, $page, $id, $filtro),
            'links' => $this->pagination->create_links(),
            'lojas'  => $this->crudlojas->getLojas(),
            'loja_id' => $id,
            );
            
        $this->header(4);
        $this->load->view('restrito/pedidos', $data);
        $this->footer();
    }
    
    public function pedido(){
        
        
        $id = $this->uri->segment(2);
        
        $data['pedido'] = $this->comprasmodel->pedido($id);
        
        $this->header(4);
        $this->load->view('restrito/pedido', $data);
        $this->footer();
    }
    
    public function cadastroPedido(){
        
        
        $data['clientes'] = $this->clientes->getAll();
        $data['produtos'] = $this->produtos->getAll();
        
        $this->header(4);
        $this->load->view('restrito/cadastropedido', $data);
        $this->footer();
    }
    
    public function editaPedido(){
        
        
        $id = $this->uri->segment(2);
        
        
        $data['pedido'] = $this->comprasmodel->pedido($id);
        $data['edita']  = 1;
        $data['produtos'] = $this->comprasmodel->getProdutosAll($id);
        
        $this->header(4);
        $this->load->view('restrito/editaPedido', $data);
        $this->footer();
    }
    
    public function excluirPedido(){
        

        
        $id = $this->input->post('id_excluir');
        $senha = md5($this->input->post('senha'));
        
	    if($senha == $senha){
	        $this->session->set_userdata('alert', 3);
	        
	        $this->comprasmodel->excluirPedido($_POST['idVenda']);
	        
	    } else {
	        $this->logBlock();
	        $this->session->set_userdata('alert', 4);
	    }

        redirect(base_url('954d03a8bbb7febfcd39f9e071407b4b'));
    }
    
    public function excluirusuario(){
        
        
    $id = $this->uri->segment(4);

    $this->usuarios->excluirUsuario($id);
    
    redirect(base_url('0d658457c62859e2c93026f9f70ce219'));
    
    }
    
    
    public function updateEnderecoEntrega(){
        
        $pedido = $this->comprasmodel->retrievePedido($this->input->post('pedido_id'));
        //[pedido_id] => 217 
        
        $endereco = $this->input->post('e_endereco')."¬".$this->input->post('e_complemento')."¬".$this->input->post('e_bairro')."¬".$this->input->post('e_cidade')."¬".$this->input->post('e_estado');
        $pedido['cepCompra']        = $this->input->post('e_cep');
        $pedido['numeroEndereco']   = $this->input->post('e_numero');
        $pedido['enderecoCompra']   = $endereco;
        
        $this->comprasmodel->updatePedido($this->input->post('pedido_id'), $pedido);
        
        redirect(base_url('4daaa9654962f18e7c9df5cb1b2ecdee/'.$this->input->post('pedido_id')));
    } 
    
    public function updateProdutosEntrega(){
        
        
        $pedido = $this->comprasmodel->retrievePedido($this->input->post('pedido_id'));
        
        $prod = $this->input->post('prod');
        $qtd = $this->input->post('qtd');
        $helper = count($this->input->post('prod'));
        $produtos = $quantidade = $valorprod = "";
        $soma = 0;
        
        for($i=0; $i<$helper; $i++){
            $preco = $this->comprasmodel->getProduto($prod[$i]);
            $produtos .= $prod[$i];
            $quantidade .= $qtd[$i];
            $valorprod .= $preco['produto_valor'];
            if($i+1 < $helper){
                $produtos .= "¬";
                $quantidade .= "¬";
                $valorprod .= "¬";
            }
            $soma = $soma + ($preco['produto_valor'] * $qtd[$i]);
        }
        
        $pedido['listProdutosId'] = $produtos;
        $pedido['qtdProdutos'] = $quantidade;
        $pedido['vlrProdutos'] = $valorprod;
        $pedido['valorCompra'] = $soma; 
        //$pedido[valorFrete] => 0.00 
        
        $this->comprasmodel->updatePedido($this->input->post('pedido_id'), $pedido);
        redirect(base_url('4daaa9654962f18e7c9df5cb1b2ecdee/'.$this->input->post('pedido_id')));
    }
    
    public function updateFreteEntrega(){
        
        
        $pedido = $this->comprasmodel->retrievePedido($this->input->post('pedido_id'));
        $frete = $this->input->post('frete');
        $pedido['valorFrete'] = (float)$frete;
        
        $this->comprasmodel->updatePedido($this->input->post('pedido_id'), $pedido);
        redirect(base_url('4daaa9654962f18e7c9df5cb1b2ecdee/'.$this->input->post('pedido_id')));
    }
    
    public function removeProdutosPedido(){
        
        
        $pedido = $this->comprasmodel->retrievePedido($this->input->post('pedido'));
        
        $prod = explode("¬", $pedido['listProdutosId']);
        $qtd = explode("¬", $pedido['qtdProdutos']);
        $preco = explode("¬", $pedido['vlrProdutos']);
        $helper = count($prod);
        $produtos = $quantidade = $valorprod = "";
        $soma = 0;
        
        for($i=0; $i<$helper; $i++){
            if($prod[$i] != $this->input->post('id')){
                if($i != 0){
                    $produtos .= "¬";
                    $quantidade .= "¬";
                    $valorprod .= "¬";
                }
                $produtos .= $prod[$i];
                $quantidade .= $qtd[$i];
                $valorprod .= $preco[$i];
                $soma = $soma + ($preco[$i] * $qtd[$i]);
            }
        }
        
        $pedido['listProdutosId'] = $produtos;
        $pedido['qtdProdutos'] = $quantidade;
        $pedido['vlrProdutos'] = $valorprod;
        $pedido['valorCompra'] = $soma; 
        
        $this->comprasmodel->updatePedido($this->input->post('pedido'), $pedido);
        redirect(base_url('4daaa9654962f18e7c9df5cb1b2ecdee/'.$this->input->post('pedido')));
    }
    
    public function getProduto(){
        $this->load->database();
        $this->load->model('produtos');
        
        $a = $this->produtos->getProdutoAdd($this->input->post('idproduto'));
        
        echo json_encode($a);
    }
    
    public function alterarHistorico(){
        
        
        $id = $this->input->post('pedido_id');
        
        if($this->input->post('notificar')){
            $notificar = 1;
        } else {
            $notificar = 0;
        }
        
        $historico = array(
            'historico_pedido_id'   => $id, 
            'historico_data'        => date('Y-m-d'),
            'historico_hora'        => date('H:i'),
            'historico_comentario'  => $this->input->post('comentario'),
            'historico_status'      => $this->input->post('status'),
            'historico_notificar'   => $notificar,
        );
        
        $this->comprasmodel->insertHistorico($historico);
        
        $pedido = array(
            'statusCompra' =>  $this->input->post('status'),
        );
        
        $this->comprasmodel->updatePedido($id, $pedido);
        
        if($notificar == 1){
            $this->enviaEmail($id, $this->input->post('comentario'));    
        }
        
        redirect(base_url('4daaa9654962f18e7c9df5cb1b2ecdee/' . $id . ''));
    }
    
    public function cadastrarPedido(){
        
        
        $enderecocompleto = mb_strtoupper($this->input->post('rua')) . '¬' . mb_strtoupper($this->input->post('complemento')) . '¬' . mb_strtoupper($this->input->post('bairro')) . '¬' . mb_strtoupper($this->input->post('cidade')) . '¬' . mb_strtoupper($this->input->post('estado'));
        
        $dados = array(
            'idClient'          => $this->input->post('cliente'),
            'cepCompra'         => str_replace("-", "", $this->input->post('cep')),
            'idCarrinho'        => rand(1000, 10000),
            'numeroEndereco'    => $this->input->post('numero'),
            'formaEnvio'        => $this->input->post('frete'),
            'formaPagamento'    => $this->input->post('forma'),
            'dataCompra'        => $this->input->post('data')." ".$this->input->post('hora'),
            'listProdutosId'    => $this->input->post('ids'),
            'qtdProdutos'       => $this->input->post('qtds'),
            'vlrProdutos'       => $this->input->post('precos'),
            'valorCompra'       => $this->input->post('total'),
            'valorFrete'        => $this->input->post('valor_frete'),    
            'statusCompra'      => 1,
            'statusEnvio'       => 0,
            'statusPagamento'   => 16,
            'codTransacao'      => "",
            'dataAlteracao'     => date('Y-m-d H:i:s'),
            'desconto'          => $this->input->post('desconto'),
            'enderecoCompra'    => $enderecocompleto,
        );
        
        $id = $this->carrinhomodel->insert($dados);
        
        if($this->input->post('status') != "" && $this->input->post('status') != null){

            if($this->input->post('notificar')){
                $notificar = 1;
            } else {
                $notificar = 0;
            }
            
            if($this->input->post('comentario') == ""){
                $comentário = "Pedido criado!";
            }else{
                $comentário = $this->input->post('comentario');
            }
            
            $historico = array(
                'historico_pedido_id'   => $id, 
                'historico_data'        => date('Y-m-d'),
                'historico_hora'        => date('H:i'),
                'historico_comentario'  => $comentário,
                'historico_status'      => 1,
                'historico_notificar'   => $notificar,
            );
            
            $this->comprasmodel->insertHistorico($historico);
        
            $pedido = array(
                'statusCompra' =>  1,
            );
            
            $this->comprasmodel->updatePedido($id, $pedido);
            
            if($notificar == 1){
                $this->enviaEmail($id, $this->input->post('comentario'));    
            }
        }
        
        
        
        $this->session->set_userdata('alert_pedido_novo', $id);

        redirect(base_url('954d03a8bbb7febfcd39f9e071407b4b'));
    }
    
    function enviaEmail($idpedido, $comentario){
            $this->load->database();
            $this->load->model('configs');
            $this->load->model('clientes');
            $this->load->model('comprasmodel');
            $this->load->model('carrinhomodel');
            $this->load->model('produtos');
            
            $dados = $this->comprasmodel->getPedido($idpedido);
            $dados['numero_pedido'] = $idpedido;
            $dados['detalhes']      = $comentario;
            $dados['segundo']       = 1;
            
            $site = $this->configs->getSite();
            $gestoremail = $this->configs->getEmail(1);
            
    	    $cliente = $this->clientes->getClienteById($dados['idClient']);
    	    if($cliente['cliente_email']){
    	        
    	        $produtos = [];
    	        $cont = 0;
    	        $aux_produtos   = explode('¬', $dados['listProdutosId']);
    	        $aux_quantidade = explode('¬', $dados['qtdProdutos']);
    	        $aux_valor      = explode('¬', $dados['vlrProdutos']);
    	        $subtotal = 0;
    	        
        	    foreach($aux_produtos as $p){
        	        $produto = $this->produtos->get($p);
        	        
        	        $produtos[$cont] = array(
        	            'produto_nome'          => $produto['produto_nome'],    
        	            'produto_modelo'        => $produto['produto_modelo'],
        	            'produto_quantidade'    => $aux_quantidade[$cont],
        	            'produto_valor'         => number_format($aux_valor[$cont], 2,',','.'),
        	            'produto_total'         => number_format($aux_quantidade[$cont] * $aux_valor[$cont],2,',','.') ,
        	        );
        	        $cont++;
        	    }
        	    
        	    
        	    $status = $this->carrinhomodel->getStatus($dados['statusCompra']);
        	    if($status){
        	        $status = $status['nomeStatusCompra'];
        	    } else {
        	        $status = 'Status não encontrado';
        	    }
        	    
        	    $cep = $this->carrinhomodel->getByCep($dados['cepCompra']);
        	    $aux_cep = explode('/', $cep['cep_cidadeuf']);
        	    
        	    if($cliente['cliente_telefone']){
        	       if(strlen($cliente['cliente_telefone']) == 11){
            	        $fone = $this->mask($cliente['cliente_telefone'], '(##) #####-####');
            	    } else if(strlen($cliente['cliente_telefone'] == 10)){
            	        $fone = $this->mask($cliente['cliente_telefone'], '(##) ####-####');
            	    } 
        	    } else {
        	        $fone = 'Telefone não cadastrado';
        	    }
        	    
        	    
        	    $data = array(
        	        'numero_pedido'         => $dados['numero_pedido'],
        	        'data'                  => date('d/m/Y H:i', strtotime($dados['dataCompra'])),
        	        'pagamento'             => $dados['formaPagamento'], 
        	        'entrega'               => $dados['formaEnvio'],
            	    'nome'                  => $cliente['cliente_nome'],
        	        'cpf'                   => $this->mask($cliente['cliente_cpf'], '###.###.###-##'),
        	        'fone'                  => $fone,
        	        'status'                => $status,
        	        'endereco'              => $cep['cep_rua'] . ', ' . $dados['numeroEndereco'] . ', ' . $cep['cep_bairro'] . ', ' . $aux_cep[0] . ', ' . $aux_cep[1] . ', ' . $this->mask($dados['cepCompra'], '#####-###'),
        	        'produtos'              => $produtos,
        	        'subtotal'              => number_format($dados['valorCompra'],2,',','.'),
        	        'frete'                 => number_format($dados['valorFrete'],2,',','.'),
        	        'total'                 => number_format($dados['valorFrete'] + $dados['valorCompra'],2,',','.'),
        	        'detalhes'              => $dados['detalhes'],
        	        'nome_empresa'          => $site['nome_empresa'],
        	        'segundo'               => $dados['segundo'],
        	        'whats'                 => $site['whats'],
        	        'desconto'              => $dados['desconto'],
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
                
        	    $email = $cliente['cliente_email'];
        	    
                $this->load->library('email');
                $this->load->model("sendemail");
                $mailbody = $this->sendemail->mailbody($data);
        
                $this->email->initialize($config);
                
                $this->email->from($gestoremail['email_user'], 'Email Nsolucoes');
                $this->email->to($email); 
                $this->email->subject($assunto);
                $this->email->message($mailbody);  
                
                $this->email->send();
                $this->email->print_debugger();
    	    }
	    }
	    
	function dinamicoGetProduto(){
	    $this->load->database();
        $this->load->model('produtos');
        
        $a = $this->produtos->getProdutoAdd($this->input->post('id'));
        
        echo json_encode($a);
	}
	
	function trocas(){
	    if(array_key_exists("loja_id",$_POST)){
	        $this->session->set_userdata('identificacaoLoja', $this->input->post('loja_id'));
	        $id = $_POST['loja_id'];
	    }else{
	        if(array_key_exists('identificacaoLoja', $_SESSION)){
                $id = $_SESSION['identificacaoLoja'];
            }else{
                $id = "all";
            }
	    }
	    
	    if(array_key_exists("dateSearch",$_POST)){
	        if($_POST['dateSearch'] != ""){
	            $data = date("Y-m-d", strtotime($_POST['dateSearch']));
	            $dados['data'] = $data;
	        }else{
	            $data = 0;
	        }
	    }else{
	        $data = 0;
	    }
	    
	    $this->load->library("pagination");
        
        if($this->uri->segment(2)){
            $page = $this->uri->segment(2);
        }else{
            $page = 0;
        }
        
        $config = array(
            'base_url'      => base_url('90617da22f81b0d789597a2d88d6cc9d'),
            'total_rows'    => $this->comprasmodel->get_countTroca($id, $data),
            'per_page'      => 10,
            'uri_segment'   => 2,
        );
        $this->pagination->initialize($config);
        
        $dados = array(
            'trocas' => $this->comprasmodel->getAllTrocas(10, $page, $id, $data),
            'links' => $this->pagination->create_links(),
            'lojas'  => $this->crudlojas->getLojas(),
            'loja_id' => $id,
            );
            
        $this->header(4);
        $this->load->view('restrito/trocas', $dados);
        $this->footer();
	    
	}
}