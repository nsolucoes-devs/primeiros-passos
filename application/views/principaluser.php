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
    
    
       <style>
        .links-footer{margin-bottom: -12px; font-size: 12px; color: white;}.social-media{margin-right: 36px; display: inline;}.social-media em{color: white; font-size: 16px;}.footer{background-color: #7800a7; z-index: 99;}.f-row{width: 100%; margin: 0;}.c3{max-width: 25%; flex: 0 0 25%; padding-right: 15px; padding-left: 15px; float: left;}.c4{max-width: 33.33%; flex: 0 0 33.33%; padding-right: 15px; padding-left: 15px;}.c6{max-width: 50%; flex: 0 0 50%; padding-right: 15px; padding-left: 15px;}.c8{max-width: 66.66%; flex: 0 0 66.66%; padding-right: 15px; padding-left: 15px;}.c9{max-width: 75%; flex: 0 0 75%; padding-right: 15px; padding-left: 15px; float: left;}.c12{max-width: 100%; flex: 0 0 100%; padding-right: 15px; padding-left: 15px;}.f-main{padding: 15px 20px;}.card-brands{width: 76%;}.f-white{color: white; font-size: 11px; line-height: 13px; margin-bottom: 5px;}.f-white b{color: white; font-size: 11px; line-height: 13px; margin-bottom: 5px; font-weight: bold;}.br{border-right: 1px solid #d3d3d359;}.inline{display: inline;}.pr-80{padding-right: 80px;}.pr-90{padding-right: 90px;}.mt-21{margin-top: 18px;}.float-l{float: left;}.float-r{float: right;}.fs-22{font-size: 22px;}.social-media{margin: 3px 8px 0 8px; cursor: pointer;}#footer-pc{display: block;}#footer-mob{display: none;}
        /* XX-Small devices (300px and up) */ 
        @media ( min-width: 299px ) and ( max-width: 398px ){.privacidade{width: 90%; max-width: 90%; margin: 30px 5% 0 5%;}#footer-pc{display: none;}#footer-mob{display: block;}}
        /* X-Small devices (iPhone and others mobiles, 400px and up) */ 
        @media ( min-width: 399px ) and ( max-width: 574px ){.privacidade{width: 90%; max-width: 90%; margin: 30px 5% 0 5%;}#footer-pc{display: none;}#footer-mob{display: block;}}
        /* Small devices (landscape phones, 576px and up) */ 
        @media ( min-width: 575px ) and ( max-width: 766px ){.privacidade{width: 90%; max-width: 90%; margin: 30px 5% 0 5%;}#footer-pc{display: none;}#footer-mob{display: block;}}
        /* Medium devices (tablets, 768px and up) */ 
        @media ( min-width: 767px ) and ( max-width: 990px ){.privacidade{width: 90%; max-width: 90%; margin: 30px 5% 0 5%;}}
        /* Large devices (desktops, 992px and up) */ 
        @media ( min-width: 991px ) and ( max-width: 1198px ){.privacidade{width: 80%; max-width: 80%; margin: 30px 10% 0 10%;}}
        /* X-Large devices (large desktops, 1200px and up) */ 
        @media ( min-width: 1199px ) and ( max-width: 1398px ){.privacidade{width: 70%; max-width: 70%; margin: 30px 15% 0 15%;}}
        /* XX-Large devices (larger desktops, 1400px and up) */ 
        @media ( min-width: 1399px ){.privacidade{width: 70%; max-width: 70%; margin: 30px 15% 0 15%;}}#back-top{background-color: #7800a7; box-shadow: unset; border-color: #ffffffff;}.btn-fechar{width: 100px; font-size: 16px; padding: 20px; color: white!important; background-color: #7800a7; border-color: #7800a7; border-radius: 15px;}.policys-p{font-size: 12px; line-height: 15px; color: black; text-align: justify; margin-bottom: 12px;}.policys-p b, .policys-p1 b{color: black;}.policys-p1{font-size: 12px; line-height: 15px; color: black; text-align: justify; margin-bottom: 5px;}.policys-ul{padding-left: 20px; margin-bottom: 12px;}.policys-circle{font-size: 8px; margin-right: 10px;}.policys-h4{font-size: 14px; line-height: 19px; color: black; text-align: justify; margin-bottom: 12px; margin-top: 25px; text-transform: uppercase;}.link-footer{cursor: pointer;}
    </style>

<style>
    body{
        background: #fafafa;
    }   
    
    nav.primary-navigation {
    	 margin: 0 auto;
    	 display: block;
    	 text-align: center;
    	 font-size: 16px;
    }
     nav.primary-navigation ul li {
    	 list-style: none;
    	 margin: 0 auto;
    	
    	 display: inline-block;
    	 padding: 0 30px;
    	 position: relative;
    	 text-decoration: none;
    	 text-align: center;
    	 font-family: "Oswald",sans-serif;
    }
     .gui {
    	 list-style: none;
    	 margin: 0 auto;
    	 
    	 padding-right: 30px;
    	 display: inline-block;
    	 position: relative;
    	 text-decoration: none;
    	 text-align: center;
    	 font-family: "Oswald",sans-serif;
    }
     nav.primary-navigation li a {
    	 color: black;
    }
     nav.primary-navigation li a:hover {
    	 color: var(--base-color);
    }
     nav.primary-navigation li:hover {
    	 cursor: pointer;
    }
     nav.primary-navigation ul li ul {
    	 visibility: hidden;
    	 opacity: 0;
    	 position: absolute;
    	 padding-left: 0;
    	 left: 0;
    	 display: none;
    	 background: white;
    }
     nav.primary-navigation ul li:hover > ul, nav.primary-navigation ul li ul:hover {
    	 visibility: visible;
    	 opacity: 1;
    	 display: block;
    	 min-width: 250px;
    	 text-align: left;
    	 padding-top: 20px;
    	 box-shadow: 0px 3px 5px -1px #ccc;
    }
     nav.primary-navigation ul li ul li {
    	 clear: both;
    	 width: 100%;
    	 text-align: left;
    	 margin-bottom: 20px;
    	 border-style: none;
    }
     nav.primary-navigation ul li ul li a:hover {
    	 padding-left: 10px;
    	 border-left: 2px solid var(--base-color);
    	 transition: all 0.3s ease;
    }
     a {
    	 text-decoration: none;
    }
    #nav-cima a:hover {
    	 color: var(--base-color);
    	 font-size: 21px!important;
    }
     ul li ul li a {
    	 transition: all 0.5s ease;
    }
    
    .font-gui {
        font-family: "Oswald",sans-serif;
    }
    
    .active{
        border-bottom: 3px solid var(--base-color);
    }
    
    .active-icon{
        color: var(--base-color);
        transition: color 0.5s;
    }
    
    .icone-pedido{
        cursor: pointer; 
        font-size: 20px;
        padding: 5px;
    }
    
    .icone-menu{
        font-size: 25px;
    }
    
    .a-menu{
         font-size: 21px!important;
    }
    
    .btn-file{
        border:1px solid var(--base-color)!important;
        background-color: var(--base-color)!important;
    }
    .btn-fechar{
        background-color: var(--base-color)!important;
    }
    
    .li-teste:hover .a-menu {
        color: var(--base-color);
    }
    
    .contact-section{
        margin-bottom: 8%;
        padding-top: 100px;
        background-color: #fafafa;
    }
    
    .menu_pedido{
        display: none;
        padding: 5px!important;
        margin-top: 2%;
        border: 1px solid #efeded;
        border-radius: 5px;
    }
    
    .principal-corpo{
        border-radius: 20px;
        padding: 15px;
        background: #f7f7f7;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }
    
    .mobilecard-id{
        position: relative;
        top: 10px;
        font-size: 16px;
        font-weight: 500;
    }
    
    .mobilecard-data{
        padding: 0;
        font-size: 11px;
        position: relative;
        top: 14px;
    }
    
    .mobilecard-valor{
        padding: 0!important;
        padding-left: 10px!important;
        position: relative;
        top: 10px;
    }
    
    @media(max-width: 500px){
        .tr-pedidos{
            border: 1px solid #cecece;
            border-radius: 10px!important;
            background: #f7f7f7;
        }
        #nav-cima a:hover {
        	 color: var(--base-color);
        	 font-size: 16px!important;
        }
        .menu_pedido{
            padding: 0px!important;
        }
        #titulo-cliente{
            text-align: center;
            font-size: 16px;
        }
        #li_dados{
            padding-left: 1px;
            padding-right: 15px;
            margin: 0;
            font-size: 17px;
        }
        #li_endereco{
            padding-left: 15px;
            padding-right: 15px;
            margin: 0;
            font-size: 17px;
        }
        #li_pedido{
            padding-left: 15px;
            padding-right: 1px;
            margin: 0;
            font-size: 17px;
        }
        .gui{
            padding: 0;
        }
        #nav-cima{
            margin-top: 5%;
        }
        .icone-menu{
            font-size: 19px;
        }   
        .a-menu{
         font-size: 16px!important;
        }
        .card-body{
            padding: -5px;
        }
        #menu_dados{
            line-height: 5px!important;
        }
        #menu_endereco{
            line-height: 5px!important;
        }
        #redefinir-button{
            text-align: center!important; 
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .buttons{
            text-align: center!important;     
        }
        .icone-pedido{
            padding: 0;
        }   
        .contact-section{
            padding-top: 0!important;
        }
        .container-perfil{
            padding: 8px!important;
        }
    }
