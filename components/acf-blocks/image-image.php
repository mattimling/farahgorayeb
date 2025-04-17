<?php

$image_1 = get_sub_field( 'image_1' );
$image_big_description = get_sub_field( 'image_big_description' );
$image_2 = get_sub_field( 'image_2' );
$image_small_description = get_sub_field( 'image_small_description' );
$order = get_sub_field( 'order' );

?>

<div class="px-5 grid grid-cols-12 gap-x-5 gap-y-[60px] js-image-image">

	<div class="<?= $order == 'big-small' ? '' : 'order-2'; ?> col-span-12 md:col-span-6 pointer-events-none flex flex-col gap-y-[10px]">

		<?= mi_get_image( $image_1, 'xl', 'w-full js-element-blurin relative' ); ?>

		<?php if ( $image_big_description || $image_small_description ) : ?>

			<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin w-full js-image-desc">
				<?= $image_big_description; ?>
			</div>

		<?php endif; ?>

	</div>

	<div class="<?= $order == 'big-small' ? 'justify-end items-end' : 'order-1 justify-end'; ?> col-span-12 md:col-span-6 flex pointer-events-none flex-col gap-y-[10px]">

		<?= mi_get_image( $image_2, 'xl', 'md:w-3/4 lg:w-1/2 js-element-blurin relative' ); ?>

		<?php if ( $image_small_description || $image_big_description ) : ?>

			<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin w-full md:w-3/4 lg:w-1/2 text-left js-image-desc">
				<?= $image_small_description; ?>
			</div>

		<?php endif; ?>

	</div>

</div>