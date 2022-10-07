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
    
    .tab-li a{
        cursor: pointer;
    }
    
    .label-imagem{
        margin-top: 10px;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>">Clientes</a></li>
                <li class="breadcrumb-item" aria-current="page">Visualizar</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Visualizar Cliente</b></h2>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>"><i style="margin-top: 10px; border: 1px solid #1b9045; padding: 7px; border-radius: 5px; background-color: #1b9045; font-size: 17px; color: white" class="fa fa-reply" aria-hidden="true">VOLTAR</i></a>
                    </div>
                </div>
            </div>
                <input type="hidden" id="id" name="id" value="<?php echo $cliente['cliente_id'] ?>">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                
                                <ul class="nav nav-tabs">
                                  <li onclick="dado()" class="tab-li active" id="li_dados" data-target="dados" data-fonte="li_dados"><a>Dados</a></li>
                                  <li onclick="pedido()" class="tab-li" id="li_detalhes" data-target="detalhes" data-fonte="li_detalhes"><a>Pedidos</a></li>
                                </ul>
                                
                                
                                <div id="dados">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-6 form-group">
                                            <label><b>Nome:</b></label>
                                            <input type="text" id="nome" name="nome" class="form-control"  value="<?php echo $cliente['cliente_nome'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label><b>CPF:</b></label>
                                            <input type="text" id="cpf" name="cpf" class="cpf form-control"  value="<?php echo $cliente['cliente_cpf'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Nascimento:</b></label>
                                            <input type="text" id="nascimento" name="nascimento" class="form-control"  value="<?php if($cliente['cliente_nascimento'] != null) { echo date('d/m/Y' , strtotime($cliente['cliente_nascimento'])); } ?>"  readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <label><b>CEP:</b></label>
                                            <input type="text" id="cep" name="cep" class="cep form-control"  value="<?php echo $cliente['cliente_cep'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Endereço:</b></label>
                                            <input type="text" id="endereco" name="endereco" class="form-control" value="<?php echo $cliente['cliente_endereco'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Complemento:</b></label>
                                            <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo $cliente['cliente_complemento'] ?>"  readonly>
                                        </div>       
                                        <div class="col-md-2 form-group">
                                            <label><b>Número:</b></label>
                                            <input type="text" id="numero" name="numero" class="form-control"  value="<?php echo $cliente['cliente_numero'] ?>"  readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label><b>Bairro:</b></label>
                                            <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo $cliente['cliente_bairro'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label><b>Cidade:</b></label>
                                            <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo $cliente['cliente_cidade'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Estado:</b></label>
                                            <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $cliente['cliente_estado'] ?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label><b>E-mail:</b></label>
                                            <input type="text" id="comprimento" name="comprimento" class="form-control" value="<?php echo $cliente['cliente_email'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label><b>Telefone:</b></label>
                                            <input type="text" id="largura" name="largura" class="telefone form-control" value="<?php echo $cliente['cliente_telefone'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Gênero:</b></label>
                                            <input type="text" id="altura" name="altura" class="form-control" value="<?php echo $cliente['cliente_genero'] ?>"  readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div id="detalhes" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="table-responsive" style="width: 100%; margin-top: 2%">
                                        <table class="table c-table" id="tabela">
                    				        <thead>
                    				            <tr>
                    				                <th>N° PEDIDO</th>
                    				                <th>TOTAL</th>
                    				                <th>DATA</th>
                    				                <th>STATUS</th>
                    				                <th>AÇÃO</th>
                    				            </tr>
                    				        </thead>
                    				        <tbody>
                    				            <?php foreach($pedidos as $p){ ?>
                        				            <tr class="tr-check">
                        				                <td><?php echo mb_strtoupper($p['idpedido']) ?></td>
                        				                <td>R$ <?php echo number_format($p['total'] + $p['frete_valor'] - $p['desconto'],2,',','.') ?></td>
                        				                <td><?php echo date('d/m/Y H:i', strtotime($p['data'])) ?></td>
                        				                <td><?php echo mb_strtoupper($p['status']) ?></td>
                        				                <td>
                        				                    <a style="color: #249045;" href="<?php echo base_url('aeb6ca97f00431672db51d34b87c4a50/' . $p['idpedido']) ?>"><i style="font-size: 25px" class="fa fa-eye" aria-hidden="true"></i></a>
                        				                </td>
                    				            <?php } ?>
                    				        </tbody>
                				        </table>
                				    </div>
                				    <?php if($pedidos == null) { ?>
                    			        <div class="col-md-12 text-center">
                    			            <p>Nenhum pedido encontrado!</p>
                    			        </div>
                    			    <?php } ?>
                                </div>
                                
                                <br>
                                
                            </div>
                        </div>
                    </div>
                                
                </div>
        </div>
    </section>
</section>

<script>
    function dado(){
        $('#li_dados').addClass('active');
        $('#li_detalhes').removeClass('active');
        $('#dados').show();
        $('#detalhes').hide();
    }
    
    function pedido(){
        $('#li_dados').removeClass('active');
        $('#li_detalhes').addClass('active');
        $('#dados').hide();
        $('#detalhes').show();
    }
    
</script>

<script type="application/javascript">
    $(document).ready(function(){
        $('.money').mask("#.##0,00", {reverse: true});
        
        var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        
        $('.telefone').mask(SPMaskBehavior, spOptions);
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cep').mask('00000-000');
    });
</script>


