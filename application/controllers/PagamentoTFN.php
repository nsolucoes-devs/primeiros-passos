<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class PagamentoTFN extends MY_Controller {
        
        function pedido($id){
            $this->load->database();
            $this->load->model('comprasmodel');
            $this->load->model('configs');
            $this->load->model('produtos');
            $this->load->model('departamentos');
            $this->load->model('vendedores');
            
            $data['pedido'] = $this->comprasmodel->pedido($id);
            $data['geraBoleto'] = 1;
            $data['vendedores'] = $this->vendedores->getAllPrioridade();
            
        	$this->enviaEmail($id);
        	
        	$cliente_nome = explode(' ',$data['pedido']['cliente']);
        	
        	$total = $data['pedido']['total'] + $data['pedido']['frete_valor'] - $data['pedido']['desconto'];
        	
        	$data['mensagem'] = "🧑🏻‍💻%2A**Pedido pelo site/app**%2A📦%0A%0A%2AMr.CellStore Agradece seu pedido!🤝%2A%0A%0A◾️Cliente: ".$cliente_nome[0].
        	"%0A◾Frete: R$".number_format($data['pedido']['frete_valor'], 2,',','.') . " - " . $data['pedido']['e_cep'] ."%0A◾️Nº do pedido: ".$id.'%0A◾Data/hora: '.date('d/m/Y H:i', strtotime($data['pedido']['cadastro'])).'%0A💰Total: R$'.number_format($total,2,',','.');

            $data['mensagem'] = $data['mensagem'] . '%0A%0A%2AITENS:%2A';
            
            
            
            foreach($data['pedido']['produtos'] as $p){
                $Prodnome   = '%0A◾' . ucwords(mb_strtolower($p['produto_nome']));
                $Prodquant  = '%0AQtd: ' . $p['produto_quantidade'] . '  Valor Unit.: R$' . number_format($p['produto_valor'], 2,',','.') . '%0A';
                
                $data['mensagem'] = $data['mensagem'] . $Prodnome;
                $data['mensagem'] = $data['mensagem'] .  $Prodquant;
            }
            
            $data['mensagem'] = $data['mensagem'] . '%0A%0AQuero prosseguir com o pagamento do pedido';
            
        	$this->session->unset_userdata('finalcompra');
            
            $this->header();
            $this->load->view('pedido2', $data);
            $this->footer();
        }
        
        function enviaEmail($idpedido){
            $this->load->database();
            $this->load->model('configs');
            $this->load->model('clientes');
            $this->load->model('comprasmodel');
            $this->load->model('carrinhomodel');
            
            $dados                  = $this->comprasmodel->getPedido($idpedido);
            $dados['numero_pedido'] = $idpedido;
            $dados['detalhes']      = 'Pedido realizada com sucesso, aguardando pagamento.';
            
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
        	            'produto_total'         => number_format($aux_quantidade[$cont] * $produto['produto_valor'],2,',','.') ,
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
        	    
        	    $fone = 'Telefone não cadastrado';
        	    
        	    if($cliente['cliente_telefone']){
        	       if(strlen($cliente['cliente_telefone']) == 11){
            	        $fone = $this->mask($cliente['cliente_telefone'], '(##) #####-####');
            	    } else if(strlen($cliente['cliente_telefone'] == 10)){
            	        $fone = $this->mask($cliente['cliente_telefone'], '(##) ####-####');
            	    } 
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
        	        'desconto'              => number_format($dados['desconto'],2,',','.'),
        	        'total'                 => number_format($dados['valorFrete'] + $dados['valorCompra'] - $dados['desconto'],2,',','.'),
        	        'detalhes'              => $dados['detalhes'],
        	        'nome_empresa'          => $site['nome_empresa'],
        	        'whats'                 => $site['whats'],
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
                
                $this->email->from($gestoremail['email_user'], $site['nome_empresa']);
                $this->email->to($email); 
                $this->email->subject($assunto);
                $this->email->message($mailbody);  
                
                $this->email->send();
                $this->email->print_debugger();
    	    }
	    }
	    
	    private function limpa($val){
	        $helper = array(",", ".", "(", ")", "+", "-", " ", "/");
            return str_replace($helper, "", $val);
	    }
    
        private function mask($val, $mask)    {
            $maskared = '';
            $k = 0;
            for($i = 0; $i<=strlen($mask)-1; $i++){
            
                if($mask[$i] == '#'){
                    if(isset($val[$k]))
                        $maskared .= $val[$k++];
                }
                
                else{
                    if(isset($mask[$i]))
                        $maskared .= $mask[$i];
                }
            }
            
            return $maskared;
        }
}