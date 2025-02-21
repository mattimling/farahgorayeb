<?php

$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$image = get_sub_field( 'image' );

?>

<div class="px-5 flex flex-col gap-y-[60px]">

	<?php if ( $title ) : ?>

		<div class="grid grid-cols-12 gap-x-5 js-element-blurin">

			<h2 class="text-h1 col-span-12 lg:col-span-9 2xl:col-span-6 js-element-blurin">
				<?= $title; ?>
			</h2>

		</div>

	<?php endif; ?>

	<?php if ( $text ) : ?>

		<div class="grid grid-cols-12 gap-x-5 gap-y-[60px] js-element-blurin">

			<div class="col-span-12 md:col-span-9 lg:col-span-6 2xl:col-span-5 flex flex-col gap-y-[60px] simple-content js-element-blurin-children">

				<?= $text; ?>

			</div>

			<?php if ( $image ) : ?>

				<div class="col-span-12 md:col-span-6 md:col-start-7 lg:col-span-5 lg:col-start-8 self-end js-element-blurin">
					<?= mi_get_image( $image, 'xl', 'w-full' ); ?>
				</div>

			<?php endif; ?>

		</div>

	<?php endif; ?>

</div>