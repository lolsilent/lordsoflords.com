<?php 
#!/usr/local/bin/php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '123';
$db_main = 'lordsoflords_forum';

$tbl_blog_comments='forum_blog_comments';
$tbl_blog_pic='forum_blog_pic';
$tbl_blog='forum_lol_blog';
$tbl_contents='forum_lol_contents';
$tbl_forums='forum_lol_forums';
$tbl_logs='forum_lol_logs';
$tbl_members='forum_members';
$tbl_news='forum_lol_news';
$tbl_polls='forum_lol_polls';
$tbl_votes='forum_lol_votes';
$tbl_topics='forum_lol_topics';

$table_names=array($tbl_blog_comments,$tbl_blog,$tbl_blog_pic,$tbl_contents,$tbl_forums,$tbl_logs,$tbl_members,$tbl_news,$tbl_polls,$tbl_votes,$tbl_topics);

$fld_blog_comments='`id`,`blid`,`comments`,`timer`';
$fld_blog_pic='`id`,`comments`,`blid`';
$fld_blog='`id`,`mid`,`date`,`blog`,`timer`';
$fld_contents='`id`,`tid`,`sex`,`charname`,`date`,`body`,`timer`,`see`,`deleted`,`ip`';
$fld_forums='`id`,`category`,`name`,`decription`,`topics`,`posts`,`last`,`sex`,`charname`,`see`,`level`';
$fld_logs='`id`,`charname`,`deleted`,`timer`';
$fld_members='`id`,`sid`,`username`,`password`,`sex`,`charname`,`email`,`ev`,`ec`,`msn`,`icq`,`aim`,`yahoo`,`avatar`,`signature`,`posts`,`level`,`last`,`timer`,`session`,`since`,`mute`,`ip`';
$fld_news='`id`,`nid`,`news`,`timer`';
$fld_polls='`id`,`timer`,`sex`,`charname`,`see`,`question`,`a1`,`a2`,`a3`,`a4`,`a5`,`a`,`b`,`c`,`d`,`e`,`ip`';
$fld_votes='`id`,`mid`,`pid`';
$fld_topics='`id`,`fid`,`sticky`,`sex`,`csex`,`charname`,`ccharname`,`name`,`body`,`replies`,`views`,`last`,`first`,`timer`,`see`,`deleted`,`ip`';
?>