</style>


<section class="contact-section">
    <div class="container-fluid container-perfil">
        <div class="card" style="border: 0">
            <div class="card-body" style="visibility: hidden; padding: 20px; padding-right: 7px!important; padding-left: 7px!important">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="gui" href="<?php echo base_url('c8b39540f80ad8d4952cf79d651aec77') ?>"><i style="font-size: 15px!important;" class="botao-voltar fa fa-sign-out" aria-hidden="true"><span style="font-size: 14px;font-family: 'Open Sans';"> Sair</span></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 text-center form-group">
                        <i style="color: #656565;font-size: 47px" class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11 form-group" style="margin-bottom: auto; margin-top: auto">
                        <h5 id="titulo-cliente" style="color: #656565">Bem Vindo, <?php echo ucfirst(strtolower($this->session->userdata('cliente_nome'))); ?></h5>
                    </div>
                </div>
                
                    <nav role="navigation" id="nav-cima" class="primary-navigation">
                      <ul>
                        <li id="li_dados" onclick="dados()" class="li-teste active"><i id="i_dados" class="active-icon icone-menu fa fa-user" aria-hidden="true"></i><a class="a-menu" href="#dados"> Dados</a></li>
                        <li id="li_endereco" onclick="endereco()" class="li-teste" ><i id="i_endereco"  class="icone-menu fa fa-map-marker" aria-hidden="true"></i><a class="a-menu" href="#endereco"> Endereço</a></li>
                        <li id="li_pedido" onclick="pedido()" class="li-teste"><i id="i_pedido" class="icone-menu fa fa-list-alt" aria-hidden="true"></i><a class="a-menu" href="#pedidos"> Pedidos</a></li>
                      </ul>
                    </nav>
                
                <hr style="height: 1px; border-color: #efeded; margin-top: 0">
                
                
                <div id="menu_dados" style="padding: 15px; margin-top: 2%; border: 1px solid #efeded; border-radius: 5px;">
                    <div id="visualizar">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label style="color: black;"><b style="color: black">Nome:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_nome']) ?></p>
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">CPF:</b></label>
                                <p style="color: grey" class="cpf"><?php echo $cliente['cliente_cpf'] ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">E-mail:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_email']) ?></p>
                            </div>
                            <div class="col-md-3 form-group">
                                <label style="color: black;"><b style="color: black">Telefone:</b></label>
                                <p style="color: grey" class="telefone"><?php echo $cliente['cliente_telefone'] ?></p>
                            </div>
                            <div class="col-md-2 form-group">
                                <label style="color: black;"><b style="color: black">Gênero:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_genero']) ?></p>
                            </div>
                            <div class="col-md-3 form-group">
                                <label style="color: black;"><b style="color: black">Nascimento:</b></label>
                                <p style="color: grey"><?php if($cliente['cliente_nascimento']) { echo date('d/m/Y', strtotime($cliente['cliente_nascimento'])); } ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 form-group text-right">
                                <button onclick="editar()" class="btn-primary btn">Editar</button>
                            </div>
                        </div>
                    </div>
                    <div id="editar" style="display: none">
                        <form id="form-dados" action="<?php echo base_url('518244d885f7954e658e58590b55f00e') ?>" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->session->userdata('cliente_user_id') ?>">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label style="color: black;"><b style="color: black">Nome:</b></label>
                                <input type="text" class="font-gui form-control" id="nome" name="nome" value="<?php echo mb_strtoupper($cliente['cliente_nome']) ?>">
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">CPF:</b></label>
                                <input type="text" class="cpf font-gui form-control" id="cpf" value="<?php echo $cliente['cliente_cpf'] ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">E-mail:</b></label>
                                <input type="text" id="email" name="email" class="font-gui form-control" value="<?php echo mb_strtoupper($cliente['cliente_email']) ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label style="color: black;"><b style="color: black">Telefone:</b></label>
                                <input type="text" id="telefone" name="telefone" class="telefone font-gui form-control" value="<?php echo $cliente['cliente_telefone'] ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label style="color: black;"><b style="color: black">Gênero:</b></label>
                                <select  id="genero" name="genero" class="font-gui form-control">
                                    <option value="" selected disabled>  Selecione  </option>
                                    <option value="FEMININO">Feminino</option>
                                    <option value="MASCULINO">Masculino</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label style="color: black;"><b style="color: black">Nascimento:</b></label>
                                <input   id="nascimento" name="nascimento" type="date" class="font-gui form-control" value="<?php echo $cliente['cliente_nascimento'] ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 form-group" id="redefinir-button">
                                <button type="button"  data-toggle="modal" data-target="#exampleModalLong" class="btn-primary btn">Redefinir Senha</button>
                            </div>
                            <div class="col-md-6 text-right form-group buttons">
                                <button type="button" class="g-recaptcha btn-primary btn" data-sitekey="<?php echo $chave['chave_site'] ?>" data-callback='onSubmit' data-action='submit'>Salvar</button>
                                <button onclick="visualizar()" type="button" class="btn-primary btn">Cancelar</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                
                
                <div id="menu_endereco" style="display: none; padding: 15px; margin-top: 2%; border: 1px solid #efeded; border-radius: 5px;">
                    <div id="visualizar_endereco">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label style="color: black;"><b style="color: black">CEP:</b></label>
                                <p style="color: grey" class="cep"><?php echo $cliente['cliente_cep'] ?></p>
                            </div>
                            <div class="col-md-5 form-group">
                                <label style="color: black;"><b style="color: black">Endereço:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_endereco']) ?></p>
                            </div>
                            <div class="col-md-2 form-group">
                                <label style="color: black;"><b style="color: black">Número:</b></label>
                                <p style="color: grey"><?php echo $cliente['cliente_numero'] ?></p>
                            </div>
                            <div class="col-md-3 form-group">
                                <label style="color: black;"><b style="color: black">Complemento:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_complemento']) ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">Bairro:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_bairro']) ?></p>
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">Cidade:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_cidade']) ?></p>
                            </div>
                            <div class="col-md-4 form-group">
                                <label style="color: black;"><b style="color: black">Estado:</b></label>
                                <p style="color: grey"><?php echo mb_strtoupper($cliente['cliente_estado']) ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 form-group text-right">
                                <button onclick="editar_endereco()" class="btn-primary btn">Editar</button>
                            </div>
                        </div>
                    </div>
                    <div id="editar_endereco" style="display: none">
                        <form id="form-endereco" action="<?php echo base_url('c7a0f86bd55fc21784a214275d528b2c') ?>" method="post">
                            <input type="hidden" name="id2" id="id2" value="<?php echo $this->session->userdata('cliente_user_id') ?>">
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b style="color: black">CEP:</b></label>
                                    <input type="text" onkeyup="autofillCEP()" class="cep form-control" id="cep" name="cep" value="<?php echo $cliente['cliente_cep'] ?>" required>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label style="color: black;"><b style="color: black">Endereço:</b></label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo mb_strtoupper($cliente['cliente_endereco']) ?>" required>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b style="color: black">Número:</b></label>
                                    <input type="text" class="form-control"  id="numero" name="numero" value="<?php echo $cliente['cliente_numero'] ?>" required>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b style="color: black">Complemento:</b></label>
                                    <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo mb_strtoupper($cliente['cliente_complemento']) ?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b style="color: black">Bairro:</b></label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo mb_strtoupper($cliente['cliente_bairro']) ?>" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b style="color: black">Cidade:</b></label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo mb_strtoupper($cliente['cliente_cidade']) ?>" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b style="color: black">Estado:</b></label>
                                    <select class="form-control" id="estado" name="estado" required>
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
                            
                            <div class="row">
                                <div class="col-md-12 form-group text-right buttons">
                                    <button type="button" class="g-recaptcha btn-primary btn" data-sitekey="<?php echo $chave['chave_site'] ?>" data-callback='onSubmit2' data-action='submit'>Salvar</button>
                                    <button type="button" onclick="visualizar_endereco()" class="btn-primary btn">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div id="menu_pedido">
                    <?php if($mobile == 0){ ?>
                        <div class="table-responsive" style="width: 100%">
                            <table class="table">
                                <thead>
                                    <tr style="background-color: var(--base-color);">
                                        <th style="width: 10%; color: white;" scope="col">Pedido</th>
                                        <th style="width: 15%; color: white;" class="text-center" scope="col">Data</th>
                                        <th style="width: 20%; color: white;" class="text-center" scope="col">Valor</th>
                                        <th style="width: 30%; color: white;" class="text-center" scope="col">Status</th>
                                        <th style="width: 30%; color: white;" class="text-center" scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pedidos as $p){ ?>
                                        <tr class="tr-pedidos" onclick="verpedido(<?php echo $p['id'] ?>)">
                                            <td><?php echo $p['id'] ?></td>
                                            <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($p['data'])) ?></td>
                                            <td class="text-center">R$ <?php echo number_format($p['valor'],2,',','.') ?></td>
                                            <td class="text-center"><?php echo $p['status'] ?></td>
                                            <td style="padding: 0; padding-top: 12px; color: var(--base-color);" class="text-center">
                                                <a style="color: #3a0b0c;" onclick="verpedido(<?php echo $p['id'] ?>)"><i class="icone-pedido fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($pedidos == null) { ?>
                            <div class="col-md-12 text-center form-group">
                                <p>Nenhum pedido realizado.</p>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <?php foreach($pedidos as $p){ ?>
                            <div class="principal-corpo form-group" onclick="verpedido(<?php echo $p['id'] ?>)">
                                <div class="row">
                                    <div class="col-2 mobilecard-id">
                                        <td><?php echo $p['id'] ?></td>
                                    </div>
                                    <div class="col-3 mobilecard-data">
                                        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($p['data'])) ?></td>
                                    </div>
                                    <div class="col-3 mobilecard-valor">
                                        <td class="text-center">R$ <?php echo number_format($p['valor'],2,',','.') ?></td>
                                    </div>
                                    <div class="col-4 mobilecard-status">
                                        <td class="text-center"><?php echo $p['status'] ?></td>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Redefinir Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="form-redefinir" action="<?php echo base_url('2d7fdaba4614564489b1c83981f92672') ?>" method="post">
                <input type="hidden" name="id_redifinir" id="id_redifinir" value="<?php echo $this->session->userdata('cliente_user_id') ?>">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nova senha</label>
                        <input  type="password" class="form-control" onkeyup="senha()" name="senha_nova" id="senha_nova">
                        <label id="alert-senha" style="font-size: 14px; visibility: hidden; color: red">*A senha deve ter mais de seis caracteres!</label>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Confirmar nova senha</label>
                        <input  type="password" class="form-control" onkeyup="senha2()" name="confirma_nova" id="confirma_nova">
                        <label id="alert-senha2" style="font-size: 14px; visibility: hidden; color: red">*A senha deve ter mais de seis caracteres!</label>
                    </div>
                </div>
            </form>
      </div>
      <div>
          <label id="alert-senha3" style="font-size: 14px; visibility: hidden; color: red; position: absolute; top: 290px; left: 130px; ">*As senhas não são iguais!</label>
      </div>    
      <div class="modal-footer">
        <button style="padding: 20px; border-radius: 5px; color: white; background: #3a0b0c;" type="button" class="g-recaptcha btn btn-primary" data-sitekey="<?php echo $chave['chave_site'] ?>" data-callback='onSubmit3' data-action='submit'>Redefinir</button>
        <button style="padding: 20px; border-radius: 5px; color: white; background: #c7080c;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      
    </div>
  </div>
