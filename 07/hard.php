<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>略称クイズ(HARD)</title>
</head>
<body>
<h1></h1>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う

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
		$row_cnt= mysqli_num_rows($result);	//行数を取得
		$random = mt_rand(1,$row_cnt);		//出題する問題の選択
		$ans	= $random;			//出題した問題番号を返却値にセット
		//問題の取得
		$query 	= 'SELECT * FROM question WHERE num ='.$random;
		$result = mysqli_query($con,$query);
		$data 	= mysqli_fetch_array($result);
		$ans	= $data['num'];		//問題番号を返却値にセット
		echo '<p>問題'.$no."<br>\n";
		if(empty($data['name'])){
			echo '[No.'. $data['num'] . "]<br>\n";
		}else{
			echo '[No.'. $data['num'] . '] 出題者：' . htmlspecialchars($data['name'],ENT_QUOTES) . "<br>\n";
		}
		echo $data['ryakusho']."<br>\n";
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
	$a=shutudai(1);
	$b=shutudai(2);
	$c=shutudai(3);
	echo '<input type="hidden" name="q1" value="'.$a.'">'."\n";	//回答した答えはhiddenで送る
	echo '<input type="hidden" name="q2" value="'.$b.'">'."\n";
	echo '<input type="hidden" name="q3" value="'.$c.'">'."\n";
	echo "<br><input type='submit' value='回答' />\n";
	echo "</form>\n";
?>
</body>
</html>