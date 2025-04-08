<?php

$preloader = is_localhost() ? 1 : 1;

?>

<!doctype html>

<html <?php language_attributes(); ?> style="background-color: #FFF9F3; <?= $preloader ? 'overflow: hidden; pointer-events: none;' : ''; ?>">

<head>
	<meta name="author" content="MattImling.com">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

	<?php wp_head(); ?>

	<!-- <style>
		.otgs-development-site-front-end {
			display: hidden !important;
			opacity: 0 !important;
			visibility: hidden !important;
			position: fixed;
			top: -9999px !important;
			left: -9999px !important;
			z-index: -9999;
		}
	</style> -->
</head>

<?php $body_classes = 'font-m text-body select-none cursor-crosshair text-black bg-white'; ?>

<body data-barba="js-barba-wrapper" <?php body_class( $body_classes ); ?> style="<?= $preloader ? 'opacity: 0;' : ''; ?>">

	<?php

	// Tailwind breakpoints only on localhost
	if ( is_localhost() ) {
		get_template_part( 'components/dev/tailwind-breakpoints' );

		// get_template_part( 'components/dev/menu' );
	}

	// Preloader only if preloader = true
	if ( $preloader ) {
		get_template_part( 'components/global/preloader', null, array( 'preloader' => $preloader ) );
	}

	// Preload all media
	get_template_part( 'components/global/preload-media' );

	?>

	<?php get_template_part( 'components/header/header-bar', null, array( 'preloader' => $preloader ) ); ?>

	<div class=" page-wrapper js-page-wrapper" style="<?= $preloader ? 'opacity: 0;' : ''; ?>">

		<main data-barba="js-barba-content" data-barba-namespace="<?= $wp_query->queried_object->post_name ?>">

			<div class="content-wrapper js-content-wrapper relative [&.is-blurry]:blur-[10px] transition-all duration-700 ease-in-out">