<?
	$scale=5;			// 한 화면에 표시되는 글 수
	// 데이터베이스 연결
    $connect = mysql_connect("localhost", "garam", "zz661225");
   
    // 데이터베이스 선택
    mysql_select_db("garam_db", $connect);
   
	$sql = "select * from verse order by num desc";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
	$page = $_GET[page];
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;
	$number = $total_record - $start;
?>
<html>
<head> 
<style>
   body { padding : 0 250px 0 180px }
   #box { padding : 5px;
		  border-width: thin;
		  border-color : black;
		  border-style : inset; }
	a { text-decoration : none;
		color : black; }
</style>
</head>
<body>
<div id="content">  
	<div id = "title">
		<h3>MEMO</h3>
	</div>
       	<form  name="verse_form" method="post" action="insert.php"> 
		   	이름 ->&nbsp;&nbsp; <input type = "text" size = "20" name="memoname" /> <br/><br/>
			<textarea rows="8" cols="70" name = "content"></textarea>
			<br/><br/><span align="right"><input type="submit" value = "저장"></span>
		</form>	
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      $row = mysql_fetch_array($result);       
		  
	  $verse_num     = $row[num];
	  $verse_content = $row[content];
	  $verse_name = $row[name];
      $verse_date    = $row[regist_day];
	  $verse_content = str_replace("\n", "<br>", $row[content]);
	  $verse_content = str_replace(" ", "&nbsp;", $verse_content);
?>
<div id="verse_writer_title">
	<table border=0>
		<tr><th id="box"><?= $number ?></th><td>&nbsp;&nbsp;||&nbsp;&nbsp;</td>
		    <th><?= $verse_name ?></th><td>&nbsp;&nbsp;||&nbsp;&nbsp;</td>
		    <th><?= $verse_date ?></th><td>&nbsp;&nbsp;||&nbsp;&nbsp;</td>
		<th>
		      <? 
					if($userid=="admin" || $userid==$verse_id)
			          echo "<a href='delete.php?num=$verse_num'>[삭제]</a>"; 
			  ?>
		</th></tr>
		<tr><td colspan = "7"><?= $verse_content ?></td></tr>
	</table>
</div>
<br/><br/>
<?
		$number--;
	 }
	 mysql_close();
?>
			<div align = "center">
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
			echo "<a href='memo.php?page=$i'> $i </a>";
		}      
   }
?>			
			</div>
		 
	</div>
 </div>
</body>
</html>

