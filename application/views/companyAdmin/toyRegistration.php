<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        li{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Toy Registration</h2>
     
     <div class="alert alert-warning alert-dismissible fade show col-md-9 mx-auto" role="alert">
        It Will Generate 10 Toys
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

     <div class="">
        <button type="button" class="btn btn-primary ml-4" id="generate_toy" type="submit">Generate ZMQ Toy</button>
     </div>
    
     <div id="show_toys" class="mx-auto col-md-4"></div>

     <script>
        //  Sending ZMQ Token id with zmq-toy
        $("#generate_toy").on('click',function(){
             
            $.ajax({
                url: "<?= base_url('StaffController/generateZMQToys') ?>",
                type: 'POST',
                data: {
                    flag:1,                    
                },
                success: function(data, textStatus, jqXHR) {
                  // alert(data);  
                //   data = data.replace(/[[{"} ]/g, "")
                //   data = data.replace(/[\] ]/g, "")
                //   data = data.replace(/[,]/g, "<br>")
                var toyName = document.getElementById('show_toys');
                  var array = JSON.parse("[" + data + "]");
                  for(var i=0; i < array[0].length; i++){
                    
                    data = JSON.stringify(array[0][i])
                    data = data.replace(/[[{"} ]/g, "");
                    
                    toyName.innerHTML += `<ul class="list-group">
                                <li class="list-group-item mt-1">${data}
                                    </li></ul>`;
                  }    
                }
            })
        });
     </script>
</body>
</html>