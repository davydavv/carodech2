<?php

do_action('be_shortcode_override');
/******************************************
			SHORTCODES 
******************************************/

if ( ! function_exists( 'be_search_query_join' ) ) :
	function be_search_query_join( $join )
	{
		global $wpdb, $wp_query; 
		$table_prefix = $wpdb->prefix;
		if($wp_query->is_main_query() && is_search() && (!is_admin() ) )  {
			$join .= " LEFT JOIN ".$table_prefix."postmeta as be_meta_table ON ID = be_meta_table.post_id AND be_meta_table.meta_key = '_be_pb_content' ";
		}
		return $join;
	}
	add_filter('posts_join', 'be_search_query_join' );
endif;

if ( ! function_exists( 'be_search_query_where' ) ) :
	function be_search_query_where( $where )
	{
		global $wp_query; 
		$args = array('public' => true, '_builtin' => false);
		$post_types = get_post_types($args);
		$post_types = "'" . implode("', '", $post_types) . "'";

		if($wp_query->is_main_query() && is_search() && (!is_admin() ) ) {
		    $where = " AND ((post_title LIKE '%" .$_GET['s']. "%') 
						OR (post_content LIKE '%" .$_GET['s']. "%')
						OR (be_meta_table.meta_value LIKE '%" .$_GET['s']. "%')) 
						AND post_type IN ('post', 'page', 'attachment',".$post_types.")
						AND (post_status = 'publish' OR post_status = 'private')";
	    }
	    return $where;
	}
	add_filter('posts_where', 'be_search_query_where' );  
endif;

if ( ! function_exists( 'be_search_distinct' ) ) :
function be_search_distinct() { 
 	if( is_search() && (!is_admin() ) ) {
 		return "DISTINCT"; 
 	}else{
 		return '';
 	}
}
endif;
add_filter('posts_distinct', 'be_search_distinct');

/**************************************LAYOUT MODULES**************************************/

/**************************************
			SECTION
**************************************/
if (!function_exists('be_section')) {
	function be_section( $atts, $content ) {
		extract( shortcode_atts( array(
	        'bg_color' => '',
	        'bg_image' => '',
	        'bg_repeat' => 'repeat',
	        'bg_attachment' => 'scroll',
	        'bg_position' => 'left top',
	        'bg_stretch' => 0,
	        'bg_animation' => 'none',
	        'border_size' => '1',
	        'border_color' => '',
	        'padding_top' => '',
	        'padding_bottom' => '',
	        'padding_edge' => '',
	        'offset_section' => '',
	        'bg_video' => 0,
	        'bg_video_mp4_src' => '',
	        'bg_video_ogg_src' => '',
	        'bg_video_webm_src' => '',
	        'bg_youtube_vimeo_url' => '',
			'bg_overlay' => 0,
			'overlay_color' => '',
			'overlay_opacity' => '',
			'section_id' => '',
			'section_class' => '',
			'section_title' => '',
			'full_screen' => 0,
			'full_screen_header_scheme' => 'background--dark',
			'hide_mobile' => 0,
	    ),$atts));

	    $background = '';
	    $offset_section_class = '';
	    $offset_value = '';
	    $offset_wrapper_start = '';
	    $offset_wrapper_end = '';
	    $border = '';
	    $output = '';
	    $hide_mobile = (isset($hide_mobile) && $hide_mobile == 1) ? 'hide-mobile' : '';
	    if( !isset($bg_animation) || empty($bg_animation) || $bg_animation == 'none' ) {
	    	$bg_animation = '';
	    }

	    if((isset( $bg_stretch ) && 1 == $bg_stretch) || (isset( $bg_animation ) && $bg_animation == 'be-bg-parallax')) {
			$bg_stretch = 'be-bg-cover';
		} else {
			$bg_stretch = '';
		}
	    if(empty( $bg_image  ) ){
	    	if( ! empty( $bg_color ) )
	    		$background = 'background-color: '.$bg_color.';';	
	    } else{
			$attachment_info=wp_get_attachment_image_src($bg_image,'full');
			$attachment_url = $attachment_info[0];
			if( ! empty( $attachment_url ) ) {
				if( (isset( $bg_animation ) && $bg_animation == 'be-bg-parallax') || (isset( $bg_animation ) && $bg_animation == 'be-bg-mousemove-parallax') ) {
					$bg_position = 'center center';
				}
				if(isset( $bg_animation ) && $bg_animation == 'be-bg-parallax') {
					$bg_repeat = 'no-repeat';
				}
	    		$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
	    	}
	    }
	    $data_padding_top = $padding_top;
	    $border = ( ! empty( $border_color ) ) ? 'border-bottom:'.$border_size.'px solid '.$border_color.';' : $border;
	    $padding_top  = ( isset( $padding_top ) && $padding_top != '' ) ? 'padding-top:'.$padding_top.'px;' : $padding_top;
	    $padding_bottom = ( isset( $padding_bottom ) && $padding_bottom != '' ) ? 'padding-bottom:'.$padding_bottom.'px;' : $padding_bottom;
	    if( isset( $padding_edge ) && $padding_edge != '' && $padding_edge != 0){
	    	$padding_edge = 'padding-left:'.$padding_edge.'%; padding-right:'.$padding_edge.'%;';
	    	$padding_edge_class = 'be-edge-padding';
	    }else{
	    	$padding_edge = '';
	    	$padding_edge_class = '';
	    }

	    if( isset($offset_section) && $offset_section == 1 ){
	    	$offset_section_class = 'be-section-offset';
	    	$padding_top = 'padding-top:0px; ';
	    	$offset_value = "transform:translateY(-".$data_padding_top."px) ; -moz-transform: translateY(-".$data_padding_top."px); -ms-transform: translateY(-".$data_padding_top."px);  -o-transform:translateY(-".$data_padding_top."px); -webkit-transform:translateY(-".$data_padding_top."px);";
	    	$offset_wrapper_start = '<div class="be-section-offset-wrap" style="'.$offset_value.'" >';
	    	$offset_wrapper_end = '</div>';
	    }

	    // $padding_edge = ( isset( $padding_edge ) && $padding_edge != '' ) ? 'padding-left:'.$padding_edge.'%; padding-right:'.$padding_edge.'%;' : '';
	    $bg_overlay_class = ( isset( $bg_overlay ) && 1 == $bg_overlay ) ? 'be-bg-overlay' : '' ;
	    $bg_video_class =  ( isset( $bg_video ) && 1 == $bg_video ) ? 'be-video-section' : '' ;
 	    $section_skew = ( isset( $skew ) && 1 == $skew ) ? 'section-skew' : '' ;
		$section_id = !empty($section_id) ? 'id = "'.$section_id.'"' : '';
		$section_class = !empty($section_class) ? str_replace(',', ' ', $section_class) : '' ;
		$section_title = !empty($section_title) ? 'data-title = "'.$section_title.'"' : '';
		if( isset( $full_screen_header_scheme ) && $full_screen_header_scheme ) {
			$full_screen_header_scheme = 'data-headerscheme="'.$full_screen_header_scheme.'"';
		} else {
			$full_screen_header_scheme = 'data-headerscheme="background--dark"';
		}
		$full_screen = ( isset( $full_screen ) && 1 == $full_screen ) ? 'full-screen-section' : '' ;
	    $output .= '<div class="be-section '.$offset_section_class.' '.$section_class.' '.$bg_stretch.' '.$bg_animation.' '.$bg_overlay_class.' '.$bg_video_class.' '.$full_screen.' '.$hide_mobile.' clearfix" '.$full_screen_header_scheme.' style=" '.$background. $border.'" '.$section_id.' '.$section_title.'>';
	    if( 'full-screen-section' == $full_screen ) {
	    	$output .= '<div class="full-screen-section-wrap">';
	    }
	    $output .= '<div class="be-section-pad clearfix '.$padding_edge_class.'" style=" '.$padding_top.$padding_bottom.$padding_edge.'" data-padding-top = "'.$data_padding_top.'">';
	    $output .= $offset_wrapper_start;
		$output .=  ( isset( $skew ) && 1 == $skew ) ? '<div class="section-skew-normal">' : '' ;
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$output .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
			$output .=  ($bg_video_ogg_src) ? '<source src="'.$bg_video_ogg_src.'" type="video/ogg">' : '' ;
			$output .=  ($bg_video_webm_src) ? '<source src="'.$bg_video_webm_src.'" type="video/webm">' : '' ;
			$output .= '</video>';
		}
		/*if( isset( $bg_youtube_vimeo_url ) && !empty($bg_youtube_vimeo_url) ) {
			$videoType = be_themes_video_type( $bg_youtube_vimeo_url );
			if( $videoType == "youtube" ) {
				$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $bg_youtube_vimeo_url, $match ) ) ? $match[1] : $video_id ; 
				$output.='<iframe class="be-bg-video exlude-wrapper" width="940" height="450" src="http://www.youtube.com/embed/'.$video_id.'?controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;playlist='.$video_id.'" allowfullscreen></iframe>';
			} elseif( $videoType == "vimeo" ) {
				sscanf( parse_url( $bg_youtube_vimeo_url, PHP_URL_PATH ), '/%d', $video_id );
				$output.='<iframe class="be-bg-video exlude-wrapper" src="http://player.vimeo.com/video/'.$video_id.'?autoplay=1&amp;loop=1&amp;title=0&amp;byline=1&amp;title=0" width="500" height="281" allowFullScreen></iframe>';
			}
		}*/
		if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
			$opacity = '';
			if($overlay_opacity) {
				$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
				$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
				$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
				$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
				$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
			}
			$output .= '<div class="section-overlay" style="background: '.$overlay_color.'; '.$opacity.'"></div>';
		}
	    $output .= do_shortcode( $content );
		if( isset( $skew ) && 1 == $skew ) {
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= $offset_wrapper_end;
		if( 'full-screen-section' == $full_screen ) {
	    	$output .= '</div>';
	    }
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'section', 'be_section' );
}
/**************************************
			ROW
**************************************/
if (!function_exists('be_row')) {
	function be_row( $atts, $content ) {
		extract( shortcode_atts( array(
	        'no_wrapper'=>0,
	        'no_margin_bottom'=>0,
	        'no_space_columns'=>0,
	        'column_spacing'=>0,
	        'row_id' => '',
	        'row_class' => '',
	        'hide_mobile' => 0,
	    ),$atts ) );
	    $row_wrap_flag = 0;
	    $row_wrapper = '';

		if(isset( $column_spacing ) && isset( $no_space_columns ) && $column_spacing != '' && $column_spacing != 0 ){
			$row_wrapper = '<div class="be-row-wrap be-column-spacing clearfix" style="border-spacing:'.$column_spacing.'px 0;">';
			$row_wrap_flag = 1;
		}

		if($row_wrap_flag != 1){
			$class = 'be-wrap clearfix';
		}else{
			$class = 'be-wrap ';
		}

		$class = ( isset( $no_wrapper ) &&  1 == $no_wrapper ) ? '' : $class ;
	    $class .= ( isset( $no_margin_bottom ) &&  1 == $no_margin_bottom ) ? ' zero-bottom' : '' ;
	    $class .= ( isset( $no_space_columns ) &&  1 == $no_space_columns ) ? ' be-no-space' : '' ;
	    $class .= ( isset($hide_mobile) && $hide_mobile == 1) ? ' hide-mobile' : '';
		
		$row_id = !empty($row_id) ? 'id = "'.$row_id.'"' : '';
		$row_class = !empty($row_class) ? str_replace(',', ' ', $row_class) : '' ;
		
		$output = $row_wrapper;
		$output .= '<div '.$row_id.' class="be-row '.$class.' '.$row_class.'">'.do_shortcode( $content ).'</div>';

		if($row_wrap_flag == 1){
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( 'row','be_row' );
}
/**************************************
			COLUMNS
**************************************/
if (!function_exists('columns_extract')) {
	function columns_extract($atts) {
		extract( shortcode_atts( array (
			'bg_color' => '',
			'bg_image' => '',
			'bg_repeat' => 'repeat',
			'bg_attachment' => 'scroll',
			'bg_position' => 'left top',
			'bg_stretch' => 0,
			'center_pad' => 0,
			'bottom_margin' => 50,
			'top_pad' => '',
			'right_pad' =>'',
			'bottom_pad' => '',
			'left_pad' => '',
			'padding_value' => '',
			'bg_video' => 0,
	        'bg_video_mp4_src' => '',
	        'bg_video_mp4_src_ogg' => '',
	        'bg_video_mp4_src_webm' => '',
	        'bg_overlay' => 0,
			'overlay_color' => '',
			'overlay_opacity' => '',
			'animate_overlay' => 'none',
			'link_overlay' => '',
			'vertical_align' => 'none',
			'col_id' => '',
			'column_class' => '',
			'hide_mobile' => 0,
			'animate' => 0,
	        'animation_type' => 'fadeIn',
		),$atts ) );
		$column_atts = array();
		$column_atts['background'] = '';		
		if(empty( $bg_image  ) ) {
			$column_atts['background'] = ( ! empty( $bg_color ) ) ? 'background-color: '.$bg_color.';' : $column_atts['background'] ; 
			} else {
			$attachment_info=wp_get_attachment_image_src($bg_image,'full');
			$attachment_url = $attachment_info[0];
			if( ! empty( $attachment_url ) ) {
				$bg_position = ( isset( $bg_parallax ) && 1 == $bg_parallax ) ? 'center center' : $bg_position ; 
				$column_atts['background'] = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
			} 
		}
		$column_atts['bg_stretch'] = ( isset( $bg_stretch ) && 1 == $bg_stretch ) ? 'be-bg-cover' : '' ;
		$column_atts['center_pad'] = ( isset( $center_pad ) && 1 == $center_pad ) ? 'be-column-pad' : '' ;
		$column_atts['bottom_margin'] = ((isset($bottom_margin) && !empty($bottom_margin) && 50 != $bottom_margin) || $bottom_margin == '0') ? ('margin-bottom:' .$bottom_margin .'px ;') : '' ;
		$column_atts['padding_value'] = (isset($padding_value) && !empty($padding_value)) ? $padding_value : 'px' ;
		$column_atts['top_pad'] = ((isset($top_pad) && !empty($top_pad)) || $top_pad == '0') ? 'padding-top: '.$top_pad.$column_atts['padding_value'].';' : '' ;
		$column_atts['right_pad'] = ((isset($right_pad) && !empty($right_pad)) || $right_pad == '0') ? 'padding-right: '.$right_pad.$column_atts['padding_value'].';' : '' ;
		$column_atts['bottom_pad'] = ((isset($bottom_pad) && !empty($bottom_pad)) || $bottom_pad == '0') ? 'padding-bottom: '.$bottom_pad.$column_atts['padding_value'].';' : '' ;
		$column_atts['left_pad'] = ((isset($left_pad) && !empty($left_pad)) || $left_pad == '0') ? 'padding-left: '.$left_pad.$column_atts['padding_value'].';' : '' ;
		$column_atts['padding'] = $column_atts['top_pad'].$column_atts['right_pad'].$column_atts['bottom_pad'].$column_atts['left_pad'];
		$column_atts['video_class'] =  ( isset( $bg_video ) && 1 == $bg_video ) ? 'be-video-section' : '' ;
		$column_atts['overlay_class'] = ( isset( $bg_overlay ) && 1 == $bg_overlay ) ? 'be-bg-overlay' : '' ;
		$column_atts['video'] = $column_atts['overlay'] = '';
		$column_atts['vertical_align'] = ( isset( $vertical_align ) && !empty($vertical_align) && $vertical_align != 'none') ? 'vertical-align: '.$vertical_align.';' : '' ;
		$column_atts['overlay_class'] .= (isset($hide_mobile) && $hide_mobile == 1) ? ' hide-mobile' : '';
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$column_atts['video'] .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$column_atts['video'] .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
			$column_atts['video'] .=  ($bg_video_mp4_src_ogg) ? '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">' : '' ;
			$column_atts['video'] .=  ($bg_video_mp4_src_webm) ? '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">' : '' ;
			$column_atts['video'] .= '</video>';
		}
		$column_atts['col_id'] = !empty($col_id) ? 'id = "'.$col_id.'"' : '';
		$column_atts['column_class'] = !empty($column_class) ? str_replace(',', ' ', $column_class) : '' ;

		if ((empty( $bg_image  ) || !isset( $bg_image)) && (empty($bg_video) || !isset( $bg_video ) ) && (empty( $bg_color ) || !isset($bg_color) ) ){
			$column_atts['bg_indicator'] = 'no-background' ;
		}else{
			$column_atts['bg_indicator'] = 'with-background' ;
		}

		if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
			$opacity = '';

			if($overlay_opacity) {
				if(isset( $animate_overlay ) && 'hide' == $animate_overlay){
					$animate_overlay_class = 'animate-hide';
					$opacity = '';
					$opacity_attr = 'data-opacity="'.floatval($overlay_opacity/100).'"';
				}else if(isset( $animate_overlay ) && 'show' == $animate_overlay){
					$animate_overlay_class = 'animate-show';
					$opacity_attr = 'data-opacity="'.floatval($overlay_opacity/100).'"';
					$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
					$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
					$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
					$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
					$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
				}else{
					$animate_overlay_class = '';
					$opacity_attr = '';
					$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
					$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
					$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
					$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
					$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
				}
			}
			if(isset( $link_overlay ) && !empty( $link_overlay )){
				$overlay_link = '<a href="'.$link_overlay.'" class="be-col-overlay-link"></a>';
			}
			else{
				$overlay_link = "";
			}
			$column_atts['overlay'] .= '<div class="'.$animate_overlay_class.' section-overlay" style="background: '.$overlay_color.'; '.$opacity.'" '.$opacity_attr.'></div>';
			$column_atts['overlay'] .= $overlay_link;
		}
		$column_atts['animate'] = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '';
		$column_atts['animation_type'] = ( isset( $animation_type ) && !empty($animate) ) ? $animation_type : '';

		return $column_atts;
	}
}
if (!function_exists('be_one_col')) {
	function be_one_col( $atts, $content ) {
		$column_atts = columns_extract($atts, $content);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-col column-block clearfix ' .$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_col', 'be_one_col' );
}
/***********ONE THIRD**************/
if (!function_exists('be_one_third')) {
	function be_one_third( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-third column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_third', 'be_one_third' );
}
if (!function_exists('be_one_third_last')) {
	function be_one_third_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-third column-block last '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_third_last', 'be_one_third_last' );
}
/***********ONE FOURTH**************/
if (!function_exists('be_one_fourth')) {
	function be_one_fourth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="one-fourth column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_fourth', 'be_one_fourth' );
}
if (!function_exists('be_one_fourth_last')) {
	function be_one_fourth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-fourth column-block last '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_fourth_last', 'be_one_fourth_last' );
}
if (!function_exists('be_one_fifth')) {
	function be_one_fifth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="one-fifth column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_fifth', 'be_one_fifth' );
}
if (!function_exists('be_one_fifth_last')) {
	function be_one_fifth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="one-fifth column-block last '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_fifth_last', 'be_one_fifth_last' );
}
/***********ONE HALF**************/
if (!function_exists('be_one_half')) {
	function be_one_half( $atts, $content )  {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-half column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'one_half', 'be_one_half' );
}
if (!function_exists('be_one_half_last')) {
	function be_one_half_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div '.$column_atts['col_id'].' class="one-half column-block last'.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode('one_half_last','be_one_half_last');
}
/***********TWO THIRD**************/
if (!function_exists('be_two_third')) {
	function be_two_third( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="two-third column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'two_third', 'be_two_third' );
}
if (!function_exists('be_two_third_last')) {
	function be_two_third_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="two-third column-block last '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode('two_third_last','be_two_third_last');
}
/***********THREE FOURTH**************/	
if (!function_exists('be_three_fourth')) {
	function be_three_fourth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="three-fourth column-block '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'three_fourth', 'be_three_fourth' );
}
if (!function_exists('be_three_fourth_last')) {
	function be_three_fourth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div '.$column_atts['col_id'].' class="three-fourth column-block last '.$column_atts['column_class'].' '.$column_atts['bg_indicator'].' '.$column_atts['bg_stretch'].' '.$column_atts['animate'].' '.$column_atts['video_class'].' '.$column_atts['overlay_class'].'" data-animation="'.$column_atts['animation_type'].'" style="'.$column_atts['background'].' '.$column_atts['bottom_margin'] .' '.$column_atts['vertical_align'].'">';
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '<div class="be-custom-column-pad" style="'.$column_atts['padding'].'">' : '<div class="be-custom-column-inner">';
		$output .= do_shortcode( $content );
		$output .= ($column_atts['center_pad'] == 'be-column-pad') ? '</div>' : '</div>';
		$output .= $column_atts['video'].$column_atts['overlay'];
		$output .= '</div>';
		return $output;
	}
	add_shortcode('three_fourth_last','be_three_fourth_last');
}
/**************************************
			TEXT BLOCK
**************************************/
if (!function_exists('be_text')) {
	function be_text( $atts, $content ) {
		extract( shortcode_atts( array (
			'max_width' => 100,
			'wrap_alignment' => 'center',
	        'scroll_to_animate' => 0,
	        'animate' => 0,
	        'animation_type' => 'fadeIn',
	    ),$atts ) );

	    $output = '';
	    $bool = false;
		if( isset( $animate ) && 1 == $animate ) {
			$animate = 'be-animate';
			$bool = true;
		} else {
			$animate = '';
		}
		if( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) {
	    	$scroll_to_animate = 'scrollToFade';
	    	$bool = true;
	    } else {
			$scroll_to_animate = '';
		}
		
		if($max_width < 100){
			if($wrap_alignment == 'left'){
				$margin = 'margin: 0 0 30px';
			}
			if($wrap_alignment == 'center'){
				$margin = 'margin: 0 auto 30px';
			}
			if($wrap_alignment == 'right'){
				$margin = 'margin: 0 0 30px auto';
			}
		}
		else{
			$margin = 'margin: 0 auto 30px';
		}

		$output .= ( true === $bool ) ? '<div class="be-text-block '.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">' : '' ;
		$output .= (isset($max_width) && !empty($max_width)) ? '<div class="be-text-inner clearfix" style="width: '.$max_width.'%; '.$margin.';">' : '';
		$output .= be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		$output .= (isset($max_width) && !empty($max_width)) ? '</div>' : '';
	    $output .= ( true ===  $bool ) ? '</div>' : '' ;
	    return $output;
	}
	add_shortcode( 'text', 'be_text' );
}
/**************************************
			Html
**************************************/
if (!function_exists('be_html')) {
	function be_html( $atts, $content ) {
		extract( shortcode_atts( array (
	        'scroll_to_animate' => 0,
	        'animate' => 0,
	        'animation_type' => 'fadeIn',
	    ),$atts ) );

	    $output = '';
	    $bool = false;
		if( isset( $animate ) && 1 == $animate ) {
			$animate = 'be-animate';
			$bool = true;
		} else {
			$animate = '';
		}
		if( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) {
	    	$scroll_to_animate = 'scrollToFade';
	    	$bool = true;
	    } else {
			$scroll_to_animate = '';
		}
		$output .= ( true === $bool ) ? '<div class="be-text-block '.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">' : '' ;
		$output .= $content;
	    $output .= ( true ===  $bool ) ? '</div>' : '' ;
	    
	    return $output;
	}
	add_shortcode( 'html', 'be_html' );
}
/**************************************STYLING MODULES**************************************/

