<?php

/*
Plugin Name: Alcatraz Visual Hook Guide
Plugin URI: http://alcatraztheme.com
Description: Find Alcatraz hooks locations inside Acatraz Theme.
Version: 1.0.0
Author: Braad Martin, Carrie Forde, Jordan Gonzales
Author URI: http://alcatraztheme.com
License:
*/

// Set up some constants.
define( 'ALCATRAZ_VISUAL_GUIDE', '1.0.0' );
define( 'ALCATRAZ_HOOK_GUIDE_PATH', plugin_dir_path( __FILE__ ) );
define( 'ALCATRAZ_HOOK_GUIDE_URL', plugin_dir_url( __FILE__ ) );

// Bail if Alcatraz is not installed.
register_activation_hook(__FILE__, 'avh_activation_check');
function avh_activation_check() {

		$theme_info = wp_get_theme();

			$alcatraz_flavors = array(
			'Alcatraz',
			'alcatraz'
		);

		if ( ! in_array( $theme_info->Template, $alcatraz_flavors ) ) {
			deactivate_plugins( plugin_basename(__FILE__) ); // Deactivate ourself
			wp_die('Sorry, you can\'t activate unless you have installed <a href="http://www.alcatraztheme.org">Alcatraz</a>');
		}
}

// Build admin bar menu.
add_action( 'admin_bar_menu', 'alcatraz_hook_guide_options', 100 );
function alcatraz_hook_guide_options() {
global $wp_admin_bar;

	if ( is_admin() ) {
		return;
	}

	$wp_admin_bar->add_menu(
		array(
			'id' => 'alcatraz_hook_guide',
			'title' => __( 'Alcatraz Hook Guide', 'alcatrazvisualhookguide' ),
			'href' => '',
			'position' => 0,
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'id'	   => 'alcatraz_hooks',
			'parent'   => 'alcatraz_hook_guide',
			'title'    => __( 'Show Hooks?', 'alcatrazvisualhookguide' ),
			'href'     => add_query_arg( 'alcatraz_hooks', 'show' ),
			'position' => 10,
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'id'	   => 'alcatraz_hooks_clear',
			'parent'   => 'alcatraz_hook_guide',
			'title'    => __( 'Clear', 'alcatrazvisualhookguide' ),
			'href'     => remove_query_arg(
				array(
					'alcatraz_hooks',
				)
			),
			'position' => 10,
		)
	);
}

// Build array of hooks.
add_action('wp_enqueue_scripts', 'alcatraz_hooks_stylesheet');
function alcatraz_hooks_stylesheet() {

	 if ( 'show' == isset( $_GET['alcatraz_hooks'] ) )

	 	wp_enqueue_style( 'avh_styles', ALCATRAZ_HOOK_GUIDE_URL . 'styles.css' );
}

add_action('get_header', 'alcatraz_hooker' );
function alcatraz_hooker() {
global $alcatraz_action_hooks;

	if ( !('show' == isset( $_GET['alcatraz_hooks'] ) ) ) {
		 return;  // BAIL without hooking into anyhting if not displaying anything
	}

	$alcatraz_action_hooks = array(

		'alcatraz_before_header' => array(
			'hook' => 'alcatraz_before_header',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_header_inside' => array(
			'hook' => 'alcatraz_before_header_inside',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_header' => array(
			'hook' => 'alcatraz_header',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_header_inside' => array(
			'hook' => 'alcatraz_after_header_inside',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_header' => array(
			'hook' => 'alcatraz_after_header',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_main' => array(
			'hook' => 'alcatraz_before_main',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_main_inside' => array(
			'hook' => 'alcatraz_before_main_inside',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_main_inside' => array(
			'hook' => 'alcatraz_after_main_inside',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_main' => array(
			'hook' => 'alcatraz_after_main',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_main_inside' => array(
			'hook' => 'alcatraz_before_main_inside',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_content' => array(
			'hook' => 'alcatraz_before_content',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_sidebar_primary' => array(
			'hook' => 'alcatraz_sidebar_primary',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_footer' => array(
			'hook' => 'alcatraz_before_footer',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_footer' => array(
			'hook' => 'alcatraz_footer',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_footer' => array(
			'hook' => 'alcatraz_after_footer',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after' => array(
			'hook' => 'alcatraz_after',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_before_entry' => array(
			'hook' => 'alcatraz_before_entry',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			),
		'alcatraz_after_entry' => array(
			'hook' => 'alcatraz_after_entry',
			'area' => 'Structural',
			'description' => '',
			'functions' => array(),
			)
		);

	foreach ( $alcatraz_action_hooks as $action ) {
		add_action( $action['hook'] , 'alcatraz_action_hook' , 1 );
	}
}

// Output markup if hooks exist on page.
function alcatraz_action_hook () {
global $alcatraz_action_hooks;

	$current_action = current_filter();

	if ( 'show' == isset( $_GET['alcatraz_hooks'] ) ) {

		if ( 'Document Head' == $alcatraz_action_hooks[$current_action]['area'] ) :

			echo "<!-- ";
				echo $current_action;
			echo " -->\n";

		else :

			echo '<div class="alcatraz_hook" title="' . $alcatraz_action_hooks[$current_action]['description'] . '">' . $current_action . '</div>';

		endif;
	}

}

