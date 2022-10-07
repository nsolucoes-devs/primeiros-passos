<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.min.css')?>" />
<style>
    .card {
        height: auto;
    }
    
    .nav-tabs{
        background-color: white;
    }
    
    .nav-link{
        font-size: 25px;
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
    
    .modal-posicao{
        position: relative;
        left: 25%;
        top: 8px;
    }
    
</style>

<section id="main-content">
    <section class="wrapper">
        <nav aria-label="breadcrumb" style="margin-bottom: -25px; margin-top: 20px;">
            <ol class="breadcrumb" style="margin: 0; padding: 0; background-color: transparent">
                <li class="breadcrumb-item active" aria-current="page">Lojas</li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('') ?>">Lojas</a></li>
            </ol>
        </nav>
        
            <div class="c-card" style="bottom: 40px;">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Listagem de lojas</b></h2>
                        </div>
                        <div class="col-md-6 text-rigth">
                            <button class="btn btn-primary" style="position: relative; top: 25px; right: 3%;" data-toggle="modal" data-target="#nova-loja"> Nova Loja </button>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                    <div class="col-md-12">
                        <div class="c-card-body">
                            <div class="table-responsive" style="width: 100%">
                                <table class="table c-table" id="tabela">
            				        <thead>
            				            <tr>
            				                <!--<th>ID</th>-->
            				                <th>Nome da Loja</th>
            				                <th>Cidade</th>
            				                <th class="text-center" style="width:10%">Ações</th>
            				            </tr>
            				        </thead>
            				        <tbody>
            				            <?php foreach($lojas as $lj){ ?>
                				            <tr>
                				                <!--<td> <?php echo $lj['id'] ?> </td>-->
                				                <td> <?php echo $lj['nome'] ?> </td>
                				                <td> <?php echo $lj['cidade'] ?> </td>
                				                <td style="font-size: 22px!important" class="text-center">
            				                        <a style="color: #1b9045; padding-right: 5%; cursor: pointer" data-toggle="modal" data-target="#ver-loja" onclick="verloja(<?php echo $lj['id'] ?>)"><i class="fa fa-eye" aria-hidden="true"></i></a>
            				                        <a style="color: #1b9045; padding-right: 5%; cursor: pointer" data-toggle="modal" data-target="#edit-loja" onclick="verloja(<?php echo $lj['id'] ?>)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            				                        <a style="color: #1b9045; padding-right: 5%; cursor: pointer" data-toggle="modal" data-target="#excluir-loja" onclick="verloja(<?php echo $lj['id'] ?>)"><i class="fa fa-times" aria-hidden="true"></i></a>
            				                    </td>
                				            </tr>
            				            <?php } ?>
            				        </tbody>
        				        </table>
        				    </div>
        			    </div>
    			    </div>
                </div>
            </div>
        
    </section>
</section>

<!-- Modal Add Loja -->
<div class="modal fade" id="nova-loja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1b9045">
        <h5 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">ADICIONAR LOJA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 7px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminlojas/cadloja');?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nome Loja: </label>
                        <input class="form-control" id="cad-nome-loja" name="cad-nome-loja" placeholder="Nome loja | cidade" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>CEP: </label> 
                        <input class="form-control" id="cad-cep-loja" name="cad-cep-loja" placeholder="00000-000" required> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Cidade: </label>
                        <input class="form-control" id="cad-cidade-loja" name="cad-cidade-loja" placeholder="Cidade" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label> Rua: </label>
                        <input class="form-control" id="cad-rua-loja" name="cad-rua-loja" placeholder="Rua" required>
                    </div>
                    <div class="col-md-2 form-group">
                        <label> N°: </label>
                        <input class="form-control" type="number"  id="cad-num-loja" name="cad-num-loja" placeholder="Nº" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 form-group">
                        <label>Bairro: </label>
                        <input class="form-control" id="cad-bairro-loja" name="cad-bairro-loja" placeholder="Bairro" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Telefone: </label>
                        <input class="form-control" id="cad-tel-loja" name="cad-tel-loja" placeholder="(00)0000-0000" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ver Loja -->
<div class="modal fade" id="ver-loja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #1b9045">
            <h4 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">VER LOJA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 7px;">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nome Loja: </label>
                        <input class="form-control" id="nome-loja-modal" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>CEP: </label> 
                        <input class="form-control" id="cep-loja-modal" readonly> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Cidade: </label>
                        <input class="form-control" id="cidade-loja-modal" readonly>
                    </div>
                    <div class="col-md-5 form-group">
                        <label> Rua: </label>
                        <input class="form-control" id="rua-loja-modal"  readonly>
                    </div>
                    <div class="col-md-2 form-group">
                        <label> N°: </label>
                        <input class="form-control" id="numero-loja-modal"  readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 form-group">
                        <label>Bairro: </label>
                        <input class="form-control" id="bairro-loja-modal"  readonly>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Telefone: </label>
                        <input class="form-control" id="tel-loja-modal"  readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div> 
    </div>
  </div>
</div>

<!-- Modal Editar Loja -->
<div class="modal fade" id="edit-loja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1b9045">
        <h4 class="modal-title" id="exampleModalLabel" style="position: relative; top: 10px;">EDITAR LOJA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; bottom: 7px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/adminlojas/editloja');?>" method="post">
            <input type="hidden" name="id-loja-modal2" id="id-loja-modal2">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nome Loja: </label>
                        <input class="form-control" id="nome-loja-modal2" name="nome-loja-modal2">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>CEP: </label> 
                        <input class="form-control" id="cep-loja-modal2" name="cep-loja-modal2"> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Cidade: </label>
                        <input class="form-control" id="cidade-loja-modal2" name="cidade-loja-modal2">
                    </div>
                    <div class="col-md-5 form-group">
                        <label> Rua: </label>
                        <input class="form-control" id="rua-loja-modal2" name="rua-loja-modal2">
                    </div>
                    <div class="col-md-2 form-group">
                        <label> N°: </label>
                        <input class="form-control" id="numero-loja-modal2" name="numero-loja-modal2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 form-group">
                        <label>Bairro: </label>
                        <input class="form-control" id="bairro-loja-modal2" name="bairro-loja-modal2">
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Telefone: </label>
                        <input class="form-control" id="tel-loja-modal2" name="tel-loja-modal2">
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

<!-- Modal Excluir Loja -->

<div class="modal" tabindex="-1" role="dialog" id="excluir-loja">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1b9045">
        <h4 class="modal-title" style="color: white; display: inline;">AVISO</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;"><b> Deseja excluir a loja? </b><p>
      </div>
      <div class="modal-footer">
            <form action="<?php echo base_url('admin/adminlojas/excluirloja') ?>" method="post">
                <input type="hidden" id="id-loja-ex" name="id-loja-ex" value="<?php $loja ?>">
                <button type="submit" class="btn btn-primary">Excluir</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form> 
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap-multiselect.min.js')?>"></script>

<script>
    function verloja(id){
        var dados = new FormData();
        dados.append('loja', id);
        
        $.ajax({
            url: '<?php echo base_url('admin/adminlojas/getlojaid'); ?>',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
            success: function(data) {
                $('#id-loja-modal').val(data.id);
                $('#nome-loja-modal').val(data.nome);
                $('#cep-loja-modal').val(data.cep);
                $('#cidade-loja-modal').val(data.cidade);
                $('#rua-loja-modal').val(data.rua);
                $('#numero-loja-modal').val(data.numero);
                $('#bairro-loja-modal').val(data.bairro);
                $('#tel-loja-modal').val(data.telefone);
                $('#estoque-loja-modal').val(data.estoque_separado);
                
                $('#id-loja-modal2').val(data.id);
                $('#nome-loja-modal2').val(data.nome);
                $('#cep-loja-modal2').val(data.cep);
                $('#cidade-loja-modal2').val(data.cidade);
                $('#rua-loja-modal2').val(data.rua);
                $('#numero-loja-modal2').val(data.numero);
                $('#bairro-loja-modal2').val(data.bairro);
                $('#tel-loja-modal2').val(data.telefone);
                $('#estoque-loja-modal2').val(data.estoque_separado);
                
                if(data.estoque_separado == 1){
                    document.getElementById('estoque-loja-modal').checked = true;
                    document.getElementById('estoque-loja-modal2').checked = true;
                } else {
                    document.getElementById('estoque-loja-modal').checked = false;
                    document.getElementById('estoque-loja-modal2').checked = false;
                }
                
                $('#id-loja-ex').val(data.id);
            },
        });
    }
</script>