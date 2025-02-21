<?php

$title = get_sub_field( 'title' );
$paragraph = get_sub_field( 'paragraph', false );

?>

<div class="px-5 flex flex-col gap-y-[60px] Xpy-[60px]">

	<?php if ( $title ) : ?>

		<div class="grid grid-cols-12 gap-x-5 js-element-blurin">

			<h2 class="text-h1 col-span-12 lg:col-span-9 lg:col-start-4 X2xl:col-span-6 X2xl:col-start-4">
				<?= $title; ?>
			</h2>

		</div>

	<?php endif; ?>

	<?php if ( $paragraph ) : ?>

		<div class="grid grid-cols-12 gap-x-5 js-element-blurin">

			<div class="col-span-12 md:col-span-6 lg:col-span-6 lg:col-start-4 2xl:col-span-3 2xl:col-start-4">

				<?= $paragraph; ?>

			</div>

		</div>

	<?php endif; ?>

</div>