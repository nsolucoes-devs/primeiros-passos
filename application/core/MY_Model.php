<?php

class MY_Model extends CI_Model{
    
    protected $active_group;
    //protected $db2; // <------ Acessa o 2º db 

    public function __construct() {
        parent::__construct();
        $this->connect();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function connect($active_group = 'default'){
        $this->active_group = $active_group;
        $db = $this->load->database($active_group, TRUE);
        $this->db = $db;

        // Acessa db2
        //$db2 = $this->load->database('extern_db', TRUE);
        //$this->db2 = $db2;
    }

}