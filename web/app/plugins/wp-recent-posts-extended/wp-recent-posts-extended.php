<?php
/*
Plugin Name: WP Recent Posts Extended
Plugin URI: http://vicentegarcia.com
Description: A simple widget for displaying recent posts by category
Author: Vicente García
Author URI: http://vicentegarcia.com
Author email: v@vicentegarcia.com
Version: 1.0.1
License: GPLv2
*/

/**
 * Function to register widget
 */
function wprpe_create_widget(){
    include_once(plugin_dir_path( __FILE__ ).'/inc/wprpe.php');
    register_widget('wprpe');
}
add_action('widgets_init','wprpe_create_widget');
