
/**
 * Startin Point "patient_registration_form_dmc"
 * java script for patient registration
 * at dmc for sputum testing.
 * 
 */
$(function () {
    $('form').submit(function () {
        $("#registration_button").prop("disabled", true);
    });
    $("#stateid").on('change', function () {
        $('#districtId').children('option:not(:first)').remove();
        $('#blockId').children('option:not(:first)').remove();
        $('#villageId').children('option:not(:first)').remove();
        $("#loading_district").css('display', 'block');
        if ($(this).val() !== 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/selectDistrictListByState',
                data: {
                    stateId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
                        $("#loading_district").css('display', 'none');
                        var district_object = return_array['districtInfo'];
                        for (var i = -0; i < district_object.length; i++) {
                            $("#districtId").append($("<option></option>").val(district_object[i]['id']).html(district_object[i]['city_name']));
                        }
                    } else {
                        $("#loading_district").css('display', 'none');
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
    /**
     * This function return block with in district.
     * 
     */
    $("#districtId").on('change', function () {
        $('#blockId').children('option:not(:first)').remove();
        $('#villageId').children('option:not(:first)').remove();
        $("#loading_block").css('display', 'block');
        $('#blockId').select();
        if ($(this).val() !== 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/selectBlockListByDistrict',
                data: {
                    districtId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
                        $("#loading_block").css('display', 'none');
                        var block_object = return_array['blockInfo'];
                        for (var i = -0; i < block_object.length; i++) {
                            $("#blockId").append($("<option></option>").val(block_object[i]['blockId']).html(block_object[i]['blockName']));
                        }
                    } else {
                        $("#loading_block").css('display', 'none');
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
    /**
     * 
     * 
     * 
     * 
     */
    $("#blockId").on('change', function () {
        $('#phiId').children('option:not(:first)').remove();
        $('#villageId').children('option:not(:first)').remove();
        
        $('#phiId').select();
        $("#loading_phi").css('display', 'block');
        if ($(this).val() !== 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/getPhi',
                data: {
                    blockId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array) {
                        
                        $("#loading_phi").css('display', 'none');
                        
                        for (var i = 0; i < return_array.length; i++) {
                            $("#phiId").append($("<option></option>").val(return_array[i]['auto_id']).html(return_array[i]['phiName']));
                        }
                    } else {
                        $("#loading_village").css('display', 'none');
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
    /**
     * 
     * @returns {undefined}
     * 
     * 
     * 
     * 
     */
    $("#phiId").on('change', function () {
        
        $('#villageId').children('option:not(:first)').remove();
        
        $('#villageId').select();
        $("#loading_village").css('display', 'block');
        if ($(this).val() !== 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/getVillage',
                data: {
                    phiId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array) {
                        
                        $("#loading_village").css('display', 'none');
                        
                        for (var i = 0; i < return_array.length; i++) {
                            $("#villageId").append($("<option></option>").val(return_array[i]['autoId']).html(return_array[i]['villageName']));
                        }
                    } else {
                        $("#loading_village").css('display', 'none');
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
/*
 * end point "patient_registration_form_dmc".
 * 
 * 
 * 
 * ***********************************************************************************
 * 
 * This javascript start for patient sputum submit.
 * 
 * 
 */
$(function () {


    $('form').submit(function () {
        $("#sputum_submit").prop("disabled", true);
    });
    
    
    $("#patient_id").on('change', function () {
        $("#loading_detail").css('display', 'block');
        if ($(this).val() != 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/fetchPatientDetails',
                data: {
                    tbPatientPartialRegistrationId: $(this).val()
                },
                type: "POST",
                success: function (json) {
                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
                        $("#message_body").css('display','none');                       
                        $("#sputum_submit").prop('disabled', false);
                        $("#loading_detail").css('display', 'none');
                        $("#patient_name").text(return_array['patientName']);
                        $("#state_name").text(return_array['state_name']);
                        $("#complete_address").text(return_array['completeAddress']);
                        $("#district_name").text(return_array['city_name']);
                        $("#block_name").text(return_array['blockName']);
                        $("#village_name").text(return_array['villageName']);
                        $("#total_counter").val(return_array['totalTestCounter']);
                    } else {
                        $("#message_body").css('display','block');
                        
                        $("#sputum_submit").prop('disabled', true);    
                        $("#error_message").text(return_array['message']);
                        $("#loading_detail").css('display', 'none');
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
/*
 * end javascript for patient sputum submit.
 * 
 * 
 * 
 * ******************************************************
 * Start javascript for sputum result view.  
 * 
 * 
 */
$(function () {

    $("#patiend_id").on('change', function () {

        if ($(this).val() != 0) {
            $.ajax({
                url: get_base_url() + 'DMC_controller/fetchPatientDMCDetails',
                data: {
                    tbPatientPartialRegistrationId: $(this).val()
                },
                type: "POST",
                success: function (json) {

                    var return_array = $.parseJSON(json);
                    if (return_array['success']) {
                        $('#patient_name').text(return_array['patientName']);
                        $('#state_name').text(return_array['state_name']);
                        $('#district_name').text(return_array['city_name']);
                        $('#block_name').text(return_array['blockName']);
                        $('#village_name').text(return_array['villageName']);
                        $('#complete_address').text(return_array['completeAddress']);
                        var scanty = '';
                        for (var i = 0; i < return_array['patientInformation'].length; i++) {
                            var psitive3 = '';
                            var psitive2 = '';
                            var psitive1 = '';
                            if (return_array['patientInformation'][i]['scanty'] != null) {
                                scanty = return_array['patientInformation'][i]['scanty'];
                            }
                            switch (return_array['patientInformation'][i]['positiveGrading']) {
                                case "1":
                                    psitive1 = 'Yes';
                                    psitive2 = '';
                                    psitive3 = '';
                                    break;
                                case "2":
                                    psitive2 = 'Yes';
                                    psitive3 = '';
                                    psitive1 = '';
                                    break;
                                case "3":
                                    psitive3 = 'Yes';
                                    psitive2 = '';
                                    psitive1 = '';
                                    break;
                            }
                            $("#test_result_report tbody").append('<tr><td>' + (i + 1) + '</td><td>' + return_array['patientInformation'][i]['dateOfExamination'] + '</td><td>' + return_array['patientInformation'][i]['specimen'] + '</td><td>' + return_array['patientInformation'][i]['visualAppearance'] + '</td>vvvv<td>' + return_array['patientInformation'][i]['result'] + '</td><td>' + psitive3 + '</td><td>' + psitive2 + '</td><td>' + psitive1 + '</td><td>' + scanty + '</td></tr>');
                        }
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
/*
 * end of javascript.
 * 
 * 
 * 
 * *********************************************
 * Start of java script patient result of sputum.
 */
$(function () {
    $('form').submit(function () {
        $("#sputum_result").prop("disabled", true);
    });
    $('#sputum_number').on('change', function () {

        $.ajax({
            url: get_base_url() + 'DMC_controller/getresult',
            data: {
                sputum_partial_id: $(this).val()
            },
            type: "POST",
            success: function (json) {
                var return_array = $.parseJSON(json);
                $('#next_previous_result').val(return_array['result']);
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

    });
    $("#patiend_partial_id").on('change', function () {
        var patient_partial_id = $(this).val();
        $('#loading_name').css('display', 'block');
        $('#loading_date').css('display', 'block');
        $.ajax({
            url: get_base_url() + 'DMC_controller/getPatientDetailsSubmitResult',
            data: {
                tbPatientPartialRegistrationId: patient_partial_id
            },
            type: "POST",
            success: function (json) {
                var return_array = $.parseJSON(json);
                if (return_array['success']) {

                    $("#patient_name").val(return_array['patientName'] + ' (' + return_array['testStatusFlag'] + '/' + return_array['totalTestCounter'] + ')');
                    if (return_array['tbPatientId'] !== null) {
                        $("#patient_id").val(return_array['tbPatientId']);
                    }
                    if (return_array['patientCategory'] !== null) {
                        $("#patient_category").val(return_array['patientCategory']);
                    }
                    if (return_array['patientCurrentPhase'] !== null) {
                        $("#patient_current_phase").val(return_array['patientCurrentPhase']);
                    }
                    if (return_array['testStatusFlag'] !== null) {
                        $("#patient_status_flag").val(return_array['testStatusFlag']);
                    }

                    if (return_array['patient_sputum']) {
                        $("#sputum_result").prop('disabled',false);
                        $("#sputum_number").prop('disabled', false);
                        $("#error_message").css('display','none');
                        for (var i = 0; i < return_array['patient_sputum'].length; i++) {
                            $("#sputum_number").append($("<option></option>").val(return_array['patient_sputum'][i]['SputumTestCounter'] + ":" + patient_partial_id).html('(' + return_array['patient_sputum'][i]['SputumTestCounter'] + ') ' + return_array['patient_sputum'][i]['SputumTakenDate']));
                        }
                    }else{
                        $("#error_message").css('display','block');
                        $("#message").text('All sputum result is submited');
                        $("#sputum_result").prop('disabled',true);
                        //some work here;
                    }
                    $('#loading_name').css('display', 'none');
                    $('#loading_date').css('display', 'none');
                } else {
                    $('#loading_name').css('display', 'none');
                    $('#loading_date').css('display', 'none');
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
    });

    $("#result").on('change', function () {

        if ($(this).val() == 'positive') {

            $("#radio_button").css("display", "block");
        } else {

            $("#radio_button").css("display", "none");
        }
    });

    $("#patient_partial_id_mophi").on('change', function () {
        $('#patientPhoneLoading').css('display','block');
        $("#guardianPhoneLoading").css('display','block');
        $("#guardianNameLoading").css('display','block');
        $("#relatioshipLoading").css('display','block');

        $.ajax({
            url: get_base_url() + 'DMC_controller/getPartialPatient',
            data: {
                tbPatientPartialRegistrationId: $(this).val()
            },
            type: "POST",
            success: function (json) {
                $('#patientPhoneLoading').css('display','none');
        $("#guardianPhoneLoading").css('display','none');
        $("#guardianNameLoading").css('display','none');
        $("#relatioshipLoading").css('display','none');
                var return_array = $.parseJSON(json);
                $('#patientPhone').val(return_array[0]['Phonenumber']);
                $("#guardianPhone").val(return_array[0]['guardian_phone_number']);
                $("#guardianName").val(return_array[0]['guardian_name']);
                $('#relatioship option[value="' + return_array[0]['relationship_id'] + '"]').prop('selected', true);
            },
            error: function (xhr, status, errorThrown) {
                $('#patientPhoneLoading').css('display','none');
        $("#guardianPhoneLoading").css('display','none');
        $("#guardianNameLoading").css('display','none');
        $("#relatioshipLoading").css('display','none');
                alert("Sorry, there was a problem!");
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            },
            complete: function (xhr, status) {
                $('#patientPhoneLoading').css('display','none');
        $("#guardianPhoneLoading").css('display','none');
        $("#guardianNameLoading").css('display','none');
        $("#relatioshipLoading").css('display','none');
            }
        });
    });
});

//$(function () {
//    $('#stateid').on('change', function () {
//        var data1 = JSON.stringify({'bob': 'foo', 'paul': 'dog'});
//        $.ajax({
//            
//            url: get_base_url() + 'DMC_controller/test',
//            type:'POST',
//            data:{bob: data1},        
//            success: function (json) {
//                alert('welcome');
//            }
//        });
//
//    });
//
//});


/**
 * 
 * @returns {String}
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


var ajax_request = function () {
    $.ajax({
        url: get_base_url() + 'DMC_controller/test',
        type: 'POST',
        data: {'name': 'abdul muttalib'},
        success: function (return_data, textStatus, jqXHR) {
            alert('welcome to you');
            console.log(return_data);
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }

    });
}
/**
 * 
 * 
 * 
 * 
 */
$(document).ready(function () {
    $('#tb_unit').on('change', function () {
        $("#get_patient").prop("disabled", false);
        $("#tb_patient").prop("disabled", true);


    });

//    $('#get_patient').on('click', function () {
//
//        $('#loading_patient').css('display', 'block');       
//        $("#get_patient").prop("disabled", true);
//
////        $.ajax({
////            url: get_base_url() + 'DTOController/getPatientHistoryByTbUnitId',
////            data: {tb_unit_id: $("#tb_unit option:selected").val()},
////            type: 'POST',
////            success: function (data) {
////                $('#loading_patient').css('display', 'none');
////                var patients = $.parseJSON(data);
////                if (patients != null) {
////
////                    $("#tb_patient").prop("disabled", false);
////                    $("#patient_history tbody tr").remove();
////                    if (patients['username'] == 'ZDTO1') {
////                        for (var i = 0; i < patients['history'].length; i++) {
////
////                            var date1 = new Date(patients['history'][i].complianceDate);
////                            var patient_dose_taken_date = myDateFormatter(date1);
////                            var complete_url = null;
////                            var a = null;
////                            if (patients['history'][i].comlianceURL != null && patients['history'][i].comlianceURL != '' && patients['history'][i].comlianceURL != 'dots' && patients['history'][i].comlianceURL != 'NULL') {
////                                complete_url = get_mobile_base_url() + patients['history'][i].comlianceURL;
////                                a = '<a href="' + complete_url + '" onclick="return newWindowOpen(this)"><span class="glyphicon glyphicon-play-circle"></span></a>';
////                            } else {
////                                a = 'No Video'
////                            }
////
////                            $("#patient_history tbody").append(
////                                    '<tr>\n\
////                                  <td class="col-lg-3">' + patients['history'][i].patientName + '</td>\n\
////                                  <td class="col-lg-3">' + patient_dose_taken_date + '</td>\n\
////                                  <td class="col-lg-3">' + patients['history'][i].complianceMode + '</td>\n\\n\
////                                  <td class="col-lg-3">' + a + '</td>\n\
////                                 </tr>');
////                        }
////                    } else {
////                        for (var i = 0; i < patients['history'].length; i++) {
////
////                            var date1 = new Date(patients['history'][i].complianceDate);
////                            var patient_dose_taken_date = myDateFormatter(date1);
////                            var complete_url = null;
////                            var a = null;
////                            if (patients['history'][i].comlianceURL != null && patients['history'][i].comlianceURL != '' && patients['history'][i].comlianceURL != 'dots' && patients['history'][i].comlianceURL != 'NULL') {
////
////                                a = 'Video';
////                            } else {
////                                a = 'No Video'
////                            }
////
////                            $("#patient_history tbody").append(
////                                    '<tr>\n\
////                                  <td class="col-lg-3">' + patients['history'][i].patientName + '</td>\n\
////                                  <td class="col-lg-3">' + patient_dose_taken_date + '</td>\n\
////                                  <td class="col-lg-3">' + patients['history'][i].complianceMode + '</td>\n\\n\
////                                  <td class="col-lg-3">' + a + '</td>\n\
////                                 </tr>');
////                        }
////                    }
////
////                }
////            }
////        });
//    });

});
/**
 * 
 * @returns {String}
 * 
 * 
 */
$(document).ready(function () {
    $("#tb_patient").on("change", function () {
        $('#loading_patient_select').css('display', 'block');
        $.ajax({
            url: get_base_url() + 'DTOController/getPatientHistoryByPatientId',
            type: 'POST',
            data: {'patient_id': $("#tb_patient option:selected").val()},
            success: function (data) {
                $('#loading_patient_select').css('display', 'none');
                $("#patient_history tbody tr").remove();
                var patients = $.parseJSON(data);
                if (patients != null) {
                    if (patients['username'] == 'ZDTO1') {
                        for (var i = 0; i < patients['history'].length; i++) {

                            var date1 = new Date(patients['history'][i].complianceDate);
                            var patient_dose_taken_date = myDateFormatter(date1);
                            var complete_url = null;
                            var a = null;
                            if (patients['history'][i].comlianceURL != null && patients['history'][i].comlianceURL != '' && patients['history'][i].comlianceURL != 'dots' && patients['history'][i].comlianceURL != 'NULL') {
                                complete_url = get_mobile_base_url() + patients['history'][i].comlianceURL;
                                a = '<a href="' + complete_url + '" onclick="return newWindowOpen(this)"><span class="glyphicon glyphicon-play-circle"></span></a>';
                            } else {
                                a = 'No Video'
                            }

                            $("#patient_history tbody").append(
                                    '<tr>\n\
                                  <td class="col-lg-3">' + patients['history'][i].patientName + '</td>\n\
                                  <td class="col-lg-3">' + patient_dose_taken_date + '</td>\n\
                                  <td class="col-lg-3">' + patients['history'][i].complianceMode + '</td>\n\\n\
                                  <td class="col-lg-3">' + a + '</td>\n\
                                 </tr>');
                        }
                    } else {
                        for (var i = 0; i < patients['history'].length; i++) {

                            var date1 = new Date(patients['history'][i].complianceDate);
                            var patient_dose_taken_date = myDateFormatter(date1);
                            var complete_url = null;
                            var a = null;
                            if (patients['history'][i].comlianceURL != null && patients['history'][i].comlianceURL != '' && patients['history'][i].comlianceURL != 'dots' && patients['history'][i].comlianceURL != 'NULL') {

                                a = 'Video';
                            } else {
                                a = 'No Video'
                            }

                            $("#patient_history tbody").append(
                                    '<tr>\n\
                                  <td class="col-lg-3">' + patients['history'][i].patientName + '</td>\n\
                                  <td class="col-lg-3">' + patient_dose_taken_date + '</td>\n\
                                  <td class="col-lg-3">' + patients['history'][i].complianceMode + '</td>\n\\n\
                                  <td class="col-lg-3">' + a + '</td>\n\
                                 </tr>');
                        }
                    }
                }

            }
        });
    });
});

/**
 * 
 * @returns {String}
 * 
 * 
 * 
 * 
 * 
 * 
 */
function selectPatient() {

}

function newWindowOpen(href_ull) {
    window.open(href_ull.href, 'mywin', 'left=400,top=10,width=350,height=300,toolbar=1,resizable=0 _self');
    return false;
}

function myDateFormatter(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "-" + month + "-" + year;
    return date;
}

function get_base_url() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + '/';
    return base_url;
}
function get_mobile_base_url(){
     var url='http://connect2mfi.org/TB_platform/';
    return url;
}



