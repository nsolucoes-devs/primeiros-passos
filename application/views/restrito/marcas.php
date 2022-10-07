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
        height: 400px;
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
        border-bottom: 2px solid grey;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('edb728d5b2d758ff44b1b0e9f991ead9') ?>">Marcas</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Marcas</b></h2>
                    </div>
                    <form action="<?php echo base_url('edb728d5b2d758ff44b1b0e9f991ead9') ?>" method="post">
                    <div class="col-md-6">
                        <div class="button-area">
                            <button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item" data-toggle="modal" data-target="#marca_adicionarmodal"><em class="fa fa-plus"></em></button></a>
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
                            <th style="width: 55%">Nome</th>
                            <th style="width: 30%">Status</th>
			                <th class="text-center" style="width: 15%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($marcas as $m){ ?>
                        <tr>
                            <td><?php echo ucwords(mb_strtolower($m['marca_nome'])); ?></td>
                            <td><?php if ($m['marca_ativo'] == 1){
                               $status = 'Ativo';
                            }else{
                               $status = 'Inativo';
                               } 
                               echo $status;?></td>
                            <td style="color: #1b9045; font-size: 22px!important" class="text-center">
			                    <a onclick="verMarca(<?php echo $m['marca_id']; ?>, '<?php echo $m['marca_nome']; ?>', <?php echo $m['marca_ativo']; ?>)"style="color: #1b9045;" data-toggle="modal" data-target="#marca_vermodal"><i class="fa fa-eye" aria-hidden="true"></i></a>
			                    <a onclick="editarMarca(<?php echo $m['marca_id']; ?>, '<?php echo $m['marca_nome']; ?>', <?php echo $m['marca_ativo']; ?>)" style="color: #1b9045;" data-toggle="modal" data-target="#marca_editarmodal"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
			                    <i onclick="excluirMarca(<?php echo $m['marca_id']; ?>)" data-toggle="modal" data-target="#marca_excluirmodal" style="padding-left: 12px; color: #1b9045" class="fa fa-trash" aria-hidden="true"></i>
    			            </td>
			            </tr>   
			            <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php if($marcas == null) { ?>
    		        <div class="col-md-12 text-center">
    		            <p>Nenhuma marca encontrada!</p>
    		        </div>
		        <?php } ?>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="pagination-links"><?php echo $links; ?></p>
                    </div>
                </div>
            <?php if(isset($produtos)){ ?>
                <?php if($produtos == null) { ?>
    		        <div class="col-md-12 text-center">
    		            <p>Nenhuma marca encontrada!</p>
    		        </div>
    		    <?php } ?>
		    <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <!--<p class="pagination-links"><?php echo $links; ?></p>-->
                </div>
            </div>
        </div>
    </section>
</section>

<!-- excluir -->

<div class="modal" tabindex="-1" role="dialog" id="marca_excluirmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('60bc50a31cf5ef5e4837884a774f1a91') ?>" method="post">
          <input type="hidden" id="id_excluir" name="id_excluir">
          <input type="hidden" id="prod_marca_id" name="prod_marca_id">
          <div class="modal-body">
              <p style="font-size: 17px;"><b> Deseja excluir a marca? </b><p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- adicionar -->

<div class="modal fade" id="marca_adicionarmodal" tabindex="-1" role="dialog" aria-labelledby="marca_adicionarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">ADICIONAR MARCA</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('d0dd4c29ef31ad2e1bb9f1592fc5c832') ?>" method="post">
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da marca: </b></label>
                        <input type="text" id="adicionarNome" name="adicionarNome" class="form-control" value="" required>
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-4 form-group">
                        <label><b>Ativo: </b></label>
                        <select name="adicionarAtivo" id="adicionarAtivo" class="js-example-basic-multiple" required>
                          <option value="" selected disabled> Selecione </option>    
                          <option value="1">Ativo</option>
                          <option value="0">Inativo</option>
                        </select>
                     </div>    
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- editar -->

<div class="modal fade" id="marca_editarmodal" tabindex="-1" role="dialog" aria-labelledby="marca_editarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">EDITAR MARCA</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('0981d247abe57675f6a0d59eca98c7c3') ?>" method="post">
          <input type="hidden" id="id_editar" name="id_editar">
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da marca: </b></label>
                        <input type="text" id="editarNome" name="editarNome" class="form-control">
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-4 form-group">
                        <label><b>Ativo: </b></label>
                        <select name="editarAtivo" id="editarAtivo" class="js-example-basic-multiple">
                          <option value="" selected disabled> Selecione </option>    
                          <option value="1">Ativo</option>
                          <option value="0">Inativo</option>
                        </select>
                     </div>    
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- ver -->

<div class="modal fade" id="marca_vermodal" tabindex="-1" role="dialog" aria-labelledby="marca_vermodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">MARCA</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('bff5d96a6b38ee4527917f7183915405') ?>" method="post">
          <input type="hidden" id="id_ver" name="id_ver" readonly>
          <div class="modal-body">
                 <div class="row">
                     <div class="col-md-12 form-group">
                        <label><b>Nome da marca: </b></label>
                        <input type="text" id="verNome" name="verNome" class="form-control" readonly>
                     </div>    
                 </div>
                 <div class="row">
                     <div class="col-md-4 form-group">
                        <label><b>Ativo: </b></label>
                        <select name="verAtivo" id="verAtivo" class="js-example-basic-multiple" disabled>
                          <option value="" selected disabled> Selecione </option>    
                          <option value="1">Ativo</option>
                          <option value="0">Inativo</option>
                        </select>
                     </div>    
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

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
                    title: 'Marca criada com sucesso!'
                })
            <?php } elseif($alert == 2) { ?>
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
                    title: 'Marca editada com sucesso!'
                })
            <?php } elseif($alert == 3) { ?>
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
                    title: 'Marca excluída com sucesso!'
                })
            <?php } elseif($alert == 4) { ?>
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
                    title: 'Não foi possível excluir a marca, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                })
            <?php } } 
            
            if(isset($produtosmarca)) { ?>
                const Toast2 = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast2.fire({
                    icon: 'error',
                    title: 'Não é possível excluir marca com produto(s) relacionado(s): <br><?php echo $produtosmarca; ?>', 
                })
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

<script>
    function editarMarca(id, nome, ativo){
        $('#id_editar').val(id);
        $('#editarNome').val(nome);
        $('#editarAtivo').val(ativo).change();
    }
    
    function verMarca(id, nome, ativo){
        $('#id_ver').val(id);
        $('#verNome').val(nome);
        $('#verAtivo').val(ativo).change();
    }
</script>

<script>
    function excluirMarca(id, produto_marca_id){
        $('#id_excluir').val(id);
        $('#prod_marca_id').val(produto_marca_id)
    }
</script>