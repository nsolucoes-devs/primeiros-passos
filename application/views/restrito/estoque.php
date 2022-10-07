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
    
    .tab-li a{
        cursor: pointer;
    }
    
    .label-imagem{
        margin-top: 10px;
    }
    
    #select2-produtos2-container{
        height: 50px!important;
    }
    
    .active-tab2{
       border: 1px solid lightgrey;
       border-bottom: solid white!important;
       border-radius: 3px;
    }
    
    .search-field{
        width: 200px;
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
    }

</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Lojas</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminestoque/estoques') ?>">Estoques</a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <?php if(isset($flag) && $flag == 1){ echo "Visualizar";}
                        elseif(isset($inser) && $inser == 1){ echo "Editar";}
                        else{ echo "Adicionar";} ?></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b>
                            <?php if(isset($flag) && $flag == 1){ echo "Visualizar";}
                            elseif(isset($inser) && $inser == 1){ echo "Editar";}
                            else{ echo "Adicionar";} ?> Estoque</b></h2>
                    </div>
                </div>
            </div>
            <form action="<?php echo base_url('admin/adminestoque/estoques');?>" method="post" enctype='multipart/form-data' id="form">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                                <br>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-5 form-group">
                                                <label><b>Tipo:</b></label>
                                                <select id="tipo_estoque_cadSel" name="tipo_estoque_cad" <?php if(isset($flag) && $flag == 1){ echo "disabled";} ?> style="width: 100%;" class="form-control" data-live-search="true" onchange="ajuste()">
                                                    <option class="form-control" value="-1"> -- Selecione o tipo-- </option>
                                                    <option value="Entrada"> Entrada estoque </option>
                                                    <option value="Ajuste+">  Ajuste estoque (+)</option>
                                                    <option value="Ajuste-">  Ajuste estoque (-)</option>
                                                    <option value="Perda">  Perda </option>
                                                    <option value="Garantia">  Garantia </option>
                                                </select>
                                                <input readonly id="tipo_estoque_cadInp" name="tipo_estoque_cad" class="form-control" style="width: 100%!important; display:none" required>
                                                <input type="hidden" id="estoqueUpdt" name="estoqueUpdt">
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label><b>Loja:</b></label>
                                                <select id="lojaSel" name="loja" class="form-control" style="width: 100%!important" required>
                                                    <option class="form-control" value="-1"> -- Selecione a loja-- </option>
                                                    <?php foreach ($lojas as $l){ ?>
                                                        <option value="<?php echo $l['id'] ?>"><?php echo $l['nome'] ?></option>
                                                    <?php }?>
                                                </select>
                                                <input readonly id="lojaInp" name="loja" class="form-control" style="width: 100%!important; display:none">
                                                <input type="hidden" id="lojaUpdt" name="lojaUpdt">
                                            </div>
                                            <div class="col-md-2" >
                                                <div class="col-md-1" style="position: relative; left: 4%; margin-top: 13%;" id="AddProdutoDiv">
                                                    <button onclick="AddProduto()"  type="button" class="btn btn-primary" style="margin-right: 37%; position: relative;" title="Adicionar Produto"><em class="fa fa-search"></em></button>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="col-md-12">
                                            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px; margin-top: 2%;">
                                            <div class="col-md-12">
                                                <div class="c-card-body">
                                                    <div class="table-responsive" style="width: 100%">
                                                        <table class="table c-table" id="tabela2">
                                    				        <thead>
                                    				            <tr>
                                    				                <th class="text-center" style="width: 10%">ID</th>
                                    				                <th style="width: 30%">Produto</th>
                                    				                <th style="width: 15%">Valor Atual</th>
                                    				                <th style="width: 15%">Novo Valor</th>
                                    				                <th style="width: 15%">Unidades</th>
                                    				                <th style="width: 15%">Movimento</th>
                                    				                <th style="width: 10%">Confirmar</th>
                                    				             </tr>
                                    				        </thead>
                                    				        <tbody id="produtoList">
                                    				        </tbody>
                                				        </table>
                                				    </div>
                                			    </div> 
                            			    </div>
                                        </div>
                                        </div>
                                        
                                    </div>
                            </div>
                        </div>
                        <hr style="margin: 0!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>

