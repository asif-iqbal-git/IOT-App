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
    <h2>Assign Toy To PHC-Staff</h2>
    <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      
        
      </div>
      <div class="alert alert-warning alert-dismissible fade show col-md-10 mx-auto" role="alert">
  Single Toy is Assign To Single Phc-Staff
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
     
    <!-- PHC Center List -->
      <div class="Card mb-3">
      
      <!-- <//?php echo("<pre>");print_r(($toy_list??"None")); ?>    -->
        <!-- #todo
            1. select PHC
            2. select PHC staff
            3. show list of toys to select by phc-staff
        -->
        <div class="row">
             <div class="col-md-1"><label class="control-label"></label></div>
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
             
             <div class="col-md-4">
               <select required  id="zmqToyId" name="zmqToyId" class="form-control" >
               <option value="" disabled="" selected=""><span>Select PHC Staff</span></option>
               <?php if(isset($phcStaff_list) && !empty($phcStaff_list)){?>
               <?php for($i = 0; $i < count($phcStaff_list); $i++) {?>
                   <option value="<?= $phcStaff_list[$i]->emp_name ??"No Data Found" ?>">
                   <?= $phcStaff_list[$i]->emp_name??"No Project Admin Found" ?></option>  
               <?php } }?>
               </select>
             </div>
             <div class="col-md-3">
             <button  id="assign_toyid_to_phc_staff" class="btn btn-primary center-block" type="submit"><span class="">                    
                 </span>&nbsp;<strong>Assign Toy</strong>
             </button> 
             </div>

         </div>    
           
             
   </div>

   <!-- Toy  Table -->
   <div class="col-md-12">
       
      
      <!-- table -->
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Toy List</th>    
      <th scope="col">Assign</th>
    </tr>
  </thead>
  <tbody id="tbl_data"></tbody>
   
</table>

    <!-- UnAssigned Tokens List -->
<!-- <//?php var_dump($assignToyList); ?> -->

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
      
 
       
      <td>
      <button type="button" class="btn btn-outline-danger" id="<?= $assignedProjects[$i]->project_uuid;  ?>" onclick="unassignedPAdmin(this.id)">UNASSIGNED</button>
      </td>
    </tr>
    <?php }?>
    <?php }else{echo"<h3>No Phc-Staff To Unassigned..</h3>";}?>
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
     
       //  Sending ZMQ Token id with zmq-toy
        $("#assign_toyid_to_phc_staff").on('click',function(){
            var zmqToyId = document.getElementById('zmqToyId').value;
                alert(zmqToyId)
            $.ajax({
                url: "<?= base_url('StaffController/assign_toy_To_phcStaff') ?>",
                type: 'POST',
                data: {
                    zmqToyId:zmqToyId,
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {
                  // alert(data);  
                    document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-primary");
                    document.getElementById('alert').innerHTML = data;
                   // setTimeout(refresh, 10000);
                    console.log(data) 
                   
                   // var json = JSON.parse(data);      
                   //console.log((json.checked_id))
                }
            })
        });

        function refresh(){
          window.location.href = "<?php echo base_url('assign-ToysToPHC-Center')?>";
        }

        var phcCenterId = document.getElementById('phcCenterId');
        phcCenterId.addEventListener('change',function(){
          //alert(phcCenterId.value)
          phc_Center_Id = phcCenterId.value;
          alert(phc_Center_Id)
          $.ajax({
                url: "<?= base_url('StaffController/showToyListByPHC') ?>",
                type: 'POST',
                data: {
                  phcCenterId:phc_Center_Id, 
                },
                success: function(data, textStatus, jqXHR) {
                  //  alert(data);  
                  console.log(data)  
                  var jsonData = JSON.parse(data);      
                  console.log(jsonData)
                  var htmlTemp = '';
                  for (var i = 0; i <jsonData.length; i++){
                    htmlTemp += `<tr><td>${i+1}</td>`;
                    htmlTemp += `<td>${jsonData[i].ToyName}</td>`;
                    htmlTemp += `<td><input type="checkbox" id="ckboxToyId" value="${jsonData[i].zmq_toy_Id}"/></td></tr>`;
                  }
                  document.getElementById('tbl_data').innerHTML = htmlTemp;
                  
                  
                },// Error handling 
                error: function (error) {
                    console.log(`Error ${error}`);
                }
            })
        })
        

</script>
</html>