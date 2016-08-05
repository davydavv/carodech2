body {
    <?php be_themes_set_backgrounds('body'); ?>
}
.layout-box #header-inner-wrap, 
#header-inner-wrap,
body.header-transparent #header #header-inner-wrap.no-transparent,
.left-header .sb-slidebar.sb-left
{
    <?php be_themes_set_backgrounds('opt-header-color'); ?>
}
#mobile-menu, 
#mobile-menu ul {
    <?php be_themes_background_colors($be_themes_data['mobile_menu_bg']['color'], $be_themes_data['mobile_menu_bg']['alpha']); ?>
}

body.header-transparent #header-inner-wrap{
  background: transparent;
}
<?php if(('left' == $be_themes_data['opt-header-type'] )  && (!empty( $be_themes_data['opt-header-color']['background-image'] ))) {?>
  .left-header .sb-slidebar.sb-left .display-table{
    <?php be_themes_background_colors($be_themes_data['left-static-overlay']['color'], $be_themes_data['left-static-overlay']['alpha']); ?>
  }<?php
}?>
#header .header-border{
 border-bottom: <?php echo be_themes_borders('opt-header-border-color','bottom') ; ?>;
}
#header-top-bar{
    <?php be_themes_background_colors($be_themes_data['opt-topbar-color']['color'], $be_themes_data['opt-topbar-color']['alpha']); ?>
    border-bottom: <?php echo be_themes_borders('opt-topbar-border-color','bottom') ; ?>;
    color: <?php echo $be_themes_data['opt-topbar-text-color']; ?>;
}
#header-top-bar #topbar-menu li a{
    color: <?php echo $be_themes_data['opt-topbar-text-color']; ?>;
}
#header-bottom-bar{
    <?php be_themes_background_colors($be_themes_data['opt-bottombar-color']['color'], $be_themes_data['opt-bottombar-color']['alpha']); ?>
    border-top: <?php echo be_themes_borders('opt-bottombar-border-color','top') ; ?>;
    border-bottom: <?php echo be_themes_borders('opt-bottombar-border-color','bottom') ; ?>;
}
body.header-transparent #header #header-inner-wrap {
	-webkit-transition: background .25s ease, box-shadow .25s ease;
	-moz-transition: background .25s ease, box-shadow .25s ease;
	-o-transition: background .25s ease, box-shadow .25s ease;
	transition: background .25s ease, box-shadow .25s ease;
}
body.header-transparent.semi .layout-wide #header  .semi-transparent ,
body.header-transparent.semi .layout-border #header  .semi-transparent {
  <?php be_themes_background_colors($be_themes_data['semi-transparent-header-color']['color'], $be_themes_data['semi-transparent-header-color']['alpha']) ?>  !important ;
}
body.header-transparent.semi .layout-box #header  .semi-transparent #header-wrap{
  <?php be_themes_background_colors($be_themes_data['semi-transparent-header-color']['color'], $be_themes_data['semi-transparent-header-color']['alpha']) ?>  !important ;  
}
#content,
#blog-content {
    <?php be_themes_set_backgrounds('content'); ?>
}
#bottom-widgets {
    <?php be_themes_set_backgrounds('bottom_widgets'); ?>
}
#footer {
  <?php be_themes_set_backgrounds('footer_background'); ?>
}
#footer .footer-border{
  border-bottom: <?php echo be_themes_borders('footer-border-color','top') ; ?>;
}
.page-title-module-custom {
	<?php be_themes_set_backgrounds('header_title_module'); ?>
}
#navigation .sub-menu,
#navigation .children,
#navigation-left-side .sub-menu,
#navigation-left-side .children,
#navigation-right-side .sub-menu,
#navigation-right-side .children {
  <?php be_themes_background_colors($be_themes_data['submenu_bg_color']['color'], $be_themes_data['submenu_bg_color']['alpha']); ?>
}
.sb-slidebar.sb-right {
  <?php be_themes_background_colors($be_themes_data['sidebar_menu_bg_color']['color'], $be_themes_data['sidebar_menu_bg_color']['alpha']); ?>
}
.left-header .left-strip-wrapper,
.left-header #left-header-mobile {
  background-color : <?php echo $be_themes_data['opt-header-color']['background-color']; ?> ;
}
.layout-box-top,
.layout-box-bottom,
.layout-box-right,
.layout-box-left,
.layout-border-header-top #header-inner-wrap,
.layout-border-header-top.layout-box #header-inner-wrap, 
body.header-transparent .layout-border-header-top #header #header-inner-wrap.no-transparent {
  <?php be_themes_set_backgrounds('border-bg-setting');?>
}

.left-header.left-sliding.left-overlay-menu .sb-slidebar{
  <?php be_themes_background_colors($be_themes_data['left_overlay_menu_bg_color']['color'], $be_themes_data['left_overlay_menu_bg_color']['alpha']); ?>
  
}
.top-header.top-overlay-menu .sb-slidebar{
  <?php be_themes_background_colors($be_themes_data['sidebar_menu_bg_color']['color'], $be_themes_data['sidebar_menu_bg_color']['alpha']); ?>
}
.search-box-wrapper{
  <?php be_themes_background_colors($be_themes_data['search_bg']['color'], $be_themes_data['search_bg']['alpha']); ?>
}
.search-box-wrapper.style1-header-search-widget input[type="text"]{
  background-color: transparent !important;
  color: <?php echo $be_themes_data['search_font_color'] ;?>;
  border: 1px solid  <?php echo $be_themes_data['search_font_color'] ;?>;
}
.search-box-wrapper.style2-header-search-widget input[type="text"]{
  background-color: transparent !important;
  font-style: <?php echo $be_themes_data['sub_title']['font-style']; ?>;
  font-weight: <?php echo $be_themes_data['sub_title']['font-weight']; ?>;
  font-family: <?php echo $be_themes_data['sub_title']['font-family']; ?>;
  color: <?php echo $be_themes_data['search_font_color'] ;?>;
  border: none !important;
  box-shadow: none !important;
}
.search-box-wrapper .searchform .search-icon{
  color: <?php echo $be_themes_data['search_font_color'] ;?>;
}
#header-top-bar-right .search-box-wrapper.style1-header-search-widget input[type="text"]{
  border: none; 
}

