<?php
$args = isset( $args ) ? $args : array();
$slider_type = $args['post_type'];
$items = get_sub_field( $slider_type );
$link = get_sub_field( 'link' );
?>

<!-- Slider -->
<div class="projects-slider">
	<?php if ( $items ) : ?>
		<div class="px-5 js-swip overflow-hidden pb-[30px] -mb-[30px]">
			<div class="swiper-wrapper flex items-end cursor-slider">
				<?php foreach ( $items as $post ) : ?>
					<div class="swiper-slide mr-5 [&:last-of-type]:mr-0 js-element-blurin <?= $slider_type == 'projects' ? '!w-[calc(66.66%-(20px/2))] md:!w-[calc(40%-(40px/3))] 2xl:!w-[calc(28.57%-(60px/4))]' : '!w-[calc(55%-(20px/2))] sm:!w-[calc(40%-(40px/3))] md:!w-[calc(28.57%-(60px/4))] lg:!w-[calc(22.22%-(80px/5))] 2xl:!w-[calc(18.18%-(100px/6))]'; ?>">
						<?php
						// Setup this post for WP functions (variable must be named $post).
						setup_postdata( $post );
						?>

						<div class="flex flex-col gap-y-[10px] body-links">
							<div class="overflow-hidden <?= $slider_type == 'projects' ? '' : ''; ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?= get_the_post_thumbnail( get_the_ID(), 'xl', [ 'class' => 'w-full h-full object-cover' ] ); ?>
								<?php endif; ?>
							</div>

							<a href="<?= get_the_permalink(); ?>" class="projects-slider-item self-start">
								<?= get_the_title(); ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php if ( $link ) : ?>
			<div class="px-5 pt-[60px] pb-[90px] js-element-blurin">
				<?= mi_get_link( $link, 'text-h2 body-link-h1-inverted' ); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>