<html>
    <head>
        <h3>View Assign Toys</h3>
        <style type="text/css">
            #show_result{
                font-size: 19px;
                text-align: center;
            }
            #NotFound{
                font-size: 39px;
                text-align: center;
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12">
       
      


    <div class="card">
        <div class="card-body">
        <div class="row">
            <!-- dropdown menu for project admin name -->
            <!-- <div class="col-md-2"><label class="float-right">Project Admin</label></div> -->
            <div class="col-md-4 mx-auto">
            <div class="form-group">
             
                <select required id="projectAdminId" name="projectAdminId" class="form-control">
                    <option value="">Select Project Admin</option>
                 <?php foreach($projectAdminInfo as $value): ?>
                    <option value="<?php echo $value->auto_loginId ?>"> 
                        <?php echo $value->userId; ?></option>
                <?php endforeach ?>                                     
                </select>
            </div>
            </div>             
        </div>
        <!--  -->
        <div class="mx-auto col-md-6">
            <div id="show_result"></div>
        </div>
        </div>
    </div>
</div>
  
<script>
    function displayToyTable(projectAdminId){
 
        $.ajax({
                async: false,
                url: "<?= base_url('Welcome/getSinglePAdminInfo') ?>",
                type: 'POST',
                data: {id: projectAdminId},
                 
                success: function(data, textStatus, jqXHR) {
                    alert(data);  //data return false if no data
                    var json_data = $.parseJSON(data);
                    // console.log(json_data);
                    json_data_obj = json_data; 
                    
                    // json_table_template(json_data_obj,1);
                    json_table_template(json_data_obj);
                    // numPages(json_data_obj);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                },
                
            });        
    }
     //--------------- Get Selected Value On-Change Dropdown -------------
     $(document).ready(function(){ 
            $('#projectAdminId').change(function(){ 
                var projectAdminId = $('#projectAdminId :selected').val();
                //alert(projectAdminId);
               
                displayToyTable(projectAdminId);
             
            });
        });
    
        
        // 
        function json_table_template(json_data_obj)
        {
             
        //    alert((json_data_obj).length);
        if(json_data_obj == false){
            document.getElementById("show_result").innerHTML = "<div id='NotFound'>No Data Found..!</div>";
        }else{
        
        var htmlTemp = "";
        // Object.keys(json_data_obj).length
        for(var i=0; i < json_data_obj.length; i++)
        {
            //convert array to string
            let subData=JSON.parse(json_data_obj[i]['AssignToyToPAdmin']);
          
            for(var j=0; j < subData.length; j++)
            {
              //  console.log("val",subData[j]);                  
              htmlTemp += "<div class='card bg-info text-white mt-2 mb-2 pt-2 pb-2'>"+subData[j].replaceAll('_', '  ,  ')+"</div>"; 
            //   console.log(subData[j].replaceAll('_', ' ').toUpperCase());
             console.log((subData[j]));
            }
            
        }
        // console.log(json_data_obj[0]['AssignToyToPAdmin']);
        document.getElementById("show_result").innerHTML = htmlTemp;
    }
        

     
        }    
</script>
</body>
</html>