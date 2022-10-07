<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Cell Store - Fechamento</title>
    	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    </head>
<body style="background-color: white;" onload="window.print()">
    <div>
        <table style="width: 100%; background-color: white">
            <thead>
                <tr>
                    <th style="width: 25%"></th>
                    <th></th>
                    <th></th>
                    <th style="width: 25%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?php echo base_url('imagens/site/logo2.png');?>" style="width: 160px; flex: left"></td>
                    <td colspan="2" style="text-align: center"><h3 style="display: inline; color: black;">Fechamento de Caixa - Resumo</h3></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <p style="text-align: center; color: black; font-size: 18px">Loja: <?php echo $loja['loja']['nome'];?>
        <br><?php echo $loja['loja']['rua'].", ".$loja['loja']['numero']." - ".$loja['loja']['bairro']."/".$loja['loja']['cidade']."" ;?>
        <br>Telefone: <?php echo $loja['loja']['telefone'];?></p>
    </div>
    <div class="row">
        <p style="color: black; font-size: 18px; text-align:center">Vendas - <?php echo $dia;?></p>
        <table id="myTable" class="table table-hover table-bordered center" style="margin-left:auto; margin-right:auto">
            <thead>
                <tr>
                    <th style="border:1px solid black; text-align: center">Nº Venda</th>
    	            <th style="border:1px solid black; text-align: center">Vendedor</th>
    	            <th style="border:1px solid black; text-align: center">Cliente</th>
    	            <th style="border:1px solid black; text-align: center">Valor</th>
    	            <th style="border:1px solid black; text-align: center">Pagamento</th>
    	            <th></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<count($vendas); $i++){?>
                <tr>
                    <th style="border:1px solid black; text-align: center"><?php echo $vendas[$i]['id'];?></th>
    	            <th style="border:1px solid black; text-align: center"><?php echo $vendas[$i]['vendedor'];?></th>
    	            <th style="border:1px solid black; text-align: center"><?php echo $vendas[$i]['cliente'];?></th>
    	            <th style="border:1px solid black; text-align: center"><?php echo $vendas[$i]['valor'];?></th>
    	            <th style="border:1px solid black; text-align: center"><?php echo $vendas[$i]['pagamento'];?></th>
        	        <?php if(array_key_exists('multi', $vendas[$i])){?>
        	            <th style="background-color: lightgrey; text-align: center"><?php echo $vendas[$i]['loja'];?></th>
        	        <?php }?>
    	        </tr>
    	        <?php }?>
            </tbody>
        </table>
        <?php foreach($formas as $cash){?>
        <p style="color: black; font-size: 18px; text-align:center">Total de Vendas em <?php echo $cash['forma']." - ".$cash['valor'];?></p>
        <?php }?>
    </div>
</body>
    <!-- FIM BODY -->
<script type="text/javascript">
     window.onafterprint = window.close;
     window.print();
</script>    
</html>