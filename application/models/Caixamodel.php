<?php

class Caixamodel extends CI_Model  {
    
    //FUNÇÃO PARA PEGAR O CAIXA ABERTO DO BANCO DE DADOS
    public function pegarCaixaAberto(){
        $this->db->where('fechamento_caixa', null);
        $caixas = $this->db->get('caixa');
        return $caixas->result_array();
    }
    
    //FUNÇÃO PARA PEGAR OS CAIXAS ABERTOS DO BANCO DE DADOS
    //SELECT * FROM `caixa` WHERE `fechamento_caixa` is null OR `reabertura_data` IS NOT null AND`refechamento_data` is NULL
    public function pegarCaixasAbertos(){
        $this->db->where('fechamento_caixa', null);
        $this->db->order_by('id_caixa', "DESC");
        $caixas = $this->db->get('caixa')->row_array();
        
        for($i=0; $i< count($caixas); $i++){
            $this->select('nome');
            $this->db->where('id', $caixas[$i]['loja_id']);
            $a = $this->db->get('caixa')->row_array();
            $caixas[$i]['loja_id'] = $a['nome'];
        }
        return $caixas;
    }
    
    public function pegarCaixasAbertos2(){
        $this->db->where('fechamento_caixa !=', null);
        $this->db->where("reabertura_data !=", null);        
        $this->db->where("refechamento_data", null);
        $caixas = $this->db->get('caixa');
        return $caixas->result_array();
    }
    
    //FUNÇÃO PARA PEGAR O CAIXA ABERTO DE UMA LOJA ESPECÍFICA DO BANCO DE DADOS
    public function pegarCaixaAbertoLoja($idLoja){
        if($idLoja != 0){
            $this->db->where('loja_id', $idLoja);
            $this->db->where('fechamento_caixa', null);
        }
        $caixas = $this->db->get('caixa')->result_array();
        
        return $caixas;
    }
    
    public function pegarCaixaAbertoLoja2($idLoja){
        if($idLoja != 0){
            $this->db->where('loja_id', $idLoja);
            $this->db->where('fechamento_caixa !=', null);
            $this->db->where("reabertura_data !=", null);
            $this->db->where("refechamento_data", null);
        }
        $caixas = $this->db->get('caixa');
        return $caixas->result_array();
    }
    
    //função para pegar o caixa da loja e data
    public function pegarCaixaLojaData($idLoja, $data){
        $this->db->where('loja_id', $idLoja);
        $this->db->where('abertura_caixa', $data);
        $caixas = $this->db->get('caixa');
        return $caixas->row_array();
    }
    
    //FUNÇÃO PARA PEGAR O CAIXA ABERTO COM BASE NO ID DO BANCO DE DADOS
    public function pegarCaixaAbertoId($id){
        $this->db->where('id_caixa', $id);
        $this->db->where('fechamento_caixa', null);
        $caixas = $this->db->get('caixa');
        return $caixas->row_array();
    }
    
    public function pegarCaixaAbertoId2($id){
        $this->db->where('id_caixa', $id);
        $this->db->where('fechamento_caixa !=', null);
        $this->db->where("reabertura_data !=", null);
        $this->db->where("refechamento_data", null);
        $caixas = $this->db->get('caixa');
        return $caixas->row_array();
    }
    
    //FUNÇÃO PARA PEGAR CAIXA UNICO COM BASE NO ID E NA DATA
    public function pegarCaixaUnicoData($id, $data){
        $this->db->where('id_caixa', $id);
        $this->db->where('abertura_caixa', $data);
        $caixa = $this->db->get('caixa');
        return $caixa->row_array();
    }
    
    public function pegarCaixaUnicoData2($id, $data){
        $this->db->where('id_caixa', $id);
        $this->db->where('reabertura_data', $data);
        $caixa = $this->db->get('caixa');
        return $caixa->row_array();
    }
    
    //FUNÇÃO PARA PEGAR CAIXA UNICO
    public function pegarCaixaUnico($id){
        $this->db->where('id_caixa', $id);
        $caixa = $this->db->get('caixa');
        return $caixa->row_array();
    }
    
