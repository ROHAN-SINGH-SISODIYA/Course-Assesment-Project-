<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends CI_Controller {

    var $session_user;

    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
      
        
    }


    /*
     * 
     */

    public function assesment($assesmentID="") {
        
        $result = $this->Auth_model->edit_assesment_question($assesmentID);  
        $data['Assesments_id_only'] = $result['Assesment'];  
        $data['questionList'] = $result['questionList'];  

        /*
         * Load view
         */
       // var_dump($data);exit();
        $this->load->view('includes/header' );
        $this->load->view('includes/navbar');
        $this->load->view('Assesment/index' ,$data);
        $this->load->view('includes/footer');
    }

}
