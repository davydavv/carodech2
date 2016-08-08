<?php

function be_pb_text_output($m){
	return wpautop( $m[5] );
}

function be_pb_icon_output($m) {
	return do_shortcode($m[0]);
}

function be_pb_blockquote_output($m){
	return do_shortcode($m[0]);
}

function be_pb_special_heading_output($m){
	return do_shortcode($m[0]);
}
function be_pb_special_heading2_output($m){
	return do_shortcode($m[0]);
}
function be_pb_special_heading3_output($m){
	return do_shortcode($m[0]);
}

function be_pb_title_icon_output($m){
	return do_shortcode($m[0]);
}

function be_pb_button_output($m){
	return do_shortcode($m[0]);
}

function be_pb_dropcap_output($m){
	return do_shortcode($m[0]);
}

function be_pb_notifications_output($m){
	return do_shortcode($m[0]);
}

function be_pb_services_output($m){
	return do_shortcode($m[0]);
}

function be_pb_team_output($m){
	return do_shortcode($m[0]);
}
function be_pb_call_to_action_output($m){
	return do_shortcode($m[0]);
}
function be_pb_content_slide_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_toggle_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_tab_output($m) {
	return do_shortcode($m[5]);
}
function be_pb_testimonial_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_special_sub_title_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_separator_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_pricing_feature_output($m) {
	return do_shortcode($m[0]);
}
function be_pb_list_output($m) {
	return do_shortcode($m[0]);
}
?>