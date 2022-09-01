<!DOCTYPE html>
<html lang="en">
    <head>
      

  

    <body> 
         <!-- <//?php echo CI_VERSION; ?><br/> -->
        <?php
        // print_r($loginData);
        // $loginData=$this->session->userdata('dootLoginDetails');
        //var_dump($isActive);
        $this->load->view('libs');
        // if(isset($ErrorLogin))
        // {
        //     echo $ErrorLogin;
        // }
        // if(isset($EmptyString))
        // {
        //     echo $EmptyString;
        // }
        // if(isset($userInactive))
        // {
        //     echo $userInactive;
        // }
        
       if(!isset($isActive)){
            $this->load->view('Ug/universallogin');
        }
        else{                   
            // $this->load->view('Ug/universalheader',$ErrorLogin,$EmptyString,$userInactive);
            $this->load->view('Ug/universalheader');
            // $this->load->view('Ug/universalmenu');
            $this->load->view('Ug/universalmainbody');     
        }
        ?>
    </body>
 
 
</html>



