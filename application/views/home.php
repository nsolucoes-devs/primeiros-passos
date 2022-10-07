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
        body {
            background: #fafafa!important;
        }
        .hero-area .owl-prev, .hero-area .owl-next{
            background-color: var(--base-color);
            display: none;
        }
        
        .hero-area .owl-prev:hover, .hero-area .owl-next:hover{
            background-color: var(--base-color);
        }
        
        .credit-btn{
            background-color: var(--base-color);
        }
        
        
        .card {
             box-shadow: rgb(0 0 0 / 20%) 0px 2px 6px;
        }
        .section-padding-100-0{
            padding-bottom: 100px;
        }
        .cta-2-area{
            background-color: #00000040;
        }
        .produto-desconto{
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--base-color-second);
            padding: 0 4px;
            color: white;
            border-radius: 3px;
        }
        .produto-titulo{
            text-align: center; 
            color: #444;
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
            font-size: 14px;
            margin-bottom: 10px;
            margin-top: 2%;
            line-height: 16px;
        }   
        .zoom {
          transition: transform .3s; /* Animation */
          cursor: pointer;
        }
        
        <?php if($mobile == 0){ ?>
        .zoom:hover {
          transform: scale(1.15); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
        <?php } ?>
        
        .hero-area .owl-dots .owl-dot.active{
            background-color: var(--base-color)!important;
        }
        
        .single-slide .slide-du-indicator{
            background-color: var(--base-color)!important;
        }
        
        .bg-gray{
            background-color: #ffecfb!important;
        }
        
        .p-card-final{
            font-size: 25px;
            background: var(--base-color);
            color: white;
            margin-left: 2px;
            margin-right: 3px;
        }
        
        #zap-home{
            right: 120px;
            top: -5px;
            position: absolute;
            border-radius: 50px;
            padding: 12px 16px;
            background: #34f534;
        }
        
        .relacionados-div{
            width: 50%;
            max-width: 50%;
            flex: 0 0 50%;
            box-sizing: border-box;
            float: left;
            padding: 15px;
        }
        .card-relacionados{
            cursor: pointer;
            border-radius: 10px;
            border: 0;
            
        }
        .estrelas{
             text-shadow: 0 0 1px #736102;
             color: gold!important;
             padding-top: 3%;
        }
        
        .owl-item .justify-content-center{
            height: 55%!important;   
        }
        
        .slick-arrow{
            display: none!important;
        }
        
        .single-slide .slide-bg-img {
            height: 50%!important;      
            -webkit-animation: slide-bg linear 4000ms infinite!important;
            animation: slide-bg linear 4000ms infinite!important;
        }
        
        .single-slide .slide-du-indicator {
            -webkit-animation: slide-du-indicator linear 4000ms infinite!important;
            animation: slide-du-indicator linear 4000ms infinite!important; 
            
        }
        
        .owl-stage-outer{
            height: 400px!important;
        }
        
        .imagem-produto{
            height: 175px;
            width:  auto;
            padding: 20px 40px;
        }
        
        .bg-home{
            background-size: 100% 100%;
        }
        
        .div-destaque{
            padding-left: 9%;
            padding-bottom: 2%;
            width: 100%;
        }
        
        .prod-preco{
            font-size: 20px;
            font-weight: bold;
            line-height: 30px;
            color: #444;
        }
        
        .banner-final{
            padding-top: 2%;
            padding-bottom: 5%;
            background: #0000005c;
            z-index: 1
        }
        @media only screen and (max-width: 1050px) {
            .imagem-produto {
                width: 445px;
                padding: 5px 80px;
            }
            .banner-final{
                padding-bottom: 15%!important;   
            }
        }
        
        @media only screen and (max-width: 769px) {
            .imagem-produto {
                width: 324px;
                padding: 5px 37px;
            }
            .banner-final{
                padding-bottom: 15%!important;   
            }
        }
        
        @media only screen and (max-width: 600px) {
            .div-destaque{
                padding-top: 0!important;
            }
            .bg-home{
                background-size: cover;
            }
            .imagem-produto{
                padding: 15px 15px;
            }
            #zap-home{
                right: 8px!important;
                top: -40px!important;
            }
            .p-card-final{
                margin-left: 0px!important;
                width: 100%!important;
            }
            .single-slide .slide-bg-img {
                height: 50%!important;
            }
            
        }
        
        .single-slide {
            height: 800px !important;
        }
        
    </style>
    
    <div class="hero-area">
        <div class="hero-slideshow owl-carousel">

            
            <div class="single-slide bg-img">
                
                <div class="bg-home slide-bg-img bg-img bg-overlay" style="background-image: url('<?php echo base_url() . $site['banner_principal1'] ?>');"></div>
                
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-12">
                            <div class="welcome-text">
                                <h2 data-animation="fadeInUp" data-delay="300ms"><?php echo $site['banner1_titulo'] ?></h2>
                                <p data-animation="fadeInUp" data-delay="500ms"><?php echo $site['banner1_subtitulo'] ?></p>
                                <?php if($site['banner1_buttonTexto']) { ?>
                                    <a href="<?php echo $site['banner1_buttonLink'] ?>" class="btn credit-btn mt-50" data-animation="fadeInUp" data-delay="700ms"><?php echo $site['banner1_buttonTexto'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide-du-indicator"></div>
            </div>

            
            <div class="single-slide bg-img">
                
                <div class="bg-home slide-bg-img bg-img bg-overlay" style="background-image: url('<?php echo base_url() . $site['banner_principal2'] ?>');"></div>
                
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-12">
                            <div class="welcome-text">
                                <h2 data-animation="fadeInDown" data-delay="300ms"><?php echo $site['banner2_titulo'] ?></h2>
                                <p data-animation="fadeInDown" data-delay="500ms"><?php echo $site['banner2_subtitulo'] ?></p>
                                <?php if($site['banner2_buttonTexto']) { ?>
                                    <a href="<?php echo $site['banner2_buttonLink'] ?>" class="btn credit-btn mt-50" data-animation="fadeInDown" data-delay="700ms"><?php echo $site['banner2_buttonTexto'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-du-indicator"></div>
            </div>

            
            <div class="single-slide bg-img">
                
                <div class="bg-home slide-bg-img bg-img bg-overlay" style=" background-image: url('<?php echo base_url() . $site['banner_principal3'] ?>');"></div>
                
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-12">
                            <div class="welcome-text">
                                <h2 data-animation="fadeInUp" data-delay="300ms"><?php echo $site['banner3_titulo'] ?></h2>
                                <p data-animation="fadeInUp" data-delay="500ms"><?php echo $site['banner3_subtitulo'] ?></p>
                                <?php if($site['banner3_buttonTexto']) { ?>
                                    <a href="<?php echo $site['banner3_buttonLink'] ?>" class="btn credit-btn mt-50" data-animation="fadeInUp" data-delay="700ms"><?php echo $site['banner3_buttonTexto'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide-du-indicator"></div>
            </div>

            
            <div class="single-slide bg-img">
                
                <div class="bg-home slide-bg-img bg-img bg-overlay" style="background-image: url('<?php echo base_url() . $site['banner_principal4'] ?>');"></div>
                
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-12">
                            <div class="welcome-text">
                                <h2 data-animation="fadeInDown" data-delay="300ms"><?php echo $site['banner4_titulo'] ?></h2>
                                <p data-animation="fadeInDown" data-delay="500ms"><?php echo $site['banner4_subtitulo'] ?></p>
                                <?php if($site['banner4_buttonTexto']) { ?>
                                    <a href="<?php echo $site['banner4_buttonLink'] ?>" class="btn credit-btn mt-50" data-animation="fadeInDown" data-delay="700ms"><?php echo $site['banner4_buttonTexto'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide-du-indicator"></div>
            </div>
            
            
        </div>
    </div>
    

    
    <div class="row div-destaque mt-5">
        <div class="col-md-12">
            <h3 style="color: var(--base-color)">DESTAQUE</h3>
        </div>
    </div>

    <!-- ##### Produtos Primeira Linha Area Start ###### -->
    <section class="features-area section-padding-100-0" style="padding-top: 10px!important; padding-bottom: 30px!important; ">
        <div class="container">
            <div class="row align-items-end">
                <?php  if($produtos) { ?>
                    <?php $aux = 0; foreach($produtos as $p){ ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-6 form-group" style="margin-bottom: 4rem">
                            <a href="<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/'). $p['produto_id'] ?>">
                            <div class="card zoom" style="height: 320px; border-bottom: .5rem solid var(--base-color)">
                                <div class="card-body" style="padding: 2px;">
                                    <div class="d-flex"> 
                                      <img class="imagem-produto mx-auto" src="<?php echo base_url('imagens/produtos/').$p['produto_id'] .'.jpg'; ?>" alt="">
                                    </div>
                                    <?php if(isset($p['produto_porcentagem'])){ ?>
                                        <p class="produto-desconto"><i class="fa fa-arrow-down" aria-hidden="true"></i> <?php $p['produto_porcentagem'] ?></p>
                                    <?php } ?>
                                    <div class="col-md-12 text-center">
                                        <div class="estrelas">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <p style="color: lightgrey; font-size: 13px; line-height: 12px; margin: 0; padding: 0"><b><?php echo ucfirst(mb_strtolower($p['produto_departamento'])) ?></b></p>
                                    </div>
                                    
                                    <p class="produto-titulo"><b><?php echo ucfirst(mb_strtolower($p['produto_nome'])) ?></b></p>
                                    
                                    <div class="row" style="padding-top: 5%">
                                        <?php if($p['produto_promocao']){ ?>
                                            <div class="col-md-12 col-12 text-center">
                                                <p class="prod-preco" style="color: #444; line-height: 15px; margin: 0!important; padding: 0!important;font-size: 12px; text-decoration: line-through;">R$ <?php echo number_format($p['produto_valor'],2,',','.') ?></p>
                                                <p class="prod-preco" style="font-size: 20px; color: #444; line-height: 19px;">R$ <?php echo number_format($p['produto_promocao'], 2,',','.') ?></p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-12 col-md-12 text-center" style="position: absolute;top: 270px;left: -2px;width: 100%">
                                                <p class="prod-preco">R$ <?php echo number_format($p['produto_valor'], 2,',','.') ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php $aux++;} ?>
                <?php } else {?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 form-group">
                    <div class="card text-center d-flex align-items-center justify-content-center" style="min-height: 320px; border-bottom: .5rem solid var(--base-color)">
                        <h1 style="color: var(--base-color-alt)">Em breve produtos aqui!</h1>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- ##### Produtos End ###### -->
    <br>
    <?php if($mobile == 0){ ?>
    <div class="container-fluid" style="padding: 0px 117px!important;">
        <div class="row">
            <div class="col-md-4">
                <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="background-size: 100% 100%; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno1.jpg'); background-repeat: no-repeat; padding-top: 0!important">
                    <div class="container-fluid" style="padding-top: 2%;padding-bottom: 60%; z-index: 1">
            
                    </div>
                </section>
            </div>
            
            <div class="col-md-4">
                <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="background-size: 100% 100%; background-position: right; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno2.jpg'); background-repeat: no-repeat; padding-top: 0!important">
                    <div class="container-fluid" style="padding-top: 2%;padding-bottom: 60%; z-index: 1">
                    </div>
                </section>
            </div>
            
            <div class="col-md-4">
                <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="background-size: 100% 100%; background-position: right; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno3.jpg'); background-repeat: no-repeat; padding-top: 0!important">
                    <div class="container-fluid" style="padding-top: 2%;padding-bottom: 60%; z-index: 1">
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php } else { ?>
    
    <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="border-radius: 10px;margin: 5% 15%;background-size: 100% 100%; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno1.jpg'); background-repeat: no-repeat; padding-top: 0!important">
        <div class="container-fluid" style="padding-top: 2%;padding-bottom: 50%; z-index: 1">

        </div>
    </section>

    <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="border-radius: 10px;margin: 5% 15%;background-size: 100% 100%; background-position: right; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno2.jpg'); background-repeat: no-repeat; padding-top: 0!important">
        <div class="container-fluid" style="padding-top: 2%;padding-bottom: 50%; z-index: 1">
        </div>
    </section>
    
    <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="border-radius: 10px;margin: 5% 15%;background-size: 100% 100%; background-position: right; background-color: #f9fdff!important;background-image: url('<?php echo base_url() ?>imagens/banner_pequeno3.jpg'); background-repeat: no-repeat; padding-top: 0!important">
        <div class="container-fluid" style="padding-top: 2%;padding-bottom: 50%; z-index: 1">
        </div>
    </section>
    
    
    <?php } ?>
    <br><br><br><br>
    <!-- ##### Call To Action Start ###### -->
    <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms" style="background-image: url('<?php echo base_url() . $site['banner_contato'] ?>'); background-size: cover; padding-top: 0!important">
        <div class="container-fluid banner-final">
            <div class="row">
                
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content d-flex flex-wrap align-items-center justify-content-between" style="padding-top: 4%; padding-left: 15%; height: 12rem">
                        <div class="cta-text" style="margin-bottom: -1%!important;">
                            
                        </div>
                        <div class="cta-btn">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Call To Action End ###### -->
    
    
    <script>
        $(document).ready(function(){
            $('#relacionados').slick({
                slidesToShow: 2,
                slidesToScroll: 1
            });
    </script>
    
    
    
    

    