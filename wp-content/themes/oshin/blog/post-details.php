<?php global $meta_sep, $be_themes_data; ?>
<nav class="post-nav meta-font secondary_text">
	<?php if($be_themes_data['blog_style'] != 'style7'){?>
	<ul class="clearfix">
		<li class="post-meta post-author"><?php _e('Posted By :','be-themes'); ?> <?php echo get_the_author(); ?><span class="post-meta-sep">/</span></li>		
		<li class="post-meta post-comments">
			<a href="<?php comments_link(); ?>"><?php comments_number('0','1','%');?> <?php _e(' comments','be-themes'); ?></a> <span class="post-meta-sep">/</span> 
		</li>
		<li class="post-meta post-category"><?php _e('Under :','be-themes'); ?><?php be_themes_category_list($id); ?> </li>
	</ul>
	<?php } 
	else{?>
	<ul class="clearfix">
		<li class="post-meta special-subtitle post-author"><?php _e('Posted By ','be-themes'); ?> <?php echo get_the_author(); ?><span class="post-meta-sep"> </span></li>		
		<li class="post-meta special-subtitle post-date"><?php _e(' on ','be-themes'); ?><a href="'.get_permalink().'" ><?php echo get_the_date('F j,Y'); ?></a></li>
	</ul>
	<?php 
	}
	?>
</nav>