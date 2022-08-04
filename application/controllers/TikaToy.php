<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TikaToy
 *
 * @author zmq
 */
class TikaToy extends CI_Controller{
   public function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->model('tikatoy_model'); 
    }
    
    
    public function cardRegister()
    {
        $data = json_decode(file_get_contents("php://input"),TRUE);
        $return_data = NULL;
        if(isset($data['cardid']) and $data["cardid"]!= NULL)
        {
         $return_data=$this->tikatoy_model->RegisterCard($data)  ;
        }
         print_r(json_encode($return_data));
       
    }
    
    public function  getToyid()
    {
              $return_data=$this->tikatoy_model->GetFreeToys();
              print_r(json_encode($return_data));
    }
    
    
     public function toyInitialization()
    {
        $data = json_decode(file_get_contents("php://input"),TRUE);
        $return_data = NULL;
        if(isset($data['toyid']) and $data["toyid"]!= NULL)
        {
         $return_data=$this->tikatoy_model->InitializedToy($data)  ;
        }
         print_r(json_encode($return_data));
       
    }
    
    
    public function iotInteraction()
    {
        $data = json_decode(file_get_contents("php://input"),TRUE);
        $return_data = NULL;
        if(isset($data['token_id']) and $data["token_id"]!= NULL and isset($data['visit_date_time']) and $data["visit_date_time"]!= NULL and isset($data['immunisation']) and $data["immunisation"]!= NULL and isset($data['verbal_comm_mother']) and $data["verbal_comm_mother"]!= NULL and isset($data['advise_related_child']) and $data["advise_related_child"]!= NULL and isset($data['child_id']) and $data["child_id"]!= NULL and isset($data['toy_id']) and $data["toy_id"]!= NULL and isset($data['immunization_messages']) and $data["immunization_messages"]!= NULL )
        {
        // $return_data=$this->tikatoy_model->IOT_interaction($data)  ;
         if ($this->tikatoy_model->IOT_interaction($data)) 
         {
                   // $this->response(   
                   $return_data= array(
                        "status" => 1,
                        "message" => "Toy data insert successfully"
                           // )
                            );
         } 
         else {
                  //  $this->response(
                     $return_data= array(
                        "status" => 0,
                        "message" => "Failed to insert toy information"
                          //  )
                            );
                }
        
        }
        
         print_r(json_encode($return_data));
       
    }
    
    public function  getRegisteredToys()
    {
              $return_data=$this->tikatoy_model->GetRegisterdToy();
              print_r(json_encode($return_data));
    }
}
