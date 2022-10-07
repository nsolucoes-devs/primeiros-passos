<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="N Soluções Agência Digital - www.nsoluti.com.br" />
        <title>Restrito - Ecommerce</title>
        
        <link href="<?php echo base_url('assets/admin/');?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/');?>css/zabuto_calendar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/');?>lib/gritter/css/jquery.gritter.css" />
        <link href="<?php echo base_url('assets/admin/');?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/');?>css/style-responsive.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/admin/');?>lib/chart-master/Chart.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/areauser/css/util.css">
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/areauser/css/main.css">
    	<link href="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css">

    </head>    
    
    <style>
        .fundo{
            position: relative;
            height: 100vh;
            width: 100vw;
            background-color: white;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 0;
        }
        
        #login-page{
            position: absolute;
            z-index: 1;
            left: 0;
            right: 0;
        }
        .wrap-login100-form-btn {
            border-radius: 5px!important;
        }
        .login100-form-bgbtn {
            background: green;
        }
        .focus-input100::before {
            background: green;
        }
    </style>
    
    <body onload="erro()">
        
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="border: 1px solid #208011">
				<form id="formLogin" class="login100-form" action="<?php echo base_url('2802a69d3ecca828c74a75fcfeab3200'); ?>" method="post">
					<span class="login100-form-title p-b-1">
						<p>Gerenciamento<br>E-commerce</p>
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Digite um Usuário Válido">
						<input class="input100" type="text" name="login" id="login" required>
						<span class="focus-input100" data-placeholder="Usuário"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Digite sua senha">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="senha" id="senha" required>
						<span class="focus-input100" data-placeholder="Senha"></span>
						
						<button style="position: absolute;right: 0;top: 13%;background: none;border: 0;color: black;font-size: 20px;" type="button" class="btn btn-primary see-pass" id="senha_btn"><em class="fa fa-eye"></em></button>
					</div>
					<?php if(isset($chave['chave_site'])){ ?>
                        <div style="margin-left: -10px;" class="g-recaptcha" data-sitekey="<?php echo $chave['chave_site'] ?>"></div>
                    <?php } ?>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="g-recaptcha login100-form-btn" data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' data-action='submit'>Login</button>
							<!--<button class="login100-form-btn">
								Login
							</button>-->
						</div>
						
					</div>
				</form>
				<div class="col-md-12 text-right" style="margin-top: 20px">
				    <a style="color: green" href="<?php echo base_url('') ?>">Voltar</a>
				</div>
			</div>
		</div>
	</div>

<script src="<?php echo base_url('assets/admin/'); ?>lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/'); ?>lib/jquery.backstretch.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script src="<?php echo base_url('assets/admin/');?>lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/jquery.sparkline.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/common-scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/gritter-conf.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/sparkline-chart.js"></script>
<script src="<?php echo base_url('assets/admin/');?>lib/zabuto_calendar.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url('resources/datatables/datatable/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/datatables/datatable/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/datatables/datatable/js/dataTables.bootstrap.min.js');?>"></script>
<!-- sweetalert2 -->
<script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
<script src='<?php echo base_url('recursos/js/');?>/material/plugins/sweetalert2.js'></script>	
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/popper.js"></script>
<script src="<?php echo base_url() ?>assets/areauser/vendor/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/areauser/vendor/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/vendor/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url() ?>assets/areauser/js/main.js"></script>

<script>
    <?php if(isset($erro)){ ?>
        $( document ).ready(function() {
            Swal.fire('<?php echo $erro; ?>')
        });
    <?php }?>

    function onSubmit(token) {
        document.getElementById("formLogin").submit();
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

    </body>

</html>
