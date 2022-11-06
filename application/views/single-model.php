

<style type="text/css">
    .demo-gallery > ul {
      margin-bottom: 0;
    }
    .demo-gallery > ul > li {
        float: left;
        margin-bottom: 20px;
        margin-right: 0px;
        widths: 200px;
    }
    .demo-gallery > ul > li a {
      border: 3px solid #999;
      border-radius: 5px;
      display: block;
      overflow: hidden;
      position: relative;
      float: left;
      height: 240px;
      width: 100%;
      margin-bottom: 6px;
    }

    .demo-gallery > ul > li .share_profile_p a {
      width: auto;
    }


    .demo-gallery > ul > li a > img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      /*height: 100%;*/
      width: 100%;
      height: 16vw;
      object-fit: cover;
    }
    .demo-gallery > ul > li a:hover > img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
      opacity: 1;
    }
    .demo-gallery > ul > li a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery > ul > li a .demo-gallery-poster > img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery > ul > li a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .justified-gallery > a > img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }
    .demo-gallery .justified-gallery > a:hover > img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
      opacity: 1;
    }
    .demo-gallery .justified-gallery > a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .video .demo-gallery-poster img {
      height: 48px;
      margin-left: -24px;
      margin-top: -24px;
      opacity: 0.8;
      width: 48px;
    }
    .demo-gallery.dark > ul > li a {
      border: 3px solid #04070a;
    }
    .home .demo-gallery {
      padding-bottom: 80px;
    }
</style>


<?php
$ids = $mdetls['id1'];
$ids_1 = $ids;
//echo $ids; exit;
$mem_type = $mdetls['mem_type'];
$nows = substr(time(), -5);
$ids_hash_mem = $ids.$nows;
$names = ucwords($mdetls['names']);
$nickname = $mdetls['nickname'];
//if(strlen($names1)<=2) $names1 = strtolower($nickname);
if(strlen($names)<=2) $names = ucwords($nickname);

$pics = $mdetls['pics'];
$citys = $mdetls['citys'];
$states = $mdetls['states'];
$profession = $mdetls['profession'];
$online_timing = date("Y-m-d g:i a", $mdetls['online_timing']);
$online_time = time_ago($online_timing);
$bio = nl2br($mdetls['bio']);
$vviews = $mdetls['views'];
//$views2 = kilomega($vviews);
$views2 = @number_format($vviews);

$fb_id = $mdetls['fb_id'];
$ig_id = $mdetls['ig_id'];
$tw_id = $mdetls['tw_id'];

$locs = "$citys, $states";
if(strlen($bio)<=5){
    $bio="<label style='color:#777'>No Biography Yet!</label>";
}

$ffs = base_url()."profiles/$pics";
$ffs1 = "profiles1/$pics";
$ffs_wm = base_url()."images/logo_watermark.png";
watermark_image($ffs, $ffs_wm, $ffs1);

$pic_pathi = base_url()."profiles1/$pics";

$names1 = explode(' ', $names);
$first_name = ucwords($names1[0]);
$last_name = "";
if(isset($names1[1]))
    $last_name = ucwords($names1[1]);

$totalvotes = $this->sql_models->totalNoOfContestantVotes($ids);
$myEntrs = $this->sql_models->myEntrs1('entries entr', $ids);
$contests_won = $this->sql_models->calRows('winners', $ids_1);
$contests_par = $this->sql_models->calRows('entries', $ids_1);

//$getBoosted = $this->sql_models->fetchBoosted($con_ids, $contestant_id);


$mychats1 = "";
if($this->myID==$ids){
    $mychats1 = $this->sql_models->noOfChats($this->myID);
    if($mychats1<=0) $mychats1="";
}

$mystatus = $this->sql_models->chkOnlinePresence($ids);
$chechOnlineHidden = $this->sql_models->chechOnlineHidden($ids);

if($chechOnlineHidden) // visible
    $last_seen="<spans class='active_o'>active</spans>";
else
    $last_seen="<spans>hidden</spans>";

