
<style>
    .tableFixHead          { overflow-y: auto; height: 350px; }
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
		<h1 class="page-header">Nova Devolução</h1>
	</div>
</div><!--/.row-->

<div class="row" <?php if(isset($devo)){echo "onload=''";} ?>>
	<div class="col-md-12">
		<div class="panel panel-default">
			
			<div class="panel-body">
			    
                <div class="row">
                    <div class="col-md-12">
                        <label>Decrição da Devolução:</label><br>
                        <textarea type="text" class="form-control" placeholder="Insira aqui a descrição" id="desc" name="desc" rows="3" required><?php if(isset($devo)){echo $devo['obs_dc'];}?></textarea>
                    </div>
                </div><br>
                
                <div class="row">
                    <div class="col-md-12">
                        <label>Cliente:</label><br>
                        <select class="js-example-basic-multiple form-control" id="cliente" name="cliente" style="width:100%">
                            <option value='' selected disabled hidden>Selecione o Cliente</option>
                            <?php 
                                foreach($clientes as $cli){
                                    echo "<option ";
                                    if(isset($devo) && $cli['id_cliente'] == $devo['cliente_id']){echo " selected ";}
                                    echo " value='" . $cli['id_cliente'] . "'>" . $cli['nome_cliente'] . " | " . $cli['cpfcnpj_cliente'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div><br>
                
                <div class="row" id="erro5" style="display:none;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Por favor preencha a descrição!</div>
                    </div>
                </div><br><hr>
                
                <div class="row" id="erro1" style="display:none;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Por favor preencha os campos antes de inserir um produto!</div>
                    </div>
                </div>
                
                <div class="row" id="erro4" style="display:none;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Não foi possível encontrar o produto!</div>
                    </div>
                </div>
                
                <label style="font-size: 18px; color: black">Informações dos Produtos</label>
                <div class="row">
                    <div class="col-md-6" style="margin-top:10px">
                        <label>Produto:</label><br>
                        <select class="js-example-basic-multiple form-control" id="prod" name="prod" style="width:100%" onchange="pegaValor($(this).val())">
                            <option value='' selected disabled hidden>Selecione o Produto</option>
                            <?php foreach($estoques as $row) {
                                foreach($produtos as $prod){
                                    if($prod['id_produto'] == $row['produto_id']){
                                        foreach($cores as $cor){
                                            if($cor['id_cor'] == $row['cor_produto']){
                                                if($this->session->userdata('tipo_pessoa') == 3){
                                                    if($this->session->userdata('loja_id') == $row['loja_id']){
                                                        echo "<option value='" . $row['id_estoque'] . "' > " . $prod['nome_produto'] . " | " . $row['modelo_produto'] . " | " . $cor['nome_cor'] . "</option>";
                                                    }
                                                }else{
                                                    echo "<option value='" . $row['id_estoque'] . "' > " . $prod['nome_produto'] . " | " . $row['modelo_produto'] . " | " . $cor['nome_cor'] . "</option>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }?>
                        </select>
                    </div>
                    <div class="col-md-5" style="margin-top:10px">
                        <label>Quantidade:</label><br>
                        <input type="number" class="form-control" id="qtde" name="qtde" placeholder="Ex.: 1" onchange="valorTotal($(this).val())">
                    </div>
                    <div class="col-md-1" style="margin-top: 35px">
                        <a class="btn btn-primary"><em class="fa fa-search"></em></a>
                    </div>
                </div><br>
                <div class="row" style="display:none" id="erroqtde">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Selecione um produto e/ou informe uma quantidade válida!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        <label>Valor:</label>
                        <input type="text" class="form-control" placeholder="R$ 0,00" id="valor" name="valor" disabled required>
                    </div>
                    <div class="col-md-1" style="margin-top: 25px">
                        <?php if(isset($devo)){ ?>
                        <a class="btn btn-primary" onclick="buscarProduto2()">Add</a>
                        <?php }else{ ?>
                        <a class="btn btn-primary" onclick="buscar()">Add</a>
                        <?php } ?>
                    </div>
                </div>
			</div>
			<div class="panel-footer">
			    <div class="row" id="erro2" style="display:none;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Por favor insira a linha que deseja retirar!</div>
                    </div>
                </div>
                <div class="row" id="erro3" style="display:none;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Não foi possível retirar a linha informada!</div>
                    </div>
                </div>
			    <br>
			    <div class="row" id="erro6" style="display:none">
                    <div class="col-md-12">
                        <div class="alert alert-danger">Valor total da soma dos itens excede o valor atual em caixa!</div>
                    </div>
                </div>
    		    <br>
			    <div class="tableFixHead" id="tablefix">
					<table id="myTableSemRecurso" class="table table-hover table-bordered">
					    <thead>
					        <tr>
					            <th>Linha</th>
					            <th>Código</th>
					            <th>Produto</th>
					            <th>Qtde</th>
					            <th>Valor</th>
					            <th>Ação</th>
					        </tr>
					    </thead>
					    <tbody id="corpo">
					        <?php if(isset($devo)){$aux = 1; 
					            foreach($itens as $itn){
					                foreach($estoques as $est){
					                    if($est['id_estoque'] == $itn['estoque_id']){
					                        foreach($produtos as $prod){
					                            if($prod['id_produto'] == $est['produto_id']){
					                           ?>
					                                <tr>
					                                    <td><?php echo $aux; ?></td>
					                                    <td><?php echo $est['id_estoque'] ?></td>
					                                    <td><?php echo $prod['nome_produto'] ?></td>
					                                    <td><?php echo $itn['quantidade'] ?></td>
					                                    <td><?php echo $itn['valor'] ?></td>
					                                    <td><button onclick="deletaExistente(<?php echo $itn['id_idc'] ?>, <?php echo $aux; ?>)" class="btn btn-primary"><em class='fa fa-trash'></em></button></td>
					                                </tr>
					                           <?php
					                            $aux++;}
					                        }
					                    }
					                }
					            }
					        }?>
					    </tbody>
					 </table>
				</div>
			</div>
			<div class="row" id="divtotal" style="display:none">
                <div class="col-md-12" style="font-size:18px; margin-left: 16px; margin-right: 16px">
                    <label>Valor total: &nbspR$</label><label id="totalfinal"></label>
                </div>
            </div>
		    <br>
			
			<div class="row text-center">
			    <br><a class="btn btn-primary" onclick="<?php if(isset($devo)){echo "validaPreco2(" . $devo['id_dc'] . ")";}else{echo "validaPreco()";}?>"><?php if(isset($devo)){echo 'Atualizar Devolução';}else{echo 'Finalizar Devolução';}?></a>&nbsp&nbsp&nbsp&nbsp
			    
			    <a href="<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa'] ?>" class="btn btn-primary">Voltar</a><br><br>
			</div>
		</div>
		
	</div><!--/.col-->
</div>	

<script>
    var table = document.getElementById("myTableSemRecurso");
    var table2 = document.getElementById("corpo");
    var add = 0;
    var aux = 0;
    var aux2 = <?php if(isset($devo)){echo count($itens);}else{echo 0;} ?>;
    var aux3 = <?php if(isset($devo)){echo count($itens);}else{echo 0;} ?>;
    var produto;
    var posicaotabela = 0;
    var posicaotabela2 = <?php if(isset($devo)){echo count($itens);}else{echo 0;} ?>;
    var caixaid = <?php echo $caixa['id_caixa'] ?>;
    var total = 0;

    //busca o produto no banco de dados e insere dinamicamente na tabela
    function buscar(){
        var dados = new FormData();
        dados.append('codigo', document.getElementById('prod').value);
        
        $.ajax({
            url: '<?php echo base_url('devolucao/produto/'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == "null"){
                    document.getElementById( 'erro4' ).style.display = 'block';
                }else{
                    document.getElementById( 'erro4' ).style.display = 'none';
                    produto = jQuery.parseJSON(data);
                    if(document.getElementById('qtde').value == "" || document.getElementById('prod').value == "" || document.getElementById('valor').value == ""){
                        document.getElementById( 'erro1' ).style.display = 'block';
                    }else{
                        document.getElementById( 'erro1' ).style.display = 'none';
                        document.getElementById( 'divtotal' ).style.display = 'block';
                        valor = document.getElementById('valor').value;
                        valor = valor.replace(',', '.');
                        total = parseFloat(total) + parseFloat(valor);
                        document.getElementById('totalfinal').innerHTML = total.toFixed(2);
                        aux++;
                        posicaotabela++;
                        
                        var row = table.insertRow(posicaotabela);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        cell1.innerHTML = aux;
                        cell2.innerHTML = document.getElementById('prod').value;
                        cell4.innerHTML = document.getElementById('qtde').value;
                        cell5.innerHTML = document.getElementById('valor').value;
                        cell6.innerHTML = "<button class='btn btn-primary' onclick='deletarProduto(" + aux + ")'><em class='fa fa-trash'></em></button>";
                        
                        var nome = produto.nome_produto;
                        cell3.innerHTML = nome;
                        add = 1;
                        
                        var objDiv = document.getElementById("tablefix");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                }
        
            },
        });
    }
    
    //busca o produto no banco de dados e insere dinamicamente na tabela
    function buscarProduto2(){
        var dados = new FormData();
        dados.append('codigo', document.getElementById('prod').value);
        
        $.ajax({
            url: '<?php echo base_url('devolucao/produto/'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == "null"){
                    document.getElementById( 'erro4' ).style.display = 'block';
                }else{
                    document.getElementById( 'erro4' ).style.display = 'none';
                    produto = jQuery.parseJSON(data);
                    if(document.getElementById('qtde').value == "" || document.getElementById('prod').value == "" || document.getElementById('valor').value == ""){
                        document.getElementById( 'erro1' ).style.display = 'block';
                    }else{
                        document.getElementById( 'erro1' ).style.display = 'none';
                        document.getElementById( 'divtotal' ).style.display = 'block';
                        valor = document.getElementById('valor').value;
                        valor = valor.replace(',', '.');
                        total = parseFloat(total) + parseFloat(valor);
                        document.getElementById('totalfinal').innerHTML = total.toFixed(2);
                        aux2++;
                        posicaotabela2++;
                        
                        var row = table.insertRow(posicaotabela2);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        cell1.innerHTML = aux2;
                        cell2.innerHTML = document.getElementById('prod').value;
                        cell4.innerHTML = document.getElementById('qtde').value;
                        cell5.innerHTML = document.getElementById('valor').value;
                        cell6.innerHTML = "<button class='btn btn-primary' onclick='deletarProduto(" + aux2 + ")'><em class='fa fa-trash'></em></button>";
                        
                        add = 1;
                        var nome = produto.nome_produto;
                        cell3.innerHTML = nome;
                        
                        var objDiv = document.getElementById("tablefix");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                }
        
            },
        });
    }
    
    //Pega o id do produto digitado e o exclui da tabela
    function deletarProduto(linha){
        var id = linha;
        var deletou = false;
        
        if(id == ""){
            document.getElementById( 'erro2' ).style.display = 'block';
        }else{
            document.getElementById( 'erro2' ).style.display = 'none';
            
            for (i=0; i < table.rows.length; i++){
                colunas = table.rows[i].childNodes;
                
                if(colunas[0].innerHTML == id){
                    total = document.getElementById('totalfinal').innerHTML;
                    total = parseFloat(total) - parseFloat(colunas[4].innerHTML);
                    document.getElementById('totalfinal').innerHTML = total.toFixed(2);
                    deletou = true;
                    posicaotabela--;
                    table.deleteRow(i);
                }
            }

        }
        
        if(deletou == false){
            document.getElementById( 'erro3' ).style.display = 'block';
        }else{
            document.getElementById( 'erro3' ).style.display = 'none';
        }
    }
    
    //função que exclui um existente
    function deletaExistente(id, posicao){
        var dados = new FormData();
        dados.append('id', id);
        dados.append('caixaid', caixaid);
        $.ajax({
            url: '<?php echo base_url('caixa/excluirItem'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == "null"){
                    alert('Erro');
                }else{
                    table.deleteRow(posicao);
                }
        
            },
        });
    }
    var troco_atual = <?php echo $caixa['troco_atual'] ?>;
    
    function validaPreco(){
        var totalfinal = 0;
        valor = document.getElementById('valor').value;
        valor = valor.replace(',', '.');
        totalfinal = valor;
        if(totalfinal > troco_atual){
            document.getElementById( 'erro6' ).style.display = 'block';
        }else{
            document.getElementById( 'erro6' ).style.display = 'none';
            finalizaDevo();
        }
    }
    
    function validaPreco2(id){
        var totalfinal = 0;
        valor = document.getElementById('valor').value;
        valor = valor.replace(',', '.');
        totalfinal = valor;
        if(totalfinal > troco_atual){
            document.getElementById( 'erro6' ).style.display = 'block';
        }else{
            document.getElementById( 'erro6' ).style.display = 'none';
            finalizaDevo2(id);
        }
    }
    
    //insere a nova devolução no banco e seus itens
    function finalizaDevo(){
        var dados;
        var verifica = document.getElementById('desc').value;
        var verifica2 = document.getElementById('cliente').value;
        
        if(verifica == '' || verifica2 == ''){
            document.getElementById( 'erro5' ).style.display = 'block';
        }else{
            document.getElementById( 'erro5' ).style.display = 'none';
            dados = new FormData();
            dados.append('descricao_devolucao', document.getElementById('desc').value);
            dados.append('cliente_id', document.getElementById('cliente').value);
            dados.append('caixa_id', caixaid);
            $.ajax({
                url: '<?php echo base_url('caixa/adicionaDevolucao/'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data != "null"){
                        inf = jQuery.parseJSON(data);
                        auxInsere();
                    }else{
                        alert("Erro na banco");
                    }
                },
            });
        }
    }
    
    function auxInsere(){
        var dados2;
            
        for (i=1; i <= table.rows.length; i++){
            colunas = table.rows[i].childNodes;
            dados2 = new FormData();
            dados2.append('dc_id', inf.id);
            dados2.append('estoque_id', colunas[1].innerHTML);
            dados2.append('quantidade', colunas[3].innerHTML);
            dados2.append('valor', colunas[4].innerHTML);
            dados2.append('caixa_id', caixaid);
            $.ajax({
                url: '<?php echo base_url('caixa/insereProdutos/'); ?>',
                method: 'post',
                data: dados2,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data != "null"){
                        window.location.href = '<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa']?>';
                    }else{
                        alert("Erro no Banco de Dados");
                    }
                },
            });
        }
    }
    
    //atualiza uma devolução no banco e seus itens
    function finalizaDevo2(id){
        var dados;
        var verifica = document.getElementById('desc').value;
        var verifica2 = document.getElementById('cliente').value;
        var x = table.rows.length;
        
        if(verifica == '' || verifica2 == ''){
            document.getElementById( 'erro5' ).style.display = 'block';
        }else{
            document.getElementById( 'erro5' ).style.display = 'none';
            dados = new FormData();
            dados.append('id', id);
            dados.append('descricao_devolucao', document.getElementById('desc').value);
            dados.append('cliente_id', document.getElementById('cliente').value);
            $.ajax({
                url: '<?php echo base_url('caixa/atualizaDevolucao'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data != "null"){
                        if(add == 1){
                            auxAtualiza();
                        }else if(add == 0){
                            window.location.href = '<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa']?>';
                        }
                    }else{
                        alert("Erro na banco");
                    }
                },
            });
        }
    }
    
    function auxAtualiza(){
        var dados2;
        for (i=aux3+1; i <= table.rows.length; i++){
            colunas = table.rows[i].childNodes;
            dados2 = new FormData();
            var id = <?php if(isset($devo)){ echo $devo['id_dc'];}else{echo 0;} ?>;
            dados2.append('dc_id', id);
            dados2.append('estoque_id', colunas[1].innerHTML);
            dados2.append('quantidade', colunas[3].innerHTML);
            dados2.append('valor', colunas[4].innerHTML);
            dados2.append('caixa_id', caixaid);
            $.ajax({
                url: '<?php echo base_url('caixa/insereProdutos/'); ?>',
                method: 'post',
                data: dados2,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data != "null"){
                        window.location.href = '<?php echo base_url('caixa/telaDevolucoes/') . $caixa['id_caixa']?>';
                    }else{
                        alert("Erro no Banco de Dados");
                    }
                },
            });
        }
    }
    
    
    function pegaValor(id){
        var dados = new FormData();
        dados.append('id', id);
        $.ajax({
            url: '<?php echo base_url('caixa/pegaValor'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == "null"){
                    alert('Erro');
                }else{
                    document.getElementById('valor').value = data;
                }
        
            },
        });
    }
    
    function valorTotal(qtde){
        var id = document.getElementById('prod').value;
        var qtde = qtde;
        if(id != null && (qtde != null || qtde != 0)){
            var dados = new FormData();
            dados.append('id', id);
            dados.append('qtde', qtde);
            $.ajax({
                url: '<?php echo base_url('caixa/valorTotal'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data == "null"){
                        alert('Erro');
                    }else{
                        document.getElementById('valor').value = data;
                    }
            
                },
            });
        }else{
            document.getElementById('erroqtde').style.display = "block";
        }
    }
</script>