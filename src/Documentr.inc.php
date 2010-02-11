<?php

// define a few important paths
define('DOCUMENTR_ROOT', dirname(dirname(__FILE__)));
define('SRC_ROOT', DOCUMENTR_ROOT . '/src');
define('LIB_ROOT', SRC_ROOT . '/lib');

// include our lib functions...
require_once LIB_ROOT . '/markdown/markdown.php';
require_once LIB_ROOT . '/sfy_yaml/sfYaml.php';

class Documentr
{
	public static $config;
	public static $index;
	public static $guides;
	
	public static function init ()
	{
		self::$config	= sfYaml::load(DOCUMENTR_ROOT . '/config.yml');
		self::$guides	= array();
		self::$index	= array();
	}
	
	public static function parseConfig ()
	{
		foreach (self::$config['guides'] as $section => $group)
		{
			$indexArray	= array();

			foreach ($group as $guide => $data)
			{
				self::$guides[$guide] 	= $data;
				$indexArray[] 			= $guide;
			}

			self::$index[$section] = $indexArray;
		}
	}
	
	public static function cleanOutputDir ()
	{
		shell_exec('rm -rf ' . self::$config['output_dir'] . '/*');
		shell_exec('cp -f ' . DOCUMENTR_ROOT . '/templates/' . self::$config['template'] . '/styles.css ' . self::$config['output_dir']);
		shell_exec('cp -rf ' . DOCUMENTR_ROOT . '/templates/' . self::$config['template'] . '/images ' . self::$config['output_dir']);
	}
	
	public static function buildHome ()
	{
		// make the static items available locally...
		$config	= self::$config;
		$index	= self::$index;
		$guides	= self::$guides;
		
		ob_start();
		include  DOCUMENTR_ROOT . '/templates/' . self::$config['template'] . '/home.php';
		$contents = ob_get_contents();
		ob_end_clean();
		
		$handle = fopen(self::$config['output_dir'] . '/index.html', 'w');
		fwrite($handle, $contents);
		fclose($handle);
	}
}

function microtime_float () 
{ 
    list ($msec, $sec) = explode(' ', microtime()); 
    $microtime = (float)$msec + (float)$sec; 
    return $microtime; 
}