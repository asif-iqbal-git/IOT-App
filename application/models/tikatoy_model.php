<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TikaToy_Model
 *
 * @author zmq
 */
 class tikatoy_model extends CI_Model{
    //put your code here
    var $data=null;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
   public  function  getStatedataforDMC()
    {
        $query="SELECT StateId as Sid,StateName as Sname FROM `tblStateMaster` WHERE isActive=1 order by StateId ";
        $q1=$this->db->query($query);
          
        $this->result= $q1->result_array(); 
        return $this->result;   
        
    }
    
    
  public  function  getDistrictdataforDMC()
    {
        $query="SELECT DistrictId as Did,DistrictName as Dname,StateId as Sid FROM `tblDistrictMaster` WHERE isActive=1 order by DistrictId ";
        $q1=$this->db->query($query);
          
        $this->result= $q1->result_array(); 
        return $this->result;   
        
    }
    
    
    
    
  public  function  getBlockdataforDMC()
    {
      
        $query="SELECT `BlockId` as Bid,`BlockName`as Bname,`DistrictId` as Did FROM `tblBlockMaster` WHERE `isActive`=1   order by DistrictId";
          $q1=$this->db->query($query);
          $this->result= $q1->result_array(); 
            return $this->result;
            
        
    }
    
   public  function  getplannerInfo()
    {
      
        $query="SELECT `PlannerId` as VaccinePlannerId,`HandMadePlannerId`as PlannerName  FROM `tblVaccinePlaner` WHERE `isActive`=1";
          $q1=$this->db->query($query);
          $this->result= $q1->result_array(); 
            return $this->result;
            
        
    }
   
  public  function  getTokenInfo($data=null)
    {
      
          $query="SELECT `TokenId` as TokenIdRealId,`TokenRealId` as TokenId,ToyId,isAssigned,isActive FROM `tblTokenMaster` WHERE  HealthWorkerId='".$data."'";
          $q1=$this->db->query($query);
          $this->result= $q1->result_array(); 
          return $this->result;
            
        
    }
   
   
   
   public  function  getVaccinePlannerDetails()
    {
      
        $query="SELECT `vaccineId` as VId,`vaccineCode`as VName ,startDay as StDay,endDay as EnDay,dependentVaccineId as DependVaccine,DayOfDependency FROM `tblVaccineMaster` WHERE `isActive`=1 order by vaccineOrder";
          $q1=$this->db->query($query);
          $this->result= $q1->result_array(); 
            return $this->result;
            
        
    }
   
   
   
   
  public  function selectPatientDetailsFromServer($data) {
     
	 $query = "SELECT p.*,ph.*
                  FROM tblRegisterProvider p inner join tblPhcRegister ph on p.PhcId=ph.PhcId
                  where UserId = ? and Password = ?";


        $q = $this->db->query($query, $data);

        
         if ($q->num_rows() > 0) {


            $this->result = $q->result();
             $this->data['EmpId']=$this->result[0]->ProviderId;
            $this->data['HandmadeProviderId']=$this->result[0]->HandmadeProviderId;
            $this->data['ProviderName'] = $this->result[0]->ProviderName;
            $this->data['PhoneNo']=$this->result[0]->PhoneNo;
            $this->data['Qualification']=$this->result[0]->Qualification;
            $this->data['LandMarkAddress'] = $this->result['0']->LandMarkAddress;
            $this->data['PhcId'] = $this->result['0']->PhcId;
            $this->data['PhcName'] = $this->result['0']->PhcName;
            $this->data['ServiceType'] = $this->result['0']->ServiceType;
           $this->data['isActive']=$this->result['0']->isActive;
            if ($this->data['isActive']) {
                $this->data['success'] = TRUE;
               // $this->data['message'] = "1";
               $this->data['message'] = TRUE;
            } else {
                $this->data['success'] = FALSE;
               // $this->data['message'] = "2";
                $this->data['message'] = FALSE;
                
            }
            
        }
        
        else {
             $this->data['success'] = FALSE;
             $this->data['message'] = FALSE;
            }

        return $this->data;
    }
   
    
    
    
    public  function RegisterProvider($data)
    {
     $totalRegisteredProvider=null;
     $ctry=null;
     $stt=null;
     $dist=null;
     $providerId=Null;
    
       $q = $this->db->query("SELECT count(*) as totalprovider FROM tblRegisterProvider where BlockId= ?",array($data['BlockId']));
        if ($q) {
            $this->result = $q->result();
            
            $totalRegisteredProvider = $this->result[0]->totalprovider + 1;
           
         $qc = $this->db->query("SELECT CountryCode FROM tblCountryMaster where CountryId= ?",array($data['CounryId']));
                $this->result1 = $qc->result();   
           $ctry= $this->result1[0]->CountryCode ;
           
           
           
            $qs = $this->db->query("SELECT StateCode FROM tblStateMaster where StateId= ?",array($data['StateId']));
                $this->result2 = $qs->result();   
           $stt= $this->result2[0]->StateCode  ;
           
           
           
            $qd = $this->db->query("SELECT DistrictCode FROM tblDistrictMaster where DistrictId= ?",array($data['DistrictId']));
                $this->result3 = $qd->result();   
           $dist= $this->result3[0]->DistrictCode ;
           
          $providerId= $ctry.'.'.$stt.'.'.$dist.'.'.'PDR'.'.'.$totalRegisteredProvider ;
           
        }
    
    
    
    
    
    $insertIntotblRegisterProvider="insert into tblRegisterProvider
               (HandmadeProviderId,UserId,Password,ProviderName,PhoneNo,EmailId,
    Gender,Age,Qualification,CounryId,StateId,DistrictId,BlockId,ServiceType,Clinic_PHCName,LandMarkAddress)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";        
            
    
    $this->db->query($insertIntotblRegisterProvider,
                   array($providerId,$data['UserId'],
                        $data['Password'],$data['ProviderName'],                   $data['PhoneNo'],$data['EmailId'],$data['Gender'],$data['Age'],$data['Qualification'],$data['CounryId'],$data['StateId'],$data['DistrictId'],$data['BlockId'],
                        $data['ServiceType'],
                        $data['Clinic_PHCName'],$data['LandMarkAddress']));
             $this->data=null;           
            if($this->db->affected_rows()>0)
            {
                $this->data['success']=TRUE;
            }
            else{
                $this->data['success']=FALSE;
            }
    
     return $this->data;
    
    }
    
    
    
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   public  function ChildRegister($data)
    {
     $totalRegisteredChildren=null;
     $ctry=null;
     $stt=null;
     $dist=null;
     $blok=null;
     $childId=Null;
    
       $q = $this->db->query("SELECT count(*) as totalChildren FROM  tblChildMaster
where BlockId= ?",array($data['BlockId']));
        if ($q) {
            $this->result = $q->result();
            
            $totalRegisteredChildren= $this->result[0]->totalChildren + 1;
           
         $qc = $this->db->query("SELECT CountryCode FROM tblCountryMaster where CountryId= ?",array($data['CountryId']));
                $this->result1 = $qc->result();   
         $ctry= $this->result1[0]->CountryCode ;
           
           
           
            $qs = $this->db->query("SELECT StateCode FROM tblStateMaster where StateId= ?",array($data['StateId']));
           $this->result2 = $qs->result();   
           $stt= $this->result2[0]->StateCode  ;
           
           
           
            $qd = $this->db->query("SELECT DistrictCode FROM tblDistrictMaster where DistrictId= ?",array($data['DistrictId']));
            $this->result3 = $qd->result();   
           $dist= $this->result3[0]->DistrictCode ;
           
            $qb = $this->db->query("SELECT BlockCode FROM tblBlockMaster where BlockId= ?",array($data['BlockId']));
            $this->result4 = $qb->result();   
            $blok= $this->result4[0]->BlockCode ;
           
           
          $childId= $ctry.'.'.$stt.'.'.$dist.'.'.$blok.'.'.$totalRegisteredChildren;
           
        }
    
    
    
    
    
    $insertIntotblChildMaster="insert into tblChildMaster
               (ChildHandMadeId,ChildName,DOB,Gender,FatherName,MotherName,
    ParentPhoneNo,CountryId,StateId,DistrictId,BlockId,LandMarkAddress,VaccinePlannerId,ProviderId,TokenId)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";        
            
    
    $this->db->query($insertIntotblChildMaster,
                   array($childId,$data['ChildName'],
                        $data['DOB'],$data['Gender'], $data['FatherName'],
                        $data['MotherName'],$data['ParentPhoneNo'],$data['CountryId'],$data['StateId'],$data['DistrictId'],$data['BlockId'],$data['LandMarkAddress'],
                        $data['VaccinePlannerId'],
                        $data['ProviderId'],$data['TokenId']
                       ));
             $this->data=null;           
            if($this->db->affected_rows()>0)
            {
                $this->data['success']=TRUE;
                
           $maxchildIdquery = $this->db->query("SELECT max(ChildId) as childId   FROM tblChildMaster where ProviderId='".$data['ProviderId']."'");
           $this->result5 = $maxchildIdquery ->result();   
            $maxchildId= $this->result5[0]->childId ;
                
             
            $childIdquery = $this->db->query("SELECT ChildHandMadeId as childId   FROM tblChildMaster where ChildId='".$maxchildId."'");
           $this->result6 = $childIdquery ->result();   
          $this->data['childId'] = $this->result6[0]->childId ;
          $this->data['mainchildId']=$maxchildId;
             
             
             ///new code
              $inserttokenchildmapping="insert into tblChildTokenMapping
               (ChildId,TokenId)values(?,?)";                   
          $this->db->query($inserttokenchildmapping,
                   array($maxchildId,$data['TokenId']
                       
                       ));
                       
             $insertchildinvaccinetable="insert into tblchildwisevaccination
               (ChildId,ProviderId)values(?,?)";                   
          $this->db->query($insertchildinvaccinetable,
                   array($maxchildId,$data['ProviderId']
                       
                       ));           
             $query="update tblTokenMaster set isAssigned= 1 where TokenId = ?";
             $q=$this->db->query($query,array($data['TokenId']));
             
             
                
            }
            else{
                $this->data['success']=FALSE;
            }
    
     return $this->data;
    
    }  
    
    
    
  
  
  
  
  
  
  
  
   public  function TokenMapping($data)
    {
     
    
    
    $tblChildTokenMapping="insert into tblChildTokenMapping

               (ChildId,TokenId,AssigningDate)values(?,?,?)";        
            
    
    $this->db->query($tblChildTokenMapping,array($data['ChildId'],
                        $data['TokenId'],$data['AssigningDate']));         
            if($this->db->affected_rows()>0)
            {
            
             $query="update tblTokenMaster set isAssigned= 1 where TokenId = ?";
             $q=$this->db->query($query,array($data['TokenId']));
                $this->data['success']=TRUE;     
              
            }
            else{
                
                $this->data['success']=FALSE;
            }
    
     return $this->data;
    
    }
  
  
   public  function RegisterCard($data)
    {

        if($data['cardid']!=NULL)
        {
            $findcardid = $this->db->query("SELECT TokenId as card   FROM tblTokenMaster where TokenRealId='".$data['cardid']."'");
             
            if($findcardid->num_rows() > 0)
            { $getcardid = $findcardid->result(); 
              $this->data['status']=1;   
              $this->data['server_cardid']=$getcardid[0]->card;
            }
            else
            {
             $tblcardregister="insert into tblTokenMaster(TokenRealId)values(?)";        
             $this->db->query($tblcardregister,array($data['cardid']));                             
            if($this->db->affected_rows()>0)
            {
             $this->data['status']=2; 
             $this->data['server_cardid']=$this->db->insert_id();
            } 
            else
                {               
                $this->data['status']=0;
                $this->data['server_cardid']=0;
                }
            }
        }
        
    
    
         return $this->data;
    
    }
    
    public  function GetFreeToys()
    {

     
            $findtoyid = $this->db->query("SELECT * FROM tblToyRegistration where IsInitialized=0 and IsAssignedtoPhc=1");
             
            if($findtoyid->num_rows() > 0)
            { $gettoyid = $findtoyid->result(); 
              $this->data['status']=1;   
              $this->data['toy_id']=$gettoyid[0]->ToyId ;
              $this->data['toy_name']=$gettoyid[0]->ToyName;
              $this->data['phc_id']=$gettoyid[0]->PhcId;
            }
            else
            {
              $this->data['status']=0;   
              $this->data['toy_id']=0; 
              $this->data['toy_name']="N/A";   
              $this->data['phc_id']=0;   
             
            }
      
        
    
    
         return $this->data;
    
    }
    
    public  function GetRegisterdToy()
    {
     
      $findtoyid = $this->db->query("SELECT ToyId as toy_id,ToyName as toy_name FROM tblToyRegistration ");
       
       /*      
            if($findtoyid->num_rows() > 0)
            {
                $gettoyid = $findtoyid->result(); 
              $this->data['toy_id']=$gettoyid[0]->ToyId ;
              $this->data['toy_name']=$gettoyid[0]->ToyName;
              
            }
            else
            {
              $this->data['toy_id']=0; 
              $this->data['toy_name']="NA";   
               
             
            }
      
     */   
    
    
         return $findtoyid->result();//$this->data;       
    
    }
    
    public function InitializedToy($data)
    {
        if ($data['toyid'] != NULL) {
            $findcardid = $this->db->query("SELECT *  FROM tblToyRegistration where ToyName ='".$data['toyid']."'");

            if ($findcardid->num_rows() > 0) {
                $gettoyid = $findcardid->result();
                $this->data['status'] = 2;
                $this->data['toy_id'] = $gettoyid[0]->ToyId;
            } else {

                $tblcardregister = "insert into tblToyRegistration(ToyName)values(?)";
                $this->db->query($tblcardregister, array($data['toyid']));
                if ($this->db->affected_rows() > 0) {
                    $this->data['status'] = 1;
                    $this->data['toy_id'] = $this->db->insert_id();
                } else {
                    $this->data['status'] = 0;
                    $this->data['toy_id'] = 0;
                }
            }
        } else {
            $this->data['status'] = 3;
            $this->data['toy_id'] = 0;
        }

        return $this->data;
    }
    
    
    
    public function IOT_interaction($data)
    {
        return $this->db->insert("tblIotInteraction", $data);
    }
    
    
     function insert_child_vaccine_details($child_array = NULL, $vaccine_ids = NULL) {
        $question_answer = [];
        $questions_step = 0;
        $inserted_ptient_row='';
        if (!(count($child_array['child_id']) === 1)) {
            for ($i = 0; $i < count($vaccine_ids['vaccine_date']); $i++) {
                foreach ($vaccine_ids as $key => $item) {
                    $question_answer[$key][] = explode(':', $item[$i]);
                }
            }
        } else {
            foreach ($vaccine_ids as $key => $item) {
                $question_answer[$key] = explode(':', $item[0]);
            }
        }
        for ($child_count = 0; $child_count < count($child_array['child_id']); $child_count++) {
    
            if (!(count($child_array['child_id']) === 1)) {
                for ($question_count = 0; $question_count < count($question_answer['vaccine_id'][$child_count]); $question_count++) {
                    $data = array( 'childid'=>$child_array['child_id'][$child_count], 'vid' => $question_answer['vaccine_id'][$child_count][$question_count].'D', 'vd' => $question_answer['vaccine_date'][$child_count][$question_count]);
                    
                    $query="update tblchildwisevaccination set ".$data['vid']."  = '".$data['vd']."'  where ChildId = ?";
                    $q=$this->db->query($query,array($data['childid']));
                    $inserted_ptient_row = $q;
                }
            } else {
                for ($question_count = 0; $question_count < count($question_answer['vaccine_id']); $question_count++) {
                    $data = array('childid'=>$child_array['child_id'][$child_count],'vid' => $question_answer['vaccine_id'][$question_count].'D', 'vd' => $question_answer['vaccine_date'][$question_count]);
                    $query="update tblchildwisevaccination set ".$data['vid']."  = '".$data['vd']."'  where ChildId = ?";
                    $q=$this->db->query($query,array($data['childid']));
                    $inserted_ptient_row = $q;
                }
            }
        }

       // $inserted_ptient_row = $this->db->affected_rows($this->query);
        if ($inserted_ptient_row > 0) {
            $this->data['status'] = $inserted_ptient_row;
           
           
        } else {
            $this->data['status'] = $inserted_ptient_row;
            
        }

        return $this->data;
    }
    
   
   
    function childvaccineDetails($childid=NULL)
    {
     $query="SELECT 1D,2D,3D,4D,5D,6D,7D,8D,9D,10D,11D,12D,13D,14D  from tblchildwisevaccination where ChildId='".$childid."'";   
      $q = $this->db->query($query);
        
        if ($q->num_rows() > 0) {
           return $q->result()[0];
           
        }   
        else {
            return FALSE;
        }
        
     
    } 
    
  
    public  function  childInfo($data=null)
    {
      
          $query="SELECT c.ChildId,c.ChildName,c.DOB,c.Gender,c.FatherName,c.MotherName,c.ParentPhoneNo,c.CountryId,c.StateId,c.DistrictId,c.BlockId,c.TokenId,c.LandMarkAddress from tblChildMaster c WHERE c.ProviderId='".$data."'";
          $q1=$this->db->query($query);
          $resultset= $q1->result_array();
          
          
          
          foreach ($resultset as $key=> $value)
          {
             $resultset[$key]['vaccine_details']=$this->childvaccineDetailsWithVaccineCode($value['ChildId']) ;
          }
          
         return $resultset;
            
        
    }
    
    
    function childvaccineDetailsWithVaccineCode($childid=NULL)
    {
      
     $query="SELECT  DATE_FORMAT(1D,'%d/%m/%Y') as '1D',DATE_FORMAT(2D,'%d/%m/%Y') as '2D',DATE_FORMAT(3D,'%d/%m/%Y') as '3D',DATE_FORMAT(4D,'%d/%m/%Y') as '4D',DATE_FORMAT(5D,'%d/%m/%Y') as '5D',DATE_FORMAT(6D,'%d/%m/%Y') as '6D',DATE_FORMAT(7D,'%d/%m/%Y') as '7D',DATE_FORMAT(8D,'%d/%m/%Y') as '8D',DATE_FORMAT(9D,'%d/%m/%Y') as '9D',DATE_FORMAT(10D,'%d/%m/%Y') as '10D',DATE_FORMAT(11D,'%d/%m/%Y') as '11D',DATE_FORMAT(12D,'%d/%m/%Y') as '12D',DATE_FORMAT(13D,'%d/%m/%Y') as '13D',DATE_FORMAT(14D,'%d/%m/%Y') as '14D'  from tblchildwisevaccination where ChildId='".$childid."'";    
      $q = $this->db->query($query);
        
        if ($q->num_rows() > 0) {
           return $q->result()[0];
           
        }   
        else {
            return FALSE;
        }        
      // return "Arif khan";
    }

    public  function storeMasterStaffInfo($staff_data,$staff_login_data)
    {
        // var_dump($staff_data);
        $ssn_login_id = $staff_data['login_id'];
       
        $this->db->set('staff_uuid', 'UUID()', FALSE);
        $this->db->insert('master_staff', $staff_data);

       // echo("<pre>");
        //var_dump($ssn_login_id);
        //var_dump($staff_data);
        die();
    }
    
    public function storeProjectInfo($data_project, $data_login, $data_master_staff)
    {
        // print_r($data);
        // print_r($data_login);die();
        $this->db->set('project_uuid', 'UUID()', FALSE);
        $this->db->insert('master_project', $data_project);
        
        $this->db->set('staff_uuid', 'UUID()', FALSE);
        $this->db->insert('tblLogin', $data_login);

        $this->db->insert('master_staff', $data_master_staff);
    }

    public function storeProjectInfo2($data_project, $data_master_staff)
    {
        // print_r($data);
        // print_r($data_login);die();
        $this->db->set('project_uuid', 'UUID()', FALSE);
        $this->db->insert('master_project', $data_project);
        
        $this->db->insert('master_staff', $data_master_staff);
    }
    
    public function storeProjectAdminInfo($data)
    {
        $this->db->insert('master_login', $data);
    }

    public function storeCompanyAdminInfo($data, $data_login, $data_master_staff)
    {
        // print_r($data);
     //   print_r($data_login);die();
     
        
     //set id column value as UUID        
        $this->db->set('company_uuid', 'UUID()', FALSE);
        $this->db->insert('master_company', $data);

        $this->db->set('staff_uuid', 'UUID()', FALSE);
        $this->db->insert('tblLogin', $data_login);
     
        $this->db->insert('master_staff', $data_master_staff);
    }


    public function storeHealthProviderTokenIdInfo()
    {
        
    }

    public function getProjectAdminName()
    {
       $query = "SELECT auto_loginId,userId FROM master_login WHERE level = '2'";
       $q = $this->db->query($query);
      // print_r($q->result());
       if ($q->num_rows() > 0) {
             return $q->result();        
        }   
        else {
             return FALSE;
        }     
    }

    public  function getCompanyNameByCAdmin($company_admin_login_id)
    {
    //    $query = "SELECT  C.company_uuid, C.company_name, C.created_by,L.login_id 
    //              FROM master_company As C INNER JOIN tblLogin As L ON 
    //              C.company_uuid = L.staff_uuid WHERE C.company_uuid='$company_login_id'" ;
      
    $query = "SELECT company_uuid,company_name, created_by
     FROM master_company 
     WHERE company_admin_loginId ='$company_admin_login_id'" ;

       $q = $this->db->query($query);
       
      //  print_r($q->result());die();
     
      if ($q->num_rows() > 0) {
             return $q->result();       
        }   
        else {
            return FALSE;
        }   
    }

    public function getLevelByDesignation($designation_id)
    {
        $query = "SELECT level,designation_name
        FROM tblDesignation
        WHERE designation_id ='$designation_id'" ;
   
          $q = $this->db->query($query);
          
         //  print_r($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }              
    }
    public function getCompanyUserId()
    {
       $query = "SELECT DISTINCT staff_uuid,login_id FROM tblLogin WHERE level = '1'";
       $q = $this->db->query($query);
      // print_r($q->result());
       if ($q->num_rows() > 0) {
             return $q->result();        
        }   
        else {
             return FALSE;
        }   
    }

    public  function getProjectInfoWithCompanies()
    {
        // get project info only for login company admin ie show all project details which is under one company(login)
        
        $query = "SELECT P.project_id, P.comp_adm_log_id,P.project_name,P.location,C.company_name,C.comapny_email,M.unique_login_id,M.userId
        FROM tblProjectName As P
        INNER JOIN master_login As M 
        ON M.unique_login_id = P.comp_adm_log_id        
        INNER JOIN master_company As C
        ON C.comp_adm_log_id = P.comp_adm_log_id";

        $q = $this->db->query($query);
        // print_r($q->result());
        if ($q->num_rows() > 0) {
            return $q->result();        
            }   
            else {
                return FALSE;
            }   
    }

    public function getProjectAdminNameByCompany()
    {
        // get project info only for login company admin ie show all project details which is under one company(login)
        //   P.created_By, --company admin uuid
        // C.created_by, --company admin or super admin

        $query = "SELECT DISTINCT P.project_uuid, 
                         P.created_By, 
                         P.project_name,
                         P.project_location,
                         C.created_by,  
                         C.company_name,
                         C.company_email,
                         L.staff_uuid,
                         L.login_id
        FROM master_project As P
        INNER JOIN tblLogin As L 
        ON L.staff_uuid = P.created_By        
        INNER JOIN master_company As C
        ON C.created_by = P.created_By";

        $q = $this->db->query($query);
        // print_r($q->result());
        if ($q->num_rows() > 0) {
            return $q->result();        
            }   
            else {
                return FALSE;
            } 
    }

    public function getProjectAdminNameforSelect()
    {
        $query = "SELECT staff_uuid,login_id,level,isActive 
                    From tblLogin 
                    WHERE level = 2";
        $q = $this->db->query($query);
        // print_r($q->result());
        if ($q->num_rows() > 0) {
            return $q->result();        
            }   
            else {
                return FALSE;
            } 
    }
}

?>