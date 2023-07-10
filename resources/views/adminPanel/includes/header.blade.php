<?php 
 
                                    
     $agent_data = Auth::user()->img;
                           
                        
    function check_right($rights){
        $user_rights = \Auth::user()->user_rights;
        
        $user_role = \Auth::user()->role;

        if($user_role == 'admin'){
            return true;
        }else{
            $user_rights = json_decode($user_rights);
            // print_r($user_rights);
            $result = '';
            foreach($user_rights as $right_res){
                if($rights == $right_res){
                    $result = true;
                }
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
                        
?>

                       
<!DOCTYPE html>
    <html lang="en">

    
<!-- Mirrored from coderthemes.com/hyper/saas/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2022 08:24:45 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/adminPanel/assets/images/favicon.ico') }}">

        <!-- third party css -->
        <link href="{{ asset('public/adminPanel/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{ asset('public/adminPanel/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/adminPanel/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">        @yield('style')
        <style>
            .change_user:hover{
                cursor: pointer;
            }
        </style>
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="{{ URL::to('/dashboard') }}" style="font-size: 1.3rem;color: wheat;" class="logo text-center logo-light">
                    <!--<span class="logo-lg">-->
                    <!--    <img src="{{ asset('public/adminPanel/assets/images/logo.png') }}" alt="" style="width:180px;">-->
                    <!--</span>-->
                    
                    The Choice Marketing
                    <span class="logo-sm">
                        <img src="{{ asset('public/adminPanel/assets/images/logo_sm.png') }}" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{ URL::to('/dashboard') }}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('public/adminPanel/assets/images/logo-dark.png') }}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('public/adminPanel/assets/images/logo_sm_dark.png') }}" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                            <a href="{{ URL::to('/dashboard') }}" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Dashboards </span>
                            </a>
                            
                        </li>
                    
                    <?php 
                        if(check_right('Blogs')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#blogsNav" aria-expanded="false" aria-controls="blogsNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Blogs </span>
                            </a>
                            <div class="collapse" id="blogsNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('blogs-list') }}">Blogs List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('blogs-add') }}">Add Blogs</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('blogs-categories') }}">Blog Categories</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                    <?php 
                        }

                        
                    ?>

                    <?php 
                        if(check_right('Offers')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#offersNav" aria-expanded="false" aria-controls="offersNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Offers </span>
                            </a>
                            <div class="collapse" id="offersNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('offers-list') }}">Offers List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('offers-add') }}">Add Offer</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('offers-categories') }}">Offers Categories</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                     <?php 
                        }
                    ?>
                    <?php 
                        if(check_right('Videos')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#videosNav" aria-expanded="false" aria-controls="videosNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Videos  </span>
                            </a>
                            <div class="collapse" id="videosNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('videos-list') }}">Videos List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('videos-add') }}">Add Video</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('videos-categories') }}">Videos Categories</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#contact-us-message" aria-expanded="false" aria-controls="videosNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Contact Us Messages  </span>
                            </a>
                            <div class="collapse" id="contact-us-message">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('contact-us-messages-list') }}">Contact Us Messages</a>
                                    </li>
                                    
                                   
                                </ul>
                            </div>
                        </li>
                    <?php 

                    ?>

