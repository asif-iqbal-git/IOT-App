<html>
    <head>
    </head>
    <body>
        <div class="container">
        <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Company Setup</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Company</li>
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
    <form method="POST" action="SuperAdminController/saveCompanyInfo">
    <i class="bi bi-align-bottom"></i>
        <div class="form-group">
            <label for="">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Eg. ZMQ Development">
            <div id="err_company_name"></div>
        </div>
        
        <div class="form-group">
            <label for="">Company Type</label>
            <select id="company_type" name="company_type" class="form-control">
                <option value="0">Choose Company Type</option>
                <option value="Public">Public</option>
                <option value="Private">Private</option>                
            </select>
            <div id="err_company_type"></div>
         </div>


        <div class="form-group">
            <label for="">Email Address</label>
            <input type="email" class="form-control" id="company_email" name="comapny_email" placeholder="Eg. Example@companyname.com">
            <div id="err_email_addres"></div>
        </div>


        <div class="form-group">
            <label for="">Company Location</label>
            <textarea class="form-control" id="company_location" name="company_location"></textarea>
            <div id="err_company_location"></div>
         </div>

        <div class="form-group">
            <label for="">Contact Person No.</label>
            <input type="text" class="form-control" id="company_contact" name="company_contact" placeholder="Eg. 9919910000">
            <div id="err_contact_number"></div>
        </div>

            <hr>
            <div class="alert alert-primary" role="alert">
                Create Credentials For Company Admin
            </div>
        <div class="form-group">
            <label for="">Company Admin Name</label>
            <input type="text" class="form-control" id="companyAdmin" name="userId" placeholder="">
            <div id="err_companyAdmin"></div>
        </div>

        <div class="form-group">
            <label for="">Company Admin Password</label>
            <input type="password" class="form-control" id="companyPassword" name="password" placeholder="">
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
        function formValidation()
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
            var regex_company_location = /([a-zA-Z0-9_-]){10,45}$/g;

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