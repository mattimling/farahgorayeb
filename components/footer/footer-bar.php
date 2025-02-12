<?php

$copyright = get_field( 'copyright', 'options' );

?>

<div class="flex max-md:flex-col max-md:items-center max-md:gap-y-3 justify-between p-5 text-[15px] <?= is_front_page() ? 'bg-charcoal text-gold' : ''; ?>">

	<!-- Copyright -->
	<div class="<?= is_front_page() ? 'opacity-30' : 'opacity-50'; ?> flex gap-x-5">

		<?= $copyright; ?>

	</div>

	<!-- Menu -->
	<div class="flex gap-x-5 max-md:flex-col max-md:items-center max-md:gap-y-3">

		<div class="flex gap-x-5 max-md:order-2">

			<?php if ( have_rows( 'socials_menu', 'options' ) ) : ?>

				<?php while ( have_rows( 'socials_menu', 'options' ) ) :
					the_row();

					$link = get_sub_field( 'link' );
					$icon = get_sub_field( 'icon' );
					?>

					<?php if ( $link ) : ?>

						<?php if ( $icon ) : ?>

							<a href="<?= $link['url'] ?>" class="transition-all duration-150 hover:opacity-100 <?= is_front_page() ? 'opacity-30' : 'opacity-50'; ?>" target="<?= $link['target']; ?>" aria-label="<?= $link['title']; ?>">
								<span class="<?= is_front_page() ? '[&_path]:fill-gold' : '[&_path]:fill-charcoal'; ?>">
									<?= $icon; ?>
								</span>
							</a>

						<?php endif; ?>

					<?php endif; ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div>

		<div class="flex gap-x-5 gap-y-3 max-md:order-1 flex-wrap justify-center items-center">

			<?php if ( have_rows( 'footer_menu', 'options' ) ) : ?>

				<?php while ( have_rows( 'footer_menu', 'options' ) ) :
					the_row();

					$link = get_sub_field( 'link' );
					$classes = is_front_page() ? 'opacity-30' : 'opacity-50';
					?>

					<?= mi_get_link( $link, 'link-no-underline hover:opacity-100 ' . $classes ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div>

	</div>

</div>