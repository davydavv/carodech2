<?php
/*
Plugin Name: BE Page Builder
Plugin URI: http://www.brandexponents.com
Description: A minimal and beautiful Visual layout builder for Wordpress by Brand Exponents
Author: Brandexponents
Version: 4.5.1
Author URI: http://www.brandexponents.com
*/
//load_textdomain( 'be-themes', false, BE_PB_ROOT_PATH. 'languages' ); 
$fslashed_dir = trailingslashit(str_replace('\\','/',dirname(__FILE__)));
$fslashed_abs = trailingslashit(str_replace('\\','/',ABSPATH));
if(!defined('BE_PAGE_BUILDER_DIR')){
	define('BE_PAGE_BUILDER_DIR', $fslashed_dir);
}
if(!defined('BE_PAGE_BUILDER_URL')){
	define('BE_PAGE_BUILDER_URL', site_url(str_replace( $fslashed_abs, '', $fslashed_dir )));
}


define('BE_PB_ROOT_PATH', plugin_dir_path(__FILE__));
define('BE_PB_ROOT_URL', plugin_dir_url(__FILE__));

require_once( BE_PB_ROOT_PATH.'be-pb-options.php' );
require_once( BE_PB_ROOT_PATH.'be-pb-backend-output.php' );

add_action( 'plugins_loaded', 'bepagebuilder_load_textdomain' );

