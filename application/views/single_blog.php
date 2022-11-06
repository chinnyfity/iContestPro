
<?php
    $ids = $bdetls['id'];
    $ids3 = $ids;
    $nows = substr(time(), -5);
    $ids_hash = $ids.$nows;
    $con_title = ucwords($bdetls['titles']);
    $adv_title_f = cleanStr(strtolower($con_title));
    $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);
    $descrip = nl2br($bdetls['contents']);
    $views = kilomega($bdetls['views']);
    $dates = @date("jS M, Y", strtotime($bdetls['date_created']));

    $pic_pathi = base_url()."cblogs/$files";
    $width1="";
    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

    if($width1=="" || $width1<=0){
        $pic_pathi = base_url()."images/no_picture.jpg";
    }

    if($descrip=="") $descrip = "No Description";

    $comments = $this->sql_models->fetchCommentsBlogs('comments_blogs', $ids, 20);
    $commentsCounts = $this->sql_models->fetchCommentsBlogCounts('comments_blogs', $ids);
    $allCcounts = $commentsCounts;

    $url2 = base_url()."$ids_hash/join/$adv_title_f/";
    $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $con_title);
    $title_1 = str_replace("&", "and", $title_1);

    $title = str_replace("'", "&prime;", $con_title);
    $descrips_whatsapp = "*".ucwords($title)."*";

    $descrips = "'".ucwords($title);
    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

?>

