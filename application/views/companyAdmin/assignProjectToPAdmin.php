<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <style>
            #alert{
              display: none;
            }
        </style>
    </head>
    <body>
      <!-- <//?php var_dump($projectList);?> -->
     <h3>Assign Project To Project Admin</h3>
      <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
   
      </div>
 
     <div class="Card mb-3">
      
         <!-- <//?php echo("<pre>");print_r(($assignedProjects??"None")); ?>    -->
           
            <div class="row">
                <div class="col-md-2"><label class="control-label"></label></div>
                <div class="col-md-4">
                  <select required  id="projectAdminId" name="projectAdminId" class="form-control" >
                  <option value="" disabled="" selected=""><span>Select Project Admin</span></option>
                  <?php if(isset($projectList) && !empty($projectList)){?>
                  <?php for($i = 0; $i < count($Padminlist); $i++) {?>
                      <option value="<?= $Padminlist[$i]->staff_uuid??"No Data Found" ?>">
                      <?= $Padminlist[$i]->emp_name??"No Project Admin Found" ?></option>  
                  <?php } }?>
                  </select>
                </div>
                <div class="col-md-3">
                <button  id="assign_Project_To_PAdmin" class="btn btn-primary center-block" type="submit"><span class="">                    
                    </span>&nbsp;<strong>Assign Project</strong>
                </button> 
                </div>
            </div>      
      </div>
      <div class="col-md-9 mx-auto">
      <?php if(isset($projectList) && !empty($projectList)){?>
      
      <!-- table -->
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Project Name</th>    
      <th scope="col">Assign</th>
    </tr>
  </thead>

  <tbody>
  
    <?php for($i=0; $i < count($projectList); $i++){?>
      
    <tr>
      <th><?= $i+1; ?></th>
      <td><?= $projectList[$i]->project_name;  ?></td>
      <td>
        <input type="checkbox" class="messageCheckbox" id="<?= $projectList[$i]->project_uuid; ?>" name="project_uuid" value="<?= $projectList[$i]->project_uuid; ?>"/>
      </td>
    
    </tr>
    <?php }?>
   
    <?php }else{echo"<h3>No Project To Assign..</h3>";}?>
    </tr>
  </tbody>
</table>


<?php if(isset($assignedProjects) && !empty($assignedProjects)){?>
 
<table class="table table-bordered table-danger">
  <thead>
   
  </thead>

  <tbody>
   <!-- <//?php var_dump($assignedProjects);?>  -->
    <?php for($i=0; $i < count($assignedProjects); $i++){?>
      
    <tr>
      <th><?= $i+1 ?></th>
      <td><strong><?= $assignedProjects[$i]->project_name;  ?> </strong>
       is Assign to   <strong><?= $assignedProjects[$i]->emp_name;  ?></strong>  
      </td>
      
      <!-- &#9745; -->
        <!-- <input type="checkbox" id="<//?= $assignedProjects[$i]->project_uuid; ?>" name=" "  
        value="<//?= $assignedProjects[$i]->project_uuid;?>" Checked disabled>-->
 
       
      <td>
      <button type="button" class="btn btn-outline-danger" id="<?= $assignedProjects[$i]->project_uuid;  ?>" onclick="unassignedPAdmin(this.id)">UNASSIGNED</button>
      </td>
    </tr>
    <?php }?>
    <?php }else{echo"<h3>No Project To Unassign..</h3>";}?>
    </tr>
  </tbody>
</table>

      </div>
       
    </body>
    <script> 
       // Pass the checkbox name to the function
/*
       function getCheckedBoxes() {
  // var checkboxes = document.getElementsByName(chkboxName);
  //This will picked all checked box value in this page including default chk value
 // var checkboxes = document.querySelectorAll('input[name=mycheckboxes]:checked');
 
 var checkboxes = document.querySelector('.messageCheckbox:checked').value;
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i]);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

// Call as
var checkedBoxes = getCheckedBoxes();
*/
          // ---------------select Checkbox value---------------------
        var checkedVal={};
        var all=[];  
       
        $(document).on('change','input[type=checkbox]' ,function(){
        // checkedVal={};
        all=[];
       
        $('input[type=checkbox]:checked').each(function(){             
            //push all checked value to all(array)
            
            all.push($(this).val());   
               
        });       
        console.log("ck_val:",all);   
        });
     
       //  Sending Health-Provider-id with Assign token-id and zmq-id
        $("#assign_Project_To_PAdmin").on('click',function(){
            var projectAdmin = document.getElementById('projectAdminId').value;
                //alert(projectAdmin)
            $.ajax({
                url: "<?= base_url('StaffController/assign_Project_To_PAdmin') ?>",
                type: 'POST',
                data: {
                    projectAdmin_id:projectAdmin,
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {
                  // alert(data);  
                    document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-primary");
                    document.getElementById('alert').innerHTML = data;
                   // setTimeout(refresh, 3000);
                   console.log(data) 
                   
                 // var json = JSON.parse(data);      
                   //console.log((json.checked_id))
                }
            })
        });

        function refresh(){
          window.location.href = "<?php echo base_url('assign-project')?>";
        }

     function unassignedPAdmin(project_uuid)
     {
        $.ajax({
            url: "<?= base_url('StaffController/unAssign_Project_To_PAdmin') ?>",
            type: 'POST',
            data: {
              project_uuid:project_uuid,
                // checked_id:all
              }, success: function(data, textStatus, jqXHR) {                  
                document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-success");
                    document.getElementById('alert').innerHTML = data;
                    setTimeout(refresh, 3000);
                   console.log(data)                          
          }
            
        })
     }
    </script>
    <!-- pagination -->
    <!-- https://codepen.io/KennyGHanson/pen/xmGeqO -->
</html>