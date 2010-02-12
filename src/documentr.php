<?php

require_once dirname(__FILE__) . '/Documentr.inc.php';

$start = microtime_float();

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

$end = microtime_float(); 
echo "\n----------------------------\n";
echo "Docs generated in " . round($end-$start, 5) . " seconds.\n";
echo "\n";