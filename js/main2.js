function sns_share(media)
{	Kakao.init('0955d4d6b239e2a0f6159bc955bddd9b');

	if (media == "facebook")
	{
		var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://www.thefaceshopclouding.co.kr/?media=fb'),'sharer','toolbar=0,status=0,width=600,height=325');
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
			data:{
				"exec" : "insert_share_info",
				"media" : media
			}
		});
	}else if (media == "twitter")
	{
		var newWindow = window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent("1. 서장훈, 촉촉하게 수지랑! 서장훈 구름탄 기분이랄까~촉촉한 선물 2. 서장훈 더페이스샵 CF모델? '아니아니 그게 아니고' 공개! 구름선물") + '&url='+ encodeURIComponent('http://goo.gl/lO3xlN'),'sharer','toolbar=0,status=0,width=600,height=325');
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
			data:{
				"exec" : "insert_share_info",
				"media" : media
			}
		});
	}else if(media == "kakao") {

		// 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
		Kakao.Link.createTalkLinkButton({
		  label: "서장훈이 화장품 CF를?! \n<아니 아니, 그게 아니고~> 전격 공개!\n 건조한 피부에 봄비같은 하얀 수분 크림 출시!\n 지금 10ml Kit도 신청하세요!",
		  image: {
			src: 'http://www.thefaceshopclouding.co.kr/PC/images/sns_kt.jpg',
			width: '1200',
			height: '630'
		  },
		  webButton: {
			text: '더페이스샵',
			url: 'http://www.thefaceshopclouding.co.kr/?media=K01' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		  }
		});
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
			data:{
				"exec" : "insert_share_info",
				"media" : media
			}
		});

	}else if(media == "story"){
		// 로그인 창을 띄웁니다.
		Kakao.Auth.login({
		  success: function() {

			// 로그인 성공시, API를 호출합니다.
			Kakao.API.request( {
			  url : '/v1/api/story/linkinfo',
			  data : {
				url : 'https://youtu.be/1kRP0yqnA9o'
			  }
			}).then(function(res) {
			  // 이전 API 호출이 성공한 경우 다음 API를 호출합니다.
			  return Kakao.API.request( {
				url : '/v1/api/story/post/link',
				data : {
				  link_info : res,
					  content:"여기에 작성하심됩니다."
				}
			  });
			}).then(function(res) {
			  return Kakao.API.request( {
				url : '/v1/api/story/mystory',
				data : { id : res.id }
			  });
			}).then(function(res) {
				confirm('공유됐어요');
			}, function (err) {
			  alert(JSON.stringify(err));
			});

		  },
		  fail: function(err) {
			alert(JSON.stringify(err))
	 
			},
		});
	 
	}

}

function m_chk_input()
{
	var mb_name	= $('#mb_name').val();
	var mb_phone1	= $('#mb_phone1').val();
	var mb_phone2	= $('#mb_phone2').val();
	var mb_phone3	= $('#mb_phone3').val();
	var mb_addr		= $('#mb_addr').val();

	if (mb_name == "")
	{

		alert('개인정보 입력을 안 하셨습니다');
		setTimeout("ins_data();",500);

		$("#mb_name").focus();
		//$("#input_alert").show();
		return false;
	}

	if (mb_phone2 == "" || mb_phone2.length <3)
	{
		alert('개인정보 입력을 안 하셨습니다');
		setTimeout("ins_data();",500);
		$("#mb_phone2").focus();
		return false;
	}
	

	if (mb_phone3 == "" || mb_phone3.length<4)
	{
		alert('개인정보 입력을 안 하셨습니다');
		setTimeout("ins_data();",500);
		$("#mb_phone3").focus();
		return false;
	}

	if (mb_addr == "")
	{
		alert('주소를 잘못 입력 하셨습니다.');
		setTimeout("ins_data();",500);
		$("#mb_addr").focus();
		return false;
	}

	if ($('#privacy_agree').is(":checked") == false)
	{
		alert("개인정보 활용 동의를 안 하셨습니다");
		setTimeout("agree_data();",500);
		return false;
	}

	if ($('#clause_agree').is(":checked") == false)
	{
		alert("개인정보 활용 동의를 안 하셨습니다");
		setTimeout("agree_data();",500);
		return false;
	}
	$.ajax({
		type:"POST",
		data:{
			"exec"				: "insert_event",
			"mb_name"			: mb_name,
			"mb_phone1"		    : mb_phone1,
			"mb_phone2"		    : mb_phone2,
			"mb_phone3"		    : mb_phone3,
			"shop"				: shop
		},
		url: "../main_exec.php",
		success: function(response){
			if (response == "Y")
			{
				//alert("참여해주셔서 감사합니다.\n당첨시 3월 19일에 모바일쿠폰을 보내드립니다.\n미당첨시 따로 메시지를 보내드리지 않습니다.");
				//$.magnificPopup.close();

				setTimeout("ok_data();",1000);

			}
			else if (response == "D")
			{
				alert("이미 이벤트에 응모하셨습니다.\n다음에 다시 참여해 주세요.");
				if (iPhoneYN == "Y")
				{
					location.href="index.php";
				}else{
					window.close();
				}
			}
			else
			{
				alert("이벤트 참여자 수가 많아 참여가 지연되고 있습니다.\n다시 응모해 주시기 바랍니다.");
				if (iPhoneYN == "Y")
				{
					location.href="index.php";
				}else{
					window.close();
				}
			}
		}
	});
}

