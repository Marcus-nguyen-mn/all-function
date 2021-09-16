<?php
namespace Rollcall\Controller;

class Roll_Call{
    function __construct(){
        add_action( 'show_user_profile', array( $this, 'crf_show_extra_profile_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'crf_show_extra_profile_fields' ) );
        add_action( 'activated_plugin', array( $this, 'rc_create_db' ), 10, 2 );
        add_action( 'wp_ajax_nopriv_get_data_date', array( $this, 'get_data_date' ));
        add_action( 'wp_ajax_get_data_date', array( $this, 'get_data_date' ) );
        add_action( 'wp_ajax_nopriv_get_data_date_admin', array( $this, 'get_data_date_admin' ));
        add_action( 'wp_ajax_get_data_date_admin', array( $this, 'get_data_date_admin' ) );
        add_action( 'wp_ajax_nopriv_save_data_date', array( $this, 'save_data_date' ));
        add_action( 'wp_ajax_save_data_date', array( $this, 'save_data_date' ) );
        add_action( 'wp_ajax_nopriv_ss_data_date', array( $this, 'ss_data_date' ));
        add_action( 'wp_ajax_ss_data_date', array( $this, 'ss_data_date' ) );
    }
    public function crf_show_extra_profile_fields( $user ) {
        $year = get_the_author_meta( 'year_of_birth', $user->ID );
        $renderCalender = '<div class="calender_admin" id="calenderAdmin" data-usi="'.$user->ID.'" style="width: 50%;"><div>';
        echo $renderCalender;
    }
    public function rc_create_db(){
        global $wpdb;
        $charsetCol = $wpdb->get_charset_collate();
        $rollcallTable = $wpdb->prefix . 'roll_call';
        $createRollCallTable = "CREATE TABLE IF NOT EXISTS `{$rollcallTable}` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `start` varchar(255) NOT NULL,
            `user_id` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        ) {$charsetCol};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createRollCallTable );
    } 
    public function get_data_date() {
        $userIdCurrent = $_POST['userIdCurrent'];
        global $wpdb;
        $table = $wpdb->prefix . 'roll_call';
        $sql = "SELECT * FROM {$table} WHERE `user_id` = $userIdCurrent";
        $data = $wpdb->get_results($sql);
        echo json_encode($data);
        exit;
    }
    public function get_data_date_admin() {
        $userIdCurrentAdmin = $_POST['userIdCurrentAdmin'];
        global $wpdb;
        $table = $wpdb->prefix . 'roll_call';
        $sql = "SELECT * FROM {$table} WHERE `user_id` = $userIdCurrentAdmin";
        $data = $wpdb->get_results($sql);
        echo json_encode($data);
        exit;
    }
    public function save_data_date() {
        $titleSave = $_POST['title'];
        $startSave = $_POST['start'];
        $userId = $_POST['userId'];
        $data = array(
            'title' => $titleSave,
            'start' => $startSave,
            'user_id' => $userId
        );
        global $wpdb;
        $table = $wpdb->prefix . 'roll_call';
        $result_check = $wpdb->insert(
            $table,
            $data
        );
        if($result_check){
            $tf = array(
                'result' => 'true'
            );
            echo json_encode($tf);
        }else{
            $tf = array(
                'result' => 'flase'
            );
            echo json_encode($tf);
        }
        exit;
        
    }
    public function ss_data_date() {
        $startPo = $_POST['start1'];
        $userIdSS = $_POST['userIdSS'];
        $value = "'".$startPo."'";
        global $wpdb;
        $table = $wpdb->prefix . 'roll_call';
        $sql = "SELECT * FROM {$table} WHERE `start` = $value AND `user_id` = $userIdSS";
        $data = $wpdb->get_results($sql);
        if($data){
            $tfa = array(
                'result' => 'true'
            );
            echo json_encode($tfa);
        }
        else{
            $tfa = array(
                'result' => 'false'
            );
            echo json_encode($tfa);
        }
        exit;
        
    }
}