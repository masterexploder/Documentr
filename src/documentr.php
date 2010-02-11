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

// we've passed the config / parse, so we'll clear the output directory
shell_exec('rm -rf ' . $config['output_dir'] . '/*');
shell_exec('cp -f ' . DOCUMENTR_ROOT . '/templates/' . $config['template'] . '/styles.css ' . $config['output_dir']);
shell_exec('cp -rf ' . DOCUMENTR_ROOT . '/templates/' . $config['template'] . '/images ' . $config['output_dir']);

// build the home page
ob_start();
include  DOCUMENTR_ROOT . '/templates/' . $config['template'] . '/home.php';
$contents = ob_get_contents();
ob_end_clean();

// and write it...
$handle = fopen($config['output_dir'] . '/index.html', 'w');
fwrite($handle, $contents);
fclose($handle);