/**************************************
			ACCORDION
**************************************/
if (!function_exists('be_accordion')) {
	function be_accordion( $atts, $content ) {
		extract (
			shortcode_atts ( array ( 
				'collapsed' => 0
			), $atts)
		);
		return '<div class="accordion be-shortcode" data-collapsed="'.$collapsed.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'accordion', 'be_accordion' );
}
if (!function_exists('be_toggle')) {
	function be_toggle( $atts, $content ){
		extract (
			shortcode_atts ( array ( 
				'title' => '',
				'title_color' => '',
			), $atts)
		);
		return '<h3 class="accordion-head" style="color:'.$title_color.'">'.$title.'</h3><div>'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'toggle', 'be_toggle' );
}
/**************************************
			ANIMATED CHARTS
**************************************/
if (!function_exists('be_chart')) {
	function be_chart( $atts, $content ) {
		extract( shortcode_atts( array (
			'percentage' => '70',
			'caption' => '',
			'caption_size' => '',
			'percentage_color' => '',
			'percentage_font_size' => '',
			'caption_color' => '',
			'percentage_bar_color' => '',
			'percentage_track_color' => '',
			'percentage_scale_color' => '',
			'size' => 120,
			'linewidth' => 5,
			'icon' => 'none'
		),$atts ));
		$style = '';
		$style = ($size) ? 'style="width: '.$size.'px;height: '.$size.'px;line-height: '.$size.'px;"' : $style ;
		if(isset($icon) && !empty($icon) && $icon != 'none') {
			$icon = '<icon class="font-icon '.$icon.'"></i>';
		} else {
			$icon = '<span class="percentage">0</span>%';
		}
		return '<div class="chart-wrap"><div class="chart" data-percent="'.$percentage.'" data-percentage-bar-color="'.$percentage_bar_color.'" data-percentage-track-color="'.$percentage_track_color.'" data-percentage-scale-color="'.$percentage_scale_color.'" data-size="'.$size.'" data-linewidth="'.$linewidth.'" '.$style.'><span style="color: '.$percentage_color.'; font-size: '.$percentage_font_size.'px;">'.$icon.'</span></div><div><span style="color: '.$caption_color.'; font-size: '.$caption_size.'px;">'.$caption.'</span></div></div>';
	}
	add_shortcode( 'chart', 'be_chart' );
}
/**************************************
			ANIMATED NUMBERS
**************************************/
if (!function_exists('be_animated_numbers')) {
	function be_animated_numbers( $atts, $content ) {
		extract( shortcode_atts( array(
			'number' => '',
			'caption' => '',
	        'number_size' => '45',
	        'number_color' => '#141414',
	        'caption_size' => '13',
	        'caption_color' => '#141414',
	        'alignment' => 'center'
	    ), $atts ) );
		$output = '';
		$output = '<div class="animate-number-wrap align-'.$alignment.'">';
		$output .= '<span class="animate-number animate" data-number="'.$number.'" style="color:'.$number_color.';font-size:'.$number_size.'px;line-height:1.3"></span>';
		$output .= '<h6><span class="animate-number-caption" style="color:'.$caption_color.';font-size:'.$caption_size.'px;">'.$caption.'</span></h6>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'animated_numbers', 'be_animated_numbers' );
}
/**************************************
			BUTTON
**************************************/
if (!function_exists('be_button')) {
	function be_button( $atts, $content ) {
		extract( shortcode_atts( array (
			'button_text' => '',
			'icon' => 'none',
			'icon_alignment' => '',
			'url' => '',
			'new_tab'=> 'no',
			'type' => 'small',
			'alignment' => '',							 
			'bg_color' => '',
			'hover_bg_color' => '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'button_style' => 'none',	
			'image' => '',
			'background_animation' => '',
			'animate' => 0,
			'animation_type' => 'fadeIn',
		), $atts ) );
		
		$mfp_class = '';
		$output = '';
		$new_tab = ( isset( $new_tab ) && 'yes' == $new_tab ) ? 'target="_blank"' : '' ;
		if(isset($bg_color) && !empty($bg_color)) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="transparent"';
			$bg_color = 'transparent';
		}
		$data_hover_bg_color = (isset($hover_bg_color) && !empty($hover_bg_color)) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"';
		if(isset($color) && !empty($color)) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color="inherit"';
			$color = 'inherit';
		}
		$data_hover_color = (isset($hover_color) && !empty($hover_color)) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ;
		if(isset($border_color) && !empty($border_color)) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}	
		$data_hover_border_color = (isset($hover_border_color) && !empty($hover_border_color)) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"';
		$background_animation = (isset($background_animation) && !empty($background_animation)) ? $background_animation : 'bg-animation-none';
		$border_width = (!isset($border_width) || empty($border_width) || $border_width == '0') ? 0 : $border_width;
		$border_style = 'border-style: solid; border-width:'.$border_width.'px; border-color: '.$border_color;

		$alignment = ("block" == $type) ? 'center' : $alignment;
		if( isset($alignment) ){
			if($alignment != 'none'){
				$alignment = 'align-block block-'.$alignment;
			}else{
				$alignment = '';
			}
		}
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : ''; 
		// $rounded = ( $rounded == "1" && "block" != $type) ? "rounded" : '' ; 
		$button_style = (isset($button_style) && !empty($button_style)) ? $button_style : '';

		
		$url = ( empty( $url ) ) ? '#' : $url ;
		$image_wrap_class = '';
		if ( isset( $image ) && !empty( $image ) ) {
			$mfp_class='mfp-image';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$url = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$url = $video_url;
				$mfp_class = 'mfp-iframe';
			}
			$image_wrap_class = 'popup-gallery';
		}
		if ( !empty( $content ) ) {
			$mfp_class ='popup-with-content';
			$output .= '<div class="mfp-hide white-popup-block be-wrap clearfix" id="test"><div class="white-popup-block-content">'.$content.'</div></div>';
			$url = '#test';
		}
		$bg_animation_css = '';
		if($background_animation != 'bg-animation-none') {
			if($background_animation == 'bg-animation-slide-top' || $background_animation == 'bg-animation-slide-bottom') {
				$bg_animation_css = 'background-image: -moz-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -webkit-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -o-linear-gradient(top, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: linear-gradient(to bottom, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);';
			}
			if($background_animation == 'bg-animation-slide-left' || $background_animation == 'bg-animation-slide-right') {
				$bg_animation_css = 'background-image: -moz-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -webkit-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: -o-linear-gradient(left, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);
					background-image: linear-gradient(to right, '.$bg_color.' 50%, '.$hover_bg_color.' 50%);';
			}
		}
		$icon = ( isset($icon) && !empty($icon) && ($icon != 'none') ) ? '<i class="font-icon '.$icon.'"></i>' : '' ;
		$icon_alignment = ( isset($icon_alignment) && !empty($icon_alignment) ) ? $icon_alignment : 'left' ;
		$button_text = ( $icon_alignment == 'right' ) ? $button_text.$icon : $icon.$button_text ;
		$output .= '<div class="be-button-wrap '.$alignment.' '.$image_wrap_class.'">';
		$output .= '<a class="be-shortcode '.$type.'btn be-button '.$icon_alignment.'-icon '.$button_style.' '.$animate.' '.$mfp_class.' '.$background_animation.'" href="'.$url.'" style= "'.$border_style.';background-color: '.$bg_color.'; color: '.$color.'; '.$bg_animation_css.'" data-animation="'.$animation_type.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.' '.$new_tab.'>'.$button_text.'</a>' ; 
		$output .= '</div>'; 
		
		return $output;
	}
	add_shortcode( 'button', 'be_button' );
}
/**************************************
			CALL TO ACTION
**************************************/	
if ( ! function_exists( 'be_call_to_action' ) ) {
	function be_call_to_action( $atts, $content ) {
		extract( shortcode_atts( array(
			'bg_color'=> '',
			'title' => '',
			'h_tag' => 'h5',
			'title_color' => '',
			'button_text'=>'Click Here',
			'button_link'=> '',			
			'new_tab'=> 'no',
			'button_bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'image' => '',
			'animate'=> 0,
			'animation_type'=> 'fadeIn',
	    ), $atts ) );

		$output = '';
		$mfp_class = '';
		if($button_bg_color) {
			$data_bg_color = 'data-bg-color="'.$button_bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$button_bg_color = 'inherit';
		}

		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$button_bg_color.'"' ; 
		
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"' ; 
		$new_tab = ( isset( $new_tab ) && 'yes' == $new_tab ) ? 'target="_blank"' : '' ;

		if ( !empty( $image ) ) {
			$mfp_class='mfp-image image-popup-vertical-fit';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$button_link = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$button_link = $video_url;
				$mfp_class = 'mfp-iframe image-popup-vertical-fit';
			}
		}
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ; 
		$output .= '<div class="call-to-action be-shortcode clearfix '.$animate.'" data-animation="'.$animation_type.'" style="background: '.$bg_color.'">';
		$output .= '<'.$h_tag.' class="action-content" style="color:'.$title_color.';">'.$title.'</'.$h_tag.'>';
		$output .= ( ! empty( $button_link ) ) ? '<a class="mediumbtn be-button rounded action-button '.$mfp_class.'" href="'.$button_link.'" '.$new_tab.' style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$button_bg_color.'; color: '.$color.';" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'>'.$button_text.'</a>' : '' ;
		$output .= '</div>';
		return $output;	
	}
	add_shortcode( 'call_to_action', 'be_call_to_action' );
}
/**************************************
			CLIENTS
**************************************/
if ( ! function_exists( 'be_clients' ) ) {
	function be_clients($atts, $content) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'slide_show' => 'yes',
			'slide_show_speed' => 4000,
	    ), $atts ) );
	    $slide_show = ( isset( $slide_show ) && !empty($slide_show) && $slide_show == 'yes' ) ? 1 : 0 ;
		$slide_show_speed = ( isset( $slide_show_speed ) && !empty($slide_show_speed) ) ? $slide_show_speed : 4000 ;
		$output = '<div class="carousel-wrap clearfix">';
		// $output .='<ul class="be-carousel client-carousel" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'">';
		$output .='<ul class="be-owl-carousel client-carousel-module" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'">';
		$output .=do_shortcode($content);
		$output .='</ul>';
		// $output .='<a class="prev be-carousel-nav" href="#"><i class="font-icon icon-arrow_carrot-left"></i></a><a class="next be-carousel-nav" href="#"><i class="font-icon icon-arrow_carrot-right"></i></a>';
		$output .='</div>';
		return $output;
	}
	add_shortcode('clients','be_clients');
}
if ( ! function_exists( 'be_client' ) ) {
	function be_client( $atts, $content ) {
		extract( shortcode_atts( array(
			'image' => '',
			'link' => '',
			'new_tab'=> 'yes',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
	    ), $atts ) );

	    $output =  '';
	    if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}

		$new_tab = ( isset( $new_tab ) && 'yes' == $new_tab ) ? 'target="_blank"' : '' ;
	    $link = ( isset( $link ) && !empty($link) ) ? $link : '#' ; 
	    $attachment = wp_get_attachment_image_src( $image , 'full');
	    $url = $attachment[0];
	    $output .= ( $url ) ? '<li class="carousel-item client-carousel-item '.$img_grayscale.'"><a href="'.$link.'" '.$new_tab.'><img src="'.$url.'" alt="" /></a></li>' : '' ;
	   // $output .= ( $url ) ? '<li class="carousel-item client-carousel-item '.$img_grayscale.'"><img src="'.$url.'" alt="" /></li>' : '' ;
	    return $output;
	}
	add_shortcode( 'client', 'be_client' );
}
/**************************************
			DIVIDER
**************************************/
if ( ! function_exists( 'be_separator' ) ) {
	function be_separator( $atts ) {
		extract( shortcode_atts( array(
	        'height' => '1',
	        'width' => '20',
	        'color' => '#dedede',
	    ),$atts ) );
		$output = '';
		$style = '';
		$style = ( ! empty( $color ) ) ? 'background-color:'.$color.';color:'.$color.';' : $style ;
		$style .= ( ! empty( $height ) ) ? 'height:'.$height.'px;' : '' ;
		$style .= ( ! empty( $width ) ) ? 'width:'.$width.'%;' : '' ;
		
		$output .='<hr class="separator" style="'.$style.'" />';
		return $output;
	}
	add_shortcode( 'separator', 'be_separator' );
}
/**************************************
			DROP CAPS
**************************************/
if ( ! function_exists( 'be_dropcap' ) ) {
	function be_dropcap( $atts, $content ) {
		extract( shortcode_atts( array(
	        'type'=>'circle',
	        'color'=>'',
	        'size' =>'small',
	        'letter'=>'',
	        'icon'=>'none',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
		$output="";
		$background_color="";
		$letter = ( $icon != '' ) ? '<i class="font-icon '.$icon.'"></i>' : $letter ;
		$background_color .= ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : "" ; 
		
	 	if( 'rounded' == $type) {
	 		$background_color .=  ( $color ) ? '" style="background-color:'.$color.';"' : ' alt-bg alt-bg-text-color"' ;
	 		return '<span class="dropcap dropcap-rounded '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	 	}
	 	if( 'circle' == $type) {
	 		$background_color .=  ( $color ) ? '" style="background-color:'.$color.';"' : ' alt-bg alt-bg-text-color"' ;
	 		return '<span class="dropcap dropcap-circle '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	 	}
	 	if( 'letter' == $type) {
	 		$background_color .= ( $color ) ? '" style="color:'.$color.';"' : '' ;
			return '<span class="dropcap dropcap-letter '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		}
	}
	add_shortcode( 'dropcap', 'be_dropcap' );
}
/**************************************
			BE IMAGE SLIDER
**************************************/
if (!function_exists('be_flex_slider')) {
	function be_flex_slider( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animation'=> 'fade',
	        'auto_slide'=> 'no',                //Boolean: Animate slider automatically
			'slide_interval'=> '1000',          //Integer: Set the speed of the slideshow cycling, in milliseconds
	    ), $atts ) );
	    global $be_themes_data;
		if(!isset($be_themes_data['slider_navigation_style']) || empty($be_themes_data['slider_navigation_style'])) {
			$arrow_style = 'style1-arrow';
		} else {
			$arrow_style = $be_themes_data['slider_navigation_style'];
		}
	    $output = "";
	    $output .= '<div class="be_image_slider '.$arrow_style.'"><div class="image_slider_module slides" data-animation="'.$animation.'" data-auto-slide="'.$auto_slide.'" data-slide-interval="'.$slide_interval.'">';
		$output .= do_shortcode( $content );
	    // $output .= '</ul><div class="font-icon loader-style4-wrap loader-icon"></div>';
	    $output .= '</div></div>';
	    return $output;
	}
	add_shortcode( 'flex_slider', 'be_flex_slider' );
}
if (!function_exists('be_flex_slide')) {
	function be_flex_slide( $atts, $content ){
			extract( shortcode_atts( array(
				'image'=>'',
				'video'=>'',
	        	'size'=>'full',
	    	), $atts ) );

			$output = '';
	    	$output .= '<div class="be_image_slide">';
			if( ! empty( $video ) ) {	
				$videoType = be_themes_video_type( $video );
				if( $videoType == "youtube" ) {
					$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $match ) ) ? $match[1] : $video_id ; 
					$output.='<iframe width="940" height="450" src="https://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';
				}
				elseif( $videoType == "vimeo" ) {
					sscanf( parse_url( $video, PHP_URL_PATH ), '/%d', $video_id );
					$output.='<iframe src="https://player.vimeo.com/video/'.$video_id.'" width="500" height="281" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
			} else {
				if ( !empty( $image ) ) { // check if the post has a Post Thumbnail assigned to it.
					$attachment_info = wp_get_attachment_image_src( $image, $size );
					$attachment_url = $attachment_info[0];
					$output .=  '<img src="'.$attachment_url.'" alt="" />';
				}
			}
	        $output .='</div>';

	        return $output;
	}
	add_shortcode( 'flex_slide', 'be_flex_slide' );
}
/**************************************
		PORTFOLIO CAROUSEL
**************************************/
if (!function_exists('be_portfolio_carousel')) {
	function be_portfolio_carousel( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
	        'category'=> '',
	        'items_per_page'=> '-1',
	        'hover_style' => 'style1-hover',
			'overlay_color' => $be_themes_data['color_scheme'],
			'gradient_color' => $be_themes_data['color_scheme'],
			'gradient' => '0',
			'gradient_direction' => 'bottom',
			'overlay_opacity' => '85',
			'title_style' => 'style1',
			'title_color' => '',
			'cat_color' => '',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'title_animation_type' => 'none',
			'cat_animation_type' => 'none',
			'image_effect' => 'none',
			'like_button' => 0,
	    ) , $atts ) );
		$output = $global_thumb_overlay_color = $thumb_overlay_color = $global_gradient_style_color = $gradient_style_color = '';
		$category = explode(',', $category);
		$hover_image_style = ((!isset($hover_image_style)) || empty($hover_image_style)) ? 'color' : $hover_image_style;
		$title_animation_type = ((!isset($title_animation_type)) || empty($title_animation_type)) ? 'none' : $title_animation_type;
		$cat_animation_type = ((!isset($cat_animation_type)) || empty($cat_animation_type)) ? 'none' : $cat_animation_type;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$hover_style = ((!isset($hover_style)) || empty($hover_style)) ? 'style1-hover' : $hover_style;
		$gradient_direction = ((!isset($gradient_direction)) || empty($gradient_direction)) ? 'bottom' : $gradient_direction;
		$global_title_color = $title_color = (isset($title_color) && !empty($title_color)) ? $title_color : '';
		$global_cat_color = $cat_color = (isset($cat_color) && !empty($cat_color)) ? $cat_color : '';
		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		if(isset($overlay_opacity) && !empty($overlay_opacity)) {
			$global_overlay_opacity = $overlay_opacity = $overlay_opacity;
		} else {
			$global_overlay_opacity = $overlay_opacity = 85;
		}
		if(isset($overlay_color) && !empty($overlay_color)) {
			$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$global_thumb_overlay_color = $thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($global_overlay_opacity) / 100 ).')';
			if($gradient) {
				if(!isset($gradient_color) && empty($gradient_color)) {
					$gradient_color = $overlay_color;
				} else {
					$gradient_color = be_themes_hexa_to_rgb( $gradient_color );
				}
				$global_thumb_gradient_overlay_color = $thumb_gradient_overlay_color = 'rgba('.$gradient_color[0].','.$gradient_color[1].','.$gradient_color[2].','.(intval($global_overlay_opacity) / 100 ).')';
				$global_gradient_style_color = $gradient_style_color = 'background-image: -o-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -moz-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -webkit-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -ms-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: linear-gradient(to '.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);';
			}
		}
		$output .= '<div class="carousel-wrap portfolio-carousel">';
		// $output .= '<div class="caroufredsel_wrapper clearfix"><ul class="be-carousel portfolios-carousel">';
		$output .= '<ul class="be-owl-carousel portfolio-carousel-module">';
		$items_per_page = (empty($items_per_page)) ? -1 : $items_per_page ; 
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=>'date',				
			);
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=>'date',
			);	
		}
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$mfp_class = 'mfp-image';
				$post_terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
				$attachment_id = get_post_thumbnail_id(get_the_ID());
				$attachment_thumb=wp_get_attachment_image_src( $attachment_id, 'portfolio');
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
				if(isset($open_with) && $open_with == 'lightbox-gallery') {
					$thumb_class = 'be-lightbox-gallery';
				} else if(isset($open_with) && $open_with == 'lightbox') {
					$thumb_class = 'image-popup-vertical-fit';
				} else if(isset($open_with) && $open_with == 'none') {
					$thumb_class = 'no-link';
					$attachment_full_url = '#';
				} else {
					$thumb_class = '';
					$attachment_full_url = $permalink;
				}
				$trigger_animation = ($hover_style == 'style9-hover' || $hover_style == 'style10-hover') ? '' : 'animation-trigger';
				$output .='<li class="carousel-item element be-hoverlay '.$hover_style.' '.$img_grayscale.' '.$title_style.'-title"><div class="element-inner">';
				$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'" title="'.$attachment_info['title'].'">';
				$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$attachment_thumb_url.'" alt="'.$attachment_info['alt'].'" /></div></div>';
				$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
				$output .= '<div class="thumb-title-wrap ">';
				$output .= '<div class="thumb-title be-animate animated '.$trigger_animation.'" data-animation-type="'.$title_animation_type.'" style="color: '.$title_color.';">'.get_the_title().'</div>';
				$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
				if(!empty($terms)) {	
					$output .= '<div class="portfolio-item-cats be-animate animated '.$trigger_animation.'" data-animation-type="'.$cat_animation_type.'" style="color: '.$cat_color.';">';
					$length = 1;
					foreach ($terms as $term) {
						$output .= '<span>'.$term->name.'</span>';
						if(count($terms) != $length) {
							$output .= '<span>&middot; </span>';
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
				$output .= '</div>';
				$output .= ($like_button != 1) ? be_get_like_button(get_the_ID()) : '';
				$output .= '</li>';
			endwhile;
		endif;
		wp_reset_postdata();
		$output .='</ul>';
		// $output .='<a class="prev be-carousel-nav" href="#"><i class="font-icon icon-arrow_carrot-left"></i></a><a class="next be-carousel-nav" href="#"><i class="font-icon icon-arrow_carrot-right"></i></a>';
		// $output .='</div>'; 'Caroufredsel Wrapper Close'
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'portfolio_carousel' , 'be_portfolio_carousel' );
}
/**************************************
			PORTFOLIO
**************************************/
if (!function_exists('be_portfolio')) {
	function be_portfolio( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'gutter_style' => 'style1',
			'gutter_width' => 40,
	        'show_filters' => 'yes',
	        'tax_name' => 'portfolio_categories',
	        'filter' => 'categories',        
	        'category' => '',
	        'items_per_page' => '-1',
			'masonry' => '0',
			'gallery' => '0',
			'pagination' => 'none',
			'initial_load_style' => 'none',
			'item_parallax' => 0,
			'hover_style' => 'style1-hover',
			'title_alignment_static' => '',
			'overlay_color' => $be_themes_data['color_scheme'],
			'gradient_color' => $be_themes_data['color_scheme'],
			'gradient' => '0',
			'gradient_direction' => 'bottom',
			'overlay_opacity' => '85',
			'show_overlay' => '',
			'title_style' => 'style1',
			'title_color' => '',
			'cat_color' => '',
			'cat_hide' => 0,
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'title_animation_type' => 'none',
			'cat_animation_type' => 'none',
			'image_effect' => 'none',
			'like_button' => 0,
	    ) , $atts ) );
		$output = $global_thumb_overlay_color = $thumb_overlay_color = $global_gradient_style_color = $gradient_style_color = '';
		$col = ((!isset($col)) || empty($col)) ? 'three' : $col;
		$gutter_style = ((!isset($gutter_style)) || empty($gutter_style)) ? 'style1' : $gutter_style;
		$gutter_width = (isset($gutter_width) || $gutter_width == 0 || !empty($gutter_width)) ? intval( $gutter_width ) : intval(40);
		$masonry_enable = ((!isset($masonry)) || empty($masonry)) ? 'masonry_disable' : 'masonry_enable';
		$show_filters = ((!isset($show_filters)) || empty($show_filters)) ? 'yes' : $show_filters;
		$tax_name = ((!isset($tax_name)) || empty($tax_name)) ? 'portfolio_categories' : $tax_name;
		$filter_to_use = ((!isset($filter)) || empty($filter)) ? 'categories' : $filter;
		$items_per_page = ((!isset($items_per_page)) || empty($items_per_page)) ? '-1' : $items_per_page;
		$pagination = ((!isset($pagination)) || empty($pagination)) ? 'none' : $pagination;
		$default_image_style = ((!isset($default_image_style)) || empty($default_image_style)) ? 'color' : $default_image_style;
		$hover_image_style = ((!isset($hover_image_style)) || empty($hover_image_style)) ? 'color' : $hover_image_style;
		$title_animation_type = ((!isset($title_animation_type)) || empty($title_animation_type)) ? 'none' : $title_animation_type;
		$cat_animation_type = ((!isset($cat_animation_type)) || empty($cat_animation_type)) ? 'none' : $cat_animation_type;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$initial_load_style = ((!isset($initial_load_style)) || empty($initial_load_style)) ? 'none' : $initial_load_style;
		$gradient_direction = ((!isset($gradient_direction)) || empty($gradient_direction)) ? 'bottom' : $gradient_direction;
		$global_title_color = $title_color = (isset($title_color) && !empty($title_color)) ? $title_color : '';
		$global_cat_color = $cat_color = (isset($cat_color) && !empty($cat_color)) ? $cat_color : '';
		$cat_hide = (isset($cat_hide) && !empty($cat_hide) && intval($cat_hide) != 0) ? $cat_hide : 0;
		$item_parallax = (isset($item_parallax) && !empty($item_parallax) && intval($item_parallax) != 0) ? 'portfolio-item-parallax' : '';
		$show_overlay = (isset($show_overlay) && !empty($show_overlay) && intval($show_overlay) != 0) ? 'force-show-thumb-overlay' : '';
		$hover_style = ((!isset($hover_style)) || empty($hover_style) )  ? 'style1-hover' : $hover_style;
		$hover_style = (($show_overlay == 'force-show-thumb-overlay') || ($title_style == 'style5') || ($title_style == 'style6') || ($title_style == 'style7')) ? '' : $hover_style;

		if($show_overlay != ''){
			$title_animation_type = 'none';
			$cat_animation_type = 'none';
			// $initial_load_style = 'none';
		}

		if(isset($title_alignment_static) && !empty($title_alignment_static) && ($title_style == 'style5' || $title_style == 'style6')) {
			$title_alignment_static = 'text-align: '.$title_alignment_static.';';
		} else {
			$title_alignment_static = '';
		}
		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		if($gutter_style == 'style2') {
			$portfolio_wrap_style = 'style="margin-left: -'.$gutter_width.'px;"';
		} else {
			$portfolio_wrap_style = 'style="margin-right: '.$gutter_width.'px;"';
		}
		if(isset($overlay_opacity) && !empty($overlay_opacity)) {
			$global_overlay_opacity = $overlay_opacity = $overlay_opacity;
		} else {
			$global_overlay_opacity = $overlay_opacity = 85;
		}
		if(isset($overlay_color) && !empty($overlay_color)) {
			$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$global_thumb_overlay_color = $thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($global_overlay_opacity) / 100 ).')';
			if($gradient) {
				if(!isset($gradient_color) && empty($gradient_color)) {
					$gradient_color = $overlay_color;
				} else {
					$gradient_color = be_themes_hexa_to_rgb( $gradient_color );
				}
				$global_thumb_gradient_overlay_color = $thumb_gradient_overlay_color = 'rgba('.$gradient_color[0].','.$gradient_color[1].','.$gradient_color[2].','.(intval($global_overlay_opacity) / 100 ).')';
				$global_gradient_style_color = $gradient_style_color = 'background-image: -o-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -moz-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -webkit-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: -ms-linear-gradient('.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);background-image: linear-gradient(to '.$gradient_direction.', '.$global_thumb_overlay_color.' 0%, '.$global_thumb_gradient_overlay_color.' 100%);';
			}
		}
		$output .= '<div class="portfolio-all-wrap"><div class="portfolio full-screen full-screen-gutter '.$masonry_enable.' '.$gutter_style.'-gutter '.$col.'-col" data-action="get_ajax_full_screen_gutter_portfolio" data-category="'.$category.'" data-masonry="'.$masonry.'" data-showposts="'.$items_per_page.'" data-paged="2" data-col="'.$col.'" data-gallery="'.$gallery.'" data-filter="'.$filter_to_use.'" data-show_filters="'.$show_filters.'" data-thumbnail-bg-color="'.$global_thumb_overlay_color.'" data-thumbnail-bg-gradient="'.$gradient_style_color.'" data-title-style="'.$title_style.'" data-cat-color="'.$cat_color.'" data-title-color="'.$title_color.'" data-title-animation-type="'.$title_animation_type.'" data-cat-animation-type="'.$cat_animation_type.'" data-hover-style="'.$hover_style.'" data-gutter-width="'.$gutter_width.'" data-img-grayscale="'.$img_grayscale.'" data-image-effect="'.$image_effect.'" data-gradient-style-color="'.$global_gradient_style_color.'" data-cat-hide="'.$cat_hide.'" data-like-indicator="'.$like_button.'" '.$portfolio_wrap_style.'>';
		$category = explode(',', $category);
		
		if($filter_to_use == 'portfolio_tags' || empty( $category ) ) {
			// $terms = get_terms( $filter_to_use , array( 'orderby' => 'count' , 'order' => 'DESC') );
			$terms = get_terms( $filter_to_use );
		} else {
	 	 	$args_cat = array( 'taxonomy' => 'portfolio_categories' ) ;
	 	 	
			$stack = array();
			foreach(get_categories( $args_cat ) as $single_category ) {
				if ( in_array( $single_category->slug, $category ) ) {
					array_push( $stack, $single_category->cat_ID );
				}
			}

			// $terms = get_terms($filter_to_use, array( 'orderby' => 'count' , 'order' => 'DESC', 'include' => $stack) );
			$terms = get_terms($filter_to_use, array( 'include' => $stack) );
		}
		// var_dump($terms);
	    if(!empty( $terms ) && $show_filters == 'yes') {
	    	if($gutter_style == 'style2') {
				$portfolio_filter_style = 'style="margin-left: '.$gutter_width.'px;"';
			} else {
				$portfolio_filter_style = '';
			}
		    $output .= '<div class="filters clearfix" '.$portfolio_filter_style.'>';
	    	$output .= '<h6><span class="sort current_choice" data-id="element">'.__( 'All', 'be-themes' ).'</span></h6>';
	    	foreach ($terms as $term) {
	    		$output .= '<h6>';    		
	    		$output .= '<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';		
	    		$output .= '</h6>';
	    	}
	    	$output .= '</div>';
		}
		$output .= '<div class="portfolio-container clickable clearfix portfolio-shortcode '.$show_overlay.' '.$initial_load_style.' '.$item_parallax.'">';
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish'
			);
		} else {
			$args = array (
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=> apply_filters('be_portfolio_order_by','date'),
				'order'=> apply_filters('be_portfolio_order','DESC'),
				'post_status'=> 'publish',
				'tax_query' => array (
					array (
						'taxonomy' => $tax_name,
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					),
				),
			);	
		}
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail( get_the_ID() ) ) :
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
					//$target = ( $link_to == 'external_url' ) ? 'target="_blank"' : '';
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
						$thumb_class = 'image-popup-vertical-fit single-image';
					} else if( ( $link_to != 'external_url' ) && isset($open_with) && $open_with == 'none') {
						$thumb_class = 'no-link';
						$attachment_full_url = '#';
					} else {
						$thumb_class = '';
						$mfp_class = '';
						$attachment_full_url = $permalink;
					}
					if($title_style == 'style5' || $title_style == 'style6') {
						$trigger_animation  = '';
					} else {
						$trigger_animation  = 'animation-trigger';
					}
					$output .= '<div class="element be-hoverlay '.$filter_classes.' '.$image_atts['class'].' '.$image_atts['alt_class'].' '.$hover_style.' '.$img_grayscale.' '.$title_style.'-title" style="margin-bottom: '.$gutter_width.'px !important;">';
					$output .= '<div class="element-inner" style="margin-left: '.$gutter_width.'px;">';
					$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'" title="'.$attachment_info['title'].'" '.$target.'>';
					$output .= '<div class="flip-wrap"><div class="flip-img-wrap '.$image_effect.'-effect"><img src="'.$attachment_thumb_url.'" alt="'.$attachment_info['alt'].'" /></div></div>';
					$output .= '<div class="thumb-overlay "><div class="thumb-bg " style="background-color:'.$thumb_overlay_color.'; '.$gradient_style_color.'">';
					$output .= '<div class="thumb-title-wrap ">';
					$output .= '<div class="thumb-title be-animate animated '.$trigger_animation.'" data-animation-type="'.$title_animation_type.'" style="color: '.$title_color.'; '.$title_alignment_static.'">'.get_the_title().'</div>';
					$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
					if(!empty($terms) && (isset($cat_hide) && !($cat_hide) ) ) {	
						$output .= '<div class="portfolio-item-cats be-animate animated '.$trigger_animation.'" data-animation-type="'.$cat_animation_type.'" style="color: '.$cat_color.'; '.$title_alignment_static.'">';
						$length = 1;
						foreach ($terms as $term) {
							$output .= '<span>'.$term->name.'</span>';
							if(count($terms) != $length) {
								$output .= '<span> &middot; </span>';
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
					$output .= ($like_button != 1) ? be_get_like_button(get_the_ID()) : '';
					$output .= '</div>'; //End Element Inner
					$output .= '</div>'; //End Element
				endif;	
			endwhile;
		endif;
		wp_reset_postdata();
		$output .='</div>'; //end portfolio-container
		if('-1' != $items_per_page && ($the_query->found_posts-$items_per_page)>0) {
			$items_initial_load = $items_per_page;
			if( $pagination == 'infinite' ) {
				$output .='<div class="trigger_infinite_scroll portfolio_infinite_scroll"></div>';
			} elseif( $pagination == 'loadmore' ) {
				$output .='<div class="trigger_load_more portfolio_load_more" data-total-items="'.($the_query->found_posts-$items_initial_load).'"><a class="be-shortcode mediumbtn be-button rounded" href="#">'.__( 'Load More', 'be-themes' ).'</a></div>';
			}
		}
		$output .='</div></div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'portfolio' , 'be_portfolio' );
}
/*****************************************************
		GALLERY
*****************************************************/
if (!function_exists('be_gallery')) {
	function be_gallery( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'lightbox_type' => '',
			'gutter_style' => 'style1',
			'items_per_load' => '',
			'gallery_paginate' => 'none',
			'gutter_width' => 40,
			'masonry'=> '0',
			'initial_load_style' => 'none',
			'item_parallax' => 0,
			'hover_content_option' => 'icon',
			'disable_hover_icon' => '0',
			'hover_content_color' => '',
			'hover_style' => 'style1-hover',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'image_effect' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			'gradient_color' => $be_themes_data['color_scheme'],
			'gradient' => '0',
			'gradient_direction' => 'bottom',
			'overlay_opacity' => '85',
			'like_button' => 0,
			'image_source' => 'selected',
			'images' => '',
			'account_name' => 'themeforest',
			'count' => 10,
			'ids'	=> '',
			'columns' => 0,
			'link' => 'none',
		) , $atts ) );

		$output = $thumb_overlay_color = $gradient_style_color = '';
		$col = ((!isset($col)) || empty($col)) ? 'three' : $col;
		$columns = ((!isset($columns)) || empty($columns)) ? 0 : $columns;
		$link = ((!isset($link)) || empty($link)) ? '' : $link;
		$items_per_load = ((!isset($items_per_load)) || empty($items_per_load)) ? '' : $items_per_load;
		$gallery_paginate =  ((!isset($gallery_paginate)) || empty($gallery_paginate)) ? 'none' : $gallery_paginate;
		$gutter_style = ((!isset($gutter_style)) || empty($gutter_style)) ? 'style1' : $gutter_style;
		$gutter_width = (isset($gutter_width) || $gutter_width == 0 || !empty($gutter_width)) ? intval( $gutter_width ) : intval(40);
		$images = ((!isset($images)) || empty($images)) ? '' : $images;
		
		//Conditions if default WP gallery is used
		if($columns != 0 || (!empty($ids) && $images == '') ) {
			// $masonry = 1;
			$lightbox_type = 'photoswipe';
			$gutter_width = 10;
			if($columns > 5){
				$columns = 'three';
			}elseif($columns == 1){
				$columns = 'one';
			}elseif($columns == 2){
				$columns = 'two';
			}elseif($columns == 3){
				$columns = 'three';
			}elseif($columns == 4){
				$columns = 'four';
			}elseif($columns == 5){
				$columns = 'five';
			}
			$col = $columns;
		}

		//Condition if default WP gallery is used
		$images = (isset($ids) && $images == '') ? $ids : $images;
		$masonry = ((!isset($masonry)) || empty($masonry)) ? 0 : $masonry;
		
		

		$initial_load_style = ((!isset($initial_load_style)) || empty($initial_load_style)) ? 'none' : $initial_load_style;
		$hover_style = ((!isset($hover_style)) || empty($hover_style)) ? 'style1-hover' : $hover_style;
		// $disable_hover_icon = ((!isset($disable_hover_icon)) || empty($disable_hover_icon)) ? '' : 'hover-icon-no-show';
		// $hover_content_option = ((!isset($hover_content_option)) || empty($hover_content_option)) ? 'icon' : $hover_content_option;
		$hover_content_color = ((!isset($hover_content_color)) || empty($hover_content_color)) ? '' : $hover_content_color;
		$default_image_style = ((!isset($default_image_style)) || empty($default_image_style)) ? 'color' : $default_image_style;
		$hover_image_style = ((!isset($hover_image_style)) || empty($hover_image_style)) ? 'color' : $hover_image_style;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$gradient_direction = ((!isset($gradient_direction)) || empty($gradient_direction)) ? 'bottom' : $gradient_direction;
		$image_source = ((!isset($image_source)) || empty($image_source)) ? 'selected' : $image_source;
		$account_name = ((!isset($account_name)) || empty($account_name)) ? 'themeforest' : $account_name;
		$item_parallax = (isset($item_parallax) && !empty($item_parallax) && intval($item_parallax) != 0) ? 'portfolio-item-parallax' : '';
		$count = ((!isset($count)) || empty($count)) ? 10 : $count;

		if( ( (!isset($hover_content_option)) || empty($hover_content_option))){
			$hover_content_option = 'icon';
		}elseif($hover_content_option == 'none'){
			$disable_hover_icon = 'hover-icon-no-show';
		} 
		
		// Changes for PhotoSwipe Gallery
		$element_class = ('photoswipe' == $lightbox_type) ? 'be-photoswipe-gallery' : '' ;
		//End 
		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		$overlay_opacity = ((!isset($overlay_opacity)) || empty($overlay_opacity)) ? 85 : $overlay_opacity;
		if(isset($overlay_color) && !empty($overlay_color)) {
			$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
			if($gradient) {
				if(!isset($gradient_color) && empty($gradient_color)) {
					$gradient_color = $overlay_color;
				} else {
					$gradient_color = be_themes_hexa_to_rgb( $gradient_color );
				}
				$thumb_gradient_overlay_color = 'rgba('.$gradient_color[0].','.$gradient_color[1].','.$gradient_color[2].','.(intval($overlay_opacity) / 100 ).')';
				$gradient_style_color = 'background-image: -o-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -moz-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -webkit-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -ms-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: linear-gradient(to '.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);';
			}
		}
		if($gutter_style == 'style2') {
			$portfolio_wrap_style = 'style="margin-left: -'.$gutter_width.'px;"';
		} else {
			$portfolio_wrap_style = 'style="margin-right: '.$gutter_width.'px;"';
		}
		$source = array (
			'source' => $image_source,
			'account_name' => $account_name, 
			'count' => $count,
			'col' => $col,
			'masonry' => $masonry
		);

		$paged  = '0';
		$images_offset = '0';

		$images_arr = $images;	
		$data_total_items = count(explode(',',$images_arr)) - $items_per_load;
		
		if('none' != $gallery_paginate && '' != $items_per_load){
			$images_subset = array_slice(explode(',', $images), $images_offset, $items_per_load);
		}else{
			$images_subset = explode(',', $images);
		}
		$images = get_gallery_image_from_source($source, implode(",",$images_subset), $lightbox_type);
		
		if($images && is_array($images) && !isset($images['error']) && empty($images['error'])) {
			$output .= '<div class="portfolio-all-wrap '.$disable_hover_icon.'">';
			$output .= '<div class="portfolio full-screen full-screen-gutter '.$gutter_style.'-gutter '.$col.'-col" '.$portfolio_wrap_style.' data-action="get_be_gallery_with_pagination" data-paged="1" data-masonry="'.$masonry.'" data-source=\''.json_encode($source).'\' data-gutter-width="'.$gutter_width.'" data-images-array="'.$images_arr.'" data-col="'.$col.'" data-items-per-load="'.$items_per_load.'" data-hover-style="'.$hover_style.'" data-image-grayscale="'.$img_grayscale.'" data-lightbox-type="'.$lightbox_type.'" data-image-source="'.$image_source.'" data-image-effect="'.$image_effect.'" data-thumb-overlay-color="'.$thumb_overlay_color.'" data-grad-style-color="'.$gradient_style_color.'" data-like-button="'.$like_button.'" data-hover-content="'.$hover_content_option.'" data-hover-content-color="'.$hover_content_color.'" >';
			$output .= '<div class="portfolio-container clickable clearfix portfolio-shortcode '.$element_class.' '.$initial_load_style.' '.$item_parallax.'">';
			$output .= get_be_gallery_shortcode($images, $col, $masonry, $hover_style, $img_grayscale, $gutter_width, $lightbox_type, $image_source, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $hover_content_option, $hover_content_color); //1.9
			$output .= '</div>'; //end portfolio-container
			if('' != $items_per_load && (isset($gallery_paginate)) && 'selected' == $image_source) {
				if( $gallery_paginate == 'infinite' ) {
					$output .='<div class="trigger_infinite_scroll gallery_infinite_scroll"></div>';
				} elseif( $gallery_paginate == 'loadmore' ) {
					$output .='<div class="trigger_load_more gallery_load_more " data-total-items="'.$data_total_items.'"><a class="be-shortcode mediumbtn be-button rounded" href="#">'.__( 'Load More', 'be-themes' ).'</a></div>';
				}
			}
			$output .= '</div>'; //end portfolio
			$output .= '</div>'; //end portfolio-all-wrap
		} else {
			if(is_array($images) && !empty($images['error'])) {
				$output .= '<p class="element-empty-message">'.$images['error'].'</p>';
			} else {
				$output .= '<p class="element-empty-message"><b>'.__('Gallery Error : ', 'be-themes').'</b>'.__('Unknown Error Please try again later', 'be-themes').'</p>';
			}
		}
		return $output;
	}
	add_shortcode( 'gallery' , 'be_gallery' );
}

