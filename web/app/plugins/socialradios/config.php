<?php
function socialraios_script_prevent() {
	//wp_enqueue_script( 'script-socialradio-jquery', plugins_url() . '/socialradios/jq.js' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'script-socialradio', plugins_url() . '/socialradios/script.js' );
	wp_enqueue_script( 'script-socialradio-history', plugins_url() . '/socialradios/history/jquery.history.js' );
	wp_enqueue_style( 	'style-socialradio', plugins_url() . '/socialradios/style.css' );
}

add_action( 'wp_enqueue_scripts', 'socialraios_script_prevent' );
?>