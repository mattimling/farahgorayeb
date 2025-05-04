<?php
if ( is_404() ) {
	get_template_part( 'pages/404' );
}
?>

<?php get_template_part( 'components/header/header' ); ?>

<div class="flex flex-col gap-y-20 lg:gap-y-40 py-20 lg:py-40 mt-10">
	<div class="px-5 max-w-[1000px] mx-auto flex flex-col gap-y-10 content-page">
		<?php the_content(); ?>
	</div>
</div>

<?php get_template_part( 'components/footer/footer' ); ?>