    <style>
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #4ECDC4;
            border-color: #4ECDC4;
        }
        
        .modal-dialog-cad{
            width: 60%;
            max-width: 60%;
            margin-left: 20%;
            margin-right: 20%;
        }
        
        #myTable_wrapper .row{
            margin: 0;
        }
        
        .c-20{
            width: 20%;
            flex: 0 0 20%;
            max-width: 20%;
            padding: 0 15px;
            float: left;
        }
        .c-check{
            display: inline;
            margin-right: 10px;
        }
        .c-title{
            font-weight: bold;
            font-size: 15px;
        }
        .c-sub{
            font-weight: bold;
            font-size: 13px;
        }
        .c-div-sub{
            margin-top: 5px;
            padding-left: 15px;
            width: 100%;
        }
        .check-all{
            text-decoration: underline;
            color: #797979;
            display: inline;
            font-size: 13px;
            cursor: pointer;
        }
        .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
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
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
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
    
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    
    .button-area{
        margin-top: 20px;
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
    
    .mr-15{
        margin-right: 15px;
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
        
    .see-pass{
        width: 10%;
        margin-left: -4px;
        margin-top: -2px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .passwd{
        width: 50%;
        display: inline;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
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
    </style>
    
    <section id="main-content">
        <section class="wrapper">
            <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
                <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>">Clientes</a></li>
                </ol>
            </nav>
      
            <div class="c-card">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Listagem de Clientes</b></h2>
                        </div>
                        <form action="<?php echo base_url('d2fb359e7478da4e7ec01ef527bdeb53') ?>" method="post">
                            <div class="col-md-6">
                                <div class="button-area">
                                    <a href="<?php echo base_url('admin/adminclientes/cadastroCliente') ?>"><button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item"><em class="fa fa-plus"></em></button></a>
                                    <div class="search-field">
                                        <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                        <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                    <div class="col-md-12">
                        <div class="c-card-body">
                            <div class="table-responsive" style="width: 100%">
                                <table class="table c-table" id="tabela">
        				        <thead>
        				            <tr>
        				                <th>Nome</th>
        				                <th>CPF</th>
        				                <th>Cidade</th>
        				                <th>E-mail</th>
        				                <th>Telefone</th>
        				                <th>Status</th>
        				                <th>Loja</th>
        				                <th class="text-center" style="width:10%">Ações</th>
        				            </tr>
        				        </thead>
        				        <tbody>
        				            <?php foreach($clientes as $c){ ?>
            				            <tr class="tr-check">
            				                <td><?php echo ucwords(mb_strtolower($c['cliente_nome'])) ?></td>
            				                <td class="cpf"><?php echo $c['cliente_cpf'] ?></td>
            				                <td>
            				                    <?php if($c['cliente_cidade'] != null){ ?>
            				                        <?php echo ucwords(mb_strtolower($c['cliente_cidade'])) ?>    
            				                    <?php } else { ?>
            				                        Não Cadastrado
            				                    <?php } ?>
            				                </td>
            				                <td>
            				                    <?php if($c['cliente_email'] != null){ ?>
            				                        <?php echo mb_strtolower($c['cliente_email']) ?>
            				                    <?php } else { ?>
            				                        Não Cadastrado
            				                    <?php } ?>
            				                </td>
            				                <td>
            				                    <?php if($c['cliente_telefone'] != null){ ?>
            				                        <span class="telefone"><?php echo $c['cliente_telefone'] ?></span>
            				                    <?php } else { ?>
            				                        Não Cadastrado
            				                    <?php } ?>
            				                </td>
            				                <td>
            				                    <?php if($c['cliente_ativo'] == 1) { ?>
            				                        Ativo
            				                    <?php } else { ?>
            				                        Bloqueado
            				                    <?php } ?>
            				                </td>
            				                <td>
            				                    <?php if(isset($c['cliente_loja'])){ ?>
            				                        <?php echo mb_strtolower($c['cliente_loja']) ?>
            				                    <?php } else { ?>
            				                        Não Cadastrado
            				                    <?php } ?>
            				                </td>
            				                <td style="color: #1b9045; font-size: 22px!important" class="text-center">
            				                    <a style="color: #1b9045;" href="<?php echo base_url('50d849c4ab008a40ab39cdaf352f35f5/' . $c['cliente_id']) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
            				                    <a style="color: #1b9045;" href="<?php echo base_url('admin/adminclientes/editarcliente/' . $c['cliente_id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            				                    <?php if($c['cliente_ativo'] == 1) { ?>
            				                        <i onclick="bloquear(<?php echo $c['cliente_id'] ?>)" data-toggle="modal" data-target="#bloquearModal" class="fa fa-ban" aria-hidden="true"></i>
            				                    <?php } else { ?>
            				                        <i onclick="desbloquear(<?php echo $c['cliente_id'] ?>)" data-toggle="modal" data-target="#desbloquearModal" class="fa fa-check-circle-o" aria-hidden="true"></i>
            				                    <?php } ?>
            				                    <a style="color: #1b9045;" href="<?php echo base_url('admin/adminclientes/excluircliente/' . $c['cliente_id']) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
            				                </td>
            				            </tr>
        				            <?php } ?>
        				        </tbody>
        				    </table>
        				    </div>
        			    </div>
        			    <?php if($clientes == null) { ?>
        			        <div class="col-md-12 text-center">
        			            <p>Nenhum cliente encontrado!</p>
        			        </div>
        			    <?php } ?>
        			    <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="pagination-links"><?php echo $links; ?></p>
                            </div>
                        </div>
    			    </div>
                </div>
            </div>
        </section>
    </section>
    
    
    
<div class="modal" tabindex="-1" role="dialog" id="bloquearModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">Aviso</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;">Deseja bloquear o cliente?<p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha()">Bloquear</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('0f4b06e032b8ccfed4a548b426e71aaf') ?>" method="post">
                    
                    <input type="hidden" name="id" id="id">
                    
                    <label style="font-size: 16px">Confirme a senha</label><br>
                    <input class="form-control passwd" type="password" name="senha" id="senha" placeholder="Digite a Senha" required>
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



<div class="modal" tabindex="-1" role="dialog" id="desbloquearModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">Aviso</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b>Deseja bloquear o cliente?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha2()">Desbloquear</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha2" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('4318d7cd597c024f9c4cf0fa90add474') ?>" method="post">
                    
                    <input type="hidden" name="id2" id="id2">
                    
                    <label style="font-size: 16px">Confirme a senha</label><br>
                    <input class="form-control passwd" type="password" name="senha2" id="senha2" placeholder="Digite a Senha" required>
                    <button type="button" class="btn btn-primary see-pass" id="senha_btn2"><em class="fa fa-eye"></em></button>
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
    function bloquear(id){
        $('#id').val(id);
    }
    function desbloquear(id){
        $('#id2').val(id);
    }
</script>
    
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
        
        $('.telefone').mask(SPMaskBehavior, spOptions);
        $('.cpf').mask('000.000.000-00', {reverse: true});
        
        
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
                    icon: 'success',
                    title: 'Cliente bloqueado com sucesso!'
                })
            <?php } else if($alert == 2) { ?>
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
                    title: 'Não foi possível bloquear o cliente, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php } else if($alert == 3) { ?>
                const Toast3 = Swal.mixin({
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
                
                Toast3.fire({
                    icon: 'success',
                    title: 'Cliente desbloqueado com sucesso!'
                })
            <?php } else if($alert == 4) { ?>
                const Toast4 = Swal.mixin({
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
                
                Toast4.fire({
                    icon: 'error',
                    title: 'Não foi possível desbloquear o cliente, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php }  ?>
        <?php } ?>
    });
</script>

<script>
    function senha2(){
        $('#formsenha2').show();
    }
</script>

<script>
    $('#senha_btn2').on('click', function(){
        const type = $('#senha2').prop('type') === 'password' ? 'text' : 'password';
        $('#senha2').prop('type', type);
        if(type == "text"){
            $('#senha_btn2').children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $('#senha_btn2').children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
</script>

<script>
        function senha(){
            $('#formsenha').show();
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

