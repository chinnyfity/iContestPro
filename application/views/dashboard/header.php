<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
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

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url()?>css1/themes/all-themes.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url()?>css1/style.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href='<?=base_url();?>assets/css/responsive.bootstrap.min.css' rel='stylesheet' type='text/css'>

    <link href="<?=base_url()?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <link href="<?=base_url()?>css1/custom-bootstrap-margin-padding.css" rel="stylesheet">
    




</head>

<body class="theme-red">
    <input type="hidden" value="<?=base_url();?>" id="txtsite_url">
    <input type="hidden" value="<?=$page_name;?>" id="txtpage_name">
    <input type="hidden" value="<?=$this->flutterwave;?>" id="txtflutter">

    <?php
    $page_name_ = str_replace("_", "-", $page_name);
    ?>
    
    <input type="hidden" value="dashboard" id="txt_contestID">
    <input type="hidden" value="<?=$page_name_;?>" id="txt_ad_name">
    
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
                
                <span class="navbar-brand">
                    <a class="" href="<?=base_url()?>" style="font-size: 40px; color: #fff; margin-right: 18px; position: relative; top: -11px;"><i class="fa fa-home"></i></a>
                    <a style="font-size: 25px; font-weight: 600; color: #fff; position: relative; top: -14px;" href="<?=base_url()?>dashboard/"><?=ucwords($this->nickname)?></a>
                </span>

            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown myicons">
                        <!-- <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"> -->
                        <a href="javascript:void(0);" class="dropdowns">
                            <i class="fa fa-ellipsis-h"></i>
                            <!-- <span class="label-count">7</span> -->
                        </a>
                        <ul class="dropdown_menu">
                            <li><a href="<?=base_url()?>dashboard/settings/"><i class="fa fa-gear"></i> Settings</a></li>
                            <li><a href="javascript:;" class="link_main_logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    

                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
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
                <?php
                if($this->myfullname=="")
                    $mynames = $this->nickname;
                else
                    $mynames = $this->myfullname;
                ?>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$mynames?></div>

                </div>
            </div>

            <?php
            $announce_msg1="";
            $announce_msg = $this->sql_models->checkNotificatn('announcement', $this->myID);
            if($announce_msg>0){
                $announce_msg1="($announce_msg)";
            }
            ?>
            
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php if($page_name=="") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if($page_name=="profile") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/profile/">
                            <i class="fa fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <?php if($this->my_mem_type=="spon" && $this->has_paid > 0){ ?>
                    <li class="<?php if($page_name=="entry_records") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/entry-records/">
                            <i class="fa fa-eye"></i>
                            <span>Entries</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="<?php if($page_name=="change_media") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/change-media/">
                            <i class="fa fa-upload"></i>
                            <span>Change Entry Media</span>
                        </a>
                    </li>
                    <li class="<?php if($page_name=="company_acct_details") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/company-acct-details/">
                            <i class="fa fa-file-o"></i>
                            <span>Company Acct Details</span>
                        </a>
                    </li>
                    <li class="<?php if($page_name=="mywallet" || $page_name=="transfer" || $page_name=="request_withdraw" || $page_name=="view_transactions" || $page_name=="transfer_history") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-money"></i>
                            <span>Wallet</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>dashboard/mywallet/">My Wallet</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/transfer/">Transfer Money</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/transfer-history/">Transfer History</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/request-withdraw/">Request Withdrawal</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/view-transactions/">View Transactions</a>
                            </li>
                        </ul>
                    </li>

                    <?php if($this->my_mem_type=="spon" && $this->has_paid==1){ ?>
                    <li class="<?php if($page_name=="upload_contest" || $page_name=="edit_contest" || $page_name=="view_contests" || $page_name=="sponsored_contests") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-trophy"></i>
                            <span>Contest</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>dashboard/upload-contest/">Upload Contest</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/view-contests/">View/Edit Contest</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/sponsored-contests/">View Sponsored Contest</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

                    <li class="<?php if($page_name=="referral_records") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/referral-records/">
                            <i class="fa fa-user-plus"></i>
                            <span>Referral Record</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="adverts" || $page_name=="view_adverts" || $page_name=="edit_adverts") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-television"></i>
                            <span>Advert</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>dashboard/adverts/">Upload Advert</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>dashboard/view-adverts/">View/Edit Advert</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="votes_recs" || $page_name=="who_voted") echo "active"; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-television"></i>
                            <span>Vote Records</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url()?>dashboard/votes/">Your Votes</a>
                            </li>
                            <!-- <li>
                                <a href="<?=base_url()?>dashboard/who-voted/">Who Voted</a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="<?php if($page_name=="support_ticket") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/support/">
                            <i class="fa fa-envelope"></i>
                            <span>Support Ticket <?=$this->unread_msg?></span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="announcement") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/announcement/">
                            <i class="fa fa-envelope"></i>
                            <span>Announcement <?=$announce_msg1?></span>
                        </a>
                    </li>


                    <li class="<?php if($page_name=="sponsor") echo "active"; ?>">
                        <?php if($this->id_card=="" || $this->utility=="" || ($this->has_paid=="" || $this->has_paid==0)){ ?>
                        <a href="<?=base_url()?>dashboard/sponsor/">
                            <i class="fa fa-gift"></i>
                            <span>Become A Sponsor</span>
                        </a>
                        <?php }else{ ?>

                            <?php if($this->approved==0){ ?>
                                <a href="javascript:;" onclick="javascript:alert('You have already become a sponsor, please wait for admin approval!');" style="opacity: 0.6">
                                <?php }else{ ?>
                                <a href="javascript:;" onclick="javascript:alert('You have already become a sponsor!');" style="opacity: 0.6">
                                <?php } ?>
                                <i class="fa fa-gift"></i>
                                <span>Become A Sponsor</span>
                            </a>
                        <?php } ?>
                    </li>


                    <li class="<?php if($page_name=="become_agent") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/become-agent/">
                            <i class="fa fa-gift"></i>
                            <span>Become An Agent</span>
                        </a>
                    </li>

                    <li class="<?php if($page_name=="settings") echo "active"; ?>">
                        <a href="<?=base_url()?>dashboard/settings/">
                            <i class="fa fa-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    <li class="last_li">
                        <a href="javascript:;" class="link_main_logout">
                            <i class="fa fa-power-off"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
            
        </aside>

    </section>
    