var site_urls = $jq1('#txtsite_url').val();


$jq1('body').on('change', '#txtcontests', function(e) {
  $jq1(".div_leaderboard").html('<div style="text-align: center; font-size: 17px; color: #777; padding:10px 0 0 0">Loading...</div>');
  $jq1(".dynamic_idhash").html('<font class="view_more_details pr-sm-0 pr-xs-30">Loading...</font>');
  var txtcontests = $jq1(this).val();
  var tims = $jq1("#txttime").val();
  var datastring='txtcontests='+txtcontests;
    //+'&amount='+txtamts

  var ids_hash2 = txtcontests+tims.substring(0, 5);

  $jq1.ajax({
    type : "POST",
    url : site_urls+"node/fetchLeaderboard",
    data: datastring,
    success : function(data){
      $jq1(".div_leaderboard").html(data);
      $jq1(".dynamic_idhash").html('<a href="'+site_urls+ids_hash2+'/entries-leaderboard/" class="view_more_details pr-sm-0 pr-xs-30">View more <i class="fa fa-caret-right"></i></a>');

    },error : function(data){
      $jq1(".div_leaderboard").html(data);
    }
  });
});




$jq1('body').on('click', '.vid_play_profile_ i', function(e) {
  var hisname = $jq1(this).attr('hisname');
  var fid = $jq1(this).attr('fid');
  var memid = $jq1(this).attr('memid');
  var scrollstop = $jq1(this).attr('scrollstop');
  create_cookie('scrollstop', scrollstop);
  window.history.pushState('forward', null, './#video');

  $jq1(".overlays1, .watch_vids").fadeIn('fast');
  $jq1(".watch_vids").html('<div class="load_inners"><img src="'+site_urls+'images/loader.gif"> Loading...</div>');
  $jq1('body, html').css({'overflow-y': 'hidden'});

  var datastring='hisname='+hisname
  +'&fid='+fid
  +'&memid='+memid;

  $jq1.ajax({
    type : "POST",
    url: site_urls+'node/loadVideo1',
    data : datastring,
    success : function(data){
      $jq1(".watch_vids").html(data);
    }
  });
});



$jq1('body').on('click', '.closevid, .overlays1', function(e) {
  $jq1('.overlays1').fadeOut('fast');
  $jq1(".single_contest").fadeIn('fast');

  $jq1("video").each(function(){
    $jq1(this).get(0).pause();
  });
  window.history.pushState('forward', null, './');

  setTimeout(function(){
    var scrollstop = retrieve_cookie('scrollstop');
    $jq1("html, body").animate({scrollTop: jq1('.scroll_stop'+scrollstop).offset().top-40 }, 1);
  },1);

  $jq1('.watch_vids').fadeOut('fast').html('');
  $jq1('body, html').css('overflow-y', 'visible');
});




window.addEventListener("hashchange", function(e) {
  var hash = location.hash.substring(1);

  if(e.oldURL.length > e.newURL.length){
    $jq1('.closevid').trigger('click');
    $jq1('.mfp-close').trigger('click');
    $jq1jq1('.vote_me').hide();
    $jq1(".overlays1, .watch_vids").hide();
    $jq1('.watch_vids').hide().html('');
    $jq1('body, html').css('overflow-y', 'visible');

    var divs1 = $jq1('.div_entry');
    if(!divs1.is(':visible')){
      $jq1('.sld_btn_1, .slide_to_details').hide();
      divs1.slideDown('fast');
      $jq1("html, body").animate({scrollTop: $jq1('.cmd_entries').offset().top-300 }, "slow");
    }

    var divs2 = $jq1('.comments_div');
    if(divs2.is(':visible')){
      $jq1(".comments_form")[0].reset();
      $jq1('.slideUp_comments, .comments_div').hide();
      $jq1('.div_entry, .div_entry1, .all_entries_div').slideDown('fast');
      $jq1("html, body").animate({scrollTop: $jq1('.view_comments').offset().top-300 }, "slow");
    }

    $jq1("video").each(function(){
      $jq1(this).get(0).pause();
    });
  }
  window.history.pushState('forward', null, './');
});



$jq1('body').on('click', '.chatWithMe_hd a, .chatWithMe_profile a', function(e) {
  var hisname = $jq1(this).attr('hisname');
  var con_id = $jq1(this).attr('con_id');
  var memid = $jq1(this).attr('memid');
  var myid = $jq1(this).attr('myid');
  var pics = $jq1(this).attr('pics');
  $jq1('#memids').val(memid);
  $jq1('#txtmyid').val(myid);

  $jq1('.video-play-icon').magnificPopup({
    type: 'inline',
    midClick: true,
    mainClass: 'mfp-fade'
  });

  window.history.pushState('forward', null, './#chat');

  if(myid!=memid)
    $jq1('.member_name').html("Chatting with "+hisname+"...");
  else
    $jq1('.member_name').html("");

  $jq1('.get_chats').html("<p style='padding:6px 0 10px 0; color:#666;'><i>Loading chats...</i>");

  var datastring='memid='+memid
  //+'&txt_ad_name='+txt_ad_name;

  $jq1.ajax({
    type : "POST",
    url : site_urls+"node/getAllChats",
    data: datastring,
    success : function(data){
      $jq1('.mychats_h'+memid).html('');
      $jq1('.get_chats').html(data);
      setTimeout(function(){
        $jq1('.over_flow').scrollTop($jq1('.over_flow')[0].scrollHeight);
      },50);
    }
  });
});