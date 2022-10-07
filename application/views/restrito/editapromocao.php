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
        padding: 15px;
    }
    
    #select2-produtos-container{
        height: 50px;
    }
    #select2-departamentos-container{
        height: 50px;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>">Promoções</a></li>
                <li class="breadcrumb-item" aria-current="page">Edição</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b>Edição Promoção</b></h2>
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('ff373680f0bbc748feed9641bc8f972b');?>" method="post" id="form">
                <input type="hidden" id="id" name="id" value="<?php echo $promocao['promocao_id'] ?>">
                
                <div class="row" style="margin-top: 2%">
                    <div class="col-md-6">
                        <label><b>Título da promoção:</b></label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $promocao['promocao_titulo'] ?>">
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <hr style="height: 1px; border-color: lightgrey">
                    </div>
                </div>
                
                <div class="row">
                     <div class="col-md-3 form-group">
                        <label><b>Preço promoção:</b></label>
                        <input type="text" id="preco" name="preco" class="form-control money" placeholder="0,00"  value="<?php echo $promocao['promocao_preco'] ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><b>Promoção ativo:</b></label>
                        <select onchange="ativopromocao()" id="preco_ativo" name="preco_ativo" class="js-example-basic-multiple" style="width: 100%!important" required>
                            <option value="" selected disabled> Selecione </option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select> 
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label><b>Desconto:</b></label>
                        <input type="text" id="desconto" name="desconto" class="form-control" placeholder="0%" value="<?php echo $promocao['promocao_desconto'] ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><b>Desconto ativo:</b></label>
                        <select onchange="ativodesconto()" id="desconto_ativo" name="desconto_ativo" class="js-example-basic-multiple" style="width: 100%!important" required>
                            <option value="" selected disabled> Selecione </option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
                        
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label><b>Data inicial:</b></label>
                        <input type="date" id="datainicial" name="datainicial" class="form-control" placeholder="Data inicial" value="<?php echo $promocao['promocao_datainicial'] ?>" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label><b>Data final:</b></label>
                        <input type="date" id="datafinal" name="datafinal" class="form-control" placeholder="Data final" value="<?php echo $promocao['promocao_datafinal'] ?>" required>
                    </div>
                    <div class="col-md-2 form-group">
                        <label><b>Data final ativo:</b></label>
                        <select id="datafinal_ativo"  name="datafinal_ativo" class="js-example-basic-multiple" style="width: 100%!important">
                            <option value="" selected disabled> Selecione </option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <hr style="height: 1px; border-color: lightgrey">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label><b>Cupom de desconto:</b></label>
                        <input type="text" id="cupom" name="cupom" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" value="<?php echo $promocao['promocao_cupom'] ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><b>Cupom ativo:</b></label>
                        <select id="cupom_ativo" name="cupom_ativo" class="js-example-basic-multiple" style="width: 100%!important">
                            <option value="" selected disabled> Selecione </option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
                        
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label><b>Departamento:</b></label>
                        <select id="departamentos" name="departamentos[]" multiple class="js-example-basic-multiple" style="width: 100%; height: 200px!important;">
                            <?php foreach($departamentos as $d){?>
                                <option value="<?php echo $d['departamento_id'] ?>"><?php echo $d['departamento_nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                
                        
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label><b>Produtos:</b></label>
                          <select id="produtos" name="produtos[]" multiple class="js-example-basic-multiple" style="width: 100%;">
                            <?php foreach($produtos as $p){?>
                                <option value="<?php echo $p['produto_id'] ?>"><?php echo $p['produto_nome'] ?></option>
                            <?php } ?>
                          </select> 
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>" style="margin-right: 15px;" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</section>

<script type="application/javascript">
    $(document).ready(function(){
        $('.number').mask('0#');
        $('.money').mask("#.##0,00", {reverse: true});
        
        
        $('#preco_ativo').val(<?php echo $promocao['promocao_preco_ativo'] ?>).change();
        $('#desconto_ativo').val(<?php echo $promocao['promocao_desconto_ativo'] ?>).change();
        $('#datafinal_ativo').val(<?php echo $promocao['promocao_datafinal_ativo'] ?>).change();
        $('#cupom_ativo').val(<?php echo $promocao['promocao_cupom_ativo'] ?>).change();
        
        <?php $aux = explode('¬', $promocao['promocao_departamentos']); ?>
        <?php foreach($aux as $a){ ?>
            $("#departamentos option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
        <?php } ?>
        
        <?php $aux = explode('¬', $promocao['promocao_produtos']); ?>
        <?php foreach($aux as $a){ ?>
            $("#produtos option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
        <?php } ?>
    });
</script>


<script>
    function ativopromocao(){
        if($('#preco_ativo').val() == 1){
            if($('#desconto_ativo').val() == 1){
                $('#desconto_ativo').val(0).change();
            }
        }
    }
    
</script>

<script>
    function ativodesconto(){
        if($('#desconto_ativo').val() == 1){
            if($('#preco_ativo').val() == 1){
                $('#preco_ativo').val(0).change();
            }
        }
    }
</script>