if($mystatus=="ash"){
    if(strtotime($online_timing)>0){
        if($chechOnlineHidden) // visible
            $last_seen="<spans>$online_time</spans>";
        else
            $last_seen="<spans>hidden</spans>";
    }else{
      $last_seen="<spans>offline</spans>";
    }
}else{
    if($chechOnlineHidden) // visible
        $mystatus="green";
    else
        $mystatus="ash";
}

?>



<section class="section mt-0 m-sm--10">
<div class="contest_main_div myprofile section-title">
    <div id="page-container p-sm-0">
    
        <div class="grid container mt-0 mt-xs--10">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- regico -->
                            <ins class="adsbygoogle"
                                style="display:block;"
                                data-ad-client="ca-pub-3834887523835766"
                                data-ad-slot="3869097324"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
            <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #069"><?=$first_name?></font> <?=$last_name?></h1>
            <p class="professions text-dark"><?=ucwords($profession)?></p>

            <div id="page-container pl-xs-0 pr-xs-0">
                <div class="grid mt--10 mt-xs--10 all_divs__">
                    <div class="unit golden-large">

                        <div class="demo-gallery">
                            <ul id="lightgallery" class="list-unstyled row">
                                <?php
                                $for_videos="";
                                if($myEntrs){
                                    $cnt1=1;
                                    $k1=1;

                                    foreach ($myEntrs as $rs1) {
                                        $contest_id = $rs1['contest_id'];
                                        $contestant_id = $rs1['contestant_id'];
                                        $con_votes = $rs1['votes'];
                                        $rs = $this->sql_models->myEntrsMedia($contest_id,$contestant_id);

                                        $id = $rs['id'];
                                        $files1 = $rs['files'];
                                        $descrip = ucfirst($rs['descrip']);
                                        $ffs = base_url()."media_uploads/$files1";
                                        $ffs1 = "media_uploads1/$files1";
                                        $ffs_wm = base_url()."images/logo_watermark.png";
                                        watermark_image($ffs, $ffs_wm, $ffs1);

                                        $files2 = base_url()."media_uploads1/$files1";
                                        $exts = pathinfo($files2,PATHINFO_EXTENSION);

                                        $contestDetails = $this->sql_models->getContestDetails($contest_id);
                                        $hasExpired = $this->sql_models->checkVoteExpiry($contest_id);
                                        $timeToVOte = $this->sql_models->timeToVOte($contest_id);

                                        //print_r($contestDetails);

                                        $user_id_spon = $contestDetails['user_id'];

                                        $start_date_contests="(not specified)";
                                        if(strlen($contestDetails['start_date_contest'])>3)
                                            $start_date_contests = @date("jS M, Y h:i a", strtotime($contestDetails['start_date_contest']));
                                        $start_date_contest1 = $contestDetails['start_date_contest'];
                                        $timings3 = $contestDetails['timings'];
                                        $title = $contestDetails['title'];
                                        $company_ads = $contestDetails['company_ads'];
                                        $files_1 = $contestDetails['files'];

                                        $company_ads1 = $company_ads;
                                        if($company_ads=="") $company_ads1 = $files_1;

                                        $getDetails_1 = $this->sql_models->getDetails($user_id_spon);
                                        $fb_id1 = $getDetails_1['fb_id'];
                                        $ig_id1 = $getDetails_1['ig_id'];
                                        $tw_id1 = $getDetails_1['tw_id'];


                                        $votes_pro = $this->sql_models->getVotes($contest_id, $this->myID);

                                        $difference = $timings3 - time();
                                        $expirys = convertTime2($difference);

                                        $chk_entr = $this->sql_models->isInEntries($contest_id, $contestant_id);

                                        $ids_hash2 = $contest_id.substr(time(), -5);
                                        $adv_title_f = cleanStr(strtolower($title));

                                        $mylikes = $this->sql_models->getLikes($contest_id, $contestant_id);
                                        $mylikes1 = @number_format($mylikes);

                                        $hasliked = $this->sql_models->hasliked($contest_id, $contestant_id, $this->myID);
                                        $paint_hrt="";
                                        if($hasliked==0) $paint_hrt = "-outline";

                                        $getDetails = $this->sql_models->getDetails($contestant_id);
                                        $con_name = $getDetails['nickname'];


                                        if($exts!="mp4"){
                                            //$pic_pathi = base_url()."contest_types/$files";

                                          $width1="";
                                          list($width1, $height1, $type1, $attr1) = @getimagesize($files2);
                                          if($width1=="" || $width1<=0)
                                              $files2 = base_url()."profiles/$pics";

                                          $width1="";
                                          list($width1, $height1, $type1, $attr1) = @getimagesize($files2);
                                          if($width1=="" || $width1<=0)
                                              $files2 = base_url()."images/no-image.jpg";

                                        }else{

                                        //if($exts=="mp4"){ // if its mp4 file
                                            $ffs = base_url()."profiles/$files1";
                                            $ffs1 = "profiles1/$files1";
                                            watermark_image($ffs, $ffs_wm, $ffs1);
                                            $files2 = base_url()."images/videos.png";
                                            

                                            $for_videos = "<div class='vid_play_profile'>
                                                <i class='fa fa-play' hisname='$names' con_title='$title' con_ads='$company_ads1' his_fb='$fb_id1' his_ig='$ig_id1' his_tw='$tw_id1' start_vote='$start_date_contests' names='$con_name' mycontestid='$contest_id' expiry='$expirys' autonum='$k1' myvotes='".@number_format($con_votes)."' memids='$contestant_id' user_id_spon='$user_id_spon' myid='$this->myID' onpg='profile' caps='Vote $con_name' fid='$id' memid='$ids' scrollstop='$ids'></i>
                                            </div>";
                                        }
                                        $actv="";
                                        if($cnt1==1) $actv="active";
                                        

                                        $for_voteme="";
                                        $for_voteme .= "<div class='mt-10 mb-10 mt-xs-0 voteme_profile' style='position: relative; z-index: 99'>
                                            <span class='voteme_btn_profile$ids'>";
                                            if($hasExpired){
                                                $for_voteme .= "<a class='arrow-button arrow-button1 voteme_exp votedis gallery_vote gallery_vote_disabled' id='voteme' href='javascript:;'>Vote Expired</a>";
                                            }else{

                                                if($this->myID == $user_id_spon && $this->myID>0){
                                                
                                                    $for_voteme .= "<a class='arrow-button arrow-button1 vote_user votedis gallery_vote gallery_vote_disabled' id='voteme' href='javascript:;'>Vote $con_name <font class='vote_counts$contest_id$contestant_id'style='color:#888'>(".@number_format($con_votes).")</font></a>";
                                                }else{
                                                   //$for_voteme .= strlen($start_date_contest1)."sss";
                                                    if($timeToVOte && strlen($start_date_contest1)>3){
                                                        $for_voteme .= "<a class='arrow-button arrow-button1 voteme_ajax voteme_j$ids voteme_k$ids gallery_vote' id='voteme' names='$con_name' mycontestid='$contest_id'  expiry='$expirys' autonum='$k1' myvotes='".@number_format($con_votes)."' memids='$contestant_id' myid='$this->myID' onpg='profile' caps='Vote $con_name' href='javascript:;'>Vote $con_name <font class='vote_counts$contest_id$contestant_id'style='color:#DD6F00'>(".@number_format($con_votes).")</font></a>";
                                                    }else{
                                                        $for_voteme .= "<a class='arrow-button arrow-button1 votedis vote_user1 gallery_vote gallery_vote_disabled' id='voteme' start_vote='$start_date_contests' href='javascript:;'>Vote $con_name <font class='vote_counts$contest_id$contestant_id'style='color:#888'>(".@number_format($con_votes).")</font></a>";
                                                    }
                                                }
                                            }
                                            $for_voteme .= "</span>
                                        </div>";

                                        $watch_videos = "";
                                        if($exts=="mp4"){
                                          $watch_videos = "<p class='vid_play_profile1 mb-5'><span hisname='$names' fid='$id' memid='$ids' scrollstop='$ids' style='font-size: 18px;'>WATCH VIDEO</span></p>";
                                        }

                                        ?>

                                            <li class="col-xs-6 col-sm-4 col-md-6 main_profile_share" id1='<?=$k1?>' data-responsive="<?=$files2?> 480" data-src="<?=$files2?>" data-sub-html="
                                                <h3 style='line-height:20px; margin-bottom:8px;' class='title_font'>
                                                    <?=$watch_videos?>
                                                    <a style='color: #9DCEFF !important; font-weight:normal' href='<?=base_url()?><?=$ids_hash2?>/join/<?=$adv_title_f?>/'><?=strtoupper($title)?></a>
                                                </h3>
                                                
                                                <?=$for_voteme?>

                                                <p style='font-size: 14px; line-height: 17px;'><?=$descrip?></p>
                                                ">

                                                <?php
                                                $names_nospace = strtolower(str_replace(" ", "-", $names));
                                                $memid_hash = $ids.$nows;
                                                $url2 = base_url()."profile/$memid_hash/$names_nospace/";
                                                $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                                                $names_1 = str_replace("&", "and", $names_1);

                                                $title3 = str_replace("&", "and", $title);

                                                $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me on *'$title3'*, thank you in advance.";

                                                $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me on '$title3', thank you in advance.";

                                                $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";
                                                ?>

                                                <div class="share_profile_p" id="share_profile_p<?=$k1?>" id1="<?=$k1?>">
                                                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><span><i class="fa fa-facebook-f"></i></span></a>
                                                      
                                                  <a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" class="for_desktop" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>
                                                  
                                                  <a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" class="for_mobile" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>

                                                  <a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><span><i class="fa fa-twitter"></i></span></a>
                                                </div>

                                                <a href="">
                                                    <?php
                                                    echo $for_videos;
                                                    echo "<img class='img-responsive img-top4' src='$files2'>";
                                                    ?>
                                                </a>

                                                <div class="contest_ttl like_profile_pg">
                                                  <?=$title?>

                                                  <div class="row vote_like_div">
                                                    <div class="col-md-7 p-sm-0"><b>Votes</b> <font class="vote_counts<?=$contest_id.$contestant_id;?>" style='color:#DD6F00'><?=@number_format($con_votes);?></font></div>

                                                    <div class="col-md-5 lst_div">
                                                      <?php
                                                      echo "<span href='javascript:void(0)' style='color:#DD6F00; cursor:pointer' class='like like_mes like_mes1$k1' autonum='$k1' contestant_id='$contestant_id' con_id='$contest_id' hasliked='$hasliked' mylikes='$mylikes' liker_id='$this->myID'><font>$mylikes1</font><i class='mdi mdi-heart$paint_hrt'></i></span>";
                                                      ?>
                                                    </div>
                                                  </div>

                                                </div>

                                            </li>
                                            
                                    <?php
                                    $k1++;
                                    }
                                }else{
                                    echo "No photos yet!";
                                }
                                    ?>
                            </ul>
                            
                        </div>
                        

                        <div class="experience-box experience-box1 mt-40">
                            <p class="text-dark"><?=$bio?></p>
                        </div>

                        <div class="hrs"></div>

                        <div class="experience-box experience-box1 mt-40">
                            <div class="experience-title">
                                <h1 class="text-dark">Entries Participated</h1>
                                <p style="font-size: 16.5px; color: #444; margin-top: 5px; line-height: 23px">These are the number of entries participated by this user.</p>
                            </div>

                            <?php
                            $conts=1;
                            if($ent_parti){
                                foreach($ent_parti as $post){
                                    $ids = $post['id1'];
                                    $nows = substr(time(), -5);
                                    $ids_hash = $ids.$nows;
                                    $title = ucwords(strtolower($post['title']));
                                    $adv_title_f = cleanStr(strtolower($title));
                                ?>
                                <p class="noofentr">
                                    <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$conts?>) <?=$title?></a>
                                </p>
                                <?php
                                $conts++;
                                }
                            }else{
                                echo "<div style='clear:both'></div>";
                                echo "<p style='color:#888; font-size: 17px'>No contest participated yet!</p>";
                            }
                            ?>

                        </div>
                    </div>


                    <div class="unit golden-small">
                        <img class="flex-img" src="<?=$pic_pathi?>" />

                        <div class="ombre-box">

                            <!-- <div class="mychats<?=$this->myID?> chatWithMe_profile" id="chatWithMe_profile<?=$this->myID?>" id1="<?=$this->myID?>"><a href="#chatmeup" class="video-play-icon" hisname="<?=$nickname?>" con_id="0" memid="<?=$ids_1?>" myid="<?=$this->myID?>" pics="<?=$this->pics?>"><i class="fa fa-comments"></i><?=$mychats1?></a></div> -->


                            <div class="online_status online_status3"><font class="<?=$mystatus?>"></font><?=$last_seen?></div>
                            <div class="row cap_name">
                                <table class="">
                                    
                                    <tr>
                                        <td class="c1">Name</td>
                                        <td><?=$names?></td>
                                    </tr>
                                    <tr>
                                        <td class="c1">Username</td>
                                        <td><?=ucfirst($nickname)?></td>
                                    </tr>
                                    <tr>
                                        <td class="c1">Views</td>
                                        <td><b><?=$views2?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="c1">Location</td>
                                        <td><?=$locs?></td>
                                    </tr>
                                    <tr>
                                        <td class="c1">Profession</td>
                                        <td><?=ucwords($profession)?></td>
                                    </tr>

                                    <tr>
                                        <td class="c1">Contests Participated</td>
                                        <td><?=$contests_par?></td>
                                    </tr>

                                    <tr>
                                        <td class="c1">Contests Won</td>
                                        <td><?=$contests_won?></td>
                                    </tr>

                                    <tr>
                                        <td class="c1">Total Votes</td>
                                        <td><b><?=@number_format($totalvotes)?></b></td>
                                    </tr>
                                </table>
                                
                            </div>

                            <?php
                            $names_nospace = strtolower(str_replace(" ", "-", $names));

                            $url2 = base_url()."profile/$ids_hash_mem/$names_nospace/";
                            $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                            $names_1 = str_replace("&", "and", $names_1);

                            $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me, thank you in advance.";

                            $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me, thank you in advance.";

                            $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2"; 
                            ?>

                            <?php if($fb_id!="" || $ig_id!="" || $tw_id!=""){ ?>
                            <div style="text-align: center; font-size: 15px; color: #444; margin-bottom: -5px;"><b>Follow <?=ucfirst($nickname)?> on:</b></div>
                            <?php } ?>

                            
                            <ul class="social-icons model-social">
                                <!-- <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank" class="fa fa-facebook tooltip-pink" title="Facebook">Facebook</a></li>

                                <li><a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank" class="fa fa-twitter tooltip-pink" title="Twitter">Twitter</a></li>

                                <li class="for_desktop"><a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank" class="fa fa-whatsapp tooltip-pink" title="Whatsapp">WhatsApp</a></li>

                                <li class="for_mobile"><a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank" class="fa fa-whatsapp tooltip-pink" title="Whatsapp">WhatsApp</a></li> -->

                                <?php if($fb_id!=""){ ?>
                                <li><a href="https://www.facebook.com/<?=$fb_id?>" target="_blank" class="fa fa-facebook tooltip-pink" title="Facebook">Facebook</a></li>
                                <?php } ?>

                                <?php if($ig_id!=""){ ?>
                                <li><a href="https://instagram.com/<?=$ig_id?>" target="_blank" class="fa fa-instagram tooltip-pink" title="Twitter">Instagram</a></li>
                                <?php } ?>

                                <?php if($tw_id!=""){ ?>
                                <li><a href="https://twitter.com/<?=$tw_id?>" target="_blank" class="fa fa-twitter tooltip-pink" title="Twitter">Twitter</a></li>
                                <?php } ?>

                            </ul>
                        </div>

                        <?php include('leaderboard.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>






