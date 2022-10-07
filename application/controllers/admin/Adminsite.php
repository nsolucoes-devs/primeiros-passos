<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsite extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->load->database();
        $this->load->model('configs');
    }
    
    public function site(){
        
        if($this->session->userdata('msg')){
            $data['msg'] = $this->session->userdata('msg');
            $this->session->unset_userdata('msg');
        }
        
        $data['site'] = $this->configs->getSite();
        
        $this->header(6);
        $this->load->view('restrito/site', $data);
        $this->footer();
    }
    
        
    public function atualizarSite(){
        
        
        $site = array(
            'logo'                          => '/imagens/site/logo.png',
            'email'                         => $this->input->post('email'),
            'whats'                         => $this->limpa($this->input->post('whats')),    
            'telefone'                      => $this->limpa($this->input->post('telefone')),
            'facebook'                      => $this->input->post('facebook'),
            'instagram'                     => $this->input->post('instagram'),
            'twitter'                       => $this->input->post('twitter'),
            'termos'                        => $this->input->post('termos'),
            'endereco'                      => $this->input->post('endereco'),
            'nome_empresa'                  => $this->input->post('nome_empresa'),
            'cnpj'                          => $this->limpa($this->input->post('cnpj')),
            'sobre_loja'                    => $this->input->post('desc'),
            'politica_entrega'              => $this->input->post('desc2'),
            'politica_privacidade'          => $this->input->post('desc3'),
            'termos'                        => $this->input->post('desc4'),
            'banner_principal1'             => '/imagens/site/banner_principal1.png',
            'banner_principal2'             => '/imagens/site/banner_principal2.png',
            'banner_principal3'             => '/imagens/site/banner_principal3.png',
            'banner_principal4'             => '/imagens/site/banner_principal4.png',
            'banner_retangular1'            => '/imagens/site/banner_retangular1.png',
            'banner_retangular2'            => '/imagens/site/banner_retangular2.png',
            'banner_contato'                => '/imagens/site/banner_contato.png',
            'banner1_titulo'                => $this->input->post('banner1_titulo'),
            'banner2_titulo'                => $this->input->post('banner2_titulo'),
            'banner3_titulo'                => $this->input->post('banner3_titulo'),
            'banner4_titulo'                => $this->input->post('banner4_titulo'),
            'banner1_subtitulo'             => $this->input->post('banner1_subtitulo'),
            'banner2_subtitulo'             => $this->input->post('banner2_subtitulo'),
            'banner3_subtitulo'             => $this->input->post('banner3_subtitulo'),
            'banner4_subtitulo'             => $this->input->post('banner4_subtitulo'),
            'banner1_buttonTexto'           => $this->input->post('banner1_buttonTexto'),
            'banner2_buttonTexto'           => $this->input->post('banner2_buttonTexto'),
            'banner3_buttonTexto'           => $this->input->post('banner3_buttonTexto'),
            'banner4_buttonTexto'           => $this->input->post('banner4_buttonTexto'),
            'banner1_buttonLink'            => $this->input->post('banner1_buttonLink'),
            'banner2_buttonLink'            => $this->input->post('banner2_buttonLink'),
            'banner3_buttonLink'            => $this->input->post('banner3_buttonLink'),
            'banner4_buttonLink'            => $this->input->post('banner4_buttonLink'),
            'banner_retangular1Titulo'      => $this->input->post('banner_retangular1Titulo'),
            'banner_retangular2Titulo'      => $this->input->post('banner_retangular2Titulo'),
            'banner_retangular1Subtitulo'   => $this->input->post('banner_retangular1Subtitulo'),
            'banner_retangular2Subtitulo'   => $this->input->post('banner_retangular2Subtitulo'),
        );
        
        $this->uploadGui('banner_principal1', 'banner_principal1.png');
        $this->uploadGui('banner_principal2', 'banner_principal2.png');
        $this->uploadGui('banner_principal3', 'banner_principal3.png');
        $this->uploadGui('banner_principal4', 'banner_principal4.png');
        $this->uploadGui('banner_retangular1', 'banner_retangular1.png');
        $this->uploadGui('banner_retangular2', 'banner_retangular2.png');
        $this->uploadGui('banner_contato', 'banner_contato.png');
        $this->uploadGui('logo', 'logo.png');
        
        if($this->configs->getSite()){
            $this->configs->updateSite($site);
        } else {
            $this->configs->insertSite($site);
        }
        
        $this->session->set_userdata('msg', 1);
        
        redirect(base_url('af8889282b50f9030f8cc7a19b3f706d'), 'refresh');
    }
    
    public function uploadGui($file, $nome){
        $config['upload_path']      = './imagens/site/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = '2000';
        $config['overwrite']        = true;
        $config['file_name']        = $nome;
        
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);
        
        $this->upload->do_upload($file);
    }

    
}