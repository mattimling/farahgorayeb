<?php

$gallery = get_sub_field( 'gallery' );
$gallery_timeout = get_sub_field( 'gallery_timeout' );
$video_link = get_sub_field( 'video_link' );

?>

<div class="w-full h-[100dvh]">

	<?php if ( $video_link ) : ?>

		<div class="h-full">

			<video preload="metadata" loop muted autoplay playsinline class="w-full h-full object-cover">
				<source src="<?= $video_link ?>" type="video/mp4">
			</video>

		</div>

	<?php else : ?>

		<div class="h-full">

			<?php if ( count( $gallery ) == 1 ) : ?>

				<?= mi_get_image( $gallery[0], 'xl', 'w-full h-full object-cover' ); ?>

			<?php else : ?>

				<div class="w-full h-full relative js-hero-gallery" data-gallery-timeout="<?= ! empty( $gallery_timeout ) ? $gallery_timeout : '3'; ?>">

					<?php foreach ( $gallery as $image ) : ?>

						<div class="w-full h-full absolute top-0 left-0 js-hero-gallery-image transition-opacity duration-1000">
							<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover' ); ?>
						</div>

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

		</div>

	<?php endif; ?>

</div>