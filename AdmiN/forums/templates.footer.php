<?php 
if(!empty($update_it) and !empty($row->id)){
mysqli_query($link, "UPDATE $tbl_members SET $update_it WHERE `id`='$row->id' LIMIT 1");
}

mysqli_close($link);?>

</td></tr></table><hr size=1><font size=-2>&copy;<?php print date("Y");?> <a href="https://thesilent.com">theSilent.com</a> All rights reserved.<br><a href="https://thesilent.com/?open=privacy">Privacy</a> <a href="https://thesilent.com/?open=terms">Terms</a> <a href="https://thesilent.com/?open=rules">Rules</a> <a href="https://thesilent.com/?open=feedback">Feedback</a><br>Parsed in <?php print number_format(microtime_float()-$current_time,5);?> seconds</font><?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.counter.php');
?></body></html>