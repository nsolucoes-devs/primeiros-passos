    <style>
        .nome-form{
            color: black;
            font-size: 16px;
        }
    </style>
   
    <section id="main-content">
        <section class="wrapper">
            <?php if($error != null){ ?>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">Erro: Ocorreu um erro ao fazer upload do seu arquivo!</h3>
                </div>
            </div>
            <br>
            <?php } ?>
            <?php if($success != null){ ?>
            <hr style="height: 1px; background-color: lightgrey; border: none;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-success">Configurações atualizadas com sucesso!</h3>
                </div>
            </div>
            <br>
            <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES HOME</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('3a62a82a413690cf4bf5ab893f66892b') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Link do Banner 1:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $confighome['titulo1'] ?>"><br>
                                <label class="nome-form">Link do Banner 2:</label><br>
                                <input type="text" id="sub1" name="sub1" class="form-control" value="<?php echo $confighome['subtitulo1'] ?>"><br>
                                <label class="nome-form">Link do Banner 3:</label><br>
                                <input type="text" id="sub2" name="sub2" class="form-control" value="<?php echo $confighome['subtitulo2'] ?>"><br>
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner 1:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <img class="img-responsive" src="<?php echo base_url() . $confighome['banner'] ?>">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner 2:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner2" name="banner2" style="display: inline"><br><br>
                                <img class="img-responsive" src="<?php echo base_url() . $confighome['banner2'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner 3:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner3" name="banner3" style="display: inline"><br><br>
                                <img class="img-responsive" src="<?php echo base_url() . $confighome['banner3'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES TERMOS</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('7c867ac7903feef6f54ab548fd05c5be') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <label class="nome-form">Título:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $configtermo['titulo1'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner Atual:&nbsp&nbsp</label>
                                <img class="img-responsive" src="<?php echo base_url() . $configtermo['banner'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES REGULAMENTOS</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('edd3533abd293c045227d85ccd1aca2d') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <label class="nome-form">Título:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $configreg['titulo1'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner Atual:&nbsp&nbsp</label>
                                <img class="img-responsive" src="<?php echo base_url() . $configreg['banner'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES RESULTADOS</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('13c70b817967f1ab8948c3dca01b265e') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <label class="nome-form">Título:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $configres['titulo1'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner Atual:&nbsp&nbsp</label>
                                <img class="img-responsive" src="<?php echo base_url() . $configres['banner'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <br><br>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES CONTATO</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('9b7cfa2f9b230772deba0c28a3087093') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <label class="nome-form">Título:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $configcon['titulo1'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner Atual:&nbsp&nbsp</label>
                                <img class="img-responsive" src="<?php echo base_url() . $configcon['banner'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <br><br>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><b>CONFIGURAÇÕES PRIVACIDADE</b></h2>
                </div>
            </div>
            <br>
            <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                <br>
                <div class="col-md-12" style="margin-bottom: 15px">
                    <form method="post" action="<?php echo base_url('3ece711cfa565285c2184900ee025656') ?>" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="nome-form">Banner:&nbsp&nbsp</label>
                                <input type="file" accept="image/*" id="banner" name="banner" style="display: inline"><br><br>
                                <label class="nome-form">Título:</label><br>
                                <input type="text" id="tit1" name="tit1" class="form-control" value="<?php echo $configpri['titulo1'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="nome-form">Banner Atual:&nbsp&nbsp</label>
                                <img class="img-responsive" src="<?php echo base_url() . $configpri['banner'] ?>">
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; background-color: lightgrey; border: none;">
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #4ECDC4; border: 1px solid #4ECDC4" value="Submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
        </section>
    </section>