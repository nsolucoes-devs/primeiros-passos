<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque extends CI_Model {
    
    public function getAll(){
        $a = $this->db->get('estoque')->result_array();
        for($i=0; $i<count($a); $i++){
            $this->db->select('nome');
            $this->db->where('id', $a[$i]['estoque_loja']);
    	    $loja = $this->db->get('loja')->row_array();
    	    $a[$i]['estoque_loja'] = mb_strtoupper($loja['nome']);
        }
        return $a;
    }
    
    public function getId($id){
        $this->db->where('estoque_id', $id);
	    return $this->db->get('estoque')->row_array();
    }
    
    public function getNomeProd($nome){
        $this->db->where('estoque_produto', $nome);
        return $this->db->get('estoque')->result_array();
    }
    
    public function update($id, $new){
	    $this->db->where('estoque_id', $id);
	    $this->db->update('estoque', $new);
	    return $this->db->insert_id();
	}
	
	public function insert($new){
	    $this->db->insert('estoque', $new);
	    return $this->db->insert_id();
	}
	
	public function excluir($id){
	    $this->db->where('estoque_id', $id);
        $this->db->delete('estoque');
	}
	
	public function getestoqueByProd($nome){
	    $this->db->where('estoque_produto', $nome);
	    $estoque = $this->db->get('estoque')->row_array();
	    
	    if($estoque != null){
	        return $estoque;
	    }else{
	        return 0;
	    }
	}
	
	public function getEstoquePorLoja($nome){
	    $this->db->select('id, nome');
	    $lojas = $this->db->get('loja')->result_array();
	    foreach($lojas as $i => $loja){
	        $this->db->where('estoque_produto =', $nome);
	        $this->db->where('estoque_loja =', $loja['nome']);
	        $estoques = $this->db->get('estoque')->result_array();
	        $qtd = 0;
	        $ultimo_estoque = null;
	        
	        foreach($estoques as $estoque){
	            $qtd+= $estoque['estoque_quantidade'];
	            $ultimo_estoque = $estoque['estoque_data'];
	            
	        }
	        $lojas[$i]['estoque'] = $qtd;
	        $lojas[$i]['ultimo_estoque'] = $ultimo_estoque;
	        
	    }
	    return $lojas;
	}
	
	 public function getAllEstoqueFiltro($filter, $limit, $start){
        $this->db->select('estoque.*');
        $this->db->like('estoque_data', $filter, 'both');
        $this->db->or_like('estoque_loja', $filter, 'both');
        $this->db->or_like('estoque_produto', $filter, 'both');
        $this->db->or_like('estoque_quantidade', $filter, 'both');
        $this->db->or_like('estoque_valor', $filter, 'both');
        $this->db->or_like('estoque_tipo', $filter, 'both');
        $this->db->order_by('estoque_id', 'desc');
        $this->db->limit($limit, $start);
        $a = $this->db->get('estoque')->result_array();
        
        for($i=0; $i<count($a); $i++){
            $this->db->select('nome');
            $this->db->where('id', $a[$i]['estoque_loja']);
    	    $loja = $this->db->get('loja')->row_array();
    	    $a[$i]['estoque_loja'] = mb_strtoupper($loja['nome']);
        }
        return $a;
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('estoque_produto', $filter, 'both');
        $this->db->or_like('estoque_loja', $filter, 'both');
        $this->db->or_like('estoque_tipo', $filter, 'both');
        $this->db->or_like('estoque_data', $filter, 'both');
        $a = $this->db->get('estoque')->row_array();
        return $a['pages'];
    }
    
    public function getLojas(){
        $this->db->select('id, nome, cidade');
        return $this->db->get('loja')->result_array();
    }
    public function getProdutos(){
        $this->db->select('produto_id, produto_nome, produto_modelo');
        return $this->db->get('produtos')->result_array();
    }
    
    /**Funções feitas por Anderson Moreira em 05/01/2022**/
    public function recuperaEstoque($dados){
        $this->db->select('id, nome');
        $this->db->where('id', $dados['loja']);
	    $loja = $this->db->get('loja')->row_array();
	    
	    $this->db->select('produto_nome, produto_id');
	    $this->db->where('produto_especifico', 0);
	    $this->db->or_where('produto_especifico', 1);
	    $this->db->where('produto_idloja', $loja['id']);
	    $produto = $this->db->get('produtos')->result_array();
        
        $html="";
        $pos = 0;
        foreach($produto as $prt){
            $this->db->select("estoque_valor");
            $this->db->where('estoque_loja =', $loja['id']);
            $this->db->where('estoque_produto =', $prt['produto_nome']);
            $this->db->order_by("estoque_id", 'DESC');
            $valor = $this->db->get('estoque')->row_array();
            if($valor){
                $valor = $valor['estoque_valor'];
            }else{
                $valor = "0,00";
            }
            
            $this->db->select("estoque_id, estoque_data, estoque_produto, sum(estoque_quantidade) as estoque_quantidade, estoque_tipo, estoque_valor");
            $this->db->where('estoque_loja =', $loja['id']);
            $this->db->where('estoque_produto =', $prt['produto_nome']);
            $this->db->group_by("estoque_produto");
            $estoque = $this->db->get('estoque')->row_array();
            if($estoque){
                $estoque = $estoque['estoque_quantidade'];
            }else{
                $estoque = "0";
            }
            
            $html .= "<tr id='line".$pos."'>
                        <td class='text-center'># ".$prt['produto_id']."</td>
                        <td>".$prt['produto_nome']."<input type='hidden' name='item".$pos."' id='item".$pos."' value='".$prt['produto_nome']."'></td>
                        <td>R$ ".$valor."</td>
                        <td>R$ <input type='text' name='newVal".$pos."' id='newVal".$pos."' value='".$valor."' style='width: 100px';></td>
                        <td>".$estoque." unidades</td>
                        <td><input type='text' name='newQtd".$pos."' id='newQtd".$pos."' value='0' style='width: 100px;'> unidades</td>
                        <td id='action".$pos."' ><button type='button' class='btn btn-success' onclick='GravaEstoque(".$pos.")'><i class='fa fa-thumbs-up'></i></button></td>
                    </tr>";
            $pos++;        
        }
        return $html;
        
    }
    
    public function getestoqueAntigo($produto, $loja){
        $this->db->where('estoque_loja =', $loja);
        $this->db->where('estoque_produto =', $produto);
        return $this->db->get('estoque')->row_array();
    }
    
    public function newEstoque($dados){
        $this->db->insert('estoque', $dados);
    }
    
    public function updtEstoque($dados){

        $this->db->where('estoque_produto =', $dados['produto']);
        $this->db->where('estoque_loja =', $dados['loja']);
        $this->db->order_by('estoque_id', 'DESC');
        $a = $this->db->get('estoque')->row_array();
        
        if($a){
            if($dados['movimento'] == "Entrada"){
                $qtd = $dados['newQtd'];
            }elseif($dados['movimento'] == "Ajuste+"){
                $qtd = $dados['newQtd'];
            }elseif($dados['movimento'] == "Ajuste-"){
                $qtd = ($dados['newQtd'] * -1);
            }elseif($dados['movimento'] == "Perda"){
                $qtd = ($dados['newQtd'] * -1);
            }elseif($dados['movimento'] == "Garantia"){
                $qtd = ($dados['newQtd'] * -1);
            }
    
            $a['estoque_quantidade'] = $qtd;
            $a['valor_antigo'] = $a['estoque_valor'];
            $a['estoque_valor'] = $dados['newVal'];
            
            if(array_key_exists("estoque_id", $a)) {
                unset($a['estoque_id']);
            }
        }else{
            if($dados['movimento'] == "Entrada"){
                $qtd = $dados['newQtd'];
            }elseif($dados['movimento'] == "Ajuste"){
                $qtd = $dados['newQtd'];
            }elseif($dados['movimento'] == "Perda"){
                $qtd = ($dados['newQtd'] * -1);
            }elseif($dados['movimento'] == "Garantia"){
                $qtd = ($dados['newQtd'] * -1);
            }
            
            $a = array(
                'estoque_data'      => date('Y-m-d H:i:s'),
                'estoque_loja'      => $dados['loja'],
                'estoque_produto'   => $dados['produto'],
                'estoque_quantidade'=> $qtd,
                'estoque_tipo'      => $dados['movimento'],
                'estoque_valor'     => $dados['newVal'],
                'estoque_desc'      => 0, 
                'valor_antigo'      => 0, 
                );
        }
        
        $this->db->insert('estoque', $a);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        $html = "<td class='text-center'>#Atualizando...</td>
                <td>".$a['estoque_produto']."</td>
                <td>R$ ".$a['estoque_valor']."</td>
                <td>Atualizando...</td>
                <td>".$estoques['estoque_quantidade']." unidades</td>
                <td>Atualizando...</td>
                <td><button type='button' class='btn btn-danger'><i class='fa fa-lock'></i></button></td>";
        
        return $html;
    }
        /**Fim das Funções feitas por Anderson Moreira em 05/01/2022**/
}

