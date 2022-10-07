
<style>
    .tableFixHead          { overflow-y: auto; height: 450px; }
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
	    <?php if($this->session->userdata('tipo_pessoa') == 1 || $this->session->userdata('tipo_pessoa') == 4){ ?>
		<h1 class="page-header">Seus Caixas</h1>
		<?php } ?>
		<?php if($this->session->userdata('tipo_pessoa') == 3){ ?>
		<h1 class="page-header">Seu Caixa</h1>
		<?php } ?>
	</div>
</div><!--/.row-->
<!-- =============================================================================================================================================== -->
<!-- ||                                                                  TESTE                                                                    || -->
<!-- =============================================================================================================================================== -->
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">Caixas</a></li>
					<li><a href="#tab2" data-toggle="tab">Reabertura</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab1">
					    <div class="panel-body">
                			<?php if($admin == false){ ?>
                                <a data-toggle="modal" data-target="#modalAdd" class="btn btn-primary" style= "margin-bottom: 30px;" class="plus">
                                    Abrir caixa &nbsp<em class="fa fa-plus"></em></a>
                				<?php $aux=0; if($caixa != null){ ?>
                				<div class="tableFixHead" id="tablefix">
                				<table id="myTable" class="table table-hover table-bordered">
                				    <thead>
                				        <tr>
                				            <th style="width:80px">Data de Abertura:</th>
                				            <th style="width:170px">Funcionário:</th>
                				            <th>Troco Inicial:</th>
                				            <th>Valor em Caixa:</th>
                				            <th style="width:130px">Ações</th>
                				        </tr>
                				    </thead>
                				    <tbody>
                				        <?php
                    				            $cinquenta = ($caixa['troco_inicial'] / 100) * 50;
                    				            $vinte = ($caixa['troco_inicial'] / 100) * 20;
                    				            if($caixa['troco_atual'] <= $cinquenta){
                    				                $aux = 1;
                    				            }
                    				            if($caixa['troco_atual'] <= $vinte){
                    				                $aux = 2;
                    				            }
                				        ?>
                				        <?php if($caixa['limite_caixa'] != 0 && $caixa['troco_atual'] >= $caixa['limite_caixa']){
                				            echo "<tr style='background-color: #ff5542; color:white'>";
                				        }else{echo "<tr>";} ?>
                				            <td><?php echo $caixa['abertura_caixa']?></td>
                				            <?php foreach($funcionarios as $usu){ 
                				                    if($caixa['funcionario_id'] == $usu['id_funcionario']){
                				            ?>
                				                    <td><?php echo $usu['nome_funcionario'] ?></td>            
                				            <?php } } ?>
                				            <td>R$ <?php echo $caixa['troco_inicial']?></td>
                				            <td>R$ <?php echo $caixa['troco_atual']?>&nbsp&nbsp
                				                <?php if($caixa['limite_caixa'] != 0 && $caixa['troco_atual'] >= $caixa['limite_caixa']){ ?>
                					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
                					            <?php } ?>
                				            </td>
                				            <td>
                				                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?php echo base_url('admin/caixa/sangria/')?>">Sangria</a></li>
                                                        <li><a href="<?php echo base_url('admin/Contas/telaDespesas/')?>">Despesas</a></li>
                                                        <li><a href="<?php echo base_url('admin/caixa/telaDevolucoes/') . $caixa['id_caixa']?>">Devolução</a></li>
                                                        <li><a href="<?php echo base_url('admin/Caixa/encerrarCaixa/')?>">Fechar Caixa</a></li>
                                                    </ul>
                                                </div>
                						    </td>
                				        </tr>
                				    </tbody>
                				 </table>
                				 </div>
                				 <?php } else { ?>
                				    <h3 class="page-header">Você não tem caixas abertos</h3>
                				 <?php } ?>
                			<?php }if($admin == true){ ?>
                			    <a data-toggle="modal" data-target="#modalAdd2" class="btn btn-primary" style= "margin-bottom: 30px;" class="plus">
                                    Abrir caixa &nbsp<em class="fa fa-plus"></em></a>
                				<?php $aux=0; if($caixas != null){ ?>
                				<div class="tableFixHead" id="tablefix">
                				<table id="myTable" class="table table-hover table-bordered">
                				    <thead>
                				        <tr>
                				            <th style="min-width:150px">Loja</th>
                				            <th>Data de Abertura:</th>
                				            <th style="width:150px">Funcionário:</th>
                				            <th>Troco Inicial:</th>
                				            <th>Valor em Caixa:</th>
                				            <th style="width:130px">Ações</th>
                				        </tr>
                				    </thead>
                				    <tbody>
                				        <tr>
                				        <?php foreach($caixas as $cai){
                    				            $cinquenta = ($cai['troco_inicial'] / 100) * 50;
                    				            $vinte = ($cai['troco_inicial'] / 100) * 20;
                    				            if($cai['troco_atual'] <= $cinquenta){
                    				                $aux = 1;
                    				            }
                    				            if($cai['troco_atual'] <= $vinte){
                    				                $aux = 2;
                    				            }
                				        ?>
                				        <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){
                				            echo "<tr style='background-color: #ff5542; color:white'>";
                				        }else{echo "<tr>";} ?>
                				            <?php 
                			                foreach($lojas as $loj){
                			                    if($cai['loja_id'] == $loj['id_loja']){
                			                        foreach($estados as $est){
                			                            if($est['id_estado'] == $loj['estado_id']){
                			                                ?><td><?php echo $loj['nome_loja'] . ' - ' . $est['uf_estado']?></td><?php
                			                            }
                			                        }
                			                    }            
                			                }
                				            ?>
                				            <td class="text-center"><?php echo $cai['abertura_caixa']?></td>
                				            <?php foreach($funcionarios as $usu){ 
                				                    if($cai['funcionario_id'] == $usu['id_funcionario']){
                				            ?>
                				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
                				            <?php } } ?>
                				            <td class="text-center">R$ <?php echo $cai['troco_inicial']?></td>
                				            <td class="text-center">R$ <?php echo $cai['troco_atual']?>&nbsp&nbsp
                				                <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){ ?>
                					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
                					            <?php } ?>
                				            </td>
                				            <td class="text-center">
                					            <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?php echo base_url('admin/caixa/sangria2/') . $cai['id_caixa']?>">Sangria</a></li>
                                                        <li><a href="<?php echo base_url('admin/Contas/telaDespesas/') . $cai['id_caixa']?>">Despesas</a></li>
                                                        <li><a href="<?php echo base_url('admin/caixa/telaDevolucoes/') . $cai['id_caixa']?>">Devolução</a></li>
                                                        <li><a href="<?php echo base_url('admin/Caixa/encerrarCaixa/') . $cai['id_caixa']?>">Fechar Caixa</a></li>
                                                    </ul>
                                                </div>
                						    </td>
                				        </tr>
                				        <?php } ?>
                				    </tbody>
                				 </table>
                				 </div>
                				 <?php } else { ?>
                				    <h3 class="page-header">Não há caixas abertos</h3>
                				 <?php } ?>
                			<?php } ?>
                			</div>
                			<div class="panel-footer">
                                <?php if($erro == 1){?> <h4 class="text-danger">Essa loja já possui caixa aberto!</h4><?php }?>
                			</div>
					</div>
					<div class="tab-pane fade" id="tab2">
					    <div class="panel-body">
                			<?php if($admin == false){ ?>
                                <a href="<?php echo base_url('admin/caixa/reabertura')?>" data-toggle="modal" class="btn btn-danger" style= "margin-bottom: 30px;" class="plus">
                                    Reabertura de caixa <em class="fa fa-refresh"></em></a>
                				<?php $aux=0; if($caixa2 != null){ ?>
                				<div class="tableFixHead" id="tablefix">
                				<table id="myTable" class="table table-hover table-bordered">
                				    <thead>
                				        <tr>
                				            <th style="width:80px">Data de Abertura:</th>
                				            <th style="width:80px">Data de Fechamento:</th>
                				            <th style="width:80px">Data de Reabertura:</th>
                				            <th>Funcionário:</th>
                				            <th>Troco Inicial:</th>
                				            <th>Valor em Caixa:</th>
                				            <th style="width:160px">Ações</th>
                				        </tr>
                				    </thead>
                				    <tbody>
                				        <?php
                    				            $cinquenta = ($caixa2['troco_inicial'] / 100) * 50;
                    				            $vinte = ($caixa2['troco_inicial'] / 100) * 20;
                    				            if($caixa2['troco_atual'] <= $cinquenta){
                    				                $aux = 1;
                    				            }
                    				            if($caixa2['troco_atual'] <= $vinte){
                    				                $aux = 2;
                    				            }
                				        ?>
                				        <?php if($caixa2['limite_caixa'] != 0 && $caixa2['troco_atual'] >= $caixa2['limite_caixa']){
                				            echo "<tr style='background-color: #ff5542; color:white'>";
                				        }else{echo "<tr>";} ?>
                				            <td class="text-center"><?php echo $caixa2['abertura_caixa']?></td>
                				            <td class="text-center"><?php echo $caixa2['fechamento_caixa'] ?></td>
                				            <td class="text-center"><?php echo $caixa2['reabertura_data'] ?></td>
                				            <?php foreach($funcionarios as $usu){ 
                				                    if($caixa2['funcionario_id'] == $usu['id_funcionario']){
                				            ?>
                				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
                				            <?php } } ?>
                				            <td class="text-center">R$ <?php echo $caixa2['troco_inicial']?></td>
                				            <td class="text-center">R$ <?php echo $caixa2['troco_atual']?>&nbsp&nbsp
                				                <?php if($caixa2['limite_caixa'] != 0 && $caixa2['troco_atual'] >= $caixa2['limite_caixa']){ ?>
                					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
                					            <?php } ?>
                				            </td>
                				            <td class="text-center">
                					            <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?php echo base_url('admin/Contas/telareDespesas/')?>">Despesas</a></li>
                                                        <li><a href="<?php echo base_url('admin/Caixa/reencerrarCaixa/')?>">Fechar Caixa</a></li>
                                                    </ul>
                                                </div>
                						    </td>
                				        </tr>
                				    </tbody>
                				 </table>
                				 </div>
                				 <?php } else { ?>
                				    <h3 class="page-header">Você não tem caixas abertos</h3>
                				 <?php } ?>
                			<?php }if($admin == true){ ?>
                			    <a href="<?php echo base_url('admin/caixa/reabertura')?>" data-toggle="modal" class="btn btn-danger" style= "margin-bottom: 30px;" class="plus">
                                    Reabertura de caixa <em class="fa fa-refresh"></em></a>
                				<?php $aux=0; if($caixas2 != null){ ?>
                				<div class="tableFixHead" id="tablefix">
                				<table id="myTable" class="table table-hover table-bordered">
                				    <thead>
                				        <tr>
                				            <th>Loja</th>
                				            <th style="width:80px">Data de Abertura:</th>
                				            <th style="width:80px">Data de Fechamento:</th>
                				            <th style="width:80px">Data de Reabertura:</th>
                				            <th>Funcionário:</th>
                				            <th>Troco Inicial:</th>
                				            <th>Valor em Caixa:</th>
                				            <th style="width:160px">Ações</th>
                				        </tr>
                				    </thead>
                				    <tbody>
                				        <tr>
                				        <?php foreach($caixas2 as $cai){
                    				            $cinquenta = ($cai['troco_inicial'] / 100) * 50;
                    				            $vinte = ($cai['troco_inicial'] / 100) * 20;
                    				            if($cai['troco_atual'] <= $cinquenta){
                    				                $aux = 1;
                    				            }
                    				            if($cai['troco_atual'] <= $vinte){
                    				                $aux = 2;
                    				            }
                				        ?>
                				        <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){
                				            echo "<tr style='background-color: #ff5542; color:white'>";
                				        }else{echo "<tr>";} ?>
                				            <?php 
                			                foreach($lojas as $loj){
                			                    if($cai['loja_id'] == $loj['id_loja']){
                			                        foreach($estados as $est){
                			                            if($est['id_estado'] == $loj['estado_id']){
                			                                ?><td><?php echo $loj['nome_loja'] . ' - ' . $est['uf_estado']?></td><?php
                			                            }
                			                        }
                			                    }            
                			                }
                				            ?>
                				            <td class="text-center"><?php echo $cai['abertura_caixa']?></td>
                				            <td class="text-center"><?php echo $cai['fechamento_caixa'] ?></td>
                				            <td class="text-center"><?php echo $cai['reabertura_data'] ?></td>
                				            <?php foreach($funcionarios as $usu){ 
                				                    if($cai['funcionario_id'] == $usu['id_funcionario']){
                				            ?>
                				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
                				            <?php } } ?>
                				            <td class="text-center">R$ <?php echo $cai['troco_inicial']?></td>
                				            <td class="text-center">R$ <?php echo $cai['troco_atual']?>&nbsp&nbsp
                				                <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){ ?>
                					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
                					            <?php } ?>
                				            </td >
                				            <td class="text-center">
                				                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?php echo base_url('admin/Contas/telareDespesas/') . $cai['id_caixa']?>">Despesas</a></li>
                                                        <li><a href="<?php echo base_url('admin/Caixa/reencerrarCaixa/') . $cai['id_caixa']?>">Fechar Caixa</a></li>
                                                    </ul>
                                                </div>
                						    </td>
                				        </tr>
                				        <?php } ?>
                				    </tbody>
                				 </table>
                				 </div>
                				 <?php } else { ?>
                				    <h3 class="page-header">Não há caixas abertos</h3>
                				 <?php } ?>
                			<?php } ?>
                			</div>
                			<div class="panel-footer">
                                <?php if($erro == 1){?> <h4 class="text-danger">Essa loja já possui caixa aberto!</h4><?php }?>
                			</div>
					</div>
				</div>
			</div>
		</div><!--/.panel-->
	</div>
