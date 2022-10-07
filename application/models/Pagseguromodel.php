<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagseguromodel extends CI_Model {
    
        /*Dados de Identificação App e Vendedor de Testes
        appID: app4121541498
        AppKey: 06E421C9BBBB7D5EE4A75FB4D44EC309
        
        E-mail: v36971721462643983329@sandbox.pagseguro.com.br
        Senha: 9x9119X5521ch192
        Chave Pública: PUB6F7200CC02684D8EBE803A5DA9CF586D
        */

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

        public function cartaoCredito(){
            $dados      = $this->variaveis();
            $sessionId  = $this->input->post('sessionId');
            $valor      = 10.00;
            $cartao     = $this->input->post('creditCardNumber');
            $cvv        = $this->input->post('creditCardCvv');
            $expmonth   = $this->input->post('creditCardExpMonth');
            $expyear    = $this->input->post('creditCardExpYear');
            $cardToken = $this->cardToken($sessionId, $valor, $cartao, $cvv, $expmonth, $expyear);
            
            /*////////////////////////////////////////
            //ORGANIZANDO OS DADOS DE ENVIO DE COMPRA
            */////////////////////////////////////////
        
            //Dados do vendedor e da forma de pagamento
            $data['token'] = $dados['tokenPS']; 
            $data['paymentMode'] ='default'; //Modo de pagamento
            $data['paymentMethod'] ='creditCard'; //Método de pagamento
            $data['receiverEmail'] = $dados['emailPS']; //Email de cadastro do PagSeguro
            $data['currency'] ='BRL'; //Moeda
            
            $data['itemId1'] = '0001'; //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
            $data['itemDescription1'] = "Produto"; //Nome do produto
            $data['itemAmount1'] = 100.12; //Valor da unidade do produto
            $data['itemQuantity1'] = 1; //Quantidade do produto
            
            //dados do comprador
            $data['reference'] = "ID00123"; //Id do sistema
            $data['senderName'] = "Comprador de Teste"; //nome do comprador
            $data['senderCPF'] = "06808142645"; //CPF do comprador
            $data['senderAreaCode'] = "34"; //codigo de area do telefone DDD
            $data['senderPhone'] = "999999999"; //telefone do comprador
            $data['senderEmail'] = "v36971721462643983329@sandbox.pagseguro.com.br"; //Email do comprador
            
            //dados do cartão
            $data['senderHash'] = $this->input->post('senderHash');
            $data['creditCardToken'] = $cardToken; 
            $data['installmentQuantity'] = 1; //Alterar caso seja inserido parcelamento
            $data['installmentValue'] = 100.12; //Alterar para valor das parcelas, caso seja inserido parcelamento
            $data['creditCardHolderName'] = mb_strtoupper('Comprador de Teste'); //Nome do titular do cartão de crédito
            $data['creditCardHolderCPF'] = '06808142645'; //CPF do titular do cartão de crédito
            $data['creditCardHolderBirthDate'] = $this->input->post('dataaniversario'); //Data de nascimento do titular do cartão de crédito
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
            $data = http_build_query($data);
    		$Nurl = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';
    		$place = "?email=".$dados['emailPS'];
    		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
    
    		$curl = curl_init($Nurl.$place);
        		curl_setopt($curl, CURLOPT_POST, true);
        		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
        		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        		curl_setopt($curl, CURLOPT_HEADER, false);
        	$xml = curl_exec($curl);
                curl_close($curl);
            print_r($xml);
        }
        
        public function boleto(){
            $dados = $this->variaveis();
            
            $data['token'] = $dados['tokenPS']; 
            $data['paymentMode'] ='default'; //Modo de pagamento
            $data['paymentMethod'] ='boleto'; //Método de pagamento
            $data['receiverEmail'] = $dados['emailPS']; //Email de cadastro do PagSeguro
            $data['currency'] ='BRL'; //Moeda
            
            $data['extraAmount'] = '5.00'; //Taxa de criação do boleto
            $data['itemId1'] = '0001'; //Identificação do produto, caso mais de 1, alterar numeração no nome do campo
            $data['itemDescription1'] = "Produto"; //Nome do produto
            $data['itemAmount1'] = 100.12; //Valor da unidade do produto
            $data['itemQuantity1'] = 1; //Quantidade do produto

            //dados do comprador
            $data['reference'] = "ID00123"; //Id do sistema
            $data['senderName'] = "Comprador de Teste"; //nome do comprador
            $data['senderCPF'] = "06808142645"; //CPF do comprador
            $data['senderAreaCode'] = "34"; //codigo de area do telefone DDD
            $data['senderPhone'] = "999999999"; //telefone do comprador
            $data['senderEmail'] = "v36971721462643983329@sandbox.pagseguro.com.br"; //Email do comprador

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
            $data = http_build_query($data);
    		$Nurl = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';
    		$place = "?email=".$dados['emailPS']."&token=".$dados['tokenPS'];
    		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
    
    		$curl = curl_init($Nurl.$place);
        		curl_setopt($curl, CURLOPT_POST, true);
        		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
        		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        		curl_setopt($curl, CURLOPT_HEADER, false);
        	$xml = curl_exec($curl);
                curl_close($curl);
            print_r($xml);
        }
        
        /*
        //Boleto
        curl --location -g --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email={{ADICIONE%20SEU%20E_MAIL}}&token={{ADICIONE%20O%20TOKEN}}' \
        --header 'Content-Type: application/x-www-form-urlencoded' \
        
        --data-urlencode 'shippingAddressStreet=Av.Brig.Faria Lima' \
        --data-urlencode 'shippingAddressNumber=1384' \
        --data-urlencode 'shippingAddressComplement=5oandar' \
        --data-urlencode 'shippingAddressDistrict=JardimPaulistano' \
        --data-urlencode 'shippingAddressPostalCode=01452002' \
        --data-urlencode 'shippingAddressCity=SaoPaulo' \
        --data-urlencode 'shippingAddressState=SP' \
        --data-urlencode 'shippingAddressCountry=BRA' \
        --data-urlencode 'shippingType=1' \
        --data-urlencode 'shippingCost=1.00'
        
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
        
        //Cartão de Crédito
        curl --location --request POST 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=lucorrea@uolinc.com&token=5D4E19FBCF9C4CE1B20FA94485BAE018' \
        --header 'Content-Type: application/xml' \
        --data-raw '<payment>
            <mode>default</mode>
            <method>creditCard</method>
            <sender>
                <name>Jose Comprador</name>
                <email>comprador@sandbox.pagseguro.com.br</email>
                <phone>
                    <areaCode>11</areaCode>
                    <number>30380000</number>
                </phone>
                <documents>
                    <document>
                        <type>CPF</type>
                        <value>22111944785</value>
                    </document>
                </documents>
            
            </sender>
            <currency>BRL</currency>
            <notificationURL>https://sualoja.com.br/notificacao</notificationURL>
            <items>
                <item>
                    <id>1</id>
                    <description>Notebook Prata</description>
                    <quantity>1</quantity>
                    <amount>70.00</amount>
                </item>
            </items>
        <extraAmount>0.00</extraAmount>
            <reference>R123456</reference>
            <shipping>
             <addressRequired>false</addressRequired>
            </shipping>
            <creditCard>
                <token>6cd359e500d34b758bb1b767e906825a</token>
               <installment>
                    <noInterestInstallmentQuantity>3</noInterestInstallmentQuantity>
                     <quantity>3</quantity>
                    <value>23.33</value>
                </installment>
                <holder>
                    <name>Nome impresso no cartao</name>
                    <documents>
                        <document>
                            <type>CPF</type>
                            <value>22111944785</value>
                        </document>
                    </documents>
                    <birthDate>20/10/1980</birthDate>
                    <phone>
                        <areaCode>11</areaCode>
                        <number>999991111</number>
                    </phone>
                </holder>
                <billingAddress>
                    <street>Av. Brigadeiro Faria Lima</street>
                    <number>1384</number>
                    <complement>1 andar</complement>
                    <district>Jardim Paulistano</district>
                    <city>Sao Paulo</city>
                    <state>SP</state>
                    <country>BRA</country>
                    <postalCode>01452002</postalCode>
                </billingAddress>
            </creditCard>
        </payment>'
        
        
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
        
        public function retornopagseguro(){
            
        }
    
}