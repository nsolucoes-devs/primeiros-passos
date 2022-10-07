<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Biblioteca modulada para funções de pagamento
 *  
 */
class Modulopagamento{

    /**
     * ATENÇÃO! IMPORTANTE!
     * 
     * Todas os comentários marcados com (NÃO CONCLUÍDO):
     * Precisam ser revisados e/ou concluídos
     * 
     * A seguir estão as variáveis que devem ser alteradas recebendo o nome das colunas no banco de dados
     * 
     */
    
    //-> Colunas das credenciais
    /*-> E-mail contato */      private $cred_email = "";
    /*-> PagSeguro Token */     private $cred_ps_token = "";
    /*-> PagSeguro E-mail */    private $cred_ps_email = "";
    /*-> Token da API de SMS */ private $cred_sms_token = "";
    
    //-> Colunas do comprador
    /*-> ID de referência */    private $c_id = "id_participante";
    /*-> Nome */                private $c_nome = "nome_participante";
    /*-> CPF */                 private $c_cpf = "cpf_participante";
    /*-> Telefone */            private $c_tel = "fone_participante";
    /*-> E-mail */              private $c_email = "email_participante";

    //-> Colunas do item
    /*-> ID do item */          private $i_id = "item_id";
    /*-> Descrição */           private $i_desc = "item_desc";
    /*-> Quantidade */          private $i_qtd = "item_qtd";
    /*-> Valor unitário */      private $i_vlr = "item_vlr";
    /*-> Valor tota */          private $i_total = "item_total";
    
    //-> Colunas do titular
    /*-> Nome */                private $t_nome = "t_nome";
    /*-> CPF */                 private $t_cpf = "t_cpf";
    /*-> Nascimento */          private $t_nasc = "t_nasc";
    /*-> DDD do telefone */     private $t_tel_ddd = "t_tel_ddd";
    /*-> N° do telefone */      private $t_tel_nums = "t_tel_nums";

    /**
     * Variáveis globais que estão guardadas no banco de dados
     * 
     */
    private $ps_token;
    private $ps_email;
    private $email_contato;
    private $sms_token;
    private $_CI;
    
    /**
     * Função construct para pegar os dados do banco e atribuir às variáveis
     * 
     */
    public function __construct(){
        /**
         * $this->load->model('credenciais');
         * $this->load->model('configuracoes');
         * $credenciais = $this->credenciais->getCredenciais();
         * $configs = $this->configuracoes->get();
         * 
         * $ps_token = $credenciais[$cred_ps_token];
         * $ps_email = $credenciais[$cred_ps_email];
         * $email_contato = $configs[$cred_email];
         */
         
        $this->_CI = & get_instance();
        $this->_CI->load->model('sendemail');
        $this->_CI->load->config('email');
        $this->_CI->load->library('email');
         
        $this->ps_token = 'da4fd358-f1d9-4106-8977-cb62961ced5f8f56994a4a20a56ce88f580b8a7716e9b28b-f409-4515-ad34-bac7ca845ffe';
        $this->ps_email = 'excalibur.personalizacoes@gmail.com';
        $this->email_contato = 'contato@reidospremios.com.br';
        $this->sms_token = '5cb1863a331080f52066133b1a64e3f1';
    }