/*****************************************************
		GALLERY
*****************************************************/
if (!function_exists('be_justified_gallery')) {
	function be_justified_gallery( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'gutter_width' => 40,
			'image_height' => 200,
			'initial_load_style' => 'none',
			'hover_style' => 'style1-hover',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'image_effect' => 'none',
			'disable_overlay' => 0,
			'overlay_color' => $be_themes_data['color_scheme'],
			'gradient' => '0',
			'gradient_color' => $be_themes_data['color_scheme'],
			'gradient_direction' => 'bottom',
			'overlay_opacity' => '85',
			'items_per_load' => '12',
			'gallery_paginate' => 0,
			'like_button' => 0,
			'images' => '',
		) , $atts ) );

		$output = $thumb_overlay_color = $gradient_style_color = '';
		$gutter_width = (isset($gutter_width) || $gutter_width == 0 || !empty($gutter_width)) ? intval( $gutter_width ) : intval(40);
		$image_height = (isset($image_height) || $image_height == 0 || !empty($image_height)) ? intval( $image_height ) : intval(200);
		$images = ((!isset($images)) || empty($images)) ? '' : $images;
		$initial_load_style = ((!isset($initial_load_style)) || empty($initial_load_style)) ? 'none' : $initial_load_style;
		$hover_style = ((!isset($hover_style)) || empty($hover_style)) ? 'style1-hover' : $hover_style;
		$disable_hover_icon = ((!isset($disable_hover_icon)) || empty($disable_hover_icon)) ? '' : 'hover-icon-no-show';
		$default_image_style = ((!isset($default_image_style)) || empty($default_image_style)) ? 'color' : $default_image_style;
		$hover_image_style = ((!isset($hover_image_style)) || empty($hover_image_style)) ? 'color' : $hover_image_style;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$gradient_direction = ((!isset($gradient_direction)) || empty($gradient_direction)) ? 'bottom' : $gradient_direction;
		$disable_overlay = (isset($disable_overlay) && !empty($disable_overlay) && $disable_overlay == 1) ? 1 : 0;
		$items_per_load = ((!isset($items_per_load)) || empty($items_per_load)) ? '' : $items_per_load;
		$gallery_paginate =  ((isset($gallery_paginate)) && !empty($gallery_paginate) && $gallery_paginate == 1) ? 1 : 0;
		

		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		$overlay_opacity = ((!isset($overlay_opacity)) || empty($overlay_opacity)) ? 85 : $overlay_opacity;
		if(isset($overlay_color) && !empty($overlay_color)) {
			$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
			if($gradient) {
				if(!isset($gradient_color) && empty($gradient_color)) {
					$gradient_color = $overlay_color;
				} else {
					$gradient_color = be_themes_hexa_to_rgb( $gradient_color );
				}
				$thumb_gradient_overlay_color = 'rgba('.$gradient_color[0].','.$gradient_color[1].','.$gradient_color[2].','.(intval($overlay_opacity) / 100 ).')';
				$gradient_style_color = 'background-image: -o-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -moz-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -webkit-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: -ms-linear-gradient('.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);background-image: linear-gradient(to '.$gradient_direction.', '.$thumb_overlay_color.' 0%, '.$thumb_gradient_overlay_color.' 100%);';
			}
		}
		$source = array (
			'source' => 'selected',
			'account_name' => '', 
			'count' => '',
			'col' => 'three',
			'masonry' => 1,
		);


		$paged  = '0';
		$images_offset = '0';

		$images_arr = $images;	
		$data_total_items = count(explode(',',$images_arr)) - $items_per_load;
		
		if(1 == $gallery_paginate && '' != $items_per_load){
			$images_subset = array_slice(explode(',', $images), $images_offset, $items_per_load);
		}else{
			$images_subset = explode(',', $images);
		}

		$images = get_gallery_image_from_source($source, implode(",",$images_subset), 'photoswipe');
		

		// $images = get_gallery_image_from_source($source, $images, 'photoswipe');
		
		if($images && is_array($images) && !isset($images['error']) && empty($images['error'])) {
			$output .= '<div class="justified-gallery-outer-wrap '.$disable_hover_icon.'">';
			$output .= '<div class=" justified-gallery-inner-wrap " data-action="get_be_justified_gallery_with_pagination" data-paged="1" data-source=\''.json_encode($source).'\' data-images-array="'.$images_arr.'" data-items-per-load="'.$items_per_load.'" data-hover-style="'.$hover_style.'" data-image-grayscale="'.$img_grayscale.'" data-image-effect="'.$image_effect.'" data-thumb-overlay-color="'.$thumb_overlay_color.'" data-grad-style-color="'.$gradient_style_color.'" data-like-button="'.$like_button.'" data-disable-overlay="'.$disable_overlay.'" >';
			$output .= '<div class=" justified-gallery clickable clearfix be-photoswipe-gallery '.$initial_load_style.'" data-gutter-width="'.$gutter_width.'" data-image-height="'.$image_height.'">';
			$output .= get_be_justified_gallery_shortcode($images, $hover_style, $img_grayscale, $image_effect, $thumb_overlay_color, $gradient_style_color, $like_button, $disable_overlay);
			$output .= '</div>'; //end justified-gallery
			if('' != $items_per_load && (1 == $gallery_paginate) ) {
				$output .='<div class="trigger_infinite_scroll justified_gallery_infinite_scroll"></div>';  
			}
			$output .= '</div>'; //end justified-gallery-inner-wrap
			$output .= '</div>'; //end justified-gallery-outer-wrap
		} else {
			if(is_array($images) && !empty($images['error'])) {
				$output .= '<p class="element-empty-message">'.$images['error'].'</p>';
			} else {
				$output .= '<p class="element-empty-message"><b>'.__('Gallery Error : ', 'be-themes').'</b>'.__('Unknown Error Please try again later', 'be-themes').'</p>';
			}
		}
		return $output;
	}
	add_shortcode( 'justified_gallery' , 'be_justified_gallery' );
}

