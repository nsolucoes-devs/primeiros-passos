    <style>
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #4ECDC4;
            border-color: #4ECDC4;
        }
        
        .modal-dialog-cad{
            width: 60%;
            max-width: 60%;
            margin-left: 20%;
            margin-right: 20%;
        }
        
        #myTable_wrapper .row{
            margin: 0;
        }
        
        .c-20{
            width: 20%;
            flex: 0 0 20%;
            max-width: 20%;
            padding: 0 15px;
            float: left;
        }
        .c-check{
            display: inline;
            margin-right: 10px;
        }
        .c-title{
            font-weight: bold;
            font-size: 15px;
        }
        .c-sub{
            font-weight: bold;
            font-size: 13px;
        }
        .c-div-sub{
            margin-top: 5px;
            padding-left: 15px;
            width: 100%;
        }
        .check-all{
            text-decoration: underline;
            color: #797979;
            display: inline;
            font-size: 13px;
            cursor: pointer;
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
        background: linear-gradient(90deg, rgba(101,55,14,1) 0%, rgba(58,11,12,1) 70%);
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
    
    .c-card-body{
        border-top: 1px solid #d6d5d5;
        padding: 0.9375rem 20px;
        border-radius: 0;
        display: flex;
        background-color: transparent;
    }
    
    .button-area{
        margin-top: 20px;
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
    
    .mr-15{
        margin-right: 15px;
    }
    
    .check{
        min-width: 20px;
        min-height: 20px;
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
                    <li class="breadcrumb-item active" aria-current="page">Lojas</li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('') ?>">Fornecedores</a></li>
                </ol>
            </nav>
      
            <div class="c-card">
                <div class="c-card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2 style="color: #1b9045;"><b>Listagem de Fornecedores</b></h2>
                        </div>
                        <form action="<?php echo base_url('admin/adminfornecedores/listaFornecedores') ?>" method="post">
                            <div class="col-md-6">
                                <div class="button-area">
                                    <a href="<?php echo base_url('admin/adminfornecedores/cadastroFornecedor') ?>"><button type="button" class="btn btn-primary" style="margin-right: 15px" title="Adicionar Item"><em class="fa fa-plus"></em></button></a>
                                    <div class="search-field">
                                        <input type="text" id="filtro" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                        <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="background-color: white; margin-left: 5px; margin-right: 5px">
                    <div class="col-md-12">
                        <div class="c-card-body">
                            <div class="table-responsive" style="width: 100%">
                                <table class="table c-table" id="tabela">
        				        <thead>
        				            <tr>
        				                <th style="width:25%">Nome</th>
        				                <th style="width:25%">CNPJ</th>
        				                <th style="width:25%">Telefone</th>
        				                <th class="text-center" style="width:25%">Ações</th>
        				            </tr>
        				        </thead>
        				        <tbody>
        				            <?php foreach($fornecedores as $f){ ?>
            				            <tr class="tr-check">
            				                <td> <?php echo $f['nome_fornecedor'] ?> </td>
            				                <td> <?php echo $f['cnpj_fornecedor'] ?> </td>
            				                <td> <?php echo $f['tel_cel_fornecedor'] ?> </td>
            				                <td style="color: #1b9045; font-size: 22px!important" class="text-center">
            				                    <a style="color: #1b9045; padding-right: 2%" href="<?php echo base_url('admin/adminfornecedores/verFornecedor/' . $f['id_fornecedor']) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
        				                        <a style="color: #1b9045; padding-right: 2%" href="<?php echo base_url('admin/adminfornecedores/editFornecedor/' . $f['id_fornecedor']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        				                        <i onclick="excluir(<?php echo $f['id_fornecedor'] ?>)" class="fa fa-trash" data-toggle="modal" data-target="#excluirModal" aria-hidden="true"></i>
            				                </td>
            				            </tr>
            				        <?php } ?>    
        				        </tbody>
        				    </table>
        				    </div>
        			    </div>
        			    <?php if($fornecedores == null) { ?>
        			        <div class="col-md-12 text-center">
        			            <p>Nenhum fornecedor encontrado!</p>
        			        </div>
        			    <?php } ?>
        			    <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="pagination-links"><?php echo $links; ?></p>
                            </div>
                        </div>
    			    </div>
                </div>
            </div>
        </section>
    </section>
    
    
    
<div class="modal" tabindex="-1" role="dialog" id="excluirModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
        <h4 class="modal-title" style="color: white; display: inline;">Aviso</h4>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p style="font-size: 17px;">Deseja excluir o fornecedor?<p>
      </div>
      <div class="modal-footer">
          
        <form action="<?php echo base_url('admin/adminfornecedores/excluirFornecedor') ?>" method="post">
                    
        <input type="hidden" name="id_excluir" id="id_excluir">
        
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            
        </form>  
        
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function excluir(id){
        $('#id_excluir').val(id);
    }
</script>