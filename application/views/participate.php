
<?php
$contest_img = base_url()."contest_types/$files_1";
$width1="";
list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
if($width1=="" || $width1<=0)
    $contest_img = base_url()."images/no-image.jpg";
?>

<div style="clear: both;"></div>

<div id="page-container_ container">

    <div class="grid_ row mt-30 mt-xs-0">
        <div class="unit_ _one-third col-md-4 pl-10 pr-10">
            <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #069">Current</font> Activity</h1>
            <h6 style="color: #444; line-height: 28px !important; font-size: 22px;" class="m--20_"><?=ucwords(strtolower($con_title))?></h6>

            <div class="responsive-img responsive_img mt-30">
                <img src="<?=$contest_img?>" alt="<?=$con_title?>" />

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
            </div>
            <p style="font-size: 23px; margin-bottom: 14px;"><b>Instructions</b></p>
            <?=$instructions?>
            <p class="impor_info">Please note that before you participate on this, you must have completed your profile, <a href="javascript:;" class="complete_profile">click here</a> to complete your profile</p>
        </div>

        <?php
        if($entry_type=="paid" && $entry_fee > 0){
            $displays1 = "display: none;";
            $displays3 = "display: none;";
            $displays2 = "";

            $paidForEntrance = $this->sql_models->paidForEntrance($contestids, $this->myID);
            if(!$paidForEntrance){
                $displays1 = "display: none;";
                $displays3 = "display: none;";
                $displays2 = "";
            }else{
                $displays2 = "display: none;";
                $displays3 = "display: none;";
                $displays1 = "";
            }

        }else if($entry_type=="coded"){
            $displays1 = "display: none;";
            $displays2 = "display: none;";
            $displays3 = "";

            $paidForEntranceCode = $this->sql_models->paidForEntranceCode($contestids, $this->myID);
            if(!$paidForEntranceCode){
                $displays1 = "display: none;";
                $displays2 = "display: none;";
                $displays3 = "";
            }else{
                $displays2 = "display: none;";
                $displays3 = "display: none;";
                $displays1 = "";
            }

        }else{
            $displays3 = "display: none;";
            $displays2 = "display: none;";
            $displays1 = "";
        }
        ?>

        <div class="unit_ two-thirds_ pl-40 pl-sm-10 mt-sm-20 col-md-8 mt-0 patiDiv">
            <div class="main_parti_form" style="<?=$displays1?>">
                <h1 style="font-weight:600;" class="header_tt1"><font style="color:#069">Participate</font></h1>

                <div class="main_parti_form_inner">
                    <?php $contested_already = $this->sql_models->contestedAlready($contestids, $this->myID); ?>

                    <?php if(!$contested_already){ ?>
                        <div class="upload_details p-10 p-xs-0 pt-xs-10" style="display: nones;">
                            <p style="margin: -10px 0 5px 0; font-size: 18px; color: #555; line-height: 22px;">Fill in the following and click on the upload button</p>

                            <p style="margin: 0px 0 -15px 0; color: #959500">(New*) You can also change this <?=$media_type1?> on your dashboard before voting starts.</p>
                            
                            <form class="form-box uploadPics upload_frm" action="#" mediaType="<?=$media_type1?>" method="post" autocomplete="off">

                                <input name="txt_url_params" id="txt_url_params" value="<?=$this->url_params?>" type="hidden" />
                                <input name="txt_url_params_ID" id="txt_url_params_ID" value="<?=$this->url0?>" type="hidden" />

                                <div class="row">
                                    <div class="col-md-12 mb-10">
                                        <div class="form-group position-relative">
                                            <label>Upload <?=$media_type1?></label>
                                            <font style="font-size: 16px; color: #777">(Max allowed: 100MB, only JPG files allowed)</font>
                                            <input type="file" name="txtphoto[]" id="txtphoto" mediaType="<?=$media_type1?>" class="form-control" multiple="" <?=$accepteds?> >
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-10 pl-sm-15 pr-sm-15">
                                        <div class="form-group position-relative">
                                            <label>Write about the <?=$media_type1?></label>
                                            <textarea name="txtdescrip" id="txtdescrip" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="txtcontestID" value="<?=$contestids?>">
                                    <input type="hidden" name="txtmedia" value="<?=$media_type1?>">
                                    <input type="hidden" name="txtupdates" value="0">
                                    <input type='hidden' name='txtfiles1' value=''>
                                    
                                    <div style='clear:both'></div>

                                    <!-- <div class="col-md-12 mt-40">
                                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                    </div> -->

                                    <div class="offset-lg-2 col-lg-8 offset-md-0 col-md-12 offset-xs-0 col-xs-12  mt-50 mb-30">
                                        <div class="row p-xs-10">
                                            <div class="col-md-4 col-5 pr-5 pr-xs-5">
                                                <button type="button" class="btn btn-primary btn-block cmd_goto_main_contest curve_btn">< Back</button>
                                            </div>

                                            <div class="col-md-8 col-7 pl-5 pl-xs-5">
                                                <?php
                                                $hasExpired = $this->sql_models->checkVoteExpiry($ids);
                                                if($hasExpired){
                                                    echo '<button type="button" class="btn btn-primary btn-block cmd_no_participate curve_btn1" style="opacity:0.5;">Upload '.$media_type1.'</button>';
                                                }else{
                                                    if($start_date1 <= $currentTime){
                                                        echo '<button type="submit" class="btn btn-primary btn-block cmd_upload_media curve_btn1">Upload '.$media_type1.'</button>';
                                                    }else{
                                                        echo '<button type="button" class="btn btn-primary btn-block cmd_csn curve_btn1" style="opacity:0.5;">Upload '.$media_type1.'</button>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger alert_msgs alert_msg1"></div>
                            </form>
                        </div>

                    <?php }else{ ?>

                        <div style="text-align: center;">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                              <circle class="path circle" fill="none" stroke="#EA0000" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                              <polyline class="path check" fill="none" stroke="#EA0000" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                            </svg>

                            <p class="mt-10 mb-10" style="font-size: 20px; color: #EA0000;"><b>Already Participated or Expired</b></p>

                            <p style="margin: 10px 0 10px 0; color: #959500; line-height: 22px;">(New*) You can also <a href="<?=base_url()?>dashboard/<?=$ids_hash2?>/change-media/" style="color: #09C">Click here</a> to change this <?=$media_type1?> before voting starts.</p>

                            <p class="m-0" style="color: #444; line-height: 23px">You have already pertake on this contest or it has expired, please click on the <b>DONE button</b> below to reload and view your entry or click on the <b>BACK button</b> to go back to this contest, thank you!</p>


                            <div class="col-md-12 mt-20" style="text-align: center;">
                                <div class="row p_btns">
                                    <div class="col-md-12 p-0">
                                        <input type="button" class="btn btn-primary waves-effect waves-light" id="cmd_goto_main_contest" value="< Back" />&nbsp;

                                        <input type="button" class="cmd_done_par p_btns1 pl-40 pr-40 pl-xs-50 pr-xs-50 ml-5 btn btn-primary waves-effect waves-light" value="Done" />
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>

                            <div class="grid-border m-0"></div>
                        </div>

                    <?php } ?>

                    <div class="already_taken" style="display: none; text-align: center;">
                        <div class="grid-border m-0 mb-0"></div>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                          <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                          <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                        </svg>

                        <p class="mt-20 mb-10" style="font-size: 20px; color: #333;"><b>Your Upload Was Successful</b></p>

                        <p style="margin: 0px 0 5px 0; color: #959500; line-height: 23px">(New*) You can also <a href="<?=base_url()?>dashboard/<?=$ids_hash2?>/change-media/" style="color: #09C">Click here</a> to change this <?=$media_type1?> before voting starts.</p>

                        <p class="m-0" style="color: #333; line-height: 23px">Your details have been submitted and it's undergoing some checks to avoid nudity, pirates and graphic photos. Your photo will come up as soon as possible.<br> Meanwhile get friends to come and vote for you to increase your chances of winning this campaign, thank you!</p>

                        <div class="row">
                            <div class="col-md-12 mt-20" style="text-align: center;">
                                <div class="row_ p_btns">
                                    <div class="col-md-12 p-0">
                                        <input type="button" class="btn btn-primary waves-effect waves-light" id="cmd_goto_main_contest" value="< Back" />&nbsp;

                                        <input type="button" class="cmd_done_par p_btns1 pl-40 pr-40 pl-xs-50 pr-xs-50 ml-5 btn btn-primary waves-effect waves-light" value="Done" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="parti_payment_form" style="<?=$displays2?>">
                <div class="payments_form">
                    <form class="input-group pb-30" id="frm_cont_pay" autocomplete="off">
                        <p style="line-height: 20px;"><span>&#8358;<?=@number_format($entry_fee)?></span> payment is required to be made before you participate in this contest. Kindly select your mode of payment and continue.</p>

                        <input type="hidden" name="txtamt" id="txtamt" value="<?=$entry_fee?>">
                        <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                        <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                        <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                        <input type="hidden" id="txtmemid" value="<?=$this->myID?>">
                        <input type="hidden" id="txtcons_ids" value="<?=$ids?>">
                        <input type="hidden" id="txtspons_ids" value="<?=$user_id_spon?>">

                        <input name="txt_url_params" id="txt_url_params" value="<?=$this->url_params?>" type="hidden" />
                        <input name="txt_url_params_ID" id="txt_url_params_ID" value="<?=$this->url0?>" type="hidden" />

                        
                        <div class="col-md-12 pl-30 pr-30 pl-sm-5 pr-sm-5 mt-10">
                            <label for="email_address" style="color: #444; font-size: 18px;">Select Payment Mode</label>
                            <select class="form-control show-tick mt-5" id="pay_mthd1" name="pay_mthd1">
                                <option value="" selected>-Select One-</option>
                                <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                            </select>
                        </div>

                        <div class="col-md-12" style="text-align: center; margin-top: 25px;">
                            <button type="button" class="btn btn-primary waves-effect waves-light cmd_pay_entryfee">PAY NOW</button>

                            <button type="button" class="btn btn-primary small_btn waves-effect waves-light pt-xs-15 pb-xs-15 mt-xs-10" id="cmd_goto_main_contest">< GO BACK</button>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="alert alert_msgs alert_msg1"></div>
                        <br>
                    </form>
                </div>
            </div>


            <div class="parti_coded_form" style="<?=$displays3?>">
                <div class="payments_form">
                    <form class="input-group" id="frm_cont_code" autocomplete="off">
                        <p style="line-height: 20px;">A code is required to be made before you participate on this contest. Enter the code and continue.</p>

                        <input type="hidden" id="txtcons_ids" value="<?=$ids?>">
                        
                        <div class="col-md-12 pl-30 pr-30 pl-sm-0 pr-sm-0 mt-10">
                            <label for="email_address" style="color: #444; font-size: 18px;">Enter Code And Continue</label>
                            <input type="number" id="txt_codes" name="txt_codes" placeholder="Enter Code" style="color: #555;">
                        </div>

                        <div style="clear: both;"></div>
                        

                        <div class="col-md-12 mb-20" style="text-align: center; margin-top: 25px;">
                            <div class="alert alert_msgs alert_msg1 mt--10 mb-10"></div>
                            <button type="button" class="btn btn-primary waves-effect waves-light cmd_code_entryfee">ENTER NOW</button>

                            <button type="button" class="btn btn-primary small_btn waves-effect waves-light pt-xs-15 pb-xs-15 mt-xs-10" id="cmd_goto_main_contest">< GO BACK</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <br><br>
    <!-- <br>
    <div class="grid-border"></div> -->
</div>
