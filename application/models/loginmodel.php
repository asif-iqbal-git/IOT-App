<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginmodel
 *
 * @author zmq
 */
class loginmodel extends CI_Model {
    var $data, $query;
    var $result;
    // var $staff_uuid;

    function __construct() {
        parent::__construct();
          $this->load->database();
    }

    public function validateLoginUser($login_data)
    {
        $query = $this->db->select('*')->from('tblLogin')->where($login_data)->get(); 
        
        if($query->num_rows() > 0)
        {
           $result = $query->result();
           
        //   var_dump(($result));
        //    var_dump($result[0]->isActive);

           if($result[0]->isActive)
           {
            return $data = [
                "isActive" => $result[0]->isActive,
                "staff_uuid" => $result[0]->staff_uuid,
                "login_id" => $result[0]->login_id,
                "password" => $result[0]->password,
                "level"=> $result[0]->level
             ];
           }
        }
    }

   function validateDootLogin($data = NULL) {
        $query = $this->db->select('*')
                        ->from('tblLogin')  //->from('master_login')
                        ->where($data)->get();

        if ($query->num_rows() > 0) {
            $this->result = $query->result();
            $this->result = $this->result[0];

            $this->data = [
                'loginActive' => $this->result->isActive,
            ];
            if ($this->data['loginActive']) {
                //new data for tblLogin
                $this->data = [
                    'staff_uuid'=> $this->result->staff_uuid,
                    'loginActive' => $this->result->isActive,
                    'empid' => $this->result->staff_uuid,
                    'username' => $this->result->login_id,                    
                    'level'=> $this->result->level,
                ];

                //old data for master_login
                /*$this->data = [
                    'loginActive' => $this->result->isActive,
                    'empid' => $this->result->auto_loginId,
                    'username' => $this->result->userId,
//                    'tbcenterId'=> $this->result->tbcenterId,
                    'level'=>$this->result->level,
//                    'districtTbId'=>$this->result->districtTbId
                ];*/
                $this->data['success'] = TRUE;
            } else {
                $this->data['success'] = FALSE;
                $this->data['message'] = "Your account has not been activated yet.";
            }
        } else {
            $this->data['success'] = FALSE;
            $this->data['message'] = "username or password is incorrect.";
        }
        return $this->data;
    }

    public function fetchStaffUUID($data)
    {
        //var_dump(trim($data));die();
        $query = $this->db->select('staff_uuid')
                        ->from('tblLogin')  
                        ->where('login_id', $data)->get();

        if ($query->num_rows() > 0) {
            $this->result = $query->result();
            $this->result = $this->result[0];
        }
        $data = $this->result;
        return $data->staff_uuid; 
    }

     
    public function getQuestionAnswerAudioData($LangId = NULL) {
          $this->load->database();
           $question_data = $this->getQuestionData($LangId);
                if ($question_data) {
                    return array('q_data' => $question_data);
                } else {
                    return array('q_data' => FALSE);
                }
        
    }
    
    
    
    public function getQuestionData($LangId = NULL) {
          $this->load->database();
        $this->db->select('*');
        $this->db->from('tblQuestionText');
        $this->db->where('LangType', $LangId);
        $this->db->order_by('QuestionId', 'ASC');
        return $this->getData($this->db->get());
    }
    
     public function gameScorerecored($_tbunit_id = NULL) {
        $this->load->database();
        $return_patient_group = NULL;
        $temp_array = NULL;
        $query = "SELECT *
                    from QuestionAnswer";
                             
        $query = $this->db->query($query, array($_tbunit_id));
        if ($query->num_rows() > 0) {
            return $query->result_array() ;
              
        }
    }
    
