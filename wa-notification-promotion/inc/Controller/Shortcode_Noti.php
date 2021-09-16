<?php
namespace Notipro\Controller;

class Shortcode_Noti{
    function __construct(){
        add_shortcode( 'noti_promotion', array( $this, 'shortcode_noti' ) );
        add_action('wp_enqueue_scripts',array( $this, 'style_handling' ));
        add_filter('script_loader_tag', array( $this, 'defer_js' ), 10, 2);
    }
    public function shortcode_noti(){
        include PLUGIN_DIR."wa-notification-promotion/inc/View/shortcode_noti_template.php";
    }
    public function style_handling(){
        wp_enqueue_style('wa_noti_pro', plugins_url('wa-notification-promotion/src/css/style_noti.css'));
        wp_enqueue_script('wa_noti_pro', plugins_url('wa-notification-promotion/src/js/noti_promotion.js'),array('jquery'),true);
    }
    public function defer_js($tag, $handle){
        $scripts_to_defer = array('wa_noti_pro');     
        foreach($scripts_to_defer as $defer_script) {
            if ($defer_script === $handle) {
                return str_replace(' src', ' defer src', $tag);
            }
        }
        return $tag;
    }
}