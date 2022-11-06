<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-navbutton-color" content="#069"> <!-- Windows Phone -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#069"> <!-- iOS Safari -->
    <meta name="theme-color" content="#069">
    <link rel="shortcut icon" href="<?=base_url()?>images/favicon.ico">

    <title><?=$page_title?> | Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    
    <link href="<?=base_url()?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="<?=base_url()?>css1/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Waves Effect Css -->
    <link href="<?=base_url()?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url()?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <!-- <link href="<?=base_url()?>plugins/morrisjs/morris.css" rel="stylesheet" /> -->

    

    <link href="<?=base_url()?>css1/custom-bootstrap-margin-padding.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url()?>css1/themes/all-themes.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url()?>css1/style.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href='<?=base_url();?>assets/css/responsive.bootstrap.min.css' rel='stylesheet' type='text/css'>

    <link href="<?=base_url()?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    




</head>

<body class="theme-red">
    <input type="hidden" value="<?=base_url();?>" id="txtsite_url">
    <input type="hidden" value="<?=$page_name;?>" id="txtpage_name">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>

    
    <div class="overlay"></div>
    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?=base_url()?>">DASHBOARD - iContestPRO</a>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown myicons">
                        <a href="javascript:void(0);" class="dropdowns">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <ul class="dropdown_menu">
                            <li><a href="<?=base_url()?>shields/settings/"><i class="fa fa-gear"></i> Settings</a></li>
                            <li><a href="<?=base_url()?>shields/logout/"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?=$this->imgs1; ?>" alt="User" id="img_navigatn" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrator</div>
                </div>
            </div>
            
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php if($page_name=="") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if($page_name=="profile") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-user"></i>
                            <span>Profile</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/create-user/">Create User</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="members") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/members/">
                            <i class="fa fa-users"></i>
                            <span>Members</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="member_wallets" || $page_name=="withdrawal_request" || $page_name=="transfer_history") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-money"></i>
                            <span>Member Wallets <?=$this->getPendingTotal?></span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/member_wallets/">Member Wallets&nbsp;<?=$this->pending_wallet?></a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/withdrawal_request/">Withdrawal Requests&nbsp;<?=$this->pending_withdraw?></a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/transfer_history/">Transfer History</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="admin_wallet") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/admin_wallet/">
                            <i class="fa fa-money"></i>
                            <span>Admin Wallet</span>
                        </a>
                    </li>


                    <li class="<?php if($page_name=="upload_contest" || $page_name=="view_contests" || $page_name=="edit_contest" || $page_name=="sponsored_contests") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-trophy"></i>
                            <span>Contest</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/view_contests/">View/Edit Contest</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/sponsored_contests/">View Sponsored Contest</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="referral_network") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/referral_network/">
                            <i class="fa fa-external-link"></i>
                            <span>Referral Network</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="adverts" || $page_name=="view_adverts" || $page_name=="edit_advert") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-television"></i>
                            <span>Advert</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/adverts/">Upload Advert</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/view_adverts/">View/Edit Advert</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="votes" || $page_name=="vote_history") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/votes/">
                            <i class="fa fa-upload"></i>
                            <span>Vote Records</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="entries") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/entries/">
                            <i class="fa fa-eye"></i>
                            <span>Entries</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="upload_blog" || $page_name=="view_blog" || $page_name=="edit_blog") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-edit"></i>
                            <span>Blog</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/upload_blog/">Upload Blog</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/view_blog/">View/Edit Blog</a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="<?php if($page_name=="contest_leaderboard" || $page_name=="voters_leaderboard") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-history"></i>
                            <span>Leaderboard</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/contest_leaderboard/">Contest Leaderboard</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/voters_leaderboard/">Voters Leaderboard</a>
                            </li>
                        </ul>
                    </li> -->

                    <li class="<?php if($page_name=="upload_rewards" || $page_name=="view_quiz" || $page_name=="edit_quiz" || $page_name=="upload_questions" || $page_name=="viewquestions" || $page_name=="edit_questions") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-trophy"></i>
                            <span>Get Reward</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/upload_rewards/">Upload Quiz</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/view_quiz/">View Quiz</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="transaction_reports" || $page_name=="contest_statistics" || $page_name=="vote_statistics") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-edit"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>shields/transaction_reports/">Transaction Reports</a>
                            </li>
                            <!-- <li>
                                <a href="<?=base_url()?>shields/contest_statistics/">Contest Statistics</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>shields/vote_statistics/">Vote Statistics</a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="announcement") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/announcement/">
                            <i class="fa fa-envelope-o"></i>
                            <span>Announcement</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="support") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/support/">
                            <i class="fa fa-envelope"></i>
                            <span>Support Ticket <?=$this->unread_msg?></span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="settings") echo "active"; ?>">
                        <a href="<?=base_url()?>shields/settings/">
                            <i class="fa fa-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    <li class="last_li">
                        <a href="<?=base_url()?>shields/logout/">
                            <i class="fa fa-power-off"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
            
        </aside>

    </section>
    