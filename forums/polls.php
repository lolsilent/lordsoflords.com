<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);


$fields=0;
if(!empty($_POST['action'])){$action=clean_post($_POST['action']);$fields++;}else{$action='';}
if(!empty($_POST['radios'])){$radios=clean_post($_POST['radios']);$fields++;}else{$radios='';}
if(!empty($_POST['pid'])){$pid=clean_post($_POST['pid']);$fields++;}else{$pid='';}

if(!empty($_POST['question'])){$question=clean_post($_POST['question']);$fields++;}else{$question='';}
if(!empty($_POST['a'])){$a=clean_post($_POST['a']);$fields++;}else{$a='';}
if(!empty($_POST['b'])){$b=clean_post($_POST['b']);$fields++;}else{$b='';}
if(!empty($_POST['c'])){$c=clean_post($_POST['c']);$fields++;}else{$c='';}
if(!empty($_POST['d'])){$d=clean_post($_POST['d']);$fields++;}else{$d='';}
if(!empty($_POST['e'])){$e=clean_post($_POST['e']);$fields++;}else{$e='';}
if(!empty($_POST['see'])){$see=clean_post($_POST['see']);$fields++;}else{$see=1;}

if(!empty($row->last) and !empty($question) and !empty($a) and !empty($b)){
if($row->last <= $current_time-10){

if($action == 'Create poll' and $fields >= 5 and $a !== $b and $a !== $c and $a !== $d and $a !== $e){
$update_it .=", `last`='$current_time'";
mysqli_query($link, "INSERT INTO `$tbl_polls` ($fld_polls) values ('','$current_time','$row->sex','$row->charname','$see','$question','0','0','0','0','0','$a','$b','$c','$d','$e','')");
}

}
}

/*_______________-=TheSilenT.CoM=-_________________*/

//mysqli_query($link, "UPDATE $tbl_polls SET ip='' WHERE id LIMIT 5") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
$per_page=5;
$total_polls=0;
if (!empty($_GET['last_id'])) {$last_id=clean_post($_GET['last_id']);$where_id="id<='$last_id'";} else {$where_id='id';}

if($tpols=mysqli_query($link, "SELECT * FROM `$tbl_polls` WHERE ($where_id and `see`<='$row->level') ORDER BY `id` DESC LIMIT ".($per_page+$per_page)."")) {
if($total_polls = mysqli_num_rows($tpols)){mysqli_free_result ($tpols);}}

