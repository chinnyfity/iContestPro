<?php
define('CONSUMER_KEY', 'lhGWL0kzSHGSMXR1GMdZDD6Tu');
define('CONSUMER_SECRET', 'YdL4wrb6gN7QiTxsiaXQ3KErDNNn8Fq0yU1JFFF8BLioZXmXzB');
define('OAUTH_CALLBACK', 'https://icontestpro.com/register/');


// require config and twitter helper
//require 'config.php';
require 'twitter-login-php/autoload.php';

// use our twitter helper
use Abraham\TwitterOAuth\TwitterOAuth;

if ( isset( $_SESSION['twitter_access_token'] ) && $_SESSION['twitter_access_token'] ) { // we have an access token
	$isLoggedIn = true;	

} elseif ( isset( $_GET['oauth_verifier'] ) && isset( $_GET['oauth_token'] ) && isset( $_SESSION['oauth_token'] ) && $_GET['oauth_token'] == $_SESSION['oauth_token'] ) { // coming from twitter callback url
	// setup connection to twitter with request token
	$connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
	
	// get an access token
	$access_token = $connection->oauth( "oauth/access_token", array( "oauth_verifier" => $_GET['oauth_verifier'] ) );

	// save access token to the session
	$_SESSION['twitter_access_token'] = $access_token;

	// user is logged in
	$isLoggedIn = true;

} else { // not authorized with our app, show login button
	// connect to twitter with our app creds
	$connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET );

	// get a request token from twitter
	$request_token = $connection->oauth( 'oauth/request_token', array( 'oauth_callback' => OAUTH_CALLBACK ) );

	// save twitter token info to the session
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	// user is logged in
	$isLoggedIn = false;
}

