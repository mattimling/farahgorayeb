<?php
$show_preloader = get_field( 'show_preloader', 'options' );
// Always show preloader for not-logged-in users.
// For logged-in users, only show if option is enabled.
$preloader = ( ! is_user_logged_in() || $show_preloader ) ? 1 : 0;
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

<?php $body_classes = 'font-m text-body cursor-crosshair text-black bg-white'; ?>

<body data-barba="js-barba-wrapper" <?php body_class( $body_classes ); ?> style="<?= $preloader ? 'opacity: 0; user-select: none;' : ''; ?>">
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

	if ( is_localhost() ) {
		?>
		<style>
			body::-webkit-scrollbar {
				width: 5px !important;
			}

			body::-webkit-scrollbar-thumb {
				background-color: red !important;
			}
		</style>
		<?php
	}

	// Preload all media
	// get_template_part( 'components/global/preload-media' );
	?>

	<div class="page-wrapper js-page-wrapper" style="<?= $preloader ? 'opacity: 0;' : ''; ?>">
		<main data-barba="js-barba-content" data-barba-namespace="<?= $wp_query->queried_object->post_name ?>">
			<?php get_template_part( 'components/header/header-bar', null, array( 'preloader' => $preloader ) ); ?>

			<div class="js-page-transition">

				<div class="content-wrapper js-content-wrapper relative [&.is-blurry]:blur-[10px] transition-all duration-700 ease-in-out">