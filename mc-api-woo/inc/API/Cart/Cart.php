<?php
namespace Diva\API\Cart;

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

class Cart implements ApiInterface{
    function __construct() {
        add_action('rest_api_init', array($this, 'init_api'));
    }

    /**
     * init_api
     *
     * @return void
     */
    public function init_api(){
        register_rest_route('cart-api/v1', '/cart/token=3acf6c5c9290898167983c316b132c2e', array(
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
    public function callback(){
        $request = $this->prefix_callback();
        return rest_ensure_response($request);
    }

    /**
     * prefix_callback
     *
     * @return void
     */
    public function prefix_callback(){
            // $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            $result = [
                'message'      => "Can't load data",
                'data_cart'         => [],
                'code'         => 400,
            ];
            $data = [];
            WC()->frontend_includes();
            WC()->session = new WC_Session_Handler();
            WC()->session->init();
            WC()->customer = new WC_Customer( get_current_user_id(), true );
            WC()->cart = new WC_Cart();
            // $user_id = 123;
            // $session_handler = new WC_Session_Handler();
            // $session = $session_handler->get_session($user_id);
            // $cart_items = maybe_unserialize($session['cart']);
            $cart = WC()->cart->get_cart();
            if($cart){
              foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                 $product_cart = $cart_item['data'];
                 $price_item = get_post_meta($cart_item['product_id'] , '_price', true);
                 $title_item = $product_cart->get_title();
                 // $img_item = $product_cart->get_image(array( 100, 100));
                 $quantity = $cart_item['quantity'];
                 $link = $product_cart->get_permalink( $cart_item );
                 // $price_item = WC()->cart->get_product_price($product_cart);
                 $total_cart = WC()->cart->total;
                 $currency = get_woocommerce_currency();
                 $html = $product_cart->get_image(array( 100, 100));
                  $doc = new DOMDocument();
                  $doc->loadHTML($html);
                  $xpath = new DOMXPath($doc);
                  $src_thumb = $xpath->evaluate("string(//img/@src)");
                 array_push($data,array(
                     'item_cart' => array(
                       'title' => $title_item,
                       'thumbnail' => $src_thumb,
                       'quantity' => $quantity,
                       'permalink' => $link,
                       'price_item' => $price_item,
                     ),
                     'total_cart' => $total_cart,
                     'currency' => $currency
                 ));
                 $result['message'] = 'Data Loaded';
                 $result['code'] = 200;
              }
            }
            else{
              $result['message'] = 'No data to load';
              $result['code'] = 200;
            }
            $result['data_cart'] = $data;
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
        return 'POST';
    }

}
