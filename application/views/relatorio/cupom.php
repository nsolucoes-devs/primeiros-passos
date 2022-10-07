<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Cell Store - Cupom</title>
    	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>
<body style="background-color: white;" syle="max-width: 100%; overflow-x: hidden" onload="window.print()">
    <div class="container">
        <div class="row align-items-center justify-content-center mb-3">
            <div class="w-50 my-2">
                <img src="<?php echo base_url('imagens/site/logo2.png');?>" style="width: 100%">
            </div>
            <div class="w-100 text-center my-2">
                <h3 style="display: inline; color: black;">Cupom Não Fiscal</h3>
            </div>
        </div>
        <div class="row">
           <div class="col-md-6 col-sm-6 col-6">
                <p class="text-capitalize" style="color: black; font-size: 18px">Loja: <small><?php echo $loja['nome'];?></small></p>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <p class="text-end" style="color: black; font-size: 18px"><small><?php echo $loja['rua'].", ".$loja['numero']." - ".$loja['bairro']."/".$loja['cidade']."" ;?></small></p>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <p class="text-capitalize" style="color: black; font-size: 18px">Telefone: <small><?php echo $loja['telefone'];?></small></p>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <p class="text-end" style="color: black; font-size: 18px">Vendedor: <small><?php echo $vendedor;?></small></p>
            </div>
        </div>
        <br>
        <div class="row">
            <table id="myTable" class="table table-hover table-bordered center">
                <thead>
                    <tr>
        	            <th style="text-align: center;">#</th>
        	            <th style="text-align: center;">Produto</th>
        	            <th style="text-align: center;">Qtde</th>
        	            <th style="text-align: center;">Valor Unit.</th>
        	            <th style="text-align: center;">Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sum = $vol = 0; $aux = 1; foreach($venda as $ven){?>
                    <tr>
                        <th style="text-align: center;"><?php echo $aux;?></th>
        	            <th style="text-align: center;"><?php echo $ven['produto'];?></th>
        	            <th style="text-align: center;"><?php echo $ven['qtd'];?></th>
        	            <th style="text-align: center;"><?php echo number_format($ven['valUn'],2,",",".");?></th>
        	            <th style="text-align: center;"><?php echo number_format($ven['valTot'],2,",",".");?></th>
        	        </tr>
        	        <?php $sum += $ven['valTot'];
        	        $aux++;
        	        $vol += $ven['qtd'];}?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">TOTAL DE ITENS:</p>
                <p class="m-0"><?php echo $vol;?></p>
            </div>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">VALOR TOTAL:</p>
                <p class="m-0">R$ <?php echo number_format($sum, 2, ',', ' ');?></p>
            </div>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">DESCONTO:</p>
                <p class="m-0">R$ <?php echo number_format($desconto, 2, ',', ' ');?></p>
            </div>
            <?php if(isset($acrescimo)) { ?>
                <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                    <p class="m-0">ACRESCIMO DO CARTAO:</p>
                    <p class="m-0">R$ <?php echo number_format($acrescimo, 2, ',', ' ');?></p>
                </div>
            <?php } ?>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">FRETE:</p>
                <p class="m-0">R$ <?php echo number_format($frete, 2, ',', ' ');?></p>
            </div>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">VALOR FINAL:</p>
                <p class="m-0">R$ <?php echo number_format($lastValue, 2, ',', ' ');?></p>
            </div>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="m-0">PAGAMENTO:</p>
                <p class="m-0"><?php echo $pagamento;?></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="mb-0 mx-2">Cliente: </p>
                <p class="text-end mb-0 mx-2"><?php echo $cliente['cliente_nome'];?></p>
            </div>
            <div class="col-md-12 d-flex justify-content-between" style="color: black; font-size: 14px">
                <p class="mb-0 mx-2">Endereco: </p>
                <p class="text-end mb-0 mx-2">
                    <?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero'];?>
                    <br>
                    <?php echo $cliente['cliente_bairro'].', '.$cliente['cliente_cidade'].'-'.$cliente['cliente_estado'];?>
                    <br>
                </p>
            </div>
        </div>
    </div>
        
</body>
    <!-- FIM BODY -->
<script type="text/javascript">
     window.onafterprint = window.close;
     window.print();
</script>
</html>