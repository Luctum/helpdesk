<?php
require_once 'micro/log/chromePhp.php';

class Logger{
	public static function init(){

			ChromePhp::getInstance()->addSetting(ChromePhp::BACKTRACE_LEVEL, 2);
	}
	public static function log($id,$message){
		global $config;
		if($config["debug"])
		ChromePhp::log($id.":".$message);
	}
	public static function warn($id,$message){
		global $config;
		if($config["debug"])
		ChromePhp::warn($id.":".$message);
	}
	public static function error($id,$message){
		global $config;
		if($config["debug"])
		ChromePhp::error($id.":".$message);
	}
}