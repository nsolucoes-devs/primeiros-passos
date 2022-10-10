<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminperfil extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        // $this->load->model('perfil');
    }
    
    public function perfil(){
        $this->load->database();
        $this->load->model('usuarios');
        
        $id         = $this->session->userdata('user_id');
        $usuario    = $this->usuarios->usuarioId($id);
        
        $msg = "";
        if($this->session->userdata('msg')){
            $msg = $this->session->userdata('msg');
            $this->session->unset_userdata('msg');
        }
        
        $item = array(
            'nome'      => $usuario['nome_usuario'],
            'cpfcnpj'   => $usuario['cpfcnpj'],
            'telefone'  => $usuario['telefone'],
            'email'     => $usuario['email'],
            'foto'      => $usuario['foto'],
        );
        
        $data['usuario'] = $item;
        $data = array(
                'usuario'   => $item,
                'msg'       => $msg,
            );
        
        $this->header(7);
        $this->load->view('restrito/perfil', $data);
        $this->footer();
    }
    
    public function atualizarPerfil(){
        $this->load->database();
        $this->load->model('usuarios');
        
        $id         = $this->session->userdata('user_id');
        $user    = $this->usuarios->usuarioId($id);
        
        if(empty($_FILES['foto'])){
            $foto = $user['foto'];
        } else {
            $foto = "/imagens/usuarios/" . $id . ".png";
        }
        
        $usuario = array(
            'nome_usuario'      => $this->input->post('nome'),
            'cpfcnpj'           => $this->limpa($this->input->post('cpfcnpj')),
            'email'             => $this->input->post('email'),
            'telefone'          => $this->limpa($this->input->post('telefone')),
            'foto'              => $foto,
        );
        
        $this->usuarios->atualizarUsuario($usuario, $id);
        
        $config['upload_path']          = './imagens/usuarios/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['file_name']            = $id . ".png";
        $config['overwrite']            = true;
        
        $this->load->library('upload', $config);
        
        $this->upload->do_upload('foto');
        
        $this->session->set_userdata('msg', 2);
        
        redirect(base_url('1113c334193562fcb49c6557f14671f9'));
    }

    
}