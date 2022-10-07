<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginationmodel extends CI_Model {

    public function getParticipantesSorteioGroup2($id, $limit, $start){
        $this->db->select('id_participante, nome_participante, cpf_participante, data_compra, preco_sorteio, forma_pagamento, status_transacao, qtd_titulos, uf');
        $this->db->where('sorteio_id', $id);
        $this->db->group_by('cpf_participante');
        $this->db->order_by('id_participante', 'desc');
        $this->db->limit($limit, $start);
        $participantes = $this->db->get('participantes');
        return $participantes->result_array();
    }

    public function get_count($id) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->where('sorteio_id', $id);
        $a = $this->db->get('participantes')->row_array();
        return $a['pages'];
    }
    
    public function getParticipantesSorteio($id){
        $this->db->where('sorteio_id', $id);
        $participantes = $this->db->get('participantes');
        return $participantes->result_array();
    }
    
    public function resgatasorteio($id){
	    $this->db->where('idpremio', $id );
	    $data = $this->db->get('sorteios');
	    return $data->row_array();
	}

    public function getFormaId($id){
        $this->db->where('id_forma', $id);
        $forma = $this->db->get('formas_pagamento')->row_array();
        return $forma['nome_forma'];
    }
    
    public function getNumerosPreenchidos($id, $cpf){
        
        //SELECT `cpf`, COUNT(*) FROM `sorteio_18` GROUP BY `cpf`
	    $this->db->select('cpf, COUNT(*) as bilhetes');
	    $this->db->where('cpf', $cpf);
	    $this->db->where('cpf IS NOT NULL', null, false);
	    $this->db->group_by('cpf');
	    $a = $this->db->get('sorteio_'. $id)->row_array();
	    if($a == null){
	        return 0;
	    }else{
	        return $a['bilhetes'];
	    }
	}
	
	public function vendas($id){

        $this->db->select("SUM(qtd_titulos) as titulos");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 1);
	    $titulos = $this->db->get('participantes')->row_array();
	    
	    $this->db->select("SUM(qtd_titulos*preco_sorteio) as ttl");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 1);
	    $ttl = $this->db->get('participantes')->row_array();
	    
	    $this->db->select("SUM(qtd_titulos*preco_sorteio) as negado");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 2);
	    $ttlnegado = $this->db->get('participantes')->row_array();
	    
	    if($titulos['titulos'] == null){
	        $titulos['titulos'] = 0;
	    }
	    
	    if($ttl['ttl'] == null){
	        $ttl['ttl'] = 0;
	    }
	    
	    if($ttlnegado['negado'] == null){
	        $ttlnegado['negado'] = 0;
	    }

        $data = array(
	        'titulos'       => $titulos['titulos'],
	        'vlaprovado'    => $ttl['ttl'],
	        'ttlnegado'     => $ttlnegado['negado']
	        );
	        
	    return $data;

	    /*$this->db->select("COUNT(*) as compras");
	    $this->db->where('sorteio_id', $id);
	    $compras = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("COUNT(*) as aprovado");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 1);
	    $aprovado = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("COUNT(*) as negado");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 2);
	    $negado = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("COUNT(*) as estorno");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 3);
	    $estorno = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("COUNT(*) as analise");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 0);
	    $analise = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("COUNT(*) as cancelado");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 5);
	    $cancelados = $this->db->get('participantes')->row_array();*/

	    /*$this->db->select("SUM(qtd_titulos*preco_sorteio) as cancel");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 5);
	    $ttlcancelado = $this->db->get('participantes')->row_array();*/
	    
	    /*$this->db->select("SUM(qtd_titulos*preco_sorteio) as total");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 1);
	    $this->db->or_where('status_transacao', 0);
	    $vltotal = $this->db->get('participantes')->row_array();*/

	    /*if($compras['compras'] == null){
	        $compras['compras'] = 0;
	    }
	    if($aprovado['aprovado'] == null){
	        $aprovado['aprovado'] = 0;
	    }
	    if($negado['negado'] == null){
	        $negado['negado'] = 0;
	    }
	    if($estorno['estorno'] == null){
	        $estorno['estorno'] = 0;
	    }
	    if($analise['analise'] == null){
	        $analise['analise'] = 0;
	    }if($cancelados['cancelado'] == null){
	        $cancelados['cancelado'] = 0;
	    }
	    if($ttlcancelado['cancel'] == null){
	        $ttlcancelado['cancel'] = 0;
	    }
	    if($vltotal['total'] == null){
	        $vltotal['total'] = 0;
	    }*/

	    /*$data = array(
	        'titulos'       => $titulos['titulos'],
	        'compras'       => $compras['compras'],
	        'aprovados'     => $aprovado['aprovado'],
	        'negados'       => $negado['negado'],
	        'estornos'      => $estorno['estorno'],
	        'analise'       => $analise['analise'],
	        'vlaprovado'    => $ttl['ttl'],
	        'canceladas'    => $cancelados['cancelado'],
	        'ttlcancelado'  => $ttlcancelado['cancel'],
	        'vltotal'       => $vltotal['total'],
	        'ttlnegado'     => $ttlnegado['negado']
	        );*/
	}
    
    public function dadosParticipantes($id, $limit, $start){
        //SELECT `nome_participante`, `fone_participante`, `cpf_participante`, `cidade`, `uf` FROM `participantes` WHERE `sorteio_id` = 14
        $this->db->select("nome_participante, fone_participante, cpf_participante, cidade, uf");
        $this->db->where('sorteio_id', $id);
        $this->db->group_by('cpf_participante');
        $this->db->limit($limit, $start);
        $participantes = $this->db->get('participantes');
        return $participantes->result_array();
    }
    
    public function participantesAprovados($id){
        $this->db->select("COUNT(*) as aprovado");
	    $this->db->where('sorteio_id', $id);
	    $this->db->where('status_transacao', 1);
	    $a = $this->db->get('participantes')->row_array();
	    return $a['aprovado'];
    }
    
    public function participantesTotal($id){
        $this->db->select("COUNT(*) as aprovado");
	    $this->db->where('sorteio_id', $id);
	    $a = $this->db->get('participantes')->row_array();
	    return $a['aprovado'];
    }
}