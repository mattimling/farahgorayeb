<?php
$video_link = get_sub_field( 'video_link' );
$description = get_sub_field( 'description' );
?>

<?php if ( $video_link ) : ?>
	<div class="px-5 w-full flex flex-col">
		<div class="overflow-hidden js-element-blurin">
			<!-- <a href="<?= $video_link; ?>" class="glightbox js-barba-prevent" data-gallery="gallery" aria-label="Image gallery">
				<video preload="auto" muted playsinline autoplay loop controls class="w-full h-full object-cover">
					<source src="<?= $video_link; ?>" type="video/mp4">
				</video>
			</a> -->

			<video preload="auto" muted playsinline autoplay loop controls class="w-full h-full object-cover">
				<source src="<?= $video_link; ?>" type="video/mp4">
			</video>
		</div>

		<?php if ( $description ) : ?>
			<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin pt-[10px]">
				<?= $description; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>