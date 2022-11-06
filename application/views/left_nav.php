

<div class="card border-0 sidebar sticky-bar_ rounded shadow">
    <div class="card-body_ pb-10">
      
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


            <div class="lb_details lb_details2 mt-50">
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
                                    ?>
                                    <span style="color: #666 !important; font-size: 1.2em; position: relative; top: 1px;">&bull;</span>&nbsp;<span style="color: #09C">Entries: <?=$noOfEntries?></span>
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
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- icons -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-3834887523835766"
                    data-ad-slot="8062018429"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

        </div>

    </div>
</div>