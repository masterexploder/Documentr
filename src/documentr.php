<?php
/**
 * Documentr Processor File
 *
 * This is the main processor file for the Documentr package.  It more or less
 * runs the various functions needed to generate documentation.
 *
 * @package Documentr
 * @author Ian Selby <ian@gen-x-design.com>
 * @copyright 2010 Ian Selby
 * @license http://www.opensource.org/licenses/mit-license.php
 * @version 0.1.0
 * @link http://documentr.gxdlabs.com
 *
 */

require_once dirname(__FILE__) . '/Documentr.inc.php';

$start = Documentr::microtime_float();

// get everything set up
Documentr::init();

// parse the config into guides and an index
echo "\n>>> Creating Documentation For " . Documentr::$config['name'] . " <<<\n\n";
Documentr::parseConfig();

// we've passed the config / parse, so we'll clear the output directory
echo "Clearing output directory...";
Documentr::cleanOutputDir();
echo "\tdone\n";

echo "Building guide pages...\n";
// build the guide pages
Documentr::buildGuides();

// build the homepage
echo "Building home page...";
Documentr::buildHome();
echo "\tdone\n";

$end = Documentr::microtime_float(); 
echo "\n----------------------------\n";
echo "Docs generated in " . round($end-$start, 5) . " seconds.\n";
echo "\n";