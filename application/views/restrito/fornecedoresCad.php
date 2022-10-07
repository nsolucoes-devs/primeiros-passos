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
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminfornecedores/updateFornecedor') ?>">Fornecedores</a></li>
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
            <form action="<?php echo base_url('admin/adminfornecedores/insertFornecedor');?>" method="post" enctype='multipart/form-data' id="form">
                <input type="hidden" id="id" name="id" value=""> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-6 form-group">
                                        <label><b>Nome fantasia:</b></label>
                                        <input type="text" id="cad-nome" name="cad-nome" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Razão social:</b></label>
                                        <input type="text" id="cad-razao" name="cad-razao" class="form-control" value="" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label><b>CNPJ do Fornecedor:</b></label>
                                        <input type="text" id="cad-cnpj" name="cad-cnpj" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Inscrição Estadual:</b></label>
                                        <input type="text" id="cad-inscricao" name="cad-inscricao" class="form-control" value="" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label><b>CEP:</b></label>
                                        <input onkeyup="autofillCEP()" type="text" id="cad-cep" name="cad-cep" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label><b>Rua:</b></label>
                                        <input type="text" id="cad-rua" name="cad-rua" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Número:</b></label>
                                        <input type="number" id="cad-numero" name="cad-numero" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Complemento:</b></label>
                                        <input type="text" id="cad-complemento" name="cad-complemento" class="form-control" value="">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label><b>Bairro:</b></label>
                                        <input type="text" id="cad-bairro" name="cad-bairro" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label><b>Cidade:</b></label>
                                        <input type="text" id="cad-cidade" name="cad-cidade" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Estado:</b></label>
                                        <select id="cad-estado" name="cad-estado" class="form-control" required>
                                            <option value="" selected disabled>-- Selecione --</option>
                                            <option value="AC">Acre</option>
                                        	<option value="AL">Alagoas</option>
                                    	    <option value="AP">Amapá</option>
                                        	<option value="AM">Amazonas</option>
                                        	<option value="BA">Bahia</option>
                                        	<option value="CE">Ceará</option>
                                        	<option value="DF">Distrito Federal</option>
                                        	<option value="ES">Espírito Santo</option>
                                        	<option value="GO">Goiás</option>
                                        	<option value="MA">Maranhão</option>
                                        	<option value="MT">Mato Grosso</option>
                                        	<option value="MS">Mato Grosso do Sul</option>
                                        	<option value="MG">Minas Gerais</option>
                                        	<option value="PA">Pará</option>
                                        	<option value="PB">Paraíba</option>
                                        	<option value="PR">Paraná</option>
                                        	<option value="PE">Pernambuco</option>
                                        	<option value="PI">Piauí</option>
                                        	<option value="RJ">Rio de Janeiro</option>
                                        	<option value="RN">Rio Grande do Norte</option>
                                        	<option value="RS">Rio Grande do Sul</option>
                                        	<option value="RO">Rondônia</option>
                                        	<option value="RR">Roraima</option>
                                        	<option value="SC">Santa Catarina</option>
                                        	<option value="SP">São Paulo</option>
                                        	<option value="SE">Sergipe</option>
                                        	<option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!--<div class="col-md-6 form-group">-->
                                    <!--    <label><b>Vendedor:</b></label>-->
                                    <!--    <select id="cad-vendedor" name="cad-vendedor" class="form-control" required>-->
                                    <!--        <option value="" selected disabled>-- Selecione --</option>-->
                                    <!--        <?php foreach($vendedores as $v){ ?>-->
                                    <!--            <option value="<?php echo $v['vendedor_nome'] ?>"><?php echo $v['vendedor_nome'] ?></option>-->
                                    <!--        <?php } ?>-->
                                    <!--    </select>-->
                                    <!--</div>-->
                                    <div class="col-md-3 form-group">
                                        <label><b>Telefone fixo:</b></label>
                                        <input type="text" id="cad-telfixo" name="cad-telfixo" class="form-control" value="" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Telefone celular:</b></label>
                                        <input type="text" id="cad-telcelular" name="cad-telcelular" class="form-control" value="" required>
                                    </div>
                                </div>
                                    
                                <div class="row" style="padding-bottom: 2%;">
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

<script>
    function autofillCEP(){
        var aux = $('#cad-cep').val();
        var cep = aux.replace(/\D/g,'');
        if(cep.length == 8){
            dados = new FormData();
            dados.append('cep', cep);
            $.ajax({
                url: '<?php echo base_url('inicio/resgataCEP'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if(data != "null" && data != "" && data != " " && data != null){
                        cep = jQuery.parseJSON(data);
                        var ce = cep.cep_cidadeuf.split('/');
                        $('#cad-cep').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#cad-cidade').val(ce[0]);
                        $('#cad-estado').val(ce[1]).change();
                        $('#cad-bairro').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#cad-rua').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#cad-rua').val(rua[0]);
                        }else{
                            $('#cad-rua').val(cep.cep_rua);
                        }
                    }
                },
            });
        }
    }
</script>

<script type="text/javascript">
	$(document).ready(function(){	
		$("#cad-cnpj").mask("99.999.999/9999-99");
		$("#cad-cep").mask("99999-999");
		$("#cad-telfixo").mask("(99) 9999-9999");
	    $("#cad-telcelular").mask("(99) 9 9999-9999");
	});
</script>