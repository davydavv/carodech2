<?php
/*
 * Ajax Request handler
 */

/* ---------------------------------------------  */
// Function for processing contact form submission
/* ---------------------------------------------  */

if ( ! function_exists( 'be_themes_contact_authentication' ) ) :
	function be_themes_contact_authentication() {
		global $be_themes_data;
		$contact_name = $_POST['contact_name'];
		$contact_email = $_POST['contact_email'];
		$contact_comment = "Name: ".$contact_name."\n\nMessage:\n".$_POST['contact_comment'];
		$contact_subject = $_POST['contact_subject'];
		if(empty($contact_name) || empty($contact_email) || empty($contact_comment) || empty($contact_subject) ) {
			$result['status']="error";
			$result['data']= __('All fields are required','be-themes');
		}
		else if(!preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $contact_email)) {
			$result['status']="error";
			$result['data']=__('Please enter a valid email address','be-themes');
		}
		else if(!empty($contact_name) && !empty($contact_email) && !empty($contact_comment) && !empty($contact_subject) ) {
			if ( !empty( $be_themes_data['mail_id'] ) ) {
				$to = $be_themes_data['mail_id'];
			} else {
				$to = get_option('admin_email');
			}		
			$subject= $contact_subject;
			$from = $contact_name."<".$contact_email.">";
			$headers = "From:" . $from;
			mail($to,$subject,$contact_comment,$headers);
			$result['status']="success";
			$result['data']=__('Your message was sent successfully','be-themes');
		}
		header('Content-type: application/json');
		echo json_encode($result);
		die();
	}
	add_action( 'wp_ajax_nopriv_contact_authentication', 'be_themes_contact_authentication' );
	add_action( 'wp_ajax_contact_authentication', 'be_themes_contact_authentication' );
endif; 

/* ---------------------------------------------------*/
// Function for Portfolio Load More / Infinite scroll
/* ---------------------------------------------------*/

