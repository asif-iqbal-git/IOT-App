<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="pic_trulli.jpg" alt="Italian Trulli"></div> -->
                            <div class="col-lg-6 d-none d-lg-block"><img src="<?php echo base_url('assets/Admin_assets/img/smp.png');?>" alt="Italian Trulli"></div>
                            <div class="col-lg-6">
                                <p>&nbsp;</p><p>&nbsp;</p>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to IOT-App</h1>
                                    </div>
                                    <form class="user" id="login_form_id" method="POST" action="<?= base_url('login') ?>"  name="Login_Form"  >
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="username"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                                <br>
                                                <span id="usernameError" style="color:red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                                <br>
                                                <span id="passwordError" style="color:red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="button" class="btn btn-primary btn-user btn-block" onclick="submit_login_form()" value="Login"/>
                
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>

        function validate_login(){

            var username = document.getElementById("exampleInputEmail").value;
            var inputPassword = document.getElementById("exampleInputPassword").value;
        
            if(validateEmail(username)){

                if(validatePassword(inputPassword)){

                    return true;
                }
            }
            else{
                return false;
            }
        }

        function validateEmail(username){
            var emailFormat = /([a-zA-Z0-9-]){3,15}$/g;
            if(username.match(emailFormat)){
                return true;
            }
            else{
                document.getElementById('usernameError').innerHTML = "Username is not valid!";
                document.getElementById('exampleInputEmail').focus();
                return false;
            }
        }

        function validatePassword(inputPassword){
            document.getElementById('usernameError').innerHTML = "";
            var passwordFormat = /([a-zA-Z0-9-]){3,15}$/g;
            if(inputPassword.match(passwordFormat)){
                return true;
            }
            else{
                document.getElementById('passwordError').innerHTML = "Password is not valid!";
                document.getElementById('exampleInputPassword').focus();
                return false;
            }

        }

        function submit_login_form(){
            if(validate_login()){
                document.getElementById('login_form_id').submit();
            }
        }

    </script>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->

</body>

</html>

















 

<!--
<div class = "container">
    <div class="wrapper">
        <form method="POST" action="<//?= base_url('login') ?>"  name="Login_Form" class="form-signin">       
            <h3 class="form-signin-heading">Welcome! Sign In</h3>
            <hr class="colorgraph"><br>
            <div class="row form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                    <input class="form-control" type="text" required placeholder="Username" name="username">
                </div>
            </div>
            <div class="row form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </div>
                    <input class="form-control" type="password" required name="password" placeholder="Password">
                </div>
            </div> 
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                <span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;LogIn</button>        
        </form>			
    </div>
</div>
<style>
    .wrapper {    
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .form-signin {
        max-width: 420px;
        padding: 30px 38px 66px;
        margin: 0 auto;
        background-color: #eee;
        border: 3px dotted rgba(0,0,0,0.1);  
    }

    .form-signin-heading {
        text-align:center;
        margin-bottom: 30px;
    }

    .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
    }
    .colorgraph {
        height: 7px;
        border-top: 0;
        background: #c4e17f;
        border-radius: 5px;
        background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
    }
</style>

-->










