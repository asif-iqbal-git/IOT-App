<style type="text/css">
.col-md-9{
    position: relative;
    width: 100%;
    padding-right: 0.75rem !important;
    padding-left: 0.75rem !important;
}    
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="page-header panel-title">
                <h4 class="text-center">Provider Registration </h4>
            </div>

        <?php
        
        $message1 = $this->session->flashdata('message1');
        if ($message1) {
            echo "<div class='col-sm-6 col-sm-offset-3 alert alert-info text-center'>" . $message1 . " </div>";
            //echo "<script type='text/javascript'>alert('".$message."')</script>";//  "<div class='text text-center'>" . $message . "</div>";
        }
        
        ?>
            <div class="">
                <div class="container">
                    <form class="" action="<?= base_url('providerRegisterSubmittion') ?>" method="POST">
                        <div class="card">
                            <div class="card-header">Basic Info</div>
                            <div class="form-group   mt-5"> 
                                <div class="form-row">               
                                    <div class="col-md-9 mx-auto">
                                        <label class="control-label">PHC Name</label>
                                        <select required  id="PhcId" name="PhcId" class="form-control">
                                            <option value="" disabled selected=""><span>Select PHC Name</span></option>
                                            <?php
                                                for ($i = 0; $i < count($active_phc); $i++) {
                                            ?>
                                            <option value="<?= $active_phc[$i]['PhcId'] ?>"><?= $active_phc[$i]['PhcName'] ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-9 mx-auto">                                    
                                        <label class="control-label">Provider Name</label>
                                        <input type="text" name="providername" class="form-control" placeholder="Enter Provider Name" required></textarea>   
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-md-9 mx-auto">    
                                        <label class="control-label">Sex</label>                               
                                            <select required id="gender" name="gender" class="form-control">
                                                <option value="" disabled="" selected=""><span>Select Sex</span></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                    </div>
                                
                                    <div class="col-md-9 mx-auto">
                                        <label class="control-label">Age</label>                               
                                            <input type="number" name="age" class="form-control" placeholder="Enter Age" required></textarea>
                                    </div>
                                </div>          

                                <div class="form-group">
                                    <div class="col-md-9 mx-auto">                                       
                                        <label class="control-label">Service Type</label>
                                            <select required id="servicetype" name="servicetype" class="form-control">
                                                <option value="" disabled="" selected=""><span>Select Service</span></option>
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group">                                
                                    <div class="col-md-9 mx-auto">             
                                        <label class="control-label">Phone Number</label>                              
                                            <input type="text" name="phoneno" class="form-control" placeholder="Enter Provider Phone No" required></textarea>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <div class="col-md-9 mx-auto">                 
                                        <label class="control-label ">Email</label>                      
                                            <input type="text" name="emailid" class="form-control" placeholder="Enter Your Email" required></textarea>
                                    </div>                               
                                </div>

                            </div><!-- mx-auto ends -->
                        </div><!-- card ends -->
                        <hr>

                        <div class="card">
                            <div class="card-header">Place Info</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="col-md-9 mx-auto">                                       
                                            <label class="control-label ">State</label>
                                                <select required  id="StateId" name="StateId" class="form-control">
                                                    <option value="" disabled="" selected=""><span>Select State</span></option>
                                                    <?php
                                                    for ($i = 0; $i < count($active_state); $i++) {
                                                    ?>
                                                        <option value="<?= $active_state[$i]['StateId'] ?>"><?= $active_state[$i]['StateName'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                        </div>
        
                                        <div class="col-md-9 mx-auto">                                       
                                            <label class="control-label">District</label>
                                                <select required  id="DistrictId" name="DistrictId" class="form-control">
                                                    <option value="0" selected disabled>Select District </option>
                                                </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">        
                                        <div class="col-md-9 mx-auto">                                       
                                            <label class="control-label">Block</label>
                                                <select required  id="BlockId" name="BlockId" class="form-control">
                                                    <option value="" disabled="" selected=""><span>Select Block </span></option>
                                                </select>
                                        </div>
        
                                        <div class="col-md-9 mx-auto">                                       
                                            <label class="control-label">Land Mark</label>
                                                <input type="text" name="landmark" class="form-control" placeholder="Enter Land Mark" required></textarea>
                                        </div>
                                    </div>           
                                </div>
                            </div>
                            <hr>             

                        <div class="card">
                            <div class="card-header">Credentials Info</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="col-md-9 mx-auto">                                 
                                            <label class="control-label">User Id</label>
                                                <input type="text" name="userid" class="form-control" placeholder="Set Your Login Id" required></textarea>
                                        </div>

                                    <div class="col-md-9 mx-auto">                                       
                                        <label class="control-label ">Password</label>
                                            <input type="text" name="password" class="form-control" placeholder="Set Your Password" required></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <!-- Button -->
                                    <div class="">
                                        <button type="submit"id="registration_button" class="btn btn-primary float-right"><span class="glyphicon glyphicon-registration-mark"></span>&nbsp;Save Registration</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

    
        $("#StateId").on('change', function () {
            $('#DistrictId').children('option:not(:first)').remove();

            if ($(this).val() !== 0) {
                $.ajax({
                    url: "<?= base_url('Welcome/selectDistrictListByStateId') ?>",
                    data: {
                        stateId: $(this).val()
                    },
                    type: "POST",
                    success: function (json) {

                        var return_array = $.parseJSON(json);
                        if (return_array['success']) {
//                        $("#loading_district").css('display', 'none');
                            var district_object = return_array['districtInfo'];
                            for (var i = -0; i < district_object.length; i++) {
                                $("#DistrictId").append($("<option></option>").val(district_object[i]['DistrictId']).html(district_object[i]['DistrictName']));
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

            $("#DistrictId").on('change', function () {
            $('#BlockId').children('option:not(:first)').remove();

            if ($(this).val() !== 0) {
                $.ajax({
                    url: "<?= base_url('Welcome/selectBlockListByDistrictId') ?>",
                    data: {
                        districtId: $(this).val()
                    },
                    type: "POST",
                    success: function (json) {

                        var return_array = $.parseJSON(json);
                        if (return_array['success']) {
//                        $("#loading_district").css('display', 'none');
                            var district_object = return_array['blockInfo'];
                            for (var i = -0; i < district_object.length; i++) {
                                $("#BlockId").append($("<option></option>").val(district_object[i]['BlockId']).html(district_object[i]['BlockName']));
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
</script>