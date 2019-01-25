<!DOCTYPE html>
<html lang="en">
    <head>      
        <!-- META SECTION -->
        <title><?php if(isset($title)){ echo $title;} else {echo 'Demo';} ?></title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />        
        <link rel="SHORTCUT ICON" href="{{ asset('Admin_assest/favicon.png') }}" type="image/png">
        <script type="text/javascript">var site_url = '<?php echo url('/'); ?>';</script>
       
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->     
        <link rel="stylesheet" href="{{ asset('Admin/css/AdminLTE.min.css') }}">        

        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('Admin_assest/css/theme-default.css') }}">


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
        <!-- EOF CSS INCLUDE -->  

        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/jquery/jquery.min.js')}}"></script>  
    </head>
        <style>
            .dt-button{          /* Css for excel button */
            font-size: 13px !important;
            background: brown !important;
            color: white !important;
            }
        </style>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- START PAGE SIDEBAR -->
             <!--?php if($this->session->userdata('status')=='admin'){ ?-->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="<?php echo url('/'); ?>">Dashboard</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                           
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                               
                          </div>
                            <div class="profile-data">
                               <div class="profile-data-name">Demo</div>
                            </div>
                         </div>                                                                     
                    </li>
                    
                    <li class="xn-openable <?php if(isset($page) && $page=='two'){ echo 'active';}?>">
                        <a href="<?php echo url('Home/userlist');?>"><span class="fa fa-user"></span> <span class="xn-text">Manage Customers</span><label class="badge" id="rowcount1" style="background-color:green !important; margin-left: 10px; border-radius:90% !important"></label></a>
                        <ul>
                            <li><a href="<?php echo url('add_customer');?>"><span class="fa fa-pencil"></span>Add Customer</a></li>
                            <li><a href="<?php echo url('customers');?>"><span class="fa fa-sort-alpha-desc"></span>Customer List</a></li>  
                             <li><a href="<?php echo url('mycustomers');?>"><span class="fa fa-sort-alpha-desc"></span>myCustomer List</a></li>  
                             <li><a href="<?php echo url('get_images');?>"><span class="fa fa-sort-alpha-desc"></span>Get Images</a></li>                            
                        </ul>
                    </li>

                    <li class="xn-envlop <?php if(isset($page) && $page=='cat'){ echo 'active';}?>">
                        <a href="<?php echo url('Home/category');?>"><span class="fa fa-tag"></span><span class="xn-text">Manage Category</span></a>
                    </li> 

                    <li class="xn-envlop <?php if(isset($page) && $page=='adv_setting'){ echo 'active';}?>">
                        <a href="<?php echo url('Home/advertise_setting');?>"><span class="fa fa-cog"></span><span class="xn-text">Advertise Setting</span></a>
                    </li> 
                    <li class="xn-openable <?php if(isset($page) && $page=='advertise'){ echo 'active';}?>">
                        <a href="<?php echo url('Home/advertise');?>"><span class="fa fa-rupee"></span> <span class="xn-text">Manage Advertise</span><label class="badge" id="bookingcount" style="background-color:green !important; margin-left: 10px; border-radius:90% !important"></label></a>
                        <ul>
                            <li><a href="<?php echo url('Home/advertise');?>"><span class="fa fa-sort-alpha-desc"></span>Advertise List</a></li>
                            <li><a href="<?php echo url('Home/pending_advertise');?>"><span class="fa fa-sort-alpha-desc"></span>Pending Advertise</a></li>
                        </ul>
                    </li>                  
                    
                    
                   
                    <li class="xn-openable <?php if(isset($page) && $page=='six'){ echo 'active';}?>">
                        <a href="<?php echo url('Admin/admin_profile');?>"><span class="fa fa-cog"></span> <span class="xn-text">Setting</span></a>
                        <ul>                            
                           <li><a href="<?php echo url('Home/profile');?>"><span class="fa fa-user"></span><span class="xn-text">Admin Profile</span></a></li>
                           <li><a href="<?php echo url('Home/changePassword');?>"><span class="fa fa-unlock-alt"></span><span class="xn-text">Change Password</span></a></li>
                        </ul>
                    </li> 
                                   
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->      
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <li class="xn-icon-button">
                        <a href="<?php echo url('Home/notifications');?>"><span class="fa fa-bell"></span></a>
                        <div class="informer informer-danger" id='message'></div>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->                 
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout">
                        <span style="position: relative;  right: 32px;" class="fa fa-sign-out">LogOut</span></span></a>
                    </li>  
                    <!-- END SIGN OUT -->     
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                <!-- START BREADCRUMB -->
                <!--ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                </ul-->
                <!-- END BREADCRUMB -->                       
        <!-- PAGE CONTENT WRAPPER -->
