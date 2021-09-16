<?php
/**
* Plugin Name:       Diva API Entry Point Woo
* Plugin URI:        https://wolfactive.dev
* Description:       Plugin created by Nam Nguyễn - IT DIVA TEAM
* Version:           1.0
* Author:            Marcus Nguyen(Nam Nguyễn)
* Author URI:        https://wolfactive.dev
* License:           GPL v2
**/

require __DIR__ . '/vendor/autoload.php';
use Diva\API\Api;

new Api();