/*****************************************************
		PhotoSwipe Gallery Markup
*****************************************************/
if (!function_exists('photoswipe_wrapper')) {

	function photoswipe_wrapper( $atts ) { 
		echo '	
		    <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		        <div class="pswp__bg"></div>

		        <div class="pswp__scroll-wrap">

		          <div class="pswp__container">
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
		          </div>

		          <div class="pswp__ui pswp__ui--hidden">

		            <div class="pswp__top-bar">

						<div class="pswp__counter"></div>

						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

						<button class="pswp__button pswp__button--share" title="Share"></button>

						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
							  <div class="pswp__preloader__cut">
							    <div class="pswp__preloader__donut"></div>
							  </div>
							</div>
						</div>
		            </div>


					<!-- <div class="pswp__loading-indicator"><div class="pswp__loading-indicator__line"></div></div> -->

		            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
			            <div class="pswp__share-tooltip">
							<!-- <a href="#" class="pswp__share--facebook"></a>
							<a href="#" class="pswp__share--twitter"></a>
							<a href="#" class="pswp__share--pinterest"></a>
							<a href="#" download class="pswp__share--download"></a> -->
			            </div>
			        </div>

		            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
		            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
		            <div class="pswp__caption">
		              <div class="pswp__caption__center">
		              </div>
		            </div>
		          </div>

		        </div>

		    </div>' ;
	}
	add_action('wp_footer','photoswipe_wrapper');
}

