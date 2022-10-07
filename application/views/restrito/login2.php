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
            z-index: 0;
            background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)), url('<?php echo base_url('imagens/1.jpg')?>');
            min-height: 83vh!important
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
            background: black;
        }
        .focus-input100::before {
            background: black;
        }
        .footer-area{
            background-color: #fbfbfb!important;
        }
        
        .footer-area .single-footer-widget .widget-title{
            color: black;
        }
        
        .footer-area .single-footer-widget ul li a{
            color: black;
        }
        #icone-facebook{
            color: black;
        }
        
        #icone-instagram{
            color: black;
        }
        
        #icone-facebook:hover{
            color: black;
        }
        
        #icone-instagram:hover{
            color: black;
        }

        #link-n:hover { 
            color: black!important;
        }
        .footer-area .single-footer-widget ul li a::before{
            background-color: black!important;
        }
        
        .footer-area .copywrite-area{
            padding: 10px 0!important;
            padding-bottom: 15px!important;
        }
        
        .footer-area{
            padding-top: 15px!important;
            padding-bottom: 0!important;
            border-top: 1px solid black;
        }
        
        .footer-altura {
            height: 86px!important;  
        }
        
        .copywrite-size {
            color: white!important; 
            width: 100%    
        }
        
        .des-nsoluti {
            color: white!important; 
            position: relative; 
            left: 52%;
        }
        
        @media only screen and (max-width: 720px) {
           
            #footer-mobile { 
                text-align: center; 
            }
              
            .footer-altura {
                height: 120px!important;  
            }
              
            .fundo {
                min-height: 72px!important
            }
              
            .copywrite-size {
                color: white!important;
                width: 55%;    
                position: relative;
                left: 23%;
            }
              
            .des-nsoluti {
                left: 0%!important;
                top: 10px;
            }
            
            #rede-social-area {
                position: relative;
                left: 9%;
                top: 8px;
            }
            
            .login-size {
                width: 80%;
            }
        
        }
    </style>
    
    <body onload="erro()">
        
        <div class="limiter">
    		<div class="container-login100 fundo">
    			<div class="wrap-login100 login-size" style="border: 1px solid black;">
    				<form class="login100-form" action="<?php echo base_url(''); ?>" method="post">
                        <input type="hidden" value="<?php echo base_url(); ?>" name="url" id="url">
    					<span class="login100-form-title p-b-1">
    						<p><b>Acesso Aluno</b></p><br>
    					</span>
    
                        
    					<div class="wrap-input100 validate-input" data-validate = "Digite um Usuário Válido">
    						Email ou Usuário: <input class="input100" type="text" name="login" id="login" required>
    						<span class="focus-input100"></span>
    					</div>
    
    					<div class="wrap-input100 validate-input" data-validate="Digite sua senha">
    						<span class="btn-show-pass">
    							<i class="zmdi zmdi-eye"></i>
    						</span>
    						Senha: <input class="input100" type="password" name="senha" id="senha" required>
    						<span class="focus-input100"></span>
    						
    						<button style="position: absolute;right: 0;top: 32%;background: none;border: 0;color: black;font-size: 20px;" type="button" class="btn btn-primary see-pass" id="senha_btn"><em class="fa fa-eye"></em></button>
    					</div>
    
    					<div class="container-login100-form-btn">
    						<div class="wrap-login100-form-btn">
    							<div class="login100-form-bgbtn"></div>
    							<button class="login100-form-btn">
    								Login
    							</button>
    						</div>
    					</div>
    				</form>
    				<div class="col-md-12 text-right" style="margin-top: 20px">
    				    <a style="color: black" href="<?php echo base_url('') ?>">Esqueci minha senha</a>
    				</div>
    			</div>
    		</div>
    	</div>
    	
	</body>
	
	<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0" id="footer-mobile">
        <div class="container footer-altura">
            <div class="row">
                <!-- Single Footer Widget -->
                <div class="mobilefooter-social col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget mb-100 div-footer-widget">
                        <h5 class="widget-title title-empresa"> Davi Hake Treinamentos </h5>
                        <p><i style="font-size: 18px" class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; +55 <span class="telefone">99999-9999</span></span></p>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-lg-4 col-md-4 col-6" id="rede-social-area">
                    <div class="single-footer-widget mb-100 div-footer-widget2">
                        <div class="row">
                            <a href="" target="_blank"><i id="icone-facebook" style="cursor: pointer; left: 15%; position: absolute; font-size: 35px;" class="fa fa-facebook-square" aria-hidden="true"></i></a>
                            <a href="" target="_blank"><i id="icone-instagram" style="cursor: pointer; left: 30%; position: absolute; font-size: 35px;" class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="" target="_blank"><i id="icone-youtube" style="cursor: pointer; left: 45%; position: absolute; font-size: 35px; color: black" class="fa fa-youtube-play" aria-hidden="true"></i></a>
                            <a href="" target="_blank"><i id="icone-instagram" style="cursor: pointer; left: 60%; position: absolute; font-size: 35px;" class="fa fa-telegram" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-lg-4 col-md-4 col-6" id="sobre">
                    <div class="single-footer-widget mb-100 div-footer-widget2">
                        <h5 class="widget-title"><b>Sobre</b></h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a style="margin: 10px;" href="">Contato</a></li>
                                <li><a style="margin: 10px;" href="https://api.whatsapp.com/send?phone=">Whats</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div id="copyright-center" class="copywrite-area" style="background: black; border-top: 0px solid #ecf9ff!important;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text copywrite-size">
                                <b>Copyright &copy; Davi Hake Treinamentos, todos direitos reservados. </b><a id="link-n" href="https://nsolucoes.digital/" target="_blank" class="des-nsoluti"> Desenvolvido por N Soluções </a>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
        <!-- Modal -->
        <div id="myModal" class="modal">
          <div class="modal-dialog">
        
            <div class="modal-content">
              <div class="modal-header" style="background-color: #7800a7!important;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mensagem do Sistema</h4>
              </div>
              <div class="modal-body">
                <p id="msg_erro" style="font-size: 20px"></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              </div>
            </div>
        
          </div>
        </div>
        
        <script src="<?php echo base_url('assets/admin/'); ?>lib/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/'); ?>lib/jquery.backstretch.min.js"></script>
        
        <script>
            $(document).ready(function(){
              $("#sobre").hide();
            });
        </script>
        
        <script>
            function erro(){
                var aux = <?php echo $erro ?>;
                if(aux == null){
                    document.getElementById('msg_erro').innerHTML = "Sem erro";
                    $('#myModal').modal('show');
                }else if(aux == 1){
                    document.getElementById('msg_erro').innerHTML = "Usuário incorreto!";
                    $('#myModal').modal('show');
                }else if(aux == 2){
                    document.getElementById('msg_erro').innerHTML = "Senha incorreta!";
                    $('#myModal').modal('show');
                }else if(aux == 3){
                    document.getElementById('msg_erro').innerHTML = "Usuário Inativo!";
                    $('#myModal').modal('show');
                }else if(aux == 4){
                    document.getElementById('msg_erro').innerHTML = "Captcha não verificado!";
                    $('#myModal').modal('show');
                }else if(aux == 5){
                    document.getElementById('msg_erro').innerHTML = "Usuário bloqueado, por favor entre em contato com um administrador pelo e-mail: contato@cellstoredistribuidora.com.br";
                    $('#myModal').modal('show');
                }
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
        
        <script type="text/javascript">
              var onloadCallback = function() {
              };
        </script>
        
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
    
    
</html>