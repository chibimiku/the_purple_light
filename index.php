<?php 

define('IN_PURPLE_LIGHT', true);
define('INDEX', true);

require ('header_common.inc.php');
require ('index_data.inc.php');
?>

<?php 

//debug switch
if(isset($_GET['debug'])){
	$debug = true;
}

//load data from db.
$data = array();
for($i=0;$i<INDEX_ROW_NUM;$i++){
	$num = $i+1; //从1开始计数
	$data[$num] = DB::query('SELECT * FROM index_list WHERE row='.$num.' ORDER BY `order` ASC');
}

if($debug){
	var_dump($data);
}

//构造子索引$subdata
$subdata = array();
$query = DB::query('SELECT * FROM index_catalist');
foreach($query as $row){
	if(!isset($subdata[$row['indexid']])){
		$subdata[$row['indexid']] = array();
	}
	$subdata[$row['indexid']][] = $row;
}
unset($query);

if($debug){
	//var_dump($subdata);
}

//完成，后面draw_tr逐行画

//把单行数据转成每个td里面的内容
function make_index_arr($arr, $subdata = array()){
	$ret_td_arr = array();
	foreach($arr as $row){
		if($row['picsize'] == 0){
			$addstr = '<td><div class="smallblock"><a class="smallblock_text">'.$row['chnname'].'</a><div class="dropdown-content">';
			if(!empty($subdata[$row['id']])){
				foreach($subdata[$row['id']] as $in_row){
					$addstr = $addstr."<p><a href=\"content.php?dataid=$in_row[dataid]\">$in_row[chnname]</a></p>";
				}
			}
			$addstr = $addstr.'</div></div></td>'; //收尾
			$ret_td_arr[] = $addstr;
		}else{
			$ret_td_arr[] = '<td colspan="'.$row['picsize'].'"><img class="front_image" src="'.$row['picurl'].'" /></td>';
		}
	}
	return $ret_td_arr;
}

//画table里的tr了
function draw_tr($arr, $trclass = ''){
	$returnstr = '<tr class="'.$trclass.'">';
	foreach($arr as $value){
		$returnstr = $returnstr.$value;
	}
	$returnstr = $returnstr.'</tr>';
	return $returnstr;
}

?>

<div id="wrap">
<script>
$(document).ready(function() {
    $(".smallblock").hover(
        function() {
            $(this).children(".dropdown-content").slideDown('medium');
        },
        function() {
            $(this).children(".dropdown-content").slideUp('medium');
        }
    );
});
</script>
<table cellspacing="18">
	<tbody>
		<?php 
		foreach($data as $datarow){
			echo draw_tr(make_index_arr($datarow, $subdata));
		}
		?>
	</tbody>
</table>
</div>
<div id="footer"></div>
</body>
</html>