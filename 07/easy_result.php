<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>���̃N�C�Y(EASY)�������킹</title>
</head>
<body>
<h1></h1>
<?php
	require_once '../lib/MySQL.php';		//�ڑ��͋��ʂ̃N���X���g��

	$cls 	= new MySQL();
	$con	= $cls->mysqli_connect();
	
	if(!$con){
		exit('�f�[�^�x�[�X�ɐڑ��ł��܂���ł����B');
	}
	$result = mysqli_query($con,'SET NAMES utf8');
	if(!$result){
		exit('�����R�[�h���w��ł��܂���ł����B');
	}

	echo "<p>���1<br>\n";
	echo 