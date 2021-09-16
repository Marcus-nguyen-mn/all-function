<?php

namespace Wolfactive\Model\api;

use Wolfactive\Controller\Api;

class Save_Link_Crawler{
    function __construct(){
        add_action('rest_api_init',array( $this, 'save_link_crawler' ));
    }
    function save_link_crawler(){
        register_rest_route('wa-option/v1','/save-link-crawler',array(
            'methods'   =>  "POST",
            'callback'  =>  array( $this, 'save_link_crawler_callback' ),   
            'permission_callback' => '__return_true',
        ));
    }
    function save_link_crawler_callback($request){
        $submit = $this->prefix_save_link_crawler_callback();
        return rest_ensure_response($submit);
    }
    function prefix_save_link_crawler_callback (){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            //Receive the RAW post data.
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            // setup default result data
            $result = array(            
                'status' => 0,
                'message' => '',
                'error'=>'',           
            );
            if (wp_verify_nonce( $decoded['wp_rest'], 'wp_rest' )) {
                $slug = $decoded['slug'];
                get_option( 'wa_slug') ?  update_option( 'wa_slug', $slug, 'yes' ) :   add_option( 'wa_slug', $slug, '', 'yes' );
                $result = "complete";
            Api::api_return_json($result);
            }
        }
    }

}