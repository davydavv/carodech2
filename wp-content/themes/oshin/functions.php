<?php
load_theme_textdomain( 'be-themes', get_template_directory() . '/languages' );
add_filter( 'auto_update_theme', '__return_true' );
// define('PREMIUM_THEME_NAME','beskeleton');
if ( ! isset( $content_width ) ) {
	$content_width = 1160;
}
// $be_themes_data = get_option(PREMIUM_THEME_NAME);
add_editor_style('css/custom-editor-style.css'); 
$more_text =  __('Read More','be-themes');
$meta_sep = '&middot;';

/* -------------------------------------------
			Theme Setup
---------------------------------------------  */
add_action( 'after_setup_theme', 'be_themes_setup' );
if ( ! function_exists( 'be_themes_setup' ) ):
	function be_themes_setup() {
		
		// $locale = get_locale();
		// $locale_file = get_template_directory() . "/languages/$locale.php";
		// if ( is_readable( $locale_file ) ) {
		// 	require_once( $locale_file );
		// }
		register_nav_menu( 'main_nav', 'Main Menu' );
		register_nav_menu( 'sidebar_nav', 'Sidebar Menu' );	
		register_nav_menu( 'topbar_nav', 'Topbar Menu' );	
		register_nav_menu( 'footer_nav', 'Footer Menu' );
		register_nav_menu( 'main_left_nav', 'Main Left Menu' );
		register_nav_menu( 'main_right_nav', 'Main Right Menu' );		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'video', 'audio','link' ) );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'woocommerce' );
	}
endif;
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/meta-box' ) );
require_once( get_template_directory().'/functions/helpers.php' );
require_once( get_template_directory().'/headers/header-functions.php' );
require_once( get_template_directory().'/functions/widget-functions.php' );
//require_once( get_template_directory().'/functions/custom-post-types.php' );
require_once( get_template_directory().'/ajax-handler.php' );
require_once( get_template_directory().'/functions/be-styles-functions.php' );
require_once( get_template_directory().'/meta-box/meta-box.php' );
require_once( get_template_directory().'/be-themes-metabox.php' );
require_once( get_template_directory().'/functions/be-tgm-plugins.php' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( get_template_directory().'/woocommerce/be-woo-functions.php' );
}
require_once( get_template_directory().'/bb-press/be-bb-press-functions.php' );
if ( ! function_exists( 'be_themes_image_sizes' ) ) {
	function be_themes_image_sizes( $sizes ) {
		global $_wp_additional_image_sizes;
		if ( empty( $_wp_additional_image_sizes ) )
			return $sizes;
		foreach ( $_wp_additional_image_sizes as $id => $data ) {
			if ( !isset($sizes[$id]) )
				$sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
		}
		return $sizes;
	}
}

/* ---------------------------------------------  */
// Include Redux Framework
/* ---------------------------------------------  */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
//if ( !isset( $be_themes_data ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( get_template_directory() .'/functions/be-themes-options-config.php' );
    require_once( get_template_directory() .'/functions/be-themes-update-config.php' );
//}

/* ---------------------------------------------  */
// Specifying the various image sizes for theme
/* ---------------------------------------------  */

