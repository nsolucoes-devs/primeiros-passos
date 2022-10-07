
<style>
    .tableFixHead thead th { position: sticky; top: 0; }
    
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
		<h1 class="page-header">Devoluções</h1>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-body">

                    <a style= "margin-bottom: 30px;" class="btn btn-primary" href="<?php echo base_url('caixa/telaAdicionar/'. $id_caixa) ?>" class="plus">
                        Adicionar &nbsp<em class="fa fa-plus"></em></a>
					<div class="tableFixHead">
					<table id="myTable" class="table table-hover table-bordered">
					    <thead>
					        <tr>
					            <th>Data</th>
					            <th>Funcionário</th>
					            <th>Observação</th>
					            <th style="min-width:150px">Ações</th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php
					            foreach($devos as $dev){
					        ?>
					        <tr>
					            <td><?php echo $dev['data_dc']; ?></td>
					            <td><?php foreach($funcionarios as $fun){
					                if($fun['id_funcionario'] == $dev['funcionario_id']){
					                    echo $fun['nome_funcionario'];
					                }
					            } ?></td>
					            <td><?php echo $dev['obs_dc']; ?></td>
					            <td>
					                <a style="margin-left:1px" class="btn btn-primary" href="<?php echo base_url('caixa/telaUnica/' . $dev['id_dc']) ?>"><em class="fa fa-eye"></em></a>&nbsp&nbsp&nbsp
						            <a style="margin-left:1px" class="btn btn-primary" href="<?php echo base_url('caixa/editarDevolucao/' . $dev['id_dc']) ?>"><em class="fa fa-pencil"></em></a>&nbsp&nbsp&nbsp
						            <a style="margin-left:1px" class="btn btn-primary" target="_blank" href="<?php echo base_url('devolucao/geraPDF/' . $dev['id_dc']) ?>"><em class="fa fa-print"></em></a>&nbsp&nbsp&nbsp
							    </td>
					        </tr>
					        <?php } ?>
					            <!--<td>
					                <a style="margin-left:1px" class="btn btn-primary" href=""  class="edit"><em class="fa fa-eye"></em></a>&nbsp&nbsp&nbsp
						            <a style="margin-left:1px" class="btn btn-primary" href="" class="edit"><em class="fa fa-pencil"></em></a>&nbsp&nbsp&nbsp
							    </td>-->
					    </tbody>
					 </table>
					</div>
			</div>
			<div class="panel-footer">
			    
			</div>
		</div>
		<div class="col-md-12 text-center">
            <a href="<?php echo base_url('caixa/index')?>" class="btn btn-primary">Voltar</a><br><br>
        </div>
	</div><!--/.col-->
</div>
