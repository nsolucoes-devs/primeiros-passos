
<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $mobile_view = 1;
    } else {
        $mobile_view = 0;
    }
?>
<style>
    html { scroll-behavior: smooth }
    body { padding-right: 0!important }
    .custom-indicator { right: 0; left: unset; top: 50%; text-align: center; margin: 0; width: 20px; display: block; }
    .custom-indicator li { display: block; width: 10px; height: 10px; margin-bottom: 10px; margin-right: 10px; }
    .content-title { font-size: 40px; padding-bottom: 40px; }
    .section-content { padding: 40px 40px 0 40px; }
    .section-separator { padding-left: 0!important; padding-right: 0!important; }
    .separator-img { width: 100%; }
    .front-banner { z-index: 2; position: absolute; transition: all .1s; transform: scale(4); }
    .active img.front-banner { transition: all .8s; transform: scale(1); }
    .back-banner { z-index: 1; position: relative; }
    .back-sorteio { width: 100%; }
    .btn::before { background: transparent!important; }
    .btn-comprar { width: 70%; font-size: 25px; color: white!important; background-color: #7800a7; border-color: #7800a7; border-radius: 15px; margin-top: 20px; margin-bottom: 30px; box-shadow: 0 0 0 0 rgba(120, 0, 167, 1); transform: scale(1); animation: pulse 2s infinite; }
    .btn-comprar-DISABLED { width: 70%; font-size: 25px; color: white!important; background-color: #7800a7; border-color: #7800a7; border-radius: 15px; margin-top: 20px; margin-bottom: 30px; }
    @keyframes pulse {
    	0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(120, 0, 167, 1); }
    	70% { transform: scale(1); box-shadow: 0 0 0 20px rgba(120, 0, 167, 0.1); }
    	100% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(120, 0, 167, 0); }
    }
    .ganhadores-div { padding-top: 50px; padding-bottom: 50px; }
    .ganhadores-div2 { padding-top: 50px; padding-bottom: 50px; }
    .ganhadores-img, .ganhadores-img2 { width: 80%!important; margin-left: 10%; transition: all .2s; transform: scale(1); }
    .ganhadores-img:hover, .ganhadores-img2:hover { transform: scale(1.25); transition: all .2s; cursor: pointer; }
    .slick-prev, .slick-next { width: 35px; }
    .slick-prev:before, .slick-next:before { color: #7800a7; opacity: 1; font-size: 29px; }
    .carousel-item { transition: all .5s; }
    .cookie-pc { width: 100%; display: block; padding: 10px 20px; }
    .cookie-mob { width: 100%; display: none; }
    #div_cookies { z-index: 1000; position: fixed; bottom: 10px; width: 80%; margin-left: 10%; margin-right: 10%; background-color: white; -webkit-box-shadow: 0 0 10px grey; box-shadow: 0 0 10px grey; }
    .cookie-10 { flex: 0 0 83.33%; max-width: 83.33%; width: 83.33%; float: left; padding: 10px 20px; }
    .cookie-2 { flex: 0 0 16.66%; max-width: 16.66%; width: 16.66%; height: 100%; float: left; position: relative; }
    .frase { font-size: 12px; color: black; font-weight: bold; margin-bottom: 10px; text-align: justify; line-height: 20px; margin-bottom: 0; }
    #acc_cookies, #acc_cookies2 { color: white; border-radius: 0; padding: 15px 20px 15px 20px; font-size: 14px; width: 100%; height: 100%; background-color: #7800a7; border-color: #7800a7; }
    #acc_cookies2 { display: none; }
    .img-exp { width: 45%; max-width: 45%; }
    .resultados-dialog { max-width: 30%; width: 30%; }
    /* XX-Small devices (300px and up) */
    @media ( min-width: 299px ) and ( max-width: 398px ) {
        /*.banner_top { height: 185px; }*/
        .custom-indicator { right: 0; left: unset; top: unset; bottom: 0; text-align: center; margin: 0; width: auto; display: flex; z-index: 4; }
        .custom-indicator li { display: block; width: 7px; height: 7px; margin-bottom: 10px; margin-right: 5px; z-index: 4; }
        .content-title { font-size: 31px; padding-bottom: 15px; }
        .section-content { padding: 20px 20px 0 20px; }
        .section-separator { padding-top: 0; }
        .separator-mobile { overflow: hidden; }
        .separator-img { width: 200%; margin-left: -50%; }
        .ganTam { z-index: 1; }
        .ganTam2 { z-index: 1; }
        .cookie-pc { display: none; }
        .cookie-mob { display: block; padding: 10px 20px; }
        .cookie-12 { flex: 0 0 100%; max-width: 100%; float: left; position: relative; }
        .frase { line-height: 13px; }
        .cookie-10 { flex: 0 0 70%; max-width: 70%; float: left; padding: 10px 20px; }
        .cookie-2 { flex: 0 0 30%; max-width: 30%; float: left; position: relative; }
        #acc_cookies { display: none; }
        #acc_cookies2 { display: block; text-align: center; margin-top: 10px; font-size: 12px; line-height: 0px; }
        .img-exp { width: 70%; max-width: 70%; }
        .resultados-dialog { margin-left: 10%; max-width: 80%; width: 80%; }
    }
    /* X-Small devices (iPhone and others mobiles, 400px and up) */
    @media ( min-width: 399px ) and ( max-width: 574px ) {
        /*.banner_top { height: 200px; }*/
        .custom-indicator { right: 0; left: unset; top: unset; bottom: 0; text-align: center; margin: 0; width: auto; display: flex; z-index: 4; }
        .custom-indicator li { display: block; width: 7px; height: 7px; margin-bottom: 10px; margin-right: 5px; z-index: 4; }
        .content-title { font-size: 31px; padding-bottom: 25px; }
        .section-content { padding: 20px 20px 0 20px; }
        .section-separator { padding-top: 10px; }
        .separator-mobile { overflow: hidden; }
        .separator-img { width: 200%; margin-left: -50%; }
        .ganTam { z-index: 1; }
        .ganTam2 { z-index: 1; }
        .cookie-pc { display: none; }
        .cookie-mob { display: block; padding: 10px 20px; }
        .cookie-12 { flex: 0 0 100%; max-width: 100%; float: left; position: relative; }
        .frase { line-height: 13px; }
        .cookie-10 { flex: 0 0 70%; max-width: 70%; float: left; padding: 10px 20px; }
        .cookie-2 { flex: 0 0 30%; max-width: 30%; float: left; position: relative; }
        #acc_cookies { display: none; }
        #acc_cookies2 { display: block; text-align: center; margin-top: 10px; font-size: 12px; line-height: 0px; }
        .img-exp { width: 70%; max-width: 70%; }
        .resultados-dialog { margin-left: 10%; max-width: 80%; width: 80%; }
    }
    /* Small devices (landscape phones, 576px and up) */
    @media ( min-width: 575px ) and ( max-width: 766px ) {
        /*.banner_top { height: 270px; }*/
        .custom-indicator { right: 0; left: unset; top: unset; bottom: 0; text-align: center; margin: 0; width: auto; display: flex; z-index: 4; }
        .custom-indicator li { display: block; width: 7px; height: 7px; margin-bottom: 10px; margin-right: 5px; z-index: 4; }
        .content-title { font-size: 32px; padding-bottom: 30px; }
        .ganTam { z-index: 1; }
        .ganTam2 { z-index: 1; }
        .cookie-pc { display: none; }
        .cookie-mob { display: block; }
        .cookie-12 { flex: 0 0 100%; max-width: 100%; float: left; position: relative; }
        .frase { line-height: 13px; }
        .cookie-10 { flex: 0 0 70%; max-width: 70%; float: left; padding: 10px 20px; }
        .cookie-2 { flex: 0 0 30%; max-width: 30%; float: left; position: relative; }
        #acc_cookies { display: none; }
        #acc_cookies2 { display: block; text-align: center; margin-top: 10px; font-size: 12px; line-height: 0px; }
        .img-exp { width: 70%; max-width: 70%; }
        .resultados-dialog { margin-left: 10%; max-width: 80%; width: 80%; }
    }
    /* Medium devices (tablets, 768px and up) */
    @media ( min-width: 767px ) and ( max-width: 990px ) {
        /*.banner_top { height: 350px; }*/
        .ganTam { z-index: 2; }
        .ganTam2 { z-index: 2; }
        .btn-comprar { width: 90%; }
        .img-exp { width: 50%; max-width: 50%; }
        .resultados-dialog { margin-left: 25%; max-width: 50%; width: 50%; }
    }
    /* Large devices (desktops, 992px and up) */
    @media ( min-width: 991px ) and ( max-width: 1198px ) {
        /*.banner_top { height: 470px; }*/
        .ganTam { z-index: 2; }
        .ganTam2 { z-index: 2; }
    }
    /* X-Large devices (large desktops, 1200px and up) */
    @media ( min-width: 1199px ) and ( max-width: 1398px ) {
        /*.banner_top { height: 500px; }*/
        .ganTam { z-index: 4; }
        .ganTam2 { z-index: 3; }
    }
    /* XX-Large devices (larger desktops, 1400px and up) */
    @media ( min-width: 1399px ) {
        /*.banner_top { height: 550px; }*/
        .ganTam { z-index: 4; }
        .ganTam2 { z-index: 3; }
    }
    @media (max-width: 575px){
        #btn-zap { left: 16px; right: unset;}
    }
    #btn-zap { background: #34af23; opacity: 0.8; height: 50px; width: 50px; left: 15px; right: unset; bottom: 52px; position: fixed; color: #fff; font-size: 20px; text-align: center; border-radius: 50%; line-height: 48px; border: 2px solid transparent; box-shadow: 0 0 10px 3px rgba(108,98,98,0.2); }
    .close-cookies { background-color: white; border: 0; width: 30px; height: 30px; border-radius: 50%; position: absolute; top: -15px; right: -15px; z-index: 1001; -webkit-box-shadow: 0 0 5px black; box-shadow: 0 0 5px black; }
    .close-cookies em { font-size: 18px; color: red; }
    .select2-1 { width: 100%; }
    #resultado { display: none; height: 0px; padding-top: 0px; }
    #resultado-carousel .carousel-indicators li { width: 5px; height: 5px; }
    #resultado-carousel .carousel-control-next, #resultado-carousel .carousel-control-prev { top: 40%; width: 30px; height: 30px; border-radius: 50%; background: #7800a7; opacity: 1; }
    
    .card-relacionados{
        cursor: pointer;
        border-radius: 10px;
        border: 0;
        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    }
    
    <?php if($mobile_view == 0){ ?>
        .zoom:hover {
            transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    <?php }else{ ?>
        #btn-zap { left: 5px; }
    <?php } ?>
    
    .new-cookie{
        visibility: hidden;
    }
    #new-cookie{
        z-index: 1000;
        position: fixed;
        width: 100%;
        margin-left: 0;
        margin-right: 0;
        background-color: white;
        bottom: 0;
        visibility: visible;
        box-shadow: 0px 0 10px rgba(0, 0, 0, 0.8);
    }
    .new-cookie-btn{
        font-size: 11px;
        margin-top: -4px;
        color: white;
        border: 2px solid #3a0b0c;
        background-color: #3a0b0c;
    }
    .pd0{
        padding-left: 0!important;
        padding-right: 0!important;
    }
    .prod-departamento{
        font-size: 15px;
        color: grey;
        margin-bottom: 3px;
        margin-top: 10px;
        line-height: 0px;
        text-align: center;
    }
    .prod-nome{
        font-size: 15px;
        margin-bottom: 0px;
        color: black;
        font-weight: bold;
    }
    .prod-preco{
        margin-bottom: 10px;
        font-size: 25px;
        color: black;
        text-align: center;
    }
    .stars{
        margin-top: 15px;
        margin-bottom: 0px;
        line-height: 0px;
    }
</style>
    
<?php if($mobile_view == 1){ ?>
<style>
    .prod-departamento{
        margin-bottom: 10px;
    }
    .prod-nome{
        margin-bottom: 5px;
        line-height: 16px;
    }
    .prod-preco{
        margin-bottom: 12px;
        font-size: 20px;
    }
    .card-body{
        padding: 10px;
    }
    .stars{
        font-size: 11px;
        margin-bottom: 10px;
    }
    .box-search{
        position: absolute;
        z-index: 100;
        left: 4%;
        right: 6%;
        width: 90%;
        margin: 0;
        background-color: white;
        box-shadow: 0px 0px 4px 0px #000000;
        padding: 5px 10px;
        display: none;
    }
</style>
<?php } ?>

<!-- Cookies -->
<div class="row" id="div_cookies" style="display: none">
    <div class="cookie-pc">
        <div class="cookie-10">
            <p class="frase">Usamos cookies para melhorar a sua experiência em nossa plataforma. Ao continuar navegando, você concorda com a nossa <a style="color: red; cursor: pointer" onclick="showPrivacidade()">Política de Privacidade</a>.</p>
        </div>
        <div class="cookie-2">
            <button type="button" id="acc_cookies" class="btn header-btn">Continuar e Fechar</button>
            <!--<button class="close-cookies"><em class="fa fa-times"></em></button>-->
        </div>
    </div>
    <div class="cookie-mob">
        <div class="cookie-12">
            <p class="frase">Usamos cookies para melhorar a sua experiência em nossa plataforma. Ao continuar navegando, você concorda com a nossa <a style="color: red; cursor: pointer" onclick="showPrivacidade()">Política de Privacidade</a>.</p>
            <button type="button" id="acc_cookies2" class="btn header-btn">Continuar</button>
        </div>
    </div>
</div>
<div class="row new-cookie" id="new-cookie">
    <div class="cookie-pc col-md-12">
        <div class="row">
            <div class="col-md-10">
                <p class="frase" style="margin-top: 5px;">Ao clicar em "Aceitar e Fechar", você concorda com o armazenamento de cookies em seu dispositivo. Para mais detalhes, leia nossa <span data-toggle="modal" data-target="#privacidade" style="color: red; cursor: pointer">Política de Privacidade</span>.</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn-main" onclick="close_cookie()" style="height: auto; padding: 4px;">Aceitar e Fechar</button>
            </div>
        </div>
    </div>
    
    <div class="cookie-mob col-md-12">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px">
                <p class="frase text-center" style="margin-top: 5px;">Nós usamos cookies para aprimorar seu acesso.<br> Ver <span style="color: red">Política de Privacidade</span>.</p>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px">
                <button type="button" class="btn-main" onclick="close_cookie()" style="height: auto; padding: 4px;">Aceitar e Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Cookies -->

<main style="position: relative; padding-top: 55px; background: #fbf7ef;">
    <div id="main_banner" class="carousel slide banner_top" data-ride="carousel">
        <?php if($mobile_view == 0){ ?>
        <ol class="carousel-indicators custom-indicator">
            <li data-target="#main_banner" data-slide-to="0" id="li_1" class="active"></li>
            <li data-target="#main_banner" data-slide-to="1" id="li_2"></li>
            <li data-target="#main_banner" data-slide-to="2" id="li_3"></li>
        </ol>
        <?php } ?>
        
        <div class="carousel-inner banner_top">
            <div class="carousel-item active first" id="front_1">
                <picture class="d-block w-100 banner_top back-banner">
                    <source media="(min-width:1263px)" srcset="<?php echo base_url('imagens/site/banner_principal1.png') ?>">
                    <source media="(min-width:650px)" srcset="<?php echo base_url('imagens/site/banner_principal1.png') ?>">
                    <source media="(min-width:465px)" srcset="<?php echo base_url('imagens/site/banner_principal1.png') ?>">
                    <img src="<?php echo base_url('imagens/site/banner_principal1.png') ?>" alt="Back Image" style="width:100%; height: auto;">
                </picture>
            </div>
            <div class="carousel-item second" id="front_2">
                <picture class="d-block w-100 banner_top back-banner">
                    <source media="(min-width:1263px)" srcset="<?php echo base_url('imagens/site/banner_principal2.png') ?>">
                    <source media="(min-width:650px)" srcset="<?php echo base_url('imagens/site/banner_principal2.png') ?>">
                    <source media="(min-width:465px)" srcset="<?php echo base_url('imagens/site/banner_principal2.png') ?>">
                    <img src="<?php echo base_url('imagens/site/banner_principal2.png') ?>" alt="Back Image" style="width:100%; height: auto;">
                </picture>
            </div>
            <div class="carousel-item third" id="front_3">
                <picture class="d-block w-100 banner_top back-banner">
                    <source media="(min-width:1263px)" srcset="<?php echo base_url('imagens/site/banner_principal3.png') ?>">
                    <source media="(min-width:650px)" srcset="<?php echo base_url('imagens/site/banner_principal3.png') ?>">
                    <source media="(min-width:465px)" srcset="<?php echo base_url('imagens/site/banner_principal3.png') ?>">
                    <img src="<?php echo base_url('imagens/site/banner_principal3.png') ?>" alt="Back Image" style="width:100%; height: auto;">
                </picture>
            </div>
        </div>
    </div>
    
    <div class="section-content" style="margin-top: -7%; margin-bottom: 0px; background: #fbf7ef;">
        <div class="row">
            <div class="col-md-3 <?php if($mobile_view == 1){echo "col-4 pd0";}else{echo "form-group";} ?>">
                <div class="card" style="padding: 0 15px 0 15px; background-color: transparent; border: 0">
                    <div class="card-body" style="padding: 0">
                        <img src="<?php echo base_url('imagens/1.png') ?>" style="width: 100%; height: auto">
                    </div>
                </div>
            </div>
            <div class="col-md-3 <?php if($mobile_view == 1){echo "col-4 pd0";}else{echo "form-group";} ?>">
                <div class="card" style="padding: 0 15px 0 15px; background-color: transparent; border: 0">
                    <div class="card-body" style="padding: 0">
                        <img src="<?php echo base_url('imagens/2.png') ?>" style="width: 100%; height: auto">
                    </div>
                </div>
            </div>
            <?php if($mobile_view == 0){ ?>
            <div class="col-md-3 form-group">
                <div class="card" style="padding: 0 15px 0 15px; background-color: transparent; border: 0">
                    <div class="card-body" style="padding: 0">
                        <img src="<?php echo base_url('imagens/3.png') ?>" style="width: 100%; height: auto">
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-3 <?php if($mobile_view == 1){echo "col-4 pd0";}else{echo "form-group";} ?>">
                <div class="card" style="padding: 0 15px 0 15px; background-color: transparent; border: 0">
                    <div class="card-body" style="padding: 0">
                        <img src="<?php echo base_url('imagens/4.png') ?>" style="width: 100%; height: auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section-content" style="<?php if($mobile_view == 0){echo "margin-bottom: 20px;";} ?> padding-top: 10px; background: #fbf7ef;">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo base_url('imagens/frete.png') ?>" style="width: 100%; height: auto">
            </div>
        </div>
    </div>

    <?php if($mobile_view == 1){ ?>
    <div class="section-content" style="padding-top: 10px; background: #fbf7ef;">
        <div class="row">
            <div class="col-md-12 search-div">
                <div class="text-left input-group">
                    <input style="border: 0; height: 55px!important;font-size: 17px;" id="search_produto" type="text" class="pesquisa input-lg form-control search-input" onkeydown="searchTrigger2($(this).val())" onclick="searchTrigger2($(this).val())" placeholder="Busque seu Produto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append search-icon-div">
                        <span class="border: 0!important; input-group-text search-icon-i">
                            <i style="color: brown; font-size: 30px;" class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div class="box-search">
                    
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="section-content" style="<?php if($mobile_view == 0){echo "margin-bottom: 20px;";} ?> background: #fbf7ef;">
        <div class="row">
            <?php foreach($produtos as $p){ ?>
            <?php $aux_nome = explode(' ',$p['produto_nome'], 2) ?>
            
            <div class="col-md-3 form-group" <?php if($mobile_view == 1){echo "style='width: 50%'";} ?>>
                <div class="card zoom card-relacionados">
                    <div class="card-body">
                        <div class="row">
                            <a href="<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/'). $p['produto_id'] ?>">
                                <div class="col-md-12">
                                    <?php if($p['produto_porcentagem']){ ?>
                                        <span style="right: 10px; position: absolute; background-color: #28d028; padding: 5px; border-radius: 5px; font-size: 11px; color: white"><i class="fa fa-arrow-down" aria-hidden="true"></i> <b style="color: white;"><?php echo round($p['produto_porcentagem']) ?>%</b></span>
                                    <?php } ?>
                                    <img class="d-block w-100" src="<?php echo base_url('imagens/produtos/').$p['produto_id'].'.jpg'?>">
                                </div>
                                    
                                <div class="col-md-12">
                                    <p class="text-center stars">
                                        <i style="color: gold" class="fa fa-star" aria-hidden="true"></i>
                                        <i style="color: gold" class="fa fa-star" aria-hidden="true"></i>
                                        <i style="color: gold" class="fa fa-star" aria-hidden="true"></i>
                                        <i style="color: gold" class="fa fa-star" aria-hidden="true"></i>
                                        <i style="color: gold" class="fa fa-star" aria-hidden="true"></i>
                                    </p>
                                    <p class="prod-departamento"><span style="font-size: 13px;"><b style="color: grey"><?php echo ucfirst(mb_strtolower($aux_nome[0])) ?></b></span></p>
                                    <p class="text-center prod-nome" style="margin-bottom: 5%;"><?php echo ucfirst(mb_strtolower($aux_nome[1])) ?></p>
                                    <?php if($p['produto_promocao']){ ?>
                                        <div id="testegui1" style="padding-bottom: 2px;margin-top: -5%;margin-bottom: 7px;">
                                            <p class="prod-preco" style="line-height: 15px; margin: 0!important; padding: 0!important;font-size: 12px; text-decoration: line-through;">R$ <?php echo number_format($p['produto_valor'],2,',','.') ?></p>
                                            <p class="prod-preco" style="line-height: 19px;"><b style="color: black">R$ <?php echo number_format($p['produto_promocao'], 2,',','.') ?></b></p>
                                        </div>
                                    <?php } else { ?>
                                        <p class="prod-preco"><b style="color: black">R$ <?php echo number_format($p['produto_valor'], 2,',','.') ?></b></p>
                                    <?php } ?>
                                    <button type="button" class="btn-main"><i style="font-size: 16px" class="fa fa-cart-plus" aria-hidden="true"></i> COMPRAR</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="section-content" style="<?php if($mobile_view == 0){echo "margin-bottom: 40px;";} ?> background: #fbf7ef;">
        <div class="row">
            <div class="col-md-6 form-group" data-toggle="modal" data-target="#exampleModalCenter" onclick="solicitar(1)" style="cursor: pointer">
                <div class="row">
                    <div class="col-md-12">
                        <img style="<?php if($mobile_view == 0){echo "height: 250px";}else{echo "width: 100%; height: auto";} ?>" class="d-block w-100" src="<?php echo base_url('imagens/agranel.jpg') ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group" data-toggle="modal" data-target="#exampleModalCenter" onclick="solicitar(2)" style="cursor: pointer">
                <div class="row">
                    <div class="col-md-12">
                        <img style="<?php if($mobile_view == 0){echo "height: 250px";}else{echo "width: 100%; height: auto";} ?>" class="d-block w-100" src="<?php echo base_url('imagens/atacado.jpg') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solicitação de Cachaça</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('406e133b78aebb38adf22fea8cf10a70') ?>" method="post">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Tipo:</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="Agranel">Cachaça agranel</option>
                    <option value="Atacado">Venda atacado</option>
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label style="font-size: 14px">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="col-md-6 form-group">
                <label style="font-size: 14px">Telefone:</label>
                <input type="text" class="telefone form-control" name="telefone" required>
            </div>
            <div class="col-md-6 form-group">
                <label style="font-size: 14px">CEP:</label>
                <input type="text" id="cep" onkeyup="autofillCEP()" class="cep form-control" name="cep" required>
            </div>
            <div class="col-md-6 form-group">
                <label style="font-size: 14px">Rua:</label>
                <input type="text" id="rua" class="form-control" name="rua" required>
            </div>
            <div class="col-md-3 form-group">
                <label style="font-size: 14px">Complemento:</label>
                <input type="text" id="complemento" class="form-control" name="complemento">
            </div>
            <div class="col-md-3 form-group">
                <label style="font-size: 14px">Número:</label>
                <input type="text" id="numero" class="form-control" name="numero" required>
            </div>
            <div class="col-md-5 form-group">
                <label style="font-size: 14px">Bairro:</label>
                <input type="text" id="bairro" class="form-control" name="bairro" required>
            </div>
            <div class="col-md-4 form-group">
                <label style="font-size: 14px">Cidade:</label>
                <input type="text" id="cidade" class="form-control" name="cidade" required>
            </div>
            <div class="col-md-3 form-group">
                <label style="font-size: 14px">Estado:</label>
                <input type="text" id="estado" class="form-control" name="estado" required>
            </div>
            <div class="col-md-6 form-group">
                <label style="font-size: 14px">Empresa:</label>
                <input type="text" class="form-control" name="empresa" required>
            </div>
            <div class="col-md-6 form-group">
                <label style="font-size: 14px">CNPJ:</label>
                <input type="text" class="cnpj form-control" name="cnpj" required>
            </div>
            <div class="col-md-12 form-group">
                <label style="font-size: 14px">Mensagem:</label>
                <textarea type="text" class="form-control" name="mensagem" required></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary" style="padding: 20px; border-radius: 5px; color: white; background: #3a0b0c;">Enviar</button>
        <button type="button"  class="btn btn-primary" style="padding: 20px; border-radius: 5px; color: white; background: #c7080c;" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
    
    <div id="btn-zap" class="wp-btn" style="z-index: 3">
        <a title="WhatsApp" href="https://api.whatsapp.com/send?phone=55<?php echo $telefonedecontato ?>" target="_blank"> <i class="fa fa-whatsapp"></i></a>
    </div>

    
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js'></script>
    
    <script>
        $('.pesquisa').click(function(event) {
            event.preventDefault();
            var n = $(document).height();
            $('html, body').animate({ scrollTop: n - 1823}, 80);
        //                                       |          |
        //                                       |          --- duration (milliseconds) 
        //                                       ---- distance from the top
        });
    </script>
    
    <script>
        function autofillCEP(){
            var cep = $('#cep').val().replace(/\D/g,'');
            if(cep.length == 8){
                dados = new FormData();
                dados.append('cep', cep);
                $.ajax({
                    url: '<?php echo base_url('00af9148767db1213585b339276df4e6'); ?>',
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
                            $('#cep').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                            $('#cidade').val(ce[0]);
                            $('#estado').val(ce[1]).change();
                            $('#bairro').val(cep.cep_bairro);
                            if(cep.cep_rua.indexOf(',') > 0){
                                var rua = cep.cep_rua.split(',');
                                $('#rua').val(rua[0]);
                            }else if(cep.cep_rua.indexOf(' - ') > 0){
                                var rua = cep.cep_rua.split(' - ');
                                $('#rua').val(rua[0]);
                            }else{
                                $('#rua').val(cep.cep_rua);
                            }
                        }
                    },
                });
            }
        }
    </script>
    
    <script>
        function solicitar(id){
            if(id == 1){
                $('#tipo').val('Agranel').change();
            } else {
                $('#tipo').val('Atacado').change();
            }
        }
    </script>
    
    <script>
        $(document).ready(function(){
            var SPMaskBehavior = function (val) {
              return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
              onKeyPress: function(val, e, field, options) {
                  field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            
            $('.telefone').mask(SPMaskBehavior, spOptions);
            
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('.cep').mask('00000-000');
            
            $('#img_1').addClass('uma').css({'transition': 'all .8s', 'transform': 'scale(1)'});
            var ganTam = parseInt($('#ganTam').css('z-index'));
            var ganTam2 = parseInt($('#ganTam2').css('z-index'));
            $('.ganhadores').slick({
                slidesToShow: ganTam,
                slidesToScroll: 1
            });
            $('#resultado_slick').slick({
                slidesToShow: ganTam2,
                slidesToScroll: 1
            });
            $('.select2-1').select2({theme: 'bootstrap'});
        });
        $('#main_banner').bind('slide.bs.carousel', function (e) {
            if($('#img_1').hasClass('uma')){
                $('#img_1').removeProp('style').removeClass('uma');
            }
        });
        $("#main_banner").swipe({
            excludedElements: "input, select, textarea, .noSwipe",
            swipeLeft: function() {
    	        $(this).carousel('next');
    	    },
    	    swipeRight: function() {
    	        $(this).carousel('prev');
    	    },
    	    allowPageScroll: 'vertical'
	    });
	    $("#resultado-carousel").swipe({
            excludedElements: "input, select, textarea, .noSwipe",
            swipeLeft: function() {
    	        $(this).carousel('next');
    	    },
    	    swipeRight: function() {
    	        $(this).carousel('prev');
    	    },
    	    allowPageScroll: 'vertical'
	    });
	    $('#acc_cookies').on('click', function(){
            $('#div_cookies').css('display', 'none');
        });
        $('#acc_cookies2').on('click', function(){
            $('#div_cookies').css('display', 'none');
        });
        function close_cookie(){
            $('#new-cookie').css('visibility', 'hidden');
        }
    </script>

    <script>
        var produtos = <?php if($produtos != null){echo json_encode($produtos);}else{echo "''";} ?>;
        
        function searchTrigger2(val){
            $('.box-search').html('');
            if(val != "" && val != " "){
                for(var i = 0; i < produtos.length; i++){
                    var nome = retira_acentos(produtos[i].produto_nome).toLowerCase();
                    var search = retira_acentos(val).toLowerCase();
                    if(nome.indexOf(search) > -1){
                        var bt = "";
                        if(i == 0){bt = "style='border-top: 0; font-family: inherit;!important; text-transform: lowercase!important; '";}
                        var id = produtos[i].produto_id;
                        var a = "<a class='search-item' href='<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/') ?>"+id+"'>"+
                                    "<p "+bt+">"+
                                        produtos[i].produto_nome.toLowerCase()+
                                    "</p>"+
                                "</a>";
                        $('.box-search').append(a);
                    }
                }
                $('.box-search').css('display', 'block');
            }else{
                $('.box-search').css('display', 'none');
            }
        }
        
        $(document).on("click", function(event){
            if(!$(event.target).closest(".search-div").length){
                $('.box-search').html('').css('display', 'none');
            }
        });
        
        function retira_acentos(str) {
            com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŔÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿŕ";
            sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
            
            novastr="";
            
            for(i=0; i<str.length; i++) {
                troca=false;
                for (a=0; a<com_acento.length; a++) {
                    if (str.substr(i,1)==com_acento.substr(a,1)) {
                        novastr+=sem_acento.substr(a,1);
                        troca=true;
                        break;
                    }
                }
                if (troca==false) {
                    novastr+=str.substr(i,1);
                }
            }
            return novastr;
        }
    </script>