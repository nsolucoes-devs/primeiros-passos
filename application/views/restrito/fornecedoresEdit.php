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
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>">Fornecedores</a></li>
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
            <form action="<?php echo base_url('admin/adminfornecedores/updateFornecedor');?>" method="post" enctype='multipart/form-data' id="form">
                <input type="hidden" id="id-edit" name="id-edit" value="<?php echo $fornecedor['id_fornecedor'] ?>"> 
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-6 form-group">
                                        <label><b>Nome fantasia:</b></label>
                                        <input type="text" id="edit-nome" name="edit-nome" class="form-control" value="<?php echo $fornecedor['nome_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Razão social:</b></label>
                                        <input type="text" id="edit-razao" name="edit-razao" class="form-control" value="<?php echo $fornecedor['razao_fornecedor'] ?>" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label><b>CNPJ do Fornecedor:</b></label>
                                        <input type="text" id="edit-cnpj" name="edit-cnpj" class="form-control" value="<?php echo $fornecedor['cnpj_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Inscrição Estadual:</b></label>
                                        <input type="text" id="edit-inscricao" name="edit-inscricao" class="form-control" value="<?php echo $fornecedor['inscricao_fornecedor'] ?>">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label><b>CEP:</b></label>
                                        <input onkeyup="autofillCEP()" type="text" id="edit-cep" name="edit-cep" class="form-control" value="<?php echo $fornecedor['cep_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label><b>Rua:</b></label>
                                        <input type="text" id="edit-rua" name="edit-rua" class="form-control" value="<?php echo $fornecedor['endereco_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Número:</b></label>
                                        <input type="number" id="edit-numero" name="edit-numero" class="form-control" value="<?php echo $fornecedor['numero_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Complemento:</b></label>
                                        <input type="text" id="edit-complemento" name="edit-complemento" class="form-control" value="<?php echo $fornecedor['complemento_fornecedor'] ?>">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label><b>Bairro:</b></label>
                                        <input type="text" id="edit-bairro" name="edit-bairro" class="form-control" value="<?php echo $fornecedor['bairro_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label><b>Cidade:</b></label>
                                        <input type="text" id="edit-cidade" name="edit-cidade" class="form-control" value="<?php echo $fornecedor['cidade_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Estado:</b></label>
                                        <select id="edit-estado" name="edit-estado" class="form-control" required>
                                            <option <?php if($fornecedor['estado_fornecedor'] == "AC"){echo "selected";}?> value="AC">Acre</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "AL"){echo "selected";}?> value="AL">Alagoas</option>
                                    	    <option <?php if($fornecedor['estado_fornecedor'] == "AP"){echo "selected";}?> value="AP">Amapá</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "AM"){echo "selected";}?> value="AM">Amazonas</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "BA"){echo "selected";}?> value="BA">Bahia</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "CE"){echo "selected";}?> value="CE">Ceará</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "DF"){echo "selected";}?> value="DF">Distrito Federal</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "ES"){echo "selected";}?> value="ES">Espírito Santo</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "GO"){echo "selected";}?> value="GO">Goiás</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "MA"){echo "selected";}?> value="MA">Maranhão</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "MT"){echo "selected";}?> value="MT">Mato Grosso</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "MS"){echo "selected";}?> value="MS">Mato Grosso do Sul</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "MG"){echo "selected";}?> value="MG">Minas Gerais</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "PA"){echo "selected";}?> value="PA">Pará</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "PB"){echo "selected";}?> value="PB">Paraíba</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "PR"){echo "selected";}?> value="PR">Paraná</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "PE"){echo "selected";}?> value="PE">Pernambuco</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "PI"){echo "selected";}?> value="PI">Piauí</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "RJ"){echo "selected";}?> value="RJ">Rio de Janeiro</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "RN"){echo "selected";}?> value="RN">Rio Grande do Norte</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "RS"){echo "selected";}?> value="RS">Rio Grande do Sul</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "RO"){echo "selected";}?> value="RO">Rondônia</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "RR"){echo "selected";}?> value="RR">Roraima</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "SC"){echo "selected";}?> value="SC">Santa Catarina</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "SP"){echo "selected";}?> value="SP">São Paulo</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "SE"){echo "selected";}?> value="SE">Sergipe</option>
                                        	<option <?php if($fornecedor['estado_fornecedor'] == "TO"){echo "selected";}?> value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!--<div class="col-md-6 form-group">-->
                                    <!--    <label><b>Vendedor:</b></label>-->
                                    <!--    <select id="edit-vendedor" name="edit-vendedor" class="form-control" required>-->
                                    <!--        <?php foreach($vendedores as $v){ ?>-->
                                    <!--            <option value="<?php echo $v['vendedor_nome'] ?>"> <?php echo $v['vendedor_nome'] ?> </option>-->
                                    <!--        <?php } ?>-->
                                    <!--    </select>    -->
                                    <!--</div>-->
                                    <div class="col-md-3 form-group">
                                        <label><b>Telefone fixo:</b></label>
                                        <input type="text" id="edit-telfixo" name="edit-telfixo" class="form-control" value="<?php echo $fornecedor['tel_fixo_fornecedor'] ?>" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Telefone celular:</b></label>
                                        <input type="text" id="edit-telcelular" name="edit-telcelular" class="form-control" value="<?php echo $fornecedor['tel_cel_fornecedor'] ?>" required>
                                    </div>
                                </div>
                                    
                                <div class="row" style="padding-bottom: 2%;">
                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
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
        var aux = $('#edit-cep').val();
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
                        $('#edit-cep').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#edit-cidade').val(ce[0]);
                        $('#edit-estado').val(ce[1]).change();
                        $('#edit-bairro').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#edit-rua').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#edit-rua').val(rua[0]);
                        }else{
                            $('#edit-rua').val(cep.cep_rua);
                        }
                    }
                },
            });
        }
    }
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#edit-cnpj").mask("99.999.999/9999-99");
		$("#edit-cep").mask("99999-999");
		$("#edit-telfixo").mask("(99) 9999-9999");
	    $("#edit-telcelular").mask("(99) 9 9999-9999");
	});
</script>