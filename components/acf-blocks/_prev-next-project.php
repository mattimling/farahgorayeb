<?php
if ( is_singular( 'portfolio' ) || is_singular( 'showroom' ) ) :

	// Detect post type
	$post_type = get_post_type();
	// Set the appropriate taxonomy for the current post type (only used for single post pages)
	$taxonomy = ( $post_type === 'portfolio' ) ? 'portfolio_category' : 'showroom_category';

	$project_format = ( $post_type === 'portfolio' ) ? 'Project' : 'Product';

	// Get the current post's terms for the appropriate taxonomy
	$terms = get_the_terms( get_the_ID(), $taxonomy );
	$term_ids = $terms ? wp_list_pluck( $terms, 'term_id' ) : [];

	$prev_post = get_previous_post( false );
	$next_post = get_next_post( false );

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
						<span>Prev</span>
						<span><?= $project_format; ?></span>
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
						<span>Next</span>
						<span><?= $project_format; ?></span>
					</div>

				</a>

			<?php endif; ?>
		</div>

	</div>

<?php endif; ?>