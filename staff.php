<?php 

define('IN_PURPLE_LIGHT', true);
define('STAFF', true);
require ('header_common.inc.php');

//load data from dd

$staffdata = DB::query('SELECT * FROM staff ORDER BY `order`');

?>

<div id="wrap">
	<div id="staff_above"></div>
	<?php 
		foreach($staffdata as $row){
			echo '<div class="staff"><img src="static/image/staff/'.$row['pic'].'" /><div class="intro"><span class="nm">'.$row['name'].'</span><span>'.$row['introduce'].'</span></div><div class="clear"></div></div>';
		}?>
</div>

<?php 

require ('footer_common.inc.php');

?>

