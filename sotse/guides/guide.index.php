<?php 
$whot_info = array(
'Main'		=> "Main overview of character.",
'Paper'		=> "This is a in game news paper, you can see latest gold or credits transfers, changes of noble titles and game administrator actions.",
'Deads'		=> "Results of recently fought duels.",
'Steals'		=> "Best thievery operations in the game is listed here.",
'Graves'		=> "To be burried your char must be Level 100 or above. How to get burried? Die allot, everything on your char is stolen or don't login to your char for a long period of time days.",
'Matches'		=> "Tournaments and battle information, click on a tournament fight to see guild stats and other information.",


'Guild'		=> "To join or create a Guild you be Level 1.000 or over it. Once you have created a Guild you automaticly join your own Guild, a password is required for other players to join your guild.
When you are the leader you may remove members and kick guild members when you think they don't belong in your guild.
The top 10 players sorted by Level will fight the tournament for your guild.",
'Tourney'		=> "Tourney is a shortcut for Tournament. Here you can win a percentage of Exp, Gold and Stash without losing any.",
'Challenge'	=> "Invite one player, everybody or all low level players for a duel. A duel will be shown in your schedule.You may cancel your challenge anytime in your schedule if you wish.",
'Schedule'	=> "Check if someone has challenged you, if so you can accept the challenge or decline it. Or just cancel your own challenges. You can win or loose 5% of your exp and gold! The loser pays 10% of the 5% total exp and gold!",


'Stats'		=> "Check your Battlefield stats, or required experience for next level. If you have leveled up you may choose a stats to learn. 'Natural' is your actual stats, 'Bonus' is the total charm bonus percentage, and 'Charmed' are stats that can be used in battle but it won't help you to wear more heavy gear. If you have leveled up you can choose a stat to increase.",
'Fight'		=> "When you kill a monster you will gain Experience and find Gold on his corpse. The number behind the monster is the experience of the monster. If you die you can lose up to 5% exp and gold.",
'World'		=> "When you go out of the town you can lose more exp gold because your spirit has to go back to town and hire allot mercenaries to bring back your corps. But you can gain more exp and gold, you will notice this especially when you are a low level character. 
<br><br>
This is the only place you can find free upgrades for your items that can exceed your requirements. The random number gives out one freebie for each ten fights only when the location level+monster level is greater than your level.
<br><br>
And the only place to find powerfull stats charms that gives you a bonus boost for a period of time on one or multiple stats! Best charm looks about like this, it drop like about one out of a million.",
'Shop'		=> "Here can you can upgrade your weapon, armors or magical spells.",
'Inventory'	=> "See your equipments. And other items.",


'Transfer'		=> "Transfer gold to an other char or help an beginner with money aid. You can carry 1.000.000.000 gold per level at once. If you have credits a credits field is shown that let's you transfer credit in units of 10.
<br>
<b>Gold transfers</b> are rounded in units of thousands. If you transfer less than 1.000 gold you will automaticly transfer 10% of your total gold. One level can carry 1.000.000.000 gold. 
<br>
<b>Credit transfers</b> are rounded in units 10, less will automaticly transfer 10% of your total credits.
All credit transfers are logged any abused of a bug / any kind of way to increase the credit amount of not ment to be will result in a account deletion.",
'Messages'	=>"Send a private message to a player or read a message.",
'Stash'		=>"Prevent losing your gold when you die to put your gold in the stash.",
'Charms'		=> "Because you can only hold up to 5 charms that are personally made for you and not useable for any other chars you can destroy the bad charms here, and then try to look for better charms.
<br>If you like a charm, you can also recharge a charm for 500.000 second at a certain price. If a charm has 50.000 or less seconds left you can recharge again, or just ad 10.000 seconds to it. You hold up to 5 charms max. Sell your charms or give it to other players by clicking on transfer.",
'Market'		=> "Sell your charms for Gold or Credits on the market to other players.",


'Steal'		=>"This is a place where you can steel exp and gold from other players that haven't logged in for 30 days or longer. When their exp and gold amount is lower than their level they get deleted!. The minimum is 10k exp and gold the best place for beginners and you are cleaning up the inactives!!! But it cannot be more than you currently own!.",
'Prefz'		=> "Change site colors, font setting and Chat preferences<br><b>[Change Password or Email] </b>Change password and email here.
<br><b>[Freeplay exchanger]</b>Freeplay cannot be transferred it can only be exchanged with one of your other chars. BE CAREFUL if you want it back from the other char because the minimum amount is 5.000 seconds and the other player must be over level 100. This is to prevent creating a new char and transfer the 5.000 start freeplay to your stronger char.",
'Nobility'		=> "Noble Titles get updated when you click on Nobility in the game. Once you have dropped out of the ladder your title will be kept until you have reached an higher title or within range of getting an other title.",
'Support'		=> "Support this game by seeing or visiting my sponsors or donate with Paypal.
<br><b>Credits</b> $1.00 will give you 100 credits, you can spend it on all these items below at your own choice.
The amount and price will increase at each 250 levels, except 'banner star'. Max price for all items is set to 500 credits. ",
'Politics'		=> "Praise a Lord to make a Lord to be a Mod and/or hate a Mod to votes against him/her.
You must be in the top 100 ladder to gain the ability to become a possible Mod player, please choose wisely all Mod players can mute other players.
Your level must be or over 500 to vote. One player may only vote once but you can change your vote at anytime.
To become a Mod, a player needs at least 5 votes and 5% of the total votes, if a mod is voted away by the players his char will become a Demon and lose the ability to mute!.",
'Logout'		=> "Leave this game, after you have left the game you can choose the clear all cookies that was set by the game or just see what cookies where set.",

'Town'		=> "See who is in the game.",
'Ladders'		=> "To stay/come in the ladder your exp must be greater than level*1.000.000. If you went to vacation for longer than 5 days you need to login to come back on the ladder.",
'Forums'		=> "Go to the forums.",
'Guide'		=> "Open this guide lol.",
);
?>
<tr><th align=center colspan=2>Menu Actions</th></tr>
<?php 
foreach ($whot_info as $key=>$val) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#234567\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td valign=top>$key</td><td valign=top>$val</td></tr>";
}
?>