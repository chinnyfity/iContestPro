

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

                <!-- <span class="cmd_forward_adm"></span> -->

                <button type="button" class="btn btn-default cmd_close_code1" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
            </div>
            <br><br>
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
                    <input type="hidden" id="txtmemid" value="0">
                    <input type="hidden" name="txtad_type" id="txtad_type" value="advert">

                    <div class="modal-body modal-body1">
                        <div class="col-md-12 pr-20 p-sm-0">
                            <label for="email_address">Duration (In days)</label>
                            <div class="form-line">
                                <select class="form-control" id="txtdurs" name="txtdurs">
                                    <option value="7 days">7 Days</option>
                                    <option value="15 days">15 Days</option>
                                    <option value="30 days">30 Days</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-20 pr-20 p-sm-0" style="display: none;">
                            <label for="email_address">Total Fee: &nbsp;</label>
                            <span class="total_fees1">&#8358;0.00</span>
                        </div>
                        <input name="txtamts1" id="txtamts1" type="hidden" value="0">
                    </div>
                    <div style="clear: both;"></div>

                    <div class="alert alert_msgs alert_msg1 alert_msg_center"></div>
                    <div class="modal-footer mt-10 m-sm--10">
                        <div class="form-group col-md-12 pr-20">
                            <button type="button" class="btn btn-success cmd_enter_boost_ cmd_boost_now" ><span class="fa fa-plus"></span>&nbsp;Boost AD</button>
                            <button type="button" class="btn btn-default cmd_close_bst" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;Close</button>
                        </div>
                    </div>
                </form>
            </div>
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



