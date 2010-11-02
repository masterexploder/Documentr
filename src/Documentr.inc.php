<?php
/**
 * Documentr Class Definition File
 *
 * This file contains the class definition for the Documentr class.
 *
 * @package Documentr
 * @author Ian Selby <ian@gen-x-design.com>
 * @copyright 2010 Ian Selby
 * @license http://www.opensource.org/licenses/mit-license.php
 * @version 0.1.0
 * @link http://documentr.gxdlabs.com
 *
 */


// define a few important paths
if (!defined('DOCUMENTR_ROOT'))
{
	define('DOCUMENTR_ROOT', (dirname(__FILE__)));
}
define('SRC_ROOT', dirname(__FILE__));
define('LIB_ROOT', SRC_ROOT . '/lib');

// include our lib functions...
require_once LIB_ROOT . '/markdown/markdown.php';
require_once LIB_ROOT . '/sfy_yaml/sfYaml.php';

/**
 * Documentr Class
 *
 * This is the meat of the whole Documentr package.  It contains all the functions that parse and
 * build your documentation
 * 
 * @package Documentr
 */
class Documentr
{
	/**
	 * The parsed configs
	 *
	 * This is loaded from the config.yml file
	 *
	 * @var array
	 */
	public static $config;
	/**
	 * The guide index
	 *
	 * This array contains the parsed "index" of the guides.  That is, the groups and actual
	 * guides themselves are organized into an index and used to build the home page and the "Guide Index"
	 * goodness on all the doc pages
	 *
	 * @var array
	 */
	public static $index;
	/**
	 * The actual guides
	 *
	 * This array contains all the guides themselves and various information about them
	 *
	 * @var array
	 */
	public static $guides;
	/**
	 * The number of guides that exist
	 *
	 * @var int
	 */
	public static $numGuides = 0;
	/**
	 * The template root
	 *
	 * This will be either a template directory specified in the config, or
	 * the default template root
	 *
	 * @var string
	 */
	public static $templateRoot	= null;
	
	/**
	 * Initializes the static class members
	 *
	 * Also checks to make sure the config.yml file exists in the current 
	 * working directory
	 *
	 * @return void
	 */
	public static function init ()
	{
		if (!file_exists(DOCUMENTR_ROOT . '/config.yml'))
		{
			echo "\nCould not find config.yml file.\n\n";
			exit;
		}
		
		self::$config	= sfYaml::load(DOCUMENTR_ROOT . '/config.yml');
		self::$guides	= array();
		self::$index	= array();
	}
	
	/**
	 * Parses the config file
	 *
	 * @return void
	 */
	public static function parseConfig ()
	{
		foreach (self::$config['guides'] as $section => $group)
		{
			$indexArray	= array();

			foreach ($group as $guide => $data)
			{
				self::$guides[$guide] 	= $data;
				$indexArray[] 			= $guide;
				self::$numGuides++;
			}

			self::$index[$section] = $indexArray;
		}
		
		// see what guides actually exist in the filesystem
		foreach (self::$guides as $name => $guide)
		{
			if (file_exists(self::$config['source_dir'] . '/' . $guide['source_file']))
			{
				self::$guides[$name]['exists'] = true;
			}
			else
			{
				self::$guides[$name]['exists'] = false;
			}
		}
		
		if (isset(self::$config['template_dir']))
		{
			self::$templateRoot = DOCUMENTR_ROOT . '/' . self::$config['template_dir'];
		}
		else
		{
			self::$templateRoot = SRC_ROOT . '/templates';
		}
	}
	
	/**
	 * Cleans the output directory
	 *
	 * Also copies the base template styles, images, etc., as well as local images to the output dir
	 *
	 * @return void
	 */
	public static function cleanOutputDir ()
	{
		shell_exec('rm -rf ' . self::$config['output_dir'] . '/*');
		shell_exec('cp -f '  . self::$templateRoot . '/' . self::$config['template'] . '/styles.css ' . self::$config['output_dir']);
		shell_exec('cp -rf ' . self::$templateRoot . '/' . self::$config['template'] . '/images ' . self::$config['output_dir']);
		shell_exec('cp -rf ' . self::$templateRoot . '/' . self::$config['template'] . '/scripts ' . self::$config['output_dir']);
		
		if (file_exists(DOCUMENTR_ROOT . '/' . self::$config['source_dir'] . '/images'))
		{
			shell_exec('cp -rf ' . DOCUMENTR_ROOT . '/' . self::$config['source_dir'] . '/images ' . self::$config['output_dir']);
		}
	}
	
