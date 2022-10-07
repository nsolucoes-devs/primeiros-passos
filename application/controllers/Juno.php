<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juno extends MY_Controller {

    public function acesso(){
        $clientId = 'ib54UQuhfnVmaQGW';
        $clientSecret = 'UA@akJ2GopG+cY18[-{u~r;5kzY|fjRd';
        $encode64 = base64_encode($clientId.":".$clientSecret);
        $url = 'https://sandbox.boletobancario.com';   //usar esta variavel durante o sandbox
        //$url = 'https://api.juno.com.br';            //usar esta variavel durante a produção
        $path = '/authorization-server/oauth/token';
        
        
        $this->load->database();
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('Pagjuno');
        $aux = $this->Pagjuno->recuperaJuno();
        
        $agora = strtotime(date("Y-m-d H:i:s"));
        $hora = "1901-01-01 00:00:00" ;
        
        if($aux != "" || $aux != null){
            $hora = strtotime($aux['juno_datahora']) + $aux['juno_expiresin'];
            $agora = strtotime(date("Y-m-d H:i:s"));
        }
        
        if($agora <= $hora){
            print_r($aux);
            /*
            Array ( 
            [juno_id] => 1 
            [juno_accesstoken] => eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJhbmRlcnNvbi5tb3JlaXJhLmJpb2FuYXNpc0BnbWFpbC5jb20iLCJzY29wZSI6WyJhbGwiXSw 
            [juno_tokentype] => bearer 
            [juno_expiresin] => 86399 
            [juno_scope] => all 
            [juno_username] => anderson.moreira.bioanasis@gmail.com 
            [juno_jti] => koNdBYMT8O68cAblZqPM48hslJQ 
            [juno_datahora] => 2021-03-12 08:03:29 )
            */
        }else{
            $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic {$encode64}"
            ]);
            $res = json_decode(curl_exec($ch), true);
            curl_close($ch);
            
            $dados = array(
                'juno_id'               => 1,
                'juno_accesstoken'      => $res['access_token'],
                'juno_tokentype'        => $res['token_type'],
                'juno_expiresin'        => $res['expires_in'],
                'juno_scope'            => $res['scope'],
                'juno_username'         => $res['user_name'],
                'juno_jti'              => $res['jti'],
                'juno_datahora'         => date('Y-m-d H:m:s'),
                );
            
            
            $this->Pagjuno->sessaoJuno($dados);
            print_r($dados);
        }
        
    }
    
    public function charge(){
        $this->load->database();
        $this->load->model('Pagjuno');
        $aux = $this->Pagjuno->recuperaJuno();
        
        $hora = strtotime($aux['juno_datahora']) + $aux['juno_expiresin'];
        $agora = strtotime(date("Y-m-d H:i:s"));
        
        if($agora > $hora){
            $this->acesso();
            $aux = $this->Pagjuno->recuperaJuno();    
        }
        
        $tokenprivado = '522024B8790F0DF09E07491FB9240A6A34E4E487236CE08372802E8C0FE87661';
        $tokenpublico = '27FC39775DF106ABAB05615E92BFEEFE7A4E7C300180EA9664FC95D01663EDD5';
        $tokenchave = $aux['juno_accesstoken'];
        
        $url = 'https://sandbox.boletobancario.com/api-integration';    // url do sandbox
        //$url = 'https://api.juno.com.br/api-integration';             // url da producao
        $path = '/charges';
        
        
        $paymentaccount = array(
                            "charge"=> array(
                                    "description" => "<description(len=400,max=4 lines)>",
                                    "references" => array("referencia"),
                                    "amount" => "20.00",
                                    "dueDate"=> date('Y-m-d'),
                                    "installments"=> "1",
                                    "maxOverdueDays"=> "0",
                                    "fine"=> "0.00",
                                    "interest"=> "0.00",
                                    "discountAmount"=> "0.05",
                                    "discountDays" => "0",
                                    "paymentAdvance" => false,
                                    "paymentTypes" => array( "BOLETO", "CREDIT_CARD"), 
                            ),
                            "billing"=> array(
                                    "name"=> "Teste Anderson",
                                    "document"=> "06808142645",
                                    "email"=> "sonxerdan@gmail.com",
                                    "secondaryEmail" => null,
                                    "phone"=> "34996895179",
                                    "birthDate"=> "1984-10-21",
                                    "notify"=> false,
                            ),
                        );
        $charge = json_encode($paymentaccount);

        $receivingaccount = array (
                "type"=> "RECEIVING",
                "name"=> "<name>",
                "document"=> "<CPF(len=11)|CNPJ(len=14)>",
                "email"=> "<email>",
                "birthDate"=> "<birthDate/format=YYYY-MM-DD/mandatory for individuals>",
                "phone"=> "<phone>",
                "businessArea"=> "<businessAreaId>",
                "companyType"=> "<companyType/mandatory for companies>",
                "tradingName"=> "<tradingName/optional>",
                "businessUrl"=> "<businessUrl>",
                
                "street"=> "<street/avenue/...>",
                "number"=> "<number>",
                "complement"=> "<complement/optional>",
                "neighborhood"=> "<neighborhood/optional>",
                "city"=> "<city>",
                "state"=> "<state>",
                "postCode"=> "<cep(len=8)>",
                
                "bankNumber"=> "<bankNumber>",
                "agencyNumber"=> "<agencyNumber>",
                "accountNumber"=> "<accountNumber>",
                "accountComplementNumber"=> "<accountComplementNumber>",
                "accountType"=> "CHECKING|SAVINGS",
            );

        $ch = curl_init($url.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                                    "Authorization: Bearer {$tokenchave}",
                                                    "X-API-Version: 2",
                                                    "X-Resource-Token: {$tokenprivado}",
                                                    "Content-Type: application/json",
                                                ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $charge);
        $res = json_decode(json_encode(curl_exec($ch)), TRUE);
        curl_close($ch);
        
        print_r($res);
        //print_r("<br>");
        //print_r($paymentaccount);
    }
}