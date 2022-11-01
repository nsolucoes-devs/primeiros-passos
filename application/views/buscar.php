    <style>
        body {
            background: #f9fdff !important;
        }

        .card {
            box-shadow: rgb(0 0 0 / 20%) 0px 2px 6px;
        }

        .produto-desconto {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--base-color-second);
            padding: 0 4px;
            color: white;
            border-radius: 3px;
        }

        .produto-titulo {
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
            line-height: 17px;
        }

        .zoom {
            transition: transform .3s;
            /* Animation */
            cursor: pointer;
        }

        .zoom:hover {
            border: 2px solid lightgrey;
        }


        .p-card-final {
            font-size: 25px;
            background: #fb25af;
            color: white;
            margin-left: 2px;
            margin-right: 3px;
        }

        .pagination-links a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
            margin: 2px;
            background: var(--base-color);
        }

        .pagination-links strong {
            color: var(--base-color);
            border: 1px solid var(--base-color);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .card_prod {
            height: 320px !important;
        }


        .imagem_prod {
            height: 180px;
            width: 250px;
            padding: 20px 40px;
        }

        .comprar {
            height: 5px;
            background-color: var(--base-color);
            position: absolute;
            bottom: 0;
            left: 14px;
            width: 101%;
        }

        .div-preco {
            width: 100%;
            position: absolute;
            top: 270px;
            left: 0px;
        }

        .icone-drop {
            font-size: 19px;
            position: relative;
            left: 3px;
            top: -2px;
        }

        @media only screen and (max-width: 768px) {
            #menu {
                display: none;
            }

            .div-preco {
                top: 252px;
            }

            .comprar {
                width: 100% !important;
                left: 15px !important;
            }

            .imagem_prod {
                height: 160px;
                width: 250px;
                padding: 15px 30px;
            }

            .card_prod {
                height: 300px !important;
            }

            #div_preco1 {
                padding: 0px !important;
            }

            #div_preco2 {
                padding: 0px !important;
            }

            #fonte_varejo {
                font-size: 15px !important;
            }

            #campo_preco {
                left: 10% !important;
            }
        }

        .departamento-product {
            color: lightgrey;
            font-size: 13px;
            line-height: 12px;
            margin: 0;
            padding: 0
        }

        .product-titulo {
            text-align: center;
            color: #444;
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
            /* font-size: 14px; */
            margin-bottom: 10px;
            margin-top: 2%;
            line-height: 16px;           
            text-overflow: ellipsis;
            max-height: 16px;
        }

        /* .features-area div.card {
            height: 100%;
        } */

        /* Normal desktop :1200px. */
        @media (min-width: 1200px) and (max-width: 1500px) {

            .features-area div.card {
                height: 250px;
            }

            .features-area div.card img {
                display:block;
                height: 150px;
                width: 165px;
                margin: auto;
            }
        }


        /* Normal desktop :992px. */
        @media (min-width: 992px) and (max-width: 1200px) {
            .features-area div.card {
                height: 250px;
            }

            .features-area div.card img {
                display:block;
                height: 140px;
                width: 165px;
                margin: auto;
            }
        }


        /* Tablet desktop :768px. */
        @media (min-width: 768px) and (max-width: 991px) {

            .features-area div.card img {
                display:block;
                height: 100px;
                width: 80px;
                margin: auto;
            }
        }


        /* small mobile :320px. */
        @media (max-width: 767px) {
            .departamento-product {
                font-size: 10px;
            }

            .product-titulo {
                font-size: 11px;
            }

            .features-area div.card img {
                display:block;
                height: 100px;
                width: 100px;
                margin: auto;
            }
        }

        /* Large Mobile :480px. */
        @media only screen and (min-width: 480px) and (max-width: 767px) {

            .features-area div.card img {
                display:block;
                height: 100px;
                width: 100px;
                margin: auto;
            }
        }
    </style>



    <section class="features-area section-padding-100-0" style="padding-top: 10px!important; padding-bottom: 30px!important; ">
        <div class="container-fluid">
            <div class="row" style="margin-top: 5%;">
                <div class="col-lg-2" id="menu">
                    <?php foreach ($departamentos as $dep) { ?>
                        <a href="#<?php echo str_replace(' ', '-', $dep['departamento']) ?>" data-toggle="collapse" <?php if (!array_key_exists('subs', $dep)) { ?>onclick="Submit2('<?php echo $dep['departamento_id']; ?>')" <?php } ?> href="#">
                            <p style="color: #444; font-weight: 600"> <?php echo $dep['departamento'] ?> <?php if (array_key_exists('subs', $dep)) { ?><i class="icone-drop fa fa-sort-desc" aria-hidden="true"></i><?php } ?></p>
                        </a>
                        <?php if (array_key_exists('subs', $dep)) { ?>
                            <div style="padding-bottom: 15px;" id="<?php echo str_replace(' ', '-', $dep['departamento']) ?>" class="collapse">
                                <?php foreach ($dep['subs'] as $sub) { ?>
                                    <a onclick="Submit2('<?php echo $sub['id']; ?>')" href="#">
                                        <p style="padding-left: 15px!important;" class="m-0 p-0"><?php echo ucwords(mb_strtolower($sub['nome'])); ?></p>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <?php if (is_array($produtos)) {
                            foreach ($produtos as $p) { ?>
                                <div class="col-lg-3 col-md-4 col-6 form-group produtos-div">
                                    <a href="<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/') . $p['produto_id'] ?>">
                                        <div class="card zoom">
                                            <div class="card-body text-center" style="padding: 2px;">
                                                <div class="mx-auto col-10 col-md-12 mt-3 h-75">
                                                    <img class="img-fluid" src="<?php echo base_url('imagens/produtos/') . $p['produto_id'] . '.jpg'; ?>" alt="">
                                                </div>
                                                <?php if (isset($p['produto_porcentagem'])) { ?>
                                                    <p class="produto-desconto"><i class="fa fa-arrow-down" aria-hidden="true"></i> <?php $p['produto_porcentagem'] ?></p>
                                                <?php } ?>
                                               <div class="col-md-12 text-center">
                                            <!-- <div class="estrelas" style="text-shadow: 0 0 1px #736102; color: gold!important; padding-top: 3%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div> -->
                                        </div>
                                                <div class="col-md-12 text-center">
                                                    <p class="departamento-product"><b><?php echo ucfirst(mb_strtolower($p['produto_departamento'])) ?></b></p>
                                                    <p class="product-titulo"><b><?php echo ucfirst(mb_strtolower($p['produto_nome'])) ?></b></p>
                                                </div>
                                                <!-- <div class="row" id="campo_preco">
                                            <?php if ($p['produto_promocao']) { ?>
                                                <div class="col-md-12 col-12 text-center">
                                                    <p class="prod-preco" style="color: #444; line-height: 15px; margin: 0!important; padding: 0!important;font-size: 12px; text-decoration: line-through;">R$ <?php echo number_format($p['produto_valor'], 2, ',', '.') ?></p>
                                                    <p class="prod-preco" style="font-size: 20px; color: #444; line-height: 19px;"><b style="color: #444">R$ <?php echo number_format($p['produto_promocao'], 2, ',', '.') ?></b></p>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-12 col-md-12 text-center div-preco">
                                                    <p class="prod-preco"><b style="font-size: 20px; font-weight: bold;line-height: 30px;color: #444;">R$ <?php echo number_format($p['produto_valor'], 2, ',', '.') ?></b></p>
                                                </div>
                                            <?php } ?>
                                        </div> -->
                                                <div class="row comprar"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php }
                        } ?>
                        <?php if ($produtos == null) { ?>
                            <div class="col-md-12 text-center">
                                <p><b>Nenhum produto encontrado :(</b></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="padding-top: 30px!important">
                            <p class="pagination-links"><?php echo $links; ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function Submit2(departamento) {
            var form = document.createElement("form");
            form.method = "GET";
            form.action = "<?php echo base_url('produto/buscaDepartamentos'); ?>";

            var element1 = document.createElement("input");
            element1.value = departamento;
            element1.name = "busca";
            form.appendChild(element1);

            document.body.appendChild(form);

            form.submit();
        }
    </script>