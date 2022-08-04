<!DOCTYPE html>
<html lang="en">
    <head>
        <h2>Assign Toys To Project Admin</h2>
        <style>
            #tbl{
                color: #000;
                background-color: #0093E9;
                background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 50%, #ffffff 100%);
            }
            
                         
         .btn-grad {
            background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA  51%, #77A1D3  100%);
            
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         #page{
            font-size: 1em;
         }
           
        </style>
    </head>
    <body>
    <div class="col-md-12 mt-3">
        <!-- Project Admin name dropdown -->
        <div class="row">
            <div class="col-md-2"><label class="float-right">Project Admin</label></div>
            <div class="col-md-4">
            <div class="form-group">
                <!-- <//?php print_r($projectAdminInfo); ?> -->
                <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                <select required id="projectAdminId" name="projectAdminId" class="form-control">
                    <option value="">Select Project Admin</option>
                 <?php foreach($projectAdminInfo as $value): ?>
                    <option value="<?php echo $value->auto_loginId ?>"> 
                        <?php echo $value->userId; ?></option>
                <?php endforeach ?>                                     
                </select>
            </div>
            </div>
            <div class="col-md-4">
            <button type="button" id="assignToPAdm_btn" class="btn btn-primary btn-grad">Assign to Project Admin</button>
            </div>
        </div>
        <!-- Table -->
        <table class="table table-bordered">
  <thead id="tbl">
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Token Id</th>
      <th scope="col">Toy Id</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

    <!-- output -->
  <tbody id="result">
</table>
  <!-- pagination -->  
  <span class="float-right">
  <a href="javascript:prevPage()"  class="btn btn-primary" id="btn_prev"><< Prev</a>
   &nbsp;&nbsp;&nbsp;
  <a href="javascript:nextPage()"  class="btn btn-primary" id="btn_next">Next >></a>
  </span>
  
  Page: <span id="page" class="badge badge-pill badge-info"></span>
    </div>


    <script>

        let json_data_obj;
        var all = [];
 
        function displayTable(){
            $.ajax({
                async: false,
                 url: "<?= base_url('Welcome/getTokenIdwithToysId') ?>",
                type: 'POST',
                data: {id: 0},
                 
                success: function(data, textStatus, jqXHR) {
                    //alert(data);  
                    var json_data = $.parseJSON(data);
  
                    json_data_obj = json_data; 
                  
                    json_table_template(json_data_obj,1);
                    numPages(json_data_obj);
                   
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  //console.log(textStatus, errorThrown);
                },
                
            });              
        }

         //  Sending Project-Admin-id with Assign token-id and toy-id
         //  table_name: tblAssignToyToProjectAdmin
        $("#assignToPAdm_btn").on('click',function(){
            
             
                var projectAdminId = $('#projectAdminId :selected').val();
                
        $.ajax({
                url: "<?= base_url('welcome/getProjectAdminIdWithToysTokenId') ?>",
                type: 'POST',
                data: {
                    projectAdminId:projectAdminId,
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {
                   alert(data); 
                    window.location = "<?= base_url("viewAssignToys"); ?>";               
                }
            })
        });

        // ---------------select Checkbox value---------------------
        $(document).on('change','input[type=checkbox]' ,function(){
        // checkedVal={};
        all=[];
        $('input[type=checkbox]:checked').each(function(){             
             
            all.push($(this).val());
            updateTokenStatus(all)
        });
        
        // console.log(all);
        //  alert(all);
        });

        //send Token id controller UpdateTokenStatus and set value 1 in table tbl_tokenMaster
     function updateTokenStatus(all){
          
            console.log(all);
            $.ajax({
                url: "<?= base_url('Welcome/setTokenStatus') ?>",
                type: 'POST',
                data: {                     
                    checked_id:all
                },
                success: function(data, textStatus, jqXHR) {
                   alert(data); 
                                 
                }
            })  
        }

       //--------------- Get Selected Value On-Change Dropdown -------------
       $(document).ready(function(){ 
            $('#projectAdminId').change(function(){ 
                var projectAdminId = $('#projectAdminId :selected').val();
                alert(projectAdminId);
            });
        });
   


        // -------------------------- Pagination -----------------------
        var current_page = 1;
        var records_per_page = 10;
 
        function prevPage()
        {
            if (current_page > 1) {
                current_page--;
                json_table_template(json_data_obj, current_page);
                 
            }
        }
       // let lastname = localStorage.getItem(key);
        function nextPage()
        {
         // console.log("nxt",json_data_obj);

            if (current_page < numPages(json_data_obj)) {
                current_page++;
                console.log(current_page)
                json_table_template(json_data_obj, current_page);
                 
            }
        }

      

        function json_table_template(json_data_obj, page)
        {
          var btn_next = document.getElementById("btn_next");
          var btn_prev = document.getElementById("btn_prev");
          // var listing_table = document.getElementById("listingTable");
          var page_span = document.getElementById("page");

        // Validate page
            if (page < 1) page = 1;
            if (page > numPages(json_data_obj)) page = numPages(json_data_obj);

            var htmlTemp = "";
            
            for(let i=(page-1)*records_per_page; i < (page * records_per_page) &&json_data_obj.length; i++)
            {                        
                htmlTemp += "<tr><td>"+json_data_obj[i]['tokenId']+"</td>"; 
                htmlTemp += "<td>"+json_data_obj[i]['toyId']+"</td>"; 
                htmlTemp += "<td>"+"<input class='chkbox' type='checkbox' value='ToyId-"+json_data_obj[i]['toyId']+"_TokenId-"+json_data_obj[i]['tokenId']+"' id='chkbox'>"+"</td></tr>"; 
            }

            document.getElementById("result").innerHTML = htmlTemp;

            page_span.innerHTML = page + " / " + numPages(json_data_obj);

            if (page == 1) {
                btn_prev.style.visibility = "hidden";
            } else {
                btn_prev.style.visibility = "visible";
            }

            if (page == numPages(json_data_obj)) {
                btn_next.style.visibility = "hidden";
            } else {
                btn_next.style.visibility = "visible";
            }
        }
        
        function numPages(json_data_obj)
        {
          //console.log(json_data_obj)
          //console.log("pg_num", Object.keys(json_data_obj).length);
            return Math.ceil(Object.keys(json_data_obj).length / (records_per_page));
        }

        //On load event- fetch all data from controller
        $(document).ready(function() {                    
          displayTable();
        });
          
        
       
    </script>
    </body>
</html>


