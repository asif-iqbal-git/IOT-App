<!DOCTYPE html>
 
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
     Welcome !  <strong> <?php print_r($user_session_details['username']); ?></strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <!-- <//?php print_r($user_session_details['username']); ?> -->
    
    <?php print_r($project_info); ?>
      <br><p class="h3">Company Name : <?php 
      for($k = 0; $k < count($project_info); $k++){
        if($user_session_details['username'] == $project_info[$k]->userId){       
            $company_name = ($project_info[$k]->company_name); 
        }
      }
      echo $company_name;
      ?>
      </p>
      
    
   
      <p class="h5"><u>Project List</u></p>
      <?php for($i = 0; $i < count($project_info); $i++){
        if($user_session_details['username'] == $project_info[$i]->userId){
   ?>
       
      <p class="h4"><?php print_r($project_info[$i]->project_name); ?></p>
       
     <?php }
       
      } 
      ?>
      
        <script src="" async defer></script>
        </div>
    </body>
</html>