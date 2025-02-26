<?php

$args = isset( $args ) ? $args : array();

$post_type = $args['post_type'];

$show_filter = get_sub_field( 'show_filter' );

// Define the custom query arguments
$args = array(
	'post_type' => $post_type, // Custom post type 'portfolio'
	'posts_per_page' => -1,          // Get all posts
	'post_status' => 'publish',   // Only get published posts
);

// Create a new WP_Query instance
$portfolio_query = new WP_Query( $args );

?>

<!-- Filter -->

<?php if ( $show_filter ) : ?>

	<div class="px-5 text-h1 flex flex-wrap [&_.item:last-child_.comma]:hidden js-pflo-filter">

		<div class="flex item">
			<a href="#all" class="js-pflo-filter-item hover:underline">
				All
			</a>
			<span class="mr-5">,</span>
		</div>

		<?php

		$categories = get_terms( [ 
			'taxonomy' => $post_type . '_category',
			'hide_empty' => true,
		] );

		?>

		<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>

			<?php foreach ( $categories as $category ) : ?>

				<div class="flex item">
					<a href="#<?= esc_html( $category->slug ); ?>" class="hover:underline js-pflo-filter-item">
						<?= esc_html( $category->name ); ?>
					</a>
					<span class="mr-5 comma">,</span>
				</div>

			<?php endforeach; ?>

		<?php endif; ?>

	</div>

<?php endif; ?>

<!-- Grid -->
<div class="px-5">

	<?php if ( $portfolio_query->have_posts() ) : ?>

		<div class="grid grid-cols-12 gap-x-5 gap-y-[60px] items-end js-pflo-grid">

			<?php for ( $i = 0; $i < 3; $i++ ) : ?>

				<?php while ( $portfolio_query->have_posts() ) :
					$portfolio_query->the_post();

					$categories = get_the_terms( get_the_ID(), $post_type . '_category' ); // Change 'category' if using a custom taxonomy
					$category_slug = ! empty( $categories ) && ! is_wp_error( $categories ) ? esc_attr( $categories[0]->slug ) : '';
					?>

					<a href="<?php the_permalink(); ?>" class="pflo-grid-item <?= $post_type == 'portfolio' ? 'pflo col-span-12 sm:col-span-6 lg:col-span-4 2xl:col-span-3' : 'swrm col-span-6 sm:col-span-4 lg:col-span-3 2xl:col-span-2'; ?> flex flex-col js-element-blurin" data-category="#<?= $category_slug; ?>">

						<div class="pflo-grid-item-inner flex flex-col gap-y-[10px]">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="pflo-grid-item-img overflow-hidden relative">
									<?= get_the_post_thumbnail( get_the_ID(), 'xl', [ 'class' => 'w-full' ] ); ?>

									<!-- <div class="absolute top-0 left-0 z-10 w-[400px] h-[400px] js-pflo-grid-item-img-blur"></div> -->
								</div>
							<?php endif; ?>

							<div class="pflo-grid-item-title flex flex-wrap">
								<?= get_the_title(); ?>
							</div>

						</div>

					</a>

				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>

			<?php endfor; ?>

		</div>

	<?php else : ?>

		<p>No portfolio items found.</p>

	<?php endif; ?>

</div>