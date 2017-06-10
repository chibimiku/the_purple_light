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

//首页的导航图标选中状态
$mypic = array(
	'home.png',
	'logo.png',
	'mail.png'
);

if(defined('INTRO')){
	$mypic[1] = 'logo_disabled.png';
}elseif(defined('STAFF')){
	$mypic[2] = 'mail_disabled.png';
}elseif(defined('INDEX')){
	$mypic[0] = 'home_disabled.png';
}

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="static/css/index.css?version=1.2" />
<script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="static/js/jquery.lazyload.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
</head>
<body>
<div id="header">
	<a href="/"><img src="static/image/logo.png" title="返回首页" /></a>
	<span id="nav">
		<a href="/index.php" title="首页"><img src="static/image/nav/<?php echo $mypic[0];?>" /></a>
		<a href="/about.php" title="公司简介"><img src="static/image/nav/<?php echo $mypic[1];?>" /></a>
		<a href="/staff.php" title="联系我们"><img src="static/image/nav/<?php echo $mypic[2];?>" /></a>
	</span>
</div>
