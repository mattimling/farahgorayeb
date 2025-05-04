<?php if ( have_rows( 'blocks' ) ) : ?>
	<?php while ( have_rows( 'blocks' ) ) :
		the_row(); ?>
		<?php get_template_part( 'components/acf-blocks/_blocks' ); ?>
	<?php endwhile; ?>
<?php endif; ?>