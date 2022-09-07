<html>
    <head>
    </head>
    <body>
        <div class="container">
        <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Staff Setup</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Staff</li>
    </ol>
    </nav>
        <div class="col-md-9 mx-auto">

        <?php if($this->session->flashdata('add_company_admin')) { ?>
    	<?php echo '<p class="alert alert-success mt-3 text-center" id="add">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>' 
          .$this->session->flashdata('add_company_admin') . '</p>'; ?>
	  	<?php } $this->session->unset_userdata('add_company_admin');  //unset session ?> 

    <div class="card">
  <div class="card-body">
    <!-- form -->
    <form method="POST" action="StaffController/saveStaffInfo">
    <i class="bi bi-align-bottom"></i>
        <div class="form-group">
            <label for="">Staff Name</label>
            <input type="text" class="form-control" id="staff_name" name="staff_name" placeholder="Eg. Mitlesh Kumar">
            <div id="err_company_name"></div>
        </div>

        <div class="form-group">
            <label for="">Staff Age</label>
            <input type="text" class="form-control" id="staff_age" name="staff_age" placeholder="Eg. 24">
            <div id="err_company_name"></div>
        </div>
        
        <label for="">Staff Gender</label><br/>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="staff_gender" id="inlineRadio1" value="0" checked>
        <label class="form-check-label" for="inlineRadio1">Male</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="staff_gender" id="inlineRadio2" value="1">
        <label class="form-check-label" for="inlineRadio2">Female</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="staff_gender" id="inlineRadio3" value="2">
        <label class="form-check-label" for="inlineRadio3">Other</label>
        </div>
        <div>&nbsp;</div>

        <div class="form-group">
            <label for="">Staff PhoneNo</label>
            <input type="text" class="form-control" id="staff_phone" name="staff_phone" placeholder="Eg. 9188776655">
            <div id="err_company_name"></div>
        </div>

        <div class="form-group">
            <label for="">Staff Email </label>
            <input type="email" class="form-control" id="staff_email" name="staff_email"  placeholder="Eg. Example@companyname.com">
            <div id="err_email_addres"></div>
        </div>

        <div class="form-group">
            <label for="">Staff Address</label>
            <textarea class="form-control" id="staff_address" name="staff_address"></textarea>
            <div id="err_company_location"></div>
         </div>
         <!-- <//?php var_dump($staff_designation[0]);?>   -->
        <div class="form-group">
            <label for="">Staff Designation</label>
            <select id="company_type" name="staff_designation" class="form-control">
            <option value="0">Choose Staff Designation</option>
            <?php  for($i = 0; $i < count($staff_designation); $i++){ ?>  
            
                <option value="<?php echo($staff_designation[$i]->designation_id); ?>"><?php echo($staff_designation[$i]->designation_name); ?>
                </option>
                 
                <?php } ?>
            </select>
            <div id="err_company_type"></div>
         </div>


    


      

            <hr>
            <div class="alert alert-primary" role="alert">
                Create Credentials For Staff
            </div>
        <div class="form-group">
            <label for="">Staff UserId</label>
            <input type="text" class="form-control" id="staff_login_id" name="staff_login_id" placeholder="">
            <div id="err_companyAdmin"></div>
        </div>

        <div class="form-group">
            <label for="">Staff Password</label>
            <!-- <input type="text" class="form-control" id="companyPassword" name="password" placeholder="" value="<//?php echo($virtualPassword); ?>" readonly> --><input type="password" class="form-control" id="staff_password" name="staff_password" placeholder="">
            <div id="err_company_password"></div>
        </div>

        <div class="col-auto float-right">
            <button type="submit" class="btn btn-primary mb-2" name="submit" onclick="return formValidation();">Submit</button>
        </div>
</form>
  </div>
