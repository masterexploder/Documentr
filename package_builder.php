<?php

require_once 'PEAR/PackageFileManager2.php';

$packageXml	= new PEAR_PackageFileManager2();

$e = $packageXml->setOptions(array
(
	'baseinstalldir'	=> 'Documentr',
	'packagedirectory'	=> dirname(__FILE__) . '/src',
	'state'				=> 'beta',
	'installexceptions'	=> array('documentr' => '/'),
	'exceptions'		=> array('documentr' => 'script'),
	'dir_roles'			=> array('docs' => 'doc', 'lib' => 'php', 'templates' => 'php'),
	'notes'				=> '-'
));

$packageXml->setPackage('Documentr');
$packageXml->setSummary('Generate Sexy Documentation From Markdown');
$packageXml->setDescription('Generate Sexy Documentation From Markdown');
$packageXml->setChannel('pear.gxdlabs.com');

$packageXml->setAPIVersion('0.1.4');
$packageXml->setReleaseVersion('0.1.4');
$packageXml->setReleaseStability('beta');
$packageXml->setAPIStability('beta');

$packageXml->setNotes('-');
$packageXml->setPackageType('php');

$packageXml->addRelease();

$packageXml->setPhpDep('5.2.0');
$packageXml->setPearinstallerDep('1.4.0');

$packageXml->addMaintainer('lead', 'masterexploder', 'Ian Selby', 'ian@gen-x-design.com');
$packageXml->setLicense('MIT License', 'http://www.opensource.org/licenses/mit-license.php');

$packageXml->generateContents();

// $e = $packageXml->debugPackageFile();
$e = $packageXml->writePackageFile();