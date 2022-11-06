
<?php
//phpinfo();

    $ids = $cdetls['id'];
    $nows = substr(time(), -5);
    $ids_hash = $ids.$nows;
    $ids_hash2 = $ids_hash;
    $con_title = ucwords($cdetls['title']);
    $adv_title_f = cleanStr(strtolower($con_title));
    $files = $cdetls['files'];
    $files_1 = $files;
    $user_id_spon = $cdetls['user_id'];
    $media_type = $cdetls['media_type'];
    $descrip = nl2br($cdetls['descrip']);
    //$descrip = str_replace("\r\n\r\n", "", $descrip);
    $views = kilomega($cdetls['views']);
    $sponsoredby = $cdetls['sponsoredby'];
    $entry_type = $cdetls['entry_type'];
    $entry_fee = $cdetls['entry_fee'];
    $timings = $cdetls['timings'];
    $premium = $cdetls['premium'];
    $start_date_contests="(not specified)";
    if(strlen($cdetls['start_date_contest'])>3)
        $start_date_contests = @date("jS M, Y h:i a", strtotime($cdetls['start_date_contest']));
    $start_date_contest1 = $cdetls['start_date_contest'];
    $close_date_entry = @date("jS M, Y h:i a", strtotime($cdetls['close_date_entry']));
    $close_date_entry1 = $cdetls['close_date_entry'];
    $timings1 = date("Y-m-d g:i", $timings);
    $instructions = $cdetls['instructions'];
    if($instructions!="") $instructions = "<p style='margin: -5px 0 0 0;' class='pl-xs-5 pr-xs-5 text-dark'>".nl2br(ucfirst($instructions))."</p>";

    $premiums="";
    if($premium=="paid")
        $premiums="<p>Vote Type: <span style='color: #990'>Boosted Vote Only</span></p>";
    else if($premium=="free")
        $premiums="<p>Vote Type: <span style='color: #990'>Free Vote Only</span></p>";
    else if($premium=="free_paid")
        $premiums="<p>Vote Type: <span style='color: #990'>Free & Boosted Vote</span></p>";

    $start_date1 = strtotime($cdetls['start_date']);
    $start_date2 = @date("jS M, Y", $start_date1);
    $currentTime = time();

    if($media_type=="vid"){
        $media_type1 = "Video";
        $accepteds = 'accept=".mp4"';
    }else{
        $media_type1 = "Photo";
        $accepteds = 'accept=".jpg, .jpeg"';
    }

    if($descrip=="") $descrip = "No Description";

    $price1 = @number_format($cdetls['price1']);
    $price2 = @number_format($cdetls['price2']);
    $price3 = @number_format($cdetls['price3']);
    $price4 = @number_format($cdetls['price4']);
    $price5 = @number_format($cdetls['price5']);

    $add_price1 = ucwords($cdetls['add_price1']);
    $add_price2 = ucwords($cdetls['add_price2']);
    $add_price3 = ucwords($cdetls['add_price3']);
    $add_price4 = ucwords($cdetls['add_price4']);
    $add_price5 = ucwords($cdetls['add_price5']);

    $operatn1="";$operatn2="";$operatn3="";$operatn4="";$operatn5="";

    if($price1!="" && $add_price1!="") $operatn1 = "<font2>+</font2>";
    if($price2!="" && $add_price2!="") $operatn2 = "<font2>+</font2>";
    if($price3!="" && $add_price3!="") $operatn3 = "<font2>+</font2>";
    if($price4!="" && $add_price4!="") $operatn4 = "<font2>+</font2>";
    if($price5!="" && $add_price5!="") $operatn5 = "<font2>+</font2>";

    $isprize=0;
    if($price1!="" || $add_price1!="") $isprize+=1;
    if($price2!="" || $add_price2!="") $isprize+=1;
    if($price3!="" || $add_price3!="") $isprize+=1;
    if($price4!="" || $add_price4!="") $isprize+=1;
    if($price5!="" || $add_price5!="") $isprize+=1;

    $marleft="";
    if($add_price1!=""){
        if($price1=="")
            $add_price1 = " $operatn1 <b style='font-size: 17px; line-height:20px;'>$add_price1</b></span>";
        else
            $add_price1 = " $operatn1 $add_price1</span>";
        $marleft="marleft";
    }

    if($add_price2!=""){
        if($price2=="")
            $add_price2 = " $operatn2 <b style='font-size: 17px; line-height:20px;'>$add_price2</b></span>";
        else
            $add_price2 = " $operatn2 $add_price2</span>";
        $marleft="marleft";
    }

    if($add_price3!=""){
        if($price3=="")
            $add_price3 = " $operatn3 <b style='font-size: 17px; line-height:20px;'>$add_price3</b></span>";
        else
            $add_price3 = " $operatn3 $add_price3</span>";
        $marleft="marleft";
    }

    if($add_price4!=""){
        if($price4=="")
            $add_price4 = " $operatn4 <b style='font-size: 17px; line-height:20px;'>$add_price4</b></span>";
        else
            $add_price4 = " $operatn4 $add_price4</span>";
        $marleft="marleft";
    }

    if($add_price5!=""){
        if($price5=="")
            $add_price5 = " $operatn5 <b style='font-size: 17px; line-height:20px;'>$add_price5</b></span>";
        else
            $add_price5 = " $operatn5 $add_price5</span>";
        $marleft="marleft";
    }

    if($price1!="") $price1 = "&#8358;$price1 cash";
    if($price2!="") $price2 = "&#8358;$price2 cash";
    if($price3!="") $price3 = "&#8358;$price3 cash";
    if($price4!="") $price4 = "&#8358;$price4 cash";
    if($price5!="") $price5 = "&#8358;$price5 cash";

    //$timings1 = date("Y-m-d H:i:s", $timings);

    $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
    $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

    $comments = $this->sql_models->fetchComments('comments', $ids, 20);
    $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
    $repliesCounts = $this->sql_models->fetchCommentsCounts1('replies', $ids);
    $allCcounts = $commentsCounts+$repliesCounts;
    $fees1="";
    if($entry_fee > 0) $fees1 = "<p>Entry Fee: <span style='color: #990'>&#8358;".@number_format($entry_fee)."</span></p>";

    $url2 = base_url()."$ids_hash/join/$adv_title_f/";
    $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $con_title);
    $title_1 = str_replace("&", "and", $title_1);

    $title = str_replace("'", "&prime;", $con_title);
    $descrips_whatsapp = "*'".ucwords($title)."'* is hosting a contest at the moment, join now and stand a chance to win prizes.";

    $descrips = "'".ucwords($title)."' is hosting a contest at the moment, join now and stand a chance to win prizes.";
    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

    $shareConCounts = kilomega($this->sql_models->shareConCounts($ids));
    $share_cap = "Share";
    if($shareConCounts > 1) $share_cap = "Shares";

    
    $timeToVOte = $this->sql_models->timeToVOte($ids);
    $countdowns = "";

    //$this->sql_models->timeToVOte1($ids);

    if(strtotime($start_date_contest1) <= time()){
        $timings1 = date("Y-m-d H:i:s", $timings);

        $onedays = time()+108000;
        if(strtotime($timings1) <= $onedays) $countdowns = "countdowns";

    }else{
        $timings1="";
    }

    $contest_img = base_url()."contest_types/$files";
    $width1="";
    list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
    if($width1=="" || $width1<=0)
        $contest_img = base_url()."images/no-image.jpg";
