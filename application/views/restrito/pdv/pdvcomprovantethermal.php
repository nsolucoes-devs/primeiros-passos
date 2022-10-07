<!DOCTYPE html>
<html>
    <head>
    </head>
<body style="padding-top: 20px; background-color: white;">
    <?php
        function mask($val, $mask){
             $maskared = '';
            $k = 0;
            for($i = 0; $i<=strlen($mask)-1; $i++){ if($mask[$i] == '#') { if(isset($val[$k])) 
                $maskared .= $val[$k++];
                     }
            else {
                if(isset($mask[$i]))
                     $maskared .= $mask[$i];
            }
         }    
         return $maskared;
    }
?>
    <!-- NAV -->
	
<div class="row" style="margin-bottom: 30px; font-size: 8px; font-family: Arial, Helvetica, sans-serif;">
    <div style="padding-left: 5px; padding-right: 5px;">
        <h2><p style="font-size:12px; font-weight: bold; text-align: center">CELLSTORE DISTRIBUIDORA</p></h2>
        <p style="padding:-15px 5px; font-size:7px; text-align: left">LOJA: <?php echo $loja['nome_loja']." | ".$cidade['nome_cidade']." | ".$estado['uf_estado'];?><br>
        CNPJ: <?php echo mask($loja['cnpj_loja'], '##.###.###/####-##');?><br>
        TELEFONE: <?php $aux=0; foreach($telefone as $tel){if($aux<=3){ echo mask($tel['fone_contato'], '(##)#####-####'); if($aux<3){echo " | "; }}$aux++;}?></p>
        <br>
        <p>===========================</p>
        <p style="font-size:10px; font-weight: bold; text-align: center">COMPROVANTE DE COMPRA</p>
        <p>===========================</p>
        <div style="font-size: 7px; font-weight: bold;">
            <b class="text-left"> NOTA DE VENDA: <?php echo $compra['nota_venda']?></b><br>
            <b class="text-left"> DATA: <?php echo date('d/m/Y')?></b><br>
            <b class="text-left"> CLIENTE: <?php echo $cliente['nome_cliente']?></b><br>
            <b class="text-left"> VENDEDOR: <?php echo $funcionario['nome_funcionario']?></b>
        </div>
        <p>===========================</p>
        
        <div>
            <table id="myTable2" class="table table-hover table-bordered" style="font-size: 8px" >
    		    <thead>
    		        <tr style="border-style: dotted; ">
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center">PRODUTO</p></th>
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center">MODELO</p></th>
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center">OPÇÃO</p></th>
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center;">QTDE</p></th>
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center">Valor Unitário</p></th>
    		            <th><p style="font-size:5px; font-weight: bold; text-align: center">Valor Total</p></th>
    		        </tr>
    		    </thead>
    		    <tbody>
    		        <?php $aux=0; foreach($listas as $row){
    		            echo"<tr style='border-style: dotted;'>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; text-align: center'>" . $produtos[$aux]['nome_produto'] . "</p></td>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; text-align: center'>" . $produtos[$aux]['modelo'] . "</p></td>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; text-align: center'>" . $produtos[$aux]['opcao'] . "</p></td>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; align:right'>" . $row['produto_qtd'] . "</p></td>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; align:right'>" . number_format($row['produto_valor'],2,',','.') . "</p></td>
    		                <td style='text-align: center; vertical-align: middle;'><p style='font-size:5px; font-weight: bold; align:right'>" . number_format($row['produto_valorfinal'],2,',','.') . "</p></td>
    		            </tr>";
    		            $aux++;
    		        }?>
    		    </tbody>    
    		</table>
		</div>
		<p>===========================</p>
		<div class="row">
            <div class="col-xs-4">
                <?php if($compra['acrescimo_compra'] != 0){?>
                    <p style="font-size:8px; font-weight: bold; text-align: left">ACRÉSCIMO: R$ <?php echo number_format($compra['acrescimo_compra'],2,',','.')?></p>
                <?php }?>
                <?php if($compra['desconto_compra'] != 0){?>
                    <p style="font-size:8px; font-weight: bold; text-align: left">DESCONTO: R$ <?php echo number_format($compra['desconto_compra'],2,',','.')?></p>
                <?php }?>
                
                <p style="font-size:8px; font-weight: bold; text-align: left">TOTAL: R$ <?php echo number_format($total,2,',','.')?>
                

                <br><br>PAGAMENTO: <?php echo $forma?></p>
            </div>    
        </div>
        <br><br>
        <br><br>
        <br><br>
        <div class="row">
            <div class="col-xs-4">
                <p style="font-size:6px; font-weight: bold; text-align: center">GESTÃO DE LOJAS - NSOLUÇÕES - www.nsolucoes.digital</p>
            </div>    
        </div>
    </div>
</div>
</body>
    <!-- FIM BODY -->
</html>
