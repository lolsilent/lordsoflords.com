<?php 
#!/usr/local/bin/php

/*_______________-=TheSilenT.CoM=-_________________*/
function html_header($title,$titleb,$description,$keywords,$css,$favicon,$body) {
print '<html><head><title>'.$title.(!empty($titleb)?' '.$titleb:'').'</title>'.(!empty($description)?'<meta name="description" content="'.$description.'">':'').(!empty($keywords)?'<meta name="keywords" content="'.$keywords.'">':'').'<link rel="stylesheet" type="text/css" href="/script.php?'.$css.'">'.(!empty($favicon)?'<link rel="shortcut icon" path="/favicon.ico">':'').'</head><body>'.$body;
}
/*_______________-=TheSilenT.CoM=-_________________*/

function html_nav($menu) {
	//array or single link
if (is_array($menu)) {
	foreach ($menu as $val) {
		print '<a href="'.$val.'.php">'.ucfirst($val).'</a><br>';
	}
}else{
	print '<a href="'.$menu.'.php">'.ucfirst($menu).'</a><br>';
}
}

/*_______________-=TheSilenT.CoM=-_________________*/
?>