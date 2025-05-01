<?php

// Enqueue Styles and Scripts.
add_action( 'wp_enqueue_scripts', function () {

	// Define CSS files to enqueue
	$styles = [ 
		'style',
	];

	// Define CSS files to enqueue
	$styles_vendor = [ 
		'lenis',
		'swiper-bundle.min',
		'glightbox.min',
	];

	// Enqueue CSS files
	foreach ( $styles as $style ) {
		wp_enqueue_style( $style . '-css', CSS_PATH . '/' . $style . '.css' );
	}

	// Enqueue Vendor CSS files
	foreach ( $styles_vendor as $style ) {
		wp_enqueue_style( $style . '-css', CSS_PATH . '/vendor/' . $style . '.css' );
	}

	// Define Vendor JS files to enqueue
	$scripts_vendor = [ 
		'lenis.min',
		'anime.min',
		// 'barba_core-2.9.7',
		'barba_core-2.10.3',
		'swiper-bundle.min',
		'glightbox.min',
	];

	// Define Module JS files to enqueue
	$scripts_module = [ 
		'main',
		'preload-media',
		'preloader',
		'lenis-scroll',
		'barba-page-transition',
		'if-function-exist',
		'hero-gallery',
		'menu',
		'element-blurin',
		'footer-link',
		'footer-title',
		'projects-filter',
		'image-image',
		'prev-next',
		'projects-slider',
		'projects-item-hover',
		'textarea-auto-height',
		'init-contact-form',
		'init-glightbox',
	];

	// Define External JS files to enqueue
	$scripts_external = [
		// '//assets.mediadelivery.net/playerjs/player-0.1.0.min.js',
	];

	// Enqueue Vendor JS files
	foreach ( $scripts_vendor as $script ) {
		wp_enqueue_script( $script . '-js', JS_PATH . '/vendor/' . $script . '.js', [], '', true );
	}

	// Enqueue Module JS files
	foreach ( $scripts_module as $script ) {
		wp_enqueue_script( $script . '-js', JS_PATH . '/modules/' . $script . '.js', [], '', true );
	}

	// Enqueue External JS files
	foreach ( $scripts_external as $script ) {
		wp_enqueue_script( $script . '-js', $script, [], '', true );
	}

} );
