<? session_start(); ?>

<?
	if(!$_POST[memoname]) {
		echo("
		<script>
	     window.alert('이름을 입력하세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	if(!$_POST[content]) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   // 데이터베이스 연결
   $connect = mysql_connect("localhost", "garam", "zz661225");
   
   // 데이터베이스 선택
   mysql_select_db("garam_db", $connect);


	$sql = "insert into verse ( name, content, regist_day) ";
	$sql .= "values('$_POST[memoname]', '$_POST[content]', '$regist_day')";

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	
	echo "<script> alert('저장되었습니다.');</script>";

	mysql_close();                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

  
