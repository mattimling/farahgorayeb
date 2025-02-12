<?php

// Get current language.
function get_language_shortcode() {
	return apply_filters( 'wpml_current_language', null );
}
add_shortcode( 'language', 'get_language_shortcode' );