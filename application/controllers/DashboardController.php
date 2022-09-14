<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author 
 */

class DashboardController extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
    }

    public function dashboard()
    {
        $userData = $this->session->userdata('userData');
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('superAdmin/dashboard');
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }



}