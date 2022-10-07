<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formas_pagamento extends MY_Controller {
    
    //Chama a view de listagem de forma de pagamento passando o array de forma de pagamento
	public function listaFormas(){
	    $this->load->database();
	    $this->load->model('formas_pagamento/Crudformas');
	    
	    $data['formas'] = $this->Crudformas->getFormas();
	    
	    $this->header(12);
	    $this->load->view('formas/mostrarFormas', $data);
	    $this->footer();
	}
	
	//Recebe e adiciona uma forma de pagamento ao banco de dados
	public function adicionarForma(){
	    $this->load->database();
	    $this->load->model('formas_pagamento/Crudformas');
	    
	    $nome = $this->input->post('nome');
	    
	    if(!empty($this->input->post('vezes')) && $this->input->post('qtdVezes') != 0){
	        $vezes = $this->input->post('qtdVezes');
	    }else{
	        $vezes = 1;
	    }
	    
	    $forma = array(
	        'nome_forma' => $nome, 
	        'vezes_pagamento' => $vezes
	    );
	    
	    $this->Crudformas->adicionarForma($forma);
	    
	    $this->listaFormas();
	}
	
	//Recebe o id de uma forma de pagamento e a exclui
	public function excluirForma(){
	    $this->load->database();
	    $this->load->model('formas_pagamento/Crudformas');
	    
	    $id = $this->input->post('campo');
	    
	    $this->Crudformas->excluirForma($id);
	    
	    $this->listaFormas();
	}
	
	//Recebe e atualiza uma cor no banco de dados
	public function atualizarForma(){
	    $this->load->database();
	    $this->load->model('formas_pagamento/Crudformas');
	    
	    $nome = $this->input->post('nome2');
	    $id = $this->input->post('campo2');
	    
	    if(!empty($this->input->post('vezes2')) && $this->input->post('qtdVezes2') != 0){
	        $vezes = $this->input->post('qtdVezes2');
	    }else{
	        $vezes = 1;
	    }
	    
	    $forma = array(
	        'nome_forma' => $nome, 
	        'vezes_pagamento' => $vezes
	    );
	    
	    $this->Crudformas->atualizarForma($forma, $id);
	    
	    $this->listaFormas();
	}
	
	//Recebe o id de uma forma de pagamento do pdv, busca no bd e a retorna os 
	//selects de forma de pagamento
	public function getFormasPdv(){
	    $this->load->database();
	    $this->load->model('pdv/Crudformas');
	    
	    $id = $this->input->post('idPagamento');
	    $option = "";
	    
	    $forma = $this->Crudformas->getFormaId($id);
	    $formas = $this->Crudformas->getFormasAtivoUnico();
	    
	    if($forma['vezes_pagamento'] == 1){
	        echo 1;
	    } else{
	        $option .= "<div class='row'>";
	        for($i = 1; $i <= $forma['vezes_pagamento']; $i++){
	            $option .= "<div class='form-group col-md-6'>
	                        <label>";
	            $option .= $i . "ª Vez </label>";          
	            $option .= "<select name='forma" . $i . "' id='forma" . $i . "' class='form-control' style='width: 100%' onchange='valueacrescimo2(this.value, ".$i.")' ><option selected disabled >Selecione</option>";
                    
                foreach($formas as $row) {
                        $option .= "<option value='" . $row['id_forma'] . "' > " . $row['nome_forma'] . "</option>";
                    }
                    
                $option .= "</select> </div> 
                <div class='form-group col-md-6'>
                    <label>Valor</label>
                    <input class='form-control' type='number' id='pagamento" . $i . "' name='pagamento" . $i . "' placeholder='R$' onchange='validavalor(this.value)'>
                    <input type='hidden' id='dualAcrescimo" . $i . "' name='dualAcrescimo" . $i . "' value='0'>
                </div>
                ";    
	        }
	        $option .= "<input type='hidden' id='dualAcresTotal' name='dualAcresTotal'></div>";
	        $numFormas = $i - 1; 
	        $option .= "<input class='form-control' type='hidden' id='numFormas' value='" . $numFormas . "'><input class='form-control' type='hidden' id='auxValRest' value=''><em id='pagamento_erro' style='display:none; margin-top:6px; padding:0 1px; font-style:normal; font-size:11px; line-height:15px; color:#D56161;'></em>";
	        $option .= "<div class='form-group alert alert-danger text-center' role='alert' style='display: none;' id='erroParcelamento'>
                A soma das parcelas não condiz com o valor da compra!
            </div>";
             $option .= "<div class='form-group alert alert-danger text-center' role='alert' style='display: block;' id='erroForma'>
                Selecione as formas de Pagamento!
            </div>";
            $option .= "<div class='form-group alert alert-danger text-center' role='alert' style='display: none;' id='erroData2'>
                Uma ou mais datas não foram selecionadas!
            </div>";
	        echo $option;
	    }
	}
}

?>