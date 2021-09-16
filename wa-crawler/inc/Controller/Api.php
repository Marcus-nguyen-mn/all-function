<?php
namespace Wolfactive\Controller;
use Wolfactive\Model\api\Save_Link_Crawler;

class Api{
    /**run Api */
    function __construct() {
        $this->api_register();
    }

    public function api_register() {
        new Save_Link_Crawler();
    }
    
    static public function api_return_json( $php_array ) {  
        // encode result as json string
        $json_result = json_encode( $php_array );   
        // return result
        die( $json_result );    
        // stop all other processing 
        exit;
    }
}