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

// use Automattic\WooCommerce\Client;

// $woocommerce = new Client(
//     'http://localhost/nta-woocomere',
//     'ck_a47e9526ba4e1445a727b4a16c2ddf28eb090358',
//     'cs_6d242bc450f0d5ce65362e4571d43ae6ae13c42f',
//     [
//         'wp_api' => true,
//         'version' => 'wc/v3',
//         // 'query_string_auth' => true // Force Basic Authentication as query string true and using under HTTPS
//     ]
// );
// print_r($woocommerce->get('products'));

new Api();