    public function  phcList()
    {
        
      $this->load->database();
        $query = "select `PhcId`  , `PhcName`  from  tblPhcRegister where    isActive = 1";
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
           return $q->result_array();
           
        }   
    }
       
    public function  stateList()
    {
        
        $this->load->database();
        $query = "select `StateId`  , `StateName`  from tblStateMaster where    isActive = 1 ";
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
           return $q->result_array();
           
        }  
        
    }
    
     public function districtList($data)
    {
        
      $this->load->database();
        $query = "select `DistrictId` , `DistrictName`   from tblDistrictMaster where  StateId=? and  isActive = 1";
        $q = $this->db->query($query,$data['stateId']);
        if ($q->num_rows() > 0) {
            $this->data['districtInfo'] = $q->result_array();
            $this->data['success'] = TRUE;
        } else {
            $this->data['success'] = FALSE;
            $this->data['message'] = "Oooops! No active Block under this District.";
        }
       // print_r('query');
        return $this->data;
    }

    public function blockList($data)
    {
        
      $this->load->database();
        $query = "select `BlockId` , `BlockName`   from  tblBlockMaster where  DistrictId=? and  isActive = 1";
        $q = $this->db->query($query,$data['districtId']);
        if ($q->num_rows() > 0) {
            $this->data['blockInfo'] = $q->result_array();
            $this->data['success'] = TRUE;
        } else {
            $this->data['success'] = FALSE;
            $this->data['message'] = "Oooops! No active Block under this District.";
        }
       // print_r('query');
        return $this->data;   
        
    }
    
    public function registerProvider($data)
    {
        
       $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('tblRegisterProvider',$data);

        if ($this->db->trans_status() === FALSE) {
             $this->session->set_flashdata('message1', 'Sorry! No data is submitted');
             
             
            $this->db->trans_rollback();
        } else {

             $this->session->set_flashdata('message1', $data['ProviderName']." is registered successfully");
             
           
            $this->db->trans_commit();
        }    
        
        return $this->data;  
        
        
    }
  
    
    public function  providerList()
    {
        
        $this->load->database();
        $query = "select `ProviderId`  , `ProviderName`  from tblRegisterProvider where    isActive = 1";
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
           return $q->result_array();
           
        }  
        
    }
    
    public function getUnAssignTokens() {
       $this->load->database();
        $this->db->select('*');
        $this->db->from('tblTokenMaster');
           $this->db->where(array('isAssigned' => 0,'isActive'=>1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function providerListByPhcId($data)
    {
        
      $this->load->database();
        $query = "select `ProviderId`  , `ProviderName`  from tblRegisterProvider where PhcId=?  and  isActive = 1";
        $q = $this->db->query($query,$data['phcId']);
        if ($q->num_rows() > 0) {
            $this->data['providerInfo'] = $q->result_array();
            $this->data['success'] = TRUE;
        } else {
            $this->data['success'] = FALSE;
            $this->data['message'] = "Oooops! No active Provider.";
        }
       // print_r('query');
        return $this->data;   
        
    }
    
    public function childDataByProviderId($data)
    {
        
      $this->load->database();
        $query = "select *  from tblChildMaster where ProviderId=?";
        $q = $this->db->query($query,$data['providerId']);
        if ($q->num_rows() > 0) {
            return $q->result_array();
           
        } else {
            return FALSE;
        }
       
        
    }
    
     public function tokenStatus($limit, $offset)
    {
        
      $this->load->database();
    //   $this->db->limit($limit,$offset);
       
      
      $query = "select TokenId,TokenRealId,case when isAssigned=1 then 'Yes' else 'No' end as AssignedtoChild ,case when HealthWorkerId=0 then 'No' else 'Yes' end as AssignedtoWorker ,case when isActive=1 then 'Running' else 'Closed' end as TokenStatus from tblTokenMaster LIMIT ".$limit." OFFSET ".$offset;
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
            return $q->result_array();
           
        } else {
            return FALSE;
        }
    }
   
    public function vaccinePlanner()
    {
        
      $this->load->database();
       // $query = "SELECT A.`vaccineId` , A.`vaccineName` ,A.startDay,A.endDay , B.`vaccineName`As dependentVaccineId, A.DayOfDependency FROM tblvaccinemaster A LEFT JOIN tblvaccinemaster B on A.vaccineId=B.dependentVaccineId WHERE A.isActive=1 ORDER BY A.`vaccineOrder`";
       
      $query="SELECT * FROM `tblVaccineMaster` WHERE `isActive`=1 ORDER by vaccineOrder";
              $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
            return $q->result_array();
           
        } else {
            return FALSE;
        }
       
        
    }
    
    
    private function getData($_query = NULL) {
          $this->load->database();
        if ($_query->num_rows() > 0) {
            return $_query->result_array();
        } else {
            return FALSE;
        }
    }
    
    
     function childCommunication($data)
    {
        if ($data != null) {
            // select child_id visited date immunisation mother advice related from tblIotInteraction table

            $this->db->select('visit_date_time,child_id,verbal_comm_mother,advise_related_child,immunisation');
            $this->db->from('tblIotInteraction');
            $this->db->where('token_id', $data['tokenId']);
            // order by visit date time
            $this->db->order_by('communication_id', 'desc');

            $query = $this->db->get();
            return $query->result();
        } else {
            return false;
        }   
    }
    
     function getTokenDetails($provider_id = null)
    {

        // $this->load->database();
        // $query = "select `TokenId`  , `ZMQTokenId`  from tblRegisterProvider where PhcId=?  and  isActive = 1";
        // $q = $this->db->query($query, $data['phcId']);
        // if ($q->num_rows() > 0) {
        //     $this->data['providerInfo'] = $q->result_array();
        //     $this->data['success'] = TRUE;
        // } else {
        //     $this->data['success'] = FALSE;
        //     $this->data['message'] = "Oooops! No active Provider.";
        // }
        // // print_r('query');
        // return $this->data;



        if ($provider_id != null) {
            $this->db->select('TokenId,ZMQTokenId');
            $this->db->from('tblTokenMaster');
            $this->db->where('HealthWorkerId', $provider_id);

            $this->db->order_by('ZMQTokenId', 'asc');
            $query = $this->db->get();
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function saveHealthWorkerIdWithTokens($data)
    {
        //print_r($data);
        $this->db->insert('tblTokensToHealthProvider', $data);            
    }

    public function saveProjectAdminIdWithToysTokenId($data)
    {
        //print_r($data);
        $this->db->insert('tblAssignToyToProjectAdmin', $data);            
    }
    //tblToyTokenMapping already created
    // fetchTokenIdWithToysId -> From -> tblTokenMaster
    public function fetchTokenIdWithToysId()
    {   
         $this->db->select('tokenId,toyId');
         $this->db->from('tblTokenMaster');
         $this->db->where('isActive', 1);
         $query = $this->db->get();
         if($query->num_rows() > 0){
            return $query->result();
         }else{
             return false;
         }
         
    }

    // fetch single admin info for tokenId with toyid
    public function fetchSinglePAdminInfo($id)
    {   
         $this->db->select('AssignToyToPAdmin');
         $this->db->from('tblAssignToyToProjectAdmin');
         $this->db->where('projectAdmin_id', $id);
         
         $query = $this->db->get();
         if($query->num_rows() > 0){
            return $query->result();
         }else{
             return false;
         }         
    }

    
    //This method is use for pagination for particular table
     public function total_rows(){
        try{
            $this->db->select('count(*) as total_rows');
            $this->db->from('tblTokenMaster');
            $query = $this->db->get();
            return $query->result_array()[0]['total_rows'];                
            }
            catch(Exception $ee){
                return 0;
            }

    }

    // It is to fetch all data from 'master_staff' table
    public function get_staff_info(){

        $staff_info = $this->db->get('master_staff');
        return $staff_info->result();

    }

}
