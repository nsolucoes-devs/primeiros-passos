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
    
    
    <style>
        #scrollUp {
            background-color: var(--base-color);
            border-radius: 30px;
        }
        
        #scrollUp:hover {
            background-color: var(--base-color-alt);
            color: var(--text-color-light);
        }
        
        .footer-area{
            background-color: #fbfbfb!important;
        }
        
        .footer-area .single-footer-widget .widget-title{
            color: black;
        }
        
        .footer-area .single-footer-widget ul li a{
            color: black;
        }
        #icone-facebook{
            color: var(--base-color);
        }
        
        #icone-instagram{
            color: var(--base-color);
        }
        
        #icone-facebook:hover{
            color: blue;
        }
        
        #icone-instagram:hover{
            color: purple;
        }

        #link-n:hover { 
            color: var(--base-color);
        }
        
        .footer-area .single-footer-widget ul li a::before{
            background-color: var(--base-color);
        }
        
        .footer-area .copywrite-area{
            padding: 10px 0!important;
            padding-bottom: 15px!important;
        }
        
        .footer-area{
            padding-top: 50px!important;
            padding-bottom: 0!important;
            border-top: 1px solid var(--base-color);
        }
        
        @media only screen and (max-width: 600px) {
            .footer-area .copywrite-area{
                padding-bottom: 100px!important;
                width: 100%;
            }
            .title-empresa{
                font-weight: 900;
                font-size: 26px;
                margin-bottom: 10px!important;
            }
            .div-footer-widget{
                margin-bottom: 60px!important;
            }
            .div-footer-widget2{
                margin-bottom: 40px!important;
            }
            .footer-area .copywrite-area .copywrite-text {
                margin-top: 5px!important;
            }
            .footer-area .copywrite-area {
                padding-bottom: 60px!important;
            }
        }
        
        .btn-primary {
            color: white!important;
            border-color: var(--base-color)!important;
            background-color: var(--base-color)!important;
        }
    
        .links-footer{margin-bottom: -12px; font-size: 12px; color: white;}
        .social-media{margin-right: 36px; display: inline;}
        .social-media em{color: white; font-size: 16px;}
        .footer{background-color: black; z-index: 99;}
        .f-row{width: 100%; margin: 0;}
        .c3{max-width: 25%; flex: 0 0 25%; padding-right: 15px; padding-left: 15px; float: left;}
        .c4{max-width: 33.33%; flex: 0 0 33.33%; padding-right: 15px; padding-left: 15px;}
        .c6{max-width: 50%; flex: 0 0 50%; padding-right: 15px; padding-left: 15px;}
        .c8{max-width: 66.66%; flex: 0 0 66.66%; padding-right: 15px; padding-left: 15px;}
        .c9{max-width: 75%; flex: 0 0 75%; padding-right: 15px; padding-left: 15px; float: left;}
        .c12{max-width: 100%; flex: 0 0 100%; padding-right: 15px; padding-left: 15px;}
        .f-main{padding: 15px 20px;}
        .card-brands{width: 76%;}
        .f-white{color: white; font-size: 11px; line-height: 13px; margin-bottom: 5px;}
        .f-white b{color: white; font-size: 11px; line-height: 13px; margin-bottom: 5px; font-weight: bold;}
        .br{border-right: 1px solid #d3d3d359;}
        .inline{display: inline;}
        .pr-80{padding-right: 80px;}
        .pr-90{padding-right: 90px;}
        .mt-21{margin-top: 18px;}
        .float-l{float: left;}
        .float-r{float: right;}
        .fs-22{font-size: 22px;}
        .social-media{margin: 3px 8px 0 8px; cursor: pointer;}
        #footer-pc{display: block;}
        #footer-mob{display: none;}
        .large-modal{width: 70%; max-width: 70%;}
        /* XX-Small devices (300px and up) */ 
        @media ( min-width: 299px ) and ( max-width: 398px ){
            #footer-pc{display: none;}
            #footer-mob{display: block;}
            .large-modal{width: 95%; max-width: 95%;}
        }
        /* X-Small devices (iPhone and others mobiles, 400px and up) */ 
        @media ( min-width: 399px ) and ( max-width: 574px ){
            #footer-pc{display: none;}
            #footer-mob{display: block;}
            .large-modal{width: 95%; max-width: 95%;}
        }
        /* Small devices (landscape phones, 576px and up) */ 
        @media ( min-width: 575px ) and ( max-width: 766px ){
            #footer-pc{display: none;}
            #footer-mob{display: block;}
            .large-modal{width: 95%; max-width: 95%;}
        }
        /* Medium devices (tablets, 768px and up) */ 
        @media ( min-width: 767px ) and ( max-width: 990px ){
        }
        /* Large devices (desktops, 992px and up) */ 
        @media ( min-width: 991px ) and ( max-width: 1198px ){
        }
        /* X-Large devices (large desktops, 1200px and up) */ 
        @media ( min-width: 1199px ) and ( max-width: 1398px ){
        }
        /* XX-Large devices (larger desktops, 1400px and up) */ 
        @media ( min-width: 1399px ){
        }
        #back-top{left: 15px; right: unset; bottom: 52px; background-color: grey; border-color: grey; opacity: 0.7; box-shadow: unset; z-index: 999; display: none;}
        .link-footer{cursor: pointer;}
        .p-footer{color: #a7a7a7;; margin: 0; padding: 0; font-size: 12px; line-height: 18px; cursor: pointer;}
        .p-footer:hover{color: white;}
        .c3{padding-right: 20px; padding-left: 20px;}
        .modal-p{font-size: 13px; color: black; margin-bottom: 0; text-align: justify;}
        .modal-ul li{list-style-type: disc; list-style-position: inside; font-size: 13px; color: black; text-align: justify;}
        
        <?php if($mobile){ ?>
        #back-top{
            left: 5px;
        }
        <?php } ?>
    </style>


    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Single Footer Widget -->
                <div <?php if($mobile == 1){ ?> class="mobilefooter-social col-lg-4 col-md-4 col-12 text-center" <?php } else { ?> class="mobilefooter-social col-12 col-sm-6 col-lg-4" <?php } ?>>
                    <div class="single-footer-widget mb-100 div-footer-widget">
                        <h5 class="widget-title title-empresa"><?php echo $nome_empresa ?></h5>
                        <p><?php echo $endereco ?></p>
                        <p class="text-center"><i style="font-size: 18px" class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; +55 <span class="telefone"><?php echo $telefone ?></span></span></p>
                        <div class="row">
                            <a href="<?php echo $facebook ?>" target="_blank"><i id="icone-facebook" <?php if($mobile == 1){ ?> style="cursor: pointer; left: 37%; position: absolute; font-size: 35px;"  <?php } else { ?> style="cursor: pointer; left: 30%; position: absolute; font-size: 35px;" <?php } ?> class="fa fa-facebook-square" aria-hidden="true"></i></a>
                            <a href="<?php echo $instagram ?>" target="_blank"><i id="icone-instagram" <?php if($mobile == 1){ ?> style="cursor: pointer; left: 55%; position: absolute; font-size: 35px;" <?php } else { ?> style="cursor: pointer; left: 45%; position: absolute; font-size: 35px;" <?php } ?> class="fa fa-instagram" aria-hidden="true"></i></a>
                            <!--<i id="icone-youtube" style="cursor: pointer; left: 60%; position: absolute; font-size: 35px;" class="fa fa-youtube-play" aria-hidden="true"></i>-->
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-lg-4 col-md-4 col-6" <?php if($mobile == 1){ ?> style="padding-left: 16%" <?php } ?>>
                    <div class="single-footer-widget mb-100 div-footer-widget2">
                        <h5 class="widget-title"><b>Serviço</b></h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <!--<li><a style="margin: 10px; cursor: pointer" data-toggle="modal" data-target="#sobre">Loja</a></li>-->
                                <li><a style="margin: 10px; cursor: pointer" data-toggle="modal" data-target="#privacidade">Privacidade</a></li>
                                <li><a style="margin: 10px; cursor: pointer" data-toggle="modal" data-target="#termos">Termos</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-lg-4 col-md-4 col-6" <?php if($mobile == 1){ ?> style="padding-left: 10%" <?php } ?>>
                    <div class="single-footer-widget mb-100 div-footer-widget2">
                        <h5 class="widget-title"><b>Sobre</b></h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a style="margin: 10px;" href="<?php echo base_url('inicio/contato') ?>">Contato</a></li>
                                <li><a style="margin: 10px;" href="https://api.whatsapp.com/send?phone=11968372751">Whats</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area" style="background: var(--base-color); border-top: 10px solid #ecf9ff!important;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"></a>

                            <!-- Copywrite Text -->
                            <p <?php if($mobile==1) { ?> class="copywrite-text text-center" <?php } else { ?> class="copywrite-text" <?php } ?>style="color: white!important; width: 100%;">
                            <b>Copyright &copy; <?php echo $nome_empresa ?>, <?php if($mobile == 1){ ?><br><?php } ?> todos direitos reservados. </b><a id="link-n" <?php if ($mobile == 0) { ?> style="position: relative; left: 48%;" <?php } ?>href="https://nsolucoes.digital/" target="_blank"> <?php if($mobile == 1) { ?> <br> <?php } ?><b style="color: white!important; <?php if ($mobile== 1 ){ ?> position: relative; top: 20px; <?php } ?>">  Desenvolvido por N Soluções </b></a>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="modal" tabindex="-1" role="dialog" id="sobre">
        <div class="modal-dialog modal-dialog-centered large-modal" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0; padding: 10px 20px;">
                    <h5 class="modal-title" style="color: black; font-weight: bold; font-size: 16px;">Sobre a Loja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($sobre_loja)) { ?>
                                <?php echo $sobre_loja ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0; padding: 10px 20px;">
                    <div style="width: 100px">
                        <button type="button" class="btn btn-primary shadow-none" data-dismiss="modal" style="font-size: 14px">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" tabindex="-1" role="dialog" id="privacidade">
        <div class="modal-dialog modal-dialog-centered large-modal" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0; padding: 10px 20px;">
                    <h5 class="modal-title" style="color: black; font-weight: bold; font-size: 16px;">Política de privacidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($politica_privacidade)) { ?>
                                <?php echo $politica_privacidade ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0; padding: 10px 20px;">
                    <div style="width: 100px">
                        <button type="button" class="btn btn-primary shadow-none" data-dismiss="modal" style="font-size: 14px">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" tabindex="-1" role="dialog" id="termos">
        <div class="modal-dialog modal-dialog-centered large-modal" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0; padding: 10px 20px;">
                    <h5 class="modal-title" style="color: black; font-weight: bold; font-size: 16px;">Política de Troca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($termos)) { ?>
                                <?php echo $termos ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0; padding: 10px 20px;">
                    <div style="width: 100px">
                        <button type="button" class="btn btn-primary shadow-none" data-dismiss="modal" style="font-size: 14px">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
        })
    </script>
    
    
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="<?php echo base_url('recursos/raquel/') ?>js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url('recursos/raquel/') ?>js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url('recursos/raquel/') ?>js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="<?php echo base_url('recursos/raquel/') ?>js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="<?php echo base_url('recursos/raquel/') ?>js/active.js"></script>
    
    <script src="<?php echo base_url('recursos/js/'); ?>jquery.mask.min.js"></script>
    
    <script src='<?php echo base_url('') ?>assets/js/jquery.zoom.min.js'></script>
    <script src="<?php echo base_url('assets/lib/slick-1.8.1/slick/slick.min.js'); ?>"></script>
    

</body>

</html>