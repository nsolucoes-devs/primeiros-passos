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
        <title>Relatório de Pedidos Sintético</title>
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
                    <h5><b><?php echo mb_strtoupper($configs['nome_empresa']) ?></b> - <?php echo date('d/m/Y | H:i') ?></h5>
                    <h4><b>RELATÓRIO DE PEDIDOS SINTÉTICO</b></h4>
                    <?php if(isset($filtros)){ ?>
                        <p class="text-center" style="font-size: 8px">
                            <?php if($filtros['status']) { echo 'Filtro Status: '. $filtros['status']['nomeStatusCompra']; } ?>
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
                <div class="col-md-12 form-group">
                    <table style='width: 100%'>
                        <thead>
                            <tr style="font-size: 11px; border-bottom: 2px solid lightgrey;border-top: 2px solid lightgrey; padding: 3px">
                                <th style="padding: 10px; width: 7%"><b>PEDIDO</b></th>
                                <th style="width: 20%"><b>NOME</b></th>
                                <th style="width: 12%"><b>CPF</b></th>
                                <th style="width: 33%"><b>ENDEREÇO</b></th>
                                <th style="width: 10%"><b>Pagamento</b></th>
                                <th class="text-center" style="width: 11%"><b>DATA/HORA</b></th>
                                <th class="text-center" style="width: 8%"><b>TOTAL</b></th>
                                <th class="text-center" style="width: 11%"><b>STATUS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pedidos['pedidos'] as $p){ ?>
                                <tr style="border-bottom: 1px solid lightgrey; font-size: 11px">
                                    <td style="padding: 7px;"><?php echo $p['idpedido'] ?></td>
                                    <td><?php echo ucwords(mb_strtolower($p['cliente'])) ?></td>
                                    <td class="cpf"><?php echo $p['cpf'] ?></td>
                                    <td><?php echo ucwords(mb_strtolower($p['e_endereco'])) ?>, <?php echo $p['e_numero'] ?>, <?php echo ucwords(mb_strtolower($p['e_bairro'])) ?>, <?php echo ucwords(mb_strtolower($p['e_cidade'])) ?>, <?php echo $p['e_estado'] ?></td>
                                    <td><?php echo ucwords(mb_strtolower($p['forma'])) ?></td>
                                    <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($p['cadastro'])) ?></td>
                                    <td class="text-center">R$ <?php echo number_format($p['total'],2,',','.') ?></td>
                                    <td class="text-center"><?php echo ucwords(mb_strtolower($p['status'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-right">
                    <h4><b>TOTAL GERAL:R$ <?php echo number_format($pedidos['total_geral'],2,',','.') ?></b></h4>
                </div>
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
            $('.cpf').mask('000.000.000-00', {reverse: true});
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