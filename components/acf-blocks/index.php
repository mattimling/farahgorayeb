<?php if ( have_rows( 'blocks' ) ) : ?>

	<?php while ( have_rows( 'blocks' ) ) :
		the_row(); ?>

		<?php

		if ( get_row_layout() == 'hero_image_video' ) :
			get_template_part( 'components/acf-blocks/hero-image-video' );

		elseif ( get_row_layout() == 'title_paragraph' ) :
			get_template_part( 'components/acf-blocks/title-paragraph' );

		elseif ( get_row_layout() == 'title_paragraph_indented' ) :
			get_template_part( 'components/acf-blocks/title-paragraph-indented' );

		elseif ( get_row_layout() == 'call_to_action' ) :
			get_template_part( 'components/acf-blocks/call-to-action' );

		elseif ( get_row_layout() == 'image_full_screen' ) :
			get_template_part( 'components/acf-blocks/image-full-screen' );

		elseif ( get_row_layout() == 'image_image' ) :
			get_template_part( 'components/acf-blocks/image-image' );

		elseif ( get_row_layout() == 'portfolio' ) :
			get_template_part( 'components/acf-blocks/portfolio' );

		elseif ( get_row_layout() == 'showroom' ) :
			get_template_part( 'components/acf-blocks/showroom' );

		elseif ( get_row_layout() == 'simple_content' ) :
			get_template_part( 'components/acf-blocks/simple-content' );

		endif;

		?>

	<?php endwhile; ?>

<?php endif; ?>