/* ======================
    Typography
   ====================== */
body,
.special-heading-wrap .caption-wrap .body-font {
    <?php be_themes_print_typography('body_text'); ?>
    -webkit-font-smoothing: antialiased; 
    -moz-osx-font-smoothing: grayscale;
}
h1 {
	<?php be_themes_print_typography('h1'); ?>
}
h2 {
	<?php be_themes_print_typography('h2'); ?>
}
h3 {
  <?php be_themes_print_typography('h3'); ?>
}
h4 {
  <?php be_themes_print_typography('h4'); ?>
}
h5, #reply-title {
  <?php be_themes_print_typography('h5'); ?>
}
h6,
.testimonial-author-role.h6-font,
.menu-card-title,
.menu-card-item-price {
  <?php be_themes_print_typography('h6'); ?>
}
.gallery-side-heading {
  font-size: <?php echo $be_themes_data['body_text']['font-size']; ?>;
}
.special-subtitle , 
.style1.thumb-title-wrap .portfolio-item-cats {
  font-style: <?php echo $be_themes_data['sub_title']['font-style']; ?>;
  font-size: <?php echo $be_themes_data['sub_title']['font-size']; ?>;
  font-weight: <?php echo $be_themes_data['sub_title']['font-weight']; ?>;
  font-family: <?php echo $be_themes_data['sub_title']['font-family']; ?>;
  text-transform: <?php echo $be_themes_data['sub_title']['text-transform']; ?>;
  letter-spacing: 0px;
}
.top-right-sliding-menu .sb-right ul#slidebar-menu li,
.overlay-menu-close {
  <?php be_themes_print_typography('sidebar_menu_text'); ?>
}
.top-right-sliding-menu .sb-right ul#slidebar-menu li a{
  color: <?php echo $be_themes_data['sidebar_menu_text']['color'] ; ?> !important;
}
.top-right-sliding-menu .sb-right #slidebar-menu ul.sub-menu li{
  <?php be_themes_print_typography('sidebar_submenu_text'); ?>
}
.top-right-sliding-menu .sb-right ul#slidebar-menu li a{
  color: <?php echo $be_themes_data['sidebar_submenu_text']['color'] ; ?> !important;
}
.sb-right #slidebar-menu .mega .sub-menu .highlight .sf-with-ul{
 <?php be_themes_print_typography('sidebar_menu_text'); ?>;
 color: <?php echo $be_themes_data['sidebar_submenu_text']['color'] ; ?> !important;
}
.post-meta.post-top-meta-typo{
  <?php be_themes_print_typography('post_top_meta_options'); ?>;
}

#navigation,
.style2 #navigation,
#navigation-left-side,
#navigation-right-side,
.header-cart-controls .cart-contents,
.sb-left  #slidebar-menu,
#header-controls-right,
#header-controls-left,
body #header-inner-wrap.top-animate.style2 #navigation,
.top-overlay-menu .sb-right  #slidebar-menu {
    <?php be_themes_print_typography('navigation_text'); ?>
}
ul#mobile-menu a {
    <?php be_themes_print_typography('mobile_menu_text'); ?>
}
ul#mobile-menu ul.sub-menu a{
    <?php be_themes_print_typography('mobile_submenu_text'); ?> 
}

#navigation .sub-menu,
#navigation .children,
#navigation-left-side .sub-menu,
#navigation-left-side .children,
#navigation-right-side .sub-menu,
#navigation-right-side .children,
.sb-left  #slidebar-menu .sub-menu,
.top-overlay-menu .sb-right  #slidebar-menu .sub-menu{
  <?php be_themes_print_typography('submenu_text'); ?>
}
.thumb-title-wrap {
  color: <?php echo $be_themes_data['alt_bg_text_color'] ;?>;
}
.thumb-title-wrap .thumb-title{
  <?php be_themes_print_typography('portfolio_title'); ?>
}
.thumb-title-wrap .portfolio-item-cats {
  font-size: <?php echo $be_themes_data['portfolio_meta_typo']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['portfolio_meta_typo']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['portfolio_meta_typo']['text-transform']; ?>;
  letter-spacing: <?php echo $be_themes_data['portfolio_meta_typo']['letter-spacing']; ?>;
}
.full-screen-portfolio-overlay-title {
    <?php be_themes_print_typography('portfolio_title'); ?>
}
#footer {
    <?php be_themes_print_typography('footer_text'); ?>
}
#bottom-widgets h6 {
    <?php be_themes_print_typography('bottom_widget_title'); ?>
    margin-bottom:20px;
}
#bottom-widgets {
    <?php be_themes_print_typography('bottom_widget_text'); ?>
}
.sidebar-widgets h6 {
   <?php be_themes_print_typography('sidebar_widget_title'); ?>
   margin-bottom:20px;
}
.sidebar-widgets {
	<?php be_themes_print_typography('sidebar_widget_text'); ?>
}

.sb-slidebar .widget {
  <?php be_themes_print_typography('slidebar_widget_text'); ?>
}
.sb-slidebar .widget h6 {
  <?php be_themes_print_typography('slidebar_widget_title'); ?>
}
.woocommerce ul.products li.product .product-meta-data h3, 
.woocommerce-page ul.products li.product .product-meta-data h3,
.woocommerce ul.products li.product h3, 
.woocommerce-page ul.products li.product h3 {
  <?php be_themes_print_typography('shop_page_title'); ?>
}

.related.products h2,
.upsells.products h2,
.cart-collaterals .cross-sells h2,
.cart_totals h2, 
.shipping_calculator h2,
.woocommerce-billing-fields h3,
.woocommerce-shipping-fields h3,
.shipping_calculator h2,
#order_review_heading,
.woocommerce .page-title {
  font-family: <?php echo $be_themes_data['shop_page_title']['font-family']; ?>;
  font-weight: <?php echo $be_themes_data['shop_page_title']['font-weight']; ?>;
}
.woocommerce-page.single.single-product #content div.product h1.product_title.entry-title {
  <?php be_themes_print_typography('shop_single_page_title'); ?>
}

