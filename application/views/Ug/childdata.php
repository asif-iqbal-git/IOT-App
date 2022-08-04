 <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo "<script type='text/javascript'>alert('".$message."')</script>";//  "<div class='text text-center'>" . $message . "</div>";
    }
?>

<style type="text/css">

     td { white-space: nowrap; }
    .custom-font{
        font-size: 12px;
    }
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
    <div class="panel panel-default" style="margin-top: 10px">   
        <div class="panel-heading panel-primary">
        <h3 class="panel-title" style="">Child Data</h3>
    </div>
        <div class="panel-body">
            <div class="row">
                <!-- <div class="col-md-1">PHC</div> -->
                <div class="col-md-3">
                             <select required  id="PhcId" name="PhcId" class="form-control" >
                                    <option value="" disabled="" selected=""><span>Select PHC Name</span></option>
                                        <?php
                                        for ($i = 0; $i < count($active_phc); $i++) {
                                            ?>
                                            <option value="<?= $active_phc[$i]['PhcId'] ?>"><?= $active_phc[$i]['PhcName'] ?></option>
                                            <?php }?>
                                </select>              
                </div>
                <!-- <div class="col-md-2 float-right">Select Provider</div> -->
                  
                    <div class="col-lg-3">                                       
                    <select  required  id="providerId" name="providerId" class="form-control">
                        <option value="0" selected disabled>Select Provider</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="panel-body"  id="freedeviceList" style="display:none">
                <fieldset id="field1" style="display:block" >
                    <input id="comp_status" type="hidden" name="comp_status" value="">
                    <table id="current_patient_for_switch" class="table table-hover table-fixed" style="margin-top: 20px ">
                        <thead>
                            <tr>
                                <th class="col-lg-2"><span>Child Id</span></th>
                                <th class="col-lg-2">Name</th>
                                <th class="col-lg-2">DOB</th>
                                <th class="col-lg-2">Sex</th>
                                <th class="col-lg-2">Father</th>
                                <th class="col-lg-2">Vaccine Info</th>
                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table> 
                </fieldset>
        </div>
        
        <div class='col-sm-6 col-sm-offset-3 alert alert-info text-center' id="messageId" style="display:none; margin-top: 20px">Sorry! No data is avialable.</div>

    </div>

</div>  

<div class="modal" tabindex="-1" role="dialog" id="reportcardmodal">
    <div class="modal-dialog modal-lg" style="width:1140px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><strong>Child Vaccine Card<strong></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" style="overflow-x:scroll">
                                <table id="childvaccine_info" class="table table-bordered  table-striped patient_dose_taken_phase1_table responsive">
                                    <thead>

                                        <tr>
                                            <h4 class="text-center"> <strong>Child Name: 
                                                <span id="chname"></span>
                                            </strong></h4>
                                        </tr>
                                        <tr>

                                            <th class="text-center col">Hep B</th>
                                            <th class="text-center col">OPV 0</th>
                                            <th class="text-center col">BCG</th>
                                            <th class="text-center col">OPV 1</th>
                                            <th class="text-center col">Penta-1</th>
                                            <th class="text-center">OPV 2</th>
                                            <th class="text-center">Penta 2</th>
                                            <th class="text-center">OPV 3</th>
                                            <th class="text-center">Penta 3</th>
                                            <th class="text-center">Measles</th>
                                            <th class="text-center">DPT Booster</th>
                                            <th class="text-center">OPV Booster</th>
                                            <th class="text-center">Vitamin A</th>
                                            <th class="text-center">Measles Booster</th>

                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            <th class="text-center">Demo Booster</th>
                                            
                                        </tr>
                                    </thead>  
                                    <tbody>

                                    </tbody>
                                </table>

                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                            </div>
                            </div>

