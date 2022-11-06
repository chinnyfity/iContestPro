

<div class="notificatns mt-50 mb-90" style="display: none;">
    <div class="container">
        <p style="text-align: center;" class="back_from_notify"><span>Go Back</span></p>
        <?php
        $notify_msgs = $this->sql_models->fetchNotificatns('all_notifications', $this->myID);
        if($notify_msgs){
            foreach($notify_msgs as $post){
                $memid = $post['memid'];
                $what_page = base_url().$post['what_page'];
                $page_id = $post['page_id'];
                $actns = $post['actns'];
                $page_id1 = substr($page_id, 0, -5);

                if(strlen($page_id1)>30) $page_id1 = substr($page_id1, 0, 30)."...";

                $has_read = $post['has_read'];
                if($actns=="joined" || $actns=="dropped a comment you are following on" || strpos($actns, "manually credited") !== true)
                    $date_created = date("Y-m-d g:i a", strtotime($post['date_created']));
                else
                    $date_created = date("Y-m-d g:i", strtotime($post['date_created']));
                $date_created1 = time_ago($date_created);
                $getMembers = $this->sql_models->getDetailsArr($memid);
                $noti_id = $getMembers['id'];
                $noti_name = ucwords(strtolower($getMembers['names']));
                $noti_nickname = ucwords(strtolower($getMembers['nickname']));
                if(strlen($noti_name)<=2) $noti_name = ucwords(strtolower($noti_nickname));

                $noti_name1 = $noti_name;
                if($noti_id <= 0)
                    $noti_name1 = "An admin";

                //echo strtolower($noti_name);
                //echo $noti_name;

                $pics = $getMembers['pics'];

                $pic_path2 = base_url()."profiles1/$pics";
                $width1=""; $width2="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width1=="" || $width1<=0)
                    $pic_path2 = base_url()."profiles/$pics";

                list($width2, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width2=="" || $width2<=0)
                    $pic_path2 = base_url()."images/no_passport.jpg";

                $getContestName = ucwords(strtolower($this->sql_models->getContestName($page_id1)));

                $getContestName1 = "";
                if($getContestName!="")
                    $getContestName1 = "\"$getContestName\"";

                $notify_divs_color = "";
                if($has_read==0)
                    $notify_divs_color = "notify_divs_color";

                $memCounts = $this->sql_models->memCounts('all_notifications', $this->myID, $page_id, $actns);
                $memCounts1 = $memCounts-1;

                $plurals = "";
                if($memCounts1 > 1) $plurals = "s";


                if($memCounts1 >= 2)
                    $memCounts1 = "and $memCounts1 other person$plurals";

                else if($memCounts1 >= 1)
                    $memCounts1 = "and $memCounts1 other person$plurals";

                else
                    $memCounts1 = "";

                $actns_caption="";
                if($actns=="commented on" || $actns=="joined") $actns_caption = "your contest";
                else if($actns=="voted") $actns_caption = "for you on the contest";
                ?>

                <div class='notify_divs <?=$notify_divs_color?> container'>
                    <a href="<?=$what_page?>">
                        <div class='row'>
                            <div class='col-md-1 col-2 pl-20 pr-0 pl-sm-10'>
                                <div class="img-thumbs">
                                    <img src="<?=$pic_path2?>" alt="" class="img-fluid rounded" />
                                </div>
                            </div>
                            <div class='col-md-10 col-10 pl-0 pl-sm-5'>
                                <?="<b>$noti_name1 $memCounts1</b> <i style='color:#990'>$actns</i> $actns_caption <b>$getContestName1</b><br>";?>
                                <span><?=$date_created1;?></span>
                            </div>
                        </div>
                    </a>
                </div>

                <?php
            }
        }else{
            echo "<p style='color:#666; font-size: 17px; text-align: center; padding: 10px;'>No notifications yet!</p>";
        }
        ?>
    </div>
</div>

<?php
if($page_name!="join"){
echo '<div class="container mt-0 m-sm--40 p-0 mb-60 mb-xs-20 div_entry">';
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
                    echo "<div class='col-md-6 col-xs-12 pl-0 pl-30 pl-sm-5 pr-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
                else if($p==2)
                    echo "<div class='col-md-6 col-xs-12 pl-0 pl-30 pl-sm-5 pr-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
                        echo "<a href='$urls1' target='_blank'><img src='$files1'></a>
                    </div>";
                $p++;
            }
        }

        $files1 = base_url()."images/empty_space.jpg";

        if($count_ads <= 0){
            echo "<div class='col-md-6 col-xs-12 pl-0 pr-30 pl-sm-5 pr-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
            ?>
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
                <?php 
            echo "</div>";

            echo "<div class='col-md-6 col-xs-12 pl-0 pl-30 pl-sm-5 pr-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>
                <a href='#'><img src='$files1'></a>
            </div>";
        }else if($count_ads <= 1){
            echo "<div class='col-md-6 col-xs-12 pl-0 pl-30 pl-sm-5 pr-sm-5 pl-xs-20 pr-xs-20' style='overflow: hidden;'>";
                ?>
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
                <?php 
            echo "</div>";
        }
    echo '</div>';
    echo '</div>';
