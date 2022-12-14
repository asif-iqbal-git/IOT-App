<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IOT App</title>
<?php $user_details = $this->session->userdata('dootLoginDetails');

//print_r($user_details);

?>
    <!-- Custom fonts for this template-->
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">IOT App</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard--</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

             <!-- Nav Item - SuperAdmin Menu - Company Setup -->
             <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '0' || $user_details['level'] == '1') {
                    ?>
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_company"
                    aria-expanded="true" aria-controls="collapse_company">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Company Setup</span>
                </a>
                <div id="collapse_company" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="<?= base_url('createCompany') ?>">Create Company</a>
                        <!-- <a class="collapse-item" href="<//?= base_url('createCompanyAdmin') ?>">Create Company Admin</a> -->
                    </div>
                </div>
                <?php
                 } }
                ?> 
            </li>
            
              <!-- Nav Item - Company Menu - Project Setup -->
              <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '1') {
                    ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_company_admin"
                    aria-expanded="true" aria-controls="collapse_company_admin">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Project Setup</span>
                </a>
                <div id="collapse_company_admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="<?= base_url('createProject') ?>">Create Project</a>
                        <!-- <a class="collapse-item" href="<//?= base_url('createProjectAdmin') ?>">Create Project Admin</a> -->
                    </div>
                </div>
                <?php
                 } }
                ?> 
            </li>

            <!-- Nav Item - SuperAdmin Menu - Project Setup -->
               <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '1') {
                    ?>
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_S_admin1"
                    aria-expanded="true" aria-controls="collapse_S_admin1">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Assign Toys</span>
                </a>
                <div id="collapse_S_admin1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="<?= base_url('assignToysToProjectAdmin') ?>">Assign Project Admin</a>
                        
                        <a class="collapse-item" href="<?= base_url('assignToysToProjectAdmin') ?>">--Menu--</a>
                    </div>
                </div>
                <?php
                 } }
                ?> 
            </li>

  <!-- Nav Item - Company Menu - Project Setup -->
            <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '1') {
                    ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_c_admin"
                    aria-expanded="true" aria-controls="collapse_c_admin">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Project Info</span>
                </a>
                <div id="collapse_c_admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="<?= base_url('projectStatus') ?>"> Project Status</a>
                        <!-- <a class="collapse-item" href="<//?= base_url('createProjectAdmin') ?>">Create Project Admin</a> -->
                    </div>
                </div>
                <?php
                 } }
                ?> 
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '1') {
                    ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Token data</span>
                </a>
                 
              
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="<?= base_url('tokeninfo') ?>">Token Info</a>
                        <a class="collapse-item" href="<?= base_url('assigntokens') ?>">Assign to Provider</a>
                    </div>
                </div>
                <?php
                 } }
                ?> 
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Child Data</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                        <a class="collapse-item" href="<?= base_url('childdata'); ?>">Child Info</a>
                         
                    </div>
                </div>
            </li>

               

             <!-- Nav Item - Communication Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities1">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Communication Data</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="<?= base_url('childCommunication'); ?>">
                        child Communication
                    </a>                         
                    </div>
                </div>
            </li>
           
            <!-- Nav Item - Provider -->
            <?php $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level'])){
                    if($user_details['level'] == '1') {
                    ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('providerregister'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Provider Regiteration</span></a>
            </li>
            <?php
                 } }
                ?> 
            <!-- Nav Item - Vaccine Planner-->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('vaccineplanner'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Vaccine Planner</span></a>
            </li>

                <!-- Nav Item - Vaccine Planner-->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('viewAssignToys'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>View Assign Toys</span></a>
            </li>


             <!-- Nav Item - About Us -->
             <li class="nav-item">
                <a class="nav-link" href="<?= base_url('about'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>About Us</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            
            

       
        

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                     
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <?php if(isset($user_details['level'])){
                                if ($user_details['level'] == '0') {
                        ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Super Admin   
                                | <?php print_r($user_details['username']); ?> </span>
                                <!-- <img class="img-profile rounded-circle"
                                    src=<//?= base_url('assets/Admin_assets/vendor/img/undraw_profile.svg'); ?>"> -->
                            </a>
                            <? }} ?>

                            <?php if(isset($user_details['level'])){
                                if ($user_details['level'] == '1') {
                        ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> 
                                Company Admin 
                                | <?php print_r($user_details['username']); ?> </span>
                                <!-- <img class="img-profile rounded-circle"
                                    src=<//?= base_url('assets/Admin_assets/vendor/img/undraw_profile.svg'); ?>"> -->
                            </a>
                            <? }} ?>

                            <?php if(isset($user_details['level'])){
                                if ($user_details['level'] == '2') {
                        ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Project  Admin   
                                | <?php print_r($user_details['username']); ?> </span>
                                <!-- <img class="img-profile rounded-circle"
                                    src=<//?= base_url('assets/Admin_assets/vendor/img/undraw_profile.svg'); ?>"> -->
                            </a>
                            <? }} ?>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div> -->
                             
                                
                                <?php 
                                $user_details = $this->session->userdata('dootLoginDetails');
                                // print_r($user_details);
                                if(isset($user_details['level'])){
                                if ( $user_details['level'] == '0' || $user_details['level'] == '1' || $user_details['level'] == '2' || $user_details['level'] == '3') {
                                    ?>
                                    <a class="dropdown-item" href="<?= base_url('logout') ?>"  >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                -> Logout
                                </a>  
                                <?php } } ?> 
                                
                                 
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid"> -->

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Welcome to IOT App</h1> -->

                <!-- </div> -->
                <!-- /.container-fluid -->

          
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>