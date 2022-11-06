<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="<?=base_url()?>images/logo1.png" rel="shortcut icon" type="image/png">
    <title>Sign In | Administrator</title>

    <link href="<?=base_url()?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?=base_url()?>css1/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css1/style.css" rel="stylesheet">

    <style type="text/css">
        body, html{
            background: #16171D !important;
            height: 70vh;
        }
    </style>
</head>

<body class="login-page">
	<input type="hidden" value="<?=base_url();?>" id="txtsite_url">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>iContest<span style="color:#E91E63">PRO</span></b> Admin</a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" class="login_form" method="post" autocomplete="off">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <div class="form-line">
                            <input type="text" style="text-transform: lowercase;" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </span>
                        <div class="form-line">
                            <input type="password" style="text-transform: lowercase;" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>

                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink cmd_login_admin" type="button">SIGN IN</button>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="alert alert-danger alert_msgs alert_msg1"></div>
                    <!-- <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=base_url()?>js/jscripts.js"></script>
</body>

</html>