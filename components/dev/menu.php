<div class="fixed bottom-0 right-[100px] z-50 bg-[#ff0000] text-[#fff] p-2">

	<?php

	$args = array(
		'sort_column' => 'menu_order'
	);

	wp_nav_menu( $args );

	?>

</div>