<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name'] = _MI_YAOH_LIGHT_BLOCK_NAME;
$modversion['version'] = 3.01;
$modversion['description'] = _MI_YAOH_LIGHT_BLOCK_DESC;
$modversion['author'] = 'DengYuan';
$modversion['credits'] = '';
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(dirname(__FILE__));


//---模組狀態資訊---//
$modversion['status_version'] = 'RC';
$modversion['release_date'] = '2013/9/18';
$modversion['module_website_url'] = 'https://sites.google.com/a/dcjh.tn.edu.tw/mis/';
$modversion['module_website_name'] = "DengYuan's working space";
$modversion['module_status'] = 'RC';
$modversion['author_website_url'] = 'https://sites.google.com/a/dcjh.tn.edu.tw/mis/';
$modversion['author_website_name'] = 'DengYuan';
$modversion['min_php']=5.2;
$modversion['min_xoops']='2.5';


//---後台使用系統選單---//
$modversion['system_menu'] = 1;


//---模組資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'yaoh_light';

//---後台管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';


//---前台主選單設定---//
$modversion['hasMain'] = 0;

//---偏好設定---//
$modversion['config'] = array();

//---搜尋---//
$modversion['hasSearch'] = 0;

$modversion['blocks'] = array();
$modversion['blocks'][1]['file'] = "yaoh_light_block.php";
$modversion['blocks'][1]['name'] = _MI_YAOH_LIGHT_BLOCK_NAME;
$modversion['blocks'][1]['description'] = _MI_YAOH_LIGHT_BLOCK_DESC;
$modversion['blocks'][1]['show_func'] = "list_light_in_blocks";
$modversion['blocks'][1]['template'] = "yaoh_light_block_tpl.html";
$modversion['blocks'][1]['edit_func'] = "edit_list_light";
$modversion['blocks'][1]['options'] = "10|3|8|0|0||";

$modversion['hasComments'] = 0;
?>