    /**
     * Função que vai receber os dados de uma compra com cartão de crédito 
     * e fazer a comunicação com o PagSeguro.
     * 
     * @param array
     * @param string
     * @param string
     * @param array
     * @param array
     * 
     */
    public function psCredito($comprador, $senderHash, $cardToken, $titular, $item){
        
        //-> Array de dados a serem enviados para o PagSeguro
        $psData = array(
                //-> Dados relativos à configuração da compra
                'token'                         => $this->ps_token,                          //-> Token do PagSeguro
                'receiverEmail'                 => $this->ps_email,                          //-> E-mail do PagSeguro
                'paymentMode'                   => 'default',                               //-> Modo de pagamento
                'paymentMethod'                 => 'creditCard',                            //-> Método de pagamento
                'currency'                      => 'BRL',                                   //-> Moeda utilizada
                'notificationURL'               => base_url('pagamento/retornoPagSeguro'),  //-> URL onde serão enviadas as notificações
                
                //-> Dados relativos ao item comprado
                //-> Para colocar mais de 1, apenas acrescente os mesmos campos e troque o número no final do nome do campo. Ex: itemId2, itemId3...
                'itemId1'                       => $item[$this->i_id],                       //-> ID do item comprado
                'itemDescription1'              => $item[$this->i_desc],                     //-> Descrição do item comprado
                'itemQuantity1'                 => $item[$this->i_qtd],                      //-> Quantidade do item comprado
                'itemAmount1'                   => $item[$this->i_vlr],                      //-> Valor unitário do item comprado
                
                //-> Dados relativos ao comprador
                'reference'                     => $comprador[$this->c_id],                  //-> Referência da compra no nosso sistema
                'senderName'                    => $comprador[$this->c_nome],                //-> Nome do comprador
                'senderCPF'                     => $comprador[$this->c_cpf],                 //-> CPF do comprador
                'senderAreaCode'                => substr($comprador[$this->c_tel], 0, 2),   //-> DDD do telefone do comprador
                'senderPhone'                   => substr($comprador[$this->c_tel], 2),      //-> Números sem o DDD do telefone do comprador
                'senderEmail'                   => $comprador[$this->c_email],               //-> E-mail do comprador
                'senderHash'                    => $senderHash,                             //-> SenderHash gerado
                
                //-> Dados relativos ao envio
                'shippingAddressRequired'       => false,                                   //-> Se é necessário o envio do item comprado
                'billingAddressStreet'          => 'RUA ELIAS MIGUEL ARABE',                //-> Endereço do remetente
                'billingAddressNumber'          => '816',                                   //-> Número do endereço do remetente
                'billingAddressDistrict'        => 'Jardim Do Lago',                        //-> Bairro do remetente
                'billingAddressPostalCode'      => '38081537' ,                             //-> CEP do remetente
                'billingAddressCity'            => 'Uberaba',                               //-> Cidade do remetente
                'billingAddressState'           => 'MG',                                    //-> Estado do remetente
                'billingAddressCountry'         => 'BRA',                                   //-> País do remetente
                
                //-> Dados relativos à forma de pagamento
                'creditCardToken'               => $cardToken,                              //-> Token do cartão de crédito
                'installmentQuantity'           => 1,                                       //-> Quantidade de parcelas da compra
                'installmentValue'              => $item[$this->i_total],                    //-> Valor das parcelas da compra
                
                //-> Dados relativos ao cartão de crédito utilizado
                'creditCardHolderName'          => $titular[$this->t_nome],                  //-> Nome do títular
                'creditCardHolderCPF'           => $titular[$this->t_cpf],                   //-> CPF do títular
                'creditCardHolderBirthday'      => $titular[$this->t_nasc],                  //-> Data de nascimento do títular
                'creditCardHolderAreaCode'      => $titular[$this->t_tel_ddd],               //-> DDD do telefone do títular
                'creditCardHolderPhone'         => $titular[$this->t_tel_nums],              //-> Números sem o DDD do telefone do títular
            );
        
        //-> Envia os dados para o model fazer a conexão via CURL com o PagSeguro
        $curl = get_instance()->pagamentosmodel->psCredCurl($psData, $this->ps_email);
        
        return $curl;
    }
    