?>


<?php if(strtotime($start_date_contest1) <= time()){ ?>
    <script type="text/javascript">
        var countDownDate = new Date("<?=$timings1?>").getTime();
        //var countDownDate = new Date(Date.parse("2020-09-12 21:33")).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();

            var distance = parseFloat(countDownDate) - parseFloat(now);
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = days + "Days " + hours + "Hrs " + minutes + "Mins " + seconds + "Secs";

            var days1 = days + "Days ";
            document.getElementById("caption_expire").innerHTML = days1 + hours + "Hrs " + minutes + "Mins " + seconds + "Secs";

            var nFilter = document.createElement('countdown');

            if (distance < 0) {
              clearInterval(x);
              document.getElementById("countdown").innerHTML = "COMPLETED";
              document.getElementById("caption_expire").innerHTML = "COMPLETED";
            }
        }, 1000);
    </script>
<?php } ?>

<div class="contest_main_div" style="display: nones;">
    <section class="section mt-20 mt-sm-20 mt-xs--10">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 p-0 pl-sm-10 pr-sm-10">
                    <div class="card blog blog-detail border-0 _shadow rounded div_entry div_entry1" style="display: nones;">
                        <div class="responsive-img single_pg">
                            <div class="company_btns1 company_btns_cnst">
                                <span class="social_menu" id1="1">
                                    <font style="font-size: 14px; color: #7BF"><?=$shareConCounts?></font>
                                    <?=$share_cap?>
                                </span>
                            </div>
                            <div class="social_btns1 join_social_btns" id="social_btns1">
                                <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><i class="fa fa-facebook-f"></i></a></span>

                                <span class="for_desktop2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank"><i class="fa fa-whatsapp"></i></a></span>

                                <span class="for_mobile2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank"><i class="fa fa-whatsapp"></i></a></span>

                                <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><i class="fa fa-twitter"></i></a></span>
                            </div>

                            <img src="<?=$contest_img?>" class="img-fluid rounded-top" alt="<?=$con_title?>" />

                            <?php
                            if($start_date1 <= $currentTime){
                                if(strtotime($close_date_entry1) >= time() && $close_date_entry1 != ""){
                                    echo '<div class="for_timings for_timings1 '.$countdowns.' cnt_down" id="countdown">Entry Stops at '.$close_date_entry.'</div>';
                                }else{
                                    echo '<div class="for_timings for_timings1 cnt_down" id="countdown">Voting Starts at '.$start_date_contests.'</div>';
                                }
                            }else{
                                echo '<div class="for_timings for_timings1 for_timing_join"><font>Coming Soon on '.$start_date2.'!</font></div>';
                            }
                            ?>

                            <?php if($entry_type=='free' || $entry_type=="") echo '<div class="for_free for_free1"></div>'; ?>
                        </div>

                        <div class="post-meta mt-3">
                            <div class="company_stats company_stats1">
                                <span><?=$noOfEntries?> Entries</span>
                                <span><?=$noOfVotes?> Votes</span>
                                <span><?=$views?> Views</span>
                            </div>

                            <div class="entry_btns">
                                <?php
                                if($this->myID==""){
                                    if($start_date1 <= $currentTime){
                                        echo '<a href="javascript:;" id="auths" class="cmd_participate"><span>Participate</span></a>';
                                    }else{
                                        echo '<a href="javascript:;" style="opacity:0.6" id="auths" class="cmd_csn"><span>Participate</span></a>';
                                    }
                                }else{
                                    $hasExpired = $this->sql_models->checkVoteExpiry($ids);
                                    
                                    if($hasExpired){
                                        echo '<a href="javascript:;" id="auth" class="cmd_no_participate" style="opacity:0.6"><span>Participate</span></a>';
                                    }else{
                                        $profileComplete = $this->sql_models->profileComplete($this->myID);
                                        if($profileComplete){
                                            echo '<a href="javascript:;" id="auth" class="no_click" style="opacity:0.6"><span>Participate</span></a>';
                                        }else{
                                            if($this->myID == $user_id_spon){
                                                if($start_date1 <= $currentTime){
                                                    echo '<a href="javascript:;" id="auth" class="cmd_no_participate1"  style="opacity:0.6"><span>Participate</span></a>';
                                                }else{
                                                    echo '<a href="javascript:;" style="opacity:0.6" id="auths" class="cmd_csn"><span>Participate</span></a>';
                                                }
                                            }else{
                                                if($start_date1 <= $currentTime){
                                                    if($close_date_entry1!=""){
                                                        if(strtotime($start_date_contest1) >= time()){
                                                            echo '<a href="javascript:;" id="auth" class="cmd_participate"><span>Participate</span></a>';
                                                        }else{
                                                            echo '<a href="javascript:;" id="auth" class="cmd_no_participate2"  style="opacity:0.4"><span>Participate</span></a>';
                                                        }
                                                    }else{
                                                        //echo '<a href="javascript:;" id="auth" class="cmd_participate__" onclick="javascript:alert(\'Will soon be available shortly...\');"><span>Participate</span></a>';

                                                        echo '<a href="javascript:;" id="auth" class="cmd_participate"><span>Participate</span></a>';
                                                    }
                                                }else{
                                                    echo '<a href="javascript:;" style="opacity:0.4" id="auths" class="cmd_csn"><span>Participate</span></a>';
                                                }
                                            }
                                        }
                                    }
                                }

                                if($noOfEntries>0)
                                    $entr_caps = "($noOfEntries)";
                                else
                                    $entr_caps = "";
                                ?>
                                <a href="javascript:;" class="cmd_entries"><span>See Entries <?=$entr_caps?></span></a>
                            </div>

                            <?php
                            $con_titles = strtolower($con_title);
                            ?>

                            <div class="card-body_ content text-dark">                                
                                <div style="font-size: 18px; margin: 10px 0 23px 0; font-weight: 600;" class="pl-xs-5 pr-xs-5 cont_details">
                                    <p style="line-height: 23px;">Contest: <span style="color: #990; text-transform: capitalize;"><?=$con_titles?></span></p>

                                    <p>Contest Type: <span style="color: #990; text-transform: capitalize;"><?=$media_type1?> Contest</span></p>

                                    <?=$fees1?>
                                    <?=$premiums?>

                                    <?php if(strlen($sponsoredby)>3){
                                    $sponsoredby1 = strtolower($sponsoredby);
                                    ?>
                                    <p>
                                        Sponsored By: <span style="color: #990; text-transform: capitalize;"><?=$sponsoredby1?></span><br>
                                    </p>
                                    <?php } ?>

                                </div>

                                <p class="pl-xs-5 pr-xs-5 lh-22 text-dark"><?=ucfirst($descrip)?></p>


                                <?php
                                if(($cdetls['price1']!="" && $cdetls['price2']!="" && $cdetls['price3']!="") || $cdetls['add_price1']!="" && $cdetls['add_price1']!="" && $cdetls['add_price1']!="" ){



                                ?>

                                <div class="row">
                                    <div class="rounded-list">

                                        <?php
                                        if($isprize){
                                            $posns="";
                                            for($jj=1; $jj<=$isprize; $jj++){
                                                if($jj==1){
                                                    $posns = "st";
                                                    $myprize = $price1;
                                                    $myprize_gift = $add_price1;
                                                    $myprize_gift = $add_price1;
                                                }
                                                if($jj==2){
                                                    $posns = "nd";
                                                    $myprize = $price2;
                                                    $myprize_gift = $add_price2;
                                                }
                                                if($jj==3){
                                                    $posns = "rd";
                                                    $myprize = $price3;
                                                    $myprize_gift = $add_price3;
                                                }
                                                if($jj==4){
                                                    $posns = "th";
                                                    $myprize = $price4;
                                                    $myprize_gift = $add_price4;
                                                }
                                                if($jj==5){
                                                    $posns = "th";
                                                    $myprize = $price5;
                                                    $myprize_gift = $add_price5;
                                                }
                                                ?>
                                                <div class="col-xs-2">
                                                    <font><?=$jj?><sup><?=$posns?></sup></font>
                                                </div>
                                                <div class="col-xs-10">
                                                    <span class="<?=$marleft?>"><fonts><?=$myprize?></fonts><font3><?=$myprize_gift?></font3></span>
                                                </div>
                                                <div style="clear: both;"></div>

                                            <?php
                                            } 
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>

                                <?php } ?>

                                <?=$instructions?>

                                <div class="cmts_btn view_comments"><span>See Comments (<?=$allCcounts?>)</span></div>
                            </div>
                            
                        </div>
                        <br><br>
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                    </div>

                 
                    <div class="comments_div pr-sm-20 pr-xs-0" style="display: none;">
                        <h4 class="" style="font-size: 28px;">Comments (<?=$allCcounts?>)</h4>
                        <h3 class="" style="font-size: 19px; color: #09C; margin: 5px 0 1.5em 0;"><?=$con_title?></h3>
                        
                        <div class="all_comments">
                            <?php
                            if($comments){
                                foreach ($comments as $rs) {
                                    $cmt_id = $rs['id3'];
                                    $mem_id = $rs['mem_id'];
                                    $nows = substr(time(), -5);
                                    $memid_hash = $mem_id.$nows;
                                    $cmt_names = ucwords($rs['names']);
                                    $cmt_nick = ucwords($rs['nickname']);

                                    $names1 = strtolower($cmt_names);
                                    if(strlen($names1)<=2) $names1 = strtolower($cmt_nick);
                                    if(strlen($cmt_names)<=2) $cmt_names = ucwords(strtolower($cmt_nick));
                                    $names1 = str_replace(" ", "-", $names1);

                                    //if(strlen($cmt_names)<=2) $cmt_names = ucwords($cmt_nick);
                                    $messages = nl2br($rs['messages']);
                                    $date_created = $rs['date_created'];
                                    $date_created = @date("jS M Y h:i a", strtotime($date_created));
                                    $replies = $this->sql_models->fetchReps('replies', $cmt_id, "");
                                ?>
                                    <div class="cmt_box<?=$cmt_id;?>">
                                        <p class="meta meta2">
                                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$cmt_names?></a> - <?=$date_created?> - <a href="javascript:;" class="replythis" cmt_id="<?=$cmt_id?>">Reply Me</a>
                                        </p>
                                        <div class="comments_content">
                                            <?php if($mem_id==$this->myID){ ?>
                                            <p class="menu_icn" id="menu_icn" ids="<?=$cmt_id;?>"><i class="fa fa-ellipsis-h"></i></p>
                                            <div class="edit_div" id="edit_div<?=$cmt_id;?>">
                                                <span id='editpost' counters="<?=$cmt_id;?>" messages1="<?=strip_tags(ucfirst($messages));?>" ids="<?=$cmt_id;?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>

                                                <span style='border:none; color:red; cursor:pointer' id='delpost' ids="<?=$cmt_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                                            </div>
                                            <?php } ?>

                                            <p><?=$messages?></p>
                                        </div>
                                    </div>

                                    <?php
                                    if($replies){
                                        echo "<div class='div_reps$cmt_id'>";
                                        foreach ($replies as $rs) {
                                            $rep_id = $rs['id3'];
                                            $mem_id1 = $rs['mem_id1'];
                                            //$comts_id = $rs['comments_id'];
                                            $cmt_names1 = ucwords($rs['names']);
                                            $cmt_nick = ucwords($rs['nickname']);
                                            if(strlen($cmt_names1)<=2) $cmt_names1 = ucwords($cmt_nick);
                                            if($cmt_names1=="") $cmt_names1 = "Anonymous";
                                            $messages1 = nl2br($rs['messages']);
                                            $date_created1 = $rs['date_created'];
                                            $date_created1 = @date("jS M, Y, h:i a", strtotime($date_created1));
                                            ?>

                                            <div class="reply rep_box<?=$rep_id;?>">
                                                <p class="meta">
                                                    <a href="#"><?=$cmt_names1?></a> - <?=$date_created1?>
                                                </p>
                                                <div class="comments_content">
                                                    <?php if($mem_id1==$this->myID){ ?>
                                                    <p class="menu_icn1" id="menu_icn1" ids="<?=$rep_id;?>" cmt_id="<?=$rep_id?>"><i class="fa fa-ellipsis-h"></i></p>
                                                    <div class="edit_div" id="edit_div<?=$rep_id;?>">
                                                        <span id='editpost' counters="<?=$rep_id;?>" messages1="<?=strip_tags(ucfirst($messages1));?>" ids="<?=$rep_id;?>" comments_id="<?=$cmt_id?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>
                                                        
                                                        <span style='border:none; color:red; cursor:pointer' id='delpost1' ids="<?=$rep_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                                                    </div>
                                                    <?php } ?>

                                                    <p><?=$messages1?></p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        echo "</div>";
                                        ?>

                                        <a href="javascript:;" class="show_more_cmts load_more_bt_<?=$cmt_id?> wow fadeIn" id="load_more_mba"  id1="<?=$cmt_id?>" data-val = "1" data-wow-delay="0.2s">Load more posts </a>

                                        <a href="javascript:;" class="show_more_cmts load_more_bt1_<?=$cmt_id?> wow fadeIn" id="load_more_mba1" style="color:#ccc; display:none;" data-wow-delay="0.2s"><i>Loading...</i></a>

                                        <div style='clear:both'></div>

                                    <?php
                                    }
                                }
                            }else{
                                echo "<p style='font-size: 18px; color: #555; margin: -10px 0 30px 0'>No comments yet!</p>";
                            }
                            ?>
                        </div>
                        
                        <hr />

                        <div class="comment_div" style="display: nones;">
                            <h5 class="mt-40" style="font-size: 24px;">Write a Comment</h5>

                            <form class="mt-3 cmt_section comments_form" autocomplete="off">

                                

                                <input name="txtcontID" id="txtcontID" type="hidden" value="<?=$ids?>" />
                                <input name="txtrepID" id="txtrepID" type="text" />
                                <input name="edit_ids" id="edit_ids" type="hidden" />
                                <input name="txtpgs" id="txtpgs" value="contest" type="hidden" />
                                <input name="txt_url_params" id="txt_url_params" value="<?=$this->url_params?>" type="hidden" />
                                <input name="txt_url_params_ID" id="txt_url_params_ID" value="<?=$this->url0?>" type="hidden" />

                                <div class="row bg-homes">
                                    <div class="col-md-12 mb-10">
                                        <div class="form-group position-relative">
                                            <label>Your Comment</label>
                                            <textarea placeholder="Your Comment" name="txtcomment_msg" id="txtcomment_msg" class="form-control txtcomment_msg" required=""></textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 pr-10 pl-sm-15 pr-sm-15">
                                        <div class="form-group position-relative">
                                            <!-- <label>Name <span class="text-danger">*</span></label> -->
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input id="name" name="txtcomment_name" disabled="" value="<?=ucwords($this->myfullname)?>" type="text" placeholder="Name" class="form-control pl-5" required="" style="color: #666 !important; cursor: not-allowed;">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 pl-10 pl-sm-15 pr-sm-15">
                                        <div class="form-group position-relative">
                                            <!-- <label>Your Email <span class="text-danger">*</span></label> -->
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input id="email" type="email" placeholder="Email" name="txtcomment_mail" class="form-control pl-5" required="" disabled="" style="color: #666 !important; cursor: not-allowed;" value="<?=$this->mymail?>">
                                        </div>
                                    </div>

                                    <div style='clear:both'></div>

                                    <div class="offset-lg-2 col-lg-8 offset-md-0 col-md-12 offset-xs-0 col-xs-12 mt-20">
                                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                        <div class="send send_cmts">
                                            <div class="row p-xs-10">
                                                <div class="col-md-4 col-5 pr-5 pr-xs-5">
                                                    <button type="button" class="btn btn-primary btn-block cmd_backToEntry curve_btn">< Back</button>
                                                </div>

                                                <div class="col-md-8 col-7 pl-5 pl-xs-5">
                                                    <button type="button" class="btn btn-primary btn-block cmd_comment curve_btn1">Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>

                <div class="offset-lg-1 col-lg-4 col-md-5 col-12 p-0 p-sm-10 mt-sm-0 mt-xs-40 pt-2 pt-sm-0 for_desktop div_entry">
                    <?php include('leaderboard.php'); ?>
                    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                </div>


                <div style='clear:both'></div>
                <?php
                echo '<div class="container mt-sm--20 p-0 mt-40 mt-xs-70 mb-10 mb-xs-0 div_entry">';
                    echo '<div class="ads_div_thin ads_div_thin_indx">';
                    echo '<div class="row p-5">';
                        $get_ads = $this->sql_models->getADS('780x90', 'footer', 'array', 2);
                        $count_ads = $this->sql_models->getADSCounts('780x90');
                        if($get_ads){
                            $p=1;
                            foreach($get_ads as $post){
                                $urls1 = $post['urls1'];
                                $files = $post['files'];
                                $files1 = base_url()."adverts1/$files";
                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                if(preg_match($reg_exUrl, $urls1, $url)) {
                                    $urls1 = "$urls1";
                                } else {
                                    $urls1 = "mailto:$urls1";
                                }

                                if($p==1)
                                    echo "<div class='col-md-6 col-xs-12 pl-0 pr-30 p-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
                                else if($p==2)
                                    echo "<div class='col-md-6 col-xs-12 pl-0 pr-30 p-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
                                        echo "<a href='$urls1' target='_blank'><img src='$files1'></a>
                                    </div>";
                                $p++;
                            }
                        }

                        $files1 = base_url()."images/empty_space.jpg";

                        if($count_ads <= 0){
                            echo "<div class='col-md-6 col-xs-12 pl-0 pr-30 p-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>
                                <a href='#'><img src='$files1'></a>
                            </div>";

                            echo "<div class='col-md-6 col-xs-12 pl-0 pl-30 p-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>
                                <a href='#'><img src='$files1'></a>
                            </div>";
                        }else if($count_ads <= 1){
                            echo "<div class='col-md-6 col-xs-12 pl-0 pr-30 p-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>
                                <a href='javascript:;'><img src='$files1'></a>
                            </div>";
                        }
                    echo '</div>';
                    echo '</div>';
                echo '</div>';
                ?>
            </div>

            
            <div class="container p-0 div_entry"><hr></div>

            <div class="all_entries_div">
                <div class="container containerx p-sm-0 mt-40 mt-xs-0">

                    <div class="col-md-4 col-sm-4 pl-50 pl-sm-20 pr-sm-0 pl-md-20 pl-xs-0">
                        <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #069">Contest</font> Entries</h1>
                    </div>

                    <div class="col-md-offset-1 col-md-7 col-sm-offset-1 col-sm-7 m-sm--10 mt-sm-10 p-xs-0 mt-xs-10">
                        <div class="cmd_search_fields mb-0">
                            <input type="hidden" value="mini_entries" id="txtpage1">
                            <form method="post" autocomplete="off">
                                <div class="row pl-sm-10">
                                    <div class="col-md-7 col-sm-7 col-12 p-0 pl-20 pl-xs-0 pr-xs-15">
                                        <input type="text" placeholder="Search Contestants" class="form-control" id="txtsrch">
                                    </div>

                                    <div class="col-md-3 col-sm-3 p-0 col-10">
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

                                    <div class="col-md-2 col-sm-2 p-0 pr-xs-10 col-2">
                                        <button type="button" class="cmd_search1"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div style="clear: both;"></div>

                    <h3 class="pl-50 pl-sm-20 mt--20 mt-md-10 mt-sm-0 mb-20 p-xs-0 font-bold" style="float: left; font-size: 22px; color: #09C; line-height: 28px;"><?=$con_title?></h3>
                </div>

                <input type="hidden" value="<?=$contestids?>" id="contestids">

                <div class="contents_div_2"></div>
                
                <div class="contents_div contents_div_1">
                    <div class="container containerx pl-30 pr-50 pr-md-80 pl-sm-0 pr-sm-0">

                        <?php
                        echo '<div class="masonry-grid">';
                        if($products){ ?>
                            <div class="container p-xs-0" style="color:#333 !important; font-size:16px; text-align:left; margin: -5px 0 24px 7px !important">Total of <?php echo "$record of $recordPerPage of $recordCount";?> entries found</div>

                            <!-- <div id="four-columns" data-columns> -->
                                <?php
                                $k1=1;
                                foreach ($products as $rs) {
                                    $id = $rs['id1'];
                                    $ids = $rs['memid1'];
                                    $names = ucwords(strtolower($rs['names']));
                                    $nickname = ucwords(strtolower($rs['nickname']));
                                    $nickname_i = ucwords($rs['nickname']);
                                    $names1 = strtolower($names);
                                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                                    if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
                                    $names1 = str_replace(" ", "-", $names1);
                                    $pics = $rs['pics'];
                                    $views = $rs['views'];
                                    $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                                    $online_time = time_ago($online_timing);
                                    $citys = $rs['citys1'];
                                    $states = $rs['states1'];
                                    $memid = $rs['contestant_id'];
                                    $contest_id = $rs['contest_id'];
                                    $con_id = $rs['con_id'];
                                    $nows = substr(time(), -5);
                                    $memid_hash = $memid.$nows;
                                    $votes = $rs['votes'];
                                    //if($votes==NULL) $votes=0;
                                    $timings3 = $rs['timings'];
                                    $media_type = $rs['media_type'];
                                    $views2 = kilomega($rs['views2']);
                                    $locs = "$citys, $states";
                                    $locs_full = $locs;

                                    $title_ = $rs['title'];
                                    $company_ads_ = $rs['company_ads'];
                                    $files_ = $rs['files'];
                                    $con_name = $names;
                                    $con_votes = $votes;
                                    $user_id_spon = $rs['user_id'];

                                    $rs2 = $this->sql_models->myEntrsMedia($contest_id, $memid);
                                    $fid = $rs2['id'];

                                    $difference = $timings3 - time();
                                    $expirys = convertTime2($difference);

                                    $start_date_contests="(not specified)";
                                    if(strlen($rs['start_date_contest'])>3)
                                        $start_date_contests = @date("jS M, Y h:i a", strtotime($rs['start_date_contest']));
                                    $start_date_contest1 = $rs['start_date_contest'];

                                    $getDetails_1 = $this->sql_models->getDetails($user_id_spon);
                                    $fb_id1 = $getDetails_1['fb_id'];
                                    $ig_id1 = $getDetails_1['ig_id'];
                                    $tw_id1 = $getDetails_1['tw_id'];
                                    

                                    $company_ads1 = $company_ads_;
                                    if($company_ads_=="") $company_ads1 = $files_;

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

                                    $mycmts = $this->sql_models->getContestantCmts($contest_id, $memid);
                                    $mycmts1 = @number_format($mycmts);

                                    $hasliked = $this->sql_models->hasliked($con_id, $memid, $this->myID);
                                    $paint_hrt="";
                                    if($hasliked==0) $paint_hrt = "-outline";

                                    $views1 = "<a href='javascript:void(0)' style='color:#DD6F00' class='like like_me like_me1$k1' autonum='$k1' contestant_id='$memid' con_id='$con_id' hasliked='$hasliked' mylikes='$mylikes' liker_id='$this->myID'><i class='mdi mdi-heart$paint_hrt mr-2'></i><font>$mylikes1</font></a>";

                                    $cmts1 = "<a href='#commentmeup' style='color:#DD6F00' class='commentme comment_me mycomment_div comment_me1$k1 video-play-icon' autonum='$k1' hisname='$nickname' memid='$memid' con_id='$con_id' pics='$pics' mycmts='$mycmts' myid='$this->myID'><i class='fa fa-commenting'></i> <font>$mycmts1</font></a>";

                                    $gen_num1=time();
                                    $gen_num1=substr($gen_num1,5);

                                    $url2 = base_url()."profile/$memid_hash/$names1/";
                                    $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                                    $names_1 = str_replace("&", "and", $names_1);

                                    $con_title1 = str_replace("&", "and", $con_title);

                                    $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me on *'$con_title1'*, thank you in advance.";

                                    $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me on '$con_title1', thank you in advance.";

                                    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                                    $mychats1 = "";
                                    // echo $this->myID."<br>";
                                    // echo $memid."<br>";
                                    //$memid=4;
                                    //if($this->myID==$memid){
                                        $mychats1 = $this->sql_models->noOfChats($memid);
                                        //$mychats1 = $this->sql_models->noOfChats1($memid);
                                        /*if($mychats1 > 0){
                                            $mychats1="<font class='mychat mychats$memid'><span>$mychats1</span></font>";
                                        }*/
                                        
                                        //if($mychats1<=0) $mychats1="";
                                    //}


                                    $mystatus = $this->sql_models->chkOnlinePresence($memid);
                                    $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                                    if($chechOnlineHidden) // visible
                                        $last_seen="<span class='active_o'>active</span>";
                                    else
                                        $last_seen="<span>hidden</span>";

                                    if($mystatus=="ash"){
                                        if(strtotime($online_timing)>0){
                                            if($chechOnlineHidden) // visible
                                                $last_seen="<span>$online_time</span>";
                                            else
                                                $last_seen="<span>hidden</span>";
                                        }else{
                                          $last_seen="<span>offline</span>";
                                        }
                                    }else{
                                        if($chechOnlineHidden) // visible
                                            $mystatus="green";
                                        else
                                            $mystatus="ash";
                                    }

                                ?>

                                    <div class="scroll_stop<?=$memid?>"></div>

                                    <div class="grid-container col-xl-3 col-lg-4 col-md-4 col-sm-4 pl-sm-10 pr-sm-10 pl-xs-5 pr-xs-5">
                                        <div class="grid-img" id1="<?=$id?>">
                                            <!-- <div class="chatWithMe" id="chatWithMe<?=$id?>" id1="<?=$id?>">
                                                <a href="#chatmeup" class="video-play-icon" hisname="<?=$nickname?>" con_id="<?=$con_id?>" memid="<?=$memid?>" myid="<?=$this->myID?>" pics="<?=$pics?>"><i class="fa fa-comments"></i><?=$mychats1?></a>
                                            </div> -->

                                            <div class="share_profile" id="share_profile<?=$id?>" id1="<?=$id?>">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><span><i class="fa fa-facebook-f"></i></span></a>
                                                    
                                                <a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" class="for_desktop1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>
                                                
                                                <a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" class="for_mobile1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>

                                                <a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><span><i class="fa fa-twitter"></i></span></a>
                                            </div>

                                            <?php if($media_type=="pic"){ ?>
                                                <div class="for_eye_view" id="for_eye_view<?=$id?>">
                                                    <a href="javascript:;" hrefs="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/" hisname="<?=$nickname_i?>" con_title="<?=$title_?>" con_ads="<?=$company_ads1?>" his_fb="<?=$fb_id1?>" his_ig="<?=$ig_id1?>" his_tw="<?=$tw_id1?>" start_vote="<?=$start_date_contests?>" names="<?=$con_name?>" mycontestid="<?=$contest_id?>" expiry="<?=$expirys?>" autonum="<?=$k1?>" myvotes="<?=@number_format($con_votes)?>" memids="<?=$memid?>" user_id_spon="<?=$user_id_spon?>" myid="<?=$this->myID?>" onpg="profile" caps="Vote <?=$con_name?>" con_id="<?=$con_id?>" fid="<?=$fid?>" memid="<?=$memid?>" pics="<?=$pics?>" scrollstop="<?=$memid?>">
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
                                                        $ffs = base_url()."media_uploads/$pics_entry";
                                                        $ffs1 = "media_uploads1/$pics_entry";
                                                        $ffs_wm = base_url()."images/logo_watermark.png";
                                                        watermark_image($ffs, $ffs_wm, $ffs1);

                                                        $pic_pathi = base_url()."media_uploads1/$pics_entry";
                                                        $width1="";
                                                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                        if($width1=="" || $width1<=0){
                                                            $ffs = base_url()."profiles/$pics";
                                                            $ffs1 = "profiles1/$pics";
                                                            $ffs_wm = base_url()."images/logo_watermark.png";
                                                            watermark_image($ffs, $ffs_wm, $ffs1);

                                                            $pic_pathi = base_url()."profiles1/$pics";

                                                            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                            if($width1=="" || $width1<=0)
                                                                $pic_pathi = base_url()."profiles/$pics";
                                                        }

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
                                                        $ffs = base_url()."profiles/$pics";
                                                        $ffs1 = "profiles1/$pics";
                                                        $ffs_wm = base_url()."images/logo_watermark.png";
                                                        watermark_image($ffs, $ffs_wm, $ffs1);

                                                        $pic_pathi = base_url()."profiles1/$pics";

                                                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                        if($width1=="" || $width1<=0){
                                                            $ffs = base_url()."profiles/$pics";
                                                            $ffs1 = "profiles1/$pics";
                                                            $ffs_wm = base_url()."images/logo_watermark.png";
                                                            watermark_image($ffs, $ffs_wm, $ffs1);
                                                            $pic_pathi = base_url()."profiles/$pics";
                                                        }
                                                    }

                                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                                    if($width1=="" || $width1<=0)
                                                        $pic_pathi = base_url()."images/no_passport.jpg";
                                                    
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
                                                        <i class="fa fa-play" hisname="<?=$nickname_i?>" con_title="<?=$title_?>" con_ads="<?=$company_ads1?>" his_fb="<?=$fb_id1?>" his_ig="<?=$ig_id1?>" his_tw="<?=$tw_id1?>" start_vote="<?=$start_date_contests?>" names="<?=$con_name?>" mycontestid="<?=$contest_id?>" expiry="<?=$expirys?>" autonum="<?=$k1?>" myvotes="<?=@number_format($con_votes)?>" memids="<?=$memid?>" user_id_spon="<?=$user_id_spon?>" myid="<?=$this->myID?>" onpg="profile" caps="Vote <?=$con_name?>" con_id="<?=$con_id?>" fid="<?=$fid?>" memid="<?=$memid?>" pics="<?=$pics?>" scrollstop="<?=$memid?>"></i>
                                                    </div>
                                                    <img src="<?=$pic_pathi?>" alt="" />

                                            <?php } ?>

                                            <div class="online_status"><font class="<?=$mystatus?>"></font><?=$last_seen?></div>
                                        </div>

                                        <div class="grid-content grid-content1">
                                            <h5><a href="#"><?=$nickname?></a></h5>
                                            <p style="margin: -16px 0 0 0 !important;">
                                                <font class="for_desktop2"><b>From:</b> <?=$locs?></font>
                                                <font class="for_mobile2"><b>From:</b> <?=$locs_full?></font>
                                                <b>Votes:</b> <font class="vote_counts<?=$contest_id.$memid;?>"><?=@number_format($votes);?></font><br>
                                                <?=$views1.$cmts1;?>
                                            </p>
                                        </div>

                                        <div class="">
                                            <span class="voteme_btn<?=$memid?>">
                                                <?php if($hasExpired){ ?>
                                                    <a class="arrow-button voteme_exp votedis" id="voteme" href="javascript:;">Vote Me</a>
                                                <?php }else{

                                                    if($this->myID == $user_id_spon && $this->myID>0){
                                                    ?>
                                                        <a class="arrow-button vote_user votedis" id="voteme" href="javascript:;">Vote Me</a>
                                                    <?php
                                                    }else{ ?>

                                                        <?php if($timeToVOte && strlen($start_date_contest1)>3){ ?>
                                                            <a class="arrow-button voteme voteme_j<?=$memid?> voteme_i<?=$memid?>" id="voteme" names="<?=$nickname?>" mycontestid="<?=$contest_id?>" autonum="<?=$k1?>" expiry="<?=$expirys?>" myvotes="<?=$votes?>" memids="<?=$memid?>" myid="<?=$this->myID?>" onpg="" caps="Vote Me" href="javascript:;">Vote Me</a>
                                                        <?php }else{ ?>
                                                            <a class="arrow-button vote_user1 votedis" id="voteme" start_vote="<?=$start_date_contests?>" href="javascript:;">Vote Me</a>
                                                        <?php } ?>

                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </span>

                                            <a class="arrow-button arrow-button_1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">Profile</a>
                                        </div>
                                    </div>

                                <?php
                                $k1++;
                                }
                                ?>
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

                
            <div class="col-xs-12_col-md-5 col-12 p-0 mt-xs-40 mb-xs-20 for_mobile div_entry">
                <?php include('leaderboard.php'); ?>
            </div>

        </div>

    </section>
</div>


<div class="participate_div" style="display: none;">
    <section class="section mt-0">
        <div class="container">
            <?php include('participate.php'); ?>
        </div>

        <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
                                <!-- 728x90 -->
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3834887523835766"
                                        data-ad-slot="3761951112"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
    </section>
</div>