</div>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
    <script src='<?php echo base_url('recursos/js/material/plugins/sweetalert2.js');?>'></script>

    <script>
       function onSubmit(token) {
         document.getElementById("form-dados").submit();
       }
    </script>
     
    <script>
       function onSubmit2(token) {
            document.getElementById("form-endereco").submit();
       }
    </script>
    
    <script>
       function onSubmit3(token) {
            redefinir();
       }
    </script>
    
    

<script>
    function verpedido(id){
        var form = "<form id='form-ver-pedido' action='<?php echo base_url('f2a65f4a9e58f011ea41f053ea58053d')  ?>' method='post'>" +
        "<input type='hidden' name='id_pedido' id='id_pedido' value=' " + id + " ' >" + 
        "</form>";
        
        $('#menu_pedido').append(form);
        $('#form-ver-pedido').submit();
    }
</script>

<script>
    $(document).ready(function(){
        var url = window.location.href;
        var aux = url.split('#');
        if(aux[1] == 'endereco'){
            endereco();
            $('.card-body').css('visibility', 'visible');
        } else if(aux[1] == 'pedidos'){
            pedido();
            $('.card-body').css('visibility', 'visible');
        } else {
            dados();
            $('.card-body').css('visibility', 'visible');
        }
        $('.card-body').css('visibility', 'visible');
        
        $('.cpf').mask('000.000.000-00', {reverse: true}); 
        $('.cep').mask('00000-000');
        
        var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        
        $('.telefone').mask(SPMaskBehavior, spOptions);

        $('#genero').val('<?php echo $cliente['cliente_genero'] ?>').change();
        $('#estado').val('<?php echo $cliente['cliente_estado'] ?>').change();
            
        
        <?php if(isset($msg)) { ?>
            <?php if($msg == 1){ ?>
                Swal.fire({
                    type: 'success',
                    title: 'Dados Pessoais atualizado com sucesso!',
                })
            <?php } else if($msg == 2){ ?>
                Swal.fire({
                    type: 'success',
                    title: 'Endereço atualizado com sucesso!',
                })
            <?php } else if($msg == 3){ ?>
                Swal.fire({
                    type: 'success',
                    title: 'Senha redefinida com sucesso!',
                })
            <?php } ?>
        <?php } ?>
        
    });
