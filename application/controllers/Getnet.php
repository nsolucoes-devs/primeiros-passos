<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getnet extends MY_Controller {
    /*
    /   FUNÇÃO QUE TRATATARÁ TODAS AS CHAMADAS DE PAGAMENTO DO GETNET
    */
    function tokendeacesso(){
        $ambiente = '1snn5n9w';
        $sess_id = 'testes06808142645testes';
        $ch2 = curl_init('https://h.online-metrix.net/fp/tags.js?org_id='.$ambiente.'&session_id='.$sess_id);
        
        $clientId = "16e3fc77-c5dd-4544-a603-b81157f7d27b";
        $clientSecret = "b7eac9eb-7b1e-4160-8671-ae827d3bc570";
        $encode64 = base64_encode($clientId.":".$clientSecret);
        $url = 'https://api-sandbox.getnet.com.br';
        $path = '/auth/oauth/v2/token';
        
        $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/x-www-form-urlencoded",
                    "Authorization: Basic {$encode64}"
                ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'scope=oob&grant_type=client_credentials');
        $res = json_decode(json_encode(curl_exec($ch)), TRUE);
        curl_close($ch);
        curl_close($ch2);
        return json_decode(json_encode($res), true);
    }   //OK

    function tokencartao($authstring, $card_number, $customer_id){
        $ambiente = '1snn5n9w';
        $sess_id = 'testes06808142645testes';
        $ch2 = curl_init('https://h.online-metrix.net/fp/tags.js?org_id='.$ambiente.'&session_id='.$sess_id);
        
        $url = 'https://api-sandbox.getnet.com.br';
        $path = '/v1/tokens/card';
        
        $charge = array(
            'card_number'   => $card_number,
            'customer_id'   => $customer_id,
            );
        
        $charge = json_encode($charge);
        
        $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Accept: application/json, text/plain, */*",
                    "Authorization: Bearer {$authstring}",
                    "Content-Type: application/json; charset=utf-8"
                ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $charge);
            curl_setopt($ch,CURLOPT_ENCODING , 'zip');
        $res = json_decode(json_encode(curl_exec($ch)), TRUE);
        curl_close($ch);
        curl_close($ch2);
        return json_decode(json_encode($res), true);
        
    }  //OK
    
    public function verifycard($cardData){
        $ambiente = '1snn5n9w';
        $sess_id = 'testes06808142645testes';
        $ch2 = curl_init('https://h.online-metrix.net/fp/tags.js?org_id='.$ambiente.'&session_id='.$sess_id);
        
        $url = 'https://api-sandbox.getnet.com.br';
        $path = '/v1/cards/verification';
        
        $authstring =  json_decode($this->tokendeacesso(), true);
        $auth = $authstring['access_token'];
        
        $tokencard = $this->tokencartao($auth, $cardData['card_number'], $cardData['customer_id']);
        $tokencard = (array)json_decode($tokencard);
        
        $auxiliar = array(
            'number_token'      => $tokencard['number_token'],
            'brand'             => $cardData['brand'],
            'cardholder_name'   => $cardData['cardholder_name'],
            'expiration_month'  => $cardData['expiration_month'],
            'expiration_year'   => $cardData['expiration_year'],
            'security_code'     => $cardData['security_code'],
            );
        $charge = json_encode($auxiliar);

        $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer {$auth}",
                    "Content-Type: application/json; charset=utf-8"
                ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $charge);
        $res = json_decode(json_encode(curl_exec($ch)), TRUE);
        curl_close($ch);
        curl_close($ch2);
        
        $retorno = array(
            'access_token'  => $auth,
            'card'          => $auxiliar,
            'num'           => json_decode(json_encode($res), true),
            );

        return $retorno;
    }
    
    public function credito(){
        $this->load->database();
        $this->load->model('crudparticipantes');
        $participante = $this->crudparticipantes->getPartId($this->input->post('id'));
        
        $ambiente = '1snn5n9w';
        $sess_id = 'testes06808142645testes';
        $ch2 = curl_init('https://h.online-metrix.net/fp/tags.js?org_id='.$ambiente.'&session_id='.$sess_id);

        $url = 'https://api-sandbox.getnet.com.br';
        $path = '/v1/payments/credit';
        
        $card = array(
                "brand"             => 'Mastercard',//$this->input->post('brand'),
                "cardholder_name"   => $participante['nome_participante'],
                "expiration_month"  => '12',//$this->input->post('mount'),
                "expiration_year"   => '29',//str_split($this->input->post('year'), "2"),
                "security_code"     => '123',//$this->input->post('cvv'),
                "card_number"       => '4012001037141112',//$this->input->post('cardnumber'),
                "customer_id"       => "customer_".$participante['cpf_participante'],
            );
        $res = $this->verifycard($card);
        
        $order = array(
                "order_id"      => "6d2e4380-d8a3-4ccb-9138-c289182818a3",
                "sales_tax"     => 0,
                "product_type"  => "digital_content",
                );

        $name = explode(" ", $participante['nome_participante']);
        
        $customer = array(
                "customer_id"       => $participante['id_participante'],
                "first_name"        => $name[0],
                "last_name"         => $name[count($name)-1],
                "name"              => $participante['nome_participante'],
                "email"             => $participante['email_participante'],
                "document_type"     => "CPF",
                "document_number"   => $participante['cpf_participante'],
                "phone_number"      => $participante['fone_participante'],
                "billing_address"   => array(
                            "street"        => $participante['endereco'],
                            "number"        => $participante['numero'],
                            "complement"    => "",
                            "district"      => $participante['bairro'],
                            "city"          => $participante['cidade'],
                            "state"         => $participante['uf'],
                            "country"       => $participante['nome_participante'],
                            "postal_code"   => $participante['cep_participante'],
                            ),
                );
        $shippings = array (
                "first_name"        => $name[0],
                "name"              => $participante['nome_participante'],
                "email"             => $participante['email_participante'],
                "phone_number"      => $participante['fone_participante'],
                "shipping_amount"   => 0,
                "address"           => array(
                            "street"        => $participante['endereco'],
                            "number"        => $participante['numero'],
                            "complement"    => "",
                            "district"      => $participante['bairro'],
                            "city"          => $participante['cidade'],
                            "state"         => $participante['uf'],
                            "country"       => $participante['nome_participante'],
                            "postal_code"   => $participante['cep_participante'],
                            ),
                );
        $sub_merchant = array(
                "identification_code"   => "9058344",
                "document_type"         => "CNPJ",
                "document_number"       => "20551625000159",
                "address"               => "Torre Negra 44",
                "city"                  => "Cidade",
                "state"                 => "RS",
                "postal_code"           => "90520000",
                );
        $credit = array(
                "delayed"               => false,
                "pre_authorization"     => false,
                "save_card_data"        => false,
                "transaction_type"      => "FULL",
                "number_installments"   => 1,
                "soft_descriptor"       => "LOJA*TESTE*COMPRA-123",
                "dynamic_mcc"           => 1799,
                "card"                  => $card,
                );

        $dados = array(
            "seller_id"     => "6fb3ee02-5bb4-42c2-95cc-d3c61d5cddf2",          
            "amount"        => 100,                                             
            "currency"      => "BRL",                                           
            "order"         => array(
                                "order_id"      => "6d2e4380-d8a3-4ccb-9138-c289182818a3",
                                "sales_tax"     => 0,
                                "product_type"  => "digital_content",
                                ),
            "customer"      => array(
                                "customer_id"       => $participante['id_participante'],
                                "first_name"        => $name[0],
                                "last_name"         => $name[count($name)-1],
                                "name"              => $participante['nome_participante'],
                                "email"             => $participante['email_participante'],
                                "document_type"     => "CPF",
                                "document_number"   => $participante['cpf_participante'],
                                "phone_number"      => $participante['fone_participante'],
                                "billing_address"   => array(
                                            "street"        => $participante['endereco'],
                                            "number"        => $participante['numero'],
                                            "complement"    => "",
                                            "district"      => $participante['bairro'],
                                            "city"          => $participante['cidade'],
                                            "state"         => $participante['uf'],
                                            "country"       => $participante['nome_participante'],
                                            "postal_code"   => $participante['cep_participante'],
                                            ),
                                ),
            "device"        => array( "ip_address" => $_SERVER['REMOTE_ADDR'], "device_id" => $sess_id, ),
            /*"shippings"     => array ( 
                                "first_name"        => $name[0],
                                "name"              => $participante['nome_participante'],
                                "email"             => $participante['email_participante'],
                                "phone_number"      => $participante['fone_participante'],
                                "shipping_amount"   => 0,
                                "address"           => array(
                                            "street"        => $participante['endereco'],
                                            "number"        => $participante['numero'],
                                            "complement"    => "",
                                            "district"      => $participante['bairro'],
                                            "city"          => $participante['cidade'],
                                            "state"         => $participante['uf'],
                                            "country"       => $participante['nome_participante'],
                                            "postal_code"   => $participante['cep_participante'],
                                            ),
                                ),*/
            "sub_merchant"  => array(
                                "identification_code"   => "9058344",
                                "document_type"         => "CNPJ",
                                "document_number"       => "20551625000159",
                                "address"               => "Torre Negra 44",
                                "city"                  => "Cidade",
                                "state"                 => "RS",
                                "postal_code"           => "90520000",
                                ),
            "credit"        => array(
                                "delayed"               => false,
                                "pre_authorization"     => false,
                                "save_card_data"        => false,
                                "transaction_type"      => "FULL",
                                "number_installments"   => 1,
                                "soft_descriptor"       => "LOJA*TESTE*COMPRA-123",
                                "dynamic_mcc"           => 1799,
                                "card"                  => array(
                                                        "brand"             => 'Mastercard',//$this->input->post('brand'),
                                                        "cardholder_name"   => $participante['nome_participante'],
                                                        "expiration_month"  => '12',//$this->input->post('mount'),
                                                        "expiration_year"   => '29',//str_split($this->input->post('year'), "2"),
                                                        "security_code"     => '123',//$this->input->post('cvv'),
                                                        //"card_number"       => '5155901222280001',//$this->input->post('cardnumber'),
                                                        //"customer_id"       => "customer_".$participante['cpf_participante'],
                                                        "number_token"      => $res['card']['number_token'],
                                                    ),
                                ),
            );
        
        $charge = json_encode($dados);
        $authstring = $res['access_token'];
        
        $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Accept: application/json, text/plain, /*",
                    "Authorization: Bearer {$authstring}",
                    "Content-Type: application/json; charset=utf-8"
                ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $charge);
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        $res = json_decode(json_encode(curl_exec($ch)), TRUE);
            curl_close($ch);
            curl_close($ch2);
        
        print_r((array)json_decode($res));            
                    
    }
    
    public function debitoreturn(){
        
    }
    
    public function boletoreturn(){
        
    }
}
