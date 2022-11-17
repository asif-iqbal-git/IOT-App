<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <style>
      #noData{
        font-size:3rem;
        text-align: center;
      }
    </style>
</head>
<body>
  <!-- <//?php echo"<pre/>";var_dump($selectedToytokens);?>    -->
    <h5>Toys List Under Phc-Staff</h5>
    <h6>PHC: <?= ($selectedToytokens[0]->PhcName ?? "NOT GET YET"); ?></h6>
 
  <!-- <//?php echo"<pre/>";var_dump($toysUnderphcstaff);?>    -->
    <div class="container">
    <?php if(isset($selectedToytokens) && !empty($selectedToytokens)){ ?>  
    <table class="table table-bordered col-md-8 mx-auto">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Token Id</th>
      <th scope="col">Toy Name</th>      
    </tr>
  </thead>
  <tbody>
  
  <?php for($i=0; $i < count(($selectedToytokens));  $i++){ ?>
    <tr>
      <th scope="row"><?= $i+1?></th>
      <td><?= "T-".$selectedToytokens[$i]->zmq_token_Id; ?></td>
      <td><?= $selectedToytokens[$i]->ToyName; ?></td>
    </tr>
    <?php }
  }else{?>
  <p id="noData">No Toys Yet Assigned</p>
    <?php } ?>
  </tbody>
</table>

   
</div>
</body>
</html>