    //FUNÇÃO PARA PEGAR AS SANGRIAS
    public function pegarSangrias($id){
        $this->db->where('caixa_id', $id);
        $caixas = $this->db->get('sangria');
        return $caixas->result_array();
    }
    
    //FUNÇÃO PARA PEGAR AS SANGRIAS pela data
    public function pegarSangriasData($dt){
        $this->db->where('data_sangria', $dt);
        $sangrias = $this->db->get('sangria');
        return $sangrias->result_array();
    }
    
    //função que retorna todas as sangrias
    public function getSangrias(){
        $san = $this->db->get('sangria');
        
        return $san->result_array();
    }
    
    //FUNÇÃO PARA ABRIR UM NOVO CAIXA
    public function abrirCaixa($valor, $limite){
        $caixa = array(
            'abertura_caixa' => date('d/m/Y'),
            'funcionario_id' => $this->session->userdata('id_pessoa'),
            'troco_inicial' => $valor,
            'troco_atual' => $valor,
            'loja_id' => $this->session->userdata('loja_id'),
            'limite_caixa' => $limite
        );
        
	    $this->db->insert('caixa', $caixa);
	    $caixaid = $this->db->insert_id();
	   
		return $caixaid;
	}
	
	//FUNÇÃO PARA ABRIR UM NOVO CAIXA
    public function abrirCaixa2($valor, $limite, $loja){
        $caixa = array(
            'abertura_caixa' => date('d/m/Y'),
            'funcionario_id' => $this->session->userdata('id_pessoa'),
            'troco_inicial' => $valor,
            'troco_atual' => $valor,
            'loja_id' => $loja,
            'limite_caixa' => $limite
        );
        
	    $this->db->insert('caixa', $caixa);
	    $caixaid = $this->db->insert_id();
	   
		return $caixaid;
	}
	
	//FUNÇÃO PARA FECHAR UM CAIXA
	public function fecharCaixa($id, $caixa){
	    $caixa['fechamento_caixa'] = date('d/m/Y');
	    
	    $this->db->where('id_caixa', $id);
	    $update = $this->db->update('caixa', $caixa);
	    
	    return $update;
	}
	
	public function fecharCaixa2($id, $caixa){
	    $caixa['refechamento_data'] = date('d/m/Y');
	    
	    $this->db->where('id_caixa', $id);
	    $update = $this->db->update('caixa', $caixa);
	    
	    return $update;
	}
	
	//FUNÇÃO PARA ADICIONAR SANGRIA
	public function adicionarSangria($sangria, $troco, $id){
	    $this->db->insert('sangria', $sangria);
	    $sangriaid = $this->db->insert_id();
	    $this->atualizarTroco($troco, $id);
	   
		return $sangriaid;
	}
	
	//FUNÇÃO QUE VAI ATUALIZAR O TROCO ATUAL COM BASE NO VALOR DA SANGRIA
	public function atualizarTroco($troco, $id){
	    $this->db->where('id_caixa', $id);
	    $update = $this->db->update('caixa', $troco);
	}
	
	//função que vai pegar as devoluções de um caixa
	public function getDevoCaixa($id){
	    $this->db->where('caixa_id', $id);
	    $devos = $this->db->get('devolucao_caixa');
        return $devos->result_array();
	}
	
	//função que vai inserir uma nova devolução no bd
    public function insertDevo($devo){
        $this->db->insert('devolucao_caixa', $devo);
        $id = $this->db->insert_id();
        
        return $id;
    }
    
    //função que vai inserir o produto de uma devolução
    public function insertProd($prod){
        $this->db->insert('item_devolucao_caixa', $prod);
        $id = $this->db->insert_id();
        
        return $id;
    }
    
    //função que vai retornar uma unica devolução
    public function getDevoUnica($id){
        $this->db->where('id_dc', $id);
        $devo = $this->db->get('devolucao_caixa');
        
        return $devo->row_array();
    }
    
