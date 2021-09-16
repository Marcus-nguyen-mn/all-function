<?php
namespace Rollcall\Controller;

class Shortcode_Roll_Call{
    function __construct(){
        add_shortcode( 'roll_call', array( $this, 'template_roll_call' ) );
        add_action('wp_enqueue_scripts',array( $this, 'style_handling' ));
        add_action('admin_enqueue_scripts',array( $this, 'style_handling' ));
        add_filter('script_loader_tag', array( $this, 'defer_js' ), 10, 2);
        add_filter('script_loader_tag', array( $this, 'defer_js_mc' ), 10, 2);
    }
    public function template_roll_call(){
        include PLUGIN_DIR."roll-call/inc/View/template_roll_call.php";
    }
    public function style_handling(){
        wp_enqueue_style('wa_roll_call', plugins_url('roll-call/src/css/main.css'));
        wp_enqueue_style('wa_roll_call_mcs', plugins_url('roll-call/src/css/mc.css'));
        wp_enqueue_script('wa_roll_call', plugins_url('roll-call/src/js/main.min.js'),array('jquery'),true);
        wp_enqueue_script('wa_roll_call_mc', plugins_url('roll-call/src/js/mc.js'),array('jquery'),true);
    }
    public function defer_js($tag, $handle){
        $scripts_to_defer = array('wa_roll_call');     
        foreach($scripts_to_defer as $defer_script) {
            if ($defer_script === $handle) {
                return str_replace(' src', ' defer src', $tag);
            }
        }
        return $tag;
    }
    public function defer_js_mc($tag, $handle){
        $scripts_to_defer = array('wa_roll_call_mc');     
        foreach($scripts_to_defer as $defer_script) {
            if ($defer_script === $handle) {
                return str_replace(' src', ' defer src', $tag);
            }
        }
        return $tag;
    }

}