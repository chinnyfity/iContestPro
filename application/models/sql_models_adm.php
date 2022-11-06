<?php

class Sql_models_adm extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    
    var $order_column = array(null, "*");


    function make_datatables($tbls, $params, $params2){
        //echo $tbls; exit;
        $tbls1="";
        $params3="";
        if($tbls=="view_contests") $tbls1 = "contests";
        if($tbls=="member_wallets") $tbls1 = "wallets";
        if($tbls=="vote_history") $tbls1 = "all_votes";
        if($tbls=="votes"){ $tbls1 = "entries"; }
        if($tbls=="entries"){ $tbls1 = "entries"; $params3="entries"; }
        if($tbls=="sponsored_contests") $tbls1 = "boost_ads";
        if($tbls=="view_adverts") $tbls1 = "adverts";
        if($tbls=="support") $tbls1 = "support";
        if($tbls=="quiz_questions") $tbls1 = "quiz_questions";
        if($tbls=="announcement") $tbls1 = "announcement";
        if($tbls=="members") $tbls1 = "members";
        if($tbls=="view_quiz") $tbls1 = "quiz_section";
        if($tbls=="referral_network") $tbls1 = "referrals";
        if($tbls=="view_blog") $tbls1 = "blogs";
        if($tbls=="withdrawal_request" || $tbls=="transaction_reports") $tbls1 = "request_withdrawals";
        if($tbls=="transfer_history") $tbls1 = "transfer_history";


        $this->fetchUsers($tbls1, $params, $params2, $params3);
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        /*if($params2!="" && $params2!="inbox" && $params2!="sent"){
            //if($tbls1=="contests")
                $this->db->where('user_id', $params2);
        }*/
        $query = $this->db->get();
        return $query->result();
    }


    
    public function get_filtered_data($tbls, $params, $params2){
        $tbls1="";
        $params3="";
        if($tbls=="view_contests") $tbls1 = "contests";
        if($tbls=="member_wallets") $tbls1 = "wallets";
        if($tbls=="vote_history") $tbls1 = "all_votes";
        if($tbls=="votes") $tbls1 = "entries";
        if($tbls=="entries"){ $tbls1 = "entries"; $params3="entries"; }
        if($tbls=="sponsored_contests") $tbls1 = "boost_ads";
        if($tbls=="view_adverts") $tbls1 = "adverts";
        if($tbls=="support") $tbls1 = "support";
        if($tbls=="quiz_questions") $tbls1 = "quiz_questions";
        if($tbls=="announcement") $tbls1 = "announcement";
        if($tbls=="members") $tbls1 = "members";
        if($tbls=="view_quiz") $tbls1 = "quiz_section";
        if($tbls=="referral_network") $tbls1 = "referrals";
        if($tbls=="view_blog") $tbls1 = "blogs";
        if($tbls=="transfer_history") $tbls1 = "transfer_history";
        if($tbls=="withdrawal_request" || $tbls=="transaction_reports") $tbls1 = "request_withdrawals";

        $this->fetchUsers($tbls1, $params, $params2, $params3);
        $query = $this->db->get();
        return $query->num_rows();
    }



    function get_all_data($tbls, $params, $params2){
        //echo $tbls; exit;
        $tbls1="";
        $this->db->select("*");
        //if($tbls == "contest_leaderboard") $this->db->from('contests');
        //if($tbls == "view_contests") $this->db->from('contests');
        if($tbls == "vote_history") $this->db->from('all_votes');
        if($tbls == "view_contests") $this->db->from('contests');
        if($tbls == "votes" || $tbls == "entries") $this->db->from('entries');
        //if($tbls == "entries") $this->db->from('entries');
        if($tbls == "sponsored_contests") $this->db->from('boost_ads');
        if($tbls == "view_adverts") $this->db->from('adverts');
        if($tbls == "support") $this->db->from('support');
        if($tbls == "quiz_questions") $this->db->from('quiz_questions');
        if($tbls == "announcement") $this->db->from('announcement');
        if($tbls == "members") $this->db->from('members');
        if($tbls == "view_quiz") $this->db->from('quiz_section');
        if($tbls == "member_wallets") $this->db->from('wallets');
        if($tbls == "referral_network") $this->db->from('referrals');
        if($tbls == "view_blog") $this->db->from('blogs');
        if($tbls == "transfer_history") $this->db->from('transfer_history');
        if($tbls == "withdrawal_request" || $tbls=="transaction_reports") $this->db->from('request_withdrawals');

        return $this->db->count_all_results();
    }


    

    function fetchUsers($tbls, $params, $params2, $params3){
        //echo $tbls."wwww"; exit;
        $nowtime = time();
        $txtsrchs = $_POST['search']['value'];

        
        if($tbls=="view_contests"){
            $this->db->select('conts.*');
            $this->db->from('contests conts')->where('conts.approved', 1);

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(conts.title like '%$txtsrchs%' OR conts.premium like '%$txtsrchs%' OR conts.sponsoredby like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('conts.views', 'desc');
        }


        if($tbls=="wallets"){
            $this->db->select('wws.*, mem.id AS id1, mem.names, mem.nickname, mem.emails, wws.method1');
            $this->db->from('wallets wws');
            $this->db->join('members mem', 'mem.id = wws.memid');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR wws.amt like '%$txtsrchs%' OR mem.phone like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('wws.id', 'desc');
        }


        if($tbls=="request_withdrawals" || $tbls=="transaction_reports"){
            $this->db->select('reqs.*, mem.names, mem.nickname');
            $this->db->from('request_withdrawals reqs');
            //$this->db->join('bank_names bns', 'bns.id = reqs.bank_name');
            $this->db->join('members mem', 'mem.id = reqs.memid');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR reqs.amt like '%$txtsrchs%' OR reqs.acct_name like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('reqs.id', 'desc');
        }


        if($tbls=="referrals"){
            $this->db->select('ref.id, mem.names, mem.nickname, mem.profession, mem.date_upgraded, mem.date_created');
            $this->db->from('referrals ref');
            $this->db->where('mem.mem_type', 'spon');
            $this->db->join('members mem', 'mem.id = ref.refs');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('ref.id', 'desc');
        }


        if($tbls=="boost_ads"){
            $this->db->select('bst.*, conts.id AS id1, conts.title, conts.start_date, mem.names');
            $this->db->from('boost_ads bst');
            $this->db->join('contests conts', 'conts.id = bst.contest_id');
            $this->db->join('members mem', 'mem.id = bst.user_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(conts.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('conts.id', 'desc');
        }


        if($tbls=="quiz_section"){
            $this->db->select('*');
            $this->db->from('quiz_section');
            //$this->db->join('raffle_numbers rns', 'rwt.id = rns.reward_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(quiz_title like '%$txtsrchs%' OR sponsored_by like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            //$this->db->group_by('id');
            $this->db->order_by('id', 'desc');
        }


        if($tbls=="members"){
            $this->db->select('mem.*, mem.id as id1');
            $this->db->from('members mem');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%' OR mem.mem_type like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.phone like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('mem.id', 'desc');
        }


        if($tbls=="entries" && $params3==""){
            $this->db->select('mem.id, mem.names, mem.nickname, mem.vp, mem.voted');
            $this->db->from('members mem')->where('voted >', 0);
            
            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('voted', 'desc');
        }


        if($tbls=="entries" && $params3=="entries"){
            $this->db->select('entr.*, mem.id AS id1, conts.id AS id2, mem.names, mem.nickname, conts.title, entr.contestant_id');
            $this->db->from('entries entr');
            if(is_numeric($params2) && $params2>0) $this->db->where('conts.id', $params2);
            $this->db->join('members mem', 'mem.id = entr.contestant_id');
            $this->db->join('contests conts', 'conts.id = entr.contest_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            //$this->db->group_by('entr.voter');
            $this->db->order_by('id desc');
        }


        if($tbls=="adverts"){
            $this->db->select('adv.*, mem.id AS id1, mem.names, mem.nickname');
            $this->db->from('adverts adv');
            $this->db->join('members mem', 'mem.id = adv.user_id OR adv.user_id = 0');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(adv.title like '%$txtsrchs%' OR mem.names like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->group_by('adv.id');
            $this->db->order_by('adv.id', 'desc');
        }


        if($tbls=="blogs"){
            $this->db->select('*');
            $this->db->from('blogs');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(titles like '%$txtsrchs%' OR contents like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('id', 'desc');
        }


        if($tbls=="users"){
            $this->db->select('*, emails as uname');
            $this->db->from('customers')->where('user_type', 'subadmin');
            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(names like '%$txtsrchs%' OR uname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('id', 'desc');
        }


        if($tbls == "support"){
            $this->db->select('spt.*, mem.names, mem.nickname, spt.id as id1');
            $this->db->from('support spt');

            if($params == "sent"){
                $this->db->where('spt.user_id >', 0)->where('spt.sent_from', 0);
                $this->db->join('members mem', 'mem.id = spt.user_id');
            }else{
                $this->db->where('spt.sent_from >', 0)->where('spt.user_id', 0);
                $this->db->join('members mem', 'mem.id = spt.sent_from');
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR spt.subj like '%$txtsrchs%' OR spt.message like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('spt.id', 'desc');
        }


        if($tbls=="quiz_questions"){
            $this->db->select('q2.*, q2.id AS id1');
            $this->db->from('quiz_questions q2');
            $this->db->where('md5(qq.id)', $params2);

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(q2.questions like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->join('quiz_section qq', 'qq.id = q2.quiz_section_id');
            //$this->db->group_by('q2.questions');
            $this->db->order_by('q2.id', 'desc');
        }

        
        if($tbls == "announcement"){
            $this->db->select('spt.*, mem.names, mem.nickname, spt.id as id1');
            $this->db->from('announcement spt');
            $this->db->join('members mem', 'mem.id = spt.user_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR spt.subj like '%$txtsrchs%' OR spt.message like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('spt.id', 'desc');
        }


        
        if($tbls=="contests"){
            $this->db->select('conts.*, mem.id AS memid, mem.names');
            $this->db->from('contests conts');
            if($params2 != "") $this->db->where('conts.user_id', $params2);

            $this->db->join('members mem', 'mem.id = conts.user_id');

            if($params != ""){
                if(isset($txtsrchs) && $txtsrchs!=""){
                    $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                }
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs .= "(conts.title like '%$txtsrchs%' OR conts.premium like '%$txtsrchs%')";
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $this->db->where("$srchs");
            }

            $this->db->order_by('conts.id', 'desc');
        }


        if($tbls=="transfer_history"){
            $this->db->select('reqs.*, mem.id AS mid, mem.id AS mid2, mem.emails, mem.names, mem.nickname, mem.phone');
            $this->db->from('transfer_history reqs');
            $this->db->where('reqs.sender_id', 0);
            //$this->db->join('members mem', 'mem.id = reqs.sender_id');
            $this->db->join('members mem', 'mem.id = reqs.recipient_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.phone like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.amount like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('reqs.id', 'desc');
        }


        if($tbls=="all_votes"){
            $this->db->select('vts.*, mem.id AS memid, mem1.id AS memid2, conts.id AS id1, mem1.names as names2, conts.title, vts.date_created AS dates');
            $this->db->from('all_votes vts');
            $this->db->where('vts.voter', $params2);

            $this->db->join('members mem', 'mem.id = vts.voter');
            $this->db->join('members mem1', 'mem1.id = vts.contestant_id');
            $this->db->join('contests conts', 'conts.id = vts.contest_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR conts.title like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }

            $this->db->order_by('vts.id', 'desc');
        }


    }

    

}

?>