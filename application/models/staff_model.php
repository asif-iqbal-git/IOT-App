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
         
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return NULL;
           }  
       // return $company_uuid;
    }

    public function fetchProjectStatus($company_uuid)
    {
        // var_dump($company_uuid);
        try{
            $query = "SELECT MS.emp_name, 
                            MP.project_admin_uuid,
                            MP.project_uuid,
                            MP.status 
                    FROM project_projectAdmin_mapping As MP
                    INNER JOIN master_staff As MS
                    ON MS.staff_uuid = MP.project_admin_uuid	
                    WHERE MP.isActive = '1' AND MS.company_uuid = '$company_uuid'
                    AND MP.status = '1' ";
                
        $q = $this->db->query($query);
        //   echo "<pre/>";
        //    var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return array();
           }  
        }catch (Exception $e){ echo $e->getMessage();}
    }

    public function fetchProjectByCompany($company_uuid, $projectStatus)
    {
      //  var_dump(count( ($projectStatus)));
        try {
            $project_uuid = "";
        
            if(isset($projectStatus) || !empty($projectStatus)){
        
                for($i=0; $i < count(($projectStatus)); $i++){
            
                    $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid??NULL);

                    $project_uuid.=",'".$project_uuid_temp[0]."'";       
            }
   
            $project_uuid = trim($project_uuid,",");
            // var_dump($project_uuid);

   
            $query = "SELECT DISTINCT project_uuid,project_name
                FROM master_project 
                WHERE company_uuid ='$company_uuid'"; 
                
            // if($project_uuid != ""){}
            // $query = "SELECT project_uuid,project_name
            // FROM master_project 
            // WHERE company_uuid ='$company_uuid' 
            // AND            
            // project_uuid  NOT IN ($project_uuid)"; 

            // $query = "SELECT DISTINCT mp.project_uuid,mp.project_name From master_project as mp
            // INNER JOIN project_projectAdmin_mapping as ppm 
            // ON mp.project_uuid = ppm.project_uuid
            // AND mp.company_uuid='$company_uuid'"; 
                // And ppm.status = '0' 

          

            //-- project_uuid  NOT IN ('e743d690-3813-11ed-ad98-f44d304ae155','6fff912e-38b7-11ed-9604-f44d304ae155')"; 

            $q = $this->db->query($query);
            
            //   var_dump($q->result());die();
            
            if ($q->num_rows() > 0) {
                    return $q->result();       
                }   
                else {
                    return array();
                } 
            } 
        }
        catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    
    public function fetchAssignedProjects($company_uuid, $projectStatus)
    {
        $project_uuid = "";   
   
    
    try {
        
        for($i=0; $i < count(($projectStatus)); $i++){
           
                $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid??NULL);
    
                $project_uuid.=",'".$project_uuid_temp[0]."'";       
        }
        
            $project_uuid = trim($project_uuid,",");
            // echo("<pre/>");
            // var_dump(($project_uuid));
        
            if(!empty($project_uuid)){
            //Mapping Projects to Project Admin
            $query = "SELECT DISTINCT MS.emp_name,
                                      MP.project_name,
                                      PPM.project_admin_uuid,
                                      PPM.project_uuid 
            FROM project_projectAdmin_mapping As PPM 
            INNER JOIN master_staff As MS 
            ON MS.staff_uuid = PPM.project_admin_uuid 
            INNER JOIN master_project As MP 
            ON MP.project_uuid = PPM.project_uuid 
            WHERE MS.company_uuid ='$company_uuid' 
            AND MP.project_uuid IN ($project_uuid) 
            AND PPM.status='1'"; 

        $q = $this->db->query($query);

                if ($q->num_rows() > 0) {
                        return $q->result();       
                }   
                else {
                    return array();
                } 
            }else{
                echo "Empty Project UUID";
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }  
    }

  

    public function updateProjectStatus($project_uuid, $projectAdminId)
    {
     
        $project_uuid= trim($project_uuid);
        $projectAdminId= trim($projectAdminId);
        
        $query = "UPDATE project_projectAdmin_mapping SET `status` = 0 WHERE (`project_uuid` = '".$project_uuid."' AND `project_admin_uuid`='".$projectAdminId."')";
      
        $q = $this->db->query($query);
        
        if ($q) {
            return true;       
         }   
       else {
           return false;
       }  
    }

    public function getMappedData()
    {
        $query = "SELECT project_admin_uuid,project_uuid,status FROM project_projectAdmin_mapping WHERE isActive = '1'"; 
        // -- and project_admin_uuid= '".$adminId. "'";
        
        $q = $this->db->query($query);
          
        //   var_dump($q->result());die();
        
         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return (object)[];
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
               return (object)[];
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
        $query = "SELECT ms.staff_uuid,ms.emp_name,ms.designation_id,
                ms.phc_id,tpg.PhcName,ms.isActive 
                From master_staff As ms
                INNER JOIN tblPhcRegister as tpg
                ON ms.phc_id = tpg.PhcId
                WHERE ms.isActive='1' 
                AND ms.level='3' 
                AND ms.hasToy ='0' 
                AND ms.company_uuid = '$company_uuid'";
        
/*
        $query = "SELECT `staff_uuid`,`phc_staff_id`,`emp_name` FROM `toy_phcStaff_mapping` AS tpm INNER JOIN master_staff as ms ON tpm.isActive = ms.isActive AND ms.company_uuid='$company_uuid' AND ms.level=3 AND tpm.status=1 GROUP BY tpm.status";
*/      
        $q = $this->db->query($query);
                
        //   var_dump($q->result());die();

        if ($q->num_rows() > 0) {
                return $q->result();       
        }   
        else {
            // return (object)[];
            return array();
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
        
        $query = "SELECT DISTINCT tp.phc_center_id,
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
        // var_dump($q->num_rows());
        
        if ((int)$q->num_rows() > 0) {
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

    public function getLastInsertedToyId()
    {
        $query = "SELECT * FROM tblToyRegistration ORDER BY ToyId DESC limit 1";
        
        $q = $this->db->query($query);
       
        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return FALSE;
        }    
    }

    public function getLastTenRecords()
    {
        $query = "SELECT ToyName FROM tblToyRegistration ORDER BY ToyId DESC limit 10";
        
        $q = $this->db->query($query);
       
        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return (object)[];
        }    
    }

    public function getAllStaffDetails(){
        $query = "SELECT ms.emp_name,
                ms.login_id,
                tl.password,
                ms.level,
                ms.designation_id,                
                ms.emp_phone, 
                ms.emp_address,
                tl.created_datetime
            FROM master_staff As ms
            INNER JOIN tblLogin As tl 
            ON ms.staff_uuid = tl.staff_uuid  
            AND ms.isActive='1' 
            ORDER BY tl.created_datetime DESC";
 
            $q = $this->db->query($query);
                
            if ($q->num_rows() > 0) {
                return $q->result();       
            }   
            else {
                return (object)[];
            }        
}


/*
    public function getProjectListByAdmin($projectAdminId, $company_uuid)
    {
        $query = "SELECT DISTINCT mp.project_uuid,mp.project_name From master_project as mp
            INNER JOIN project_projectAdmin_mapping as ppm 
            ON mp.isActive = ppm.isActive
            And ppm.status = '0'   
            AND mp.company_uuid='$company_uuid'";                 
 
            $q = $this->db->query($query);
            
              //var_dump($q->result());die();
            
            if ($q->num_rows() > 0) {
                    return $q->result();       
                }   
                else {
                    return (object)[];
                }
    }
    */
    
    public function fetchAllPhcName(){
        $query = "SELECT * FROM tblPhcRegister WHERE isActive = '1'";
        
        $q = $this->db->query($query);
       
        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return (object)[];
        }  
    }

} //class-ends

