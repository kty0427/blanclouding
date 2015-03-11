<?
	include_once "./header.php";
?>
  <div id="input_div" class="wrap_page popup">
    <div class="block_close clearfix">
      <a href="#" class="btn_close" onclick="javascript:window.close()"><img src="img/popup/btn_close.png" width="29"/></a>
    </div>
    <div class="content" style="background:white;">
      <div class="inner">
        <div class="title">
          <img src="img/popup/title_input.png" width="192" alt=""/>
        </div>
        <div class="input_block">
          <ul class="clearfix">
            <li class="t_name"><img src="img/popup/txt_label_name.png" width="32" alt=""/></li>
            <li class="input_txt"><input type="text" name="mb_name" id="mb_name" onkeydown="Check_Hangul(this)"></li>
          </ul>
          <ul class="clearfix">
            <li class="t_name"><img src="img/popup/txt_label_phone.png" width="48" alt=""/></li>
            <li class="input_txt phone">
              <div class="inner clearfix">
                <div>
                  <select id="mb_phone1" name="mb_phone1">
                    <option>010</option>
                    <option>011</option>
                    <option>016</option>
                    <option>017</option>
                    <option>018</option>
                    <option>019</option>
                  </select>
                </div>
                <div><input type="tel" id="mb_phone2" name="mb_phone2"></div>
                <div><input type="tel" id="mb_phone3" name="mb_phone3"></div>
              </div>
            </li>
          </ul>
        </div>
        <div class="input_block">
          <ul class="clearfix">
            <li class="t_name"><img src="img/popup/txt_label_store.png" width="63" alt=""/></li>
            <li class="input_txt address">
              <div class="inner clearfix">
                <div>
                  <select name="addr1" id="addr1" onchange="addr_change(this.value)">
                    <option value="">선택하세요</option>
<?
	// 주소 쿼리
	$query 		= "SELECT * FROM ".$_gl['addr_info_table']." WHERE addr_level='1'";
	$result 	= mysqli_query($my_db, $query);

	while($addr1_data = @mysqli_fetch_array($result))
	{
?>
                    <option value="<?=$addr1_data['addr_sido']?>"><?=$addr1_data['addr_sido']?></option>
<?
	}
