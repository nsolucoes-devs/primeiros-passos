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
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/adminfuncionarios/listaFuncionarios') ?>">Funcionarios</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Funcionários</b></h2>
                    </div>
                    <form action="<?php echo base_url('admin/adminfuncionarios/listaFuncionarios') ?>" method="post">
                    <div class="col-md-6">
                        <div class="button-area">
                            <button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Funcionário" onclick="addFuncionario()"><em class="fa fa-plus"></em></button></a>
                            <div class="search-field">
                                <input type="text" id="filtro" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="c-card-body">
                <div class="table-responsive" style="width: 100%;">
                    <table class="table c-table" id="tabela">
                        <thead>
                            <tr>
                                <th style="width: 21%">Nome</th>
                                <th style="text-align: center;width: 7%">CPF</th>
                                <th style="text-align: center;width: 20%">Loja</th>
                                <th style="text-align: center;width: 10%">Comissão</th>
    			                <th class="text-center" style="width: 12%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($funcionarios as $f){ ?>
                                <tr>
                                    <td> <?php echo strtoupper($f['nome_funcionario']) ?> </td>
                                    <td style="text-align: center;" id="cad-cpf" name="cad-cpf"> <?php echo $f['cpf_funcionario'] ?> </td>
                                     <?php foreach($lojas as $l){ 
                                        if($f['loja_id'] == $l['id']) { ?>
                                            <td style="text-align: center;"> <?php echo $l['nome'] ?> </td>
                                        <?php } ?> 
                                    <?php } ?> 
                                    <?php if($f['loja_id'] == 0) { ?>
                                            <td style="text-align: center;"> Não encontrado </td>
                                    <?php } ?> 
                                    <td style="text-align: center;"><?php echo number_format($f['comissao_funcionario'], 1, ',','.')?>%</td>
                                    <td style="color: #1b9045; font-size: 22px!important" class="text-center">
        			                    <a onclick="seeFuncionario(<?php echo $f['id_funcionario'] ?>)" style="color: #1b9045;"><i class="fa fa-eye" aria-hidden="true"></i></a>
        			                    <a onclick="editFuncionario(<?php echo $f['id_funcionario'] ?>)" style="color: #1b9045;"><i style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i></a>
        			                    <i onclick="delFuncionario(<?php echo $f['id_funcionario'] ?>)"style="padding-left: 12px; color: #1b9045" class="fa fa-trash" aria-hidden="true"></i>
            			            </td>
        			            </tr>
    			            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
                <?php if($funcionarios == null) { ?>
    		        <div class="col-md-12 text-center">
    		            <p>Nenhum funcionario encontrada!</p>
    		        </div>
		        <?php } ?>
                <!--<div class="row">-->
                <!--    <div class="col-md-12 text-center">-->
                <!--        <p class="pagination-links"><?php echo $links; ?></p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="row">-->
                <!--    <div class="col-md-12 text-center">-->
                <!--        <p class="pagination-links"><?php echo $links; ?></p>-->
                <!--    </div>-->
                <!--</div>-->
        </div>
    </section>
</section>