</form>    
<script type="text/javascript">
    $(document).ready(function() {

        
        $("#providerId").on('change',function(){
          $("#get_patient_switching").css('display', 'none');
 $("#tbunit").css('display', 'block');
 $("#field1").css('display', 'block');
           
        
        $.ajax({
                 url: "<?= base_url('Welcome/childDataByProvider') ?>",
                type: 'POST',
                data: {providerId: $(this).val()},
                success: function(data, textStatus, jqXHR) {
                    $("#current_patient_for_switch tbody tr").remove();
                    var json_data = $.parseJSON(data);
                 
                    if (json_data) {

                        $("#messageId").css('display', 'none'); 

                        for (var i = 0; i < json_data.length; i++) {

                            $("#current_patient_for_switch tbody").append(
                                    '<tr>\n\
                                         <td class="col-lg-2">' + json_data[i]['ChildHandMadeId'] + '</td>\n\
                                         <td class="col-lg-2">' + json_data[i]['ChildName'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['DOB'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['Gender'] + '</td>\n\\n\
                                         <td class="col-lg-2">' + json_data[i]['FatherName'] + '</td>\n\\n\
                                         <td class="col-lg-2 text-center"><button onclick="getCurrentChildName('+"'"+ json_data[i]['ChildName'] +"'"+')" type="button" class="btn btn-info btn-xs child-reportcard" id="reportcard"  name=' + json_data[i]['ChildId'] + ' value=' + json_data[i]['ChildId'] + '><span class="glyphicon glyphicon-saved"></span>Click here</button></td>\n\
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
          
          
         $("#freedeviceList").css('display', 'block'); 
            
            
        });

        $("#PhcId").on('change', function () {
         $("#messageId").css('display', 'none'); 
        $('#providerId').children('option:not(:first)').remove();
        if ($(this).val() !== 0) {
            $.ajax({
                 url: "<?= base_url('Welcome/getProviderListByPhcId') ?>",    
                data: {
                    phcId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
//                        $("#loading_district").css('display', 'none');
                        var district_object = return_array['providerInfo'];
                        for (var i = -0; i < district_object.length; i++) {
                            $("#providerId").append($("<option></option>").val(district_object[i]['ProviderId']).html(district_object[i]['ProviderName']));
                        }
                    } else {
//                        $("#loading_district").css('display', 'none');
                        alert("Data not avilable under this area.");
                    }


                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                },
                complete: function (xhr, status) {
                    
                }
            });
        }

    });

    
        
    });

   $(document).on('click', '#reportcard', function () {

                                    var array = $(this).val().split("#");
                                    var childid = array[0];
                                    var childname = array[1];
                                    $.ajax({
                                       url: '<?= base_url('childvaccine_card') ?>',
                                            data: {
                                                childId: childid,
                                            },
                                            type: "POST",
                                            success: function (json) {
                                                var obj = $.parseJSON(json);
                                                $('#childvaccine_info tbody').empty();
                                               
                                                var $table = $("#childvaccine_info");
                                                 $('#chname').text(childname);
                                                var rows = "";
                                                var $1D=obj["vaccine_detail"]["1D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["1D"];
                                                var $2D=obj["vaccine_detail"]["2D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["2D"];
                                                var $3D=obj["vaccine_detail"]["3D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["3D"];
                                                var $4D=obj["vaccine_detail"]["4D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["4D"];
                                                var $5D=obj["vaccine_detail"]["5D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["5D"];
                                                var $6D=obj["vaccine_detail"]["6D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["6D"];
                                                var $7D=obj["vaccine_detail"]["7D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["7D"];
                                                var $8D=obj["vaccine_detail"]["8D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["8D"];
                                                var $9D=obj["vaccine_detail"]["9D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["9D"];
                                                var $10D=obj["vaccine_detail"]["10D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["10D"];
                                                var $11D=obj["vaccine_detail"]["11D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["11D"];
                                                var $12D=obj["vaccine_detail"]["12D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["12D"];
                                                var $13D=obj["vaccine_detail"]["13D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["13D"];
                                                var $14D=obj["vaccine_detail"]["14D"]=="1920-12-12"?"----------":obj["vaccine_detail"]["14D"];
                                               
                                                
                                                
                                                rows += "<tr style='background: orange'><td>" + $1D + "</td><td>" + $2D + "</td><td>" + $3D + "</td><td>" + $4D + "</td><td>" + $5D + "</td><td>" + $6D + "</td><td>" + $7D + "</td><td>" + $8D + "</td><td>" + $9D + "</td><td>" + $10D + "</td><td>" + $11D + "</td><td>" + $12D + "</td><td>" + $13D + "</td><td>" + $14D + "</td></tr>";
                                                $table.prepend(rows);
                                            },
                                            error: function (xhr, status, errorThrown) {
                                                $('#women_level_spinner').css('display', 'none');
                                            },
                                            complete: function (xhr, status) {
                                                $('#women_level_spinner').css('display', 'none');
                                            }        
                                       
                                    });
                     $('#reportcardmodal').modal('show');

                                });  

function getCurrentChildName(name)
{
    document.getElementById('chname').innerHTML = "<span>" + name + "</span>";  
}

</script>
 


