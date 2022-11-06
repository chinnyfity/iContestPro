<div style="clear: both;"></div>

<div class="row mt-20 mt-xs--20">
    <section class="next-draw-section pre_raffle">
      <div class="next-draw-area">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 pr-30 m-0 p-xs-0">
              <div class="next-draw-wrapper d-flex align-items-center row mb-70">

                <div class="next-draw-content col-sm-12 pl-xs-30 pr-xs-30">
                  <h2 class="title mt--10" style="color: #333; font-size: 28px;">Your VP is Needed</h2>
                  <p style="margin: 4px 0 0 0; color: #555">Your VP is needed to win a raffle ticket to stand a chance to win one or more of the items displayed above</p>
                </div>

                <div class="get_readys">
                  <div class="next-draw-content col-sm-12 pl-xs-30 pr-xs-30" style="margin-top: 10px; color: #444">
                    Get ready to answer <b><?=$noOfQuest?> questions</b> which include <b><?=$subjs?></b> and you will be timed <b><?=$seconds?> seconds</b> for each question. Each question answered <b>will remove 20VP</b> from your wallet, click on the button below to continue...<br>

                    <p class="mt-10">
                      <b>First Prize:</b> &#8358;<?=@number_format($prize1)?><br>
                      <?php
                      if($prize2!="") echo "<b>Second Prize:</b> &#8358;".@number_format($prize2)."<br>";
                      if($prize3!="") echo "<b>Third Prize:</b> &#8358;".@number_format($prize3)."<br>";
                      if($prize4!="") echo "<b>Fourth Prize:</b> &#8358;".@number_format($prize4)."<br>";
                      if($prize5!="") echo "<b>Fifth Prize:</b> &#8358;".@number_format($prize5)."<br>";
                      ?>
                    </p>

                    <p style="font-size: 18px; margin-top: 5px; font-weight: 600;" class="php_vp">
                      <?php
                      if($this->vps <= 0)
                        echo "<span style='color:red;'>You have insufficient VP to continue...</span>";
                      else if($this->vps >= 50)
                        echo "<span style='color:#090;'>You have ".$this->vps."VP and you are good to go...</span>";
                      else
                        echo "<span style='color:red;'>You have just ".$this->vps."VP left</span>";
                      ?>
                    </p>

                    <p style="font-size: 18px; margin-top: 5px; font-weight: 600; display: none;" class="ajax_vp"></p>
                  </div>

                  
                  <div class="col-xs-12 mt-30" style="text-align: center;">
                    <div class="row p_btns p_btns_2">
                        <div class="col-md-12 p-0">
                            <input type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:history.back();" value="< Back" />&nbsp;

                            <input type="button" class="cmd_start_myquiz p_btns1 pl-40 pr-40 pl-xs-30 pr-xs-30 ml-5 btn btn-primary waves-effect waves-light" memid="<?=$this->myID?>" myvps="<?=$this->vps?>" value="Proceed >" />
                        </div>
                    </div>
                  </div>


                  <div style="clear: both;"></div>
                  <div class="alert alert-danger alert_msgs alert_msg1 mt-20"></div>
                </div>

                <div class="fetch_questions container pl-xs-30 pr-xs-30" style="display: none;"></div>

                <input type='hidden' id='txt_no_of_quests' name='txt_no_of_quests' value='<?=$noOfQuest;?>'>
                <input type='hidden' id='quiz_section_id' value='<?=$qzid;?>'>

              </div>

              <?php
                include('leaderboard_quiz_winners.php');
              ?>
            </div>




            <div class="col-md-4 mt--80 mt-sm-40">
              <?php
              include('leaderboard_quiz.php');
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div style="clear: both;"></div>

    <hr class="mt-50 mb-20 hrs">

    <!-- <section class="next-jackpot-section section-padding mt-50 mt--sm-10 pl-sm-10 pr-sm-10 raffleDiv" style="display: none;">
    </section> -->


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


    

    
</div>

