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
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>">Fornecedores</a></li>
                <li class="breadcrumb-item" aria-current="page">Edição</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #3a0b0c;"><b>Edição Fornecedor</b></h2>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                        <div class="col-md-12">
                            
                            <div class="row" style="margin-top: 2%">
                                <div class="col-md-6 form-group">
                                    <label><b>Nome fantasia:</b></label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $fornecedor['nome_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><b>Razão social:</b></label>
                                    <input type="text" id="razao" name="razao" class="form-control" value="<?php echo $fornecedor['razao_fornecedor'] ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><b>CNPJ do Fornecedor:</b></label>
                                    <input type="text" id="cnpj" name="cnpj" class="form-control" value="<?php echo $fornecedor['cnpj_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><b>Inscrição Estadual:</b></label>
                                    <input type="text" id="inscricao" name="inscricao" class="form-control" value="<?php echo $fornecedor['inscricao_fornecedor'] ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label><b>CEP:</b></label>
                                    <input type="text" id="cep" name="cep" class="form-control" value="<?php echo $fornecedor['cep_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label><b>Rua:</b></label>
                                    <input type="text" id="rua" name="rua" class="form-control" value="<?php echo $fornecedor['endereco_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label><b>Número:</b></label>
                                    <input type="number" id="numero" name="numero" class="form-control" value="<?php echo $fornecedor['numero_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label><b>Complemento:</b></label>
                                    <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo $fornecedor['complemento_fornecedor'] ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label><b>Bairro:</b></label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo $fornecedor['bairro_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label><b>Cidade:</b></label>
                                    <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo $fornecedor['cidade_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label><b>Estado:</b></label>
                                    <input id="estado" name="estado" class="form-control" value="<?php echo $fornecedor['estado_fornecedor'] ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!--<div class="col-md-6 form-group">-->
                                <!--    <label><b>Vendedor:</b></label>-->
                                <!--    <input id="vendedor" name="vendedor" class="form-control" value="<?php echo $fornecedor['vendedor_fornecedor'] ?>" readonly>-->
                                <!--    </select>    -->
                                <!--</div>-->
                                <div class="col-md-3 form-group">
                                    <label><b>Telefone fixo:</b></label>
                                    <input type="text" id="telfixo" name="telfixo" class="form-control" value="<?php echo $fornecedor['tel_fixo_fornecedor'] ?>" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label><b>Telefone celular:</b></label>
                                    <input type="text" id="telcelular" name="telcelular" class="form-control" value="<?php echo $fornecedor['tel_cel_fornecedor'] ?>" readonly>
                                </div>
                            </div>
                                
                            <div class="row" style="padding-bottom: 2%;">
                                <div class="col-md-12 text-center">
                                    <div class="col-md-12 text-center">
                                        <a href="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>" style="margin-right: 15px;" class="btn btn-danger">Voltar</a>
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