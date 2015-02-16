<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>略称クイズ(EASY)答え合わせ</title>
</head>
<body>
<h1></h1>
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
	
	//問１について
	$q1=getdata($_POST['q1num']);
	echo "<p>問題1<br>\n";
	if(empty($q1['name'])){
		echo '[No.'. $q1['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q1['num'] . '] 出題者：' . htmlspecialchars($q1['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q1['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが選んだ回答：".$_POST['choice1']."<br>\n";
	echo "正しい答え　　　　：".$q1['answer']."<br>\n";
	if($_POST['choice1']==$q1['answer']){
		echo "<strong>正解！</strong><br>\n";
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問２について
	$q2=getdata($_POST['q2num']);
	echo "<p>問題2<br>\n";
	if(empty($q2['name'])){
		echo '[No.'. $q2['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q2['num'] . '] 出題者：' . htmlspecialchars($q2['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q2['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが選んだ回答：".$_POST['choice2']."<br>\n";
	echo "正しい答え　　　　：".$q2['answer']."<br>\n";
	if($_POST['choice2']==$q2['answer']){
		echo "<strong>正解！</strong><br>\n";
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}

	//問３について
	$q3=getdata($_POST['q3num']);
	echo "<p>問題1<br>\n";
	if(empty($q3['name'])){
		echo '[No.'. $q3['num'] . "]<br>\n";
	}else{
		echo '[No.'. $q3['num'] . '] 出題者：' . htmlspecialchars($q3['name'],ENT_QUOTES) . "<br>\n";
	}
	echo $q1['ryakusho'] ."<br>\n";
	echo "<br>\n";
	echo "あなたが選んだ回答：".$_POST['choice3']."<br>\n";
	echo "正しい答え　　　　：".$q3['answer']."<br>\n";
	if($_POST['choice3']==$q3['answer']){
		echo "<strong>正解！</strong><br>\n";
	}else{
		echo "<strong>不正解</strong><br><br>\n";
	}
?>
	<a href="index.html">トップヘージへ戻る</a>
</body>
</html>