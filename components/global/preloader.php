<?php

$preloader = $args['preloader'] ?? false;
$title = get_field( 'title', 'options' );
$tagline = get_field( 'tagline', 'options' );
$gallery = get_field( 'preloader_gallery', 'options' );

?>

<div class="fixed top-0 left-0 w-full h-[100dvh] js-preloader flex flex-col justify-between p-5 z-20" style="<?= $preloader ? 'opacity: 0;' : ''; ?>">

	<?php if ( $gallery ) : ?>

		<div class="absolute top-0 left-0 w-full h-full flex gap-x-10 justify-center items-center">

			<div class="">
				<?= $title; ?>
			</div>

			<div class="w-[200px] h-[200px] relative js-preloader-gallery">

				<?php foreach ( $gallery as $image ) : ?>

					<?= mi_get_image( $image, 'medium', 'absolute top-0 left-0 w-full h-full object-contain' ); ?>

				<?php endforeach; ?>

			</div>

			<div class="">
				<?= $tagline; ?>
			</div>

		</div>

	<?php endif; ?>

</div>