if ( ! function_exists( 'be_themes_get_ajax_full_screen_gutter_portfolio' ) ) :
	function be_themes_get_ajax_full_screen_gutter_portfolio() {
		extract($_POST);
		$output='';
		$global_thumb_overlay_color = $thumb_overlay_color;
		$global_gradient_style_color = $gradient_style_color;
		$global_like_button  = $like_button;
		if(isset($title_color) && !empty($title_color)) {
			$global_title_color = $title_color = $title_color;
		} else {
			$global_title_color = $title_color = '';
		}
		if(isset($cat_color) && !empty($cat_color)) {
			$global_cat_color = $cat_color = $cat_color;
		} else {
			$global_cat_color = $cat_color = '';
		}
		// $filter_to_use = 'portfolio_'.$filter;
		if($filter == 'categories'){
			$filter_to_use = 'portfolio_'.$filter;
		} else{
			$filter_to_use = $filter;
		}
		$offset = ( ( $showposts * $paged ) - $showposts );
		if( $paged == 0 ) {
			$offset = 0; 
		} else {
			$offset = ( ( $showposts * $paged ) - $showposts ); 
		}
		$selected_categorey = explode(',', $category);
		if($category) {
			$args = array (
				'post_type' => 'portfolio',
				'posts_per_page' => intval($showposts),
				'offset' => intval($offset),
				'tax_query' => array (
					array (
						'taxonomy' => 'portfolio_categories',
						'field' => 'slug',
						'terms' => $selected_categorey,
						'operator' => 'IN'
					)
				),
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish'
			);
		}
		else {
			$args = array (
				'post_type' => 'portfolio',
				'posts_per_page' => intval($showposts),
				'offset' => intval($offset),
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish'
			);
		}
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$filter_classes = $permalink = '';
				$mfp_class = 'mfp-image';
				$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
				if( $show_filters == 'yes' && is_array( $post_terms ) ) {
					foreach ( $post_terms as  $term ) {
						$filter_classes .=$term->slug." ";
					}
				} else{
					$filter_classes='';
				}
				$attachment_id = get_post_thumbnail_id(get_the_ID());
				$image_atts = get_portfolio_image(get_the_ID(), $col, $masonry);
				$attachment_thumb = wp_get_attachment_image_src( $attachment_id, $image_atts['size']);
				$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
				$attachment_thumb_url = $attachment_thumb[0];
				$attachment_full_url = $attachment_full[0];
				$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
				$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
				$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
				$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
				$single_overlay_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_color', true );
				$single_overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_single_overlay_color_opacity', true );
				$single_title_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_title_color', true );
				$single_cat_color = get_post_meta( get_the_ID(), 'be_themes_single_overlay_cat_color', true );
				$attachment_info = be_wp_get_attachment($attachment_id);
				if(!isset($visit_site_url) || empty($visit_site_url)) {
					$visit_site_url = '#';
				}
				$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink();
				$target = ("1" == get_post_meta( get_the_ID(), 'be_themes_portfolio_open_new_tab', true )) ? 'target="_blank"' : '';
				if(isset($single_overlay_opacity) && !empty($single_overlay_opacity)) {
					$overlay_opacity = $single_overlay_opacity;
				} else {
					$overlay_opacity = 85;
				}
				if(isset($single_overlay_color) && !empty($single_overlay_color)) {
					$single_overlay_color = be_themes_hexa_to_rgb( $single_overlay_color );
					$thumb_overlay_color = 'rgba('.$single_overlay_color[0].','.$single_overlay_color[1].','.$single_overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
					$gradient_style_color = '';
				} else {
					$thumb_overlay_color = $global_thumb_overlay_color;
					$gradient_style_color = $global_gradient_style_color;
				}
				if(isset($single_title_color) && !empty($single_title_color)) {
					$title_color = $single_title_color;
				} else {
					$title_color = $global_title_color;
				}
				if(isset($single_cat_color) && !empty($single_cat_color)) {
					$cat_color = $single_cat_color;
				} else {
					$cat_color = $global_cat_color;
				}

				if(!empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe';
				}
				if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'lightbox-gallery') {
					$thumb_class = 'be-lightbox-gallery';
				} else if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'lightbox') {
					$thumb_class = 'image-popup-vertical-fit';
				} else if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'none') {
					$thumb_class = 'no-link';
					$attachment_full_url = '#';
				} else {
					$thumb_class = ( $link_to == 'external_url' || !empty( $target )  ) ? '' : 'dJAX_internal';
					$mfp_class = '';
					$attachment_full_url = $permalink;
				}
				if($hover_style == 'style9-hover') {
					$trigger_animation  = '';
				} else {
					$trigger_animation  = 'animation-trigger';
				}
				$link_to_thumbnail = $attachment_full_url;
				$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
				$element_classes = '';
				foreach ($terms as $term) {
					$element_classes .= $term->slug.' ';
				}
				$output .= '<div class="element be-hoverlay '.$filter_classes.' '.$element_classes.$image_atts['class'].' '.$image_atts['alt_class'].' '.$hover_style.' '.$img_grayscale.' '.$title_style.'-title" id="'.be_get_the_slug(get_the_ID()).'" style="margin-bottom: '.$gutter_width.'px !important;">';
				$output .= '<div class="element-inner" style="margin-left: '.$gutter_width.'px;">';
				$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'" title="'.$attachment_info['title'].'" '.$target.'>';
				$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$attachment_thumb_url.'" alt /></div></div>';
				$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
				$output .= '<div class="thumb-title-wrap ">';
				$output .= '<div class="thumb-title be-animate animated '.$trigger_animation.'" data-animation-type="'.$title_animation_type.'" style="color: '.$title_color.';">'.get_the_title().'</div>';
				
				if(!empty($terms) && (isset($cat_hide) && !($cat_hide) ) ) {
					$output .= '<div class="portfolio-item-cats be-animate animated '.$trigger_animation.'" data-animation-type="'.$cat_animation_type.'" style="color: '.$cat_color.';">';
					$length = 1;
					foreach ($terms as $term) {
						$output .= '<span>'.$term->name.'</span>';
						if(count($terms) != $length) {
							$output .= '<span>, </span>';
						}
						$length++;
					}
					$output .= '</div>';
				}
				$output .= '</div>';
				$output .= '</div></div>'; //End Thumb Bg & Thumb Overlay
				$output .= '</a>'; //End Thumb Wrap
				if(isset($open_with) && $open_with == 'lightbox-gallery') :
					$output .='<div class="popup-gallery">';
					$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images');
					if(!empty($attachments)) {
						foreach ( $attachments as $attachment_id ) {
							$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
							$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
							$attachment_info = be_wp_get_attachment($attachment_id);
							if($video_url) {
								$url = $video_url;
								$mfp_class = 'mfp-iframe';
							} else {
								$url = $attach_img[0];
								$mfp_class ='mfp-image';
							}
							$output .='<a href="'.$url.'" class="'.$mfp_class.'" title="'.$attachment_info['title'].'"></a>';
						}
					}
					$output .= '</div>'; //End Gallery
				endif;
				$output .= ($global_like_button != 1) ? be_get_like_button(get_the_ID()) : '';
				$output .= '</div>'; //End Element Inner
				$output .= '</div>'; //End Element
			endwhile;
			wp_reset_postdata();
			echo $output;
		else :
			return 0;
		endif;
		die();
	}
	add_action( 'wp_ajax_nopriv_get_ajax_full_screen_gutter_portfolio', 'be_themes_get_ajax_full_screen_gutter_portfolio' );
	add_action( 'wp_ajax_get_ajax_full_screen_gutter_portfolio', 'be_themes_get_ajax_full_screen_gutter_portfolio' );