add_action( 'init' , 'be_pb_include_shortcodes' );
function be_pb_include_shortcodes() {
	require_once( BE_PB_ROOT_PATH.'functions/shortcodes.php' );
	// require_once( BE_PB_ROOT_PATH.'functions/helpers.php' );
	// require_once( BE_PB_ROOT_PATH.'functions/be-pb-ajax-handler.php' );
}
add_action( 'plugins_loaded' , 'be_pb_include_helpers' );
function be_pb_include_helpers() {
	require_once( BE_PB_ROOT_PATH.'functions/helpers.php' );
	require_once( BE_PB_ROOT_PATH.'functions/be-pb-ajax-handler.php' );
}
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function bepagebuilder_load_textdomain() {
 	load_plugin_textdomain( 'be-themes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	//load_textdomain( 'be-themes', false, BE_PB_ROOT_URL. 'languages' ); 
}

global $row_controls;
global $section_controls;
global $blank_row;
global $blank_section;
global $paste_shortcode_name;

				
$row_controls = '<div class="be-pb-row-controls clearfix toggled">
					<div class="left row-column-controls">
					      <a class="med-btn mini-btn-light btn-icon-one-col-wrap" title="one" role="button" data-col-name="one_col" data-col-count="1">
						      <span class="btn-icon-one-col">Full</span>
  						  </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-half-wrap" title="1/2" role="button" data-col-name="one_half" data-col-count="2">
					      	<span class="btn-icon-one-half">One Half</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-third-wrap" title="1/3" role="button" data-col-name="one_third" data-col-count="3">
					      	<span class="btn-icon-one-third">One Third</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-fourth-wrap" title="1/4" role="button" data-col-name="one_fourth" data-col-count="4">
					      	<span class="btn-icon-one-fourth">One Fourth</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-fifth-wrap" title="1/5" role="button" data-col-name="one_fifth" data-col-count="5">
					      	<span class="btn-icon-one-fifth">One Fifth</span>
					      </a>					      
  						  <a class="med-btn mini-btn-light btn-icon-two-third-wrap" title="2/3" role="button" data-col-name="two_third" data-col-count="2">
					      	<span class="btn-icon-two-third">Two third</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-three-fourth-wrap" title="3/4" role="button" data-col-name="three_fourth" data-col-count="2">
					      	<span class="btn-icon-three-fourth">Three Fourth</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-half-fourth-wrap" title="1/2-1/4" role="button" data-col-name="one_half_fourth" data-col-count="3">
					      	<span class="btn-icon-one-half-fourth">Mixed Columns</span>
					      </a>					      
					 </div>
						<div class="right row-controls">
							<a class="med-btn mini-btn-light copy-shortcode" title="Copy" data-action="copy">
								<span class="btn-icon-row-view"><i class="font-icon icon-download icon-be-pb-download"></i>Copy Row</span>
							</a>
							<a class="med-btn mini-btn-light" title="Duplicate" data-action="duplicate">
								<span class="btn-icon-row-duplicate"><i class="font-icon  icon-icon_documents_alt icon-be-pb-book-open"></i>Duplicate Row</span>
							</a>
							<a class="med-btn mini-btn-light edit-shortcode" title="Edit" data-action="edit"  data-shortcode="row">
								<span class="btn-icon-row-edit"><i class="font-icon icon-icon_pencil-edit icon-be-pb-cog"></i>Edit Row</span>
							</a>   						  
							<a class="med-btn mini-btn-light" title="Delete" data-action="delete">
								<span class="btn-icon-row-delete"><i class="font-icon icon-icon_trash_alt icon-be-pb-cancel"></i>Delete Row</span>
							</a>						 		
						</div>   
				</div>';

$section_controls = '<div class="be-pb-section-controls clearfix toggled">
						<div class="section-header clearfix">
							<div class="section-controls">
								<a class="med-btn mini-btn-light copy-shortcode" title="Copy" data-action="view">
									<span class="btn-icon-section-view"><i class="font-icon icon-download icon-be-pb-download"></i>Copy Section</span>
								</a>
								<a class="med-btn mini-btn-light" title="Duplicate" data-action="duplicate">
									<span class="btn-icon-section-duplicate"><i class="font-icon icon-duplicate icon-paste icon-icon_documents_alt icon-be-pb-book-open"></i>Duplicate Section</span>
								</a>
								<a class="med-btn mini-btn-light edit-shortcode" title="Edit" data-action="edit"  data-shortcode="section">
									<span class="btn-icon-section-edit"><i class="font-icon icon-icon_pencil-edit icon-be-pb-cog"></i>Edit Section</span>
								</a>      						  
								<a class="med-btn mini-btn-light" title="Delete" data-action="delete">
									<span class="btn-icon-section-delete"><i class="font-icon icon-icon_trash_alt icon-be-pb-cancel"></i>Delete Section</span>
								</a>
							</div>
						</div>
					</div>';

$blank_row = '<div class="be-pb-row-wrap be-pb-element clearfix be-pb-module-wrap">
	    				'.$row_controls.'
	    				<pre class="shortcode">[row]</pre>
						<div class="be-pb-row be-pb-sortable clearfix">
							<div class="portlet be-pb-element be-pb-col-wrap one_col" data-col-name="one_col">
								<pre class="shortcode">[one_col]</pre>
								<div class="be-pb-column be-pb-shortcode-col"></div>
								<div class="be-pb-controls">
									<a class="mini-btn mini-btn-dark choose-shortcode" title="Add" role="button">
										<span class="btn-icon-plus"><i class="font-icon icon-be-pb-plus"></i></span>
									</a>
									<a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="module" title="Paste Module" role="button">
										<span class="btn-icon-plus"><i class="font-icon icon-be-pb-upload"></i></span>
									</a>
									<a class="mini-btn mini-btn-dark edit-column-btn" title="Edit Module" role="button">
										<span class="be-pb-control-icon icon-icon_pencil-edit icon-edit edit-shortcode  column-edit-control icon-be-pb-pencil-1" title="Edit" data-shortcode="one_col" data-action="edit"></span>
									</a>
								</div>
								<pre class="shortcode">[/one_col]</pre>
							</div>	
						</div>
						<pre class="shortcode">[/row]</pre>
				</div>';

$blank_section = '<div class="be-pb-section-wrap be-pb-element clearfix be-pb-module-wrap">
								'.$section_controls.'
								<pre class="shortcode">[section padding_top="90" padding_bottom="90"]</pre>	
								<div class="be-pb-section-inner-wrap"><div class="be-pb-section">
									'.$blank_row.'
								</div><a href="#" class="bluefoose-button-dark be-pb-add-row">Add Row</a><a href="#" class="bluefoose-button-dark be-pb-paste-row" data-shortcode-name="row">Paste Row</a></div>
							 	<pre class="shortcode">[/section]</pre>	
						</div>';													

function get_shortcode_form() {
	global $be_shortcode;
	extract($_POST);
	if(!array_key_exists('options', $be_shortcode[$shortcode]) && empty($be_shortcode[$shortcode]['options'])) {
		get_shortcode_block($shortcode, $be_shortcode[$shortcode]['type']);
	}
	else {
		be_pb_print_form($shortcode);
	}
	die();
}

function get_multi_shortcode_block($shortcode_name, $output = '', $inner_shortcode ='') {
	global $be_shortcode;
	$hide = '';
	if(!array_key_exists('options', $be_shortcode[$shortcode_name]) && empty($be_shortcode[$shortcode_name]['options'])) {
		$hide = 'hidden';
	}
	$html = '';
	$html .= '<div class="be-pb-multi-wrap be-pb-element toggled be-pb-module-wrap" data-shortcode="'.$shortcode_name.'">';
	$html .= '<pre class="shortcode">'.$output.'</pre>';
	$html .= '<div class="be-pb-multi-fields-header-wrap clearfix"><h4 class="clearfix"><div class="left">'.$be_shortcode[$shortcode_name]['name'].'</div><span class="be-pb-control-icon icon-icon_trash_alt icon-delete icon-be-pb-cancel icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-icon_documents_alt icon-be-pb-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-icon_pencil-edit edit-shortcode icon-be-pb-pencil-1 '.$hide.'" title="Edit" data-shortcode="'.$shortcode_name.'" data-action="edit"></span><span class="be-pb-control-icon icon-download copy-shortcode icon-be-pb-download" title="Copy"></span></h4></div>';
	$html .= '<div class="be-pb-multi-fields-wrap"><div class="be-pb-multi-fields be-pb-shortcode-col be-pb-sortable">';
	if(!empty($inner_shortcode)){
		$html .= $inner_shortcode;
	}
	$html .= '</div>';
	$html .= '<div class="be-pb-controls"><a class="mini-btn mini-btn-dark add-multi-field" title="Add" role="button" data-single-field='.$be_shortcode[$shortcode_name]['single_field'].'><span class="btn-icon-plus"><i class="font-icon icon-be-pb-plus"></i></span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="multi-module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-be-pb-upload"></i></span></a>';
	$html .= '</div><pre class="shortcode">[/'.$shortcode_name.']</pre></div>';
	return $html;
}

function get_single_shortcode_block($shortcode_name, $output = ''){
	global $be_shortcode;
	$hide = '';
	if(!array_key_exists('options', $be_shortcode[$shortcode_name]) && empty($be_shortcode[$shortcode_name]['options'])) {
		$hide = 'hidden';	
	}
	$html ='';
	$html .='<div class="portlet be-pb-element be-pb-module-wrap">';
	$html .= '<div class="portlet-header"><div class="portlet-header-controls-wrap right"><span class="be-pb-control-icon icon-icon_trash_alt icon-delete icon-be-pb-cancel icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-icon_documents_alt icon-be-pb-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-icon_pencil-edit icon-edit edit-shortcode icon-be-pb-pencil-1 '.$hide.'" title="Edit" data-shortcode="'.$shortcode_name.'" data-action="edit"></span><span class="be-pb-control-icon icon-download copy-shortcode icon-be-pb-download" title="Copy"></span></div>'.$be_shortcode[$shortcode_name]['name'].'</div>';
	if(isset($be_shortcode[$shortcode_name]['backend_output']) && $be_shortcode[$shortcode_name]['backend_output'] === true) {
		$html .='<div class="portlet-content be-pb-content-preview clearfix">'.wp_kses_post( be_pb_output($output, $shortcode_name) ).'</div>';
	}
	$html .= '<pre class="shortcode">'.$output.'</pre>';
	$html .= '</div>';
	return $html;
}

function get_shortcode_block($shortcode = '',$shortcode_type = '') {
	global $be_shortcode;
	$shortcode_action = '';
	extract($_POST);
	$output = '';
	$has_content = false;
	if(!empty($shortcode_name)) 
		$shortcode = $shortcode_name;

	if(array_key_exists('options', $be_shortcode[$shortcode])) {
		foreach ($be_shortcode[$shortcode]['options'] as $att => $value) {
			if(array_key_exists('content', $value)){
				if($value['content'] == true) {
					$has_content = true;
					$content_att = $att;
					break;
				}
			}
			else {
				$has_content = false;
			}
		 }
	}
	

	if(!empty($be_shortcode_atts)) {
		 $output .='['.$shortcode;
		 if($has_content == true) {
		 	foreach ($be_shortcode_atts as $att => $value) {
		 		if($att != $content_att){
		 			if(is_array($value)){
		 				$value = implode(',', $value);
		 			}
		 			$output .=' '.$att.'= "'.$value.'"';
		 		}
		 	}
		 	$output .=' ]'.shortcode_unautop(stripslashes_deep($be_shortcode_atts[$content_att])).'[/'.$shortcode.']';	
		} else {
		 	foreach ($be_shortcode_atts as $att => $value) {
	 			if(is_array($value)) {
	 				$value = implode(',', $value);
	 			}
	 			$output .=' '.$att.'= "'.$value.'"';
		 	}
		 	$output .=']';
		}
	} else {
		$output .='['.$shortcode.']';
	}

	if($shortcode == 'section' || $shortcode == 'row' || $shortcode == 'one_col' || $shortcode == 'one_half' || $shortcode == 'one_third' || $shortcode == 'one_fourth' || $shortcode == 'two_third' || $shortcode == 'three_fourth' || $shortcode == 'one_fifth'|| ( $shortcode_action == 'edit' && $be_shortcode[$shortcode]['type']=='multi' )){
		echo $output;
	} else {
	 	if($shortcode_type == 'multi'){
			echo get_multi_shortcode_block($shortcode, $output);
	 	}
	 	else {
			echo get_single_shortcode_block($shortcode, $output);
		} 
	}
	die();
}

function edit_shortcode_form() {
	global $be_shortcode;
	$post = stripslashes_deep($_POST);
	$shortcode = $post['shortcode'];
	$pattern = get_shortcode_regex();
	preg_match("/$pattern/s", $shortcode, $parsed_value );
	if (preg_last_error() == PREG_BACKTRACK_LIMIT_ERROR) {
    	print 'Backtrack limit was exhausted!';
	}
	$shortcode_name = $post['shortcode_name'];
	$atts = shortcode_parse_atts($parsed_value[3]);
	if(!empty($parsed_value[5])){
		$content = $parsed_value[5];	
	} else {
		$content = '';
	}
	be_pb_print_form($shortcode_name, 'edit', $atts, $content);
	die();
}

function paste_shortcode_form() {
	global $shortcode_tags;
	global $paste_shortcode_name;
	$post = stripslashes_deep($_POST);
	$shortcode = $post['shortcode'];
	$paste_shortcode_name = $post['shortcode_name'];
	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $shortcode;
	$pattern = get_shortcode_regex();
	echo preg_replace_callback( "/$pattern/s", 'be_pb_do_paste_shortcode_tag', $shortcode );
	die();
}

function be_pb_do_paste_shortcode_tag( $shortcode ) {
	global $paste_shortcode_name;
	global $be_shortcode;
	$shortcode_name = $shortcode[2];
	if((($paste_shortcode_name == 'section') || ($paste_shortcode_name == 'row')) && ($shortcode_name == $paste_shortcode_name)) {
		return be_pb_do_shortcode( $shortcode[0] );
	}
	if( $paste_shortcode_name == 'module' ) {
		if(($shortcode_name != 'section') && ($shortcode_name != 'row') && ($be_shortcode[$shortcode_name]['type'] != 'multi_single')) {
			return be_pb_do_shortcode( $shortcode[0] );
		}
	}
	if( $paste_shortcode_name == 'multi-module' ) {
		if(($shortcode_name != 'section') && ($shortcode_name != 'row') && ($be_shortcode[$shortcode_name]['type'] == 'multi_single')) {
			return be_pb_do_shortcode( $shortcode[0] );
		}
	}
}

function be_pb_add_field(){
	extract($_POST);
	be_pb_print_form($single_field);
	die();	
}


function be_pb_print_form($shortcode_name,$action='generate', $atts = array(), $content='') {
	global $be_shortcode;
	$chosen_shortcode = $be_shortcode[$shortcode_name];
	echo '<h2>'.$chosen_shortcode['name'].'</h2>';
	echo '<form data-shortcode-name="'.$shortcode_name.'" data-shortcode-type="'.$chosen_shortcode['type'].'">';

	if(!empty($chosen_shortcode['options']) && $chosen_shortcode['options']) {
		foreach ($chosen_shortcode['options'] as $option_key => $option) {
			$default = isset( $option['default'] ) ? $option['default'] : '';
			if($action == 'edit'){
				if(is_array($atts) && array_key_exists($option_key, $atts)){
					$att_value = $atts[$option_key];
				}
				else{
					$att_value='';
				}
			}
			else {
				$att_value = $default;
				$content = $default;
			}
			
			echo '<fieldset class="clearfix">';
					if ($option['type'] == 'text' || $option['type'] == 'select')
				$label_class = "padding-top-5";
			else
				$label_class = "padding-top-0";
				echo '<div class="left-section '.$label_class.'"><label for="be_shortcode_atts['.$option_key.']" class="be-pb-label">'.$option['title'].'</label></div>';
			switch ($option['type']) {
					case 'textarea':
						echo '<div class="right-section"><textarea name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" class="be-shortcode-atts" rows="10" cols="70">'.$content.'</textarea></div>';
						break;
					case 'text':
						echo '<div class="right-section"><input type="text" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-shortcode-atts be-pb-text" /></div>';
						break;
					case 'number':
						echo '<div class="right-section"><input type="number" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-shortcode-atts be-pb-text" /><span>'.' '.$option['metric'].'</span></div>';
						break;
					case 'select':		
						echo
						'<div class="right-section"><select name="be_shortcode_atts['.$option_key.']" id="#'.$option_key. '" class="be-shortcode-atts be-pb-select">';
						if(empty($att_value) || $att_value == 'none'){
							echo '<option value="none" disabled="disabled">'.esc_html__('Select', 'be-themes').'</option>';
						}
						
						if(is_assoc($option['options'])) {
							foreach ($option['options'] as $key=>$value) {
								echo '<option value="'.$value.'" '.selected( $value, $att_value, false ).'><span>'.ucfirst(esc_html($key)).'</span></option>';
							}
						}
						else {
							foreach ($option['options'] as $value) {
								echo '<option value="'.$value.'" '.selected( $value, $att_value, false ).'>'.ucfirst(esc_html($value)).'</option>';
							}
						}
						echo '</select></div>';
						break;
					case 'select_icon':
						echo
						'<div class="right-section"><select name="be_shortcode_atts['.$option_key.']" id="icon-picker-select" class="be-shortcode-atts be-pb-select-icon">';
						if(empty($att_value) || $att_value == 'none'){
							echo '<option value="">'.esc_html__('No Icon', 'be-themes').'</option>';
						}
						
						foreach ($option['options'] as $key=>$value) {
								echo '<option value="'.$value.'" '.selected( $value, $att_value, false ).'>'.$value.'</option>';
						}
						echo '</select></div>';
						break;
					case 'tinymce':
						$content = wpautop($content);
						wp_editor($content, 'textblockcontent', array('textarea_name'=> 'be_shortcode_atts['.$option_key.']', 'quicktags' => true, 'editor_class'=>'be-shortcode-atts be-pb-editor', 'media_buttons' => true, 'wpautop'=>false , 'textarea_rows'=>20));
						break;
					case 'checkbox':
						echo '<input type="checkbox" name="be_shortcode_atts['.$option_key.']" value="1" class="be-shortcode-atts be-pb-checkbox" '.checked($att_value,'1',false).' />';
						break;	
					case 'multi_check':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}
						echo '<div class="right-section">';
						foreach ($option['options'] as $value) {
							
							$checkbox_option = '<div class="margin-bottom-5"><input type="checkbox" name="be_shortcode_atts['.$option_key.'][]" value="'.$value.'" class="be-shortcode-atts be-pb-checkbox" ';
							if(in_array($value, $att_value)){
								$checkbox_option .= 'checked="checked" />';	
							}
							else{
								$checkbox_option .='/>';
							}
							echo $checkbox_option;
							echo '<label for="'.$value.'">'.$value.'</label></div>';
						}
						echo '</div>';
						break;
					case 'radio':
						echo '<div class="right-section">';
						foreach ($option['options'] as $value) {
							echo '<div class="margin-bottom-5"><input type="radio" name="be_shortcode_atts['.$option_key.'][]" value="'.$value.'" class="be-shortcode-atts be-pb-radio" '.checked($value,$att_value,false).' />';
							echo '<label for="'.$value.'">'.$value.'</label></div>';
						}
						break;
					case 'media':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}									
						echo '<div class="right-section"><a href="#" class="button-secondary btn_browse_files '.$option['select'].'">Browse Files</a>
							<div class="browsed-images-container clearfix be-pb-sortable" data-name="be_shortcode_atts['.$option_key.']">';
							foreach ($att_value as $attachment_id) {
								echo '<div class="seleced-images-wrap">
									<input type="hidden" name="be_shortcode_atts['.$option_key.'][]" value="'.$attachment_id.'">
									<img src="'.wp_get_attachment_thumb_url( $attachment_id ).'">
									<span class="remove"></span>
									</div>';
							}
						echo '</div></div>';
						break;
					case 'color':
						echo '<div class="right-section"><input type="text" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-pb-color-field be-shortcode-atts" /></div>';
						break;
					case 'taxo':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}
						echo '<div class="right-section">';
						$taxonomy = get_terms($option['taxonomy']);
						foreach ($taxonomy as $term) {
							
							$checkbox_option = '<div class="margin-bottom-5"><input type="checkbox" name="be_shortcode_atts['.$option_key.'][]" value="'.$term->slug.'" class="be-shortcode-atts be-pb-checkbox" ';
							if(in_array($term->slug, $att_value)){
								$checkbox_option .= 'checked="checked" />';	
							}
							else{
								$checkbox_option .='/>';
							}
							echo $checkbox_option;
							echo '<label for="'.$term->name.'">'.$term->name.'</label></div>';
						}
						echo '</div>';
						break;
					case 'page':
						$pages = get_pages(array('post_type'=>'page'));	
						echo '<div class="right-section"><select name="be_shortcode_atts['.$option_key.']" id="#'.$option_key. '" class="be-shortcode-atts be-pb-select">';
						

						if(empty($att_value) || $att_value == 'none'){
							echo '<option value="none" disabled="disabled">'.esc_html__('Select', 'be-themes').'</option>';
						}
						
						foreach ($pages as $page) {
							echo '<option value="'.$page->ID.'" '.selected( $page->ID, $att_value, false ).'>'.esc_html($page->post_title).'</option>';
						}
							
						echo '</select></div>';
						break;																
				}
			echo "</fieldset>";		
		}
	}
	echo '<input type="submit" class="bluefoose-button-light add-shortcode" data-action="'.$action.'" />
	</form>';
}

