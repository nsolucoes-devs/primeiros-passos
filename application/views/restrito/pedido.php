<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    $auxfooter = 0;
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $sm = 1;
    } else {
        $sm = 0;
    }
?>

<style>
    .nome-form{
        color: black;
        font-size: 16px;
    }
    .nav-tabs {
        background: transparent;
    }
    .nav-tabs {
        border-bottom: 1px transparent;
    }
    .nav-item{
        color: #555;
        cursor: default;
        border-radius: 4px 4px 0 0;
        background-color: #dedede;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .c-card{
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 14%);
        border: 0;
        margin-bottom: 30px;
        margin-top: 30px;
        border-radius: 6px;
        color: #333333;
        background: #fff;
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
    }
    
    .c-card-header{
        text-align: right;
        margin: 0px 15px 0;
        padding: 0;
        position: relative;
        z-index: 3 !important;
        color: #fff;
        border-bottom: none;
        background: transparent;
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        padding-bottom: 15px;
    }
    
    .c-card-icon{
        border-radius: 3px;
        background-color: #999999;
        padding: 15px;
        margin-top: -20px;
        margin-right: 15px;
        float: left;
    }
        
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
    }
    
    .gui-pd-10{
        padding: 10px;
    }
    
    .active{
        border-bottom: 1px solid white;
        z-index: 1;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style=" margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Financeiro</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>">Pedidos</a></li>
                <li class="breadcrumb-item" aria-current="page">Visualizar</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Visualizar Pedido #<?php echo $pedido['idpedido'] ?></b></h2>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('admin/adminrelatorios/entrega/') . $pedido['idpedido'] ?>" target="_blank"><i style="padding: 7px; border-radius: 5px; border: 1px solid #1b9045; background-color: #1b9045; font-size: 17px; margin-right: 30px;  color: white" class="fa fa-truck" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>"><i style="margin-top: 10px; border: 1px solid #1b9045; padding: 7px; border-radius: 5px; background-color: #1b9045; font-size: 17px; color: white" class="fa fa-reply" aria-hidden="true">VOLTAR</i></a>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class=col-md-3>
                                    <div class="c-card">
                                        <div class="c-card-body" style="display: block;">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <p style="margin-top: 3%; font-size: 18px; color: #1b9045;"><b>Informações do Pedido</b></p>
                                                    </div>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-calendar" aria-hidden="true" title="Data do Pedido"></i></td>
                                                        <td style="width: 100%"><?php echo date('d/m/Y H:i:s', strtotime($pedido['cadastro'])) ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-credit-card" aria-hidden="true" title="Forma de Pagamento"></i></td>
                                                        <td><?php echo $pedido['forma'] ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-truck" aria-hidden="true" title="Frete"></i></td>
                                                        <td><?php echo $pedido['frete'] ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-usd" aria-hidden="true" title="Valor Total do Pedido"></i></td>
                                                        <td>R$ <?php echo number_format($pedido['total'] + $pedido['frete_valor'] + $pedido['acrescimo'] - $pedido['desconto'], 2, ',','.') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=col-md-3>
                                    <div class="c-card">
                                        <div class="c-card-body" style="display: block;">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <div class="row" style="margin-top:8px;">
                                                            <div class="col-md-7"><h4><b>Sub-Total</b></h4></div>    
                                                            <div class="col-md-5">R$ <?php echo number_format($pedido['total'],2,',','.') ?></div>
                                                        </div>
                                                        <div class="row" style="margin-top:8px;">
                                                            <div class="col-md-7"><h4><b>Frete</b></h4></div>
                                                            <div class="col-md-5">R$ <?php echo number_format($pedido['frete_valor'],2,',','.') ?></div>
                                                        </div>
                                                        <div class="row" style="margin-top:8px;">
                                                            <div class="col-md-7"><h4><b>Desconto</b></h4></div>    
                                                            <div class="col-md-5">R$ <?php echo number_format($pedido['desconto'],2,',','.') ?></div>
                                                        </div>
                                                        <div class="row" style="margin-top:8px;">
                                                            <div class="col-md-7"><h4><b>Acréscimo do cartão</b></h4></div>    
                                                            <div class="col-md-5">R$ <?php echo number_format($pedido['acrescimo'],2,',','.') ?></div>
                                                        </div>
                                                        <div class="row" style="margin-top:8px;">
                                                            <div class="col-md-7"><h4><b>Total</b></h4></div>    
                                                            <div class="col-md-5">R$ <?php echo number_format($pedido['total'] + $pedido['frete_valor'] + $pedido['acrescimo'] - $pedido['desconto'],2,',','.') ?></div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=col-md-6>
                                    <div class="c-card">
                                        <div class="c-card-body" style="display: block">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <p style="margin-top: 3%; font-size: 18px; color: #1b9045;"><b>Informações do Cliente</b></p>
                                                    </div>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-user" aria-hidden="true" title="Nome do Cliente"></i></td>
                                                        <td style="width: 100%"><?php echo $pedido['cliente'] ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-address-card"  aria-hidden="true" title="CPF do Cliente"></i></td>
                                                        <td class="cpf"><?php echo $pedido['cpf'] ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-phone" aria-hidden="true" title="Telefone do Cliente"></i></td>
                                                        <td>
                                                            <?php if($pedido['telefone']){ ?>
                                                                <span  class="telefone"><?php echo $pedido['telefone'] ?></span>
                                                            <?php } else { ?>
                                                                Telefone não cadastrado.
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid lightgrey;">
                                                        <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-map-marker" aria-hidden="true" title="Localidade do Cliente"></i></td>
                                                        <td><?php echo $pedido['endereco'] ?>, <?php echo $pedido['numero'] ?>, <?php echo $pedido['bairro'] ?>, <?php echo $pedido['cidade'] ?>, <?php echo $pedido['estado'] ?> - <span class="cep"><?php echo $pedido['cep'] ?></span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c-card">
                                        <div class="c-card-header">
                                            <div class="row">
                                                <div class="col-md-12 text-left">
                                                    <h2 style="color: #1b9045;"><b>Pedido</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-card-body" style="display: block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <h4 style="color: #1b9045;">Endereço para entrega</h4>
                                                        <div class="col-md-12">
                                                            <p style="font-size:13px; "><b><?php echo $pedido['e_endereco'] ?>, <?php echo $pedido['e_numero'] ?>, <?php echo $pedido['e_bairro'] ?>, <?php echo $pedido['e_cidade'] ?>, <?php echo $pedido['e_estado'] ?> - <span class="cep"><?php echo $pedido['e_cep'] ?></span></b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: 2%;">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive" style="width: 100%">
                                                            <table class="table c-table">
                                                                <tr style="border-bottom: 1px solid lightgrey;">
                                                                    <th style="color: #1b9045; width: 40%; padding: 10px;"><b>Produto</b></th>
                                                                    <td style="color: #1b9045; width: 5%"><b>Modelo</b></td>
                                                                    <td style="color: #1b9045; width: 5%"><b>Quantidade</b></td>
                                                                    <td style="color: #1b9045; width: 8%"><b>Valor</b></td>
                                                                    <td style="color: #1b9045; width: 8%"><b>Total</b></td>
                                                                </tr>
                                                                <?php foreach($pedido['produtos'] as $p){ ?>
                                                                    <tr>
                                                                        <td style="padding: 10px;"><?php echo $p['produto_nome'] ?></td>
                                                                        <td><?php echo $p['produto_modelo'] ?></td>
                                                                        <td><?php echo $p['produto_quantidade'] ?></td>
                                                                        <td>R$ <?php echo number_format($p['produto_valor'],2,',','.') ?></td>
                                                                        <td>R$ <?php echo number_format($p['produto_quantidade'] * $p['produto_valor'],2,',','.') ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="display: flex;">
                                                <div class="text-right col-md-10">
                                                    <h4 style="margin: 0; padding: 10px;"><b>Sub-Total</b></h4>
                                                    <h4 style="margin: 0; padding: 10px;"><b>Frete</b></h4>
                                                    <h4 style="margin: 0; padding: 10px;"><b>Desconto</b></h4>
                                                    <h4 style="color: #1b9045; margin: 0; padding: 10px;"><b>Total</b></h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <p style="margin: 0; padding: 10px; padding-left: 32px;">R$ <?php echo number_format($pedido['total'],2,',','.') ?></p>
                                                    <p style="margin: 0; padding: 10px; padding-left: 32px;">R$ <?php echo number_format($pedido['frete_valor'],2,',','.') ?></p>
                                                    <p style="margin: 0; padding: 10px; padding-left: 32px;">R$ <?php echo number_format($pedido['desconto'],2,',','.') ?></p>
                                                    <h4 style="color: #1b9045; margin: 0; padding: 10px; padding-left: 32px;"><b>R$ <?php echo number_format($pedido['total'] + $pedido['frete_valor'] - $pedido['desconto'],2,',','.') ?></b></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c-card">
                                        <div class="c-card-header">
                                            <div class="row">
                                                <div class="col-md-12 text-left">
                                                    <h2 style="color: #1b9045;"><b>Histórico</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-card-body" style="display: block">
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs">
                                                  <li id="li_historico" class="active" onclick="historico()"><a style="cursor: pointer">HISTÓRICO</a></li>
                                                  <!--<li id="li_adicional" onclick="adicional()"><a style="cursor: pointer">ADICIONAL</a></li>-->
                                                </ul>
                                            </div>
                                            <div class="col-md-12" style="padding-top: 25px; display: block; border: 1px solid #dadada;" id="historico">
                                                <div class="col-md-12 form-group">
                                                    <div class="table-responsive" style="width: 100%">
                                                        <table class="table c-table">
                                                            <tr style="border-bottom: 1px solid lightgrey">
                                                                <th style="width: 10%; padding: 5px">Data/hora</th>
                                                                <th style="width: 30%;">Comentário</th>
                                                                <th style="width: 10%;">Cliente Notificado?</th>
                                                                <th style="width: 10%;">Status</th>
                                                            </tr>
                                                            <?php foreach($pedido['historico'] as $h) { ?>
                                                                <tr>
                                                                    <td style="padding: 10px"><?php echo $h['historico_data'] . ' ' . $h['historico_hora']; ?> </td>
                                                                    <td><?php echo $h['historico_comentario'] ?></td>
                                                                    <td><?php echo $h['historico_notificar'] ?></td>
                                                                    <td><?php echo $h['historico_status'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php if($pedido['historico'] == null) { ?>
                                                    <div class="col-md-12 text-center">
                                                        <p>Nenhum histórico encontrado.</p>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($edita)) { if($edita == 1) { ?>
                                                <form action="<?php echo base_url('fbdc26200e4306f37a0fb4bd88637744') ?>" method="post">
                                                    <input type="hidden" name="pedido_id" name="pedido_id" value="<?php echo $pedido['idpedido'] ?>">
                                                    <div class="col-md-12 form-group">
                                                        <hr style="height: 1px; border-color: lightgrey">
                                                        <h4 style="color: brown">Adicionar Histórico</h4>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Situação do pedido</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="4">Aguardando Pagamento</option>
                                                            <option value="5">Cancelado</option>
                                                            <option value="6">Negado</option>
                                                            <option value="7">Estorno</option>
                                                            <option value="8">Aprovado</option>
                                                            <option value="9">Em Separação</option>
                                                            <option value="10">Enviado</option>
                                                            <option value="11">Entregue</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Notificar Cliente?</label>
                                                        <input type="checkbox" id="notificar" name="notificar" value="1">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Comentário</label>
                                                        <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                                    </div>
                                                    <div class="col-md-12 form-group" style="padding-bottom: 35px">
                                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                                    </div>
                                                </form>
                                                <?php }} ?>
                                            </div>
                                            
                                            <!--
                                            <div class="col-md-12" style="padding-top: 25px; display: none; border: 1px solid #dadada;" id="adicional">
                                                <div class="col-md-12">
                                                    <h5><b>Campos Extras na conta do cliente</b></h5>
                                                    <div class="text-center col-md-2">
                                                        <table>
                                                            <td style="width: 15%; padding: 10px">CPF</td>
                                                            <td>111.111.111-11</td>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <hr style="height: 1px; border-color: lightgrey">
                                                    <h5><b>Campos extras no endereço para fatura</b></h5>
                                                    <div class="text-center col-md-2">
                                                        <table>
                                                            <td style="width: 15%; padding: 10px">Número</td>
                                                            <td>111</td>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <hr style="height: 1px; border-color: lightgrey">
                                                    <h5><b>Campos extras no endereço para entrega</b></h5>
                                                    <div class="text-center col-md-2">
                                                        <table>
                                                            <td style="width: 15%; padding: 10px">Número</td>
                                                            <td>111</td>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="padding-bottom: 55px">
                                                    <hr style="height: 1px; border-color: lightgrey">
                                                    <h5><b>Informações sobre o navegador do cliente</b></h5>
                                                    <div class="text-center col-md-2">
                                                        <table>
                                                            <tr>
                                                                <td class="gui-pd-10" style="width: 40%">Endereço de IP</td>
                                                                <td style="width: 60%">111.11.11.111</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="gui-pd-10">Navegador</td>
                                                                <td>Chrome</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="gui-pd-10">Idioma</td>
                                                                <td>pt-br</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                            
            </div>
    </section>
</section>

<style>
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="14px"]::before { font-size: 14px !important; content: '14'; }
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="16px"]::before { font-size: 16px !important; content: '16'; }
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="18px"]::before { font-size: 18px !important; content: '18'; }
</style>

<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<script>
    $('span.ql-picker-item').on('click', function(){
        $('.ql-snow .ql-picker.ql-size .ql-picker-label::before').css('content', $(this).data('value'));
    });

    /*var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
    
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
    
        ['clean']                                         // remove formatting button
    ];*/
    var Size = Quill.import('attributors/style/size');
    Size.whitelist = ['14px', '16px', '18px'];
    Quill.register(Size, true);
    
    var toolbarOptions = [
        [{ 'size': ['14px', '16px', '18px'] }],
    ];
    
    var quill = new Quill('#editor', {
      modules: {
        toolbar: toolbarOptions
      },
      theme: 'snow'
    });
</script>

<script type="application/javascript">
    $(document).ready(function(){
        $('.number').mask('0#');
        $('.money').mask("#.##0,00", {reverse: true});
        
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
    function historico(){
        $('#historico').show();
        $('#li_historico').addClass('active');
        $('#adicional').hide();
        $('#li_adicional').removeClass('active');
    }
    
    function adicional(){
        $('#historico').hide();
        $('#li_historico').removeClass('active');
        $('#adicional').show();
        $('#li_adicional').addClass('active');
    }
</script>