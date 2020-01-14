<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name'] = _MI_YAOH_LIGHT_BLOCK_NAME;
$modversion['version'] = 3.3;
$modversion['description'] = _MI_YAOH_LIGHT_BLOCK_DESC;
$modversion['author'] = 'DengYuan';
$modversion['credits'] = '';
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(dirname(__FILE__));


//---模組狀態資訊---//
$modversion['status_version'] = 'release';
$modversion['release_date'] = '2013/9/18';
$modversion['module_website_url'] = 'https://sites.google.com/a/dcjh.tn.edu.tw/mis/';
$modversion['module_website_name'] = "DengYuan's working space";
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://sites.google.com/a/dcjh.tn.edu.tw/mis/';
$modversion['author_website_name'] = 'DengYuan';
$modversion['min_php']=5.4;
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


/*
 *@para：$options array為設定用陣列
 *		$options[0]共讀取幾則(空白或0為全部讀取)
 *		$options[1]亂數顯示(1為亂數顯示|0為一般排序)
 *		$options[2]實際顯示幾則(空白或0為全部顯示)
 *		$options[3]幾秒切換一次(空白或0為部切換)
 *		$options[4]旋轉角度(空白或0為正常角度)
 *		$options[5]看板寬度(空白或0則自動調整)
 *		$options[6]背景顏色(預設為空白)
 *		$options[7]顯示的tag(一段文字)
*/
//榮譽榜示範
$modversion['blocks'] = array();
$modversion['blocks'][1]['file'] = "yaoh_light_block.php";
$modversion['blocks'][1]['name'] = '榮譽榜(跑馬燈揭示板)';
$modversion['blocks'][1]['description'] = _MI_YAOH_LIGHT_BLOCK_DESC;
$modversion['blocks'][1]['show_func'] = "list_light_in_blocks";
$modversion['blocks'][1]['template'] = "yaoh_light_block_tpl.html";
$modversion['blocks'][1]['edit_func'] = "edit_list_light";
$modversion['blocks'][1]['options'] = "0|1|3|5|0|0|0|榮譽榜";


//課室英語示範
$modversion['blocks'][2]['file'] = "yaoh_light_block.php";
$modversion['blocks'][2]['name'] = '課室英語隨時背(跑馬燈揭示板)';
$modversion['blocks'][2]['description'] = _MI_YAOH_LIGHT_BLOCK_DESC;
$modversion['blocks'][2]['show_func'] = "list_light_in_blocks";
$modversion['blocks'][2]['template'] = "yaoh_light_block_tpl.html";
$modversion['blocks'][2]['edit_func'] = "edit_list_light";
$modversion['blocks'][2]['options'] = "5|1|1|5|0|0|0|課室英語";

$modversion['hasComments'] = 0;
?>
