<?php
	if(is_page_template('portfolio.php')) {
		$meta = 'be_themes_portfolio_show_info_box';
	} else {
		$meta = 'be_themes_single_show_info_box';
	}
	global $be_themes_data;
	$show_info_box = get_post_meta( get_the_ID(), $meta, true );
	$info_box = ($show_info_box == 1) ? 'show-info-box' : 'hide-info-box';
	$portfolio_title_nav = get_post_meta( get_the_ID(), 'be_themes_portfolio_title_nav', true);
	$portfolio_home_page = get_post_meta( get_the_ID(), 'be_themes_portfolio_home_page', true); //Get link from Meta Options
	$portfolio_home_page = ($portfolio_home_page == '' ? $be_themes_data['portfolio_home_page'] : $portfolio_home_page) ; //Get link from Options panel if not present in Meta Options is not present
	$portfolio_catg_traversal = (1 == get_post_meta( get_the_ID(), 'be_themes_traverse_catg', true) ? true : false);
	$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
?>
<div class="gallery-info-box-wrap <?php echo $info_box; ?>">
	<span class="arrow_prev"><i class="font-icon icon-arrow_carrot-left"></i></span>
	<span class="arrow_next"><i class="font-icon icon-arrow_carrot-right"></i></span>
	<?php
		if($show_info_box == 1) { ?>
			<div class="gallery_content">
				<div class="gallery_content_area_wrap">
					<div class="gallery_content_area">
						<div class="gallery_scrollable_content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<span class="single_portfolio_info_close"><i class="font-icon icon-icon_menu"></i></span>
			</div> <?php
		}
		if ((isset($portfolio_title_nav) && 1 == $portfolio_title_nav) && (('style1' == $single_portfolio_style) ||('style2' == $single_portfolio_style) ||('style3' == $single_portfolio_style) || ('style4' == $single_portfolio_style))) { ?>
			<div id="portfolio-title-nav-bottom-wrap" class="clearfix">
				<h6 class="portfolio-title-nav-bottom"><?php echo get_the_title(); ?></h6>
				<ul class="portfolio-nav-bottom">
					<!-- Previous Post Link -->
					<li>
					<?php if($portfolio_catg_traversal == true) {
						next_post_link('%link','<i class="font-icon icon-arrow_left"></i>',true,' ','portfolio_categories'); 
					}else {
						next_post_link('%link','<i class="font-icon icon-arrow_left"></i>'); 
					}?>
					</li>
					<!-- Home Page Grid -->
					<?php if ($portfolio_home_page != '') { ?>
						<li><a href="<?php echo esc_url( $portfolio_home_page ); ?>" class="font-icon icon-icon_grid-2x2	"></a></li><?php
					}?>
					<!-- Next Post Link -->
					<li>
					<?php if($portfolio_catg_traversal == true) {
						previous_post_link('%link','<i class="font-icon icon-arrow_right"></i>',true,' ','portfolio_categories'); 
					}else {
						previous_post_link('%link','<i class="font-icon icon-arrow_right"></i>'); 
					}?>
					</li>

				</ul>
			</div>	<?php
		} ?>
</div>
