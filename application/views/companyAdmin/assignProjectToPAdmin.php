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
            #user_msg{
              font-size:1.5rem;
              padding: 1% 0 0 14%;
            }
            #heading{
              text-align: center;
                font-size: 25px;
            }
        </style>
    </head>
    <body>
      <!-- </?php var_dump(count((is_countable($projectList)?$projectList:[])));?> -->
       <!-- <//?php var_dump($projectList);?> -->

    <p id="heading">Assign Project To Staff</p>

      <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
     
    
     <div class="Card mb-3">
   
         <!-- <//?php echo("<pre>");print_r(($assignedProjects??"None")); ?>    -->
           <!-- <//?php var_dump($projectList); ?> -->
            <div class="row">
               
                <div class="col-md-3 ml-3">
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
                  <select required  id="PHCHeadId" name="PHCHeadId" class="form-control" >
                  <option value="" disabled="" selected=""><span>Select PHC Head</span></option>
                  <?php if(isset($projectList) && !empty($projectList)){?>
                  <?php for($i = 0; $i < count($PHCHeadList); $i++) {?>
                      <option value="<?= $PHCHeadList[$i]->staff_uuid??"No Data Found" ?>">
                      <?= $PHCHeadList[$i]->emp_name??"No PHC Head Found" ?></option>  
                  <?php } }?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select required  id="fieldWorkerId" name="fieldWorkerId" class="form-control" >
                  <option value="" disabled="" selected=""><span>Select Field Worker</span></option>
                  <?php if(isset($projectList) && !empty($projectList)){?>
                  <?php for($i = 0; $i < count($FieldWorkerList); $i++) {?>
                      <option value="<?= $FieldWorkerList[$i]->staff_uuid??"No Data Found" ?>">
                      <?= $FieldWorkerList[$i]->emp_name??"No Field Worker  Found" ?></option>  
                  <?php } }?>
                  </select>
                </div>
                <div class="col-md-2">
                <button  id="assign_Project_To_PAdmin" class="btn btn-primary center-block" type="submit"><span class="">                    
                    </span>&nbsp;<strong>Assign Project</strong>
                </button> 
                </div>
            </div>      
      </div>
      <?php  
      // var_dump(count($projectList));
     if($projectList != NULL || count($projectList)==0){
      
      if(count((is_countable($projectList)?$projectList:[])) == 0) { ?>
          <p id="user_msg">No Project Found, First <a href="<?= base_url('createProject'); ?>">Add Project</a></p>
         </div>  
         <?php }
        }?>
      <?php if(count(array($Padminlist)) == 0) { ?>
          <p id="user_msg">No Project Admin Found, First <a href="<?= base_url('addStaff'); ?>">Add Project Admin</a></p>
         </div>  
         <?php }?>
      <div class="col-md-9 mx-auto">
        <div id='showProjectList'></div>
     
    
         <?php if(isset($projectList) && !empty($projectList)){?> 
      
      
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Project Name</th>    
      <th scope="col">Assign</th>
    </tr>
  </thead>

  <tbody>
   <!-- </?php var_dump($projectList);?>  -->
    <?php for($i=0; $i < count((is_countable($projectList)?$projectList:[])); $i++){?>
      
    <tr>
      <th><?= $i+1; ?></th>
      <td><?= $projectList[$i]->project_name;  ?></td>
      <td>
        <input type="checkbox" class="messageCheckbox" id="<?= $projectList[$i]->project_uuid;?>" name="project_uuid" value="<?= $projectList[$i]->project_uuid; ?>" />
      </td>
    
    </tr>
    <?php }?>
   
    <?php }//else{echo"<h3>No Project To Assign..</h3>";}?>
  
    </tr>
  </tbody>
</table>



<!--
<//?php if(isset($assignedProjects) && !empty($assignedProjects)){?> 
<table class="table table-bordered table-danger">
  <tbody><//?php for($i=0; $i < count($assignedProjects); $i++){?>        
    <tr>
      <th><//?= $i+1 ?></th>
      <td><strong><//?= $assignedProjects[$i]->project_name;  ?> </strong>
       is Assign to   <strong><//?= $assignedProjects[$i]->emp_name;  ?></strong>  
      </td><td>
      <button type="button" class="btn btn-outline-danger" 
      id="<//?= $assignedProjects[$i]->project_uuid?>, <//?= $assignedProjects[$i]->project_admin_uuid?>" onclick="unassignedPAdmin(this.id)">UNASSIGNED</button>
      </td>
    </tr>
      <//?php }?>   
    <//?php }//else{ echo"<h3>No Project To Unassign..</h3>";} ?>
    </tr>
  </tbody>
