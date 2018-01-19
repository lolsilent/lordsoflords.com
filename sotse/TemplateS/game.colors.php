<?php 
if (empty($_COOKIE['col_bg'])){
$col_bg		='#000000';
} else {
$col_bg		=$_COOKIE['col_bg'];
}
if (empty($_COOKIE['col_text'])){
$col_text		='#FFFFFF';
} else {
$col_text		=$_COOKIE['col_text'];
}
if (empty($_COOKIE['col_link'])){
$col_link		='#FFF888';
} else {
$col_link		=$_COOKIE['col_link'];
}
if (empty($_COOKIE['col_hover'])){
$col_hover	='#FF1234';
} else {
$col_hover	=$_COOKIE['col_hover'];
}

if (empty($_COOKIE['col_table'])){
$col_table	=$col_bg;
} else {
$col_table	=$_COOKIE['col_table'];
}
if (empty($_COOKIE['col_th'])){
$col_th		="#012345";
} else {
$col_th		=$_COOKIE['col_th'];
}
if (empty($_COOKIE['col_form'])){
$col_form	='#012345';
} else {
$col_form	=$_COOKIE['col_form'];
}

if (empty($_COOKIE['font_family'])){
$font_family	='Verdana, Arial, Monaco';
} else {
$font_family	=$_COOKIE['font_family'];
}
if (empty($_COOKIE['font_size'])){
$font_size	='10pt';
} else {
$font_size	=$_COOKIE['font_size'];
}
?>