<!-- excluir -->
<div class="modal" tabindex="-1" role="dialog" id="vendedor_excluirmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminfuncionarios/excluirfuncionario') ?>" method="post">
          <input type="hidden" id="id_excluir" name="id_excluir">
          <input type="hidden" id="prod_vendedor_id" name="prod_vendedor_id">
          <div class="modal-body">
              <p style="font-size: 17px;"><b> Deseja excluir a funcionário? </b><p>
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
<div class="modal fade" id="vendedor_adicionarmodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_adicionarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 114%; position: relative; left: -9%; bottom: -118px;">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">ADICIONAR FUNCIONÁRIO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminfuncionarios/insertfuncionarios') ?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 form-group">
                       <label><b>Nome completo: </b></label>
                       <input type="text" id="cad-nome" name="cad-nome" class="form-control" value="" required>
                    </div>
                    <div class="col-md-3 form-group">
                       <label><b>CPF: </b></label>
                       <input type="text" id="cad-cpf" name="cad-cpf" class="form-control" value="" required>
                    </div> 
                </div>
                <div class="row">
                     <div class="col-md-3 form-group">
                       <label><b>CEP: </b></label>
                       <input onkeyup="autofillCEP()" type="text" id="cad-cep" name="cad-cep" class="telefone form-control" value="" required>
                    </div>  
                    <div class="col-md-5 form-group">
                       <label><b>Cidade: </b></label>
                       <input type="text" id="cad-cidade" name="cad-cidade" class="form-control" required>
                    </div> 
                    <div class="col-md-4 form-group">
                       <label><b>Estado:</b></label>
                            <select id="cad-estado" name="cad-estado" class="form-control" required>
                                <option value="" selected disabled>-- Selecione --</option>
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
                    <div class="col-md-8 form-group">
                       <label><b>Loja: </b></label>
                           <select id="cad-lojas" name="cad-lojas" class="form-control">
                               <option selected disabled> -- Selecione -- </option>
                               <?php foreach($lojas as $l){ ?>
                                    <option value="<?php echo $l['id'] ?>"><?php echo $l['nome'] ?></option>
                               <?php } ?>
                           </select>
                    </div>  
                    <div class="col-md-4 form-group">
                       <label><b>Comissão: </b></label>
                       <input type="text" id="cad-comissao" name="cad-comissao" class="form-control" required>
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
<div class="modal fade" id="vendedor_editarmodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_editarmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">EDITAR VENDEDOR</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminfuncionarios/editfuncionarios') ?>" method="post">
          <input type="hidden" id="id_editar" name="id_editar">
          
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 form-group">
                       <label><b>Nome completo: </b></label>
                       <input type="text" id="nome-edit" name="nome-edit" class="form-control" value="" required>
                    </div> 
                    <div class="col-md-3 form-group">
                       <label><b>CPF: </b></label>
                       <input type="text" id="cpf-edit" name="cpf-edit" class="form-control" value="" required>
                    </div> 
                </div>
                <div class="row">
                    <!-- <div class="col-md-3 form-group">
                       <label><b>CEP: </b></label>
                       <input onkeyup="autofillCEP()" type="hidden" id="cep-edit" name="cep-edit" class="telefone form-control" value="" required>
                    </div>-->
                    <div class="col-md-5 form-group">
                        <label><b>Cidade: </b></label>
                        <input type="text" id="cidade-edit" name="cidade-edit" class="form-control" value="" required>
                    </div> 
                    <div class="col-md-4 form-group">
                       <label><b>Estado:</b></label>
                        <select id="estado-edit" name="estado-edit" class="form-control" required>
                            <option value="" selected disabled>-- Selecione --</option>
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
                    <div class="col-md-8 form-group">
                       <label><b>Loja: </b></label>
                           <select id="loja-edit" name="lojas-edit" id="lojas-edit" class="form-control">
                               <?php foreach($lojas as $l){ 
                                    echo "<option value='".$l['id']."'>".$l['nome']."</option>";
                                } ?>
                           </select>
                    </div>
                    <div class="col-md-4 form-group">
                       <label><b>Comissão: </b></label>
                       <input type="text" id="comissao-edit" name="comissao-edit" class="form-control" required>
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
<div class="modal fade" id="vendedor_vermodal" tabindex="-1" role="dialog" aria-labelledby="vendedor_vermodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">VER VENDEDOR</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 form-group">
                       <label><b>Nome do funcionário: </b></label>
                       <input type="text" id="nome-ver" name="nome-ver" class="form-control" value="" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                       <label><b>CPF: </b></label>
                       <input type="text" id="cpf-ver" name="cpf-ver" class="form-control" value="" readonly>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-3 form-group">
                       <label><b>CEP: </b></label>
                       <input type="text" id="cep-ver" name="cep-ver" class="telefone form-control" value="" readonly>
                    </div>  
                    <div class="col-md-5 form-group">
                       <label><b>Cidade: </b></label>
                       <input type="text" id="cidade-ver" name="cidade-ver" class="form-control" readonly>
                    </div> 
                    <div class="col-md-4 form-group">
                       <label><b>Estado:</b></label>
                        <select id="estado-ver" name="estado-ver" class="form-control" disabled>
                            <option value="" selected disabled>-- Selecione --</option>
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
                    <div class="col-md-12 form-group">
                       <label><b>Comissão: </b></label>
                       <input type="text" id="comissao-ver" name="comissao-ver" class="form-control" readonly>
                    </div>  
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
    </div>
  </div>
</div>

<!-- Modal Anderson -->
<div class="modal fade" id="dadosModal" tabindex="-1" role="dialog" aria-labelledby="dadosModal" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modalCorpo">
  </div>
</div>

<div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="senhaModalLabel">Alterar a Senha</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('updateSenha');?>" method='post'>
                    <input type="hidden" name="newIdModal" id="newIdModal" >
                    <input style="width:50%;" class="form-control" type="password" name="passModal" id="passModal" >
                    <button style="position:absolute; margin-top:-6%; margin-left:75%;" type="button" class="btn btn-secondary" onclick="modalDispose2()">Cancelar</button>
                    <button style="position:absolute; margin-top:-6%; margin-left:50%;" type="submit" class="btn btn-primary">Gravar nova Senha</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Anderson -->

<script>
    function getfunc(id){
        var dados = new FormData();
        dados.append('id', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminfuncionarios/getFuncionarioUnico'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                if(data != 0){
                    $('#nome-ver').val(data.nome_funcionario);
                    $('#cpf-ver').val(data.cpf_funcionario);
                    $('#cep-ver').val(data.cep_id);
                    $('#cidade-ver').val(data.cidade_id);
                    $('#estado-ver').val(data.estado_id);
                    $('#lojas-ver').val(data.loja_id).change();
                    $('#comissao-ver').val(data.comissao_funcionario);
                    
                    $('#id_editar').val(id);
                    $('#nome-edit').val(data.nome_funcionario);
                    $('#cpf-edit').val(data.cpf_funcionario);
                    $('#cep-edit').val(data.cep_id);
                    $('#cidade-edit').val(data.cidade_id);
                    $('#estado-edit').val(data.estado_id);
                    $('#lojas-edit').val(data.loja_id).change();
                    $('#comissao-edit').val(data.comissao_funcionario);
                    
                    $('#id_excluir').val(data.id_funcionario);
                    
                }else{
                    $('#nome-ver').val('');
                    $('#cpf-ver').val('');
                    $('#cep-ver').val('');
                    $('#cidade-ver').val('');
                    $('#estado-ver').val('');
                    $('#lojas-ver').val('');
                    $('#comissao-ver').val(5);
                    
                    $('#nome-edit').val('');
                    $('#cpf-edit').val('');
                    $('#cep-edit').val('');
                    $('#cidade-edit').val('');
                    $('#estado-edit').val('');
                    $('#lojas-edit').val('');
                    $('#comissao-edit').val(8);
                }
            },
        });
    }
