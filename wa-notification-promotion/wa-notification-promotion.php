<?php
/*
Plugin Name: WA Notification Promotion
Plugin URI: https://wolfactive.dev
Description: This is plugin notification promotion
Version: 1.0
Author: Marcus Nguyen (Nam Nguyen)
Author URI: https://wolfactive.dev
License: GPLv2
*/

require __DIR__ . '/vendor/autoload.php';

define ("PLUGIN_DIR",plugin_dir_path( __DIR__ ));

use Notipro\Controller\Notification_Promotion;
use Notipro\Controller\CPT_Noti;
use Notipro\Controller\Shortcode_Noti;

new Notification_Promotion();
new CPT_Noti();
new Shortcode_Noti();