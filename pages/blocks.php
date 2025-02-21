<?php
/* 
	Template Name: Blocks
 */
?>

<?php get_template_part( 'components/header/header' ); ?>

<?php if ( class_exists( 'ACF' ) ) : ?>

	<div class="flex flex-col gap-y-[60px] mt-[71px] py-[60px]">

		<?php get_template_part( 'components/acf-blocks/index' ); ?>

	</div>

<?php else : ?>

	Theme needs ACF plugin to work properly

<?php endif; ?>

<?php get_template_part( 'components/footer/footer' ); ?>