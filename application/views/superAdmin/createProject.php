<html>
    <head>
 
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
            <label for="">Location</label>
            <textarea class="form-control" name="project_location"></textarea>
        </div>

       
     
        <hr>
        <div class="alert alert-primary" role="alert">
                Create Credentials For Project Admin
            </div>
               <!------------ Project admin dropdown ------------>
 
               <div class="form-group">
                                <label for="">Project Admin Name</label>
                                    <select id="id_proj_admin_name" name="project_admin_uuid" class="form-control">
                                        <option value='0'>Select project admin</option>
                                        <?php
                                            if(isset($projectAdminByCompany) && !empty($projectAdminByCompany)){
                                                for($i = 0 ; $i < count($projectAdminByCompany); $i++) { ?>
                                                    <!-- <//?php if(isset($companyInfo[$i]->company_Token)){ ?> -->
                                                    <option value="<?= $projectAdminByCompany[$i]->staff_uuid; ?>"> 
                                                        <?= $projectAdminByCompany[$i]->login_id; ?>
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
        <div class="form-group">
            <label for="">Project Admin Name</label>
            <input type="text" class="form-control" id="" name="project_admin_uuid" placeholder="">
        </div>

        <div class="form-group">
            <label for="">Project Admin Password</label>
            <input type="password" class="form-control" id="" name="password" placeholder="">
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
         
    </script>
</html>