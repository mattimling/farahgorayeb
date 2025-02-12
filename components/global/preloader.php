<?php

$short_logo = get_field( 'short_logo', 'options' );

?>

<div class="bg-charcoal w-screen h-[100dvh] js-preloader fixed top-0 left-0 z-[9999] flex justify-center items-center text-white">

	<div class="w-[60px] h-[70px] js-preloader-logo opacity-0 [&.is-visible]:opacity-100 transition-opacity duration-[2s]" style="clip-path: polygon(0 100%, 100% 100%, 100% 100%, 0% 100%);">
		<?= $short_logo; ?>
	</div>

	<div class="text-pr-sm absolute bottom-5 left-1/2 -translate-x-1/2 js-preloader-counter opacity-0 [&.is-visible]:opacity-100 transition-opacity duration-300"></div>

</div>