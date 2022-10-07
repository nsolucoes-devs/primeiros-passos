    <?php
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile = 1;
        } else {
            $mobile = 0;
        }
    ?>
	  	
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/areauser/css/main.css"> 
    <!--===============================================================================================-->
    
       
    
    <style>
    .input100 {
        font-family: 'Montserrat'!important;
    }
    
    .login100-form-bgbtn {
        background: -webkit-linear-gradient(right, #d67514, #ea6d13, #e8a268, #bb5b17);
    }
    .focus-input100::before{
        background: -webkit-linear-gradient(left, var(--base-color), #444);
    }
    .wrap-login100 {
        width: 400px;  
        padding: 40px;
    }
    
    .checkbox{
        height: 16px;
        width: 16px;
    }
    
    .titulo2{
        color: grey;
        margin-top: 34px
    }
    
    .div-checkbox{
        margin-top: 4px;
        width: 45%;
        margin-left: -100px;
    }
    
    .div-lembre{
         width: 55%;
         padding: 0;
         padding-left: 17px;
    }
    .btn-primary::before {
        background: #444!important;
    }
    
    .swal2-popup .swal2-styled.swal2-confirm {
        background-color: var(--base-color)!important;
    }
    
    @media(max-width: 500px){
        .wrap-login100 {
            width: 290px;   
            padding: 35px;
            margin-left: 9%;
        }
        #row-principal{
            margin-top: 22%;
        }
        .checkbox{
            height: 21px;
            width: 21px;
        }
        .titulo2{
            color: grey;
            margin-top: 0;
        }
        .div-checkbox{
            margin-left: -15px;
            width: 10%;
        }
        .div-lembre{
             width: 70%;
             padding: 0;
             padding-left: 17px;
        }
        .politica{
            text-align: center!important;
        }
    }
    </style>
	<div class="limiter">
		<div class="container-login100" style="background: #fafafa;">
		    <div class="row" id="row-principal">
		        <?php if($mobile == 0) { ?>
		        <div class="col-md-6 form-group">
			        <div class="wrap-login100">
				        <form id="form-login" class="login100-form" action="<?php echo base_url('2cbb8dbaacfbc463addd849f7c5ece4a') ?>" method="post">

        					<span class="login100-form-title p-b-1">
        						<h4>Entrar</h4>
        					</span>
        					
        					<div class="text-center">
        					    <h5 class="titulo2">Já tenho meu cadastro</h5>
        					</div>
    
        					<div class="wrap-input100 validate-input" data-validate = "Digite um CPF Válido" style="margin-top: 39px">
        					    <input class="input100" type="text" name="login" id="cpf2">
        						<input class="cpf input100" type="text" name="login" required>
        						<span class="focus-input100" data-placeholder="CPF"></span>
        					</div>
    
        					<div class="wrap-input100 validate-input" data-validate="Digite sua senha">
        					    <input type="password" name="for_autocomplete1" id="password2">
        						<span class="btn-show-pass">
        							<i class="zmdi zmdi-eye"></i>
        						</span>
        						<input class="input100" type="password" name="pass" required>
        						<span class="focus-input100" data-placeholder="Senha"></span>
        					</div>
                
        					<div class="container-login100-form-btn">
        						<div class="wrap-login100-form-btn" style="border-radius: 5px;">
        							<div class="login100-form-bgbtn"></div>
        							<?php if(isset($chave)){ ?>
            							<button class="login100-form-btn" style="background: var(--base-color);"  data-callback='onSubmit' data-action='submit'>
            								Entrar
            							</button>
            							<!-- g-recaptcha // data-sitekey="<?php //echo $chave['chave_site'] ?>" -->
        							<?php } ?>
        						</div>
        					</div>
        					
        					<div class="text-right p-t-1">
        					    <div class="row">
        					        <div class="col-md-12" style="width: 100%">
        					            <a style="font-size: 11px; color: #444; cursor: pointer;" href="#" data-toggle="modal" data-target="#esqueciSenhaModal"><b>Esqueci a senha</b></a>
        						    </div>
        						</div>
        					</div>
    				    </form>
			        </div>
			    </div>
			    <?php } ?>
			    <div class="col-md-6 form-group">
			        <div class="wrap-login100">
				        <form id="form-cadastro" class="login100-form" id="form_cadastro" action="<?php echo base_url('areauser/insertCliente') ?>" method="post">
        					<span class="login100-form-title p-b-1">
        						<h4>Cadastre-se</h4>
        					</span>
        					
        					<div class="wrap-input100 validate-input" data-validate = "Digite um Nome">
        						<input class="input100 nomecad" type="text" name="nome_cadastro" id="nome_cadastro" required>
        						<span class="focus-input100" data-placeholder="Nome Completo"></span>
        					</div>
        
        					<div class="wrap-input100 validate-input" data-validate = "Digite um CPF">
        						<input class="cpf input100" type="text" name="cpf_cadastro" id="cpf_cadastro" required>
        						<span class="focus-input100" data-placeholder="CPF"></span>
        					</div>
        
        					<div class="wrap-input100 validate-input" data-validate="Digite sua senha" style="margin-bottom: 12px!important">
        						<span class="btn-show-pass">
        							<i class="zmdi zmdi-eye"></i>
        						</span>
        						<input class="input100" type="password" onkeyup="senha()" name="senha_cadastro" id="senha_cadastro" required>
        						<span class="focus-input100" data-placeholder="Senha"></span>
        					</div>
        					
        					<label id="alert-senha" style="font-size: 14px; visibility: hidden; color: red">*A senha deve ter mais de seis caracteres.</label>

        					<div class="container-login100-form-btn" style="margin-bottom: 25px">
        						<div class="wrap-login100-form-btn" style="border-radius: 5px;">
        							<div class="login100-form-bgbtn"></div>
        							<?php if(isset($chave)){ ?>
            							<button type="button" onclick="validaCpf()" class="login100-form-btn g-recaptcha" style="background: var(--base-color);"  data-sitekey="<?php echo $chave['chave_site'] ?>" data-callback='onSubmit2' data-action='submit'>
            								Cadastrar
            							</button>
        							<?php } ?>
        						</div>
        					</div>
					
        					<div class="text-right p-t-1 politica" style="margin-top: -25px;">
        						<a style="font-size: 12px; color: #444; cursor: pointer;" data-toggle="modal" data-target="#privacidade"><b style="color: #444">Política de privacidade</b></a>
        					</div>
				        </form>
			        </div>
			    </div>
			    <?php if($mobile == 1) { ?>
		        <div class="col-md-6 form-group">
			        <div class="wrap-login100">
				        <form id="form-login" class="login100-form" action="<?php echo base_url('2cbb8dbaacfbc463addd849f7c5ece4a') ?>" method="post">

        					<span class="login100-form-title p-b-1">
        						<h4>Entrar</h4>
        					</span>
        					
        					<div class="text-center">
        					    <h5 class="titulo2">Já tenho meu cadastro</h5>
        					</div>
    
        					<div class="wrap-input100 validate-input" data-validate = "Digite um CPF Válido" style="margin-top: 39px">
        					    <input class="input100" type="text" name="login" id="cpf2">
        						<input class="cpf input100" type="text" name="login" required>
        						<span class="focus-input100" data-placeholder="CPF"></span>
        					</div>
    
        					<div class="wrap-input100 validate-input" data-validate="Digite sua senha">
        					    <input type="password" name="for_autocomplete1" id="password2">
        						<span class="btn-show-pass">
        							<i class="zmdi zmdi-eye"></i>
        						</span>
        						<input class="input100" type="password" name="pass" required>
        						<span class="focus-input100" data-placeholder="Senha"></span>
        					</div>
        					

        					    <div class="row">
        					        
                                </div>
                
        					<div class="container-login100-form-btn">
        						<div class="wrap-login100-form-btn" style="border-radius: 5px;">
        							<div class="login100-form-bgbtn"></div>
        							<button class="login100-form-btn" style="background: var(--base-color);" data-callback='onSubmit' data-action='submit'>
        								Entrar
        							</button>
        						</div>
        					</div>
        					
        					<div class="text-right p-t-1">
        					    <div class="row">
        					        <div class="col-md-6" style="width: 50%">

        					        </div>
        					        <div class="col-md-6" style="width: 50%">
        					            <a style="font-size: 11px; color: #444; cursor: pointer;" href="#" data-toggle="modal" data-target="#esqueciSenhaModal"><b style="color: #444">Esqueci a senha</b></a>
        						    </div>
        						</div>
        					</div>
    				    </form>
			        </div>
			    </div>
			    <?php } ?>
			</div>
		</div>
	</div>
	
	
    <!-- Modal -->
    <div class="modal fade" id="esqueciSenhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Redefinir a senha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('areauser/esquecerSenha') ?>" method="post">
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>CPF:</label>
                        <input type="text" name="cpf-esquecer" id="cpf-esquecer" class="cpf form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>E-mail:</label>
                        <input type="email" name="email-esquecer" id="email-esquecer" class="form-control">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="background: var(--base-color); border-color: var(--base-color);">Redefinir</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
	
	
<!-- sweetalert2 -->
    <script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
    <script src='<?php echo base_url('recursos/js/material/plugins/sweetalert2.js');?>'></script>	
<!--===============================================================================================-->
	<!--<script src="<?php echo base_url() ?>assets/areauser/vendor/jquery-3.2.1.min.js"></script>-->
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/vendor/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/vendor/popper.js"></script>
	<!--<script src="<?php echo base_url() ?>assets/areauser/vendor/bootstrap.min.js"></script>-->
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/vendor/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/vendor/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/areauser/vendor/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/vendor/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/areauser/js/main.js"></script>
	
	
	<script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
       function onSubmit(token) {

         document.getElementById("form-login").submit();
       }
    </script>
     
    <script>
       function onSubmit2(token) {
            document.getElementById("form-cadastro").submit();
       }
    </script>
	
	<script>
        $(document).ready(function(){
             $('.cpf').mask('000.000.000-00', {reverse: true});
            
            <?php if(isset($msg)) { ?>
                <?php if($msg == 1){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'CPF ou senha errada(s)!',
                    })
                <?php } else if($msg == 2){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Usuário bloqueado, por favor entrar em contato com o SAC!',
                    })
                <?php } else if($msg == 3){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'CPF já cadastrado!',
                    })
                <?php } else if($msg == 4){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'CPF não cadastrado, tente novamente!',
                    })
                <?php } else if($msg == 5){ ?>
                    Swal.fire({
                        type: 'success',
                        title: 'Encaminhamos um e-mail para redefinição de senha!',
                    })
                <?php } else if($msg == 6){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Por favor, entre em contato com o SAC, a respeito sobre a sua conta!',
                    })
                <?php }else if($msg == 7){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Digite um nome, tente novamente!',
                    })
                <?php }else if($msg == 8){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Senha deve ser maior que seis dígitos, tente novamente!',
                    })
                     <?php }else if($msg == 9){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Digite um CPF, tente novamente!',
                    })
                    <?php }else if($msg == 10){ ?>
                    Swal.fire({
                        type: 'error',
                        title: 'Digite uma senha, tente novamente!',
                    })
                <?php }  ?>
            <?php } ?>
        });
    </script>
	
	<script>
	    $(document).ready(function(){
	        $('#insert_cpf').mask('000.000.000-00', {reverse: true});
	        $('.nomecad').on("input", function(){
              var regexp = /[^a-zA-Z- ]/g;
              if($(this).val().match(regexp)){
                $(this).val( $(this).val().replace(regexp,'') );
              }
            });
	        
	        $('#login1').hide(); 
	        $('#password3').hide(); 
	        $('#cpf2').hide(); 
	        $('#password2').hide(); 
	    });
	</script>
	
	<script>
	    function senha(){
	        var senha = $('#senha_cadastro').val().length;
	        
	        if(senha < 6){
	            $('#alert-senha').css('visibility', 'visible');
	        } else {
	            $('#alert-senha').css('visibility', 'hidden');
	        }
	    }
	</script>
	
	<script>
        function validaCpf(){
            var senha = $('#senha_cadastro').val().length;
            var id = 'cpf_cadastro';
            
            strCPF = document.getElementById(id).value;
            strCPF = strCPF.replace('-', '');
            strCPF = strCPF.replace('.', '');
            strCPF = strCPF.replace('.', '');
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999" ) {
                valCpfCartao = false;
                document.getElementById(id).setCustomValidity('CPF Inválido!');
                document.getElementById(id).reportValidity();
            }else if(strCPF == ""){
                document.getElementById(id).setCustomValidity('');
            }else{
                for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ){
                    valCpfCartao = false;
                    document.getElementById(id).setCustomValidity('CPF Inválido!');
                    document.getElementById(id).reportValidity();
                }else{
                    Soma = 0;
                    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                    Resto = (Soma * 10) % 11;
                    if ((Resto == 10) || (Resto == 11))  Resto = 0;
                    if (Resto != parseInt(strCPF.substring(10, 11) ) ){ 
                        valCpfCartao = false;
                        document.getElementById(id).setCustomValidity('CPF Inválido!');
                        document.getElementById(id).reportValidity();
                    }else{
                        valCpfCartao = true;
                        
                        if(senha >= 6){
            	            $('#form_cadastro').submit();
            	        } else {
            	            $('#alert-senha').css('visibility', 'visible');
            	        }
                    }
                }
            }
        }
    </script>

