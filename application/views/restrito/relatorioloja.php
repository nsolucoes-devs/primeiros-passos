<style>
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
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
    co
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
    .nav-tabs{
        background-color: white;
    }
    
    .nav-link{
        font-size: 15px;
    }
    
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Lojas</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/relatoriosloja') ?>">Relatórios</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b> Lojas - Relatórios</b></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php if( $super == 1 || $_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 10){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" id="estoque-tab" data-toggle="tab" href="#estoque" role="tab" aria-controls="estoque" aria-selected="true"><b>Estoque</b></a>
                    </li>
                    <?php } ?>
                    <?php if( $super == 1 || $_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 10 ){ ?>
                    <li class="nav-item">
                        <a class="nav-link" id="vendas-tab" data-toggle="tab" href="#vendas" role="tab" aria-controls="vendas" aria-selected="true"><b>Vendas</b></a>
                    </li>
                    <?php } ?>
                    <?php if( $super == 1 || $_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 10 || $_SESSION['perfil'] == 9 ){ ?>
                    <li class="nav-item">
                        <a class="nav-link" id="funcionario-tab" data-toggle="tab" href="#funcionario" role="tab" aria-controls="funcionario" aria-selected="true"><b>Comissão</b></a>
                    </li>
                    <?php } ?>
                    <?php if( $super == 1 || $_SESSION['perfil'] == 3 ){ ?>
                    <!--<li class="nav-item">
                        <a class="nav-link" id="lojas-tab" data-toggle="tab" href="#lojas" role="tab" aria-controls="lojas" aria-selected="true"><b>Lojas</b></a>
                    </li>-->
                    <?php } ?>
                    <?php if( $super == 1 || $_SESSION['perfil'] == 10 || $_SESSION['perfil'] == 3){ ?>
                    <li class="nav-item">
                        <a class="nav-link" id="comissao-tab" data-toggle="tab" href="#comissao" role="tab" aria-controls="comissao" aria-selected="true"><b>Comissão Gerente</b></a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php if($_SESSION['perfil'] != 9){ ?>active<?php } ?> in" id="estoque" role="tabpanel" aria-labelledby="estoque-tab">
                        <form id="form-pedidos7" action="<?php echo base_url('admin/adminrelatorios/gerarRelatorioEstoque') ?>" method="post" target="_blank">
                            <input type="hidden" id="filtro-pedido7" name="filtro-pedido7">
                            <div class="col-md-12" style="margin-top: 2%;">
                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        <label><b>Ordenar:</b></label>
                                        <select name="ordenar" id="ordenar" class="form-control filtroPedidos7">
                                            <option value="-1"> Selecione </option>
                                            <option value="ASC">Crescente</option>
                                            <option value="DESC">Decrescente</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Departamentos:</b></label>
                                        <select id="departamentos" name="departamentos[]" multiple class="js-example-basic-multiple" style="width: 100%!important;">
                                            <?php foreach($departamentos as $d){?>
                                                <option value="<?php echo $d['departamento_id'] ?>"><?php echo $d['departamento_nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><b>Loja:</b></label>
                                        <select style="width: 100%!important" class="form-control js-example-basic-multiple filtroPedidos4" name="loja" id="loja7">
                                            <option value="-1" selected> -- SELECIONE -- </option>
                                            <?php foreach($lojas as $l){ ?>
                                                <option value="<?php echo $l['id'] ?>"><?php echo $l['nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right" style="margin-bottom: 20px; margin-top: 20px;">
                                            <button onclick="verificarFiltro7()" type="button" class="btn btn-primary">Gerar Relatorio</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="vendas" role="tabpanel" aria-labelledby="vendas-tab">
                        <form id="form-pedidos9" action="<?php echo base_url('admin/adminrelatorios/gerarRelatorioVendas') ?>" method="post" target="_blank">
                            <input type="hidden" id="filtro-pedido9" name="filtroPedidos9" value="n">
                            <div class="col-md-12" style="margin-top: 2%;">
                                <div class="row">
                                    <?php if( $super == 1 || $_SESSION['perfil'] == 3){ ?>
                                        <div class="col-md-4 form-group">
                                            <label><b>Loja:</b></label>
                                            <select style="width: 100%!important" class="form-control js-example-basic-multiple filtroPedidos9" name="loja" id="loja9">
                                                <option value="" <?php if(!$sessao['loja_id']){ echo 'selected';} ?> disabled> -- SELECIONE -- </option>
                                                <?php foreach($lojas as $l){ ?>
                                                    <option value="<?php echo $l['id'] ?>" <?php if($sessao['loja_id'] == $l['id']){ echo 'selected';} ?>><?php echo $l['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-4 form-group">
                                            <label><b>Loja:</b></label>
                                            <select style="width:  100%!important" disabled  class="form-control js-example-basic-multiple filtroPedidos9" name="loja" id="loja9">
                                                <?php foreach($lojas as $l){ ?>
                                                    <option value="<?php echo $l['id'] ?>" <?php if($sessao['loja_id'] == $l['id']){ echo 'selected';} ?>><?php echo $l['nome'] ?></option>
                                                <?php } ?>
                                            </select>                                            
                                            <input type="hidden" value="<?php echo $sessao['loja_id'] ?>" name="loja" id="loja9" class="form-control filtroPedidos9" required>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4 form-group" style="display: none">
                                        <label><b>Forma de Pagamento:</b></label>
                                        <select style="width: 100%!important" class="form-control js-example-basic-multiple filtroPedidos9" name="formadp" id="formadp">
                                            <option value="" selected> Todas </option>
                                            <?php foreach($formasdepagamento as $forma){ ?>
                                                <option value="<?php echo $forma['id_forma'] ?>"><?php echo $forma['nome_forma'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Data Inicio:</b></label>
                                        <input type="date" name="datainicio9" id="datainicio9" class="form-control filtroPedidos9">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Data Fim:</b></label>
                                        <input type="date" name="datafim9" id="datafim9" class="form-control filtroPedidos9">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Filtro de vendas</b></label>
                                        <select name="filterSale" id="selectFilter" class="form-control">
                                            <option value="" selected>Todas</option>
                                            <?php foreach($statuscompra as $status){ ?>
                                                <option value="<?php echo $status['idStatusCompra'] ?>"><?php echo $status['nomeStatusCompra'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right" style="margin-bottom: 20px; margin-top: 20px;">
                                            <button onclick="verificarFiltro9()" type="button" class="btn btn-primary">Gerar Relatorio</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade <?php if($_SESSION['perfil'] == 9){ ?>active in <?php } ?>" id="funcionario" role="tabpanel" aria-labelledby="funcionario-tab">
                        <form id="form-pedidos10" action="<?php echo base_url('admin/adminrelatorios/gerarRelatorioFuncionario') ?>" method="post" target="_blank">
                            <input type="hidden" id="filtro-pedido10" name="filtro-pedido10" value="n">
                            <div class="col-md-12" style="margin-top: 2%;">
                                <div class="row">
                                    <!--<?php //if( $super == 1 || $_SESSION['perfil'] == 10 || $_SESSION['perfil'] == 3 ){ ?>-->
                                        <div class="col-md-6 form-group">
                                            <label><b>Funcionário:</b></label>
                                            <?php if($_SESSION['perfil'] != 9) { ?>
                                                <select style="width: 100%!important" class="js-example-basic-multiple filtroPedidos10 form-control" name="funcionario" id="funcionario">
                                                    <option value="-1" selected disabled> -- Selecionar -- </option>
                                                    <?php foreach($funcionarios as $funcionario){ ?>
                                                        <option value="<?php echo $funcionario['id_funcionario'] ?>"><?php echo $funcionario['nome_funcionario'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php }else{ ?>
                                                <input class="form-control" readonly type="text" value="<?php echo $_SESSION['nome'] ?>">
                                                <input type="hidden" name="funcionario" id="funcionario" value="<?php echo $_SESSION['func_id'] ?>">
                                            <?php } ?>
                                        </div>
                                    <!--<?php //} else { ?>-->
                                    <!--<div class="col-md-6 form-group">-->
                                    <!--        <label><b>Funionário:</b></label>-->
                                    <!--        <select style="width: 100%!important" disabled class="js-example-basic-multiple filtroPedidos10 form-control" name="funcionario" id="funcionario">-->
                                    <!--            <?php foreach($funcionarios as $funcionario){ ?>-->
                                    <!--                <option value="<?php echo $funcionario['id_funcionario'] ?>" <?php if($sessao['func_id'] == $funcionario['id_funcionario']){ echo 'selected';} ?>><?php echo $funcionario['nome_funcionario'] ?></option>-->
                                    <!--            <?php } ?>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--     <input type="hidden" value="<?= $sessao['func_id']?>" name="funcionario" id="" class="form-control filtroPedidos4">-->
                                    <!--<?php //} ?>-->
                                    <div class="col-md-3 form-group">
                                        <label><b>Data Inicio:</b></label>
                                        <input type="date" name="datainicio10" id="datainicio10" value="" class="form-control filtroPedidos10" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Data Fim:</b></label>
                                        <input type="date" name="datafim10" id="datafim10" value="" class="form-control filtroPedidos4" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right" style="margin-bottom: 20px; margin-top: 20px;">
                                           <button onclick="verificarFiltro10()" type="button" class="btn btn-primary">Gerar Relatorio</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="comissao" role="tabpanel" aria-labelledby="comissao-tab">
                        <form id="form-pedidos11" action="<?php echo base_url('admin/adminrelatorios/gerarRelatorioGerente') ?>" method="post" target="_blank">
                            <input type="hidden" id="filtro-pedido11" name="filtro-pedido11" value="n">
                            <div class="col-md-12" style="margin-top: 2%;">
                                <div class="row">
                                    <?php if( $super == 1 || $_SESSION['perfil'] == 3){ ?>
                                        <div class="col-md-4 form-group" style="display: none">
                                            <label><b>Loja:</b></label>
                                            <select style="width: 100%!important" class="form-control js-example-basic-multiple filtroPedidos11 d-none" name="loja" id="loja11">
                                                <option value="" <?php if(!$sessao['loja_id']){ echo '';} ?> disabled> -- SELECIONE -- </option>
                                                <?php foreach($lojas as $l){ ?>
                                                    <option value="<?php echo $l['id'] ?>" <?php if($sessao['loja_id'] == $l['id']){ echo 'selected';} ?>><?php echo $l['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Funionário:</b></label>
                                            <select style="width: 100%!important" class="js-example-basic-multiple filtroPedidos10 form-control" name="funcionario" id="funcionario">
                                                <option value="" <?php if($sessao['func_id']){ echo 'selected';} ?> disabled> -- Selecionar -- </option>
                                                <?php foreach($funcionarios as $funcionario){ 
                                                    if($funcionario['perfil'] == 10) { ?>
                                                        <option value="<?php echo $funcionario['id_funcionario'] ?>" <?php if($sessao['func_id'] == $funcionario['id_funcionario']){ echo 'selected';} ?>><?php echo $funcionario['nome_funcionario'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } else if($_SESSION['perfil'] == 10) { ?>
                                        <div class="col-md-4 form-group" style="display: none">
                                            <label><b>Loja:</b></label>
                                            <select style="width:  100%!important" type="hidden" disabled  class="form-control js-example-basic-multiple filtroPedidos11 d-none" name="loja" id="loja11">
                                                <?php foreach($lojas as $l){ ?>
                                                    <option value="<?php echo $l['id'] ?>" <?php if($sessao['loja_id'] == $l['id']){ echo 'selected';} ?>><?php echo $l['nome'] ?></option>
                                                    
                                                <?php } ?>
                                            </select>                                            
                                            <input type="hidden" value="<?php echo $sessao['loja_id'] ?>" name="loja" id="loja11" class="form-control filtroPedidos11" required>
                                            <input type="hidden" id="id-funcionario" name="id-funcionario" value="<?= $sessao['func_id'] ?>">
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 form-group">
                                        <label><b>Data Inicio:</b></label>
                                        <input type="date" name="datainicio11" id="datainicio11" class="form-control filtroPedidos11" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Data Fim:</b></label>
                                        <input type="date" name="datafim11" id="datafim11" class="form-control filtroPedidos11" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-right" style="margin-bottom: 20px; margin-top: 20px;">
                                           <button onclick="verificarFiltro11()" type="button" class="btn btn-primary">Gerar Relatorio</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
    $(document).ready(function(){
        $('#pedidos-tab').click();
    })
</script>

<script>
    function tipo(){
        if($("#detalhado").prop("checked")){
            $('#form-pedidos').show();
            $('#form-pedidos3').hide();
        } else {
            $('#form-pedidos').hide();
            $('#form-pedidos3').show();
        }
    }
</script>

<script>
    function tipo2(){
        if($("#detalhado_cliente").prop("checked")){
            $('#form-pedidos4').show();
            $('#form-pedidos5').hide();
        } else {
            $('#form-pedidos4').hide();
            $('#form-pedidos5').show();
        }
    }
</script>
<script>
    function tipo3(){
        if($("#detalhado_loja").prop("checked")){
            $('#form-pedidosl').show();
            $('#form-pedidosl1').hide();
        } else {
            $('#form-pedidosl').hide();
            $('#form-pedidosl1').show();
        }
    }
</script>

<!--
<script>
    $("input[type=radio][name=#tipo3]").on('change', function () {
    var radVal = $(this).val();
    if (radVal == '0') {
        $("#form-pedidosl").css("display", "block");
        $("#form-pedidosl1").css("display", "none");
    } else if (radVal == '1') {
        $("#form-pedidosl").css("display", "none");
        $("#form-pedidosl1").css("display", "block");
    }
});
</script>
-->

<script>
    function verificarFiltro(){
        var boolean1 = false;
        
        $('.filtroPedidos').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean1 = true;
            }
        })
        
        if(boolean1 == true){
            $('#filtro-pedido').val('s');
        } else {
            $('#filtro-pedido').val('n');
        }
        
        $('#form-pedidos').submit();
    }
</script>

<script>
    function verificarFiltro2(){
        var boolean2 = false;
        
        $('.filtroPedidos2').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                 boolean2 = true;
            }
        })
        
        if(boolean2 == true){
            $('#filtro-pedido2').val('s');
        } else {
            $('#filtro-pedido2').val('n');
        }
        
        $('#form-pedidos2').submit();
    }
</script>

<script>
    function verificarFiltro3(){
        var boolean3 = false;
        
        $('.filtroPedidos3').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean3 = true;
            }
        })
        
        if(boolean3 == true){
            $('#filtro-pedido3').val('s');
        } else {
            $('#filtro-pedido3').val('n');
        }
        
        $('#form-pedidos3').submit();
    }
</script>

<script>
    function verificarFiltro4(){
        var boolean4 = false;
        
        $('.filtroPedidos4').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean4 = true;
            }
        })
        
        if(boolean4 == true){
            $('#filtro-pedido4').val('s');
        } else {
            $('#filtro-pedido4').val('n');
        }
        
        $('#form-pedidos4').submit();
    }
</script>

<script>
    function verificarFiltro5(){
        var boolean5 = false;
        
        $('.filtroPedidos5').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean5 = true;
            }
        })
        
        if(boolean5 == true){
            $('#filtro-pedido5').val('s');
        } else {
            $('#filtro-pedido5').val('n');
        }
        
        $('#form-pedidos5').submit();
    }
</script>

<script>
    function verificarFiltro6(){
        var boolean6 = false;
        
        $('.filtroPedidos6').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean6 = true;
            }
        })
        
        if(boolean6 == true){
            $('#filtro-pedido6').val('s');
        } else {
            $('#filtro-pedido6').val('n');
        }
        
        $('#form-pedidos6').submit();
    }
</script>

<script>
    function verificarFiltro9(){
        var boolean3 = false;
        
        $('.filtroPedidos9').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean3 = true;
            }
        })
        
        if(boolean3 == true){
            $('#filtro-pedido9').val('s');
        } else {
            $('#filtro-pedido9').val('n');
        }
        
        $('#form-pedidos9').submit()
        
    }
</script>


<script>
    function verificarFiltro10(){
        var boolean6 = false;
        
        $('.filtroPedidos10').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean6 = true;
            }
        })
        
        if(boolean6 == true){
            $('#filtro-pedido10').val('s');
        } else {
            $('#filtro-pedido10').val('n');
        }
        
        $('#form-pedidos10').submit();
    }
</script>

<script>
    function verificarFiltro11(){
        var boolean6 = false;
        
        $('.filtroPedidos11').each(function(){
            if($(this).val() != "" && $(this).val() != null){
                boolean6 = true;
            }
        })
        
        if(boolean6 == true){
            $('#filtro-pedido11').val('s');
        } else {
            $('#filtro-pedido11').val('n');
        }
        
        $('#form-pedidos11').submit();
    }
</script>



<script>
    function verificarFiltro7(){
        
        var loja = $("#loja7").val();
        var ordenar = $("#ordenar").val();
        
        if(ordenar  =  -1){
            $('#filtro-pedido7').val('n');
        }else{
            $('#filtro-pedido7').val('s');
        }
        
        if(loja == -1){
            Swal.fire({
                icon: 'error',
                title: 'Selecione uma loja',
            });
        }else{
            $('#form-pedidos7').submit();
        }
        
    }
</script>
