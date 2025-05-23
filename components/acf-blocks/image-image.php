<?php
$image_1 = get_sub_field( 'image_1' );
$video_big = get_sub_field( 'video_big' );
$image_big_description = get_sub_field( 'image_big_description' );
$image_2 = get_sub_field( 'image_2' );
$video_small = get_sub_field( 'video_small' );
$image_small_description = get_sub_field( 'image_small_description' );
$order = get_sub_field( 'order' );
?>

<div class="px-5 grid grid-cols-12 gap-x-5 gap-y-[60px] js-image-image">
	<div class="<?= $order == 'big-small' ? '' : 'order-2'; ?> col-span-12 md:col-span-6 flex flex-col gap-y-[10px]">
		<?php if ( ! empty( $video_big ) ) : ?>
			<video preload="auto" muted playsinline autoplay loop controls class="w-full h-full object-cover js-element-blurin">
				<source src="<?= $video_big; ?>" type="video/mp4">
			</video>
		<?php else : ?>
			<a href="<?= wp_get_attachment_image_src( $image_1, 'xl' )[0]; ?>" class="glightbox js-barba-prevent js-element-blurin" data-gallery="gallery" aria-label="Image gallery">
				<?= mi_get_image( $image_1, 'xl', 'w-full relative' ); ?>
			</a>
		<?php endif; ?>

		<?php if ( $image_big_description || $image_small_description ) : ?>
			<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin w-full js-image-desc">
				<?= $image_big_description; ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="<?= $order == 'big-small' ? 'justify-end items-end' : 'order-1 justify-end'; ?> col-span-12 md:col-span-6 flex flex-col gap-y-[10px]">
		<?php if ( ! empty( $video_small ) ) : ?>
			<video preload="auto" muted playsinline autoplay loop controls class="md:w-3/4 lg:w-1/2 js-element-blurin">
				<source src="<?= $video_small; ?>" type="video/mp4">
			</video>
		<?php else : ?>
			<a href="<?= wp_get_attachment_image_src( $image_2, 'xl' )[0]; ?>" class="md:w-3/4 lg:w-1/2 glightbox js-barba-prevent js-element-blurin" data-gallery="gallery" aria-label="Image gallery">
				<?= mi_get_image( $image_2, 'xl', 'relative' ); ?>
			</a>
		<?php endif; ?>

		<?php if ( $image_small_description || $image_big_description ) : ?>
			<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin w-full md:w-3/4 lg:w-1/2 text-left js-image-desc">
				<?= $image_small_description; ?>
			</div>
		<?php endif; ?>
	</div>
</div>