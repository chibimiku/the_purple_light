<?php 

define('IN_PURPLE_LIGHT', true);

//load library
require ('lib/meekrodb.2.3.class.php');

//load config
require ('conf/config.inc.php');

require ('header_common.inc.php');
require ('index_data.inc.php');
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
		<?php echo show_data_table($index_data)?>
	</tbody>
</table>
</div>
<div id="footer"></div>
</body>
</html>