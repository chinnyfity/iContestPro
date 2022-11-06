<?php
@session_start();
require 'fb-api/vendor/autoload.php';

$fb = new \Facebook\Facebook([
	'app_id'					=>	'1093637257666932',
	'app_secret'				=>	'10228f662c72f786bf073d87f05c3983',
	'default_graph_version'		=>	'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

if(isset($_GET['code'])){

    if(isset($_SESSION['myaccess_tokens'])){
        $access_token = $_SESSION['myaccess_tokens'];
    }else{
        /*$access_token = $helper->getAccessToken();
        $_SESSION['myaccess_tokens'] = $access_token;
        $fb->setDefaultAccessToken($_SESSION['myaccess_tokens']);*/

        try {
		    $access_token = $helper->getAccessToken();
		    $_SESSION['myaccess_tokens'] = $access_token;
		    //$fb->setDefaultAccessToken($_SESSION['myaccess_tokens']);
		} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		    echo "Response Exception: " . $e->getMessage();
		    exit();
		} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		    echo "SDK Exception: " . $e->getMessage();
		    exit();
		}
    }



    //$graph_response = $fb->get("/me?fields=name,email,link,first_name,picture", $access_token);

    try { 
        $graphResponse = $fb->get('/me?fields=name,email', $access_token); 
        $fb_user_info = $graphResponse->getGraphUser();


        $txtnick=""; $email=""; $txtpass="";
	    if(!empty($fb_user_info['name'])){
	        $_SESSION['user_name'] = $fb_user_info['name'];
	    }

	    if(!empty($fb_user_info['email'])){
	    	//this can be NULL if the person hasnt confirmed his/her email address
	        $_SESSION['user_email'] = $fb_user_info['email'];
	    }

	    if(!empty($fb_user_info['id'])){
	        $_SESSION['user_fb_id'] = $fb_user_info['id'];
	    }
	    

	    $sess_name = $_SESSION['user_name'];
	    $sess_name1 = str_replace(" ", "", $sess_name);
	    $myids = $_SESSION['user_fb_id'];
	    $myids1 = substr($myids, -4);
	    $names1 = explode(' ', $sess_name);
		$txtnick = $names1[0];
		if(isset($_SESSION['user_email'])) // this may be null
	    	$email = $_SESSION['user_email'];
	    else
	    	$email = strtolower($sess_name1).$myids1."@facebook.com";
	    $txtpass = sha1($_SESSION['user_fb_id']);
	    //$txtpass = $_SESSION['user_fb_id'];


	    $store_userid = $this->input->cookie('store_userid_icon', TRUE); // referral id
	    
	    $newdata2 = array(
	        'mem_type'      => "mem",
	        'nickname'      => $txtnick,
	        'emails'        => $email,
	        'phone'         => "",
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

			    $words = "facebook";
				if(strpos($email, $words) !== true){ // if i dont have fb on my email then do not send me a mail

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


    } catch(FacebookResponseException $e) { 
        echo 'Graph returned an error: ' . $e->getMessage(); 
        session_destroy(); 
        // Redirect user back to app login page 
        header("Location: register/"); 
        exit; 
    } catch(FacebookSDKException $e) { 
        echo 'Facebook SDK returned an error: ' . $e->getMessage(); 
        exit; 
    }


    
    $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
    $retain_page_name = $this->input->cookie('retain_page_name', TRUE);

    if($retain_page_id1=="")
		header("Location:".base_url()."contests/");
	else
		header("Location:".base_url()."contests/$retain_page_id1/join/$retain_page_name/");

	$fb_login_url = "";
}else{
	$permissions = ['email'];
    $fb_login_url = $helper->getLoginUrl("https://icontestpro.com/register/", $permissions);
}


?>