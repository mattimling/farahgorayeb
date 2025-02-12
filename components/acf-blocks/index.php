<?php if ( have_rows( 'blocks' ) ) : ?>

	<?php while ( have_rows( 'blocks' ) ) :
		the_row(); ?>

		<?php

		if ( get_row_layout() == 'title_paragraph' ) :
			get_template_part( 'components/acf-blocks/title-paragraph' );

		elseif ( get_row_layout() == 'contact_form' ) :
			get_template_part( 'components/acf-blocks/contact-form' );

		endif;

		?>

	<?php endwhile; ?>

<?php endif; ?>