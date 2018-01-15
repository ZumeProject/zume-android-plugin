<?php
/*
Plugin Name: Zume Android App Extension (private)
Plugin URI: https://github.com/ZumeProject/zume-android-app
Description: Extends the Zume Project Training site into an Android App
Author: 
Author URI: 
Version: 0.1
Text Domain: zume
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

// Test if zume_multilingual site exists
if( ! function_exists( 'zume_multilingual_exists') ) {
    exit;
}

/**
 * Add extension code below.
 */