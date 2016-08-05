<?php
/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'be_themes_';

global $meta_boxes;

$meta_boxes = array();
$meta_boxes[] = array (
	'id' => 'portfolio',
	'title' => 'Portfolio Post Type',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array (
			'name'		=> __('Client Name','be-themes'),
			'id'	=> "{$prefix}portfolio_client_name",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),		
		array (
			'name'		=> __('Project Date','be-themes'),
			'id'	=> "{$prefix}portfolio_project_date",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array (
			'name'		=> __('Project URL','be-themes'),
			'id'	=> "{$prefix}portfolio_visitsite_url",
			'desc'		=> 'VIEW PROJECT button will appear if project link is provided here',
			'type'		=> 'text'
		),
		array (
			'name'		=> __('Link Thumbnail To','be-themes'),
			'id'	=> "{$prefix}portfolio_link_to",
			'desc'		=> '',
			'type' => 'radio',
			'options'	=> array (
				'single_portfolio' => 'Single Portfolio Page',
				'external_url' => 'External Url',
			),
			'std'  => 'single_portfolio'
		),
		array (
			'name'		=> __('External URL','be-themes'),
			'id'	=> "{$prefix}portfolio_external_url",
			'desc'		=> 'If at all thumbnail should be linked to external site.',
			'type'		=> 'text'
		),
		array (
			'name' => __('Show Porfolio Title and Navigation Bar','be-themes'),
			'id'   => "{$prefix}portfolio_title_nav",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Traverse within Category','be-themes'),
			'id'   => "{$prefix}traverse_catg",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Main Portfolio Page','be-themes'),
			'id'   => "{$prefix}portfolio_home_page",
			'type' => 'text',
			'std'  => '',
		),
		array (
			'name' => __('Double Width','be-themes'),
			'id'   => "{$prefix}width_wide",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Double Height','be-themes'),
			'id'   => "{$prefix}height_wide",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name'		=> __('Overlay Background Color','be-themes'),
			'id'	=> "{$prefix}single_overlay_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name' => __('Overlay Background Color Opacity','be-themes'),
			'id' => "{$prefix}single_overlay_color_opacity",
			'desc' => '',
			'type' => 'text',
			'std' => 85
		),
		array (
			'name'		=> __('Overlay Title Color','be-themes'),
			'id'	=> "{$prefix}single_overlay_title_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Overlay Categories Color','be-themes'),
			'id'	=> "{$prefix}single_overlay_cat_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'	=> __('Portfolio Single Page Style','be-themes'),
			'id'	=> "{$prefix}portfolio_single_page_style",
			'desc'	=> '',
			'type' 	=> 'select',
			'options'	=> array (
				'normal' => 'Single Page - Page Builder',
				'lightbox' => 'LightBox',
				'lightbox-gallery' => 'LightBox Gallery',
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Centered Slider',
				'style3' => 'Full Screen Slider',
				'style4' => 'Vertical Screen Slider',
				'floting-right' => 'Single Page - Floating Right Sidebar',
				'floting-left' => 'Single Page - Floating Left Sidebar',
				'fixed-left' => 'Single Page - Fixed Left Sidebar',
				'fixed-right' => 'Single Page - Fixed Right Sidebar',
				'none' => 'None',
			),
			'std'  => 'normal'
		),
		array (
			'name'		=> __('Slider Images','be-themes'),
			'id'	=> "{$prefix}single_portfolio_slider_images",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),
		array (
			'name'	=> __('Animation Style','be-themes'),
			'id'	=> "{$prefix}single_portfolio_floting_images_style",
			'desc'	=> 'Will apply on Images in Floating Sidebar pages',
			'type' 	=> 'select',
			'options'	=> array (
				'none' => 'None',
				'flipInX' => 'flipInX',
				'flipInY' => 'flipInY', 
				'fadeIn' => 'fadeIn', 
				'fadeInDown' => 'fadeInDown', 
				'fadeInLeft' => 'fadeInLeft', 
				'fadeInRight' => 'fadeInRight', 
				'fadeInUp' => 'fadeInUp', 
				'slideInDown' => 'slideInDown', 
				'slideInLeft' => 'slideInLeft', 
				'slideInRight' => 'slideInRight', 
				'rollIn' => 'rollIn', 
				'rollOut' => 'rollOut',
				'bounce' => 'bounce',
				'bounceIn' => 'bounceIn',
				'bounceInUp' => 'bounceInUp',
				'bounceInDown' => 'bounceInDown',
				'bounceInLeft' => 'bounceInLeft',
				'bounceInRight' => 'bounceInRight',
				'fadeInUpBig' => 'fadeInUpBig',
				'fadeInDownBig' => 'fadeInDownBig',
				'fadeInLeftBig' => 'fadeInLeftBig',
				'fadeInRightBig' => 'fadeInRightBig',
				'flash' => 'flash',
				'flip' => 'flip',
				'lightSpeedIn' => 'lightSpeedIn',
				'pulse' => 'pulse',
				'rotateIn' => 'rotateIn',
				'rotateInUpLeft' => 'rotateInUpLeft',
				'rotateInDownLeft' => 'rotateInDownLeft',
				'rotateInUpRight' => 'rotateInUpRight',
				'rotateInDownRight' => 'rotateInDownRight',
				'shake' => 'shake',
				'swing' => 'swing',
				'tada' => 'tada',
				'wiggle' => 'wiggle',
				'wobble' => 'wobble',
				'infiniteJump' => 'infiniteJump'
			),
			'std'  => 'none'
		),
		// array (
		// 	'name' => __('Vertical Slider Height','be-themes'),
		// 	'id' => "{$prefix}single_vertical_slide_height",
		// 	'desc' => 'In Percentage',
		// 	'type' => 'text',
		// 	'std' => 100
		// ),

	)
);
$meta_boxes[] = array (
	'id' => 'portfolio_slider',
	'title' => 'Carousel Slider Options',
	'desc'	=> 'Additional Settings for Horizontal Carousel Slider',
	'pages' => array( 'portfolio' ),
	'context' => 'advanced',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Show Information box','be-themes'),
			'id'   => "{$prefix}single_show_info_box",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Show Thumbnails bar','be-themes'),
			'id'   => "{$prefix}single_show_carousel_bar",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Enable Normal Scroll <br/><br/><h5><span>MORE SETTINGS FOR HORIZONTAL CAROUSEL SLIDER</span></h5>','be-themes'),
			'id'   => "{$prefix}single_horizontal_vertical_slider_normal_scroll",
			'type' => 'checkbox',
			'std'  => 0
		),
		array (
			'name'	=>	__('Gutter Width','be-themes'),
			'id'	=>	"{$prefix}horizontal_carousel_slider_gutter_width",
			'desc'	=>	'',
			'type'	=>	'text',
			'std'  	=>	0
		),
		array (
			'name'	=>	__('Slider Height','be-themes'),
			'id'	=>	"{$prefix}horizontal_carousel_slider_height",
			'desc'	=>	'In Percentage',
			'type'	=>	'text',
			'std'  	=>	''
		),
		array (
			'name' => __('Enable Overlay','be-themes'),
			'id'   => "{$prefix}single_horizontal_slider_enable_overlay",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Overlay Background Color','be-themes'),
			'id' => "{$prefix}single_horizontal_slider_overlay_color",
			'desc' => '',
			'type' => 'color',
			'std' => ''
		),
		array (
			'name' => __('Overlay Background Opacity','be-themes'),
			'id' => "{$prefix}single_horizontal_slider_overlay_color_opacity",
			'desc' => '',
			'type' => 'text',
			'std' => 85
		),
	)
);
$meta_boxes[] = array (
	'id' => 'page_portfolio',
	'title' => 'Page Sidebar Options',
	'pages' => array( 'page' ),
	'context' => 'advanced',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Page Sidebar Layout','be-themes'),
			'id'   => "{$prefix}page_layout",
			'type' => 'select',
			'options'=>array (
				'right'=>'Right Sidebar', 
				'left'=>'Left Sidebar', 
				'no' => 'No Sidebar'
			),
			'std'  => 'right',
			'desc' => '',
		),									
		array (
			'name' => __('Sidebar','be-themes'),
			'id'   => "{$prefix}sidebar",
			'type' => 'sidebar_select',
			'std'  => '',
			'desc' => '',
		),
	)
);
$meta_boxes[] = array (
	'id' => 'blog_meta_options Options',
	'title' => 'Blog Options',
	'pages' => array( 'page' ),
	'context' => 'advanced',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Blog Style','be-themes'),
			'id'   => "{$prefix}blog_style",
			'type' => 'select',
			'options'=> array (
				'style1'=>'Large Thumbnail', 
                'style2'=>'Small Thumbnail', 
                'style3'=>'Masonry', 
                'style4'=>'Large Thumbnail Box',
                'style5'=>'Large Thumbnail Alternate Style1',
                'style6'=>'Large Thumbnail Alternate Style2'
			),
			'std'  => 'style1',
			'desc' => '',
		),
		array (
			'name' => __('Blog Column If Masonry Layout','be-themes'),
			'id'   => "{$prefix}blog_column",
			'type' => 'select',
			'options'=> array('two-col'=>'Two Column', 'three-col'=>'Three Column', 'four-col'=>'Four Column'),
			'std'  => 'three-col',
			'desc' => '',
		),
		array (
			'name' => __('Blog Gutter Style If Masonry Layout','be-themes'),
            'id' => "{$prefix}blog_gutter_style",
            'type' => 'select',
            'options'=> array('style1'=>'Style1 Gutter', 'style2'=>'Style2 Gutter'),
            'std'  => 'style1',
        ),
        array (
			'name' => __('Blog Pagination Style','be-themes'),
            'id' => "{$prefix}blog_pagination_style",
            'type' => 'select',
            'options'=> array('normal'=>'Normal', 'loadmore'=>'Load More', 'infinite' => 'Infinite Scroll'),
            'std'  => 'normal',
        ),
        array (
			'name' => __('Blog Gutter Width If Masonry Layout','be-themes'),
            'id' => "{$prefix}blog_gutter_width",
            'type' => 'text',
            'std'  => 40,
		),
	)
);
$meta_boxes[] = array (
	'id' => 'page_portfolio_common',
	'title' => 'Other Layout Options',
	'pages' => array( 'page','portfolio' ),
	'context' => 'advanced',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Show Bottom Widgets','be-themes'),
			'id'   => "{$prefix}bottom_widgets",
			'type' => 'select',
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std'  => 'yes',
			'desc' => '',
		),
		array (
			'name' => __('Show Footer','be-themes'),
			'id'   => "{$prefix}footer_area",
			'type' => 'select',
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std'  => 'yes',
			'desc' => '',
		),
		array (
			'name' => __('Scroll To Sections','be-themes'),
			'id'   => "{$prefix}section_scroll",
			'type' => 'checkbox',
			'std'  => '',
		),
		array (
			'name' => __('Single Page Version','be-themes'),
			'id'   => "{$prefix}single_page_version",
			'type' => 'checkbox',
			'std'  => '',
		),
	)
);
$meta_boxes[] = array (
	'id' => 'header_hero_section',
	'title' => 'Header Hero Section Options',
	'pages' => array( 'post', 'page','portfolio', 'product' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Header Hero Section Type','be-themes'),
			'id'   => "{$prefix}hero_section",
			'type' => 'radio',
			'options'=> array('slider'=>'Slider', 'custom'=>'Image/Video', 'none' => 'None'),
			'std'  => 'none',
			'desc' => '',
		),
		array (
			'name'		=> __('Add Revolution Slider','be-themes'),
			'id'	=> "{$prefix}hero_section_slider_shortcode",
			'desc'		=> '',
			'type'		=> 'textarea',
			'std'		=> ''
		),
		array (
			'name' => __('Header BG','be-themes'),
			'id'   => "{$prefix}header_transparent",
			'type' => 'radio',
			'options'=> array('none' => 'Default', 'transparent'=>'Transparent', 'semitransparent'=>'Semi-Transparent'),
			'std'  => ''
		),
		array (
			'name' => __('Sticky Header','be-themes'),
			'id'   => "{$prefix}sticky_header",
			'type' => 'select',
			'options'=> array('inherit' => 'Inherit From Option panel', 'yes' => 'Yes', 'no' => 'No'),
			'std'  => 'inherit',
			'desc' => '',
		),
		array (
			'name' => __('Color Scheme<br><i style="color:red;">Applicable only for Transparent/Semi Transparent header</i></br>','be-themes'),
			'id'   => "{$prefix}header_transparent_color_scheme",
			'type' => 'radio',
			'options'=> array('none' => 'Default', 'dark' => 'Dark', 'light' => 'Light'),
			'std'  => 'dark'
		),
		array (
			'name' => __('Position <br><i style="color:red;">Applicable only for non-transparent header</i></br>','be-themes'),
			'id'   => "{$prefix}hero_section_position",
			'type' => 'radio',
			'options'=> array('before' => 'Before Header', 'after' => 'After Header'),
			'std'  => 'after',
			'desc' => '',
		),
		array (
			'name' => __('Show With Header<br><i style="color:red;">Applicable only if header is non-transparent, Hero Section position is Before Header and no Custom Height is defined</i></br>','be-themes'),
			'id'   => "{$prefix}hero_section_with_header",
			'type' => 'radio',
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std'  => 'no',
			'desc' => '',
		),
		array (
			'name' => __('Custom Height','be-themes'),
			'id'   => "{$prefix}hero_section_custom_height",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name'		=> __('Background Color','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Background Image','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_image",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 1,
		),
		array (
			'name' => __('Background Repeat','be-themes'),
			'id'   => "{$prefix}hero_section_bg_repeat",
			'type' => 'select',
			'options'=> array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'four' => 'Four', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No Repeat'),
			'std'  => 'repeat',
			'desc' => '',
		),
		array (
			'name' => __('Background Attachment','be-themes'),
			'id'   => "{$prefix}hero_section_bg_attachment",
			'type' => 'select',
			'options'=> array('scroll' => 'Scroll', 'fixed' => 'Fixed'),
			'std'  => 'scroll',
			'desc' => '',
		),
		array (
			'name' => __('Background Position','be-themes'),
			'id'   => "{$prefix}hero_section_bg_position",
			'type' => 'select',
			'options'=> array('top left' => 'Top Left', 'top right' => 'Top Right', 'top center' => 'Top Center', 'center left' => 'Center Left', 'center right' => 'Center Right', 'center center' => 'Center Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right', 'bottom center' => 'Bottom Center'),
			'std'  => 'top left',
			'desc' => '',
		),
		array (
			'name' => __('Center Scale Image to occupy container','be-themes'),
			'id'   => "{$prefix}hero_section_bg_scale",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Background Animation','be-themes'),
			'id'   => "{$prefix}hero_section_bg_animation",
			'type' => 'select',
			'options'=> array(
				'none' => 'None', 
				'be-bg-parallax' => 'Parallax',
				'be-bg-mousemove-parallax' => 'Mouse Move',
				'background-horizontal-animation' => 'Horizontal Loop Animation',
				'background-vertical-animation' => 'Vertical Loop Animation'
			),
			'std'  => 'scroll',
			'desc' => '',
		),
		array (
			'name' => __('Animation Canvas on Background','be-themes'),
			'id'   => "{$prefix}hero_section_bg_animation_canvas",
			'type' => 'select',
			'options'=> array(
				'none' => 'None', 
				'galaxy-canvas' => 'Galaxy',
				'waterdrops-canvas' => 'Waterdrops',
				'pattern-canvas' => 'Colored Pattern',
			),
			'std'  => 'none',
			'desc' => '',
		),
		array (
			'name'		=> __('Canvas Color 1','be-themes'),
			'id'	=> "{$prefix}hero_section_canvas_color1",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Canvas Color 2','be-themes'),
			'id'	=> "{$prefix}hero_section_canvas_color2",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Canvas Color 3','be-themes'),
			'id'	=> "{$prefix}hero_section_canvas_color3",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Canvas Color 4','be-themes'),
			'id'	=> "{$prefix}hero_section_canvas_color4",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Canvas Color 5','be-themes'),
			'id'	=> "{$prefix}hero_section_canvas_color5",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name' => __('Enable Background Video','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Video .MP4 Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_mp4",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Video .OGG Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_ogg",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Video .Webm Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_webm",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Enable Background Overlay','be-themes'),
			'id'   => "{$prefix}hero_section_overlay",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name'		=> __('Background Overlay Color','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_overlay_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name' => __('Background Overlay Opacity','be-themes'),
			'id'   => "{$prefix}hero_section_bg_overlay_opacity",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Container Wrap','be-themes'),
			'id'   => "{$prefix}hero_section_container_wrap",
			'type' => 'radio',
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std'  => 'yes',
			'desc' => 'no',
		),
		array (
			'name'		=> __('Content','be-themes'),
			'id'	=> "{$prefix}hero_section_content",
			'desc'		=> '',
			'type'		=> 'wysiwyg',
			'std'		=> ''
		),
		array (
			'name' => __('Section Navigation Target Id','be-themes'),
			'id'   => "{$prefix}section_nav_id",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name'	=> __('Section Navigation Target Icon Color','be-themes'),
			'id'	=> "{$prefix}section_nav_icon_color",
			'desc'	=> '',
			'type'	=> 'color',
			'std'	=> ''
		),
		array (
			'name' => __('Section Navigation Target Icon','be-themes'),
			'id'   => "{$prefix}section_nav_icon",
			'type' => 'select',
			'options'=> array(
				'icon-arrow_carrot-down' => 'Icon Down',
				'icon-arrow-down4' => 'Triangle Down'
			),
			'std'  => 'icon-arrow_carrot-down',
			'desc' => '',
		),
	)
);
$meta_boxes[] = array (
	'id' => 'post_format_options',
	'title' => 'Post Format Options',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (
		array (
			'name'		=> __('Youtube / Vimeo Video Url','be-themes'),
			'id'	=> "{$prefix}video_url",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array (
			'name'		=> __('Audio Embed Code Or Link to an Audio File','be-themes'),
			'id'	=> "{$prefix}audio_url",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array (
			'name'		=> __('Link Post Format URL','be-themes'),
			'id'	=> "{$prefix}link_format",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array (
			'name'		=> __('Quote Post Format Author','be-themes'),
			'id'	=> "{$prefix}quote_author",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),						
		array (
			'name'		=> __('Gallery Post Format Images','be-themes'),
			'id'	=> "{$prefix}gal_post_format",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 10,
		)
	)
);
$meta_boxes[] = array (
	'id' => 'gallery_template_options',
	'title' => 'Gallery Template Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array (
			'name'	=> __('Gallery Style','be-themes'),
			'id'	=> "{$prefix}portfolio_single_page_style",
			'desc'	=> '',
			'type' 	=> 'select',
			'options'	=> array (
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Centered Slider',
				'style3' => 'Full Screen Slider',
				'style4' => 'Vertical Screen Slider'
			),
			'std'  => 'style1'
		),
		array (
			'name'		=> __('Gallery Images','be-themes'),
			'id'	=> "{$prefix}single_portfolio_slider_images",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),	
		array (
			'name' => __('Show Information box','be-themes'),
			'id'   => "{$prefix}single_show_info_box",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Show Carousel bar','be-themes'),
			'id'   => "{$prefix}single_show_carousel_bar",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Enable Normal Scroll<br/><br/><h5><span>MORE SETTINGS FOR HORIZONTAL CAROUSEL SLIDER</span></h5>','be-themes'),
			'id'   => "{$prefix}single_horizontal_vertical_slider_normal_scroll",
			'type' => 'checkbox',
			'std'  => 0
		),	
		array (
			'name'	=>	__('Gutter Width','be-themes'),
			'id'	=>	"{$prefix}horizontal_carousel_slider_gutter_width",
			'desc'	=>	'',
			'type'	=>	'text',
			'std'  	=>	0
		),
		array (
			'name'	=>	__('Height','be-themes'),
			'id'	=>	"{$prefix}horizontal_carousel_slider_height",
			'desc'	=>	'In Percentage',
			'type'	=>	'text',
			'std'  	=>	''
		),
		array (
			'name' => __('Enable Overlay','be-themes'),
			'id'   => "{$prefix}single_horizontal_slider_enable_overlay",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Overlay Background Color','be-themes'),
			'id' => "{$prefix}single_horizontal_slider_overlay_color",
			'desc' => '',
			'type' => 'color',
			'std' => ''
		),
		array (
			'name' => __('Overlay Background Color Opacity','be-themes'),
			'id' => "{$prefix}single_horizontal_slider_overlay_color_opacity",
			'desc' => '',
			'type' => 'text',
			'std' => 85
		),
		// array (
		// 	'name' => __('Vertical Slide Height In Percentage','be-themes'),
		// 	'id' => "{$prefix}single_vertical_slide_height",
		// 	'desc' => '',
		// 	'type' => 'text',
		// 	'std' => 100
		// ),

	)
);
$meta_boxes[] = array (
	'id' => 'portfolio_template_options',
	'title' => 'Portfolio Template Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => 'Portfolio Category',
			'id'   => "{$prefix}portfolio_taxonomy",
			'type' => 'taxonomy',
			'options' => array(
        		'taxonomy' => 'portfolio_categories',
        		'type' => 'checkbox_list',
        		'args' => array( ),
    		),
			'desc' => 'Choose your categories'
		),
		array (
			'name'	=> __('Portfolio Style','be-themes'),
			'id'	=> "{$prefix}portfolio_template_style",
			'desc'	=> '',
			'type' 	=> 'select',
			'options'	=> array (
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Vertical Screen Slider',
				'style3' => 'Dual Carousel Slider'
			),
			'std'  => 'style1'
		),
		array (
			'name'	=> __('Dual Carousel Slider Animation Style','be-themes'),
			'id'	=> "{$prefix}dual_carousel_posrtfolio_animation_style",
			'desc'	=> '',
			'type' 	=> 'select',
			'options'=> array (
				'fxSoftScale' => 'FxSoftScale', 
				'fxPressAway' => 'FxPressAway',
				'fxSideSwing' => 'FxSideSwing',
				'fxFortuneWheel' => 'FxFortuneWheel', 
				'fxSwipe' => 'FxSwipe', 
				'fxPushReveal' => 'FxPushReveal', 
				'fxSnapIn' => 'FxSnapIn', 
				'fxLetMeIn' => 'FxLetMeIn', 
				'fxStickIt' => 'FxStickIt', 
				'fxArchiveMe' => 'FxArchiveMe', 
				'fxVGrowth' => 'FxVGrowth', 
				'fxVGrowth' => 'FxSlideBehind', 
				'fxSoftPulse' => 'FxSoftPulse', 
				'fxEarthquake' => 'FxEarthquake', 
				'fxCliffDiving' => 'FxCliffDiving'
			),
			'std'=> 'fxSoftScale'
		),
		array (
			'name' => __('Show Information box','be-themes'),
			'id'   => "{$prefix}portfolio_show_info_box",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Show Carousel bar','be-themes'),
			'id'   => "{$prefix}portfolio_show_carousel_bar",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Enable Normal Scroll<br/><br/><h5><span>MORE SETTINGS FOR HORIZONTAL CAROUSEL SLIDER</span></h5>','be-themes'),
			'id'   => "{$prefix}portfolio_horizontal_vertical_slider_normal_scroll",
			'type' => 'checkbox',
			'std'  => 0
		),
		array (
			'name'	=>	__('Height','be-themes'),
			'id'	=>	"{$prefix}portfolio_carousel_slider_height",
			'desc'	=>	'In Percentage',
			'type'	=>	'text',
			'std'  	=>	''
		),
		array (
			'name'	=>	__('Gutter Width','be-themes'),
			'id'	=>	"{$prefix}portfolio_carousel_slider_gutter_width",
			'desc'	=>	'',
			'type'	=>	'text',
			'std'  	=>	0
		),
		array (
			'name' => __('Enable Overlay','be-themes'),
			'id'   => "{$prefix}portfolio_horizontal_slider_enable_overlay",
			'type' => 'checkbox',
			'std'  => 1
		),
		array (
			'name' => __('Overlay Background Color','be-themes'),
			'id' => "{$prefix}portfolio_horizontal_slider_overlay_color",
			'desc' => '',
			'type' => 'color',
			'std' => ''
		),
		array (
			'name' => __('Overlay Background Color Opacity','be-themes'),
			'id' => "{$prefix}portfolio_horizontal_slider_overlay_color_opacity",
			'desc' => '',
			'type' => 'text',
			'std' => 85
		),
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function be_themes_register_meta_boxes()
{
	global $meta_boxes;
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'be_themes_register_meta_boxes' );