/*****************************************************
		Portfolio Navigation
*****************************************************/
if (!function_exists('portfolio_navigation_module')) {
	function portfolio_navigation_module( $atts, $content ) {
		extract( shortcode_atts( array (
			'style' => 'style1',
			'title_align' => 'center',
		    'nav_links_color' => '',
		    'animate' => 0,
			'animation_type'=>'fadeIn',
	    ), $atts ));
		global $be_themes_data;
		$portfolio_home_page = get_post_meta( get_the_ID(), 'be_themes_portfolio_home_page', true); //Get link from Meta Options
		$portfolio_home_page = ($portfolio_home_page == '' ? $be_themes_data['portfolio_home_page'] : $portfolio_home_page) ; //Get link from Options panel link is not present in Meta Options
		$portfolio_catg_traversal = (1 == get_post_meta( get_the_ID(), 'be_themes_traverse_catg', true) ? true : false);
	    $output = "";
	    $style = ((!isset($style)) || empty($style)) ? 'style1' : $style;
	    $animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
	    $grid_icon_background = !empty( $nav_links_color ) ? ' style="background: '.$nav_links_color.';"' : '';
	    $nav_links_color = !empty( $nav_links_color ) ? ' style="color : '.$nav_links_color.';"' : '';
        if ( is_singular( 'portfolio' ) ) {
            
            if(!empty($portfolio_home_page)) {
                $url = $portfolio_home_page;
            } else {
                $url = site_url();
            }
        } else {
            $url = be_get_posts_page_url();
        }
		if((!is_page_template( 'gallery.php' )) || (!is_page_template( 'portfolio.php' ))) {
			if($style == 'style1') {
				$output .= '<div class="portfolio-nav-wrap style1-navigation'.$animate.' align-'.$title_align.'" data-animation="'.$animation_type.'" '.$nav_links_color.'>';
				// ob_start();  
				// get_template_part( 'single', 'navigation' ); 
				// $output .= ob_get_contents();  
				// ob_end_clean();
				    $output .= '<div id="nav-below" class="single-page-nav">';
				    $output .=  get_next_post_link( '%link', '<i class="font-icon icon-arrow_left" title="%title"></i>' , $portfolio_catg_traversal , '' , 'portfolio_categories');				    
				    $output .= '<a href="'.$url.'">
				    				<div class="home-grid-icon">
				    					<span'.$grid_icon_background.'></span>
				    					<span'.$grid_icon_background.'></span>
				    					<span'.$grid_icon_background.'></span>
				    					<span'.$grid_icon_background.'></span>
				    					<span'.$grid_icon_background.'></span>
				    					<span'.$grid_icon_background.'></span>
				    				</div>
				    			</a>';
				    $output .= get_previous_post_link( '%link', '<i class="font-icon icon-arrow_right" title="%title"></i>' , $portfolio_catg_traversal , '' , 'portfolio_categories' );
				    $output .= '</div>';

				$output .= '</div>';
			} else {
				$output .= '<div class="portfolio-nav-wrap '.$animate.'" data-animation="'.$animation_type.'" '.$nav_links_color.'>';
	    		$output .= '<div id="nav-below" class="single-page-nav style2-navigation">';
	    		$next_post = get_previous_post($portfolio_catg_traversal, ' ', 'portfolio_categories');
				$prev_post = get_next_post($portfolio_catg_traversal, ' ', 'portfolio_categories');
				if($prev_post) {
					$output .= '<a href="'.get_permalink($prev_post->ID).'" title="'.str_replace('"', '\'', $prev_post->post_title).'" class="previous-post-link" >
									<i class="font-icon icon-arrow-left7"></i>
									<h6'.$nav_links_color.'>'.str_replace('"', '\'', $prev_post->post_title).'</h6>
								</a>';
				}
	        	$output .= '<a href="'.$url.'" class="portfolio-url">
	        					<div class="home-grid-icon">
	        						<span'.$grid_icon_background.'></span>
	        						<span'.$grid_icon_background.'></span>
	        						<span'.$grid_icon_background.'></span>
	        						<span'.$grid_icon_background.'></span>
	        						<span'.$grid_icon_background.'></span>
	        						<span'.$grid_icon_background.'></span>
	        					</div>
	        				</a>';
	        	if($next_post) {
	        		$output .= '<a href="'.get_permalink($next_post->ID).'" title="'.str_replace('"', '\'', $next_post->post_title).'" class="next-post-link" >
	        						<h6'.$nav_links_color.'>'.str_replace('"', '\'', $next_post->post_title).'</h6>
	        						<i class="font-icon icon-arrow-left7"></i>
	        					</a>';
	        	}
	    		$output .= '</div>';
	    		$output .= '</div>';
			}
		}
	    return $output;
	}
	add_shortcode( 'portfolio_navigation_module', 'portfolio_navigation_module' );
}
/**************************************
		BLOG MASONRY
**************************************/
if (!function_exists('be_blog')) {
	function be_blog( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'gutter_style' => 'style1',
			'gutter_width' => 40,
		) , $atts ) );
		$output = '';
		global $paged, $blog_attr;
		$col = ((!isset($col)) || empty($col)) ? 'three' : $col;
		$blog_attr['gutter_style'] = ((!isset($gutter_style)) || empty($gutter_style)) ? 'style1' : $gutter_style;
		$blog_attr['gutter_width'] = ((!isset($gutter_width)) || empty($gutter_width)) ? intval(40) : intval( $gutter_width );
		$blog_attr['style'] = 'shortcodes';
		if($blog_attr['gutter_style'] == 'style2') {
			$portfolio_wrap_style = 'style="margin-left: -'.$blog_attr['gutter_width'].'px;"';
		} else {
			$portfolio_wrap_style = 'style="margin-right: '.$blog_attr['gutter_width'].'px;"';
		}
		$output .= '<div class="portfolio-all-wrap">';
		$output .= '<div class="portfolio full-screen full-screen-gutter '.$gutter_style.'-gutter '.$col.'-col" data-gutter-width="'.$blog_attr['gutter_width'].'" '.$portfolio_wrap_style.' data-col="'.$col.'">';
		$output .= '<div class="style3-blog portfolio-container clickable clearfix">';
		$blog_attr['gutter_width'] = $gutter_width;
		$args = array( 'post_type' => 'post', 'paged' => $paged );
		$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post();
					ob_start();  
					get_template_part( 'blog/loop', 'shortcodes' );
					$output .= ob_get_contents();  
					ob_end_clean();
				endwhile;
			else:
				$output .= '<p class="inner-content">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
			endif;
		$output .= '</div>'; //end portfolio-container
		$output .= ($the_query->max_num_pages > 1) ? '<div class="pagination_parent" style="margin-left: '.$blog_attr['gutter_width'].'px">'.get_be_themes_pagination($the_query->max_num_pages).'</div>' : '' ;
		$output .= '</div>';
		$output .= '</div>'; //end portfolio
		wp_reset_postdata();
		return $output;
	}
	add_shortcode( 'blog' , 'be_blog' );
}
/**************************************
			GOOGLE MAPS
**************************************/
if ( ! function_exists( 'be_gmaps' ) ) {
	function be_gmaps( $atts, $content ) {
		extract( shortcode_atts( array(
			//'api_key' =>'',
			'address'=>'',
			'latitude'=>'',
			'longitude'=>'',
			'height'=>'300',
			'zoom'=>'14',
			'style'=>'default',
			'marker' => '',
			'animate'=>0,
			'animation_type'=>'fadeIn',
		), $atts ) );
		$output = '';
		$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		$full = wp_get_attachment_image_src( $marker, 'full' );
		$marker_image = $full[0];
		if(!empty($latitude) && !empty($longitude)) {
			$map_error = false;
		} 
		else if( ! empty( $address ) ) { //&& !empty($api_key) ) {
			$map_error = false;
			$transient_var = generateSlug($address, 10);
			$transient_result = get_transient( $transient_var );
			if(!$transient_result ) {
				//$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
				$response = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) );//. '&key='.urlencode( $api_key ) );
				if ( is_wp_error( $response ) ) {
					$map_error = true;
					delete_transient( $transient_var );
				} else {
					$coordinates = wp_remote_retrieve_body( $response );
					if ( is_wp_error( $coordinates ) ) {
						$map_error = true;
						delete_transient( $transient_var );
					} else {
						$coordinates_check = json_decode($coordinates);
						if($coordinates_check->status == 'OK') {					
							$latitude = $coordinates_check->results[0]->geometry->location->lat;
							$longitude = $coordinates_check->results[0]->geometry->location->lng;
							set_transient( $transient_var, $coordinates, 24 * HOUR_IN_SECONDS );
							
						} else {
							$map_error = true;
							delete_transient( $transient_var );
						}
					}
				}
			} else {
				$coordinates_check = json_decode($transient_result);
				$latitude = $coordinates_check->results[0]->geometry->location->lat;
				$longitude = $coordinates_check->results[0]->geometry->location->lng;
			}
			
		} else {
			$map_error = true;
		}

		if(  true === $map_error ) {
			$output .= '<div class="be-notification error">'.__('Your Server is Unable to connect to the Google Geocoding API, kindly visit <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">THIS LINK </a>, find out the latitude and longitude of your address and enter it manually in the Google Maps Module of the Page Builder ', 'be-themes').'</div>';
		} else {
			$output .= '<div class="gmap-wrapper '.$animate.'" style="height:'.$height.'px;" data-animation="'.$animation_type.'"><div class="gmap map_960" data-address="'.$address.'" data-zoom="'.$zoom.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-marker="'.$marker_image.'" data-style="'.$style.'"></div></div>';
		}
		
		return $output;
	}
	add_shortcode( 'gmaps', 'be_gmaps' );
}
/**************************************
			LIGHTBOX IMAGE
**************************************/
if ( ! function_exists( 'be_lightbox_image' ) ) {
	function be_lightbox_image( $atts, $content ){
		extract( shortcode_atts( array(
			'image'=>'',
			'link'=>'',
		), $atts ) );

		$output = '';
		$full = wp_get_attachment_image_src( $image, 'full' );
		$attachment_thumb_url = $full[0];
		$attachment_full_url = $full[0];
		$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
		$mfp_class='mfp-image';
		if( ! empty( $video_url ) ) {
			$attachment_full_url = $video_url;
			$mfp_class = 'mfp-iframe';
		}	
		$output .= '<div class="element-inner">';
		$output .='<div class="thumb-wrap"><img src="'.$attachment_thumb_url.'" alt />';
						$output .='<div class="thumb-overlay"><div class="thumb-bg">';
						$output .='<div class="thumb-icons">';
						$output .= ( ! empty( $link ) ) ? '<a href="'.$link.'"><i class="font-icon icon-link"></i></a>' : '' ;
						$output .='<a href="'.$attachment_full_url.'" class="image-popup-vertical-fit '.$mfp_class.'"><i class="font-icon icon-search"></i></a>';
						$output .= '</div>'; // end thumb icons								
						$output .='</div></div>';//end thumb overlay & bg
						$output .='</div>';//end thumb wrap
						$output .='</div>';
		return $output;
	}
	add_shortcode('lightbox_image','be_lightbox_image');
}
/**************************************
			GRID
**************************************/
if (!function_exists('be_grids')) {
	function be_grids( $atts, $content ) {
		extract( shortcode_atts( array (
			'column' => 1,
			'border_color' => '',
	    ), $atts ) );
		if(empty( $column )) {
			$column = 2;
		}
	    $output = "";
	    $output .= '<div class="grid-wrap " data-col="'.$column.'" style="border-color: '.$border_color.';">';
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'grids', 'be_grids' );
}
if (!function_exists('be_grid_content')) {
	function be_grid_content( $atts, $content ){
			extract( shortcode_atts( array (
				'icon' => '',
				'icon_size' => 'medium',
				'icon_color' => '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="grid-col '.$animate.' align-center" data-animation="'.$animation_type.'">';
			$output .= ($icon != '') ? '<i class="font-icon '.$icon.' '.$icon_size.' " style="color: '.$icon_color.';"></i>' : '' ;
			$output .= ($content != '') ? '<div class="grid-info">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>' : '';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'grid_content', 'be_grid_content' );
}
/**************************************
			FONT ICONS
**************************************/
if (!function_exists('be_icons')) {
	function be_icons( $atts, $content ) {
		extract(shortcode_atts(array(
			'name' => '',
			'size'=> 'medium',
			'style'=> 'circle',
			'bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 1,
			'border_color'=> '#323232',
			'hover_border_color'=> '#323232',
			'href'=> '#',
			'alignment' => 'none',
			'image' => '',
			'new_tab' => 0,
			'animate' => 0,
			'animation_type'=>'fadeIn',
		),$atts));

		$mfp_class = '';
		$output = '';
		if($bg_color) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$bg_color = 'inherit';
		}
		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"' ; 
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"' ; 
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		$href = ( empty( $href ) ) ? '#' : $href ; 
		if ( !empty( $image ) ) {
			$mfp_class='mfp-image image-popup-vertical-fit';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$href = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$href = $video_url;
				$mfp_class = 'mfp-iframe image-popup-vertical-fit';
			}
		}

		// $output .= ( $alignment && $alignment != 'none' ) ? '<div class="icon-shortcode align-'.$alignment.'">' : '' ; 
		$output .= '<div class="icon-shortcode align-'.$alignment.'">'; 
		$output .= '<a href="'.$href.'" class="icon-shortcode icon-'.$style.' '.$animate.' '.$mfp_class.'" data-animation="'.$animation_type.'" '.$new_tab.'>';
		$output .= ( $style == 'plain' ) ? '<i class="font-icon '.$name.' '.$size.' '.$style.'" style="color:'.$color.';" data-color="'.$color.'" data-hover-color="'.$hover_color.'"></i></a>' : '<i class="font-icon '.$name.' '.$size.' '.$style.'" style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$bg_color.'; color: '.$color.';" data-animation="'.$animation_type.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'></i></a>' ;
		//$output .= ( $alignment && $alignment != 'none' ) ? '</div>' : '' ;
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'icon', 'be_icons' );
}
/**************************************
			LISTS
**************************************/
if (!function_exists('be_lists')) {
	function be_lists( $atts, $content ) {
		return '<ul class="custom-list">'.do_shortcode( $content ).'</ul>';
	}
	add_shortcode( 'lists', 'be_lists' );
}
if (!function_exists('be_list')) {
	function be_list( $atts, $content ) {
		global $be_themes_data;
		extract(shortcode_atts( array( 
			'icon'=>'',
			'circled'=>'',
			'icon_bg'=> $be_themes_data['color_scheme'], 
			'icon_color' => $be_themes_data['alt_bg_text_color'], 
		), $atts ) );
		if( $icon != 'none' ) { 
		 	if( 1 == $circled ){
		 		$circled = 'circled';
		 		$background_color = 'background-color:'.$icon_bg.';';
		 	} else {
		 		$circled = '';
		 		$background_color = ''; 		
		 	}
		} 
		return '<li class="custom-list-content"><i class="font-icon '.$icon.' '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i><span class="custom-list-content-inner">'.$content.'</span></li>';
	}
	add_shortcode( 'list', 'be_list' );
}
/**************************************
			NOTIFICATIONS
**************************************/
if (!function_exists('be_notifications')) {
	function be_notifications( $atts, $content ) {
		extract(shortcode_atts( array(
	        'bg_color'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
	    $style = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$style = ( ! empty( $bg_color ) ) ? 'background-color:'.$bg_color.';' : '' ;
		
		return '<div class="be-notification '.$animate.'" style="'.$style.'" data-animation="'.$animation_type.'"><span class="close"><i class="font-icon icon-icon_close"></i></span>'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'notifications', 'be_notifications' );
}
/**************************************
			PLUG IN SHORTCODES
**************************************/
if (!function_exists('be_shortcode_modules')) {
	function be_shortcode_modules( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output = '';
		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ;
		$output .= do_shortcode( $content );
		$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
		
		return $output;
	}
	add_shortcode( 'shortcode_modules', 'be_shortcode_modules' );
}
/**************************************
			PORTFOLIO DETAILS
**************************************/
if ( ! function_exists( 'be_project_details' ) ) {
	function be_project_details( $atts, $content ) {
		extract( shortcode_atts( array (
			'style' => 'style1',
	        'alignment'=> 'left'
	    ),$atts ) );
	    global $be_themes_data;
	    $alignment = (!isset($alignment) || empty($alignment)) ? 'left' : $alignment;
	    $style = (!isset($style) || empty($style)) ? 'style1' : $style;
	    if($style == 'style2') {
	    	$alignment = 'initial';
	    }
		global $post;
		$output = '';
		$post_type = get_post_type();
		if( $post_type != 'portfolio' ) {
			return '';
		} else {
			$output .= '<div class="portfolio-details '.$style.'" style="text-align: '.$alignment.'">';
			if((!is_page_template( 'gallery.php' )) || (!is_page_template( 'portfolio.php' ))) {
				if(get_post_meta($post->ID,'be_themes_portfolio_client_name',true)) {
					$output .= '<div class="gallery-side-heading-wrap portfolio-client-name clearfix"><h6 class="gallery-side-heading">'.__('Client', 'be-themes').'</h6>';
					$output .= '<p><span class="project_client">'.get_post_meta($post->ID, 'be_themes_portfolio_client_name', true).'</span></p></div>';
				}
				if(get_post_meta($post->ID,'be_themes_portfolio_project_date',true)) {
					$output .= '<div class="gallery-side-heading-wrap portfolio-project-date clearfix"><h6 class="gallery-side-heading">'.__('Project Date', 'be-themes').'</h6>';
					$output .= '<p><span class="project_client">'.get_post_meta($post->ID, 'be_themes_portfolio_project_date', true).'</span></p></div>';
				}
				if(get_be_themes_portfolio_category_list($post->ID, true)) {
					$output .= '<div class="gallery-side-heading-wrap portfolio-category clearfix"><div class="gallery-cat-list-wrap">';
					$output .= '<h6 class="gallery-side-heading">'.__('Category', 'be-themes').'</h6>';
					$output .= '<p>'.get_be_themes_portfolio_category_list($post->ID, true).'</p>';
					$output .= '</div></div>';
				}
			}
			$output .= '<div class="gallery-side-heading-wrap portfolio-share clearfix"><h6 class="gallery-side-heading">'.__('Share This', 'be-themes').'</h6>';
			$output .= '<p>';
			$output .= be_get_share_button(get_permalink($post->ID), get_the_title($post->ID) , $post->ID);
			$output .= '</p></div>';
			if(get_post_meta($post->ID,'be_themes_portfolio_visitsite_url',true)) {
				if(!isset($be_themes_data['portfolio_visit_site_style']) || empty($be_themes_data['portfolio_visit_site_style'])) {
					$be_themes_data['portfolio_visit_site_style'] = 'style1';
				}				

				$output .= '<a href="'.get_post_meta($post->ID,'be_themes_portfolio_visitsite_url',true).'" class="mediumbtn be-button view-project-link '.$be_themes_data['portfolio_visit_site_style'].'-button" target="_blank">'.__('View Project', 'be-themes').'</a>';
			}
			$output .= '</div>';
			return $output;
		}

	}
	add_shortcode( 'project_details', 'be_project_details' );
}
/**************************************
			PRICING TABLE
**************************************/
if ( ! function_exists( 'be_pricing_column' ) ) {
	function be_pricing_column( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title'=>'',
			'h_tag'=>'h5',
			'price'=>'',
			'duration'=>'',
			'currency'=>'$',
			'button_text'=>'',
			'button_color'=> $be_themes_data['color_scheme'],
			'button_hover_color' => '',
			'button_bg_color' => '',
			'button_bg_hover_color' => '',
			'button_border_color' => $be_themes_data['color_scheme'],
			'button_border_hover_color' => '',
			'button_link'=>'',
			'highlight'=>'no',
			'style'=>'style-1',
			'header_bg_color' => $be_themes_data['color_scheme'],
			'header_color' => $be_themes_data['alt_bg_text_color'],
			'animate'=>0,
			'animation_type'=>'fadeIn',
	    ), $atts ) );

	    $output = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		if($style == 'style-2'){
			$header_bg_color = ( isset($header_bg_color) && !empty($header_bg_color) ? $header_bg_color : $be_themes_data['color_scheme'] );	
			$header_color =  ( isset($header_color) && !empty($header_color) ? $header_color : $be_themes_data['alt_bg_text_color'] );	
		}
		else{
			$header_bg_color = '';
			$header_color = '';
		}
		
		$output .= '<ul class="pricing-table sec-border highlight-'.$highlight.' '.$animate.'" data-animation="'.$animation_type.'">';
	    if( ! empty( $title ) ) {
	    	$output .= ( $style == 'style-1' ) ? '<li class="pricing-title" ><'.$h_tag.' class="sec-color">'.$title.'</'.$h_tag.'></li>' : '<li class="pricing-title" style="background-color:'.$header_bg_color.';"><'.$h_tag.' style="color:'.$header_color.'">'.$title.'</'.$h_tag.'></li>' ;
	    }
	    $output .= ( ! empty( $price ) ) ? '<li class="pricing-price"><h2 class="price">'.$price.'</h2><span class="currency">'.$currency.'</span><span class="pricing-duration special-subtitle">'.$duration.'</span></li>' : '' ; 
	    $output .= do_shortcode( $content );
		$output .= 	( !empty( $button_text ) && !empty( $button_link ) ) ? '<li class="pricing-button">'.do_shortcode('[button button_text= "'.$button_text.'" type= "medium" gradient= "1" rounded= "1" icon= "" bg_color ="'.$button_bg_color.'" hover_bg_color = "'.$button_bg_hover_color.'"  border_width= "1" border_color = "'.$button_border_color.'" hover_border_color = "'.$button_border_hover_color.'" color= "'.$button_color.'" hover_color= "'.$button_hover_color.'" url="'.$button_link.'" ]').'</li>' : '' ;
	    $output .= '</ul>';

	    return $output;

	}
	add_shortcode( 'pricing_column', 'be_pricing_column' );
}
if ( ! function_exists( 'be_pricing_feature' ) ) {
	function be_pricing_feature( $atts, $column ) {
		extract( shortcode_atts( array(
			'feature' => '',
			'highlight' => '',
			'highlight_color' => '',
			'highlight_text_color' => ''
		), $atts ) );
		$output = '';
		if( ! empty( $feature ) ) {
			if($highlight) {
				$highlight_section = 'highlight';
				$highlight_color = (!$highlight_color) ? '#e5e5e5' : $highlight_color ; 
			} else {
				$highlight_section = 'no-highlight';
				$highlight_color = '';
				$highlight_text_color = '';
			}
			$output .='<li class="pricing-feature '.$highlight_section.'" style="background : '.$highlight_color.'; color : '.$highlight_text_color.'">'.$feature.'</li>';
		}
		return $output;
	}
	add_shortcode( 'pricing_feature', 'be_pricing_feature' );
}
/**************************************
			SERVICES
**************************************/
if ( ! function_exists( 'be_services' ) ) {
	function be_services( $atts, $content ) {
		extract( shortcode_atts( array (
			'line_color' => '',
	    ),$atts ) );
		return '<div class="services-outer-wrap"><ul class="be-services">'.do_shortcode( $content ).'</ul><span class="timeline" style="background: '.$line_color.'"></span></div>';
	}
	add_shortcode( 'services', 'be_services' );
}
if ( ! function_exists( 'be_service' ) ) {
	function be_service( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => '',
			'icon_size' => 'small',
			'icon_bg_color' => '',
			'icon_hover_bg_color' => '',
			'icon_color' => '',
			'icon_hover_color' => '',
			'content_bg_color' => ''
	    ),$atts ) );
	    $icon_bg_color = (empty($icon_bg_color)) ? '#000' : $icon_bg_color ; 
		$icon_hover_bg_color = (empty($icon_hover_bg_color)) ? $icon_bg_color : $icon_hover_bg_color ; 
		$icon_color = (empty($icon_color)) ? '#fff' : $icon_color ; 
		$icon_hover_color = (empty($icon_hover_color)) ? $icon_color : $icon_hover_color ; 
		
		return '<li class="be-service"><div class="service-wrap" data-bg-color="'.$icon_bg_color.'" data-hover-bg-color="'.$icon_hover_bg_color.'" data-color="'.$icon_color.'" data-hover-color="'.$icon_hover_color.'"><i class="font-icon '.$icon.' icon-size-'.$icon_size.'" style="background: '.$icon_bg_color.';color: '.$icon_color.';"></i><div class="service-content" style="background-color:'.$content_bg_color.';">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div></div></li>';
	}
	add_shortcode( 'service', 'be_service' );
}
/**************************************
			SKILlS
**************************************/
if ( ! function_exists( 'be_skills' ) ) {
	function be_skills( $atts, $content ) {
		extract( shortcode_atts( array( 
			'direction' => 'horizontal',
			'height' => 400
		),$atts ) );
		global $container_style;
		global $direction_global;
		$direction = ( isset($direction) && !empty($direction) ) ? $direction : 'horizontal' ;
		$direction_global = $direction;
		$height = ( isset($height) && !empty($height) ) ? $height : 400 ;
		$container_style = ($direction == 'vertical') ? 'height: '.$height.'px;' : '';
		return '<div class="skill_container be-shortcode skill-'.$direction.'" '.$container_style.'><div class="skill clearfix">'.do_shortcode( $content ).'</div></div>';
	}
	add_shortcode( 'skills', 'be_skills' );
}
if ( ! function_exists( 'be_skill' ) ) {
	function be_skill( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title'=>'',
			'value'=>'',
			'fill_color'=>$be_themes_data['color_scheme'],
			'bg_color'=> '',
			'title_color'=> '',
		),$atts ) );
		global $container_style;
		global $direction_global;
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : '' ;
		$output = '<div class="skill-wrap">';
		if('horizontal' == $direction_global){
			$output .= '<span class="skill_name" '.$title_color.'>'.$title.'</span>';
			$output .= '<div class="skill-bar" style="background:'.$bg_color.'; '.$container_style.'"><span class="be-skill expand alt-bg alt-bg-text-color" data-skill-value="'.$value.'%" style="background:'.$fill_color.';"></span></div>';
		}
		if('vertical' == $direction_global){
			$output .= '<div class="skill-bar" style="background:'.$bg_color.'; '.$container_style.'"><span class="be-skill expand alt-bg alt-bg-text-color" data-skill-value="'.$value.'%" style="background:'.$fill_color.';"></span></div>';
			$output .= '<span class="skill_name" '.$title_color.'>'.$title.'</span>';
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'skill', 'be_skill' );
}
/**************************************
			LINEBREAK
**************************************/
if (!function_exists('be_linebreak')) {
	function be_linebreak( $atts ) {
		extract(shortcode_atts( array(
	        'height'=>'50',
	        'hide_mobile' => 0
	    ),$atts ) );
	    if(isset($hide_mobile) && $hide_mobile == 1) {
	    	$hide_mobile = 'hide-mobile';
	    } else {
	    	$hide_mobile = '';
	    }
		$output = '';
		$output .='<div class="linebreak '.$hide_mobile.'" style="height:'.$height.'px;"></div>';
		return $output;
	}
	add_shortcode( 'linebreak', 'be_linebreak' );
}
/**************************************
			SPECIAL TITLE 1
**************************************/
if (!function_exists('be_special_heading')) {
	function be_special_heading( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'title_align' => 'center',
			'title_content' => '',
			'h_tag' => 'h3',
			'title_color' => '',
			'subtitle_spl_font' => '',
			'disable_separator' => 0,
			'separator_style' => 'with-icon',
			'icon_name' => 'none',
			'default_icon' => 0,
			'icon_color' => $be_themes_data['color_scheme'] ,
			'separator_thickness' => '2' ,
			'separator_width' => '40' ,
			'separator_pos' => '0' ,
	        'separator_color' => '#323232',
			'scroll_to_animate'=> 0,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
	    $subtitle_spl_font = ( isset( $subtitle_spl_font ) && 1 == $subtitle_spl_font ) ? ' special-subtitle' : '';
	    $title_align = ( isset( $title_align ) && !empty($title_align) ) ? $title_align : 'cemter';
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : $scroll_to_animate ;
		$icon_name = ( isset( $default_icon ) && 1 == $default_icon ) ? 'icon-dimond' : $icon_name ;
		$icon_color = ( isset( $default_icon ) && 1 == $default_icon ) ? 'background-color:'.$icon_color : 'color:'.$icon_color ;
		
		if(! ( $disable_separator )){
			if('with-icon' == $separator_style){
				$separator_color =  'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';height:'.$separator_thickness.'px;width:'.($separator_width/2).'px;"';
				$sep_output = '<div class="sep-with-icon-wrap margin-bottom"><span class="sep-with-icon" '.$separator_color.' ></span><i class="sep-icon font-icon '.$icon_name.'" style="'.$icon_color.';"></i><span class="sep-with-icon" '.$separator_color.' ></span></div>';
			}
			if('no-icon' == $separator_style){
				$separator_color =  'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';height:'.$separator_thickness.'px;width:'.$separator_width.'px;"';
				$sep_output = '<hr class="separator margin-bottom " '.$separator_color.' />';
			}
		}
		else{
			$sep_output = '';
		}
		
		$output .='<div class="special-heading-wrap style1'.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'"><div class="special-heading align-'.$title_align.'">';
		$output .= ($title_content) ? '<'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'>' : '' ;
		if (isset($separator_pos) && 1 == $separator_pos) { //Place Divider Above Header
			$output .= $sep_output;
			$output .= ($content) ? '<div class="sub-title margin-bottom '.$subtitle_spl_font.'">'.$content.'</div>' : '' ;
		}
		else {
			$output .= ($content) ? '<div class="sub-title margin-bottom '.$subtitle_spl_font.'">'.$content.'</div>' : '' ;
			$output .= $sep_output;
		}
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading', 'be_special_heading' );
}
/**************************************
			SPECIAL TITLE 2
**************************************/
if (!function_exists('be_special_heading2')) {
	function be_special_heading2( $atts, $content ) {
		extract( shortcode_atts( array(
			'title_content' => '',
			'h_tag' => 'h3',
			'title_color' => '',
	        'border_color' => '',
	        'border_thickness' => '2',
	        'title_padding_vertical' => '20px',
	        'title_padding_horizontal' => '20px',
	        'padding_value' => 'px',
	        'title_alignment' => 'center',
			'scroll_to_animate'=> 0,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : $scroll_to_animate ;
		$output .='<div class="special-heading-wrap style2 align-'.$title_alignment.' '.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'"><div class="special-heading" style="border-width:'.$border_thickness.'px; border-color: '.$border_color.'; padding: '.$title_padding_vertical . $padding_value .' '. $title_padding_horizontal . $padding_value .' ;">';
		$output .= ($title_content) ? '<'.$h_tag.' class="special-h-tag" style="color: '.$title_color.';" >'.$title_content.'</'.$h_tag.'>' : '' ;
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading2', 'be_special_heading2' );
}
/**************************************
			SPECIAL TITLE 3
**************************************/
if (!function_exists('be_special_heading3')) {
	function be_special_heading3( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
			'h_tag' => 'h3',
	        'title_color' => '',
	        'sub_title1' => '',
	        'sub_title2' => '',
	        'top_caption_color' => '',
	        'bottom_caption_color' => '',
	        'top_caption_size' => '14',
	        'bottom_caption_size' => '14',
	        'top_caption_font' => 'h6',
	        'bottom_caption_font' => 'h6',
	        'top_caption_separator_color' => '',
	        'bottom_caption_separator_color' => '',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : '' ; 
		$top_caption_separator_color = ( ! empty( $top_caption_separator_color ) ) ? 'style="background-color:'.$top_caption_separator_color.';"' : '' ; 
		$bottom_caption_separator_color = ( ! empty($bottom_caption_separator_color) ) ? 'style="background-color:'.$bottom_caption_separator_color.';"' : '' ; 
		$top_caption_color = ( ! empty( $top_caption_color ) ) ? 'color:'.$top_caption_color.';' : '' ;
		$bottom_caption_color = ( ! empty( $bottom_caption_color ) ) ? 'color:'.$bottom_caption_color.';' : '' ;
		if ('body' == $top_caption_font){
			$top_caption_font_style = 'body-font';
		} elseif ('special' == $top_caption_font){
			$top_caption_font_style = 'special-subtitle';
		} else {
			$top_caption_font_style = '';
		}
		if ('body' == $bottom_caption_font) {
			$bottom_caption_font_style = 'body-font';
		} elseif ('special' == $bottom_caption_font){
			$bottom_caption_font_style = 'special-subtitle';
		} else {
			$bottom_caption_font_style = '';
		}

		$output .='<div class="special-heading-wrap style3'.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">';
		$output .= ($sub_title1) ? '<div class="caption-wrap"><h6 style="'.$top_caption_color.' font-size: '.$top_caption_size.'px;" class="caption '. $top_caption_font_style .'">'.$sub_title1.'<span class="caption-inner" '.$top_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='<div class="special-heading align-center"><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'></div>';
		$output .= ($sub_title2) ? '<div class="caption-wrap"><h6 style="'.$bottom_caption_color.' font-size: '.$bottom_caption_size.'px;" class="caption '. $bottom_caption_font_style .'">'.$sub_title2.'<span class="caption-inner" '.$bottom_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'special_heading3', 'be_special_heading3' );
}
/**************************************
			SPECIAL SUB TITLE 1
**************************************/
if (!function_exists('be_special_subtitle')) {
	function be_special_subtitle( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title_content' => '',
			'font_size' => '18',
			'title_color' => '',
	        'title_alignment' => 'center',
			'scroll_to_animate'=> 0,
			'max_width' => 100,
			'margin_bottom' => 30,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
	    $max_width = (isset($max_width) && !empty($max_width)) ? 'width: '.$max_width.'%' : '';
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : $scroll_to_animate ;
		$output .='<div class="special-subtitle-wrap '.$animate.' '.$scroll_to_animate.'" style="margin-bottom: '.$margin_bottom.'px;" data-animation="'.$animation_type.'"><div class="align-'.$title_alignment.'">';
		$output .= ($title_content) ? '<span class="special-subtitle" style="color: '.$title_color.'; font-size: '.$font_size.'px ; '.$max_width.'" >'.$title_content.'</span>' : '' ;
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_sub_title', 'be_special_subtitle' );
}
/**************************************
			TABS
**************************************/
if (!function_exists('be_tabs')) {
	function be_tabs( $atts, $content ) {
		$GLOBALS['tabs_cnt'] = 0;
		$tabs_cnt=0;
		$GLOBALS['tabs'] = array();
		$rand = rand();
		$content=do_shortcode( $content );
		if( is_array( $GLOBALS['tabs'] ) ) {
			foreach( $GLOBALS['tabs'] as $tab ) {
				extract($tab);
				$title_style = $content_style = '';
				$title_style .= ($title_color) ? 'color: '.$title_color.';' : '' ;				
				$tabs_cnt++;
				$class = ( ! empty($tab['icon']) && $tab['icon'] != 'none' ) ? "tab-icon ".$tab['icon'] : "" ;
				$tabs[] = '<li><a class="'.$class.'" href="#fragment-'.$tabs_cnt.'-'.$rand.'" style="'.$title_style.'">'.$tab['title'].'</a></li>';
				$panes[] = '<div id="fragment-'.$tabs_cnt.'-'.$rand.'" class="clearfix be-tab-content"><p>'.$tab['content'].'</p></div>';
			}
			$return = ($panes || $tabs) ? "\n".'<div class="tabs"><ul class="clearfix be-tab-header">'.implode( "\n", $tabs ).'</ul>'.implode( $panes ).'</div>'."\n" : '' ; 
		}
		return $return;
	}
	add_shortcode( 'tabs', 'be_tabs' );
}
if (!function_exists('be_tab')) {
	function be_tab( $atts, $content ){
		extract(shortcode_atts( array(
	        'icon' => '',
	        'title' => '',
			'title_color' => '',
	    ),$atts ) );
		$content= do_shortcode($content);
		$x = $GLOBALS['tabs_cnt'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tabs_cnt'] ), 'content' =>  $content, 'icon'=> $icon, 'title_color'=> $title_color );
		$GLOBALS['tabs_cnt']++;
	}
	add_shortcode( 'tab', 'be_tab' );
}
/**************************************
			TITLE WITH ICON
**************************************/
if ( ! function_exists( 'be_title_icon' ) ) {
	function be_title_icon($atts,$content) {
		global $be_themes_data;
		extract(shortcode_atts(array(
			'icon'=>'none',
			'size' => 'small',
			'alignment'=>'left',	
			'style'=>'circled',
			'icon_bg'=> '',
			'icon_color'=> '',
			'icon_border_color'=> '',
			'animate'=> 0,
			'animation_type'=>'fadeIn',
		),$atts));
		$output ='';
		$background_color = ( $style == 'circled' || $style == 'rounded' ) ? 'background-color:'.$icon_bg.';' : '' ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
		$output .= '<i class="'.$icon.' title-icon '.$style.' '.$size.' '.$animate.' align-'.$alignment.'" style="'.$background_color.'color:'.$icon_color.';border-color: '.$icon_border_color.'" data-animation="'.$animation_type.'"></i>';
		$output .= '<div class="title-with-icon '.$animate.' '.$size.' '.$style.' align-'.$alignment.'" data-animation="'.$animation_type.'">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';    		
		
		return $output; 
	}
	add_shortcode('title_icon','be_title_icon');
}
/**************************************
			VIDEO - YOUTUBE
**************************************/
if (!function_exists('be_video')) {
	function be_video( $atts, $content ) {
		extract(shortcode_atts( array(
			'source'=>'youtube',
	        'url'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
	    switch ( $source ) {
	    	case 'youtube':
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ;
				$output .= be_youtube( $url );
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    	default:
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ; 
				$output .= be_vimeo( $url );
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    }
	}
	add_shortcode( 'video', 'be_video' );
}
if (!function_exists('be_youtube')) {
	function be_youtube( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) ? $match[1] : '' ;
			
			return '<iframe class="youtube" id="be-vimeo-'.$video_id.'" src="https://youtube.com/embed/'.$video_id.'?rel=0&wmode=transparent" style="border: none;" allowfullscreen></iframe>';		
		} else {
			return '';
		}

	}
}

/**************************************
			VIDEO - VIMEO
**************************************/
if (!function_exists('be_vimeo')) {
	function be_vimeo( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
			return '<iframe src="https://player.vimeo.com/video/'.$video_id.'?api=1" id="be-vimeo-'.$video_id.'" class="be-vimeo-video" width="500" height="281" style="border: none;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		} else {
			return '';
		}
	}
}
/**************************************
			ROTATES
**************************************/
if ( ! function_exists( 'be_rotates' ) ) {
	function be_rotates( $atts, $content ) {
		extract( shortcode_atts( array (
			'animation' => 'fade',
			'speed' => 1000,
	    ),$atts ) );
	    $animation = (empty($animation)) ? 'fade' : $animation ; 
		$speed = (empty($speed)) ? 1000 : $speed ;  
		
		return '<span class="rotates" data-animation="'.$animation.'" data-speed="'.$speed.'" >'.do_shortcode( $content ).'</span>';
	}
	add_shortcode( 'rotates', 'be_rotates' );
}
if ( ! function_exists( 'be_rotate' ) ) {
	function be_rotate( $atts, $content ) {
		extract( shortcode_atts( array (
			'rotate_text' => '',
	    ),$atts ) );
		return ' '.$content.'||';
	}
	add_shortcode( 'rotate', 'be_rotate' );
}
/**************************************
			ANIMATED TEXT
**************************************/
if ( ! function_exists( 'be_animate_typed' ) ) {
	function be_animate_typed( $atts, $content ) {
		return '<span class="typed">'.do_shortcode( $content ).'</span>';
	}
	add_shortcode( 'typed', 'be_animate_typed' );
}
if ( ! function_exists( 'be_animate_type' ) ) {
	function be_animate_type( $atts, $content ) {
		extract( shortcode_atts( array (
			'rotate_text' => '',
	    ),$atts ) );
		return ' '.$content.'||';
	}
	add_shortcode( 'type', 'be_animate_type' );
}
/**************************************
		Contact Form
**************************************/
if ( ! function_exists( 'be_contact_form' ) ) {
	function be_contact_form($atts,$content) {
		extract( shortcode_atts( array (
			'input_bg_color' => '',
			'input_color' => '',
		    'input_border_color' => '',
		    'border_width' => '',
		    'input_height' => '',
		    'input_style' => 'style1',
		    'input_button_style' => 'medium',
		    'bg_color' => '',
		    'color' => '',
	    ), $atts ) );
		$output = '';
		$styles = 'style="';
		$styles .= ( isset( $input_bg_color ) && !empty( $input_bg_color) ) ? 'background-color: '.$input_bg_color.';' : 'background-color: transparent;';
		$styles .= ( isset( $input_color ) && !empty( $input_color) ) ? 'color: '.$input_color.';' : '';
		$styles .= ( isset( $border_width ) ) ? 'border-width: '.$border_width.'px; border-style: solid;' : '';
		$styles .= ( isset( $input_border_color ) && !empty( $input_border_color) ) ? 'border-color: '.$input_border_color.';' : '';

		$styles_height = ( isset( $input_height ) && !empty( $input_height) ) ? 'height: '.$input_height.'px;' : '';
		$button_styles = 'style="';
		$button_styles .= ( isset( $bg_color ) && !empty( $bg_color) ) ? 'background-color: '.$bg_color.';' : '';
		$button_styles .= ( isset( $color ) && !empty( $color) ) ? 'color: '.$color.';' : '';
		$button_styles .= '"';
		$input_style = ( isset( $input_style ) && !empty( $input_style) ) ? $input_style : 'style1';
		$input_button_style = ( isset( $input_button_style ) && !empty( $input_button_style) ) ? $input_button_style : 'medium';
		$output .= '<div class="contact_form contact_form_module '.$input_style.'-input">
						<form method="post" class="contact">
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_name" class="txt autoclear" placeholder="'.__('Name','be-themes').'" '.$styles.' '.$styles_height.'" />
							</fieldset>
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_email" class="txt autoclear" placeholder="'.__('Email','be-themes').'" '.$styles.' '.$styles_height.'" />
							</fieldset>
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_subject" class="txt autoclear" placeholder="'.__('Subject','be-themes').'" '.$styles.' '.$styles_height.'" />
							</fieldset>
							<fieldset class="contact_fieldset">
								<textarea name="contact_comment" class="txt_area autoclear" placeholder="'.__('Message','be-themes').'" '.$styles.'" ></textarea>
							</fieldset>
							<fieldset class="contact_fieldset submit-fieldset">
								<input type="submit" name="contact_submit" value="'.__('Submit','be-themes').'" class="contact_submit be-shortcode '.$input_button_style.'btn be-button rounded" '.$button_styles.'/>
								<div class="contact_loader"><div class="font-icon loader-style4-wrap loader-icon"></div></div>
							</fieldset>
							<div class="contact_status be-notification"></div>
						</form>
					</div>';
		return $output; 
	}
	add_shortcode('contact_form','be_contact_form');
}
/**************************************
			TWEET
**************************************/
if (!function_exists('be_tweet')) {
	function be_tweet( $atts, $content ) {
		extract( shortcode_atts( array (
			'account_name' => '',
			'count' => 5,
			'color' => '',
			'content_size' => '12',
			'tweet_bird_color' => '',
			'alignment' => 'center',
			'autoplay' => '0',
			'pagination' => 0,
			'animate' => 0,
			'animation_type' =>'slide-up',
		), $atts ) );
		$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '';
		$alignment = (isset( $alignment ) && !empty( $alignment )) ? $alignment : 'center';
		$color = (!isset($color) || empty($color)) ? '' : $color;
		$tweet_bird_color = (!isset($tweet_bird_color) || empty($tweet_bird_color)) ? '' : $tweet_bird_color;
		$pagination = (empty($pagination) || (!empty($pagination) && $pagination == 0)) ? '0' : '1' ; 
		$output = '';
		if($account_name) {
			$query = 'count='.$count.'&include_entities=true&include_rts=true&screen_name='.$account_name;
			$tweets = be_get_tweets( $query );
			if( $tweets ) {
				$output .= '<div class="tweet-slides ' .$animate.'" data-animation="'.$animation_type.'" ><ul class="twitter_module slides '.$alignment.'-content" data-autoplay="'.$autoplay.'" data-pagination="'.$pagination.'">';
				foreach($tweets as $tweet) {
					$output .= '<li class="tweet_list"><div class="testimonial_slide_inner"><i class="font-icon icon-twitter" style="color: '.$tweet_bird_color.'"></i><span class="tweet-content status" style="font-size: '.$content_size.'px; color: '.$color.'">';
					$output .= be_tweet_format($tweet);
					$output .= '</div></li>';
				}
				$output .= '</ul></div>';
			}
		}
		return $output;
	}
	add_shortcode( 'tweets', 'be_tweet' );
}
/**************************************
			TEAM
**************************************/
if ( ! function_exists( 'be_team' ) ) {
	function be_team( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title'=>'',
			'h_tag'=>'h6',
			'description'=>'',
			'designation'=>'',
			'image'=>'',
			'title_color'=> '',
			'description_color'=> '',
			'designation_color'=> '',			
			'facebook'=>'',
			'twitter'=>'',
			'dribbble'=>'',
			'google_plus'=>'',
			'linkedin'=>'',
			'youtube'=>'',
			'vimeo'=>'',
			'email'=> '',
			'icon_color'=> '',
			'icon_hover_color'=> '',
			'icon_bg_color'=> '',
			'icon_hover_bg_color'=> '',
			'hover_style' => 'style1-hover',
			'title_style' => 'style3',
			'smedia_icon_position' => 'over',
			'title_alignment_static' => '',
			'default_image_style' => 'color',
			'hover_image_style' => 'color',
			'image_effect' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85',
			'overlay_transparent' => 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
		),$atts ) );

		$output = '';
		$url = wp_get_attachment_image_src( $image, 'portfolio-masonry' );
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : $animate ;
		$style = 'style="';
		if( isset($icon_color) && !empty($icon_color) ) {
			$style .= 'color: '.$icon_color.';';
			$icon_default_color = 'data-color="'.$icon_color.'"';
		} else {
			$icon_default_color = 'data-color="inherit"';
			$icon_color = 'inherit';
		}
		if( isset($icon_bg_color) && !empty($icon_bg_color) ) {
			$style .= 'background-color: '.$icon_bg_color.';';
			$icon_default_bg_color = 'data-bg-color="'.$icon_bg_color.'"';
		} else {
			$icon_default_bg_color = 'data-bg-color="transparent"';
			$icon_bg_color = 'transparent';
		}
		$style .= '"';
		$hover_style = ((!isset($hover_style)) || empty($hover_style)) ? 'style1-hover' : $hover_style;
		$title_style = ((!isset($title_style)) || empty($title_style)) ? 'style3' : $title_style;
		$icon_hover_color = ( isset($icon_hover_color) && !empty($icon_hover_color) ) ? 'data-hover-color="'.$icon_hover_color.'"' : 'data-hover-color="'.$icon_color.'"' ;
		$icon_hover_bg_color = ( isset($icon_hover_bg_color) && !empty($icon_hover_bg_color) ) ? 'data-hover-bg-color="'.$icon_hover_bg_color.'"' : 'data-hover-bg-color="'.$icon_bg_color.'"' ;
		$designation_color = ( isset($designation_color) && !empty($designation_color) ) ? 'style="color: '.$designation_color.'"' : '' ;
		$description_color = ( isset($description_color) && !empty($description_color) ) ? 'style="color: '.$description_color.'"' : '' ;
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : $title_color ;
		$image_effect = ((!isset($image_effect)) || empty($image_effect)) ? 'none' : $image_effect;
		$smedia_icon_position = ($title_style == 'style3') ? 'over' : $smedia_icon_position;
		if($default_image_style == 'black_white') {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'bw_to_bw';
			} else {
				$img_grayscale = 'bw_to_c';
			}
		} else {
			if($hover_image_style == 'black_white') {
				$img_grayscale = 'c_to_bw';
			} else {
				$img_grayscale = 'c_to_c';
			}
		}
		$thumb_overlay_color = '';
		if(isset($overlay_color) && !empty($overlay_color)) {
			$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
		}
		$thumb_overlay_color = ( isset( $overlay_transparent ) && 1 == $overlay_transparent ) ? 'transparent' : $thumb_overlay_color ;
		$thumb_img_overlay = ($title_style == 'style3') ? 'style="background: '.$thumb_overlay_color.'"' : '' ;
		$icon_overlay_bg = ($smedia_icon_position == 'over' && $title_style != 'style3') ? 'style="background: '.$thumb_overlay_color.'"' : '';
		$icon = '';
		if( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $dribbble ) || ! empty( $google_plus ) || ! empty( $linkedin ) || ! empty( $youtube ) || ! empty( $vimeo ) || ! empty( $email )){
			$icon ='<ul class="team-social clearfix '.$smedia_icon_position.'" '.$icon_overlay_bg.'>';
			$icon .= ( ! empty( $facebook ) ) ? '<li class="icon-shortcode"><a href="'.$facebook.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-facebook"></i></a></li>' : '' ;
			$icon .= ( ! empty( $twitter ) ) ? '<li class="icon-shortcode"><a href="'.$twitter.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-twitter"></i></a></li>' : '' ;
			$icon .= ( ! empty( $google_plus ) ) ? '<li class="icon-shortcode"><a href="'.$google_plus.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-gplus"></i></a></li>' : '' ;
			$icon .= ( ! empty( $linkedin ) ) ? '<li class="icon-shortcode"><a href="'.$linkedin.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-linkedin"></i></a></li>' : '' ;
			$icon .= ( ! empty( $youtube ) ) ? '<li class="icon-shortcode"><a href="'.$youtube.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-youtube"></i></a></li>' : '' ;
			$icon .= ( ! empty( $dribbble ) ) ? '<li class="icon-shortcode"><a href="'.$dribbble.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-dribbble"></i></a></li>' : '';
			$icon .= ( ! empty( $vimeo ) ) ? '<li class="icon-shortcode"><a href="'.$vimeo.'" class="font-icon team_icons" target="_blank" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-vimeo"></i></a></li>' : '';				
			$icon .= ( ! empty( $email ) ) ? '<li class="icon-shortcode"><a href="mailto:'.$email.'" class="font-icon team_icons" target="_top" '.$icon_default_bg_color.' '.$icon_default_color.' '.$icon_hover_color.' '.$icon_hover_bg_color.' '.$style.'><i class="icon-email"></i></a></li>' : '';				
			$icon .='</ul>';
		}
		if($title_style == 'style5') {
			$hover_style = '';
		}
		if(isset($title_alignment_static) && !empty($title_alignment_static) && ($title_style == 'style5')) {
			$title_alignment_static = 'text-align: '.$title_alignment_static.';';
		} else {
			$title_alignment_static = '';
		}
		$output .= '<div class="team-shortcode-wrap '.$animate.'" data-animation="'.$animation_type.'">';
			$output .= '<div class="element '.$hover_style.' '.$img_grayscale.' '.$title_style.'-title">';
				$output .= '<div class="element-inner">';
					$output .= '<div class="flip-wrap">';
						$output .= '<div class="flip-img-wrap '.$image_effect.'-effect">';
							$output .= '<img src="'.$url[0].'" alt="'.$title.'" />';
							if($smedia_icon_position == 'over' && $title_style != 'style3') {
								$output .= $icon;
							}
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="thumb-overlay">';
						$output .= '<div class="thumb-bg" '.$thumb_img_overlay.'>';
							$output .= '<div class="display-table"><div class="display-table-cell vertical-align-middle">';
								$output .= '<div class="team-wrap clearfix" style="'.$title_alignment_static.'">';
									$output .= '<'.$h_tag.' class="team-title" '.$title_color.'>'.$title.'</'.$h_tag.'>';
									$output .= '<p class="designation" '.$designation_color.'>'.$designation.'</p>';
									$output .= '<p class="team-description" '.$description_color.'>'.$description.'</p>';
									if($smedia_icon_position == 'below' || $title_style == 'style3') {
										$output .= $icon;
									}
								$output .= '</div>';
							$output .= '</div></div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';			
		return $output;		
	}
	add_shortcode( 'team', 'be_team' );
}
/**************************************
			TESTIMONIALS
**************************************/
if (!function_exists('be_testimonials')) {	
	function be_testimonials( $atts, $content ){
		global $be_themes_data;
		extract( shortcode_atts( array (
			'testimonial_font_size' => '14',
			'author_role_font' => 'body',
			'alignment' => 'center',
			'slide_animation_type' => 'slide',
			'slide_show' => 'no',
			'slide_show_speed' => 4000,
			'animate' => 0,
			'pagination' => 0,
			'animation_type' => 'fadeIn',
		), $atts ) );
		$GLOBALS['testimonial_font_size_global'] = 	$testimonial_font_size;
		$GLOBALS['author_role_font_global'] = $author_role_font;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$slide_animation_type = ( isset( $slide_animation_type ) && !empty($slide_animation_type) ) ? $slide_animation_type : 'slide' ;
		$slide_show = ( isset( $slide_show ) && !empty($slide_show) && $slide_show == 'yes' ) ? 1 : 0 ;
		$slide_show_speed = ( isset( $slide_show_speed ) && !empty($slide_show_speed) ) ? $slide_show_speed : 4000 ;
		$alignment = (isset( $alignment ) && !empty( $alignment )) ? $alignment : 'center';
		$pagination = (empty($pagination) || (!empty($pagination) && $pagination == 0)) ? '0' : '1' ; 
		$return = '<div class="testimonials_wrap '.$animate.'" data-animation="'.$animation_type.'" ><div class="testimonials-slides"><div class="clearfix testimonial_module slides '.$alignment.'-content" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'" data-slide-animation-type="'.$slide_animation_type.'" data-pagination="'.$pagination.'">'.do_shortcode( $content ).'</div></div></div>';		
		return $return;	
	}	
	add_shortcode( 'testimonials', 'be_testimonials' );
}
if (!function_exists('be_testimonial')) {	
	function be_testimonial( $atts, $content ) {
		extract( shortcode_atts( array (
			'author_image' => '',
			'quote_color'=> '',
			'author' => '',
			'author_color'=> '',
			'author_role' => '',
			'author_role_color' => ''
		), $atts ) );
		$content= do_shortcode($content);		
		extract($atts);
		if(isset($GLOBALS['author_role_font_global'])) {
			if ('h6' == $GLOBALS['author_role_font_global']){
				$author_role_font_style = 'h6-font';
			} elseif ('special' == $GLOBALS['author_role_font_global']){
				$author_role_font_style = 'special-subtitle';
			} else {
				$author_role_font_style = '';
			}
		} else {
			$author_role_font_style = '';
		}
		if(isset($GLOBALS['testimonial_font_size_global'])) {
			$global_testimonial_font_size = $GLOBALS['testimonial_font_size_global'];
		} else {
			$global_testimonial_font_size = '';
		}
		$output = '';
		$quote_color = (isset( $quote_color ) && !empty( $quote_color )) ? 'style="color:'.$quote_color.';"' : '';
		$author_color = (isset( $author_color ) && !empty( $author_color )) ? 'style="color:'.$author_color.';"' : '';
		$author = (isset( $author ) && !empty( $author )) ? '<h6 class="testimonial-author" '.$author_color.'>'.$author.'</h6>' : '';
		$author_role_color = (isset( $author_role_color ) && !empty( $author_role_color )) ? 'style="color:'.$author_role_color.';"' : '';
		$author_role = (isset( $author_role ) && !empty( $author_role )) ? '<div class="testimonial-author-role '.$author_role_font_style.'"  '.$author_role_color.'>'.$author_role.'</div>' : '';
		if (isset( $author_image ) && !empty( $author_image )) {
			$attachment_info = wp_get_attachment_image_src( $author_image, 'thumbnail' );
			$attachment_url = $attachment_info[0];
			$author_image =  '<div class="testimonial-author-img"><img src="'.$attachment_url.'" alt="" /></div>';
		}
		$output .= '<div class="testimonial_slide slide clearfix"><div class="testimonial_slide_inner">';
		$output .= '<i class="font-icon icon-quote" '.$quote_color.'></i>';
		$output .= '<p style= "font-size: '.$global_testimonial_font_size.'px;" class="testimonial-content">'.$content.'</p>';
		$output .= '<div class="testimonial-author-info-wrap clearfix">';
		$output .= $author_image;
		$output .= '<div class="testimonial-author-info">';
		$output .= $author;
		$output .= $author_role;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div></div>';
		return $output;
	}	
	add_shortcode( 'testimonial', 'be_testimonial' );
}
/**************************************
			CONTENT SLIDER
**************************************/
if (!function_exists('be_content_slides')) {	
	function be_content_slides( $atts, $content ){
		global $be_themes_data;
		extract( shortcode_atts( array (
			'slide_animation_type' => 'slide',
			'slide_show' => 'yes',
			'slide_show_speed' => 4000,
			'content_max_width' => 100,
			'bullets_color' => '',
			'animate' => 0,
			'animation_type' => 'fadeIn',
		), $atts ) );
		$GLOBALS['content_max_width'] = $content_max_width ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$slide_animation_type = ( isset( $slide_animation_type ) && !empty($slide_animation_type) ) ? $slide_animation_type : 'slide' ;
		$slide_show = ( isset( $slide_show ) && !empty($slide_show) && $slide_show == 'yes' ) ? 1 : 0 ;
		$slide_show_speed = ( isset( $slide_show_speed ) && !empty($slide_show_speed) ) ? $slide_show_speed : 4000 ;
		$bullets_color = ( isset( $bullets_color ) && !empty($bullets_color) ) ? $bullets_color : '#000' ;
		$return = '<div class="'.$animate.' content-slide-wrap" data-animation="'.$animation_type.'" ><div class=" content-slider clearfix"><ul class="clearfix slides content_slider_module clearfix" data-slide-show="'.$slide_show.'" data-slide-show-speed="'.$slide_show_speed.'" data-slide-animation-type="'.$slide_animation_type.'">'.do_shortcode( $content ).'</ul></div></div>';
		return $return;	
	}	
	add_shortcode( 'content_slides', 'be_content_slides' );
}
if (!function_exists('be_content_slide')) {	
	function be_content_slide( $atts, $content ) {
		$content = do_shortcode($content);
		$content_max_width = ( isset( $GLOBALS['content_max_width'] ) && !empty( $GLOBALS['content_max_width'] ) ) ? $GLOBALS['content_max_width'] : 100;
		$output = '';
		$output .= '<li class="content_slide slide clearfix"><div class="content_slide_inner" style="width: '.$content_max_width.'%">';
		$output .= '<div class="content-slide-content">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
		$output .= '</div></li>';
		return $output;
	}	
	add_shortcode( 'content_slide', 'be_content_slide' );
}
/**************************************
			CUSTOM SLIDER
**************************************/
if (!function_exists('be_custom_slider')) {
	function be_custom_slider( $atts, $content ) {
		extract( shortcode_atts( array (
				'animation_type' => 'fxSoftScale',
				'slider_height' => '',
				'slider_mobile_height' => '',
				'load' => 'yes',
	    	), $atts ) );
		$load = ( isset( $load ) && !empty( $load ) && $load == 'no' ) ? 'no-load' : 'loaded';
		$slider_height_style = ( isset( $slider_height ) && !empty( $slider_height ) ) ? 'style="height: '.$slider_height.'px;"' : 'style="height: 100%;"';
		$slider_height = ( isset( $slider_height ) && !empty( $slider_height ) ) ? $slider_height : '100%';
		$slider_mobile_height = ( isset( $slider_mobile_height ) && !empty( $slider_mobile_height ) ) ? $slider_mobile_height : $slider_height;
	    $output = "";
	    $output .= '<div class="component component-fullwidth '.$load.' '.$animation_type.'" data-height="'.$slider_height.'" data-mobile-height="'.$slider_mobile_height.'" data-current="0" '.$slider_height_style.'>';
	    $output .= '<ul class="itemwrap">';
		$output .= do_shortcode( $content );
	    $output .= '</ul>';
	    $output .= '<nav class="component-nav">';
		$output .= '<a class="prev be-slider-prev" href="#"><i class="font-icon icon-arrow_carrot-left"></i></a>';
		$output .= '<a class="next be-slider-next" href="#"><i class="font-icon icon-arrow_carrot-right"></i></a>';
		$output .= '</nav>';
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'be_slider', 'be_custom_slider' );
}
if (!function_exists('be_custom_slide')) {
	function be_custom_slide( $atts, $content ){
			extract( shortcode_atts( array (
				'image' => '',
				'bg_video' => 0,
		        'bg_video_mp4_src' => '',
		        'bg_video_mp4_src_ogg' => '',
		        'bg_video_mp4_src_webm' => '',
		        'content_width' => '',
		        'left' => '',
		        'right' => '',
		        'top' => '',
		        'bottom' => '',
	        	'content_animation_type'=>'fadeIn',
	    	), $atts ) );
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
	    	$bg_video_slide = ( isset( $bg_video ) && 1 == $bg_video ) ? ' be-slider-video' : '' ;
			$output = '';
	    	$output .= '<li>';
			if ( !empty( $image ) || $bg_video ) {
				$attachment_info = wp_get_attachment_image_src( $image, 'full' );
				$attachment_url = $attachment_info[0];
				$output .=  '<div class="be-slide-bg-holder">
								<div class="be-slide-bg be-bg-cover be-bg-parallax '.$bg_video_slide.'" data-image="'.$attachment_url.'">';
									if( isset( $bg_video ) && 1 == $bg_video ) {
										$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
										$output .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
										$output .=  ($bg_video_mp4_src_ogg) ? '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">' : '' ;
										$output .=  ($bg_video_mp4_src_webm) ? '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">' : '' ;
										$output .= '</video>';
									} else {
										$output .= '<i class="font-icon loader-style4-wrap loader-icon"></i>';
									}
									if(!empty($left) || ($left == '0') || !empty($right) || ($right == '0') || !empty($top) || ($top == '0') || !empty($bottom) || ($bottom == '0')) {
										$style = 'margin: 0px;';
										if(!empty($left) || ($left == '0')) {
											$style .= 'left: '.$left.'%;';
										}
										if(!empty($right) || ($right == '0')) {
											$style .= 'right: '.$right.'%;';
										}
										if(!empty($top) || ($top == '0')) {
											$style .= 'top: '.$top.'%;';
										}
										if(!empty($bottom) || ($bottom == '0')) {
											$style .= 'bottom: '.$bottom.'%;';
										}
										if(!empty($top) || ($top == '0') || !empty($bottom) || ($bottom == '0')) {
											$style .= 'position: absolute;';
										} else {
											$style .= 'position: relative;';
											if(!empty($right) || ($right == '0')) {
												$style .= 'float: right;';
											} else {
												$style .= 'float: none;';
											}
										}
									} else {
										$style = '';
									}
								$output .=  '</div>
								<div class="be-wrap">
									<div class="be-slider-content-wrap">
										<div class="be-slider-content clearfix">
											<div class="be-slider-content-inner-wrap" style="width: '.$content_width.'%;'.$style.'">';
											if( $content ) {
												$output .=  '<div class="be-animate '.$content_animation_type.' animated be-slider-content-inner">'.do_shortcode( $content ).'</div>';
											}
											$output .=  '</div>
										</div>
									</div>
								</div>
							</div>';
			}
	        $output .='</li>';
	        return $output;
	}
	add_shortcode( 'be_slide', 'be_custom_slide' );
}
/**************************************
			Animated Box Style1
**************************************/
if ( ! function_exists( 'be_animate_icons_style1' ) ) {
	function be_animate_icons_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'height' => '300',
			'gutter' => '',
	    ),$atts ) );
	    $height = ( isset( $height ) && !empty( $height ) ) ? $height : 300 ;
	    $gutter = ( isset( $gutter ) && !empty( $gutter ) && $gutter != '0' ) ? $gutter : '0' ;
		$output = '';
		$output .= '<div class="display-block"><div class="animate-icon-module-style1-wrap-container"><div class="animate-icon-module-style1-wrap clearfix" style="height: '.$height.'px;" data-gutter-width="'.$gutter.'">'.do_shortcode($content).'</div></div></div>';
		return $output;
	}
	add_shortcode( 'animate_icons_style1', 'be_animate_icons_style1' );
}
if ( ! function_exists( 'be_animate_icon_style1' ) ) {
	function be_animate_icon_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => 'none',
			'size' => 30,
			'icon_color' => '',
			'link_to_url' => '',
			'height' => '',
			'bg_image' => '',
			'bg_color' => '',
			'hover_bg_color' => '',
			'bg_overlay' => 0,
			'overlay_color' => '',
			'overlay_opacity' => '',
			'hover_overlay_color' => '',
			'hover_overlay_opacity' => '',
			'animate_direction' => 'top'
	    ),$atts ) );
		$link_to_url = ( isset( $link_to_url ) && !empty( $link_to_url ) ) ? $link_to_url : '#' ;
	    $bg_color = ( isset( $bg_color ) && !empty( $bg_color ) ) ? $bg_color : 'transparent' ;
	    $hover_bg_color = ( isset( $hover_bg_color ) && !empty( $hover_bg_color ) ) ? $hover_bg_color : $bg_color ;
	    $animate_direction = ( isset( $animate_direction ) && !empty( $animate_direction ) ) ? $animate_direction : 'top';
	    $bg_overlay_class = ( isset( $bg_overlay ) && 1 == $bg_overlay ) ? 'be-bg-overlay' : '' ;
	    if( isset( $bg_image ) && !empty( $bg_image ) ) {
	    	$attachment_info = wp_get_attachment_image_src( $bg_image, 'full' );
			$attachment_url = $attachment_info[0];
	    	$bg_image = 'background: url('.$attachment_url.') no-repeat center center;';
	    } else {
	    	$bg_image = '';
	    }
	    $output = '';
	    $output .= '<a href="'.$link_to_url.'" class="animate-icon-module-style1 be-bg-cover animate-icon-module '.$bg_overlay_class.' '.$animate_direction.'-animate" data-bg-color="'.$bg_color.'" data-hover-bg-color="'.$hover_bg_color.'" style="background-color: '.$bg_color.'; '.$bg_image.'">';
		$output .= '<div class="animate-icon-module-normal-content"><div class="display-table"><div class="display-table-cell vertical-align-middle"><i class="font-icon '.$icon.'" style="font-size: '.$size.'px;color: '.$icon_color.';"></i></div></div></div>';
		$output .= '<div class="animate-icon-module-hover-content"><div class="display-table"><div class="display-table-cell vertical-align-middle">'.$content.'</div></div></div>';
		if( isset( $bg_overlay ) && 1 == $bg_overlay && isset( $bg_image ) && !empty( $bg_image ) ) {
			$opacity = '';
			if(isset($overlay_color) && !empty( $overlay_color )) {
				$global_overlay_color = $overlay_color = be_themes_hexa_to_rgb( $overlay_color );
			} else {
				$global_overlay_color = $overlay_color = be_themes_hexa_to_rgb( '#000000' );
				$overlay_opacity = 0;
			}
			$overlay_opacity = (isset($overlay_opacity)) ? $overlay_opacity : '80';
			$overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].', '.floatval($overlay_opacity/100).')';
			$hover_overlay_color = (isset($hover_overlay_color) && !empty( $hover_overlay_color )) ?  be_themes_hexa_to_rgb( $hover_overlay_color ) : $global_overlay_color;
			$hover_overlay_opacity = (isset($hover_overlay_opacity)) ? $hover_overlay_opacity : $overlay_opacity;
			$hover_overlay_color = 'rgba('.$hover_overlay_color[0].','.$hover_overlay_color[1].','.$hover_overlay_color[2].', '.floatval($hover_overlay_opacity/100).')';
			$output .= '<div class="section-overlay" style="background: '.$overlay_color.';" data-default-bg-color="'.$overlay_color.'" data-hover-bg-color="'.$hover_overlay_color.'"></div>';
		}
		$output .= '</a>';
		return $output;
	}
	add_shortcode( 'animate_icon_style1', 'be_animate_icon_style1' );
}
/**************************************
			Animated Box Style2
**************************************/
if ( ! function_exists( 'be_animate_icons_style2' ) ) {
	function be_animate_icons_style2( $atts, $content ) {
		$output = '';
		$output .= '<div class="animate-icon-module-style2-wrap clearfix">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
		return $output;
	}
	add_shortcode( 'animate_icons_style2', 'be_animate_icons_style2' );
}
if ( ! function_exists( 'be_animate_icon_style2' ) ) {
	function be_animate_icon_style2( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => 'none',
			'size' => 30,
			'icon_color' => '',
			'icon_color_hover_state' => '',
			'title' => '',
			'h_tag' => 'h6',
			'title_color' => '',
			'title_color_hover_state' => '',
			'bg_color' => '',
			'hover_bg_color' => '',
	    ),$atts ) );
	    $h_tag = ( isset( $h_tag ) && !empty( $h_tag ) ) ? $h_tag : 'h6';
	    $icon_color = ( isset( $icon_color ) && !empty( $icon_color ) ) ? $icon_color : 'initial' ;
	    $icon_color_hover_state = ( isset( $icon_color_hover_state ) && !empty( $icon_color_hover_state ) ) ? $icon_color_hover_state : $icon_color ;
	    $title_color = ( isset( $title_color ) && !empty( $title_color ) ) ? $title_color : 'initial' ;
	    $title_color_hover_state = ( isset( $title_color_hover_state ) && !empty( $title_color_hover_state ) ) ? $title_color_hover_state : $title_color ;
	    $title = ( isset( $title ) && !empty( $title ) ) ? '<'.$h_tag.' class="animate-icon-title" style="color: '.$title_color.'; ">'.$title.'</'.$h_tag.'>' : '';
	    $bg_color = ( isset( $bg_color ) && !empty( $bg_color ) ) ? $bg_color : 'transparent' ;
	    $hover_bg_color = ( isset( $hover_bg_color ) && !empty( $hover_bg_color ) ) ? $hover_bg_color : $bg_color ;
	    $output = '';
	    $output .= '<div class="animate-icon-module-style2" data-bg-color="'.$bg_color.'" data-hover-bg-color="'.$hover_bg_color.'" data-title-color="'.$title_color.'" data-hover-title-color="'.$title_color_hover_state.'" data-icon-color="'.$icon_color.'" data-hover-icon-color="'.$icon_color_hover_state.'" style="background-color: '.$bg_color.';">';
	    $output .= '<div class="animate-icon-module-style2-inner-wrap">';
		$output .= '<div class="animate-icon-module-style2-normal-content clearfix"><i class="animate-icon-icon font-icon '.$icon.'" style="font-size: '.$size.'px;color: '.$icon_color.';"></i>'.$title.'</div>';
		$output .= '<div class="animate-icon-module-style2-hover-content clearfix">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode( 'animate_icon_style2', 'be_animate_icon_style2' );
}
/**************************************
			RECENT POSTS
**************************************/
if ( ! function_exists( 'be_recent_posts' ) ) {
	function be_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array (
			'number'=>'three',
			'hide_excerpt' => '',
	    ), $atts ) );
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}
		$hide_excerpt = (isset($hide_excerpt) && ($hide_excerpt)) ? 'hide-excerpt' : '' ;
		$args=array (
			'post_type' => 'post',
			'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		global $meta_sep, $blog_attr;
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			$output .= '<div class="clearfix related-items style3-blog '.$hide_excerpt.'">';
			$blog_attr['style'] = 'shortcodes';
			$blog_attr['gutter_width'] = 0;
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				$output .= '<div class="one-'.$column.' column-block be-hoverlay">';
				ob_start();
				get_template_part( 'blog/loop', $blog_attr['style'] );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
	add_shortcode( 'recent_posts', 'be_recent_posts' );
}
if ( ! function_exists( 'be_recent_posts_style2' ) ) {
	function be_recent_posts_style2( $atts, $content ) {
		extract( shortcode_atts( array (
			'number' => 3,
	    ), $atts ) );
		$posts_per_page = (isset($number) && !empty($number)) ? $number : 3;
		$args=array (
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'orderby' => 'date',
			'ignore_sticky_posts' => 1,
			'tax_query' => array (
				array (
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		global $meta_sep, $blog_attr;
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			$output .= '<div class="clearfix related-items bar-style-related-posts">';
			$blog_attr['style'] = 'shortcodes';
			$blog_attr['gutter_width'] = 0;
			while ( $my_query->have_posts() ) : $my_query->the_post();
				$style = '';
				if( has_post_thumbnail() ) :
					$blog_image_size = 'blog-image';
				    $thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					$attachment_full_url = $thumb_full[0];
					$style = 'background: url('.$attachment_full_url.') center center no-repeat;';
				endif;
				$output .= '<div class="clearfix bar-style-related-posts-list be-bg-cover" style="'.$style.'">';
				$output .= '<div class="background-content">';
				$output .= '<div class="special-subtitle post-date">'.get_the_date( 'F d Y' ).'</div>';
				if(get_the_title(get_the_ID())) {
					$output .= '<a href="'.get_the_permalink().'"><h5 class="post-title">'.get_the_title(get_the_ID()).'</h5></a>';
				}
				$output .= '<nav class="post-nav meta-font secondary_text">';
				$output .= '<div class="sep-with-icon-wrap margin-bottom"><span class="sep-with-icon" style="height:2px; width:20px;"></span><i class="sep-icon font-icon icon-dimond"></i><span class="sep-with-icon" style="height:2px; width:20px;"></span></div>';
				$output .= '<ul class="clearfix cal-list">';
				$output .= '<li class="post-meta post-author">'.__('Posted By :','be-themes').' '.get_the_author().'<span class="post-meta-sep"> / </span></li>';
				$output .= '<li class="post-meta post-comments"><a href="'.get_comments_link().'">'.get_comments_number('0','1','%').' '.__(' comments','be-themes').'</a> <span class="post-meta-sep">/</span></li>';
				$output .= '<li class="post-meta post-category">'.__('Under :','be-themes');
				$output .= be_themes_get_category_list(get_the_ID());
				$output .= '</li>';
				$output .= '</ul></nav>';
				$output .= '</div>';
				$output .= '<div class="background-overlay"></div>';
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
	add_shortcode( 'recent_posts_style_2', 'be_recent_posts_style2' );
}
/**************************************
			Process Style
**************************************/
if (!function_exists('be_process_style1')) {
	function be_process_style1( $atts, $content ) {
		extract( shortcode_atts( array (
			'column' => 1,
			'border_color' => '',
	    ), $atts ) );
		if(empty( $column )) {
			$column = 2;
		}
	    $output = "";
	    $output .= '<div class="process-style1" data-col="'.$column.'" style="border-color: '.$border_color.';">';
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'process_style1', 'be_process_style1' );
}
if (!function_exists('be_process_col')) {
	function be_process_col( $atts, $content ){
			extract( shortcode_atts( array (
				'icon' => '',
				'icon_color' => '',
				'icon_size'	=> '60',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="process-col '.$animate.' align-center" data-animation="'.$animation_type.'">';
			$output .= '<i class="font-icon '.$icon.'" style="font-size: '.$icon_size.'px; color: '.$icon_color.';"></i>';
			$output .= '<div class="process-info">'.do_shortcode( $content ).'</div>';
	        $output .= '</div><div class="process-divider" style="height: '.intval($icon_size/2).'px;"></div>';
	        return $output;
	}
	add_shortcode( 'process_col', 'be_process_col' );
}
/**************************************
			MENU CARD
**************************************/
if (!function_exists('be_menu_cards')) {
	function be_menu_cards( $atts, $content ) {
			extract( shortcode_atts( array (
				'title' => '',
				'ingredients' => '',
				'price' => '',
				'title_color' => '',
				'ingredients_color' => '',
				'price_color' => '',
				'highlight' => '',
				'highlight_color' => '',
				'star' => '',
				'star_color' => '',
				'border_color' => '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$title_color = ( isset( $title_color ) && !empty( $title_color ) ) ? $title_color : '' ;
	    	$ingredients_color = ( isset( $ingredients_color ) && !empty( $ingredients_color ) ) ? $ingredients_color : '' ;
	    	$price_color = ( isset( $price_color ) && !empty( $price_color ) ) ? $price_color : '' ;
	    	$highlight = ( isset( $highlight ) && 1 == $highlight ) ? 'highlight-menu-item' : '' ;
	    	$highlight_color = ( isset( $highlight_color ) && !empty( $highlight_color ) && $highlight == 'highlight-menu-item') ? $highlight_color : '' ;
	    	$star_color = ( isset( $star_color ) && !empty( $star_color ) ) ? $star_color : '' ;
	    	$border_color = ( isset( $border_color ) && !empty( $border_color ) ) ? $border_color : '' ;
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="menu-card-item '.$animate.' clearfix '.$highlight.'" data-animation="'.$animation_type.'" style="background-color: '.$highlight_color.'; border-color: '.$border_color.'">';
			$output .= '<div class="menu-card-item-info">';
			$output .= '<span class="h6-font menu-card-title" style="color: '.$title_color.';">'.$title.'</span>';
			$output .= '<span class="menu-card-ingredients special-subtitle" style="color: '.$ingredients_color.';">'.$ingredients.'</span>';
			$output .= '<span class="menu-card-item-price" style="color: '.$price_color.';">'.$price.'</span>';
			if( isset( $star ) && 1 == $star ) {
				$output .= '<i class="icon-icon_star menu-card-item-stared alt-color" style="color: '.$star_color.';"></i>';
			}
			$output .= '</div>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'menu_card', 'be_menu_cards' );
}
/**************************************
			NEWSLETTER
**************************************/
if (!function_exists('be_newsletter')) {
	function be_newsletter( $atts, $content ) {
			extract( shortcode_atts( array (
				'api_key' => '',
				'id' => '',
				'width' => '50',
				'alignment' => 'left',			
				'button_text'=>'Submit',
				'bg_color'=> '',
				'hover_bg_color'=> '',
				'color'=> '',
				'hover_color'=> '',
				'border_width' => 0,			
				'border_color'=> '',
				'hover_border_color'=> '',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$api_key = ( isset( $api_key ) && !empty( $api_key ) ) ? $api_key : '' ;
	    	$width  = (isset($width ) && !empty( $width ) ) ? $width : '100';
	    	$alignment  = (isset($alignment ) && !empty( $alignment ) ) ? $alignment : 'left';

			if(isset($bg_color) && !empty($bg_color)) {
				$data_bg_color = 'data-bg-color="'.$bg_color.'"';
			} else {
				$data_bg_color = 'data-bg-color="transparent"';
				$bg_color = 'transparent';
			}
			$data_hover_bg_color = (isset($hover_bg_color) && !empty($hover_bg_color)) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"';
			if(isset($color) && !empty($color)) {
				$data_color = 'data-color="'.$color.'"';
			} else {
				$data_color = 'data-color="inherit"';
				$color = 'inherit';
			}
			$data_hover_color = (isset($hover_color) && !empty($hover_color)) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ;
			if(isset($border_color) && !empty($border_color)) {
				$data_border_color = 'data-border-color="'.$border_color.'"';
			} else {
				$data_border_color = 'data-border-color="transparent"';
				$border_color = 'transparent';
			}	
			$data_hover_border_color = (isset($hover_border_color) && !empty($hover_border_color)) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"';
			$border_width = (!isset($border_width) || empty($border_width) || $border_width == '0') ? 0 : $border_width;
			$border_style = 'border-style: solid; border-width:'.$border_width.'px; border-color: '.$border_color;

	    	$id = ( isset( $id ) && !empty( $id ) ) ? $id : '' ;
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : 0 ;
			$output = '';
	    	$output .= '<div class="mail-chimp-wrap align-'.$alignment.' '.$animate.' clearfix" data-animation="'.$animation_type.'">';
	    	$output .= '<form method="POST" class="mail-chimp-form">';
	    	$output .= '<div class="clearfix">';
	    	$output .= '<input type="hidden" name="api_key" value="'.$api_key.'" /><input type="hidden" name="list_id" value="'.$id.'" />';
			$output .= '<fieldset class="contact_fieldset mail-chimp-email-wrap" style="width: '.$width.'%;"><input type="text" name="email" placeholder="'.__('Email','be-themes').'" /><div class="clear"></div></fieldset>';
			$output .= '<fieldset class="contact_fieldset mail-chimp-submit-wrap"><input type="submit" name="submit" value="'.$button_text.'" class="mail-chimp-submit be-shortcode be-button" style= "'.$border_style.';background-color: '.$bg_color.'; color: '.$color.';" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'/><div class="subscribe_loader"><div class="font-icon loader-style4-wrap loader-icon"></div></div></fieldset>';
			$output .= '</div>';
			$output .= '<div class="subscribe_status be-notification"></div>';
			$output .= '</form>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'newsletter', 'be_newsletter' );
}
/**************************************
			COUNTDOWN
**************************************/
if (!function_exists('be_countdown')) {
	function be_countdown( $atts, $content ) {
			extract( shortcode_atts( array (
				'date_time' => '',
				'text_color' =>'',
		        'animate' => 0,
				'animation_type'=>'fadeIn',
	    	), $atts ));
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : 0 ;
	    	$style = ( !empty( $text_color ) ) ? 'style="color:'.$text_color.';"' : '';
			$output = '';
	    	$output .= '<div class="be-countdown-wrap '.$animate.' clearfix" '.$style.' data-animation="'.$animation_type.'">';
	    	$output .= '<div class="be-countdown clearfix" data-time="'.$date_time.'"></div>';
	        $output .= '</div>';
	        return $output;
	}
	add_shortcode( 'be_countdown', 'be_countdown' );
}
?>