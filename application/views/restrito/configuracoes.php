<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.min.css')?>" />
<style>
    .card {
        height: auto;
    }
    
    .nav-tabs{
        background-color: white;
    }
    
    .nav-link{
        font-size: 25px;
    }
    
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
    
    .modal-posicao{
        position: relative;
        left: 25%;
        top: 8px;
    }
    
</style>



<!-- VENDEDORES STYLE -->

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
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
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
    
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
        cursor: pointer;
    }
    
    .force-hide{
        display: none!important;
    }
    
    .swal2-container.swal2-top.swal2-backdrop-show{
        opacity: 0.6;
        overflow-y: auto;
        margin-top: 112px;
        width: 380px;
        height: 400px;
    }
    
    .swal2-popup.swal2-toast.swal2-icon-success.swal2-show{
        width: 100%;
        height: 100%;
        display: flex;
        background-color: lightgrey;
    }
    
    .swal2-success-circular-line-left, .swal2-success-fix, .swal2-success-circular-line-right{
        display: none;
    }
    
    span.swal2-success-line-tip, span.swal2-success-line-long{
        z-index: 3!important;
    }
    
    .swal2-success-ring{
        background-color: #507525;
        z-index: 2;
    }
    
    h2#swal2-title{
        display: flex;
        color: black;
        font-size: 18px;
    }
    
    .see-pass{
        width: 10%;
        margin-left: -4px;
        margin-top: -2px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .passwd{
        width: 50%;
        display: inline;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .pagination-links a{
        color: #1b9045;
        text-decoration: none;
        padding: 5px;
        font-size: 20px;
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 2px solid grey;
    }
</style>

<div id="main-content">
    <div class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Definições</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('8fb192af45f75504361d0011c1677415') ?>">Ajustes</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b>Ajustes</b></h2>
                    </div>
                </div>
            </div>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Pagamento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="correio-tab" data-toggle="tab" href="#correio" role="tab" aria-controls="correio" aria-selected="true">Envios</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" id="transportadora-tab" data-toggle="tab" href="#transportadora" role="tab" aria-controls="transportadora" aria-selected="true">Transportadora</a>
                </li>
                -->
                <li class="nav-item">
                    <a class="nav-link" id="chaves-tab" data-toggle="tab" href="#chaves" role="tab" aria-controls="chaves" aria-selected="true">Chaves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="gestoremail-tab" data-toggle="tab" href="#gestoremail" role="tab" aria-controls="gestoremail" aria-selected="true">Email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="vendedores-tab" data-toggle="tab" href="#vendedores" role="tab" aria-controls="vendedores" aria-selected="true">Whatsapp Ecommerce</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="soon-tab" data-toggle="tab" href="#soon" role="tab" aria-controls="soon" aria-selected="true">Formas de Pagamentos</a>
                </li>
            </ul>
            
            <br>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <form action="<?php echo base_url('4534e545773fbcd02083f3380519437e');?>" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Gestor de Pagamentos</label>
                            </div>
                            <div class="col-md-8">
                                <select name="gestor" id="gestor" class="form-control" onchange="Estrutura()">
                                    <option value="" disabled selected>--- Selecione o Gestor de Pagamentos---</option>
                                    <option value="PagSeguro">--- PagSeguro ---</option>
                                    <option value="MercadoPago">--- Mercado Pago ---</option>
                                    <option value="Juno" disabled>--- Juno --- (Em breve)</option>
                                    <option value="GetNet" disabled>--- GetNet --- (Em breve)</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row form-group" id="chavePublica" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Chave Pública</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="publickey" name="publickey" placeholder="Public Key">
                            </div>
                        </div>
                        <div class="row form-group" id="chavePrivada" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Chave Privada</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="privatekey" name="privatekey" placeholder="Private Key">
                            </div>
                        </div>
                        <div class="row form-group" id="Token" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Token de Acesso</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="acesstoken" name="acesstoken" placeholder="Acess Token">
                            </div>
                        </div>
                        <div class="row form-group" id="clienteId" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Id de Cliente</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="clientid" name="clientid" placeholder="Client ID">
                            </div>
                        </div>
                        <div class="row form-group" id="secretClient" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Segredo de Cliente</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="clientsecret" name="clientsecret" placeholder="Client Secret">
                            </div>
                        </div>
                        <div class="row form-group" id="emailClient" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">Email de cadastro</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="emailPag" name="emailPag" placeholder="Email">
                            </div>
                        </div>
                        <div class="row form-group" id="sandbox" style="display:none;">
                            <div class="col-md-3">
                                <label style="font-size: x-large; float: right;">SandBox</label>
                            </div>
                            <div class="col-md-8 text-left">
                                <input type="checkbox" style="height: 25px; width: 25px;" id="sandboxId" name="sandboxId" value="1" placeholder="Sandbox">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12" style="text-align: -webkit-center;">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger" onclick="reset()">Cancelar</button>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            
                    
            <div class="tab-pane fade" id="correio" role="tabpanel" aria-labelledby="correio-tab">
                <div class="row" style="margin-top: 2%">
                    <form action="<?php echo base_url('ab8a2766f50ffb443958ea946a9ba731') ?>" method="post">    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>DIAS A MAIS PARA ENTREGA</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="entregamais6" name="entregamais6" class="cep form-control" value="<?php echo $correios[5]['dias_entrega_extra'] ?>" required>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="status6" id="status6" class="form-control">
                                            <option value="1" <?php if($correios[5]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[5]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>SEDEX</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep1" name="cep1" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[0]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="status1" id="status1" class="form-control">
                                            <option value="1" <?php if($correios[0]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[0]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>PAC</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep2" name="cep2" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[1]['cepOrigem'] ?>" required>                
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="status2" id="status2" class="form-control">
                                            <option value="1" <?php if($correios[1]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[1]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size: 15px;"><b>SEDEX 12</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep3" name="cep3" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[2]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input onchange="contrato_verificar1()" type="text" id="contrato3" name="contrato3" class="form-control" placeholder="Contrato" value="<?php echo $correios[2]['contratoCorreio'] ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="status3" id="status3" class="form-control" disabled>
                                            <option value="1" <?php if($correios[2]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[2]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>SEDEX 10</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep4" name="cep4" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[3]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input onchange="contrato_verificar2()" type="text" id="contrato4" name="contrato4" class="form-control" placeholder="Contrato" value="<?php echo $correios[3]['contratoCorreio'] ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="status4" id="status4" class="form-control" disabled>
                                            <option value="1" <?php if($correios[3]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[3]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>SEDEX HOJE</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep5" name="cep5" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[4]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input onchange="contrato_verificar3()" type="text" id="contrato5" name="contrato5" class="form-control" placeholder="Contrato" value="<?php echo $correios[4]['contratoCorreio'] ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select name="statu5" id="status5" class="form-control" disabled>
                                            <option value="1" <?php if($correios[4]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[4]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>GRÁTIS POR COMPRA</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep7" name="cep7" class="cep form-control" placeholder="CEP ORIGEM"  value="<?php echo $correios[6]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select onchange="verifica_gratis(1)" name="status7" id="status7"  class="form-control">
                                            <option value="1" <?php if($correios[6]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[6]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                        <input type="text" id="valor7" name="valor7" class="money form-control" placeholder="Valor"  value="<?php echo $correios[6]['valorMinimo'] ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <input type="text" id="entregamais7" name="entregamais7" class="cep form-control" placeholder="Dias" value="<?php echo $correios[6]['dias_entrega_extra'] ?>">
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>GRÁTIS POR ESTADO(S)</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep8" name="cep8" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[7]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select onchange="verifica_gratis(2)" name="status8" id="status8"  class="form-control">
                                            <option value="1" <?php if($correios[7]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[7]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <select id="estados8" name="estados8[]" multiple class="js-example-basic-multiple" style="width: 100%!important">
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
                                    <div class="col-md-1 form-group">
                                        <input type="text" id="entregamais8" name="entregamais8" class="cep form-control" placeholder="Dias" value="<?php echo $correios[7]['dias_entrega_extra'] ?>">
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-3 form-group text-center">
                                        <label class="nome-form" style="font-size:15px;"><b>GRÁTIS POR ESTADO(S) E VALOR</b></label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="cep9" name="cep9" class="cep form-control" placeholder="CEP ORIGEM" value="<?php echo $correios[8]['cepOrigem'] ?>" required>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <select onchange="verifica_gratis(3)" name="status9" id="status9"  class="form-control">
                                            <option value="1" <?php if($correios[8]['dadosAtivo'] == 1){ echo 'selected'; }  ?>>Ativo</option>
                                            <option value="0" <?php if($correios[8]['dadosAtivo'] == 0){ echo 'selected'; }  ?>>Inativo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group ">
                                        <select id="estados9" name="estados9[]" multiple class="js-example-basic-multiple" style="width: 100%!important">
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
                                    <div class="col-md-1 form-group">
                                        <input type="text" id="valor9" name="valor9" class="money form-control" placeholder="Valor"  value="<?php echo $correios[8]['valorMinimo'] ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <input type="text" id="entregamais9" name="entregamais9" class="cep form-control" placeholder="Dias" value="<?php echo $correios[8]['dias_entrega_extra'] ?>">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12" style="text-align: -webkit-center;">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger" onclick="reset()">Cancelar</button>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="tab-pane fade" id="chaves" role="tabpanel" aria-labelledby="chaves-tab">
                <form action="<?php echo base_url('7da8089498f0ac8e05a26d6a0f535403') ?>" method="post">
                    <input type="hidden" name="google-id" id="google-id" class="form-control" value="1">
                    
                    <div class="row" style="margin-top: 2%">
                        <div class="col-md-12">
                            <div class="col-md-2 form-group text-center">
                                <label class="nome-form" style="font-size:15px;"><b>Google Captcha Key V3</b></label>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="google-key" id="google-key" class="form-control" value="<?php echo $chave['chave_site'] ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 form-group text-center">
                                <label class="nome-form" style="font-size:15px;"><b>Google Captcha Keys V2</b></label>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="google-key2" id="google-key2" class="form-control" value="<?php echo $chave2['chave_site'] ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-12" style="text-align: -webkit-center;">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" onclick="reset()">Cancelar</button>
                            <br><br>
                        </div>
                    </div>
                </form>
            </div>
            
            
            <div class="tab-pane fade" id="gestoremail" role="tabpanel" aria-labelledby="gestoremail-tab">
                <form action="<?php echo base_url('1b447af94eb10e8831c155c01be26599') ?>" method="post">
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>PROTOCOL</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_protocol" name="email_protocol" class="form-control" placeholder="Protocol" value="<?php echo $email['email_protocol']; ?>" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>SMTP_USER</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_user" name="email_user" class="form-control" placeholder="smtp_usuário" value="<?php echo $email['email_user']; ?>" required>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>SMTP_PASS</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_pass" name="email_pass" class="form-control" placeholder="smtp_pass" value="<?php echo $email['email_pass']; ?>" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>SMTP_HOST</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_host" name="email_host" class="form-control" placeholder="smtp_host" value="<?php echo $email['email_host']; ?>" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>SMTP_PORT</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_port" name="email_port" class="form-control" placeholder="smtp_port" value="<?php echo $email['email_port']; ?>" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>SMTP_TIMEOUT</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_timeout" name="email_timeout" class="form-control" placeholder="smtp_timeout" value="<?php echo $email['email_timeout']; ?>" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3 form-group text-center">
                            <label class="nome-form" style="font-size: 15px;"><b>CHARSET</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" id="email_charset" name="email_charset" class="form-control" placeholder="Charset" value="<?php echo $email['email_charset']; ?>" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12" style="text-align: -webkit-center;">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" onclick="reset()">Cancelar</button>
                            <br><br>
                        </div>
                    </div>
                </form>
            </div>
            
            
            <div class="tab-pane fade" id="soon" role="tabpanel" aria-labelledby="soon-tab">
                <div class="row" style="margin-top: 2%">
                    <div class="col-md-12 form-group">
                        <div class="col-md-12">
                            <h3><b>Formas de Pagamento:</b><h3>
                        </div>
                        <hr style="width: 95%!important; border-top: 1px solid #79797959; margin-left: 2.5%!important; margin-top: 20px!important; margin-bottom: 20px!important;">
                    </div>
                </div>
                
                <form action="<?php echo base_url('admin/adminajustes/atualizarFormasPag') ?>" method="post">
                    <?php if(count($formas_pagamento) > 0){;
                        $var = count($formas_pagamento);
                        $aux = 0; foreach($formas_pagamento as $formaP){?>
                        <div class="row"id="formaPagamento<?php echo $aux;?>">
                            <div class="col-md-2" style="text-align:-webkit-center;">
                                <?php if($var == $aux+1){ ?>
                                <button id="buttonForma<?php echo $aux;?>" type="button" class="btn btn-success" onclick="novaforma(<?php echo $aux;?>)">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                <?php } ?>
                            </div>
                            <div class="col-md-10">
                                <div class="row" style="padding: 0 25px;">
                                    <div class="col-md-4 form-group">
                                        <label><b>Nome:</b></label>
                                         <input id="nome_forma" name="nome_forma<?= $aux ?>" type="text" class="form-control" value="<?php echo $formaP['nome_forma']  ?>">
                                         <input id="id" name="id_<?= $aux ?>" type="hidden" class="form-control" value="<?php echo $formaP['id_forma']  ?>">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>% de acrescimo:</b></label>
                                        <input id="cartao_acrescimo" name="cartao_crescimo<?= $aux ?>" type="text" class="form-control" value="<?php echo $formaP['acrescimo_forma']  ?>">
                                    </div>
                                    <div class="col-md-2 ">
                                        <label><b>Exibir:</b></label>
                                        <select id="cartao_ativo" name="cartao_ativo<?= $aux ?>" class="form-control">
                                            <option value="1" <?php if($formaP['ativo_forma'] == 1){echo 'selected';} ?>>Ativo</option>
                                            <option value="0" <?php if($formaP['ativo_forma'] == 0){echo 'selected';} ?>>Inativo</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <?php $aux++; } }else{?>
                        <div class="row"id="formaPagamento0">
                            <div class="col-md-2" style="text-align:-webkit-center;">
                                <button id="buttonForma0" type="button" class="btn btn-success" onclick="novaforma(0)">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-md-11">
                                <div class="row" style="padding: 0 25px;">
                                    <div class="col-md-3 form-group">
                                        <label><b>Nome:</b></label>
                                         <input id="nome_forma" name="nome_forma<?= $aux ?>" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>% de acrescimo:</b></label>
                                        <input id="cartao_acrescimo" name="cartao_crescimo<?= $aux ?>" type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-md-2 ">
                                        <label><b>Exibir:</b></label>
                                        <select id="cartao_ativo" name="cartao_ativo<?= $aux ?>" class="form-control">
                                            <option value="1">Ativo</option>
                                            <option value="1">Inativo</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <?php }?>
                        <input id="cont" name="cont" type="hidden" class="form-control" value="<?= $aux?>">
                    <br><br>
                    <div class="row form-group">
                        <div class="col-md-12" style="text-align: -webkit-center;">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" onclick="reset()">Cancelar</button>
                            <br><br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="vendedores" role="tabpanel" aria-labelledby="vendedores-tab">
                <div class="c-card">
                    <div class="c-card-header">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <h2 style="color: #1b9045;"><b>Listagem de vendedores</b></h2>
                            </div>
                            <form action="<?php echo base_url('edb728d5b2d758ff44b1b0e9f991ead9') ?>" method="post">
                            <div class="col-md-6">
                                <div class="button-area">
                                    <button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item" data-toggle="modal" data-target="#vendedor_adicionarmodal"><em class="fa fa-plus"></em></button></a>
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
                                    <th style="width: 25%">Nome</th>
                                    <th style="width: 25%">Whats</th>
                                    <th style="width: 25%">Prioridade</th>
        			                <th class="text-center" style="width: 25%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vendedores as $v){ ?>
                                <tr>
                                    <td><?php echo ucwords(mb_strtolower($v['vendedor_nome'])); ?></td>
                                    <td class="telefone"><?php echo $v['vendedor_whats'] ?></td>
                                    <td><?php echo $v['vendedor_prioridade'] ?></td>
                                    <td style="color: #1b9045; font-size: 22px!important" class="text-center">
        			                    <a onclick="getVendedor(<?php echo $v['vendedor_id'] ?>)" style="color: #1b9045;" data-toggle="modal" data-target="#vendedor_vermodal"><i class="fa fa-eye" aria-hidden="true"></i></a>
        			                    <a onclick="getVendedor(<?php echo $v['vendedor_id'] ?>)" style="color: #1b9045;" data-toggle="modal" data-target="#vendedor_editarmodal"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
        			                    <i onclick="getVendedor(<?php echo $v['vendedor_id'] ?>)" data-toggle="modal" data-target="#vendedor_excluirmodal" style="padding-left: 12px; color: #1b9045" class="fa fa-trash" aria-hidden="true"></i>
            			            </td>
        			            </tr>   
        			            <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <?php if($vendedores == null) { ?>
            		        <div class="col-md-12 text-center">
            		            <p>Nenhuma vendedor encontrada!</p>
            		        </div>
        		        <?php } ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="pagination-links"><?php echo $links; ?></p>
                            </div>
                        </div>
                    <?php if(isset($produtos)){ ?>
                        <?php if($produtos == null) { ?>
            		        <div class="col-md-12 text-center">
            		            <p>Nenhuma vendedor encontrada!</p>
            		        </div>
            		    <?php } ?>
        		    <?php } ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!--<p class="pagination-links"><?php echo $links; ?></p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAIS VENDEDORES -->

<!-- excluir -->

<div class="modal" tabindex="-1" role="dialog" id="vendedor_excluirmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminvendedores/excluirVendedor') ?>" method="post">
          <input type="hidden" id="id_excluir" name="id_excluir">
          <input type="hidden" id="prod_vendedor_id" name="prod_vendedor_id">
          <div class="modal-body">
              <p style="font-size: 17px;"><b> Deseja excluir a vendedor? </b><p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- adicionar -->

<div class="modal fade" id="vendedor_adicionarmodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_adicionarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">ADICIONAR VENDEDOR</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminvendedores/insertVendedor') ?>" method="post">
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da vendedor: </b></label>
                        <input type="text" id="cad_nome" name="cad_nome" class="form-control" value="" required>
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Whats da vendedor: </b></label>
                        <input type="text" id="cad_whats" name="cad_whats" class="telefone form-control" value="" required>
                     </div>  
                </div>
                <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Prioridade: </b></label>
                        <input type="number" id="cad_prioridade" name="cad_prioridade" class="form-control" required>
                     </div>  
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- editar -->

<div class="modal fade" id="vendedor_editarmodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_editarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">EDITAR VENDEDOR</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminvendedores/updateVendedor') ?>" method="post">
          <input type="hidden" id="id_editar" name="id_editar">
          
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da vendedor: </b></label>
                        <input type="text" id="editar_nome" name="editar_nome" class="form-control">
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Whats da vendedor: </b></label>
                        <input type="text" id="editar_whats" name="editar_whats" class="telefone form-control" value="" required>
                     </div>   
                </div>
                <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Prioridade: </b></label>
                        <input type="number" id="editar_prioridade" name="editar_prioridade" class="form-control" required>
                     </div>  
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- ver -->

<div class="modal fade" id="vendedor_vermodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_vermodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">VER VENDEDOR</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da vendedor: </b></label>
                        <input type="text" id="ver_nome" name="ver_nome" class="form-control" readonly>
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Whats da vendedor: </b></label>
                        <input type="text" id="ver_whats" name="ver_whats" class="telefone form-control" readonly>
                     </div>  
                </div>
                <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Prioridade: </b></label>
                        <input type="text" id="ver_prioridade" name="ver_prioridade" class="telefone form-control" readonly>
                     </div>  
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
    </div>
  </div>
</div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
 <script src="<?php echo base_url('assets/js/bootstrap-multiselect.min.js')?>"></script>
 
 <script>
    $(document).ready(function(){
        <?php $aux = explode('¬', $correios[7]['regiaoGratis']); ?>
        <?php foreach($aux as $a){ ?>
            $("#estados8 option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
        <?php } ?>
        
        <?php $aux = explode('¬', $correios[8]['regiaoGratis']); ?>
        <?php foreach($aux as $a){ ?>
            $("#estados9 option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
        <?php } ?>
        
        if($('#contrato3').val() != "" && $('#contrato3').val() != " "){
            $('#status3').prop('disabled', false);
        }
        if($('#contrato4').val() != "" && $('#contrato4').val() != " "){
            $('#status4').prop('disabled', false);
        }
        if($('#contrato5').val() != "" && $('#contrato5').val() != " "){
            $('#status5').prop('disabled', false);
        }
        
        $('#cartao_ativo').val(<?php echo $cartao['ativo_forma'] ?>).change();
        $('#boleto_ativo').val(<?php echo $boleto['ativo_forma'] ?>).change();
        $('#transferencia_ativo').val(<?php echo $transferencia['ativo_forma'] ?>).change();
        
        $('#cartao_desconto_ativo').val(<?php echo $cartao['desconto_ativo_forma'] ?>).change();
        $('#boleto_desconto_ativo').val(<?php echo $boleto['desconto_ativo_forma'] ?>).change();
        $('#transferencia_desconto_ativo').val(<?php echo $transferencia['desconto_ativo_forma'] ?>).change();
        
        
        $('.cep').mask('00000-000');
        $('.money').mask("#.##0,00", {reverse: true});
        
        $('#payment-tab').click();
        
        $('#framework').multiselect({
            nonSelectedText: 'Estados',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'400px'
         });
     
        $('#framework_form').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
             $.ajax({
                url:"insert.php",
                method:"POST",
                data:form_data,
                success:function(data){
                    $('#framework option:selected').each(function(){
                        $(this).prop('selected', false);
                    });
                    $('#framework').multiselect('refresh');
                    alert(data);
                }
            });
        });
     });
     
</script>

<script>
    function novaForma(id){
        dados = new FormData();
        dados.append('row', id);
        $.ajax({
            url: '<?php echo base_url('admin/adminajustes/newFormaLista'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                document.getElementById('buttonForma'+id).remove();
                $('#formaPagamento'+id).after(JSON.parse(data));
                var qtd = $('#qtdPerg').val();
                qtd = parseInt(qtd)+parseInt(1);
                $('#qtdPerg').val(qtd);
            }
        });
    }
</script>

<script>
    function Estrutura(){
        var x = document.getElementById("gestor").value;
        if(x == "PagSeguro"){
            PagSeguro();
            $('#acesstoken').val('<?php echo $pagamentos[0]['gestor_acesstoken'] ?>');
            $('#emailPag').val('<?php echo $pagamentos[0]['gestor_email'] ?>');
            if(<?php echo $pagamentos[0]['gestor_sandbox'] ?> == 1){
                $('#sandboxId').prop('checked', true);    
            } else {
                $('#sandboxId').prop('checked', false);    
            }
        }else if(x == "MercadoPago"){
            MercadoPago();
        }else if(x == "Juno"){
            Juno();
        }else if(x == "GetNet"){
            GetNet();
        }
    }
</script>

<script>
    function MercadoPago(){
        document.getElementById('Token').style.display = "flex";
        document.getElementById('chavePublica').style.display = "flex";
        document.getElementById('chavePrivada').style.display = "none";
        document.getElementById('clienteId').style.display = "flex";
        document.getElementById('secretClient').style.display = "flex";
        document.getElementById('emailClient').style.display = "flex";
        document.getElementById('sandbox').style.display = "flex";
        
        getGestor()
    }
</script>

<script>
    function getGestor(){
        var dados = new FormData();
        dados.append('gestor', $('#gestor').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminajustes/getDinamicoGestor'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#acesstoken').val(data.gestor_acesstoken);
                $('#publickey').val(data.gestor_publickey);
                $('#privatekey').val(data.gestor_privatekey);
                $('#clientid').val(data.gestor_clientid);
                $('#clientsecret').val(data.gestor_clientsecret);
                $('#emailPag').val(data.gestor_email);
                if(data.gestor_sandbox == 1){
                    $('#sandboxId').attr('checked', true);
                } else {
                    $('#sandboxId').attr('checked', false);
                }
                
            },
        });
    }
</script>


<script>
    
    
    
    function PagSeguro(){
        document.getElementById('chavePublica').style.display = "none";
        document.getElementById('chavePrivada').style.display = "none";
        document.getElementById('clienteId').style.display = "none";
        document.getElementById('secretClient').style.display = "none";
        document.getElementById('Token').style.display = "flex";
        document.getElementById('emailClient').style.display = "flex";
        document.getElementById('sandbox').style.display = "flex";
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[0]['gestor_acesstoken'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[0]['gestor_email'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[0]['gestor_sandbox'] ?>;
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[0]['gestor_clientid'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[0]['gestor_publickey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[0]['gestor_privatekey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[0]['gestor_clientsecret'] ?>;

    }
    
    
    
    function Juno(){
        document.getElementById('Token').style.display = "flex";
        document.getElementById('chavePublica').style.display = "flex";
        document.getElementById('chavePrivada').style.display = "none";
        document.getElementById('clienteId').style.display = "none";
        document.getElementById('secretClient').style.display = "none";
        document.getElementById('emailClient').style.display = "none";
        document.getElementById('sandbox').style.display = "flex";
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[2]['gestor_acesstoken'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[2]['gestor_email'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[2]['gestor_sandbox'] ?>;
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[2]['gestor_clientid'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[2]['gestor_publickey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[2]['gestor_privatekey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[2]['gestor_clientsecret'] ?>;
    }
    
    function GetNet(){
        document.getElementById('Token').style.display = "none";
        document.getElementById('chavePublica').style.display = "flex";
        document.getElementById('chavePrivada').style.display = "flex";
        document.getElementById('clienteId').style.display = "none";
        document.getElementById('secretClient').style.display = "none";
        document.getElementById('emailClient').style.display = "none";
        document.getElementById('sandbox').style.display = "flex";
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[3]['gestor_acesstoken'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[3]['gestor_email'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[3]['gestor_sandbox'] ?>;
        //document.getElementById('acesstoken').value = <?php echo $pagamentos[3]['gestor_clientid'] ?>;
        //document.getElementById('emailPag').value = <?php echo $pagamentos[3]['gestor_publickey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[3]['gestor_privatekey'] ?>;
        //document.getElementById('sandboxId').value = <?php echo $pagamentos[3]['gestor_clientsecret'] ?>;
    }

</script>


<script>
    function contrato_verificar1(){
        if($('#contrato3').val() != "" && $('#contrato3').val() != " "){
            $('#status3').prop('disabled', false);
        }
    }
    function contrato_verificar2(){
        if($('#contrato4').val() != "" && $('#contrato4').val() != " "){
            $('#status4').prop('disabled', false);
        }
    }
    function contrato_verificar3(){
        if($('#contrato5').val() != "" && $('#contrato5').val() != " "){
            $('#status5').prop('disabled', false);
        }
    }
</script>

<script>
    function verifica_gratis(id){
        if(id == 1){
            if($('#status6').val() == 1){
                if($('#status8').val() != 0){
                    $('#status8').val(0).change();    
                }
            } 
        } else if(id == 2) {
            if($('#status7').val() == 1){
                if($('#status8').val() != 0){
                    $('#status8').val(0).change();    
                }
            } 
        } else if(id == 3) {
            if($('#status8').val() == 1){
                if($('#status6').val() != 0){
                    $('#status6').val(0).change();
                }
                if($('#status7').val() != 0){
                    $('#status7').val(0).change();
                }
            }
        }
    }
</script>

<script>
    function getVendedor(id){
        var dados = new FormData();
        dados.append('id', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminvendedores/getVendedorId'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#ver_nome').val(data.vendedor_nome);
                $('#ver_whats').val(data.vendedor_whats);
                $('#ver_prioridade').val(data.vendedor_prioridade);
                
                $('#id_editar').val(id);
                $('#editar_nome').val(data.vendedor_nome);
                $('#editar_whats').val(data.vendedor_whats);
                $('#editar_prioridade').val(data.vendedor_prioridade);
                
                $('#id_excluir').val(id);
            },
        });
    }
</script>