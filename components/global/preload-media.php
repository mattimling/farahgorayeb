<?php

$visible = 0;

?>

<template class="js-preload-media">

	<div class="fixed <?= $visible ? 'z-[100] opacity-50' : '-z-[999] opacity-0 invisible'; ?> bottom-0 left-0 bg-[red] text-colorWhite p-1 flex flex-col gap-1 flex-wrap w-full h-full pointer-events-none">

		<!-- Preload images -->
		<?php

		// Define the post types you want to include
		$post_types = array( 'posts', 'page', 'portfolio', 'showroom' );

		// Create an array to hold all post IDs
		$all_post_ids = array();

		// Loop through each post type and collect IDs
		foreach ( $post_types as $post_type ) {
			$query_args = array(
				'post_type' => $post_type,
				'posts_per_page' => -1,
				'fields' => 'ids', // We only need the IDs
			);

			$query = new WP_Query( $query_args );

			// Merge the post IDs
			$all_post_ids = array_merge( $all_post_ids, $query->posts );
		}

		if ( ! empty( $all_post_ids ) ) {

			// Get all images attached to the selected posts
			$query_images_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'post_status' => 'inherit',
				'posts_per_page' => -1,
				'post_parent__in' => $all_post_ids, // Only get attachments for the selected post IDs
			);

			$query_images = new WP_Query( $query_images_args );

			foreach ( $query_images->posts as $image ) {
				// Preload only the 'md' image size, as that's the size being used
				echo mi_get_image( $image->ID, 'xl', 'w-[100px]' );
			}

		}

		?>

		<!-- Preload fonts -->
		<!-- <div class="opacity-0 invisible">
			<span class="font-tthm">empty</span>
			<span class="font-bv">empty</span>
		</div> -->

	</div>

</template>