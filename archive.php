<?php get_template_part( 'components/header/header' ); ?>

<div class="flex flex-col gap-y-[60px] mt-[71px] py-[60px]">
	<?php
	// Check if we're on a taxonomy archive page
	if ( is_tax() ) {
		// Get the current term object
		$current_term = get_queried_object();

		// Optionally, check if the term belongs to a specific taxonomy
		if ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'portfolio_category' ) {
			// Set the post type based on the category (example 'portfolio')
			$post_type = 'portfolio';
		} elseif ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'showroom_category' ) {
			// If another taxonomy, set a different post type
			$post_type = 'showroom';
		}
	}

	// Pass the dynamically determined post type to the template part
	get_template_part( 'components/acf-blocks/_projects', null, array(
		'post_type' => $post_type,
	) );
	?>
</div>

<?php get_template_part( 'components/footer/footer' ); ?>