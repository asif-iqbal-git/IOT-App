<?php

class StaffController extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');
        $this->load->model('staff_model');
        $this->load->library('email'); //email
      //  $this->load->library('encrypt');//it will encrypt your email and help to avoid the spamming issue in Gmail. 
    }

    public function addStaff()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $data['staff_designation'] = $this->getStaffDesignation();
        $data['phc_name'] = $this->staff_model->fetchAllPhcName();
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/addStaff', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }

    public function update_staff_details(){
        
        $data['staff'] = $this->loginmodel->get_staff_info();

        $emp_uuid = $data['staff'][0]->staff_uuid;

        $updated_data['login_id'] = $this->input->post('login_id');
        $updated_data['emp_name'] = $this->input->post('emp_name');
        $updated_data['emp_age'] = $this->input->post('emp_age');
        $updated_data['emp_phone'] = $this->input->post('emp_phone');
        $updated_data['emp_email'] = $this->input->post('emp_email');
        $updated_data['emp_address'] = $this->input->post('emp_address');
        $updated_data['level'] = $this->input->post('level');
        $updated_data['designation_id'] = $this->input->post('desig_id');
        $updated_data['phc_id'] = $this->input->post('phc_id');
        $updated_data['isActive'] = $this->input->post('isActive');
        $updated_data['created_by'] = $this->input->post('created_by');
        $updated_data['created_datetime'] = $this->input->post('created_at');

        $this->loginmodel->save_updated_staff_info($updated_data, $emp_uuid);

        redirect('staff_details');

    }

    public function saveStaffInfo()
    {
        $userData = $this->session->userdata('userData');  
     //  var_dump($userData);   
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        $created_by = $this->staff_model->getLoggedInUUID($userData['login_id']);
        $created_by =  $created_by->staff_uuid;
        
    //    var_dump(($company_info==(object)[]));die();
        /*
        //using phpmailer         
        // Load PHPMailer library
         $this->load->library('phpmailer_lib');        
         // PHPMailer object
         $mail = $this->phpmailer_lib->load();
        // SMTP configuration          
         $mail->SMTPDebug = 2; //for detailed debugging  
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'johndeo8789@gmail.com';
        $mail->Password = 'johndeo123';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
          
          $mail->setFrom('johndeo8789@gmail.com', 'ZMQ');
          $mail->addReplyTo('johndeo8789@gmail.com', 'ZMQ');
          
          // Add a recipient
          $mail->addAddress('aasif.iqbal8446@gmail.com');
          
          // Add cc or bcc 
        //   $mail->addCC('cc@example.com');
        //   $mail->addBCC('bcc@example.com');
          
          // Email subject
          $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
          
          // Set email format to HTML
          $mail->isHTML(true);
          
          // Email body content
          $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
              <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
          $mail->Body = $mailContent;
          
          // Send email
          if(!$mail->send()){
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
              die();
          }else{
              echo 'Message has been sent';
              die();
          }
        
        */
        /* in-build codeigniter email lib
        //send email to each staff for userId and Password
        $config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'johndeo8789@gmail.com',
                    'smtp_pass' => 'johndeo123',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");        
        //Email content
    $htmlContent = '<h1>Sending email via SMTP server</h1>';
    $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';
        $this->email->to('aasif.iqbal8446@gmail.com');
        $this->email->from('johndeo8789@gmail.com','MyWebsite');
        $this->email->subject('How to send email via SMTP server in CodeIgniter');
        $this->email->message($htmlContent);
        //Send email
        
        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
        // Set to, from, message, etc.https://www.codexworld.com/codeigniter-send-email-gmail-smtp-server/
        //https://www.formget.com/codeigniter-gmail-smtp/
*/
         if($company_info!=(object)[]){
        $staff_data['company_uuid'] = $company_info[0]->company_uuid;       
        
        $staff_data['login_id'] = $this->input->post('staff_email');       

        $staff_data['emp_name'] = $this->input->post('staff_name');       
        $staff_data['emp_age'] = $this->input->post('staff_age');
        $staff_data['emp_gender'] = $this->input->post('staff_gender');
        $staff_data['emp_phone'] = $this->input->post('staff_phone');
        $staff_data['emp_email'] = $this->input->post('staff_email');
        $staff_data['emp_address'] = $this->input->post('staff_address');
        $staff_data['designation_id'] = $this->input->post('staff_designation');
        $staff_data['phc_id'] = $this->input->post('phc_id');

        $level = $this->tikatoy_model->getLevelByDesignation($staff_data['designation_id']);
      
        $staff_data['level'] = $level[0]->level;
       
        $staff_data['isActive'] = 1;
        $staff_data['created_by'] = $created_by;
         
        //Generate Random String And Send it to Users Email Id
        $staff_login_data['login_id'] = $this->input->post('staff_email');
        $staff_login_data['password'] = $this->generateRandomString();
        // $staff_login_data['login_id'] = $this->input->post('staff_login_id');
        // $staff_login_data['password'] = $this->input->post('staff_password');
        
        // var_dump($staff_data);die();
       
        $staff_login_data['level'] = $level[0]->level;
        $this->tikatoy_model->storeMasterStaffInfo($staff_data, $staff_login_data);
        $this->session->set_flashdata('add_company_admin_staff', 'Staff has been Created & Credentials send to Staff Email');

        redirect(base_url('addStaff'));
    }else{
        echo("Company admin id is invalid...Create Company First");
    } 
        // echo("<pre>");
        // var_dump($staff_data);die();
    }

    public function updateStaffInfo()
    {    
         $id = $this->input->post('id');
         $staffInfo = $this->loginmodel->getSingleStaffInfo($id);
         
         echo json_encode($staffInfo);
    }

    public function getStaffDesignation()
    {
        return $this->loginmodel->getDesignation();
    }
   
    public function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function displayAssignProjectToPAdmin()
    {
        $userData = $this->session->userdata('userData');
        if($userData != NULL){
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        
            $company_uuid = $company_info[0]->company_uuid??'';
        }
        
        $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){  
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');

            $data['Padminlist'] = $this->staff_model->fetchPAdminByCompany                  ($company_uuid);
            $data['PHCHeadList'] = $this->staff_model->fetchPHCHeadByCompany                  ($company_uuid);
            $data['FieldWorkerList'] = $this->staff_model->fetchFieldWorkerByCompany          ($company_uuid);
            
            $data['projectStatus'] = $this->staff_model->fetchProjectStatus($company_uuid);
           
            $projectStatus = $data['projectStatus'];
            // echo("<pre>");
            // var_dump($projectStatus);
            // $data['projectList'] = $this->staff_model->fetchProjectByCompany($company_uuid,$projectStatus);
            $data['projectList'] = $this->staff_model->getProjectListByCompany($company_uuid);

            $data['assignedProjects'] = $this->staff_model->fetchAssignedProjects($company_uuid,$projectStatus);
//             echo("<pre>");
// var_dump($data['assignedProjects']);die();
            $this->load->view('companyAdmin/assignProjectToPAdmin', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }
    
    public function displayDeAssignProjectToPAdmin()
    {
        $userData = $this->session->userdata('userData');
        if($userData != NULL){
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        
            $company_uuid = $company_info[0]->company_uuid??'';
        }
        
        $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){  
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');

            
            
            $data['projectStatus'] = $this->staff_model->fetchProjectStatus($company_uuid);
           
            $projectStatus = $data['projectStatus'];
          
            $data['projectList'] = $this->staff_model->getProjectListByCompany($company_uuid);

            $data['assignedProjects'] = $this->staff_model->fetchAssignedProjects($company_uuid,$projectStatus);

            $this->load->view('companyAdmin/deassignedProjectFromPAdmin', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }

    public function assign_Project_To_PAdmin()
    {
        /*
        Rules:If we Insert New Project(Not in DB) with Old Project(Present in DB)
        Then It gives msg='msg3';
        Rules:One Admin Can get Two or more Projects But Same Project not assign to two Admin.
        */

        $userData = $this->session->userdata('userData');         
        $created_by = $this->staff_model->getLoggedInUUID($userData['login_id']);
        $created_by =  $created_by->staff_uuid;

        $msg  = "Project Admin Already Exits";
        $msg2 = "This Project is Assigned Successfully";
        $msg3 = "This Project is already assigned to Selected Project Admin, Please Select New";        
        $msg4 = "Please Select Project-Admin or Phc-staff or Field-Worker Or Project, First";
        $msg5 = "Admin Found & Project Not Found";
        $msg6 = "Assigned Updated Successfully";

        $data['project_admin_uuid'] = $this->input->post('projectAdmin_id'); //[]
        
        $data['project_uuid'] = $this->input->post('checked_id'); //[]
        
        //flags
        $project_found = 0;
        $project_admin_found = 0;
        $is_Assigned = 0;

    //    var_dump($data['project_uuid'] );
    //    var_dump($data['project_admin_uuid']);
    //    die();

        if(empty($data['project_admin_uuid'])){           
            return print_r(json_encode($msg4));
        }       

        if(empty($data['project_uuid'])){
           
            return print_r(json_encode($msg4));
        }

        
        
        $project_projectAdmin_mapping = $this->staff_model->getMappedData();
        // var_dump($project_projectAdmin_mapping);  
        // echo('<pre/>');die();
        if(($project_projectAdmin_mapping)!= (object)[]){

        for($k=0 ; $k < count($project_projectAdmin_mapping);  $k++)
        {
            for($p=0; $p < count($data['project_admin_uuid']); $p++){

                if($data['project_admin_uuid'][$p] == $project_projectAdmin_mapping[$k]->project_admin_uuid)
                    {
                        // echo "Found Admin already exist But Project Not assiged";
                        $project_admin_found = 1;
                        foreach($data['project_uuid'] as $row){
                            
                            if($row == $project_projectAdmin_mapping[$k]->project_uuid){
                                //  echo "Admin Found-Project Found - And Assigned (is already exist)";
                                $project_found = 1;                        
                            }
                            // echo "Admin-Found & Project-Found & Assigned to Admin";
                            if($project_projectAdmin_mapping[$k]->status == 1 && 
                                $row == $project_projectAdmin_mapping[$k]->project_uuid){
                                $is_Assigned = 1;
                            }        
                        }
                    }
                }
            }
    }
    else{
    //    echo"empty obj";     
      //insertion for first time in project_projectAdmin_mapping-tbl        

      for($i=0; $i < count($data['project_admin_uuid']); $i++){
        for($j=0; $j < count($data['project_uuid']); $j++){
         
            // echo($data['project_admin_uuid'][$i]."=>".$data['project_uuid'][$j]);
            // echo("<br>");

            $dataToInsert = array();

            $dataToInsert['project_admin_uuid'] = $data['project_admin_uuid'][$i];
            $dataToInsert['project_uuid'] = $data['project_uuid'][$j];
            $dataToInsert['status'] = 1;
            $dataToInsert['isActive'] = 1;
            $dataToInsert['created_By'] = $created_by;
            
           $this->db->insert("project_projectAdmin_mapping", $dataToInsert); 
           
           //update project uuid           
           $this->db->where('project_uuid', $dataToInsert['project_uuid']);
           $this->db->update('master_project', ['isAssignedToPAdmin'=>'1']); 
        }
      }
      print_r(json_encode($msg2));
      exit();
    }
        
       

        if($project_admin_found && $project_found && $is_Assigned){                         
                print_r(json_encode($msg3));            
        }

        if($project_admin_found!=1 && $project_found!=1 || 
            $project_admin_found == 1 && $project_found!=1 && $is_Assigned == 0){

                for($i=0; $i < count($data['project_admin_uuid']); $i++){
                    for($j=0; $j < count($data['project_uuid']); $j++){
                     
                        // echo($data['project_admin_uuid'][$i]."=>".$data['project_uuid'][$j]);
                        // echo("<br>");
            
                        $dataToInsert = array();
            
                        $dataToInsert['project_admin_uuid'] = $data['project_admin_uuid'][$i];
                        $dataToInsert['project_uuid'] = $data['project_uuid'][$j];
                        $dataToInsert['status'] = 1;
                        $dataToInsert['isActive'] = 1;
                        $dataToInsert['created_By'] = $created_by;
                        
                       $this->db->insert("project_projectAdmin_mapping", $dataToInsert); 
                       
                       //update project uuid           
                       $this->db->where('project_uuid', $dataToInsert['project_uuid']);
                       $this->db->update('master_project', ['isAssignedToPAdmin'=>'1']); 
                    }
                  }  
            print_r(json_encode($msg2));
        } 
             
        // if admin found - update
        if($project_admin_found == 1 && $project_found == 1 && $is_Assigned != 1){

            // foreach($data['project_uuid'] as $row){
               
            //     $data['project_uuid'] = $row;
                
            //     $query = "UPDATE project_projectAdmin_mapping SET status = '1' WHERE 
            //     project_uuid = '$row'";
            //     $q = $this->db->query($query);  
            //      //update project uuid           
            //     $this->db->where('project_uuid', $row);
            //     $this->db->update('master_project', ['isAssignedToPAdmin'=>'1']);                                      
            // }     

            for($i=0; $i < count($data['project_admin_uuid']); $i++){
                for($j=0; $j < count($data['project_uuid']); $j++){
                 
                     
                   
                    // $dataToInsert['project_admin_uuid'] = $data['project_admin_uuid'][$i];
                    // $dataToInsert['project_uuid'] = $data['project_uuid'][$j];
                     
                    
                    
                // $query = "UPDATE project_projectAdmin_mapping SET status = '1' WHERE 
                // project_uuid = $data['project_uuid'][$j]";
                if($data['project_uuid'] != 0){
                    $this->db->where('project_uuid', $data['project_uuid'][$j]);
                    $this->db->update('project_projectAdmin_mapping', ['status'=>'1']);  
                }
                
                
               // $q = $this->db->query($query);  
                 //update project uuid    
                 if($data['project_uuid'] != 0){       
                    $this->db->where('project_uuid', $data['project_uuid'][$j]);
                    $this->db->update('master_project', ['isAssignedToPAdmin'=>'1']);  
                 }
                }
            }
            print_r(json_encode($msg6));
        } 
    }
    


//Rule: In this function we can assign one project to multiple admin and one admin can get multiple projects [many-to-many relationship]

    public function assign_Project_To_PAdmin_notUsing()
    {
        /*
        Rules:If we Insert New Project(Not in DB) with Old Project(Present in DB)
        Then It gives msg='msg3'; 
        */
        $msg  = "Project Admin Already Exits";
        $msg2 = "This Project is Assigned Successfully";
        $msg3 = "This Project is already assigned to Selected Project Admin, Please Select New";        
        $msg4 = "Please Select Admin Or Project, First";
        $msg5 = "Admin Found & Project Not Found";
        $msg6 = "Assigned Updated Successfully";

        $data['project_admin_uuid'] = $this->input->post('projectAdmin_id');
        $data['project_uuid'] = $this->input->post('checked_id');
       
        $project_found = 0;
        $project_admin_found = 0;
        $is_Assigned = 0;
    //    var_dump($data['project_uuid'] );
    //    var_dump($data['project_admin_uuid']);die();

        if(empty($data['project_admin_uuid'])){
           
            return print_r(json_encode($msg4));
        }
        
        if(empty($data['project_uuid'])){
           
            return print_r(json_encode($msg4));
        }

        $project_projectAdmin_mapping = $this->staff_model->getMappedData();
        
        // echo('<pre/>');
        if(($project_projectAdmin_mapping)!= (object)[]){
                
      // var_dump($project_projectAdmin_mapping);

        for($i=0 ; $i < count($project_projectAdmin_mapping);  $i++)
        {
           if($data['project_admin_uuid'] == $project_projectAdmin_mapping[$i]->project_admin_uuid)
            {
                // echo "Found Admin already exist But Project Not assiged";
                $project_admin_found = 1;
                foreach($data['project_uuid'] as $row){
                    
                    if($row == $project_projectAdmin_mapping[$i]->project_uuid){
                        //  echo "Admin Found-Project Found - And Assigned (is already exist)";
                        $project_found = 1;                        
                    }
                     // echo "Admin-Found & Project-Found & Assigned to Admin";
                    if($project_projectAdmin_mapping[$i]->status == 1 && 
                        $row == $project_projectAdmin_mapping[$i]->project_uuid){
                        $is_Assigned = 1;
                    }        
                }
            }
        }
    }
    //else{
        //echo"empty obj";
    //}
        if($project_admin_found && $project_found && $is_Assigned){                         
                print_r(json_encode($msg3));            
        }

        if($project_admin_found!=1 && $project_found!=1 || 
            $project_admin_found == 1 && $project_found!=1 && $is_Assigned == 0){

            foreach($data['project_uuid'] as $row){
                $data['project_admin_uuid'] = $this->input->post('projectAdmin_id');
                $data['project_uuid'] = $row;
                $data['status'] = 1;
                $data['isActive'] = 1;

               $this->db->insert("project_projectAdmin_mapping", $data);              
            }       
            print_r(json_encode($msg2));
        } 
             
        // if admin found - update
        if($project_admin_found == 1 && $project_found == 1 && $is_Assigned != 1){

            foreach($data['project_uuid'] as $row){
               
                $data['project_uuid'] = $row;
                
                $query = "UPDATE project_projectAdmin_mapping SET status = '1' WHERE 
                project_uuid = '$row'";
                $q = $this->db->query($query);                                        
            }       
            print_r(json_encode($msg6));
        } 
    }
    
    public function assign_Project_To_PAdmin_Ajax(){
        $msg = "got it";
        $userData = $this->session->userdata('userData');
        
        if($userData != NULL){
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        
            $company_uuid = $company_info[0]->company_uuid??'';
        }

        $projectAdminId = $this->input->post('projectAdmin_id');
        $project_list_by_admin = $this->staff_model->getProjectListByAdmin($projectAdminId, $company_uuid);
        print_r(json_encode($project_list_by_admin));
    }   

    public function unAssign_Project_To_PAdmin()
    {
        $msg = "UnAssigned is done successfully";

        $project_uuid = $this->input->post('project_uuid');
        $projectAdminId = $this->input->post('projectAdminId');                

        $this->staff_model->updateProjectStatus($project_uuid, $projectAdminId);
        
        // Also update Master Project Table
        $project_uuid= trim($project_uuid);
        $this->db->where('project_uuid', $project_uuid);
        $this->db->update('master_project', ['isAssignedToPAdmin'=>'0']);        

        print_r(json_encode($msg));
    }


    public function project_list()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
       // $data['staff_designation'] = $this->getStaffDesignation();
        $data['project_list_by_company'] = ['Demo-project'];
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('staff/projectList', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }

   /* public function get_single_emp_id(){

        $id = $this->input->post('staff_uuid');

        $this->loginmodel->get_staff_info_using_id($id);

        echo json_encode();

    }*/

    public function staff_registration()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
       // $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/toyRegistration');
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }

    public function displayAssignToysToPhcCenter()
    {
        $userData = $this->session->userdata('userData');
        $data['phc_list'] = $this->staff_model->getPhcCenterList();
        $data['toy_list'] = $this->staff_model->getZMQToysList();
        $data['assignToyList'] = $this->staff_model->fetchAssignedToys();
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/assignToyToPhcCenter', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }

    public function displayProjectToPHC(){
        $userData = $this->session->userdata('userData');
        
        if($userData != NULL){
           
            $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
            
                $company_uuid = $company_info[0]->company_uuid??'';
            }
        $data['projectList'] = $this->staff_model->getProjectListByCompany($company_uuid);
        $data['phc_list'] = $this->staff_model->getPhcCenterList();         
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/assignProjectToPHC', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }

    public function assign_toys_To_phc_center_ajax()
    {
        $msg = "Toys are assigned to phc-Center";

        $userData = $this->session->userdata('userData');
      //  $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
      //  $created_by = $this->tikatoy_model->getCompanyLoginId($userData['login_id']);
 
        $created_by = $this->staff_model->getLoggedInUUID($userData['login_id']);
        $created_by =  $created_by->staff_uuid;

        $data['phc_center_id'] = $this->input->post('phcCenterId');
        $data['zmq_toy_Id'] = $this->input->post('checked_id');
        $updatedStatus = 1;

        foreach($data['zmq_toy_Id'] as $row){
            $data['phc_center_id'] = $this->input->post('phcCenterId');
            $data['zmq_toy_Id'] = $row;
            $data['created_by'] =  $created_by;
            $data['status'] = 1;
            $data['isActive'] = 1;
            //Insert 
            $this->db->insert("toys_phcCenter_mapping", $data);
            //update toy status and PhcId
            $this->db->set('IsAssignedtoPhc',$updatedStatus)->set('PhcId',$data['phc_center_id'])->where('ToyId',$row)->update('tblToyRegistration');
           //print_r(json_encode($row));
        }


        print_r(json_encode($msg));
    }

    public function displayAssignTokensToToy(){
        $userData = $this->session->userdata('userData');
        // $data['phc_list'] = $this->staff_model->getPhcCenterList();
        $data['token_list'] = $this->staff_model->getZMQTokenList();
        $data['assignToyList'] = $this->staff_model->fetchOnlyAssignedToys();
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/assignTokensToToy', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }
    
    public function assign_token_To_toys()
    {
        $msg = "Tokens are assigned to selected Toy";

        $userData = $this->session->userdata('userData');
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']); 
       // $created_by=$company_info[0]->created_by;
       
        $created_by = $this->staff_model->getLoggedInUUID($userData['login_id']);
        
        // print_r(gettype(json_encode($created_by)));
      //var_dump($created_by->staff_uuid);die();
        
        $data['zmq_toy_Id'] = $this->input->post('zmqToyId');
        $data['zmq_token_Id'] = $this->input->post('checked_id');
        $updatedStatus = 1;

        foreach($data['zmq_token_Id'] as $row){
            $data['zmq_toy_Id'] = $this->input->post('zmqToyId');
            $data['zmq_token_Id'] = $row;
            $data['created_by'] =  $created_by->staff_uuid; //company admin
            $data['status'] = 1;
            $data['isActive'] = 1;
           $this->db->insert("tokens_toy_mapping", $data);
            //update toy status and PhcId
           $this->db->set('isAssignedtoToy',$updatedStatus)->set('ToyId',$data['zmq_toy_Id'])->where('TokenId',$row)->update('tblTokenMaster');
           // print_r(json_encode($row));
        }
        print_r(json_encode($msg));
    }

    public function displayAssignToyTOPhcStaff()
    {
      
        $userData = $this->session->userdata('userData');
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
       // var_dump($userData['login_id']);
        $data['assignToyList'] = $this->staff_model->fetchOnlyAssignedToys();
        $data['phc_list'] = $this->staff_model->getPhcCenterList();
        //fetch toy according to phc center
       // $data['toyListByphc']= $this->staff_model->getToyListAccordingToPHC($phc_id=1);
        $data['phcStaff_list'] = $this->staff_model->getPHCStaffList($company_info[0]->company_uuid?? NULL);
        $data['toyWithToken'] = $this->staff_model->getToyWithTokens($phc_center_id=2);
        
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/assignToyToPhcStaff', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }   
    }

    public function showToyListByPHC(){

        $data['phcCenterId'] = $this->input->post('phcCenterId');
        $phc_id = $data['phcCenterId'];
        $data['toyListByphc'] = $this->staff_model->getToyListAccordingToPHC($phc_id);
        if($data['toyListByphc'] != (object)[]){
            print_r(json_encode($data['toyListByphc']));
        }else{
            print_r(json_encode("Error in fetching toy list"));
        }
        
    }

    public function assign_toy_To_phcStaff()
    {
        $msg = "Toy is assigned to selected Phc-Staff";

        $userData = $this->session->userdata('userData');
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        
        $created_by = $this->staff_model->getLoggedInUUID($userData['login_id']);
        $created_by =  $created_by->staff_uuid;
        // var_dump($company_info[0]->created_by);die();

        $data['zmq_toy_Id'] = $this->input->post('checked_id');
        foreach($data['zmq_toy_Id'] as $row){
            $data['phc_center_id'] = $this->input->post('phcCenterId');
            $data['zmq_toy_Id'] = $row;
            $data['phc_staff_id'] = $this->input->post('phcStaffId');    
            $data['created_by'] = $created_by;
            $data['status'] = 1;
            $data['isActive'] = 1;
            //insert mapping details
            $this->db->insert("toy_phcStaff_mapping", $data);
            //update toy status and PhcId
            $this->db->set('hasToy', 1)->where('staff_uuid',$data['phc_staff_id'])->update('master_staff');
            //update toyRegistration for selected Toy for phcStaff
            $this->db->set('isAssignedToPhcStaff', 1)->set('PhcId',$data['phc_center_id'])->where('ToyId',$data['zmq_toy_Id'])->update('tblToyRegistration');                                                          
        }                                                                                 
            print_r(json_encode($msg));
    }

    public function showToysUnderphcstaff()
    {
        $userData = $this->session->userdata('userData');
        //$company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        $phc_staff_id = $this->staff_model->getPhcStaffId($userData['login_id']);
        //var_dump($phc_staff_id[0]['staff_uuid']);die();
        $data['userInfo'] = $userData['login_id'];
         $data['selectedToytokens'] = $this->staff_model->getSelectedToyTokens($phc_staff_id[0]->staff_uuid);
        $data['toysUnderphcstaff'] = $this->staff_model->getToysUnderphcstaff($phc_staff_id[0]->staff_uuid);

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('staff/toysUnderPhcStaff', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }   
    }
    
    public function generateZMQToys()
    {
        $msg = 'Toy Generated Successfully';

        $flag = $this->input->post('flag');
        $last_id = $this->staff_model->getLastInsertedToyId();        

        $last_inserted_id = $last_id[0]->ToyName ? $last_id[0]->ToyName: 1;
        
        //$str = "ZMQ_TOY_016";
        $str = substr($last_inserted_id,8);
        $last_inserted_id = (int)$str;

        for($i = $last_inserted_id+1; $i <= $last_inserted_id+10; $i++)
        {
            $data = array(
                'ToyName' => 'ZMQ_TOY_0'.$i,
                'PhcId' => '0',
                'IsInitialized' => '0',
                'IsAssignedtoPhc' => '0',
                'isAssignedToPhcStaff' => '0',
                'No_Of_Tokens' => '0',
                'projectid' => '0',
                'isActive' => '1'
        );
        
     //   $this->db->insert('tblToyRegistration', $data);
        }        

        if($flag){
            $getLastTenRecords = $this->staff_model->getLastTenRecords();
            return print_r(json_encode($getLastTenRecords));
        }
        
    }

    public function displayStaffInfo()
    {
        $userData = $this->session->userdata('userData');
         
        $data['staff_info'] = $this->staff_model->getAllStaffDetails();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('staff/staff_info', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }
    
    public function phc_registration()
    {
        $userData = $this->session->userdata('userData');
        
    
        
        $data['phc_name'] = $this->staff_model->fetchAllPhcName();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('staff/phc_registration', $data);            
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        } 
    }

    public function savePhcName(){
        $success_msg = "Phc Name Added Successfully";
        $phc_name = $this->input->post('phc_name');

        
        $data['PhcName'] = $phc_name;
        $data['isActive'] = '1';
            
        if(isset($data) && !empty($data)){
            $this->db->insert('tblPhcRegister', $data);
            print_r(json_encode($success_msg));
        }
        
    }

    public function getAllStaffDetails_ajax()
    {
        $staff_info = $this->staff_model->getAllStaffDetails();
        return print_r(json_encode($staff_info));
    }
    
} //class-end
?>