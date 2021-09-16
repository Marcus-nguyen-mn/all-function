<?php
namespace Diva\API {
    use Diva\API\Cart\Cart;

    class Api{

        /**
         * Api constructor.
         */
        function __construct(){
            new Cart();
        }

        /**
         * @param $php_array
         */
        static public function api_return_json($php_array ) {
            // encode result as json string
            $json_result = json_encode( $php_array );
            // return result
            die( $json_result );
            // stop all other processing
            exit;
        }
    }
}
