<!DOCTYPE html>
<html lang="en">
    

    
    <style>
        @page {
            margin: 35pt 10pt 50pt 10pt;
            counter-increment: page;
            @bottom-center {
              content: "Page " counter(page);
            }
        }
    </style>

    <head>
        <title>Relatório de Pedidos Detalhado</title>
        <link href="<?php echo base_url('assets/admin/');?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/admin/');?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>css/style-responsive.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
        <title>.</title>
    </head>
    <body>
        <section id="container" style="position: relative; margin-right: 1%; margin-left: 1%; width: 98%">
            <div class="row" style="margin-bottom: 10px; display: inline;">
                <div class="col-md-12 form-group text-center">
                    <img id="imagem" src="<?php echo base_url('imagens/site/logo2.png') ?>" style="width: 300px; height: auto;">
                </div>
                <div class="col-md-12 form-group text-center">
                    <h5><b><?php echo mb_strtoupper($configs['nome_empresa']) ?> - <?php echo date('d/m/Y | H:i') ?></b></h5>
                    <h4><b>RELATÓRIO DE PEDIDOS DETALHADO</b></h4>
                    <?php if(isset($filtros)){ ?>
                        <p class="text-center" style="font-size: 8px">
                            <?php if($filtros['produto']) { echo 'Filtro Produto: '. $filtros['produto']['produto_nome']; } ?>
                            <?php if($filtros['status']) { echo '<span>  |  </span>Filtro Status: '. $filtros['status']['nomeStatusCompra']; } ?>
                            <?php if($filtros['forma_pagamento']) { echo '<span>  |  </span>Filtro Forma Pagamento: '. $filtros['forma_pagamento']; } ?>
                            <?php if($filtros['datainicio']) { echo '<span>  |  </span>Filtro Data Início: '. $filtros['datainicio']; } ?>
                            <?php if($filtros['datafim']) { echo '<span>  |  </span>Filtro Data Fim: '. $filtros['datafim']; } ?>
                            <?php if($filtros['estado']) { echo '<span>  |  </span>Filtro Estado: '. $filtros['estado']; } ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group" style="text-align: right">
                    <button id="btn" type="button" class="btn btn-primary" style="border-color: #1b9045!important; color: white; background-color: #1b9045!important; right: 0; float: right; margin-right: 20px;" onclick="pdf()">Relatório PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-left" style="margin-bottom: 10px; margin-top: 0px;">
                </div>
            </div>
            <div class="row">
                <?php foreach($pedidos['pedidos'] as $p){ ?>
                <div class="col-md-12 form-group">
                    <table style='width: 100%'>
                        <thead>
                            <tr style="font-size: 11px; border-bottom: 2px solid lightgrey;border-top: 2px solid lightgrey; padding: 3px">
                                <th style="width: 7%; padding: 5px;"><b>PEDIDO</b></th>
                                <th style="width: 20%"><b>NOME</b></th>
                                <th style="width: 15%"><b>CPF</b></th>
                                <th style="width: 30%"><b>ENDEREÇO</b></th>
                                <th class="text-center" style="width: 10%"><b>PAGAMENTO</b></th>
                                <th style="width: 10%"><b>TELEFONE</b></th>
                                <th style="width: 10%"><b>STATUS</b></th>
                                <th style="width: 10%"><b>DATA/HORA</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="font-size: 12px">
                                <td style="padding: 3px;"><?php echo $p['idpedido'] ?></td>
                                <td><?php echo ucwords(mb_strtolower($p['cliente'])) ?></td>
                                <td class="cpf"><?php echo $p['cpf'] ?></td>
                                <td><?php echo ucwords(mb_strtolower($p['e_endereco'])) ?>, <?php echo $p['e_numero'] ?>, <?php echo ucwords(mb_strtolower($p['e_bairro'])) ?>, <?php echo ucwords(mb_strtolower($p['e_cidade'])) ?>, <?php echo $p['e_estado'] ?>, <span class="cep"><?php echo $p['e_cep'] ?></span></td>
                                <td class="text-center"><?php echo ucwords(mb_strtolower($p['forma'])) ?></td>
                                <td class="telefone"><?php echo $p['telefone'] ?></td>
                                <td><?php echo ucwords(mb_strtolower($p['status'])) ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($p['cadastro'])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12" style="padding: 5px;border:1px solid lightgrey; border-radius: 5px">
                        <table style='width: 100%'>
                            <thead>
                                <tr>
                                    <th><b>CÓDIGO</b></th>
                                    <th><b>PRODUTO</b></th>
                                    <th><b>MODELO</b></th>
                                    <th><b>QTD.</b></th>
                                    <th><b>VALOR UNITÁRIO</b></th>
                                    <th><b>VALOR TOTAL</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($p['produtos'] as $produto){ ?>
                                    <tr>
                                        <td><?php echo $produto['produto_codigo'] ?></td>
                                        <td><?php echo $produto['produto_nome'] ?></td>
                                        <td><?php echo $produto['produto_modelo'] ?></td>
                                        <td><?php echo $produto['produto_quantidade'] ?></td>
                                        <td>R$ <?php echo number_format($produto['produto_valor'],2,',','.') ?></td>
                                        <td>R$ <?php echo number_format($produto['produto_quantidade'] * $produto['produto_valor'],2,',','.') ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="padding-top: 10px;" class="text-right"><b>ACRECIMO: </b></td>
                                    <td style="padding-top: 10px;" ><b>R$ <?php echo number_format($p['acrescimo'],2,',','.') ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><b>FRETE: </b></td>
                                    <td><b>R$ <?php echo number_format($p['frete_valor'],2,',','.') ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><b>DESCONTO: </b></td>
                                    <td><b>R$ <?php echo number_format($p['desconto'],2,',','.') ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><b>TOTAL: </b></td>
                                    <td><b>R$ <?php echo number_format($p['total'],2,',','.') ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-12 text-right">
                <h3><b>TOTAL GERAL:R$ <?php echo number_format($pedidos['total_geral'],2,',','.') ?></b></h3>
            </div>
            <br>
        </section>
        
        <footer id="footer" style="position: fixed; bottom: 0px; text-align: center; width: 100%; margin-bottom: -13px; display: none; clear: both;">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td style="margin-left: 10px; width> 50%; text-align: right"><p><b style="font-size: 12px; margin-right: 15px;">Gestão de Ecommerce | N Soluções</b></p></td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </body>
    
    <script src="<?php echo base_url('assets/admin/');?>lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/') ?>js/jquery_mask/dist/jquery.mask.min.js"></script>
    
    <script>
        $(document).ready(function(){
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
            
        });
        
        
    </script>
    <script>
            function pdf(){
                $('#btn').css('display', 'none');
                $('#footer').css('display', 'block');
                window.print();
                $('#footer').css('display', 'none');
                $('#btn').css('display', 'block');
            }
        </script>
</html>