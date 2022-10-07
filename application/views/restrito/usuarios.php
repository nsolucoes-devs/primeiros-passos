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
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
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
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('0d658457c62859e2c93026f9f70ce219') ?>">Usuários</a></li>
                </ol>
            </nav>
      
            <div class="c-card">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Listagem De Usuários Administradores</b></h2>
                        </div>
                        <form action="<?php echo base_url('0d658457c62859e2c93026f9f70ce219') ?>" method="post">
                            <div class="col-md-6">
                                <div class="button-area">
                                    <a onclick="addModal()" data-toggle="modal" data-target="#novoAdmin" class="btn btn-primary mr-15" title="Adicionar Usuário"><em class="fa fa-plus"></em></a>  
                                <div class="search-field">
                                    <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                    <button type="submit" style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
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
            				                <th>Login</th>
            				                <th>E-mail</th>
            				                <th>Telefone</th>
            				                <th>Status</th>
            				                <th class="text-center">Ações</th>
            				            </tr>
            				        </thead>
            				        <tbody>
            				            <?php foreach($usuarios as $row){ ?>
            				            <tr>
            				                <td><?php echo ucwords(strtoupper($row['nome_usuario'])); ?></td>
            				                <td><?php echo $row['login_usuario']; ?></td>
            				                <td><?php echo mb_strtolower($row['email']) ?></td>
            				                <td class="tel"><?php echo $row['telefone'] ?></td>
            				                <td>
            				                    <?php if($row['ativo'] == 1) { ?>
            				                        ATIVO
            				                    <?php } else { ?>
            				                        BLOQUEADO
            				                    <?php } ?>
            				                </td>
            				                <td style="color: #1b9045; font-size: 22px!important;" class="text-center">
            				                    <i onclick="setaDadosModal3(<?php echo $row['id_usuario'] ?>)" class="fa fa-eye" aria-hidden="true"></i>
            				                    <i onclick="setaDadosModal(<?php echo $row['id_usuario'] ?>)"   style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i>
            				                    <?php if($row['ativo'] == 1){ ?>
            				                        <i onclick="excluirusuario(<?php echo $row['id_usuario'] ?>)" data-toggle="modal" data-target="#modalExcluir"  style="padding-left: 12px;" class="fa fa-ban" aria-hidden="true"></i>
            				                    <?php } else { ?>
            				                        <i onclick="desbloquearusuario(<?php echo $row['id_usuario'] ?>)" data-toggle="modal" data-target="#modalDesbloquear"  style="padding-left: 12px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
            				                    <?php } ?>
            				                    <a style="color: #1b9045;" onclick="removeUser('<?php echo $row['id_usuario'];?>')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            				                </td>
            				            </tr>
            				            <?php } ?>
            				        </tbody>
            				    </table>
        				    </div>
        			    </div>
        			    <?php if($usuarios == null) { ?>
        			        <div class="col-md-12 text-center">
        			            <p>Nenhum usuário encontrado!</p>
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
    
    <!-- Modal -->
    <div id="novoAdmin" class="modal">
        <div class="modal-dialog modal-dialog-cad">
    
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="titulo-modal">Novo Usuário</h4>
                </div>
                <form method="post" id="form_insert">
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Nome:</b></label>
                                <input type="text" class="form-control" placeholder='Nome...' name="nome" id="nome" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Funcionário:</b></label>
                                <select class="form-control" id="funcionario" name="funcionario">
                                    <option value="0" selected> -- Selecione --</option>
                                    <?php foreach($funcionarios as $f){ ?>
                                        <option value="<?php echo $f['id_funcionario'] ?>"><?php echo $f['nome_funcionario'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label style="color: black;"><b>E-mail:</b></label>
                                <input type="email" class="form-control" placeholder="usuario@email.com" name="email" id="email" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b>Telefone:</b></label>
                                <input type="text" class="form-control tel" placeholder="(12) 99115-3365" name="tel" id="tel" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Login:</b></label>
                                <input type="text" style="display: none" placeholder='Login...' name="username" id="username">
                                <input type="text" class="form-control" placeholder='Login...' name="login" id="login" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Senha:</b></label>
                                <input type="password" style="display: none" placeholder='Senha' name="password" id="password">
                                <input type="password" class="form-control" placeholder='Senha' name="senha" id="senha" required>
                            </div>
                            <input type="hidden" name="permissao" id="permissao" value="3">
                            <!--<div class="col-md-4 form-group">-->
                            <!--    <label style="color: black;"><b>Permissão:</b></label>-->
                            <!--    <select style="width: 100%" class="js-example-basic-multiple" name="permissao" id="permissao" required>-->
                            <!--        <option value="" selected disabled>-- Selecione --</option>-->
                            <!--        <?php foreach($tipos as $tp){
                                        echo "<option value='".$tp['perfilusuario_id']."'>".$tp['perfilusuario_nome']."</option>";
                                    } ?>-->
                            <!--    </select>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add_insert" class="btn btn-primary">Adicionar</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
    
        </div>
    </div>
    
    <!-- Visualizar Modal -->
    <div id="verAdmin" class="modal">
        <div class="modal-dialog modal-dialog-cad">
    
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Visualizar usuário</h4>
                </div>
                <form method="post" id="form_insert">
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Nome:</b></label>
                                <input type="text" class="form-control" placeholder='Nome...' name="nome_ver" id="nome_ver" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="color: black;"><b>Funcionário:</b></label>
                                <input class="form-control" id="funcionario-ver" name="funcionario-ver" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label style="color: black;"><b>E-mail:</b></label>
                                <input type="email" class="form-control" placeholder="usuario@email.com" name="email_ver" id="email_ver" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b>Telefone:</b></label>
                                <input type="text" class="tel form-control" placeholder="(12) 99115-3365" name="tel_ver" id="tel_ver" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label style="color: black;"><b>Login:</b></label>
                                <input type="text" style="display: none" placeholder='Login...' name="username_ver" id="username_ver">
                                <input type="text" class="form-control" placeholder='Login...' name="login_ver" id="login_ver" readonly>
                            </div>
                            <!--<div class="col-md-4 form-group">-->
                            <!--    <label style="color: black;"><b>Permissão:</b></label>-->
                            <!--    <input class="form-control" name="permissao_ver" id="permissao_ver" readonly>-->
                            <!--    <select style="width: 100%" class="js-example-basic-multiple" name="permissao_ver" id="permissao_ver" disabled>-->
                            <!--        <?php foreach($tipos as $tp){
                                        echo "<option value='".$tp['perfilusuario_id']."'>".$tp['perfilusuario_nome']."</option>";
                                    } ?>-->
                            <!--    </select>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar</button>
                    </div>
                </form>
            </div>
    
        </div>
    </div>
    
        
<div class="modal" tabindex="-1" role="dialog" id="modalExcluir">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h5 class="modal-title" style="color: white; display: inline;">Bloqueio de usuário</h5>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 16px;"><b>Deseja bloquear o usuário?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha()">Sim</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('9feade5f45917720705df9de942cd1b6') ?>" method="post">
                    
                    <input type="hidden" id="id_excluir" name="id_excluir">
                    
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



<div class="modal" tabindex="-1" role="dialog" id="modalDesbloquear">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">Aviso</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b>Deseja desbloquear o usuário?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha2()">Sim</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha2" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('f83c23c38cfd9fc25218e3d2195bbd0e') ?>" method="post">
                    
                    <input type="hidden" id="id_excluir2" name="id_excluir2">
                    
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
                    icon: 'success',
                    title: 'Usuário criado com sucesso!'
                })
            <?php } else if($alert == 2) { ?>
                const Toast2 = Swal.mixin({
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
                
                Toast2.fire({
                    icon: 'success',
                    title: 'Usuário editado com sucesso!'
                })
            <?php } else if($alert == 3) { ?>
                const Toast2 = Swal.mixin({
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
                
                Toast2.fire({
                    icon: 'success',
                    title: 'Usuário bloqueado com sucesso!'
                })
            <?php } else if($alert == 5) { ?>
                const Toast2 = Swal.mixin({
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
                
                Toast2.fire({
                    icon: 'success',
                    title: 'Usuário desbloqueado com sucesso!'
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
                    title: 'Não foi possível excluir o usuário, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php } ?>
        <?php } ?>
        
        
    });
    
    function addModal(){
        $('#form_insert').attr('action', '<?php echo base_url('150b6112888b83d7a9302cf9acb20acc')?>');
        
        $('#titulo-modal').html('Adicionar Usuário');
        $('#user_id').val('');
        $('#nome').val('');
        $('#email').val('');
        $('#tel').val('');
        $('#login').val('');
        $('#senha').prop('required', true);
        $('#senha').prop('disabled', false);
        $('#permissao').val('').change();
        $('#add_insert').html('Adicionar');
    }
    
    //Seta os campos do modal de editar de acordo com as informações do usuário
    function setaDadosModal(id){
        dados = new FormData();
        dados.append('id', id);
        $.ajax({
            url: '<?php echo base_url('aa02d8496732341ab22f2eb20ac3154a'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                if(data != "null" && data != "" && data != " " && data != null){
                    var SPMaskBehavior = function (val) {
                        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                    },
                    spOptions = {
                        onKeyPress: function(val, e, field, options) {
                            field.mask(SPMaskBehavior.apply({}, arguments), options);
                        }
                    };
                    
                    user = jQuery.parseJSON(data);
                    $('#titulo-modal').html('Edição usuário');
                    $('#user_id').val(user.id_usuario);
                    $('#nome').val(user.nome_usuario);
                    $('#email').val(user.email);
                    $('#tel').unmask().val(user.telefone).mask(SPMaskBehavior, spOptions);
                    $('#login').val(user.login_usuario);
                    $('#senha').prop('disabled', true);
                    $('#funcionario').val(user.usuario_funcionario);
                    $('#permissao').val(user.perfil).change();
                    $('#form_insert').attr('action', '<?php echo base_url('92743ff90fb535c63c3bb36ef5901695')?>');
                    $('#add_insert').html('Salvar');
                    $('#novoAdmin').modal('show');
                }
            },
        });
    }
    
    function setaDadosModal3(id){
        dados = new FormData();
        dados.append('id', id);
        $.ajax({
            url: '<?php echo base_url('aa02d8496732341ab22f2eb20ac3154a'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                if(data != "null" && data != "" && data != " " && data != null){
                    var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
                    
                    user = jQuery.parseJSON(data);
                    $('#user_id_ver').val(user.id_usuario);
                    $('#nome_ver').val(user.nome_usuario);
                    $('#email_ver').val(user.email);
                    $('#tel_ver').unmask().val(user.telefone).mask(SPMaskBehavior, spOptions);
                    $('#login_ver').val(user.login_usuario);
                    $('#senha_ver').prop('required', false);
                    $('#permissao_ver').val(user.perfil).change();
                    $('#form_insert_ver').attr('action', '<?php echo base_url('6c67633f36230057d8e689b1c828a7c0')?>');
                    $('#verAdmin').modal('show');
                    $('#funcionario-ver').val(user.usuario_funcionario);
                }
            },
        });
    }
    
    function setaDadosModal2(id){
        $('#id_excluir').val(id);
    }
</script>

<script>
    function excluirusuario(id){
        $('#id_excluir').val(id);
    }
    
</script>

<script>
    function desbloquearusuario(id){
        $('#id_excluir2').val(id);
    }
    
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
        function senha2(){
            $('#formsenha2').show();
        }
</script>

<script>
    $('#senha_btn2').on('click', function(){
        const type = $('#senha').prop('type') === 'password' ? 'text' : 'password';
        $('#senha2').prop('type', type);
        if(type == "text"){
            $('#senha_btn2').children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $('#senha_btn2').children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
</script>

<script>
    function removeUser(id){
        Swal.fire({
            title: 'Realmente deseja excluir este usuário?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Excluindo', '', 'success');
                dados = new FormData();
                dados.append('id', id);
                $.ajax({
                    url: '<?php echo base_url('admin/adminusuarios/excluirusuario/'); ?>',
                    method: 'post',
                    data: dados,
                    processData: false,
                    contentType: false,
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
            } else if (result.isDenied) {
                Swal.fire('Usuário não foi excluido', '', 'info')
            }
        })
    }
</script>
