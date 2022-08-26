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
   
        $this->base = $this->config->item('base_url');
        $this->load->model('loginmodel');
        $this->load->database('default');
       // print_r("HI I am arif");
    }

    /*
    public function Login() {

        $this->username = trim($this->input->post('username'));
        $this->password = $this->input->post('password');

        $this->data = array('userId' => $this->username, 'password' => $this->password);
        $this->dootLoginDetails = $this->loginmodel->validateDootLogin($this->data);

        if ($this->dootLoginDetails['success']) {
            
            $this->session->set_userdata('current_logedIn', $this->data['userId']);
            $this->session->set_userdata('dootLoginDetails', $this->dootLoginDetails);
                
            // $this->data['loginData'] =  $this->dootLoginDetails;
            $this->load->view('welcome_message', $this->data);
        } else {

            $this->data['msg'] = '<font color=#DE4B4B>' . $this->dootLoginDetails['message'] . '</font><br/>';
            $this->index($this->data);
        }
    }
    */
    public function Login() {

        $login_data['login_id'] = $this->input->post('username');       
        $login_data['password'] = $this->input->post('password'); 
        
        //$this->data = array('login_id' => $this->username, 'password' => $this->password);
        
        $dootLoginDetails = $this->loginmodel->validateDootLogin($login_data);
       // var_dump($dootLoginDetails);   die();
        if ($dootLoginDetails['success']) {
            
           $this->session->set_userdata('current_logedIn', $login_data['login_id']);
           
           $this->session->set_userdata('dootLoginDetails', $dootLoginDetails);
           $this->load->view('libs');
            // $this->data['loginData'] =  $this->dootLoginDetails;
            $this->load->view('welcome_message', $login_data);
        } else {

            $this->data['msg'] = '<font color=#DE4B4B>' . $dootLoginDetails['message'] . '</font><br/>';
            $this->index($login_data);
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
      //  $this->session->unset_userdata('dootLoginDetails');
        $this->load->view('welcome_message', $this->data);
    }

    public function checkSSN() {
        $val = $this->session->userdata('dootLoginDetails');
        var_dump($val);
    }
}