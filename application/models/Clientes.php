<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Model {
    
    public function cadastraPdv($dados){
        if(!empty($dados)){
        $dados = array(        
            'cliente_nome'          => $dados['nome'],
            'cliente_cpf'           => $dados['cpf'],
            'cliente_senha'         => null,
            'cliente_nascimento'    => null,
            'cliente_cep'           => $dados['cep'],
            'cliente_endereco'      => $dados['logra'],
            'cliente_numero'        => $dados['endnum'],
            'cliente_cidade'        => $dados['cidade'],
            'cliente_bairro'        => null,
            'cliente_estado'        => $dados['estado'],
            'cliente_email'         => $dados['email'],
            'cliente_telefone'      => $dados['telefone'],
            'cliente_genero'        => null,
            'cliente_ativo'         => 1,
            'cliente_complemento'   => null,
            'cliente_datacadastro'  => date("Y-m-d"),
            'cliente_loja'          => $dados['loja'],
        );
        $this->db->insert("cliente", $dados);
        
        $this->db->where('cliente_id', $this->db->insert_id);
        return $this->db->get('cliente');
        }else{
            return null;
        }
        return $dados;
        
    }
    
    public function insert($new){
        $this->db->insert('cliente', $new);
        return $this->db->insert_id();
    }
    
    public function update($id, $new){
        $this->db->where('cliente_id', $id);
        $this->db->update('cliente', $new);
    }
    
    public function getCEP($cep){
        $this->db->where('cep', $cep);
        return $this->db->get('cep')->row_array();
    }
    
    public function excluirCliente($id){
        $this->db->where('cliente_id', $id);
        $this->db->delete('cliente');
    }
    
    public function get($id){
        $this->db->where('cliente_id', $id);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getNumero($id){
        $this->db->select('cliente_numero');
        $this->db->where('cliente_id', $id);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getClienteById($id){
        $this->db->select('cliente_id, cliente_nome, cliente_cpf, cliente_telefone, cliente_email');
        $this->db->where('cliente_id', $id);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getAll(){
        $data = $this->db->get('cliente');
        return $data->result_array();
    }
    
    public function getCPF($login){
        $this->db->where('cliente_cpf', $login);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getSenha($senha){
        $this->db->where('cliente_senha', $senha);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getSenhaLogin($login, $senha){
        $this->db->where('cliente_cpf', $login);
        $this->db->where('cliente_senha', $senha);
        $data = $this->db->get('cliente');
        return $data->row_array();
    }
    
    public function getAllClientes($limit, $start){
        $this->db->select('cliente_id, cliente_nome, cliente_cpf, cliente_cidade, cliente_email, cliente_telefone, cliente_ativo, cliente_loja');
        $this->db->order_by('cliente_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('cliente');
        return $data->result_array();
    }
    
    public function get_count() {
        $this->db->select(" COUNT(*) as pages");
        $a = $this->db->get('cliente')->row_array();
        return $a['pages'];
    }
    
    public function getAllClientesFiltro($filter, $limit, $start){
        $this->db->select('cliente_id, cliente_nome, cliente_cpf, cliente_cidade, cliente_email, cliente_telefone, cliente_ativo');
        $this->db->join('status_cliente', 'cliente.cliente_ativo = status_cliente.status_id');
        $this->db->like('cliente_nome', $filter, 'both');
        $this->db->or_like('cliente_cpf', $filter, 'both');
        $this->db->or_like('cliente_cidade', $filter, 'both');
        $this->db->or_like('cliente_email', $filter, 'both');
        $this->db->or_like('cliente_telefone', $filter, 'both');
        $this->db->or_like('cliente_ativo', $filter, 'both');
        $this->db->or_like('status_nome', $filter, 'both');
        $this->db->order_by('cliente_id', 'desc');
        $this->db->limit($limit, $start);
        $data = $this->db->get('cliente');
        return $data->result_array();
    }
    
    public function get_countFiltro($filter) {
        $this->db->select(" COUNT(*) as pages");
        $this->db->like('cliente_nome', $filter, 'both');
        $this->db->or_like('cliente_cpf', $filter, 'both');
        $this->db->or_like('cliente_cidade', $filter, 'both');
        $this->db->or_like('cliente_email', $filter, 'both');
        $this->db->or_like('cliente_telefone', $filter, 'both');
        $this->db->or_like('cliente_ativo', $filter, 'both');
        $a = $this->db->get('cliente')->row_array();
        return $a['pages'];
    }
    
    public function relatorioClientes(){
        return $this->db->get('cliente')->result_array();
    }
    
    public function relatorioClientesFiltros($filtros){
        if($filtros['datainicio']){
            $this->db->where('cliente_datacadastro >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('cliente_datacadastro <=', $filtros['datafim']);
        }
        if($filtros['estado']){
            $this->db->where('cliente_estado', $filtros['estado']);
        }
        return $this->db->get('cliente')->result_array();
    }
    
    public function relatorioClientesDetalhado(){
        $todosclientes = $this->db->get('cliente')->result_array();
        
        $clientes = [];
        $cont_clientes = 0;
        $totalgeral = 0;
        
        foreach($todosclientes as $c){
            $this->db->where('idClient', $c['cliente_id']);
            $historico = $this->db->get('historicocompras')->result_array();
            
            $pedidos_clientes = [];
            $cont_pedido = 0;
            
            foreach($historico as $h){
                $produtos = [];
                $cont_produtos = 0;
                
                $aux_produtos = explode('¬', $h['listProdutosId']);
                $aux_quantidade = explode('¬', $h['qtdProdutos']);
                $aux_valor = explode('¬', $h['vlrProdutos']);
                
                foreach($aux_produtos as $p){
                    $this->db->select('produto_id, produto_nome, produto_codigo, produto_modelo');
                    $this->db->where('produto_id', $p);
                    $produto = $this->db->get('produtos')->row_array();
                    
                    $produtos[$cont_produtos] = array(
                        'produto_codigo'    => $produto['produto_codigo'],
                        'produto_nome'      => $produto['produto_nome'],
                        'produto_modelo'    => $produto['produto_modelo'],
                        'produto_valor'     => $aux_valor[$cont_produtos],
                        'produto_quantidade'=> $aux_quantidade[$cont_produtos],
                        
                    );
                    $cont_produtos++;
                }
                
                $totalgeral = $totalgeral + (($h['valorCompra'] + $h['valorFrete']) - $h['desconto']);
                
                $this->db->where('idStatusCompra', $h['statusPagamento']);
                $status = $this->db->get('statuscompras')->row_array();
                
                $pedidos_clientes[$cont_pedido] = array(
                    'idpedido'  => $h['idcompra'],    
                    'dataCompra'=> $h['dataCompra'],   
                    'produtos'  => $produtos,
                    'status'    => $status['nomeStatusCompra'],
                    'forma'     => $h['formaPagamento'],
                    'total'     => $h['valorCompra'],
                    'frete'     => $h['valorFrete'],
                    'desconto'  => $h['desconto'],
                );
                $cont_pedido++;
            }
            
            $clientes[$cont_clientes] = array(
                'cliente_nome'          => $c['cliente_nome'],
                'cliente_cpf'           => $c['cliente_cpf'],
                'cliente_endereco'      => $c['cliente_endereco'],
                'cliente_numero'        => $c['cliente_numero'],
                'cliente_complemento'   => $c['cliente_complemento'],
                'cliente_bairro'        => $c['cliente_bairro'],
                'cliente_cep'           => $c['cliente_cep'],
                'cliente_cidade'        => $c['cliente_cidade'],
                'cliente_estado'        => $c['cliente_estado'],
                'cliente_email'         => $c['cliente_email'],
                'cliente_telefone'      => $c['cliente_telefone'],
                'cliente_datacadastro'  => $c['cliente_datacadastro'],
                'pedidos'               => $pedidos_clientes,
            );
            $cont_clientes++;
        }
        
        $data['clientes']   = $clientes;
        $data['totalgeral'] = $totalgeral; 
        
        return $data;
    }
    
    
    
    
    
    
    
    public function relatorioClientesDetalhadoFiltros($filtros){
        if($filtros['datainicio']){
            $this->db->where('cliente_datacadastro >=', $filtros['datainicio']);
        }
        if($filtros['datafim']){
            $this->db->where('cliente_datacadastro <=', $filtros['datafim']);
        }
        if($filtros['estado']){
            $this->db->where('cliente_estado', $filtros['estado']);
        }
        if($filtros['cliente']){
            $this->db->where('cliente_id', $filtros['cliente']);
        }
        
        $todosclientes = $this->db->get('cliente')->result_array();
        
        $clientes = [];
        $cont_clientes = 0;
        $totalgeral = 0;
        
        foreach($todosclientes as $c){
            if($filtros['forma_pagamento']){
                $this->db->where('formaPagamento', $filtros['forma_pagamento']);
            }
            if($filtros['status']){
                $this->db->where('statusPagamento', $filtros['status']);    
            }
            $this->db->where('idClient', $c['cliente_id']);
            $historico = $this->db->get('historicocompras')->result_array();
            
            $pedidos_clientes = [];
            $cont_pedido = 0;
            
            foreach($historico as $h){
                $produtos = [];
                $cont_produtos = 0;
                
                $aux_produtos = explode('¬', $h['listProdutosId']);
                $aux_quantidade = explode('¬', $h['qtdProdutos']);
                $aux_valor = explode('¬', $h['vlrProdutos']);
                
                foreach($aux_produtos as $p){
                    $this->db->select('produto_id, produto_nome, produto_codigo, produto_modelo');
                    $this->db->where('produto_id', $p);
                    $produto = $this->db->get('produtos')->row_array();
                    
                    if($produto){
                        $produtos[$cont_produtos] = array(
                            'produto_codigo'    => $produto['produto_codigo'],
                            'produto_nome'      => $produto['produto_nome'],
                            'produto_modelo'    => $produto['produto_modelo'],
                            'produto_valor'     => $aux_valor[$cont_produtos],
                            'produto_quantidade'=> $aux_quantidade[$cont_produtos],
                        );
                        $cont_produtos++;
                    }
                }
                
                $totalgeral = $totalgeral + (($h['valorCompra'] + $h['valorFrete']) - $h['desconto']);
                
                $this->db->where('idStatusCompra', $h['statusPagamento']);
                $status = $this->db->get('statuscompras')->row_array();
                
                $pedidos_clientes[$cont_pedido] = array(
                    'idpedido'  => $h['idcompra'],    
                    'dataCompra'=> $h['dataCompra'],  
                    'status'    => $status['nomeStatusCompra'],
                    'forma'     => $h['formaPagamento'],
                    'produtos'  => $produtos,
                    'total'     => $h['valorCompra'],
                    'frete'     => $h['valorFrete'],
                    'desconto'  => $h['desconto'],
                );
                $cont_pedido++;
            }
            
            $clientes[$cont_clientes] = array(
                'cliente_nome'          => $c['cliente_nome'],
                'cliente_cpf'           => $c['cliente_cpf'],
                'cliente_endereco'      => $c['cliente_endereco'],
                'cliente_numero'        => $c['cliente_numero'],
                'cliente_complemento'   => $c['cliente_complemento'],
                'cliente_cep'           => $c['cliente_cep'],
                'cliente_bairro'        => $c['cliente_bairro'],
                'cliente_cidade'        => $c['cliente_cidade'],
                'cliente_estado'        => $c['cliente_estado'],
                'cliente_email'         => $c['cliente_email'],
                'cliente_telefone'      => $c['cliente_telefone'],
                'cliente_datacadastro'  => $c['cliente_datacadastro'],
                'pedidos'               => $pedidos_clientes,
            );
            $cont_clientes++;
        }
        
        $data['clientes']   = $clientes;
        $data['totalgeral'] = $totalgeral; 
        
        return $data;
    }
    
}