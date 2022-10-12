<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
          #alert{
              display: none;
            }
    </style>
</head>
<body>
    <h2>Assign Toys to PHC Center</h2>
    <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
    <!-- PHC Center List -->
      <div class="Card mb-3">
      
      <!-- <//?php echo("<pre>");print_r(($toy_list??"None")); ?>    -->
        
         <div class="row">
             <div class="col-md-2"><label class="control-label"></label></div>
             <div class="col-md-4">
               <select required  id="phcCenterId" name="phcCenterId" class="form-control" >
               <option value="" disabled="" selected=""><span>Select PHC Center</span></option>
               <?php if(isset($phc_list) && !empty($phc_list)){?>
               <?php for($i = 0; $i < count($phc_list); $i++) {?>
                   <option value="<?= $phc_list[$i]->PhcId??"No Data Found" ?>">
                   <?= $phc_list[$i]->PhcName??"No Project Admin Found" ?></option>  
               <?php } }?>
               </select>
             </div>
             <div class="col-md-3">
             <button  id="assign_toyid_to_phc_center" class="btn btn-primary center-block" type="submit"><span class="">                    
                 </span>&nbsp;<strong>Assign Toy</strong>
             </button> 
             </div>
         </div>      
   </div>

   <!-- Toy  Table -->
   <div class="col-md-9 mx-auto">
      <?php if(isset($toy_list) && !empty($toy_list)){?>
      
      <!-- table -->
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Toys ZMQ Id</th>    
      <th scope="col">Assign</th>
    </tr>
  </thead>

  <tbody>
  
    <?php for($i=0; $i < count($toy_list); $i++){?>
      
    <tr>
      <th><?= $i+1 ?></th>
      <td><?= $toy_list[$i]->ToyName;  ?></td>
      <td>
     
        <input type="checkbox" class="messageCheckbox" id="<?= $toy_list[$i]->ToyId; ?>" name="project_uuid" 
        value="<?= $toy_list[$i]->ToyId; ?>"/>
 
      </td>
    
    </tr>
    <?php }?>
   
    <?php }else{echo"<h3>No Toys To Assign..</h3>";}?>
    </tr>
  </tbody>
</table>


<?php if(isset($assignedProjects) && !empty($assignedProjects)){?>
 
<table class="table table-bordered table-danger">
  <thead>
   
  </thead>

  <tbody>
  <!-- <//?php var_dump($assignedProjects);?> -->
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
    <?php }else{echo"<h3>No Toys To Unassigned..</h3>";}?>
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
     
       //  Sending Health-Provider-id with Assign token-id and zmq-id
        $("#assign_toyid_to_phc_center").on('click',function(){
            var phcCenterId = document.getElementById('phcCenterId').value;
                alert(phcCenterId)
            $.ajax({
                url: "<?= base_url('StaffController/assign_toys_To_phc_center') ?>",
                type: 'POST',
                data: {
                    phcCenterId:phcCenterId,
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {
                  // alert(data);  
                    document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-primary");
                    document.getElementById('alert').innerHTML = data;
                   // setTimeout(refresh, 9000);
                    console.log(data) 
                   
                   // var json = JSON.parse(data);      
                   //console.log((json.checked_id))
                }
            })
        });

        function refresh(){
          window.location.href = "<?php echo base_url('assign-ToysToPHC-Center')?>";
        }

</script>
</html>