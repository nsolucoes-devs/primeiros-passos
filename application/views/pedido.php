    <?php
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile = 1;
        } else {
            $mobile = 0;
        }
    ?>
    
    
    <style>
        .btn::before {
           background: #291402;
       }
       .marrom-padrao {
            color: saddlebrown;
       }
       p{
           line-height: 15px;
       }
       h6{
           font-family: "Poppins",sans-serif;
       }
       .grecaptcha-badge{
           display: none!important;
       }
       
       #nome-produto{
           margin-top: auto; margin-bottom: auto;
       }
       #qtd-produto{
           padding-top: 40px;
           color: #444;
       }
       #preco-produto{
            padding-top: 45px;
            color: #444;
       }
       #total-produto{
           padding-top: 45px;
           color: #444;
       }
       #th-qtd{
           width: 10%;
           color: saddlebrown;
       }
       #th-nome{
           width: 55%;
           color: saddlebrown;
       }
       
       .p-vendedores{
            font-size: 20px;
            display: inline;
        }
        .p-vendedores:hover{
            color: #72d872;
        }
        .contact-section{
             padding-top: 100px;
             padding-bottom: 100px;
        }
       
       @media(max-width: 500px){
            .contact-section{
                 padding-top: 10px;
                 padding-bottom: 30px;
            }
            #nome-produto{
                text-align: center!important;
                margin-top: 10%!important;
            }
            #qtd-produto{
               padding-top: 20%;
               color: #444;
           }
           #preco-produto{
                padding-top: 17%;
                color: #444;
           }
           #total-produto{
               padding-top: 17%;
               color: #444;
           }
           #th-qtd{
               padding-bottom: 6%;
               width: 10%;
               color: saddlebrown;
           }
           #th-nome{
               padding-bottom: 6%;
               width: 55%;
               color: saddlebrown;
           }
           .botao-voltar{
                margin-top: 15px;
           }
        }
    </style>
    
    
    
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 form-group" style="width: 50%">
                    <a href="<?php echo base_url('92e97566397e7d998f610c34726e7a20#pedidos') ?>"><i class="botao-voltar fa fa-reply" aria-hidden="true"><span style="font-family: sans-serif;font-weight: bold;font-size: 14px;"> Voltar</span></i></a>
                </div>
                <div class="col-md-6 form-group text-right" style="width: 50%">
                    <i data-toggle="modal" data-target="#transferModal" class="botao-voltar fa fa-users" aria-hidden="true"><span style="font-family: sans-serif;font-weight: bold;font-size: 14px;"> Vendedores</span></i>
                    <?php if($pedido['devolucao'] == 0) { ?>
                        <i data-toggle="modal" data-target="#devolucaoModal" class="botao-voltar fa fa-arrow-circle-o-left" aria-hidden="true"> <span style="font-family: sans-serif;font-weight: bold;font-size: 14px;"> Devolução</span></i>
                    <?php } ?>
                </div>
                <div class="col-xl-9 col-md-7 col-lg-7 col-12 form-group">
                    <h4 style="color: #444">PEDIDO N° <?php echo $pedido['idpedido'] ?></h4>
                    
                    <?php if($mobile == 1){ ?>
                        <?php foreach($pedido['produtos'] as $p) { ?>
                            <div class="col-md-12 produto" id="produto" style="padding: 8px; max-height: 195px;">
                                <div class="row form-group">
                                    <div class="col-3">
                                        <img style="height: 80px; width: auto;" src="<?php echo base_url('imagens/produtos/') . $p['produto_id'] . '.jpg'; ?>">
                                    </div>
                                    <div class="col-9">
                                        <p style="font-size: 11px; color: #444!important;"><b style="color: #444!important">Produto:</b></p>
                                        <p style="color: #9c9c9c!important;position: absolute;top: 70px;font-size: 10px;"><?php echo $p['produto_opcao']; ?></p>
                                        <p style="color: #444!important;"><?php echo $p['produto_nome']; ?></p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-3 text-center">
                                        <p style="font-size: 11px; color: #444!important;"><b style="color: #444!important">Valor Unitário:</b></p>
                                        <p style="font-size: 15px; color: #444!important;">R$<?php echo str_replace(".", ",", $p['produto_valor']); ?></p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important">Qtd.:</b></p>
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important"><?php echo $p['produto_quantidade'] ?></b></p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important">Valor Total:</b></p>
                                        <p style=" font-size: 18px; color: #444!important;"><b style="color: #444!important"><?php echo number_format($p['produto_valor'] * $p['produto_quantidade'], 2,',','.'); ?></b></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else {?>
                        <table class="table">
                            <thead>
                                <tr style="background-color: var(--base-color);">
                                    <th style="width: 50%; color: white;" scope="col">Produto(s)</th>
                                    <th class="text-center" style="width: 15%; color: white;" scope="col">Valor Unitário</th>
                                    <th style="width: 15%; color: white;" class="text-center" scope="col">Quantidade</th>
                                    <th style="width: 15%; color: white;" class="text-center" scope="col">Valor Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pedido['produtos'] as $p) { ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3" style="width: 25%">
                                                    <img style="height: 80px; width: auto;" src="<?php echo base_url('imagens/produtos/') . $p['produto_id'] . '.jpg'; ?>">
                                                </div>
                                                <div class="col-md-9" style="width: 75%">
                                                    <p style="color: #9c9c9c!important;position: absolute;top: 50px;font-size: 12px;"><?php echo $p['produto_opcao']; ?></p>
                                                    <p style="color: #444!important;"><?php echo $p['produto_nome']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p style="font-size: 15px; color: #444!important;">R$<?php echo str_replace(".", ",", $p['produto_valor']); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p style=" font-size: 11px; color: #444!important;"><b style="color: #444!important"><?php echo $p['produto_quantidade'] ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <p style=" font-size: 18px; color: #444!important;"><b style="color: #444!important">R$ <?php echo number_format($p['produto_valor'] * $p['produto_quantidade'], 2,',','.'); ?></b></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    
                    <div class="col-md-12 form-group">
                    <?php if($pedido['boleto'] != ""){ ?>
                        <a href="<?php echo $pedido['boleto'];?>" target="_blank"><i style="margin-top: 10px; padding: 7px; border-radius: 5px; background-color: var(--base-color); font-size: 19px; color: white; border: 2px solid var(--base-color);" class="fa fa-money" aria-hidden="true"> Gerar 2ª Via</i></a>
                        <i style="margin-top: 10px; border: 1px solid white; padding: 7px; border-radius: 5px; background-color: white; font-size: 19px; color: var(--base-color);" class="fa fa-barcode" aria-hidden="true"> Linha digitável: <?php echo $pedido['boletoCDBar'];?></i>
                    <?php } ?>
                    </div>
                    
                    <div style="margin-top: 6%">
                        <hr style="height: 1px; border-color: lightgrey; margin-top:0; margin-bottom: 25px">
                        <h5 style="color: #444">HISTÓRICO:</h5>
                        <div class="table-responsive" style="width: 100%">
                            <table class="table">
                                <thead>
                                    <tr style="background-color: var(--base-color);">
                                        <th style="width: 15%; color: white;" scope="col">Data/hora</th>
                                        <th class="text-center" style="width: 50%; color: white;" scope="col">Histórico</th>
                                        <th style="width: 15%; color: white;" class="text-center" scope="col">Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($pedido['historico_devolucao']) { ?>
                                        <?php foreach($pedido['historico_devolucao'] as $h_d){ ?>
                                            <tr style="font-size: 14px; color: #444" class="produto">
                                                <td><?php echo date('d/m/Y', strtotime($h_d['historico_data'])) . ' ' . date('H:i', strtotime($h_d['historico_hora'])) ?></td>
                                                <td><?php echo $h_d['historico_comentario'] ?></td>
                                                <td class="text-center"><?php echo $h_d['historico_status'] ?></td>
                                            </tr>
                                    <?php } } ?>
                                    <?php foreach($pedido['historico'] as $h){ ?>
                                        <tr style="font-size: 14px; color: #444" class="produto">
                                            <td><?php echo $h['historico_data'] . ' ' . $h['historico_hora'] ?></td>
                                            <td><?php echo $h['historico_comentario'] ?></td>
                                            <td class="text-center"><?php echo $h['historico_status'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xl-3 col-md-5 col-lg-5 col-12">
                    <div class="col-md-12 text-center" style="padding: 0">
                        <h4 style="color: #444">DETALHES PEDIDO</h4>
                    </div>
                    <hr style="height: 1px; border-color: lightgrey; margin-top:0; margin-bottom: 25px">
                    <div class="row">
                        <div class="col-md-6" style="width: 50%">
                            <p style="color: #444"><b style="color: #444">Produto(s):</b></p>
                        </div>
                        <div class="text-right col-md-6" style="width: 50%">
                            <p style="color: #444">R$ <span id="sub_total"><?php echo number_format($pedido['total'],2,',','.') ?></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="width: 50%">
                            <p style="color: #444"><b style="color: #444">Frete:</b></p>
                        </div>
                        <div class="text-right col-md-6" style="width: 50%">
                            <p style="color: #444">R$ <span id="frete"><?php echo number_format($pedido['frete_valor'],2,',','.') ?></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="width: 50%">
                            <p style="color: #444"><b style="color: #444">Desconto:</b></p>
                        </div>
                        <div class="text-right col-md-6" style="width: 50%">
                            <p style="color: #444">R$ <span id="desconto"><?php echo number_format($pedido['desconto'],2,',','.') ?></span></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 15px; margin-top: 15px; border: 1px solid lightgrey">
                    <div class="row">
                        <div class="col-md-6" style="width: 50%">
                            <h3 style="color: #444">TOTAL</h3>
                        </div>
                        <div class="text-right col-md-6" style="width: 50%; padding: 0; padding-right: 15px!important">
                            <h4>R$ <span id="total"><?php echo number_format($pedido['total'] + $pedido['frete_valor'] - $pedido['desconto'],2,',','.') ?></span></h4>
                        </div>
                    </div>
                    <hr style="margin-bottom: 15px; margin-top: 15px; border: 1px solid lightgrey">
                    <div class="row" style="line-height: 12px">
                        <div class="col-md-12 text-center" style="margin-top: 5px; margin-bottom: 15px">
                            <h6>INFORMAÇÕES PAGAMENTO</h6>
                        </div>
                        <div class="col-md-5" style="width: 40%">
                            <p><b style="color: #444; font-size: 13px">Status:</b></p>
                            <p><b style="color: #444; font-size: 13px">Pagamento:</b></p>
                        </div>
                        <div class="col-md-7" style="width: 60%; padding: 0">
                            <p style="font-size: 13px"><b style="color: #444"><?php echo $pedido['status'] ?></b></p>
                            <p style="font-size: 13px"><b style="color: #444;"><?php echo $pedido['forma'] ?></b></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 15px; margin-top: 15px; border: 1px solid lightgrey">
                    <div class="row" style="line-height: 12px">
                        <div class="col-md-12 text-center" style="margin-top: 5px; margin-bottom: 15px">
                            <h6>INFORMAÇÕES FRETE</h6>
                        </div>
                        <div class="col-md-5" style="width: 40%">
                            <p><b style="font-size: 13px; color: #444">Entrega:</b></p>
                        </div>
                        <div class="col-md-7" style="width: 60%">
                            <p style="font-size: 13px"><b style="color: #444"><?php echo $pedido['frete'] ?></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <div class="modal" tabindex="-1" role="dialog" id="devolucaoModal">
        <div class="modal-dialog modal-dialog-centered privacidade modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #444; font-weight: bold; font-size: 14px;">SOLICITAÇÃO DE DEVOLUÇÃO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-devolucao" method="post" action="<?php echo base_url('f8dee182f9bb056fcecdeb3c150721dd') ?>" enctype="multipart/form-data">
                    <div class="modal-body" style="padding-left: 20px; padding-right: 20px">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <h3 class="ree_h3">Dados do Comprador</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label>Nome Completo</label>
                                <input class="form-control x" type="text" name="nome" id="ree_nome" placeholder="João Paulo Silva" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>CPF</label>
                                <input class="form-control x" type="text" name="cpf" id="ree_cpf" placeholder="000.000.000-00" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>RG</label>
                                <input class="form-control x" type="text" name="rg" id="ree_rg" placeholder="00.000.000-0X" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Data de Nascimento</label>
                                <input class="form-control x" type="date" name="nascimento" id="ree_nascimento" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="display: block">Título de Eleitor</label>
                                <button type="button" style="background: #3a0b0c; border-color: #3a0b0c;" class="btn-file" data-input="ree_titulo">ESCOLHER ARQUIVO</button>
                                <span class="msg-file" id="ree_msg_titulo">Nenhum selecionado</span>
                                <input class="form-control x input-file" type="file" name="titulo" id="ree_titulo" accept="application/pdf" data-msg="ree_msg_titulo" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label>Nome Completo da Mãe</label>
                                <input class="form-control x" type="text" name="nome_mae" id="ree_nome_mae" placeholder="Maria Silva" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Nascimento da mãe</label>
                                <input class="form-control x" type="date" name="data_mae" id="ree_data_mae" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label>Nome Completo do pai</label>
                                <input class="form-control x" type="text" name="nome_pai" id="ree_nome_pai" placeholder="Pedro Silva" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Nascimento do pai</label>
                                <input class="form-control x" type="date" name="data_pai" id="ree_data_pai" required>
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
                                <label>Logradouro (Rua)</label>
                                <input class="form-control x" type="text" name="rua" id="ree_rua" placeholder="Rua Francisco Afonso" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Número</label>
                                <input class="form-control x" type="text" name="numero" id="ree_numero" placeholder="000" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label>Bairro</label>
                                <input class="form-control x" type="text" name="bairro" id="ree_bairro" placeholder="Centro" required>
                            </div>
                            <div class="col-md-5 form-group">
                                <label>Complemento</label>
                                <input class="form-control x" type="text" name="complemento" id="ree_complemento" placeholder="Não Obrigatório">
                            </div>
                            <div class="col-md-2 form-group">
                                <label>CEP</label><br>
                                <input class="form-control x" type="text" name="cep" id="ree_cep" placeholder="00000-00" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label>Cidade</label>
                                <input class="form-control x" type="text" name="cidade" id="ree_cidade" placeholder="São Paulo" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>UF</label>
                                <input class="form-control x" type="text" name="uf" id="ree_uf" placeholder="SP" required>
                            </div>
                            <div class="col-md-5 form-group">
                                <label>Comprovante de Residência</label>
                                <button type="button" style="background: #3a0b0c; border-color: #3a0b0c;" class="btn-file" data-input="ree_comprovante">ESCOLHER ARQUIVO</button>
                                <span class="msg-file" id="ree_msg_comprovante">Nenhum selecionado</span>
                                <input class="form-control x input-file" type="file" name="comprovante" id="ree_comprovante" accept="application/pdf" data-msg="ree_msg_comprovante" required>
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
                                <label>E-mail</label>
                                <input class="form-control x" type="email" name="email" id="ree_email" placeholder="joaopaulo1@gmail.com" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Telefone</label>
                                <input class="form-control x" type="text" name="telefone" id="ree_telefone" placeholder="(00) 0000-0000" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Celular</label>
                                <input class="form-control x" type="text" name="celular" id="ree_celular" placeholder="(00) 90000-0000" required>
                            </div>
                        </div>
                        <hr class="ree_hr">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <h3 class="ree_h3">Dados da Compra</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>N° Pedido</label>
                                <input class="form-control x" type="type" name="id_pedido" id="id_pedido" value="<?php echo $pedido['idpedido'] ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Data da Compra</label>
                                <input class="form-control x" type="date" name="data_compra" id="ree_data_compra" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Quantidade</label>
                                <input class="form-control x" type="text" name="quantidade" id="ree_quantidade" placeholder="0" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Valor Total</label>
                                <input class="form-control x" type="text" name="valor_total" id="ree_valor_total" placeholder="0,00" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Código da Transação</label>
                                <input class="form-control x" type="text" name="codigo" id="ree_codigo" placeholder="Código da Transação" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Comprovante do Pagamento</label>
                                <button type="button" style="background: #3a0b0c; border-color: #3a0b0c;" class="btn-file" data-input="ree_cupom">ESCOLHER ARQUIVO</button>
                                <span class="msg-file" id="ree_msg_cupom">Nenhum selecionado</span>
                                <input class="form-control x input-file" type="file" name="cupom"  id="ree_cupom" accept="application/pdf" data-msg="ree_msg_cupom" required>
                            </div>
                        </div>
                        <hr class="ree_hr">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 form-group">
                                <h3 class="ree_h3">Dados Bancários</h3>
                            </div>
                            <div class="col-xs-6 col-md-6 form-group text-right">
                                <span class="ree_alert">O comprador tem que ser o titular da conta</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label>Banco</label>
                                <input class="form-control x" type="text" name="banco" id="ree_banco" placeholder="Santander" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Agência</label>
                                <input class="form-control x" type="text" name="agencia" id="ree_agencia" placeholder="00000" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Conta</label>
                                <input class="form-control x" type="text" name="conta" id="ree_conta" placeholder="0000000" required>
                            </div>
                            <div class="col-md-1 form-group">
                                <label>Digito</label>
                                <input class="form-control x" type="text" name="digito" id="ree_digito" placeholder="0" required>
                            </div>
                        </div>
                        <hr class="ree_hr">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Motivo</label>
                                <textarea style="height: 100px;" class="form-control x" name="motivo" id="ree_motivo" required></textarea required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" style="background: var(--base-color); border-color: var(--base-color)" class="g-recaptcha btn btn-primary" data-sitekey="6Lc_4MUaAAAAABAx7uNSBgfUXYknNjIrnERsvvRz" data-callback='onSubmit2' data-action='submit'>Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
       function onSubmit(token) {
         document.getElementById("form-devolucao").submit();
       }
    </script>
    
    <!-- Modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" <?php if($mobile == 0) { echo 'style="margin: 5% 0 0 20%;"'; } ?>>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferModalLabel">Transferência</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <a title="WhatsApp" href="https://api.whatsapp.com/send?text=<?php echo $mensagem ?>&phone=55<?php echo $telefonedecontato ?>" target="_blank"> 
                    <i style="color: #72d872; font-size: 25px" class="fa fa-whatsapp" aria-hidden="true"></i>
                    <p class="p-vendedores"><b>João</b></p>
                </a>
            </div>
            <div class="col-md-12 form-group" style="margin: 0">
                <hr>
            </div>
            <div class="col-md-12 form-group">
                <a title="WhatsApp" href="https://api.whatsapp.com/send?text=<?php echo $mensagem ?>&phone=55<?php echo $telefonedecontato ?>" target="_blank"> 
                    <i style="color: #72d872; font-size: 25px" class="fa fa-whatsapp" aria-hidden="true"></i>
                    <p class="p-vendedores"><b>Maria</b></p>
                </a>
            </div>
            <div class="col-md-12 form-group" style="margin: 0">
                <hr>
            </div>
            <div class="col-md-12 form-group">
                <a title="WhatsApp" href="https://api.whatsapp.com/send?text=<?php echo $mensagem ?>&phone=55<?php echo $telefonedecontato ?>" target="_blank"> 
                    <i style="color: #72d872; font-size: 25px" class="fa fa-whatsapp" aria-hidden="true"></i>
                    <p class="p-vendedores"><b>Joaquim</b></p>
                </a>
            </div>
            <div class="col-md-12 form-group" style="margin: 0">
                <hr>
            </div>
            <div class="col-md-12 form-group">
                <a title="WhatsApp" href="https://api.whatsapp.com/send?text=<?php echo $mensagem ?>&phone=55<?php echo $telefonedecontato ?>" target="_blank"> 
                    <i style="color: #72d872; font-size: 25px" class="fa fa-whatsapp" aria-hidden="true"></i>
                    <p class="p-vendedores"><b>Jarbas</b></p>
                </a>
            </div>
        </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
            <div class="row" style="width: 100%">
                <div class="col-md-6 col-6" style="padding: 0; padding-top: 10px!important;">
                    <p style="color: var(--base-color); font-size: 12px;">Total Pedido: <b><span style="font-size: 20px!important;">R$ <?php echo number_format($pedido['total'] + $pedido['frete_valor'] - $pedido['desconto'],2,',','.') ?></span></b></p>
                </div>
                <div class="col-md-6 col-6 text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                    
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
    
    
    
    
    
    
    
    