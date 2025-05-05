<?php
$portfolio_page = get_field( 'portfolio_page', 'options' );
$showroom_page = get_field( 'showroom_page', 'options' );
?>

<?php get_template_part( 'components/header/header' ); ?>

<div class="flex flex-col gap-y-[60px] mt-[71px] py-[60px]">
	<?php
	if ( is_tax() ) {
		$current_term = get_queried_object();

		if ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'portfolio_category' ) {
			$post_type = 'portfolio';
			$page_url = $portfolio_page;
		} elseif ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'showroom_category' ) {
			$post_type = 'showroom';
			$page_url = $showroom_page;
		}

		// Convert URL to post ID
		if ( isset( $page_url ) && $page_url ) {
			$page_id = url_to_postid( $page_url );

			if ( $page_id ) {
				// Output ACF flexible content if available
				if ( have_rows( 'blocks', $page_id ) ) : ?>
					<div class="flex flex-col gap-y-[60px]">
						<?php
						while ( have_rows( 'blocks', $page_id ) ) {
							the_row();
							get_template_part( 'components/acf-blocks/_blocks' );
						}
						?>
					</div>
				<?php endif;
			}
		}
	}

	// Load archive grid - right now loaded from the content ACF
	// get_template_part( 'components/acf-blocks/_projects', null, array(
	// 	'post_type' => $post_type ?? '',
	// ) );
	?>
</div>

<?php get_template_part( 'components/footer/footer' ); ?>