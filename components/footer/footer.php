<!-- Include form on each page which is not blocks - to include JS for Barba.js-->
<div class="hidden invisible">

	<?php

	$page_template = str_replace( '.php', '', basename( get_page_template() ) );

	echo $page_template;

	if ( $page_template != 'blocks' ) {
		get_template_part( 'components/acf-blocks/contact-form' );
	}

	?>

</div>

<?php get_template_part( 'components/footer/footer-bar' ); ?>

</div><!-- .content-wrapper -->

</div><!-- .page-wrapper -->

<?php wp_footer(); ?>

</body>

</html>