<!-- MODAL - CADASTRAR -->
<div class="modal fade" id="add-produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: black">
        <h3 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">Adicionar Produto</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 18px; color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('restrito/estoque');?>" method="post" id="form-cad">
            <input type="hidden" id="data1" name="data1">
            <div class="row" style="padding-left: 2%; padding-right: 2%; padding-top: 3%;">
                <div class="col-md-12 form-group">
                    <label style="font-size: 17px;"><b>Produto:</b></label><br>
                    <select class="js-example-basic-multiple" id="prod_estoque_cad" name="prod_estoque_cad" onchange="selecionaestoque()" data-live-search="true">
                        <option disabled selected> -- Selecione o produto-- </option>
                        <?php foreach($produtos as $p){ ?>
                            <option value="<?php echo $p['produto_id'] ?>"><?php echo $p['produto_nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <hr style="margin: 3%!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
            <div class="row" style="padding-left: 2%; padding-right: 2%">
                <div class="col-md-12 form-group">
                    <label style="font-size: 17px;"><b>Estoque Antigo:</b></label>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Quantidade:</b></label>
                    <input type="text" id="qtd_estoque_cad" name="qtd_estoque_cad" class="form-control" placeholder="0" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Valor:</b></label>
                    <input type="text" class="form-control dinheiro" id="valor_estoque_cad" name="valor_estoque_cad" placeholder="0,00" readonly>
                    <input type="hidden" id="valor-antigo" name="valor-antigo">
                </div>
            </div>
            <hr style="margin: 3%!important; padding: 0!important; border-color: lightgrey!important; z-index: 0;">
            <div class="row" style="padding-left: 2%; padding-right: 2%;">
                <div class="col-md-12 form-group">
                    <label style="font-size: 17px;"><b>Estoque Atual:</b></label>
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Nova Qunatidade:</b></label>
                    <input type="text" id="addqtd_estoque_cad" name="addqtd_estoque_cad" class="form-control" placeholder="0">
                </div>
                <div class="col-md-6 form-group">
                    <label><b>Novo Valor:</b></label>
                    <input type="text" class="form-control dinheiro" id="novovalor_estoque_cad" name="novovalor_estoque_cad" placeholder="0,00">
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="">Adicionar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
      </form>
    </div>
  </div>
</div>


<!-- MODAL Movimento-->
<div class="modal fade" id="movimentoModalCenter" tabindex="-1" role="dialog" aria-labelledby="movimentoModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="corpoModal">
    </div>
  </div>
</div>
<!-- Fim MODAL Moviemnto-->
<style>
    .ql-snow .ql-picker.ql-size .ql-picker-label::before { content: attr(data-value)!important; }
    .ql-snow .ql-picker.ql-size .ql-picker-item::before { font-size: attr(data-value)!important; content: attr(data-value)!important; }
    .ql-picker-label .custom-content::before { content: attr(data-value)!important; }
    #editor{
        min-height: 300px;
    }
    .dataTables_filter { float:left!important; margin-left:-100%;}

</style>

<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script>
    $(document).ready(function() {
        var data = new Date();
        var dia     = data.getDate();           // 1-31
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano     = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        
        $('#data1').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
        $('#data2').val(ano + '-' + (mes+1) + '-' + dia + ' ' + hora + ':' + min + ':' + seg);
    });
</script>
<script>
    const sizes = ['10px', '12px', '14px', '16px', '18px', '20px', '22px', '24px'];
    
    var Size = Quill.import('attributors/style/size');
    Size.whitelist = sizes;
    Quill.register(Size, true);
    
    var toolbarOptions = [
        [{ 'size': sizes }],
        [{ 'font': [] }],
        
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        
        [{ 'color': [] }, { 'background': [] }],
        
        [{ 'align': [] }],
        
        ['clean']
    ];
    
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    $('.ql-picker-item').click(function(){
        $('.ql-picker-label').addClass('custom-content').attr('data-content', $(this).data('value'));
    });
</script>
<script type="application/javascript">
    $(document).ready(function(){
        $('.number').mask('0#');
        $('.money').mask("#.##0,00", {reverse: true});
        
        $('.ql-picker-item').each( function(){
            if($(this).data('value') == "14px"){
                $(this).click();
            }
        });
    });
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(".tab-li").click(function(){
        $(".tab-li").each(function(){
            var tg = $(this).data('target');
            var ft = $(this).data('fonte');
            
            $('#'+tg).hide();
            $('#'+ft).removeClass('active');
        });
        
        var tg = $(this).data('target');
        var ft = $(this).data('fonte');
        
        $('#'+tg).show();
        $('#'+ft).addClass('active');
    });
    
    $('#imagem').on('change', function(){
        if($(this).val() != ""){
            var fullPath = $('#imagem').val();
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#imagem_label').css('display', 'block').html('Selecionado: '+filename);
        }else{
            $('#imagem_label').css('display', 'none');
        }
    });
    
    $('.opcionais').on('change', function(){
        if($(this).val() != ""){
            var numFiles = $(this).get(0).files.length;
            if(parseInt(numFiles) == 1){
                var fullPath = $(this).val();
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var frase = fullPath.substring(startIndex);
                if (frase.indexOf('\\') === 0 || frase.indexOf('/') === 0) {
                    frase = frase.substring(1);
                }
                frase = "Selecionado: "+frase;
            }else{
                var frase = 'Selecionados: '+numFiles+' itens';
            }
            $(this).next().css('display', 'block').html(frase);
        }else{
            $(this).next().css('display', 'none');
        }
    });
    
    $('#form').submit(function(e){
        $('#desc').html($('#editor').find('.ql-editor').html());
    });
</script>
<script>
    function ativopromocao(){
        if($('#preco_promocao_ativo').val() == 1){
            if($('#desconto_ativo').val() == 1){
                $('#desconto_ativo').val(0).change();
            }
        }
    }
    
</script>
<script>
    function ativodesconto(){
        if($('#desconto_ativo').val() == 1){
            if($('#preco_promocao_ativo').val() == 1){
                $('#preco_promocao_ativo').val(0).change();
            }
        }
    }
</script>
<script>
    function fprincipal(){
        $('#opcionais').hide();
        $('#principal').show();
        $('#li_opcionais').removeClass("active-tab2");
        $('#li_principal').addClass("active-tab2");
    }
</script>
<script>
    function fopcionais(){
        $('#opcionais').show();
        $('#principal').hide();
        $('#li_principal').removeClass("active-tab2");
        $('#li_opcionais').addClass("active-tab2");
    }
</script>
<script>
    function adicionarMarca(){
        dados = new FormData();
        dados.append('nome', $('#nomeMarca').val());
        $.ajax({
            url: '<?php echo base_url('admin/adminmarcas/dinamicoAdicionarMarca'); ?>',
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
                var option = "<option value='"+data.id+"'>" + data.nome + "</option>";
                $('#marca').append(option);
                $('#addMarca').modal('hide');
                $('#marca').focus();
            },
        }); 
    }
