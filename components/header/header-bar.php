<?php

$logo = get_field( 'logo', 'options' );
$menu_open_text = get_field( 'menu_open_text', 'options' );
$menu_open_icon = get_field( 'menu_open_icon', 'options' );
$menu_close_text = get_field( 'menu_close_text', 'options' );
$menu_close_icon = get_field( 'menu_close_icon', 'options' );

?>

<!-- Header -->
<div class="fixed top-0 left-0 z-50 w-full translate-y-0">

	<div class="flex justify-between overflow-hidden text-black relative">

		<a href="<?= home_url( '/' ) ?>" class="w-24 flex [&_path]:fill-black p-5 hover:opacity-60 transition-opacity duration-300 js-logo [&.is-inactive]:pointer-events-none" aria-label="<?= esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?= $logo; ?>
		</a>

		<a href="#" class="body-link absolute top-0 right-0 flex items-center h-full [&_path]:fill-black text-black p-5 scale-110 js-menu-open prevent-children [&.is-hidden]:opacity-0 [&.is-hidden]:pointer-events-none transition-all duration-300" aria-label="<?= $menu_open_text; ?>">
			<span class="mr-[10px] body-link-text">
				<?= $menu_open_text; ?>
			</span>

			<span class="">
				<?= $menu_open_icon; ?>
			</span>
		</a>

		<a href="#" class="body-link absolute top-0 right-0 flex items-center h-full [&_path]:fill-black text-black p-5 scale-110 js-menu-close [&.is-hidden]:opacity-0 [&.is-hidden]:pointer-events-none is-hidden prevent-children transition-all duration-300" aria-label="<?= $menu_close_text; ?>">
			<span class="mr-[10px] body-link-text">
				<?= $menu_close_text; ?>
			</span>

			<span class="">
				<?= $menu_close_icon; ?>
			</span>
		</a>

	</div>

	<div class="mx-5 border-b"></div>

</div>

<!-- Menu -->
<div class="fixed top-0 left-0 h-full w-full z-10 is-close [&.is-close]:opacity-0 [&.is-close]:pointer-events-none transition-opacity duration-500 ease-in-out js-menu">

	<!-- Overlay -->
	<div class="absolute top-0 left-0 w-full h-full bg-white opacity-60"></div>

	<div class="flex flex-col w-full h-full justify-between p-5 relative z-10">

		<!-- Menu -->
		<div class="mt-20 flex flex-wrap text-h1 [&_.menu-item:last-child_.menu-comma]:hidden">

			<?php while ( have_rows( 'menu', 'options' ) ) :
				the_row();

				$link = get_sub_field( 'link' );
				?>

				<?php if ( $link ) : ?>

					<?php

					$url = esc_url( $link['url'] );
					$title = acf_esc_html( $link['title'] );

					?>

					<div class="flex menu-item">
						<a href="<?= $url; ?>" class="js-menu-link body-link-h1 [&.is-active]:border-b-black <?= is_page() && ( get_permalink() == $link['url'] || is_page_descendant( get_the_ID(), $link['url'] ) ) ? 'is-active' : ''; ?>">
							<?= $title; ?>
						</a>

						<span class="mr-5 menu-comma">
							,
						</span>
					</div>

				<?php endif; ?>

			<?php endwhile; ?>

		</div>

		<!-- Lang menu -->
		<div class="text-h1 flex">

			<a href="#" class="body-link-h1 [&.is-active]:border-b-black is-active">
				EN
			</a>,
			<a href="#" class="ml-5 body-link-h1">
				FR
			</a>

		</div>

	</div>

</div>