endif;

/* ---------------------------------------------  */
// Function for processing Like Button
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_post_like' ) ) :
	function be_themes_post_like() {
		extract($_POST);
		$post_like_count = get_post_meta( $post_id, "_post_like_count", true );
		if (be_AlreadyLiked_post($post_id)) {
			$result['status'] = "error";
			$result['data'] = "You Already Liked This Item";
			$result['count'] = $post_like_count;
		} else {
			setcookie( $post_id."_liked", $post_id, time() + 31536000, "/");
			update_post_meta( $post_id, "_post_like_count", ++$post_like_count );
			$result['status'] = "success";
			$result['data'] = "You Liked Successfully";
			$result['count'] = $post_like_count;
		}
		header('Content-type: application/json');
		echo json_encode($result);
		die();
	}
	add_action( 'wp_ajax_nopriv_post_like', 'be_themes_post_like' );
	add_action( 'wp_ajax_post_like', 'be_themes_post_like' );
endif;

/* ---------------------------------------------  */
// Function for processing Gallery module Pagination
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_get_be_gallery_with_pagination' ) ) :
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

		echo get_be_gallery_shortcode($images, $col, $masonry, $hover_style, $img_grayscale, $gutter_width, $lightbox_type, $image_source, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $hover_content_option, $hover_content_color);
	}
	add_action( 'wp_ajax_nopriv_get_be_gallery_with_pagination', 'be_themes_get_be_gallery_with_pagination' );
	add_action( 'wp_ajax_get_be_gallery_with_pagination', 'be_themes_get_be_gallery_with_pagination' );
endif;

