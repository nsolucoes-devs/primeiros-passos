<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mercadopagomodel extends CI_Model {
    
    public function retrieveClient($id){
        $this->db->select('cliente_id, cliente_nome, cliente_cpf, cliente_email');
        $this->db->where('cliente_id', $id);
        return $this->db->get('cliente')->row_array();
    }
    
    public function retrieveCompra($id){
        $this->db->select('valorCompra');
        $this->db->where('idcompra', $id);
        return $this->db->get('historicocompras')->row_array();
    }
    
    public function lojaDados(){
        return $this->db->get('site')->row_array();
    }
    
    public function finishHim($dados, $id){
        
        $this->db->where('idcompra', $id);
        $a = $this->db->get('historicocompras')->row_array();
        
        $a['codTransacao']              = $dados['codTransacao'];
        $a['statusCompra']              = $dados['statusCompra'];
        $a['statusEnvio']               = $dados['statusEnvio'];
        $a['statusPagamento']           = $dados['statusPagamento'];
        $a['authorization_code']        = $dados['authorization_code'];
        $a['dataAlteracao']             = $dados['dataAlteracao'];
        $a['boleto_url']                = $dados['boleto_url'];
        $a['boleto_barcode']            = $dados['boleto_barcode'];
        $a['boleto_expiration_date']    = $dados['boleto_expiration_date'];
        
        $this->db->replace('historicocompras', $a);
        
        $this->updateHistoricoPedido($a['idcompra'], $dados['historico'], $dados['statusPagamento']);
        
    }
    
    public function updateHim($dados){
        
        $this->db->where('codTransacao', $dados['codTransacao']);
        $a = $this->db->get('historicocompras')->row_array();
        
        $a['statusCompra']              = $dados['statusCompra'];
        $a['statusEnvio']               = $dados['statusEnvio'];
        $a['statusPagamento']           = $dados['statusPagamento'];
        $a['authorization_code']        = $dados['authorization_code'];
        $a['dataAlteracao']             = $dados['dataAlteracao'];
        $a['boleto_url']                = $dados['boleto_url'];
        $a['boleto_barcode']            = $dados['boleto_barcode'];
        $a['boleto_expiration_date']    = $dados['boleto_expiration_date'];
        
        $this->db->replace('historicocompras', $a);
        
        $this->mercadopagomodel->updateHistoricoPedido($a['idcompra'], $dados['historico'], $dados['statusPagamento']);
        
    }
    
    public function updateHistoricoPedido($id, $historico, $status){
        $this->db->where('historico_pedido_id', $id);
        $this->db->where('historico_comentario', $historico);
        $this->db->limit(1);
        $a = $this->db->get('historico_pedido')->row_array();
        
        if(!$a){
        
            $dados = array(
                'historico_pedido_id'   => $id,
                'historico_data'        => date('Y-m-d'),
                'historico_hora'        => date('H:i:s'),
                'historico_comentario'  => $historico,
                'historico_status'      => $status,
                'historico_notificar'   => 1,
            );
            $this->db->insert('historico_pedido', $dados);
        }
    }
    
    public function updateCompras(){
        $this->db->select('codTransacao');
        $this->db->where('codTransacao !=', 0);
        $this->db->where('formaPagamento', "Boleto");
        $this->db->or_where('formaPagamento', "cartao");
        $a = $this->db->get('historicocompras')->result_array();
        return $a;
    }
    
    public function giveUp(){
        //SELECT * FROM `historicocompras` WHERE `statusCompra` = 1 AND `dataCompra` < CURRENT_DATE-7 ORDER BY `idcompra` DESC
        $date = strtotime("-7 day");
        $day =  date('M d, Y', $date);
        
        $this->db->where('statusCompra', 1);
        $this->db->where('dataCompra <', $day);
        $this->db->order_by('idcompra', 'DESC');
        $a = $this->db->get('historicocompras')->result_array();

        
        foreach($a as $abandono){
            $abandono['statusCompra'] = 28;
            $abandono['statusEnvio'] = 27;
            $abandono['statusPagamento'] = 29; 
            $abandono['dataAlteracao'] = date('Y-m-d H:i:s');
            
            $this->db->replace('historicocompras', $abandono);
            $this->updateHistoricoPedido($abandono['idcompra'], "Pedido Cancelado devido à não realização do pagamento.", 29);
        }
        
    }
}