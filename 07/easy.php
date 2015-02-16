<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>略称クイズ(EASY)</title>
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
		//選択肢の並び替え
		$suretsu = range(0,3);
		shuffle($suretsu);
		for($i=0;$i<4;$i++){
			switch($suretsu[$i]){
				case 0:
					$str[$i]= $data['answer'];
					break;
				case 1:
					$str[$i]= $data['fake1'];
					break;
				case 2:
					$str[$i]= $data['fake2'];
					break;
				case 3:
					$str[$i]= $data['fake3'];
					break;
			}
		}
		//選択肢の表示
		echo '<p>問題'.$no."<br>\n";
		if(empty($data['name'])){
			echo '[No.'. $data['num'] . "]<br>\n";
		}else{
			echo '[No.'. $data['num'] . '] 出題者：' . htmlspecialchars($data['name'],ENT_QUOTES) . "<br>\n";
		}
		echo $data['ryakusho'] ."<br>\n";
		echo "<br>\n";
		echo '選択肢:<select name="choice'.$no.'">'."\n";
		for($i=0;$i<4;$i++){
			echo '<option value='.$str[$i].'>'.htmlspecialchars($str[$i],ENT_QUOTES)."</option>\n";
		}
		echo "</select></p>\n";
		$con = mysqli_close($con);
		if(!$con){
			exit('データベースとの接続を閉じられませんでした。');
		}
		return $ans;		//返り値は出題問題の番号を返す
	}
	echo '<form  action="easy_result.php" method="post">'."\n";
	$a=shutudai(1);
	$b=shutudai(2);
	$c=shutudai(3);
	echo '<input type="hidden" name="q1num" value="'.$a.'">'."\n";	//回答した答えはhiddenで送る
	echo '<input type="hidden" name="q2num" value="'.$b.'">'."\n";
	echo '<input type="hidden" name="q3num" value="'.$c.'">'."\n";
	echo "<br><input type='submit' value='回答' />\n";
	echo "</form>\n";
?>
</body>
</html>