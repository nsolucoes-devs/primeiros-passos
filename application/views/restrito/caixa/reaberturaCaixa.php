<style>
    .tableFixHead          { overflow-y: auto; height: 500px; }
    .tableFixHead thead th { position: sticky; top: 0; }
    
    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }
    
    .tableFixHead2          { overflow-y: auto; height: 600px; }
    .tableFixHead2 thead th { position: sticky; top: 0; }
    
    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }
</style>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active">Caixa</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Caixas Fechados</h1>
	</div>
</div><!--/.row-->
<?php if($erro != null){ ?>
    <div class="row">
	    <div class="alert alert-<?php if($erro['erro'] == 1){ echo "success";}elseif($erro['erro'] == 2 || $erro['erro'] == 3){echo "danger";}?>" role="alert">
            <?php echo $erro['msg']; ?>
        </div>
    </div>
<?php } ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
                <a class="btn btn-primary" href="<?php echo base_url('caixa/index');?>">Voltar para Caixas <em class="fa fa-reply"></em></a>
                <br><br>
				<div class="tableFixHead2" id="tablefix">
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th style="width:15%">Caixa Fechado em:</th>
				            <th>Loja:</th>
				            <th style="width:35%">Funcionário:</th>
				            <th style="width:15%">Troco Inicial:</th>
				            <th style="width:15%">Caixa Final:</th>
				            <th style="width:20%">Ações</th>
				        </tr>
				    </thead>
				    
				    <tbody>
				        <?php foreach($caixa as $cax){
				                foreach($lojas as $loj){
				                    if($loj['id_loja'] == $cax['loja_id'] && $loj['nome_loja'] != null){
				        ?>
				            <td><?php echo $cax['fechamento_caixa']?></td>
				            <td><?php 
				                foreach($lojas as $loj){
				                    if($loj['id_loja'] == $cax['loja_id']){
				                        echo $loj['nome_loja'];
				                    }
				                }
				            ?></td>
				            <td><?php 
				                foreach($funcionarios as $fun){
				                    if($fun['id_funcionario'] == $cax['funcionario_id']){
				                        echo $fun['nome_funcionario'];
				                    }
				                }
				            ?></td>
				            <td>R$ <?php echo $cax['troco_inicial']?></td>
				            <td>R$ <?php echo $cax['troco_atual']?></td>
				            <td>
					            <a data-toggle="modal" data-target="#modalAdd" onclick="popula(<?php echo $cax['id_caixa'] . ", " . $cax['loja_id']?>)" class="btn btn-primary" class="plus">Reabrir</a>
						    </td>
				        </tr>
				        <?php } } } ?>
				    </tbody>
				 </table>
				 </div>
		</div>
	</div><!--/.col-->
</div>

<div class="modal" id="modalAdd">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Reabertura de Caixa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form id="modalExemplo" method="post" action="<?php echo base_url('caixa/reabrirCaixa') ;?>">
                    <input type="hidden" name="addid" id="addid">
                    <input type="hidden" name="loja" id="loja">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="valor">Motivo de Reabertura</label><br>
                            <input class="form-control" type="text" name="motivo" id="motivo" required><br><br>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="limite">Senha de Confirmação</label><br>
                            <input class="form-control" type="password" name="senha" id="senha" required><br><br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Reabrir Caixa</button>
                </form>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
 </div>
</div>

<script>
    function popula(valor, valor2){
            document.getElementById('addid').value = valor;
            document.getElementById('loja').value = valor2;
    }
</script>