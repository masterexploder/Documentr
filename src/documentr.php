<?php

// define a few important paths
define('DOCUMENTR_ROOT', dirname(dirname(__FILE__)));
define('SRC_ROOT', DOCUMENTR_ROOT . '/src');
define('LIB_ROOT', SRC_ROOT . '/lib');

// include our lib functions...
require_once LIB_ROOT . '/markdown/markdown.php';
require_once LIB_ROOT . '/sfy_yaml/sfYaml.php';

$config	= sfYaml::load(DOCUMENTR_ROOT . '/config.yml');
$guides	= array();
$index	= array();

// print_r($config);

echo "\n>>> Creating Documentation For {$config['name']} <<<\n";

// parse the config into guides and an index...
foreach ($config['guides'] as $section => $group)
{
	$indexArray	= array();
	
	foreach ($group as $guide => $data)
	{
		$guides[$guide] 	= $data;
		$indexArray[] 		= $guide;
	}
	
	$index[$section] = $indexArray;
}