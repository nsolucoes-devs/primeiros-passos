<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    $auxfooter = 0;
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $sm = 1;
    } else {
        $sm = 0;
    }
?>

<style>
    .nome-form{
        color: black;
        font-size: 16px;
    }
    .nav-tabs {
        background: transparent;
    }
    .nav-tabs {
        border-bottom: 1px transparent;
    }
    .nav-item{
        color: #555;
        cursor: default;
        border-radius: 4px 4px 0 0;
        background-color: #dedede;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .c-card{
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 14%);
        border: 0;
        margin-bottom: 30px;
        margin-top: 30px;
        border-radius: 6px;
        color: #333333;
        background: #fff;
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
    }
    
    .c-card-header{
        text-align: right;
        margin: 0px 15px 0;
        padding: 0;
        position: relative;
        z-index: 3 !important;
        color: #fff;
        border-bottom: none;
        background: transparent;
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        padding-bottom: 15px;
    }
    
    .c-card-icon{
        border-radius: 3px;
        background-color: #999999;
        padding: 15px;
        margin-top: -20px;
        margin-right: 15px;
        float: left;
    }
        
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
    }
    
    .gui-pd-10{
        padding: 10px;
    }
    
    .active{
        border-bottom: 1px solid white;
        z-index: 1;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style=" margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Financeiro</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>">Pedidos</a></li>
                <li class="breadcrumb-item" aria-current="page">Adicionar</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Adicionar Pedido</b></h2>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>"><i style="margin-top: 10px; border: 1px solid #1b9045; padding: 7px; border-radius: 5px; background-color: #1b9045; font-size: 17px; color: white" class="fa fa-reply" aria-hidden="true">VOLTAR</i></a>
                    </div>
                </div>
            </div>
            <form id="cadastrar-pedido" action="<?php echo base_url('admin/adminpedidos/cadastrarPedido') ?>" method="post">
                <input type="hidden" name="qtds" id="qtds">
                <input type="hidden" name="ids" id="ids">
                <input type="hidden" name="precos" id="precos">
                <input type="hidden" name="total" id="total">
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class=col-md-6>
                                        <div class="c-card">
                                            <div class="c-card-body" style="display: block;">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 text-left">
                                                            <p style="margin-top: 3%; font-size: 18px; color: #1b9045;"><b>INFORMAÇÕES DO PEDIDO</b></p>
                                                        </div>
                                                    </div>
                                                    <table>
                                                        <tr>
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-calendar" aria-hidden="true" title="Data do Pedido"></i></td>
                                                            <td style="width: 100%; padding: 10px;">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label><b>Selecione a Data:</b></label>
                                                                        <input type="date" name="data" id="data" class="form-group form-control" value="<?php echo date('Y-m-d') ?>" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label><b>Selecione a Hora:</b></label>
                                                                        <input type="time" name="hora" id="hora" class="form-control" value="<?php echo date('H:i') ?>" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top: 1px solid lightgrey;">
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-credit-card" aria-hidden="true" title="Forma de Pagamento"></i></td>
                                                            <td style="padding: 10px">
                                                                <label><b>Selecione a Forma de Pagamento:</b></label>
                                                                <select class="js-example-basic-multiple" name="forma" id="forma" style="width: 100%" required>
                                                                    <option value="Boleto">Boleto</option>
                                                                    <option value="MercadoPago">MercadoPago</option>
                                                                    <option value="Cartao de credito">Cartão de crédito</option>
                                                                    <option value="Pagar ao retirar na loja">Pagar ao retirar na loja</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top: 1px solid lightgrey;">
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-truck" aria-hidden="true" title="Frete"></i></td>
                                                            <td style="padding: 10px">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label><b>Selecione o Frete:</b></label>
                                                                        <select class="js-example-basic-multiple" name="frete" id="frete" style="width: 100%" required>
                                                                            <option>Sedex</option>
                                                                            <option>Pac</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label><b>Valor do Frete:</b></label>
                                                                        <input onfocusout="somarTudo()" type="text" class="money form-control" id="valor_frete" name="valor_frete" value="0" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=col-md-6>
                                        <div class="c-card">
                                            <div class="c-card-body" style="display: block">
                                                <div class="col-md-12" style="margin-bottom: 5%;">
                                                    <div class="row">
                                                        <div class="col-md-12 text-left">
                                                            <p style="margin-top: 3%; font-size: 18px; color: #1b9045;"><b>INFORMAÇÕES DO CLIENTE</b></p>
                                                        </div>
                                                    </div>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-user" aria-hidden="true" title="Nome do Cliente"></i>
                                                            </td>
                                                            <td  style="padding: 10px; width: 100%">
                                                                <label><b>Selecione o Cliente:</b></label>
                                                                <select class="js-example-basic-multiple" onchange="pegarCliente()" name="cliente" id="cliente" style="width: 100%" required>
                                                                    <option value="" selected disabled> Selecione </option>
                                                                    <?php foreach($clientes as $c){ ?>
                                                                        <option value="<?php echo $c['cliente_id'] ?>"><?php echo $c['cliente_nome'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top: 1px solid lightgrey;">
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-address-card"  aria-hidden="true" title="CPF do Cliente"></i></td>
                                                            <td id="cpf_cliente">Selecione o cliente</td>
                                                        </tr>
                                                        <tr style="border-top: 1px solid lightgrey;">
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-phone" aria-hidden="true" title="Telefone do Cliente"></i></td>
                                                            <td id="telefone_cliente">Selecione o cliente</td>
                                                        </tr>
                                                        <tr style="border-top: 1px solid lightgrey;">
                                                            <td><i style="font-size: 25px; color: #1d6e3a; padding: 10px" class="fa fa-map-marker" aria-hidden="true" title="Localidade do Cliente"></i></td>
                                                            <td id="email_cliente">Selecione o cliente</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="c-card">
                                            <div class="c-card-header">
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <h2 style="color: #1b9045;"><b>Endereço para entrega</b></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-card-body" style="display: block">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2 form-group">
                                                                    <label><b>Cep:</b></label>
                                                                    <input type="text" name="cep" id="cep" class="cep form-control" required>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label><b>Rua:</b></label>
                                                                    <input type="text" name="rua" id="rua" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-2 form-group">
                                                                    <label><b>Número:</b></label>
                                                                    <input type="text" name="numero" id="numero" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-2 form-group">
                                                                    <label><b>Complemento:</b></label>
                                                                    <input type="text" name="complemento" id="complemento" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-4 form-group">
                                                                    <label><b>Bairro:</b></label>
                                                                    <input type="text" name="bairro" id="bairro" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label><b>Cidade:</b></label>
                                                                    <input type="text" name="cidade" id="cidade" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label><b>Estado:</b></label>
                                                                    <select class="js-example-basic-multiple" style="width: 100%" id="estado" name="estado" required>
                                                                        <option value="AC">Acre</option>
                                                                    	<option value="AL">Alagoas</option>
                                                                    	<option value="AP">Amapá</option>
                                                                    	<option value="AM">Amazonas</option>
                                                                    	<option value="BA">Bahia</option>
                                                                    	<option value="CE">Ceará</option>
                                                                    	<option value="DF">Distrito Federal</option>
                                                                    	<option value="ES">Espírito Santo</option>
                                                                    	<option value="GO">Goiás</option>
                                                                    	<option value="MA">Maranhão</option>
                                                                    	<option value="MT">Mato Grosso</option>
                                                                    	<option value="MS">Mato Grosso do Sul</option>
                                                                    	<option value="MG">Minas Gerais</option>
                                                                    	<option value="PA">Pará</option>
                                                                    	<option value="PB">Paraíba</option>
                                                                    	<option value="PR">Paraná</option>
                                                                    	<option value="PE">Pernambuco</option>
                                                                    	<option value="PI">Piauí</option>
                                                                    	<option value="RJ">Rio de Janeiro</option>
                                                                    	<option value="RN">Rio Grande do Norte</option>
                                                                    	<option value="RS">Rio Grande do Sul</option>
                                                                    	<option value="RO">Rondônia</option>
                                                                    	<option value="RR">Roraima</option>
                                                                    	<option value="SC">Santa Catarina</option>
                                                                    	<option value="SP">São Paulo</option>
                                                                    	<option value="SE">Sergipe</option>
                                                                    	<option value="TO">Tocantins</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="c-card">
                                            <div class="c-card-header">
                                                <div class="row">
                                                    <div class="col-md-12 text-left">
                                                        <h2 style="color: #1b9045;"><b>Produto(s)</b></h2>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-3" style="margin-left:-10%">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduto">Adicionar Produto</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="c-card-body" style="display: block">
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-top: 2%;">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive" style="width: 100%">
                                                                <table class="table c-table" id="table-produtos">
                                                                    <tr style="border-bottom: 1px solid lightgrey;">
                                                                        <th style="color: #1b9045; width: 40%; padding: 10px;"><b>Produto</b></th>
                                                                        <th style="color: #1b9045; width: 5%"><b>Quantidade</b></th>
                                                                        <th style="color: #1b9045; width: 8%"><b>Valor</b></th>
                                                                        <th style="color: #1b9045; width: 8%"><b>Total</b></th>
                                                                        <th style="color: #1b9045; width: 8%"><b>Ação</b></th>
                                                                    </tr>
                                                                    
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="display: flex;">
                                                    <div class="text-right col-md-10">
                                                        <h4 style="margin: 0; padding: 10px;"><b>Sub-Total</b></h4>
                                                        <h4 style="margin: 0; padding: 10px;"><b>Frete</b></h4>
                                                        <h4 style="margin: 0; padding: 10px;"><b>Desconto</b></h4>
                                                        <h4 style="color: #1b9045; margin: 0; padding: 10px;"><b>Total</b></h4>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p style="margin: 0; padding: 10px; padding-left: 32px;">R$ <span id="p-sub">0,00</span></p>
                                                        <p style="margin: 0; padding: 10px; padding-left: 32px;">R$ <span id="p-frete">0,00</span></p>
                                                        <p style="margin: 0; padding: 10px; padding-left: 32px;">
                                                            <input onfocusout="somarTudo()" type="text" name="desconto" id="desconto" class="money form-control" value="0" required>
                                                        </p>
                                                        <h4 style="color: #1b9045; margin: 0; padding: 10px; padding-left: 32px;"><b>R$ </b><span style="font-weight: bold;" id="p-total">0,00</span></h4>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="c-card">
                                        <div class="c-card-header">
                                            <div class="row">
                                                <div class="col-md-12 text-left">
                                                    <h2 style="color: #1b9045;"><b>Histórico</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-card-body" style="display: block">
                                            <div class="col-md-12" style="padding-top: 25px; display: block;" id="historico">
                                                <div class="col-md-12 form-group">
                                                    <label>Situação do pedido</label>
                                                    <select style="width: 100%!important" class="js-example-basic-multiple" name="status" id="status">
                                                        <option value=""> Selecione </option>
                                                        <option value="4" selected>Aguardando Pagamento</option>
                                                        <option value="5">Cancelado</option>
                                                        <option value="6">Negado</option>
                                                        <option value="7">Estorno</option>
                                                        <option value="8">Aprovado</option>
                                                        <option value="9">Em Separação</option>
                                                        <option value="10">Enviado</option>
                                                        <option value="11">Entregue</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Notificar Cliente?</label>
                                                    <input type="checkbox" id="notificar" name="notificar" value="1">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Comentário</label>
                                                    <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12 text-center form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="button" onclick="submitPedido()" class="btn btn-primary">Adicionar</button>
                                            &nbsp;&nbsp;
                                            <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>" style="margin-right: 15px;" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                                
                </div>
            </form>
    </section>
</section>

<!-- Modal -->
<div class="modal fade" id="addProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);">
        <h5 class="modal-title" style="color: white; display: inline;" id="exampleModalLabel">Adicionar Produto</h5>
        <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label><b>Produto:</b></label>
                <select class="js-example-basic-multiple" id="produto" name="produto" required onchange="insereValor()">
                    <option value="" selected disabled> Selecione </option>
                    <?php foreach($produtos as $p){ ?>
                        <option value="<?php echo $p['produto_id'] ?>"><?php echo $p['produto_nome'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label><b>Quantidade:</b></label>
                <input type="number" id="qtd" name="qtd" class="form-control" min="1">
            </div>
            <div class="col-md-6 form-group">
                <label><b>Valor Un.:</b></label>
                <input type="text" id="preco" name="preco" class="money form-control" >
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button onclick="addProduto()" type="button" class="btn btn-primary" data-dismiss="modal">Adicionar</button>
      </div>
    </div>
  </div>
</div>


<script type="application/javascript">
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
</script>
<script>
    function insereValor(){
        var x = document.getElementById("produto").value;
        
        dados = new FormData();
        dados.append('id', x);
        $.ajax({
            url: '<?php echo base_url('admin/Adminpedidos/dinamicoGetProduto'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                alert('Error, check console');
                console.log(xhr.responseText);
            },
            success: function(data) {
                $("#preco").val(data.produto_valor);
                $("#qtd").val(1);
            },
        });
    }
</script>

<script>
    function historico(){
        $('#historico').show();
        $('#li_historico').addClass('active');
        $('#adicional').hide();
        $('#li_adicional').removeClass('active');
    }
    
    function adicional(){
        $('#historico').hide();
        $('#li_historico').removeClass('active');
        $('#adicional').show();
        $('#li_adicional').addClass('active');
    }
</script>

<script>
    function addProduto(){
        var nome    = $("#produto option:selected").text();
        var id      = $('#produto').val();
        var qtd     = $('#qtd').val();
        var preco   = $('#preco').val();
        
        var total = qtd * parseFloat(preco);
        
        var boolean = analisaMesmoProduto(id);
        
        if(boolean == true){
           var linha = "<tr class='tr-produtos' id='produto_"+id+"'>" +
            "<td>"+nome+"</td>" + 
            "<td id='qtd_"+id+"'>"+qtd+"</td>" + 
            "<td id='preco_"+id+"'>"+preco+"</td>" + 
            "<td id='total_"+id+"' >"+total+"</td>" + 
            "<td><button type='button' onclick='excluirProduto("+id+")' class='btn btn-danger'><i class='fa fa-times aria-hidden='true'></i></button></td>" + 
            "</tr>";
            
            $('#table-produtos').append(linha); 
        }
        
        somarTudo();
        montarValoresSubmit();
    }
</script>

<script>
    function analisaMesmoProduto(id){
        const produto = document.getElementById("produto_"+id);
        if(produto){
            $('#qtd_'+id).html(parseInt($('#qtd_'+id).html()) + parseInt($('#qtd').val()));
            return false;
        } else {
            return true;    
        }
        
    }
</script>

<script>
    function somarTudo(){
        frete       = parseFloat($('#valor_frete').val().replaceAll('.','').replace(',','.'));
        desconto    = parseFloat($('#desconto').val().replaceAll('.','').replace(',','.'));
        total_geral = 0;
        
        $('.tr-produtos').each(function(){
            var aux = $(this).prop('id');    
            var id = aux.split('_');
            
            var qtd     = parseInt($('#qtd_'+id[1]).html());
            var preco   = parseFloat($('#preco_'+id[1]).html().replaceAll('.','').replace(',','.'));

            var total = qtd * preco;
            
            total_geral = total_geral + total;
            
            $('#total_'+id[1]).unmask().html(total.toFixed(2)).mask("#.##0,00", {reverse: true});
        });
        
        $('#p-sub').unmask().html(total_geral.toFixed(2)).mask("#.##0,00", {reverse: true});
        $('#p-frete').unmask().html(frete.toFixed(2)).mask("#.##0,00", {reverse: true});
        
        total_geral = total_geral +  frete - desconto;
        
        $('#p-total').unmask().html(total_geral.toFixed(2)).mask("#.##0,00", {reverse: true});
    }
</script>

<script>
    function excluirProduto(id){
        $('#produto_'+id).remove();
    }
</script>

<script>
    function montarValoresSubmit(){
        var x           = 0;
        var ids         = "";
        var qtds        = "";
        var precos      = "";
        var total_geral = 0;
        var frete       = 0;
        var desconto    = 0;
        
        $('.tr-produtos').each(function(){
            var aux     = $(this).prop('id');    
            var id      = aux.split('_');
            
            var qtd         = parseInt($('#qtd_'+id[1]).html());
            var preco       = parseFloat($('#preco_'+id[1]).html().replaceAll('.','').replace(',','.'));
            var total       = parseFloat($('#total_'+id[1]).html().replaceAll('.','').replace(',','.'));

            total_geral = total_geral + total;

            if(x == 0){
                ids = id[1];
                qtds = qtd;
                precos = preco.toFixed(2);
            } else {
                ids     = ids + '¬' + id[1];
                qtds    = qtds + '¬' + qtd;
                precos  = precos + '¬' + preco.toFixed(2);
            }
            
            x++;
        });
        
        frete       = parseFloat($('#valor_frete').val().replaceAll('.','').replace(',','.'));
        desconto    = parseFloat($('#desconto').val().replaceAll('.','').replace(',','.'));
        
        total_geral = total_geral;
        
        $("#ids").val(ids);
        $("#qtds").val(qtds);
        $("#precos").val(precos);
        $("#total").val(total_geral);
    }
</script>

<script>
    function pegarCliente(){
        dados = new FormData();
        dados.append('id', $("#cliente").val());
        $.ajax({
            url: '<?php echo base_url('admin/Adminclientes/dinamicoGetCliente'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                alert('Error, check console');
                console.log(xhr.responseText);
            },
            success: function(data) {
                var SPMaskBehavior = function (val) {
                  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                  onKeyPress: function(val, e, field, options) {
                      field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
                
                $("#cpf_cliente").unmask().html(data.cliente_cpf).mask('000.000.000-00', {reverse: true});
                $("#telefone_cliente").unmask().html(data.cliente_telefone).mask(SPMaskBehavior, spOptions);
                $("#email_cliente").html(data.cliente_email);
                
                $("#cep").unmask().val(data.cliente_cep).mask('00000-000');
                $("#rua").val(data.cliente_endereco);
                $("#numero").val(data.cliente_numero);
                $("#complemento").val(data.cliente_complemento);
                $("#bairro").val(data.cliente_bairro);
                $("#cidade").val(data.cliente_cidade);
                $("#estado").val(data.cliente_estado).change();
            },
        });
    }
</script>

<script>
    function submitPedido(){
        montarValoresSubmit();
        $('#cadastrar-pedido').submit();
    }
</script>