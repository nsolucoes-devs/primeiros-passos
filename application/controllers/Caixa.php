<?php

class Caixa extends Admin_Controller{
    
    //FUNÇÃO PARA CARREGAR A TELA DE CAIXA
    public function index($erro=0){
        $this->load->database();
        $this->load->model('pdv/caixamodel');
        $this->load->model('funcionarios/crudfuncionarios');
        $this->load->model('lojas/crudlojas');
        $this->load->model('pdv/estados');
        $this->load->model('pdv/cidades');
        if($this->session->userdata['loja_id'] == 0){
            $data['admin'] = true;
        }else{
            $data['admin'] = false;
        }

        $data['cidades'] = $this->cidades->getCidades();
        $data['estados'] = $this->estados->getEstados();
        $data['lojas'] = $this->crudlojas->getLojas();
        $data['caixa'] = $this->caixamodel->pegarCaixaAbertoLoja($this->session->userdata('loja_id'));
        
        $data['caixa2'] = $this->caixamodel->pegarCaixaAbertoLoja2($this->session->userdata('loja_id'));
        $data['caixas'] = $this->caixamodel->pegarCaixasAbertos();
        $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
        $data['caixas2'] = $this->caixamodel->pegarCaixasAbertos2();
        $data['listacaixas'] = $this->caixamodel->caixas();
        
        if($erro == 1){
	        $data['erro'] = 1;
	    }else{
	        $data['erro'] = 0;
	    }
        
        $this->header(8);
        $this->load->view('restrito/caixa/listaCaixas', $data);
        $this->footer();
    }
    
    //FUNÇÃO PARA A ABERTURA DE NOVO CAIXA
    public function adicionarCaixa(){
	    $this->load->model('pdv/caixamodel');
	    $this->load->database();
	    $this->load->library("session");
	    
	    
	    if(isset($_POST['troco-inicial-cad'])){
	        $valor = $_POST['troco-inicial-cad'];
	    }else{
	        $valor = 0;
	    }
	    if(isset($_POST['limite-caixa-cad'])){
	        $limite = $_POST['limite-caixa-cad'];
	    }else{
	        $limite = 0;
	    }
	    $erro = 0;
	    
	    if($this->session->userdata('loja_id') == 0){
	        $loja = $_POST['loja'];
	    }else{
	        $loja = $this->session->userdata('loja_id');
	    }
	    
        $insert = $this->caixamodel->abrirCaixa($valor, $limite, $loja);
	    if($insert){
	        
	        $this->session->set_userdata("loja", $insert);
	        echo json_encode($insert);    
	    }

	}
	
	//FUNÇÃO PARA A ABERTURA DE NOVO CAIXA
    public function adicionarCaixa2(){
	    $this->load->model('pdv/caixamodel');
	    $this->load->database();
	    $this->load->library("session");
	    
	    if(isset($_POST['troco-inicial-cad'])){
	        $valor = $_POST['troco-inicial-cad'];
	    }else{
	        $valor = 0;
	    }
	    if(isset($_POST['limite-caixa-cad'])){
	        $limite = $_POST['limite-caixa-cad'];
	    }else{
	        $limite = 0;
	    }
	    $erro = 0;
	    
	    $loja = $_POST['loja'];
	    
        $insert = $this->caixamodel->abrirCaixa($valor, $limite, $loja);
	    
	    if($insert){
	        $this->session->set_userdata("loja", $insert);
	        $this->index();
	    }
	}
	