?>
                  </select>
                </div>
                <div id="sel_addr2">
                  <select name="addr2" id="addr2" onchange="shop_change(this.value)">
                    <option value="">선택하세요</option>
                  </select>
                </div>
              </div>
            </li>
          </ul>
          <ul class="clearfix">
            <li class="t_name"></li>
            <li class="input_txt store" id="sel_shop">
              <select name="shop" id="shop">
                <option value="">선택하세요</option>
              </select>
            </li>
            <li class="btn">
              <a href="#map_div" id="search_shop" class="popup-with-zoom-anim" onclick="javascript:show_map();return false;"><img src="img/popup/btn_store.png" width="98" alt=""/></a>
            </li>
          </ul>
        </div>
        <div class="input_block input_check">
          <ul class="clearfix">
            <li class="in_check"><input type="checkbox"></li>
            <li class="in_check_label"><a href="popup_use_agree.php" target="_blank" >
			<img src="img/popup/btn_detail_01.png" width="164" alt=""/></a></li>
          </ul>
          <ul class="clearfix">
            <li class="in_check"><input type="checkbox"></li>
            <li class="in_check_label"><a href="popup_privacy_agree.php" target="_blank" ><img src="img/popup/btn_detail_02.png" width="164" alt=""/></a></li>
          </ul>
          <ul class="clearfix">
            <li class="in_check"><input type="checkbox"></li>
            <li class="in_check_label"><a href="popup_adver_agree.php" target="_blank" ><img src="img/popup/btn_detail_03.png" width="164" alt=""/></a>
            </li>
          </ul>
        </div>
        <div class="btn_block">
          <a href="#" onclick="javascript:chk_input();return false;"><img src="img/popup/btn_ok.png" width="178" alt=""/></a>
        </div>
      </div><!--inner-->
    </div>
  </div>
  <script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=4079f466534bbd570c0fd254a4c2954e&libraries=services"></script>
	<script type="text/javascript">

	// quick menu
	var quickTop;
	$(window).scroll(function() {
		quickTop = ($(window).height()-$('.quickmenu').height()) /2;
		$('.quickmenu').stop().animate({top:$(window).scrollTop()+quickTop},400,'easeOutExpo');
		
	});

    // 유튜브 반복 재생
    var controllable_player,start, 
    statechange = function(e){
		if (e.data === 0)
		{
			$("#video_control").text('일시정지');
			controllable_player.seekTo(0); controllable_player.playVideo();
		}
		else if (e.data === 1)
		{
			//controllable_player.pauseVideo();
			$("#video_control").text('일시정지');
		}
		else if (e.data === 2)
		{
			//controllable_player.playVideo();
			$("#video_control").text('재생');
		}
		else if (e.data === 3)
		{
			//alert('4444');
		}
    	//controllable_player.playVideo(); 
    };
    function onYouTubeIframeAPIReady() {
		controllable_player = new YT.Player('ytplayer', {events: {'onStateChange': statechange}}); 
    }

    if(window.opera){
		addEventListener('load', onYouTubeIframeAPIReady, false);
    }
	setTimeout(function(){
    	if (typeof(controllable_player) == 'undefined'){
    		onYouTubeIframeAPIReady();
    	}
    }, 1000)


	$(window).resize(function(){
		var width = $(window).width();
		//var height = $(window).height();

		var youtube_height = (width / 16) * 9;
		$("#ytplayer").width(width);
		$("#ytplayer").height(youtube_height);
	});

	$(document).ready(function() {
		//처음 화면 크기에 따라 영상및 커버 크기 변경
		var width = $(window).width();
		var height = $(window).height();
		var youtube_width = width;
		$("#ytplayer").width(width);
		$(".cover_area").width($("#ytplayer").width());
		var youtube_height = (width / 16) * 9;
		$("#ytplayer").height(youtube_height);
		$(".cover_area").height($("#ytplayer").height());

		$("#video_control").click(function(){
			var control_txt	= $("#video_control").text();
			if (control_txt == "일시정지"){
				controllable_player.pauseVideo();
				return false;
			}else{
				controllable_player.playVideo(); 
				return false;
			}
		});
		$( '.quickmenu' ).click( function() {
	    $( 'html, body' ).animate( { scrollTop : 0 }, 800 );
		  return false;
		} );

		$( '.scroll_navi_area' ).click( function() {
	    $( 'html, body' ).animate({ scrollTop: $(document).height()},1500);
		  return false;
		} );
		

		// 퀵메뉴 기본 위치
		var quick_height	= $(window).height()/2;
		$('.quickmenu').css("top",quick_height);
/*
		setTimeout("auto_play();",2000);
*/
		// 체크박스 스타일 설정
		$('.popup_wrap input').on('ifChecked ifUnchecked', function(event){
			//alert(this.id);
		}).iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			increaseArea: '0%'
		});

		// 팝업 jQuery 스타일
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: true,
			fixedBgPos: true,
			overflowY: 'hidden',
			closeBtnInside: true,
			//preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in',
			showCloseBtn : false,
			callbacks: {
				close: function() {
					/*$("#mb_name").val("");
					$("#mb_phone").val("");
					$('input').iCheck('uncheck');
					$("#postcode1").val("");
					$("#postcode2").val("");
					$("#addr1").val("");
					$("#addr2").val("");
					$("#post_div").hide();*/
				}
			}
		});

		$('.first-popup-link').magnificPopup({
			closeBtnInside:true
		});

		var magnificPopup = $.magnificPopup.instance;

		// 셀렉트박스 스타일
		$( "#mb_phone1" ).dropkick({
			mobile: true
		});

		$( "#addr1" ).dropkick({
			mobile: true
		});
		
		$( "#addr2" ).dropkick({
			mobile: true
		});


		$( "#shop" ).dropkick({
			mobile: true
		});
		
		$("#dk0-combobox").css("width","75px");
		$("ul[id*=dk0-]").css("width","79px");
		$("li[id*=dk0-]").css("width","60px");
		$("#dk1-addr1").css("width","120px");
		$("#dk1-combobox").css("width","120px");
		$("ul[id*=dk1-]").css("width","120px");
		$("li[id*=dk1-]").css("width","100px");
		$("#dk2-combobox").css("width","120px");
		$("ul[id*=dk2-]").css("width","120px");
		$("li[id*=dk2-]").css("width","100px");
		$("#dk3-combobox").css("width","120px");
		$("ul[id*=dk3-]").css("width","120px");
		$("li[id*=dk3-]").css("width","100px");
/*
		$("#dk1-addr1").css("width","120px");
		$("#dk1-addr1").css("font-size","14px");
		$("#dk1-combobox").css("height","34px");
		$("#dk2-addr2").css("width","120px");
		$("#dk2-addr2").css("font-size","14px");
		$("#dk2-combobox").css("height","34px");
		$("#dk3-shop").css("width","120px");
		$("#dk3-shop").css("font-size","14px");
		$("#dk3-combobox").css("height","34px");
*/
	});
	</script>
