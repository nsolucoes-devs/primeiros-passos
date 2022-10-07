
<style>
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
    
    .outside-grey{
        width: 200px;
        height: 10px;
        background-color: lightgrey;
        display: inline-block;
    }
    
    .inside-green{
        width: 0%;
        height: 10px;
        background-color: lime;
        display: block;
    }
</style>

<style>
    .pass{
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .see-pass{
        width: 40px;
        display: inline;
        height: 34px;
        text-align: center;
        font-size: 14px;
        line-height: 14px;
        color: white;
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
        border-radius: 5px;
        border: 1px solid #6d00b1;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
    
    .senha-dialog{
        margin: auto;
        margin-top: 3%;
        width: 450px;
    }
    
    .input-senha{
        width: calc(100% - 41px);
        margin-right: -4px;
        display: inline;
        float: left;
    }
    
    .btn-senha{
        width: 40px;
        display: inline;
        float: left;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Dados</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('1113c334193562fcb49c6557f14671f9') ?>">Perfil</a></li>
            </ol>
        </nav>
        
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: #1b9045;"><b>PERFIL</b></h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin: 0 5px">
                <form action="<?php echo base_url('79d99ec07624519b935dc0989b93b169') ?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="col-md-4 text-center">
                            <label><b>FOTO</b></label><br>
                            <img style="width: 200px; height: 200px" src="<?php echo base_url($usuario['foto']) ?>">
                            <br><br>
                            <span class="outside-grey"><span class="inside-green" id="myBar"></span></span>
                            <button type="button" class="btn btn-primary" style="width: 200px" onclick="trigger_foto()">Enviar nova foto</button>
                            <input type="file" style="display: none" name="foto" id="foto" class="input-file">
                            <br><br>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-7 form-group">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" value="<?php echo $usuario['nome'] ?>">
                            </div>
                            <div class="col-md-5 form-group">
                                <label>CPF/CNPJ</label>
                                <input type="text" name="cpfcnpj" id="cpfcnpj" class="form-control" value="<?php echo $usuario['cpfcnpj'] ?>">
                            </div>
                            <div class="col-md-7 form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $usuario['email'] ?>">
                            </div>
                            <div class="col-md-5 form-group">
                                <label>Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo $usuario['telefone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#alteraModal">Alterar Senha</button>
                    </div>
                </form>
            </div>
            <br><br>
        </div>
        
    </section>       
</section>



<div class="modal fade" id="alteraModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog senha-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);">
                <h5 style="display:inline;" class="modal-title">Alterar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="post" action="<?php echo base_url('4dce70e680b6ad3d06178477db973ea7') ?>" id="form_senha">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Digite a nova senha:</label><br>
                            <div class="input-senha">
                                <input type="password" class="form-control pass" name="senha" id="senha" required>
                            </div>
                            <div class="btn-senha">
                                <button type="button" class="see-pass" data-target="senha"><em class="fa fa-eye"></em></button>
                            </div>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label>Confirme a nova senha:</label><br>
                            <div class="input-senha">
                                <input type="password" class="form-control pass" name="conf_senha" id="conf_senha" required oninput="this.setCustomValidity('')">
                            </div>
                            <div class="btn-senha">
                                <button type="button" class="see-pass" data-target="conf_senha"><em class="fa fa-eye"></em></button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- start - SweetAlert2 styles -->
<style>
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
<!-- end - SweetAlert2 styles -->

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
        
        var cpfoptions = {
            onKeyPress: function (cpf, ev, el, op) {
                var masks = ['000.000.000-00#', '00.000.000/0000-00'];
                $('#cpfcnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }
        
        $('#cpfcnpj').val().length > 11 ? $('#cpfcnpj').mask('00.000.000/0000-00', cpfoptions) : $('#cpfcnpj').mask('000.000.000-00#', cpfoptions);
        $('#telefone').mask(SPMaskBehavior, spOptions);
        
        <?php if(isset($msg)) { ?>
        <?php if($msg == 1 || $msg == '1'){ ?>
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
                title: 'Senha Alterada!'
            })
        <?php } else if($msg == 2 || $msg == '2'){ ?>
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
                title: 'Perfil Atualizado com Sucesso!'
            })
        <?php } ?>
        <?php } ?>
    });
    
    function trigger_foto(){
        $('#foto').click();
    }
    
    $('.input-file').on('change', function(){
        if($(this).val() != ""){
            move();
        }else{
            $('#myBar').css('width', '0%');
        }
    });
    
    $('.see-pass').on('click', function(){
        var id = $(this).data('target');
        const type = $('#'+id).prop('type') === 'password' ? 'text' : 'password';
        $('#'+id).prop('type', type);
        if(type == "text"){
            $(this).children().removeClass("fa-eye").addClass("fa-eye-slash");
        }else{
            $(this).children().removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
    
    $('#form_senha').on('submit', function(e){
        if($('#senha').val() == $('#conf_senha').val()){
            
        }else{
            e.preventDefault();
            document.getElementById('conf_senha').setCustomValidity('A confirmação da senha deve ser idêntica a senha!');
            document.getElementById('conf_senha').reportValidity();
        }
    });
    
    var i = 0;
    function move() {
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("myBar");
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                } else {
                    width++;
                    elem.style.width = width + "%";
                }
            }
        }
    }
</script>