</script>
<script>
    function autofillCEP(){
        var aux = $('#cad-cep').val();
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
                        $('#cad-cep').unmask().val(cep.cep).mask('00000-000', {reverse: true}, {'translation': {0: {pattern: /[0-9*]/}}});
                        $('#cad-cidade').val(ce[0]);
                        $('#cad-estado').val(ce[1]).change();
                        $('#cad-bairro').val(cep.cep_bairro);
                        if(cep.cep_rua.indexOf(',') > 0){
                            var rua = cep.cep_rua.split(',');
                            $('#cad-rua').val(rua[0]);
                        }else if(cep.cep_rua.indexOf(' - ') > 0){
                            var rua = cep.cep_rua.split(' - ');
                            $('#cad-rua').val(rua[0]);
                        }else{
                            $('#cad-rua').val(cep.cep_rua);
                        }
                    }
                },
            });
        }
    }
</script>

<!-- Scripts Anderson -->
<script>
    function modalDispose(){
        $('#dadosModal').modal('toggle');
    }
    function limpa_formulário_cep() {
            document.getElementById('lograModal').value=("");
            document.getElementById('bairroModal').value=("");
            document.getElementById('cidadeModal').value=("");
            document.getElementById('estadoModal').value=("");
    }
    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('lograModal').value=(conteudo.logradouro);
            document.getElementById('bairroModal').value=(conteudo.bairro);
            document.getElementById('cidadeModal').value=(conteudo.localidade);
            document.getElementById('estadoModal').value=(conteudo.uf);
        }
        else {
            limpa_formulário_cep();
            Swal.fire('Cep não encontrado, preencha os dados manualmente.');
             $("#lograModal").removeAttr('disabled');
             $("#bairroModal").removeAttr('disabled');
             $("#cidadeModal").removeAttr('disabled');
             $("#estadoModal").removeAttr('disabled');
        }
    }
    function buscaCEP(){
        var valor = document.getElementById('cepModal').value;
        var cep = valor.replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)) {
                document.getElementById('lograModal').value="...";
                document.getElementById('bairroModal').value="...";
                document.getElementById('cidadeModal').value="...";
                document.getElementById('estadoModal').value="...";

                var script = document.createElement('script');
                
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                
                document.body.appendChild(script);
            }
            else {
                limpa_formulário_cep();
                Swal.fire('Cep não encontrado, preencha os dados manualmente.');
            }
        }
        else {
            limpa_formulário_cep();
        }
    }
    
    function addFuncionario(){
        $.ajax({
            url: '<?php echo base_url('addFuncionario'); ?>',
            method: 'post',
            //data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(error);
            },
            success: function(data) {
                $("#modalCorpo").empty();
                $('#modalCorpo').append(data);
                $('#dadosModal').modal("show");
            },
        });
    }
    function editFuncionario(id){
        var dados = new FormData();
        dados.append('id', id);
        $.ajax({
            url: '<?php echo base_url('editFuncionario'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(error);
            },
            success: function(data) {
                $("#modalCorpo").empty();
                $('#modalCorpo').append(data);
                buscaCEP();
                $('#dadosModal').modal("show");
            },
        });
    }
    function seeFuncionario(id){
        var dados = new FormData();
        dados.append('id', id);
        $.ajax({
            url: '<?php echo base_url('seeFuncionario'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
              console.log(error);
            },
            success: function(data) {
                $("#modalCorpo").empty();
                $('#modalCorpo').append(data);
                buscaCEP();
                $('#dadosModal').modal("show");
            },
        });
    }
    function delFuncionario(id){
        Swal.fire({
            title: 'Deseja realmente excluir Funcionário?',
            text: "Ação não poderá ser mais revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Excluir!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Excluido!',
                    text: 'Usuário apagado dos registros',
                    icon: 'success',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
                var dados = new FormData();
                dados.append('id', id);
                $.ajax({
                    url: '<?php echo base_url('delFuncionario'); ?>',
                    method: 'post',
                    data: dados,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error: function(xhr, status, error) {
                      console.log(error);
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
            }
        });
    }
    
    function alterarSenha(id){
        $('#newIdModal').val(id);
        $('#senhaModal').modal("show");
    }
    function modalDispose2(){
        $('#senhaModal').modal('toggle');
    }
</script>
<!-- Fim Scripts Anderson -->