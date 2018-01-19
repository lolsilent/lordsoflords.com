<?php 
if(isset($_COOKIE['pc']) and !empty($_COOKIE['pc'])){$pc=clean_post($_COOKIE['pc']);}else{$pc='';}

if(isset($_COOKIE['bg']) and !empty($_COOKIE['bg'])){$col_bg=clean_post($_COOKIE['bg']);}
if(isset($_COOKIE['text']) and !empty($_COOKIE['text'])){$col_text=clean_post($_COOKIE['text']);}
if(isset($_COOKIE['alink']) and !empty($_COOKIE['alink'])){$col_link=clean_post($_COOKIE['alink']);}
if(isset($_COOKIE['th']) and !empty($_COOKIE['th'])){$col_th=clean_post($_COOKIE['th']);}
if(isset($_COOKIE['form']) and !empty($_COOKIE['form'])){$col_form=clean_post($_COOKIE['form']);}
if(isset($_COOKIE['family']) and !empty($_COOKIE['family'])){$font_family=clean_post($_COOKIE['family']);}
if(isset($_COOKIE['fsize']) and !empty($_COOKIE['fsize'])){$font_size=clean_post($_COOKIE['fsize']);}
?><html><head><title><?php print $title;?></title><meta http-equiv="Page-Enter" content="blendTrans(Duration=0.3)"><meta http-equiv="Page-Exit" content="blendTrans(Duration=0.3)"><?php include_once($html_style);?></head><body><center>