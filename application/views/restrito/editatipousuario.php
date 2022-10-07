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
        
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
    }
</style>
    
    <section id="main-content">
        <section class="wrapper">
            <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
                <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>">Tipo de usuário</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edição</li>
                </ol>
            </nav>
            <div class="c-card">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-8 text-left">
                            <h2 style="color: #1b9045;"><b>Edição Tipo de Usuário</b></h2>
                        </div>
                    </div>
                </div>
                <form id="FormUserType" action="<?php echo base_url('a72c7f98d8a3989a1d47a96909cc6504');?>" method="post" enctype="multipart/form-data">
                <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <div class="col-md-4" style="display: inline-flex">
                    <label style="width: 40%; margin-top: 7px;"><b>Nome do Tipo:</b></label>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $tipo['perfilusuario_nome'] ?>" required>
                    <br>
                </div>
                <div class="col-md-12 form-group">
                    <hr style="height: 1px">
                    <h3>Defina abaixo as Permissões:</h3>
                </div>

            
                
                <input type="hidden" id="id" name="id" value="<?php echo $tipo['perfilusuario_id'] ?>">
                <div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>DASHBOARD</b></span>
                        </div>
                        <div class="col-md-8">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="dashboard" name="dashboard" <?php if($tipo['perfilusuario_dashboard'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="dashboard"><b>Dashboard</b></label>
                         </div>
                    </div>
                    <div class="col-md-12">
                        <hr style="height: 1px">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>CATÁLOGO</b></span>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="produto" name="produto" <?php if($tipo['perfilusuario_produto'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="produto"><b>Produtos</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="departamento" name="departamento"  <?php if($tipo['perfilusuario_departamento'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="departamento"><b>Departamentos</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="promocao" name="promocao"  <?php if($tipo['perfilusuario_promocao'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="promocao"><b>Promoções</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="marca" name="marca"  <?php if($tipo['perfilusuario_marca'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="marca"><b>Marcas</b></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr style="height: 1px">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>USUÁRIOS</b></span>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="cliente" name="cliente" <?php if($tipo['perfilusuario_cliente'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="cliente"><b>Clientes</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="usuario" name="usuario"  <?php if($tipo['perfilusuario_usuario'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="usuario"><b>Usuários</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="tipo" name="tipo"  <?php if($tipo['perfilusuario_tipo'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="tipo"><b>Tipo Usuários</b></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr style="height: 1px">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>FINANCEIRO</b></span>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="pedido" name="pedido"  <?php if($tipo['perfilusuario_pedido'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="pedido"><b>Pedidos</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="solicitacao" name="solicitacao"  <?php if($tipo['perfilusuario_solicitacao'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="solicitacao"><b>Solicitações</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="devolucao" name="devolucao" <?php if($tipo['perfilusuario_devolucao'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="devolucao"><b>Devoluções</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="relatorio" name="relatorio"  <?php if($tipo['perfilusuario_relatorio'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="relatorio"><b>Relatórios</b></label>
                        </div>
                    </div>
                    <!--<div class="col-md-12">-->
                    <!--    <hr style="height: 1px">-->
                    <!--    <div class="col-md-4">-->
                    <!--        <span style="font-size: 18px;color: #1b9045"><b>MARKETING</b></span>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-2">-->
                    <!--        <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="campanha" name="campanha" <?php if($tipo['perfilusuario_campanha'] == 1) { echo 'checked'; } ?>>-->
                    <!--        <label class="form-check-label" for="campanhas"><b>Campanhas</b></label>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-12">
                        <hr style="height: 1px">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>DEFINIÇÕES</b></span>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="ajuste" name="ajuste" <?php if($tipo['perfilusuario_ajuste'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="ajuste"><b>Ajustes</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="site" name="site" <?php if($tipo['perfilusuario_site'] == 1) { echo 'checked'; } ?>>
                            <label class="form-check-label" for="site"><b>Site</b></label>
                        </div>
                    </div>
                    <!-- Apenas visual -->
                    <div class="col-md-12">
                        <hr style="height: 1px">
                        <div class="col-md-4">
                            <span style="font-size: 18px;color: #1b9045"><b>Lojas</b></span>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="fornecedores" name="fornecedores">
                            <label class="form-check-label" for="fornecedores"><b>Fornecedores</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="funcionarios" name="funcionarios">
                            <label class="form-check-label" for="funcionarios"><b>Funcionários</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="estoque" name="estoque">
                            <label class="form-check-label" for="estoque"><b>Estoque</b></label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input checkboxgeral" type="checkbox" value="1" id="caixa" name="caixa">
                            <label class="form-check-label" for="caixa"><b>Caixa</b></label>
                        </div>
                    </div><br><br>
                </div>
                <input type="hidden" id="hiddennome" name="hiddennome">
            
            </div>
                <div class="col-md-12 text-right" style="margin-bottom:20px; margin-top:20px";>
                    <button type="button" onclick="selecionetudo()" class="btn btn-primary" style="position: absolute; left: 35px;">Selecionar Tudo</button>
                    <button class="btn btn-primary" type="submit">Gravar</button>
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
                </div>
            </div>
            </form>
            
        </section>

    </section>
    
    
 <script>
        function selecionetudo(){
            $('.checkboxgeral').each(function(){
                if($(this).is(':checked')){
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }
            })
        }
    </script>
    

