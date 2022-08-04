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
                <h4 class="text-center">IOT Gameing Question Answer List</h4>
            </div>
    <div class="panel-body">

                <table id="questionTable" class="table table-hover table-fixed " style="margin-top: 20px">
                    <thead>
                        <tr>
                            <th class="col-lg-1">Question No.</th>
                            <th class="col-lg-1"> Question</th>
                            <th class="col-lg-2">Option A</th>
                            <th class="col-lg-2">Option B</th>
                            <th class="col-lg-2">Option C</th>
                            <th class="col-lg-2">Option D</th>
                            <th class="col-lg-2">Right Answer</th> 
                            
                          
                        </tr>

                    </thead>
                    <tbody>
                         
                        
                        
                    </tbody>
                </table> 

            

    </div>

</div>


<script type="text/javascript">
    
     function get_mobile_base_url() {
       var url="<?= base_url() ?>";           
//        var url = base_url + 'Uganda/';
        return url;
    }
    function playVideo(object) {
        window.open(object['attributes'][2]['value'], 'mywin', 'left=400,top=10,width=350,height=300,toolbar=1,resizable=0 _self');
        return false;
    }
 $(document).ready(function () {
     
 $("#questionTable tbody tr").remove();    
     
     $.ajax({
            url: "<?= base_url('index.php/welcome/getQuestionAnswerAudioData') ?>",               
                data: {},
                type: 'POST',
                success: function (data) {
                    var rturn_data = JSON.parse(data);
                   
                    if (rturn_data) {
                        
                        if (rturn_data['q_data']) {
                            for (var i = 0; i < rturn_data['q_data'].length; i++) {
                                 $("#questionTable tbody").append('<tr></tr>');
                                $("#questionTable tbody tr:last").append('<td class="text-center col-lg-1">' + rturn_data['q_data'][i]['Name'] + '</td>')
                                for(var j=1;j<=6;j++)
                                {
           var $d=get_mobile_base_url() + rturn_data['q_data'][i]['AudioUrl'] +'QE'+(parseInt(i) + 1)+j+'.mp3';                     
           if(j<=1)
               {
        $("#questionTable tbody tr:last").append('<td class="text-center col-lg-1"><button class="btn btn-primary btn-xs" onclick="playVideo(this)" value='+$d+'><span class="glyphicon glyphicon-play"></span></button></p></td>');
          } 
          else
              {
              $("#questionTable tbody tr:last").append('<td class="text-center col-lg-2"><button class="btn btn-primary btn-xs" onclick="playVideo(this)" value='+$d+'><span class="glyphicon glyphicon-play"></span></button></p></td>');     
                  
              }
          
          
          }
      $("#questionTable tbody").append('<tr></tr>');
                            }
                        }

                    }
                   
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#loading_padient_edit_id').css('display', 'none');
                },
                complete: function (jqXHR, textStatus) {
                    $('#loading_padient_edit_id').css('display', 'none');
                }
            });
     
     
     
     
     
     
});
</script>