</div>
<!-- =============================================================================================================================================== -->
<!-- ||                                                                  TESTE                                                                    || -->
<!-- =============================================================================================================================================== -->
<!--<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
			<?php if($admin == false){ ?>
                <a data-toggle="modal" data-target="#modalAdd" class="btn btn-primary" style= "margin-bottom: 30px;" class="plus">
                    Abrir caixa &nbsp<em class="fa fa-plus"></em></a>
				<?php $aux=0; if($caixa != null){ ?>
				<div class="tableFixHead2" id="tablefix">
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th style="width:80px">Data de Abertura:</th>
				            <th style="width:170px">Funcionário:</th>
				            <th>Troco Inicial:</th>
				            <th>Valor em Caixa:</th>
				            <th style="width:130px">Ações</th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php
    				            $cinquenta = ($caixa['troco_inicial'] / 100) * 50;
    				            $vinte = ($caixa['troco_inicial'] / 100) * 20;
    				            if($caixa['troco_atual'] <= $cinquenta){
    				                $aux = 1;
    				            }
    				            if($caixa['troco_atual'] <= $vinte){
    				                $aux = 2;
    				            }
				        ?>
				        <?php if($caixa['limite_caixa'] != 0 && $caixa['troco_atual'] >= $caixa['limite_caixa']){
				            echo "<tr style='background-color: #ff5542; color:white'>";
				        }else{echo "<tr>";} ?>
				            <td><?php echo $caixa['abertura_caixa']?></td>
				            <?php foreach($funcionarios as $usu){ 
				                    if($caixa['funcionario_id'] == $usu['id_funcionario']){
				            ?>
				                    <td><?php echo $usu['nome_funcionario'] ?></td>            
				            <?php } } ?>
				            <td>R$ <?php echo $caixa['troco_inicial']?></td>
				            <td>R$ <?php echo $caixa['troco_atual']?>&nbsp&nbsp
				                <?php if($caixa['limite_caixa'] != 0 && $caixa['troco_atual'] >= $caixa['limite_caixa']){ ?>
					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
					            <?php } ?>
				            </td>
				            <td>
				                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('caixa/sangria/')?>">Sangria</a></li>
                                        <li><a href="<?php echo base_url('Contas/telaDespesas/')?>">Despesas</a></li>
                                        <li><a href="<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa']?>">Devolução</a></li>
                                        <li><a href="<?php echo base_url('Caixa/encerrarCaixa/')?>">Fechar Caixa</a></li>
                                    </ul>
                                </div>
						    </td>
				        </tr>
				    </tbody>
				 </table>
				 </div>
				 <?php } else { ?>
				    <h3 class="page-header">Você não tem caixas abertos</h3>
				 <?php } ?>
			<?php }if($admin == true){ ?>
			    <a data-toggle="modal" data-target="#modalAdd2" class="btn btn-primary" style= "margin-bottom: 30px;" class="plus">
                    Abrir caixa &nbsp<em class="fa fa-plus"></em></a>
				<?php $aux=0; if($caixas != null){ ?>
				<div class="tableFixHead" id="tablefix">
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th style="min-width:150px">Loja</th>
				            <th>Data de Abertura:</th>
				            <th style="width:150px">Funcionário:</th>
				            <th>Troco Inicial:</th>
				            <th>Valor em Caixa:</th>
				            <th style="width:130px">Ações</th>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				        <?php foreach($caixas as $cai){
    				            $cinquenta = ($cai['troco_inicial'] / 100) * 50;
    				            $vinte = ($cai['troco_inicial'] / 100) * 20;
    				            if($cai['troco_atual'] <= $cinquenta){
    				                $aux = 1;
    				            }
    				            if($cai['troco_atual'] <= $vinte){
    				                $aux = 2;
    				            }
				        ?>
				        <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){
				            echo "<tr style='background-color: #ff5542; color:white'>";
				        }else{echo "<tr>";} ?>
				            <?php 
			                foreach($lojas as $loj){
			                    if($cai['loja_id'] == $loj['id_loja']){
			                        foreach($estados as $est){
			                            if($est['id_estado'] == $loj['estado_id']){
			                                ?><td><?php echo $loj['nome_loja'] . ' - ' . $est['uf_estado']?></td><?php
			                            }
			                        }
			                    }            
			                }
				            ?>
				            <td class="text-center"><?php echo $cai['abertura_caixa']?></td>
				            <?php foreach($funcionarios as $usu){ 
				                    if($cai['funcionario_id'] == $usu['id_funcionario']){
				            ?>
				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
				            <?php } } ?>
				            <td class="text-center">R$ <?php echo $cai['troco_inicial']?></td>
				            <td class="text-center">R$ <?php echo $cai['troco_atual']?>&nbsp&nbsp
				                <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){ ?>
					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
					            <?php } ?>
				            </td>
				            <td class="text-center">
					            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('caixa/sangria2/') . $cai['id_caixa']?>">Sangria</a></li>
                                        <li><a href="<?php echo base_url('Contas/telaDespesas/') . $cai['id_caixa']?>">Despesas</a></li>
                                        <li><a href="<?php echo base_url('caixa/telaDevolucoes/') . $cai['id_caixa']?>">Devolução</a></li>
                                        <li><a href="<?php echo base_url('Caixa/encerrarCaixa/') . $cai['id_caixa']?>">Fechar Caixa</a></li>
                                    </ul>
                                </div>
						    </td>
				        </tr>
				        <?php } ?>
				    </tbody>
				 </table>
				 </div>
				 <?php } else { ?>
				    <h3 class="page-header">Não há caixas abertos</h3>
				 <?php } ?>
			<?php } ?>
			</div>
			<div class="panel-footer">
                <?php if($erro == 1){?> <h4 class="text-danger">Essa loja já possui caixa aberto!</h4><?php }?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
			<?php if($admin == false){ ?>
                <a href="<?php echo base_url('caixa/reabertura')?>" data-toggle="modal" class="btn btn-danger" style= "margin-bottom: 30px;" class="plus">
                    Reabertura de caixa <em class="fa fa-refresh"></em></a>
				<?php $aux=0; if($caixa2 != null){ ?>
				<div class="tableFixHead2" id="tablefix">
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th style="width:80px">Data de Abertura:</th>
				            <th style="width:80px">Data de Fechamento:</th>
				            <th style="width:80px">Data de Reabertura:</th>
				            <th>Funcionário:</th>
				            <th>Troco Inicial:</th>
				            <th>Valor em Caixa:</th>
				            <th style="width:160px">Ações</th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php
    				            $cinquenta = ($caixa2['troco_inicial'] / 100) * 50;
    				            $vinte = ($caixa2['troco_inicial'] / 100) * 20;
    				            if($caixa2['troco_atual'] <= $cinquenta){
    				                $aux = 1;
    				            }
    				            if($caixa2['troco_atual'] <= $vinte){
    				                $aux = 2;
    				            }
				        ?>
				        <?php if($caixa2['limite_caixa'] != 0 && $caixa2['troco_atual'] >= $caixa2['limite_caixa']){
				            echo "<tr style='background-color: #ff5542; color:white'>";
				        }else{echo "<tr>";} ?>
				            <td class="text-center"><?php echo $caixa2['abertura_caixa']?></td>
				            <td class="text-center"><?php echo $caixa2['fechamento_caixa'] ?></td>
				            <td class="text-center"><?php echo $caixa2['reabertura_data'] ?></td>
				            <?php foreach($funcionarios as $usu){ 
				                    if($caixa2['funcionario_id'] == $usu['id_funcionario']){
				            ?>
				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
				            <?php } } ?>
				            <td class="text-center">R$ <?php echo $caixa2['troco_inicial']?></td>
				            <td class="text-center">R$ <?php echo $caixa2['troco_atual']?>&nbsp&nbsp
				                <?php if($caixa2['limite_caixa'] != 0 && $caixa2['troco_atual'] >= $caixa2['limite_caixa']){ ?>
					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
					            <?php } ?>
				            </td>
				            <td class="text-center">
					            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('Contas/telareDespesas/')?>">Despesas</a></li>
                                        <li><a href="<?php echo base_url('Caixa/reencerrarCaixa/')?>">Fechar Caixa</a></li>
                                    </ul>
                                </div>
						    </td>
				        </tr>
				    </tbody>
				 </table>
				 </div>
				 <?php } else { ?>
				    <h3 class="page-header">Você não tem caixas abertos</h3>
				 <?php } ?>
			<?php }if($admin == true){ ?>
			    <a href="<?php echo base_url('caixa/reabertura')?>" data-toggle="modal" class="btn btn-danger" style= "margin-bottom: 30px;" class="plus">
                    Reabertura de caixa <em class="fa fa-refresh"></em></a>
				<?php $aux=0; if($caixas != null){ ?>
				<div class="tableFixHead" id="tablefix">
				<table id="myTable" class="table table-hover table-bordered">
				    <thead>
				        <tr>
				            <th>Loja</th>
				            <th style="width:80px">Data de Abertura:</th>
				            <th style="width:80px">Data de Fechamento:</th>
				            <th style="width:80px">Data de Reabertura:</th>
				            <th>Funcionário:</th>
				            <th>Troco Inicial:</th>
				            <th>Valor em Caixa:</th>
				            <th style="width:160px">Ações</th>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				        <?php foreach($caixas2 as $cai){
    				            $cinquenta = ($cai['troco_inicial'] / 100) * 50;
    				            $vinte = ($cai['troco_inicial'] / 100) * 20;
    				            if($cai['troco_atual'] <= $cinquenta){
    				                $aux = 1;
    				            }
    				            if($cai['troco_atual'] <= $vinte){
    				                $aux = 2;
    				            }
				        ?>
				        <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){
				            echo "<tr style='background-color: #ff5542; color:white'>";
				        }else{echo "<tr>";} ?>
				            <?php 
			                foreach($lojas as $loj){
			                    if($cai['loja_id'] == $loj['id_loja']){
			                        foreach($estados as $est){
			                            if($est['id_estado'] == $loj['estado_id']){
			                                ?><td><?php echo $loj['nome_loja'] . ' - ' . $est['uf_estado']?></td><?php
			                            }
			                        }
			                    }            
			                }
				            ?>
				            <td class="text-center"><?php echo $cai['abertura_caixa']?></td>
				            <td class="text-center"><?php echo $cai['fechamento_caixa'] ?></td>
				            <td class="text-center"><?php echo $cai['reabertura_data'] ?></td>
				            <?php foreach($funcionarios as $usu){ 
				                    if($cai['funcionario_id'] == $usu['id_funcionario']){
				            ?>
				            <td class="text-center"><?php echo $usu['nome_funcionario'] ?></td>            
				            <?php } } ?>
				            <td class="text-center">R$ <?php echo $cai['troco_inicial']?></td>
				            <td class="text-center">R$ <?php echo $cai['troco_atual']?>&nbsp&nbsp
				                <?php if($cai['limite_caixa'] != 0 && $cai['troco_atual'] >= $cai['limite_caixa']){ ?>
					                <a data-toggle="modal" data-target="#modalQuestion" class="btn btn-primary"><em class="fa fa-question-circle"></em></a>
					            <?php } ?>
				            </td >
				            <td class="text-center">
				                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('Contas/telareDespesas/') . $cai['id_caixa']?>">Despesas</a></li>
                                        <li><a href="<?php echo base_url('Caixa/reencerrarCaixa/') . $cai['id_caixa']?>">Fechar Caixa</a></li>
                                    </ul>
                                </div>
						    </td>
				        </tr>
				        <?php } ?>
				    </tbody>
				 </table>
				 </div>
				 <?php } else { ?>
				    <h3 class="page-header">Não há caixas abertos</h3>
				 <?php } ?>
			<?php } ?>
			</div>
			<div class="panel-footer">
                <?php if($erro == 1){?> <h4 class="text-danger">Essa loja já possui caixa aberto!</h4><?php }?>
			</div>
		</div>
	</div>
