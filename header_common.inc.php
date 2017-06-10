<?php 

if(!defined('IN_PURPLE_LIGHT')){
	exit('Access denied');
}


//load library
require ('lib/meekrodb.2.3.class.php');

//load config
require ('conf/config.inc.php');

function showmessage($msg){
	//粗略的处理错误信息，yeah。
	exit($msg);
}

$debug = false;
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="static/css/index.css" />
<script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="header">
	<a href="/"><img src="static/image/logo.png" title="返回首页" /></a>
	<span id="nav">
		<a href="/index.php"><img src="static/image/nav/home.png" /></a>
		<a href=""><img src="static/image/nav/logo.png" /></a>
		<a href=""><img src="static/image/nav/mail.png" /></a>
	</span>
</div>
