<?php
$image = get_sub_field( 'image' );
$description = get_sub_field( 'description' );
?>

<div class="px-5 w-full flex flex-col gap-y-[10px]">
	<div class="overflow-hidden js-element-blurin">
		<a href="<?= wp_get_attachment_image_src( $image, 'xl' )[0]; ?>" class="glightbox js-barba-prevent" data-gallery="gallery">
			<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover' ); ?>
		</a>
	</div>

	<?php if ( $description ) : ?>
		<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin">
			<?= $description; ?>
		</div>
	<?php endif; ?>
</div>