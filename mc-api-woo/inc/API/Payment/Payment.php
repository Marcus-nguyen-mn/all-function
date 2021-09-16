<?php
namespace Diva\API\Payment;

use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;
use WP_Query;
use Diva\API\ApiInterface;
use Diva\API\Api;
use WC;
use WC_Session_Handler;
use WC_Customer;
use WC_Cart;
use DOMDocument;
use DOMXPath;

// define( 'APP_TOKEN', '3acf6c5c9290898167983c316b132c2e' );

class Payment{
    function __construct() {
        add_action('rest_api_init', array($this, 'init_api'));
    }

    /**
     * init_api
     *
     * @return void
     */
    public function init_api(){
        register_rest_route('payment-api/v1', '/payment/(?P<orderid>\d+)', array(
            'methods' => $this->get_methods(),
            'callback' => array($this,'callback'),
            // 'permission_callback' => $this->get_permission_callback(),
        ));
    }

    /**
     * callback
     *
     * @return void
     */
    public function callback( $data_callback ){
        $request = $this->prefix_callback($data_callback['orderid']);
        return rest_ensure_response($request);
    }

    /**
     * prefix_callback
     *
     * @return void
     */
    public function prefix_callback($orderid){
            // $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            $result = [
                'message'      => "Can't Payment",
                'data_payment'         => [],
                'code'         => 400,
            ];
            $data =[];
            $data_product=[];
            $order = wc_get_order( $orderid );
            if($order){
                $idorders = $order->get_id();
                $dateOrder = $order->get_date_created();
                $currency  = $order->get_currency();
                $total_payment = $order->get_total();
                $payment_method = $order->get_payment_method();
                foreach ( $order->get_items() as $item_id => $item ) {
                    array_push($data_product,array(
                        'name_product' => $item->get_name(),
                        'total' => $item->get_total(),
                    ));
                }
                $data = array(
                    'id' => $idorders,
                    'date' => $dateOrder,
                    'email' => $order->get_user()->data->user_email,
                    'currency'=>$currency,
                    'total_payment' => $total_payment,
                    'payment_method' => $payment_method,
                    'detail_order'=>$data_product,
                );
                $result['message'] = 'Done !';
                $result['code'] = 200;
            }
            else{
                $result['message'] = "Can't Payment, Order is null";
                $result['code'] = 200;
            }
            $result['data_payment'] = $data;
            Api::api_return_json($result);
    }

    /**
     * Get the callback used to validate a request to the REST API endpoint.
     *
     * @return callable
     */
    public function get_permission_callback(){
        return '__return_false';
    }

    /**
     * Get the HTTP methods that the REST API endpoint responds to.
     *
     * @return mixed
     */
    public function get_methods(){
        return 'GET';
    }

}