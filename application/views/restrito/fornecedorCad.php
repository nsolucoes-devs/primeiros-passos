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
                <li class="breadcrumb-item active" aria-current="page">Lojas</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminfornecedores/updateFornecedor') ?>"></a></li>
                <li class="breadcrumb-item" aria-current="page">Cadastro</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #3a0b0c;"><b>Cadastro Fornecedor</b></h2>
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('');?>" method="post" enctype='multipart/form-data' id="form">
                <input type="hidden" id="id" name="id" value=""> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-12 form-group">
                                        <label><b>Nome fantasia:</b></label>
                                        <input type="text" id="nome" name="nome" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label><b>Razão social:</b></label>
                                        <input type="text" id="razao" name="razao" class="form-control" value="" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label><b>CNPJ do Fornecedor:</b></label>
                                        <input type="text" id="cnpj" name="cnpj" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Inscrição Estadual:</b></label>
                                        <input type="text" id="inscricao" name="inscricao" class="form-control" value="">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label><b>Endereço:</b></label>
                                        <input type="text" id="endereco" name="endereco" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label><b>Vendedor:</b></label>
                                        <input type="text" id="vendedor" name="vendedor" class="form-control" value="" required>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                                            &nbsp;&nbsp;
                                            <a href="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>" style="margin-right: 15px;" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                                
                </div>
            </form>
        </div>
    </section>
</section>

<script type="text/javascript">
	$(document).ready(function(){	
		$("#cnpj").mask("99.999.999/9999-99");
	});
</script>