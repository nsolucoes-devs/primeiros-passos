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
    
    #select2-produtos2-container{
        height: 50px!important;
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
                <li class="breadcrumb-item" aria-current="page">Visualizar</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Visualizar Produto</b></h2>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('391a027a8fef2eba4487a00156901156') ?>"><i style="margin-top: 10px; border: 1px solid #1b9045; padding: 7px; border-radius: 5px; background-color: #1b9045; font-size: 17px; color: white" class="fa fa-reply" aria-hidden="true">VOLTAR</i></a>
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('ffc0caeb59f53fc0c9e40e7d17cf3195');?>" method="post" enctype='multipart/form-data' id="form">
                <input type="hidden" id="id" name="id" value="<?php echo $produto['produto_id'] ?>">
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
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-6 form-group">
                                            <label><b>Nome do Produto:</b></label>
                                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do Produto" value="<?php echo $produto['produto_nome'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Modelo do Produto:</b></label>
                                            <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo do Produto" value="<?php echo $produto['produto_modelo'] ?>"  readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label><b>Código do Produto:</b></label>
                                            <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código do Produto" value="<?php echo $produto['produto_codigo'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><b>Fabricante:</b></label>
                                            <input type="text" id="fabricante" name="fabricante" class="form-control" placeholder="Fabricante" value="<?php echo $produto['produto_fabricante'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Habilitado:</b></label><br>
                                            <input type="radio" id="habilitado_1" name="habilitado" value="HABILITADO" style="display: inline" <?php if($produto['produto_habilitado'] == '1') { echo 'checked'; }  ?>  disabled>
                                            &nbsp;<span><b>Sim</b></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="habilitado_2" name="habilitado" value="DESABILITADO" style="display: inline" <?php if($produto['produto_habilitado'] == '0') { echo 'checked'; }  ?>  disabled>
                                            &nbsp;<span><b>Não</b></span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <label><b>Unidade de Medida:</b></label>
                                            <select id="medida" name="medida" class="js-example-basic-multiple" style="width: 100%!important" disabled>
                                                <option value="m">Metro</option>
                                                <option value="cm" selected>Centímetro</option>
                                                <option value="mm">Milímetro</option>
                                                <option value='"'>Polegadas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Comprimento:</b></label>
                                            <input type="text" id="comprimento" name="comprimento" class="form-control number" placeholder="Comprimento" value="<?php echo $produto['produto_comprimento'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Largura:</b></label>
                                            <input type="text" id="largura" name="largura" class="form-control number" placeholder="Largura" value="<?php echo $produto['produto_largura'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Altura:</b></label>
                                            <input type="text" id="altura" name="altura" class="form-control number" placeholder="Altura" value="<?php echo $produto['produto_altura'] ?>"  readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Unidade de Peso:</b></label>
                                            <select id="un_peso" name="un_peso" class="js-example-basic-multiple" style="width: 100%!important" disabled>
                                                <option value="kg">Quilograma</option>
                                                <option value="g" selected>Grama</option>
                                                <option value="mg">Miligrama</option>
                                                <option value="lb">Libra</option>
                                                <option value="oz">Onça</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Peso:</b></label>
                                            <input type="text" id="peso" name="peso" class="form-control" placeholder="Peso" value="<?php echo $produto['produto_peso'] ?>"  readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label><b>SKU:</b></label>
                                            <input type="text" id="sku" name="sku" class="form-control" value="<?php echo $produto['produto_sku'] ?>" placeholder="SKU" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>NCM:</b></label>
                                            <input type="text" id="ncm" name="ncm" class="form-control" value="<?php echo $produto['produto_ncm'] ?>" placeholder="NCM" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>CEST:</b></label>
                                            <input type="text" id="cest" name="cest" class="form-control" value="<?php echo $produto['produto_cest'] ?>" placeholder="CEST" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>UPC:</b></label>
                                            <input type="text" id="upc" name="upc" class="form-control" value="<?php echo $produto['produto_upc'] ?>" placeholder="UPC" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label><b>EAN:</b></label>
                                            <input type="text" id="ean" name="ean" class="form-control" value="<?php echo $produto['produto_ean'] ?>" placeholder="EAN" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>JAN:</b></label>
                                            <input type="text" id="jan" name="jan" class="form-control" value="<?php echo $produto['produto_jan'] ?>" placeholder="JAN" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>ISBN:</b></label>
                                            <input type="text" id="isbn" name="isbn" class="form-control" value="<?php echo $produto['produto_isbn'] ?>" placeholder="ISBN" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>MPN:</b></label>
                                            <input type="text" id="mpn" name="mpn" class="form-control" value="<?php echo $produto['produto_mpn'] ?>" placeholder="MPN" readonly>
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
                                        				                <th style="width: 20%;">Ações</th>
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
                                        				                    <td style="font-size: 22px!important">
                                                			                    <a style="color: #1b9045;" data-toggle="modal" data-target="#estoque-read-modal" onclick="estoque(<?php echo $est['estoque_id'] ?>)"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                			                    <a style="color: #1b9045;" data-toggle="modal" data-target="#estoque-edit-modal" onclick="estoque(<?php echo $est['estoque_id'] ?>)"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
                                                			                    <a style="color: #1b9045;" data-toggle="modal" data-target="#excluir-estoque" onclick="estoque(<?php echo $est['estoque_id'] ?>)"><i style="padding-left: 12px; color: #1b9045;" class="fa fa-trash" aria-hidden="true"></i></a>
                                                			                </td>
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
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-12 form-group">
                                            <label><b>Detalhes:</b></label>
                                            <?php echo $produto['produto_detalhes'] ?>
                                            <textarea name="desc" id="desc" style="display: none" readonly></textarea>
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
                                                <input type="file" id="imagem" name="imagem" style="display: none">
                                                <p id="imagem_label" class="label-imagem"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="opcionais" style="display: none;">
                                        <div class="row" style="margin-top: 2%; text-align:center;">
                                            <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 1:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional1'] != null || $produto['produto_imagens_opcional1'] != ""){ ?>
                                                    <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional1']) ?>">
                                                    <input type="file" id="imagemopc1" name="imagemopc1" style="display: none">
                                                    <p id="opcional1_label" class="label-imagem"></p>
                                                    <?php } ?>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 2:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional2'] != null || $produto['produto_imagens_opcional2'] != ""){ ?>
                                                    <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional2']) ?>">
                                                    <input type="file" id="imagemopc2" name="imagemopc2" style="display: none">
                                                    <p id="opcional2_label" class="label-imagem"></p>
                                                    <?php } ?>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 3:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional3'] != null || $produto['produto_imagens_opcional3'] != ""){ ?>
                                                    <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional3']) ?>">
                                                    <input type="file" id="imagemopc3" name="imagemopc3" style="display: none">
                                                    <p id="opcional3_label" class="label-imagem"></p>
                                                    <?php } ?>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                    <label><b>Imagem Opcional 4:</b></label>
                                                    <?php if ($produto['produto_imagens_opcional4'] != null || $produto['produto_imagens_opcional4'] != ""){ ?>
                                                    <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional4']) ?>">
                                                    <input type="file" id="imagemopc4" name="imagemopc4" style="display: none">
                                                    <p id="opcional4_label" class="label-imagem"></p>
                                                    <?php } ?>
                                            </div>
                                            <div class="col-md-4 form-group" style="display: none">
                                                <label><b>Imagem Opcional 5:</b></label>
                                                <?php if ($produto['produto_imagens_opcional5'] != null || $produto['produto_imagens_opcional5'] != ""){ ?>
                                                <img style="width: 180px; height: 180px" src="<?php echo base_url($produto['produto_imagens_opcional5']) ?>">
                                                <input type="file" id="imagemopc5" name="imagemopc5" style="display: none">
                                                <p id="opcional5_label" class="label-imagem"></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                                
                                <div id="promocoes" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-2 form-group">
                                            <label><b>Preço promoção:</b></label>
                                            <input type="text" id="preco_promocao" name="preco_promocao" class="form-control money" placeholder="0,00" readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Preço ativo:</b></label>
                                            <select id="preco_promocao_ativo" name="preco_promocao_ativo" class="form-control" disabled>
                                                <option value="" selected disabled> Selecione </option>
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Desconto %:</b></label>
                                            <input type="text" id="desconto" name="desconto" class="form-control" placeholder="0%" readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Desconto ativo:</b></label>
                                            <select id="desconto_ativo" name="desconto_ativo" class="form-control" disabled>
                                                <option value="" selected disabled> Selecione </option>
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label><b>Data inicial:</b></label>
                                            <input type="date" id="datainicial_promocao" name="datainicial_promocao" class="form-control" placeholder="Data inicial" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label><b>Data final:</b></label>
                                            <input type="date" id="datafinal_promocao" name="datafinal_promocao" class="form-control" placeholder="Data final" readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Data final ativo:</b></label>
                                            <select id="datafinal_promocao_ativo" name="datafinal_promocao_ativo" class="form-control" disabled>
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
                                            <input type="text" id="cupom" name="cupom" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" readonly>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label><b>Cupom ativo:</b></label>
                                            <select id="cupom_ativo" name="cupom_ativo" class="js-example-basic-multiple" style="width: 100%!important" disabled>
                                                <option value="" selected disabled> Selecione </option>
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>    
                                    
                                    
                                    
                                    
                                    
                                <div id="ligacoes" style="display: none">
                                    <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                    <div class="row" style="margin-top: 2%">
                                        <div class="col-md-4 form-group">
                                            <label><b>Marca:</b></label>
                                            <select id="marca" name="marca" class="js-example-basic-multiple"  style="width: 100%!important;" disabled>
                                                <option value="" selected disabled> Selecione </option>
                                                <?php foreach($marcas as $m){?>
                                                    <option value="<?php echo $m['marca_id'] ?>"><?php echo $m['marca_nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr style="height: 1px; border-color: lightgrey">
                                            <h4><b>DEPARTAMENTOS</b></h4>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select id="departamentos" name="departamentos[]" multiple class="js-example-basic-multiple" style="width: 100%!important;" disabled>
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
                                              <select id="relacionados" name="relacionados[]" multiple class="js-example-basic-multiple" style="width: 100%!important;" disabled>
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
                                              <select id="variacoes" name="variacoes[]" multiple class="js-example-basic-multiple" style="width: 100%!important;" disabled>
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
                                                <input type="radio" id="produto_especifico" name="produto_especifico" value="0" style="display: inline" disabled>
                                                &nbsp;<span><b>Não</b></span>
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="produto_especifico" name="produto_especifico" value="1" style="display: inline" disabled>
                                                &nbsp;<span><b>Sim</b></span>
                                            </div>
                                            <div class="col-md-9 form-group" id="produto_especificoid" style="display: block">
                                                <label class="text-center" style="color: black;"><b>Loja:</b></label>
                                                <select class="form-control" name="produto_especificoid" disabled>
                                                    <option value="" disabled> ---- Nenhuma ---- </option>
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
                                        <h4><b>Opções</b></h4>
                                        <div class="table-responsive" style="width: 100%">
                                            <table class="table c-table" id="tabela">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%">Categória</th>
                                                        <th style="width: 10%">Nome</th>
                                		                <th style="width: 10%">Estoque</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_opcao">
    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="text-align:center;">
                                <div class="col-md-12 form-group">
                                    
                                </div>
                            </div>
                                
                            </div>
                        </div>
                    </div>
                                
                </div>
            </form>
        </div>
    </section>
</section>


<script type="application/javascript">
    $(document).ready(function(){

        $('.js-example-basic-multiple').select2({theme: "bootstrap"});
        $('.money').mask("#.##0,00", {reverse: true});
        
        <?php if($produto['produto_un_medida']){ ?>
            $('#medida').val('<?php echo $produto['produto_un_medida'] ?>').change();
        <?php } ?>
        
        <?php if($produto['produto_un_peso']){ ?>
            $('#un_peso').val('<?php echo $produto['produto_un_peso'] ?>').change();
        <?php } ?>
        
        <?php if($produto['produto_preco_promocao_ativo'] != null){ ?>
            $('#preco_promocao_ativo').val(<?php echo $produto['produto_preco_promocao_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_desconto_ativo'] != null){ ?>
            $('#desconto_ativo').val(<?php echo $produto['produto_desconto_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_datafinal_promocao_ativo'] != null){ ?>
            $('#datafinal_promocao_ativo').val(<?php echo $produto['produto_datafinal_promocao_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_cupom_ativo'] != null){ ?>
            $('#cupom_ativo').val(<?php echo $produto['produto_cupom_ativo'] ?>).change();
        <?php } ?>
        
        <?php if($produto['produto_marca_id']){ ?>
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
    });
</script>

<script>
    function addOpcaoEditar(categoria, nome , estoque){
        
        var opcao = "<tr class='opcoes_"+categoria+"' id='op_"+nome+"'>"+
            "<td>"+categoria+"</td>"+
            "<td class='op_nome'>"+nome+"</td>"+
            "<td>"+estoque+"</td>"+
        "</tr>";
    
        $('#table_opcao').append(opcao);
        
        
        $('#addOpcao').modal('hide');

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
        $('#desc').html($('#editor').find('.ql-editor').html());
    });
    
    $('#form').submit(function(e){
        $('#desc').html($('#editor').find('.ql-editor').html());
    });
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