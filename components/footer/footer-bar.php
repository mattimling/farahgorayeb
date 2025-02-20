<?php

$copyright = get_field( 'copyright', 'options' );

?>

<div class="bg-peach p-5 pt-[60px] js-footer-links footer-links [&.is-hovered]:bg-peachDark transition-all duration-700 ease-in-out">

	<!-- Menus -->
	<div class="grid grid-cols-12 gap-x-5 gap-y-[60px]">

		<?php if ( have_rows( 'menus', 'options' ) ) : ?>

			<?php while ( have_rows( 'menus', 'options' ) ) :
				the_row();

				$title = get_sub_field( 'title' );
				$type = get_sub_field( 'type' );
				$text = get_sub_field( 'text' );
				?>

				<div class="col-span-12 md:col-span-6 2xl:col-span-3 grid grid-cols-3 js-element-blurin">

					<div class="col-span-1">
						<?= $title; ?>
					</div>

					<div class="col-span-2">

						<?php if ( $type == 'menu' ) : ?>

							<?php if ( have_rows( 'menu', 'options' ) ) : ?>

								<div class="flex flex-col gap-y-1">

									<?php while ( have_rows( 'menu', 'options' ) ) :
										the_row();

										$link = get_sub_field( 'link' );
										?>

										<?= mi_get_link( $link, 'self-start' ); ?>

									<?php endwhile; ?>

								</div>

							<?php endif; ?>

						<?php else : ?>

							<div class="flex flex-col gap-y-[6px]">
								<?= $text; ?>
							</div>

						<?php endif; ?>

					</div>

				</div>

			<?php endwhile; ?>

		<?php endif; ?>

	</div>

	<!-- Title -->
	<div class="py-40 js-element-blurin">
		<div class="text-h1 flex justify-between flex-wrap">
			<div class="mr-2">
				Farah Gorayeb /
			</div>
			<div class="">
				Interior Design Studio
			</div>

		</div>
	</div>

	<!-- Copyright -->
	<div class="flex justify-between">

		<div class="">
			<?= $copyright; ?>
		</div>

		<div class="">
			By
			<a href="http://emelecollab.com/" class="footer-link">
				Emele Collab
			</a>
		</div>

	</div>

</div>