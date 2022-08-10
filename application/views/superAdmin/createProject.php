<html>
    <head>
 <style>
    #credentials_section_show{
    display:block;
}
 </style>
    </head>
    <body>
        <div class="container"> <h3>Create Project</h3>
            <div class="col-md-9 mx-auto">
            <?php
                if($this->session->flashdata('add_project_name')) {
            ?>
    	        <?php
                    echo '<p class="alert alert-success mt-3 text-center" id="add">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>' 
                    .$this->session->flashdata('add_project_name') . '</p>';
                ?>
	  	    <?php
                }
                $this->session->unset_userdata('add_project_name');  //unset session
            ?> 
                <div class="card">
                    <div class="card-body">
                    <!-- form -->
                        <form method="POST" action="SuperAdminController/saveProjectInfo">
                        <!-- <//?php print_r($companyInfo); ?> -->
                            <div class="form-group">
                                <label for="">Company Name</label>
                                    <select id="id_comp_name" name="comp_adm_log_id" class="form-control">
                                        <option value='0'>Choose Company Name</option>
                                        <?php
                                            if(isset($companyInfo) && !empty($companyInfo)){
                                                for($i = 0 ; $i < count($companyInfo); $i++) { ?>
                                                    <!-- <//?php if(isset($companyInfo[$i]->company_Token)){ ?> -->
                                                    <option value="<?= $companyInfo[$i]->comp_adm_log_id; ?>"> 
                                                        <?= $companyInfo[$i]->company_name; ?>
                                                        <!-- <//?php }?> -->
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <span id="err_cmpny_name"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Project Name</label>
                                    <input type="text" class="form-control" id="id_proj_name" name="project_name" placeholder="Eg. Tika Toy">
                                    <span id="err_proj_name"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Location</label>
                                    <textarea class="form-control" id="id_location" name="location"></textarea>
                                    <span id="err_loation"></span>
                                </div>

                            <div class="form-group">
                                <label for="">Contact No.</label>
                                    <input type="text" class="form-control" id="id_contact" name="contact_no" placeholder="Eg. 9919910000">
                                    <span id="err_contact"></span>
                            </div>
                            <hr>
                            <div class="alert alert-primary" role="alert">Create Credentials For Project Admin</div>
                            
                            <!------------ Project admin dropdown ------------>

                            <div class="form-group">
                                <label for="">Project Admin Name</label>
                                    <select id="id_proj_admin_name" name="userId" class="form-control">
                                        <option value='0'>Select project admin</option>
                                        <?php
                                            if(isset($companyInfo) && !empty($companyInfo)){
                                                for($i = 0 ; $i < count($companyInfo); $i++) { ?>
                                                    <!-- <//?php if(isset($companyInfo[$i]->company_Token)){ ?> -->
                                                    <option value="<?= $companyInfo[$i]->comp_adm_log_id; ?>"> 
                                                        <?= $companyInfo[$i]->company_name; ?>
                                                        <!-- <//?php }?> -->
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <span id="err_proj_admin_name"></span>
                            </div>
                            <hr>
                        <div id="credentials_section_show">
                            <div class="form-group">
                                <label for="">Project Admin Name</label>
                                    <input type="text" class="form-control" id="id_proj_admin_name" name="userId" placeholder="">
                                    <span id="err_admin_name"></span>
                                </div>

                            <div class="form-group">
                                <label for="">Project Admin Password</label>
                                    <input type="password" class="form-control" id="id_proj_admin_pswd" name="password" placeholder="">
                                    <span id="err_admin_pswd"></span>
                            </div>
                        </div>
                            <div class="col-auto float-right">
                                <button type="submit" class="btn btn-primary mb-2" name="submit" onclick="return create_project_validation();">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <script>
        // 
        var elem = document.getElementById("id_proj_admin_name");
        alert(elem);
        elem.onchange = function(){
            var hiddenDiv = document.getElementById("credentials_section_show");
            hiddenDiv.style.display = (this.value == "") ? "block":"none";
        };


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