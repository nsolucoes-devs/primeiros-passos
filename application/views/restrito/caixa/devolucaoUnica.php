<style>
    .tableFixHead          { overflow-y: auto; height: 500px; }
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
				<li class="active">Devoluções</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dados da Devolução</h1>
			</div>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
					    <div class="col-md-12">
					        
    						<div class="row">
    						    <div class="col-md-4">
    						       <label>Data:</label>
    						       <p><?php echo $devo['data_dc'] ?></p>
    						    </div>
    						    <div class="col-md-4">
    						       <label>Funcionário:</label>
    						       <p>
    						       <?php
    						            foreach($funcionarios as $fun){
    						                if($fun['id_funcionario'] == $devo['funcionario_id']){
    						                    echo $fun['nome_funcionario'];
    						                }
    						            }
    						       ?>
    						       </p>
    						    </div>
    						    <div class="col-md-4">
    						       <label>Cliente:</label>
    						       <p>
    						       <?php echo $cliente['nome_cliente'] ?>
    						       </p>
    						    </div>
    						</div>
    						<div class="row">
    						    <div class="col-md-12">
    						        <label>Descrição da Devolução:</label>
    						        <p><?php echo $devo['obs_dc'] ?></p>
    						    </div>
    						</div>
    						<br><hr><br>
    						<label style="font-size:18px; color:black;">Itens da Devolução</label>
    						<div class="tableFixHead">
            					<table id="myTable" class="table table-hover table-bordered">
            					    <thead>
            					        <tr>
            					            <th>Código</th>
            					            <th>Produto</th>
            					            <th>Quantidade</th>
            					            <th>Valor</th>
            					        </tr>
            					    </thead>
            					    <tbody>
            					        <?php foreach($itens as $itn){ ?>  
            					        <tr>
            					            <td><?php echo $itn['estoque_id'] ?></td>
            					            <td><?php
            					                foreach($estoques as $est){
            					                    if($est['id_estoque'] == $itn['estoque_id']){
            					                        foreach($produtos as $prod){
            					                            if($prod['id_produto'] == $est['produto_id']){
            					                                echo $prod['nome_produto'] . ' | ' . $est['modelo_produto'];
            					                            }
            					                        }
            					                    }
            					                }
            					            ?></td>
            					            <td><?php echo $itn['quantidade'] ?></td>
            					            <td>R$ <?php echo number_format($itn['valor'], 2, ',', '.') ?></td>
            					        </tr>
            					        <?php } ?>
            					    </tbody>
            					 </table>
        					</div>
    						
    						<div name="panel-body-footer" class="form-group text-center" style="margin-top: 30px;">
    						    <a href="<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa'] ?>" class="btn btn-primary">Voltar</a><br><br>
    						</div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row-->
	
