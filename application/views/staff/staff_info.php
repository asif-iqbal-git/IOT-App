<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
            #title{
                text-align: center;
                font-size:2em;                
            }  
    </style>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"></style> -->

<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> -->
    




</head>
<body>
    <p class="" id="title" >Staff Info</p>
    <!-- <//?php var_dump($staff_info[0]->level); ?> -->
   
     
     
    <div class="container">
        <div class="mx-auto col-md-8 mb-4">
            <!-- <input id="search_bar"  type="text" class="form-control"> -->
        </div>
        <div id="table_data">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Login Id</th>
                <th>Password</th>
                <th>Designation</th>
                <th>PhoneNo</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i < count($staff_info); $i++ ){ ?>
            <tr>
                <td>   
                    <?= $staff_info[$i]->emp_name??'--' ?>
                </td>
                <td>   
                    <?= $staff_info[$i]->login_id??'--' ?>
                </td>
                <td>   
                    <?= $staff_info[$i]->password??'--' ?>
                </td>
                <td>   
                    <?php
                   if(isset($staff_info[$i]->level) && !empty($staff_info[$i]->level)){
                    switch ($staff_info[$i]->level) {
                        case $staff_info[$i]->level==0:
                        echo "Super Admin" ?? '--';
                        break;
                        case $staff_info[$i]->level==1:
                        echo "Company Admin" ?? '--';
                        break;
                        case $staff_info[$i]->level==2:
                        echo "Project Admin" ?? "--";
                        break;
                        case $staff_info[$i]->level==3:
                        echo "PHC Field Worker"??"--";
                        break;
                      default:
                        echo "--";
                    }
                }
                      ?>
                </td>
                <td>   
                    <?= $staff_info[$i]->emp_phone??'--' ?>
                </td>
                <td>   
                    <?= $staff_info[$i]->emp_address??'--' ?>
                </td>
                 
            </tr>
            <?php } ?>
             
        </tbody>
         
    </table>
    </div>
    <div id="result"></div>
    </div>
</body>
<script>
      

   var search_bar_elem = document.getElementById('search_bar');
   search_bar_elem.addEventListener('change',function(){
   var key =  search_bar_elem.value;        

    $.ajax({
        url: "<?= base_url('StaffController/getAllStaffDetails_ajax'); ?>",
        type: 'POST',
        data:{},
        success: function(data, textStatus, jqXHR) {
            var name = "";
            data = JSON.parse(data);
            name = (data[0].emp_name.trim()).split("");
            for(var i=0; i < name.length; i++){
                if(name[i] == key){
                    alert(name[i])
                }else{
                    console.log("not found")
                }
            }
            console.log(name);
            if(key == data[0].emp_name){
                document.getElementById('table_data').style.display = 'none';
                document.getElementById('result').innerHTML = "Found";
            }else{
                document.getElementById('table_data').style.display = 'none';
                document.getElementById('result').innerHTML = "Not Found";
            }
    
          

           console.log(data[0].emp_name)
        },
        error: function (jqXHR, exception) {
            console.log(exception);
        }
    })
   });
   
</script>
</html>