<section class="section mt-40 mt-xs--10">
    <div class="container mb-40 p-xs-10">
        <div class="row">

            <div class="col-lg-8 col-md-6">
                
                <h1 class="mt--20 mb-20 font-23 for_mobile" style="color: #333;"><?=$page_title;?></h1>

                <div class="card blog blog-detail border-0 overflow-hidden_ rounded" style="background: #fff">
                    <?php if($files!=""){ ?>
                        <img src="<?=$pic_pathi?>" class="img-fluid img-top3 rounded-top" alt="">
                    <?php } ?>

                    <div class="card-body content p-xs-10 shadow-md">
                        <h1 class="mt-20 mb-20 font-25 for_desktop" style="color: #333;"><?=$page_title;?></h1>

                        <p class="text-muted text_muted_mob mt-3"><?=$descrip?></p>

                        <div class="post-meta post-meta2 mt-30 mb-10">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted like"><i class="mdi mdi-eye-outline mr-1"></i><?=$views?></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="mdi mdi-comment-outline mr-1"></i><?=$allCcounts?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="card shadow-md rounded border-0 mt-40 p-20 p-xs-10 pt-xs-20 pb-xs-20">
                    <div class="card-body_">
                        <h5 class="card-title mb-30">Comments (<?=$allCcounts?>)</h5>
                        <div class="all_comments">
                            <?php
                            if($comments){
                                foreach ($comments as $rs) {
                                    $cmt_id = $rs['id3'];
                                    //echo $cmt_id."sssss";
                                    $mem_id = $rs['mem_id'];
                                    $cmt_names = ucwords($rs['names']);
                                    $cmt_nick = ucwords($rs['nickname']);
                                    if(strlen($cmt_names)<=2) $cmt_names = ucwords($cmt_nick);
                                    $messages = nl2br($rs['messages']);
                                    $date_created = $rs['date_created'];
                                    $date_created = @date("jS M Y h:i a", strtotime($date_created));
                                    $replies = $this->sql_models->fetchReps('replies', $cmt_id, "");
                                ?>
                                    <div class="cmt_box<?=$cmt_id;?>">
                                        <p class="meta meta2 meta3">
                                            <a href="#"><?=$cmt_names?></a> - <?=$date_created?>
                                            <!--  - <a href="javascript:;" class="replythis" cmt_id="<?=$cmt_id?>">Reply Me</a> -->
                                        </p>
                                        <div class="comments_content">
                                            <?php if($mem_id==$this->myID){ ?>
                                            <p class="menu_icn" id="menu_icn" ids="<?=$cmt_id;?>"><i class="fa fa-ellipsis-h"></i></p>
                                            <div class="edit_div" id="edit_div<?=$cmt_id;?>">
                                                <span id='editpost' counters="<?=$cmt_id;?>" messages1="<?=strip_tags(ucfirst($messages));?>" ids="<?=$cmt_id;?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>

                                                <span style='border:none; color:red; cursor:pointer' id='delpost' ids="<?=$cmt_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                                            </div>
                                            <?php } ?>

                                            <p><?=ucfirst($messages)?></p>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }else{
                                echo "<p style='font-size: 18px; color: #555; margin: -10px 0 30px 0'>No comments yet!</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

             
                <div class="card shadow-md rounded border-0 mt-40 p-15 pt-5 p-xs-0">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Related Blog</h5>
                        <div class="row">
                            <?php
                            if($relateds){
                            $i = 1;
                            foreach($relateds as $post):
                                $ids1 = $post['id'];
                                $nows = substr(time(), -5);
                                $ids_hash = $ids1.$nows;
                                $title = $post['titles'];
                                $adv_title_f = cleanStr(strtolower($title));
                                $files = $this->sql_models->fetchBlogFile('blogs_images', $ids1);

                                $pic_pathi = base_url()."cblogs/$files";
                                $width1="";
                                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                if($width1=="" || $width1<=0){
                                    $pic_pathi = base_url()."images/no_picture.jpg";
                                }

                                $dates = @date("jS M, Y", strtotime($post['date_created']));
                                $views1 = kilomega($post['views']);

                                $url2 = base_url()."$ids_hash/join/$adv_title_f/";
                                $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                                $title_1 = str_replace("&", "and", $title_1);

                                $title = str_replace("'", "&prime;", $title);
                                $descrips_whatsapp = "*".ucwords($title)."*";

                                $descrips = "'".ucwords($title);
                                $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                                $commentsCounts = $this->sql_models->fetchCommentsBlogCounts('comments_blogs', $ids1);
                                $allCcounts1 = $commentsCounts;
                            ?>
                                <div class="col-lg-6 mt-4 mb-20 pt-2">
                                    <div class="card blog blog2 blog_single rounded border-0 shadow-md">
                                        <?php if($files!=""){ ?>
                                        <div class="position-relative">
                                            <a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/">
                                                <img src="<?=$pic_pathi?>" class="card-img-top rounded-top" alt="...">
                                                <div class="overlay rounded-top bg-dark"></div>
                                            </a>
                                            <div class="author">
                                                <small class="text-light date"><i class="mdi mdi-calendar-check"></i> <?=$dates?></small>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <div class="card-body content">
                                            <h5><a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="card-title title  text-dark"><?=$title?></a></h5>
                                            <div class="post-meta d-flex justify-content-between mt-3">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-dark like"><i class="mdi mdi-eye-outline mr-1"></i><?=$views1?></a></li>

                                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-dark comments"><i class="mdi mdi-comment-outline mr-1"></i><?=$allCcounts1?></a></li>
                                                </ul>
                                                <a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="text-dark readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                            </div>
                                        </div>
                                  
                                    </div>
                                </div>

                            <?php
                            endforeach;
                            }else{
                                echo "<p class='p-20 pb-0' style='color:#666;'>No related title found!</p>";
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>



                <div class="card shadow-md rounded border-0 mt-40 p-10 pb-30 mb-sm-40">
                    <div class="card-body p-xs-0 mt-xs-10">
                        <div class="comment_div" style="display: nones;">
                            <h5 class="mt-10" style="font-size: 24px;">Write a Comment</h5>

                            <form class="mt-20 cmt_section comments_form" autocomplete="off">

                                <input name="txtcontID" id="txtcontID" type="hidden" value="<?=$ids3?>" />
                                <input name="txtrepID" id="txtrepID" type="hidden" />
                                <input name="edit_ids" id="edit_ids" type="hidden" />
                                <input name="txtpgs" id="txtpgs" value="blog" type="hidden" />

                                <div class="row">
                                    <div class="col-md-12 mb-10">
                                        <div class="form-group position-relative">
                                            <label>Your Comment</label>
                                            <textarea id="message" placeholder="Your Comment" name="txtcomment_msg" id="txtcomment_msg" class="form-control txtcomment_msg" required=""></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 pr-10 pl-sm-15 pr-sm-15">
                                        <div class="form-group position-relative">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input id="name" name="txtcomment_name" disabled="" value="<?=ucwords($this->myfullname)?>" type="text" placeholder="Name" class="form-control pl-5" required="" style="color: #666 !important; cursor: not-allowed;">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 pl-10 pl-sm-15 pr-sm-15 mt-sm-10">
                                        <div class="form-group position-relative">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input id="email" type="email" placeholder="Email" name="txtcomment_mail" class="form-control pl-5" required="" disabled="" style="color: #666 !important; cursor: not-allowed;" value="<?=$this->mymail?>">
                                        </div>
                                    </div>

                                    <div style='clear:both'></div>

                                    <div class="offset-lg-2 col-lg-8 offset-md-0 col-md-12 offset-xs-0 col-xs-12 mt-20 mt-xs-10">
                                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                        <div class="send send_cmts">
                                            <div class="row p-xs-10">
                                                <div class="col-md-4 col-5 pr-5 pr-xs-5">
                                                    <button type="button" class="btn btn-primary btn-block cmd_backToBlog curve_btn">< Back</button>
                                                </div>

                                                <div class="col-md-8 col-7 pl-5 pl-xs-5">
                                                    <button type="button" pgs="blog" class="btn btn-primary btn-block cmd_comment curve_btn1">Send Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="card border-0 sidebar sticky-bar rounded shadow-md">
                    <div class="card-body">
                        <?php require('nav_blog.php') ?>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</section>




