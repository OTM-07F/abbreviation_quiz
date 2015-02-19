<?php 
//管理者ログイン処理 
function login($login) { 

	$loginstr="";

	//ログインモードの初期化 
	$_SESSION["adminlogin"] = "0";

	//ログイン名とパスワードが一致するか確認する
	if($login["loginname"] == LOGIN_NAME && md5($login["loginpassword"]) == LOGIN_PASSWD) {
 		$_SESSION["adminlogin"] = "1";
   		$loginstr = "管理者としてログインに成功しました。";
	}else{ 
		$_SESSION["adminlogin"] = "0";
		$loginstr = "ログイン名、パスワードが違います。";
	}
return $loginstr;
}

//セッションの開始
session_start();

//ログイン名とパスワードを保存 
define("LOGIN_NAME","root"); 
define("LOGIN_PASSWD","e4614ebc0ccee5c02dca712c9acc7f45");
//管理者のログイン処理を行う
if(isset($_POST["mode"]) and $_POST["mode"] == "login") {
    //ログイン関数を呼び出す
	$login_mes = login($_POST);
}else{
	$login_mes = "";
}

// HTMLを出力する
print <<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset=UTF-8">
<title>管理者ログイン</title>
</head>
<body>
<h1>管理者ログイン</h1>
<form action="login.php" method="post">
<dl>
	<dd><font color="#FF0000">$login_mes</font></dd>
</dl>
<dl>
	<dt><label for="name">ログイン名</label></dt>
	<dd><input type="text" id="name" name="loginname" value=""></dd>
	<dt><label for="title">パスワード</label></dt> 
	<dd><input type="password" id="title" name="loginpassword"  value=""></dd>
</dl>
<input type="hidden" name="mode" value="login">
EOF;
if(isset($_SESSION["adminlogin"]) and $_SESSION["adminlogin"] == "1"){
	echo '<input type="submit" id="submit" value="ログアウト">';
}else{
	echo '<input type="submit" id="submit" value="ログイン">';
}
print <<<EOF
</form>
<a href="index.html">トップページへ戻る</a>
</body>
</html>
EOF;

?>