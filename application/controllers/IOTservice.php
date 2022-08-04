<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IOTservice
 *
 * @author zmq
 */
class IOTservice extends CI_Controller {
    
    public $data=array();
   var $returnedData; 
    
    function __construct()
    {
       
      parent::__construct();
    
      $this->load->database();
     
      $this->load->helper('download');
     /// $this->load->library('Format');
     $this->load->library('session');

    }
     
    
    
    

    
    
    
    
  function OK()
   {
       
       date_default_timezone_set('Asia/Calcutta');
       $now = new DateTime();
       $datetime1 = new DateTime($now->format('Y-m-d H:i:s'));

       //$data['data'] = $now;



      echo json_encode( $datetime1);
    
        
   }
    
    
   function index()
   {
       
$val = array();
$val["id"]="123456";
$val["name"]="adam";
$a=array("Apple"=>10,"Orange"=>40,"Mango"=>80,"Banana"=>30);
$b=array("Apple"=>10,"Orange"=>40,"Mango"=>80,"Banana"=>30);
$data['a'] = $a;
$data['b'] = $a;
//$data["item"]=$val;

echo json_encode($data);
    
        
   }
    
  
  
  
  function downloadTest() { 
  
 // $this->data['Status']='Success';
 
  //$this->data['Qst']= '1';
  //$this->data['QstNo']='4';
  $str=null; 
   $name1=null;
    $name=null;
    $st=null;
    
   // $this->data['Lang']=  'H';
  // $this->data['Qst']=  '2' ;
 // $this->data['QstNo']='1';
    
 $this->data['Lang']=  (string)$_GET['Lang'];
 $this->data['Qst']=  (string)$_GET['QuestionId'] ;
 $this->data['QstNo']= (string)$_GET['QuestionNo'];
  
  
  
  
 $this->data['QstNo']= $this->data['QstNo'].$this->data['Qst'];
 
 
 if($this->data['Lang']=='E')
 {
 $str="http://iot4d.in/IOTapps/complianceMode/IE/Q.mp3";
 $st=str_replace('Q','QE'. $this->data['QstNo'],$str);
 }
 
 else
 {
 $str= "http://iot4d.in/IOTapps/complianceMode/IH/Q.mp3";
 $st=str_replace('Q','QH'. $this->data['QstNo'],$str);
 }
 



$data1 = file_get_contents($st);   
 


 if($this->data['Lang']=='E')
 {
  $name1 = 'Q.mp3'; 
  $name=str_replace('Q','QE'. $this->data['QstNo'], $name1);
 }
 else
 {
 $name1 = 'Q.mp3'; 
  $name=str_replace('Q','QH'. $this->data['QstNo'], $name1);
 
 }





 
  

force_download($name,$data1);
//echo json_encode( $st);
   
  }

  
   
  
  
    
    
   function download() { 
  
 // $this->data['Status']='Success';
 // $this->data['Qst']= '4';
 // $this->data['QstNo']= '5'; 
  
$this->data['Qst']=  (string)$_GET['QuestionId'];
$this->data['QstNo']=(string)$_GET['QuestionNo'];
  
   
 
$str="http://198.143.170.147/IOTapps/complianceMode/L/Q.mp3";
$st=str_replace('Q','Q'. $this->data['Qst'],$str);
  //print_r($st);
 $st=str_replace('L','L'. $this->data['QstNo'],$st);
  //print_r( $st);
  
 $data = file_get_contents($st);   
 
//echo json_encode( $this->data);
 //echo json_encode( $this->data);
  $name1 = 'Q.mp3'; 
  $name=str_replace('Q','Q'. $this->data['Qst'], $name1);
   //print_r($name);
//echo time();
//sleep(20);
force_download($name,$data);
echo time();
  //echo time();
            // sleep(10);
             //echo time();
 
 
 

   
  }
    
    
    
    
    
    
    
