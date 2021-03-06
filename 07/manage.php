<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>略称クイズ 管理ページ</title>
</head>
<body>
<h1>管理ページ</h1>
<p>ここで投稿された問題の承認を行います。問題として成立していない場合などは非承認してください。</p>
<?php
	require_once '../lib/MySQL.php';		//接続は共通のクラスを使う
	require_once 'header.php';
	
	global $QUESTION;
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

	//承認処理
	if(isset($_POST['key']) and $_POST['key'] == 'utz'){
		if(isset($_GET['num']) and isset($_POST['certify'])){
			if($_POST['certify'] == '承認'){
				$query	= 'SELECT * FROM '.$POSTED.' WHERE num ='.$_GET['num'];
				$result	= mysqli_query($con,$query);
				$data 	= mysqli_fetch_array($result);
				$query	= 'INSERT INTO '.$QUESTION."(ryakusho,answer,fake1,fake2,fake3,name) VALUES('".$data['ryakusho']."','".$data['answer']."','".$data['fake1']."','".$data['fake2']."','".$data['fake3']."','".$data['name']."')";
				$result	= mysqli_query($con,$query);
				if (!$result) {
	    				exit('データベースへの登録に失敗しました。');
				}else{
					echo "問題データの登録が完了しました。<br>\n";
				}
			}
			else if($_POST['certify'] == '非承認'){
				echo "問題を非承認とし、データベース上から削除しました。<br>\n";
			}
			$query	= 'DELETE FROM '.$POSTED.' WHERE num = '.$_GET['num'];
			$result	= mysqli_query($con,$query);
			if (!$result) {
	    			exit('データベースからの削除に失敗しました。');
			}
		}
	}else if(isset($_POST['key'])){
		echo "パスワードが違います。<br>\n";
	}

	//投稿された問題とその承認フォーム
	$query	= 'SELECT * FROM '.$POSTED;
	$result	= mysqli_query($con,$query);
	echo "<div>\n";
	while ($data = mysqli_fetch_array($result)) {
		if(empty($data['name'])){
			echo '[No.'. $data['num'] . "] 無記名<br>\n";
		}else{
			echo '[No.'. $data['num'] . '] 出題者：' . htmlspecialchars($data['name'],ENT_QUOTES) . "<br>\n";
		}
		echo '問題とする略称：'.$data['ryakusho'] ."<br>\n";
		echo "<br>\n";
		echo 'その問題の正答：'.$data['answer']."<br>\n";
		echo 'フェイク候補１：'.$data['fake1']."<br>\n";
		echo 'フェイク候補２：'.$data['fake2']."<br>\n";
		echo 'フェイク候補３：'.$data['fake3']."<br>\n";
		echo '<form action="manage.php?num='.$data['num'].'" method="post">'."<br>\n";
		echo 'パスワード　　：<input type="password" name="key">'."\n";
		echo '<input type="submit" name="certify" value="承認">　<input type="submit" name="certify" value="非承認">'."<br>\n";
		
	}
	echo "</div>\n";
	$con = mysqli_close($con);
	if(!$con){
		exit('データベースとの接続を閉じられませんでした。');
	}
?>
<br><br>
<a href="index.html">トップページへ戻る</a>
</body>
</html>