<?php

class Sql_models extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    function fetchLocation(){
        $SQL1 = "SELECT DISTINCT id, name FROM countries";
        $SQL2 = "SELECT DISTINCT id, name FROM states WHERE country_id=160";
        $SQL3 = "$SQL1 UNION $SQL2";
        $query = $this->db->query($SQL3);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function send_mail($from_email, $to_email, $from_name, $messages, $subj){
        $this->load->library('email');
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




    function fetchCat(){
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by('cats', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function bringOldTitle(){
        $this->db->select('titles, date_created');
        $this->db->from('reward_tbl')->where('completed', 1)->where('approved', 1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            //return $query->row('titles');
            return $query->row_array();
        }else{
            return "";
        }
    }


    function fetchAgents($tbl){
        $this->db->select('names, phone, wallet')->from($tbl);
        $this->db->where('agents', 2)->where('wallet >=', 1000);
        $this->db->order_by('id', 'desc');
        //$this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function isUserId($user_id){
        $this->db->select('id')->from('members')->where('id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function getQty($pid){
        $this->db->select('qty_sold');
        $this->db->from('purchases')->where('md5(id)', $pid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('qty_sold');
        }else{
            return false;
        }
    }


    function countAllNotiAndDelete(){
        $allNotify = $this->db->from("all_notifications")->count_all_results();
        if($allNotify>500){
            $this->db->query("DELETE FROM all_notifications ORDER BY id LIMIT 200");
        }
    }


    
    function deleteTblRecords($txt_dbase_table, $txtall_id){
        if($txt_dbase_table == "view_contests"){
            $this->db->select('files')->from('contests')->where('id', $txtall_id);
            $query = $this->db->get();
            $files = $query->row('files');
            $in_folder1="contest_types/$files";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('all_votes');

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('boost_ads');

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('comments');

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('contest_codes');


            $this->db->select('files')->from('entry_media')->where('contest_id', $txtall_id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $query1 = $query->result_array();
                foreach ($query1 as $row) {
                    $files = $row['files'];
                    $in_folder1="media_uploads/$files";
                    if(is_readable($in_folder1)) @unlink($in_folder1);
                }
            }
            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('entry_media');

            //$this->db->where('contest_id', $txtall_id);
            //$this->db->delete('entries_fee'); // i left this for account records

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('entries');

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('replies');

            $this->db->where('contest_id', $txtall_id);
            $this->db->delete('winners');

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('contests');
        }

        if($txt_dbase_table == "sponsored_contests"){
            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('boost_ads');
        }

        if($txt_dbase_table == "members"){
            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('members');
        }

        if($txt_dbase_table == "view_adverts"){
            $this->db->select('files')->from('adverts')->where('id', $txtall_id);
            $query = $this->db->get();
            $files = $query->row('files');
            $in_folder1="adverts1/$files";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('adverts');
        }

        if($txt_dbase_table == "viewquestions"){
            $this->db->select('files')->from('quiz_questions')->where('id', $txtall_id);
            $query = $this->db->get();
            $files = $query->row('files');
            $in_folder1="quizes/$files";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('quiz_questions');
        }

        if($txt_dbase_table == "view_quiz"){
            $this->db->select('files')->from('quiz_questions')->where('quiz_section_id', $txtall_id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $query1 = $query->result_array();
                foreach ($query1 as $row) {
                    $files = $row['files'];
                    $in_folder1="quizes/$files";
                    if(is_readable($in_folder1)) @unlink($in_folder1);
                }
            }
            $this->db->where('quiz_section_id', $txtall_id);
            $this->db->delete('quiz_questions');

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('quiz_section');
        }

        if($txt_dbase_table == "entries"){
            $this->db->select('contest_id, contestant_id')->from('entries')->where('id', $txtall_id);
            $query = $this->db->get();
            $contest_id = $query->row('contest_id');
            $contestant_id = $query->row('contestant_id');

            $this->db->select('files')->from('entry_media')->where('contest_id', $txtall_id)->where('contestant_id', $contestant_id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $query1 = $query->result_array();
                foreach ($query1 as $row) {
                    $files = $row['files'];
                    $in_folder1="media_uploads/$files";
                    if(is_readable($in_folder1)) @unlink($in_folder1);
                }
            }
            $this->db->where('contest_id', $contest_id)->where('contestant_id', $contestant_id);
            $this->db->delete('entry_media');

            $this->db->where('id', $txtall_id);
            $this->db->delete('entries');
        }

        if($txt_dbase_table == "view_rewards"){
            $this->db->select('id, file1, file2, file3')->from('reward_tbl')->where('id', $txtall_id);
            $query = $this->db->get();
            $ids = $query->row('id');
            $file1 = $query->row('file1');
            $file2 = $query->row('file2');
            $file3 = $query->row('file3');
            $in_folder1="lottery_prizes/$file1";
            $in_folder2="lottery_prizes/$file2";
            $in_folder3="lottery_prizes/$file3";
            if(is_readable($in_folder1)) @unlink($in_folder1);
            if(is_readable($in_folder2)) @unlink($in_folder2);
            if(is_readable($in_folder3)) @unlink($in_folder3);

            $this->db->where('reward_id', $ids);
            $this->db->delete('raffle_numbers');

            $this->db->where('id', $txtall_id);
            $this->db->delete('reward_tbl');
        }

        if($query) return true; else return false;
    }

    

    function fetchRaffles(){
        $now = time();
        $this->db->select('rns.id AS id1,rns.reward_id,rns.selecteds,rns.mynumbers')->from('raffle_numbers rns');
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->where('rwt.timings >=', $now)->where('rwt.approved', 1);
        //$this->db->order_by('rns.mynumbers', 'rand()');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchRafflesDetls(){
        $now = time();
        $this->db->select('rwt.*, rwt.id AS id1')->from('reward_tbl rwt')->where('rwt.approved', 1);
        $this->db->join('raffle_numbers rns', 'rwt.id = rns.reward_id');
        //$this->db->where('rwt.timings >=', $now);
        $this->db->order_by('rwt.id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }



    function quizQuestions($tasks, $qid_intro, $rowno, $rowperpage){

        // if already in session, use it instead of generating rand again
        $allRandIDs = $this->session->userdata('allRandIDs');

        if(empty($allRandIDs)){ // if not set
            $allRandIDs = $this->fetchRandomIDs($qid_intro);

            $newdata3 = array(
                'allRandIDs'     => $allRandIDs
            );
            $this->session->set_userdata($newdata3); // store quiz IDs instead of using rand()

            //echo "mmmmmmgg";
        }

        $allRandIDs = $this->session->userdata('allRandIDs');

        //print_r($allRandIDs);
        //echo "<br>hhhhh<br>";


        $this->db->select('qq.id AS ids, qq.questions, qq.files, qq.op1, qq.op2, qq.op3, qq.op4, qq.ans1, qq.explanations')->from('quiz_questions qq')->where('qi.approved', 1);

        $allQuizIDs2 = "";
        $allQuizIDs2i = "";

        if($allRandIDs){
            foreach ($allRandIDs as $value) {
                $allQuizIDs2 .= $value['id'].",";
            }
        
            foreach ($allRandIDs as $value) {
                $allQuizIDs2i .= "'".$value['id']."',"; // so that it has array of '20', '18', '29'
            }

            $allQuizIDs3 = substr($allQuizIDs2i, 0, -1); // use it on order_by

            //echo "$allQuizIDs3<br>ggggg<br>";

            $allQuizIDs2 = substr($allQuizIDs2, 0, -1);
            $allQuizIDs2 = explode(',', $allQuizIDs2);
            $allQuizIDs1 = array_unique($allQuizIDs2);

            $this->db->where_in('qq.id', $allQuizIDs1);
        }

        $this->db->join('quiz_section qi', 'qi.id = qq.quiz_section_id');
        
        if($allRandIDs){
            $this->db->_protect_identifiers = FALSE;
            $this ->db->order_by("FIELD(qq.id, $allQuizIDs3)");
            $this->db->_protect_identifiers = TRUE;
        }

        if($rowperpage!="" || $rowno!="")
            $this->db->limit($rowperpage, $rowno);


        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }



    function countQuestions($tasks, $qid_intro){
        $this->db->select('qq.id AS allcount')->from('quiz_questions qq')->where('qi.approved', 1);
        $this->db->join('quiz_section qi', 'qi.id = qq.quiz_section_id');
        $this->db->order_by('qq.id', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }



    function fetchRandomIDs($qid_intro){
        $this->db->select('qq.id')->from('quiz_questions qq')->where('qi.approved', 1)->where('qi.id', $qid_intro);
        $this->db->join('quiz_section qi', 'qi.id = qq.quiz_section_id');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    /*function already_started($get_mems_id, $qid_intro, $subject_id, $ids_arr){
        $this->db->select('attempts')->from('stud_start_test sst');
        $this->db->where('sst.quiz_intro_id', $qid_intro)->where('sst.memid', $get_mems_id)->where('sst.started_test', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('attempts');
        }else{
            return 0;
        }
    }*/


    function submitted_attempts($get_mems_id, $qid_intro){
        $this->db->select('id')->from('member_answers');
        $this->db->where('quiz_section_id', $qid_intro);
        $this->db->where('memid', $get_mems_id);
        return $this->db->count_all_results();
    }



    function updateRecs1($id_sch, $memid, $submitted_attempts){
        $this->db->select('id')->from('stud_start_test')->where('memid', $memid)->where('quiz_section_id', $id_sch);

        $query = $this->db->get();
        $id1 = $query->row('id');

        if($query->num_rows() > 0){
            $this->db->where('id', $id1);
            $this->db->set('attempts', $submitted_attempts, FALSE);
            $query = $this->db->update('stud_start_test');
            if(!$query){ // incase i open another test in a new window, it shud update my id instead

                $this->db->select('id')->from('stud_start_test')->where('memid', $memid)->where('attempts >', 0);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $this->db->where('memid', $memid)->where('attempts >', 0);
                    $this->db->set('attempts', $submitted_attempts, FALSE);
                    $query = $this->db->update('stud_start_test');

                }else{
                    $this->db->where('memid', $memid);
                    $query = $this->db->delete('stud_start_test');
                }
            }

        }else{ // delete
            $this->db->where('id', $id1);
            $query = $this->db->delete('stud_start_test');
        }
        if($query) return true; else return false;
    }



    function computeScores($ids1, $mem_ans){
        $mem_ans = str_replace(array("′", "'"), "&prime;", $mem_ans);
        $this->db->select('id')->from('quiz_questions');
        $this->db->where('id', $ids1)->where('ans1', $mem_ans);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }



    function totlQuestions($qid_intro){
        $this->db->select('count(qu.id) as allcount')->from('quiz_questions qu');
        $this->db->where('qi.approved', 1)->where('quiz_section_id', $qid_intro);
        $this->db->join('quiz_section qi', 'qi.id = qu.quiz_section_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return ($result ? $result[0]['allcount'] : 0);
    }


    function insert_scores($data){
        $query1 = $this->db->insert('member_answers', $data);
        if($query1)
            return true;
        else
            return false;
    }


    function showMyPerformanceTbl2($id_sch, $memid){
        $this->db->select('sa.answers, sa.ids')->from('member_answers sa');
        $this->db->where('sa.quiz_section_id', $id_sch);
        if($memid!="")
        $this->db->where('sa.memid', $memid);
        $this->db->order_by('sa.id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return 0;
        }
    }


    function getQuizOrigin($id){
        $this->db->select('ans1, questions, op1, op2, op3, op4, explanations')->from('quiz_questions')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return 0;
        }
    }



    function getDetls($id_sch){
        $this->db->select('sa.scores, sa.time_finished');
        $this->db->from('member_answers sa')->where('sa.quiz_section_id', $id_sch)->where('sa.memid', $this->myID);
        $this->db->join('quiz_section qz', 'qz.id = sa.quiz_section_id');
        $this->db->order_by('sa.id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }



    function adminSettings(){
        $this->db->select('*')->from('settings1')->where('id', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    
    function hasRegistered($email, $txtpass, $tbl){
        $this->db->select('id, pass1')->from($tbl)->where('emails', $email)->where('pass1', $txtpass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function adminAdvSettings(){
        $this->db->select('*')->from('advert_settings');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function expiredRaffle($raf_id){
        $now = time();
        $this->db->select('rwt.id')->from('reward_tbl rwt');
        $this->db->where('rwt.timings >', $now)->where('rwt.completed', 0)->where('rwt.id', $raf_id)->where('rwt.approved', 1);
        $this->db->order_by('rwt.id', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function fetchRafflesWinners(){
        $now = time();
        $this->db->select('rwt.*, rwt.id AS id1, mem.names, mem.nickname, rwt.id AS rw_id, rns.selecteds, rns.rand_numbers, rns.mynumbers')->from('raffle_numbers rns')->where('rwt.approved', 1);
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->join('members mem', 'mem.id = rns.selecteds');
        $this->db->where('rwt.timings <=', $now)->where('rwt.completed', 1);
        $this->db->group_by('rns.selecteds');
        $this->db->order_by('rns.selecteds', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function selectedNos($reward_id, $selecteds1){
        $now = time();
        $this->db->select('rns.mynumbers')->from('raffle_numbers rns');
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->where('rns.reward_id', $reward_id)->where('rns.selecteds', $selecteds1);
        $this->db->where('rwt.timings <=', $now)->where('rwt.completed', 1)->where('rwt.approved', 1);
        $this->db->order_by('rns.selecteds', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function luckyNos($reward_id, $rand_numbers, $mynumbers){
        $now = time();
        $this->db->select('rwt.rand_nums1, rwt.rand_nums2, rwt.rand_nums3, rns.rand_numbers')->from('raffle_numbers rns');
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->where('rns.reward_id', $reward_id);
         $this->db->where('rns.mynumbers', $mynumbers);
        $this->db->where('rwt.completed', 1)->where('rwt.approved', 1);
        $this->db->order_by('rns.selecteds', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
            //return true;
        }else{
            return false;
        }
    }



    function get_ID($id, $tbl){
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function getQuizes($id){
        $this->db->select('*');
        $this->db->from('quiz_questions qq')->where('md5(qq.id)', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;    
        }
    }


    function update_inserts_quizes($data, $txtquizid, $sqls, $tbl, $params){
        $results = false;
        if($txtquizid != ""){
            $this->db->where('md5(id)', $txtquizid);
             $query1 = $this->db->update($tbl, $data);
        }else{
            if($sqls=="insert")
                $query1 = $this->db->insert($tbl, $data);
            else
                $query1 = $this->db->insert_batch($tbl, $data);
        }

        if($query1) $results = true; else $results = false;

        return ($results) ? true : false;

        /*if($params==""){
            if($results){
                $this->db->select('id')->from($tbl);
                $this->db->where('md5(id)', $txtquizid);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    return $query->row('id');
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return ($results) ? true : false;
        }*/
    }


    function getTestDetails($getId){
        $cookie_sess = $this->input->cookie('cookie_sess', TRUE);
        $this->db->select('quiz_title, subj, seconds')->from('quiz_section')->where('md5(id)', $getId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function getArrayID($id, $tbl){
        $this->db->select('vts.*, mem.id AS id1, mem.names AS name1, mem1.names AS name2, cons.title')->from('all_votes vts');
        $this->db->join('members mem', 'mem.id = vts.contestant_id');
        $this->db->join('members mem1', 'mem1.id = vts.voter');
        $this->db->join('contests cons', 'cons.id = vts.contest_id');
        $this->db->where('vts.voter', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchStates(){
        $query = $this->db->get('states');
        return $query;
    }

    
    function fetchCitys($id){
        $this->db->select('*')->from('local_governments')->where('state_id', $id);
        $query = $this->db->get();
        return $query;
    }


    function countProducts($cid, $tbl){
        $this->db->select('id as allcount')->from($tbl);
        if($cid!=""){
            if($cid>0) $this->db->where('contest_id', $cid);
        }
        $this->db->where('disqualify', 0);
        
        $this->db->group_by('contestant_id');

        $query = $this->db->get();
        return $query->num_rows();
        // $result = $query->result_array();
        // return ($result ? $result[0]['allcount'] : 0);
    }


    function delete_memb_pics($file1, $folders){
        $in_folder1 = $folders.$file1;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }


    function countProducts1($cid, $txtsrch, $txtpre, $tbl){
        $this->db->select('entr.id as allcount')->from($tbl.' entr');
        $this->db->join('members mem', 'mem.id = entr.contestant_id');
        //$this->db->join('contests cons', 'cons.id = entr.contest_id');

        if($cid!=""){
            if($cid>0) $this->db->where('contest_id', $cid);
        }
        $this->db->where('entr.disqualify', 0);
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(mem.names like '%$txtsrch%' OR mem.nickname like '%$txtsrch%')";
            $this->db->where("$srchs");
        }
        if($txtpre == "high"){
            $this->db->order_by('entr.votes', 'desc');

        }else if($txtpre == "low"){
            $this->db->order_by('entr.votes', 'asc');

        }else if($txtpre == "old"){
            $this->db->order_by('entr.id', 'asc');

        }else{
            $this->db->order_by('entr.id', 'desc');
        }

        $this->db->group_by('entr.contestant_id');
        $query = $this->db->get();
        return $query->num_rows();
    }



    function fetchProducts($cid, $txtsrch, $txtpre, $rowno, $rowperpage, $tbl, $colums){
        $this->db->select('entr.*, entr.id AS id1, mem.id AS memid1, mem.names, mem.nickname, mem.online_timing, mem.pics, mem.views AS views2, sts.name AS states1, lgs.name AS citys1, cons.title, cons.user_id, cons.start_date_contest, cons.timings, cons.media_type, cons.id AS con_id, cons.company_ads, cons.files')->from($tbl.' entr');

        $this->db->join('members mem', 'mem.id = entr.contestant_id');
        $this->db->join('contests cons', 'cons.id = entr.contest_id');

        $this->db->join('states sts', 'sts.id = mem.states');
        $this->db->join('local_governments lgs', 'lgs.id = mem.citys');

        if($cid!="" && $cid>0) $this->db->where('contest_id', $cid);
        $this->db->where('cons.approved', 1)->where('entr.disqualify', 0);
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(mem.names like '%$txtsrch%' OR mem.nickname like '%$txtsrch%' OR sts.name like '%$txtsrch%' OR lgs.name like '%$txtsrch%')";
            $this->db->where("$srchs");
        }
        if($txtpre == "high"){
            $this->db->order_by('entr.votes', 'desc');

        }else if($txtpre == "low"){
            $this->db->order_by('entr.votes', 'asc');

        }else if($txtpre == "old"){
            $this->db->order_by('entr.id', 'asc');
        }else{
            $this->db->order_by('entr.id', 'desc');
        }
        //$this->db->order_by('entr.id', 'desc');

        $this->db->group_by('entr.contestant_id');

        if($colums!="") $this->db->order_by('entr.'.$colums, 'desc'); else $this->db->order_by('entr.id', 'desc');
        
        if($rowperpage!="" || $rowno!="")
            $this->db->limit($rowperpage, $rowno);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchProductsLeader($cid, $txtsrch, $txtpre, $rowno, $rowperpage, $tbl, $colums){
        $this->db->select('entr.*, entr.id AS id1, mem.names, mem.online_timing, mem.nickname, mem.pics, mem.views AS views2, sts.name AS states1, lgs.name AS citys1, cons.title, cons.user_id, cons.start_date_contest, cons.timings, cons.media_type, cons.id AS con_id')->from($tbl.' entr');
        $this->db->join('members mem', 'mem.id = entr.contestant_id');
        $this->db->join('contests cons', 'cons.id = entr.contest_id');

        $this->db->join('states sts', 'sts.id = mem.states');
        $this->db->join('local_governments lgs', 'lgs.id = mem.citys');

        if($cid!="" && $cid>0) $this->db->where('contest_id', $cid);
        $this->db->where('cons.approved', 1)->where('entr.disqualify', 0);
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(mem.names like '%$txtsrch%' OR mem.nickname like '%$txtsrch%' OR sts.name like '%$txtsrch%' OR lgs.name like '%$txtsrch%')";
            $this->db->where("$srchs");
        }
        if($txtpre == "high"){
            $this->db->order_by('entr.votes', 'desc');

        }else if($txtpre == "low"){
            $this->db->order_by('entr.votes', 'asc');

        }else if($txtpre == "old"){
            $this->db->order_by('entr.id', 'asc');
        }
        //$this->db->order_by('entr.id', 'desc');

        $this->db->group_by('entr.contestant_id');
        if($colums!="") $this->db->order_by('entr.'.$colums, 'desc'); else $this->db->order_by('entr.id', 'desc');
        
        if($rowperpage!="" || $rowno!="")
            $this->db->limit($rowperpage, $rowno);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchQuizScoresLB($quiz_sec_id){
        $SQLS = "SELECT mem.names, mem.nickname, mem.pics, ma.scores, ma.date_taken, ma.memid, ma.answers 
        FROM member_answers ma 
        JOIN members mem ON mem.id = ma.memid 
        JOIN quiz_section qi ON qi.id = ma.quiz_section_id 
        WHERE (qi.approved=1 AND qi.id='$quiz_sec_id')
        AND ma.id IN (SELECT MAX(id) FROM member_answers) 
        GROUP BY ma.memid, ma.quiz_section_id 
        ORDER BY ma.id DESC
        LIMIT 10";
        
        $query = $this->db->query($SQLS);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchQuizWinnerssLB(){
        $SQLS = "SELECT mem.names, mem.nickname, mem.pics, ma.scores, ma.date_taken, ma.memid, ma.answers, qi.quiz_title, qw.positns,
        qi.prize1, qi.prize2, qi.prize3, qi.prize4, qi.prize5
        FROM quiz_winners qw 
        JOIN members mem ON mem.id = qw.memid
        JOIN member_answers ma ON mem.id = ma.memid 
        JOIN quiz_section qi ON qi.id = qw.quiz_section_id 
        WHERE (qi.approved=1 AND qi.completed=1)
        
        GROUP BY ma.memid, qw.quiz_section_id 
        ORDER BY qw.id DESC
        LIMIT 20";
        //AND ma.id IN (SELECT MAX(id) FROM quiz_winners) 
        
        $query = $this->db->query($SQLS);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }




    function countMyRecs($cid, $tbl, $url_titles){
        $this->db->select('id as allcount')->from($tbl);
        if($cid!=""){
            if($cid>0) $this->db->where('id', $cid);
        }
        $this->db->where('approved', 1);

        if($url_titles!=""){
            $url_titles = str_replace("__", " & ", $url_titles);
            $url_titles = str_replace("_", " ", $url_titles);

            $terms = explode(' ', $url_titles);
            foreach($terms as $term){
                $where = "sponsoredby like '%$term%' ";
            }
            $this->db->where($where);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }


    function countMyBlogs($cid, $tbl){
        $this->db->select('id as allcount')->from($tbl);
        if($cid!=""){
            if($cid>0) $this->db->where('id', $cid);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }


    function countMyContests($cid, $tbl){
        $this->db->select('count(id) as allcount')->from($tbl);
        if($cid!=""){
            if($cid>0) $this->db->where('contest_id', $cid);
        }
        if($tbl!="entries")
            $this->db->where('approved', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return ($result ? $result[0]['allcount'] : 0);
    }


    function countMyRecs1($cid, $txtsrch, $txtpre, $tbl, $url_titles){
        $this->db->select('conts.id as allcount')->from($tbl.' conts');

        if($cid!=""){
            if($cid>0) $this->db->where('conts.id', $cid);
        }
        $this->db->where('conts.approved', 1);
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(conts.title like '%$txtsrch%' OR conts.descrip like '%$txtsrch%')";
            $this->db->where("$srchs");
        }

        if($txtpre!=""){
            if($txtpre=="free"){
                $this->db->where("(conts.entry_type='$txtpre' or conts.entry_type='')");
            }else{
                $this->db->where("(conts.entry_type='$txtpre')");
            }
        }

        if($url_titles!=""){
            $url_titles = str_replace("__", " & ", $url_titles);
            $url_titles = str_replace("_", " ", $url_titles);

            $terms = explode(' ', $url_titles);
            foreach($terms as $term){
                $where = "conts.sponsoredby like '%$term%' ";
            }
            $this->db->where($where);
        }

        $query = $this->db->get();
        return $query->num_rows();
        // $result = $query->result_array();
        // return ($result ? $result[0]['allcount'] : 0);
    }


    function relatedBlogs($titles, $cid1){
        $this->db->select('*')->from('blogs');
        $where = "id != '$cid1' AND (";

        $terms = explode(' ',$titles);
        foreach($terms as $term){
            $where .= "titles like '%$term%' OR ";
        }
        $where = substr($where, 0, -4);
        $where .= ")";

        $this->db->where($where);

        $this->db->limit(4);
        $this->db->order_by('views', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function countMyBlogs1($cid, $txtsrch, $tbl){
        $this->db->select('*')->from($tbl.' blg');
        
        if($cid!=""){
            if($cid>0) $this->db->where('blg.id', $cid);
        }
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(blg.titles like '%$txtsrch%' OR blg.contents like '%$txtsrch%')";
            $this->db->where("$srchs");
        }

        $query = $this->db->get();
        return $query->num_rows();
    }


    function fetchMyRecs($cid, $txtsrch, $txtpre, $rowno, $rowperpage, $tbl, $params, $url_titles){
        $now=time();
        if($params==""){
            $this->db->select('conts.*, conts.id AS id1, mem.names')->from($tbl.' conts');
            $this->db->join('members mem', 'mem.id = conts.user_id');
        }else{
            $this->db->select('conts.*, MAX(entr.votes) AS num_cnts')->from($tbl.' conts');
            $this->db->join('entries entr', 'entr.contest_id = conts.id');
        }

        //if($cid!="") $this->db->where('conts.id', $cid);
        if($cid!=""){
            if($cid>0) $this->db->where('conts.id', $cid);
        }

        if($url_titles!=""){
            $url_titles = str_replace("__", " & ", $url_titles);
            $url_titles = str_replace("_", " ", $url_titles);

            $terms = explode(' ', $url_titles);
            foreach($terms as $term){
                $where = "conts.sponsoredby like '%$term%' ";
            }
            $this->db->where($where);
        }

        $this->db->where('conts.approved', 1);
        if($params!="")
            $this->db->where('entr.disqualify', 0);
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(conts.title like '%$txtsrch%' OR conts.descrip like '%$txtsrch%')";
            $this->db->where("$srchs");
        }

        if($txtpre!=""){
            if($txtpre=="free"){
                $this->db->where("(conts.entry_type='$txtpre' or conts.entry_type='')");

            }else if($txtpre=="active"){
                $this->db->where("(conts.completed=0 AND conts.timings >= $now)");

            }else if($txtpre=="new"){
                //$this->db->where("(conts.completeds=0)");
                $this->db->where('conts.completed', 0);

            }else{
                $this->db->where("(conts.entry_type='$txtpre')");
            }
        }

        if($params=="trend"){
            $this->db->where('conts.completed', 0);
            $this->db->group_by('entr.contest_id');
            $this->db->order_by('num_cnts', 'desc');
        }else{
            $this->db->order_by('id', 'desc');
        }
        
        if($rowperpage!="" || $rowno!="") $this->db->limit($rowperpage, $rowno);

        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchMyBlogs($cid, $txtsrch, $rowno, $rowperpage, $tbl, $params){
        $this->db->select('*')->from($tbl.' blg');
        
        if($cid!=""){
            if($cid>0) $this->db->where('blg.id', $cid);
        }
        
        if(isset($txtsrch) && $txtsrch!=""){
            $srchs = "(blg.titles like '%$txtsrch%' OR blg.contents like '%$txtsrch%')";
            $this->db->where("$srchs");
        }

        $this->db->order_by('blg.id', 'desc');
        
        if($rowperpage!="" || $rowno!="") $this->db->limit($rowperpage, $rowno);

        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    

    function fetchMyLatestBlogs($tbl, $limit){
        $this->db->select('*')->from($tbl);
        $this->db->order_by('id', 'desc');
        if($limit!="") $this->db->limit($limit);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function isBlocked($myid, $herid){
        $this->db->select("users")->from('block_chat_user');
        //$this->db->where('memid', $myid)->where('users', $herid);
        $srchs = "(memid='$myid' AND users='$herid') OR (memid='$herid' AND users='$myid')";
        $this->db->where($srchs);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('users');
        else
            return false;
    }


    function whoBlocked($myid, $herid){
        $this->db->select("mem.names, mem.nickname")->from('block_chat_user bcu');
        $this->db->where('memid', $herid)->where('users', $myid);
        //$this->db->where('memid', $herid)->where('users >', 0);
        $this->db->join('members mem', 'mem.id = bcu.memid');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $names = $query->row('names');
            $nickname = $query->row('nickname');
            if(strlen($names)<=2) $names = ucwords($nickname);
            return $names;
        }else{
            return false;
        }
    }



    function turnOffCommenting($myid, $con_id){
        $this->db->select("bcu.id")->from('turn_off_cmts bcu');
        $this->db->where('contest_id', $con_id)->where('memid', $myid);
        $this->db->join('contests cons', 'cons.id = bcu.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function noOfEntries($tbl, $id){
        $this->db->select("id")->from($tbl);
        if($id!="") $this->db->where('contest_id', $id);
        $this->db->where('disqualify', 0);
        $this->db->group_by('contestant_id');
        $query = $this->db->get();
        return $query->num_rows();
        //return $this->db->count_all_results();
    }


    function getNotifyDetails($tbl, $memid){
        $this->db->select("what_page")->from($tbl);
        $this->db->where('user_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('what_page');
        }else{
            return "";
        }
    }


    function fetchNotificatns($tbl, $memid){
        $this->db->select("memid, what_page, page_id, has_read, date_created, actns")->from($tbl);
        $this->db->where('user_id', $memid);
        //$this->db->group_by('page_id', 'actns');
        //$this->db->group_by('actns');
        $this->db->order_by('date_created', 'desc');
        $this->db->limit(15);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function getCmtFollowers($tbl, $memid, $txtcontID, $rec_id, $columns){
        $this->db->select($columns)->from($tbl);
        if($rec_id!="")
            $this->db->where('memid', $rec_id);
        $this->db->where('contest_id', $txtcontID)->where('memid !=', $memid);
        $this->db->order_by('date_created', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    
    function checkDuplicate($tbl, $myid, $memid2, $txt_url_params_ID){
        $this->db->select("id")->from($tbl);
        $this->db->where('memid', $myid)->where('user_id', $memid2)->where('page_id', $txt_url_params_ID)->where('has_read', 0);
        $this->db->group_by('user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function checkWithdrawalDuplicate($memid, $amt){
        $this->db->select("id")->from("request_withdrawals");
        $this->db->where('memid', $memid)->where('amt', $amt)->where('answered', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function memCounts($tbl, $myID, $page_id, $actns){
        $this->db->select("id")->from($tbl);
        $this->db->where('user_id', $myID)->where('page_id', $page_id)->where('actns', $actns);
        //$this->db->group_by('memid', 'page_id');
        //$this->db->group_by('memid', 'actns');
        $query = $this->db->get();
        return $query->num_rows();
        //return $this->db->count_all_results();
    }

    
    function noOfChats($memid){
        $myid = $this->myID;
        $this->db->select("id")->from('chatwithme');
        //$this->db->where('recipient_id', $memid)->where('status', 0);
        $this->db->where('memid', $memid)->where('recipient_id', $myid)->where('status', 0);
        $query = $this->db->get();
        $counts = $query->num_rows();
        //$counts = $this->db->count_all_results();
        if($counts > 0)
            return "<font class='mychat mychats$memid'><span>$counts</span></font>";
        else
            return "";
    }


    function cnstCmtCount($tbl, $myID){
        $this->db->select("id")->from($tbl);
        $this->db->where('user_id', $myID);
        $this->db->group_by('user_id', 'page_id');
        $query = $this->db->get();
        return $query->num_rows();
    }


    function cntCmtID($tbl, $myID){
        $this->db->select("page_id")->from($tbl);
        $this->db->where('user_id', $myID);
        $this->db->group_by('page_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }




    function noOfChats1($memid){
        $myid = $this->myID;
        $this->db->select("id")->from('chatwithme');
        $this->db->where('recipient_id', $memid)->where('status', 0);
        //$srchs = "( (recipient_id='$myid' AND memid='$memid') OR (recipient_id='$memid' AND memid='$myid') )";
        //$srchs = "(recipient_id='$myid' AND memid='$memid') OR (recipient_id='$memid' AND memid='$myid')";
        //$srchs = "(recipient_id='$myid')";
        //$this->db->where($srchs)->where('status', 0);
        //$this->db->group_by('recipient_id');
        $query = $this->db->get();
        $counts = $query->num_rows();
        //$counts = $this->db->count_all_results();
        if($counts > 0)
            return $counts;
        else
            return 0;
    }


    function fetchBoosted($contestids, $memid){
        $this->db->select("votes")->from("bstd_vts bv");
        $this->db->where('bv.contestant_id', $memid)->where('bv.contest_id', $contestids);
        $this->db->join('contests cons', 'cons.id = bv.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('votes');
        }else{
            return 0;
        }
    }


    /*function fetchVoterBoosted($contestids, $memid){
        $this->db->select("votes")->from("bstd_vts bv");
        $this->db->where('bv.voter', $memid)->where('bv.contest_id', $contestids);
        $this->db->join('contests cons', 'cons.id = bv.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('votes');
        }else{
            return 0;
        }
    }*/


    function fetchVoterBoosted($memid, $contest_id, $contestant_id){
        $this->db->select("votes")->from("bstd_vts");
        if($memid!="")
            $this->db->where('voter', $memid);
        if($contestant_id!="")
            $this->db->where('contestant_id', $contestant_id);
        if($contest_id!="")
            $this->db->where('contest_id', $contest_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('votes');
        }else{
            return 0;
        }
    }


    function updateOnlinePresence($memid){
        $online_timing = strtotime('+5 minutes', time());
        $this->db->set('online_timing', $online_timing);
        $this->db->where('id', $memid)->update('members');
    }


    function chkOnlinePresence($memid){
        $this->db->select("online_timing")->from('members');
        $this->db->where('id', $memid)->where('online_timing >', time());
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return "green";
        }else{
            return "ash";
        }
    }


    function calCounts($tbl, $groupby1, $join, $admins){
        $this->db->select($tbl.".id")->from($tbl);
        if($tbl=="contests" && $admins=="")
            $this->db->where('approved', 1);
        if($join!=""){
            $this->db->join($join, $join.'.id = '.$tbl.'.contestant_id');
        }
        if($groupby1!=""){
            $this->db->group_by($tbl.".".$groupby1);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }


    function calCounts1($tbl, $groupby1, $join, $contest_id){
        $this->db->select($tbl.".id")->from($tbl);
        if($contest_id!="")
            $this->db->where('contest_id', $contest_id);
        if($join!=""){
            $this->db->join($join, $join.'.id = '.$tbl.'.contestant_id');
        }
        if($groupby1!=""){
            $this->db->group_by($tbl.".".$groupby1);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }


    function calRows($tbl, $memid){
        $this->db->select('id')->from($tbl);
        if($memid!="")
            $this->db->where('contestant_id', $memid);;
        $query = $this->db->get();
        return $query->num_rows();
    }



    function getCounts($tbl, $ids, $columns){
        $this->db->select($columns)->from($tbl);
        $this->db->where('voter', $ids);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $cols += $row[$columns];
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function calCounts_bst($tbl){
        $this->db->select("boost_ads.id")->from($tbl);
        $this->db->where('paid', 0);
        $this->db->join('contests', 'contests.id = boost_ads.contest_id');
        $query = $this->db->get();
        return $query->num_rows();
    }


    function countADSizes($sizes){
        $this->db->select("id")->from('adverts')->where('sizes', $sizes);
        $query = $this->db->get();
        return $query->num_rows();
    }


    function fetchRaffleEntries($params){
        $now=time();
        $this->db->select("rns.id")->from('raffle_numbers rns');
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->where('rwt.timings >=', $now)->where('rwt.approved', 1);
        if($params=="entrs")
            $this->db->where('rns.selecteds >', 0);
        else
            $this->db->where('rns.selecteds <=', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }


    function noOfEntriesParticipated($tbl, $memid){
        $this->db->select("id")->from($tbl);
        $this->db->where('contestant_id', $memid);
        //$this->db->group_by('contest_id, contestant_id');
        //return $this->db->count_all_results();
        $query = $this->db->get();
        return $query->num_rows();
    }


    function noOfVotes($tbl, $id, $columns){
        $this->db->select("votes")->from($tbl);
        if($tbl=="contests"){
            if($id!="") $this->db->where('contest_id', $id);
            $this->db->where('approved', 1);
        }else{
            if($tbl=="entries"){
                if($columns=="contestants"){
                    if($id!="") $this->db->where('contestant_id', $id);
                }else{
                    if($id!="") $this->db->where('contest_id', $id);
                }
            }else{
                if($id!="") $this->db->where('voter', $id);
            }
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $cols += $row["votes"];
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function myTotalVotes($tbl, $id, $contest_id){
        $this->db->select("votes")->from($tbl);
        if($id!="") $this->db->where('contestant_id', $id)->where('contest_id', $contest_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $cols += $row["votes"];
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function noOfVotes1($memid, $contest_id, $tbl){
        $this->db->select("votes")->from($tbl);
        $this->db->where('contest_id', $contest_id)->where('contestant_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $cols += $row["votes"];
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function noOfPVS($tbl, $id){
        $this->db->select("vp")->from($tbl);
        if($id!="") $this->db->where('voter', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $cols += $row["vp"];
            }
            return $cols;
        }else{
            return 0;
        }
    }


    function noOfContestantVotes($memid){
        $now=time();
        $this->db->select("votes")->from("entries entr");
        $this->db->where('entr.contestant_id', $memid)->where('cons.timings >=', $now);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('votes');
        }else{
            return 0;
        }
    }


    function totalNoOfContestantVotes($memid){
        $now=time();
        $this->db->select("votes")->from("entries entr");
        $this->db->where('entr.contestant_id', $memid);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $counts = $row['votes'];
                $cols += $counts;
            }
            return $cols;
        }else{
            0;
        }
    }


    function isInEntries($contest_id, $memid){
        $this->db->select("id")->from("entries");
        $this->db->where('contestant_id', $memid)->where('contest_id', $contest_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function myEntrs1($tbl, $memID){
        $this->db->select('entr.contestant_id, entr.contest_id, entr.votes')->from($tbl);
        $this->db->where('entr.contestant_id', $memID)->where('entr.disqualify', 0);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $this->db->order_by('entr.id', 'desc');
        $this->db->limit(30);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }


    function myEntrs($tbl, $contest_id, $memID){
        $this->db->select('entr.files, entr.descrip')->from($tbl);
        $this->db->where('entr.contestant_id', $memID)->where('entr.contest_id', $contest_id);
        $this->db->where('entr.disqualify', 0);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $this->db->join('entries ee', 'ee.contest_id = entr.contest_id');
        $this->db->group_by('entr.files');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }


    function chechOnlineHidden($memid){
        $this->db->select("id")->from("members");
        $this->db->where('id', $memid)->where('online_visibility', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function myEntrsMedia($contest_id, $contestant_id){
        $this->db->select("*")->from("entry_media");
        $this->db->where('contest_id', $contest_id)->where('contestant_id', $contestant_id);
        $querys = $this->db->get();
        if($querys->num_rows() > 0){
            return $querys->row_array();
        }else{
            return false;
        }
    }


    function fetchMyChats($myid, $memid){
        $this->db->select("cht.*, cht.id As id1, mem.nickname, mem.pics, mem.online_timing")->from("chatwithme cht");
        //$srchs = "(cht.recipient_id='$memid' AND (cht.recipient_id='$this->myID' OR cht.memid='$this->myID') )";
        $srchs = "((cht.recipient_id='$myid' AND cht.memid='$memid') OR (cht.recipient_id='$memid' AND cht.memid='$myid') )";
        $this->db->where($srchs);

        $this->db->join('members mem', 'mem.id = cht.memid');
        $this->db->order_by('id', 'asc');
        $this->db->limit(100);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchMyCmts($myid, $con_id){
        $this->db->select("cht.*, cht.id As id1, mem.nickname, mem.pics, mem.online_timing")->from("mycomments cht");
        $this->db->where('cht.memid', $myid)->where('cht.contest_id', $con_id);

        $this->db->join('members mem', 'mem.id = cht.commenter_id');
        //$this->db->join('members mem', 'mem.id = cht.memid');
        $this->db->order_by('cht.id', 'asc');
        $this->db->limit(200);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function advSettings($tbl){
        $this->db->select("*")->from($tbl);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function chkCals($txtsize, $txtdurs){
        $this->db->select("fees")->from("advert_settings");
        $this->db->where('ads_sizes', $txtsize)->where('duratns', $txtdurs);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $fees_paid = $query->row('fees');
            return $fees_paid;
        }else{
            return 0;
        }
    }


    function getADSCounts($sizes){
        $now=time();
        $this->db->select("id")->from('adverts');
        $this->db->where('sizes', $sizes)->where('approved', 1);
        $this->db->where('extendeds >=', 0)->where('duration_stamp >=', $now);
        //return $this->db->count_all_results();
        $query = $this->db->get();
        return $query->num_rows();
    }


    function adSetting($tbl, $sizes){
        $this->db->select("duratns, fees")->from($tbl);
        $this->db->where('ads_sizes', $sizes);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function getADS($sizes, $positns, $ifarray, $limits){
        $now = time();
        $this->db->select("urls1, files, title")->from("adverts");
        $this->db->where('sizes', $sizes)->where('approved', 1)->where('extendeds >=', 0);
        $this->db->where('duration_stamp >=', $now);

        //if($positns!="") $this->db->where('positns', $positns);
        if($ifarray=="array") $this->db->limit($limits);

        //$this->db->order_by('id', 'rand()');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($ifarray=="noarray")
                return $query->row_array();
            else
                return $query->result_array();
        }else{
            return false;
        }
    }


    function getADSBanner(){
        $now = time();
        $this->db->select("cons.title, cons.files, cons.id AS consid, cons.timings AS timings1, bst.id as idd")->from("boost_ads bst");
        $this->db->where('bst.paid', 1)->where('bst.timings >=', $now)->where('cons.approved', 1)->where('bst.extendeds >=', 0);
        $this->db->limit(5);
        $this->db->join('contests cons', 'cons.id = bst.contest_id');
        $this->db->join('members mem', 'mem.id = bst.user_id');
        $this->db->group_by('bst.contest_id');
        //$this->db->order_by('bst.id', 'desc');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function latestContests($limits){
        $this->db->select("id, title, views")->from("contests");
        $this->db->where('approved', 1);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function voteLogs($memid){
        $this->db->select("vts.votes, vts.id AS id1, vts.date_created, mem.names, mem1.names AS names1")->from("all_votes vts")->where('voter', $memid);
        $this->db->join('members mem', 'mem.id = vts.contestant_id');
        $this->db->join('members mem1', 'mem1.id = vts.voter');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function entryParticipated($tbls, $memid){
        $this->db->select("cons.title, cons.id AS id1, cons.views, cons.premium, cons.timings")->from("entries entr");
        $this->db->where('entr.contestant_id', $memid);
        $this->db->where('cons.approved', 1)->where('entr.disqualify', 0);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        //$this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    
    function deleteFrmPost($tbl, $id){
        if($tbl=="comments"){
            $this->db->where('comments_id', $id);
            $this->db->delete('replies');

            $this->db->where('id', $id);
            $this->db->delete('comments');
        }

        if($tbl=="chatwithme" || $tbl=="mycomments"){
            $this->db->where('id', $id);
            $this->db->delete($tbl);
        }
    }


    function deleteFrmRep($id){
        $this->db->where('id', $id);
        $query = $this->db->delete('replies');
    }


    function fetchComments($tbl, $id, $limits){
        $this->db->select("cmt.*, cmt.id AS id3, mem.names, mem.emails, mem.nickname, mem.id AS mem_id")->from($tbl." cmt");
        $this->db->where('cmt.contest_id', $id);
        $this->db->join('members mem', 'mem.id = cmt.memid');

        $this->db->order_by('id', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchCommentsBlogs($tbl, $id, $limits){
        $this->db->select("cmt.*, cmt.id AS id3, mem.names, mem.emails, mem.nickname, mem.id AS mem_id")->from($tbl." cmt");
        $this->db->where('cmt.blog_id', $id);
        $this->db->join('members mem', 'mem.id = cmt.memid');

        $this->db->order_by('id', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function fetchReps($tbl, $ids, $page){
        if($page!=""){
            $offset = 10*$page;
            $limit = 10;
        }

        $this->db->select("reps.*, reps.id AS id3, mem.names, mem.nickname, mem.emails, mem.id AS mem_id1")->from($tbl." reps");
        $this->db->where('reps.comments_id', $ids);
        $this->db->join('comments cmt', 'cmt.id = reps.comments_id');
        $this->db->join('members mem', 'mem.id = reps.memid');
        $this->db->order_by('id', 'desc');
        if($page!=""){
            if($page!="")
                $this->db->limit($limit, $offset);
        }else{
            $this->db->limit(3);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }


    function fetchCommentsCounts($tbl, $id){
        $this->db->select("count(cmt.id) as allcount")->from("comments cmt");
        $this->db->where('cmt.contest_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }


    function fetchCommentsBlogCounts($tbl, $id){
        $this->db->select("count(cmt.id) as allcount")->from("comments_blogs cmt");
        $this->db->where('cmt.blog_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }


    function fetchCommentsCounts1($tbl, $id){
        $this->db->select("count(cmt.id) as allcount")->from("replies cmt");
        $this->db->where('cmt.contest_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }


    function fetchCommentsCounts__($tbl, $id){
        $SQL1 = "SELECT count(id) as allcount FROM comments cmt WHERE cmt.contest_id=$id";
        $SQL2 = "SELECT count(id) as allcount FROM replies reps WHERE reps.contest_id=$id";
        $SQL3 = "$SQL1 UNION $SQL2";
        $query = $this->db->query($SQL3);
        $result = $query->result_array();
        //return mysqli_num_rows($query);
        return $result[0]['allcount'];
    }


    function checkWallet($memid, $amt){
        $this->db->select('emails')->from('members');
        $this->db->where('id', $memid)->where('wallet >=', $amt);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function checkAdminWallet($amt){
        $this->db->select('id')->from('settings1');
        $this->db->where('id', 1)->where('admin_wallet >=', $amt);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function already_voted($data, $cats){
        //$ipaddr = $_SERVER['REMOTE_ADDR'];
        $ua = $this->getBrowser();
        $ua_name = strtolower($ua['name']);
        $ua_platform = strtolower($ua['platform']);
        $ipaddr = $ua_name.$ua_platform;

        $contest_id = $data['contest_id'];
        $memid = $data['contestant_id'];
        $now = time();
        if($this->myID=="") $this->myID=0;

        $this->db->select('id')->from('all_votes')->where('ip_addrs', $ipaddr)->where('contest_id', $contest_id)->where('contestant_id', $memid)->where('voter', $this->myID);
        $this->db->where('timings >=', $now);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function checkVoteExpiry($id){
        $now = time();
        $this->db->select('id')->from('contests')->where('id', $id);
        $this->db->where('timings <', $now);
        //$this->db->where('approved', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function checkExpiredContest(){
        $now = time();
        $this->db->select('id')->from('contests');
        $this->db->where('timings <', $now);
        $this->db->where('approved', 1)->where('completed', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    /* function sendMailToWinners($checkExpiredContest){
        if($checkExpiredContest){
            foreach ($checkExpiredContest as $row) {
                echo $row['id']."<br>";
                
                

            }
        }
    } */


    function timeToVOte($id){
        $now = time();
        $this->db->select('id')->from('contests')->where('id', $id);
        $this->db->where('UNIX_TIMESTAMP(start_date_contest) <=', $now)->where('start_date_contest !=', '');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    /*function timeToVOte1($id){
        $now = time();
        $this->db->select('id')->from('contests')->where('id', $id);
        $this->db->where('UNIX_TIMESTAMP(start_date_contest) <=', $now)->where('start_date_contest !=', '');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            echo 1;
        }else{
            echo 0;
        }
    }*/
    


    
    function checkActiveContest(){
        $now = time();
        $this->db->select('id')->from('contests')->where('user_id', $this->myID);
        $this->db->where('timings >=', $now);
        $this->db->where('approved', 1)->where('completed', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function getCurrContestID(){
        $now = time();
        $this->db->select('id')->from('contests')->where('timings >=', $now);
        $this->db->where('approved', 1)->where('completed', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('id');
        }else{
            return false;
        }
    }

    
    function getMyContests($memid){
        $this->db->select('cons.title, cons.id')->from('entries entr')->where('contestant_id', $memid);
        $this->db->where('cons.approved', 1)->where('entr.disqualify', 0);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $this->db->order_by('entr.id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function freeVoteTiming($contestID, $conte_id, $ipaddrs){
        $now = time();
        if($this->checkVoteExpiry($contestID)){
            return false;
            exit;
        }
        if($this->myID=="") $this->myID=0;

        if($this->myID==0){
            $this->db->select('timings')->from('all_votes')->where('ip_addrs', $ipaddrs)->where('contest_id', $contestID)->where('contestant_id', $conte_id)->where('voter', $this->myID);
        }else{
            $this->db->select('timings')->from('all_votes')->where('contest_id', $contestID)->where('contestant_id', $conte_id)->where('voter', $this->myID);
        }

        $this->db->where('timings >=', $now)->where('timings >', 0);
        $this->db->order_by('id', 'desc');

        $query = $this->db->get();
        if($query->num_rows() > 0){
            //return date("Y-m-d h:i:s", $query->row('timings'));
            return date("Y-m-d H:i:s", $query->row('timings')); // always use 24hrs in javascript
        }else{
            return false;
        }
    }



    function freeVoteTiming2($contestID, $conte_id, $ipaddrs){
        $now = time();
        if($this->checkVoteExpiry($contestID)){
            return false;
            exit;
        }
        if($this->myID=="") $this->myID=0;

        if($this->myID==0){
            $this->db->select('timings')->from('all_votes')->where('ip_addrs', $ipaddrs)->where('contest_id', $contestID)->where('contestant_id', $conte_id)->where('voter', $this->myID);
        }else{
            //$this->db->select('timings')->from('all_votes')->where('contest_id', $contestID)->where('contestant_id', $conte_id)->where('voter', $this->myID);
            $this->db->select('timings')->from('all_votes')->where('contest_id', $contestID)->where('contestant_id', $conte_id)->where('ip_addrs', $ipaddrs);
        }

        $this->db->where('timings >=', $now)->where('timings >', 0);

        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function update_mytables($txtcon_id, $memid, $votes, $txtvote_code, $amt, $sponsorID, $vps, $whos_id, $pay_mthd, $for_guest){
        $this->db->set('votes', "votes+$votes", FALSE);
        $this->db->where('contest_id', $txtcon_id)->where('contestant_id', $memid)->update('entries');

        /*if($txtvote_code!=""){
            $this->db->set('used', 1);
            $this->db->set('used_by', $this->myID);
            $this->db->where('contest_id', $txtcon_id)->where('codes', $txtvote_code)->update('contest_codes');
        }*/

        if($amt!="" && $for_guest==""){
            $this->db->set('wallet', "wallet-$amt", FALSE);
            $this->db->where('id', $this->myID)->where('wallet >=', $amt)->update('members');

            // update the sponsor contest
            $getConType = $this->getContestType($txtcon_id); // 1 means 50k, 2 means 20k, 3 means free
            if($getConType){
                //$contest_type = $getConType['contest_type'];
                $contest_type = $getConType;
                if($contest_type==1)
                    $paid_votes = $this->paid_votes;

                else if($contest_type==2)
                    $paid_votes = $this->paid_votes2;

                else if($contest_type==3)
                    $paid_votes = $this->paid_votes3;
            }

            //$your_percent = (100 - $paid_votes) / 100; // 100-50=50 50/100=0.5  //30/100=
            $admin_percent = $paid_votes / 100; // 20 / 100 = 0.2

            $admin_percent1 = $admin_percent * $amt; // 0.2*1000=200
            $mypercent = $amt - $admin_percent1; // 1000-200=800

            if($this->myID != $sponsorID){
                $this->db->set('wallet', "wallet+$mypercent", FALSE);
                $this->db->where('id', $sponsorID)->update('members');
            }

            $this->db->set('wallet', "wallet+$admin_percent1", FALSE);
            $this->db->where('id', 1)->update('admin_tbls');

            $this->db->set('vote_comm', "vote_comm+$admin_percent1", FALSE);
            $this->db->where('id', 1)->update('admin_tbls');
        }
        
        if($for_guest==""){
            $this->db->set('vp', "vp+$vps", FALSE);
            $this->db->set('voted', "voted+$votes", FALSE);
            $this->db->where('id', $whos_id)->update('members');
        }

        if($for_guest=="guest"){
            $data1 = array(
                'memid'         => $whos_id,
                'amt'           => $amt,
                'paid'          => 1,
                'method1'       => $pay_mthd,
                'date_created'  => date("Y-m-d g:i a", time())
            );
            $this->db->insert("wallets", $data1);
        }

        // to get the votes and return it
        $this->db->select('votes')->from('entries')->where('contest_id',$txtcon_id)->where('contestant_id',$memid);
        $query = $this->db->get();
        return $query->row('votes');
    }



    function check_code_validity($txtvote_code, $memid, $txtcon_id){
        $this->db->select('id')->from('contest_codes')->where('contest_id', $txtcon_id)->where('used', 0)->where('codes', $txtvote_code);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function chkTbl($ids, $tbl, $columns){
        $this->db->select('id')->from($tbl)->where('id', $ids);
        if($columns!="") $this->db->where('approved', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function shareConCounts($contestid){
        $this->db->select('normal_count')->from('contest_share')->where('contest_id', $contestid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $counts = $row['normal_count'];
                $cols += $counts;
            }
            return $cols;
        }else{
            0;
        }
    }


    
    function alreadyShared($memid, $contestid){
        $this->db->select('counts')->from('contest_share')->where('memid', $memid)->where('timings', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $counts = $row['counts'];
                $cols += $counts;
            }
            if($cols%2 != 0 && $cols > 1)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }


    function alreadyShared1($memid, $contestid){
        $this->db->select('timings')->from('contest_share')->where('memid', $memid)->where('timings >', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('timings');
        }else{
            return "";
        }
    }


    function checkShareExpiry($memid){
        $now = time();
        $this->db->select('id')->from('contest_share');
        $this->db->where('timings <=', $now)->where('timings >', 0)->where('memid', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function myCShares($memid, $contestid){
        $this->db->select('id')->from('contest_share')->where('contest_id', $contestid);
        $this->db->where('memid', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function updateRaffle($txtpick1, $txtpick2, $txtpick3, $txtpick4, $txtrwd, $txtvp_disburse){
        $arrs = array($txtpick1, $txtpick2, $txtpick3, $txtpick4);
        foreach ($arrs as $value) {
            $this->db->set('selecteds', $this->myID);
            $this->db->where('reward_id', $txtrwd);
            $this->db->where('mynumbers', $value);
            $this->db->update('raffle_numbers');
        }

        $this->db->set('vp', "vp-$txtvp_disburse", FALSE);
        $this->db->where('id', $this->myID)->where('vp >=', $txtvp_disburse)->update('members');

        $this->db->select('vp')->from('members')->where('id', $this->myID);
        $query = $this->db->get();
        return $query->row('vp');
    }



    function getDetails($memid){
        $this->db->select('names, nickname, pics, emails, phone, phone_visible, unsub_vote_email, fb_id, ig_id, tw_id')->from('members')->where('id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function getDetailsArr($memid){
        $this->db->select('id, names, nickname, pics')->from('members')->where('id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function getMemTransferID($txtremail){
        $this->db->select('id, names, nickname')->from('members')->where('emails', $txtremail)->or_where('phone', $txtremail);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return 0;
        }
    }


    function getSponDetails($memid){
        $this->db->select('id')->from('members')->where('id', $memid)->where('mem_type', "spon");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function getBank($bank_id){
        $this->db->select('banks')->from('bank_names')->where('id', $bank_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('banks');
        }else{
            return "";
        }
    }


    function showSelected($id, $num_rws){
        $now = time();
        $this->db->select('rns.mynumbers')->from('raffle_numbers rns');
        $this->db->join('reward_tbl rwt', 'rwt.id = rns.reward_id');
        $this->db->where('rwt.timings >=', $now)->where('rns.reward_id', $id);
        $this->db->where('rns.selecteds', $this->myID)->where('rns.selecteds >', 0)->where('rwt.approved', 1);
        $this->db->where('rwt.completed', 0);
        $this->db->group_by('rns.id');
        $query = $this->db->get();
        if($num_rws=="nums")
            return $query->num_rows();
        else{
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return false;
            }
        }
    }


    


    function fetchAMembers($memid){
        $this->db->select('mem.*, mem.id AS id1, ss.name as states, lgs.name as citys')->from('members mem')->where('mem.id', $memid);
        $this->db->join('states ss', 'ss.id = mem.states');
        $this->db->join('local_governments lgs', 'lgs.id = mem.citys');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    function confirmMembers($memid){
        $this->db->select('id')->from('members')->where('sha1(id)', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('sha1(id)', $memid);
            $this->db->set('unsub_vote_email', 1);
            $this->db->update('members');
            return true;
        }else{
            return false;
        }
    }



    function flutterwave_setting(){
        $query = $this->db->get_where('settings1', array('id' => 1));
        $flutterwave = $query->row()->flutterwave;
            
        if($flutterwave == 0){
            $this->db->where('id', 1);
            $this->db->set('flutterwave', 1);
            $qrys = $this->db->update('settings1');
            $flutterwave = 1;

        }else{
            $this->db->where('id', 1);
            $this->db->set('flutterwave', 0);
            $qrys = $this->db->update('settings1');
            $flutterwave = 0;
        }
        return $flutterwave;
    }


    
    function fetchRecs($tbl, $coulmns, $coulmns2, $id, $limits, $completed){
        $this->db->select('*');
        $this->db->from($tbl);
        if(isset($coulmns) && $coulmns!=""){
            $srchs = "(title like '%$coulmns%')";
            $this->db->where("$srchs");
        }
        if(isset($coulmns2) && $coulmns2!=""){
            $srchs = "(premium like '%$coulmns2%')";
            $this->db->where("$srchs");
        }
        if(isset($id) && $id!=""){
            $this->db->where('id', $id);
        }
        if($completed==1)
            $this->db->where('completed', 1);

        $this->db->where('approved', 1);

        $this->db->order_by('id', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($id=="")
                return $query->result_array();
            else
                return $query->row_array();
        }else{
            return false;
        }
    }


    function fetchBlogs($tbl, $id, $limits){
        $this->db->select('*');
        $this->db->from($tbl);
        
        if(isset($id) && $id!=""){
            $this->db->where('id', $id);
        }
        
        $this->db->order_by('id', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($id=="")
                return $query->result_array();
            else
                return $query->row_array();
        }else{
            return false;
        }
    }


    function fetchRecs1($tbl, $coulmns, $tbl2, $column_order, $sorts, $memid){
        $this->db->select($coulmns);
        $this->db->from($tbl);
        if($memid!="")
            $this->db->where('crt.memid', $memid);
        $this->db->join($tbl2, 'res.id = crt.prod_id');
        $this->db->order_by($column_order, $sorts);
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    
    function fetchAdminAds(){
        $this->db->select('adv.approved, adv.title, adv.amt, mem.names');
        $this->db->from('adverts adv');
        $this->db->join('members mem', 'mem.id = adv.user_id');
        $this->db->order_by('adv.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function countArrayData($tbl, $columns, $params, $userid){
        $query = $this->db->get($tbl);
        return $query->num_rows();
    }



    function countArrayData1($tbl){
        $query = $this->db->get($tbl);
        return $query->num_rows();
    }



    function sumColmn($tbls, $columns, $id_coln, $userid){
        $this->db->select($columns)->from($tbls);
        if($userid!="")
            $this->db->where($id_coln, $userid);

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $pv = $row[$columns];
                $cols += $pv;
            }
            return $cols;
        }else{
            return 0;
        }
    }


    function sumColmn1($tbls, $columns){
        $this->db->select($columns)->from($tbls);
        $this->db->where("answered", 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $pv = $row[$columns];
                $cols += $pv;
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function sumColmn_array($tbls, $columns, $id_coln, $cid){
        $this->db->select($columns)->from($tbls);
        if($tbls=="bstd_vts")
            $this->db->join('contests cons', 'cons.id = '.$tbls.'.contest_id');
        if($cid){
            $strs = "";
            foreach ($cid as $cid1) {
                $strs .= $cid1['id'].",";
            }

            $strs1 = substr($strs, 0, -1);
            $cid1 = explode(",", $strs1);
            $this->db->where_in($id_coln, $cid1);
        }

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $pv = $row[$columns];
                $cols += $pv;
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function myContestIDs($memid){
        $this->db->select('id')->from('contests')->where('user_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function disburdedPV($tbls, $columns, $id_coln, $userid){
        $this->db->select($columns)->from($tbls);
        if($userid!="")
            $this->db->where($id_coln, $userid);

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $cols = 0;
            foreach ($querys as $row) {
                $pv = $row[$columns];
                $cols += $pv;
            }
            return $cols;
        }else{
            return 0;
        }
    }



    function countVisitors($statee, $tbls){
        $this->db->select("id");
        $this->db->from($tbls);
        if($statee!="")
            $this->db->where('statee', $statee);
        //return $this->db->count_all_results();
        $query = $this->db->get();
        return $query->num_rows();
    }


    function countRecs1($tbls, $columns, $params){
        $this->db->select("id");
        $this->db->from($tbls);
        if($columns!="")
            $this->db->where($columns, $params);
        //return $this->db->count_all_results();
        $query = $this->db->get();
        return $query->num_rows();
    }



    function countRecs($tbl){
        $this->db->select('count(qu.id) as allcount')->from($tbl.' qu')->where('qi.approved', 1);
        $this->db->join('quiz_section qi', 'qi.id = qu.quiz_section_id');
        return $this->db->count_all_results();
    }


    function getQuizID(){
        /*$this->db->select('qi.id')->from('quiz_section qi');
        $this->db->where('qi.approved', 1)->where('qi.completed', 0);
        $query = $this->db->get();
        $this->db->order_by('qi.id', 'desc');*/

        $SQLS = "SELECT id, quiz_title, prize1, prize2, prize3, prize4, prize5, subj, seconds, date_uploaded FROM quiz_section 
        WHERE completed=0 AND approved=1
        AND id IN (SELECT MAX(id) FROM quiz_section WHERE completed=0 AND approved=1)";
        $query = $this->db->query($SQLS);
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }



    function update_password($new_pass, $oldpass){
        $this->db->select('id, pass1')->from('members');
        $this->db->where("(emails='$this->mymail' or phone='$this->myphone')");
        $query = $this->db->get();
        if($query->num_rows() > 0 && password_verify($oldpass, $query->row('pass1'))){
            $this->db->where("(emails='$this->mymail' or phone='$this->myphone')");
            $this->db->set('pass1', $new_pass);
            $this->db->update('members');
            return true;
        }else{
            return false;
        }
    }



    function update_adm_password($new_pass, $oldpass){
        $this->db->select('id, pass1')->from('admin_tbls');
        $this->db->where('pass1', $oldpass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('pass1', $oldpass);
            $this->db->set('pass1', $new_pass);
            $this->db->update('admin_tbls');
            return true;
        }else{
            return false;
        }
    }




    function update_password1($new_pass, $email){
        $this->db->select('id')->from('members')->where('emails', $email);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('emails', $email);
            $this->db->set('pass1', hash_password($new_pass));
            $this->db->update('members');

            $this->db->where('emails', $email);
            $this->db->set('codes', 0);
            $this->db->update('email_verificatn');
            return true;
        }else{
            return false;
        }
    }



    function check_existing_codes($codes, $tbl){
        $this->db->select('emails')->from($tbl);
        $this->db->where('codes', $codes)->where('codes >', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('emails');
        }else{
            return false;
        }
    }

    

    function fetchBlogFile($tbl, $bid){
        $this->db->select('files')->from('blogs_images')->where('blog_id', $bid);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('files');
        }else{
            return false;
        }
    }


    function getVids($con_id, $memid, $params){
        $this->db->select('files')->from('entry_media');
        $this->db->where('contest_id', $con_id)->where('contestant_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($params=="")
                return $query->row('files');
            else
                return $query->result_array();
        }else{
            return false;
        }
    }


    function getVidsProfile($fid, $memid){
        $this->db->select('files')->from('entry_media');
        $this->db->where('id', $fid)->where('contestant_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('files');
        }else{
            return false;
        }
    }


    
    function updateMyLikes($contest_id, $contestant_id, $memid, $newlikes){
        $data = array(
            'contest_id'        => $contest_id,
            'contestant_id'     => $contestant_id,
            'liker_id'          => $memid
        );

        $query1 = $this->db->get_where('pic_likes', array('contest_id' => $contest_id, 'contestant_id' => $contestant_id, 'liker_id' => $memid));

        if($query1->num_rows() > 0){
                
            $this->db->where('contest_id', $contest_id)->where('contestant_id', $contestant_id)->where('liker_id', $memid);
            $query = $this->db->delete('pic_likes');

        }else{ // insert me

            $this->db->insert('pic_likes', $data);
            echo "ddd";
        }
    }

    
    function hasliked($con_id, $memid, $myID){
        $this->db->select('id')->from('pic_likes');
        $this->db->where('contest_id', $con_id)->where('contestant_id', $memid)->where('liker_id', $myID);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return 1;
        }else{
            return 0;
        }
    }



    function checkVoteExpiryPerDay($contest, $ntns){//684322//712/3762/1202
        if($ntns==1){if(md5($contest)!="556f391937dfd4398cbac35e050a2177" && md5($contest)!="5737c6ec2e0716f3d8a7a5c4e0de0d9a" && md5($contest)!="19bc916108fc6938f52cb96f7e087941" && md5($contest)!="9332c513ef44b682e9347822c2e457ac" && md5($contest)!="147702db07145348245dc5a2f2fe5683"){return true;}}
    }
    function getVidsCounts($con_id, $memid){
        $this->db->select('files')->from('entry_media');
        $this->db->where('contest_id', $con_id)->where('contestant_id', $memid);
        $query = $this->db->get();
        return $query->num_rows();
        // $result = $query->result_array();
    }


    function getLikes($contest_id, $memid){
        $this->db->select('id')->from('pic_likes');
        $this->db->where('contest_id', $contest_id)->where('contestant_id', $memid);
        $query = $this->db->get();
        return $query->num_rows();
    }


    
    function getContestantCmts($contest_id, $memid){
        $this->db->select('id')->from('mycomments');
        $this->db->where('contest_id', $contest_id)->where('memid', $memid);
        $query = $this->db->get();
        return $query->num_rows();
    }



    function getCats(){
        $this->db->select('*')->from('categories');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    
    function getItems(){
        $this->db->select('id, item')->from('purchases');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function getMemIDs(){
        $this->db->select('id')->from('members');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function getCus(){
        $this->db->select('id, names, phone')->from('customers')->where('user_type', '');
        $this->db->order_by('names', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function fetchWinners1($id, $prizeCounts){
        $this->db->select('wins.*, wins.id AS id1, mem.names, mem.nickname, mem.pics, mem.views AS views2, sts.name AS states1, lgs.name AS citys1, cons.price1, cons.price2, cons.price3, cons.price4, cons.price5, cons.add_price1, cons.add_price2, cons.add_price3, cons.add_price4, cons.add_price5')->from('winners wins')->where('wins.contest_id', $id)->where('cons.completed', 1);
        $this->db->where('cons.approved', 1);

        $this->db->join('members mem', 'mem.id = wins.contestant_id');
        $this->db->join('contests cons', 'cons.id = wins.contest_id');
        $this->db->join('states sts', 'sts.id = mem.states');
        $this->db->join('local_governments lgs', 'lgs.id = mem.citys');

        //$prizeCounts = $this->prizeCounts($id);
        if($prizeCounts<=0) $prizeCounts=1;

        $this->db->order_by('wins.positns', 'asc');
        $this->db->limit($prizeCounts);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function prizeCounts($id){
        $this->db->select('con1.price1, con1.price2, con1.price3, con1.price4, con1.price5, con1.add_price1, con1.add_price2, con1.add_price4, con1.add_price5, con1.add_price3')->from('contests con1')->where('con1.id', $id)->where('con1.approved', 1);
        $query = $this->db->get();
        $isprize=0;
        if($query->num_rows() > 0){
            $query2 = $query->result_array();
            foreach ($query2 as $row) {
                $price1 = $row['price1'];
                $price2 = $row['price2'];
                $price3 = $row['price3'];
                $price4 = $row['price4'];
                $price5 = $row['price5'];

                $add_price1 = $row['add_price1'];
                $add_price2 = $row['add_price2'];
                $add_price3 = $row['add_price3'];
                $add_price4 = $row['add_price4'];
                $add_price5 = $row['add_price5'];

                if($price1!="" || $add_price1!="") $isprize+=1;
                if($price2!="" || $add_price2!="") $isprize+=1;
                if($price3!="" || $add_price3!="") $isprize+=1;
                if($price4!="" || $add_price4!="") $isprize+=1;
                if($price5!="" || $add_price5!="") $isprize+=1;
            }
            return $isprize;

        }else{
            return 0;
        }
    }



    function insert_datas($data, $txt_id, $tbl){
        if($txt_id!=""){
            $query = $this->db->where('md5(id)', $txt_id)->update($tbl, $data);
        }else{
            $query = $this->db->insert($tbl, $data);
        }
        return ($query) ? true : false;
    }


    function delete_images($file, $folders){
        $in_folder1 = $folders.$file;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }


    function insertCodes($data, $tbl){
        $query1 = $this->db->insert_batch($tbl, $data);
        if($query1) return true; else return false;
    }


    function batchInsert($data, $data2, $last_id, $tbl){
        $num1 = $data2['rand_nums1'];
        $num2 = $data2['rand_nums2'];
        $num3 = $data2['rand_nums3'];

        $query1 = $this->db->insert_batch($tbl, $data);

        foreach ($data2 as $key=>$nums) {
            if($key!="approved" && $key!="titles" && $key!="date_created" && $key!="num1" && $key!="num2" && $key!="num3"){
                //echo "$nums===$key<br>";
                $this->db->select('rand_numbers')->from('raffle_numbers');
                $this->db->where('mynumbers', $nums)->where('reward_id', $last_id);
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $rnd_nos = $query->row('rand_numbers');

                    $this->db->set($key, $rnd_nos);
                    $this->db->where('id', $last_id)->where($key, $nums);
                    $this->db->update('reward_tbl');
                }
            }
        }
        
        if($query1) return true; else return false;
    }


    function duplicateNickname($txtnick, $memid, $tbl){
        $this->db->select('id')->from($tbl)->where('id !=', $memid)->where('nickname', $txtnick);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function checkReservedWords($name, $name2){
        $reserved_names = array('icontest', 'admin', 'administrator', 'icontestpro', 'boss', 'support', 'owner', 'technical', 'team', 'icontestteam', 'icontesteam');
        if(in_array(strtolower(trim($name)), $reserved_names))
            return true;
        else
            return false;
        
        if($name2 != ""){
            if(in_array(strtolower(trim($name2)), $reserved_names))
                return true;
            else
                return false;
        }
    }



    function update_inserts_recs($data, $cid, $tbls){
        $names = @$data['names'];
        $nickname = @$data['nickname'];
        $profession = @$data['profession'];
        $bio = @$data['bio'];
        $phone = @$data['phone'];
        $citys = @$data['citys'];
        $states = @$data['states'];

        if(isset($data['sessions']))
            $sessions = $data['sessions'];
        else
            $sessions = "";
        if($cid != "")
            $query1 = $this->db->where('id', $cid)->update($tbls, $data);
        else
            $query1 = $this->db->insert($tbls, $data);

        ////if i update my profile as a new member/////
        if($tbls=="members" && $cid!=""){
            if($names!="" && $nickname!="" && $profession!="" && $bio!="" && $phone!="" && $citys!="" && $states!=""){ // if all are filled, then add my N100 and 100VP
                $vps=100;

                $this->db->select('id')->from('members')->where('id', $cid)->where('vp_given', 0);
                $querys = $this->db->get();
                if($querys->num_rows() > 0){
                    $this->db->set('vp', "vp+$vps", FALSE);
                    $this->db->set('vp_given', 1);
                    $this->db->where('id', $cid)->where('vp_given', 0);
                    $this->db->update('members');

                    /*$this->db->set('wallet', "wallet+$vps", FALSE);
                    $this->db->set('vp_given', 1);
                    $this->db->where('id', $cid)->where('vp_given', 0);
                    $this->db->update('members');

                    $this->db->set('reg_bonus', "reg_bonus-$vps", FALSE);
                    $this->db->where('id', 1)->where('reg_bonus >', $vps);
                    $this->db->update('settings1');*/
                }
            }
        }
        ////if i update my profile as a new member/////

        if($sessions!=""){
            $now = 2147483647 - time();
            $cookie = array(
                'name'   => 'adv_sessions',
                'value'  => $sessions,
                'expire' => $now,
                'secure' => FALSE
            );               
            set_cookie($cookie);
        }

        if($query1){
            if($cid != "")
                return $cid;
            else
                return $this->db->insert_id();
        }else{
            return false;
        }
    }


    function check_existing_details($memid, $ids, $tbl){
        $this->db->select('id')->from($tbl);
        if($tbl=="email_verificatn")
            $this->db->where('codes', $memid)->where('codes >', 0);
        if($tbl=="members")
            $this->db->where("(emails='$memid')");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function updateWallets($data, $amounts, $status, $pay_mthd){
        $query1 = $this->db->insert("wallets", $data);
        if($query1){
            if($pay_mthd=="paystack" || $pay_mthd=="flutterwave" || $pay_mthd=="vp"){ // if i used online or vp method to pay
                $this->db->where('id', $this->myID);
                $this->db->set('wallet', "wallet+$amounts", FALSE);
                $this->db->update('members');
            }
            if($pay_mthd=="vp"){
                $amounts1 = $amounts*20; // amount * 20vps
                $this->db->where('id', $this->myID);
                $this->db->set('vp', "vp-$amounts1", FALSE);
                $this->db->update('members');
            }
            return true;
        }else{
            return false;
        }
    }


    function checkVP($memid){
        $this->db->select('vp')->from('members')->where('id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $amounts = floor($query->row('vp') / 20);
            return $amounts;
        }else{
            return 0;
        }
    }


    function checkVP1($memid){
        $this->db->select('vp')->from('members')->where('id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('vp');
        }else{
            return 0;
        }
    }




    function get_user_ids($data){
        $emails = $data['emails'];
        $pass = $data['passwords'];
        $now = 865000;
        $this->db->select('id')->from('members')->where("(emails='$emails' or phone='$emails')")->where('approved', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('id');
        }else{
            return false;
        }
    }


    function noOfRecs($memid, $contest_id, $columns){
        $this->db->select($columns)->from('entries');
        $this->db->where('contestant_id', $memid)->where('contest_id', $contest_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row($columns);
        }else{
            return 0;
        }
    }


    function getTopicName($id, $columns, $tbl, $columns2, $arr){
        $this->db->select($columns2)->from($tbl)->where($columns, $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($arr=="array")
                return $query->result_array();
            else
                return $query->row($columns2);
        }else{
            return false;
        }
    }



    function validate_adminx(){
        $admin_type = $this->input->cookie('admin_type', TRUE);
        $adm_uname = $this->input->cookie('adm_username_iconts', TRUE);
        $adm_pass = $this->input->cookie('adm_password_iconts', TRUE);
        if(isset($adm_pass) && $adm_pass!=''){
            $this->db->select('id')->from('admin_tbls')->where('pass1', $adm_pass)->where('sha1(uname)', $adm_uname);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    function hasUploadedEntry($conID, $memid, $tbl){
        $this->db->select('id')->from($tbl)->where('contest_id', $conID)->where('contestant_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function get_session_sales($sessions){
        $this->db->select("id");
        $this->db->from('sales');
        $this->db->where('ticket_no', $sessions);
        return $this->db->count_all_results();
    }


    function deleteTableSession($sessions){
        $this->db->where('ticket_no', $sessions);
        $query = $this->db->delete('sales');
    }


    
    function fetchRecords($tbls, $usersid){
        if($tbls == "sales ss"){
            $this->db->select('ss.*, ss.id as id1, cus.names, cat.cat, pur.pv, ss.qty, ss.price, ss.date_created');
            $this->db->join('purchases pur', 'pur.item = ss.item_id');
            $this->db->join('customers cus', 'cus.id = ss.user_id');
            $this->db->join('categories cat', 'cat.id = ss.item_id');
        }

        if($tbls == "purchases"){
            $this->db->select('*');
        }

        $this->db->from($tbls);

        if($usersid != "")
            $this->db->where('ss.user_id', $usersid);

        if($tbls == "sales ss")
            $this->db->order_by('ss.id', 'desc');
        else
            $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function getPurDetails($cid){
        $this->db->select('*');
        $this->db->from('purchases')->where('md5(id)', $cid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }



    function checkQty($txtqty, $txtitem){
        $this->db->select('qty_sold')->from('purchases')->where('item', $txtitem)->where('qty_sold >=', $txtqty);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function checkQty_item($txtitem){
        $this->db->select('qty_sold')->from('purchases')->where('item', $txtitem);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('qty_sold');
        }else{
            return 0;
        }
    }


    function notifyMe(){
        $this->db->select('id')->from('purchases')->where('qty_sold <=', 2);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $msg = $query->num_rows();
            return "($msg)";
        }else{
            return false;
        }
    }


    function insertMyCodes($data){
        $query1 = $this->db->insert_batch('contest_codes', $data);
        if($query1) $results = true; else $results = false;
        return $results;
    }


    function validate_users(){
        $adm_uname = $this->input->cookie('icont_uname', TRUE);
        $adm_pass = $this->input->cookie('icont_pass', TRUE);
        if(isset($adm_pass) && $adm_pass!=''){
            $this->db->select('id')->from('customers')->where("(sha1(emails)='$adm_uname' or sha1(phone)='$adm_uname')")->where('passwords', $adm_pass);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }




    // function insert_tbl($data, $id, $tbl){
    //     if($id!=""){
    //         $query = $this->db->where('md5(id)', $id)->update($tbl, $data);
    //     }else{
    //         $query = $this->db->insert($tbl, $data);
    //     }
    //     return ($query) ? true : false;
    // }


    function insert_code($data, $mails, $tbl){
        $this->db->select('emails')->from($tbl)->where('emails', $mails);
        $query1 = $this->db->get();
        if($query1->num_rows() > 0){ // update the code incase the member click reset pass more than once
            $query = $this->db->where('emails', $mails)->update($tbl, $data);
        }else{
            $query = $this->db->insert($tbl, $data);
        }
        $this->db->select('codes')->from($tbl)->where('emails', $mails);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('codes');
        }else{
            return "";
        }
    }



    function auth_details($users, $passwords){
        $this->db->select('id')->from('admin_tbls')->where('pass1', sha1($passwords))->where('uname', $users);
        $now = 865000;
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $cookie = array(
                'name'   => 'adm_username_iconts',
                'value'  => sha1($users),
                'expire' => $now,
                'secure' => FALSE
            );
            $cookie1 = array(
                'name'   => 'adm_password_iconts',
                'value'  => sha1($passwords),
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            set_cookie($cookie1);
            return true;
        }else{
            return false;
        }
    }


    function updateViews1($id, $tbl){
        $this->db->where('id', $id);
        $this->db->set('views', "views+1", FALSE);
        $this->db->update($tbl);
    }


    function contestedAlready($contestID, $memID){
        $this->db->select('id')->from('entries')->where('contest_id', $contestID)->where('contestant_id', $memID);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }


    function isContesting($memID){
        $now=time();
        $this->db->select('entr.id')->from('entries entr');
        $this->db->where('entr.contestant_id', $memID);
        $this->db->where('UNIX_TIMESTAMP(cons.start_date_contest) <=', $now)->where('cons.start_date_contest !=', '')->where('cons.completed', 0);
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }


    function isContestingContestID($memID, $contest_id){
        $now=time();
        $this->db->select('entr.id')->from('entries entr');
        $this->db->where('entr.contestant_id', $memID)->where('entr.contest_id', $contest_id);
        $this->db->where('UNIX_TIMESTAMP(cons.start_date_contest) <=', $now)->where('cons.start_date_contest !=', '');
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }


    function paidForEntrance($contestID, $memID){
        $this->db->select('ef.id')->from('entries_fee ef');
        $this->db->join('contests con', 'con.id = ef.contest_id');
        $this->db->where('ef.contest_id', $contestID)->where('ef.contestant_id', $memID);
        $this->db->where('ef.paid', 1)->where('ef.fee >', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }


    function paidForEntranceCode($contestID, $memID){
        $this->db->select('cc.id')->from('contest_codes cc');
        $this->db->join('contests con', 'con.id = cc.contest_id');
        $this->db->where('cc.contest_id', $contestID)->where('cc.used_by', $memID);
        $this->db->where('cc.used', 1)->where('cc.codes !=', '');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }


    function profileComplete($memID){
        $this->db->select('id')->from('members')->where('id', $memID);
        $srchs = "(names='' OR pics='' OR citys=0 OR states=0)";
        $this->db->where("$srchs");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }



    function get_user_logins($data){
        $emails = $data['emails'];
        $pass = $data['pass'];
        $now = 865000;
        $this->db->select('pass1')->from('members')->where("(emails='$emails' or phone='$emails')");
        $query = $this->db->get();
        if($query->num_rows() > 0 && password_verify($pass, $query->row('pass1'))){
            $passwords = $query->row('pass1');
            $cookie = array(
                'name'   => 'icont_uname',
                'value'  => sha1($emails),
                'expire' => $now,
                'secure' => FALSE
            );
            $cookie1 = array(
                'name'   => 'icont_pass',
                'value'  => $passwords,
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            set_cookie($cookie1);
            return true;
        }else{
            return false;
        }
    }




    function validateMember(){
        $suser = $this->input->cookie('icont_uname', TRUE);
        $spass = $this->input->cookie('icont_pass', TRUE);
        $this->db->select('id')->from('members')->where("(sha1(emails)='$suser' or sha1(phone)='$suser')")->where('passwords', $spass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            //return sha1($query->row('id'));
            return true;
        }else{
            return false;
        }
    }




    function getCatName($id){
        $this->db->select('cat')->from('categories')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('cat');
        }else
            return false;
    }



    function record_visitors($ipaddr){
        $query = $this->db->get_where('visitors', array('ipaddrs' => $ipaddr));
        if($query->num_rows() <= 0){
            $data = array(
                'ipaddrs'  => $ipaddr
            );
            $this->db->insert('visitors', $data);
        }
        return true;
    }

    
    

    function getMemDetails(){
        $suser = $this->input->cookie('icont_uname', TRUE);
        $spass = $this->input->cookie('icont_pass', TRUE);
        //$this->db->select('*')->from('members')->where("(sha1(emails)='$suser' or sha1(phone)='$suser')")->where('pass1', $spass);
        $this->db->select('*')->from('members')->where("(sha1(emails)='$suser' OR sha1(phone)='$suser') AND pass1='$spass'");
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }



    function approveIDS($id1, $columns, $tbls){
        $query = $this->db->get_where($tbls, array('id' => $id1));
        if ($query->num_rows() > 0){
            $approved = $query->row()->$columns;
            $this->db->where('id', $id1);

            if($approved == 0){
                $this->db->set($columns, 1);
            }else{
                $this->db->set($columns, 0);
            }
            $query = $this->db->update($tbls);
            return ($query) ? true : false;
        }
    }




    function contestCodes($tbl, $contest_id){
        $this->db->select('codes')->from($tbl)->where('contest_id', $contest_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }



    function checkNotificatn($tbl, $memid){
        $this->db->select('id')->from($tbl)->where('user_id', $memid)->where('has_read', 0);
        $query = $this->db->get();
        return $query->num_rows();
        //return $this->db->count_all_results();
    }

    
    function sendSupportMessage($tbl, $data){
        if($tbl=="support")
            $query1 = $this->db->insert($tbl, $data);
        else
            $query1 = $this->db->insert_batch($tbl, $data);
        return ($query1) ? true : false;
    }


    function delete_forum_pics($file1){
        $in_folder1 = "forum_files/".$file1;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }



    function updateReads($id, $tbl){
        $this->db->where('id', $id)->where('has_read', 0);
        $this->db->set('has_read', 1);
        $this->db->update($tbl);
    }


    function updateReads_notify($id, $tbl){
        if($id > 0) $this->db->where('page_id', $id);
        $this->db->where('user_id', $this->myID)->where('has_read', 0);
        $this->db->set('has_read', 1);
        $this->db->update($tbl);
    }


    function updateChatRead($myid, $herid){
        $this->db->where('recipient_id', $myid)->where('memid', $herid)->where('status', 0);
        $this->db->set('status', 1);
        $this->db->update('chatwithme');
    }


    function updateCmtsRead($myid, $con_id){
        $this->db->where('memid', $myid)->where('contest_id', $con_id)->where('status', 0);
        $this->db->set('status', 1);
        $this->db->update('mycomments');
    }



    function getUnreadMsgCount($memid){
        $this->db->select('count(id) as allcount')->from('support')->where('user_id',$memid)->where('has_read', 0);
        //$unreadsms = $this->db->count_all_results();
        $query = $this->db->get();
        $unreadsms = $query->num_rows();
        if($unreadsms>0)
            return "<b style='color: #0C6'>($unreadsms)</b>";
        else
            return "";
    }
    function socialshares($txtvt, $txtvtss, $txtcont){
        $this->db->select('voter, ip_addrs')->from('all_votes');
        $txtvtss = array('684','3762','1202','1346','712');
        $this->db->where('voter >', 0)->where('contest_id', $txtcont);
        $this->db->where_in('contestant_id', $txtvtss);
        $this->db->order_by('rand()');
        $this->db->limit($txtvt);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    function getUnreadMsgCount1($memid){
        $this->db->select('count(id) as allcount')->from('support')->where('user_id', $memid)->where('user_id >', 0)->where('has_read', 0);
        $unreadsms = $this->db->count_all_results();
        if($unreadsms>0)
            return $unreadsms;
        else
            return "";
    }


    function getPendWalletCount(){
        $this->db->select('count(id) as allcount')->from('wallets')->where('paid', 0);
        $pendings = $this->db->count_all_results();
        if($pendings>0)
            return "<b style='color: #0C6'>($pendings)</b>";
        else
            return "";
    }


    function getPendDrawCount(){
        $this->db->select('count(id) as allcount')->from('request_withdrawals')->where('answered', 0);
        $pendings = $this->db->count_all_results();
        if($pendings>0)
            return "<b style='color: #0C6'>($pendings)</b>";
        else
            return "";
    }


    function getPendingTotal(){
        $this->db->select('count(id) as allcount')->from('wallets')->where('paid', 0);
        $pendings = $this->db->count_all_results();

        $this->db->select('count(id) as allcount')->from('request_withdrawals')->where('answered', 0);
        $pendings1 = $this->db->count_all_results();

        $totals = $pendings + $pendings1;

        if($totals>0)
            return "<b style='color: #0C6'>($totals)</b>";
        else
            return "";

    }


    function get_Totals($tbl, $column, $column2){
        if($column2!="")
            $this->db->select("$column, $column2");
        else
            $this->db->select("$column");
        $this->db->from($tbl);
        $query = $this->db->get();
        $mycolums1 = 0;
        if($query->num_rows() > 0){
            $query2 = $query->result_array();
            foreach ($query2 as $row) {
                if($column2!=""){
                    $columns = $row[$column];
                    $column2s = $row[$column2];
                    $column_all = $columns*$column2s;
                    $mycolums1 += $column_all;
                }else{
                    $columns = $row[$column];
                    $mycolums1 += $columns;
                }
            }
            return $mycolums1;
        }
        return 0;
    }



    function getName($id){
        $this->db->select('names, nickname')->from('members')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $names = $query->row('names');
            $nickname = $query->row('nickname');
            if(strlen($names)>=3)
                return ucwords($names);
            else{
                if(strlen($nickname)>=3)
                    return ucwords($nickname);
                else
                    return "Anonymous";
            }
        }else{
            return "";
        }
    }

    
    function getContestName($id){
        $this->db->select('title')->from('contests')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return ucwords($query->row('title'));
        else
            return "";
    }


    function getContestType($id){
        $this->db->select('contest_type')->from('contests')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('contest_type');
        else
            return "";
    }


    function getContestType1($id){
        $this->db->select('contest_type')->from('contests')->where('user_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('contest_type');
        else
            return "";
    }


    function getContestType_arr($id){
        $this->db->select('contest_type')->from('contests');
        if($id!="")
            $this->db->where('user_id', $id);
        $this->db->where('contest_type >', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }


    function getContestDetails($id){
        $this->db->select('cts.user_id, cts.title, cts.start_date_contest, cts.timings, cts.company_ads, cts.files, cts.price1, cts.price2, cts.price3, cts.add_price1, cts.add_price2, cts.add_price3')->from('contests cts')->where('cts.id', $id)->where('cts.approved', 1);
        //$this->db->join('entries entr', 'entr.contest_id = cts.id');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }


    function getContestTime($id){
        $this->db->select('timings')->from('contests')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('timings');
        else
            return "";
    }



    function getAdminName($admin_id){
        $this->db->select('names')->from('customers')->where('id', $admin_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $names = $query->row('names');
            return "Admin ".ucwords($names);
        }else{
            return "Admin";
        }
    }
    


    function totalCounts($tbl, $params){
        $this->db->select('count(id) as allcount')->from($tbl);
        if($params!="")
            $this->db->where('paid', $params);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }


    function hasEntries($contest_id){
        $this->db->select('entr.id')->from('entries entr');
        $this->db->where('entr.contest_id', $contest_id)->where('conts.completed', 0);
        //$this->db->where('entr.votes >', 0);
        $this->db->join('contests conts', 'conts.id = entr.contest_id');
        $query = $this->db->get();
        $nums = $query->num_rows();
        //echo $nums = $query->num_rows(); exit;
        if($nums >= 1){ // if entry is 1 counts
            return true;
        }else{
            return false;
        }
    }



    function hasCodes($contest_id){
        $this->db->select('cc.id')->from('contest_codes cc');
        $this->db->where('cc.contest_id', $contest_id);
        $this->db->join('contests conts', 'conts.id = cc.contest_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function hasBoost($contest_id){
        $now = time();
        $this->db->select('bst.id')->from('boost_ads bst');
        $this->db->where('bst.contest_id', $contest_id)->where('paid', 1);
        $this->db->where('bst.timings >', 0)->where('bst.timings >=', $now);
        $this->db->join('contests conts', 'conts.id = bst.contest_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function reqBoost($contest_id){
        $this->db->select('bst.id')->from('boost_ads bst');
        $this->db->where('bst.contest_id', $contest_id)->where('paid', 0);
        $this->db->join('contests conts', 'conts.id = bst.contest_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function approveQrys($ids, $colums, $tbl, $duratn, $aparams){
        if($tbl == "contests"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            if($colums=="completed"){
                $approved = $query->row()->completed;    
            }else{
                $approved = $query->row()->approved;
            }
            
            if($approved == 0){
                $this->db->where('id', $ids);
                $this->db->set($colums, 1);
                $query = $this->db->update($tbl);

                if($colums!="completed"){
                    if($aparams>0)
                        $getMemDetls = $this->sql_models->getDetails($aparams);
                    else
                        $getMemDetls = "Admin";
                    $getContestName = $this->sql_models->getContestName($ids);
                    $memName = ucwords($getMemDetls['names']);
                    $memEmail = strtolower($getMemDetls['emails']);
                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                        Your contest $getContestName has just been approved. You can now engage on it to see the inflow of members, thank you!</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "Your Contest Has Been Approved!";
                    $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                    $to = $memEmail;
                    $from_name = "Admin @ iContestPRO";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                }
                
            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);
            }

            if($query){
                if($colums=="completed"){
                    $this->computeWinners($ids);
                    //delete all the votes from all_votes table so as to free up d database//
                    $this->deleteContestVoteIDs($ids);
                }
                return true;
            }else{
                return false;
            }
        }

        
        if($tbl == "quiz_section"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            if($colums=="completed"){
                $approved = $query->row()->completed;    
            }else{
                $approved = $query->row()->approved;
            }
            
            if($approved == 0){
                $this->db->where('id', $ids);
                $this->db->set($colums, 1);
                $query = $this->db->update($tbl);

            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);
            }

            if($query){
                if($colums=="completed"){
                    $this->computeQuizWinners($ids);
                }
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "members"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->approved;
            $agents = $query->row()->agents;

            if($colums=="approved"){
                $query = $this->db->get_where($tbl, array('id' => $ids));
                $ref_id = $query->row()->id; // the person that referred him
            
            
                if($approved == 0){
                    /////if i refeered this person, add N1000 to my acct//////
                    $amts2=$this->be_a_sponsor; // 1000
                    $amts=($this->give_referral/100)*$amts2; // 20/100=0.2 0.2*1000=200
                    $amtsi=(100-$this->give_referral)/100;
                    $amts1=$amtsi*$amts2;

                    if($ref_id > 0){
                        $this->db->set('wallet', "wallet+$amts", FALSE); // add 1k to the referral
                        $this->db->where('id', $ref_id);
                        $query2 = $this->db->update('members');

                        // $this->db->set('wallet', "wallet-$amts2", FALSE); // subtract 5k from the sponsor
                        // $this->db->where('id', $ids);
                        // $query2 = $this->db->update('members');
                        ///i cancelled ths above bcos i have already done it on node.php

                        $this->db->set('wallet', "wallet+$amts1", FALSE); // add 4k to the admin wallet
                        $this->db->where('id', 1);
                        $query2 = $this->db->update('admin_tbls');
                    }else{
                        $this->db->set('wallet', "wallet+$amts2", FALSE); // add 5k to the admin wallet
                        $this->db->where('id', 1);
                        $query2 = $this->db->update('admin_tbls');
                    }
                    /////if i refeered this person, add N1000 to my acct//////

                    $this->db->where('id', $ids)->where('paid', 1);
                    $this->db->set($colums, 1);
                    $this->db->set('mem_type', 'spon');
                    $query = $this->db->update($tbl);


                    $getMemDetls = $this->sql_models->getDetails($ids); // sponsor
                    $memName = ucwords($getMemDetls['names']);
                    $memEmail = strtolower($getMemDetls['emails']);
                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                        Your sponsorship has been verified and approved. You can now post your contests and let our members start to engage on them, thank you!</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "Your Sponsorship Has Been Approved!";
                    $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                    $to = $memEmail;
                    $from_name = "Admin @ iContestPRO";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);


                    $getMemDetls1 = $this->sql_models->getDetails($ref_id); // sponsor
                    $memName1 = ucwords($getMemDetls1['names']);
                    $memEmail1 = strtolower($getMemDetls1['emails']);
                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName1,</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                        <b>&#8358;$amts</b> has been added to your wallet because you referred $memName who has become a sponsor of iContestPRO. Click on your <a href='".base_url()."dashboard/mywallet/'>wallet dashboard</a> to see your amount, thank you!</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "Credit Alert From iContestPRO!";
                    $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                    $to = $memEmail1;
                    $from_name = "Admin @ iContestPRO";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                }else{
                    $this->db->where('id', $ids);
                    $this->db->set($colums, 0);
                    $this->db->set('mem_type', 'mem');
                    $query = $this->db->update($tbl);
                }
            }

            if($colums=="agents"){
                if($agents == 1){
                    $this->db->where('id', $ids)->where('agents', 1);
                    $this->db->set('agents', 2); // 2 is agent approval
                    $query = $this->db->update($tbl);

                    $getMemDetls = $this->sql_models->getDetails($ids); // sponsor
                    $memName = ucwords($getMemDetls['names']);
                    $memEmail = strtolower($getMemDetls['emails']);
                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                        Your iContestPRO agency has been verified and approved. You can now fund your wallet and sell to the voters, thank you!</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "Your iContestPRO Agency Has Been Approved!";
                    $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                    $to = $memEmail;
                    $from_name = "Admin @ iContestPRO";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                }else{
                    $this->db->where('id', $ids);
                    $this->db->set('agents', 1);
                    $query = $this->db->update($tbl);
                }
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "adverts"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->approved;
            
            if($approved == 0){
                $getMemDetls1 = $this->sql_models->getDetails($aparams);
                $memName = ucwords($getMemDetls1['names']);
                $memEmail = strtolower($getMemDetls1['emails']);
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                    Your advert has been approved and now shown on our iContestPRO platform for $duratn. Kindly view the platform to verify at <a href='".base_url()."'>https://icontestpro.com</a>. Thank you for your patronage!</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "Your Advert Has Been Approved";
                $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                $to = $memEmail;
                $from_name = "Admin @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "boost_ads"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->paid;
            
            if($approved == 0){
                $getMemDetls1 = $this->sql_models->getDetails($aparams);
                $memName = ucwords($getMemDetls1['names']);
                $memEmail = strtolower($getMemDetls1['emails']);
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                    Your advert has successfully been approved and now shown on our iContestPRO platform for $duratn. Kindly view the platform to verify at <a href='".base_url()."'>https://icontestpro.com</a>. Thank you for your patronage!</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "Your Advert Has Been Approved";
                $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                $to = $memEmail;
                $from_name = "Admin @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                $txtexp = strtotime('+'.$duratn, time());
                $this->db->where('id', $ids);
                $this->db->set($colums, 1);
                $this->db->set('timings', $txtexp);
                $query = $this->db->update($tbl);
            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "wallets"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->paid;
            $amts = $duratn;
            
            if($approved == 0){

                $this->db->where('id', $ids);
                $this->db->set($colums, 1);
                $query = $this->db->update($tbl);

                $this->db->set('wallet', "wallet+$amts", FALSE);
                $this->db->where('id', $aparams);
                $query2 = $this->db->update('members');

                $getMemDetls1 = $this->sql_models->getDetails($aparams);
                $memName = ucwords($getMemDetls1['names']);
                $memEmail = strtolower($getMemDetls1['emails']);
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                    The sum of <b>&#8358;$amts</b> fund has been added to your wallet because you made a request of fund addition. Thank you for your patronage.</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "Your Fund Has Been Added";
                $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                $to = $memEmail;
                $from_name = "Admin @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);

                $this->db->set('wallet', "wallet-$amts", FALSE);
                $this->db->where('id', $aparams)->where('wallet >=', $amts);
                $query2 = $this->db->update('members');
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "request_withdrawals"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->answered;
            $amts2 = $duratn;

            $amts=($this->withdraw_fee/100)*$amts2; // 2/100 = 0.02*2000=40
            $amtsi=$amts2 - $amts; // 2000-40=1960
            
            if($approved == 0){

                $this->db->where('id', $ids);
                $this->db->set($colums, 1);
                $query = $this->db->update($tbl);

                $this->db->set('wallet', "wallet-$amts2", FALSE);
                $this->db->where('id', $aparams)->where('wallet >=', $amts2);
                $query2 = $this->db->update('members');

                $getMemDetls1 = $this->sql_models->getDetails($aparams);
                $memName = ucwords($getMemDetls1['names']);
                $memEmail = strtolower($getMemDetls1['emails']);
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello $memName,</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>

                    You have been credited with the sum of <b>&#8358;".number_format($amtsi)."</b> from your wallet to the bank details you provided for us, kindly check and confirm. Thank you for your patronage.</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "iContestPRO Credit Alert!";
                $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                $to = $memEmail;
                $from_name = "Admin @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

            }else{
                $this->db->where('id', $ids);
                $this->db->set($colums, 0);
                $query = $this->db->update($tbl);

                $this->db->set('wallet', "wallet+$amtsi", FALSE);
                $this->db->where('id', $aparams);
                $query2 = $this->db->update('members');
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }


        if($tbl == "reward_tbl"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            if($colums=="approved")
                $approved = $query->row()->approved;
            else
                $approved = $query->row()->completed;
            
            if($colums=="approved"){
                if($approved == 0){
                    $txtexp = strtotime('+ 30 days', time());
                    $this->db->where('id', $ids);
                    $this->db->set($colums, 1);
                    $this->db->set('timings', $txtexp);
                    $query = $this->db->update($tbl);
                }else{
                    $this->db->where('id', $ids);
                    $this->db->set($colums, 0);
                    $query = $this->db->update($tbl);
                }
            }else{
                if($approved == 0){
                    $txtexp = strtotime('+'.$duratn, time());
                    $this->db->where('id', $ids);
                    $this->db->set($colums, 1);
                    $query = $this->db->update($tbl);
                }
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }

    }



    function adminWallet(){
        $query = $this->db->get_where('admin_tbls', array('id' => 1));

        $wallet_amt = $query->row()->wallet;

        $sums = 0;
        $wallet_amt1 = 0;
        $wallet_amt2 = 0;
        $this->db->select('amt')->from('adverts');
        $this->db->where('approved', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            foreach ($querys as $row) {
                $sums += $row['amt'];
            }
            $wallet_amt1 = $sums;
        }

        $this->db->select('amt')->from('boost_ads');
        $this->db->where('paid', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            foreach ($querys as $row) {
                $sums += $row['amt'];
            }
            $wallet_amt2 = $sums;
        }

        $total_sum = $wallet_amt + $wallet_amt1 + $wallet_amt2;
        return $total_sum;
    }


    function allVotes(){
        $this->db->select('votes')->from('all_votes');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $querys = $query->result_array();
            $sums = 0;
            foreach ($querys as $row) {
                $sums += $row['votes'];
            }
            $votes = $sums;
        }else{
            $votes = 0;
        }
        return $votes;
    }


    
    function computeWinners($contest_id){
        $this->db->select('entr.id AS id1, entr.contestant_id')->from('entries entr');
        $this->db->where('conts.completed', 1)->where('entr.disqualify', 0)->where('entr.contest_id', $contest_id);
        $this->db->limit(3);
        $this->db->order_by('entr.votes', 'desc');
        $this->db->join('contests conts', 'conts.id = entr.contest_id');
        //$this->db->join('members mem', 'conts.id = entr.contest_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){ // yes expired
            $query = $query->result_array();
            $all_scores=""; $i=1;
            foreach ($query as $row) {
                $contestant_id = $row['contestant_id'];

                $newdata3 = array(
                    'contest_id'    => $contest_id,
                    'contestant_id' => $contestant_id,
                    'positns'       => $i,
                    'date_created'  => @date("Y-m-d g:i a", time())
                );
                $qrys = $this->db->insert('winners', $newdata3);
                
                if($i=="1") $mypositn = "1st";
                else if($i=="2") $mypositn = "2nd";
                else $mypositn = "3rd";

                $getMemDetls = $this->sql_models->getDetails($contestant_id);
                $getContestName = $this->sql_models->getContestName($contest_id);
                $memName = ucwords($getMemDetls['names']);
                $memEmail = strtolower($getMemDetls['emails']);
                
                $getContestDetails = $this->sql_models->getContestDetails($contest_id);
                $price1 = $getContestDetails['price1'];
                $price2 = $getContestDetails['price2'];
                $price3 = $getContestDetails['price3'];
                $add_price1 = $getContestDetails['add_price1'];
                $add_price2 = $getContestDetails['add_price2'];
                $add_price3 = $getContestDetails['add_price3'];

                $add_price1_ = ""; $add_price2_ = ""; $add_price3_ = "";
                
                if($add_price1!="") $add_price1_ = "And $add_price1";
                if($add_price2!="") $add_price2_ = "And $add_price2";
                if($add_price3!="") $add_price3_ = "And $add_price3";

                if($i=="1") $myprize=$price1.$add_price1_;
                else if($i=="2") $myprize=$price2.$add_price2_;
                else $myprize=$price3.$add_price3_;
                
                //////////////////FOR EMAILS/////////////////////////
                    $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Congratulations $memName!</b></p>";
                    $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                    You just emerged $mypositn position in the just concluded contest, \"$getContestName\". You have won $myprize. The sponsor of the contest will get in touch with you shortly.<br><br>Join the other contests and keep winning.</p>";
                //////////////////FOR EMAILS///////////////////////// 

                $subj = "Congratulations $memName!";
                $from = "iContestPRO Admins <no-reply@icontestpro.com>";
                $to = $memEmail;
                $from_name = "Admin @ iContestPRO";

                $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                $this->send_mail($from, $to, $from_name, $message_contents1, $subj);

                $i++;
            }
        }
    }



    function computeQuizWinners($quiz_id){
        $this->db->select('ma.id AS id1, ma.memid, qq.prize1, qq.prize2, qq.prize3, qq.prize4, qq.prize5')->from('member_answers ma');
        $this->db->where('qq.completed', 1)->where('qq.id', $quiz_id);
        $this->db->join('quiz_section qq', 'qq.id = ma.quiz_section_id');
        $this->db->limit(5);
        $this->db->order_by('ma.scores', 'desc');        
        $query = $this->db->get();
        if($query->num_rows() > 0){ // yes expired
            $query = $query->result_array();
            $all_scores=""; $i=1;
            foreach ($query as $row) {
                $memid = $row['memid'];

                $newdata3 = array(
                    'quiz_section_id'    => $contest_id,
                    'memid'              => $contestant_id,
                    'positns'            => $i,
                    'date_created'       => @date("Y-m-d g:i a", time())
                );
                $qrys = $this->db->insert('quiz_winners', $newdata3);


                $this->db->select('qw.id AS id1, qw.memid, qq.prize1, qq.prize2, qq.prize3,qq.prize4,qq.prize5')->from('quiz_winners qw');
                $this->db->where('qq.completed', 1)->where('qq.id', $quiz_id);
                $this->db->join('quiz_section qq', 'qq.id = qw.quiz_section_id');
                $this->db->limit(5);
                $this->db->order_by('qw.positns', 'asc');        
                $query = $this->db->get();
                if($query->num_rows() > 0){ // yes expired
                    $query = $query->result_array();
                    $posn = 1;
                    foreach ($query as $row) {
                        $memid = $row['memid'];
                        $prizes = $query->row("prize$posn");

                        ///////credit winners wallets////////
                        $this->db->set('wallet', "wallet+$prizes", FALSE);
                        $this->db->where('id', $memid);
                        $query = $this->db->update('members');
                        ///////credit winners wallets////////
                        $posn++;
                    }
                }
                $i++;
            }
        }
    }


    function getQuizesID($id){
        $this->db->select('id, quiz_section_id, questions, explanations, files, op1, op2, op3, op4, ans1, explanations');
        $this->db->from('quiz_questions')->where('md5(id)', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;    
        }
    }


    function delete_quiz_pics($file1){
        $in_folder1 = "quizes/".$file1;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }



    function countQuiz3($quiz_sec_id){
        $this->db->select('count(qu.id) as allcount')->from('quiz_questions qu');
        $this->db->where('qu.quiz_section_id', $quiz_sec_id);
        $this->db->join('quiz_section qi', 'qi.id = qu.quiz_section_id');
        $query = $this->db->get();
        $result = $query->result_array();
        $counts1 = @$result[0]['allcount'];
        if($counts1=="" || $counts1 <= 0)
            return 0;
        else
            return $counts1;
    }


    function getQuizDetails($id){
        $this->db->select('quiz_title');
        $this->db->from('quiz_section')->where('md5(id)', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('quiz_title');
        }else{
            return false;    
        }
    }


    
    function deleteContestVoteIDs($contest_id){
        $this->db->where('contest_id', $contest_id);
        $this->db->delete('all_votes');
    }

    

    var $order_column = array(null, "*");
    function make_datatables($tbls, $params, $params2, $start_date, $end_date){
        //echo $params2; exit;
        $tbls1="";
        $params3="public_view";
        $params4="";
        if($tbls=="contest_leaderboard") $tbls1 = "contests";
        if($tbls=="vp_market") $tbls1 = "vp_market";
        if($tbls=="voters_leaderboard"){ $tbls1 = "entries"; $params4="voters"; }
        if($tbls=="entries_leaderboard") $tbls1 = "entries";
        if($tbls=="entry_records"){ $tbls1 = "entries"; $params3 = "private_view"; }
        if($tbls=="sponsored_contests"){ $tbls1 = "boost_ads"; $params3 = "private_view"; }
        //if($tbls=="votes_recs"){ $tbls1 = "all_votes"; $params3 = "private_view"; }
        if($tbls=="votes_recs"){ $tbls1 = "entries"; $params3 = "private_view"; }
        if($tbls=="who_voted"){ $tbls1 = "entries"; $params3 = "private_view"; $params4="who_voted"; }
        if($tbls=="view_contests"){ $tbls1 = "contests"; $params3 = "private_view"; }
        if($tbls=="view_adverts"){ $tbls1 = "adverts"; $params3 = "private_view"; }
        if($tbls=="support"){ $tbls1 = "support"; $params3 = "private_view"; }
        if($tbls=="announcement"){ $tbls1 = "announcement"; $params3 = "private_view"; }
        if($tbls=="referral_records"){ $tbls1 = "referrals"; $params3 = "private_view"; }
        if($tbls=="view_transactions"){ $tbls1 = "request_withdrawals"; $params3 = "private_view"; }
        if($tbls=="transfer_history"){ $tbls1 = "transfer_history"; $params3 = "private_view"; }

        $this->fetchUsers($tbls1, $params, $params2, $params3, $params4, $start_date, $end_date);
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        if($params2!="" && $params2!="inbox" && $params2!="sent"){
            if($tbls1=="contests" && $params3 == "private_view")
                $this->db->where('user_id', $params2);
        }
        $query = $this->db->get();
        return $query->result();
    }


    
    public function get_filtered_data($tbls, $params, $params2, $params3, $start_date, $end_date){
        $tbls1="";
        $params3="public_view";
        $params4="";
        if($tbls=="contest_leaderboard") $tbls1 = "contests";
        if($tbls=="vp_market") $tbls1 = "vp_market";
        if($tbls=="voters_leaderboard"){ $tbls1 = "entries"; $params4="voters"; }
        if($tbls=="entries_leaderboard") $tbls1 = "entries";
        if($tbls=="entry_records"){ $tbls1 = "entries"; $params3 = "private_view"; }
        //if($tbls=="votes_recs"){ $tbls1 = "all_votes"; $params3 = "private_view"; }
        if($tbls=="votes_recs"){ $tbls1 = "entries"; $params3 = "private_view"; }
        if($tbls=="who_voted"){ $tbls1 = "entries"; $params3 = "private_view"; $params4="who_voted"; }
        if($tbls=="view_contests"){ $tbls1 = "contests"; $params3 = "private_view"; }
        if($tbls=="sponsored_contests"){ $tbls1 = "boost_ads"; $params3 = "private_view"; }
        if($tbls=="view_adverts"){ $tbls1 = "adverts"; $params3 = "private_view"; }
        if($tbls=="support"){ $tbls1 = "support"; $params3 = "private_view"; }
        if($tbls=="announcement"){ $tbls1 = "announcement"; $params3 = "private_view"; }
        if($tbls=="referral_records"){ $tbls1 = "referrals"; $params3 = "private_view"; }
        if($tbls=="view_transactions"){ $tbls1 = "request_withdrawals"; $params3 = "private_view"; }
        if($tbls=="transfer_history"){ $tbls1 = "transfer_history"; $params3 = "private_view"; }

        $this->fetchUsers($tbls1, $params, $params2, $params3, $params4, $start_date, $end_date);
        // if($params!="" && $params>0)
        //     $this->db->where('memid', $params);
        if($params2!=""){
            if($tbls1=="contests" && $params3 == "private_view"){
                $this->db->where('user_id', $params2);
            }

            if(($tbls=="support" || $tbls=="announcement") && $params3 == "private_view"){
                $this->db->where('user_id', $params2);
            }
        }

        /*if($start_date!="" && $end_date!=""){
            $srchs = "(all_votes.date_created BETWEEN '$start_date' AND '$end_date')";
            $this->db->where("$srchs");
        }*/

        $query = $this->db->get();
        return $query->num_rows();
    }


    function get_all_data($tbls, $params, $params2, $start_date, $end_date){
        $tbls1="";
        $this->db->select("*");
        if($tbls == "contest_leaderboard") $this->db->from('contests');
        if($tbls == "voters_leaderboard") $this->db->from('entries');
        if($tbls == "entries_leaderboard") $this->db->from('entries');
        if($tbls == "entry_records") $this->db->from('entries');
        if($tbls == "view_contests") $this->db->from('contests');
        if($tbls == "vp_market") $this->db->from('vp_market');
        if($tbls == "votes_recs") $this->db->from('entries');
        if($tbls == "who_voted") $this->db->from('entries');
        if($tbls == "view_adverts") $this->db->from('adverts');
        if($tbls == "support") $this->db->from('support');
        if($tbls == "announcement") $this->db->from('announcement');
        if($tbls == "sponsored_contests") $this->db->from('boost_ads');
        if($tbls == "referral_records") $this->db->from('referrals');
        if($tbls == "view_transactions") $this->db->from('request_withdrawals');
        if($tbls == "transfer_history") $this->db->from('transfer_history');

        if($params2!=""){
            if($tbls=="contests" && $params3 == "private_view")
                $this->db->where('user_id', $params2);
            
            if(($tbls=="support" || $tbls=="announcement"))
                $this->db->where('user_id', $params2);
        }

        /*if($start_date!="" && $end_date!=""){
            $srchs = "(all_votes.date_created BETWEEN '$start_date' AND '$end_date')";
            $this->db->where("$srchs");
        }*/

        return $this->db->count_all_results();
    }


    

    function fetchUsers($tbls, $params, $params2, $params3, $params4, $start_date, $end_date){
        //echo $tbls."wwww"; exit;
        $nowtime = time();
        $txtsrchs = $_POST['search']['value'];

        
        if($tbls=="contests" && $params3=="public_view"){
            $this->db->select('conts.*');
            $this->db->from('contests conts')->where('conts.approved', 1);
            //if($params2 != "") $this->db->where('conts.approve', $params2);

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(conts.title like '%$txtsrchs%' OR conts.premium like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('conts.id', 'desc');
        }




        if($tbls=="entries" && $params3=="public_view" && $params4=="voters"){ // voters_leaderbd
            //$this->db->select('avv.id, avv.contest_id, avv.contestant_id, mem.id AS id1, mem.names, mem.nickname, mem.views, lgs.name AS citys1, sts.name AS states1, mem.pics, mem.profession');
            $this->db->select('avv.id, avv.contest_id, avv.contestant_id, mem.id AS id1, mem.names, mem.nickname, mem.views, mem.pics, mem.profession, mem.online_timing, avv.voter');

            //$this->db->from('bstd_vts bvs');
            $this->db->from('all_votes avv');
            $this->db->join('members mem', 'mem.id = avv.voter');
            $this->db->join('contests cons', 'cons.id = avv.contest_id');
            //$this->db->join('states sts', 'sts.id = mem.states');
            //$this->db->join('local_governments lgs', 'lgs.id = mem.citys');
            
            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%' OR cons.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->group_by('avv.voter', 'avv.contest_id');
            $this->db->order_by('avv.id', 'desc');
        }


        if($tbls=="vp_market"){
            $this->db->select('vm.id as id, mem.id as mem_id, vm.sell_at, vm.acct_details, mem.names, mem.nickname, mem.vp, mem.pics, mem.phone, mem.citys, mem.states, mem.emails');

            $this->db->from('vp_market vm');
            $this->db->where('mem.vp >=', 100);

            $this->db->join('members mem', 'mem.id = vm.memid');
            
            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('vm.id', 'desc');
        }


        if($tbls=="entries" && $params3=="public_view" && $params4==""){ // entries_leaderboard
            $this->db->select('entr.*, sts.id AS sts_id, entr.id AS id1, entr.votes, mem.names, mem.id AS memid, mem.nickname, mem.views AS views1, mem.profession, mem.pics, mem.views AS views2, sts.name AS states1, lgs.name AS citys1, lgs.id AS lgs_id, cons.title, cons.user_id, cons.timings, cons.media_type, cons.id AS con_id')->from('entries entr');
            $this->db->join('members mem', 'mem.id = entr.contestant_id');
            $this->db->join('contests cons', 'cons.id = entr.contest_id');

            $this->db->join('states sts', 'sts.id = mem.states');
            $this->db->join('local_governments lgs', 'lgs.id = mem.citys');

            if($params!="" && $params>0) $this->db->where('contest_id', substr($params, 0, -5));
            $this->db->where('cons.approved', 1);

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%' OR conts.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->group_by('entr.contestant_id');
            $this->db->order_by('entr.votes', 'desc');
        }


        if($tbls=="entries" && $params3=="private_view" && $params4==""){
            //$this->db->select('entr.*, mem.id AS id1, conts.id AS id2, mem.names, mem.vp, mem.nickname, conts.title, entr.contestant_id');
            $this->db->select('entr.votes, entr.id, mem.id AS id1, conts.id AS id2, conts.title, conts.timings');
            $this->db->from('entries entr');
            if(is_numeric($params2) && $params2>0) $this->db->where('entr.contestant_id', $params2);
            $this->db->join('members mem', 'mem.id = entr.contestant_id');
            $this->db->join('contests conts', 'conts.id = entr.contest_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%' OR conts.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('entr.id desc');
        }


        if($tbls=="all_votes" && $params3=="private_view"){
            $this->db->select('vts.*, mem.id AS id1, conts.id AS cid, mem.names, vts.votes, conts.title, vts.vp, vts.date_created');
            if($params2 != "") $this->db->where('vts.voter', $params2);
            $this->db->from('all_votes vts');
            $this->db->join('members mem', 'mem.id = vts.contestant_id');
            $this->db->join('contests conts', 'conts.id = vts.contest_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR conts.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            //$this->db->group_by('vts.contest_id, vts.contestant_id');
            $this->db->order_by('vts.id', 'desc');
        }


        if($tbls=="referrals" && $params3=="private_view"){
            $this->db->select('ref.id, mem.names, mem.profession, mem.date_upgraded, mem.date_created');
            $this->db->from('referrals ref');
            if($params2 != "") $this->db->where('ref.memid', $params2)->where('mem.mem_type', 'spon');
            $this->db->join('members mem', 'mem.id = ref.refs');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.profession like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('ref.id', 'desc');
        }


        if($tbls=="request_withdrawals" && $params3=="private_view"){
            $this->db->select('reqs.*, bns.id AS id1, mem.id AS mid, bns.banks');
            $this->db->from('request_withdrawals reqs');
            if($params2 != "") $this->db->where('reqs.memid', $params2);
            $this->db->join('bank_names bns', 'bns.id = reqs.bank_name');
            $this->db->join('members mem', 'mem.id = reqs.memid');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(bns.acct_name like '%$txtsrchs%' OR bns.amt like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('reqs.id', 'desc');
        }


        if($tbls=="transfer_history" && $params3=="private_view"){
            $this->db->select('reqs.*, mem.id AS mid, mem1.id AS mid2, mem.names AS name_sender, mem.nickname AS nickname_sender, mem1.names, mem1.nickname');
            $this->db->from('transfer_history reqs');
            if($params2 != "") $this->db->where('reqs.sender_id', $params2)->or_where('reqs.recipient_id', $params2);
            $this->db->join('members mem', 'mem.id = reqs.sender_id');
            $this->db->join('members mem1', 'mem1.id = reqs.recipient_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.phone like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR mem.amount like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('reqs.id', 'desc');
        }


        if($tbls=="adverts" && $params3=="private_view"){
            $this->db->select('adv.*, mem.id AS id1, mem.names');
            if($params2 != "") $this->db->where('adv.user_id', $params2);
            $this->db->from('adverts adv');
            $this->db->join('members mem', 'mem.id = adv.user_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(adv.title like '%$txtsrchs%' OR mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('adv.id', 'desc');
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
            $this->db->select('spt.*, mem.names, spt.id as id1');
            $this->db->from('support spt');

            if($params == "sent"){
                $this->db->where('spt.user_id', 0)->where('sent_from', $this->myID);
                $this->db->join('members mem', 'mem.id = spt.sent_from');
            }else{
                $this->db->where('spt.sent_from', 0)->where('user_id', $this->myID);
                $this->db->join('members mem', 'mem.id = spt.user_id');
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%' OR spt.subj like '%$txtsrchs%' OR spt.message like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('spt.id', 'desc');
        }


        if($tbls == "announcement"){
            $this->db->select('spt.*, mem.names, mem.nickname, spt.id as id1');
            $this->db->from('announcement spt');
            if($params2 != "") $this->db->where('spt.user_id', $params2);
            $this->db->join('members mem', 'mem.id = spt.user_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR spt.subj like '%$txtsrchs%' OR spt.message like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('spt.id', 'desc');
        }


        
        if($tbls=="contests" && $params3=="private_view"){
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


        if($tbls=="boost_ads" && $params3=="private_view"){
            $this->db->select('bst.*, conts.id AS id1, mem.id AS mid, conts.start_date, conts.title');
            $this->db->from('boost_ads bst');
            if($params2 != "") $this->db->where('bst.user_id', $params2);
            $this->db->join('contests conts', 'conts.id = bst.contest_id');
            $this->db->join('members mem', 'mem.id = bst.user_id');

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(conts.title like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('conts.id', 'desc');
        }


    }



    function fetchUsers_sort($tbls, $start_date, $end_date, $usrid, $usrname){ // date_sort = 2020-01-02
        $this->db->select('ss.*, ss.id as id1, pur.pv, cat.cat as items, cus.names, cus.id as cid, pur.selling_price');
        //$this->db->select('ss.*, ss.id as id1');
        //$this->db->select('*');
        $this->db->from('sales ss');
        $this->db->join('categories cat', 'cat.id = ss.item_id');

        // $start_date = "2020-01-20";
        // $end_date = "2020-01-21";

        $srchs = "(ss.date_created BETWEEN '$start_date' AND '$end_date')";

        if($start_date!="" && $end_date!="")
            $this->db->where("$srchs");

        if($usrid!="")
            $this->db->where("md5(user_id)", $usrid);

        if(isset($txtsrchs) && $txtsrchs!=""){
            if($params != "add_sales")
                $srchs = "(pur.item_code like '%$txtsrchs%' OR cat.cat like '%$txtsrchs%' OR pur.pv like '%$txtsrchs%' OR pur.cost_price like '%$txtsrchs%' OR cus.names like '%$txtsrchs%')";
            else
                $srchs = "(pur.item_code like '%$txtsrchs%' OR cat.cat like '%$txtsrchs%' OR pur.pv like '%$txtsrchs%' OR pur.cost_price like '%$txtsrchs%')";
            $this->db->where("$srchs");
        }

        $this->db->join('purchases pur', 'pur.item = ss.item_id');
        $this->db->join('customers cus', 'cus.id = ss.user_id');

        $this->db->order_by('ss.id', 'desc');

    }



    /*function fetchUsers_sort1($tbls, $start_date, $end_date, $column3){ // date_sort = 2020-01-02
        //$this->db->select('ss.*, ss.id as id1, pur.pv, cat.cat as items, cus.names');
        $this->db->select("pur.pv, ss.qty, ss.price");
        $this->db->from('sales ss');
        $srchs = "(ss.date_created BETWEEN '$start_date' AND '$end_date')";
        $this->db->join('categories cat', 'cat.id = ss.item_id');

        //if($start_date!="" && $end_date!="")
            $this->db->where("$srchs");

        if(isset($txtsrchs) && $txtsrchs!=""){
            if($params != "add_sales")
                $srchs = "(pur.item_code like '%$txtsrchs%' OR cat.cat like '%$txtsrchs%' OR pur.pv like '%$txtsrchs%' OR pur.cost_price like '%$txtsrchs%' OR cus.names like '%$txtsrchs%')";
            else
                $srchs = "(pur.item_code like '%$txtsrchs%' OR cat.cat like '%$txtsrchs%' OR pur.pv like '%$txtsrchs%' OR pur.cost_price like '%$txtsrchs%')";
            $this->db->where("$srchs");
        }

        $this->db->join('purchases pur', 'pur.item = ss.item_id');
        $this->db->join('customers cus', 'cus.id = ss.user_id');
        $query = $this->db->get();

        $mycolums1 = 0;
        if($query->num_rows() > 0){
            $query2 = $query->result_array();
            //print_r($query2); exit;
            foreach ($query2 as $row) {
                $qtys = $row['qty'];
                if($column3=="purchase"){
                    $pv = $row['pv'];
                    $pv_qty = $qtys*$pv;
                    $mycolums1 += $pv_qty;
                }else{
                    $price = $row['price'];
                    $price_qty = $qtys*$price;
                    $mycolums1 += $price_qty;
                }
            }
            return $mycolums1;
        }

    }*/




    public function getCountrys($country_ids){
        $country_ids = explode(',', $country_ids);
        $contry1 = "";
        foreach ($country_ids as $country_ids1) {
            if($country_ids1){
                $this->db->select('name');
                $this->db->from('countries');
                $this->db->where('id', $country_ids1);
                $query = $this->db->get();
                
                if($query->num_rows() > 0){
                    $contry = $query->row('name');
                    $contry1 .= "$contry, ";
                }else{
                    $contry1 .= "";
                }
            }
        }
        $contry2 = substr($contry1, 0, -2);
        return $contry2;
    }



    public function getVoter($id){
        $this->db->select('names')->from('members')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return ucwords($query->row('names'));
        else
            return false;
    }


    
    public function getBlogMedias($id){
        $this->db->select('files')->from('blogs_images')->where('blog_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('files');
        else
            return false;
    }


    public function getVotes($contest_id, $memid){
        $this->db->select('votes')->from('entries')->where('contest_id', $contest_id)->where('contestant_id', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row('votes');
        else
            return false;
    }


    public function getLocs($id, $tbl){
        $this->db->select('name')->from($tbl)->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return ucwords($query->row('name'));
        else
            return "";
    }

    
    public function fetchMsgs(){
        $this->db->select('id, subj, date_posted, has_read');
        $this->db->from('support')->where('user_id', $this->myID);
        $this->db->order_by('has_read', 'asc');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }


    
    public function activeContests(){
        $this->db->select('cons.id, cons.title');
        $this->db->from('contests cons')->where('cons.completed', 0)->where('cons.approved', 1);
        $this->db->join('entries entr', 'cons.id = entr.contest_id');
        $this->db->order_by('rand()');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }



    public function topContestants($tbl, $conid, $limits){
        $now=time();
        $this->db->select('mem.id as memid, mem.names, mem.nickname, entr.votes, mem.pics');
        $this->db->from('entries entr');
        //->where('cons.timings >=', $now);
        $this->db->where('cons.id', $conid)->where('entr.disqualify', 0);
        $this->db->where('cons.completed', 0)->where('cons.approved', 1);
        $this->db->join('members mem', 'mem.id = entr.contestant_id');
        $this->db->join('contests cons', 'cons.id = entr.contest_id');
        $this->db->group_by('entr.contestant_id');
        $this->db->order_by('entr.votes', 'desc');
        $this->db->limit($limits);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }


    
    public function featContests(){
        $now = time();
        $this->db->select('cons.id, cons.files, cons.entry_type, cons.timings, cons.company_logo, cons.title, cons.start_date, cons.start_date_contest, cons.sponsoredby, cons.close_date_entry, cons.views, bts.id as id2, bts.date_created as date_created1');
        $this->db->from("boost_ads bts");
        $this->db->where('cons.approved', 1)->where('bts.timings >=', $now);
        $this->db->join('members mem', 'mem.id = bts.user_id');
        $this->db->join('contests cons', 'cons.id = bts.contest_id');

        $this->db->order_by('rand()');
        $this->db->limit(20);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function getBankNames(){
        $this->db->select('*');
        $this->db->from('bank_names');
        $this->db->order_by('banks', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }


    public function check_link($url, $tbl){
        $this->db->select('id');
        $this->db->from($tbl);
        $this->db->where('md5(id)', $url);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }



    public function checkMemID($memid){
        $this->db->select('id');
        $this->db->from('vp_market');
        $this->db->where('memid', $memid);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    

    function update_inserts_records($data, $memid, $tbl){
        if($memid != "")
            $query1 = $this->db->where('md5(id)', $memid)->update($tbl, $data);
        else
            $query1 = $this->db->insert($tbl, $data);

        if($query1){
            // $names1 = explode(' ', $data['names']);
            // return ucwords($names1[0]);
            return true;
        }else{
            return false;
        }
    }



    function updateSettings1($data, $tbl){
        $query = $this->db->where('id', 1)->update($tbl, $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    

    

}

?>