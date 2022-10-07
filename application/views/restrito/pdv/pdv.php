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
                    <a href="<?php echo base_url('pdv/voltarPdv/'). $idCompra;?>" class="btn btn-primary">Voltar</a>
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
                    <select class="js-example-basic-multiple form-control" id="codigo" name="codigo" onchange="buscarProduto(false)">
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
                            <input oninput="valorTotal()" type="number" name="qtd" id="qtd" placeholder="Qtd" class="form-control">
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
                    <div class="form-group row">
                        <div class="col-md-6">
                            <b>Número do Pedido:</b>
                        </div>
                        <div class="col-md-6">
                            <p style="float: right;"><?php echo $idCompra;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                         <select style="width: 100%" class="js-example-basic-multiple" id="cliente" name="cliente">
                            <?php foreach($clientes as $row) {
                                    echo "<option value='" . $row['id_cliente'] . "' > " . $row['nome_cliente'] . " | " . $row['cpfcnpj_cliente'] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <?php if($this->session->userdata('tipo_pessoa') == 3 || $this->session->userdata('tipo_pessoa') == 1 || $this->session->userdata('tipo_pessoa') == 4){ ?>
                    <div class="form-group">
                        <label for="acrescimo">Acréscimo</label>
                        <input type="number" placeholder="%" id="acrescimo" name="acrescimo" class="form-control" oninput="mudarAcrescimo()">
                    </div>
                    
                    <div class="form-group">
                        <label for="desconto">Desconto</label>
                        <input type="number" placeholder="%" id="desconto" name="desconto" class="form-control" oninput="mudarDesconto()">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <!-- Deletar produto -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-defalut" style="padding: 10px;">
                    <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erro3">
                        Preencha o campo de id!
                    </div>
                    <div class="form-group alert alert-danger" role="alert" style="display: none;" id="erro4">
                        ID não encontrado!
                    </div>
                    <div class="form-group">
                        <label for="deletar">Deletar Produto</label>
                        <input type="number" placeholder="Digite o ID do produto" id="idproduto" name="idproduto" class="form-control">
                    </div>
                    <div class="form-group">
                        <buton class="btn btn-primary" onClick="deletarProduto()">Deletar</buton>
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
    				            <th>ID</th>
    				            <th>QTDE</th>
    				            <th>Código</th>
    				            <th>Produto</th>
    				            <th>Modelo</th>
    				            <th>Valor Unitário</th>
    				            <th>Valor Total</th>
    				        </tr>
    				    </thead>
    				    <tbody>
    				    </tbody>    
    				</table>
				</div>
            </div>
        </div>
        
        <div class="panel panel-default" style="background-color: #3359cc;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="row text-center" style="margin: 0px;">
                            <h4 style="color: white;">Subtotal</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right;">R$</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 id="subtotal" style="color: white; float: left;">0</h4>
                            </div>  
                        </div>
                    </div>
                    <?php if($this->session->userdata('tipo_pessoa') == 3 || $this->session->userdata('tipo_pessoa') == 1 || $this->session->userdata('tipo_pessoa') == 4){ ?>
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white;">Acréscimo</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 id="acrescimo2" style=" color: white; float: right;">0</h4>
                            </div> 
                            <div class="col-xs-6">
                                <h4 style="color: white; float: left;">%</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white;">Desconto</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 id="desconto2" style=" color: white; float: right;">0</h4>
                            </div> 
                            <div class="col-xs-6">
                                <h4 style="color: white; float: left;">%</h4>
                            </div>  
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="col-md-3 text-center">
                        
                    </div>
                    <div class="col-md-3 text-center">
                        
                    </div>
                    <?php } ?>
                    <div class="col-md-3 text-center">
                        <div class="row" style="margin: 0px;">
                            <h4 style="color: white;">Total Final</h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 style="color: white; float: right;">R$</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 id="total2" style=" color: white; float: left;">0</h4>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center" style="margin-bottom: 30px;">
            <a  class="btn btn-primary" onclick="setaDadosModal3()">Finalizar Venda</a>
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
                 <select id="pagamento" name="pagamento" class="form-control" style="width: 100%">
                     <option value='' selected disabled hidden>Selecione a forma de pagamento</option>
                     <?php foreach($formas as $row) {
                            echo "<option value='" . $row['id_forma'] . "' > " . $row['nome_forma'] . "</option>";
                        }
                    ?>
                 </select>
             </div>
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
    
    
    //Pega os valores dos inputs e os transfere para a tabela
    function adicionarProduto(){
        if(document.getElementById('qtd').value == "" || document.getElementById('codigo').value == ""){
            document.getElementById( 'erro2' ).style.display = 'block';
        }else{
            document.getElementById( 'erro2' ).style.display = 'none';
            if(parseInt(produto.estoque_qtd) < parseInt(document.getElementById('qtd').value)){
                document.getElementById( 'erroEstoque' ).style.display = 'block';
            }else{
                document.getElementById( 'erroEstoque' ).style.display = 'none';
                
                if(produto.minimo_venda > document.getElementById('qtd').value){
                    document.getElementById( 'erroEstoque2' ).style.display = 'block';
                }else{
                    document.getElementById( 'erroEstoque2' ).style.display = 'none';
                
                    valorTotal();
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
                    cell1.innerHTML = aux2;
                    cell2.innerHTML = document.getElementById('qtd').value;
                    cell3.innerHTML = document.getElementById('codigo').value;
                    cell5.innerHTML = document.getElementById('estoqueModelo').value;
                    cell6.innerHTML = document.getElementById('unitario').value;
                    cell7.innerHTML = document.getElementById('total').value;
                    cell8.style.display = 'none';
                    cell8.innerHTML = document.getElementById('idProduto').value;
                    cell9.style.display = 'none';
                    cell9.innerHTML = document.getElementById('idEstoque').value;
                    
                    var aux = parseFloat(document.getElementById('total').value);
                    valor += aux;
                    
                    subtotal.innerHTML = valor.toFixed(2);
                    
                    var nome = produto.nome_produto;
                    cell4.innerHTML = nome;
                    
                    var objDiv = document.getElementById("tablefix");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    
                    sub = parseFloat(document.getElementById('subtotal').innerText);
                    <?php if($this->session->userdata('tipo_pessoa') != 2){?>
                    desconto = document.getElementById('desconto').value;
                    desconto2 = 0;
                    acrescimo2 = 0;
                    
                    if(desconto != "" && desconto != "0"){
                        desconto2 = (sub / 100) * desconto;
                        
                    }
                    
                    acrescimo = document.getElementById('acrescimo').value;
                    if(acrescimo != "" && acrescimo != "0"){
                        acrescimo2 = (sub / 100) * acrescimo;
                    }
                    
                    sub -= desconto2;
                    sub += acrescimo2;
                    <?php }?>
                    
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
                    
                        var img = produto.imagem_produto;
                        
                        if(img != 1){
                            document.getElementById('img').src = caminho.concat(img);
                        }
                        
                        if(adicionar == true){
                            adicionarProduto();
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
    
    //Pega o id do produto digitado e o exclui da tabela
    function deletarProduto(){
        var id = document.getElementById('idproduto').value;
        var deletou = false;
        
        if(id == ""){
            document.getElementById( 'erro3' ).style.display = 'block';
        }else{
            document.getElementById( 'erro3' ).style.display = 'none';
            
            for (i=0; i < table.rows.length; i++){
                colunas = table.rows[i].childNodes;
                
                if(colunas[0].innerHTML == id){
                    var total = colunas[5].innerHTML;
                    subtotal.innerHTML = subtotal.innerHTML - total;
                    deletou = true;
                    posicaotabela--;
                    table.deleteRow(i);
                }
            }

        }
        
        if(deletou == false){
            document.getElementById( 'erro4' ).style.display = 'block';
        }else{
            document.getElementById( 'erro4' ).style.display = 'none';
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
            
            <?php if($this->session->userdata('tipo_pessoa') != 2){?>
            var acrescimo = document.getElementById('acrescimo').value;
            var desconto = document.getElementById('desconto').value;
            
            if(acrescimo != ""){
                document.getElementById('ac').innerText = acrescimo + " %";
                var totAcrescimo = (subtotal / 100) * acrescimo;
            }else{
                var totAcrescimo = 0;
            }
            
            if(desconto != ""){
                document.getElementById('des').innerText = desconto + " %";
                var totDesconto = (subtotal / 100) * desconto;
            }else{
                var totDesconto = 0;
            }
            <?php } else {?>
                var totAcrescimo = 0;
                var totDesconto = 0;
            <?php } ?>
    
            var total = parseFloat(subtotal) + parseFloat(totAcrescimo) - parseFloat(totDesconto);
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
        
            for (i=1; i < table.rows.length; i++){
                colunas = table.rows[i].childNodes;
                
                dados = new FormData();
                dados.append('produto_id', colunas[7].innerHTML);
                dados.append('produto_valor', colunas[5].innerHTML);
                dados.append('produto_qtd', colunas[1].innerHTML);
                dados.append('produto_valorfinal', colunas[6].innerHTML);
                dados.append('cliente_id', cliente);
                dados.append('estoque_id', colunas[8].innerHTML);
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
                       var link = "<?php echo base_url('pdv/gerarComprovante/') . $idCompra ?>" + "/" + impressora;
                       window.open(link, '_blank', 'toolbar=0,location=0,menubar=0,resizable=yes,width=435,height=600');
                       window.location.href = '<?php echo base_url('pdv/index/')?>';
                       window.print();
                    }else{
                        alert("Erro na banco");
                    }
                },
            });
        }
    }
    
    //Atualiza o acréscimo e o total final da barra azul quando eu mudar o acréscimo do input
    function mudarAcrescimo(){
        var acrescimo = document.getElementById('acrescimo').value;
        var desconto = document.getElementById('desconto').value;
        var total;
        var desconto2;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        document.getElementById('acrescimo2').innerText = acrescimo;
        total = subtotal + ((subtotal / 100) * acrescimo);
        
        if(desconto != "" && desconto != "0"){
            desconto2 = (subtotal / 100) * desconto;
            total -= desconto2;
        }
        
        document.getElementById('total2').innerText = total.toFixed(2);
    }
    
    //Atualiza o desconto e o total final da barra azul quando eu mudar o desconto do input
    function mudarDesconto(){
        var acrescimo = document.getElementById('acrescimo').value;
        var desconto = document.getElementById('desconto').value;
        var total;
        var acrescimo2;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        document.getElementById('desconto2').innerText = desconto;
        total = subtotal - ((subtotal / 100) * desconto);
        
        if(acrescimo != "" && acrescimo != "0"){
            acrescimo2 = (subtotal / 100) * acrescimo;
            total += acrescimo2;
        }
        
        document.getElementById('total2').innerText = total.toFixed(2);
    }
    
    function opcaoComprovante(){
        if(document.getElementById('pagamento').value == 0){
            document.getElementById( 'erroPagamento' ).style.display = 'block';
        }else{ 
            document.getElementById( 'erroPagamento' ).style.display = 'none';
            $('#modalFinalizar').modal('hide');
            $('#modalImpressao').modal('show');
            
        }    
    }
    
</script>