echo '</div>';
}
?>


    <div class="position-relative">
        <div class="shape overflow-hidden text-light">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>


    <div class="position-relative">
        <div class="shape overflow-hidden text-footer">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <?php
    $reg_conts_cnt = $this->sql_models->calCounts('contests', '', '', '');
    $reg_mem_cnt = $this->sql_models->calCounts('members', '', '', '');
    $cur_contestants_cnt = $this->sql_models->calCounts('entries', 'contestant_id', 'members', '');
    $winners_cnt = $this->sql_models->calCounts('winners', '', '', '');
    $media_cnt = $this->sql_models->calCounts('entry_media', '', '', '');
    //$data['visitors = $this->sql_models->calCounts('visitors', '', '', '');
    ?>


    <div id="footer1"></div> <!-- Just for scrolling down here -->

    <footer class="footer mobile_footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2 mb-sm-10">
                    <span class="logo-footer">iContestPRO</span>
                    <div class="stats">
                        <?php $cur_contestants_cnt = $this->sql_models->calCounts('entries', 'contestant_id', 'members', ''); ?>
                        <p><b><?=@number_format($reg_mem_cnt)?></b> Registered Members</p>
                        <p><b><?=$cur_contestants_cnt?></b> Current Contestants</p>
                        <p><b><?=@number_format($reg_conts_cnt)?></b> Contests so far</p>
                        <p><b><?=@number_format($winners_cnt)?></b> Winners So Far</p>
                        <p><b><?=@number_format($media_cnt)?></b> Photos & Videos Uploads</p>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-2 col-md-4 col-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <ul class="list-unstyled footer-list mt-4">
                        <li><a href="<?=base_url()?>#home" class="text-foot">Home Page</a></li>
                        <li><a href="<?=base_url()?>contests/#contests" class="text-foot">Contests</a></li>
                        <li><a href="<?=base_url()?>blog/#blog" class="text-foot">Blog</a></li>
                        <li><a href="<?=base_url()?>entries/#entries" class="text-foot">Explore Entries</a></li>
                        <li><a href="<?=base_url()?>contests-leaderboard/#contests" class="text-foot">Contest Leaderboard</a></li>
                        <li><a href="<?=base_url()?>entries-leaderboard/#entries" class="text-foot">Entries Leaderboard</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mt-sm-0 pt-2 pt-sm-0">
                    <!-- <h4 class="text-light footer-head">Usefull Links</h4> -->
                    <ul class="list-unstyled footer-list mt-4">
                        <li><a href="<?=base_url()?>voters-leaderboard/#voters" class="text-foot">Voters Leaderboard</a></li>
                        <li><a href="<?=base_url()?>about/#about" class="text-foot">About Us</a></li>
                        <li><a href="#popup_div" class="text-foot video-play-icon link_howitwk">How It Works</a></li>
                        <li><a href="<?=base_url()?>contact/#contact" class="text-foot">Contact Us</a></li>
                        <li><a href="<?=base_url()?>blog/#blog" class="text-foot">Our Blog</a></li>
                        <li><a href="<?=base_url()?>register/#register" class="text-foot">Register</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-10 pt-2 pt-sm-0">
                    <!-- <h4 class="text-light footer-head">&nbsp;</h4> -->
                    <ul class="list-unstyled footer-list mt-0">
                        <li><a href="<?=base_url()?>faqs/#faqs" class="text-foot">FAQs</a></li>
                        <li><a href="<?=base_url()?>sponsor-contest/#sponsor" class="text-foot">Sponsoring Contest</a></li>
                        <li><a href="<?=base_url()?>advert-placements/#advert-placements" class="text-foot">Advert Placements</a></li>
                        <li><a href="<?=base_url()?>terms-of-use/#terms" class="text-foot">Terms of Use</a></li>
                        <li><a href="<?=base_url()?>privacy-policy/#privacy" class="text-foot">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <footer class="footer footer-bar">
        <div class="container text-center">
            <div class="row align-items-center_">
                <div class="col-sm-6">
                    <div class="text-sm-left">
                        <p class="mb-0">© 2020 iContestPRO</p>
                    </div>
                </div>

                <div class="col-sm-6 mt-xs-10">
                    <ul class="list-unstyled social-icon social text-sm-right mb-0">
                        <li class="list-inline-item"><a href="https://web.facebook.com/iContestpro/" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>

                        <li class="list-inline-item"><a href="https://www.instagram.com/icontestprong/" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>

                        <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

  

    <a href="#" class="back-to-top rounded text-center" id="back-to-top">
        <i data-feather="chevron-up" class="icons d-inline-block"></i>
    </a>




    <?php if($page_name == "profile"){ ?>
        <script src="<?=base_url()?>js/jquery.min.js"></script>
    <?php }else{ ?>
        <script type="text/javascript" src="<?=base_url()?>js/jquery-1.11.1.min.js"></script>    
    <?php } ?>

