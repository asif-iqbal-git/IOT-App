<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"></style> -->

<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> -->
    




</head>
<body>
    <h1>Staff Info</h1>
    <!-- <//?php var_dump($staff_info[0]->level); ?> -->
   
     
     
    <div class="container">
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
                        echo "PHC Field Worker!"??"--";
                        break;
                      default:
                        echo "--";
                    }
                }
                    //   if($staff_info[$i]->level==0){echo("Super Admin")??'--';} 
                    //   if($staff_info[$i]->level==1){echo("Company Admin")??'--';}
                    //   if($staff_info[$i]->level==2){echo("Project Admin")??'--';}
                    //   if($staff_info[$i]->level==3){echo("PHC Field Worker")??'--';} 
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
</body>
<script>
    $(document).ready(function () {
   // $('#example').DataTable();
});
</script>
</html>