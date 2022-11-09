<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
</head>
<body>
    <h5>Toys List Under Phc-Staff</h5>
    <h6>PHC: <?= print_r($selectedToytokens[0]->PhcName); ?></h6>
 <!-- <//?php echo"<pre/>";var_dump($selectedToytokens);?>    -->
  <!-- <//?php echo"<pre/>";var_dump($toysUnderphcstaff);?>    -->
    <div class="container">

    <table class="table table-bordered col-md-8 mx-auto">
  <thead>
    <tr>
      <th scope="col">S. no</th>
      <th scope="col">TokenId</th>
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
    <?php } ?>
  </tbody>
</table>

   
</div>
</body>
</html>