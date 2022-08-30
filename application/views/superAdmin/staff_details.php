<!DOCTYPE html>
<html lang="en">
    <h3>Staff Details List</h3>
    <!-- <pre><//?php var_dump($staff);?></pre> -->
    <link href="<?= base_url('assets/Admin_assets/css/bootstrap_for_table.css'); ?>"
    rel="stylesheet">
    <div class="container">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Sr.No.</th>
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

                    $i = 1;
                    foreach($staff as $row){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
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
            
                        echo "<td>"."<input type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModal' value='Update' onclick='update_details(".'`'.json_encode($row).'`'."); '>"."</td>";                        
                        echo "</tr>";

                        $i++;

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
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <!-- Start From to update staff details-->
       <form>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" value="<?php foreach($staff as $key){ echo $key->emp_name; }?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Age</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->emp_age; }?>" id="inputPassword3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  value="<?php foreach($staff as $key){ echo $key->emp_phone; }?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->emp_email; }?>" id="inputPassword3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->emp_address; }?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Level</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->level; }?>" id="inputPassword3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Desig_ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->designation_id; }?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">isActive</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->isActive; }?>" id="inputPassword3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Created_By</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->created_by; }?>" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Created_At</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php foreach($staff as $key){ echo $key->created_datetime; }?>" id="inputPassword3">
    </div>
  </div>
 
  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>  $this->load->view('superAdmin/staff_details', $data);
        $(document).ready(function () {
            $('#example').DataTable();
        });


        // Model script
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    </script>
</html>