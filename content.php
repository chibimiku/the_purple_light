<?php 


define('IN_PURPLE_LIGHT', true);
require ('header_common.inc.php');

?>

<div id="wrap">

<?php 

define('IMGDIR', 'static/image/contents/');

//check input


//example here.

$cata = '博览会';
$title = '创新创业博览会';

//读取数据
$dataid = intval($_GET['dataid']);
if(!$dataid){
	showmessage("错误的dataid");
}

$info = DB::queryFirstRow('SELECT * FROM index_catalist WHERE dataid='.$dataid);
if(!$info){
	showmessage("错误，不正确的id");
}

$masterinfo = DB::queryFirstRow('SELECT * FROM index_list WHERE id='.$info['indexid']);

//load data from dir. 
$title = $masterinfo['chnname'];
$subtitle = $info['chnname'];
$datadir = dirname(__FILE__).'/static/image/contents/'.$masterinfo['dirname'].'/'.$info['dirname'].'/'; 

?>
<!--crumb-->
<p><a href="/">首页</a><span>&gt;&gt; </span><b><?php echo $title;?></b><span>&gt;&gt; </span><b><?php echo $subtitle;?></b></p>

<?php
$files = list_file_sp($datadir, '',true);
$imgarr = array();
foreach($files as $key => $value){
	$imgarr[$key] = IMGDIR.$masterinfo['dirname'].'/'.$info['dirname'].'/'.$value;
}
//var_dump($imgarr);
foreach($imgarr as $imgname => $imgurl){
	echo '<img class="content_img" src="'.$imgurl.'" title="'.$imgname.'" /><br />';
}

function proc_input($str){
	return str_ireplace(array('/','.','\'','"'),array('','','',''),trim($str));
}

/* 
*   递归获取指定路径下的所有文件或匹配指定正则的文件（不包括“.”和“..”），结果以数组形式返回 
*   @param  string  $dir 
*   @param  string  [$pattern] 
*   @return array 
*/  
function list_file_sp($dir,$pattern="", $convert = false){
	//这里只返回文件名
    $arr = array();
	if($convert){
		$dir = mb_convert_encoding ($dir,'gbk','utf-8');
	}
    $dir_handle = opendir($dir);
    if($dir_handle){  
        // 这里必须严格比较，因为返回的文件名可能是“0”  
        while(($file=readdir($dir_handle))!==false){  
            if($file==='.' || $file==='..'){  
                continue;  
            }  
            if(!is_dir($file)){
				if($convert){
					$file = mb_convert_encoding($file, 'utf-8', 'gbk');    //因为网站用的utf8，所以这里需要重新再给他编制回去
				}
				$arr[$file] = urlencode($file); 
			}
        }  
        closedir($dir_handle);  
    }  
    return $arr;  
}  

?>



</div>

<div id="footer"></div>
</body>
</html>