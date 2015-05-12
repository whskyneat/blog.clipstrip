<?php
/*
 * Plugin Name: Meta Slider - Pro Addon Pack
 * Plugin URI: http://www.metaslider.com
 * Description: Supercharge your slideshows!
 * Version: 2.3.2
 * Author: Matcha Labs
 * Author URI: http://www.matchalabs.com
 */

/**
 * Changelog:
 *
 * 2.3.2
 * - Post Feed: Fix Taxonomy restriction
 *
 * 2.3.1
 * - Menu Order added to Post Feed Slide
 * - Post Content (With Formatting) option added to Post Feed Slide
 *
 * 2.3
 * - Filmstrip navigation option added (Flex Slider)
 * - Layer Scaling options added
 *
 * 2.3-beta (internal)
 * - New Feature: Layer Slide background link, SEO options
 * - Change: Tabbed interface on all slides
 *
 * 2.2.8 (internal)
 * - Fix: Orderby parameter on Post Feed slides
 *
 * 2.2.7 (internal)
 * - Change: Add List item classes to slide types (flexslider only)
 *
 * 2.2.6 (internal)
 * - Change: Add metaslider_post_feed_caption filter
 *
 * 2.2.5 (internal)
 * - Fix: Vimeo auto play bug (When first slide is set to autoPlay)
 *
 * 2.2.4
 * - Fix: Allow layers to scale up past 100%
 *
 * 2.2.3
 * - Fix: Post Feed/Nivo Slider captions (for Meta Slider 2.6)
 *
 * 2.2.2
 * - Fix: PHP Warnings
 *
 * 2.2.1
 * - Fix: Invalid CSS
 *
 * 2.2
 * - New Feature: Auto Play setting for YouTube videos
 * - New Feature: Auto Play setting for Vimeo videos
 * - Fix: Force CKEditor to use 'en' lang files
 * - TGM Plugin activation check for Meta Slider Lite
 *
 * 2.1.2 (internal)
 * - Fix: WPML: Check 'is_plugin_active' function exists before calling
 *
 * 2.1.1 (internal)
 * - Change: Lang files removed from CKEditor to reduce plugin size
 * - Change: Images in Layers given a max-width
 * - Improvement: Fix to work with 'SvegliaT buttons' plugin
 *
 * 2.1 (internal)
 * - Improvement: YouTube & Vimeo settings
 * - Fix: Reset wp_query after post feed to fix comment setting on page
 *
 * 2.0.4
 * - Fix: Responsive layer scaling
 *
 * 2.0.3
 * - Fix: Strict warning for Walker Class compatibility (Since WP3.6 change)
 *
 * 2.0.2
 * - Improvement: "Title & Excerpt" option added for post feed caption
 * - Fix: Responsive slider - Pause Vimeo/YouTube when navigating to next slide
 *
 * 2.0.1
 * - Fix: Vimeo HTTPS
 * - Fix: Hover Pause is now compatible with YouTube slides (Flex Slider)
 * - Fix: Play/Pause video functionality and Auto Play (Flex Slider)
 * - Improvement: Responsive Slides output tidied up for YouTube & Vimeo slides
 *
 * 2.0
 * - New Feature: Thumbnail navigation for Flex & Nivo Slider
 * - Improvement: Pro functionality refactored into 'modules'
 * - Improvement: Theme editor CSS output tidied up
 * - Fix: YouTube thumbnail date
 * - Fix: YouTube videos on HTTPS
 *
 * 1.2.2
 * - Fix: Vimeo slideshows not pausing correctly
 *
 * 1.2.1
 * - Fix: Vertical slides with HTML Overlay not working
 * - Fix: YouTube & Vimeo slides not saving on some installations
 * - Change: Post Feed limit changed to 'number' input type
 *
 * 1.2
 * - WYSIWYG Editor Added to HTML Overlay slides
 * - Plugin localized
 * - Fix: Post Feeds now only count posts with featured images set
 *
 * 1.1.4
 * - Fix for YouTube and Vimeo slides when thumbnail download fails
 *
 * 1.1.3
 * - Youtube debug removed
 *
 * 1.1.2
 * - PHP Short tag fixed
 * - Theme editor CSS fixed
 * - "More Slide Types" menu item removed
 * - Alt text added to HTML Overlay slide type
 * - HTML Validation Fixes
 *
 * 1.1.1
 * - HTML Overlay bug fixed when slideshow has a single slide
 *
 * 1.1
 * - Theme Editor added
 * - Vimeo thumbnail loader now uses build in WordPress functionality
 *
 * 1.0.1
 * - Hide overflow on HTML Slides (to stop animations from 'leaking' into other slides)
 *
 * 1.0
 * - Initial Version
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) exit;

define('METASLIDERPRO_VERSION', '2.3.2');
define('METASLIDERPRO_BASE_URL', plugin_dir_url(__FILE__));
define('METASLIDERPRO_ASSETS_URL', METASLIDERPRO_BASE_URL . 'assets/');
define('METASLIDERPRO_BASE_DIR_LONG', dirname(__FILE__));
define('METASLIDERPRO_INC_DIR', METASLIDERPRO_BASE_DIR_LONG . '/modules/');

// check Meta Slider (Lite) is installed and activated
require_once('class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'check_metaslider_lite_dependency');

// handle automatic updates
require_once('wp-updates-plugin.php');
new WPUpdatesPluginUpdater( 'http://wp-updates.com/api/1/plugin', 136, plugin_basename(__FILE__) );

// load ml-slider class
if (!file_exists(WP_PLUGIN_DIR . '/ml-slider/inc/slide/metaslide.class.php')) {
    return;
}
if (!class_exists('MetaSlide')) {
    require_once(WP_PLUGIN_DIR . '/ml-slider/inc/slide/metaslide.class.php');
}

// load image helper class
if (!file_exists(WP_PLUGIN_DIR . '/ml-slider/inc/metaslider.imagehelper.class.php')) {
    return;
}
if (!class_exists('MetaSliderImageHelper')) {
    require_once(WP_PLUGIN_DIR . '/ml-slider/inc/metaslider.imagehelper.class.php');
}

require_once(METASLIDERPRO_INC_DIR . 'youtube/slide.php');
require_once(METASLIDERPRO_INC_DIR . 'vimeo/slide.php');
require_once(METASLIDERPRO_INC_DIR . 'layer/slide.php');
require_once(METASLIDERPRO_INC_DIR . 'post_feed/slide.php');
require_once(METASLIDERPRO_INC_DIR . 'theme_editor/theme_editor.php');
require_once(METASLIDERPRO_INC_DIR . 'thumbnails/thumbnails.php');

/**
 * Register the plugin.
 *
 * Display the administration panel, insert JavaScript etc.
 */