	//FUNÇÃO PARA FECHAMENTO DE CAIXA
	public function encerrarCaixa(){
	    $this->load->database();
	    
	    $this->load->model('pdv/caixamodel');
	    $this->load->model('pdv/crudclientes');
	    $this->load->model('pdv/crudformas');
	    $this->load->model('pdv/crudcompras');
	    $this->load->model('lojas/crudlojas');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('contas/contasmodel');
	    
	    
	    $this->caixamodel->fecharCaixa($idcaixa, $cxunico);
	    $caixaunico = $this->caixamodel->pegarCaixaUnico($idcaixa);
	    
	    $dataexplode = explode('-', date('Y-m-d'));
        $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        $dia = new DateTime($datareforma);
        
        $dados = array(
                'loja'  => $this->crudlojas->getLojaUnica($caixaunico['loja_id']),
                'dia'   => $dia,
            );
        $valida = $this->caixamodel->pegarCaixaAbertoLoja($caixaunico['loja_id']);
        if($valida != null){
            $erro = 1;
            $diaex = explode('-', date('Y-m-d'));
            $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
            $dates = $dia .'|'. 99;
            $this->telaRelatorio($caixaunico['loja_id'], null, null, $dates, $erro);
        }else{
            $despesasaux = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $caixaunico['loja_id']);
            $vendas = $this->crudcompras->getComprasLoja($caixaunico['loja_id']);
    	    $vlr_total = 0;
    	    $str = null;
    	    $totaldespesas = 0;
    	    if($despesasaux != null){
        	    foreach($despesasaux as $dep){
        	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
        	    }
    	    }
    	    foreach($vendas as $ven){
    	        $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
    	        if($funcionario != null){
                    $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                    $dataex = explode('/', $ven['data_compra']);
        	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
        	        $dataa = new DateTime($dataref);
        	        
        	        $formas = explode('|', $ven['forma_id']);
                    $data['forma'] = "";
                    $forma = $this->crudformas->getFormaId($formas[0]);
                    $data['forma'] .= $forma['nome_forma'];
                    unset($formas[0]);
                    
                    foreach($formas as $row){
                        if($row != ""){
                            $forma = $this->crudformas->getFormaId($row);
                            $data['forma'] .= ", " . $forma['nome_forma'];
                        }
                    }
        	        
        	        if($dia == $dataa){
        	            if($ven['valor_compra'] != 0.00){
        	                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                            $vlr_total = $vlr_total + $ven['valor_compra'];
        	            }
        	        }
        	    }
            }
            if($vlr_total != 0 || $totaldespesas != 0){
        	    $diaex = explode('-', date('Y-m-d'));
                $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                $dates = $dia .'|'. 99;
                $rd = $this->relatorioDespesas($caixaunico['id_caixa']);
        	    $total = $vlr_total . '|' . $totaldespesas;
        	    $str = $str . '|' . $rd;
        	    $this->telaRelatorio($caixaunico['loja_id'], $str, $total, $dates);
    	    }else{
    	        $erro = 2;
    	        $diaex = explode('-', date('Y-m-d'));
                $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                $dates = $dia .'|'. 99;
    	        $this->telaRelatorio($caixaunico['loja_id'], null, null, $dates, $erro);
    	    }
        }
	}
	
	//função que vai gerar o relatório de despesas
	public function relatorioDespesas($idcaixa){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('contas/contasmodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('contas/tiposcontas');
	    
	    $cxunico = $this->caixamodel->pegarCaixaUnico($idcaixa);
	    $despesas = $this->contasmodel->getDespesasCaixa($cxunico['abertura_caixa']);
	    $str = null;
	    $tipos = $this->tiposcontas->getTipos();
	    if($despesas != null){
    	    foreach($despesas as $dep){
    	        if($dep['loja_id'] == $cxunico['loja_id']){
    	            foreach($tipos as $tip){
    	                if($tip['id_tipo_conta'] == $dep['tipo_conta_id']){
    	                    $func = $this->crudfuncionarios->getFuncionarioUnico($dep['funcionario_id']);
            	            $str = $str . "<tr>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['data_despesa'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['titulo_despesa'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($func['nome_funcionario']) . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $tip['nome_tipo_conta'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;" . 'R$ ' . number_format($dep['valor_despesa'], 2, ',', '.') . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['observacao_despesa'] . "</td>" .
            	            "</tr>";
    	                }
    	            }
    	        }
    	    }
	    }else{
	        $str = 'a';
	    }
	    
	    return $str;
	}
	
	//função que vai gerar o relatório de despesas por loje e data
	public function relatorioDespesasLoja($lojaid, $datainicial, $datafinal){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('contas/contasmodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('contas/tiposcontas');
	    
	    $despesas = $this->contasmodel->getDespesasLoja($lojaid);
	    $str = null;
	    $tipos = $this->tiposcontas->getTipos();
	    if($despesas != null){
    	    foreach($despesas as $dep){
    	        $dtex = explode('/', $datainicial);
    	        $dtinicial = $dtex[2] . '-' . $dtex[1] . '-' . $dtex[0];
    	        $dtinicial = new DateTime($dtinicial);
    	        $dtex2 = explode('/', $datafinal);
    	        $dtfinal = $dtex2[2] . '-' . $dtex2[1] . '-' . $dtex2[0];
    	        $dtfinal = new DateTime($dtfinal);
    	        $dtex3 = explode('/', $dep['data_despesa']);
    	        $dtdep = $dtex3[2] . '-' . $dtex3[1] . '-' . $dtex3[0];
    	        $dtdep = new DateTime($dtdep);
    	        if($dtdep >= $dtinicial && $dtfinal >= $dtdep){
    	            foreach($tipos as $tip){
    	                if($tip['id_tipo_conta'] == $dep['tipo_conta_id']){
    	                    $func = $this->crudfuncionarios->getFuncionarioUnico($dep['funcionario_id']);
            	            $str = $str . "<tr>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['data_despesa'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['titulo_despesa'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($func['nome_funcionario']) . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $tip['nome_tipo_conta'] . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;" . 'R$ ' . number_format($dep['valor_despesa'], 2, ',', '.') . "</td>" .
            	            "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $dep['observacao_despesa'] . "</td>" .
            	            "</tr>";
    	                }
    	            }
    	        }
    	    }
	    }else{
	        $str = 'a';
	    }
	    
	    return $str;
	}
	
	//FUNÇÃO PARA CHAMAR AS SANGRIAS DO CAIXA UNICO
	public function sangria($id=null, $erro=0){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
        $data['caixaunico'] = $this->caixamodel->pegarCaixaAbertoLoja($this->session->userdata('loja_id'));
        $data['sangrias'] = $this->caixamodel->pegarSangrias($data['caixaunico']['id_caixa']);
        $data['erro'] = $erro;
        $data['verifica'] = null;
        $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
        
        $this->header(8);
        $this->load->view('caixa/telaSangria', $data);
        $this->footer();
	}
	
	public function resangria($id=null, $erro=0){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
        $data['caixaunico'] = $this->caixamodel->pegarCaixaAbertoLoja2($this->session->userdata('loja_id'));
        $data['sangrias'] = $this->caixamodel->pegarSangrias($data['caixaunico']['id_caixa']);
        $data['erro'] = $erro;
        $data['verifica'] = null;
        $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
        
        $this->header(8);
        $this->load->view('caixa/telaResangria', $data);
        $this->footer();
	}
	
	//FUNÇÃO PARA CHAMAR AS SANGRIAS DO CAIXA UNICO
	public function sangria2($id=null, $erro=0, $ver=null){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    if($id != null){
	        $data['caixaunico'] = $this->caixamodel->pegarCaixaUnico($id);
            $data['sangrias'] = $this->caixamodel->pegarSangrias($id);
            $data['passaid'] = $id;
	    }else{
    	    $idcaixa = $this->uri->segment(3);
    	    $data['caixaunico'] = $this->caixamodel->pegarCaixaUnico($idcaixa);
            $data['sangrias'] = $this->caixamodel->pegarSangrias($idcaixa);
            $data['passaid'] = $idcaixa;
        }
        $data['erro'] = $erro;
        $data['verifica'] = 1;
        $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
        
        $this->header(8);
        $this->load->view('caixa/telaSangria', $data);
        $this->footer();
	}
	
	public function resangria2($id=null, $erro=0, $ver=null){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    if($id != null){
	        $data['caixaunico'] = $this->caixamodel->pegarCaixaUnico($id);
            $data['sangrias'] = $this->caixamodel->pegarSangrias($id);
            $data['passaid'] = $id;
	    }else{
    	    $idcaixa = $this->uri->segment(3);
    	    $data['caixaunico'] = $this->caixamodel->pegarCaixaUnico($idcaixa);
            $data['sangrias'] = $this->caixamodel->pegarSangrias($idcaixa);
            $data['passaid'] = $idcaixa;
        }
        $data['erro'] = $erro;
        $data['verifica'] = 1;
        $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
        
        $this->header(8);
        $this->load->view('caixa/telaResangria', $data);
        $this->footer();
	}
	
	//FUNÇÃO PARA ADICIAR UMA SANGRIA
    public function adicionarSangria(){
	    $this->load->model('caixa/caixamodel');
	    $this->load->database();
	    
	    $sangs = $this->caixamodel->pegarSangrias($this->input->post('addsang'));
	    $caixaunico = $this->caixamodel->pegarCaixaUnico($this->input->post('addsang'));
	    $id = $this->input->post('addsang');
	    $soma = 0;
	    foreach($sangs as $san){
	        $soma = $soma + $san['valor_sangria'];
	    }
	    if($this->input->post('valor') > $caixaunico['troco_atual']){
	        $erro = 1;
	        $verifica = $this->uri->segment(3);
    	    if($verifica == 1){
    	        $idcaixa = $this->uri->segment(4);
    	        $this->sangria2($idcaixa, $erro);
    	    }else{
    	        $this->sangria($id, $erro);
    	    }
	    }else{
    	    $sangria = array(
    	          'caixa_id' => $this->input->post('addsang'),
    	          'valor_sangria' => $this->input->post('valor'),
    	          'data_sangria' => date('d/m/Y'),
    	          'funcionario_id' => $this->session->userdata('id_pessoa')
    	        );
    	    $troco = $caixaunico;
    	    $troco['troco_atual'] = $troco['troco_atual'] - $sangria['valor_sangria'];
    	    $insert = $this->caixamodel->adicionarSangria($sangria, $troco, $id);
    	    $erro = 0;
    	    $verifica = $this->uri->segment(3);
    	    if($verifica == 1){
    	        $idcaixa = $this->uri->segment(4);
    	        $this->sangria2($idcaixa, $erro);
    	    }else{
    	        $this->sangria($id, $erro);
    	    }
	    }
	}
	
	public function adicionarreSangria(){
	    $this->load->model('caixa/caixamodel');
	    $this->load->database();
	    
	    $sangs = $this->caixamodel->pegarSangrias($this->input->post('addsang'));
	    $caixaunico = $this->caixamodel->pegarCaixaUnico($this->input->post('addsang'));
	    $id = $this->input->post('addsang');
	    $soma = 0;
	    foreach($sangs as $san){
	        $soma = $soma + $san['valor_sangria'];
	    }
	    if($this->input->post('valor') > $caixaunico['troco_atual']){
	        $erro = 1;
	        $verifica = $this->uri->segment(3);
    	    if($verifica == 1){
    	        $idcaixa = $this->uri->segment(4);
    	        $this->sangria2($idcaixa, $erro);
    	    }else{
    	        $this->sangria($id, $erro);
    	    }
	    }else{
    	    $sangria = array(
    	          'caixa_id' => $this->input->post('addsang'),
    	          'valor_sangria' => $this->input->post('valor'),
    	          'data_sangria' => date('d/m/Y'),
    	          'funcionario_id' => $this->session->userdata('id_pessoa')
    	        );
    	    $troco = $caixaunico;
    	    $troco['troco_atual'] = $troco['troco_atual'] - $sangria['valor_sangria'];
    	    $insert = $this->caixamodel->adicionarSangria($sangria, $troco, $id);
    	    $erro = 0;
    	    $verifica = $this->uri->segment(3);
    	    if($verifica == 1){
    	        $idcaixa = $this->uri->segment(4);
    	        $this->resangria2($idcaixa, $erro);
    	    }else{
    	        $this->resangria($id, $erro);
    	    }
	    }
	}
	
	//Função que vai gerar o pdf
	public function geraPDF(){
	    $this->load->database();
	    $this->load->model('lojas/crudlojas');
	    $this->load->model('estados/Estados');
	    $this->load->model('cidades/cidades');
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('contas/contasmodel');
	    $total = $this->input->post('total');
        $loja = $this->crudlojas->getLojaUnica($this->input->post('loja'));
        $relatorio = $this->input->post('relatorio');
        $dates = $this->input->post('dates');
        $data = array(
                'total'     => $total,
                'loja'      => $loja,
                'dates'     => $dates,
                'relatorio' => $relatorio,
            );
        $dt = explode('|', $dates); 
        $data['caixaunico'] = $this->caixamodel->pegarCaixaLojaData($loja['id_loja'], $dt[0]);
        $data['estados'] = $this->Estados->getEstados();
	    $data['cidades'] = $this->cidades->getCidades();
	    $data['sangrias'] = $this->caixamodel->pegarSangriasData($dt[0]);
	    $data['despesas'] = $this->contasmodel->getDespesasCaixaId($data['caixaunico']['id_caixa']);
	    $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/pdfCaixa', $data, true);
        pdf_create($html, 'PDF' . date('d/m/y'), TRUE, '1');
	}
	
	//Função que carrega a tela de relatório de caixas
	public function telaRelatorio($id = null, $relatorio = null, $total = null, $dates = null, $erro = null){
	    $this->load->database();
	    $this->load->model('cidades/cidades');
	    $this->load->model('lojas/crudlojas');
        $this->load->model('estados/Estados');
        $this->load->model('compras/crudcompras');
	    
	    if($id != null){
	        $data['lojaunica'] = $this->crudlojas->getLojaUnica($id);
	    }else{
	        $data['lojaunica'] = null;
	    }
	    if($relatorio != null){
	        $data['relatorio'] = $relatorio;
	    }else{
	        $data['relatorio'] = null;
	    }
	    if($total != null){
	        $data['total'] = $total;
	    }else{
	        $data['total'] = null;
	    }
	    if($dates != null){
	        $data['dates'] = $dates;
	    }else{
	        $data['dates'] = null;
	    }
	    if($erro != null){
	        $data['erro'] = $erro;
	    }else{
	        $data['erro'] = null;
	    }
	    
	    $data['estados'] = $this->Estados->getEstados();
	    $data['cidades'] = $this->cidades->getCidades();
	    $data['lojas'] = $this->crudlojas->getLojas();
	    
	    $this->header(6);
	    $this->load->view('relatorios/relatorioCaixa', $data);
	    $this->footer();
	}
	
	//Função que vai gerar o relatorio
	public function geraRelatorio(){
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('lojas/crudlojas');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('clientes/crudclientes');
	    $this->load->model('formas_pagamento/crudformas');
	    $this->load->model('compras/crudcompras');
	    $this->load->model('contas/contasmodel');
	    $this->load->database();
	    
	    if($this->session->userdata('tipo_pessoa') == 3){
	        if(!empty($this->input->post('dia'))){
	            $dataexplode = explode('-', $this->input->post('dia'));
	            $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
	            $dia = new DateTime($datareforma);
	            
	            $dados = array(
	                    'loja'  => $this->crudlojas->getLojaUnica($this->session->userdata('loja_id')),
	                    'dia'   => $dia,
	                );
                $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->session->userdata('loja_id'));
                $vendas = $this->crudcompras->getComprasLoja($this->session->userdata('loja_id'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
        	        $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
        	        if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
                        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        if($dia == $dataa){
            	            if($ven['valor_compra'] != 0.00){
                                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
            	    }
                }
                if($vlr_total != 0 || $totaldespesas != 0){
            	    $diaex = explode('-', $this->input->post('dia'));
                    $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                    $caixa = $this->caixamodel->pegarCaixaLojaData($this->session->userdata('loja_id'), $dia);
                    $rd = $this->relatorioDespesas($caixa['id_caixa']);
                    $str = $str . '|' . $rd;
                    $dates = $dia .'|'. 99;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->session->userdata('loja_id'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $diaex = explode('-', $this->input->post('dia'));
                    $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                    $dates = $dia .'|'. 993;
        	        $this->telaRelatorio($this->session->userdata('loja_id'), null, null, $dates, $erro);
        	    }
	        }
	        if(empty($this->input->post('dia'))){
	            $dataexplode = explode('-', date('Y-m-d'));
	            $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
	            $dia = new DateTime($datareforma);
	            
	            $dados = array(
	                    'loja'  => $this->crudlojas->getLojaUnica($this->session->userdata('loja_id')),
	                    'dia'   => $dia,
	                );
                $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->session->userdata('loja_id'));
                $vendas = $this->crudcompras->getComprasLoja($this->session->userdata('loja_id'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
        	        $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
        	        if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
            	        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        
            	        if($dia == $dataa){
            	            if($ven['valor_compra'] != 0.00){
            	                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
            	    }
                }
                if($vlr_total != 0 || $totaldespesas != 0){
            	    $diaex = explode('-', date('Y-m-d'));
                    $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                    $dates = $dia .'|'. 99;
                    $caixa = $this->caixamodel->pegarCaixaLojaData($this->session->userdata('loja_id'), $dia);
                    $rd = $this->relatorioDespesas($caixa['id_caixa']);
                    $str = $str . '|' . $rd;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->session->userdata('loja_id'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $diaex = explode('-', date('Y-m-d'));
                    $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                    $dates = $dia .'|'. 99;
        	        $this->telaRelatorio($this->session->userdata('loja_id'), null, null, $dates, $erro);
        	    }
	        }
	    }
	    if($this->session->userdata('tipo_pessoa') == 1 || $this->session->userdata('tipo_pessoa') == 4){
    	    if(!empty($this->input->post('inicial')) && !empty($this->input->post('final'))){
        	    $dataexplode = explode('-', $this->input->post('inicial'));
        	    $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        	    $dataexplode2 = explode('-', $this->input->post('final'));
        	    $datareforma2 = $dataexplode2[2] . '-' . $dataexplode2[1] . '-' . $dataexplode2[0];
        	    $datainicial = new DateTime($datareforma);
        	    $datafinal = new DateTime($datareforma2);
        
        	    $dados = array(
        	            'loja'          => $this->crudlojas->getLojaUnica($this->input->post('loja')),
        	            'data_inicial'  => $datainicial,
        	            'data_final'    => $datafinal,
        	        );
    	        $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->input->post('loja'));
        	    $vendas = $this->crudcompras->getComprasLoja($this->input->post('loja'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
                    $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
                    if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
            	        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        
            	        if($datafinal >= $dataa && $datainicial <= $dataa){
            	            if($ven['valor_compra'] != 0.00){
                                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
        	        }
        	    }
        	    if($vlr_total != 0 || $totaldespesas != 0){
            	    $dtex1 = explode('-', $this->input->post('inicial'));
            	    $dt1 = $dtex1[2] . '/' . $dtex1[1] . '/' . $dtex1[0];
            	    $dtex2 = explode('-', $this->input->post('final'));
            	    $dt2 = $dtex2[2] . '/' . $dtex2[1] . '/' . $dtex2[0];
            	    $dates = $dt1 . "|" . $dt2;
                    $rd = $this->relatorioDespesasLoja($this->input->post('loja'), $dt1, $dt2);
                    $str = $str . '|' . $rd;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->input->post('loja'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $dtex1 = explode('-', $this->input->post('inicial'));
            	    $dt1 = $dtex1[2] . '/' . $dtex1[1] . '/' . $dtex1[0];
            	    $dtex2 = explode('-', $this->input->post('final'));
            	    $dt2 = $dtex2[2] . '/' . $dtex2[1] . '/' . $dtex2[0];
            	    $dates = $dt1 . "|" . $dt2;
        	        $this->telaRelatorio($this->input->post('loja'), null, null, $dates, $erro);
        	    }
    	    }
    	    if(!empty($this->input->post('inicial')) && empty($this->input->post('final'))){
    	        $dataexplode = explode('-', $this->input->post('inicial'));
        	    $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        	    $datamais7 = $dataexplode[0] .'-'. $dataexplode[1] .'-'. $dataexplode[2];
        	    $datamais7 = date('d-m-Y', strtotime('+7 days', strtotime($datamais7)));
        	    $dataexplode2 = explode('-', $datamais7);
        	    $datareforma2 = $dataexplode2[2] . '-' . $dataexplode2[1] . '-' . $dataexplode2[0];
        	    $datainicial = new DateTime($datareforma);
        	    $datafinal = new DateTime($datareforma2);
        
        	    $dados = array(
        	            'loja'          => $this->crudlojas->getLojaUnica($this->input->post('loja')),
        	            'data_inicial'  => $datainicial,
        	            'data_final'    => $datafinal,
        	        );
    	        $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->input->post('loja'));
        	    $vendas = $this->crudcompras->getComprasLoja($this->input->post('loja'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
                    $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
                    if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
            	        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        
            	        if($datafinal >= $dataa && $datainicial <= $dataa){
            	            if($ven['valor_compra'] != 0.00){
                                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
                    }
        	    }
        	    if($vlr_total != 0 || $totaldespesas != 0){
            	    $dtex1 = explode('-', $this->input->post('inicial'));
            	    $dt1 = $dtex1[2] . '/' . $dtex1[1] . '/' . $dtex1[0];
            	    $dtex2 = explode('-', $datamais7);
            	    $dt2 = $dtex2[0] . '/' . $dtex2[1] . '/' . $dtex2[2];
            	    $dates = $dt1 . "|" . $dt2;
            	    $rd = $this->relatorioDespesasLoja($this->input->post('loja'), $dt1, $dt2);
                    $str = $str . '|' . $rd;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->input->post('loja'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $dtex1 = explode('-', $this->input->post('inicial'));
            	    $dt1 = $dtex1[2] . '/' . $dtex1[1] . '/' . $dtex1[0];
            	    $dtex2 = explode('-', $datamais7);
            	    $dt2 = $dtex2[0] . '/' . $dtex2[1] . '/' . $dtex2[2];
            	    $dates = $dt1 . "|" . $dt2;
        	        $this->telaRelatorio($this->input->post('loja'), null, null, $dates, $erro);
        	    }
    	    }
    	    if(empty($this->input->post('inicial')) && !empty($this->input->post('final'))){
    	        $dataexplode2 = explode('-', $this->input->post('final'));
        	    $datareforma2 = $dataexplode2[2] . '-' . $dataexplode2[1] . '-' . $dataexplode2[0];
        	    $datamenos7 = $dataexplode2[0] .'-'. $dataexplode2[1] .'-'. $dataexplode2[2];
        	    $datamenos7 = date('d-m-Y', strtotime('-7 days', strtotime($datamenos7)));
    	        $dataexplode = explode('-', $datamenos7);
        	    $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        	    $datainicial = new DateTime($datareforma);
        	    $datafinal = new DateTime($datareforma2);
        
        	    $dados = array(
        	            'loja'          => $this->crudlojas->getLojaUnica($this->input->post('loja')),
        	            'data_inicial'  => $datainicial,
        	            'data_final'    => $datafinal,
        	        );
    	        $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->input->post('loja'));
        	    $vendas = $this->crudcompras->getComprasLoja($this->input->post('loja'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
                    $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
                    if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
            	        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        
            	        if($datafinal >= $dataa && $datainicial <= $dataa){
            	            if($ven['valor_compra'] != 0.00){
                                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
                    }
        	    }
        	    if($vlr_total != 0 || $totaldespesas != 0){
            	    $dtex1 = explode('-', $datamenos7);
            	    $dt1 = $dtex1[0] . '/' . $dtex1[1] . '/' . $dtex1[2];
            	    $dtex2 = explode('-', $this->input->post('final'));
            	    $dt2 = $dtex2[2] . '/' . $dtex2[1] . '/' . $dtex2[0];
            	    $dates = $dt1 . "|" . $dt2;
            	    $rd = $this->relatorioDespesasLoja($this->input->post('loja'), $dt1, $dt2);
                    $str = $str . '|' . $rd;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->input->post('loja'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $dtex1 = explode('-', $datamenos7);
            	    $dt1 = $dtex1[0] . '/' . $dtex1[1] . '/' . $dtex1[2];
            	    $dtex2 = explode('-', $this->input->post('final'));
            	    $dt2 = $dtex2[2] . '/' . $dtex2[1] . '/' . $dtex2[0];
            	    $dates = $dt1 . "|" . $dt2;
        	        $this->telaRelatorio($this->input->post('loja'), null, null, $dates, $erro);
        	    }
    	    }
    	    if(empty($this->input->post('inicial')) && empty($this->input->post('final'))){
    	        $dataexplode = explode('-', date('d-m-Y', strtotime('-7 days', strtotime(date('d-m-Y')))));
        	    $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        	    $dataexplode2 = explode('-', date('d-m-Y'));
        	    $datareforma2 = $dataexplode2[2] . '-' . $dataexplode2[1] . '-' . $dataexplode2[0];
        	    $datainicial = new DateTime($datareforma);
        	    $datafinal = new DateTime($datareforma2);
        
        	    $dados = array(
        	            'loja'          => $this->crudlojas->getLojaUnica($this->input->post('loja')),
        	            'data_inicial'  => $datainicial,
        	            'data_final'    => $datafinal,
        	        );
    	        $despesas = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $this->input->post('loja'));
        	    $vendas = $this->crudcompras->getComprasLoja($this->input->post('loja'));
        	    $vlr_total = 0;
        	    $str = null;
        	    $totaldespesas = 0;
        	    if($despesas != null){
            	    foreach($despesas as $dep){
            	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
            	    }
        	    }
        	    foreach($vendas as $ven){
                    $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
                    if($funcionario != null){
                        $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                        $dataex = explode('/', $ven['data_compra']);
            	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
            	        $dataa = new DateTime($dataref);
            	        $formas = explode('|', $ven['forma_id']);
            	        $data['forma'] = "";
                        $forma = $this->crudformas->getFormaId($formas[0]);
                        $data['forma'] .= $forma['nome_forma'];
                        unset($formas[0]);
                        
                        foreach($formas as $row){
                            if($row != ""){
                                $forma = $this->crudformas->getFormaId($row);
                                $data['forma'] .= ", " . $forma['nome_forma'];
                            }
                        }
            	        
            	        if($datafinal >= $dataa && $datainicial <= $dataa){
            	            if($ven['valor_compra'] != 0.00){
                                $str = $str . 
                                "<tr>".
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                    "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                                "</tr>";
                                $vlr_total = $vlr_total + $ven['valor_compra'];
            	            }
            	        }
                    }
        	    }
        	    if($vlr_total != 0 || $totaldespesas != 0){
            	    $dtex1 = explode('-', date('d-m-Y', strtotime('-7 days', strtotime(date('d-m-Y')))));
            	    $dt1 = $dtex1[0] . '/' . $dtex1[1] . '/' . $dtex1[2];
            	    $dtex2 = explode('-', date('d-m-Y'));
            	    $dt2 = $dtex2[0] . '/' . $dtex2[1] . '/' . $dtex2[2];
            	    $dates = $dt1 . "|" . $dt2;
            	    $rd = $this->relatorioDespesasLoja($this->input->post('loja'), $dt1, $dt2);
                    $str = $str . '|' . $rd;
            	    $total = $vlr_total . '|' . $totaldespesas;
            	    $this->telaRelatorio($this->input->post('loja'), $str, $total, $dates);
        	    }else{
        	        $erro = 2;
        	        $dtex1 = explode('-', date('d-m-Y', strtotime('-7 days', strtotime(date('d-m-Y')))));
            	    $dt1 = $dtex1[0] . '/' . $dtex1[1] . '/' . $dtex1[2];
            	    $dtex2 = explode('-', date('d-m-Y'));
            	    $dt2 = $dtex2[0] . '/' . $dtex2[1] . '/' . $dtex2[2];
            	    $dates = $dt1 . "|" . $dt2;
        	        $this->telaRelatorio($this->input->post('loja'), null, null, $dates, $erro);
        	    }
    	    }
	    }
	}
	
	//função que vai chamar a tela das devoluções do caixa
	public function telaDevolucoes(){
	    $id = $this->uri->segment(3);
	    $this->session->set_userdata('caixa_id', $id);
	    
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    
	    $data['devos'] = $this->caixamodel->getDevoCaixa($id);
	    $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
	    $data['id_caixa'] = $id;
	    
	    $this->header(8);
	    $this->load->view('caixa/telaDevolucao', $data);
	    $this->footer();
	}
	
	//função que vai chamar a tela para adicionar uma devolução
    public function telaAdicionar(){
        $this->load->database();
        $this->load->model('produtos/crudprodutos');
        $this->load->model('estoque_produto/crudestoque');
        $this->load->model('caixa/caixamodel');
        $this->load->model('cores/crudcores');
        $id = $this->uri->segment(3);
        $this->load->model('clientes/crudclientes');
        $data['clientes'] = $this->crudclientes->getClientes();
        $data['caixa'] = $this->caixamodel->pegarCaixaUnico($id);
        $data['estoques'] = $this->crudestoque->getEstoqueLoja($data['caixa']['loja_id']);
        $data['produtos'] = $this->crudprodutos->getProdutos();
        $data['devo'] = null;
        $data['cores'] = $this->crudcores->getCores();
        
        $this->header(8);
        $this->load->view('caixa/adicionarDevolucoes', $data);
        $this->footer();
    }
    
    //função que insere uma nova devolução
	public function adicionaDevolucao(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    
	    $devo = array(
	            'data_dc' => date('d/m/Y'),
	            'funcionario_id' => $this->session->userdata('id_pessoa'),
	            'obs_dc' => $this->input->post('descricao_devolucao'),
	            'caixa_id' => $this->input->post('caixa_id'),
	            'cliente_id' => $this->input->post('cliente_id'),
	        );
	    $inf['id'] = $this->caixamodel->insertDevo($devo);
	    echo json_encode($inf);
	}
	
	//função que insere os produtos de uma devolução e ja reduz do estoque
	public function insereProdutos(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('estoque_produto/crudestoque');
	    
	    $prod = array(
	            'dc_id'  => $this->input->post('dc_id'),
	            'estoque_id'    => $this->input->post('estoque_id'),
	            'quantidade'    => $this->input->post('quantidade'),
	            'valor'    => str_replace(',', '.', str_replace('.', '', $this->input->post('valor'))),
	        );
	    $estoque = $this->crudestoque->getEstoqueId($prod['estoque_id']);
	    $estoque['estoque'] = (int) $estoque['estoque'] + (int) $prod['quantidade'];
	    $caixa = $this->caixamodel->pegarCaixaUnico($this->input->post('caixa_id'));
	    $caixa['troco_atual'] = $caixa['troco_atual'] - $prod['valor'];
	    $this->caixamodel->atualizarTroco($caixa, $caixa['id_caixa']);
	    $this->crudestoque->atualizarEstoque($estoque, $prod['estoque_id']);
	    $id = $this->caixamodel->insertProd($prod);
	}
	
	//função que vai chamar a tela de devolução unica
	public function telaUnica(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('produtos/crudprodutos');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('estoque_produto/crudestoque');
	    $this->load->model('clientes/crudclientes');
	    
	    $id = $this->uri->segment(3);
	    $data['devo'] = $this->caixamodel->getDevoUnica($id);
	    $data['itens'] = $this->caixamodel->getItensDevo($id);
	    $data['produtos'] = $this->crudprodutos->getProdutos();
	    $data['cliente'] = $this->crudclientes->getClienteUnico($data['devo']['cliente_id']);
	    if($this->session->userdata('tipo_pessoa') == 3){
	        $data['estoques'] = $this->crudestoque->getEstoqueLoja($this->session->userdata('loja_id'));
	    }else{
	        $data['estoques'] = $this->crudestoque->getAllEstoques();
	    }
	    $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
	    $data['caixa'] = $this->caixamodel->pegarCaixaUnico($data['devo']['caixa_id']);
	    
	    $this->header(8);
	    $this->load->view('caixa/devolucaoUnica', $data);
	    $this->footer();
	}
	
	//função que vai chamar a tela de edição
	public function editarDevolucao(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('produtos/crudprodutos');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('estoque_produto/crudestoque');
	    $this->load->model('clientes/crudclientes');
        $this->load->model('cores/crudcores');
        $data['clientes'] = $this->crudclientes->getClientes();
	    $id = $this->uri->segment(3);
	    $data['devo'] = $this->caixamodel->getDevoUnica($id);
	    $data['itens'] = $this->caixamodel->getItensDevo($id);
	    if($this->session->userdata('tipo_pessoa') == 3){
	        $data['estoques'] = $this->crudestoque->getEstoqueLoja($this->session->userdata('loja_id'));
	    }else{
	        $data['estoques'] = $this->crudestoque->getAllEstoques();
	    };
	    $data['caixa'] = $this->caixamodel->pegarCaixaUnico($data['devo']['caixa_id']);
	    $data['estoques'] = $this->crudestoque->getEstoqueLoja($data['caixa']['loja_id']);
        $data['produtos'] = $this->crudprodutos->getProdutos();
        $data['cores'] = $this->crudcores->getCores();
        $data['produtos'] = $this->crudprodutos->getProdutos();
        
        
        $this->header(11);
        $this->load->view('caixa/adicionarDevolucoes', $data);
        $this->footer();
	}
	
	//função que vai atualizar uma devolução
	public function atualizaDevolucao(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    
	    $id = $this->input->post('id');
	    $devo = array(
	            'data_dc' => date('d/m/Y'),
	            'funcionario_id' => $this->session->userdata('id_pessoa'),
	            'obs_dc' => $this->input->post('descricao_devolucao'),
	            'cliente_id' => $this->input->post('cliente_id'),
	        );
	    $up = $this->caixamodel->updateDevo($id, $devo);
	}
	
	//função que vai excluir um item
	public function excluirItem(){
	    $this->load->database();
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('estoque_produto/crudestoque');
	    
	    $id = $this->input->post('id');
	    $item = $this->caixamodel->getItem($id);
	    $caixa = $this->caixamodel->pegarCaixaUnico($this->input->post('caixaid'));
	    $caixa['troco_atual'] = $caixa['troco_atual'] + $item['valor'];
	    $this->caixamodel->atualizarTroco($caixa, $caixa['id_caixa']);
	    $estoque = $this->crudestoque->getEstoqueId($item['estoque_id']);
	    $estoque['estoque'] = (int) $estoque['estoque'] - (int) $item['quantidade'];
	    $this->crudestoque->atualizarEstoque($estoque, $estoque['id_estoque']);
	    $this->caixamodel->deleteItem($id);
	}
	
	public function reabertura($erro=null){
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('lojas/crudlojas');
	    $this->load->database();
	    
	    $func_id = $this->session->userdata('id_pessoa');
	    
	    
	    $aux = $this->crudfuncionarios->getFuncionarioUnico($func_id);
	    if($this->session->userdata('tipo_pessoa') == 3){
	        $caixa = $this->caixamodel->getCaixaFechados($aux['loja_id']);
	    }else{
	        $caixa = $this->caixamodel->getTodosCaixasFechados();
	    }
	    //$caixa = $this->caixamodel->getTodasCaixaFechados($aux['loja_id']);
	    
	    $data['lojas'] = $this->crudlojas->getLojas();
	    $data['funcionarios'] = $this->crudfuncionarios->getFuncionarios();
	    $data['teste'] = $caixa;
	    $data['caixa'] = $caixa;
	    $data['erro'] = $erro;
	    
	    $this->header(8);
	    $this->load->view("caixa/reaberturaCaixa", $data);
	    $this->footer();
	}
	
	public function reabrirCaixa(){
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->database();
	    
        $aux = $this->crudfuncionarios->getFuncionarioUnico($this->session->userdata('id_pessoa'));
	    
	    if($aux['senha_funcionario'] == md5($this->input->post('senha')) ){
	        $caixaaberto = $this->caixamodel->pegarCaixaAbertoLoja($this->input->post('loja'));
	        if($caixaaberto['id_caixa'] != null){
	            $this->reabertura($erro = array( 'msg' => "Esta loja já possui caixa aberto!", 'erro' => 3,));
	        }else{
	            $caixaaberto2 = $this->caixamodel->pegarCaixaAbertoLoja2($this->input->post('loja'));
	            if($caixaaberto2['id_caixa'] != null){
	                $this->reabertura($erro = array( 'msg' => "Esta loja já possui caixa aberto!", 'erro' => 3,));
	            }else{
	                $caixa = $this->caixamodel->updateCaixaFechados($this->input->post('addid'), $this->input->post('motivo'), $this->session->userdata('id_pessoa'));
	                $this->reabertura($erro = array( 'msg' => "Abertura realizada com sucesso!", 'erro' => 1,));
	            }
	        }
	    }else{
	        $this->reabertura($erro = array( 'msg' => "Senha de usuário não confere!", 'erro' => 2,));
	    }

	}
	
	//FUNÇÃO PARA reFECHAMENTO DE CAIXA
	public function reencerrarCaixa(){
	    $this->load->model('caixa/caixamodel');
	    $this->load->model('lojas/crudlojas');
	    $this->load->model('funcionarios/crudfuncionarios');
	    $this->load->model('clientes/crudclientes');
	    $this->load->model('formas_pagamento/crudformas');
	    $this->load->model('compras/crudcompras');
	    $this->load->model('contas/contasmodel');
	    $this->load->database();
	    if($this->session->userdata('tipo_pessoa') != 3){
	        $idcaixa = $this->uri->segment(3);
	    }else{
	        $caixaaberto = $this->caixamodel->pegarCaixaAbertoLoja2($this->session->userdata('loja_id'));
	        $idcaixa = $caixaaberto['id_caixa'];
	    }
	    
	    $cxunico = $this->caixamodel->pegarCaixaUnico($idcaixa);
	    $despesas = $this->contasmodel->getDespesasCaixa($cxunico['abertura_caixa']);
	    if($despesas != null){
	        $total = 0;
	        foreach($despesas as $des){
	            if($des['descontado_despesa'] == 0 && $dep['loja_id'] == $cxunico['loja_id']){
	                $total = $total + $des['valor_despesa'];
	                $despesa = $des;
	                $despesa['descontado_despesa'] = 1;
	                $this->contasmodel->atualizarDespesa($despesa, $des['id_despesa']);
	            }
	        }
	        $cxunico['troco_atual'] = $cxunico['troco_atual'] - $total;
	        $this->caixamodel->atualizarTroco($cxunico, $idcaixa);
	    }
	    
	    $this->caixamodel->fecharCaixa2($idcaixa, $cxunico);
	    $caixaunico = $this->caixamodel->pegarCaixaUnico($idcaixa);
	    
	    $dataexplode = explode('-', date('Y-m-d'));
        $datareforma = $dataexplode[2] . '-' . $dataexplode[1] . '-' . $dataexplode[0];
        $dia = new DateTime($datareforma);
        
        $dados = array(
                'loja'  => $this->crudlojas->getLojaUnica($caixaunico['loja_id']),
                'dia'   => $dia,
            );
        $valida = $this->caixamodel->pegarCaixaAbertoLoja($caixaunico['loja_id']);
        if($valida != null){
            $erro = 1;
            $diaex = explode('-', date('Y-m-d'));
            $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
            $dates = $dia .'|'. 99;
            $this->telaRelatorio($caixaunico['loja_id'], null, null, $dates, $erro);
        }else{
            $despesasaux = $this->contasmodel->getDespesasCaixaDtLoja(date('d/m/Y'), $caixaunico['loja_id']);
            $vendas = $this->crudcompras->getComprasLoja($caixaunico['loja_id']);
    	    $vlr_total = 0;
    	    $str = null;
    	    $totaldespesas = 0;
    	    if($despesasaux != null){
        	    foreach($despesasaux as $dep){
        	        $totaldespesas = $totaldespesas + $dep['valor_despesa'];
        	    }
    	    }
    	    foreach($vendas as $ven){
    	        $funcionario = $this->crudfuncionarios->getFuncionarioUnico($ven['funcionario_id']);
    	        if($funcionario != null){
                    $cliente = $this->crudclientes->getClienteUnico($ven['cliente_id']);
                    $dataex = explode('/', $ven['data_compra']);
        	        $dataref = $dataex[2] . '-' . $dataex[1] . '-' . $dataex[0];
        	        $dataa = new DateTime($dataref);
        	        $formas = explode('|', $ven['forma_id']);
        	        $data['forma'] = "";
                    $forma = $this->crudformas->getFormaId($formas[0]);
                    $data['forma'] .= $forma['nome_forma'];
                    unset($formas[0]);
                    
                    foreach($formas as $row){
                        if($row != ""){
                            $forma = $this->crudformas->getFormaId($row);
                            $data['forma'] .= ", " . $forma['nome_forma'];
                        }
                    }
        	        
        	        if($dia == $dataa){
        	            if($ven['valor_compra'] != 0.00){
                            $str = $str . 
                            "<tr>".
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['nota_venda'] . "</td>" .
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px'>&nbsp;" . $ven['data_compra'] . "</td>" .
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($funcionario['nome_funcionario']) . "</td>" .
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . mb_strtoupper($cliente['nome_cliente']) . "</td>" .
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: right'>&nbsp;R$ " . number_format($ven['valor_compra'], 2, ',', '.') . "</td>" .
                                "<td style='color: black; border: 1px solid lightgrey; font-size:10px; text-align: center'>&nbsp;" . $data['forma'] . "</td>" .
                            "</tr>";
                            $vlr_total = $vlr_total + $ven['valor_compra'];
        	            }
        	        }
        	    }
            }
            if($vlr_total != 0 || $totaldespesas != 0){
        	    $diaex = explode('-', date('Y-m-d'));
                $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                $dates = $dia .'|'. 99;
                $rd = $this->relatorioDespesas($caixaunico['id_caixa']);
        	    $total = $vlr_total . '|' . $totaldespesas;
        	    $str = $str . '|' . $rd;
        	    $this->telaRelatorio($caixaunico['loja_id'], $str, $total, $dates);
    	    }else{
    	        $erro = 2;
    	        $diaex = explode('-', date('Y-m-d'));
                $dia = $diaex[2] .'/'. $diaex[1] .'/'. $diaex[0];
                $dates = $dia .'|'. 99;
    	        $this->telaRelatorio($caixaunico['loja_id'], null, null, $dates, $erro);
    	    }
        }
	}
	
	//função que vai pegar o valor de um produto e devolver para a view
	public function pegaValor(){
	    $id = $this->input->post('id');
	    $this->load->model('estoque_produto/crudestoque');
	    
	    $estoque = $this->crudestoque->getEstoqueId($id);
	    $valor = str_replace('.', ',', str_replace(',', '', $estoque['venda_produto']));
	    
	    echo $valor;
	}
	
	public function valorTotal(){
	    $id = $this->input->post('id');
	    $qtde = $this->input->post('qtde');
	    $this->load->model('estoque_produto/crudestoque');
	    
	    $estoque = $this->crudestoque->getEstoqueId($id);
	    $aux = $estoque['venda_produto'] * $qtde;
	    $valor2 = number_format($aux, 2);
	    $valor = str_replace('.', ',', str_replace(',', '', $valor2));
	    
	    echo $valor;
	}
	
	//Verifica se há algum caixa aberto na loja
	function checaCaixa(){
	    $this->load->database();
        $this->load->model('caixa/caixamodel');
        $this->load->model('compras/crudcompras');
        
        $idLoja = $this->input->post('idLoja');
        $idCompra = $this->input->post('idCompra');
        
        $caixa = $this->caixamodel->pegarCaixaAbertoLoja($idLoja);
        $compra = $this->crudcompras->getCompraId($idCompra);
        
        if($caixa == null){
            $caixa = $this->caixamodel->pegarCaixaAbertoLoja2($idLoja);
            
            if($caixa != null){
                if($caixa['troco_atual'] < $compra['valor_compra']){
                    echo 2;
                }else{               
                    echo 1;
                }
            }else{
                echo 0;
            }
        }else{
            
            if($caixa['troco_atual'] < $compra['valor_compra']){
                echo 2;
            }else{               
                echo 1;
            }

        }
	}
	
	public function listaDevolucao(){
	    $this->load->database();
        $this->load->model('pdv/caixamodel');
        
        $data = array(
            'devolucao' => $this->caixamodel->devolucoes(),
            );
        $this->header(8);
        $this->load->view('restrito/caixa/devolucoes', $data);
        $this->footer();
        
	}
}