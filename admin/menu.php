<?php
$i = 1;
$adminmenu[$i]['title'] = _MI_XDIR_ADMIN_HOME ;
$adminmenu[$i]['link'] = 'admin/index.php' ;
$adminmenu[$i]['desc'] = _MI_XDIR_ADMIN_HOME_DESC ;
$adminmenu[$i]['icon'] = 'images/admin/home.png' ;

$i++;
$adminmenu[$i]['title'] = _MI_XDIR_ADMIN_TITLE;
$adminmenu[$i]['link'] = "admin/main.php";
$adminmenu[$i]['desc'] = _MI_XDIR_ADMIN_DESC;
$adminmenu[$i]['icon'] = 'images/admin/trophy_gold.png' ;

$i++;
$adminmenu[$i]['title'] =_MI_XDIR_ADMIN_TITLE_ADD;
$adminmenu[$i]['link'] = "admin/main.php?op=add";
$adminmenu[$i]['desc'] = _MI_XDIR_ADMIN_DESC_ADD ;
$adminmenu[$i]['icon'] = 'images/admin/trophy_gold_add.png' ;


$i++;
$adminmenu[$i]['title'] = _MI_XDIR_ADMIN_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['desc'] = _MI_XDIR_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon'] = 'images/admin/about.png';;
?>
