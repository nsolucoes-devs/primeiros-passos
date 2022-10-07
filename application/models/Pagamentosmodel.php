<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentosmodel extends CI_Model {

    /**
     * Função que vai receber os dados do sistema e enviar via CURL para o PagSeguro
     * 
     * @param array
     * @param string
     * 
     * @return int
     * 
     */
    public function psCredCurl($psData, $psEmail){
        //-> Define o timezone para São Paulo
        date_default_timezone_set('America/Sao_Paulo');
        
        //-> Algumas configurações de envio
        $buildEnvio = http_build_query($psData);                                                    //-> Build do array de dados a serem enviados
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';                                  //-> URL da API
        $header = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');     //-> HTTP header requisitado pela API
        
        //-> Início dos comandos de CURL
        $curl = curl_init();                                                    //-> Iniciando o CURL
        curl_setopt($curl, CURLOPT_URL, $url . "?email=" . $psEmail);           //-> Configurando o URL de envio
		curl_setopt($curl, CURLOPT_POST, true);                                 //-> Configurando o modo de envio = "POST"
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);                        //-> Configurando o HTTP header requisitado
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                       //-> Configurando o retorno
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                      //-> Configurando a verificação de certificado SSL (Não sei ao certo o que é)
		curl_setopt($curl, CURLOPT_POSTFIELDS, $buildEnvio);                    //-> Configurando os dados a serem enviados
		curl_setopt($curl, CURLOPT_HEADER, false);                              //-> Configurando o header requisitado (Creio que usa ou o HTTP header ou o header)
		$xml = curl_exec($curl);                                                //-> Variável recebendo o XML retornado
		curl_close($curl);                                                      //-> Encerrando o CURL
		
		libxml_use_internal_errors(true);                                       //-> Permite obter informações do erro de forma interna
		
		$debugXML = $xml;                                                       //-> Armazenando o XML antes de fazer seu tratamento
		$xml = simplexml_load_string($xml);                                     //-> XML sendo tratado para poder utilizar
		
		//-> Caso dê erro no XML (Provavelmente alguma variável passando de forma errada) salva o erro
		if(false === $xml){
		    //-> Passa por todos os erros do XML
		    foreach(libxml_get_errors() as $error){                             //-> Laço para salvar o log dos erros
		        //-> Monta o array para enviar para o banco
		        $log = array(
		                'log_forma'     => 'CRÉDITO',                           //-> Forma de pagamento
		                'log_reference' => $psData['reference'],                //-> Código de referência no nosso sistema
		                'log_erro'      => $error->message,                     //-> Mensagem de erro retornada pelo XML
		                'log_data'      => date('d/m/Y'),                       //-> Data da inserção
		                'log_hora'      => date('H:i:s'),                       //-> Hora da inserção
		            );
		            
		        $this->insertLogErroXML($log);
		    }
		    
		    //-> Retorna 2 informando que ocorreu um erro no CURL
		    return 2;
		}else{
		    //-> Caso não dê erro...
		    //-> Retorna 1 informando que não ocorreu erro algum no CURL
		    return 1;
		}
    }
    
    /**
     * Função que via inserir o log de erro do XML no banco de dados
     * 
     * @param array
     * 
     */
    public function insertLogErroXML($log){
        $this->db->insert('log_xml_pagseguro', $log);
    }
    
    /**
     * Função que vai enviar o sms via CURL para a API
     * 
     * @param string
     * @param array
     * 
     */
    public function curlSMS($url, $post_data){
        //-> Início dos comandos de CURL
        $ch = curl_init();                                                      //-> Iniciando o CURL
        curl_setopt($ch, CURLOPT_URL, $url);                                    //-> Configurando o URL de envio
        curl_setopt($ch, CURLOPT_POST, true);                                   //-> Configurando o modo de envio = "POST"
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);                       //-> Configurando os dados a serem enviados
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         //-> Configurando o retorno
        $result = curl_exec($ch);                                               //-> Variável recebendo o XML retornado
        curl_close($ch);                                                        //-> Encerrando o CURL
    }
    
    /**
     * Função que vai fazer a conexão via CURL com o retorno do PagSeguro
     * 
     * @param string
     * 
     * @return array
     * 
     */
    public function curlRetornoPS($url){
        //-> Início dos comandos de CURL
        $curl = curl_init();                                                    //-> Iniciando o CURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                       //-> Configurando o retorno
        curl_setopt($curl, CURLOPT_URL, $url);                                  //-> Configurando o URL de envio
        $xml = curl_exec($curl);                                                //-> Variável recebendo o XML retornado
        curl_close($curl);                                                      //-> Encerrando o CURL
        
        $xml = simplexml_load_string($xml);                                     //-> Retorna um xml, portanto deve ser tratado antes de usado.
        
        $data = array(
                'reference' => $xml->reference,                                 //-> Referência setada ao enviar a requisição de compra
                'status'    => $xml->status,                                    //-> Status da transação
                'code'      => $xml->code,                                      //-> Código da transação do PagSeguro
            );
            
        return $data;
    }
}