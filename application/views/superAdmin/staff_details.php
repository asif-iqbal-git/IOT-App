<!DOCTYPE html>
<html lang="en">
    <h3>Staff Details List</h3>
    <!-- <pre><//?php var_dump($staff)?></pre> -->
    
    <!-- <link href="<//?= base_url('assets/Admin_assets/css/bootstrap_for_table.css'); ?>" -->
    <!-- rel="stylesheet"> -->
 
    <div class="container">
        <table id="example" class="table table-sm table-responsive table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                   <th>S.No</th>
                    <th>Login_ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Level</th>
                    <th>Desig_ID</th>
                    <th>isActive</th>
                    <th>Created_By</th>
                    <th>Created_At</th>
                    <th>Update Info</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
         //   var_dump(($staff[0]->staff_uuid));die();
          $count = 1;
             foreach($staff as $row){

          //   for(var $i=0; $i < count($staff); $i++ ) {  
                echo "<tr>";
                echo "<td>".$count."</td>";
                echo "<td>".$row->login_id."</td>";
                echo "<td>".$row->emp_name."</td>";
                echo "<td>".$row->emp_age."</td>";
                echo "<td>".$row->emp_phone."</td>";
                echo "<td>".$row->emp_email."</td>";
                echo "<td>".$row->emp_address."</td>";
                echo "<td>".$row->level."</td>";
                echo "<td>".$row->designation_id."</td>";
                echo "<td>".$row->isActive."</td>";
                echo "<td>".$row->created_by."</td>";
                echo "<td>".$row->created_datetime."</td>";
                echo "<td>"."<input type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModal' id='$row->login_id' value='Update' onclick='update_details(this.id);'>"."</td>";                        
                echo "</tr>"; 
                $count++;
        }
      
            ?>
            </tbody>
        </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Staff Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

       <!-- Start From to update staff details -->
       <?php 
            //  var_dump(($staff[0]->login_id)); 
          //  foreach($staff as $row){
          //  var_dump($staff);
                for ($i = 0 ; $i < count($staff); $i++) {  
         
          ?>
        <!-- <form id="updateFormId" method="post" action="<//?php echo base_url('update_staff');?>" enctype="multipart/form-data"> -->
       
        <form id="updateFormId" method="post" action=" " enctype="multipart/form-data">
       
          <div class="form-group row">
            <label for="login_id" class="col-sm-2 col-form-label">Login_ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="login_id" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
        <div class="form-group row">
            <label for="emp_name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="emp_name" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="emp_age" class="col-sm-2 col-form-label">Age</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="emp_age" 
             value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="emp_phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="emp_phone" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="emp_email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="emp_email" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="emp_address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="emp_address" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="level" class="col-sm-2 col-form-label">Level</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="level" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="desig_id" class="col-sm-2 col-form-label">Desig_ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="desig_id" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="isActive" class="col-sm-2 col-form-label">isActive</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="isActive" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="created_by" class="col-sm-2 col-form-label">Created_By</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="created_by" 
             value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="created_at" class="col-sm-2 col-form-label">Created_At</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="created_at" 
              value="<?php echo  $staff[$i]->login_id ?>">
            </div>
          </div>
          
        

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="button" class="btn btn-success" value="Submit" onclick="submitForm();"/>
          </div>
        </form>
        
        <?php }  ?>
      </div>
    </div>
  </div>
</div>

<script> 

 
 

  //load bootstrap table
  $(document).ready(function () {
    $('#example').DataTable();
  });


  // Model script
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })
  
  function update_details(staff_login_id){
    //after update button click, it will send single staff id to controller,and controller will return all information about staff according to id, that will edit 
    
    //without ajax
    //alert(staff_login_id);

   
 $.ajax({
         async: false,
         url: "<?= base_url('StaffController/updateStaffInfo') ?>",
         type: 'POST',
         data: {id: staff_login_id},
          
         success: function(data, textStatus, jqXHR) {
            // alert(data);     //data return false if no data
             var json_data = $.parseJSON(data);
             
             console.log(json_data);
             
         },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
         },
         
     });        
}
</script>

</html>