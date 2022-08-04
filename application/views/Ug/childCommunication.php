<?php
$message = $this->session->flashdata('message');
if ($message) {
    echo "<script type='text/javascript'>alert('" . $message . "')</script>"; //  "<div class='text text-center'>" . $message . "</div>";
}
?>


<style type="text/css">
    td {
        white-space: nowrap;
    }

    .custom-font {
        font-size: 12px;
    }

    .table-fixed tbody {
        max-height: 400px;
        overflow-y: auto;
    }

    .table-fixed tbody,
    .table-fixed tr,
    table-fixed td,
    table-fixed input,
    table-fixed thead,
    table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed thead th {
        float: left;
        text-align: center;
    }

    .table-fixed thead th {}
</style>
<form id="test" class="form-horizontal" method="POST" action="<?= base_url('welcome/assignDevicestoTBunits') ?>">

    <div class="col-lg-12">
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-heading panel-primary">
                <h3 class="panel-title " style="text-align: center">Child Token Communication Data</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">

                    <label class="control-label col-lg-1">PHC </label>
                    <div class="col-lg-3">


                        <select required id="PhcId" name="PhcId" class="form-control">
                            <option value="" disabled="" selected=""><span>Select PHC Name</span></option>
                            <?php
                            for ($i = 0; $i < count($active_phc); $i++) {
                            ?>


                                <option value="<?= $active_phc[$i]['PhcId'] ?>"><?= $active_phc[$i]['PhcName'] ?></option>


                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <label class="control-label col-lg-1">Provider</label>
                    <div class="col-lg-3">
                        <select required id="providerId" name="providerId" class="form-control">
                            <option value="0" selected disabled>Select Provider </option>
                        </select>
                    </div>
                    <!-- select box element in new row -->

                    <div>
                        <label class="control-label col-lg-2">Select Token</label>
                        <div class="col-lg-2">
                            <select required id="tokenId" name="tokenId" class="form-control">
                                <option value="0" selected disabled>Select Token </option>

                            </select>
                        </div>
                    </div>



                </div>


                <div class="table-responsive" id="freedeviceList" style="display:none">


<fieldset id="field1" style="display:block">
    <input id="comp_status" type="hidden" name="comp_status" value="">
    <table id="current_patient_for_switch" class="table table-bordered" style="margin-top: 20px ">
        <thead>
            <tr>
                <th scope="col" class="col-lg-1"><span>Child Id</span></th>
                <th scope="col"  class="col-lg-2">visitedDate</th>
                <th scope="col"  class="col-lg-1">immunization</th>
                <th scope="col"  class="col-lg-4">mother communication</th>
                <th scope="col"  class="col-lg-3">advice</th>
            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</fieldset>
</div>


            </div>


 



            
            <div class='col-sm-6 col-sm-offset-3 alert alert-info text-center' id="messageId" style="display:none; margin-top: 20px">Sorry! No data is avialable.</div>

        </div>

    </div>


</form>
<script type="text/javascript">
    $(document).ready(function() {





        $("#PhcId").on('change', function() {
            $("#messageId").css('display', 'none');
            $('#providerId').children('option:not(:first)').remove();
            if ($(this).val() !== 0) {
                $.ajax({
                    url: "<?= base_url('Welcome/getProviderListByPhcId') ?>",
                    data: {
                        phcId: $(this).val()
                    },
                    type: "POST",
                    success: function(json) {

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
                    error: function(xhr, status, errorThrown) {
                        alert("Sorry, there was a problem!");
                        console.log("Error: " + errorThrown);
                        console.log("Status: " + status);
                        console.dir(xhr);
                    },
                    complete: function(xhr, status) {

                    }
                });
            }

        });


        $("#tokenId").on('change', function() {
            $("#get_patient_switching").css('display', 'none');
            $("#tbunit").css('display', 'block');
            $("#field1").css('display', 'block');


            $.ajax({
                url: "<?= base_url('Welcome/childCommunication_TokenId') ?>",
                type: 'POST',
                data: {
                    tokenId: $(this).val()
                },
                success: function(data, textStatus, jqXHR) {
                    $("#current_patient_for_switch tbody tr").remove();
                    var json_data = $.parseJSON(data);

                    if (json_data) {

                        $("#messageId").css('display', 'none');
                        let targetTbody = document.querySelector('#current_patient_for_switch tbody');
                        console.log(targetTbody);
                        // first empty the tbody
                        targetTbody.innerHTML = '';
                        // then add the new rows
                        for (var i = 0; i < json_data.length; i++) {
                            var row = document.createElement('tr');
                            // add id to tr
                            row.setAttribute('id',i);
                            row.innerHTML = '<td>' + json_data[i].child_id + '</td>' +
                                '<td>' + json_data[i].visit_date_time + '</td>' +
                                '<td>' + json_data[i].immunisation + '</td>' +
                                '<td>' + json_data[i].verbal_comm_mother + '</td>' +
                                '<td>' + json_data[i].advise_related_child + '</td>';
                            targetTbody.appendChild(row);
                        }
                        // set first row color to green
                        $("#current_patient_for_switch tbody tr:first").css('background-color', '#00b7eb');
                        // for (var i = 0; i < json_data.length; i++) {

                        //     $("#current_patient_for_switch tbody").append(
                        //         '<tr><td class="col-lg-1">' + json_data[i]['child_id'] + '</td></tr>'
                        //     );
                        // }
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





    });
</script>


<script>
    let providerId = document.querySelector('#providerId');
    console.log(providerId);
    providerId.addEventListener('change', function() {
        let providerId = this.value;
        console.log(providerId);
        let url = '<?= base_url('Welcome/loadTokenIdsUnderHealthWorker') ?>';
        $.ajax({
            url: url,
            data: {
                providerId: providerId
            },
            type: 'POST',
            success: function(json) {
                // alert(json);
                let obj = $.parseJSON(json);
                // console.log(obj);
                // for each token id append to select
                let tokenId = document.querySelector('#tokenId');
                tokenId.innerHTML = '';

                obj.forEach(element => {
                    // console log TokenId as value and ZMQTokenId  as text
                    //    empty option from previous selection

                    // append to select
                    tokenId.innerHTML += `<option value="${element.TokenId}">${element.ZMQTokenId}</option>`;


                });



            },
            error: function(xhr, status, errorThrown) {
                alert("Sorry, there was a problem!");
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            },
            complete: function(xhr, status) {
                //alert("The request is complete!");
            }
        });
    });
</script>