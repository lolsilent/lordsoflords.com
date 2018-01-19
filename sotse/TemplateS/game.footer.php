<?php 
if(!empty($to_update)){

if(($current_time-$row->Time) < 0.5){
	if($row->Jail>=$current_time-1){
		if($row->Jail-$current_time < 50){
		$to_update .= ", `Jail`=`Jail`+'5'";
		}
	}else{
		$to_update .= ", `Jail`='$current_time'";
	}
	?><hr><b>Be careful you will get jailed if you are flooding the server!</b><hr><?php 

//print '<hr>Flood protection activated.<hr>';
}else{
	//$to_update .= ", `Jail`='0'";
}

mysqli_query($link, "UPDATE `$tbl_members` SET $to_update WHERE `id`='$row->id' LIMIT 1") or die("$error_message".mysqli_error($link));

}
mysqli_close ($link);
?>
<br><font size=1>� 1999-<?php echo date("Y");?> Copyright of all contents are of their respective holders. <br><a href="https://thesilent.com/?open=privacy">Privacy</a>. <a href="https://thesilent.com/?open=terms">Terms</a>. <a href="https://thesilent.com/?open=rules">Rules</a>. <a href="https://thesilent.com/?open=feedback">Feedback</a>. Lol Version <?php echo $version;?>.
Parsed in <b><?php echo substr((set_time()-$current_time), 0 ,6); ?></b> seconds.</font></body></html>