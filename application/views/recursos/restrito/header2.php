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
                *:fullscreen, *:-webkit-full-screen, *:-moz-full-screen {
                    background-color: rgba(255,255,255,0)!important;
                    padding: 20px;
                }
                
                ::backdrop
                {
                    background-color: white;
                    
                }
            
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
                    position: absolute;
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
                    width: 130px;
                    background-color: transparent;
                    z-index: 9;
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
            </style>
            <script>
            
            var elem = document.getElementById("appin");
                
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