</div>
</div>
</div>
    </body>
    <script>
        
        function __formValidation()
        {
            var company_name = document.getElementById("company_name").value;
            var err_company_name = document.getElementById("err_company_name");
            var regex_company_name = /([a-zA-Z_-]){3,15}$/g;
           
            if(company_name.match(regex_company_name))
            {
                err_company_name.style.fontSize = "12px";
                err_company_name.style.color = "green"; 
                err_company_name.innerHTML = "Correct";                                
            }else{           
                document.getElementById("company_name").focus();      
                err_company_name.style.color = "red";
                err_company_name.style.fontSize = "12px";                                
                err_company_name.innerHTML = "Error msg";  
                return false;                
            }
            
            // Dropdown validations
            
            var e = document.getElementById("company_type");
            var err_company_type = document.getElementById('err_company_type');
           
            var optionSelIndex = e.options[e.selectedIndex].value;
            var optionSelectedText = e.options[e.selectedIndex].text;
           
            if (optionSelIndex == 0) {
                document.getElementById("company_type").focus();     
                  err_company_type.style.color = "red";
                  err_company_type.style.fontSize = "12px";
                  err_company_type.innerHTML = "Please select a Company Type.";
                return false;
            } else {
                //alert("Success !! You have selected Category : " + optionSelectedText); ;  
                        
                err_company_type.style.color = "green"; 
                err_company_type.style.fontSize = "12px";
                err_company_type.innerHTML = "Correct";  
                    
            }

            //Email Address
            var company_email = document.getElementById('company_email').value;
            var err_email_addres = document.getElementById("err_email_addres");
            var regex_company_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            
            if(company_email.match(regex_company_email))
            {
                
                err_email_addres.style.fontSize = "12px";
                err_email_addres.style.color = "green"; 
                err_email_addres.innerHTML = "Correct";    
                                       
            }else{
                document.getElementById("company_email").focus(); 
                err_email_addres.style.fontSize = "12px";                      
                err_email_addres.style.color = "red";
                err_email_addres.innerHTML = "Error msg";  
                return false;                
            }


            //Company Location
            var company_location = document.getElementById('company_location').value;
            var err_company_location = document.getElementById('err_company_location');
            var regex_company_location = /([a-zA-Z0-9 _-]){4,45}$/;

            if(company_location.match(regex_company_location))
            {
                 
                err_company_location.style.fontSize = "12px";
                err_company_location.style.color = "green"; 
                err_company_location.innerHTML = "Correct";    
                  
            }else{
                document.getElementById("company_location").focus();     
                err_company_location.style.fontSize = "12px";                      
                err_company_location.style.color = "red";
                err_company_location.innerHTML = "Error msg";  
                return false;                
            }
            
            //Contact person number
            var company_contact = document.getElementById('company_contact').value;
            var err_contact_number = document.getElementById('err_contact_number');
            var regex_contact_number = /([0-9-+]){10,14}$/g;

            if(company_contact.match(regex_contact_number))
            {              
                err_contact_number.style.fontSize = "12px";
                err_contact_number.style.color = "green"; 
                err_contact_number.innerHTML = "Correct";    
                   
            }else{            
                document.getElementById("company_contact").focus();        
                err_contact_number.style.fontSize = "12px";                      
                err_contact_number.style.color = "red";
                err_contact_number.innerHTML = "Error msg";  
                return false;                
            }


            // Credentials

            //Company admin name
            var companyAdmin = document.getElementById('companyAdmin').value;
            var err_companyAdmin = document.getElementById('err_companyAdmin');
            var regex_companyAdmin = /([a-zA-Z0-9-+]){3,15}$/g;

            if(companyAdmin.match(regex_companyAdmin))
            {              
                err_companyAdmin.style.fontSize = "12px";
                err_companyAdmin.style.color = "green"; 
                err_companyAdmin.innerHTML = "Correct";    
                
            }else{                 
                document.getElementById('companyAdmin').focus();
                err_companyAdmin.style.fontSize = "12px";                      
                err_companyAdmin.style.color = "red";
                err_companyAdmin.innerHTML = "Error msg";  
                return false;                
            }
            
            //company admin password
            var companyPassword = document.getElementById('companyPassword').value;
            var err_company_password = document.getElementById('err_company_password');
            var regex_companyPassword = /([a-zA-Z0-9-]){3,15}$/g;

            if(companyPassword.match(regex_companyPassword))
            {              
                err_company_password.style.fontSize = "12px";
                err_company_password.style.color = "green"; 
                err_company_password.innerHTML = "Correct";                   
            }else{                 
                document.getElementById('companyPassword').focus();
                err_company_password.style.fontSize = "12px";                      
                err_company_password.style.color = "red";
                err_company_password.innerHTML = "Error msg";  
                return false;                
            }
        }
    </script>
</html>