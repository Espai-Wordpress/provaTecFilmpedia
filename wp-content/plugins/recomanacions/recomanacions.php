<?php
/**
 * Plugin Name: Recomanacions
 * Description: Plugin que afegeix un shortcode per mostrar les recomanacions
 * Version:     1.0.0
 * Author:      llopfilms
 * Author URI:
 * Text Domain: filmpedia
 * Domain Path: /languages 
 */

// Plugin directory
define( 'PROVATECFILMPEDIA_DIR', plugin_dir_path( __FILE__ ) );

// CPTs creats per ACF
// require_once( PROVATECFILMPEDIA_DIR . '/includes/cpt.php' );

// Shortcode
require_once( PROVATECFILMPEDIA_DIR . '/includes/recomanacions_shortcode.php' );