if($presult=mysqli_query($link, "SELECT * FROM `$tbl_polls` WHERE ($where_id and `see`<='$row->level') ORDER BY `id` DESC LIMIT $per_page")) {
?><table cellspacing=0 cellpadding=0 border=0 width=100%><tr><th colspan=2>Polls</th></tr><?php 
while ($prow=mysqli_fetch_object ($presult)) {

if($vres=mysqli_query($link, "SELECT * FROM `$tbl_votes` WHERE (`mid`='$row->id' and `pid`='$prow->id') ORDER BY id DESC LIMIT 1")) {
$voted=mysqli_num_rows($vres);mysqli_free_result ($vres);}else{$voted=0;}

if($prow->id == $pid and $action == 'Delete!' and $fields >= 2){
if($row->charname == $prow->charname or $row->level >= 4){
mysqli_query($link, "DELETE FROM `$tbl_polls` WHERE `id`=$prow->id LIMIT 1");$pid='';
mysqli_query($link, "DELETE FROM `$tbl_vote` WHERE `pid`=$prow->id LIMIT 10000");
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname deleted a poll id $prow->id by $prow->sex $prow->charname','$current_time')");
}
}else{
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}
print '<form method=post><input type=hidden name=pid value="'.$prow->id.'"><tr'.$bgcolor.'><td valign=top>'.$prow->question.'<br>Author <a href="profile.php?member='.$prow->charname.'">'.$prow->sex.' '.$prow->charname.'</a> <font size=-2>'.dater($prow->timer).' ago</font>';

if($prow->id == $pid and $action == 'Vote!' and $fields >= 3 and !empty($radios) and $voted <= 0){
if($radios == 'a1' or $radios == 'a2' or $radios == 'a3' or $radios == 'a4' or $radios == 'a5'){

mysqli_query($link, "INSERT INTO `$tbl_votes` values ('','$row->id','$prow->id')");
mysqli_query($link, "UPDATE `$tbl_polls` SET `$radios`=`$radios`+1,`ip`='$ip' WHERE `id`='$prow->id' LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
$voted=1;

$update_it .=", last='$current_time'";
$prow->$radios++;$prow->ip=$ip;
}
$radios='';$action='';
}
$total =$prow->a1+$prow->a2+$prow->a3+$prow->a4+$prow->a5;
print '<table width=100% cellspacing=1 cellpadding=0 border=0>'.
(!empty($prow->a)?'<tr'.$bgcolor.'><td>'.($voted <= 0?'<input type="radio" name="radios" value="a1">':'').$prow->a.'</td><td>'.$prow->a1.'</td><td width=35>'.($prow->a1>=1?round(($prow->a1/$total)*100,2):'0').'%</td></tr>':'').
(!empty($prow->b)?'<tr'.$bgcolor.'><td>'.($voted <= 0?'<input type="radio" name="radios" value="a2">':'').$prow->b.'</td><td>'.$prow->a2.'</td><td width=35>'.($prow->a2>=1?round(($prow->a2/$total)*100,2):'0').'%</td></tr>':'').
(!empty($prow->c)?'<tr'.$bgcolor.'><td>'.($voted <= 0?'<input type="radio" name="radios" value="a3">':'').$prow->c.'</td><td>'.$prow->a3.'</td><td width=35>'.($prow->a3>=1?round(($prow->a3/$total)*100,2):'0').'%</td></tr>':'').
(!empty($prow->d)?'<tr'.$bgcolor.'><td>'.($voted <= 0?'<input type="radio" name="radios" value="a4">':'').$prow->d.'</td><td>'.$prow->a4.'</td><td width=35>'.($prow->a4>=1?round(($prow->a4/$total)*100,2):'0').'%</td></tr>':'').
(!empty($prow->e)?'<tr'.$bgcolor.'><td>'.($voted <= 0?'<input type="radio" name="radios" value="a5">':'').$prow->e.'</td><td>'.$prow->a5.'</td><td width=35>'.($prow->a5>=1?round(($prow->a5/$total)*100,2):'0').'%</td></tr>':'').
'</table>';

print '<table cellspacing=0 cellpadding=0 border=0 width=100%><tr'.$bgcolor.'><td width=50%>'.($voted <= 0?'<input type=submit name=action value="Vote!"></td>':' </td>');

if ($row->charname == $prow->charname or $row->level >= 4){print '<td align=right><input type=submit name=action value="Delete!"></td>';}
print '</tr></table>';

print '</td></tr></form>';
$lastid=$prow->id-1;
}
}
mysqli_free_result ($presult);
if($total_polls > $per_page and !empty($lastid)){
?><tr><th colspan=2><?php print ' <a href="?last_id='.$lastid.'">Next</a>';?></th></tr><?php 
}
?></table><?php 
}


if($row->ev >= 1 and $row->mute <= 1){?><hr><form method=post><table width=100%><tr><th>Create a new poll!</th></tr>
<tr><td>Question<br><input type=text name=question maxlength=200 size=98></td></tr>
<tr><td>Choices, at least two like yes and no.</font><br><input type=text name=a maxlength=100 size=98><br><input type=text name=b maxlength=100 size=98><br><input type=text name=c maxlength=100 size=98><br><input type=text name=d maxlength=100 size=98><br><input type=text name=e maxlength=100 size=98></td></tr>
<tr><td>Visible to <select name=see><option value=1>Everybody</option><option value=2>Supports and higher</option><option value=3>Mods and higher</option><option value=4>Cops and higher</option><option value=5>Admins and higher</option></select></td></tr>
<tr><th><input type=submit name=action value="Create poll"></th></tr></table></form>
<?php 
}else{?><table width=100%><tr><th>You are not allowed to post or to vote here<br>Reasons can be you are muted or you haven't validated your email address.</th></tr></table><?php }
require_once($html_footer);?>