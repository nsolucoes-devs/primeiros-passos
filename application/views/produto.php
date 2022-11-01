    <?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $mobile = 1;
        $mobile_view = 1;
    } else {
        $mobile = 0;
        $mobile_view = 0;
    }
    ?>

    <style>
        body {
            background: #fafafa !important;
        }

        .coracao:hover {
            color: brown;
        }

        .btn::before {
            background: #f9fdff !important;
        }

        .bolinha {
            border-radius: 30px;
            border: 1px solid brown;
            width: 16px !important;
            height: 16px !important;
        }

        .popover-body {
            padding: 15px;
            font-weight: 700;
        }

        <?php if ($mobile == 0) { ?>.zoom:hover {
            transform: scale(1.1);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        <?php } ?>.card-relacionados {
            cursor: pointer;
            border-radius: 10px;
            border: 0;
            box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
        }

        .imagem-produto {
            max-width: 300px !important;
            min-width: 250px !important;
            max-height: 300px !important;
            min-height: 300px !important;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
        }

        .p-detalhes {
            font-size: 12px;
        }

        #detalhes p {
            color: #444 !important;
        }

        .titulo-produto {
            font-size: 25px;
            font-weight: bold;
            color: rgb(102, 102, 102);
            text-transform: none;
            line-height: 1.1;
            margin-bottom: 5px;
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .titulo-relacionado {
            font-size: 30px;
        }



        .produto-desconto {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #25e625;
            padding: 0 4px;
            color: white;
            border-radius: 3px;
        }

        <?php if (isset($relacionados)) { ?><?php if (count($relacionados) == 1) { ?>#variacoes .slick-track {
            width: 100% !important;
        }

        <?php } ?><?php } ?>#variacoes .slick-arrow {
            background-color: #1f227e !important;
            border-radius: 50%;
        }

        .card-variacoes {
            cursor: pointer;
            border-radius: 10px;
            border: 0;
            box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
            border: 1px solid #ececec !important;
            height: 120px;
        }

        .variacoes-div {
            box-sizing: border-box;
            float: left;
            padding: 15px;
        }

        .imagem-variacoes {
            width: 150px;
            height: 95px;
        }

        .pro-valor {
            font-size: 28px;
            font-weight: 600;
            text-align: left;
            line-height: normal;
            margin: 0px;
            color: var(--base-color) !important;
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .icone-finalizar {
            color: white;
            font-size: 25px
        }

        .btn-esgotado {
            cursor: auto;
            text-align: center;
            background: white !important;
            color: #c5c5c5;
            border: 1px solid #cecece;
            font-weight: 700;
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            padding: 20px;
            font-size: 18px;
            border-radius: 5px;
        }

        .relacionados-div {
            width: 50%;
            max-width: 50%;
            flex: 0 0 50%;
            box-sizing: border-box;
            float: left;
            padding: 15px;
        }

        .card-relacionados {
            cursor: pointer;
            border-radius: 10px;
            border: 0;
            box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
        }

        .prod-departamento {
            font-size: 15px;
            color: grey;
            margin-bottom: 3px;
            margin-top: 10px;
            line-height: 0px;
            text-align: center;
        }

        .prod-nome {
            font-size: 15px;
            margin-bottom: 0px;
            color: #444;
            font-weight: bold;
        }

        .prod-preco {
            color: #444;
            text-align: center;
        }

        .stars {
            margin-top: 15px;
            margin-bottom: 0px;
            line-height: 0px;
        }

        .img-stick {
            width: 130px !important;
            height: 130px !important;
            padding: 10px 10px !important;
        }

        @media(max-width: 1050px) {
            .img-stick {
                width: 280px !important;
            }
        }

        @media(max-width: 769px) {
            .img-stick {
                width: 250px !important;
            }
        }

        @media(max-width: 500px) {
            .btn-esgotado {
                padding: 25px !important;
                font-size: 16px !important;
            }

            .pro-valor {
                font-size: 23px;
                text-align: center;
            }

            .imagem-produto {
                height: 250px;
                width: 250px;
            }

            #imagem-loading {
                margin-left: 25% !important;
            }

            .p-detalhes {
                font-size: 9px;
            }

            .titulo-produto {
                font-size: 22px;
            }

            .titulo-relacionado {
                font-size: 35px;
            }

            .card-variacoes {
                height: 100px !important;
            }

            .variacoes-div {
                padding: 5px !important;
            }

            .imagem-variacoes {
                height: 80px !important;
            }

            .buttoncarrinho {
                font-size: 12px !important;
                font-weight: 800 !important;
                padding: 15px !important;
            }

            .icone-finalizar {
                padding-top: 10px !important;
                font-size: 30px !important;
            }
        }

        .p-vendedores {
            font-size: 20px;
            display: inline;
            color: black;
        }

        /* these styles are for the demo, but are not required for the plugin */
        .zoom {
            display: inline-block;
            position: relative;
        }

        /* magnifying glass icon */
        .zoom:after {
            content: '';
            display: block;
            width: 33px;
            height: 33px;
            position: absolute;
            top: 0;
            right: 0;
            background: url(icon.png);
        }

        .zoom img {
            display: block;
        }

        .zoom img::selection {
            background-color: transparent;
        }

        <?php if ($mobile == 1) { ?>.col-xs-7 {
            flex: 0 0 58.33%;
            max-width: 58.33%;
            width: 58.33%;
            float: left;
            margin-left: 19%;
        }

        <?php } ?>.carousel-indicators .active {
            background-color: #524d4d !important;
        }

        .carousel-indicators {
            position: absolute;
            display: flex;
            flex-direction: column;
            left: -25%;
            top: 0;
            gap: 8px;
            width: 50px;
        }

        .carousel-indicators>img {
            cursor: pointer;
            aspect-ratio: 1/1;
            object-fit: contain;
            box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
        }

        .buttoncarrinho {
            font-weight: 700;
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            padding: 20px;
            font-size: 18px;
            border-radius: 5px;
            color: white;
            background: var(--base-color) !important;
            border: 0;
            cursor: pointer;
        }

        .buttoncarrinho:hover {
            color: #d0d0d0;
            background: #28769a !important;
        }

        .card-product {}


        .produto-titulo {
            text-align: center;
            color: #444;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;

            line-height: 16px;
            max-height: 16px;
            margin-bottom: 10px;
            margin-top: 2%;
            word-break: break-word;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: nowrap;
            max-width: 25ch;
        }

        /* Normal desktop :1200px. */
        @media (min-width: 1200px) and (max-width: 1500px) {

            .owl-carousel .owl-item img.img-product {
                display: block;
                height: 150px;
                width: 165px;
                margin: auto;
            }

        }

        /* Normal desktop :992px. */
        @media (min-width: 992px) and (max-width: 1200px) {
            .owl-carousel .owl-item img.img-product {
                display: block;
                height: 140px;
                width: 165px;
                margin: auto;
            }

        }

        /* Tablet desktop :768px. */
        @media (min-width: 768px) and (max-width: 991px) {
            .owl-carousel .owl-item img.img-product {
                display: block;
                height: 100px;
                width: 80px;
                margin: auto;
            }
        }

        /* small mobile :320px. */
        @media (max-width: 767px) {
            .owl-carousel .owl-item img.img-product {
                display: block;
                height: 100px;
                width: 100px;
                margin: auto;
            }

            .carousel-indicators {
                margin: 0 auto;
                left: 0px;
                top: 100%;
                flex-direction: row;
                gap: 4px;
                height: 50px;
            }

        }

        /* Large Mobile :480px. */
        @media only screen and (min-width: 480px) and (max-width: 767px) {
            .owl-carousel .owl-item img.img-product {
                display: block;
                height: 100px;
                width: 100px;
                margin: auto;
            }

        }
    </style>


    <section class="contact-section" style="padding-top: <?php if ($mobile == 1) {
                                                                echo '0';
                                                            } else {
                                                                echo '70';
                                                            } ?>px; padding-bottom: 0px; background: #fafafa!important;">
        <div class="container row-eq-height" style="padding: <?php if ($mobile == 1) {
                                                                    echo '40';
                                                                } else {
                                                                    echo '15';
                                                                } ?>px;">
            <div class="row row-eq-height">
                <div class="col-md-7 form-group">
                    <div class="card" style="padding: 10px; border: 0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselproduct" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">

                                            <img onclick="trocaimagem(0)" class="d-block w-100" src="<?= base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>">

                                            <?php
                                            for ($i = 0; $i <= 4; $i++) { ?>
                                                <?php if ($produto) { ?>
                                                    <?php if ($produto['produto_imagens_opcional' . $i]) { ?>
                                                        <img onclick="trocaimagem(<?php echo $i; ?>)" class="d-block w-100" src="<?php echo base_url() . $produto['produto_imagens_opcional' . $i] ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>

                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" id="item1">
                                                <span class='zoom ex' id='primeiraImagem' style="display: none; width: 100%!important">
                                                    <?php if ($produto) { ?>
                                                        <img onclick="abrirImagem('<?php echo base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>')" class="d-block w-100 imagem-produto" src="<?php echo base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>" alt="First slide">
                                                    <?php } ?>
                                                </span>
                                                <span id="loading" style="width: 100%!important">
                                                    <img id="imagem-loading" style="margin-left: 39%;margin-bottom: 30%;margin-top: 15%;width: 150px;" src="<?php echo base_url('imagens/loading.gif') ?>" alt="First slide">
                                                </span>
                                            </div>
                                            <?php if ($produto) { ?>
                                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                    <?php if ($produto['produto_imagens_opcional' . $i] != null || $produto['produto_imagens_opcional' . $i] != "") { ?>
                                                        <div class="carousel-item" id="item<?php echo $i + 1; ?>">
                                                            <span class='zoom ex' style="width: 100%!important">
                                                                <img class="imagem-produto d-block w-100" src="<?php echo base_url($produto['produto_imagens_opcional' . $i]) ?>">
                                                            </span>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- <div class="estrelas w-100 text-right" style="text-shadow: 0 0 1px #736102;font-size: 20px;color: gold!important;">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 form-group">
                    <div class="card" style="border: 0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($produto) { ?>
                                        <h3 class="titulo-produto"><?php echo ucwords(mb_strtolower($produto['produto_nome'])) ?></h3>
                                    <?php } ?>
                                </div>

                                <div class="col-md-6">
                                    <?php if ($produto) { ?>
                                        <?php if ($produto['produto_modelo']) { ?>
                                            <p style="color: grey">Modelo: <?php echo ucwords(mb_strtolower($produto['produto_modelo'])) ?></p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                                <div class="col-md-6">
                                    <?php if ($produto) { ?>
                                        <?php if ($produto['produto_modelo']) { ?>
                                            <p style="color: grey">Marca: <?php echo ucwords(mb_strtolower($produto['produto_marca'])) ?></p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                                <?php if (!empty($tamanhos[0]) || !empty($cores[0])) { ?>
                                    <div class="col-md-12 form-group">
                                        <label><b>Selecione a Opção</b></label>
                                        <div class="col-md-12 input-group mx-auto row">
                                            <?php if (!empty($tamanhos[0])) { ?>
                                                <select data-placement="top" data-toggle="popover" id="tamanhos" class="form-control w-50">
                                                    <option value="" disabled selected hidden> Tamanho </option>
                                                    <?php foreach ($tamanhos as $t) { ?>
                                                        <?= '<option value="' . $t . '">' . $t . '</option>' ?>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                            <?php if (!empty($cores[0])) { ?>
                                                <select data-placement="top" data-toggle="popover" id="cores" class="form-control w-50">
                                                    <option value="" disabled selected hidden> Cor </option>
                                                    <?php foreach ($cores as $c) { ?>
                                                        <?= '<option value="' . $c . '">' . $c . '</option>' ?>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- <div class="col-lg-6 col-md-12 col-12 text-left form-group">
                                    <?php if (isset($porcentagem)) { ?>
                                        <p style="margin: 0; padding: 0; color: color: #757575;"><span style="text-decoration: line-through;">R$ <?php echo number_format($porcentagem['valorOriginal'], 2, ',', '.') ?></span>&nbsp;&nbsp;<span style="background-color: #28d028; padding: 3px; border-radius: 5px; font-size: 11px; color: white"><i class="fa fa-arrow-down" aria-hidden="true"></i> <b style="color: white;"><?php echo round($porcentagem['desconto']); ?>%</b></span></p>
                                    <?php } ?>    
                                        <h3 class="pro-valor">R$<?php echo number_format($valor, 2, ',', '.') ?></h3>
                                </div> -->

                                <?php if ($estoque != 0) { ?>
                                    <div class="col-lg-6 col-md-12 col-12 text-center form-group">
                                        <div class="qtd-group input-group mb-2">
                                            <div class="input-group-prepend" style="cursor: pointer" onclick="diminuir()">
                                                <span class="input-group-text" style="background: transparent">
                                                    <i class="marrom-padrao fa fa-minus" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input id="qtd" name="qtd" max="<?php echo $estoque ?>" min="1" type="number" style="border-left: 0; border-right: 0" class="qtd text-center form-control" value="1" readonly>
                                            <div class="input-group-prepend" style="cursor: pointer" onclick="aumentar()">
                                                <span class="input-group-text" style="border-left: 0; background: transparent">
                                                    <i class="marrom-padrao fa fa-plus" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <hr>
                                    <div class="col-md-12 col-12 form-group" style="margin-top: 5%" id="div-esgotado">
                                        <span class="btn-esgotado btn btn-block">
                                            PRODUTO ESGOTADO&nbsp;&nbsp;<i class=" fa fa fa-exclamation" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                <?php } ?>

                                <div class="col-md-12 col-12 form-group" style="margin-top: 5%" id="div-estoque">
                                    <button onclick="Carrinho()" class="btn btn-primary btn-block btn-lg">
                                        COMPRAR &nbsp;&nbsp;<i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($produto) {
            if ($produto['produto_detalhes'] != '<p><br></p>') { ?>
                <div class="container">
                    <div class="row" style="width: 100%; padding: 0!important; margin: 0; margin-top: 4%; margin-bottom: 2%;">
                        <div class="col-md-12">
                            <h5 style="text-align: underline">Detalhes do Produto:</h5>
                            <p style="text-align: justify;">
                            <div id="detalhes" style="font-weight: bold; text-align: justify; padding: 0 15px; color: #444!important"><?php echo $produto['produto_detalhes'] ?></div>
                            </p>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <div class="container">
            <div class="row" style="width: 100%!important; margin-bottom: 5%!important; padding: 0; margin: 0">
                <div class="col-md-12 form-group" style="padding: 30px; margin: 0">
                    <h5 style="text-align: underline">Você pode se interessar também:</h5>
                </div>
                <div id="owl-demo" class="owl-carousel owl-theme">
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="visuImagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="visualizarImagem" src="#">
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            relacionados();
        });

        function relacionados() {
            var dados = new FormData();
            dados.append('id', <?php echo $produto['produto_id']; ?>);
            $.ajax({
                url: '<?php echo base_url('produto/relacionados'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                //dataType: 'json',
                beforeSend: function() {},
                error: function(xhr, status, error) {
                    $("#owl-demo").html('');
                    $("#owl-demo").append("Nenhum produto encontrado, em breve teremos mais novidades.");
                },
                success: function(data) {
                    $("#owl-demo").empty();
                    $("#owl-demo").append(data);
                    $('#owl-demo').owlCarousel({
                        navigation: true,
                        slideSpeed: 300,
                        paginationSpeed: 800,
                        singleItem: true,
                        autoplay: true,
                        <?php if ($mobile == 0) { ?>
                            items: 4,
                        <?php } ?>
                        <?php if ($mobile == 1) { ?>
                            items: 2,
                        <?php } ?>
                        loop: true,
                        margin: 10,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true

                    });
                },
            });
        }
    </script>




    <script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
    <script src="<?php echo base_url('recursos/js/material/plugins/sweetalert2.js'); ?>"></script>
    <script>
        window.onload = function() {
            $('.imagem-produto').next().attr('onclick', 'abrirImagem("<?php echo base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>")');
            $('.imagem-produto').next().css('cursor', 'pointer');
        };

        $(document).ready(function() {

            $('#carouselproduct').carousel({
                interval: 2000,
                cycle: true
            }); 


            <?php if ($estoque == 0) { ?>
                $('#div-esgotado').show();
                $('#div-estoque').hide();
            <?php } else { ?>
                $('#div-estoque').show();
                $('#div-esgotado').hide();
            <?php } ?>

            $(".carousel").carousel({
                interval: false,
                pause: true
            });

            $('.carousel').carousel({
                interval: false,
            });


            $('#primeiraImagem').show();

            $('#loading').hide();

            $('#variacoes').slick({
                slidesToShow: 3,
                slidesToScroll: 1
            });

            <?php if ($mobile == 0) { ?>
                $('.ex').zoom({
                    magnify: 1.1,

                });

            <?php } else { ?>
                $('#relacionados').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1
                });
            <?php } ?>
        });

        function Carrinho() {
            const tamanho = document.getElementById('tamanhos');
            const cor = document.getElementById('cores');

            if (validarOpcoes()) {
                var qtd = document.getElementById("qtd").value;

                var form = document.createElement("form");
                var element1 = document.createElement("input");
                var element2 = document.createElement("input");
                var element3 = document.createElement("input");


                form.id = 'compras';
                form.method = "POST";
                form.action = "<?php echo base_url(); ?>432b311230a5e558d6dfdd37aa7cb986";

                element1.name = "quantidade";
                element1.value = qtd;
                form.appendChild(element1);

                element2.name = "idProduto";
                element2.value = <?php echo $produto['produto_id']; ?>;
                form.appendChild(element2);

                if (tamanho) {
                    element3.name = "tamanho";
                    element3.value = $('#tamanhos').val();
                    form.appendChild(element3);
                } else if (cor) {
                    element3.name = "cor";
                    element3.value = $('#cores').val();
                    form.appendChild(element3);
                }

                document.body.appendChild(form);

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                Submit();
            }

        }

        function Submit() {
            var form = document.getElementById("compras");
            form.submit();
        }
    </script>
    <script>
        function abrirImagem(id) {
            $('#visualizarImagem').attr('src', id);
            $('#visuImagem').modal('show');
        }
    </script>
    <script>
        function aumentar() {
            if (validarOpcoes()) {
                document.getElementById("qtd").stepUp(1);
            }
        }

        function diminuir() {
            if (validarOpcoes()) {
                document.getElementById("qtd").stepDown(1);
            }
        }
    </script>
    <script>
        function validarOpcoes() {
            var boolean = true;
            const tamanho = document.getElementById('tamanhos');
            const cor = document.getElementById('cores');

            if (tamanho) {
                if ($('#tamanhos').val() == "" || $('#tamanhos').val() == " " || $('#tamanhos').val() == null) {
                    $('#tamanhos').popover({
                        'content': 'Selecione o tamanho!',
                        'show': 500,
                        'hide': 100,
                    });
                    $('#tamanhos').popover('show');
                    $('#tamanhos').focus();
                    boolean = false;
                }
            }

            if (cor) {
                if ($('#cores').val() == "" || $('#cores').val() == " " || $('#cores').val() == null) {
                    $('#cores').popover({
                        'content': 'Selecione a Cor!',
                        'show': 500,
                        'hide': 100,
                    });
                    $('#cores').popover('show');
                    $('#cores').focus();
                    boolean = false;
                }
            }

            return boolean;
        }
    </script>
    <script>
        function trocaimagem(id) {

            $('#item1').removeClass('active');
            $('#item2').removeClass('active');
            $('#item3').removeClass('active');
            $('#item4').removeClass('active');
            $('#item5').removeClass('active');
            $('#item6').removeClass('active');

            var item = id + 1;

            $('#item' + item).addClass('active');

            var img = "";

            if (id == 1) {
                img = '<?php echo base_url($produto['produto_imagens_opcional1']) ?>';
            } else if (id == 2) {
                img = '<?php echo base_url($produto['produto_imagens_opcional2']) ?>';
            } else if (id == 3) {
                img = '<?php echo base_url($produto['produto_imagens_opcional3']) ?>';
            } else if (id == 4) {
                img = '<?php echo base_url($produto['produto_imagens_opcional4']) ?>';
            } else if (id == 5) {
                img = '<?php echo base_url($produto['produto_imagens_opcional5']) ?>';
            } else {
                img = '<?php echo base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>';
            }

            $('.imagem-produto').next().attr('onclick', 'abrirImagem("' + img + '")');
        }
    </script>
    <script>
        function verificarEstoque() {
            const tamanho = document.getElementById('tamanhos');
            const cor = document.getElementById('cores');

            if (tamanho) {
                var tamanhos = $('#tamanhos').val().split('_');
                if (tamanhos[0] <= 0) {
                    $('#qtd').val(0);
                    $('.qtd-group').hide();
                    $('#div-esgotado').show();
                    $('#div-estoque').hide();
                } else {
                    $('#qtd').val(1);
                    $('#qtd').attr('max', tamanhos[0]);
                    $('.qtd-group').show();
                    $('#div-esgotado').hide();
                    $('#div-estoque').show();
                }
            }

            if (cor) {
                var cores = $('#cores').val().split('_');
                if (cores[0] <= 0) {
                    $('.qtd-group').hide();
                    $('#div-esgotado').show();
                    $('#div-estoque').hide();
                } else {
                    $('#qtd').val(1);
                    $('.qtd-group').show();
                    $('#qtd').attr('max', cores[0]);
                    $('#div-esgotado').hide();
                    $('#div-estoque').show();
                }
            }
        }
    </script>