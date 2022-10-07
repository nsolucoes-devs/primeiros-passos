<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissoes extends CI_Model {
    
    public function getPermissoes($id){
        $this->db->where('perfilusuario_id', $id);
        $perm = $this->db->get('perfilusuario');
        return $perm->row_array();
    }
    
    public function atualizaPermissao($perm, $id){
	    
	    $this->db->update('permissoes', $perm);
	}
	
	public function adicionarPermissao($perm){
	    $this->db->insert('permissoes', $perm);
        return $this->db->insert_id();
	}

    public function getPermissaoUsuario($id){
        $this->db->where('usuario_id', $id);
        $perm = $this->db->get('permissoes');
        return $perm->row_array();
    }
    
    public function deletePermissao($id){
        $this->db->where('usuario_id', $id);
        $this->db->delete('permissoes');
    }
    public function setUrl($url){
        //$this->db->where('cryptourls_local', $place);
        //$this->db->where('cryptourls_cryptourl', $url);
        $a = $this->db->get('cryptourls')->result_array(); 
        
/*
    106a6c241b8797f52e1e77317b96a201        dash    $route['106a6c241b8797f52e1e77317b96a201']          $route['home']                  'restrito/indexAdmin';
    de1f4acef7b9a599eb1e3114a1cc77ac        dash    $route['de1f4acef7b9a599eb1e3114a1cc77ac']          $route['getsorteios']           'restrito/getSorteios';
    f42cecfac2246fd0ff5baed4f2bf9489        dash    $route['f42cecfac2246fd0ff5baed4f2bf9489']          $route['getTitulos']            'restrito/getTitulos';
    
    ba38f5d73f05be599d0f0853daccdda1        live   $route['ba38f5d73f05be599d0f0853daccdda1']          $route['sorteio']               'restrito/sorteios';
    bd3271535adca6a587f2ee0cb7326ebd        live   $route['bd3271535adca6a587f2ee0cb7326ebd']          $route['cadastrarsorteio']      'sorteio/index';
    f913401b68c7543ce539bdc1aaf11410        live   $route['f913401b68c7543ce539bdc1aaf11410']          $route['cadastrosorteio']       'sorteio/cadastro';
    fc25e9e95d80270adee97c16a3c82ece/(:num) live   $route['fc25e9e95d80270adee97c16a3c82ece/(:num)']   $route['editarsorteio/(:num)']  'sorteio/editarSorteio/$1';
    8a537fbf575fd568bf2b0c006b9074fc/(:num) live   $route['8a537fbf575fd568bf2b0c006b9074fc/(:num)']   $route['versorteio/(:num)']     'restrito/verSorteio/$1';
    81bda9881837a904284daa240daa1695/(:num) live   $route['81bda9881837a904284daa240daa1695/(:num)']   $route['sorteando']             'sorteio/sorteando2A/$1';
    81bda9881837a904284daa240daa5961/(:num) live   $route['81bda9881837a904284daa240daa5961/(:num)']   $route['sorteando']             'sorteio/sorteando2/$1';

    bcb33e0857101429e219fe48c1b0bd96        premios 
    
    7348cba539160cf399993a4b23832856        transações
    
    cd741caa3bc66f96c5b29eff5bce2e75        reembolso
    
    b081acd570d459511f4adaf99d8b58b3        relatórios
    
    18b43c6a536a8fe1362f7a3887936be6        campanhas
    
    d969bcbee24a8b06fb0453da855c768a        definicao
    
    6208dc33658a7c2f73dd398c27a76fe1        usuarios
    
    13479dd27290f6be6c3d10218050d2c3        tipousuario
    
    6208dc33658a7c2f73dd398c27a76fe1        site
    
    9019cbe4458150159d9cc2f1cd473cf1        perfil

        if(is_array($a)){  
            return 1;
        }else{
            return 0;
        }*/
        return $a;
    }
}