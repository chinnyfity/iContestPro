<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {

    public $xauth;
    public $show_name;

    public function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie'));
        //$this->load->library(array('form_validation', 'security', 'pagination', 'session', 'encrypt', 'Compress', 'nativesession'));
        $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'Compress', 'nativesession'));
        $this->load->library('controller_list');
        
        $this->perPage = 20;
        $this->form_validation->set_message('valid_email', 'Invalid email entered');
        $this->form_validation->set_message('alpha_space', 'Invalid name entered');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        //$this->form_validation->set_message('max_length', 'The field "%s" is too long, cant\'t proceed!');
        $this->form_validation->set_message('regex_match[/^[0-9]{6,11}$/]', 'Phone must contain numbers and a maximum of 11 digits!');
        $this->load->model('sql_models');

        $getvals = "";
        foreach ($this->controller_list->getControllers() as $values) {
            foreach ($values as $key => $value) {
                if($value!="xmode")
                    $getvals .= "$value,";
            }
        }
        $this->getvals1 = explode(',', $getvals);

        /* $checkExpiredContest = $this->sql_models->checkExpiredContest();
        $sendMailToWinners = $this->sql_models->sendMailToWinners($checkExpiredContest);
        print_r($sendMailToWinners); exit; */

        
        @date_default_timezone_set('Africa/Lagos');

        $this->mailHeader = "<html>
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


        $this->mailFooter = "<p style='margin-top:10px; font-size: 15px; line-height: 22px;'>
                    <b>iContestPRO</b><br>
                    #1 Multiple Contest Platform.<br>
                    <a href='https://icontestpro.com' style='color:#0066FF' target='_blank'>https://icontestpro.com</a></p>";
        
        $this->mailFooter .= "</div></body></html>";

        function kilomega( $val ) {
            if( $val < 1000 ) return $val;
            $val = round((float)($val/1000),1);
            if( $val < 1000 ) return "${val}k";
            $val = round((float)($val/1000),1);
            return "${val}m";
        }

        //echo kilomega(2455);



        if($this->getMemName()){
            $myfullname = $this->getMemName()['names'];
            $names1 = explode(' ', $myfullname);
            $fname1 = $names1[0];

            $this->myID = $this->getMemName()['id'];
            //$this->myRef = $this->getMemName()['referral'];
            $this->get_first_name = $fname1;
            $this->approved = $this->getMemName()['approved'];
            $this->myfullname = ucwords($myfullname);
            $this->myfullname1 = ucwords($myfullname);
            $this->my_mem_type = $this->getMemName()['mem_type'];
            $this->online_visibility = $this->getMemName()['online_visibility'];
            $this->mymail = $this->getMemName()['emails'];
            $this->pics = $this->getMemName()['pics'];
            $this->citys = $this->getMemName()['citys'];
            $this->states = $this->getMemName()['states'];
            $this->phone_visible = $this->getMemName()['phone_visible'];
            $this->nickname = ucfirst($this->getMemName()['nickname']);
            if(strlen($this->myfullname)<=3) $this->myfullname = $this->nickname;
            $this->wallets1 = $this->getMemName()['wallet'];
            $this->wallets = @number_format($this->getMemName()['wallet']);
            $this->vps = $this->getMemName()['vp'];
            $this->myphone = $this->getMemName()['phone'];
            $this->myemails = strtolower($this->getMemName()['emails']);
            $this->profession = $this->getMemName()['profession'];
            $this->bio = $this->getMemName()['bio'];
            $this->id_card = $this->getMemName()['id_card'];
            $this->agents = $this->getMemName()['agents'];
            $this->utility = $this->getMemName()['utility'];
            $this->has_paid = $this->getMemName()['paid'];
            $this->noOfEntries1 = kilomega($this->sql_models->noOfEntries('entries', $this->myID));
            $this->noOfVotes1 = kilomega($this->sql_models->myTotalVotes('entries', $this->myID, ""));
            //$this->noOfPVS1 = kilomega($this->sql_models->noOfPVS('all_votes', $this->myID));
            $this->noOfPVS1 = $this->getMemName()['vp'];
            $this->fb_id = $this->getMemName()['fb_id'];
            $this->ig_id = $this->getMemName()['ig_id'];
            $this->tw_id = $this->getMemName()['tw_id'];
            $this->social_handles = $this->getMemName()['social_handles'];
            

            //$this->myAds = $this->sql_models->fetchADS('adverts');

            if($this->pics!=''){
                $this->imgs1 = base_url()."profiles/$this->pics";
                $this->yes_file = 1;
            }else{
                $this->imgs1 = base_url()."images/no_passport.jpg";
                $this->yes_file = 0;
            }
            
        }else {
            $this->myID = "";
            $this->agents = "";
            $this->get_first_name = "";
            $this->approved = "";
            $this->myfullname = "";
            $this->my_mem_type = "";
            $this->online_visibility = "";
            $this->mymail = "";
            $this->pics = "";
            $this->citys = 0;
            $this->states = 0;
            $this->nickname = "";
            $this->wallets1 = "";
            $this->phone_visible = 0;
            $this->wallets = 0;
            $this->vps = 0;
            $this->myphone = "";
            $this->myemails = "";
            $this->profession = "";
            $this->bio = "";
            $this->yes_file = 0;
            $this->noOfEntries1 = "";
            $this->noOfVotes1 = "";
            $this->noOfPVS1 = "";
            $this->id_card = "";
            $this->utility = "";
            $this->has_paid = "";
            $this->imgs1 = base_url()."images/no_passport.jpg";
            $this->myAds = "";
        }


        $offset_num1 = 1; $offset_num2 = 2; $offset_num3 = 3;
        if($_SERVER['HTTP_HOST'] == "localhost"){
            $offset_num1 = 2; $offset_num2 = 3; $offset_num3 = 4;
        }

        $uri = $_SERVER['REQUEST_URI'];
        $exploded_uri = explode('/', $uri);
        $this->url0="";
        $this->url0_i="";
        $url1=""; $url2="";
        if(isset($exploded_uri[$offset_num1]) && $exploded_uri[$offset_num1]!=""){
            $this->url0 = $exploded_uri[$offset_num1];
            $this->url0_i = $exploded_uri[$offset_num1]."/";
        }
        if(isset($exploded_uri[$offset_num2]) && $exploded_uri[$offset_num2]!=""){
            $url1 = $exploded_uri[$offset_num2]."/";
        }
        //if($exploded_uri[3]!="") $url1 = $exploded_uri3;
        if(isset($exploded_uri[$offset_num3]) && $exploded_uri[$offset_num3]!="") $url2 = $exploded_uri[$offset_num3]."/";
        $this->url_params = $this->url0_i.$url1.$url2;
            

        //$this->myID = "";

        $this->unread_msg = $this->sql_models->getUnreadMsgCount($this->myID);
        $this->unread_msg1 = $this->sql_models->getUnreadMsgCount1($this->myID);

        $this->sql_models->updateOnlinePresence($this->myID);

        $adminSettings = $this->sql_models->adminSettings();
        $this->entry_fee = $adminSettings['entry_fee'];
        $this->paid_votes = $adminSettings['paid_votes'];
        $this->paid_votes2 = $adminSettings['paid_votes2'];
        $this->paid_votes3 = $adminSettings['paid_votes3'];
        $this->withdraw_fee = $adminSettings['withdraw_fee'];
        $this->transfer_fee = $adminSettings['transfer_fee'];
        $this->be_a_sponsor = $adminSettings['be_a_sponsor'];
        $this->give_referral = $adminSettings['give_referral'];
        $this->contest_fee = $adminSettings['contest_fee'];
        $this->contest_fee2 = $adminSettings['contest_fee2'];
        $this->contest_fee3 = $adminSettings['contest_fee3'];
        $this->cash_back = $adminSettings['cash_back'];
        $this->flutterwave = $adminSettings['flutterwave'];
        $this->ntn = $adminSettings['other_params'];

        $this->size250_1=0;$this->size780_1=0; $this->size300_1=0;$this->size1360_1=0;
        $admAdvSets = $this->sql_models->adminAdvSettings();
        if($admAdvSets){
            $this->size250_1 = $admAdvSets[0]['fees'];
            $this->size780_1 = $admAdvSets[3]['fees'];
            $this->size300_1 = $admAdvSets[6]['fees'];
            $this->size1360_1 = $admAdvSets[9]['fees'];
        }
        



        function hash_password($password){
           return password_hash($password, PASSWORD_BCRYPT);
        }

        function time_ago($date){
            /*$periods=array("sec","min","hr","day","wk","mnth","yr","decade");
            $length=array("60","60","24","7","4.35","12","10");
            //$length = array("60","60","24","30","12","10");

            @$mydate=strtotime($date);
            $currentTime = time();
            if($currentTime >= $mydate) {
                $diff     = time()- $mydate;
                for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
                }

                $diff = round($diff);

                if($diff!=1){
                    $periods[$i].='s';
                }

                return $diff . " " . $periods[$i] . " ago ";
            }else{
                return "offline";
            }*/


            $time_ago = strtotime($date);
            $cur_time   = time();
            $time_elapsed   = $cur_time - $time_ago;
            $seconds    = $time_elapsed ;
            $minutes    = round($time_elapsed / 60 );
            $hours      = round($time_elapsed / 3600);
            $days       = round($time_elapsed / 86400 );
            $weeks      = round($time_elapsed / 604800);
            $months     = round($time_elapsed / 2600640 );
            $years      = round($time_elapsed / 31207680 );

            // Seconds
            if($seconds <= 60){
                return "just now";
            }
            //Minutes
            else if($minutes <= 60){
                if($minutes==1){
                    return "1 min ago";
                }
                else{
                    return "$minutes mins ago";
                }
            }
            //Hours
            else if($hours <= 24){
                if($hours==1){
                    return "1 hr ago";
                }else{
                    return "$hours hrs ago";
                }
            }
            //Days
            else if($days <= 7){
                if($days==1){
                    return "yesterday";
                }else{
                    return "$days days ago";
                }
            }
            //Weeks
            else if($weeks <= 4.3){
                if($weeks==1){
                    return "1 wk ago";
                }else{
                    return "$weeks wks ago";
                }
            }
            //Months
            else if($months <=12){
                if($months==1){
                    return "1 mnth ago";
                }else{
                    return "$months mnths ago";
                }
            }
            //Years
            else{
                if($years==1){
                    return "1 yr ago";
                }else{
                    return "$years yrs ago";
                }
            }
        }


        function cleanStr($string) {
           $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }


        function cleanStrInputs($string) {
           $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9_\-\@\.]/', '', $string); // Removes special chars.
        }

        function cleanStrInputsDash($string) {
           $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9_\-\@\.]/', '', $string); // Removes special chars.
        }


        function convertTime($difference){
            $days = intval($difference / 86400); 
            $difference = $difference % 86400;
            $hours = intval($difference / 3600)+($days*24); 
            $difference = $difference % 3600;
            $minutes = intval($difference / 60);
            $difference = $difference % 60;
            $seconds = intval($difference); 
            $check_zero = $days;
            if($check_zero<=0)
                return ("<font style='font-size:14px;'>".$hours."hrs</font>");
            else
                return ($days." Days");
        }



        function watermark_image($target, $wtrmrk_file, $newcopy) {
            $watermark = imagecreatefrompng($wtrmrk_file);
            imagealphablending($watermark, false);
            imagesavealpha($watermark, true);
            $img = @imagecreatefromjpeg($target);
            $img_w = @imagesx($img);
            $img_h = @imagesy($img);
            $wtrmrk_w = imagesx($watermark);
            $wtrmrk_h = imagesy($watermark);
            $dst_x = ($img_w / 1.03) - ($wtrmrk_w / 1.03); // For centering the watermark on any image
            $dst_y = ($img_h / 11) - ($wtrmrk_h / 11); // For centering the watermark on any image
            @imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
            //@imagejpeg($img, $newcopy, 100);
            
            if ($newcopy<>'') {
                @imagejpeg($img, $newcopy, 67);
            } else {
                header('Content-Type: image/jpeg');
                @imagejpeg($img, null, 67);
            };
            @imagedestroy($img);
            @imagedestroy($watermark);
        }

        


        function convertTime1($difference){
            $days = intval($difference / 86400); 
            $difference = $difference % 86400;
            $hours = intval($difference / 3600 % 24);
            $difference = $difference % 3600;
            $minutes = intval($difference / 60); 
            $difference = $difference % 60;
            $seconds = intval($difference);

            /*$distance = floatval($difference);
            $days = floatval($distance / (1000 * 60 * 60 * 24));
            $hours = floatval(($distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            $minutes = floatval(($distance % (1000 * 60 * 60)) / (1000 * 60)); 
            $seconds = floatval(($distance % (1000 * 60)) / 1000);*/ 

            $check_zero = $days;
            if($check_zero<=0 && $hours>0)
                return ("$hours"."hrs, $minutes"."mins time");
            else if($check_zero<=0 && $hours<=0 && $minutes>0 && $seconds>0)
                return ("$hours"."hrs, $minutes"."mins time");
            else if($check_zero<=0 && $hours<=0 && $minutes<=0 && $seconds<=0)
                return ("<font style='color:#009D27'>Completed</font>");
            else
                return ("$days days time");
        }


        function convertTime2($difference){
            $days = intval($difference / 86400); 
            $difference = $difference % 86400;
            $hours = intval($difference / 3600 % 24);
            $difference = $difference % 3600;
            $minutes = intval($difference / 60); 
            $difference = $difference % 60;
            $seconds = intval($difference);
            //$distance = floatval($difference) - floatval(time());

            /*$distance = intval($difference);
            $days = intval(floatval($distance / (1000 * 60 * 60 * 24)));
            $hours = intval(floatval(($distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            $minutes = intval(floatval(($distance % (1000 * 60 * 60)) / (1000 * 60)));
            $seconds = intval(floatval(($distance % (1000 * 60)) / 1000));*/

            $check_zero = $days;
            if($check_zero<=0 && $hours>0)
                return ("$hours"."hrs, $minutes"."mins time");
            else if($check_zero<=0 && $hours<=0 && $minutes>0 && $seconds>0)
                return ("$hours"."hrs, $minutes"."mins time");
            else if($check_zero<=0 && $hours<=0 && $minutes<=0 && $seconds<=0)
                return ('<font style="color:#009D27">Completed</font>');
            else
                //return ("$hours"."hrs, $minutes"."mins time");
                return ("$days"."Days $hours"."Hrs $minutes"."Mins");
        }


        $ua = $this->getBrowser();
        $usragn = strtolower($ua['userAgent']);
        preg_match('#\((.*?)\)#', $usragn, $match);
        $vars = $match[1];
        if(strpos($vars, "build") !== false){
            $truncate_var = substr($vars, 0, strpos($vars, "build"));
        } else{
            $truncate_var = $vars;
        }
        $truncate_var1 = str_replace(" u;", "", trim($truncate_var));
        $ipaddrs = $truncate_var1;

        $this->sql_models->record_visitors($ipaddrs);



    
    }


    function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        // First get the platform?
        if (preg_match('/android/i', $u_agent)) {
          $platform = 'android';
        }else if (preg_match('/linux/i', $u_agent)) {
          $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
          $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
          $platform = 'windows';
        }
    
        $ub="Firefox";
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
          $bname = 'Internet Explorer';
          $ub = "MSIE";
        } elseif(preg_match('/Firefox/i',$u_agent)) {
          $bname = 'Mozilla Firefox';
          $ub = "Firefox";
        } elseif(preg_match('/Chrome/i',$u_agent)) {
          $bname = 'Google Chrome';
          $ub = "Chrome";
        } elseif(preg_match('/Safari/i',$u_agent)) {
          $bname = 'Apple Safari';
          $ub = "Safari";
        } elseif(preg_match('/Opr|Opera/i',$u_agent) || preg_match('/Opera/i',$u_agent)) {
          $bname = 'Opera';
          $ub = "Opera";
        } elseif(preg_match('/Netscape/i',$u_agent)) {
          $bname = 'Netscape';
          $ub = "Netscape";
        }

        //echo $ub."===<br><br>";
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
          // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
          //we will have two since we are not using 'other' argument yet
          //see if version is before or after the name
          if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
          } else {
            $version= @$matches['version'][1];
          }
        } else {
          $version= $matches['version'][0];
        }
        
        // check if we have a number
        if ($version==null || $version=="") {$version="?";}
      return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
        );
    }


    function is_mobile() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
        $mobile_agents = Array(
            "240x320",
            "acer",
            "acoon",
            "acs-",
            "abacho",
            "ahong",
            "airness",
            "alcatel",
            "amoi", 
            "android",
            "anywhereyougo.com",
            "applewebkit/525",
            "applewebkit/532",
            "asus",
            "audio",
            "au-mic",
            "avantogo",
            "becker",
            "benq",
            "bilbo",
            "bird",
            "blackberry",
            "blazer",
            "bleu",
            "cdm-",
            "compal",
            "coolpad",
            "danger",
            "dbtel",
            "dopod",
            "elaine",
            "eric",
            "etouch",
            "fly " ,
            "fly_",
            "fly-",
            "go.web",
            "goodaccess",
            "gradiente",
            "grundig",
            "haier",
            "hedy",
            "hitachi",
            "htc",
            "huawei",
            "hutchison",
            "inno",
            "ipad",
            "ipaq",
            "ipod",
            "jbrowser",
            "kddi",
            "kgt",
            "kwc",
            "lenovo",
            "lg ",
            "lg2",
            "lg3",
            "lg4",
            "lg5",
            "lg7",
            "lg8",
            "lg9",
            "lg-",
            "lge-",
            "lge9",
            "longcos",
            "maemo",
            "mercator",
            "meridian",
            "micromax",
            "midp",
            "mini",
            "mitsu",
            "mmm",
            "mmp",
            "mobi",
            "mot-",
            "moto",
            "nec-",
            "netfront",
            "newgen",
            "nexian",
            "nf-browser",
            "nintendo",
            "nitro",
            "nokia",
            "nook",
            "novarra",
            "obigo",
            "palm",
            "panasonic",
            "pantech",
            "philips",
            "phone",
            "pg-",
            "playstation",
            "pocket",
            "pt-",
            "qc-",
            "qtek",
            "rover",
            "sagem",
            "sama",
            "samu",
            "sanyo",
            "samsung",
            "sch-",
            "scooter",
            "sec-",
            "sendo",
            "sgh-",
            "sharp",
            "siemens",
            "sie-",
            "softbank",
            "sony",
            "spice",
            "sprint",
            "spv",
            "symbian",
            "tablet",
            "talkabout",
            "tcl-",
            "teleca",
            "telit",
            "tianyu",
            "tim-",
            "toshiba",
            "tsm",
            "up.browser",
            "utec",
            "utstar",
            "verykool",
            "virgin",
            "vk-",
            "voda",
            "voxtel",
            "vx",
            "wap",
            "wellco",
            "wig browser",
            "wii",
            "windows ce",
            "wireless",
            "xda",
            "xde",
            "zte"
        );
    
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }


    public function compatibility(){
        $data['page_title'] = "Compatibility Issues";
        $data['page_name'] = "compatibility";
        $this->load->view("errors", $data);
    }


    public function isCompatible(){
        $ua = $this->getBrowser();
        if($this->is_mobile()) $devices = "mobile"; else $devices = "not_mobile";
        $brow_name = strtolower($ua['name']); $brow_version = $ua['version'];

        /*if(($devices=="mobile" && $brow_name=="opera" && ($brow_version=="Mini" || $brow_version<4)) || ($devices=="not_mobile" && $brow_version<15) ){
            return true;
        }*/
        if(($devices=="mobile" && $brow_name=="opera" && ($brow_version=="Mini" || (int)$brow_version<15))){
            return true;
        }
    }



    function send_mail($from_email, $to_email, $from_name, $messages, $subj){
        $this->load->library('email');
        $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'apikey',
          'smtp_pass' => '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',
          //'smtp_port' => 465,
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        ));

        $this->email->set_mailtype("html");
        $this->email->from($from_email, $from_name);
        $this->email->to($to_email);
        $this->email->subject($subj);
        $this->email->message($messages);

        if($this->email->send())
            return true;
        else
            return false;
    }


    function compress($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
        imagejpeg($image, $destination, $quality);
        return $destination;
    }



    public function resizeImage($source_path, $target_path, $widths, $heights, $maintain_ratio){
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => $maintain_ratio,
          'width' => $widths,
          'height' => $heights,
      );
      $this->load->library('image_lib');
      $this->image_lib->initialize($config_manip);

      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }
      $this->image_lib->clear();
   }



    function validateMemberAuth(){
        return $this->sql_models->validateMember();
    }

    function checkExpiry($id){
        return $this->sql_models->checkExpiry($id);
    }

    function checkSubExpiry($id){
        return $this->sql_models->checkSubExpiry($id);   
    }

    function getMemName(){
        return $this->sql_models->getMemDetails();
    }



    public function index(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Have Fun and Win BiG";
        $data['page_name'] = "";
        $data['page_header'] = "";
        $ipaddrs = $_SERVER['REMOTE_ADDR'];
        $sorts = $this->input->cookie('sorts', TRUE);
        $data['contests'] = $this->sql_models->fetchRecs('contests', '', '', '', 8, '');
        /*$data['reg_mem_cnt'] = $this->sql_models->calCounts('members', '', '', '');
        $data['cur_contestants_cnt'] = $this->sql_models->calCounts('entries', 'contestant_id', 'members', '');
        $data['winners_cnt'] = $this->sql_models->calCounts('winners', '', '', '');
        $data['media_cnt'] = $this->sql_models->calCounts('entry_media', '', '', '');
        $data['visitors'] = $this->sql_models->calCounts('visitors', '', '', '');*/
        $data['reg_conts_cnt'] = $this->sql_models->calCounts('contests', '', '', '');
        $this->load->view("header", $data);
        $this->load->view("index", $data);
        $this->load->view('footer', $data);
    }



    public function profile(){
        if($this->isCompatible()) redirect('compatibility');
        $mem_id = $this->uri->segment(2);
        $mem_id1 = substr($mem_id, 0, -5);

        $model_details = $this->sql_models->fetchAMembers($mem_id1);
        if(!$model_details) redirect('');

        $this->sql_models->updateViews1($mem_id1, 'members');

        $names = ucwords($model_details['names']);
        $nickname = ucwords($model_details['nickname']);
        if(strlen($names)<=2) $names = ucwords($nickname);

        $data['page_title'] = ucwords($names);
        $data['page_name'] = "profile";
        $data['page_header'] = "";
        //echo $this->myID; exit;
        $data['ent_parti'] = $this->sql_models->entryParticipated('entries', $mem_id1);

        $data['mdetls'] = $model_details;
        $this->load->view("header", $data);
        $this->load->view("single-model", $data);
        $this->load->view('footer', $data);
    }



    public function unsubscribe(){
        $params1 = $this->uri->segment(2);
        $params2 = $this->uri->segment(3);

        $titles="";
        if($params1=="voterscampaign"){
            $titles = "Unsubscribe Vote Campaign";
        }

        $model_details = $this->sql_models->confirmMembers($params2);
        if(!$model_details) redirect('');

        $data['page_title'] = $titles;
        $data['page_name'] = "unsubscribe";
        $this->load->view("pages", $data);
    }




    public function join(){
        if($this->isCompatible()) redirect('compatibility');
        $cid = $this->uri->segment(1);
        $cid1 = substr($cid, 0, -5);
        $contest_details = $this->sql_models->fetchRecs('contests', '', '', $cid1, 1, '');
        if(!$contest_details) redirect('');

        $data['notify_msgs'] = $this->sql_models->fetchNotificatns('all_notifications', $this->myID);
        
        if(isset($data['notify_msgs']))
            $page_ids = $data['notify_msgs'][0]['page_id'];
        else
            $page_ids = 0;
        //$page_ids = substr($page_id, 0, -5);

        $this->sql_models->updateViews1($cid1, 'contests');
        if($page_ids>0)
            $this->sql_models->updateReads_notify($page_ids, 'all_notifications');

        if(!isset($contest_details['title'])) redirect('');

        $data['page_title'] = ucwords($contest_details['title']);
        $data['page_name'] = "join";
        $data['page_header'] = "";
        $data['contestids'] = $cid1;

        $ipaddrs = $_SERVER['REMOTE_ADDR'];

        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');

        $data['hasExpired'] = $this->sql_models->checkVoteExpiry($cid1);

        $data['param1'] = "pages";
        $record=0;
        $recordPerPage = 15;
        //$recordPerPage = 1;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countProducts($cid1, 'entries');
        $recordCount1 = $this->sql_models->countProducts1($cid1, $txtsrch, $txtpre, 'entries');
        $empRecord = $this->sql_models->fetchProducts($cid1, $txtsrch, $txtpre, $record, $recordPerPage, 'entries', '');
        $config['base_url'] = base_url();
        
        ////////////////////
            $config["total_rows"] = $recordCount;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 5;
            
            //$config['full_tag_open'] = '<div class="blogpager blogpager1 mt-sm-10 mb-xs-20 conts_pagn">';
            //$config['full_tag_close'] = '</div>';

            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            
            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 mt-sm-0 mb-xs-20 conts_pagn" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
            
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////
        
        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        $data['recordCount'] = $recordCount;
        $data['recordPerPage'] = $recordPerPage;
        $data['record'] = 1;
        $data['recordCount1'] = $recordCount1;

        $data['products'] = $empRecord;
        $data['sponids'] = $contest_details['user_id'];

        $data['cdetls'] = $contest_details;
        $this->load->view("header", $data);
        $this->load->view("single_page", $data);
        $this->load->view('footer', $data);
    }



    function more_recs($record=0){
        $param1 = "pages";
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');
        $pages1 = $this->input->post('pages1');
        $cid1 = $this->input->post('cid1');
        
        $recordPerPage = 15;
        //$recordPerPage = 2;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }       

        $recordCount = $this->sql_models->countProducts($cid1, 'entries');
        $recordCount1 = $this->sql_models->countProducts1($cid1, $txtsrch, $txtpre, 'entries');
        $empRecord = $this->sql_models->fetchProducts($cid1, $txtsrch, $txtpre, $record, $recordPerPage, 'entries', '');
        $config['base_url'] = base_url().'node/more_recs';
        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 mt-sm-0 mb-xs-20 conts_pagn" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
        ////////////////////

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        if($record<=0) $record=1;
        if($recordCount1<$recordPerPage) $recordPerPage=$recordCount1;

        if($pages1=="mini_entries")
            echo '<div class="container containerx pl-30 pr-50 pr-md-80 pl-sm-0 pr-sm-0">';
        echo '<div class="masonry-grid">';
        if($empRecord){ ?>
            <div class="container p-xs-0" style="color:#333 !important; font-size:16px; text-align:left; margin: 0px 0 24px 0px !important">Total of <?php echo "$record of $recordPerPage of $recordCount";?> entries found</div>

                <?php
                $k1=1;
                foreach ($empRecord as $rs) {
                    $id = $rs['id1'];
                    $names = ucwords(strtolower($rs['names']));
                    $nickname = ucwords(strtolower($rs['nickname']));
                    $nickname_i = ucwords($rs['nickname']);
                    $names1 = strtolower($names);
                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                    if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
                    $names1 = str_replace(" ", "-", $names1);
                    $pics = $rs['pics'];
                    $user_id_spon = $rs['user_id'];
                    $views = $rs['views'];
                    $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                    $online_time = time_ago($online_timing);
                    $citys = $rs['citys1'];
                    $states = $rs['states1'];
                    $memid = $rs['contestant_id'];
                    $contest_id = $rs['contest_id'];
                    $con_id = $rs['con_id'];
                    $nows = substr(time(), -5);
                    $memid_hash = $memid.$nows;
                    $votes = $rs['votes'];
                    $timings3 = $rs['timings'];
                    //$premium = $rs['premium'];
                    $media_type = $rs['media_type'];
                    $c_title = ucwords($rs['title']);
                    $adv_title_f = cleanStr(strtolower($c_title));
                    $views2 = kilomega($rs['views2']);
                    $locs = "$citys, $states";
                    $locs_full = $locs;

                    $title_ = $rs['title'];
                    $company_ads_ = $rs['company_ads'];
                    $files_ = $rs['files'];
                    $con_name = $names;
                    $con_votes = $votes;
                    //$user_id_spon = $rs['user_id'];

                    $rs2 = $this->sql_models->myEntrsMedia($contest_id, $memid);
                    $fid = $rs2['id'];

                    $company_ads1 = $company_ads_;
                    if($company_ads_=="") $company_ads1 = $files_;

                    $getDetails_1 = $this->sql_models->getDetails($user_id_spon);
                    $fb_id1 = $getDetails_1['fb_id'];
                    $ig_id1 = $getDetails_1['ig_id'];
                    $tw_id1 = $getDetails_1['tw_id'];

                    $start_date_contests="(not specified)";
                    if(strlen($rs['start_date_contest'])>3)
                        $start_date_contests = @date("jS M, Y h:i a", strtotime($rs['start_date_contest']));
                    $start_date_contest1 = $rs['start_date_contest'];
                    $close_date_entry = @date("jS M, Y h:i a", strtotime($rs['close_date_entry']));
                    //$close_date_entry1 = $rs['close_date_entry'];

                    $pics_entry_cnt = $this->sql_models->getVidsCounts($con_id, $memid);
                    if($media_type=="pic"){
                        $pics_entry = $this->sql_models->getVids($con_id, $memid, 'arrays');
                        if($pics_entry_cnt<=1){
                            $pics_entry = $this->sql_models->getVids($con_id, $memid, '');
                        }
                    }else{
                        $pics_entry = $this->sql_models->getVids($con_id, $memid, '');
                    }

                    $difference = $timings3 - time();
                    $expirys = convertTime1($difference);

                    if(strlen($locs)>17) $locs = substr($locs, 0, 17)."...";
                    if(strlen($names)>17) $names = substr($names, 0, 17)."...";

                    $mylikes = $this->sql_models->getLikes($contest_id, $memid);
                    $mylikes1 = @number_format($mylikes);

                    $hasliked = $this->sql_models->hasliked($con_id, $memid, $this->myID);
                    $paint_hrt="";
                    if($hasliked==0) $paint_hrt = "-outline";

                    $mycmts = $this->sql_models->getContestantCmts($contest_id, $memid);
                    $mycmts1 = @number_format($mycmts);

                    $views1 = "<a href='javascript:void(0)' style='color:#DD6F00' class='like like_me like_me1$k1' autonum='$k1' contestant_id='$memid' con_id='$con_id' hasliked='$hasliked' mylikes='$mylikes' liker_id='$this->myID'><i class='mdi mdi-heart$paint_hrt mr-2'></i><font>$mylikes1</font></a>";

                    $cmts1 = "<a href='#commentmeup' style='color:#DD6F00' class='commentme comment_me mycomment_div comment_me1$k1 video-play-icon' autonum='$k1' hisname='$nickname' memid='$memid' con_id='$con_id' pics='$pics' mycmts='$mycmts' myid='$this->myID'><i class='fa fa-commenting'></i> <font>$mycmts1</font></a>";

                    $hasExpired = $this->sql_models->checkVoteExpiry($contest_id);
                    $timeToVOte = $this->sql_models->timeToVOte($con_id);
                    
                    $gen_num1=time();
                    $gen_num1=substr($gen_num1,5);

                    $cids = $rs['con_id'];
                    $nows = substr(time(), -5);
                    $ids_hash = $cids.$nows;

                    $url2 = base_url()."profile/$memid_hash/$names1/";
                    $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                    $names_1 = str_replace("&", "and", $names_1);

                    $c_title2 = str_replace("&", "and", $c_title);

                    $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me on *'$c_title2'*, thank you in advance.";

                    $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me on '$c_title2', thank you in advance.";

                    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                    $mychats1 = "";
                    if($this->myID==$memid){
                        $mychats1 = $this->sql_models->noOfChats($this->myID);
                        if($mychats1<=0) $mychats1="";
                    }

                    $mystatus = $this->sql_models->chkOnlinePresence($memid);
                    $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                    if($chechOnlineHidden) // visible
                        $last_seen="<span class='active_o'>active</span>";
                    else
                        $last_seen="<span>hidden</span>";

                    if($mystatus=="ash"){
                        if(strtotime($online_timing)>0){
                            if($chechOnlineHidden) // visible
                                $last_seen="<span>$online_time</span>";
                            else
                                $last_seen="<span>hidden</span>";
                        }else{
                          $last_seen="<span>offline</span>";
                        }
                    }else{
                        if($chechOnlineHidden) // visible
                            $mystatus="green";
                        else
                            $mystatus="ash";
                    }
                ?>

                    <div class="scroll_stop<?=$memid?>"></div>

                    <?php
                    if($pages1=="mini_entries")
                        echo '<div class="grid-container grid_container_entries col-xl-3 col-lg-4 col-md-4 col-sm-4 pl-sm-10 pr-sm-10 mb-sm-30 mb-xs-40 pl-xs-5 pr-xs-5">';
                    else
                        echo '<div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10">';    
                    ?>

                    <!-- <div class="grid-container grid_container_entries col-lg-4 col-md-6 col-sm-6 p-xs-0 mb-sm-30 mb-xs-40 pl-xs-10 pr-xs-10"> -->
                        <div class="grid-img" id1="<?=$id?>">
                            <!-- <div class="chatWithMe" id="chatWithMe<?=$id?>" id1="<?=$id?>">
                                <a href="#chatmeup" class="video-play-icon" hisname="<?=$nickname?>" con_id="<?=$con_id?>" memid="<?=$memid?>" myid="<?=$this->myID?>" pics="<?=$pics?>"><i class="fa fa-comments"></i><?=$mychats1?></a>
                            </div> -->

                            <div class="share_profile" id="share_profile<?=$id?>" id1="<?=$id?>">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><span><i class="fa fa-facebook-f"></i></span></a>
                                    
                                <a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" class="for_desktop1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>
                                
                                <a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" class="for_mobile1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>

                                <a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><span><i class="fa fa-twitter"></i></span></a>
                            </div>

                            <?php if($media_type=="pic"){ ?>
                                <div class="for_eye_view" id="for_eye_view<?=$id?>">
                                    <a href="javascript:;" hrefs="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/" hisname="<?=$nickname_i?>" con_title="<?=$title_?>" con_ads="<?=$company_ads1?>" his_fb="<?=$fb_id1?>" his_ig="<?=$ig_id1?>" his_tw="<?=$tw_id1?>" start_vote="<?=$start_date_contests?>" names="<?=$con_name?>" mycontestid="<?=$contest_id?>" expiry="<?=$expirys?>" autonum="<?=$k1?>" myvotes="<?=@number_format($con_votes)?>" memids="<?=$memid?>" user_id_spon="<?=$user_id_spon?>" myid="<?=$this->myID?>" onpg="profile" caps="Vote <?=$con_name?>" con_id="<?=$con_id?>" fid="<?=$fid?>" memid="<?=$memid?>" pics="<?=$pics?>" scrollstop="<?=$memid?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                                
                                <?php
                                if($pics_entry){
                                    if($pics_entry_cnt>1){ // if its more than 1 pics
                                        echo '<div class="owl-carousel grid-carousel">';
                                        foreach ($pics_entry as $mypics) {
                                            $pics_entry1 = $mypics['files'];
                                            
                                            $ffs = base_url()."media_uploads/$pics_entry1";
                                            $ffs1 = "media_uploads1/$pics_entry1";
                                            $ffs_wm = base_url()."images/logo_watermark.png";
                                            watermark_image($ffs, $ffs_wm, $ffs1);

                                            $pic_pathi = base_url()."media_uploads1/$pics_entry1";
                                            $exts = pathinfo($pic_pathi,PATHINFO_EXTENSION);
                                            if($exts=="mp4") // if its mp4 file
                                                $pic_pathi = base_url()."profiles1/$pics";

                                            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                            if($width1=="" || $width1<=0)
                                                $pic_pathi = base_url()."images/no_passport.jpg";

                                            echo "<img src='$pic_pathi' alt='' />";
                                        }
                                        echo '</div>';

                                    }else{
                                        //echo $pics_entry;
                                        $pic_pathi = base_url()."media_uploads1/$pics_entry";
                                        $width1="";
                                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                        if($width1=="" || $width1<=0){
                                            $pic_pathi = base_url()."profiles1/$pics";

                                            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                            if($width1=="" || $width1<=0)
                                                $pic_pathi = base_url()."profiles/$pics";
                                        }

                                        echo "<img src='$pic_pathi' alt='' />";
                                    }

                                }else{
                                
                                    $pic_pathi = base_url()."media_uploads1/$pics_entry";
                                    $width1="";
                                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                    if($width1=="" || $width1<=0){
                                        $pic_pathi = base_url()."profiles1/$pics";

                                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                                        if($width1=="" || $width1<=0)
                                            $pic_pathi = base_url()."profiles/$pics";
                                    }
                                    
                                    echo "<img src='$pic_pathi' alt='' />";
                                }
                                
                            }else{
                                $ffs = base_url()."profiles/$pics";
                                $ffs1 = "profiles1/$pics";
                                $ffs_wm = base_url()."images/logo_watermark.png";
                                watermark_image($ffs, $ffs_wm, $ffs1);
                                $pic_pathi = base_url()."profiles1/$pics";
                            ?>
                                <div class="vid_play">
                                    <i class="fa fa-play" hisname="<?=$names?>" con_id="<?=$con_id?>" memid="<?=$memid?>" pics="<?=$pics?>" scrollstop="<?=$memid?>"></i>
                                </div>
                                <img src="<?=$pic_pathi?>" alt="" />
                            <?php } ?>

                            <?php if($pages1!="mini_entries"){ ?>
                            <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="contest_names">
                                <?=$c_title?>
                            </a>
                            <?php } ?>

                            <div class="online_status"><font class="<?=$mystatus?>"></font><?=$last_seen?></div>

                        </div>

                        <div class="grid-content grid-content1">
                            <h5><a href="#"><?=$nickname?></a></h5>
                            <p style="margin: -16px 0 0 0 !important">
                                <font class="for_desktop2"><b>From:</b> <?=$locs?></font>
                                <font class="for_mobile2"><b>From:</b> <?=$locs_full?></font>
                                <b>Votes:</b> <font class="vote_counts<?=$contest_id.$memid;?>"><?=@number_format($votes);?></font><br>
                                <?=$views1.$cmts1;?>
                            </p>
                        </div>

                        <!-- <div class="mt--10">
                            <a class="arrow-button arrow-button1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">View Profile</a>
                        </div> -->

                        <div>
                            <?php if($pages1=="mini_entries"){ ?>
                                <span class="voteme_btn<?=$memid?>">
                                    <?php if($hasExpired){ ?>
                                        <a class="arrow-button voteme_exp votedis" id="voteme" href="javascript:;">Vote Me</a>
                                    <?php }else{

                                        if($this->myID == $user_id_spon && $this->myID>0){
                                        ?>
                                            <a class="arrow-button vote_user votedis" id="voteme" href="javascript:;">Vote Me</a>
                                        <?php
                                        }else{ ?>

                                            <?php if($timeToVOte && strlen($start_date_contest1)>3){ ?>
                                                <a class="arrow-button voteme voteme_j<?=$memid?> voteme_i<?=$memid?>" id="voteme" names="<?=$nickname?>" mycontestid="<?=$contest_id?>" autonum="<?=$k1?>" expiry="<?=$expirys?>" myvotes="<?=$votes?>" memids="<?=$memid?>" myid="<?=$this->myID?>" onpg="" caps="Vote Me" href="javascript:;">Vote Me</a>
                                            <?php }else{ ?>
                                                <a class="arrow-button vote_user1 votedis" id="voteme" start_vote="<?=$start_date_contests?>" href="javascript:;">Vote Me</a>
                                            <?php } ?>

                                        <?php
                                        }
                                    }
                                    ?>
                                </span>

                                <a class="arrow-button arrow-button_1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">Profile</a>

                            <?php }else{ ?>

                                <a class="arrow-button arrow-button1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">View Profile</a>
                            <?php } ?>

                        </div>
                    </div>

                <?php
                // break;
                // exit;
                $k1++;
                }
                ?>
            <!-- </div> -->
            
            <?php
            echo "<div style='clear:both'></div>";
            echo $pagination;

        }else{
            echo "<p style='text-align:center; font-size:18px; margin:2em 0 3em 0'>No entries yet!</p>";
        }
        if($pages1=="mini_entries")
            echo '</div>';
    }


    function save_stud_test_start($is_new_rec, $qid_intro){
        $newdata5 = array(
             'my_answers' => "",
             'quizid'     => "",
             'allRandIDs'    => ""
        );
        $this->session->set_userdata($newdata5);

        $newdata3 = array(
            'memid'             => $this->myID,
            'quiz_section_id'   => $qid_intro,
            'started_test'      => 1,
            'attempts'          => 1
        );

        if($is_new_rec == "yes"){

            $this->db->select('attempts')->from('stud_start_test')->where('memid', $this->myID)
            ->where('quiz_section_id', $qid_intro);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                
                $this->db->where('memid', $this->myID)->where('quiz_section_id', $qid_intro);
                $this->db->set('attempts', 'attempts+1', FALSE);
                $rrr = $this->db->update('stud_start_test');

            }else{

                $this->db->insert('stud_start_test', $newdata3);
            }
        }else{

            $this->db->where('memid', $studid)->where('quiz_intro_id', $qid_intro);
            $this->db->set('attempts', "attempts+1", FALSE);
            $query = $this->db->update('stud_start_test');
        }
        return true;
    }



    function start_main_quiz(){
        //$qid_intro = $this->input->post('id1');
        $is_new_rec = "yes";
        $set_time = $this->input->post('set_time');
        $noOfQuest = $this->input->post('noOfQuest');
        $qid_intro = $this->input->post('qid_intro');
        if($this->myID==""){
            echo "not_logged";
            exit;
        }

        if($this->vps < 20){
            echo "insufficient";
            exit;
        }
        $this->save_stud_test_start($is_new_rec, $qid_intro);
        $this->questionDiv('', $qid_intro, $set_time, $noOfQuest, $is_new_rec, '');
    }



    function questionDiv($quizid_taken, $qid_intro, $set_time, $noOfQuest, $is_new_rec, $record=0){ ?>
        <div class="pb-60 pb-sm-40">
            <div class="container pt-0 pr-0 pl-0 pt-xs-10">
                <?php
                $recordPerPage = 1;
                if($record != 0){
                    $record = ($record-1) * $recordPerPage;
                }

                $quiz_quests = $this->sql_models->quizQuestions('', $qid_intro, $record, $recordPerPage);
                $recordCount = $this->sql_models->countQuestions('', $qid_intro);
                $submitted_attempts = $this->sql_models->submitted_attempts($this->myID, $qid_intro);
                //$subj_name = "sssss";

                $config['base_url'] = base_url()."fetch_rand_questions/";

                ////////////////////
                    $config["total_rows"] = $recordCount;
                    $config["per_page"] = $recordPerPage;
                    $config['use_page_numbers'] = TRUE;
                    $config['num_links'] = 2;

                    $config['first_link'] = FALSE;
                    $config['first_tag_open'] = FALSE;
                    $config['first_tag_close'] = FALSE;
                    
                    $config['last_link'] = FALSE;
                    $config['last_tag_open'] = FALSE;
                    $config['last_tag_close'] = FALSE;
                    
                    
                    //Encapsulate whole pagination 
                    $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 blog_pagn" id="pagination_quiz">';
                    $config['full_tag_close'] = '</ul>';

                    $config['prev_link'] = FALSE;
                    $config['prev_tag_open'] = FALSE;
                    $config['prev_tag_close'] = FALSE;


                    //For NEXT PAGE Setup
                    $config['next_link'] = "<span aria-hidden='true' class='next_prev_btn next_prev_btn_no_radius_' id_sch='$qid_intro'>
                        NEXT <span class='fa fa-arrow-right'></span>
                    </span>";

                    $config['cur_tag_open'] = '<li class="page-item active">';
                    $config['cur_tag_close'] = '</li>';

                    $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
                    $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
                ////////////////////

                $this->pagination->initialize($config);
                $pagination = $this->pagination->create_links();


                $id_sch = $qid_intro;
                $qid = $quiz_quests['ids'];
                $questions = ucfirst($quiz_quests['questions']);
                $files = $quiz_quests['files'];
                $op1 = $quiz_quests['op1'];
                $op2 = $quiz_quests['op2'];
                $op3 = $quiz_quests['op3'];
                $op4 = $quiz_quests['op4'];
                $ans1 = $quiz_quests['ans1'];
                $explanations = $quiz_quests['explanations'];
                $op1_1=$op1;
                $op1_2=$op2;
                $op1_3=$op3;
                $op1_4=$op4;

                
                $all_options = array($op1, $op2, $op3, $op4);
                if($op1!="" && $op2!="" && $op3=="" && $op4=="") $all_options = array($op1, $op2);
                if($op1!="" && $op2!="" && $op3!="" && $op4=="") $all_options = array($op1, $op2, $op3);

                $files1i="";
                if($files!=""){
                    $paths = base_url()."quizes/$files";
                    $files1i = "<div style='margin: 5px 0 15px 22px;' class='quiz_img'><img src='$paths' style='width:100%;'></div>";
                }
                ?>

                <div class="col-sm-12 p-0">
                    <div class="quiz_starts" style="display:nones;">
                        <div class="timeset mt-10" style="color: #444; font-size: 18px;"><b>Time Set for this question: <font id='tminus_1'><?php echo "$set_time seconds"; ?></font></b>
                        </div>
                        <!-- <p style="color: #ccc; text-align: center; margin: -16px 0 23px 0; font-size: 15px;">Note that you cannot refresh this timer</p> -->

                        <div style="display:none">
                            <input id="tminus" placeholder="0:00" />
                            <input id="request" value="<?=$set_time;?>" />
                            <a href="javascript:;" class="button enterTime">Submit Time</a>
                            <input type="button" id="resets" value="Clear form" />
                        </div>

                        <input type='hidden' id='txtmember' name='txtmember' value='<?=$this->myID;?>'>
                        <input type='hidden' id='txttotalquiz' name='txttotalquiz' value='<?=$noOfQuest;?>'>
                        <input type='hidden' id='qid_intro' name='qid_intro' value='<?=$qid_intro;?>'>

                        <div class='fade_questions' style='display:nones'></div>

                        <?php
                        $my_ids=substr(@$this->session->userdata('quizid'), 0, -1);
                        $counts = explode(",", $my_ids);
                        $counts1 = count($counts);
                        if($counts1 <= 0) $counts1=1;

                        //if(!$quiz_quests)
                            //echo "<div class='fade_questions'></div>";
                        ?>

                        <input type='hidden' id="txtpage_number" value='<?=$counts1;?>'>

                        <div class="quest_title"><label>Question</label></div>

                        <div class='scroll_inner_quiz' style='text-align:left'>
                            
                            <input type='hidden' name='txtrandom_quiz' id="txtrandom_quiz" value='<?=$qid;?>'>
                            <?php $questions = str_replace(array('<p>', '</p>'), "", $questions); $questions = ucfirst($questions); ?>

                            <ul class='quiz_question'>
                                <li style='font-size:17px; line-height:23px; color:#666; font-weight: 600;'><font id="txtpage_number_h">1.</font> <?=nl2br($questions);?></li>
                            </ul>

                            <?php
                            echo "<ul class='quiz_options' ids='$qid'>";
                                echo $files1i;
                                $k=1;
                                shuffle($all_options);

                                $quizid_taken_ans = @$this->session->userdata('my_answers');
                                $quizid_taken_ans = substr($quizid_taken_ans, 0, -2);
                                $quizid_taken2 = explode("||", $quizid_taken_ans);
                                $quizid_taken2 = array_unique($quizid_taken2);

                                foreach($all_options as $keys){
                                    if($k == 1) $m="<b>A)</b>";
                                    else if($k == 2) $m="<b>B)</b>";
                                    else if($k == 3) $m="<b>C)</b>";
                                    else $m="<b>D)</b>";
                                    $keys1 = ucfirst($keys);

                                    $keys_i = str_replace("+", "&dagger;", $keys);

                                    ?>
                                        <li>
                                        <label for='options<?=$keys?>'>
                                        <label class='container_radio'><b><?=$m?></b> <?=$keys1?>
                                          <input type='radio' name='options1' value='<?=$keys_i?>' class='<?=$keys?> chk' id='options<?=$keys?>' <?php if(in_array($keys, $quizid_taken2)) echo "checked"; ?> ids='<?=$qid?>'>
                                          <span class='checkmark'></span>
                                        </label>
                                        </li>
                                        <?php
                                    $k++;
                                }
                            echo "</ul>";

                            echo $pagination;

                        echo "</div>";

                        echo "<input type='hidden' name='txtans1' value='' id='txtans1' class='txtans1'>";
                        ?>

                        <input type='hidden' id_sch="<?=$id_sch;?>" name='txt_time_finished' id='txt_time_finished'>
                        
                        <div class="alert alert-danger alert_msg alert_msgs"></div>
                        
                        <?php if($quiz_quests){ ?>
                            <div class="col-md-offset-0 col-md-12 col-sm-12 col-xs-offset-0 col-xs-12 p-xs-0 m-xs-0 btns_2 mb-0" style="margin-top:5px !important;">


                                <div class="loaders" style="display: none;">
                                    <img src="<?=base_url(); ?>images/loader.gif" class="cmd_next_quiz2" style="color:#777;">
                                </div>

                                
                                <div class="col-xs-12 mt-40" style="text-align: center;">
                                    <div class="row p_btns p_btns_2">
                                        <div class="col-md-12 p-0">
                                            <input type="button" class="btn btn-primary waves-effect waves-light cancel_test" id_sch="<?=$id_sch?>" value="Cancel Test" />&nbsp;

                                            <input type="button" id="cmd_submit_answers_timeout" class="p_btns1 pl-40 pr-40 pl-xs-30 pr-xs-30 ml-5 btn btn-primary waves-effect waves-light" id_sch="<?=$id_sch;?>" style="display:none;" value="Submit >" />

                                            <input type="button" class="p_btns1 pl-40 pr-40 pl-xs-30 pr-xs-30 ml-5 btn btn-primary waves-effect waves-light cmd_sub_answers" id_sch="<?=$id_sch;?>" value="Submit >" />
                                        </div>
                                    </div>
                                  </div>
                            </div>

                            <div style="clear: both;"></div>
                            


                            <?php
                            }else{
                                echo "<p style='color:#999 !important;'>Error! No quiz found here. Please click the button below to go back</p>";

                                echo '<div class="nxt_btn_div">
                                    <div class="start_test_btn start_test_btn_w cmd_submit_css more_width inlines p-15 p-sm-15 font-17 cancel_test1" id_sch="'.$id_sch.'">GO BACK <i class="fa fa-power-off"></i></div>
                                </div>';
                                echo "<div style='clear:both'></div>";
                            }
                        ?>
                    </div>
                    

                    
                    <div class="div_success_test" style="display:none; text-align:center">
                        <p class="mt-20 mt--sm-30_">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                              <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                              <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                            </svg>
                        </p>
                        <p style="font-size:25px; line-height: 32px !important;"><b style="color:#093; font-weight: bold;">Quiz Taken!</b></p>

                        <p style="margin:-10px 0 0 0; margin-top:0px; font-size: 16px; color: #444;" class="pr-10 pl-10">Thank you for participating on the test. Your performance has been computed, please click <b>"show my perfomance"</b> link to show all your answers or <b>"View Answers button"</b> to view your current perfomance.</p>
                        <p style="border-bottom:1px #666 dotted; margin:20px 0 20px 0;"></p>

                        <!-- <div class="mt-20 show_performance"><span id_sch="<?=$id_sch;?>">Show all my performances</span></div> -->


                        <div class="col-sm-offset-3 col-sm-6 col-xs-12 mt-10 mb-sm-50">
                            <div class="nxt_btn_div">
                                <div class="start_test_btn done_btn view_answers p-15 p-sm-15 font-17" id_sch="<?=$id_sch;?>">VIEW ANSWERS</div>

                                <div class="start_test_btn done_btn view_answers1 p-15 p-sm-15 font-17" style="opacity: 0.5; display: none;">VIEW ANSWERS</div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="div_success_test_timeout" style="display:none; text-align:center">
                        <p class="mt-10 mt--sm-10">
                            <img style="width: auto; height: auto;" src="<?=base_url()?>images/errors.png">
                        </p>
                        <p style="font-size:25px; line-height: 32px !important;"><b style="color:#9FCFFF; font-weight: bold;">Test Timeout And Submitted!</b></p>

                        <p style="margin:-10px 0 0 0; margin-top:0px; font-size: 16px; color: #ddd;" class="pr-10 pl-10">Thank you for participating on the test. Your performance has been computed, please click <b>"show my perfomance"</b> link to show all your answers or <b>"View Answers button"</b> to view your current perfomance.</p>

                        <p style="border-bottom:1px #666 dotted; margin:20px 0 20px 0;"></p>

                        <div class="mt-20 show_performance"><span id_sch="<?=$id_sch;?>">Show all my performances</span></div>

                        <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12 mt-30 mb-sm-50">
                            <div class="nxt_btn_div">
                                <div class="start_test_btn done_btn view_answers p-15 p-sm-15 font-17" id_sch="<?=$id_sch;?>">VIEW ANSWERS</div>

                                <div class="start_test_btn done_btn view_answers1 p-15 p-sm-15 font-17" style="opacity: 0.5; display: none;">VIEW ANSWERS</div>
                            </div>
                        </div>
                    </div>


                    <div class="div_show_perfomance" style="display:none;">
                        
                    </div>
                    <div style="clear: both;"></div>
                </div>


                <!-- <div class='col-sm-4 mt-20 ml-70 ml-sm-0' style="backgrounds: red;">
                    <?php //require_once APPPATH . "views/leaderboard_quiz.php"; ?>
                </div> -->
            </div>
        </div>
    <?php }



    function show_my_answers(){
        $id_sch = $this->input->post('id_sch');
        $getTests = $this->sql_models->getDetls($id_sch);
        $time_finished = $getTests['time_finished'];
        $scores = $getTests['scores'];

        if($scores=="") $scores=0;
        $mins1 = round($time_finished/60);
        $time_finished1 = $mins1." minutes";
        ?>

        <p style="font-size:25px; line-height: 25px !important;" class="mt-40 mt-sm-20"><b style="color:#093; font-weight: bold;">My Performance Details</b></p>

        <p style="color: #093; font-size: 23px; margin: -4px 0 7px 0" class="stats_per">
            <b>Scores:</b> <?=$scores?>%<br>
            <!-- <b>Finished in:</b> <?=$time_finished1?> -->
        </p>

        <div class="table_responsive"></div>

        <?php
        $myPerform=$this->sql_models->showMyPerformanceTbl2($id_sch, $this->myID);
        $ids = $myPerform['ids'];
        $ids_1 = $ids;
        $answers = $myPerform['answers'];

        $ids = explode(',', $ids);
        $answers = explode('||', $answers);

        $ids = array_unique($ids);
        $answers = array_unique($answers);

        $myanswers = "<div class=''><table class='table table-bordered tables_2' id='tables_2' style='border:none !important'>";
            if($ids && $ids_1>0){
                foreach($ids as $index=>$ids1){
                    $mem_ans = @$answers[$index];
                    $get_quiz_origin = $this->sql_models->getQuizOrigin($ids1);
                    if($get_quiz_origin){
                        $questions = $get_quiz_origin['questions'];
                        $ans1 = $get_quiz_origin['ans1'];
                        $explanations = $get_quiz_origin['explanations'];

                        $op1 = $get_quiz_origin['op1'];
                        $op2 = $get_quiz_origin['op2'];
                        $op3 = $get_quiz_origin['op3'];
                        $op4 = $get_quiz_origin['op4'];

                        $op1_1=$op1;
                        $op1_2=$op2;
                        $op1_3=$op3;
                        $op1_4=$op4;

                        $all_options = array($op1, $op2, $op3, $op4);
                        if($op1!="" && $op2!="" && $op3=="" && $op4=="") $all_options = array($op1, $op2);
                        if($op1!="" && $op2!="" && $op3!="" && $op4=="") $all_options = array($op1, $op2, $op3);

                        if($explanations=="") $explanations="<i style='color:#555;'>None</i>";

                        $counts1 = $index+1;

                        $mem_ans1="";
                        if($mem_ans=="")
                            $mem_ans1="<label style='font-size:15px; background:#f7f7f7; padding:1px 6px; border-radius:3px; color:#FF5E5E'>Not Answered</label>";
                        ?>

                        <tr><td>

                            <?php $questions = str_replace(array('<p>', '</p>'), "", $questions); $questions = ucfirst($questions); ?>

                            <div class='quiz_question quiz_question1'>
                                <p style='font-size:16px; line-height:23px; color:#444; font-weight: 600;'><?=$counts1?>. <?=nl2br($questions);?> <?=$mem_ans1?></p>
                            </div>

                        <?php
                        $k=1;
                        foreach($all_options as $keys){
                            if($k == 1) $m="<b>A)</b>";
                            else if($k == 2) $m="<b>B)</b>";
                            else if($k == 3) $m="<b>C)</b>";
                            else $m="<b>D)</b>";
                            $keys1 = ucfirst($keys);
                            $ticks="";$colors="";

                            if(strtolower($keys1) == strtolower($mem_ans)){
                                $ticks = "<img src='".base_url()."images/wrong.png' style='width:14px!important'>";
                                $colors = "color:#E10000;";
                            }

                            if(strtolower($keys1) == strtolower($ans1)){
                                $ticks = "<img src='".base_url()."images/tick2.png' style='width:14px!important'>";
                                $colors = "color:#090;";
                            }

                            ?>
                            <label class='perf_options'><b><?=$m?></b> 
                                <font style="<?=$colors?>"><?=$keys1?></font>
                                <?=$ticks?>
                            </label>

                        <?php
                        $k++;
                        }
                        ?>
                        <p class="explains"><b>Explanations:</b> <?=$explanations;?></p>
                        <tr><td>

                        <?php
                    }
                }
            }else{
                $myanswers .= "<tr style='background:none !important; border:none !important'><td colspan='6' style='text-align:center; border:none !important; color:#555 !important'>No result found or you didn't pertake on any test!</td></tr>";
            }
        $myanswers .= "</table></div>";
        echo $myanswers;
        ?>

        <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12 mt-30 mb-sm-50">
            <div class="nxt_btn_div">
                <div class="start_test_btn done_btn cmd_back2 p-15 p-sm-15 font-17" id_sch="<?=$id_sch;?>" vps="<?=$this->vps;?>">DONE!</div>
            </div>
        </div>

        <?php
    }



    function save_my_ansas(){
        ////////////////////////////////////////////
            $txtans1 = trim($this->input->post('txtans1'));
            $txtrandom_quiz = trim($this->input->post('txtrandom_quiz'));
            $qid_intro = trim($this->input->post('qid_intro'));
            $my_answers = $this->session->userdata('my_answers');
            $quizid = $this->session->userdata('quizid');
            $txtans1 = str_replace("&dagger;", "+;", $txtans1);
            
            $allRandIDs = $this->session->userdata('allRandIDs');
            $allQuizIDs2 = "";

            if(isset($allRandIDs) && $allRandIDs!=""){
                foreach ($allRandIDs as $value) {
                    $allQuizIDs2 .= $value['id'].",";
                }
            }

            if(isset($my_answers) && $my_answers!=""){
                $txtans2 = $my_answers;
            }else{
                $txtans2 = "";
            }
            $txtrandom_quiz2 = $quizid;
            
            $txtans2 .= $txtans1."||";
            $txtrandom_quiz2 .= "$txtrandom_quiz,";


            if(isset($allQuizIDs2) && !empty($allQuizIDs2)){
                $txtrandom_quizes = $allQuizIDs2;
            }else{
                $txtrandom_quizes = $txtrandom_quiz2;
            }

            $newdata3 = array(
                'my_answers' => $txtans2,
                'quizid'     => $txtrandom_quizes
            );

            $this->session->set_userdata($newdata3);
        ///////////////////////////////////////////

        $id_sch = $this->input->post('id_sch');
        $txt_time_finished = $this->input->post('txt_time_finished');
        
        $my_answers = $this->session->userdata('my_answers');
        $my_answers=substr($my_answers, 0, -2);

        $quizid = $this->session->userdata('quizid');
        $quizid=substr($quizid, 0, -1);

        $answers = explode('||', $my_answers);
        $ids = explode(',', $quizid);

        //print_r($answers);
        //echo count($answers);

        $sums=0;
        if($answers){
            foreach($ids as $index=>$ids1){
                $mem_ans = $answers[$index];
                if($this->sql_models->computeScores($ids1, $mem_ans)){
                    $sums+=1;
                }
            }

            $total_question = $this->sql_models->totlQuestions($qid_intro); 

            if($total_question>0){
                $total_score = $sums/$total_question; // 4/6  i scored 4 = 0.66
                $total_score1 = $total_score*100; // 0.66 * 100 = 66.6  
                $total_score1 = round($total_score1);
                if($total_score1 < 0) $total_score1=0;
            }else{
                $total_score1=0;   
            }

            $newdata3 = array(
                'memid'             => $this->myID,
                'quiz_section_id'   => $id_sch,
                'answers'           => $my_answers,
                'ids'               => $quizid,
                'time_finished'     => $txt_time_finished,
                'scores'            => $total_score1,
                'date_taken'        => time()
            );

            $this->sql_models->insert_scores($newdata3);

            $newdata5 = array(
                'my_answers'    => "",
                'quizid'        => "",
                'allRandIDs'    => ""
            );
            $this->session->set_userdata($newdata5);
            //echo "recorded";

            $this->refresh_lbs__qz($id_sch);

        }else{
            $newdata5 = array(
                'my_answers'    => "",
                'quizid'        => "",
                'allRandIDs'    => ""
            );
            //echo "error";
        }
    }



    function remove_started_test(){
        $id_sch = $this->input->post('id_sch');
        //$subject_id = $this->input->post('subject_id');
        //$ids_arr = $this->input->post('ids_arr');
        $memid = $this->memid;
        $submitted_attempts = $this->sql_models->submitted_attempts($this->myID, $id_sch);
        //echo "$submitted_attempts vvv";
        $updates = $this->sql_models->updateRecs1($id_sch, $this->myID, $submitted_attempts);
        if($updates){
            $newdata5 = array(
                'my_answers' => "",
                'quizid'     => "",
                'allRandIDs'    => ""
            );
            $this->session->set_userdata($newdata5);
            echo "updated";
        }else{
            echo "error";
        }
    }



    function fetch_rand_questions($record=0){
        $txtans1 = trim($this->input->post('txtans1'));
        $txtrandom_quiz = trim($this->input->post('txtrandom_quiz'));
        $qid_intro = trim($this->input->post('qid_intro'));

        $my_answers = $this->session->userdata('my_answers');
        $quizid = $this->session->userdata('quizid');

        $txtans1 = str_replace("&dagger;", "+;", $txtans1);

        $checkVP = $this->sql_models->checkVP1($this->myID);
        if($checkVP < 20){
            echo "insufficient_vp";
            exit;
        }

        /////take away my VP first//////
        $this->db->set('vp', "vp-20", FALSE);
        $this->db->where('id', $this->myID)->where('vp >=', 20);
        $this->db->update('members');
        /////take away my VP first//////
        
        $allRandIDs = $this->session->userdata('allRandIDs');
        $allQuizIDs2 = "";

        if(isset($allRandIDs) && $allRandIDs!=""){
            foreach ($allRandIDs as $value) {
                $allQuizIDs2 .= $value['id'].",";
            }
        }

        if(isset($my_answers) && $my_answers!=""){
            $txtans2 = $my_answers;
        }else{
            $txtans2 = "";
        }
        $txtrandom_quiz2 = $quizid;
        
        $txtans2 .= $txtans1."||";
        $txtrandom_quiz2 .= "$txtrandom_quiz,";


        if(isset($allQuizIDs2) && !empty($allQuizIDs2)){
            $txtrandom_quizes = $allQuizIDs2;
        }else{
            $txtrandom_quizes = $txtrandom_quiz2;
        }

        $newdata3 = array(
            'my_answers' => $txtans2,
            'quizid'     => $txtrandom_quizes
        );

        $this->session->set_userdata($newdata3);


        $recordPerPage = 1;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }

        $quiz_quests = $this->sql_models->quizQuestions('', $qid_intro, $record, $recordPerPage);
        $recordCount = $this->sql_models->countQuestions('', $qid_intro);
        $submitted_attempts = $this->sql_models->submitted_attempts($this->myID, $qid_intro);
        //$subj_name = $this->sql_models->subjName($ids_arr, $qid_intro);
        //$subj_name="sssss";

        $config['base_url'] = base_url().'node/fetch_rand_questions';


        ////////////////////
            $config["total_rows"] = $recordCount;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;

            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;
            
            
            //Encapsulate whole pagination 
            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 blog_pagn" id="pagination_quiz">';
            $config['full_tag_close'] = '</ul>';

            $config['prev_link'] = FALSE;
            $config['prev_tag_open'] = FALSE;
            $config['prev_tag_close'] = FALSE;


            //For NEXT PAGE Setup
            $config['next_link'] = "<span aria-hidden='true' class='next_prev_btn next_prev_btn_no_radius_' id_sch='$qid_intro'>
                NEXT <span class='fa fa-arrow-right'></span>
            </span>";

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';

            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            //$config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
        ////////////////////


        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        //echo "<div class='col-sm-12' style='background:  blue;'>";
            //echo "<div class='col-sm-8 mt-20 p-0' style='backgrounds: green'>";
            echo '<div class="container pt-0 pr-0 pl-0 pt-xs-10">';

                if($quiz_quests){
                    $qid = $quiz_quests['ids'];
                    $questions = ucfirst($quiz_quests['questions']);
                    $files = $quiz_quests['files'];
                    $op1 = $quiz_quests['op1'];
                    $op2 = $quiz_quests['op2'];
                    $op3 = $quiz_quests['op3'];
                    $op4 = $quiz_quests['op4'];
                    $ans1 = $quiz_quests['ans1'];
                    $explanations = $quiz_quests['explanations'];
                    $op1_1=$op1; $op1_2=$op2; $op1_3=$op3; $op1_4=$op4;

                
                    $all_options = array($op1, $op2, $op3, $op4);
                    if($op1!="" && $op2!="" && $op3=="" && $op4=="") $all_options = array($op1, $op2);
                    if($op1!="" && $op2!="" && $op3!="" && $op4=="") $all_options = array($op1, $op2, $op3);
                    shuffle($all_options);
            
                    $files1="";
                    if($files!=""){
                        $paths = base_url()."quizes/$files";
                        $files1 = "<div style='margin: 5px 0 15px 22px;' class='quiz_img'><img src='$paths' style='width:100%;'></div>";
                    }

                    //echo "<br><br><br><br>$qid kkbbb<br>";
                        
                    echo "<input type='hidden' name='txtrandom_quiz' id='txtrandom_quiz' value='$qid'>";
                    echo "<input type='hidden' name='qid_intro' id='qid_intro' value='$qid_intro'>";

                    $questions = str_replace(array('<p>', '</p>'), "", $questions);
                    $questions = ucfirst($questions);

                    echo "<ul class='quiz_question'>
                        <li style='font-size:16px; line-height:22px; color:#444; font-weight: 600;'><font id='txtpage_number_h'>1.</font> $questions</li>
                    </ul>";

                    echo "<ul class='quiz_options' ids='$qid'>";
                    echo $files1;
                    $k=1;

                    $quizid_taken_ans = $this->session->userdata('my_answers');
                    $quizid_taken_ans = substr($quizid_taken_ans, 0, -2);
                    $quizid_taken2 = explode("||", $quizid_taken_ans);
                    $quizid_taken2 = array_unique($quizid_taken2);

                    //print_r($quizid_taken2);
                    //echo "=========";

                    foreach($all_options as $keys){
                        if($k == 1) $m="<b>A)</b>";
                        else if($k == 2) $m="<b>B)</b>";
                        else if($k == 3) $m="<b>C)</b>";
                        //else if($k == 4) $m="<b>D)</b>";
                        else $m="<b>D)</b>";
                        $keys1 = ucfirst($keys);

                        echo "<li>
                            <label for='options$keys'>$m&nbsp;
                            <label class='container_radio'>$keys1";

                            $keys_i = str_replace("+", "&dagger;", $keys);
                            ?>

                            <input type='radio' name='options1' value='<?=$keys_i?>' class='<?=$keys?> chk' id='options<?=$keys?>' <?php if(in_array($keys, $quizid_taken2)) echo "checked"; ?> ids='<?=$qid?>'>
                            
                            <?php
                            echo "<span class='checkmark'></span>
                            </label>
                            </li>";
                        $k++;
                    }
                    echo "</ul>";
                    //echo $results;
                }else{
                    echo "No Questions";
                }
                ?>
                

                <div style='clear:both'></div>
                <div class="loaders" style="display: none;"><img src="<?=base_url();?>img/loader.gif">  Loading...</div>
                <?php echo $pagination; ?>
            </div>
        
        <?php
        }



    function openVoting(){
        $contestids = $this->input->post('contestID');
        $contestID = $this->input->post('contestID');
        $conte_id = $this->input->post('conte_id');
        $res1 = '';
        
        $contest_details = $this->sql_models->fetchRecs('contests', '', '', $contestids, 1, '');
        $timing3 = $contest_details['timings'];
        //$res1 .= $timing3."ssssssss";
        $title_c = $contest_details['title'];
        $premiums = $contest_details['premium'];

        $user_id = $contest_details['user_id'];
        $oparams1 = cleanStr(strtolower($title_c));
        $start_date_contest = @date("jS M, Y h:i a", strtotime($contest_details['start_date_contest']));
        $start_date_contest1 = $contest_details['start_date_contest'];
        $timings1i = date("Y-m-d H:i:s", $timing3);

        $contestid_ID = $contestids.substr(time(), 0, -5);
        $url_contestid_ID = $contestid_ID."/join/".$oparams1."/";

        //$timings2 = date("Y-m-d H:i:s", $timing3);

        $currentTime = time();
        $difference = $timing3 - $currentTime;
        $expirysx = convertTime1($difference);
        $timings4 = date("Y-m-d g:i", $timing3);

        $onedays = time()+108000;
        if(strtotime($timings1i) <= $onedays) $countdowns1 = "countdowns1"; else $countdowns1 = "";

        $getAgents = $this->sql_models->fetchAgents('members');
        $cid_id=$contestids;

        //$arrs = array();
        
        $ua = $this->getBrowser();
        $usragn = strtolower($ua['userAgent']);
        preg_match('#\((.*?)\)#', $usragn, $match); // extract strings in brackets
        $vars = $match[1];
        
        if(strpos($vars, "build") !== false){
            $truncate_var = substr($vars, 0, strpos($vars, "build"));
        } else{
            $truncate_var = $vars;
        }
        $truncate_var1 = str_replace(" u;", "", trim($truncate_var));
        $ipaddrs = $truncate_var1;

        $chktime = $this->sql_models->freeVoteTiming($contestID, $conte_id, $ipaddrs);

        $res1 .= '<div class="default_dv" style="display: nones;">
            <p class="p_name p_name1 pl-10 pr-10" style="line-height: 24px;">Loading...</p>
            <p class="p_litle">Please help this contestant to be the first winner</p>';

            $timeToVOte = $this->sql_models->timeToVOte($contestids); 
            if($timeToVOte || strlen($start_date_contest1)<3){
            

                $res1 .= "<div class='div_cover'>
                    <input id='txtcon_id' value='$cid_id' type='hidden'>
                    <input id='txtmem_id' type='hidden'>
                    <input id='txtmyvotes' type='hidden'>
                    <input id='txtv_names' type='hidden'>
                    <input id='txtsponsorID' value='$user_id' type='hidden'>
                    <input id='txtexpiry' type='hidden'>
                    <input id='txtautonum' type='hidden'>
                    <input id='txtcaps' type='hidden'>
                    <input id='txtmyid' type='hidden' value='$this->myID'>";

                    $res1 .= '<div class="select_vote vote_1 container p-0 mt-sm-10" style="display: nones">';

                        if($premiums=="free" || $premiums=="free_paid"){
                            /*if($this->myID=="" || $this->myID <= 0){
                            $res1 .= '<div class="col-md-12 p-0">
                                <div class="vote_btn__ vote_btns vote_btn_free1" caption="free" wallets="">Vote Free 1</div>

                                <div class="vote_btns vote_btn_free2" style="display: none;">Vote Free <span id="count_down" style="display: block;"></span></div>
                                <div class="lines"></div>
                            </div>';
                            }*/

                            $res1 .= '<input name="txt_url_params" id="txt_url_params" value="'.$url_contestid_ID.'" type="hidden" />
                            <input name="txt_url_params_ID" id="txt_url_params_ID" value="'.$contestid_ID.'" type="hidden" />';

                            $res1 .= '<div class="col-md-12 p-0">';
                                if($this->myID=="" || $this->myID <= 0)
                                    $res1 .= '<div class="vote_btns login_vote">Vote Free</div>';
                                else
                                    $res1 .= '<div class="vote_btn login_vote1" caption="login_free" wallets="">Vote Free</div>';
                                
                                $res1 .= '<div class="vote_btns login_vote1i" style="display: none; font-size: 15px;">Vote Free <span id="count_down2" style="display: block;"></span></div>
                                <div class="lines"></div>
                            </div>';

                            if($premiums!="free_paid"){
                                $res1 .= '<div class="col-md-12 p-0">
                                    <div class="dynamic_boost_vt">
                                        <div class="vote_btn_noc">Boost Vote</div>
                                    </div>
                                    <div class="lines"></div>
                                </div>';

                                $res1 .= '<div class="col-md-12 p-0">
                                    <div class="dynamic_boost_vt">
                                        <div class="vote_btn_noc">Guest Boost Vote</div>
                                    </div>
                                    <div class="lines"></div>
                                </div>';
                            }
                        }


                        if($premiums=="paid" || $premiums=="free_paid"){
                            if($premiums!="free_paid"){
                                $res1 .= '<div class="col-md-12 p-0">
                                    <div class="vote_btn_noc">Vote Free 1</div>
                                    <div class="lines"></div>
                                </div>';
                            }

                            $res1 .= '<div class="col-md-12 p-0">
                                <div class="dynamic_boost_vt">
                                    <div class="vote_btn" caption="boost" wallets="'.$this->wallets1.'">Boost Vote</div>
                                </div>
                                <div class="lines"></div>
                            </div>';

                            $res1 .= '<div class="col-md-12 p-0">
                                <div class="dynamic_boost_vt">
                                    <div class="vote_btn" caption="guest_boost" wallets="'.$this->wallets1.'">Guest Boost Vote</div>
                                </div>
                                <div class="lines"></div>
                            </div>';
                        }


                        if($premiums=="coded"){
                            $res1 .= '<div class="col-md-12 p-0">
                                <div class="vote_btn" caption="code" wallets="">Enter Code</div>
                                <div class="lines"></div>
                            </div>';
                        }
                        $res1 .= '<div style="clear: both;"></div>

                        <p class="expirys mt-10">This contest expires in <b style="color: #09C" class="caption_expire_  '.$countdowns1.'" id="caption_expire">'.$expirysx.'</b></p>
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
                                <p class="btns">';
                                    
                                    if($this->myID=="")
                                        $res1 .= '<spans class="cmd_votenows" style="opacity:0.5">Vote</spans>';
                                    else
                                        $res1 .= '<spans class="cmd_votenow" cats="code" amt="">Vote</spans>';
                                    
                                    $res1 .= '<spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans>  
                                    <spans class="btns1" id="cmdbackvote_code">Back</spans>
                                </p>
                            </div>';


                            $res1 .= '<div class="div_voteme_boost" style="display:none; text-align: center !important;">

                                <div class="div_hasfund" style="display:nones;">
                                    <p style="color:#444; line-height: 24px; font-size:16px; margin:8px 0 4px 0; font-weight: 600;">You have <font style="color: #09C; cursor: pointer;" class="wallet_amt">&#8358;'.$this->wallets.'</font> in your wallet.</p>

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
                                    <p class="btns btns3 mb-xs-50">';
                                        
                                        if($this->myID=="")
                                        $res1 .= '<spans class="cmd_votenows" style="opacity:0.5">Vote for &#8358;100</spans>';
                                        else
                                        $res1 .= '<spans class="cmd_votenow_i" cats="paid" amt="100">Vote for &#8358;100</spans>';
                                        
                                        $res1 .= '<spans class="cmd_votenow1" style="display: none; opacity: 0.4">Voting...</spans> 
                                        <spans class="btns1" id="cmdbackvote">Back</spans>
                                    </p>
                                </div>';

                                $res1 .= '<div class="div_hasnofund" style="display:none;">
                                    <p style="color:#333; line-height: 21px; font-size:16px; margin:9px 0 12px 0;"> 
                                        Oops!! Your wallet is empty! Please fund your wallet.
                                        <p style="font-size: 14px; line-height: 19px !important; color: #555; margin: -5px 0 -16px 0;">(Hints: 10votes for &#8358;100, 25votes for &#8358;200, 150votes for &#8358;1,000, etc...)</p>
                                    </p>

                                    <div class="first_form_ mt-30">
                                        <input type="hidden" id="txtnames" value="'.$this->myfullname.'">
                                        <input type="hidden" id="txtmymail" value="'.$this->myemails.'">
                                        <input type="hidden" id="txtmemid" value="'.$this->myID.'">
                                        <input type="hidden" id="txtvp1" value="'.$this->vps.'">
                                        
                                        <div class="col-md-12 pl-10 pr-10 p-sm-0">
                                            <div class="form-line">
                                                <input type="hidden" name="txtamt_fund_hide" id="txtamt_fund_hide">

                                                <input type="number" name="txtamt_fund" id="txtamt_fund" class="form-control" placeholder="Enter Amount" value="" style="font-size: 20px; color: #333; font-weight: 600; height: auto; padding: 10px 20px; border: 1px solid #999; background: #fff;">
                                            </div>
                                        </div>';

                                        $res1 .= '<div class="col-md-12 pl-10 pr-10 p-sm-0" style="margin-top: -5px;">
                                            <div class="form-line">
                                                <select id="pay_mthd" name="pay_mthd" class="form-control frm_control" style="border: 1px solid #999;">
                                                    <option value="paystack" selected="">Paystack (ATM card, Bank Transfer)</option>
                                                    <option value="flutterwave">Flutterwave (USSD, Bank transfer)</option>
                                                    <option value="airtime" disabled>Airtime (Coming)</option>
                                                    <option value="vp">Vote Point ('.$this->vps.'VPs, 20VP = &#8358;1)</option>
                                                    <option value="agents">Buy From Agents</option>
                                                </select>
                                            </div>
                                        </div>';

                                        $res1 .= '<div style="clear: both;"></div>
                                        <div class="alert alert_msgs alert_msg1" style="margin: 10px 0 -10px 0;"></div>

                                        <p class="btns btns3 mb-xs-50">
                                            <spans class="btns1" id="cmdbackvote">Back</spans>';

                                            if($this->myID==""){
                                                $res1 .= '<spans class="cmd_votenows" onpage="" style="display: nones; opacity:0.5">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px;"></i></spans>';
                                            }else{
                                                $res1 .= '<spans class="cmd_fund" onpage="contests" style="display: nones;">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px;"></i></spans>';
                                            }


                                            $res1 .= '<spans class="cmd_fund_proceed" style="display: none; opacity: 0.4">PROCEED &nbsp;<i class="fa fa-caret-right" style="position: relative; top: 1px"></i></spans> 
                                        </p>

                                        <div class="mt-40 mb-30" style="color: #555; font-size: 13.5px; line-height: 19px">Please refresh this page incase of any delay in trying to make payment</div>
                                    </div>
                                </div>
                            </div>';

                            $res1 .= '<div class="div_voteme_boost_guest" style="display:none; text-align: center !important;">
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
                            </div>';


                            $res1 .= '<div class="div_vote_success" style="display:none">
                                <p style="font-size:20px; margin:20px 0 10px 0; color:#096;"><b>Thank you for your vote</b></p>
                                <p style="font-size:16.5px; margin-bottom:12px; color:#333; line-height:21px;">You have successfully voted for <font class="p_name2"></font></p>
                                <p class="btns"><spans id="cmdbackvote1">Done</spans></p>
                            </div>
                        </form>
                    </div>
                </div>';

            }else{
                $res1 .= '<p style="margin: 20px 0; color: #09C; font-weight: 500; line-height: 25px; font-size: 18px;">Entries are still going on!<br>Voting starts immediately at '.$start_date_contest.'</p>';
            }
        $res1 .= '</div>';


        $res1 .= '<div class="agents_dv" style="display: none;">
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
                <div style="clear: both;"></div>';


                
                if($getAgents){
                    foreach($getAgents as $row){
                        $names = ucwords($row['names']);
                        $phone = $row['phone'];
                        $wallet = @number_format($row['wallet']);

                        $res1 .= "<div class='col-xs-4'>
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
                    $res1 .= '<div class="col-xs-12">
                        <p>No Agents Found Yet!</p>
                    </div>';    
                }
                

            $res1 .= '</div>
            <p class="btns">
                <spans id="cmdbackpay">Back</spans>
            </p>
        </div>';


        $results = '';
        $results .= '<div class="closeme1"><i class="fa fa-close"></i></div>
        <div class="inner_dvs pr-0 pl-0">';
            $results .= $res1;
        $results .= '</div>';
        
        if($chktime !== false){
            //echo $chktime;
            $arrs = array('msg'=>$results, 'msg1'=>$chktime);
        }else{
            //echo "expired"; // 24 hrs has expired, vote again
            $arrs = array('msg'=>$results, 'msg1'=>"expired");
        }

        echo json_encode($arrs);
    }



    
    public function vp_market(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "VP Market";
        $data['page_name'] = "vp_market";
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');

        $cid = $this->uri->segment(2);
        $cid1 = substr($cid, 0, -5);
        $data['contestids'] = $cid1;

        //$data['param1'] = "pages";
        $record=0;
        $recordPerPage = 14;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countMyRecs('', 'contests', '');
        $recordCount1 = $this->sql_models->countMyRecs1('', $txtsrch, $txtpre, 'contests', '');

        //$nums = $record + $recordPerPage;

        $empRecord = $this->sql_models->fetchMyRecs('', $txtsrch, $txtpre, $record, $recordPerPage, 'contests', '', '');
        $config['base_url'] = base_url();

        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;

            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_contest" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////

        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        $data['recordCount'] = $recordCount;
        $data['recordCount1'] = $recordCount1;
        $data['record'] = $record+1;
        $data['recordPerPage'] = $recordPerPage;
        
        
        $data['contests'] = $empRecord;
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }




    public function contests(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Contest Brands";
        $data['page_name'] = "contests";
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');
        $txtpre_url = $this->uri->segment(2);

        if($txtpre_url!="") $txtpre = $txtpre_url;

        $cid = $this->uri->segment(2);
        $cid1 = substr($cid, 0, -5);
        $data['contestids'] = $cid1;

        //$data['param1'] = "pages";
        $record=0;
        $recordPerPage = 14;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countMyRecs('', 'contests', '');
        $recordCount1 = $this->sql_models->countMyRecs1('', $txtsrch, $txtpre, 'contests', '');

        //$nums = $record + $recordPerPage;

        $empRecord = $this->sql_models->fetchMyRecs('', $txtsrch, $txtpre, $record, $recordPerPage, 'contests', '', '');
        $config['base_url'] = base_url();

        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;

            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_contest" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////

        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        $data['recordCount'] = $recordCount;
        $data['recordCount1'] = $recordCount1;
        $data['record'] = $record+1;
        $data['recordPerPage'] = $recordPerPage;
        
        
        $data['contests'] = $empRecord;
        $this->load->view("header", $data);
        $this->load->view("contests", $data);
        $this->load->view('footer', $data);
    }



    public function sponsors(){
        if($this->isCompatible()) redirect('compatibility');
        $url_titles = $this->uri->segment(2);
        $url_titles1 = str_replace("__", " & ", $url_titles);
        $url_titles_ = str_replace("_", " ", $url_titles1);
        $data['page_title'] = strtoupper($url_titles_)." Sponsor Page";
        $data['page_name'] = "sponsor";
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');

        //$cid = $this->uri->segment(2);
        //$cid1 = substr($cid, 0, -5);
        //$data['contestids'] = $cid1;
        $record=0;
        $recordPerPage = 14;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countMyRecs('', 'contests', $url_titles);
        $recordCount1 = $this->sql_models->countMyRecs1('', $txtsrch, $txtpre, 'contests', $url_titles);

        $empRecord = $this->sql_models->fetchMyRecs('', $txtsrch, $txtpre, $record, $recordPerPage, 'contests', '', $url_titles);
        $config['base_url'] = base_url();
        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;

            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_contest" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////

        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        $data['recordCount'] = $recordCount;
        $data['recordCount1'] = $recordCount1;
        $data['record'] = $record+1;
        $data['recordPerPage'] = $recordPerPage;
        
        
        $data['contests'] = $empRecord;
        $this->load->view("header", $data);
        $this->load->view("contests", $data);
        $this->load->view('footer', $data);
    }



    function more_contests($record=0){
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');
        $cid1 = $this->input->post('cid1');
        $url_titles = $this->uri->segment(2);
        $recordPerPage = 14;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }

        $recordCount = $this->sql_models->countMyRecs($cid1, 'contests', $url_titles);
        $recordCount1 = $this->sql_models->countMyRecs1($cid1, $txtsrch, $txtpre, 'contests', $url_titles);
        $empRecord = $this->sql_models->fetchMyRecs($cid1, $txtsrch, $txtpre, $record, $recordPerPage, 'contests', '', $url_titles);
        $config['base_url'] = base_url().'node/more_contests';
        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_contest" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
            
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';
        ////////////////////

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        if($record<=0) $record=1;
        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;


        if($empRecord){
            echo '<div class="row">
                    <p class="srch_info">To view all, clear the search box and click on search button</p>';

                echo "<div class='container' style='color:#333 !important; font-size:16px; text-align:center; margin: -5px 0 8px 0px; line-height:20px;'>Share any of these contests below and get 10VP each, refer to <a href='#popup_div' style='color:#09C' class='video-play-icon watch link_howitwk'>how it works</a> to get more information</div>";

                echo "<div class='container' style='color:#555; font-size:16px; text-align:center; margin: 0px 0 30px 0px !important'>Showing $record of $recordPerPage of $recordCount contests found</div>";

                $i = 1;
                foreach($empRecord as $post):
                    $ids = $post['id'];
                    $nows = substr(time(), -5);
                    $ids_hash = $ids.$nows;
                    $title = $post['title'];
                    $adv_title_f = cleanStr(strtolower($title));
                    $files = $post['files'];
                    $company_logo = $post['company_logo'];
                    $entry_type = $post['entry_type'];
                    $timings = $post['timings'];
                    $timings1 = date("Y-m-d H:i:s", $timings);
                    $start_date1 = strtotime($post['start_date']);
                    $start_date2 = @date("jS M, Y", $start_date1);
                    $sponsoredby = $post['sponsoredby'];
                    $sponsoredby_f = "";
                    if($sponsoredby!="")
                        $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
                    $start_date_contest1 = $post['start_date_contest'];
                    $start_date_contest = @date("jS M, Y", strtotime($post['start_date_contest']));
                    $close_date_entry1 = $post['close_date_entry'];
                    $views = kilomega($post['views']);
                    $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                    $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

                    $currentTime = time();
                    $difference = $timings - $currentTime;

                    if($start_date1 <= $currentTime){
                        $c_expirys = convertTime1($difference);
                        $c_expirys = str_replace("time", "to go", $c_expirys);
                    }else{
                        $c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    }

                    if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                    
                    $url2 = base_url()."$ids_hash/join/$adv_title_f/";

                    $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                    $title_1 = str_replace("&", "and", $title_1);

                    $title = str_replace("'", "&prime;", $title);
                    $descrips_whatsapp = "*'".ucwords($title)."'* is hosting a contest at the moment, join now and stand a chance to win prizes.";

                    $descrips = "'".ucwords($title)."' is hosting a contest at the moment, join now and stand a chance to win prizes.";
                    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                    $shareConCounts = kilomega($this->sql_models->shareConCounts($ids));
                    $share_cap = "Share";

                    if($shareConCounts > 1) $share_cap = "Shares";

                    $countdowns1="";
                    $onedays = time()+108000;
                    if(strtotime($timings1) <= $onedays) $countdowns1 = "countdowns1";

                    $comments = $this->sql_models->fetchComments('comments', $ids, 20);
                    $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
                    $repliesCounts = $this->sql_models->fetchCommentsCounts1('replies', $ids);
                    $allCcounts = $commentsCounts+$repliesCounts;

                    $contest_img = base_url()."contest_types/$files";
                    $logo_img = base_url()."companys/$company_logo";

                    $img_logo1 = "";
                    if($company_logo != ""){
                        $img_logo1 = "<img src='$logo_img' class='curve_logo mt-10'>";
                    }

                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                    if($width1=="" || $width1<=0)
                        $contest_img = base_url()."images/no-image.jpg";

                    if($company_logo!=""){
                        $width1="";
                        list($width1, $height1, $type1, $attr1) = @getimagesize($logo_img);
                        if($width1=="" || $width1<=0)
                            $logo_img = base_url()."companys/logo1.jpg";
                    }

                ?>

                    <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                        <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                            <div class="position-relative">
                                <img src="<?=$contest_img?>" class="card-img-top rounded-top" alt="...">
                                <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                    <div class="overlay rounded-top bg-dark"></div>
                                </a>
                            </div>

                            <div class="card-body content p-10_ pl-15_pr-15 p-0">

                                <?php if($company_logo!=""){ ?>
                                <div class="row p-0">
                                    <div class="col-9" style="background-colors: green">
                                <?php } ?>
                                        <?php $title = strtolower($title); ?>
                                        <h5 class="p-15"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 title text-dark font-bold1"><?=ucwords($title)?></a></h5>

                                        <?php if($company_logo!=""){ ?>
                                    </div>
                                    <?php } ?>

                                    <?php if($company_logo!=""){ ?>
                                    <div class="col-3 mt-xs-5" style="background-colors: blue">
                                    <?php } ?>
                                        <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                            <?=$img_logo1?>
                                        </a>

                                        <?php if($company_logo!=""){ ?>
                                    </div>
                                </div>
                                <?php } ?>


                                <div class="for_timings pl-15 pr-15 pb-5 <?=$countdowns1?>">
                                    <?php
                                    if($start_date1!="" && $start_date1 <= $currentTime){
                                        if(strtotime($close_date_entry1) >= time() && $close_date_entry1 != ""){
                                            //echo 'Entry Stops at '.$close_date_entry1;
                                            echo "Entries in progress...";
                                        }else{
                                            if($close_date_entry1 == ""){
                                                if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                    echo "Entries in progress...";
                                                else
                                                    echo "<b>$c_expirys</b>";
                                            }else{
                                                if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                    echo "Entries in progress...";
                                                else
                                                    echo "<b>$c_expirys</b>";
                                            }
                                        }
                                    }else{
                                        if($start_date1!="" && $start_date1 >= time())
                                            echo 'Coming on '.$start_date2.'!';
                                        else
                                            echo "Entries in progress...";
                                    }
                                    ?>

                                    <a href="javascript:void(0)" class="text-muted comments ml-15">
                                        <i class="mdi mdi-comment-outline"></i> <?=$allCcounts?>
                                    </a>
                                </div>


                                <?php
                                if($entry_type=="free" || $entry_type=="")
                                    echo '<div class="for_free"></div>';
                                else if($entry_type=="coded" || $entry_type=="")
                                    echo '<div class="for_free_code"></div>';
                                ?>


                                <div class="post-meta d-flex justify-content-between mt-60">
                                    <div class="company_stats p-10 mt-0">
                                        <span><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$noOfEntries?> Entries</a></span>
                                        <span><?=$noOfVotes?> Votes</span>
                                        <span><?=$views1?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="author_">
                                <!-- <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                                <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13th August,
                                    2019</small> -->

                                <div class="inner_img">
                                    <div class="company_btns company_btns_inx">
                                        <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><span>Join</span></a>
                                        <span class="social_menu" id1="<?=$ids?>">
                                            <font style="font-size: 14px; color: #7BF"><?=$shareConCounts?></font> <?=$share_cap?>
                                        </span>
                                    </div>

                                    <div class="social_btns join_social_btns" id="social_btns<?=$ids?>">
                                        <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-facebook-f"></i></a></span>

                                        <span class="for_desktop2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                        <span class="for_mobile2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                        <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-twitter"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($i%4==0){ ?>
                        <?php
                        $get_ads = $this->sql_models->getADS('300x600', 'contest space', 'noarray', '');
                        if($get_ads){
                            $files = $get_ads['files'];
                            $urls1 = $get_ads['urls1'];
                            $title = $get_ads['title'];
                            $files1 = base_url()."adverts1/$files";
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            if(preg_match($reg_exUrl, $urls1, $url)) {
                                $urls1 = "$urls1";
                            } else {
                                $urls1 = "mailto:$urls1";
                            }
                        ?>
                            <!-- This is for adverts -->
                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                    <div class="position-relative">
                                        <img src="<?=$files1?>" class="card-img-top rounded-top" alt="">
                                        <a href="<?=$urls1?>" target="_blank">
                                            <div class="overlay rounded-top bg-dark"></div>
                                        </a>
                                    </div>

                                    <div class="card-body content p-0">
                                        <div class="post-meta d-flex justify-content-between mt-60">
                                            <div class="company_stats company_ads mt-0 p-0 pt-5">
                                               <div class="sponsorads"><< Sponsored Ads >></div>
                                               <h5><a href="<?=$urls1?>" target="_blank" style="color: #666 !important; font-size: 17px !important;"><?=$title?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- This is for adverts -->
                        <?php
                        }else{ ?>

                            <div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">
                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                    <div class="position-relative">
                                        <img src="<?=base_url()?>images/bizz.jpg" class="card-img-top rounded-top" alt="...">
                                        <a href="javascript:;">
                                            <div class="overlay rounded-top bg-dark"></div>
                                        </a>
                                    </div>
                                    <div class="card-body content p-0">
                                        
                                        <h5 class="p-15"><a href="javascript:;" class="card-title card-title1 title" style="color: #666 !important; font-size: 17px !important;">PLACE YOUR BUSINESS HERE</a></h5>

                                        <p class="pl-15 pr-15" style="margin: -16px 0 0 0"><a href="<?=base_url()?>contact/#contact" style="color: #09C">Click here to contact us</a></p>

                                        <div class="post-meta d-flex justify-content-between mt-60">
                                            <div class="company_stats company_ads p-10 mt-0">
                                               << FREE SPACE >>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        }
                    ?>

                <?php
                $i++;
                endforeach; ?>

                <div style="clear: both;"></div>
                <div class="col-12 mt-10 mb-40">
                    <?php echo $pagination; ?>
                </div>
            </div>

        <?php }else{ ?>
        
        <div class='container' style='color:#777; font-size:18px; text-align:center; margin: 10px 0 30px 0px !important'>No contest found!<br>Try reloading the page or search for something else.</div>

        <?php
        }
    }




    public function dashboard(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "";
        $data['header_names'] = "DASHBOARD";
        $data['page_title'] = ucwords($this->myfullname);
        $data['latest_conts'] = $this->sql_models->latestContests(5);
        $data['new_msg'] = $this->sql_models->fetchMsgs();
        $data['vote_logs'] = $this->sql_models->voteLogs($this->myID);
        $data['ent_parti'] = $this->sql_models->entryParticipated('entries', $this->myID);
        $data['url_id'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        //$data['unread_msg'] = $this->unread_msg;
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    
    public function myprofile(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "profile";
        $data['header_names'] = "MY PROFILE";
        $data['page_title'] = "Profile ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['states1'] = $this->sql_models->fetchStates();
        $data['city1'] = $this->sql_models->fetchCitys($this->states);
        $data['datamsg'] = "You have successfully updated your profile.";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function change_media(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "change_media";
        $data['header_names'] = "CHANGE YOUR CONTEST ENTRY";
        $data['page_title'] = "Change your entry ";
        $data['states1'] = $this->sql_models->fetchStates();
        $data['city1'] = $this->sql_models->fetchCitys($this->states);
        $data['datamsg'] = "You have successfully updated your entry.";
        
        $url_id = $this->uri->segment(2);
        $cid1 = substr($url_id, 0, -5);

        $contest_details = $this->sql_models->fetchRecs('contests', '', '', $cid1, 1, '');
        $data['cdetls'] = $contest_details;
        $data['myentr'] = $this->sql_models->myEntrs('entry_media entr', $cid1, $this->myID);
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function sponsor(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        if($this->id_card!="" && $this->utility!="" && $this->has_paid>0){
            echo "<script>";
            if($this->approved==0){
                echo "alert('You have already become a sponsor, please wait for admin approval!');";
            }else{
                echo "alert('You have already become a sponsor!');";
            }
            echo "window.location='".base_url()."dashboard/'";
            echo "</script>";
            //redirect('');
        }
        $data['page_name'] = "sponsor";
        $data['header_names'] = "SPONSORSHIP";
        $data['page_title'] = "Sponsorship ";
        // $data['unread_msg'] = $this->unread_msg;
        //$data['states1'] = $this->sql_models->fetchStates();
        //$data['city1'] = $this->sql_models->fetchCitys($this->states);
        $data['datamsg'] = "You have upgraded to becoming a sponsor. Your details will be approved shortly. Thank You!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function become_agent(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "become_agent";
        $data['header_names'] = "Become An Agent";
        $data['page_title'] = "Become An Agent ";
        $data['datamsg'] = "You have upgraded to becoming an agent. Your details will be approved shortly. Thank You!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function mywallet(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $params = $this->uri->segment(3);
        $data['params'] = $params;
        $this->sql_models->updateReads_notify(0, 'all_notifications');
        $data['page_name'] = "mywallet";
        $data['header_names'] = "FUND MY WALLET";
        $data['page_title'] = "My Wallet ";
        $data['datamsg'] = "You have successfully added fund to your wallet.";
        $data['datamsg1'] = "Your fund is pending until we receive a notification!";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function transfer(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $params = $this->uri->segment(3);
        $data['params'] = $params;
        $data['page_name'] = "transfer";
        $data['header_names'] = "TRANSFER MONEY FROM WALLET TO WALLET";
        $data['page_title'] = "Trasfer Money ";
        $data['datamsg'] = "You have successfully transferred money";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }

    
    public function company_acct_details(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "company_acct_details";
        $data['header_names'] = "Company Account Details";
        $data['page_title'] = "Company Account Details ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function request_withdraw(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "request_withdraw";
        $data['header_names'] = "REQUEST WITHDRAWAL";
        $data['page_title'] = "Request Withdrawal ";
        $data['datamsg'] = "Your transaction was successful! We will credit you very soon.";
        $data['bank_names'] = $this->sql_models->getBankNames();
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function view_transactions(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "view_transactions";
        $data['header_names'] = "VIEW TRANSACTIONS";
        $data['page_title'] = "View Transactions ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function transfer_history(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "transfer_history";
        $data['header_names'] = "TRANSFER HISTORY";
        $data['page_title'] = "Transfer History ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function upload_contest(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        if($this->my_mem_type!="spon" && $this->has_paid==0) redirect('');
        $data['page_name'] = "upload_contest";
        $data['header_names'] = "UPLOAD CONTEST";
        $data['page_title'] = "Upload Contest ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "You have successfully uploaded a contest. It will await for approval!";
        $data['datamsg1'] = "";
        $data['datamsg2'] = "Congratulations! You have successfully paid for your contest.";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function view_contests(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        if($this->my_mem_type!="spon" && $this->has_paid==0) redirect('');
        $data['page_name'] = "view_contests";
        $data['header_names'] = "VIEW CONTESTS";
        $data['page_title'] = "View Contests ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "Contest codes have been entered!";
        $data['datamsg1'] = "Congratulations! Your AD is been submitted for boosting!";
        $data['datamsg2'] = "Congratulations! You have successfully paid for your contest.";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    
    public function edit_contest(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        if($this->my_mem_type!="spon" && $this->has_paid==0) redirect('');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_contest";
        $data['header_names'] = "EDIT CONTESTS";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'contests');
        $ctitles = ucwords($data['getId']['title']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "Contest has been updated!";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function sponsored_contests(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "sponsored_contests";
        $data['header_names'] = "VIEW SPONSORED CONTESTS";
        $data['page_title'] = "View Sponsored Contests ";
        $data['contests'] = "";
        $data['datamsg'] = "This contest has been sponsored!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function votes_recs(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "votes_recs";
        $data['header_names'] = "VIEW YOUR VOTES";
        $data['page_title'] = "View Your Votes ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function entries_records(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        if($this->my_mem_type!="spon" && $this->has_paid==0) redirect('');
        $url_id = $this->uri->segment(2);
        $cid1 = substr($url_id, 0, -5);
        $data['page_name'] = "entry_records";
        $data['header_names'] = "ENTRIES";
        $data['page_title'] = "Entries ";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = $cid1;
        $data['getId'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function adverts(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "adverts";
        $data['header_names'] = "ADVERTISE YOUR BUSINESS";
        $data['page_title'] = "Advertise Your Business ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "Your Advert Has Been Submitted";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function view_adverts(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "view_adverts";
        $data['header_names'] = "VIEW YOUR ADS";
        $data['page_title'] = "View Your Ads ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function referral_records(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "referral_records";
        $data['header_names'] = "VIEW YOUR REFERRALS";
        $data['page_title'] = "View Your Referrals";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    
    public function edit_adverts(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_adverts";
        $data['header_names'] = "EDIT YOUR ADVERT";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'adverts');
        //print_r($data['getId']); exit;
        $ctitles = ucwords($data['getId']['title']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "Your Advert has been edited!";
        $data['datamsg1'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    public function settings(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['show_name'] = $this->myfullname;
        $data['page_name'] = "settings";
        $data['header_names'] = "MY SETTINGS";
        $data['page_title'] = "My Settings";
        $data['url_id'] = "";
        $data['datamsg'] = "Your password has been updated!";
        $data['datamsg1'] = "";
        //$data['unread_msg'] = $this->unread_msg;
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    
    public function support_ticket(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "support_ticket";
        $data['page_title'] = "Support";
        $data['header_names'] = "SUPPORT TICKET";
        $data['getId'] = "";
        $data['datamsg'] = "Your message has been sent!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function announcement(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "announcement";
        $data['page_title'] = "Announcement";
        $data['header_names'] = "ANNOUNCEMENT";
        $data['getId'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }



    function send_msg_support(){
        $this->form_validation->set_rules('txtsubj', 'subject', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('txtmsg', 'message', 'required|trim');
        $txtsubj = $this->input->post('txtsubj');
        $txtmsg = $this->input->post('txtmsg');
        $txtmem = $this->input->post('txtmem');
        $txtusr = $this->input->post('txtusr');
        $txtmessage_type = $this->input->post('txtmessage_type');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $data=array();

            if($txtmessage_type=="support"){
                if($txtusr == "user"){
                    $data = array(
                        'sent_from'     => $txtmem,
                        'user_id'       => 0,
                        'subj'          => $txtsubj,
                        'message'       => $txtmsg,
                        'has_read'      => 0,
                        'date_posted'   => date("Y-m-d g:i a", time())
                    );
                }else{
                    $data = array(
                        'sent_from'     => 0,
                        'user_id'       => $txtmem,
                        'subj'          => $txtsubj,
                        'message'       => $txtmsg,
                        'has_read'      => 0,
                        'date_posted'   => date("Y-m-d g:i a", time())
                    );
                }
            }

            //echo $txtmessage_type; exit;

            if($txtmessage_type=="announcement"){
                $get_all_membersid = $this->sql_models->getMemIDs();
                $data = array();
                foreach ($get_all_membersid as $allmemids) {
                    $data[] = array(
                        'user_id'       => $allmemids['id'],
                        'subj'          => $txtsubj,
                        'message'       => $txtmsg,
                        'has_read'      => 0,
                        'date_posted'   => date("Y-m-d g:i a", time())
                    );
                }
            }

            $send_message = $this->sql_models->sendSupportMessage($txtmessage_type, $data);
            if($send_message){
                echo "message_sent";
            }else{
                echo "Error in sending message";
            }
        }
    }




    function approve_subadmin(){
        $id1 = $this->input->post('id1');
        $approve_it = $this->sql_models->approveIDS($id1, '', 'subadmin');
        //echo $approve_it;
    }



    function upload_my_questions(){
        $txtcons_id = $this->input->post('txtcons_id');

        $path4 = @$_FILES['uploadFile']['name'];
        $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
        $ext4 = strtolower($ext4);
        $img_ext_chk1 = array('xlsx','xls');

        if($ext4=="")
            echo "Please select an excel format to upload<br>";

        else if(!in_array($ext4, $img_ext_chk1) && isset($_FILES['uploadFile']['name']) && @$_FILES['uploadFile']['name'] != "")
            echo "Please select a valid excel formats of xls, xlsx<br>";
        else if(isset($_FILES['uploadFile']['name']) && @$_FILES['uploadFile']['size'] > 6291456)
            echo "The file has exceeded 6MB<br>";

        else{ // upload the excel and add to database
            $path = 'xls_uploads/';
            require_once APPPATH . "third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if(!$this->upload->do_upload('uploadFile')) {
                echo $this->upload->display_errors();
            }else{
                $data = array('upload_data' => $this->upload->data());
            
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
            
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    //print_r($allDataInSheet); exit;
                    foreach ($allDataInSheet as $value) {
                        if($flag){
                          $flag =false;
                          continue;
                        }

                        if(isset($value['A']) && strlen(trim($value['A'])>=3) || !isset($value['B']) && $value['B']==""){
                        //if(isset($value['A']) && $value['A']!=""){
                            @$inserdata[$i]['contest_id']        = $txtcons_id;
                            @$inserdata[$i]['codes']             = $value['A'];
                        }else{
                            echo "<div>Error, the excel file is not in its correct format.</div>";
                            exit;
                        }
                        $i++;
                    }
                    $result=$this->sql_models->insertMyCodes($inserdata);
                    if($result){
                        //$in_folder1="xls_uploads/".$data['upload_data']['file_name'];
                        $in_folder1="xls_uploads/";
                        if(is_readable($in_folder1)){
                            @unlink($in_folder1);
                        }else{
                            $in_folder1=base_url()."xls_uploads/";
                            if(is_readable($in_folder1)) @unlink($in_folder1);
                        }
                      echo "inserted";
                    }else{
                      echo "Error";
                    }             
     
                } catch (Exception $e) {
                   echo "Error loading file ".pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage();
                }
            }
        }
    }



    function submit_codes(){
        $txtcodes = $this->input->post('txtcodes', TRUE);
        $txtcons_id = $this->input->post('txtcons_id', TRUE);
        //$txteditcon = $this->input->post('txteditcon', TRUE);
        //print_r($_POST);

        foreach ($txtcodes as $index => $txtcodes1) {
            $this->form_validation->set_rules($index.'txtcodes', 'Contest Code', 'trim|min_length[4]|numeric');
            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                exit;
            }

            if($txtcodes1!=""){
                $data[] = array(
                    'contest_id'    => $txtcons_id,
                    'codes'         => $txtcodes1
                );
            }
        }
        $querys = $this->sql_models->insertCodes($data, 'contest_codes');
        if($querys){
            echo "success";
        }else{
            echo "Error";
        }
    }



    function approve_paids(){
        $ids = $this->input->post('ids');
        $subscription = $this->input->post('subscription');
        $names = ucfirst($this->input->post('names'));
        $emails = $this->input->post('emails');
        $approve_it = $this->sql_models->approvePaids($ids, $subscription, $names, $emails, 'member_subscription');
        //echo $approve_it;
    }


    function refresh_lbs(){
        $contestids = $this->input->post('contestids');
        $page_name = $this->input->post('page_nm');
        //$txtcontests = $this->input->post('txtcontests');

        $ids_hash2 = $contestids.substr(time(), -5);

        if($page_name=="profile"){ ?>
            <p class="lb_title mb-0"><b>LeaderBoard, Top 10</b> <span class="dynamic_idhash"><a href="<?=base_url()?><?=$ids_hash2?>/entries-leaderboard/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a></span></p>
        <?php }else{ ?>
            <p class="lb_title mb-0"><b>LeaderBoard, Top 10</b> <a href="<?=base_url()?><?=$ids_hash2?>/entries-leaderboard/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a></p>
        <?php } ?>

        <div class="mt-3">
            <?php
            if($page_name=="profile"){
                echo "<div class='div_leaderboard'>";
                $empRecords = $this->sql_models->fetchProductsLeader($contestids, "", "", "", 10, 'entries', 'votes');
            }else{
                $empRecords = $this->sql_models->fetchProductsLeader($contestids, "", "", "", 10, 'entries', 'votes');
            }

            $t=1;
            if($empRecords){
                foreach ($empRecords as $rs) {
                    $names = ucwords(strtolower($rs['names']));
                    $nickname = ucwords(strtolower($rs['nickname']));
                    $names1 = strtolower($names);
                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                    if(strlen($names)<=2) $names = ucwords($nickname);
                    $names1 = str_replace(" ", "-", $names1);
                    $pics = $rs['pics'];
                    $votes = $rs['votes'];
                    $memid = $rs['contestant_id'];
                    $nows = substr(time(), -5);
                    $memid_hash = $memid.$nows;
                    $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                    $online_time = time_ago($online_timing);

                    $getBoosted = $this->sql_models->fetchBoosted($contestids, $memid);
                    $boosteds="";
                    if($getBoosted>0){
                        $boosteds = "<font style='font-weight: 600; font-size:14px'>(".@number_format($getBoosted)." Boosted)</font>";
                        //$boosteds = "<font style='font-weight: 600; font-size:14px'>(+Boosted)</font>";
                    }

                    $pic_pathi = base_url()."media_uploads1/$pics";
                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0){
                        $pic_pathi = base_url()."profiles1/$pics";

                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                        if($width1=="" || $width1<=0)
                            $pic_pathi = base_url()."profiles/$pics";
                    }

                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0)
                        $pic_pathi = base_url()."images/no_passport.jpg";

                    if($t%2==0) $odds = "odds"; else $odds = "";


                    $mychats1 = "";
                    if($this->myID==$memid){
                        $mychats1 = $this->sql_models->noOfChats($this->myID);
                        if($mychats1<=0) $mychats1="";
                    }

                    $mystatus = $this->sql_models->chkOnlinePresence($memid);
                    $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                    if($chechOnlineHidden) // visible
                        $last_seen="<span style='color:#093 !important;'>active</span>";
                    else
                        $last_seen="<span style='color:#777 !important;'>hidden</span>";

                    if($mystatus=="ash"){
                        if(strtotime($online_timing)>0){
                            if($chechOnlineHidden) // visible
                                $last_seen="<span style='color:#777 !important;'>Seen: $online_time</span>";
                            else
                                $last_seen="<span style='color:#777 !important;'>hidden</span>";
                        }else{
                          $last_seen="<span style='color:#777 !important;'>offline</span>";
                        }
                    }

                    ?>
                    <div class="clearfix post-recent inner_lb <?=$odds?>">
                        <div class="post-recent-thumb float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                            </a>
                        </div>
                        <div class="post-recent-content float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a>
                            <span class="text-muted vt_cnts vote_counts_lb<?=$contestids.$memid;?>"><?=@number_format($votes)?> votes <?=$boosteds?></span>
                            <span class="online_status_lb"><?=$last_seen?></span>
                        </div>
                    </div>
                <?php
                $t++;
                }
            }else{
                echo "<div style='padding: 20px 10px 30px 10px; text-align:center; color:#666; font-size: 18px;'>No entries found here</div>";
            }

            if($page_name=="profile"){
                echo "</div>";
            }
            ?>
        </div>
        <?php
    }



    function refresh_lbs1(){
        $contestids = $this->input->post('contestids');
        $page_name = $this->input->post('page_nm');
        $ids_hash2 = $contestids.substr(time(), -5);

        if($page_name=="profile"){ ?>
            <p class="lb_title mb-0"><b>LeaderBoard, Top 10</b> <span class="dynamic_idhash"><a href="<?=base_url()?><?=$ids_hash2?>/entries-leaderboard/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a></span></p>
        <?php }else{ ?>
            <p class="lb_title mb-0"><b>LeaderBoard, Top 10</b> <a href="<?=base_url()?><?=$ids_hash2?>/entries-leaderboard/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a></p>
        <?php } ?>

        <div class="mt-3">
            <?php
            if($page_name=="profile"){
                echo "<div class='div_leaderboard'>";
                $empRecords = $this->sql_models->fetchProductsLeader($contestids, "", "", "", 10, 'entries', 'votes');
            }else{
                $empRecords = $this->sql_models->fetchProductsLeader($contestids, "", "", "", 10, 'entries', 'votes');
            }

            $t=1;
            if($empRecords){
                foreach ($empRecords as $rs) {
                    $names = ucwords(strtolower($rs['names']));
                    $nickname = ucwords(strtolower($rs['nickname']));
                    $names1 = strtolower($names);
                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                    if(strlen($names)<=2) $names = ucwords($nickname);
                    $names1 = str_replace(" ", "-", $names1);
                    $pics = $rs['pics'];
                    $votes = $rs['votes'];
                    $memid = $rs['contestant_id'];
                    $nows = substr(time(), -5);
                    $memid_hash = $memid.$nows;
                    $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                    $online_time = time_ago($online_timing);

                    $getBoosted = $this->sql_models->fetchBoosted($contestids, $memid);
                    $boosteds="";
                    if($getBoosted>0){
                        $boosteds = "<font style='font-weight: 600; font-size:14px'>(".@number_format($getBoosted)." Boosted)</font>";
                        //$boosteds = "<font style='font-weight: 600; font-size:14px'>(+Boosted)</font>";
                    }

                    $pic_pathi = base_url()."media_uploads1/$pics";
                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0){
                        $pic_pathi = base_url()."profiles1/$pics";

                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                        if($width1=="" || $width1<=0)
                            $pic_pathi = base_url()."profiles/$pics";
                    }

                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0)
                        $pic_pathi = base_url()."images/no_passport.jpg";

                    if($t%2==0) $odds = "odds"; else $odds = "";


                    $mychats1 = "";
                    if($this->myID==$memid){
                        $mychats1 = $this->sql_models->noOfChats($this->myID);
                        if($mychats1<=0) $mychats1="";
                    }

                    $mystatus = $this->sql_models->chkOnlinePresence($memid);
                    $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                    if($chechOnlineHidden) // visible
                        $last_seen="<span style='color:#093 !important;'>active</span>";
                    else
                        $last_seen="<span style='color:#777 !important;'>hidden</span>";

                    if($mystatus=="ash"){
                        if(strtotime($online_timing)>0){
                            if($chechOnlineHidden) // visible
                                $last_seen="<span style='color:#777 !important;'>$online_time</span>";
                            else
                                $last_seen="<span style='color:#777 !important;'>hidden</span>";
                        }else{
                          $last_seen="<span style='color:#777 !important;'>offline</span>";
                        }
                    }

                    ?>
                    <div class="clearfix post-recent inner_lb <?=$odds?>">
                        <div class="post-recent-thumb float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                            </a>
                        </div>
                        <div class="post-recent-content float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a>
                            <span class="text-muted vt_cnts vote_counts_lb<?=$contestids.$memid;?>"><?=@number_format($votes)?> votes <?=$boosteds?></span>
                            <span class="online_status_lb"><?=$last_seen?></span>
                        </div>
                    </div>
                <?php
                $t++;
                }
            }else{
                echo "<div style='padding: 20px 10px 30px 10px; text-align:center; color:#666; font-size: 18px;'>No entries found here</div>";
            }

            if($page_name=="profile"){
                echo "</div>";
            }
            ?>
        </div>
        <?php
    }



    function refresh_lbs__qz($id_sch){
    ?>
        <div class="mt-3">
            <?php
            $empRecords = $this->sql_models->fetchQuizScoresLB($id_sch);
            $t=1;
            if($empRecords){
                foreach ($empRecords as $rs) {
                    $names = ucwords(strtolower($rs['names']));
                    $nickname = ucwords(strtolower($rs['nickname']));
                    $names1 = strtolower($names);
                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                    if(strlen($names)<=2) $names = ucwords($nickname);
                    $names1 = str_replace(" ", "-", $names1);
                    $pics = $rs['pics'];
                    $scores = $rs['scores'];
                    $answers = $rs['answers'];

                    $answers = explode('||', $answers);
                    $answer_counts = count(array_unique($answers));

                    $memid = $rs['memid'];
                    $nows = substr(time(), -5);
                    $memid_hash = $memid.$nows;
                    $online_timing = date("Y-m-d g:i a", $rs['date_taken']);
                    $online_time = time_ago($online_timing);

                    $pic_pathi = base_url()."media_uploads1/$pics";
                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0){
                        $pic_pathi = base_url()."profiles1/$pics";

                        list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                        if($width1=="" || $width1<=0)
                            $pic_pathi = base_url()."profiles/$pics";
                    }

                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0)
                        $pic_pathi = base_url()."images/no_passport.jpg";

                    if($t%2==0) $odds = "odds"; else $odds = "";


                    $mystatus = $this->sql_models->chkOnlinePresence($memid);
                    $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                    if($chechOnlineHidden) // visible
                        $last_seen="<span style='color:#093 !important;'>active</span>";
                    else
                        $last_seen="<span style='color:#777 !important;'>hidden</span>";

                    if($mystatus=="ash"){
                        if(strtotime($online_timing)>0){
                            if($chechOnlineHidden) // visible
                                $last_seen="<span style='color:#777 !important;'>Seen: $online_time</span>";
                            else
                                $last_seen="<span style='color:#777 !important;'>hidden</span>";
                        }else{
                          $last_seen="<span style='color:#777 !important;'>offline</span>";
                        }
                    }

                    ?>
                    <div class="clearfix post-recent inner_lb <?=$odds?>">
                        <div class="post-recent-thumb float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                                <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                            </a>
                        </div>
                        <div class="post-recent-content content_quiz float-left">
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a>
                            <span class="text-muted">Answered: <?=$answer_counts?> questions</span>
                            <span class="text-muted">Score: <?=@number_format($scores)?>%</span>
                            <span class="online_status_lb"><?=$last_seen?></span>
                        </div>
                    </div>
                <?php
                $t++;
                }
            }else{
                echo "<div style='padding: 20px 10px 30px 10px; text-align:center; color:#666; font-size: 18px;'>No members found here</div>";
            }
            ?>
        </div>
    <?php
    }



    function contestContents(){
        $record=0;
        //$param1 = "pages";
        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');
        $txtpg = $this->input->post('txtpg');
        $url_titles = $this->uri->segment(2);
        //$recordPerPage = 18;
        $recordPerPage = 14;
        if($txtpg=="home")
            $recordPerPage = 8;

        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }

        $recordCount = $this->sql_models->countMyRecs('', 'contests', '');
        $recordCount1 = $this->sql_models->countMyRecs1('', $txtsrch, $txtpre, 'contests', '');
        $empRecord = $this->sql_models->fetchMyRecs('', $txtsrch, $txtpre, $record, $recordPerPage, 'contests', '', '');

        $config['base_url'] = base_url().'node/more_contests';
        
        ////////////////////
            $config["total_rows"] = $recordCount;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 5;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_contest" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
            
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';
        ////////////////////

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        if($record<=0) $record=1;
        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        if($empRecord){
            echo '<div class="row">';

                if($txtpg!="home"){
                    echo '<p class="srch_info">To view all, clear the search box and click on search button</p>';

                    echo "<div class='container' style='color:#333 !important; font-size:16px; text-align:center; margin: -5px 0 8px 0px; line-height:20px;'>Share any of these contests below and get 10VP each, refer to <a href='#popup_div' style='color:#09C' class='video-play-icon watch link_howitwk'>how it works</a> to get more information</div>";

                    echo "<div class='container' style='color:#666; font-size:16px; text-align:center; margin: 0px 0 30px 0px !important'>Showing $record of $recordPerPage of $recordCount contests found</div>";
                }

                $i = 1;
                foreach($empRecord as $post):
                    $ids = $post['id'];
                    $nows = substr(time(), -5);
                    $ids_hash = $ids.$nows;
                    $title = $post['title'];
                    $adv_title_f = cleanStr(strtolower($title));
                    $files = $post['files'];
                    $company_logo = $post['company_logo'];
                    $entry_type = $post['entry_type'];
                    $timings = $post['timings'];
                    $timings1 = date("Y-m-d H:i:s", $timings);
                    $start_date1 = strtotime($post['start_date']);
                    $start_date2 = @date("jS M, Y", $start_date1);
                    $sponsoredby = $post['sponsoredby'];
                    $sponsoredby_f = "";
                    if($sponsoredby!="")
                        $sponsoredby_f = cleanStrInputsDash(trim(strtolower($sponsoredby)))."/";
                    $start_date_contest1 = $post['start_date_contest'];
                    $start_date_contest = @date("jS M, Y", strtotime($post['start_date_contest']));
                    $close_date_entry1 = $post['close_date_entry'];
                    $views = kilomega($post['views']);
                    $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                    $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));

                    $currentTime = time();
                    $difference = $timings - $currentTime;

                    if($start_date1 <= $currentTime){
                        $c_expirys = convertTime1($difference);
                        $c_expirys = str_replace("time", "to go", $c_expirys);
                    }else{
                        $c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    }

                    if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                    
                    $url2 = base_url()."$ids_hash/join/$adv_title_f/";

                    $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                    $title_1 = str_replace("&", "and", $title_1);

                    $title = str_replace("'", "&prime;", $title);
                    $descrips_whatsapp = "*'".ucwords($title)."'* is hosting a contest at the moment, join now and stand a chance to win prizes.";

                    $descrips = "'".ucwords($title)."' is hosting a contest at the moment, join now and stand a chance to win prizes.";
                    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                    $shareConCounts = kilomega($this->sql_models->shareConCounts($ids));
                    $share_cap = "Share";

                    if($shareConCounts > 1) $share_cap = "Shares";

                    $countdowns1="";
                    $onedays = time()+108000;
                    if(strtotime($timings1) <= $onedays) $countdowns1 = "countdowns1";

                    $comments = $this->sql_models->fetchComments('comments', $ids, 20);
                    $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
                    $repliesCounts = $this->sql_models->fetchCommentsCounts1('replies', $ids);
                    $allCcounts = $commentsCounts+$repliesCounts;

                    $contest_img = base_url()."contest_types/$files";
                    $logo_img = base_url()."companys/$company_logo";

                    $img_logo1 = "";
                    if($company_logo != ""){
                        $img_logo1 = "<img src='$logo_img' class='curve_logo mt-10'>";
                    }

                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($contest_img);
                    if($width1=="" || $width1<=0)
                        $contest_img = base_url()."images/no-image.jpg";

                    if($company_logo!=""){
                        $width1="";
                        list($width1, $height1, $type1, $attr1) = @getimagesize($logo_img);
                        if($width1=="" || $width1<=0)
                            $logo_img = base_url()."companys/logo1.jpg";
                    }

                    $mb_30 = "mb-30";
                    if($i == 9){ // if kk is 6
                        $mb_30 = "mb-0";
                    }

                ?>

                    <?php
                    if($txtpg=="home")
                        echo "<div class='col-lg-4 col-md-6 $mb_30'>";
                    else
                        echo '<div class="col-lg-6 col-md-12 mb-4_pb-2 mb-40">';
                    ?>

                        <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                            <div class="position-relative">
                                <img src="<?=$contest_img?>" class="card-img-top rounded-top" alt="...">
                                <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/">
                                    <div class="overlay rounded-top bg-dark"></div>
                                </a>
                            </div>

                            <div class="card-body content p-10_ pl-15_pr-15 p-0">

                                <?php if($company_logo!=""){ ?>
                                <div class="row p-0">
                                    <div class="col-9" style="background-colors: green">
                                <?php } ?>
                                        <?php $title = strtolower($title); ?>
                                        <h5 class="p-15"><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/" class="card-title card-title1 title text-dark font-bold1"><?=ucwords($title)?></a></h5>

                                        <?php if($company_logo!=""){ ?>
                                    </div>
                                    <?php } ?>

                                    <?php if($company_logo!=""){ ?>
                                    <div class="col-3 mt-xs-5" style="background-colors: blue">
                                    <?php } ?>
                                        <a href="<?=base_url()?>sponsor/<?=$sponsoredby_f?>" class="mr_right_">
                                            <?=$img_logo1?>
                                        </a>

                                        <?php if($company_logo!=""){ ?>
                                    </div>
                                </div>
                                <?php } ?>


                                <div class="for_timings pl-15 pr-15 pb-5 <?=$countdowns1?>">
                                    <?php
                                    if($start_date1!="" && $start_date1 <= $currentTime){
                                        if(strtotime($close_date_entry1) >= time() && $close_date_entry1 != ""){
                                            //echo 'Entry Stops at '.$close_date_entry1;
                                            echo "Entries in progress...";
                                        }else{
                                            if($close_date_entry1 == ""){
                                                if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                    echo "Entries in progress...";
                                                else
                                                    echo "<b>$c_expirys</b>";
                                            }else{
                                                if($start_date1 <= time() && strtotime($start_date_contest1) >= time())
                                                    echo "Entries in progress...";
                                                else
                                                    echo "<b>$c_expirys</b>";
                                            }
                                        }
                                    }else{
                                        if($start_date1!="" && $start_date1 >= time())
                                            echo 'Coming on '.$start_date2.'!';
                                        else
                                            echo "Entries in progress...";
                                    }
                                    ?>

                                    <a href="javascript:void(0)" class="text-muted comments ml-15">
                                        <i class="mdi mdi-comment-outline"></i> <?=$allCcounts?>
                                    </a>
                                </div>


                                <?php
                                if($entry_type=="free" || $entry_type=="")
                                    echo '<div class="for_free"></div>';
                                else if($entry_type=="coded" || $entry_type=="")
                                    echo '<div class="for_free_code"></div>';
                                ?>


                                <div class="post-meta d-flex justify-content-between mt-60">
                                    <div class="company_stats p-10 mt-0">
                                        <span><a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><?=$noOfEntries?> Entries</a></span>
                                        <span><?=$noOfVotes?> Votes</span>
                                        <span><?=$views1?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="author_">
                                <!-- <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                                <small class="text-light date"><i class="mdi mdi-calendar-check"></i> 13th August,
                                    2019</small> -->

                                <div class="inner_img">
                                    <div class="company_btns company_btns_inx">
                                        <a href="<?=base_url()?><?=$ids_hash?>/join/<?=$adv_title_f?>/"><span>Join</span></a>
                                        <span class="social_menu" id1="<?=$ids?>">
                                            <font style="font-size: 14px; color: #7BF"><?=$shareConCounts?></font> <?=$share_cap?>
                                        </span>
                                    </div>

                                    <div class="social_btns join_social_btns" id="social_btns<?=$ids?>">
                                        <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-facebook-f"></i></a></span>

                                        <span class="for_desktop2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                        <span class="for_mobile2"><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-whatsapp"></i></a></span>

                                        <span><a contestid1="<?=$ids?>" memid1="<?=$this->myID?>" href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank" class="rounded"><i class="fea icon-sm fea-social fa fa-twitter"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if($txtpg=="home")
                        $nums=8;
                    else
                        $nums=4;
                    ?>

                    <?php if($i%$nums==0){ ?>
                        <?php
                        $get_ads = $this->sql_models->getADS('300x600', 'contest space', 'noarray', '');
                        if($get_ads){
                            $files = $get_ads['files'];
                            $urls1 = $get_ads['urls1'];
                            $title = ucwords($get_ads['title']);
                            $files1 = base_url()."adverts1/$files";
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            if(preg_match($reg_exUrl, $urls1, $url)) {
                                $urls1 = "$urls1";
                            } else {
                                $urls1 = "mailto:$urls1";
                            }
                        ?>
                            <!-- This is for adverts -->
                            <?php
                            if($txtpg=="home")
                                echo "<div class='col-lg-4 col-md-6 $mb_30'>";
                            else
                                echo '<div class="col-lg-6 col-md-12 mb-40">';
                            ?>
                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                    <div class="position-relative">
                                        <img src="<?=$files1?>" class="card-img-top card-img-adv rounded-top" alt="">
                                        <a href="<?=$urls1?>" target="_blank">
                                            <div class="overlay rounded-top bg-dark"></div>
                                        </a>
                                    </div>

                                    <div class="card-body content p-0">
                                        <div class="post-meta d-flex justify-content-between mt-60">
                                            <div class="company_stats company_ads mt-0 p-0 pt-5">
                                               <div class="sponsorads"><< Sponsored Ads >></div>
                                               <h5><a href="<?=$urls1?>" target="_blank" style="color: #666 !important; font-size: 17px !important;"><?=$title?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- This is for adverts -->
                        <?php
                        }else{ ?>

                            <?php
                            if($txtpg=="home")
                                echo "<div class='col-lg-4 col-md-6 $mb_30'>";
                            else
                                echo '<div class="col-lg-6 col-md-12 mb-40">';
                            ?>
                                <div class="card blog rounded border-0 shadow" style="overflow: hidden;">
                                    <div class="position-relative">
                                        <img src="<?=base_url()?>images/bizz.jpg" class="card-img-top rounded-top" alt="...">
                                        <a href="javascript:;">
                                            <div class="overlay rounded-top bg-dark"></div>
                                        </a>
                                    </div>
                                    <div class="card-body content p-0">
                                        
                                        <h5 class="p-15"><a href="javascript:;" class="card-title card-title1 title" style="color: #666 !important; font-size: 17px !important;">PLACE YOUR BUSINESS HERE</a></h5>

                                        <p class="pl-15 pr-15" style="margin: -16px 0 0 0"><a href="<?=base_url()?>contact/#contact" style="color: #09C">Click here to contact us</a></p>

                                        <div class="post-meta d-flex justify-content-between mt-60">
                                            <div class="company_stats company_ads p-10 mt-0">
                                               << FREE SPACE >>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        }
                    ?>

                <?php
                $i++;
                endforeach; ?>

                <div style="clear: both;"></div>
                <div class="col-12 mt-10 mb-10">
                    <?php
                    if($txtpg!="home")
                        echo $pagination;
                    else{ ?>
                        <br>
                        <div style="clear: both;"></div>
                        <?php if($recordCount >= 12){
                            if($txtpre=="")
                                $txtpres = "";
                            else
                                $txtpres = "$txtpre/";
                        ?>
                            <div class="open_contests text-center mt-xs-30 mb--15 mt-0"><a href="<?=base_url()?>contests/<?=$txtpres?>">View more <i class="fa fa-caret-right"></i></a></div>
                        <?php } ?>
                    <?php }
                    ?>
                </div>
            </div>

        <?php }else{ ?>
        
        <div class='container' style='color:#777; font-size:18px; text-align:center; margin: 10px 0 30px 0px !important'>No contest found!<br>Try reloading the page or search for something else.</div>


        <?php
        }

    }



    function all_searches(){
        $cats = $this->input->post('cats');
        $locn = $this->input->post('locn');
        $keywords = $this->input->post('keywords');
        $campaignRecords = $this->sql_models->fetchCampaigns_rough('', $cats, '', $locn, $keywords, '', '');

        // $now = 865000;
        // $cookie = array(
        //     'name'              => 'keywords1',
        //     'value'             => $keywords,
        //     'expire'            => $now,
        //     'secure'            => FALSE
        // );
        // set_cookie($cookie);
        echo $campaignRecords;
    }

    
    function retain_page_id($txt_contestID, $txt_ad_name, $txt_other_params3){
        //echo $txt_other_params3; exit;
        $now = 865000;
        $cookie = array(
            'name'        => 'retain_page_id1',
            'value'       => $txt_contestID,
            'expire'      => $now,
            'secure'      => FALSE
        );
        $cookie1 = array(
            'name'        => 'retain_page_name',
            'value'       => $txt_ad_name,
            'expire'      => $now,
            'secure'      => FALSE
        );
        $cookie2 = array(
            'name'        => 'retain_page_params3',
            'value'       => $txt_other_params3,
            'expire'      => $now,
            'secure'      => FALSE
        );
        set_cookie($cookie);
        set_cookie($cookie1);
        set_cookie($cookie2);
    }



    function retain_page_id1(){
        $txt_contestID = $this->input->post('txt_contestID');
        $txt_ad_name = $this->input->post('txt_ad_name');
        $txt_other_params3 = $this->input->post('txt_other_params3');

        $now = 865000;
        $cookie = array(
            'name'        => 'retain_page_id1',
            'value'       => $txt_contestID,
            'expire'      => $now,
            'secure'      => FALSE
        );
        $cookie1 = array(
            'name'        => 'retain_page_name',
            'value'       => $txt_ad_name,
            'expire'      => $now,
            'secure'      => FALSE
        );
        $cookie2 = array(
            'name'        => 'retain_page_params3',
            'value'       => $txt_other_params3,
            'expire'      => $now,
            'secure'      => FALSE
        );
        set_cookie($cookie);
        set_cookie($cookie1);
        set_cookie($cookie2);
    }



    function remove_session_cID(){
        $cookie = array(
            'name'   => 'retain_page_id1',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        $cookie1 = array(
            'name'   => 'retain_page_name',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        $cookie2 = array(
            'name'   => 'retain_page_params3',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        delete_cookie($cookie);
        delete_cookie($cookie1);
        delete_cookie($cookie2);
    }



    function change_advt(){
        $adverts = $this->sql_models->fetchAds('adverts', 'skyscraper');
        if($adverts){
            $ad_img = $adverts[0]['image'];
            $ad_banner = $adverts[0]['banner'];
            if($ad_banner == "skyscraper"){
                echo "<img class='img_size_skyscraper' src='".base_url()."adverts1/$ad_img' alt=''>";
            }
        }
        echo "<br><br>";
    }



    function upload_medias(){
        $profileComplete = $this->sql_models->profileComplete($this->myID);
        if($profileComplete){
            echo "Please <a href='".base_url()."dashboard/profile/' target='_blank' style='color: #06C'>complete your profile</a> before you continue";
            exit;
        }

        $this->form_validation->set_rules('txtdescrip', 'Description', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtdescrip = $this->input->post('txtdescrip');
            $txtcontestID = $this->input->post('txtcontestID');
            $txtupdates = $this->input->post('txtupdates'); // 1 means updating
            $txtmedia = strtolower($this->input->post('txtmedia'));
            $txtfiles1 = $this->input->post('txtfiles1', TRUE); // array
            $url_params = $this->input->post('txt_url_params');
            $txt_url_params_ID = $this->input->post('txt_url_params_ID');
            
            $filesCount = count($_FILES['txtphoto']['name']);
            $gen_num1=time();
            $gen_num1=substr($gen_num1,5);

            $hasUploaded_entry = $this->sql_models->hasUploadedEntry($txtcontestID, $this->myID, 'entries');

            if(!$hasUploaded_entry){
                $newdata3 = array(
                    'contest_id'       => $txtcontestID,
                    'contestant_id'    => $this->myID,
                    'votes'            => 0,
                    'views'            => 0,
                    'date_created'     => date("Y-m-d g:i a", time())
                );

                if($txtupdates == 1){
                    $this->db->where('contest_id', $txtcontestID)->where('contestant_id', $this->myID);
                    $query_del = $this->db->delete('entry_media');
                }

                $hasUploaded = false;
                for($i = 0; $i < $filesCount; $i++){
                    $ext2 = strtolower(pathinfo($_FILES['txtphoto']['name'][$i], PATHINFO_EXTENSION));

                    if($txtmedia=="photo")
                        $img_ext_chk = array('jpg','jpeg');
                    else
                        $img_ext_chk = array('mp4');
        
                    if(!in_array($ext2,$img_ext_chk)){
                        echo "Please upload your $txtmedia";
                        exit;
                    }else if(isset($_FILES['txtphoto']['size'][$i]) && $_FILES['txtphoto']['size'][$i] > 104857600){
                        echo "The $txtmedia(s) has exceeded 100MB<br>";
                        exit;
                    }else{
                        $randm = time();
                        $rename_file = $randm.$i.".$ext2";

                        $url_source = "fake_fols/".$rename_file;
                        $url_dest = "media_uploads/";
        
                        $new_name2 = $rename_file;
                        $file_tmp = $_FILES["txtphoto"]["tmp_name"][$i];
                        if(is_uploaded_file($file_tmp)){
                            if($txtupdates == 1){
                                $this->sql_models->delete_medias($txtfiles1, 'media_uploads/', 'media_uploads1/');
                            }

                            if($txtmedia=="photo"){
                                if(move_uploaded_file($file_tmp, $url_source)){
                                    $hasUploaded = true;
                                }
                                $this->resizeImage($url_source, $url_dest, 500, 500, TRUE);
                            }else{
                                $url_dest = "media_uploads/".$rename_file;
                                if(move_uploaded_file($file_tmp, $url_dest)){
                                    $hasUploaded = true;
                                }
                            }

                            $datas = array(
                                'contest_id'        => $txtcontestID,
                                'contestant_id'     => $this->myID,
                                'descrip'           => $txtdescrip,
                                'files'             => $new_name2
                            );
                            $insert = $this->db->insert('entry_media', $datas);
                        }
                    }
                }

                if($hasUploaded){
                    if($txtupdates == 0){ // im not updating so dont add to entries table
                        $insert = $this->db->insert('entries', $newdata3);

                        $contestDetails = $this->sql_models->getContestDetails($txtcontestID);
                        $user_id_spon = $contestDetails['user_id'];
                        if($user_id_spon != $this->myID){

                            $this->sql_models->countAllNotiAndDelete();

                            $datas = array(
                                'memid'             => $this->myID,
                                'user_id'           => $user_id_spon,
                                'what_page'         => $url_params,
                                'page_id'           => $txt_url_params_ID,
                                'has_read'          => 0,
                                'actns'             => "joined",
                                'date_created'      => date("Y-m-d g:i a", time())
                            );
                            $this->db->insert('all_notifications', $datas);
                        }
                    }
                    echo "inserted";
                }else{
                    echo "Error in uploading $txtmedia";
                    //print_r($_FILES["txtphoto"]["error"]);
                }
            }else{
                echo "Duplicate entry detected! You have already uploaded!";
            }
        }
    }



    function update_views(){
        $ids = $this->input->post('ids');
        $ids = substr($ids, 0, -5);
        $this->sql_models->updateSchViews($ids);
    }


    function update_reads(){
        $ids = $this->input->post('ids');
        $tbls = $this->input->post('tbls');
        $this->sql_models->updateReads($ids, $tbls);
    }


    function fetch_codes(){
        $contest_id = $this->input->post('contest_id');
        $contestCodes = $this->sql_models->contestCodes('contest_codes', $contest_id);
        if($contestCodes){
            foreach($contestCodes as $row){
                $codes = $row['codes'];
                if($codes!=""){
            ?>
            <div class="form-group mt-5 mb-0 col-md-12 pr-5 pl-5 div_deletes div_delete_code<?=$codes?>" style="display: block;">
                <div class="delete_code"><span><i class="fa fa-close" codes="<?=$codes?>" contest_id="<?=$contest_id?>"></i></span>&nbsp; <?=$codes?></div>
            </div>
            <?php              
            }  
            }
        }
    }


    function delete_code(){
        $contest_id = $this->input->post('contest_id');
        $codes = $this->input->post('codes');
        $this->db->where('contest_id', $contest_id)->where('codes', $codes);
        $query = $this->db->delete('contest_codes');
        if($query) echo "deleted"; else echo "error";
    }




    function update_my_pass(){
        $this->form_validation->set_rules('txtpass1', 'old password', 'required|trim');
        $this->form_validation->set_rules('txtpass2', 'new password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('txtpass3', 'confirm password', 'required|trim|matches[txtpass2]|min_length[5]');
        $oldpass = $this->input->post('txtpass1');
        $admin_type = $this->input->post('admin_type');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $new_pass = hash_password($this->input->post('txtpass3'));
            if($admin_type=="00")
                $updated = $this->sql_models->update_adm_password(sha1($this->input->post('txtpass3')), sha1($oldpass));
            else
                $updated = $this->sql_models->update_password($new_pass, $oldpass);

            if($updated){
                $now = 865000;
                if($admin_type=="00") $cookie_name = "adm_password_iconts"; else $cookie_name = "icont_pass";
                $cookie = array(
                    'name'   => $cookie_name,
                    'value'  => $new_pass,
                    'expire' => $now,
                    'secure' => FALSE
                );
                set_cookie($cookie);
                echo "pass1_updated";
            }else{
                echo "Invalid old password!";
            }
        }
    }



    function update_my_settings(){
        //$this->form_validation->set_rules('txtentfee', 'Entry Fee Charges', 'required|trim|numeric|max_length[3]');
        //$this->form_validation->set_rules('txtpaid_votes', 'Paid Votes Charges', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('txtwfc', 'Withdrawal Fee Charges', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('txttfc', 'Trasfer Fee Charges', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('txtsfc', 'Sponsor Fee', 'required|trim|numeric|max_length[6]');
        $this->form_validation->set_rules('txtrc', 'Referral Charges', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('txtcb', 'Agent Cash Back', 'required|trim|numeric|max_length[3]');
        
        //$txtentfee = $this->input->post('txtentfee');
        //$txtpaid_votes = $this->input->post('txtpaid_votes');
        $txtwfc = $this->input->post('txtwfc');
        $txttfc = $this->input->post('txttfc');
        $txtsfc = $this->input->post('txtsfc');
        $txtrc = $this->input->post('txtrc');
        $txtcb = $this->input->post('txtcb');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            
            $data1 = array(
                //'entry_fee'         => $txtentfee,
                //'paid_votes'        => $txtpaid_votes,
                'withdraw_fee'      => $txtwfc,
                'transfer_fee'      => $txttfc,
                'be_a_sponsor'      => $txtsfc,
                'give_referral'     => $txtrc,
                'cash_back'         => $txtcb,
            );
            $updated = $this->sql_models->updateSettings1($data1, 'settings1');
            if($updated)
                echo "setting_updated";
            else
                echo "Error!";
        }
    }



    function update_contest_setting(){
        $this->form_validation->set_rules('txtentfee', 'Entry Fee Charges', 'required|trim|numeric|max_length[3]');

        $this->form_validation->set_rules('txtcf', 'Contest Fee 1', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txtpaid_votes', 'Paid Votes Charges 1', 'required|trim|numeric|max_length[3]');

        $this->form_validation->set_rules('txtcf2', 'Contest Fee 2', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txtpaid_votes2', 'Paid Votes Charges 2', 'required|trim|numeric|max_length[3]');

        $this->form_validation->set_rules('txtcf3', 'Contest Fee 3', 'required|trim|numeric|max_length[8]');
        $this->form_validation->set_rules('txtpaid_votes', 'Paid Votes Charges 3', 'required|trim|numeric|max_length[3]');

        
        $txtentfee = $this->input->post('txtentfee');
        $txtcf = $this->input->post('txtcf');
        $txtpaid_votes = $this->input->post('txtpaid_votes');

        $txtcf2 = $this->input->post('txtcf2');
        $txtpaid_votes2 = $this->input->post('txtpaid_votes2');

        $txtcf3 = $this->input->post('txtcf3');
        $txtpaid_votes3 = $this->input->post('txtpaid_votes3');
        
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            
            $data1 = array(
                'entry_fee'         => $txtentfee,
                'contest_fee'        => $txtcf,
                'paid_votes'         => $txtpaid_votes,
                'contest_fee2'       => $txtcf2,
                'paid_votes2'        => $txtpaid_votes2,
                'contest_fee3'       => $txtcf3,
                'paid_votes3'        => $txtpaid_votes3
                
            );
            $updated = $this->sql_models->updateSettings1($data1, 'settings1');
            if($updated)
                echo "setting_updated";
            else
                echo "Error!";
        }
    }



    function update_my_settings1(){
        $this->form_validation->set_rules('txt250_1', '250x250 banner1', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt250_2', '250x250 banner2', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt250_3', '250x250 banner3', 'required|trim|numeric|max_length[7]');

        $this->form_validation->set_rules('txt780_1', '780x90 banner1', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt780_2', '780x90 banner2', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt780_3', '780x90 banner3', 'required|trim|numeric|max_length[7]');

        $this->form_validation->set_rules('txt300_1', '300x600 banner1', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt300_2', '300x600 banner2', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt300_3', '300x600 banner3', 'required|trim|numeric|max_length[7]');

        $this->form_validation->set_rules('txt1300_1', '1360x510 banner1', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt1300_2', '1360x510 banner2', 'required|trim|numeric|max_length[7]');
        $this->form_validation->set_rules('txt1300_3', '1360x510 banner3', 'required|trim|numeric|max_length[7]');

        $myarrs = $_POST;
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $i=1;
            foreach ($myarrs as $key => $value) {
                $this->db->where('id', $i);    
                $this->db->set('fees', $value);
                $updated = $this->db->update('advert_settings');
                $i++;
            }

            if($updated)
                echo "setting_updated";
            else
                echo "Error!";
        }
    }



    function store_payments(){
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim');
        $txtamts = $this->input->post('amount');
        $user_id = $this->input->post('user_id');
        $response = $this->input->post('response');
        $pay_mthd = $this->input->post('pay_mthd');
        $txtflutter = $this->input->post('txtflutter');
        $payment_status = $this->input->post('payment_status');

        if($payment_status==1){
            $payment_status1 = "Credit Card";
        }else{
            $payment_status1 = "Bank Deposit";
        }

        if($txtflutter==1){
            echo "This feature has been disabled!";
            exit;
        }

        $checkVP = $this->sql_models->checkVP($user_id);
        
        if($this->form_validation->run() == FALSE){
            //echo validation_errors();
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
        }else{

            if($txtamts < 100){
                $arrs = array('type'=>'error', 'msg'=>"Minimum amount should be &#8358;100", 'msg1'=>'', 'msg2'=>'');

            }else if($checkVP < 100 && $pay_mthd == "vp"){
                $arrs = array('type'=>'error', 'msg'=>"Insufficient VP to proceed, please reload page.", 'msg1'=>'', 'msg2'=>'');

            }else if($txtamts < 100 && $pay_mthd == "vp"){
                $arrs = array('type'=>'error', 'msg'=>"Your VP is not up to &#8358;100 to proceed", 'msg1'=>'', 'msg2'=>'');
            }else{

                if($pay_mthd=="") $pay_mthd="manual";
        
                $data1 = array(
                    'memid'         => $user_id,
                    'amt'           => $txtamts,
                    'paid'          => $payment_status,
                    'method1'       => $pay_mthd,
                    'date_created'  => date("Y-m-d g:i a", time())
                );

                //print_r($data1); exit;

                $updated = $this->sql_models->updateWallets($data1, $txtamts, $payment_status, $pay_mthd);
                //$updated=true;
                if($updated){
                    if($pay_mthd=="paystack" || $pay_mthd=="flutterwave"){
                        //////////////////FOR EMAILS/////////////////////////
                            $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello Admin,</b></p>";
                            $dated = date("jS M, Y, h:i a", time());

                            $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                            A Wallet Credit Transaction with the following details has occured<br><br>

                            <b>Username:</b> $this->nickname<br>
                            <b>Full Name:</b> $this->myfullname<br>
                            <b>Email:</b> $this->mymail<br>
                            <b>Amount: &#8358;".@number_format($txtamts)."</b><br>
                            <b>Date:</b> $dated<br>
                            <b>Source:</b> $payment_status1<br><br>

                            <a href='".base_url()."shields/member_wallets/' target='_blank'>Click Here</a>, to take required action.</p>";
                        //////////////////FOR EMAILS///////////////////////// 

                        $subj = "&#8358;".@number_format($txtamts)." Wallet Credit Alert From ".ucwords($this->myfullname);
                        $from = $this->myfullname." <noReply@icontestpro.com>";
                        $to = "icontestprobox@gmail.com";
                        $from_name = $this->myfullname." | Wallet Transaction";

                        $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                        $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                    }

                    //echo "credited";
                    $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
                    $retain_page_name = $this->input->cookie('retain_page_name', TRUE);

                    $arrs = array('type'=>'success', 'msg'=>"credited", 'msg1'=>$retain_page_id1, 'msg2'=>$retain_page_name);
                }else{
                    //echo "Error!";
                    $arrs = array('type'=>'error', 'msg'=>"Error!", 'msg1'=>"", 'msg2'=>"");
                }
            }
        }
        echo json_encode($arrs);
    }



    function update_btn_flutter(){
        $flutterwave_setting = $this->sql_models->flutterwave_setting();
        if($flutterwave_setting == 1) echo "locked"; else echo "unlocked";
    }



    function check_transfer_details(){
        $this->form_validation->set_rules('txtramt', 'Amount', 'required|trim|numeric');
        $this->form_validation->set_rules('txtremail', 'Email or phone', 'required|trim');

        $txtramt = $this->input->post('txtramt');
        $txtremail = $this->input->post('txtremail');
        $txtmywallet = $this->input->post('txtmywallet');

        $getSponDetails = $this->sql_models->getSponDetails($this->myID);
        $getMemTransferID = $this->sql_models->getMemTransferID($txtremail);

        if($getSponDetails){ // if im a sponsor
            $arrs = array('type'=>'error', 'msg'=>"This feature is disabled for a sponsor account!", 'msg1'=>'', 'msg2'=>'');

        }else if($getMemTransferID <= 0){ // if im a sponsor
            $arrs = array('type'=>'error', 'msg'=>"The Recipient's detail is incorrect!", 'msg1'=>'', 'msg2'=>'');

        }else{
        
            if($this->form_validation->run() == FALSE){
                $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
            }else{

                if($txtramt < 100){
                    $arrs = array('type'=>'error', 'msg'=>"Minimum allowed to proceed is &#8358;100.", 'msg1'=>'', 'msg2'=>'');

                }else if($txtramt > $txtmywallet){
                    $arrs = array('type'=>'error', 'msg'=>"Amount entered is greater than your wallet amount.", 'msg1'=>'', 'msg2'=>'');

                }else if($txtremail == $this->mymail){
                    $arrs = array('type'=>'error', 'msg'=>"Error! Cannot transfer to the same account!", 'msg1'=>'', 'msg2'=>'');

                }else{

                    $checkWallet = $this->sql_models->checkWallet($this->myID, $txtramt);
                    if($checkWallet){ // check again
                        $getMemID = $getMemTransferID['id'];
                        $getMemNames = ucfirst($getMemTransferID['nickname']);
                        $arrs = array('type'=>'success', 'msg'=>"successful_checks", 'msg1'=>$getMemID, 'msg2'=>$getMemNames);
                    }else{
                        $arrs = array('type'=>'error', 'msg'=>"Amount entered is greater than your wallet amount.", 'msg1'=>'', 'msg2'=>'');
                    }
                }
            }
        }
        echo json_encode($arrs);
    }



    function submit_vp_sale(){
        $txtamts = $this->input->post('txtamts');
        $txtaccts = $this->input->post('txtaccts');
        if($this->myID>0){

            $data1 = array(
                'memid'             => $this->myID,
                'sell_at'           => $txtamts,
                'acct_details'      => $txtaccts,
                'date_created'      => date("Y-m-d g:i a", time())
            );

            $checkID = $this->sql_models->checkMemID($this->myID);
            if($checkID){
                $this->db->set('sell_at', $txtamts);
                $this->db->set('acct_details', $txtaccts);
                $this->db->where('memid', $this->myID);
                $inserted = $this->db->update('vp_market');
            }else{
                $inserted = $this->db->insert('vp_market', $data1);    
            }
            
            if($inserted) echo "success"; else echo "Poor network connection, please try again.";
        }
    }



    
    function submit_vp_buy(){
        $seller_vp = $this->input->post('seller_vp');
        $buyer_id = $this->input->post('buyer_id');
        $amount = $this->input->post('amount');
        $seller_id = $this->input->post('seller_id');
        $txtvps = $this->input->post('txtvps');
        $txtnotes = $this->input->post('txtnotes');
        $pay_mthd_vp = $this->input->post('pay_mthd_vp');

        if($this->myID>0){

            if($buyer_id==$seller_id){
                echo "Error! Self transaction cannot continue!";
            }else if($txtvps > $seller_vp){
                echo "The amount of VP you entered is more than what the seller has.";
            }else{

                $data1 = array(
                    'buyer_id'          => $buyer_id,
                    'seller_id'         => $seller_id,
                    'vps'               => $txtvps,
                    'notes'             => $txtnotes,
                    'amount'            => $amount,
                    'payment_mthd'      => $pay_mthd_vp,
                    'date_created'      => date("Y-m-d g:i a", time())
                );
                $inserted = $this->db->insert('buy_vp', $data1);  
                            
                if($inserted){

                    $this->db->set('vp', "vp-$txtvps", FALSE);
                    $this->db->where('id', $seller_id)->where('vp >=', $txtvps);
                    $this->db->update('members');

                    $this->db->set('vp', "vp+$txtvps", FALSE);
                    $this->db->set('wallet', "wallet-$amount", FALSE);
                    $this->db->where('id', $buyer_id);
                    $this->db->update('members');
                    
                    $getSponDetls = $this->sql_models->getDetails($seller_id);
                    $getSponEmail = strtolower($getSponDetls['emails']);
                    $getSponName = ucwords($getSponDetls['names']);
                    $getSponNick = ucwords($getSponDetls['nickname']);
                    if(strlen($getSponName)<=2) $getSponName = ucwords($getSponNick);

                    $getSponDetls2 = $this->sql_models->getDetails($buyer_id);
                    $getSponEmail2 = strtolower($getSponDetls2['emails']);
                    $getSponName2 = ucwords($getSponDetls2['names']);
                    $getSponNick2 = ucwords($getSponDetls2['nickname']);
                    if(strlen($getSponName2)<=2) $getSponName2 = ucwords($getSponNick2);

                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $getSponName,</b></p>";
                        $dated = date("jS M, Y, h:i a", time());

                        $message_contents .= "<p style='margin-top:5px; font-size: 16px;'>
                        A buyer $getSponName2 has requested to buy $txtvps VPs from you at &#8358;".@number_format($amount).". A transaction has been made successfully and $txtvps VPs have been deducted from your wallet.</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "NGN".@number_format($amount)." VP Purchase From ".ucwords($getSponName2);
                    $from = $getSponName2." <noReply@icontestpro.com>";
                    $to = $getSponEmail;
                    $from_name = $getSponName2." @ VP Market iContestPRO";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                    
                    echo "success";
                }else{
                    echo "Poor network connection, please try again.";   
                }
            }
        }
    }



    function check_transfer_details2(){
        $txtramt = $this->input->post('txtramt');
        $txtreci_id = $this->input->post('txtreci_id');
        $txtmywallet = $this->input->post('txtmywallet');

        $data1 = array(
            'sender_id'         => $this->myID,
            'recipient_id'      => $txtreci_id,
            'amount'            => $txtramt,
            'date_created'      => date("Y-m-d g:i a", time())
        );
        $inserted = $this->db->insert('transfer_history', $data1);
        if($inserted){
            /// do some updates on the wallets ///
                $txtramt1 = $txtramt;
                if($this->agents==2){
                    $txtramts = ($this->cash_back/100) * $txtramt; // (2/100)*10,000 = 200
                    $txtramt1 = $txtramt - $txtramts; // 9,800
                }
                $this->db->set('wallet', "wallet-$txtramt1", FALSE); // remove 9,800 instead of 10,000
                $this->db->where('id', $this->myID)->where('wallet >=', $txtramt);
                $query = $this->db->update('members');

                $this->db->set('wallet', "wallet+$txtramt", FALSE);
                $this->db->where('id', $txtreci_id);
                $query = $this->db->update('members');
            /// do some updates on the wallets ///
            $arrs = array('type'=>'success', 'msg'=>"transfered");

        }else{
            $arrs = array('type'=>'error', 'msg'=>"Error!");
        }
        
        echo json_encode($arrs);
    }


    function check_transfer_details_admin(){
        $this->form_validation->set_rules('txtramt', 'Amount', 'required|trim|numeric');
        $this->form_validation->set_rules('txtremail', 'Email or phone', 'required|trim');
        $this->form_validation->set_rules('txtreason', 'Reason', 'required|trim|min_length[20]');

        $txtramt = $this->input->post('txtramt');
        $txtremail = $this->input->post('txtremail');
        $txtmywallet = $this->input->post('txtmywallet');
        $txtreason = $this->input->post('txtreason');

        $getMemTransferID = $this->sql_models->getMemTransferID($txtremail);

        if($getMemTransferID <= 0){
            $arrs = array('type'=>'error', 'msg'=>"The Recipient's detail is incorrect!", 'msg1'=>'', 'msg2'=>'');

        }else{
        
            if($this->form_validation->run() == FALSE){
                $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
            }else{

                if($txtramt < 100){
                    $arrs = array('type'=>'error', 'msg'=>"Minimum allowed to proceed is &#8358;100.", 'msg1'=>'', 'msg2'=>'');

                }else if($txtramt > $txtmywallet){
                    $arrs = array('type'=>'error', 'msg'=>"Amount entered is greater than your wallet amount.", 'msg1'=>'', 'msg2'=>'');

                //}else if($txtremail == $this->mymail){
                    //$arrs = array('type'=>'error', 'msg'=>"Error! Cannot transfer to the same account!", 'msg1'=>'', 'msg2'=>'');

                }else{

                    $checkWallet = $this->sql_models->checkAdminWallet($txtramt);
                    if($checkWallet){ // check again
                        $getMemID = $getMemTransferID['id'];
                        $getMemNames = ucfirst($getMemTransferID['nickname']);
                        $arrs = array('type'=>'success', 'msg'=>"successful_checks", 'msg1'=>$getMemID, 'msg2'=>$getMemNames);
                    }else{
                        $arrs = array('type'=>'error', 'msg'=>"Amount entered is greater than your wallet amount.", 'msg1'=>'', 'msg2'=>'');
                    }
                }
            }
        }
        echo json_encode($arrs);
    }


    function check_transfer_details2_admin(){
        $txtramt = $this->input->post('txtramt');
        $txtreci_id = $this->input->post('txtreci_id');
        $txtmywallet = $this->input->post('txtmywallet');
        $txtreason = $this->input->post('txtreason');

        $data1 = array(
            'sender_id'         => 0,
            'recipient_id'      => $txtreci_id,
            'amount'            => $txtramt,
            'reasons'           => $txtreason,
            'date_created'      => date("Y-m-d g:i a", time())
        );
        $inserted = $this->db->insert('transfer_history', $data1);
        if($inserted){
            /// do some updates on the wallets ///
                
                $this->db->set('admin_wallet', "admin_wallet-$txtramt", FALSE);
                $this->db->where('id', 1)->where('admin_wallet >=', $txtramt);
                $query = $this->db->update('settings1');

                $this->db->set('wallet', "wallet+$txtramt", FALSE);
                $this->db->where('id', $txtreci_id);
                $query = $this->db->update('members');

                $this->sql_models->countAllNotiAndDelete();

                $datas = array(
                    'memid'             => 0,
                    'user_id'           => $txtreci_id,
                    'what_page'         => "dashboard/mywallet/",
                    'page_id'           => "",
                    'has_read'          => 0,
                    'actns'             => "credited your wallet with &#8358;".@number_format($txtramt),
                    'date_created'      => date("Y-m-d g:i a", time())
                );
                $this->db->insert('all_notifications', $datas);

                $data1 = array(
                    'memid'         => $txtreci_id,
                    'amt'           => $txtramt,
                    'paid'          => 1,
                    'method1'       => "admin credited",
                    'date_created'  => date("Y-m-d g:i a", time())
                );
                $this->db->insert("wallets", $data1);

            /// do some updates on the wallets ///
            $arrs = array('type'=>'success', 'msg'=>"transfered");

        }else{
            $arrs = array('type'=>'error', 'msg'=>"Error!");
        }
        
        echo json_encode($arrs);
    }
    


    function fetchLeaderboard(){
        $contestids = $this->input->post('txtcontests');
        $empRecords = $this->sql_models->fetchProductsLeader($contestids, "", "", "", 10, 'entries', 'votes');
        $t=1;
        if($empRecords){
            foreach ($empRecords as $rs) {
                $names = ucwords(strtolower($rs['names']));
                $nickname = ucwords(strtolower($rs['nickname']));
                $names1 = strtolower($names);
                if(strlen($names1)<=2) $names1 = strtolower($nickname);
                if(strlen($names)<=2) $names = ucwords($nickname);
                $names1 = str_replace(" ", "-", $names1);
                $pics = $rs['pics'];
                $votes = $rs['votes'];
                //$pic_pathi = base_url()."profiles1/$pics";
                $memid = $rs['contestant_id'];
                $nows = substr(time(), -5);
                $memid_hash = $memid.$nows;
                $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                $online_time = time_ago($online_timing);

                $getBoosted = $this->sql_models->fetchBoosted($contestids, $memid);
                $boosteds="";
                if($getBoosted>0){
                    $boosteds = "<font style='font-weight: 600; font-size:14px'>(".@number_format($getBoosted)." Boosted)</font>";
                    //$boosteds = "<font style='font-weight: 600; font-size:14px'>(+Boosted)</font>";
                }

                $pic_pathi = base_url()."media_uploads1/$pics";
                $width1="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                if($width1=="" || $width1<=0){
                    $pic_pathi = base_url()."profiles1/$pics";

                    list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                    if($width1=="" || $width1<=0)
                        $pic_pathi = base_url()."profiles/$pics";
                }

                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                if($width1=="" || $width1<=0)
                    $pic_pathi = base_url()."images/no_passport.jpg";

                if($t%2==0) $odds = "odds"; else $odds = "";


                $mychats1 = "";
                if($this->myID==$memid){
                    $mychats1 = $this->sql_models->noOfChats($this->myID);
                    if($mychats1<=0) $mychats1="";
                }

                $mystatus = $this->sql_models->chkOnlinePresence($memid);
                $chechOnlineHidden = $this->sql_models->chechOnlineHidden($memid);

                if($chechOnlineHidden) // visible
                    $last_seen="<span style='color:#093 !important;'>active</span>";
                else
                    $last_seen="<span style='color:#777 !important;'>hidden</span>";

                if($mystatus=="ash"){
                    if(strtotime($online_timing)>0){
                        if($chechOnlineHidden) // visible
                            $last_seen="<span style='color:#777 !important;'>Seen: $online_time</span>";
                        else
                            $last_seen="<span style='color:#777 !important;'>hidden</span>";
                    }else{
                      $last_seen="<span style='color:#777 !important;'>offline</span>";
                    }
                }
                ?>
                <div class="clearfix post-recent inner_lb <?=$odds?>">
                    <div class="post-recent-thumb float-left">
                        <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">
                            <img src="<?=$pic_pathi?>" alt="" class="img-fluid rounded" />
                        </a>
                    </div>
                    <div class="post-recent-content float-left">
                        <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$names?> (<?=$nickname?>)</a>
                        <span class="text-muted vt_cnts vote_counts_lb<?=$contestids.$memid;?>"><?=@number_format($votes)?> votes <?=$boosteds?></span>
                        <span class="online_status_lb"><?=$last_seen?></span>
                    </div>
                </div>
            <?php
            $t++;
            }
        }else{
            echo "<div style='padding: 20px 10px 30px 10px; text-align:center; color:#666; font-size: 18px;'>No entries found here</div>";
        }
    }



    function store_req_withdrawal(){
        $this->form_validation->set_rules('txtamt4', 'Amount', 'required|trim|numeric|greater_than[1999]');
        $this->form_validation->set_rules('txtacct_no', 'Account Number', 'required|trim|numeric');
        $this->form_validation->set_rules('txtbank', 'Bank Name', 'required|trim');
        $this->form_validation->set_rules('txtacct_name', 'Account Name', 'required|trim|alpha_space');

        $txtamt = $this->input->post('txtamt4');
        $txtmywallet = $this->input->post('txtmywallet');
        $txtacct_no = $this->input->post('txtacct_no');
        $txtbank = $this->input->post('txtbank');
        $txtacct_name = $this->input->post('txtacct_name');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{

            if($txtamt > $txtmywallet){
                echo "This amount exceeds the amount in your wallet!";
            }else{

                $checkWallet = $this->sql_models->checkWallet($this->myID, $txtamt);

                if($checkWallet){
                    $data1 = array(
                        'memid'         => $this->myID,
                        'amt'           => $txtamt,
                        'acct_no'       => $txtacct_no,
                        'bank_name'     => $txtbank,
                        'acct_name'     => $txtacct_name,
                        'answered'      => 0,
                        'date_created'  => date("Y-m-d g:i a", time())
                    );

                    if($this->sql_models->checkWithdrawalDuplicate($this->myID, $txtamt)){
                        echo "Request already sent, no duplicate request!";
                    }else{

                        $updated = $this->db->insert('request_withdrawals', $data1);
                        if($updated){

                            //////////////////FOR EMAILS/////////////////////////
                                $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello Admin,</b></p>";
                                $dated = date("jS M, Y, h:i a", time());

                                $message_contents .= "<p style='margin-top:5px; font-size: 16px;'>
                                There is a withdrawal request that needs your attention urgently<br><br>

                                <b>Username:</b> $this->nickname<br>
                                <b>Full Name:</b> $this->myfullname<br>
                                <b>Email:</b> $this->mymail<br>
                                <b>Request Amount: &#8358;".@number_format($txtamt)."</b><br>
                                <b>Date:</b> $dated<br><br>
                                <b>Destination Bank:</b> $txtbank - $txtacct_no - $txtacct_name<br><br>

                                <a href='".base_url()."shields/withdrawal_request/' target='_blank'>Click Here</a>, to take required action.</p>";
                            //////////////////FOR EMAILS///////////////////////// 

                            $subj = "&#8358;".@number_format($txtamt)." Withdrawal Requests From ".ucwords($this->myfullname);
                            //$from = $this->myfullname." <$this->mymail>";
                            $from = $this->myfullname." <noReply@icontestpro.com>";
                            $to = "icontestprobox@gmail.com";
                            $from_name = $this->myfullname." @ iContestPRO";

                            $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                            $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                            echo "credited";
                        }else{
                            echo "Error!";
                        }
                    }
                }else{
                    echo "You have insufficient fund to carry out this transaction!";
                }
            }
        }
    }



    function insert_quiz_section(){
        $this->form_validation->set_rules('txttitle', 'Quiz Title', 'required|trim');

        $this->form_validation->set_rules('txtnum1', 'First Prize', 'required|trim|numeric|max_length[6]');
        $this->form_validation->set_rules('txtnum2', 'Second Prize', 'required|trim|numeric|max_length[6]');
        $this->form_validation->set_rules('txtnum3', 'Third Prize', 'trim|numeric|max_length[6]');
        $this->form_validation->set_rules('txtnum4', 'Fourth Prize', 'trim|numeric|max_length[6]');
        $this->form_validation->set_rules('txtnum5', 'Fifth Prize', 'trim|numeric|max_length[6]');

        $this->form_validation->set_rules('txtsubj', 'Subjects', 'required|trim');
        $this->form_validation->set_rules('txtsecs', 'Seconds', 'required|trim|numeric|max_length[4]');
        $this->form_validation->set_rules('txtsponName', 'Sponsor Name', 'trim|min_length[10]|max_length[11]');

        $txttitle = $this->input->post('txttitle');
        $txtnum1 = $this->input->post('txtnum1');
        $txtnum2 = $this->input->post('txtnum2');
        $txtnum3 = $this->input->post('txtnum3');
        $txtnum4 = $this->input->post('txtnum4');
        $txtnum5 = $this->input->post('txtnum5');
        $txtsubj = $this->input->post('txtsubj');
        $txtsecs = $this->input->post('txtsecs');
        $txtsponName = $this->input->post('txtsponName');
        $txtdurs = $this->input->post('txtdurs');
        $txtrw_id = $this->input->post('txtrw_id');
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors());
        }else{

            if($txtrw_id!=""){
                $data1 = array(
                    'quiz_title'        => $txttitle,
                    'sponsored_by'      => $txtsponName,
                    'duratn'            => $txtdurs,
                    'time_stamp'        => strtotime('+'.$txtdurs, time()),
                    'subj'              => $txtsubj,
                    'seconds'           => $txtsecs,
                    'prize1'            => $txtnum1,
                    'prize2'            => $txtnum2,
                    'prize3'            => $txtnum3,
                    'prize4'            => $txtnum4,
                    'prize5'            => $txtnum5
                );
                $updated = $this->db->where('id', $txtrw_id)->update('quiz_section', $data1);
            }else{

                $data1 = array(
                    'quiz_title'        => $txttitle,
                    'sponsored_by'      => $txtsponName,
                    'duratn'            => $txtdurs,
                    'time_stamp'        => strtotime('+'.$txtdurs, time()),
                    'subj'              => $txtsubj,
                    'seconds'           => $txtsecs,
                    'prize1'            => $txtnum1,
                    'prize2'            => $txtnum2,
                    'prize3'            => $txtnum3,
                    'prize4'            => $txtnum4,
                    'prize5'            => $txtnum5,
                    'date_uploaded'     => date("Y-m-d g:i a", time())
                );
                $updated = $this->db->insert('quiz_section', $data1);
            }
            
            if($updated){
                if($txtrw_id!=""){
                    $arrs = array('type'=>'success', 'msg'=>"");
                }else{
                    $hashed_id = md5($this->db->insert_id());
                    $arrs = array('type'=>'success', 'msg'=>$hashed_id);
                }
            }else{
                $arrs = array('type'=>'error', 'msg'=>"");
            }
        }
        echo json_encode($arrs);
    }



    function submit_my_questions(){
        $this->form_validation->set_rules('txtquestions', 'Question', 'required|trim');
        $this->form_validation->set_rules('txtop1', 'Option A', 'required|trim');
        $this->form_validation->set_rules('txtop2', 'Option B', 'required|trim');
        $this->form_validation->set_rules('txtans', 'Specify Answer', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{

            $quizSecID = $this->input->post('quizSecID');
            $txtquestions = $this->input->post('txtquestions');
            $txtop1 = $this->input->post('txtop1');
            $txtop2 = $this->input->post('txtop2');
            $txtop3 = $this->input->post('txtop3');
            $txtop4 = $this->input->post('txtop4');
            $txtans = $this->input->post('txtans');
            $txtexplain = $this->input->post('txtexplain');
            $txt_upload_type = $this->input->post('txt_upload_type');
            $quiz_ids = $this->input->post('txtquizid');
            $former_file = $this->input->post('former_file');


            if($txtans=="A") $txtans=$txtop1;
            else if($txtans=="B") $txtans=$txtop2;
            else if($txtans=="C") $txtans=$txtop3;
            else $txtans=$txtop4;
                        
            $path4 = @$_FILES['file_quiz']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $ext4 = strtolower($ext4);
            $img_ext_chk1 = array('jpg','png','jpeg');

            if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_quiz']['name']) && @$_FILES['file_quiz']['name'] != "")
                echo "Please select a valid image of the formats jpg, jpeg or png<br>";
            else if(isset($_FILES['file_quiz']['name']) && @$_FILES['file_quiz']['size'] > 2097152)
                echo "The image has exceeded 2MB<br>";
            else{
                $randm = time();
                $rename_file = "$randm.$ext4";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "quizes/".$rename_file;
                
                $new_name4 = $rename_file;
                $data1_img = array();
                if(isset($_FILES['file_quiz']['name']) && @$_FILES['file_quiz']['name'] != ''){
                    $file_tmp = @$_FILES["file_quiz"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_quiz']['name']) ){
                        if($quiz_ids != "")
                            $this->sql_models->delete_quiz_pics($former_file);

                        move_uploaded_file($file_tmp, $url_source);
                        //$this->resizeImage($url_source, $url_dest, 650, 650, TRUE);
                        $this->compress($url_source, $url_dest, 50);
                    }
                    $data1_img = array('files' => $new_name4);
                }

                $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                if(is_readable($in_folder1)) @unlink($in_folder1);

                $txtquestions = str_replace("'", "&prime;", $txtquestions);
                $txtop1 = str_replace("'", "&prime;", $txtop1);
                $txtop2 = str_replace("'", "&prime;", $txtop2);
                $txtop3 = str_replace("'", "&prime;", $txtop3);
                $txtop4 = str_replace("'", "&prime;", $txtop4);
                $txtans = str_replace("'", "&prime;", $txtans);
                $txtexplain = str_replace("'", "&prime;", $txtexplain);

                if($quiz_ids==""){
                    $data_quizes = array(
                        'quiz_section_id' => $quizSecID,
                        'questions'       => $txtquestions,
                        'op1'             => $txtop1,
                        'op2'             => $txtop2,
                        'op3'             => $txtop3,
                        'op4'             => $txtop4,
                        'ans1'            => $txtans,
                        'explanations'    => $txtexplain
                    );
                    $querys = "insert";
                    $quiz_ids = "";

                }else{ // updating....

                    $data_quizes = array(
                        'questions'       => $txtquestions,
                        'op1'             => $txtop1,
                        'op2'             => $txtop2,
                        'op3'             => $txtop3,
                        'op4'             => $txtop4,
                        'ans1'            => $txtans,
                        'explanations'    => $txtexplain
                    );
                    $querys = "update";
                    $quiz_ids=md5($quiz_ids);
                }

                $merge_arrs = array_merge($data1_img, $data_quizes);
                $query1 = $this->sql_models->update_inserts_quizes($merge_arrs, $quiz_ids, $querys, 'quiz_questions', 'questions');
                if($query1!=0) echo "inserted"; else echo "error";
            }
        }
    }



    function upload_my_quiz_questions(){
        $quizSecID = $this->input->post('quizSecID');
        $quiz_ids = $this->input->post('txtquizid');

        $path4 = @$_FILES['uploadFile']['name'];
        $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
        $ext4 = strtolower($ext4);
        $img_ext_chk1 = array('xlsx','xls');

        if($ext4=="")
            echo "Please select an excel format to upload<br>";

        else if(!in_array($ext4, $img_ext_chk1) && isset($_FILES['uploadFile']['name']) && @$_FILES['uploadFile']['name'] != "")
            echo "Please select a valid excel formats of xls, xlsx<br>";
        else if(isset($_FILES['uploadFile']['name']) && @$_FILES['uploadFile']['size'] > 6291456)
            echo "The file has exceeded 6MB<br>";

        else{ // upload the excel and add to database
            $path = 'quizes/';
            require_once APPPATH . "third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if(!$this->upload->do_upload('uploadFile')) {
                echo $this->upload->display_errors();
            }else{
                $data = array('upload_data' => $this->upload->data());
            
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
            
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                        if($flag){
                          $flag =false;
                          continue;
                        }

                        if(isset($value['A']) && $value['A']!="" || isset($value['B']) && $value['B']!="" || isset($value['C']) && $value['C']!="" || isset($value['F']) && $value['F']!=""){
                            @$inserdata[$i]['quiz_section_id']   = $quizSecID;
                            @$inserdata[$i]['questions']         = $value['A'];
                            @$inserdata[$i]['op1']               = $value['B'];
                            @$inserdata[$i]['op2']               = $value['C'];
                            @$inserdata[$i]['op3']               = $value['D'];
                            @$inserdata[$i]['op4']               = $value['E'];
                            @$inserdata[$i]['ans1']              = $value['F'];
                            @$inserdata[$i]['explanations']      = $value['G'];
                        }else{
                            echo "Error, the excel file is not in its correct format.";
                            exit;
                        }
                        $i++;
                    }

                    $result=$this->sql_models->update_inserts_quizes($inserdata, $quiz_ids, 'insert_batch', 'quiz_questions', 'questions');
                    if($result){
                        $in_folder1="quizes/".$data['upload_data']['file_name'];
                        if(is_readable($in_folder1)) @unlink($in_folder1);
                      echo "inserted";
                    }else{
                      echo "Error";
                    }             
     
                } catch (Exception $e) {
                   echo "Error loading file ".pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage();
                }
            }
        }
    }



    function sponsor_payment(){
        $txtamts = $this->input->post('amount');
        $wallet_amt = $this->input->post('wallet_amt');
        $user_id = $this->input->post('user_id');
        $response = $this->input->post('response');
        $pay_mthd = $this->input->post('pay_mthd');
        $payment_status = $this->input->post('payment_status');
        
        if($wallet_amt < $txtamts && $pay_mthd!="online"){
            echo "The amount in your wallet is less than the given amount.";
        }else{
            $dates = date("Y-m-d g:i a", time());
            $this->db->set('paid', 1);
            $this->db->set('date_upgraded', $dates);

            if($pay_mthd=="online"){
                $this->db->set('transaction_ref', $response);
                $this->db->where('id', $user_id);
                $query = $this->db->update('members');
            }else{
                $this->db->set('wallet', "wallet-$txtamts", FALSE);
                $this->db->where('id', $user_id)->where('wallet >=', $txtamts);
                $query = $this->db->update('members');
            }

            if($query){
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:25px; font-size: 16px'><b>Hello Sponsor $this->myfullname,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 16px; line-height: 20px;'>
                    You have successfully upgraded to becoming a sponsor and will be approved shortly. After approval by the administrators, you can go to your dashboard and upload a contest let people participate.<br>Thank you for your patronage.</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "iContestPRO Sponsorship Approved!";
                $from = "iContestPRO <noReply@icontestpro.com>";
                $to = $this->mymail;
                $from_name = "iContestPRO Sponsorship";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);


                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello Admin,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 16px; line-height: 20px;'>
                    $this->myfullname has upgraded to become a sponsor, go to the admin panel, view their details and approve them as soon as possible.</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "Sponsorship Notification From ".ucwords($this->myfullname);
                //$from = $this->myfullname." <$this->mymail>";
                $from = $this->myfullname." <noReply@icontestpro.com>";
                $to = "icontestprobox@gmail.com";
                $from_name = $this->myfullname." @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                echo "paid";
            }else{
                echo "Error!";
            }
        }
    }




    function ads_payment(){
        $txtamts = $this->input->post('amount');
        $wallet_amt = $this->input->post('wallet_amt');
        $user_id = $this->input->post('user_id');
        $response = $this->input->post('response');
        $pay_mthd = $this->input->post('pay_mthd');
        $contest_id = $this->input->post('contest_id');
        $txtdurs = $this->input->post('txtdurs'); // 7 days
        $payment_status = $this->input->post('payment_status');
        $txtextends = $this->input->post('txtextends');
        $txtad_type = $this->input->post('txtad_type'); // contests or advert

        if($user_id <= 0){ // admin
            $this->extend_ads($contest_id, $txtdurs, $txtamts);
        }else{
        
            if($wallet_amt < $txtamts && ($pay_mthd!="paystack" || $pay_mthd!="flutterwave")){
                echo "The amount in your wallet is less than the given amount.";
            }else{

                $now = time();
                $extend_timing = 0;
                $prev_time_left = 0;
                $title = "";
                $sizes = "";
                $positns = "";
                $urls1 = "";
                $files = "";
                if($txtextends==1){
                    //////select timing so as to combine with extended timings/////
                    if($txtad_type=="contests"){
                        $this->db->select('timings')->from('boost_ads')->where('user_id', $user_id)->where('contest_id', $contest_id)->where('timings >=', $now)->where('extendeds >=', 0);
                    }else{
                        $this->db->select('title, sizes, positns, urls1, files, duration_stamp')->from('adverts')->where('user_id', $user_id)->where('id', $contest_id)->where('duration_stamp >=', $now)->where('extendeds >=', 0);
                    }
                    $this->db->order_by('id', 'desc');
                    $query = $this->db->get();
                    if($query->num_rows() > 0){
                        if($txtad_type=="contests")
                            $extend_timing = $query->row('timings');
                        else{
                            $extend_timing = $query->row('duration_stamp');
                            $title = $query->row('title');
                            $sizes = $query->row('sizes');
                            $positns = $query->row('positns');
                            $urls1 = $query->row('urls1');
                            $files = $query->row('files');
                        }
                        $prev_time_left = $extend_timing - $now;
                    }
                    //////select timing so as to combine with extended timings/////

                    //////update and set timing to 0 and extends to -1///////
                    if($txtad_type=="contests"){
                        $this->db->set('timings', 0);
                        $this->db->set('extendeds', "-1");
                        $this->db->where('user_id', $user_id)->where('contest_id', $contest_id);
                        $query = $this->db->update('boost_ads');
                    }else{
                        $this->db->set('duration_stamp', 0);
                        $this->db->set('extendeds', "-1");
                        $this->db->where('user_id', $user_id)->where('id', $contest_id);
                        $query = $this->db->update('adverts');
                    }
                }

                $data1 = array();

                if($pay_mthd=="paystack" || $pay_mthd=="flutterwave"){
                    if($txtextends==1){
                        $data1 = array(
                            'response'      => $response,
                            'extendeds'     => 1,
                            'paid'          => 1,
                            'timings'       => strtotime('+'.$txtdurs, time())+$prev_time_left
                        );
                    }else{
                        $data1 = array(
                            'response'      => $response,
                            'extendeds'     => 0,
                            'paid'          => 1,
                            'timings'       => strtotime('+'.$txtdurs, time()),
                        );
                    }
                }else{
                    if($txtextends==1){
                        $data1 = array(
                            'response'      => "wallet",
                            'extendeds'     => 1,
                            'paid'          => 1,
                            'timings'       => strtotime('+'.$txtdurs, time())+$prev_time_left
                        );
                    }else{
                        $data1 = array(
                            'response'      => "wallet",
                            'extendeds'     => 0,
                            'paid'          => 1,
                            'timings'       => strtotime('+'.$txtdurs, time()),
                        );
                    }
                }

                if($txtad_type=="advert"){
                    $data1 = array(
                        'approved'          => 1,
                        'user_id'           => $user_id,
                        'title'             => $title,
                        'sizes'             => $sizes,
                        'positns'           => $positns,
                        'duration'          => $txtdurs,
                        'extendeds'         => 1,
                        'duration_stamp'    => strtotime('+'.$txtdurs, time())+$prev_time_left,
                        'urls'              => "all",
                        'urls1'             => $urls1,
                        'files'             => $files,
                        'amt'               => $txtamts,
                        'date_created'      => date("Y-m-d g:i a", time())
                    );
                }

                $data2 = array(
                    'user_id'       => $user_id,
                    'contest_id'    => $contest_id,
                    'amt'           => $txtamts,
                    'duratn'        => $txtdurs,
                    'date_created'  => date("Y-m-d g:i a", time())
                );

                $newdata3 = array_merge($data1, $data2);
                if($txtad_type=="contests")
                    $this->db->insert('boost_ads', $newdata3);
                else
                    $this->db->insert('adverts', $data1);

                if($pay_mthd!="paystack" || $pay_mthd!="flutterwave"){
                    $this->db->set('wallet', "wallet-$txtamts", FALSE);
                    $this->db->where('id', $user_id)->where('wallet >=', $txtamts);
                    $query = $this->db->update('members');
                }

                if($query){
                    echo "paid";
                }else{
                    echo "Error!";
                }
            }
        }
    }

    function share_social_medias(){
        $txtcont = $this->input->post('txtcont');
        $txtmem = $this->input->post('txtmem');
        $txtvt = $this->input->post('txtvt'); // 4
        if($txtcont=="" || $txtmem=="" || $txtvt==""){echo "error"; exit;}
        $chkcontest = $this->sql_models->chkTbl($txtcont, 'contests', 'approved');
        $chkmem = $this->sql_models->chkTbl($txtmem, 'members', '');
        if($chkcontest===false || $chkmem===false){echo "error"; exit;}
        $socialshares = $this->sql_models->socialshares($txtvt, $txtmem, $txtcont);
        if($socialshares){
            foreach ($socialshares as $rs) {
                $devi = array_rand(array(1,2,3,4));
                //$rndnos_date = array_rand(array(15,20,25,30));
                $rndnos_date = array_rand(array(3,4,5,6));
                $rndnos = array_rand(array(6,7,8,9));
                $rnddt = strtotime('-'.$rndnos_date." minutes", time());
                $rnddt1 = date("Y-m-d g:i a", $rnddt);

                $ipaddrs = $rs['ip_addrs'].$devi;
                $voters = $rs['voter'];
                $datas = array(
                    'contest_id'    => $txtcont,
                    'ip_addrs'      => $ipaddrs,
                    'votes'         => 1,
                    'contestant_id' => $txtmem,
                    'voter'         => $voters,
                    'vp'            => 1,
                    'timings'       => strtotime('-'.$rndnos." hours", time()),
                    'date_created'  => $rnddt1
                );
                $this->db->insert('all_votes', $datas);
            }
            //$txtvt = $txtvt*2;
            $sshares = $this->sql_models->update_mytables($txtcont, $txtmem, $txtvt, "", "", "", 0, 0, "", "");
            if($sshares) echo "done"; else echo "error";
        }else{
            echo "error";
        }
    }
    function timecontest(){
        $txtcont = $this->input->post('txtcont');
        if($txtcont=="" || $txtcont > 1){echo "error"; exit;}
        if($txtcont < 0) $txtcont=0;
        $this->db->set('other_params', $txtcont);
        $this->db->where('id', 1);
        $query = $this->db->update('settings1');
        if($query) echo "done"; else echo "error";
    }



    function extend_ads($contest_id, $txtdurs, $txtamts){
        $now = time();
        $extend_timing = 0;
        $prev_time_left = 0;
        $title = "";
        $sizes = "";
        $positns = "";
        $urls1 = "";
        $files = "";

        //////select timing so as to combine with extended timings/////
        $this->db->select('title, sizes, positns, urls1, files, duration_stamp')->from('adverts')->where('user_id', 0)->where('id', $contest_id)->where('duration_stamp >=', $now)->where('extendeds >=', 0);
        
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $extend_timing = $query->row('duration_stamp');
            $title = $query->row('title');
            $sizes = $query->row('sizes');
            $positns = $query->row('positns');
            $urls1 = $query->row('urls1');
            $files = $query->row('files');
            $prev_time_left = $extend_timing - $now;
        }
        //////select timing so as to combine with extended timings/////

        //////update and set timing to 0 and extends to -1///////
        $this->db->set('duration_stamp', 0);
        $this->db->set('extendeds', "-1");
        $this->db->where('user_id', 0)->where('id', $contest_id);
        $query = $this->db->update('adverts');

        $data1 = array(
            'approved'          => 1,
            'user_id'           => 0,
            'title'             => $title,
            'sizes'             => $sizes,
            'positns'           => $positns,
            'duration'          => $txtdurs,
            'extendeds'         => 1,
            'duration_stamp'    => strtotime('+'.$txtdurs, time())+$prev_time_left,
            'urls'              => "all",
            'urls1'             => $urls1,
            'files'             => $files,
            'amt'               => $txtamts,
            'date_created'      => date("Y-m-d g:i a", time())
        );

        $query = $this->db->insert('adverts', $data1);
        if($query){
            echo "paid";
        }else{
            echo "Error!";
        }
        
    }


    function insert_chats(){
        $myid = $this->input->post('myid');
        $rec_id = $this->input->post('memid');
        $chats = $this->input->post('chats');
        $this->form_validation->set_rules('chats', 'message', 'required|trim');

        $isBlocked = $this->sql_models->isBlocked($myid, $rec_id);
        if($isBlocked===true){
            echo "Error! This user has been blocked!";
        }else{

            if($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $datas = array(
                    'memid'         => $myid,
                    'recipient_id'  => $rec_id,
                    'messages'      => $chats,
                    'date_created'  => date("Y-m-d g:i a", time())
                );
                $querys = $this->db->insert('chatwithme', $datas);
                if($querys){
                    $this->getAllChats1($myid, $rec_id);

                }else{
                    echo "error";
                }
            }
        }
    }



    function insert_cmts(){
        $myid = $this->input->post('myid');
        $rec_id = $this->input->post('memid');
        $chats = $this->input->post('chats');
        $con_ids = $this->input->post('con_ids');
        $this->form_validation->set_rules('chats', 'message', 'required|trim');
        $url_params = $this->input->post('txt_url_params');
        $txt_url_params_ID = $this->input->post('txt_url_params_ID');

        $isBlocked = $this->sql_models->isBlocked($myid, $rec_id);
        if($isBlocked===true){
            echo "Error! This user has been blocked!";
        }else{

            if($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $datas = array(
                    'memid'         => $rec_id,
                    'commenter_id'  => $myid,
                    'contest_id'    => $con_ids,
                    'messages'      => $chats,
                    'date_created'  => date("Y-m-d g:i a", time())
                );
                $querys = $this->db->insert('mycomments', $datas);
                if($querys){

                    if($rec_id != $this->myID){
                        $getCmtFollowers = $this->sql_models->getCmtFollowers('mycomments', $this->myID, $con_ids, $rec_id, 'commenter_id');
                        $this->sql_models->countAllNotiAndDelete();

                        $datas = array(
                            'memid'             => $this->myID,
                            'user_id'           => $rec_id,
                            'what_page'         => $url_params,
                            'page_id'           => $txt_url_params_ID,
                            'has_read'          => 0,
                            'actns'             => "commented on your entry on",
                            'date_created'      => date("Y-m-d g:i a", time())
                        );
                        $this->db->insert('all_notifications', $datas);

                        if($getCmtFollowers){
                            foreach ($getCmtFollowers as $rs) {
                                $memid2 = $rs['commenter_id'];
                                //dont include the sponsor and my id again
                                if($rec_id != $this->myID && $memid2 != $this->myID){
                                    $checkDuplicate = $this->sql_models->checkDuplicate('all_notifications', $this->myID, $memid2, $txt_url_params_ID);

                                    if(!$checkDuplicate){
                                        $this->sql_models->countAllNotiAndDelete();

                                        $datas1 = array(
                                            'memid'             => $this->myID,
                                            'user_id'           => $memid2,
                                            'what_page'         => $url_params,
                                            'page_id'           => $txt_url_params_ID,
                                            'has_read'          => 0,
                                            'actns'             => "dropped a comment you are following a contestant on",
                                            'date_created'      => date("Y-m-d g:i a", time())
                                        );
                                        $this->db->insert('all_notifications', $datas1);
                                    }
                                }
                            }
                        }
                    }

                    $this->getAllCmtsFunction($myid, $con_ids, $rec_id);

                }else{
                    echo "error";
                }
            }
        }
    }




    function entry_payment(){
        $txtamts = $this->input->post('amount');
        $wallet_amt = $this->input->post('wallet_amt');
        $user_id = $this->input->post('user_id');
        $response = $this->input->post('response');
        $pay_mthd = $this->input->post('pay_mthd');
        $contest_id = $this->input->post('contest_id');
        $txtspons_ids = $this->input->post('txtspons_ids');
        
        if($wallet_amt < $txtamts && ($pay_mthd!="paystack" || $pay_mthd!="flutterwave")){
            echo "The amount in your wallet is less than the given amount.";
        }else{
            if($pay_mthd=="paystack" || $pay_mthd=="flutterwave"){
                $data1 = array(
                    'response'      => $response,
                    
                );
            }else{
                $data1 = array(
                    'response'      => $pay_mthd,
                );
            }

            $data2 = array(
                'fee'           => $txtamts,
                'paid'          => 1,
                'contestant_id' => $user_id,
                'contest_id'    => $contest_id,
                'fee'           => $txtamts,
                'date_created'  => date("Y-m-d g:i a", time())
            );
            $newdata3 = array_merge($data1, $data2);
            $this->db->insert('entries_fee', $newdata3);

            $admin_percent=($this->entry_fee/100)*$txtamts; // 10/100=0.1, 0.1*1000=100
            $spon_percent = $txtamts - $admin_percent; // 0.999 * 1000 = 

            if($pay_mthd!="paystack" || $pay_mthd!="flutterwave"){ // wallet
                $this->db->set('wallet', "wallet-$txtamts", FALSE);
                $this->db->where('id', $user_id)->where('wallet >=', $txtamts);
                $query = $this->db->update('members');
            }
            $this->db->set('wallet', "wallet+$spon_percent", FALSE);
            $this->db->where('id', $txtspons_ids);
            $this->db->update('members');

            $this->db->set('wallet', "wallet+$admin_percent", FALSE);
            $this->db->where('id', 1);
            $query = $this->db->update('admin_tbls');

            $this->db->set('entrance_fee', "entrance_fee+$admin_percent", FALSE);
            $this->db->where('id', 1)->update('admin_tbls');

            if($query){
                
                $getContestName = $this->sql_models->getContestName($contest_id);
                $getSponDetls = $this->sql_models->getDetails($txtspons_ids);
                $getSponEmail = strtolower($getSponDetls['emails']);
                $getSponName = ucwords($getSponDetls['names']);
                $getSponNick = ucwords($getSponDetls['nickname']);
                if(strlen($getSponName)<=2) $getSponName = ucwords($getSponNick);

                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $getSponName,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                    A contestant <b>".ucwords($this->myfullname)."</b> just joined your contest <b>'$getContestName'</b>, kindly go to your dashboard to see thier details, thank you!</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "New Contestant ".ucwords($this->myfullname)." Just Joined.";
                $from = "iContestPRO <noReply@icontestpro.com>";
                $to = $getSponEmail;
                $from_name = $this->myfullname." @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                echo "paid";
            }else{
                echo "Error!";
            }
        }
    }


    function updateLikes(){
        $contest_id = $this->input->post('contest_id');
        $contestant_id = $this->input->post('contestant_id');
        $newlikes = $this->input->post('newlikes');
        $this->sql_models->updateMyLikes($contest_id, $contestant_id, $this->myID, $newlikes);
    }



    function entry_contest_code(){
        $this->form_validation->set_rules('txt_codes', 'Entry Code', 'required|trim|numeric');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{

            $txt_codes = $this->input->post('txt_codes');
            $contest_id = $this->input->post('contest_id');
            $checkCode = $this->sql_models->check_code_validity($txt_codes, $this->myID, $contest_id);

            if(!$checkCode){
                echo "Invalid Contest Code Or Has Been Used!";
            }else{
                echo "success_entry";
                $this->db->set('used', 1);
                $this->db->set('used_by', $this->myID);
                $this->db->where('contest_id', $contest_id)->where('codes', $txt_codes)->update('contest_codes');
            }
        }
    }


    
    function update_my_profile(){
        $txtemail = strtolower($this->input->post('txtemail'));

        $this->form_validation->set_rules('txtfullname', 'Full Names', 'required|trim|min_length[10]|max_length[30]');
        $this->form_validation->set_rules('txtnick', 'Username', 'required|trim|min_length[6]|max_length[15]|alpha_numeric');

        $this->form_validation->set_rules('txtphone', 'Phone Number', 'required|trim|numeric|regex_match[/^[0-9\+]{6,11}$/]');
        if(strpos($txtemail, "facebook") !== false || strpos($txtemail, "twitter") !== false)
            $this->form_validation->set_rules('txtemail', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('txtstate', 'State', 'required|trim');
        $this->form_validation->set_rules('txtcitys', 'City', 'required|trim');
        $this->form_validation->set_rules('txtprof', 'Profession', 'trim');
        $this->form_validation->set_rules('txtbio', 'Biography', 'trim|min_length[50]|max_length[600]');
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
        }else{

            $txtnames = $this->input->post('txtfullname');
            $txtph = $this->input->post('txtphone');
            $txtnick = $this->input->post('txtnick');
            $txtstates = $this->input->post('txtstate');
            $txtcitys = $this->input->post('txtcitys');
            $txtprof = $this->input->post('txtprof');
            $txtbio = $this->input->post('txtbio');
            $txt_yes_file_bma = $this->input->post('txt_yes_file_bma');
            $txtf0 = $this->input->post('txtf0');
            $txtfb = $this->input->post('txtfb');
            $txtig = $this->input->post('txtig');
            $txttw = $this->input->post('txttw');

            if($this->sql_models->checkReservedWords($txtnick, $txtnames)){
                $arrs = array('type' => 'error', 'msg'=>'Error! Cannot use this name!', 'msg1'=>'');
            }else{
            
                $txtmember = $this->myID; // sha1
                
                $duplicateNickname = $this->sql_models->duplicateNickname($txtnick, $txtmember, 'members');
                if($duplicateNickname){
                    $arrs = array('type'=>'error', 'msg'=>"Username already exist", 'msg1'=>'', 'msg2'=>'');
                }else{

                    $path4 = @$_FILES['txt_bma_pic']['name'];
                    $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
                    $img_ext_chk1 = array('jpg', 'jpeg');
                    $data1 = array();
                    $data2 = array();
                    $data3 = array();

                    if(@$_FILES['txt_bma_pic']['name'] == "" && $txt_yes_file_bma==0)
                        $arrs = array('type'=>'error', 'msg'=>"Please upload your profile photo and continue", 'msg1'=>'', 'msg2'=>'');

                    else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['txt_bma_pic']['name']) && @$_FILES['txt_bma_pic']['name'] != "")
                        $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for profile photo", 'msg1'=>'', 'msg2'=>'');

                    else if(isset($_FILES['txt_bma_pic']['name']) && @$_FILES['txt_bma_pic']['size'] > 8388608)
                        $arrs = array('type'=>'error', 'msg'=>"Your profile photo has exceeded 8MB", 'msg1'=>'', 'msg2'=>'');

                    else{
                        $randm = time();
                        $rename_file = "$randm.$ext4";
                        
                        $url_source = "fake_fols/".$rename_file;
                        $url_dest = "profiles/";
                        
                        $new_name4 = $rename_file;
                        if(isset($_FILES['txt_bma_pic']['name']) && @$_FILES['txt_bma_pic']['name'] != ''){
                            $file_tmp = @$_FILES["txt_bma_pic"]["tmp_name"];
                            if(is_uploaded_file($file_tmp) && isset($_FILES['txt_bma_pic']['name']) ){
                                if($txtmember != "")
                                    $this->sql_models->delete_memb_pics($txtf0, 'profiles/');

                                move_uploaded_file($file_tmp, $url_source);
                                //$d = $this->compress($url_source, $url_dest, 28);
                                $this->resizeImage($url_source, $url_dest, 500, 500, TRUE);
                            }

                            $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                            if(is_readable($in_folder1)) @unlink($in_folder1);

                            $data1 = array(
                                'pics' => $new_name4
                            );
                        }

                        if(strpos($txtemail, "facebook") !== true || strpos($txtemail, "twitter") !== true){
                            if( strlen($txtemail) > 3 ){
                                $data2 = array(
                                    'emails'        => $txtemail
                                );
                            }
                        }

                        $data3 = array(
                            'names'         => $txtnames,
                            'nickname'      => $txtnick,
                            'profession'    => $txtprof,
                            'bio'           => $txtbio,
                            'phone'         => $txtph,
                            'phone_visible' => 0,
                            'citys'         => $txtcitys,
                            'states'        => $txtstates,
                            'fb_id'         => $txtfb,
                            'ig_id'         => $txtig,
                            'tw_id'         => $txttw
                        );
                            
                        $newdata3 = array_merge($data1, $data2, $data3);

                        $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtmember, 'members');
                        if(!$querys1)
                            $arrs = array('type'=>'error', 'msg'=>"Error in network connection!", 'msg1'=>'', 'msg2'=>'');
                        else{

                            $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
                            $retain_page_name = $this->input->cookie('retain_page_name', TRUE);

                            $arrs = array('type'=>'success', 'msg'=>$new_name4, 'msg1'=>$retain_page_id1, 'msg2'=>$retain_page_name);
                        }
                    }
                } 
            }      
        }
        echo json_encode($arrs);
    }




    function upgrade_to_sponsor(){
        $path1 = @$_FILES['file1']['name'];
        $ext1 = pathinfo($path1, PATHINFO_EXTENSION);

        $path2 = @$_FILES['file2']['name'];
        $ext2 = pathinfo($path2, PATHINFO_EXTENSION);

        $img_ext_chk1 = array('jpg','png','jpeg');
        $data1 = array(); $data2 = array(); $data3 = array();

        $txtsponsortype = $this->input->post('txtsponsortype');

        if(@$_FILES['file1']['name'] == "")
            $arrs = array('type'=>'error', 'msg'=>"Please upload your ID Card image to continue");

        else if(!in_array($ext1,$img_ext_chk1) && isset($_FILES['file1']['name']) && @$_FILES['file1']['name'] != "")
            $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for your ID Card");

        else if(isset($_FILES['file1']['name']) && @$_FILES['file1']['size'] > 6291456)
            $arrs = array('type'=>'error', 'msg'=>"Your image for your ID Card has exceeded 6MB");

        else if(@$_FILES['file2']['name'] == "")
            $arrs = array('type'=>'error', 'msg'=>"Please upload your Utility Bill image to continue");

        else if(!in_array($ext2,$img_ext_chk1) && isset($_FILES['file2']['name']) && @$_FILES['file2']['name'] != "")
            $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for your Utility Bill");

        else if(isset($_FILES['file2']['name']) && @$_FILES['file2']['size'] > 6291456)
            $arrs = array('type'=>'error', 'msg'=>"Your image for your Utility Bill has exceeded 6MB");

        else{
            $randm = mt_rand(1111111, 9999999);
            $rename_file1 = "$randm.$ext1";

            $randm = mt_rand(1111111, 9999999);
            $rename_file2 = "$randm.$ext2";
            
            $url_source1 = "fake_fols/".$rename_file1;
            $url_dest1 = "sponsor_files/".$rename_file1;

            $url_source2 = "fake_fols/".$rename_file2;
            $url_dest2 = "sponsor_files/".$rename_file2;
            
            //$new_name4 = $rename_file;
            if(isset($_FILES['file1']['name']) && @$_FILES['file1']['name'] != ''){
                $file_tmp = @$_FILES["file1"]["tmp_name"];
                if(is_uploaded_file($file_tmp) && isset($_FILES['file1']['name']) ){
                    move_uploaded_file($file_tmp, $url_source1);
                    $d = $this->compress($url_source1, $url_dest1, 55);
                }
                $in_folder1="fake_fols/".$rename_file1;
                if(is_readable($in_folder1)) @unlink($in_folder1);

                $data1 = array(
                    'id_card' => $rename_file1
                );
            }

            if(isset($_FILES['file2']['name']) && @$_FILES['file2']['name'] != ''){
                $file_tmp = @$_FILES["file2"]["tmp_name"];
                if(is_uploaded_file($file_tmp) && isset($_FILES['file2']['name']) ){
                    move_uploaded_file($file_tmp, $url_source2);
                    $d = $this->compress($url_source2, $url_dest2, 55);
                }
                $in_folder1="fake_fols/".$rename_file2;
                if(is_readable($in_folder1)) @unlink($in_folder1);

                $data2 = array(
                    'utility' => $rename_file2
                );
            }

            if($txtsponsortype=="sponsor"){
                $data3 = array(
                    'approved'      => 0
                );
            }

            if($txtsponsortype=="agent"){
                $data3 = array(
                    'agents'      => 1 // 1 means he has become an agent, 2 means he has been approved
                );
            }

            $newdata3 = array_merge($data1, $data2, $data3);

            $querys1 = $this->sql_models->update_inserts_recs($newdata3, $this->myID, 'members');
            if(!$querys1)
                $arrs = array('type'=>'error', 'msg'=>"Error in network connection!");
            else{
                $arrs = array('type'=>'success', 'msg'=>"");
            }
        }
        echo json_encode($arrs);
    }




    function upgrade_to_agent(){
        $data1 = array(
            'agents'      => 1 // 1 means he has become an agent, 2 means he has been approved
        );
        $newdata3 = array_merge($data1);
        $querys1 = $this->sql_models->update_inserts_recs($newdata3, $this->myID, 'members');
        if(!$querys1)
            echo "Error in network connection!";
        else{
            echo "success";
        }
    }




    function upload_my_contest(){
        $txtentry_type = $this->input->post('txtentry_type');
        $txtentryfee = $this->input->post('txtentryfee');

        $this->form_validation->set_rules('txttitle', 'Contest Title', 'required|trim|min_length[6]|max_length[40]');
        $this->form_validation->set_rules('txtctype', 'Contest Type', 'required|trim');
        $this->form_validation->set_rules('txtvotetype', 'Vote Type', 'required|trim');
        $this->form_validation->set_rules('txtentry_type', 'Entry Type', 'required|trim');
        if($txtentry_type=="paid" && $txtentryfee=="")
            $this->form_validation->set_rules('txtentryfee', 'Entry Fee', 'required|trim|numeric');

        $this->form_validation->set_rules('txtentryfee', 'Entry Fee', 'trim|numeric|min_length[3]|max_length[6]');
        $this->form_validation->set_rules('txtdescrip', 'Contest Description', 'required|trim|max_length[2000]');

        $this->form_validation->set_rules('txtfprize', 'first prize', 'trim|numeric|regex_match[/^[0-9]{4,6}$/]');
        $this->form_validation->set_rules('txtsprize', 'second prize', 'trim|numeric|regex_match[/^[0-9]{4,6}$/]');
        $this->form_validation->set_rules('txttprize', 'third prize', 'trim|numeric|regex_match[/^[0-9]{4,6}$/]');
        $this->form_validation->set_rules('txtftprize', 'fourth prize', 'trim|numeric|regex_match[/^[0-9]{4,6}$/]');
        $this->form_validation->set_rules('txtffprize', 'fifth prize', 'trim|numeric|regex_match[/^[0-9]{4,6}$/]');

        $this->form_validation->set_rules('txtadd_gift1', 'Additional Gift 1', 'trim|max_length[50]');
        $this->form_validation->set_rules('txtadd_gift2', 'Additional Gift 2', 'trim|max_length[50]');
        $this->form_validation->set_rules('txtadd_gift3', 'Additional Gift 3', 'trim|max_length[50]');
        $this->form_validation->set_rules('txtadd_gift4', 'Additional Gift 4', 'trim|max_length[50]');
        $this->form_validation->set_rules('txtadd_gift5', 'Additional Gift 5', 'trim|max_length[50]');

        $this->form_validation->set_rules('txtstartdate', 'Start Date Of Entry', 'required|trim');
        //$this->form_validation->set_rules('txtclosedate', 'Close Date Of Entry', 'required|trim');
        $this->form_validation->set_rules('txtstartduration', 'Start Date Of Contest', 'required|trim');
        $this->form_validation->set_rules('txtduration', 'Close Date Of Contest', 'required|trim');
        $this->form_validation->set_rules('txtinstr', 'Instruction', 'trim|max_length[500]');
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors());
        }else{

            $txttitle = $this->input->post('txttitle');
            $txtctype = $this->input->post('txtctype');
            $txtvotetype = $this->input->post('txtvotetype');
            $txtdescrip = $this->input->post('txtdescrip');
            $txtsponName = $this->input->post('txtsponName');
            $txtfprize = $this->input->post('txtfprize');
            $txtsprize = $this->input->post('txtsprize');
            $txttprize = $this->input->post('txttprize');
            $txtftprize = $this->input->post('txtftprize');
            $txtffprize = $this->input->post('txtffprize');

            $txtadd_gift1 = $this->input->post('txtadd_gift1');
            $txtadd_gift2 = $this->input->post('txtadd_gift2');
            $txtadd_gift3 = $this->input->post('txtadd_gift3');
            $txtadd_gift4 = $this->input->post('txtadd_gift4');
            $txtadd_gift5 = $this->input->post('txtadd_gift5');

            $txtstartdate = $this->input->post('txtstartdate');
            $txtclosedate = $this->input->post('txtclosedate');
            $txtstartduration = $this->input->post('txtstartduration');
            $txtduration = strtotime($this->input->post('txtduration'));
            $txtinstr = $this->input->post('txtinstr');
            $former_file = $this->input->post('former_file');
            $txt_yes_file_bma = $this->input->post('txt_yes_file_bma');

            $former_logo = $this->input->post('former_logo');
            $txt_yes_logo_bma = $this->input->post('txt_yes_logo_bma');

            $former_ad_file = $this->input->post('former_ad_file');
            $txt_yes_ad_bma = $this->input->post('txt_yes_ad_bma');

            $checkme = $this->input->post('checkme');
            $checkme1 = $this->input->post('checkme1');
            //if($checkme==1) echo $make_visible=1; else echo $make_visible=0;
            //exit;
            
            $txtc_id = $this->input->post('txtc_id');
            $immediate_id = $this->input->post('txt_immediate_id'); //this is for immediate edition, when uploadin

            $path4 = @$_FILES['file_banner']['name'];
            $path_logo = @$_FILES['file_logo']['name'];
            $path_ads = @$_FILES['file_ad']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $extlogo = pathinfo($path_logo, PATHINFO_EXTENSION);
            $extads = pathinfo($path_ads, PATHINFO_EXTENSION);
            $img_ext_chk1 = array('jpg','png','jpeg');
            $data1 = array();
            $data2 = array();
            $data_logo = array();
            $data_ads = array();

            if(@$_FILES['file_banner']['name'] == "" && $txt_yes_file_bma==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload a banner for this contest", 'msg1'=>"");

            else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for a banner", 'msg1'=>"");

            else if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['size'] > 4194304)
                $arrs = array('type'=>'error', 'msg'=>"This image has exceeded 4MB", 'msg1'=>"");

            else if(isset($_FILES['file_logo']['name']) && @$_FILES['file_logo']['size'] > 512000)
                $arrs = array('type'=>'error', 'msg'=>"This logo has exceeded 500KB", 'msg1'=>"");

            else if(!in_array($extlogo, $img_ext_chk1) && isset($_FILES['file_logo']['name']) && @$_FILES['file_logo']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image logo for this contest", 'msg1'=>"");

            else if(isset($_FILES['file_ad']['name']) && @$_FILES['file_ad']['size'] > 512000)
                $arrs = array('type'=>'error', 'msg'=>"This advert image has exceeded 500KB", 'msg1'=>"");

            else if(!in_array($extads, $img_ext_chk1) && isset($_FILES['file_ad']['name']) && @$_FILES['file_ad']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for this advert", 'msg1'=>"");

            else if(strlen($txtclosedate) > 3 && strtotime($txtclosedate) <= strtotime($txtstartdate))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Entry</b> should be ahead of the <b>Start Date Of Entry</b>", 'msg1'=>"");

            else if(strtotime($txtstartdate) == $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Start Date Of Entry</b> should not be the same as the <b>Close Date Of Contest</b>", 'msg1'=>"");

            else if(strtotime($txtstartduration) > $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should be ahead of the <b>Start Date Of Contest</b>", 'msg1'=>"");

            else if(strtotime($txtstartdate) > $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should not be ahead of the <b>Start Date Of Entry</b>", 'msg1'=>"");

            else if(strtotime($txtstartduration) <= strtotime($txtstartdate))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Start Date Of Contest</b> should be ahead of the <b>Start Date of Entry</b>", 'msg1'=>"");

            else if($txtduration <= strtotime($txtstartduration))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should be ahead of the <b>Start Date Of Entry</b>", 'msg1'=>"");

            else if(($txtfprize=="" && $txtadd_gift1=="") || ($txtsprize=="" && $txtadd_gift2==""))
                $arrs = array('type'=>'error', 'msg'=>"Error! At least 2 Prizes or 2 Gifts will be entered!", 'msg1'=>"");

            // else if(($txtfprize!="" && $txtsprize=="" && $txttprize=="") || ($txtfprize!="" && $txtsprize!="" && $txttprize=="") || ($txtfprize=="" && $txtsprize!="" && $txttprize=="") || ($txtfprize=="" && $txtsprize=="" && $txttprize!="") || ($txtfprize=="" && $txtsprize=="" && $txttprize!=""))
            //     $arrs = array('type'=>'error', 'msg'=>"Error! The price entry must be at least 3 (first, second & third winner)", 'msg1'=>"");

            else{
                $randm = time();
                $rename_file = "$randm.$ext4";

                $randm = time();
                $rename_logo = "$randm.$extlogo";

                $randm = time();
                $rename_ads = "$randm.$extads";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "contest_types/".$rename_file;
                $new_name4 = $rename_file;

                $url_source_logo = "fake_fols/".$rename_logo;
                $url_dest_logo = "companys/".$rename_logo;
                $new_name_logo = $rename_logo;

                $url_source_ad = "fake_fols/".$rename_ads;
                $url_dest_ad = "companys/".$rename_ads;
                $new_name_ad = $rename_ads;

                if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner']['name']) ){
                        if($txtc_id != "" || $immediate_id != "")
                            $this->sql_models->delete_memb_pics($former_file, 'contest_types/');

                        move_uploaded_file($file_tmp, $url_source);
                        $d = $this->compress($url_source, $url_dest, 55);
                    }

                    $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data1 = array(
                        'files' => $new_name4
                    );
                }


                if(isset($_FILES['file_logo']['name']) && @$_FILES['file_logo']['name'] != ''){
                    $file_tmp = @$_FILES["file_logo"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_logo']['name']) ){
                        if($txtc_id != "" || $immediate_id != "")
                            $this->sql_models->delete_memb_pics($former_logo, 'companys/');

                        move_uploaded_file($file_tmp, $url_source_logo);
                        $d = $this->compress($url_source_logo, $url_dest_logo, 55);
                    }

                    $in_folder1="fake_fols/".$rename_logo; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data_logo = array(
                        'company_logo' => $new_name_logo
                    );
                }


                if(isset($_FILES['file_ad']['name']) && @$_FILES['file_ad']['name'] != ''){
                    $file_tmp = @$_FILES["file_ad"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_ad']['name']) ){
                        if($txtc_id != "" || $immediate_id != "")
                            $this->sql_models->delete_memb_pics($former_ad_file, 'companys/');

                        move_uploaded_file($file_tmp, $url_source_ad);
                        $d = $this->compress($url_source_ad, $url_dest_ad, 55);
                    }

                    $in_folder1="fake_fols/".$rename_logo; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data_ads = array(
                        'company_ads' => $new_name_ad
                    );
                }


                if($txtc_id == "" || $immediate_id == ""){ // new upload
                    $data2 = array(
                        'user_id'         => $this->myID,
                        'title'           => $txttitle,
                        'media_type'      => $txtctype,
                        'descrip'         => $txtdescrip,
                        'sponsoredby'     => $txtsponName,
                        'price1'          => $txtfprize,
                        'price2'          => $txtsprize,
                        'price3'          => $txttprize,
                        'price4'          => $txtftprize,
                        'price5'          => $txtffprize,
                        'add_price1'      => $txtadd_gift1,
                        'add_price2'      => $txtadd_gift2,
                        'add_price3'      => $txtadd_gift3,
                        'add_price4'      => $txtadd_gift4,
                        'add_price5'      => $txtadd_gift5,
                        'instructions'    => $txtinstr,
                        'premium'         => $txtvotetype,
                        'entry_type'      => $txtentry_type,
                        'entry_fee'       => $txtentryfee,
                        'start_date'      => $txtstartdate,
                        'close_date_entry'    => $txtclosedate,
                        'start_date_contest'  => $txtstartduration,
                        'timings'         => $txtduration,
                        'completed'       => 0,
                        'date_created'    => date("Y-m-d g:i a", time())
                    );

                }else{ // edit

                    $data2 = array(
                        'title'           => $txttitle,
                        'media_type'      => $txtctype,
                        'descrip'         => $txtdescrip,
                        'sponsoredby'     => $txtsponName,
                        'price1'          => $txtfprize,
                        'price2'          => $txtsprize,
                        'price3'          => $txttprize,
                        'price4'          => $txtftprize,
                        'price5'          => $txtffprize,
                        'add_price1'      => $txtadd_gift1,
                        'add_price2'      => $txtadd_gift2,
                        'add_price3'      => $txtadd_gift3,
                        'add_price4'      => $txtadd_gift4,
                        'add_price5'      => $txtadd_gift5,
                        'instructions'    => $txtinstr,
                        'premium'         => $txtvotetype,
                        'entry_type'      => $txtentry_type,
                        'entry_fee'       => $txtentryfee,
                        'start_date'      => $txtstartdate,
                        'close_date_entry'    => $txtclosedate,
                        'start_date_contest'  => $txtstartduration,
                        'timings'         => $txtduration
                    );
                }

                $newdata3 = array_merge($data1, $data2, $data_logo, $data_ads);

                $txtc_id = $immediate_id;

                $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtc_id, 'contests');
                if(!$querys1)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!", 'msg1'=>"");
                else{
                    if($checkme==1) $make_visible=1; else $make_visible=0;
                    if($checkme1==0) $make_visible1=1; else $make_visible1=0;

                    $this->db->set('phone_visible', $make_visible);
                    $this->db->set('social_handles', $make_visible1);
                    $this->db->where('id', $this->myID)->where('mem_type', 'spon');
                    $query = $this->db->update('members');

                    $arrs = array('type'=>'success', 'msg'=>$querys1, 'msg1'=>$new_name4);
                }
            } 
        }
        echo json_encode($arrs);
    }



    function submitMyAds(){
        $txtad_id = $this->input->post('txtad_id');
        $txtgoback_ad_id = $this->input->post('txtgoback_ad_id');
        $this->form_validation->set_rules('txttitle', 'Ad Title', 'required|trim|min_length[6]|max_length[100]');
        if($txtad_id=="")
            $this->form_validation->set_rules('txtsize', 'Ad Size', 'required|trim');

        //if($txtad_id=="")
            //$this->form_validation->set_rules('txtpositn', 'Ad Position', 'required|trim');

        if($txtad_id=="")
            $this->form_validation->set_rules('txtdurs1', 'Duration', 'required|trim');

        $txtmemid = $this->input->post('txtmemid');
        $amount = $this->input->post('amount');
        $pay_mthd = $this->input->post('pay_mthd');
        $txtdurs = $this->input->post('txtdurs1');
        $wallet_amt = $this->input->post('wallet_amt');
        $response = $this->input->post('response');
        $txttitle = $this->input->post('txttitle');
        $txtsize = $this->input->post('txtsize');
        $txtlink = $this->input->post('txtlink');
        //$txtpositn = $this->input->post('txtpositn');
        $txtamts = $this->input->post('txtamts_adv');
        $payment_status = $this->input->post('payment_status');
        $txturl = "all";

        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'images'=>"", 'back_adid'=>"");
        }else{

            $former_file = $this->input->post('former_file');
            $txt_yes_file_bma = $this->input->post('txt_yes_file_bma');
            
            $path4 = @$_FILES['file_banner']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $img_ext_chk1 = array('jpg','jpeg');
            $data1 = array();
            $data2 = array();
            //$data3 = array();

            if(@$_FILES['file_banner']['name'] == "" && $txt_yes_file_bma==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload an image for your AD", 'images'=>"", 'back_adid'=>"");

            else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image", 'images'=>"", 'back_adid'=>"");

            else if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['size'] > 3145728)
                $arrs = array('type'=>'error', 'msg'=>"This image has exceeded 3MB", 'images'=>"", 'back_adid'=>"");

            else{
                $randm = time();
                $rename_file = "$randm.$ext4";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "adverts1/".$rename_file;
                
                $new_name4 = $rename_file;
                if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner']['name']) ){
                        if($txtad_id != "" || $txtgoback_ad_id != "")
                            $this->sql_models->delete_memb_pics($former_file, 'adverts1/');

                        move_uploaded_file($file_tmp, $url_source);
                        $d = $this->compress($url_source, $url_dest, 80);
                    }

                    $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data1 = array(
                        'files' => $new_name4
                    );
                }

                $sessions = time();

                $time_stamp = strtotime('+'.$txtdurs, time());

                if($txtmemid <= 0){ // for admin
                    if($txtad_id == ""){ // new upload
                        $data2 = array(
                            'approved'          => 1,
                            'user_id'           => $txtmemid,
                            'title'             => $txttitle,
                            'sizes'             => $txtsize,
                            //'positns'           => $txtpositn,
                            'positns'           => "",
                            'extendeds'         => 0,
                            'duration'          => $txtdurs,
                            'duration_stamp'    => $time_stamp,
                            'urls'              => $txturl,
                            'urls1'             => $txtlink,
                            'amt'               => 0,
                            'date_created'      => date("Y-m-d g:i a", time())
                        );

                    }else{ // edit

                        $data2 = array(
                            'title'             => $txttitle,
                            'sizes'             => $txtsize,
                            //'positns'           => $txtpositn,
                            'positns'           => "",
                            'duration'          => $txtdurs,
                            'urls'              => $txturl,
                            'urls1'             => $txtlink
                        );
                    }

                }else{

                    if($txtad_id == "" || $txtgoback_ad_id == ""){ // new upload
                        $data2 = array(
                            'sessions'          => $sessions,
                            //'approved'          => 1,
                            'approved'          => 0,
                            'user_id'           => $txtmemid,
                            'title'             => $txttitle,
                            'sizes'             => $txtsize,
                            //'positns'           => $txtpositn,
                            'positns'           => "",
                            'extendeds'         => 0,
                            'duration'          => $txtdurs,
                            //'duration_stamp'    => $time_stamp,
                            'duration_stamp'    => 0,
                            'urls'              => $txturl,
                            'urls1'             => $txtlink,
                            'amt'               => $txtamts,
                            'date_created'      => date("Y-m-d g:i a", time())
                        );

                    }else{ // edit
                        $data2 = array(
                            'title'             => $txttitle,
                            'urls'              => $txturl,
                            'urls1'             => $txtlink
                        );
                    }
                }

                $newdata3 = array_merge($data1, $data2);

                if($txtgoback_ad_id > 0 || $txtgoback_ad_id != ""){
                    $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtgoback_ad_id, 'adverts');
                }else{
                    $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtad_id, 'adverts');
                }

                if($querys1 === false)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!", 'images'=>"", 'back_adid'=>"");
                else{
                    $arrs = array('type'=>'success', 'msg'=>"", 'images'=>$new_name4, 'back_adid'=>$querys1);
                }
            }
        }
        echo json_encode($arrs);
    }



    function submitBlog(){
        $this->form_validation->set_rules('txttitle', 'Blog Title', 'required|trim|min_length[6]|max_length[100]');
        $this->form_validation->set_rules('txtmsg', 'Blog Content', 'required|trim');

        $txtad_id = $this->input->post('txtbg_id');
        $txttitle = $this->input->post('txttitle');
        $txtmsg = $this->input->post('txtmsg');
        

        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'images'=>"",);
        }else{

            $former_file = $this->input->post('former_file');
            $txt_yes_file_bma = $this->input->post('txt_yes_file_bma');
            
            $path4 = @$_FILES['file_banner']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $img_ext_chk1 = array('jpg','jpeg');
            $data1 = array();
            $data2 = array();
            //$data3 = array();

            if(@$_FILES['file_banner']['name'] == "" && $txt_yes_file_bma==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload an image for your AD", 'images'=>"", 'back_adid'=>"");

            else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image", 'images'=>"", 'back_adid'=>"");

            else if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['size'] > 3145728)
                $arrs = array('type'=>'error', 'msg'=>"This image has exceeded 3MB", 'images'=>"", 'back_adid'=>"");

            else{
                $randm = time();
                $rename_file = "$randm.$ext4";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "cblogs/".$rename_file;
                
                $new_name4 = $rename_file;
                if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner']['name']) ){
                        if($txtad_id != "")
                            $this->sql_models->delete_memb_pics($former_file, 'cblogs/');

                        move_uploaded_file($file_tmp, $url_source);
                        $d = $this->compress($url_source, $url_dest, 70);
                    }

                    $in_folder1="fake_fols/".$rename_file;
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data1 = array(
                        'files' => $new_name4
                    );
                }

                if($txtad_id == ""){ // new upload
                    $data2 = array(
                        'titles'        => $txttitle,
                        'contents'      => $txtmsg,
                        'date_created'  => date("Y-m-d g:i a", time())
                    );

                }else{ // edit

                    $data2 = array(
                        'titles'        => $txttitle,
                        'contents'      => $txtmsg,
                    );
                }

                $querys1 = $this->sql_models->update_inserts_recs($data2, $txtad_id, 'blogs');

                if($querys1 === false)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!", 'images'=>"");
                else{
                    $data3 = array(
                        'blog_id'        => $querys1
                    );

                    $newdata3 = array_merge($data1, $data3);

                    if($txtad_id == ""){
                        $this->db->insert('blogs_images', $newdata3);
                    }else{
                        if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                            $this->db->set('files', $new_name4);
                            $this->db->where('blog_id', $querys1);
                            $this->db->update('blogs_images');
                        }
                    }

                    if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                        $arrs = array('type'=>'success', 'msg'=>"", 'images'=>$new_name4);
                    }else{
                        $arrs = array('type'=>'success', 'msg'=>"", 'images'=>$former_file);
                    }
                }
            }
        }
        echo json_encode($arrs);
    }



    function update_payment_ads(){
        $this->form_validation->set_rules('pay_mthd', 'Payment Method', 'required|trim');

        $user_id = trim($this->input->post('user_id'));
        $amount = trim($this->input->post('amount'));
        $pay_mthd = $this->input->post('pay_mthd');
        $txtdurs = $this->input->post('txtdurs');
        $wallet_amt = $this->input->post('wallet_amt');
        $response = $this->input->post('response');
        $txttitle = $this->input->post('txttitle');
        $txtsize = $this->input->post('txtsize');
        $txtlink = $this->input->post('txtlink');
        $txtflutter = $this->input->post('txtflutter');
        $payment_status = $this->input->post('payment_status');
        $adv_sessions = $this->input->cookie('adv_sessions', TRUE); // referral id

        if($txtflutter==1){
            echo "This feature has been disabled!";
            exit;
        }

        if($this->form_validation->run() == FALSE){
            //$arrs = array('type'=>'error', 'msg'=>validation_errors());
            echo validation_errors();
        }else{

            $txtexp = strtotime('+'.$txtdurs, time());
            $this->db->where('sessions', $adv_sessions);
            $this->db->set('approved', 1);
            $this->db->set('extendeds', 0);
            $this->db->set('duration_stamp', $txtexp);
            $this->db->set('payment_mth', $pay_mthd);
            $this->db->set('ref', $response);
            $query = $this->db->update('adverts');

            if($pay_mthd=="wallet"){
                $this->db->set('wallet', "wallet-$amount", FALSE);
                $this->db->where('id', $user_id)->where('wallet >=', $amount);
                $this->db->update('members');
            }

            $getMemDetls1 = $this->sql_models->getDetails($user_id);
            $memName = ucwords($getMemDetls1['names']);
            $memNick = ucwords($getMemDetls1['nickname']);
            $memEmail = strtolower($getMemDetls1['emails']);
            if(strlen($memName)<=2) $memName = ucwords($memNick);

            //////////////////FOR EMAILS/////////////////////////
                $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                Your advert has successfully been approved and now shown on our iContestPRO platform for $txtdurs. Kindly view the platform to verify at <a href='".base_url()."'>https://icontestpro.com</a>.<br><br>Please be notified that if we notice any fradulent advert of yours or any advert that may infringe our <a href='".base_url()."terms-of-use/'>terms and condition</a>, we will delete it without any refund! Thank you for your patronage!</p>";
            //////////////////FOR EMAILS///////////////////////// 

            $subj = "Your Advert Has Been Set";
            $from = "Adverts Placement <noReply@icontestpro.com>";
            $to = $memEmail;
            $from_name = "iContestPRO Advert Placement";

            $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
            $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
            if($query){
                $cookie = array(
                    'name'   => 'adv_sessions',
                    'value'  => '',
                    'expire' => '0',
                    'secure' => FALSE
                );
                delete_cookie($cookie);
                echo "success";
            }else{
                echo "Error";
            }
        }
    }



    function refresh_select_box(){
        $votetype = $this->input->post('votetype'); // free, free_paid, paid
        $votetype = strtolower($votetype);

        $contest_fee1 = $this->contest_fee;
        if($contest_fee1 <= 0) $contest_fee1="Free"; else $contest_fee1="&#8358;".@number_format($contest_fee1);

        $contest_fee2 = $this->contest_fee2;
        if($contest_fee2 <= 0) $contest_fee2="Free"; else $contest_fee2="&#8358;".@number_format($contest_fee2);

        $contest_fee3 = $this->contest_fee3;
        if($contest_fee3 <= 0) $contest_fee3="Free"; else $contest_fee3="&#8358;".@number_format($contest_fee2);

        $contest_fee1i = str_replace(array("&#8358;", ","), "", $contest_fee1);
        $contest_fee2i = str_replace(array("&#8358;", ","), "", $contest_fee2);
        $contest_fee3i = str_replace(array("&#8358;", ","), "", $contest_fee3);

        ?>
        <select class="form-control show-tick" id="txtconType" name="txtconType">
            <option data-value="<?=$contest_fee1?>" data-value1="For <?=$this->paid_votes?>% Vote Commission" data-value2="<?=$contest_fee1i?>" data-value3="1" selected><?=$contest_fee1?> For <?=$this->paid_votes?>% Vote Commission</option>
            
            <option data-value="<?=$contest_fee2?>" data-value1="For <?=$this->paid_votes2?>% Vote Commission" data-value2="<?=$contest_fee2i?>" data-value3="2"><?=$contest_fee2?> For <?=$this->paid_votes2?>% Vote Commission</option>

            <option <?php if($votetype=="free") echo "disabled"; ?> data-value="<?=$contest_fee3?>" data-value1="For <?=$this->paid_votes3?>% Vote Commission" data-value2="<?=$contest_fee3i?>" data-value3="3"><?=$contest_fee3?> For <?=$this->paid_votes3?>% Vote Commission</option>
        </select>
        <?php
    }




    function update_payment_contst(){
        $this->form_validation->set_rules('pay_mthd', 'Payment Method', 'required|trim');

        $user_id = trim($this->input->post('user_id'));
        $amount = trim($this->input->post('amount'));
        $pay_mthd = $this->input->post('pay_mthd');
        $txtcontest_id = $this->input->post('txtcontest_id');
        $txtflutter = $this->input->post('txtflutter');
        $txtconType = $this->input->post('txtconType');
        $txtconType1 = $this->input->post('txtconType1');

        if($txtflutter==1){
            echo "This feature has been disabled!";
            exit;
        }

        if($this->form_validation->run() == FALSE && $txtconType1!=3){
            echo validation_errors();
        }else{

            $this->db->where('id', $txtcontest_id);
            $this->db->set('paids', $txtconType);
            $this->db->set('contest_type', $txtconType1);
            $query = $this->db->update('contests');

            if($pay_mthd=="wallet"){
                $this->db->set('wallet', "wallet-$amount", FALSE);
                $this->db->where('id', $user_id)->where('wallet >=', $amount);
                $this->db->update('members');
            }

            if($query){
                echo "success";
            }else{
                echo "Error";
            }
        }
    }



    function loadVideo(){
        $hisname = $this->input->post('hisname');
        $con_id = $this->input->post('con_id');
        $memid = $this->input->post('memid');
        $pics = $this->input->post('pics');
        $hnames = explode(' ', $hisname);
        $hfname = $hnames[0];
        $files_ = $this->sql_models->getVids($con_id, $memid, "");
        $img_cover=base_url()."media_uploads/$pics";
        $media_files = base_url()."media_uploads/$files_";

        $fid = $this->input->post('fid');
        $con_title = $this->input->post('con_title');
        $his_fb = $this->input->post('his_fb');
        $his_ig = $this->input->post('his_ig');
        $his_tw = $this->input->post('his_tw');
        $con_ads = $this->input->post('con_ads');
        $start_vote = $this->input->post('start_vote');
        $names = $this->input->post('names');
        $mycontestid = $this->input->post('mycontestid');
        $expiry = $this->input->post('expiry');
        $autonum = $this->input->post('autonum');
        $myvotes = $this->input->post('myvotes');
        $memids = $this->input->post('memids');
        $myid = $this->input->post('myid');
        $onpg = $this->input->post('onpg');
        $caps = $this->input->post('caps');
        $ids = $this->input->post('memid');
        $user_id_spon = $this->input->post('user_id_spon');


        $hnames = explode(' ', $hisname);
        $hfname = $hnames[0];
        $files_ = $this->sql_models->getVidsProfile($fid, $memid);

        $contestDetails = $this->sql_models->getContestDetails($mycontestid);
        $hasExpired = $this->sql_models->checkVoteExpiry($mycontestid);
        $timeToVOte = $this->sql_models->timeToVOte($mycontestid);

        $start_date_contests="(not specified)";
        if(strlen($contestDetails['start_date_contest'])>3)
            $start_date_contests = @date("jS M, Y h:i a", strtotime($contestDetails['start_date_contest']));
        $start_date_contest1 = $contestDetails['start_date_contest'];
        $timings3 = $contestDetails['timings'];

        $img_cover=base_url()."images/videos.png";
        $media_files = base_url()."media_uploads/$files_";

        $company_ads1_ = $con_ads;
        $img_ads2="";
        if($con_ads=="") $company_ads1_ = $files_1;
        $img_ads2 = base_url()."companys/$con_ads";

        $width1="";
        list($width1, $height1, $type1, $attr1) = @getimagesize($img_ads2);
        if($width1=="" || $width1<=0)
            $img_ads2 = base_url()."contest_types/$con_ads";

        $img_ads1 = "<img src='$img_ads2' class='img-responsive mt-10'>";


        if($his_fb!="")
            $his_fb1 = "hrefs='https://www.facebook.com/$his_fb' id='hasLink' social_handle='fb_vp' user_id='$user_id_spon'";
        else
            $his_fb1 = "href='javascript:;' id='noLink'";

        if($his_ig!="")
            $his_ig1 = "hrefs='https://www.instagram.com/$his_ig' id='hasLink' social_handle='ig_vp' user_id='$user_id_spon'";
        else
            $his_ig1 = "href='javascript:;' id='noLink'";

        if($his_tw!="")
            $his_tw1 = "hrefs='https://www.twitter.com/$his_tw' id='hasLink' social_handle='tw_vp' user_id='$user_id_spon'";
        else
            $his_tw1 = "href='javascript:;' id='noLink'";

        $exts = pathinfo($media_files, PATHINFO_EXTENSION);
        $img_ext_chk = array('jpg','png','jpeg', 'gif');

        $for_voteme="";
        $for_voteme .= "<div class='mt-10 mb-10 mt-xs-s0 voteme_profile voteme_profile_i' style='position: relative; z-index: 99'>
            <span class='voteme_btn_profile$ids'>";
            if($hasExpired){
                $for_voteme .= "<a class='voteme_exp votedis gallery_vote' id='voteme' href='javascript:;'>Vote Expired</a>";
            }else{

                if($this->myID == $user_id_spon && $this->myID>0){
                    $for_voteme .= "<a class='vote_user votedis gallery_vote' id='voteme' href='javascript:;'>Vote $names <font class='vote_counts$mycontestid$memids'style='color:#888'>($myvotes)</font></a>";
                }else{
                    if($timeToVOte && strlen($start_date_contest1)>3){
                        $for_voteme .= "<a class='voteme_ajax voteme_j$ids voteme_k$ids gallery_vote' id='voteme' names='$hfname' mycontestid='$mycontestid'  expiry='$expiry' autonum='$autonum' myvotes='$myvotes' memids='$memids' myid='$myid' onpg='profile' caps='Vote $hfname' href='javascript:;'>Vote $hfname <font class='vote_counts$mycontestid$memids' style='color:#DD6F00'>($myvotes)</font></a>";
                    }else{
                        $for_voteme .= "<a class='votedis vote_user1 gallery_vote' id='voteme' start_vote='$start_date_contests' href='javascript:;'>Vote $hisname <font class='vote_counts$mycontestid$memids' style='color:#888'>($myvotes)</font></a>";
                    }
                }
            }
            $for_voteme .= "</span>
        </div>";

        if(in_array($exts, $img_ext_chk))
            $mycaps = "Photo";
        else
            $mycaps = "Video";
        ?>


        <div class="house_vid container p-0">
            <div class="col-sm-9 p-0 border_left">
                <div class="entries_title">
                    <p><?=$hfname?>&prime;s <?=$mycaps?></p>
                    <p class="closevid"><i class="fa fa-close"></i></p>
                </div>

                <div class="vote_me_align_right"><?=$for_voteme?></div>

                <?php
                if(in_array($exts, $img_ext_chk)){ ?>
                    <div class="text-center">
                        <img src="<?=$media_files?>" class="img-responsive_">
                    </div>
                    <div class="close_btn_vid for_mobile2 closevid">Close Photo</div>
                <?php }else{ ?>
                ?>
                    <video id='my_video_1__' style='width:100% !important; cursor: pointer;' class='_video-js vjs-default-skin__' controls controlsList='nodownload' preload='auto' 
                        poster='<?=$img_cover?>' oncontextmenu='return false;' autoplay>
                        <source src='<?=$media_files?>' type='video/mp4'>
                        <source src='<?=$media_files?>' type='video/webm'>
                    </video>
                    <div class="close_btn_vid for_mobile2 closevid">Close Video</div>
                <?php } ?>
            </div>


            <div class="col-sm-3 pr-0 pr-xs-5 pl-xs-5">
                <div class="overflow_height1">
                    <p class="adv_titles"><?=$con_title?></p>
                    <p><?=$img_ads1?></p>

                    <p style="line-height: 19px; text-align: center; color: #ccc; font-size: 14px;">Follow Sponsor&prime;s Social Media pages and get 10VP</p>
                    <div class="social_fbtns pb-30 pb-xs-0">
                        <a class="fb" <?=$his_fb1?> >Facebook</a>
                        <a class="ig" <?=$his_ig1?> >Instagram</a>
                        <a class="tw" <?=$his_tw1?> >Twitter</a>
                    </div>
                    <div class="for_mobile2 pb-20">&nbsp;</div>
                </div>
            </div>
        </div>

        <?php
    }



    function loadVideo1(){
        $hisname = $this->input->post('hisname');
        $fid = $this->input->post('fid');
        $memid = $this->input->post('memid');
        $con_title = $this->input->post('con_title');
        $his_fb = $this->input->post('his_fb');
        $his_ig = $this->input->post('his_ig');
        $his_tw = $this->input->post('his_tw');
        $con_ads = $this->input->post('con_ads');
        $start_vote = $this->input->post('start_vote');
        $names = $this->input->post('names');
        $mycontestid = $this->input->post('mycontestid');
        $expiry = $this->input->post('expiry');
        $autonum = $this->input->post('autonum');
        $myvotes = $this->input->post('myvotes');
        $memids = $this->input->post('memids');
        $myid = $this->input->post('myid');
        $onpg = $this->input->post('onpg');
        $caps = $this->input->post('caps');
        $ids = $this->input->post('memid');
        $user_id_spon = $this->input->post('user_id_spon');

        $hnames = explode(' ', $hisname);
        $hfname = $hnames[0];
        $files_ = $this->sql_models->getVidsProfile($fid, $memid);

        $contestDetails = $this->sql_models->getContestDetails($mycontestid);
        $hasExpired = $this->sql_models->checkVoteExpiry($mycontestid);
        $timeToVOte = $this->sql_models->timeToVOte($mycontestid);

        $start_date_contests="(not specified)";
        if(strlen($contestDetails['start_date_contest'])>3)
            $start_date_contests = @date("jS M, Y h:i a", strtotime($contestDetails['start_date_contest']));
        $start_date_contest1 = $contestDetails['start_date_contest'];
        $timings3 = $contestDetails['timings'];

        $img_cover=base_url()."images/videos.png";
        $media_files = base_url()."media_uploads/$files_";

        $company_ads1_ = $con_ads;
        $img_ads2="";
        if($con_ads=="") $company_ads1_ = $files_1;
        $img_ads2 = base_url()."companys/$con_ads";

        $width1="";
        list($width1, $height1, $type1, $attr1) = @getimagesize($img_ads2);
        if($width1=="" || $width1<=0)
            $img_ads2 = base_url()."contest_types/$con_ads";

        $img_ads1 = "<img src='$img_ads2' class='img-responsive mt-10'>";

        if($his_fb!="")
            $his_fb1 = "hrefs='https://www.facebook.com/$his_fb' id='hasLink' social_handle='fb_vp' user_id='$user_id_spon'";
        else
            $his_fb1 = "href='javascript:;' id='noLink'";

        if($his_ig!="")
            $his_ig1 = "hrefs='https://www.instagram.com/$his_ig' id='hasLink' social_handle='ig_vp' user_id='$user_id_spon'";
        else
            $his_ig1 = "href='javascript:;' id='noLink'";

        if($his_tw!="")
            $his_tw1 = "hrefs='https://www.twitter.com/$his_tw' id='hasLink' social_handle='tw_vp' user_id='$user_id_spon'";
        else
            $his_tw1 = "href='javascript:;' id='noLink'";


        $for_voteme="";
        $for_voteme .= "<div class='mt-10 mb-10 mt-xs-s0 voteme_profile voteme_profile_i' style='position: relative; z-index: 99'>
            <span class='voteme_btn_profile$ids'>";
            if($hasExpired){
                $for_voteme .= "<a class='voteme_exp votedis gallery_vote' id='voteme' href='javascript:;'>Vote Expired</a>";
            }else{

                if($this->myID == $user_id_spon && $this->myID>0){
                    $for_voteme .= "<a class='vote_user votedis gallery_vote' id='voteme' href='javascript:;'>Vote $names <font class='vote_counts$mycontestid$memids'style='color:#888'>($myvotes)</font></a>";
                }else{
                    if($timeToVOte && strlen($start_date_contest1)>3){
                        $for_voteme .= "<a class='voteme_ajax voteme_j$ids voteme_k$ids gallery_vote' id='voteme' names='$names' mycontestid='$mycontestid'  expiry='$expiry' autonum='$autonum' myvotes='$myvotes' memids='$memids' myid='$myid' onpg='profile' caps='Vote $names' href='javascript:;'>Vote $names <font class='vote_counts$mycontestid$memids' style='color:#DD6F00'>($myvotes)</font></a>";
                    }else{
                        $for_voteme .= "<a class='votedis vote_user1 gallery_vote' id='voteme' start_vote='$start_date_contests' href='javascript:;'>Vote $names <font class='vote_counts$mycontestid$memids' style='color:#888'>($myvotes)</font></a>";
                    }
                }
            }
            $for_voteme .= "</span>
        </div>";

        ?>
        <div class="house_vid container p-0">
            <div class="col-sm-9 p-0 border_left">
                <div class="entries_title">
                    <p><?=$names?>&prime;s Video</p>
                    <p class="closevid"><i class="fa fa-close"></i></p>
                </div>

                <div class="vote_me_align_right"><?=$for_voteme?></div>

                <video id='my_video_1__' style='width:100% !important; cursor: pointer;' class='_video-js vjs-default-skin__' controls controlsList='nodownload' preload='auto' 
                    poster='<?=$img_cover?>' oncontextmenu='return false;' autoplay>
                    <source src='<?=$media_files?>' type='video/mp4'>
                    <source src='<?=$media_files?>' type='video/webm'>
                </video>
                <div class="close_btn_vid for_mobile2 closevid">Close Video</div>
            </div>

            <div class="col-sm-3 pr-0 pr-xs-5 pl-xs-5">
                <div class="overflow_height1">
                    <p class="adv_titles"><?=$con_title?></p>
                    <p><?=$img_ads1?></p>

                    <p style="line-height: 19px; text-align: center; color: #ccc; font-size: 14px;">Follow Sponsor's Social Media pages and get 10VP</p>
                    <div class="social_fbtns">
                        <a class="fb" <?=$his_fb1?> >Facebook</a>
                        <a class="ig" <?=$his_ig1?> >Instagram</a>
                        <a class="tw" <?=$his_tw1?> >Twitter</a>
                    </div>
                    <div class="for_mobile2 pb-20">&nbsp;</div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            setTimeout(function(){
                var pl = videojs('my_video_1');
                pl.play();
            },700);
        </script>
        <?php
    }

    



    function _notMatch($book2Value, $book1FieldName){
       if($book2Value == $this->input->post($book1FieldName)){
           $this->form_validation->set_message('_notMatch', 'The lucky numbers should not be the same');
           return false;
       }
       return true;
    }



    function addMyVP(){
        $social_handle = $this->input->post('social_handle');
        $user_id = $this->input->post('user_id');
        $vps=10;
        if($user_id != $this->myID){
            $this->db->select('id')->from('members')->where('id', $this->myID)->where($social_handle, 0);
            $querys = $this->db->get();
            if($querys->num_rows() > 0){
                $this->db->set('vp', "vp+$vps", FALSE);
                $this->db->set($social_handle, 1);
                $this->db->where('id', $this->myID)->where($social_handle, 0);
                $this->db->update('members');
            }
        }
    }



    function submitLotto(){
        $txtrw_id = $this->input->post('txtrw_id');
        $this->form_validation->set_rules('txttitle', 'Reward Title', 'required|trim|min_length[6]|max_length[100]');
        if($txtrw_id==""){
            $this->form_validation->set_rules('txtnum1', 'Lucky Number 1', 'required|trim|numeric|max_length[2]|greater_than[0]|less_than[81]');

            $this->form_validation->set_rules('txtnum2', 'Lucky Number 2', 'required|trim|numeric|max_length[2]|greater_than[0]|less_than[81]|callback__notMatch[txtnum1]|callback__notMatch[txtnum3]');

            $this->form_validation->set_rules('txtnum3', 'Lucky Number 3', 'required|trim|numeric|max_length[2]|greater_than[0]|less_than[81]|callback__notMatch[txtnum1]|callback__notMatch[txtnum2]');
        }
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors());
        }else{

            $txttitle = $this->input->post('txttitle');
            $txtnum1 = $this->input->post('txtnum1');
            $txtnum2 = $this->input->post('txtnum2');
            $txtnum3 = $this->input->post('txtnum3');

            $former_file1 = $this->input->post('former_file1');
            $former_file2 = $this->input->post('former_file2');
            $former_file3 = $this->input->post('former_file3');

            $txt_yes_file1 = $this->input->post('txt_yes_file1');
            $txt_yes_file2 = $this->input->post('txt_yes_file2');
            $txt_yes_file3 = $this->input->post('txt_yes_file3');

            $path1 = @$_FILES['file_banner1']['name'];
            $path2 = @$_FILES['file_banner2']['name'];
            $path3 = @$_FILES['file_banner3']['name'];

            $ext1 = pathinfo($path1, PATHINFO_EXTENSION);
            $ext2 = pathinfo($path2, PATHINFO_EXTENSION);
            $ext3 = pathinfo($path3, PATHINFO_EXTENSION);

            $img_ext_chk1 = array('jpg','png','jpeg');
            $data1 = array();
            $data2 = array();
            $data3 = array();
            $data4 = array();

            if(@$_FILES['file_banner1']['name'] == "" && $txt_yes_file1==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload a image for gift 1");

            else if(@$_FILES['file_banner2']['name'] == "" && $txt_yes_file2==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload a image for gift 2");

            else if(@$_FILES['file_banner3']['name'] == "" && $txt_yes_file3==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload a image for gift 3");

            else if(!in_array($ext1,$img_ext_chk1) && isset($_FILES['file_banner1']['name']) && @$_FILES['file_banner1']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for gift 1");

            else if(!in_array($ext2,$img_ext_chk1) && isset($_FILES['file_banner2']['name']) && @$_FILES['file_banner2']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for gift 2");

            else if(!in_array($ext3,$img_ext_chk1) && isset($_FILES['file_banner3']['name']) && @$_FILES['file_banner3']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for gift 3");

            else if(isset($_FILES['file_banner1']['name']) && @$_FILES['file_banner1']['size'] > 1048576)
                $arrs = array('type'=>'error', 'msg'=>"Image 1 has exceeded 1MB");

            else if(isset($_FILES['file_banner2']['name']) && @$_FILES['file_banner2']['size'] > 1048576)
                $arrs = array('type'=>'error', 'msg'=>"Image 2 has exceeded 1MB");

            else if(isset($_FILES['file_banner3']['name']) && @$_FILES['file_banner3']['size'] > 1048576)
                $arrs = array('type'=>'error', 'msg'=>"Image 3 has exceeded 1MB");

            else{
                $randm = mt_rand(1111111, 9999999);
                $rename_file1 = "$randm.$ext1";

                $randm = mt_rand(1111111, 9999999);
                $rename_file2 = "$randm.$ext2";

                $randm = mt_rand(1111111, 9999999);
                $rename_file3 = "$randm.$ext3";
                
                $url_source1 = "fake_fols/".$rename_file1;
                $url_source2 = "fake_fols/".$rename_file2;
                $url_source3 = "fake_fols/".$rename_file3;

                $url_dest1 = "lottery_prizes/".$rename_file1;
                $url_dest2 = "lottery_prizes/".$rename_file2;
                $url_dest3 = "lottery_prizes/".$rename_file3;
                
                if(isset($_FILES['file_banner1']['name']) && @$_FILES['file_banner1']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner1"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner1']['name']) ){
                        if($txtrw_id != "")
                            $this->sql_models->delete_memb_pics($former_file1, 'lottery_prizes/');

                        move_uploaded_file($file_tmp, $url_source1);
                        $d = $this->compress($url_source1, $url_dest1, 55);
                    }
                    $data1 = array('file1' => $rename_file1);
                }

                if(isset($_FILES['file_banner2']['name']) && @$_FILES['file_banner2']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner2"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner2']['name']) ){
                        if($txtrw_id != "")
                            $this->sql_models->delete_memb_pics($former_file2, 'lottery_prizes/');

                        move_uploaded_file($file_tmp, $url_source2);
                        $d = $this->compress($url_source2, $url_dest2, 55);
                    }
                    $data2 = array('file2' => $rename_file2);
                }

                if(isset($_FILES['file_banner3']['name']) && @$_FILES['file_banner3']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner3"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner3']['name']) ){
                        if($txtrw_id != "")
                            $this->sql_models->delete_memb_pics($former_file3, 'lottery_prizes/');

                        move_uploaded_file($file_tmp, $url_source3);
                        $d = $this->compress($url_source3, $url_dest3, 55);
                    }
                    $data3 = array('file3' => $rename_file3);
                }

                $in_folder1="fake_fols/";
                if(is_readable($in_folder1)){
                    foreach(glob($in_folder1.'*.*') as $v){
                        unlink($v);
                    }
                }

                if($txtrw_id == ""){ // new upload
                    $data4 = array(
                        'approved'          => 0,
                        'titles'            => $txttitle,
                        'num1'              => $txtnum1,
                        'num2'              => $txtnum2,
                        'num3'              => $txtnum3,
                        'rand_nums1'        => $txtnum1,
                        'rand_nums2'        => $txtnum2,
                        'rand_nums3'        => $txtnum3,
                        'date_created'      => date("Y-m-d g:i a", time())
                    );

                }else{ // edit

                    $data4 = array(
                        'titles'            => $txttitle
                        // 'num1'              => $txtnum1,
                        // 'num2'              => $txtnum2,
                        // 'num3'              => $txtnum3,
                        // 'rand_nums1'        => $txtnum1,
                        // 'rand_nums2'        => $txtnum2,
                        // 'rand_nums3'        => $txtnum3
                    );
                }

                $newdata3 = array_merge($data1, $data2, $data3, $data4);

                $last_id = $this->sql_models->update_inserts_recs($newdata3, $txtrw_id, 'reward_tbl');
                if(!$last_id)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!");
                else{
                    for($i = 1; $i < 81; $i++){
                        $data[] = array(
                            'reward_id'      => $last_id,
                            'mynumbers'      => $i,
                            'rand_numbers'   => mt_rand(111111, 999999)
                        );
                    }
                    if($txtrw_id == "")
                        $batchInsert = $this->sql_models->batchInsert($data, $data4, $last_id, 'raffle_numbers');
                    else
                        $batchInsert = true;

                    if($batchInsert)
                        $arrs = array('type'=>'success', 'msg'=>"");
                    else
                        $arrs = array('type'=>'error', 'msg'=>"Could not update the lucky numbers");
                }
            }
        }
        echo json_encode($arrs);
    }



    function store_update_voters(){
        $txtcon_id = $this->input->post('txtcon_id');
        $sponsorID = $this->input->post('txtsponsorID');
        $cats = strtolower($this->input->post('cats')); // free, code, paid
        $memid = $this->input->post('memid'); // contestant id
        $txtvote_code = $this->input->post('txtvote_code');
        $txtmyvotes = $this->input->post('txtmyvotes');
        $txtfreevote = $this->input->post('txtfreevote'); // free and login vote
        $amt = $this->input->post('amt');
        $for_guest = $this->input->post('for_guest'); // guest or empty
        $pay_mthd = $this->input->post('pay_mthd');
        $url_params = $this->input->post('txt_url_params');
        $txt_url_params_ID = $this->input->post('txt_url_params_ID');

        /*if($amt=="" || $cats=="free"){
            echo "maintain";
            exit;
        }*/

        if($txtfreevote==1){
            echo "maintain";
            exit;
        }

        /*if($memid==1799){
            echo "disabled";
            exit;
        }*/

        $responses = false;
        $votes=1;
        $getDetails = $this->sql_models->getDetails($memid);
        //echo $memid."mmm";
        //print_r($getDetails); exit;
        $con_name = $getDetails['nickname'];
        $con_email = $getDetails['emails'];
        $unsub_v_email = $getDetails['unsub_vote_email'];
        $vps=1;

        if($this->sql_models->checkVoteExpiryPerDay($memid, $this->ntn)){echo "ntwk_er";exit;}
        $hasExpired = $this->sql_models->checkVoteExpiry($txtcon_id);

        if($hasExpired){
            echo "expired";
            exit;
        }

        if($this->myID==$memid){
            echo "self_vote";
            exit;
        }

        if($this->myID=="") $this->myID=0;

        /*if($cats=="code"){
            if($this->myID==0){
                echo "not_logged";
                exit;
            }else if($txtvote_code==""){
                echo "emptycode";
                exit;
            }else{
                $checkCode = $this->sql_models->check_code_validity($txtvote_code, $this->myID, $txtcon_id);
                if(!$checkCode){
                    echo "Invalid";
                    exit;
                }else{
                    $responses = true;
                }
            }
            $vps=5;
        }*/

        $data1 = array();
        if($cats=="free"){
            $responses = true;
            $data1 = array(
                'timings'   => strtotime('+6 hours', time())
            );

            if($txtfreevote==2){
                //$votes=2;
                $votes=1;
            }
        }


        if($cats=="paid"){
            if($this->myID==0 && $for_guest==""){
                echo "not_logged";
                exit;
            }else{
                if($for_guest==""){
                    $checkWallet = $this->sql_models->checkWallet($this->myID, $amt);
                    if($checkWallet){
                        $responses = true;
                    }else{
                        echo "insufficient";
                        exit;
                    }
                }else{
                    $responses = true;
                }

                $votes=10;
                if($amt==200) $votes=25;
                else if($amt==500) $votes=70;
                else if($amt==1000) $votes=150;
                else if($amt==2000) $votes=325;
                else if($amt==3000) $votes=500;
                else if($amt==5000) $votes=900;
                $vps=10;
            }
        }

        if($for_guest=="guest"){
            if($this->myID=="" || $this->myID<=0)
                $whos_id = 0;
            else
                $whos_id = $this->myID;
        }else{
            $whos_id = $this->myID;
        }

        if($responses){
            //$ipaddrs = $_SERVER['REMOTE_ADDR']; // ipaddress doesnt work in this case
            $ua = $this->getBrowser();
            $usragn = strtolower($ua['userAgent']);
            preg_match('#\((.*?)\)#', $usragn, $match); // extract strings in brackets
            $vars = $match[1];
            
            if(strpos($vars, "build") !== false){
                $truncate_var = substr($vars, 0, strpos($vars, "build"));
            } else{
                $truncate_var = $vars;
            }
            $truncate_var1 = str_replace(" u;", "", trim($truncate_var));
            $ipaddrs = $truncate_var1;

            $data2 = array(
                'contest_id'    => $txtcon_id,
                'ip_addrs'      => $ipaddrs,
                'votes'         => $votes,
                'contestant_id' => $memid,
                'voter'         => $whos_id,
                'vp'            => $vps,
                'date_created'  => date("Y-m-d g:i a", time())
            );

            $boosted = array(
                'contest_id'    => $txtcon_id,
                'contestant_id' => $memid,
                'voter'         => $whos_id,
                'votes'         => $votes,
                'amts'          => $amt
            );

            $newdata3 = array_merge($data1, $data2);

            $chktime = $this->sql_models->freeVoteTiming2($txtcon_id, $memid, $ipaddrs);

            if($chktime && $cats=="free"){
                echo "voted";
                exit;
            }else{

                $this->db->insert('all_votes', $newdata3);

                //$contestDetails = $this->sql_models->getContestDetails($txtcontID);
                //$user_id_spon = $contestDetails['user_id'];
                if($memid != $this->myID){

                    $this->sql_models->countAllNotiAndDelete();

                    $datas = array(
                        'memid'             => $this->myID,
                        'user_id'           => $memid,
                        'what_page'         => $url_params,
                        'page_id'           => $txt_url_params_ID,
                        'has_read'          => 0,
                        'actns'             => "voted",
                        'date_created'      => date("Y-m-d g:i a", time())
                    );
                    $this->db->insert('all_notifications', $datas);
                }

                if($votes > 2){ // if vote is more than 2, then its a boosted vote
                    $this->db->select("id")->from('bstd_vts');
                    $this->db->where('contest_id', $txtcon_id)->where('contestant_id', $memid);
                    $query = $this->db->get();
                    if($query->num_rows() > 0){ // update the votes for her
                        $this->db->set('votes', "votes+$votes", FALSE);
                        $this->db->set('amts', "amts+$amt", FALSE);
                        $this->db->where('contest_id', $txtcon_id)->where('contestant_id', $memid);
                        $this->db->update('bstd_vts');
                    }else{ // no such records, then insert for her
                        $this->db->insert('bstd_vts', $boosted);
                    }
                }

                $votes1 = $this->sql_models->update_mytables($txtcon_id, $memid, $votes, $txtvote_code, $amt, $sponsorID, $vps, $whos_id, $pay_mthd, $for_guest);
                echo $votes1;
            }
            //$votes = $this->sql_models->update_voters($txtcon_id, $memid, $votes);

            /*if($unsub_v_email==0){
                //////////////////FOR EMAILS/////////////////////////
                    //$ids = $row->id;
                    $nows = substr(time(), -5);
                    $ids_hash = $txtcon_id.$nows;
                    $ids_hash_mem = sha1($memid);
                    $getContestName = $this->sql_models->getContestName($txtcon_id);
                    $adv_title_f = cleanStr(strtolower($getContestName));
                    $votesCnt = $this->sql_models->noOfVotes1($memid, $txtcon_id, 'entries');
                    $urls = base_url()."$ids_hash/join/$adv_title_f/";

                    //if($votesCnt)

                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $con_name,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>

                    You just received <b>$votes votes</b> from a fan, for your entry on the 
                    <b>$getContestName</b>. You now have a total of <b>".number_format($votesCnt)." votes</b>, <a href='".$urls."' target='_blank'>click here</a> for more info.<br>

                    Want to see where you are on the <b>$getContestName</b> Leader Board?
                    <a href='".base_url()."voters-leaderboard/' target='_blank'>Click here</a><br><br>

                    For any enquiry, send email to <a href='mailto:support@icontestpro.com'>support@icontestpro.com</a><br><br>

                    To unsubscribe to this Vote Campaign, <a href='".base_url()."unsubscribe/voterscampaign/".$ids_hash_mem."/' target='_blank'>click here</a>

                    </p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "iContestPRO Contestants Votes";
                $from = "Voters Campaign <noReply@icontestpro.com>";
                $to = $con_email;
                $from_name = "Voters Campaign";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
            }*/

        }else{
            echo $txtmyvotes; // default votes
        }
    }



    function store_share_counts(){
        $contestid = $this->input->post('contestid');
        $memid = $this->input->post('memid');
        if($memid>0){

            $alreadyShared = $this->sql_models->alreadyShared($memid, $contestid); // already shared 3 times
            $alreadyShared1 = $this->sql_models->alreadyShared1($memid, $contestid); // already shared 3 times
            $checkShareExpiry = $this->sql_models->checkShareExpiry($memid);

            if($alreadyShared != ""){
                $timing2 = 0;
                $cnts = 1;
            }else{
                $timing2 = $alreadyShared1;
                if($alreadyShared1 > 0)
                    $cnts = 0;
                else
                    $cnts = 1;
            }

            $newdata3 = array(
                'memid'             => $memid,
                'contest_id'        => $contestid,
                'counts'            => $cnts,
                'normal_count'      => 1,
                'timings'           => $timing2
            );
            $timings1 = strtotime('+1 days', time());


            if($checkShareExpiry){ // if expired
                $this->db->set('timings', 0);
                $this->db->where('memid', $memid);
                $this->db->update('contest_share');   
            }

            if(!$alreadyShared){ // false
                $myCShares = $this->sql_models->myCShares($memid, $contestid);
                if($myCShares){
                    /*/ the reason why i made 2 counts and normal count was after odd counts, the real column "counts" stops updating in order to still maintain its odd counts to be able to update timings to 0 after every odd counts */
                    $this->db->set('counts', "counts+1", FALSE);
                    $this->db->where('memid', $memid)->where('contest_id', $contestid)->where('timings', 0);
                    $this->db->update('contest_share');

                    $this->db->set('normal_count', "normal_count+1", FALSE);
                    $this->db->where('memid', $memid)->where('contest_id', $contestid);
                    $this->db->update('contest_share');
                }else{
                    $this->db->insert('contest_share', $newdata3);
                }
            }else{ // if shared odd times, then update the timing

                $this->db->set('normal_count', "normal_count+1", FALSE);
                $this->db->where('memid', $memid)->where('contest_id', $contestid);
                $this->db->update('contest_share');

                $this->db->set('timings', $timings1);
                $this->db->where('memid', $memid)->where('timings', 0);
                $updated = $this->db->update('contest_share');

                $this->db->set('counts', "counts+1", FALSE);
                $this->db->where('memid', $memid)->where('contest_id', $contestid)->where('timings', 0);
                $this->db->update('contest_share');

                if($updated){
                    $this->db->set('vp', "vp+30", FALSE);
                    $this->db->where('id', $memid)->update('members');
                }
            }
        }
    }



    function agotime1($time) { 
        $timediff=time()-$time; 

        $days=intval($timediff/86400);
        // $remain=$timediff%86400;
        // $hours=intval($remain/3600);
        // $remain=$remain%3600;
        // $mins=intval($remain/60);
        // $secs=$remain%60;

        // if ($secs>=0) $timestring = "0m".$secs."s";
        // if ($mins>0) $timestring = $mins." min".$secs." sec";
        // if ($hours>0) $timestring = $hours." hrs".$mins." min";
        if ($days>0) $timestring = $days;

        return $timestring; 
    }

    


    function checkFreeVoteTiming(){
        $contestID = $this->input->post('contestID');
        $conte_id = $this->input->post('conte_id');
        
        $ua = $this->getBrowser();
        $usragn = strtolower($ua['userAgent']);
        preg_match('#\((.*?)\)#', $usragn, $match); // extract strings in brackets
        $vars = $match[1];
        
        if(strpos($vars, "build") !== false){
            $truncate_var = substr($vars, 0, strpos($vars, "build"));
        } else{
            $truncate_var = $vars;
        }
        $truncate_var1 = str_replace(" u;", "", trim($truncate_var));
        $ipaddrs = $truncate_var1;

        $chktime = $this->sql_models->freeVoteTiming($contestID, $conte_id, $ipaddrs);
        if($chktime !== false){
            echo $chktime;
        }else{
            echo "expired"; // 24 hrs has expired, vote again
        }
    }


    

    function checkVoteExpiry($contestids, $myid){
        //$ipaddrs = $_SERVER['REMOTE_ADDR'];
        $ua = $this->getBrowser();
        $usragn = strtolower($ua['userAgent']);
        preg_match('#\((.*?)\)#', $usragn, $match); // extract strings in brackets
        $vars = $match[1];
        //$vars = "linux; u; android 8.0.0; samsung sm-g4844u build/r16nw";
        //$vars = "linux; android 7.0; samsung sm-g4844u";
        if(strpos($vars, "build") !== false){
            $truncate_var = substr($vars, 0, strpos($vars, "build"));
        } else{
            $truncate_var = $vars;
        }
        $truncate_var1 = str_replace(" u;", "", trim($truncate_var));
        $ipaddrs = $truncate_var1;

        if($this->sql_models->freeVoteTiming($contestID, $conte_id, $ipaddrs)){
            echo "not_expired";
        }else{
            echo "expireds";
        }
    }




    public function contact(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Contact Us";
        $data['page_name'] = "contact";
        $data['page_header'] = "Contact <font>Us</font>";
        $data['datamsg'] = "Your message has been sent!";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function blog(){
        if($this->isCompatible()) redirect('compatibility');

        $txtsrch = $this->input->post('txtsrch');
        //$txtpre = $this->input->post('txtpre');
        $data['page_title'] = "Our Blog";
        $data['page_name'] = "blog";
        $data['page_header'] = "Our <font>Blog</font>";
        $data['datamsg'] = "";

        $record=0;
        $recordPerPage = 15;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countMyBlogs('', 'blogs');
        $recordCount1 = $this->sql_models->countMyBlogs1('', $txtsrch, 'blogs');
        $empRecord = $this->sql_models->fetchMyBlogs('', $txtsrch, $record, $recordPerPage, 'blogs', '');
        $config['base_url'] = base_url();

        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_blog" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////

        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        $data['recordCount'] = $recordCount;
        $data['recordCount1'] = $recordCount1;
        $data['record'] = $record+1;
        $data['recordPerPage'] = $recordPerPage;
        $data['blog1'] = $empRecord;

        $this->load->view("header", $data);
        $this->load->view("blog", $data);
        $this->load->view('footer', $data);
    }



    function more_blog($record=0){
        $txtsrch = $this->input->post('txtsrch');
        // $txtpre = $this->input->post('txtpre');
        // $cid1 = $this->input->post('cid1');
        $recordPerPage = 15;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }

        $recordCount = $this->sql_models->countMyBlogs('', 'blogs');
        $recordCount1 = $this->sql_models->countMyBlogs1('', $txtsrch, 'blogs');
        $empRecord = $this->sql_models->fetchMyBlogs('', $txtsrch, $record, $recordPerPage, 'blogs', '');
        $config['base_url'] = base_url().'node/more_blog';
        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;

            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 conts_pagn_blog" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
        ////////////////////

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        if($record<=0) $record=1;
        if($recordCount<$recordPerPage) $recordPerPage=$recordCount;

        if($empRecord){ ?>
            <div class="container mt--20 mb-30 mt-sm-20 mt-xs-0" style="color:#555 !important; font-size:16px; text-align:center;">Showing <?php echo "$record of $recordPerPage of $recordCount1";?> contests found</div>

            <?php
            $i = 1;
            foreach($empRecord as $post):
                $ids = $post['id'];
                $nows = substr(time(), -5);
                $ids_hash = $ids.$nows;
                $title = $post['titles'];
                $descrip = $post['contents'];
                $adv_title_f = cleanStr(strtolower($title));
                $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);

                if($files==""){
                    if(strlen($descrip)>300) $descrip = substr($descrip, 0, 300)."...";
                }else{
                    if(strlen($descrip)>100) $descrip = substr($descrip, 0, 100)."...";
                }

                $dates = @date("jS M, Y", strtotime($post['date_created']));
                $views = kilomega($post['views']);
                if($views>0) $views1 = "$views Views"; else $views1 = "$views View";

                $url2 = base_url()."$ids_hash/join/$adv_title_f/";
                $title_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $title);
                $title_1 = str_replace("&", "and", $title_1);

                $title = str_replace("'", "&prime;", $title);
                $descrips_whatsapp = "*".ucwords($title)."*";

                $descrips = "'".ucwords($title);
                $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";
            ?>
            <div class="col-lg-6 col-12 mb-30 pb-2">
                <div class="card blog blog2 rounded_ border-0 shadow overflow-hidden">
                    <div class="row align-items-center_ no-gutters">
                        <?php if($files!=""){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url()."cblogs/".$files?>" class="img-fluid card-img-top img-top1" alt="">
                            <div class="overlay bg-dark"></div>
                            <div class="author">
                                <small class="text-light user d-block"><i class="mdi mdi-account"></i> Calvin Carlo</small>
                                <small class="text-light date"><i class="mdi mdi-calendar-check"></i> <?=$dates?></small>
                            </div>
                        </div>
                        <?php } ?>

                        <?php
                        if($files=="")
                            echo '<div class="col-md-12">';
                        else
                            echo '<div class="col-md-6">';
                        ?>
                            <div class="card-body content">
                                <h5><a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="card-title title text-dark"><?=$title?></a></h5>
                                <p class="text-muted mb-0"><?=$descrip?></p>
                                <div class="post-meta d-flex justify-content-between mt-3">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                                    </ul>
                                    <a href="<?=base_url()?>blog/<?=$ids_hash?>/<?=$adv_title_f?>/" class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            endforeach;
        }
        ?>

        <div style="clear: both;"></div>
        <div class="mb-sm-30 mt-xs--20 mb-xs-30">
            <?php echo $pagination; ?>
        </div>

        <?php
    }




    public function single_blog(){
        if($this->isCompatible()) redirect('compatibility');
        $cid = $this->uri->segment(2);
        $cid1 = substr($cid, 0, -5);
        $blog_details = $this->sql_models->fetchBlogs('blogs', $cid1, 1);
        //print_r($blog_details); exit;
        if(!$blog_details) redirect('');

        $this->sql_models->updateViews1($cid1, 'blogs');

        $data['bdetls'] = $blog_details;
        $data['page_title'] = ucwords($blog_details['titles']);
        $data['page_name'] = "single_blog";
        $data['page_header'] = "";
        $data['contestids'] = $cid1;

        $blog_related = $this->sql_models->relatedBlogs($blog_details['titles'], $cid1);
        $data['relateds'] = $blog_related;

        
        $this->load->view("header", $data);
        $this->load->view("single_blog", $data);
        $this->load->view('footer', $data);
    }


    public function reset_password(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Reset Password";
        $data['page_name'] = "reset_password";
        $data['datamsg'] = "Your password has beed updated!";
        //$this->load->view("header", $data);
        $this->load->view("reset-password", $data);
        //$this->load->view('footer', $data);
    }
    

    public function get_rewarded__(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Claim VP Reward";
        $data['page_name'] = "get_rewarded";
        $data['raf_dtls'] = $this->sql_models->fetchRafflesDetls();
        $data['raf_wins'] = $this->sql_models->fetchRafflesWinners();
        $data['datamsg'] = "Wow! You have submitted your entries.";
        $data['datamsg1'] = "";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function get_rewarded_tests(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Claim VP Reward";
        $data['page_name'] = "get_rewarded_tests";
        $data['raf_dtls'] = $this->sql_models->fetchRafflesDetls();
        $data['raf_wins'] = $this->sql_models->fetchRafflesWinners();
        $data['datamsg'] = "Wow! You have submitted your entries.";
        $data['datamsg1'] = "";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function notifications(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Notification";
        $data['page_name'] = "notifications";
        $data['notify_msgs'] = $this->sql_models->fetchNotificatns('all_notifications', $this->myID);
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function how_it_works(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "How It Works";
        $data['page_name'] = "how-it-works";
        $data['page_header'] = "Contact <font>Us</font>";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function faqs(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "FAQs";
        $data['page_name'] = "faqs";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }

    
    public function sponsor_contest(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Sponsoring A Contest";
        $data['page_name'] = "sponsor_contest";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function advert_placements(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Advert Placements";
        $data['page_name'] = "advert_placements";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function privacy_policy(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Privacy & Policy";
        $data['page_name'] = "privacy_policy";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function terms_use(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Terms of Use";
        $data['page_name'] = "terms_use";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }

    

    public function winners(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Winners";
        $data['page_name'] = "winners";
        $data['contests'] = $this->sql_models->fetchRecs('contests', '', '', '', 12, 1);
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }



    function logmein_reset(){
        $this->form_validation->set_rules('txtcode1', 'code', 'required|trim');
        $this->form_validation->set_rules('txtrpass1', 'password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('txtrpass2', 'confirm password', 'required|trim|matches[txtrpass1]');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtrpass1 = $this->input->post('txtrpass1');
            $txtcode1 = $this->input->post('txtcode1');
            $txtpass = hash_password($txtrpass1);

            $return_email = $this->sql_models->check_existing_codes($txtcode1, 'email_verificatn');
            if($return_email){
                $updated = $this->sql_models->update_password1($txtrpass1, $return_email);

                if($updated){
                    $now = 2147483647 - time();
                    $cookie = array(
                        'name'   => 'icont_uname',
                        'value'  => sha1($return_email),
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
                    echo "success";
                }else{
                    echo "<p>Error in updating your password</p>";
                }
            }else{
                echo "<p>Wrong code entered, please check your email again.</p>";
            }
        }
    }



    function update_notificatn(){
        $this->sql_models->updateReads_notify(0, 'all_notifications');
    }


    function refresh_raffle(){
        $raf_dtls = $this->sql_models->fetchRafflesDetls();
        $raffle_numbers = $this->sql_models->fetchRaffles();
        $cnt_entries = $this->sql_models->fetchRaffleEntries('entrs');
        $cnt_remains = $this->sql_models->fetchRaffleEntries('rem');
        $myselecteds = $this->sql_models->showSelected($raffle_numbers[0]['reward_id'], '');
        $myselectedCnts = $this->sql_models->showSelected($raffle_numbers[0]['reward_id'], 'nums');

        $selected_count = $myselectedCnts;
        $selected_count1 = 4 - $selected_count;
        ?>
        
          <div class="container mb-sm--110">
            <div class="row align-items-center lottery_list">
              <div class="col-lg-6 col-md-7 col-sm-7 p-md-0">
                <div class="jackpot-board pt-sm-20 pb-sm-20 pl-sm-10 pr-sm-10">
                  <?php if($raffle_numbers){ ?>
                      <ul class="lottery-number-list hide_last">
                    
                        <?php
                          foreach ($raffle_numbers as $rs) {
                            $id1 = $rs['id1'];
                            $reward_id = $rs['reward_id'];
                            $mynumbers = $rs['mynumbers'];
                            $selecteds = $rs['selecteds'];
                            if($selecteds>0){
                              echo "<span id1='$id1' reward_id='$reward_id' class='active'>$mynumbers</span>";
                            }else{
                                echo '<audio id="bflat"> </audio>';
                              echo "<li id1='$id1' reward_id='$reward_id' mynumbers='$mynumbers' id='select_raffle'>$mynumbers</li>";
                            }
                          }

                          echo '<li><form method="post" autocomplete="off" class="frm_picked_nos">';

                          if($myselecteds){
                            $i=1;
                            foreach ($myselecteds as $rs) {
                              $mynumbers = $rs['mynumbers'];
                              //echo "<fonts class='pks'>$mynumbers</fonts>";
                              echo '<input type="hidden" id="txtpick1_" name="txtpick1_" value="'.$mynumbers.'">';
                              $i++;
                            }

                            for ($k=$selected_count+1; $k <= 4; $k++) { 
                              //echo '<li class="pk pick$k">?</li>';
                              echo '<input type="hidden" id="txtpick'.$k.'" name="txtpick'.$k.'">';
                            }
                          }else{
                            echo '<input type="hidden" id="txtpick1" name="txtpick1">
                              <input type="hidden" id="txtpick2" name="txtpick2">
                              <input type="hidden" id="txtpick3" name="txtpick3">
                              <input type="hidden" id="txtpick4" name="txtpick4">';
                          }
                              
                          echo '<input type="hidden" id="txtvp_disburse" name="txtvp_disburse">
                                <input type="hidden" id="txtrwd" name="txtrwd">
                              </form></li>';
                        ?>
                      </ul>
                  <?php } ?>
                </div>
              </div>

              <div class="col-lg-6 col-md-5 col-sm-5 p-sm-0 mt-20 mt-sm-0 p-md-0 pl-sm-20 p-xs-0">
                <div class="jackpot-content p-sm-10 p-xs-5">
                  <h2 class="title" style="margin-bottom: 10px;">How To Play</h2>
                  <p>1. Very simple! Pick any number</p>
                  <p>2. Each number has a 6-digit random numbers</p>
                  <p>3. If it matches with any of the numbers on the items above, then you win!</p>
                  <p>4. You can only pick a maximum of 4 lucky numbers.</p>
                  <p>5. Each number you pick is equal to 50VP</p>
                  <p>6. Good luck to you!</p>

                  <div class="mt-30 mb-20">
                    <p><span class="colors">&nbsp;</span> means your selection</p>
                    <p><span class="colors colors1">&nbsp;</span> means already picked</p>
                  </div>

                  <p style="margin: 0" class="price">Entries: <span><?=$cnt_entries?></span></p>
                  <p style="margin: 0" class="price">Numbers left: <span><?=$cnt_remains?></span></p>
                  <p style="margin: 0" class="price">VP Selected: <span class="totalvp">0</span></p>
                  <p style="margin: 15px 0 20px 0 !important" class="price"><font style="color: #069 !important">Your VP:</font> <span class="myVP_now"><?=@number_format($this->vps)?></span></p>
                  <!-- <p class="date">Monday 18th February 2019</p> -->
                  <input type="hidden" value="<?=$this->vps?>" id="txtvps">

                  
                  <input type="hidden" value="<?=$selected_count1?>" id="txt_already_selected">
                  <input type="text" value="0" id="txt_totalvp" style="display: none;">
                  

                  <div class="jackpot-guess-wrapper p-xs-0">
                    <ul class="lottery-number-list">
                      <?php
                      if($myselecteds){
                        $i=1;
                        foreach ($myselecteds as $rs) {
                          $mynumbers = $rs['mynumbers'];
                          echo "<fonts class='pks'>$mynumbers</fonts>";
                          $i++;
                        }

                        //for ($k=0; $k < $selected_count1; $k++) { 
                        for ($k=$selected_count+1; $k <= 4; $k++) { 
                          echo '<li class="pk pick'.$k.'">?</li>';
                        }
                      }else{
                        echo '<li class="pk pick1">?</li>
                        <li class="pk pick2">?</li>
                        <li class="pk pick3">?</li>
                        <li class="pk pick4">?</li>';
                      }
                      ?>
                    </ul>
                    
                  </div>
                  

                    <div class="fst_btn mb-40 mr-xs-15">
                      <div class="row mybtns mt-30 mt-xs-0">
                        <div class="next-draw-btn1 col-md-offset-0 col-md-12 pl-md-0_">
                          <a href="javascript:;" class="cmn-btn btn-md cmd_clicks" style="display: none;">clickme</a>
                          <a href="javascript:;" class="cmn-btn btn-md cmd_proceed">Buy With VP</a>
                        </div>
                      </div>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="sec_btn" style="text-align: center; display: none;">
                      <div class="row_ mybtns mybtns_confirm mt-30 mr-xs-20">
                        <p style="font-size: 18px; margin-bottom: 6px; color: #333; line-height: 24px;"><fonts class="totalvp">0</fonts>VP will be deducted from your wallet</p>
                        <p style="font-size: 16px; margin-bottom: 20px; color: #444; line-height: 24px;">Proceed to buy these raffle tickets?</p>

                        <a href="javascript:;" class="cmn-btn btn-md cmd_buynow">YES</a>
                        <a href="javascript:;" class="cmn-btn btn-md cmd_buynow1" style="display: none; opacity: 0.5">Buy With VP</a>
                        <a href="javascript:;" class="cmn-btn btn-md cmd_nobuy ml-10">NO</a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>


          <script src="<?=base_url()?>assets_game/js/jquery-3.3.1.min.js"></script>
          <script src="<?=base_url()?>assets_game/js/jquery.countup.min.js"></script>
          <script src="<?=base_url()?>assets_game/js/slick.min.js"></script>
          <script src="<?=base_url()?>assets_game/js/jquery.countdown.js"></script>
          <script src="<?=base_url()?>assets_game/js/main.js"></script>


        <script type="text/javascript">
            
            $('body').on('click', '.lottery_list li', function(e) {
                $(".cmd_clicks, .cmd_nobuy").click();
            });

  
            $('body').on('click', '.cmd_clicks', function(e) {
                // when u have selected and submitted and u want to select again, it shud bring the ones u selected
                var already_selected = $("#txt_already_selected").val(); 
                var j = 5 - parseInt(already_selected);
                var sums=0;
                var validatns = false;
                var txtvps = $("#txtvps").val();

                $('.totalvp').html(0);
                $('#txt_totalvp').val(0);

                for ( var i = already_selected; i <= 4; i++) {
                  $('.lottery_list li input#txtpick'+i).val('');
                  $('.pick'+i).html('?');
                }

                $('.lottery_list li').each(function(index,element){

                  if(j>5){
                    alert("Maximum of 4 to be selected!");
                    
                    for ( var i = already_selected; i <= 4; i++) {
                      if(already_selected < 4){
                          $('.lottery_list li input#txtpick'+i).val('');
                          $('.pick'+i).html('?');
                      }else{
                        $('.lottery_list li input').val('');
                        $('.pk').html('?');
                      }
                    }
                    
                    $(".lottery-number-list li").removeClass("selected");
                    $('.totalvp').html(0);
                    $('#txt_totalvp').val(0);
                    validatns = false;
                    return false;

                  }else{

                    if($(this).attr("class")=="selected"){
                      $('input[id=txtpick'+j+']').val($(this).attr("mynumbers"));
                      $('.pick'+j).html($(this).attr("mynumbers"));
                      $('#txtrwd').val($(this).attr('reward_id'));
                      sums=sums+50;
                      j++;
                      validatns = true;
                    }

                    if(txtvps < sums){
                      alert('Cannot proceed, You have insufficient VP');
                      /*$('.totalvp').html(0);
                      $('#txt_totalvp').val(0);
                      //$(".lottery_list li input").val('');
                      for ( var i = already_selected; i <= 4; i++) {
                        $('.lottery_list li input#txtpick'+i).val('');
                        $('.pick'+i).html('?');
                      }
                      $(".lottery-number-list li").removeClass("selected");
                      validatns = false;
                      return false;*/

                      for ( var i = already_selected; i <= 4; i++) {
                        if(already_selected < 4){
                            $('.lottery_list li input#txtpick'+i).val('');
                            $('.pick'+i).html('?');
                          }else{
                            $('.lottery_list li input').val('');
                            $('.pk').html('?');
                          }
                        }
                        
                        $(".lottery-number-list li").removeClass("selected");
                        $('.totalvp').html(0);
                        $('#txt_totalvp').val(0);
                        validatns = false;
                        return false;

                    }else{
                      $('.totalvp').html(sums);
                      $('#txtvp_disburse, #txt_totalvp').val(sums);
                    }
                  }
                });
            });


            $('body').on('click', '.cmd_nobuy', function(e) {
                $('.sec_btn').hide();
                $('.fst_btn').fadeIn('fast');
            });


            $('body').on('click', '.cmd_proceed', function(e) {
                var txt_totalvp = $("#txt_totalvp").val();
                if(txt_totalvp <= 0){
                  alert('Please select the random numbers');
                  $('.cmd_buynow1').hide();
                  $('.cmd_buynow').fadeIn('fast');
                  return false;
                }

              $('.fst_btn').hide();
              $('.sec_btn').fadeIn('fast');
                
            });



            $('body').on('click', '.cmd_buynow', function(e) {
                if($("#txtpick1").val()==""){
                  alert('Please select the random numbers');
                  $('.cmd_buynow1').hide();
                  $('.cmd_buynow').fadeIn('fast');
                  return false;
                }else{
                  $.ajax({
                    type : "POST",
                    url : site_urls+"node/submit_my_raffle",
                    data: $(".frm_picked_nos").serialize(),

                    success : function(data){
                      //if(data>){
                        $(".frm_picked_nos")[0].reset();
                        $('.btn_sweet_art_pv').click();
                        $(".cmd_nobuy").click();

                        $.ajax({
                          type : "POST",
                          url : site_urls+"node/refresh_raffle",
                          success : function(data){
                            $('.raffleDiv').html(data);
                          }
                        });

                      //}
                    },error : function(data){
                        $('.cmd_buynow1').hide();
                        $('.cmd_buynow').fadeIn('fast');
                      }
                  });
                }
            });
        </script>
      <?php
    }



    public function entries(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Entries";
        $data['page_name'] = "entries";
        $data['page_header'] = "";

        $txtsrch = $this->input->post('txtsrch');
        $txtpre = $this->input->post('txtpre');

        $record=0;
        $recordPerPage = 15;
        //$recordPerPage = 2;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }
        $recordCount = $this->sql_models->countProducts("", 'entries');
        $recordCount1 = $this->sql_models->countProducts1("", $txtsrch, $txtpre, 'entries');
        $data['recordPerPage'] = $recordPerPage;
        $data['record'] = 1;
        $data['recordCount1'] = $recordCount1;
        $empRecord = $this->sql_models->fetchProducts("", $txtsrch, $txtpre, $record, $recordPerPage, 'entries', '');
        $config['base_url'] = base_url();
        $data['contests'] = $this->sql_models->fetchRecs('contests', '', '', '', 15, "");
        
        ////////////////////
            $config["total_rows"] = $recordCount1;
            $config["per_page"] = $recordPerPage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 2;
            
            $config['first_link'] = FALSE;
            $config['first_tag_open'] = FALSE;
            $config['first_tag_close'] = FALSE;
            
            $config['last_link'] = FALSE;
            $config['last_tag_open'] = FALSE;
            $config['last_tag_close'] = FALSE;


            $config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 mt-sm-0 mb-xs-30 conts_pagn" id="pagination1">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            
            $config['next_link'] = 'Next <i class="fa fa-chevron-right"></i></a>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Prev';
            
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        ////////////////////

        if($recordCount1<$recordPerPage) $recordPerPage=$recordCount1;
        $data['recordPerPage'] = $recordPerPage;
        $data['record'] = 1;
        $data['recordCount1'] = $recordCount1;
        
        $data['products'] = $empRecord;
        //$data['cdetls'] = $contest_details;
        $this->load->view("header", $data);
        $this->load->view("contestants", $data);
        $this->load->view('footer', $data);
    }



    public function register(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Register";
        $data['page_name'] = "register";
        $data['states1'] = $this->sql_models->fetchStates();
        //$data['datamsg'] = "Your login was successful";

        //$this->load->view("header", $data);
        $this->load->view("register", $data);
        //$this->load->view('footer', $data);
    }



    function approve_querys(){
        $ids = $this->input->post('ids');
        $colums = $this->input->post('colums');
        $tbls = $this->input->post('tbls');
        $duratn = $this->input->post('duratn');
        $aparams = $this->input->post('aparams');
        $approve_it = $this->sql_models->approveQrys($ids, $colums, $tbls, $duratn, $aparams);
        if($approve_it){
            echo "updated";
        }
    }




    function send_contact_msg(){
        $this->form_validation->set_rules('txtname', 'Names', 'required|trim|alpha_space|max_length[30]');
        $this->form_validation->set_rules('txtemail', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('txtphone', 'Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('txtmessage', 'Message', 'required|trim');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            
            $txtname = $this->input->post('txtname');
            $txtemail = $this->input->post('txtemail');
            $txtphone = $this->input->post('txtphone');
            $txtmessage = $this->input->post('txtmessage');

            $txtemail = strtolower($txtemail);
            $my_name = ucwords($txtname);

            //////////////////FOR EMAILS/////////////////////////
                $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello Admin,</b></p>";
                $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                You have a message from $my_name sent from iContestPRO contact form.</p>";

                $message_contents .= "<p style='margin:0px 0 20px 0'>
                <b>Phone:</b> $txtphone<br>
                <b>Email:</b> $txtemail<br>
                <b>Message</b><br>$txtmessage</p>";
            //////////////////FOR EMAILS///////////////////////// 

            $subj = "New Message From $my_name";
            $from = "$my_name <noReply@icontestpro.com>";
            $to = "icontestprobox@gmail.com";
            $from_name = "Support Team @ iContestPRO";

            $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
            $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
            echo "msg_sent";
        }
    }



    function send_chat_msg(){
        $this->form_validation->set_rules('txtchat_msg', 'Message', 'required|trim|min_length[20]');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            
            $txtconid = $this->input->post('txtconid');
            $txtmessage = $this->input->post('txtchat_msg');
            $txtsponid = $this->input->post('txtsponid');
            $getSponDetls = $this->sql_models->getDetails($txtsponid);
            $getSponEmail = strtolower($getSponDetls['emails']);
            $getSponName = ucwords($getSponDetls['names']);
            $getSponNick = ucwords($getSponDetls['nickname']);
            if(strlen($getSponName)<=2) $getSponName = ucwords($getSponNick);

            //////////////////FOR EMAILS/////////////////////////
                $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $getSponName,</b></p>";
                $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                You have a message from $this->myfullname sent from your contest chat box.</p>";

                $message_contents .= "<p style='margin:0px 0 20px 0; font-size: 15px; line-height: 20px;'>
                <b>Message</b><br>$txtmessage</p>";
            //////////////////FOR EMAILS///////////////////////// 

            $subj = "New Chat Message From $this->myfullname";
            //$from = "$this->myfullname <$this->mymail>";
            $from = "$this->myfullname <noReply@icontestpro.com>";
            $to = $getSponEmail;
            $from_name = "iContestPRO Quick Chat";

            $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
            $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
            echo "msg_sent";
        }
    }



    function display_cities(){
        $state_id = $this->input->post('state_id');
        $this->db->select('*')->from('local_governments')->where('state_id', $state_id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $fetch_data = $query->result_array();
            echo '<option value="" selected>-Select City-</option>';
            foreach($fetch_data as $row)
            {
                $ids1 = $row['id'];
                $cities = ucwords($row['name']);
                echo "<option value='$ids1' citys='$cities'>$cities</option>";
            }
        }else{
            echo "";
        }
    }

    

    public function contest_leaderboard(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Contest Leaderboard";
        $data['page_name'] = "contest_leaderboard";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function voters_leaderboard(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Voters Leaderboard";
        $data['page_name'] = "voters_leaderboard";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    public function entries_leaderboard(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "Entries Leaderboard";
        $data['page_name'] = "entries_leaderboard";
        $get_ent = $this->uri->segment(1);
        $data['get_ent1'] = substr($get_ent, 0, -5);
        $data['contestids'] = substr($get_ent, 0, -5);
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }


    
    function delete_images(){
        $ids = $this->input->post('ids');
        $files = $this->input->post('files');
        $tbl = $this->input->post('tbl');
        $folders = $this->input->post('folders');
        
        $this->db->select('id')->from($tbl)->where('md5(id)', $ids);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            
            $in_folder1="$folders/".$files; // delete the image in the fake folder
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->set('files', '');
            $this->db->where('md5(id)', $ids);
            $query = $this->db->update($tbl);

            echo "deleted";

        }else{
            echo "error";
        }
    }



    function submit_my_raffle(){
        $txtpick1 = $this->input->post('txtpick1');
        $txtpick2 = $this->input->post('txtpick2');
        $txtpick3 = $this->input->post('txtpick3');
        $txtpick4 = $this->input->post('txtpick4');
        $txtrwd = $this->input->post('txtrwd');
        $txtvp_disburse = $this->input->post('txtvp_disburse');

        $query = $this->sql_models->updateRaffle($txtpick1, $txtpick2, $txtpick3, $txtpick4, $txtrwd, $txtvp_disburse);
        echo $query;
    }




    public function about(){
        if($this->isCompatible()) redirect('compatibility');
        $data['page_title'] = "About Us";
        $data['page_name'] = "about";
        $this->load->view("header", $data);
        $this->load->view("pages", $data);
        $this->load->view('footer', $data);
    }



    public function ref(){
        $get_userid = $this->uri->segment(2); // 6 digits // 234567
        $get_userid1 = substr($get_userid, 0, -5);
        $is_user_id = $this->sql_models->isUserId($get_userid1);
        if($is_user_id){
            $now = 865000;
            $cookie = array(
                'name'   => 'store_userid_icon',
                'value'  => $get_userid1,
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            redirect('register'); // store user id in cookies and go to home page to signup
        }
        redirect('error404');
    }



    function display_states(){
        $country_id = $this->input->post('country_id');
        $this->db->select('*')->from('states')->where('country_id', $country_id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $fetch_data = $query->result_array();
            echo '<option value="" selected>-Select State-</option>';
            foreach($fetch_data as $row)
            {
                $ids1 = $row['id'];
                $states = ucwords($row['name']);
                echo "<option value='$ids1' states='$states'>$states</option>";
            }
        }else{
            echo "";
        }
    }



    function output_fee(){
        $txtsize = $this->input->post('txtsize');
        $txtdurs = $this->input->post('txtdurs');
        $amts = $this->sql_models->chkCals($txtsize, $txtdurs);
        if($amts>0)
            $amts1 = "&#8358;".number_format($amts);
        else
            $amts1 = "&#8358;0.00";
        $arrs = array('converted' => $amts1, 'not_converted'=>$amts);
        echo json_encode($arrs);
    }



    function signup1(){
        $this->form_validation->set_rules('txtnick', 'Username', 'required|trim|min_length[5]|max_length[15]|alpha_numeric|is_unique[members.nickname]');
        $this->form_validation->set_rules('txtphone', 'Phone Number', 'required|trim|numeric|regex_match[/^[0-9\+]{6,11}$/]|is_unique[members.phone]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[members.emails]|valid_email');
        $this->form_validation->set_rules('txtpass', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('txtsum1', 'correct', 'trim');
        $this->form_validation->set_rules('txtmaths', 'Code', 'required|trim|matches[txtsum1]');
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'');
        }else{

            $txtnick = $this->input->post('txtnick');
            $txtphone = $this->input->post('txtphone');
            $email = cleanStrInputs(strtolower($this->input->post('email')));
            $txtpass = hash_password($this->input->post('txtpass'));
            $store_userid = $this->input->cookie('store_userid_icon', TRUE); // referral id

            if($this->sql_models->checkReservedWords($txtnick, "")){
                $arrs = array('type' => 'error', 'msg'=>'Error! Cannot use this name!', 'msg1'=>'');
            }else{
            
                $newdata2 = array(
                    'mem_type'      => "mem",
                    'nickname'      => $txtnick,
                    'emails'        => $email,
                    'phone'         => $txtphone,
                    'pass1'         => $txtpass,
                    'date_created'  => date("Y-m-d g:i a", time())
                );

                //$newdata2 = $this->security->xss_clean($newdata2);
                $memids = $this->sql_models->update_inserts_recs($newdata2, '', 'members');
                if(!$memids)
                    $arrs = array('type' => 'error', 'msg'=>'Error in network connection!', 'msg1'=>'');
                else{


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

                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Dear ".ucwords($txtnick).",</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
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
                        <b>Read here:</b> <a href='".base_url()."privacy-policy/'>Privacy Policy</a><br><br>

                        For help and support, contact admin at <a href='mailto:icontestprobox@gmail.com'>icontestprobox@gmail.com</a><br><br>

                        Thank you!<br>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = ucwords($txtnick).", Welcome to iContestPRO";
                    $from = "iContestPRO <noReply@icontestpro.com>";
                    $to = $email;
                    $from_name = "iContestPRO Account Activation";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                    $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
                    $retain_page_name = $this->input->cookie('retain_page_name', TRUE);
                    $arrs = array('type'=>'success', 'msg'=>$retain_page_id1, 'msg1'=>$retain_page_name);
                }
            }

        }
        echo json_encode($arrs);
    }



    function submit_comment(){
        if($this->myID==""){
            echo "Please <a href='javascript:;' class='loginto_comment' style='color:#06C'>login</a> to comment.";
            exit;
        }
        $this->form_validation->set_rules('txtcomment_msg', 'Message', 'required|trim');

        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{

            $txtcomment_msg = $this->input->post('txtcomment_msg');
            $txtcontID = $this->input->post('txtcontID');
            $txtrepID = $this->input->post('txtrepID');
            $edit_ids = $this->input->post('edit_ids');
            $txtpgs = $this->input->post('txtpgs');
            $url_params = $this->input->post('txt_url_params');
            $txt_url_params_ID = $this->input->post('txt_url_params_ID');

            $data0 = array();
            $data1 = array();
            $data2 = array();

            if($txtrepID!=""){
                $data1 = array(
                    'comments_id'   => $txtrepID
                );
            }

            if($txtpgs=="blog"){
                $data0 = array(
                    'blog_id'    => $txtcontID,
                );
            }else{
                $data0 = array(
                    'contest_id'    => $txtcontID,
                );
            }

            if($edit_ids==""){
                $data2 = array(
                    'memid'         => $this->myID,
                    'messages'      => $txtcomment_msg,
                    'date_created'  => date("Y-m-d g:i a", time())
                );
            }else{
                $data2 = array(
                    'messages'      => $txtcomment_msg
                );
            }

            $newdata2 = array_merge($data0, $data1, $data2);

            if($txtrepID==""){
                if($txtpgs=="blog")
                    $memids = $this->sql_models->update_inserts_recs($newdata2, $edit_ids, 'comments_blogs');
                else
                    $memids = $this->sql_models->update_inserts_recs($newdata2, $edit_ids, 'comments');
            }else{
                $memids = $this->sql_models->update_inserts_recs($newdata2, $edit_ids, 'replies');
            }

            if(!$memids)
                echo "Error in network connection!";
            else{
                //////notify the person script//////
                    if($txtpgs=="contest"){
                        $contestDetails = $this->sql_models->getContestDetails($txtcontID);
                        
                        $user_id_spon = $contestDetails['user_id'];
                        if($user_id_spon != $this->myID){
                            $getCmtFollowers = $this->sql_models->getCmtFollowers('comments', $this->myID, $txtcontID, '', 'memid');

                            $this->sql_models->countAllNotiAndDelete();

                            $datas = array(
                                'memid'             => $this->myID,
                                'user_id'           => $user_id_spon,
                                'what_page'         => $url_params,
                                'page_id'           => $txt_url_params_ID,
                                'has_read'          => 0,
                                'actns'             => "commented on",
                                'date_created'      => date("Y-m-d g:i a", time())
                            );
                            $this->db->insert('all_notifications', $datas);

                            if($getCmtFollowers){
                                foreach ($getCmtFollowers as $rs) {
                                    $memid2 = $rs['memid'];
                                    //dont include the sponsor and my id again
                                    if($user_id_spon != $this->myID && $memid2 != $this->myID){
                                        $checkDuplicate = $this->sql_models->checkDuplicate('all_notifications', $this->myID, $memid2, $txt_url_params_ID);

                                        if(!$checkDuplicate){
                                            $this->sql_models->countAllNotiAndDelete();

                                            $datas1 = array(
                                                'memid'             => $this->myID,
                                                'user_id'           => $memid2,
                                                'what_page'         => $url_params,
                                                'page_id'           => $txt_url_params_ID,
                                                'has_read'          => 0,
                                                'actns'             => "dropped a comment you are following on",
                                                'date_created'      => date("Y-m-d g:i a", time())
                                            );
                                            $this->db->insert('all_notifications', $datas1);
                                        }
                                    }
                                }
                            }
                        }
                    }
                //////notify the person script//////

                echo "success";
            }
        }
    }



    function fetchWinners(){
        $ids = $this->input->post('ids');
        $titles = strtolower($this->input->post('titles'));
        $prizeCounts = $this->sql_models->prizeCounts($ids);
        $mywinners = $this->sql_models->fetchWinners1($ids, $prizeCounts);

        if($mywinners){ ?>
            <div class="masonry-grid mt-10 pr-40 pl-xs-10 pr-xs-10">
                <h6 class="mt-20 mb-40 m-sm--30 mt-xs-10" style="font-size: 22px; color: #09C; line-height: 26px !important; text-transform: capitalize;"><?=$titles?> Winners</h6>
                <?php
                $j=1;
                foreach ($mywinners as $rs) {
                    $id = $rs['id1'];
                    $names = ucwords(strtolower($rs['names']));
                    $nickname = ucwords(strtolower($rs['nickname']));
                    $names1 = strtolower($names);
                    if(strlen($names1)<=2) $names1 = strtolower($nickname);
                    if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
                    $names1 = str_replace(" ", "-", $names1);
                    $pics = $rs['pics'];
                    $citys = $rs['citys1'];
                    $states = $rs['states1'];
                    $memid = $rs['contestant_id'];
                    $positns = $rs['positns'];
                    $contest_ids = $rs['contest_id'];
                    $nows = substr(time(), -5);
                    $memid_hash = $memid.$nows;

                    $votes = $this->sql_models->noOfRecs($memid, $contest_ids, 'votes');
                    $views = $this->sql_models->noOfRecs($memid, $contest_ids, 'views');

                    $views2 = kilomega($rs['views2']);
                    $locs = "$citys, $states";
                    $locs_full = $locs;

                    $price1 = @number_format($rs['price1']);
                    $price2 = @number_format($rs['price2']);
                    $price3 = @number_format($rs['price3']);
                    $price4 = @number_format($rs['price4']);
                    $price5 = @number_format($rs['price5']);

                    $add_price1 = ucwords($rs['add_price1']);
                    $add_price2 = ucwords($rs['add_price2']);
                    $add_price3 = ucwords($rs['add_price3']);
                    $add_price4 = ucwords($rs['add_price4']);
                    $add_price5 = ucwords($rs['add_price5']);

                    if($price1=="") $price1=0;
                    if($price2=="") $price2=0;
                    if($price3=="") $price3=0;
                    if($price4=="") $price4=0;
                    if($price5=="") $price5=0;

                    $ops="";
                    if($price1!="") $ops = "<span>+</span>";
                    if($price2!="") $ops = "<span>+</span>";
                    if($price3!="") $ops = "<span>+</span>";
                    if($price4!="") $ops = "<span>+</span>";
                    if($price5!="") $ops = "<span>+</span>";

                    if($add_price1!="") $add_price1="$ops $add_price1";
                    if($add_price2!="") $add_price2="$ops $add_price2";
                    if($add_price3!="") $add_price3="$ops $add_price3";
                    if($add_price4!="") $add_price4="$ops $add_price4";
                    if($add_price5!="") $add_price5="$ops $add_price5";
                    
                    
                    $pic_pathi = base_url()."profiles1/$pics";
                    if($views2>0) $views1 = "<b>Profile Views:</b> $views2"; else $views1 = "<b>Profile Views:</b> $views2";

                    $mylikes = $this->sql_models->getLikes($contest_ids, $memid);
                    $mylikes1 = @number_format($mylikes);

                    $hasliked = $this->sql_models->hasliked($contest_ids, $memid, $this->myID);
                    $paint_hrt="";
                    if($hasliked==0) $paint_hrt = "-outline";

                    $views_likes = "<a href='javascript:void(0)' style='color:#DD6F00' class='like like_me like_me1$j' autonum='$j' contestant_id='$memid' con_id='$contest_ids' hasliked='$hasliked' mylikes='$mylikes' liker_id='$this->myID'><i class='mdi mdi-heart$paint_hrt mr-2'></i><font>$mylikes1</font></a>";

                    $gen_num1=time();
                    $gen_num1=substr($gen_num1,5);

                    if($positns==1) $posn="st";
                    else if($positns==2) $posn="nd";
                    else if($positns==3) $posn="rd";
                    else $posn="th";

                    $url2 = base_url()."profile/$memid_hash/$names1/";
                    $names_1 = str_replace(array("/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $names);
                    $names_1 = str_replace("&", "and", $names_1);

                    $titles3 = str_replace("&", "and", $titles);

                    $descrips_whatsapp = "Hi dear, I'm *$names_1 @ iContestPRO*, I would like to plead for your support by voting for me on *'$titles3'*, thank you in advance.";

                    $descrips = "Hi dear, I'm $names_1 at iContestPRO, please vote for me on '$titles3', thank you in advance.";

                    $sTitle_whatsapp = $descrips_whatsapp."%0A%0A$url2";

                    $mychats1 = "";
                    if($this->myID==$memid){
                        $mychats1 = $this->sql_models->noOfChats($this->myID);
                        if($mychats1<=0) $mychats1="";
                    }
                ?>

                        <!-- <div class="col-lg-6 col-md-6 grid-container mb-sm-40 mb-40 p-sm-0"> -->
                        <div class="grid-container grid-container1 col-md-6 p-xs-0 mb-xs-30">
                            <div class="grid-img grid-img1" id1="<?=$id?>">
                                <!-- <div class="chatWithMe" id="chatWithMe<?=$id?>" id1="<?=$id?>">
                                    <a href="#chatmeup" class="video-play-icon" hisname="<?=$nickname?>" con_id="<?=$contest_ids?>" memid="<?=$memid?>" myid="<?=$this->myID?>" pics="<?=$pics?>"><i class="fa fa-comments"></i><?=$mychats1?></a>
                                </div> -->

                                <div class="share_profile" id="share_profile<?=$id?>" id1="<?=$id?>">

                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url2?>" target="_blank"><span><i class="fa fa-facebook-f"></i></span></a>
                                                
                                    <a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" class="for_desktop1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>
                                    
                                    <a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" class="for_mobile1" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a>

                                    <a href="https://twitter.com/share?text=<?=$descrips?>&url=<?=$url2?>" target="_blank"><span><i class="fa fa-twitter"></i></span></a>
                                </div>

                                <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/" class="gallery_ _link">
                                    <div class="winner_positn"><?=$j?><sup><?=$posn?></sup></div>
                                    <img src="<?=$pic_pathi?>" alt="" />
                                </a>
                                <div class="mygift">
                                    <p>
                                        <?php
                                        if($j==1)
                                            echo "<span1>&#8358;$price1</span1><br>$add_price1";
                                        else if($j==2)
                                            echo "<span1>&#8358;$price2</span1><br>$add_price2";
                                        else if($j==3)
                                            echo "<span1>&#8358;$price3</span1><br>$add_price3";
                                        else if($j==4)
                                            echo "<span1>&#8358;$price4</span1><br>$add_price4";
                                        else if($j==5)
                                            echo "<span1>&#8358;$price5</span1><br>$add_price5";
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="grid-content grid-content1 grid_color_">
                                <h5><?=$nickname?></h5>
                                <p style="margin: -14px 0 0 0 !important">
                                    <font class="for_desktop2"><b>From:</b> <?=$locs?></font>
                                    <font class="for_mobile2"><b>From:</b> <?=$locs_full?></font>
                                    <b>Votes:</b> <font class="vote_counts<?=$contest_ids.$memid;?>"><?=@number_format($votes);?></font><br>
                                    <?=$views1;?><br>
                                    <?=$views_likes?>
                                </p>
                            </div>

                            <div>
                                <a class="arrow-button arrow-button1" href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/">View Profile</a>
                            </div>
                        </div>                
                
                <?php
                $j++;
                }
            echo "</div>";
        }else{
            echo "<p style='text-align:center; font-size:18px; margin:2em 0 3em 0'>No winners on this contest yet!</p>";
        }

        echo '<div class="back_to_winners mt-10 p-15" style="border-radius:5em;">
            <i class="fa fa-caret-left"></i> GO BACK
        </div>';
    }


    function getAllChats(){
        $herid = $this->input->post('herid');
        $myid = $this->input->post('myid');
        $this->getAllChatsFunction($myid, $herid);
    }


    function getAllComments(){
        $myid = $this->input->post('myid');
        $con_id = $this->input->post('con_id');
        $herid = $this->input->post('herid');
        $this->getAllCmtsFunction($myid, $con_id, $herid);
    }


    function getAllComments1(){
        $this->getAllCmtsFunction($myid, $con_id, $herid);
    }



    function getAllChats1($myid, $herid){
        $this->getAllChatsFunction($myid, $herid);
    }



    function getAllChatsFunction($myid, $herid){
        //$fetchMyChats = $this->sql_models->fetchMyChats($herid);
        $fetchMyChats = $this->sql_models->fetchMyChats($myid, $herid);
        ///update status as read
        $this->sql_models->updateChatRead($myid, $herid);

        if($this->myID != $herid){
            echo "<div class='chat_menu menu_icn_head'><i class='fa fa-ellipsis-h'></i></div>";
            ?>
            <div class="edit_div_head" id="edit_div_head">
                <?php
                $whoBlocked = $this->sql_models->whoBlocked($herid, $myid);
                $block_caption = "Block this user";
                if($whoBlocked)
                    $block_caption = "Unblock user";
                ?>
                <span style='border:none; color:red; cursor:pointer' id='blockuser' ids="<?=$this->myID;?>" class="blockuser<?=$this->myID;?>" block_caption="<?=$block_caption?>"><a href='javascript:;' style='color:red;' block_caption="<?=$block_caption?>"><?=$block_caption?> &raquo;</a></span>
            </div>
        <?php
        }
        ?>

        <?php
        echo '<div class="row">
            <div class="over_flow">';

        if($fetchMyChats){
            foreach ($fetchMyChats as $rs) {
                $id1 = $rs['id1'];
                $pics = $rs['pics'];
                $chtmemid = $rs['memid'];
                $recipient_id = $rs['recipient_id'];

                $getDetls = $this->sql_models->getDetails($chtmemid);
                $chtnickname = $getDetls['names'];
                $pics = $getDetls['pics'];
                if(strlen($chtnickname)<=2){
                    $chtnickname = $getDetls['nickname'];
                }
                $messages = ucfirst($rs['messages']);
                $date_created = $rs['date_created'];

                $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                $online_time = time_ago($online_timing);

                $pic_path2 = base_url()."profiles1/$pics";
                $width1=""; $width2="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width1=="" || $width1<=0)
                    $pic_path2 = base_url()."profiles/$pics";

                list($width2, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width2=="" || $width2<=0)
                    $pic_path2 = base_url()."images/no_passport.jpg";

                $chat_partner="";
                if($chtmemid==$this->myID){
                    $pic_path2 = $this->imgs1;
                    $chat_partner="chat_partner";
                    $chtnickname = "<b>You</b>";
                }
                $mystatus = $this->sql_models->chkOnlinePresence($chtmemid);
                $chechOnlineHidden = $this->sql_models->chechOnlineHidden($chtmemid);


                if($chechOnlineHidden) // visible
                    $last_seen="<span class='active_o'>active</span>";
                else
                    $last_seen="<span>hidden</span>";

                if($mystatus=="ash"){
                    if(strtotime($online_timing)>0){
                        if($chechOnlineHidden) // visible
                            $last_seen="<span>$online_time</span>";
                        else
                            $last_seen="<span>hidden</span>";
                    }else{
                      $last_seen="";
                    }
                }else{
                    if($chechOnlineHidden) // visible
                        $mystatus="green";
                    else
                        $mystatus="ash";
                }
            ?>

            <div class="chat_house">
                <div class="col-md-1 col-1 p-0 pr-xs-40 edit_div2<?=$id1;?>">
                    <div class="online_status online_status_small_chat"><font class="<?=$mystatus?>"></font></div>
                    <img src="<?=$pic_path2; ?>" alt="User" />
                </div>

                <div class="col-md-11 col-11 pl-5 edit_div2<?=$id1;?>">
                    <div class="chats_msg">
                        <p>
                            <?=$chtnickname?> 
                            <span class="chat_time">
                                <?=time_ago($date_created)?>
                                
                                <font class="menu_icn menu_icn2" id="menu_icn" ids="<?=$id1;?>"><i class="fa fa-ellipsis-h"></i></font>
                                <div class="edit_div" id="edit_div<?=$id1;?>">
                                    <?php if($chtmemid==$this->myID){ ?>
                                        <span style='border:none; color:red; cursor:pointer' id='delchat' ids="<?=$id1;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                                    <?php }else{ ?>

                                        <?php
                                        $isBlocked = $this->sql_models->isBlocked($this->myID, $chtmemid);
                                        $block_caption = "Block this user";
                                        if($isBlocked)
                                            $block_caption = "Unblock user";
                                        ?>
                                        <span style='border:none; color:red; cursor:pointer' id='blockuser' ids="<?=$chtmemid;?>" class="blockuser<?=$chtmemid;?>" block_caption="<?=$block_caption?>"><a href='javascript:;' style='color:red;' block_caption="<?=$block_caption?>"><?=$block_caption?> &raquo;</a></span>
                                    <?php } ?>
                                </div>

                            </span>
                        </p>

                        <?=$messages?>
                    </div>
                </div>
            </div>
        <?php
            }
        }else{
            echo "<p style='padding: 1em 0 0 24px; color: #888'>No chats yet!</p>";
        }
        echo '</div>
        </div>';
        ?>

        <div class="house_textarea row">
            <div class="col-md-12 mb-0 p-xs-5">
                <div class="form-group position-relative_">
                    <font class="refresh_my_chats">Refresh Chats</font>
                    <?php
                    $isBlocked = $this->sql_models->isBlocked($this->myID, $herid);
                    $whoBlocked = $this->sql_models->whoBlocked($myid, $herid);

                    if($this->myID!="" && strtolower($whoBlocked) != strtolower($this->myfullname)){
                        $name_captn = "$whoBlocked blocked you!";
                    }

                    if($this->myID==""){
                        $name_captn = "Please login to use this feature.";
                    }

                    if($this->myID!="" && $whoBlocked=="")
                        $name_captn = "You blocked user!";

                    if($this->myID!="" && $isBlocked){
                        echo '<textarea id="txtchat_msg" placeholder="'.$name_captn.' You cannot send a message" name="txtchat_msg" class="form-control b_class" disabled></textarea>';

                    }else{
                        echo '<textarea id="txtchat_msg" placeholder="Type a message" name="txtchat_msg" class="form-control b_class" required=""></textarea>';
                    }
                    echo '<textarea id="txtchat_msg" placeholder="Type a message" name="txtchat_msg" class="form-control unb_class" required="" style="display:none"></textarea>';
                    ?>
                </div>

                <div class="offset-lg-2 col-lg-8 offset-sm-2 col-sm-8 offset-xs-0 col-xs-12 mt-10 mb-20 mb-xs-0 m-sm--10s">
                    <div class="alert alert-danger alert_msgs alert_msg1"></div>
                    <div class="send send_cmts">
                        <div class="row p-xs-10 mt-xs--20">
                            <div class="col-md-5 col-5 pr-5 pr-xs-5">
                                <button type="button" class="btn btn-primary btn-block mfp_close curve_btn_md pt-xs-5 pb-xs-5">Close</button>
                            </div>

                            <div class="col-md-7 col-7 pl-5 pl-xs-5">
                                <?php
                                //$isBlocked = $this->sql_models->isBlocked($herid, $this->myID);
                                $isBlocked = $this->sql_models->isBlocked($this->myID, $herid);
                                if($this->myID!="" && $isBlocked===true){
                                    echo '<button type="button" class="btn btn-primary btn-block curve_btn_md1 b_class pt-xs-5 pb-xs-5" style="opacity: 0.5;" disabled>Send message</button>';

                                }else{
                                    if($this->myID==""){
                                        echo '<button type="button" class="btn btn-primary btn-block cmd_send_lgs curve_btn_md1 b_class pt-xs-5 pb-xs-5" style="opacity: 0.7;">Send message</button>';
                                    }else{
                                        echo '<button type="button" class="btn btn-primary btn-block cmd_send_smg curve_btn_md1 b_class pt-xs-5 pb-xs-5">Send message</button>';
                                    }
                                }
                                echo '<button type="button" class="btn btn-primary btn-block curve_btn_md1 cmd_send_smg unb_class mt-0 pt-xs-5 pb-xs-5" style="display:none">Send message</button>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }



    function getAllCmtsFunction($myid, $con_id, $herid){
        $fetchMyChats = $this->sql_models->fetchMyCmts($herid, $con_id);
        ///update status as read
        $this->sql_models->updateCmtsRead($herid, $con_id);

        if($this->myID == $herid){
            echo "<div class='chat_menu menu_icn_head'><i class='fa fa-ellipsis-h'></i></div>";
            ?>
            <div class="edit_div_head" id="edit_div_head">
                <?php
                $whoBlocked = $this->sql_models->turnOffCommenting($herid, $con_id);
                $block_caption = "Turn off commenting";
                if($whoBlocked)
                    $block_caption = "Turn on commenting";
                ?>
                <span style='border:none; color:red; cursor:pointer' id='offcomment' ids="<?=$con_id;?>" myid="<?=$myid?>" class="offcomment<?=$con_id;?>" block_caption="<?=$block_caption?>"><a href='javascript:;' style='color:red;' block_caption="<?=$block_caption?>"><?=$block_caption?> &raquo;</a></span>
            </div>
        <?php
        }
        ?>

        <?php
        echo '<div class="row">
            <div class="over_flow over_flow_cmt">';

        if($fetchMyChats){
            foreach ($fetchMyChats as $rs) {
                $id1 = $rs['id1'];
                $pics = $rs['pics'];
                $chtmemid = $rs['memid'];
                $recipient_id = $rs['commenter_id'];

                $getDetls = $this->sql_models->getDetails($recipient_id);
                $chtnickname = $getDetls['names'];
                $pics = $getDetls['pics'];
                if(strlen($chtnickname)<=2){
                    $chtnickname = $getDetls['nickname'];
                }

                $names1 = strtolower($chtnickname);
                $names1 = str_replace(" ", "-", $names1);

                $nows = substr(time(), -5);
                $memid_hash = $chtmemid.$nows;

                $messages = ucfirst($rs['messages']);
                $date_created = $rs['date_created'];

                $online_timing = date("Y-m-d g:i a", $rs['online_timing']);
                $online_time = time_ago($online_timing);

                $pic_path2 = base_url()."profiles1/$pics";
                $width1=""; $width2="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width1=="" || $width1<=0)
                    $pic_path2 = base_url()."profiles/$pics";

                list($width2, $height1, $type1, $attr1) = @getimagesize($pic_path2);

                if($width2=="" || $width2<=0)
                    $pic_path2 = base_url()."images/no_passport.jpg";

                $chat_partner="";
                if($recipient_id==$this->myID){
                    $pic_path2 = $this->imgs1;
                    $chat_partner="chat_partner";
                    $chtnickname = "<b>You</b>";
                }

                
                if($recipient_id!=$this->myID)
                    $mid = $chtmemid;
                else
                    $mid = $this->myID;

                $mystatus = $this->sql_models->chkOnlinePresence($mid);
                $chechOnlineHidden = $this->sql_models->chechOnlineHidden($mid);
                

                if($mystatus=="ash"){
                    if(strtotime($online_timing)>0){
                        if($chechOnlineHidden) // visible
                            $last_seen="<span>$online_time</span>";
                        else
                            $last_seen="<span>hidden</span>";
                    }else{
                      $last_seen="";
                    }
                }else{
                    if($chechOnlineHidden) // visible
                        $mystatus="green";
                    else
                        $mystatus="ash";
                }
            ?>

            <div class="chat_house">
                <div class="col-md-1 col-1 p-0 pr-xs-40 edit_div2<?=$id1;?>">
                    <div class="online_status online_status_small_chat"><font class="<?=$mystatus?>"></font></div>
                    <img src="<?=$pic_path2; ?>" alt="User" />
                </div>

                <?php
                //$isBlocked = $this->sql_models->isBlocked($this->myID, $chtmemid);
                $isBlocked = $this->sql_models->isBlocked($this->myID, $recipient_id);
                $block_caption = "Block this user";
                if($isBlocked)
                    $block_caption = "Unblock user";
                ?>

                <div class="col-md-11 col-11 pl-5 edit_div2<?=$id1;?>">
                    <div class="chats_msg">
                        <p>
                            <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$chtnickname?></a> 
                            <span class="chat_time">
                                <?=time_ago($date_created)?>
                                
                                <?php if($recipient_id==$this->myID){ ?>
                                    <font class="menu_icn menu_icn2" id="menu_icn" ids="<?=$id1;?>"><i class="fa fa-ellipsis-h"></i></font>
                                <?php }else{ ?>

                                    <?php if($chtmemid==$this->myID){ ?>
                                        <font class="menu_icn menu_icn2" id="menu_icn" ids="<?=$id1;?>"><i class="fa fa-ellipsis-h"></i></font>
                                    <?php } ?>
                                <?php } ?>

                                <div class="edit_div" id="edit_div<?=$id1;?>">
                                    <?php if($chtmemid==$this->myID){ ?>
                                        <span style='border:none; color:red; cursor:pointer' id='delcmts' ids="<?=$id1;?>"><a href='javascript:;' style='color:red;'>Delete comment &raquo;</a></span>

                                        <?php if($recipient_id != $this->myID){ ?>
                                            <span style='border:none; color:red; cursor:pointer' id='blockuser' ids="<?=$chtmemid;?>" class="blockuser<?=$chtmemid;?>" block_caption="<?=$block_caption?>"><a href='javascript:;' style='color:red;' block_caption="<?=$block_caption?>"><?=$block_caption?> &raquo;</a></span>
                                        <?php } ?>

                                    <?php }else{ ?>

                                        <?php if($recipient_id==$this->myID){ ?>
                                            <span style='border:none; color:red; cursor:pointer' id='delcmts' ids="<?=$id1;?>"><a href='javascript:;' style='color:red;'>Delete comment &raquo;</a></span>
                                        <?php }else{ ?>
                                            
                                            <span style='border:none; color:red; cursor:pointer' id='blockuser' ids="<?=$chtmemid;?>" class="blockuser<?=$chtmemid;?>" block_caption="<?=$block_caption?>"><a href='javascript:;' style='color:red;' block_caption="<?=$block_caption?>"><?=$block_caption?> &raquo;</a></span>
                                    <?php } } ?>
                                </div>
                            </span>
                        </p>
                        <?=$messages?>
                    </div>
                </div>
            </div>
        <?php
            }
        }else{
            echo "<p style='padding: 1em 0 0 24px; color: #888'>No chats yet!</p>";
        }
        echo '</div>
        </div>';
        ?>

        <div class="house_textarea row">
            <div class="col-md-12 mb-0 p-xs-5">
                <div class="form-group position-relative_">
                    <font class="refresh_my_cmts" memids="<?=$myid?>" herid="<?=$herid?>" con_id="<?=$con_id?>">Refresh Comments</font>
                    <?php
                    //echo $recipient_id;
                    //echo $herid;
                    $isBlocked = $this->sql_models->isBlocked($this->myID, $herid);
                    $whoBlocked = $this->sql_models->whoBlocked($myid, $herid);

                    $isOffComment = $this->sql_models->turnOffCommenting($herid, $con_id);

                    if($this->myID==""){
                        $name_captn = "Please login to use this feature.";
                    }

                    if($this->myID!="" && strtolower($whoBlocked)!=strtolower($this->myfullname)){
                        $name_captn = "$whoBlocked blocked you!";
                    }

                    if($this->myID!="" && $whoBlocked=="")
                        $name_captn = "You blocked user!";

                    if($isOffComment){

                        echo '<textarea id="txtchat_msg" placeholder="This comment was turned off..." name="txtchat_msg" class="form-control b_class" disabled></textarea>';

                    }else{

                        if($isBlocked==$this->myID){
                            echo '<textarea id="txtchat_msg" placeholder="'.$name_captn.' You cannot send a message" name="txtchat_msg" class="form-control b_class" disabled></textarea>';
                        }else{
                            echo '<textarea id="txtchat_msg" placeholder="Type a message" name="txtchat_msg" class="form-control b_class" required=""></textarea>';
                        }
                    }
                    echo '<textarea id="txtchat_msg" placeholder="Type a message" name="txtchat_msg" class="form-control unb_class" required="" style="display:none"></textarea>';
                    ?>
                </div>

                <div class="offset-lg-2 col-lg-8 offset-sm-2 col-sm-8 offset-xs-0 col-xs-12 mt-10 mb-20 mb-xs-0 m-sm--10s">
                    <div class="alert alert-danger alert_msgs alert_msg1"></div>
                    <div class="send send_cmts">
                        <div class="row p-xs-10 mt-xs--20">
                            <div class="col-md-5 col-5 pr-5 pr-xs-5">
                                <button type="button" class="btn btn-primary btn-block mfp_close curve_btn_md pt-xs-5 pb-xs-5">Close</button>
                            </div>

                            <div class="col-md-7 col-7 pl-5 pl-xs-5">
                                <?php
                                $isBlocked = $this->sql_models->isBlocked($this->myID, $herid);
                                if($isBlocked==$this->myID){
                                    echo '<button type="button" class="btn btn-primary btn-block curve_btn_md1 b_class pt-xs-5 pb-xs-5" style="opacity: 0.5;" disabled>Send message</button>';

                                }else{
                                    if($this->myID==""){
                                        echo '<button type="button" class="btn btn-primary btn-block cmd_send_lgs curve_btn_md1 b_class pt-xs-5 pb-xs-5" style="opacity: 0.7;">Send message</button>';
                                    }else{

                                        if($isOffComment){
                                            echo '<button type="button" class="btn btn-primary btn-block curve_btn_md1 b_class pt-xs-5 pb-xs-5" style="opacity: 0.5;" disabled>Send message</button>';
                                        }else{
                                            echo '<button type="button" class="btn btn-primary btn-block cmd_send_cmts curve_btn_md1 b_class pt-xs-5 pb-xs-5" con_ids="'.$con_id.'">Send message</button>';
                                        }

                                    }
                                }
                                echo '<button type="button" class="btn btn-primary btn-block curve_btn_md1 cmd_send_cmts unb_class mt-0 pt-xs-5 pb-xs-5" con_ids="'.$con_id.'" style="display:none">Send message</button>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }



    function bring_comments(){
        $ids = $this->input->post('txtcontID');
        $txtpgs = $this->input->post('txtpgs');

        if($txtpgs=="blog"){
            $comments = $this->sql_models->fetchCommentsBlogs('comments_blogs', $ids, 20);
            $commentsCounts = $this->sql_models->fetchCommentsBlogCounts('comments_blogs', $ids);
            $allCcounts = $commentsCounts;
            $meta3 = "meta3";
        }else{
            $comments = $this->sql_models->fetchComments('comments', $ids, 20);
            $commentsCounts = $this->sql_models->fetchCommentsCounts('comments', $ids);
            $repliesCounts = $this->sql_models->fetchCommentsCounts('replies', $ids);
            $allCcounts = $commentsCounts+$repliesCounts;
            $meta3 = "";
        }

        if($comments){
            foreach ($comments as $rs) {
                $cmt_id = $rs['id3'];
                $mem_id = $rs['mem_id'];
                $nows = substr(time(), -5);
                $memid_hash = $mem_id.$nows;
                $cmt_names = ucwords($rs['names']);
                $cmt_nick = ucwords($rs['nickname']);

                $names1 = strtolower($cmt_names);
                if(strlen($names1)<=2) $names1 = strtolower($cmt_nick);
                if(strlen($cmt_names)<=2) $cmt_names = ucwords(strtolower($cmt_nick));
                $names1 = str_replace(" ", "-", $names1);

                //if(strlen($cmt_names)<=2) $cmt_names = ucwords($cmt_nick);
                $messages = nl2br($rs['messages']);
                $date_created = $rs['date_created'];
                $date_created = @date("jS M Y h:i a", strtotime($date_created));
                if($txtpgs!="blog"){
                    $replies = $this->sql_models->fetchReps('replies', $cmt_id, "");
                }
            ?>
                <div class="cmt_box<?=$cmt_id;?>">
                    <p class="meta meta2 <?=$meta3?>">
                        <a href="<?=base_url()?>profile/<?=$memid_hash?>/<?=$names1?>/"><?=$cmt_names?></a> - <?=$date_created?>
                        <?php
                        if($txtpgs!="blog"){
                             echo '- <a href="javascript:;" class="replythis" cmt_id="'.$cmt_id.'">Reply Me</a>';
                         }
                         ?>
                    </p>
                    <div class="comments_content">
                        <?php if($mem_id==$this->myID){ ?>
                        <p class="menu_icn" id="menu_icn" ids="<?=$cmt_id;?>"><i class="fa fa-ellipsis-h"></i></p>
                        <div class="edit_div" id="edit_div<?=$cmt_id;?>">
                            <span id='editpost' counters="<?=$cmt_id;?>" messages1="<?=strip_tags(ucfirst($messages));?>" ids="<?=$cmt_id;?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>

                            <span style='border:none; color:red; cursor:pointer' id='delpost' ids="<?=$cmt_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                        </div>
                        <?php } ?>

                        <p><?=ucfirst($messages)?></p>
                    </div>
                </div>

                <?php
                if($txtpgs!="blog"){
                    if($replies){
                        echo "<div class='div_reps$cmt_id'>";
                        foreach ($replies as $rs) {
                            $rep_id = $rs['id3'];
                            $mem_id1 = $rs['mem_id1'];
                            //$comts_id = $rs['comments_id'];
                            $cmt_names1 = ucwords($rs['names']);
                            $cmt_nick = ucwords($rs['nickname']);
                            if(strlen($cmt_names1)<=2) $cmt_names1 = ucwords($cmt_nick);
                            if($cmt_names1=="") $cmt_names1 = "Anonymous";
                            $messages1 = nl2br($rs['messages']);
                            $date_created1 = $rs['date_created'];
                            $date_created1 = @date("jS M, Y, h:i a", strtotime($date_created1));
                            ?>

                            <div class="reply rep_box<?=$rep_id;?>">
                                <p class="meta">
                                    <a href="#"><?=$cmt_names1?></a> - <?=$date_created1?>
                                </p>
                                <div class="comments_content">
                                    <?php if($mem_id1==$this->myID){ ?>
                                    <p class="menu_icn1" id="menu_icn1" ids="<?=$rep_id;?>" cmt_id="<?=$rep_id?>"><i class="fa fa-ellipsis-h"></i></p>
                                    <div class="edit_div" id="edit_div<?=$rep_id;?>">
                                        <span id='editpost' counters="<?=$rep_id;?>" messages1="<?=strip_tags(ucfirst($messages1));?>" ids="<?=$rep_id;?>" comments_id="<?=$cmt_id?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>
                                        
                                        <span style='border:none; color:red; cursor:pointer' id='delpost1' ids="<?=$rep_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                                    </div>
                                    <?php } ?>

                                    <p><?=$messages1?></p>
                                </div>
                            </div>
                        <?php
                        }
                        echo "</div>";
                        ?>

                        <a href="javascript:;" class="show_more_cmts load_more_bt_<?=$cmt_id?> wow fadeIn" id="load_more_mba"  id1="<?=$cmt_id?>" data-val = "1" data-wow-delay="0.2s">Load more posts </a>

                        <a href="javascript:;" class="show_more_cmts load_more_bt1_<?=$cmt_id?> wow fadeIn" id="load_more_mba1" style="color:#ccc; display:none;" data-wow-delay="0.2s"><i>Loading...</i></a>

                        <div style='clear:both'></div>

                    <?php
                    }
                }
            }
        }else{
            echo "<p style='font-size: 18px; color: #555; margin: -10px 0 30px 0'>No comments yet!</p>";
        }
    }




    public function bring_replies(){
        $page = $this->input->post('page');
        $ids = $this->input->post('ids');
        
        $replies = $this->sql_models->fetchReps('replies', $ids, $page);
        if($replies){
            //echo '<div class="cover_contents"></div>';
            foreach ($replies as $rs) {
                $rep_id = $rs['id3'];
                $cmt_names1 = ucwords($rs['names']);
                $cmt_nick1 = ucwords($rs['nickname']);
                if(strlen($cmt_names1)<=2) $cmt_names1 = ucwords($cmt_nick1);
                if($cmt_names1=="") $cmt_names1 = "Anonymous";
                $messages1 = nl2br($rs['messages']);
                $date_created1 = $rs['date_created'];
                $date_created1 = @date("jS M, Y, h:i a", strtotime($date_created1));
            ?>
                <div class="reply rep_box<?=$rep_id;?>">
                    <p class="meta">
                        <a href="#"><?=$cmt_names1?></a> - <?=$date_created1?>
                    </p>
                    <div class="comments_content">
                        <p class="menu_icn1" id="menu_icn1" ids="<?=$rep_id;?>" cmt_id="<?=$rep_id?>"><i class="fa fa-ellipsis-h"></i></p>
                        <div class="edit_div" id="edit_div<?=$rep_id;?>">
                            <span id='editpost' counters="<?=$rep_id;?>" messages1="<?=strip_tags(ucfirst($messages1));?>" ids="<?=$rep_id;?>" style='cursor:pointer'><a href='javascript:;'>Edit this post &raquo;</a></span>
                            
                            <span style='border:none; color:red; cursor:pointer' id='delpost1' ids="<?=$rep_id;?>"><a href='javascript:;' style='color:red;'>Delete this post &raquo;</a></span>
                        </div>

                        <p><?=$messages1?></p>
                    </div>
                </div>

            <?php
            }
        }else{
            echo "No more replies";
        }
    }



    function delete_records(){
        $txtall_id = $this->input->post('txtall_id');
        $txt_dbase_table = $this->input->post('txt_dbase_table');
        $profile_details = $this->sql_models->deleteTblRecords($txt_dbase_table, $txtall_id);
        if($profile_details) echo "deleted"; else echo "error";
    }


    function delete_post(){
        $post_id = $this->input->post('post_id');
        $this->sql_models->deleteFrmPost('comments', $post_id);
        echo "deleted";
    }


    
    function delete_chat(){
        $post_id = $this->input->post('post_id');
        $this->sql_models->deleteFrmPost('chatwithme', $post_id);
        echo "deleted";
    }

    
    function delete_cmts(){
        $post_id = $this->input->post('post_id');
        $this->sql_models->deleteFrmPost('mycomments', $post_id);
        echo "deleted";
    }

    
    function off_commenting(){
        $con_id = $this->input->post('con_id');
        $myid = $this->input->post('myid');
        $blockme = $this->input->post('blockme');

        $newdata3 = array(
            'memid'         => $this->myID,
            'contest_id'    => $con_id
        );

        if($blockme==1){ // has blocked
            $this->db->insert('turn_off_cmts', $newdata3);
        }else{ // has unblocked
            $this->db->where('memid', $this->myID)->where('contest_id', $con_id);
            $this->db->delete('turn_off_cmts');
        }
    }


    function block_user_chat(){
        $post_id = $this->input->post('herid');
        $blockme = $this->input->post('blockme');

        $newdata3 = array(
            'memid'    => $this->myID,
            'users'    => $post_id
        );

        if($blockme==1){ // has blocked
            $this->db->insert('block_chat_user', $newdata3);
        }else{ // has unblocked
            $this->db->where('memid', $this->myID)->where('users', $post_id);
            $this->db->delete('block_chat_user');
        }
    }


    function delete_reply(){
        $post_id = $this->input->post('post_id');
        $this->sql_models->deleteFrmRep($post_id);
        echo "deleted";
    }



    function upload_adverts(){
        $this->form_validation->set_rules('txtbanner', 'banner type', 'required|trim');
        $this->form_validation->set_rules('txtexp', 'expiry', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtbanner = $this->input->post('txtbanner');
            $txtexp = $this->input->post('txtexp');
            $adv_id = $this->input->post('adv_id'); // for update
            $former_file_ph = $this->input->post('former_file_ph');

            if($txtexp == "noexp")
                $txtexp1 = strtotime('+1 year', time());
            else{ 
                $txtexp1 = strtotime('+'.$txtexp, time());
            }

            $gen_num1 = mt_rand(1111111, 9999999);

            $errors = false;
            $img_ext_chk = array('jpg','png','jpeg', 'gif');
            $path1 = @$_FILES['adv_image']['name'];
            $ext2 = pathinfo($path1, PATHINFO_EXTENSION);

            //if(!empty($_FILES['adv_image']['name']) && $former_file_ph!=""){

            if(!isset($_FILES['adv_image']['name']) && @$_FILES['adv_image']['name'] == ""){
                echo "Please upload an image";

            }else if(!in_array($ext2,$img_ext_chk) && isset($_FILES['adv_image']['name']) && $_FILES['adv_image']['name'] != ""){
                echo "Invalid image format!<br>";
                //$errors = false;
                //exit;
            }else if(isset($_FILES['adv_image']['size']) && $_FILES['adv_image']['size'] > 512000){
                echo "The image has exceeded 500KB<br>";
                //$errors = false;
                //exit;
            }else{
                $randm = mt_rand(111111111, 999999999);
                $rename_file = "$randm.$ext2";
                $rename_file = str_replace(" ", "_", $rename_file);
                $ext=pathinfo($rename_file,PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $url = "fake_fols/".$rename_file;
                $url_dest = "adverts1/";

                //$url = "adverts1/".$rename_file;
                $new_name2 = $rename_file;
                $file_tmp = $_FILES["adv_image"]["tmp_name"];
                if(is_uploaded_file($file_tmp)){
                    if($adv_id != "")
                        $this->sql_models->delete_gal_pics($former_file_ph);
                    if(move_uploaded_file($file_tmp, $url)){
                        if($txtbanner == "skyscraper")
                            $this->resizeImage($url, $url_dest, 600, '', FALSE);
                        else
                            $this->resizeImage($url, $url_dest, 320, '', FALSE);
                        $errors = true;
                    }
                }
                $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                if(is_readable($in_folder1)) @unlink($in_folder1);


                if($ext2=="") $new_name2="";

                if($adv_id!=""){ // for edit
                    $data1 = array();
                    if(isset($path1) && @$path1 != ''){
                        $data1 = array(
                            'image'    => $new_name2
                        );
                    }

                    $data2 = array(
                        'banner'        => $txtbanner,
                        'expiry'        => $txtexp1,
                        'durations'     => $txtexp
                    );
                    $newdata3 = array_merge($data1, $data2);

                }else{
                    $newdata3 = array(
                        'image'         => $new_name2,
                        'banner'        => $txtbanner,
                        'expiry'        => $txtexp1,
                        'durations'     => $txtexp,
                        'created_at'    => date("Y-m-d g:i a", time())
                    );
                }

                if($adv_id != ""){
                    $query1 = $this->db->where('md5(id)', $adv_id)->update('adverts', $newdata3);
                }else{
                    $query1 = $this->db->insert('adverts', $newdata3);
                }
                echo "uploaded";
            }
        }
    }




    function post_comments(){
        $this->form_validation->set_rules('txtcname', 'full names', 'required|trim|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('txtcemail', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('txtcmessage', 'message', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtcname = $this->input->post('txtcname');
            $txtcemail = $this->input->post('txtcemail');
            $txtcmessage = $this->input->post('txtcmessage');
            $txtblogid = $this->input->post('txtblogid');

            $newdata2 = array(
                'rands'        => $txtblogid,
                'names'        => $txtcname,
                'emails'       => $txtcemail,
                'message'      => $txtcmessage,
                'created_at'   => date("Y-m-d g:i a", time())
            );
            $newdata2 = $this->security->xss_clean($newdata2);
            if($this->sql_models->insert_comments($newdata2)){
                echo "inserted";
            }else{
                echo "Network Error! Try inserting again or refresh the page";
            }
        }
    }


    
    function logmein(){
        $this->form_validation->set_rules('txtlog_email', 'Email or Phone', 'required|trim');
        $this->form_validation->set_rules('txtlog_pass', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
        }else{
            $data = array(
                'emails' => cleanStrInputs(strtolower($this->input->post('txtlog_email'))),
                'pass' => $this->input->post('txtlog_pass')
            );

            $is_correct_id = $this->sql_models->get_user_logins($data);

            $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
            $retain_page_name = $this->input->cookie('retain_page_name', TRUE);
            $retain_page_params3 = $this->input->cookie('retain_page_params3', TRUE);

            if($is_correct_id){
                $arrs = array('type'=>'success', 'msg'=>$retain_page_id1, 'msg1'=>$retain_page_name, 'msg2'=>$retain_page_params3);
            }else{
                $arrs = array('type' => 'error', 'msg'=>'Invalid details entered!', 'msg1'=>'', 'msg2'=>'');
            }
        }
        echo json_encode($arrs);
    }



    function send_pass_code(){
        $this->form_validation->set_rules('txtemail2', 'Email address', 'required|trim|valid_email');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $txtemail2 = strtolower($this->input->post('txtemail2'));
            $details_exists = $this->sql_models->check_existing_details($txtemail2, '', 'members');
            if($details_exists){
                ///////////////////////////////
                    $res_code = substr(time(), -5);
                    $newdata2 = array(
                        'emails'         => $txtemail2,
                        'codes'          => $res_code
                    );

                    $codes = $this->sql_models->insert_code($newdata2, $txtemail2, 'email_verificatn');

                    if($codes!=""){
                        //////////////////FOR EMAILS/////////////////////////
                            $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello there,</b></p>";
                            $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                            This is your reset code <b>$codes</b><br>";

                            $message_contents .= "Please click on the link below to reset your password and continue. 
                            <a href='".base_url()."reset-password/' target='_blank'>Password Reset</a>
                            </p>";
                        //////////////////FOR EMAILS///////////////////////// 

                        $subj = "Your Password Reset Link";
                        //$from = "Undisclosed Recipient <noReply@icontestpro.com>";
                        $from = "Undisclosed Recipient <noReply@icontestpro.com>";
                        $to = $txtemail2;
                        $from_name = "iContestPRO Password Reset";

                        $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                        $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                        echo "msg_sent";
                    }else{
                        echo "Error, please try again.";
                    }
                ///////////////////////////////

            }else{
                echo "The details you provided do not exist.";
            }
            
        }
    }



    /*public function fetch_records(){
        $url_task = $this->uri->segment(3); // view_customers
        $url_task1 = $this->uri->segment(4);
        //$url_task1="";
        $uid=$this->myID;
        $mypage="";

        //echo $url_task1; echo $url_task; exit;

        $fetch_data = $this->sql_models->make_datatables($url_task, $url_task1, $uid, "", "");
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row){   
            $sub_array = array();
            $ids = $row->id;
            $nows = substr(time(), -5);
            $ids_hash = $ids.$nows;

            if($url_task=="contest_leaderboard"){
                $title = ucwords($row->title);
                $adv_title_f = cleanStr(strtolower($title));
                $contest_lnk = base_url()."$ids_hash/join/$adv_title_f/";
                $media_type = $row->media_type;
                $files = $row->files;
                $views =  kilomega($row->views);
                $entry_type = $row->entry_type;
                $timings = $row->timings;
                $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids));
                if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                //$pic_pathi = base_url()."contest_types/$files";

                $pic_pathi = base_url()."contest_types/$files";
                $width1="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);
                if($width1=="" || $width1<=0)
                    $pic_pathi = base_url()."images/no-image.jpg";

                $pic_path2 = "<a href='$contest_lnk' class='responsive_img1'><img src='$pic_pathi' class='card-img-top'></a>";
                //$premium1="";
                if($entry_type=="free" || $entry_type=="") $entry_type1 = "<b>Entry:</b> Free<br>"; else $entry_type1 = "<b>Entry:</b> Paid<br>";

                $currentTime = time();
                $difference = $timings - $currentTime;
                $expirys = convertTime1($difference);

                $other_details = "<p class='const_details'>
                <a href='$contest_lnk'>$title</a><br>
                <b>Views: </b>$views<br>
                $entry_type1
                <b>Expiry: </b>$expirys<br>
                <b>Total Entries: </b>$noOfEntries<br>
                <b>Total Votes: </b>$noOfVotes<br>
                </p>";
            }


            if($url_task=="entry_records"){
                $ids1 = $row->id1;
                $ids2 = $row->id2;
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($names)<=3) $names = $nickname;
                $title = ucwords($row->title);
                $votes = @number_format($row->votes);
                $views =  kilomega($row->views);
                $date_created = @date("jS M, Y h:i a", strtotime($row->date_created));
                $mypage="";
            }


            if($url_task=="entries_leaderboard"){
                $ids1 = $row->id1;
                $contestant_id = $row->contestant_id;
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                $names1 = strtolower($names);
                if(strlen($names1)<=2) $names1 = strtolower($nickname);
                if(strlen($names)<=2) $names = ucwords($nickname);
                $names1 = str_replace(" ", "-", $names1);
                $memid_hash = $row->memid.$nows;
                $names_lnk = base_url()."profile/$memid_hash/$names1/";
                $profession = ucwords($row->profession);
                $files = $row->pics;
                $con_ids = $row->contest_id;
                $pviews = kilomega($row->views);
                $noOfEntries = $this->sql_models->noOfEntriesParticipated('entries', $contestant_id);
                $getContestName = $this->sql_models->getContestName($con_ids);
                //$noOfVotes = $row->votes;
                $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $contestant_id));
                if($noOfEntries>0) $noOfEntries1 = "$noOfEntries Contests so far"; else $noOfEntries1 = "$noOfEntries Contest so far";
                $citys = $row->citys1;
                $states = $row->states1;
                $locs_full = "$citys, $states";

                $pic_pathi = base_url()."profiles1/$files";
                if($files=="") $pic_pathi = base_url()."images/no_passport.jpg";

                $pic_path2 = "<a href='$names_lnk' class='responsive_img2'><img src='$pic_pathi'></a>";

                if(strlen($names)<=2) $names = $nickname;

                $getBoosted = $this->sql_models->fetchBoosted($con_ids, $contestant_id);
                $boosteds="";
                if($getBoosted>0){
                    $boosteds = "(".@number_format($getBoosted)." Boosted)";
                }

                $other_details = "<p class='const_details'>
                <a href='$names_lnk'>$names</a><br>
                <b style='font-size: 17px; color:#09C;'>".@number_format($noOfVotes)." votes $boosteds</b><br>
                <b>Contest: </b>$getContestName<br>
                <b>Profession: </b>$profession<br>
                <b>Profile Views: </b>$pviews<br>
                <b>Location: </b>$locs_full<br>
                <b>Participated On </b>$noOfEntries1<br>
                </p>";
            }



            if($url_task=="view_contests"){
                $approved = $row->approved;
                $overall_title = ucwords($row->title);
                $media_type = $row->media_type;
                $descrip = $row->descrip;
                $files = $row->files;
                $prize1 = @number_format($row->price1);
                $prize2 = @number_format($row->price2);
                $prize3 = @number_format($row->price3);
                $gift1 = ucwords($row->add_price1);
                $gift2 = ucwords($row->add_price2);
                $gift3 = ucwords($row->add_price3);
                $instructn = $row->instructions;
                $views = $row->views;
                $paids = $row->paids;
                $entry_type = $row->entry_type;
                $entry_fee = $row->entry_fee;
                $start_date1 = strtotime($row->start_date);
                $start_date2 = @date("jS M, Y", $start_date1);
                if($row->close_date_entry!="")
                    $close_date_entry = @date("D jS M, Y h:ia", strtotime($row->close_date_entry));
                else
                    $close_date_entry = "<i>Not Specified</i>";

                if($row->start_date_contest!="")
                    $start_date_contest = @date("D jS M, Y h:ia", strtotime($row->start_date_contest));
                else
                    $start_date_contest = "<i>Not Specified</i>";

                $c_expirys = @date("D jS M, Y h:ia", $row->timings);
                $premium = strtoupper($row->premium);
                $completed = $row->completed;
                $date_created = $row->date_created;
                $start_date = $row->start_date;
                $mypage="edit-contest";

                $id_harsh = $ids.substr(time(), -5);

                $hasBoost = $this->sql_models->hasBoost($ids);
                if($hasBoost){
                    $boosts = "<div class='boost_ads1'><span style='opacity:0.5'>Boosted</span></div>";
                }else{
                    $boosts = "<div class='boost_ads'><span con_id='$ids' ad_type='contests' sizes='1360x510' extends1='' titles='$overall_title'>Boost This</span></div>";
                }
                $boosts .= "<div style='margin:12px 0 5px 0;'><a href='".base_url()."dashboard/".$id_harsh."/entry-records/'>VIEW ENTRIES</span></div>";

                if($start_date!="")
                    $start_date = date("D jS M, Y h:ia", strtotime($start_date));
                else
                    $start_date = "Not specified";

                if($files!=""){
                    //$files1 = base_url()."contest_types/".$files;

                    $files1 = base_url()."contest_types/$files";
                    $width1="";
                    list($width1, $height1, $type1, $attr1) = @getimagesize($files1);
                    if($width1=="" || $width1<=0)
                        $files1 = base_url()."images/no-image.jpg";

                    $files = "<div class='img_banners'><img src='$files1'></div>";
                }

                $currentTime = time();
                $difference = $row->timings - $currentTime;

                if($start_date1 <= $currentTime){
                    $c_expirys1 = convertTime1($difference);
                    $c_expirys1 = str_replace("time", "", $c_expirys1);
                }else{
                    //$c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    $difference = $row->timings - strtotime($row->start_date_contest);
                    $c_expirys1 = convertTime1($difference);
                    $c_expirys1 = ucwords(str_replace("time", "", $c_expirys1));
                }

                $dates = date("D jS M Y h:ia", strtotime($date_created));

                if($media_type=="vid") $media_type="Video Upload"; else $media_type="Photo Upload";

                $hasCodes = $this->sql_models->hasCodes($ids);
                $view_codes="";$enter_codes="";

                if($premium=="FREE" || $premium==""){
                    $premium="FREE VOTE";
                }else if($premium=="FREE_PAID"){
                    $premium="FREE & BOOST VOTE";
                }else{
                    $premium="BOOST VOTE";

                    $enter_codes="<div style='line-height: 27px;'><span style='margin-top:4px; display:inline-block' class='enter_codes' contest_id='$ids' edits=''>Enter Codes</span>";
                    if($hasCodes) $view_codes = "<br><span class='view_codes' contest_id='$ids' edits='1'>View Codes</span></div>";
                }

                if($prize1!="") $prize1 = "<p><b>First Prize: &#8358;$prize1</b><br>$gift1</p>";
                if($prize2!="") $prize2 = "<p><b>First Prize: &#8358;$prize2</b><br>$gift2</p>";
                if($prize3!="") $prize3 = "<p><b>First Prize: &#8358;$prize3</b><br>$gift3</p>";

                if($entry_fee!="") $entry_fee="&#8358;$entry_fee";

                if($entry_type=="paid")
                    $entry_type1 = "<p><b>Entry Type: ".strtoupper($entry_type)."</b><br>$entry_fee</p>";
                else if($entry_type=="coded")
                    $entry_type1 = "<p><b>Entry Type: CODED</p>";
                else
                    $entry_type1 = "<p><b>Entry: FREE</b></p>";

                $all_prizes = "<div class='img_prizes'>
                $prize1 $prize2 $prize3 
                </div>";

                $hasEntries = $this->sql_models->hasEntries($ids);

                if($this->myID>0 && $this->my_mem_type=="spon"){
                    if($approved == 1){
                        $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                    }
                }else{
                    if($approved == 1){
                        $approved_1 = "<font id='approve_it' caps='Approved' table='contests' colums='approved' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font id='approve_it' caps='Not Approved' table='contests' colums='approved' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                    }
                }

                //$approved_1 .= "<div style='margin:12px 0 5px 0;'><a href='".base_url()."dashboard/".$id_harsh."/entry-records/'>NOT PAID</span></div>";

                if(!isset($paids) || $paids<=0){
                    $approved_1 .= "<div class='lnk_btns lnk_btns1 pay_for_contest'><span con_id='$ids' titles='$overall_title'>NOT PAID</span></div>";
                }else{
                    $approved_1 .= "<div class='lnk_btns pay_for_contest'><span con_id='$ids' titles='$overall_title'>PAID</span></div>";
                }

                if($completed == 0){
                    if($hasEntries){
                        $close_cons_1 = "<font id='approve_it' caps='Open' table='contests' colums='completed' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#fff; font-size:15px; cursor:pointer; background:#008C46; padding:3px 15px'><b>Open</b></font>";
                    }else{
                        $close_cons_1 = "<font id='approve_status_not' caps='Open' table='contests' colums='completed' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#063; font-size:15px; cursor:pointer; opacity:0.5;'><b>Open</b></font>";
                    }
                }else{
                    $close_cons_1 = "<font id='approve_status_' caps='Closed' table='contests' colums='completed' duratn='' aparams='' class='approve_status_c approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Completed</b></font>";
                }
            }


            if($url_task=="sponsored_contests"){
                $id1 = $row->id1;
                $paid = $row->paid;
                $title = ucwords($row->title);
                $amt = @number_format($row->amt);
                $response = $row->response;
                $duratn = $row->duratn;
                $extendeds = $row->extendeds;
                $date_created = $row->date_created;
                $start_date1 = strtotime($row->start_date);
                $start_date2 = @date("jS M, Y", $start_date1);
                
                $currentTime = time();
                $difference = $row->timings - $currentTime;

                if($start_date1 <= $currentTime){
                    $c_expirys = convertTime1($difference);
                    $c_expirys = str_replace("time", "left", $c_expirys);
                }else{
                    //$c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    $difference = $row->timings - strtotime($row->start_date);
                    $c_expirys = convertTime1($difference);
                    $c_expirys = ucwords(str_replace("time", "", $c_expirys));
                }

                $dates = date("D jS M Y h:ia", strtotime($date_created));

                $extendeds1="<i style='color:#999'>Nill</i>";
                if($extendeds=="-1"){
                    $extendeds1 = "<b style='color:#096; opacity:0.6'>AD Extended</b>";
                }

                if($paid == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px;'><b>PAID</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15.5px; line-height:16px !important'><b>NOT PAID</b></font>";
                }
                $extend_dur = "<div class='boost_ads'><span con_id='$id1' ad_type='contests' sizes='1360x510' titles='$title' extends1='1'>Extend Duration</span></div>";
            }


            if($url_task=="referral_records"){
                $names = ucwords($row->names);
                $profession = ucwords($row->profession);
                $date_upgraded = date("D jS M Y h:ia", strtotime($row->date_upgraded));
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
            }


            if($url_task=="view_transactions"){
                $amts = @number_format($row->amt);
                $acct_no = $row->acct_no;
                $banks = $row->banks;
                $acct_name = $row->acct_name;
                $answered = $row->answered;
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));

                if($answered == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                }
            }


            if($url_task=="transfer_history"){
                $amts = @number_format($row->amount);
                $sender_id = $row->mid;
                $rec_id = $row->mid2;

                if($sender_id == $this->myID){
                    $name_ful = "<b>You</b>";
                }else{
                    $name_sender = ucwords($row->name_sender);
                    $nickname_sender = ucwords($row->nickname_sender);
                    $name_ful = "$name_sender ($nickname_sender)";
                }

                if($rec_id == $this->myID){
                    $name_ful2 = "<b>You</b>";
                }else{
                    $names = ucwords($row->names);
                    $nickname = ucwords($row->nickname);
                    $name_ful2 = "$names ($nickname)";
                }
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
            }

            
            if($url_task=="votes_recs"){
                $ids1 = $row->id1;
                $names = ucwords($row->names);
                $names1 = strtolower($names);
                $names1 = str_replace(" ", "-", $names1);
                $memid_hash = $row->id1.$nows;
                $title = ucwords($row->title);
                $votes = $row->votes;
                $vps = $row->vp;
                $date_created = $row->date_created;
            }


            if($url_task=="view_adverts"){
                $ids1 = $row->id;
                $title = ucwords($row->title);
                $approved = $row->approved;
                $extendeds = $row->extendeds;
                $sizes = $row->sizes;
                $positns = ucwords($row->positns);
                $duration = ucwords($row->duration);
                $urls = $row->urls;
                $files = $row->files;
                $amt = @number_format($row->amt);
                $date_created = $row->date_created;
                $date_created = @date("jS M, Y h:i a", strtotime($date_created));
                $duration_stamp = $row->duration_stamp;
                $currentTime = time();

                $extendeds1="<i style='color:#999'>Nill</i>";
                if($extendeds=="-1"){
                    $extendeds1 = "<b style='color:#096; opacity:0.6'>AD Extended</b>";
                }

                if($duration_stamp==0){
                    $c_expirys="<label style='font-weight:normal; font-style:italic; color:#888;'>Not specified</label>";
                }else{
                    $difference = $duration_stamp - $currentTime;
                    $c_expirys = convertTime1($difference);
                    $c_expirys = str_replace("time", "left", $c_expirys);
                }

                if($positns=="Side") $positns="Side Bar";
                else if($positns=="Banner") $positns="Big Banner";

                if($urls=="all") $urls="All Pages";
                else if($urls=="home") $urls="Home Page";
                else if($urls=="contest") $urls="Contest Page";
                else $urls="Entries Page";

                if($files!=""){
                    $files1 = base_url()."adverts1/".$files;
                    $files = "<div class='img_banners'><img src='$files1'></div>";
                }

                if($approved == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                }
                $extend_dur = "<div class='boost_ads'><span con_id='$ids' ad_type='advert' sizes='$sizes' titles='$title' extends1='1'>Extend Duration</span></div>";
                $mypage="edit-adverts";
            }


            $btns1='';
            if($url_task!="sponsored_contests"){
                $btns1 .= '<button class="btns btn-primary btn-lg edit_me mr-sm-10" mypage="'.$mypage.'" captn="0" data-title="Edit" data-toggle="modal" data-target="#myPopup_" id="'.md5($ids).'"><i class="fa fa-pencil"></i> </button>';
            }
        
            $btns1 .= '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';
                

            if($url_task=="contest_leaderboard"){
                $sub_array[] = $pic_path2;
                $sub_array[] = $other_details;
            }


            if($url_task=="entries_leaderboard"){
                $sub_array[] = $pic_path2;
                $sub_array[] = $other_details;
            }

            if($url_task=="view_contests"){
                $sub_array[] = $conts;
                $sub_array[] = $overall_title.$boosts.$enter_codes.$view_codes;
                $sub_array[] = $approved_1;
                $sub_array[] = $close_cons_1;
                $sub_array[] = $media_type;
                $sub_array[] = $all_prizes;
                $sub_array[] = $views;
                $sub_array[] = $entry_type1;
                $sub_array[] = $premium;
                $sub_array[] = $start_date;
                $sub_array[] = $close_date_entry;
                $sub_array[] = $start_date_contest;
                $sub_array[] = $c_expirys;
                $sub_array[] = ucwords($c_expirys1);
                $sub_array[] = $files;
                $sub_array[] = $descrip;
                $sub_array[] = $instructn;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }


            if($url_task=="entry_records"){
                $sub_array[] = $conts;
                if(!is_numeric($url_task1))
                    $sub_array[] = $title;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                $sub_array[] = $views;
                $sub_array[] = $date_created;
                //$sub_array[] = $btns1;
            }


            if($url_task=="sponsored_contests"){
                $sub_array[] = $conts;
                $sub_array[] = $title.$extend_dur;
                $sub_array[] = $approved_1;
                $sub_array[] = "&#8358;".$amt;
                $sub_array[] = $extendeds1;
                $sub_array[] = $response;
                $sub_array[] = $c_expirys;
                $sub_array[] = $duratn;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }


            if($url_task=="votes_recs"){
                $sub_array[] = $conts;
                $sub_array[] = $title;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                $sub_array[] = $vps;
                $sub_array[] = $date_created;
            }

            
            if($url_task=="view_transactions"){
                $sub_array[] = $conts;
                $sub_array[] = "<b>&#8358;".$amts."</b>";
                $sub_array[] = $approved_1;
                $sub_array[] = $acct_no;
                $sub_array[] = $banks;
                $sub_array[] = ucwords($acct_name);
                $sub_array[] = $date_created;
            }


            if($url_task=="transfer_history"){
                $sub_array[] = $conts;
                $sub_array[] = $name_ful;
                $sub_array[] = $name_ful2;
                $sub_array[] = "<font style='font-size: 20px; color: #09C'>&#8358;".$amts."</font>";
                $sub_array[] = $date_created;
            }


            if($url_task=="referral_records"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = $profession;
                $sub_array[] = $date_upgraded;
                $sub_array[] = $date_created;
            }


            if($url_task=="view_adverts"){
                $sub_array[] = $conts;
                $sub_array[] = $title.$extend_dur;
                $sub_array[] = $approved_1;
                $sub_array[] = $sizes;
                $sub_array[] = $c_expirys;
                $sub_array[] = "&#8358;".$amt;
                $sub_array[] = $extendeds1;
                $sub_array[] = ucwords($duration);
                $sub_array[] = $positns;
                $sub_array[] = $urls;
                $sub_array[] = $files;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }

            //$sub_array[] = $btns1;
            $data[] = $sub_array;
            $conts++;
        }

        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data($url_task, $url_task1, $uid, "", ""),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data($url_task, $url_task1, $uid, "", "", ''),
            //"data1"              =>  "sssss",
            "data"              =>  $data
        );
        echo json_encode($output);
    }*/



    public function fetch_records(){
        $url_task = $this->uri->segment(3); // view_customers
        $url_task1 = $this->uri->segment(4);
        //$url_task1="";
        $uid=$this->myID;
        $mypage="";

        //echo $url_task1."== "; echo $url_task; exit;

        $fetch_data = $this->sql_models->make_datatables($url_task, $url_task1, $uid, "", "");
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row){   
            $sub_array = array();
            $ids = $row->id;
            $nows = substr(time(), -5);
            $ids_hash = $ids.$nows;

            if($url_task=="contest_leaderboard"){
                $title = ucwords($row->title);
                $adv_title_f = cleanStr(strtolower($title));
                $contest_lnk = base_url()."$ids_hash/join/$adv_title_f/";
                $media_type = $row->media_type;
                $files = $row->files;
                $views =  kilomega($row->views);
                $entry_type = $row->entry_type;
                $timings = $row->timings;
                $noOfEntries = kilomega($this->sql_models->noOfEntries('entries', $ids));
                $noOfVotes = kilomega($this->sql_models->noOfVotes('entries', $ids, ''));
                if($views>0) $views1 = "$views Views"; else $views1 = "$views View";
                $pic_pathi = base_url()."contest_types/$files";

                $pic_path2 = "<a href='$contest_lnk' class='responsive_img2'><img src='$pic_pathi'></a>";
                //$premium1="";
                if($entry_type=="free" || $entry_type=="") $entry_type1 = "<b>Entry:</b> Free<br>"; else $entry_type1 = "<b>Entry:</b> Paid<br>";

                $currentTime = time();
                $difference = $timings - $currentTime;
                $expirys = convertTime1($difference);

                $other_details = "<p class='const_details'>
                <a href='$contest_lnk'>$title</a><br>
                <b>Views: </b>$views<br>
                $entry_type1
                <b>Expiry: </b>$expirys<br>
                <b>Total Entries: </b>$noOfEntries<br>
                <b>Total Votes: </b>$noOfVotes<br>
                </p>";
            }


            if($url_task=="entry_records"){
                $ids1 = $row->id1;
                $ids2 = $row->id2;
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($names)<=3) $names = $nickname;
                $title = ucwords($row->title);
                $votes = @number_format($row->votes);
                $views =  kilomega($row->views);
                $date_created = @date("jS M, Y h:i a", strtotime($row->date_created));
                $mypage="";
            }


            if($url_task=="vp_market"){
                $ids1 = $row->mem_id;
                $nows = substr(time(), -5);
                //$ids_hash = $ids.$nows;

                $memid_hash = $row->mem_id.$nows;

                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($names)<=3) $names = $nickname;
                $names1 = strtolower(str_replace(" ", "-", $names));
                $vps = @number_format($row->vp);
                $vps_f = $row->vp;
                $phone = $row->phone;
                $emails = $row->emails;
                $pics = $row->pics;
                $sell_at = $row->sell_at;

                $states1 = $this->sql_models->getLocs($row->states, "states");
                $citys1 = $this->sql_models->getLocs($row->citys, "local_governments");

                if($states1!="") $states1 = ", $states1";
                if($citys1!="") $citys1 = "$citys1";

                $locatn = "<b>Location:</b> ".$citys1.$states1;
                
                $acct_details = $row->acct_details;
                $names_lnk = base_url()."profile/$memid_hash/$names1/";

                $pic_pathi = base_url()."profiles1/$pics";
            
                $width1="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);
                if($width1=="" || $width1<=0)
                    $pic_pathi = base_url()."profiles/$pics";

                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);
                if($width1=="" || $width1<=0)
                    $pic_pathi = base_url()."images/no_passport.jpg";

                $pic_path2 = "<a href='$names_lnk' class='responsive_img_circle'><img src='$pic_pathi'></a>";

                $member_info = "<div class='row'>";
                    $member_info .= "<div class='col-md-2'>";
                    $member_info .= $pic_path2;
                    $member_info .= "</div>";

                    $member_info .= "<div class='col-md-10'>";
                    $member_info .= "<b>Name:</b> <a href='$names_lnk'>$names</a><br>$locatn";
                    $member_info .= "</div>";
                $member_info .= "</div>";

                $vp_info = "<b>My VP: $vps</b><br><b>I sell: &#8358;$sell_at</b> for 1VP<br><span class='buy_vp buy_vp_btn' memid='$ids1' mem_names='$names' mem_vp='$vps' mem_vp_f='$vps_f' mem_sellat='$sell_at' mem_email='$emails'>Buy</span>";

                //$date_created = @date("jS M, Y h:i a", strtotime($row->date_created));
                $mypage="";
            }


            if($url_task=="entries_leaderboard"){
                $ids1 = $row->id1;
                $contestant_id = $row->contestant_id;
                $names = ucwords(strtolower($row->names));
                $nickname = ucwords(strtolower($row->nickname));
                $names1 = strtolower($names);
                if(strlen($names1)<=2) $names1 = strtolower($nickname);
                if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
                $names1 = str_replace(" ", "-", $names1);
                $memid_hash = $row->memid.$nows;
                $names_lnk = base_url()."profile/$memid_hash/$names1/";
                $profession = ucwords($row->profession);
                $files = $row->pics;
                $con_ids = $row->contest_id;
                $pviews = kilomega($row->views);
                $noOfEntries = $this->sql_models->noOfEntriesParticipated('entries', $contestant_id);
                $getContestName = ucwords(strtolower($this->sql_models->getContestName($con_ids)));
                $noOfVotes = $this->sql_models->myTotalVotes('entries', $contestant_id, $con_ids);
                //$noOfVotes = $contestant_id;
                if($noOfEntries>0) $noOfEntries1 = "$noOfEntries Contests so far"; else $noOfEntries1 = "$noOfEntries Contest so far";
                $citys = $row->citys1;
                $states = $row->states1;
                $locs_full = "$citys, $states";

                $pic_pathi = base_url()."profiles1/$files";
                if($files=="") $pic_pathi = base_url()."images/no_passport.jpg";

                $pic_path2 = "<div class='flexit'><a href='$names_lnk' class='responsive_img2'><img src='$pic_pathi'></a></div>";

                $names = "$names ($nickname)";

                $getBoosted = $this->sql_models->fetchBoosted($con_ids, $contestant_id);
                $boosteds="";
                if($getBoosted>0){
                    $boosteds = "(".@number_format($getBoosted)." Boosted)";
                }

                $other_details = "<p class='const_details'>
                <a href='$names_lnk'>$names</a><br>
                <b style='font-size: 17px; color:#09C;'>".@number_format($noOfVotes)." votes $boosteds</b><br>
                <b>Contest: </b>$getContestName<br>
                <b>Profession: </b>$profession<br>
                <b>Profile Views: </b>$pviews<br>
                <b>Location: </b>$locs_full<br>
                <b>Participated On </b>$noOfEntries1<br>
                </p>";
            }



            if($url_task=="view_contests"){
                $approved = $row->approved;
                $overall_title = ucwords($row->title);
                $media_type = $row->media_type;
                $descrip = $row->descrip;
                $files = $row->files;
                $prize1 = @number_format($row->price1);
                $prize2 = @number_format($row->price2);
                $prize3 = @number_format($row->price3);
                $gift1 = ucwords($row->add_price1);
                $gift2 = ucwords($row->add_price2);
                $gift3 = ucwords($row->add_price3);
                $instructn = $row->instructions;
                $views = $row->views;
                $paids = $row->paids;
                $entry_type = $row->entry_type;
                $entry_fee = $row->entry_fee;
                $sponsoredby = $row->sponsoredby;
                $start_date1 = strtotime($row->start_date);
                $start_date2 = @date("jS M, Y", $start_date1);
                if($row->close_date_entry!="")
                    $close_date_entry = @date("D jS M, Y h:ia", strtotime($row->close_date_entry));
                else
                    $close_date_entry = "<i>Not Specified</i>";

                if($row->start_date_contest!="")
                    $start_date_contest = @date("D jS M, Y h:ia", strtotime($row->start_date_contest));
                else
                    $start_date_contest = "<i>Not Specified</i>";

                $c_expirys = @date("D jS M, Y h:ia", $row->timings);
                $premium = strtoupper($row->premium);
                $premium1 = $premium;
                $completed = $row->completed;
                $date_created = $row->date_created;
                $start_date = $row->start_date;
                $mypage="edit-contest";

                $id_harsh = $ids.substr(time(), -5);

                $hasBoost = $this->sql_models->hasBoost($ids);
                if($hasBoost){
                    $boosts = "<div class='boost_ads1'><span style='opacity:0.5'>Boosted</span></div>";
                }else{
                    $boosts = "<div class='boost_ads'><span con_id='$ids' ad_type='contests' sizes='1360x510' extends1='' titles='$overall_title'>Boost This</span></div>";
                }
                $boosts .= "<div style='margin:12px 0 5px 0;'><a href='".base_url()."dashboard/".$id_harsh."/entry-records/'>VIEW ENTRIES</span></div>";

                if($start_date!="")
                    $start_date = date("D jS M, Y h:ia", strtotime($start_date));
                else
                    $start_date = "Not specified";

                if($files!=""){
                    $files1 = base_url()."contest_types/".$files;
                    $files = "<div class='img_banners'><img src='$files1'></div>";
                }

                $currentTime = time();
                $difference = $row->timings - $currentTime;

                if($start_date1 <= $currentTime){
                    $c_expirys1 = convertTime1($difference);
                    $c_expirys1 = str_replace("time", "", $c_expirys1);
                }else{
                    //$c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    $difference = $row->timings - strtotime($row->start_date_contest);
                    $c_expirys1 = convertTime1($difference);
                    $c_expirys1 = ucwords(str_replace("time", "", $c_expirys1));
                }

                $dates = date("D jS M Y h:ia", strtotime($date_created));

                if($media_type=="vid") $media_type="Video Upload"; else $media_type="Photo Upload";

                $hasCodes = $this->sql_models->hasCodes($ids);
                $view_codes="";$enter_codes="";

                if($premium=="FREE" || $premium==""){
                    $premium="FREE VOTE";
                }else if($premium=="FREE_PAID"){
                    $premium="FREE & BOOST VOTE";
                }else{
                    $premium="BOOST VOTE";

                    $enter_codes="<div style='line-height: 27px;'><span style='margin-top:4px; display:inline-block' class='enter_codes' contest_id='$ids' edits=''>Enter Codes</span>";
                    if($hasCodes) $view_codes = "<br><span class='view_codes' contest_id='$ids' edits='1'>View Codes</span></div>";
                }

                if($prize1!="") $prize1 = "<p><b>First Prize: &#8358;$prize1</b><br>$gift1</p>";
                if($prize2!="") $prize2 = "<p><b>First Prize: &#8358;$prize2</b><br>$gift2</p>";
                if($prize3!="") $prize3 = "<p><b>First Prize: &#8358;$prize3</b><br>$gift3</p>";

                if($entry_fee!="") $entry_fee="&#8358;$entry_fee";

                if($entry_type=="paid")
                    $entry_type1 = "<p><b>Entry Type: ".strtoupper($entry_type)."</b><br>$entry_fee</p>";
                else if($entry_type=="coded")
                    $entry_type1 = "<p><b>Entry Type: CODED</p>";
                else
                    $entry_type1 = "<p><b>Entry: FREE</b></p>";

                $all_prizes = "<div class='img_prizes'>
                $prize1 $prize2 $prize3 
                </div>";

                $hasEntries = $this->sql_models->hasEntries($ids);

                if($this->myID>0 && $this->my_mem_type=="spon"){
                    if($approved == 1){
                        $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                    }
                }else{
                    if($approved == 1){
                        $approved_1 = "<font id='approve_it' caps='Approved' table='contests' colums='approved' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font id='approve_it' caps='Not Approved' table='contests' colums='approved' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                    }
                }

                //$approved_1 .= "<div style='margin:12px 0 5px 0;'><a href='".base_url()."dashboard/".$id_harsh."/entry-records/'>NOT PAID</span></div>";

                if(!isset($paids) || $paids<=0){
                    $approved_1 .= "<div class='lnk_btns lnk_btns1 pay_for_contest'><span con_id='$ids' titles='$overall_title' premium1='$premium1'>NOT PAID</span></div>";
                }else{
                    $approved_1 .= "<div class='lnk_btns'><span con_id='$ids' titles='$overall_title'>PAID &#8358;".@number_format($paids)."</span></div>";
                }

                if($completed == 0){
                    if($hasEntries){
                        $close_cons_1 = "<font id='approve_it' caps='Open' table='contests' colums='completed' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#fff; font-size:15px; cursor:pointer; background:#008C46; padding:3px 15px'><b>Open</b></font>";
                    }else{
                        $close_cons_1 = "<font id='approve_status_not' caps='Open' table='contests' colums='completed' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#063; font-size:15px; cursor:pointer; opacity:0.5;'><b>Open</b></font>";
                    }
                }else{
                    $close_cons_1 = "<font id='approve_status_' caps='Closed' table='contests' colums='completed' duratn='' aparams='' class='approve_status_c approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Completed</b></font>";
                }
            }


            if($url_task=="sponsored_contests"){
                $id1 = $row->id1;
                $paid = $row->paid;
                $title = ucwords($row->title);
                $amt = @number_format($row->amt);
                $response = $row->response;
                $duratn = $row->duratn;
                $extendeds = $row->extendeds;
                $date_created = $row->date_created;
                $start_date1 = strtotime($row->start_date);
                $start_date2 = @date("jS M, Y", $start_date1);
                
                $currentTime = time();
                $difference = $row->timings - $currentTime;

                if($start_date1 <= $currentTime){
                    $c_expirys = convertTime1($difference);
                    $c_expirys = str_replace("time", "left", $c_expirys);
                }else{
                    //$c_expirys = "<font style='opacity: 0.8'>Coming on $start_date2!</font>";
                    $difference = $row->timings - strtotime($row->start_date);
                    $c_expirys = convertTime1($difference);
                    $c_expirys = ucwords(str_replace("time", "", $c_expirys));
                }

                $dates = date("D jS M Y h:ia", strtotime($date_created));

                $extendeds1="<i style='color:#999'>Nill</i>";
                if($extendeds=="-1"){
                    $extendeds1 = "<b style='color:#096; opacity:0.6'>AD Extended</b>";
                }

                if($paid == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px;'><b>PAID</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15.5px; line-height:16px !important'><b>NOT PAID</b></font>";
                }
                $extend_dur = "<div class='boost_ads'><span con_id='$id1' ad_type='contests' sizes='1360x510' titles='$title' extends1='1'>Extend Duration</span></div>";
            }


            if($url_task=="referral_records"){
                $names = ucwords($row->names);
                $profession = ucwords($row->profession);
                $date_upgraded = date("D jS M Y h:ia", strtotime($row->date_upgraded));
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
            }


            if($url_task=="view_transactions"){
                $amts = @number_format($row->amt);
                $acct_no = $row->acct_no;
                $banks = $row->banks;
                $acct_name = $row->acct_name;
                $answered = $row->answered;
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));

                if($answered == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                }
            }


            if($url_task=="transfer_history"){
                $amts = @number_format($row->amount);
                $sender_id = $row->mid;
                $rec_id = $row->mid2;

                if($sender_id == $this->myID){
                    $name_ful = "<b>You</b>";
                }else{
                    $name_sender = ucwords($row->name_sender);
                    $nickname_sender = ucwords($row->nickname_sender);
                    $name_ful = "$name_sender ($nickname_sender)";
                }

                if($rec_id == $this->myID){
                    $name_ful2 = "<b>You</b>";
                }else{
                    $names = ucwords($row->names);
                    $nickname = ucwords($row->nickname);
                    $name_ful2 = "$names ($nickname)";
                }
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
            }

            
            if($url_task=="votes_recs"){
                $ids1 = $row->id1; // memid
                $con_ids = $row->id2; // conid

                $title = ucwords($row->title);

                $getBoosted = $this->sql_models->fetchBoosted($con_ids, $ids1);
                $boosteds="";
                if($getBoosted>0){
                    $boosteds=" <font style='font-size:14px; font-weight:600;'>(Boosted ".@number_format($getBoosted).")</font>";
                }

                $votes = $row->votes.$boosteds;
                $date_created = @date("jS M, Y h:i a", $row->timings);
            }


            /*if($url_task=="who_voted"){
                $ids1 = $row->id1;
                $names = ucwords($row->names);
                $names1 = strtolower($names);
                $names1 = str_replace(" ", "-", $names1);
                //$memid_hash = $row->id1.$nows;
                $title = ucwords($row->title);
                $votes = $row->votes;
                //$vps = $row->vp;
                $date_created = $row->date_created;
                //$date_created = @date("jS M, Y h:i a", $row->timings);
            }*/


            if($url_task=="view_adverts"){
                $ids1 = $row->id;
                $title = ucwords($row->title);
                $approved = $row->approved;
                $extendeds = $row->extendeds;
                $sizes = $row->sizes;
                $positns = ucwords($row->positns);
                $duration = ucwords($row->duration);
                $urls = $row->urls;
                $files = $row->files;
                $amt = @number_format($row->amt);
                $date_created = $row->date_created;
                $date_created = @date("jS M, Y h:i a", strtotime($date_created));
                $duration_stamp = $row->duration_stamp;
                $currentTime = time();

                $extendeds1="<i style='color:#999'>Nill</i>";
                if($extendeds=="-1"){
                    $extendeds1 = "<b style='color:#096; opacity:0.6'>AD Extended</b>";
                }

                if($duration_stamp==0){
                    $c_expirys="<label style='font-weight:normal; font-style:italic; color:#888;'>Not specified</label>";
                }else{
                    $difference = $duration_stamp - $currentTime;
                    $c_expirys = convertTime1($difference);
                    $c_expirys = str_replace("time", "left", $c_expirys);
                }

                if($positns=="Side") $positns="Side Bar";
                else if($positns=="Banner") $positns="Big Banner";

                if($urls=="all") $urls="All Pages";
                else if($urls=="home") $urls="Home Page";
                else if($urls=="contest") $urls="Contest Page";
                else $urls="Entries Page";

                if($files!=""){
                    $files1 = base_url()."adverts1/".$files;
                    $files = "<div class='img_banners'><img src='$files1'></div>";
                }

                if($approved == 1){
                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                }
                $extend_dur = "<div class='boost_ads'><span con_id='$ids' ad_type='advert' sizes='$sizes' titles='$title' extends1='1'>Extend Duration</span></div>";
                $mypage="edit-adverts";
            }


            $btns1='';
            if($url_task!="sponsored_contests"){
                $btns1 .= '<button class="btns btn-primary btn-lg edit_me mr-sm-10" mypage="'.$mypage.'" captn="0" data-title="Edit" data-toggle="modal" data-target="#myPopup_" id="'.md5($ids).'"><i class="fa fa-pencil"></i> </button>';
            }
        
            $btns1 .= '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';
                

            if($url_task=="contest_leaderboard"){
                $sub_array[] = $pic_path2;
                $sub_array[] = $other_details;
            }


            if($url_task=="entries_leaderboard"){
                $sub_array[] = $pic_path2;
                $sub_array[] = $other_details;
            }

            if($url_task=="view_contests"){
                $sub_array[] = $conts;
                $sub_array[] = $overall_title.$boosts.$enter_codes.$view_codes;
                $sub_array[] = $approved_1;
                $sub_array[] = $close_cons_1;
                $sub_array[] = $media_type;
                $sub_array[] = $all_prizes;
                $sub_array[] = $views;
                $sub_array[] = $entry_type1;
                $sub_array[] = $premium;
                $sub_array[] = $sponsoredby;
                $sub_array[] = $start_date;
                $sub_array[] = $close_date_entry;
                $sub_array[] = $start_date_contest;
                $sub_array[] = $c_expirys;
                $sub_array[] = ucwords($c_expirys1);
                $sub_array[] = $files;
                $sub_array[] = $descrip;
                $sub_array[] = $instructn;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }



            if($url_task=="vp_market"){
                $sub_array[] = $member_info;
                $sub_array[] = $vp_info;
                //$sub_array[] = $btns1;
            }


            if($url_task=="entry_records"){
                $sub_array[] = $conts;
                if(!is_numeric($url_task1))
                    $sub_array[] = $title;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                $sub_array[] = $views;
                $sub_array[] = $date_created;
                //$sub_array[] = $btns1;
            }


            if($url_task=="sponsored_contests"){
                $sub_array[] = $conts;
                $sub_array[] = $title.$extend_dur;
                $sub_array[] = $approved_1;
                $sub_array[] = "&#8358;".$amt;
                $sub_array[] = $extendeds1;
                $sub_array[] = $response;
                $sub_array[] = $c_expirys;
                $sub_array[] = $duratn;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }


            if($url_task=="votes_recs"){
                $sub_array[] = $conts;
                $sub_array[] = $title;
                //$sub_array[] = $names;
                $sub_array[] = $votes;
                //$sub_array[] = $vps;
                $sub_array[] = $date_created;
            }


            /*if($url_task=="who_voted"){
                $sub_array[] = $conts;
                $sub_array[] = $title;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                //$sub_array[] = $vps;
                $sub_array[] = $date_created;
            }*/

            
            if($url_task=="view_transactions"){
                $sub_array[] = $conts;
                $sub_array[] = "<b>&#8358;".$amts."</b>";
                $sub_array[] = $approved_1;
                $sub_array[] = $acct_no;
                $sub_array[] = $banks;
                $sub_array[] = ucwords($acct_name);
                $sub_array[] = $date_created;
            }

            if($url_task=="transfer_history"){
                $sub_array[] = $conts;
                $sub_array[] = $name_ful;
                $sub_array[] = $name_ful2;
                $sub_array[] = "<font style='font-size: 20px; color: #09C'>&#8358;".$amts."</font>";
                $sub_array[] = $date_created;
            }


            if($url_task=="referral_records"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = $profession;
                $sub_array[] = $date_upgraded;
                $sub_array[] = $date_created;
            }


            if($url_task=="view_adverts"){
                $sub_array[] = $conts;
                $sub_array[] = $title.$extend_dur;
                $sub_array[] = $approved_1;
                $sub_array[] = $sizes;
                $sub_array[] = $c_expirys;
                $sub_array[] = "&#8358;".$amt;
                $sub_array[] = $extendeds1;
                $sub_array[] = ucwords($duration);
                $sub_array[] = $positns;
                $sub_array[] = $urls;
                $sub_array[] = $files;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }

            //$sub_array[] = $btns1;
            $data[] = $sub_array;
            $conts++;
        }

        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data($url_task, $url_task1, $uid, "", ""),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data($url_task, $url_task1, $uid, "", "", ''),
            //"data1"              =>  "sssss",
            "data"              =>  $data
        );
        echo json_encode($output);
    }



    function sortDate(){ //view_sales
        $url_task = $this->uri->segment(3); // view_customers
        $url_task1="";
        $uid="";
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        //echo $url_task; exit;
        $fetch_data = $this->sql_models->make_datatables($url_task, $url_task1, $uid, $start_date, $end_date);

        $data = array();
        $conts = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $ids = $row->id;
            $nows = substr(time(), -5);
            $ids1 = $row->id1;
            $names = ucwords(strtolower($row->names));
            $nickname = ucwords(strtolower($row->nickname));
            $names1 = strtolower($names);
            if(strlen($names1)<=2) $names1 = strtolower($nickname);
            if(strlen($names)<=2) $names = ucwords(strtolower($nickname));
            $names1 = str_replace(" ", "-", $names1);
            $memid_hash = $row->id1.$nows;
            $names_lnk = base_url()."profile/$memid_hash/$names1/";
            $profession = ucwords($row->profession);
            $files = $row->pics;
            $pviews = kilomega($row->views);
            $contestids = $row->contest_id;
            $voters = $row->voter;

            $noOfEntries = $this->sql_models->noOfEntriesParticipated('entries', $ids1);
            //$noOfVotes = @number_format($row->votes);
            $noOfVotes = @number_format($this->sql_models->noOfVotes('all_votes', $ids1, ''));
            if($noOfEntries>0) $noOfEntries1 = "$noOfEntries Contests so far"; else $noOfEntries1 = "$noOfEntries Contest so far";

            $online_timing = date("Y-m-d g:i a", $row->online_timing);
            $online_time = time_ago($online_timing);

            $mystatus = $this->sql_models->chkOnlinePresence($ids1);
            $chechOnlineHidden = $this->sql_models->chechOnlineHidden($ids1);

            $last_seen="<span style='color:#666 !important; font-size:15px;'>offline</span>";
            if($mystatus=="ash"){
                if(strtotime($online_timing)>0){
                    if($chechOnlineHidden) // visible
                        $last_seen="<span style='color:#666!important; font-size:15px;'>Last Seen: $online_time</span>";
                    else
                        $last_seen="<span style='color:#666 !important; font-size:15px;'>hidden</span>";
                }
            }


            $ffs = base_url()."profiles/$files";
            $ffs1 = "profiles1/$files";
            $ffs_wm = base_url()."images/logo_watermark.png";
            watermark_image($ffs, $ffs_wm, $ffs1);

            $pic_pathi = base_url()."profiles1/$files";
            
            $width1="";
            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);
            if($width1=="" || $width1<=0)
                $pic_pathi = base_url()."profiles/$files";

            list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);
            if($width1=="" || $width1<=0)
                $pic_pathi = base_url()."images/no_passport.jpg";

            if($files=="") $pic_pathi = base_url()."images/no_passport.jpg";

            $pic_path2 = "<a href='$names_lnk' class='responsive_img2'><img src='$pic_pathi'></a>";
            $names = "$names ($nickname)";

            $getBoosted = $this->sql_models->fetchVoterBoosted($voters, $contestids, $ids1);
            $contest_name = ucwords(strtolower($this->sql_models->getContestName($contestids)));

            $ids_hash = $contestids.$nows;
            $adv_title_f = cleanStr(strtolower($contest_name));

            $contest_names = '<a style="font-weight:normal; font-size: 16.5px;" href="'.base_url().$ids_hash.'/join/'.$adv_title_f.'/" >'.$contest_name.'</a>';
            
            $boosteds="";
            /*if($getBoosted>0){
                $boosteds = "<font style='font-weight: 600; font-size:14px'>(".@number_format($getBoosted)." Boosted)</font>";
            }*/

            $profession1="";
            if($profession!=""){
                $profession1 = "<b>Profession: </b>$profession<br>";
            }

            $other_details = "<p class='const_details'>
            <a href='$names_lnk'>$names</a><br>
            $last_seen<br>
            <b>Votes: </b>$noOfVotes $boosteds<br>
            $profession1
            <b>Profile Views: </b>$pviews<br>
            <b>Contest: </b>$contest_names<br>
            </p>";
            //<b>Participated On: </b>$noOfEntries1<br>
            
            //$sub_array[] = $conts;
            $sub_array[] = $pic_path2;
            $sub_array[] = $other_details;
            $data[] = $sub_array;
            $conts++;
        }

        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data($url_task, $url_task1, $uid, "", ""),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data($url_task, $url_task1, $uid, "", "", ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }



    function fetch_tickets(){
        $txtmem = $this->uri->segment(3);
        $msg_types = $this->uri->segment(4);
        $fetch_data = $this->sql_models->make_datatables('support', $msg_types, $txtmem, "", "");
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $id = $row->id1;
            //$sent_from = $row->sent_from;
            $memid1 = $row->user_id;
            $names = $row->names;
            $subj = ucfirst($row->subj);
            $message = $row->message;
            $message_1 = nl2br($message);
            $subj1 = base64_encode($subj);
            $message1 = base64_encode($message_1);
            $has_read = $row->has_read;
            $dates = $row->date_posted;
            $dates = date("D jS M, Y h:ia", strtotime($dates));
            if(strlen($message)>100)
                $message = substr($message, 0, 100)."...";

            if($msg_types=="inbox"){
                if($memid1 == $this->myID)
                    $names1 = "Admin";
                else
                    $names1 = ucwords($names);

            }else{ // sent

                // if($sent_from == $this->myID)
                //     $names1 = "Admin";
                // else
                    //$names1 = ucwords($names);

                $names1 = "Admin";
            }

            //$names1="";


            $has_read1 = "";
            if($has_read == 1){
                $has_read1 .= "<i style='color:#999; font-size:14px;' class='php_read$id'>Read</i>";
            }else{
                $has_read1 .= "<font style='color:#090; font-size:13px;' class='php_read$id'><b>New Message</b></font>";
            }
            $has_read1 .= "<i style='color:#999; font-size:14px; display:none;' class='java_read$id'>Read</i>";

            $sub_array[] = $names1;
            if($msg_types=="inbox")
                $sub_array[] = $has_read1;
            $sub_array[] = "<span data-toggle='modal' class='open_message' subj='$subj1' msgs='$message1' msg_id='$id' memid1='0' sent_from='$this->myID' myname='$names1' mydate='$dates'>$subj</span>";

            $sub_array[] = "<span data-toggle='modal' class='open_message' subj='$subj1' msgs='$message1' msg_id='$id' memid1='0' sent_from='$this->myID' myname='$names1' mydate='$dates'>$message</span>";
            $sub_array[] = $dates;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data('support', $msg_types, $txtmem, "", ""),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data('support', $msg_types, $txtmem, '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }


    function fetch_announce(){
        $txtmem = $this->uri->segment(3);
        $fetch_data = $this->sql_models->make_datatables('announcement', "", $txtmem, "", "");
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $id = $row->id1;
            $memid1 = $row->user_id;
            $names = $row->names;
            $nickname = $row->nickname;
            if(strlen($names)<2) $names=$nickname;
            $subj = ucfirst($row->subj);
            $message = $row->message;
            $message_1 = nl2br($message);
            $subj1 = base64_encode($subj);
            //$message1 = base64_encode($message_1);
            $has_read = $row->has_read;
            $dates = $row->date_posted;
            $dates = date("D jS M, Y h:ia", strtotime($dates));
            //if(strlen($message)>100)
                //$message = substr($message, 0, 100)."...";

            $has_read1 = "";
            if($has_read == 1){
                $has_read1 .= "<i style='color:#999; font-size:14px;' class='php_read$id'>Read</i>";
            }else{
                $has_read1 .= "<font style='color:#090; font-size:13px;' class='open_announce php_read$id' ids='$id'><b>New Message</b></font>";
            }
            $has_read1 .= "<i style='color:#999; font-size:14px; display:none;' class='java_read$id'>Read</i>";

            $sub_array[] = $has_read1;
            $sub_array[] = $subj;
            $sub_array[] = ucfirst($message_1);
            $sub_array[] = $dates;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models->get_all_data('announcement', "", $txtmem, "", ""),
            "recordsFiltered"   =>  $this->sql_models->get_filtered_data('announcement', "", $txtmem, '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }




    public function set_upload_options($file_path) {
        // upload an image options
        $config = array();
        $config ['upload_path'] = $file_path;
        $config['allowed_types'] = "*";
        $config['max_size'] = '3072'; // 0 = no file size limit
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['overwrite'] = FALSE;
        return $this->load->library('upload', $config);
        //return $config;
    }



    function logouts(){
        /// this session below is for facebook login
        $txt_contestID = $this->input->post('txt_contestID');
        $txt_ad_name = $this->input->post('txt_ad_name');
        $txt_other_params3 = $this->input->post('txt_other_params3');

        $this->retain_page_id($txt_contestID, $txt_ad_name, $txt_other_params3);

        $noConnection=""; $noConnection1="";
        if (@fopen("https://facebook.com", "r")){ // if connection
            require APPPATH . "views/fb-init.php";
            unset($_SESSION['myaccess_tokens']);
        }

        if (@fopen("https://twitter.com", "r")){ // if connection
            require APPPATH . "views/twi-init.php";
            unset($_SESSION['twitter_access_token']);
        }
        session_destroy();
        /// this session below is for facebook login

        $cookie = array(
            'name'   => 'icont_uname',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        $cookie1 = array(
            'name'   => 'icont_pass',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        delete_cookie($cookie);
        delete_cookie($cookie1);
        redirect('register');
    }




    function logme_adms(){
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('pass', 'password', 'required|trim');
        $txtselect = $this->input->post('txtselect');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $is_correct_id = $this->sql_models->auth_details(strtolower($this->input->post('username')), strtolower($this->input->post('pass')), $txtselect);

            if($is_correct_id){
                echo "successor1";
            }else{
                echo "Invalid details entered!";
            }
        }
    }




}