    /**
     * Função que vai receber os dados de uma compra com cartão de débito 
     * e fazer a comunicação com o PagSeguro.
     * 
     * @param array
     * @param string
     * @param string
     * @param array
     * 
     */
    public function psDebito($comprador, $senderHash, $banco, $item){

        //-> Array de dados a serem enviados para o PagSeguro
        $psData = array(
                //-> Dados relativos à configuração da compra
                'token'                         => $ps_token,                               //-> Token do PagSeguro
                'receiverEmail'                 => $ps_email,                               //-> E-mail do PagSeguro
                'paymentMode'                   => 'default',                               //-> Modo de pagamento
                'paymentMethod'                 => 'eft',                                   //-> Método de pagamento
                'currency'                      => 'BRL',                                   //-> Moeda utilizada
                'notificationURL'               => base_url('modulopagamento/psRetorno'),   //-> URL onde serão enviadas as notificações
                'bankName'                      => $banco,                                  //-> Nome do banco
                
                //-> Dados relativos ao item comprado
                //-> Para colocar mais de 1, apenas acrescente os mesmos campor e troque o número no final do nome do campo. Ex: itemId2, itemId3...
                'itemId1'                       => $item[$i_id],                            //-> ID do item comprado
                'itemDescription1'              => $item[$i_desc],                          //-> Descrição do item comprado
                'itemQuantity1'                 => $item[$i_qtd],                           //-> Quantidade do item comprado
                'itemAmount1'                   => $item[$i_vlr],                           //-> Valor unitário do item comprado
                
                //-> Dados relativos ao comprador
                'reference'                     => $comprador[$c_id],                       //-> Referência da compra no nosso sistema
                'senderName'                    => $comprador[$c_nome],                     //-> Nome do comprador
                'senderCPF'                     => $comprador[$c_cpf],                      //-> CPF do comprador
                'senderAreaCode'                => substr($comprador[$c_tel], 0, 2),        //-> DDD do telefone do comprador
                'senderPhone'                   => substr($comprador[$c_tel], 2),           //-> Números sem o DDD do telefone do comprador
                'senderEmail'                   => $comprador[$c_email],                    //-> E-mail do comprador
                'senderHash'                    => $senderHash,                             //-> SenderHash gerado
                'shippingAddressRequired'       => false,                                   //-> Se é necessário o envio do item comprado
            );
            
        //-> Algumas configurações de envio
        $buildEnvio = http_build_query($psData);                                                    //-> Build do array de dados a serem enviados
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';                                  //-> URL da API
        $header = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');     //-> HTTP header requisitado pela API
        
        //-> Início do dos comandos de CURL
        $curl = curl_init();                                                //-> Iniciando o CURL
        curl_setopt($curl, CURLOPT_URL, $url . "?email=" . $ps_email);      //-> Configurando o URL de envio
		curl_setopt($curl, CURLOPT_POST, true);                             //-> Configurando o modo de envio = "POST"
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);                    //-> Configurando o HTTP header requisitado
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                   //-> Configurando o retorno
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                  //-> Configurando a verificação de certificado SSL (Não sei ao certo o que é)
		curl_setopt($curl, CURLOPT_POSTFIELDS, $buildEnvio);                //-> Configurando os dados a serem enviados
		curl_setopt($curl, CURLOPT_HEADER, false);                          //-> Configurando o header requisitado (Creio que usa ou o HTTP header ou o header)
		$xml = curl_exec($curl);                                            //-> Variável recebendo o XML retornado
		curl_close($curl);                                                  //-> Encerrando o CURL
		
		libxml_use_internal_errors(true);                                   //-> Permite obter informações do erro de forma interna
		
		$debugXML = $xml;                                                   //-> Armazenando o XML antes de fazer seu tratamento
		$xml = simplexml_load_string($xml);                                 //-> XML sendo tratado para poder utilizar
		
