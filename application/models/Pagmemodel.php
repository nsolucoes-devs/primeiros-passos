<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagmemodel extends CI_Model {

    public function insert($dados){
        $this->db->insert('atest', $dados);
    }
    
    public function atualizapedido($id, $dados){
        $this->db->where('idcompra', $id);
        $a = $this->db->get('historicocompras')->row_array();
        
        $a['statusCompra'] = $dados['statusCompra'];
        $a['statusEnvio'] = $dados['statusEnvio'];
        $a['statusPagamento'] = $dados['statusPagamento'];
        $a['codTransacao'] = $dados['codTransacao'];
        $a['dataAlteracao'] = $dados['dataAlteracao'];
        $a['authorization_code'] = $dados['authorization_code'];
        $a['boleto_url'] = $dados['boleto_url'];
        $a['boleto_barcode'] = $dados['boleto_barcode'];
        $a['boleto_expiration_date'] = $dados['boleto_expiration_date'];
        if(array_key_exists('fingerprint', $dados)){
            $a['fingerprint'] = $dados['fingerprint'];
        }
        $this->db->replace('historicocompras', $a);
        
    }
    
    public function updatePedido($id, $dados){
        $this->db->where('codTransacao', $id);
        $a = $this->db->get('historicocompras')->row_array();
        
        $a['codTransacao']              = $dados['codTransacao'];
        $a['fingerprint']               = $dados['fingerprint'];
        $a['statusCompra']              = $dados['statusCompra'];
        $a['statusEnvio']               = $dados['statusEnvio'];
        $a['statusPagamento']           = $dados['statusPagamento'];
        $a['authorization_code']        = $dados['authorization_code'];
        $a['dataAlteracao']             = $dados['dataAlteracao'];
        $a['boleto_url']                = $dados['boleto_url'];
        $a['boleto_barcode']            = $dados['boleto_barcode'];
        $a['boleto_expiration_date']    = $dados['boleto_expiration_date'];
        
        $this->db->replace('historicocompras', $a);
        
        $this->updateHistoricoPedido($a['idcompra'], $dados['historico']);
        
    }
    
    public function resendCompra(){
        $this->db->select('codTransacao');
        $this->db->where('codTransacao !=', 0);
        $this->db->where('formaPagamento', "Boleto");
        $this->db->or_where('codTransacao !=', 0);
        $this->db->where('formaPagamento', "cartao");
        $a = $this->db->get('historicocompras')->result_array();
        return $a;
    }
    
    public function updateHistoricoPedido($id, $historico){
        $this->db->where('historico_pedido_id', $id);
        $this->db->where('historico_comentario', $historico);
        $this->db->limit(1);
        $a = $this->db->get('historico_pedido');
        
        if(!$a){
        
            $dados = array(
                'historico_pedido_id'   => $id,
                'historico_data'        => date('Y-m-d'),
                'historico_hora'        => date('H:i:s'),
                'historico_comentario'  => $historico,
                'historico_status'      => 0,
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
}