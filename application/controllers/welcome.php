 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

      var $base;
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->base = $this->config->item('base_url');
        $this->load->helper('url');
        $this->load->model('loginmodel'); 
      if (NULL === $this->session->userdata('dootLoginDetails')) {
            $this->data['base'] = $this->base;
            header('Location: ' . $this->base . "universallogin");
        }

    }
        
        
         public function index() {
            if (TRUE || NULL === $this->session->userdata('dootLoginDetails')) {
                $this->data['base'] = $this->base;
                $this->session->unset_userdata('body_page_name');
                $this->load->view('welcome_message');
        }

    }
     public function about(){
        
          $this->session->set_userdata('body_page_name', 'about_company');
          
          
          $this->load->view('welcome_message');
    }  
    
    
     public function getQuestionAnswerAudioData() {
        $this->load->model('loginmodel');
        $LangId='E';
        print_r(json_encode($this->loginmodel->getQuestionAnswerAudioData($LangId)));
    }
    
     public function getQuestionAnswerHindiAudioData() {
        $this->load->model('loginmodel');
        $LangId='H';
        print_r(json_encode($this->loginmodel->getQuestionAnswerAudioData($LangId)));
    }
    
    public function questionViewEnglish(){
        
          $this->session->set_userdata('body_page_name', 'questionView');
          
          
          $this->load->view('welcome_message');
    } 
    
    public function questionViewHindi(){
        
          $this->session->set_userdata('body_page_name', 'hindiquestion');
          
          
          $this->load->view('welcome_message');
    } 
    
     public function gameScore(){
        
         
             $return_data = NULL;
       
            $this->load->model('loginmodel');
            $return_data['group_patient'] = $this->loginmodel->gameScorerecored();
            $this->session->set_userdata('body_page_name', 'gameScore');
             $this->load->view('welcome_message', $return_data);
         

    } 
    
    
    public function providerRegister() {
        $this->data = NULL;
       if (isset($this->session->userdata['dootLoginDetails'])) {
          // print_r('arif');
           $this->sessionData = $this->session->userdata('dootLoginDetails');
            $this->session->set_userdata('body_page_name', 'provider_register');
            $this->data['base'] = $this->base;
            $this->data['active_phc'] = $this->loginmodel->phcList();
            $this->data['active_state'] = $this->loginmodel->stateList();
//            $this->data['active_districtTB'] = $this->loginmodel->districtTBnamebyIdForTemp($this->sessionData['tbcenterId']);
            $this->load->view('welcome_message', $this->data);
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
        
        
        
        
        
        

 
    }
    
     public function selectDistrictListByStateId() {

        $this->load->model('loginmodel');
        $this->data['stateId'] = $_POST['stateId'];
        $this->returnedData = $this->loginmodel->districtList($this->data);

        echo json_encode($this->returnedData);
    }
     public function selectBlockListByDistrictId() {

        $this->load->model('loginmodel');
        $this->data['districtId'] = $_POST['districtId'];
        $this->returnedData = $this->loginmodel->blockList($this->data);

        echo json_encode($this->returnedData);
    }
    
    public function providerRegisterSubmittion(){
            $user_details = $this->session->userdata('dootLoginDetails');
            $this->load->model('loginmodel');
            $this->data['PhcId'] = $_POST['PhcId'];
            $this->data['ProviderName'] = $_POST['providername'];
            $this->data['PhoneNo'] = $_POST['phoneno'];
            $this->data['EmailId'] = $_POST['emailid'];
            $this->data['Gender'] = $_POST['gender'];
            $this->data['Age'] = $_POST['age'];          
            $this->data['CounryId'] = 1;
            $this->data['StateId'] = $_POST['StateId'];
            $this->data['DistrictId'] = $_POST['DistrictId'];
            $this->data['BlockId'] = $_POST['BlockId'];                     
            $this->data['ServiceType'] = $_POST['servicetype'];
            $this->data['LandMarkAddress'] = $_POST['landmark'];
            $this->data['UserId'] = $_POST['userid'];
            $this->data['Password'] = $_POST['password'];
           
            $this->loginmodel->registerProvider($this->data);
            redirect($this->base . 'Welcome/providerRegister');
     
 }
    
    public function assignTokensToProvider() {
        $this->data = NULL;
        $this->load->model('loginmodel');
        $user_details = $this->session->userdata('dootLoginDetails');

        if (isset($this->session->userdata['dootLoginDetails'])) {
            $this->data['active_provider'] = $this->loginmodel->providerList();
            $this->session->set_userdata('body_page_name', 'assignTokensToProvider');
            $this->data['base'] = $this->base;
           //  $this->data['tbunitInfo'] = $this->loginmodel->TBunitList($user_details['districtTbId']);  
            $this->load->view('welcome_message', $this->data);
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
 
}

    public function getUnAssignTokens() {
        $this->load->model('loginmodel');

        $user_details = $this->session->userdata('dootLoginDetails');
        print_r(json_encode($this->loginmodel->getUnAssignTokens()));
    }

     public function childData() {
        $this->data = NULL;
        $this->load->model('loginmodel');
        $user_details = $this->session->userdata('dootLoginDetails');

        if (isset($this->session->userdata['dootLoginDetails'])) {
            $this->data['active_phc'] = $this->loginmodel->phcList();
          //  $this->data['active_provider'] = $this->loginmodel->providerList();
            $this->session->set_userdata('body_page_name', 'childdata');
            $this->data['base'] = $this->base;
           //  $this->data['tbunitInfo'] = $this->loginmodel->TBunitList($user_details['districtTbId']);  
            $this->load->view('welcome_message', $this->data);
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
 
}

     public function getProviderListByPhcId() {

        $this->load->model('loginmodel');
        $this->data['phcId'] = $_POST['phcId'];
        $this->returnedData = $this->loginmodel->providerListByPhcId($this->data);

        echo json_encode($this->returnedData);
    }   
    
     public function childDataByProvider() {

        $this->load->model('loginmodel');
        $this->data['providerId'] = $_POST['providerId'];
        print_r(json_encode($this->loginmodel->childDataByProviderId($this->data)));
    }
    
     public function tokenInfo() {
        $this->data = NULL;
        $this->load->model('loginmodel');
        $user_details = $this->session->userdata('dootLoginDetails');

        if (isset($this->session->userdata['dootLoginDetails'])) {         
            $this->session->set_userdata('body_page_name', 'tokeninfo');
            $this->data['base'] = $this->base;
           //  $this->data['tbunitInfo'] = $this->loginmodel->TBunitList($user_details['districtTbId']);  
            $this->load->view('welcome_message', $this->data);
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
 
}
    
    public function  getTokenStatus()
    {
         $this->load->model('loginmodel');
         print_r(json_encode($this->loginmodel->tokenStatus()));
    }
    
    public  function vaccinePlanner()
    {
      $this->data = NULL;
        $this->load->model('loginmodel');
        $user_details = $this->session->userdata('dootLoginDetails');

        if (isset($this->session->userdata['dootLoginDetails'])) {         
            $this->session->set_userdata('body_page_name', 'vaccineplanner');
            $this->data['base'] = $this->base;
           //  $this->data['tbunitInfo'] = $this->loginmodel->TBunitList($user_details['districtTbId']);  
            $this->load->view('welcome_message', $this->data);
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }  
    }
    
    
    public function  vaccinePlannerData()
    {
        $this->load->model('loginmodel');
        print_r(json_encode($this->loginmodel->vaccinePlanner())); 
    }

    //Use after phc worker login
    public function getHealthWorkerIdWithTokens()
    {
        $this->load->model('loginmodel');

        $health_pid = $this->input->post('health_pid');
        $checked_id = $this->input->post('checked_id');
       
        $data['provider_id'] = $health_pid;
        $data['AssignTokenToHealthProvider'] = json_encode($checked_id);

        // print_r($data);
        return $this->loginmodel->saveHealthWorkerIdWithTokens($data);
    }

   //
   public function getProjectAdminIdWithToysTokenId()
   {
        $this->load->model('loginmodel');
        
        $projectAdminId = $this->input->post('projectAdminId');    
        $checked_id = $this->input->post('checked_id');

        $data['projectAdmin_id'] = $projectAdminId;
        $data['AssignToyToPAdmin'] = json_encode($checked_id);
        $data['isActive'] = 0;

        // print_r($data);
        return $this->loginmodel->saveProjectAdminIdWithToysTokenId($data);
   }

    public function selectTbunitsBydistTBid()
    {
        print_r("selectTbunitsBydistTBid");
    }
    
}

