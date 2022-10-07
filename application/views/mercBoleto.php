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
            background: v;
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
            
            <div class="col-md-6 offset-md-3 col-12">
                <div class="col-md-12 col-12 backcolor">
                    <div class="custom-card">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <a class="gui" href="<?php echo base_url('finalizaUnico/retornarCompra') ?>"><i class="botao-voltar fa fa-chevron-left" aria-hidden="true"><span style="font-size: 14px;font-family: 'Open Sans';"> Voltar</span></i></a>
                            </div>
                        </div>
                        <form action="<?php echo base_url('pagamentosMP/processPayment');?>" method="post" id="paymentForm">
                            <h4 style="color: #424242">Forma de Pagamento - BOLETO</h4>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="hidden" id="paymentMethodId" name="paymentMethodId" value="bolbradesco">
                                    
                                    <!--
                                    <select class="form-control" id="paymentMethodId" name="paymentMethodId">
                                        <option>Selecione uma forma de pagamento</option>
                                        <?php foreach($pagamento as $pgm){?>
                                            <option value="<?php echo $pgm['id'];?>">--<?php echo $pgm['nome'];?>--</option>
                                        <?php } ?>
                                    </select>
                                    -->
                                    
                                </div>
                            </div>
                            
                            <h4 style="color: #424242">Informações do Boleto</h4>
                            <div class="row">
                                <div class="col-md-12 form-group text-center">
                                    <label><b style="color: #464646">Mesmo dados do cadastro de cliente?</b></label><br>
                                    <div class="form-check-inline">
                                      <label class="form-check-label">
                                        <input style="color: #464646; height: 16px; width: 16px;" type="radio" class="form-check-input" name="optradio" onclick="clienteCadastro()">Sim
                                      </label>
                                    </div>
                                    <div class="form-check-inline">
                                      <label class="form-check-label">
                                        <input style="height: 16px; width: 16px;" type="radio" class="form-check-input" name="optradio" onclick="DadosCliente()">Não
                                      </label>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            
                            <div id="dadosBoleto" class="row" style="display:none">
                                <div class="col-md-6 form-group">
                                    <label for="payerFirstName"><b style="color: #464646">Nome:</b></label>
                                    <input class="form-control" id="payerFirstName" name="payerFirstName" type="text"></select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="payerLastName"><b style="color: #464646">Sobrenome:</b></label>
                                    <input class="form-control" id="payerLastName" name="payerLastName" type="text"></select>
                                </div>
                                <div class="col-md-8 form-group">
                                    <label for="payerEmail"><b style="color: #464646">E-mail:</b></label>
                                    <input class="form-control" id="payerEmail" name="email" type="text"></select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="docType"><b style="color: #464646">Tipo de documento:</b></label>
                                    <select class="form-control" id="docType" name="docType" data-checkout="docType" type="text"></select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="docNumber"><b style="color: #464646">Número do documento:</b></label>
                                    <input class="form-control" id="docNumber" name="docNumber" data-checkout="docNumber" type="text"/>
                                </div>
                            </div>
                              
                            <div>
                                <div id="dados">
                                    <input type="hidden" name="transactionAmount" id="transactionAmount" value="<?php echo $total;?>" />
                                    <input type="hidden" name="productDescription" id="productDescription" value="Venda por Boleto" />
                                    <br>
                                    <button id="submitButton" class="btn btn-primary btn-block" type="submit" disabled>Pagar</button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</section>

<script>
    window.Mercadopago.setPublishableKey("<?php echo $pKey;?>");
    
    window.Mercadopago.getIdentificationTypes();
    
    function createSelectOptions(elem, options, labelsAndKeys = { label : "name", value : "id"}){
        const {label, value} = labelsAndKeys;
        
        elem.options.length = 0;
        
        const tempOptions = document.createDocumentFragment();
        
        options.forEach( option => {
            const optValue = option[value];
            const optLabel = option[label];
            
            const opt = document.createElement('option');
            opt.value = optValue;
            opt.textContent = optLabel;
            
            tempOptions.appendChild(opt);
        });
        
        elem.appendChild(tempOptions);
    }
    
</script>

<script>
    function DadosCliente(){
        document.getElementById('dadosBoleto').style.display = "flex"
        document.getElementById('submitButton').disabled = false;
    }
    function clienteCadastro(){
        
        document.getElementById('dadosBoleto').style.display = "none"
    
        var form = document.getElementById("paymentForm");
        
        var element1 = document.createElement("input"); 
        element1.value = '<?php echo $docTipo;?>';
        element1.name = "docType";
        element1.type = "hidden";
        form.appendChild(element1); 
        
        var element2 = document.createElement("input");  
        element2.value = '<?php echo $docNumero;?>';
        element2.name = "docNumber";
        element2.type = "hidden";
        form.appendChild(element2);
        
        var element3 = document.createElement("input");  
        element3.value = '<?php echo $nomeCliente;?>';
        element3.name = "payerFirstName";
        element3.type = "hidden";
        form.appendChild(element3);
        
        var element4 = document.createElement("input");  
        element4.value = '<?php echo $familiaCliente;?>';
        element4.name = "payerLastName";
        element4.type = "hidden";
        form.appendChild(element4);
        
        var element5 = document.createElement("input");  
        element5.value = '<?php echo $emailCliente;?>';
        element5.name = "email";
        element5.type = "hidden";
        form.appendChild(element5);
        
        document.getElementById('submitButton').disabled = false;

    }
</script>