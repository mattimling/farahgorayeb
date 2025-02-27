<?php

$copyright = get_field( 'copyright', 'options' );
$footer_title_1 = get_field( 'footer_title_1', 'options' );
$footer_title_2 = get_field( 'footer_title_2', 'options' );
$gallery = get_field( 'gallery', 'options' );

?>

<div class="bg-peach mt-[90px] js-footer-links footer-links [&.is-hovered]:bg-peachDark transition-all duration-700 ease-in-out">

	<!-- Menus -->
	<div class="px-5 pt-5 grid grid-cols-12 gap-x-5 gap-y-[60px]">

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
	<div class="px-5 my-28 js-element-blurin relative overflow-hidden">

		<div class="py-12 text-h1 flex justify-between flex-wrap relative z-[1] js-footer-title">

			<div class="mr-2">
				<?= $footer_title_1; ?>
			</div>
			<div class="">
				<?= $footer_title_2; ?>
			</div>

		</div>

		<div class="absolute top-0 left-0 w-full h-full flex justify-center z-0 pointer-events-none">

			<?php if ( $gallery ) : ?>

				<div class="aspect-[124/156] js-footer-title-image relative transition-all duration-[50ms] ease-in-out">

					<?php foreach ( $gallery as $image ) : ?>

						<div class="absolute top-0 left-0 aspect-[124/156]">
							<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover' ); ?>
						</div>

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

		</div>
	</div>

	<!-- Copyright -->
	<div class="flex px-5 pb-5 grid grid-cols-12 gap-x-5">

		<div class="col-span-3">
			<?= $copyright; ?>
		</div>

		<div class="col-span-3">
			By
			<a href="http://emelecollab.com/">
				Emele Collab
			</a>
		</div>

		<div class="col-span-6 text-right">
			<a href="#" onclick="event.preventDefault(); lenis.scrollTo(0, { duration: 1, easing: (t) => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2 });">
				Back to top
			</a>

			↑
		</div>

	</div>

</div>