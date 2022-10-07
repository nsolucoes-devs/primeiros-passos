<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    $auxfooter = 0;
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $sm = 1;
    } else {
        $sm = 0;
    }
?>

<style>
    .nome-form{
        color: black;
        font-size: 16px;
    }
    .nav-tabs {
        background: transparent;
    }
    .nav-tabs {
        border-bottom: 1px transparent;
    }
    .nav-item{
        color: #555;
        cursor: default;
        border-radius: 4px 4px 0 0;
        background-color: #dedede;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
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
    
    .tab-li a{
        cursor: pointer;
    }
    
    .label-imagem{
        margin-top: 10px;
    }
    
    .botaoexcluir{
        top: 16px;
        left: 365px;
    }
    
    .active-tab2{
       border: 1px solid lightgrey;
       border-bottom: solid white!important;
       border-radius: 3px;
    }

</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('391a027a8fef2eba4487a00156901156') ?>">Produtos</a></li>
                <li class="breadcrumb-item" aria-current="page">Edição</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b>Edição Produto</b></h2>
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('ffc0caeb59f53fc0c9e40e7d17cf3195');?>" method="post" enctype='multipart/form-data' id="form">
                <input type="hidden" id="id" name="id" value="<?php echo $produto['produto_id'] ?>">
                
                <input type="hidden" id="produto_tamanhos" name="tamanhos">
                
                <input type="hidden" id="produto_cores" name="cores">
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                
                                <ul class="nav nav-tabs">
                                  <li class="tab-li active" id="li_dados" data-target="dados" data-fonte="li_dados"><a>Dados</a></li>
                                  <li class="tab-li" id="li_estoque" data-target="estoque-lista" data-fonte="li_estoque"><a>Estoque</a></li>
                                  <li class="tab-li" id="li_detalhes" data-target="detalhes" data-fonte="li_detalhes"><a>Detalhes</a></li>
                                  <li class="tab-li" id="li_imagens" data-target="imagens" data-fonte="li_imagens"><a>Imagens</a></li>
                                  <li class="tab-li" id="li_promocoes" data-target="promocoes" data-fonte="li_promocoes"><a>Promoções</a></li>
                                  <li class="tab-li" id="li_ligacoes" data-target="ligacoes" data-fonte="li_ligacoes"><a>Ligações</a></li>
                                  <li class="tab-li" id="li_opcoes" data-target="opcoes" data-fonte="li_opcoes"><a>Opções</a></li>
                                </ul>
                                
                                
                                <div id="dados">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;!important">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-6 form-group">
                                            <label><b>Nome do Produto:</b></label>
                                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do Produto" value="<?php echo $produto['produto_nome'] ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Modelo do Produto:</b></label>
                                            <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo do Produto" value="<?php echo $produto['produto_modelo'] ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label><b>Código do Produto:</b></label>
                                            <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código do Produto" value="<?php echo $produto['produto_codigo'] ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Fabricante:</b></label>
                                            <input type="text" id="fabricante" name="fabricante" class="form-control" placeholder="Fabricante" value="<?php echo $produto['produto_fabricante'] ?>">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Habilitado:</b></label><br>
                                            <input type="radio" id="habilitado_1" name="habilitado" value="1" style="display: inline" <?php if($produto['produto_habilitado'] == 1) { echo 'checked'; }  ?>>
                                            &nbsp;<span><b>Sim</b></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="habilitado_2" name="habilitado" value="0" style="display: inline" <?php if($produto['produto_habilitado'] == 0) { echo 'checked'; }  ?>>
                                            &nbsp;<span><b>Não</b></span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <label><b>Unidade de Medida:</b></label>
                                            <select id="medida" name="medida" class="js-example-basic-multiple" style="width: 100%!important">
                                                <option value="m">Metro</option>
                                                <option value="cm" selected>Centímetro</option>
                                                <option value="mm">Milímetro</option>
                                                <option value='"'>Polegadas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Comprimento:</b></label>
                                            <input type="text" id="comprimento" name="comprimento" class="form-control number" placeholder="Comprimento" value="<?php echo $produto['produto_comprimento'] ?>" >
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Largura:</b></label>
                                            <input type="text" id="largura" name="largura" class="form-control number" placeholder="Largura" value="<?php echo $produto['produto_largura'] ?>" >
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Altura:</b></label>
                                            <input type="text" id="altura" name="altura" class="form-control number" placeholder="Altura" value="<?php echo $produto['produto_altura'] ?>" >
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Unidade de Peso:</b></label>
                                            <select id="un_peso" name="un_peso" class="js-example-basic-multiple" style="width: 100%!important">
                                                <option value="kg">Quilograma</option>
                                                <option value="g" selected>Grama</option>
                                                <option value="mg">Miligrama</option>
                                                <option value="lb">Libra</option>
                                                <option value="oz">Onça</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Peso:</b></label>
                                            <input type="text" id="peso" name="peso" class="form-control" placeholder="Peso" value="<?php echo $produto['produto_peso'] ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label><b>SKU:</b></label>
                                            <input type="text" id="sku" name="sku" class="form-control" value="<?php echo $produto['produto_sku'] ?>" placeholder="SKU">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>NCM:</b></label>
                                            <input type="text" id="ncm" name="ncm" class="form-control" value="<?php echo $produto['produto_ncm'] ?>" placeholder="NCM">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>CEST:</b></label>
                                            <input type="text" id="cest" name="cest" class="form-control" value="<?php echo $produto['produto_cest'] ?>" placeholder="CEST">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>UPC:</b></label>
                                            <input type="text" id="upc" name="upc" class="form-control" value="<?php echo $produto['produto_upc'] ?>" placeholder="UPC">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label><b>EAN:</b></label>
                                            <input type="text" id="ean" name="ean" class="form-control" value="<?php echo $produto['produto_ean'] ?>" placeholder="EAN">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>JAN:</b></label>
                                            <input type="text" id="jan" name="jan" class="form-control" value="<?php echo $produto['produto_jan'] ?>" placeholder="JAN">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>ISBN:</b></label>
                                            <input type="text" id="isbn" name="isbn" class="form-control" value="<?php echo $produto['produto_isbn'] ?>" placeholder="ISBN">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>MPN:</b></label>
                                            <input type="text" id="mpn" name="mpn" class="form-control" value="<?php echo $produto['produto_mpn'] ?>" placeholder="MPN">
                                        </div>
                                    </div>
                                    
                                    <br>
                                </div>
                                
                                
                                
                                <div id="estoque-lista" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    
                                    <div class="row mt-2" style="background-color: white; margin-left: 5px; margin-right: 5px">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Loja
                                                    </th>
                                                    <th>
                                                        Qtd.: atual
                                                    </th>
                                                    <th>
                                                        Último estoque
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                   foreach($estoque_lojas as $loja){ ?>
                                                   
                                                   <tr>
                                                       <td>
                                                           <?php echo $loja['nome'] ?>
                                                       </td>
                                                       <td>
                                                           <?php echo $loja['estoque'] ?>
                                                       </td>
                                                       <td>
                                                           <?php echo $loja['ultimo_estoque'] ?>
                                                       </td>
                                                   </tr>
                                                       
                                                   <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <!--<div class="row" style="margin-top: 2%">
                                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                                            <div class="col-md-12">
                                                <div class="c-card-body">
                                                    <div class="table-responsive" style="width: 100%">
                                                        <table class="table c-table" id="tabela2">
                                    				        <thead>
                                    				            <tr>
                                    				                <th>Data</th>
                                    				                <th>ID</th>
                                    				                <th>Loja</th>
                                    				                <th>Estoque</th>
                                    				                <th>Valor</th>
                                    				                <th>Tipo</th>
                                    				             </tr>
                                    				        </thead>
                                    				        <tbody id="estoqueList">
                                    				            <?php foreach($estoques as $est){ ?>
                                    				                <tr id="list<?php echo $est['estoque_id'] ?>">
                                    				                    <td> <?php echo $est['estoque_data'] ?> </td>
                                    				                    <td> <?php echo $est['estoque_id'] ?> </td>
                                    				                    <td> <?php echo $est['estoque_loja'] ?> </td>
                                    				                    <td> <?php echo $est['estoque_quantidade'] ?> </td>
                                    				                    <td> <?php echo "R$ ".number_format($est['estoque_valor'], 2, ',', '.'); ?> </td>
                                    				                    <td> <?php echo $est['estoque_tipo'] ?> </td>
                                    				                </tr>
                                				                <?php } ?>
                                    				        </tbody>
                                				        </table>
                                				    </div>
                                			    </div> 
                            			    </div>
                                        </div>
                                    </div>-->
                                </div>
                                
                                <div id="detalhes" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;!important">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-12 form-group">
                                            <label><b>Detalhes:</b></label>
                                            <div id="editor"><?php echo $produto['produto_detalhes'] ?></div>
                                            <textarea name="desc" id="desc" style="display: none"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div id="imagens" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;!important">
                                    <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" style="margin-top: 1%!important;">
                                                <li class="active-tab2" style="cursor: pointer" onclick="fprincipal()" id="li_principal" ><a>Imagem Principal</a></li>
                                                <li style="cursor: pointer" onclick="fopcionais()" id="li_opcionais" ><a>Imagens Opcionais</a></li>
                                            </ul>
                                            <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0!important; width: 100%">
                                            <div id="principal">
                                                <div class="row" style="margin-top: 2%">
                                                    <div class="col-md-6 form-group" style="text-align:center; position: relative; left: 300px;">
                                                        <label><b>Imagem Principal:</b></label>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url('imagens/produtos/' . $produto['produto_id'] . '.jpg') ?>">
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#imagem').click()">Inserir</button>
                                                        <input type="file" id="imagem" name="imagem" style="display: none">
                                                        <p id="imagem_label" class="label-imagem"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <div id="opcionais" style="display: none;">
                                            <div class="row" style="margin-top: 2%; text-align:center;">
                                                <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 1:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional1'] == null || $produto['produto_imagens_opcional1'] == ""){ ?>
                                                        <button type="button" class="btn btn-primary" style="width: 100%;" onclick="$('#opcional1').click()">Inserir</button>
                                                        <input  class="opcionais" type="file" id="opcional1" name="opcional1" style="display: none">
                                                    <?php }else{ ?>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional1']) ?>">
                                                        <i onclick="excluirImagem(1)" data-toggle="modal" data-target="#statusModal" class="fa fa-times botaoexcluir" aria-hidden="true" style="position: absolute; cursor: pointer; font-size: 20px; color:red;"></i>
                                                        <button type="button" class="btn btn-primary" style="width: 100%;" onclick="$('#opcional1').click()">Inserir</button>
                                                        <input  class="opcionais" type="file" id="opcional1" name="opcional1" style="display: none">
                                                        <p id="opcional1_label" class="label-imagem"></p>
                                                    <?php } ?>   
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 2:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional2'] == null || $produto['produto_imagens_opcional2'] == ""){ ?>
                                                        <button type="button" class="btn btn-primary" style="width: 100%;" onclick="$('#opcional2').click()">Inserir</button>
                                                        <input  class="opcionais" type="file" id="opcional2" name="opcional2" style="display: none">
                                                    <?php }else{ ?>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional2']) ?>">
                                                        <i onclick="excluirImagem(2)" data-toggle="modal" data-target="#statusModal" class="fa fa-times botaoexcluir" aria-hidden="true" style="position: absolute; cursor: pointer; font-size: 20px; color:red;"></i>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional2').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional2" name="opcional2" style="display: none">
                                                        <p id="opcional2_label" class="label-imagem"></p>
                                                    <?php } ?>   
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 3:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional3'] == null || $produto['produto_imagens_opcional3'] == ""){ ?>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional3').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional3" name="opcional3" style="display: none">
                                                    <?php }else{ ?>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional3']) ?>">
                                                        <i onclick="excluirImagem(3)" data-toggle="modal" data-target="#statusModal" class="fa fa-times botaoexcluir" aria-hidden="true" style="position: absolute; cursor: pointer; font-size: 20px; color:red;"></i>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional3').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional3" name="opcional3" style="display: none">
                                                        <p id="opcional3_label" class="label-imagem"></p>
                                                    <?php } ?>   
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 4:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional4'] == null || $produto['produto_imagens_opcional4'] == ""){ ?>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional4').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional4" name="opcional4" style="display: none">
                                                    <?php }else{ ?>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional4']) ?>">
                                                        <i onclick="excluirImagem(4)" data-toggle="modal" data-target="#statusModal" class="fa fa-times botaoexcluir" aria-hidden="true" style="position: absolute; cursor: pointer; font-size: 20px; color:red;"></i>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional4').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional4" name="opcional4" style="display: none">
                                                        <p id="opcional4_label" class="label-imagem"></p>
                                                    <?php } ?>   
                                                </div>
                                                <div class="col-md-4 form-group" style="display: none">
                                                    <label><b>Imagem Opcional 5:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional5'] == null || $produto['produto_imagens_opcional5'] == ""){ ?>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional5').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional5" name="opcional5" style="display: none">
                                                    <?php }else{ ?>
                                                        <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional5']) ?>">
                                                        <i onclick="excluirImagem(5)" data-toggle="modal" data-target="#statusModal" class="fa fa-times botaoexcluir" aria-hidden="true" style="position: absolute; cursor: pointer; font-size: 20px; color:red;"></i>
                                                        <button type="button" class="btn btn-primary" style="width: 100%" onclick="$('#opcional5').click()">Inserir</button>
                                                        <input class="opcionais" type="file" id="opcional5" name="opcional5" style="display: none">
                                                        <p id="opcional5_label" class="label-imagem"></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                
                            <div id="promocoes" style="display: none">
                                <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;!important">
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-2 form-group">
                                        <label><b>Preço promoção:</b></label>
                                        <input type="text" id="preco_promocao" name="preco_promocao" class="form-control money" placeholder="0,00"  value="<?php echo $produto['produto_preco_promocao'] ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Preço ativo:</b></label>
                                        <select onchange="ativopromocao()" id="preco_promocao_ativo" name="preco_promocao_ativo" class="form-control" style="width: 100%!important">
                                            <option value="" selected disabled> Selecione </option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Desconto %:</b></label>
                                        <input type="text" id="desconto" name="desconto" class="form-control" placeholder="0%" value="<?php echo $produto['produto_desconto'] ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Desconto ativo:</b></label>
                                        <select onchange="ativodesconto()" id="desconto_ativo" name="desconto_ativo" class="form-control" style="width: 100%!important">
                                            <option value="" selected disabled> Selecione </option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label><b>Data inicial:</b></label>
                                        <input type="date" id="datainicial_promocao" name="datainicial_promocao" class="form-control" placeholder="Data inicial"  value="<?php echo $produto['produto_datainicial_promocao'] ?>">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Data final:</b></label>
                                        <input type="date" id="datafinal_promocao" name="datafinal_promocao" class="form-control" placeholder="Data final" value="<?php echo $produto['produto_datafinal_promocao'] ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Data final ativo:</b></label>
                                        <select id="datafinal_promocao_ativo" name="datafinal_promocao_ativo" class="form-control" style="width: 100%!important" required>
                                            <option value="" selected disabled> Selecione </option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="height: 1px; border-color: lightgrey">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Cupom de desconto:</b></label>
                                        <input type="text" id="cupom" name="cupom" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" value="<?php echo $produto['produto_cupom'] ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label><b>Cupom ativo:</b></label>
                                        <select id="cupom_ativo" name="cupom_ativo" class="form-control" style="width: 100%!important" required>
                                            <option value="" selected disabled> Selecione </option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>    
                                
                            <div id="ligacoes" style="display: none">
                                <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;!important">
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-4 form-group">
                                        <label><b>Marca:</b></label>
                                        <select id="marca" name="marca" class="js-example-basic-multiple"  style="width: 100%!important;">
                                            <option value="" selected disabled> Selecione </option>
                                            <?php foreach($marcas as $m){?>
                                                <option value="<?php echo $m['marca_id'] ?>"><?php echo $m['marca_nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <button type="button" style="margin-top: 24px;" class="btn btn-primary" data-toggle="modal" data-target="#addMarca">+</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="height: 1px; border-color: lightgrey">
                                        <h4><b>DEPARTAMENTOS</b></h4>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <select id="departamentos" name="departamentos[]" multiple class="js-example-basic-multiple" style="width: 100%!important;">
                                            <?php foreach($departamentos as $d){?>
                                                <option value="<?php echo $d['departamento_id'] ?>"><?php echo $d['departamento_nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="height: 1px; border-color: lightgrey">
                                        <h4><b>PRODUTOS RELACIONADOS</b></h4>
                                    </div>
                                    <div class="col-md-12 form-group">
                                          <select id="relacionados" name="relacionados[]" multiple class="js-example-basic-multiple" style="width: 100%!important;">
                                            <?php foreach($produtos as $p){?>
                                                <option value="<?php echo $p['produto_id'] ?>"><?php echo $p['produto_nome'] ?></option>
                                            <?php } ?>
                                          </select> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="height: 1px; border-color: lightgrey">
                                        <h4><b>VARIAÇÕES</b></h4>
                                    </div>
                                    <div class="col-md-12 form-group">
                                          <select id="variacoes" name="variacoes[]" multiple class="js-example-basic-multiple" style="width: 100%!important;">
                                            <?php foreach($produtos as $p){?>
                                                <option value="<?php echo $p['produto_id'] ?>"><?php echo $p['produto_nome'] ?></option>
                                            <?php } ?>
                                          </select> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <hr style="height: 1px; border-color: lightgrey">
                                        <div class="col-md-3 form-group">
                                            <label><b>Produto específico:</b></label><br>
                                            <input type="radio" id="produto_especifico" name="produto_especifico" value="0" style="display: inline" checked>
                                            &nbsp;<span><b>Não</b></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="produto_especifico" name="produto_especifico" value="1" style="display: inline">
                                            &nbsp;<span><b>Sim</b></span>
                                        </div>
                                        <div class="col-md-9 form-group" id="produto_especificoid" style="display: none">
                                            <label class="text-center" style="color: black;"><b>Loja:</b></label>
                                            <select class="form-control"  name="produto_especificoid">
                                                <option value="" selected disabled> -- Selecione a loja -- </option>
                                                <?php foreach($lojas as $l){ ?>
                                                    <option value="<?php echo $l['id'] ?>"><?php echo $l['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                           <div id="opcoes" style="display: none">
                                <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                <div class="row" style="margin-top: 2%">
                                    <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addOpcao">Adicionar Opção</button>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <h4><b>Opções</b></h4>
                                        <div class="table-responsive" style="width: 100%">
                                            <table class="table c-table" id="tabela">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%">Categoria</th>
                                                        <th style="width: 10%">Nome</th>
                                		                <th class="text-center" style="width: 20%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_opcao">
    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="row">
                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                    &nbsp;&nbsp;
                                    <a href="<?php echo base_url('391a027a8fef2eba4487a00156901156') ?>" style="margin-right: 15px;" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>


<!-- MODAL -->

<div class="modal fade" id="addMarca" tabindex="-1" role="dialog" aria-labelledby="addMarca" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">ADICIONAR MARCA</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label><b>Nome da marca: </b></label>
                        <input type="text" id="nomeMarca" name="nomeMarca" class="form-control" value="" required>
                    </div>    
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="adicionarMarca()">Adicionar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addOpcao" tabindex="-1" role="dialog" aria-labelledby="addMarca" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">ADICIONAR OPÇÃO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label><b>Catégoria: </b></label>
                        <select onchange="addSelected()" id="opcao_categoria" class="form-control" required>
                            <option disabled selected>Selecione</option>
                            <option>Tamanho</option>
                            <option>Cor</option>
                        </select>
                    </div>   
                    <div class="col-md-10 form-group">
                        <label><b>Nome: </b></label>
                        <select id="opcao_nome" class="form-control">
                            <option disabled selected> Selecione a Categória</option>
                            
                        </select>
                    </div> 
                    <div class="col-md-2 form-group">
                        <label>&nbsp;</label><br>
                        <button class="btn btn-primary" onclick="dinamicoNova()">+</button>
                    </div>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addOpcao()">Adicionar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addNova" tabindex="-1" role="dialog" aria-labelledby="marca_adicionarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">NOVA OPÇÃO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

          <div class="modal-body">
              <div class="row">
                 <div class="col-md-12 form-group">
                    <label><b>Categória: </b></label>
                    <select class="form-control" id="nova_categoria">
                        <option value="" selected disabled> Selecione </option>
                        <option value="Cor">Cor</option>
                        <option value="Tamanho">Tamanho</option>
                    </select>
                 </div>    
             </div>
            <div class="row">
                 <div class="col-md-12 form-group">
                    <label><b>Nome: </b></label>
                    <input type="text" id="nova_nome" class="form-control" value="" required>
                 </div>    
             </div>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addNova()">Adicionar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>

    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="statusModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1a8737;">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b> Deseja excluir a imagem? </b><p>
      </div>
      <div class="modal-footer">
        <form action="<?php echo base_url('admin/adminprodutos/excluirImagem') ?>" method="post">
            <input type="hidden" name="excluirimagem" id="excluirimagem">
            <input type="hidden" name="idproduto" id="idproduto" value="<?php echo $produto['produto_id'] ?>">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL - CADASTRAR -->
<div class="modal fade" id="estoque-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black">
                <h3 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">Estoque Lojas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 18px; color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="data1" name="data1">
            <input type="hidden" id="produto_id" name="produto_id" value="<?php echo $produto['produto_id'] ?>">
            <div class="row" style="padding-left: 2%; padding-top: 3%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Tipo:</b></label>
                    <select class="form-control" id="tipo_estoque_cad" name="tipo_estoque_cad" data-live-search="true" onclick="ajuste()">
                        <option value="Entrada estoque" class="form-control"> Entrada estoque </option>
                        <option value="Ajuste estoque" class="form-control">  Ajuste estoque </option>
                        <option value="Perda" class="form-control">  Perda </option>
                        <option value="Garantia" class="form-control">  Garantia </option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Loja:</b></label>
                    <select class="form-control" style="width: 99%;" id="loja_estoque_cad" name="loja_estoque_cad" data-live-search="true">
                        <option class="form-control" disabled selected> --Selecione a loja-- </option>
                        <?php foreach($lojas as $lj) { ?>
                            <option value="<?php echo $lj['id'] ?>"> <?php echo $lj['nome'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Quantidade:</b></label>
                    <input type="text" id="quantidade_estoque_cad" name="quantidade_estoque_cad" class="form-control" placeholder="0">
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Valor:</b></label>
                    <input type="text" id="valor_estoque_cad" name="valor_estoque_cad"class="form-control money" placeholder="0,00">
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%; display: none" id="detalhe-div-cad">
                <div class="col-md-12 form-group">
                    <label><b>Detalhes:</b></label>
                    <textarea class="form-control" id="detalhe-cad" name="detalhe-cad"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="validainput()">Gravar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - VISUALIZAR -->
<div class="modal fade" id="estoque-read-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black">
                <h3 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">Visualizar Estoque</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 18px; color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row" style="padding-left: 2%; padding-top: 3%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6">
                  <label><b>Tipo:</b></label>
                  <input id="tipo_estoque_ver" name="tipo_estoque_ver" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label><b>Loja:</b></label>
                    <input id="loja_estoque_ver" name="loja_estoque_ver" class="form-control" readonly>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Estoque do produto:</b></label>
                    <input type="text" id="quantidade_estoque_ver" name="quantidade_estoque_ver" class="form-control number" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Valor:</b></label>
                    <input type="text" id="valor_estoque_ver" name="valor_estoque_ver" class="form-control number" readonly>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%; display: none" id="detalhe-div-ver">
                <div class="col-md-12 form-group">
                    <label><b>Detalhes:</b></label>
                    <textarea class="form-control" id="detalhe-ver" name="detalhe-ver" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" data-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - EDITAR -->
<div class="modal fade" id="estoque-edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black">
                <h3 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">Editar Estoque</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 18px; color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="id_estoque" name="id_estoque">
            <input type="hidden" id="data2" name="data2">
            <div class="row" style="padding-left: 2%; padding-top: 3%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6">
                    <label><b>Tipo:</b></label>
                    <select class="form-control" id="tipo_estoque_edit" name="tipo_estoque_edit" data-live-search="true" onclick="ajuste2()">
                        <option value="Entrada estoque" class="form-control"> Entrada estoque </option>
                        <option value="Ajuste estoque" class="form-control">  Ajuste estoque </option>
                        <option value="Perda" class="form-control">  Perda </option>
                        <option value="Garantia" class="form-control">  Garantia </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><b>Loja:</b></label>
                    <select class="form-control" style="width: 99%;" id="loja_estoque_edit" name="loja_estoque_edit" data-live-search="true">
                        <?php foreach($lojas as $lj){ ?>
                            <option value="<?php echo $lj['nome'] ?>" class="form-control"><?php echo $lj['nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Estoque atual:</b></label>
                    <input type="text" id="qtd_estoque_edit" name="qtd_estoque_edit" class="form-control number" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Adicionar:</b></label>
                    <input type="text" class="form-control number" id="add_estoque_edit" name="add_estoque_edit" value="0">
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Valor atual:</b></label>
                    <input type="text" class="form-control" id="valoratual_estoque_edit" name="valoratual_estoque_edit" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Novo valor:</b></label>
                    <input type="text" class="form-control money" id="novovalor_estoque_edit" name="novovalor_estoque_edit" value="0,00">
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%; display: none" id="detalhe-div-edit">
                <div class="col-md-12 form-group">
                    <label><b>Detalhes:</b></label>
                    <textarea class="form-control" id="detalhe-edit" name="detalhe-edit"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="validainput2()">Gravar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - EXCLUIR -->
<div class="modal" tabindex="-1" role="dialog" id="excluir-estoque">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1b9045">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b> Deseja excluir o Estoque? </b><p>
      </div>
      <div class="modal-footer">
            <input type="hidden" id="estoque-excluir" name="estoque-excluir">
            <button type="button" class="btn btn-primary" onclick="excluirestoque()">Excluir</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<style>
    .ql-snow .ql-picker.ql-size .ql-picker-label::before { content: attr(data-value)!important; }
    .ql-snow .ql-picker.ql-size .ql-picker-item::before { font-size: attr(data-value)!important; content: attr(data-value)!important; }
    .ql-picker-label .custom-content::before { content: attr(data-value)!important; }
    #editor{
        min-height: 300px;
    }
</style>

<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<script type="application/javascript">
    $(document).ready(function(){
        
        $('#addOpcao').on('hidden.bs.modal', function (e) {
          $(this)
            .find("input,textarea,select")
               .val('')
               .end()
            .find("input[type=checkbox], input[type=radio]")
               .prop("checked", "")
               .end();
        })
        
        
        $('.js-example-basic-multiple').select2({theme: "bootstrap"});
        $('.money').mask("#.##0,00", {reverse: true});
        
        <?php if($produto['produto_un_medida']) { ?>
            $('#medida').val('<?php echo $produto['produto_un_medida'] ?>').change();
        <?php } ?>
        
        <?php if($produto['produto_un_peso']) { ?>
            $('#un_peso').val('<?php echo $produto['produto_un_peso'] ?>').change();
        <?php } ?>
        
        <?php if($produto['produto_preco_promocao_ativo'] != null) { ?>
            $('#preco_promocao_ativo').val(<?php echo $produto['produto_preco_promocao_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_desconto_ativo'] != null) { ?>
            $('#desconto_ativo').val(<?php echo $produto['produto_desconto_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_datafinal_promocao_ativo'] != null) { ?>
            $('#datafinal_promocao_ativo').val('<?php echo $produto['produto_datafinal_promocao_ativo'] ?>').change();
        <?php } ?>
       
       <?php if($produto['produto_cupom_ativo'] != null) { ?>
            $('#cupom_ativo').val(<?php echo $produto['produto_cupom_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_marca_id']) { ?>
            $('#marca').val(<?php echo $produto['produto_marca_id'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_departamentos']){ ?>
            <?php $aux = explode('¬', $produto['produto_departamentos']); ?>
            <?php foreach($aux as $a){ ?>
                $("#departamentos option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
            <?php } ?>
        <?php } ?>
        
        <?php if($produto['produto_relacionados']){ ?>
            <?php $aux = explode('¬', $produto['produto_relacionados']); ?>
            <?php foreach($aux as $a){ ?>
                $("#relacionados option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
            <?php } ?>
        <?php } ?>
        
        <?php if($produto['produto_variacoes']){ ?>
            <?php $aux = explode('¬', $produto['produto_variacoes']); ?>
            <?php foreach($aux as $a){ ?>
                $("#variacoes option[value='" + '<?php echo $a ?>' + "']").prop("selected", true);
            <?php } ?>
        <?php } ?>
        
        <?php if($produto['produto_tamanhos']){ ?>
            <?php $aux = explode('¬', $produto['produto_tamanhos']); ?>
            <?php foreach($aux as $a){ ?>
                <?php $aux2 = explode('&', $a) ?>
                addOpcaoEditar('Tamanho', '<?php echo $aux2[0] ?>', <?php echo $aux2[1] ?>);
            <?php } ?>
        <?php } ?>

        <?php if($produto['produto_cores']){ ?>
            <?php $aux = explode('¬', $produto['produto_cores']); ?>
            <?php foreach($aux as $a){ ?>
                <?php $aux2 = explode('&', $a) ?>
                addOpcaoEditar('Cor', '<?php echo $aux2[0] ?>', <?php echo $aux2[1] ?>);
            <?php } ?>
        <?php } ?>
        
        
        
        $('.ql-picker-item').each( function(){
            if($(this).data('value') == "14px"){
                $(this).click();
            }
        });
        
        var data = new Date();
        var dia     = data.getDate();           // 1-31
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano     = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        
        $('#data1').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
        $('#data2').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
    });
</script>

<script>
    const sizes = ['10px', '12px', '14px', '16px', '18px', '20px', '22px', '24px'];
    
    var Size = Quill.import('attributors/style/size');
    Size.whitelist = sizes;
    Quill.register(Size, true);
    
    var toolbarOptions = [
        [{ 'size': sizes }],
        [{ 'font': [] }],
        
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        
        [{ 'color': [] }, { 'background': [] }],
        
        [{ 'align': [] }],
        
        ['clean']
    ];
    
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    $('.ql-picker-item').click(function(){
        $('.ql-picker-label').addClass('custom-content').attr('data-content', $(this).data('value'));
    });
</script>

<script>
    $(".tab-li").click(function(){
        $(".tab-li").each(function(){
            var tg = $(this).data('target');
            var ft = $(this).data('fonte');
            
            $('#'+tg).hide();
            $('#'+ft).removeClass('active');
        });
        
        var tg = $(this).data('target');
        var ft = $(this).data('fonte');
        
        $('#'+tg).show();
        $('#'+ft).addClass('active');
    });
    
    $('#imagem').on('change', function(){
        if($(this).val() != ""){
            var fullPath = $('#imagem').val();
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#imagem_label').css('display', 'block').html('Selecionado: '+filename);
        }else{
            $('#imagem_label').css('display', 'none');
        }
    });
    
    $('.opcionais').on('change', function(){
        if($(this).val() != ""){
            var numFiles = $(this).get(0).files.length;
            if(parseInt(numFiles) == 1){
                var fullPath = $(this).val();
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var frase = fullPath.substring(startIndex);
                if (frase.indexOf('\\') === 0 || frase.indexOf('/') === 0) {
                    frase = frase.substring(1);
                }
                frase = "Selecionado: "+frase;
            }else{
                var frase = 'Selecionados: '+numFiles+' itens';
            }
            $(this).next().css('display', 'block').html(frase);
        }else{
            $(this).next().css('display', 'none');
        }
    });
    
    $('#form').submit(function(e){
        
        desc = $("#editor .ql-editor").html().replace('<span class="ql-cursor">﻿</span>', '');
        
        $('#desc').html(desc);
    });
</script>



<script>
    function ativopromocao(){
        if($('#preco_promocao_ativo').val() == 1){
            if($('#desconto_ativo').val() == 1){
                $('#desconto_ativo').val(0).change();
            }
        }
    }
    
</script>

<script>
    function ativodesconto(){
        if($('#desconto_ativo').val() == 1){
            if($('#preco_promocao_ativo').val() == 1){
                $('#preco_promocao_ativo').val(0).change();
            }
        }
    }
</script>

<script>
    function fprincipal(){
        $('#opcionais').hide();
        $('#principal').show();
        $('#li_opcionais').removeClass("active-tab2");
        $('#li_principal').addClass("active-tab2");
    }
</script>

<script>
    function fopcionais(){
        $('#opcionais').show();
        $('#principal').hide();
        $('#li_principal').removeClass("active-tab2");
        $('#li_opcionais').addClass("active-tab2");
    }
</script>

<script>
    function excluirImagem(id){
        $('#excluirimagem').val(id);
    }
    
</script>

<script>
    function adicionarMarca(){
        dados = new FormData();
        dados.append('nome', $('#nomeMarca').val());
        $.ajax({
            url: '<?php echo base_url('admin/adminmarcas/dinamicoAdicionarMarca'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                var option = "<option value='"+data.id+"'>" + data.nome + "</option>";
                $('#marca').append(option);
                $('#addMarca').modal('hide');
                $('#marca').focus();
            },
        }); 
    }
</script>

<script>
    function swalPronto(tipo, mensagem){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: tipo,
            title: mensagem,
        })
    }
</script>

<script>
    function addOpcaoEditar(categoria, nome , estoque){
        if(verificarExistente(categoria, nome)){
            var opcao = "<tr class='opcoes_"+categoria+"' id='op_"+nome+"'>"+
                "<td>"+categoria+"</td>"+
                "<td class='op_nome'>"+nome+"</td>"+
                "<td><i style='color: red; font-size: 25px; cursor: pointer;' onclick='removerOp(this)' class='fa fa-times' aria-hidden='true'></i></td>"+
            "</tr>";
            $('#table_opcao').append(opcao);
        }
        $('#addOpcao').modal('hide');
        montaArray();
    }

    function addOpcao(){
        var categoria   = $('#opcao_categoria').val();
        var nome        = $('#opcao_nome').val();
        
        if(categoria != "" && categoria != " " && categoria != null){
            if(nome != "" && nome != " " && nome != null){
                    if(verificarExistente(categoria, nome)){
                        var opcao = "<tr class='opcoes_"+categoria+"' id='op_"+nome+"'>"+
                            "<td>"+categoria+"</td>"+
                            "<td class='op_nome'>"+nome+"</td>"+
                            "<td><i style='color: red; font-size: 25px; cursor: pointer;' onclick='removerOp(this)' class='fa fa-times' aria-hidden='true'></i></td>"+
                        "</tr>";
                        $('#table_opcao').append(opcao);
                    }
                    $('#addOpcao').modal('hide');
                    montaArray();
            } else {
                $('#opcao_nome').focus();
                swalPronto('error', 'Selecione o nome!');
            }
        } else {
            $('#opcao_categoria').focus();
            swalPronto('error', 'Selecione uma categoria!');
        }
    }
    
    function verificarExistente(categoria, nome){
        var qtd = $('#opcao_estoque').val();
        var boolean = true;
        
        $('.op_nome').each(function(){
            if($(this).html() == nome){
                if($(this).parent().children().first().html() == categoria){
                    var estoque = $(this).next().html();

                    var calc = parseInt(estoque) + parseInt(qtd);
                    
                    $(this).next().html(calc);
                    
                    boolean = false;
                }
            } 
        });
        
        return boolean;
    }
</script>


<script>
    function removerOp(id){
        $(id).parent().parent().remove();
        
        montaArray();
    }
</script>

<script>
    function montaArray(){
        var tamanhos = "";
        $('.opcoes_Tamanho').each(function(){
            if(tamanhos == ""){
                tamanhos = $(this).children().next().html();
            } else {
                tamanhos = tamanhos + '¬' + $(this).children().next().html();
            }
        });
        var cores = "";
        $('.opcoes_Cor').each(function(){
            if(cores == ""){
                cores = $(this).children().next().html();
            } else {
                cores = cores + '¬' + $(this).children().next().html();
            }
        });
        $('#produto_tamanhos').val(tamanhos);
        $('#produto_cores').val(cores);
    }
</script>

<script>
    function addSelected(){
        dados = new FormData();
        dados.append('categoria', $('#opcao_categoria').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminopcoes/dinamicoAdicionarSelected'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                $('#opcao_nome').empty();
                
                var option = "<option value='' disabledselected> Selecione </option>";
                $('#opcao_nome').append(option);
                
                for(var i = 0; i < data.length;i++){
                    var option = "<option value='"+data[i].opcao_nome+"'>" + data[i].opcao_nome + "</option>";
                    $('#opcao_nome').append(option);
                }
            },
        }); 
    }
</script>

<script>
    function dinamicoNova(){
        $('#addNova').modal('show');
        $('#addOpcao').modal('hide');
    }

    function addNova(){
        if($('#nova_categoria').val() != "" && $('#nova_categoria').val() != " " && $('#nova_categoria').val() != null){
            if($('#nova_nome').val() != "" && $('#nova_nome').val() != " " && $('#nova_nome').val() != null){
                dados = new FormData();
                dados.append('nome', $('#nova_nome').val());
                dados.append('categoria', $('#nova_categoria').val());
                
                $.ajax({
                    url: '<?php echo base_url('admin/adminopcoes/dinamicoAdicionarOpcao'); ?>',
                    method: 'post',
                    data: dados,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error: function(xhr, status, error) {
                      var err = eval("(" + xhr.responseText + ")");
                      alert(err.Message);
                    },
                    success: function(data) {
                        if(data.categoria == $('#opcao_categoria').val()){
                            var option = "<option value='"+data.nome+"'>" + data.nome + "</option>";
                            $('#opcao_nome').append(option);
                        }
                        
                        $('#addNova').modal('hide');
                        $('#addOpcao').modal('show');
                        
                        swalPronto('success', 'Opção criada com sucesso!');
                    },
                });
            } else {
                $('#nova_nome').focus();
                swalPronto('error', 'Digite o nome!');
            }
        } else {
            $('#nova_categoria').focus();
            swalPronto('error', 'Selecione a categoria!');
        }
    }
</script>

<script>
    function estoque(id){
        var dados = new FormData();
        dados.append('estoque', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/getestoqueid'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#tipo_estoque_ver').val(data.estoque_tipo);
                $('#loja_estoque_ver').val(data.estoque_loja);
                $('#quantidade_estoque_ver').val(data.estoque_quantidade);
                $('#valor_estoque_ver').val(data.estoque_valor);
                $('#detalhe-ver').val(data.estoque_desc);
                
                $('#id_estoque').val(data.estoque_id);
                $('#tipo_estoque_edit').val(data.estoque_tipo);
                $('#loja_estoque_edit').val(data.estoque_loja);
                $('#qtd_estoque_edit').val(data.estoque_quantidade);
                $('#valoratual_estoque_edit').val(data.estoque_valor);
                $('#detalhe-edit').val(data.estoque_desc);
                
                $('#produto_especifico').val(data.produto_especifico);
                $('#produto_especificoid').val(data.produto_idloja);
                
                $('#estoque-excluir').val(data.estoque_id);
                
                if(data.estoque_tipo == "Ajuste estoque"){ 
                    $('#detalhe-div-cad').css("display", "block");
                    $('#detalhe-div-ver').css("display", "block");
                    $('#detalhe-div-edit').css("display", "block");
                }else{
                    $('#detalhe-div-cad').css("display", "none");
                    $('#detalhe-div-ver').css("display", "none");
                    $('#detalhe-div-edit').css("display", "none");
                }
            },
        });
    }
</script>

<script>
    $("input[type=radio][name=produto_especifico]").on('change', function () {
    var radVal = $(this).val();
    if (radVal == '0') {
        $("#produto_especificoid").css("display", "none");
        $('#produto_especificoid').val(null);
    } else if (radVal == '1') {
        $("#produto_especificoid").css("display", "block");
    }
});
</script>

<script>
    function adicionarEstoque(){
        dados = new FormData();
        dados.append('produto', $('#produto_id').val());
        dados.append('data', $('#data1').val());
        dados.append('tipo', $('#tipo_estoque_cad').val());
        dados.append('loja', $('#loja_estoque_cad').val());
        dados.append('quantidade', $('#quantidade_estoque_cad').val());
        dados.append('valor', $('#valor_estoque_cad').val());
        dados.append('desc', $('#detalhe-cad').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodaddestoque'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var lista ="<tr id='list"+data.estoque_id+"'>"+
                            "<td>"+data.estoque_data+"</td>"+
                            "<td>"+data.estoque_id+"</td>"+
                            "<td>"+data.estoque_loja+"</td>"+
                            "<td>"+data.estoque_quantidade+"</td>"+
                            "<td>"+new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(data.estoque_valor)+"</td>"+
                            "<td>"+data.estoque_tipo+"</td>"+
                            "<td style='font-size: 22px!important'>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-read-modal' onclick='estoque("+data.estoque_id+")'><i class='fa fa-eye' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-edit-modal' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px;' class='fa fa-pencil' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#excluir-estoque' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px; color: #1b9045;' class='fa fa-trash' aria-hidden='true'></i></a>"+
                            "</td>" +
                            "<tr>";
                $('#estoqueList').append(lista);
                $('#estoque-modal').modal('hide');
                
            },
        }); 
    }
</script>

<script>
    function editestoque(){
        dados = new FormData();
        dados.append('id', $('#id_estoque').val());
        dados.append('data', $('#data2').val());
        dados.append('tipo', $('#tipo_estoque_edit').val());
        dados.append('loja', $('#loja_estoque_edit').val());
        dados.append('quantidade', $('#qtd_estoque_edit').val());
        dados.append('addqtd', $('#add_estoque_edit').val());
        dados.append('valor', $('#valoratual_estoque_edit').val());
        dados.append('novovalor', $('#novovalor_estoque_edit').val());
        dados.append('desc', $('#detalhe-edit').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodeditaestoque'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var listatroca = document.getElementById('list'+data.estoque_id);
                listatroca.remove();
                
                var lista = "<tr id='list"+data.estoque_id+"'>"+
                            "<td>"+data.estoque_data+"</td>"+
                            "<td>"+data.estoque_id+"</td>"+
                            "<td>"+data.estoque_loja+"</td>"+
                            "<td>"+data.estoque_quantidade+"</td>"+
                            "<td>"+new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(data.estoque_valor)+"</td>"+
                            "<td>"+data.estoque_tipo+"</td>"+
                            "<td style='font-size: 22px!important'>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-read-modal' onclick='estoque("+data.estoque_id+")'><i class='fa fa-eye' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-edit-modal' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px;' class='fa fa-pencil' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#excluir-estoque' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px; color: #1b9045;' class='fa fa-trash' aria-hidden='true'></i></a>"+
                            "</td>" +
                            "<tr>";
                
                $('#estoqueList').append(lista);
                $('#estoque-edit-modal').modal('hide');
            }
        });
    }
</script>

<script>
    function excluirestoque(){
        dados = new FormData();
        dados.append('id', $('#estoque-excluir').val());
        var aux = $('#estoque-excluir').val();
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodexcestoque'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var excluido = document.getElementById('list'+aux);
                excluido.remove();
                
                $('#excluir-estoque').modal('hide');
            }
        });
    }
</script>

<script>
    function ajuste(){
        var aux = document.getElementById('tipo_estoque_cad').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-cad').css("display", "block");
        }else{
            $('#detalhe-div-cad').css("display", "none");
        }
    }
    
    function ajuste2(){
        var aux = document.getElementById('tipo_estoque_edit').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-edit').css("display", "block");
        }else{
            $('#detalhe-div-edit').css("display", "none");
        }
    }
</script>

<script>
    function validainput(){
        
        var value1 = $('#valor_estoque_cad').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valor_estoque_cad').value = clean1;
        
        adicionarEstoque();
        
    }
    
    function validainput2(){
        
        var value1 = $('#valoratual_estoque_edit').val();
        var value2 = $('#novovalor_estoque_edit').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        var clean2 = parseFloat(value2.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valoratual_estoque_edit').value = clean1;
        document.getElementById('novovalor_estoque_edit').value = clean2;
        
        editestoque();
        
    }
</script>