</script>

<script>
    function editar(){
        $('#editar').show();
        $('#visualizar').hide();
    }
    
    function visualizar(){
        $('#editar').hide();
        $('#visualizar').show();
    }
    
</script>

<script>
    function editar_endereco(){
        $('#editar_endereco').show();
        $('#visualizar_endereco').hide();
    }
    
    function visualizar_endereco(){
        $('#editar_endereco').hide();
        $('#visualizar_endereco').show();
    }
    
</script>

<script>
    function autofillCEP(){
        var aux = $('#cep').val();
        var cep = aux.replace(/\D/g,'');
        if(cep.length == 8){
            dados = new FormData();
            dados.append('cep', cep);
            $.ajax({
                url: '<?php echo base_url('inicio/resgataCEP'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if(data != "null" && data != "" && data != " " && data != null){
                        cep = jQuery.parseJSON(data);
                        var ce = cep.cep_cidadeuf.split('/');
                        $('#cep').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#cidade').val(ce[0]);
                        $('#estado').val(ce[1]).change();
                        $('#bairro').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#endereco').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#endereco').val(rua[0]);
                        }else{
                            $('#endereco').val(cep.cep_rua);
                        }
                    }
                },
            });
        }
    }
</script>

<script>
	    function senha(){
	        var senha = $('#senha_nova').val().length;
	        
	        if(senha < 6){
	            $('#alert-senha3').css('visibility', 'hidden');
	            $('#alert-senha').css('visibility', 'visible');
	        } else {
	            $('#alert-senha3').css('visibility', 'hidden');
	            $('#alert-senha').css('visibility', 'hidden');
	        }
	    }