<li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#clients_nav" aria-expanded="false" aria-controls="clients_nav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Clients</span>
                            </a>
                            <div class="collapse" id="clients_nav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('all_clients_list') }}">Clients List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('unassign_clients_list') }}">Unassign Clients</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add_client_admin') }}">Add Clients</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('follow_up_categories') }}">Folow Up Categories</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('follow_up_sub_categories') }}">Folow Up Sub Cat</a>
                                    </li>
                                   
                                     
                                </ul>
                            </div>
                        </li>
                        
                    <?php
                        if(check_right('Locations')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#locationNav" aria-expanded="false" aria-controls="locationNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Locations </span>
                            </a>
                            <div class="collapse" id="locationNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('locations-list') }}">Location List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-location') }}">Location Add</a>
                                    </li>
                                    
                                    
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                    <?php 
                        if(check_right('Scoieties')){
                    ?>   
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#socNav" aria-expanded="false" aria-controls="socNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Societies </span>
                            </a>
                            <div class="collapse" id="socNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('societies-list') }}">Societies List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-society') }}">Society Add</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('block-list') }}">Block List</a>
                                    </li>    
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                  <?php 
                        if(check_right('Files')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#filesNav" aria-expanded="false" aria-controls="filesNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Files </span>
                            </a>
                            <div class="collapse" id="filesNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('files-list') }}">Files List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-files') }}">File Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                     <?php 
                        if(check_right('Local Property')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#localProNav" aria-expanded="false" aria-controls="localProNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Local Property </span>
                            </a>
                            <div class="collapse" id="localProNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('property-list') }}">Property List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-property') }}">Property Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>
                        <?php 
                        if(check_right('Agents')){
                    ?>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#agentNav" aria-expanded="false" aria-controls="agentNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Agents </span>
                            </a>
                            <div class="collapse" id="agentNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('agents-list') }}">Agents List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-agent') }}">Agent Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                             if(check_right('Users')){
                        ?>
                        
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#UsersNav" aria-expanded="false" aria-controls="UsersNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Users </span>
                            </a>
                            <div class="collapse" id="UsersNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('users-list') }}">User List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('register') }}">User Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>
                    <?php 
                        }
                        if(check_right('Buyers')){
                    ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#buyerNav" aria-expanded="false" aria-controls="buyerNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Buyers </span>
                            </a>
                            <div class="collapse" id="buyerNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('buyers-list') }}">Buyers List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-buyer') }}">Buyer Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                        <?php 
                            if(check_right('Customer')){
                        ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#customerNav" aria-expanded="false" aria-controls="customerNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Customers </span>
                            </a>
                            <div class="collapse" id="customerNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('customers-list') }}">Customers List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('add-customer') }}">Customer Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                     

                        <li class="side-nav-title side-nav-item">Accounts</li>

                      
                        <?php 
                            if(check_right('Payments')){
                        ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#payNav" aria-expanded="false" aria-controls="payNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Payments </span>
                            </a>
                            <div class="collapse" id="payNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('payments-list') }}">Payments List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('payments-add') }}">Payment Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                        <?php 
                            if(check_right('Received')){
                        ?>

                       
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#recvNav" aria-expanded="false" aria-controls="recvNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Received Payments </span>
                            </a>
                            <div class="collapse" id="recvNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('received-list') }}">Received List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('received-add') }}">Received Add</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                        <?php 
                            if(check_right('Accounts')){
                        ?>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#accountNav" aria-expanded="false" aria-controls="accountNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Accounts </span>
                            </a>
                            <div class="collapse" id="accountNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('accounts-list') }}">Accounts List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('cash-deposit') }}">Cash Deposit</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <?php 
                            }
                        ?>

                        <?php 
                            if(check_right('Payments')){
                        ?>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#expenseNav" aria-expanded="false" aria-controls="expenseNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Expense </span>
                            </a>
                            <div class="collapse" id="expenseNav">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('expense-list') }}">Expense List</a>
                                    </li>
                                   
                                    <li>
                                        <a href="{{ URL::to('expense-categories') }}">Categories</a>
                                    </li>  
                                    <li>
                                        <a href="{{ URL::to('expense-sub-categories') }}">Sub Categories</a>
                                    </li>  
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#reportsNav" aria-expanded="false" aria-controls="reportsNav" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">4</span>
                                <span> Reports </span>
                            </a>
                            <div class="collapse" id="reportsNav">
                                <ul class="side-nav-second-level">
                                <?php 
                                    if(check_right('profit_report')){
                                ?>
                                    <li>
                                        <a href="{{ URL::to('profit-report') }}" target="blank">Profit Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('date-wise-profit-report') }}" target="blank">DateWise Profit Report</a>
                                    </li>
                                <?php 
                                    }
                                ?>
                                <?php 
                                    if(check_right('day_book')){
                                ?>
                                    <li>
                                        <a href="{{ URL::to('day-book') }}">Day Book</a>
                                    </li>
                                <?php 
                                    }
                                ?>
                                <?php 
                                    if(check_right('Expense_report')){
                                ?>
                                    <li>
                                        <a href="{{ URL::to('expense-reports') }}">Expanse report</a>
                                    </li>
                                <?php 
                                    }
                                    if(check_right('pay_&_recv_report')){
                                ?>
                                    <li>
                                        <a href="{{ URL::to('payments-report') }}">Payments & Recv Report</a>
                                    </li>
                                <?php 
                                    }
                                    if(check_right('ledger_reports')){
                                ?>  
                                    <li>
                                        <a href="{{ URL::to('ledger-reports') }}">Ledgers Reports</a>
                                    </li>  
                                <?php 
                                    }
                                    if(check_right('Files_reports')){
                                ?> 
                                    <li>
                                        <a href="{{ URL::to('files-reports') }}">Files Reports</a>
                                    </li> 
                                    <?php 
                                    }
                                    if(check_right('local_reports')){
                                        ?> 
                                    <li>
                                        <a href="{{ URL::to('local-porperty-reports') }}">Local Property Reports</a>
                                    </li> 
                                    <?php 
                                    }
                                    ?> 
                                </ul>
                            </div>
                        </li>
                        <?php 
                            }
                        ?>
                       
                    </ul>

                    <!-- Help Box -->
                    
                    <!-- end Help Box -->
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search bar..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>
                            
                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        
                                        <img src="{{ asset('public/images/persons/'.Auth::user()->img.'') }}" alt="user-image" class="rounded-circle">
                                    </span>

                                    <span>
                                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                                        <span class="account-position">Super Admin</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    

                                    <!-- item-->
                                    <a href="{{ URL::to('change_password') }}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Change Password</span>
                                    </a>
                                    


                                    <!-- item-->
                                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                    <button  type="submit" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>

                        <div class="short_cuts" style="margin-top: 20px;">
                            <?php 
                                if(check_right('Files')){
                            ?>
                                    <a href="{{ URL::to('add-files') }}" class="btn btn-info btn-sm">Add File</a>
                            <?php 
                                }
                                if(check_right('Local Property')){
                            ?>
                                    <a href="{{ URL::to('add-property') }}" class="btn btn-primary btn-sm">Add Property</a>
                            <?php 
                                }
                                if(check_right('Payments')){
                            ?>
                                    <a href="{{ URL::to('payments-add') }}" class="btn btn-success btn-sm">Add Payment</a>
                        <?php 
                                }
                                if(check_right('Received')){
                            ?>
                                    <a href="{{ URL::to('received-add') }}" class="btn btn-danger btn-sm">Add Pay Recv</a>
                        <?php 
                                }
                                if(check_right('Payments')){
                            ?>
                                    <a href="{{ URL::to('expense-list') }}" class="btn btn-warning btn-sm">Expense</a>
                        <?php 
                                }
                                if(check_right('Accounts')){
                            ?>
                                    <a href="{{ URL::to('accounts-list') }}" class="btn btn-secondary btn-sm">Accounts</a>
                        <?php 
                                }
                            
                            ?>
                            <a href="{{ URL::to('reports-list') }}" class="btn btn-success btn-sm">Reports</a>
                    
                        </div>
                        
                        <!--<div class="app-search dropdown d-none d-lg-block">-->
                        <!--    <form>-->
                        <!--        <div class="input-group">-->
                        <!--            <input type="text" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">-->
                        <!--            <span class="mdi mdi-magnify search-icon"></span>-->
                        <!--            <button class="input-group-text btn-primary" type="submit">Search</button>-->
                        <!--        </div>-->
                        <!--    </form>-->

                        <!--    <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">-->
                                <!-- item-->
                        <!--        <div class="dropdown-header noti-title">-->
                        <!--            <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>-->
                        <!--        </div>-->

                                <!-- item-->
                        <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                        <!--            <i class="uil-notes font-16 me-1"></i>-->
                        <!--            <span>Analytics Report</span>-->
                        <!--        </a>-->

                                <!-- item-->
                        <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                        <!--            <i class="uil-life-ring font-16 me-1"></i>-->
                        <!--            <span>How can I help you?</span>-->
                        <!--        </a>-->

                                <!-- item-->
                        <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                        <!--            <i class="uil-cog font-16 me-1"></i>-->
                        <!--            <span>User profile settings</span>-->
                        <!--        </a>-->

                                <!-- item-->
                        <!--        <div class="dropdown-header noti-title">-->
                        <!--            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>-->
                        <!--        </div>-->

                        <!--        <div class="notification-list">-->
                                    <!-- item-->
                        <!--            <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <img class="d-flex me-2 rounded-circle" src="{{ asset('public/adminPanel/assets/images/users/avatar-2.jpg') }}" alt="Generic placeholder image" height="32">-->
                        <!--                    <div class="w-100">-->
                        <!--                        <h5 class="m-0 font-14">Erwin Brown</h5>-->
                        <!--                        <span class="font-12 mb-0">UI Designer</span>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </a>-->

                                    <!-- item-->
                        <!--            <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                        <!--                <div class="d-flex">-->
                        <!--                    <img class="d-flex me-2 rounded-circle" src="{{ asset('public/adminPanel/assets/images/users/avatar-5.jpg') }}" alt="Generic placeholder image" height="32">-->
                        <!--                    <div class="w-100">-->
                        <!--                        <h5 class="m-0 font-14">Jacob Deo</h5>-->
                        <!--                        <span class="font-12 mb-0">Developer</span>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </a>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <!-- end Topbar -->