<?php
$post_type = get_post_type();
$taxonomy = ( $post_type === 'portfolio' ) ? 'portfolio_category' : 'showroom_category';

$related_title = ( $post_type === 'portfolio' ) ? get_field( 'related_projects_title', 'options' ) : get_field( 'related_products_title', 'options' );
$view_all = ( $post_type === 'portfolio' ) ? get_field( 'view_all_projects_title', 'options' ) : get_field( 'view_all_products_title', 'options' );

// Try to get Yoast SEO primary term
$primary_term = null;
if ( class_exists( 'WPSEO_Primary_Term' ) ) {
	$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, get_the_ID() );
	$primary_term_id = $wpseo_primary_term->get_primary_term();

	if ( is_numeric( $primary_term_id ) && $primary_term_id > 0 ) {
		$term = get_term( $primary_term_id, $taxonomy );
		if ( ! is_wp_error( $term ) ) {
			$primary_term = $term;
		}
	}
}

// Fallback to first assigned term
if ( ! $primary_term ) {
	$terms = get_the_terms( get_the_ID(), $taxonomy );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$primary_term = $terms[0];
	}
}

// Now query 8 random posts from the same category
$items = [];
if ( $primary_term ) {
	$args = [ 
		'post_type' => $post_type,
		'posts_per_page' => 8,
		'post_status' => 'publish',
		'post__not_in' => [ get_the_ID() ],
		'orderby' => 'rand',
		'tax_query' => [ 
			[ 
				'taxonomy' => $taxonomy,
				'field' => 'term_id',
				'terms' => $primary_term->term_id,
			],
		],
		// Optional: restrict to current language if using WPML
		'lang' => apply_filters( 'wpml_current_language', null ),
	];

	$items = get_posts( $args );
}
?>

<?php if ( $items ) : ?>
	<!-- Title -->
	<?php if ( $related_title ) : ?>
		<div class="px-5 js-element-blurin pt-[60px]">
			<h3 class="text-h1">
				<?= $related_title; ?>
			</h3>
		</div>
	<?php endif; ?>

	<!-- Slider -->
	<div class="projects-slider">
		<div class="px-5 js-swip overflow-hidden">
			<div class="swiper-wrapper flex items-end cursor-slider">
				<?php foreach ( $items as $post ) : ?>
					<div class="swiper-slide mr-5 [&:last-of-type]:mr-0 js-element-blurin !w-[calc(55%-(20px/2))] sm:!w-[calc(40%-(40px/3))] md:!w-[calc(28.57%-(60px/4))] lg:!w-[calc(22.22%-(80px/5))] 2xl:!w-[calc(18.18%-(100px/6))]">
						<?php
						// Setup this post for WP functions (variable must be named $post).
						setup_postdata( $post );
						?>

						<div class="flex flex-col gap-y-[10px] body-links">
							<div class="overflow-hidden projects">
								<?php if ( has_post_thumbnail() ) : ?>
									<?= get_the_post_thumbnail( get_the_ID(), 'xl', [ 'class' => 'w-full h-full object-cover' ] ); ?>
								<?php endif; ?>
							</div>

							<a href="<?= get_the_permalink(); ?>" class="projects-slider-item self-start">
								<?= get_the_title(); ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>
	</div>

	<!-- Link -->
	<?php if ( $primary_term ) : ?>
		<div class="px-5 js-element-blurin">
			<a href="<?= esc_url( get_term_link( $primary_term ) ); ?>" class="text-h2 body-link-h1-inverted">
				<?= $view_all; ?>
			</a>
		</div>
	<?php endif; ?>
<?php endif; ?>