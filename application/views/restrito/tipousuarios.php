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
    
    .c-aprovados{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(76 175 80 / 40%);
        background: linear-gradient(60deg, #66bb6a, #43a047);
    }
    
    .c-negadas{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(244 67 54 / 40%);
        background: linear-gradient(60deg, #ef5350, #e53935);
    }
    
    .c-titulos{
        box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 188 212 / 40%);
            background: linear-gradient(60deg, #26c6da, #00acc1);
    }
    
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
    }
    
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
    }
    
    .c-card-category{
        color: black;
        font-size: 14px;
        margin: 0;
        padding-top: 10px;
        font-weight: bold;
    }
    
    .c-card-title{
        margin: 0;
        color: #3C4858;
        font-size: 1.5625rem;
        line-height: 1.4em;
    }
    
    .c-card-title small{
        font-size: 80%;
        font-weight: 400;
    }
    
    .c-card-footer{
        border-top: 1px solid #d6d5d5;
        margin-top: 20px;
        padding: 0;
        padding-top: 10px;
        margin: 0 15px 10px;
        border-radius: 0;
        justify-content: flex-end;
        align-items: center;
        display: flex;
        background-color: transparent;
    }
    
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    
    .c-stats{
        color: #999999;
        font-size: 12px;
        line-height: 22px;
        display: inline-flex;
    }
    
    .c-stats-icon{
        position: relative;
        top: 4px;
        font-size: 16px;
        margin-right: 3px;
        margin-left: 3px;
        color: grey;
    }
    
    .c-stats-text{
        color: grey;
    }
    
    .c-table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    
    .c-table thead{
        color:  #1b9045!important;
    }
    
    .c-table thead tr th{
        padding: 8px;
        vertical-align: middle;
    }
    
    .c-table tbody tr td {
        padding: 8px;
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }
    
    .c-table tbody tr:hover{
        cursor: pointer;
        background-color: #eee!important;
    }
    
    .check-all{
        width: 32px;
        font-size: 12px;
        color: white;
        background-color: #9c27b0;
        border: 0;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    
    .button-area{
        margin-top: 20px;
    }
    
    .button-custom{
        color: white;
        background-color: #9c27b0;
        border: 0;
        font-size: 14px;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    
    .search{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .form-control-custom{
        border-radius: 5px;
        border: 1px solid #80808061;
        padding: 5px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-right: -4px;
        height: 32px;
        width: 165px;
        color: black;
    }
    
    .form-control-custom:focus {
        outline: unset;
        border: 2px solid #43006d;
        color: #43006d;
    }
    
    .search-field{
        width: 200px;
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
    }
    
    .def-item{
        display: block;
        padding: 7px 10px;
        color: black;
        font-size: 14px;
    }
    
    .check{
        min-width: 20px;
        min-height: 20px;
    }
    
    .mr-15{
        margin-right: 15px;
    }
    
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
    }
    .pagination-links a{
        color: #1b9045;
        text-decoration: none;
        padding: 5px;
        font-size: 20px;
        margin: 2px;
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 2px solid #1b9045;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>">Tipo de usuários</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-8 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Tipos de Usuários</b></h2>
                    </div>
                    <form action="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>" method="post">
                        <div class="col-md-4">
                            <div class="button-area">
                                <!--<a href="<?php echo base_url('14267d773d7f7f555f32bea51aedd010') ?>"><button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Tipo"><em class="fa fa-plus"></em></button></a>-->
                            <div class="search-field">
                                <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="c-card-body">
                <div class="table-responsive" style="width: 100%">
                    <table class="table c-table" id="tabela">
                        <thead>
                            <tr>
                                <th style="width: 45%">Nome do Perfil</th>
    			                <th style="width: 20%">Criado em</th>
    			                <th class="text-center" style="width: 20%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $at){ ?>
    			            <tr class="tr-check">
    			                <td><?php echo ucwords(mb_strtolower($at['perfilusuario_nome'])) ?></td>
    			                <td><?php echo date('d/m/Y', strtotime($at['perfilusuario_create'])) ?></td>
    			                <td style="color: #1b9045; font-size: 22px!important" class="text-center">
    		                        <a style="color: #1b9045;" href="<?php echo base_url('89c668a56667d167778b11b98d4e7796/' . $at['perfilusuario_id'] ) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
    		                        <!--<a style="color: #1b9045;" href="<?php echo base_url('166437d3eb8ee7c6f43322b8b71e9ea8/' . $at['perfilusuario_id'] ) ?>"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>-->
    		                        <!--<i  data-toggle="modal" data-target="#modalExcluir" onclick="excluir(<?php echo $at['perfilusuario_id'] ?>)" style="padding-left: 12px; color: #1b9045" class="fa fa-trash" aria-hidden="true"></i>-->
    		                    </td>
    			            </tr>
    			            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($usuarios == null) { ?>
		        <div class="col-md-12 text-center">
		            <p>Nenhum tipo de usuário encontrado!</p>
		        </div>
		    <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="pagination-links"><?php echo $links; ?></p>
                </div>
            </div>
        </div>
    </section>
</section>


<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalCancelarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                <h4 style="display:inline;" class="modal-title" id="modalCancelarLabel">Aviso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('7e6d218f033995cb0d4539f77bd6dc3c')?>" method="post" id="form">
                <div class="modal-body form-group">
                    <p style="font-size: 17px;"><b>Deseja Excluir o tipo de usuário?</b></p>
                    <hr style='height: 1px; background-color: lightgrey; border: none;'>
                    <div style="display: block; text-align: right" id="btnconfirmacao">
                        <button type="button" class="btn btn-primary" onclick="showForm()">Continuar</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div style="display: none" id="formsenha">
                        <label style="color: black; font-size: 20px">Confirme a sua senha:</label><br>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div style="display: none" id="diverro">
                        <br>
                        <label class="text-danger" style="font-size: 18px">A senha inserida esta incorreta, por favor tente novamente!</label>
                        <br>
                    </div>
                </div>
                <div class="modal-footer" style="display: none" id="footermodal">
                    <button type="button" class="btn btn-primary" onclick="verSenha()">Confirmar</button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function excluir(value){
        $('#id').val(value);
    }
</script>

<script>
    function verSenha(){
        var senha = document.getElementById('senha').value;
        dados = new FormData();
        dados.append('senha', senha);
        $.ajax({
            url: '<?php echo base_url('444b70aa51ba969ce31c8fc0e2d4066a'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == 1){
                    $('#form').submit();
                }else{
                    document.getElementById('diverro').style.display = "block";
                }
            },
        }); 
    }
    
    function showForm(){
        document.getElementById('btnconfirmacao').style.display = "none";
        document.getElementById('formsenha').style.display = "block";
        document.getElementById('footermodal').style.display = "block";
    }
</script>