
<!-- Job List Start -->
<section class="section mt-30 m-sm--10 mb-xs-70">
    
    <div class="contents_div_2"></div>

    <div class="container">
        <div class="row">
            <p class="srch_info">To view all, clear the search box and click on search button</p>
            <div class="col-md-12 p-0">
                <div class="contents_div">
                    <?php
                    if($blog1){ ?>
                        <div class="container mt--20 mb-40 mt-sm-20 mt-xs--10 mb-xs-20" style="color:#555 !important; font-size:16px; text-align:center;">Showing <?php echo "$record of $recordPerPage of $recordCount1";?> contests found</div>

                        <?php
                        $i = 1;
                        foreach($blog1 as $post):
                            $ids = $post['id'];
                            $nows = substr(time(), -5);
                            $ids_hash = $ids.$nows;
                            $title = $post['titles'];
                            $descrip = $post['contents'];
                            $adv_title_f = cleanStr(strtolower($title));
                            $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);

                            $pic_pathi = base_url()."cblogs/$files";
                            $width1="";
                            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                            if($width1=="" || $width1<=0){
                                $pic_pathi = base_url()."images/no_picture.jpg";
                            }

                            if($files==""){
                                if(strlen($descrip)>300) $descrip = substr($descrip, 0, 300)."...";
                            }else{
                                if(strlen($descrip)>100) $descrip = substr($descrip, 0, 100)."...";
                            }

                            $dates = @date("jS M, Y", strtotime($post['date_created']));
                            $views = kilomega($post['views']);
                            //if($views>0) $views1 = "$views Views"; else $views1 = "$views View";

                            $url2 = base_url()."$ids_hash/join/$adv_title_f/";
                            $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                            $title_1 = str_replace("&", "and", $title_1);

                            $title = str_replace("'", "&prime;", $title);
                            $descrips_whatsapp = "*".ucwords($title)."*";

                            $descrips = "'".ucwords($title);
                            $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                            $comments = $this->sql_models->fetchCommentsBlogs('comments_blogs', $ids, 20);
                            $commentsCounts = $this->sql_models->fetchCommentsBlogCounts('comments_blogs', $ids);
                            $allCcounts = $commentsCounts;

                            if(strlen($title)>55) $title = substr($title, 0, 55)."...";
                        ?>
                        <div class="col-lg-6 col-md-12 col-12 mb-30 pb-2">
                            <div class="card blog blog2 blog3 rounded_ border-0 shadow overflow-hidden">
                                <div class="row align-items-center_ no-gutters">
                                    <?php if($files!=""){ ?>
                                    <div class="col-md-6">
                                        <img src="<?=$pic_pathi?>" class="img-fluid card-img-top img-top1" alt="">
                                        <div class="overlay bg-dark"></div>
                                        <div class="author">
                                            <!-- <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small> -->
                                            <small class="text-light date"><i class="mdi mdi-calendar-check"></i> <?=$dates?></small>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php
                                    if($files=="")
                                        echo '<div class="col-md-12">';
                                    else
                                        echo '<div class="col-md-6">';
                                    ?>
                                        <div class="card-body content">
                                            <h5><a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="card-title title text-dark"><?=$title?></a></h5>
                                            <p class="text-muted mb-0" style="line-height: 22px;"><?=$descrip?></p>
                                            <div class="post-meta post-meta1 d-flex justify-content-between mt-3">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-dark like"><i class="mdi mdi-eye-outline mr-1"></i><?=$views?></a></li>

                                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-dark comments"><i class="mdi mdi-comment-outline mr-1"></i><?=$allCcounts?></a></li>
                                                </ul>
                                                <a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="text-dark readmore readmore1">Read More<i class="mdi mdi-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        endforeach;
                    }
                    ?>

                    <div style="clear: both;"></div>
                    <div class="mb-sm-30 mt-xs-50 mb-xs-0">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>