.woocommerce form .form-row label, .woocommerce-page form .form-row label {
  color: <?php echo $be_themes_data['h6']['color']; ?>;
}


.contact_form_module input[type="text"], 
.contact_form_module textarea {
  <?php be_themes_print_typography('contact_form_typo'); ?>
}
#bottom-widgets .widget ul li a, #bottom-widgets a {
	color: inherit;
}
a, a:visited, a:hover,
#bottom-widgets .widget ul li a:hover, 
#bottom-widgets a:hover,
#navigation .current_page_item a,
#navigation .current_page_item a:hover,
#navigation a:hover,
#navigation-left-side .current_page_item a,
#navigation-left-side .current_page_item a:hover,
#navigation-left-side a:hover,
#navigation-right-side .current_page_item a,
#navigation-right-side .current_page_item a:hover,
#navigation-right-side a:hover {
	color: <?php echo $be_themes_data['color_scheme']; ?>;
}
#navigation .current_page_item ul li a,
#navigation-left-side .current_page_item ul li a,
#navigation-right-side .current_page_item ul li a {
  color: inherit;
}

.current-menu-item a {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
.sb-left #slidebar-menu a:hover,
.sb-left #slidebar-menu .current-menu-item a {
  color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.page-title-module-custom .page-title-custom,
h6.portfolio-title-nav{
  <?php be_themes_print_typography('page_title_module_typo'); ?>
}
#portfolio-title-nav-wrap .portfolio-nav a {
 color:   <?php echo $be_themes_data['portfolio_nav_color']; ?>; 
}
#portfolio-title-nav-wrap .portfolio-nav a:hover {
 color:   <?php echo $be_themes_data['portfolio_nav_hover_color']; ?>; 
}

.breadcrumbs {
  color: <?php echo $be_themes_data['page_title_module_typo']['color']; ?>;
}
.page-title-module-custom .header-breadcrumb {
  line-height: 36px;
}

#portfolio-title-nav-wrap{
  background-color: <?php echo $be_themes_data['portfolio_title_nav_color']; ?>;
}
a.custom-share-button, a.custom-share-button:active, a.custom-share-button:hover, a.custom-share-button:visited{
  color: <?php echo $be_themes_data['h6']['color']; ?> !important; 
}
.be-button,
.woocommerce a.button, .woocommerce-page a.button, 
.woocommerce button.button, .woocommerce-page button.button, 
.woocommerce input.button, .woocommerce-page input.button, 
.woocommerce #respond input#submit, .woocommerce-page #respond input#submit,
.woocommerce #content input.button, .woocommerce-page #content input.button,
input[type="submit"],
.more-link.style2-button,
.more-link.style3-button,
input[type="button"], input[type="submit"], input[type="reset"], input[type="file"]::-webkit-file-upload-button, button  {
	font-family: <?php echo $be_themes_data['button_font']['font-family'];  ?>;
  font-weight: <?php echo $be_themes_data['button_font']['font-weight'];  ?>;
}

.more-link.style2-button {
  color: <?php echo $be_themes_data['post_title']['color'];  ?> !important;
  border-color: <?php echo $be_themes_data['post_title']['color'];  ?> !important;
}

.woocommerce a.button, .woocommerce-page a.button, 
.woocommerce button.button, .woocommerce-page button.button, 
.woocommerce input.button, .woocommerce-page input.button, 
.woocommerce #respond input#submit, .woocommerce-page #respond input#submit,
.woocommerce #content input.button, .woocommerce-page #content input.button {
  background: transparent !important;
  color: #000 !important;
  border-color: #000 !important;
  border-style: solid !important;
  border-width: 2px !important;
  background: <?php echo $be_themes_data['shop_page_button_bg_color']; ?> !important;
  color: <?php echo $be_themes_data['shop_page_button_color']; ?> !important;
  border-width: <?php echo $be_themes_data['shop_page_button_border_width']; ?>px !important;
  border-color: <?php echo $be_themes_data['shop_page_button_border_color']; ?> !important;
  line-height: 41px;
  text-transform: uppercase;
}
.woocommerce a.button:hover, .woocommerce-page a.button:hover, 
.woocommerce button.button:hover, .woocommerce-page button.button:hover, 
.woocommerce input.button:hover, .woocommerce-page input.button:hover, 
.woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover,
.woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover {
  background: #e0a240 !important;
  color: #fff !important;
  border-color: #e0a240 !important;
  border-width: 2px !important;
  background: <?php echo $be_themes_data['shop_page_button_hover_bg_color']; ?> !important;
  color: <?php echo $be_themes_data['shop_page_button_hover_color']; ?> !important;
  border-color: <?php echo $be_themes_data['shop_page_button_border_hover_color']; ?> !important;

}
.woocommerce a.button.alt, .woocommerce-page a.button.alt, 
.woocommerce .button.alt, .woocommerce-page .button.alt, 
.woocommerce input.button.alt, .woocommerce-page input.button.alt,
.woocommerce input[type="submit"].alt, .woocommerce-page input[type="submit"].alt, 
.woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt,
.woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt {
  background: #e0a240 !important;
  color: #fff !important;
  border-color: #e0a240 !important;
  border-style: solid !important;
  border-width: 2px !important;
  background: <?php echo $be_themes_data['shop_page_alt_button_bg_color']; ?> !important;
  color: <?php echo $be_themes_data['shop_page_alt_button_color']; ?> !important;
  border-width: <?php echo $be_themes_data['shop_page_alt_button_border_width']; ?>px !important;
  border-color: <?php echo $be_themes_data['shop_page_alt_button_border_color']; ?> !important;
  line-height: 41px;
  text-transform: uppercase;
}
.woocommerce a.button.alt:hover, .woocommerce-page a.button.alt:hover, 
.woocommerce .button.alt:hover, .woocommerce-page .button.alt:hover, 
.woocommerce input[type="submit"].alt:hover, .woocommerce-page input[type="submit"].alt:hover, 
.woocommerce input.button.alt:hover, .woocommerce-page input.button.alt:hover, 
.woocommerce #respond input#submit.alt:hover, .woocommerce-page #respond input#submit.alt:hover,
.woocommerce #content input.button.alt:hover, .woocommerce-page #content input.button.alt:hover {
  background: transparent !important;
  color: #000 !important;
  border-color: #000 !important;
  border-style: solid !important;
  border-width: 2px !important;
  background: <?php echo $be_themes_data['shop_page_alt_button_hover_bg_color']; ?> !important;
  color: <?php echo $be_themes_data['shop_page_alt_button_hover_color']; ?> !important;
  border-color: <?php echo $be_themes_data['shop_page_alt_button_border_hover_color']; ?> !important;
}
.post-title ,
.post-date-wrap {
  <?php be_themes_print_typography('post_title'); ?>
  margin-bottom: 12px;
}

