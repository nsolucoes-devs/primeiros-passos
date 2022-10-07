<?php 
$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'mail.nsolucoes.digital',
    'smtp_port' => 465,
    'smtp_timeout' => '7',
    'smtp_user' => 'contato@nsolucoes.digital',
    'smtp_pass' => 'b7tZk,?!C)+#',
    'charset'   => 'utf-8',
    'newline'   => "\r\n",  
    'mailtype'  => 'html',    
    'validation'  => TRUE,
);
/*
$this->load->library('email');

$this->email->initialize($config);

$this->email->from('sender_mailid@gmail.com', 'sender_name');
$this->email->to('recipient@gmail.com'); 
$this->email->subject('Email Test');
$this->email->message('Testing the email class.');  

$this->email->send();

echo $this->email->print_debugger();
    'protocol'      => 'smtp',
    'smtp_host'     => 'mail.nsolucoes.digital', 
    'smtp_port'     => '465',
    'smtp_user'     => 'contato@nsolucoes.digital',
    'smtp_pass'     => '?cCVwCRZAhAn',
    'smtp_crypto'   => 'ssl',
    'mailtype'      => 'html',// ou text
    'smtp_timeout'  => '4', 
    'charset'       => 'utf-8',
    'wordwrap'      => TRUE,
    'newline'       => "\r\n",
*/
?>