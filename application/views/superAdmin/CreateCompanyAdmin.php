<html>
    <head>
        <h3 style="padding-left:20px">Create Credentials For Company Admin</h3>
        
    <body>
   
      
        <div class="col-md-9 mx-auto">
        <?php if($this->session->flashdata('add_project_admin')) { ?>
    	<?php echo '<p class="alert alert-success mt-3 text-center" id="add">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>' 
          .$this->session->flashdata('add_project_admin') . '</p>'; ?>
	  	<?php } $this->session->unset_userdata('add_project_admin');  //unset session ?> 


    <div class="card">
  <div class="card-body">
    <!-- form -->
    <form method="POST" action="SuperAdminController/saveProjectAdminInfo">
        <div class="form-group">
            <label for="">Company Admin Name</label>
            <input type="text" class="form-control" id="" name="userId" placeholder="">
        </div>

        <div class="form-group">
            <label for="">Company Admin Password</label>
            <input type="password" class="form-control" id="" name="password" placeholder="">
        </div>
        <div class="col-auto float-right">
            <button type="submit" class="btn btn-primary mb-2" name="submit">Submit</button>
        </div>
</form>
  </div>
</div>
</div>
    </body>
</html>