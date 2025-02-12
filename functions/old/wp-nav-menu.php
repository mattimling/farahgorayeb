<?php

function wpd_page_template_nav_class( $classes, $item ) {
	// Only check pages.
	if ( 'page' == $item->object ) {
		// If this page has a template assigned.
		if ( $slug = get_page_template_slug( $item->object_id ) ) {
			// Get the array of filenames => template names in the current theme.
			$templates = wp_get_theme()->get_page_templates();
			// If there is a template with key matching our filename.
			if ( isset( $templates[ $slug ] ) ) {
				// Sanitize it and add it to the classes.
				$classes[] = sanitize_html_class( strtolower( $templates[ $slug ] ) );
			}
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'wpd_page_template_nav_class', 10, 2 );



// Add menu items.
function add_admin_link( $items, $args ) {

	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

		$items .= '<li class="flex gap-x-4">';

		if ( get_language_shortcode() == 'en' ) {

			$items .= '<a href="' . esc_url( get_site_url() ) . '" class="pointer-events-none opacity-50">EN</a><a href="' . esc_url( home_url() ) . '/it/" class="">IT</a>';

		}

		if ( get_language_shortcode() == 'it' ) {

			$items .= '<a href="' . esc_url( get_site_url() ) . '" class="">EN</a><a href="' . esc_url( home_url() ) . '/it/" class="pointer-events-none opacity-50">IT</a>';

		}

		$items .= '</li>';

	}

	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_admin_link', 10, 2 );