<section class="content ml-sm-0 mr-sm-0 mt-70 mt-sm-50">
    <div class="container-fluid all_texts js-sweetalert">

        <button class="btn btn-primary waves-effect btn_sweet_art" style="display: none;" data-type="success" data-msg="<?=$datamsg?>">CLICK ME</button>

        <button class="btn btn-primary waves-effect btn_sweet_art1" style="display: none;" data-type="success" data-msg="<?=$datamsg1?>">CLICK ME</button>

        <div class="block-header mt-sm-20 mb-sm-20">
            <h2><b><?=$header_names?></b></h2>
        </div>

        <?php if($page_name==""){ ?>

            <?php
            $entr_fee = $this->sql_models->sumColmn('entries_fee', 'fee', 'contest_id', "");
            $boosted_fee = $this->sql_models->sumColmn('bstd_vts', 'amts', 'contest_id', "");
            $adv_fee = $this->sql_models->sumColmn('adverts', 'amt', 'user_id', "");
            $contest_fee = $this->sql_models->sumColmn('contests', 'paids', 'user_id', "");
            $with_req = $this->sql_models->sumColmn('request_withdrawals', 'amt', 'memid', "");
            $with_req_outs = $this->sql_models->sumColmn1('request_withdrawals', 'amt');

            $mywallet = $entr_fee + $boosted_fee + $adv_fee + $contest_fee;


            $getConType = $this->sql_models->getContestType_arr(''); // 1 means 50k, 2 means 20k, 3 means free
            $paid_votes1=0;
            foreach ($getConType as $row) {
                $contest_type = $row['contest_type'];
                if($contest_type==1)
                    $paid_votes1 += $this->paid_votes;

                if($contest_type==2)
                    $paid_votes1 += $this->paid_votes2;

                if($contest_type==3)
                    $paid_votes1 += $this->paid_votes3;
            }


            $admin_percent = ($paid_votes1 / 100) / 3; // 110/100 = 1.1
            $admin_percent1 = round($admin_percent * $boosted_fee); // 1.1 * 200 = 220
            $admin_percent1 = $boosted_fee - $admin_percent1;


            $party_entr_fee = ($this->entry_fee/100) * $entr_fee; //100
            $party_entr_fee1 = $entr_fee - $party_entr_fee; //900
            ?>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <div class="info-box info-box2 bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">WALLET (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($mywallet)?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <div class="info-box info-box2 bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">ENTRY FEE (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($entr_fee)?></div>

                            <div class="text mt-0">Sponsor Comm</div>
                            <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($party_entr_fee1)?></b></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box info-box2 bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">BOOSTED (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($boosted_fee)?></div>

                            <div class="text mt-0">Sponsor Comm</div>
                            <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($admin_percent1)?></b></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <div class="info-box info-box2 bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">ADVERTS (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($adv_fee)?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">CONTEST FEE (&#8358;)</div>
                            <div class="number num_amt">&#8358;<?=@number_format($contest_fee)?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">WITHDRAWAL REQ</div>
                            <div class="number num_amt">&#8358;<?=@number_format($with_req)?></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">OUTSTANDING REQ</div>
                            <div class="number num_amt">&#8358;<?=@number_format($with_req_outs)?></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <div class="text">BALANCE</div>
                            <div class="number num_amt">&#8358;<?=@number_format($mywallet - $with_req_outs)?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="content">
                            <div class="text">MEMBERS</div>
                            <div class="number count-to" data-from="0" data-to="<?=$reg_mem_cnt?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <div class="content">
                            <div class="text">CONTESTS</div>
                            <div class="number count-to" data-from="0" data-to="<?=$contests_cnt?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-trophy"></i>
                        </div>
                        <div class="content">
                            <div class="text">ENTRIES</div>
                            <div class="number count-to" data-from="0" data-to="<?=$cur_contestants_cnt?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <a href="<?=base_url()?>shields/sponsored_contests/" style="cursor: pointer;">
                        <div class="info-box bg-light-green hover-expand-effect" style="cursor: pointer;">
                            <div class="icon">
                                <i class="fa fa-bell"></i>
                            </div>
                            <div class="content">
                                <div class="text">SPONSOREDS</div>
                                <div class="alrt_ads">
                                    <font class="number count-to" data-from="0" data-to="<?=$sponsoreds?>" data-speed="1000" data-fresh-interval="20"></font>
                                    <font class="alrt_ads1">(Needs Attention)</font>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="content">
                            <div class="text">SUPPORT</div>
                            <div class="number count-to" data-from="0" data-to="<?=$tickets?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-0 mb--15 mb--sm-10">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-bell"></i>
                        </div>
                        <div class="content">
                            <div class="text">ADVERTS</div>
                            <div class="number count-to" data-from="0" data-to="<?=$adv_cnt?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pl-10 pr-10 pr-xs-5 mb--15 mb--sm-10">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <div class="content">
                            <div class="text">VOTES</div>
                            <div class="number count-to" data-from="0" data-to="<?=$votes_cnt?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row clearfix mt-20 mt-sm-10">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pl-sm-10 pr-sm-10">
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
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pl-sm-10 pr-sm-10">
                    <div class="card">
                        <div class="body bg-ash1">
                            <div class="font-bold m-b--35 titles">VOTE LOGS</div>
                            <ul class="dashboard-stat-list stat-list1">
                                <?php
                                if($vote_logs){
                                    foreach($vote_logs as $row){
                                        $names1 = ucwords($row['names']);
                                        $voter = ucwords($row['names1']);
                                        $votes = $row['votes'];
                                        $date_created = time_ago($row['date_created']);
                                    ?>
                                        <li>
                                            <?=$voter?> voted <?=$votes?> votes for <?=$names1?>
                                            <span class="pull-right"><b><?=$date_created?></b></span>
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

            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header header1">
                            <h2>LAST 5 ADS</h2>
                        </div>
                        <div class="body" style="margin-top: -15px;">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Member</th>
                                            <th>Title</th>
                                            <th>Approved</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $conts=1;
                                        if($adverts){
                                            foreach($adverts as $post){
                                                $title = ucwords($post['title']);
                                                $names = ucwords($post['names']);
                                                $amt = @number_format($post['amt']);
                                                $approved = $post['approved'];
                                                
                                                if($approved == 1){
                                                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                                                }else{
                                                    $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                                                }
                                            ?>
                                            <tr>
                                                <td><?=$conts?></td>
                                                <td><?=$names?></td>
                                                <td><?=$title?></td>
                                                <td><?=$approved_1?></td>
                                                <td><?=$amt?></td>
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
                

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
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
                                            if($has_read<=0) $not_read = "class='boldme'";
                                            ?>
                                            <li <?=$not_read?>>
                                                <a href="<?=base_url()?>shields/support/">
                                                    <?=$titles1?>
                                                    <span class="pull-right"><b><?=$date_posted?></b></span>
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
                <!-- #END# Browser Usage -->
            </div>
        <?php } ?>



        <?php if($page_name=="profile"){ ?>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <!-- <div class="header">
                            <h2>UPDATE PROFILE</h2>
                        </div> -->
                        <div class="body">
                            <form class="input-group" id="frm_update_profile" autocomplete="off">

                                <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                    <input type="hidden" name="txtf0" id="txtf0" value="<?=$this->pics;?>">
                                    <ul class="list-inline">
                                        <li id="img_prev1_bma" class="list-inline-item profile_pics3 profile_pics3i">
                                            <span>remove</span>
                                            <img src="<?=$this->imgs1; ?>" src1="<?=$this->imgs1; ?>" id="im1_bma">
                                            <input id="ad_logo_check1_bma" value="0" style="display:none;" />
                                            
                                            <input type="file" name="txt_bma_pic" id="txt_bma_pic" style="padding:4px; font-size:16px; margin:8px 0 0px 0; border:1px solid #ccc; display:none" />
                                            <p style="color:#808000; text-align: center; font-size:17px; cursor:pointer; display:none; margin:10px 0 -15px 0;" id="hide_basic_uploader">Hide This</p>
                                            
                                        </li>
                                        <input name="txt_yes_file_bma" type="hidden" value="<?=$this->yes_file;?>">
                                    </ul>
                                    <p style="margin:6px 0 1em 0; font-size:17px; text-align: center;">
                                        <span style="color:#555; cursor:pointer;" class="basic_uploader">Or <span style="color:#06C">click here</span> to try the simple uploader</span>
                                    </p>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Full Names</label>
                                    <div class="form-line">
                                        <input type="text" name="txtfullname" class="form-control" placeholder="Enter your full names" value="<?=$this->myfullname?>">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Username</label>
                                    <div class="form-line">
                                        <input type="text" name="txtnick" class="form-control" placeholder="Enter your username" value="<?=$this->nickname?>">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Phone Number</label>
                                    <div class="form-line">
                                        <input type="number" name="txtphone" class="form-control" placeholder="Enter your phone number" value="<?=$this->myphone?>">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Email Address</label>
                                    <div class="form-line">
                                        <input type="email" name="txtemail" class="form-control" placeholder="Enter your email address" value="<?=$this->myemails?>">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Select State</label>
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

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Select City</label>
                                    <div class="form-line">
                                        <?php if($this->citys==""){ ?>
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

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Profession</label>
                                    <div class="form-line">
                                        <input type="text" name="txtprof" class="form-control" placeholder="Enter your username" value="<?=$this->profession?>">
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Biography 
                                        <span style="font-weight: normal; font-size: 14px; color: #777;">(Max: 500 characters)</span></label>
                                    <div class="form-line">
                                        <textarea rows="4" name="txtbio" class="form-control no-resize" placeholder="Please say a little about you"> <?=$this->bio?></textarea>
                                    </div>
                                </div>

                                
                                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right update_profile">UPDATE PROFILE</button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="sponsor"){ ?>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>BECOME A SPONSOR</h2> -->
                            <p style="color: #666; margin: 5px 0 0 0; font-size: 16px">This will enable you to upload a contest for users to participate</p>
                        </div>
                        <div class="body">
                                <div class="upgrade_form" style="display: nones;">
                                    <form class="input-group" id="frm_upgrade_sponsor" autocomplete="off">
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
                                            <span style="font-size: 14px; color: #888;">(Max of 2MB, Allowed: jpg, png)</span>
                                            <div class="form-line">
                                                <input id="former_file" name="former_file" value="<?//=$files?>" class="form-control" style="display:none;" />
                                                
                                                <input type="file" name="file1" id="file1" style="padding:4px; font-size:16px;" />
                                                <input name="txt_yes_file_bma" type="hidden" value="<?//=$yes_file1;?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12 pr-20 p-sm-0">
                                            <label for="email_address">Upload Your Utility Bill</label>
                                            <span style="font-size: 14px; color: #888;">(Max of 2MB, Allowed: jpg, png)</span>
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
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right upgrade_now">UPGRADE NOW</button>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </form>
                                </div>


                                <div class="upgrade_success_form" style="display: none;">
                                    <form class="input-group" id="frm_upgrade_sponsor1" autocomplete="off">
                                        <div class="col-md-12 col-sm-12 col-xs-12 wallet_info" style="text-align:center;">
                                            <div id="wallet_amt1">&#8358;5,000.00</div>
                                            <div>Sponsorship Upgrade Fee</div>
                                        </div>

                                        <input type="hidden" name="txtamt" id="txtamt" value="5000">
                                        <input type="hidden" name="txtwalletamt" id="txtwalletamt" value="<?=$this->wallets1?>">
                                        <input type="hidden" id="txtnames" value="<?=$this->myfullname?>">
                                        <input type="hidden" id="txtmymail" value="<?=$this->myemails?>">
                                        <input type="hidden" id="txtmemid" value="<?=$this->myID?>">

                                        
                                        <div class="col-md-12 pr-20 p-sm-0">
                                            <label for="email_address">Select Payment Mode</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" id="pay_mthd" name="pay_mthd">
                                                    <option value="" selected>-Select One-</option>
                                                    <option value="online">Online Payment</option>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>




        <?php if($page_name == "members"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_members" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Wallet</th>
                                        <th>VP</th>
                                        <th class="none">Profession</th>
                                        <th class="none">Biography</th>
                                        <th class="none">Photo</th>
                                        <th class="name">Location</th>
                                        <th class="none">Views</th>
                                        <th class="none">Files Uploaded</th>
                                        <th>Paid</th>
                                        <th class="none">Transaction Ref</th>
                                        <th class="none">Date Upgraded</th>
                                        <th>Date Registered</th>
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
                                        <!-- <th>Sender</th> -->
                                        <th>Recipient</th>
                                        <th>Amount</th>
                                        <th class="none">Reason</th>
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



        <?php if($page_name == "entries"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card_ p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive_ _project-table">
                                <?php
                                if(is_numeric($url_id)){
                                    $getContestName = $this->sql_models->getContestName($url_id);
                                    echo "<p style='text-align: center; font-size: 21px; color: #06C; line-height: 24px;' class='mt-0 mt-sm-20 mt-xs--20'>Contest: <b>$getContestName</b></p>";
                                }

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
                                $admin_percent1 = $admin_percent * $boosted_fee; // 0.2*1000=200
                                $mypercent = $boosted_fee - $admin_percent1; // 1000-200=800

                                $total_vts = $this->sql_models->sumColmn('entries', 'votes', 'contest_id', $url_id);

                                $bsts_vts = $this->sql_models->sumColmn('bstd_vts', 'votes', 'contest_id', $url_id);

                                $total_entrs = $this->sql_models->calCounts1('entries', 'contestant_id', 'members', $url_id);
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

                                                <div class="text mt-0">Sponsor Comm</div>
                                                <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($party_entr_fee1)?></b></div>
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

                                                <div class="text mt-0">Sponsor Comm</div>
                                                <div class="text mt-0" style="font-size: 16px;"><b>&#8358;<?=@number_format($mypercent)?></b></div>
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


                                <table id="tbl_entries" class="card table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
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
                                        <!-- <th>Total Views</th> -->
                                        <th>Entry Date</th>
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



        <?php
        //if($page_name=="upload_contest" || $page_name == "edit_contest"){
        if($page_name == "edit_contest"){
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
                $files = ""; $company_logo = ""; $price1 = ""; $price2 = ""; $price3 = ""; $price4 = ""; 
                $price5 = "";
                $add_price1 = ""; $add_price2 = ""; $add_price3 = ""; $add_price4 = ""; $add_price5 = "";
                $premium = ""; $sponsoredby=""; $close_date_entry = ""; $start_date_contest = "";
                $entry_type = ""; $entry_fee = ""; $start_date = ""; $timings = ""; $start_date = "";
                $timings = ""; $captions1 = 'UPLOAD CONTEST'; $captions2 = 'ADD A CONTEST';
            }
            $yes_file1=0; $yes_logo=0;

            if($files!="") $yes_file1=1;
            if($company_logo!="") $yes_logo=1;
        ?>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="header">
                            <!-- <h2><?=$captions2?></h2> -->
                            <p style="color: #FF5151; margin: 5px 0 0 0; font-size: 14px">All fields below with (*) are compulsory except for the ones labelled "optional"</p>
                        </div>
                        <div class="body">
                            <form class="input-group" id="frm_contest" autocomplete="off">
                                <input type="hidden" name="txtc_id" id="txtc_id" value="<?=$id1?>">
                                <input type="hidden" name="txt_immediate_id" id="txt_immediate_id" value="<?=$id1?>">

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
                                            <option value="" selected>-Select-</option>
                                            <option value="pic" <?php if($media_type=="pic") echo "selected"; ?>>Photo Contest</option>
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
                                        <input id="former_file" name="former_file" value="<?=$files?>" class="form-control" style="display:none;" />
                                        
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
                                $chks="";
                                $getMemDetls = $this->sql_models->getDetails($user_id);
                                if($getMemDetls['phone_visible']==1)
                                    $chks="checked";
                                ?>

                                <div class="col-md-12 mt-20 mb-10" style="text-align: center;">
                                    <input type="checkbox" <?=$chks?> id="checkme" name="checkme" value="1" class="filled-in">
                                    <label for="checkme" style="font-size: 16px; color: #555">Make your number visible so that your contestants can easily reach you.</label>
                                </div>

                                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_contest"><?=$captions1?></button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "view_contests"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
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
                                        <th class="none">Media Type</th>
                                        <th class="none">&nbsp;</th>
                                        <th class="none">Views</th>
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


        <?php if($page_name == "referral_network"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
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



        <?php if($page_name == "member_wallets"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_wallets" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>Name</th>
                                        <th class="none">Email</th>
                                        <th class="none">Payment Method</th>
                                        <th>Approved</th>
                                        <th>Amount</th>
                                        <th>Date Paid</th>
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



        <?php if($page_name == "withdrawal_request"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_withdraw" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Amount</th>
                                        <th>Approved</th>
                                        <th>Account No</th>
                                        <th>Bank Name</th>
                                        <th>Acct. Name</th>
                                        <th>Date Requested</th>
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


        <?php if($page_name == "transaction_reports"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_transac" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Account No</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Date Requested</th>
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
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_sponsored" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
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




        <?php if($page_name=="adverts" || $page_name == "edit_advert"){
            if($getId!=""){
                $id1 = $getId['id'];
                $overall_title = ucwords($getId['title']);
                $files = $getId['files'];
                $sizes = $getId['sizes'];
                //$positns = $getId['positns'];
                //$duration = $getId['duration'];
                $displaynone = "style='display:none'";
                $urls = $getId['urls'];
                $urls1 = $getId['urls1'];
                $captions1 = 'EDIT YOUR AD';
                $captions2 = 'EDIT YOUR AD';

            }else{
                $overall_title = ""; $files = ""; $urls = ""; $disabled = "";
                $id1=""; $displaynone="";$sizes = "";$urls1="";
                $captions1 = 'SUBMIT YOUR AD'; $captions2 = 'SUBMIT YOUR AD';
            }
            $yes_file1=0;
            if($files!="") $yes_file1=1;

            $advSettings = $this->sql_models->advSettings('advert_settings');
            //include('adv_settings.php');
            ?>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="header pl-xs-10 pr-xs-10">
                            <!-- <h2><?=$captions2?></h2> -->
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

                                <input type="hidden" name="txtad_id" id="txtad_id" value="<?=$id1?>">
                                <input type="hidden" name="txtmemid" id="txtmemid" value="0">

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Advert Title</label>
                                    <div class="form-line">
                                        <input type="text" name="txttitle" class="form-control" placeholder="Enter advert title" value="<?=$overall_title?>" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Upload Advert</label>
                                    <span style="font-size: 14px; color: #888;">(Max of 3MB, Allowed: jpg, jpeg)</span>
                                    <div class="form-line">
                                        <input id="former_file" name="former_file" value="<?=$files?>" class="form-control" style="display:none;" />
                                        
                                        <input type="file" name="file_banner" id="file_banner" style="padding:4px; font-size:16px;" accept=".jpg, .jpeg" />
                                        <input name="txt_yes_file_bma" type="hidden" value="<?=$yes_file1;?>">
                                    </div>

                                    <?php
                                    if($getId!=""){
                                        echo "<div class='update_imgs1'>";
                                        if($files!='')
                                            echo "<img src='".base_url()."adverts/$files' id='im11'>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-sm-6 pr-20 pl-sm-0 pr-sm-10 p-xs-0">
                                    <label for="email_address">Advert Banner (Size) </label>
                                    <div class="form-line">
                                        <select class="form-control calcs" id="txtsize" name="txtsize">
                                            <option value="nones" selected>-Select-</option>
                                            <option value="250x250" <?php if($sizes=="250x250") echo "selected"; ?>>250x250</option>

                                            <option value="780x90" <?php if($sizes=="780x90") echo "selected"; ?>>780x90</option>

                                            <option value="300x600" <?php if($sizes=="300x600") echo "selected"; ?>>300x600</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 pr-20 pl-sm-10 pr-sm-0 p-xs-0" style="display: none;">
                                    <label for="email_address">Target Position</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="txtpositn" name="txtpositn">
                                            <option value="" selected>-Select-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 pr-20 pl-sm-0 pr-sm-10 p-xs-0">
                                    <label for="email_address">Duration (In days)</label>
                                    <div class="form-line">
                                        <select class="form-control calcs" id="txtdurs1" name="txtdurs1">
                                            <option value="7 days">7 Days</option>

                                            <option value="15 days">15 Days</option>

                                            <option value="30 days">30 Days</option>

                                            <option value="180 days">180 Days</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">URL/Email</label>
                                    <div class="form-line">
                                        <input type="text" name="txtlink" class="form-control" placeholder="Enter your link or email or phone" value="<?=$urls1?>">
                                    </div>
                                </div>


                                <div class="col-md-6 pr-20 p-sm-0 p-xs-0" style="display: none;">
                                    <label for="email_address">Total Fee: &nbsp;</label>
                                    <span class="total_fees">&#8358;0.00</span>
                                </div>
                                <input name="txtamts" id="txtamts" type="hidden" value="">

                                
                                <div class="col-sm-offset-3 col-sm-6 mt-10" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_ads"><?=$captions1?></button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "view_adverts"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_advts" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
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



        <?php if($page_name=="upload_blog" || $page_name == "edit_blog"){
            if($getId!=""){
                $id1 = $getId['id'];
                $overall_title = ucwords($getId['titles']);
                //$files = $this->sql_models->getBlogMedias($id1);;
                $contents = $getId['contents'];
                $captions1 = 'EDIT ARTICLE';
                $captions2 = $captions1;

                $files = $this->sql_models->fetchBlogFile('blogs_images', $id1);
                $pic_pathi = base_url()."cblogs/$files";
                $width1="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                if($width1=="" || $width1<=0){
                    $pic_pathi = base_url()."images/no_picture.jpg";
                }

            }else{
                $overall_title = ""; $files = ""; $contents="";
                $id1=""; $captions1 = 'SUBMIT ARTICLE'; $captions2 = 'SUBMIT ARTICLE';
            }
            $yes_file1=0;
            if($files!="") $yes_file1=1;

            ?>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body pl-xs-10 pr-xs-10 pt-30">
                            <form class="input-group" id="frm_blog" autocomplete="off">
                                <input type="hidden" name="txtbg_id" id="txtbg_id" value="<?=$id1?>">

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Blog Title</label>
                                    <div class="form-line">
                                        <input type="text" name="txttitle" class="form-control" placeholder="Enter blog title" value="<?=$overall_title?>" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Upload Advert</label>
                                    <span style="font-size: 14px; color: #888;">(Max of 3MB, Allowed: jpg, jpeg)</span>
                                    <div class="form-line">
                                        <input id="former_file" name="former_file" value="<?=$files?>" class="form-control" style="display:none;" />
                                        
                                        <input type="file" name="file_banner" id="file_banner" style="padding:4px; font-size:16px;" accept=".jpg, .jpeg" />
                                        <input name="txt_yes_file_bma" type="hidden" value="<?=$yes_file1;?>">
                                    </div>

                                    <?php
                                    if($getId!=""){
                                        echo "<div class='update_imgs1'>";
                                        if($files!='')
                                            echo "<img src='$pic_pathi' id='im11'>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Contents</label>
                                    <div class="form-line">
                                        <textarea id="txtmsg" class="common-textarea form-control" name="txtmsg" placeholder="Enter blog content" style="height:15em !important;"><?=$contents?></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-offset-3 col-sm-6 mt-10" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_blg"><?=$captions1?></button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="admin_wallet"){

            ?>
            <div class="row clearfix">
                <div class="col-md-8 col-sm-8 col-xs-12 pl-5 pr-5">
                    <div class="card">
                        <div class="body">
                            <form class="input-group" id="frm_transfer">
                                <div class="first_form_tra" style="display: nones;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 wallet_info p-sm-0" style="text-align:center;">
                                        <div id="wallet_amt1" class="wallet_amt1">&#8358;<?=@number_format($this->admin_wallet)?></div>
                                        <div>Admin Wallet Balance</div>

                                        <div style="text-align: center; margin: 5px 0 0 0; font-size: 17px; color: #093">Enter the amount you want to transfer and select the recipient</div>
                                    </div>

                                    <input type="hidden" name="txtmywallet1" id="txtmywallet1" value="<?=$this->admin_wallet?>">
                                    
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

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Reason for this Transacction</label>
                                        <div class="form-line">
                                            <textarea id="txtreason" class="form-control" name="txtreason" placeholder="Enter a reason" style="height:10em !important;"></textarea>
                                        </div>
                                    </div>

                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1 mb-0"></div>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 mt-15" style="text-align: center;">
                                        <button type="button" class="btn btn-primary waves-effect waves-light pull-right cmd_proceed_tran_admin">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></button>
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
                                                    <p><b>Reason:</b></p>
                                                </div>

                                                <div class="col-md-8 col-xs-8">
                                                    <p><b class="rec_name"></b></p>
                                                    <p><b class="rec_email"></b></p>
                                                    <p><b class="rec_amt"></b></p>
                                                    <p><b class="rec_reason" style="line-height: 15px !important;"></b></p>
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
                                                <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_do_transfer_admin">TRANSFER</button>
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



        <?php if($page_name == "view_blog"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_blog" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Views</th>
                                        <th class="none">Image</th>
                                        <th class="none">Contents</th>
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




        <?php if($page_name=="upload_rewards____" || $page_name == "edit_reward____"){
            if($getId!=""){
                $id1 = $getId['id'];
                $titles = ucwords($getId['titles']);
                $file1 = $getId['file1'];
                $file2 = $getId['file2'];
                $file3 = $getId['file3'];
                $num1 = $getId['num1'];
                $num2 = $getId['num2'];
                $num3 = $getId['num3'];
                $rand_nums1 = $getId['rand_nums1'];
                $rand_nums2 = $getId['rand_nums2'];
                $rand_nums3 = $getId['rand_nums3'];
                $captions1 = 'EDIT REWARDS';
                $captions2 = 'EDIT REWARDS';
                $disableds = "disabled style='opacity:0.4'";

            }else{
                $titles = ""; $file1 = ""; $file2 = ""; $file3 = "";
                $id1=""; $rand_nums1="";$rand_nums2 = "";$rand_nums3="";
                $num1=""; $num2=""; $num3=""; $disableds="";
                $captions1 = 'ENTER REWARDS'; $captions2 = 'ENTER REWARDS';
            }
            $yes_file1=0;$yes_file2=0;$yes_file3=0;

            if($file1!="") $yes_file1=1;
            if($file2!="") $yes_file2=1;
            if($file3!="") $yes_file3=1;

            ?>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="header">
                            <!-- <h2><?=$captions2?></h2> -->
                            <p style="color: #FF5151; margin: 5px 0 0 0; font-size: 14px">All fields below with (*) are compulsory except for the ones labelled "optional"</p>
                        </div>


                        <div class="body">
                            <form class="input-group" id="frm_rewards" autocomplete="off">

                                <input type="hidden" name="txtrw_id" id="txtrw_id" value="<?=$id1?>">
                                <input type="hidden" name="txtmemid" id="txtmemid" value="0">

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Reward Title</label>
                                    <div class="form-line">
                                        <input type="text" name="txttitle" class="form-control" placeholder="Enter reward title" value="<?=$titles?>" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0" style="overflow: hidden;">
                                    <label for="email_address">Upload Gift 1</label>
                                    <span style="font-size: 14px; color: #888;">(Max of 1MB, Allowed: jpg, png)</span>
                                    <div class="form-line">
                                        <input id="former_file1" name="former_file1" value="<?=$file1?>" class="form-control" style="display:none;" />
                                        
                                        <input type="file" name="file_banner1" id="file_banner1" style="padding:4px; font-size:16px;" />
                                        <input name="txt_yes_file1" type="hidden" value="<?=$yes_file1;?>">
                                    </div>

                                    <?php
                                    if($getId!=""){
                                        echo "<div class='update_imgs1'>";
                                        if($file1!='')
                                            echo "<img src='".base_url()."lottery_prizes/$file1' id='im11'>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Enter Lucky Number</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum1" class="form-control" placeholder="Enter lucky number 1-80" <?=$disableds?> value="<?=$num1?>">
                                    </div>
                                    <p style="color: #888">Enter raffle lucky number from 1 to 80 for Gift 1</p>
                                    <?php
                                    if($getId!="")
                                        echo '<p style="color: #FF2F2F;margin-top: -10px;">Once entered, cannot be edited</p>';
                                    ?>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-6 pr-20 p-sm-0" style="overflow: hidden;">
                                    <label for="email_address">Upload Gift 2</label>
                                    <span style="font-size: 14px; color: #888;">(Max of 1MB, Allowed: jpg, png)</span>
                                    <div class="form-line">
                                        <input id="former_file2" name="former_file2" value="<?=$file2?>" class="form-control" style="display:none;" />
                                        
                                        <input type="file" name="file_banner2" id="file_banner2" style="padding:4px; font-size:16px;" />
                                        <input name="txt_yes_file2" type="hidden" value="<?=$yes_file2;?>">
                                    </div>

                                    <?php
                                    if($getId!=""){
                                        echo "<div class='update_imgs1'>";
                                        if($file2!='')
                                            echo "<img src='".base_url()."lottery_prizes/$file2' id='im11'>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Enter Lucky Number</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum2" class="form-control" placeholder="Enter lucky number 1-80" <?=$disableds?> value="<?=$num2?>">
                                    </div>
                                    <p style="color: #888">Enter raffle lucky number from 1 to 80 for Gift 2</p>
                                    <?php
                                    if($getId!="")
                                        echo '<p style="color: #FF2F2F;margin-top: -10px;">Once entered, cannot be edited</p>';
                                    ?>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-6 pr-20 p-sm-0" style="overflow: hidden;">
                                    <label for="email_address">Upload Gift 3</label>
                                    <span style="font-size: 14px; color: #888;">(Max of 1MB, Allowed: jpg, png)</span>
                                    <div class="form-line">
                                        <input id="former_file3" name="former_file3" value="<?=$file3?>" class="form-control" style="display:none;" />
                                        
                                        <input type="file" name="file_banner3" id="file_banner3" style="padding:4px; font-size:16px;" />
                                        <input name="txt_yes_file3" type="hidden" value="<?=$yes_file3;?>">
                                    </div>

                                    <?php
                                    if($getId!=""){
                                        echo "<div class='update_imgs1'>";
                                        if($file3!='')
                                            echo "<img src='".base_url()."lottery_prizes/$file3' id='im11'>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Enter Lucky Number</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum3" class="form-control" placeholder="Enter lucky number 1-80" <?=$disableds?> value="<?=$num3?>">
                                    </div>
                                    <p style="color: #888">Enter raffle lucky number from 1 to 80 for Gift 3</p>
                                    <?php
                                    if($getId!="")
                                        echo '<p style="color: #FF2F2F;margin-top: -10px;">Once entered, cannot be edited</p>';
                                    ?>
                                </div>
                                <div style="clear: both;"></div>
                                
                                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_rewards"><?=$captions1?></button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name=="upload_rewards" || $page_name == "edit_quiz"){
            if($getId!=""){
                $id1 = $getId['id'];
                $titles = ucwords($getId['quiz_title']);
                $num1 = $getId['prize1'];
                $num2 = $getId['prize2'];
                $num3 = $getId['prize3'];
                $num4 = $getId['prize4'];
                $num5 = $getId['prize5'];
                $captions1 = 'EDIT QUIZ';

            }else{
                $titles = ""; $id1="";
                $num1=""; $num2=""; $num3=""; $num4=""; $num5="";
                $captions1 = 'ENTER QUIZ';
            }

            ?>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="header">
                            <!-- <h2><?=$captions2?></h2> -->
                            <p style="color: #FF5151; margin: 5px 0 0 0; font-size: 14px">All fields below with (*) are compulsory except for the ones labelled "optional"</p>
                        </div>


                        <div class="body">
                            <form class="input-group" id="frm_rewards_qz" autocomplete="off">

                                <input type="hidden" name="txtrw_id" id="txtrw_id" value="<?=$id1?>">

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Reward Title</label>
                                    <div class="form-line">
                                        <input type="text" name="txttitle" class="form-control" placeholder="Enter reward title" value="<?=$titles?>" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Subjects</label>
                                    <div class="form-line">
                                        <input type="text" name="txtsubj" class="form-control" placeholder="Enter subject name(s)" value="General Question" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Seconds Per Question</label>
                                    <div class="form-line">
                                        <input type="number" name="txtsecs" class="form-control" placeholder="Enter time" value="15">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Quiz Duration</label>
                                    <div class="form-line">
                                        <select class="form-control" id="txtdurs" name="txtdurs">
                                            <option value="7 days">7 Days</option>
                                            <option value="14 days">14 Days</option>
                                            <option value="25 days">25 Days</option>
                                            <option value="30 days">30 Days</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 pr-20 p-sm-0">
                                    <label for="email_address">Sponsored By</label>
                                    <div class="form-line">
                                        <input type="text" name="txtsponName" class="form-control" placeholder="Enter sponsor brand" value="iContestPRO" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Enter First Prize</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum1" class="form-control" placeholder="Enter first prize" value="<?=$num1?>">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-20 p-sm-0">
                                    <label for="email_address">Enter Second Prize</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum2" class="form-control" placeholder="Enter second prize" value="<?=$num2?>">
                                    </div>
                                </div>

                                <div class="col-md-4 pr-20 p-sm-0">
                                    <label for="email_address">Enter 3rd Prize (Optional)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum3" class="form-control" placeholder="Enter third prize" value="<?=$num3?>">
                                    </div>
                                </div>

                                <div class="col-md-4 pr-20 p-sm-0">
                                    <label for="email_address">Enter 4th Prize (Optional)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum4" class="form-control" placeholder="Enter fourth prize" value="<?=$num4?>">
                                    </div>
                                </div>

                                <div class="col-md-4 pr-20 p-sm-0">
                                    <label for="email_address">Enter 5th Prize (Optional)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtnum5" class="form-control" placeholder="Enter fifth prize" value="<?=$num5?>">
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-offset-3 col-md-6 mt-20" style="text-align: center;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_rewards_qz"><?=$captions1?></button>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



        <?php if($page_name == "upload_questions" || $page_name == "edit_questions"){ 
            //$url_task1 = $this->uri->segment(3);
            if($url_id!=""){
                $id1 = $getQuizes['id'];
                $questions=ucfirst($getQuizes['questions']);
                $files=$getQuizes['files'];
                $op1=ucwords($getQuizes['op1']);
                $op2=ucwords($getQuizes['op2']);
                $op3=ucwords($getQuizes['op3']);
                $op4=ucwords($getQuizes['op4']);
                $ans1=ucwords($getQuizes['ans1']);
                $explanations=$getQuizes['explanations'];
                $captions1 = " Update Question ";
                $captions2 = "Update Question &raquo;";
                echo "<input type='hidden' value='$url_id' name='quiz_ids'>";
        
            }else{
                $questions="";
                $files="";
                $op1="";
                $op2="";
                $op3="";
                $op4="";
                $ans1="";
                $explanations="";
                $qi_id="";
                $Submits1 = " Add Question &raquo; ";
                $captions1 = "Add Question &raquo;";
                $captions2 = "Upload Question &raquo;";
                $id1 = "";
                $id3 = "";
                echo "<input type='hidden' value='' name='quiz_ids'>";
            }
            ?>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="header p-10">
                            <!-- <p class="inner_links"><a href="<?=base_url();?>admin/view_test/">Click To View Test</a></p> -->
                            <h3 class="text-center"><b>Add Questions</b></h3>
                        </div>


                        <div class="body pt-10">
                            <form class="input-group" id="create_quiz_form1" enctype="multipart/form-data" autocomplete="off">
                                
                                <input type="hidden" id="quizSecID" name="quizSecID" value="<?=$getId;?>" />
                                <input type="hidden" id="txt_upload_type1" name="txt_upload_type1" value="type">
                                <input type="hidden" id="txtquizid" name="txtquizid" value="<?=$id1;?>" />

                                <div class="write_quest_div" style="display:nones">
                                    <p style="color: #093; margin-bottom: 20px; text-align: center;">
                                        <span class="upload_questions" style="font-weight: bold; cursor: pointer; font-size: 19px;">
                                            Upload Questions From Excel Instead
                                        </span>
                                    </p>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Type Question</label>
                                        <div class="form-line">
                                            <textarea id="txtquestions" class="form-control" name="txtquestions" placeholder="Enter Quiz Question" style="height:10em !important;"><?=$questions;?></textarea>
                                        </div>

                                        <p style="font-size:15px; margin-top:14px;"><b>Upload Picture (Optional)</b></p>
                                        <p style="font-size:14px !important; margin-top:-5px; color:#993">Picture size <b style="font-size:14px;">2MB</b> of jpg, jpeg and png only!</p>

                                        <?php
                                        if($url_id!=""){
                                            echo "<font class='update_imgs'>";
                                            if($files!=''){
                                                echo "<img src='".base_url()."quizes/$files' src1='".base_url()."img/no_picture.jpg' id='im10'>";
                                            }
                                            echo "</font>";
                                        }
                                        ?>

                                        <input id="former_file" name="former_file" value="<?php echo $files; ?>" class="form-control" style="display:none;" />
                                        <input type="file" name="file_quiz" id="file_quiz" style="padding:4px; font-size:15px; display:nones" class="form-control" />

                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Option A</label>
                                        <div class="form-line">
                                            <input type="text" name="txtop1" id="txtop1" value="<?php echo $op1; ?>" placeholder="Write Option A" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Option B</label>
                                        <div class="form-line">
                                            <input type="text" name="txtop2" id="txtop2" value="<?php echo $op2; ?>" placeholder="Write Option B" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Option C</label>
                                        <div class="form-line">
                                            <input type="text" name="txtop3" id="txtop3" value="<?php echo $op3; ?>" placeholder="Write Option C" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 pr-20 p-sm-0">
                                        <label for="email_address">Option D</label>
                                        <div class="form-line">
                                            <input type="text" name="txtop4" id="txtop4" value="<?php echo $op4; ?>" placeholder="Write Option D" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Specify the answer</label>
                                        <div class="form-line">
                                            <select name="txtans" id="txtans" class="form-control">
                                                <option value="" selected>-Select-</option>
                                                <option value="A" <?php if($ans1==$op1 && $op1!="") echo "selected"; ?> >A</option>
                                                <option value="B" <?php if($ans1==$op2 && $op2!="") echo "selected"; ?>>B</option>
                                                <option value="C" <?php if($ans1==$op3 && $op3!="") echo "selected"; ?>>C</option>
                                                <option value="D" <?php if($ans1==$op4 && $op4!="") echo "selected"; ?>>D</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 pr-20 p-sm-0">
                                        <label for="email_address">Explanation <span style="color:#888; font-size:14px; font-weight:normal">(Optional)</span></label>
                                        <div class="form-line">
                                            <textarea placeholder="Type the answer explanation" name="txtexplain" class="form-control" style="height: 100px !important;" id="txtexplain"><?=$explanations;?></textarea>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-offset-3 col-md-6 mt-20" style="text-align: center;">
                                        <!-- <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_upload_rewards_qz"><?=$captions1?></button> -->

                                        <input type="submit" value="<?=$captions1;?>" id="cmd_submit_quiz" class="btn btn-primary m-t-15 waves-effect waves-light pull-right">

                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1" style="margin-bottom: 0px;"></div>
                                </div>


                                <div class="uploadQuests" style="display:none">
                                    <p style="font-size: 15px; color: #093; margin-bottom: 20px; text-align: center;">
                                        <span class="type_questions" style="font-size: 19px; font-weight: bold; cursor: pointer;">Type Questions Instead</span>
                                    </p>

                                    <div style="font-size: 15px; margin-bottom: 15px; line-height: 24px; overflow: hidden; color: red; overflow-x: scroll;">
                                        <b style="font-size: 17px; ">Important Notice</b>:<br>
                                        Excel format uploads must be in this format:<br>
                                        <img src="<?=base_url()?>images/excel_format1.png" class="img-responsive">
                                    </div>
                                    
                                    <p style="font-size: 15px;"><b>Upload excel file:</b></p>
                                    <input type="file" name="uploadFile" id="uploadFile" value="" style="font-size: 17px;" />
                                    <p style="font-size:14px !important; margin:8px 0 26px 0; color:#993">Picture size <b style="font-size:14px;">6MB</b> of xls, xlsx only!</p>

                                    <div style="clear:both"></div>
                                    <div class="alert alert_msgs_ alert_msg1" style="margin-bottom: 0px;"></div>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
                                        <div style="text-align:center; margin-top:1em;" id="buttons1">
                                            <input type="submit" value="<?=$captions2;?>" actid="<?=$id1;?>" id="" class="btn btn-lg btn-info btn-block cmd_submit_quiz">

                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php } ?>



        <?php if($page_name == "view_quiz"){ ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_rwds" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Approved</th>
                                        <th>Duration</th>
                                        <th>Completed</th>
                                        <th class="none">Prizes</th>
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




        <?php 
            if($page_name == "viewquestions"){
                $url_task1 = $this->uri->segment(3);
                $getSchTitle = $this->sql_models->getQuizDetails($url_task1);
                $schtitle="";
            ?>
                <div class="row clearfix">
                    <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                        <div class="card p-sm-0">
                            <div class="body p-sm-0">
                                <div class="table-responsive project-table">
                                    <p style="text-align: center; font-size: 16px;">
                                        Viewing questions for <b style="font-size: 18px"><?=$getSchTitle;?></b>
                                    </p>
                                    <!-- <p style="text-align:center; font-size:16px;" class="add_questns"><span sess="<?=$url_task1;?>">Add Another Question</span></p> -->
                                    <table id="myquestions" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Action</th>
                                            <th>Questions</th>
                                            <th class="none">Image</th>
                                            <th>Option1</th>
                                            <th>Option2</th>
                                            <th>Option3</th>
                                            <th>Option4</th>
                                            <th>Answer</th>
                                            <th class="none">Explanation</th>
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




        <?php if($page_name == "votes"){ ?>
            <div class="row clearfix">
                <div class="col-md-10 p-sm-10">
                    <div class="card p-sm-0">
                        <!-- <div class="header">
                            <h2>Your Votes</h2>
                        </div> -->
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_myvotes" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <!-- <th>Contest</th> -->
                                        <th>Contestant</th>
                                        <th>Votes</th>
                                        <th>VP</th>
                                        <!-- <th>Last Date Voted</th> -->
                                        <!-- <th>Date Voted</th> -->
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


        <?php if($page_name == "vote_history"){
            $url_id = $this->uri->segment(3);
            $uid = substr($url_id, 0, -5);
            $voters = $this->sql_models->getVoter($uid);
        ?>
            <div class="row clearfix">
                <div class="col-md-12 p-sm-10 pl-xs-5 pr-xs-5">
                    <div class="card p-sm-0">
                        <p style="padding: 15px 20px; font-size: 20px; margin-bottom: -20px; color: #069"><?=$voters?> Vote History</p>
                        <div class="body p-sm-0">
                            <div class="table-responsive project-table">
                                <table id="tbl_vote_history" class="table table-striped_ table-bordered display responsive wrap all_tables2" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest</th>
                                        <th>Contestant</th>
                                        <th>Votes</th>
                                        <th>VP</th>
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
                <div class="col-sm-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <p class="mb-20 font-20" style="color: #888">Enable/Disable Flutterwave Payment</p>
                            <div class="php_info">
                                <?php
                                if($this->flutterwave==0){
                                    echo "<p style='font-size: 20px; color:#0C6'>Flutterwave is Enabled</p>";
                                    $caps1 = "DISABLE";
                                }else{
                                    echo "<p style='font-size: 20px; color:red'>Flutterwave is Disabled</p>";
                                    $caps1 = "ENABLE";
                                }
                                ?>
                            </div>
                            <div class="java_info"></div>

                            <form class="input-group" id="edit_pass" method="post" autocomplete="off">
                                <div class="alert alert_msgs alert_msg1 alert_msg_center"></div>
                                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_update_flutter">CLICK TO <?=$caps1?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-6 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <p class="mb-20 font-20" style="color: #888">Change Your Password</p>
                            <form class="input-group" id="edit_pass" method="post" autocomplete="off">
                                
                                <input type="hidden" value="00" name="admin_type">

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
                                <div class="col-md-offset-1 col-md-10" style="text-align: center;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_update_pass">UPDATE PASSWORD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-7 col-md-7 col-sm-6 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <p class="mb-20 font-20" style="color: #888">Update These Settings</p>
                            <form class="input-group" id="edit_settings1" method="post" autocomplete="off">
                                
                                <input type="hidden" value="00" name="admin_type">

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Withdrawal Fee Charges (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtwfc" class="form-control" placeholder="Enter Withdrawal Charges" value="<?=$this->withdraw_fee?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Trasfer Fee Charges (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txttfc" class="form-control" placeholder="Enter Withdrawal Charges" value="<?=$this->transfer_fee?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Sponsor Fee (&#8358;)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtsfc" class="form-control" placeholder="Enter Sponsor Fee" value="<?=$this->be_a_sponsor?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Referral Charges (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtrc" class="form-control" placeholder="Enter Referral Charges" value="<?=$this->give_referral?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Agent Cash Back (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtcb" class="form-control" placeholder="Enter Agent Cash Back" value="<?=$this->cash_back?>">
                                    </div>
                                </div>

                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg2"></div>
                                <div class="col-md-offset-2 col-md-8" style="text-align: center;">
                                    <button type="button" class="btn btn-primary waves-effect waves-light pull-right cmd_update_settings1">UPDATE SETTINGS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-lg-7 col-md-7 col-sm-6 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <p class="mb-20 font-20" style="color: #888">Update Contest Settings</p>
                            <form class="input-group" id="edit_con_settings" method="post" autocomplete="off">
                                
                                <input type="hidden" value="00" name="admin_type">

                                <div class="form-group_ mb-20 col-md-12 pl-xs-0 pr-xs-0">
                                    <label for="email_address">Entry Fee Charges (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtentfee" class="form-control" placeholder="Enter the entry fee" value="<?=$this->entry_fee?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Upload Contest Fee 1</label>
                                    <div class="form-line">
                                        <input type="number" name="txtcf" class="form-control" placeholder="Enter Contest Fee" value="<?=$this->contest_fee?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Paid Vote Charges 1 (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtpaid_votes" class="form-control" placeholder="Enter paid votes" value="<?=$this->paid_votes?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Upload Contest Fee 2</label>
                                    <div class="form-line">
                                        <input type="number" name="txtcf2" class="form-control" placeholder="Enter Contest Fee" value="<?=$this->contest_fee2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Paid Vote Charges 2 (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtpaid_votes2" class="form-control" placeholder="Enter paid votes" value="<?=$this->paid_votes2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Upload Contest Fee 3</label>
                                    <div class="form-line">
                                        <input type="number" name="txtcf3" class="form-control" placeholder="Enter Contest Fee" value="<?=$this->contest_fee3?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-md-6 pl-xs-0 pr-xs-0">
                                    <label for="password">Paid Vote Charges 3 (%)</label>
                                    <div class="form-line">
                                        <input type="number" name="txtpaid_votes3" class="form-control" placeholder="Enter paid votes" value="<?=$this->paid_votes3?>">
                                    </div>
                                </div>

                                <div style="clear: both;"></div>
                                <div class="alert alert_msgs alert_msg4"></div>
                                <div class="col-md-offset-2 col-md-8" style="text-align: center;">
                                    <button type="button" class="btn btn-primary waves-effect waves-light pull-right cmd_update_con_setting">UPDATE SETTINGS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>


                <div class="col-lg-12 col-md-12 col-sm-12 pl-xs-5 pr-xs-5">
                    <div class="card">
                        <div class="body">
                            <p class="mb-20 font-20" style="color: #888">Update Advert Settings</p>
                            <form class="input-group" id="edit_settings2" method="post" autocomplete="off">
                                
                                <!-- <input type="hidden" value="00" name="admin_type"> -->

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">250x250 Size</label>
                                    <label for="email_address">(7 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt250_1" class="form-control" placeholder="Enter the entry fee" value="<?=$this->size250_1?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">250x250 Size</label>
                                    <label for="email_address">(15 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt250_2" class="form-control" placeholder="Enter paid votes" value="<?=$this->size250_2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">250x250 Size</label>
                                    <label for="email_address">(30 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt250_3" class="form-control" placeholder="Enter paid votes" value="<?=$this->size250_3?>">
                                    </div>
                                </div>


                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">780x90 Size</label>
                                    <label for="email_address">(7 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt780_1" class="form-control" placeholder="Enter the entry fee" value="<?=$this->size780_1?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">780x90 Size</label>
                                    <label for="email_address">(15 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt780_2" class="form-control" placeholder="Enter paid votes" value="<?=$this->size780_2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">780x90 Size</label>
                                    <label for="email_address">(30 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt780_3" class="form-control" placeholder="Enter paid votes" value="<?=$this->size780_3?>">
                                    </div>
                                </div>


                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">300x600 Size</label>
                                    <label for="email_address">(7 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt300_1" class="form-control" placeholder="Enter the entry fee" value="<?=$this->size300_1?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">300x600 Size</label>
                                    <label for="email_address">(15 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt300_2" class="form-control" placeholder="Enter paid votes" value="<?=$this->size300_2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">300x600 Size</label>
                                    <label for="email_address">(30 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt300_3" class="form-control" placeholder="Enter paid votes" value="<?=$this->size300_3?>">
                                    </div>
                                </div>


                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">1360x510 Size</label>
                                    <label for="email_address">(7 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt1300_1" class="form-control" placeholder="Enter the entry fee" value="<?=$this->size1360_1?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">1360x510 Size</label>
                                    <label for="email_address">(15 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt1300_2" class="form-control" placeholder="Enter paid votes" value="<?=$this->size1360_2?>">
                                    </div>
                                </div>

                                <div class="form-group_ mb-20 col-sm-4 pl-xs-0 pr-xs-0">
                                    <label for="email_address">1360x510 Size</label>
                                    <label for="email_address">(30 Days)</label>
                                    <div class="form-line">
                                        <input type="number" name="txt1300_3" class="form-control" placeholder="Enter paid votes" value="<?=$this->size1360_3?>">
                                    </div>
                                </div>


                                <div class="alert alert_msgs alert_msg3"></div>
                                <div class="col-sm-offset-4 col-sm-4" style="text-align: center;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right cmd_update_settings2">UPDATE SETTINGS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        <?php } ?>



        <?php if($page_name == "support"){ ?>
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
                                            <!-- <th>Status</th> -->
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



                <div class="col-lg-5 col-md-4 col-sm-7 p-0 pl-sm-15 pr-sm-15 pl-xs-5 pr-xs-5">
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
                                    <input type="hidden" value="admin" name="txtusr" id="txtusr">
                                    <input id="txtmessage_type" name="txtmessage_type" type="hidden" value="support">

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

                                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 col-sm-offset-2 col-sm-8" style="text-align: center;">
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
                <div class="col-lg-6 col-md-4 col-sm-7 p-0 pl-sm-15 pr-sm-15 pl-xs-5 pr-xs-5">
                    <div class="card p-15 pt-5">
                        <div id="pay-invoice">
                            <div class="card-body enter_messages">
                                <div class="card-title">
                                    <h3 class="text-center">Send Announcement</h3>
                                </div>
                                <hr>
                                <?php
                                    echo form_open('', array('autocomplete'=>'off', 'id'=>'send_support', 'class'=>'input-group'));
                                ?>
                                    <input type="hidden" value="<?=$this->myID;?>" name="txtmem" id="txtmem" class="txtmem">
                                    <input type="hidden" value="admin" name="txtusr" id="txtusr">
                                    <input id="txtmessage_type" name="txtmessage_type" type="hidden" value="announcement">

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

                                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 col-sm-offset-2 col-sm-8" style="text-align: center;">
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect waves-light pull-right" id="cmd_send_support">SEND MESSAGE</button>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="alert alert_msgs alert_msg1"></div>

                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-lg-6 col-md-8 pl-xs-5 pr-xs-5">
                    <div class="card p-10 pt-5">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center msg_titles">Inbox</h3>
                                </div>
                                <hr>
                                <input type="hidden" value="<?=$this->myID;?>" id="txtmem">
                                <input type="hidden" value="inbox" id="txtmsg_type">

                                <div class="card-body all_tables inbox_div">
                                    <table id="" class="table table-striped table-bordered display responsive wrap all_tables1_ tbl_announce" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Members</th>
                                            <th>Status</th>
                                            <th>Subject</th>
                                            <th class="none">Message</th>
                                            <th class="none">Date Sent</th>
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
    var uid = "<?=$this->uri->segment(3);?>";
    if(uid!="") uid = uid+"/";
    if(txtmem!="") txtmem = txtmem+"/";
    //alert(txt_pagename);

    var urls = site_urls+"shields/fetch_records/"+txt_pagename+"/"+uid;

    if(txt_pagename == "support"){
        var urls = site_urls+"shields/fetch_tickets/"+txtmem+"inbox/";
        var urls1 = site_urls+"shields/fetch_tickets/"+txtmem+"sent/";
    }

    if(txt_pagename == "announcement"){
        var urls = site_urls+"shields/fetch_announce/";
    }

    if(txt_pagename == "viewquestions"){
        var urls = site_urls+"shields/fetch_questions/"+uid+"/";
    }

    var dataTable = $('#tbl_contests, #tbl_wallets, #tbl_withdraw, #tbl_transac, #tbl_leaderbd, #tbl_vleaderbd, #tbl_myvotes, #tbl_vote_history, #tbl_advts, #tbl_blog, #tbl_members, #tbl_trans_his, #tbl_sponsored, #tbl_rwds, #myquestions, #tbl_entries, #tbl_refs').DataTable({
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

        //dom: 'lBfrtip',
        //buttons: ['excel',  'csv', 'pdf', 'print', 'copy',],
        //"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
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