<main id="main">
    <div class="bringups"></div>
    <div id="slider-container" class="slider-container1">
        <div id="home-slider" class="home-slider">
            <div>
                <img src="<?=base_url()?>images/slide2i.jpg" data-animation="image-zoom scale-right" class="scale-right scale-right1" alt="">
                <div class="ns_slideContent for_mobile1">
                    <div class="bottom-right">
                        <h1 class="animatedmedium slideInLeft">Welcome to iContestPRO</h1>
                        <p class="animated slideInLeft"><span>Have Fun and Win BiG!</span></p>
                    </div>
                </div>
            </div>

            <div>
                <img src="<?=base_url()?>images/slide4.jpg" data-animation="image-zoom scale-right" class="scale-left scale-left1" alt="">
                <div class="ns_slideContent for_mobile1">
                    <div class="bottom-left">
                        <h1 class="animatedmedium slideInRight">We Bring you Top Opportunity</h1>
                        <p class="animated slideInRight"><span>To Win BiG across Africa...</span></p>
                    </div>
                </div>
            </div>

            <?php
            $get_ads1 = $this->sql_models->getADSBanner();
            if($get_ads1){
                foreach($get_ads1 as $post){
                    $adv_title = $post['title'];
                    $adv_title_f = cleanStr(strtolower($adv_title));
                    $adv_files = $post['files'];
                    $adv_id = $post['consid'];
                    $nows = substr(time(), -5);
                    $ids_hash = $adv_id.$nows;
                    $adv_timings = $post['timings1'];
                    $files1 = base_url()."contest_types/$adv_files";

                    $currentTime = time();
                    $difference = $adv_timings - $currentTime;
                    $c_expirys1 = convertTime1($difference);
                    $c_expirys1 = str_replace("time", "To Go", $c_expirys1);
                    if(strlen($adv_title)>40) $adv_title = substr($adv_title, 0, 40)."...";
                    ?>

                    <div>
                        <div class="fadeimg" id="openurl" hrefs="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"></div>
                        <img src="<?=$files1?>" data-animation="image-zoom scale-right" alt="">
                        <div class="ns_slideContent for_mobile1">
                            <div class="bottom-left">
                                <h1 class="animatedmedium slideInLeft" id="openurl" hrefs="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$adv_title?></h1>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>