</script>
<script>
    function swalPronto(tipo, mensagem){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: tipo,
            title: mensagem,
        })
    }
</script>
<script>

    function addOpcao(){
        var categoria   = $('#opcao_categoria').val();
        var nome        = $('#opcao_nome').val();
        var estoque     = $('#opcao_estoque').val();
        
        if(categoria != "" && categoria != " " && categoria != null){
            if(nome != "" && nome != " " && nome != null){
                if(estoque = "" && estoque != " " && estoque != null){
                    if(verificarExistente(categoria, nome)){
                        var opcao = "<tr class='opcoes_"+categoria+"' id='op_"+nome+"'>"+
                            "<td>"+categoria+"</td>"+
                            "<td class='op_nome'>"+nome+"</td>"+
                            "<td>"+estoque+"</td>"+
                            "<td><i style='color: red; font-size: 25px; cursor: pointer;' onclick='removerOp(this)' class='fa fa-times' aria-hidden='true'></i></td>"+
                        "</tr>";
                    
                        $('#table_opcao').append(opcao);
                    }
                    
                    $('#addOpcao').modal('hide');
                    
                    montaArray();
                } else {
                    $('#opcao_estoque').focus();
                    swalPronto('error', 'Digite a quantidade em estoque!');
                }
            } else {
                $('#opcao_nome').focus();
                swalPronto('error', 'Selecione o nome!');
            }
        } else {
            $('#opcao_categoria').focus();
            swalPronto('error', 'Selecione uma categoria!');
        }
    }
    
    function verificarExistente(categoria, nome){
        var qtd = $('#opcao_estoque').val();
        var boolean = true;
        
        $('.op_nome').each(function(){
            if($(this).html() == nome){
                if($(this).parent().children().first().html() == categoria){
                    var estoque = $(this).next().html();

                    var calc = parseInt(estoque) + parseInt(qtd);
                    
                    $(this).next().html(calc);
                    
                    boolean = false;
                }
            } 
        });
        
        return boolean;
    }
