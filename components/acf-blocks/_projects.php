<?php
$args = isset( $args ) ? $args : array();
$post_type = $args['post_type'];

$portfolio_page = get_field( 'portfolio_page', 'options' );
$showroom_page = get_field( 'showroom_page', 'options' );
?>

<!-- Filter -->
<?php
$terms = get_terms( array(
	'taxonomy' => $post_type . '_category',
	'hide_empty' => true,
) );
?>

<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
	<?php
	// Count all published posts for the current post type
	// $post_type_object = get_post_type_object( $post_type );
	$current_lang = apply_filters( 'wpml_current_language', null );

	$all_query = new WP_Query( [ 
		'post_type' => $post_type,
		'post_status' => 'publish',
		'lang' => $current_lang, // WPML language filter
		'posts_per_page' => -1,
		'fields' => 'ids', // optimize performance
	] );

	$all_count = $all_query->found_posts;
	?>

	<div class="px-5 text-h1 flex flex-wrap [&_.item:last-child_.comma]:hidden">
		<div class="flex item js-element-blurin">
			<a href="<?php echo esc_url( $page = $post_type == 'portfolio' ? $portfolio_page : $showroom_page ); ?>" class="body-link-h1 [&.is-active]:border-b-black <?php if ( ! is_tax( $post_type . '_category' ) )
							 echo 'is-active'; ?>">
				<?php _e( 'All', 'fargor' ); ?>
				<span class="relative -top-[5px]">(</span><?= $all_count; ?><span class="relative -top-[5px]">)</span>
			</a>
			<span class="mr-5 comma">,</span>
		</div>

		<!-- Parent categories -->
		<?php $current_term = is_tax( $post_type . '_category' ) ? get_queried_object() : null; ?>
		<?php foreach ( $terms as $term ) :
			if ( $term->parent !== 0 ) {
				continue;
			}

			$is_active = $current_term && (
				$current_term->term_id === $term->term_id || // current term is this parent
				$current_term->parent === $term->term_id     // current term is child of this parent
			);
			?>
			<div class="flex item js-element-blurin">
				<a href="<?= esc_url( get_term_link( $term ) ); ?>" class="body-link-h1 [&.is-active]:border-b-black <?php if ( $is_active )
						  echo 'is-active'; ?>" data-category="<?= esc_html( $term->slug ); ?>">
					<?= esc_html( $term->name ); ?>
				</a>
				<span class="mr-5 comma">,</span>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Children categories -->
	<div class="mx-5 relative transition-all duration-300">
		<?php
		// First, index children by parent
		$children_by_parent = [];
		foreach ( $terms as $term ) {
			if ( $term->parent !== 0 ) {
				$children_by_parent[ $term->parent ][] = $term;
			}
		}
		?>

		<?php
		foreach ( $children_by_parent as $parent_id => $children ) :
			$parent_term = get_term( $parent_id, $post_type . '_category' );
			if ( is_wp_error( $parent_term ) || ! $parent_term ) {
				continue;
			}

			// Check if current term is parent or a child of this parent
			$is_child_active = $current_term && $current_term->parent === $parent_id;
			$is_parent_active = $current_term && $current_term->term_id === $parent_id;
			$is_container_active = $is_child_active || $is_parent_active;
			?>
			<div class="hidden text-h3 [&_.item:last-child_.comma]:hidden [&.is-active]:flex flex-wrap <?php if ( $is_container_active )
				echo 'is-active'; ?>" data-category="<?= esc_attr( $parent_term->slug ); ?>">
				<?php foreach ( $children as $term ) :
					$is_active = $current_term && $current_term->term_id === $term->term_id;
					?>
					<div class="item flex js-element-blurin">
						<a href="<?= esc_url( get_term_link( $term ) ); ?>" class="body-link-h3 body-link-h1 [&.is-active]:border-b-black <?php if ( $is_active )
								  echo 'is-active'; ?>">
							<?= esc_html( $term->name ); ?>
						</a>
						<span class="mr-2 md:mr-3 comma">,</span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>

	</div>
