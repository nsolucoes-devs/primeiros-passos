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
                    <h4><b>RELATÓRIO DE ESTOQUE</b></h4>
                    <?php if(isset($filtros)){ ?>
                        <p class="text-center" style="font-size: 12px">
                            <?php if($filtros['loja']) { echo 'Nome da loja: '. mb_strtoupper($nome_loja); } ?>
                        </p>
                        <p class="text-center" style="font-size: 12px">
                            <?php if($filtros['departamentos']) { echo 'Departamento(s) selecionado(s): '. mb_strtoupper($departamentos); } ?>
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
                                <th style="padding: 5px; width: 40%!important"><b>NOME</b></th>
                                <!--<th style="width: 40%!important"><b>MOVIMENTO</b></th>-->
                                <th style="width: 15%!important"><b>VALOR</b></th>
                                <th style="width: 25%!important; text-align: center;"><b>QUANTIDADE</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($estoque as $e){ ?>
                                <tr style="border-bottom: 2px solid lightgrey; font-size: 12px">
                                    <td><?php echo ucwords(mb_strtolower($e['produto_nome'])) ?></td>
                                    <!--<td><?php echo number_format($e['venda_produto'], 2,',','.') ?></td>-->
                                    <td>R$ <?php echo number_format($e['valor_produto'], 2,',','.') ?></td>
                                    <td class="text-center"><?php echo $e['estoque'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
            <br>
        </section>
        
        <footer id="footer" style="position: fixed; bottom: 0px; text-align: center; width: 100%; margin-bottom: -13px; display: none; clear: both;">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td class="pb-3"style="margin-left: 10px; width> 50%; text-align: right"><p><b style="font-size: 12px; margin-right: 15px;">Gestão de Ecommerce | N Soluções</b></p></td>
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