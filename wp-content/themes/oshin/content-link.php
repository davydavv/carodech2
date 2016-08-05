<?php
	$link = get_post_meta(get_the_ID(),'be_themes_link_format',true);
	if( !isset( $link ) || empty( $link ) ) {
		$link = '#';
	}
?>
<div class="clearfix post-title-section-wrap">
	<div class="left post-date-wrap">
		<i class="font-icon icon-link"></i>
	</div>
	<div class="left post-title-section">
		<?php
			echo '<h5 class="post-title"><a href="'.$link.'" target="_blank">'.get_the_title().'</a></h5>';
			echo ( $link != '#' ) ? '<span class="post-custom-meta">- '.$link.'</span>' : '';
		?>
	</div>
</div>