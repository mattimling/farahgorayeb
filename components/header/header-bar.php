<?php
$preloader = $args['preloader'] ?? false;
$website_title = get_field( 'website_title', 'options' );
$logo = get_field( 'logo', 'options' );
$menu_open_text = get_field( 'menu_open_text', 'options' );
$menu_open_icon = get_field( 'menu_open_icon', 'options' );
$menu_close_text = get_field( 'menu_close_text', 'options' );
$menu_close_icon = get_field( 'menu_close_icon', 'options' );
?>

<!-- Header -->
<div class="fixed top-0 left-0 z-50 w-full translate-y-0 js-header-bar">
	<div class="grid grid-cols-3 overflow-hidden text-black relative">
		<div class="flex items-center pl-5">
			<a href="<?= home_url( '/' ) ?>" class="body-link js-logo [&.is-inactive]:pointer-events-none" aria-label="<?= $website_title; ?>">
				<span class="body-link-text">
					<?= $website_title; ?>
				</span>
			</a>
		</div>

		<div class="flex justify-center items-center">
			<a href="<?= home_url( '/' ) ?>" class="w-24 flex [&_path]:fill-black p-5 md:hover:opacity-60 transition-opacity duration-300 js-logo [&.is-inactive]:pointer-events-none" aria-label="<?= esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?= $logo; ?>
			</a>
		</div>

		<div class="">
			<a href="#" class="body-link absolute top-0 right-0 flex items-center h-full [&_path]:fill-black text-black p-5 scale-110 js-menu-open prevent-children [&.is-hidden]:opacity-0 [&.is-hidden]:pointer-events-none transition-all duration-300" aria-label="<?= $menu_open_text; ?>">
				<span class="mr-[2px] body-link-text">
					<?= $menu_open_text; ?>
				</span>

				<!-- <span class="">
				<?= $menu_open_icon; ?>
			</span> -->
			</a>

			<a href="#" class="body-link absolute top-0 right-0 flex items-center h-full [&_path]:fill-black text-black p-5 scale-110 js-menu-close [&.is-hidden]:opacity-0 [&.is-hidden]:pointer-events-none is-hidden prevent-children transition-all duration-300" aria-label="<?= $menu_close_text; ?>">
				<span class="mr-[2px] body-link-text">
					<?= $menu_close_text; ?>
				</span>

				<!-- <span class="">
				<?= $menu_close_icon; ?>
			</span> -->
			</a>
		</div>
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
			<?php
			if ( function_exists( 'icl_get_languages' ) ) {
				$languages = icl_get_languages( 'skip_missing=1&orderby=code&return_url=1' );

				if ( ! empty( $languages ) ) {
					$active_languages = [];
					$inactive_languages = [];

					// Separate active and inactive
					foreach ( $languages as $language ) {
						if ( $language['active'] ) {
							$active_languages[] = $language;
						} else {
							$inactive_languages[] = $language;
						}
					}

					// Merge: active first
					$sorted_languages = array_merge( $active_languages, $inactive_languages );
					$last_index = count( $sorted_languages ) - 1;
					$index = 0;

					foreach ( $sorted_languages as $language ) {
						$lang_code = strtoupper( $language['language_code'] );
						$class = $language['active'] ? 'is-active pointer-events-none body-link-h1 [&.is-active]:border-b-black' : 'body-link-h1 transition-all duration-300';
						$href = $language['active'] ? '#' : esc_url( $language['url'] );

						echo '<a href="' . $href . '" hreflang="' . esc_attr( $language['language_code'] ) . '" class="js-menu-link ml-5 ' . esc_attr( $class ) . '">' . esc_html( $lang_code ) . '</a>';

						if ( $index < $last_index ) {
							echo ', ';
						}

						$index++;
					}
				}
			}
			?>

			<!-- <a href="#" class="body-link-h1 [&.is-active]:border-b-black is-active">
				EN
			</a>,
			<a href="#" class="ml-5 body-link-h1">
				FR
			</a> -->
		</div>
	</div>
</div>