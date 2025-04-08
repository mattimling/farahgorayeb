<?php

$gallery = get_sub_field( 'gallery' );
$gallery_timeout = get_sub_field( 'gallery_timeout' );
$media_type = get_sub_field( 'media_type' );
$self_hosted_video = get_sub_field( 'self_hosted_video' );
$embed_video = get_sub_field( 'embed_video' );

?>


<div class="w-full h-[100dvh] -mt-[calc(71px+60px)] js-hero prevent-children overflow-hidden">

	<div class="js-hero-inner">

		<?php if ( $media_type == 'Background Image' ) : ?>

			<div class="w-full h-full pointer-events-none">

				<?php if ( count( $gallery ) == 1 ) : ?>

					<?= mi_get_image( $gallery[0], 'xl', 'w-full h-full object-cover' ); ?>

				<?php else : ?>

					<div class="w-full h-[100dvh] relative js-hero-gallery" data-gallery-timeout="<?= ! empty( $gallery_timeout ) ? $gallery_timeout : '3'; ?>">

						<?php foreach ( $gallery as $image ) : ?>

							<div class="w-full h-full absolute top-0 left-0 js-hero-gallery-image transition-opacity duration-1000">
								<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover' ); ?>
							</div>

						<?php endforeach; ?>

					</div>

				<?php endif; ?>

			</div>

		<?php elseif ( $media_type == 'Self Hosted Video' ) : ?>

			<div class="w-full h-[100dvh] pointer-events-none">

				<video preload="metadata" muted playsinline loop autoplay class="w-full h-full object-cover">
					<source src="<?= $self_hosted_video; ?>" type="video/mp4">
				</video>

			</div>

		<?php elseif ( $media_type == 'Embed Video' ) : ?>

			<div class="w-full h-[100dvh] relative pointer-events-none">

				<?= clean_video_embed( $embed_video ); ?>

			</div>

		<?php endif; ?>

	</div>

</div>