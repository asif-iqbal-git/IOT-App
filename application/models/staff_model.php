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

    public function fetchProjectByCompany($company_uuid)
    {
        $query = "SELECT project_uuid,project_name
        FROM master_project 
        WHERE company_uuid ='$company_uuid'";
   
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

