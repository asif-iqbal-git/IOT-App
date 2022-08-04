<style type="text/css">

    .table-fixed tbody {
        max-height: 400px;
        overflow-y: auto;
    }
    .table-fixed tbody, .table-fixed tr,table-fixed td ,table-fixed input,table-fixed thead,table-fixed th{
        display: block;
    }
    .table-fixed tbody td, .table-fixed thead th{
        float: left;
        text-align: center;
    }
    .table-fixed thead th{

    }

</style>

<div class="panel panel-default" style="margin-top: 10px">
     <div class="page-header panel-title panel-info">
                <h4 class="text-center">Game Playing Report </h4>
            </div>
    <div class="panel-body">

                <table class="table table-hover table-fixed " style="margin-top: 20px">
                    <thead>
                        <tr>
                            <th class="col-lg-1">Questions</th>
                            <th class="col-lg-2">Your Answer</th>
                            <th class="col-lg-2">Real Answer</th>
                            <th class="col-lg-1">Sex</th>
                            <th class="col-lg-1">Lang</th>
                            <th class="col-lg-1">Score </th>
                            <th class="col-lg-1">Total </th>
                            <th class="col-lg-2">Playing Date</th> 
                            <th class="col-lg-1">MakId</th>
                          
                        </tr>

                    </thead>
                    <tbody>
                         
                     <?php
                        if (isset($group_patient) and $group_patient != NULL) {
                            for ($i = 0; $i < count($group_patient); $i++) {
                                ?>

                                <tr>
                                    <td class="col-lg-1"><?= $group_patient[$i]['QuestionId'] ?></td>
                                    <td class="col-lg-2"><?= $group_patient[$i]['AnswerId']?></td>
                                     <td class="col-lg-2"><?= $group_patient[$i]['RealAnswer']?></td>
                                    <td class="col-lg-1"><?= $group_patient[$i]['Gender'] ?></td>
                                    <td class="col-lg-1"><?= $group_patient[$i]['Lang'] ?></td>
                                    <td class="col-lg-1"><?=$group_patient[$i]['Score']?></td>
                                    <td class="col-lg-1">30</td>
                                    <td class="col-lg-2"><?= date('d-m-Y',strtotime($group_patient[$i]['current_DateTime']))?></td>
                                    <td class="col-lg-1"><?=$group_patient[$i]['MakId']?></td>
                                    
                                </tr>                   
                                <?php }
                            ?>
                           
                        <?php }
                        ?>    
                        
                    </tbody>
                </table> 

            

    </div>

</div>

