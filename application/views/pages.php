
<?php
// if($page_name!="unsubscribe"){
//     include('small_header.php');
// }
?>

<section class="section mt-30 m-sm--10">
<?php
if($page_name=="get_rewarded" || $page_name=="get_rewarded_tests"){
    echo '<div class="contest_main_div contest_main_div1 next-jackpot-section mt--90 pt-40 pb-60">
    <div class="row_">';
}else{

    if($page_name=="vp_market")
        echo '<div class="container p-xs-10">';
    else
        echo '<div class="container">';

    echo '<div class="row_">';
} ?>

        <?php 
            echo '<div class="contest_main_div">';
        ?>
            <div id="page-container p-sm-0">

                
                <?php if($page_name=="contact"){ ?>
                    
                    <div class="container p-0">
                        <div class="row">
                            <div class="offset-md-1 col-md-10 offset-0 col-12 p-0">

                                <div class="col-md-4">
                                    <div class="card_ contact-detail text-center border-0">
                                        <div class="card-body p-0">
                                            <div class="icon">
                                                <a href="tel:+2348064505377" class="text-primary">
                                                    <img src="<?=base_url()?>images/icon/bitcoin.svg" class="avatar avatar-small" alt="">
                                                </a>
                                            </div>
                                            <div class="content mt-3">
                                                <h4 class="title font-weight-bold">Phone</h4>
                                              
                                                <a href="tel:+2348064505377" class="text-primary">+234 806 4505 377</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mt-sm-30 pt-2 pt-sm-0">
                                    <div class="card_ contact-detail text-center border-0">
                                        <div class="card-body p-0">
                                            <div class="icon">
                                                <a href="mailto:icontestprobox@gmail.com" class="text-primary">
                                                    <img src="<?=base_url()?>images/icon/Email.svg" class="avatar avatar-small" alt="">
                                                </a>
                                            </div>
                                            <div class="content mt-3">
                                                <h4 class="title font-weight-bold">Email</h4>
                                              
                                                <a href="mailto:icontestprobox@gmail.com" class="text-primary">icontestprobox@gmail.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mt-sm-30 pt-2 pt-sm-0">
                                    <div class="card_ contact-detail text-center border-0">
                                        <div class="card-body p-0">
                                            
                                            <div class="content mt-3">
                                                <h4 class="title font-weight-bold">Follow us on:</h4>
                                                <ul class="social-icons" style="margin-left: -10px; margin-top: 6px;">
                                                    <li>
                                                        <a href="https://web.facebook.com/iContestpro/" target="_blank" class="fa fa-facebook-f tooltip-pink" title="Facebook">Facebook</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" class="fa fa-twitter tooltip-pink" title="Twitter">Twitter</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.instagram.com/icontestprong/" target="_blank" class="fa fa-instagram tooltip-pink" title="Instagram">Instagram</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-80 mt-sm-40 p-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-7 mt-4 mt-sm-0 pt-2 pt-sm-0 order-2 order-md-1 pl-xs-10 pr-xs-10">
                                <div class="card shadow rounded border-0">
                                    <div class="card-body py-5">
                                        <h4 class="card-title">Get In Touch</h4>
                                        <div class="custom-form mt-4">
                                            <div id="message"></div>
                                            <form method="post" action="#" name="contact-form" class="contact_msg" id="contact-form">
                                                <div class="row">
                                                    <div class="col-md-6 pr-5 pl-xs-10 pr-xs-10">
                                                        <div class="form-group position-relative">
                                                            <label>Your Name <span class="text-danger">*</span></label>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user fea icon-sm icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                            <input name="txtname" id="txtname" type="text" class="form-control pl-5" value="<?=$this->myfullname?>" placeholder="First Name">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-md-6 pl-5 pl-xs-10 pr-xs-10">
                                                        <div class="form-group position-relative">
                                                            <label>Phone</label>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book fea icon-sm icons"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                                            <input name="txtphone" id="txtphone" type="number" class="form-control pl-5" placeholder="Phone" value="<?=$this->myphone?>">
                                                        </div>
                                                    </div><!--end col-->

                                                    <div class="col-md-12 mt-5 pl-xs-10 pr-xs-10">
                                                        <div class="form-group position-relative">
                                                            <label>Your Email <span class="text-danger">*</span></label>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail fea icon-sm icons"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                            <input name="txtemail" id="txtemail" type="email" class="form-control pl-5" placeholder="Your email" value="<?=$this->mymail?>">
                                                        </div> 
                                                    </div><!--end col-->

                                                    <div class="col-md-12 mt-5 pl-xs-10 pr-xs-10 mb-xs-10">
                                                        <div class="form-group position-relative">
                                                            <label>Your Message</label>
                                                            <textarea name="txtmessage" id="txtmessage" rows="4" class="form-control pl-5" style="color: #444 !important;" placeholder="Your Message :"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div style="clear: both;"></div>
                                                <div class="alert alert-danger alert_msgs alert_msg1"></div>

                                                <div class="row mt-20 mb-20">
                                                    <div class="col-sm-12 text-center">
                                                        <input type="button" id="sendMessage" name="sendMessage" class="submitBnt btn btn-primary btn-block" value="SEND MESSAGE">
                                                        <div id="simple-msg"></div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </form><!--end form--> 
                                        </div><!--end custom-form-->
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6 col-md-6 col-sm-5 order-1 order-md-2">
                                <div class="border-0">
                                    <div class="card-body p-0">
                                        <img src="<?=base_url()?>images/contact.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    
                <?php } ?>


                <?php if($page_name=="about"){ ?>
                    <div class="container mt--40 mt-sm-0 about_infos p-0">

                        <div class="container p-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5_ mt-0 pt-0 mt-sm-40 pt-sm-0 mt-xs-0">
                                    <div class="position-relative">
                                        <img src="<?=base_url()?>images/img_about3.jpg" class="rounded img-fluid mx-auto d-block" alt="">
                                        <div class="play-icon">
                                            <a href="#aboutus" class="play-btn video-play-icon about_dv">
                                                <i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-7_ mt-0 pt-0 mt-sm-0 pt-sm-0">
                                    <div class="section-title ml-lg-4 mt-40">
                                        <h4 class="title mb-4">About Us</h4>
                                        <p class="text-dark">iContestPro is a digital multiple contest platform that brings to you top online competitions, challenges and contests from sponsors all over the world. These sponsors are  reputable organisations, associations or groups.

                                        We all love contests and loyalty rewards - thus, we have made it easy for organizations to publish contests online on iContestPro, in a fun-like, transparent and yet engaging ecosystem.<br><br>
                        
                                        There is something for everybody, win BIG when you participate in a contest sponsored by one of our top brand and organisation, just like you also get rewarded handsomely when you votes for contestants. To our sponsors, we promise an optimised brand visibility, brand engagement and loyalty drive - with every contest published</p>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/><br/>

                        <div class="container p-0">
                            <div class="row align-items-center">
                                <center>
                                    <div class="col-lg-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                        <div class="section-title ml-lg-4">
                                            <h4 class="title mb-4">A promise of brand engagement</h4>
                                            <p class="text-dark">Content Marketing is regarded as the most powerful engagement strategy - whereas competition is considered the most effective content marketing tool.
                                                
                        
                                                We have built iContestPro, to help organisations leverage on technology to create contests online  very easily and quickly, thus, driving brand engagement, brand visibility and loyalty.
                        
                                                With some level of creativity, you have in your hands a complete ecosystem to stimulate sales and monetize your brand follower-ship.</p>
                                          
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>

                        <br/><br/>


                        <div class="container p-0">
                            <div class="row align-items-center">
                                <div class="col-lg-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                    <div class="section-title ml-lg-4">
                                    <center>     <h4 class="title mb-4">Our Mission</h4>
                                        <p class="text-dark">We are on a mission of redefining brand engagement and loyalty rewards - by connecting brands to their customers and prospects in a fun and engaging ecosystem.</p>
                                    </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/><br/>

                        <div class="container p-0">
                            <div class="row align-items-center">
                                <div class="col-lg-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                    <div class="section-title ml-lg-4">
                                    <center>  <h4 class="title mb-4">Our Value</h4>
                                        <p class="text-dark">Fitness,
                                            Fun Engagement,
                                            Guaranteed satisfaction,
                                            Transparency &
                                            Integrity<br></p>  </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                <?php } ?>



                <?php if($page_name=="vp_market"){ ?>
                    <div class="container mt--20 mb-40 mt-sm-0 p-xs-0" style="color: #444">
                        <p class="mb-10 font_size_18 text-center">Do you want to buy or sell your Vote Point VP? Here is the right place for the exchange. Choose any seller and click on the buy button to get VP</p>

                        <div class="mb-20 text-center"><span class='cmd_sell_vp buy_vp buy_vp1'>Sell Your VP</span></div>

                        <div class="table-responsive project-table vp_table" style="display: nones;">
                            <table id="tbl_vp_market" class="table display responsive wrap all_tables1_ vp_market_tbl" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Seller Info</th>
                                        <th>VP</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>



                        <div class="vp_buy_div" style="display: none;">
                            <p style="margin: 0; line-height: 20px;"><b>Seller </b> <b class="seller_name">xxxxxx</b> has <b class="seller_vp">xxxx</b> and sells at <b class="seller_rate">xxxx</b> for 1VP</p>
                            <p style="margin: 6px 0 15px 0; font-size: 15px; color: #093; line-height: 18px;">Please reload the page after every transaction to show your new amount in your wallet</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="txtvps" type="text" class="form-control" style="padding-left: 20px !important" placeholder="Enter VP to buy">
                                    </div>

                                    <input id="seller_vp" type="hidden">
                                    <input id="buyer_id" type="hidden" value="<?=$this->myID?>">
                                    <input id="seller_id" type="hidden">
                                    <input id="buyer_email" type="hidden" value="<?=$this->mymail?>">
                                    <input id="seller_email" type="hidden">
                                    <input id="seller_rate" type="hidden">

                                    <div class="form-group">
                                        <select class="form-control mt-5" id="pay_mthd_vp" name="pay_mthd_vp" style="padding:14px !important; border-radius: 40px !important;">
                                            <!-- <option value="" selected>-Payment Method-</option> -->
                                            <option value="wallet">Pay From Wallet (Bal: &#8358;<?=$this->wallets?>)</option>
                                            <!-- <option value="paystack">Instant Payment 1 (ATM card, USSD)</option>
                                            <option value="flutterwave">Instant Payment 2 (ATM card, USSD, Bank transfer)</option> -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="txtnotes" id="txtnotes" class="form-control pl-5" style="color: #444 !important; height: 5em !important;" placeholder="Write a note for the seller (Optional)"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="clear: both;"></div>

                            <div class="row mt-20 mb-20">
                                <div class="col-sm-6 text-center">
                                    <div class="col-sm-12 text-center">
                                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                        <?php
                                        if($this->myID>0)
                                            echo '<input type="button" id="buyvps" class="btn btn-primary btn-block pt-15 pb-15" value="BUY VP">';
                                        else
                                            echo '<input type="button" id="buymyvps" style="opacity:0.5" class="btn btn-primary btn-block pt-15 pb-15" value="BUY VP">';
                                        ?>
                                    </div>

                                    <div class="col-sm-12 mt-20">
                                        <p><span class="back_to_sell">GO BACK</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="sell_your_vp"></div>
                        <div class="sell_vp mt-40" style="display: none;">
                            <p>Do you have enough Vote Point VP to sell? Then you can sell your VP here with ease</p>
                            <div class="all_spans">
                                <b>Important Notice</b><br>
                                <span>You must have <b>100VP</b> or above to use this feature</span>
                                <span>Company's Vp rate is <b>1VP for NGN20</b>. The lower your price, the higher it attract buyers</span>
                                <span>Any transaction goes to the company account first before it can come to you for security reasons</span>
                            </div>

                            <div class="sell_div mt-30 p-20 p-xs-10 pt-xs-20">
                                <p style="font-size: 20px;"><b>Your VP is 456</b>, how much do you want to sell 1VP?</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="txtamts" type="text" class="form-control" style="padding-left: 20px !important" placeholder="Enter Amount">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="txtaccts" id="txtaccts" class="form-control pl-5" style="color: #444 !important; height: 5em !important;" placeholder="Your account details for buyers to pay you"></textarea>
                                            <p style="font-size: 14px; color: #666; line-height: 18px; margin-top: 4px;">Your accout details will include your bank name, account number and your account name</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="clear: both;"></div>
                                

                                <div class="row mt-10 mb-20">
                                    <div class="col-sm-6 text-center">
                                        <div class="col-sm-12 text-center">
                                            <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                            <?php
                                            if($this->myID>0)
                                                echo '<input type="button" id="sellvps" class="btn btn-primary btn-block pt-15 pb-15" value="SELL YOUR VP">';
                                            else
                                                echo '<input type="button" id="sellmyvps" style="opacity:0.5" class="btn btn-primary btn-block pt-15 pb-15" value="SELL YOUR VP">';
                                            ?>
                                        </div>

                                        <div class="col-sm-12 mt-20 text-center">
                                            <p><span class="back_to_sell">GO BACK</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <?php if($page_name=="notifications___"){ ?>
                    <div class="container mt--20 mt-sm-0 p-0">
                        <?php
                        if($notify_msgs){
                            //$memCounts = $this->sql_models->memCounts('all_notifications', $this->myID);
                            $memid = $notify_msgs;
                            
                            foreach($notify_msgs as $post){
                                $memid = $post['memid'];
                                $what_page = base_url().$post['what_page'];
                                $page_id = $post['page_id'];
                                $actns = $post['actns'];
                                $page_id1 = substr($page_id, 0, -5);

                                if(strlen($page_id1)>30) $page_id1 = substr($page_id1, 0, 30)."...";
                                
                                $has_read = $post['has_read'];
                                $date_created = $post['date_created'];
                                $getMembers = $this->sql_models->getDetailsArr($memid);
                                $noti_name = ucwords(strtolower($getMembers['names']));
                                $noti_nickname = ucwords(strtolower($getMembers['nickname']));
                                if(strlen($noti_name)<=2) $noti_name = ucwords(strtolower($noti_nickname));

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

                                $notify_divs_color = "";
                                if($has_read==0)
                                    $notify_divs_color = "notify_divs_color";
                                ?>

                                <div class='notify_divs <?=$notify_divs_color?> container'>
                                    <a href="<?=$what_page?>">
                                        <div class='row'>
                                            <div class='col-md-1 col-3 pl-20 pr-0'>
                                                <div class="img-thumbs">
                                                    <img src="<?=$pic_path2?>" alt="" class="img-fluid rounded" />
                                                </div>
                                            </div>
                                            <div class='col-md-10 col-9 pl-0'>
                                                <?="<b>$noti_name</b> $actns on your contest \"$getContestName\"<br>";?>
                                                <span><?=time_ago($date_created);?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }
                        }else{
                            echo "No notifications yet!";
                        }
                        ?>
                    </div>
                <?php } ?>



                <?php if($page_name=="how-it-works"){ ?>
                    <div class="grid container mt-40">
                        <h3 class="border"><font style="color: #f5245f">How It</font> Works</h3>

                        <div class="contact_info how_it_works_img">
                            <p>To be considered as part of any of the contests, you have to <a href="<?=base_url()?>register/" style="color: #f5245f">create an account</a> to get registered.</p>

                            <p>We are searching for young people all around the world to be part of this great opportunity. Click on any contest of your choice and participate on any, tell your friends to come and vote for you and stand the chance of being the winner of that particular contest. Boost your votes to increase the chances of you being at the top of other contestants and get the rewards. </p>

                            <p style="margin-top: 25px;"><b>CRITERIA</b><br>

                            <strong>All participants must:</strong></p>

                            <p>Be between the ages of 18 and 60 years old<br>
                            Be of good health and character<br>
                            Speak fluent English<br>
                            Be here regularly to see your qualifications<br>
                            Not have tattoos or piercings<br>
                            </p>

                            <a name="getvp"></a>
                            <p class="mt-30" style=""><b>HOW YOU GET YOUR VP</b></p>
                            <p style="margin-top: -5px;">
                                1. VP means Vote Point<br>
                                2. Each vote you do gets you some VP<br>
                                3. The higher you vote, the higher your VP<br>
                                4. Invite a sponsor and get 100VP<br>
                                5. Share any contests and get 10VP each (we only give 30VP on share of 3 contest every 24hrs), make sure you are logged in<br>
                            </p>


                            <p class="mt-30" style=""><b>HOW YOU USE YOUR VP</b></p>
                            <p style="margin-top: -5px;">
                                1. The <a href="<?=base_url()?>get-rewarded/">Get Rewarded</a> feature allows you to buy tickets with your VP and win lots of iContestPRO luxury gifts.<br>
                                2. You can buy more tickets with your VP to stand a chance to win<br>
                            </p>

                            <p class="mt-30">For any inquiries or any questions, kindly contact us via <a href="tel:+2349067989021" style="color: #f5245f">+234 906 7989 021</a></p>
                        </div>
                    </div>
                <?php } ?>



                <?php if($page_name=="faqs"){ ?>
                    <div class="grid container mt--20 formatps p-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">FAQs</font></h1>

                        <h4>1. Who can use iContestPRO?</h4>

                        <p>Anyone be it Sponsors of Contest, 
                        Contestants,
                        Voters,
                        Advertisers,
                        Marketers or 
                        Viewers</p>

                        <h4>2. How do I become a Sponsor?</h4>
                        <p>Very Easy! <a href="<?=base_url()?>register/">Create your account</a> and upgrade to become a SPONSOR as only sponsor can upload contests.</p>

                        <h4>3.What is a Code Vote?</h4>
                        <p>A code vote is given by a company sponsor, they are given codes to come to come and contest on their contest on iContestPRO.</p>

                        <h4>4. What are boosted votes?</h4>
                        <p>A voter can decide to boost their votes by making payments from the wallets to increase their number of votes with a token. </p>

                        <h4>5. Do I need to register to vote?</h4>
                        <p>No! The free votes do not require registration. Anyone can come and vote freely. But the boosted vote and coded votes require registration.</p>

                        <h4>6. How can I vote more instead of just a vote?</h4>
                        <p>Very possible! You can boost higher votes with just little amount from your wallet. Also you can use your free votes everyday until the contest expires.</p>

                        <h4>7. What is VP and how does it work?</h4>
                        <p>VP is Point Value! Each vote you vote for someone comes with a number of VP, the higher you vote, the higher your VP adds up. When you refer someone, some VP and amount will be added to your wallet.</p>

                        <h4>8. of what value is VP to me?</h4>
                        <p>You can use your VP to get some rewards weekly or monthly when you buy a ticket or get reward page to stand a chance to win lots of prizes.</p>

                        <h4>9. I forgot my password to Login.</h4>
                        <p>You can do a quick password reset by <a href="<?=base_url()?>register/">clicking here.</a> Make sure you have an active email so as to send the password reset link on your mail.</p>

                        <h4>10. Is contesting free?</h4>
                        <p>Depending on each sponsor, some contest requires a little token for entrance while some are free</p>

                        <h4>11. What will I get if I contest?</h4>
                        <p>Every contest is embedded with prizes and/or gifts for only the first, second and third winners of votes.</p>
                         
                        <h4>12.How can more people vote for me?</h4>
                        <p>IContestPRO platform has its members and followers, but you will achieve more if you share your contest on your social media pages, Facebook, Twitter, or WhatsApp and call their attention to vote for you. You can as well tell your friends to boost your votes for you to have more chances of winning.</p>

                        <h4>13. How can I credit my wallet?</h4>
                        <p>You can easily credit your wallet on your <a href="<?=base_url()?>dashboard/">dashboard</a> after creating your account.</p>

                        <h4>14. How can I put my campaign on the big banner up?</h4>
                        <p>Go to your <a href="<?=base_url()?>dashboard/">dashboard</a> and click on the link Become A Sponsor, follow the 2-step process and your AD will be visible on the big banner for more users to view and join.</p>

                        <h4>15. How can I advertise my business on iContestPRO platform?</h4>
                        <p>Very easy! Create a <a href="<?=base_url()?>register/">one-step account</a> with us, upload your ad and make payments, after confirmation your ADs will be visible on our platform. You can also extend your AD if it expires or if it's about to expire.</p>

                        <h4>16. Where are members from iContestPRO coming from?</h4>
                        <p>We get influx of members daily, we have various social media handles where they come from. They also come from our blogs on other platforms, advertising agencies, brands, email marketing and other means.</p>

                        <h4>17. How can I withdraw my money from my wallet? </h4>
                        <p>You can only withdraw when your money reaches a minimum of <b>&#8358;2,000</b></p>

                        <h4>18. How do I Earn?</h4>
                        <p>- The more you refer Sponsors, the more you earn.<br>
                        - The more you upload contest and get people to participate, the more you earn either by voting and entrance fee.</p>

                        <h4>19. My Sponsorship has not been approved why?</h4>
                        <p>Kindly <a href="<?=base_url()?>contact/">contact us here</a> and lay your complaints.</p>

                    </div>
                <?php } ?>



                <?php if($page_name=="sponsor_contest"){ ?>
                    <div class="grid container mt-0 formatps p-0">
                        
                        <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #555">Contest </font> <font style="color: #069">Sponsorship</font></h1>

                        <p style="margin-top: 20px;"><b>Do you want more Traffic?</b><br>
                        Do you want to Drive Brand Loyalty?<br>
                        Are you looking for a creative way to both your Brand Awareness and Visibility?<br>
                        Do you want to explore content marketing strategy to Stimulate and Boost Sales?</p>
                        <p>If you have answer yes to any of the questions above – then iContestPRO.com is built for you and Your Organization. Start Sponsoring a Contest Here<br><br>
                        We have built iContestPRO to help organization leverage digital platform to  create and host contest, challenge, and competition online FREE and with EASE, thus, helping brand to drive Brand Engagement, Visibility and Loyalty as well as stimulate sales and monetization of brand followership.<br><br>
                        Content Marketing is regarded as the most powerful engagement strategy - whereas competition is considered the most effective content marketing methodology; hence, you can regard iContestPRO as your powerful and impact content marketing platform.<br><br>
                        We are on a mission to redefining brand engagement and loyalty rewards – by connecting brands to their customers and prospects in a fun but yet effective and engaging ecosystem.</p>

                        <p><img src="<?=base_url()?>images/sponsor_contest.jpg" class="img-responsive"></p><br>

                        <h2>Why iContestPRO?</h2>
                        <p>There are no too many optional platform for hosting professional contest out there; notwithstanding, we provide you with an edge to WIN; as our team would support you with promotion, marketing and administration to ensure every run through smoothly. Aside saving some thousands of dollar to build your own platform – you will also leverage our vibrant communities to boost participation in your contest and traffic to your digital platform (website/app).<br><br>

                        Simply PUT, you will enjoy: Lower cost of Implementing Your Strategy; Vibrant Community Engagement; Ready Traffic; Support with Strategy, Marketing and Promotion.<br></p>


                        <h2>Get Started Now</h2>
                        <p>We host three (3) type of contest: <br>
                        •   FREE Entry Contest;<br>
                        •   Paid Entry Contest and <br>
                        •   Code-based Entry Contest<br></p>

                        <p>You can get started as a sponsor on iContestPRO FREE or you choose our Pro Pack on your dashboard.</p>

                        <!-- <p><img src="<?=base_url()?>images/sponsor_contest1.jpg" class="img-responsive"></p><br> -->

                        <p><b>Note:</b> You Contest would be subject to review by our Ethic and Compliant Committee before Approval; this is to assess your promise, process and procedure as well as ascertain you are not promoting violent, sexism and minor abused. Typically we would revert in 24hours.</p>

                        <p>For More Information Call Tunde on: <a href="tel:+2348064505377">+234 806 4505 377</a> or Send Email to <a href="mailto:icontestprobox@gmail.com">iContestProBox@gmail.com</a></p>

                    </div>
                <?php } ?>



                <?php if($page_name=="advert_placements"){ ?>
                    <div class="grid container mt--20 mt-xs-0 formatps p-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Advert </font> <font style="color: #444">Placements</font></h1>
                        
                        <p>Take advantage of our vibrant community- to promote there products and services, and boost your sales and brand visibility.</p>

                        <p>To Get started contact:<br>
                        Call Admin to Place your Advert: <a href="tel:2349067989021">234 906 7989 021</a><br>
                         
                        OR<br>

                        Send Email to: 
                        <a href="mailto:support@icontestpro.com">support@icontestpro.com</a><br></p>


                        <p><b style="font-size: 20px; line-height: 60px;">Advertisements Rate</b><br>
                        A. TOP BANNER (HOME PAGE)<br>
                              <b>N100,000 per week</b><br><br>

                        B. SIDE BANNER (HOME PAGE)<br>
                              <b>N30,000 per week</b><br><br>

                        C. IN CONTEST ENTRY ADVERT<br>
                              <b>N15,000 per week</b><br><br>

                        D. CONTEST PAGE ADVERT<br>
                              <b>N20,000 per week</b><br><br>

                        E. TOP BANNER INNER PAGE<br>
                              <b>N30,000 per week</b><br><br>

                        F. BLOG AND NEW PAGE ADVERT<br>
                              <b>N10,000 per week</b><br><br>

                        G. SPONSOR STORY<br>
                              <b>N10,000 per post</b><br><br>

                        H. MOBILE APP SLASH PAGE<br>
                              <b>N200,000 per week</b><br><br>

                        I. SCROLLING LOGO<br>
                              <b>N5,000 per week</b><br><br>

                        J. PAGE BOTTOM ADVERT <br>
                              <b>N40,000 per week</b><br><br>

                        K. PUSH NOTIFICATION ALL USER<br>
                              <b>N50,000 per push.</b><br><br>

                        L.  ADVERT PLACEMENT IN EMAIL NEWSLETTER:   <br>
                            <b>N10,000 per week</b><br><br>

                        M. PLATFORM TITLE<br>
                              <b>N1M per Month.</b><br><br></p>


                        <p><b>Special Note:</b></p>

                        <p>1. Minimum advert contract acceptable is N10,000<br>

                        2. Sponsor with active contest shall enjoy 50% discount on any advert placed when there contest is active.<br>

                        3. Bulk purchase 20% discounts apply, if buying more than 3 Slots or 3 Placement.<br></p>

                    </div>
                <?php } ?>


                <?php if($page_name=="privacy_policy"){ ?>
                    <div class="grid container mt--10 formatps p-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Privacy & </font> <font style="color: #444">Policy</font></h1>

                        <br>
                        <p>At iContestPRO.com, accessible from www.icontestpro.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by iContestPRO.com and how we use it.</p>

                        <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

                        <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in iContestPRO.com. This policy is not applicable to any information collected offline or via channels other than this website.</p>

                        <h2>Consent</h2>

                        <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                        <h2>Information we collect</h2>

                        <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                        <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                        <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

                        <h2>How we use your information</h2>

                        <p>We use the information we collect in various ways, including to:</p>

                        <ul>
                        <li>Provide, operate, and maintain our webste</li>
                        <li>Improve, personalize, and expand our webste</li>
                        <li>Understand and analyze how you use our webste</li>
                        <li>Develop new products, services, features, and functionality</li>
                        <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the webste, and for marketing and promotional purposes</li>
                        <li>Send you emails</li>
                        <li>Find and prevent fraud</li>
                        </ul>

                        <h2>Log Files</h2>

                        <p>iContestPRO.com follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info" target="_blank">Privacy Policy Generator</a> and the <a href="https://www.privacypolicyonline.com/privacy-policy-template/" target="_blank">Privacy Policy Template</a>.</p>

                        <h2>Cookies and Web Beacons</h2>

                        <p>Like any other website, iContestPRO.com uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

                        <p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/" target="_blank">"What Are Cookies"</a>.</p>

                        <h2>Google DoubleClick DART Cookie</h2>

                        <p>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – <a href="https://policies.google.com/technologies/ads" target="_blank">https://policies.google.com/technologies/ads</a></p>

                        <h2>Our Advertising Partners</h2>

                        <p>Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.</p>

                        <ul>
                            <li>
                                <p>Google</p>
                                <p><a target="_blank" href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></p>
                            </li>
                        </ul>

                        <h2>Advertising Partners Privacy Policies</h2>

                        <P>You may consult this list to find the Privacy Policy for each of the advertising partners of iContestPRO.com.</p>

                        <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on iContestPRO.com, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

                        <p>Note that iContestPRO.com has no access to or control over these cookies that are used by third-party advertisers.</p>

                        <h2>Third Party Privacy Policies</h2>

                        <p>iContestPRO.com's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: Privacy Policy Links.</p>

                        <p>You can choose to <span class="usrs" onclick="">disable cookies</span> through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

                        <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

                        <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                        <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
                        <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
                        <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
                        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                        <h2>GDPR Data Protection Rights</h2>

                        <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                        <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                        <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
                        <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
                        <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                        <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
                        <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                        <h2>Children's Information</h2>

                        <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

                        <p>iContestPRO.com does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

                    </div>
                <?php } ?>


                <?php if($page_name=="terms_use"){ ?>
                    <div class="grid container mt--20 formatps formatps1 p-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Terms Of </font> <font style="color: #444">Use</font></h1>
                        <br>
                        <?php include('terms_of_use.php'); ?>

                    </div>
                <?php } ?>


                <?php if($page_name=="unsubscribe"){ ?>
                    <html>
                        <head>
                            <title>Unsubscribe</title>
                            <style type="text/css">
                                p{font-size: 25px !important;}
                                div{padding: 5px 10px; text-align: center !important;}
                            </style>
                        </head>
                        <body>
                            <div style="color: #555; text-align: center !important;">
                                <p>You have unsubscribed for the vote campaign email notification, thank you!</p>
                                <p style="margin: -5px 0 0 0"><a href="<?=base_url()?>" style="text-decoration: none; color: #E60073">Click here to go to iContestPro</a></p>

                            </div>
                        </body>
                    </html>
                <?php exit; } ?>



                <?php if($page_name=="winners"){ ?>
                
                    <div class="container mt--20 mt-xs-0 p-0">
                        <div class="grid_">

                            <div class="col-md-12 p-0 mt--10 mb-0 mt-sm-30 mb-sm-40 mt-xs--10 mb-xs-0">
                                <div class="col-lg-4 col-md-10 p-0">
                                    <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #555">Our</font> <font style="color: #069">Winners</font></h1>
                                </div>

                                <div class="col-lg-4 col-md-8 p-0 back_to_winners1 mb-sm-0 mt-sm-20">
                                    <div class="back_to_winners" style="border-radius:5em;">
                                        <i class="fa fa-caret-left"></i> GO BACK
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>

                            <div class="col-md-8 col-sm-8 p-0">
                                <div class="div_contests_box" style="display: nones;">
                                    <p class="mt-10 mt--sm-50 mt-xs-0 mb-xs-10" style="font-size: 17px; text-align: center; color: #555;">Click on any contest to view winners</p>
                                    <div class="row_">
                                    <?php
                                    if($contests){
                                        foreach($contests as $post){
                                            $ids = $post['id'];
                                            $nows = substr(time(), -5);
                                            $ids_hash = $ids.$nows;
                                            $title = ucwords($post['title']);
                                            $completed = $post['completed'];
                                            $files = $post['files'];
                                            $views2 = kilomega($post['views']);
                                            $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                                            $title = strtolower($title);

                                            $contest_img = base_url()."contest_types/$files";
                                            $width1="";
                                            list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                                            if($width1=="" || $width1<=0)
                                                $contest_img = base_url()."images/no-image.jpg";

                                            $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));
                                            ?>
                                            <div class="col-lg-6 col-md-11 col-xs-12 mb-20 pl-10 pr-10 pl-sm-5 mb-sm-20 pr-sm-5 mt-10 contst_box_outer">
                                                <div class="contst_box" id1="<?=$ids?>" titles="<?=$title?>">
                                                    <p class="titles" style="text-transform: capitalize !important;"><?=$title?></p>

                                                    <div class="row">
                                                        <div class="col-xs-8 pr-0">
                                                            <p><span>Entries: <font style="color:#008442"><?=$noOfEntries?></font></span></p>
                                                            <p><span>Status: <font style="color:#008442">Completed</font></span></p>
                                                            <p><span>Votes: <font style="color:#008442"><?=$noOfVotes?></font></span></p>
                                                            <p><span>Views: <font style="color:#008442"><?=$views2?></font></span></p>
                                                        </div>

                                                        <div class="col-xs-4 p-0">
                                                            <img src="<?=$contest_img?>" alt="<?=$title?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }else{
                                        //echo "<div style='clear: both'></div>";
                                        echo "<p style='font-size:18px; text-align: center' class='mt-30 mt--sm-10'>Oops! No winners yet!</p>";
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>


                                <div class="winners_dv" style="display: none;"></div>
                            </div>


                            <div class="col-md-4 col-sm-4 mt-xs-90 pl-sm-0 pr-sm-0 pl-xs-5 pr-xs-5">
                                <?php include('left_nav.php'); ?>
                            </div>

                        </div>
                    </div>

                <?php } ?>


                

                <?php if($page_name=="contest_leaderboard"){ ?>
                    <div class="grid container mt--20 p-sm-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Contest </font> <font style="color: #333">Leaderboard</font></h1>

                        <p class="mt-5 mb-20 mb-xs-0" style="color: #444; font-size: 16px;">List of contest campaigns and their details, click on anyone to participate.</p>

                        <div class="row_">
                            <div class="table-responsive project-table">
                                <table id="tbl_leaderbd" class="table table-striped_ _table-bordered display responsive wrap all_tables1_" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Contest</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <?php if($page_name=="voters_leaderboard"){ ?>
                    <div class="container mt--20  p-sm-0">

                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Voters </font> <font style="color: #333">Leaderboard</font></h1>

                        <p class="mt-5 mb-20 mb-xs-0" style="color: #444; font-size: 16px;">List of top voters and their details, click to view profile.</p>

                        <div class="row_">
                            <div class="table-responsive project-table">
                                <table id="tbl_vleaderbd" class="table table-striped_ _table-bordered display responsive wrap all_tables1_ all_tables2_" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Voters</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <?php if($page_name=="entries_leaderboard"){
                    $getContestName = ucwords(strtolower($this->sql_models->getContestName($get_ent1)));
                    $getContestTime = $this->sql_models->getContestTime($get_ent1);
                    $getContestTime1 = @date("jS M, Y, h:i a", $getContestTime);
                ?>
                    <!-- <input type="hidden" value="<?=$contestids?>" id="contestids"> -->
                    <div class="grid container mt--20 p-sm-0">
                        <h1 style="font-weight: 600;" class="header_tt1 header_tt2"><font style="color: #069">Entries </font> <font style="color: #222">Leaderboard</font></h1>

                        <p class="mt-5 mb-20 mb-xs-0" style="color: #333; font-size: 16px; line-height: 21px">List of entries and their details, click to view profile.</p>

                        <?php
                        if($getContestName != ""){
                            echo "<p style='margin: 6px 0 8px 0; font-size:22px; color:#09C; font-weight: 600; line-height:24px;'>Entries for $getContestName.</p>";

                            echo "<p style='margin: 0px 0 20px 0; font-size:16px; color:#666;'><b>Close Date:</b> $getContestTime1</p>";
                        }
                        ?>

                        <div class="row_">
                            <div class="table-responsive project-table">
                                <p style="text-align: center;"><span class="refresh_lb1" con_id="<?=$contestids?>">Click here to reload updates</span></p>
                                <table id="tbl_entleaderbd" class="table table-striped_ _table-bordered display responsive wrap all_tables1_ all_tables2_" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Entries</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <?php if($page_name=="get_rewarded" || $page_name=="get_rewarded_tests"){ ?>

                    <!-- <link rel="stylesheet" href="<?=base_url()?>assets_game/css/style.css">
                    <link rel="stylesheet" href="<?=base_url()?>assets_game/css/responsive.css"> -->

                    <?php
                        /*$raf_id = $raf_dtls['id1'];
                        $rtitle = ucwords($raf_dtls['titles']);
                        $old_titles = $this->sql_models->bringOldTitle();
                        $old_date=""; $mycaps=""; $old_title="";
                        if($old_titles){
                            $old_title = $old_titles['titles'];
                            $old_date = "(Dated ".@date("jS M Y, h:i a", strtotime($old_titles['date_created'])).")";
                            $mycaps = "last";
                        }
                        
                        $rtimings = $raf_dtls['timings'];
                        $rfile1 = $raf_dtls['file1'];
                        $rfile2 = $raf_dtls['file2'];
                        $rfile3 = $raf_dtls['file3'];
                        $rand_nums1 = $raf_dtls['rand_nums1'];
                        $rand_nums2 = $raf_dtls['rand_nums2'];
                        $rand_nums3 = $raf_dtls['rand_nums3'];
                        $rtimings1 = date("Y/m/d", $rtimings);
                        
                        $rfile1 = base_url()."lottery_prizes/$rfile1";
                        $rfile2 = base_url()."lottery_prizes/$rfile2";
                        $rfile3 = base_url()."lottery_prizes/$rfile3";

                        if($rand_nums1==""){
                            $rand_nums1="####";
                            $rfile1 = base_url()."images/gift_expired.jpg";
                        }
                        if($rand_nums2==""){
                            $rand_nums2="####";
                            $rfile2 = base_url()."images/gift_expired1.jpg";
                        }
                        if($rand_nums3==""){
                            $rand_nums3="####";
                            $rfile3 = base_url()."images/gift_expired.jpg";
                        }*/

                        $noOfQuest = $this->sql_models->countRecs('quiz_questions');
                        $quiz_detls = $this->sql_models->getQuizID();
                        $qzid = $quiz_detls['id'];
                        $qz_title = $quiz_detls['quiz_title'];

                        $subjs = ucwords($quiz_detls['subj']);
                        $seconds = $quiz_detls['seconds'];

                        $prize1 = $quiz_detls['prize1'];
                        $prize2 = $quiz_detls['prize2'];
                        $prize3 = $quiz_detls['prize3'];
                        $prize4 = $quiz_detls['prize4'];
                        $prize5 = $quiz_detls['prize5'];
                        $date_uploaded = $quiz_detls['prize1'];

                        $rtitle = ucwords($qz_title);
                    ?>

                    <div class="container mt-20 mt-xs-20 mt-sm-20 div_lottery pl-10 pr-10">
                        <h1 style="font-weight: 600;" class="header_tt1"><font style="color: #555">Get </font> <font style="color: #069">Rewarded</font></h1>

                        <p style="margin: 8px 0 30px 0; font-size: 22px; color: #990; position: relative; z-index: 9; font-weight: 600;"><?=$rtitle?></p>
                        <?php //include('lottery.php'); ?>
                        <?php include('quiz_rewards.php'); ?>
                    </div>

                    <!-- <script src="<?=base_url()?>assets_game/js/jquery-3.3.1.min.js"></script>
                    <script src="<?=base_url()?>assets_game/js/jquery.countdown.js"></script>
                    <script src="<?=base_url()?>assets_game/js/main.js"></script>

                    <script type="text/javascript">
                      $('#clock').countdown('<?=$rtimings1?>', function(event) {
                        $(this).html(event.strftime(''
                          +'<div><span>%D</span><p>Days</p></div>'
                          +'<div><span>%H</span><p>Hrs</p></div>'
                          +'<div><span>%M</span><p>Mins</p></div>'
                          +'<div><span>%S</span><p>Sec</p></div>'));
                      });
                    </script> -->
                <?php } ?>

            </div>
        </div>
    </div>
</div>
</section>

<!-- </main> -->

