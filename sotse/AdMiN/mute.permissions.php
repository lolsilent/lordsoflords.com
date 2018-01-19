<?php 
$permissionsss = array (
		//Title, Permission Needed, Current Sex, Requirements, Descprition, Regulations 
'Admin'		=>array('75% Admins and 25% Cops','Cop',"All requirements for Cop,Mod and Support", "See that all Cops, Mods and Supports are doing their job. Inactive for $opinactive[0] days will result in lose of title"),
'Cop'		=>array('25% Admins and 75% Cops','Mod',"Knows the game and enforces the rules", "Must enforce the rules. Must follow the rules. Inactive for $opinactive[1] days will result in lose of title"),
'Mod'		=>array('1 Admin, 25% Cops and 75% Mods','Support',"Trust worthy, know the guide verry well.", "Must follow the rules. Inactive for $opinactive[2] days will result in lose of title"),
'Support'		=>array('1 Admin, 25% Mods and 75% Supports','None', "Need to know the guide a bit", "Must assist with any questions about the game. Support does not mean that they must give you gold or exp. Being inactive for $opinactive[3] days title will be taken away."),
'Demon'		=>array('Admin','Admin/Cop/Mod','Corrupted Admin, Cop or Mod', 'Players who have abused their power in any way'),
'Lady/Lord'	=>array('n/a','n/a','n/a', 'Normal players of the game', 'n/a'),
'Danger'		=>array('Admin','Any','Applies to dangerous players', 'Players who have repetely broken the rules of the game'),
'Untrust'		=>array('Admin','Any','Applies to untrusted players', 'Players who have demonstrated to others that they are not to be trusted'),
'Beggar'		=>array('Admin','Any','Applies to players who beg too much', 'Players who often ask for free things, in violation of the rules')
);
?>