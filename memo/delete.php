<? 
	session_start(); 
?>

<?
   // 데이터베이스 연결
   $connect = mysql_connect("localhost", "garam", "zz661225");
   
   // 데이터베이스 선택
   mysql_select_db("garam_db", $connect);


   $sql = "delete from verse where num = $_GET[num]";

   mysql_query($sql, $connect);

   mysql_close();

   echo "<script> alert('삭제되었습니다.');</script>";

   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

