<html>
    <head>
 <style>
    /* #credentials_section_show{
        display: none;
    } */
 </style>
    </head>
    <body>
        <div class="container"> <h3>Create Project</h3>
        <div class="col-md-9 mx-auto">

        <?php if($this->session->flashdata('add_project_name')) { ?>
    	<?php echo '<p class="alert alert-success mt-3 text-center" id="add">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>' 
          .$this->session->flashdata('add_project_name') . '</p>'; ?>
	  	<?php } $this->session->unset_userdata('add_project_name');  //unset session ?> 
 
    <div class="card">
    <div class="card-body">
    <!-- form -->
    <form method="POST" action="SuperAdminController/saveProjectInfo">

        <!-- <//?php print_r($companyInfo); ?>   -->
        <div class="form-group">
            <label for="">Company Name</label>
            <select id="" name="company_uuid" class="form-control">
                <option selected>Choose Company Name</option>

                <?php 
               if(isset($companyInfo) && !empty($companyInfo)){
               for($i = 0 ; $i < count($companyInfo); $i++) { ?>
                <?php if(isset($companyInfo[$i]->company_uuid)){ ?>
                    <option value="<?= $companyInfo[$i]->created_by; ?>"> 
                        <?= $companyInfo[$i]->company_name; ?>
                        <?php }?>
                    </option>
                <?php }} ?>
            </select>
         </div>

         <!-- <div class="form-group">
            <label for="">Assign To Company User</label>
            <select id="" name="company_login_id" class="form-control">
                <option selected>Choose UserId Name</option>
                <//?php for($i = 0 ; $i < count($companyUserId); $i++) { ?>
                    <option value="<//?= $companyUserId[$i]->auto_loginId; ?>"> 
                        <//?= $companyUserId[$i]->userId; ?>
                    </option>
                <//?php } ?>
            </select>
         </div> -->


        <div class="form-group">
            <label for="">Project Name</label>
            <input type="text" class="form-control" id="" name="project_name" placeholder="Eg. Tika Toy">
        </div>
  <!--      
        <p>&nbsp;</p>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Create Tikka Toy</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">Create Pregnancy Toy</label>
        </div>
        <p>&nbsp;</p>
                -->
        <div class="form-group">
            <label for="">Project Location</label>
            <textarea class="form-control" name="project_location"></textarea>
        </div>

       
     
        <hr>
        <div class="alert alert-primary" role="alert">
                Create Credentials For Project Admin
            </div>
               <!------------ Project admin dropdown ------------>
 <!-- <//?php    var_dump($projectAdminByCompany[0]->staff_uuid); ?> -->
        <div class="form-group">
            <label for="">Project Admin Name</label>
                <select id="id_proj_admin_name" name="staff_uuid" class="form-control">
                    <option value='0'>Select project admin</option>
                    <?php                             
                        if(isset($projectAdminByCompany) && !empty($projectAdminByCompany)){
                            for($i = 0 ; $i < count($projectAdminByCompany); $i++) { ?>
                                
                            <option value="<?= $projectAdminByCompany[$i]->staff_uuid; ?>"> 
                                    <?= $projectAdminByCompany[$i]->login_id; ?>
                                    
                                </option>
                                <?php
                            }
                        }
                    ?>
                </select>
            <span id="err_proj_admin_name"></span>
        </div>
                            <hr>
                            
                            <button type="button" class="btn btn-primary" onclick="show_hide_projectAdmin()">Add New Project Admin</button>
                            
                            
                            
                            
      <div id="credentials_section_show">
                            <div class="form-group">
                <label for="">Project Admin Name</label>
                <input type="text" class="form-control" id="" name="project_admin_uuid" placeholder="">
            </div>

            <div class="form-group">
                <label for="">Project Admin Password</label>
                <input type="password" class="form-control" id="" name="password" placeholder="">
            </div>
     </div>
        
        <div class="col-auto float-right">
            <button type="submit" class="btn btn-primary mb-2" name="submit">Submit</button>
            </div>
</form>
  </div>
</div>
</div>

