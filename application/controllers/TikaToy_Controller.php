<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TikaToy_Controller
 *
 * @author zmq
 */
class TikaToy_Controller extends CI_Controller{
      public $data=array();
     //put your code here
 public function __construct() {
        parent::__construct(); 
        $this->load->database();
         $this->load->model('tikatoy_model'); 
    }
    
    
    
    
   public  function AreaInformation() {

   
      
      date_default_timezone_set('Asia/Calcutta'); 
      $now = new DateTime();
      $serverdate= $now->format('Y-m-d');

   
      $this->data=NULL;
    
                   
                    
                  
                    $this->data['stateInfo']=$this->tikatoy_model->getStatedataforDMC(); 
                    $this->data['districtInfo']=$this->tikatoy_model->getDistrictdataforDMC(); 
                    $this->data['blockInfo']=$this->tikatoy_model->getBlockdataforDMC(); 
                    $this->data['serverDate']=$serverdate;
                    

        echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
    }
    
   
 
   
    public  function  VaccinePlannerDetails()
    {
    
                   $this->data=NULL;
                  $this->data['vaccinePlannerInfo']=$this->tikatoy_model->getVaccinePlannerDetails(); 
                 echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
    }
   
    
    
  
  
   function officerLogin() {

  //  $username = '9654379163';
  //  $password = '12345'; 
      
      
      date_default_timezone_set('Asia/Calcutta'); 
      $now = new DateTime();
      $serverdate= $now->format('Y-m-d');

        
$username = $_POST['username'];
$password = $_POST['password']; 

        $this->data = array('UserId' =>  $username, 'Password' => $password);
       
     
        $this->loginDetails = $this->tikatoy_model->selectPatientDetailsFromServer($this->data);
       // print_r($this->loginDetails);
        $this->data=NULL;
        if ($this->loginDetails['success']) 
            {
                   $this->data['status'] = $this->loginDetails['message'];
                    $this->data['profile']=array('empId'=>$this->loginDetails['EmpId'],'empName'=>$this->loginDetails['ProviderName'],'contactNo'=>$this->loginDetails['PhoneNo'],'address'=>$this->loginDetails['LandMarkAddress'],'phcId'=>$this->loginDetails['PhcId'],'phcName'=>$this->loginDetails['PhcName']);
                  
                    $this->data['stateInfo']=$this->tikatoy_model->getStatedataforDMC(); 
                    $this->data['districtInfo']=$this->tikatoy_model->getDistrictdataforDMC(); 
                    $this->data['blockInfo']=$this->tikatoy_model->getBlockdataforDMC(); 
                    $this->data['plannerInfo']=$this->tikatoy_model->getplannerInfo(); 
                  //  $this->data['tokenInfo']=$this->tikatoy_model->getTokenInfo($this->loginDetails['EmpId']); 
                    $this->data['vaccineInfo']=$this->tikatoy_model->getVaccinePlannerDetails();
                    $this->data['childData']=$this->tikatoy_model->childInfo($this->loginDetails['EmpId']);
                    $this->data['serverDate']=$serverdate;
                    
                    
       
              
            
            
             
            
        } 
        else 
           {

            $this->data['Status'] = $this->loginDetails['message'] ;
         
           }
         
        
       
        echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
    }
  
  
   
   
   
   
   
   
   function RegisterProvider()
   {
   
   $UserId= $_POST['UserId'];
   $Password= $_POST['Password']; 
   $ProviderName=$_POST['ProviderName'];
   $PhoneNo=$_POST['UserId'];
   $EmailId=$_POST['EmailId'];
   $Gender=$_POST['Gender'];
   $Age=$_POST['Age'];
   $Qualification=$_POST['Qualification'];
   $ServiceType=$_POST['ServiceType'];
   $Clinic_PHCName=$_POST['Clinic_PHCName'];
   $CounryId=$_POST['CounryId'];
   $StateId=$_POST['StateId'];
   $DistrictId=$_POST['DistrictId'];
   $BlockId=$_POST['BlockId'];
   $LandMarkAddress=$_POST['LandMarkAddress'];
 
  //  $UserId= '7895846218';
  //  $Password= '1234'; 
  //  $ProviderName='Fayyaz';
  //  $PhoneNo='7895846218';
  //  $EmailId='fy@zmq.in';
  //  $Gender='Male';
  //  $Age=29;
  //  $ServiceType='Public';
  //  $Clinic_PHCName='XYZ';
  //  $CounryId=1;
  //  $StateId=1;
  //  $DistrictId=1;
  //  $BlockId=2;
  //  $LandMarkAddress='xyz';
   
   
   
    $this->data = array('UserId' =>  $UserId, 'Password' => $Password,'ProviderName'=>$ProviderName,'PhoneNo'=>$PhoneNo,'EmailId'=>$EmailId,'Gender'=>$Gender,'Age'=>$Age,'Qualification'=>$Qualification,'ServiceType'=>$ServiceType,'Clinic_PHCName'=>$Clinic_PHCName,
    'CounryId'=>$CounryId,'StateId'=>$StateId,'DistrictId'=>$DistrictId,'BlockId'=>$BlockId,'LandMarkAddress'=>$LandMarkAddress);
   $this->registerDetails = $this->tikatoy_model->RegisterProvider($this->data);
   
   $this->data=null;
   if ($this->registerDetails ['success']) 
            {
           
                    $this->data['Status'] = '1';    
                     
             } 
        else {


            $this->data['Status'] = '0' ;
         
         }
   
   
    echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
   
   
   
   }
   
  
  
  
  
  
  function ChildRegister_Old()
  {
  
   $ChildName= $_POST['ChildName'];
   $DOB= $_POST['DOB']; 
   $Gender=$_POST['Gender'];
   $FatherName=$_POST['FatherName'];
   $MotherName=$_POST['MotherName'];
   $ParentPhoneNo=$_POST['ParentPhoneNo'];
   $CountryId=$_POST['CountryId'];
   $StateId=$_POST['StateId'];
   $DistrictId=$_POST['DistrictId'];
   $BlockId=$_POST['BlockId'];
   $LandMarkAddress=$_POST['LandMarkAddress'];
   $VaccinePlannerId=$_POST['VaccinePlannerId'];
   $ProviderId=$_POST['ProviderId'];
   

  // $ChildName= 'Sahil';
  // $DOB= '2017-05-25'; 
  // $Gender='Male';
  // $FatherName='Abdul';
  // $MotherName='Tahira';
  // $ParentPhoneNo='9985652222';
  // $CountryId=1;
  // $StateId=1;
  // $DistrictId=1;
  // $BlockId=1;
  // $LandMarkAddress='NSP';
  // $VaccinePlannerId=1;
  // $ProviderId=11;


  $this->data = array('ChildName' =>  $ChildName, 'DOB' => 
 $DOB,'Gender'=>$Gender,'FatherName'=>$FatherName,'MotherName'=>$MotherName,'ParentPhoneNo'=>$ParentPhoneNo,'CountryId'=>$CountryId,'StateId'=>$StateId,
  'DistrictId'=>$DistrictId,'BlockId'=>$BlockId,'LandMarkAddress'=>$LandMarkAddress,'VaccinePlannerId'=>$VaccinePlannerId,'ProviderId'=>$ProviderId );
   
   $this->registerDetails = $this->tikatoy_model->ChildRegister($this->data);
   
   //$this->ReturnChildId=$this->tikatoy_model->getChildId($data['childId']);
   
   $this->data=null;
   if ($this->registerDetails ['success']) 
            {
           
                    $this->data['Status'] = '1';
                    $this->data['ChildId'] = $this->registerDetails ['childId'];   
                    $this->data['MainChildId'] = $this->registerDetails ['mainchildId'];    
                     
             } 
        else {


            $this->data['Status'] = '0' ;
            $this->data['ChildId']='0';
            $this->data['MainChildId']='0';
         
         }
   
   
    echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
  
  
  
  
  }
  
