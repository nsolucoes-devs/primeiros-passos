<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Completarcadastro extends MY_Controller {
    
    public function pagamentos(){
        $this->load->database();
        $this->load->model('clientes');
        $this->load->model('comprasmodel');
        
        $historico = $this->comprasmodel->getAllGuiExcluir();
        foreach($historico as $h){
            $c = $this->clientes->get($h['idClient']);
            
            $cliente = array(
                'clienteNome'           =>  $c['cliente_nome'],
                'clienteEmail'          =>  $c['cliente_email'],
                'clienteCPF'            =>  $c['cliente_cpf'],
                'clienteTelefone'       =>  $c['cliente_telefone'],
                'clienteNascimento'     =>  $c['cliente_nascimento'],
                'clienteRua'            =>  $c['cliente_endereco'],
                'clienteCidade'         =>  $c['cliente_cidade'],
                'clienteBairro'         =>  $c['cliente_bairro'],
                'clienteEstado'         =>  $c['cliente_estado'],
                'clienteComplemento'    =>  $c['cliente_complemento'],
            );
        }
        
    }
    
    public function cadastrarCliente(){
        $this->load->database();
        $this->load->model('clientes');
        $data = $this->clientes->cadastraPdv($_POST);
        echo json_encode($data);
    }
    
    
}