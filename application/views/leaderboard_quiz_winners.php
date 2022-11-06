
<div class="border-0 sidebar rounded_ shadow col-xs-12 mt-0 p-0">
    <p class="lb_title"><b style="color: #eee;">Top 20 Past Winners</b></p>

    <div class="pb-10">
        <div class="widget mb-4_ pb-2 lb_details">
            <div class="mt-0">
                <?php
                $empRecords_qz = $this->sql_models->fetchQuizWinnerssLB($qzid);
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
                        $positns = $rs['positns'];
                        $prize1 = $rs['prize1'];
                        $prize2 = $rs['prize2'];
                        $prize3 = $rs['prize3'];
                        $prize4 = $rs['prize4'];
                        $prize5 = $rs['prize5'];

                        if($positns==1) $myprize = $prize1;
                        if($positns==2) $myprize = $prize2;
                        if($positns==3) $myprize = $prize3;
                        if($positns==4) $myprize = $prize4;
                        if($positns==5) $myprize = $prize5;

                        if($positns==1) $posn="st";
                        else if($positns==2) $posn="nd";
                        else if($positns==3) $posn="rd";
                        else $posn="th";

                        
                        $quiz_title = ucwords($rs['quiz_title']);
                        
                        $nows = substr(time(), -5);
                        $memid_hash = $memid.$nows;
                        $online_timing = date("Y-m-d g:i a", $rs['date_taken']);
                        $online_time = time_ago($online_timing);
                        $online_timing1 = date("jS M Y h:i a", $rs['date_taken']);

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
                        <div class="clearfix post-recent inner_lb mb-10 <?=$odds?>">
                            <div class="post-recent-thumb col-md-1 col-xs-1 p-0 mt-10">
                                <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                    <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                                </a>
                            </div>

                            <div class="post-recent-content post-recent-content_qz1 col-md-10 col-xs-10 pl-20 pl-xs-0 mt-10">
                                <div class="col-md-6 p-0">
                                    <p class="text-muted" style="margin-bottom: 6px;"><a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a></p>
                                    <div class="online_status_lb col-md-12 p-0"><?=$last_seen?></div>
                                    <span class="text-muted">Quiz Title: <b><?=$quiz_title?></b></span>
                                    <span class="text-muted">Answered: <?=$answer_counts?> questions</span>
                                    <span class="text-muted">Score: <?=@number_format($scores)?>%</span>
                                    <span class="text-muted">Position: <b><?=$positns."<sup>".$posn."</sup>"?></b></span>
                                </div>

                                <div class="col-md-6 p-0">
                                    <span class="text-muted for_desktop">&nbsp;</span>
                                    <span class="text-muted for_desktop">&nbsp;</span>
                                    <span class="text-muted">Prize Won: <b>&#8358;<?=@number_format($myprize)?></b></span>
                                    <span class="text-muted" style="line-height: 24px;">Date Participated: <br><?=$online_timing1?></span>
                                </div>
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
    </div>
</div>