    function downloadMessage() { 
  
 // $this->data['Status']='Success';
//$this->data['Lang']= 'E';
//$this->data['MsgNo']= '1'; 
  
$this->data['Lang']=  (string)$_GET['Lang'];
$this->data['MsgNo']=(string)$_GET['MsgNo'];
  
   $str=null; 
   $name1=null;
    $name=null;
    $st=null;
 if($this->data['Lang']=='E')
 {
 $str="http://iot4d.in/IOTapps/complianceMode/ME/Q.mp3";
 $st=str_replace('Q','ME'. $this->data['MsgNo'],$str);
 }
 else
 {
 $str="http://iot4d.in/IOTapps/complianceMode/MH/Q.mp3";
 $st=str_replace('Q','MH'. $this->data['MsgNo'],$str);
 }


  //print_r($st);
 //$st=str_replace('L','L'. $this->data['QstNo'],$st);
  //print_r( $st);
  
 $data = file_get_contents($st);   
 
//echo json_encode( $this->data);
 //echo json_encode( $this->data);
  if($this->data['Lang']=='E')
 {
  $name1 = 'Q.mp3'; 
  $name=str_replace('Q','ME'. $this->data['MsgNo'], $name1);
 }
 else
 {
 $name1 = 'Q.mp3'; 
  $name=str_replace('Q','MH'. $this->data['MsgNo'], $name1);
 
 }
 
   //print_r($name);
//echo time();
//sleep(20);
force_download($name,$data);
echo time();
  //echo time();
            // sleep(10);
             //echo time();
 
 
 

   
  }
    
    
    
    
    
    
    
   function  IOT_TestForNewRegPatient()
    {
        date_default_timezone_set('Asia/Calcutta');
       $now = new DateTime();
       $hourdiff = $_GET['difference'];
       $datetime1 = new DateTime($now->format('Y-m-d H:i:s'));
$q="select * from tb_patient_partial_registration_for_dmc_testing where ForAhmed=1";
$query=$this->db->query($q);
$di=0;
$array = ($query->result());
            foreach ($array as $value) {
            $interval1 = $datetime1->diff(new DateTime($value->createdDate));
            $elapsed1 = $interval1->format('%h');
               if($elapsed1<$hourdiff) 
                $di=$di+1;
                
            }

$this->data['NoofPatient']=$di;
  
      
      echo json_encode($this->data);
    }
    
    
    
   
 function IOTlogin()
{
 
 //$this->data['userId']='zmq';
 //$this->data['password']= 'zmq786';
 
 $this->data['userId']= $_GET['UserId'];
 $this->data['password']= $_GET['Password'];
 $this->data['Lang']= $_GET['Lang'];
 $this->data['MakId']= $_GET['MakId'];
  $this->returnedData=$this->checklogin($this->data);
  //$this->data['userId']="{Arif}";
  //echo ($this->data['userId']);
   
  
 // $x= str_replace('{','[',$x);
 // $x= str_replace('}',']',$x);
 // echo  ( $x);
  // $this->response($x);
   $this->output->set_header('Content-Type: application/json; charset=utf-8');
  //echo json_encode(array($this->returnedData));
  print_r(json_encode($this->returnedData));
   // $x= str_replace('{','[',$x);
    //$x= str_replace('}',']',$x);
   
   // echo($x);
}
   
    
    
    
function checklogin($data)
{
    
  $query="select userId,password from master_login where userId='".$data['userId']."'  and password='".$data['password']."' and MakId='".$data['MakId']."'";
      
   $q = $this->db->query($query);
   $spcharacter='#';
    $questionData=null; 
    $messageData=null;  
        if ($q->num_rows() > 0) 
            {
            
             $this->data=null;
             $this->data['Status']="1";  
             $this->data1['question'] = $this->questionInformation($data);
             $this->data1['message'] = $this->messageInformation($data);
             $this->data1['questiontotal'] = $this->questionCount($data);
             $this->data1['messagetotal']=$this->messageCount($data);
           
            for($i=0;$i<count($this->data1['question']);$i++)
            {
            $questionData=$questionData.$this->data1['question'][$i]['QuestionName'].$spcharacter;
            
            }
            
            for($i=0;$i<count($this->data1['message']);$i++)
            {
            $messageData=$messageData.$this->data1['message'][$i]['MessageName'].$spcharacter;
            
            }
            
          // $newarraynama=rtrim( $questionData,"# ");
           // $this->data['SensorType']=$this->getSensorType(); 
          // $this->data['ActivityType']=$this->getActivityType(); 
          $this->data['QuestionInformation']=$questionData; 
           $this->data['MessageInformation']=$messageData; 
          $this->data['TotalQuestion']=$this->data1['questiontotal'][0]['TotalQuestion']; 
          $this->data['TotalMessage']=$this->data1['messagetotal'][0]['TotalMessage']; 
          $this->data['CurrentDate']=date("Y/m/d");
            } 
            else
            {
                $this->data=null;
                $this->data['Status']="0";  
                
            }
            
               return (array)$this->data;
    
}
    
    
    
  
  
  
  
