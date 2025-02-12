<?php

if ( is_user_logged_in() ) {
	$preloader = false;
} else {
	$preloader = true;
}

$google_tag_manager_head_code = get_field( 'google_tag_manager_head_code', 'options' );
$google_tag_manager_body_code = get_field( 'google_tag_manager_body_code', 'options' );

?>

<!doctype html>

<html <?php language_attributes(); ?> style="background-color: #0A1612;">

<head>
	<?= $google_tag_manager_head_code; ?>

	<meta name="author" content="MattImling.com">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

	<?php wp_head(); ?>

	<style>
		.otgs-development-site-front-end {
			display: hidden !important;
			opacity: 0 !important;
			visibility: hidden !important;
			position: fixed;
			top: -9999px !important;
			left: -9999px !important;
			z-index: -9999;
		}
	</style>
</head>

<?php $body_classes = 'font-nr text-pr-md Xselect-none cursor-default text-charcoal bg-white'; ?>

<body data-barba="js-barba-wrapper" <?php body_class( $body_classes ); ?> style="<?= ! $preloader ? 'opacity: 0;' : ''; ?>">

	<?= $google_tag_manager_body_code; ?>

	<?php

	// Tailwind breakpoints only on localhost
	if ( is_localhost() ) {
		get_template_part( 'components/dev/tailwind-breakpoints' );
	}

	// Preloader only if preloader = true
	if ( $preloader ) {
		get_template_part( 'components/global/preloader' );
	} else {
		?>
		<script>
			setTimeout(event => {
				document.querySelector('html').style.backgroundColor = '';
				document.querySelector('body').style.opacity = '1';
			}, 1000);
		</script>
		<?php
	}

	// Preload all media
	get_template_part( 'components/global/preload-media' );

	// Page transition
	get_template_part( 'components/global/page-transition' );

	?>

	<div class="page-wrapper js-page-wrapper" style="<?= $preloader ? 'display: none;' : ''; ?>">

		<main data-barba="js-barba-content" data-barba-namespace="<?= $wp_query->queried_object->post_name ?>">

			<div class="content-wrapper relative js-page-transition min-h-screen">

				<?php get_template_part( 'components/header/header-bar' ); ?>