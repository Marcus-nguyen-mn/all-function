<?php 
/**
 * Plugin Name:       Wolfactive Crawler Story
 * Plugin URI:        https://wolfactive.dev
 * Description:       Pluing crawler story created by Wolf Active
 * Version:           1.0
 * Author:            Marcus Nguyen - Huy Nguyen
 * Author URI:        https://wolfactive.dev
 * License:           GPL v2
**/
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/inc/Model/simple_html_dom.php';

define ("PLUGIN_DIR",plugin_dir_path( __DIR__ ));

use Wolfactive\Controller\Crawler_WA;
use Wolfactive\Controller\Admin;
use Wolfactive\Controller\Api;

new Crawler_WA();
new Admin();
new Api();