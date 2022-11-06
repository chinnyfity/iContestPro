
<?php
$activeContests = $this->sql_models->activeContests();
$cont_title = ucwords(strtolower($activeContests['title']));
$cont_ids = $activeContests['id'];
//echo $cont_ids."<br>";
$topContestants = $this->sql_models->topContestants('entries', $cont_ids, 6);


$nows = substr(time(), -5);
$ids_hash = $cont_ids.$nows;
$adv_title_f = cleanStr(strtolower($cont_title));

$url2 = base_url()."$ids_hash/join/$adv_title_f/";


//$testingss = $this->sql_models->testingss();
//print_r($testingss);

?>

<!-- Hero Start -->
<section class="bg-half-170 border-bottom agency-wrapper d-table__ w-100 mt-sm-20 mt-xs-130" id="home">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-7 col-md-7 order-1 order-md-2 mt--10 mt-md-20 mt-xs--70 agency-wrapper1">
                <div class="for_desktop">
                    <?php
                    if($activeContests){
                        if($topContestants){
                            echo '<p class="mt--60 ml-40" style="color: #999; font-size: 14px; margin-bottom:5px;"><font style="color: #777;">Contest:</font> <a href="'.$url2.'" style="color:#9292C9;">'.$cont_title.'</a></p>';
                        ?>
                        <div class="grid_ logos_ mt-0 mb-10">
                            <div class="container">
                                <div class="col-lg-10 col-11">
                                    <div class="unit whole">
                                        <div id="models2" class="owl-carousel index_models2">
                                            <?php
                                            foreach($topContestants as $post){
                                                $ids_idx = $post['memid'];
                                                $pics_idx = $post['pics'];
                                                $names_idx = $post['names'];
                                                $nickname_idx = ucfirst(strtolower($post['nickname']));
                                                if(strlen($names_idx)<=3){
                                                    $names_idx = $nickname_idx;
                                                }
                                                $votes_idx = @number_format($post['votes']);
                                                $nows = substr(time(), -5);
                                                $memid_hash_idx = $ids_idx.$nows;
                                                $names1_idx = strtolower(str_replace(" ", "-", $names_idx));
                                                $pic_pathi_indx = base_url()."profiles1/$pics_idx";

                                                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi_indx);

                                                if($width1=="" || $width1<=0)
                                                    $pic_pathi_indx = base_url()."images/no_passport.jpg";
                                                ?>
                                                <figure class="ombre-carousel">
                                                    <a href="<?=base_url()?>profile/<?=$memid_hash_idx?>/<?=$names1_idx?>/">
                                                        <div class="index_contestants">
                                                            <img src="<?=$pic_pathi_indx?>" alt="" />
                                                            <span><?=$nickname_idx?></span>
                                                            <span class="vts"><?=$votes_idx?> votes</span>
                                                        </div>
                                                    </a>
                                                </figure>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }else{
                            echo "<p class='mb-xs--35'></p>";
                        }
                    }
                    ?>
                </div>
                <div class="title-heading mt-0 mt-xs-20 ml-lg-5">
                    <h1 class="heading font-bold">Start competing, Win big.</h1>
                    <p class="para-desc text-dark mt-20">iContestPRO is a digital multiple contest platform that brings to you top online competitions, challenges and contests from sponsors all over the world.</p>
                    <div class="watch-video mt-4 pt-2">
                        <a href="<?=base_url()?>register/" class="btn btn-primary mb-sm-20">Sign up & Start winning</a>

                        <a href="#popup_div" style="font-size: 18.5px;" class="video-play-icon watch text-dark mb-2 ml-2 display_block link_howitwk"><i class="mdi mdi-play play-icon-circle text-center d-inline-block mr-2 rounded-circle text-white position-relative play play-iconbar" style="background: #EA7500 !important; margin-left: 10px;"></i>
                           See how it works!</a>
                    </div>

                    <p class="para-desc text-muted_ mt-30 mt-xs-20" style="color: #E17100; line-height: 21px; font-weight: 500;">What's new? Get <b>100VP</b> when you complete your profile!</p>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 order-2 order-md-1 mt-4 pt-2 mt-sm-0 pt-sm-0 mt-xs--40">
                <img src="<?=base_url()?>images/classic01.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>
 

