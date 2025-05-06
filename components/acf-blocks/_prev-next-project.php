<?php
$prev_project_title = get_field( 'previous_project_title', 'options' );
$next_project_title = get_field( 'next_project_title', 'options' );

$prev_product_title = get_field( 'previous_product_title', 'options' );
$next_product_title = get_field( 'next_product_title', 'options' );
?>

<?php
if ( is_singular( 'portfolio' ) || is_singular( 'showroom' ) ) :
	// Detect post type
	$post_type = get_post_type();
	// Set the appropriate taxonomy for the current post type (only used for single post pages)
	$taxonomy = ( $post_type === 'portfolio' ) ? 'portfolio_category' : 'showroom_category';

	// Get the current post's terms for the appropriate taxonomy
	$terms = get_the_terms( get_the_ID(), $taxonomy );
	$term_ids = $terms ? wp_list_pluck( $terms, 'term_id' ) : [];

	$current_post_id = get_the_ID();
	$current_post_date = get_the_date( 'Y-m-d H:i:s', $current_post_id );

	// Build term filter
	$tax_query = [];
	if ( ! empty( $term_ids ) ) {
		$tax_query = [ 
			[ 
				'taxonomy' => $taxonomy,
				'field' => 'term_id',
				'terms' => $term_ids,
			]
		];
	}

	// Get next post (later than current)
	$next_query = new WP_Query( [ 
		'post_type' => $post_type,
		'posts_per_page' => 1,
		'orderby' => 'date',
		'order' => 'ASC',
		'post_status' => 'publish',
		'date_query' => [ 
			[ 
				'after' => $current_post_date,
				'inclusive' => false,
			],
		],
		'tax_query' => $tax_query,
	] );
	$next_post = $next_query->have_posts() ? $next_query->next_post() : null;

	// Get previous post (earlier than current)
	$prev_query = new WP_Query( [ 
		'post_type' => $post_type,
		'posts_per_page' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'publish',
		'date_query' => [ 
			[ 
				'before' => $current_post_date,
				'inclusive' => false,
			],
		],
		'tax_query' => $tax_query,
	] );
	$prev_post = $prev_query->have_posts() ? $prev_query->next_post() : null;
	?>

	<div class="px-4 flex justify-between">
		<!-- Prev -->
		<div class="flex flex-col h-full js-prev-next-link max-md:w-1/2">
			<?php if ( $next_post ) : ?>
				<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="text-black hover:underline text-h2 relative group">
					<div class="absolute top-0 left-1/4 aspect-[124/156] h-full z-0 js-prev-next-link-img opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out max-md:hidden pointer-events-none">
						<?php if ( has_post_thumbnail( $next_post->ID ) ) : ?>
							<?php echo get_the_post_thumbnail( $next_post->ID, 'xl', array( 'class' => 'w-full h-full object-cover' ) ); ?>
						<?php endif; ?>
					</div>

					<div class="h-full py-12 relative z-[1] underline max-md:flex max-md:flex-col">
						<?= ( $post_type === 'portfolio' ) ? $prev_project_title : $prev_product_title; ?>
					</div>
				</a>
			<?php endif; ?>
		</div>

		<!-- Next -->
		<div class="flex-col h-full js-prev-next-link max-md:w-1/2">
			<?php if ( $prev_post ) : ?>
				<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="text-black hover:underline text-h2 relative group">
					<div class="absolute top-0 left-1/4 aspect-[124/156] h-full z-0 js-prev-next-link-img opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out max-md:hidden pointer-events-none">
						<?php if ( has_post_thumbnail( $prev_post->ID ) ) : ?>
							<?php echo get_the_post_thumbnail( $prev_post->ID, 'xl', array( 'class' => 'w-full h-full object-cover' ) ); ?>
						<?php endif; ?>
					</div>

					<div class="h-full py-12 relative z-[1] underline md:text-right max-md:flex max-md:flex-col">
						<?= ( $post_type === 'portfolio' ) ? $next_project_title : $next_product_title; ?>
					</div>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>