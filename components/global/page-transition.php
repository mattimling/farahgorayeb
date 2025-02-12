<?php

$short_logo = get_field( 'short_logo', 'options' );

?>

<div class="bg-charcoal w-screen h-[100dvh] fixed top-0 left-0 z-[9999] js-page-transition pointer-events-none flex justify-center items-center opacity-0">

	<div class="w-[60px] h-[70px] js-page-transition-logo opacity-0" style="opacity: 0;">
		<?= $short_logo; ?>
	</div>

</div>