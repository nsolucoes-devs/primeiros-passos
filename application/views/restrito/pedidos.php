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
    path[fill='#123456']{display:none !important;}
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
    .c-aprovados{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(76 175 80 / 40%);
        background: linear-gradient(60deg, #66bb6a, #43a047);
    }
    .c-negadas{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(244 67 54 / 40%);
        background: linear-gradient(60deg, #ef5350, #e53935);
    }
    .c-titulos{
        box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 188 212 / 40%);
            background: linear-gradient(60deg, #26c6da, #00acc1);
    }
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
    }
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
    }
    .c-card-category{
        color: black;
        font-size: 14px;
        margin: 0;
        padding-top: 10px;
        font-weight: bold;
    }
    .c-card-title{
        margin: 0;
        color: #3C4858;
        font-size: 1.5625rem;
        line-height: 1.4em;
    }
    .c-card-title small{
        font-size: 80%;
        font-weight: 400;
    }
    .c-card-footer{
        border-top: 1px solid #d6d5d5;
        margin-top: 20px;
        padding: 0;
        padding-top: 10px;
        margin: 0 15px 10px;
        border-radius: 0;
        justify-content: flex-end;
        align-items: center;
        display: flex;
        background-color: transparent;
    }
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    .c-stats{
        color: #999999;
        font-size: 12px;
        line-height: 22px;
        display: inline-flex;
    }
    .c-stats-icon{
        position: relative;
        top: 4px;
        font-size: 16px;
        margin-right: 3px;
        margin-left: 3px;
        color: grey;
    }
    .c-stats-text{
        color: grey;
    }
    .c-table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    .c-table thead{
        color:  #1b9045!important;
    }
    .c-table thead tr th{
        padding: 8px;
        vertical-align: middle;
    }
    .c-table tbody tr td {
        padding: 8px;
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }
    .c-table tbody tr:hover{
        cursor: pointer;
        background-color: #eee!important;
    }
    .check-all{
        width: 32px;
        font-size: 12px;
        color: white;
        background-color: #1b9045;
        border: 0;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    .button-area{
        margin-top: 20px;
    }
    .button-custom{
        color: white;
        background-color: #9c27b0;
        border: 0;
        font-size: 14px;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    .search{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-control-custom{
        border-radius: 5px;
        border: 1px solid #80808061;
        padding: 5px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        margin-right: -4px;
        height: 32px;
        width: 165px;
        color: black;
    }
    .form-control-custom:focus {
        outline: unset;
        border: 2px solid #43006d;
        color: #43006d;
    }
    .search-field{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
        border-radius: 5px;
    }
    .def-item{
        display: block;
        padding: 7px 10px;
        color: black;
        font-size: 14px;
    }
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
    }
    
    .select2{
        width: 100%!important;
    }
    
    .pagination-links a{
        color: #1b9045;
        text-decoration: none;
        padding: 5px;
        font-size: 20px;
        margin: 2px;
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 2px solid #1b9045;
    } 
    .check{
        min-width: 20px;
        min-height: 20px;
    }
    
    .swal2-container.swal2-top.swal2-backdrop-show{
        opacity: 0.6;
        overflow-y: auto;
        margin-top: 112px;
        width: 380px;
        height: 100px;
    }
    
    .swal2-popup.swal2-toast.swal2-icon-success.swal2-show{
        width: 100%;
        height: 100%;
        display: flex;
        background-color: lightgrey;
    }
    
    .swal2-success-circular-line-left, .swal2-success-fix, .swal2-success-circular-line-right{
        display: none;
    }
    
    span.swal2-success-line-tip, span.swal2-success-line-long{
        z-index: 3!important;
    }
    
    .swal2-success-ring{
        background-color: #507525;
        z-index: 2;
    }
    h2#swal2-title{
        display: flex;
        color: black;
        font-size: 18px;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
                <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                    <li class="breadcrumb-item active" aria-current="page">Financeiro</li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>">Pedidos</a></li>
                </ol>
            </nav>
            <div class="c-card">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Listagem de Pedidos</b></h2>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-6 row">
                            <form action="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>" method="post">
                                <div class="d-flex" style="display: flex">
                                    <div class="form-group" style="width: 65%">
                                        <select class="form-control" name="loja_id">
                                            <?php
                                               foreach($lojas as $loja){ ?>
                                                  <option value="<?php echo $loja['id'] ?>" <?php if($loja_id == $loja['id']){echo 'selected'; } ?>><?php echo $loja['nome'] ?></option>
                                                <?php }
                                            ?>
                                            <option value="all" <?php if($loja_id == "all"){echo 'selected'; } ?>>Todas</option>
                                        </select>
                                      </div>
                                    <div class="form-group">
                                        <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                                    </div> 
                                </div> 
                            </form>
                        </div>
                            
                        <div class="col-md-6">
                            <div class="button-area">
                                <a href="<?php echo base_url('admin/adminpedidos/cadastroPedido') ?>"><button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item"><em class="fa fa-plus"></em></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-card-body" style="display: block">
                    <div class="table-responsive" style="width: 100%">
                        <table class="table c-table" id="tabela">
                            <thead>
                                <tr>
                                    <th class="text-center" style='width: 10%'>Nº Pedido</th>
                                    <th style='width: 25%'>Nome</th>
                                    <th class="text-center" style='width: 10%'>Total</th>
                                    <th class="text-center" style='width: 10%'>Cadastro</th>
                                    <th class="text-center" style='width: 20%'>Status</th>
                                    <th class="text-center" style='width: 5%'>PDV</th>
                                    <th class="text-center" style='width: 10%'>Loja</th>
                                    <th class="text-center" style='width: 10%'>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($vendas)) { ?>
                                <?php foreach($vendas as $vds){ ;?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $vds['idpedido']?></td>
                                    <td><?php echo ucwords(mb_strtolower($vds['cliente']))?></td>
                                    <td style="text-align:center;">R$ <?php echo number_format($vds['total'], 2, ',','.')?></td>
                                    <td style="text-align:center;"><?php echo date('d/m/Y H:i', strtotime($vds['cadastro']))?></td>
                                    <td style="text-align:center;"><?php echo ucwords(mb_strtolower($vds['status']))?></td>
                                    <td style="text-align:center;"><?php echo $vds['pdv'] ?></td>
                                    <td style="text-align:center;"><?php echo $vds['loja'] ?></td>
                                    
                                    <td style="color: #1b9045; font-size: 22px!important" class="text-center">
    				                    <a style="color: #1b9045;" href="<?php echo base_url('aeb6ca97f00431672db51d34b87c4a50/' . $vds['idpedido'] ) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
    				                    <a style="color: #1b9045;" href="<?php echo base_url('4daaa9654962f18e7c9df5cb1b2ecdee/'. $vds['idpedido']) ?>"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
    				                    <i onclick="excluirpedido('<?php echo $vds['pdv']."', ".$vds['idpedido']?>)" style="padding-left: 12px;" class="fa fa-trash" aria-hidden="true"></i>
    				                </td>
                                </tr>
                                <?php } } ?>
                            </tbody>  
                        </table>
                    </div>
                </div>
                <?php if($vendas == null) { ?>
			        <div class="col-md-12 text-center">
			            <p>Nenhum pedido encontrado!</p>
			        </div>
			    <?php } ?>
			    <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="pagination-links"><?php echo $links; ?></p>
                    </div>
                </div>
            </div>
    </section>
</section>

<div class="modal" tabindex="-1" role="dialog" id="modalExcluir">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h5 class="modal-title" style="color: white; display: inline;">Excluir pedido</h5>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 16px;"><b>Deseja excluir o pedido?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha()">Sim</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('admin/Adminpedidos/excluirpedido') ?>" method="post">
                    <input type="text" id="id_excluir" name="id_excluir">
                    <label style="font-size: 16px">Confirme a senha</label><br>
                    <input class="form-control passwd" type="password" name="senha" id="senha" placeholder="Digite a Senha" required>
                    <input type="hidden" id="idVenda" name="idVenda">
                    <button type="button" class="btn btn-primary see-pass" id="senha_btn"><em class="fa fa-eye"></em></button>
                    <br><br>
                    <button type="submit" class="btn btn-primary" style="color: white">&nbsp&nbspConfirmar&nbsp&nbsp</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        
        $('.tel').mask(SPMaskBehavior, spOptions);
        
        
        <?php if(isset($alert)){ ?>
            <?php if($alert == 1) { ?>
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
                    icon: 'sucess',
                    title: 'Pedido excluido com sucesso!'
                })
            <?php } else if($alert == 4) { ?>
                const Toast2 = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast2.fire({
                    icon: 'error',
                    title: 'Não foi possível excluir o pedido, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php } ?>
        <?php } ?>
        
        
    });
