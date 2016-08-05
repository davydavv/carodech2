<?php
	global $be_themes_data, $blog_attr;
	$gallery_images = get_post_meta(get_the_ID(),'be_themes_gal_post_format');
	$blog_image_size = 'blog-image';
	if(!empty($gallery_images)) {
		echo '<div class="post-thumb">';
			$output = '[flex_slider]';
			foreach ($gallery_images as $image) {
				$output .='[flex_slide image="'.$image.'" size="'.$blog_image_size.'"]';
			}
			$output .='[/flex_slider]';
			echo do_shortcode($output);
		echo '</div>';
	}
?>