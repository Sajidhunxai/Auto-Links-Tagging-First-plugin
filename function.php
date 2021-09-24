<?php
/**
*
* @wordpress-plugin
* Plugin Name: sajiddb
* Description: This plugin creates a new table in the database when initialized.
* Author: Aeeiee Inc.
* Author URI: https://www.aeeiee.com
* Version: 1.0.0
* Requires PHP: 7.2
*/

// define absolute ath to void direct access

if(!defined ('ABSPATH')){

  define('ABSPATH', dir(__FILE__). '/');
}


define('DBP_dir', dirname(__FILE__));
define('DBP_url', plugins_url('',__FILE__));
//include database file

include_once("backend/DBP_db_file.php");

//register hook
register_activation_hook(__FILE__,"DBP_tb_create");



add_action('admin_enqueue_scripts','DBP__admin_styles');
// add_action('admin_enqueue_scripts','DBP__admin_scripts');

// function DBP__admin_scripts(){

//   wp_enqueue_script('ajax-js', DBP_url. '/ajax.js','jQuery', '1.0.1', true);
//   wp_enqueue_script('ajax-ss', DBP_url. 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js','jQuery', '1.0.1', true);
//   wp_enqueue_script('ajax-ds', DBP_url. 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js','jQuery', '1.0.1', true);

//   wp_localize_script( 'ajax-js', 'ajax_js_url',
//         array( 
//             'ajaxurl' => admin_url( 'admin-ajax.php' ),
           
//         )
//     );


// }
function DBP__admin_styles(){

    wp_enqueue_style('DBP_styles', DBP_url. 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
    wp_enqueue_style('DBP_styles1', DBP_url. '/assets/css/mainauto.css');
  }



function DBP_add_menu_function(){
  add_menu_page(
    'AutoTag', //page title
    'AutoTag', //menu Title
    'manage_options', //capability
    'autotag-main', //menu slug
    'autotag_list',  //callable function
    DBP_url.'assets/images/icon.png', // icon url
    10

  );
}
add_action('admin_menu','DBP_add_menu_function');


function wporg_options_page()
{
    add_submenu_page(
        'autotag-main',
        'AutoTag Insert',
        'AutoTag Insert',
        'manage_options',
        'autotag-insert',
        'autotag_insert'
    );
}
add_action('admin_menu', 'wporg_options_page');



function autotag_insert(){

  //include Insertion Code
  include_once("backend/DBP_insert_file.php");

}

function autotag_list(){

  //include Insertion Code
  include_once("backend/autotag_list.php");

}
add_action('wp_ajax_DBP_add_front_page','DBP_add_front_page');

function cron_add_to_menu()
{
    add_options_page(__('cron', 'cron') , __('cron', 'cron') , 'manage_options', 'cron', 'cron_admin_option');
}
if (is_admin())
{
    add_action('admin_menu', 'cron_add_to_menu');
}


?>

<?php
include 'autolinktags.php';


?>
