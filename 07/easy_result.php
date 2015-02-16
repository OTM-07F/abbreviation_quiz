<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>略称クイズ(EASY)答え合わせ</title>
</head>
<body>
<h1></h1>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う

	$cls 	= new MySQL();
	$con	= $cls->mysqli_connect();
	
	if(!$con){
		exit('データベースに接続できませんでした。');
	}
	$result = mysqli_query($con,'SET NAMES utf8');
	if(!$result){
		exit('文字コードを指定できませんでした。');
	}

	echo "<p>問題1<br>\n";
	echo 