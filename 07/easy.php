<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>略称クイズ(EASY)</title>
</head>
<body>
<h1></h1>
<?php
	require_once '../lib/MySQL.php';

	function shutudai($no){
		$cls 	= new MySQL();
		$con	= $cls->mysqli_connect();
		
		if(!$con){
			exit('データベースに接続できませんでした。');
		}
		$result = mysqli_query($con,'SET NAMES utf8');
		if(!$result){
			exit('文字コードを指定できませんでした。');
		}
		
		$result = mysqli_query($con,'SELECT * FROM question');
		$row_cnt= mysqli_num_rows($result);
		$random = rand(1,$row_cnt);
		$query 	= 'SELECT * FROM question WHERE num ='.$random;
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_array($result);
		echo "<p>\n";
		echo '[No.'. $data['num'] . ']' . htmlspecialchars($data['name'],ENT_QUOTES) . "<br>\n";
		echo $data['ryakusho'] ."<br>\n";
		echo "<br>\n";
		echo "選択肢:<select name='choice'".$no."><option value=1>".htmlspecialchars($data['answer'],ENT_QUOTES)."</option>\n";
		echo "<option value=2>".htmlspecialchars($data['fake1'],ENT_QUOTES)."</option>\n";
		echo "<option value=3>".htmlspecialchars($data['fake2'],ENT_QUOTES)."</option>\n";
		echo "<option value=4>".htmlspecialchars($data['fake3'],ENT_QUOTES)."</option>\n";
		echo "</select></p>\n";
		$con = mysqli_close($con);
		if(!$con){
			exit('データベースとの接続を閉じられませんでした。');
		}		
	}
	shutudai(1);

?>
</body>
</html>