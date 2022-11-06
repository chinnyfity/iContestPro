
<!DOCTYPE html>
    <html lang="en">


<head>

<?php 
/*echo $this->input->cookie('retain_page_id1', TRUE)."<br>";
echo $this->input->cookie('retain_page_name', TRUE)."<br>";
echo $this->input->cookie('retain_page_params3', TRUE)."<br>";*/
?>

        <meta charset="utf-8" />
        <title>iContestPRO - Have Fun & Win Big</title>
        <link rel="canonical" href="http://icontestpro.com/" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="msapplication-navbutton-color" content="#069"> <!-- Windows Phone -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#069"> <!-- iOS Safari -->
        <meta name="theme-color" content="#069">
        <!-- favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>images/favicon.ico">
        <!-- Bootstrap -->
        <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="<?=base_url()?>css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Main css -->
        <link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="<?=base_url()?>css/colors/default.css" rel="stylesheet" id="color-opt">
        <link href="<?=base_url()?>css/custom-bootstrap-margin-padding.css" rel="stylesheet">
        <link href="<?=base_url()?>css/style_main.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    </head>

    <body class="js-sweetalert">

        <input type="hidden" value="<?=base_url();?>" id="txtsite_url">
        <input type="hidden" value="<?=$this->myID;?>" id="txtuserID">
        <input type="hidden" value="<?=$page_name;?>" id="txtpage_name">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
        <!-- Loader -->
        <div class="back-to-home rounded d-none_ d-sm-block_ fixeds1 pr-10 mt-xs--5">
            <a href="<?=base_url()?>" class="text-white title-dark rounded d-inline-block d-inline-block1 text-center"><i data-feather="home" class="fea icon-sm_ icon_sm" style="position: relative; top: 3px;"></i></a>
        </div>

        <?php
        $noConnection=""; $noConnection1="";
        if (!@fopen("https://facebook.com", "r")){ // if NO connection
            $fb_login_url = "javascript:;";
            $noConnection = "noConnection";

            unset($_SESSION['myaccess_tokens']);
        }else{
            require ('fb-init.php');
        }

        if (!@fopen("https://twitter.com", "r")){ // if NO connection
            $twitter_url = "javascript:;";
            $noConnection1 = "noConnection";

            unset($_SESSION['twitter_access_token']);
        }else{
            require ('twi-init.php');
        }
        ?>

        <section class="bg-home bg-homes d-flex align-items-center">
            <div class="container p-xs-10">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-5 mt-sm-10 p-0">
                        <div class="mr-lg-5 fixeds_">
                            <img src="<?=base_url()?>images/user/signup.png" class="img-fluid d-blocks mx-auto reg_img" style="display: none;" alt="">
                            
                             <img src="<?=base_url()?>images/user/login.png" class="img-fluid d-blocks mx-auto login_img" style="display: none;" alt="">

                            <img src="<?=base_url()?>images/user/recovery.png" class="img-fluid d-blocks mx-auto reset_img" style="display: none;" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-7 mt-sm-0 pt-sm-0 mt-30">
                        
                        <div class="card div_reg shadow rounded border-0 mb-40 mt-50 mt-xs-0" style="display: none;">
                            <div class="card-body p-30 p-xs-20">
                                <h4 class="card-title text-center">Create Account</h4>  
                                <form class="login-form mt-3 form_register" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-6 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Nickname <span class="text-danger">*</span></label> -->
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input type="text" class="form-control pl-30" placeholder="Username *" name="txtnick" required="" style="text-transform: capitalize;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Phone <span class="text-danger">*</span></label> -->
                                                <i data-feather="phone" class="fea icon-sm icons"></i>
                                                <input type="number" class="form-control pl-30" placeholder="Phone *" name="txtphone" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Your Email <span class="text-danger">*</span></label> -->
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" class="form-control pl-30" placeholder="Email *" name="email" id="email" required="" style="text-transform: lowercase;">
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Password <span class="text-danger">*</span></label> -->
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control pl-30" placeholder="Password *" required="" name="txtpass">
                                            </div>
                                        </div>

                                        <?php $rands = rand(1000, 9000); ?>
                                        <input type="hidden" name="txtsum1" value="<?=$rands?>">

                                        <div class="col-md-12 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Enter Code <span class="text-danger">*</span></label> -->
                                                <i data-feather="lock" class="fea icon-sm icons"></i>
                                                <input type="number" class="form-control pl-30" placeholder="Enter this Code <?=$rands?> *" name="txtmaths" required="">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control pl-30" placeholder="Confirm Password" required="">
                                            </div>
                                        </div> -->
                                        <div class="col-md-12 mt-10" style="text-align: center;">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
                                                    <label class="custom-control-label" for="customCheck2">I Accept <a href="<?=base_url()?>terms-of-use/#terms" class="text-primary">Terms And Condition</a></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-5">
                                            <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                            <?php if($this->myID==""){ ?>
                                                <button class="btn btn-primary btn-block cmd_signup">Create Account</button>
                                            <?php }else{ ?>
                                                <button class="btn btn-primary btn-block loggedin" style="opacity: 0.5">Create Account</button>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 mt-4 text-center">
                                            <h6>Or Signup With</h6>
                                            <ul class="list-unstyled social-icon mb-0 mt-2">
                                                <li class="list-inline-item">
                                                    <?php if(isset($fb_login_url)){ ?>
                                                        <?php if($this->myID==""){ ?>
                                                            <a href="<?=$fb_login_url?>" class="rounded <?=$noConnection?>"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>

                                                        <?php }else{ ?>
                                                            <a href="javascript:;" style="opacity: 0.5" class="rounded loggedin"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php } ?>

                                                    <?php }else{ ?>
                                                        <a href="javascript:;" style="opacity: 0.5" class="rounded loggedin"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>
                                                    <?php } ?>
                                                </li>

                                                <li class="list-inline-item">
                                                   <?php if(isset($twitter_url)){ ?>
                                                        <?php if($this->myID==""){ ?>
                                                            <a href="<?=$twitter_url?>" class="rounded <?=$noConnection1?>"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php }else{ ?>
                                                            <a href="javascript:;" style="opacity: 0.5" class="rounded <?=$noConnection1?> loggedin"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <a href="javascript:;" style="opacity: 0.5" class="rounded <?=$noConnection1?> loggedin"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="mb-0"><small class="text-dark mr-2">Already have an account?</small><a href="javascript:;" class="text-dark font-weight-bold link_login" style="color: #06C !important">Sign in</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="card div_login shadow rounded border-0 mb-40 mt-10 mt-xs--20">
                            <div class="card-body p-30 p-xs-20">
                                <h4 class="card-title text-center">Login Your Credentials</h4>  
                                <form class="login-form mt-4 form_logins">
                                    <div class="row">
                                        <div class="col-md-12 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Email or Phone <span class="text-danger">*</span></label> -->
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" class="form-control pl-30" placeholder="Phone or Email *" name="txtlog_email" id="txtlog_email" style="text-transform: lowercase;" required="">
                                            </div>
                                        </div>

                                        <div class="col-md-12 p-5">
                                            <div class="form-group position-relative">
                                                <!-- <label>Password <span class="text-danger">*</span></label> -->
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control pl-30" placeholder="Password *" required="" name="txtlog_pass" id="txtlog_pass">
                                            </div>
                                        </div>

                                        
                                        <div class="col-lg-12 mt-10">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1" checked>
                                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                    </div>
                                                </div>
                                                <p class="forgot-pass mb-0"><a href="javascript:;" class="text-muted font-weight-bold link_forgot">Forgot password?</a></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-5">
                                            <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                            <?php
                                                if($this->myID==""){
                                                    echo '<button class="btn btn-primary btn-block cmd_login">Sign In</button>';
                                                }else{
                                                    echo '<button class="btn btn-primary btn-block loggedin" style="opacity: 0.5">Sign In</button>';
                                                }
                                            ?>
                                        </div>

                                        <div class="col-lg-12 mt-4 text-center">
                                            <h6>Or SignIn With</h6>
                                            <ul class="list-unstyled social-icon mb-0 mt-2">

                                                <li class="list-inline-item">
                                                    <?php if(isset($fb_login_url)){ ?>
                                                        <?php if($this->myID==""){ ?>
                                                            <a href="<?=$fb_login_url?>" class="rounded <?=$noConnection?>"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>

                                                        <?php }else{ ?>
                                                            <a href="javascript:;" style="opacity: 0.5" class="rounded loggedin"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php } ?>

                                                    <?php }else{ ?>
                                                        <a href="javascript:;" style="opacity: 0.5" class="rounded loggedin"><i data-feather="facebook" class="fea icon-ex-md fea-social"></i></a>
                                                    <?php } ?>
                                                </li>

                                                <li class="list-inline-item">
                                                   <?php if(isset($twitter_url)){ ?>
                                                        <?php if($this->myID==""){ ?>
                                                            <a href="<?=$twitter_url?>" class="rounded <?=$noConnection1?>"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php }else{ ?>
                                                            <a href="javascript:;" style="opacity: 0.5" class="rounded <?=$noConnection1?> loggedin"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <a href="javascript:;" style="opacity: 0.5" class="rounded <?=$noConnection1?> loggedin"><i data-feather="twitter" class="fea icon-ex-md fea-social"></i></a>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mx-auto mb-20">
                                            <p class="mb-0"><small class="text-dark mr-1">Don't have an account?</small><a href="javascript:;" class="text-dark font-weight-bold link_reg" style="color: #06C !important">Sign Up</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="card div_forgot shadow rounded border-0 mb-40 mt-0">
                            <div class="card-body p-30 p-xs-20">
                                <h4 class="card-title text-center">Recover Account</h4>  
                                <form class="login-form mt-2 form_resets" autocomplete="off">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="text-dark text-center" style="line-height: 21px;">Please enter your email address. You will receive a link to create a new password via email.</p>
                                            <div class="form-group position-relative">
                                                <!-- <label>Email address <span class="text-danger">*</span></label> -->
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" class="form-control pl-5" placeholder="Enter your email address" name="txtemail2" id="txtemail2" required="" style="text-transform: lowercase;">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-20">
                                            <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                            <button class="btn btn-primary btn-block cmd_resets">Reset Password</button>
                                        </div>
                                        <div class="mx-auto">
                                            <p class="mb-0 mt-3"><small class="text-dark mr-2">Remember your password?</small><a href="javascript:;" class="text-dark font-weight-bold link_login" style="color: #06C !important">Sign in</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                        <div class="card sec_form_resp shadow rounded border-0 mb-40 mt-0" style="display: none; text-align: center;">
                            <div class="card-body pr-20 pl-20 pr-sm-0 pl-sm-0">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                </svg>
                              <h4 style="color: #093; margin-top:8px; font-weight: 700;">Reset Password</h4>
                              <p style="margin: -2px 0 -7px 0; line-height: 22px;">
                                <span style="color: #333; font-size: 15.5px;">
                                  A code has been sent to your email address, please check your email or spam messages, copy the code and click on the reset link there. Thank you!
                                </span>
                              </p>

                                <div class="col-lg-12 mt-30 mb-20">
                                    <button class="btn btn-primary btn-block cmd_done">Done</button>
                                </div>

                            </div>
                        </div>


                        <div class="card form-wrap success_info shadow rounded border-0 mb-40 mt-0" style="display: none;">
                            <div class="card-body">
                                <h4 class="text-white text-center" style="color: #093 !important">Welcome to iContest</h4>     
                                
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                </svg>

                                <p class="mt-20 mb-10" style="font-size: 18px; color: #333 !important;"><b>Your Registration Was Successful</b></p>
                                <p class="m-0" style="color: #333 !important; font-size: 15.5px; line-height: 22px;">Your details have been registered successfully, Please click the button below to complete your profile. Thank you</p>

                                <div class="col-lg-12 mt-30 mb-20">
                                    <button class="btn btn-primary btn-block cmd_done_reg">Done</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

  

        <!-- javascript -->
        <script src="<?=base_url()?>js/jquery-3.4.1.min.js"></script>
        <script src="<?=base_url()?>js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>js/jquery.easing.min.js"></script>
        <script src="<?=base_url()?>js/scrollspy.min.js"></script>
        <!-- Icons -->
        <script src="<?=base_url()?>js/feather.min.js"></script>
        <script src="<?=base_url()?>js/unicons-monochrome.js"></script>
        <!-- Switcher -->
        <script src="<?=base_url()?>js/switcher.js"></script>
        <!-- Main Js -->
        <script src="<?=base_url()?>js/app.js"></script>
        <script src="<?=base_url()?>js/jscripts.js"></script>

        <script src="<?=base_url()?>plugins/sweetalert/sweetalert.min.js"></script>
        <script src="<?=base_url()?>js_adm/dialogs.js"></script>

    </body>

</html>