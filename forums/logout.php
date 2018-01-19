<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);

require_once($html_header);

if (!empty($_COOKIE)) {
	foreach ($_COOKIE as $key=>$val) {
		setcookie ($key, "", $current_time - (84600*60));
		print 'Cookie name '.$key.' with value '.$val.' has been deleted!<br>';
	}
}else{
	print 'No cookies have been found.<br>';
}

if (!empty($forum_sid)) {

$forum_sid=md5($current_time);
$update_it .=", sid='$forum_sid', session='0'";

$current_second = date("s");
	//print $current_second;
if($current_second >= 10 and $current_second <= 15 || $current_second >= 30 and $current_second <= 35 || $current_second >= 50 and $current_second <= 55){

$optimizer='';
$counted=count($table_names);
for ($i=0;$i < $counted;$i++){
$optimizer.="`$table_names[$i]`";
if($counted-1 !== $i){$optimizer.=',';}
}
mysqli_query($link, "OPTIMIZE TABLE $optimizer") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
}

print 'You have been successfully logged out.';
} else {
print 'You are already logged out.';
}

require_once($html_footer);
?>