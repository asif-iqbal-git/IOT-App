<!DOCTYPE html>
<html lang="en">
    <head>
      

  

    <body> 
         <?php echo CI_VERSION; ?><br/>
        <?php
        // print_r($loginData);
        $loginData=$this->session->userdata('dootLoginDetails');
        var_dump($loginData);

       if(!isset($loginData['loginActive'])){
            $this->load->view('Ug/universallogin');
        }
        else{                   
            $this->load->view('Ug/universalheader');
            // $this->load->view('Ug/universalmenu');
            $this->load->view('Ug/universalmainbody');     
        }
        ?>
    </body>
 
 
</html>



