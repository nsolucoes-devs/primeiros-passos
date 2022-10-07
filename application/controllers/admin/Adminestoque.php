<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminestoque extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('estoque');
        $this->load->model('produtos');
        $this->load->model('lojasmodel');
    }
    
    public function estoques(){
        $data['estoques'] = $this->estoque->getAll();
        $data['lojas']    = $this->lojasmodel->getlojas();
        $data['produtos'] = $this->produtos->getAll();
        
        $this->load->library("pagination");
        $filtro = $this->input->post('filtro');
        $filtro = mb_strtoupper($filtro);
        
        if($this->uri->segment(2) == 'f'){
            $filtro = strtoupper(urldecode($this->uri->segment(3))); 
        }
        
        if($filtro != ' '){
            $config = array();
            $config["base_url"] = base_url('admin/adminestoque/filtro/' . $filtro . '/');
            $config["total_rows"] = $this->estoque->get_countFiltro($filtro);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
            $data['estoques']  = $this->estoque->getAllEstoqueFiltro($filtro,1000, $page);
            $data['filtro']    = $filtro;
            
        } else {
            $config = array();
            $config["base_url"] = base_url('admin/adminestoque/filtro/' . $filtro . '/');
            $config["total_rows"] = $this->estoque->get_countFiltro();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            
            $this->pagination->initialize($config);
            
            $data['links'] = $this->pagination->create_links();
            
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $data['estoques'] = $this->estoque->getAll();
        }
        
        $this->header(8);
        $this->load->view('restrito/estoques', $data);
        $this->footer();
    }
    
    public function cadastroEstoque(){
        $data = array(
            'estoques' => $this->estoque->getAll(),
            'produtos' => $this->estoque->getProdutos(),
            'lojas'    =>$this->estoque->getLojas(),
        );
        $this->header(8);
        $this->load->view('restrito/estoque', $data);
        $this->footer();
    }
    
    public function verEstoque(){ /*=====================================NOVO=======================================*/
        
        
        $data = array(
            'estoques' => $this->estoque->getAll(),
            'produtos' => $this->estoque->getProdutos(),
            'lojas'    =>$this->estoque->getLojas(),
            'flag'      =>1,
            );
        
        $this->header(8);
        $this->load->view('restrito/estoque', $data);
        $this->footer();
    }
    
    public function editaEstoque(){ /*=====================================NOVO=======================================*/
        
        $data = array(
            'estoques' => $this->estoque->getAll(),
            'produtos' => $this->estoque->getProdutos(),
            'lojas'    => $this->lojasmodel->getLojas(),
        );

        $this->header(8);
        $this->load->view('restrito/estoque', $data);
        $this->footer();
    }
    
    /*
    public function filtraestoque(){
        
        
        $data['estoques'] = $this->estoque->getAll();
        $data['lojas']    = $this->lojasmodel->getlojas();
        $data['produtos'] = $this->produtos->getAll();
        
        $this->header(2);
        $this->load->view('restrito/estoques', $data);
        $this->footer();
    }*/
    
    //Funções Estoque
    
    public function getestoqueid(){
        $this -> include();
        
        $a = $this->estoque->getId($this->input->post('estoque'));
        
        echo json_encode($a);
    }
    
    public function editestoque(){
        $this -> include();
        
        $id = $this->input->post('id_estoque');
        
        $add       = $this->input->post('add_estoque_edit');
        
        $new = array(
            'estoque_data'          => $this->input->post('data2'),
            'estoque_loja'          => $this->input->post('loja_estoque_edit'),
            'estoque_quantidade'    => $this->input->post('qtd_estoque_edit') + $add,
            'estoque_tipo'          => $this->input->post('tipo_estoque_edit'),
            'estoque_valor'         => $this->input->post('novovalor_estoque_edit'),
            'estoque_desc'          => $this->input->post('detalhe-edit'),
        );
        
        $this->estoque->update($id, $new);
        
        $estoque = $this->estoque->getId($id);
        
        $estoques = $this->estoque->getNomeProd($estoque['estoque_produto']);
        $produtos = $this->produtos->getProdNome($estoque['estoque_produto']);
        $prodid   = $produtos['produto_id'];
        $quantidade = 0;
        
        foreach($estoques as $est){
            $quantidade = $quantidade + $est['estoque_quantidade'];
        }
        
        $new2 = array(
            'produto_quantidade' => $quantidade,
            'produto_valor'      => $this->input->post('novovalor_estoque_edit'),
        );
        
        $this->produtos->update($prodid, $new2);
        
        redirect(base_url('admin/adminestoque/estoques'));
    }
    
    public function cadestoque(){
        $this -> include();
        
        $new = array(
            'estoque_data'          => $this->input->post('data1'),
            'estoque_tipo'          => $this->input->post('tipo_estoque_cad'),
            'estoque_loja'          => $this->input->post('loja_estoque_cad'),
            'estoque_quantidade'    => $this->input->post('addqtd_estoque_cad'),
            'estoque_produto'       => $this->input->post('prod_estoque_cad'),
            'estoque_valor'         => $this->input->post('novovalor_estoque_cad'),
            'estoque_desc'          => $this->input->post('detalhe-cad'),
            'valor_antigo'          => $this->input->post('valor-antigo'),
        );
        
        $this->estoque->insert($new);
        
        $estoques = $this->estoque->getNomeProd($this->input->post('prod_estoque_cad'));
        $produtos = $this->produtos->getProdNome($this->input->post('prod_estoque_cad'));
        $prodid   = $produtos['produto_id'];
        $quantidade = 0;
        
        foreach($estoques as $est){
            $quantidade = $quantidade + $est['estoque_quantidade'];
        }
        
        $new2 = array(
            'produto_quantidade' => $quantidade,
            'produto_valor' => $this->input->post('novovalor_estoque_cad'),   
        );
        
        $this->produtos->update($prodid, $new2);
        
        redirect(base_url('admin/adminestoque/estoques'));
    }
    
    public function excluirestoque(){
        
        
        $id = $this->input->post('estoque-excluir');
        
        //Salvar quantidade
        $estoque = $this->estoque->getId($id);
        $quantidade = $estoque['estoque_quantidade']; 
        
        //Identificar produto
        $produto     = $this->produtos->getProdNome($estoque['estoque_produto']);
        
        //Quantidade salva no produto
        $quantidadeProd = $produto['produto_quantidade'];
        
        //Array novo para quantidade;
        $new = array(
            'produto_quantidade' => $quantidadeProd - $quantidade,
            'produto_valor'      => $estoque['valor_antigo'],
        );
        
        //Update Produto
        $this->produtos->update($produto['produto_id'], $new);
        
        $this->estoque->excluir($id);
        
        redirect(base_url('admin/adminestoque/estoques'));
    }
    
    public function getestoqueprod(){
        
        
        $produto = $this->input->post('produto');
        $a    = $this->estoque->getestoqueByProd($produto);
        $prod = $this->produtos->getProdNome($produto);
        
        $a['estoque_quantidade'] = $prod['produto_quantidade'];
        $a['estoque_valor']      = number_format($prod['produto_valor'], 2, ',', '.');
        
        echo json_encode($a);
    }
    
    //Funções estoque dentro de produto
    
    public function Prodaddestoque(){
        
        
        $estoque = array(
            'estoque_produto'    => mb_strtoupper($this->input->post('produto')),
            'estoque_tipo'       => $this->input->post('tipo'),    
            'estoque_loja'       => $this->input->post('loja'),
            'estoque_quantidade' => $this->input->post('quantidade'),
            'estoque_valor'      => $this->input->post('valor'),
            'estoque_data'       => $this->input->post('data'),
            'estoque_desc'       => $this->input->post('desc'),
        );
        
        $id = $this->estoque->insert($estoque);
        
        $new2 = array(
            'produto_valor' => $this->input->post('valor'),   
        );
        
        $this->produtos->update2($this->input->post('produto'), $new2);
        
        $data = date('d-m-y h:i:s', strtotime($this->input->post('data')));
        
        $array = array(
            'estoque_id'         => $id,
            'estoque_tipo'       => $this->input->post('tipo'),    
            'estoque_loja'       => $this->input->post('loja'),
            'estoque_quantidade' => $this->input->post('quantidade'),
            'estoque_valor'      => $this->input->post('valor'),
            'estoque_data'       => $data,
        );
        
        echo json_encode($array);
    }
    
    public function Prodeditaestoque(){
        $this -> include();
        
        $id = $this->input->post('id');
        
        $add = $this->input->post('addqtd');
        $quantidade = $this->input->post('quantidade') + $add;
        
        $new = array(
            'estoque_data'          => $this->input->post('data'),
            'estoque_loja'          => $this->input->post('loja'),
            'estoque_quantidade'    => $quantidade,
            'estoque_tipo'          => $this->input->post('tipo'),
            'estoque_valor'         => $this->input->post('novovalor'),
            'estoque_desc'          => $this->input->post('desc'),
        );
        
        $this->estoque->update($id, $new);
        
        $estoque = $this->estoque->getId($id);
        
        $new2 = array(
            'produto_valor' => $this->input->post('novovalor'),   
        );
        
        $this->produtos->update2($estoque['estoque_produto'], $new2);
        
        $data = date('d-m-y h:i:s', strtotime($this->input->post('data')));
        
        $array = array(
            'estoque_id'         => $this->input->post('id'),
            'estoque_tipo'       => $this->input->post('tipo'),    
            'estoque_loja'       => $this->input->post('loja'),
            'estoque_quantidade' => $quantidade,
            'estoque_valor'      => $this->input->post('novovalor'),
            'estoque_data'       => $data,
        );
        
        echo json_encode($array);
    }
    
    public function Prodexcestoqueadd(){
        
        
        $id = $this->input->post('id');
        
        $this->estoque->excluir($id);
        
        echo json_encode($id);
    }
    
    public function Prodexcestoque(){
        
        
        $id = $this->input->post('id');
        
        //Salvar quantidade
        $estoque = $this->estoque->getId($id);
        $quantidade = $estoque['estoque_quantidade']; 
        
        //Identificar produto
        $produto = $this->produtos->getProdNome($estoque['estoque_produto']);
        
        //Quantidade salva no produto
        $quantidadeProd = $produto['produto_quantidade'];
        
        //Array novo para quantidade;
        $new = array(
            'produto_quantidade' => $quantidadeProd - $quantidade,
        );
        
        //Update Produto
        $this->produtos->update($produto['produto_id'], $new);
        
        $this->estoque->excluir($id);
        
        echo json_encode($id);
    }
    
    /**Funções feitas por Anderson Moreira em 05/01/2022**/
    public function movimentaEstoque(){
        $html = $this->estoque->recuperaEstoque($_POST);
        echo json_encode($html);
    }
    
    public function addMovimentoEstoque(){
        $a = $this->estoque->getestoqueAntigo($_POST['produtoModal'], $_POST['lojaModal']);
        if($a){
            $valorAntigo = $a['estoque_valor'];
        }else{
            $valorAntigo = 0;
        }
        $dataHora = date('Y-m-d H:i:s', strtotime($_POST['dataModal']." ".$_POST['horaModal']));
        if($_POST['tipoModal'] == "Entrada estoque"){
            $quantidade = (int)$_POST['quantidadeModal'];
        }elseif($_POST['tipoModal'] == "Ajuste estoque"){
            $quantidade = (int)$_POST['quantidadeModal'];
        }elseif($_POST['tipoModal'] == "Perda"){
            $quantidade = (int)$_POST['quantidadeModal'] * -1;
        }elseif($_POST['tipoModal'] == "Garantia"){
            $quantidade = (int)($_POST['quantidadeModal'] * -1);
        }
        $dados = array(
            'estoque_loja'          => $_POST['lojaModal'],
            'estoque_data'          => $dataHora,
            'estoque_tipo'          => $_POST['tipoModal'],
            'estoque_quantidade'    => $quantidade,
            'estoque_produto'       => $_POST['produtoModal'],
            'estoque_valor'         => $_POST['valorModal'],
            'valor_antigo'          => $valorAntigo,
            'estoque_desc'          => "",
        );
        $this->estoque->newEstoque($dados);
        redirect(base_url('admin/adminestoque/cadastroestoque'));
    }
    
    function updateEstoque(){
        $html = $this->estoque->updtEstoque($_POST);
        echo json_encode($html);
    }
    /**Fim das Funções feitas por Anderson Moreira em 05/01/2022**/
}