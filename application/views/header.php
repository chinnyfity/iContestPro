<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$page_title?> | iContestPRO</title>

    <link rel="canonical" href="http://icontestpro.com/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-navbutton-color" content="#069"> <!-- Windows Phone -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#069"> <!-- iOS Safari -->
    <meta name="theme-color" content="#069">

    <meta charset="UTF-8">
    
    <meta name="keywords" content="africa, contest, pageant, pageantry, contestant, winner is, beauty pageant, giveaways, competition, promo, lotto, sponsors, entries, entry, advert placements, adverts, rewards, campaign, queen, king, photo, video, chinny anthony, games, vote, multiple contest, first winner, second winner, third winner, wallet, miss world, miss nigeria, miss africa, fashion, celebrity, models, lagos, business, withdrawal, nationwide, advertise">

    <meta name="description" content="iContestPRO - We are #1 Multiple Contest Platform, we bring you better opportunities to have Fun and WiN BiG every day."/>
    <meta property="og:locale" content="en_US" />

    <?php
    $mem_id = $this->uri->segment(2);
    $mem_id1 = substr($mem_id, 0, -5);
    $url2="";

    if(isset($mdetls)){
        $names = ucwords($mdetls['names']);
        $nickname = ucwords($mdetls['nickname']);
        if(strlen($names)<=2) $names = ucwords($nickname);
        $names_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($names));
        $url2 = base_url()."profile/$mem_id/$names_f/";
        $descrips = "Hi dear, I’m $names at iContestPRO, I would like to plead for your support by voting for me, thank you in advance.";

        $pics = $mdetls['pics'];
        $pic_pathi="";
        if($pics!="") $pic_pathi = base_url()."profiles1/$pics";

        ?>
        <meta name="twitter:site" content="@iContestPRO" />
        <meta name="twitter:url" content="<?=$url2;?>" />
        <meta name="twitter:title" content="<?php echo "Vote For Contestant $names @ iContestPRO"; ?>" />
        <meta property="twitter:image" content="<?=$pic_pathi?>" />
        <meta property="twitter:description" content='<?=$descrips;?>' />

        <meta property="og:title" content="<?php echo "Vote For Contestant $names @ iContestPRO"; ?>" />
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?=$url2?>" />
        <meta property="og:image" content="<?=$pic_pathi?>" />
        <meta property="og:image:width" content="800" />
        <meta property="og:image:height" content="400" />
        <meta property="og:site_name" content="iContestPRO"/>
        <meta property="og:description" content='<?=$descrips;?>' />

    <?php }else if(isset($cdetls)){
        $ids = $cdetls['id'];
        $nows = substr(time(), -5);
        $ids_hash = $ids.$nows;
        $title4 = ucwords($cdetls['title']);
        $title4_f = str_replace("'", "&prime;", $title4);
        $adv_title_f = cleanStr(strtolower($title4));
        $url2 = base_url()."$ids_hash/join/$adv_title_f/";
        $descrips = $title4_f." is hosting a contest at the moment, join now and stand a chance to win prizes.";

        $files = $cdetls['files'];
        $pic_pathi="";
        if($files!="") $pic_pathi = base_url()."contest_types/$files";

        ?>
        <meta name="twitter:site" content="@iContestPRO" />
        <meta name="twitter:url" content="<?=$url2;?>" />
        <meta name="twitter:title" content="<?=$title4_f?>" />
        <meta property="twitter:image" content="<?=$pic_pathi?>" />
        <meta property="twitter:description" content='<?=$descrips;?>' />

        <meta property="og:title" content="<?=$title4_f?>" />
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?=$url2?>" />
        <meta property="og:image" content="<?=$pic_pathi?>" />
        <meta property="og:image:width" content="800" />
        <meta property="og:image:height" content="400" />
        <meta property="og:site_name" content="iContestPRO"/>
        <meta property="og:description" content='<?=$descrips;?>' />


    <?php }else if(isset($bdetls)){
        $ids = $bdetls['id'];
        $nows = substr(time(), -5);
        $ids_hash = $ids.$nows;
        $title4 = ucwords($bdetls['titles']);
        $title4_f = str_replace("'", "&prime;", $title4);
        $adv_title_f = cleanStr(strtolower($title4));
        $url2 = base_url()."$ids_hash/join/$adv_title_f/";
        $descrips = $title4_f;

        $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);
        $pic_pathi="";
        if($files!="") $pic_pathi = base_url()."cblogs/$files";

        ?>
        <meta name="twitter:site" content="@iContestPRO" />
        <meta name="twitter:url" content="<?=$url2;?>" />
        <meta name="twitter:title" content="<?=$title4_f?>" />
        <meta property="twitter:image" content="<?=$pic_pathi?>" />
        <meta property="twitter:description" content='<?=$descrips;?>' />

        <meta property="og:title" content="<?=$title4_f?>" />
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?=$url2?>" />
        <meta property="og:image" content="<?=$pic_pathi?>" />
        <meta property="og:image:width" content="800" />
        <meta property="og:image:height" content="400" />
        <meta property="og:site_name" content="iContestPRO"/>
        <meta property="og:description" content='<?=$descrips;?>' />
        
    <?php }else{ ?>

        <meta property="og:url" content="https://icontestpro.com/" />
        <meta property="og:title" content="Have Fun and Win BiG | iContestPRO" />
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="<?=base_url()?>images/logo.png" />
        <meta property="og:description" content="iContestPRO - We are #1 Multiple Contest Platform, we bring you better opportunities to have Fun and WiN BiG every day." />

    <?php } ?>

    <script data-cfasync="true" type="application/ld+json">{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"https:\/\/icontestpro.com\/","name":"iContestPRO | Have Fun and Win BiG","potentialAction":{"@type":"SearchAction","target":"http:\/\/icontestpro.com\/search\/result\/?search={search_term_string}","query-input":"required name=search_term_string"}}</script>

    <script data-cfasync="true" type="application/ld+json">{"@context":"http:\/\/schema.org","@type":"Organization","url":"https://icontestpro.com","sameAs":["https:\/\/www.facebook.com\/iContestpro","https:\/\/twitter.com\/iContestpro"],"@id":"#organization","name":"iContestPRO","logo":"https://icontestpro.com/images/logo.png"}</script>

    <link rel="shortcut icon" href="<?=base_url()?>images/favicon.ico">

    <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Magnific -->
    <link href="<?=base_url()?>css/magnific-popup.css" rel="stylesheet" type="text/css" />

    <!-- Icons -->
    <link href="<?=base_url()?>css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Slider -->
    <link rel="stylesheet" href="<?=base_url()?>css/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>css/owl.theme.default.min.css" />
    <!-- Main Css -->
    <link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <!-- <link href="<?=base_url()?>css/colors/default.css" rel="stylesheet" id="color-opt"> -->
    <link href="<?=base_url()?>css/style_main.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/media.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="<?=base_url()?>css/animations.css" rel="stylesheet" type="text/css">


    <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/custom-bootstrap-margin-padding.css" rel="stylesheet">

    <?php if($page_name=="join" || $page_name=="entries"){ ?>
    <link href="<?=base_url()?>css/video-js.css" rel="stylesheet">
    <?php } ?>


    <link href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href='<?=base_url();?>assets/css/responsive.bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <link href="<?=base_url()?>js/pgwSlideshow/lightgallery.css" rel="stylesheet">
    