if ( $isLoggedIn ) { // logged in
	// get token info from session
	$oauthToken = $_SESSION['twitter_access_token']['oauth_token'];
	$oauthTokenSecret = $_SESSION['twitter_access_token']['oauth_token_secret'];

	// setup connection
	$connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $oauthToken, $oauthTokenSecret );

	// user twitter connection to get user info
	$user = $connection->get( "account/verify_credentials", ['include_email' => 'true'] );

	if ( property_exists( $user, 'errors' ) ) { // errors, clear session so user has to re-authorize with our app
    	$_SESSION = array();
    	header( 'Refresh:0' );
    } else { // display user info in browser
    	
    	$sess_name = $user->name;
	    $sess_name1 = str_replace(" ", "", $sess_name);
	    $myids = $user->id;
	    $myids1 = substr($myids, -4);
	    $names1 = explode(' ', $sess_name);
		$txtnick = $names1[0];
		$mybio = $user->description;

		if($user->screen_name!="" || isset($user->screen_name))
	    	$email = strtolower($user->screen_name)."@twitter.com";
	    else
	    	$email = strtolower($sess_name1).$myids1."@twitter.com";
	    $txtpass = sha1($user->id);

	    $store_userid = $this->input->cookie('store_userid_icon', TRUE); // referral id
	    
	    $newdata2 = array(
	        'mem_type'      => "mem",
	        'nickname'      => $txtnick,
	        'emails'        => $email,
	        'phone'         => "",
	        'bio'			=> $mybio,
	        'pass1'         => $txtpass,
	        'date_created'  => date("Y-m-d g:i a", time())
	    );

	    $checkifReg = $this->sql_models->hasRegistered($email, $txtpass, 'members');

	    if(!$checkifReg){ // if not in database then login and store details
		    $memids = $this->sql_models->update_inserts_recs($newdata2, '', 'members');
		    if($memids){

			    if(isset($store_userid) && $store_userid!=""){
			        $vps=100;
			        $this->db->set('vp', "vp+$vps", FALSE);
			        $this->db->where('id', $store_userid);
			        $query2 = $this->db->update('members');

			        $datas = array(
			            'memid'   => $store_userid,
			            'refs'    => $memids
			        );

			        if($query2){
			            $this->db->insert('referrals', $datas);
			            ////delete my ref id on cookie//////
			            $cookie = array(
			                'name'   => 'store_userid_icon',
			                'value'  => '',
			                'expire' => '0',
			                'secure' => FALSE
			            );
			            delete_cookie($cookie);
			            /////////// Add to Master Accounts ////////////
			        }
			    }


			    $words = "twitter";
				if(strpos($email, $words) !== true){ // if i dont have twi on my email then do not send me a mail

		            $mailHeader = "<html>
			        <head>
			            <style id='media-query' type='text/css'>
			                body{
			                    font-size: 16px !important;
			                    font-family: Roboto,Arial,sans-serif;
			                    color: #222;
			                    line-height: 22px;
			                }
			                a{text-decoration:none;}
			                .body_msg{
			                    background: #eee;
			                    padding: 10px 16px;
			                }

			                @media only screen and (max-width:900px) {
			                    img{
			                        width: 100%;
			                    }
			                    body{
			                        font-size: 17.5px !important;
			                    }
			                }
			            </style>
			        </head>
			        <body>
			        <div style='margin-top:0px; text-align:center; width:100%'><img src='".base_url()."images/email_banner.jpg'></div>
			        <div class='body_msg'>";

			        $mailFooter = "<p style='margin-top:10px; font-size: 15px; line-height: 22px;'>
			                    <b>iContestPRO</b><br>
			                    #1 Multiple Contest Platform.<br>
			                    <a href='https://icontestpro.com' style='color:#0066FF' target='_blank'>https://icontestpro.com</a></p>";
			        
			        $mailFooter .= "</div></body></html>";

					//////////////////FOR EMAILS/////////////////////////
						$from = "iContestPRO <no-reply@icontestpro.com>";
						$headers = 'MIME-Version: 1.0'."\r\n";
						$headers .= 'From: '.$from. "\r\n";
						$headers .= 'Content-Type: text/html; charset=iso-8859-1'. "\r\n";
						$headers .= 'X-Mailer: PHP';
						$subj = ucwords($txtnick).", Welcome to iContestPRO";
						$to = $email;

						
						$message_contents = "<p style='margin-top:16px; font-size: 17px;'><b>Dear ".ucwords($txtnick).",</b></p>";
		                $message_contents .= "<p style='margin-top:10px; font-size: 15px; line-height: 20px;'>
		                <b>Welcome to iContestPro</b> - here  we have FUN and win BIG.<br>

		                <b>iContestPRO</b> is an online multiple contest platform.  We host competitions, contests, challenges and reality shows from top brands across the world - this enhances your opportunity to win something BIG repeatedly.</p>

		                <p style='margin-top:10px; font-size: 15px; line-height: 20px;'>
		                <b>What you can do immediately:</b><br>
		                1. Go to your <a href='".base_url()."dashboard/profile/' target='_blank'>profile page</a> and complete your profile accordingly.<br><br>

		                2. <a href='".base_url()."contests/' target='_blank'>Explore live contests</a>, browse through the entries and vote.<br><br>

		                3. Join any Contests, submit an entry and stand a chance to win BIG.</p>

		                <p style='margin-top:10px; font-size: 15px; line-height: 20px;'>Do you have some interesting Contest idea or would like to boost your brand visibility and engagement...<br>
		                Upgrade to Become a Sponsor <a href='".base_url()."dashboard/sponsor/' target='_blank'>Click Here</a> to start</p>

		                <p style='margin-top:10px; font-size: 15px; line-height: 20px;'>We take your security and privacy seriously. Aside securing our site with comodo SSL encryption certificate, we have implemented world's best practices protocol to secure your privacy and information.</p>

		                <p style='margin-top:10px; font-size: 15px; line-height: 20px;'><b>Read here:</b> <a href='#'>Term of Use</a><br>
		                <b>Read here:</b> <a href='#'>Privacy Policy</a><br><br>

		                For help and support, contact admin at <a href='mailto:icontestprobox@gmail.com'>icontestprobox@gmail.com</a><br><br>

		                Thank you!<br>";

		                $message_contents1 = $mailHeader.$message_contents.$mailFooter;
						@mail($to, $subj, $message_contents1, $headers);
					//////////////////FOR EMAILS/////////////////////////
				}
			}
		}

		$now = 2147483647 - time();
	    $cookie = array(
	        'name'   => 'icont_uname',
	        'value'  => sha1($email),
	        'expire' => $now,
	        'secure' => FALSE
	    );
	    $cookie1 = array(
	        'name'   => 'icont_pass',
	        'value'  => $txtpass,
	        'expire' => $now,
	        'secure' => FALSE
	    );
	    set_cookie($cookie);
	    set_cookie($cookie1);


	    $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
	    $retain_page_name = $this->input->cookie('retain_page_name', TRUE);

	    if($retain_page_id1=="")
			header("Location:".base_url()."contests/");
		else
			header("Location:".base_url()."contests/$retain_page_id1/join/$retain_page_name/");

    }
    $twitter_url = "";
} else {  // not logged in, get and display the login with twitter link
	$twitter_url = $connection->url( 'oauth/authorize', array( 'oauth_token' => $request_token['oauth_token'] ) );
}


?>