    public function getDevoCliente($id){
        $this->db->where('cliente_id', $id);
        $devo = $this->db->get('devolucao_caixa');
        
        return $devo->result_array();
    }
    
    //função que vai retornar os itens de uma devolução
    public function getItensDevo($id){
        $this->db->where('dc_id', $id);
        $devo = $this->db->get('item_devolucao_caixa');
        
        return $devo->result_array();
    }
    
    //função que vai editar uma devolução
    public function updateDevo($id, $devo){
        $this->db->where('id_dc', $id);
	    $update = $this->db->update('devolucao_caixa', $devo);
	    
	    return $update;
    }
    
    //função que vai retornar um item expecifico
    public function getItem($id){
        $this->db->where('id_idc', $id);
        $devo = $this->db->get('item_devolucao_caixa');
        
        return $devo->row_array();
    }
    
    //função que exclui um item
    public function deleteItem($id){
        $this->db->where('id_idc', $id);
	    $this->db->delete('item_devolucao_caixa');
    }
    
    public function getCaixaFechados($id){
        $this->db->where('fechamento_caixa !=', null);
        $this->db->where('reabertura_data', null);
        $this->db->where('loja_id', $id);
        $this->db->order_by('abertura_caixa', 'ASC');
	    $aux = $this->db->get('caixa');
	    return $aux->result_array();
    }
    
    public function getTodosCaixasFechados(){
        $this->db->where('fechamento_caixa !=', null);
        $this->db->where('reabertura_data', null);
        $this->db->order_by('abertura_caixa', 'ASC');
	    $aux = $this->db->get('caixa');
	    return $aux->result_array();
    }
    
    public function updateCaixaFechados($id, $motivo, $funcionario){
        $this->db->where('id_caixa', $id);
        $aux = $this->db->get('caixa')->row_array();
        
        $retorno = array(
            'abertura_caixa' =>$aux['abertura_caixa'],
            'fechamento_caixa' =>$aux['fechamento_caixa'],
            'funcionario_id' =>$aux['funcionario_id'],
            'troco_inicial' =>$aux['troco_inicial'],
            'troco_atual' =>$aux['troco_atual'],
            'loja_id' =>$aux['loja_id'],
            'limite_caixa' =>$aux['limite_caixa'],
            'reabertura_data' =>date('d/m/Y'),
            'motivo' =>$motivo,
            'reabertura_funcionario_id' =>$funcionario,
            );
        
        $this->db->where('id_caixa', $id);
        $this->db->update('caixa', $retorno);
        
    }
    
    public function loja($id=null){
        if($id!= null){
            $this->db->where("id", $id);
        }
        $a =  $this->db->get('loja');
        return $a->result_array();
    }
    
    public function caixas(){
        $this->db->select('abertura_caixa as abertura, loja_id as loja, funcionario_id as funcionario');
        $a = $this->db->get('caixa')->result_array();
        
        for($i = 0; $i<count($a); $i++){
            $this->db->where('id', $a[$i]['loja']);
            $b = $this->db->get('loja')->row_array();
            $a[$i]['loja'] = $b['nome'];
            
            $this->db->where('id', $a[$i]['funcionario']);
            $c = $this->db->get('funcionarios')->row_array();
            $a[$i]['funcionario'] = $c['nome_funcionario'];
        }
        return $a;
    }
    public function formasCash($id){
        $dateI = date('Y-m-d 00:00:00');
        $dateF = date('Y-m-d 23:59:59');
        
        $this->db->select('sum(valorCompra) as valor, formaPagamento as forma');
        $this->db->where('dataCompra >', $dateI);
        $this->db->where('dataCompra <', $dateF);
        $this->db->where('loja_id', $id);    
        $this->db->group_by('formaPagamento');
        $a = $this->db->get('historicocompras')->result_array();
        
        for($i=0; $i<count($a); $i++){
            $a[$i]['forma'] = str_replace("Venda Loja -", "", $a[$i]['forma']);
        }
        
        return $a;
    }
}