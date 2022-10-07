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