/**************************************
			Add Section
**************************************/

function be_pb_add_section(){
	global $blank_section;
	echo $blank_section;
}


/**************************************
			Add Row
**************************************/

function be_pb_add_row(){
	global $blank_row;
	echo $blank_row;
}

/**************************************
			Validate Associative Array
**************************************/

// function is_assoc($array){
//  ????$keys = array_keys($array);
// ????return array_keys($keys) !== $keys;
// }

function is_assoc($arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}
/**************************************
			Save Page Builder
**************************************/

add_action( 'wp_ajax_save_be_pb_builder', 'save_be_pb_builder' );
add_action( 'wp_ajax_save_be_pb_builder', 'save_be_pb_builder' );

function save_be_pb_builder(){
	extract($_POST);
	if (!wp_verify_nonce($nonce, 'be_pb_save_nonce')) {
    	exit();	
    }
  	//   if(get_post_meta($post_id,'_be_pb_html',true)) {
  	//   	$return['html'] = update_post_meta($post_id,'_be_pb_html',$html);
  	//   } else {
  	//   	$return['html'] = add_post_meta($post_id,'_be_pb_html',$html,true);
 	// }
    if(get_post_meta($post_id,'_be_pb_content')) { 
		$return['output'] = update_post_meta($post_id, '_be_pb_content', $content);
	} else {
		$return['output'] = add_post_meta($post_id,'_be_pb_content', $content, true);
	}

    if(get_post_meta($post_id,'_be_pb_disable')) { 
		$return['disabled'] = update_post_meta($post_id, '_be_pb_disable', $disable_pb);
	} else {
		$return['disabled'] = add_post_meta($post_id,'_be_pb_disable', $disable_pb, true);
	}		

	if($return['output'] > 0 || $return['disabled'] > 0 ) {
		echo "success";
	} else { 
		echo "no_changes";
	}
	die();
}



