<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class PagamentoSTN extends MY_Controller {
        /*
        API     = ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG
        Crypto  = ek_test_4feS3B3xvxoMikSxoBQKZHxDKVQuyf
        */
        public function transacaoTest(){
            $api = 'ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG';
            $url = 'https://api.pagar.me/1/transactions';
            
            $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
            
            $charge["amount"]                   = 2100;
            $charge["api_key"]                  = $api;
            $charge["payment_method"]           = 'boleto';
            $charge["customerType"]             = 'individual';
            $charge["customerCountry"]          = 'br';
            $charge["customerName"]             = 'Daenerys Targaryen';
            $charge["DocumentsType"]            = 'cpf';
            $charge["DocumentsNumber"]          =  '00000000000';
            
            $xml = "'amount': 2100, 
                    'api_key': 'ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG',
                    'payment_method': 'boleto',
                    'customer':{
                        'type': 'individual',
                        'country': 'br',
                        'name': 'Daenerys Targaryen',
                        'documents': [{
                            'type': 'cpf',
                            'number': '00000000000'
                        }]";
            
            
    		$ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Content-Type: application/json"
                    ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $charge);
                //curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            $res = curl_exec($ch);
                curl_close($ch);
    		
    		print_r($res);
            
        }
        
        public function pgmtPGM(){
            $this->load->database();
            $this->load->model('carrinhomodel');
            $this->load->model('produtos');
            $this->load->model('configs');
            $data = $this->carrinhomodel->getCompra($this->session->userdata('finalcompra'));
            $site = $this->configs->getSite();
            
            $compra     = $data['compra'];
            $envio      = $data['envio'];
            $produto    = $data['produto'];
            
            $cobranca['billing.name']                   = $site['nome_empresa'];                    // Nome da entidade de cobrança
            $cobranca['billing.address.country']        = $envio['shipping.address.country'];       // Dados de endereço de cobrança
            $cobranca['billing.address.state']          = $envio['shipping.address.state'];         // Estado
            $cobranca['billing.address.city']           = $envio['shipping.address.city'];          // Cidade
            $cobranca['billing.address.neighborhood']   = $envio['shipping.address.neighborhood'];  // Bairro
            $cobranca['billing.address.street']         = $envio['shipping.address.street'];        // Rua
            $cobranca['billing.address.street_number']  = $envio['shipping.address.street_number']; // Número
            $cobranca['billing.address.zipcode']        = $envio['shipping.address.zipcode'];       // CEP DE COBRANÇA
            $cobranca['billing.address.complementary']  = $envio['shipping.address.complementary']; // Dados complementares, não pode ser vazio e nem nulo
            
            // organiza a cobrança para receber o pagamento
            $dados['compra']    = $compra;                              
            $dados['cobranca']  = $cobranca;
            $dados['envio']     = $envio;
            $dados['produto']   = $produto;
            $dados['api']       = 'ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG';
            $dados['crypto']    = 'ek_test_4feS3B3xvxoMikSxoBQKZHxDKVQuyf';
            
            
            $this->header();
            $this->load->view('pagme', $dados);
            $this->footer();
        }
        
        public function capturaPGM(){
            $this->load->database();
            $this->load->model('pagmemodel');

            $a = $this->input->get_post('token');
            $b = $this->input->get_post('payment_method');
            $c = $this->input->get_post('amount');
            $apik = 'ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG';
            $apik = 'ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG';
            
            $url = "https://api.pagar.me/1/transactions/";
            $place = $a."/capture";
            
            $credenciais = array(
    	    	"amount"    => $c,
    			"api_key"   => $apik,
    	    );

        	$curl = curl_init($url.$place);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
        	$resultado = curl_exec($curl);
        	    curl_close($curl);
        	
        	$dados = json_decode($resultado, true);
        	
        	/*
        	Array ( [object] => 
        	    transaction [status] => waiting_payment 
        	    [refuse_reason] => 
        	    [status_reason] => acquirer 
        	    [acquirer_response_code] => 
        	    [acquirer_name] => pagarme 
        	    [acquirer_id] => 609455feb54ea00018c768cc 
        	    [authorization_code] => 
        	    [soft_descriptor] => 
        	    [tid] => 12432602 
        	    [nsu] => 12432602 
        	    [date_created] => 2021-06-01T14:08:14.238Z 
        	    [date_updated] => 2021-06-01T14:08:15.756Z 
        	    [amount] => 7320 
        	    [authorized_amount] => 7320 
        	    [paid_amount] => 0 
        	    [refunded_amount] => 0 
        	    [installments] => 1 
        	    [id] => 12432602 
        	    [cost] => 0 
        	    [card_holder_name] => 
        	    [card_last_digits] => 
        	    [card_first_digits] => 
        	    [card_brand] => 
        	    [card_pin_mode] => 
        	    [card_magstripe_fallback] => 
        	    [cvm_pin] => 
        	    [postback_url] => https://ncart.nsolucoes.digital/pagamentoSTN/retornoPGM 
        	    [payment_method] => boleto 
        	    [capture_method] => ecommerce 
        	    [antifraud_score] => 
        	    [boleto_url] => https://pagar.me 
        	    [boleto_barcode] => 1234 5678 
        	    [boleto_expiration_date] => 2021-06-08T03:00:00.000Z 
        	    [referer] => encryption_key 
        	    [ip] => 2804:1b3:4100:43f9:f527:f97e:bc2a:30b1 
        	    [subscription_id] => 
        	    [phone] => 
        	    [address] => 
        	    [customer] => Array ( 
        	        [object] => customer 
        	        [id] => 5537753 
        	        [external_id] => 28 
        	        [type] => individual 
        	        [country] => br 
        	        [document_number] => 
        	        [document_type] => cpf 
        	        [name] => ANDERSON MOREIRA 
        	        [email] => SONXERDAN@GMAIL.COM 
        	        [phone_numbers] => Array ( 
        	            [0] => +5534996895179 ) 
        	        [born_at] => 
        	        [birthday] => 1984-10-21 
        	        [gender] => 
        	        [date_created] => 2021-06-01T14:08:14.195Z 
        	        [documents] => Array ( 
        	            [0] => Array ( 
        	                [object] => document 
        	                    [id] => doc_ckpe48rju01830i9tr5kzqf5x 
        	                    [type] => cpf 
        	                    [number] => 06808142645 ) ) ) 
        	        [billing] => Array ( 
        	            [object] => billing 
        	            [id] => 2256858 
        	            [name] => Ecommerce Teste 
        	            [address] => Array ( 
        	                [object] => address 
        	                [street] => Rua CaixaPos 
        	                [complementary] => sem 
        	                [street_number] => 396 
        	                [neighborhood] => Fabricio 
        	                [city] => Uberaba 
        	                [state] => MG 
        	                [zipcode] => 38082230 
        	                [country] => br [id] => 4571653 ) ) 
        	        [shipping] => Array ( 
        	            [object] => shipping 
        	            [id] => 1261024 
        	            [name] => ANDERSON MOREIRA 
        	            [fee] => 2770 [delivery_date] => 
        	            [expedited] => 
        	            [address] => Array ( 
        	                [object] => address 
        	                [street] => AVENIDA PROFESSORA MARIA DA PAZ BARCELOS DE ALMEIDA
        	                [complementary] => sem 
        	                [street_number] => 100 
        	                [neighborhood] => JARDIM ELZA AMUÍ I 
        	                [city] => UBERABA [state] => MG 
        	                [zipcode] => 38082230 
        	                [country] => br 
        	                [id] => 4571654 ) ) 
        	        [items] => Array ( 
        	            [0] => Array ( 
        	                [object] => item 
        	                [id] => 1 
        	                [title] => Teste 
        	                [unit_price] => 5000 
        	                [quantity] => 1 
        	                [category] => 
        	                [tangible] => 1 
        	                [venue] => 
        	                [date] => ) ) 
        	             [card] => 
        	             [split_rules] => 
        	             [metadata] => Array ( ) 
        	             [antifraud_metadata] => Array ( ) 
        	             [reference_key] => 
        	             [device] => 
        	             [local_transaction_id] => 
        	             [local_time] => 
        	             [fraud_covered] => 
        	             [fraud_reimbursed] => 
        	             [order_id] => 
        	             [risk_level] => unknown 
        	             [receipt_url] => 
        	             [payment] => 
        	             [addition] => 
        	             [discount] => 
        	             [private_label] => 
        	             [pix_qr_code] => 
        	             [pix_expiration_date] => )
        	*/
        	
            $update = array(
        	    'authorization_code'        => $dados['authorization_code'],
        	    'boleto_url'                => $dados['boleto_url'],
                'boleto_barcode'            => $dados['boleto_barcode'],
                'boleto_expiration_date'    => $dados['boleto_expiration_date'],
                'statusCompra'              => 1,
                'statusEnvio'               => 0,
                'statusPagamento'           => 16,
                'codTransacao'              => $dados['id'],
                'dataAlteracao'             => date('Y-m-d H:i:s'),
                );
            $this->pagmemodel->atualizapedido($this->session->userdata('finalcompra'), $update);
            
            $id = $this->session->userdata('finalcompra');
            
            $this->session->unset_userdata('quantidade_carrinho');
            $this->session->unset_userdata('compra');
            $this->session->unset_userdata('finalcompra');
            $this->session->unset_userdata('frete_valor');
            $this->session->unset_userdata('frete_tipo');
            $this->session->unset_userdata('forma_pag');
            
            redirect(base_url('36d2a623d4b5878db84e0032b88bcabc/'.$id));
        }
        
        function pedido($id){
            $this->load->database();
            $this->load->model('comprasmodel');
            $this->load->model('configs');
            $this->load->model('produtos');
            $this->load->model('departamentos');
            
            $data['pedido'] = $this->comprasmodel->pedido($id);
            $data['geraBoleto'] = 1;
            
        	
        	$this->enviaEmail($id);
            
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
            
            $dados = $this->comprasmodel->getPedido($idpedido);
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
    
        function retornoPGM(){
            /*
            id	                                                                ID da transação.	
            event	                                                            A qual evento o postback se refere.     Transações: transaction_status_changed.
                                                                                                                        Assinatura: subscription_status_changed
                                                                                                                        Link de Pagamento: order_status_changed
                                                                                                                        Recebedor: recipient_status_changed
            old_status	                                                        Status anterior da transação.	
            desired_status	                                                    Status ideal para objetos deste tipo, em um fluxo normal, onde autorização e captura são feitos com sucesso, por exemplo.	
            current_status	                                                    Status para o qual efetivamente mudou.	
            object                                                              Qual o tipo do objeto referido.	        Transações: transaction
                                                                                                                        Assinaturas: subscription
                                                                                                                        Link de Pagamento: order
                                                                                                                        Recebedor: recipient
            transaction	                                                        Possui todas as informações do objeto. Para acessar objetos internos basta acessar a chave transaction[objeto1][objeto2]. Ex: para acessar o ddd: transaction[phone][ddd]
            
            id
            fingerprint
            event
            old_status
            desired_status
            current_status
            object
            
            $expectSignat   = sha1('ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG');
            $signat         = $output['fingerprint'];
            if($expectSignat == $signat){
                $this->load->database();
                $this->load->model('pagmemodel');
                $this->pagmemodel->insert($output);
                
                
            }
            */
            //curl -X GET ':transaction_id/postbacks?api_key=SUA_API_KEY'
            $url = 'https://api.pagar.me/1/transactions/';
            $place = '12464608/postbacks?api_key=ak_test_12DycAGEQ7JqUyQm7YJlIfRrWh5dIG';
            $curl = curl_init($url.$place);
        	$resultado = curl_exec($curl);
        	        curl_close($curl);
            print_r($resultado);
            
            
        }
}