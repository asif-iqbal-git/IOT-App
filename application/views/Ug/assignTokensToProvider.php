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

<!-- <form id="test" class="form-horizontal" method="POST" action="<//?= base_url('welcome/assignDevicestoTBunits') ?>"> -->

<form id="test" class="form-horizontal" method="POST" action="">

<div class="col-lg-12">
    <div class="Card" style="">   
        <div class="">
        <h3 class="" style="">Assign Tokens to Health Provider</h3>
        <hr>
    </div>
        <div class="Card mb-3">
            
          <div class="row">
              <div class="col-md-2"><label class="control-label">Provider Name</label></div>
              <div class="col-md-4">
                <select required  id="providerId" name="providerId" class="form-control" >
                <option value="" disabled="" selected=""><span>Select Provider</span></option>
                <?php for($i = 0; $i < count($active_provider); $i++) {?>
                    <option value="<?= $active_provider[$i]['ProviderId'] ?>"><?= $active_provider[$i]['ProviderName'] ?></option>  
                <?php } ?>
                </select>
              </div>
              <div class="col-md-3">
              <button  id="update_dot_planner" class="btn btn-primary center-block" type="submit"><span class=""></span>&nbsp;<strong>Assign Tokens to Provider</strong></button> 
              </div>
          </div>      
    </div>

        <div class="panel-body"  id="freedeviceList">
                <fieldset id="field1">
                    <input id="comp_status" type="hidden" name="comp_status" value="">
                    <table id="current_patient_for_switch" class="table table-bordered table-striped" style="">
                        <thead>
                            <tr>
                                <th class="col-lg-4"><span>ZMQ Id</span></th>
                                <th class="col-lg-4"> Token Id<th>                               
                                <!-- <th class="col-lg-4">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> 

                </fieldset>
        </div>
        <div class='col-sm-6 col-sm-offset-3 alert alert-info text-center' id="messageId" style="display:none">No Devices are free for assigning</div>

    </div>

    </div>   

</form>  



<script type="text/javascript">
    var checkedVal={};
    var all=[];    

    $(document).ready(function() {
        
        $("#providerId").on('change',function(){

              $.ajax({
                 url: "<?= base_url('Welcome/getUnAssignTokens') ?>",
                type: 'POST',
                data: {comp_method: 0},
                success: function(data, textStatus, jqXHR) {
                    $("#current_patient_for_switch tbody tr").remove();
                    var json_data = $.parseJSON(data);
                    //console.log(json_data);
                    if (json_data) {

                        $("#messageId").css('display', 'none'); 

                        for (var i = 0; i < json_data.length; i++) {

                            $("#current_patient_for_switch tbody").append(
                                    '<tr>\n\
                                         <td class="col-lg-4">' +'ZT-'+ json_data[i]['TokenId'] + '</td>\n\
                                         <td class="col-lg-4">' + json_data[i]['TokenRealId'] + '</td>\n\
                                         <td class="col-lg-4"><input type="checkbox" name=' + json_data[i]['TokenId'] + ' value=' + 'ZT-'+json_data[i]['TokenId']+","+json_data[i]['TokenRealId'].replace(/[ ]/g,'_')+ '></td>\n\
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
        
        // ---------------select Checkbox value---------------------
        $(document).on('change','input[type=checkbox]' ,function(){
       // checkedVal={};
        all=[];

        $('input[type=checkbox]:checked').each(function(){             
            // set-1  to assign toys and remove from list
           // checkedVal[$(this).val()]=1;
            
           //push all checked value 
            all.push($(this).val());  
             
        });       
        // console.log(all);
        // alert(all);
        });
 
        
        //-----On Button Click, selected checkboxes value send to Controller        
        $("#districtTBId").on('change', function () {
        $("#messageId").css('display', 'none'); 
        $('#tbcenterId').children('option:not(:first)').remove();
       
        
//        $("#loading_district").css('display', 'block');
        if ($(this).val() !== 0) {
            $.ajax({
                 url: "<?= base_url('welcome/selectTbunitsBydistTBid') ?>",    
                data: {
                    districtTBId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
//                        $("#loading_district").css('display', 'none');
                        var district_object = return_array['tbunitInfo'];
                        for (var i = -0; i < district_object.length; i++) {
                            $("#tbcenterId").append($("<option></option>").val(district_object[i]['tbCenterId']).html(district_object[i]['tbCenterName']));
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
      // $("#get_patient_switching").on('click', function() {
       // });                
    });

    //  Sending Health-Provider-id with Assign token-id and zmq-id
    $("#update_dot_planner").on('click',function(){
            var e = document.getElementById("providerId");
            var providerId = e.value;
            alert(providerId+","+ all)
    $.ajax({
            url: "<?= base_url('welcome/getHealthWorkerIdWithTokens') ?>",
            type: 'POST',
            data: {
                health_pid:providerId,
                checked_id:all
            },
            success: function(data, textStatus, jqXHR) {
               alert(data);                
            }
        })
    });
    
  

    var checkboxes = document.getElementsByName('location[]');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
    }
    if (vals) vals = vals.substring(1);

</script>




