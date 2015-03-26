<?
	// 유입매체 정보 입력
	function BC_InsertTrackingInfo($media, $gubun)
	{
		global $_gl;
		global $my_db;

		$query		= "INSERT INTO ".$_gl['tracking_info_table']."(tracking_media, tracking_refferer, tracking_ipaddr, tracking_date, tracking_gubun) values('".$media."','".$_SERVER['HTTP_REFERER']."','".$_SERVER['REMOTE_ADDR']."',now(),'".$gubun."')";
		$result		= mysqli_query($my_db, $query);
	}

	// 난수 생성
	function BC_SerialNumber()
	{
		/*
		srand(time());
		$time = substr(time(),5,5);//5번째문자에서5글자추출(0분터시작) 
		for($i=0;$i<3;$i++)//알파벳 3개 추출 
		{
		$asc=rand()%26+65;
		$c.=chr($asc);
		}
		$iparr = explode(".",$REMOTE_ADDR);
		//자신의ip뒤에3자리입력 
		$randcode=$c.$time.$iparr[3];
		*/
		$randcode = md5( mktime() . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] ); ;
		return $randcode; // 난수 생성
	}

	// 이벤트 참여여부 체크(phone)
	function BC_memberChk($phone)
	{
		global $_gl;
		global $my_db;

		$query			= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_phone='".$phone."'";
		$result			= mysqli_query($my_db, $query);
		$memberCnt	= mysqli_num_rows($result);

		return $memberCnt;
	}

	// 2차 이벤트 참여여부 체크(phone)
	function BC2_memberChk($phone)
	{
		global $_gl;
		global $my_db;

		$query			= "SELECT * FROM ".$_gl['member_info2_table']." WHERE mb_phone='".$phone."'";
		$result			= mysqli_query($my_db, $query);
		$memberCnt	= mysqli_num_rows($result);

		return $memberCnt;
	}
?>