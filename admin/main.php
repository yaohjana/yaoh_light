<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Yaoh 製作
// 製作日期：2013-10-27
// 檔案名稱：main.php
// 功能：後台管理
//  ------------------------------------------------------------------------ //
//引入函數
include_once 'header.php';
include_once('../functions.php');
include_once('../jsloader.inc.php');
include_once('../blocks/yaoh_light_block.php');

//顯示編輯清單

function marqueeList(){
	$return='';
	//tag selector
	global $xoopsDB;
	$res=$xoopsDB->query("select * from ".$xoopsDB->prefix('yaoh_light'));
	$tag_str='';
	$rows=array();
	while($row=$xoopsDB->fetchArray($res)){
		$tag_str.=$row['tag'].',';
		$rows[]=$row;
	}
	$tag_array=explode(',', $tag_str);
	$tag_count=array_count_values($tag_array);
	$tag_options_array=array();

	$tag_options_array['notag']=_MB_MARQUEE_NOTAG;

	foreach($tag_count as $a=>$b){
		if($a==null)continue;
		$tag_options_array[$a]=$a."(".$b.")";
	}
	$return.=useBootstrap();

	$return.=addCss("
		.nopoint{list-style-type:none;}
	");
	//nav-tabs
	$return.="<ul class='nav nav-tabs' id='myTab'>";
	foreach($tag_options_array as $a=>$b){
		$return.="<li><a href='#$a'>$b</a></li>";
	}
	$return.="</ul>";
	$return.="<div class='tab-content'>";
	foreach($tag_options_array as $a=>$b){
		$return.="<div class='tab-pane' id='$a'>";
				$return.="<table class='table'><tr><th>";
				$return.=($a=='notag')?_MB_MARQUEE_NOTAG_DESC:sprintf(_MB_MARQUEE_WITH_TAG,$a);
				$return.="</th><th width=15%>"._MB_MAQUEE_HANDLE."</th></tr>";
				foreach($rows as $row){
					//tag  判讀
					$tag_array=explode(',', $row['tag']);
					if($a=='notag' and $row['tag']==null){

					}else{
						if($a!=null){
							if(!in_array($a, $tag_array))continue;
						}
					}
					//產生跑馬燈格式
					$return.="<tr>";
					$return.="<td>".marquee($row,'',false)."</td>";
					$del_check_all_txt=(isset($_SESSION['del_check_all']))?"del":"del_check";
					$del_check_all_txt2=(isset($_SESSION['del_check_all']))?"show":"edit";
					$return.="<td><a class='btn btn-success' href='../admin/main.php?op=edit&id={$row['light_id']}'>
					"._MB_MARQUEE_EDIT."</a>
					<a class='btn btn-warning' href='../admin/main.php?op=del&id={$row['light_id']}'>
					"._MB_MARQUEE_DEL."</a></td>";
					$return.="</tr>";
				}
				$return.="</table>";
		$return.="</div>";
	}
	$return.="</div>";
	$return.=<<<tabscript
		<script>
		  $(function () {
		  $('#myTab li').addClass('nopoint');
		  $('#myTab a').click(function (e) {

			  e.preventDefault();
			  $(this).tab('show');
			})
			$('#myTab a:first').tab('show');
		  })
		</script>
tabscript;

	return $return;
}

//儲存
function update_light(){
	global $xoopsDB;
	//$_POST['light_content']=nl2br($_POST['light_content']);
	if($_POST['id']<>null){
	$sql = "UPDATE ".$xoopsDB->prefix('yaoh_light')."
		 SET
			`font_color`='{$_POST['font_color']}',
			`font_family`='{$_POST['font_family']}',
			`scrollDelay`='{$_POST['scrollDelay']}',
			`direction`='{$_POST['direction']}',
			`light_behavior`='{$_POST['light_behavior']}',
			`scrollAmount`='{$_POST['scrollAmount']}',
			`LOOP`='{$_POST['LOOP']}',
			`shadow_color`='{$_POST['shadow_color']}',
			`shadow_h`='{$_POST['shadow_h']}',
			`shadow_v`='{$_POST['shadow_v']}',
			`shadow_b`='{$_POST['shadow_b']}',
			`rotate_deg`='{$_POST['rotate_deg']}',
			`fontsize`='{$_POST['fontsize']}',
			`fontsize_hover`='{$_POST['fontsize_hover']}',
			`trans_time`='{$_POST['trans_time']}',
			`AltTitle`='{$_POST['AltTitle']}',
			`light_content`='{$_POST['light_content']}',
			`light_link`='{$_POST['light_link']}',
			`tag`='{$_POST['tag']}',
			`is_show`='{$_POST['is_show']}',
			`light_rank`='{$_POST['light_rank']}'
		 WHERE
		 `light_id`='{$_POST['id']}'";
		  if($xoopsDB->queryF($sql))return $_POST['id'];
		 }else{
$sql = "insert ".$xoopsDB->prefix('yaoh_light')."
		(`font_color`,`font_family`,`scrollDelay`,`direction`,`light_behavior`,
		`scrollAmount`,`LOOP`, `shadow_color`, `shadow_h`, `shadow_v`, `shadow_b`, `rotate_deg`, `fontsize`,`fontsize_hover`, `trans_time`, `AltTitle`, `light_content`, `light_link`, `tag`, `is_show`,`light_rank`)
		 values
			(
			'{$_POST['font_color']}',
			'{$_POST['font_family']}',
			'{$_POST['scrollDelay']}',
			'{$_POST['direction']}',
			'{$_POST['light_behavior']}',
			'{$_POST['scrollAmount']}',
			'{$_POST['LOOP']}',
			'{$_POST['shadow_color']}',
			'{$_POST['shadow_h']}',
			'{$_POST['shadow_v']}',
			'{$_POST['shadow_b']}',
			'{$_POST['rotate_deg']}',
			'{$_POST['fontsize']}',
			'{$_POST['fontsize_hover']}',
			'{$_POST['trans_time']}',
			'{$_POST['AltTitle']}',
			'{$_POST['light_content']}',
			'{$_POST['light_link']}',
			'{$_POST['tag']}',
			'{$_POST['is_show']}',
			'{$_POST['light_rank']}')";
			  if($xoopsDB->queryF($sql))return $xoopsDB->getInsertId();
		 }

}

function show_light($id){
	global $xoopsDB;
			$sql="select * from ".$xoopsDB->prefix('yaoh_light')." where light_id = ".$id;
			$res=$xoopsDB->query($sql);
			$row=$xoopsDB->fetchArray($res);
			//產生跑馬燈(輸入$row陣列)
			$marquee=marquee($row,'',false);
	return $marquee;
}

//編輯選單
function edit_light($id){
	global $xoopsDB,$rotate_array,$color_array;
	$id=(int)$id;
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
	include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'themeformbootstrap.php');
	//載入js
	echo jsloader::useMyjs();

	$return='';
	if($id>0){
		$sql="select * from ".$xoopsDB->prefix('yaoh_light')." where `light_id`=".$id;
		$res=$xoopsDB->query($sql);
		$row_edit=$xoopsDB->fetchArray($res);
	}else{
		$row_edit=null;
	}

	//預設值處理
	$shadow_h=($row_edit['shadow_h']<>null)?$row_edit['shadow_h']:2;
	$shadow_v=($row_edit['shadow_v']<>null)?$row_edit['shadow_v']:2;
	$shadow_b=($row_edit['shadow_b']<>null)?$row_edit['shadow_b']:5;
	$font_color=($row_edit['font_color']<>null)?$row_edit['font_color']:'#000000';//black
	$fontsize=($row_edit['fontsize']<>null)?$row_edit['fontsize']:'1em';
	$fontsize_hover=($row_edit['fontsize_hover']<>null)?$row_edit['fontsize_hover']:'2em';
	$trans_time=($row_edit['trans_time']<>null)?$row_edit['trans_time']:'1';
	$scrollAmount=($row_edit['scrollAmount']<>null)?$row_edit['scrollAmount']:'1';
	$shadow_color=($row_edit['shadow_color']<>null)?$row_edit['shadow_color']:'#00ff00';//green
	$font_family=($row_edit['font_family']<>null)?$row_edit['font_family']:'PMingLiU';
	$direction=($row_edit['direction']<>null)?$row_edit['direction']:'right';
	$light_behavior=($row_edit['light_behavior']<>null)?$row_edit['light_behavior']:"scroll";

//跑馬燈編輯或新增表單
	$form= new XoopsThemeFormBootstrap(_AM_MARQUEE_FORM_DESC,"light_form",$_SERVER['PHP_SELF']."?op=edit_do","post",true);
	if($id)$form->addElement(new XoopsFormHidden("id",$id));
	$form->addElement(new XoopsFormHidden("is_show",1));

	//目前進行動作說明
	if($id){
		//編輯跑馬燈
		$form->addElement(new XoopsFormLabel(_AM_MARQUEE_ACTION_DESC,_AM_MARQUEE_EDIT));
	}else{
		//新增跑馬燈
		$form->addElement(new XoopsFormLabel(_AM_MARQUEE_ACTION_DESC,_AM_MARQUEE_ADD));
	}
	$color_array=array_addindex(array("", "#D3D8E8", "Black", "Olive", "Teal", "Red", "Blue", "Maroon", "Navy", "Gray", "Lime", "Fuchsia", "White", "Green", "Purple", "Silver", "Yellow", "Aqua", "Snow"));
	$time_array=array_addindex(array("","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","50","100","200","300","400","500","1000","2000","3000"));
	$shadow_move=array_addindex(array("-50","-40","-30","-20","-10","-9","-8","-7","-6","-5","-4","-3","-2","-1","0","1","2","3","4","5","6","7","8","9","10","20","30","40","50"));
	$fontsize_array=array_addindex(array("0.5em","1em","1.3em","1.5em","1.7em","2em","3em","4em","5em","6em","7em","8em","9em","10em"));
	$transtime_array=array_addindex(array('0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0','1.1','1.2','1.3','1.4','1.5','2','3','4','5','6','7','8','9','10','20','30'));
	
	$form->insertBreak(_MB_MARQUEE_FONT_SET);
	//字型顏色
	$form->addElement(new XoopsFormText(_AM_MARQUEE_FONT_COLOR,'font_color',15,15,$font_color));

	//字的陰影顏色
	$form->addElement(new XoopsFormText(_AM_MARQUEE_SHADOW_COLOR,'shadow_color',15,15,$shadow_color),false);

	$font_family_array=array("Microsoft YaHei"=>_MB_MAQUEE_FONT_NAME_MY,
	"Microsoft JhengHei"=>_MB_MAQUEE_FONT_NAME_MJ,
	"PMingLiU"=>_MB_MAQUEE_FONT_NAME_PML,
	"MingLiU"=>_MB_MAQUEE_FONT_NAME_ML,
	"DFKai-sb"=>_MB_MAQUEE_FONT_NAME_DFK,
	"SimSun"=>_MB_MAQUEE_FONT_NAME_SS,
	"Arial"=>"Arial",
	"Tahoma"=>"Tahoma",
	"Helvetica"=>"Helvetica",
	"Comic Sans MS"=>"Comic Sans MS",
	"Georgia"=>"Georgia",
	"Time New Roman"=>"Time New Roman"
	);
	//字型
	$font_family=new XoopsFormSelect(_MB_MARQUEE_FONT_FAMILY,"font_family",$font_family);
		$font_family->addOptionArray($font_family_array);
		$form->addElement($font_family);

	//字型大小
	$fontsize=new XoopsFormSelect(_AM_MARQUEE_FONTSIZE,"fontsize",$fontsize);
		$fontsize->addOptionArray($fontsize_array);
		$form->addElement($fontsize);



	$form->insertBreak(_MB_MARQUEE_ACT_SET);
	
		//滑鼠在上時字型大小若設成跟原本自行相同則無特效
	$fontsize_hover=new XoopsFormSelect(_AM_MARQUEE_FONTSIZE_HOVER,"fontsize_hover",$fontsize_hover);
		$fontsize_hover->addOptionArray($fontsize_array);
		$form->addElement($fontsize_hover);

		
		//滑鼠在上時字型大小變化所需要的時間
	$trans_time=new XoopsFormSelect(_MB_MAQUEE_TRANS_TIME,"trans_time",$trans_time);
		$trans_time->addOptionArray($transtime_array);
		$form->addElement($trans_time);
		
	//陰影水平位移
	$shadow_h=new XoopsFormSelect(_AM_MARQUEE_SHADOW_H,"shadow_h",$shadow_h);
		$shadow_h->addOptionArray($shadow_move);
		$form->addElement($shadow_h);

	//陰影垂直位移
	$shadow_v=new XoopsFormSelect(_AM_MARQUEE_SHADOW_V,"shadow_v",$shadow_v);
		$shadow_v->addOptionArray($shadow_move);
		$form->addElement($shadow_v);

	//陰影模糊相素
	$shadow_b=new XoopsFormSelect(_AM_MARQUEE_SHADOW_B,"shadow_b",$shadow_b);
		$shadow_b->addOptionArray($shadow_move);
		$form->addElement($shadow_b);

		//旋轉角度
	$rotate_deg=new XoopsFormSelect(_AM_MARQUEE_ROTATE_DEG,"rotate_deg",$row_edit['rotate_deg']);
		$rotate_deg->addOptionArray(array_addindex(array("","0","1","2","5","10","15","30","45","60","75","90","105","120","135","150","165","180","195","210","225","240","255","270","285","300","315","330","345","360","-1","-2","-5","-10","-15","-30")));
		$form->addElement($rotate_deg);

	$form->insertBreak(_MB_MARQUEE_MOTION_SET);

	//移動方向
	$direction=new XoopsFormRadio(_AM_MARQUEE_DIRECTION,"direction",$direction);
		$direction->addOptionArray(array("right"=>_MB_MARQUEE_DIRECTION_RIGHT,"left"=>_MB_MARQUEE_DIRECTION_LEFT,"up"=>_MB_MARQUEE_DIRECTION_UP,"down"=>_MB_MARQUEE_DIRECTION_DOWN));
		$form->addElement($direction);

	//移動習性
	$light_behavior=new XoopsFormRadio(_AM_MARQUEE_LIGHT_BEHAVIOR,"light_behavior",$light_behavior);
		$light_behavior->addOptionArray(array("slide"=>_MB_MARQUEE_BEHAVIOR_SLIDE,"alternate"=>_MB_MARQUEE_BEHAVIOR_ALTERNATE,"scroll"=>_MB_MARQUEE_BEHAVIOR_SCROLL));
		$form->addElement($light_behavior);

	//延遲時間設定
	$scrollDelay=new XoopsFormSelect(_AM_MARQUEE_SCROLLDELAY,"scrollDelay",$row_edit['scrollDelay']);
		$scrollDelay->addOptionArray($time_array);
		$form->addElement($scrollDelay);

	//移動速度
	$scrollAmount=new XoopsFormSelect(_AM_MARQUEE_SCROLLAMOUNT,"scrollAmount",$scrollAmount);
		$scrollAmount->addOptionArray($time_array);
		$form->addElement($scrollAmount);

	//重複次數
	$LOOP=new XoopsFormSelect(_AM_MARQUEE_LOOP,"LOOP",$row_edit['LOOP']);
		$LOOP->addOptionArray($time_array);
		$form->addElement($LOOP);


	$form->insertBreak(_MB_MARQUEE_CONTENT_SET);

	//跑馬燈文字內容
	$form->addElement(new XoopsFormTextArea(_AM_MARQUEE_LIGHT_CONTENT,"light_content",$row_edit['light_content'],6,300),true);

	//關於跑馬燈的相關說明
	$form->addElement(new XoopsFormTextArea(_AM_MARQUEE_ALTTITLE,"AltTitle",$row_edit['AltTitle'],6,100));

	//相關超連結
	$form->addElement(new XoopsFormText(_AM_MARQUEE_LIGHT_LINK,"light_link",100,100,$row_edit['light_link']));

	$form->insertBreak(_MB_MARQUEE_TAG_SET);
	//優先順序(數字越小越優先)
	$Rank=new XoopsFormSelect(_AM_MARQUEE_RANK,"Rank",$row_edit['Rank']);
		$Rank->addOptionArray(array_addindex(array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20")));
		$form->addElement($Rank);

	//標籤設定(請用半形逗號,分隔)
	$form->addElement(new XoopsFormText(_AM_MARQUEE_TAG,"tag",100,100,$row_edit['tag']));

//jquery

	if($id){
		$return.=addJquery("
			$('form').change(function(){
				sjfn('{$_SERVER['PHP_SELF']}?op=edit_do','preview','light_form');
			});
		");
	}else{
		$form->addElement(new XoopsFormHidden("add",'add'));

		//送出
		$form->addElement(new XoopsFormButton("","",_AM_MARQUEE_BTN_ADD,"submit"));

	}
//跑馬燈預覽
	if($id)$return.="<div id='preview_can' style='position:fixed;border:1px solid black;background:rgba(0,0,0,0.5);z-index:99999;bottom:0px;left:0px;line-height:1.2;width:100%;padding-bottom:12px;'><div style='color:white' id='preview_title'>"._AM_MARQUEE_PREVIEW."</div><div title="._AM_MARQUEE_PREVIEW." id='preview' >".show_light($id)."</div></div><br><br>";

	$return.=$form->render();
	$jqueryBox=new jqueryBox();
	$slider_ajax=($id)?true:false;
	$return.=$jqueryBox->addSlider('LOOP',$slider_ajax).$jqueryBox->addSlider('scrollAmount',$slider_ajax).$jqueryBox->addSlider('scrollDelay',$slider_ajax).$jqueryBox->addSlider('rotate_deg',$slider_ajax).$jqueryBox->addSlider('shadow_h',$slider_ajax).$jqueryBox->addSlider('shadow_v',$slider_ajax).$jqueryBox->addSlider('shadow_b',$slider_ajax).$jqueryBox->addSlider('fontsize',$slider_ajax).$jqueryBox->addSlider('fontsize_hover',$slider_ajax).$jqueryBox->addSlider('Rank',$slider_ajax).$jqueryBox->addSlider('trans_time',$slider_ajax);
	$return.=jsloader::useColorPicker();
	$return.=addJava(addColorPicker('shadow_color').addColorPicker('font_color'));
	//bootstrap
	$return.=useBootstrap();
	 $return.=addJquery("
		$('[name=xolb_direction]').addClass('inline').end().find('[name=xolb_light_behavior]').addClass('inline');
	");
	$return.=addCss("textarea{width:80%;} input{width:80%;} .ui-slider{width:80%;}");
	return  $return;
}

/*-----------執行動作判斷區----------*/
$op=empty($_REQUEST['op'])?"":$_REQUEST['op'];
$id=empty($_REQUEST['id'])?"":(int)$_REQUEST['id'];
//只允許英數字
if(!preg_match("/^[A-Za-z0-9_]*$/", $op))exit;
if(!preg_match("/^[A-Za-z0-9_]*$/", $id))exit;
switch($op){
	case 'add':
		$main=edit_light('');
	break;
	case 'edit':
		$main=edit_light($id);
	break;
	case 'edit_do':
		if($_POST['add']=='add'){
			if($idd=update_light())$main= edit_light($idd);
		}else{
			if($idd=update_light())echo show_light($idd);
			exit;
		}
	break;
	case 'del':

		if(isset($_GET['del']) and $_GET['del']=='del'){
		$delSql = "delete from ".$xoopsDB->prefix('yaoh_light')." where light_id=".$id;

				if($xoopsDB->queryF($delSql)){
					//刪除成功
					$main=_AM_MARQUEE_DEL_SUCCESS.marqueeList();

				}else{
					//刪除失敗
					$main= _AM_MARQUEE_DEL_FAULT.marqueeList();
				}
		}elseif(isset($_GET['del'])){
					//請輸入[del]確認刪除
					$main= _AM_MARQUEE_DEL_CHECK.marqueeList();
		}else{
			$main=jsloader::useMyjs()."<center><h1>"._AM_MARQUEE_DEL_CHECK."</h1>
			<form name=del_light method=get action='javascript:void%200'>
			<input type=text id=del name=del>
			<input type=submit onclick=jumpto('{$_SERVER['PHP_SELF']}?op=del&id={$_GET['id']}&del='+bi('del').value) value="._MB_MARQUEE_DEL." /></form></center>".marqueeList();
		}
	break;
	default:
		$main=marqueeList();
	break;
}
include_once XOOPS_ROOT_PATH."/modules/" . $xoopsModule->getVar("dirname") . "/class/admin.php" ;
$index_admin = new ModuleAdmin() ;
$address_str_part2=(isset($_GET['op']))?"?op={$_GET['op']}":"";
$address_str="main.php".$address_str_part2;
//輸出
echo $index_admin->addNavigation($address_str);
echo $main;

include_once "footer.php";
?>
