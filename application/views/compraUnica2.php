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
            $mobile_view = 1;
        } else {
            $mobile = false;
            $mobile_view = 0;
        }
    ?>

    
    <style>
        body{
             background-color: #fafafa!important;
        }
        .custom-profile{
            width: 50%;
            margin: 0 25% 10px 25%;
            height: auto;
            border-radius: 50%;
        }
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
            padding: 20px 20px 0px 20px;
            background: #fafafa!important;
        }
        .teste-card{
            width: 100%;
            border-radius: 10px;
            background-color: transparent;
            margin: 4px 4px 0px 4px;
            box-shadow: 0 0 4px #444;
        }
        .full-frame{
            width: 100%;
            height: auto;
            border: 0;
        }
        .backcolor{
            background: #f9fdff;
            background-color: #f9fdff;
        }
        .active{
            border-bottom: 2px solid #777777;
        }
        
        #modal-completa{
            max-width: 56%; margin-left: 22%; margin-right: 22%;
               
        }
        
        .swal2-popup .swal2-styled.swal2-confirm {
            background-color: var(--base-color)!important;
        }

        .custom-thead{
            background-color: var(--base-color);
        }
        .custom-thead th{
            color: white;
            text-align: center;
            padding: 10px 0px;
        }
        .custom-tbody:before {
            content:"@";
            display:block;
            line-height:20px;
            text-indent:-99999px;
        }
        .custom-h4{
            font-size: 20px;
            text-align: center;
            color: #444;
            font-family: "Poppins",sans-serif;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .custom-label{
            font-family: "Poppins",sans-serif;
            font-size: 14px;
            color: #444;
        }
        .custom-fullname{
            font-family: "Poppins",sans-serif;
            text-align: center;
            color: grey;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .custom-p{
            font-family: "Poppins",sans-serif;
            color: #444;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 12px;
        }

        .button-proximo{
            padding: 0;
            background: none;
            border-radius: 5px;
            color: var(--base-color);
        }
        .button-proximo:before{
            color: white!important;
            background-color: var(--base-color)!important;
            box-shadow: none!important;
            border-color: var(--base-color)!important;
            background: var(--base-color)!important;
        }
        .button-proximo:hover{
            color: white!important;
            background-color: var(--base-color)!important;
            box-shadow: none!important;
            border-color: var(--base-color)!important;
            background: var(--base-color)!important;
        }
        
        .see-pass{
            width: 10%;
            margin-left: -4px;
            margin-top: -2px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            padding: 7px;
            border-radius: 5px;
            background: var(--base-color)!important;
            border-color: var(--base-color)!important;
            color: white;
            cursor: pointer;
        }
        .passwd{
            width: 88%;
            display: inline;
            margin-right: 1%;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .prod-departamento{
            font-size: 15px;
            color: grey;
            margin-bottom: 3px;
            margin-top: 10px;
            line-height: 0px;
            text-align: center;
        }
        .prod-nome{
            font-size: 15px;
            margin-bottom: 0px;
            color: #444;
            font-weight: bold;
        }
        .prod-preco{
            margin-bottom: 10px;
            font-size: 25px;
            color: #444;
            text-align: center;
        }
        .stars{
            margin-top: 15px;
            margin-bottom: 0px;
            line-height: 0px;
        }
        
        .produto-desconto{
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #25e625;
            padding: 0 4px;
            color: white;
            border-radius: 3px;
        }
        
        .p-card-final{
            font-size: 25px;
            background: var(--base-color);
            color: white;
            margin-left: 2px;
            margin-right: 3px;
        }
        
        .produto-titulo{
            text-align: center; 
            color: #444;
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
            font-size: 14px;
            margin-bottom: 10px;
            margin-top: 2%;
            line-height: 15px;
        }   
        
        .estrelas{
            text-shadow: 0 0 1px #736102;
            color: gold!important;
            padding-top: 3%;
        }
    
        <?php if($mobile_view == 0){ ?>
            .zoom:hover {
                transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
            }
        <?php } ?>
        
        .custom-logado{
            font-size: 15px;
            color: #444;
            text-align: left!important;
        }
        
        .mobile-imagem-produto{
            margin-top: 25%!important;
            margin-left: 20%;
            height: 80px;
            width: auto;
        }
        
        @media(max-width: 500px){
            .custom-logado{
                width: 100%!important;
            }
            #modal-completa{
                max-width: 98%;
                margin-left: 1%!important;
                margin-right: 0!important; 
            }
            .label-forma{
                font-size: 15px!important;
            }
            .main-section{
                padding: 15px 20px 0px 20px;
            }
            #transferModalLabel {
                font-size: 12px;   
            }
        }
        
        @media(max-width: 1050px){
            .mobile-imagem-produto{
                margin-top: 0%!important;
            }
        }
        
        @media(max-width: 769px){
            .mobile-imagem-produto{
                margin-top: 0%!important;
            }
        }
        
        
        
    </style>

    <section class="contact-section main-section">
        <div class="container-fluid">
            <div class="row row-eq-height">
                
                <?php if($this->session->userdata('cliente_logado')){ ?>
                <div class="row" style="width: 100%!important">
                    <div class="col-md-12 col-12">
                        <p class="custom-fullname custom-logado"><i style="color: #444; font-size: 25px;" class="fa fa-user-circle" aria-hidden="true"></i> <?php echo ucwords(mb_strtolower($cliente['cliente_nome'])) ?> | <?php echo $cliente['cliente_cpf'] ?></p>
                    </div>    
                </div>
                <?php } ?>
                
                <div class="col-xl-<?php if($carrinho == null){echo '6 offset-xl-3 ';} else {echo '9'; } ?> col-lg-12 col-md-12" style="padding: 0; <?php if($mobile) { echo 'margin-top: 5%!important;margin-bottom: 3%;'; } ?>">
                    <div class="col-md-12 backcolor" id="div-pagamento" style="padding: 0; margin: 0;">
                            <div id="testegui" style="background: #f9fdff; height: 100%; width: 100%;">
                                <div class="custom-card" style="padding: 0">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 0; ">
                                        <?php if($mobile_view == 0){ ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php if($carrinho == null){ echo "<h5 style='text-align: center!important; font-size: 28px; margin-top: 12%;margin-bottom: 9%;padding-bottom: 50px; padding-top: 50px; padding: 10px;'>Carrinho Vazio :(</h5>"; }else{?>
                                                    <form id="fechaCarrinho" method="post" style="margin: 0">
                                                        <table style="margin-left: 14px!important; margin-right: 14px!important">
                                                            <thead>
                                                                <tr class="custom-thead">
                                                                    <th class="text-left" style="border-top-left-radius: 10px!important; padding-left: 5%; width: 55%;">Produto</th>
                                                                    <th  class="text-center" style="width: 15%;">Valor</th>
                                                                    <th  class="text-center" style="width: 25%;">Qtd</th>
                                                                    <th  class="text-center" style="border-top-right-radius: 10px!important; width: 35%;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="custom-tbody">
                                                                
                                                                    <?php $sum=0; $aux=1; foreach($carrinho as $lst){?>
                                                                        <input type="hidden" id="produtoId_<?php echo $aux;?>" name="produtoId_<?php echo $aux;?>" value="<?php echo $lst['idProduto']; ?>">
                                                                        <input type="hidden" id="value_<?php echo $aux;?>" name="value_<?php echo $aux;?>" value="<?php echo $lst['valor']; ?>">
                                            
                                                                        <tr class="produto" id="produto_<?php echo $aux;?>">
                                                                            <td style="padding-left: 5%; padding-bottom: 5px;">
                                                                                <div class="row">
                                                                                    <div class="col-md-3" style="padding: 0!important">
                                                                                        <img style="position: relative;top: -20px;height: 70px; width: auto;" src="<?php echo base_url('imagens/produtos/') . $lst['idProduto'] . '.jpg'; ?>">
                                                                                    </div>
                                                                                    <div class="col-md-9" style="padding-left: 2%!important; padding-top: 1%; padding: 0; padding-right: 5px!important;">
                                                                                        <span style="position: absolute; top: -16px;color: #969696;font-size: 12px;"><?php echo ucfirst(mb_strtolower($lst['opcao'])); ?></span>
                                                                                        <span style="text-transform: uppercase;font-weight: bold;"><?php echo ucfirst(mb_strtolower($lst['produto'])); ?></span>   
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td style="padding-bottom: 55px!important;" class="text-center">
                                                                                R$<?php echo str_replace(".", ",", $lst['valor']); ?>
                                                                            </td>
                                                                            <td class="text-center" style="display:table-row;">
                                                                                <div class="input-group mb-2 text-center" style="margin-left: 5%; width: 90%!important; margin-bottom: 33px!important;margin-top: 5%;">
                                                                                    <div class="input-group-prepend" style="cursor: pointer" onclick="diminuir(<?php echo $aux ?>)">
                                                                                        <span class="input-group-text" style="background: transparent">
                                                                                            <i class="marrom-padrao fa fa-minus" aria-hidden="true"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <input readonly style="padding-left: 10%!important; margin: 0; padding: 0; text-align: center; border-left: 0; border-right: 0;color: #444!important" id="qtd_<?php echo $aux; ?>" min="1" max="<?php echo $lst['maximo'] ?>" name="qtd_<?php echo $aux; ?>" value="<?php echo $lst['quantidade'] ?>" type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                                                                    <div class="input-group-prepend" style="cursor: pointer" onclick="aumentar(<?php echo $aux ?>)">
                                                                                        <span class="input-group-text" style="border-left: 0; background: transparent">
                                                                                            <i class="marrom-padrao fa fa-plus" aria-hidden="true"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <p onclick="remove(<?php echo $lst['idProduto']; ?>)" style="cursor: pointer; color: #444!important; font-size: 13px; margin-left: 30%!important; margin: 0; padding: 0!important">remover</p>
                                                                                </div>
                                                                            </td>
                                                                            <td style="padding-bottom: 55px!important;padding-right: 30px!important;" class="text-center">
                                                                                <div id="soma_<?php echo $aux;?>"><b style="color: #444;">R$<?php $helper = $lst['valor']*$lst['quantidade']; echo number_format($helper, 2,',','.'); $sum += $helper;  ?></b></div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php $aux++; }?>
                                                                       
                                                            </tbody>
                                                        </table>
                                                        
                                                            <div class="row">
                                                                <div class="col-md-12 text-right" style="margin-bottom: 2%; margin-top: 2%">
                                                                    <button  onclick="inicio()" style="margin-right: 5%;padding: 14px;cursor: pointer; box-shadow: 5px 6px 3px -5px #000000; font-size: 18px!important; background: var(--base-color); border:0;" type="button" class="btn btn-primary"><i style="color: white" class="fa fa-shopping-basket" aria-hidden="true"></i> <b style="color: white">Adicionar <?php if($carrinho != null){ echo 'mais'; } ?> Produtos</b></button>
                                                                </div>
                                                            </div>
                                                        
                                                        <input type="hidden" id="itens" name="itens" value="<?php echo $aux ?>">
                                                    </form> 
                                                    <?php } ?>
                                                    <?php if($carrinho != null){ ?>
                                                        
                                                        <div class="row" style="margin-bottom: 5%">
                                                            <div class="col-md-12">
                                                                <hr style="height: 1px; margin: 0; margin-bottom: 2%!important; max-width: 95%!important; margin: auto; margin-top: 1%!important">
                                                            </div>
                                                            <div class="col-md-6" style="padding-left: 6%">
                                                                <label><b style="color: #444!important;">Frete:</b></label>
                                                                <form method="post" id="form-cep" action="<?php echo base_url('ca64a968b4507c33a7c38a4d93c715b5') ?>">
                                                                    <div class="input-group mb-3" style="width: 70%!important">
                                                                        <input  maxlength="8" <?php if($this->session->userdata('frete_tipo') !== null){ echo "disabled";} ?> type="text" id="cep" name="cep" class="cep form-control" placeholder="Digite seu CEP" value="<?php if($this->session->userdata('cliente_cep')) { echo $this->session->userdata('cliente_cep'); } ?>">
                                                                        <button type="submit" style="cursor: pointer; background-color: transparent; color: var(--base-color); border:1px solid var(--base-color);" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                                
                                                            <?php if(isset($frete)) { ?>
                                                                <div class="col-md-6" style="padding-right: 0!important">
                                                                    <?php foreach($frete as $f){ ?>
                                                                        <?php if(isset($f['msg'])){ ?>
                                                                            <p style=" margin: 0">Frete mínimo não alcançado.</p>
                                                                        <?php } else { ?>
                                                                            <?php if($f['nome'] == 'Retirar na loja'){ ?>
                                                                                <div class="radio">
                                                                                    <label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Apenas para Uberaba - Grátis</label>
                                                                                </div>
                                                                            <?php } else if($f['nome'] == 'Motoboy'){ ?>
                                                                                <div class="radio">
                                                                                    <label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Apenas para Uberaba - Grátis</label>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div class="radio">
                                                                                    <label style="font-size: 11px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Entrega em <?php echo $f['dias'] ?> dia(s) - R$<?php echo number_format($f['valor'],2,',','.') ?></label>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                    <?php } ?>
                                                    
                                                    <!--
                                                    <?php if(!isset($desconto)){ ?>
                                                        <div class="col-md-6">
                                                            <label style="font-size: 14px;"><b style="color: #444!important">Cupom de Desconto:</b></label>
                                                            <form method="post" action="<?php echo base_url('finalizaUnico/cupom') ?>">
                                                                <div class="input-group mb-3" style="width: 80%!important;">
                                                                    <input type="text" id="cupom" name="cupom" class="form-control" placeholder="Digite seu cupom">
                                                                    <button type="submit" style="cursor: pointer; background-color: transparent; color: var(--base-color); border:1px solid var(--base-color);" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    <?php } ?>
                                                    -->
                                                </div>
                                            </div>
                                            </div>
                                        <?php } else { ?>
                                        <!-- VERSÃO SOMENTE DO CARRINHO PARA MOBILE INICIO -->
                                            
                                                <?php if($carrinho == null){ echo "<h5 style='width: 95%!important; font-size: 22px;margin-top: 20%; text-align: center!important;'>Carrinho Vazio :(</h5>"; } ?>
                                                <?php $sum=0; $aux=1; foreach($carrinho as $lst){?>
                                                <form id="fechaCarrinho" method="post">
                                                    <input type="hidden" id="produtoId_<?php echo $aux;?>" name="produtoId_<?php echo $aux;?>" value="<?php echo $lst['idProduto']; ?>">
                                                    <input type="hidden" id="value_<?php echo $aux;?>" name="value_<?php echo $aux;?>" value="<?php echo $lst['valor']; ?>">
                                        
                                                    <div class="col-md-12 produto" id="produto_<?php echo $aux;?>" style="padding: 8px; max-height: 195px;">
                                                        <div class="row form-group">
                                                            <div class="col-md-4 col-4">
                                                                <img class="mobile-imagem-produto" src="<?php echo base_url('imagens/produtos/') . $lst['idProduto'] . '.jpg'; ?>">
                                                            </div>
                                                            <div class="col-md-8 col-8">
                                                                <p style="margin: 0; font-size: 11px; color: grey;">&nbsp;</p>
                                                                <span style="position: absolute; top: 8px;color: #969696;font-size: 12px;"><?php echo ucfirst(mb_strtolower($lst['opcao'])); ?></span>
                                                                <p style="line-height: 20px; color: #444!important; text-transform: uppercase;font-weight: bold;"><?php echo ucfirst(mb_strtolower($lst['produto'])); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-6 text-center" style="width: 50%">
                                                                <p style="font-size: 24px; margin-top: -3%; color: #444!important"><b style="color: #444!important">R$ <?php echo number_format($lst['valor'] * $lst['quantidade'],2,',','.') ; ?></b></p>
                                                            </div>
                                                            <div class="col-md-6 text-center" style="width: 50%; padding-right: 10%; margin-left: 0;">
                                                                <div class="input-group mb-2 text-center" style="width: 90%!important; margin-bottom: 33px!important;margin-top: -9px;">
                                                                    <div class="input-group-prepend" style="cursor: pointer" onclick="diminuir(<?php echo $aux ?>)">
                                                                        <span class="input-group-text" style="background: transparent">
                                                                            <i class="marrom-padrao fa fa-minus" aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input style="text-align: center; border-left: 0; border-right: 0;color: #444!important" id="qtd_<?php echo $aux; ?>" min="1" max="<?php echo $lst['maximo'] ?>" name="qtd_<?php echo $aux; ?>" value="<?php echo $lst['quantidade'] ?>" type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                                                    <div class="input-group-prepend" style="cursor: pointer" onclick="aumentar(<?php echo $aux ?>)">
                                                                        <span class="input-group-text" style="border-left: 0; background: transparent">
                                                                            <i class="marrom-padrao fa fa-plus" aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                    <p onclick="remove(<?php echo $lst['idProduto']; ?>)" style="color: #444!important; font-size: 13px; margin-left: 30%!important; margin: 0; padding: 0!important">remover</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: none" id="soma_<?php echo $aux;?>"><b>R$<?php $helper = $lst['valor']*$lst['quantidade']; echo number_format($helper, 2,',','.'); $sum += $helper;  ?></b></div>
                                                    </div>
                                                <?php  $aux++; } ?>
                                                <div class="row" style="margin-top: 2%; width: 100%!important; margin-left: auto; margin-right: auto;">
                                                    <div class="col-md-6" style="width: 50%"></div>
                                                    <div class="col-md-6 text-center" style="width: 50%">
                                                        <input type="hidden" id="itens" name="itens" value="<?php echo $aux ?>">
                                                    </div>
                                                </div>
                                                </form>
                                            
                                        <?php } ?>
                                        <!-- VERSÃO SOMENTE DO CARRINHO PARA MOBILE FIM -->
                                        
                                        </div>
                                    </div>
                                </div>
                        
                                
                        </div>
                    </div>
                </div>
                
                
                
                <!---- FRETE APENAS MOBILE -->
                <?php if($mobile && $carrinho != null){ ?>
                <div class="col-md-12 col-12" style="margin: 0; padding: 0; margin-bottom: 3%;">
                    <div class="col-md-12 backcolor" id="div-login" style="margin: 0; padding: 0;">
                        <div class="custom-card">

                            <?php if($carrinho != null){ ?>
                                <div class="row">
                                    <div id="consulta-frete" class="col-md-12" style="width: 100%!important">
                                        <label><b style="color: #444!important;">Calcule o Frete:</b></label>
                                        <form method="post" id="form-cep" action="<?php echo base_url('ca64a968b4507c33a7c38a4d93c715b5') ?>">
                                            <div class="input-group mb-3" style="width: 90%!important">
                                                <input  maxlength="8" <?php if($this->session->userdata('frete_tipo') !== null){ echo "disabled";} ?> type="text" id="cep" name="cep" class="cep form-control" placeholder="Digite seu CEP" value="<?php if($this->session->userdata('cliente_cep')) { echo $this->session->userdata('cliente_cep'); } ?>">
                                                <button type="submit" style="cursor: pointer; background-color: transparent; color: var(--base-color); border:1px solid var(--base-color);" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                        <?php if(isset($frete)) { ?>
                                            <?php foreach($frete as $f){ ?>
                                                <?php if(isset($f['msg'])){ ?>
                                                    <p style="margin: 0">Erro frete</p>
                                                <?php } else { ?>
                                                    <?php if($f['nome'] == 'Retirar na loja'){ ?>
                                                        <div class="radio">
                                                            <label style="font-size: 12px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Apenas para Uberaba - Grátis</label>
                                                        </div>
                                                    <?php } else if($f['nome'] == 'Motoboy'){ ?>
                                                        <div class="radio">
                                                            <label style="font-size: 12px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Apenas para Uberaba - Grátis</label>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="radio">
                                                          <label style="font-size: 12px;"><input id="<?php echo $f['nome'] ?>" value="<?php echo $f['id'];?>" class="fretes" onchange="SubPac(<?php echo $f['valor'];?>, '<?php echo $f['nome'];?>')" style="height: 13px;width: 13px;" type="radio" name="optradio" <?php if($this->session->userdata('frete_sel') == $f['id']){ echo "checked";}?>> <b style="color: #444!important;"><?php echo $f['nome'] ?></b>: Entrega em <?php echo $f['dias'] ?> dia(s) - R$<?php echo number_format($f['valor'],2,',','.') ?></label>    
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                
                <?php if($carrinho != null){ ?>
                    <div class="col-xl-3 col-lg-12 col-md-12 col-12" style="margin: 0; padding: 0;margin-bottom: 3%;">
                        <div class="col-md-12 backcolor" id="div-pagamento" style="padding: 0; margin: 0;">
                        <div id="testegui" style="background: #f9fdff; height: 100%; width: 100%;">
                            <div class="custom-card" style="padding: 0">
                                <!--
                                <?php if($mobile_view == 1){ ?>
                                    <div class="row" style="margin-bottom: 3%; margin-top: 5%; margin-left: auto; margin-right: auto">
                                        <div class="col-md-12">
                                            <?php if(!isset($desconto)){ ?>
                                                <label class="label-forma"><b style="color: #444!important;">CUPOM DE DESCONTO:</b></label>
                                                <form method="post" action="<?php echo base_url('finalizaUnico/cupom') ?>">
                                                    <div class="input-group mb-3" style="width: 90%!important;margin-left: auto;margin-right: auto;">
                                                        <input type="text" id="cupom" name="cupom" class="form-control" placeholder="Digite seu cupom">
                                                        <button type="submit" style="cursor: pointer; background-color: transparent; color: var(--base-color); border:1px solid var(--base-color);" class="input-group-text">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                -->

                                    <div id="div-detalhes" class="col-md-12 form-group">
                                        <label style="margin-bottom: 10%; margin-top: 3%; font-size: 20px; display: block;" class="label-forma text-center">
                                            <b style="color: #444;">Detalhes do Pedido:</b>
                                        </label>
                                        <table style="width: 100%">
                                            <?php if(isset($valorTotal)) { ?>
                                                <tr>
                                                    <td>
                                                        <p id="p-subtotal" style="text-align: right; color: #5a5750;">
                                                            <b style="color: #444">Compra:</b>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <input disabled id="sbttl" style="font-size: 20px; margin-bottom: 13px; color: #444!important; background: transparent;border: 1px solid lightgrey;border-radius: 5px;font-weight: bold;width: 90%; text-align: center; margin-left: 3%;" value="R$ <?php echo number_format(floatval($valorTotal), 2, ',','.'); ?>">
                                                    </td>
                                                </tr>
                                            <?php } else { ?>    
                                                <tr>
                                                    <td>
                                                        <p id="p-subtotal" style="text-align: right; color: #5a5750;">
                                                            <b style="color: #444">Compra:</b>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <input disabled style="font-size: 20px; margin-bottom: 13px; color: #444!important; background: transparent;border: 1px solid lightgrey;border-radius: 5px;font-weight: bold;width: 90%; text-align: center; margin-left: 3%;" value="R$ 0,00">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                    <p id="p-frete" style="text-align: right;">
                                                        <b style="color: #444">Frete:</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    <input disabled id="subtotal" <?php if($this->session->userdata('frete_valor')){ echo 'value="R$ '.number_format($this->session->userdata('frete_valor'),2,',','.') .'"';} ?> style="margin-bottom: 13px; color: #444!important; background: transparent;border: 1px solid lightgrey;border-radius: 5px;font-weight: bold;width: 90%; text-align:center; margin-left: 3%; font-size: 20px;">
                                                </td>
                                            </tr>
                                            <?php if(isset($desconto)){ ?>
                                                <tr>
                                                    <td>
                                                        <p id="p-desconto" style="text-align: right">
                                                            <b style="color: #444">Desconto:</b>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <input value="R$ <?php echo number_format(floatval($desconto),2,',','.') ?>" disabled id="valordesconto" style="font-size: 20px; color: #444!important; background: transparent;border: 1px solid lightgrey;border-radius: 5px;font-weight: bold;width: 90%; text-align:center; margin-left: 3%;margin-bottom: 13px;">
                                                    </td>
                                                </tr>
                                            <?php } ?>   
                                            <tr>
                                                <td>
                                                    <p id="p-total" style="text-align: right; color: #676560;">
                                                        <b style="color: #444">Total:</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    <input disabled id="totalgeral" style="font-size: 20px; color: #444!important; background: transparent;border: 1px solid lightgrey;border-radius: 5px;font-weight: bold;width: 90%; text-align:center; margin-left: 3%;margin-bottom: 13px;"  <?php if($this->session->userdata('frete_valor')){ echo 'value="R$ '.number_format($this->session->userdata('frete_valor') + $valorTotal, 2,',','.').'"';} ?>>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                
                                <?php if($mobile_view == 0){ ?>     
                                <div id="div_forma_pagamento" class="col-md-12 form-group">
                                    <?php if(isset($frete) && $carrinho != null) { ?>
                                    <hr style='height: 1px;'>
                                    
                                    <div class="row" style="margin-top: 5%;">
                                        <?php if(isset($chave)){ ?>
                                            <div class="col-md-12 form-group">
                                                <button style="height: 40px!important;" class="btn-block btn btn-primary"  data-callback='onSubmit' data-action='submit'><b style="font-size: 13px; color: white">Finalizar Pedido</b></button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>

                                <?php } ?>
                                        
                            </div>
                        </div>
                    </div>
                    </div>
                <?php } ?>
                
                
                
                
                
                <!---- PAGAMENTO APENAS MOBILE -->
                <?php if($mobile){ ?>
                <div class="col-md-12 col-12" style="margin: 0; padding: 0;">
                    <div class="col-md-12 backcolor" id="div-login" style="margin: 0; padding: 0;">
                        <div class="custom-card">
                            <div id="div_forma_pagamento" class="col-md-12 form-group">
                                <?php if(isset($frete) && $carrinho != null) { ?>
                                
                                <label class="label-forma" style="text-align: left!important;"><b style="color: #444;">Finalizar:</b></label>
                                
                                <div class="row" style="margin-top: 5%;">
                                    <?php if(isset($chave)){ ?>
                                        <div class="col-md-12 form-group">
                                            <button style="height: 40px!important;" class="btn-block btn btn-primary" data-callback='onSubmit' data-action='submit'><b style="font-size: 13px; color: white">Finalizar Pedido</b></button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-bottom: 2%;">
                                    <p onclick="inicio()" style="text-decoration: underline; color: #444!important; font-size: 13px;">Adicionar <?php if($carrinho != null){ echo 'mais'; } ?> produtos</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php } ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

            </div>
            <br><br>
        </div>
        <?php if(!$mobile && $carrinho == null){ ?>
            <div class="section-content" style="<?php if($mobile_view == 0){echo "margin-bottom: 20px;";} ?> background: #fafafa;">
                <hr style="height: 1px; border-color: lightgrey">
                <div class="col-md-12 text-center form-group" style="margin-bottom: 3%">
                    <h3 style="padding-left: 1%; opacity: 0.9">APROVEITE PARA COMPRAR</h3>
                </div>
                <div class="row">
                    <?php foreach($produtos as $p){ ?>
                    <div class="col-3 col-sm-3 col-lg-3 col-12 form-group">
                            <a href="<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/'). $p['produto_id'] ?>">
                            <div class="card zoom" style="height: 320px;">
                                <div class="card-body" style="padding: 2px;">
                                    <div class="text-center">
                                        <img style="height: 180px;width: auto;padding: 15px 50px;" src="<?php echo base_url('imagens/produtos/').$p['produto_id'] .'.jpg'; ?>" alt="">
                                    </div>
                                    <?php if(isset($p['produto_porcentagem'])){ ?>
                                        <p class="produto-desconto"><i class="fa fa-arrow-down" aria-hidden="true"></i> <?php $p['produto_porcentagem'] ?></p>
                                    <?php } ?>
                                    <div class="col-md-12 text-center">
                                        <div class="estrelas">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <p style="color: lightgrey; font-size: 13px; line-height: 12px; margin: 0; padding: 0"><b><?php echo ucfirst(mb_strtolower($p['produto_departamento'])) ?></b></p>
                                    </div>
                                    
                                    <p class="produto-titulo"><b><?php echo ucfirst(mb_strtolower($p['produto_nome'])) ?></b></p>
                                    <div class="row" style="position: absolute; bottom: 2%;left: 6%; width: 100%!important">
                                        <?php if($p['produto_promocao']){ ?>
                                            <div class="col-md-6">
                                                <p class="prod-preco" style="color: #444; line-height: 15px; margin: 0!important; padding: 0!important;font-size: 12px; text-decoration: line-through;">R$ <?php echo number_format($p['produto_valor'],2,',','.') ?></p>
                                                <p class="prod-preco" style="color: #444; line-height: 19px;"><b style="color: #444">R$ <?php echo number_format($p['produto_promocao'], 2,',','.') ?></b></p>
                                            </div>
                                        <?php } ?>
                                        
                                        <?php if($p['produto_promocao']){ ?>
                                            <div class="col-md-6">
                                                <p class="prod-preco" style="color: #444; line-height: 15px; margin: 0!important; padding: 0!important;font-size: 12px; text-decoration: line-through;">R$ <?php echo number_format($p['produto_valor'],2,',','.') ?></p>
                                                <p class="prod-preco" style="color: #444; line-height: 19px;"><b style="color: #444">R$ <?php echo number_format($p['produto_promocao'], 2,',','.') ?></b></p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-12 text-center" style="width: 100%">
                                                <p class="prod-preco"><b style="font-size: 20px; font-weight: bold;line-height: 30px;color: #444;">R$ <?php echo number_format($p['produto_valor'], 2,',','.') ?></b></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row" style="height: 5px; background-color: var(--base-color); position: absolute;bottom: 0;left: 5.5%; width: 100%">
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </section>

    
    
    
    
<!-- Modal -->
<div class="modal fade" id="enderecoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="modal-completa">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">COMPLETE SEUS DADOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?php echo base_url('2ed7ae53dde60f945ba3dc6a00d2365b') ?>" method="post">
                <input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo $this->session->userdata('cliente_user_id') ?>">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Telefone:</b></label>
                        <input style="font-size: 12px;" type="text" class="telefone form-control" name="telefone-modal" id="telefone-modal"> 
                    </div>
                    <div class="col-md-6 form-group">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">E-mail:</b></label>
                        <input style="font-size: 12px;" type="email" class="form-control" name="email-modal" id="email-modal"> 
                    </div>
                    <div class="col-md-3 form-group">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Nascimento:</b></label>
                        <input style="font-size: 12px;" type="date" class="form-control" name="nascimento-modal" id="nascimento-modal"> 
                    </div>
                    <div class="col-md-3 form-group div-enderecos" id="cep-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Cep:</b></label>
                        <div class="input-group mb-3">
                            <input style="font-size: 12px;" maxlength="8" type="text" id="cep-modal" name="cep-modal" class="cep form-control" placeholder="_____-___">
                            <button onclick="autofillCEP()" type="button" style="cursor: pointer; background-color: transparent; color: var(--base-color); border:1px solid var(--base-color);" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group div-enderecos" id="rua-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Rua:</b></label>
                        <input style="font-size: 12px;" type="text" class="form-control" name="rua-modal" id="rua-modal" required>
                    </div>
                    <div class="col-md-2 form-group div-enderecos" id="n-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">N°:</b></label>
                        <input style="font-size: 12px;" type="text" class="form-control" name="numero-modal" id="numero-modal" required>
                    </div>
                    <div class="col-md-4 form-group div-enderecos" id="complemento-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Complemento:</b></label>
                        <input style="font-size: 12px;" type="text" class="form-control" name="complemento-modal" id="complemento-modal">
                    </div>
                </div>
                <div class="row" style="margin-top: 2%">
                    <div class="col-md-5 form-group div-enderecos" id="bairro-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Bairro:</b></label>
                        <input style="font-size: 12px;" type="text" class="form-control" name="bairro-modal" id="bairro-modal" required>
                    </div>
                    <div class="col-md-4 form-group div-enderecos" id="cidade-div">
                        <label style="font-size: 13px; color: grey;"><b style=" color:grey!important;">Cidade:</b></label>
                        <input style="font-size: 12px;" type="text" class="form-control" name="cidade-modal" id="cidade-modal" required>
                    </div>
                    <div class="col-md-3 form-group div-enderecos" id="estado-div">
                        <label style="font-size: 13px;"><b style=" color:grey!important;">Estado:</b></label>
                        <select style="font-size: 12px;" class="form-control" id="estado-modal" name="estado-modal" required>
                            <option value="" selected disabled> Selecione </option>
                        	<option value="AC">Acre</option>
                        	<option value="AL">Alagoas</option>
                        	<option value="AP">Amapá</option>
                        	<option value="AM">Amazonas</option>
                        	<option value="BA">Bahia</option>
                        	<option value="CE">Ceará</option>
                        	<option value="DF">Distrito Federal</option>
                        	<option value="ES">Espírito Santo</option>
                        	<option value="GO">Goiás</option>
                        	<option value="MA">Maranhão</option>
                        	<option value="MT">Mato Grosso</option>
                        	<option value="MS">Mato Grosso do Sul</option>
                        	<option value="MG">Minas Gerais</option>
                        	<option value="PA">Pará</option>
                        	<option value="PB">Paraíba</option>
                        	<option value="PR">Paraná</option>
                        	<option value="PE">Pernambuco</option>
                        	<option value="PI">Piauí</option>
                        	<option value="RJ">Rio de Janeiro</option>
                        	<option value="RN">Rio Grande do Norte</option>
                        	<option value="RS">Rio Grande do Sul</option>
                        	<option value="RO">Rondônia</option>
                        	<option value="RR">Roraima</option>
                        	<option value="SC">Santa Catarina</option>
                        	<option value="SP">São Paulo</option>
                        	<option value="SE">Sergipe</option>
                        	<option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="esqueciSenhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Redefinir a senha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('areauser/esquecerSenha') ?>" method="post">
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>CPF:</label>
                        <input type="text" name="cpf-esquecer" id="cpf-esquecer" class="cpf form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>E-mail:</label>
                        <input type="email" name="email-esquecer" id="email-esquecer" class="form-control">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="padding: 7px!important">REDEFINIR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
          </form>
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b style="color: #444">Cadastro</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <form id="cadastro" action="<?php echo base_url('20f78cc3d3cba8f46f596c481357096d') ?>" method="post">
                    
                    <div class="row" id="parte1">
                        <div class="col-md-12 text-center">
                            <h5 style="color: #444; text-decoration: underline">Dados Pessoais</h5>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444">CPF:</b></label>
                            <input type="text" class="cpf form-control" name="cpf_cadastro" id="cpf_cadastro" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444">Nome Completo:</b></label>
                            <input type="text" class="form-control" name="nome_cadastro" id="nome_cadastro" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444">Nascimento:</b></label>
                            <input type="text" class="date form-control" placeholder="__/__/____" name="nascimento_cadastro" id="nascimento_cadastro" required>
                        </div>
                        <div class="col-md-12 form-group text-right">
                            <button onclick="parte1()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-right" aria-hidden="true"></i> Próximo</button>
                        </div>
                    </div>
                
                    <div class="row" id="parte2" style="display: none;">
                    <div class="col-md-12 text-center">
                        <h5 style="color: #444; text-decoration: underline">Contato</h5>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b style="color: #444">Telefone:</b></label>
                        <input type="text" class="telefone form-control" name="telefone_cadastro" id="telefone_cadastro">
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b style="color: #444">E-mail:</b></label>
                        <input type="email" class="form-control" name="email_cadastro" id="email_cadastro">
                    </div>
                    <div class="col-md-12 form-group text-right">
                        <button onclick="parte5()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-left" aria-hidden="true"></i> Anterior</button>
                        <button onclick="parte2()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-right" aria-hidden="true"></i> Próximo</button>
                    </div>
                </div>
                
                    <div class="row" id="parte3" style="display: none;">
                        <div class="col-md-12 text-center">
                            <h5 style="color: #444; text-decoration: underline">Endereço</h5>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444;">Cep:</b></label>
                            <div class="input-group mb-3">
                              <input style="border-right: none;" onkeyup="autofillCEP2()" class="cep form-control" type="text" name="cep_cadastro" id="cep_cadastro">
                              <div class="input-group-prepend">
                                <span style="background: white;" class="input-group-text">
                                    <i style="font-size: 21px;" class="fa fa-search" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444;">Rua:</b></label>
                            <input class="form-control" type="text" name="rua_cadastro" id="rua_cadastro" required>
                        </div>
                        <div class="col-md-4 form-group" style="width: 40%">
                            <label><b style="color: #444;">Número:</b></label>
                            <input class="form-control" type="number" name="numero_cadastro" id="numero_cadastro" required>
                        </div>
                        <div class="col-md-8 form-group" style="width: 60%">
                            <label><b style="color: #444;">Complemento:</b></label>
                            <input class="form-control" type="text" name="complemento_cadastro" id="complemento_cadastro">
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444;">Bairro:</b></label>
                            <input class="form-control" type="text" name="bairro_cadastro" id="bairro_cadastro" required>
                        </div>
                        <div class="col-md-6 form-group" style="width: 50%">
                            <label><b style="color: #444;">Cidade:</b></label>
                            <input class="form-control" type="text" name="cidade_cadastro" id="cidade_cadastro" required>
                        </div>
                        <div class="col-md-6 form-group" style="width: 50%">
                            <label><b style="color: #444;">Estado:</b></label>
                            <select style="font-size: 12px;" class="form-control" id="estado_cadastro" name="estado_cadastro" required>
                                <option value="" selected disabled> Selecione </option>
                            	<option value="AC">AC</option>
                            	<option value="AL">AL</option>
                            	<option value="AP">AP</option>
                            	<option value="AM">AM</option>
                            	<option value="BA">BA</option>
                            	<option value="CE">CE</option>
                            	<option value="DF">DF</option>
                            	<option value="ES">ES</option>
                            	<option value="GO">GO</option>
                            	<option value="MA">MA</option>
                            	<option value="MT">MT</option>
                            	<option value="MS">MS</option>
                            	<option value="MG">MG</option>
                            	<option value="PA">PA</option>
                            	<option value="PB">PB</option>
                            	<option value="PR">PR</option>
                            	<option value="PE">PE</option>
                            	<option value="PI">PI</option>
                            	<option value="RJ">RJ</option>
                            	<option value="RN">RN</option>
                            	<option value="RS">RS</option>
                            	<option value="RO">RO</option>
                            	<option value="RR">RR</option>
                            	<option value="SC">SC</option>
                            	<option value="SP">SP</option>
                            	<option value="SE">SE</option>
                            	<option value="TO">TO</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group text-right">
                            <button onclick="parte1()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-left" aria-hidden="true"></i> Anterior</button>
                            <button onclick="parte3()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-right" aria-hidden="true"></i> Próximo</button>
                        </div>
                    </div>
                    
                    <div class="row" id="parte4" style="display: none;">
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444;">Senha:</b></label><br>
                            <input class="form-control passwd" type="password" name="senha_cadastro" id="senha_cadastro" required>
                            <button type="button" class="see-pass" id="senha_btn"><em class="fa fa-eye"></em></button>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><b style="color: #444;">Confirmar Senha:</b></label><br>
                            <input class="form-control passwd" type="password" name="confirma_cadastro" id="confirma_cadastro" required>
                            <button type="button" class="see-pass" id="senha_btn2"><em class="fa fa-eye"></em></button>
                        </div>
                        <div class="col-md-12 form-group text-right">
                            <button onclick="parte2()" type="button" class="button-proximo btn btn-primary"><i style="font-size: 25px;" class="fa fa-arrow-circle-left" aria-hidden="true"></i> Anterior</button>
                            <button onclick="parte6()" type="submit" style="padding: 2px 14px;" class="btn btn-primary">Finalizar</button>
                        </div>
                    </div>
                
                </form>
            </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmaPag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><b>Pagar com transferência?</b></p>
        <?php if(isset($formatransfer)){ ?>
            <?php if($formatransfer['desconto_ativo_forma'] == 1 && $formatransfer['ativo_forma'] == 1){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <p>Desconto de <?php echo $formatransfer['desconto_forma'] ?>% na forma de pagamento por transferência.</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b>Compra:</b></label>
                        <input type="text" class="form-control" id="sub_transfer" disabled>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b>Desconto:</b></label>
                        <input type="text" class="form-control" id="desc_transfer" disabled>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b>Frete:</b></label>
                        <input type="text" class="form-control" id="frete_transfer" disabled>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><b>Total:</b></label>
                        <input type="text" class="form-control" id="total_transfer" disabled>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" style="background: #fc2db5; border-color: #fc2db5" class="btn btn-primary" data-callback='onSubmit6' data-action='submit'>Pagar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="logarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACESSAR A CONTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-login" action="<?php echo base_url('d41d8cd98f00b204e9800998ecf8427e') ?>" method="post">
          <div class="modal-body">
            <label class="custom-label">
                <b style="color: #444;">CPF:</b>
            </label>
            <input type="text" class="form-control cpf" id="cpf_modal" name="login" placeholder="Digite seu CPF" autocomplete="new-password" required>
            
            
            <label class="custom-label" style="margin-top: 5%!important;">
                <b style="color: #444;">Senha:</b>
            </label>
            <input type="password" class="form-control" id="senha_modal" name="pass" placeholder="Digite sua senha" autocomplete="new-password" required>
            
            <a style="position: relative;top: 6px;left: calc(100% - 110px);font-size: 13px; color: #444; cursor: pointer;" href="#" data-toggle="modal" data-target="#esqueciSenhaModal" onclick="esqueciSenha()">Esqueci a senha</a>
          </div>
          <div class="modal-footer">
            <button style="width: 120px;margin-right: auto;" type="button" class="btn btn-primary" data-callback='onSubmit4' data-action='submit'><b style="color: white">Cadastrar</b></button>
            <button style="width: 120px;" type="submit" class="btn btn-primary">Logar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="<?php echo base_url('recursos/js/material/plugins/sweetalert2.js'); ?>"></script>


<!-- SCRIPTS DO CARRINHO INICIO -->
<!-- SCRIPTS DO CARRINHO INICIO -->
<!-- SCRIPTS DO CARRINHO INICIO -->
<!-- SCRIPTS DO CARRINHO INICIO -->
<script>
    var gbl_correio = "";
    var gbl_valor   = 0;
</script>

<script>
    function esqueciSenha(){
        $('#logarModal').modal('hide');
    }
</script>

<script>
    function checkTransfer(){
         <?php if(isset($formatransfer)){ ?>
            <?php if($formatransfer['desconto_ativo_forma'] == 1 && $formatransfer['ativo_forma'] == 1){ ?>
                var sub         = $('#sbttl').val().replace('R$ ', '').replaceAll('.', '').replace(',', '.');
                var frete       = $('#subtotal').val().replace('R$ ', '').replaceAll('.', '').replace(',', '.');
                var por         = <?php echo $formatransfer['desconto_forma'] ?>;
                var total       = 0;
                var desconto    = 0;
                
                
                <?php if(isset($desconto)){ ?>
                    var old = $('#valordesconto').val().replace('R$ ', '').replaceAll('.', '').replace(',', '.');
                    desconto = (parseFloat(sub) * (por / 100)) + parseFloat(old);
                    total = parseFloat(frete) + parseFloat(sub) - parseFloat(desconto);
                <?php } else { ?>
                    desconto = sub * (por / 100);
                    total = parseFloat(frete) + parseFloat(sub) - parseFloat(desconto);
                <?php } ?>
                
                
                $('#sub_transfer').unmask().val(sub).mask("#.##0,00", {reverse: true});
                $('#sub_transfer').val('R$ ' + $('#sub_transfer').val());
                
                $('#desc_transfer').unmask().val(desconto.toFixed(2)).mask("#.##0,00", {reverse: true});
                $('#desc_transfer').val('- R$ ' + $('#desc_transfer').val());
                
                $('#frete_transfer').val($('#subtotal').val());
                
                $('#total_transfer').unmask().val(total.toFixed(2)).mask("#.##0,00", {reverse: true});
                $('#total_transfer').val('R$ ' + $('#total_transfer').val());
            <?php } ?>
        <?php } ?>
    }
</script>

<script>
    function onSubmit(token) {
        finaliza('com o vendedor');
    }
</script>

<script>
    $(document).ready(function() {
        var sess = sessionStorage.getItem("frete_sel");
        var val = sessionStorage.getItem("frete_val");

        $('#'+sess).attr('checked', true);
        SubPac(val, sess);
    });

    function SubPac(pac, tipo){
        console.log("<?php echo $this->session->userdata('correio'); ?>");
        var sub = <?php echo $valorTotal; ?>;
        
        sessionStorage.setItem('frete_sel', tipo);
        sessionStorage.setItem('frete_val', pac);
        
        <?php if(isset($desconto)){ ?>
            var desconto = <?php echo $desconto; ?>;
            var sum = (parseFloat(pac) + parseFloat(sub)) - parseFloat(desconto);
            $("#totalgeral").unmask().val(parseFloat(sum).toFixed( 2 )).mask("#.##0,00", {reverse: true});
        <?php } else {?>
            var sum = parseFloat(pac) + parseFloat(sub);
            $("#totalgeral").unmask().val(parseFloat(sum).toFixed( 2 )).mask("#.##0,00", {reverse: true});
        <?php } ?>
        
        $("#subtotal").unmask().val(parseFloat(pac).toFixed( 2 )).mask("#.##0,00", {reverse: true});
        
        gbl_correio     = tipo;
        gbl_valor       = pac;
        
        $('#subtotal').val('R$ ' + $('#subtotal').val());
        $('#totalgeral').val('R$ ' + $('#totalgeral').val());
    }
</script>

<script>
    function atualizacarrinho(){
        $('#fechaCarrinho').attr('action', '<?php echo base_url('afa44bc5ac8580b2cdd34d9e50e80db0') ?>');
        $('#fechaCarrinho').submit();
    }
</script>

<script>
    function remove(id){
        var input = '<input type="hidden" id="id_remove" name="id_remove" value="' + id + '">';
        $('#fechaCarrinho').append(input);
        $('#fechaCarrinho').attr('action', '<?php echo base_url('4de7d7673b8085024253a2236b14442b') ?>');
        $('#fechaCarrinho').submit();
    }

    function frete(){
        $('#form-cep').submit();
    }
</script>



<script>
    function finaliza(pagamento){
        <?php if($this->session->userdata('cliente_logado') == 1){ ?>
            <?php if($this->session->userdata('cliente_sem_endereco') == 1){ ?>
                abrirmodalendereco();
            <?php } else { ?>
                var frete_boolean = false;
                
                $('.fretes').each(function(){
                    if($(this).prop("checked")){
                        frete_boolean = true;
                    }    
                });
                
                if(frete_boolean == true){
                    var valor = gbl_valor;
                    var correio = gbl_correio;
                    
                    var input2 = '<input type="hidden" id="pagamento" name="pagamento" value="' + pagamento + '">';
                    var input = '<input type="hidden" id="correio" name="correio" value="' + correio + '">';
                    var input3 = '<input type="hidden" id="valorfrete" name="valorfrete" value="' + valor + '">';
                    $('#fechaCarrinho').append(input);
                    $('#fechaCarrinho').append(input2);
                    $('#fechaCarrinho').append(input3);
                    $('#fechaCarrinho').attr('action', '<?php echo base_url('FinalizaUnico/encerra2') ?>');
                    $('#fechaCarrinho').submit();  
                } else {
                    window.scrollTo(0, 300);
                    alertfrete();
                }
            <?php } ?>
        <?php } else { ?>
            alertlogin();
        <?php } ?>
    }
</script>

<script>
    function aumentar(id){
        document.getElementById("qtd_"+id).stepUp(1);
        atualizacarrinho();
    }
    
    function diminuir(id){
        document.getElementById("qtd_"+id).stepDown(1);   
        atualizacarrinho();
    }
</script>

<!-- SCRIPTS DO CARRINHO FIM -->
<!-- SCRIPTS DO CARRINHO FIM -->
<!-- SCRIPTS DO CARRINHO FIM -->
<!-- SCRIPTS DO CARRINHO FIM -->

<script>
    function parte1(){
        validacpf();
        
        var nome       = $('#nome_cadastro').val();
        var nascimento = $('#nascimento_cadastro').val();
        
        if (validacao == true){
            if (nome != "" && nome != " "){
                if (nascimento != ""){
                $('#parte1').hide(); //contato
                $('#parte2').show();
                $('#parte3').hide();
                $('#parte4').hide();
                }else{
                   document.getElementById('nascimento_cadastro').setCustomValidity('Escolha uma data de nascimento!');
                   document.getElementById('nascimento_cadastro').reportValidity(); 
                }
            }else{
                document.getElementById('nome_cadastro').setCustomValidity('Nome Inválido!');
                document.getElementById('nome_cadastro').reportValidity();
            }
        }
    }
</script>

<script>
    function parte2(){
        var telefone = $('#telefone_cadastro').val().length;
        var email    = $('#email_cadastro').val();
        
        if (telefone == 15 || telefone == 14){
            if (email != "" && email != " "){
                $('#parte1').hide(); //endereço
                $('#parte2').hide();
                $('#parte3').show();
                $('#parte4').hide();
            }else {
                document.getElementById('email_cadastro').setCustomValidity('Email Inválido!');
                document.getElementById('email_cadastro').reportValidity();  
            }
        }else{
            document.getElementById('telefone_cadastro').setCustomValidity('Número Inválido!');
            document.getElementById('telefone_cadastro').reportValidity();
        }
    }
</script>

<script>
    function parte3(){
        cep         = $('#cep_cadastro').val();
        rua         = $('#rua_cadastro').val();
        numero      = $('#numero_cadastro').val();
        bairro      = $('#bairro_cadastro').val();
        cidade      = $('#cidade_cadastro').val();
        estado      = $('#estado_cadastro').val();
        
        if (cep != "" && cep != " "){
            if (rua != "" && rua != " "){
                if (numero != "" && numero != " "){
                    if (bairro != "" && bairro != " "){
                        if (cidade != "" && cidade != " "){
                            if (estado != "" && estado != " "){
                                $('#parte1').hide(); //cadastro
                                $('#parte2').hide();
                                $('#parte3').hide();
                                $('#parte4').show();
                            }else{
                                document.getElementById('estado_cadastro').setCustomValidity('Estado Inválido!');
                                document.getElementById('estado_cadastro').reportValidity();
                            }
                        }else{
                            document.getElementById('cidade_cadastro').setCustomValidity('Cidade Inválida!');
                            document.getElementById('cidade_cadastro').reportValidity();
                        }
                    }else{
                        document.getElementById('bairro_cadastro').setCustomValidity('Bairro Inválido!');
                        document.getElementById('bairro_cadastro').reportValidity();
                    }
                }else{
                    document.getElementById('numero_cadastro').setCustomValidity('Número Inválido!');
                    document.getElementById('numero_cadastro').reportValidity();
                }
            }else {
                document.getElementById('rua_cadastro').setCustomValidity('Rua Inválida!');
                document.getElementById('rua_cadastro').reportValidity();
            }
        }else{
            document.getElementById('cep_cadastro').setCustomValidity('CEP Inválido!');
            document.getElementById('cep_cadastro').reportValidity();
        }    
    }
</script>

<script>
    function parte5(){
        $('#parte1').show();
        $('#parte2').hide();
        $('#parte3').hide();
        $('#parte4').hide();
    }
</script>

<script>
	    function parte6(){  
	        var senha  = $('#senha_cadastro').val().length;
	        var senha2 = $('#confirma_cadastro').val().length;
            
                if(senha >= 6){
                     if (senha2 >= 6) {
                         if($('#senha_cadastro').val() == $('#confirma_cadastro').val()){
                             $('#cadastro').submit(); 
                         }else{
                            alertsenhadif();
                         }
                     }else{
                        document.getElementById('confirma_cadastro').setCustomValidity('Senha Inválida!');
                        document.getElementById('confirma_cadastro').reportValidity();
                    }    
	            }else{
	                document.getElementById('senha_cadastro').setCustomValidity('Senha Inválida!');
                    document.getElementById('senha_cadastro').reportValidity(); 
	            }
	    }        
</script>

<script>
    function autofillCEP2(){
        var aux = $('#cep_cadastro').val();
        var cep = aux.replace(/\D/g,'');
        if(cep.length == 8){
            dados = new FormData();
            dados.append('cep', cep);
            $.ajax({
                url: '<?php echo base_url('00af9148767db1213585b339276df4e6'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if(data != "null" && data != "" && data != " " && data != null){
                        cep = jQuery.parseJSON(data);
                        var ce = cep.cep_cidadeuf.split('/');
                        $('#cep_cadastro').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#cidade_cadastro').val(ce[0]);
                        $('#estado_cadastro').val(ce[1]).change();
                        $('#bairro_cadastro').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#rua_cadastro').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#rua_cadastro').val(rua[0]);
                        }else{
                            $('#rua_cadastro').val(cep.cep_rua);
                        }
                        ativo();
                    }
                },
            });
        }
    }
</script>



    
<script>
    function autofillCEP(){
        var aux = $('#cep-modal').val();
        var cep = aux.replace(/\D/g,'');
        if(cep.length == 8){
            dados = new FormData();
            dados.append('cep', cep);
            $.ajax({
                url: '<?php echo base_url('00af9148767db1213585b339276df4e6'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if(data != "null" && data != "" && data != " " && data != null){
                        cep = jQuery.parseJSON(data);
                        var ce = cep.cep_cidadeuf.split('/');
                        $('#cep-modal').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#cidade-modal').val(ce[0]);
                        $('#estado-modal').val(ce[1]).change();
                        $('#bairro-modal').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#rua-modal').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#rua-modal').val(rua[0]);
                        }else{
                            $('#rua-modal').val(cep.cep_rua);
                        }
                        ativo();
                    }
                },
            });
        }
    }
</script>
    
	
    
<script>
        $(document).ready(function(){
            $('.date').mask('00/00/0000');
            $('.cep').mask('00000-000');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            var SPMaskBehavior = function (val) {
              return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
              onKeyPress: function(val, e, field, options) {
                  field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            
            $('.telefone').mask(SPMaskBehavior, spOptions);
            
            <?php if($this->session->userdata('frete_tipo')){ ?>
                var frete = '<?php echo $this->session->userdata('frete_tipo'); ?>';
                $('.fretes').each(function(){
                    if($(this).attr('id') == frete) {
                        $(this).prop('checked', true);
                    }
                });
            <?php } ?>
            
            
            
            <?php if(isset($login_erro)){ if($login_erro == 1){
                echo "alerterrado();";
            } } ?>
            <?php if(isset($login_erro)){ if($login_erro == 2){
                echo "alertcpf();";
            } } ?>
            <?php if(isset($login_erro)){ if($login_erro == 3){
                echo "alertname();";
            } } ?>
            <?php if(isset($login_erro)){ if($login_erro == 4){
                echo "alertsenha();";
            } } ?>
            <?php if(isset($login_erro)){ if($login_erro == 5){
                echo "alertsucesso();";
            } } ?>
        })
</script>
    
<script>
    function abrirmodalendereco(){
        $('#confirmaPag').modal('hide');
        $("#enderecoModal").modal();
    }
</script>

<script>
    function abrirmodalcadastro(cpf){
        $('#cpf_cadastro').val(cpf);
        $("#cadastroModal").modal();
    }
</script>


<!-- SCRIPTS LOGIN INICIO -->
<!-- SCRIPTS LOGIN INICIO -->
<!-- SCRIPTS LOGIN INICIO -->
<!-- SCRIPTS LOGIN INICIO -->

<script>
       function onSubmit3(token) {
            document.getElementById("form-login").submit();
       }
</script>
    
<script>
   function onSubmit4(token) {
        $('#logarModal').modal('hide');
        abrirmodalcadastro($('#login_usuario').val());
   }
</script>

<script>
    $('#senha_btn').on('click', function(){
        const type = $('#senha_cadastro').prop('type') === 'password' ? 'text' : 'password';
        $('#senha_cadastro').prop('type', type);
        if(type == "text"){
            $('#senha_btn').children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $('#senha_btn').children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
    
    $('#senha_btn2').on('click', function(){
        const type = $('#confirma_cadastro').prop('type') === 'password' ? 'text' : 'password';
        $('#confirma_cadastro').prop('type', type);
        if(type == "text"){
            $('#senha_btn2').children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $('#senha_btn2').children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
</script>
    
<!-- SCRIPTS LOGIN FIM -->
<!-- SCRIPTS LOGIN FIM -->
<!-- SCRIPTS LOGIN FIM -->
<!-- SCRIPTS LOGIN FIM -->

    
<script>
        function alertlogin(){
            $('#confirmaPag').modal('hide');
            $('#logarModal').modal('show');
            $('#cpf_modal').focus();
        }
    
        function alerterrado(){
            Swal.fire({
               type: 'error',
               text: 'Usuário ou senha errado(s)!',
            });
        }
        
        function alertsucesso(){
            Swal.fire({
               type: 'success',
               text: 'Cadastro realizado com sucesso!',
            });
        }
    
        function alertcpf(){
            Swal.fire({
               type: 'error',
               text: 'CPF já cadastrado, tente novamente!',
            });
        }
    
        function alertname(){
            Swal.fire({
               type: 'error',
               text: 'Digite um nome, tente novamente!',
            });
        }
    
        function alertsenha(){
            Swal.fire({
               type: 'error',
               text: 'A senha deve ter mais de seis caracteres, tente novamente!',
            });
        }
    
        function alertfrete(){
            Swal.fire({
               type: 'error',
               text: 'Selecione o frete, para continuar a compra!',
            });
        }
    
        function alertpagamento(){
            Swal.fire({
               type: 'error',
               text: 'Selecione uma forma de pagamento, para continuar a compra!',
            });
        }
        
        function alertsenhadif(){
            Swal.fire({
               type: 'error',
               text: 'As senhas são diferentes, tente novamente!',
            });
        }
    </script>

    
<!--
<script>
    function compra(){
        let timerInterval
            Swal.fire({
                title: 'Obrigado pelo seu pedido',
                html: 'Aguarde o andamento no seu e-mail.',
                timer: 6000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                }
                            }
                        }, 200)
                    },
                willClose: () => {
                        clearInterval(timerInterval)
                    }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
            setTimeout(redirectPedido, 6500);
    }
    
    function redirectPedido(){
        location.replace("<?php echo base_url('conta#pedidos');?>");
    }
</script>
-->

<script>
    function validacpf(){
         var id = 'cpf_cadastro';
            
            strCPF = document.getElementById(id).value;
            strCPF = strCPF.replace('-', '');
            strCPF = strCPF.replace('.', '');
            strCPF = strCPF.replace('.', '');
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000" ||
                strCPF == "11111111111" ||
                strCPF == "22222222222" ||
                strCPF == "33333333333" ||
                strCPF == "44444444444" ||
                strCPF == "55555555555" ||
                strCPF == "66666666666" ||
                strCPF == "77777777777" ||
                strCPF == "88888888888" ||
                strCPF == "99999999999" ) {
                valCpfCartao = false;
                document.getElementById(id).setCustomValidity('CPF Inválido!');
                document.getElementById(id).reportValidity();
            }else if(strCPF == ""){
                document.getElementById(id).setCustomValidity('');
            }else{
                for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ){
                    valCpfCartao = false;
                    document.getElementById(id).setCustomValidity('CPF Inválido!');
                    document.getElementById(id).reportValidity();
                }else{
                    Soma = 0;
                    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                    Resto = (Soma * 10) % 11;
                    if ((Resto == 10) || (Resto == 11))  Resto = 0;
                    if (Resto != parseInt(strCPF.substring(10, 11) ) ){ 
                        valCpfCartao = false;
                        document.getElementById(id).setCustomValidity('CPF Inválido!');
                        document.getElementById(id).reportValidity();
                    }else{
                        valCpfCartao = true;
                        return validacao = true;
                    }
                }
            }
            
    }
</script>

<script>
    function inicio(){
        window.parent.location.replace("<?php echo base_url();?>");
    }
</script>

    