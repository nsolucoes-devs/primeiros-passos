<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formaspagamento extends CI_Model {
    
    public function getFormas(){
        $formas = $this->db->get('formas_pagamento');
        return $formas->result_array();
    }
    
    public function getFormasAtivo(){
        $this->db->where('ativo_forma', 1);
        $formas = $this->db->get('formas_pagamento');
        return $formas->result_array();
    }
    
    public function getStatuscompras(){
        $this->db->select('idStatusCompra, nomeStatusCompra');
        $this->db->where('tipoStatusCompra', 'Pagamento');
        $status = $this->db->get('statuscompras');
        return $status->result_array();
    }
    
    public function getFormaId($id){
        $this->db->where('id_forma', $id);
        $forma = $this->db->get('formas_pagamento');
        return $forma->row_array();
    }
    
    public function get($nome){
        $this->db->where('nome_forma', $nome);
        return $this->db->get('formas_pagamento')->row_array();
    }
    
    public function atualizaHistorico($reference, $notificationCode, $status){
        $this->db->where('idcompra', $reference);
        $a = $forma = $this->db->get('historicocompras')->row_array();
        
        $a['codTransacao'] = $notificationCode;
        
        $a['statusCompra'] = $status;
        
        $this->db->replace('historicocompras', $a);
    }
    
    public function update($nome, $new){
        $this->db->where('nome_forma', $nome);
        $this->db->update('formas_pagamento', $new);
    }
    
    public function updatenew($new, $id){
    
    $teste = $this->db->get('formas_pagamento')->result_array();
        
    $cont = 0;
    $verific = 0;
    foreach($new as $forma) {
        
        for($aux=0; $aux < count($teste); $aux++) {
            if($id[$cont] == $teste[$aux]['id_forma']){
                
                $this->db->where('id_forma', $id[$cont]);
                $this->db->update('formas_pagamento', $forma);
                $verific++;
            } 
        }
        if($verific == 0 ) {
            $this->db->insert('formas_pagamento', $forma);
        }
        $cont++;
    }
    }
    
}