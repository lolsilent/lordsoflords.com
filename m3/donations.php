<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
include_once($html_header);

$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

if($tpresult=mysqli_query($link, "SELECT * FROM `$tbl_paypal` WHERE `id` ORDER BY `amount` DESC LIMIT 10000")){
$numrows=mysqli_num_rows($tpresult);
if($numrows >= 1){?><table>
<tr><th colspan="3">All time hall of fame Donated Dominator's</th></tr><?php 

$donators=array();
while($tpobj=mysqli_fetch_object($tpresult)){

if(!array_key_exists($tpobj->ip,$donators)){
$donators[$tpobj->ip] = $tpobj->amount;
}else{
$donators[$tpobj->ip] += $tpobj->amount;
}

}
mysqli_free_result($tpresult);

arsort($donators);
$amount=array_sum($donators);

$i=0;$topa=0;
foreach ($donators as $key=>$val){
	$i++;
	$topa += $val;
echo '<tr'; if(empty($bg)){?> bgcolor="<?php print $col_th;$bg=1;?>"<?php }else{$bg='';}echo '><td>Player '.$i.'</td><td>$'.number_format($val,2).'</td><td>'.number_format(($val/$amount)*100,2).'%</tr>';
if ($i == 10) {break;}
}

echo '<tr'; if(empty($bg)){?> bgcolor="<?php print $col_th;$bg=1;?>"<?php }else{$bg='';}echo '><td>The other '.number_format(count($donators)-$i).' donated players</td><td>$'.number_format($amount-$topa,2).'</td><td>'.number_format((($amount-$topa)/$amount)*100,2).'%</tr>';

?><tr><th colspan="3">A totality of <?php print number_format($numrows);?> donations where made by <?php print count($donators);?> players with a total sum of $<?php print number_format($amount,2);?>.</th></tr>
<tr><th colspan="3">The economy on this server is $<?php print number_format($amount/((date("Y")-2001)*360),2);?> average turnover per day.</th></tr>
</table><?php 

}}

mysqli_close($link);
include_once($html_footer);
?>