.style7-blog .post-title{
  margin-bottom: 9px;
}
.style3-blog .post-title {
  <?php be_themes_print_typography('masonry_post_title'); ?>
}

.post-nav li{
  <?php be_themes_print_typography('post_meta_options'); ?>
}

.ui-tabs-anchor, 
.accordion .accordion-head,
.skill-wrap .skill_name,
.chart-wrap span,
.animate-number-wrap h6 span,
.woocommerce-tabs .tabs li a,
.be-countdown {
    font-family: <?php echo $be_themes_data['pb_module_title']['font-family']; ?>;
    letter-spacing: <?php echo $be_themes_data['pb_module_title']['letter-spacing']; ?>;
    font-style: <?php echo $be_themes_data['pb_module_title']['font-style']; ?>;
    font-weight: <?php echo $be_themes_data['pb_module_title']['font-weight']; ?>;
}

.woocommerce-tabs .tabs li a {
  color: <?php echo $be_themes_data['h6']['color']; ?> !important;
}

.ui-tabs-anchor{
  font-size: <?php echo $be_themes_data['pb_tab_font_size']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['pb_tab_font_size']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['pb_tab_font_size']['text-transform']; ?>;
}

.accordion .accordion-head{
  font-size: <?php echo $be_themes_data['pb_acc_font_size']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['pb_acc_font_size']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['pb_acc_font_size']['text-transform']; ?>;
}

.skill-wrap .skill_name{
  font-size: <?php echo $be_themes_data['pb_skill_font_size']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['pb_skill_font_size']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['pb_skill_font_size']['text-transform']; ?>;
}

.countdown-section {
  font-size: <?php echo $be_themes_data['pb_countdown_caption_font_size']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['pb_countdown_caption_font_size']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['pb_countdown_caption_font_size']['text-transform']; ?>;
}

.countdown-amount {
  font-size: <?php echo $be_themes_data['pb_countdown_number_font_size']['font-size']; ?>;
  line-height: <?php echo $be_themes_data['pb_countdown_number_font_size']['line-height']; ?>;
  text-transform: <?php echo $be_themes_data['pb_countdown_number_font_size']['text-transform']; ?>;
}

.flexslider.tweet-slides .tweet-content{
  font-family: <?php echo $be_themes_data['pb_module_tweet']['font-family']; ?>;
  letter-spacing: <?php echo $be_themes_data['pb_module_tweet']['letter-spacing']; ?>;
  font-style: <?php echo $be_themes_data['pb_module_tweet']['font-style']; ?>;
  font-weight: <?php echo $be_themes_data['pb_module_tweet']['font-weight']; ?>;
  text-transform: <?php echo $be_themes_data['pb_module_tweet']['text-transform']; ?>;
}

.testimonial_slide .testimonial-content{
  font-family: <?php echo $be_themes_data['pb_module_spl_body']['font-family']; ?>;
  letter-spacing: <?php echo $be_themes_data['pb_module_spl_body']['letter-spacing']; ?>;
  font-style: <?php echo $be_themes_data['pb_module_spl_body']['font-style']; ?>;
  font-weight: <?php echo $be_themes_data['pb_module_spl_body']['font-weight']; ?>;
  text-transform: <?php echo $be_themes_data['pb_module_spl_body']['text-transform']; ?>;
}
#portfolio-title-nav-wrap{
  padding-top: <?php echo $be_themes_data['portfolio_title_bar_padding'];?>px;
  padding-bottom: <?php echo $be_themes_data['portfolio_title_bar_padding'];?>px;
  border-bottom: <?php echo be_themes_borders('portfolio_title_bar_border','bottom') ; ?>;
}

#portfolio-title-nav-bottom-wrap h6, 
#portfolio-title-nav-bottom-wrap ul li a, 
.single_portfolio_info_close {
  <?php be_themes_background_colors($be_themes_data['portfolio_title_nav_bg']['color'], $be_themes_data['portfolio_title_nav_bg']['alpha']); ?>
}
#portfolio-title-nav-bottom-wrap h6, 
#portfolio-title-nav-bottom-wrap ul li a, 
.single_portfolio_info_close .font-icon{
  color:  <?php echo $be_themes_data['portfolio_title_nav_text_color']; ?> ;
}
#portfolio-title-nav-bottom-wrap h6:hover,
#portfolio-title-nav-bottom-wrap ul li:hover a,
.single_portfolio_info_close:hover {
  <?php be_themes_background_colors($be_themes_data['portfolio_title_nav_hover_bg_color']['color'], $be_themes_data['portfolio_title_nav_hover_bg_color']['alpha']); ?>
}
#portfolio-title-nav-bottom-wrap h6:hover,
#portfolio-title-nav-bottom-wrap ul li:hover a,
.single_portfolio_info_close:hover .font-icon{
  color:  <?php echo $be_themes_data['portfolio_title_nav_text_hover_color']; ?> ;
}
/* ======================
    Layout 
   ====================== */


body #header-inner-wrap.top-animate #navigation, 
body #header-inner-wrap.top-animate .header-controls, 
body #header-inner-wrap.stuck #navigation, 
body #header-inner-wrap.stuck .header-controls {
	-webkit-transition: line-height 0.5s ease;
	-moz-transition: line-height 0.5s ease;
	-ms-transition: line-height 0.5s ease;
	-o-transition: line-height 0.5s ease;
	transition: line-height 0.5s ease;
}
	
