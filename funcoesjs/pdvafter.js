
    function calcEnvio(){
        var id = $('#formaEnvio').val();
        if(id == 1){
            $("#envioModal").val('0');
            $("#envioModal").prop("disabled", true);
        }else if(id == 2){
            $("#envioModal").val('<?php echo $motoboy;?>');
            $("#envioModal").prop("disabled", true);
        }else if(id == 3){
            $("#envioModal").val('0');
            $("#envioModal").prop("disabled", false);
        } 
    }
    
    function updateEnvio(){
        var valor = $('#envioModal').val();
        var tipo = $( "#formaEnvio option:selected" ).text();
        $('#envio').val(valor);
        $('#formaEnvioTxtFim').html('');
        $('#formaEnvioTxtFim').html(tipo);
        $('#formaEnvioValFim').html('');
        $('#formaEnvioValFim').html(valor);
    }

    $(document).ready(function(){
        $('.number').mask('0#');
        $('.money').mask("#.##0,00", {reverse: true});
        
        $('.cep').mask('00000-000');
        
        $('.cpf').mask('000.000.000-00', {reverse: true});
         
        var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        
        $('.telefone').mask(SPMaskBehavior, spOptions);
    });


    function abrirconfig(){
        var div = document.getElementById("configlista").classList.toggle("show");
    }


    function buscaCEP(){
        var valor = document.getElementById('cep').value;
        var cep = valor.replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)) {
                document.getElementById('logra').value="...";
                // document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('estado').value="...";

                var script = document.createElement('script');
                
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                
                document.body.appendChild(script);
            }
            else {
                limpa_formulario_cep();
                Swal.fire('Cep não encontrado, preencha os dados manualmente.');
            }
        }
        else {
            limpa_formulario_cep();
        }
    }
    
    function limpa_formulario_cep() {
            document.getElementById('logra').value=("");
            // document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('estado').value=("");
    }
    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('logra').value=(conteudo.logradouro);
            // document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('estado').value=(conteudo.uf);
        }
        else {
            limpa_formulario_cep();
            Swal.fire('Cep não encontrado, preencha os dados manualmente.');
             $("#logra").removeAttr('disabled');
            //  $("#bairro").removeAttr('disabled');
             $("#cidade").removeAttr('disabled');
             $("#estado").removeAttr('disabled');
        }
    }


    var table = document.getElementById("myTable2");
    var aux2 = 0;
    var posicaotabela = 0;
    var valor = 0.0;
    var produto;
    var caminho = "<?php echo base_url('assets/uploads/imagens_produtos/');?>";
    var desconto;
    var desconto2;
    var sub;
    var jaexise = 0
    var qtd;
    var total;
    
    //Pega os valores dos inputs e os transfere para a tabela
    function adicionarProduto(){
        
        
        if(document.getElementById('qtd').value == "" || document.getElementById('codigoprod').value == ""){
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
        
        var loja = document.getElementById('loja_id').value;
        var vendedor = document.getElementById('vendedor_id').value;
        
        if( loja > 0 && vendedor > 0){

            var dados = new FormData();
            dados.append('codigo', document.getElementById('codigoprod').value);
            dados.append('loja', document.getElementById('loja_id').value);
            
            $.ajax({
                url: '<?php echo base_url('pdv/listaProdutoUnicoVisivel/'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  console.log(error);
                },
                success: function(data) {
                    if(data == "null"){
                        document.getElementById( 'erro' ).style.display = 'block';
                        document.getElementById( 'erro2' ).style.display = 'none';
                        document.getElementById( 'erroEstoque' ).style.display = 'none';
                        document.getElementById( 'erroEstoque2' ).style.display = 'none';
                        document.getElementById( 'erroLoja' ).style.display = 'none';
                        document.getElementById( 'erroVendedor' ).style.display = 'none';
                        document.getElementById('img').src = "";
                    }else{
                        document.getElementById( 'erro' ).style.display = 'none';
                        document.getElementById( 'erro2' ).style.display = 'none';
                        document.getElementById( 'erroEstoque' ).style.display = 'none';
                        document.getElementById( 'erroEstoque2' ).style.display = 'none';
                        document.getElementById( 'erroLoja' ).style.display = 'none';
                        document.getElementById( 'erroVendedor' ).style.display = 'none';
                        produto = jQuery.parseJSON(data);
                        
                        if(produto == 1){
                            document.getElementById( 'erroData' ).style.display = 'block';
                        }else{
                            if(produto.produto_estoque <= 0){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Temos um problema',
                                    text: 'Todo o estoque já foi vendido!',
                                })
                            }else{
                                document.getElementById( 'erroData' ).style.display = 'none';
                                document.getElementById('unitario').value = produto.produto_valor;
                                document.getElementById('idProduto').value = produto.produto_id;
                                document.getElementById('idEstoque').value = produto.produto_id;
                                document.getElementById('estoqueQtd').value = produto.produto_estoque;
                                
                                valorTotal();
                                
                                if(adicionar == true){
        			                var posicao = document.getElementById('listaCompra').value;
                                    posicao ++;
                                    document.getElementById("listaCompra").value = posicao;
                                    var quant = document.getElementById('qtd').value;
                                    var html = "<tr id='"+posicao+"'><th>" + posicao + "</th><th>" + produto.produto_nome + "</th><th>" + quant + "</th><th>" + produto.produto_valor + "</th><th>" + parseFloat(quant*produto.produto_valor).toFixed( 2 ) + "</th><th><a class='btn btn-sm btn-danger' onclick='deleteItem("+(posicao)+")'><i class='fa fa-times' aria-hidden='true'></i></a></th></tr>";
                                    var sum = parseFloat(quant*produto.produto_valor).toFixed( 2 );
                                    $('#pdvTable > tbody:last-child').append(html);
                                    document.getElementById('codigoprod').value = "0";
                                    $("codigoprod select").val("0");
                                    
                                    var ids = document.getElementById('IdsCompra').value;
                                    var qtd = document.getElementById('qtdCompra').value;
                                    var val = document.getElementById('valCompra').value;
                                    
                                    if(ids == 0){
                                        ids = produto.produto_id;
                                    }else{
                                        ids = ids+"¬"+produto.produto_id;
                                    }
                                    document.getElementById('IdsCompra').value = ids;
                                    
                                    if(qtd == 0){
                                        qtd = quant;
                                    }else{
                                        qtd = qtd+"¬"+quant;
                                    }
                                    document.getElementById('qtdCompra').value = qtd;
                                    
                                    if(val == 0){
                                        val = produto.produto_valor;
                                    }else{
                                        val = val+"¬"+produto.produto_valor;
                                    }
                                    document.getElementById('valCompra').value = val;
                                    
                                    var sub = document.getElementById('subtotal').value;
                                    var desc = document.getElementById('desconto').value;
                                    var aux = document.getElementById('subCaixa').value;
                                    
                                    aux = parseFloat(aux) + parseFloat(sum);
                                    document.getElementById('subCaixa').value = aux;
                                    
                                    var press = parseFloat(aux) - parseFloat(desc);
                                    
                                    document.getElementById('subtotal').value = parseFloat(aux).toFixed(2);
                                    document.getElementById('desconto2').value = parseFloat(desc).toFixed(2);
                                    document.getElementById('total2').value = parseFloat(press).toFixed(2);
                                    
                                    
                                }else{
                                    document.getElementById('qtd').value = 1;
                                }
                            }
                        }
                    }
            
                },
            });
        }else{
            if(loja == -1){
            document.getElementById( 'erroLoja' ).style.display = 'block';
            }
            if(vendedor == -1){
            document.getElementById( 'erroVendedor' ).style.display = 'block';
            }
        }
    }
    
    //Popula o input de valor total de acordo com a quantidade e o valor unitário
    function valorTotal(){
        var estq = document.getElementById('estoqueQtd').value;
        var qtd = document.getElementById('qtd').value;
        var unitario = document.getElementById('unitario').value;
        if(parseInt(estq) < parseInt(qtd)){
            $("#btnIncluir").prop("disabled",true);
            Swal.fire({
                icon: 'error',
                title: 'Temos um problema',
                text: 'Quantidade maior que estoque atual!',
            })
        }else{
            $("#btnIncluir").prop("disabled",false);
            var val = qtd * unitario;
            document.getElementById('total').value = val.toFixed(2);
        }
    }
    
    //Pega a posicao do produto e o exclui da tabela
    function deletarProduto(id){
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
                
                total = parseFloat(total) - desconto2;
                
                document.getElementById('total2').innerText = total.toFixed(2);
                
                posicaotabela--;
                table.deleteRow(i);
                
            }
        }

    
    }
    
    //Busca os dados da venda e os manda para o modal de venda
    function setaDadosModal3(){
        
        if(document.getElementById('IdsCompra').value == 0){
            Swal.fire({
                        icon: 'error',
                        title: 'Não foi realizada nenhuma compra!',
                    });
        }else{
        
            if(document.getElementById('cliente').value == ""){
                document.getElementById( 'erroCliente' ).style.display = 'block';
            }else{
                document.getElementById( 'erroCliente' ).style.display = 'none';
                
                document.getElementById("subtot").innerText = "R$ " + document.getElementById("total2").value;
                var subtotal = document.getElementById("subtotal").value;
                
                desconto = document.getElementById('desconto').value;
                
                if(desconto != ""){
                    document.getElementById('des').innerText = "R$ " + desconto;
                    var totDesconto = desconto;
                }else{
                    var totDesconto = 0;
                }
                
                acrescimo = document.getElementById("pagamento").value;
                
                if(desconto != ""){
                    document.getElementById('ac').innerText = acrescimo + " %";
                    var totAcrescimo = acrescimo;
                }else{
                    var totAcrescimo = 0;
                }
                
                var envio = $('#envioModal').val();
                
                total = parseFloat(subtotal) - parseFloat(totDesconto);
                total = total + parseFloat(envio);
                document.getElementById('tot').innerText = "R$ " + total.toFixed(2);
                document.getElementById('valorHidden').value = total;
                document.getElementById('auxTotal').value = total;
                
                var clientes = <?php echo json_encode($clientes)?>;
                var cliente = document.getElementById('cliente').value;
                var flag = 0;
                for(var i=0; i<clientes.length; i++) {
                    if(clientes[i].cliente_id == cliente){
                        document.getElementById('cl').innerText = clientes[i].cliente_nome;
                        document.getElementById('clienteHidden').value = clientes[i].cliente_id;
                        flag = 1;
                    }    
                }
    
                if(flag == 0){
                    document.getElementById('cl').innerText = "CONSUMIDOR";
                    document.getElementById('clienteHidden').value = "0";
                }
                
                
                $('#modalFinalizar').modal('show');
                
            }
            
        }
    }
    
    function valueacrescimo() {
        var total =  document.getElementById('auxTotal').value;
        var dados = new FormData();
        dados.append('pagamento', document.getElementById('pagamento').value);
        $.ajax({
            url: '<?php echo base_url('pdv/acrescimo'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(erro);
            },
            success: function(data) {
                console.log(data.acrescimo_forma);
                document.getElementById('ac').innerText = data.acrescimo_forma+"%";
                var acre = (parseFloat(total) * (1+(parseFloat(data.acrescimo_forma)/100)));
                var valueA = (parseFloat(total) * (parseFloat(data.acrescimo_forma/100)));
                document.getElementById('valorAcrescimo').value = parseFloat(valueA).toFixed(2);
                document.getElementById('valorHidden').value = parseFloat(acre).toFixed(2);
                document.getElementById('tot').innerText = "R$ "+parseFloat(acre).toFixed(2);
            }
        });
    }
    
    function testeExclui(){
        alert("teste excluir");
    }
    
    function deleteItem(row){
        $('#'+row).remove();
        
        var ids = document.getElementById('IdsCompra').value;
        var splitIds = ids.split("¬");
        splitIds.splice(row-1, 1, 0);
        ids = splitIds.join('¬')
        document.getElementById('IdsCompra').value = ids;
        
        var qtd = document.getElementById('qtdCompra').value;
        var splitQtd = qtd.split("¬");
        splitQtd.splice(row-1, 1, 0);
        qtd = splitQtd.join('¬')
        document.getElementById('qtdCompra').value = qtd;
        
        var val = document.getElementById('valCompra').value;
        var splitVal = val.split("¬");
        splitVal.splice(row-1, 1, 0.0);
        val = splitVal.join('¬')
        document.getElementById('valCompra').value = val;
        
        var sum = parseFloat(0);
        
        for(var i =0; i<splitVal.length; i++){
            sum = parseFloat(sum) + parseFloat(splitVal[i]); 
        }
        
        document.getElementById('subtotal').value = parseFloat(sum).toFixed(2);
        document.getElementById('subCaixa').value = parseFloat(sum).toFixed(2);

    }
    
    //Percorre a tabela de produtos, os insere na tabela de lista e manda os dados 
    //da compra para serem inseridos no bd
    function finalizaCompra(){
        var tipo = document.getElementById('pagamento').value;
        
        if(tipo == '0'){
            checaForma();
            $("#fimCompra").hide();
        }else if(tipo == "troca"){
            trocaCompra();
        }else{
            encerraCompra();
        }
    }
    
    function encerraCompra(){
        
        var dados = new FormData();
        dados.append('cliente_id', document.getElementById('clienteHidden').value);
        dados.append('id_lista', document.getElementById('IdsCompra').value);
        dados.append('qtd_lista', document.getElementById('qtdCompra').value);
        dados.append('val_lista', document.getElementById('valCompra').value);
        dados.append('pagForm', $("#pagamento").val());
        dados.append('desc', document.getElementById('desconto2').value);
        dados.append('loja', document.getElementById('loja_id').value);
        dados.append('vendedor', document.getElementById('vendedor_id').value);
        dados.append('frete', document.getElementById('envioModal').value);
        dados.append('valorAcrescimo', document.getElementById('valorAcrescimo').value);
        dados.append('formaFrete', $("#formaEnvio option:selected").text());
        
        $.ajax({
            url: '<?php echo base_url('pdv/finalizaCompra'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                console.log(data);
                if(data.id != "" || data.id != null){
                    let timerInterval
                    Swal.fire({
                      title: 'Compra finalizada!',
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft();
                        }, 100)
                      },
                      willClose: () => {
                        clearInterval(timerInterval)
                      }
                    }).then((result) => {
                      /* Read more about handling dismissals below */
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                      }
                    })
                        window.location.reload();
                        window.open('<?php echo base_url('impressoes/geraCupom/');?>'+data.id, '_blank');
                        console.log(data.id);
                        
                }else{
                    let timerInterval
                    Swal.fire({
                      title: 'Erro ao finalizar venda, repita a operação!',
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft();
                        }, 100)
                      },
                      willClose: () => {
                        clearInterval(timerInterval)
                      }
                    }).then((result) => {
                      /* Read more about handling dismissals below */
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                      }
                    })
                        window.location.reload();
                }
            },
        });
    }
    
    function trocaCompra(){
        $('#modalFinalizar').modal('toggle');
        $('#modalTroca').modal('show');
        $('#trocaNovo').empty();
        
        var dados = new FormData();
        dados.append('lista', document.getElementById('IdsCompra').value);
        dados.append('loja', document.getElementById('loja_id').value);

        $.ajax({
            url: '<?php echo base_url('pdv/trocaLista'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                $('#trocaNovo').append(JSON.parse(data));
                document.getElementById('listTroca').value = document.getElementById('IdsCompra').value;
                document.getElementById('clienteId').value = document.getElementById('cliente').value;
                document.getElementById('lojaId').value = document.getElementById('loja_id').value;
                document.getElementById('vendedorId').value = document.getElementById('vendedor_id').value;
            }
        });
    }

    //Atualiza o acréscimo e o total final da barra azul quando eu mudar o acréscimo do input
    function mudarAcrescimo(){
        desconto = document.getElementById('desconto').value;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        if(desconto != "" && desconto != "0"){
            desconto2 = desconto;
            total -= desconto2;
        }
        
        document.getElementById('total2').innerText = total.toFixed(2);
    }
    
    //Atualiza o desconto e o total final da barra azul quando eu mudar o desconto do input
    function mudarDesconto(){
        
        desconto = document.getElementById('desconto').value;
        var subtotal = parseFloat(document.getElementById('subtotal').innerText);
        
        document.getElementById('desconto2').innerText = desconto;
        document.getElementById('desconto2').value = parseFloat(desconto).toFixed(2);
        total = subtotal - desconto;
        
        document.getElementById('total2').innerText = total;
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
            url: '<?php echo base_url('validarLogin'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data === 1){
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
        var flag = 0;
        dados = new FormData();
        
        if(document.getElementById('nome').value != ""){
            $('#nome_erro').hide();
            dados.append('nome', document.getElementById('nome').value);
        }else{
            flag = 1;
            $('#nome_erro').html("Campo Obrigatório");
            $('#nome_erro').show();
        }
        
        if(document.getElementById('cpf').value != ""){
            $('#cpf_erro').hide();
            dados.append('cpf', document.getElementById('cpf').value);
        }else{
            flag = 1;
            $('#cpf_erro').html("Campo Obrigatório");
            $('#cpf_erro').show();
        }
        
        if(document.getElementById('estado').value != ""){
            $('#estado_erro').hide();
            dados.append('estado', document.getElementById('estado').value);
        }else{
            flag = 1;
            $('#estado_erro').html("Campo Obrigatório");
            $('#estado_erro').show();
        }
        
        if(document.getElementById('cidade').value != ""){
            $('#cidade_erro').hide();
            dados.append('cidade', document.getElementById('cidade').value);
        }else{
            flag = 1;
            $('#cidade_erro').html("Campo Obrigatório");
            $('#cidade_erro').show();
        }
        
        /*if(document.getElementById('endereco').value != ""){
            dados.append('endereco', document.getElementById('endereco').value);
        }else{
            flag = 1;
            $('#endereco_erro').html("Campo Obrigatório");
            $('#endereco_erro').show();
        }*/
        
        if(document.getElementById('email').value != ""){
            $('#email_erro').hide();
            dados.append('email', document.getElementById('email').value);
        }else{
            flag = 1;
            $('#email_erro').html("Campo Obrigatório");
            $('#email_erro').show();
        }
        
        if(document.getElementById('telefone').value != ""){
            $('#telefone_erro').hide();
            dados.append('telefone', document.getElementById('telefone').value);
        }else{
            flag = 1;
            $('#telefone_erro').html("Campo Obrigatório");
            $('#telefone_erro').show();
        }
        
        if(document.getElementById('cep').value != ""){
            $('#cep_erro').hide();
            dados.append('cep', document.getElementById('cep').value);
        }else{
            flag = 1;
            $('#cep_erro').html("Campo Obrigatório");
            $('#cep_erro').show();
        }
        
        if(document.getElementById('logra').value != ""){
            $('#logra_erro').hide();
            dados.append('logra', document.getElementById('logra').value);
        }else{
            flag = 1;
            $('#logra_erro').html("Campo Obrigatório");
            $('#logra_erro').show();
        }
        
        if(document.getElementById('endnum').value != ""){
            $('#endnum_erro').hide();
            dados.append('endnum', document.getElementById('endnum').value);
        }else{
            flag = 1;
            $('#endnum_erro').html("Campo Obrigatório");
            $('#endnum_erro').show();
        }
        
        if(document.getElementById('loja_id').value != ""){
            $('#loja_erro').hide();
            dados.append('loja', document.getElementById('loja_id').value);
        }else{
            flag = 1;
            $('#loja_erro').html("Obrigatório informar uma Loja");
            $('#loja_erro').show();
        }
        
        if(flag == 0){
        
            $.ajax({
                url: base_url+"completarcadastro/cadastrarCliente",
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
                            //$('#modalCliente').modal('hide');
                            //$('#cliente').html(data);
                            location.reload();
                        }
                    }
                    
                },
            });
        
        }
    }
    
    function buscaModelos(valor){
        document.getElementById('divhidden').style.display = 'block';
        $.post(base_url+"pdv/modelosProd", {
            valor : valor
        }, function(data){
            $('#codigo').html(data);
        });
    }


    function newListaTroca(id){
        dados = new FormData();
        dados.append('row', id);
        $.ajax({
            url: '<?php echo base_url('pdv/newSelectTrocaLista'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                $('#listaTroca'+id).after(JSON.parse(data));
                $('.js-example-basic-multiple').select2();
            }
        });
    }
    
    function diferenca(valor){
        var sum0 = 0.0;
        var sum1 = 0.0;
        var final = 0.0; 
        
        $('input[name^="valorTroca"]').each( function( i , e ) {
            var v = parseFloat( $( e ).val() );
            if ( !isNaN( v ) )
                sum0 += v;
        } );

        $('input[name^="trocaValorNovo"]').each( function( i , e ) {
            var v = parseFloat( $( e ).val() );
            if ( !isNaN( v ) )
                sum1 += v;
        } );
        
        final = sum1 - sum0;
        $("#trocaDiferenca").val(parseFloat(final));
        if(final <=0){
            $("#pagamentoTroca").prop("disabled",true);
        }else{
            $("#pagamentoTroca").prop("disabled",false);
        }
    }
    
    function submitTroca(){
        
        var diferenca = document.getElementById('trocaDiferenca').value;
        
        if(parseFloat(diferenca) <= parseFloat(0)){
            document.getElementById("formTroca").submit();
        }else{
            Swal.fire({
                title: 'Confirma o recebimento de R$'+diferenca+'?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: `Não`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Troca realizada!', '', 'success');
                    document.getElementById("formTroca").submit();
                } else if (result.isDenied) {
                    Swal.fire('Existe valor a ser pago.', '', 'info');
                }
            })
        }
    }


    
    function cancelaCompra(){
        dados = new FormData();
        dados.append('usuario', document.getElementById("usuarioDesconto1").value);
        dados.append('senha', document.getElementById("senhaDesconto1").value);
        $.ajax({
            url: '<?php echo base_url('pdv/cancelaCompra'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',            
            success: function(data) {
                if(data.success == "Confere"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Compra Cancelada',
                    });
                    $('#modalCancelaUltimaVenda').modal('hide');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuário/Senha errado',
                    });
                    $('#modalCancelaUltimaVenda').modal('hide');
                }
            }
        });
    }
    function fechaCaixa(){
        dados = new FormData();
        dados.append('usuario', document.getElementById("usuarioDesconto2").value);
        dados.append('senha', document.getElementById("senhaDesconto2").value);
        $.ajax({
            url: '<?php echo base_url('pdv/fechaCaixa'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                console.log(data.success);
                if(data.success == "Confere"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Caixa Fechado',
                    });
                    $('#modalFechaCaixa').modal('hide');
                    setTimeout(function() {
                        location.replace('<?php echo base_url('106a6c241b8797f52e1e77317b96a201');?>');
                        window.open('<?php echo base_url('impressoes/fechaCaixa');?>', '_blank');
                    }, 1500)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuário/Senha errado',
                    });
                    $('#modalFechaCaixa').modal('hide');
                }
            }
        });
    }
    function ultimaVenda(){
        dados = new FormData();
        dados.append('funcionario', <?php echo $_SESSION['func_id'];?>);
        dados.append('loja', <?php echo $_SESSION['loja_id'];?>);
        $.ajax({
            url: '<?php echo base_url('pdv/fechaCaixa'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                console.log(data.success);
                if(data.success == "Confere"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Caixa Fechado',
                    });
                    $('#modalFechaCaixa').modal('hide');
                    setTimeout(function() {
                        location.replace('<?php echo base_url('106a6c241b8797f52e1e77317b96a201');?>');
                        window.open('<?php echo base_url('impressoes/fechaCaixa');?>', '_blank');
                    }, 1500)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuário/Senha errado',
                    });
                    $('#modalFechaCaixa').modal('hide');
                }
            }
        });
    }


    function valueacrescimo2(forma, id) {
        var total =  document.getElementById('auxTotal').value;
        var dados = new FormData();
        dados.append('pagamento', forma);
        $.ajax({
            url: '<?php echo base_url('pdv/acrescimo'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(erro);
            },
            success: function(data) {
                if(id == 1){
                    $("#dualAcrescimo1").val(data.acrescimo_forma);
                }else if(id == 2){
                    $("#dualAcrescimo2").val(data.acrescimo_forma);
                }
                
                var a = parseFloat($("#dualAcrescimo1").val()).toFixed(2);
                var b = parseFloat($("#dualAcrescimo2").val()).toFixed(2);
                var sum = parseFloat(a) + parseFloat(b);
                $("#dualAcresTotal").val(sum);
                
                document.getElementById('ac').innerText = $("#dualAcresTotal").val()+"%";
                var acre = (parseFloat(total) * (1+(parseFloat($("#dualAcresTotal").val())/100)));
                document.getElementById('valorHidden').value = parseFloat(acre).toFixed(2);
                document.getElementById('tot').innerText = "R$ "+parseFloat(acre).toFixed(2);
            }
        });
    }
    
    function validavalor(valor){
        if($("#auxValRest").val() == ""){
            var tot = $("#valorHidden").val();
            var rest = parseFloat(tot) - parseFloat(valor);
        }else{
            var hidd = $("#valorHidden").val();
            var aux1 = $("#pagamento1").val();
            var aux2 = $("#pagamento2").val();
            var form1 = $("#forma1").val();
            var form2 = $("#forma2").val();
            var rest = parseFloat(hidd) - ( parseFloat(aux1) + parseFloat(aux2) );
            var help = aux1+"¬"+aux2;
            var help2 = form1+"¬"+form2;
            
        }
        
        $("#auxValRest").val(parseFloat(rest).toFixed(2));
        
        $('#pagamento_erro').html("Falta " + parseFloat($("#auxValRest").val()).toFixed(2) + " do valor total.");
        if(parseFloat(rest).toFixed(2) != parseFloat(0).toFixed(2)){
            $('#erroForma').hide();
            $('#pagamento_erro').show();
        }else{
            var button = "<button type='button' class='btn btn-success' onclick='encerraCompra2()'>Finalizar Venda</button>";
            $('#hiddenForma').val(help);
            $('#hiddenForma2').val(help2);
            $('#pagamento_erro').hide();
            $('#dualFimCompra').append(button);
            $('#dualFimCompra').show();
        }
    }
    
    function encerraCompra2(){
        
        var dados = new FormData();
        dados.append('cliente_id', document.getElementById('clienteHidden').value);
        dados.append('id_lista', document.getElementById('IdsCompra').value);
        dados.append('qtd_lista', document.getElementById('qtdCompra').value);
        dados.append('val_lista', document.getElementById('valCompra').value);
        dados.append('pagForm', $("#hiddenForma2").val());
        dados.append('desc', document.getElementById('desconto2').value);
        dados.append('loja', document.getElementById('loja_id').value);
        dados.append('vendedor', document.getElementById('vendedor_id').value);
        dados.append('frete', document.getElementById('envioModal').value);
        dados.append('formaFrete', $("#formaEnvio option:selected").text());
        dados.append('valForm', $("#hiddenForma").val());
                        
        $.ajax({
            url: '<?php echo base_url('pdv/finalizaCompra'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                console.log(data);
                if(data.id != "" || data.id != null){
                    let timerInterval
                    Swal.fire({
                      title: 'Compra finalizada!',
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft();
                        }, 100)
                      },
                      willClose: () => {
                        clearInterval(timerInterval)
                      }
                    }).then((result) => {
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                      }
                    })
                        window.location.reload();
                        window.open('<?php echo base_url('impressoes/geraCupom/');?>'+data.id, '_blank');
                        console.log(data.id);
                        
                }else{
                    let timerInterval
                    Swal.fire({
                      title: 'Erro ao finalizar venda, repita a operação!',
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft();
                        }, 100)
                      },
                      willClose: () => {
                        clearInterval(timerInterval)
                      }
                    }).then((result) => {
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                      }
                    })
                        window.location.reload();
                }
            },
        });
    }


    function verificaSenha(local){
        var verify = $("#loja_id").val();
        if(verify != 0){
            if(local == "cancela"){
                $("#modalCancelaUltimaVenda").modal('toggle');
            }else if(local == "reimprime"){
                $("#modalReimprimeUltimaVenda").modal('toggle');
            }else if(local == "fecha"){
                $("#modalFechaCaixa").modal('toggle');
            }
        }else{
            if(local == "cancela"){
                Swal.fire('Administrador do Sistema não pode cancelar compras.');
            }else if(local == "reimprime"){
                Swal.fire('Administrador do Sistema não pode reimprimir compras.');
            }else if(local == "fecha"){
                Swal.fire('Administrador do Sistema não pode fechar o caixa.');
            }
        }
    }


        function liberaTroca(){
        var id = $("#cliente").val();
        if(id != 1){
            var opt = "<option value='troca'>Troca</option>";
            $('#pagamento').append(opt);
        }else{
            $("#pagamento option:contains(Troca)").remove();
        }
    }