<?php endif; ?>

<?php
// Create an empty array to store ordered posts
$ordered_posts = [];

if ( is_tax( $post_type . '_category' ) ) {
	$current_term = get_queried_object();

	if ( $current_term && ! is_wp_error( $current_term ) ) {

		// Get children of the current term
		$children = get_terms( array(
			'taxonomy' => $post_type . '_category',
			'parent' => $current_term->term_id,
			'hide_empty' => false,
			'orderby' => 'menu_order',
			'order' => 'ASC',
		) );

		// If it has children, fetch posts from each child category in order
		if ( $children && ! is_wp_error( $children ) && count( $children ) > 0 ) {
			foreach ( $children as $child_term ) {
				$child_query = new WP_Query( array(
					'post_type' => $post_type,
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => $post_type . '_category',
							'field' => 'term_id',
							'terms' => $child_term->term_id,
						),
					),
					'orderby' => 'title',
					'order' => 'ASC',
				) );

				if ( $child_query->have_posts() ) {
					while ( $child_query->have_posts() ) {
						$child_query->the_post();
						$ordered_posts[] = get_post(); // store full post object
					}
				}
				wp_reset_postdata();
			}
		} else {
			// Just show posts from current term if no children
			$portfolio_query = new WP_Query( array(
				'post_type' => $post_type,
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => $post_type . '_category',
						'field' => 'slug',
						'terms' => $current_term->slug,
					),
				),
				'orderby' => 'title',
				'order' => 'ASC',
			) );
		}
	}
} else {
	// On "All Projects" (not a category), random order
	$portfolio_query = new WP_Query( array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'rand',
	) );
}
?>

<!-- Grid -->
<div class="px-5">
	<?php if ( ! empty( $ordered_posts ) || ( isset( $portfolio_query ) && $portfolio_query->have_posts() ) ) : ?>
		<div class="grid grid-cols-12 gap-x-5 gap-y-[60px] items-end">

			<?php
			// Loop through manually collected posts
			if ( ! empty( $ordered_posts ) ) :
				foreach ( $ordered_posts as $post ) :
					setup_postdata( $post );
					$categories = get_the_terms( get_the_ID(), $post_type . '_category' );
					$category_slugs = ! empty( $categories ) && ! is_wp_error( $categories ) ? implode( ' ', wp_list_pluck( $categories, 'slug' ) ) : '';
					?>

					<div class="pflo-grid-item <?= $post_type == 'portfolio' ? 'pflo col-span-12 sm:col-span-6 lg:col-span-4 2xl:col-span-3' : 'swrm col-span-6 sm:col-span-4 lg:col-span-3 2xl:col-span-2'; ?> flex flex-col js-element-blurin" data-category="<?= esc_attr( $category_slugs ); ?>">
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
				endforeach;
				wp_reset_postdata();
			elseif ( isset( $portfolio_query ) ) :
				while ( $portfolio_query->have_posts() ) :
					$portfolio_query->the_post();
					$categories = get_the_terms( get_the_ID(), $post_type . '_category' );
					$category_slugs = ! empty( $categories ) && ! is_wp_error( $categories ) ? implode( ' ', wp_list_pluck( $categories, 'slug' ) ) : '';
					?>

					<div class="pflo-grid-item <?= $post_type == 'portfolio' ? 'pflo col-span-12 sm:col-span-6 lg:col-span-4 2xl:col-span-3' : 'swrm col-span-6 sm:col-span-4 lg:col-span-3 2xl:col-span-2'; ?> flex flex-col js-element-blurin" data-category="<?= esc_attr( $category_slugs ); ?>">
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

				<?php endwhile;
				wp_reset_postdata();
			endif; ?>
		</div>
	<?php endif; ?>
</div>