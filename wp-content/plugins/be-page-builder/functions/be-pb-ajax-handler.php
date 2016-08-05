<?php
/*
 * Ajax Request handler
 */

/* ---------------------------------------------  */
// Function for processing Gallery module Pagination
/* ---------------------------------------------  */

add_action( 'wp_ajax_nopriv_get_be_gallery_with_pagination', 'be_themes_get_be_gallery_with_pagination' );
add_action( 'wp_ajax_get_be_gallery_with_pagination', 'be_themes_get_be_gallery_with_pagination' );
function be_themes_get_be_gallery_with_pagination(){

	extract($_POST);
	
	if($paged != 0){
		$images_offset = $paged * $items_per_load;
	}else{
		$images_offset = $paged;
	}

	$images_arr = explode(',', $images_arr);
	if($images_offset >= count($images_arr) ) {
		return 0;
		die();
	}
	
	$images_subset = array_slice($images_arr, $images_offset, $items_per_load);
	$images = get_gallery_image_from_source(json_decode(stripslashes($source),true), implode(",",$images_subset), $lightbox_type);

	echo get_be_gallery_shortcode($images, $col, $masonry, $hover_style, $img_grayscale, $gutter_width, $lightbox_type, $image_source, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button);
}

function get_be_gallery_shortcode($images, $col, $masonry, $hover_style, $img_grayscale, $gutter_width, $lightbox_type, $image_source, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button){
	
	$output = '';
	
	if(!empty($images)){
		foreach($images as $image) {
				$image_atts = get_portfolio_image($image['id'], $col, $masonry);
				$output .= '<div class="element be-hoverlay '.$image_atts['class'].' '.$image_atts['alt_class'].' '.$hover_style.' '.$img_grayscale.'" style="margin-bottom: '.$gutter_width.'px !important;">';
				$output .= '<div class="element-inner" style="margin-left: '.$gutter_width.'px;">';
				
				// Changes for PhotoSwipe Gallery
				if('photoswipe' == $lightbox_type && 'pintrest' != $image_source){
					$output .= '<a href="'.$image['full_image_url'].'" data-size="'.$image['width'].'x'.$image['height'].'" data-href="'.$image['full_image_url'].'" class="thumb-wrap" title="'.$image['description'].'">';
				}else{
					$output .= '<a href="'.$image['full_image_url'].'" data-href="'.$image['full_image_url'].'" class="thumb-wrap image-popup-vertical-fit '.$image['mfp_class'].'" title="'.$image['caption'].'">';
				}
				//End
				
				$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$image['thumbnail'].'" alt /></div></div>';
				$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
				$output .= '<div class="thumb-title-wrap display-table-cell vertical-align-middle align-center fadeIn animated">';
				$output .= '<div class="thumb-title"><i class="portfolio-overlay-icon"></i></div>';
				$output .= '</div>';
				$output .= '</div></div>'; //End Thumb Bg & Thumb Overlay
				$output .= '</a>'; //End Thumb Wrap
				$output .= ($like_button != 1 && !empty($image['id'])) ? be_get_like_button($image['id']) : '';
				$output .= '</div>'; //End Element Inner
				$output .= '</div>'; //End Element
			}	
		}
		return $output;
	}
?>