if ( function_exists( 'add_image_size' ) ) {
	$portfolio_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(650 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 385;
	$portfolio_2_col = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1000 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 592;
	$portfolio_3_col_wide_width_height_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1250 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 766;
	$portfolio_3_col_wide_width_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? round(1250 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 350;
	$portfolio_3_col_wide_height_image_height = (isset($be_themes_data['portfolio_aspect_ratio']) && !empty($be_themes_data['portfolio_aspect_ratio']) && $be_themes_data['portfolio_aspect_ratio']) ? 2*round(650 / floatval($be_themes_data['portfolio_aspect_ratio'])) : 770;
	add_image_size( 'blog-image', 1160, 700, true);
	add_image_size( 'blog-image-2', 330, 270, true);
	add_image_size( 'carousel-thumb', 75, 50, true );
	// PORTFOLIO
	add_image_size( 'portfolio', 650, $portfolio_image_height, true );
	add_image_size( 'portfolio-masonry', 650 );
	add_image_size( '2col-portfolio', 1000, $portfolio_2_col, true );
	add_image_size( '2col-portfolio-masonry', 1000 );
	add_image_size( '3col-portfolio-wide-width-height', 1250, $portfolio_3_col_wide_width_height_image_height, true );
	add_image_size( '3col-portfolio-wide-width', 1250, $portfolio_3_col_wide_width_image_height, true );
	add_image_size( '3col-portfolio-wide-height', 650, $portfolio_3_col_wide_height_image_height, true );
	add_filter( 'image_size_names_choose', 'be_themes_image_sizes' );
}



/* ---------------------------------------------  */
// Function for generating dynamic css
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_options_css' ) ) {
	function be_themes_options_css() {
		global $be_themes_data;
		// header( 'Content-Type: text/css' );
		 if( !$be_themes_data['site_status'] ) {
		    // header( 'Expires: Thu, 31 Dec 2050 23:59:59 GMT' );
			// header( 'Pragma: cache' );
			delete_transient( 'be_themes_css' );
		}
		if ( false === ( $css = get_transient( 'be_themes_css' ) ) ) {
			$be_themes_path = get_template_directory_uri();
			$css_dir = get_stylesheet_directory() . '/css/'; 
			ob_start(); // Capture all output (output buffering)
			require(get_template_directory() .'/css/be-themes-styles.php'); // Generate CSS
			$css = ob_get_clean(); // Get generated CSS (output buffering)
			set_transient( 'be_themes_css', $css );
		}
		echo '<style type="text/css"> '.$css.' </style>';
		// echo $css;
		// die();
	}
	// add_action( 'wp_ajax_be_themes_options_css', 'be_themes_options_css' );
	// add_action( 'wp_ajax_nopriv_be_themes_options_css', 'be_themes_options_css' ); 
	add_action( 'wp_head', 'be_themes_options_css' );
}

/* ---------------------------------------------  */
// Function for WPML lang Selector
/* ---------------------------------------------  */
//[wpml_lang_selector]
if ( ! function_exists( 'wpml_shortcode_func' ) ) {
	function wpml_shortcode_func(){
	do_action('icl_language_selector');
	}
	add_shortcode( 'wpml_lang_selector', 'wpml_shortcode_func' );
}
/* ---------------------------------------------  */
// Function to change Portfolio Post type 'slug'
/* ---------------------------------------------  */
add_filter('be_portfolio_post_type_slug', 'be_themes_change_post_type_slug');
function be_themes_change_post_type_slug() {
	global $be_themes_data;
	if(!isset($be_themes_data['portfolio_slug']) || empty($be_themes_data['portfolio_slug'])){
		return 'portfolio';
	}
	else{
		return $be_themes_data['portfolio_slug'];
	}
} 

/* ---------------------------------------------  */
// Enqueue Stylesheets
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_add_styles' ) ) {
	function be_themes_add_styles() {		
		wp_register_style( 'be-style-css', get_stylesheet_uri() );
		wp_enqueue_style( 'be-style-css' );
		wp_register_style( 'be-themes-layout', get_template_directory_uri().'/css/layout.css' );
		wp_enqueue_style( 'be-themes-layout' );	
		// wp_register_style( 'be-header-layout', get_template_directory_uri().'/css/header.css' );
		// wp_enqueue_style( 'be-header-layout' );	
		// wp_register_style( 'be-themes-temp-shortcodes', get_template_directory_uri().'/css/temp-shortcodes.css' );
		// wp_enqueue_style( 'be-themes-temp-shortcodes' );		
		// wp_register_style( 'be-themes-shortcodes', get_template_directory_uri().'/css/shortcodes.css' );
		// wp_enqueue_style( 'be-themes-shortcodes' );				
		// wp_register_style( 'be-themes-css', admin_url('admin-ajax.php?action=be_themes_options_css') );
		// wp_enqueue_style( 'be-themes-css' );	
		// wp_register_style( 'fontello', get_template_directory_uri().'/fonts/fontello/be-themes.css' );
		// wp_enqueue_style( 'fontello' );		
		wp_register_style( 'icomoon', get_template_directory_uri().'/fonts/icomoon/style.css' );
		wp_enqueue_style( 'icomoon' );	
		// wp_register_style( 'fonticonpicker', get_template_directory_uri().'/css/jquery.fonticonpicker.min.css' );
		// wp_enqueue_style( 'fonticonpicker' );	
		// wp_register_style( 'fonticontheme', get_template_directory_uri().'/css/jquery.jquery.fonticonpicker.grey.min.css' );
		// wp_enqueue_style( 'fonticontheme' );
		wp_register_style( 'be-lightbox-css', get_template_directory_uri().'/css/magnific-popup.css' );
		wp_enqueue_style( 'be-lightbox-css' );
		wp_register_style( 'be-flexslider', get_template_directory_uri().'/css/flexslider.css' );
		wp_enqueue_style( 'be-flexslider' );
		wp_register_style( 'be-animations', get_template_directory_uri().'/css/animate-custom.css' );
		wp_enqueue_style( 'be-animations' );
		wp_register_style( 'be-slider', get_template_directory_uri().'/css/be-slider.css' );
		wp_enqueue_style( 'be-slider' );
	}
	add_action( 'wp_enqueue_scripts', 'be_themes_add_styles');
}
/* ---------------------------------------------  */
// Enqueue scripts
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_add_scripts' ) ) {
	function be_themes_add_scripts() {
		global $be_themes_data;
		wp_deregister_script( 'modernizr' );
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js' );
		wp_enqueue_script( 'modernizr' );

		wp_deregister_script( 'vimeo-api' );
		wp_register_script( 'vimeo-api', 'https://f.vimeocdn.com/js/froogaloop2.min.js', array(), FALSE, TRUE );
		wp_enqueue_script( 'vimeo-api' );

		wp_deregister_script( 'be-themes-plugins-js' );
		wp_register_script( 'be-themes-plugins-js', get_template_directory_uri() . '/js/plugins.js', array( 'jquery','vimeo-api' ), FALSE, TRUE );
		wp_enqueue_script( 'be-themes-plugins-js' );

		wp_register_script( 'be-themes-slider-js', get_template_directory_uri() . '/js/be-slider.js', array( 'be-themes-plugins-js' ), FALSE, TRUE );
		wp_enqueue_script( 'be-themes-slider-js' );

		wp_deregister_script( 'map-api' );
		wp_register_script( 'map-api', 'https://maps.googleapis.com/maps/api/js', array(), FALSE, TRUE );
		//wp_register_script( 'map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false', array(), FALSE, TRUE );
		wp_enqueue_script( 'map-api' );

		// wp_deregister_script( 'be-map' );
		// wp_register_script( 'be-map', get_template_directory_uri() . '/js/gmap3.min.js', array( 'jquery','map-api' ), FALSE, TRUE );
		// wp_enqueue_script( 'be-map' );

		wp_deregister_script( 'jquery_ui_custom' );
		wp_register_script( 'jquery_ui_custom', get_template_directory_uri() . '/js/jquery-ui-1.8.22.custom.min.js', array( 'be-themes-plugins-js' ), FALSE, TRUE );
		wp_enqueue_script( 'jquery_ui_custom' );

		wp_deregister_script( 'be-themes-script-js' );
		wp_register_script( 'be-themes-script-js', get_template_directory_uri() . '/js/script.js', array( 'jquery','be-themes-plugins-js'), FALSE, TRUE );
		wp_enqueue_script( 'be-themes-script-js' );
		
		if ( class_exists( 'Master_Slider' ) ) {
			wp_register_script( 'masterslider-core', plugin_dir_url('/masterslider/public/assets/js/masterslider.min.js') . 'masterslider.min.js', array( 'jquery','be-themes-plugins-js'), FALSE, TRUE );
			wp_enqueue_script( 'masterslider-core' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'be_themes_add_scripts' );
}
require_once( get_template_directory().'/functions/theme-updates/theme-update-checker.php' );
$be_themes_update_checker = new ThemeUpdateChecker(
    'oshin',
    'http://brandexponents.com/oshin-plugins/be-purchase-verifier.php'
);
add_filter ('tuc_request_update_query_args-oshin','be_themes_autoupdate_verify');
function be_themes_autoupdate_verify( $query_args ) {
	global $be_themes_purchase_data;
	//$query_args['purchase_key'] = '6a22ee37-5473-46d1-b63e-d2baa4256bcd';
	if(is_array($be_themes_purchase_data) && array_key_exists('theme_purchase_code', $be_themes_purchase_data)){
		$query_args['purchase_key'] = $be_themes_purchase_data['theme_purchase_code'];
	}else{
		$query_args['purchase_key'] = '';
	}

	return $query_args;
}
?>