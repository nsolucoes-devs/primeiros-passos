<style>
    .tableFixHead thead th { position: sticky; top: 0; }
    
    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }
</style>

<div class="row">
    <div class="col-md-4">
        
        <!-- Dados do Produto -->
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="<?php echo base_url('pdv/voltarPdv/'). $idCompra;?>" class="btn btn-primary" style="width: 100%">VOLTAR</a>
                </div>
                <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erro">
                    Produto não encontrado!
                </div>
                <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erro2">
                    Preencha todos os campos!
                </div>
                <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erroEstoque">
                    Estoque insuficiente!
                </div>
                <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erroEstoque2">
                    Quantidade mínima por venda não atingida!
                </div>
                <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erroData">
                    Produto ainda não disponível
                </div>
                <div class="form-group">
                    <label>Produto</label>
                    <select class="js-example-basic-multiple form-control"  id="codigo" name="codigo" onchange="buscarProduto(false)">
                        <option value='' selected disabled hidden>Selecione o Produto</option>
                        <?php foreach($estoques as $row) {
                                foreach($cores as $row2){
                                    if($row2['id_cor'] == $row['cor_produto']){
                                        $cor = $row2['nome_cor'];
                                    }
                                }
                                echo "<option value='" . $row['id_estoque'] . "' > " . $row['nome_produto'] . " | " . $row['modelo_produto'] . " | " . $cor . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Quantidade</label>
                            <input oninput="valorTotal()" type="number" value="1" name="qtd" id="qtd" placeholder="Qtd" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Valor Unitário</label>
                            <input type="number" disabled name="unitario" id="unitario" placeholder="R$" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Valor Total</label>
                            <input type="number" disabled name="total" id="total" placeholder="R$" class="form-control">
                        </div>
                        <input type="hidden" name="idProduto" id="idProduto">
                        <input type="hidden" name="idEstoque" id="idEstoque">
                        <input type="hidden" name="estoqueModelo" id="estoqueModelo">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-primary" onclick="buscarProduto(true)" style="width: 100%;">INCLUIR</button>
                </div>
            </div>
        </div>
        
        <!-- Imagem do Produto -->
        <div class="row" >
            <div class="col-md-12" >
                <div class="panel panel-defalut" style="padding: 10px;">
                    <div class="form-group">
                        <label>Imagem do Produto</label><br>
                    </div>
                    <div class="form-group text-center">
                        <img id="img" style="width: 100px;">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dados da Compra -->
        <div class="row" >
            <div class="col-md-12" >
                <div class="panel panel-defalut" style="padding: 10px;">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <div class="row">
                            <div class="col-xs-10">
                                 <select style="width: 100%" class="js-example-basic-multiple" id="cliente" name="cliente">
                                    <?php foreach($clientes as $row) {
                                            echo "<option value='" . $row['id_cliente'] . "' > " . $row['nome_cliente'] . " | " . $row['cpfcnpj_cliente'] ."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCliente"><em class="fa fa-plus"></em></button>
                            </div>
                        </div>
                    </div>
                  
                    <div id="divAcres" >
                        <div class="form-group">
                            <label for="acrescimo">Acréscimo</label>
                            <input type="number" placeholder="R$" id="acrescimo" name="acrescimo" class="form-control" oninput="mudarAcrescimo()">
                        </div>
                        
                        <div class="form-group">
                            <label for="desconto">Desconto:</label>
                            <input style="<?php if($this->session->userdata('tipo_pessoa') == 3) echo "display: block";
                    else echo "display: none;"?>" type="number" placeholder="R$" id="desconto" name="desconto" class="form-control" oninput="mudarDesconto()">
                            <br><button style="<?php if($this->session->userdata('tipo_pessoa') == 3) echo "display: none";
                    else echo "display: block;"?>" id="btDesconto" class="btn btn-primary" data-toggle="modal" data-target="#modalDesconto">Habilitar Desconto</button>
                        </div>
                    </div>
       
                </div>
            </div>
        </div>

    </div>
    
    <!-- Subtotal -->
    <div class="col-md-8">
        
        <!-- Tabela de Produtos -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="tableFixHead" id="tablefix">
                    <table id="myTable2" class="table table-hover table-bordered">
    				    <thead>
    				        <tr>
    				            <th>QTDE</th>
    				            <th>COD</th>
    				            <th>PDT</th>
    				            <th>Modelo</th>
    				            <th>VLU</th>
    				            <th>VLT</th>
    				            <th>Ações</th>
    				        </tr>
    				    </thead>
    				    <tbody>
    				    </tbody>    
    				</table>
				</div>
            </div>
        </div>
        
        <div class="panel panel-default" style="background-color: #30a5ff;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="row text-center" style="margin: 0px;">
                            <h4 style="color: white; font-weight: bold;">SUBTOTAL</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right; font-weight: bold;">R$</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 id="subtotal" style="color: white; float: left; font-weight: bold;">0</h4>
                            </div>  
                        </div>
                    </div>
                  
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white;">ACRÉSCIMO</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right;">R$</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 id="acrescimo2" style=" color: white; float: left;">0</h4>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white;">DESCONTO</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right;">R$</h4>
                            </div> 
                            <div class="col-xs-6">
                                <h4 id="desconto2" style=" color: white; float: left;">0</h4>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white; font-weight: bold;">TOTAL VENDA</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right; font-weight: bold;">R$</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 id="total2" style=" color: white; float: left; font-weight: bold;">0</h4>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="margin-bottom: 30px;">
            <a class="btn btn-primary" href="<?php echo base_url('pdv/cancelarPdv/') . $idCompra;?>" style="width: 49%; padding: 20px; font-size: 20px; font-weight: bold; background-color: red; border:0px;" >CANCELAR</a>
            <a class="btn btn-primary" onclick="setaDadosModal3()" style="width: 49%; padding: 20px; font-size: 20px; font-weight: bold; background-color: green; border:0px;" >FINALIZAR</a>
        </div>
    
        <div class="form-group alert alert-danger" role="alert" style="display: none; margin-top: 30px;" id="erroCliente">
            Selecione um Cliente!
        </div>
    </div>
    
</div>

<!-- Modal de Finalizar Compra -->
<div class="modal" id="modalFinalizar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <h4 class="modal-title">Finalizar Venda</h4>
            </div>
            <div class="col-md-6 col-xs-6">
                <h4 class="modal-title" style="float: right;"><?php echo $idCompra?></h4>
            </div>
        </div>  
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
          <input type="hidden" name="idCompra" id="idCompra" value="<?php echo $idCompra;?>">
          <input type="hidden" name="idLista" id="idLista" value="<?php echo $idLista;?>">
          <div class="form-group">
             <div class="col-xs-6">
                 <b>Cliente:</b>
             </div>
             <div class="col-xs-6">
                 <p id="cl" style="float: right"></p>
             </div>
             <input type="hidden" name="clienteHidden" id="clienteHidden">
         </div>
         <div class="form-group">
             <div class="col-xs-6">
                 <b>Vendedor:</b>
             </div>
             <div class="col-xs-6">
                 <p id="vend" style="float: right"><?php echo $this->session->userdata('nome_pessoa');?></p>
             </div>
             <input type="hidden" name="vendedorHidden" id="vendedorHidden" value="<?php echo $this->session->userdata('id_pessoa');?>">
         </div>
         
         <hr class="form-group" style="width: 100%;">
         
         <div class="form-group">
             <div class="col-xs-6">
                 <b>Subtotal:</b>
             </div>
             <div class="col-xs-6">
                 <p id="subtot" style="float: right"></p>
             </div>
         </div>
         <div class="form-group">
             <div class="col-xs-6">
                 <b>Acréscimo:</b>
             </div>
             <div class="col-xs-6">
                 <p id="ac" style="float: right" >0 %</p>
             </div>
         </div>
         <div class="form-group">
             <div class="col-xs-6">
                 <b>Desconto:</b>
             </div>
             <div class="col-xs-6">
                 <p id="des" style="float: right" >0 %</p>
             </div>
         </div>
         <div class="form-group">
             <div class="col-xs-6">
                 <b>Total:</b>
             </div>
             <div class="col-xs-6">
                 <p id="tot" style="float: right"></p>
             </div>
             <input type="hidden" name="valorHidden" id="valorHidden">
         </div>
         
         <hr class="form-group" style="width: 100%;">
         
         <div class="form-group">
             <div class="col-md-12" style="margin-bottom: 30px;">
                 <label for="pagamento">Forma de pagamento</label>
                 <select id="pagamento" name="pagamento" class="form-control" style="width: 100%" onchange="checaForma()">
                     <option value='' selected disabled hidden>Selecione a forma de pagamento</option>
                     <?php foreach($formas as $row) {
                            echo "<option value='" . $row['id_forma'] . "' > " . $row['nome_forma'] . "</option>";
                        }
                    ?>
                 </select>
             </div>
         </div>
         
         <div class="form-group" style="display:none; padding-left: 15px; padding-right: 15px;" id="divForma">
             
         </div>
         
        <div class="form-group alert alert-danger text-center" role="alert" style="display: none;" id="erroPagamento">
            Selecione a forma de pagamento!
        </div>
         
         <div class="form-group text-center">
            <button class="btn btn-success" onclick="<?php if($this->session->userdata('tipo_pessoa') == 2) echo "finalizaCompra()"; else echo "opcaoComprovante()";?>">
                Finalizar Venda</button>
         </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>

<!-- Modal de Opcao de Impressão -->
<div class="modal" id="modalImpressao">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h4 class="modal-title">Tipo de Impressora</h4>
            </div>
        </div>  
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
         
         <div class="form-group">
             <div class="col-md-12" style="margin-bottom: 30px;">
                 <label for="impressora">Tipo de Impressora</label>
                 <select id="impressora" name="impressora" class="form-control" style="width: 100%">
                     <option value='3' selected>Fiscal 5.6</option>
                     <option value='1'>Padrão</option>
                     <option value='2'>Fiscal 8</option>
                 </select>
             </div>
         </div>
         
         <div class="form-group text-center">
            <button class="btn btn-success" onclick="finalizaCompra()">
                Finalizar e Imprimir Comprovante</button>
         </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>

<!-- Modal de Opcao de Cadastro de Cliente -->
<div class="modal" id="modalCliente">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h4 class="modal-title">Cadastro de Cliente</h4>
            </div>
        </div>  
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
         
        <div class="form-group">
			<label>Nome</label>
			<input class="form-control" 
			type="text" placeholder="Nome" id="nome" name="nome">
		</div>

		<div class="form-group">
		    <div class="row">
		        <div class="col-md-6">  
					<label>CPF / CNPJ do Cliente</label>
					<input type="text" class="form-control" onkeypress="return somenteNumeros(event)" onblur="javascript: formatarCampo(this);" maxlength="14" 
					placeholder="Digite sem pontos e traços" id="cpf" name="cpf" required>
                    <h4 class="text-danger" id="erroCliente1" style="display: none">CPF / CNPJ JÁ CADASTRADO!</h4>
                    <h4 class="text-danger" id="erroCliente2" style="display: none">CPF / CNPJ INVÁLIDO!</h4>

				</div>
				<div class="col-md-6">  
					<label>Email</label>
					<input type="email" class="form-control" 
					placeholder="Email" id="email" name="email" >
				</div>
			</div>
		</div>
		
		<div class="row">
		    <div class="form-group">
		        <div class="col-md-6" style="margin-bottom: 15px;">
				    <label>Estado</label><br>
                    <select style="width: 100%" class="js-example-basic-multiple form-control" id="estado" name="estado" onchange='test($(this).val())'>
                    <?php echo"<option value='' selected disabled hidden>Selecione o Estado</option>";
                            foreach($estado as $row) {
                            echo "<option value='" . $row['id_estado'] . "' > " . $row['nome_estado'] . " - " . $row['uf_estado'] . "</option>";
                        }
                    ?>
                    </select>
                </div>
                
                <label style="margin-left:18px">Cidade</label><br>
                <div class="col-md-6" style="display:none;" id="divCid">
                    <select style="width: 100%" class="js-example-basic-multiple form-control" id="cidade" name="cidade" >
                        <option value='' selected disabled hidden>Selecione a Cidade</option>
                    </select>
                </div>
		        
		    </div>
	    </div>
		
	<div class="form-group">
	    <div class="row">
	        <div class="col-md-6">
				<label>Endereço:</label>
				<input class="form-control"  
				type="text" placeholder="Endereço" id="endereco" name="endereco" >

			</div>
			<div class="col-md-6">
				<label>Telefone:</label>
				<input class="form-control" 
				type="number" placeholder="Telefone" id="telefone" name="telefone" data-mask="00000000000" >

			</div>    
		</div>
	</div>
         
         <div class="form-group text-center">
            <button class="btn btn-success" onclick="cadastrarCliente()">
                Cadastrar</button>
         </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>

<!-- Modal de Opcao de Desconto -->
<div class="modal" id="modalDesconto">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h4 class="modal-title">Entre com um gerente ou administrador</h4>
            </div>
        </div>  
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
         
         <div class="form-group">
             <label>Usuário</label>
             <input type="text" name="usuarioDesconto" id="usuarioDesconto" placeholder="Usuário"
             class="form-control">
         </div>
         
         <div class="form-group">
             <label>Senha</label>
             <input type="password" name="senhaDesconto" id="senhaDesconto" placeholder="Senha"
             class="form-control">
         </div>
         
         <div class="form-group alert alert-danger text-center" role="alert" style="display: none;" id="erroUsuario">
            Usuário não encontrado!
        </div>
        
        <div class="form-group alert alert-danger text-center" role="alert" style="display: none;" id="erroUsuario2">
            Este usuário não é gerente ou administrador!
        </div>
         
         <div class="form-group text-center">
            <button class="btn btn-success" onclick="confirmarUsuario()">
                Confirmar Usuário</button>
         </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        
      </div>

    </div>
  </div>
</div>

<script>
    var table = document.getElementById("myTable2");
    var aux2 = 0;
    var posicaotabela = 0;
    var valor = 0.0;
    var produto;
    var caminho = "<?php echo base_url('assets/uploads/imagens_produtos/');?>";
    var desconto;
    var desconto2;
    var sub;
    var acrescimo;
    var acrescimo2;
    var jaexise = 0
    var qtd;
    var total;
    
    //Pega os valores dos inputs e os transfere para a tabela
    function adicionarProduto(){
        if(document.getElementById('qtd').value == "" || document.getElementById('codigo').value == ""){
            document.getElementById( 'erro2' ).style.display = 'block';
        }else{
            document.getElementById( 'erro2' ).style.display = 'none';
            if(parseInt(produto.estoque_qtd) < parseInt(document.getElementById('qtd').value)){
                document.getElementById( 'erroEstoque' ).innerHTML = "Estoque insuficiente, restam apenas " + produto.estoque_qtd  + " unidades";
                document.getElementById( 'erroEstoque' ).style.display = 'block';
            }else{
                document.getElementById( 'erroEstoque' ).style.display = 'none';
                
                if(produto.minimo_venda > parseInt(document.getElementById('qtd').value)){
                    document.getElementById( 'erroEstoque2' ).style.display = 'block';
                }else{
                    document.getElementById( 'erroEstoque2' ).style.display = 'none';
                    jaexiste = 0;
                    
                    for (i=0; i < table.rows.length; i++){
                        colunas = table.rows[i].childNodes;
                        
                        if(colunas[9].innerHTML == document.getElementById('idEstoque').value){
                            jaexiste = 1;
                            qtd = parseInt(colunas[1].innerHTML) + parseInt(document.getElementById('qtd').value);
                            colunas[1].innerHTML = qtd;
                            total = parseFloat(colunas[6].innerHTML) + (parseFloat(colunas[5].innerHTML) * parseFloat(document.getElementById('qtd').value));
                            colunas[6].innerHTML = total.toFixed(2);
                        }
                        
                    }
                    
                    valorTotal();
                    
                    if(jaexiste == 0){
                        aux2++;
                        posicaotabela++;
                        
                        var row = table.insertRow(posicaotabela);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        var cell7 = row.insertCell(6);
                        var cell8 = row.insertCell(7);
                        var cell9 = row.insertCell(8);
                        var cell10 = row.insertCell(9);
                        cell1.style.display = 'none';
                        cell1.innerHTML = aux2;
                        cell2.innerHTML = document.getElementById('qtd').value;
                        cell3.innerHTML = document.getElementById('codigo').value;
                        cell5.innerHTML = document.getElementById('estoqueModelo').value;
                        cell6.innerHTML = document.getElementById('unitario').value;
                        cell7.innerHTML = document.getElementById('total').value;
                        cell8.style.display = 'none';
                        cell8.innerHTML = document.getElementById('idProduto').value;
                        cell9.innerHTML = "<button class='btn btn-primary' onclick='deletarProduto(" + aux2 + ")'><em class='fa fa-trash'></em></button>";
                        cell10.style.display = 'none';
                        cell10.innerHTML = document.getElementById('idEstoque').value;
                        
                        var nome = produto.nome_produto;
                        cell4.innerHTML = nome;
                        
                        var objDiv = document.getElementById("tablefix");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                    
                    var aux = parseFloat(document.getElementById('total').value);
                    valor += aux;
                    
                    subtotal.innerHTML = valor.toFixed(2);
                    
                    sub = parseFloat(document.getElementById('subtotal').innerText);
                    
                    acrescimo2 = 0;
                    acrescimo = document.getElementById('acrescimo').value;
                    if(acrescimo != "" && acrescimo != "0"){
                        acrescimo2 = parseFloat(acrescimo);
                    }
                    sub += acrescimo2;
                    

                    desconto = document.getElementById('desconto').value;
                    desconto2 = 0;
                    
                    if(desconto != "" && desconto != "0"){
                        desconto2 = desconto;
                        
                    }
                    
                    sub -= desconto2;
                    
                    document.getElementById('total2').innerText = sub.toFixed(2);
                }
            }
        }
        
    }
    
    //Busca o produto no banco de dados baseado no código digitado
    function buscarProduto(adicionar){
        var dados = new FormData();
        dados.append('codigo', document.getElementById('codigo').value);
        
        $.ajax({
            url: '<?php echo base_url('produtos/listaProdutoUnicoVisivel/'); ?>',
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
                    document.getElementById( 'erro' ).style.display = 'block';
                    document.getElementById( 'erro2' ).style.display = 'none';
                    document.getElementById( 'erroEstoque' ).style.display = 'none';
                    document.getElementById( 'erroEstoque2' ).style.display = 'none';
                    document.getElementById('img').src = "";
                }else{
                    document.getElementById( 'erro' ).style.display = 'none';
                    document.getElementById( 'erro2' ).style.display = 'none';
                    document.getElementById( 'erroEstoque' ).style.display = 'none';
                    document.getElementById( 'erroEstoque2' ).style.display = 'none';
                    produto = jQuery.parseJSON(data);
                    
                    if(produto == 1){
                        document.getElementById( 'erroData' ).style.display = 'block';
                    }else{
                        document.getElementById( 'erroData' ).style.display = 'none';
                    
                        document.getElementById('unitario').value = produto.venda_produto;
                        document.getElementById('idProduto').value = produto.id_produto;
                        document.getElementById('idEstoque').value = produto.estoque_id;
                        document.getElementById('estoqueModelo').value = produto.estoque_modelo;

                        valorTotal();
                    
                        var img = produto.imagem_produto;
                        
                        if(img != 1){
                            document.getElementById('img').src = caminho.concat(img);
                        }
                        
                        if(adicionar == true){
                            adicionarProduto();
                        }else{
                            document.getElementById('qtd').value = 1;
                        }
                    }
                }
        
            },
        });
    }
    
    //Popula o input de valor total de acordo com a quantidade e o valor unitário
    function valorTotal(){
        var qtd = document.getElementById('qtd').value;
        var unitario = document.getElementById('unitario').value;
        
        var val = qtd * unitario;
        document.getElementById('total').value = val.toFixed(2);
    }
    
    //Pega a posicao do produto e o exclui da tabela
    function deletarProduto(id){
        acrescimo = document.getElementById('acrescimo').value;
        desconto = document.getElementById('desconto').value;
        total = 0;
        var subtotal;
        sub = document.getElementById('subtotal');
        
        for (i=0; i < table.rows.length; i++){
            colunas = table.rows[i].childNodes;
            
            if(colunas[0].innerHTML == id){
                total = parseFloat(colunas[6].innerHTML);
                subtotal =  parseFloat(sub.innerHTML) - total;
                sub.innerHTML =  subtotal.toFixed(2);
                total = sub.innerHTML;
                valor -= parseFloat(colunas[6].innerHTML);
                
                if(desconto != "" && desconto != "0"){
                    desconto2 = parseFloat(desconto);
                }else{
                    desconto2 = 0;
                }
                
                if(acrescimo != "" && acrescimo != "0"){
                    acrescimo2 = parseFloat(acrescimo);
                }else{
                    acrescimo2 = 0;
                }
                
                total = parseFloat(total) - desconto2 + acrescimo2;
                
                document.getElementById('total2').innerText = total.toFixed(2);
                
                posicaotabela--;
                table.deleteRow(i);
                
            }
        }

    
    }
    
    //Busca os dados da venda e os manda para o modal de venda
    function setaDadosModal3(){
        
        if(document.getElementById('cliente').value == ""){
            document.getElementById( 'erroCliente' ).style.display = 'block';
        }else{
            document.getElementById( 'erroCliente' ).style.display = 'none';
            
            document.getElementById("subtot").innerText = "R$ " + document.getElementById("subtotal").innerText;
            var subtotal = document.getElementById("subtotal").innerText;
            
            acrescimo = document.getElementById('acrescimo').value;
            if(acrescimo != ""){
                document.getElementById('ac').innerText = "R$ " + acrescimo;
                var totAcrescimo = acrescimo;
            }else{
                var totAcrescimo = 0;
            }
            
            desconto = document.getElementById('desconto').value;
            
            if(desconto != ""){
                document.getElementById('des').innerText = "R$ " + desconto;
                var totDesconto = desconto;
            }else{
                var totDesconto = 0;
            }

            total = parseFloat(subtotal) + parseFloat(totAcrescimo) - parseFloat(totDesconto);
            document.getElementById('tot').innerText = "R$ " + total.toFixed(2);
            document.getElementById('valorHidden').value = total;
            
            var clientes = <?php echo json_encode($clientes)?>;
            var cliente = document.getElementById('cliente').value;
            
            for(var i=0; i<clientes.length; i++) {
                if(clientes[i].id_cliente == cliente){
                    document.getElementById('cl').innerText = clientes[i].nome_cliente;
                    document.getElementById('clienteHidden').value = clientes[i].id_cliente;
                }    
            }
            
            
            $('#modalFinalizar').modal('show');
            
        }
        
    }
    
    //Percorre a tabela de produtos, os insere na tabela de lista e manda os dados 
    //da compra para serem inseridos no bd
    function finalizaCompra(){
        var idLista = <?php echo $idLista;?>;
        var dados;
        var cliente = document.getElementById('clienteHidden').value;
                
        if(document.getElementById('pagamento').value == 0){
            document.getElementById( 'erroPagamento' ).style.display = 'block';
        }else{ 
            document.getElementById( 'erroPagamento' ).style.display = 'none';
            
            if(document.getElementById('numFormas') != null){
                var numFormas = document.getElementById('numFormas').value;
                var totalInputs = 0;
                for(var i = 1; i <= numFormas; i++){
                    totalInputs += parseFloat(document.getElementById('pagamento' + i).value);
                }
            } 
            
            if(document.getElementById('numFormas') != null && totalInputs != document.getElementById('valorHidden').value){
                document.getElementById( 'erroParcelamento' ).style.display = 'block';
            }else{
                if(document.getElementById('numFormas') != null){
                    document.getElementById( 'erroParcelamento' ).style.display = 'none';
                }
                
                for (i=1; i < table.rows.length; i++){
                    colunas = table.rows[i].childNodes;
                    
                    dados = new FormData();
                    dados.append('produto_id', colunas[7].innerHTML);
                    dados.append('produto_valor', colunas[5].innerHTML);
                    dados.append('produto_qtd', colunas[1].innerHTML);
                    dados.append('produto_valorfinal', colunas[6].innerHTML);
                    dados.append('cliente_id', cliente);
                    dados.append('estoque_id', colunas[9].innerHTML);
                    dados.append('id_lista', idLista);
                    
                    
                    $.ajax({
                        url: '<?php echo base_url('listas/insereLista/'); ?>',
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
                                alert("Erro no Banco de Dados");
                            }
                        },
                    });
                }
                
                dados = new FormData();
                dados.append('idCompra', document.getElementById('idCompra').value);
                dados.append('idLista', document.getElementById('idLista').value);
                dados.append('clienteHidden', document.getElementById('clienteHidden').value);
                dados.append('vendedorHidden', document.getElementById('vendedorHidden').value);
                dados.append('valorHidden', document.getElementById('valorHidden').value);
                dados.append('pagamento', document.getElementById('pagamento').value);
                dados.append('acrescimo', document.getElementById('acrescimo').value);
                dados.append('desconto', document.getElementById('desconto').value);
                
                if(document.getElementById('numFormas') != null){
                    dados.append('numFormas', numFormas);
                    for(var i = 1; i <= numFormas; i++){
                        dados.append('pagamento' + i, document.getElementById('pagamento' + i).value);
                        dados.append('forma'+ i, document.getElementById('forma' + i).value);
                    }
                }
                
                
                $.ajax({
                    url: '<?php echo base_url('compras/atualizaCompra'); ?>',
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
                           var impressora = document.getElementById('impressora').value;        
                           var link = "<?php echo base_url('pdv/gerarComprovante/')?>" + data + "/" + impressora;
                           window.open(link, '_blank', 'toolbar=0,location=0,menubar=0,resizable=yes,width=435,height=600');
                           window.location.href = '<?php echo base_url('pdv/index/')?>';
                        }else{
                            alert("Erro na banco");
                        }
                    },
                });

            }
        }
    }

    
    //Atualiza o acréscimo e o total final da barra azul quando eu mudar o acréscimo do input
    function mudarAcrescimo(){
        acrescimo = document.getElementById('acrescimo').value;
        desconto = document.getElementById('desconto').value;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        document.getElementById('acrescimo2').innerText = acrescimo;
        
        if(acrescimo != ""){
            total = parseFloat(subtotal) +  parseFloat(acrescimo);
        }else{
            total = parseFloat(subtotal)
        }
        
        if(desconto != "" && desconto != "0"){
            desconto2 = desconto;
            total -= desconto2;
        }
        
        document.getElementById('total2').innerText = total.toFixed(2);
    }
    
    //Atualiza o desconto e o total final da barra azul quando eu mudar o desconto do input
    function mudarDesconto(){
        acrescimo = document.getElementById('acrescimo').value;
        desconto = document.getElementById('desconto').value;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        document.getElementById('desconto2').innerText = desconto;
        total = subtotal - desconto;
        
        if(acrescimo != "" && acrescimo != "0"){
            acrescimo2 = parseFloat(acrescimo);
            total += acrescimo2;
        }
        
        document.getElementById('total2').innerText = total.toFixed(2);
    }
    
    function opcaoComprovante(){
        
        if(document.getElementById('numFormas') != null){
            var numFormas = document.getElementById('numFormas').value;
            var totalInputs = 0;
            for(var i = 1; i <= numFormas; i++){
                totalInputs += parseFloat(document.getElementById('pagamento' + i).value);
            }
            
            if(totalInputs != document.getElementById('valorHidden').value){
                document.getElementById( 'erroParcelamento' ).style.display = 'block';
            }else{
                document.getElementById( 'erroParcelamento' ).style.display = 'none';
                
                $('#modalFinalizar').modal('hide');
                $('#modalImpressao').modal('show');
            } 
        } else{
            $('#modalFinalizar').modal('hide');
            $('#modalImpressao').modal('show');
        }
        
    }
    
    //Verifica a forma de pagamento e, se ela for de várias vezes, retorna as
    //opções das várias vezes
    function checaForma(){
        var idPagamento = document.getElementById("pagamento").value;
        var forma;
        
        dados = new FormData();
        dados.append('idPagamento', idPagamento);
        
        $.ajax({
                url: '<?php echo base_url('formas_pagamento/getFormasPdv'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    if(data != 1){
                        $('#divForma').html(data);
                        document.getElementById("divForma").style.display = "block";
                    }else{
                        document.getElementById("divForma").style.display = "none";
                    }
                },
            });
    }
    
    //Função que confirma o usuário ao tentar habilitar o desconto
    function confirmarUsuario(){
        dados = new FormData();
        dados.append('usuario', document.getElementById('usuarioDesconto').value);
        dados.append('senha', document.getElementById('senhaDesconto').value);
        
        $.ajax({
            url: '<?php echo base_url('login/validarLoginDesconto'); ?>',
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
                    document.getElementById("erroUsuario").style.display = "block";
                }else{
                    document.getElementById("erroUsuario").style.display = "none";
                    
                    funcionario = jQuery.parseJSON(data);
                    
                    if(funcionario.tipo_id == 2){
                        document.getElementById("erroUsuario2").style.display = "block";
                    }else{
                        document.getElementById("erroUsuario").style.display = "none";
                        
                        $('#modalDesconto').modal('hide');
                        document.getElementById('btDesconto').style.display="none";
                        document.getElementById('desconto').style.display="block";
                    }
                }
            },
        });
    }
    
    //Funções de cliente -------------------------------------------------------------
    
    var base_url = '<? echo base_url() ?>';

    function test(id_estado){
        document.getElementById('divCid').style.display = 'block';
        $.post(base_url+"lojas/cidadePorEstado", {
            id_estado : id_estado
        }, function(data){
            $('#cidade').html(data);
        });
    }
    
    function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
            // charCode 8 = backspace   
            // charCode 9 = tab
            if (charCode != 8 && charCode != 9) {
                // charCode 48 equivale a 0   
                // charCode 57 equivale a 9
                if (charCode < 48 || charCode > 57) {
                    return false;
                }
            }
        }
        
    function formatarCampo(campoTexto) {
        if (campoTexto.value.length <= 11) {
            campoTexto.value = mascaraCpf(campoTexto.value);
        } else {
            campoTexto.value = mascaraCnpj(campoTexto.value);
        }
    }
    function retirarFormatacao(campoTexto) {
        campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g,"");
    }
    function mascaraCpf(valor) {
        return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g,"\$1.\$2.\$3\-\$4");
    }
    function mascaraCnpj(valor) {
        return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g,"\$1.\$2.\$3\/\$4\-\$5");
    }
    
    function cadastrarCliente(){
        dados = new FormData();
        dados.append('nome', document.getElementById('nome').value);
        dados.append('cpf', document.getElementById('cpf').value);
        dados.append('estado', document.getElementById('estado').value);
        dados.append('cidade', document.getElementById('cidade').value);
        dados.append('endereco', document.getElementById('endereco').value);
        dados.append('email', document.getElementById('email').value);
        dados.append('telefone', document.getElementById('telefone').value);
        
        $.ajax({
            url: base_url+"clientes/cadastroClientePdv",
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              alert(error + " aaa");
            },
            success: function(data) {
                if(data == 1){
                    document.getElementById( 'erroCliente1' ).style.display = 'block';
                }else{
                    document.getElementById( 'erroCliente1' ).style.display = 'none';
                    if(data == 2){
                        document.getElementById( 'erroCliente2' ).style.display = 'block';
                    } else{
                        document.getElementById( 'erroCliente2' ).style.display = 'none';
                        $('#modalCliente').modal('hide');
                        $('#cliente').html(data);    
                    }
                }
                
            },
        });
    }
    
</script>