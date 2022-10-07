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
    .nome-form{
        color: black;
        font-size: 16px;
    }
    .nav-tabs {
        background: transparent;
    }
    .nav-tabs {
        border-bottom: 1px transparent;
    }
    .nav-item{
        color: #555;
        cursor: default;
        border-radius: 4px 4px 0 0;
        background-color: #dedede;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
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
    
    .tab-li a{
        cursor: pointer;
    }
    
    .label-imagem{
        margin-top: 10px;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Financeiro</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('4f713efdd5a702bb7c0bf2608f3a6a72') ?>">Solicitações</a></li>
                <li class="breadcrumb-item" aria-current="page">Visualizar</li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Visualizar Solicitacão</b></h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo base_url('4f713efdd5a702bb7c0bf2608f3a6a72') ?>"><i style="margin-top: 10px; border: 1px solid #1b9045; padding: 7px; border-radius: 5px; background-color: #1b9045; font-size: 17px; color: white" class="fa fa-reply" aria-hidden="true">VOLTAR</i></a>
                    </div>
                </div>
            </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label><b>Tipo:</b></label>
                                        <select class="form-control" id="tipo" name="tipo" disabled>
                                            <option value="Agranel">CACHAÇA AGRANEL</option>
                                            <option value="Atacado">VENDA ATACADO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label><b>Nome:</b></label>
                                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo mb_strtoupper($solicitacao['solicitacao_nome']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Telefone:</b></label>
                                        <input type="text" class="telefone form-control" id="telefone" name="telefone" value="<?php echo $solicitacao['solicitacao_telefone'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>CEP:</b></label>
                                        <input type="text" id="cep" onkeyup="autofillCEP()" class="cep form-control" value="<?php echo $solicitacao['solicitacao_cep'] ?>" name="cep" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Rua:</b></label>
                                        <input type="text" id="rua" class="form-control" name="rua" value="<?php echo mb_strtoupper($solicitacao['solicitacao_rua']) ?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Complemento:</b></label>
                                        <input type="text" id="complemento" class="form-control" name="complemento" value="<?php echo mb_strtoupper($solicitacao['solicitacao_complemento']) ?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Número:</b></label>
                                        <input type="text" id="numero" class="form-control" name="numero" value="<?php echo $solicitacao['solicitacao_numero'] ?>" readonly>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label><b>Bairro:</b></label>
                                        <input type="text" id="bairro" class="form-control" name="bairro" value="<?php echo mb_strtoupper($solicitacao['solicitacao_bairro']) ?>" readonly>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><b>Cidade:</b></label>
                                        <input type="text" id="cidade" class="form-control" name="cidade" value="<?php echo mb_strtoupper($solicitacao['solicitacao_cidade']) ?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label><b>Estado:</b></label>
                                        <input type="text" id="estado" class="form-control" name="estado" value="<?php echo mb_strtoupper($solicitacao['solicitacao_estado']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Empresa:</b></label>
                                        <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo mb_strtoupper($solicitacao['solicitacao_empresa']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>CNPJ:</b></label>
                                        <input type="text" class="cnpj form-control" id="cnpj" name="cnpj" value="<?php echo $solicitacao['solicitacao_cnpj'] ?>" readonly>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label><b>Mensagem:</b></label>
                                        <textarea type="text" class="form-control" id="mensagem" name="mensagem" readonly><?php echo mb_strtoupper($solicitacao['solicitacao_mensagem']) ?></textarea>
                                    </div>
                                    <?php if(isset($andamento)) { ?>
                                    <?php if($andamento != null) { ?>
                                    <div class="col-md-12 form-group" id="historico">
                                        <hr style="height: 1px; border-color: lightgrey">
                                        <label style="font-size: 16px;"><b>HISTÓRICO:</b></label>
                                        <?php foreach($andamento as $a) { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12 form-group" style="border: 1px solid lightgrey; padding: 10px; border-radius: 5px">
                                                        <div class="col-md-4 form-group">
                                                            <label><b>Data Hora:</b></label>
                                                            <p><?php echo $a['andamento_datahora'] ?></p>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label><b>Tipo:</b></label>
                                                            <p><?php echo $solicitacao['solicitacao_tipo'] ?></p>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label><b>Status:</b></label>
                                                            <p><?php echo $a['andamento_status'] ?></p>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label><b>Mensagem:</b></label>
                                                            <textarea onkeyup="editar(<?php echo $a['andamento_id'] ?>)" id="m_<?php echo $a['andamento_id'] ?>" type="text" class="form-control" readonly><?php echo $a['andamento_mensagem'] ?></textarea>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <button type="button" onclick="excluir(<?php echo $a['andamento_id'] ?>)" class="btn btn-primary">Excluir</button>
                                                            <button type="button" onclick="edita_msg(<?php echo $a['andamento_id'] ?>)" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } } ?>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</section>


<script type="application/javascript">
    $(document).ready(function(){
        $('.number').mask('0#');
        $('.money').mask("#.##0,00", {reverse: true});

    });
</script>

<script type="application/javascript">
    function edita_msg(id){
        if($('#m_' + id).prop('readonly') == true){
            $('#m_' + id).prop('readonly', false);
        } else {
            $('#m_' + id).prop('readonly', true);
        }
    }
    
</script>

<script type="application/javascript">
    function editar(valor){
        var text = $('#m_' + valor).val();
        dados = new FormData();
        dados.append('id', valor);
        dados.append('mensagem', text);
        $.ajax({
            url: '<?php echo base_url('80b17ffc2444700fd3e88e2a9977f363'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
            }
        });
    }
</script>

<script type="application/javascript">
    function excluir(valor){
        dados = new FormData();
        dados.append('id', valor);
        $.ajax({
            url: '<?php echo base_url('f0b3583ebed98fb4200fc356cd2521ee'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                location.reload();
            }
        });
    }
</script>