</script>

<script>
    function excluir(id){
        $('#id_excluir').val(id);
    }
    
</script>

<script>
        function showForm(){
            document.getElementById('btnconfirmacao').style.display = "none";
            document.getElementById('formsenha').style.display = "block";
            document.getElementById('footermodal').style.display = "block";
        }
</script>

<script>
    $(document).ready(function(){
        <?php if(isset($alert)){ ?>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            
            Toast.fire({
                icon: 'success',
                title: 'Pedido #<?php echo $alert ?> Criado com sucesso!'
            })
        <?php } ?>
    });
</script>
    
<script>
        function senha(){
            $('#formsenha').show();
            
            $('#status_enviar').val($('#status_modal').val());
        }
</script>

<script>
    $('#senha_btn').on('click', function(){
        const type = $('#senha').prop('type') === 'password' ? 'text' : 'password';
        $('#senha').prop('type', type);
        if(type == "text"){
            $('#senha_btn').children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $('#senha_btn').children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
</script>

<script>
        function showForm(){
            document.getElementById('btnconfirmacao').style.display = "none";
            document.getElementById('formsenha').style.display = "block";
            document.getElementById('footermodal').style.display = "block";
        }
</script>

<script>
    function excluirpedido(pdv, id){
        if(pdv == "Não"){
            Swal.fire('Venda não realizada em loja, não pode ser excluída!')
        }else{
            document.getElementById("idVenda").value = id;
            $('#modalExcluir').modal('show');
        }
    }
</script>
