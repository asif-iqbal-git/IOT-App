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
            #dropdown{
                padding-left:20%;
            }
        </style>
    </head>
    <body>
      <!-- </?php var_dump(count((is_countable($projectList)?$projectList:[])));?> -->
       <!-- <//?php var_dump($projectList);?> -->

    <p id="heading">Assign PHC To Project</p>

      <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
     
    
     <div class="Card mb-3">
   
         <!-- <//?php echo("<pre>");print_r(($assignedProjects??"None")); ?>    -->
           <!-- </?php var_dump($phc_list); ?> -->
           <div id="dropdown">
            <div class="row">
               
                <div class="col-md-6">
                  <select required  id="projectAdminId" name="projectAdminId" class="form-control" >
                  <option value="" disabled="" selected=""><span>Select PHC</span></option>
                  <?php if(isset($projectList) && !empty($projectList)){?>
                  <?php for($i = 0; $i < count($phc_list); $i++) {?>
                      <option value="<?= $phc_list[$i]->PhcId??"No Data Found" ?>">
                      <?= $phc_list[$i]->PhcName??"No Project Admin Found" ?></option>  
                  <?php } }?>
                  </select>
                </div>
              
                
                <div class="col-md-3">
                <button  id="assign_Project_To_PAdmin" class="btn btn-primary center-block" type="submit"><span class="">                    
                    </span>&nbsp;<strong>Assign PHC</strong>
                </button> 
                </div>
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
       // console.log("ck_val:",all);   
        });
     
       //  Assign Project to Project Admin
        $("#assign_Project_To_PAdmin").on('click',function(){
          //get dropdown value
            var projectAdminId = document.getElementById('projectAdminId').value;
     
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
         
                             
                 
                }
            })
            
        });

       
        function refresh(){
          window.location.href = "<?php echo base_url('deassign-project')?>";
        }
 
     
    </script>
    <!-- pagination -->
    <!-- https://codepen.io/KennyGHanson/pen/xmGeqO -->
</html>