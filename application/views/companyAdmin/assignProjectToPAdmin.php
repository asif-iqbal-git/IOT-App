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
            
        </style>
    </head>
    <body>
     <h3>Assign Project To Project Admin</h3>
     <div class="Card mb-3">
            <?php var_dump($projectList); ?>
            <div class="row">
                <div class="col-md-2"><label class="control-label"></label></div>
                <div class="col-md-4">
                  <select required  id="projectAdminId" name="projectAdminId" class="form-control" >
                  <option value="" disabled="" selected=""><span>Select Project Admin</span></option>
                  <?php for($i = 0; $i < count($Padminlist); $i++) {?>
                      <option value="<?= $Padminlist[$i]->staff_uuid ?>">
                      <?= $Padminlist[$i]->emp_name ?></option>  
                  <?php } ?>
                  </select>
                </div>
                <div class="col-md-3">
                <button  id="assign_Project_To_PAdmin" class="btn btn-primary center-block" type="submit"><span class=""  >                    
                    </span>&nbsp;<strong>Assign Project</strong>
                </button> 
                </div>
            </div>      
      </div>
      <div class="col-md-9 mx-auto">
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
      <th><?= $i+1 ?></th>
      <td><?= $projectList[$i]->project_name;  ?></td>
      <td>
        <input type="checkbox" id="<?= $projectList[$i]->project_uuid; ?>" name=" " 
        value="<?= $projectList[$i]->project_uuid; ?>"/>
 
      </td>
    
    </tr>
    <?php }?>
   
      
    </tr>
  </tbody>
</table>
      </div>
       
    </body>
    <script>
        /* TODO:
            1. Get PAdmin from DD.
            2. 
        */
          // ---------------select Checkbox value---------------------
          var checkedVal={};
          var all=[];  
          
          
          $(document).on('change','input[type=checkbox]' ,function(){
       // checkedVal={};
        all=[];

        $('input[type=checkbox]:checked').each(function(){             
            // set-1  to assign toys and remove from list
           // checkedVal[$(this).val()] = 1;
            
           //push all checked value 
            all.push($(this).val());  
             
        });       
            //console.log(all);
        // alert(all);
        });
        
       //  Sending Health-Provider-id with Assign token-id and zmq-id
    $("#assign_Project_To_PAdmin").on('click',function(){
        var projectAdmin = document.getElementById('projectAdminId').value;
            
            alert(projectAdmin)
    $.ajax({
            url: "<?= base_url('StaffController/assign_Project_To_PAdmin') ?>",
            type: 'POST',
            data: {
                projectAdmin_id:projectAdmin,
                checked_id:all
            },
            success: function(data, textStatus, jqXHR) {
               alert(data);                
            }
        })
    });
    </script>
    
</html>