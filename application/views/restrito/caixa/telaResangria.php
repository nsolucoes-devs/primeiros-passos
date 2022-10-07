
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active"> Caixa / Sangria</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Sangrias</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-body">

                <a data-toggle="modal" data-target="#modalAdd" class="btn btn-primary" style= "margin-bottom: 30px;" onclick="setaDadosAdd('<?php echo $caixaunico['id_caixa'];?>')" class="plus">
                Adicionar Sangria &nbsp<em class="fa fa-plus"></em></a>
				<?php if($sangrias != null){ ?>
				<?php if($erro != 0) { ?>
				    <h3 class="text-danger">Impossível efetuar sangrias que excedam o troco atual de: <?php echo $caixaunico['troco_atual']; ?></h3>
				<?php } ?>
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th>Data:</th>
				            <th>Executor:</th>
				            <th>Valor da Sangria:</th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php foreach($sangrias as $san){ ?>
				        <tr>
				            <td><?php echo $san['data_sangria']; ?></td>
				            <?php foreach($funcionarios as $fun){
				                if($fun['id_funcionario'] == $san['funcionario_id']){
				                    ?><td><?php echo $fun['nome_funcionario'] ?></td><?
				                }
				            } ?>
				            <td>R$ <?php echo str_replace('.', ',', $san['valor_sangria']); ?></td>
				            <!--<td>
				                <a href="<?php echo base_url('') . $san['id_sangria'];?>"  class="edit"><em class="fa fa-eye"></em></a>&nbsp&nbsp&nbsp
					            <a  href="" class="btn btn-primary">Sangria</a>&nbsp&nbsp&nbsp
								<a data-toggle="modal" data-target="#modalExcluir" class="btn btn-primary" onclick="setaDadosModal('<?php echo $san['id_sangria'];?>')" class="trash"><em class="fa fa-trash"></em></a>
						    </td> -->
				        </tr>
				        <?php } ?>
				    </tbody>
				 </table>
				 <?php } else { ?>
				    <h3 class="page-header">Não há sangrias</h3>
				 <?php } ?>
			</div>
			<div class="panel-footer">
			    <a class="btn btn-primary" href="<?php echo base_url('caixa/index'); ?>"><em class="fa fa-angle-left">&nbspVoltar</em></a>
			</div>
		</div>
		
	</div><!--/.col-->
</div>	

<div class="modal" id="modalAdd">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
          <form id="modalExemplo" method="post" action="
          <?php if($verifica == 1){echo base_url('Caixa/adicionarreSangria/1/').$passaid;}else{echo base_url('Caixa/adicionarreSangria/0');}?>">
             <input type="hidden" name="addsang" id="addsang">
             <label for="valor">Valor: </label><br>
             <input type="text" name="valor" id="valor" required>&nbsp
             <button type="submit" class="btn btn-success">Adicionar</button>
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>
