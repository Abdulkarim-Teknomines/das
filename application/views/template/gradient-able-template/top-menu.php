<nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="navbar-logo">
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="ti-menu"></i>
                            </a>
                            <!-- <div class="mobile-search">
                                <div class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter Keyword">
                                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <a href="<?php echo base_url('dashboard')?>">
                                <img class="img-fluid" src="<?php echo base_url()?>assets/images/logos.png" alt="Theme-Logo" />
                            </a>
                            <a class="mobile-options">
                                <i class="ti-more"></i>
                            </a>
                        </div>
                    </div>
                    <?php $admin_session = $this->session->userdata('admin_session');?>
                    <div class="col-lg-3">
                        <div class="navbar-container container-fluid">
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="<?php echo base_url()?>assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $admin_session->full_name;?></span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li>
                                            <a href="<?php echo base_url('settings')?>">
                                                <i class="ti-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('profile')?>">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                        
                                        <!-- <li>
                                            <a href="auth-lock-screen.html">
                                                <i class="ti-lock"></i> Lock Screen
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="<?php echo base_url('logout')?>">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="navbar-container container-fluid">
                            <ul class="nav-right">
                                <li><a href="<?php echo base_url();?>dashboard">DASHBOARD</a></li>
                                <li><a href="<?php echo base_url();?>patient">PATIENT</a></li>
                                <li><a href="<?php echo base_url();?>appointment">APPOINTMENT</a></li>
                                <!-- <li><a href="#">CLINICAL EXAMINATIONS</a></li> -->
                                <li><a href="<?php echo base_url();?>clinical_examinations">CLINICAL EXAMINATIONS</a></li>
                                <!-- <li><a href="#">LAB DETAILS</a></li> -->
                                <li><a href="<?php echo base_url();?>lab_details">LAB DETAILS</a></li>
                                <!-- <li><a href="#">TREATMENT</a></li> -->
                                <li><a href="<?php echo base_url();?>treatment">TREATMENT</a></li>
                                <li><a href="<?php echo base_url();?>education_videos">EDUCATION VIDEOS</a></li>
                                <!-- <li><a href="#">EDUCATION VIDEOS</a></li> -->
                                <li><a href="<?php echo base_url();?>other">OTHER</a></li>
                                <li><a href="<?php echo base_url();?>setup">SETUP</a></li>
                            </ul>
                        </div>
                    </div>
               </div>
            </div>
            </nav>