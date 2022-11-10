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
        // var_dump($login_data);
      if(isset($isValid)){
 
      
        $userData = [                   
            'login_id' => ($isValid['login_id']),
            'level'	=> ($isValid['level']),
            'isActive' => ($isValid['isActive']),
           ];
            // Set Session For login User
            $this->session->set_userdata('userData', $userData);    
           
            //fetch company_name by login_id
            $company_name_by_login_id = $this->loginmodel->fetchCompanyName($userData['login_id']) ?? 0;
            
             //var_dump($company_name_by_login_id);
            if(isset($company_name_by_login_id)){
                if($company_name_by_login_id != 0){
            $company_name = [                                
                'companyName' => $company_name_by_login_id[0]->company_name
               ];
                // Set Session For login User
                $this->session->set_userdata('company_name', $company_name);  
                }
            }
                
        if(isset($login_data) && !empty($login_data)){
           
        
     
        if($login_data['login_id'] === $isValid['login_id']&&
           $login_data['password'] === $isValid['password'])
        {
                    if(isset($isValid['isActive']) == "1"){               
                         $this->load->view('welcome_message', $userData);
                    }else{                            
                        $errArr['userInactive'] = 'User is Not Active';
                    // $this->load->view('welcome_message', $errArr);               
                    }                        
            
                    }else{
                        $errArr['ErrorLogin'] = 'Error login id & Password';
                    //  $this->load->view('welcome_message', $errArr);
                    } 
                
            
            }   else{
                $errArr['EmptyString'] = 'Empty String';
              //  $this->load->view('welcome_message', $errArr);
             }           
    }else{
        echo"Error In login";
    }
}
    public function logout()
    {
        $this->session->unset_userdata('login_id');
        $this->session->unset_userdata('userData');
        $this->session->unset_userdata('company_name');
        
        $this->load->view('welcome_message');
    }

    
}


