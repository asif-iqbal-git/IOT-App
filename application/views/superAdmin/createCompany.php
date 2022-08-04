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
            <input type="text" class="form-control" id="" name="company_name" placeholder="Eg. ZMQ Development">
        </div>
        
        <div class="form-group">
            <label for="">Company Type</label>
            <select id="" name="company_type" class="form-control">
                <option selected>Choose Company Type</option>
                <option value="Public">Public</option>
                <option value="Private">Private</option>                
            </select>
         </div>


        <div class="form-group">
            <label for="">Email Address</label>
            <input type="email" class="form-control" id="" name="comapny_email" placeholder="Eg. Example@companyname.com">
        </div>


        <div class="form-group">
            <label for="">Company Location</label>
            <textarea class="form-control" name="company_location"></textarea>
         </div>

        <div class="form-group">
            <label for="">Contact Person No.</label>
            <input type="text" class="form-control" id="" name="company_contact" placeholder="Eg. 9919910000">
        </div>

            <hr>
            <div class="alert alert-primary" role="alert">
                Create Credentials For Company Admin
            </div>
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
</div>
    </body>
</html>