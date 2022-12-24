<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .phc_list{
            font-size: 2em; 
        }
        #alert{
              display: none;
            }
           
    </style>
    <title>Document</title>
</head>
<body>
    <h3>Phc Registration</h3>
    <div class="alert  col-md-9 mx-auto" id="alert" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
       <div class="container">
       <form>
  <div class="form-row">
    <div class="col-md-8 ml-5">
      <input type="text"  id="phc_name" class="form-control" name="phc_name" placeholder="Phc Name">
    </div>
    <div class="col">
    <button type="submit"  class="btn btn-primary" id="submit_phc_name">Add PHC</button>
    </div>
  </div>
</form>
<hr>
<p class="phc_list">Phc List</p>

 <!-- <//?php var_dump($phc_name); ?> -->
 <table class="table table-bordered">
  <thead>
  
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Phc Name</th>
      <th scope="col">Status</th>      
    </tr>

  </thead>
  <tbody>
  <?php 
   for ($i= 0; $i < count($phc_name); $i++){?>
    <tr>
      <th scope="row"><?= $i+1; ?></th>
      <td>  <div><?= $phc_name[$i]->PhcName??'' ?></div></td>
      <td>  <div><?= ($phc_name[$i]->isActive==1)?'Active':'Deactive'; ?></div></td>
      
    </tr>
    <?php }?>
  </tbody>
</table>
   
  
 
       </div>

       
</body>
 <script>
     $("#submit_phc_name").on('click',function(){
        var phc_name = document.getElementById('phc_name').value;
        //alert(phc_name) 
        $.ajax({
                url: "<?= base_url('StaffController/savePhcName') ?>",
                type: 'POST',
                data: {
                    phc_name:phc_name,                    
                },
                success: function(data, textStatus, jqXHR) {
                  // alert(data);  
                    document.getElementById('alert').style.display = 'block';
                    document.getElementById('alert').classList.add("alert-primary");
                    document.getElementById('alert').innerHTML = data;
                   // setTimeout(refresh, 3000);
                   console.log(data) 
                   
                 // var json = JSON.parse(data);      
                  //  console.log((json.checked_id))

                  //Also Show Unassigned Projects in table format
                }
            })       
    })
 </script>
</html>