</script>

<script>
	    function senha2(){
	        var senha = $('#confirma_nova').val().length;
	        
	        if(senha < 6){
	            $('#alert-senha3').css('visibility', 'hidden');
	            $('#alert-senha2').css('visibility', 'visible');
	        } else {
	            $('#alert-senha3').css('visibility', 'hidden');
	            $('#alert-senha2').css('visibility', 'hidden');
	        }
	    }
</script>

<script>
    function redefinir(){
        var senha = $('#senha_nova').val().length;
        
        if($('#senha_nova').val() == $('#confirma_nova').val()){
            if(senha >= 6){
                $('#form-redefinir').submit();
            }
         }else {
             $('#alert-senha3').css('visibility', 'visible');
         }
    }    
</script>

<script>
    function dados(){
        $('#menu_dados').show();
        $('#menu_endereco').hide();
        $('#menu_pedido').hide();
        $('#li_dados').addClass('active');
        $('#i_dados').addClass('active-icon');
        $('#li_endereco').removeClass('active');
        $('#i_endereco').removeClass('active-icon');
        $('#li_pedido').removeClass('active');
        $('#i_pedido').removeClass('active-icon');
    }
    
    function endereco(){
        $('#menu_dados').hide();
        $('#menu_endereco').show();
        $('#menu_pedido').hide();
        $('#li_dados').removeClass('active');
        $('#i_dados').removeClass('active-icon');
        $('#li_endereco').addClass('active');
        $('#i_endereco').addClass('active-icon');
        $('#li_pedido').removeClass('active');
        $('#i_pedido').removeClass('active-icon');
    }
    
    function pedido(){
        $('#menu_dados').hide();
        $('#menu_endereco').hide();
        $('#menu_pedido').show();
        $('#li_dados').removeClass('active');
        $('#i_dados').removeClass('active-icon');
        $('#li_endereco').removeClass('active');
        $('#i_endereco').removeClass('active-icon');
        $('#li_pedido').addClass('active');
        $('#i_pedido').addClass('active-icon');
    }
    
    
    
</script>