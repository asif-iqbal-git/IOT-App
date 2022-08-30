<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController2 extends CI_Controller {

      
    public function __construct() {
        parent::__construct();
                
        $this->load->model('loginmodel'); 
     

    }

    public  function login()
    {
        $login_data['login_id'] = $this->input->post('login_id');       
        $login_data['password'] = $this->input->post('password');
        
        $isValid = $this->loginmodel->validateLoginUser($login_data);
      //var_dump($isValid);
      
       $userData = [                   
                    'login_id' => $isValid['login_id'],
                    'level'	=> $isValid['level'],
                    'isActive' => $isValid['isActive'],
                   ];
      
        // Set Session For login User
         $this->session->set_userdata('userData', $userData);
         var_dump($login_data);
        
        if($login_data['login_id'] === $isValid['login_id'] &&
           $login_data['password'] === $isValid['password'] )
        {
            if($isValid['isActive'] == 1){
               
               $this->load->view('welcome_message', $userData);
            }else{
               //var_dump($isValid);
               echo "False";
            }                        
          //  echo "True-ps is ok";
        }else{
            echo "False";
        }                  
    }
   
    public function logout()
    {
        $this->session->unset_userdata('login_id');
        $this->load->view('welcome_message');
    }

}


