<?php
/*
Plugin Name: WA Roll Call
Plugin URI: https://wolfactive.dev
Description: This is plugin roll call
Version: 1.0
Author: Marcus Nguyen (Nam Nguyen)
Author URI: https://wolfactive.dev
License: GPLv2
*/

require __DIR__ . '/vendor/autoload.php';

define ("PLUGIN_DIR",plugin_dir_path( __DIR__ ));

use Rollcall\Controller\Roll_Call;
use Rollcall\Controller\Shortcode_Roll_Call;


new Roll_Call();
new Shortcode_Roll_Call();