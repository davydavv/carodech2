<?php
/**
* The template for displaying Category Archive pages.
* 
*/
?>
<?php 
get_header(); 
global $be_themes_data;
get_template_part( 'page-breadcrumb' );
if(isset($be_themes_data['portfolio_style']) && !empty($be_themes_data['portfolio_style'])) {
	$portfolio_style = $be_themes_data['portfolio_style'];
} else {
	$portfolio_style = 'portfolio';
}
?>
<section id="content" class="portfolio-archives <?php echo ($portfolio_style != 'portfolio_full_screen') ? 'no-sidebar-page' : ''; ?>">
	<div id="content-wrap" class="clearfix <?php echo ($portfolio_style == 'portfolio') ? 'be-wrap' : ''; ?>"> 
		<section id="page-content" class="content-no-sidebar">
			<div class="clearfix">
				<?php
					$term =	$wp_query->queried_object;
					if( have_posts() ) :
						if(isset($be_themes_data['portfolio_col']) && !empty($be_themes_data['portfolio_col'])) {
							$portfolio_col = $be_themes_data['portfolio_col'];
						} else {
							$portfolio_col = 'three';
						}
						if(isset($be_themes_data['portfolio_hover']) && !empty($be_themes_data['portfolio_hover'])) {
							$portfolio_hover_color = $be_themes_data['portfolio_hover']['color'];
						} else {
							$portfolio_hover_color = $be_themes_data['color_scheme'];
						}
						if(isset($be_themes_data['portfolio_hover']) && !empty($be_themes_data['portfolio_hover'])) {
							$portfolio_hover_opacity = $be_themes_data['portfolio_hover']['alpha'];
						} else {
							$portfolio_hover_opacity = 80;
						}
						if($portfolio_style == 'portfolio' && $portfolio_col == 'five') {
							$portfolio_col = 'three';
						}
						if(($portfolio_style == 'portfolio_full_screen' || $portfolio_style == 'portfolio_full_screen_with_gutter') && $portfolio_col == 'two') {
							$portfolio_col = 'three';
						}
						if($portfolio_style == 'portfolio_full_screen') {
							$gutter_width = 0 ;
						}else {
							$gutter_width = 30 ;
						}					
						echo do_shortcode('[portfolio col= "'.$portfolio_col.'" gutter_width = "'.$gutter_width.'" show_filters= "no" filter = "categories" tax_name="portfolio_categories" category= "'.$term->slug.'" items_per_page="-1" pagination="none" overlay_color= "'.$portfolio_hover_color.'"]');
					else:
						echo '<p class="inner-content">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
					endif;
				?>
			</div>
		</section>
	</div>
</section>
<?php get_footer(); ?>