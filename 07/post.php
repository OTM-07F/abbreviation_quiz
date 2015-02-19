<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>略称クイズ 問題投稿ページ</title>
</head>
<body>
<div>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う
	require_once 'header.php';
	
	global $POSTED;

	$cls 	= new MySQL();
	$con	= $cls->mysqli_connect();
	
	if(!$con){
		exit('データベースに接続できませんでした。');
	}
	$result = mysqli_query($con,'SET NAMES utf8');
	if(!$result){
			exit('文字コードを指定できませんでした。');
	}
	
	$query 	= 'INSERT INTO '$POSTED."(ryakusho,answer,fake1,fake2,fake3,name) VALUES('".$_POST['ryakusho']."','".$_POST['answer']."','".$_POST['fake1']."','".$_POST['fake2']."','".$_POST['fake3']."','".$_POST['name']."')";
	$result	= mysqli_query($con,$query);
	if (!$result) {
    		exit('データベースへの登録に失敗しました。');
	}else{
		echo "問題データの仮登録が完了しました。管理人が承認すると出題候補に加わります。<br>\n";
		echo "ご協力ありがとうございました。<br><br>\n";
		echo '<a href="index.html">トップヘージへ戻る</a><br>'."\n";
	}
	$con = mysqli_close($con);
	if(!$con){
		exit('データベースとの接続を閉じられませんでした。');
	}
?>
</div>
</body>
</html>
