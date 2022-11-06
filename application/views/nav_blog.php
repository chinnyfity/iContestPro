
    <!-- <form id="searchform" class="searchbox mt--20 cmd_search_fields">
        <input type="text" id="search" class="searchtext txtsrch form-control" placeholder="Keyword..." />
        <button type="button" class="fa-input cmd_search"><i class="fa fa-search"></i></button>
    </form> -->


    

    <?php $latest_posts = $this->sql_models->fetchMyLatestBlogs('blogs', 8); ?>

    <!-- <div class="sidebar-box mt-10"> -->
    <div class="widget mb-4 pb-2">
        <!-- <h2>Latest Posts</h2> -->
        <h4 class="widget-title widget-title1">Recent Post</h4>
        <div class="mt-4">
            <?php
                if($latest_posts){
                $i = 1;
                foreach($latest_posts as $post):
                    $ids = $post['id'];
                    $nows = substr(time(), -5);
                    $ids_hash = $ids.$nows;
                    $title = $post['titles'];
                    $descrip = $post['contents'];
                    if(strlen($descrip)>100) $descrip = substr($descrip, 0, 100)."...";
                    $adv_title_f = cleanStr(strtolower($title));
                    $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);

                    $pic_pathi = base_url()."cblogs/$files";
                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0){
                        $pic_pathi = base_url()."images/no_picture.jpg";
                    }

                    $dates = @date("jS M, Y", strtotime($post['date_created']));
                    $views = kilomega($post['views']);
                    if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                ?>
                    <div class="clearfix post-recent post-recent2">
                        <div class="post-recent-thumb float-left">
                            <a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/">
                                <img alt="img" src="<?=$pic_pathi?>" class="img-fluid card-img-top img-top2 rounded1">
                            </a>
                        </div>
                        <div class="post-recent-content post-recent-content1 float-left"><a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/"><?=ucfirst($title)?></a>
                            <span class="text-muted mt-2"><?=$dates?></span></div>
                    </div>
                <?php
                endforeach;
                }
            ?>    
        </div>
    </div>

    <div class="hrs"></div>



    <div class="widget mb-4 pb-2">
        <div id="search2" class="widget-search mt-4 mb-0">
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
        </div>
    </div>