add_action( 'wp_ajax_nopriv_edit_shortcode_form', 'edit_shortcode_form' );
add_action( 'wp_ajax_edit_shortcode_form', 'edit_shortcode_form' );

add_action( 'wp_ajax_nopriv_paste_shortcode_form', 'paste_shortcode_form' );
add_action( 'wp_ajax_paste_shortcode_form', 'paste_shortcode_form' );

add_action( 'wp_ajax_nopriv_get_shortcode_form', 'get_shortcode_form' );
add_action( 'wp_ajax_get_shortcode_form', 'get_shortcode_form' );

add_action( 'wp_ajax_nopriv_get_shortcode_block', 'get_shortcode_block' );
add_action( 'wp_ajax_get_shortcode_block', 'get_shortcode_block' );

add_action( 'wp_ajax_nopriv_be_pb_add_field', 'be_pb_add_field' );
add_action( 'wp_ajax_be_pb_add_field', 'be_pb_add_field' );

add_action( 'wp_ajax_nopriv_be_pb_add_section', 'be_pb_add_section' );
add_action( 'wp_ajax_be_pb_add_section', 'be_pb_add_section' );

add_action( 'wp_ajax_nopriv_be_pb_add_row', 'be_pb_add_row' );
add_action( 'wp_ajax_be_pb_add_row', 'be_pb_add_row' );


