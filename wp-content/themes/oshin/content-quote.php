<div class="clearfix post-title-section-wrap">
	<div class="left post-date-wrap">
		<i class="font-icon icon-quote"></i>
	</div>
	<div class="left post-title-section">
		<?php 
			$quote_author = get_post_meta(get_the_ID(),'be_themes_quote_author',true);
			echo '<h5 class="post-title"><a href="#">'.get_the_title().'</a></h5>';
			echo ( isset($quote_author) && !empty($quote_author) ) ? '<span class="post-custom-meta">- '.$quote_author.'</span>' : '';
		?>
	</div>
</div>