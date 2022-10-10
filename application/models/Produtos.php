<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Model {
    
    // *********************  Site  ********************* //
    /*Funções feitas por Anderson Moreira em 12-01-2022*/
    public function getProdutoSiteRand(){
        $this->db->select("produto_id, produto_nome, produto_modelo, produto_detalhes, produto_imagens_opcional1, produto_imagens_opcional2, produto_imagens_opcional3, produto_imagens_opcional4, produto_imagens_opcional5, produto_tamanhos, produto_cores, produto_variacoes, produto_especifico, produto_idloja, produto_habilitado, produto_departamentos");
        $this->db->order_by('produto_id', 'RANDOM');
        $a = $this->db->get('produtos')->row_array();
        
        $a['tamanhos'] = explode("¬", $a['produto_tamanhos']);
        $a['cores'] = explode("¬", $a['produto_cores']);
        unset($a['produto_tamanhos']);
        unset($a['produto_cores']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        return $a;
    }
    
    public function getProdutoSite($id){
        $this->db->select("produto_id, produto_nome, produto_modelo, produto_detalhes, produto_imagens_opcional1, produto_imagens_opcional2, produto_imagens_opcional3, produto_imagens_opcional4, produto_imagens_opcional5, produto_tamanhos, produto_cores, produto_variacoes, produto_especifico, produto_idloja, produto_habilitado, produto_departamentos, marca_nome as produto_marca");
        $this->db->join('marcas', 'marca.marca_id = produtos.produto_marca_id', 'left');        
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['tamanhos'] = explode("¬", $a['produto_tamanhos']);
        $a['cores'] = explode("¬", $a['produto_cores']);
        unset($a['produto_tamanhos']);
        unset($a['produto_cores']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        return $a;
    }
    
    public function getEstoqueSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();

        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto");
        // $this->db->where('estoque_loja =', 25);
        $this->db->where('estoque_produto =', $a['produto_nome']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        //$estoques['estoque_quantidade'] = 80;
        
        
        return $estoques['estoque_quantidade'];
    }
    
    public function getValorSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $this->db->select("estoque_valor");
        $this->db->where('estoque_produto =', $a['produto_nome']);
        $this->db->order_by("estoque_id", 'DESC');
        $this->db->limit(1);
        $estoques = $this->db->get('estoque')->row_array();
        return $estoques['estoque_valor'];
    }
    
    public function getTamanhosSite($id){
        $this->db->select("produto_tamanhos");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['tamanhos'] = explode("¬", $a['produto_tamanhos']);
        unset($a['produto_tamanhos']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        // $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        
        /*$a = array(
            '0' => "Pequeno",
            '1' => "Medio",
            '2' => "Grande",
            );*/
        
        return $a['tamanhos'];
    }
    
    public function getCoresSite($id){
        $this->db->select("produto_cores");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $a['cores'] = explode("¬", $a['produto_cores']);
        unset($a['produto_cores']);
        
        $this->db->select("sum(estoque_quantidade) as estoque_quantidade, estoque_produto, estoque_loja");
        // $this->db->where('estoque_loja =', $a['estoque_loja']);
        $this->db->where('estoque_produto =', $a['estoque_produto']);
        $this->db->group_by("estoque_produto");
        $estoques = $this->db->get('estoque')->row_array();
        /*$a = array(
            '0' => "Vermelho",
            '1' => "Azul",
            '2' => "Preto",
            );*/
        
        return $a['cores'];
    }
    
    public function getRelacionadoSite($id){
        $this->db->select("produto_nome");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        $rells = explode(" ", $a['produto_nome']);
        $relacionados = array();
        for($i=0; $i<count($rells); $i++){
            $this->db->select("produto_id, produto_nome");
            $this->db->like('produto_nome', $rells[$i]);
            $helper = $this->db->get('produtos')->result_array();
            $relacionados = array_merge($relacionados, $helper);
        }
        $relacionados = array_map("unserialize", array_unique(array_map("serialize", $relacionados)));
        return $relacionados;
    }
    
    public function getPromocaoSite($id, $valor){
        $this->db->select("produto_preco_promocao, produto_preco_promocao_ativo, produto_desconto, produto_desconto_ativo, produto_datainicial_promocao, produto_datafinal_promocao, produto_datafinal_promocao_ativo");
        $this->db->where('produto_id', $id);
        $a = $this->db->get('produtos')->row_array();
        
        if($a['produto_preco_promocao_ativo'] == 1){
            $newPrice = $a['produto_preco_promocao'];
            $desconto = 100 - ($newPrice*100)/$valor;
        }elseif($a['produto_desconto_ativo'] == 1){
            $newPrice = ($valor * (1-($a['produto_desconto']/100)));
            $desconto = $a['produto_desconto'];
        }elseif($a['produto_datafinal_promocao_ativo'] == 1){
            $hoje = date('Y-m-d');
            if($a['produto_datainicial_promocao'] <=  $hoje){
                if($a['produto_datafinal_promocao'] >=  $hoje){
                    $newPrice = ($valor * (1-($a['produto_desconto']/100)));
                    $desconto = $a['produto_desconto'];
                }else{
                    $newPrice = $valor;
                    $desconto = 0;
                }
            }else{
                $newPrice = $valor;
                $desconto = 0;
            }
        }else{
            $newPrice = $valor;
            $desconto = 0;
        }
        
        $promocao = array(
            'precoNovo'     => $newPrice,
            'porcentagem'   => $desconto,
            'valorOriginal' => $valor,
        );
        return $promocao;
    }
    
    public function getDepartamentoLista($lista){
        if(!is_null($lista)){
            if(strpos($lista, "¬")){
                $lista = explode("¬", $lista);
            }else{
                $lista[0] = $lista;
            }
            for($i=0; $i<count($lista); $i++){
                $this->db->select("departamento_nome");
                $this->db->where("departamento_id", $lista[$i]);
                $b = $this->db->get('departamentos')->row_array();
                $a[$i] = $b['departamento_nome'];
            }
            $a = implode(" - ", $a);
            return $a;
        }else{
            return null;
        }
    }
    
    // *********************  Produtos  ********************* 
    
    public function insert($new){
        $this->db->insert('produtos', $new);
        return $this->db->insert_id();
    }
    
    public function update($id, $new){
        $this->db->where('produto_id', $id);
        $this->db->update('produtos', $new);
    }
    
    public function update2($nome, $new){
        $this->db->where('produto_nome', $nome);
        $this->db->update('produtos', $new);
    }
    
    public function getAllProdutosByOpcaoTamanho($id){
        $this->db->like('produto_tamanhos', $id, 'none');
        $this->db->or_like('produto_tamanhos', $id . '¬', 'after');
        $this->db->or_like('produto_tamanhos', '¬' . $id, 'before');
        $this->db->or_like('produto_tamanhos', '¬' . $id. '¬', 'both');
        return $this->db->get('produtos')->result_array();
    }
    
    public function getAllProdutosByOpcaoCor($id){
        $this->db->like('produto_cores', $id, 'none');
        $this->db->or_like('produto_cores', $id . '¬', 'after');
        $this->db->or_like('produto_cores', '¬' . $id, 'before');
        $this->db->or_like('produto_cores', '¬' . $id. '¬', 'both');
        return $this->db->get('produtos')->result_array();
    }
    
    public function getProdNome($nome){
        $this->db->where('produto_nome', $nome);
        return $this->db->get('produtos')->row_array();
    }
    
    public function delete($id){
        $this->db->where('produto_id', $id);
        $this->db->delete('produtos');
    }
    
    public function getAll(){
        return $this->db->get('produtos')->result_array();
    }
    
    public function getAllAleatorio(){
        $this->db->order_by('produto_id', 'random');
        $this->db->limit(4);
        $a = $this->db->get('produtos')->result_array();
        
        for($i=0; $i<count($a); $i++){
            $this->db->where('estoque_produto', $a[$i]['produto_nome']);
            $this->db->order_by('estoque_id', 'DESC');
            $aux = $this->db->get('estoque')->row_array();
            
            $a[$i]['produto_valor'] = $aux['estoque_valor'];
        }
        
        return $a;
    }
    
    public function getAllIndex(){
        $this->db->order_by('produto_id', 'RANDOM');
        $this->db->limit(8);
        $a = $this->db->get('produtos')->result_array();
        
        for($i=0; $i<count($a); $i++){
            $this->db->where('estoque_produto', $a[$i]['produto_nome']);
            $this->db->order_by('estoque_id', 'DESC');
            $aux = $this->db->get('estoque')->row_array();
            $a[$i]['produto_valor'] = $aux['estoque_valor'];
        }
        
        return $a;
    }
    
    public function getAllAtivos(){
        $this->db->where('produto_habilitado', 1);
        return $this->db->get('produtos')->result_array();
    }
    
    public function get($id){
        $this->db->where('produto_id', $id);
        $data = $this->db->get('produtos');
        return $data->row_array();
    }
    
    public function getAtivo($id){
        $this->db->where('produto_habilitado', 1);
        $this->db->where('produto_id', $id);
        $data = $this->db->get('produtos')->row_array();
        
        $this->db->where('estoque_produto', $data['produto_nome']);
        $this->db->order_by('estoque_id', 'DESC');
        $a = $this->db->get('estoque')->row_array();
        
        $data['produto_valor'] = $a['estoque_valor'];
        
        return $data;
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('produtos')->row_array();
        return $a['pages'];
    }
    
    public function getAllProdutos($limit, $start){
        $this->db->select('produto_id, produto_nome, produto_modelo, produto_quantidade, produto_valor, produto_habilitado');
        $this->db->order_by('produto_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('produtos');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->join('status', 'produtos.produto_habilitado = status.status_id');
        $this->db->like('produto_nome', $filter, 'both');
        $this->db->or_like('produto_modelo', $filter, 'both');
        $this->db->or_like('produto_quantidade', $filter, 'both');
        $this->db->or_like('produto_valor', $filter, 'both');
        $this->db->or_like('produto_habilitado', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $a = $this->db->get('produtos')->row_array();
        return $a['pages'];
    }
    
    public function getAllProdutosFiltro($filter, $limit, $start){
        $this->db->select('produto_id, produto_nome, produto_modelo, produto_quantidade, produto_valor, produto_habilitado');
        $this->db->join('status', 'produtos.produto_habilitado = status.status_id');
        $this->db->like('produto_nome', $filter, 'both');
        $this->db->or_like('produto_modelo', $filter, 'both');
        $this->db->or_like('produto_quantidade', $filter, 'both');
        $this->db->or_like('produto_valor', $filter, 'both');
        $this->db->or_like('produto_habilitado', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $this->db->order_by('produto_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('produtos');
        return $data->result_array();
    }
    
    // *********************  Solicitação  ********************* 
    
    public function insertSolicitacao($new){
        $this->db->insert('solicitacoes', $new);
    }

    public function getAllSolicitacoes(){
        $this->db->select('solicitacoes.solitacao_id, solicitacoes.solicitacao_nome, solicitacoes.solicitacao_empresa, solicitacoes.solicitacao_empresa, solicitacoes.solicitacao_cnpj, solicitacoes.solicitacao_status, status_solicitacoes.status_nome, status_solicitacoes.status_id');
        $this->db->join('status_solicitacoes', 'solicitacoes.solicitacao_status = status_solicitacoes.status_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function getSolicitacao($id){
        $this->db->where('solicitacao_id', $id);
        $data = $this->db->get('solicitacoes');
        return $data->row_array();
    }
    
    public function updateSolicitacao($id, $new){
        $this->db->where('solicitacao_id', $id);
        $this->db->update('solicitacoes', $new);
    }
    
    public function get_countSolicitacoes() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('solicitacoes')->row_array();
        return $a['pages'];
    }
    
    public function getAllSolicitacoesPagination($limit, $start){
        $this->db->select('solicitacao_id, solicitacao_nome, solicitacao_empresa, solicitacao_cnpj, solicitacao_status');
        $this->db->limit($limit, $start);
        $data = $this->db->get('solicitacoes');
        return $data->result_array();
    }
    
    public function get_countSolicitacoesFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('solicitacao_nome', $filter, 'both');
        $this->db->or_like('solicitacao_empresa', $filter, 'both');
        $this->db->or_like('solicitacao_cnpj', $filter, 'both');
        $this->db->or_like('solicitacao_status', $filter, 'both');
        $a = $this->db->get('solicitacoes')->row_array();
        return $a['pages'];
    }
    
    public function getAllSolicitacoesPaginationFiltro($filter, $limit, $start){
        $this->db->select('solicitacao_id, solicitacao_nome, solicitacao_empresa, solicitacao_cnpj, solicitacao_status');
        $this->db->join('status_solicitacoes', 'solicitacoes.solicitacao_status = status_solicitacoes.status_id');
        $this->db->like('solicitacao_nome', $filter, 'both');
        $this->db->or_like('solicitacao_empresa', $filter, 'both');
        $this->db->or_like('solicitacao_cnpj', $filter, 'both');
        $this->db->or_like('solicitacao_status', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $this->db->order_by('solicitacao_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('solicitacoes');
        return $data->result_array();
    }
    
    public function relatorioEstoqueFiltros($filtros){
        
        if($filtros['departamentos'] != ""){
            $this->db->select('departamento_id, departamento_nome');
    	    $this->db->where_in('departamento_id', $filtros['departamentos']);
    	    $departamentos_name = $this->db->get('departamentos')->result_array();
        }
        if(count($departamentos_name) > 1){
            for($aux = 0; $aux < count($departamentos_name); $aux++) {
                if($aux == 1) {
                    $dados['departamentos'] = $departamentos_name[$aux]['departamento_nome'];
                } else {
                    $dados['departamentos'] .= ', '. $departamentos_name[$aux]['departamento_nome'];
                }
            }
        } elseif(count($departamentos_name) == 1) {
            $dados['departamentos'] = $departamentos_name[0]['departamento_nome'];
        }
        
        $this->db->select('id, nome');
        $this->db->where('id', $filtros['loja']);
	    $loja = $this->db->get('loja')->row_array();
	    $dados['loja'] = $loja;
	    
	    $this->db->select('produto_nome, produto_id, produto_valor, produto_departamentos');
	    $this->db->where('produto_especifico', 0);
	    $this->db->or_where('produto_especifico', 1);
	    $this->db->where('produto_idloja', $loja['id']);
	    $produto = $this->db->get('produtos')->result_array();
	    $dados['produtos'] = $produto;
        
        $html="";
        $cont = 0;
        $valor = [];
        foreach($produto as $prt){
            $this->db->select("estoque_valor");
            $this->db->where('estoque_loja', $loja['id']);
            $this->db->where('estoque_produto', $prt['produto_nome']);
            $this->db->order_by("estoque_id", 'DESC');
            $valor = $this->db->get('estoque')->row_array();
            
            
            if($valor){
                $dados['produtos'][$cont]['valor_produto'] = $valor['estoque_valor'];
            }else{
                $dados['produtos'][$cont]['valor_produto'] = "0.00";
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
            $dados['produtos'][$cont]['estoque'] = $estoque;
            
            if($filtros['departamentos'] != ""){
                if($prt['produto_departamentos'] != ""){
                     if(strpos($prt['produto_departamentos'], '¬')){
                        $prt['produto_departamentos'] = explode('¬', $prt['produto_departamentos']);
                    } else {
                        $prt['produto_departamentos'] = array('0' => $prt['produto_departamentos'],);
                    }
                } else {
                    $prt['produto_departamentos'][0] = array();
                }
               $verific = 0;
               for($aux = 0; $aux < count($filtros['departamentos']); $aux++){
                   if(in_array($filtros['departamentos'][$aux], $prt['produto_departamentos'])){
                       $verific = 1;
                   } 
               }
                if($verific == 0){
                    unset($dados['produtos'][$cont]); 
                    unset($prt); 
                }
            }
            $cont++;
        }
        
        return $dados;
        
    }
    
    // *********************   ANDAMENTOS  ********************* 
    //  ------- GETS ------- 
    public function getAndamento($id){
        $this->db->where('andamento_id', $id);
        $data = $this->db->get('andamentos');
        return $data->row_array();
    }   
    
    public function getAllAndamento($id){
        $this->db->where('andamento_solicitacao_id', $id);
        $data = $this->db->get('andamentos');
        return $data->result_array();
    }
    
    // ------- INSERTS ------- 
    public function insertAndamento($new){
        $this->db->insert('andamentos', $new);
    }
    
    // ------- UPDATES ------- 
    public function updateAndamento($id, $new){
        $this->db->where('andamento_id', $id);
        $this->db->update('andamentos', $new);
    }
    
    //  ------- DELETE ------- 
    public function deleteAndamento($id){
        $this->db->where('andamento_id', $id);
        $this->db->delete('andamentos');
    }
    
    //*************  Consultas  *******************
    public function getProdutoAdd($id){
        $this->db->select('produto_id, produto_nome, produto_modelo, produto_valor');
        $this->db->where('produto_id', $id);
        $data = $this->db->get('produtos')->row_array();
        
        $data['produto_valor'] = number_format($data['produto_valor'],2,',','.');
        
        return $data;
    }
    
    ////////////////////////////////// BUSCA /////////////////////////////////

    public function get_countBuscaFiltro($categoria, $filter) {
        $cont = 0;
        if($categoria == 'P'){
            $this->db->select('COUNT(*) as pages');
            $this->db->like('produto_nome', $filter);
            $produtos = $this->db->get('produtos')->row_array();
            return $produtos['pages'];
        } else if($categoria == 'D'){
            $produtos = $this->db->get('produtos')->result_array();
            foreach($produtos as $p){
                $aux_p = explode('¬', $p['produto_departamentos']);
                foreach($aux_p as $ap){
                    $this->db->where('departamento_id', $ap);
                    $departamento = $this->db->get('departamentos')->row_array();
                    if($departamento){
                       if($departamento['departamento_id'] == $filter){
                            $cont++;
                        } 
                    }
                }
            }
        }
        else if($categoria == 'S'){
            $produtos = $this->db->get('produtos')->result_array();
            foreach($produtos as $p){
                $aux_p = explode('¬', $p['produto_departamentos']);
                foreach($aux_p as $ap){
                    $this->db->where('departamento_id', $ap);
                    $departamento = $this->db->get('departamentos')->row_array();
                    if($departamento){
                        $aux_d = explode('¬', $departamento['departamento_sub_id']);
                        foreach($aux_d as $ad){
                            $this->db->where('subdepartamento_id', $ad);
                            $sub = $this->db->get('subdepartamentos')->row_array();
                            if($sub){
                                if($sub['subdepartamento_id'] == $filter){
                                    $cont++;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        return $cont;
    }
    
    public function getAllBuscaFiltro($categoria, $filter, $limit, $start){
        $array = [];
        $cont = 0;
        
        if($categoria == 'P'){
            $this->db->like('produto_nome', $filter);
            $this->db->limit($limit, $start);
            return $this->db->get('produtos')->result_array();
        } else if($categoria == 'D'){
            $produtos = $this->db->get('produtos')->result_array();
            foreach($produtos as $p){
                $aux_p = explode('¬', $p['produto_departamentos']);
                foreach($aux_p as $ap){
                    $this->db->where('departamento_id', $ap);
                    $departamento = $this->db->get('departamentos')->row_array();
                    if($departamento){
                        if($departamento['departamento_id'] == $filter){
                            $array[$cont] = array(
                                'produto_id'                        => $p['produto_id'],
                                'produto_nome'                      => $p['produto_nome'],
                                'produto_departamentos'             => $p['produto_departamentos'],
                                'produto_ativo_atacado'             => $p['produto_ativo_atacado'],
                                'produto_datainicial_promocao'      => $p['produto_datainicial_promocao'],
                                'produto_datafinal_promocao_ativo'  => $p['produto_datafinal_promocao_ativo'],
                                'produto_cupom_ativo'               => $p['produto_cupom_ativo'],
                                'produto_preco_promocao_ativo'      => $p['produto_preco_promocao_ativo'],
                                'produto_desconto_ativo'            => $p['produto_desconto_ativo'],
                                'produto_valor'                     => $p['produto_valor'],
                            );
                            $cont++;
                        }
                    }
                }
            }
        } else if($categoria == 'S'){
            $produtos = $this->db->get('produtos')->result_array();
            foreach($produtos as $p){
                $aux_p = explode('¬', $p['produto_departamentos']);
                foreach($aux_p as $ap){
                    $this->db->where('departamento_id', $ap);
                    $departamento = $this->db->get('departamentos')->row_array();
                    if($departamento){
                        $aux_d = explode('¬', $departamento['departamento_sub_id']);
                        foreach($aux_d as $ad){
                            $this->db->where('subdepartamento_id', $ad);
                            $sub = $this->db->get('subdepartamentos')->row_array();
                            if($sub){
                                if($sub['subdepartamento_id'] == $filter){
                                    $array[$cont] = array(
                                        'produto_id'                        => $p['produto_id'],
                                        'produto_nome'                      => $p['produto_nome'],
                                        'produto_departamentos'             => $p['produto_departamentos'],
                                        'produto_ativo_atacado'             => $p['produto_ativo_atacado'],
                                        'produto_datainicial_promocao'      => $p['produto_datainicial_promocao'],
                                        'produto_datafinal_promocao_ativo'  => $p['produto_datafinal_promocao_ativo'],
                                        'produto_cupom_ativo'               => $p['produto_cupom_ativo'],
                                        'produto_preco_promocao_ativo'      => $p['produto_preco_promocao_ativo'],
                                        'produto_desconto_ativo'            => $p['produto_desconto_ativo'],
                                        'produto_valor'                     => $p['produto_valor'],
                                    );
                                    $cont++;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $array2 = [];
        $cont2 = 0;
        
        for($i = $start; $i < count($array); $i++){
            
            $array2[$cont2] = $array[$i];
            $cont2++;
            
            if($i == ($limit + $start) - 1){
                break;
            }
        }
        return $array2;
    }
    
    /*************************************
    **************************************
    * FUNÇÕES DE BUSCA E PAGINAÇÃO NOVAS *
    **************************************
    **************************************/
    
    public function retrieveBusca($buscaKey, $start, $stop){
        /*$this->db->where('produto_habilitado', 1);
        $busca = explode(" ", $buscaKey);
        $this->db->where('produto_nome LIKE', '%'.$busca[0].'%');    
        for($i=1; $i<count($busca); $i++){
            $this->db->or_where('produto_nome LIKE', '%'.$busca[$i].'%');    
        }
        $this->db->limit($stop, $start);
        $this->db->order_by('produto_id', 'DESC');
        $a = $this->db->get('produtos')->result_array();
        return $a;
        */
        $this->db->select('produto_id');
        $this->db->where('produto_habilitado', 1);
        $this->db->like('produto_nome', $buscaKey, 'none');
        $this->db->or_like('produto_nome', $buscaKey, 'after');
        $this->db->or_like('produto_nome', $buscaKey, 'before');
        $this->db->or_like('produto_nome', $buscaKey, 'both');
        $this->db->limit($stop, $start);
        $this->db->order_by('produto_id', 'DESC');
        $a = $this->db->get('produtos')->result_array();
        $contador = 0;
        $prod = array();
        foreach($a as $a){
            $b = $this->getProdutoSite($a['produto_id']);
            $c = $this->getValorSite($a['produto_id']);
            $d = $this->getPromocaoSite($a['produto_id'], $c);
            $e = $this->getDepartamentoLista($a['produto_departamentos']);
            
            print_r($a['produto_departamentos']);

    	    $prod[$contador] = array(
    	        'produto_id'            => $b['produto_id'],
    	        'produto_nome'          => $b['produto_nome'],
                'produto_departamento'  => $e,
                'produto_valor'         => $d['precoNovo'],
    	        );
            
            if($d['valorOriginal'] != $d['precoNovo']){
                $prod[$contador]['produto_promocao']     = $d['valorOriginal'];
                $prod[$contador]['produto_porcentagem']  = $d['porcentagem'];
            }
            
            $contador++;
        }
        
        return $prod;
    }
    
    public function retrieveDepartamento($termo, $start, $stop){
        $this->db->where('produto_habilitado', 1);
        $this->db->like('produto_departamentos', $termo, 'none');
        $this->db->or_like('produto_departamentos', $termo.'¬', 'after');
        $this->db->or_like('produto_departamentos', '¬'.$termo, 'before');
        $this->db->or_like('produto_departamentos', '¬'.$termo.'¬', 'both');
        $this->db->limit($stop, $start);
        $a = $this->db->get('produtos')->result_array();
        
        for($i=0; $i<count($a); $i++){
            $this->db->where('estoque_produto', $a[$i]['produto_nome']);
            $this->db->order_by('estoque_id', 'DESC');
            $aux = $this->db->get('estoque')->row_array();
            
            $a[$i]['produto_valor'] = $aux['estoque_valor'];
        }
        
        return $a;
    }
    
    public function countBusca($termo){
        $busca = explode(" ", $termo);
        $this->db->select("COUNT('produto_id') as count");
        $this->db->where('produto_nome LIKE', '%'.$busca[0].'%');    
        for($i=1; $i<count($busca); $i++){
            $this->db->or_where('produto_nome LIKE', '%'.$busca[$i].'%');    
        }
        $a = $this->db->get('produtos')->row_array();
        return $a;
    }
    
    public function countDepartamento($termo){
        //SELECT COUNT(`produto_id`) FROM `produtos` WHERE `produto_departamentos` LIKE '%12%'
        $this->db->select("COUNT('produto_id') as count");
        $this->db->like('produto_departamentos', $termo, 'none');
        $this->db->or_like('produto_departamentos', $termo.'¬', 'after');
        $this->db->or_like('produto_departamentos', '¬'.$termo, 'before');
        $this->db->or_like('produto_departamentos', '¬'.$termo.'¬', 'both');
        return $this->db->get('produtos')->row_array();
    }
}