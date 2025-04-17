<?php

$image = get_sub_field( 'image' );
$paragraph_title = get_sub_field( 'paragraph_title' );
$paragraph = get_sub_field( 'paragraph', false );
$link = get_sub_field( 'link' );

?>

<div class="w-full md:aspect-video xl:aspect-[1500/600] overflow-hidden relative flex flex-col justify-between px-5 py-[60px] -mb-[150px] mt-[90px] call-to-action group">

	<div class="absolute top-0 left-0 w-full h-full js-element-blurin pointer-events-none overflow-hidden ">
		<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover scale-[1.1]' ); ?>

		<div class="absolute top-0 left-0 w-full h-full backdrop-blur-sm"></div>
	</div>

	<div class="absolute top-0 left-0 z-10 w-full h-full bg-white opacity-30"></div>

	<?php if ( $paragraph ) : ?>

		<div class="relative z-10 grid grid-cols-12 gap-x-5 max-md:pb-40 <?= ( $order == 'paragraph-title' ) ? 'order-1' : ''; ?> js-element-blurin">

			<div class="col-span-12 md:col-span-6 lg:col-span-6 2xl:col-span-3">

				<?php if ( $paragraph_title ) : ?>
					<span class="pr-5">
						<?= $paragraph_title; ?>
					</span>
				<?php endif; ?>

				<?= $paragraph; ?>

			</div>

		</div>

	<?php endif; ?>

	<?php if ( $link ) : ?>

		<div class="relative z-10 js-element-blurin">

			<?= mi_get_link( $link, 'text-h2 body-link-h1-inverted' ); ?>

		</div>

	<?php endif; ?>

</div>