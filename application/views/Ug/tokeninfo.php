

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
<div class="container-fluid">
    <form id="test" class="form-horizontal" method="POST" action="<?= base_url('welcome/assignDevicestoTBunits') ?>">
 

    <div class="col-lg-12">
    <div class="panel panel-default" style="">   
        <div class="panel-heading panel-primary">
        <h4 class="panel-title" style="text-align: center">Token Information</h4>
        <div  style="" id="perPageOption"></div>
    </div>
  <!-- For per Page Options -->


                <fieldset id="field1" style="display:block" >
                    <input id="comp_status" type="hidden" name="comp_status" value="">
                    <table id="current_patient_for_switch" class="table table-bordered" style="">
                        <thead>
                            <tr>
                                <th class="col-lg-1"><span>Token Id</span></th>
                                <th class="col-lg-2">Real Id</th>
                                <th class="col-lg-2">Assigned to Child</th>
                                <th class="col-lg-2">Assigned to Provider</th>
                                <th class="col-lg-2">Token Status</th>
                                <th class="col-lg-2">Actions</th>
                            </tr>

                        </thead>
                        <tbody id="tblBodyId">

                        </tbody>
                    </table> 
                     <!-- For Page Page Link -->
                     <div id ="pglink" style="float: right; padding-top:10px;"></div>
                </fieldset>

        
        <div class='col-sm-6 col-sm-offset-3 alert alert-info text-center' id="messageId" style="display:none; margin-top: 20px">Sorry! No data is avialable.</div>

    </div>

    </div> 
  </form>    
</div>

<script type="text/javascript">

function backendPaginationAjax(pgNum){
        
        setCookie("selectedPage", pgNum, 1);
        let perPg=$('#perPage').find(":selected").val();

        let current_patient_for_switch ="<tbody>";
        $.ajax({
                url: "<?= base_url('Welcome/getTokenStatus') ?>",                
                data:{pgNum:pgNum,perPg:perPg},
                type: 'POST',
                success: function(data, textStatus, jqXHR) {
                    $("#current_patient_for_switch tbody tr").remove();
                    
                    //var json_data = $.parseJSON(data);
                    var json_data = JSON.parse(data);
                    $('#pglink').html(json_data['pageLink']);
                    $('#perPageOption').html(json_data['perPageOptions']);

                    // console.log(json_data);
                   
                   

                    if (json_data) {

                        console.log(json_data['tableData'][0]);
                        $("#messageId").css('display', 'none'); 
                        var tbData="";
                        for (var i = 0; i < json_data['tableData'].length; i++) {


                            tbData+=' <tr>'
                                tbData+='<td class="col-lg-2"><span>'+json_data['tableData'][i]['TokenId']+'</span></td>';
                                tbData+='<td class="col-lg-2">'+json_data['tableData'][i]['TokenRealId']+'</td>';
                                tbData+='<td class="col-lg-2">'+json_data['tableData'][i]['AssignedtoChild']+'</td>';
                                tbData+='<td class="col-lg-2">'+json_data['tableData'][i]['AssignedtoWorker']+'</td>';
                                tbData+='<td class="col-lg-2">'+json_data['tableData'][i]['TokenStatus']+'</td>';

                                tbData+='<td class="col-lg-2">';
                                tbData+='<button type="button" class="btn btn-info btn-sm child-reportcard" id="reportcard"  name="';
                                 tbData+=json_data['tableData'][i]['TokenId'];
                                tbData+='" value="';
                                 tbData+=json_data['tableData'][i]['TokenId'];
                                  tbData+='"><span class=""></span>Click here</button>';

                                tbData+='</td>'

                            tbData+='</tr>'

                            // $("#current_patient_for_switch tbody").append(
                            //         '<tr>\n\
                            //              <td class="col-lg-2">' + 'ZT-' +json_data[i]['TokenId'] + '</td>\n\
                            //              <td class="col-lg-2">' + json_data[i]['TokenRealId'] + '</td>\n\\n\
                            //              <td class="col-lg-2">' + json_data[i]['AssignedtoChild'] + '</td>\n\\n\
                            //              <td class="col-lg-2">' + json_data[i]['AssignedtoWorker'] + '</td>\n\\n\
                            //              <td class="col-lg-2">' + json_data[i]['TokenStatus'] + '</td>\n\\n\
                            //              <td class="col-lg-2 text-center"><button type="button" class="btn btn-info btn-xs child-reportcard" id="reportcard"  name=' + json_data[i]['TokenId'] + ' value=' + json_data[i]['TokenId'] + '><span class="glyphicon glyphicon-saved"></span>Click here</button></td>\n\
                            //          </tr>'
                            //         );
                        }


                        $('#tblBodyId').html(tbData);
                        // alert(tbData);


                        $(document).ready(function() {
                            $('#perPage').on('change', function(){
                                let selectedPage=getCookie("selectedPage");
                                backendPaginationAjax(selectedPage);
                        });   
                    });

                    } else {
                        $("#loading_patient_switch").css('display', 'none');
                        $("#messageId").css('display', 'block'); 
                        $("#freedeviceList").css('display', 'none');
                    }
                    $("#loading_patient_switch").css('display', 'none');

                }


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

}//end-of-backendPaginationAjax
   
</script>

<script>
            // -------------------------Cookie-------------------

            function setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                let expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                function getCookie(cname){
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                    }
                }
                return "";
                }
                function deleteCookie(cname) {
                    document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                } 
                backendPaginationAjax(1);
        </script>