	/**
	 * Builds all the guides
	 *
	 * @return void
	 */
	public static function buildGuides ()
	{
		foreach (self::$guides as $name => $guide)
		{
			$guideInfo = $guide;
			
			if ($guideInfo['exists'] == true)
			{
				echo " [build] $name...";
				
				$contents 	= file_get_contents(self::$config['source_dir'] . '/' . $guideInfo['source_file']);
				$title		= $name;
				$header		= null;
				$body		= null;
				
				// check for an introduction / body
				if (stristr($contents, '-----BODY-----') !== false)
				{
					$parts = explode('-----BODY-----', $contents, 2);
					
					$header = $parts[0];
					$body	= $parts[1];
				}
				else
				{
					$body	= $contents;
				}
				
				$header = ($header === null) ? '' : Markdown($header);
				$body	= Markdown($body);
				$config	= self::$config;
				$index	= self::$index;
				$guides	= self::$guides;
				
				list($body, $toc) = self::buildToc($body);
				
				ob_start();
				include  self::$templateRoot . '/' . self::$config['template'] . '/guide.php';
				$contents = ob_get_contents();
				ob_end_clean();
				
				$handle = fopen(self::$config['output_dir'] . '/' . str_replace('.md', '.html', $guideInfo['source_file']), 'w');
				fwrite($handle, $contents);
				fclose($handle);
				
				echo "\tdone\n";
			}
			else
			{
				echo " [skip] $name \n";
			}
		}
	}
	
	/**
	 * Builds the home page
	 *
	 * @return void
	 */
	public static function buildHome ()
	{
		// make the static items available locally...
		$config	= self::$config;
		$index	= self::$index;
		$guides	= self::$guides;
		
		ob_start();
		include  self::$templateRoot . '/' . self::$config['template'] . '/home.php';
		$contents = ob_get_contents();
		ob_end_clean();
		
		$handle = fopen(self::$config['output_dir'] . '/index.html', 'w');
		fwrite($handle, $contents);
		fclose($handle);
	}
	
	/**
	 * Builds the table of contents for a guide
	 *
	 * @param string $contents The body to parse
	 * @return array
	 */
	protected static function buildToc ($contents)
	{
		preg_match_all('/<h([1-4])>(.*?)<\/h[1-4]>/', $contents, $matches);
		
		$priorLevel = 1;
		$toc		= array();
		$currentKey	= null;
		
		foreach ($matches[0] as $key => $value)
		{
			$level 	= $matches[1][$key];
			$name	= $matches[2][$key];
			
			if ($level == 1)
			{
				$toc[$name] = array();
				$currentKey = $name;
			}
			elseif ($level == 2)
			{
				$toc[$currentKey][] = $name;
			}
		}
		
		foreach ($toc as $key => $value)
		{
			$id			= strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9 -]/', '', $key)));
			$contents	= str_replace('<h1>' . $key . '</h1>', '<h1 id="' . $id . '">' . $key . '</h1>', $contents);
			
			foreach ($value as $name)
			{
				$id			= strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9 -]/', '', $name)));
				$contents	= str_replace('<h2>' . $name . '</h2>', '<h2 id="' . $id . '">' . $name . '</h2>', $contents);
			}
		}
		
		return array($contents, $toc);
	}
	
	/**
	 * Returns the current microtime as a float
	 *
	 * @return float
	 */
	public static function microtime_float () 
	{ 
	    list ($msec, $sec) = explode(' ', microtime()); 
	    $microtime = (float)$msec + (float)$sec; 
	    return $microtime; 
	}
}