</table>
!-->

</div>
       
    </body>
    <script> 
       
      function currentId(id){
       // alert(id);
        let valArr = [];
       // valArr.forEach(currentId(id));
        valArr.push(id);
        console.log(valArr)
      }
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
       // console.log("ck_val:",all);   
        });
     
       //  Assign Project to Project Admin
        $("#assign_Project_To_PAdmin").on('click',function(){
          //get dropdown value
            var projectAdminId = document.getElementById('projectAdminId').value;
            var phcHeadId = document.getElementById('PHCHeadId').value;
            var fieldWorkerId = document.getElementById('fieldWorkerId').value;
                      
            var staff_uuid = [];
            
            if(projectAdminId!=""){
              staff_uuid.push(projectAdminId);
            }
            if(phcHeadId!=""){
              staff_uuid.push(phcHeadId);
            }
            if(fieldWorkerId!=""){
              staff_uuid.push(fieldWorkerId);
            }
          
            // console.log(projectAdminId+","+phcHeadId+","+fieldWorkerId);
            console.log(staff_uuid);
             console.log("ck_val:",all);   
            $.ajax({
                url: "<?= base_url('StaffController/assign_Project_To_PAdmin') ?>",
                type: 'POST',
                data: {
                    projectAdmin_id:staff_uuid,                     
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {                 
                    document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-primary");
                    document.getElementById('alert').innerHTML = data;
                // alert(data);  
                if(data = "Please Select Project-Admin or Phc-staff or Field-Worker Or Project, First"){
                  
                 // setTimeout(same_page_refresh, 3000);
                }else{
                 // setTimeout(refresh, 3000);
                }
  
                             
                  // var json = JSON.parse(data);      
                  //  console.log((json.checked_id))

                  //Also Show Unassigned Projects in table format
                }
            })
            
        });

        function same_page_refresh(){
          window.location.href = "<?php echo base_url('assign-project')?>";
        }

        function refresh(){
          window.location.href = "<?php echo base_url('deassign-project')?>";
        }
/*
     function unassignedPAdmin(project_uuid_proAdminId)
     {
       var project_uuid = project_uuid_proAdminId.split(',')[0];
       var projectAdminId = project_uuid_proAdminId.split(',')[1];
     // alert(project_uuid);
        $.ajax({
            url: "<//?= base_url('StaffController/unAssign_Project_To_PAdmin') ?>",
            type: 'POST',
            data: {
              project_uuid:project_uuid,
              projectAdminId:projectAdminId
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
*/
     const element = document.getElementById("projectAdminId");
     element.addEventListener("onchange", function(){
     alert('Sending');
     });
     
     function show(projectAdmin){
      
      $.ajax({
                url: "<?= base_url('StaffController/assign_Project_To_PAdmin_Ajax') ?>",
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
                   
                 var jsonData = JSON.parse(data);      
                   console.log((jsonData[0].project_name))
                   let  htmlTemp= "";
                    htmlTemp += `<table class='table table-bordered'> <thead><tr>`;
                    htmlTemp += `<th scope="col">Sr. No</th>`;
                    htmlTemp += `<th scope="col">Project Name</th>`;
                    htmlTemp += `<th scope="col">Assign</th> </tr> </thead>`;
                   for (var i = 0; i < jsonData.length; i++){
                   
                    htmlTemp += `<tbody>  <tr>`;
                    htmlTemp += `<th scope="row">${i+1}</th>`;
                    htmlTemp += `<th scope="row">${jsonData[i].project_name}</th>`;
                    htmlTemp += `<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="${jsonData[i].project_uuid}" id="project_id"></th></tr>`;
                   
                   }
                   htmlTemp += `</tbody></table>`;
                   document.getElementById('showProjectList').innerHTML = htmlTemp;
                   project_id = document.getElementById('project_id').value;
                   //alert(project_id);
                }

            })
     }
    </script>
    <!-- pagination -->
    <!-- https://codepen.io/KennyGHanson/pen/xmGeqO -->
</html>