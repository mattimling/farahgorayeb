<?php

// Constants.
define( 'THEME_PATH', get_template_directory() );
define( 'FUNCTIONS_PATH', THEME_PATH . '/functions' );
define( 'JS_PATH', get_template_directory_uri() . '/assets/js' );
define( 'CSS_PATH', get_template_directory_uri() . '/assets/css' );

// Functions.
$required_functions = [ 
	'is-localhost',
	'theme-settings',
	'enqueue-styles-scripts',
	'clean-head-links',
	'acf-settings',
	'cpt-projects',
	'add-svg-support',
	'snippets',
	'custom-image-size',
	'responsive-images',
	// 'tinymce-custom-styles',
	// 'is-page-descendant',
	// 'wp-nav-menu.php',
	// 'wpml.php',
];

foreach ( $required_functions as $function ) {
	require_once FUNCTIONS_PATH . '/' . $function . '.php';
}