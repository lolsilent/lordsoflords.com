<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

if (!empty($_POST['action'])){

if ($_POST['action'] == 'Deposit' and $row->Gold >= 1) {

$row->Stash += $row->Gold;
$row->Gold=0;
$to_update .= ", `Gold`='0', `Stash`='$row->Stash'";
?>You have hidden all your gold.<?php 
} elseif ($_POST['action'] == 'Withdraw' and $row->Stash >= 1) {

$row->Gold += $row->Stash;
$row->Stash=0;
$to_update .= ", `Gold`='$row->Gold', `Stash`='0'";
?>Took out all your hidden gold!<?php 
}

}
?>
<table width=100% cellpadding=0 cellspacing=1 border=0><tr><th>Secret Gold Stash</th></tr><tr><td valign=top align=center>You can stash your Gold here to prevent it from losing it when you die.<p>You have <?php echo number_format($row->Stash); ?> Gold in your stash.<b></td></tr></table>

<form method=post><table width=100% cellpadding=0 cellspacing=1 border=0><tr><td width=50%><input type=submit name=action value="Deposit"></td><td width=50%><input type=submit name=action value="Withdraw"></td></tr></table></form>
<?php 
include_once $game_footer;
?>