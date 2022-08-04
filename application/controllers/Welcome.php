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
          $this->load->view('Ug/about_company');
          $this->load->view('Ug/universalfooter');
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
            $this->load->view('Ug/provider_register'); 
            $this->load->view('Ug/universalfooter');
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
            redirect($this->base . 'welcome/providerRegister');
     
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
            $this->load->view('Ug/assignTokensToProvider');
            $this->load->view('Ug/universalfooter');
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
            $this->load->view('Ug/childdata');
            $this->load->view('Ug/universalfooter');
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
            $this->load->view('Ug/tokeninfo');
            $this->load->view('Ug/universalfooter');
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
 
}
    
    public function  getTokenStatus()
    {
         $this->load->model('loginmodel');
        $this->load->library("pagination");
        
        $total_rows = $this->loginmodel->total_rows();

        $pageNumber = $this->input->post('pgNum');
		$per_page = $this->input->post('perPg');
       
        if($per_page==""){
			$per_page=10;
		}

		$linkData = $this->createLink($pageNumber,$per_page,$total_rows);
        
        $tableData = $this->loginmodel->tokenStatus($per_page,$linkData['offset']);  // Limit, offset
        
          // 
       // print_r(json_encode($this->loginmodel->tokenStatus()));

        print_r(json_encode(array('perPageOptions' => $linkData['perPageOptions'],
                                  'pageLink' => $linkData['pageLink'],
                                  'tableData' => $tableData)));
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
            $this->load->view('Ug/vaccineplanner');
            $this->load->view('Ug/universalfooter');
        } else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }  
    }
    
    
    public function  vaccinePlannerData()
    {
        $this->load->model('loginmodel');
        print_r(json_encode($this->loginmodel->vaccinePlanner())); 
    }
    
     public function childCommunication()
    {
        
        $tokenId=$this->input->post('tokenId');
        // check whether user is logged in or not and load child communication page
        if (TRUE || NULL === $this->session->userdata('dootLoginDetails')) {
            // initialize  data array

            $this->data = NULL;
            // load login model
            $this->load->model('loginmodel');

            $this->data['active_phc'] = $this->loginmodel->phcList();
            // get childCommunication data
            
          
            // load child communication page
            $this->data['base'] = $this->base;
            $this->session->set_userdata('body_page_name', 'childCommunication');
            
            $this->load->view('welcome_message', $this->data);
           
            $this->load->view('Ug/childCommunication'); 
            $this->load->view('Ug/universalfooter');
        }
        // otherwise redirect to login page
        else {
            header('Location: ' . $this->base . "UniversalLoginController");
        }
    }
    
     public function childCommunication_TokenId()
    {

        
        $this->load->model('loginmodel');
        $this->data['tokenId'] = $_POST['tokenId'];
        print_r(json_encode($this->loginmodel->childCommunication($this->data)));
    }
    
     public function loadTokenIdsUnderHealthWorker()
    {
        // get the health worker id from ajax call
        $healthWorkerId = $this->input->post('providerId');

        // echo json_encode($healthWorkerId);
        $this->load->model('loginmodel');
        $loadTokenIds = $this->loginmodel->getTokenDetails($healthWorkerId);
        echo json_encode($loadTokenIds);
    }

    
    public function getTokenIdwithToysId()
    {  
        $this->load->model('loginmodel');
        $tokenIdwithToysId = $this->loginmodel->fetchTokenIdWithToysId();
        echo json_encode($tokenIdwithToysId);
       // print_r("data");
    }

    public function getSinglePAdminInfo()
    {  
        $this->load->model('loginmodel');

        $id = $this->input->post('id'); //id => project admin id

        $pAdminInfo = $this->loginmodel->fetchSinglePAdminInfo($id);
         
        echo json_encode($pAdminInfo);
        
    }

    public function setTokenStatus()
    {
        $id = $this->input->post('checked_id'); //id => project admin id

         // str_replace($search, $replace, $subject)
        //$id = str_replace("token_id", "",$id);
        //var_dump($id);
        //send id to model(tblTokenMaster) and update `isAssign`status to 1
        // $id = (string)$id;
        // $id = explode("_",$id);
      
        print_r(json_encode($id));
    }
    























/*----------------------------------- Pagination start -----------------------------------*/

private function createLink($i,$per_page,$total_rows){ // here $i is requested Page

    //-----calculating total number of pages------------------
    $l = 0;  // Total Number Of Page
    if($total_rows % $per_page){
        $l=intval($total_rows/$per_page)+1;
    }
    else{
        $l=intval($total_rows/$per_page);
    }

    if($l==1){ $i=1;}

    //------Page Link Configuration ----------------
    $config=[
        "full_tag_open" => "<ul class='pagination'>",
        "full_tag_close" => "</ul>",

        "first_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax(1)'.'" class="page-link">First'.'</a></li>',
        

        "last_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.$l.')'.'" class="page-link">Last'.'</a></li>',


        "next_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.($i+1).')'.'" class="page-link">>'.'</a></li>',
        "next_tag_mute" => '<li class="page-item"><p class="page-link">></p></li>',
         

        "prev_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.($i-1).')'.'" class="page-link"><'.'</a></li>',
        "prev_tag_mute" => '<li class="page-item"><p class="page-link"><</p></li>',
        

        "num_tag_open" => '<li class="page-item"><a href="javascript:void(0)" onclick="backendPaginationAjax(',
        "num_tag_mid" => ')" class="page-link">',
        "num_tag_close" =>'</a></li>',

        "cur_tag" => '<li class="page-item active"><a href="javascript:void(0)" onclick="backendPaginationAjax('.$i.')" class="page-link">'.$i.'</a></li>',
        
    ];

    
    //--------------- Creating Page Link ---------------------------------------------
        $pageLink = $this->pageLinkFun($config,$i,$l);	
        
    // ---------------------Creating Per Page Options----------------------------------
        $perPageOptions = $this->perPageOptionsFun($per_page);

    // --------------------- Getting Offset -------------------------------------------

        $offset=$this->calculateOffset($i,$per_page);
         
    //-----Putting Page Link, Per Page Options And offset  into one array ------------
        $linkData=array(
            'pageLink' => $pageLink,
            'perPageOptions' => $perPageOptions,
            'offset' => $offset,
        );
        return $linkData;
}
private function pageLinkFun($config,$i,$l){

    //--------------- Creating Page Link -----------------------------------

    $link=$config['full_tag_open'];

    if($i>3 && $l!=1){
        $link.=$config['first_tag'];
    }
    if($i>1 && $l!=1){
        $link.=$config['prev_tag'];
    }

    if($l==1){
        $link.=$config['prev_tag_mute'];
        
    }

    if(($i-2)>=1){

        $link.=$config['num_tag_open'];
        $link.=$i-2;
        $link.=$config['num_tag_mid'];
        $link.=$i-2;
        $link.=$config['num_tag_close'];

        $link.=$config['num_tag_open'];
        $link.=$i-1;
        $link.=$config['num_tag_mid'];
        $link.=$i-1;
        $link.=$config['num_tag_close'];

        $link.=$config['cur_tag'];
    }
    else if(($i-1)>=1){

        $link.=$config['num_tag_open'];
        $link.=$i-1;
        $link.=$config['num_tag_mid'];
        $link.=$i-1;
        $link.=$config['num_tag_close'];

        $link.=$config['cur_tag'];
    }
    else{
        $link.=$config['cur_tag'];
    }


    if(($i+2)<=$l){

        $link.=$config['num_tag_open'];
        $link.=$i+1;
        $link.=$config['num_tag_mid'];
        $link.=$i+1;
        $link.=$config['num_tag_close'];

        $link.=$config['num_tag_open'];
        $link.=$i+2;
        $link.=$config['num_tag_mid'];
        $link.=$i+2;
        $link.=$config['num_tag_close'];
    }
    else if(($i+1)<=$l){

        $link.=$config['num_tag_open'];
        $link.=$i+1;
        $link.=$config['num_tag_mid'];
        $link.=$i+1;
        $link.=$config['num_tag_close'];
    }

    if(($i+2)<$l){
        $link.=$config['next_tag'];
        $link.=$config['last_tag'];
    }
    else if(($i+1)<=$l){
        $link.=$config['next_tag'];
    }

    if($l==1){
        $link.=$config['next_tag_mute'];
    }

    $link.=$config['full_tag_close'];

    return $link;
}


private function perPageOptionsFun($per_page){

    // ---------------------Creating Per Page Options------------------------	

    $perPageOptions='<select id="perPage" name="perPage">';

    for($k=10; $k<=100; $k+=10){
        if($per_page=="".$k){
            $perPageOptions.='<option selected value="';
            $perPageOptions.=$k;
            $perPageOptions.='">';
            $perPageOptions.=$k;
            $perPageOptions.='</option>';
        }
        else{
            $perPageOptions.='<option value="';
            $perPageOptions.=$k;
            $perPageOptions.='">';
            $perPageOptions.=$k;
            $perPageOptions.='</option>';
        }
    }
                         
    $perPageOptions.='</select>';


    return $perPageOptions;
}

private function calculateOffset($requestedPg,$per_page){
    // --------------------- Calculating Offset ------------------------

    $offset=($requestedPg-1)*$per_page;

    return $offset;
}


/*----------------------------------- Pagination ends-----------------------------------*/



}