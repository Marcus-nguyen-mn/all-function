<?php

namespace Notipro\Controller;

class Notification_Promotion{
    function __construct(){
        // add_action( 'wp_ajax_load_promotion', array($this, 'load_noti_promotion') );
        // add_action( 'wp_ajax_nopriv_load_promotion', array($this, 'load_noti_promotion') );
    }
    public function init_Noti(){
        // echo "Nam";
        // die();
    }
    // public function load_noti_promotion(){
    //     ob_start();
    //     $post_new = new WP_Query(array(
    //         'post_type' =>  'noti_promotion',
    //         'posts_per_page'    =>  '5'
    //     ));
     
    //     if($post_new->have_posts()):
    //         echo '<ul>';
    //             while($post_new->have_posts()):$post_new->the_post();
    //                 echo '<li>'.get_the_title().'</li>';
    //             endwhile;
    //         echo '</ul>';
    //     endif; wp_reset_query();
     
    //     $result = ob_get_clean();
    //     wp_send_json_success($result);
    //     die();
    // }

}