function be_pb_output($output, $shortcode_name){
	global $be_shortcode;
	global $shortcode_tags;
	if (empty($shortcode_tags) || !is_array($shortcode_tags)) {
		return $output;
	}
	$pattern = get_shortcode_regex();
	if(isset($be_shortcode[$shortcode_name]['backend_output']) && $be_shortcode[$shortcode_name]['backend_output'] === true) {
		return preg_replace_callback( "/$pattern/s", 'be_pb_'.$shortcode_name.'_output', $output );
	}
}



/**************************************
		Setup Page Builder 
**************************************/

add_action( 'init', 'be_page_builder_init' );

function be_page_builder_init() {

	add_action( 'add_meta_boxes', 'be_page_builder_add_custom_box' ); 
	function be_page_builder_add_custom_box(){

	    $screens = array( 'page', 'portfolio', 'post' );
	    foreach ($screens as $screen) {
	        add_meta_box(
	            'be-page-builder',
	            __( 'Page Builder', 'be-themes' ),
	            'be_page_builder_custom_box',
	            $screen,
	            'normal',
	            'high'
	        );
	    }

	}

	function be_page_builder_custom_box() {
			global $be_shortcode;
			global $blank_section;
			wp_nonce_field('be_pb_save_nonce', 'be_pb_save_nonce');

		?>
		<input type="hidden" id="ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>" />
		<input type="hidden" id="themefile_url" value="<?php echo BE_PB_ROOT_URL; ?>js/jquery.clipboard/" />
		<div id="be-pb-disable">
			<?php $be_pb_disabled = get_post_meta(get_the_ID(),'_be_pb_disable',true);?>
			<input type="checkbox" id="be-pb-disable-check"  name="be_pb_disable" value="yes" class="be-pb-checkbox" <?php echo checked($be_pb_disabled,'yes',false); ?> /><label for="be-pb-disable-check" class="be-pb-label">Disable Page Builder </label>
		</div>
		<h2><?php _e('Add Rows, organize content into column blocks and style the page using a myraid collection of shortcodes','be-themes') ?></h2>
		<div id="shortcodes" title="Modules" style="display:none;">
			<?php 
				$be_sorted_shortcode = $be_shortcode;
				$be_sorted_shortcode = sort_2d_asc($be_sorted_shortcode, 'name'); 
			?>
  			<div class="clearfix" style="height: 100%;">
				<div class="shortcode-btn-wrap">
					<?php
						foreach ($be_sorted_shortcode as $shortcode_key => $shortcode) {
							if(array_key_exists('options', $shortcode) && !empty($shortcode['options'])) {
								$shortcode_options = 'yes';
							} else {
								$shortcode_options = 'no';
							}
							if((empty($shortcode['module_type']) || $shortcode['module_type'] != 'structure') && $shortcode['type'] != 'multi_single' && $shortcode_key != 'section' && $shortcode_key != 'row' && (empty($shortcode['exclude']) || $shortcode['exclude'] != true )) {
								echo '<div class="bluefoose-ui-button-light be-pb-choose-shortcode">
										<a class="be-icon-'.$shortcode['name'].' insert-shortcode bluefoose-button-light" data-shortcode="'.$shortcode_key.'" data-action="insert" data-shortcode-type="'.$shortcode['type'].'" data-shortcode-options="'.$shortcode_options.'" />
											<img src="'.$shortcode['icon'].'" /> '.$shortcode['name'].'
										</a>
									</div>';
							}
						}
					?>
				</div>
				<div id="shortcode-form">
					<div class="shortcode-description clearfix">
						<h4><?php _e('Styling & Elements','be-themes') ?></h4>
						<p><?php _e('If you wish to adjust or add styling to your page or content, you can use the optional modules left side.','be-themes') ?></p>
  					</div>
				</div>
			</div>
		</div>

		<div id="edit-shortcode" title="Edit Shortcode Module"></div>
		<div id="paste-shortcode" title="Paste Shortcode Module">
			<div id="paste-shortcode-wrap">

			</div>
		</div>
		<div class="dialog-overlay-custom"></div>
		'
		<!--   Confirm Dialog  -->
		<div id="dialog-confirm" title="Delete Module / Section / Row">
			<p class="dialog-confirm-content">
				<strong>Warning</strong>
				These items will be permanently deleted and cannot be recovered. Are you sure?
			</p>
		</div>

		<div id="be-pb-main" class="be-pb-sortable notranslate clearfix">
			<?php 
				global $post_id;

				$content = get_post_meta($post_id,'_be_pb_content',true);
				
				if(!empty($content)){

				 	echo be_pb_do_shortcode($content);
				}
				else{
					echo $blank_section;
				}
			?>

		</div>

		<div id="be-page-builder-controls"> <a href="#" class="bluefoose-button-dark" id="be-pb-add-section">Add Section</a><a href="#" class="bluefoose-button-dark" id="be-pb-paste-section" data-shortcode-name="section">Paste Section</a></div>
		
		<div id="be-pb-save-wrap"><a href="#" class="bluefoose-button-dark" id="be-pb-save">Save Page Builder</a><span id="be-pb-loader"></div>

		<?php	
		
	} 

}

