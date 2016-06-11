<?php
/**
 * Plugin Name: Fresh Pages
 * Description: Installs dummy pages on a freshly setup blog.
 * Author: Bimal Poudel
 * Author URI: http://bimal.org.np/
 * Plugin URI: https://github.com/bimalpoudel/fresh-pages
 * Version: 1.0.0
 */

define('__PLUGIN_FRESH_PAGES__', dirname(__FILE__));
require_once(__PLUGIN_FRESH_PAGES__.'/classes/class.fresh_pages.inc.php');

$fresh_pages = new fresh_pages();
$fresh_pages->init(basename(dirname(__FILE__)).'/'.basename(__FILE__));