function chk_input()
{
	var mb_name	= $('#mb_name').val();
	var mb_phone1	= $('#mb_phone1').val();
	var mb_phone2	= $('#mb_phone2').val();
	var mb_phone3	= $('#mb_phone3').val();
	var mb_addr		= $('#mb_addr').val();

	if (mb_name == "")
	{

		alert('개인정보 입력을 안 하셨습니다');
		//setTimeout("ins_data();",500);

		$("#mb_name").focus();
		//$("#input_alert").show();
		return false;
	}

	if (mb_phone2 == "" || mb_phone2.length <3)
	{
		alert('개인정보 입력을 안 하셨습니다');
		//setTimeout("ins_data();",500);
		$("#mb_phone2").focus();
		return false;
	}
	

	if (mb_phone3 == "" || mb_phone3.length<4)
	{
		alert('개인정보 입력을 안 하셨습니다');
		//setTimeout("ins_data();",500);
		$("#mb_phone3").focus();
		return false;
	}

	if (mb_addr == "")
	{
		alert('주소 입력을 안하셨습니다.');
		//setTimeout("ins_data();",500);
		$("#mb_addr").focus();
		return false;
	}

	if ($('#use_agree').is(":checked") == false)
	{
		alert("개인정보 활용 동의를 안 하셨습니다");
		//setTimeout("agree_data();",500);
		return false;
	}

	if ($('#privacy_agree').is(":checked") == false)
	{
		alert("개인정보 활용 동의를 안 하셨습니다");
		//setTimeout("agree_data();",500);
		return false;
	}

	if ($('#adver_agree').is(":checked") == false)
	{
		alert("개인정보 활용 동의를 안 하셨습니다");
		//setTimeout("agree_data();",500);
		return false;
	}

	$.ajax({
		type:"POST",
		data:{
			"exec"				: "insert_event2",
			"mb_name"			: mb_name,
			"mb_phone1"		    : mb_phone1,
			"mb_phone2"		    : mb_phone2,
			"mb_phone3"		    : mb_phone3,
			"mb_addr"				: mb_addr
		},
		url: "../main_exec.php",
		success: function(response){
			if (response == "Y")
			{
				alert("참여해주셔서 감사합니다.");
				$.magnificPopup.close();

				//setTimeout("ok_data();",1000);

			}
			else if (response == "D")
			{
				alert("이미 이벤트에 응모하셨습니다.\n다음에 다시 참여해 주세요.");
				$.magnificPopup.close();
			}
			else
			{
				alert("이벤트 참여자 수가 많아 참여가 지연되고 있습니다.\n다시 응모해 주시기 바랍니다.");
				$.magnificPopup.close();
			}
		}
	});
}

function chk_radio(){
	var frm = document.all;
	var radio_temp = frm.chk_present.length;
	var chk_i=0
	for(var i=0; i<radio_temp; i++)
	{
		if(frm.chk_present[i].checked == true)
		{
			chk_i++;
			setTimeout("inputinfo_data();",500);
		} 
	} 
		if(chk_i<=0)
		{ 
			alert("하나를 선택하세요"); 
			
			return;
		} 
} 

function inputinfo_data()
{
	$.magnificPopup.open({
		items: {
			src: '#input_info'
		},
		type: 'inline',
		showCloseBtn : false
	}, 0);

}