add_action( 'admin_enqueue_scripts', 'be_page_builder_enqueue');
function be_page_builder_enqueue() {

	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );

	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'wp-color-picker' );

	wp_enqueue_script('jquery-uniform-js', BE_PB_ROOT_URL.'js/jquery.uniform.min.js');

	wp_enqueue_script('jquery-clipboard-js', BE_PB_ROOT_URL.'js/jquery.clipboard/jquery.clipboard.js');

	wp_enqueue_script('be-page-builder-js', BE_PB_ROOT_URL.'js/script.js', array('jquery','jquery-ui-core','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-dialog','wp-color-picker','jquery-uniform-js'));

	wp_register_style('be-page-builder', BE_PB_ROOT_URL.'css/be-pb-css.css');
	wp_enqueue_style('be-page-builder',array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17');

	wp_enqueue_style('be-pb-backend-output',BE_PB_ROOT_URL.'css/be-pb-backend-output.css' );

	wp_enqueue_style('be-pb-backend-output',BE_PB_ROOT_URL.'css/shortcodes.css' );

	//wp_enqueue_style('be-fontello',get_template_directory_uri().'fonts/fontello/be-themes.css' );

	wp_enqueue_script( 'jquery_fonticonpicker', BE_PB_ROOT_URL . 'js/jquery.fonticonpicker.min.js' );

	wp_register_style( 'icomoon', BE_PB_ROOT_URL.'fonts/icomoon/style.css' );
	wp_enqueue_style( 'icomoon' );	
	
	wp_register_style( 'fonticonpicker', BE_PB_ROOT_URL.'css/jquery.fonticonpicker.min.css' );
	wp_enqueue_style( 'fonticonpicker' );	
	
	wp_register_style( 'fonticontheme', BE_PB_ROOT_URL.'css/jquery.fonticonpicker.grey.min.css' );
	wp_enqueue_style( 'fonticontheme' );

	wp_register_style( 'be-pb-text-fonts', BE_PB_ROOT_URL.'fonts/stylesheet.css' );
	wp_enqueue_style( 'be-pb-text-fonts' );

	wp_register_style( 'be-pb-font-icons', BE_PB_ROOT_URL.'fonts/fontello/css/fontello.css' );
	wp_enqueue_style( 'be-pb-font-icons' );

	//wp_enqueue_style('be-fontello');
} 

