<?php

function is_page_descendant( $post_id, $parent_url ) {
	$parent_page_id = url_to_postid( $parent_url ); // Convert the URL to the post ID of the parent
	$ancestors = get_post_ancestors( $post_id ); // Get the ancestors of the current page
	return in_array( $parent_page_id, $ancestors ); // Check if the parent page is in the ancestor list
}
