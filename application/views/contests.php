
<!-- Job List Start -->
<section class="section mt-30 m-sm--10">
    <div class="container">
        <div class="row">

            <?php if($page_name=="contests"){ ?>
                <div class="col-lg-4 col-md-6 col-12 pr-30 pr-sm-15">
                    <div class="sidebar sticky-bar p-20 pl-xs-10 pr-xs-10 pb-xs-10 rounded shadow">
                        <div class="widget mb-3 pb-3 border-bottom_">
                            <h4 class="widget-title">Search Contests</h4>
                            <div id="jobkeywords" class="widget-search mt-2 mb-0">
                                <form role="search" method="get" id="searchform" class="searchform">
                                    <input type="hidden" value="<?=$contestids?>" id="contestids">
                                    <input type="hidden" value="" id="txtpg">
                                    <div>
                                        <input type="text" class="border rounded bg-grey" name="s" id="txtsrch" placeholder="Search Contest..." style="background-color: #fff !important;">
                                        <input type="button" id="searchsubmit" class="cmd_search" value="Search">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="widget mb-3 pb-3 border-bottom_">
                            <!-- <h4 class="widget-title">Catagories</h4> -->
                            <div class="form-group mt--5 mb-0">
                                <select class="form-control border rounded bg-grey custom-select" id="txtpre">
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

                        <div class="for_desktop2">
                            <?php include('just_ads.php'); ?>
                        </div>
                    </div>
                </div>


                <div class="contents_div_2"></div>

                <div class="col-lg-8 col-md-6 mt-sm-30">
                    <div class="contents_div">
                        <?php
                        if($contests){
                            echo '<div class="row">
                                    <p class="srch_info">To view all, clear the search box and click on search button</p>';

                                echo "<div class='container' style='color:#333 !important; font-size:16px; text-align:center; margin: -5px 0 8px 0px; line-height:20px;'>Share any of these contests below and get 10VP each, refer to <a href='#popup_div' style='color:#09C' class='video-play-icon watch link_howitwk'>how it works</a> to get more information</div>";

                                echo "<div class='container' style='color:#555; font-size:16px; text-align:center; margin: 0px 0 30px 0px !important'>Showing $record of $recordPerPage of $recordCount contests found</div>";

                                $i = 1;
                                foreach($contests as $post):
                                    $ids = $post['id'];
                                    $nows = substr(time(), -5);
                                    $ids_hash = $ids.$nows;
                                    $title = $post['title'];
                                    $adv_title_f = cleanStr(strtolower($title));
                                    $files = $post['files'];
                                    $company_logo = $post['company_logo'];
                                    $entry_type = $post['entry_type'];
                                    $timings = $post['timings'];
                                    $timings1 = date("Y-m-d H:i:s", $timings);
                                    $start_date1 = strtotime($post['start_date']);
                                    $start_date2 = @date("jS M, Y", $start_date1);
                                    $sponsoredby = $post['sponsoredby'];
                                    $sponsoredby_f = "";
                                    if($sponsoredby!="")
                                        $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
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
                                ?>

                                    <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
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
                                                    <div class="col-9" style="background-colors: green">
                                                <?php } ?>
                                                        <?php $title = strtolower($title); ?>
                                                        <h5 class="p-15"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 title text-dark font-bold1"><?=ucwords($title)?></a></h5>

                                                        <?php if($company_logo!=""){ ?>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($company_logo!=""){ ?>
                                                    <div class="col-3 mt-xs-5" style="background-colors: blue">
                                                    <?php } ?>
                                                        <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                                            <?=$img_logo1?>
                                                        </a>

                                                        <?php if($company_logo!=""){ ?>
                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <div class="for_timings pl-15 pr-15 pb-5 <?=$countdowns1?>">
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
                                                            echo 'Coming Soon on '.$start_date2.'!';
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

                                    <?php if($i%4==0){ ?>
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
                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
                                                        <img src="<?=$files1?>" class="card-img-top card-img-adv rounded-top" alt="">
                                                        <a href="<?=$urls1?>" target="_blank">
                                                            <div class="overlay rounded-top bg-dark"></div>
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
                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
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
                                                    </div>
                                                    
                                                    <div class="card-body content p-0">
                                                        <div class="post-meta d-flex justify-content-between mt-60">
                                                            <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                               <div class="sponsorads"><< Google ADS>></div>
                                                               <!-- <h5><a href="<?=$urls1?>" target="_blank" style="color: #666 !important; font-size: 17px !important;"><?=$title?></a></h5> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- This is for adverts -->
                                        <?php
                                        }else{ ?>

                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
                                                        <img src="<?=base_url()?>images/bizz.jpg" class="card-img-top rounded-top" alt="...">
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
                                $i++;
                                endforeach; ?>

                                <div style="clear: both;"></div>
                                <div class="col-12 mt-10 mb-40">
                                    <?php echo $pagination; ?>
                                </div>
                            </div>

                        <?php }else{ ?>
                        
                        <div class='container' style='color:#777; font-size:18px; text-align:center; margin: 10px 0 30px 0px !important'>No contest found!<br>Try reloading the page or search for something else.</div>


                        <?php
                        }
                        ?>
                </div>
            <?php } ?>








            <?php if($page_name=="sponsor"){ ?>
                <div class="col-lg-4 col-md-6 col-12 pr-30 pr-sm-15">
                    <div class="sidebar sticky-bar p-20 pl-xs-10 pr-xs-10 pb-xs-10 rounded shadow">
                        <div class="widget mb-3 pb-3 border-bottom_">
                            <h4 class="widget-title">Search Contests</h4>
                            <div id="jobkeywords" class="widget-search mt-2 mb-0">
                                <form role="search" method="get" id="searchform" class="searchform">
                                    <!-- <input type="hidden" value="<?=$contestids?>" id="contestids"> -->
                                    <input type="hidden" value="" id="txtpg">
                                    <div>
                                        <input type="text" class="border rounded bg-grey" name="s" id="txtsrch" placeholder="Search Contest..." style="background-color: #fff !important;">
                                        <input type="button" id="searchsubmit" class="cmd_search" value="Search">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="widget mb-3 pb-3 border-bottom_">
                            <!-- <h4 class="widget-title">Catagories</h4> -->
                            <div class="form-group mt--5 mb-0">
                                <select class="form-control border rounded bg-grey custom-select" id="txtpre">
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

                        <div class="for_desktop2">
                            <?php include('just_ads.php'); ?>
                        </div>
                    </div>
                </div>


                <div class="contents_div_2"></div>

                <div class="col-lg-8 col-md-6 mt-sm-30">
                    <div class="contents_div">
                        <?php
                        if($contests){
                            $page_title1 = str_replace("__", " & ", $page_title);
                            $page_title = str_replace("_", " ", $page_title1);
                            echo "<p class='mt--10 mb-20 mt-sm-10' style='text-align: center; font-size:22px; color:#990; line-height:26px;'><b>".strtoupper($page_title)."</b></p>";
                            echo '<div class="row">
                                    <p class="srch_info">To view all, clear the search box and click on search button</p>';

                                echo "<div class='container' style='color:#333 !important; font-size:16px; text-align:center; margin: -5px 0 8px 0px; line-height:20px;'>Share any of these contests below and get 10VP each, refer to <a href='#popup_div' style='color:#09C' class='video-play-icon watch link_howitwk'>how it works</a> to get more information</div>";

                                echo "<div class='container' style='color:#555; font-size:16px; text-align:center; margin: 0px 0 30px 0px !important'>Showing $record of $recordPerPage of $recordCount contests found</div>";

                                $i = 1;
                                foreach($contests as $post):
                                    $ids = $post['id'];
                                    $nows = substr(time(), -5);
                                    $ids_hash = $ids.$nows;
                                    $title = $post['title'];
                                    $adv_title_f = cleanStr(strtolower($title));
                                    $files = $post['files'];
                                    $company_logo = $post['company_logo'];
                                    $entry_type = $post['entry_type'];
                                    $timings = $post['timings'];
                                    $timings1 = date("Y-m-d H:i:s", $timings);
                                    $start_date1 = strtotime($post['start_date']);
                                    $start_date2 = @date("jS M, Y", $start_date1);
                                    $sponsoredby = $post['sponsoredby'];
                                    $sponsoredby_f = "";
                                    if($sponsoredby!="")
                                        $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
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
                                ?>

                                    <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
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
                                                    <div class="col-9" style="background-colors: green">
                                                <?php } ?>
                                                        <?php $title = strtolower($title); ?>
                                                        <h5 class="p-15"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 title text-dark font-bold1"><?=ucwords($title)?></a></h5>

                                                        <?php if($company_logo!=""){ ?>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($company_logo!=""){ ?>
                                                    <div class="col-3 mt-xs-5" style="background-colors: blue">
                                                    <?php } ?>
                                                        <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                                            <?=$img_logo1?>
                                                        </a>

                                                        <?php if($company_logo!=""){ ?>
                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <div class="for_timings pl-15 pr-15 pb-5 <?=$countdowns1?>">
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
                                                            echo 'Coming Soon on '.$start_date2.'!';
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

                                    <?php if($i%4==0){ ?>
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
                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
                                                        <img src="<?=$files1?>" class="card-img-top card-img-adv rounded-top" alt="">
                                                        <a href="<?=$urls1?>" target="_blank">
                                                            <div class="overlay rounded-top bg-dark"></div>
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
                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
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
                                                    </div>
                                                    
                                                    <div class="card-body content p-0">
                                                        <div class="post-meta d-flex justify-content-between mt-60">
                                                            <div class="company_stats company_ads mt-0 p-0 pt-5">
                                                               <div class="sponsorads"><< Google ADS>></div>
                                                               <!-- <h5><a href="<?=$urls1?>" target="_blank" style="color: #666 !important; font-size: 17px !important;"><?=$title?></a></h5> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- This is for adverts -->
                                        <?php
                                        }else{ ?>

                                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                                    <div class="position-relative">
                                                        <img src="<?=base_url()?>images/bizz.jpg" class="card-img-top rounded-top" alt="...">
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
                                $i++;
                                endforeach; ?>

                                <div style="clear: both;"></div>

                                <?php if($recordPerPage > 14){ ?>
                                <div class="col-12 mt-10 mb-40">
                                    <?php echo $pagination; ?>
                                </div>
                                <?php } ?>
                            </div>

                        <?php }else{ ?>
                        
                        <div class='container' style='color:#777; font-size:18px; text-align:center; margin: 10px 0 30px 0px !important'>No contest found!<br>Try reloading the page or search for something else.</div>


                        <?php
                        }
                        ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>