<section class="section bg-light">
   

    <div class="container mt-10 mt-xs--20">
        


        <!-- featured contests -->
        <?php
        $feat_contests = $this->sql_models->featContests();
        if($feat_contests){
        ?>
        <p class="ft_cnts"><span>Featured Contests</span></p>
        <div class="featured_cnts container p-xs-10">
            <div class="contents_div__ mt-20 mb-20 mt-xs-10 mb-xs-10">
                <div class="unit whole">
                    <div class="owl-carousel" id="featured_contests">
                        <?php
                            $kk=1;
                            foreach($feat_contests as $post):
                                $ids = $post['id'];
                                $nows = substr(time(), -5);
                                $ids_hash = $ids.$nows;
                                $title = $post['title'];
                                $adv_title_f = cleanStr(strtolower($title));
                                $files = $post['files'];
                                $entry_type = $post['entry_type'];
                                $timings = $post['timings'];
                                $company_logo = $post['company_logo'];
                                $sponsoredby = $post['sponsoredby'];
                                $sponsoredby_f = "";
                                if($sponsoredby!="")
                                    $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
                                $timings1 = date("Y-m-d H:i:s", $timings);
                                $start_date1 = strtotime($post['start_date']);
                                $start_date2 = @date("jS M, Y", $start_date1);
                                $start_date_contest1 = $post['start_date_contest'];
                                $start_date_contest = @date("jS M, Y", strtotime($post['start_date_contest']));
                                $close_date_entry1 = $post['close_date_entry'];
                                $views = kilomega($post['views']);
                                $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                                $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

                                $currentTime = time();
                                $difference = $timings - $currentTime;

                                if($start_date1 <= $currentTime){
                                    $c_expirys = convertTime1($difference);
                                    $c_expirys = str_replace("time", "to go", $c_expirys);
                                }else{
                                    $c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                                }

                                if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                                
                                $url2 = base_url()."$ids_hash/join/$adv_title_f/";

                                $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                                $title_1 = str_replace("&", "and", $title_1);

                                $title = str_replace("'", "&prime;", $title);
                                $descrips_whatsapp = "*'".ucwords($title)."'* is hosting a contest at the moment, join now and stand a chance to win prizes.";

                                $descrips = "'".ucwords($title)."' is hosting a contest at the moment, join now and stand a chance to win prizes.";
                                $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                                $shareConCounts = kilomega($this->sql_models->shareConCounts($ids));
                                $share_cap = "Share";

                                if($shareConCounts > 1) $share_cap = "Shares";

                                $countdowns1="";
                                $onedays = time()+108000;
                                if(strtotime($timings1) <= $onedays) $countdowns1 = "countdowns1";

                                $comments = $this->sql_models->fetchComments('comments', $ids, 20);
                                $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
                                $repliesCounts = $this->sql_models->fetchCommentsCounts1('replies', $ids);
                                $allCcounts = $commentsCounts+$repliesCounts;

                                $contest_img = base_url()."contest_types/$files";
                                $logo_img = base_url()."companys/$company_logo";

                                $img_logo1 = "";
                                if($company_logo != ""){
                                    $img_logo1 = "<img src='$logo_img' class='curve_logo curve_logo_ft mt-10'>";
                                }
                                

                                $width1="";
                                list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                                if($width1=="" || $width1<=0)
                                    $contest_img = base_url()."images/no-image.jpg";

                                if($company_logo!=""){
                                    $width1="";
                                    list($width1, $height1, $type1, $attr1) = @getimagesize($logo_img);
                                    if($width1=="" || $width1<=0)
                                        $logo_img = base_url()."companys/logo1.jpg";
                                }

                                $mb_30 = "mb-30";
                                if($kk == 9){ // if kk is 6
                                    $mb_30 = "mb-0";
                                }
                            ?>

                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                    <div class="position-relative">
                                        <img src="<?=$contest_img?>" class="card-img-top card-img-top-ft rounded-top" alt="...">
                                        <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                            <div class="overlay rounded-top bg-dark"></div>
                                        </a>
                                    </div>

                                    <div class="card-body content p-0">
                                        <?php if($company_logo!=""){ ?>
                                        <div class="row p-0">
                                            <div class="col-9 pl-10 pr-5">
                                        <?php } ?>
                                                <?php $title = strtolower($title); ?>
                                                <h5 class="p-15"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 card-title-ft title text-dark font-bold1"><?=ucwords($title)?></a></h5>


                                                <?php if($company_logo!=""){ ?>
                                            </div>
                                            <?php } ?>

                                            <?php if($company_logo!=""){ ?>
                                            <div class="col-3 mt-xs-5">
                                            <?php } ?>
                                                <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                                    <?=$img_logo1?>
                                                </a>

                                                <?php if($company_logo!=""){ ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div style="clear: both;"></div>


                                        <div class="for_timings for_timings_ft pb-15 <?=$countdowns1?>">
                                            <?php
                                            if($start_date1!="" && $start_date1 <= $currentTime){
                                                if(strtotime($close_date_entry1) >= time() && $close_date_entry1 != ""){
                                                    //echo 'Entry Stops at '.$close_date_entry1;
                                                    echo "Entries in progress...";
                                                }else{
                                                    if($close_date_entry1 == ""){
                                                        if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                            echo "Entries in progress...";
                                                        else
                                                            echo "<b>$c_expirys</b>";
                                                    }else{
                                                        if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                            echo "Entries in progress...";
                                                        else
                                                            echo "<b>$c_expirys</b>";
                                                    }
                                                }
                                            }else{
                                                if($start_date1!="" && $start_date1 >= time())
                                                    echo 'Coming on '.$start_date2.'!';
                                                else
                                                    echo "Entries in progress...";
                                            }
                                            ?>

                                            <a href="javascript:void(0)" class="text-muted comments ml-15">
                                                <i class="mdi mdi-comment-outline"></i> <?=$allCcounts?>
                                            </a>
                                        </div>


                                        <?php
                                        if($entry_type=="free" || $entry_type=="")
                                            echo '<div class="for_free"></div>';
                                        else if($entry_type=="coded" || $entry_type=="")
                                            echo '<div class="for_free_code"></div>';
                                        ?>


                                        <div class="post-meta d-flex justify-content-between mt-50">
                                            <div class="company_stats company_stats_ft pt-10 pb-10 mt-0">
                                                <span><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$noOfEntries?> Entries</a></span>
                                                <span><?=$noOfVotes?> Votes</span>
                                                <span><?=$views1?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="author_">
                                        <div class="inner_img">
                                            <div class="company_btns company_btns_ft company_btns_inx">
                                                <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><span>Join</span></a>
                                                <span class="social_menu" id1="<?=$ids?>">
                                                    <font style="font-size: 14px; color: #7BF"><?=$shareConCounts?></font> <?=$share_cap?>
                                                </span>
                                            </div>

                                            <div class="social_btns join_social_btns" id="social_btns<?=$ids?>">
                                                <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-facebook-f"></i></a></span>

                                                <span class="for_desktop2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                                <span class="for_mobile2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                                <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-twitter"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            $kk++;
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <hr class="mt-40 mb-50 margins_btm">
        <?php } ?>
        <!-- featured contests -->



        <div class="row justify-content-center">
            <div class="col-12 text-center">
            
                  <div class="section-title mb-4 pb-2">
                    <h4 class="title">Latest Contests</h4>
                    <p class="text-dark para-desc mx-auto" style="font-size: 18px;">Join one or more and start competing...</p>
                </div>

                <div class="row  mb-30 mt--10">
                    <div class="col-lg-offset-4 col-lg-4">
                        <div class="form-group mt--5 mb-0">
                            <select class="form-control change_conType" id="txtpre">
                                <option value="">All Contests</option>

                                <option value="active">Active</option>
                                <option value="new">New Contests</option>
                                <option value="" disabled="">-------</option>

                                <option value="paid">Paid Contests</option>
                                <option value="free">Free Contests</option>
                                <option value="coded">Coded Contests</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="contents_div mt-20">
            <div class="row">
                <?php
                    if($contests){
                        $kk=1;
                        foreach($contests as $post):
                            $ids = $post['id'];
                            $nows = substr(time(), -5);
                            $ids_hash = $ids.$nows;
                            $title = $post['title'];
                            $adv_title_f = cleanStr(strtolower($title));
                            $files = $post['files'];
                            $entry_type = $post['entry_type'];
                            $timings = $post['timings'];
                            $company_logo = $post['company_logo'];
                            $timings1 = date("Y-m-d H:i:s", $timings);
                            $start_date1 = strtotime($post['start_date']);
                            $start_date2 = @date("jS M, Y", $start_date1);
                            $start_date_contest1 = $post['start_date_contest'];
                            $start_date_contest = @date("jS M, Y", strtotime($post['start_date_contest']));
                            $close_date_entry1 = $post['close_date_entry'];
                            $sponsoredby = $post['sponsoredby'];
                            $sponsoredby_f = "";
                            if($sponsoredby!="")
                                $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
                            $views = kilomega($post['views']);
                            $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                            $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

                            $currentTime = time();
                            $difference = $timings - $currentTime;

                            if($start_date1 <= $currentTime){
                                $c_expirys = convertTime1($difference);
                                $c_expirys = str_replace("time", "to go", $c_expirys);
                            }else{
                                $c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                            }

                            if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                            
                            $url2 = base_url()."$ids_hash/join/$adv_title_f/";

                            $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                            $title_1 = str_replace("&", "and", $title_1);

                            $title = str_replace("'", "&prime;", $title);
                            $descrips_whatsapp = "*'".ucwords($title)."'* is hosting a contest at the moment, join now and stand a chance to win prizes.";

                            $descrips = "'".ucwords($title)."' is hosting a contest at the moment, join now and stand a chance to win prizes.";
                            $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                            $shareConCounts = kilomega($this->sql_models->shareConCounts($ids));
                            $share_cap = "Share";

                            if($shareConCounts > 1) $share_cap = "Shares";

                            $countdowns1="";
                            $onedays = time()+108000;
                            if(strtotime($timings1) <= $onedays) $countdowns1 = "countdowns1";

                            $comments = $this->sql_models->fetchComments('comments', $ids, 20);
                            $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
                            $repliesCounts = $this->sql_models->fetchCommentsCounts1('replies', $ids);
                            $allCcounts = $commentsCounts+$repliesCounts;

                            $contest_img = base_url()."contest_types/$files";
                            $logo_img = base_url()."companys/$company_logo";

                            $img_logo1 = "";
                            if($company_logo != ""){
                                $img_logo1 = "<img src='$logo_img' class='curve_logo mt-10'>";
                            }
                            

                            $width1="";
                            list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                            if($width1=="" || $width1<=0)
                                $contest_img = base_url()."images/no-image.jpg";

                            if($company_logo!=""){
                                $width1="";
                                list($width1, $height1, $type1, $attr1) = @getimagesize($logo_img);
                                if($width1=="" || $width1<=0)
                                    $logo_img = base_url()."companys/logo1.jpg";
                            }

                            $mb_30 = "mb-30";
                            if($kk == 9){ // if kk is 6
                                $mb_30 = "mb-0";
                            }
                    ?>

                        <div class="col-lg-4 col-md-6 <?=$mb_30?>">
                            <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                <div class="position-relative">
                                    <img src="<?=$contest_img?>" class="card-img-top rounded-top" alt="...">
                                    <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                        <div class="overlay rounded-top bg-dark"></div>
                                    </a>
                                </div>

                                <div class="card-body content p-10_ pl-15_pr-15 p-0">

                                    <?php if($company_logo!=""){ ?>
                                    <div class="row p-0">
                                        <div class="col-9">
                                    <?php } ?>
                                            <?php $title = strtolower($title); ?>
                                            <h5 class="p-10"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 title text-dark font-bold1"><?=ucwords($title)?></a></h5>

                                            <?php if($company_logo!=""){ ?>
                                        </div>
                                        <?php } ?>

                                        <?php if($company_logo!=""){ ?>
                                        <div class="col-3 mt-xs-5">
                                        <?php } ?>
                                            <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                                <?=$img_logo1?>
                                            </a>

                                            <?php if($company_logo!=""){ ?>
                                        </div>
                                    </div>
                                    <?php } ?>


                                    <div class="for_timings pl-10 pr-10 pb-5 <?=$countdowns1?>">
                                        <?php
                                        if($start_date1!="" && $start_date1 <= $currentTime){
                                            if(strtotime($close_date_entry1) >= time() && $close_date_entry1 != ""){
                                                //echo 'Entry Stops at '.$close_date_entry1;
                                                echo "Entries in progress...";
                                            }else{
                                                if($close_date_entry1 == ""){
                                                    if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                        echo "Entries in progress...";
                                                    else
                                                        echo "<b>$c_expirys</b>";
                                                }else{
                                                    if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                        echo "Entries in progress...";
                                                    else
                                                        echo "<b>$c_expirys</b>";
                                                }
                                            }
                                        }else{
                                            if($start_date1!="" && $start_date1 >= time())
                                                echo 'Coming on '.$start_date2.'!';
                                            else
                                                echo "Entries in progress...";
                                        }
                                        ?>

                                        <a href="javascript:void(0)" class="text-muted comments ml-15">
                                            <i class="mdi mdi-comment-outline"></i> <?=$allCcounts?>
                                        </a>
                                    </div>


                                    <?php
                                    if($entry_type=="free" || $entry_type=="")
                                        echo '<div class="for_free"></div>';
                                    else if($entry_type=="coded" || $entry_type=="")
                                        echo '<div class="for_free_code"></div>';
                                    ?>


                                    <div class="post-meta d-flex justify-content-between mt-60">
                                        <div class="company_stats p-10 mt-0">
                                            <span><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$noOfEntries?> Entries</a></span>
                                            <span><?=$noOfVotes?> Votes</span>
                                            <span><?=$views1?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="author_">
                                    <!-- <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                                    <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13th August,
                                        2019</small> -->

                                    <div class="inner_img">
                                        <div class="company_btns company_btns_inx">
                                            <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><span>Join</span></a>
                                            <span class="social_menu" id1="<?=$ids?>">
                                                <font style="font-size: 14px; color: #7BF"><?=$shareConCounts?></font> <?=$share_cap?>
                                            </span>
                                        </div>

                                        <div class="social_btns join_social_btns" id="social_btns<?=$ids?>">
                                            <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-facebook-f"></i></a></span>

                                            <span class="for_desktop2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                            <span class="for_mobile2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                            <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-twitter"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                 

                        <?php if($kk%8==0){ ?>
                            <?php
                            $get_ads = $this->sql_models->getADS('300x600', 'contest space', 'noarray', '');
                            if($get_ads){
                                $files = $get_ads['files'];
                                $urls1 = $get_ads['urls1'];
                                $title = ucwords($get_ads['title']);
                                $files1 = base_url()."adverts1/$files";
                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                if(preg_match($reg_exUrl, $urls1, $url)) {
                                    $urls1 = "$urls1";
                                } else {
                                    $urls1 = "mailto:$urls1";
                                }
                            ?>
                                <!-- This is for adverts -->
                                <div class="col-lg-4 col-md-6 <?=$mb_30?>">
                                    <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                        <div class="position-relative">
                                            <img src="<?=$files1?>" class="card-img-top card-img-adv rounded-top" alt="">
                                            <a href="<?=$urls1?>" target="_blank">
                                                <!-- <div class="overlay rounded-top bg-dark"></div> -->
                                            </a>
                                        </div>
                                        
                                        <div class="card-body content p-0">
                                            <div class="post-meta d-flex justify-content-between mt-60">
                                                <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                   <div class="sponsorads"><< Sponsored Ads >></div>
                                                   <h5><a href="<?=$urls1?>" target="_blank" style="color: #666 !important; font-size: 17px !important;"><?=$title?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                 <!-- This is for adverts --> 
                                 
                                 <!-- This is for adverts -->
                                 <div class="col-lg-4 col-md-6 <?=$mb_30?>">
                                    <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                        <div class="position-relative" style="height:240px!important">
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                                    <!-- 728x90 -->
                                                        <ins class="adsbygoogle"
                                                            style="display:block;width:100%!important;height:240px!important"
                                                            data-ad-client="ca-pub-3834887523835766"
                                                            data-ad-slot="3761951112"
                                                            data-ad-format="auto"
                                                            data-full-width-responsive="true"></ins>
                                                        <script>
                                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                                        </script>
                                                 <!-- <div class="overlay rounded-top bg-dark"></div> -->
                                         </div>
                                        
                                        <div class="card-body content p-0">
                                            <div class="post-meta d-flex justify-content-between mt-60">
                                                <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                   <div class="sponsorads"><< Google Ads >></div>
                                                   <h5><a href="" target="_blank" style="color: #666 !important; font-size: 17px !important;"> Power by Google</a></h5>

                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                 <!-- This is for adverts -->
                                    
                                 <!-- This is for adverts -->
                                 <div class="col-lg-4 col-md-6 <?=$mb_30?> for_desktop2">
                                    <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                        <div class="position-relative" style="height:240px!important">
                                        <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                                    <!-- 728x90 -->
                                                        <ins class="adsbygoogle"
                                                            style="display:block;width:100%!important;height:240px!important"
                                                            data-ad-client="ca-pub-3834887523835766"
                                                            data-ad-slot="3761951112"
                                                            data-ad-format="auto"
                                                            data-full-width-responsive="true"></ins>
                                                        <script>
                                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                                        </script>
                                                 <!-- <div class="overlay rounded-top bg-dark"></div> -->
                                         </div>
                                        
                                        <div class="card-body content p-0">
                                            <div class="post-meta d-flex justify-content-between mt-60">
                                                <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                   <div class="sponsorads"><< Google Ads >></div>
                                                   <h5><a href="" target="_blank" style="color: #666 !important; font-size: 17px !important;"> Power by Google</a></h5>

                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                 <!-- This is for adverts -->

                                    
                                 <!-- This is for adverts -->
                                 <div class="col-lg-4 col-md-6 <?=$mb_30?> for_desktop2">
                                    <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                        <div class="position-relative" style="height:240px!important">
                                        <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                                    <!-- 728x90 -->
                                                        <ins class="adsbygoogle"
                                                            style="display:block;width:100%!important;height:240px!important"
                                                            data-ad-client="ca-pub-3834887523835766"
                                                            data-ad-slot="3761951112"
                                                            data-ad-format="auto"
                                                            data-full-width-responsive="true"></ins>
                                                        <script>
                                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                                        </script>
                                                 <!-- <div class="overlay rounded-top bg-dark"></div> -->
                                         </div>
                                        
                                        <div class="card-body content p-0">
                                            <div class="post-meta d-flex justify-content-between mt-60">
                                                <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                   <div class="sponsorads"><< Google Ads >></div>
                                                   <h5><a href="" target="_blank" style="color: #666 !important; font-size: 17px !important;"> Power by Google</a></h5>

                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                 <!-- This is for adverts --> 
                         
                            <?php
                            }else{ ?>

                                <div class="col-lg-4 col-md-6 <?=$mb_30?>">
                                    <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                        <div class="position-relative">
                                            <img src="<?=base_url()?>images/bizz.jpg" class="card-img-top rounded-top" alt="..." style="display: block !important;">
                                            <a href="javascript:;">
                                                <div class="overlay rounded-top bg-dark"></div>
                                            </a>
                                        </div>
                                        <div class="card-body content p-0">
                                            
                                            <h5 class="p-15"><a href="javascript:;" class="card-title card-title1 title" style="color: #666 !important; font-size: 17px !important;">PLACE YOUR BUSINESS HERE</a></h5>

                                            <p class="pl-15 pr-15" style="margin: -16px 0 0 0"><a href="<?=base_url()?>contact/#contact" style="color: #09C">Click here to contact us</a></p>

                                            <div class="post-meta d-flex justify-content-between mt-60">
                                                <div class="company_stats company_ads p-10 mt-0">
                                                   << FREE SPACE >>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            }
                        ?>

                <?php
                    $kk++;
                    endforeach;
                }else{
                    echo "<div style='text-align:center; padding: 2em 0'>No Contest Found Yet!</div>";
                }
                ?>

                
            </div>
            <br>
            <div style="clear: both;"></div>
            <?php if($reg_conts_cnt >= 12){ ?>
                <div class="open_contests text-center mt-xs-30 mb--15 mt-0"><a href="<?=base_url()?>contests/">View more <i class="fa fa-caret-right"></i></a></div>
            <?php } ?>
        </div>
    </div>
</section>


<section class="section mt-30 mt-xs--10 mb--60">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-12 mb-xs-30">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="<?=base_url()?>images/icon/pen.svg" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">CRITERIA</h4>
                        <p class="text-dark text-muted1_ mb-0">  
                            1. Be between the ages of 18 and 60 years old<br>
                            2. Be of good health and character<br>
                            3. Be here regularly to see your qualifications<br>
                            </p>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-4 col-12 mt-5 mt-sm-0 mb-xs-30">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="<?=base_url()?>images/icon/video.svg" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">HOW YOU GET YOUR VP</h4>
                        <p class="text-dark text-muted1_ mb-0">  1. VP means Vote Point<br>
                            2. Each vote you do gets you some VP<br>
                            3. The higher you vote, the higher your VP<br>
                            4. Invite a sponsor and get 100VP<br>
                            5. Share any contests and get 10VP each (we only give 30VP on share of 3 contest every 24hrs), make sure you are logged in</p>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-4 col-12 mt-5 mt-sm-0">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="<?=base_url()?>images/icon/intellectual.svg" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">HOW YOU USE YOUR VP</h4>
                        <p class="text-dark text-muted1_ mb-0">1. The <a href="<?=base_url()?>get-rewarded/">Get Rewarded</a> feature allows you to buy tickets with your VP and win lots of iContestPRO luxury gifts.<br>
                            2. You can buy more tickets with your VP to stand a chance to win</p>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->

    <div class="container mt-70 mb-40">
        <div class="row align-items-center mt-xs--20">
            <div class="col-lg-6 col-md-6">
                <img src="<?=base_url()?>images/saas/2.png" class="img-fluid" alt="">
            </div>
            <!--end col-->

            <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0 mt-xs-20">
                <div class="section-title ml-lg-3">
                    <h4 class="title mb-3">To be considered as part of any of the contests</h4>
                    <p class="text-muted text-muted1"> To be considered as part of any of the contests, you have to <a href="http://206.189.193.144/register/">create an account</a> to get registered.
                   We are searching for young people all around the world to be part of this great opportunity. Click on any contest of your choice and participate on any, tell your friends to come vote for you and stand the chance of being the winner of that particular contest.<br><br>Boost your votes to increase the chances of you being at the top of other contestants and get the rewards. 

                    <!-- <a href="javascript:void(0)" class="mt-3 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a> -->

                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<br><br>

