<?php
/* Staging */
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost');

define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', getenv('WP_SITEURL'));

ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);

// If WordPress is behind a reverse proxy 
if ( (!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) ||
     (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) { 
 
    // http://wordpress.org/support/topic/wordpress-behind-reverse-proxy-1
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
 
    define('WP_HOME', 'http://www.clipstrip.com/blog');
    define('WP_SITEURL', 'http://www.clipstrip.com/blog');
 
    // rewrite blog word with wordpress
    $_SERVER['REQUEST_URI'] = str_replace("blog", "clipstrip", $_SERVER['REQUEST_URI']);
 
    // http://wordpress.org/support/topic/compatibility-with-wordpress-behind-a-reverse-proxy
    // $_SERVER['HTTPS'] = 'on';
} else {
    define('WP_HOME', 'http://104.236.107.210/clipstrip');
    define('WP_SITEURL', 'http://104.236.107.210/clipstrip');
}