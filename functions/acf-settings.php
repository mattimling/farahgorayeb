<?php

// ACF options page.
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page();

}



// Change ACF JSON default save path - save.
function emelecollab_acf_json_save_point( $path ) {

	return get_stylesheet_directory() . '/components/acf-json';

}
add_filter( 'acf/settings/save_json', 'emelecollab_acf_json_save_point' );



// Change ACF JSON default save path - load.
function emelecollab_acf_json_load_point( $paths ) {
	// Remove the original path (optional).
	unset( $paths[0] );

	// Append the new path and return it.
	$paths[] = get_stylesheet_directory() . '/components/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'emelecollab_acf_json_load_point' );