</script>
<script>
    function removerOp(id){
        $(id).parent().parent().remove();
        
        montaArray();
    }
</script>
<script>
    function montaArray(){
        var tamanhos = "";
        
        $('.opcoes_Tamanho').each(function(){
            if(tamanhos == ""){
                tamanhos = $(this).children().next().html() + '&' + $(this).children().next().next().html();
            } else {
                tamanhos = tamanhos + '¬' + $(this).children().next().html() + '&' + $(this).children().next().next().html();
            }
        });
        
        var cores = "";
        
        $('.opcoes_Cor').each(function(){
            if(cores == ""){
                cores = $(this).children().next().html() + '&' + $(this).children().next().next().html();
            } else {
                cores = cores + '¬' + $(this).children().next().html() + '&' + $(this).children().next().next().html();
            }
        });
        
        $('#produto_tamanhos').val(tamanhos);
        
        $('#produto_cores').val(cores);
    }
</script>
<script>
    function addSelected(){
        dados = new FormData();
        dados.append('categoria', $('#opcao_categoria').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminopcoes/dinamicoAdicionarSelected'); ?>',
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
                $('#opcao_nome').empty();
                
                var option = "<option value='' disabledselected> Selecione </option>";
                $('#opcao_nome').append(option);
                
                for(var i = 0; i < data.length;i++){
                    var option = "<option value='"+data[i].opcao_nome+"'>" + data[i].opcao_nome + "</option>";
                    $('#opcao_nome').append(option);
                }
            },
        }); 
    }
</script>
<script>
    function dinamicoNova(){
        $('#addNova').modal('show');
        $('#addOpcao').modal('hide');
    }

    function addNova(){
        if($('#nova_categoria').val() != "" && $('#nova_categoria').val() != " " && $('#nova_categoria').val() != null){
            if($('#nova_nome').val() != "" && $('#nova_nome').val() != " " && $('#nova_nome').val() != null){
                dados = new FormData();
                dados.append('nome', $('#nova_nome').val());
                dados.append('categoria', $('#nova_categoria').val());
                
                $.ajax({
                    url: '<?php echo base_url('admin/adminopcoes/dinamicoAdicionarOpcao'); ?>',
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
                        if(data.categoria == $('#opcao_categoria').val()){
                            var option = "<option value='"+data.nome+"'>" + data.nome + "</option>";
                            $('#opcao_nome').append(option);
                        }
                        
                        $('#addNova').modal('hide');
                        $('#addOpcao').modal('show');
                        
                        swalPronto('success', 'Opção criada com sucesso!');
                    },
                });
            } else {
                $('#nova_nome').focus();
                swalPronto('error', 'Digite o nome!');
            }
        } else {
            $('#nova_categoria').focus();
            swalPronto('error', 'Selecione a categoria!');
        }
    }
</script>
<script>
    function estoque(id){
        var dados = new FormData();
        dados.append('estoque', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/getestoqueid'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#tipo_estoque_ver').val(data.estoque_tipo);
                $('#loja_estoque_ver').val(data.estoque_loja);
                $('#quantidade_estoque_ver').val(data.estoque_quantidade);
                $('#valor_estoque_ver').val(data.estoque_valor);
                $('#detalhe-ver').val(data.estoque_desc);
                
                $('#id_estoque').val(data.estoque_id);
                $('#tipo_estoque_edit').val(data.estoque_tipo);
                $('#loja_estoque_edit').val(data.estoque_loja);
                $('#qtd_estoque_edit').val(data.estoque_quantidade);
                $('#valoratual_estoque_edit').val(data.estoque_valor);
                $('#detalhe-edit').val(data.estoque_desc);
                
                $('#estoque-excluir').val(data.estoque_id);
                
                if(data.estoque_tipo == "Ajuste estoque"){ 
                    $('#detalhe-div-cad').css("display", "block");
                    $('#detalhe-div-ver').css("display", "block");
                    $('#detalhe-div-edit').css("display", "block");
                }else{
                    $('#detalhe-div-cad').css("display", "none");
                    $('#detalhe-div-ver').css("display", "none");
                    $('#detalhe-div-edit').css("display", "none");
                }
            },
        });
    }
