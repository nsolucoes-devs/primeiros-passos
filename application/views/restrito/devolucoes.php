<style>
    /*.tableFixHead          { overflow-y: auto; overflow-x: auto; }
    .tableFixHead thead th { position: sticky; top: 0; }*/

    /* Just common table stuff. Really. */
    /*table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }*/
    
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #4ECDC4;
        border-color: #4ECDC4;
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
    
    #myTable_wrapper .row{
        margin: 0;
    }
    
    #reembolsoModal .form-group{
        margin-bottom: 15px;
    }
    
    .ree_h3{
        font-family: "Poppins",sans-serif;
        color: black;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 0px;
    }
    
    .ree_hr{
        margin-top: 15px;
        border: 0;
        height: 1px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .ree_alert{
        font-size: 12px;
        color: red;
    }
    
    .form-control.x{
    border: 1px solid #999999;
    border-radius: 5px;
    color: black;
    width: 100%;
    height: 34px;
    font-size: 15px;
    }
    
    .btn-file{
        font-size: 15px;
        padding: .375rem .85rem;
        line-height: 1.5;
        color: white;
        border-radius: 5px;
        width: 50%;
        height: 34px;
        background-color: #7800a7;
        border: 1px solid #7800a7;
        cursor: pointer;
    }
    
    .input-file{
        display: none;
    }
    
    .msg-file{
        margin-left: 10px;
        font-size: 12px;
    }
    
        /* XX-Small devices (300px and up) */
    @media ( min-width: 299px ) and ( max-width: 398px ) {
        .privacidade{
            width: 90%;
            max-width: 90%;
            margin: 30px 5% 0 5%;
        }
        
        #footer-pc { display: none; }
        #footer-mob { display: block; }
    }
    
    /* X-Small devices (iPhone and others mobiles, 400px and up) */
    @media ( min-width: 399px ) and ( max-width: 574px ) {
        .privacidade{
            width: 90%;
            max-width: 90%;
            margin: 30px 5% 0 5%;
        }
        
        #footer-pc { display: none; }
        #footer-mob { display: block; }
    }
    
    /* Small devices (landscape phones, 576px and up) */
    @media ( min-width: 575px ) and ( max-width: 766px ) {
        .privacidade{
            width: 90%;
            max-width: 90%;
            margin: 30px 5% 0 5%;
        }
        
        #footer-pc { display: none; }
        #footer-mob { display: block; }
    }
    
    /* Medium devices (tablets, 768px and up) */
    @media ( min-width: 767px ) and ( max-width: 990px ) {
        .privacidade{
            width: 90%;
            max-width: 90%;
            margin: 30px 5% 0 5%;
        }
    }
    
    /* Large devices (desktops, 992px and up) */
    @media ( min-width: 991px ) and ( max-width: 1198px ) {
        .privacidade{
            width: 80%;
            max-width: 80%;
            margin: 30px 10% 0 10%;
        }
    }
    
    /* X-Large devices (large desktops, 1200px and up) */
    @media ( min-width: 1199px ) and ( max-width: 1398px ) {
        .privacidade{
            width: 70%;
            max-width: 70%;
            margin: 30px 15% 0 15%;
        }
    }
    
    /* XX-Large devices (larger desktops, 1400px and up) */
    @media ( min-width: 1399px ) {
        .privacidade{
            width: 70%;
            max-width: 70%;
            margin: 30px 15% 0 15%;
        }
    }
    
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
    
    .search-field{
        width: 200px;
        box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
        display: inline-flex;
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
                <li class="breadcrumb-item active"><a href="<?php echo base_url('aec5e956c610cf9b6445c40befc0e850') ?>">Devoluções</a></li>
            </ol>
        </nav>
        <div class="c-card">
            <div class="c-card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 style="color: #1b9045;"><b>Listagem de Devoluções</b></h2>
                    </div>
                    <form action="<?php echo base_url('aec5e956c610cf9b6445c40befc0e850') ?>" method="post">
                        <div class="col-md-6">
                            <div class="button-area">
                                <div class="search-field">
                                    <input type="text" id="search" name="filtro" class="form-control-custom" value="<?php if(isset($filtro)) { echo $filtro; } ?>">
                                    <button style="cursor: pointer" class="btn btn-primary search"><em class="fa fa-search"></em></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 15px;">
                    <div class="c-card-body">
                        <div class="table-responsive" style="width: 100%">
                            <table class="table c-table" id="tabela">
				        <thead>
				            <tr>
				                <th style="width: 8%;">Protocolo</th>
				                <th style="width: 18%;">Nome</th>
				                <th style="width: 9%;">CPF</th>
				                <th style="width: 5%;">Data</th>
				                <th style="width: 12%;">E-mail</th>
				                <th style="width: 10%;">Celular</th>
				                <th style="width: 30%;">Status</th>
				                <th class="text-center" style="width: 7%;">Ações</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php foreach($devolucoes as $r){ ?>
				                <tr class="checktable">
				                    <td><?php echo $r['reembolso_protocolo'] ?></td>
				                    <td><?php echo ucwords(mb_strtolower($r['reembolso_nome'])) ?></td>
				                    <td class="cpf"><?php echo $r['reembolso_cpf'] ?></td>
				                    <td><?php echo date('d/m/Y', strtotime($r['reembolso_data'])) ?></td>
				                    <td><?php echo mb_strtolower($r['reembolso_email']) ?></td>
				                    <td class="telefone"><?php echo $r['reembolso_celular'] ?></td>
				                    <td><?php echo ucwords(mb_strtolower($r['reembolso_status'])) ?></td>
				                    <td style="color: #1b9045; font-size: 22px!important;" class="text-center">
				                        <i data-toggle="modal" data-target="#reembolsoModal" onclick="verreembolso(<?php echo $r['reembolso_id'] ?>)" class="fa fa-eye" aria-hidden="true"></i>
				                        <i onclick="atualizarstatus(<?php echo $r['reembolso_id'] ?>)" data-toggle="modal" data-target="#statusModal" style="padding-left: 12px;" class="fa fa-pencil" aria-hidden="true"></i>
				                    </td>
				                </tr>
				            <?php } ?>
				        </tbody>
				    </table>
				        </div>
			        </div>
			        <?php if($devolucoes == null) { ?>
        		        <div class="col-md-12 text-center">
        		            <p>Nenhuma devolução encontrada!</p>
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

    <div class="modal" tabindex="-1" role="dialog" id="reembolsoModal">
            <div class="modal-dialog modal-dialog-centered privacidade" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                        <h5 id="protocol_number" class="modal-title" style="display: inline; color: white; font-weight: bold; font-size: 14px;">DEVOLUÇÃO</h5>
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                        <div class="modal-body" style="padding-left: 20px; padding-right: 20px">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3 class="ree_h3">Dados do Comprador</h3>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label style="color: black;"><b>Nome Completo:</b></label>
                                    <input class="form-control x" type="text" name="nome" id="nome" placeholder="João Paulo Silva" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>CPF:</b></label>
                                    <input class="form-control x" type="text" name="cpf" id="cpf" placeholder="000.000.000-00" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>RG:</b></label>
                                    <input class="form-control x" type="text" name="rg" id="rg" placeholder="00.000.000-0X" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>Data de Nascimento:</b></label>
                                    <input class="form-control x" type="date" name="nascimento" id="nascimento" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="display: block; color: black;"><b>Título de Eleitor:</b></label>
                                    <a target="_blank" id="imagem-titulo"><span class="btn btn-primary">VER ARQUIVO</span></a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-9 form-group">
                                    <label style="color: black;"><b>Nome Completo da Mãe:</b></label>
                                    <input class="form-control x" type="text" name="nomemae" id="nomemae" placeholder="Maria Silva" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>Nascimento da mãe:</b></label>
                                    <input class="form-control x" type="date" name="datamae" id="datamae" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-9 form-group">
                                    <label style="color: black;"><b>Nome Completo do pai:</b></label>
                                    <input class="form-control x" type="text" name="nomepai" id="nomepai" placeholder="Pedro Silva" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>Nascimento do pai:</b></label>
                                    <input class="form-control x" type="date" name="datapai" id="datapai" readonly>
                                </div>
                            </div>
                            
                            <hr class="ree_hr">
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3 class="ree_h3">Endereço</h3>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-10 form-group">
                                    <label style="color: black;"><b>Logradouro (Rua):</b></label>
                                    <input class="form-control x" type="text" name="rua" id="rua" placeholder="Rua Francisco Afonso" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>Número:</b></label>
                                    <input class="form-control x" type="text" name="numero" id="numero" placeholder="000" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label style="color: black;"><b>Bairro:</b></label>
                                    <input class="form-control x" type="text" name="bairro" id="bairro" placeholder="Centro" readonly>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label style="color: black;"><b>Complemento:</b></label>
                                    <input class="form-control x" type="text" name="complemento" id="complemento" placeholder="Não Obrigatório" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>CEP:</b></label><br>
                                    <input class="form-control x" type="text" name="cep" id="cep" placeholder="00000-00" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label style="color: black;"><b>Cidade:</b></label>
                                    <input class="form-control x" type="text" name="cidade" id="cidade" placeholder="São Paulo" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>UF:</b></label>
                                    <input class="form-control x" type="text" name="uf" id="uf" placeholder="SP" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>Comprovante de Residência:</b></label><br>
                                    <a target="_blank" id="imagem-comprovante"><span class="btn btn-primary">VER ARQUIVO</span></a>
                                </div>
                            </div>
                            
                            <hr class="ree_hr">
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3 class="ree_h3">Contato</h3>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label style="color: black;"><b>E-mail:</b></label>
                                    <input class="form-control x" type="email" name="email" id="email" placeholder="joaopaulo1@gmail.com" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>Telefone:</b></label>
                                    <input class="form-control x" type="text" name="telefone" id="telefone" placeholder="(00) 0000-0000" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>Celular:</b></label>
                                    <input class="form-control x" type="text" name="celular" id="celular" placeholder="(00) 90000-0000" readonly>
                                </div>
                            </div>
    
                            <hr class="ree_hr">
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3 class="ree_h3">Dados da Compra</h3>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>N° Pedido:</b></label>
                                    <input class="form-control x" type="type" name="id_pedido" id="id_pedido" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>Data da Compra:</b></label>
                                    <input class="form-control x" type="date" name="datacompra" id="datacompra" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>Quantidade:</b></label>
                                    <input class="form-control x" type="text" name="quantidade" id="quantidade" placeholder="0" readonly>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label style="color: black;"><b>Valor Total:</b></label>
                                    <input class="form-control x" type="text" name="valortotal" id="valortotal" placeholder="0,00" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label style="color: black;"><b>Código da Transação:</b></label>
                                    <input class="form-control x" type="text" name="codigo" id="codigo" placeholder="Código da Transação" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label style="color: black;"><b>Comprovante do Pagamento:</b></label><br>
                                    <a target="_blank" id="imagem-cupom"><span class="btn btn-primary">VER ARQUIVO</span></a>
                                </div>
                            </div>
                            
                            <hr class="ree_hr">
                            
                            <div class="row">
                                <div class="col-xs-6 col-md-6 form-group">
                                    <h3 class="ree_h3">Dados Bancários</h3>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label style="color: black;"><b>Banco:</b></label>
                                    <input class="form-control x" type="text" name="banco" id="banco" placeholder="Santander" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>Agência:</b></label>
                                    <input class="form-control x" type="text" name="agencia" id="agencia" placeholder="00000" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>Conta:</b></label>
                                    <input class="form-control x" type="text" name="conta" id="conta" placeholder="0000000" readonly>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label style="color: black;"><b>Digito:</b></label>
                                    <input class="form-control x" type="text" name="digito" id="digito" placeholder="0" readonly>
                                </div>
                            </div>
                            
                            <hr class="ree_hr">
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label style="color: black;"><b>Motivo:</b></label>
                                    <textarea style="height: 100px;" class="form-control x" name="motivo" id="motivo" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer" style="justify-content: center;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    
                </div>
            </div>
        </div>
        
    <div class="modal" tabindex="-1" role="dialog" id="statusModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                    <h5 class="modal-title" style="color: white; display: inline;">ALTERAR STATUS</h5>
                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label style="color: black;"><b>Status:</b></label>
                            <select class="js-example-basic-multiple" id="status_modal" name="status_modal">
                                <?php foreach($status as $s){ ?>
                                    <option value="<?php echo $s['idStatusCompra'] ?>"><?php echo $s['nomeStatusCompra'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>&nbsp;</label>
                            <button  data-toggle="modal" data-target="#adicionarStatusModal" class="btn-block btn btn-primary">+</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label style="color: black;"><b>Comentário:</b></label>
                            <textarea class="form-control" id="comentario_modal" name="comentario_modal" required></textarea required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="senha()">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <div class="row row-c" id="formsenha" style="display: none">
                        <div class="col-md-12 text-center">
                            <form action="<?php echo base_url('a727108ec64c324b8beac74027fc06b2') ?>" method="post">
                                <input type="hidden" name="id_reembolso" id="id_reembolso">
                                <input type="hidden" name="status_enviar" id="status_enviar">
                                <input type="hidden" name="comentario_enviar" id="comentario_enviar">
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
    
    
    <div class="modal fade" id="adicionarStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(90deg, rgba(27, 144, 69) 0%, rgba(36, 189, 91) 70%);">
                    <h5 class="modal-title" style="display: inline" id="exampleModalLabel">Novo Status de Devolução</h5>
                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('4eeaa8fe234a5a517458f7d141118777') ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label><b>Nome Status:</b></label>
                                <input type="text" name="novo_status" id="novo_status" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function senha(){
            $('#formsenha').show();
            
            $('#status_enviar').val($('#status_modal').val());
            $('#comentario_enviar').val($('#comentario_modal').val());
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
        function verreembolso(id){
            dados = new FormData();
            dados.append('id', id);
            $.ajax({
                url: '<?php echo base_url('a1a14cc2bb19ab7fe7d49bfbc0a0e3c6'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    reembolso = jQuery.parseJSON(data);
                    
                    $('#protocol_number').html('Reembolso ' + reembolso.reembolso_protocolo);
                    $('#nome').val(reembolso.reembolso_nome);
                    $('#cpf').unmask().val(reembolso.reembolso_cpf).mask('000.000.000-00', {reverse: true});
                    $('#rg').val(reembolso.reembolso_rg);
                    $('#nascimento').val(reembolso.reembolso_nascimento);
                    $('#nomemae').val(reembolso.reembolso_nomemae);
                    $('#nomepai').val(reembolso.reembolso_nomepai);
                    $('#datapai').val(reembolso.reembolso_datapai);
                    $('#datamae').val(reembolso.reembolso_datamae);
                    $('#rua').val(reembolso.reembolso_rua);
                    $('#numero').val(reembolso.reembolso_numero);
                    $('#bairro').val(reembolso.reembolso_bairro);
                    $('#complemento').val(reembolso.reembolso_complemento);
                    $('#cep').unmask().val(reembolso.reembolso_cep).mask('00000-000');
                    $('#cidade').val(reembolso.reembolso_cidade);
                    $('#uf').val(reembolso.reembolso_uf);
                    $('#email').val(reembolso.reembolso_email);
                    $('#telefone').unmask().val(reembolso.reembolso_telefone).mask('(00) 0000-0000');
                    $('#celular').unmask().val(reembolso.reembolso_celular).mask('(00) 00000-0000');
                    $('#codigo').val(reembolso.reembolso_codigo);
                    $('#datacompra').val(reembolso.reembolso_datacompra);
                    $('#quantidade').val(reembolso.reembolso_quantidade);
                    $('#valortotal').val(reembolso.reembolso_valortotal);
                    $('#banco').val(reembolso.reembolso_banco);
                    $('#agencia').val(reembolso.reembolso_agencia);
                    $('#conta').val(reembolso.reembolso_conta);
                    $('#digito').val(reembolso.reembolso_digito);
                    $('#id_pedido').val(reembolso.reembolso_pedido_id);
                    $('#motivo').val(reembolso.reembolso_motivo);
                    $('#sorteio').val(reembolso.reembolso_sorteio).change();
                    $('#imagem-titulo').prop('href', '<?php echo base_url() ?>' + reembolso.reembolso_titulo);
                    $('#imagem-comprovante').prop('href', '<?php echo base_url() ?>' + reembolso.reembolso_comprovante);
                    $('#imagem-cupom').prop('href', '<?php echo base_url() ?>' + reembolso.reembolso_cupom);

                },
            });
        }
        
        
    </script>
    
    <script>
        function atualizarstatus(id){
            dados = new FormData();
            dados.append('id', id);
            $.ajax({
                url: '<?php echo base_url('a1a14cc2bb19ab7fe7d49bfbc0a0e3c6'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success: function(data) {
                    statusgui = jQuery.parseJSON(data);
                    $('#status_modal').val(statusgui.reembolso_status).change();
                    $('#id_reembolso').val(statusgui.reembolso_id);

                },
            });
        }
        
        
    </script>

    
    <script>
        $(document).ready(function(){
            $('.cpf').mask('000.000.000-00', {reverse: true});
            var SPMaskBehavior = function (val) {
              return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
              onKeyPress: function(val, e, field, options) {
                  field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            
            $('.telefone').mask(SPMaskBehavior, spOptions);
            
            $('.js-example-basic-multiple').select2({theme: "bootstrap"});
            //reembolsoModal();
            $('.select-footer').select2({theme: "bootstrap"});
            $('#ree_numero').mask('0#');
            $('#ree_uf').mask('XX', {'translation': {'X': {pattern: /[A-Za-z]/}}});
            $('#ree_quantidade').mask('0#');
            $('#ree_valor_total').mask("#.##0,00", {reverse: true});
            
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

            $('#ree_celular').mask(SPMaskBehavior, spOptions);
            
            <?php if(isset($msg)) { ?>
                <?php if($msg == 1 || $msg == '1'){ ?>
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
                        title: 'Status Atualizado com Sucesso!'
                    })
                <?php } else if($msg == 2 || $msg == '2'){ ?>
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
                        icon: 'error',
                        title: 'Não foi possível atualizar o status, pois a senha está incorreta. Resta Apenas ' + <?php if($this->session->userdata('user_block') == 2) { echo ' 1 ';} else { echo ' 2 '; } ?> + ' tentativa(s)!'
                    })
                <?php } ?>
            <?php } ?>
        });
        
</script>


<script>

        $('.btn-file').on('click', function(){
            $('#'+$(this).data('input')).click();
        });
        
        $('.input-file').on('change', function(){
            var sp = $(this).val().split('\\');
            if(sp[sp.length - 1].length > 20){
                var fim = parseInt(sp[sp.length - 1].length) - 10;
                var one = sp[sp.length - 1].substr(0, 6);
                var two = sp[sp.length - 1].substr(fim);
                var last = one+"..."+two;
            }else{
                var last = sp[sp.length - 1];
            }
            $('#'+$(this).data('msg')).html(last);
        });
    </script>