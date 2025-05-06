<?php
/* 
	Template Name: Blocks
 */
?>

<?php get_template_part( 'components/header/header' ); ?>

<?php if ( class_exists( 'ACF' ) ) : ?>
	<div class="flex flex-col gap-y-[60px] mt-[71px] py-[60px]">
		<?php get_template_part( 'components/acf-blocks/index' ); ?>

		<?php
		if ( is_singular( [ 'portfolio', 'showroom' ] ) ) {
			// get_template_part( 'components/acf-blocks/_prev-next-project' );
			get_template_part( 'components/acf-blocks/_related-projects' );
		}
		?>
	</div>
<?php endif; ?>

<?php get_template_part( 'components/footer/footer' ); ?>