<?php

$description = get_sub_field( 'description' );
$image = get_sub_field( 'image' );

// Get terms from the custom taxonomy 'showroom_category'
$terms = get_the_terms( get_the_ID(), 'showroom_category' );

?>

<div class="px-5 flex flex-col gap-y-[60px]">

	<!-- Category -->
	<?php if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) : ?>

		<div class="text-h3 text-gray-500 js-element-blurin">

			<?php foreach ( $terms as $index => $term ) : ?>

				<span><?= esc_html( $term->name ); ?><?= $index < count( $terms ) - 1 ? ',' : ''; ?></span>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>


	<!-- Title -->
	<div class="js-element-blurin">

		<h2 class="text-h1 col-span-12 lg:col-span-9 2xl:col-span-6">

			<div class="-ml-1">
				<?= get_the_title(); ?>
			</div>
		</h2>

	</div>

	<?php if ( $description ) : ?>

		<div class="grid grid-cols-12 gap-x-5 gap-y-[60px]">

			<div class="col-span-12 md:col-span-6 js-element-blurin max-md:order-2">

				<div class="flex flex-col gap-y-5 body-links-inverted max-w-[500px]">
					<?= $description; ?>
				</div>

			</div>

			<div class="col-span-12 md:col-span-6 js-element-blurin max-md::order-1">

				<?= mi_get_image( $image, 'xl', 'w-full' ); ?>

			</div>

		</div>

	<?php endif; ?>

</div>