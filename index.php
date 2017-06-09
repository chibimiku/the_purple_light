<?php 

define('IN_PURPLE_LIGHT', true);

require ('header_common.inc.php');
require ('index_data.inc.php');
?>

<?php 

//load data from db.
$data = array();
for($i=0;$i<INDEX_ROW_NUM;$i++){
	$num = $i++; //从1开始计数
	$data[$num] = DB::query('SELECT * FROM index_list WHERE row='.$num.' ORDER BY order ASC');
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

//完成，后面draw_tr逐行画

//把单行数据转成每个td里面的内容
function make_index_arr($arr, $subdata = array()){
	$ret_td_arr = array();
	foreach($arr as $row){
		if($row['dirname'] !== 'null'){
			$addstr = '<td><div class="smallblock"><a class=\"smallblock_text">'.$row['chnname'].'</a><div class="dropdown-content">';
			if(!empty($subdata[$arr['id']])){
				foreach($subdata[$arr['id']] as $in_row){
					$addstr = $addstr."<p><a href=\"content.php?dataid=$in_row[dataid]\">$in_row[chnname]</a></p>";
				}
			}
			$addstr = $addstr.'</div></div></td>'; //收尾
			$ret_td_arr[] = $addstr;
		}else{
			$ret_td_arr[] = '<td colspan="'.$row['picsize'].'"><img src="'.$row['picurl'].'" /></td>';
		}
	}

}

//画table里的tr了
function draw_tr($arr, $trclass = '', $tdclass = ''){
	$returnstr = '<tr class="'.$tdclass.'">';
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
		<?php echo draw_tr(make_index_arr($data, $subdata))?>
	</tbody>
</table>
</div>
<div id="footer"></div>
</body>
</html>