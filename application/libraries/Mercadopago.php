<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once('dx-php-master/init.php');
class Mercadopago
{
    public $config;
    
    public function __construct()
    {
        
        //carrega instancia unica.
        $CI = &get_instance();
		
        //carrega credenciais do config
		$CI->config->load("mercadopago", TRUE);
		$config = $CI->config->item('mercadopago');
        
        //dados do config
        $mode 							= $config['mode'];
        $this->config['client_id'] 		= $config['ci'];
        $this->config['client_secret'] 	= $config['cs'];
        $this->config['public_key'] 	= $config['public_key_'.$mode];
        $this->config['access_token'] 	= $config['access_token_'.$mode];
        
        
        //seta o config no servidor do MP
        MercadoPago\SDK::setClientId($this->config['client_id']);
		MercadoPago\SDK::setClientSecret($this->config['client_secret']);
      	MercadoPago\SDK::setAccessToken($this->config['access_token']);
		MercadoPago\SDK::setPublicKey($this->config['public_key']);
		       		
    }

    
    public function create_preference($preference_data)
    {
    	
          // Cria um novo objeto do MP
		  $preference = new MercadoPago\Preference();
		  
		  // seta produto(s) de venda (carrinho)
		  foreach($preference_data['items'] as $i){
		 	  # Cria o objeto a ser enviado
			  $item = new MercadoPago\Item();
			  $item->id = $i['id'];
			  $item->title = ($i['title']);
			  $item->quantity = $i['quantity'];
			  $item->currency_id = $i['currency_id'];
			  $item->unit_price = $i['unit_price'];
			  $array_items[] = $item;
		  }
		  
		  // Cria um objeto de pagamento
		  $payer = new MercadoPago\Payer();
		  $payer->email = $preference_data["payer_email"];
		  
		  // Propriedades de pagamento
		  $preference->items = $array_items;
		  $preference->payer = $payer;
		  
		  //referencias extras
		  $preference->external_reference 	= $preference_data['external_reference'];
		  $preference->back_urls   			= $preference_data['back_urls'];
		  $preference->auto_return 			= $preference_data['auto_return'];
		  
		  // Salva e posta as preferencias
		  $result = $preference->save();
		  
		  //Retorna as preferencias com as datas da url de pagamento do objeto
		  return $preference;
		  
    }
    
}