  public function questionInformation($d) {
      // $this->load->database();
//print_r($data);
        $query = "select CONCAT(`Name`,`Answer`) as QuestionName from tblQuestionText where isActive=1 and LangType='".$d['Lang']."'";
      //   $query = "select CONCAT(`Name`,`Answer`) as QuestionName from tblQuestionText where isActive=1 and QuestionId not in(select QuestionId  from tblQuestionDownload //where UserId='".$d."')";
  //print_r( $query);                 
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array() ;
              
        }
    }
  
  public function messageInformation($d) {

        $query = "select `Name` as MessageName from tblMessageText where isActive=1 and Type='".$d['Lang']."'";
                  
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array() ;
              
        }
    }
  
  
  
  public function questionCount($d) {

        $query = "select count(*)as TotalQuestion from tblQuestionText where isActive=1 and LangType='".$d['Lang']."'";         
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
        return $query->result_array() ;
              
        }
    }
  
    
    
    
    public function messageCount($d) {

        $query = "select count(*)as TotalMessage from tblMessageText where isActive=1 and Type='".$d['Lang']."'";         
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
        return $query->result_array() ;
              
        }
    }
    
    
    
    
    
 function  getSensorType()
 {
 
        $query="SELECT sensorTypeId,sensorName FROM `master_sensorType`";
        $q1=$this->db->query($query);
          
        $this->result= $q1->result_array(); 
        return $this->result;  
 
 }
    
    
    
    
    
 function  getActivityType()
 {
 
 $query="SELECT activity_Id as ActivityId,activity_Name as ActivityName FROM `master_activityType`";
        $q1=$this->db->query($query);
          
        $this->result= $q1->result_array(); 
        return $this->result;  
 }
    
    
  function submitQuestionAnswerHistory()
{
$realAnswer=null;
 
    $this->data['QuestionId']   =       $_GET['QuestionId'];
    $this->data['AnswerId']     =       $_GET['AnswerId'];
    $this->data['Sex']          =       $_GET['Sex'];
    $this->data['Lang']         =       $_GET['Lang'];
    $this->data['MakId']        =       $_GET['MakId'];
    $this->data['Score']        =       $_GET['Score'];

$qustn=substr($this->data['QuestionId'] , 0, -1);
$pieces = explode(":", $qustn);
 $this->data['QuestionId']=$qustn;
 $this->data['AnswerId']=substr($this->data['AnswerId'] , 0, -1);
 
foreach ($pieces as $value) {
  $query = "select Answer from tblQuestionText where Name='" .$value. "' and LangType='".$_GET['Lang']."'";
           $q = $this->db->query($query);
            $result = $q->row();
          $realAnswer = $realAnswer.$result->Answer.':';  
    
}
          
       

    $realAnswer=substr($realAnswer , 0, -1);
    $this->data['RealAnswer']=$realAnswer;



     $this->returnedData = $this->submitQuestionAnswerInDatabase($this->data);
     echo json_encode( $this->returnedData);

}
    
    
    function submitQuestionAnswerInDatabase($data)
{


$this->db->trans_begin();

$querymaker="insert into QuestionAnswer(QuestionId,AnswerId,Gender,Lang,MakId,Score,RealAnswer) values(?,?,?,?,?,?,?)";
$this->db->query($querymaker,
                array($data['QuestionId'],$data['AnswerId'],$data['Sex'],$data['Lang'],$data['MakId'],$data['Score'],$data['RealAnswer']));
                
                if ($this->db->trans_status() === FALSE) 
                {
                   $this->data=null;
                $this->data['Status']=0;
             $this->db->trans_rollback();
                
                }
            
            else {
            $this->data=null;
            $this->data['Status']=1;
           $this->db->trans_commit();
            
                 }
         
        
         return $this->data;

}
    
    
  
    function downloadConfirmation()
{


   // $this->data['QuestionName']    ='2';
  //  $this->data['UserId']     =    'zmq';
 
   $this->data['QuestionName']    =$_GET['QuestionName'];
   $this->data['UserId']     =    $_GET['UserId'];
    
           //$this->load->database();
            $query = "select QuestionId from tblQuestionText where Name='" . $this->data['QuestionName'] . "'";
          //  print_r( $query);
            $q = $this->db->query($query);
            $result = $q->row();
    
    
    
    $this->data['QuestionId']    = $result->QuestionId ;
    
     $this->returnedData = $this->submitDownloadConfirmation($this->data);
     echo json_encode( $this->returnedData);
    
      
    

}
  
  
   function submitDownloadConfirmation($data)
{





$this->db->trans_begin();

$querymaker="insert into tblQuestionDownload(QuestionId,QuestionName,UserId) values(?,?,?)";
$this->db->query($querymaker,
                array($data['QuestionId'],$data['QuestionName'],$data['UserId']));
                
                if ($this->db->trans_status() === FALSE) 
                {
                   $this->data=null;
                $this->data['Status']=0;
             $this->db->trans_rollback();
                
                }
            
            else {
            $this->data=null;
            $this->data['Status']=1;
           $this->db->trans_commit();
            
                 }
         
        
         return $this->data;

}
  
  
    
    function submitDeviceHistory()
{

 
    $this->data['sensorTypeId']    =    $_GET['sensorTypeId'];
    $this->data['activity_Id']     =    $_GET['activityId'];
    $this->data['Temp']             =    $_GET['Temp'];
    $this->data['status']          =    $_GET['status'];
    
     $this->returnedData = $this->submitDeviceHistoryInDatabase($this->data);
     echo json_encode( $this->returnedData);
    
      
    

}

