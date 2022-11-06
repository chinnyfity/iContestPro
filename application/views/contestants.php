

<?php //include('small_header.php'); ?>



<section class="section mt-0 m-sm--10">

    <div class="row_ container grid_ mt-20 mt-sm-0 p-xs-0">
        <div class="col-lg-3 col-md-4 col-sm-4 pl-0 pl-sm-10 pr-sm-10">
            <h1 class="border_">Contests</h1>
            
            <ul class="lis mt-xs-10">
                <?php
                if($contests){
                    foreach($contests as $post){
                        $ids = $post['id'];
                        $title = ucwords(strtolower($post['title']));
                        $cnts = $this->sql_models->countMyContests($ids, 'entries');
                        echo '<li><a href="javascript:;" class="open_title" ids="'.$ids.'" titls="'.$title.'">'.$title.' ('.$cnts.')</a></li>';
                    }
                }
                ?>
            </ul>
        </div>

        
        <!-- <div class="unit three-quarters m-xs--30"> -->
        <div class="col-lg-9 col-md-8 col-sm-8 pl-10 pr-10 p-xs-10 mt-xs-30">
            <div class="row">
                <div class="col-lg-4">
                    <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #069">Entries</font></h1>
                </div>

                <div class="col-lg-8 mt-sm-10">
                    <div class="cmd_search_fields mb-0">
                        <form method="post" autocomplete="off">
                            <input type="hidden" value="" id="txtpage1">
                            <div class="row pl-sm-10">
                                <!-- <div class="col-md-7 col-sm-7 p-0 pl-20 pl-sm-0"> -->
                                <div class="col-md-7 col-sm-7 col-12 p-0 pl-20 pl-xs-5 pr-xs-15">
                                    <input type="text" placeholder="Search Contestants" class="form-control" id="txtsrch">
                                </div>

                                <!-- <div class="col-md-3 col-sm-3 p-0 col-xs-10"> -->
                                <div class="col-md-3 col-sm-3 p-0 pl-xs-5 col-10">
                                    <div class="div_search">
                                        <select class="form-control" id="txtpre">
                                            <option value="">All</option>
                                            <option value="high">Highest Votes</option>
                                            <option value="low">Lowest Vote</option>
                                            <option value="old">Oldest</option>
                                            <option value="new">Newest</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-md-2 col-sm-2 p-0 col-xs-2"> -->
                                <div class="col-md-2 col-sm-2 p-0 pr-xs-10 col-2">
                                    <button type="button" class="cmd_search1"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <input type="hidden" id="contestids" value="0">
            <div style="clear: both;"></div>


            <div class="contents_div_2"></div>


            <p class="pageant_title"></p>
            <div class="contents_div">
                <div class="masonry-grid mt-0">

                    <div class="container p-xs-0">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- 728x90 -->
                        <ins class="adsbygoogle"
                            style="display:inline-block;width:728px;height:90px!important"
                            data-ad-client="ca-pub-3834887523835766"
                            data-ad-slot="3761951112"
                            ></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>


                    <?php
                    if($products){ ?>
                        <div class="container p-xs-0" style="color:#555 !important; font-size:16px; text-align:left; margin: 0px 0 24px 0px !important">Total of <?php echo "$record of $recordPerPage of $recordCount1";?> entries found</div>

                        <!-- <div id="four-columns" data-columns> -->
                            <?php
                            $k1=1;
                            foreach ($products as $rs) {
                                $id = $rs['id1'];
                                $names = ucwords(strtolower($rs['names']));
                                $nickname = ucwords(strtolower($rs['nickname']));
                                $names1 = strtolower($names);
                                if(strlen($names1)<=2) $names1 = strtolower($nickname);
                                if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
                                $names1 = str_replace(" ", "-", $names1);
                                $pics = $rs['pics'];
                                $views = $rs['views'];
                                $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                                $online_time = time_ago($online_timing);
                                $user_id_spon = $rs['user_id'];
                                $citys = $rs['citys1'];
                                $states = $rs['states1'];
                                $memid = $rs['contestant_id'];
                                $contest_id = $rs['contest_id'];
                                $start_date_contest = @date("jS M, Y h:i a", strtotime($rs['start_date_contest']));
                                $start_date_contest1 = $rs['start_date_contest'];
                                //echo $start_date_contest;
                                $con_id = $rs['con_id'];
                                $nows = substr(time(), -5);
                                $memid_hash = $memid.$nows;
                                $votes = $rs['votes'];
                                $timings3 = $rs['timings'];
                                $media_type = $rs['media_type'];
                                $c_title = ucwords($rs['title']);
                                $adv_title_f = cleanStr(strtolower($c_title));
                                $views2 = kilomega($rs['views2']);
                                $locs = "$citys, $states";
                                $locs_full = $locs;
                                //echo $con_id;
                                $timeToVOte = $this->sql_models->timeToVOte($con_id);
                                
                                $pics_entry_cnt = $this->sql_models->getVidsCounts($con_id, $memid);
                                if($media_type=="pic"){
                                    $pics_entry = $this->sql_models->getVids($con_id, $memid, 'arrays');
                                    if($pics_entry_cnt<=1){
                                        $pics_entry = $this->sql_models->getVids($con_id, $memid, '');
                                    }
                                }else{
                                    $pics_entry = $this->sql_models->getVids($con_id, $memid, '');
                                }

                                $difference = $timings3 - time();
                                $expirys = convertTime1($difference);

                                if(strlen($locs)>17) $locs = substr($locs, 0, 17)."...";
                                if(strlen($names)>17) $names = substr($names, 0, 17)."...";


                                $mylikes = $this->sql_models->getLikes($contest_id, $memid);
                                $mylikes1 = @number_format($mylikes);

                                $hasliked = $this->sql_models->hasliked($con_id, $memid, $this->myID);
                                $paint_hrt="";
                                if($hasliked==0) $paint_hrt = "-outline";

                                $mycmts = $this->sql_models->getContestantCmts($contest_id, $memid);
                                $mycmts1 = @number_format($mycmts);

                                $views1 = "<a href='javascript:void(0)' style='color:#DD6F00' class='like like_me like_me1$k1' autonum='$k1' contestant_id='$memid' con_id='$con_id' hasliked='$hasliked' mylikes='$mylikes' liker_id='$this->myID'><i class='mdi mdi-heart$paint_hrt mr-2'></i>$mylikes1</a>";

                                $cmts1 = "<a href='#commentmeup' style='color:#DD6F00' class='commentme comment_me mycomment_div comment_me1$k1 video-play-icon' autonum='$k1' hisname='$nickname' memid='$memid' con_id='$con_id' pics='$pics' mycmts='$mycmts' myid='$this->myID'><i class='fa fa-commenting'></i> <font>$mycmts1</font></a>";
                                
                                
                                $gen_num1=time();
                                $gen_num1=substr($gen_num1,5);

                                $cids = $rs['con_id'];
                                $nows = substr(time(), -5);
                                $ids_hash = $cids.$nows;

                                $hasExpired = $this->sql_models->checkVoteExpiry($contest_id);


                                $url2 = base_url()."profile/$memid_hash/$names1/";
                                $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                                $names_1 = str_replace("&", "and", $names_1);

                                $c_title2 = str_replace("&", "and", $c_title);

                                $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me on *'$c_title2'*, thank you in advance.";

                                $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me on '$c_title2', thank you in advance.";

                                $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                                $mychats1 = "";
                                if($this->myID==$memid){
                                    $mychats1 = $this->sql_models->noOfChats($this->myID);
                                    if($mychats1=="") $mychats1="";
                                }

                                $mystatus = $this->sql_models->chkOnlinePresence($memid);
                                $last_seen="<span class='active_o'>active</span>";
                                if($mystatus=="ash"){
                                    if(strtotime($online_timing)>0)
                                        $last_seen="<span>$online_time</span>";
                                    else
                                        $last_seen="<span>offline</span>";
                                }
                            ?>

                                <div class="scroll_stop<?=$memid?>"></div>

                                <div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10">
                              
                                    <div class="grid-img" id1="<?=$id?>">
                                        <div class="chatWithMe" id="chatWithMe<?=$id?>" id1="<?=$id?>">
                                            <a href="#chatmeup" class="video-play-icon" hisname="<?=$nickname?>" con_id="<?=$con_id?>" memid="<?=$memid?>" myid="<?=$this->myID?>" pics="<?=$pics?>"><i class="fa fa-comments"></i><?=$mychats1?></a>
                                        </div>

                                        <div class="share_profile" id="share_profile<?=$id?>" id1="<?=$id?>">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><span><i class="fa fa-facebook-f"></i></span></a>
                                                
                                            <a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" class="for_desktop1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>
                                            
                                            <a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" class="for_mobile1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>

                                            <a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><span><i class="fa fa-twitter"></i></span></a>
                                        </div>

                                        <?php if($media_type=="pic"){ ?>
                                            <div class="for_eye_view" id="for_eye_view<?=$id?>">
                                                <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            
                                            <?php
                                            if($pics_entry){
                                                if($pics_entry_cnt>1){ // if its more than 1 pics
                                                    echo '<div class="owl-carousel grid-carousel">';
                                                    foreach ($pics_entry as $mypics) {
                                                        $pics_entry1 = $mypics['files'];
                                                        
                                                        $ffs = base_url()."media_uploads/$pics_entry1";
                                                        $ffs1 = "media_uploads1/$pics_entry1";
                                                        $ffs_wm = base_url()."images/logo_watermark.png";
                                                        watermark_image($ffs, $ffs_wm, $ffs1);

                                                        $pic_pathi = base_url()."media_uploads1/$pics_entry1";
                                                        $exts = pathinfo($pic_pathi,PATHINFO_EXTENSION);
                                                        if($exts=="mp4") // if its mp4 file
                                                            $pic_pathi = base_url()."profiles1/$pics";

                                                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                        if($width1=="" || $width1<=0)
                                                            $pic_pathi = base_url()."images/no_passport.jpg";

                                                        echo "<img src='$pic_pathi' alt='' />";
                                                    }
                                                    echo '</div>';

                                                }else{
                                                    //echo $pics_entry;
                                                    $pic_pathi = base_url()."media_uploads1/$pics_entry";
                                                    $width1="";
                                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                    if($width1=="" || $width1<=0)
                                                        $pic_pathi = base_url()."profiles1/$pics";

                                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                    if($width1=="" || $width1<=0)
                                                        $pic_pathi = base_url()."profiles/$pics";


                                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                    if($width1=="" || $width1<=0)
                                                        $pic_pathi = base_url()."images/no_passport.jpg";

                                                    echo "<img src='$pic_pathi' alt='' />";

                                                }

                                            }else{
                                            
                                                $pic_pathi = base_url()."media_uploads1/$pics_entry";
                                                $width1="";
                                                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                if($width1=="" || $width1<=0){
                                                    $pic_pathi = base_url()."profiles1/$pics";

                                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                    if($width1=="" || $width1<=0)
                                                        $pic_pathi = base_url()."profiles/$pics";
                                                }
                                                
                                                echo "<img src='$pic_pathi' alt='' />";
                                            }
                                            
                                        }else{
                                            $ffs = base_url()."profiles/$pics";
                                            $ffs1 = "profiles1/$pics";
                                            $ffs_wm = base_url()."images/logo_watermark.png";
                                            watermark_image($ffs, $ffs_wm, $ffs1);
                                            $pic_pathi = base_url()."profiles1/$pics";
                                        ?>
                                                <div class="vid_play">
                                                    <i class="fa fa-play" hisname="<?=$names?>" con_id="<?=$con_id?>" memid="<?=$memid?>" pics="<?=$pics?>" scrollstop="<?=$memid?>"></i>
                                                </div>
                                                <img src="<?=$pic_pathi?>" alt="" />
                                        <?php } ?>

                                        <?php //if($pages1!="mini_entries"){ ?>
                                            <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="contest_names">
                                                <?=$c_title?>
                                            </a>
                                        <?php //} ?>

                                        <div class="online_status online_status2"><font class="<?=$mystatus?>"></font><?=$last_seen?></div>

                                    </div>
                                    <div class="grid-content grid-content1">
                                        <h5><a href="#"><?=$nickname?></a></h5>
                                        <p style="margin: -16px 0 0 0 !important">
                                            <font class="for_desktop2"><b>From:</b> <?=$locs?></font>
                                            <font class="for_mobile2"><b>From:</b> <?=$locs_full?></font>
                                            <b>Votes:</b> <font class="vote_counts<?=$memid;?>"><?=@number_format($votes);?></font><br>
                                            <?=$views1.$cmts1;?>
                                        </p>
                                    </div>

                                    <div class="mt--10">
                                        <a class="arrow-button arrow-button1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">View Profile</a>
                                    </div>
                                    
                                </div> 
                                
                                
                            <?php
                            $k1++;
                            }
                            ?>
                             <div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10" style="overflow: hidden;">
                                 <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block;width:240px!important;height:400px!important"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                 </div>
                                 <div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10" style="overflow: hidden;">
                                 <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block;width:240px!important;height:400px!important"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                 </div>
                                 <div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10" style="overflow: hidden;">
                                 <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block;width:240px!important;height:400px!important"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                 </div>

                        <!-- </div> -->
                        
                        <?php
                        echo "<div style='clear:both'></div>";
                        echo $pagination;

                    }else{
                        echo "<p style='text-align:center; font-size:18px; margin:2em 0 3em 0'>No entries yet!</p>";
                    }
                    ?>
                </div>
                
            </div>
        </div>

    </div>


    <div style="clear: both;"></div>

</section>

    
    
    
    


