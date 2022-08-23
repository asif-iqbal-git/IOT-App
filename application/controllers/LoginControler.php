<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniversalloginControler
 *
 * @author zmq
 */
class LoginControler extends CI_Controller {
    //put your code here
function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->base = $this->config->item('base_url');
        $this->load->model('loginmodel');
        $this->load->database('default');
       // print_r("HI I am arif");
    }

    function Login() {

        $this->login_id = $this->input->post('login_id');
        $this->password = $this->input->post('password');
        
        $this->data = array(
                            'login_id' => $this->login_id, 
                            'password' => $this->password
                            );
        
        $this->dootLoginDetails = $this->loginmodel->validateDootLogin($this->data);

        if ($this->dootLoginDetails['success']) {
          //  print_r($this->dootLoginDetails);
          //  die();
            
            
            $this->session->set_userdata('current_logedIn', $this->data['login_id']);
            $this->session->set_userdata('dootLoginDetails', $this->dootLoginDetails);
        //////////////************ District Officer!***************************/////        
            // $this->data['loginData'] =  $this->dootLoginDetails;
            $this->load->view('welcome_message', $this->data);
        } else {

            $this->data['msg'] = '<font color=#DE4B4B>' . $this->dootLoginDetails['message'] . '</font><br/>';
            $this->index($this->data);
        }
    }

    public function Logout() {
        $this->session->unset_userdata('body_page_name');                             
        $this->session->unset_userdata('dootLoginDetails');
        $this->load->view('welcome_message');
    }

    function index() {
        $this->data['base'] = $this->base;
        $this->session->unset_userdata('body_page_name');
        $this->session->unset_userdata('dootLoginDetails');
        $this->load->view('welcome_message', $this->data);
    }
}