<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $mobile_view = 1;
    } else {
        $mobile_view = 0;
    }
?>


<style>
    body{
        background-color: #212121!important;
    }
    
    button{
        margin: 0;
        display: inline-block;
        padding: 25px 40px;
        background: #da00d3;
        border: 1px solid #da00d3;
        border-radius: 4px;
        font-size: 17px;
        font-weight: normal;
        font-family: "Titillium Web", Helvetica, Arial, sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        text-align: center;
        letter-spacing: 1px;
        vertical-align: middle;
        line-height: 13px;
        color: white;
        -webkit-transition: opacity cubic-bezier(0.23, 1, 0.32, 1) 0.28s;
        transition: opacity cubic-bezier(0.23, 1, 0.32, 1) 0.28s;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    button:hover, button:hover b{
        background-color: white;
        border-color: #fb25af;
        color: #fb25af!important;
    }
    
    button:active{
        background: none;
        color: #92c83e;
        margin-top: 1px;
    }
    
    button:focus{
        box-shadow: none;
    }
    
    backcolor{
        background-color: #13131399;
        scroll-behavior: inherit;
    }
    
    .custom-card{
        width: calc(100% - 8px);
        border-radius: 10px;
        background-color: white;
        margin: 4px 4px 0 4px;
        box-shadow: 5px 6px 10px -9px #000000;
        padding: 15px;
        min-height: 200px;
        border: 1px solid #e8e8e8;
    }
</style>


<?php if($mobile_view == 0){ ?>
<div class="row" style="width: 100%!important">
    <div class="col-md-3"></div>
    <div class="col-md-6 form-group text-center" style="margin-bottom: 24%; margin-top: 10%;">
        <div class="custom-card">
            <button style="margin-top: 7%; "><i style="font-size: 30px;" class="fa fa-usd" aria-hidden="true"></i> <b style="color: #dcb05a;">Realizar Pagamento</b></button>
            <p style="font-size: 11px;"><b style="color: black;">Clique para realizar o pagamento</b></p>
            <div class="col-md-12 text-right">
                <a href="<?php echo base_url('finalizaUnico/retornarCompra'); ?>"><span style="text-decoration: underline; text-align: right!important; cursor: pointer; color: red;">Voltar a compras</span></a>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php } else { ?>
<div class="row" style="width: 100%!important">
    <div class="col-md-3"></div>
    <div class="col-md-6 form-group text-center" style="margin-bottom: 24%; margin-top: 30%;">
        <div class="custom-card" style="margin: 20px!important">
            <button style="margin-top: 7%; padding: 20px 25px!important; "><i style="font-size: 30px;" class="fa fa-usd" aria-hidden="true"></i> <b style="color: white!important;">Realizar Pagamento</b></button>
            <p style="font-size: 11px;"><b style="color: black;">Clique para realizar o pagamento</b></p>
            <div class="col-md-12 text-right">
                <a href="<?php echo base_url('finalizaUnico/retornarCompra'); ?>"><span style="text-decoration: underline; text-align: right; cursor: pointer; color: red;">Voltar a compras</span></a>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php } ?>



<script src="https://assets.pagar.me/checkout/1.1.0/checkout.js"></script>
<script>
    function apagar(){
        window.parent.document.getElementById('loader').style.backgroundColor = "#000000bd";
        window.parent.document.getElementById('loader').style.zIndex  = "10";
        window.parent.document.getElementById('loader').style.height = "100%";
        window.parent.document.getElementById('loader').style.width = "100%";
        window.parent.document.getElementById('loader').style.position = "absolute";
        //window.parent.document.getElementById('div-pagamento').style.backgroundColor = "#000000bd";
        //window.parent.document.getElementById('div-pagamento').style.zIndex  = "11";
    }
    function libera(){
        window.parent.document.getElementById('loader').style.zIndex  = "1";
        window.parent.document.getElementById('loader').style.height = "0";
        window.parent.document.getElementById('loader').style.width = "0";
        window.parent.document.getElementById('loader').style.position = "unset";
        //window.parent.document.getElementById('div-pagamento').style.backgroundColor = "#fbf7ef";
        //window.parent.document.getElementById('div-pagamento').style.zIndex  = "1";
    }
    
    
    var button = document.querySelector('button')
    
    button.addEventListener('click', function() {
        apagar();
        
        function handleSuccess (data) {
            console.log(data);
            var token = data['token'];
            var method = data['payment_method']; 
            libera();
            location.replace("<?php echo base_url();?>pagamentoSTN/capturaPGM/?token="+token+"&payment_method="+method+"&amount="+<?php echo $compra['amount'];?>);
        }
    
        function handleError (data) {
            console.log(data);
            libera();
            
        }
        
        function handleClose (data) {
            libera();
        }
        
        var checkout = new PagarMeCheckout.Checkout({
            encryption_key: '<?php echo $crypto;?>',
            success: handleSuccess,
            error: handleError,
            close: handleClose,
        });

        checkout.open({
            amount: <?php echo $compra['amount'];?>,
            createToken: '<?php echo $compra['createToken'];?>',
            paymentMethods: '<?php echo $compra['paymentMethods'];?>',
            customerData: <?php echo $compra['customerData'];?>,
            customer: {
                external_id: '<?php echo $compra['customer.external_id'];?>',
                name: '<?php echo $compra['customer.name'];?>',
                type: '<?php echo $compra['customer.type'];?>',
                country: '<?php echo $compra['customer.country'];?>',
                email: '<?php echo $compra['customer.email'];?>',
                documents: [
                    {
                        type: '<?php echo $compra['customer.documents.type'];?>',
                        number: '<?php echo $compra['customer.documents.number'];?>',
                    },
                ],
                phone_numbers: <?php echo $compra['customer.phone_numbers'];?>,
                birthday: '<?php echo $compra['customer.birthday'];?>',
            },
            billing: {
                name: '<?php echo $cobranca['billing.name'];?>',
                address: {
                    country: '<?php echo $cobranca['billing.address.country'];?>',
                    state: '<?php echo $cobranca['billing.address.state'];?>',
                    city: '<?php echo $cobranca['billing.address.city'];?>',
                    neighborhood: '<?php echo $cobranca['billing.address.neighborhood'];?>',
                    street: '<?php echo $cobranca['billing.address.street'];?>',
                    street_number: '<?php echo $cobranca['billing.address.street_number'];?>',
                    zipcode: '<?php echo $cobranca['billing.address.zipcode'];?>',
                    complementary: '<?php echo $cobranca['billing.address.complementary'];?>',
                }
            },
            shipping: {
                name: '<?php echo $envio['shipping.name'];?>',
                fee: <?php echo $envio['shipping.fee'];?>,
                expedited: <?php echo $envio['shipping.expedited'];?>,
                address: {
                    country: '<?php echo $envio['shipping.address.country'];?>',
                    state: '<?php echo $envio['shipping.address.state'];?>',
                    city: '<?php echo $envio['shipping.address.city'];?>',
                    neighborhood: '<?php echo $envio['shipping.address.neighborhood'];?>',
                    street: '<?php echo $envio['shipping.address.street'];?>',
                    street_number: '<?php echo $envio['shipping.address.street_number'];?>',
                    zipcode: '<?php echo $envio['shipping.address.zipcode'];?>',
                    complementary: '<?php echo $envio['shipping.address.complementary'];?>',
                }
            },
            items: [
                <?php foreach($produto as $pdt){?> 
                {
                    id: '<?php echo $produto['item.id'];?>',
                    title: '<?php echo $produto['item.title'];?>',
                    unit_price: <?php echo $produto['item.unit_price'];?>,
                    quantity: <?php echo $produto['item.quantity'];?>,
                    tangible: <?php echo $produto['item.tangible'];?>
                },
                <?php }?>
            ],
            postback_url: '<?php echo $compra['postback_url'];?>', 
            
        })
    });
</script>