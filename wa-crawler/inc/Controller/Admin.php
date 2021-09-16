<?php
namespace Wolfactive\Controller;

class Admin{
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'register_option_page' ) );
        add_action('admin_enqueue_scripts',array( $this, 'add_js_css' ));
        add_filter('script_loader_tag', array( $this, 'defer_js' ), 10, 2);
    }
    public function register_option_page(){
        add_menu_page(
            __( 'Crawler Setting', 'textdomain' ),
            __( 'Crawler Setting', 'textdomain' ),
            'manage_options',
            'crawler_setting',
            array(
                $this,
                'render_option_page'
            ),
            'dashicons-marker'
        );
    }
    public function render_option_page(){
        include PLUGIN_DIR."wa-crawler/inc/View/crawler_setting_template.php";
    }
    public function add_js_css(){
        $log_file = PLUGIN_DIR."wa-crawler/debug.html";
        $screen = get_current_screen();
        ob_start();
        echo '<pre><code>';
        print_r($screen);
        $log = ob_get_clean();
        echo '</code></pre>';
        file_put_contents($log_file, $log);
        if ( 'toplevel_page_crawler_setting' != $screen->base ) {
            return;
        }
        $script = "var apiObject = " . wp_json_encode(array('rootapiurl' => rest_url(),'nonce' => wp_create_nonce('wp_rest'))). ';';
        if ( ! empty( $data ) ) {
            $script = "$data\n$script";
        }
        _e("\n<script type=\"text/javascript\">\n $script \n</script>\n",'_themename');
        // wp_enqueue_style('wa_crw', plugins_url('src/bootstrap.css',__FILE__ ));
        wp_enqueue_script('wa_crw', plugins_url('wa-crawler/src/js/setting_crawler.js'),array('jquery'),true);
    }
    public function defer_js($tag, $handle){
        $scripts_to_defer = array('wa_crw');     
        foreach($scripts_to_defer as $defer_script) {
            if ($defer_script === $handle) {
                return str_replace(' src', ' defer src', $tag);
            }
        }
        return $tag;
    }
}