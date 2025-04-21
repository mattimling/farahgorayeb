<?php

$video_link = get_sub_field( 'video_link' );

?>

<?php if ( $video_link ) : ?>

	<div class="px-5 w-full">

		<div class="overflow-hidden js-element-blurin">

			<video preload="auto" muted playsinline autoplay loop controls class="w-full h-full object-cover">
				<source src="<?= $video_link; ?>" type="video/mp4">
			</video>

		</div>

	</div>

<?php endif; ?>