<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Cell Store - Admin</title>
    	<link href="<?php echo base_url('resources/pages/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" />
    	<link href="<?php echo base_url('resources/pages/select2/dist/css/select2-bootstrap.min.css'); ?>" rel="stylesheet" />
    	<link href="<?php echo base_url('resources/pages/css/bootstrap.min.css'); ?>" rel="stylesheet">
    	<link rel="stylesheet" href="<?php echo base_url('resources/pages/css/font-awesome.min.css'); ?>">
    	<link href="<?php echo base_url('resources/pages/css/datepicker3.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('resources/pages/css/styles.css'); ?>" rel="stylesheet">
    	<script src="<?php echo base_url('resources/pages/js/jquery-1.11.1.min.js')?>"></script>
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    	
    	<!--Custom Font-->
    	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    	<!--[if lt IE 9]>
    	<script src="js/html5shiv.js"></script>
    	<script src="js/respond.min.js"></script>
    	<![endif]-->
    </head>
<body style="padding-top: 20px; background-color: white;">
    <!-- NAV -->
	
	<div class="col-sm-12 main">

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-4 col-md-offset-4 text-center" style="border: 2px solid black; background-color: white; padding: 0px;">
        <h3>CELLSTORE DISTRIBUIDORA</h3>
        <p>=====================================================</p>
        <h3>CONFERÊNCIA DE PRODUTOS</h3>
        <p>=====================================================</p>
        <div style="padding-left: 15px;">
            <p class="text-left"><b>NÚMERO DO PEDIDO: </b><?php echo $compra['id_compra']?></p>
            <p class="text-left"><b>NOTA DE VENDA: </b><?php echo $compra['nota_venda']?></p>
            <p class="text-left"><b>DATA: </b><?php echo $compra['data_compra']?></p>
            <p class="text-left"><b>CLIENTE: </b><?php echo $cliente['nome_cliente']?></p>
            <p class="text-left"><b>LOJA: </b><?php echo $loja['endereco_loja']?></p>
            <p class="text-left"><b>VENDEDOR: </b><?php echo $funcionario['nome_funcionario']?></p>
        </div>
        <p>=====================================================</p>
        
        <div style="padding-left: 15px; padding-right: 15px;">
            <table id="myTable2" class="table table-hover table-bordered" >
    		    <thead>
    		        <tr style="border-style: dotted;">
    		            <th>PRODUTO</th>
    		            <th>QTDE</th>
    		            <th>Valor Unitário</th>
    		            <th>Valor Total</th>
    		        </tr>
    		    </thead>
    		    <tbody>
    		        <?php $aux=0; foreach($listas as $row){
    		            echo"<tr style='border-style: dotted;'>
    		                <td>" . $produtos[$aux]['nome_produto'] . "</td>
    		                <td>" . $row['produto_qtd'] . "</td>
    		                <td>" . number_format($row['produto_valor'],2,',','.') . "</td>
    		                <td>" . number_format($row['produto_valorfinal'],2,',','.') . "</td>
    		            </tr>";
    		            $aux++;
    		        }?>
    		    </tbody>    
    		</table>
		</div>
		<p>=====================================================</p>
		<div class="row" style="padding-left: 15px; padding-right: 15px;">
            <div class="col-xs-6">
                <h4 class="text-left">TOTAL</h4>
            </div>
            <div class="col-xs-6">
                <h4 style="float: right;">R$ <?php echo number_format($compra['valor_compra'],2,',','.')?></h4>
            </div>    
        </div>
    </div>
    <div class="row">
        <form action="<?php echo base_url('pdv/geraPDF'); ?>" role="form" method="post">
            <input type="hidden" class="form-control" id="idcompra" name="idcompra" value="<?php echo $compra['id_compra'] ?>">
            <input type="hidden" class="form-control" id="notavenda" name="notavenda" value="<?php echo $compra['nota_venda'] ?>">
            <input type="hidden" class="form-control" id="datacompra" name="datacompra" value="<?php echo $compra['data_compra'] ?>">
            <input type="hidden" class="form-control" id="nomecliente" name="nomecliente" value="<?php echo $cliente['nome_cliente'] ?>">
            <input type="hidden" class="form-control" id="enderecoloja" name="enderecoloja" value="<?php echo $loja['endereco_loja'] ?>">
            <input type="hidden" class="form-control" id="nomefuncionario" name="nomefuncionario" value="<?php echo $funcionario['nome_funcionario'] ?>">
            <input type="hidden" class="form-control" id="listas" name="listas" value="<?php echo $listas ?>">
            <input type="hidden" class="form-control" id="produtos" name="produtos" value="<?php echo $produtos ?>">
            <button type="submit" class="btn btn-primary"><em class="fa fa-print" aria-hidden="true"></em></button>
        </form>
    </div>
</div>

		</div><!-- /.row -->
                
        </div>
        <!-- FIM MAIN DIV -->

        <script src="<?php echo base_url('resources/pages/js/jquery-1.11.1.min.js')?>"></script>
        <script src="<?php echo base_url('resources/pages/select2/dist/js/select2.min.js'); ?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/bootstrap.min.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/chart.min.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/chart-data.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/easypiechart.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/easypiechart-data.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/bootstrap-datepicker.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/custom.js')?>"></script>
    	<script src="<?php echo base_url('resources/pages/js/jquery.mask.js')?>"></script>
    	<script type="text/javascript" charset="utf8" src="<?php echo base_url('resources/pages/datatable/js/jquery.dataTables.js')?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('resources/pages/datatable/js/jquery.dataTables.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/pages/datatable/js/dataTables.bootstrap.min.js');?>"></script>
    </body>
    <!-- FIM BODY -->
</html>
