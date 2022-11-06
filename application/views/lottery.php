


<div class="container all_prizes p-sm-0 pr-sm-0 mt--40 mt-sm-0">
  <div class="row">
    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 pr-sm-0 pl-sm-0">
      <div class="row">
        <div class="col-md-12 text-center" style="color:#000;">
          <div id="countdown">
            <div class="count-down"> 
              <img src="<?=$rfile1?>">
              <span class="count-number"><?=$rand_nums1?></span>
            </div> 

            <div class="count-down"> 
              <img src="<?=$rfile2?>">
              <span class="count-number"><?=$rand_nums2?></span>
            </div> 

            <div class="count-down"> 
              <img src="<?=$rfile3?>">
              <span class="count-number"><?=$rand_nums3?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div style="clear: both;"></div>

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

<div class="row mt-20 mt-xs--20">
    <section class="next-draw-section pre_raffle">
      <div class="next-draw-area">
        <div class="container">
          <div class="row justify-content-center">
            <div class="lg-offset-1 col-lg-10 sm-offset-0 sm-col-12 p-0">
              <div class="next-draw-wrapper d-flex align-items-center row">

                <div class="next-draw-content col-md-5 col-sm-5 pr-0">
                  <h2 class="title mt--10" style="color: #eee; font-size: 28px;">Your VP is Needed</h2>
                  <p style="margin: 4px 0 0 0; color: #ccc">Your VP is needed to win a raffle ticket to stand a chance to win one or more of the items displayed above</p>
                </div>

                <div class="next-draw-countdown col-md-5 col-sm-5 mt-20 mt--sm-10 p-0">
                  <div id="clock"></div>
                </div>

                <div class="next-draw-btn text-right col-md-3 col-sm-3 mt-0">
                  <?php
                  $expiredRaffle = $this->sql_models->expiredRaffle($raf_id);
                  if($expiredRaffle){
                    if($this->myID=="")
                      echo '<a href="javascript:;" class="cmn-btn btn-lg cmd_playnow2" style="opacity: 0.6">Play now</a>';
                    else
                      echo '<a href="javascript:;" class="cmn-btn btn-lg cmd_playnow">Play now</a>';
                  }else{
                    echo '<a href="javascript:;" class="cmn-btn btn-lg cmd_playnow1" style="opacity: 0.6">Play now</a>';
                  }
                  ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div style="clear: both;"></div>

    <section class="next-jackpot-section section-padding mt-50 mt--sm-10 pl-sm-10 pr-sm-10 raffleDiv" style="display: none;">
    </section>
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
    <div style="clear: both;"></div>


    <hr class="mt-50 mb-40 hrs">

    
    <div class="container">
      <!-- <div class="rows"> -->
        <div class="section-header_" style="text-align: center !important;">
          <h1 style="font-size: 30px;">Last Winner Results</h1>
          <?php if($old_title!=""){ ?>
            <p style="font-size: 18px; color: #444;" class="mt-0 mb-20 mb-sm--20">Result for the <?=$mycaps?> title, <?=ucwords($old_title)?> <?=$old_date?></p>
          <?php } ?>
        </div>

        <div class="tables mt-10">
          <div class="col-lg-12 inner_tbl p-0">
            <div class="col-md-3 col-3 ths">
              <p>Lottery Winner Names</p>
            </div>
            <div class="col-md-4 col-4 ths">
              <p>Numbers Selected</p>
            </div>
            <div class="col-md-2 col-2 ths">
              <p>Lucky Number</p>
            </div>
            <div class="col-md-3 col-3 ths">
              <p>Gift Won</p>
            </div>
            <div style="clear: both;"></div>


            <?php
              if($raf_wins){
                foreach($raf_wins as $post){
                  $reward_id = $post['rw_id'];
                  $selecteds1 = $post['selecteds'];
                  $rand_numbers = $post['rand_numbers'];
                  $mynumbers = $post['mynumbers'];

                  $rand_nums1 = $post['rand_nums1'];
                  $rand_nums2 = $post['rand_nums2'];
                  $rand_nums3 = $post['rand_nums3'];

                  $names = ucwords($post['names']);
                  if($names=="")
                    $names = ucwords($post['nickname']);

                  $myselected_nos = $this->sql_models->selectedNos($reward_id, $selecteds1);
                  ?>
                  <div class="col-md-3 col-xs-3 tds">
                    <p><?=$names?></p>
                  </div>
                  <div class="col-md-4 col-xs-4 tds">
                    <p>
                      <ul class="lottery_number">
                        <?php
                        if($myselected_nos){
                          foreach($myselected_nos as $post){
                            $mynumbers = $post['mynumbers'];
                            echo "<li>$mynumbers</li>";
                          }
                        }
                        ?>
                      </ul>
                    </p>
                  </div>

                  <div class="col-md-2 col-xs-2 tds">
                    <p>
                      <ul class="lottery_number">
                        <?php
                        if($myselected_nos){
                          foreach($myselected_nos as $post){
                            $mynumbers = $post['mynumbers']; // 4  6  71
                            $lucky_nos1 = $this->sql_models->luckyNos($reward_id, $rand_numbers, $mynumbers);
                            foreach($lucky_nos1 as $post){
                              $sel_nums = $post['rand_numbers'];
                              if($rand_nums1==$sel_nums) echo "<li>$sel_nums</li>";
                              if($rand_nums2==$sel_nums) echo "<li>$sel_nums</li>";
                              if($rand_nums3==$sel_nums) echo "<li>$sel_nums</li>";
                            }
                          }
                        }
                        ?>
                      </ul>
                    </p>
                  </div>
                  
                  <div class="col-md-3 col-xs-3 tds">
                    <?php
                    if($myselected_nos){
                      foreach($myselected_nos as $post){
                        $mynumbers = $post['mynumbers']; // 4  6  71
                        $lucky_nos1 = $this->sql_models->luckyNos($reward_id, $rand_numbers, $mynumbers);
                        foreach($lucky_nos1 as $post){
                          $sel_nums = $post['rand_numbers'];
                          if($rand_nums1==$sel_nums) echo "<p><img src='$rfile1'></p>";
                          if($rand_nums2==$sel_nums) echo "<p><img src='$rfile2'></p>";
                          if($rand_nums3==$sel_nums) echo "<p><img src='$rfile3'></p>";
                        }
                      }
                    }
                    ?>
                    
                  </div>
                  <?php
                }
              }else{
                echo '<div class="col-xs-12" style="text-align: center; padding:30px 10px; color: #333;">The winners are yet to be computed</div>';
              }
              ?>

          </div>
        </div>
      <!-- </div> -->
    </div>

    
</div>

