

    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo "<script type='text/javascript'>alert('".$message."')</script>";//  "<div class='text text-center'>" . $message . "</div>";
    }
    ?>

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
<form id="test" class="form-horizontal" method="POST" action="<?= base_url('welcome/assignDevicestoTBunits') ?>">

<div class="col-lg-12">
    <div class="panel panel-default" style="margin-top: -10px">   
        <div class="panel-heading panel-primary">
        <h3 class="panel-title " style="text-align: center">Vaccine Planner Details</h3>
    </div>
 
                <fieldset id="field1" style="display:block" >
                    <input id="comp_status" type="hidden" name="comp_status" value="">
                    <table id="current_patient_for_switch" class="table table-hover table-fixed" style="margin-top: 20px ">
                        <thead>
                            <tr>
                                <th class="col-lg-2"><span>Id</span></th>
                                <th class="col-lg-2"> Vaccine Name</th>
                                <th class="col-lg-2">Start Day</th>
                                <th class="col-lg-2">End Day</th>
                                <th class="col-lg-2">Dependent Id</th>
                                <th class="col-lg-2">Dependency Day</th>



                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table> 
                </fieldset>

        
        <div class='col-sm-6 col-sm-offset-3 alert alert-info text-center' id="messageId" style="display:none; margin-top: 20px">Sorry! No data is avialable.</div>

    </div>

</div>   </form>    
<script type="text/javascript">
    $(document).ready(function() {
  
        $.ajax({
                 url: "<?= base_url('Welcome/vaccinePlannerData') ?>",
                type: 'POST',
                success: function(data, textStatus, jqXHR) {
                    $("#current_patient_for_switch tbody tr").remove();
                    var json_data = $.parseJSON(data);

                    if (json_data) {

                        $("#messageId").css('display', 'none'); 

                        for (var i = 0; i < json_data.length; i++) {

                            $("#current_patient_for_switch tbody").append(
                                    '<tr>\n\
                                         <td class="col-lg-2">' + json_data[i]['vaccineId'] + '</td>\n\
                                         <td class="col-lg-2">' + json_data[i]['vaccineName'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['startDay'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['endDay'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['dependentVaccineId'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['DayOfDependency'] + '</td>\n\\n\
                                     </tr>'
                                    );
                        }
                    } else {
                        $("#loading_patient_switch").css('display', 'none');
                        $("#messageId").css('display', 'block'); 
                        $("#freedeviceList").css('display', 'none');
                    }
                    $("#loading_patient_switch").css('display', 'none');

                }


         });
  
        
    
        
    });



</script>




