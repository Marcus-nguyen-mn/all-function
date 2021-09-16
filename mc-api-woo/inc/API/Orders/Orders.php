<?php
namespace Diva\API\Orders;

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

class Orders{
    function __construct() {
        add_action('rest_api_init', array($this, 'init_api'));
    }

    /**
     * init_api
     *
     * @return void
     */
    public function init_api(){
        register_rest_route('add-orders/v1', '/orders', array(
            'methods' => $this->get_methods(),
            'callback' => array($this,'callback'),
             'permission_callback' => $this->get_permission_callback(),
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
            $result = [
                'message'      => "Can't add new order",
                'data_orders'         => [],
                'code'         => 400,
            ];
            $new_order=[];
            
            $order_args = array(
                'customer_id'   => 1,
            );
            $new_order = wc_create_order($order_args);

            // add product
            $new_order->add_product( get_product(52), 2, $args);
            // Set payment gateways
            $gateways = WC()->payment_gateways->payment_gateways();
            $new_order->set_payment_method( $gateways['bacs'] );
            // Next we update the address details
            $billing_address = array(
                'first_name' => 'Nam',
                'last_name'  => 'Nguyen',
                // 'email'      => get_user_meta( $user_id, 'billing_email', true ),
                'phone'      => '0937248602',
                'address_1'  => 'Binh hoa',
                'address_2'  => 'Binh duong',
                // 'city'       => get_user_meta( $user_id, 'billing_city', true ),
            );
            
            $new_order->set_address( $billing_address, 'billing' ); 
            $result['message'] = "done";
            $result['code'] = 200;
            $result['data_orders'] = $new_order;
            Api::api_return_json($result);
    }

    /**
     * Get the callback used to validate a request to the REST API endpoint.
     *
     * @return callable
     */
    public function get_permission_callback(){
        return '__return_true';
    }

    /**
     * Get the HTTP methods that the REST API endpoint responds to.
     *
     * @return mixed
     */
    public function get_methods(){
        return 'POST';
    }

}