<?php

class StaffController extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');

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
        $updated_data['isActive'] = $this->input->post('isActive');
        $updated_data['created_by'] = $this->input->post('created_by');
        $updated_data['created_datetime'] = $this->input->post('created_at');

        $this->loginmodel->save_updated_staff_info($updated_data, $emp_uuid);

        redirect('staff_details');

    }
    public function updateStaffInfo()
    {    
         $id = $this->input->post('staff_uuid');
         $val= "hy";
         echo json_encode($val);
    }
   /* public function get_single_emp_id(){

        $id = $this->input->post('staff_uuid');

        $this->loginmodel->get_staff_info_using_id($id);

        echo json_encode();

    }*/

}

?>