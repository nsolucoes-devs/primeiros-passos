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
    path[fill='#123456']{display:none !important;}
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
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
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
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
        border-radius: 5px;
    }
    .def-item{
        display: block;
        padding: 7px 10px;
        color: black;
        font-size: 14px;
    }
    .def-item:hover{
        background-color: #eee;
        color: #9c27b0;
    }
    
    .select2{
        width: 100%!important;
    }
    
    .check{
        min-width: 20px;
        min-height: 20px;
    }
    
    .pagination-links a{
        color: #1b9045;
        text-decoration: none;
        padding: 5px;
        font-size: 20px;
        margin: 2px;
    }
    
    .pagination-links strong{
        padding-bottom: 2px!important;
        padding: 6px;
        font-size: 20px;
        border-bottom: 2px solid #1b9045;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Financeiro</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('4f713efdd5a702bb7c0bf2608f3a6a72') ?>">Solicitações</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Solitações</b></h2>
                    </div>
                    <form action="<?php echo base_url('4f713efdd5a702bb7c0bf2608f3a6a72') ?>" method="post">
                        <div class="col-md-6">
                            <div class="button-area">
                                <div class="search-field">
                                    <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                    <button type="submit" style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="c-card-body" style="display: block">
                <div class="table-responsive" style="width: 100%">
                    <table class="table c-table" id="tabela">
                        <thead>
                            <tr>
                                <th class="text-center" style='width: 5%'>Nº Solicitação</th>
                                <th style='width: 30%'>Nome</th>
                                <th style='width: 12%'>Empresa</th>
                                <th style='width: 14%'>CNPJ</th>
                                <th style='width: 7%'>Status</th>
                                <th style='width: 7%'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($solicitacoes as $s){ ?>
                                <tr class="tr-check">
                                    <td class="text-center"><?php echo $s['solicitacao_id'] ?></td>
                                    <td><?php echo mb_strtoupper($s['solicitacao_nome']) ?></td>
                                    <td><?php echo mb_strtoupper($s['solicitacao_empresa']) ?></td>
                                    <td class="cnpj"><?php echo $s['solicitacao_cnpj'] ?></td>
                                    <td><?php if($s['solicitacao_status'] == 1) { ?>
                                            ABERTA
                                        <?php } else if($s['solicitacao_status'] == 2) { ?>
                                            ANDAMENTO
                                        <?php } else { ?>
                                            CONCLUÍDA
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a style="color: #1b9045;" href="<?php echo base_url('fa1771910ec4230a88dcdcc0dee9d913/' . $s['solicitacao_id'])  ?>"><i style="#1b9045; font-size: 25px; padding-right: 10px" class="fa fa-eye" aria-hidden="true"></i></a>
                                        <i onclick="status(<?php echo $s['solicitacao_id'] ?>, '<?php echo $s['solicitacao_status'] ?>')" style="color: #1b9045;font-size: 25px" class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($solicitacoes == null) { ?>
		        <div class="col-md-12 text-center">
		            <p>Nenhuma solicitação encontrada!</p>
		        </div>
		    <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="pagination-links"><?php echo $links; ?></p>
                </div>
            </div>
        </div>
        <br>
    </section>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h5 class="modal-title" style="display: inline" id="exampleModalLabel">Lançamento de Status</h5>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('6edd34b83db678aa99c4e312f70ee82d') ?>" method="post">
              <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label style="color: black;"><b>Andamento:</b></label>
                        <textarea class="form-control" name="andamento" id="andamento"></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label style="color: black;"><b>Status:</b></label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">Aberta</option>
                            <option value="2">Andamento</option>
                            <option value="3">Concluída</option>
                        </select>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Alterar</button>
            </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




<script>
    function status(id, valor){
        $('#id').val(id);
        $('#status').val(valor).change();
    }
</script>

<script>
    $(document).ready(function(){
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true}); 
    });
    
</script>
