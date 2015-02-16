<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>略称クイズ(HARD)答え合わせ</title>
</head>
<body>
<h1>結果発表</h1>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う
	function getdata($no){
		$cls 	= new MySQL();
		$con	= $cls->mysqli_connect();
		
		if(!$con){
			exit('データベースに接続できませんでした。');
		}
		$result = mysqli_query($con,'SET NAMES utf8');
		if(!$result){
			exit('文字コードを指定できませんでした。');
		}
		//問題データをデータベースより読み込む
		$query 	= "SELECT * FROM question WHERE num =".$no;
		$result	= mysqli_query($con,$query);
		$data 	= mysqli_fetch_array($result);
		$con = mysqli_close($con);
		if(!$con){
			exit('データベースとの接続を閉じられませんでした。');
		}
		return $data;	//問題データを返却する
	}
	
	echo "<div>\n";
	$seikai = 0;	//正解数
	//問１について
	$q1=getdata($_POST['q1']);
	echo "<p><h3>問題1</h3><br>\n";
	if(empty($q1['name'])){
		echo '[No.'. $q1['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q1['num'] . '] 出題者：' . htmlspecialchars($q1['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q1['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが入力した回答：".$_POST['write1']."<br>\n";
	echo "正しい答え　　　　　：".htmlspecialchars($q1['answer'],ENT_QUOTES)."<br>\n";
	if(strcasecmp($_POST['write1'],$q1['answer'])==0){
		echo "<strong>正解！</strong><br>\n";
		$seikai	= $seikai+1;	//正解数カウント
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問２について
	$q2=getdata($_POST['q2']);
	echo "<p><h3>問題2</h3><br>\n";
	if(empty($q2['name'])){
		echo '[No.'. $q2['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q2['num'] . '] 出題者：' . htmlspecialchars($q2['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q2['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが入力した回答：".$_POST['write2']."<br>\n";
	echo "正しい答え　　　　　：".htmlspecialchars($q2['answer'],ENT_QUOTES)."<br>\n";
	if(strcasecmp($_POST['write2'],$q2['answer'])==0){
		echo "<strong>正解！</strong><br>\n";
		$seikai = $seikai+1;	//正解数カウント
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問３について
	$q3=getdata($_POST['q3']);
	echo "<p><h3>問題3</h3><br>\n";
	if(empty($q3['name'])){
		echo '[No.'. $q3['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q3['num'] . '] 出題者：' . htmlspecialchars($q3['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q3['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが入力した回答：".$_POST['write3']."<br>\n";
	echo "正しい答え　　　　　：".htmlspecialchars($q3['answer'],ENT_QUOTES)."<br>\n";
	if(strcasecmp($_POST['write3'],$q3['answer'])==0){
		echo "<strong>正解！</strong><br>\n";
		$seikai = $seikai+1;	//正解数カウント
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問４について
	$q4=getdata($_POST['q4']);
	echo "<p><h3>問題4</h3><br>\n";
	if(empty($q4['name'])){
		echo '[No.'. $q4['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q4['num'] . '] 出題者：' . htmlspecialchars($q4['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q4['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが入力した回答：".$_POST['write4']."<br>\n";
	echo "正しい答え　　　　　：".htmlspecialchars($q4['answer'],ENT_QUOTES)."<br>\n";
	if(strcasecmp($_POST['write4'],$q4['answer'])==0){
		echo "<strong>正解！</strong><br>\n";
		$seikai = $seikai+1;	//正解数カウント
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問５について
	$q5=getdata($_POST['q5']);
	echo "<p><h3>問題5</h3><br>\n";
	if(empty($q5['name'])){
		echo '[No.'. $q5['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q5['num'] . '] 出題者：' . htmlspecialchars($q5['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q5['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが入力した回答：".$_POST['write5']."<br>\n";
	echo "正しい答え　　　　　：".htmlspecialchars($q5['answer'],ENT_QUOTES)."<br>\n";
	if(strcasecmp($_POST['write5'],$q5['answer'])==0){
		echo "<strong>正解！</strong><br>\n";
		$seikai = $seikai+1;	//正解数カウント
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}
	echo "</div>\n";


	//結果について	
	echo "<br><br>\n";
	echo "成績　　　　　　　：".$seikai."/5<br>\n";
	switch($seikai){
		case 0:
			echo "全問不正解。もっと頑張りましょう。<br>\n";
			break;
		case 1:
			echo "もう少し頑張って。<br>\n";
			break;
		case 2:
			echo "もう少し頑張って。<br>\n";
			break;
		case 3:
			echo "次は全問正解を目指しましょう。<br>\n";
			break;
		case 4:
			echo "次は全問正解を目指しましょう。<br>\n";
			break;
		case 5:
			echo '全問正解おめでとう！その知識を活かして<a href="post_from.html">問題投稿</a>お願いします'."<br>\n";
			break;
	}
?>
	<a href="index.html">トップヘージへ戻る</a>
</body>
</html>