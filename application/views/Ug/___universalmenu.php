<style>    
    .dropdown:hover .dropdown-menu {
        display: block;
        left: 0px;

    }
    .affix {
        top: 0;
        width: 100%;
        z-index: 50;

    }
    .affix + .container-fluid {
        padding-top: 70px;
    }
</style>

<div class="container-fluid " data-spy="affix">
    <div class="row-fluid bg-info" >
        <nav class="navbar navbar-danger" >

            <div class="navbar-header">
                <button type="button" class="navbar-toggle"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar bg-warning">Menu</span>
                    <span class="icon-bar bg-warning"></span>
                    <span class="icon-bar bg-warning"></span>
                </button>
                <?php
                $user_details = $this->session->userdata('dootLoginDetails');
                if (isset($user_details['level']) == '0') {
                    ?>
                    <div class="collapse navbar-collapse"  id="bs-example-navbar-collapse-1">
                        <ul class="nav  navbar-nav navbar-right">

                          <!--   <li><a href="<?= base_url() ?>"> <strong>Home</strong></a></li>  -->

                            <!--                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Question View</strong></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="<?= base_url('index.php/welcome/questionViewEnglish') ?>"><strong>English Question</strong></a></li>
                                                            <li><a href="<?= base_url('index.php/welcome/questionViewHindi') ?>"><strong>Hindi Question</strong></a></li>
                                                            
                            
                                                        </ul>
                                                    </li>-->

                       <!--     <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Toy data</strong></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url() ?>"><strong>Toys Info</strong></a></li>
                                    <li><a href="<?= base_url() ?>"><strong>Toys Assign to Phc</strong></a></li>


                                </ul>
                            </li>
                            -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Token data</strong></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url('tokeninfo') ?>"><strong>Tokens Info</strong></a></li>
                                    <li><a href="<?= base_url('assigntokens') ?>"><strong>Assign to Provider</strong></a></li>
                                </ul>
                            </li>
                            
                           <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Child data</strong></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url('childdata') ?>"><strong>Child Info</strong></a></li>
<!--                                    <li><a href="<?= base_url() ?>"><strong></strong></a></li>-->
                                </ul>
                            </li>  

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Communication data</strong></a>
                                <ul class="dropdown-menu">
                                   
                                    <li><a href="<?= base_url('childCommunication') ?>"><strong> Child Communication</strong></a></li>


                                </ul>
                            </li>
                            
    <!--                    <li><a href="<//?= base_url('index.php/welcome/gameScore') ?>"><strong>Game Score</strong></a></li>-->
                            <li><a href="<?= base_url('providerregister') ?>"><strong>Provider Regiteration</strong></a></li>
                            <li><a href="<?= base_url('vaccineplanner') ?>"><strong>Vaccine Planner</strong></a></li>
                            <li><a href="<?= base_url('about') ?>"><strong>About - Us</strong></a></li>
                        </ul> 
                    </div>
                    <?php
                }
                ?> 
            </div>


            <?php
            $user_details = $this->session->userdata('dootLoginDetails');
            if(isset($user_details['level'])){
            if ($user_details['level'] == '0') {
                ?>
                <div class="collapse navbar-collapse"  id="bs-example-navbar-collapse-1">
                    <ul class="nav  navbar-nav navbar-right">

                        <li><a href="<?= base_url('logout') ?>" class="btn btn-login" role="button"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;LogOut</a></li>

                    </ul> 

                </div>
                <?php
                }
            }
            ?> 

        </nav>
    </div>
</div>