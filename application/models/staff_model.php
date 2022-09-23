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
     
    for($i=0; $i < count($projectStatus); $i++){
       
            $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid);

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
    
    public function fetchAssignedProjects($company_uuid, $projectStatus)
    {
        $project_uuid = "";
    //  var_dump($projectStatus);die();
        for($i=0; $i < count($projectStatus); $i++){
           
                $project_uuid_temp = explode(",", $projectStatus[$i]->project_uuid);
    
                $project_uuid.=",'".$project_uuid_temp[0]."'";       
        }
        
        $project_uuid = trim($project_uuid,",");

        $query = "SELECT project_uuid,project_name
        FROM master_project 
        WHERE company_uuid ='$company_uuid' 
        AND            
        project_uuid IN ($project_uuid)"; 
                
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

}

