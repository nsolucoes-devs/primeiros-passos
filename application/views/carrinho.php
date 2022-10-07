    <?php
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile = true;
        } else {
            $mobile = false;
        }
    ?>
    
    <style>
        .btn::before {
            background: var(--base-color);
        }
        .marrom-padrao {
            color: saddlebrown;
        }
        .search-btn{
            height: 30px;
            display: inline;
            margin-left: -5px;
            border: 1px solid black;
            background-color: var(--base-color);
        }
        .btn-plus{
            height: 30px;
            display: inline;
            border: 1px solid var(--base-color);
            background-color: var(--base-color);
            cursor: pointer;
        }
        .btn-minus{
            height: 30px;
            display: inline;
            border: 1px solid var(--base-color);
            background-color: var(--base-color);
            cursor: pointer;
        }
        .btn-times{
            height: 30px;
            display: inline;
            border-color: transparent;
            border: 0;
            background-color: transparent;
            cursor: pointer;
            margin-left: -4px;
        }
        .btn-times em{
            color: red;
            font-size: 20px;
        }
        .qtd-input{
            width: 44px;
            text-align: center;
        }
        .left-btn{
            margin-right: -5px;
            display: inline;
        }
        .center-input{
            display: inline;
        }
        .right-btn{
            margin-left: -4px;
            display: inline;
        }
        
        <?php if($mobile){ ?>
        .col-xs-6{
            width: 50%;
            max-width: 50%;
            flex: 0 0 50%;
            float: left;
            padding: 0 15px;
        }
        <?php } ?>
    </style>

    <section class="contact-section" style="padding-top: 100px">
        <div class="container">
            <div class="row">
                
                <?php if(!$mobile){ ?>
                <div class="col-md-9">
                    <h4 style="color: black">MEU CARRINHO</h4>
                    <table class="table">
                        <thead>
                            <tr style="background-color: var(--base-color);">
                                <th style="width: 7%; color: black;" scope="col"></th>
                                <th style="width: 33%; color: black;" class="text-center" scope="col">Produto</th>
                                <th style="width: 10%; color: black;" class="text-center" scope="col">Modelo</th>
                                <th style="width: 10%; color: black;" class="text-center" scope="col">Preço(Un)</th>
                                <th style="width: 20%; color: black;" class="text-center" scope="col">Qtd</th>
                                <th style="width: 10%; color: black;" class="text-center" scope="col">Preço(Total)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sum=0; $aux=1; foreach($listacarrinho as $lst){?>
                            <tr class="produto" id="produto_<?php echo $aux;?>">
                                <td>
                                    <img class="d-block" width="100%"  src="<?php echo base_url('imagens/produtos/'.$lst['idProduto'].'.png'); ?>" >
                                </td>
                                <td><?php echo $lst['produto']; ?></td>
                                <td class="text-center"><?php echo $lst['modelo']; ?></td>
                                <td class="text-center">R$<?php echo str_replace(".", ",", $lst['valor']); ?></td>
                                <td class="text-center">
                                    <div class="left-btn">
                                        <button type="button" class="btn-minus" onclick="subtrai(<?php echo $aux; ?>)"><em class="fa fa-minus"></em></button>
                                    </div>
                                    <div class="center-input">
                                        <input type="text" min="1" max="99" class="qtd-input" id="qtd_<?php echo $aux; ?>" name="qtd_<?php echo $aux; ?>" value="<?php echo $lst['quantidade'] ?>" onchange="mudaValor(<?php echo $aux; ?>)">
                                        <input type="hidden" id="produtoId_<?php echo $aux;?>" name="produtoId_<?php echo $aux;?>" value="<?php echo $lst['idProduto']; ?>">
                                        <input type="hidden" id="value_<?php echo $aux;?>" name="value_<?php echo $aux;?>" value="<?php echo $lst['valor']; ?>">
                                    </div>
                                    
                                    <div class="right-btn">
                                        <button type="button" class="btn-plus" onclick="soma(<?php echo $aux; ?>)"><em class="fa fa-plus"></em></button>
                                        <button type="button" class="btn-times" onclick="remove(<?php echo $aux; ?>)"><em class="fa fa-times"></em></button>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div id="soma_<?php echo $aux;?>">R$<?php $helper = $lst['valor']*$lst['quantidade']; echo number_format($helper, 2); $sum += $helper;  ?></div>
                                </td>
                            </tr>
                            <?php $aux++; }?>
                        </tbody>
                    </table>
                    <?php if(isset($vazio)){ echo "Carrinho vazio!";}?>
                </div>    
                <?php }else{
                    $sum = 0; 
                    foreach($listacarrinho as $lst){
                        $helper = $lst['valor'] * $lst['quantidade']; 
                        $sum += $helper;
                    }
                } ?>
                
                <div class="col-md-3">
                    <div class="col-md-12 text-center">
                        <h4 style="color: black">DETALHES PEDIDO</h4>
                    </div>
                    
                    <hr style="height: 1px; border-color: lightgrey; margin-top:0; margin-bottom: 15px">
                    
                    <div class="row">
                        <div class="col-md-12 text-center" style="font-weight: bold; font-size: 18px">
                            <span id="qtd_produto">Produtos: </span>R$<span id="sub_total"><?php echo number_format($sum, 2, ",", "."); ?></span>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-weight: bold">Frete:</span>&nbsp;&nbsp;
                            <input type="text" id="cep" name="cep" style="width: 140px; display: inline" required>
                            <button type="button" id="cep-search" class="search-btn" onclick="search()"><em class="fa fa-search"></em></button>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="row" id="tabela_frete" style="display: none">
                        <div class="col-md-12">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Prazo</th>
                                    </tr>
                                </thead>
                                <tbody id="frete_formas">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--
                    <hr style="border: 1px solid lightgrey">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-size: 12px"><b>Cupom de Desconto:</b></label>
                            <input type="text" class="form-control" placeholder="Digite aqui seu cupom">
                        </div>
                    </div>
                    -->
                    <hr style="height: 1px; border-color: lightgrey; margin-top: 15px; margin-bottom: 15px">
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 style="color: black; display: inline">TOTAL: </h3>
                            <h3 style="display: inline">R$ <span id="total"><?php echo number_format($sum, 2, ",", "."); ?></span></h3>
                            <input type="hidden" name="total_compra" id="hidden_total" value="<?php echo $sum; ?>">
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-12 col-xs-6">
                            <button style="padding: 20px; font-size: 18px; border-radius: 3px; color: white; background-color: var(--base-color); border: 0" class="btn btn-primary btn-block"><i style="font-size: 20px" class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                        </div>
                        <div class="col-md-12 col-xs-6" <?php if(!$mobile){echo "style='margin-top: 20px'";} ?>>
                            <button onclick="finaliza()" style="padding: 20px; font-size: 18px; border-radius: 3px; color: white; background-color: var(--base-color); border: 0" class="btn btn-primary btn-block"><i style="font-size: 20px" class="fa fa-check" aria-hidden="true"></i> Finalizar</button>
                        </div>
                    </div>
                </div>
                
                <?php if($mobile){ ?>
                <div class="col-md-12">
                    <style>
                        .mobile-thead, .mobile-thead tr, .mobile-thead tr th{
                            background-color: white;
                            border: 0;
                            height: 1px;
                        }
                        .c100{
                            width: 100%;
                            max-width: 100%;
                            flex: 0 0 100%;
                            float: left;
                        }
                        .c80{
                            width: 80%;
                            max-width: 80%;
                            flex: 0 0 80%;
                            float: left;
                        }
                        .c50{
                            width: 50%;
                            max-width: 50%;
                            flex: 0 0 50%;
                            float: left;
                        }
                        .c20{
                            width: 20%;
                            max-width: 20%;
                            flex: 0 0 20%;
                            float: left;
                            padding-right: 10px;
                        }
                        .prod-nome{
                            font-size: 14px;
                            color: black;
                            margin-bottom: 0px;
                            font-weight: bold;
                        }
                        .prod-img{
                            width: 100%;
                            height: auto;
                        }
                        .prod-total{
                            font-weight: bold;
                            color: black;
                            font-size: 18px;
                            display: inline;
                        }
                        .float-right{
                            display: inline;
                            float: right;
                        }
                        .btn-times-mobile{
                            height: 30px;
                            background-color: transparent;
                            border: 0;
                            border-color: transparent;
                        }
                        .btn-times-mobile em{
                            color: red;
                            font-size: 20px;
                        }
                    </style>
                    
                    <table class="table">
                        <thead class="mobile-thead">
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="mobile-tbody">
                            <?php $sum=0; $aux=1; foreach($listacarrinho as $lst){?>
                            <tr class="produto" id="produto_<?php echo $aux;?>">
                                <td>
                                    <div class="row">
                                        <div class="c20">
                                            <img class="prod-img" src="<?php echo base_url('imagens/produtos/'.$lst['idProduto'].'.png'); ?>">
                                        </div>
                                        <div class="c80">
                                            <div class="c100">
                                                <p class="prod-nome"><?php echo $lst['produto']; ?></p>
                                            </div>
                                            <div class="c100">
                                                <div class="left-btn">
                                                    <button type="button" class="btn-minus" onclick="subtrai(<?php echo $aux; ?>)"><em class="fa fa-minus"></em></button>
                                                </div>
                                                <div class="center-input">
                                                    <input type="text" min="1" max="99" class="qtd-input" id="qtd_<?php echo $aux; ?>" name="qtd_<?php echo $aux; ?>" value="<?php echo $lst['quantidade'] ?>" onchange="mudaValor(<?php echo $aux; ?>)">
                                                    <input type="hidden" id="produtoId_<?php echo $aux;?>" name="produtoId_<?php echo $aux;?>" value="<?php echo $lst['idProduto']; ?>">
                                                    <input type="hidden" id="value_<?php echo $aux;?>" name="value_<?php echo $aux;?>" value="<?php echo $lst['valor']; ?>">
                                                </div>
                                                <div class="right-btn">
                                                    <button type="button" class="btn-plus" onclick="soma(<?php echo $aux; ?>)"><em class="fa fa-plus"></em></button>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div id="soma_<?php echo $aux;?>" class="prod-total">R$<?php $helper = $lst['valor']*$lst['quantidade']; echo number_format($helper, 2); $sum += $helper;  ?></div>
                                                
                                                <div class="float-right">
                                                    <button type="button" class="btn-times-mobile" onclick="remove(<?php echo $aux; ?>)"><em class="fa fa-times"></em></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $aux++; }?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    
    <script>
        function finaliza(){
            window.location.href = "<?php echo base_url('b2eccf65385e0138e26ae97e89e88a0c') ?>";
        }
    
        $(document).ready(function(){
            $('#cep').mask('00000-000');
            document.getElementById("cep").value = '<?php echo $this->session->userdata('cep');?>';
            search();
        });
    
        function search(){
            var cep = $('#cep').val().replace(/\D/g,'');
            if(cep.length == 8){
                dados = new FormData();
                dados.append('cep', cep);
                dados.append('carrinho', '<?php echo $carrinho ?>');
                $.ajax({
                    url: '<?php echo base_url('3ac186ea673c6560fd6756a7c3796794'); ?>',
                    method: 'post',
                    data: dados,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    success: function(frete) {
                        $('#frete_formas').html('');
                        for(var i = 0; i < frete.length; i++){
                            var td = '<tr>'+
                                        '<td><input type="radio" onclick="calculaTotal()" class="radio-frete" id="r_'+frete[i].servico+'" name="frete" value="'+frete[i].servico+'" required style="display: inline">&nbsp;'+frete[i].servico+'</td>'+
                                        '<td class="text-center valor">R$ '+frete[i].valor+'</td>'+
                                        '<td class="text-center">'+frete[i].prazo+' dias</td>'+
                                    '</tr>';
                            $('#frete_formas').append(td);
                        }
                        $('#tabela_frete').css('display', 'block');
                    },
                });
            }
        }
    </script>
    
    <script>
    var gbl_total = <?php echo $sum; ?>;
    var gbl_old = 0.00;
    
        function mudaValor(id){
            if($('#qtd_'+id).val() != "" && parseInt($('#qtd_'+id).val()) > 0 && parseInt($('#qtd_'+id).val()) <= 99){
                var novo = $('#qtd_'+id).val();
                var uni = $('#value_'+id).val();
                
                var res = parseInt(novo) * parseFloat(uni);
                $('#soma_'+id).html("R$"+parseFloat(res).toFixed( 2 ));
                calculaTotal();
            }else if($('#qtd_'+id).val() == "" || parseInt($('#qtd_'+id).val()) <= 0){
                $('#qtd_'+id).val(1).change();
            }else if(parseInt($('#qtd_'+id).val()) > 99){
                $('#qtd_'+id).val(99).change();
            }
        }
    
        function numberToReal(numero) {
            var numero = numero.toFixed(2).split('.');
            numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
            return numero.join(',');
        }
    
        function soma(id){
            var quanto = document.getElementById("qtd_"+id).value;
            if(quanto < 99){
                var sum = parseInt(quanto) + 1;
            }else{
                sum = quanto;
                alert("Máximo de produtos alcançado! Entre em contato com um vendedor para maiores quantidades!");
            }
            document.getElementById("qtd_"+id).value = sum;
            $("#qtd_"+id).change();
            
            var valor = document.getElementById("value_"+id).value;
            var total = parseFloat(valor) * parseInt(sum);
            var soma = document.getElementById("soma_"+id);
            soma.innerHTML = "R$"+parseFloat(total).toFixed( 2 );
        }
        
        function subtrai(id){
            var quanto = document.getElementById("qtd_"+id).value;
            if(quanto > 1){
                var sum = parseInt(quanto) - 1;
            }else{
                sum = quanto;
            }
            document.getElementById("qtd_"+id).value = sum;
            $("#qtd_"+id).change();
            
            var valor = document.getElementById("value_"+id).value;
            var total = parseFloat(valor) * parseInt(sum);
            var soma = document.getElementById("soma_"+id);
            soma.innerHTML = "R$"+parseFloat(total).toFixed( 2 );
        }
        
        function remove(id){
            document.getElementById("produto_"+id).remove();
            calculaTotal();
        }
        
        function calculaTotal(){
            var tt = parseInt('<?php echo $aux ?>');
            var res = 0.00;
            for(var i = 1; i < tt; i++){
                if($('#soma_'+i).length){
                    var valor = parseFloat($('#soma_'+i).html().substr(2)).toFixed(2);
                    res = parseFloat(res) + parseFloat(valor);
                }
            }
            
            $('#sub_total').html(numberToReal(res));
            
            if($('#tabela_frete').css('display') == "block"){
                var frete = 0.00;
                $('.radio-frete').each(function(){
                    if($(this).is(':checked')){
                        frete = $(this).parent().parent().find('.valor').html().substr(3).replaceAll('.', '').replace(',', '.');
                    }
                });
                res = parseFloat(res) + parseFloat(frete);
            }
            
            $('#total').html(numberToReal(res));
            $('#hidden_total').val(res);
        }
    </script>
    
    <script>
        /*function calculo(){
            var aux = 1;
            var calc = 0;
            var total = 0;
            var qtd_produto = 0;
            var frete = parseFloat($('#frete').html().replaceAll('.','').replace(',', '.'));
            
            $('.produto').each(function(){
                
                var preco = parseFloat($('#p_' + aux).html().replaceAll('.','').replace(',', '.'));
                var qtd   = parseInt($('#qtd_' + aux).val());

                calc = calc + (preco * qtd);
                qtd_produto++;
                aux++;
            });
            
            $('#qtd_produto').html(qtd_produto + ' Produto(s)');    
            
            $('#sub_total').unmask().html(calc.toFixed(2)).mask("#.##0,00", {reverse: true});
            
            total = calc + frete;
            
            $('#total').unmask().html(total.toFixed(2)).mask("#.##0,00", {reverse: true});
            $('#hidden_total').val(total.toFixed(2));
        }*/
    </script>
    
    <script>
        $(document).ready(function(){
            //calculo();
        });
    </script>
    