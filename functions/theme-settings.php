<?php

// Add post thumbnail/featured image support.
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

// Register main menu for Wordpress use.
register_nav_menus(
	array(
		'primary' => __( 'Primary Menu', 'fargor' ),
	)
);

// Disable error message 'Notice: ob_end_flush(): Failed to send buffer of zlib output compression (0)'.
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );