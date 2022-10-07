<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Checkout Transparente PagSeguro</title>
	<script type="text/javascript"></script>
</head>
<?php $session = $this->session->userdata('pagsession'); ?>
<body>
	<form action="<?php echo base_url('d06c138197af9ef4eb637c1a544fd50a'); ?>" method="post">
    	<div>
    	    <input class="form-control" type="hidden" id="senderHash" class="creditcard" name="senderHash">
    	    <input class="form-control" type="hidden" id="sessionId" class="creditcard" name="sessionId" value="<?php echo $session; ?>">
    	</div>
    	<br>
    	<br>
    	<legend class="text-center">CHAMADAS PARA CARTÃO DE CRÉDITO</legend>
    	<div class="row mx-md-n5">
      	    <div class="col px-md-5">
      	        <div class="p-3 border bg-light">
    	            <div class="row">
    		            <div class="col-sm-4"> 
    		                <div>
    		                    <label for="creditCardNumber"<b>Número do cartão:</b></label> 
    		                    <input type="text" class="form-control" id="creditCardNumber" class="creditcard" name="creditCardNumber">
    		                </div>
                        </div>
                        <div class="col-sm-4">
    		                <label for="creditCardExpMonth"<b>Validade Mês (mm):</b></label>
    		                <input type="text" class="form-control" id="creditCardExpMonth" class="creditcard" name="creditCardExpMonth" size="2"> &nbsp;
                            <label for="creditCardExpYear"<b>Ano (yyyy):</b></label>
                            <input type="text" class="form-control" id="creditCardExpYear" class="creditcard" name="creditCardExpYear" size="4">
    		            </div>
                        <div class="col-sm-4">
                            <label for="creditCardCvv"<b>CVV:</b></label>
                            <input type="text" class="form-control" id="creditCardCvv" class="creditcard" name="creditCardCvv">
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-info" >Enviar</button>
    	    </div>
        </div>
    	<br>
    	<br>
    </form>
</body>

<!-- Incluíndo o arquivo JS do PagSeguro e o JQuery-->
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Funcionalidade do JS -->
<script type="text/javascript">
    $(document).ready(function(){
        generateSenderHash();
    });
	
	//Get SenderHash
	function generateSenderHash(){
		PagSeguroDirectPayment.onSenderHashReady(function(response){
            if(response.status == 'error') {
                console.log(response.message);
                return false;
            }
	//Hash estará disponível nesta variável.
	    $("#senderHash").val(response.senderHash);	
        });
	}

    //Get CreditCard Brand and check if is Internationl
	$("#creditCardNumber").keyup(function(){
		if ($("#creditCardNumber").val().length >= 6) {
			PagSeguroDirectPayment.getBrand({
				cardBin: $("#creditCardNumber").val().substring(0,6),
				success: function(response) { 
						console.log(response);
						$("#creditCardBrand").val(response['brand']['name']);
						$("#creditCardCvv").attr('size', response['brand']['cvvSize']);
				},
				error: function(response) {
					console.log(response);
				}
			})
		};
	})
</script>

</html>