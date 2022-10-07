<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.min.css')?>" />
<style>
    .card {
        height: auto;
    }
    
    .nav-tabs{
        background-color: white;
    }
    
    .nav-link{
        font-size: 25px;
    }
    
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
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
    
    .modal-posicao{
        position: relative;
        left: 25%;
        top: 8px;
    }
    
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: 5%;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page"> Caixas</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('caixa') ?>"> Gestão de Caixa</a></li>
            </ol>
        </nav>
        
            <div class="c-card" style="bottom: 40px;">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Seus Caixas</b></h2>
                        </div>
                        
                    </div>
                </div>
                <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                    <div class="col-md-12">
                        <div class="c-card-body">
                            
                            
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link" id="caixas-tab" data-toggle="tab" href="#caixas" role="tab" aria-controls="caixas" aria-selected="true">Caixas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="reabertura-tab" data-toggle="tab" href="#reabertura" role="tab" aria-controls="reabertura" aria-selected="false">Reaberturas</a>
                                </li>
                            </ul>
                            
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active in" id="caixas" style="padding-top: 1%" role="tabpanel" aria-labelledby="caixas-tab">
                                    <div class="col-md-6 text-rigth">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#novo-caixa"> Abrir caixa + </button>
                                    </div>
                                    <br><br><br><br>
                                    <!-- if (caixa) -->
                                    <div class="table-responsive">
                                        <table class="table c-table" id="myTable">
                    				        <thead>
                    				            <tr>
                    				                <th style="width: 15%">Loja</th>
                    				                <th style="width: 15%">Data de Abertura:</th>
                    				                <th style="width: 15%">Funcionário:</th>
                    				                <th style="width: 15%">Troco Inicial:</th>
                    				                <th style="width: 15%">Valor em Caixa:</th>
                    				                <th style="width: 15%">Ações</th>
                    				            </tr>
                    				        </thead>
                    				        <tbody>
                    				            <?php foreach($caixas as $cx){?>
                    				            <tr>
                    				                <td> <?php echo $cx['loja_id']; ?> </td>
                    				                <td> <?php echo $cx['abertura_caixa']; ?> </td>
                    				                <td> <?php echo $cx['funcionario_id']; ?> </td>
                    				                <td> <?php echo $cx['troco_inicial']; ?> </td>
                    				                <td> <?php echo $cx['troco_atual']; ?> </td>
                    				                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acaoModal" onclick="popModal('<?php echo $cx['id_caixa'];?>')">Ações</button> </td>
                    				            </tr>
                    				            <?php }?>

                    				        </tbody>
                				        </table>
                				    </div>
                				    <!-- else -->
                                    <!--
                                    
                                    <div>
                                        <h3> Não há caixas abertos </h3>
                                    </div>
                                    -->
                                </div>
                            
                            
                                <div class="tab-pane fade" id="reabertura" style="padding-top: 1%" role="tabpanel" aria-labelledby="reabertura-tab">
                                    <div class="col-md-6 text-rigth">
                                        <button class="btn btn-primary"> Reabertura de caixa </button>
                                    </div>
                                    <br><br><br><br>
                                    <div class="table-responsive">
                                        <table class="table c-table" id="tabela2">
                    				        <thead>
                    				            <tr>
                    				                <th style="width: 12.5%">Loja</th>
                    				                <th style="width: 12.5%">Data de Abertura:</th>
                    				                <th style="width: 12.5%">Data de Fechamento:</th>
                    				                <th style="width: 12.5%">Data de Reabertura:</th>
                    				                <th style="width: 12.5%">Funcionário:</th>
                    				                <th style="width: 12.5%">Troco Inicial:</th>
                    				                <th style="width: 12.5%">Valor em Caixa:</th>
                    				                <th style="width: 12.5%">Ações</th>
                    				            </tr>
                    				        </thead>
                    				        <tbody>
                    				            <tr>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> Exemplo </td>
                    				                <td> <button type="button" class="btn btn-primary">Ações</button> </td>
                    				            </tr>
                    				        </tbody>
                				        </table>
                				    </div>
                                </div>
                            </div>
        			    </div>
    			    </div>
                </div>
            </div>
        
    </section>
</section>

<!-- Modal Add Caixa -->
<div class="modal fade" id="novo-caixa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1b9045">
        <h5 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">ADICIONAR LOJA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 7px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('caixa/adicionarCaixa2');?>" method="post">
            <div class="row" style="position: relative; left: 2%; padding-top: 3%; padding-bottom: 3%;">
                <div class="col-md-12">
                    <label>Selecione a loja: </label>
                    <select class="form-control" id="cad-nome-loja" style="width: 95%" name="cad-nome-loja">
                        <?php foreach($lojas as $loja){
                            if($_SESSION['loja_id'] != 0 && $_SESSION['loja_id'] == $loja['id']){?>
                            <option value="<?php echo $loja['id'];?>"> <?php echo $loja['nome'];?> </option>
                        <?php }elseif($_SESSION['loja_id'] == 0){?>
                            <option value="<?php echo $loja['id'];?>"> <?php echo $loja['nome'];?> </option>
                        <?php }}?>
                    </select>    
                </div>
            </div>
            <div class="row" style="padding-bottom: 3%;">
                <div class="col-md-6" style="position: relative; left: 2%">
                    <label>Valor de troco inicial:</label>
                    <input type="text" id="troco-inicial-cad" name="troco-inicial-cad" class="form-control" style="width: 95%" placeholder="R$">
                </div>
                <div class="col-md-6" style="position: relative; right: 2%">
                    <label>Limite permitido em caixa:</label>
                    <input type="text" id="limite-caixa-cad" name="limite-caixa-cad" class="form-control" style="width: 95%" placeholder="R$">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ações -->
<div class="modal fade" id="acaoModal" tabindex="-1" role="dialog" aria-labelledby="acaoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="background-color:#1b9045; text-align:-webkit-center; height:60px;">
        <h2 class="modal-title" id="acaoModalLabel"> AÇÕES </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-10%;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer" style="text-align:-webkit-center;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="hidden" id="idCaixa" value="">
        <button type="button" class="btn btn-primary" onclick="fechaCaixa()">Fechar Caixa</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap-multiselect.min.js')?>"></script>

<script>
    function verCaixa(id){
        var dados = new FormData();
        dados.append('caixa', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/caixa/index'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#id-caixa-ver').val(data.id_caixa);
                
                $('#id-caixa-edit').val(data.id_caixa);
                
                
                $('#id-caixa-fecha').val(data.id_caixa);
            },
        });
    }
    
    function popModal(id){
        document.getElementById("idCaixa").value = id;
    }
    function fechaCaixa(){
        var dados = new FormData();
        dados.append('caixa', document.getElementById("idCaixa").value);
        
        $.ajax({
            url: '<?php echo base_url('caixa/encerrarCaixa'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {

            },
        });
    }
    
    
    
</script>

