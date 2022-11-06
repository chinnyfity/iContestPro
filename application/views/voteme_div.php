
<div class="default_dv" style="display: nones;">
    <p class="p_name p_name1 pl-10 pr-10" style="line-height: 24px;">Loading...</p>
    <p class="p_litle">Please help this contestant to be the first winner</p>

    <?php $timeToVOte = $this->sql_models->timeToVOte($contestids); 
    if($timeToVOte || strlen($start_date_contest1)<3){

    ?>

        <div class="div_cover">
            <input id="txtcon_id" value="<?=$cid_id?>" type="hidden">
            <input id="txtmem_id" type="hidden">
            <input id="txtmyvotes" type="hidden">
            <input id="txtv_names" type="hidden">
            <input id="txtsponsorID" value="<?=$user_id?>" type="hidden">
            <input id="txtexpiry" type="hidden">
            <input id="txtautonum" type="hidden">
            <input id="txtcaps" type="hidden">
            <input id="txtmyid" type="hidden" value="<?=$this->myID?>">

            <div class="select_vote vote_1 container p-0 mt-sm-10" style="display: nones">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- regico -->
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-3834887523835766"
                                data-ad-slot="3869097324"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                <?php if($premiums=="free" || $premiums=="free_paid"){ ?>
                    <?php //if($this->myID=="" || $this->myID <= 0){ ?>
                    <!-- <div class="col-md-12 p-0">
                        <div class="vote_btn__ vote_btns vote_btn_free1" caption="free" wallets="">Vote Free 1</div>

                        <div class="vote_btns vote_btn_free2" style="display: none;">Vote Free <span id="count_down" style="display: block;"></span></div>
                        <div class="lines"></div>
                    </div> -->
                    <?php //} ?>

                    <input name="txt_url_params" id="txt_url_params" value="<?=$this->url_params?>" type="hidden" />
                    <input name="txt_url_params_ID" id="txt_url_params_ID" value="<?=$this->url0?>" type="hidden" />

                    <div class="col-md-12 p-0">
                        <?php
                        if($this->myID=="" || $this->myID <= 0)
                            echo '<div class="vote_btns login_vote">Vote Free</div>';
                        else
                            echo '<div class="vote_btn login_vote1" caption="login_free" wallets="">Vote Free</div>';
                        ?>
                        <div class="vote_btns login_vote1i" style="display: none; font-size: 15px;">Vote Free <span id="count_down2" style="display: block;"></span></div>
                        <div class="lines"></div>
                    </div>

                    <?php if($premiums!="free_paid"){ ?>
                        <div class="col-md-12 p-0">
                            <div class="dynamic_boost_vt">
                                <div class="vote_btn_noc">Boost Vote</div>
                            </div>
                            <div class="lines"></div>
                        </div>

                        <div class="col-md-12 p-0">
                            <div class="dynamic_boost_vt">
                                <div class="vote_btn_noc">Guest Boost Vote</div>
                            </div>
                            <div class="lines"></div>
                        </div>
                    <?php } ?>
                <?php } ?>


                <?php if($premiums=="paid" || $premiums=="free_paid"){ ?>
                    <?php if($premiums!="free_paid"){ ?>
                        <div class="col-md-12 p-0">
                            <div class="vote_btn_noc">Vote Free 1</div>
                            <div class="lines"></div>
                        </div>
                    <?php } ?>

                    <div class="col-md-12 p-0">
                        <div class="dynamic_boost_vt">
                            <div class="vote_btn" caption="boost" wallets="<?=$this->wallets1?>">Boost Vote</div>
                        </div>
                        <div class="lines"></div>
                    </div>

                    <div class="col-md-12 p-0">
                        <div class="dynamic_boost_vt">
                            <div class="vote_btn" caption="guest_boost" wallets="<?=$this->wallets1?>">Guest Boost Vote</div>
                        </div>
                        <div class="lines"></div>
                    </div>
                <?php } ?>


                <?php if($premiums=="coded"){ ?>
                    <div class="col-md-12 p-0">
                        <div class="vote_btn" caption="code" wallets="">Enter Code</div>
                        <div class="lines"></div>
                    </div>
                <?php } ?>
                <div style="clear: both;"></div>

                <p class="expirys mt-10">This contest expires in <b style="color: #09C" class="caption_expire_  <?=$countdowns1?>" id="caption_expire"><?=$expiryss;?></b></p>
            </div>


            <div class="confirm_vote vote_1 pl-10 pr-10" style="display: none">
                <form id="enter_reg" class="form reg_form" method="post" autocomplete="off" name="contact-form">

                    <div class="div_voteme_free" style="display:nones">
                        <p style="color:#555; line-height: 22px; font-size:15.5px; margin:15px 0 4px 0; font-weight: 600;">Clicking the vote button below will add <font style="color: #09C"><font class="free_votes">1</font> Vote</font> to this contestant. You can vote again after every 6 hours.<br> Confirm Vote?</p>

                        <input id="txtfreevote" type="hidden" value="0">
                        
                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                        <p class="btns">
                            <spans class="cmd_votenow" cats="free" amt="">Vote</spans>
                            <spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans> 
                            <spans class="btns1" id="cmdbackvote">Back</spans>
                        </p>
                    </div>


                    <div class="div_voteme_code pl-20 pr-20" style="display:none">
                        <p style="color:#ddd; line-height: 22px; font-size:16px; margin:15px 0 14px 0; font-weight: 500;">Enter the code from our raffle draw campaign and click on the vote button</p>

                        <input id="txtvote_code" placeholder="Enter Raffle Code" type="text" class="txt2 txt22">
                        <p style="color:#888; font-size:13px; margin:8px 0 5px 0 !important" class="err_mail1"></p>

                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                        <p class="btns">
                            <?php
                            if($this->myID=="")
                                echo '<spans class="cmd_votenows" style="opacity:0.5">Vote</spans>';
                            else
                                echo '<spans class="cmd_votenow" cats="code" amt="">Vote</spans>';
                            ?>
                            <spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans>  
                            <spans class="btns1" id="cmdbackvote_code">Back</spans>
                        </p>
                    </div>


                    <div class="div_voteme_boost" style="display:none; text-align: center !important;">
                        <div class="div_hasfund" style="display:nones;">
                            <p style="color:#444; line-height: 24px; font-size:16px; margin:8px 0 4px 0; font-weight: 600;">You have <font style="color: #09C; cursor: pointer;" class="wallet_amt">&#8358;<?=$this->wallets?></font> in your wallet.</p>

                            <p style="color:#333; line-height: 20px; font-size:15px; margin:6px 0 4px 0;">Clicking the vote button below will add <font style="color: #09C"><span class="c_vts">10</span> Votes</font> to this contestant and deduct &#8358;<span class="c_amt">100</span> from your wallet.</p>

                            <select id="txtvote_money" name="txtvote_money" class="form-control show-tick txtvote_money_ frm_control">
                                <option value="10">10 Votes for &#8358;100</option>
                                <option value="25">25 Votes for &#8358;200</option>
                                <option value="70">70 Votes for &#8358;500</option>
                                <option value="150">150 Votes for &#8358;1,000</option>
                                <option value="325">325 Votes for &#8358;2,000</option>
                                <option value="500">500 Votes for &#8358;3,000</option>
                                <option value="900">900 Votes for &#8358;5,000</option>
                            </select>

                            <div class="alert alert-danger alert_msgs alert_msg1"></div>
                            <p class="btns btns3 mb-xs-50">
                                <?php
                                if($this->myID=="")
                                echo '<spans class="cmd_votenows" style="opacity:0.5">Vote for &#8358;100</spans>';
                                else
                                echo '<spans class="cmd_votenow_i" cats="paid" amt="100">Vote for &#8358;100</spans>';
                                ?>
                                <spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans> 
                                <spans class="btns1" id="cmdbackvote">Back</spans>
                            </p>
                        </div>

                        <div class="div_hasnofund" style="display:none;">
                            <p style="color:#333; line-height: 21px; font-size:16px; margin:9px 0 12px 0;"> 
                                Oops!! Your wallet is empty! Please fund your wallet.
                                <p style="font-size: 14px; line-height: 19px !important; color: #555; margin: -5px 0 -16px 0;">(Hints: 10votes for &#8358;100, 25votes for &#8358;200, 150votes for &#8358;1,000, etc...)</p>
                            </p>

                            <div class="first_form_ mt-30">
                                <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                <input type="hidden" id="txtmemid" value="<?=$this->myID?>">
                                <input type="hidden" id="txtvp1" value="<?=$this->vps?>">
                                
                                <div class="col-md-12 pl-10 pr-10 p-sm-0">
                                    <div class="form-line">
                                        <input type="hidden" name="txtamt_fund_hide" id="txtamt_fund_hide">

                                        <input type="number" name="txtamt_fund" id="txtamt_fund" class="form-control" placeholder="Enter Amount" value="" style="font-size: 20px; color: #333; font-weight: 600; height: auto; padding: 10px 20px; border: 1px solid #999; background: #fff;">
                                    </div>
                                </div>

                                <div class="col-md-12 pl-10 pr-10 p-sm-0" style="margin-top: -5px;">
                                    <div class="form-line">
                                        <select id="pay_mthd" name="pay_mthd" class="form-control frm_control" style="border: 1px solid #999;">
                                            <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                            <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                            <option value="airtime" disabled>Airtime (Coming soon)</option>
                                            <option value="vp">Vote Point (<?=$this->vps?>VPs, 20VP = &#8358;1)</option>
                                            <option value="agents">Buy From Agents</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1" style="margin: 10px 0 -10px 0;"></div>

                                <p class="btns btns3 mb-xs-50">
                                    <spans class="btns1" id="cmdbackvote">Back</spans>

                                    <?php  if($this->myID==""){ ?>
                                        <spans class="cmd_votenows" onpage="" style="display: nones; opacity:0.5">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px;"></i></spans>
                                    <?php }else{ ?>
                                        <spans class="cmd_fund" onpage="contests" style="display: nones;">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px;"></i></spans>
                                    <?php } ?>


                                    <spans class="cmd_fund_proceed" style="display: none; opacity: 0.4">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></spans> 
                                </p>

                                <div class="mt-40 mb-30" style="color: #555; font-size: 13.5px; line-height: 19px">Please refresh this page incase of any delay in trying to make payment</div>
                            </div>
                        </div>
                    </div>


                    <div class="div_voteme_boost_guest" style="display:none; text-align: center !important;">
                        <p style="color:#333; line-height: 20px; font-size:15px; margin:6px 0 4px 0;">Clicking the vote button below will add <font style="color: #09C"><span class="c_vts">10</span> Votes</font> to this contestant and deduct &#8358;<span class="c_amt">100</span> from your wallet.</p>

                        <select id="txtvote_money_g" name="txtvote_money_g" class="form-control show-tick txtvote_money_ frm_control">
                            <option value="10">10 Votes for &#8358;100</option>
                            <option value="25">25 Votes for &#8358;200</option>
                            <option value="70">70 Votes for &#8358;500</option>
                            <option value="150">150 Votes for &#8358;1,000</option>
                            <option value="325">325 Votes for &#8358;2,000</option>
                            <option value="500">500 Votes for &#8358;3,000</option>
                            <option value="900">900 Votes for &#8358;5,000</option>
                        </select>

                        <select id="pay_mthd_g" name="pay_mthd_g" class="form-control frm_control" style="border: 1px solid #999;">
                            <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                            <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                        </select>
                                

                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                        <p class="btns btns3 mb-xs-50">
                            <spans class="cmd_votenow_guest_boost" cats="paid" amt="100">Vote for &#8358;100</spans>
                            <spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans> 
                            <spans class="btns1" id="cmdbackvote">Back</spans>
                        </p>
                    </div>


                    <div class="div_vote_success" style="display:none">
                        <p style="font-size:20px; margin:20px 0 10px 0; color:#096;"><b>Thank you for your vote</b></p>
                        <p style="font-size:16.5px; margin-bottom:12px; color:#333; line-height:21px;">You have successfully voted for <font class="p_name2"></font></p>
                        <p class="btns"><spans id="cmdbackvote1">Done</spans></p>
                    </div>
                </form>
            </div>
        </div>

    <?php }else{ ?>
        <p style="margin: 20px 0; color: #09C; font-weight: 500; line-height: 25px; font-size: 18px;">Entries are still going on!<br>Voting starts immediately at <?=$start_date_contest?></p>
    <?php } ?>
</div>


<div class="agents_dv" style="display: none;">
    <p style="color: #333; font-size: 20px !important; text-transform: uppercase; margin: -4px 0 3px 0 !important"><b>Accredited Agents</b></p>
    <p style="margin-bottom: 20px; color: #666;">Call any of these agents to transfer to you</p>

    <div class="row">
        <div class="col-xs-4">
            <b>Name</b>
        </div>

        <div class="col-xs-3">
            <b>Wallet</b>
        </div>

        <div class="col-xs-5">
            <b>Phone</b>
        </div>
        <div style="clear: both;"></div>


        <?php 
        if($getAgents){
            foreach($getAgents as $row){
                $names = ucwords($row['names']);
                $phone = $row['phone'];
                $wallet = @number_format($row['wallet']);

                echo "<div class='col-xs-4'>
                    <p>$names</p>
                </div>

                <div class='col-xs-3'>
                    <p>&#8358;$wallet</p>
                </div>

                <div class='col-xs-5'>
                    <p><a href='tel:+$phone'>$phone</a></p>
                </div>";

            }
        }else{
            echo '<div class="col-xs-12">
                <p>No Agents Found Yet!</p>
            </div>';    
        }
        ?>

    </div>
    <p class="btns">
        <spans id="cmdbackpay">Back</spans>
    </p>
</div>