<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends CI_Controller {

    var $session_user;

    function __construct() {
        parent::__construct();

    
        
    }

    /*
     * 
     */
    public function index()
    {
            $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('Display/Display');
        $this->load->view('includes/footer');
    }
    public function Display_all() {
        
        $this->load->model('Auth_model');
       
            $data=$this->Auth_model->diplayrecord();
        echo json_encode($data);
        /*
         * Load view
       */
    }
    

}

