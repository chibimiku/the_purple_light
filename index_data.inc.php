<?php 

/*
//首页显示的数据list。
//格式为两层array组织
//标记图片的方式为前面的key里带pic_，例如写pic_big，会显示图片.

*/

$index_data = array(
	array(
		'公司简介' => array(),
		'博览会' => array('创新创业博览会', '青洽展', '养老服务业博览会'),
		'pic_big' => array('size' => 2 , 'url' => 'static/testimage/index_2pic.png'),
	),
	array(
		'pic_1' => array('size' => 1, 'url' => 'static/testimage/index_1pic.png'),
		'大型活动' => array(),
		'pic_2' => array('size' => 1, 'url' => 'static/testimage/index_1pic.png'),
		'展示工程' => array(),
	),
	array(
		'论坛会议' => array(),
		'pic_big' => array('size' => 2 , 'url' => 'static/testimage/index_2pic.png'),
		'媒体发布' => array(),
	),
	array(
		'数字媒体' => array(),
		'pic_1' => array('size' => 1, 'url' => 'static/testimage/index_1pic.png'),
		'项目合作' => array(),
		'创意设计' => array(),
	),
);

//定义显示数据的方法

function show_data_table($arr){
	//图片固定标记
	$pic_sign = 'pic_';
	$returnstr = '';
	foreach($arr as $s_arr){
		$returnstr = $returnstr.'<tr>';
		foreach($s_arr as $s_key => $s_value){
			if(strpos($s_key, $pic_sign) !== false){
				//检查一下必须项
				if(!isset($s_value['url']) || !isset($s_value['size'])){
					continue;
				}
				$returnstr = $returnstr.'<td colspan="'.$s_value['size'].'"><img src="'.$s_value['url'].'" /></td>';
			}else{
				if(!is_array($s_value)){
					continue;//容错防止不是array的数据
				}
				$returnstr = $returnstr.'<td><div class="smallblock"><a class="smallblock_text">'.$s_key.'</a>';
				//加入子菜单数据
				$returnstr = $returnstr.'<div class="dropdown-content">';
				foreach($s_value as $in_key => $in_value){
					$returnstr = $returnstr."<p><a href=\"content.php?title=$s_key&subtitle=$in_value\">$in_value</a></p>";
				}
				$returnstr = $returnstr.'</div></div></td>'; //收尾
			}
		}
		$returnstr = $returnstr.'</tr>';
	}
	return $returnstr;
}

?>