<!-- js libraries -->
    <script src="<?=base_url()?>js/owl.carousel.min.js"></script>
    <script type="text/javascript">

        jQuery(window).load(function () {
            jQuery(".grid-carousel").owlCarousel({
                items: 1,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                dots: false,
                autoHeight: true,
                margin: 5,
                mouseDrag: true,
                smartSpeed: 800,
                navText: ['', ''],
                nav: false,
                loop: true,
                lazyLoad: false,
                animateIn: 'zoomIn',
                animateOut: 'zoomOut'
            });
        });
    </script>

    <script src="<?=base_url()?>js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>js/scrollspy.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?=base_url()?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>js/magnific.init.js"></script>
    <!-- SLIDER -->

    <script src="<?=base_url()?>js/owl.init.js"></script>
    <!-- Icons -->
    <script src="<?=base_url()?>js/feather.min.js"></script>
    <!-- <script src="js/unicons-monochrome.js"></script> -->
    <!-- Switcher -->
    <script src="<?=base_url()?>js/switcher.js"></script>

    <!-- Main Js -->
    <script src="<?=base_url()?>js/app.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/jscripts.js"></script>
        

    <script type="text/javascript">
    jQuery(window).load(function () {
        jQuery("#models").owlCarousel({
            items: 1,
            autoplay: true,
            margin: 20,
            dots: false,
            smartSpeed: 800,
            navText: [' ', ' '],
            nav: true,
            loop: true,
            navRewind: false,
            lazyLoad: true,
            autoplayHoverPause: true,
            responsive: {
                481: {
                    items: 2,
                    margin: 20,
                },
                641: {
                    items: 2
                },
                1025: {
                    items: 4,
                    margin: 25,
                }
            }
        });

        jQuery("#models2").owlCarousel({
            items: 2,
            autoplay: true,
            margin: 0,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 3000,
            navText: [' ', ' '],
            nav: false,
            loop: true,
            navRewind: false,
            lazyLoad: true,
            autoplayHoverPause: true,
            responsive: {
                481: {
                    items: 2,
                    margin: 20,
                },
                641: {
                    items: 3,
                    margin: 0
                },
                1025: {
                    items: 4,
                    margin: 0
                }
            }
        });


        jQuery("#featured_contests").owlCarousel({
            items: 1,
            autoplay: false,
            margin: 20,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 3000,
            navText: [' ', ' '],
            nav: false,
            loop: true,
            navRewind: false,
            lazyLoad: true,
            autoplayHoverPause: true,
            responsive: {
                481: {
                    items: 1,
                    margin: 20,
                },
                641: {
                    items: 3,
                    margin: 20
                },
                1025: {
                    items: 4,
                    margin: 20
                }
            }
        });

    });
    </script>

    <script type="text/javascript" src="<?=base_url()?>js/colorbox.js"></script>

    <script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#model-gallery a").colorbox({
            rel: 'photo-gallery',
            title: function () {
                return jQuery(this).data('title');
            },
            maxWidth: '100%',
            maxHeight: '100%'
        });
    });
    </script>

    <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/fnReloadAjax.js"></script>
    <script src="<?=base_url();?>assets/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>


    <script>
    var site_urls = $('#txtsite_url').val();
    var txt_pagename = $('#txtpage_name').val();
    var start_date = "";
    var end_date = "";
    <?php $url_tasks = $this->uri->segment(1); ?>
    var param1 = "<?=$url_tasks?>";

    if(isNaN(param1)===false)
        param1 = param1+"/";
    else
        param1 = "";

    //alert(txt_pagename);

    <?php if($url_tasks!=""){ ?>
    var urls = site_urls+"node/fetch_records/"+txt_pagename+"/"+param1;
    <?php }else{ ?>
    var urls = site_urls+"node/fetch_records/"+txt_pagename+"/";
    <?php } ?>


    //alert(urls)

    var dataTable = $('#tbl_leaderbd, #tbl_vp_market, #tbl_vleaderbd__, #tbl_entleaderbd').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        //"order":[],
        "ajax":{
            url : urls,
            type: "post"
        },
        "columnDefs":[
        {
            "target":[0,3,4],
            "orderable": false
        }
        ],
    });
    </script>


    <script src="<?=base_url()?>plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url()?>js_adm/dialogs.js"></script>
<!-- js libraries -->

    
    
    <?php if($page_name == "profile"){ ?>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
        </script>
        <script src="<?=base_url()?>js/pgwSlideshow/picturefill.min.js"></script>
        <script src="<?=base_url()?>js/pgwSlideshow/lightgallery-all.min.js"></script>
        <script src="<?=base_url()?>js/pgwSlideshow/jquery.mousewheel.min.js"></script>

    <?php } ?>
    


</body>

</html>

<?php if($page_name == "profile" || $page_name == "join"){ ?>
<script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<?php } ?>