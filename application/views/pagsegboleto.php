<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Checkout Transparente PagSeguro</title>
	<script type="text/javascript"></script>
</head>
<?php $session = $this->session->userdata('pagsession'); ?>
<body>
	<form action="<?php echo base_url('93516455561e3a5a18a837062e89eda3'); ?>" method="post">
    	<div>
    	    <input class="form-control" type="hidden" id="senderHash" class="creditcard" name="senderHash">
    	    <input class="form-control" type="hidden" id="sessionId" class="creditcard" name="sessionId" value="<?php echo $session; ?>">
    	</div>
    	<br>
    	<br>
    	<legend class="text-center">BOLETO</legend>
    	<div class="row mx-md-n5">
      	    <div class="col px-md-5">
                <br>
                <button type="submit" class="btn btn-info" >GERAR BOLETO</button>
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