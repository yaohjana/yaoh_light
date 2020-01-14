<?php
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'functions.php');
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'jsloader.inc.php');
/*
 *版本：2.0 2013/11/2
 *作者：yaoh
 *功能：跑馬燈揭示系統主要顯示
 *@para:$edit bool 是否顯示編輯按鈕
 *@para：$options array為設定用陣列
 *		$options[0]共讀取幾則(空白或0為全部讀取)
 *		$options[1]亂數顯示
 *		$options[2]實際顯示幾則(空白或0為全部顯示)
 *		$options[3]幾秒切換一次(空白或0為部切換)
 *		$options[4]旋轉角度(空白或0為正常角度)
 *		$options[5]看板寬度(空白或0則自動調整)
 *		$options[6]背景顏色(預設為空白)
 *		$options[7]顯示的tag(一段文字)
 *@return:區塊顯示的內容
 */
function list_light_in_blocks($options,$edit=false){
	global $xoopsDB,$xoopsModuleConfig;
	$sql="SELECT * FROM ".$xoopsDB->prefix("yaoh_light").
		" WHERE find_in_set('{$options[7]}', tag) ".
		" ORDER BY ";
	//亂數讀取與否
	if($options[1]==1){
		$sql.=" RAND()";
	}else{
		$sql.=" `light_rank`";
	}
	if($options[0]>0){
		$sql.=" LIMIT 0, ".$options[0];
	}
	$res = $xoopsDB->query($sql) or redirect_header('index.php', 3, mysql_error());
	//背景色
	$get_lightboard_color=$options[6];
	$light='';
	$edit_txt='';

	$pattern='p'.rand();
	//變動間隔
	if($options[3]>0){
		$interval_str="setInterval('$.show{$pattern}()',{$options[3]}000);";
	}else{
		$interval_str='';
	}

	if($edit==false)$script_txt="
		onmouseover=\"this.setAttribute('scrollamount', 1, 0);\" onmouseout=\"this.setAttribute('scrollamount', 6, 0);\"";
		//總量初始
		$light_num=0;
		while($row=$xoopsDB->fetchArray($res)){
			//tag  判讀  改由SQL處理
			// $tag_array=explode(',', $row['tag']);
			// if($options[7]!=null){
			// 	if(!in_array($options[7], $tag_array))continue;
			// }
			$light_num++;
			//產生跑馬燈格式
			
			$light.=marquee($row,$pattern,$edit);
			
			$del_check_all_txt=(isset($_SESSION['del_check_all']))?"del":"del_check";
			$del_check_all_txt2=(isset($_SESSION['del_check_all']))?"show":"edit";
			if($edit==true)$light.="<a class='btn' href='../admin/main.php?op=edit&id={$row['light_id']}'>
			"._MB_MARQUEE_EDIT."</a>
			<a class='btn' href='../admin/main.php?op=del&id={$row['light_id']}'>
			"._MB_MARQUEE_DEL."</a><br><br><br>";
			}
		//顯示數量
		if($options[2]>0){
			$see_num_limit=$options[2];
		}else{
			$see_num_limit=$light_num;
		}
			$light.=jsloader::useJquery();
			$light.=addJquery("
			var mark=(Math.random() * {$light_num} | 0);
			$.extend({
				show{$pattern}:function(){
					$('marquee.{$pattern}').hide();
					mark++;
					for (var i=1; i<={$see_num_limit}; i=i+1){
						$('marquee.{$pattern}:eq('+((mark+i)%{$light_num})+')').show();
					}
				}
			});
			$.show{$pattern}();
			{$interval_str};
			");
			//揭示板旋轉角度
		$rotate_deg=$options[4];
		$lightboard_width=($options[5]>0)?' width:'.$options[5].'px;':'';
		$rotate_deg_txt=($rotate_deg<>null)?"-webkit-transform:rotate(".$rotate_deg."deg);-moz-transform:rotate(".$rotate_deg."deg);-ms-transform:rotate(".$rotate_deg."deg);":"";
		$box_style_txt=$lightboard_width."{$rotate_deg_txt}";
		$box_style_txt2="background:none repeat scroll 0 0 {$get_lightboard_color};border-radius: 20px 20px 20px 20px;padding: 0 20px; ";
		$return="<div id='light' style='{$box_style_txt}{$box_style_txt2}'>{$light}</div>";
		//編輯模式(將去除旋轉、滑鼠影響等特效)
		$editmsg=($edit==false)?'':'<h1>'._MB_MARQUEE_EDITMODE_TITLE.'</h1>';
		return $editmsg.$return;
}
/*
 *版本：2.0 2013/11/2
 *作者：yaoh
 *功能：輸出區塊設定的表單
 *@para：$options array為設定用陣列
 *		$options[0]共讀取幾則(空白或0為全部讀取)
 *		$options[1]亂數顯示
 *		$options[2]實際顯示幾則(空白或0為全部顯示)
 *		$options[3]幾秒切換一次(空白或0為部切換)
 *		$options[4]旋轉角度(空白或0為正常角度)
 *		$options[5]看板寬度(空白或0則自動調整)
 *		$options[6]背景顏色(預設為空白)
 *		$options[7]顯示的tag(一段文字)

 *@return:輸出區塊設定的表單
 */
function edit_list_light($options){
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
	//背景顏色
	$color_picker=new XoopsFormColorPicker(_MB_MARQUEE_BACKGROUND_COLOR,'options[6]',$options[6]);
	$color_picker=$color_picker->render();

	//tag selector
	global $xoopsDB;
	$res=$xoopsDB->query("select `tag` from ".$xoopsDB->prefix('yaoh_light'));
	$tag_str='';
	while($row=$xoopsDB->fetchArray($res)){
		$tag_str.=$row['tag'].',';
	}
	$tag_array=explode(',', $tag_str);
	$tag_count=array_count_values($tag_array);
	$tag_options_array=array();

//想要顯示的標籤
	$tag_selector=new XoopsFormSelect(_MB_MARQUEE_SHOW_TAG,'options[7]',$options[7],1,false);
//全部顯示
	$tag_options_array['']=_MB_MARQUEE_SHOW_ALL;
	foreach($tag_count as $a=>$b){
		if($a==null)continue;
		$tag_options_array[$a]=$a."(".$b.")";
	}
	$tag_selector->addOptionArray($tag_options_array);
	$tag_selector=$tag_selector->render();
	$return= "<ol><li>";
	
 //共讀取幾則(空白或0為全部讀取)？
	$return.=_MB_MARQUEE_WHOLE_READ;
	$return.="<input type='number' name='options[0]' value='{$options[0]}' size=2>";
 
 //隨機讀取
	$return.="<input type='checkbox' name='options[1]' value='1' checked='checked'>";
	$return.=_MB_MARQUEE_RANDOM_SHOW;
	$return.="</li><br>";
	
 //實際顯示幾則(空白或0為全部顯示)？
	$return.="<li>";
	$return.=_MB_MARQUEE_WHOLE_SEE;
	$return.="<input type='number' name='options[2]' value='{$options[2]}' size=2>
			</li><br>";

 //幾秒切換一次?
	$return.="<li>";
	$return.=_MB_MARQUEE_CHANGE_FREQUENCE;
	$return.="<input type='number' name='options[3]' value='{$options[3]}' size=2>
			</li><br>";
			
//旋轉角度(空白或0為正常角度)
	$return.="<li>";
	$return.=_MB_MARQUEE_ROTATE;
    $return.="<input type='number' name='options[4]' value='{$options[4]}' size=3>
			</li><br>";
			
//看板寬度(空白或0則自動調整)
	$return.="<li>";
	$return.=_MB_MARQUEE_WIDTH;
    $return.="<input type='number' name='options[5]' value='{$options[5]}' size=3>
			</li><br>";
			
//背景顏色
	$return.="<li>";
	$return.=_MB_MARQUEE_BACKGROUND_COLOR;
	
//透明背景
	$return.=$color_picker."<input type='checkbox' name='options[6]' value='' checked='checked'>"._MB_MARQUEE_TRANS."</li>";
	
//要顯示的tag
	$return.="<li>";
	$return.=_MB_MARQUEE_THE_TAG;
	$return.=$tag_selector."</li>  <br>
	</ol>";

return $return;
}
?>
