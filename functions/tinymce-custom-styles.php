<?php

// Add 'styleselect' to the end of the first row of the TinyMCE editor buttons
function playground_mce_buttons( $buttons ) {
	$buttons[] = 'styleselect';
	return $buttons;
}
add_filter( 'mce_buttons', 'playground_mce_buttons' );

// Customize TinyMCE editor settings to include custom styles
function playground_mce_before_init_insert_formats( $init_array ) {
	$style_formats = [ 
		[ 
			'title' => 'Title - Uppercase',
			'block' => 'span',
			'classes' => 'text-sc-lg',
			'wrapper' => true,
			'styles' => [ 
				'text-transform' => 'uppercase',
			],
		],
		// [ 
		// 	'title' => 'Text - Grey',
		// 	'block' => 'div',
		// 	// 'classes' => 'opacity-30',
		// 	'wrapper' => true,
		// 	'styles' => [ 
		// 		'color' => '#b3b3b3',
		// 	],
		// ],
	];

	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'playground_mce_before_init_insert_formats' );