  function ChildRegister() {

        $data = json_decode(file_get_contents("php://input"), TRUE);
        $return_data = NULL;

        if ($data['ChildName'] != NULL and $data['DOB'] != NULL and $data['Gender'] != NULL and $data['FatherName'] != NULL and $data['MotherName'] != NULL and $data['ParentPhoneNo'] != NULL and $data['CountryId'] != NULL and $data['StateId'] != NULL and $data['DistrictId'] != NULL and $data['BlockId'] != NULL and $data['LandMarkAddress'] != NULL and $data['VaccinePlannerId'] != NULL and $data['ProviderId'] != NULL) {

            $this->data = array('ChildName' => $data['ChildName'], 'DOB' =>
                $data['DOB'], 'Gender' => $data['Gender'], 'FatherName' => $data['FatherName'], 'MotherName' => $data['MotherName'], 'ParentPhoneNo' => $data['ParentPhoneNo'], 'CountryId' => $data['CountryId'], 'StateId' => $data['StateId'],
                'DistrictId' => $data['DistrictId'], 'BlockId' => $data['BlockId'], 'LandMarkAddress' => $data['LandMarkAddress'], 'VaccinePlannerId' => $data['VaccinePlannerId'], 'ProviderId' => $data['ProviderId'] ,'TokenId'=>$data['TokenId']);

            $this->registerDetails = $this->tikatoy_model->ChildRegister($this->data);
            $this->data = null;
            if ($this->registerDetails ['success']) {

                $this->data['Status'] = TRUE;
                $this->data['ChildId'] = $this->registerDetails ['childId'];
                $this->data['MainChildId'] = $this->registerDetails ['mainchildId'];
                $this->data['AllFieldStatus'] = '1';
            } else {


                $this->data['Status'] = FALSE;
                $this->data['ChildId'] = '0';
                $this->data['MainChildId'] = '0';
                $this->data['AllFieldStatus'] = '1';
            }

            echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
        } 
        else {


            $this->data['Status'] = FALSE;
            $this->data['ChildId'] = '0';
            $this->data['MainChildId'] = '0';
            $this->data['AllFieldStatus'] = '0';
            echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
        }
    }
  
  
  
  
  
  
  function TokenMapping()
  {
  
   $ChildId= $_POST['ChildId'];
   $TokenId= $_POST['TokenId']; 
   $AssigningDate=$_POST['AssigningDate'];
   
 


  $this->data = array('ChildId' =>  $ChildId, 'TokenId' => $TokenId,'AssigningDate'=>$AssigningDate);
   
   $this->registerDetails = $this->tikatoy_model->TokenMapping($this->data);
   
  
   $this->data=null;
   if ($this->registerDetails ['success']) 
            {
           
                    $this->data['Status'] = '1';
                   
                     
             } 
        else {


            $this->data['Status'] = '0' ;
           
         
         }
   
   
    echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
  
  
  
  
  }
  
  
  
