<?php
	global $be_themes_data;
	if(!isset($be_themes_data['slider_navigation_style']) || empty($be_themes_data['slider_navigation_style'])) {
		$arrow_style = 'style1-arrow';
	} else {
		$arrow_style = $be_themes_data['slider_navigation_style'];
	}
	if($arrow_style == 'style1-arrow' || $arrow_style == 'style3-arrow' || $arrow_style == 'style5-arrow'){
		$arrow_style_class = 'arrow-block';
	}else{
		$arrow_style_class = 'arrow-border';
	}
?>
<?php 
	if ( post_password_required( get_the_ID() ) ) {
		$content  = get_the_password_form();
	    echo '<div class="be-wrap clearfix be-password-protect-wrap">'.$content.'</div>';
	} else { ?>	
<div id="content" class="gallery-all-container resized <?php echo $arrow_style_class .' '. $arrow_style; ?>">	
	<div id="gallery-container-wrap" class="clearfix">
		<div id="gallery-container">
			<?php
				$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images');			
				if(!empty($attachments)) {				
					foreach ( $attachments as $attachment_id ) {					
						$attach_img = wp_get_attachment_image_src($attachment_id, 'full');					
						$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);					
						if($video_url) {						
							$data_source = 'video';					
						} else {						
							$data_source = $attach_img[0];					
						}					
						echo '<div class="placeholder style3_placehloder load center show-title" data-source="'.$data_source.'">';					
						if($video_url) {						
							echo be_gal_video($video_url);					
						}
						$attachment_details = be_wp_get_attachment($attachment_id);
						if(isset($attachment_details['description']) && !empty($attachment_details['description'])) {
							$external_link = get_post_meta( $attachment_id, 'be_themes_external_link', true );
							if(!isset($external_link) || empty($external_link)) {
								$external_link = '#';
							}
							echo '<div class="attachment-details attachment-details-custom-slider special-subtitle animated"><a href="'.$external_link.'" target="_blank">'.$attachment_details['description'].'</a></div>';
						}
						echo '</div>';				
					}			
				}
			?>
		</div>
	</div>
	<?php 
		get_template_part( 'portfolio/gallery', 'content' );
		be_slider_carousel();
	?>
</div>
<?php } ?>