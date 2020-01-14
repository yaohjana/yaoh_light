<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Yaoh 製作
// 製作日期：2013-10-27
// jsloader.inc.php
// 功能：前台引用管理
//  ------------------------------------------------------------------------ //
include_once('functions.php');
define("YAOH_LIGHT_URL", XOOPS_URL ."/modules/yaoh_light");
define("JS_FOLDER",YAOH_LIGHT_URL. "/js/");
define("CSS_FOLDER",YAOH_LIGHT_URL. "/css/");

class jsloader{
	private static $useMyjs=false;
	private static $useJquery=false;
	private static $useJqueryUI=false;
	private static $useBootstrap=false;
	private static $useJqueryTools=false;
	private static $useColorPicker=false;
	//引用自訂的js
	public static function useMyjs(){
		$js_folder= JS_FOLDER;
		if(self::$useMyjs==false){
			self::$useMyjs = true;
			return "<script type='text/javascript' src='{$js_folder}myjs.js'></script>";
		}
	}
	//引用jquery
	public static function useJquery(){
		$js_folder= JS_FOLDER;
		if(self::$useJquery==false){
		self::$useJquery=true;
		//js檢查
		$jquery="
			 if(typeof jQuery == 'undefined'){ 
			 var js = document.createElement('script'); 
			 js.type = 'text/javascript';
			 js.src = '".$js_folder."jquery.min.js'; 
			 document.getElementsByTagName('head')[0].appendChild(js); 
			}
		";
		return addJava($jquery);
		}
	}
//引用JqueryTools
	public static function useJqueryTools(){
		$js_folder= JS_FOLDER;
		$return='';
		if(self::$useJqueryTools==false){
		self::$useJqueryTools=true;
		//載入jquery
		$return.=self::useJquery();
		//js檢查
		$jquery="
         if(typeof jQuery.tools == 'undefined'){ 
         var jst = document.createElement('script'); 
         jst.type = 'text/javascript';
         jst.src = '".$js_folder."jquery.tools.min.js'; 
         document.getElementsByTagName('head')[0].appendChild(jst); 
        }
";
		$return.=addJava($jquery);
		return $return;
		}
	}
//引用JqueryUI
	public static function useJqueryUI(){
		$js_folder= JS_FOLDER;
		$css_folder= CSS_FOLDER;
		$return='';
		if(self::$useJqueryUI==false){
		self::$useJqueryUI=true;
		//載入jquery
		$return.=self::useJquery();
		//js檢查
		$jqueryui="
         if(typeof jQuery.ui == 'undefined'){ 
         var jsu = document.createElement('script'); 
         jsu.type = 'text/javascript';
         jsu.src = '".$js_folder."jquery-ui.min.js'; 
         document.getElementsByTagName('head')[0].appendChild(jsu); 
        }
";
		$return.=addJava($jqueryui);
		return "<link rel='stylesheet' href='{$css_folder}jquery-ui.min.css' />".$return;
		}
	}
//引用Bootstrap
	public static function useBootstrap(){
		$js_folder= JS_FOLDER;
		$css_folder= CSS_FOLDER;
		$return='';
		if(self::$useBootstrap==false){
			self::$useBootstrap=true;
			//載入jquery
			$return.=self::useJquery();
			//js檢查
$bootstrap="
		 if(typeof bootstrap == 'undefined'){ 
			var jsb = document.createElement('script');
			jsb.type = 'text/javascript';
			jsb.src = '".$js_folder."bootstrap.min.js'; 
			document.getElementsByTagName('head')[0].appendChild(jsb); 
        }
";
		return "<link href='{$css_folder}bootstrap.min.css' rel='stylesheet' media='screen'>".
				addJava($bootstrap);
		}
	}
//引用ColorPicker
	public static function useColorPicker(){
		$js_folder= JS_FOLDER;
		$css_folder= CSS_FOLDER;
		$return='';
		if(self::$useColorPicker==false){
			self::$useColorPicker=true;
			//載入jquery
			$return.=self::useJquery();
			//js檢查
$colorpicker="
		 if(typeof colorpicker == 'undefined'){ 
			var jsc = document.createElement('script');
			jsc.type = 'text/javascript';
			jsc.src = '".$js_folder."spectrum.js'; 
			document.getElementsByTagName('head')[0].appendChild(jsc); 
        }
";
		return "<link href='{$css_folder}spectrum.css' rel='stylesheet' media='screen'>".
				addJava($colorpicker);
		}
	}
}
?>