add_action( 'wp_enqueue_scripts', 'be_page_builder_frontend_enqueue',11);
function be_page_builder_frontend_enqueue() {

	global $be_themes_data; 
	$google_map_api_key = ( isset($be_themes_data['google_map_api_key']) && !empty($be_themes_data['google_map_api_key']) && $be_themes_data['google_map_api_key'] != '' ) ? '?key='.$be_themes_data['google_map_api_key'] : '' ;

	//Main Plugin File
	wp_deregister_script( 'be-main-plugins-js' );
	wp_register_script( 'be-main-plugins-js', BE_PB_ROOT_URL. 'js/main-plugins.js', array( 'jquery','vimeo-api' ), FALSE, TRUE ); //common
	wp_enqueue_script( 'be-main-plugins-js' );

	//Mandatory Plugins for Page Builder 
	wp_register_script( 'be-modules-plugin', BE_PB_ROOT_URL.'js/be-modules-plugin.js', array( 'jquery'), FALSE, TRUE );
	wp_enqueue_script( 'be-modules-plugin' );

	//Optional Plugins 

	wp_register_script( 'be-textRotator-js', BE_PB_ROOT_URL.'js/opt_plugins/plugin-textRotator.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-textRotator-js' );

	wp_register_script( 'be-easyPieChart-js', BE_PB_ROOT_URL.'js/opt_plugins/plugin-easyPieChart.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-easyPieChart-js' );

	wp_register_script( 'be-hoverdir-js', BE_PB_ROOT_URL.'js/opt_plugins/plugin-hoverdir.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-hoverdir-js' );

	wp_register_script( 'be-typed-js', BE_PB_ROOT_URL.'js/opt_plugins/plugin-typed.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-typed-js' );

	wp_register_script( 'be-countTo-js', BE_PB_ROOT_URL.'js/opt_plugins/plugin-countTo.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-countTo-js' );

	wp_register_script( 'be-themes-countdown-js', BE_PB_ROOT_URL.'js/opt_plugins/jquery.countdown.min.js', array( 'jquery', 'be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-themes-countdown-js' );

	wp_deregister_script( 'be-magnificpopup-js' );
	wp_register_script( 'be-magnificpopup-js', BE_PB_ROOT_URL. 'js/opt_plugins/plugin-magnificpopup.js', array(), FALSE, TRUE );
	wp_enqueue_script( 'be-magnificpopup-js' );

	wp_deregister_script( 'be-backgroundcheck-js' );
	wp_register_script( 'be-backgroundcheck-js', BE_PB_ROOT_URL. 'js/opt_plugins/plugin-backgroundcheck.js', array(), FALSE, TRUE );
	wp_enqueue_script( 'be-backgroundcheck-js' );

	wp_deregister_script( 'be-justifiedgrid-js' );
	wp_register_script( 'be-justifiedgrid-js', BE_PB_ROOT_URL. 'js/opt_plugins/jquery.justifiedGallery.min.js', array(), FALSE, TRUE );
	wp_enqueue_script( 'be-justifiedgrid-js' );
	//End Optional Plugins

	wp_deregister_script( 'be-themes-modules-script-js' );
	//wp_register_script( 'be-themes-modules-script-js', BE_PB_ROOT_URL.'js/be-modules-script.js', array( 'jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse','jquery-ui-position','jquery-ui-draggable','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-sortable','jquery-ui-accordion','jquery-ui-tabs','jquery-effects-core','jquery-effects-blind','jquery-effects-bounce','jquery-effects-clip','jquery-effects-drop','jquery-effects-explode','jquery-effects-fade','jquery-effects-fold','jquery-effects-core','jquery-effects-pulsate','jquery-effects-scale','jquery-effects-shake','jquery-effects-slide','jquery-effects-transfer','be-main-plugins-js','be-modules-plugin','be-themes-countdown-js'), FALSE, TRUE );
	wp_register_script( 'be-themes-modules-script-js', BE_PB_ROOT_URL.'js/be-modules-script.js', array( 'jquery','jquery-ui-core','jquery-ui-accordion','jquery-ui-tabs','be-main-plugins-js','be-modules-plugin','be-themes-countdown-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-themes-modules-script-js' );

	wp_deregister_script( 'be-themes-portfolio-layout-js' );
	wp_register_script( 'be-themes-portfolio-layout-js', BE_PB_ROOT_URL.'js/be-portfolio-layout.js', array( 'jquery','be-main-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-themes-portfolio-layout-js' );

	wp_deregister_script( 'map-api' );
	wp_register_script( 'map-api', 'https://maps.googleapis.com/maps/api/js'.$google_map_api_key, array(), FALSE, TRUE );
	wp_enqueue_script( 'map-api' );

	$lang = explode('_', get_locale() );
	
	if ( is_array($lang) && !empty( $lang[0]) && 'en' != $lang[0] ) {
		wp_register_script( 'be-themes-countdown-js-'.$lang[0], BE_PB_ROOT_URL.'js/countdown/jquery.countdown-'.$lang[0].'.js', array( 'jquery'), FALSE, TRUE );
		wp_enqueue_script( 'be-themes-countdown-js-'.$lang[0] );	
	}
	wp_deregister_style('be-themes-layout');
	wp_register_style( 'be-themes-layout', BE_PB_ROOT_URL.'css/layout.css' );
	wp_enqueue_style( 'be-themes-layout' );
	
	wp_deregister_style('be-pb-frontend-output');
	wp_register_style( 'be-pb-frontend-output', BE_PB_ROOT_URL.'css/shortcodes.css' );
	wp_enqueue_style( 'be-pb-frontend-output');

	wp_deregister_style('be-justifiedgrid-css');
	wp_register_style( 'be-justifiedgrid-css', BE_PB_ROOT_URL.'css/justifiedGallery.min.css' );
	wp_enqueue_style( 'be-justifiedgrid-css');

}

function be_pb_do_shortcode( $content ) {
	global $shortcode_tags;
	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;
	$pattern = get_shortcode_regex();
	return preg_replace_callback( "/$pattern/s", 'be_pb_do_shortcode_tag', $content );
}

function be_pb_do_shortcode_tag( $m ) {
	global $be_shortcode;
	global $row_controls;
	global $section_controls;
	// allow [[foo]] syntax for escaping a tag
	if(!array_key_exists($m[2], $be_shortcode)) {
		return '';
	}
	if ( $m[1] == '[' && $m[6] == ']' ) {
		return substr($m[0], 1, -1);
	}

	if($m[2] == 'section') {
		return '<div class="be-pb-section-wrap be-pb-element clearfix be-pb-module-wrap">
					'.$section_controls.'
					<pre class="shortcode">['.$m[2].$m[3].']</pre>
					<div class="be-pb-section-inner-wrap"><div class="be-pb-section">'.be_pb_do_shortcode($m[5]).'</div><a href="#" class="bluefoose-button-dark be-pb-add-row">Add Row</a><a href="#" class="bluefoose-button-dark be-pb-paste-row" data-shortcode-name="row">Paste Row</a></div>
				    <pre class="shortcode">[/'.$m[2].']</pre>
				</div>';
	} elseif($m[2] == 'row') {
    	return '<div class="be-pb-row-wrap be-pb-element clearfix be-pb-module-wrap">
    				'.$row_controls.'
    				<pre class="shortcode">['.$m[2].$m[3].']</pre>
					<div class="be-pb-row be-pb-sortable clearfix">'.be_pb_do_shortcode($m[5]).'
					</div>
				 	<pre class="shortcode">[/'.$m[2].']</pre>
			</div>';		
	} elseif($m[2] == 'one_col' || $m[2] == 'one_half' || $m[2] == 'one_third' || $m[2] == 'one_fourth' || $m[2] == 'two_third' || $m[2] == 'three_fourth' || $m[2] == 'one_fifth') {
		return	'<div class="portlet be-pb-element be-pb-col-wrap '.$m[2].'" data-col-name="'.$m[2].'">
			<pre class="shortcode">['.$m[2].$m[3].']</pre>
			<div class="be-pb-column be-pb-shortcode-col">'.be_pb_do_shortcode($m[5]).'</div>
			<div class="be-pb-controls"><a class="mini-btn mini-btn-dark choose-shortcode" title="Add Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-be-pb-plus"></i></span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-be-pb-upload"></i></span></a><a class="mini-btn mini-btn-dark edit-column-btn" title="Edit Module" role="button"><span class="be-pb-control-icon icon-icon_pencil-edit icon-edit edit-shortcode  column-edit-control icon-be-pb-pencil-1" title="Edit" data-shortcode="'.$m[2].'" data-action="edit"></span></a></div>
			<pre class="shortcode test">[/'.$m[2].']</pre>
		</div>';
	} elseif(array_key_exists($m[2], $be_shortcode) && $be_shortcode[$m[2]]['type']== 'multi') {
		$hide = '';
		if(!array_key_exists('options', $be_shortcode[$m[2]]) && empty($be_shortcode[$m[2]]['options'])) {
			$hide = 'hidden';
		}

		return 	 '<div class="be-pb-multi-wrap be-pb-element toggled be-pb-module-wrap" data-shortcode="'.$m[2].'">
				<pre class="shortcode">['.$m[2].$m[3].']</pre>
				<div class="be-pb-multi-fields-header-wrap clearfix"><h4 class="clearfix"><div class="left">'.$be_shortcode[$m[2]]['name'].'</div><span class="be-pb-control-icon icon-icon_trash_alt icon-delete icon-be-pb-cancel icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-icon_documents_alt icon-be-pb-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-icon_pencil-edit edit-shortcode icon-be-pb-pencil-1 '.$hide.'" title="Edit" data-shortcode="'.$m[2].'" data-action="edit"></span><span class="be-pb-control-icon icon-download copy-shortcode icon-be-pb-download" title="Copy"></span></h4></div>
		 <div class="be-pb-multi-fields-wrap"><div class="be-pb-multi-fields be-pb-shortcode-col be-pb-sortable">'.be_pb_do_shortcode($m[5]).'
		 </div>
		 <div class="be-pb-controls"><a class="mini-btn mini-btn-dark add-multi-field" title="Add" role="button" data-single-field='.$be_shortcode[$m[2]]['single_field'].'><span class="btn-icon-plus"><i class="font-icon icon-be-pb-plus"></i></span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="multi-module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-be-pb-upload"></i></span></a></div>
		 <pre class="shortcode">[/'.$m[2].']</pre></div></div>';
	} else  {
		return get_single_shortcode_block($m[2],$m[0]);
	}

}

add_filter( 'the_content', 'be_pb_content_filter');
// Filter to hook BE Page Builder Content to SEO by Yoast Plugin
//add_filter( 'wpseo_pre_analysis_post_content', 'be_pb_content_filter', 10, 2 );

function be_pb_content_filter($content) {
	global $post;
	global $be_themes_data;
	$be_pb_disabled = get_post_meta( $post->ID, '_be_pb_disable', true );
	$be_pb_universal_use = apply_filters('be_pb_universal_use', false );

    if( ( $be_pb_universal_use ) 
    	|| ( ( !isset($be_pb_disabled) || false == $be_pb_disabled || $be_pb_disabled == 'no')
     	&& ( $post->post_type =='page' || $post->post_type =='portfolio' || ( $post->post_type =='post' && isset( $be_themes_data['enable_pb_blog_posts'] ) && 1 == $be_themes_data['enable_pb_blog_posts'] ) ) 
     	&& ( isset( $be_themes_data['enable_pb'] ) && 1 == $be_themes_data['enable_pb'] ) ) ) {

			$be_pb_content = get_post_meta($post->ID,'_be_pb_content',true);
			$content = $be_pb_content;

	}
	return $content;
}
function sort_2d_asc($array, $key) {
	$temp = Array(); 
	foreach($array as &$ma) {
		$temp[] = &$ma[$key];
	}
	array_multisort($temp, $array);
	return $array;
}
require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = new PluginUpdateChecker_1_6 (
    'http://brandexponents.com/oshin-plugins/bepagebuilder-metadata.json',
    __FILE__,
    'be-page-builder'
);
?>