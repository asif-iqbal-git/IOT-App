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
                padding: 0 0 0 10%;
                font-size: 25px;
            }
        </style>
    </head>
    <body>
      <!-- </?php var_dump(count((is_countable($projectList)?$projectList:[])));?> -->
       <!-- <//?php var_dump($projectList);?> -->

    <p id="heading">Deassign Project From Project Admin</p>
    <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
    <div class="col-md-10 mx-auto">
        <div id='showProjectList'>  </div>          
                   

<?php if(isset($assignedProjects) && !empty($assignedProjects)){?>
 
<table class="table table-bordered table-danger">
<thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Project Name - Staff Name</th>    
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>
    <!-- <//?php var_dump($assignedProjects);?>   -->
      <?php for($i=0; $i < count($assignedProjects); $i++){?>  
      
    <tr>
      <th><?= $i+1 ?></th>
      <td><strong><?= $assignedProjects[$i]->project_name;  ?> </strong>
       is Assign to   <strong><?= $assignedProjects[$i]->emp_name;  ?></strong>  
      </td>
       
      <td>
      <button type="button" class="btn btn-outline-danger" 
      id="<?= $assignedProjects[$i]->project_uuid?>, <?= $assignedProjects[$i]->project_admin_uuid?>" onclick="unassignedPAdmin(this.id)">Deassign</button>
      </td>
    </tr>
      <?php }?>   
    <?php }else{ echo"<h3>No Project To Deassign..</h3>";} ?>
    </tr>
  </tbody>
</table>

      </div>
       
    </body>
    <script> 
       
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
     
        
        function refresh(){
          window.location.href = "<?php echo base_url('assign-project')?>";
        }

     function unassignedPAdmin(project_uuid_proAdminId)
     {
       var project_uuid = project_uuid_proAdminId.split(',')[0];
       var projectAdminId = project_uuid_proAdminId.split(',')[1];
     // alert(project_uuid);
        $.ajax({
            url: "<?= base_url('StaffController/unAssign_Project_To_PAdmin') ?>",
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

    //  const element = document.getElementById("projectAdminId");
    //  element.addEventListener("onchange", function(){
    //  alert('Sending');
    //  });
     
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