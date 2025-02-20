<?php if ( have_rows( 'blocks' ) ) : ?>

	<?php while ( have_rows( 'blocks' ) ) :
		the_row(); ?>

		<?php

		if ( get_row_layout() == 'hero_image_video' ) :
			get_template_part( 'components/acf-blocks/hero-image-video' );

		elseif ( get_row_layout() == 'title_paragraph' ) :
			get_template_part( 'components/acf-blocks/title-paragraph' );

		elseif ( get_row_layout() == 'call_to_action' ) :
			get_template_part( 'components/acf-blocks/call-to-action' );

		endif;

		?>

	<?php endwhile; ?>

<?php endif; ?>