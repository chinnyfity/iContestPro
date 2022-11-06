
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Reset Your Password - Have Fun & Win Big</title>

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

    <button class="btn btn-primary waves-effect btn_sweet_art" style="display: none;" data-type="success" data-msg="<?=$datamsg?>">CLICK ME</button>

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

    <section class="bg-home d-flex align-items-center">
        <div class="container p-xs-10">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-5 mt-sm-10 p-0">
                    <div class="mr-lg-5 fixeds_">
                        <img src="<?=base_url()?>images/user/recovery.png" class="img-fluid d-block mx-auto reset_img" alt="">
                    </div>
                </div>


                <div class="col-lg-5 col-md-7 mt-sm-20 pt-sm-0 mt-30">
                    <div class="card div_login shadow rounded border-0 mb-40 mt-10 mt-xs--20">
                        <div class="card-body p-30 p-xs-20">
                            <h4 class="card-title text-center">Reset Your Password</h4>
                            <form class="login-form mt-4 reset_form">
                                <div class="row">
                                    <div class="col-md-12 p-5">
                                        <div class="form-group position-relative">
                                            <label>Type Code <span class="text-danger">*</span></label>
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input type="number" class="form-control pl-30" placeholder="Type code from email" name="txtcode1" id="txtcode1" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-12 p-5">
                                        <div class="form-group position-relative">
                                            <label>New Password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control pl-30" placeholder="Password" required="" name="txtrpass1" id="txtrpass1">
                                        </div>
                                    </div>

                                    <div class="col-md-12 p-5">
                                        <div class="form-group position-relative">
                                            <label>Confirm Password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control pl-30" placeholder="Confirm Password" required="" name="txtrpass2" id="txtrpass2">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 mt-15 mb-30">
                                        <div class="alert alert-danger alert_msgs alert_msg1"></div>
                                            <button class="btn btn-primary btn-block cmd_res_pass1">Reset Password</button>
                                    </div>
                                </div>
                            </form>
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