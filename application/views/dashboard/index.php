
<?php
$contest_fee1 = $this->contest_fee;
if($contest_fee1 <= 0) $contest_fee1="Free"; else $contest_fee1="&#8358;".@number_format($contest_fee1);

$contest_fee2 = $this->contest_fee2;
if($contest_fee2 <= 0) $contest_fee2="Free"; else $contest_fee2="&#8358;".@number_format($contest_fee2);

$contest_fee3 = $this->contest_fee3;
if($contest_fee3 <= 0) $contest_fee3="Free"; else $contest_fee3="&#8358;".@number_format($contest_fee2);

$contest_fee1i = str_replace(array("&#8358;", ","), "", $contest_fee1);
$contest_fee2i = str_replace(array("&#8358;", ","), "", $contest_fee2);
$contest_fee3i = str_replace(array("&#8358;", ","), "", $contest_fee3);

$isSponsor = $this->sql_models->getSponDetails($this->myID);

$entr_fee = $this->sql_models->sumColmn('entries_fee', 'fee', 'contest_id', "");

$party_entr_fee = ($this->entry_fee/100) * $entr_fee; //100
$party_entr_fee1 = $entr_fee - $party_entr_fee; //900


//$boosted_fee = $this->sql_models->sumColmn('bstd_vts', 'amts', 'contest_id', "");


$total_vts = $this->sql_models->sumColmn('entries', 'votes', 'contest_id', "");
$bsts_vts = $this->sql_models->sumColmn('bstd_vts', 'votes', 'contest_id', "");
$total_entrs = $this->sql_models->calCounts1('entries', 'contestant_id', 'members', "");
?>

<div class="cover_body"></div>
<div class="modal_ _fade add_codes" id="add_codes">
    <div class="modal-dialog modal_div modal_div_code">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_code" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Enter Contest Codes</h4>
            </div>
            <form method="post" autocomplete="off" class="add_code_form">
                <input type="hidden" name="txtcons_id" id="txtcons_id">
                <input type="hidden" name="txteditcon" id="txteditcon">
                <input type="hidden" id="txt_upload_type" name="txt_upload_type" value="upload">

                <div class="modal-body">
                    <div class="for_edition" style="display: none;">

                    </div>

                    <div class="for_entry" style="display: none;">

                        <div class="manual_uploads" style="display: nones;">
                            <p><span class="bulk_uploads">Click here to do bulk uploads</span></p>
                            <?php
                            for($k=1; $k<=6; $k++){
                            ?>
                                <div class="form-group mt-5 mb-5 col-md-12 pr-5 pl-5 pr-xs-5 pl-xs-5" style="font-size:17px; display: block;">
                                    <div class="form-line">
                                        <input type="number" name="txtcodes[]" id="txtcodes<?=$k?>" class="form-control txtcodes" placeholder="Enter Code" style="font-size:18px;">
                                    </div>
                                </div>
                            <?php } ?>

                            <div style="clear: both;"></div>
                            <div class="alert alert_msgs alert_msg1 alert_msg_center mb--15"></div>
                            <div class="modal-footer mt-10">
                                <div class="form-group col-md-12 pr-20">
                                    <button type="button" class="btn btn-success cmd_enter_code" ><span class="fa fa-plus"></span>&nbsp;Add Codes</button>
                                    <button type="button" class="btn btn-default cmd_close_code" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
                                </div>
                            </div>
                        </div>



                        <div class="bulk_upload_div" style="display: none;">
                            <p><span class="man_uploads">Click here to do manual uploads</span></p>

                            <div style="font-size: 15px; margin-bottom: 15px; line-height: 24px; overflow: hidden; color: red; overflow-x: scroll;">
                                <b style="font-size: 17px; ">Important Notice</b>:<br>
                                Excel format uploads must be in this format:<br>
                                <img src="<?=base_url()?>images/excel_format.png">
                            </div>
                            
                            <p style="font-size: 15px;"><b>Upload excel file:</b></p>
                            <input type="file" name="uploadFile" id="uploadFile" value="" style="font-size: 17px;" />
                            <p style="font-size:14px !important; margin:8px 0 6px 0; color:#993">Picture size <b style="font-size:14px;">6MB</b> of xls, xlsx only!</p>

                            <div style="clear: both;"></div>
                            <div class="alert alert_msgs alert_msg1" style="margin-bottom: -10px"></div>
                            <div class="modal-footer">
                                <div class="form-group col-md-12 pr-20">
                                    <button type="submit" class="btn btn-success cmd_submit_quiz" ><span class="fa fa-plus"></span>&nbsp;Upload Codes</button>
                                    <button type="button" class="btn btn-default cmd_close_code" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>



<div class="modal_ _fade boostads" id="boostads" style="display: blocks;">
    <div class="modal-dialog modal_div modal_div2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_bst" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Boost This AD</h4>
                <p class="spons_title">#####</p>
            </div>

            <div class="fst_form" style="display: nones;">
                <form class="input-group" id="frm_boost_adv" autocomplete="off">
                    <input type="hidden" name="txtcons_id1" id="txtcons_id1">
                    <input type="hidden" name="txtszs" id="txtszs" value="1360x510">

                    <div class="modal-body modal-body1">
                        <div class="col-md-12 pr-20 p-sm-0">
                            <label for="email_address">Duration (In days)</label>
                            <div class="form-line">
                                <select class="form-control calcs1" id="txtdurs" name="txtdurs">
                                    <option value="">-Select-</option>
                                    <option value="7 days">7 Days</option>
                                    <option value="15 days">15 Days</option>
                                    <option value="30 days">30 Days</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-20 pr-20 p-sm-0">
                            <label for="email_address">Total Fee: &nbsp;</label>
                            <span class="total_fees1">&#8358;0.00</span>
                        </div>
                        <input name="txtamts1" id="txtamts1" type="hidden" value="0">
                    </div>
                    <div style="clear: both;"></div>

                    <div class="alert alert_msgs alert_msg1 alert_msg_center"></div>
                    <div class="modal-footer mt-10 m-sm--10">
                        <div class="form-group col-md-12 pr-20">
                            <button type="button" class="btn btn-success cmd_enter_boost" ><span class="fa fa-plus"></span>&nbsp;Boost AD</button>
                            <button type="button" class="btn btn-default cmd_close_bst" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="success_form_boost" style="display: none;">
                <form class="input-group" id="frm_boost_adv1" autocomplete="off">
                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                        <div id="wallet_amt1">&#8358;40,000.00</div>
                    </div>

                    <input type="hidden" name="txtamt" id="txtamt" value="40000">
                    <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                    <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                    <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                    <input type="hidden" id="txtmemid" value="<?=$this->myID?>">
                    <input type="hidden" id="txtextends" value="">
                    <input type="hidden" name="txtad_type" id="txtad_type" value="contests">

                    
                    <div class="col-md-12 pr-20 pl-20 pl-sm-20 pr-sm-20 mt-10">
                        <label for="email_address">Select Payment Mode</label>
                        <div class="form-line">
                            <select class="form-control show-tick" id="pay_mthd1" name="pay_mthd1">
                                <option value="" selected>-Select One-</option>
                                <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8" style="text-align: center; margin-top: 6px;">
                        <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_boost_now">MAKE PAYMENTS</button>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="alert alert_msgs alert_msg1"></div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal_ _fade contest_pay_popup_form" id="contest_pay_popup_form" style="display: blocks;">
    <div class="modal-dialog modal_div modal_div2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_bst" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Pay For This Contest</h4>
                <p class="spons_title">#####</p>
            </div>

            <form class="input-group" id="frm_contest1" autocomplete="off">
                <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                    <div id="wallet_amt1">&#8358;<?=@number_format($this->contest_fee,2)?></div>
                    <p class="little_info1" style="margin-bottom: 6px"><?=$this->paid_votes?>% Vote Commission For iContestPRO</p>
                </div>

                <input type="hidden" name="txtcons_id1" id="txtcons_id1">
                <input type="hidden" name="txtamt" id="txtamt" value="<?=$this->contest_fee?>">
                <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                <input type="hidden" id="txtmemid" value="<?=$this->myID?>">
                <input type="hidden" name="txtad_type" id="txtad_type" value="contests">
                <input type="hidden" name="txt_premium" id="txt_premium">


                <div class="col-md-12 pr-20 pl-20 pl-sm-0 pr-sm-0 mt-10">
                    <label for="email_address">Select Contest Type</label>
                    <div class="form-line refresh_select">
                        <select class="form-control show-tick" id="txtconType" name="txtconType">
                            <option data-value="<?=$contest_fee1?>" data-value1="For <?=$this->paid_votes?>% Vote Commission" data-value2="<?=$contest_fee1i?>" data-value3="1" selected><?=$contest_fee1?> For <?=$this->paid_votes?>% Vote Commission</option>
                            
                            <option data-value="<?=$contest_fee2?>" data-value1="For <?=$this->paid_votes2?>% Vote Commission" data-value2="<?=$contest_fee2i?>" data-value3="2"><?=$contest_fee2?> For <?=$this->paid_votes2?>% Vote Commission</option>

                            <option data-value="<?=$contest_fee3?>" data-value1="For <?=$this->paid_votes3?>% Vote Commission" data-value2="<?=$contest_fee3i?>" data-value3="3"><?=$contest_fee3?> For <?=$this->paid_votes3?>% Vote Commission</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-12 pr-20 pl-20 pl-sm-20 pr-sm-20 mt-10">
                    <label for="email_address">Select Payment Mode</label>
                    <div class="form-line">
                        <select class="form-control show-tick" id="pay_mthd1" name="pay_mthd1">
                            <option value="">-Select One-</option>
                            <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                            <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                            <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8" style="text-align: center; margin-top: 6px;">
                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_contest_pay1">MAKE PAYMENTS</button>
                </div>
                <div style="clear: both;"></div>
                <div class="alert alert_msgs alert_msg1"></div>
                <br>
            </form>
        </div>
    </div>
</div>


<div class="modal_" id="open_message">
    <div class="modal-dialog show_overflow">
        <div class="modal-content modal_div modal_div1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_code1" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align show_title" id="Heading" style="text-transform: uppercase;"></h4>
                <p class="mem_info_dets">
                    <span><b>From:</b> <font class="from_who">######</font></span>
                    <span><b>Date:</b> <font class="from_date">#######</font></span>
                </p>
            </div>

            <div class="modal-body modal-body2">
                <input type="hidden" id="txtfrom">
                <input type="hidden" id="to_who1">
                <input type="hidden" id="to_who2">
                <input type="hidden" id="ticket_id">
                <div class="show_msg" style="font-size:15px; display: block;">
                    
                </div>
            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-success cmd_reply_adm" data-dismiss="modal" ><span class="fa fa-reply"></span>&nbsp;Reply Message</button>

                <button type="button" class="btn btn-default cmd_close_code1" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
            </div>
            <br><br>
        </div>
    </div>
</div>


<div class="modal_" id="delete_dv" style="display: blocks;">
  <div class="modal-dialog modal_div modal_div3">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_del" aria-hidden="true"></span></button>
          </div>

          <div class="modal-body">
              <input type="hidden" id="txtall_id">
              <div class="alert alert-danger" style="font-size:15px; text-align: center; display: block;"><span class="fa fa-warning"></span> Are you sure you want to delete this?</div>
          </div>

          <input type="hidden" id="txt_dbase_table" value="<?=$page_name;?>">

          <div class="modal-footer">
              <button type="button" class="btn btn-danger cmd_remove_adm" data-dismiss="modal" ><span class="fa fa-trash-o"></span>&nbsp;Yes</button>
              <button type="button" class="btn btn-danger cmd_remove_adm1" style="opacity: 0.5; display: none;"><span class="fa fa-trash-o"></span>&nbsp;Deleting...</button>

              <button type="button" class="btn btn-default cmd_close_del" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;No</button>
          </div>
          <br>
      </div>
  </div>
