<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendEmail extends CI_Model {
    
    public function mailbody($dados){
        
        $aux = explode(' ', $dados['nome']);
        $aux_produtos = "";
        
        if(isset($dados['segundo'])){
            $frase = null;
        } else {
            $frase = "<p style='font-size: 15px; color: #24aeef; text-align: center; font-size: 15px;'><b>" . $aux[0] . " obrigado pelo pedido!</b></p>
                    <p style='margin-bottom: 25px; text-align: center; font-size: 12px'>Seu pedido foi recebido<br> e será processado assim que o pagamento for confirmado.</p>";
        }
        
        foreach($dados['produtos'] as $p){
            $aux_produtos .=
            "<tr>
                <td style=' border: 1px solid lightgrey'><p style='font-size: 11px'>" . $p['produto_nome'] . "</p></td>
                <td style=' border: 1px solid lightgrey'><p style='font-size: 11px'>" . $p['produto_modelo'] . "</p></td>
                <td style=' border: 1px solid lightgrey'><p style='font-size: 11px'>" . $p['produto_quantidade'] . "</p></td>
                <td style=' border: 1px solid lightgrey'><p style='font-size: 11px'>R$ " . $p['produto_valor'] . "</p></td>
                <td style=' border: 1px solid lightgrey'><p style='font-size: 11px'>R$ " . $p['produto_total'] . "</p></td>
            </tr>";
        }
        
        $email =
            "<!doctype html>
                <html class='no-js' lang='zxx'>
                    <head></head>
                    <body style='width: 100%'>
                        <div style='width: 100%; background: #24aeef; border-radius: 10px;'>
                            <table style='width: 100%'>
                                <tr>
                                    <td style='text-align: center; width: 100%;'>
                                        <img style='height: auto; width: 200px; display: inline; margin-right: 10px' src='https://cellstoredistribuidora.com.br/novo/imagens/site/logo.png'>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style='width: 100%;padding: 15px 0;'>
                        " . $frase . "
                            <p style='margin-bottom: 25px; font-size: 11px'>Acompanhe seu pedido: " . base_url('conta#pedidos') . "</p>
                            <p style='margin: 0; padding: 0; font-size: 13px;'><b>PEDIDO:</b></p>
                            <table style='padding: 5px; width: 100%; border-collapse: collapse; border-radius: 5px;'>
                                <tr>
                                    <td style='border: 1px solid lightgrey'>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Pedido N°:</b> " . $dados['numero_pedido'] . "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Data:</b> " . $dados['data']. "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Pagamento:</b> " . $dados['pagamento']. "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Frete:</b> " . $dados['entrega']. "</p>
                                    </td>
                                
                                    <td style='border: 1px solid lightgrey'>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Nome:</b> " . $dados['nome']. "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>CPF:</b> " . $dados['cpf']. "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Telefone:</b> " . $dados['fone'] . "</p>
                                        <p style='padding: 5px; margin: 0; color: black; font-size: 11px;'><b style='color: black'>Status: </b> ". $dados['status'] ."</p>
                                    </td>
                                </tr>
                            </table>
                            <p style='color: black; margin-top: 30px!important; font-size: 13px;margin: 0; padding: 0; '><b>INSTRUÇÕES:</b></p>
                            <table style='padding: 5px; width: 100%; border-collapse: collapse; border-radius: 5px;'>
                                <tr>
                                    <td style='border: 1px solid lightgrey'>
                                        <p style='padding: 5px;font-size: 11px'><b>Detalhes da compra:</b>" . $dados['detalhes']  . "</p>
                                    </td>
                                </tr>
                            </table>
                            <p style='color: black; margin-top: 30px!important; font-size: 13px;margin: 0; padding: 0; '><b>ENTREGA:</b></p>
                            <table style='padding: 5px; width: 100%; border-collapse: collapse;'>
                                <tr>
                                    <td style='border: 1px solid lightgrey'>
                                        <p style='padding: 5px;color: black; font-size: 11px;'><b style='color: black'>Endereço: </b> ". $dados['endereco'] ."</p>
                                    </td>
                                </tr>
                            </table>
                            <p style='color: black; margin-top: 30px!important; font-size: 13px;margin: 0; padding: 0; '><b>PRODUTOS:</b></p>
                            <table style='text-align: center; width: 100%; border: 1px solid #24aeef; border-collapse: collapse; padding: 3px; border-radius: 5px;'>
                                <tr>
                                    <td style=' border: 1px solid lightgrey'><b style='font-size: 12px'>Produto</b></td>
                                    <td style='border: 1px solid lightgrey'><b style='font-size: 12px'>Volume</b></td>
                                    <td style='border: 1px solid lightgrey'><b style='font-size: 12px'>Qtd</b></td>
                                    <td style='border: 1px solid lightgrey'><b style='font-size: 12px'>Preço</b></td>
                                    <td style='border: 1px solid lightgrey'><b style='font-size: 12px'>Total</b></td>
                                </tr>
                                " . $aux_produtos . "
                                <tr>
                                    <td style='padding: 0px!important; text-align: right!important; border: 1px solid lightgrey' colspan='4'><p style='font-size: 12px;'><b>Sub-total:</b><p></td>
                                    <td style='border: 1px solid lightgrey'><p style='font-size: 11px;'>R$ " . $dados['subtotal'] . "</p></td>
                                </tr>
                                <tr>
                                    <td style='padding: 0px!important; text-align: right!important;border: 1px solid lightgrey' colspan='4'><p style='font-size: 12px;'><b>Frete:</b></p></td>
                                    <td style='border: 1px solid lightgrey'><p style='font-size: 11px;'>R$ " . $dados['frete'] . "</p></td>
                                </tr>
                                <tr>
                                    <td style='padding: 0px!important; text-align: right!important;border: 1px solid lightgrey' colspan='4'><p style='font-size: 12px;'><b>Desconto:</b></p></td>
                                    <td style='border: 1px solid lightgrey'><p style='font-size: 11px;'>R$ " . $dados['desconto'] . "</p></td>
                                </tr>
                                <tr>
                                    <td style='padding: 0px!important; text-align: right!important; border: 1px solid lightgrey' colspan='4'><p style='font-size: 12px;'><b>Total:</b></p></td>
                                    <td style='border: 1px solid lightgrey' ><p style='font-size: 11px;'><b>R$ " . $dados['total'] . "</b></p></td>
                                </tr>
                            </table>
                            <br>
                            <div style='padding: 10px; text-align: center;'>
                                <p style='color: black;'>Acesse: " . base_url() . "<br> SAC: <img style='width: 15px; height: auto' src='". base_url('resources/logo_whats.png') ."'> ".$dados['whats']."</p>
                                <p style='color: black; text-align: center;font-size: 10px;'><b>Não precisa responder, e-mail automático.</b></p>
                            </div>
                        </div>
                    </body>
                    </html>";
                    
        return $email;
    
    }
    
    public function avisoBlock($log){
        $mail = "<!doctype html>
                <html class='no-js' lang='zxx'>
                    <head></head>
                    <body style='width: 100%'>
                        <div style='width: 100%; text-align: center; padding: 20px'>
                            <p style='color: black; font-size: 18px'><b style='color: black'>Atividade suspeita dentro da área administrativa</b></p>
                            <br>
                            <p style='color: black; font-size: 14px'>IP:&nbsp;<b style='color: black'>".$log['log_ip']."</b></p>
                            <p style='color: black; font-size: 14px'>Usuário:&nbsp;<b style='color: black'>".$log['log_nome']."</b></p>
                            <p style='color: black; font-size: 14px'>Data - Hora:&nbsp;<b style='color: black'>".date('d/m/Y', strtotime($log['log_data']))." - ".$log['log_hora']."</b></p>
                            <p style='color: black; font-size: 14px'>Tipo da Atividade:&nbsp;<b style='color: black'>".$log['log_tipo']."</b></p>
                            <p style='color: black; font-size: 14px'>Local da Atividade:&nbsp;<b style='color: black'>".$log['log_funcao']."</b></p>
                        </div>
                    </body>
                </html>";
                
        return $mail;
    }
    
    
    
    public function esqueceuSenha($dados){
        $aux = explode(' ', $dados['nome']);
        
        $email =
            "<!doctype html>
                <html class='no-js' lang='zxx'>
                    <head></head>
                    <body style='width: 100%'>
                        <div style='width: 100%'>
                            <table style='width: 100%'>
                                <tr>
                                    <td style='width: 40%;'>
                                        <img style='height: auto; width: 200px; display: inline; margin-right: 10px' src='".base_url('imagens/site/logo.png') ."'>
                                    </td>
                                    <td style='width: 60%'>
                                        <h2 style='color: black; margin-bottom: 10px; text-align: center; font-size: 16px;'><b style='font-size: 18px; color: black'>".$dados['empresa']."</h2>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style='width: 100%'>
                        
                            <p style='color: black; font-size: 13px'> Olá, " . $aux[0] . ". Recebemos seu pedido de alteração de senha.</p>
                            <p style='color: black; text-align: center; font-size: 15px;'> Sua nova senha é:</p>
                            <p style='color: black; text-align: center; font-size: 16px; margin-bottom: 60px'>" . $dados['senha'] . "</p>
                        
                            <p style='color: black;'>Acesse: ". base_url() ."<br> SAC: <img style='width: 15px; height: auto' src='". base_url('resources/logo_whats.png') ."'> ".$dados['whats']."</p>
                            <p style='color: black; text-align: center;font-size: 10px;'><b>Não precisa responder, e-mail automático.</b></p>
                        </div>
                    </body>
                    </html>";
                    
        return $email;
    
    }
    
    public function contatos($dados){
        $email =
            "<!doctype html>
                <html class='no-js' lang='zxx'>
                    <head></head>
                    <body style='width: 100%'>
                        <div style='width: 100%'>
                            <table style='width: 100%'>
                                <tr>
                                    <td style='width: 40%;'>
                                        <img style='height: auto; width: 200px; display: inline; margin-right: 10px' src='".base_url('imagens/site/logo.png') ."'>
                                    </td>
                                    <td style='width: 60%'>
                                        <h2 style='color: black; margin-bottom: 10px; text-align: center; font-size: 16px;'><b style='font-size: 18px; color: black'>Natal Agro e Pesca</h2>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style='width: 100%'>
                            <br><br><style='color: black;  font-size: 12px; margin-bottom: 60px'>". 'Contato: ' . $dados['nome'] . "<br>
                            <style='color: black;  font-size: 12px; margin-bottom: 60px'>" . 'Email do contato: '. $dados['email'] . "<br><br>
                            <p style='color: black; text-align: center; font-size: 14px; margin-bottom: 60px'>" . $dados['message'] . "</p>
                            <p style='color: black; text-align: center;font-size: 10px;'><b>Não precisa responder, e-mail automático.</b></p>
                        </div>
                    </body>
                    </html>";
                    
        return $email;
    
    }
}