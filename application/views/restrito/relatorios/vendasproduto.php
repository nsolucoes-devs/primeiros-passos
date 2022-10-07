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
        <title>Relatório de Vendas Produtos</title>
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
                    <h4><b>RELATÓRIO DE VENDAS POR PRODUTO</b></h4>
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
                <div class="col-md-12 form-group">
                    <table style='width: 100%'>
                        <thead>
                            <tr style="font-size: 14px; border-bottom: 5px solid lightgrey;border-top: 2px solid lightgrey; padding: 3px">
                                <th style="padding: 10px; width: 35%"><b>PRODUTO NOME</b></th>
                                <th class="text-center" style="width: 12%"><b>QUANTIDADE</b></th>
                                <th class="text-center" style="width: 12%"><b>APROVADO</b></th>
                                <th class="text-center" style="width: 12%"><b>NEGADO</b></th>
                                <th class="text-center" style="width: 17%"><b>AGUARDANDO PAGAMENTO</b></th>
                                <th class="text-center" style="width: 12%"><b>TOTAL</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos['itens'] as $p){ ?>
                                <tr style="border-bottom: 1px solid lightgrey; font-size: 12px">
                                    <td style="padding: 7px;"><?php echo ucwords(mb_strtolower($p['nome'])) ?></td>
                                    <td class="text-center"><?php echo $p['quantidade'] ?></td>
                                    <td class="text-center">R$ <?php echo number_format($p['total_aprovado'],2,',','.') ?></td>
                                    <td class="text-center">R$ <?php echo number_format($p['total_negado'],2,',','.') ?></td>
                                    <td class="text-center">R$ <?php echo number_format($p['total_aguardando'],2,',','.') ?></td>
                                    <td class="text-center">R$ <?php echo number_format($p['total'],2,',','.') ?></td>
                                </tr>
                            <?php } ?>
                            <tr style="border-top: 2px solid lightgrey; font-size: 13px">
                                <td><b>TOTAL</b></td>
                                <td style="padding: 12px;" class="text-center"><b>QUANTIDADE</b></td>
                                <td class="text-center"><b>APROVADO</b></td>
                                <td class="text-center"><b>NEGADO</b></td>
                                <td class="text-center"><b>AGUARDANDO</b></td>
                                <td class="text-center"><b>GERAL</b></td>
                            </tr>
                            <tr style="font-size: 18px">
                                <td ></td>
                                <td style="padding: 12px" class="text-center"><b><?php echo $produtos['g_quantidade'] ?></b></td>
                                <td class="text-center"><b>R$ <?php echo number_format($produtos['g_total_aprovado'],2,',','.') ?></b></td>
                                <td class="text-center"><b>R$ <?php echo number_format($produtos['g_total_negado'],2,',','.') ?></b></td>
                                <td class="text-center"><b>R$ <?php echo number_format($produtos['g_total_aguardando'],2,',','.') ?></b></td>
                                <td class="text-center"><b>R$ <?php echo number_format($produtos['g_total'],2,',','.') ?></b></td>
                            </tr>
                        </tbody>
                    </table>
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
            function pdf(){
                $('#btn').css('display', 'none');
                $('#footer').css('display', 'block');
                window.print();
                $('#footer').css('display', 'none');
                $('#btn').css('display', 'block');
            }
        </script>
</html>