</div>-->

<?php if($this->session->userdata('tipo_pessoa') == 3){ ?>
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
                <form id="modalExemplo" method="post" action="<?php echo base_url('admin/Caixa/adicionarCaixa') ;?>">
                    <input type="hidden" name="addid" id="addid">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="valor">Valor de troco inicial: </label><br>
                            <input class="form-control" type="text" name="valor" id="valor" required><br><br>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="limite">Limite permitido em Caixa: </label><br>
                            <select style="width: 100%" class="js-example-basic-multiple form-control" name="select_limite" id="select_limite" required onchange="verSelect($(this).val())">
                                <option value='2'>Não</option>
                                <option value='1'>Sim</option>
                                
                            </select>
                            <div class="form-group" id="lim" name="lim" style="display: none;">
                                <br>
                                <label>Valor: </label>
                                <input class="form-control" type="text" name="limite" id="limite"><br><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Abrir Caixa</button>
                </form>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            
            </div>
        </div>
    </div>
 </div>
</div>
<?php } ?>
<?php if($this->session->userdata('tipo_pessoa') == 1 || $this->session->userdata('tipo_pessoa') == 4){ ?>
<div class="modal" id="modalAdd2">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                <form id="modalExemplo" method="post" action="<?php echo base_url('admin/Caixa/adicionarCaixa2') ;?>">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="hidden" name="addid" id="addid">
                            <label for="loja">Selecione a Loja: </label><br>
                            <select style="width: 100%" class="js-example-basic-multiple form-control" id="loja" name="loja" required>
                            <?php 
                                echo "<option value='' selected disabled hidden>Selecione a Loja</option>";
                                foreach($lojas as $loj){
                                    foreach($estados as $est){
                                        if($loj['estado_id'] == $est['id_estado']){
                                            foreach($cidades as $cid){
                                                if($cid['id_cidade'] == $loj['cidade_id']){
                                                    echo "<option value='" . $loj['id_loja'] . "'>".$loj['nome_loja'] . ", " . $cid['nome_cidade'] . " - " . $est['uf_estado'] . "</option>";
                                                }
                                            }
                                        }
                                    }
                                } 
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="valor">Valor de troco inicial: </label><br>
                            <input class="form-control" type="text" name="valor" id="valor" required><br><br>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="limite">Limite permitido em Caixa: </label><br>
                            <select style="width: 100%" class="js-example-basic-multiple form-control" name="select_limite" id="select_limite" required onchange="verSelect($(this).val())">
                                <option value='2'>Não</option>
                                <option value='1'>Sim</option>
                                
                            </select>
                            <div class="form-group" id="lim" name="lim" style="display: none;">
                                <br>
                                <label>Valor: </label>
                                <input class="form-control" type="text" name="limite" id="limite" value="0"><br><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Abrir Caixa</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="modal" id="modalQuestion">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
          <h3>Valor limite que o caixa pode conter excedido, por favor execute uma sangria!</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>

<script>
    function verSelect(valor){
        if(valor == 1){
            document.getElementById('lim').style.display = 'block';
        }else if(valor == 2){
            document.getElementById('lim').style.display = 'none';
            document.getElementById('limite').value = '0';
        }
    }

</script>