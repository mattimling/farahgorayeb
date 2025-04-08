<?php

$cf7_shortcode = get_sub_field( 'cf7_shortcode' );

?>

<div class="px-5">

	<div class="text-h1-to-small body-links-h1 leading-[1.15] break-words cf7-shortcode">
		<?= do_shortcode( $cf7_shortcode ); ?>
	</div>

</div>