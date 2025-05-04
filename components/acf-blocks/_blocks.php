<?php

if ( get_row_layout() == 'hero_image_video' ) :
	get_template_part( 'components/acf-blocks/hero-image-video' );

elseif ( get_row_layout() == 'title_paragraph' ) :
	get_template_part( 'components/acf-blocks/title-paragraph' );

elseif ( get_row_layout() == 'title_paragraph_indented' ) :
	get_template_part( 'components/acf-blocks/title-paragraph-indented' );

elseif ( get_row_layout() == 'call_to_action' ) :
	get_template_part( 'components/acf-blocks/call-to-action' );

elseif ( get_row_layout() == 'image_full_screen' ) :
	get_template_part( 'components/acf-blocks/image-full-screen' );

elseif ( get_row_layout() == 'video_full_screen' ) :
	get_template_part( 'components/acf-blocks/video-full-screen' );

elseif ( get_row_layout() == 'image_image' ) :
	get_template_part( 'components/acf-blocks/image-image' );

elseif ( get_row_layout() == 'portfolio' ) :
	get_template_part( 'components/acf-blocks/portfolio' );

elseif ( get_row_layout() == 'showroom' ) :
	get_template_part( 'components/acf-blocks/showroom' );

elseif ( get_row_layout() == 'simple_content' ) :
	get_template_part( 'components/acf-blocks/simple-content' );

elseif ( get_row_layout() == 'portfolio_slider' ) :
	get_template_part( 'components/acf-blocks/portfolio-slider' );

elseif ( get_row_layout() == 'showroom_slider' ) :
	get_template_part( 'components/acf-blocks/showroom-slider' );

elseif ( get_row_layout() == 'product_description' ) :
	get_template_part( 'components/acf-blocks/product-description' );

elseif ( get_row_layout() == 'contact_info' ) :
	get_template_part( 'components/acf-blocks/contact-info' );

elseif ( get_row_layout() == 'contact_form' ) :
	get_template_part( 'components/acf-blocks/contact-form' );

endif;