<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class PagamentosMP extends MY_Controller {

    public function acessMP($key){
        $this->load->database();
        $this->load->model('gestor');
        
        $mercado = $this->gestor->get('MercadoPago');
        
        if($key == 'pKey'){
            return $mercado['gestor_publickey'];
        }elseif($key == 'aToken'){
            return $mercado['gestor_acesstoken'];
        }elseif($key == 'clId'){
            return $mercado['gestor_clientid'];
        }elseif($key == 'clSecret'){
            return $mercado['gestor_clientsecret'];
        }
        
    }

    public function bolForms(){
        $acessToken = $this->acessMP('aToken');
        $url = "https://api.mercadopago.com/v1/payment_methods";
        
        $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $acessToken",
                ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
            curl_close($ch);

        $aux = json_decode($res, true);
        $j=0;
        for($i=0; $i<count($aux); $i++){
            if($aux[$i]['payment_type_id'] == 'ticket' && $aux[$i]['name'] != "Meliplaces"){
                $dados[$j] = array(
                    'id'            => $aux[$i]['id'],
                    'nome'          => $aux[$i]['name'],
                    'pagamentoTipo' => $aux[$i]['payment_type_id'],
                    'status'        => $aux[$i]['status'],
                    'iconeP'        => $aux[$i]['secure_thumbnail'],
                    'iconeG'        => $aux[$i]['thumbnail'],
                    'suporte'       => $aux[$i]['deferred_capture'],
                    'configuracao'  => $aux[$i]['settings'],
                    'addInfo'       => $aux[$i]['additional_info_needed'],
                    );
                $j++;
            }
        }
        
        return $dados;
        
    }

    public function payment(){
        $this->load->database();
        $this->load->model('mercadopagomodel');
        
        $footer = "<script src='https://sdk.mercadopago.com/js/v2'></script>";
        $header = "<script src='https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js'></script>";
        
        $cliente = $this->mercadopagomodel->retrieveClient($this->session->userdata('cliente_user_id'));
        $compra = $this->mercadopagomodel->retrieveCompra($this->session->userdata('finalcompra'));
        
        if(strlen($cliente['cliente_cpf']) == 11){
            $tipo = 'CPF';
        }else{
            $tipo = 'CNPJ';
        }

        
        $data = array(
            'pKey'          => $this->acessMP('pKey'),
            'total'         => $compra['valorCompra'] + $this->session->userdata('frete_valor'),
            'docTipo'       => $tipo,
            'docNumero'     => $cliente['cliente_cpf'],
            'emailCliente'  => strtolower($cliente['cliente_email']),
            );
        
        $this->header($header);
        $this->load->view('mercpago', $data);
        $this->footer($footer);
        
    }
    
    public function boleto(){
        $this->load->database();
        $this->load->model('mercadopagomodel');
        
        $footer = "<script src='https://sdk.mercadopago.com/js/v2'></script>";
        $header = "<script src='https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js'></script>";
        
        $cliente = $this->mercadopagomodel->retrieveClient($this->session->userdata('cliente_user_id'));
        $compra = $this->mercadopagomodel->retrieveCompra($this->session->userdata('finalcompra'));
        
        if(strlen($cliente['cliente_cpf']) == 11){
            $tipo = 'CPF';
        }else{
            $tipo = 'CNPJ';
        }
        
        $nome = explode(" ", $cliente['cliente_nome']);
        
        $data = array(
            'pKey'          => $this->acessMP('pKey'),
            'total'         => $compra['valorCompra'] + $this->session->userdata('frete_valor'),
            'docTipo'       => $tipo,
            'docNumero'     => $cliente['cliente_cpf'],
            'emailCliente'  => strtolower($cliente['cliente_email']),
            'nomeCliente'   => $nome[0],
            'familiaCliente'=> end($nome),
            'pagamento'     => $this->bolForms(),
        );
        
        $this->header($header);
        $this->load->view('mercBoleto', $data);
        $this->footer($footer);
        
    }
    
    public function processPayment(){
        $this->load->database();
        $this->load->model('mercadopagomodel');
        
        $loja = $this->mercadopagomodel->lojaDados();
        
        $acessToken = $this->acessMP('aToken');
        $url = "https://api.mercadopago.com/v1/payments";

        $token = $this->input->post('token');
        $parcelas = intval($this->input->post('installments'));
        
        if($parcelas == 0){
            $parcelas = 1;
        }
        
        $sale = array(
            "description" => "Venda de ".$loja['nome_empresa'],
            "external_reference" => (int)$this->session->userdata('finalcompra'),
            "installments" => $parcelas,
            "order" => array(
                "id" => (int)$this->acessMP('aToken'),
                "type" => "mercadopago",
            ),
            "payer" => array(
                "entity_type" => "individual",
                "type" => "customer",
                "email" => $this->input->post('email'),
                "identification" => array(
                    'type' => $this->input->post('docType'),
                    'number' => $this->input->post('docNumber'),
                    ),
            ),
            "payment_method_id" => $this->input->post('paymentMethodId'),
            "statement_descriptor" => mb_strtoupper($loja['nome_empresa']),
            "notification_url" => base_url('pagamentosMP/returnMP'),
            "transaction_amount" => floatval($this->input->post('transactionAmount')),
            
        );
        
        if($this->input->post('token')){
            $sale["token"] = $this->input->post('token');
            $sale["binary_mode"] = true;
        }
        
        if($this->input->post('payerFirstName') && $this->input->post('payerLastName')){
            $sale['payer']['first_name'] = $this->input->post('payerFirstName');
            $sale['payer']['last_name'] = $this->input->post('payerLastName');
        }else{
            $a = explode(" ", $this->session->userdata('cliente_nome'));
            $sale['payer']['first_name'] = $a[0];
            $sale['payer']['last_name'] = end($a);
        }

        $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Authorization: Bearer " . $acessToken,
                ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($sale));
        $res = curl_exec($ch);
            curl_close($ch);
    	$aux = $this->session->userdata('finalcompra');
    	$this->session->unset_userdata('finalcompra');
    	
    	
    	$this->updateSale($res, $aux);
    	$this->session->unset_userdata('quantidade_carrinho');
        redirect(base_url('pagamentosMP/verPedido/'.$aux));
    	
    }
    
    public function returnMP(){
        $this->updateSale($_POST);
    }
    
    public function updateSale($resources, $compra=null){
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->database();
        $this->load->model('mercadopagomodel');
        
        $result = json_decode($resources, true);

        $estado         = $result['status'];
        $detalhes       = $result['status_detail'];
        $dataAlteracao  = $result['date_last_updated'];
        $boletoExpira   = $result['date_of_expiration'];
        $boletoUrl      = $result['transaction_details']['external_resource_url'];
        $authCode       = $result['authorization_code'];
        $id             = $result['id'];
        
        if(array_key_exists('barcode', $result)){
            $codBarra = $result['barcode']['content'];
        }else{
            $codBarra = null;
        }

        if($estado == 'pending'){
            if($detalhes == 'pending_waiting_payment'){
                $statusCompra       = 1;
                $statusPagamento    = 16;
                $statusEnvio        = 12;
                $historico          = "Aguardando pagamento do boleto!";
            }
        }
        
        if($estado == 'approved'){
            if($detalhes == 'accredited'){
                $statusCompra       = 3;
                $statusPagamento    = 17;
                $statusEnvio        = 23;
                $historico          = "Pronto, seu pagamento foi aprovado!";
            }
        }
        
        if($estado == 'in_process'){
            if($detalhes == 'pending_contingency'){
                $statusCompra       = 1;
                $statusPagamento    = 16;
                $statusEnvio        = 12;
                $historico          = "Estamos processando o pagamento. Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado.";
            }
            if($detalhes == 'pending_review_manual'){
                $statusCompra       = 1;
                $statusPagamento    = 16;
                $statusEnvio        = 12;
                $historico          = "Estamos processando seu pagamento. Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado ou se necessitamos de mais informação.";
            }
        }
        
        if($estado == 'rejected'){
            if($detalhes == 'cc_rejected_bad_filled_card_number'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Revise o número do cartão.";
            }
            if($detalhes == 'cc_rejected_bad_filled_date'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Revise a data de vencimento.";
            }
            if($detalhes == 'cc_rejected_bad_filled_other'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Revise os dados do cartão ou tente com outro.";
            }
            if($detalhes == 'cc_rejected_bad_filled_security_code'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Revise o código de segurança do cartão.";
            }
            if($detalhes == 'cc_rejected_blacklist'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Não pudemos processar seu pagamento, tente novamente em algumas horas.";
            }
            if($detalhes == 'cc_rejected_call_for_authorize'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado pela operadora. Entre em contato com o gestor de seu cartão.";
            }
            if($detalhes == 'cc_rejected_card_disabled'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Entre em contato com o gestor de seu cartão.";
            }
            if($detalhes == 'cc_rejected_card_error'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Negado. Não conseguimos processar seu pagamento.";
            }
            if($detalhes == 'cc_rejected_duplicated_payment'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado pela operadora. Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.";
            }
            if($detalhes == 'cc_rejected_high_risk'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Seu pagamento foi recusado. Escolha outra forma de pagamento. Recomendamos meios de pagamento em boleto, pagamento em lotérica ou transferencia bancária.";
            }
            if($detalhes == 'cc_rejected_insufficient_amount'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. O cartão não possui saldo suficiente.";
            }
            if($detalhes == 'cc_rejected_invalid_installments'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Seu cartão não processa pagamentos parcelados.";
            }
            if($detalhes == 'cc_rejected_max_attempts'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado. Excedido o limite de tentativas permitido. Escolha outro cartão ou outra forma de pagamento.";
            }
            if($detalhes == 'cc_rejected_other_reason'){
                $statusCompra       = 24;
                $statusPagamento    = 19;
                $statusEnvio        = 25;
                $historico          = "Recusado pela operadora. Seu cartão não pode ser processado para esta compra.";
            }
        }
        
        $dados = array(
            'codTransacao'          => $id,
            'statusCompra'          => $statusCompra,
            'statusEnvio'           => $statusEnvio,
            'statusPagamento'       => $statusPagamento,
            'authorization_code'    => $authCode,
            'dataAlteracao'         => date('Y-m-d H:i:s', strtotime($dataAlteracao)),
            'boleto_url'            => $boletoUrl,
            'boleto_barcode'        => $codBarra,
            'boleto_expiration_date'=> $boletoExpira,
            'historico'             => $historico,
        );
        
        if($compra == null){
            
            $this->mercadopagomodel->updateHim($dados);
        }else{
            
            $this->mercadopagomodel->finishHim($dados, $compra);
        }

        
    }
    
    public function verPedido($id){
        $this->load->database();
        $this->load->model('comprasmodel');
        
        $data['pedido'] = $this->comprasmodel->pedido($id);
        
        
        if($data['pedido']['forma'] == 'boleto'){
            $this->header();
            $this->load->view('pagBranco', $data);
            $this->footer(); 
        } else {
            $this->header();
            $this->load->view('pedido', $data);
            $this->footer(); 
        }
    }

}