</div>
    </body>
    <script>
        var proAdminDiv = document.getElementById("credentials_section_show");
        //var dropDown = document.getElementById("id_proj_admin_name"); 

        window.onload = function() {
            proAdminDiv.style.display = 'none';
        };

 
        function show_hide_projectAdmin()
        {
            if (proAdminDiv.style.display === "none") {
                //Show
                proAdminDiv.style.display = "block";
                document.getElementById("id_proj_admin_name").disabled = true;
            } else {
                //Hide
                proAdminDiv.style.display = "none";
                document.getElementById("id_proj_admin_name").disabled = false;
            }
            Reset();
        }
        
        function Reset() {  
           var dropDown = document.getElementById("id_proj_admin_name");  
           //alert(dropDown);
            dropDown.selectedIndex = 0;  
        }  

        function create_project_validation(){
          
            //Validate compny Name
            
            var e = document.getElementById("id_comp_name");
            var err_company_name = document.getElementById('err_cmpny_name');
            var optionSelIndex = e.options[e.selectedIndex].value;
            var optionSelectedText = e.options[e.selectedIndex].text;
            if (optionSelIndex == 0) {
                document.getElementById("id_comp_name").focus();     
                err_company_name.style.color = "red";
                err_company_name.style.fontSize = "12px";
                err_company_name.innerHTML = "Please select a Company Type.";
                return false;
            }
            else{
                //alert("Success !! You have selected Category : " + optionSelectedText); ;  
                        
                err_company_name.style.color = "green"; 
                err_company_name.style.fontSize = "12px";
                err_company_name.innerHTML = "Correct";  
            }

            //Validate Project name

            var proj_name = document.getElementById('id_proj_name').value;
            var err_proj_name = document.getElementById("err_proj_name");
            var regex_proj_name = /([a-zA-Z_-]){3,15}$/g;
            if(proj_name.match(regex_proj_name  ))
            {
                err_proj_name.style.fontSize = "12px";
                err_proj_name.style.color = "green"; 
                err_proj_name.innerHTML = "Correct";                                
            }else{           
                document.getElementById("id_proj_name").focus();      
                err_proj_name.style.color = "red";
                err_proj_name.style.fontSize = "12px";                                
                err_proj_name.innerHTML = "Error msg";  
                return false;                
            }

            //validate location

            var location = document.getElementById('id_location').value;
            var err_loation = document.getElementById("err_loation");
            var regex_location = /([a-zA-Z ]){4,20}$/g;
            if(location.match(regex_location)){
                err_loation.style.fontSize = "12px";
                err_loation.style.color = "green"; 
                err_loation.innerHTML = "Correct"; 
            }
            else{
                document.getElementById("id_location").focus();      
                err_loation.style.color = "red";
                err_loation.style.fontSize = "12px";                                
                err_loation.innerHTML = "Error msg";  
                return false;            
            }
            
            //validate contact number

            var contact_no = document.getElementById('id_contact').value;
            var err_contact = document.getElementById("err_contact");
            var regex_contact = /([0-9]){8,12}$/g;
            if(contact_no.match(regex_contact)){
                err_contact.style.fontSize = "12px";
                err_contact.style.color = "green"; 
                err_contact.innerHTML = "Correct";
                alert("***************");
            }
            else{
                document.getElementById("id_contact").focus();      
                err_contact.style.color = "red";
                err_contact.style.fontSize = "12px";                               
                err_contact.innerHTML = "Error msg";  
                return false;            
            }

            //Credentials----
            //validate admin name

            var admin_name = document.getElementById('id_proj_admin_name').value;
            var err_admin_name = document.getElementById("err_admin_name");
            var regex_admin_name = /([a-zA-Z0-9-]){3,15}$/g;
            if(contact_no.match(regex_admin_name)){
                err_admin_name.style.fontSize = "12px";
                err_admin_name.style.color = "green"; 
                err_admin_name.innerHTML = "Correct"; 
            }
            else{
                document.getElementById("id_proj_admin_name").focus();      
                err_admin_name.style.color = "red";
                err_admin_name.style.fontSize = "12px";                                
                err_admin_name.innerHTML = "Error msg";  
                return false;            
            }

            //validate password

            var admin_pswd = document.getElementById('id_proj_admin_pswd').value;
            var err_admin_pswd = document.getElementById("err_admin_pswd");
            var regex_pswd = /([a-zA-Z0-9-]){3,15}$/g;
            if(contact_no.match(regex_pswd)){
                err_admin_pswd.style.fontSize = "12px";
                err_admin_pswd.style.color = "green"; 
                err_admin_pswd.innerHTML = "Correct"; 
            }
            else{
                document.getElementById("id_proj_admin_pswd").focus();      
                err_admin_pswd.style.color = "red";
                err_admin_pswd.style.fontSize = "12px";                                
                err_admin_pswd.innerHTML = "Error msg";  
                return false;            
            }
        }
    </script>
</html>