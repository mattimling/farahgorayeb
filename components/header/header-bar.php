<?php

$full_logo = get_field( 'full_logo', 'options' );
$short_logo = get_field( 'short_logo', 'options' );
$menu_icon = get_field( 'menu_icon', 'options' );

?>

<!-- Header -->
<div class="fixed top-0 left-0 z-50 mix-blend-difference flex justify-between items-start -mb-5 overflow-hidden w-full">

	<?php if ( is_front_page() ) : ?>
		<div class="w-[260px] flex [&_path]:fill-white m-5">
			<?= $full_logo; ?>
		</div>
	<?php else : ?>
		<a href="<?= home_url( '/' ) ?>" class="w-[50px] flex [&_path]:fill-white m-5" aria-label="Fernando Pozuelo">
			<?= $short_logo; ?>
		</a>
	<?php endif; ?>

	<a href="#" class="flex [&_path]:fill-white p-5 scale-110 mr-[1px] js-menu-open prevent-children hover:opacity-50 transition-all duration-300" aria-label="Open menu">
		<?= $menu_icon; ?>
	</a>

</div>

<!-- Menu -->
<div class="fixed top-0 right-0 is-close [&.is-close]:translate-x-full transition-all duration-500 ease-in-out z-50 w-full md:max-w-[420px] h-full bg-charcoal text-white flex flex-col shadow-xl js-menu">

	<?php

	$close_icon = get_field( 'close_icon', 'options' );
	$background_decoration = get_field( 'background_decoration', 'options' );

	?>

	<!-- Close -->
	<div class="flex justify-end">
		<a href="#" class="w-15 h-15 p-5 hover-gold prevent-children js-menu-close" aria-label="Close menu">
			<?= $close_icon; ?>
		</a>
	</div>

	<!-- Menu -->
	<div class="flex flex-col justify-center items-center gap-y-10 flex-1">

		<?php while ( have_rows( 'menu', 'options' ) ) :
			the_row();

			$link = get_sub_field( 'link' );
			$image = get_sub_field( 'image' );
			?>

			<?php if ( $link ) : ?>

				<?php

				$url = esc_url( $link['url'] );
				$title = acf_esc_html( $link['title'] );

				?>

				<a href="<?= $url; ?>" class="text-pr-sm uppercase text-white [&.is-active]:text-gold hover:text-gold transition-all duration-300 <?= is_page() && ( get_permalink() == $link['url'] || is_page_descendant( get_the_ID(), $link['url'] ) ) ? 'is-active' : ''; ?>">
					<?= $title; ?>
				</a>

			<?php endif; ?>

		<?php endwhile; ?>

	</div>

	<!-- Lang menu -->
	<div class="flex py-10 justify-center text-pr-sm uppercase">

		<?php if ( function_exists( 'icl_get_languages' ) ) :
			$languages = icl_get_languages( 'skip_missing=1&orderby=code' );
			?>

			<?php if ( ! empty( $languages ) ) : ?>

				<?php foreach ( $languages as $language ) : ?>

					<?php if ( ! $language['active'] ) : ?>

						<a href="<?= $language['url']; ?>" hreflang="<?= $language['language_code']; ?>" class="hover:text-gold transition-all duration-300">
							<?= $language['native_name']; ?>
						</a>

					<?php endif; ?>

				<?php endforeach; ?>

			<?php endif; ?>

		<?php endif; ?>

	</div>

	<!-- Socials -->
	<div class="flex justify-center items-center gap-x-5 pb-10">

		<?php while ( have_rows( 'socials', 'options' ) ) :
			the_row();

			$icon = get_sub_field( 'icon' );
			$link = get_sub_field( 'link' );
			$image = get_sub_field( 'image' );
			?>

			<?php if ( $link ) : ?>

				<?php

				$url = esc_url( $link['url'] );
				$title = acf_esc_html( $link['title'] );

				?>

				<a href="<?= $url; ?>" class="w-9 h-9 p-2 flex hover-gold" aria-label="<?= $title; ?>" target="<?= $link['target']; ?>">
					<?= $icon; ?>
				</a>

			<?php endif; ?>

		<?php endwhile; ?>

	</div>

	<!-- BG Pattern -->
	<div class="flex justify-center w-full hid">
		<div class="">
			<?= $background_decoration; ?>
		</div>
	</div>

</div>