.header-cart-controls .cart-contents span{
	background: <?php echo $be_themes_data['header_cart_count_background']; ?>;
}
.header-cart-controls .cart-contents span{
	color: <?php echo $be_themes_data['header_cart_count_color']; ?>;
}

.left-sidebar-page,
.right-sidebar-page, 
.no-sidebar-page .be-section-pad:first-child, 
.page-template-page-940-php #content , 
.no-sidebar-page #content-wrap, 
.portfolio-archives.no-sidebar-page #content-wrap {
    padding-top: 80px;
    padding-bottom: 80px;
}  
.no-sidebar-page #content-wrap.page-builder{
    padding-top: 0px;
    padding-bottom: 0px;
}
.left-sidebar-page .be-section:first-child, 
.right-sidebar-page .be-section:first-child, 
.dual-sidebar-page .be-section:first-child {
    padding-top: 0 !important;
}

<?php $padding = ('' != $be_themes_data['opt-logo-padding']) ? str_replace('px', '', $be_themes_data['opt-logo-padding']) : 20; ?>

.style1 .logo,
.style4 .logo,
#left-header-mobile .logo,
.style3 .logo{
  padding-top: <?php echo $padding.'px' ; ?>;
  padding-bottom: <?php echo $padding.'px' ; ?>;
}

.style5 .logo{
  margin-top: <?php echo $padding.'px' ; ?>;
  margin-bottom: <?php echo $padding.'px' ; ?>;
}
#footer-wrap {
  padding-top: <?php echo $be_themes_data['footer_padding']; ?>px;  
  padding-bottom: <?php echo $be_themes_data['footer_padding']; ?>px;  
}

/* ======================
    Colors 
   ====================== */


.sec-bg,
.gallery_content,
.fixed-sidebar-page .fixed-sidebar,
.style3-blog .blog-post.element .element-inner,
.style4-blog .blog-post,
.blog-post.format-link .element-inner,
.blog-post.format-quote .element-inner,
.woocommerce ul.products li.product, 
.woocommerce-page ul.products li.product,
.chosen-container.chosen-container-single .chosen-drop,
.chosen-container.chosen-container-single .chosen-single,
.chosen-container.chosen-container-active.chosen-with-drop .chosen-single {
  background: <?php echo $be_themes_data['sec_bg']; ?>;
}
.sec-color,
.post-meta a,
.pagination a, .pagination a:visited, .pagination span, .pages_list a,
input[type="text"], input[type="email"], input[type="password"],
textarea,
.gallery_content,
.fixed-sidebar-page .fixed-sidebar,
.style3-blog .blog-post.element .element-inner,
.style4-blog .blog-post,
.blog-post.format-link .element-inner,
.blog-post.format-quote .element-inner,
.woocommerce ul.products li.product, 
.woocommerce-page ul.products li.product,
.chosen-container.chosen-container-single .chosen-drop,
.chosen-container.chosen-container-single .chosen-single,
.chosen-container.chosen-container-active.chosen-with-drop .chosen-single {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}

.woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus,
.woocommerce .quantity input.qty, .woocommerce #content .quantity input.qty, .woocommerce-page .quantity input.qty, .woocommerce-page #content .quantity input.qty {
  background: <?php echo $be_themes_data['sec_bg']; ?>; 
  color: <?php echo $be_themes_data['sec_color']; ?>;
  border-color: <?php echo $be_themes_data['sec_border']; ?>;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li {
  color: <?php echo $be_themes_data['sec_color']; ?>!important;
}

.chosen-container .chosen-drop,
nav.woocommerce-pagination,
.summary.entry-summary .price,
.portfolio-details.style2 .gallery-side-heading-wrap {
  border-color: <?php echo $be_themes_data['sec_border']; ?> !important;
}

.fixed-sidebar-page #page-content{
  background: <?php echo $be_themes_data['tert_bg']; ?>; 
}


.sec-border,
input[type="text"], input[type="email"], input[type="tel"], input[type="password"],
textarea {
  border: 2px solid <?php echo $be_themes_data['sec_border']; ?>;
}
.chosen-container.chosen-container-single .chosen-single,
.chosen-container.chosen-container-active.chosen-with-drop .chosen-single {
  border: 2px solid <?php echo $be_themes_data['sec_border']; ?>;
}

.woocommerce table.shop_attributes th, .woocommerce-page table.shop_attributes th,
.woocommerce table.shop_attributes td, .woocommerce-page table.shop_attributes td {
    border: none;
    border-bottom: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
    padding-bottom: 5px;
}

