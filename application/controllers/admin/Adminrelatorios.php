<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminrelatorios extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('comprasmodel');
        $this->load->model('produtos');
        $this->load->model('carrinhomodel');
        $this->load->model('configs');
        $this->load->model('clientes');
        $this->load->model('usuarios');
        $this->load->model('lojasmodel');
        $this->load->model('funcionariosmodel');
        $this->load->model('correiosmodel');
    }
    
    public function relatorios(){
        $this->load->model('estados');
        $this->load->model('formaspagamento');
        
        $data['produtos'] = $this->produtos->getAll();
        $data['clientes'] = $this->clientes->getAll();
        $data['usuarios'] = $this->usuarios->getAll();
        $data['lojas'] = $this->lojasmodel->getlojas();
        $data['formasdepagamento']  = $this->formaspagamento->getFormasAtivo();
        $data['statuscompra']       = $this->formaspagamento->getStatuscompras();
        $data['estados'] = $this->estados->getEstados();
        
        $this->header(4);
        $this->load->view('restrito/relatorio', $data);
        $this->footer();
    }
    
    public function relatoriosloja(){
        $this->load->model('formaspagamento');
        $this->load->model('departamentos');
        
        $data['produtos'] = $this->produtos->getAll();
        $data['clientes'] = $this->clientes->getAll();
        $data['usuarios'] = $this->usuarios->getAll();
        $data['departamentos']  = $this->departamentos->getAll();
        $data['lojas'] = $this->lojasmodel->getlojas();
        $data['funcionarios'] = $this->funcionariosmodel->getFuncionariosS();
        $data['formasdepagamento'] = $this->formaspagamento->getFormasAtivo();
        $data['statuscompra'] = $this->formaspagamento->getStatuscompras();
        
        $data['sessao'] = $this->session->userdata();
        
        
       $this->header(8);
        $this->load->view('restrito/relatorioloja', $data);
        $this->footer();
    }
    
    public function gerarRelatorioPedidos(){
        if($this->input->post('filtro-pedido') == 's'){
            if($this->input->post('datainicio')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio')));
                
                // $datainicio = $this->input->post('datainicio');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim')));
                
                // $datafim = $this->input->post('datafim');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            
            $filtros = array(
                'estado'                => $this->input->post('estado'),
                'produto'               => $this->input->post('produto'),    
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
                'status'                => $this->input->post('status'),
                'forma_pagamento'       => $this->input->post('forma_pagamento'),
            );
            
            $this->pedidosDetalhadoFiltros($filtros);
        } else {
            $this->pedidosDetalhado();    
        }
    }
    
    public function gerarRelatorioVendas(){
        if($this->input->post('datainicio9')){
            $datainicio = date('Y-m-d 00:00:00', strtotime($this->input->post('datainicio9')));
        } else {
            $datainicio = date('Y-m-d 00:00:00');
        }
        if($this->input->post('datafim9')){
            $datafim = date('Y-m-d 23:59:59', strtotime($this->input->post('datafim9')));
        } else {
            $datafim = date('Y-m-d 23:59:59');
        }
        if($this->input->post('formadp')){
            $forma = $this->input->post('formadp');
        } else {
            $forma = null;
        }
        
        if($this->input->post('filterSale')){
            $status = $this->input->post('filterSale');
        } else {
            $status = null;
        }
        
        $filtros = array(    
            'datainicio'    => $datainicio,
            'datafim'       => $datafim,
            'forma'         => $forma,
            'status'         => $status,
            'loja'          => $this->input->post('loja'),
        );
        
        $this->vendaFiltros($filtros);
    }
    
     public function vendaFiltros($filtros){
        $data['pedidos'] = $this->comprasmodel->relatorioVendas($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        $data['configs'] = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/vendas', $data);
    }
    
    public function gerarRelatorioProdutos(){
        if($this->input->post('filtro-pedido2') == 's'){
            if($this->input->post('datainicio2')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio2')));
                // $datainicio = $this->input->post('datainicio2');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim2')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim2')));
                // $datafim = $this->input->post('datafim2');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            $filtros = array(
                'estado'                => $this->input->post('estado2'),
                'produto'               => $this->input->post('produto2'),    
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
                'status'                => $this->input->post('status2'),
                'forma_pagamento'       => $this->input->post('forma_pagamento2'),
            );
            
            $this->vendasprodutoFiltros($filtros);
        } else {
            $this->vendasproduto();    
        }
    }
    
    public function gerarRelatorioPedidosSintetico(){
        if($this->input->post('filtro-pedido3') == 's'){
            if($this->input->post('datainicio3')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio3')));
                
                // $datainicio = $this->input->post('datainicio3');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim3')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim3')));
                
                // $datafim = $this->input->post('datafim3');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            $filtros = array(
                'estado'                => $this->input->post('estado3'),
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
                'status'                => $this->input->post('status3'),
                'forma_pagamento'       => $this->input->post('forma_pagamento3'),
            );
            
            $this->pedidoSinteticoFiltros($filtros);
        } else {
            $this->pedidoSintetico();    
        }
    }
    
    public function gerarRelatorioFuncionario(){
        
        if($this->input->post('filtro-pedido10') == 's'){
            if($this->input->post('datainicio10')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio10')));
            } else {
                $datainicio = date("Y-m-d 00:00:00");
            }
            
            if($this->input->post('datafim10')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim10')));
            } else {
                $datafim = date("Y-m-d 23:59:59");
            }
            
            $filtros = array(
                'id_usuario'            => $this->input->post('funcionario'),
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
            );
            $this->funcionarioFiltros($filtros);
        }
    }
    
    public function funcionarioFiltros($filtros){
        
        
        if($filtros['id_usuario']){
            $data['pedidos'] = $this->comprasmodel->relatorioFuncionario($filtros);
        } else {
            $data['pedidos'] = $this->comprasmodel->relatorioFuncionarios($filtros);
        }
        
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        $data['configs'] = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/comissao', $data);
    }
    
    public function gerarRelatorioGerente(){
        
        if($this->input->post('filtro-pedido11') == 's'){
            if($this->input->post('datainicio11')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio11')));
                
                // $datainicio = $this->input->post('datainicio11');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = date('Y-m-1 00:00:00');  //date("Y-m-d 00:00:00");
            }
            
            if($this->input->post('datafim11')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim11')));
                
                // $datafim = $this->input->post('datafim11');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = $datafim = date("Y-m-d 23:59:59");
            }
            
            if($_POST['funcionario']){
                $idfuncionario = $this->input->post('funcionario');
                $loja = null;
            } else {
                $idfuncionario = null;
                $loja = $this->input->post('loja');
            }
            
            $filtros = array(
                'id_funcionario'    => $idfuncionario,
                'loja'              => $loja,
                'datainicio'        => $datainicio,
                'datafim'           => $datafim,
            );
            $this->GerenteFiltros($filtros);
        } else {
              
        }
    }
    
    public function GerenteFiltros($filtros){
        $data['pedidos'] = $this->comprasmodel->relatorioGerente($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        $data['configs'] = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/comissao', $data);
    }
    
    public function gerarRelatorioClienteSintetico(){
        if($this->input->post('filtro-pedido5') == 's'){
            if($this->input->post('datainicio5')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio5')));
                
                // $datainicio = $this->input->post('datainicio5');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim5')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim5')));
                
                // $datafim = $this->input->post('datafim5');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            $filtros = array(
                'estado'                => $this->input->post('estado5'),
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
            );
            
            $this->clienteSinteticoFiltros($filtros);
        } else {
            $this->clienteSintetico();    
        }
    }
    
    public function gerarRelatorioClientes(){
        if($this->input->post('filtro-pedido4') == 's'){
            if($this->input->post('datainicio4')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio4')));
                
                // $datainicio = $this->input->post('datainicio4');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim4')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim4')));
                
                // $datafim = $this->input->post('datafim4');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            
            $filtros = array(
                'estado'                => $this->input->post('estado4'),
                'cliente'               => $this->input->post('cliente'),    
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
                'status'                => $this->input->post('status4'),
                'forma_pagamento'       => $this->input->post('forma_pagamento4'),
            );
            
            $this->clienteDetalhadoFiltros($filtros);
        } else {
            $this->clienteDetalhado();    
        }
    }
    
    public function gerarRelatorioFrete(){
        if($this->input->post('filtro-pedido6') == 's'){
            if($this->input->post('datainicio6')){
                $datainicio = date("Y-m-d 00:00:00", strtotime($this->input->post('datainicio6')));
                
                // $datainicio = $this->input->post('datainicio6');
                // $datainicio = $datainicio . ' 00:00:00';
            } else {
                $datainicio = null;
            }
            
            if($this->input->post('datafim6')){
                $datafim = date("Y-m-d 23:59:59", strtotime($this->input->post('datafim6')));
                
                // $datafim = $this->input->post('datafim6');
                // $datafim = $datafim . ' 23:59:59';
            } else {
                $datafim = null;
            }
            
            $filtros = array(
                'datainicio'            => $datainicio,
                'datafim'               => $datafim,
            );
            
            $this->freteFiltros($filtros);
        } else {
            $this->frete();    
        }
    }
    
    public function frete(){
        $data['fretes']    = $this->correiosmodel->relatorioFrete();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/frete', $data);
    }
    
    public function freteFiltros($filtros){
        $data['fretes'] = $this->correiosmodel->relatorioFreteFiltros($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        $data['filtros']    = array(
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
        );
        
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/frete', $data);
    }
    
    public function clienteDetalhado(){

        $data['clientes']   = $this->clientes->relatorioClientesDetalhado();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/clientedetalhado', $data);
    }
    
    public function clienteDetalhadoFiltros($filtros){

        $data['clientes']    = $this->clientes->relatorioClientesDetalhadoFiltros($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        if($filtros['status'] != null || $filtros['status'] != ""){
            $status = $this->carrinhomodel->getStatus($filtros['status']);    
        } else {
            $status = null;
        }
        
        $data['filtros']    = array(
            'estado'            =>  $filtros['estado'],
            'cliente'           =>  $this->clientes->get($filtros['cliente']),
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
            'status'            =>  $status,
            'forma_pagamento'   =>  $filtros['forma_pagamento'],
        );
        
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/clientedetalhado', $data);
    }
    
    public function clienteSintetico(){

        $data['clientes']    = $this->clientes->relatorioClientes();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/clientesintetico', $data);
    }
    
    public function clienteSinteticoFiltros($filtros){

        $data['clientes'] = $this->clientes->relatorioClientesFiltros($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        $data['filtros']    = array(
            'estado'            =>  $filtros['estado'],
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
        );
        
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/clientesintetico', $data);
    }
    
    public function pedidosDetalhado(){
        $data['pedidos']    = $this->comprasmodel->relatorioPedidosDetalhado();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/pedidosdetalhado', $data);
    }
    
    public function pedidosDetalhadoFiltros($filtros){
        
        $data['pedidos']    = $this->comprasmodel->relatorioPedidosDetalhadoFiltros($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y 00:00:00', strtotime($filtros['datainicio']));
        } else {
            $datainicio = date("Y-m-d 00:00:00");
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y 23:59:59', strtotime($filtros['datafim']));
        } else {
            $datafim = date("Y-m-d 23:59:59");
        }
        
        if($filtros['status'] != null || $filtros['status'] != ""){
            $status = $this->carrinhomodel->getStatus($filtros['status']);    
        } else {
            $status = null;
        }
        
        $data['filtros']    = array(
            'estado'            =>  $filtros['estado'],
            'produto'           =>  $this->produtos->get($filtros['produto']),
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
            'status'            =>  $status,
            'forma_pagamento'   =>  $filtros['forma_pagamento'],
        );
        
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/pedidosdetalhado', $data);
    }
    
    public function pedidoSintetico(){

        
        $data['pedidos'] = $this->comprasmodel->relatorioPedidos();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/pedidosintetico', $data);
    }
    
    public function pedidoSinteticoFiltros($filtros){

        
        $data['pedidos'] = $this->comprasmodel->relatorioPedidosFiltros($filtros);
        
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        if($filtros['status'] != null || $filtros['status'] != ""){
            $status = $this->carrinhomodel->getStatus($filtros['status']);    
        } else {
            $status = null;
        }
        
        $data['filtros']    = array(
            'estado'            =>  $filtros['estado'],
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
            'status'            =>  $status,
            'forma_pagamento'   =>  $filtros['forma_pagamento'],
        );
        
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/pedidosintetico', $data);
    }
    
    public function entrega(){

        
        $id = $this->uri->segment(4);
        
        $data['pedido'] = $this->comprasmodel->pedido($id);
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/entrega', $data);
    }
    
    public function vendasproduto(){

        
        $data['produtos'] = $this->comprasmodel->relatorioVendasProdutosDetalhado();
        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/vendasproduto', $data);
    }
    
    public function vendasprodutoFiltros($filtros){

        
        $data['produtos']   = $this->comprasmodel->relatorioVendasProdutosDetalhadoFiltros($filtros);
        if($filtros['datainicio']){
            $datainicio = date('d/m/Y', strtotime($filtros['datainicio']));
        } else {
            $datainicio = null;
        }
        
        if($filtros['datafim']){
            $datafim = date('d/m/Y', strtotime($filtros['datafim']));
        } else {
            $datafim = null;
        }
        
        if($filtros['status'] != null || $filtros['status'] != ""){
            $status = $this->carrinhomodel->getStatus($filtros['status']);    
        } else {
            $status = null;
        }
        
        
        $data['filtros']    = array(
            'estado'            =>  $filtros['estado'],
            'produto'           =>  $this->produtos->get($filtros['produto']),
            'datainicio'        =>  $datainicio,
            'datafim'           =>  $datafim,
            'status'            =>  $status,
            'forma_pagamento'   =>  $filtros['forma_pagamento'],
        );

        $data['configs']    = $this->configs->getSite();
        
        $this->load->view('restrito/relatorios/vendasproduto', $data);
    }

    public function gerarRelatorioEstoque(){
        if($_POST['filtro-pedido7'] == 's'){
            $filtros['ordem'] = $_POST['ordenar'];
        }else{
            $filtros['ordem'] = $_POST['ordenar'];
        }
        if(isset($_POST['loja'])){
            $filtros['loja'] = $_POST['loja'];
        }
        if(isset($_POST['departamentos'])){
            $filtros['departamentos'] = $_POST['departamentos'];
        }
        
        $this->estoqueFiltros($filtros);
    }
    
    public function estoque(){
        $data = array(
            'estoque'    => $this->produtos->getAll(),
            'configs'    => $this->configs->getSite(),
            'verific'    => 1,
        );
        $this->load->view('restrito/relatorios/estoque', $data);
    }
    
    public function estoqueFiltros($filtros){
        
        $dados = $this->produtos->relatorioEstoqueFiltros($filtros);
        
        $data = array(
            'estoque'       => $dados['produtos'],
            'configs'       => $this->configs->getSite(),
            'nome_loja'     => $dados['loja']['nome'],
            'filtros'       => $filtros,
            'departamentos' => $dados['departamentos'],
            'verific'       => 2,
        );
        $this->load->view('restrito/relatorios/estoque', $data);
    }
    
}