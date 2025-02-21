<?php

$title = get_sub_field( 'title' );
$paragraph_title = get_sub_field( 'paragraph_title' );
$paragraph = get_sub_field( 'paragraph', false );
$order = get_sub_field( 'order' );

?>

<div class="px-5 flex flex-col gap-y-[60px] Xpy-[60px]">

	<?php if ( $title ) : ?>

		<div class="grid grid-cols-12 gap-x-5 <?= ( $order == 'paragraph-title' ) ? 'order-2' : ''; ?> js-element-blurin">

			<h2 class="text-h1 col-span-12 lg:col-span-9 2xl:col-span-6">
				<?= $title; ?>
			</h2>

		</div>

	<?php endif; ?>

	<?php if ( $paragraph ) : ?>

		<div class="grid grid-cols-12 gap-x-5 <?= ( $order == 'paragraph-title' ) ? 'order-1' : ''; ?> js-element-blurin">

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

</div>