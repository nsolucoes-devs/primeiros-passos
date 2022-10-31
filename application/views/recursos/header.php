<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $mobile = 1;
    } else {
        $mobile = 0;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Primeiros Passos</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('imagens/favicon.png'); ?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('recursos/raquel/') ?>style.css">
    
    <link rel="stylesheet" href="<?php echo base_url('recursos/raquel/') ?>css/font-awesome.min.css">
    
    <script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
    
    <!-- slicknav & slick(carousel) -->
	<link media rel="stylesheet" href="<?php echo base_url('recursos/lib/'); ?>slick/slick.css">
	<link media rel="stylesheet" href="<?php echo base_url('recursos/lib/'); ?>slicknav/slicknav.css">
	<link media rel="stylesheet" href="<?php echo base_url('recursos/lib/'); ?>slick/slick/slick.css">
    <link media rel="stylesheet" href="<?php echo base_url('recursos/lib/'); ?>slick/slick/slick-theme.css">
    
    <!-- LINKS CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet">

    
    <?php if(isset($scrMP)){ echo $scrMP;} ?>
    
</head>

<body>
    <style>
        :root {
            --header-height: 4.5rem;
            /* colors */
            --hue: 180;
            --hue2: 335;
            /* HSL color mode */
            --base-color: hsl(var(--hue) 36% 57%);
            --base-color-second: hsl(var(--hue) 65% 88%);
            --base-color-alt: hsl(var(--hue2) 100% 80%);
            --title-color: hsl(var(--hue) 41% 10%);
            --text-color: hsl(0 0% 46%);
            --text-color-light: hsl(0 0% 98%);
            --body-color: hsl(0 0% 98%);
        }
        
        body {
            overflow-x: hidden;
            font: 400 1rem "DM Sans", sans-serif;
            color: var(--text-color);
            background: var(--body-color);
            -webkit-font-smoothing: antialiased;
        }
        
        h1 {
            font: 700 1.875rem "Poppins", sans-serif;
            color: var(--title-color);
            -webkit-font-smoothing: auto;
        }
        
        h2 {
            font: 700 1.875rem "Poppins", sans-serif;
            color: var(--title-color);
            -webkit-font-smoothing: auto;
        }
        
        .top-header-area {
            height: var(--header-height);
        }
    
        .classynav ul li .dropdown li a {
            border-bottom: none!important;
        }
        .header-area .credit-main-menu{
            background-color: var(--base-color);
        }
        .header-area .credit-main-menu::after {
            background: var(--base-color);
        }
        .header-area .credit-main-menu .classy-navbar .contact {
            padding-left: 0px!important;
            padding-right: 15px!important;
            
        }
        .header-area .credit-main-menu .classy-navbar .contact::before {
            background-color: var(--base-color);
            transform: rotate(24deg);
        }
        .header-area .credit-main-menu .classy-navbar .contact::after {
            background-color: var(--base-color);
        }
        .header-area .credit-main-menu .classy-navbar .classynav ul li ul li a{
            color: var(--base-color);    
        }
        
        .header-area .credit-main-menu .classy-navbar .classynav ul li ul li a:hover{
            color: #444!important;   
        }
        
        .header-area .credit-main-menu .classy-navbar .classynav ul li a {
            text-transform: none;    
        }
        
        .header-area .credit-main-menu .classy-navbar .classynav ul li a {
            display: grid;   
            font-size: 14px;
            font-weight: 700;
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        
        .header-area .top-header-area .top-contact-info a:first-child {
            margin-right: 40px;
        }
        
        .header-area .credit-main-menu .classy-navbar .classynav ul li.megamenu-item > a::after, .header-area .credit-main-menu .classy-navbar .classynav ul li.has-down > a::after {
            display: contents;
        }
        
        .classynav li a:hover {
            color: var(--base-color)!important;
        }
        
        #busca:focus{
            box-shadow: none;
            border: 0;
        }

        .tooltip-inner {
            background: var(--base-color);
        }
        
        li a:hover{
            color: #444!important;
        }      
        .breakpoint-on .classynav {
            text-align: left;
        }
        
        
        .botao-voltar{
            cursor: pointer;
            color: white;
            font-size: 13px;
            padding: 10px 15px;
            border-radius: 5px;
            background: var(--base-color);
        }
        
        #carrinho-qtd{
            position: absolute;
            top: 25px;
            right: 30px;
            background: #444;
            border-radius: 50px;
            color: white;
            padding: 2px 8px;
            font-size: 13px;
        }
        
        #busca-icone {
            color: var(--base-color);
            font-size: 27px;
            position: relative;
            left: 82%;
            bottom: 40px;
        }
        
        #busca-icone-topo {
            color: var(--base-color);
            font-size: 27px;
            position: relative;
            left: 93%;
            bottom: 34px;
        }

        .classy-navbar-toggler .navbarToggler span {
            background-color: #ffffff;
            z-index: 100;
        }
        
        .breakpoint-on .classynav > ul > li > a{
            background-color: #ffffff;
        }
        
        .classynav ul li.megamenu-item > a:after, .classynav ul li.has-down > a:after{
            padding-right: 20%;
        }
        
        .header-area .credit-main-menu .classy-navbar .classynav ul li a:hover, .header-area .credit-main-menu .classy-navbar .classynav ul li a:focus{
            color: #444!important;
        }
        
        .a-sub {
            color: black!important;
        }
        .header-area .credit-main-menu .classy-nav-container {
            background-color: var(--base-color)!important;
        }
        
        .icones-header:hover i, .icones-header:hover, .icones-header:hover span{
            color: var(--base-color-alt)!important;
        }
        
        #icone-carrinho{
            margin-top: 20%!important;
            border: 1px solid white!important;
            padding: 10px!important;
            border-radius: 5px!important;
        }
        
        #icone-conta{
             border: 1px solid white;
             padding: 10px;
             border-radius: 5px;
        }
        
        #busca-baixo{
            width: 100px;
            margin: 0 50px;
            display: none;
        }
        #busca-topo{
            display: block;
        }
        
        @media only screen and (max-width: 1200px) {
            #busca-baixo{
                display: none!important;
            }
            #busca-topo{
                display: block!important;
            }
            .classy-navbar{
               padding-left: 1%!important;
           }
        }
        
        @media only screen and (max-width: 1050px) {
            #busca-baixo{
                display: none!important;
            }
            #busca-topo{
                display: block!important;
            }
            #icone-carrinho{
                position: absolute;
                left: -87px;
                top: 3px;
            }
            #icone-conta{
                position: relative;
                top: 1px;
                left: -40px;
            }
        }
        
        @media only screen and (max-width: 769px){
            #busca-baixo{
                display: block!important;
            }
            #busca-topo{
                display: none!important;
            }
            #carrinho-qtd{
                top: 49px;
                padding: 0 8px!important;
            }
            .header-area .credit-main-menu .classy-navbar .classynav ul li a {
                color: var(--base-color);
            }
            #icone-carrinho{
                position: unset;
                margin-top: 15%!important;
            }
            #icone-conta{
                position: unset;
                margin-top: 15%!important;
            }
        }
        
        @media only screen and (max-width: 600px) {
            #busca-baixo{
                display: block!important;
            }
            #busca-topo{
                display: none!important;
            }
            #carrinho-qtd{
                top: 52px;
                right: calc(100% - 20px);
                padding: 0 8px!important;
                font-size: 11px!important;
            }
            #busca {
                background: white!important;
                height: 40px!important;
                margin-right: 0!important;
                margin-top: -13px!important;
            }
            #busca-icone {
                left: 72px;
            }
            .classynav ul li {
                margin-left: 0!important;
            }
            .header-area .credit-main-menu .classy-navbar .classynav ul li a {
                margin-right: 0!important;
            }
            .header-area .top-header-area .top-contact-info a:first-child {
                margin-right: 30px;
                margin-left: 0px;
            }
            #icone-conta{
                position: unset;
                margin-top: 14%!important;
            }
            
            .preloader .lds-ellipsis div {
                background: var(--base-color);
            }
        }
        #ul-departamentos > ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* display: grid; */
            /* grid-template-columns: repeat(7,minmax(0,1fr)); */
        }

        .nav-item:hover ~ .nav-item {
            pointer-events: none;
        }


        #departamentos-mobile > .nav-item {
            font-size: 74px !important;
        }
    </style>
    
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area" style="background: var(--base-color);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo" style="height: var(--header-height);">
                            <a href="<?php echo base_url() ?>">
                                <img style="height: var(--header-height); width: auto;margin-top: 2px;" src="<?php echo base_url('imagens/site/logo.png') ?>" alt="">
                            </a>
                        </div>
                        
                        <?php if($mobile == 0){  ?>
                            <div id="busca-topo" class="contact search-div" style="width: 450px">
                                <label>&nbsp;</label>
                                <form id="buscador" action="<?php echo base_url('produto/buscaProdutos');?>" method="post">
                                    <input autocomplete="off" id="busca" name="busca" type="text" placeholder="Busque seu produto" class="form-control">
                                    <i onclick="Submit()" id="busca-icone-topo" class="fa fa-search" aria-hidden="true"></i>
                                    <div class="box-search" style="display: block; background: white;position: fixed;width: 250px;">
                                </form>
                                </div>
                            </div>
                        <?php } else { ?>

                        <!-- Contact -->
                        <div id="busca-baixo" class="contact search-div">
                            <label>&nbsp;</label>
                            <form id="buscador" action="<?php echo base_url('produto/buscaProdutos');?>" method="post">
                                <input autocomplete="off" id="busca" name="busca" type="text" placeholder="Busca" class="form-control">                                
                                <a type="submit" id="busca-icone">
                                    <i onclick="Submit()" class="fa fa-search" aria-hidden="true"></i>
                                </a>
                                <div class="box-search" style="display: block; background: white;position: fixed;width: 250px;">
                            </form>
                            </div>
                        </div>

                        
                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <?php } ?>


                        <!-- Top Contact Info -->
                        <div class="top-contact-info d-flex align-items-center" style="<?php if($mobile == 0){ echo 'margin-top:  -5px;'; } ?>">
                            <?php if($mobile == 0){ ?>
                                <a href="<?php echo base_url('inicio/contato') ?>" class="icones-header"><i style="color: white; font-size: 35px;" class="fa fa-whatsapp" aria-hidden="true"></i> <span style="color: white"></span></a>
                                <!-- <div class="position-relative" style="margin-right: 40px;">
                                    <a class="icones-header" href="<?php echo base_url('b920e92e9e4616300f9b7e6f3fd78635') ?>">
                                        <i style="font-size: 35px; color: white" class="fa fa-shopping-basket" aria-hidden="true"></i> 
                                        <span style="color: white"> 
                                            <?php if($this->session->userdata('quantidade_carrinho')) {?>
                                                <span id="carrinho-qtd"><?php echo $this->session->userdata('quantidade_carrinho') ?></span>
                                            <?php } ?>
                                        </span>
                                    </a>
                                </div> -->
                            <?php } else { ?>
                                <!-- <a id="icone-carrinho" href="<?php echo base_url('b920e92e9e4616300f9b7e6f3fd78635') ?>" class="icones-header">
                                    <i style="color: white; font-size: 25px;" class="fa fa-shopping-basket" aria-hidden="true">
                                        <p id="carrinho-qtd"><?php echo $this->session->userdata('quantidade_carrinho') ?></p>
                                    </i>
                                </a> -->
                            <?php } ?>
                            
                            
                            <!-- <?php if($this->session->userdata('cliente_logado')){ ?>
                                <?php if($this->session->userdata('cliente_logado') == 1){ ?>
                                    <?php
                                        $cliente_nome = $this->session->userdata('cliente_nome');
                                        $aux_nome = explode(' ', $cliente_nome);
                                        if(count($aux_nome) > 1){
                                            $cliente_nome = ucfirst(strtolower($aux_nome[0])) . ' ' . substr($aux_nome[1], 0, 1) . '.';
                                        } else {
                                            $cliente_nome = ucfirst(strtolower($aux_nome[0]));
                                        }
                                    ?>
                                    <a id="icone-conta" class="icones-header" href="<?php echo base_url('2b1e190210df261675c4b801bc6e8989') ?>"><i style="color: white; font-size: 25px;" class="fa fa-user-circle" aria-hidden="true"></i> <span style="color: white"> &nbsp;<?php echo $cliente_nome ?></span></a>
                                <?php } ?>
                            <?php } else { ?>
                                <a id="icone-conta" class="icones-header" href="<?php echo base_url('2b1e190210df261675c4b801bc6e8989') ?>"><i style="color: white; font-size: 25px;" class="fa fa-user-circle" aria-hidden="true"></i> <span style="color: white"> &nbsp;Minha Conta</span></a>
                            <?php } ?> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off" style="width: 100%!important;">
                <div class="text-center">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="creditNav" <?php if($mobile == 1){ echo 'style="height: 0px !important;"';} ?>>


                        <!-- Menu Desktop -->
                            <?php if($mobile == 0){ ?>
                                <div class="classy-menu-desktop mx-auto">

                                    <?php if($mobile == 0){ ?>
                                        <a id="logo2" href="<?php echo base_url() ?>" style="height: 80%; position: absolute;left: 22px;top: 5px;display: none;">
                                            <img style="animation: fadeIn 1.4s; height: 100%; width: auto;" src="<?php echo base_url('imagens/site/logo.png') ?>">
                                        </a>
                                    <?php } ?>

                                    <!-- Nav Start -->

                                        <div id="ul-departamentos" class="classynav container">
                                            <ul>
                                                <?php foreach($departamentos as $dep){?>
                                                <li class="nav-item"><a onclick="Submit2('<?php echo $dep['departamento_id'];?>')" href="#"><?php echo $dep['departamento'];?><?php if(array_key_exists('subs', $dep)){?>&nbsp;<?php } ?></a>
                                                    <?php if(array_key_exists('subs', $dep)){?>
                                                        <ul class="dropdown">
                                                            <?php foreach($dep['subs'] as $sub){?>
                                                                <li><a style="margin-left: -8px;" onclick="Submit2('<?php echo $sub['id'];?>')" href="#"><?php echo $sub['nome'];?></a></li>
                                                            <?php }?>
                                                        </ul>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </div>

                                    <!-- Nav End -->
                                    </div>

                        <!-- /Menu Desktop -->
                            <?php } else { ?>
                        <!-- Menu Mobile -->
                        <div class="classy-menu mx-auto">
                            
        
                            <!-- Nav Start -->
                            
                                <div id="departamentos-mobile" class="container">
                                    <ul class="p-2">
                                        <?php foreach($departamentos as $key => $dep){?>
                                        <li class="text-left mb-2">
                                            <strong><a style="font-size: 18px; font-weight:700" onclick="Submit2('<?php echo $dep['departamento_id'];?>')" href="#"><?php echo $dep['departamento'];?></a></strong>
                                            <?php if(array_key_exists('subs', $dep)): ?>
                                            <i class="fa fa-angle-down fa-2x mt-2" style="color: var(--base-color);" id="trigger_<?= $key ?>" aria-hidden="true"></i>
                                            <?php endif ?>
                                            <?php if(array_key_exists('subs', $dep)){?>
                                                <ul class="d-none pt-2" id="triggered_<?= $key ?>">
                                                    <?php foreach($dep['subs'] as $sub){?>
                                                        <li><a style="margin-left: 8px;" onclick="Submit2('<?php echo $sub['id'];?>')" href="#"><?php echo $sub['nome'];?></a></li>
                                                    <?php }?>
                                                </ul>
                                            <?php }?>
                                        </li>
                                        <script>
                                            $("#trigger_<?= $key ?>").click(function() {
                                                $("#triggered_<?= $key ?>").toggleClass("d-none");
                                            });
                                        </script>
                                        <?php }?>
                                    </ul>
                                </div>

                                <div class="d-flex" style="background-color: var(--base-color);">
                                    <a href="<?php echo base_url() ?>">
                                        <img style="animation: fadeIn 1.4s; height: 100%; width: auto;" src="<?php echo base_url('imagens/site/logo.png') ?>">
                                    </a>
                                    <p class="text-center"><i style="font-size: 18px" class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; +55 <span class="telefone"><?php echo $telefone ?></span></span></p>
                                    <a href="<?php echo base_url('inicio/contato') ?>" class="icones-header"><i style="color: white; font-size: 35px;" class="fa fa-whatsapp" aria-hidden="true"></i> <span style="color: white"></span></a>
                                </div>
                            
                            <!-- Nav End -->
                        </div>
                        <!-- /Menu Mobile -->

                        <?php } ?>


                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
    
    <script>
        function Submit(){
            document.getElementById("buscador").submit();
        }
        function Submit2(departamento){
            var form = document.createElement("form");
            form.method = "GET";
            form.action = "<?php echo base_url('produto/buscaDepartamentos');?>";   
            
            var element1 = document.createElement("input"); 
            element1.value=departamento;
            element1.name="busca";
            form.appendChild(element1);  
        
            document.body.appendChild(form);
        
            form.submit();
        }
    </script>