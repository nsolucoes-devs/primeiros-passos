    <?php
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile = 1;
        } else {
            $mobile = 0;
        }
    ?>
    
    <style>
        .custom-card{
            width: calc(100% - 20px);
            border-radius: 10px;
            background-color: white;
            margin: 4px 4px 0 4px;
            box-shadow: 5px 6px 10px -9px #000000;
            padding: 15px;
            min-height: 200px;
            border: 1px solid #e8e8e8;
        }
        .main-section{
            padding: 25px 20px 0px 20px;
            background: #f9fdff;
        }
        
        .backcolor{
            background: #f9fdff;
            background-color: #f9fdff;
        }
        
        .gui {
        	 list-style: none;
        	 margin: 0 auto;
        	 padding-right: 30px;
        	 display: inline-block;
        	 position: relative;
        	 text-decoration: none;
        	 text-align: center;
        	 font-family: "Oswald",sans-serif;
        }
    
        @media(max-width: 500px){
            .main-section{
                padding: 15px 20px 0px 20px;
                background: #f9fdff;
            }
        }
    </style>

      <section class="contact-section main-section">
        <div class="container-fluid">
            <div class="row row-eq-height">
                
                <div class="col-md-12" style="margin: 0; padding: 0;">
                    <div class="col-md-12 backcolor" style="margin: 0; padding: 0;">
                        <div class="custom-card">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <a class="gui" href="<?php echo base_url('finalizaUnico/retornarCompra') ?>"><i class="botao-voltar fa fa-chevron-left" aria-hidden="true"><span style="font-size: 14px;font-family: 'Open Sans';"> Voltar</span></i></a>
                                </div>
                            </div>
                            
                            <form action="<?php echo base_url('pagamentosMP/processPayment');?>" method="post" id="paymentForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="email" name="email" type="hidden" value="<?php echo $emailCliente; ?>"/>
                                        <input id="docType" name="docType" data-checkout="docType" type="hidden" value="<?php echo $docTipo; ?>">
                                        <input id="docNumber" name="docNumber" data-checkout="docNumber" type="hidden" value="<?php echo $docNumero; ?>"/>
                                        <h4 style="color: #424242">Detalhes do cartão</h4>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="cardholderName"><b style="color: #464646">Titular do cartão:</b></label>
                                                <input id="cardholderName" class="form-control" data-checkout="cardholderName" type="text">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for=""><b style="color: #464646">Data de vencimento:</b></label>
                                                    </div>
                                                    <?php if($mobile == 0){ ?>
                                                    <div class="col-md-7">
                                                        <label for="cardNumber"><b style="color: #464646">Número do cartão:</b></label>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-2 col-4 form-group">
                                                        <input type="text" maxlength="2" class="form-control" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                                        onselectstart="return false" onpaste="return false"
                                                        oncopy="return false" oncut="return false"
                                                        ondrag="return false" ondrop="return false" autocomplete=off>
                                                    </div>
                                                    <div class="col-md-1 col-1 form-group">
                                                        <span style="color: grey;font-size: 25px;" class="date-separator">/</span>
                                                    </div>
                                                    <div class="col-md-2 col-6 form-group">
                                                        <input type="text" maxlength="2" class="form-control" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                                        onselectstart="return false" onpaste="return false"
                                                        oncopy="return false" oncut="return false"
                                                        ondrag="return false" ondrop="return false" autocomplete=off>
                                                    </div>
                                                    
                                                    <?php if($mobile == 1){ ?>
                                                    <div class="col-md-7">
                                                        <label for="cardNumber"><b style="color: #464646">Número do cartão:</b></label>
                                                    </div>
                                                    <?php } ?>
                                                    
                                                    <div class="col-md-7 form-group">
                                                        
                                                        <input type="text" id="cardNumber" class="form-control" data-checkout="cardNumber"
                                                        onselectstart="return false" onpaste="return false"
                                                        oncopy="return false" oncut="return false"
                                                        ondrag="return false" ondrop="return false" autocomplete=off>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="col-md-2 form-group">
                                                <label for="securityCode"><b style="color: #464646">CVC:</b></label>
                                                <input id="securityCode" class="form-control" data-checkout="securityCode" type="text"
                                                onselectstart="return false" onpaste="return false"
                                                oncopy="return false" oncut="return false"
                                                ondrag="return false" ondrop="return false" autocomplete=off>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div id="issuerInput">
                                                    <label for="issuer"><b style="color: #464646">Banco emissor:</b></label>
                                                    <select id="issuer" class="form-control" name="issuer" data-checkout="issuer"></select>
                                                </div>
                                           </div>
                                           <div class="col-md-4 form-group">
                                                <label for="installments"><b style="color: #464646">Parcelas:</b></label>
                                                <select type="text" class="form-control" id="installments" name="installments"></select>
                                           </div>
                                           <div class="col-md-12 form-group">
                                                <input type="hidden" name="transactionAmount" id="transactionAmount" value="<?php echo $total; ?>" />
                                                <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                                                <input type="hidden" name="description" id="description" />
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-block">Pagar</button>
                                                <br>
                                           </div>
                                       </div>
                                    </div>
                                    <?php if($mobile == 0){ ?>
                                    <div class="col-md-6 col-0" style="position: absolute; right: -10%;top: 30%;">
                                        <div class="col-md-7 pt-28 some" style="float: left">
                                            <div class='card-wrapper' id="credWrapper"></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </section>
    
    <?php if(isset($plugin)){ ?>
        <?php echo $plugin;?>
    <?php } ?>
    
    <script src="<?php echo base_url('assets/lib/card-master/dist/card.js') ?>"></script>
    <script src="<?php echo base_url('assets/lib/card-master/dist/jquery.card.js') ?>"></script>
    
    <script>
            var card = new Card({
                form: '#paymentForm',
                container: '#credWrapper',
                placeholders: {
                    number: '**** **** **** ****',
                    name: 'Títular',
                    expiry: '**/****',
                    cvc: '***'
                },
                
                width: 500, // optional — default 350px
                
                formSelectors: {
                    numberInput: 'input[id="cardNumber"]',
                    expiryInput: 'input[id="cardExpirationMonth"], input[id="cardExpirationYear"]',
                    cvcInput: 'input[id="securityCode"]',
                    nameInput: 'input[id="cardholderName"]',
                },
                
                formatting: false, // optional - default true

            });
        </script>
    
    <script>
        window.Mercadopago.setPublishableKey('<?php echo $pKey;?>');
        
        window.Mercadopago.getIdentificationTypes();
        
        document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);
        
        function guessPaymentMethod(event) {
            let cardnumber = document.getElementById("cardNumber").value;
            if (cardnumber.length >= 6) {
                let bin = cardnumber.substring(0,6);
                window.Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethod);
            }
        };
        
        function setPaymentMethod(status, response) {
            if (status == 200) {
                let paymentMethod = response[0];
                document.getElementById('paymentMethodId').value = paymentMethod.id;
                
                getIssuers(paymentMethod.id);
            }else {
                alert(`payment method info error: ${response}`);
            }
        }
        
        function getIssuers(paymentMethodId) {
            window.Mercadopago.getIssuers(
                paymentMethodId,
                setIssuers
            );
        }
            
        function setIssuers(status, response) {
            if (status == 200) {
                let issuerSelect = document.getElementById('issuer');
                response.forEach( issuer => {
                    let opt = document.createElement('option');
                    opt.text = issuer.name;
                    opt.value = issuer.id;
                    issuerSelect.appendChild(opt);
                });
                getInstallments(
                    document.getElementById('paymentMethodId').value,
                    document.getElementById('transactionAmount').value,
                    issuerSelect.value
                );
            }else {
                alert(`issuers method info error: ${response}`);
            }
        }
        
        function getInstallments(paymentMethodId, transactionAmount, issuerId){
            window.Mercadopago.getInstallments({
                "payment_method_id": paymentMethodId,
                "amount": parseFloat(transactionAmount),
                "issuer_id": parseInt(issuerId)
            }, setInstallments);
        }
        
        function setInstallments(status, response){
            if (status == 200) {
                document.getElementById('installments').options.length = 0;
                response[0].payer_costs.forEach( payerCost => {
                let opt = document.createElement('option');
                opt.text = payerCost.recommended_message;
                opt.value = payerCost.installments;
                document.getElementById('installments').appendChild(opt);
                });
            }else {
                alert(`installments method info error: ${response}`);
            }
        }

        doSubmit = false;
        document.getElementById('paymentForm').addEventListener('submit', getCardToken);
        function getCardToken(event){
            event.preventDefault();
            if(!doSubmit){
                let $form = document.getElementById('paymentForm');
                window.Mercadopago.createToken($form, setCardTokenAndPay);
                return false;
            }
        };
        
        function setCardTokenAndPay(status, response) {
           if (status == 200 || status == 201) {
                let form = document.getElementById('paymentForm');
                let card = document.createElement('input');
                card.setAttribute('name', 'token');
                card.setAttribute('type', 'hidden');
                card.setAttribute('value', response.id);
                form.appendChild(card);
                doSubmit=true;
                form.submit();
            }else {
                alert("Verify filled data!\n"+JSON.stringify(response, null, 4));
            }
        };
        
    </script>
