<style>
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
    
    .c-aprovados{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(76 175 80 / 40%);
        background: linear-gradient(60deg, #66bb6a, #43a047);
    }
    
    .c-negadas{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(244 67 54 / 40%);
        background: linear-gradient(60deg, #ef5350, #e53935);
    }
    
    .c-titulos{
        box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 188 212 / 40%);
            background: linear-gradient(60deg, #26c6da, #00acc1);
    }
    
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
    }
    
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
    }
    
    .c-card-category{
        color: black;
        font-size: 14px;
        margin: 0;
        padding-top: 10px;
        font-weight: bold;
    }
    
    .c-card-title{
        margin: 0;
        color: #3C4858;
        font-size: 1.5625rem;
        line-height: 1.4em;
    }
    
    .c-card-title small{
        font-size: 80%;
        font-weight: 400;
    }
    
    .c-card-footer{
        border-top: 1px solid #d6d5d5;
        margin-top: 20px;
        padding: 0;
        padding-top: 10px;
        margin: 0 15px 10px;
        border-radius: 0;
        justify-content: flex-end;
        align-items: center;
        display: flex;
        background-color: transparent;
    }
    
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    
    .c-stats{
        color: #999999;
        font-size: 12px;
        line-height: 22px;
        display: inline-flex;
    }
    
    .c-stats-icon{
        position: relative;
        top: 4px;
        font-size: 16px;
        margin-right: 3px;
        margin-left: 3px;
        color: grey;
    }
    
    .c-stats-text{
        color: grey;
    }
    
    .c-table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    
    .c-table thead{
        color:  #1b9045!important;
    }
    
    .c-table thead tr th{
        padding: 8px;
        vertical-align: middle;
    }
    
    .c-table tbody tr td {
        padding: 8px;
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }
    
    .c-table tbody tr:hover{
        cursor: pointer;
        background-color: #eee!important;
    }
    
    .check-all{
        width: 32px;
        font-size: 12px;
        color: white;
        background-color: #9c27b0;
        border: 0;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    
    .button-area{
        margin-top: 20px;
    }
    
    .button-custom{
        color: white;
        background-color: #9c27b0;
        border: 0;
        font-size: 14px;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    
    .search{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .form-control-custom{
        border-radius: 5px;
        border: 1px solid #80808061;
        padding: 5px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-right: -4px;
        height: 32px;
        width: 165px;
        color: black;
    }
    
    .form-control-custom:focus {
        outline: unset;
        border: 2px solid #43006d;
        color: #43006d;
    }
    
    .search-field{
        width: 200px;
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
    }
    
    .def-item{
        display: block;
        padding: 7px 10px;
        color: black;
        font-size: 14px;
    }
    
    .check{
        min-width: 20px;
        min-height: 20px;
    }
    
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
        cursor: pointer;
    }
    
    .force-hide{
        display: none!important;
    }
    
    .swal2-container.swal2-top.swal2-backdrop-show{
        opacity: 0.6;
        overflow-y: auto;
        margin-top: 112px;
        width: 380px;
        height: 100px;
    }
    
    .swal2-popup.swal2-toast.swal2-icon-success.swal2-show{
        width: 100%;
        height: 100%;
        display: flex;
        background-color: lightgrey;
    }
    
    .swal2-success-circular-line-left, .swal2-success-fix, .swal2-success-circular-line-right{
        display: none;
    }
    
    span.swal2-success-line-tip, span.swal2-success-line-long{
        z-index: 3!important;
    }
    
    .swal2-success-ring{
        background-color: #507525;
        z-index: 2;
    }
    
    h2#swal2-title{
        display: flex;
        color: black;
        font-size: 18px;
    }
    
    .see-pass{
        width: 10%;
        margin-left: -4px;
        margin-top: -2px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .passwd{
        width: 50%;
        display: inline;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .pagination-links a{
        color: #1b9045;
        text-decoration: none;
        padding: 5px;
        font-size: 20px;
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 1px solid grey;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminestoque/estoques') ?>">Estoques</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Movimento de Estoque</b></h2>
                    </div>
                    <div class="col-md-6">
                        <!--<button class="btn btn-primary text-left" data-toggle="modal" data-target="#estoque-modal" style="margin-right: 37%; position: relative; top: 33px;"> + Estoque </button>-->
                        <a href="<?php echo base_url('admin/adminestoque/cadastroestoque') ?>"><button type="button" class="btn btn-primary" style="margin-right: 37%; position: relative; top: 33px;" title="Adicionar Estoque"><em class="fa fa-plus"></em></button></a>
                        <form method="post">
                            <div class="search-field">
                                <input type="text" id="filtro" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <div class="col-md-12">
            
                    <div id="estoque-lista">
                        <div class="row" style="margin-top: 2%">
                            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                                                    
                                <div class="col-md-12">
                                    <div class="c-card-body">
                                        <div class="table-responsive" style="width: 100%">
                                            <table class="table c-table" id="tabela2">
                                                <thead>
                                                    <tr>
                                                    	<th class="text-center" style="width: 15%">Data e Hora</th>
                                                    	<!--<th class="text-center" style="width: 5%">ID</th>-->
                                    		            <th>Loja</th>
                                    		            <th>Produto</th>
                            				            <th class="text-center" style="width: 10%">Estoque</th>
                            				            <th class="text-center" style="width: 10%">Valor</th>
                            				            <th class="text-center" style="width: 10%">Tipo</th>
                        				            </tr>
                        				        </thead>
                        				        <tbody>
                        				            <?php foreach ($estoques as $est) { ?>
                            				            <tr>
                            				                <td class="text-center"> <?php echo date("d/m/Y H:i:s", strtotime($est['estoque_data'])) ?> </td>
                            				                <!--<td class="text-center"> <?php echo $est['estoque_id'] ?> </td>-->
                            				                <td> <?php echo $est['estoque_loja'] ?> </td>
                            				                <td> <?php echo $est['estoque_produto'] ?> </td>
                            				                <td class="text-center"> <?php echo $est['estoque_quantidade'] ?></td>
                            				                <td class="text-center"> <?php echo "R$ ".number_format($est['estoque_valor'], 2, ',', '.'); ?> </td>
                            				                <td class="text-center"> <?php echo $est['estoque_tipo'] ?> </td>
                            				            </tr>
                        				            <?php } ?>
                        				        </tbody>
                    				        </table>
                    				    </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($estoques == null) { ?>
		    <div class="col-md-12 text-center">
		        <p>Nenhum produto encontrado!</p>
		    </div>
		<?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="pagination-links"><?php //echo $links; ?></p>
                </div>
            </div>
    </section>
</section>

<!-- MODAL - CADASTRAR -->
<div class="modal fade" id="estoque-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: black">
        <h3 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">Cadastrar Estoque</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 18px; color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminestoque/cadestoque');?>" method="post" id="form-cad">
            <input type="hidden" id="data1" name="data1">
            <div class="row" style="padding-left: 2%; padding-right: 2%; padding-top: 3%;">
                <div class="col-md-12 form-group">
                    <label><b>Produto:</b></label>
                    <select class="js-example-basic-multiple" id="prod_estoque_cad" name="prod_estoque_cad" onchange="selecionaestoque()" data-live-search="true">
                        <option disabled selected> -- Selecione o produto-- </option>
                        <?php foreach($produtos as $p){ ?>
                            <option value="<?php echo $p['produto_nome'] ?>"><?php echo $p['produto_nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6">
                    <label><b>Tipo:</b></label>
                    <select class="form-control" style="width: 100%;" id="tipo_estoque_cad" name="tipo_estoque_cad" data-live-search="true" onchange="ajuste()">
                        <option class="form-control" disabled selected> -- Selecione o tipo-- </option>
                        <option value="Entrada estoque"> Entrada estoque </option>
                        <option value="Ajuste estoque">  Ajuste estoque </option>
                        <option value="Perda">  Perda </option>
                        <option value="Garantia">  Garantia </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><b>Loja:</b></label>
                    <select class="form-control" style="width: 100%;" id="loja_estoque_cad" name="loja_estoque_cad" data-live-search="true">
                        <option disabled selected> -- Selecione a loja-- </option>
                        <?php foreach($lojas as $lj) { ?>
                            <option value="<?php echo $lj['nome'] ?>"> <?php echo $lj['nome'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%">
                <div class="col-md-6 form-group">
                    <label><b>Quantidade:</b></label>
                    <input type="text" id="qtd_estoque_cad" name="qtd_estoque_cad" class="form-control" placeholder="0" readonly>
                </div>
                <div class="col-md-6 form-group" id="detalhe-div-qtdAD">
                    <label><b>Adicionar:</b></label>
                    <input type="text" id="addqtd_estoque_cad" name="addqtd_estoque_cad" class="form-control" placeholder="0">
                </div>
                <div class="col-md-6 form-group" style="display: none" id="detalhe-div-qtdAJ">
                    <label><b>Ajustar:</b></label>
                    <input type="text" id="addqtd_estoque_cad" name="addqtd_estoque_cad" class="form-control" placeholder="0">
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Valor:</b></label>
                    <input type="text" class="form-control dinheiro" id="valor_estoque_cad" name="valor_estoque_cad" placeholder="0,00" readonly>
                    <input type="hidden" id="valor-antigo" name="valor-antigo">
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Novo Valor:</b></label>
                    <input type="text" class="form-control dinheiro" id="novovalor_estoque_cad" name="novovalor_estoque_cad" placeholder="0,00">
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
      </form>
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
                <label><b>Loja:</b></label>
                <input type="text" id="estoque-loja-ver" name="estoque-loja-ver" class="form-control" readonly>
                </select>
            </div>
            <div class="col-md-6 form-group" style="position: relative; right: 1%;">
                <label><b>Tipo:</b></label>
                <input class="form-control" id="estoque-tipo-ver" name="estoque-tipo-ver" readonly>
            </div>
        </div>
        <div class="row" style="padding-left: 2%; padding-right: 2%;">
            <div class="col-md-6 form-group">
                <label><b>Quantidade:</b></label>
                <input type="text" id="estoque-quantidade-ver" name="estoque-quantidade-ver" class="form-control number" readonly>
            </div>
            <div class="col-md-6 form-group">
                <label><b>Valor:</b></label>
                <input type="text" class="form-control dinheiro" id="estoque-valor-ver" name="estoque-valor-ver" readonly>
            </div>
        </div>
        <div class="row" style="padding-left: 2%; padding-right: 2%; display: none" id="detalhe-div-ver">
            <div class="col-md-12 form-group">
                <label><b>Detalhes:</b></label>
                <textarea class="form-control" id="detalhe-ver" name="detalhe-ver" readonly></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
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
      <form action="<?php echo base_url('admin/adminestoque/editestoque');?>" method="post" id="form-edit">
            <input type="hidden" id="id_estoque" name="id_estoque">
            <input type="hidden" id="data2" name="data2">
            <div class="row" style="padding-left: 2%; padding-top: 3%; padding-bottom: 2%; padding-right: 2%;">
                <div class="col-md-6">
                    <label><b>Tipo:</b></label>
                    <select class="form-control" style="width: 100%;" id="tipo_estoque_edit" name="tipo_estoque_edit" onchange="ajuste2()">
                        <option value="Entrada estoque"> Entrada estoque </option> 
                        <option value="Ajuste estoque">  Ajuste estoque </option>
                        <option value="Perda">  Perda </option>
                        <option value="Garantia">  Garantia </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><b>Loja:</b></label>
                    <select class="form-control" style="width: 100%;" id="loja_estoque_edit" name="loja_estoque_edit">
                        <?php foreach($lojas as $lj){ ?>
                        <option value="<?php echo $lj['nome'] ?>" class="form-control"><?php echo $lj['nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Qtd atual:</b></label>
                    <input type="text" id="qtd_estoque_edit" name="qtd_estoque_edit" class="form-control number" readonly>
                </div>
                <div class="col-md-6 form-group" id="detalhe-div-qtdAD-edit">
                    <label><b>Adicionar:</b></label>
                    <input type="text" class="form-control number" id="add_estoque_edit" name="add_estoque_edit" value="0">
                </div>
                <div class="col-md-6 form-group" id="detalhe-div-qtdAJ-edit" style="display: none;">
                    <label><b>Ajustar:</b></label>
                    <input type="text" class="form-control number" id="add_estoque_edit" name="add_estoque_edit" value="0">
                </div>
            </div>
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-6 form-group">
                    <label><b>Valor atual:</b></label>
                    <input type="text" class="form-control dinheiro" id="valoratual_estoque_edit" name="valoratual_estoque_edit" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Novo valor:</b></label>
                    <input type="text" class="form-control dinheiro" id="novovalor_estoque_edit" name="novovalor_estoque_edit" value="0,00">
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
      </form>
    </div>
  </div>
</div>

<!-- Modal Excluir Estoque -->

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
          <p style="font-size: 17px;"><b> Deseja excluir a loja? </b><p>
      </div>
      <div class="modal-footer">
            <form action="<?php echo base_url('admin/adminestoque/excluirestoque') ?>" method="post">
                <input type="hidden" id="estoque-excluir" name="estoque-excluir">
                <button type="submit" class="btn btn-primary">Excluir</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form> 
      </div>
    </div>
  </div>
</div>

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>   

<script>
    //MASCARAS
    $('.dinheiro').mask('#.##0,00', {reverse: true});    
</script>

<script>
    $(document).ready(function() {
        var data = new Date();
        var dia     = data.getDate();           // 1-31
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano     = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        
        $('#data1').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
        $('#data2').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
        
        $('.js-example-basic-multiple').select2({theme: "bootstrap"});
    });
</script>

<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

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
                $('#estoque-loja-ver').val(data.estoque_loja);
                $('#estoque-produto-ver').val(data.estoque_produto);
                $('#estoque-quantidade-ver').val(data.estoque_quantidade);
                $('#estoque-tipo-ver').val(data.estoque_tipo);
                $('#estoque-valor-ver').val(new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(data.estoque_valor));
                $('#detalhe-ver').val(data.estoque_desc);
                
                $('#id_estoque').val(data.estoque_id);
                $('#tipo_estoque_edit').val(data.estoque_tipo);
                $('#loja_estoque_edit').val(data.estoque_loja);
                $('#qtd_estoque_edit').val(data.estoque_quantidade);
                $('#valoratual_estoque_edit').val(new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(data.estoque_valor));
                $('#detalhe-edit').val(data.estoque_desc);
                
                if(data.estoque_tipo == "Ajuste estoque"){ 
                    $('#detalhe-div-cad').css("display", "block");
                    $('#detalhe-div-ver').css("display", "block");
                    $('#detalhe-div-edit').css("display", "block");
                    $('#detalhe-div-qtdAJ').css("display", "block");
                    $('#detalhe-div-qtdAD').css("display", "none");
                    
                }else{
                    $('#detalhe-div-cad').css("display", "none");
                    $('#detalhe-div-ver').css("display", "none");
                    $('#detalhe-div-edit').css("display", "none");
                    $('#detalhe-div-qtdAJ').css("display", "none");
                    $('#detalhe-div-qtdAD').css("display", "block");
                }
                
                $('#estoque-excluir').val(data.estoque_id);
                
                
            },
        });
    }
    
    function ajuste(){
        var aux = document.getElementById('tipo_estoque_cad').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-cad').css("display", "block");
            $('#detalhe-div-qtdAJ').css("display", "block");
            $('#detalhe-div-qtdAD').css("display", "none");
        }else{
            $('#detalhe-div-cad').css("display", "none");
            $('#detalhe-div-qtdAJ').css("display", "none");
            $('#detalhe-div-qtdAD').css("display", "block");
        }
    }
    
    function ajuste2(){
        var aux = document.getElementById('tipo_estoque_edit').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-edit').css("display", "block");
            $('#detalhe-div-qtdAJ-edit').css("display", "block");
            $('#detalhe-div-qtdAD-edit').css("display", "none");
        }else{
            $('#detalhe-div-edit').css("display", "none");
            $('#detalhe-div-qtdAJ-edit').css("display", "none");
            $('#detalhe-div-qtdAD-edit').css("display", "block");
        }
    }
    
    function selecionaestoque(){
        var nomeprod = document.getElementById('prod_estoque_cad').value;
        var dados = new FormData();
        dados.append('produto', nomeprod);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/getestoqueprod'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                if(data != 0){
                    $('#loja_estoque_cad').val(data.estoque_loja);
                    $('#qtd_estoque_cad').val(data.estoque_quantidade);
                    $('#tipo_estoque_cad').val(data.estoque_tipo);
                    $('#valor_estoque_cad').val(data.estoque_valor);
                    $('#valor-antigo').val(data.estoque_valor);
                }else{
                    $('#loja_estoque_cad').val('');
                    $('#qtd_estoque_cad').val(0);
                    $('#tipo_estoque_cad').val('');
                    $('#valor_estoque_cad').val(0);
                    $('#valor-antigo').val(0);
                }
            },
        });
    }
</script>

<script>
    function validainput(){
        
        var value1 = $('#valor_estoque_cad').val();
        var value2 = $('#novovalor_estoque_cad').val();
        var value3 = $('#valor-antigo').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        var clean2 = parseFloat(value2.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        var clean3 = parseFloat(value3.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valor_estoque_cad').value = clean1;
        document.getElementById('novovalor_estoque_cad').value = clean2;
        document.getElementById('valor-antigo').value = clean3;
        
        $('#form-cad').submit();
        
    }
    
    function validainput2(){
        
        var value1 = $('#valoratual_estoque_edit').val();
        var value2 = $('#novovalor_estoque_edit').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        var clean2 = parseFloat(value2.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valoratual_estoque_edit').value = clean1;
        document.getElementById('novovalor_estoque_edit').value = clean2;
        
        $('#form-edit').submit();
        
    }
</script>