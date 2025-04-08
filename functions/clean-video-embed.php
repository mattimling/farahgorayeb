<?php

function clean_video_embed( $embed_code ) {
	// Extract the Vimeo video ID
	if ( preg_match( '/vimeo\.com\/video\/(\d+)/', $embed_code, $matches ) ) {
		$video_id = $matches[1];
		$embed_url = "https://player.vimeo.com/video/$video_id?autoplay=1&background=1&loop=1&muted=1";
	}
	// Extract the YouTube video ID from an embed URL
	elseif ( preg_match( '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $embed_code, $matches ) ) {
		$video_id = $matches[1];
		$embed_url = "https://www.youtube.com/embed/$video_id?autoplay=1&controls=0&modestbranding=1&loop=1&mute=1&playlist=$video_id";
	} else {
		return 'Invalid Video Embed Code';
	}

	// Return the cleaned iframe
	return '
        <div style="padding:56.25% 0 0 0;position:relative;" class="w-full h-full object-cover">
            <iframe class="w-full h-full" src="' . esc_url( $embed_url ) . '" 
                frameborder="0" 
                allow="autoplay; fullscreen" 
                style="position:absolute;top:0;left:0;width:100%;height:100%;">
            </iframe>
        </div>';
}