		//-> Cado dê erro no XML (Provavelmente alguma variável passando de forma errada) printa o erro
		if(false === $xml){
		    /*echo "Failed loading XML\n";
		    echo $debugXML;                                                 //-> Printa o XML antes de fazer o tratamento
		    foreach(libxml_get_errors() as $error){                         //-> Laço para printar os erros
		        echo "\t", $error->message;
		    }
		    echo "<br>";
		    print_r($psData);*/
		    return 2;
		}else{
		    //-> Caso não dê erro...
		    return 1;
		}
    }

    /**
     * Função que envia as mensagens de pagamento sempre que o sistema recebe as notifucações do PagSeguro, Mercado Pago ou Picpay
     * 
     * @param int
     * 
     */
	public function comprovante($id = null){
        
        //-> Recupera o participante do banco
        $part = get_instance()->crudparticipantes->getPartId($id);
        
        //-> Recupera os números do participante
        $numeros = get_instance()->sorteios->getNumerosPartId("sorteio_" . $part['sorteio_id'], $part['id_participante']);
        
        //-> Recupera o sorteio do banco
        $sorteio = get_instance()->sorteios->resgatasorteio($part['sorteio_id']);
        
        //-> Passa por todos os números concatenando eles com ","
        $num = $numeros[0]['idnumero'];
        for($i = 1; $i < count($numeros); $i++){
            $num .= ", " . $numeros[$i]['idnumero'];        //-> Concatenação dos números
        }
        
        //-> Atribuindo a string gerada acima ao participante
        $part['numeros'] = $num;
        
        //-> Envio de email e sms
        $this->email($part);
        //$this->sms($part);
	}

    /**
     * Função que vai enviar o e-mail para o comprador
     * 
     * @param array
     * 
     */
    public function email($comprador){
        
	    //-> Resgata o sorteio do participante
	    $aux = get_instance()->sorteios->resgatasorteio($comprador['sorteio_id']);
	    
	    //-> Verifica se o sorteio está ativo. Só envia o e-mail se estiver
	    if($aux['premioativo'] == 0){
	        
	        //-> Personaliza a mensagem de acordo com o status da transação
    	    if($comprador['status_transacao'] == 0  ){                                          //-> 0 = Análise
    	        $status = "Aguardando Aprovação";                                               //-> Status que vai ser colocado no corpo do e-mail
    	        $assunto = "Seu(s) certificado(s) foi(ram) reservado(s)!";                      //-> Assunto do e-mail
    	        $frase = "Seu(s) Certificado(s): ". $comprador['numeros'];                      //-> Frase que vai ser colocada no corpo do e-mail
    	        
    	    }elseif($comprador['status_transacao'] == 1 ){                                      //-> 1 = Aprovado
    	        $status = "Aprovado";                                                           //-> ||
    	        $assunto = "Parabens por adquirir seu(s) certificado(s)";                       //-> ||
    	        $frase = "Seu(s) Certificado(s): ". $comprador['numeros'];                      //-> ||
    	        
    	    }elseif($comprador['status_transacao'] == 2 ){                                      //-> 2 = Cancelado
    	        $status = "Cancelado";                                                          //-> ||
    	        $assunto = "Sua aquisição foi negada";                                          //-> ||
    	        $frase = "Seu(s) Certificado(s) estão disponíveis para compra novamente";       //-> ||
    	        
    	    }elseif($comprador['status_transacao'] == 3 ){                                      //-> 3 = Estornado
    	        $status = "Estornado";                                                          //-> ||
    	        $assunto = "Sentimos muito por ter desistido da sua aquisição!";                //-> ||
    	        $frase = "Seu(s) Certificado(s) estão disponíveis para compra novamente";       //-> ||
    	    }
    	    
    	    //-> Explode a coluna premio do sorteio para poder reformatar os prêmios de um jeito apresentável
    	    $aux2 = explode("|", $aux['premio']);
    	    $pre = "";
    	    for($i = 0; $i < count($aux2); $i++){       //-> Passa por todos os prêmios
    	        if($aux2[$i] != "99"){                  //-> Verifica se não é o último item
    	            $k = $i + 1;
    	            $pre = $pre . "Prêmio " . $k . ": " . $aux2[$i] . "<br>";
    	        }
    	    }

            //-> Recupera o participante do banco
        	$partUnico = get_instance()->crudparticipantes->getPartId($comprador['id_participante']);
    	    
    	    //-> Monta o array que vai ser enviado para o corpo do e-mail
    	    $data = array(
    	        'nome_participante'     => $comprador['nome_participante'],                                         //-> Nome do participante
    	        'numero_pedido'         => $comprador['numero_pedido'],                                             //-> Número do pedido
    	        'cpf_participante'      => $this->mask($comprador['cpf_participante'], "###.###.###-##"),           //-> CPF já formatado
    	        'fone_participante'     => $this->mask($comprador['fone_participante'], "(##) #####-####"),         //-> Telefone já formatado
        	    'frase'                 => $frase,                                                                  //-> Frase personalizada
    	        'nomesorteio'           => $aux['nome_sorteio'],                                                    //-> Nome do sorteio
    	        'numeros'               => $comprador['numeros'],                                                   //-> Números comprados
    	        'premios'               => $pre,                                                                    //-> Prêmios formatados
    	        'valor'                 => $aux['valor'] * $comprador['qtd_titulos'],                               //-> Valor total da compra
    	        'data_compra'           => $comprador['data_compra'],                                               //-> Data da compra
    	        'sort'                  => $aux['datefinal'],                                                       //-> Data final do sorteio
    	        'statuspagamento'       => $status,                                                                 //-> Status da transação
    	        'qtd_titulos'           => $comprador['qtd_titulos'],                                               //-> Qauntidade de certificados
    	        'ps_code'               => $partUnico['ps_code'],                                                   //-> Código da transação no PagSeguro
    	    );
    	        
    	    //-> E-mail do comprador para qual vai ser enviado o e-mail
    	    $email = $comprador['email_participante'];
    	    
            //-> Corpo do e-mail vai receber o retorno da função mailbody, o retorno será uma string formatada para mostrar
            $mailbody = $this->_CI->sendemail->mailbody($data);
            
            //-> De (Origem) > Para (Destino)
            $this->_CI->email->from($email_contato, 'Rei dos Prêmios');
            $this->_CI->email->to($email);
            
            //-> Assunto e corpo do e-mail
            $this->_CI->email->subject($assunto);
            $this->_CI->email->message($mailbody);
            
            //-> Envia e-mail
            $this->_CI->email->send();
	    }
    }
    
    /**
     * Função que vai enviar o sms para o comprador
     * 
     * @param array
     * 
     */
	public function sms($comprador){
	    
	    //-> Necessário para não dar o erro "headers already sent"
	    ob_start();
	    
	    //-> Carrega o model de sorteios
	    $this->load->model("sorteios");
	    
	    //-> Resgata sorteio do banco
	    $aux = $this->sorteios->resgatasorteio($comprador['sorteio_id']);
	    //-> Explode a coluna premio do sorteio
	    $aux2 = explode("|", $aux['premio']);
        
        //-> Verifica se o sorteio está ativo. Só envia o sms se estiver
        if($aux['premioativo'] == 0){
            
            //-> Personaliza a mensagem de acordo com o status da transação
            if($dados['status_transacao'] == 0  ){                                              //-> 0 = Análise
    	        $status = "Aguardando Aprovação";                                               //-> Status que vai ser colocado no corpo do sms
    	        $assunto = "Seu(s) certificado(s) foi(ram) reservado(s)!";                      //-> Assunto do sms
    	        $frase = "Rei dos Prêmios: Seu(s) Certificado(s): ".$dados['numeros'];          //-> Frase que vai ser colocada no corpo do sms
    	        
    	    }elseif($dados['status_transacao'] == 1 ){                                          //-> 1 = Aprovado
    	        $status = "Aprovado";                                                           //-> ||
    	        $assunto = "Parabens por adquirir seu(s) certificado(s)";                       //-> ||
    	        $frase = "Rei dos Prêmios: Seu(s) Certificado(s): ".$dados['numeros'];          //-> ||
    	        
    	    }elseif($dados['status_transacao'] == 2 ){                                          //-> 2 = Cancelado
    	        $status = "Cancelado";                                                          //-> ||
    	        $assunto = "Sua aquisição foi negada";                                          //-> ||
    	        $frase = "Seu(s) Certificado(s) estão disponiveis para compra novamente";       //-> ||
    	        
    	    }elseif($dados['status_transacao'] == 3 ){                                          //-> 3 = Estornado
    	        $status = "Estornado";                                                          //-> ||
    	        $assunto = "Sentimos muito por ter desistido da sua aquisição!";                //-> ||
    	        $frase = "Seu(s) Certificado(s) estão disponíveis para compra novamente";       //-> ||
    	    }
            
            //-> Monta a mensagem que será enviada no sms
            $msg = $frase.", Sorteio: ".$aux['nome_sorteio'].", Status: " . $status;

            $url = 'sms.shortcode.com.br/app/modulo/api/index.php';             //-> URL para efetuar a conexão por CURL
            $url = str_replace(PHP_EOL, "", $url);                              //-> Necessário para que a url não dê problema
            
            //-> Dados requisitados pela API do sms
            $post_data = array(
                    'action'        => 'sendsms',                               //-> O que deve ser feito
                    'token'         => $sms_token,                              //-> Token da conta do sms
                    'tipo'          => '3',                                     //-> Para mais informações, acessar a documentação da api
                    'msg'           => $msg,                                    //-> Mensagem
                    'numbers'       => $dados['fone_participante']              //-> Telefone para quem deseja enviar. Apenas números e sem os 2 digítos do país.
                );
                
            //-> Envia para o model, lá é executada a conexão via CURL
            $this->pagamentosmodel->curlSMS($url, $post_data);
        }
    }
    
    /**
     * Função que formata uma string de acordo com a máscara passada
     * 
     * @param string
     * @param string
     * 
     * @return string
     * 
     */
    private function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){     //-> Passa por todos os caracteres da máscara
        
            if($mask[$i] == '#'){                   //-> Verifica se é um lugar de placeholder, aonde ele vai completar com um número
                if(isset($val[$k]))                 //-> Verifica se existe esse lugar no valor passado
                    $maskared .= $val[$k++];
            }
            
            else{                                   //-> Se não for um placeholder, é uma pontuação que deve ser mantida naquela posição na string
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        
        //-> Retorna a string já formatada
        return $maskared;

    }

    /**
     * Função que vai tratar os dados do retorno do PagSeguro
     * 
     * @param string
     * 
     * @return array
     * 
     */
    public function tratamentoRetornoPS($notificationCode){
        
        //-> Dados que serão enviados para o PagSeguro para recuperar alguns dados
        $data = array(
                'token' => $ps_token,       //-> Token do PagSeguro
                'email' => $ps_email,       //-> E-mail do PagSeguro
            );
        
        //-> A notificação não te dá os dados da compra, portanto deve ser feito um curl buscando essa compra baseado no código da notificação
        $data = http_build_query($data);    //-> Configura os campos a serem enviados (token e e-mail)
        
        //-> Url a ser enviada para o PagSeguro
        $url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/" .$notificationCode.'?'.$data; 
        
        //-> Manda o url para o model fazer a conexão via CURL e recebe o retorno em return
        $return = $this->pagamentosmodel->curlRetornoPS($url);
        
        return $return;
    }

}