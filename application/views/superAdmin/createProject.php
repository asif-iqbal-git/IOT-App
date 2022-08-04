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

       <?php print_r($companyInfo); ?>
        <div class="form-group">
            <label for="">Company Name</label>
            <select id="" name="comp_adm_log_id" class="form-control">
                <option selected>Choose Company Name</option>

                <?php 
                if(isset($companyInfo) && !empty($companyInfo)){
                for($i = 0 ; $i < count($companyInfo); $i++) { ?>
                <!-- <//?php if(isset($companyInfo[$i]->company_Token)){ ?> -->
                    <option value="<?= $companyInfo[$i]->comp_adm_log_id; ?>"> 
                        <?= $companyInfo[$i]->company_name; ?>
                        <!-- <//?php }?> -->
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


        <div class="form-group">
            <label for="">Location</label>
            <textarea class="form-control" name="location"></textarea>
         </div>

        <div class="form-group">
            <label for="">Contact No.</label>
            <input type="text" class="form-control" id="" name="contact_no" placeholder="Eg. 9919910000">
        </div>
     
        <hr>
        <div class="alert alert-primary" role="alert">
                Create Credentials For Project Admin
            </div>
        <div class="form-group">
            <label for="">Project Admin Name</label>
            <input type="text" class="form-control" id="" name="userId" placeholder="">
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