.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content{
    border: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
.pricing-table .pricing-title,
.chosen-container .chosen-results li {
  border-bottom: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
.pricing-table .pricing-feature{
  font-size: <?php echo 1 - ($be_themes_data['body_text']['font-size']);?>px;
}

.separator {
  border:0;
  height:1px;
  color: <?php echo $be_themes_data['sec_border']; ?>;
  background-color: <?php echo $be_themes_data['sec_border']; ?>;
}


.alt-color,
li.ui-tabs-active h6 a,
#navigation a:hover,
#header-top-menu a:hover,
#navigation .current-menu-item > a,
#slidebar-menu .current-menu-item > a,
a,
a:visited,
.social_media_icons a:hover,
.post-title a:hover,
.fn a:hover,
a.team_icons:hover,
.recent-post-title a:hover,
.widget_nav_menu ul li.current-menu-item a,
.widget_nav_menu ul li.current-menu-item:before,
.filters .current_choice,
.woocommerce ul.cart_list li a:hover,
.woocommerce ul.product_list_widget li a:hover,
.woocommerce-page ul.cart_list li a:hover,
.woocommerce-page ul.product_list_widget li a:hover,
.woocommerce-page .product-categories li a:hover,
.woocommerce ul.products li.product .product-meta-data h3:hover,
.woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover,
td.product-name a:hover,
.woocommerce-page #content .quantity .plus:hover,
.woocommerce-page #content .quantity .minus:hover,
.post-category a:hover,
#navigation .sub-menu .current-menu-item > a,
#navigation .sub-menu a:hover,
#navigation .children .current-menu-item > a,
#navigation .children a:hover,
a.custom-like-button.liked,
#slidebar-menu .current-menu-item > a,
.menu-card-item-stared {
    color: <?php echo $be_themes_data['color_scheme']; ?>;
}

.content-slide-wrap .flex-control-paging li a.flex-active,
.content-slide-wrap .flex-control-paging li.flex-active a:before {
  background: <?php echo $be_themes_data['color_scheme']; ?> !important;
  border-color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

#navigation .mega .sub-menu .highlight .sf-with-ul{
 <?php be_themes_print_typography('navigation_text'); ?>;
 color: <?php echo $be_themes_data['submenu_text']['color'] ; ?> !important;
}
#navigation .menu > ul > li.mega > ul > li {
  border-color: <?php echo $be_themes_data['sub_menu_border']; ?>;
}
<?php if (($be_themes_data['left_side_menu_border'] != '') && ($be_themes_data['left_side_menu_border'] != 'transparent') && ($be_themes_data['opt-header-type'] == 'left')){ ?>
  .sb-slidebar.sb-left .menu {
    border-top: 1px solid <?php echo $be_themes_data['left_side_menu_border']; ?>;
    border-bottom: 1px solid <?php echo $be_themes_data['left_side_menu_border']; ?>;
  }<?php }
?>

<?php if (($be_themes_data['right_side_menu_border'] != '') && ($be_themes_data['right_side_menu_border'] != 'transparent') && ($be_themes_data['opt-header-type'] == 'top')){ ?>
  .sb-slidebar.sb-right .menu{
    border-top: 1px solid <?php echo $be_themes_data['right_side_menu_border']; ?>;
    border-bottom: 1px solid <?php echo $be_themes_data['right_side_menu_border']; ?>;
}<?php }
?>

.post-title a:hover {
    color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.alt-bg,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.widget_tag_cloud a:hover,
.pagination .current {
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    transition: 0.2s linear all;
}
.mejs-controls .mejs-time-rail .mejs-time-current ,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.woocommerce span.onsale, 
.woocommerce-page span.onsale, 
.woocommerce a.add_to_cart_button.button.product_type_simple.added,
.woocommerce-page .widget_shopping_cart_content .buttons a.button:hover,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li a:focus,
.testimonial-flex-slider .flex-control-paging li a.flex-active,
#back-to-top,
.be-carousel-nav,
.more-link.style3-button,
.view-project-link.style3-button {
  background: <?php echo $be_themes_data['color_scheme']; ?> !important;
}
.tagcloud a:hover,
.testimonial-flex-slider .flex-control-paging li a.flex-active,
.testimonial-flex-slider .flex-control-paging li a {
  border-color: <?php echo $be_themes_data['color_scheme']; ?>;
}
a.be-button.view-project-link,
.more-link {
  border-color: <?php echo $be_themes_data['color_scheme'];  ?>; 
}

<?php
  $overlay_color = be_themes_hexa_to_rgb( $be_themes_data['color_scheme'] );
?>

.portfolio-container .thumb-bg {
  background-color: <?php echo 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].',0.85)'; ?>;
}

.photostream_overlay,
.be-button,
.more-link.style3-button,
.view-project-link.style3-button,
input[type="button"], input[type="submit"], input[type="reset"], input[type="file"]::-webkit-file-upload-button, button {
	background-color: <?php echo $be_themes_data['color_scheme']; ?>;
}
.alt-bg-text-color,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.widget_tag_cloud a:hover,
.pagination .current,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li a:focus,
#back-to-top,
.be-carousel-nav,
.single_portfolio_close .font-icon, 
.single_portfolio_back .font-icon,
.more-link.style3-button,
.view-project-link.style3-button {
    color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
    transition: 0.2s linear all;
}

.be-button,
input[type="button"], input[type="submit"], input[type="reset"], input[type="file"]::-webkit-file-upload-button, button {
	color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
	transition: 0.2s linear all;
}

.portfolio-title a {
    color: inherit;
}




.arrow-block .arrow_prev,
.arrow-block .arrow_next {
    <?php be_themes_background_colors($be_themes_data['slider_nav_bg']['color'], $be_themes_data['slider_nav_bg']['alpha']); ?>
} 

.arrow-border .arrow_prev,
.arrow-border .arrow_next {
    border: 1px solid <?php echo $be_themes_data['slider_nav_bg']['color']; ?>;
} 

.gallery-info-box-wrap .arrow_prev .font-icon,
.gallery-info-box-wrap .arrow_next .font-icon {
  color: <?php echo $be_themes_data['slider_nav_color']; ?>;
}

.arrow-block .arrow_prev:hover,
.arrow-block .arrow_next:hover {
  <?php be_themes_background_colors($be_themes_data['slider_nav_hover_bg']['color'], $be_themes_data['slider_nav_hover_bg']['alpha']); ?>
}

.arrow-border .arrow_prev:hover,
.arrow-border .arrow_next:hover {
    border: 1px solid <?php echo $be_themes_data['slider_nav_hover_bg']['color']; ?>;
} 

.gallery-info-box-wrap .arrow_prev:hover .font-icon,
.gallery-info-box-wrap .arrow_next:hover .font-icon {
  color: <?php echo $be_themes_data['slider_nav_hover_color']; ?>;
}

<?php $border_layout_width = 30; ?>
#back-to-top.layout-border,
#back-to-top.layout-border-header-top {
  right: <?php echo ($border_layout_width+20); ?>px;
  bottom: <?php echo ($border_layout_width+20); ?>px;
}
.layout-border .fixed-sidebar-page #right-sidebar.active-fixed {
    right: <?php echo $border_layout_width; ?>px;
}
body.header-transparent.admin-bar .layout-border #header #header-inner-wrap.no-transparent.top-animate, 
body.sticky-header.admin-bar .layout-border #header #header-inner-wrap.no-transparent.top-animate {
  top: <?php echo ($border_layout_width+32); ?>px;
}
body.header-transparent .layout-border #header #header-inner-wrap.no-transparent.top-animate, 
body.sticky-header .layout-border #header #header-inner-wrap.no-transparent.top-animate {
  top: <?php echo ($border_layout_width); ?>px;
}
body.header-transparent.admin-bar .layout-border.layout-border-header-top #header #header-inner-wrap.no-transparent.top-animate, 
body.sticky-header.admin-bar .layout-border.layout-border-header-top #header #header-inner-wrap.no-transparent.top-animate {
  top: 32px;
  z-index: 15;
}
body.header-transparent .layout-border.layout-border-header-top #header #header-inner-wrap.no-transparent.top-animate, 
body.sticky-header .layout-border.layout-border-header-top #header #header-inner-wrap.no-transparent.top-animate {
  top: 0px;
  z-index: 15;
}
body.header-transparent .layout-border #header #header-inner-wrap.no-transparent #header-wrap, 
body.sticky-header .layout-border #header #header-inner-wrap.no-transparent #header-wrap {
  margin: 0px <?php echo ($border_layout_width); ?>px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  position: relative;
}
.mfp-content.layout-border img {
  padding: <?php echo ($border_layout_width+40); ?>px 0px <?php echo ($border_layout_width+40); ?>px 0px;
}
body.admin-bar .mfp-content.layout-border img {
  padding: <?php echo ($border_layout_width+72); ?>px 0px <?php echo ($border_layout_width+40); ?>px 0px;
}
.mfp-content.layout-border .mfp-bottom-bar {
  margin-top: -<?php echo ($border_layout_width+30); ?>px;
}
body .mfp-content.layout-border .mfp-close {
  top: <?php echo ($border_layout_width); ?>px;
}
body.admin-bar .mfp-content.layout-border .mfp-close {
  top: <?php echo ($border_layout_width+32); ?>px;
}
pre {
    background-image: -webkit-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['background-color']; ?> 0px, <?php echo $be_themes_data['content']['background-color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -moz-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['background-color']; ?> 0px, <?php echo $be_themes_data['content']['background-color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -ms-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['background-color']; ?> 0px, <?php echo $be_themes_data['content']['background-color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -o-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['background-color']; ?> 0px, <?php echo $be_themes_data['content']['background-color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: repeating-linear-gradient(top, <?php echo $be_themes_data['content']['background-color']; ?> 0px, <?php echo $be_themes_data['content']['background-color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    display: block;
    line-height: 28px;
    margin-bottom: 50px;
    overflow: auto;
    padding: 0px 10px;
    border:1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
<?php if($be_themes_data['textbox_style'] == 'style2') { ?>
    input[type="text"], input[type="email"], input[type="password"], textarea, select {
      border: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
      background: <?php echo $be_themes_data['sec_bg']; ?>;
    }
<?php } ?>

@media only screen and (max-width : 767px ) {
    #hero-section h1 , 
    .full-screen-section-wrap h1 {
      font-size: 30px;
      line-height: 40px;
    }
    #hero-section h2,
    .full-screen-section-wrap h2 { 
      font-size: 25px;
      line-height: 35px;
    }
    #hero-section h4,
    .full-screen-section-wrap h4 {
      font-size: 16px;
      line-height: 30px;
    }
    #hero-section h5,
    .full-screen-section-wrap h5 {
      font-size: 16px;
      line-height: 30px;
    }    
}
.loader-style1-double-bounce1, .loader-style1-double-bounce2,
.loader-style2-wrap,
.loader-style3-wrap > div,
.loader-style5-wrap .dot1, .loader-style5-wrap .dot2,
#nprogress .bar {
  background: <?php echo $be_themes_data['color_scheme']; ?> !important; 
}
.loader-style4-wrap {
  <?php $loader_color = be_themes_hexa_to_rgb( $be_themes_data['color_scheme'] ); ?>
  border-top: 7px solid rgba(<?php echo $loader_color[0].', '.$loader_color[1].', '.$loader_color[2]; ?> , 0.3);
  border-right: 7px solid rgba(<?php echo $loader_color[0].', '.$loader_color[1].', '.$loader_color[2]; ?> , 0.3);
  border-bottom: 7px solid rgba(<?php echo $loader_color[0].', '.$loader_color[1].', '.$loader_color[2]; ?> , 0.3);
  border-left-color: <?php echo $be_themes_data['color_scheme']; ?>; 
}

#nprogress .spinner-icon {
  border-top-color: <?php echo $be_themes_data['color_scheme']; ?> !important; 
  border-left-color: <?php echo $be_themes_data['color_scheme']; ?> !important; 
}
#nprogress .peg {
  box-shadow: 0 0 10px <?php echo $be_themes_data['color_scheme']; ?>, 0 0 5px <?php echo $be_themes_data['color_scheme']; ?> !important;
}
.single-page-version #navigation .current_page_item a,
.single-page-version #navigation .sub-menu .current-menu-item > a,
.single-page-version #navigation .children .current-menu-item > a {
  color: inherit !important;
}
<?php extract(be_themes_calculate_logo_height()); ?>
<?php extract(be_themes_calculate_logo_width()); ?>

.style1 #navigation,
.style3 #navigation,
.style5 #navigation, 
#header-controls-left,
#header-controls-right,
#header-wrap,
.mobile-nav-controller-wrap,
#left-header-mobile .header-cart-controls,
.style6 #navigation-left-side,
.style6 #navigation-right-side,
.overlay-menu-close {
	line-height: <?php echo $logo_height; ?>px;
}
body.header-transparent #header-wrap #navigation,
body.header-transparent #header-wrap #navigation-left-side,
body.header-transparent #header-wrap #navigation-right-side,
body.header-transparent #header-inner-wrap .header-controls, 
body.header-transparent #header-inner-wrap .mobile-nav-controller-wrap,
body.header-transparent .overlay-menu-close {
	line-height: <?php echo $logo_transparent_height; ?>px;
}
body #header-inner-wrap.top-animate #navigation,
body #header-inner-wrap.top-animate #navigation-left-side,
body #header-inner-wrap.top-animate #navigation-right-side,
body #header-inner-wrap.top-animate .header-controls,
body #header-inner-wrap.top-animate #header-wrap,
body #header-inner-wrap.top-animate #header-controls-right {
	line-height: <?php echo $logo_sticky_height; ?>px;
}
@media only screen and (min-width: 768px) and (max-width: 959px) {
  .style1 #navigation,
  .style3 #navigation,
  .style5 #navigation, 
  #header-controls-left,
  #header-controls-right,
  #header-wrap,
  .mobile-nav-controller-wrap,
  #left-header-mobile .header-cart-controls,
  .style6 #navigation-left-side,
  .style6 #navigation-right-side,
  .overlay-menu-close {
    <?php
      if(480 < $logo_width) {
        $line_height = $logo_height / $logo_width * 480;
        echo 'line-height: '.$line_height.'px !important;';
      }
    ?> 
    max-height: 100%;
  }
  .logo {
    <?php
      if(480 < $logo_width) {
        $line_height = $logo_height / $logo_width * 480;
        echo 'width: 50%';
      }
    ?>
  }
}
@media only screen and (max-width: 767px) {
  .style1 #navigation,
  .style3 #navigation,
  .style5 #navigation, 
  #header-controls-left,
  #header-controls-right,
  #header-wrap,
  .mobile-nav-controller-wrap,
  #left-header-mobile .header-cart-controls,
  .style6 #navigation-left-side,
  .style6 #navigation-right-side,
  .overlay-menu-close {
    <?php
      if(240 < $logo_width) {
        $line_height = $logo_height / $logo_width * 240;
        echo 'line-height: '.$line_height.'px !important;';
      }
    ?>
    max-height: 100%;

  }
  .logo {
    <?php
      if(480 < $logo_width) {
        $line_height = $logo_height / $logo_width * 480;
        echo 'width: 50%';
      }
    ?>
  }
}
@media only screen and (min-width: 480px) and (max-width: 767px) {
  .style1 #navigation,
  .style3 #navigation,
  .style5 #navigation, 
  #header-controls-left,
  #header-controls-right,
  #header-wrap,
  .mobile-nav-controller-wrap,
  #left-header-mobile .header-cart-controls,
  .style6 #navigation-left-side,
  .style6 #navigation-right-side,
  .overlay-menu-close {
    <?php
      if(383 < $logo_width) {
        $line_height = $logo_height / $logo_width * 383;
        echo 'line-height: '.$line_height.'px !important;';
      }
    ?>
    max-height: 100%;

  }
}
/*  Optiopn Panel Css */
<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_css'],ENT_QUOTES));  ?>


