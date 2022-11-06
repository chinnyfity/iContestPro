<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start();

class Shields extends CI_Controller {

        public $xauth;
        public $showname;

        public function __construct(){
            parent::__construct();

            $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie', 'file'));
            $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'excel'));
            $this->perPage = 25;
            $this->load->model('sql_models');
            $this->load->model('sql_models_adm');
            @date_default_timezone_set('Africa/Lagos');

            if(!$this->sql_models->validate_adminx()){
                $this->xauth = 0;
            }else{
                $this->xauth = 1;
            }


            function convertTime($difference){
                //Calculate how many days are within $difference
                $days = intval($difference / 86400); 
                //$days = round($difference / 86400); 
                //Keep the remainder
                $difference = $difference % 86400;
                //Calculate how many hours are within $difference 
                $hours = intval($difference / 3600)+($days*24); 
                //Keep the remainder
                $difference = $difference % 3600;
                //Calculate how many minutes are within $difference 
                $minutes = intval($difference / 60); 
                //Keep the remainder
                $difference = $difference % 60;
                //Calculate how many seconds are within $difference 
                $seconds = intval($difference); 
                //return "Days: ".$days."<br> Hours: ".$hours."<br> Minutes: ".$minutes."<br> Seconds: ".$seconds."<br>";
                //return $hours." hours, ".$minutes." mins more";
                return ($days);
            }


            function convertTime1($difference){
                $days = intval($difference / 86400); 
                $difference = $difference % 86400;
                $hours = intval($difference / 3600)+($days*24); 
                $difference = $difference % 3600;
                $minutes = intval($difference / 60); 
                $difference = $difference % 60;
                $seconds = intval($difference); 
                $check_zero = $days;
                if($check_zero<=0 && $hours>0)
                    return ("$hours hrs, $minutes mins time");
                else if($check_zero<=0 && $hours<=0)
                    return ("<font style='color:#FF4040'>Expired</font>");
                else
                    return ("$days days time");
            }


            function kilomega( $val ) {
                if( $val < 1000 ) return $val;
                $val = round((float)($val/1000),1);
                if( $val < 1000 ) return "${val}k";
                $val = round((float)($val/1000),1);
                return "${val}m";
            }


            function time_ago($date){
                $periods=array("sec","min","hr","day","week","month","year","decade");
                $lengths=array("60","60","24","7","4.35","12","10");
                $now=time();
                @$mydate=strtotime($date);
                if($now>$mydate){
                    $difference=$now-$mydate;
                    $tense="ago";
                }else{
                    $difference=$mydate-$now;
                    $tense="from now";
                }
                for($j=0; $difference>=$lengths[$j] && $j<count($lengths)-1; $j++){
                    $difference/=$lengths[$j];
                }
                $difference=intval($difference);
                    //$difference=round($difference,PHP_ROUND_HALF_DOWN);
                if($difference!=1){
                    $periods[$j].='s';
                }
                return "$difference $periods[$j] {$tense}";
            }


            function cleanStr($string) {
               $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
               return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            }


            $this->myID=0;
            $this->imgs1 = base_url()."images/no_passport.jpg";
            $this->unread_msg = $this->sql_models->getUnreadMsgCount($this->myID);
            $this->pending_wallet = $this->sql_models->getPendWalletCount();
            $this->pending_withdraw = $this->sql_models->getPendDrawCount();
            $this->getPendingTotal = $this->sql_models->getPendingTotal();
            
            $adminSettings = $this->sql_models->adminSettings();
            $this->entry_fee = $adminSettings['entry_fee'];
            $this->paid_votes = $adminSettings['paid_votes'];
            $this->paid_votes2 = $adminSettings['paid_votes2'];
            $this->paid_votes3 = $adminSettings['paid_votes3'];
            $this->withdraw_fee = $adminSettings['withdraw_fee'];
            $this->transfer_fee = $adminSettings['transfer_fee'];
            $this->be_a_sponsor = $adminSettings['be_a_sponsor'];
            $this->give_referral = $adminSettings['give_referral'];
            $this->cash_back = $adminSettings['cash_back'];
            $this->contest_fee = $adminSettings['contest_fee'];
            $this->contest_fee2 = $adminSettings['contest_fee2'];
            $this->contest_fee3 = $adminSettings['contest_fee3'];
            $this->flutterwave = $adminSettings['flutterwave'];
            $this->admin_wallet = $adminSettings['admin_wallet'];


            $this->size250_1=0;$this->size250_2=0;$this->size250_3=0;$this->size780_1=0;
            $this->size780_2=0;$this->size780_3=0;$this->size300_1=0;$this->size300_2=0;
            $this->size300_3=0;$this->size1360_1=0;$this->size1360_2=0;$this->size1360_3=0;
            $admAdvSets = $this->sql_models->adminAdvSettings();
            if($admAdvSets){
                $this->size250_1 = $admAdvSets[0]['fees'];
                $this->size250_2 = $admAdvSets[1]['fees'];
                $this->size250_3 = $admAdvSets[2]['fees'];

                $this->size780_1 = $admAdvSets[3]['fees'];
                $this->size780_2 = $admAdvSets[4]['fees'];
                $this->size780_3 = $admAdvSets[5]['fees'];

                $this->size300_1 = $admAdvSets[6]['fees'];
                $this->size300_2 = $admAdvSets[7]['fees'];
                $this->size300_3 = $admAdvSets[8]['fees'];

                $this->size1360_1 = $admAdvSets[9]['fees'];
                $this->size1360_2 = $admAdvSets[10]['fees'];
                $this->size1360_3 = $admAdvSets[11]['fees'];
            }


            
        }



    public function login(){
        $data['page_name'] = "login";
        $data['page_title'] = "Login";
        if(!$this->xauth){
            $this->load->view("shields/login", $data);
        }else{
            redirect('shields/');
        }
    }



    public function index(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_title'] = "Administrator";
        $data['page_name'] = "";
        $data['header_names'] = "Administrator";
        $ipaddrs = $_SERVER['REMOTE_ADDR'];
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $sorts = $this->input->cookie('sorts', TRUE);
        $data['contests'] = $this->sql_models->fetchRecs('contests', '', '', '', 6, '');
        //$data['mywallet'] = $this->sql_models->adminWallet();
        $data['reg_mem_cnt'] = $this->sql_models->calCounts('members', '', '', '');
        $data['adv_cnt'] = $this->sql_models->calCounts('adverts', '', '', '');
        $data['tickets'] = $this->sql_models->calCounts('support', '', '', '');
        $data['votes_cnt'] = $this->sql_models->allVotes();
        $data['contests_cnt'] = $this->sql_models->calCounts('contests', '', '', 'admin');
        $data['cur_contestants_cnt'] = $this->sql_models->calCounts('entries', 'contestant_id', 'members', '');
        $data['winners_cnt'] = $this->sql_models->calCounts('winners', '', '', '');
        $data['media_cnt'] = $this->sql_models->calCounts('entry_media', '', '', '');
        $data['sponsoreds'] = $this->sql_models->calCounts_bst('boost_ads');
        $data['latest_conts'] = $this->sql_models->latestContests(5);
        $data['new_msg'] = $this->sql_models->fetchMsgs();
        $data['vote_logs'] = $this->sql_models->voteLogs('');
        $data['adverts'] = $this->sql_models->fetchAdminAds();
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function sponsor(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "sponsor";
        $data['header_names'] = "SPONSORSHIP";
        $data['page_title'] = "Sponsorship ";
        // $data['unread_msg'] = $this->unread_msg;
        //$data['states1'] = $this->sql_models->fetchStates();
        //$data['city1'] = $this->sql_models->fetchCitys($this->states);
        $data['datamsg'] = "You have upgraded to becoming a sponsor. Your details will be approved shortly. Thank You!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function members(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "members";
        $data['header_names'] = "VIEW MEMBERS";
        $data['page_title'] = "View Members ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    /*public function upload_contest(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "upload_contest";
        $data['header_names'] = "UPLOAD CONTEST";
        $data['page_title'] = "Upload Contest ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "You have successfully uploaded a contest. It will await for approval!";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }*/



    public function view_contests(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "view_contests";
        $data['header_names'] = "VIEW CONTESTS";
        $data['page_title'] = "View Contests ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "Contest codes have been entered!";
        $data['datamsg1'] = "Congratulations! Your AD is been submitted for boosting!";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function referral_network(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "referral_network";
        $data['header_names'] = "VIEW REFERRAL NETWORK";
        $data['page_title'] = "View Referral Network ";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }

    
    public function member_wallets(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "member_wallets";
        $data['header_names'] = "VIEW MEMBER WALLETS";
        $data['page_title'] = "View Members Wallets ";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function withdrawal_request(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "withdrawal_request";
        $data['header_names'] = "VIEW WITHDRAWAL REQUESTS";
        $data['page_title'] = "View Withdrawal Requests ";
        $data['contests'] = "";
        $data['datamsg'] = "User has been credited and deducted from his wallet!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function transaction_reports(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "transaction_reports";
        $data['header_names'] = "TRANSACTION REPORTS";
        $data['page_title'] = "Transaction Reports ";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function sponsored_contests(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "sponsored_contests";
        $data['header_names'] = "VIEW SPONSORED CONTESTS";
        $data['page_title'] = "View Sponsored Contests ";
        $data['contests'] = "";
        $data['datamsg'] = "This contest has been sponsored!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    
    public function edit_contest(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_contest";
        $data['header_names'] = "EDIT CONTESTS";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'contests');
        $ctitles = ucwords($data['getId']['title']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "Contest has been updated!";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function votes_recs(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "votes_recs";
        $data['header_names'] = "VIEW VOTES";
        $data['page_title'] = "View Votes ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function adverts(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "adverts";
        $data['header_names'] = "ADVERTISE BUSINESS";
        $data['page_title'] = "Advertise Business ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "Your Advert Has Been Submitted";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    
    public function view_adverts(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "view_adverts";
        $data['header_names'] = "VIEW ADS";
        $data['page_title'] = "View Ads ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    
    public function edit_advert(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_advert";
        $data['header_names'] = "EDIT YOUR ADVERT";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'adverts');
        $ctitles = ucwords($data['getId']['title']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "The Advert has been edited and approved!";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function upload_blog(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "upload_blog";
        $data['header_names'] = "UPLOAD ARTICLE";
        $data['page_title'] = "Upload Article ";
        $data['contests'] = "";
        $data['datamsg'] = "An Article Has Been Submitted";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function admin_wallet(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "admin_wallet";
        $data['header_names'] = "TRANSFER MONEY TO A MEMBER";
        $data['page_title'] = "Transfer Money ";
        $data['contests'] = "";
        $data['datamsg'] = "You have successfully transferred money";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function transfer_history(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "transfer_history";
        $data['header_names'] = "TRANSFER HISTORY";
        $data['page_title'] = "Transfer History ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    
    public function view_blog(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "view_blog";
        $data['header_names'] = "VIEW BLOG";
        $data['page_title'] = "View Blog ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    
    public function edit_blog(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_blog";
        $data['header_names'] = "EDIT THIS ARTICLE";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'blogs');
        $ctitles = ucwords($data['getId']['titles']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "The article has been edited and approved!";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function votes(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "votes";
        $data['header_names'] = "VOTE RECORDS";
        $data['page_title'] = "Votes Records ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function entries(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "entries";
        $data['header_names'] = "ENTRIES";
        $data['page_title'] = "Entries ";
        $url_id = $this->uri->segment(3);
        $cid1 = substr($url_id, 0, -5);
        // $data['unread_msg'] = $this->unread_msg;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = $cid1;
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function vote_history(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $mem_id1 = substr($url_id, 0, -5);
        $data['page_name'] = "vote_history";
        $data['header_names'] = "VOTE HISTORY";
        $data['getId'] = $this->sql_models->getArrayID($mem_id1, 'all_votes');
        //print_r($data['getId']); exit;
        $ctitles = ucwords($data['getId'][0]['name2']);
        $data['page_title'] = $ctitles;
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    /*public function upload_rewards(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "upload_rewards";
        $data['header_names'] = "ADD REWARDS";
        $data['page_title'] = "Add Rewards ";
        $data['contests'] = "";
        $data['datamsg'] = "Your reward has been added to lottery games";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }*/


    public function upload_rewards(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "upload_rewards";
        $data['header_names'] = "Create Quiz";
        $data['page_title'] = "Create Quiz ";
        $data['contests'] = "";
        $data['datamsg'] = "Quiz section has been created!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }

    
    public function upload_questions(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $getid = $this->sql_models->get_ID($url_id, 'quiz_section');
        $data['getId'] = $getid['id'];
        $data['getQuizes'] = $this->sql_models->getQuizes($url_id);
        $data['page_name'] = "upload_questions";
        $data['header_names'] = "Upload Questions";
        $data['page_title'] = "Upload Questions ";
        $data['contests'] = "";
        $data['datamsg'] = "Question has been uploaded";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        //$data['getId'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function viewquestions(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $data['url_id'] = $url_id;
        $data['header_names'] = "VIEW QUESTIONS";
        $data['page_name'] = "viewquestions";
        $data['page_title'] = "View Questions";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function view_quiz(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "view_quiz";
        $data['header_names'] = "VIEW QUIZ";
        $data['page_title'] = "View Quiz ";
        $data['contests'] = "";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }


    public function edit_quiz(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $data['page_name'] = "edit_quiz";
        $data['header_names'] = "EDIT QUIZ";
        $data['getId'] = $this->sql_models->get_ID($url_id, 'quiz_section');
        $ctitles = ucwords($data['getId']['quiz_title']);
        $data['page_title'] = "Edit $ctitles";
        $data['datamsg'] = "This Quiz Section has been edited!";
        $data['datamsg1'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function edit_questions(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $url_id = $this->uri->segment(3);
        $url_id1 = $this->uri->segment(4);
        //if($this->sql_models->check_link($url_id, 'quiz_questions')) redirect("shields/viewquestions/$url_id1/");
        $data['getQuizes'] = $this->sql_models->getQuizesID($url_id);
        $data['url_id'] = $url_id;
        $data['url_id1'] = $url_id1;
        $data['getId'] = $data['getQuizes']['id'];
        $data['header_names'] = "EDIT QUESTIONS";
        $data['datamsg'] = "Your question has been updated";
        $data['datamsg1'] = "";
        //$data['show_name'] = "Admin";
        $data['page_name'] = "edit_questions";
        $data['page_title'] = "Edit Question";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    
    public function support(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "support";
        $data['page_title'] = "Support";
        $data['header_names'] = "SUPPORT TICKET";
        $data['getId'] = "";
        $data['datamsg'] = "Your message has been sent!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    public function announcement(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "announcement";
        $data['page_title'] = "Announcement";
        $data['header_names'] = "ANNOUNCEMEMT TO MEMBERS";
        $data['getId'] = "";
        $data['datamsg'] = "Your announcement has been sent to all members!";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
    }



    function create_admins(){
        $this->form_validation->set_rules('txtuname', 'username', 'required|trim');
        $this->form_validation->set_rules('txtpass', 'password', 'required|trim');
        $txtuname = $this->input->post('txtuname');
        $txtpass = sha1($this->input->post('txtpass'));
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $details_exists = $this->sql_models->check_existing_details($txtuname, $txtpass);
            if(!$details_exists){
                $data = array(
                    'logged_in' => 0,
                    'username'  => $txtuname,
                    'pass1'     => $txtpass
                );
                $this->db->insert('subadmin', $data);
                echo "sub_admin_created";
            }else{
                echo "The same details already exists";
            }
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

            $txtc_id = $this->input->post('txtc_id');

            $path4 = @$_FILES['file_banner']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $img_ext_chk1 = array('jpg','png','jpeg');
            $data1 = array();
            $data2 = array();

            if(@$_FILES['file_banner']['name'] == "" && $txt_yes_file_bma==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload a banner for this contest");

            else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image for a banner");

            else if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['size'] > 4194304)
                $arrs = array('type'=>'error', 'msg'=>"This image has exceeded 4MB");

            else if(strlen($txtclosedate) > 3 && strtotime($txtclosedate) <= strtotime($txtstartdate))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Entry</b> should be ahead of the <b>Start Date Of Entry</b>");

            else if(strtotime($txtstartdate) == $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Start Date Of Entry</b> should not be the same as the <b>Close Date Of Contest</b>");

            else if(strtotime($txtstartduration) > $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should be ahead of the <b>Start Date Of Contest</b>");

            else if(strtotime($txtstartdate) > $txtduration)
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should not be ahead of the <b>Start Date Of Entry</b>");

            else if(strtotime($txtstartduration) <= strtotime($txtstartdate))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Start Date Of Contest</b> should be ahead of the <b>Close Date of Entry</b>");

            else if($txtduration <= strtotime($txtstartduration))
                $arrs = array('type'=>'error', 'msg'=>"The <b>Close Date Of Contest</b> should be ahead of the <b>Start Date Of Entry</b>");

            else if(($txtfprize=="" && $txtadd_gift1=="") || ($txtsprize=="" && $txtadd_gift2==""))
                $arrs = array('type'=>'error', 'msg'=>"Error! At least 2 Prizes or 2 Gifts will be entered!", 'msg1'=>"");

            // else if(($txtfprize!="" && $txtsprize=="" && $txttprize=="") || ($txtfprize!="" && $txtsprize!="" && $txttprize=="") || ($txtfprize=="" && $txtsprize!="" && $txttprize=="") || ($txtfprize=="" && $txtsprize=="" && $txttprize!="") || ($txtfprize=="" && $txtsprize=="" && $txttprize!=""))
            //     $arrs = array('type'=>'error', 'msg'=>"Error! The price entry must be at least 3 (first, second & third winner)", 'msg1'=>"");

            else{
                $randm = time();
                $rename_file = "$randm.$ext4";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "contest_types/".$rename_file;
                
                $new_name4 = $rename_file;
                if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner']['name']) ){
                        if($txtc_id != "")
                            $this->sql_models->delete_memb_pics($former_file, 'contest_types/');

                        move_uploaded_file($file_tmp, $url_source);
                        $d = $this->compress($url_source, $url_dest, 30);
                    }

                    $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data1 = array(
                        'files' => $new_name4
                    );
                }

                if($txtc_id == ""){ // new upload
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

                $newdata3 = array_merge($data1, $data2);

                $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtc_id, 'contests');
                if(!$querys1)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!");
                else{
                    $arrs = array('type'=>'success', 'msg'=>"");
                }
            }
            
        }
        echo json_encode($arrs);
    }



    function submitMyAds(){
        $txtad_id = $this->input->post('txtad_id');
        $this->form_validation->set_rules('txttitle', 'Ad Title', 'required|trim|min_length[6]|max_length[100]');
        if($txtad_id=="")
            $this->form_validation->set_rules('txtsize', 'Ad Size', 'required|trim');

        if($txtad_id=="")
            $this->form_validation->set_rules('txtpositn', 'Ad Position', 'required|trim');

        if($txtad_id=="")
            $this->form_validation->set_rules('txtdurs', 'Duration', 'required|trim');
        //$this->form_validation->set_rules('txturl', 'Landing URL', 'required|trim');
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors());
        }else{

            $txttitle = $this->input->post('txttitle');
            $txtsize = $this->input->post('txtsize');
            $txtpositn = $this->input->post('txtpositn');
            $txtdurs = $this->input->post('txtdurs');
            //$txturl = $this->input->post('txturl');
            $txturl = "all";
            $txtamts = $this->input->post('txtamts');
            $former_file = $this->input->post('former_file');
            $txt_yes_file_bma = $this->input->post('txt_yes_file_bma');

            $path4 = @$_FILES['file_banner']['name'];
            $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
            $img_ext_chk1 = array('jpg','png','jpeg');
            $data1 = array();
            $data2 = array();

            if(@$_FILES['file_banner']['name'] == "" && $txt_yes_file_bma==0)
                $arrs = array('type'=>'error', 'msg'=>"Please upload an image for your AD");

            else if(!in_array($ext4,$img_ext_chk1) && isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != "")
                $arrs = array('type'=>'error', 'msg'=>"Please select a valid image");

            else if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['size'] > 1048576)
                $arrs = array('type'=>'error', 'msg'=>"This image has exceeded 1MB");

            else{
                $randm = time();
                $rename_file = "$randm.$ext4";
                
                $url_source = "fake_fols/".$rename_file;
                $url_dest = "adverts1/".$rename_file;
                
                $new_name4 = $rename_file;
                if(isset($_FILES['file_banner']['name']) && @$_FILES['file_banner']['name'] != ''){
                    $file_tmp = @$_FILES["file_banner"]["tmp_name"];
                    if(is_uploaded_file($file_tmp) && isset($_FILES['file_banner']['name']) ){
                        if($txtad_id != "")
                            $this->sql_models->delete_memb_pics($former_file, 'adverts1/');

                        move_uploaded_file($file_tmp, $url_source);
                        $d = $this->compress($url_source, $url_dest, 40);
                    }

                    $in_folder1="fake_fols/".$rename_file; // delete the image in the fake folder
                    if(is_readable($in_folder1)) @unlink($in_folder1);

                    $data1 = array(
                        'files' => $new_name4
                    );
                }

                if($txtad_id == ""){ // new upload
                    $data2 = array(
                        'user_id'           => $this->myID,
                        'title'             => $txttitle,
                        'sizes'             => $txtsize,
                        'positns'           => $txtpositn,
                        'duration'          => $txtdurs,
                        'duration_stamp'    => 0,
                        'urls'              => $txturl,
                        'amt'               => $txtamts,
                        'date_created'      => date("Y-m-d g:i a", time())
                    );

                }else{ // edit

                    $data2 = array(
                        'approved'          => 0,
                        'title'             => $txttitle,
                        //'positns'           => $txtpositn,
                        'urls'              => $txturl,
                    );
                }

                $newdata3 = array_merge($data1, $data2);

                $querys1 = $this->sql_models->update_inserts_recs($newdata3, $txtad_id, 'adverts');
                if(!$querys1)
                    $arrs = array('type'=>'error', 'msg'=>"Error in network connection!");
                else{
                    $arrs = array('type'=>'success', 'msg'=>"");
                }
            }
        }
        echo json_encode($arrs);
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




    public function fetch_records(){
        $url_task = $this->uri->segment(3); // view_customers
        $url_id = $this->uri->segment(4);
        if($url_id!="")
            $uid = substr($url_id, 0, -5);
        else
            $uid=$this->myID;
        $url_task1="";

         //echo $url_task."ddd<br>";
         //echo $uid."sss<br>";
        // exit;

        $fetch_data = $this->sql_models_adm->make_datatables($url_task, $url_task1, $uid);
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row){   
            $sub_array = array();
            $ids = $row->id;
            $nows = substr(time(), -5);
            $ids_hash = $ids.$nows;


            if($url_task=="vote_history"){
                $ids1 = $row->id1;
                //$names = ucwords($row->names);
                $names_con = ucwords($row->names2);
                $titles = ucwords($row->title);
                //$names1 = strtolower($names);
                //$names1 = str_replace(" ", "-", $names1);
                $memid_hash = $row->id1.$nows;
                //$names_lnk = base_url()."profile/$memid_hash/$names1/";
                $votes = @number_format($row->votes);
                $vp = @number_format($row->vp);
                $dates = date("D jS M, Y h:ia", strtotime($row->dates));
                $mypage="";
            }

            if($url_task=="referral_network"){
                $names = ucwords($row->names);
                $profession = ucwords($row->profession);
                $date_upgraded = date("D jS M Y h:ia", strtotime($row->date_upgraded));
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
                $mypage="";
            }
            

            if($url_task=="view_contests"){
                $approved = $row->approved;
                $overall_title = ucwords($row->title);
                $media_type = $row->media_type;
                $descrip = $row->descrip;
                $user_id = $row->user_id;
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
                $mypage="edit_contest";
                $boosts="";
                $id_harsh = $ids.substr(time(), -5);
                
                $reqBoost = $this->sql_models->reqBoost($ids);
                if($reqBoost){
                    $boosts = "<div class='boost_ads1'><span class='req_boost'>Requested Boost</span></div>";
                // }else{
                //     $boosts = "<div class='boost_ads1'><span style='opacity:0.5'>Boosted</span></div>";
                }
                $boosts .= "<div style='margin:12px 0 5px 0;'><a href='".base_url()."shields/entries/".$id_harsh."/'>VIEW ENTRIES</span></div>";

                if($start_date!="")
                    $start_date = date("D jS M, Y h:ia", strtotime($start_date));
                else
                    $start_date = "Not specified";
                //$enable_reg = date("D jS M, Y h:ia", $enable_reg);
                //$timings = $row->timings;

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
                    //$c_expirys = "<font style='opacity: 0.8'>Coming Soon on $start_date2!</font>";
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
                    $entry_type1 = "<p><b>Entry: ".strtoupper($entry_type)."</b><br>$entry_fee</p>";
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
                        $approved_1 = "<font id='approve_it' caps='Approved' table='contests' colums='approved' duratn='' aparams='".$user_id."' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font id='approve_it' caps='Not Approved' table='contests' colums='approved' duratn='' aparams='".$user_id."' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                    }
                }

                if(!isset($paids) || $paids<=0){
                    $approved_1 .= "<div class='lnk_btns lnk_btns1'><span con_id='$ids' titles='$overall_title' premium1='$premium1' style='cursor: default'>NOT PAID</span></div>";
                }else{
                    $approved_1 .= "<div class='lnk_btns'><span con_id='$ids' titles='$overall_title' style='cursor: default'>PAID &#8358;".@number_format($paids)."</span></div>";
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


            if($url_task=="member_wallets"){
                $approved = $row->paid;
                $memid = $row->memid;
                $emails = $row->emails;
                $method1 = ucfirst($row->method1);
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($nickname)>13)
                    $nickname = substr($nickname, 0, 13)."...";

                $amts = @number_format($row->amt);
                $date_created = $row->date_created;
                $mypage="";
                $dates = date("D jS M Y h:ia", strtotime($date_created));
                if(strlen($names)<2) $names=$nickname;

                if($approved == 1){
                    //$approved_1 = "<font id='approve_it' caps='Approved' table='wallets' colums='paid' duratn='".$row->amt."' aparams='".$memid."' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font id='approve_it' caps='Not Approved' table='wallets' colums='paid' duratn='".$row->amt."' aparams='".$memid."' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                }
            }



            if($url_task=="view_quiz"){
                $approved = $row->approved;
                $overall_title = ucwords($row->quiz_title);
                $num1 = $row->prize1;
                $num2 = $row->prize2;
                $num3 = $row->prize3;
                $num4 = $row->prize4;
                $num5 = $row->prize5;
                $completed = $row->completed;
                $sponsored_by = $row->sponsored_by;
                $duratn = $row->duratn;
                $seconds = $row->seconds;
                $date_created = $row->date_uploaded;
                $mypage="edit_quiz";

                $dates = date("D jS M Y h:ia", strtotime($date_created));

                $noOfQuest = $this->sql_models->countQuiz3($ids);

                if($num1!="") $num1 = "<p><b>First Prize: &#8358; ".@number_format($num1)."</b></p>";
                if($num2!="") $num2 = "<p><b>Second Prize: &#8358; ".@number_format($num2)."</b></p>";
                if($num3!="") $num3 = "<p><b>Third Prize: &#8358; ".@number_format($num3)."</b></p>";
                if($num4!="") $num4 = "<p><b>Fourth Prize: &#8358; ".@number_format($num4)."</b></p>";
                if($num5!="") $num5 = "<p><b>Fifth Prize: &#8358; ".@number_format($num5)."</b></p>";

                $all_prizes = "<div class='img_prizes'>
                $num1 $num2 $num3 $num4 $num5 
                </div>";

                if($approved == 1){
                    $approved_1 = "<font id='approve_it' caps='Approved' table='quiz_section' colums='approved' duratn='".$duratn."' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font id='approve_it' caps='Not Approved' table='quiz_section' colums='approved' duratn='".$duratn."' aparams='' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                }
                

                if($completed == 0){
                    if($approved == 1){
                        $close_cons_1 = "<font id='approve_it' caps='Open' table='quiz_section' colums='completed' duratn='' aparams='' class='approve_it$ids' ids='".$ids."' style='color:#fff; font-size:15px; cursor:pointer; background:#093; padding:4px 10px;'><b>Open</b></font>";
                    }else{
                        $close_cons_1 = "<font style='color:#fff; opacity:0.5; font-size:15px; cursor:pointer; background:#093; padding:4px 10px;'><b>Open</b></font>";
                    }
                }else{
                    $close_cons_1 = "<font class='approve_status_c' style='font-size:15px; cursor:default; background:#093'><b>Completed</b></font>";
                }
            }


            if($url_task=="withdrawal_request" || $url_task=="transaction_reports"){
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($names)>3){
                    $names = "$nickname ($names)";
                }else{
                    $names = "$nickname";
                }
                $amts = @number_format($row->amt);
                $amts1 = $row->amt; // include reduction of 2.5%
                $memid = $row->memid;
                $acct_no = $row->acct_no;
                $bank_id = $row->bank_name;
                $banks = $this->sql_models->getBank($bank_id);
                $acct_name = $row->acct_name;
                $answered = $row->answered;
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
                $mypage="";

                $amts=($this->withdraw_fee/100)*$amts1; // 2/100 = 0.02*2000=40
                $cut_amt=$amts1 - $amts; // 2000-40=1960
                $cut_amt = "<p style='font-size: 15px; margin-top: 3px;'><b>Credit Amt:</b> <b style='color: #093'>&#8358;".@number_format($cut_amt)."</b></p>";

                if($url_task=="transaction_reports"){
                    if($answered == 1){
                        $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font style='color:red; font-size:15px; cursor:default'><b>Not Approved</b></font>";
                    }
                }else{
                    if($answered == 1){
                        //$approved_1 = "<font id='approve_it' caps='Approved' table='request_withdrawals' colums='answered' duratn='$amts1' aparams='$memid' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";

                        $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>Approved</b></font>";
                    }else{
                        $approved_1 = "<font id='approve_it' caps='Not Approved' table='request_withdrawals' colums='answered' duratn='$amts1' aparams='$memid' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15.5px; cursor:pointer; line-height:16px !important'><b>Not Approved</b></font>";
                    }
                }
            }


            if($url_task=="sponsored_contests"){
                $id1 = $row->id1;
                $paid = $row->paid;
                $u_names = ucwords($row->names);
                $title = ucwords($row->title);
                $amt = @number_format($row->amt);
                $response = $row->response;
                $user_id = $row->user_id;
                $duratn = $row->duratn;
                $extendeds = $row->extendeds;
                $date_created = $row->date_created;
                $start_date1 = strtotime($row->start_date);
                $start_date2 = @date("jS M, Y", $start_date1);
                $mypage="";
                
                $currentTime = time();
                $difference = $row->timings - $currentTime;

                if($start_date1 <= $currentTime){
                    $c_expirys = convertTime1($difference);
                    $c_expirys = str_replace("time", "left", $c_expirys);
                }else{
                    //$c_expirys = "<font style='opacity: 0.8'>Coming Soon on $start_date2!</font>";
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
                    //$approved_1 = "<font id='approve_it' caps='Approved' table='boost_ads' colums='paid' duratn='$duratn' aparams='".$user_id."' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>PAID</b></font>";

                    $approved_1 = "<font style='color:#090; font-size:15.5px; cursor:default'><b>PAID</b></font>";
                }else{
                    $approved_1 = "<font id='approve_it' caps='Not Approved' table='boost_ads' colums='paid' duratn='$duratn' aparams='".$user_id."' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15.5px; cursor:pointer; line-height:16px !important'><b>NOT PAID</b></font>";
                }
                //$extend_dur = "<div class='boost_ads'><span con_id='$id1' ad_type='contests' titles='$title'>Extend Duration</span></div>";
            }


            if($url_task=="members"){
                $id1 = $row->id1;
                $approved = $row->approved;
                $names = ucwords($row->names);
                if(strlen($names)<=3) $names = "<i style='color:#999'>Not Specified</i>";
                $mem_type = $row->mem_type;
                $nickname = ucwords($row->nickname);
                $profession = ucwords($row->profession);
                $bio = nl2br($row->bio);
                $emails = $row->emails;
                $phone = $row->phone;
                $agents = $row->agents;
                $pics = $row->pics;
                $states = $row->states;
                $citys = $row->citys;
                $states1 = $this->sql_models->getLocs($states, "states");
                $citys1 = $this->sql_models->getLocs($citys, "local_governments");
                //$citys1 = $row->citys1;
                $wallet = @number_format($row->wallet);
                $vps = @number_format($row->vp);
                $views = @number_format($row->views);
                $id_card = $row->id_card;
                $utility = $row->utility;
                $paid = $row->paid;
                $transaction_ref = $row->transaction_ref;
                $date_upgraded = $row->date_upgraded;
                $date_created = $row->date_created;
                //$states1="";
                if($states1!="") $states1 = ", $states1";
                if($citys1!="") $citys1 = "$citys1";

                $locatn = $citys1.$states1;
                //$upload_files = "<a href=''>".base_url()."sponsor_files/".$id_card."</a>";
                $id_card1 = base_url()."sponsor_files/".$id_card;
                $utility1 = base_url()."sponsor_files/".$utility;
                $upload_files = "<p style='line-height: 30px; margin-top: 6px'><a href='$id_card1' target='_blank'>$id_card</a><br>";
                $upload_files .= "<a href='$utility1' target='_blank'>$utility</a></p>";

                $mypage="";

                if($date_upgraded!="")
                    $date_upgraded = date("D jS M Y h:ia", strtotime($date_upgraded));
                else
                    $date_upgraded = "";

                if($date_created!="")
                    $date_created = date("D jS M Y h:ia", strtotime($date_created));
                else
                    $date_created = "";

                if($pics!=""){
                    $pics1 = base_url()."profiles/".$pics;
                    $pics = "<div class='img_1'><img src='$pics1'></div>";
                }

                if($mem_type=="mem") $mem_type1=""; else $mem_type1="<label style='color:#093; display:block'>(Sponsor)</label>";

                if($paid==1)
                    $paids = "<p><b style='color:#093'>YES</b></p>";
                else
                    $paids = "<p><b style='color:red'>NO</b></p>";

                if($id_card!="" && $paid==1){
                    if($approved == 1){
                        $approved_1 = "<div id='approve_it' caps='Approved' table='members' colums='approved' duratn='' aparams='".$id1."' class='approve_it$id1' ids='".$id1."' style='color:#090; font-size:15.5px; cursor:pointer; line-height:18px; margin-top:5px;'><b>Approved</b></div>";
                    }else{
                        $approved_1 = "<div id='approve_it' caps='Not Approved' table='members' colums='approved' duratn='' aparams='".$id1."' class='approve_it$id1' ids='".$id1."' style='color:red; font-size:15px; cursor:pointer; line-height:18px; margin-top:5px;'><b>Not Approved</b></div>";
                    }
                }else{
                    $approved_1 = "";
                }


                $approved_2 = "";
                if($agents == 2){ //2
                    $approved_2 = "<div id='approve_it' caps='Approved' table='members' colums='agents' duratn='' aparams='".$id1."' class='approve_it$id1' ids='".$id1."' style='color:#090; font-size:15.5px; cursor:pointer; line-height:20px; margin-top:10px;'><b>[Agency Approved]</b></div>";
                }else if($agents == 1){
                    $approved_2 = "<div id='approve_it' caps='Not Approved' table='members' colums='agents' duratn='' aparams='".$id1."' class='approve_it$id1' ids='".$id1."' style='color:red; font-size:15px; cursor:pointer; line-height:20px; margin-top:10px;'><b>[Approve Agent]</b></div>";
                }
            
            }

            
            if($url_task=="votes"){
                $nows = substr(time(), -5);
                $memid_hash = $ids.$nows;
                $names_1 = strtolower($row->names);
                $names_1 = str_replace(" ", "-", $names_1);
                $lnks = base_url()."shields/vote_history/$memid_hash/$names_1/";
                $view_history = " <a href='$lnks' class='view_history'>[view history]</a>";
                
                $namess = $row->names;
                $nickname = $row->nickname;
                if(strlen($namess)<3)
                    $namess = $nickname;

                $names = ucwords($namess).$view_history;
                $names1 = strtolower($names);
                $names1 = str_replace(" ", "-", $names1);
                //$memid_hash = $row->id1.$nows;
                $memid_hash = $ids.$nows;
                //$votes = @number_format($this->sql_models->getCounts('all_votes', $ids2, 'votes'));
                $boosteds = @number_format($this->sql_models->fetchVoterBoosted($ids, '', ''));

                $boosteds1 = "";
                if($boosteds>0)
                    $boosteds1 = " <font style='font-weight:600; font-size: 14px;'>(Boosted $boosteds)</font>";
                $votes = @number_format($row->voted).$boosteds1;
                $vps = @number_format($row->vp);
                $mypage="";
            }


            if($url_task=="entries"){
                $ids1 = $row->id1;
                $ids2 = $row->id2;
                $contestant_id = $row->contestant_id;
                $contest_id = $row->id2;
                $names = ucwords($row->names);
                $nickname = ucwords($row->nickname);
                if(strlen($names)<=3) $names = $nickname;
                $boosteds = @number_format($this->sql_models->fetchVoterBoosted("", $contest_id, $contestant_id));
                $boosteds1="";
                if($boosteds>0)
                    $boosteds1=" <font style='font-size:14px; font-weight:600;'>(Boosted $boosteds)</font>";
                $nows = substr(time(), -5);
                $ids_hash = $contest_id.$nows;
                $ent_url = base_url()."shields/entries/$ids_hash/";
                $title = "<a href='$ent_url'>".ucwords($row->title)."</a>";
                $votes = @number_format($row->votes).$boosteds1;
                //$views =  kilomega($row->views);
                $date_created = @date("jS M, Y h:i a", strtotime($row->date_created));
                $mypage="";
            }


            if($url_task=="view_adverts"){
                $ids1 = $row->id;
                $user_id1 = $row->user_id;
                $names1 = $this->sql_models->getName($user_id1);
                if($names1=="") $names1="<i style='color:#777'>Admin</i>";
                $title = ucwords($row->title);
                $approved = $row->approved;
                $extendeds = $row->extendeds;
                $sizes = $row->sizes;
                $positns = ucwords($row->positns);
                $duration = $row->duration;
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
                    $approved_1 = "<font id='approve_it' caps='Approved' table='adverts' colums='approved' duratn='$duration' aparams='".$user_id1."' class='approve_it$ids' ids='".$ids."' style='color:#090; font-size:15.5px; cursor:pointer'><b>Approved</b></font>";
                }else{
                    $approved_1 = "<font id='approve_it' caps='Not Approved' table='adverts' colums='approved' duratn='$duration' aparams='".$user_id1."' class='approve_it$ids' ids='".$ids."' style='color:red; font-size:15px; cursor:pointer'><b>Not Approved</b></font>";
                }
                $extend_dur = "<div class='boost_ads'><span con_id='$ids' ad_type='advert' titles='$title'>Extend Duration</span></div>";
                $mypage="edit_advert";
            }


            if($url_task=="view_blog"){
                $ids1 = $row->id;
                $titles = ucwords($row->titles);
                $contents = nl2br($row->contents);
                $views = @number_format($row->views);
                $date_created = $row->date_created;
                $date_created = @date("jS M, Y h:i a", strtotime($date_created));

                $files = $this->sql_models->fetchBlogFile('blogs_images', $ids);
                $pic_pathi = base_url()."cblogs/$files";
                $width1="";
                list($width1, $height1, $type1, $attr1) = @getimagesize($pic_pathi);

                if($width1=="" || $width1<=0){
                    $pic_pathi = base_url()."images/no_picture.jpg";
                }

                if($files!=""){
                    $files = "<div class='img_banners'><img src='$pic_pathi'></div>";
                }
                $mypage="edit_blog";
            }


            if($url_task=="transfer_history"){
                $amts = @number_format($row->amount);
                $sender_id = $row->mid;
                $rec_id = $row->mid2;
                $reasons = ucfirst($row->reasons);
                $emails = $row->emails;
                $phone = $row->phone;

                /*if($sender_id == $this->myID){
                    $name_ful = "<b>You</b>";
                }else{
                    $name_sender = ucwords($row->name_sender);
                    $nickname_sender = ucwords($row->nickname_sender);
                    $name_ful = "$name_sender ($nickname_sender)";
                }*/

                if($rec_id == $this->myID){
                    $name_ful2 = "<b>You</b>";
                }else{
                    $names = ucwords($row->names);
                    $nickname = ucwords($row->nickname);
                    $name_ful2 = "$names ($nickname) <p style='font-size:15px; color: #BABA74;'>$emails<br><a href='tel:$phone' style='color: #06C;'>$phone</a></p>";
                }
                $date_created = date("D jS M Y h:ia", strtotime($row->date_created));
            }


            $btns1='';
            if($url_task!="sponsored_contests" && $url_task!="transfer_history"){
                $btns1 .= '<button class="btns btn-primary btn-lg edit_me_adm mr-sm-10" mypage="'.$mypage.'" captn="0" data-title="Edit" data-toggle="modal" data-target="#myPopup_" id="'.md5($ids).'"><i class="fa fa-pencil"></i> </button>';
            }
        
            $btns1 .= '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';

            $btns2 = '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';


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

            if($url_task=="member_wallets"){
                // $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = "<font style='color:#09C;'>$emails</font>";
                $sub_array[] = $method1;
                $sub_array[] = $approved_1;
                $sub_array[] = "<b style='font-size: 18px; color: #069'>&#8358;".$amts."</b>";
                $sub_array[] = $dates;
            }

            if($url_task=="referral_network"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = $profession;
                $sub_array[] = $date_upgraded;
                $sub_array[] = $date_created;
            }

            if($url_task=="view_quiz"){
                $sub_array[] = $conts;
                $sub_array[] = $overall_title."<p style='line-height:18px; margin-top:5px;'><a href='".base_url()."shields/viewquestions/".md5($ids)."/'>View Questions ($noOfQuest)</a></p>";
                $sub_array[] = $approved_1;
                $sub_array[] = $duratn;
                $sub_array[] = $close_cons_1;
                $sub_array[] = $all_prizes;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }

            if($url_task=="withdrawal_request" || $url_task=="transaction_reports"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = "<b>&#8358;".@number_format($amts1,2)."</b>".$cut_amt;
                $sub_array[] = $approved_1;
                $sub_array[] = $acct_no;
                $sub_array[] = $banks;
                $sub_array[] = ucwords($acct_name);
                $sub_array[] = $date_created;
            }

            if($url_task=="sponsored_contests"){
                $sub_array[] = $conts;
                $sub_array[] = $u_names;
                //$sub_array[] = $title.$extend_dur;
                $sub_array[] = $title;
                $sub_array[] = $approved_1;
                $sub_array[] = "&#8358;".$amt;
                $sub_array[] = $extendeds1;
                $sub_array[] = $response;
                $sub_array[] = $c_expirys;
                $sub_array[] = $duratn;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }

            if($url_task=="members"){
                $sub_array[] = $conts;
                $sub_array[] = $names.$mem_type1.$approved_1.$approved_2;
                $sub_array[] = $nickname;
                $sub_array[] = "<a href='mailto:$emails'>$emails</a>";
                $sub_array[] = "<a href='tel:$phone'>$phone</a>";
                $sub_array[] = "&#8358;".$wallet;
                $sub_array[] = $vps;
                $sub_array[] = $profession;
                $sub_array[] = $bio;
                $sub_array[] = $pics;
                $sub_array[] = $locatn;
                $sub_array[] = $views;
                $sub_array[] = $upload_files;
                $sub_array[] = $paids;
                $sub_array[] = $transaction_ref;
                $sub_array[] = $date_upgraded;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }

            
            if($url_task=="entries"){
                $sub_array[] = $conts;
                if(!is_numeric($url_id))
                    $sub_array[] = $title;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                //$sub_array[] = $views;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }

            if($url_task=="votes"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = $votes;
                $sub_array[] = $vps;
            }

            if($url_task=="view_adverts"){
                $sub_array[] = $conts;
                $sub_array[] = $names1;
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


            if($url_task=="view_blog"){
                $sub_array[] = $conts;
                $sub_array[] = $titles;
                $sub_array[] = $views;
                $sub_array[] = $files;
                $sub_array[] = $contents;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }


            if($url_task=="vote_history"){
                $sub_array[] = $conts;
                $sub_array[] = $titles;
                $sub_array[] = $names_con;
                $sub_array[] = $votes;
                $sub_array[] = $vp;
                $sub_array[] = $dates;
                $sub_array[] = $btns1;
            }


            if($url_task=="transfer_history"){
                $sub_array[] = $conts;
                //$sub_array[] = $name_ful;
                $sub_array[] = $name_ful2;
                $sub_array[] = "<font style='font-size: 20px; color: #09C'>&#8358;".$amts."</font>";
                $sub_array[] = $reasons;
                $sub_array[] = $date_created;
            }

            //$sub_array[] = $btns1;
            $data[] = $sub_array;
            $conts++;
        }

        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models_adm->get_all_data($url_task, $url_task1, $uid),
            "recordsFiltered"   =>  $this->sql_models_adm->get_filtered_data($url_task, $url_task1, $uid, '', '', ''),
            //"data1"              =>  "sssss",
            "data"              =>  $data
        );
        echo json_encode($output);
    }



    function fetch_tickets(){
        $txtmem = $this->uri->segment(3);
        $msg_types = $this->uri->segment(4);
        $fetch_data = $this->sql_models_adm->make_datatables('support', $msg_types, $txtmem);
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $id = $row->id1;
            $sent_from = $row->sent_from;
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
                if($memid1 > 0)
                    $names1 = "Admin";
                else
                    $names1 = ucwords($names);

            }else{ // sent

                if($sent_from != $this->myID)
                    $names1 = "Admin";
                else
                    $names1 = ucwords($names);

                //$names1 = "Admin";
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
            $sub_array[] = "<span data-toggle='modal' class='open_message' subj='$subj1' msgs='$message1' msg_id='$id' memid1='$sent_from' sent_from='0' myname='$names1' mydate='$dates'>$subj</span>";

            $sub_array[] = "<span data-toggle='modal' class='open_message' subj='$subj1' msgs='$message1' msg_id='$id' memid1='$sent_from' sent_from='0' myname='$names1' mydate='$dates'>$message</span>";
            $sub_array[] = $dates;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models_adm->get_all_data('support', $msg_types, $txtmem),
            "recordsFiltered"   =>  $this->sql_models_adm->get_filtered_data('support', $msg_types, $txtmem, '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }



    public function fetch_questions(){
        $url_task = $this->uri->segment(3);
        $fetch_data = $this->sql_models_adm->make_datatables('quiz_questions', $url_task, $url_task);
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $id4 = $row->id1;
            $questions = ucfirst($row->questions);
            $files = $row->files;
            $op1 = ucwords($row->op1);
            $op2 = ucwords($row->op2);
            $op3 = ucwords($row->op3);
            $op4 = ucwords($row->op4);
            $ans1 = ucwords($row->ans1);
            $explanations = $row->explanations;

            if($files!="")
            $files1 = "<img src='".base_url()."quizes/$files' id='im10'>";
            else
            $files1 = "";

            $btns1 = '<button class="btns btn-primary btn-lg edit_me_adm mb-sm-10" mypage="edit_questions" captn="0" data-title="Edit" data-toggle="modal" data-target="#myPopup_" id="'.md5($id4).'" url_task="'.$url_task.'"><i class="fa fa-pencil"></i> </button>';            
        
            $btns1 .= '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$id4.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';

            $sub_array[] = $conts;
            $sub_array[] = $btns1;
            $sub_array[] = $questions;
            $sub_array[] = $files1;
            $sub_array[] = $op1;
            $sub_array[] = $op2;
            $sub_array[] = $op3;
            $sub_array[] = $op4;
            $sub_array[] = $ans1;
            $sub_array[] = $explanations;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models_adm->get_all_data('quiz_questions', $url_task, $url_task),
            "recordsFiltered"   =>  $this->sql_models_adm->get_filtered_data('quiz_questions', $url_task, $url_task, '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }




    function fetch_announce(){
        $txtmem = $this->uri->segment(3);
        $fetch_data = $this->sql_models_adm->make_datatables('announcement', "", $txtmem);
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
            $message1 = base64_encode($message_1);
            $has_read = $row->has_read;
            $dates = $row->date_posted;
            $dates = date("D jS M, Y h:ia", strtotime($dates));
            if(strlen($message)>100)
                $message = substr($message, 0, 100)."...";


            $has_read1 = "";
            if($has_read == 1){
                $has_read1 .= "<i style='color:#999; font-size:14px;' class='php_read$id'>Read</i>";
            }else{
                $has_read1 .= "<font style='color:#090; font-size:13px;' class='php_read$id'><b>New Message</b></font>";
            }
            $has_read1 .= "<i style='color:#999; font-size:14px; display:none;' class='java_read$id'>Read</i>";

            $sub_array[] = $names;
            $sub_array[] = $has_read1;
            $sub_array[] = $subj;
            $sub_array[] = $message;
            $sub_array[] = $dates;
            $data[] = $sub_array;
            $conts++;
        }
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models_adm->get_all_data('announcement', "", $txtmem),
            "recordsFiltered"   =>  $this->sql_models_adm->get_filtered_data('announcement', "", $txtmem, '', '', ''),
            "data"              =>  $data
        );
        echo json_encode($output);
    }




    function logout(){
        $cookie = array(
            'name'   => 'adm_password_iconts',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        $cookie1 = array(
            'name'   => 'adm_username_iconts',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        delete_cookie($cookie);
        delete_cookie($cookie1);
        redirect('shields/login');
    }



    
    
    public function settings(){
        if($this->sql_models->validate_adminx()){
            $data['show_name'] = "Admin";
            $data['page_name'] = "settings";
            $data['header_names'] = "SETTINGS";
            $data['page_title'] = "Admin Settings";
            $data['url_id'] = "";
            $data['datamsg'] = "Your Password Has Been Updated!";
            $data['datamsg1'] = "Settings have been updated!";
            //$data['unread_msg'] = $this->unread_msg;
            $this->load->view("shields/header", $data);
            $this->load->view("shields/index", $data);
        }else{
            redirect('shields/login');
        }
    }


    
    

    public function logme_adm(){
        $this->form_validation->set_rules('txtuser', 'username', 'required|trim');
        $this->form_validation->set_rules('txtpas1s', 'password', 'required|trim');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $data = array(
                'emails' => $this->input->post('txtuser'),
                'pass1'=> sha1($this->input->post('txtpas1s'))
                    );
            $is_correct = $this->sql_models->get_admin_logins($data);
            if($is_correct){
                $user_mail = $this->input->post('txtuser');
                $user_mail = sha1(strtolower($user_mail));
                $user_pass = sha1($this->input->post('txtpas1s'));

                $newdata = array(
                    'adm_uname_ider'  => $user_mail,
                    'pass1s_ider'     => $user_pass,
                    'logged_in_ider' => TRUE
                );
                $this->session->set_userdata($newdata);
                    echo "success1";
                
            }else{
                
                echo "Login credentials do not match!";

            }
        }
    }

    



}