<!-- <script type="text/javascript">function add_chatinline(){var hccid=17801215;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline(); </script> -->



</head>

<body class="js-sweetalert">
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>

    <?php if($page_name!=""){ ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=604232923524904&autoLogAppEvents=1" nonce="KwvtALZI"></script>
    <?php } ?>


    <input type="hidden" value="<?=base_url();?>" id="txtsite_url">
    <input type="hidden" value="<?=$this->myID;?>" id="txtuserID">
    <input type="hidden" value="<?=$this->ntn;?>" id="txtotherparms">
    <input type="hidden" value="<?=$page_name;?>" id="txtpage_name">

    <button class="btn btn-primary waves-effect btn_sweet_art_confirm" style="display: none;" data-type="confirm" data-msg="This will open to a your wallet dashboard, continue?" data-btn_yes="Proceed" data-hrefs="<?=base_url()?>dashboard/wallet/">CLICK ME</button>
    <button class="btn btn-primary waves-effect btn_sweet_art_join" style="display: none;" data-type="success" data-msg="Your payment has been received, thank you!">CLICK ME</button>
    <button class="btn btn-primary waves-effect btn_sweet_art_join_coded" style="display: none;" data-type="success" data-msg="Successful Entry!">CLICK ME</button>
    <button class="btn btn-primary waves-effect btn_sweet_art_chat" style="display: none;" data-type="success" data-msg="Your message has been sent!">CLICK ME</button>
    <button class="btn btn-primary waves-effect btn_sweet_art_login" style="display: none;" data-type="success" data-msg="Your login was successfull!">CLICK ME</button>
    <button class="btn btn-primary waves-effect btn_sweet_art_pv" style="display: none;" data-type="success" data-msg="Ticket purchase was successful">CLICK ME</button>

    <?php
    $cid_full = $this->uri->segment(1);
    $oparams = $this->uri->segment(2);
    $oparams3 = $this->uri->segment(3);

    $cid_id = substr($cid_full, 0, -5);

    if(!(int)$cid_id){
        $cid_id=0;
    }

    $cid = $this->uri->segment(1);
    $cid1 = substr($cid, 0, -5);
    $contestids = $cid1;
    $premiums=""; $user_id="";$oparams1="";$expiryss = ""; $countdowns1 = ""; $start_date_contest="";
    $start_date_contest1="";

    if($contestids!=""){
        $contest_details = $this->sql_models->fetchRecs('contests', '', '', $contestids, 1, '');
        if($contest_details){
            $timing3 = $contest_details['timings'];
            $title_c = $contest_details['title'];
            $premiums = $contest_details['premium'];

            $user_id = $contest_details['user_id'];
            $oparams1 = cleanStr(strtolower($title_c));

            $start_date_contest="==not specified";
            if(strlen($contest_details['start_date_contest'])>3)
                $start_date_contest = @date("jS M, Y h:i a", strtotime($contest_details['start_date_contest']));
            
            $start_date_contest1 = $contest_details['start_date_contest'];
            $timings1i = date("Y-m-d H:i:s", $timing3);

            $currentTime = time();
            $difference = $timing3 - $currentTime;
            $expiryss = convertTime1($difference);
            $timings4 = date("Y-m-d g:i", $timing3);

            $onedays = time()+108000;
            if(strtotime($timings1i) <= $onedays) $countdowns1 = "countdowns1";
        }
    }
    //echo $timing3."sss"; exit;

    $getAgents = $this->sql_models->fetchAgents('members');
    ?>

    <input type="hidden" value="<?=$cid_id;?>" id="txt_contestID1">
    <input type="hidden" value="<?=$cid_full;?>" id="txt_contestID">
    <input type="hidden" value="<?=$oparams1;?>" id="txt_ad_name">
    <input type="hidden" value="<?=$oparams;?>" id="txt_other_params">
    <input type="hidden" value="<?=$oparams3;?>" id="txt_other_params3">
    
    <input type="hidden" value="<?=$this->wallets1;?>" id="txtmywallet">

    <?php
    $unreads = $this->unread_msg1;
    if($this->unread_msg1=="")
        $unreads = 0;

    $mychats2 = $this->sql_models->noOfChats1($this->myID);
    $announce_msg = $this->sql_models->checkNotificatn('announcement', $this->myID);
    $mynotify = $this->sql_models->checkNotificatn('all_notifications', $this->myID);
    //echo "$mynotify sss";
    $total_noti = $mychats2 + $unreads + $announce_msg + $mynotify;

    $url3 = base_url().$this->sql_models->getNotifyDetails('all_notifications', $this->myID);
    ?>

    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <div>
                <a class="logo" href="<?=base_url()?>">
                    <?php if($page_name==""){ ?>
                        <img src="<?=base_url()?>images/logo.png">

                    <?php }else{ ?>
                        <img src="<?=base_url()?>images/logo_white.png" class="logo_white">
                        <img src="<?=base_url()?>images/logo.png" style="display: none;" class="logo_blue">

                    <?php } ?>
                </a>
            </div>

            <div class="buy-button">
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <?php if($this->myID!=""){ ?>
                            <?php if($total_noti>0){ ?>
                            <font class="mychats_h<?=$this->myID?>"><font class="notify_msg notify_msg1 counters"><?=$total_noti?></font></font>
                            <?php } ?>
                            <div class="image hd_profile_img">
                                <img src="<?=$this->imgs1; ?>" alt="User" id="img_navigatn" />
                            </div>
                            <ul class="submenu">
                                <?php if($mychats2>0){ ?>
                                    <li class="mychats_h<?=$this->myID?> chatWithMe_hd" id="chatWithMe_hd<?=$this->myID?>" id1="<?=$this->myID?>"><a href="#chatmeup" class="video-play-icon" hisname="<?=$this->nickname?>" con_id="0" memid="<?=$this->myID?>" myid="<?=$this->myID?>" pics="<?=$this->pics?>">Chats <font class="notify_msg notify_msg1 notify_msg2"><?=$mychats2?></font></a></li>
                                <?php } ?>
                                
                                <li><a href="<?=base_url()?>dashboard/profile/"><?=ucwords($this->nickname)?></a></li>
                                <li><a href="<?=base_url()?>dashboard/mywallet/">My Wallet</a></li>

                                <li>
                                    <a href="javascript:;" class="show_notifyme">
                                        Notification 
                                        <?php
                                        if($mynotify>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2' notify_cnt='$mynotify'>$mynotify</font>";
                                        }
                                        ?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=base_url()?>dashboard/support/">
                                        Support 
                                        <?php
                                        if($this->unread_msg1>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2'>$this->unread_msg1</font>";
                                        }
                                        ?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=base_url()?>dashboard/announcement/">
                                        Announcement 
                                        <?php
                                        if($announce_msg>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2'>$announce_msg</font>";
                                        }
                                        ?>
                                    </a>
                                </li>

                                <li><a href="javascript:;" class="link_main_logout">Logout</a></li>
                            </ul>
                        <?php }else{ ?>
                            <cfont class="btn btn2 btn-primary mt-10">
                                <a href="javascript:;" class="link_main_login">Login / Register</a>
                            </cfont>
                        <?php } ?>
                    </li>
                </ul>
            </div>

            <!-- <a href="<?=base_url()?>register/">Login / Register</a> -->
            
            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle">
                        <?php if($total_noti>0){ ?>
                            <font class="mychats_h<?=$this->myID?>"><font class="notify_msg notify_msg_mobile counters"><?=$total_noti?></font></font>
                        <?php } ?>
                        <div class="lines_menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <?php
                $nav_home="";
                if($page_name=="") $nav_home = "navigation-menu-home";
                $winners_cnt = $this->sql_models->calCounts('winners', '', '', '');
                ?>
                <ul class="navigation-menu <?=$nav_home?>">
                    <li><a href="<?=base_url()?>#home" class="inx_pg"><i class="fa fa-home"></i><font class="for_mobile">Home</font></a></li>
                    <li><a href="<?=base_url()?>contests/#contests">Contests</a></li>
                    <li><a href="<?=base_url()?>entries/#entries">Entries</a></li>
                    <li><a href="<?=base_url()?>winners/#winners">Winners <font style="color: #AA0">(<?=@number_format($winners_cnt)?>)</font></a></li>

                    <!-- <li class="has-submenu">
                        <a href="javascript:void(0)">Contests</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="<?=base_url()?>contests/#contests">All Contests</a></li>
                            <li><a href="<?=base_url()?>entries/#entries">Explore Entries</a></li>
                            <li><a href="<?=base_url()?>winners/#winners">Past Winners</a></li>
                        </ul>
                    </li> -->
                    <li><a href="<?=base_url()?>sponsor-contest/#sponsors">Sponsors</a></li>
                    <!-- <li><a href="<?=base_url()?>get-rewarded/#rewards">VP Rewards</a></li> -->
                    <!-- <li><a href="javascript:;" onclick="javascript:alert('This will be available shortly!');">VP Rewards</a></li> -->

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Vote Point</a> <span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="javascript:;" onclick="javascript:alert('This will be available shortly!');">VP Rewards</a></li>
                            <li><a href="<?=base_url()?>vp-market/#vpmarket">VP Market</a></li>
                        </ul>
                    </li>

                    <li class="for_mobile2"><a href="javascript:;" class="more_links">More Links...</a></li>

                    <li class="has-submenu for_mobile2">
                        <?php if($this->myID!=""){ ?>
                            <a href="javascript:void(0)"><?=ucwords($this->nickname)?>
                                <?php if($total_noti>0){ ?>
                                    <font class="mychats_h<?=$this->myID?>"><font class="notify_msg notify_msg_mobile1 counters"><?=$total_noti?></font></font>
                                <?php } ?>
                            </a>
                            <span class="menu-arrow"></span>
                            <ul class="submenu">
                                <?php if($mychats2>0){ ?>
                                    <li class="mychats_h<?=$this->myID?> chatWithMe_hd" id="chatWithMe_hd<?=$this->myID?>" id1="<?=$this->myID?>"><a href="#chatmeup" class="video-play-icon" hisname="<?=$this->nickname?>" con_id="0" memid="<?=$this->myID?>" myid="<?=$this->myID?>" pics="<?=$this->pics?>">Chats <font class="notify_msg notify_msg1 notify_msg2"><?=$mychats2?></font></a></li>
                                <?php } ?>
                                <li><a href="<?=base_url()?>dashboard/">My Dashboard</a></li>
                                <li><a href="<?=base_url()?>dashboard/mywallet/">My Wallet</a></li>

                                <li>
                                    <a href="javascript:;" class="show_notifyme">
                                        Notification 
                                        <?php
                                        if($mynotify>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2' notify_cnt='$mynotify'>$mynotify</font>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="<?=base_url()?>dashboard/support/">
                                        Support 
                                        <?php
                                        if($this->unread_msg1>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2'>$this->unread_msg1</font>";
                                        }
                                        ?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=base_url()?>dashboard/announcement/">
                                        Announcement 
                                        <?php
                                        if($announce_msg>0){
                                            echo "<font class='notify_msg notify_msg1 notify_msg2'>$announce_msg</font>";
                                        }
                                        ?>
                                    </a>
                                </li>

                                <li><a href="javascript:;" class="link_main_logout">Logout</a></li>
                            </ul>
                        <?php }else{ ?>
                            <a href="javascript:;" class="link_main_login" style="font-weight: 700">Login / Register</a>
                        <?php } ?>
                    </li>

                </ul>
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
    </header>

    <?php
    if(isset($contests[0]['user_id'])){
        $getSponDetls = $this->sql_models->getDetails($contests[0]['user_id'])['pics'];
        $profile__pics = base_url()."profiles/$getSponDetls";
        $width1="";
        list($width1, $height1, $type1, $attr1) = @getimagesize($profile__pics);
        if($width1=="" || $width1<=0)
            $profile__pics = base_url()."images/no-image.jpg";
    }
    ?>

    <?php if($page_name == "sponsor"){ ?>
            <img src="<?=$profile__pics?>" class="img_logos">
        <?php } ?>


    <div class="vote_me_ajax" style="display:none;"></div>



    <div class="vote_me" style="display:none;">
        <div class="closeme1"><i class="fa fa-close"></i></div>
        <div class="inner_dvs pr-0 pl-0">

            <?php include('voteme_div.php'); ?>
        </div>
    </div>



    <div class="overlays1" style="display: none;"></div>
    <div class="wrap_ watch_vids" style="display: none;"></div>




    <?php if($page_name!=""){
        //echo $page_name; exit;
            //$cdetls1 = $this->sql_models->fetchRecs('contests', '', '', $cid1, 1, '');
        if(isset($cdetls))
            $con_title = ucwords($cdetls['title']);
        else
            $con_title = $page_title;
        ?>
        <input type="hidden" value="<?=base_url();?>" id="txtsite_url">
        <div class="bringups"></div>


        <section class="bg-half bg-half_pages bg-light d-table w-100">
            
            <div class="sld_btn sld_btn_none" id="cmd_goto_main_contest" style="display: none;"><i class="fa fa-caret-left"></i> BACK</div>

            <div class="sld_btn sld_btn_none slide_to_details" style="display: none;"><i class="fa fa-caret-left"></i> Go Back</div>

            <div class="sld_btn sld_btn_none slideUp_comments" style="display: none;"><span><i class="fa fa-caret-left"></i> Go Back</span></div>

            <?php
            if($page_name == "single_blog")
                $page_titles = "Our Blog";
            else
                $page_titles = $page_title;

            $class_top="";
            if($page_name == "get_rewarded")
             $class_top = "mt--60 mt-xs--70";
            ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level pt-50">
                            <div class="page-next page-next1">
                                <nav aria-label="breadcrumb" class="d-inline-block">
                                    <ul class="breadcrumb bg-white bg_change_color rounded2 shadow mb-0 <?=$class_top?>">
                                        <li class="breadcrumb-item for_desktop"><a href="<?=base_url()?>">iContestPro</a></li>
                                        
                                        <?php
                                        $fontIncr = "";
                                        if($page_name != "profile"){
                                            // if the font length is more than 15 incr the font
                                            if(strlen($page_titles) < 22)
                                                $fontIncr = "fontIncr";
                                        }
                                        $page_title1 = str_replace("__", " & ", $page_titles);
                                        $page_titles = str_replace("_", " ", $page_title1);
                                        ?>
                                        <li class="breadcrumb-item <?=$fontIncr?> active mypage_title" aria-current="page"><?=$page_titles?></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="position-relative">
            <div class="shape overflow-hidden text-white">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
    <?php } ?>



    <div id="popup_div" class="white-popup mfp-hide howitwk mfp_popup_div1" style="position: relative; z-index: 9992 !important">
      <?php include('howitworks2.php'); ?>
    </div>


    <?php if($page_name=="about"){ ?>
    <div id="aboutus" class="white-popup mfp-hide howitwk" style="position: relative; z-index: 9992 !important; overflow: hidden;">
        <div style="width: auto; height: auto;">
            <iframe src="https://www.youtube.com/embed/h38RreInpXw" width="100%" height="415" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <?php } ?>


    <div id="commentmeup" class="white-popup white-popup1 mfp-hide mfp_popup_div" style="position:relative;z-index:9992 !important;">
      <div class="container p-0">
        <form class="mt-3 cmt_section comments_form" autocomplete="off">
            <p class="member_name"></p>

            <input type="hidden" id="txtcmt_cnt" class="txtcmt_cnt">
            <input type="hidden" id="txtmyid" value="<?=$this->myID?>">
            <input type="hidden" id="memids">
            <input type="hidden" id="txtrnd_no">

            <input name="txt_url_params" id="txt_url_params" value="<?=$this->url_params?>" type="hidden" />
            <input name="txt_url_params_ID" id="txt_url_params_ID" value="<?=$this->url0?>" type="hidden" />

            <div class="get_cmts">
            </div>
        </form>
      </div>
    </div>