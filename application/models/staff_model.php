<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_Model
 *
 * @author zmq
 */
 class Staff_Model extends CI_Model{
     
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function fetchPAdminByCompany($company_uuid)
    { 
        $query = "SELECT staff_uuid,emp_name
        FROM master_staff 
        WHERE company_uuid ='$company_uuid' AND level='2'" ;
   
          $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }  
       // return $company_uuid;
    }
 
    public function fetchProjectByCompany($company_uuid, $projectStatus)
    {
    $project_uuid = "";
    
    if(isset($projectStatus) || !empty($projectStatus)){
   
        for($i=0; $i < count(array($projectStatus)); $i++){
       
            $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid??NULL);

            $project_uuid.=",'".$project_uuid_temp[0]."'";       
     }
   
     $project_uuid=trim($project_uuid,",");
   // print_r($project_uuid);

   
        // $query = "SELECT project_uuid,project_name
        //     FROM master_project 
        //     WHERE company_uuid ='$company_uuid'"; 
            
    
        $query = "SELECT project_uuid,project_name
        FROM master_project 
        WHERE company_uuid ='$company_uuid' 
        AND            
        project_uuid  NOT IN ($project_uuid)"; 
                
            //-- project_uuid  NOT IN ('e743d690-3813-11ed-ad98-f44d304ae155','6fff912e-38b7-11ed-9604-f44d304ae155')"; 

          $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           } 
        }  
    }
    
    public function fetchAssignedProjects($company_uuid, $projectStatus)
    {
        $project_uuid = "";   
     
        for($i=0; $i < count(array($projectStatus)); $i++){
           
                $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid??NULL);
    
                $project_uuid.=",'".$project_uuid_temp[0]."'";       
        }
        
        $project_uuid = trim($project_uuid,",");

        // $query = "SELECT project_uuid,project_name
        // FROM master_project 
        // WHERE company_uuid ='$company_uuid' 
        // AND            
        // project_uuid IN ($project_uuid)"; 
                
        //Mapping Projects to Project Admin
        $query = "SELECT DISTINCT MS.emp_name,MP.project_name,PPM.project_admin_uuid,PPM.project_uuid 
        FROM project_projectAdmin_mapping As PPM 
        INNER JOIN master_staff As MS ON MS.staff_uuid = PPM.project_admin_uuid 
        INNER JOIN master_project As MP ON MP.project_uuid = PPM.project_uuid 
        WHERE MS.company_uuid ='$company_uuid' AND MP.project_uuid IN ($project_uuid) 
        AND PPM.status='1'"; 

 

        $q = $this->db->query($query);
          
         
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           } 
         
    }

    public function fetchProjectStatus($company_uuid)
    {
        $query = "SELECT MS.emp_name, MP.project_admin_uuid,MP.project_uuid,MP.status 
                FROM project_projectAdmin_mapping As MP
                INNER JOIN master_staff As MS
                ON MS.staff_uuid = MP.project_admin_uuid	
                WHERE MP.isActive = '1' AND MS.company_uuid = '$company_uuid'
                AND MP.status = '1' ";
                
        $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }  
    }

    public function updateProjectStatus($project_uuid)
    {
        $data = array(
            'status' => 0,           
        );
    
        $this->db->where('project_uuid', $project_uuid);
        $this->db->update('project_projectAdmin_mapping', $data);
    }

    public function getMappedData()
    {
        $query = "SELECT project_admin_uuid,project_uuid FROM project_projectAdmin_mapping WHERE isActive = '1' ";
        $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }  
    }

    public function getPhcCenterList()
    {
        $query = "SELECT * FROM tblPhcRegister WHERE isActive = '1' ";
        $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }    
    }

    public function getZMQToysList()
    {
        $query = "SELECT DISTINCT TR.ToyId,
                         TR.ToyName,
                         TR.IsAssignedtoPhc,
                         TR.PhcId,TR.isActive,
                         TPM.zmq_toy_Id,
                         TPM.phc_center_id,
                         TPM.status,
                         TPM.isActive
            FROM tblToyRegistration As TR 
            INNER JOIN toys_phcCenter_mapping As TPM 
            WHERE TR.isActive = TPM.isActive  AND TR.IsAssignedtoPhc='0' GROUP BY TR.ToyId";

        $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return FALSE;
           }    
    }
 
    public function fetchAssignedToys()
    {
        //tblPhcRegister, toys_phcCenter_mapping, tblToyRegistration

        // $query11 = "SELECT DISTINCT MS.emp_name,MP.project_name,PPM.project_admin_uuid,PPM.project_uuid 
        // FROM project_projectAdmin_mapping As PPM 
        // INNER JOIN master_staff As MS ON MS.staff_uuid = PPM.project_admin_uuid 
        // INNER JOIN master_project As MP ON MP.project_uuid = PPM.project_uuid 
        // WHERE MS.company_uuid ='$company_uuid' AND MP.project_uuid IN ($project_uuid) 
        // AND PPM.status='1'"; 

        $query = "SELECT DISTINCT TR.ToyId,
                                TR.ToyName,
                                TR.IsAssignedtoPhc,
                                TR.PhcId,
                                TR.isActive,
                                TPM.zmq_toy_Id,
                                TPM.phc_center_id,
                                TPM.status,
                                TPM.isActive
                                
        FROM tblToyRegistration As TR 
        INNER JOIN toys_phcCenter_mapping As TPM ON TR.ToyId = TPM.zmq_toy_Id
        INNER JOIN tblPhcRegister As PR   ON TPM.isActive = PR.isActive        
        AND TR.IsAssignedtoPhc='0' GROUP BY TR.ToyId";

        $q = $this->db->query($query);
                
        //   var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            return FALSE;
        }    
    }

    public function fetchOnlyAssignedToys(){
        $query = "SELECT ToyId,ToyName,IsAssignedtoPhc,isActive From tblToyRegistration
        WHERE IsAssignedtoPhc='1' AND isAssignedToPhcStaff ='0'";
        $q = $this->db->query($query);
                
        //   var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            return FALSE;
        }    
    }

    public function getZMQTokenList(){
        $query = "SELECT TokenId,ZMQTokenId,TokenRealId,isActive From tblTokenMaster
        WHERE isActive='1' AND isAssignedtoToy='0'";
        $q = $this->db->query($query);
                
        //   var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            return FALSE;
        }       
    }

    public function getPHCStaffList($company_uuid)
    {
       // var_dump($company_uuid);
        
       
        $query = "SELECT staff_uuid,emp_name,designation_id,isActive From master_staff
        WHERE isActive='1' AND level='3' AND hasToy ='0' AND company_uuid = '$company_uuid'";
        
/*
        $query = "SELECT `staff_uuid`,`phc_staff_id`,`emp_name` FROM `toy_phcStaff_mapping` AS tpm INNER JOIN master_staff as ms ON tpm.isActive = ms.isActive AND ms.company_uuid='$company_uuid' AND ms.level=3 AND tpm.status=1 GROUP BY tpm.status";
*/      
        $q = $this->db->query($query);
                
        //   var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            return FALSE;
        }      
    }

    // ------------------------------
    public function getToyListAccordingToPHC($phc_id)
    {
        $query = "SELECT zmq_toy_Id,ToyName, phc_center_id,status FROM toys_phcCenter_mapping as tp INNER JOIN tblToyRegistration as tr ON tr.ToyId = tp.zmq_toy_Id         
        WHERE tp.phc_center_id='$phc_id' AND isAssignedToPhcStaff='0'";
        
        $q = $this->db->query($query);
                
        //var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            return FALSE;
        }      
    }
    public function getPhcStaffId($phc_login_id)
    {
        $query = "SELECT staff_uuid FROM tblLogin where login_id='$phc_login_id' AND level='3'";

        $q = $this->db->query($query);
                
       // var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            
            return FALSE;
        }  
    }

    public function getToysUnderphcstaff($phc_staff_id){
        //var_dump($phc_staff_id);
        
        $query = "SELECT tp.phc_center_id,
                         tp.zmq_toy_Id, 
                         tp.phc_staff_id,
                         tp.status, 
                         tr.ToyName
                FROM toy_phcStaff_mapping as tp 
                INNER JOIN tblToyRegistration as tr 
                ON tr.ToyId = tp.zmq_toy_Id 
                WHERE tp.phc_staff_id ='$phc_staff_id'";
         
        $q = $this->db->query($query);
                
        //var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {            
            return FALSE;
        }    
    }

    public function getSelectedToyTokens($phc_staff_id)
    {
        //  var_dump($phc_staff_id);die();
        $query = "SELECT ttm.zmq_token_Id,ttm.zmq_toy_Id,
                tp.phc_center_id,pr.PhcName,ttr.ToyName                   
                FROM toy_phcStaff_mapping as tp 
                INNER JOIN tokens_toy_mapping as ttm                  
                ON tp.zmq_toy_Id = ttm.zmq_toy_Id 
                INNER JOIN tblPhcRegister as pr
                ON pr.PhcId = tp.phc_center_id 
                INNER JOIN tblToyRegistration as ttr
                ON ttr.ToyId = tp.zmq_toy_Id         
                WHERE tp.phc_staff_id ='$phc_staff_id'";

        $q = $this->db->query($query);

      

        if ($q->num_rows() > 0) {
        return $q->result();       
        }   
        else {

        return FALSE;
        }    
    }
    
} //class-ends

