<?php 
if(!empty($update_it)){

if(($current_time-$row->timer) < 0.5){
	if($row->jail>=$current_time-1){
		if($row->jail-$current_time < 50){
		$update_it .= ", `jail`=`jail`+'5'";
		}
	}else{
		$update_it .= ", `jail`='$current_time'";
	}
	?><hr><b>Be careful you will get jailed if you are flooding the server!</b><hr><?php 

//print '<hr>Flood protection activated.<hr>';
}else{
	//$update_it .= ", `jail`='0'";
}

mysqli_query($link, "UPDATE `$tbl_members` SET $update_it WHERE `id`=$row->id LIMIT 1") or print(mysqli_error($link));

}
mysqli_close($link);
?>
<br><font size="1">� 1999-<?php print date("Y");?> Copyright of all contents are of their respective holders.<br><a href="https://thesilent.com/?open=privacy">Privacy</a>. <a href="https://thesilent.com/?open=terms">Terms</a>. <a href="https://thesilent.com/?open=rules">Rules</a>. <a href="https://thesilent.com/?open=feedback">Feedback</a>. <a href="guides.php">Guide</a>. Lol1 Version <?php print $version;?>. Parsed in <?php print substr((microtime_float()-$current_time),0 ,5);?> seconds.</font></center><?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.counter.php');
?></body></html>

<?php 

?>