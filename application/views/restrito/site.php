<style>
    .select2{
        width: 100%!important;
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
    
     
    .nav-tabs{
        background-color: white;
    }
    
    .nav-link{
        font-size: 25px;
    }
    
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Definições</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('af8889282b50f9030f8cc7a19b3f706d') ?>">Site</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2 style="color: green;"><b>Site</b></h2>
                    </div>
                </div>
            </div>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="site-tab" data-toggle="tab" href="#site" role="tab" aria-controls="site" aria-selected="true">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="textos-tab" data-toggle="tab" href="#textos" role="tab" aria-controls="textos" aria-selected="true">Textos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="true">Banners</a>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-5">
                            <form id="form" action="<?php echo base_url('589f4ef9553ca0b67ad8f1d6c02d8eef') ?>" method="post" enctype="multipart/form-data">
                            <div class="col-md-12 text-center form-group" style="margin-top: 10%">
                                <img src="<?php echo base_url() . $site['logo'] ?>" style="height: auto; width: 80%">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="button" class="btn btn-primary" style="width: 200px" onclick="trigger_logo()">Enviar nova logo</button>
                                    <input type="file" style="display: none" name="logo" id="logo" class="input-file">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-6 form-group">
                                <label><b>E-mail Contato:</b></label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $site['email'] ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label><b>Whats App:</b></label>
                                <input type="text" class="form-control" name="whats" id="whats" value="<?php echo $site['whats'] ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label><b>Telefone:</b></label>
                                <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $site['telefone'] ?>">
                            </div>
                            <div class="col-md-12 form-group">
                                <label><b>Endereço Completo:</b></label>
                                <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $site['endereco'] ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label><b>Nome empresa:</b></label>
                                <input type="text" class="form-control" name="nome_empresa" id="nome_empresa" value="<?php echo $site['nome_empresa'] ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label><b>CNPJ:</b></label>
                                <input type="text" class="cnpj form-control" name="cnpj" id="cnpj" value="<?php echo $site['cnpj'] ?>">
                            </div>
                            <div class="col-md-12 form-group">
                                <label><b>Link Facebook:</b></label>
                                <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $site['facebook'] ?>">
                            </div>
                            <div class="col-md-12 form-group">
                                <label><b>Link Instagram:</b></label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $site['instagram'] ?>">
                            </div>
                            <div class="col-md-12 form-group">
                                <label><b>Link Twitter:</b></label>
                                <input type="text" class="form-control" name="twitter" id="twitter"  value="<?php echo $site['twitter'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="tab-pane fade" id="textos" role="tabpanel" aria-labelledby="textos-tab">
                    <div class="col-md-12" style="margin-top: 3%">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label><b>Sobre a loja:</b></label>
                                <div class="editor" id="editor"><?php echo $site['sobre_loja'] ?></div>
                                <textarea name="desc" id="desc" style="display: none"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label><b>Política de entrega:</b></label>
                                <div class="editor" id="editor2"><?php echo $site['politica_entrega'] ?></div>
                                <textarea name="desc2" id="desc2" style="display: none"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label><b>Política de privacidade:</b></label>
                                <div class="editor" id="editor3"><?php echo $site['politica_privacidade'] ?></div>
                                <textarea name="desc3" id="desc3" style="display: none"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label><b>Termos e condições:</b></label>
                                <div class="editor" id="editor4"><?php echo $site['termos'] ?></div>
                                <textarea name="desc4" id="desc4" style="display: none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-12 form-group">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h5 style="color: green"><b>Carrossel 1:</b></h5>
                                </div>
                                <div class="col-md-4 form-group">
                                    <img src="<?php echo base_url() .$site['banner_principal1'] ?>" style="height: 100%; width: 100%;">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_principal1()">Enviar novo banner principal 1</button>
                                        <input type="file" style="display: none" name="banner_principal1" id="banner_principal1" class="input-file">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner1_titulo" id="banner1_titulo" type="text" value="<?php echo $site['banner1_titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner1_subtitulo" id="banner1_subtitulo" type="text" value="<?php echo $site['banner1_subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Texto do botão</label>
                                        <input name="banner1_buttonTexto" id="banner1_buttonTexto" type="text" value="<?php echo $site['banner1_buttonTexto'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Link do botão</label>
                                        <input name="banner1_buttonLink" id="banner1_buttonLink" type="text" value="<?php echo $site['banner1_buttonLink'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h5 style="color: green"><b>Carrossel 2:</b></h5>
                                </div>
                                <div class="col-md-4 form-group">
                                    <img src="<?php echo base_url() .$site['banner_principal2'] ?>" style="height: 100%; width: 100%;">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_principal2()">Enviar novo banner principal 2</button>
                                        <input type="file" style="display: none" name="banner_principal2" id="banner_principal2" class="input-file">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner2_titulo" id="banner2_titulo" type="text" value="<?php echo $site['banner2_titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner2_subtitulo" id="banner2_subtitulo" type="text" value="<?php echo $site['banner2_subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Texto do botão</label>
                                        <input name="banner2_buttonTexto" id="banner2_buttonTexto" type="text" value="<?php echo $site['banner2_buttonTexto'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Link do botão</label>
                                        <input name="banner2_buttonLink" id="banner2_buttonLink" type="text" value="<?php echo $site['banner2_buttonLink'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h5 style="color: green"><b>Carrossel 3:</b></h5>
                                </div>
                                <div class="col-md-4 form-group">
                                    <img src="<?php echo base_url() .$site['banner_principal3'] ?>" style="height: 100%; width: 100%;">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_principal3()">Enviar novo banner principal 3</button>
                                        <input type="file" style="display: none" name="banner_principal3" id="banner_principal3" class="input-file">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner3_titulo" id="banner3_titulo" type="text" value="<?php echo $site['banner3_titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner3_subtitulo" id="banner3_subtitulo" type="text" value="<?php echo $site['banner3_subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Texto do botão</label>
                                        <input name="banner3_buttonTexto" id="banner3_buttonTexto" type="text" value="<?php echo $site['banner3_buttonTexto'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Link do botão</label>
                                        <input name="banner3_buttonLink" id="banner3_buttonLink" type="text" value="<?php echo $site['banner3_buttonLink'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h5 style="color: green"><b>Carrossel 4:</b></h5>
                                </div>
                                <div class="col-md-4 form-group">
                                    <img src="<?php echo base_url() .$site['banner_principal4'] ?>" style="height: 100%; width: 100%;">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_principal4()">Enviar novo banner principal 4</button>
                                        <input type="file" style="display: none" name="banner_principal4" id="banner_principal4" class="input-file">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner4_titulo" id="banner4_titulo" type="text" value="<?php echo $site['banner4_titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner4_subtitulo" id="banner4_subtitulo" type="text" value="<?php echo $site['banner4_subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="col-md-12 form-group">
                                        <label>Texto do botão</label>
                                        <input name="banner4_buttonTexto" id="banner4_buttonTexto" type="text" value="<?php echo $site['banner4_buttonTexto'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Link do botão</label>
                                        <input name="banner4_buttonLink" id="banner4_buttonLink" type="text" value="<?php echo $site['banner4_buttonLink'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="row form-group">
                                <div class="col-md-12">
                                    <h5 style="color: green"><b>Mini banners retangulares:</b></h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <img src="<?php echo base_url() .$site['banner_retangular1'] ?>" style="height: 150px; width: auto">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_retangular1()">Enviar novo banner retangular 1</button>
                                        <input type="file" style="display: none" name="banner_retangular1" id="banner_retangular1" class="input-file">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner_retangular1Titulo" id="banner_retangular1Titulo" type="text" value="<?php echo $site['banner_retangular1Titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner_retangular1Subtitulo" id="banner_retangular1Subtitulo" type="text" value="<?php echo $site['banner_retangular1Subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <img src="<?php echo base_url() . $site['banner_retangular2'] ?>" style="height: 150px; width: auto">
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="trigger_retangular2()">Enviar novo banner retangular 2</button>
                                        <input type="file" style="display: none" name="banner_retangular2" id="banner_retangular2" class="input-file">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Título</label>
                                        <input name="banner_retangular2Titulo" id="banner_retangular2Titulo" type="text" value="<?php echo $site['banner_retangular2Titulo'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subtítulo</label>
                                        <input name="banner_retangular2Subtitulo" id="banner_retangular2Subtitulo" type="text" value="<?php echo $site['banner_retangular1Subtitulo'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div> -->
                            
                            
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 form-group">
                                <img src="<?php echo base_url() . $site['banner_contato'] ?>" style="height: 150px; width: auto">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="button" class="btn btn-primary" onclick="trigger_contato()">Enviar novo banner contato</button>
                                    <input type="file" style="display: none" name="banner_contato" id="banner_contato" class="input-file">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="col-md-12 text-right">
                        <a href="<?php echo base_url('106a6c241b8797f52e1e77317b96a201') ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        <button type="submit" class="btn btn-primary">Gravar</button>
                    </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </section>
</section>

<style>
    .ql-snow .ql-picker.ql-size .ql-picker-label::before { content: attr(data-value)!important; }
    .ql-snow .ql-picker.ql-size .ql-picker-item::before { font-size: attr(data-value)!important; content: attr(data-value)!important; }
    .ql-picker-label .custom-content::before { content: attr(data-value)!important; }
    .editor{
        min-height: 300px;
    }
</style>


<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

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
    
    var quill2 = new Quill('#editor2', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    var quill3 = new Quill('#editor3', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    var quill4 = new Quill('#editor4', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    $('.ql-picker-item').click(function(){
        $('.ql-picker-label').addClass('custom-content').attr('data-content', $(this).data('value'));
    });
</script>

<script>
    $('#form').submit(function(e){
        
       
        let desc = $("#editor .ql-editor").html().replace('<span class="ql-cursor">﻿</span>', '');
        let desc2 = $("#editor2 .ql-editor").html().replace('<span class="ql-cursor">﻿</span>', '');
        let desc3 = $("#editor3 .ql-editor").html().replace('<span class="ql-cursor">﻿</span>', '');
        let desc4 = $("#editor4 .ql-editor").html().replace('<span class="ql-cursor">﻿</span>', '');
        
        console.log(desc);
        console.log('---');
        console.log(desc2);
        console.log('---');
        console.log(desc3);
        console.log('---');
        console.log(desc4);
        
       
        $('#desc').html(desc);
        $('#desc2').html(desc2);
        $('#desc3').html(desc3);
        $('#desc4').html(desc4);
    });
</script>



<script>
    function trigger_logo(){
        $('#logo').click();
    }
    function trigger_principal1(){
        $('#banner_principal1').click();
    }
    function trigger_principal2(){
        $('#banner_principal2').click();
    }
    function trigger_principal3(){
        $('#banner_principal3').click();
    }
    function trigger_principal4(){
        $('#banner_principal4').click();
    }
    function trigger_retangular1(){
        $('#banner_retangular1').click();
    }
    function trigger_retangular2(){
        $('#banner_retangular2').click();
    }
    function trigger_contato(){
        $('#banner_contato').click();
    }
</script>

<script>
    $(document).ready(function(){
        $('#site-tab').click();
        
        $('.ql-picker-item').each( function(){
            if($(this).data('value') == "14px"){
                $(this).click();
            }
        });
        
        
        var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        
        spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('#whats').mask(SPMaskBehavior, spOptions);
        $('#telefone').mask(SPMaskBehavior, spOptions);
        
        <?php if(isset($msg)){ ?>
        /* start - SweetAlert2 js */
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
            title: 'Site Atualizado com Sucesso!'
        })
        /* end - SweetAlert2 js */
        <?php } ?>
    });
    
    

</script>