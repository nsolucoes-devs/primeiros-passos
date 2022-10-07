<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class PagamentosPS extends MY_Controller {
        /*Dados de Identificação App e Vendedor de Testes
        appID: app4121541498
        AppKey: 06E421C9BBBB7D5EE4A75FB4D44EC309
        
        E-mail: v36971721462643983329@sandbox.pagseguro.com.br
        Senha: 9x9119X5521ch192
        Chave Pública: PUB6F7200CC02684D8EBE803A5DA9CF586D
        
        Cartão de teste: 4111111111111111
        Bandeira: VISA Válido até: 12/2030 CVV: 123
        */

        public function variaveis(){
            $data = array(    
                'rua'        => "Avenida Profª Maria da Paz Barcelos de Almeida",
                'numero'     => "100",
                'bairro'     => "Elza Amui I1",
                'cep'        => "38082230",
                'cidade'     => "Uberaba",
                'uf'         => "MG",
                'pais'       => "Brasil",
                'emailPS'    => "excalibur.personalizacoes@gmail.com",
                'tokenPS'    => "38D76B013B1E42ED9C0DAA6F92A9FEE0", //SandBox
                'urlPS'      => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions', //SandBox
                'retUrlPS'   => 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/', //SandBox
                //'tokenPS'    => "da4fd358-f1d9-4106-8977-cb62961ced5f8f56994a4a20a56ce88f580b8a7716e9b28b-f409-4515-ad34-bac7ca845ffe", //Produção
                //'urlPS'      => 'https://ws.pagseguro.uol.com.br/v2/transactions',
    		    //'retUrlPS'   => 'https://ws.pagseguro.uol.com.br/v3/transactions',
                
            );
            return $data;
        }
        
        public function callPaymentPagSeguro(){
            /*//////////////////////////////////////////////////
            /////// PAGSEGURO CRIAR SESSÃO DE TRANSAÇÃO ////////
            /*//////////////////////////////////////////////////
            $dados = $this->variaveis();
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
                    
            $credenciais = array(
    	    	"email" => $dados['emailPS'],
    			"token" => $dados['tokenPS'],
    	    );

        	$curl = curl_init($url);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
        	$resultado = curl_exec($curl);
        	    curl_close($curl);
        	$session = simplexml_load_string($resultado)->id;
            $this->session->set_userdata('pagsession', $session);
            $this->load->view('pagsegcredito');
        }
        
        public function cardToken($sessionId, $valor, $cartao, $cvv, $expmonth, $expyear){
        /*////////////////////////////////////////
        /////////GERAR O TOKEN DO CARTÃO//////////
        */////////////////////////////////////////
        
        $credenciais = array(
    	    	'sessionId'             => $sessionId,
    			'amount'                => $valor,                                  //Valor com 2 casas decimais separado por ponto 10.00
    			'cardNumber'            => $cartao,                                 //Número completo do cartão sem espaços ou pontos
    			'cardCvv'               => $cvv,                                    //Código de segurança do cartão
    			'cardExpirationMonth'   => $expmonth,                               //2DIGITOS
    			'cardExpirationYear'    => $expyear,                                //4DIGITOS
    			//'cardBrand'           => $bandeira,                               //Bandeira do Cartão
    	);
    	
            $url = "https://df.uol.com.br/v2/cards";
            
            $curl = curl_init($url);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
            $resultado = curl_exec($curl);
                curl_close($curl);
            $res = json_decode(json_encode($resultado), true);
            return $res;
        }

        public function boleto(){
            $dados = $this->variaveis();
            $this->load->database();
            $this->load->model('carrinhomodel');
            $compra = $this->carrinhomodel->retriveCompra($this->session->userdata('finalcompra'));
            
            $data['token'] = $dados['tokenPS']; 
            $data['paymentMode'] ='default'; //Modo de pagamento
            $data['paymentMethod'] ='boleto'; //Método de pagamento
            $data['receiverEmail'] = $dados['emailPS']; //Email de cadastro do PagSeguro
            $data['currency'] ='BRL'; //Moeda
            
            $data['extraAmount'] = '5.00'; //Taxa de criação do boleto
            
            $produtos = $compra['compra'];
            
            for($i=1; $i<=count($produtos);$i++){
                $data['itemId'.$i] = str_pad($i, 4, '0', STR_PAD_LEFT); //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
                $data['itemDescription'.$i] = $produtos[$i-1]['produto']; //Nome do produto
                $data['itemAmount'.$i] = $produtos[$i-1]['valor']; //Valor da unidade do produto
                $data['itemQuantity'.$i] = $produtos[$i-1]['quantidade']; //Quantidade do produto
                $count = $i;
            }
            $count = $count+1;
            $data['itemId'.$count] = str_pad($count, 4, '0', STR_PAD_LEFT); //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
            $data['itemDescription'.$count] = $compra['frete']['produto']; //Nome do produto
            $data['itemAmount'.$count] = $compra['frete']['valor']; //Valor da unidade do produto
            $data['itemQuantity'.$count] = $compra['frete']['quantidade']; //Quantidade do produto
            
            //dados do comprador
            $data['reference'] = $this->session->userdata('finalcompra'); //Id do sistema
            $data['senderName'] = $compra['senderName']; //nome do comprador
            $data['senderCPF'] = $compra['senderCPF']; //CPF do comprador
            $data['senderAreaCode'] = "99"; //codigo de area do telefone DDD
            $data['senderPhone'] = "999999999"; //telefone do comprador
            $data['senderEmail'] = $compra['senderEmail']; //Email do comprador

            //dados do cartão
            $data['senderHash'] = $this->input->post('senderHash');
            $data['notificationURL'] = base_url('pagamentosPS/retornopagseguro'); //Url onde serão enviadas as notificações sempre que essa compra mudar de status.
            
            //dados de envio
            $data['shippingAddressRequired'] = false;
            $data['billingAddressStreet'] = $dados['rua']; 
            $data['billingAddressNumber'] = $dados['numero']; 
            $data['billingAddressDistrict'] = $dados['bairro']; 
            $data['billingAddressPostalCode'] = $dados['cep']; 
            $data['billingAddressCity'] = $dados['cidade']; 
            $data['billingAddressState'] = $dados['uf']; 
            $data['billingAddressCountry'] = $dados['pais']; 
            
            //Inicio de envio da solicitação de pagamento
            $data2 = http_build_query($data);
    		$Nurl = $dados['urlPS'];
    		$place = "?email=".$dados['emailPS']."&token=".$dados['tokenPS'];
    		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
    
    		$curl = curl_init($Nurl.$place);
        		curl_setopt($curl, CURLOPT_POST, true);
        		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
        		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        		curl_setopt($curl, CURLOPT_POSTFIELDS, $data2);
        		curl_setopt($curl, CURLOPT_HEADER, false);
        	$xml = curl_exec($curl);
                curl_close($curl);
            
            $boleto = (array)simplexml_load_string($xml);
            
            $this->session->unset_userdata('quantidade_carrinho');
            //$this->session->unset_userdata('cliente_cep');
            $this->session->unset_userdata('cliente_sem_endereco');
            $this->session->unset_userdata('compra');
            $this->session->unset_userdata('finalcompra');
            $this->session->unset_userdata('login_erro');
            $this->session->unset_userdata('frete_valor');
            $this->session->unset_userdata('frete_tipo');
            $this->session->unset_userdata('forma_pag');
            $this->session->unset_userdata('pagsession');
            
            $this->enviaEmail($this->session->userdata('cliente_user_id'));
            
            redirect($boleto['paymentLink']);
        } //ok
        
        public function credito(){
            $limpeza = array('/', '.', '-', ' ', ')', '(');
            
            $dados = $this->variaveis();
            $this->load->database();
            $this->load->model('carrinhomodel');
            $compra = $this->carrinhomodel->retriveCompra($this->session->userdata('finalcompra'));
            $cardToken = $this->cardToken($this->input->post('sessionId'), $compra['valorTotal'], $this->input->post('creditCardNumber'), $this->input->post('creditCardCvv'), $this->input->post('creditCardExpMonth'), $this->input->post('creditCardExpYear'));
            $produtos = $compra['compra'];
            
            if($this->input->post('seltitular') == 1){
                $z = $this->carrinhomodel->cardHolder($this->session->userdata('cliente_user_id'));
                $titularNome = $z['cliente_nome'];
                $titularCPF = $z['cliente_cpf'];
                $titularNascimento = date('d/m/Y', strtotime($z['cliente_nascimento']));;
            }else{
                $titularCPF = $this->input->post('titularcpf');
                $titularNome = $this->input->post('titularnome');
                $titularNascimento = date('d/m/Y', strtotime($this->input->post('titularnascimento')));
            }
            
            //inicio dos dados da compra
            $data['paymentMode']                = 'DEFAULT';
            $data['paymentMethod']              = 'creditCard';
            $data['senderName']                 = 'Cachaça Cheia de Manias';
            $data['senderEmail']                = $compra['senderEmail'];
            $data['senderAreaCode']             = '99';
            $data['senderPhone']                = '999999999';
            $data['senderCPF']                  = $compra['senderCPF'];
            $data['currency']                   = 'BRL';
            $data['notificationURL']            = base_url('pagamentosPS/retornopagseguro');
            
            for($i=1; $i<=count($produtos);$i++){
                $data['itemId'.$i]              = str_pad($i, 4, '0', STR_PAD_LEFT); //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
                $data['itemDescription'.$i]     = $produtos[$i-1]['produto']; //Nome do produto
                $data['itemQuantity'.$i]        = $produtos[$i-1]['quantidade']; //Quantidade do produto
                $data['itemAmount'.$i]          = $produtos[$i-1]['valor']; //Valor da unidade do produto
                $count = $i;
            }
            $count = $count+1;
            $data['itemId'.$count]              = str_pad($count, 4, '0', STR_PAD_LEFT); //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
            $data['itemDescription'.$count]     = $compra['frete']['produto']; //Nome do produto
            $data['itemQuantity'.$count]        = $compra['frete']['quantidade']; //Quantidade do produto
            $data['itemAmount'.$count]          = $compra['frete']['valor']; //Valor da unidade do produto
            
            $data['senderHash']                 = $this->input->post('senderHash');
            $data['extraAmount']                = number_format (0.0, 2); //53099extra amount invalid pattern: 0. Must fit the patern: -?\d+.\d{2}53048credit card holder birthdate invalid value: 21-10-1984
            $data['reference']                  = $this->session->userdata('finalcompra');
            $data['shippingAddressRequired']    = false;
            $data['creditCardToken']            = $cardToken;;
            $data['installmentInterest']        = false;  //noInterestInstallmentQuantity
            $data['installmentQuantity']        = '1';
            $data['installmentValue']           = number_format($compra['valorTotal'],2);
            $data['creditCardHolderName']       = mb_strtoupper($titularNome);;
            $data['creditCardHolderCPF']        = str_replace($limpeza, "", $titularCPF);;
            $data['creditCardHolderBirthDate']  = $titularNascimento; 
            $data['creditCardHolderAreaCode']   = '99';
            $data['creditCardHolderPhone']      = '999999999';
            $data['billingAddressStreet']       = $dados['rua']; 
            $data['billingAddressNumber']       = $dados['numero'];
            $data['billingAddressDistrict']     = $dados['bairro'];
            $data['billingAddressCity']         = $dados['cidade'];
            $data['billingAddressState']        = $dados['uf'];
            $data['billingAddressCountry']      = $dados['pais'];
            $data['billingAddressPostalCode']   = $dados['cep'];
            
            //fim dos dados da compra
            /*
            53005currency is required.
            53004items invalid quantity.
            53020sender phone is required.
            53018sender area code is required.
            53118sender cpf or sender cnpj is required.
            53010sender email is required.
            53013sender name is required.
            53024shipping address street is required.
            53029shipping address district is required.
            53035shipping address country is required.
            53031shipping address city is required.
            53033shipping address state is required.
            53022shipping address postal code is required.
            53026shipping address number is required.
            53037credit card token is required.
            53040installment value is required.
            53042credit card holder name is required.
            53055billing address street is required.
            53053billing address postal code is required.
            53038installment quantity is required.
            53066billing address country is required.
            53057billing address number is required.
            53062billing address city is required.
            53064billing address state is required.
            53045credit card holder cpf is required.
            53060billing address district is required.
            */
            //Inicio de envio da solicitação de pagamento
            $data2 = http_build_query($data);
            
    		$Nurl = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";
    		$Nurl = $dados['urlPS'];
    		$place = "?email=".$dados['emailPS']."&token=".$dados['tokenPS'];
    		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
    
    		$curl = curl_init($Nurl.$place);
        		curl_setopt($curl, CURLOPT_POST, true);
        		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
        		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        		curl_setopt($curl, CURLOPT_POSTFIELDS, $data2);
        		curl_setopt($curl, CURLOPT_HEADER, false);
        	$xml = curl_exec($curl);
                curl_close($curl);
            
            print_r($data2);
            print_r("<br>");
            print_r($xml);
            //$this->session->unset_userdata('quantidade_carrinho');
            //$this->session->unset_userdata('cliente_cep');
            //$this->session->unset_userdata('cliente_sem_endereco');
            //$this->session->unset_userdata('compra');
            //$this->session->unset_userdata('finalcompra');
            //$this->session->unset_userdata('login_erro');
            //$this->session->unset_userdata('frete_valor');
            //$this->session->unset_userdata('frete_tipo');
            //$this->session->unset_userdata('forma_pag');
            //$this->session->unset_userdata('pagsession');
            
            
            //$this->enviaEmail($this->session->userdata('cliente_user_id'));

        }
        
        public function retornopagseguro(){
            $dados = $this->variaveis();
            $this->load->database();
            $this->load->model('formaspagamento');
            
            $notificationCode = $_POST['notificationCode']; //IMPORTANTE GRAVAR NA COMPRA
            
            $url = $dados['retUrlPS'];
            $place = "notifications/".$notificationCode."?email=".$dados['emailPS']."&token=".$dados['tokenPS'];
            $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, $url.$place);
            $xml = curl_exec($curl);
                curl_close($curl);
            
            $retorno = simplexml_load_string($xml);
            
            $reference = $retorno->reference;
            $status = $retorno->status;
    
            $this->formaspagamento->atualizaHistorico($reference, $notificationCode, $status);
            
        } //ok
        
        function enviaEmail($id){
            $dados = $this->variaveis();
            $this->load->library('email');
            $this->load->database();
            $this->load->model('clientes');
            
            $a = $this->clientes->get($id);
            
            //Configuração              Default Value                          	Options & Description
            $config['useragent']	    = 'None';                               //CodeIgniter	None	    The “user agent”.
            $config['protocol']         = 'smtp';	                            //mail, sendmail, or smtp	The mail sending protocol.
            $config['mailpath']         = '/usr/sbin/sendmail';	                //URL  None	                The server path to Sendmail.
            $config['smtp_host']        = 'mail.nsolucoes.digital';             //No	None	            SMTP Server Address.
            $config['smtp_user']        = 'contato@nsolucoes.digital';          //No	None	            SMTP Username.
            $config['smtp_pass']        = 'z-)}S1oTt#9)';	                    //No	None	            SMTP Password.
            $config['smtp_port']        = '465';                                //No	None	            SMTP Port.
            $config['smtp_timeout']     = '60';	                                //No	None	            SMTP Timeout (in seconds).
            $config['smtp_keepalive']   = FALSE;	                            //TRUE or FALSE (boolean)	Enable persistent SMTP connections.
            $config['smtp_crypto']      = 'ssl';                                //No	tls or ssl	        SMTP Encryption
            //$config['wordwrap']         = TRUE;	                                //TRUE or FALSE (boolean)	Enable word-wrap.
            //$config['wrapchars']        = '';	                                //No	 	                Character count to wrap at.
            $config['mailtype']         = 'html';	                            //text or html	            Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don’t have any relative links or relative image paths otherwise they will not work.
            $config['charset']          = "utf-8";             	 	            //utf-8, iso-8859-1, etc.   Character set (utf-8, iso-8859-1, etc.).
            $config['validate']         = FALSE;                                //TRUE or FALSE (boolean)	Whether to validate the email address.
            $config['priority']         = 1;	                                //1, 2, 3, 4, 5	            Email Priority. 1 = highest. 5 = lowest. 3 = normal.
            $config['crlf']             = '\n';	                                //“\r\n” or “\n” or “\r”	Newline character. (Use “\r\n” to comply with RFC 822).
            $config['newline']          = '\n';	                                //“\r\n” or “\n” or “\r”	Newline character. (Use “\r\n” to comply with RFC 822).
            $config['bcc_batch_mode']   = FALSE;                                //TRUE or FALSE (boolean)	Enable BCC Batch Mode.
            $config['bcc_batch_size']   = 200;	                                //No    None	            Number of emails in each BCC batch.
            $config['dsn']              = FALSE;                                //TRUE or FALSE (boolean)	Enable notify message from server
            
            $this->email->initialize($config);
            
            $this->email->from($dados['emailPS'], "Cachaça Cheia de Manias");
            $this->email->to($a['cliente_email']);
            //$this->email->cc();
            //$this->email->bcc();
            
            $this->email->subject('Email Teste');
            $this->email->message('Testando o email, apos uma compra.');
            
            $this->email->send();
            
        }

        /*
        
        //Débito Online
        curl --location -g --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email={{ADICIONE%20SEU%20E_MAIL}}&token={{ADICIONE%20O%20TOKEN}}' \
        --header 'Content-Type: application/x-www-form-urlencoded' \
        --data-urlencode 'paymentMode=default' \
        --data-urlencode 'paymentMethod=eft' \
        --data-urlencode 'receiverEmail=comprador@sandbox.pagseguro.com.br' \
        --data-urlencode 'currency=BRL' \
        --data-urlencode 'extraAmount=1.00' \
        --data-urlencode 'itemId1=0001' \
        --data-urlencode 'itemDescription1=NotebookPrata' \
        --data-urlencode 'itemAmount1=24300.00' \
        --data-urlencode 'itemQuantity1=1' \
        --data-urlencode 'notificationURL=https://sualoja.com.br/notifica.html' \
        --data-urlencode 'reference=REF1234' \
        --data-urlencode 'senderName=JoseComprador' \
        --data-urlencode 'senderCPF=22111944785' \
        --data-urlencode 'senderAreaCode=11' \
        --data-urlencode 'senderPhone=56273440' \
        --data-urlencode 'senderEmail=comprador@uol.com.br' \
        --data-urlencode 'senderHash={{ADICIONE O HASH}}' \
        --data-urlencode 'shippingAddressStreet=Av.Brig.FariaLima' \
        --data-urlencode 'shippingAddressNumber=1384' \
        --data-urlencode 'shippingAddressComplement=5oandar' \
        --data-urlencode 'shippingAddressDistrict=JardimPaulistano' \
        --data-urlencode 'shippingAddressPostalCode=01452002' \
        --data-urlencode 'shippingAddressCity=SaoPaulo' \
        --data-urlencode 'shippingAddressState=SP' \
        --data-urlencode 'shippingAddressCountry=BRA' \
        --data-urlencode 'shippingType=1' \
        --data-urlencode 'shippingCost=1.00'
        
        HEADERS
        Content-Typeapplication/x-www-form-urlencoded
        PARAMS
        email{{ADICIONE SEU E_MAIL}}         Seu e-mail de sandbox
        token{{ADICIONE O TOKEN}}         Seu token de sandbox
        
        BODY urlencoded
        paymentMode                 default
        paymentMethod               eft    
        receiverEmail               comprador@sandbox.pagseguro.com.br
        currency                    BRL
        extraAmount                 1.00
        itemId                      10001
        itemDescription1            NotebookPrata
        itemAmount1                 24300.00
        itemQuantity1               1
        notificationURL             https://sualoja.com.br/notifica.html
        reference                   REF1234
        senderName                  JoseComprador
        senderCPF                   22111944785
        senderAreaCode              11
        senderPhone                 56273440
        senderEmail                 comprador@uol.com.br
        senderHash                  {{ADICIONE O HASH}}
        shippingAddressStreet       Av.Brig.FariaLima
        shippingAddressNumber       1384
        shippingAddressComplement   5oandar
        shippingAddressDistrict     JardimPaulistano
        shippingAddressPostalCode   01452002
        shippingAddressCity         SaoPaulo
        shippingAddressState        SP
        shippingAddressCountry      BRA
        shippingType                1
        shippingCost                1.00
        
        //Cancelamento
        curl --location -g --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/cancels?email={{ADICIONE%20SEU%20E_MAIL}}&token={{ADICIONE%20O%20TOKEN}}&transactionCode={{ADICIONE%20O%20C%C3%93DIGO%20DE%20TRANSA%C3%87%C3%83O}}' \
        --data-raw ''
        PARAMS
        email           {{ADICIONE SEU E_MAIL}}            Seu e-mail de sandbox
        token           {{ADICIONE O TOKEN}}               Seu token de sandbox
        transactionCode {{ADICIONE O CÓDIGO DE TRANSAÇÃO}}
        
        //Estorno Total
        curl --location -g --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/refunds?email={{ADICIONE%20SEU%20E_MAIL}}&token={{ADICIONE%20O%20TOKEN}}&transactionCode={{ADICIONE%20O%20C%C3%93DIGO%20DE%20TRANSA%C3%87%C3%83O}}' \
        --data-raw ''
        PARAMS
        email               {{ADICIONE SEU E_MAIL}}         Seu e-mail de sandbox
        token               {{ADICIONE O TOKEN}}            Seu token de sandbox
        transactionCode     {{ADICIONE O CÓDIGO DE TRANSAÇÃO}}
        
        //Estorno Parcial
        curl --location -g --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/refunds?email={{ADICIONE%20SEU%20E_MAIL}}&token={{ADICIONE%20O%20TOKEN}}&transactionCode={{ADICIONE%20O%20C%C3%93DIGO%20DE%20TRANSA%C3%87%C3%83O}}&refundValue={{ADICIONE%20O%20VALOR%20DO%20ESTORNO}}' \
        --data-raw ''
        PARAMS
        email           {{ADICIONE SEU E_MAIL}}         Seu e-mail de sandbox
        token           {{ADICIONE O TOKEN}}            Seu token de sandbox
        transactionCode {{ADICIONE O CÓDIGO DE TRANSAÇÃO}}
        refundValue     {{ADICIONE O VALOR DO ESTORNO}}
        */

    }