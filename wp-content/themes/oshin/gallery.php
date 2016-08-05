<?php
/*
 *
 * Template Name: Gallery
 *
*/
$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
if(!isset($single_portfolio_style) || empty($single_portfolio_style)) {
	$single_portfolio_style = 'style1';
}
get_header();
	while (have_posts() ) : the_post();
		get_template_part( 'portfolio/single', $single_portfolio_style );
	endwhile;
get_footer();