</script>
<script>
    function ajuste(){
        var aux = document.getElementById('tipo_estoque_cad').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-cad').css("display", "block");
        }else{
            $('#detalhe-div-cad').css("display", "none");
        }
    }
    
    function ajuste2(){
        var aux = document.getElementById('tipo_estoque_edit').value;
        if(aux == "Ajuste estoque"){ 
            $('#detalhe-div-edit').css("display", "block");
        }else{
            $('#detalhe-div-edit').css("display", "none");
        }
    }
</script>
<script>
    function adicionarEstoque(){
        dados = new FormData();
        dados.append('produto', $('#nome').val());
        dados.append('data', $('#data1').val());
        dados.append('tipo', $('#tipo_estoque_cad').val());
        dados.append('loja', $('#loja_estoque_cad').val());
        dados.append('quantidade', $('#quantidade_estoque_cad').val());
        dados.append('valor', $('#valor_estoque_cad').val());
        dados.append('desc', $('#detalhe-cad').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodaddestoque'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var lista ="<tr id='list"+data.estoque_id+"'>"+
                            "<td>"+data.estoque_data+"</td>"+
                            "<td>"+data.estoque_id+"</td>"+
                            "<td>"+data.estoque_loja+"</td>"+
                            "<td>"+data.estoque_quantidade+"</td>"+
                            "<td>"+new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(data.estoque_valor)+"</td>"+
                            "<td>"+data.estoque_tipo+"</td>"+
                            "<td style='font-size: 22px!important'>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-read-modal' onclick='estoque("+data.estoque_id+")'><i class='fa fa-eye' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-edit-modal' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px;' class='fa fa-pencil' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#excluir-estoque' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px; color: #1b9045;' class='fa fa-times' aria-hidden='true'></i></a>"+
                            "</td>" +
                            "<tr>";
                $('#estoqueList').append(lista);
                $('#estoque-modal').modal('hide');
                
            },
        }); 
    }
</script>
<script>
    function editestoque(){
        dados = new FormData();
        dados.append('id', $('#id_estoque').val());
        dados.append('data', $('#data2').val());
        dados.append('tipo', $('#tipo_estoque_edit').val());
        dados.append('loja', $('#loja_estoque_edit').val());
        dados.append('quantidade', $('#qtd_estoque_edit').val());
        dados.append('addqtd', $('#add_estoque_edit').val());
        dados.append('valor', $('#valoratual_estoque_edit').val());
        dados.append('novovalor', $('#novovalor_estoque_edit').val());
        dados.append('desc', $('#detalhe-edit').val());
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodeditaestoque'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var listatroca = document.getElementById('list'+data.estoque_id);
                listatroca.remove();
                
                var lista = "<tr id='list"+data.estoque_id+"'>"+
                            "<td>"+data.estoque_data+"</td>"+
                            "<td>"+data.estoque_id+"</td>"+
                            "<td>"+data.estoque_loja+"</td>"+
                            "<td>"+data.estoque_quantidade+"</td>"+
                            "<td>"+new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(data.estoque_valor)+"</td>"+
                            "<td>"+data.estoque_tipo+"</td>"+
                            "<td style='font-size: 22px!important'>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-read-modal' onclick='estoque("+data.estoque_id+")'><i class='fa fa-eye' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#estoque-edit-modal' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px;' class='fa fa-pencil' aria-hidden='true'></i></a>"+
                            "<a style='color: #1b9045;' data-toggle='modal' data-target='#excluir-estoque' onclick='estoque("+data.estoque_id+")'><i style='padding-left: 12px; color: #1b9045;' class='fa fa-times' aria-hidden='true'></i></a>"+
                            "</td>" +
                            "<tr>";
                
                $('#estoqueList').append(lista);
                $('#estoque-edit-modal').modal('hide');
            }
        });
    }