class MetaSliderPro {

    /**
     * Constructor
     */
    public function __construct() {
        add_filter('metaslider_menu_title', array($this, 'menu_title'));
        add_action('init', array($this, 'load_plugin_textdomain'));
        add_action('metaslider_register_admin_scripts', array($this, 'register_admin_scripts'), 10, 1);
        add_action('metaslider_register_admin_styles', array($this, 'register_admin_styles'), 10, 1);
        add_filter('metaslider_css', array($this, 'get_public_css'), 11, 3);
        add_filter('media_upload_tabs', array($this,'custom_media_upload_tab_name'), 999, 1);

        $themeEditor = new MetaSliderThemeEditor();
        $thumbnails = new MetaSliderThumbnails();
        $postFeed = new MetaPostFeedSlide();
        $vimeo = new MetaVimeoSlide();
        $youtube = new MetaYouTubeSlide();
        $htmlOverlay = new MetaLayerSlide();
    }

    /**
     * Initialise translations
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain('metasliderpro', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Registers and enqueues admin JavaScript
     */
    public function register_admin_scripts() {
        wp_enqueue_script('metasliderpro-admin-script', METASLIDERPRO_ASSETS_URL . 'admin.js', array('jquery', 'metaslider-admin-script'),METASLIDERPRO_VERSION);
    }

    /**
     * Registers and enqueues admin CSS
     */
    public function register_admin_styles() {
        wp_enqueue_style('metasliderpro-admin-styles', METASLIDERPRO_ASSETS_URL . 'admin.css', false, METASLIDERPRO_VERSION);
    }

    /**
     * Registers and enqueues public CSS
     *
     * @param string $css
     * @param array $settings
     * @param int $id
     * @return string
     */
    public function get_public_css($css, $settings, $id) {
        if ($settings['printCss'] == 'true') {
            wp_enqueue_style('metasliderpro-public', METASLIDERPRO_ASSETS_URL . "public.css", false, METASLIDERPRO_VERSION);
        }
    }

    /**
     * Add "Pro" to the menu title
     *
     * @param string Meta Slider menu name
     * @return string title
     */
    public function menu_title($title) {
        return $title . " Pro";
    }

    /**
     * Add extra tabs to the default wordpress Media Manager iframe
     *
     * @param array existing media manager tabs
     */
    public function custom_media_upload_tab_name( $tabs ) {
        // restrict our tab changes to the meta slider plugin page
        if (isset($_GET['page']) && $_GET['page'] == 'metaslider') {
            if(isset($tabs['nextgen'])) unset($tabs['nextgen']);
            if(isset($tabs['metaslider_pro'])) unset($tabs['metaslider_pro']);
        }

        return $tabs;
    }
}
$metasliderpro = new MetaSliderPro();

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function check_metaslider_lite_dependency() {

    /**
     * Array of plugin arrays. Required keys are name, slug and required.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => 'Meta Slider (Lite)',
            'slug'      => 'ml-slider',
            'required'  => true,
            'version'   => 2.6
        ),
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'metasliderpro';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => true,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'Meta Slider (Pro) requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );

    tgmpa( $plugins, $config );

}
?>