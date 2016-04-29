<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Yaoh 製作
// 製作日期：2013-10-27
// 檔案名稱：functions.php
// 功能：前後台共用功能
//  ------------------------------------------------------------------------ //
include_once('jsloader.inc.php');
//引用Bootstrap
function useBootstrap(){
$return=jsloader::useBootstrap();
$return.=addJquery("
$('#xo-toolbar .tooltip, #xo-footer  .tooltip, #xo-logo-head .tooltip').removeClass('tooltip').addClass('tooltipBootstrap');
$('#xo-toolbar').css({
'width':'300px',
'float':'left'
});
");
return $return;
}
function addCss($css){
$return="<style type='text/css'>
$css
</style>";
return $return;
}
//產生index與value相同的陣列
function array_addindex($array){
	$newarray=array();

	foreach($array as $a){
	$newarray[$a]=$a;
	}
	return $newarray;
}

function addJquery($code){
	return "<script type='text/javascript'>$(function(){".$code."})</script>"; 
}

function addJava($content,$src=null){
	return "<script type='text/javascript'".(($src<>null)?"src=".$src:'').">".$content."</script>"; 
}
function addColorPicker($name){
$return=<<<addjquery
	var temp_color=$("[name=$name]").val();
    $("[name=$name]").replaceWith("<input type='color' id='$name' name='$name' value="+temp_color+">");
addjquery;
return $return;
}
//class marquee{
	function marquee($row,$pattern,$edit=false){
		if($pattern==null)$pattern='p'.rand();
		//屬性設定
		$pattern2='pp'.rand();
		$loop_txt=($row['LOOP']<>null)?"loop=".$row['LOOP']:'';
		$scrollAmount_txt=($row['scrollAmount']<>null)?"scrollamount=".$row['scrollAmount']:"scrollamount=1";
		$behavior_txt=($row['light_behavior']<>null)?"behavior=".$row['light_behavior']:'';
		$direction_txt=($row['direction']<>null)?"direction=".$row['direction']:'';
		$scrolldelay_txt=($row['scrollDelay']<>null)?"scrolldelay=".$row['scrollDelay']:'';
		$font_color_txt_start=($row['font_color']<>null)?"<font color=".$row['font_color']." >":'';
		$font_color_txt_end=($row['font_color']<>null)?"</font>":'';
		$alt_title_str=($row['AltTitle']<>null)?" alt=".$row['AltTitle']." title=".$row['AltTitle']:"";
		$light_link_txt_start="<a style='text-decoration:none;".(($row['font_color']<>null)?"color:".$row['font_color'].";":"")."' style= target='_blank' href=".(($row['light_link']<>null)?$row['light_link']:"'#'").$alt_title_str.">";
		$light_link_txt_end="</a>";
		$shadow_h=($row['shadow_h']<>null)?$row['shadow_h']:2;
		$shadow_v=($row['shadow_v']<>null)?$row['shadow_v']:2;
		$shadow_b=($row['shadow_b']<>null)?$row['shadow_b']:5;
		$font_family=($row['font_family'])?'font-family:'.$row['font_family'].';':'font-family: DFKai-sb;';
		$fontsize=($row['fontsize']<>null)?'font-size:'.$row['fontsize'].';':'font-size:1em;';
		$line_height=($row['fontsize']<>null)?'line-height:'.$row['fontsize'].';':'line-height:100%'.';';
		$fontsize_hover=($row['fontsize_hover']<>null)?'font-size:'.$row['fontsize_hover'].';':'font-size:2em;';
		//未來將此功能加入區塊設定，讓使用者決定是否隨字形改變行高
		$line_height_hover=($row['fontsize_hover']<>null)?'line-height:'.$row['fontsize_hover'].';':'line-height:100%'.';';
		$shadow_color_txt=($row['shadow_color']<>null)?"text-shadow:{$row['shadow_color']} {$shadow_h}px {$shadow_v}px {$shadow_b}px;":'';
		$z_index=($row['light_rank']<>null)?"z-index:{$row['light_rank']};":'';
		$trans_time=($row['trans_time']<>null)?$row['trans_time']:'1';
		//非編輯時才使用旋轉及互動式特效
		if($edit<>true)$rotate_deg_light_txt=($row['rotate_deg']<>null)?"
		/*Safari*/
		-webkit-transform: rotate({$row['rotate_deg']}deg);
		/*Firefox*/
		-moz-transform: rotate({$row['rotate_deg']}deg);
		/*Opera*/
		-o-transform: rotate({$row['rotate_deg']}deg);
		/*IE*/
		-ms-transform: rotate({$row['rotate_deg']}deg);":'';
		//style組合
		$style_txt=$font_family.$shadow_color_txt.$rotate_deg_light_txt.$z_index;
		//屬性組合
		$light="<marquee class='light {$pattern} {$pattern2}' {$loop_txt} {$scrollAmount_txt} {$behavior_txt}
					{$direction_txt} {$scrolldelay_txt}>{$font_color_txt_start}{$light_link_txt_start}
					{$row['light_content']}
					{$light_link_txt_end}{$font_color_txt_end}</marquee>";
		$css="
		<style type='text/css'>
		.{$pattern2}{
		{$fontsize}
		{$style_txt}
		{$line_height}
		-webkit-transition:font-size {$trans_time}s, line-height {$trans_time}s;
		-moz-transition:font-size {$trans_time}s, line-height {$trans_time}s;
		-ms-transition:font-size {$trans_time}s, line-height {$trans_time}s;
		}
		.{$pattern2}:hover{
		{$fontsize_hover}
		cursor:pointer;
		left:0px;
		top:0px;
		{$line_height_hover}
		}
		</style>
		";
		return $css.$light;
}
//}

class jqueryBox{
public function __construct($from_net=false){

echo jsloader::useJqueryUI();
return false;
}

public function addSlider($id,$ajax=true){
$ajax_str=($ajax==true)?"sjfn('{$_SERVER['PHP_SELF']}?op=edit_do','preview','light_form');":"";
$return =<<<slider
  <script>
  $(function() {
    var select = $("#$id");
	var optionsize=select.find("option").size();
    var slider = $( "<div id='slider_$id'></div>" ).insertAfter( select ).slider({
      min: 1,
      max: optionsize,
      range: "min",
      value: select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
      },
	  stop: function( event, ui){
		{$ajax_str}
	  }
    });
    $("#$id").change(function() {
      slider.slider( "value", this.selectedIndex + 1 );
		{$ajax_str}
    });
  });
  </script>
slider;
return $return;
}
}

?>
