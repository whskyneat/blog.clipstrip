<?php

/*

Plugin Name: X &ndash; Shortcodes
Plugin URI: http://theme.co/x/
Description: This plugin is required to run X as it includes all of our shortcode functionality, which is tightly integrated into the theme.
Version: 2.5.2
Author: Themeco
Author URI: http://theme.co/
Text Domain: __x__
X Plugin: x-shortcodes

*/

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Initialize the Plugin and Require Files
// =============================================================================

// Define Constants
// =============================================================================

define( 'X_SHORTCODES_VERSION', '2.5.2' );
define( 'X_SHORTCODES_URL', plugins_url( '', __FILE__ ) );



// Initialize the Plugin and Require Files
// =============================================================================

function x_shortcodes_init() {

  //
  // Load plugin textdomain.
  //

  load_plugin_textdomain( '__x__', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );


  //
  // Include frontend functionality.
  //

  require_once( 'functions/version-output.php' );
  require_once( 'functions/script-buffer.php' );
  require_once( 'functions/get-option.php' );
  require_once( 'functions/has-shortcode.php' );
  require_once( 'functions/shortcodes.php' );


  //
  // Enqueue styles and scripts.
  //

  require_once( 'functions/enqueue/styles.php' );
  require_once( 'functions/enqueue/scripts.php' );


  //
  // Initialize the script buffer.
  //

  X_Script_Buffer::init();

}

add_action( 'init', 'x_shortcodes_init' );

require_once( 'functions/admin/user.php' );
require_once( 'functions/admin/shortcode-generator.php' );