</script>
<script>
    function excluirestoque(){
        dados = new FormData();
        dados.append('id', $('#estoque-excluir').val());
        var aux = $('#estoque-excluir').val();
        
        $.ajax({
            url: '<?php echo base_url('admin/adminestoque/Prodexcestoqueadd'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            success: function(data) {
                var excluido = document.getElementById('list'+aux);
                excluido.remove();
                
                $('#excluir-estoque').modal('hide');
            }
        });
    }
</script>
<script>
    function validainput(){
        
        var value1 = $('#valor_estoque_cad').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valor_estoque_cad').value = clean1;
        
        adicionarEstoque();
        
    }
    
    function validainput2(){
        
        var value1 = $('#valoratual_estoque_edit').val();
        var value2 = $('#novovalor_estoque_edit').val();
        
        var clean1 = parseFloat(value1.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        var clean2 = parseFloat(value2.replace(/[^0-9,]*/g, '').replace(',', '.')).toFixed(2);
        
        document.getElementById('valoratual_estoque_edit').value = clean1;
        document.getElementById('novovalor_estoque_edit').value = clean2;
        
        editestoque();
        
    }
</script>



<script>
    function AddProduto(){
        var loja =  document.getElementById('lojaSel').value;
        var tipo = document.getElementById('tipo_estoque_cadSel').value;
        
        if(loja == "-1"){
            Swal.fire("Selecione uma loja");
        }else if(tipo == "-1"){
            Swal.fire("Selecione uma tipo de movimento");
        }else{
            var dados = new FormData();
            dados.append('loja', loja);
            dados.append('tipo', tipo);
            $.ajax({
                url: '<?php echo base_url('moveEstoque'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    $('#estoqueUpdt').val(tipo);
                    $('#lojaUpdt').val(loja);
                    

                    $('#lojaInp').val($("#lojaSel option:selected").text());
                    $('#tipo_estoque_cadInp').val($("#tipo_estoque_cadSel option:selected").text());
                    $('#lojaInp').css('display','block');
                    $('#tipo_estoque_cadInp').css('display','block');
                    
                    $('#lojaSel').css('display','none');
                    $('#tipo_estoque_cadSel').css('display','none');
                    
                    var load = "<tr><td></td><td></td><td></td><td><img style='width:auto;' src='https://www.dcam.ufscar.br/quem-somos/carregando/image'/></td><td></td><td></td><td></td></tr>";
                    $("#produtoList").empty();
                    $("#produtoList").append(load);
                },
                error: function(xhr, status, error) {
                  console.log(error);
                },
                success: function(data) {
                    $("#AddProdutoDiv").empty();
                    $("#AddProdutoDiv").append("<button onclick='document.location.reload(true)' type='button' class='btn btn-danger' style='margin-right:37%; position:relative;' title='Nova Busca'><em class='fa fa-eye'></em></button>");
                    $("#produtoList").empty();
                    $("#produtoList").append(data);
                    table = $('#tabela2').DataTable( {
                        paging: false
                    });
                    table.destroy();
                    $('#tabela2').DataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": true,
                        "bAutoWidth": false,
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json'
                        }
                    });
                },
            });
        }
    }
    
    function GravaEstoque(id){
        var newVal = document.getElementById('newVal'+id).value;
        var newQtd = document.getElementById('newQtd'+id).value;
        var produto = document.getElementById('item'+id).value;
        var tipos = document.getElementById('estoqueUpdt').value;
        var loja =  document.getElementById('lojaUpdt').value;
        var dados = new FormData();
            dados.append('newVal', newVal);
            dados.append('newQtd', newQtd);
            dados.append('produto', produto);
            dados.append('movimento', tipos);
            dados.append('loja', loja);
            $.ajax({
                url: '<?php echo base_url('updEstoque'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                dataType: 'json',
                error: function(xhr, status, error) {
                  console.log(error);
                },
                success: function(data) {
                    $('#line'+id).empty();
                    $('#line'+id).append(data);
                },
            });
    }
</script>