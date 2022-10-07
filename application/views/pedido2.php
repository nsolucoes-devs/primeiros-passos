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
        body{
            background-color: #fafafa!important;
        }
        btn-main{
            font-size: 11px;
            margin-top: -4px;
            color: white;
            border: 2px solid #3a0b0c;
            background-color: #3a0b0c;
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            line-height: 1.5;
            background-clip: padding-box;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            cursor: pointer;
        }
        
        .btn::before {
           background: #291402;
       }
       .marrom-padrao {
            color: saddlebrown;
       }
       p{
           line-height: 15px;
       }
       h6{
           font-family: "Poppins",sans-serif;
       }
       .grecaptcha-badge{
           display: none!important;
       }
        .custom-card{
            width: calc(100% - 8px);
            border-radius: 5px;
            background-color: white;
            margin: 4px 4px 0 4px;
            box-shadow: 5px 6px 10px -9px #000000;
            border: 0;
            padding: 15px;
            border: 1px solid #e8e8e8;
        }
       
       #nome-produto{
           margin-top: auto; margin-bottom: auto;
       }
       #qtd-produto{
           padding-top: 40px;
           color: #444;
       }
       #preco-produto{
            padding-top: 45px;
            color: #444;
       }
       #total-produto{
           padding-top: 45px;
           color: #444;
       }
       #th-qtd{
           width: 10%;
           color: saddlebrown;
       }
       #th-nome{
           width: 55%;
           color: saddlebrown;
       }
       
       .titulo-banco{
            margin-bottom: 20px;
       }
       
       #final-modal{
            margin-top: 3%!important;
        }
        
        .p-transfer{
            line-height: 17px;
            margin: 5px;
        }
        
        .p-vendedores{
            font-size: 20px;
            display: inline;
            color: black;
        }
        .p-vendedores:hover{
            color: #72d872;
        }
        .n-pedido{
            color: #24aeef;
            font-size: 20px;
            font-weight: 900;
            position: absolute;
        }
       
       @media(max-width: 500px){
            #nome-produto{
                text-align: center!important;
                margin-top: 10%!important;
            }
            #qtd-produto{
               padding-top: 20%;
               color: #444;
           }
           #preco-produto{
                padding-top: 17%;
                color: #444;
           }
           #total-produto{
               padding-top: 17%;
               color: #444;
           }
           #th-qtd{
               padding-bottom: 6%;
               width: 10%;
               color: saddlebrown;
           }
           #th-nome{
               padding-bottom: 6%;
               width: 55%;
               color: saddlebrown;
           }
           #pix-modal {
               margin-bottom: 35px!important;
           }
            .titulo-banco{
                margin-bottom: 15px;
            }
            #final-modal{
                margin-top: 0!important;
            }
            .p-transfer{
                line-height: 15px;
            }
            .n-pedido{
                position: inherit;
            }
        }
    </style>
    <section class="contact-section" style="padding: 20px 15px 30px!important">
        <div class="custom-card" style="padding: 5px">
            <div class="row">
                <div class="col-md-12 form-group text-left" style="cursor: pointer;">
                    <div class="row">
                        <div class="col-md-6 col-4">
                            <i onclick="redirect()" class="botao-voltar fa fa-reply" aria-hidden="true"><span style="font-size: 14px;font-family: sans-serif;font-weight: bold;"> Voltar</span></i>
                        </div>
                        <div class="col-md-6 col-7 text-right" <?php if($mobile == 1) { 'style="padding: 0"'; } ?>>
                            <i data-toggle="modal" data-target="#transferModal" class="botao-voltar fa fa-users" aria-hidden="true"> <span style="font-size: 14px;font-family: sans-serif;font-weight: bold;"> Vendedores</span></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group text-center" style="padding-top: 13px;">
                    <h4 style="color: #444">PEDIDO N° <?php echo $pedido['idpedido'] ?></h4>
                    <?php if($pedido['forma'] == 'boleto'){ ?>
                        <h6 style="color:#444; position:absolute; margin-top:-4%; margin-left:30%;">Vencimento em <?php echo date("d/m/Y", strtotime($pedido['vencimento'])); ?></h6>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <?php if($mobile == 1){ ?>
                        <?php foreach($pedido['produtos'] as $p) { ?>
                            <div class="col-md-12 produto" id="produto" style="padding: 8px; max-height: 195px;">
                                <div class="row form-group">
                                    <div class="col-3 col-md-3 col-lg-3">
                                        <img style="height: 80px; width: auto;" src="<?php echo base_url('imagens/produtos/') . $p['produto_id'] . '.jpg'; ?>">
                                    </div>
                                    <div class="col-9 col-md-9 col-lg-9">
                                        <p style="font-size: 11px; color: #444!important;"><b style="color: #444!important">Produto:</b></p>
                                        <p style="color: #9c9c9c!important;position: absolute;top: 70px;font-size: 10px;"><?php echo $p['produto_opcao']; ?></p>
                                        <p style="color: #444!important;"><?php echo $p['produto_nome']; ?></p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-3 col-md-3 col-lg-3 text-center">
                                        <p style="font-size: 11px; color: #444!important;"><b style="color: #444!important">Valor Unitário:</b></p>
                                        <p style="font-size: 15px; color: #444!important;">R$<?php echo str_replace(".", ",", $p['produto_valor']); ?></p>
                                    </div>
                                    <div class="col-3 col-md-3 col-lg-3  text-center">
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important">Qtd.:</b></p>
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important"><?php echo $p['produto_quantidade'] ?></b></p>
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6 text-center">
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important">Valor Total:</b></p>
                                        <p style=" font-size: 18px; color: #444!important;"><b style="color: #444!important"><?php echo number_format($p['produto_valor'] * $p['produto_quantidade'], 2,',','.'); ?></b></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else {?>
                        <table class="table">
                            <thead>
                                <tr style="background-color: #24aeef">
                                    <th style="width: 50%; color: white;" scope="col">Produto(s)</th>
                                    <th class="text-center" style="width: 15%; color: white;" scope="col">Valor Unitário</th>
                                    <th style="width: 15%; color: white;" class="text-center" scope="col">Quantidade</th>
                                    <th style="width: 15%; color: white;" class="text-center" scope="col">Valor Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pedido['produtos'] as $p) { ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3" style="width: 25%">
                                                    <img style="height: 80px; width: auto;" src="<?php echo base_url('imagens/produtos/') . $p['produto_id'] . '.jpg'; ?>">
                                                </div>
                                                <div class="col-md-9" style="width: 75%">
                                                    <p style="color: #9c9c9c!important;position: absolute;top: 50px;"><?php echo $p['produto_opcao']; ?></p>
                                                    <p style="color: #444!important;"><?php echo $p['produto_nome']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p style="font-size: 15px; color: #444!important;">R$<?php echo str_replace(".", ",", $p['produto_valor']); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important"><?php echo $p['produto_quantidade'] ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <p style=" font-size: 18px; color: #444!important;"><b style="color: #444!important">R$ <?php echo number_format($p['produto_valor'] * $p['produto_quantidade'], 2,',','.'); ?></b></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <hr style="height: 1px; border-color: lightgrey; margin-top:0; margin-bottom: 25px">
                
                <div class="col-md-12 form-group">
                    <?php if($pedido['forma'] == 'boleto'){ ?>
                        <a href="<?php echo $pedido['boleto'];?>" target="_blank"><i style="margin-top: 10px; border: 1px solid white; padding: 7px; border-radius: 5px; background-color: white; font-size: 19px; color: #da00d3; border: 2px solid #da00d3;" class="fa fa-money" aria-hidden="true"> Gerar Boleto</i></a>
                        <i style="margin-top: 10px; border: 1px solid white; padding: 7px; border-radius: 5px; background-color: white; font-size: 19px; color: #da00d3; border: 2px solid #da00d3;" class="fa fa-money" aria-hidden="true"> Linha digitável: <?php echo $pedido['codigoBarras'];?></i>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="col-md-12 text-center">
                        <h4 style="color: #444">DETALHES PEDIDO</h4>
                    </div>
                    <hr style="height: 1px; border-color: lightgrey; margin-top:0; margin-bottom: 25px">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6" style="width: 50%">
                                        <p style="color: #444"><b style="color: #444">Produto(s):</b></p>
                                    </div>
                                    <div class="text-right col-md-6" style="width: 50%">
                                        <p style="color: #444">R$ <span id="sub_total"><?php echo number_format($pedido['total'],2,',','.') ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6" style="width: 50%">
                                        <p style="color: #444"><b style="color: #444">Frete:</b></p>
                                    </div>
                                    <div class="text-right col-md-6" style="width: 50%">
                                        <p style="color: #444">R$ <span id="frete"><?php echo number_format($pedido['frete_valor'],2,',','.') ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6" style="width: 50%">
                                        <p style="color: #444"><b style="color: #444">Desconto:</b></p>
                                    </div>
                                    <div class="text-right col-md-6" style="width: 50%">
                                        <p style="color: #444">R$ <span id="desconto"><?php echo number_format($pedido['desconto'],2,',','.') ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6" style="width: 50%">
                                        <h5 style="color: #444">TOTAL</h5>
                                    </div>
                                    <div class="text-right col-md-6" style="width: 50%">
                                        <h5>R$ <span id="total"><?php echo number_format($pedido['total'] + $pedido['frete_valor'] - $pedido['desconto'],2,',','.') ?></span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if($mobile == 1){ ?>
                                <div class="col-md-12">
                                    <hr style="height: 1px">
                                </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <div class="row" style="line-height: 12px">
                                    <div class="col-md-4" style="width: 40%">
                                        <p><b style="color: #444; font-size: 13px">Status:</b></p>
                                        <p><b style="color: #444; font-size: 13px">Pagamento:</b></p>
                                        <p><b style="font-size: 13px; color: #444">Envio:</b></p>
                                    </div>
                                    <div class="col-md-8" style="width: 60%">
                                        <p style="font-size: 13px"><?php echo $pedido['status'] ?></p>
                                        <p style="font-size: 13px"><?php echo $pedido['forma'] ?></p>
                                        <p style="font-size: 13px"><?php echo $pedido['frete'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <div style="margin-top: 1%">
                        <div class="col-md-12 text-center">
                            <h4 style="color: #444">HISTÓRICO</h4>
                        </div>
                        <div class="table-responsive" style="width: 100%">
                            <table class="table">
                                <thead>
                                    <tr style="background-color: #24aeef">
                                        <th style="width: 15%; color: white;" scope="col">Data/hora</th>
                                        <th class="text-center" style="width: 50%; color: white;" scope="col">Histórico</th>
                                        <th style="width: 15%; color: white;" class="text-center" scope="col">Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($pedido['historico_devolucao']) { ?>
                                        <?php foreach($pedido['historico_devolucao'] as $h_d){ ?>
                                            <tr style="font-size: 14px; color: #444" class="produto">
                                                <td><?php echo date('d/m/Y', strtotime($h_d['historico_data'])) . ' ' . date('H:i', strtotime($h_d['historico_hora'])) ?></td>
                                                <td><?php echo $h_d['historico_comentario'] ?></td>
                                                <td class="text-center"><?php echo $h_d['historico_status'] ?></td>
                                            </tr>
                                    <?php } } ?>
                                    <?php foreach($pedido['historico'] as $h){ ?>
                                        <tr style="font-size: 14px; color: #444" class="produto">
                                            <td><?php echo $h['historico_data'] . ' ' . $h['historico_hora'] ?></td>
                                            <td><?php echo $h['historico_comentario'] ?></td>
                                            <td class="text-center"><?php echo $h['historico_status'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
<!-- Modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document" <?php if($mobile == 0) { echo 'style="margin: 5% 0 0 20%;"'; } ?>>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferModalLabel" style="text-align: center!important; flex: auto;">CONCLUA SEU PEDIDO C/NOSSOS VENDEDORES</h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <?php foreach($vendedores as $v){ ?>
                <div class="col-md-12 form-group">
                    <a onclick="libera()" title="WhatsApp" href="https://api.whatsapp.com/send?text=<?php echo $mensagem ?>&phone=55<?php echo $v['vendedor_whats'] ?>" target="_blank"> 
                        <i style="color: #72d872; font-size: 29px" class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;
                        <p class="p-vendedores"><b><?php echo $v['vendedor_nome'] ?></b></p>
                    </a>
                </div>
            <?php } ?>
        </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
            <div class="row" style="width: 100%">
                <div class="text-center col-md-12 col-12" style="padding: 0; padding-top: 10px!important;">
                    <p class="n-pedido">N° do pedido: <?php echo $pedido['idpedido'] ?></p>
                    <p style="color: #24aeef; font-size: 20px;font-weight: 900;">Total do Pedido: <b><span style="font-size: 20px!important;">R$ <?php echo number_format($pedido['total'] + $pedido['frete_valor'] - $pedido['desconto'],2,',','.') ?></span></b></p>   
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    
<script>
    $(document).ready(function(){
        $('#transferModal').modal('show');
    })
</script>

<script>
    function libera(){
        $('#transferModal').modal('hide');
    }
</script>


<script>
    function redirect(){
        window.parent.location.href = '<?php echo base_url(); ?>'; 
    };
</script>