</div>



<div class="modal_ _fade agents_dv" id="agents_dv" style="display: blocks;">
    <div class="modal-dialog modal_div modal_div2">
        <div class="modal-content" style="border: none !important;">
            <div class="modal-header" style="border: none !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times cmd_close_bst" aria-hidden="true"></span></button>
                
                <h4 class="modal-title custom_align" id="Heading" style="font-size: 23px">Accredited Agents</h4>
                <p style="font-size: 15.5px; color: #777; margin: 2px 0 6px 0">Call any of these agents to quickly transfer funds to you</p>
            </div>

                <div class="col-xs-4">
                    <b>Name</b>
                </div>

                <div class="col-xs-3">
                    <b>Wallet</b>
                </div>

                <div class="col-xs-5">
                    <b>Phone</b>
                </div>
                <div style="clear: both; padding: 0 !important"></div>


                <?php
                $getAgents = $this->sql_models->fetchAgents('members');
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

            <p style="clear: both;"></p>
            <p class="btns">
                <spans id="cmdbackpay">Back</spans>
            </p>
        </div>
    </div>
</div>



<section class="content ml-sm-0 mr-sm-0 mt-70 mt-sm-50">
    <div class="container-fluid all_texts js-sweetalert">

        <?php
        if(!isset($datamsg2)) $datamsg2="";
        ?>

        <button class="btn btn-primary waves-effect btn_sweet_art" style="display: none;" data-type="success" data-msg="<?=$datamsg?>">CLICK ME</button>

        <button class="btn btn-primary waves-effect btn_sweet_art1" style="display: none;" data-type="success" data-msg="<?=$datamsg1?>">CLICK ME</button>

        <button class="btn btn-primary waves-effect btn_sweet_art2" style="display: none;" data-type="success" data-msg="<?=$datamsg2?>">CLICK ME</button>

        <div class="block-header mt-sm-20 mb-sm-20  mt-xs-0">
            <h2 style="line-height: 30px !important;"><b><?=$header_names?></b></h2>
        </div>

        <?php if($page_name==""){ ?>

            <?php
            $reveal_draw = "";
            $box2 = "";
            if($this->wallets1 >= 2000){
                $link_to_draw = base_url()."dashboard/request-withdraw/";
                $reveal_draw = "<div class='req_withdraw'><a href='$link_to_draw'>Request Withdrawal</a></div>";
                $box2 = "info-box1";
            }

            $myContestIDs = $this->sql_models->myContestIDs($this->myID);


            $entr_fee = $this->sql_models->sumColmn_array('entries_fee', 'fee', 'contest_id', $myContestIDs);
            $boosted_fee = $this->sql_models->sumColmn_array('bstd_vts', 'amts', 'contest_id', $myContestIDs);

            $getConType = $this->sql_models->getContestType_arr($this->myID); // 1 means 50k, 2 means 20k, 3 means free

            $admin_percent1=0;
            $paid_votes1=0;
            if($getConType){
                foreach ($getConType as $row) {
                    $contest_type = $row['contest_type'];
                    if($contest_type==1)
                        $paid_votes1 += $this->paid_votes;

                    if($contest_type==2)
                        $paid_votes1 += $this->paid_votes2;

                    if($contest_type==3)
                        $paid_votes1 += $this->paid_votes3;
                }

                $admin_percent = $paid_votes1 / 100; // 110/100 = 1.1
                $admin_percent1 = round($admin_percent * $boosted_fee); // 1.1 * 200 = 220
            }
            ?>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pl-10 pr-10 pr-xs-15 mb--15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">WALLET (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($this->wallets1)?></div>
                            <?=$reveal_draw?>
                        </div>
                    </div>
                </div>


                <?php if($isSponsor){ ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">ENTRY FEE (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($entr_fee)?></div>

                            <div class="text mt-0">iContest Comm</div>
                            <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($party_entr_fee)?></b></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pl-xs-5 pr-xs-25 mb--15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">BOOSTED (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($boosted_fee)?></div>

                            <div class="text mt-0">iContest Comm</div>
                            <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($admin_percent1)?></b></div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 pr-xs-25 mb--15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <div class="content">
                            <div class="text">YOUR VOTES</div>
                            <div class="number count-to" data-from="0" data-to="<?=$this->noOfVotes1?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pl-xs-5 pr-xs-15 mb--15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">YOUR TOTAL VP</div>
                            <div class="number count-to" data-from="0" data-to="<?=$this->noOfPVS1?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pl-10 pr-10 pr-xs-15 mb--sm-10">
                    <div class="info-box <?=$box2?> bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-trophy"></i>
                        </div>
                        <div class="content">
                            <div class="text">YOUR ENTRIES</div>
                            <div class="number count-to" data-from="0" data-to="<?=$this->noOfEntries1?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix mt-sm-10">
                <?php
                $nows = substr(time(), -5);
                $memid_hash = $this->myID.$nows;
                ?>
                
                <div class="col-xs-12 mt-xs-10 pl-xs-10 pr-xs-15">
                    <div class="card">
                        <div class="body bg-pink_">
                            <div class="m-b--35 font-bold titles">MY LINK</div>
                                <p class="mt-40 mb-5">
                                    <font style='border:1px solid #ccc; cursor:pointer; display:inline-block; margin:0px 0 2px 0px; background:#eee; padding:7px 5px; border-radius:4px; font-size:14px !important'>
                                        <span id='copyTarget' style='display:none'><?=base_url();?>ref/<?=$memid_hash?>/</span>
                                        <font class='copy_clipboard' id='copyButton'>Copy Link <span class='fa fa-copy'></span></font>
                                    </font>
                                    <a href="#" style="font-size: 16px"><?=base_url()?>ref/<?=$memid_hash?>/</a><br>

                                    <font id='info_copied' style='display:none; color:#333; font-weight: 600; font-size:14px !important; margin:-3px 0 0 4px'>Copied</font>

                                    <p class="pts_info" style="color: #444 !important;">Get <b>100VP</b> when you refer someone who registers into the platform. Get <b><?=$this->give_referral?>% income</b> if the person you refer becomes a sponsor.</p>
                                </p>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pl-sm-10 pr-sm-10 pl-xs-10 pr-xs-15">
                    <div class="card">
                        <div class="body bg-ash1">
                            <div class="m-b--35 font-bold titles">LATEST CONTESTS</div>
                            <ul class="dashboard-stat-list">

                                <?php 
                                if($latest_conts){
                                    foreach($latest_conts as $row){
                                        $ids = $row['id'];
                                        $nows = substr(time(), -5);
                                        $ids_hash = $ids.$nows;
                                        $titles1 = ucwords($row['title']);
                                        $adv_title_f = cleanStr(strtolower($titles1));
                                        if(strlen($titles1)>40) $titles1 = substr($titles1, 0, 40)."...";
                                        $views1 = kilomega($row['views']);
                                        ?>
                                        <li>
                                            <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                                <?=$titles1?>
                                                <span class="pull-right"><b><?=$views1?></b> <small>VIEWS</small></span>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                }else{
                                    echo "No contests yet!";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pl-sm-10 pr-sm-10 pl-xs-10 pr-xs-15">
                    <div class="card">
                        <div class="body bg-ash1">
                            <div class="font-bold m-b--35 titles">VOTE LOGS</div>
                            <ul class="dashboard-stat-list stat-list1">
                                <?php
                                if($vote_logs){
                                    foreach($vote_logs as $row){
                                        $names1 = ucwords($row['names']);
                                        $votes = $row['votes'];
                                        $date_created = time_ago($row['date_created']);
                                    ?>
                                        <li>
                                            You voted <?=$votes?> votes for <?=$names1?>
                                            <span class="pull-right"><b><?=$date_created?></b></span>
                                        </li>
                                    <?php
                                    }
                                }else{
                                    echo "<p style='font-size:16px; color: #777; padding: 10px 0px;'>No votes logs yet or has been cleared!</p>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 pl-xs-10 pr-xs-15">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Title</th>
                                            <th>Entries</th>
                                            <th>Views</th>
                                            <th>Vote Type</th>
                                            <th>Campaign</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $conts=1;
                                        if($ent_parti){
                                            foreach($ent_parti as $post){
                                                $ids = $post['id1'];
                                                $nows = substr(time(), -5);
                                                $ids_hash = $ids.$nows;
                                                $title = ucwords($post['title']);
                                                $premium = strtoupper($post['premium']);
                                                $timings = $post['timings'];
                                                $currentTime = time();
                                                $difference = $timings - $currentTime;
                                                $c_expirys = convertTime1($difference);
                                                $c_expirys = str_replace("time", "to go", $c_expirys);

                                                if($timings < time()){
                                                    $c_expirys = "Completed";   
                                                }

                                                if($premium=="FREE" || $premium==""){
                                                    $premium="FREE VOTE";
                                                }else if($premium=="FREE_PAID"){
                                                    $premium="FREE & BOOST VOTE";
                                                }else{
                                                    $premium="BOOST VOTE";
                                                }

                                                $views = kilomega($post['views']);
                                                $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                                                $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

                                                if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                                            ?>
                                            <tr>
                                                <td><?=$conts?></td>
                                                <td><a href="<?=base_url()?><?=$ids_hash?>/join/" target="_blank"><?=$title?></a></td>
                                                <td><span><?=$noOfEntries?></span></td>
                                                <td><?=$views?></td>
                                                <td><?=$premium?></td>
                                                <td><?=$c_expirys?></td>
                                            </tr>
                                            <?php
                                            $conts++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 pl-xs-10 pr-xs-15">
                    <div class="card">
                        <div class="body bg-ash1_">
                            <div class="m-b--35 font-bold titles">NEW MESSAGES</div>
                            <ul class="dashboard-stat-list dashboard-stat-list1">
                                <?php 
                                    if($new_msg){
                                        foreach($new_msg as $row){
                                            $ids = $row['id'];
                                            $nows = substr(time(), -5);
                                            $ids_hash = $ids.$nows;
                                            $titles1 = ucwords($row['subj']);
                                            if(strlen($titles1)>40) $titles1 = substr($titles1, 0, 40)."...";
                                            $date_posted = $row['date_posted'];
                                            $has_read = $row['has_read'];
                                            $not_read="";
                                            if($has_read<=0)
                                                $not_read = "class='boldme'";
                                            ?>
                                            <li <?=$not_read?>>
                                                <a href="<?=base_url()?>dashboard/support/">
                                                    <?=$titles1?>
                                                    <span class="pull-right"><b><?=$date_posted?></b></span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                    }else{
                                        echo "No messages yet!";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="profile"){ ?>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="frm_update_profile" autocomplete="off">
                                <div class="col-md-12 col-sm-12 p-0" style="text-align:center;">
                                    <input type="hidden" name="txtf0" id="txtf0" value="<?=$this->pics;?>">
                                    <ul class="list-inline">
                                        <li id="img_prev1_bma" class="list-inline-item profile_pics3 profile_pics3i">
                                            <span>remove</span>
                                            <img src="<?=$this->imgs1; ?>" src1="<?=$this->imgs1; ?>" id="im1_bma">
                                            <input id="ad_logo_check1_bma" value="0" style="display:none;" />
                                            
                                            <input type="file" name="txt_bma_pic" id="txt_bma_pic" style="padding:4px; font-size:16px; margin:8px 0 0px 0; border:1px solid #ccc; display:none" accept=".jpg, .jpeg" />
                                            <p style="color:#808000; text-align: center; font-size:17px; cursor:pointer; display:none; margin:10px 0 -15px 0;" id="hide_basic_uploader"><b>Click To Hide This</b></p>
                                            
                                        </li>
                                        <input name="txt_yes_file_bma" type="hidden" value="<?=$this->yes_file;?>">
                                    </ul>
                                    <p style="margin:4px 0 -1em 0; font-size:17px; text-align: center; line-height: 21px;">
                                        <span style="color:#555; cursor:pointer;" class="basic_uploader">Touch the circle above Or <span style="color:#06C">click here</span> to try the simple uploader</span>
                                    </p>
                                </div>
                                <div style="clear: both;"></div>

                                <div style="text-align: center; margin: 5px 0 10px 0 !important; font-size: 16px; color: red">Fields with * are compulsory to fill</div>

                                <div style="text-align: center; margin: 2px 0 25px 0 !important; font-size: 16px; color: #093; font-weight: 600;">Get 100VP when you complete your profile with valid details</div>

                                <?php
                                $checkeds = "";
                                if($this->online_visibility==0) // visible
                                    $checkeds = "checked";
                                ?>
                                <!-- <div class="col-md-12 mt-0 mb-10 p-sm-0" style="text-align: left;">
                                    <input type="checkbox" id="checkme_online" <?=$checkeds?> class="filled-in">
                                    <label for="checkme_online" style="font-size: 14px">Show online status</a></label>
                                    <div class="alert_msg_online" style="color: #093; font-weight: 600;"></div>
                                </div>
                                <div style="clear: both;"></div> -->

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Full Names <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <input type="text" name="txtfullname" class="form-control" placeholder="Enter your full names" style="text-transform: capitalize;" value="<?=$this->myfullname1?>">
                                    </div>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Username <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <input type="text" name="txtnick" class="form-control" placeholder="Enter your username" value="<?=$this->nickname?>">
                                    </div>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Phone Number <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <input type="number" name="txtphone" class="form-control" placeholder="Enter your phone number" value="<?=$this->myphone?>">
                                    </div>
                                </div>


                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Email Address <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <?php if(strpos($this->myemails, "facebook") !== false){   ?>
                                            <input type="email" name="txtemail" class="form-control" placeholder="Enter your email address" value="<?=$this->myemails?>" style="background: #eee;" disabled>
                                        <?php }else{ ?>
                                            <input type="email" name="txtemail" class="form-control" placeholder="Enter your email address" value="<?=$this->myemails?>">
                                        <?php } ?>
                                    </div>
                                    
                                    <?php
                                    if(strpos($this->myemails, "facebook") !== false){ 
                                        echo "<div style='color:#F66; line-height:18px;'>This was attached to your email because it seems you haven't verified it on Facebook</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Select State <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="txtstates1" name="txtstate">
                                            <option value="" selected>-Select State-</option>
                                            <?php
                                                foreach($states1->result() as $rows){ ?>
                                                    <option value='<?=$rows->id;?>' <?php if($this->states==$rows->id) echo "selected"; ?>><?=$rows->name;?></option>
                                                <?php }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">Select City <font class="asteriks">*</font></label>
                                    <div class="form-line">
                                        <?php if($this->citys<=0){ ?>
                                            <select id="txtcitys" name="txtcitys" class="form-control show-tick">
                                                <option value="" selected>-Select City-</option>
                                            </select>
                                        <?php }else{ ?>
                                            <select id="txtcitys" name="txtcitys" class="form-control show-tick">
                                                <?php
                                                foreach($city1->result() as $rows){ ?>
                                                    <option value='<?=$rows->id;?>' <?php if($this->citys==$rows->id) echo "selected"; ?>><?=$rows->name;?></option>
                                                <?php }
                                            ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 pr-20 p-sm-0">
                                    <label for="email_address">Profession</label>
                                    <div class="form-line">
                                        <input type="text" name="txtprof" class="form-control" placeholder="Enter your profession" value="<?=$this->profession?>">
                                    </div>
                                </div>

                                <div class="col-sm-12 pr-20 p-sm-0">
                                    <label for="email_address">My Facebook Handle</label>
                                    <div class="form-line">
                                        <input type="text" name="txtfb" id="txtfb" class="form-control" placeholder="Facebook Name" value="<?=$this->fb_id?>">
                                    </div>
                                    <span class="span_fb"><?php if($this->fb_id!="") echo "https://www.facebook.com/$this->fb_id"?></span>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">My Instagram Handle</label>
                                    <div class="form-line">
                                        <input type="text" name="txtig" id="txtig" class="form-control" placeholder="Instagram Name" value="<?=$this->ig_id?>">
                                    </div>
                                    <span class="span_ig"><?php if($this->ig_id!="") echo "https://www.instagram.com/$this->ig_id"?></span>
                                </div>

                                <div class="col-sm-6 pr-20 p-sm-0">
                                    <label for="email_address">My Twitter Handle</label>
                                    <div class="form-line">
                                        <input type="text" name="txttw" id="txttw" class="form-control" placeholder="My Twitter Name" value="<?=$this->tw_id?>">
                                    </div>
                                    <span class="span_tw"><?php if($this->tw_id!="") echo "https://www.twitter.com/$this->tw_id"?></span>
                                </div>

                                <div class="col-sm-12 pr-20 p-sm-0">
                                    <label for="email_address">Biography 
                                        <span style="font-weight: normal; font-size: 14px; color: #777;">(Max: 500 characters)</span></label>
                                    <div class="form-line">
                                        <textarea rows="4" name="txtbio" id="txtbio" class="form-control no-resize" placeholder="Please say a little about you"><?=$this->bio?></textarea>
                                    </div>
                                </div>

                                
                                <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8" style="text-align: center;">
                                    <?php
                                    //if($this->sql_models->isContesting($this->myID)){
                                        //echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right update_profileno" style="opacity:0.5;">UPDATE PROFILE</button>';
                                    //}else{
                                        echo '<button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right update_profile">UPDATE PROFILE</button>';
                                    //}
                                    ?>
                                </div>
                                <div class="alert alert_msgs alert_msg1"></div>
                                <div style="clear: both;"></div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>




        <?php if($page_name=="change_media"){ ?>

            <?php
            $ids = "";
            $cctitle = "";
            $media_type = "";

            if(isset($cdetls)){
                $ids = $cdetls['id'];
                $cctitle = $cdetls['title'];
                $media_type = $cdetls['media_type'];
                if($media_type=="vid"){
                    $media_type1 = "Video";
                    $accepteds = 'accept=".mp4"';
                }else{
                    $media_type1 = "Photo";
                    $accepteds = 'accept=".jpg, .jpeg"';
                }
            }

            $descrips = "";
            $results = "";
            if($myentr){
                $descrips = ucfirst($myentr[0]['descrip']);
                $results .= "<div class='row'>";
                $results .= "<div class='refresh_images'>";
                foreach ($myentr as $row) {
                    $myfiles = $row['files'];

                    $pic_pathi = base_url()."media_uploads1/$myfiles";
                    $exts = pathinfo($pic_pathi,PATHINFO_EXTENSION);
                    if($exts=="mp4") // if its mp4 file
                        $pic_pathi = base_url()."profiles1/$myfiles";

                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0)
                        $pic_pathi = base_url()."media_uploads/$myfiles";
                    
                    $results .= "<div class='col-md-4'>";
                    $results .= "<img src='$pic_pathi' class='img-responsive'>";
                    $results .= "</div>";
                }
                $results .= "</div>";
                $results .= "</div>";
            }
        ?>

            <div class="row clearfix">
                <div class="col-lg-9 col-md-10 col-sm-8 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body pl-xs-10 pr-xs-10">
                            <?php
                            if(isset($cdetls) && (!$cdetls || !$myentr)){ ?>
                                <p style="font-size: 16px;" class="mt-10 mb-20">Please go to the contest and click on this circled image below and be redirected back here to change the photo you uploaded.</p>
                                <div class="row">
                                    <div class='col-md-10'><img src='<?=base_url()?>images/howto.png' class='img-responsive'></div>
                                </div>
                            <?php
                            }else{
                            ?>

                            <!-- <form class="input-group uploadPics" autocomplete="off"> -->
                            <form class="input-group uploadPics"  action="#" mediaType="<?=$media_type1?>" method="post" autocomplete="off">
                                <div style="text-align: center; margin: 5px 0 5px 0 !important; font-size: 22px; color: #555"><?=$cctitle?></div>

                                <p style="text-align: center; color: red; font-size: 16px; margin: 0px 0 10px 0 !important;"><b>Note that uploading another photo(s) will overwrite this, upload your photos and click on the button "CHANGE PHOTO" below</b></p>

                                <div class="col-sm-12 pr-20 p-sm-0">
                                    <label for="email_address">Upload <?=$media_type1?> <font class="asteriks">*</font></label>
                                    <font>(Max allowed: 80MB, only JPG files allowed)</font>
                                    <div class="form-line mt-10 mb-10">
                                        <input type="file" name="txtphoto[]" id="txtphoto" mediaType="<?=$media_type1?>" multiple="" <?=$accepteds?> style="padding:7px 0px; font-size: 16px;">
                                    </div>
                                    <?=$results?>
                                </div>

                                <input type="hidden" name="txtcontestID" value="<?=$ids?>">
                                <input type="hidden" name="txtmedia" value="<?=$media_type1?>">
                                <input type="hidden" name="txtupdates" id="txtupdates" value="1">

                                <?php
                                $g=1;
                                if($myentr){
                                    foreach ($myentr as $row) {
                                        $myfiles = $row['files'];
                                        echo "<input type='hidden' name='txtfiles1[]' id='txtfiles1$g' value='$myfiles'>";
                                        $g++;
                                    }
                                }
                                ?>

                                <div class="col-sm-12 pr-20 p-sm-0">
                                    <label>Write about the <?=$media_type1?></label>
                                    <textarea name="txtdescrip" id="txtdescrip" style="height: 15em; width: 100%; padding:7px 10px; font-size: 16px;"><?=$descrips?></textarea>
                                </div>
                                
                                <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8" style="text-align: center;">
                                    <?php
                                    if($this->sql_models->isContestingContestID($this->myID, $ids)){
                                        echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right update_entryno" style="opacity:0.5;">CHANGE PHOTOS</button>';
                                    }else{
                                        echo '<button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right" id="cmd_upload_media">CHANGE PHOTOS</button>';
                                    }
                                    ?>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>




        <?php if($page_name=="sponsor"){
            if($this->id_card!="" && $this->utility!="" && ($this->has_paid<=0) || $this->has_paid==""){
                $displayme1 = "display: none;";
                $displayme2 = "";
            }else{
                $displayme2 = "display: none;";
                $displayme1 = "";
            }
        ?>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="header">
                            <p style="color: #666; margin: 5px 0 3px 0; font-size: 17px">This will enable you to upload a contest for users to participate</p>

                            <?php
                            if($this->id_card!="" && $this->utility!="" && $this->has_paid<=0){
                                echo '<p style="color: red; font-size: 17px">It seems you haven\'t made payment, so we brought you back to this level to complete the process.</p>';
                            }
                            $profileComplete = $this->sql_models->profileComplete($this->myID);
                            if($profileComplete){
                                echo '<p style="color:red; margin: 5px 0 0 0; font-size: 16px">Please complete <a href="'.base_url().'dashboard/profile/">your profile</a> before using this feature!</p>';
                            }
                            ?>
                        </div>

                        <div class="body">
                            <div class="upgrade_form" style="<?=$displayme1?>">
                                <form class="input-group" id="frm_upgrade_sponsor" autocomplete="off">

                                    <input type="hidden" name="txtsponsortype" id="txtsponsortype" value="sponsor">

                                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center; margin: -15px 0 20px 0">
                                        <div id="wallet_amt1">&#8358;<?=@number_format($this->be_a_sponsor, 2)?></div>
                                        <div>Sponsorship Upgrade Fee</div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                        <input type="hidden" name="txtf0" id="txtf0" value="<?=$this->pics;?>">
                                        <ul class="list-inline">
                                            <li id="img_prev1_bma" class="list-inline-item profile_pics3i">
                                                <img src="<?=$this->imgs1; ?>" src1="<?=$this->imgs1; ?>" id="im1_bma">
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Upload Your ID Card</label>
                                        <span style="font-size: 14px; color: #888;">(Max of 6MB, Allowed: jpg, png)</span>
                                        <div class="form-line">
                                            <input id="former_file" name="former_file" value="<?//=$files?>" class="form-control" style="display:none;" />
                                            
                                            <input type="file" name="file1" id="file1" style="padding:4px; font-size:16px;" accept=".jpg, .jpeg" />
                                            <input name="txt_yes_file_bma" type="hidden" value="<?//=$yes_file1;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Upload Your Utility Bill</label>
                                        <span style="font-size: 14px; color: #888;">(Max of 6MB, Allowed: jpg, png)</span>
                                        <div class="form-line">
                                            <input id="former_file" name="former_file" value="<?//=$files?>" class="form-control" style="display:none;" />
                                            
                                            <input type="file" name="file2" id="file2" style="padding:4px; font-size:16px;" />
                                            <input name="txt_yes_file_bma" type="hidden" value="<?//=$yes_file1;?>">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 mt-20 mb-0" style="text-align: center;">
                                        <input type="checkbox" id="checkme" class="filled-in">
                                        <label for="checkme" style="font-size: 14px">In ticking this, you have agreed to the <a href="<?=base_url()?>terms-condition/">terms and condition</a></label>
                                    </div>
                                    
                                    <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                        <?php
                                        $profileComplete = $this->sql_models->profileComplete($this->myID);
                                        if($profileComplete){
                                            echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right no_click" style="opacity:0.5">UPGRADE NOW</button>';
                                        }else{
                                            echo '<button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right upgrade_now">UPGRADE NOW</button>';
                                        }
                                        ?>
                                    </div>
                                    <div style="clear: both;"></div>
                                </form>
                            </div>


                            <div class="upgrade_success_form" style="<?=$displayme2?>">
                                <form class="input-group" id="frm_upgrade_sponsor1" autocomplete="off">
                                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                                        <div id="wallet_amt1">&#8358;<?=@number_format($this->be_a_sponsor, 2)?></div>
                                        <div>Sponsorship Upgrade Fee</div>
                                    </div>

                                    <input type="hidden" name="txtamt_spon" id="txtamt_spon" value="<?=$this->be_a_sponsor?>">
                                    <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                                    <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                    <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                    <input type="hidden" id="txtmemid" value="<?=$this->myID?>">

                                    
                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Select Payment Mode</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="pay_mthd" name="pay_mthd">
                                                <option value="" selected>-Select One-</option>
                                                <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                                <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                                <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right upgrade_now1">MAKE PAYMENTS</button>
                                    </div>
                                    <div style="clear: both;"></div>
                                </form>
                            </div>

                            <div class="alert alert_msgs alert_msg1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
            <script src="https://js.paystack.co/v1/inline.js"></script>
        <?php } ?>




        <?php if($page_name=="become_agent"){
            if($this->id_card!="" && $this->utility!="" && ($this->has_paid<=0) || $this->has_paid==""){
                $displayme1 = "display: none;";
                $displayme2 = "";
            }else{
                $displayme2 = "display: none;";
                $displayme1 = "";
            }
        ?>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="header">
                            <p style="color: #666; margin: 5px 0 3px 0; font-size: 17px">
                                This will enable you to easily transfer money from wallet to wallet to any voters
                            </p>

                            <?php
                            $profileComplete = $this->sql_models->profileComplete($this->myID);
                            if($profileComplete){
                                echo '<p style="color:red; margin: 5px 0 0 0; font-size: 16px">Please complete <a href="'.base_url().'dashboard/profile/">your profile</a> before using this feature!</p>';
                            }
                            ?>
                        </div>

                        <div class="body">
                            <div class="upgrade_form">
                                <form class="input-group" id="frm_upgrade_sponsor" id__="frm_upgrade_agnt" autocomplete="off">

                                    <input type="hidden" name="txtsponsortype" id="txtsponsortype" value="agent">

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                        <input type="hidden" name="txtf0" id="txtf0" value="<?=$this->pics;?>">
                                        <ul class="list-inline">
                                            <li id="img_prev1_bma" class="list-inline-item profile_pics3i">
                                                <img src="<?=$this->imgs1; ?>" src1="<?=$this->imgs1; ?>" id="im1_bma">
                                            </li>
                                        </ul>
                                    </div>

                                    <?php if($this->id_card=="" || $this->utility==""){ ?>

                                        <?php if($this->agents<=0){ ?>
                                        
                                            <div class="col-md-12 pr-20 p-sm-0">
                                                <label for="email_address">Upload Your ID Card</label>
                                                <span style="font-size: 14px; color: #888;">(Max of 6MB, Allowed: jpg, png)</span>
                                                <div class="form-line">
                                                    <input id="former_file" name="former_file" value="<?//=$files?>" class="form-control" style="display:none;" />
                                                    
                                                    <input type="file" name="file1" id="file1" style="padding:4px; font-size:16px;" accept=".jpg, .jpeg" />
                                                    <input name="txt_yes_file_bma" type="hidden" value="<?//=$yes_file1;?>">
                                                </div>
                                            </div>

                                            <div class="col-md-12 pr-20 p-sm-0">
                                                <label for="email_address">Upload Your Utility Bill</label>
                                                <span style="font-size: 14px; color: #888;">(Max of 6MB, Allowed: jpg, png)</span>
                                                <div class="form-line">
                                                    <input id="former_file" name="former_file" value="<?//=$files?>" class="form-control" style="display:none;" />
                                                    
                                                    <input type="file" name="file2" id="file2" style="padding:4px; font-size:16px;" />
                                                    <input name="txt_yes_file_bma" type="hidden" value="<?//=$yes_file1;?>">
                                                </div>
                                            </div>

                                        <?php }else{ ?>

                                            <?php if($this->agents==1){ ?>

                                                <div class="col-md-12 pr-20 p-sm-0">
                                                    You have already become an agent, please wait for admin approval!
                                                </div>

                                            <?php }else if($this->agents==2){ ?>

                                                <div class="col-md-12 pr-20 p-sm-0">
                                                    You have already become an agent!
                                                </div>
                                            <?php } ?>

                                        <?php } ?>
                                        
                                    <?php }else{ ?>

                                        <?php if($this->agents==1){ ?>

                                            <div class="col-md-12 pr-20 p-sm-0 text-center" style="font-size: 16px; color: red">
                                                You have already become an agent, please wait for admin approval!
                                            </div>

                                        <?php }else if($this->agents==2){ ?>

                                            <div class="col-md-12 pr-20 p-sm-0 text-center mb-20" style="font-size: 16px; line-height: 26px;">
                                                <b>You have already become an agent!</b><br>
                                                Kindly <a href="<?=base_url()?>dashboard/mywallet/">fund your wallet</a> with the minimum of &#8358;10,000
                                            </div>
                                        <?php }else{ ?>
                                        
                                            <div class="col-md-12 p-sm-0 text-center" style="font-size: 16px;">
                                                We already have your utilities because you are a sponsor, click the button below to quickly become an agent and start selling funds to voters
                                            </div>
                                        <?php } ?>

                                    <?php } ?>

                                    
                                    <div class="col-md-12 mt-0 mb-0" style="text-align: center;">
                                        <input type="checkbox" id="checkme" class="filled-in">
                                        <label for="checkme" style="font-size: 14px">In ticking this, you have agreed to the <a href="<?=base_url()?>terms-condition/">terms and condition</a></label>
                                    </div>
                                    
                                    
                                    <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                        <?php
                                        $profileComplete = $this->sql_models->profileComplete($this->myID);
                                        if($profileComplete){
                                            echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right no_click" style="opacity:0.5">UPGRADE NOW</button>';
                                        }else{
                                            if($this->id_card=="" || $this->utility==""){
                                                echo '<button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right upgrade_now">UPGRADE NOW</button>';
                                            }else{
                                                if($this->agents==2){
                                                    echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right" style="opacity:0.5">UPGRADE NOW</button>';
                                                }else if($this->agents==1){
                                                    echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right" style="opacity:0.5">UPGRADE NOW</button>';
                                                }else{
                                                    echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right upgrade_now_btn">UPGRADE NOW</button>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="mywallet"){ ?>
            <input type="hidden" value="<?=$params;?>" id="txtparam_transfer">
            <div class="row clearfix">
                <div class="col-md-7 col-sm-7 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="frm_fund" autocomplete="off">

                                <div class="first_form" style="display: nones;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info p-sm-0" style="text-align:center;">
                                        <div id="wallet_amt1" class="wallet_amt1">&#8358;<?=$this->wallets?></div>
                                        <div>Your Wallet Balance</div>

                                        <div style="text-align: center; margin: 5px 0 0 0; font-size: 16px; color: #093">When you enter an amount, click on <b>"Change payment method"</b> and select any of these <b>"Pay with Card"</b>, OR <b>"Pay with USSD"</b>, OR <b>"Pay with Bank Transfer"</b>, etc... and proceed</div>
                                    </div>

                                    <input type="hidden" name="txtmywallet" id="txtmywallet" value="<?=$this->wallets1?>">
                                    <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                    <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                    <input type="hidden" id="txtmemid" value="<?=$this->myID?>">
                                    <input type="hidden" id="txtvp1" value="<?=$this->vps?>">
                                    
                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Enter Amount</label>
                                        <div class="form-line">
                                            <input type="hidden" name="txtamt_fund_hide" id="txtamt_fund_hide">

                                            <input type="number" name="txtamt_fund" id="txtamt_fund" class="form-control txtamt_fund" placeholder="Enter Amount" value="">
                                        </div>
                                    </div>

                                    <!-- <form method='POST' id='ipayform' action='https://ipayairtime.com/vpay/' />
                                      <input type='hidden' name='merchant_id' value='wydf1234' />
                                      <input type='hidden' name='product_name' value='iPay Stickers' />
                                      <input type='hidden' name='product_desc' value='Order for Stickers on iPayAirtime' />
                                      <input type='hidden' name='product_price' value='200' />
                                      <input type='hidden' name='product_ref' value='08103966224' />

                                      <input type='hidden' name='notify_url' value='http://www.yourdomain.com/notify.php' />
                                      <input type='hidden' name='complete_url' value='http://www.yourdomain.com/complete.php' />

                                      <input type='submit' alt='Submit' value='Pay with Airtime' />
                                    </form> -->

                                    <!-- <input type="hidden" name="pay_mthd" id="pay_mthd" value="online"> -->

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Select Payment Mode</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="pay_mthd" name="pay_mthd">
                                                <option value="" selected>-Select One-</option>
                                                <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                                <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                                <option value="transfer">Cash Deposit</option>
                                                <!-- <option value="airtime" disabled>Airtime (Coming soon)</option> -->
                                                <option value="vp">Vote Point (<?=$this->vps?>VPs, 20VP = &#8358;1)</option>
                                                <option value="agents">Buy From Agents</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1 mb-0"></div>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 mt-15" style="text-align: center;">

                                        <button type="button" class="btn btn-primary waves-effect waves-light pull-right cmd_fund" onpage="">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></button>

                                        <button type="button" style="display: none;" class="btn btn-primary waves-effect waves-light pull-right cmd_fund_proceed">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></button>
                                    </div>
                                </div>


                                <div class='div_paid_pending pb-20' style="display:none; text-align: center">
                                    <p>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                          <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                          <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                        </svg>
                                    </p>

                                    <p style="font-size:20px; color:#093;"><b>Your Transaction is Pending...</b></p>
                                    <p style="font-size:16px; color:#555;" class="expiry_caption">As soon as we receive your payments, we will notify you via your email address, thank you for your patronage.</b>
                                    </p>

                                    <p style="font-size:15.5px; color:#555;" class="expiry_caption">Please send us these details: <b><?=$this->myfullname?></b>, <b><?=$this->mymail?></b> and the <b>Amount</b> you paid, to our phone number <a href="tel:+2348064505377" style="font-family: arial">+234 806 4505 377</a> or send to our email <a href="mailto:icontestprobox@gmail.com" style="font-family: arial">icontestprobox@gmail.com</a>.</b>
                                    </p>

                                    <div class="acct_detls mt-20 mb-10" style="display: nones;">
                                        <div><h4>Company Account Details</h4></div>
                                        <p>
                                            <b>Account Name:</b> Afrinovation<br>
                                            <b>Bank Name:</b> GTBank<br>
                                            <b>Account Number:</b> <font>0168611884</font>
                                        </p>
                                    </div>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8" style="text-align: center;">
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_goto_fund">DONE</button>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
            <script src="https://js.paystack.co/v1/inline.js"></script>
            
            <br><br>
        <?php } ?>



        <?php if($page_name=="transfer"){ ?>
            <input type="hidden" value="<?=$params;?>" id="txtparam_transfer">
            
            <div class="row clearfix">
                <div class="col-md-7 col-sm-7 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="frm_transfer" autocomplete="off">
                                <div class="first_form_tra" style="display: nones;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info p-sm-0" style="text-align:center;">
                                        <div id="wallet_amt1" class="wallet_amt1">&#8358;<?=$this->wallets?></div>
                                        <div>Your Wallet Balance</div>

                                        <div style="text-align: center; margin: 5px 0 0 0; font-size: 17px; color: #093">Enter the amount you want to transfer and select the recipient</div>
                                    </div>

                                    <input type="hidden" name="txtmywallet1" id="txtmywallet1" value="<?=$this->wallets1?>">
                                    
                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Enter Amount</label>
                                        <div class="form-line">
                                            <input type="number" name="txtramt" id="txtramt" class="form-control" placeholder="Enter Amount From Your Wallet" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Recipient's Email or Phone</label>
                                        <div class="form-line">
                                            <input type="email" name="txtremail" id="txtremail" class="form-control" placeholder="Enter Email or Phone">
                                        </div>
                                    </div>

                                    <div style="clear: both;"></div>

                                    <?php
                                    if($this->agents==2){
                                        echo "<p style='color:#096; font-size:15.5px; text-align:center;'>You will get $this->cash_back% cash back on any transfer you make as a reward from iContestPRO</p>";
                                    }
                                    ?>
                                    <div class="alert alert_msgs alert_msg1 mb-0"></div>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 mt-15" style="text-align: center;">
                                        <button type="button" class="btn btn-primary waves-effect waves-light pull-right cmd_proceed_tran">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></button>
                                    </div>
                                </div>


                                <div class='sec_form_tra pb-20' style="display:none;text-align: center">
                                    <p style="font-size:20px; color:#093; text-align: center"><b>Confirm These Details</b></p>

                                    <input type="hidden" id="txtreci_id">
                                    <input type="hidden" id="rec_amt">

                                    <div class="acct_detls mt-10 mb-10" style="display: nones;">
                                        <div><h4 style="line-height: 23px">Transfer <font class="rec_amt"></font> From Your Wallet to This Recipient</h4></div>
                                        
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-8 p-sm-0">
                                                <div class="col-md-4 p-0 col-xs-4 noboldcolor">
                                                    <p><b>Name:</b></p>
                                                    <p><b>Email/Phone:</b></p>
                                                    <p><b>Amount:</b></p>
                                                </div>

                                                <div class="col-md-8 col-xs-8">
                                                    <p><b class="rec_name"></b></p>
                                                    <p><b class="rec_email"></b></p>
                                                    <p><b class="rec_amt"></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border_row mt--20 mb-20 mt-xs-0 mb-xs-10"></div>

                                    <div style="clear: both;"></div>
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-0 col-xs-12 pr-sm-20 pl-xs-10">

                                            <div class="col-md-5 col-sm-5 col-xs-5 pr-20 pr-sm-10 pl-xs-0" style="text-align: center;">
                                                <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_goto_first_form_tra">BACK</button>
                                            </div>

                                            <div class="col-md-7 col-sm-7 col-xs-7 p-0" style="text-align: center;">
                                                <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_do_transfer">TRANSFER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="clear: both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php } ?>



        <?php if($page_name=="company_acct_details"){ ?>
            <div class="row clearfix">
                <div class="col-md-7 col-sm-7 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="" autocomplete="off">

                                <div class='div_paid_pending pb-20 pt-10' style="display:nones; text-align: center">
                                    <p style="font-size:20px; color:#093;"><b>Incase of any Cash Deposit</b></p>

                                    <p style="font-size:16px; color:#555;" class="expiry_caption">Please send us these details: <b><?=$this->myfullname?></b>, <b><?=$this->mymail?></b> and the <b>Amount</b> you paid and the <b>purpose of payment</b>, to our phone number <a href="tel:+2348064505377" style="font-family: arial">+234 806 4505 377</a> or send to our email <a href="mailto:icontestprobox@gmail.com" style="font-family: arial">icontestprobox@gmail.com</a>.</b>
                                    </p>

                                    <div class="acct_detls mt-20 mb-10" style="display: nones;">
                                        <div><h4>Company Account Details</h4></div>
                                        <p>
                                            <b>Account Name:</b> Afrinovation<br>
                                            <b>Bank Name:</b> GTBank<br>
                                            <b>Account Number:</b> <font>0168611884</font>
                                        </p>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

            <br><br>
        <?php } ?>



        <?php if($page_name=="request_withdraw"){
            $activeContest = $this->sql_models->checkActiveContest();
        ?>
            <div class="row clearfix">
                <div class="col-md-7 col-sm-8 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="frm_withdraw" autocomplete="off">
                                <div class="first_form" style="display: nones;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 wallet_info" style="text-align:center;">

                                        <input type="hidden" id="txtmywallet" name="txtmywallet" value="<?=$this->wallets1?>">

                                        <div id="wallet_amt1">&#8358;<?=$this->wallets?></div>
                                        <div>Wallet Balance</div>
                                        <p style="text-align: center; line-height: 22px; color: #555; margin-top: 5px;">Request amount to withdraw from your wallet back to your bank account</p>

                                        <?php
                                        if($activeContest && $isSponsor){
                                            echo '<p style="text-align: center; line-height: 22px; color: red; margin-top: -5px;">You cannot carry out this transaction because you still have some active contest(s).</p>';
                                        }
                                        ?>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Enter Amount To Withdraw</label>
                                        <div class="form-line">
                                            <input type="number" name="txtamt4" id="txtamt4" class="form-control" placeholder="Enter Amount" value="" style="font-size: 24px;">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Enter Your Account Number</label>
                                        <div class="form-line">
                                            <input type="tel" name="txtacct_no" id="txtacct_no" class="form-control" placeholder="Enter Account Number" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Select Your Bank</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="txtbank">
                                                <option value="" selected>-Select Bank-</option>
                                                <?php
                                                    foreach($bank_names as $rows){ ?>
                                                        <option value='<?=$rows["id"];?>'><?=$rows["banks"];?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Enter Your Account Name</label>
                                        <div class="form-line">
                                            <input type="text" name="txtacct_name" class="form-control" placeholder="Enter Account Name" style="text-transform: capitalize;">
                                        </div>
                                    </div>

                                    <p class="pl-5 pr-10" style="color: red; font-size: 16px;">Note that <?=$this->withdraw_fee?>% transaction charges will be removed from the amount you have entered.</p>

                                    <div class="col-md-offset-2 col-md-8" style="text-align: center;">
                                        <?php
                                        if($this->wallets1 >= 2000){
                                            if($activeContest && $isSponsor){
                                                echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_not_avail2" style="opacity:0.5">REQUEST WITHDRAWAL</button>';
                                            }else{
                                                echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_withdraw">REQUEST WITHDRAWAL</button>';
                                            }
                                        }else{
                                            echo '<button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_not_avail" style="opacity:0.5">REQUEST WITHDRAWAL</button>';
                                        }
                                        ?>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        <?php } ?>



        <?php if($page_name=="upload_contest" || $page_name == "edit_contest"){
            $disableText="disabled";
            $color_bg="background: #eee;";
            if($getId!=""){
                $id1 = $getId['id'];
                $overall_title = ucwords($getId['title']);
                $instructn = strip_tags($getId['instructions']);
                $media_type = $getId['media_type'];
                $descrip = strip_tags($getId['descrip']);
                $files = $getId['files'];
                $company_logo = $getId['company_logo'];
                $company_ads = $getId['company_ads'];
                $user_id = $getId['user_id'];
                $price1 = $getId['price1'];
                $price2 = $getId['price2'];
                $price3 = $getId['price3'];
                $price4 = $getId['price4'];
                $price5 = $getId['price5'];
                $add_price1 = $getId['add_price1'];
                $add_price2 = $getId['add_price2'];
                $add_price3 = $getId['add_price3'];
                $add_price4 = $getId['add_price4'];
                $add_price5 = $getId['add_price5'];
                $premium = $getId['premium'];
                $sponsoredby = $getId['sponsoredby'];
                $entry_type = $getId['entry_type'];
                $entry_fee = $getId['entry_fee'];
                $start_date = $getId['start_date'];
                $close_date_entry = $getId['close_date_entry'];
                $start_date_contest = $getId['start_date_contest'];
                $timings = $getId['timings'];
                $start_date = date("Y-m-d", strtotime($start_date));
                if($close_date_entry!="") $close_date_entry = date("Y-m-d", strtotime($close_date_entry));
                if($start_date_contest!="") $start_date_contest = date("Y-m-d", strtotime($start_date_contest));
                $timings = date("Y-m-d", $timings);
                $captions1 = 'UPDATE CONTEST';
                $captions2 = 'UPDATE A CONTEST';
                if($entry_fee>0){
                    $disableText="";
                    $color_bg="";
                }

            }else{
                $overall_title = ""; $instructn = ""; $media_type = ""; $descrip = ""; $id1="";
                $files = ""; $company_logo = ""; $company_ads=""; $price1 = ""; $price2 = ""; $price3 = ""; $price4 = ""; 
                $price5 = "";
                $add_price1 = ""; $add_price2 = ""; $add_price3 = ""; $add_price4 = ""; $add_price5 = "";
                $premium = ""; $sponsoredby=""; $close_date_entry = ""; $start_date_contest = "";
                $entry_type = ""; $entry_fee = ""; $start_date = ""; $timings = ""; $start_date = "";
                $timings = ""; $captions1 = 'UPLOAD CONTEST'; $captions2 = 'ADD A CONTEST';
            }
            $yes_file1=0; $yes_logo=0; $yes_ads=0;

            if($files!="") $yes_file1=1;
            if($company_logo!="") $yes_logo=1;
            if($company_ads!="") $yes_ads=1;
        ?>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="header">
                            <p style="color: #FF5151; margin: 5px 0 0 0; font-size: 15px">All fields below with (*) are compulsory except for the ones labelled "optional"</p>

                        </div>
                        <div class="body pl-xs-10 pr-xs-10">
                            <form class="input-group" id="frm_contest" autocomplete="off">
                                <input type="hidden" name="txtc_id" id="txtc_id" value="<?=$id1?>">
                                <input type="hidden" name="txt_immediate_id" id="txt_immediate_id" value="<?=$id1?>">

                                <div class="first_contest_form" style="display: nones;">
                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Contest Title</label>
                                        <div class="form-line">
                                            <input type="text" name="txttitle" class="form-control" placeholder="Enter contest title" value="<?=$overall_title?>" style="text-transform: capitalize;">
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Contest Type</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="txtctype" name="txtctype">
                                                <option value="">-Select-</option>
                                                <option value="pic" <?php if($media_type=="pic") echo "selected"; else echo "selected"; ?>>Photo Contest</option>
                                                <option value="vid" <?php if($media_type=="vid") echo "selected"; ?>>Video Contest</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Type Of Vote</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="txtvotetype" name="txtvotetype">
                                                <option value="" selected>-Select-</option>
                                                <option value="free_paid" <?php if($premium=="free_paid" || $premium=="") echo "selected"; ?>>FREE & BOOST</option>

                                                <option value="free" <?php if($premium=="free") echo "selected"; ?>>ONLY FREE</option>

                                                <option value="paid" <?php if($premium=="paid") echo "selected"; ?>>ONLY BOOST</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Entry Type</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="txtentry_type" name="txtentry_type">
                                                <option value="free" <?php if($entry_type=="free" || $entry_type=="") echo "selected"; ?>>FREE</option>
                                                <option value="paid" <?php if($entry_type=="paid") echo "selected"; ?>>PAID</option>
                                                <option value="coded" <?php if($entry_type=="coded") echo "selected"; ?>>CODED</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Enter Fee</label>
                                        <div class="form-line">
                                            <input type="number" name="txtentryfee" id="txtentryfee" <?=$disableText?> class="form-control" minlength="3" maxlength="6" placeholder="Enter Entry Fee" value="<?=$entry_fee?>" style="<?=$color_bg?>">
                                        </div>
                                        <p style="color: #777;">This box can only be enabled when the entry type is PAID</p>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Contest Description <span style="font-size: 14px; color: #888;">(Max of 2000 characters)</span></label>
                                        <div class="form-line">
                                            <textarea maxlength="2000" name="txtdescrip" class="form-control no-resize txtarea" placeholder="Enter Contest Description"><?=$descrip?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Contest Banner</label>
                                        <span style="font-size: 14px; color: #888; margin:-8px 0 8px 0" class="block">(Max of 4MB, Allowed: jpg, png)</span>
                                        <div class="form-line">
                                            <input id="former_file" name="former_file" value="<?=$files?>" class="form-control" type="hidden" />
                                            
                                            <input type="file" name="file_banner" id="file_banner" style="padding:4px; font-size:16px;" />
                                            <input name="txt_yes_file_bma" type="hidden" value="<?=$yes_file1;?>">
                                        </div>

                                        <?php
                                        if($getId!=""){
                                            echo "<div class='update_imgs1'>";
                                            if($files!='')
                                                echo "<img src='".base_url()."contest_types/$files' id='im10'>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Contest Logo</label>
                                        <span style="font-size: 14px; color: #888; margin:-8px 0 8px 0" class="block">(Max of 500KB, Allowed: jpg, png)</span>
                                        <div class="form-line">
                                            <input id="former_logo" name="former_logo" value="<?=$company_logo?>" class="form-control" type="hidden" />
                                            
                                            <input type="file" name="file_logo" id="file_logo" style="padding:4px; font-size:16px;" />
                                            <input name="txt_yes_logo_bma" type="hidden" value="<?=$yes_logo;?>">
                                        </div>

                                        <?php
                                        if($getId!=""){
                                            echo "<div class='update_imgs1'>";
                                            if($company_logo!='')
                                                echo "<img src='".base_url()."companys/$company_logo' id='im10'>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Your Advert (Optional)</label>
                                        <span style="font-size: 14px; color: #888; margin:-8px 0 8px 0" class="block">(Max of 500KB, Allowed: jpg, png)</span>
                                        <div class="form-line">
                                            <input id="former_ad_file" name="former_ad_file" value="<?=$company_ads?>" class="form-control" type="hidden" />
                                            
                                            <input type="file" name="file_ad" id="file_ad" style="padding:4px; font-size:16px;" />
                                            <input name="txt_yes_ad_bma" type="hidden" value="<?=$yes_ads;?>">
                                        </div>
                                        <span style="font-size: 14px; color: #888; margin:-8px 0 8px 0" class="block">Upload any of your adverts, this is to help you promote it on our platform free of charge.</span>

                                        <?php
                                        if($getId!=""){
                                            echo "<div class='update_imgs1'>";
                                            if($company_ads!='')
                                                echo "<img src='".base_url()."companys/$company_ads' id='im10'>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Sponsored By</label>
                                        <div class="form-line">
                                            <input type="text" name="txtsponName" value="<?=$sponsoredby;?>" placeholder="Enter Sponsor Name" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">First Prize (Amount &#8358;)</label>
                                        <div class="form-line">
                                            <input type="number" name="txtfprize" value="<?php echo $price1; ?>" placeholder="Enter First Prize" class="form-control" />

                                        </div>

                                        <div class="form-line">
                                            <p style="margin: 10px 0 0px 0; color: #FF2B2B; font-size: 16px;"><b>Additional Gift 1</b> (Optional) <span style="font-size: 14px; color: #777;"><br>(Max of 50 characters)</span></p>
                                            <input type="text" name="txtadd_gift1" maxlength="50" class="form-control" placeholder="Enter additional gift 1" value="<?=$add_price1?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Second Prize (Amount &#8358;)</label>
                                        <div class="form-line">
                                            <input type="number" name="txtsprize" value="<?php echo $price2; ?>" placeholder="Enter Second Prize" class="form-control" />

                                        </div>

                                        <div class="form-line">
                                            <p style="margin: 10px 0 0px 0; color: #FF2B2B; font-size: 16px;"><b>Additional Gift 2</b> (Optional) <span style="font-size: 14px; color: #777;"><br>(Max of 50 characters)</span></p>
                                            <input type="text" name="txtadd_gift2" maxlength="50" class="form-control" placeholder="Enter additional gift 2" value="<?=$add_price2?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Third Prize (Optional) (Amount &#8358;)</label>
                                        <div class="form-line">
                                            <input type="number" name="txttprize" value="<?php echo $price3; ?>" placeholder="Enter Third Prize" class="form-control" />

                                        </div>

                                        <div class="form-line">
                                            <p style="margin: 10px 0 0px 0; color: #FF2B2B; font-size: 16px;"><b>Additional Gift 3</b> (Optional) <span style="font-size: 14px; color: #777;"><br>(Max of 50 characters)</span></p>
                                            <input type="text" name="txtadd_gift3" maxlength="50" class="form-control" placeholder="Enter additional gift 3" value="<?=$add_price3?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Fourth Prize (Optional) (Amount &#8358;)</label>
                                        <div class="form-line">
                                            <input type="number" name="txtftprize" value="<?php echo $price4; ?>" placeholder="Enter Fourth Prize" class="form-control" />

                                        </div>

                                        <div class="form-line">
                                            <p style="margin: 10px 0 0px 0; color: #FF2B2B; font-size: 16px;"><b>Additional Gift 4</b> (Optional) <span style="font-size: 14px; color: #777;"><br>(Max of 50 characters)</span></p>
                                            <input type="text" name="txtadd_gift4" maxlength="50" class="form-control" placeholder="Enter additional gift 4" value="<?=$add_price4?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Fifth Prize (Optional) (Amount &#8358;)</label>
                                        <div class="form-line">
                                            <input type="number" name="txtffprize" value="<?php echo $price5; ?>" placeholder="Enter Fifth Prize" class="form-control" />

                                        </div>

                                        <div class="form-line">
                                            <p style="margin: 10px 0 0px 0; color: #FF2B2B; font-size: 16px;"><b>Additional Gift 5</b> (Optional) <span style="font-size: 14px; color: #777;"><br>(Max of 50 characters)</span></p>
                                            <input type="text" name="txtadd_gift5" maxlength="50" class="form-control" placeholder="Enter additional gift 5" value="<?=$add_price5?>">
                                        </div>
                                    </div>


                                    <?php
                                    $cur_date = date("Y-m-d", time());
                                    $cur_date1 = date("Y-m-d", strtotime('+1 days', time()));
                                    $cur_date2 = date("Y-m-d", strtotime('+2 days', time()));
                                    $cur_date3 = date("Y-m-d", strtotime('+4 days', time()));
                                    $cur_date4 = date("Y-m-d", strtotime('+5 days', time()));
                                    if($start_date=="") $start_date1 = $cur_date; else $start_date1 = $start_date;
                                    if($close_date_entry=="") $close_date_entry1 = ""; else $close_date_entry1 = $close_date_entry;

                                    if($start_date_contest=="") $start_date_contest1 = $cur_date3; else $start_date_contest1 = $start_date_contest;

                                    if($timings=="") $timingsK = $cur_date4; else $timingsK = $timings;
                                    ?>

                                    <div class="col-md-6 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Start Date Of Entry <span style="font-weight:normal">(month/day/year)</span></label>
                                        <div class="form-line">
                                            <input type="date" name="txtstartdate" value="<?=$start_date1?>" id="txtstartdate" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Close Date Of Entry <span style="font-weight:normal">(month/day/year) <font style="color: #888">(Optional)</font></span></label>
                                        <div class="form-line">
                                            <input type="date" name="txtclosedate" value="<?=$close_date_entry1?>" id="txtclosedate" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Start Date Of Contest <span style="font-weight:normal">(month/day/year)</span></label>
                                        <div class="form-line">
                                            <input type="date" name="txtstartduration" value="<?=$start_date_contest1?>" id="txtstartduration" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0 mt-10">
                                        <label for="email_address">Close Date Of Contest <span style="font-weight:normal">(month/day/year)</span></label>
                                        <div class="form-line">
                                            <input type="date" name="txtduration" value="<?=$timingsK?>" id="txtduration" class="form-control" />
                                        </div>
                                    </div>


                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Instructions <span style="font-weight: normal; color: #777;">(Optional)</span>
                                            <span style="font-weight: normal; font-size: 14px; color: #777;">(Max: 500 characters)</span></label>
                                        <div class="form-line">
                                            <textarea rows="3" name="txtinstr" class="form-control no-resize txtarea1" placeholder="Write a little instruction of this contest"><?=$instructn?></textarea>
                                        </div>
                                    </div>


                                    <?php
                                    $chks=""; $chks1="";
                                    if($this->phone_visible==1)
                                        $chks="checked";

                                    if($this->social_handles==0)
                                        $chks1="checked";
                                    ?>

                                    <div class="col-md-12 mt-20 mb-10" style="text-align: center;">
                                        <input type="checkbox" <?=$chks?> id="checkme" name="checkme" value="1" class="filled-in">
                                        <label for="checkme" style="font-size: 16px; color: #555">Make your number visible so that your contestants can easily reach you.</label>

                                        <input type="checkbox" <?=$chks1?> id="checkme1" name="checkme1" value="1" class="filled-in">
                                        <label for="checkme1" style="font-size: 16px; color: #555">This will also include your social media handles on your contest.</label>
                                    </div>

                                    <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_contest"><?=$captions1?></button>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>
                                </div>


                                <div class="success_form_contest_pay" style="display: none;">
                                    <div class="col-md-11 col-sm-10 col-xs-12 p-sm-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                                            <div id="amount_pay">&#8358;<?=@number_format($this->contest_fee,2)?></div>
                                            <p class="little_info1"><?=$this->paid_votes?>% Vote Commission For iContestPRO</p>

                                            <p style="color: red; margin-top:-5px; display: none;" class="info_free">The "Free Contest Type" here was disabled because you selected "Type of Vote" to be free!</p>
                                        </div>

                                        <input type="hidden" id="txtcontest_id1">

                                        <input type="hidden" name="txtamt" id="txtamt" value="<?=$this->contest_fee?>">
                                        <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                                        <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                        <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                        <input type="hidden" id="txtmemid" value="<?=$this->myID?>">


                                        <div class="col-md-12 pr-20 pl-20 pl-sm-0 pr-sm-0 mt-10">
                                            <label for="email_address">Select Contest Type</label>
                                            <div class="form-line refresh_select">
                                                <select class="form-control show-tick" id="txtconType" name="txtconType">
                                                    <option data-value="<?=$contest_fee1?>" data-value1="For <?=$this->paid_votes?>% Vote Commission" data-value2="<?=$contest_fee1i?>" data-value3="1" selected><?=$contest_fee1?> For <?=$this->paid_votes?>% Vote Commission</option>
                                                    
                                                    <option data-value="<?=$contest_fee2?>" data-value1="For <?=$this->paid_votes2?>% Vote Commission" data-value2="<?=$contest_fee2i?>" data-value3="2"><?=$contest_fee2?> For <?=$this->paid_votes2?>% Vote Commission</option>

                                                    <option data-value="<?=$contest_fee3?>" data-value1="For <?=$this->paid_votes3?>% Vote Commission" data-value2="<?=$contest_fee3i?>" data-value3="3"><?=$contest_fee3?> For <?=$this->paid_votes3?>% Vote Commission</option>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12 pr-20 pl-20 pl-sm-0 pr-sm-0">
                                            <label for="email_address">Select Payment Mode</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" id="pay_mthd1" name="pay_mthd1">
                                                    <option value="">-Select One-</option>
                                                    <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                                    <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                                    <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="text-align: center; margin-top: 6px;">

                                            <button type="button" class="btn btn-primary btn-blocks1 waves-effect waves-light backtocontestform">BACK</button>

                                            <button type="button" class="btn btn-primary btn-blocks waves-effect waves-light cmd_upload_contest_pay">MAKE PAYMENTS</button>
                                        </div>

                                        <div style="clear: both;"></div>
                                        <div class="alert alert_msgs alert_msg1"></div>
                                        <br>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "view_contests"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_contests" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Approved</th>
                                        <th>Status</th>
                                        <th class="none">Media Type:</th>
                                        <th class="none">&nbsp;</th>
                                        <th class="none">Views:</th>
                                        <th class="none">&nbsp;</th>
                                        <th class="none">Vote Type:</th>
                                        <th class="none">Sponsored By</th>
                                        <th class="none">Start Date Of Entry:</th>
                                        <th class="none">Close Date Of Entry:</th>
                                        <th class="none">Start Date Of Contest:</th>
                                        <th class="none">Close Date Of Contest:</th>
                                        <th class="none">Duration:</th>
                                        <th class="none">Banner</th>
                                        <th class="none">Description</th>
                                        <th class="none">Instruction</th>
                                        <th>Date Uploaded</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>



        <?php if($page_name == "sponsored_contests"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_sponsored" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest</th>
                                        <th>Paid</th>
                                        <th>Amount</th>
                                        <th class="none">Status</th>
                                        <th class="none">Response</th>
                                        <th>Duration Stamp</th>
                                        <th class="none">Duration</th>
                                        <th>Date Boosted</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "entry_records"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <?php
                                if(is_numeric($url_id)){
                                    $getContestName = $this->sql_models->getContestName($url_id);
                                    echo "<p style='text-align: center; font-size: 21px; color: #06C; line-height: 24px;' class='mt-0 mt-sm-20'>Contest: <b>$getContestName</b></p>";

                                    $total_vts = $this->sql_models->sumColmn('entries', 'votes', 'contest_id', $url_id);
                                    $bsts_vts = $this->sql_models->sumColmn('bstd_vts', 'votes', 'contest_id', $url_id);
                                    $total_entrs = $this->sql_models->calCounts1('entries', 'contestant_id', 'members', $url_id);

                                    $entr_fee = $this->sql_models->sumColmn('entries_fee', 'fee', 'contest_id', $url_id);

                                    $party_entr_fee = ($this->entry_fee/100) * $entr_fee; //100
                                    $party_entr_fee1 = $entr_fee - $party_entr_fee; //900

                                    $boosted_fee = $this->sql_models->sumColmn('bstd_vts', 'amts', 'contest_id', $url_id);

                                    $getConType = $this->sql_models->getContestType($url_id); // 1 means 50k, 2 means 20k, 3 means free
                                    $paid_votes=0;
                                    if($getConType){
                                        $contest_type = $getConType;
                                        if($contest_type==1)
                                            $paid_votes = $this->paid_votes;

                                        else if($contest_type==2)
                                            $paid_votes = $this->paid_votes2;

                                        else if($contest_type==3)
                                            $paid_votes = $this->paid_votes3;
                                    }

                                    $admin_percent = $paid_votes / 100; // 20 / 100 = 0.2
                                    $admin_percent1 = round($admin_percent * $boosted_fee); // 0.2*1000=200
                                    $mypercent = $boosted_fee - $admin_percent1; // 1000-200=800
                                }

                                ?>

                                <div class="row_clearfix mt-20">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                                        <div class="info-box info-box2 bg-red hover-expand-effect">
                                            <div class="icon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text">ENTRY FEE</div>
                                                <div class="number num_amt">&#8358;<?=@number_format($entr_fee)?></div>

                                                <div class="text mt-0">iContest Comm</div>
                                                <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($party_entr_fee)?></b></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                                        <div class="info-box info-box2 bg-cyan hover-expand-effect">
                                            <div class="icon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text">BOOSTED</div>
                                                <div class="number num_amt">&#8358;<?=@number_format($boosted_fee)?></div>

                                                <div class="text mt-0">iContest Comm</div>
                                                <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($admin_percent1)?></b></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                                        <div class="info-box info-box2 bg-orange hover-expand-effect">
                                            <div class="icon">
                                                <i class="fa fa-upload"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text">ALL VOTES</div>
                                                <div class="number num_amt"><?=@number_format($total_vts)?></div>

                                                <div class="text mt-0">Boosted Votes</div>
                                                <div class="text mt-0" style="font-size: 16px;"><b><?=@number_format($bsts_vts)?></b></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                                        <div class="info-box info-box2 bg-cyan hover-expand-effect">
                                            <div class="icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text">ALL ENTRIES</div>
                                                <div class="number num_amt"><?=@number_format($total_entrs)?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="tbl_entries" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <?php
                                        if(!is_numeric($url_id)){
                                            echo "<th>Contest</th>";
                                        }
                                        ?>
                                        <th>Contestants</th>
                                        <th>Total Votes</th>
                                        <th>Total Views</th>
                                        <th class="none">Entry Date</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "view_transactions"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_transac" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Account No</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Date Requested</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "transfer_history"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_trans_his" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sender</th>
                                        <th>Recipient</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>




        <?php if($page_name=="adverts" || $page_name == "edit_adverts"){
            if($getId!=""){
                $id1 = $getId['id'];
                $overall_title = ucwords($getId['title']);
                $files = $getId['files'];
                $sizes = $getId['sizes'];
                $displaynone = "style='display:none'";
                $col_12="col-md-12";
                $urls = $getId['urls'];
                $urls1 = $getId['urls1'];
                $captions1 = 'EDIT YOUR AD';
                $captions2 = 'EDIT YOUR AD';

            }else{
                $overall_title = ""; $files = ""; $urls = ""; $disabled = ""; $col_12="col-md-6"; 
                $id1=""; $displaynone=""; $sizes = "";$urls1="";
                $captions1 = 'SUBMIT YOUR AD'; $captions2 = 'SUBMIT YOUR AD';
            }
            $yes_file1=0;
            if($files!="") $yes_file1=1;

            $advSettings = $this->sql_models->advSettings('advert_settings');
        ?>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="header pl-xs-10 pr-xs-10">
                            <p style="color: #FF5151; margin: 5px 0 0 0; font-size: 14px">All fields below with (*) are compulsory except for the ones labelled "optional"</p>

                            <p class="view_banners" style="color: #09C; margin: 10px 0 0 0; font-size: 18px; cursor: pointer;">Click to See sizes of ADs</p>

                            <div class="open_banner col-md-12 p-0 mt-10" style="display: none;">
                                <div class="col-lg-2 col-md-3 col-sm-4 p-5">
                                    <img src="<?=base_url()?>images/ad1.jpg">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 p-5">
                                    <img src="<?=base_url()?>images/ad2.jpg">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 p-5">
                                    <img src="<?=base_url()?>images/ad3.jpg">
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-4 p-5">
                                    <img src="<?=base_url()?>images/ad4.jpg">
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>


                        <div class="body pl-xs-10 pr-xs-10">
                            <form class="input-group" id="frm_adv" autocomplete="off">

                                <div class="first_form_adv" style="display: nones;">
                                    <input type="hidden" name="txtad_id" id="txtad_id" value="<?=$id1?>">
                                    <input type="hidden" name="txtgoback_ad_id" id="txtgoback_ad_id" value="<?=$id1?>" style="background: #ccc;">
                                    <input type="hidden" name="txtmemid" id="txtmemid" value="<?=$this->myID?>">

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Advert Title</label>
                                        <div class="form-line">
                                            <input type="text" name="txttitle" id="txttitle" class="form-control" placeholder="Enter advert title" value="<?=$overall_title?>" style="text-transform: capitalize;">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Upload Advert</label>
                                        <span style="font-size: 14px; color: #888;">(Max of 3MB, Allowed: jpg, jpeg)</span>
                                        <div class="form-line">
                                            <input id="former_file" name="former_file" value="<?=$files?>" class="form-control" style="display:none;background: #ccc;" />
                                            
                                            <input type="file" name="file_banner" id="file_banner" style="padding:4px; font-size:16px;" accept=".jpg, .jpeg" />
                                            <input name="txt_yes_file_bma" type="hidden" value="<?=$yes_file1;?>">
                                        </div>

                                        <?php
                                        if($getId!=""){
                                            echo "<div class='update_imgs1'>";
                                            if($files!='')
                                                echo "<img src='".base_url()."adverts1/$files' id='im11'>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>

                                    <div class="col-sm-6 pr-20 pl-sm-0 pr-sm-10 p-xs-0" <?=$displaynone?>>
                                        <label for="email_address">Advert Banner (Size) </label>
                                        <div class="form-line">
                                            <select class="form-control calcs_1" id="txtsize" name="txtsize">
                                                <option value="nones" selected>-Select-</option>
                                                <option value="250x250" <?php if($sizes=="250x250") echo "selected"; ?>>250x250</option>

                                                <option value="780x90" <?php if($sizes=="780x90") echo "selected"; ?>>780x90</option>

                                                <option value="300x600" <?php if($sizes=="300x600") echo "selected"; ?>>300x600</option>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-6 pr-20 pl-sm-10 pr-sm-0 p-xs-0" <?=$displaynone?>>
                                        <label for="email_address">Target Position</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="txtpositn" name="txtpositn">
                                                <option value="" selected>-Select-</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-6 pr-20 pl-sm-10 pr-sm-0 p-xs-0" style="display: none;">
                                        <label for="email_address">Target Position</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="txtpositn" name="txtpositn">
                                                <option value="" selected>-Select-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 pr-20 pl-sm-0 pr-sm-10 p-xs-0" <?=$displaynone?>>
                                        <label for="email_address">Duration (In days)</label>
                                        <div class="form-line">
                                            <select class="form-control calcs_2" id="txtdurs1" name="txtdurs1">
                                                <option value="7 days">7 Days</option>
                                                <option value="15 days">15 Days</option>
                                                <option value="30 days">30 Days</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">URL/Email</label>
                                        <div class="form-line">
                                            <input type="text" name="txtlink" id="txtlink" class="form-control" placeholder="Enter your link or email" value="<?=$urls1?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 pr-20 p-sm-0 p-xs-0" <?=$displaynone?>>
                                        <label for="email_address">Total Fee: &nbsp;</label>
                                        <span class="total_fees">&#8358;0.00</span>
                                    </div>
                                    <input name="txtamts_adv" id="txtamts_adv" type="hidden" value="">

                                    
                                    <div class="col-sm-offset-3 col-sm-6" style="text-align: center;">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_ads"><?=$captions1?></button>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>
                                </div>


                                <div class="success_form_ad1" style="display: none;">
                                    <div class="col-md-11 col-sm-10 col-xs-12 p-sm-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                                            <div id="amount_pay">&#8358;0.00</div>
                                        </div>

                                        <input type="hidden" name="txtamt" id="txtamt" value="0">
                                        <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                                        <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                        <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                        <input type="hidden" id="txtmemid" value="<?=$this->myID?>">

                                        
                                        <div class="col-md-12 pr-20 pl-20 pl-sm-0 pr-sm-0 mt-10">
                                            <label for="email_address">Select Payment Mode</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" id="pay_mthd1" name="pay_mthd1">
                                                    <option value="" selected>-Select One-</option>
                                                    <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                                    <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                                    <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="text-align: center; margin-top: 6px;">

                                            <button type="button" class="btn btn-primary btn-blocks1 waves-effect waves-light backtoads">BACK</button>

                                            <button type="button" class="btn btn-primary btn-blocks waves-effect waves-light cmd_upload_ads_pay">MAKE PAYMENTS</button>
                                        </div>

                                        <div style="clear: both;"></div>
                                        <div class="alert alert_msgs alert_msg1"></div>
                                        <br>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "view_adverts"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_advts" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Approved</th>
                                        <th>AD Sizes</th>
                                        <th>Duration</th>
                                        <th>Amount</th>
                                        <th class="none">Status</th>
                                        <th class="none">Duration</th>
                                        <th class="none">AD Position</th>
                                        <th class="none">Landing Page</th>
                                        <th class="none">Banner</th>
                                        <th>Date Uploaded</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "referral_records"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_refs" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Profession</th>
                                        <th>Date Upgraded</th>
                                        <th>Date Registered</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "votes_recs"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <p style="margin: -10px 0 15px 0; font-size: 16px; color: #777;">View your contest vote history</p>
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_myvotes" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest</th>
                                        <!-- <th>Contestant</th> -->
                                        <th>Votes</th>
                                        <!-- <th>VP</th> -->
                                        <!-- <th>Date Voted</th> -->
                                        <th>Contest End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "who_voted"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-5">
                    <p style="margin: -10px 0 15px 0; font-size: 16px; color: #777;">View who voted for you</p>
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_whovoted" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest</th>
                                        <th>Voter</th>
                                        <th>Voted</th>
                                        <!-- <th>VP</th> -->
                                        <th>Date Voted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="settings"){ ?>
            <div class="row clearfix">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="edit_pass" method="post" autocomplete="off">
                                
                                <input type="hidden" value="<?=$this->myID;?>" name="admin_type">

                                <label for="email_address">Old Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="txtpass1" class="form-control" placeholder="Enter your old password">
                                    </div>
                                </div>
                                <label for="password">New Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="txtpass2" class="form-control" placeholder="Enter your new password">
                                    </div>
                                </div>

                                <label for="password">Confirm Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="txtpass3" class="form-control" placeholder="Confirm your password">
                                    </div>
                                </div>

                                <div class="alert alert_msgs alert_msg1 alert_msg_center"></div>
                                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_update_pass">UPDATE PASSWORD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "support_ticket"){ ?>
            <div class="row clearfix">
            <div class="col-lg-12 p-0">
                <div class="col-lg-7 col-md-8 pl-xs-5 pr-xs-5">
                    <div class="card p-10 pt-5">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center msg_titles">Your Inbox</h3>
                                    <p class="msg_links">
                                        <span class="show_msg_type" labels="inbox">Inbox</span> 
                                        <span class="show_msg_type" labels="sent">Sent Messages</span>
                                    </p>
                                </div>
                                <hr>
                                <input type="hidden" value="<?=$this->myID;?>" id="txtmem">
                                <input type="hidden" value="inbox" id="txtmsg_type">

                                <div class="card-body all_tables inbox_div">
                                    <table id="" class="table table-striped table-bordered display responsive wrap all_tables1_ tickets" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date Sent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                 
                                        </tbody>
                                    </table>
                                </div>


                                <div class="card-body all_tables sent_div" style="display: none;">
                                    <table class="table table-striped table-bordered display responsive wrap all_tables1_ tickets_sent" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date Sent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                 
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> 
                </div>



                <div class="col-lg-5 col-md-4 col-sm-8 p-0 pl-sm-15 pr-sm-15 pl-xs-5 pr-xs-5">
                    <div class="card p-15 pt-5">
                        <div id="pay-invoice">
                            <div class="card-body enter_messages">
                                <div class="card-title">
                                    <h3 class="text-center">Create a Ticket</h3>
                                    <p style="font-size: 16px; text-align: center; color: #777">Enter any complaints here and we will get to you</p>
                                </div>
                                <hr>
                                <?php
                                    echo form_open('', array('autocomplete'=>'off', 'id'=>'send_support', 'class'=>'input-group'));
                                ?>
                                    <input type="hidden" value="<?=$this->myID;?>" name="txtmem" id="txtmem" class="txtmem">
                                    <input type="hidden" value="user" name="txtusr" id="txtusr">
                                    <input type="hidden" value="support" id="txtmessage_type" name="txtmessage_type">

                                    <div class="col-md-12 pl-0 pr-15 p-sm-0">
                                        <label for="email_address">Subject</label>
                                        <div class="form-line">
                                            <input id="txtsubj" name="txtsubj" type="text" class="form-control" placeholder="Enter the subject">
                                        </div>
                                    </div>

                                    <div class="col-md-12 pl-0 pr-15 p-sm-0">
                                        <label for="email_address">Message</label>
                                        <div class="form-line">
                                            <textarea id="txtmsg" class="common-textarea form-control" name="txtmsg" placeholder="Enter your message" style="height:15em !important;"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10" style="text-align: center;">
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right" id="cmd_send_support">SEND MESSAGE</button>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>

                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div> 
                </div>


                <div style="clear:both;"></div>
                <br><br>
            </div>
            </div>
        <?php } ?>



        <?php if($page_name == "announcement"){ ?>
            <div class="row clearfix">
            <div class="col-lg-12 p-0">
                <div class="col-lg-12 col-md-12 pl-xs-5 pr-xs-5">
                    <div class="card p-10 pt-5">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center msg_titles">Your Inbox</h3>
                                    <p class="msg_links">
                                        <span class="show_msg_type" labels="inbox">Inbox</span> 
                                        <span class="show_msg_type" labels="sent">Sent Messages</span>
                                    </p>
                                </div>
                                <hr>
                                <input type="hidden" value="<?=$this->myID;?>" id="txtmem">
                                <input type="hidden" value="inbox" id="txtmsg_type">
                                <input type="hidden" value="announcement" id="txtmessage_type" name="txtmessage_type">

                                <div class="card-body all_tables inbox_div">
                                    <table id="" class="table table-striped table-bordered display responsive wrap all_tables1_ all_tables2_ all_tables3 tbl_announce" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Subject</th>
                                            <th class="none">Message</th>
                                            <th>Date Sent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div style="clear:both;"></div>
                <br><br>
            </div>
            </div>
        <?php } ?>


    </div>
</section>
<br>


<!-- Jquery Core Js -->
<script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jscripts.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?=base_url()?>plugins/bootstrap/bootstrap.js"></script>
<script src="<?=base_url()?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=base_url()?>plugins/node-waves/waves.js"></script>
<script src="<?=base_url()?>plugins/sweetalert/sweetalert.min.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url()?>plugins/jquery-countto/jquery.countTo.js"></script>


<script src="<?=base_url()?>js_adm/admin.js"></script>
<script src="<?=base_url()?>js_adm/dialogs.js"></script>

<script src="<?=base_url()?>js_adm/pages/index.js"></script>

<script src="<?=base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/fnReloadAjax.js"></script>
<script src="<?=base_url();?>assets/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>


<script>
    var site_urls = $('#txtsite_url').val();
    var txt_pagename = $('#txtpage_name').val();
    var txtmem = $('#txtmem').val(); // sponsor id
    if(txtmem!="") txtmem = txtmem+"/";
    //alert(txt_pagename);

    <?php $url_tasks = $this->uri->segment(2); ?>
    var param1 = "<?=$url_tasks?>";

    if(isNaN(param1)===false)
        param1 = param1+"/";
    else
        param1 = "";

    //alert(txt_pagename);

    var urls = site_urls+"node/fetch_records/"+txt_pagename+"/"+param1;

    if(txt_pagename == "support_ticket"){
        var urls = site_urls+"node/fetch_tickets/"+txtmem+"inbox/";
        var urls1 = site_urls+"node/fetch_tickets/"+txtmem+"sent/";
    }

    if(txt_pagename == "announcement"){
        var urls = site_urls+"node/fetch_announce/"+txtmem+"/";
    }

    var dataTable = $('#tbl_contests, #tbl_leaderbd, #tbl_vleaderbd, #tbl_myvotes, #tbl_whovoted, #tbl_advts, #tbl_refs, #tbl_sponsored, #tbl_transac, #tbl_entries, #tbl_trans_his').DataTable({
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

    var dataTable1 = $('.tickets').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "order":[],
            "ajax":{
                url : urls,
                type: "post"
            },
            "columnDefs":[
            {
                "target":[0,3,4],
                "orderable": false
            }
            ]
    });

    var dataTable2 = $('.tickets_sent').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "order":[],
        "ajax":{
            url : urls1,
            type: "post"
        },
        "columnDefs":[
        {
            "target":[0,3,4],
            "orderable": false
        }
        ]
    });

    var dataTable3 = $('.tbl_announce').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "order":[],
            "ajax":{
                url : urls,
                type: "post"
            },
            "columnDefs":[
            {
                "target":[0,3,4],
                "orderable": false
            }
            ]
    });

</script>



</body>

</html>