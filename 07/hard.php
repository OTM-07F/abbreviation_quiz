<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>略称クイズ(HARD)</title>
</head>
<body>
<h1></h1>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う
	require_once 'header.php';
	function shutudai($no){
		global $QUESTION;
		$cls 	= new MySQL();
		$con	= $cls->mysqli_connect();
		
		if(!$con){
			exit('データベースに接続できませんでした。');
		}
		$result = mysqli_query($con,'SET NAMES utf8');
		if(!$result){
			exit('文字コードを指定できませんでした。');
		}
		$query	= 'SELECT * FROM '.$QUESTION;
		$result = mysqli_query($con,$query);
		$row_cnt= mysqli_num_rows($result);	//行数を取得
		$random = mt_rand(1,$row_cnt);		//出題する問題の選択
		$ans	= $random;			//出題した問題番号を返却値にセット
		//問題の取得
		$query 	= 'SELECT * FROM '.$QUESTION.' WHERE num ='.$random;
		$result = mysqli_query($con,$query);
		$data 	= mysqli_fetch_array($result);
		$ans	= $data['num'];		//問題番号を返却値にセット
		echo '<p><h3>問題'.$no."</h3><br>\n";
		if(empty($data['name'])){
			echo '[No.'. $data['num'] . "]<br>\n";
		}else{
			echo '[No.'. $data['num'] . '] 出題者：' . htmlspecialchars($data['name'],ENT_QUOTES) . "<br>\n";
		}
		echo '<u>'.$data['ryakusho']."</u><br>\n";
		echo "<br>\n";
		echo '解答欄：<input type="text" name="write'.$no.'" size="20">'."\n";
		echo "<br>\n";
		$con 	= mysqli_close($con);
		if(!$con){
			exit('データベースとの接続を閉じられませんでした。');
		}
		return $ans;		//返り値は出題問題の番号を返す
	}
	echo "<form method='post' action='hard_result.php'>\n";
	echo "<div>\n";
	$a=shutudai(1);
	$b=shutudai(2);
	$c=shutudai(3);
	$d=shutudai(4);
	$e=shutudai(5);
	echo "</div>\n";
	echo '<input type="hidden" name="q1" value="'.$a.'">'."\n";	//回答した答えはhiddenで送る
	echo '<input type="hidden" name="q2" value="'.$b.'">'."\n";
	echo '<input type="hidden" name="q3" value="'.$c.'">'."\n";
	echo '<input type="hidden" name="q4" value="'.$d.'">'."\n";
	echo '<input type="hidden" name="q5" value="'.$e.'">'."\n";
	echo "<br><input type='submit' value='回答' />\n";
	echo "</form>\n";
?>
</body>
</html>