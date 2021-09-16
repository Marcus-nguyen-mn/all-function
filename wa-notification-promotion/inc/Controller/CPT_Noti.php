<?php
namespace Notipro\Controller;

class CPT_Noti{
    function __construct(){
        add_action('init', array( $this, 'cpt_noti' ));
    }
    public function cpt_noti(){
        $label = array(
            'name' => 'Promotion Notice',
            'singular_name' => 'Promotion Notice'
        );
        $args = array(
            'labels' => $label,
            'description' => 'Post type promotion notice',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
                'comments',
                'trackbacks',
                'revisions',
                'custom-fields'
            ),
            'taxonomies' => array( 'post_tag' ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-megaphone',
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post' 
        );
    
        register_post_type('noti_promotion', $args);
    }
}