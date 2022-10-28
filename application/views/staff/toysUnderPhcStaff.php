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
    <div class="container">
    <table class="table table-bordered col-md-8 mx-auto">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Toys Name</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($toysUnderphcstaff) && !empty($toysUnderphcstaff)){ ?>
        <?php for($i=0; $i< count(($toysUnderphcstaff));  $i++){ ?>
    <tr>
      <th scope="row"><?= $i+1 ?></th>
      <td>
    
        <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne<?= $i ?>" aria-expanded="true" aria-controls="collapseOne<?= $i ?>">
        <?php echo $toysUnderphcstaff[$i]->ToyName; ?>
        </button>
      </h2>
    </div>
    <?php if(isset($selectedToytokens) && !empty($selectedToytokens)){ ?>
  <?php for($k=0; $k < count(($selectedToytokens));  $k++){ ?>
    <div id="collapseOne<?= $i ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
    <ul class="list-group list-group-flush">
     <li class="list-group-item pl-4">
      <?php echo 'Token no. : T-'.$selectedToytokens[$k]->zmq_token_Id; ?>
      </li>
    </ul>
    </div>
    <?php }}?> 
       
  </div>
  </div>
    </td>       
    </tr>    
    

    <?php } ?>


        <?php } ?>
  </tbody>
</table>
</div>
</body>
</html>