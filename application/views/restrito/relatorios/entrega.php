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
        <title>Relatório de Entrega</title>
        <link href="<?php echo base_url('assets/admin/');?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/admin/');?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>css/style-responsive.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
        <title>.</title>
    </head>
    <body style="background: white;">
        <section id="container" style="position: relative; margin-right: 1%; margin-left: 1%; width: 98%">
            <div class="row" style="margin-bottom: 10px; display: inline;">
                <div class="col-md-12 form-group text-center">
                    <img id="imagem" src="<?php echo base_url('imagens/site/logo2.png') ?>" style="width: 300px; height: auto;">    
                </div>
                <div class="col-md-12 form-group text-center">
                    <h5><b><?php echo mb_strtoupper($configs['nome_empresa']) ?></b> - <?php echo date('d/m/Y | H:i') ?></h5>
                    <h4><b>ENTREGA #<?php echo $pedido['idpedido'] ?></b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: right">
                    <button id="btn" type="button" class="btn btn-primary" style="border-color: #1b9045!important; color: white; background-color: #1b9045!important; right: 0; float: right; margin-right: 20px; margin-bottom: 20px" onclick="pdf()">Relatório PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <table style='width: 100%; border: 1px solid lightgrey; padding: 10px'>
                        <thead>
                            <tr>
                                <th colspan="2" style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey;"><b>INFORMAÇÕES DO PEDIDO</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="line-height: 10px; font-size: 13px; padding: 10px">
                                <td style="width: 50%; padding: 10px; border-right: 1px solid lightgrey">
                                    <p><b>Cheia de Manias</b></p>
                                    <p>Rua Carmelita Coutinho, 188 | Alfenas - MG</p>
                                    <p><b>Telefone:</b>(35) 3291-2299</p>
                                    <p><b>E-mail:</b>vendas@destiladoresmg.com.br</p>
                                    <p><b>Site:</b> <?php echo base_url('') ?></p>
                                </td>
                                <td style="width: 50%; padding: 10px">
                                    <p><b>Data do pedido:</b> <?php echo date('d/m/Y H:i', strtotime($pedido['cadastro'])) ?></p>    
                                    <p><b>Nº pedido:</b> <?php echo $pedido['idpedido'] ?></p>
                                    <p><b>Tipo de frete:</b> <?php echo $pedido['frete'] ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <table style='width: 100%; border: 1px solid lightgrey; padding: 10px'>
                        <thead>
                            <tr>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey; border-right: 1px solid lightgrey"><b>ENDEREÇO PARA ENTREGA</b></th>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey;"><b>CONTATO</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="line-height: 10px; font-size: 13px; padding: 10px">
                                <td style="width: 50%; padding: 10px; border-right: 1px solid lightgrey">
                                    <p><b>CEP: </b><span  class="cep"><?php echo $pedido['e_cep'] ?></span></p>
                                    <p><b>Rua: </b><?php echo $pedido['e_endereco'] ?></p>
                                    <p><b>N°: </b><?php echo $pedido['e_numero'] ?></p>
                                    <p><b>Complemento: </b><?php echo $pedido['complemento'] ?></p>
                                    <p><b>Bairro: </b><?php echo $pedido['e_bairro'] ?></p>
                                    <p><b>Cidade: </b><?php echo $pedido['e_cidade'] ?></p>
                                    <p><b>Estado: </b><?php echo $pedido['e_estado'] ?></p>
                                </td>
                                <td style="width: 50%; padding: 10px">
                                    <p><b>E-mail: </b><?php echo $pedido['email'] ?></p>
                                    <p><b>Telefone: </b>
                                    <?php if($pedido['telefone']){ ?>
                                        <span  class="telefone"><?php echo $pedido['telefone'] ?></span>
                                        <?php } else { ?>
                                            Telefone não cadastrado.
                                        <?php } ?>
                                    </p>
                                    <p><b>Status: </b><?php echo $pedido['status'] ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <table style='width: 100%; border: 1px solid lightgrey; padding: 10px'>
                        <thead>
                            <tr>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey; border-right: 1px solid lightgrey"><b>PRODUTO</b></th>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey; border-right: 1px solid lightgrey"><b>PESO</b></th>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey; border-right: 1px solid lightgrey"><b>VOLUME</b></th>
                                <th style="font-size: 15px; padding: 10px; border-bottom: 2px solid lightgrey;"><b>QUANTIDADE</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pedido['produtos'] as $p) { ?>
                                <tr style="line-height: 10px; font-size: 13px; padding: 10px">
                                    <td style="padding: 10px; border-right: 1px solid lightgrey">
                                        <?php echo $p['produto_nome'] ?>
                                    </td>
                                    <td style="padding: 10px; border-right: 1px solid lightgrey">
                                        <?php echo ($p['produto_peso'] * $p['produto_quantidade']) ?> <?php echo $p['produto_un_peso'] ?>
                                    </td>
                                    <td style="padding: 10px; border-right: 1px solid lightgrey">
                                        <?php echo $p['produto_modelo'] ?>
                                    </td>
                                    <td style="padding: 10px">
                                        <?php echo $p['produto_quantidade'] ?>
                                    </td>
                                </tr>
                            <?php } ?>
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
        $(document).ready(function(){
            $('.cep').mask('00000-000');
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