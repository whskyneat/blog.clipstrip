<?php

// =============================================================================
// SCRIPT-BUFFER.PHP
// -----------------------------------------------------------------------------
// Shortcodes script buffer for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Script Buffer
// =============================================================================

// Script Buffer
// =============================================================================

class X_Script_Buffer {

  private static $contents;

  public static function init() {
    self::reset();
    add_action( 'wp_footer', array( 'X_Script_Buffer', 'render' ), 99999 );
  }

  public static function start() {
    ob_start();
  }

  public static function end() {
    self::$contents .= ob_get_clean();
  }

  public static function append( $contents ) {
    self::$contents .= $contents;
  }

  public static function reset() {
    self::$contents = '';
  }

  public static function get() {
    return self::$contents;
  }

  public static function render() {
    echo self::get();
  }

}