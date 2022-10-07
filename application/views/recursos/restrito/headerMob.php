<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <!-- Algumas informações e configurações -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="N Soluções Agência Digital - www.nsoluti.com.br" />
        <title>Ecommerce - Admin</title>
        
        <!-- FavIcon -->
        <link href="<?php echo base_url('resources/'); ?>assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
        
        <!-- Bootstrap & FontAwesome -->
        <link href="<?php echo base_url('assets/admin/');?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/');?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
        
        <!-- JQuery -->
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
        
        <!-- DataTables & Select2 -->
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('resources/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('resources/select2/dist/css/select2-bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        
        <!-- Custom Style -->
        <link href="<?php echo base_url('assets/admin/');?>css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/');?>css/style-responsive.css" rel="stylesheet" type="text/css">
        
        <!-- SweetAlert2 -->
        <link href="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css">
        
        <!-- Não sei se é necessário, mas ta aqui -->
        <link href="<?php echo base_url('assets/admin/');?>css/zabuto_calendar.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/');?>lib/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons' rel='stylesheet' type='text/css'/>
        <?php if($this->session->userdata('header')){?>
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel='stylesheet'>
        <link href='<?php echo base_url('recursos/css/');?>material/material-dashboard.css?v=2.1.2' rel='stylesheet' />
        <?php }?>
        <script src="<?php echo base_url('assets/admin/');?>lib/chart-master/Chart.js"></script>        
    </head>
    
    <?php
        //-> Verifica com o navegador qual o dispositivo sendo usado
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile_header = 1;
        } else {
            $mobile_header = 0;
        }
    ?>
    
    <body style="background: #f7f7f7;">
        <section id="container">
            <!-- **********************************************************************************************************************************************************
                TOP BAR CONTENT & NOTIFICATIONS
                *********************************************************************************************************************************************************** -->
            <!--header start-->
            <style>
                .select2-container--bootstrap.select2-container--focus .select2-selection, .select2-container--bootstrap.select2-container--open .select2-selection {
                    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(53 216 103 / 60%);
                    border-color: #1b9045!important;
                }
                .form-control:focus{
                    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(53 216 103 / 60%);
                    border-color: #1b9045!important;
                }
                .select2-container--bootstrap .select2-dropdown{
                    border-color: #1b9045!important;
                }
                .select2-container--bootstrap .select2-results__option--highlighted[aria-selected]{
                    background-color:#1b9045!important;
                }
                #opts .col-md-2{
                    padding: 0 10px;
                    position: relative;
                }
                .bl{
                    border-left: 1px solid #ffffff54;
                }
                .opt-menu{
                    color: white;
                    font-size: 14px;
                    margin: 0 0;
                    cursor: pointer;
                }
                .opt-menu:hover{
                    color: #1b9045!important;
                }
                .ativo-h, .ativo-h:hover{
                    color: #1b9045!important;
                }
                #main-content{
                    margin-left: 0px;
                }
                <?php if($mobile_header == 0){
                    echo ".wrapper{
                        margin-top: 78px;
                    }";
                } ?>
                ::selection {
                    background: #1b9045!important;
                    color: #fff;
                }
                .custom-drop{
                    top: 30px;
                    display: none;
                    position: absolute;
                    width: fit-content;
                    background-color: transparent;
                    z-index: 9;
                    right: 2%;
                    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                }
                .drop-content{
                    width: 100%;
                    background-color: white;
                    padding: 3px 6px;
                    margin-top: 15px;
                }
                .drop-content a p{
                    color: black;
                    font-size: 12px;
                    text-decoration: none;
                    width: 100%;
                    margin: 3px 0;
                    padding: 6px 3px;
                    text-align: left;
                }
                .drop-content a p:hover{
                    color: black;
                    cursor: pointer;
                    background-color: #1b9045!important;
                }
                .bb{
                    border-bottom: 1px solid lightgrey;
                }
                @keyframes fade-in {
                    from {opacity: 0;}
                    to {opacity: 1;}
                }
                .btn-danger{
                    box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(217 83 79 / 40%);
                    border: 0;
                }
                .btn-primary, .btn-primary:active{
                    background: #1b9045!important;
                    border-color: transparent!important;
                    border: 0;
                    box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
                }
                .open>.dropdown-toggle.btn-primary{
                    background: #1b9045!important;
                    border-color: transparent!important;
                    border: 0;
                    box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
                }
                .btn-primary:hover{
                    animation: roda 5s infinite;
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
                    background-color: lightgrey;
                    border-color: lightgrey;
                    background: lightgrey;
                }
                .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                    background: linear-gradient( 60deg, #1b9045!important, #1b9045!important);
                    border-color: transparent!important;
                }
                .show-menu{
                    background-color: transparent;
                    border-color: transparent;
                    margin-top: 18px;
                    width: 25px;
                    float: right;
                }
                .show-menu em{
                    font-size: 22px;
                    color: white;
                }
                #hide_menu{
                    position: fixed;
                    top: 60px;
                    right: -180px;
                    background-color: #22242a;
                    opacity: 0.8;
                    z-index: 99;
                    padding: 10px;
                }
                .hide-opt, .hide-opt-sem{
                    padding: 8px 4px;
                    width: 100%;
                }
                .hide-opt p, .hide-opt-sem p{
                    color: white;
                    font-size: 14px;
                    font-weight: bold;
                }
                .hide-opt-menu{
                    display: none;
                    padding: 4px 14px 4px 4px;
                    width: 100%;
                    animation: growDown 300ms ease-in-out forwards;
                    transform-origin: top center;
                }
                .hide-opt-menu p{
                    font-size: 11px;
                    color: white;
                }
                @keyframes growDown {
                    0% {
                        transform: scaleY(0)
                    }
                    80% {
                        transform: scaleY(1.1)
                    }
                    100% {
                        transform: scaleY(1)
                    }
                }
                .img-logo{
                    width: 250px;
                }
                .show-principal{
                    padding-bottom: 67%;
                }
                
                .header-icons{
                    position: relative;
                    top: 12px;
                    right: 8px;
                }
                
                .fa-caret-down{
                    position: relative;
                    top: -8px;
                    left: -2.5px;
                }
            </style>
            

            <!--background: linear-gradient( 60deg, #ab47bc, #8e24aa);-->
            <header class="header" style="height: 75px; background: black;">
                <div class="" style="display: flex;">
                    <div class="">
                        <!--<h3 style="color: white; font-weight: 500;">CellStore</h3>-->
                        <img style="height: auto; width: 120px; margin-top: 10px;" src="<?php echo base_url('/imagens/site/logo.png')?>" alt="">
                    </div>
                    <div class="" style="margin-left: auto;">
                        <div style="display: flex; padding: 4%;">
                            <?php if($perm['perfilusuario_dashboard'] == 1 || $super == 1){ ?>
                                <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center" style="margin-left: 40%;">
                                    <a href="<?php echo base_url('106a6c241b8797f52e1e77317b96a201') ?>">
                                        <p class="opt-menu <?php if($idpag == 1){echo "ativo-h";} ?>">
                                            <i style="font-size: 30px" class="header-icons fa fa-line-chart" aria-hidden="true" title="Dashboard"></i><br>
                                        </p>
                                    </a>
                                </div>
                            <?php } ?>
                            
                            <?php if($perm['perfilusuario_produto'] == 1 || $perm['perfilusuario_departamento'] == 1 || $super == 1){ ?>
                                <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                    <p class="opt-menu <?php if($idpag == 2){echo "ativo-h";} ?>">
                                    <i style="font-size: 25px" class="header-icons fa fa-newspaper-o" aria-hidden="true" title="Catálogo"></i><br>
                                    <!--CATALOGO-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                    <div class="custom-drop">
                                        <div class="drop-content">
                                            <?php if($perm['perfilusuario_produto'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('391a027a8fef2eba4487a00156901156') ?>"><p class="bb">Produtos</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('48b6bbfcf12b55d9b0e4c2ded7384bff') ?>"><p class="bb">Departamentos</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('admin/admindepartamentos/subDepartamentos') ?>"><p class="bb">Sub Departamentos</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_promocao'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>"><p>Promoções</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_marca'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('edb728d5b2d758ff44b1b0e9f991ead9') ?>"><p>Marcas</p></a>
                                            <?php } ?>
                                            <?php //if($perm['perfilusuario_opcao'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('admin/adminopcoes/opcoes') ?>"><p>Opções</p></a>
                                            <?php //} ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <?php if($perm['perfilusuario_cliente'] == 1 || $perm['perfilusuario_usuario'] == 1 || $perm['perfilusuario_tipo'] == 1 || $super == 1){ ?>
                                <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                    <p class="opt-menu <?php if($idpag == 3){echo "ativo-h";} ?>">
                                    <i style="font-size: 25px" class="header-icons fa fa-user-o" aria-hidden="true" title="Usuários"></i><br>
                                    <!--USUÁRIOS-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                    <div class="custom-drop">
                                        <div class="drop-content">
                                            <?php if($perm['perfilusuario_cliente'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>"><p class="bb">Clientes</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_usuario'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('0d658457c62859e2c93026f9f70ce219') ?>"><p class="bb">Usuários</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_tipo'] == 1 || $super == 1 || $_SESSION['perfil']) { ?>
                                                <a href="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>"><p class="bb">Tipo Usuário</p></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($perm['perfilusuario_pedido'] == 1 || $perm['perfilusuario_solicitacao'] == 1 || $perm['perfilusuario_devolucao'] == 1 || $perm['perfilusuario_relatorio'] == 1 || $super == 1 || $_SESSION['perfil'] == 10){ ?>
                                <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                    <p class="opt-menu <?php if($idpag == 4){echo "ativo-h";} ?>">
                                    <i style="font-size: 25px" class="header-icons fa fa-usd" aria-hidden="true" title="Financeiro"></i><br>
                                    <!--FINANCEIRO-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                    <div class="custom-drop">
                                        <div class="drop-content">
                                            <?php if($perm['perfilusuario_pedido'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>
                                                <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>"><p class="bb">Pedidos</p></a>
                                            <?php } ?>
                                            <?php if($perm['perfilusuario_pedido'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>
                                                <a href="<?php echo base_url('90617da22f81b0d789597a2d88d6cc9d') ?>"><p class="bb">Trocas</p></a>
                                            <?php } ?>
                                            <?php //if($perm['perfilusuario_devolucao'] == 1 || $super == 1) { ?>
                                                <!--<a href="<?php echo base_url('aec5e956c610cf9b6445c40befc0e850') ?>"><p class="bb">Devoluções</p></a>-->
                                            <?php //} ?>
                                            <?php if($perm['perfilusuario_relatorio'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>
                                                <a href="<?php echo base_url('e12424b582344b74d442de7107c91fd9') ?>"><p>Relatórios</p></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            
                            <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1){ ?>
                            <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                <p class="opt-menu <?php if($idpag == 6){echo "ativo-h";} ?>">
                                <i style="font-size: 25px" class="header-icons fa fa-cog" aria-hidden="true" title="Definições"></i><br>
                                <!--DEFINIÇÕES-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                <div class="custom-drop">
                                    <div class="drop-content">
                                        <?php if($perm['perfilusuario_ajuste'] == 1  || $super == 1){ ?>
                                            <a href="<?php echo base_url('8fb192af45f75504361d0011c1677415') ?>"><p class="bb">Ajustes</p></a>
                                        <?php } ?>
                                        <?php if($perm['perfilusuario_site'] == 1  || $super == 1){ ?>
                                            <a href="<?php echo base_url('af8889282b50f9030f8cc7a19b3f706d') ?>"><p>Site</p></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1 || $_SESSION['perfil'] == 10 || $_SESSION['perfil'] == 9){ ?>
                            <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                <p class="opt-menu <?php if($idpag == 8){echo "ativo-h";} ?>">
                                <i style="font-size: 25px" class="header-icons fa fa-shopping-bag" aria-hidden="true" title="Lojas"></i><br>
                                <!--LOJAS-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                <div class="custom-drop">
                                    <div class="drop-content">
                                        <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>
                                            <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>
                                                <a href="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>"><p class="bb">Fornecedores</p></a>
                                                <a href="<?php echo base_url('admin/adminfuncionarios/listaFuncionarios') ?>"><p class="bb">Funcionários</p></a>
                                                <a href="<?php echo base_url('admin/adminestoque/estoques') ?>"><p class="bb">Estoque</p></a>
                                            <?php } ?>
                                            <a href="<?php echo base_url('caixa/listaDevolucao') ?>"><p class="bb">Trocas</p></a>
                                        <?php } ?>
                                        <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>
                                            <a href="<?php echo base_url('pdv/indexMob') ?>"><p class="bb" style="text-align: center">PDV</p></a>
                                        <?php }else{ ?>
                                            <a onclick="abrirlista()"><p id="caixa-padding" class="bb">Caixa</p></a><!-- onmouseover="abrirlista()" onmouseleave="closelist()" -->
                                                <div id="caixalista" style="position: absolute; right: 100%; <?php if($_SESSION['perfil'] == 9){ echo "top: 0px;";}else{ echo "top: 100px;";}?>  width: 92%; display: none"><!--top: 166px;-->
                                                    <div class="drop-content">
                                                        <a href="<?php echo base_url('caixa') ?>"><p class="bb" style="text-align: center">Gestão caixa</p></a>
                                                        <a href="<?php echo base_url('pdv/indexMob') ?>"><p style="text-align: center">PDV</p></a>
                                                    </div>
                                                </div> 
                                        <?php } ?>
                                        <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1){ ?>
                                                <a href="<?php echo base_url('admin/adminlojas/verLoja') ?>"><p class="bb">Lojas</p></a>
                                        <?php } ?>
                                        <a href="<?php echo base_url('admin/relatoriosloja') ?>"><p>Relatórios</p></a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <div class="<?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $_SESSION['perfil'] == 9){ ?>col-xs-6<?php }else{ ?>col-xs-4<?php } ?> text-center div-drop">
                                <p class="opt-menu <?php if($idpag == 7){echo "ativo-h";} ?>">
                                <?php if($this->session->userdata('foto')) { ?>
                                    <img style="width: auto; height: 25px; border-radius: 50px;" class="header-icons rounded-circle" src="<?php echo base_url() . $this->session->userdata('foto') ?>"><br>
                                <?php } else { ?>
                                    <i style="font-size: 25px" class="header-icons fa fa-user-circle-o" aria-hidden="true" title="Dados"></i><br>
                                <?php } ?>
                                <!--DADOS-->&nbsp;&nbsp;<em style="margin-right: 8px;" class="fa fa-caret-down"></em></p>
                                <div class="custom-drop">
                                    <div class="drop-content">
                                        <a href="<?php echo base_url('1113c334193562fcb49c6557f14671f9') ?>"><p class="bb">PERFIL</p></a>
                                        <a href="<?php echo base_url('215521f1d88d23d4411a877b4d4a0d87') ?>"><p>SAIR</p></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row">-->
                <!--    <div class="col-md-5" style="margin-top: 5px">-->
                <!--            Gestão-->
                <!--    </div>-->
                <!--    <div class="col-md-7 text-right" style="margin: 23px 0">-->
                <!--        <div class="top-menu">-->
                            <!--<div class="row" id="opts">-->
                            <!--    <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
                            <!--        <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                            <!--            <ul class="navbar-nav mr-auto">-->
                            <!--              <li class="nav-item dropdown">-->
                            <!--                <button class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--                  <i class="fa fa-bars" aria-hidden="true"></i>-->
                            <!--                </button>-->
                            <!--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                            <!--                  <?php if($perm['perfilusuario_dashboard'] == 1 || $super == 1){ ?>-->
                            <!--        <a href="<?php echo base_url('106a6c241b8797f52e1e77317b96a201') ?>">Dashboard</a>-->
                            <!--    <?php } ?>-->
                                
                            <!--    <?php if($perm['perfilusuario_produto'] == 1 || $perm['perfilusuario_departamento'] == 1 || $super == 1){ ?>-->
                            <!--        <?php if($perm['perfilusuario_produto'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('391a027a8fef2eba4487a00156901156') ?>"><p class="bb">Produtos</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('48b6bbfcf12b55d9b0e4c2ded7384bff') ?>"><p class="bb">Departamentos</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('admin/admindepartamentos/subDepartamentos') ?>"><p class="bb">Sub Departamentos</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_promocao'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>"><p>Promoções</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_marca'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('edb728d5b2d758ff44b1b0e9f991ead9') ?>"><p>Marcas</p></a>-->
                            <!--        <?php } ?>-->
                                    <?php //if($perm['perfilusuario_opcao'] == 1 || $super == 1) { ?>
                            <!--            <a href="<?php echo base_url('admin/adminopcoes/opcoes') ?>"><p>Opções</p></a>-->
                                    <?php //} ?>
                            <!--    <?php } ?>-->
                                
                            <!--    <?php if($perm['perfilusuario_cliente'] == 1 || $perm['perfilusuario_usuario'] == 1 || $perm['perfilusuario_tipo'] == 1 || $super == 1){ ?>-->
                            <!--        <?php if($perm['perfilusuario_cliente'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>"><p class="bb">Clientes</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_usuario'] == 1 || $super == 1) { ?>-->
                            <!--            <a href="<?php echo base_url('0d658457c62859e2c93026f9f70ce219') ?>"><p class="bb">Usuários</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_tipo'] == 1 || $super == 1 || $_SESSION['perfil']) { ?>-->
                            <!--            <a href="<?php echo base_url('13858aeb4c9a5807927c7b952dace1fb') ?>"><p class="bb">Tipo Usuário</p></a>-->
                            <!--        <?php } ?>-->
                            <!--    <?php } ?>-->

                            <!--    <?php if($perm['perfilusuario_pedido'] == 1 || $perm['perfilusuario_solicitacao'] == 1 || $perm['perfilusuario_devolucao'] == 1 || $perm['perfilusuario_relatorio'] == 1 || $super == 1 || $_SESSION['perfil'] == 10){ ?>-->
                            <!--        <?php if($perm['perfilusuario_pedido'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>-->
                            <!--            <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>"><p class="bb">Pedidos</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_pedido'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>-->
                            <!--            <a href="<?php echo base_url('90617da22f81b0d789597a2d88d6cc9d') ?>"><p class="bb">Trocas</p></a>-->
                            <!--        <?php } ?>-->
                                    <?php //if($perm['perfilusuario_devolucao'] == 1 || $super == 1) { ?>
                            <!--            <a href="<?php echo base_url('aec5e956c610cf9b6445c40befc0e850') ?>"><p class="bb">Devoluções</p></a>-->
                                    <?php //} ?>
                            <!--        <?php if($perm['perfilusuario_relatorio'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>-->
                            <!--            <a href="<?php echo base_url('e12424b582344b74d442de7107c91fd9') ?>"><p>Relatórios</p></a>-->
                            <!--        <?php } ?>-->
                            <!--    <?php } ?>-->
                                
                                
                            <!--    <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1){ ?>-->
                            <!--        <?php if($perm['perfilusuario_ajuste'] == 1  || $super == 1){ ?>-->
                            <!--            <a href="<?php echo base_url('8fb192af45f75504361d0011c1677415') ?>"><p class="bb">Ajustes</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <?php if($perm['perfilusuario_site'] == 1  || $super == 1){ ?>-->
                            <!--            <a href="<?php echo base_url('af8889282b50f9030f8cc7a19b3f706d') ?>"><p>Site</p></a>-->
                            <!--        <?php } ?>-->
                            <!--    <?php } ?>-->
                                
                            <!--    <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1 || $_SESSION['perfil'] == 10 || $_SESSION['perfil'] == 9){ ?>-->
                            <!--        <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1 || $_SESSION['perfil'] == 10) { ?>-->
                            <!--            <a href="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>"><p class="bb">Fornecedores</p></a>-->
                            <!--            <a href="<?php echo base_url('admin/adminfuncionarios/listaFuncionarios') ?>"><p class="bb">Funcionários</p></a>-->
                            <!--            <?php if($perm['perfilusuario_departamento'] == 1 || $super == 1) { ?>-->
                            <!--                <a href="<?php echo base_url('admin/adminestoque/estoques') ?>"><p class="bb">Estoque</p></a>-->
                            <!--            <?php } ?>-->
                            <!--            <a href="<?php echo base_url('caixa/listaDevolucao') ?>"><p class="bb">Trocas</p></a>-->
                            <!--        <?php } ?>-->
                            <!--                        <a href="<?php echo base_url('caixa') ?>"><p class="bb" style="text-align: center">Gestão caixa</p></a>-->
                            <!--                        <a href="<?php echo base_url('pdv') ?>"><p style="text-align: center">PDV</p></a>-->
                            <!--        <?php if($perm['perfilusuario_ajuste'] == 1 || $perm['perfilusuario_site'] == 1 || $super == 1){ ?>-->
                            <!--                <a href="<?php echo base_url('admin/adminlojas/verLoja') ?>"><p class="bb">Lojas</p></a>-->
                            <!--        <?php } ?>-->
                            <!--        <a href="<?php echo base_url('admin/relatoriosloja') ?>"><p>Relatórios</p></a>-->
                            <!--    <?php } ?>-->
                            <!--        <?php if($this->session->userdata('foto')) { ?>-->
                            <!--            <img style="width: auto; height: 25px; border-radius: 50px;" class="rounded-circle" src="<?php echo base_url() . $this->session->userdata('foto') ?>"><br>-->
                            <!--        <?php } else { ?>-->
                            <!--            <i style="font-size: 25px" class="fa fa-user-circle-o" aria-hidden="true" title="Dados"></i><br>-->
                            <!--        <?php } ?>-->
                            <!--                <a href="<?php echo base_url('1113c334193562fcb49c6557f14671f9') ?>"><p class="bb">PERFIL</p></a>-->
                            <!--                <a href="<?php echo base_url('215521f1d88d23d4411a877b4d4a0d87') ?>"><p>SAIR</p></a>-->
                            <!--                </div>-->
                            <!--              </li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </nav>-->
                            <!--</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </header>
        </section>
            
            <script>
                function vermenu(){
                    if($('#hide_menu').css('right') == "-180px"){
                        $('#hide_menu').css({'right' : '0px'});
                        $('.show-menu').children().removeClass('fa-bars').addClass('fa-times');
                    }else{
                        $('#hide_menu').css({'right' : '-180px'});
                        $('.show-menu').children().removeClass('fa-times').addClass('fa-bars');
                        $('.hide-opt-menu').css('display', 'none');
                        $('.hide-opt').css('padding-bottom', '0px').find('p').css('color', 'white');
                    }
                }
                
                $('.div-drop').mouseenter(function(){
                    $(this).find('.opt-menu').css('color', '#1b9045!important');
                    $(this).find('.custom-drop').css({'display' : 'block', 'animation' : 'fade-in 1s'});
                });
                
                $('.div-drop').mouseleave(function(){
                    $(this).find('.opt-menu').css('color', 'white');
                    $(this).find('.custom-drop').css({'display' : 'none'});
                });
                
                
                $('.hide-opt').click(function(){
                    if($(this).parent().find('.hide-opt-menu').css('display') == 'none'){
                        $('.hide-opt-menu').css('display', 'none');
                        $('.hide-opt').css('padding-bottom', '8px').find('p').css('color', 'white');
                        
                        $(this).parent().find('.hide-opt-menu').css('display', 'block');
                        if($(this).find('p').hasClass('ativo-h')){
                            $(this).css('padding-bottom', '0px');
                        }else{
                            $(this).css('padding-bottom', '0px').find('p').css('color', 'grey');
                        }
                    }else{
                        $('.hide-opt-menu').css('display', 'none');
                        $('.hide-opt').css('padding-bottom', '8px').find('p').css('color', 'white');
                    }
                });
            </script>
            
            <script>
                function abrirlista(){
                    var div = document.getElementById("caixalista").classList.toggle("show");
                    
                }
            </script>
            <script>/*
                function closelist(){
                    var div = document.getElementById("caixalista");
                    div.style.display = "none";
                }*/
            </script>