function submitDeviceHistoryInDatabase($data)
{





$this->db->trans_begin();

$querymaker="insert into deviceInputHistory (sensorTypeId,activity_Id,Temp,status) values(?,?,?,?)";
$this->db->query($querymaker,
                array($data['sensorTypeId'],$data['activity_Id'],$data['Temp'],$data['status']));
                
                if ($this->db->trans_status() === FALSE) 
                {
                   $this->data=null;
                $this->data['Status']=0;
             $this->db->trans_rollback();
                
                }
            
            else {
            $this->data=null;
            $this->data['Status']=1;
           $this->db->trans_commit();
            
                 }
         
        
         return $this->data;

}

    
   
   
   
   
   
   
   
   
   
   
   
   function submitVideo() {
       $this->db->trans_begin();
        $response = array();
 $this->data['tbPatientId'] = $_GET['tbPatientId'];
  $this->data['complianceMode'] = $_GET['complianceMode'];
    $this->data['fileToUpload'] = $_GET['fileToUpload'];
        

        
        $complianceURL = '';


        $temp_name = $_FILES['fileToUpload']['tmp_name'];
        $size = $_FILES['fileToUpload']['size'];

        $name = $_FILES['fileToUpload']['name'];

        $uploadFileOnServerResult = $this->uploadFileOnServer($this->data['tbPatientId'], $temp_name, $name, $complianceURL, $this->data['complianceMode']);
// 
        if ($uploadFileOnServerResult == '1') {

           

            if ($this->returnedData['success']) {

                $response['success'] = '1';
                
            } else {
                 $response['success'] = '0';
                 $response['temp_name '] = $temp_name;
                 $response['size '] = $size;
                 $response['name '] = $name;
            }
        } else {
            $response['success'] = '0';  
             $response['temp_name '] = $temp_name;
                 $response['size '] = $size;
                 $response['name '] = $name;
           
        }

        echo json_encode($response);
    }
   
   
   
    
    
    
    function uploadFileOnServer($patientId, $temp_name, $name, &$complianceURL, $complianceMode) {

        if (!file_exists("complianceMode/$patientId/$complianceMode")) {
            mkdir("complianceMode/$patientId/$complianceMode", 0777, true);
        }
        $success = "0";
        $targetfile = "complianceMode/$patientId/$complianceMode/$name";

        if (move_uploaded_file($temp_name, $targetfile)) {
            $success = '1';
            $complianceURL = $targetfile;
        } else {
            $success = '0';
        }
        return $success;
    }
    
    
    
    
    
    //put your code here
}









?>