if ( ! function_exists( 'get_be_gallery_shortcode' ) ) :
	function get_be_gallery_shortcode($images, $col, $masonry, $hover_style, $img_grayscale, $gutter_width, $lightbox_type, $image_source, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $hover_content_option, $hover_content_color){
		
		$output = '';
		$output_hover_content = '<div class="thumb-title" style="color:'.$hover_content_color.';"><i class="portfolio-overlay-icon"></i></div>';
		if(!empty($images)){
			foreach($images as $image) {
				$image_atts = get_portfolio_image($image['id'], $col, $masonry);
				$attachment_info = be_wp_get_attachment( $image['id'] );

				if($hover_content_option == 'title'){
					$output_hover_content = '<div class="thumb-title" style="color:'.$hover_content_color.';">'.$image['caption'].'</div>';
				}

				$output .= '<div class="element be-hoverlay '.$image_atts['class'].' '.$image_atts['alt_class'].' '.$hover_style.' '.$img_grayscale.'" style="margin-bottom: '.$gutter_width.'px !important;">';
				$output .= '<div class="element-inner" style="margin-left: '.$gutter_width.'px;">';
				
				// Changes for PhotoSwipe Gallery
				if('photoswipe' == $lightbox_type && 'pintrest' != $image_source){
					$output .= '<a href="'.$image['full_image_url'].'" data-size="'.$image['width'].'x'.$image['height'].'" data-href="'.$image['full_image_url'].'" class="thumb-wrap" title="'.$image['description'].'">';
				}else{
					$output .= '<a href="'.$image['full_image_url'].'" data-href="'.$image['full_image_url'].'" class="thumb-wrap image-popup-vertical-fit '.$image['mfp_class'].'" title="'.$image['caption'].'">';
				}
				//End
				$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$image['thumbnail'].'" alt="'.$attachment_info['alt'].'" /></div></div>';
				$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
				$output .= '<div class="thumb-title-wrap display-table-cell vertical-align-middle align-center fadeIn animated">';
				$output .= $output_hover_content;
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
endif;

/* ---------------------------------------------  */
// Function for processing Justified Gallery module Pagination
/* ---------------------------------------------  */

if ( ! function_exists( 'be_themes_get_be_justified_gallery_with_pagination' ) ) :
	function be_themes_get_be_justified_gallery_with_pagination(){

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
		$images = get_gallery_image_from_source(json_decode(stripslashes($source),true), implode(",",$images_subset), 'photoswipe');

		echo get_be_justified_gallery_shortcode($images, $hover_style, $img_grayscale, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $disable_overlay);
	}
	add_action( 'wp_ajax_nopriv_get_be_justified_gallery_with_pagination', 'be_themes_get_be_justified_gallery_with_pagination' );
	add_action( 'wp_ajax_get_be_justified_gallery_with_pagination', 'be_themes_get_be_justified_gallery_with_pagination' );
endif;

if ( ! function_exists( 'get_be_justified_gallery_shortcode' ) ) :
	function get_be_justified_gallery_shortcode($images, $hover_style, $img_grayscale, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $disable_overlay){
		
		$output = '';
		
		if(!empty($images)){
			foreach($images as $image) {
				$image_atts = get_portfolio_image($image['id'], 'three', '1');
				$attachment_info = be_wp_get_attachment( $image['id'] );
				$output .= '<div class="element be-hoverlay '.$image_atts['class'].' '.$hover_style.' '.$img_grayscale.'">';
				$output .= '<div class="element-inner">';
				$output .= '<a href="'.$image['full_image_url'].'" data-size="'.$image['width'].'x'.$image['height'].'" data-href="'.$image['full_image_url'].'" class="thumb-wrap" title="'.$image['description'].'">';
				$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$image['thumbnail'].'" alt="'.$attachment_info['alt'].'" /></div></div>';
				if($disable_overlay == 0){
					$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
					$output .= '<div class="thumb-title-wrap display-table-cell vertical-align-middle align-center fadeIn animated">';
					$output .= '</div>';
					$output .= '</div></div>'; //End Thumb Bg & Thumb Overlay
				}
				$output .= '</a>'; //End Thumb Wrap
				$output .= ($like_button != 1 && !empty($image['id'])) ? be_get_like_button($image['id']) : '';
				$output .= '</div>'; //End Element Inner
				$output .= '</div>'; //End Element
			}
		}
		return $output;
	}
endif;

if ( ! function_exists( 'be_themes_mailchimp_subscription' ) ) :
	function be_themes_mailchimp_subscription() {
		global $be_themes_data;
		$MailChimp = new MailChimp($_POST['api_key']);
		$result = $MailChimp->call('lists/subscribe', array (
	        'id'                => $_POST['list_id'],
	        'email'             => array('email'=> $_POST['email']),
	        'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
	        'double_optin'      => false,
	        'update_existing'   => true,
	        'replace_interests' => false,
	        'send_welcome'      => false,
	    ));
	    if(!isset($result['status'])) {
	    	$result['status'] = 'success';
	    	$result['data'] = __('Thank you, you have been added to our mailing list.','be-themes');
	    } else {
	    	$result['data'] =  $result['error'];
	    }
		header('Content-type: application/json');
		echo json_encode($result);
		die();
	}
	add_action( 'wp_ajax_nopriv_mailchimp_subscription', 'be_themes_mailchimp_subscription' );
	add_action( 'wp_ajax_mailchimp_subscription', 'be_themes_mailchimp_subscription' );
endif;

/* ---------------------------------------------  */
// Mail Chimp API Class
/* ---------------------------------------------  */

if( ! class_exists( 'MailChimp' ) ) :
	class MailChimp {
    	private $api_key;
    	private $api_endpoint = 'https://<dc>.api.mailchimp.com/2.0';
    	private $verify_ssl   = false;

    	/**
    	* Create a new instance
     	* @param string $api_key Your MailChimp API key
     	*/
    	function __construct($api_key) {
        	$this->api_key = $api_key;
        	list(, $datacentre) = explode('-', $this->api_key);
        	$this->api_endpoint = str_replace('<dc>', $datacentre, $this->api_endpoint);
    	}

	    /**
	     * Call an API method. Every request needs the API key, so that is added automatically -- you don't need to pass it in.
	     * @param  string $method The API method to call, e.g. 'lists/list'
	     * @param  array  $args   An array of arguments to pass to the method. Will be json-encoded for you.
	     * @return array          Associative array of json decoded API response.
	     */
	    public function call($method, $args=array(), $timeout = 10) {
	        return $this->makeRequest($method, $args, $timeout);
	    }

	    /**
	     * Performs the underlying HTTP request. Not very exciting
	     * @param  string $method The API method to be called
	     * @param  array  $args   Assoc array of parameters to be passed
	     * @return array          Assoc array of decoded result
	     */
    	private function makeRequest($method, $args=array(), $timeout = 10) {      
        	$args['apikey'] = $this->api_key;
        	$url = $this->api_endpoint.'/'.$method.'.json';
	        if (function_exists('curl_init') && function_exists('curl_setopt')){
	            $ch = curl_init();
	            curl_setopt($ch, CURLOPT_URL, $url);
	            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');       
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
	            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));
	            $result = curl_exec($ch);
	            curl_close($ch);
	        } else {
	            $json_data = json_encode($args);
	            $result    = file_get_contents($url, null, stream_context_create(array(
	                'http' => array(
	                    'protocol_version' => 1.1,
	                    'user_agent'       => 'PHP-MCAPI/2.0',
	                    'method'           => 'POST',
	                    'header'           => "Content-type: application/json\r\n".
	                                          "Connection: close\r\n" .
	                                          "Content-length: " . strlen($json_data) . "\r\n",
	                    'content'          => $json_data,
	                ),
	            )));
	        }
        	return $result ? json_decode($result, true) : false;
    	}
	}
endif;
?>