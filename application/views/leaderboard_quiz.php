
<p class="rlb"><span class="refresh_lb__qz" con_id="<?=$qzid?>">Click here to reload updates</span></p>
<div class="card border-0 sidebar sticky-bar_ rounded shadow">
    <p class="lb_title mb-10"><b style="color: #eee;">Top 10 Highest Scores</b></p>

    <div class="card-body_ pb-10">
        <div class="widget mb-4 pb-2 lb_details lb_details_ajax_qz">
            <div class="mt-3">
                <?php
                $empRecords_qz = $this->sql_models->fetchQuizScoresLB($qzid);
                $t=1;
                if($empRecords_qz){
                    foreach ($empRecords_qz as $rs) {
                        $names = ucwords(strtolower($rs['names']));
                        $nickname = ucwords(strtolower($rs['nickname']));
                        $names1 = strtolower($names);
                        if(strlen($names1)<=2) $names1 = strtolower($nickname);
                        if(strlen($names)<=2) $names = ucwords($nickname);
                        $names1 = str_replace(" ", "-", $names1);
                        $pics = $rs['pics'];
                        $scores = $rs['scores'];
                        $answers = $rs['answers'];

                        $answers = explode('||', $answers);
                        $answer_counts = count(array_unique($answers));

                        $memid = $rs['memid'];
                        $nows = substr(time(), -5);
                        $memid_hash = $memid.$nows;
                        $online_timing = date("Y-m-d g:i a", $rs['date_taken']);
                        $online_time = time_ago($online_timing);

                        $pic_pathi = base_url()."media_uploads1/$pics";
                        $width1="";
                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                        if($width1=="" || $width1<=0){
                            $pic_pathi = base_url()."profiles1/$pics";

                            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                            if($width1=="" || $width1<=0)
                                $pic_pathi = base_url()."profiles/$pics";
                        }

                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                        if($width1=="" || $width1<=0)
                            $pic_pathi = base_url()."images/no_passport.jpg";

                        if($t%2==0) $odds = "odds"; else $odds = "";


                        $mystatus = $this->sql_models->chkOnlinePresence($memid);
                        $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                        if($chechOnlineHidden) // visible
                            $last_seen="<span style='color:#093 !important;'>active</span>";
                        else
                            $last_seen="<span style='color:#777 !important;'>hidden</span>";

                        if($mystatus=="ash"){
                            if(strtotime($online_timing)>0){
                                if($chechOnlineHidden) // visible
                                    $last_seen="<span style='color:#777 !important;'>Seen: $online_time</span>";
                                else
                                    $last_seen="<span style='color:#777 !important;'>hidden</span>";
                            }else{
                              $last_seen="<span style='color:#777 !important;'>offline</span>";
                            }
                        }

                        ?>
                        <div class="clearfix post-recent inner_lb <?=$odds?>">
                            <div class="post-recent-thumb float-left">
                                <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                    <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                                </a>
                            </div>
                            <div class="post-recent-content content_quiz float-left">
                                <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a>
                                <span class="text-muted">Answered: <?=$answer_counts?> questions</span>
                                <span class="text-muted">Score: <?=@number_format($scores)?>%</span>
                                <span class="online_status_lb"><?=$last_seen?></span>
                            </div>
                        </div>
                    <?php
                    $t++;
                    }
                }else{
                    echo "<div style='padding: 20px 10px 30px 10px; text-align:center; color:#666; font-size: 18px;'>No members found here</div>";
                }
                ?>
            </div>
        </div>


        <div style="clear: both;"></div>
        <div class="hrs mt-10 mb-10"></div>


        <div class="widget">
            <div class="biz_div">
                <?php
                $get_ads = $this->sql_models->getADS('250x250', '', 'array', 2);
                $count_ads = $this->sql_models->getADSCounts('250x250');
                if($get_ads){
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

                        echo "<a href='$urls1' target='_blank'><img src='$files1'></a>";
                    }
                }

                $files1 = base_url()."images/ads-banner250.jpg";
                if($count_ads <= 0){
                    echo "<a href='javascript:;'><img src='$files1'></a>";
                    echo "<a href='javascript:;'><img src='$files1'></a>";
                }else if($count_ads <= 1){
                    echo "<a href='javascript:;'><img src='$files1'></a>";
                }
                ?>
            </div>


            <div class="lb_details lb_details2 mt-50 mb-90">
                <p class="lb_title mb-10"><b>Trending Contest</b>
                    <a href="<?=base_url()?>contests/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a></p>

                <?php
                $empRecordss = $this->sql_models->fetchMyRecs("", "", "", "", 5, 'contests', 'trend', '');
                $t=1;
                if($empRecordss){
                    foreach ($empRecordss as $rs) {
                        $id2 = $rs['id'];
                        $nows = substr(time(), -5);
                        $ids_hash = $id2.$nows;
                        $title = ucwords(strtolower($rs['title']));
                        $adv_title_f = cleanStr(strtolower($title));
                        $timings = $rs['timings'];
                        $files2 = $rs['files'];
                        $start_date_contest1 = $rs['start_date_contest'];
                        $start_date_contest = @date("jS M, Y", strtotime($rs['start_date_contest']));
                        $close_date_entry1 = $rs['close_date_entry'];
                        $currentTime = time();
                        $difference = $timings - $currentTime;
                        $c_expirys = convertTime1($difference);
                        $c_expirys = str_replace("time", "To Go", $c_expirys);
                        if($t%2==0) $odds = "odds"; else $odds = "";

                        $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $id2));

                        $contest_img = base_url()."contest_types/$files2";
                        $width1="";
                        list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                        if($width1=="" || $width1<=0)
                            $contest_img = base_url()."images/no-image.jpg";
                        ?>

                        <div class="clearfix post-recent inner_lb3 <?=$odds?>">
                            <div class="post-recent-thumb float-left"> <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                <img alt="img" src="<?=$contest_img?>" class="img-fluid rounded"></a>
                            </div>

                            <div class="post-recent-content post-recent-content2 float-left">
                                <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="mt-5" style="line-height: 22px;"><?=$title?></a>
                                <p class="vt_cnts vt_cnts3">
                                    <?php
                                    if(strtotime($start_date_contest1) <= time()){
                                        echo $c_expirys;
                                    }else{
                                        if(strtotime($close_date_entry1) >= time())
                                            echo "Entries in progress...";
                                        else
                                            echo "Voting Starts $start_date_contest";
                                    }
                                    ?>&nbsp;
                                    <span style="color: #666 !important; font-size: 1.1em; position: relative; top: 1px;">&bull;</span>&nbsp; <span style="color: #990 !important">Entries: <?=$noOfEntries?></span>
                                </p>
                            </div>
                        </div>

                        <?php
                        $t++;
                    }
                }else{
                    echo "<p class='p-20 pb-40' style='text-align:center; font-size: 16px; color: #999;'>No contests yet!</p>";
                }
                ?>
            </div>

            <div class="pt-30 pb-30">&nbsp;</div>
            <div class="">
                <div class="fb-page" data-href="https://www.facebook.com/icontestpro/" data-tabs="timeline" data-width="400" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/icontestpro/" class="fb-xfbml-parse-ignore"></blockquote></div>
            </div>


        </div>

    </div>
</div>