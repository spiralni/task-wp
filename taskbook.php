<?php
/*
Plugin Name: Task Book (taskbook)
Description: Task book functionality
Version: 1.0.0
Author: spiralni
Author URI: https://spiralni.com
License: GPLv2 or later
Text Domain: taskbook
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'TASKBOOK__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

require_once( TASKBOOK__PLUGIN_DIR . 'class.taskstatus.php' );
require_once( TASKBOOK__PLUGIN_DIR . 'class.roles.php' );
require_once( TASKBOOK__PLUGIN_DIR . 'class.taskrestapi.php' );
require_once( TASKBOOK__PLUGIN_DIR . 'class.taskbook.php' );

add_action( 'init', [ 'TaskBook', 'init' ] );
register_activation_hook( __FILE__, [ 'TaskBook', 'onPluginActivated' ] );
register_deactivation_hook( __FILE__, [ 'TaskBook', 'onPluginDeactivated' ] );