  public  function TokensInfoByProviderId()
  {
       $data = json_decode(file_get_contents("php://input"), TRUE);
      
       if ($data['ProviderId'] != NULL )
       {
        $this->data['status']=TRUE ;  
        $this->data['tokenInfo']=$this->tikatoy_model->getTokenInfo($data['ProviderId']);
        if($this->data['tokenInfo']==NULL)
          $this->data['status']=FALSE ;    
        
       }
       else
       {
         $this->data['status']=FALSE ;  
       }
       
       echo json_encode($this->data, JSON_UNESCAPED_SLASHES);
  }
  
   
  
   public function ChildVaccination() {
         $data1 = json_decode(file_get_contents("php://input"), TRUE);
        $child_details = [
            'provider_id' =>$data1['provider_id'],
            'child_id' =>$data1['child_id'],  
                         
        ];
  
        $vaccine_data = [
            'vaccine_id' => $data1['vaccine_id'],
            'vaccine_date' => $data1['vaccine_date']
        ];
      

        if ($child_details['provider_id'] == NULL or $child_details['child_id'] == NULL ) {
            $this->response(array('status' => FALSE, 'error' => 'plz fill all details of child'));
        } else {
      
            $result = $this->insert_child_vaccination($child_details, $vaccine_data);
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
        }
    }
      private function insert_child_vaccination($child_details = NULL, $vaccine_data = NULL) {
        $child_array = [];
        $vaccine_ids = [];
        foreach ($child_details as $key => $item) {
            $questions_step = 0;
            foreach (explode(':', $item) as $value) {
                $child_array[$key][$questions_step] = $value;
                $questions_step++;
            }
        }
        foreach ($vaccine_data as $key => $item) {
            $questions_step = 0;
            foreach (explode('#', $item) as $value) {
                $vaccine_ids[$key][$questions_step] = $value;
                $questions_step++;
            }
        }
       
        $result = $this->tikatoy_model->insert_child_vaccine_details($child_array, $vaccine_ids);
        $result['status']= $result['status'];
        return $result;
    }
     
  
   public function Child_Vaccine_Status()
     { 
      
         if (isset($_POST['childId']) and $_POST['childId'] != NULL) {
            
         $return_data['vaccine_detail']=$this->tikatoy_model->childvaccineDetails($_POST['childId']);
        
        }
         print_r(json_encode($return_data));
        
     }   
    
   
}

?>