#bbpress-forums li.bbp-body ul.forum, 
#bbpress-forums li.bbp-body ul.topic {
  border-top: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
#bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results {
  border: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
#bbpress-forums li.bbp-header, 
#bbpress-forums li.bbp-footer,
.menu-card-item.highlight-menu-item {
  background: <?php echo $be_themes_data['sec_bg']; ?>;
}
a.bbp-forum-title,
#bbpress-forums fieldset.bbp-form label,
.bbp-topic-title a.bbp-topic-permalink {
  <?php be_themes_print_typography('h6'); ?>
 /* font: inherit;
  line-height: inherit;
  letter-spacing: inherit;
  text-transform: inherit; */
}
#bbpress-forums ul.forum-titles li,
#bbpress-forums ul.bbp-replies li.bbp-header {
  <?php be_themes_print_typography('h6'); ?>
  line-height: inherit;
  letter-spacing: inherit;
  text-transform: uppercase;
  font-size: inherit;
}
#bbpress-forums .topic .bbp-topic-meta a, 
.bbp-forum-freshness a,
.bbp-topic-freshness a,
.bbp-header .bbp-reply-content a,
.bbp-topic-tags a,
.bbp-breadcrumb a,
.bbp-forums-list a {
  color: <?php echo $be_themes_data['h6']['color']; ?>;
}
#bbpress-forums .topic .bbp-topic-meta a:hover,
.bbp-forum-freshness a:hover,
.bbp-topic-freshness a:hover,
.bbp-header .bbp-reply-content a:hover,
.bbp-topic-tags a:hover,
.bbp-breadcrumb a:hover,
.bbp-forums-list a:hover {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
div.bbp-reply-header,
.bar-style-related-posts-list,
.menu-card-item {
  border-color: <?php echo $be_themes_data['sec_border']; ?>;
}

/*Event On Plugin*/

.ajde_evcal_calendar .calendar_header p, .eventon_events_list .eventon_list_event .evcal_cblock {
    font-family: <?php echo $be_themes_data['h1']['font-family']; ?> !important;
}
.eventon_events_list .eventon_list_event .evcal_desc span.evcal_desc2, .evo_pop_body .evcal_desc span.evcal_desc2 {
  font-family: <?php echo $be_themes_data['h6']['font-family']; ?> !important;
  font-size: 14px !important;
  text-transform: none;
}
.eventon_events_list .eventon_list_event .evcal_desc span.evcal_event_subtitle, .evo_pop_body .evcal_desc span.evcal_event_subtitle,
.evcal_evdata_row .evcal_evdata_cell p, #evcal_list .eventon_list_event p.no_events {
  text-transform: none !important;
  font-family: <?php echo $be_themes_data['body_text']['font-family']; ?> !important;
  font-size: inherit !important;
}
#evcal_list .eventon_list_event .evcal_desc span.evcal_event_title, .eventon_events_list .evcal_event_subtitle {
  padding-bottom: 10px !important;
}
.eventon_events_list .eventon_list_event .evcal_desc, .evo_pop_body .evcal_desc, #page-content p.evcal_desc {
  padding-left: 100px !important;
}
.evcal_evdata_row {
  background: <?php echo $be_themes_data['sec_bg']; ?> !important;
}
.eventon_events_list .eventon_list_event .event_description {
  background: <?php echo $be_themes_data['sec_bg']; ?> !important;
  border-color: <?php echo $be_themes_data['sec_border']; ?> !important;
}
.bordr,
#evcal_list .bordb {
  border-color: <?php echo $be_themes_data['sec_border']; ?> !important; 
}
.evcal_evdata_row .evcal_evdata_cell h3 {
  margin-bottom: 10px !important;
}