<?php

$args = isset( $args ) ? $args : array();

$post_type = $args['post_type'];

$show_filter = get_sub_field( 'show_filter' );
$category_limit = get_sub_field( 'category_limit' ) ?: 2;

// Define the custom query arguments
$args = array(
	'post_type' => $post_type,
	'posts_per_page' => -1,
	'post_status' => 'publish',
);

if ( $post_type === 'showroom' ) {
	$args['orderby'] = 'rand';
}

// Create a new WP_Query instance
$portfolio_query = new WP_Query( $args );

?>

<!-- Filter -->
<?php if ( $show_filter ) : ?>

	<div class="px-5 text-h1 flex flex-wrap [&_.item:last-child_.comma]:hidden js-pflo-filter">

		<div class="flex item">
			<a href="#all" class="js-pflo-filter-item body-link-h1 [&.is-active]:border-b-black is-active js-parent-filter">
				All
			</a>
			<span class="mr-5">,</span>
		</div>

		<?php

		$taxonomy = $post_type . '_category';
		$terms = get_terms( [ 
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
		] );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :

			if ( $post_type === 'showroom' ) :

				// Organize terms into parents and children
				$parent_terms = [];
				$child_terms_by_parent = [];

				foreach ( $terms as $term ) {
					if ( $term->parent == 0 ) {
						$parent_terms[ $term->term_id ] = $term;
					} else {
						$child_terms_by_parent[ $term->parent ][] = $term;
					}
				}

				?>

				<?php foreach ( $parent_terms as $parent ) :
					if ( ! isset( $child_terms_by_parent[ $parent->term_id ] ) )
						continue; // skip if no children
					?>

					<div class="item flex">
						<a href="#<?= $parent->slug; ?>" class="body-link-h1 js-parent-filter [&.is-active]:border-b-black">
							<?= esc_html( $parent->name ); ?>
						</a>
						<span class="mr-5 comma">,</span>
					</div>

				<?php endforeach; ?>

			<?php else :
				// Default output for other post types (flat list)
				foreach ( $terms as $term ) : ?>
					<div class="flex flex-wrap item">
						<a href="#<?= esc_html( $term->slug ); ?>" class="body-link-h1 js-pflo-filter-item [&.is-active]:border-b-black">
							<?= esc_html( $term->name ); ?>
						</a>
						<span class="mr-5 comma">,</span>
					</div>
				<?php endforeach;
			endif;

		endif;
		?>

	</div>

	<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :

		if ( $post_type === 'showroom' ) : ?>

			<div class="px-5 text-h3 relative js-parent-filter-wrapper transition-all duration-300">
				<?php foreach ( $parent_terms as $parent ) :
					if ( ! isset( $child_terms_by_parent[ $parent->term_id ] ) )
						continue; // skip if no children
					?>

					<div class="absolute pointer-events-none opacity-0 js-parent-filter-content [&.is-active]:opacity-100 [&.is-active]:pointer-events-auto transition-opacity duration-300" data-parent="#<?= $parent->slug; ?>">

						<div class="flex flex-wrap gap-y-2 [&_.item:last-child_.comma]:hidden js-parent-filter-content-inner">

							<?php foreach ( $child_terms_by_parent[ $parent->term_id ] as $child ) : ?>

								<div class="flex item">

									<a href="#<?= esc_attr( $child->slug ); ?>" class="body-link-h3 js-pflo-filter-item [&.is-active]:border-b-black">
										<?= esc_html( $child->name ); ?>
									</a>

									<span class="mr-2 md:mr-3 comma">,</span>

								</div>

							<?php endforeach; ?>

						</div>

					</div>

				<?php endforeach; ?>
			</div>

		<?php endif; ?>

	<?php endif; ?>

<?php endif; ?>


<!-- Grid -->
<div class="px-5">

	<?php if ( $portfolio_query->have_posts() ) : ?>

		<?php

		$category_post_counts = [];
		$max_posts_per_category = $category_limit; // Change this number to show more per category
		$deferred_posts = [];

		// 🔀 Shuffle posts to mix categories
		$posts = $portfolio_query->posts;
		shuffle( $posts );
		$portfolio_query->posts = $posts;

		?>

		<div class="grid grid-cols-12 gap-x-5 gap-y-[60px] items-end js-pflo-grid [&.is-all_.is-hidden]:hidden is-all">

			<?php while ( $portfolio_query->have_posts() ) :
				$portfolio_query->the_post();

				$categories = get_the_terms( get_the_ID(), $post_type . '_category' );
				$category_slugs = ! empty( $categories ) && ! is_wp_error( $categories ) ? implode( ' ', wp_list_pluck( $categories, 'slug' ) ) : '';

				$is_deferred = false;
				$should_show = true;

				if ( $post_type === 'showroom' && ! empty( $categories ) && ! is_wp_error( $categories ) ) {
					$should_show = false;

					foreach ( $categories as $cat ) {
						$cat_id = $cat->term_id;

						if ( empty( $category_post_counts[ $cat_id ] ) ) {
							$category_post_counts[ $cat_id ] = 0;
						}

						if ( $category_post_counts[ $cat_id ] < $max_posts_per_category ) {
							$category_post_counts[ $cat_id ]++;
							$should_show = true;
							break;
						}
					}

					if ( ! $should_show ) {
						foreach ( $categories as $cat ) {
							$category_post_counts[ $cat->term_id ]++;
						}
						$is_deferred = true;
					}
				}

				ob_start();
				?>

				<div class="pflo-grid-item <?= $post_type == 'portfolio' ? 'pflo col-span-12 sm:col-span-6 lg:col-span-4 2xl:col-span-3' : 'swrm col-span-6 sm:col-span-4 lg:col-span-3 2xl:col-span-2'; ?> flex flex-col js-element-blurin <?= $is_deferred ? 'is-hidden' : ''; ?>" data-category="<?= esc_attr( $category_slugs ); ?>">

					<a href="<?php the_permalink(); ?>" class="pflo-grid-item-inner flex flex-col gap-y-[10px] group js-pflo-item [&.is-inactive]:grayscale [&.is-inactive]:brightness-[.85] transition-all duration-700 ease-in-out will-change-transform">

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="pflo-grid-item-img overflow-hidden relative">
								<?= get_the_post_thumbnail( get_the_ID(), 'xl', [ 'class' => 'w-full group-hover:inverse' ] ); ?>
							</div>
						<?php endif; ?>

						<div class="pflo-grid-item-title flex flex-wrap self-start border-b-2 border-transparent group-hover:border-black transition-all duration-200">
							<?= get_the_title(); ?>
						</div>

					</a>

				</div>

				<?php
				$post_html = ob_get_clean();

				if ( $is_deferred ) {
					$deferred_posts[] = $post_html;
				} else {
					echo $post_html;
				}

			endwhile;
			wp_reset_postdata();
			?>

			<?php foreach ( $deferred_posts as $html ) {
				echo $html;
			} ?>

		</div>

	<?php else : ?>

		<p>No portfolio items found.</p>

	<?php endif; ?>

</div>