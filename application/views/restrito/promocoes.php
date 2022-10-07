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
    
    .c-aprovados{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(76 175 80 / 40%);
        background: linear-gradient(60deg, #66bb6a, #43a047);
    }
    
    .c-negadas{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(244 67 54 / 40%);
        background: linear-gradient(60deg, #ef5350, #e53935);
    }
    
    .c-titulos{
        box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 188 212 / 40%);
            background: linear-gradient(60deg, #26c6da, #00acc1);
    }
    
    .c-tabela{
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
    }
    
    .c-icon{
        font-size: 33px;
        line-height: 40px;
        width: 40px;
        height: 40px;
        text-align: center;
    }
    
    .c-card-category{
        color: black;
        font-size: 14px;
        margin: 0;
        padding-top: 10px;
        font-weight: bold;
    }
    
    .c-card-title{
        margin: 0;
        color: #3C4858;
        font-size: 1.5625rem;
        line-height: 1.4em;
    }
    
    .c-card-title small{
        font-size: 80%;
        font-weight: 400;
    }
    
    .c-card-footer{
        border-top: 1px solid #d6d5d5;
        margin-top: 20px;
        padding: 0;
        padding-top: 10px;
        margin: 0 15px 10px;
        border-radius: 0;
        justify-content: flex-end;
        align-items: center;
        display: flex;
        background-color: transparent;
    }
    
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    
    .c-stats{
        color: #999999;
        font-size: 12px;
        line-height: 22px;
        display: inline-flex;
    }
    
    .c-stats-icon{
        position: relative;
        top: 4px;
        font-size: 16px;
        margin-right: 3px;
        margin-left: 3px;
        color: grey;
    }
    
    .c-stats-text{
        color: grey;
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
    
    .check-all{
        width: 32px;
        font-size: 12px;
        color: white;
        background-color: #9c27b0;
        border: 0;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
    }
    
    .button-area{
        margin-top: 20px;
    }
    
    .button-custom{
        color: white;
        background-color: #9c27b0;
        border: 0;
        font-size: 14px;
        padding: 6px 10px;
        text-align: center;
        border-radius: 5px;
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
        width: 200px;
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
    }
    
    .def-item{
        display: block;
        padding: 7px 10px;
        color: black;
        font-size: 14px;
    }
    
    .check{
        min-width: 20px;
        min-height: 20px;
    }
    
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
        cursor: pointer;
    }
    
    .force-hide{
        display: none!important;
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
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 1px solid grey;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>">Promoções</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Promoções</b></h2>
                    </div>
                    <form action="<?php echo base_url('0216886b85e598a495cf53b303ec5b54') ?>" method="post">
                    <div class="col-md-6">
                        <div class="button-area">
                            <a href="<?php echo base_url('145a0c89d550bcc27a88e1e4936643f0') ?>"><button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item"><em class="fa fa-plus"></em></button></a>
                            <div class="search-field">
                                <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="c-card-body">
                <div class="table-responsive" style="width: 100%">
                    <table class="table c-table" id="tabela">
                    <thead>
                        <tr>
                            <th style="width: 30%">Título</th>
                            <th style="width: 10%">Data inicial</th>
			                <th style="width: 10%">Data final</th>
			                <th style="width: 10%">Preço</th>
			                <th style="width: 10%">Desconto</th>
			                <th class="text-center" style="width: 20%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($promocoes as $p){ ?>
                            <tr>
                                <td><?php echo ucwords(mb_strtolower($p['promocao_titulo'])) ?></td>
                                <td><?php echo date('d/m/Y', strtotime($p['promocao_datainicial'])) ?></td>
                                <td><?php echo date('d/m/Y', strtotime($p['promocao_datafinal'])) ?></td>
                                <td>R$ <?php echo number_format($p['promocao_preco'],2,',','.') ?></td>
                                <td><?php echo $p['promocao_desconto'] ?>%</td>
                                <td style="color: #1b9045; font-size: 22px!important" class="text-center">
        			                <a style="color: #1b9045;" href="<?php echo base_url('92e663417c2391cb8a2f5e5404c844c2/'). $p['promocao_id']  ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
        			                <a style="color: #1b9045;" href="<?php echo base_url('4f86debc5509c7e3eaf5098120ce00b7/'). $p['promocao_id']   ?>"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
        			                <i onclick="excluirpromocao(<?php echo $p['promocao_id'] ?>)" data-toggle="modal" data-target="#statusModal" style="padding-left: 12px; color: #1b9045" class="fa fa-trash" aria-hidden="true"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php if(isset($promocoes)){ ?>
                <?php if($promocoes == null) { ?>
    		        <div class="col-md-12 text-center">
    		            <p>Nenhuma promoção encontrada!</p>
    		        </div>
    		    <?php } ?>
		    <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="pagination-links"><?php echo $links; ?></p>
                </div>
            </div>
        </div>
    </section>
</section>
<div class="modal" tabindex="-1" role="dialog" id="statusModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b> Deseja excluir o promoção? </b><p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="senha()">Excluir</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <div class="row row-c" id="formsenha" style="display: none">
            <div class="col-md-12 text-center">
                <form action="<?php echo base_url('ea4a2bfdbaf337bd327dec1c477b9e02') ?>" method="post">
                    
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

<script>
    function excluirpromocao(id){
        $('#id').val(id);
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
    $(document).ready(function(){
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
                    title: 'Promoção criada com sucesso!'
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
                    title: 'Promoção editada com sucesso!'
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
                    title: 'Promoção excluída com sucesso!'
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
                    title: 'Não foi possível excluir a promoção, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php } ?>
        <?php } ?>
        
        
    });
</script>

<script>
    function showForm(){
        document.getElementById('btnconfirmacao').style.display = "none";
        document.getElementById('formsenha').style.display = "block";
        document.getElementById('footermodal').style.display = "block";
    }
    
    function verSenha(){
        var senha = document.getElementById('senha').value;
        dados = new FormData();
        dados.append('senha', senha);
        $.ajax({
            url: '<?php echo base_url('444b70aa51ba969ce31c8fc0e2d4066a'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
            },
            success: function(data) {
                if(data == 1){
                    $('#form').submit();
                }else{
                    document.getElementById('diverro').style.display = "block";
                }
            },
        }); 
    }
    
    function setaCancelar(id){
        document.getElementById('idsorteio').value = id;
    }
</script>