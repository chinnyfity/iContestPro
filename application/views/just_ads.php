<div class="widget">
    <div class="biz_div biz_div2">
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