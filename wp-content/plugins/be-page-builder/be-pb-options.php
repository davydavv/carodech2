<?php
add_action('init','be_shortcodes_init');
function be_shortcodes_init() {
	global $be_themes_data;
	global $be_shortcode;
	global $be_font_size;
	$be_font_size = array();
	for($i=1; $i<=100; $i++)
		array_push($be_font_size, $i);

	$be_font_icon_elegant = array (
		'icon-arrow_back',
		'icon-arrow_carrot_up_alt',
		'icon-arrow_carrot-2down_alt2',
		'icon-arrow_carrot-2down',
		'icon-arrow_carrot-2dwnn_alt',
		'icon-arrow_carrot-2left_alt',
		'icon-arrow_carrot-2left_alt2',
		'icon-arrow_carrot-2left',
		'icon-arrow_carrot-2right_alt',
		'icon-arrow_carrot-2right_alt2',
		'icon-arrow_carrot-2right',
		'icon-arrow_carrot-2up_alt',
		'icon-arrow_carrot-2up_alt2',
		'icon-arrow_carrot-2up',
		'icon-arrow_carrot-down_alt',
		'icon-arrow_carrot-down_alt2',
		'icon-arrow_carrot-down',
		'icon-arrow_carrot-left_alt',
		'icon-arrow_carrot-left_alt2',
		'icon-arrow_carrot-left',
		'icon-arrow_carrot-right_alt',
		'icon-arrow_carrot-right_alt2',
		'icon-arrow_carrot-right',
		'icon-arrow_carrot-up_alt2',
		'icon-arrow_carrot-up',
		'icon-arrow_condense_alt',
		'icon-arrow_condense',
		'icon-arrow_down_alt',
		'icon-arrow_down',
		'icon-arrow_expand_alt',
		'icon-arrow_expand_alt2',
		'icon-arrow_expand_alt3',
		'icon-arrow_expand',
		'icon-arrow_left_alt',
		'icon-arrow_left-down_alt',
		'icon-arrow_left-down',
		'icon-arrow_left-right_alt',
		'icon-arrow_left-right',
		'icon-arrow_left-up_alt',
		'icon-arrow_left-up',
		'icon-arrow_left',
		'icon-arrow_move',
		'icon-arrow_right_alt',
		'icon-arrow_right-down_alt',
		'icon-arrow_right-down',
		'icon-arrow_right-up_alt',
		'icon-arrow_right-up',
		'icon-arrow_right',
		'icon-arrow_triangle-down_alt',
		'icon-arrow_triangle-down_alt2',
		'icon-arrow_triangle-down',
		'icon-arrow_triangle-left_alt',
		'icon-arrow_triangle-left_alt2',
		'icon-arrow_triangle-left',
		'icon-arrow_triangle-right_alt',
		'icon-arrow_triangle-right_alt2',
		'icon-arrow_triangle-right',
		'icon-arrow_triangle-up_alt',
		'icon-arrow_triangle-up_alt2',
		'icon-arrow_triangle-up',
		'icon-arrow_up_alt',
		'icon-arrow_up-down_alt',
		'icon-arrow_up',
		'icon-arrow-up-down',
		'icon-icon_adjust-horiz',
		'icon-icon_adjust-vert',
		'icon-icon_archive_alt',
		'icon-icon_archive',
		'icon-icon_bag_alt',
		'icon-icon_bag',
		'icon-icon_balance',
		'icon-icon_blocked',
		'icon-icon_book_alt',
		'icon-icon_book',
		'icon-icon_box-checked',
		'icon-icon_box-empty',
		'icon-icon_box-selected',
		'icon-icon_briefcase_alt',
		'icon-icon_briefcase',
		'icon-icon_building_alt',
		'icon-icon_building',
		'icon-icon_calculator_alt',
		'icon-icon_calendar',
		'icon-icon_calulator',
		'icon-icon_camera_alt',
		'icon-icon_camera',
		'icon-icon_cart_alt',
		'icon-icon_cart',
		'icon-icon_chat_alt',
		'icon-icon_chat',
		'icon-icon_check_alt',
		'icon-icon_check_alt2',
		'icon-icon_check',
		'icon-icon_circle-empty',
		'icon-icon_circle-slelected',
		'icon-icon_clipboard',
		'icon-icon_clock_alt',
		'icon-icon_clock',
		'icon-icon_close_alt',
		'icon-icon_close_alt2',
		'icon-icon_close',
		'icon-icon_cloud_alt',
		'icon-icon_cloud-download_alt',
		'icon-icon_cloud-download',
		'icon-icon_cloud-upload_alt',
		'icon-icon_cloud-upload',
		'icon-icon_cloud',
		'icon-icon_cog',
		'icon-icon_cogs',
		'icon-icon_comment_alt',
		'icon-icon_comment',
		'icon-icon_compass_alt',
		'icon-icon_compass',
		'icon-icon_cone_alt',
		'icon-icon_cone',
		'icon-icon_contacts_alt',
		'icon-icon_contacts',
		'icon-icon_creditcard',
		'icon-icon_currency_alt',
		'icon-icon_currency',
		'icon-icon_cursor_alt',
		'icon-icon_cursor',
		'icon-icon_datareport_alt',
		'icon-icon_datareport',
		'icon-icon_desktop',
		'icon-icon_dislike_alt',
		'icon-icon_dislike',
		'icon-icon_document_alt',
		'icon-icon_document',
		'icon-icon_documents_alt',
		'icon-icon_documents',
		'icon-icon_download',
		'icon-icon_drawer_alt',
		'icon-icon_drawer',
		'icon-icon_drive_alt',
		'icon-icon_drive',
		'icon-icon_easel_alt',
		'icon-icon_easel',
		'icon-icon_error-circle_alt',
		'icon-icon_error-circle',
		'icon-icon_error-oct_alt',
		'icon-icon_error-oct',
		'icon-icon_error-triangle_alt',
		'icon-icon_error-triangle',
		'icon-icon_film',
		'icon-icon_floppy_alt',
		'icon-icon_floppy',
		'icon-icon_flowchart_alt',
		'icon-icon_flowchart',
		'icon-icon_folder_download',
		'icon-icon_folder_upload',
		'icon-icon_folder-add_alt',
		'icon-icon_folder-add',
		'icon-icon_folder-alt',
		'icon-icon_folder-open_alt',
		'icon-icon_folder-open',
		'icon-icon_folder',
		'icon-icon_genius',
		'icon-icon_gift_alt',
		'icon-icon_gift',
		'icon-icon_globe_alt',
		'icon-icon_globe-2',
		'icon-icon_globe',
		'icon-icon_grid-2x2',
		'icon-icon_grid-3x3',
		'icon-icon_group',
		'icon-icon_headphones',
		'icon-icon_heart_alt',
		'icon-icon_heart',
		'icon-icon_hourglass',
		'icon-icon_house_alt',
		'icon-icon_house',
		'icon-icon_id_alt',
		'icon-icon_id-2_alt',
		'icon-icon_id-2',
		'icon-icon_id',
		'icon-icon_image',
		'icon-icon_images',
		'icon-icon_info_alt',
		'icon-icon_info',
		'icon-icon_key_alt',
		'icon-icon_key',
		'icon-icon_laptop',
		'icon-icon_lifesaver',
		'icon-icon_lightbulb_alt',
		'icon-icon_lightbulb',
		'icon-icon_like_alt',
		'icon-icon_like',
		'icon-icon_link_alt',
		'icon-icon_link',
		'icon-icon_loading',
		'icon-icon_lock_alt',
		'icon-icon_lock-open_alt',
		'icon-icon_lock-open',
		'icon-icon_lock',
		'icon-icon_mail_alt',
		'icon-icon_mail',
		'icon-icon_map_alt',
		'icon-icon_map',
		'icon-icon_menu-circle_alt',
		'icon-icon_menu-circle_alt2',
		'icon-icon_menu-square_alt',
		'icon-icon_menu-square_alt2',
		'icon-icon_menu',
		'icon-icon_mic_alt',
		'icon-icon_mic',
		'icon-icon_minus_alt',
		'icon-icon_minus_alt2',
		'icon-icon_minus-06',
		'icon-icon_minus-box',
		'icon-icon_mobile',
		'icon-icon_mug_alt',
		'icon-icon_mug',
		'icon-icon_music',
		'icon-icon_ol',
		'icon-icon_paperclip',
		'icon-icon_pause_alt',
		'icon-icon_pause_alt2',
		'icon-icon_pause',
		'icon-icon_pencil_alt',
		'icon-icon_pencil-edit_alt',
		'icon-icon_pencil-edit',
		'icon-icon_pencil',
		'icon-icon_pens_alt',
		'icon-icon_pens',
		'icon-icon_percent_alt',
		'icon-icon_percent',
		'icon-icon_phone',
		'icon-icon_piechart',
		'icon-icon_pin_alt',
		'icon-icon_pin',
		'icon-icon_plus_alt',
		'icon-icon_plus_alt2',
		'icon-icon_plus-box',
		'icon-icon_plus',
		'icon-icon_printer-alt',
		'icon-icon_printer',
		'icon-icon_profile',
		'icon-icon_pushpin_alt',
		'icon-icon_pushpin',
		'icon-icon_puzzle_alt',
		'icon-icon_puzzle',
		'icon-icon_question_alt',
		'icon-icon_question_alt2',
		'icon-icon_question',
		'icon-icon_quotations_alt',
		'icon-icon_quotations_alt2',
		'icon-icon_quotations',
		'icon-icon_refresh',
		'icon-icon_ribbon_alt',
		'icon-icon_ribbon',
		'icon-icon_rook',
		'icon-icon_search_alt',
		'icon-icon_search',
		'icon-icon_search2',
		'icon-icon_shield_alt',
		'icon-icon_shield',
		'icon-icon_star_alt',
		'icon-icon_star-half_alt',
		'icon-icon_star-half',
		'icon-icon_star',
		'icon-icon_stop_alt',
		'icon-icon_stop_alt2',
		'icon-icon_stop',
		'icon-icon_table',
		'icon-icon_tablet',
		'icon-icon_tag_alt',
		'icon-icon_tag',
		'icon-icon_tags_alt',
		'icon-icon_tags',
		'icon-icon_target',
		'icon-icon_tool',
		'icon-icon_toolbox_alt',
		'icon-icon_toolbox',
		'icon-icon_tools',
		'icon-icon_trash_alt',
		'icon-icon_trash',
		'icon-icon_ul',
		'icon-icon_upload',
		'icon-icon_vol-mute_alt',
		'icon-icon_vol-mute',
		'icon-icon_volume-high_alt',
		'icon-icon_volume-high',
		'icon-icon_volume-low_alt',
		'icon-icon_volume-low',
		'icon-icon_wallet_alt',
		'icon-icon_wallet',
		'icon-icon_zoom-in_alt',
		'icon-icon_zoom-in',
		'icon-icon_zoom-out_alt',
		'icon-icon_zoom-out',
		'icon-social_blogger_circle',
		'icon-social_blogger_square',
		'icon-social_blogger',
		'icon-social_delicious_circle',
		'icon-social_delicious_square',
		'icon-social_delicious',
		'icon-social_deviantart_circle',
		'icon-social_deviantart_square',
		'icon-social_deviantart',
		'icon-social_dribbble_circle',
		'icon-social_dribbble_square',
		'icon-social_dribbble',
		'icon-social_facebook_circle',
		'icon-social_facebook_square',
		'icon-social_facebook',
		'icon-social_flickr_circle',
		'icon-social_flickr_square',
		'icon-social_flickr',
		'icon-social_googledrive_alt2',
		'icon-social_googledrive_square',
		'icon-social_googledrive',
		'icon-social_googleplus_circle',
		'icon-social_googleplus_square',
		'icon-social_googleplus',
		'icon-social_instagram_circle',
		'icon-social_instagram_square',
		'icon-social_instagram',
		'icon-social_linkedin_circle',
		'icon-social_linkedin_square',
		'icon-social_linkedin',
		'icon-social_myspace_circle',
		'icon-social_myspace_square',
		'icon-social_myspace',
		'icon-social_picassa_circle',
		'icon-social_picassa_square',
		'icon-social_picassa',
		'icon-social_pinterest_circle',
		'icon-social_pinterest_square',
		'icon-social_pinterest',
		'icon-social_rss_circle',
		'icon-social_rss_square',
		'icon-social_rss',
		'icon-social_share_circle',
		'icon-social_share_square',
		'icon-social_share',
		'icon-social_skype_circle',
		'icon-social_skype_square',
		'icon-social_skype',
		'icon-social_spotify_circle',
		'icon-social_spotify_square',
		'icon-social_spotify',
		'icon-social_stumbleupon_circle',
		'icon-social_stumbleupon_square',
		'icon-social_tumbleupon',
		'icon-social_tumblr_circle',
		'icon-social_tumblr_square',
		'icon-social_tumblr',
		'icon-social_twitter_circle',
		'icon-social_twitter_square',
		'icon-social_twitter',
		'icon-social_vimeo_circle',
		'icon-social_vimeo_square',
		'icon-social_vimeo',
		'icon-social_wordpress_circle',
		'icon-social_wordpress_square',
		'icon-social_wordpress',
		'icon-social_youtube_circle',
		'icon-social_youtube_square',
		'icon-social_youtube',
		'icon-duckduckgo',
		'icon-aim',
		'icon-delicious',
		'icon-paypal',
		'icon-flattr',
		'icon-android',
		'icon-eventful',
		'icon-smashmag',
		'icon-gplus',
		'icon-wikipedia',
		'icon-lanyrd',
		'icon-calendar',
		'icon-stumbleupon',
		'icon-fivehundredpx',
		'icon-pinterest',
		'icon-bitcoin',
		'icon-w3c',
		'icon-foursquare',
		'icon-html5',
		'icon-ie',
		'icon-call',
		'icon-grooveshark',
		'icon-ninetyninedesigns',
		'icon-forrst',
		'icon-digg',
		'icon-spotify',
		'icon-reddit',
		'icon-guest',
		'icon-gowalla',
		'icon-appstore',
		'icon-blogger',
		'icon-cc',
		'icon-dribbble',
		'icon-evernote',
		'icon-flickr',
		'icon-google',
		'icon-viadeo',
		'icon-instapaper',
		'icon-weibo',
		'icon-klout',
		'icon-linkedin',
		'icon-meetup',
		'icon-vk',
		'icon-plancast',
		'icon-disqus',
		'icon-rss',
		'icon-skype',
		'icon-twitter',
		'icon-youtube',
		'icon-vimeo',
		'icon-windows',
		'icon-xing',
		'icon-yahoo',
		'icon-chrome',
		'icon-email',
		'icon-macstore',
		'icon-myspace',
		'icon-podcast',
		'icon-amazon',
		'icon-steam',
		'icon-cloudapp',
		'icon-dropbox',
		'icon-ebay',
		'icon-facebook',
		'icon-github',
		'icon-github-circled',
		'icon-googleplay',
		'icon-itunes',
		'icon-plurk',
		'icon-songkick',
		'icon-lastfm',
		'icon-gmail',
		'icon-pinboard',
		'icon-openid',
		'icon-quora',
		'icon-soundcloud',
		'icon-tumblr',
		'icon-eventasaurus',
		'icon-wordpress',
		'icon-yelp',
		'icon-intensedebate',
		'icon-eventbrite',
		'icon-scribd',
		'icon-posterous',
		'icon-stripe',
		'icon-opentable',
		'icon-cart',
		'icon-print',
		'icon-angellist',
		'icon-instagram',
		'icon-dwolla',
		'icon-appnet',
		'icon-statusnet',
		'icon-acrobat',
		'icon-drupal',
		'icon-buffer',
		'icon-pocket',
		'icon-bitbucket',
		'icon-lego',
		'icon-login',
		'icon-stackoverflow',
		'icon-hackernews',
		'icon-lkdto',
		'icon-phone',
		'icon-mobile',
		'icon-mouse',
		'icon-directions',
		'icon-mail',
		'icon-paperplane',
		'icon-pencil',
		'icon-feather',
		'icon-paperclip',
		'icon-drawer',
		'icon-reply',
		'icon-reply-all',
		'icon-forward',
		'icon-user',
		'icon-users',
		'icon-user-add',
		'icon-vcard',
		'icon-export',
		'icon-location',
		'icon-map',
		'icon-compass',
		'icon-location2',
		'icon-target',
		'icon-share',
		'icon-sharable',
		'icon-heart',
		'icon-heart2',
		'icon-star',
		'icon-star2',
		'icon-thumbsup',
		'icon-thumbsdown',
		'icon-chat',
		'icon-comment',
		'icon-quote',
		'icon-house',
		'icon-popup',
		'icon-search',
		'icon-flashlight',
		'icon-printer',
		'icon-bell',
		'icon-link',
		'icon-flag',
		'icon-cog',
		'icon-tools',
		'icon-trophy',
		'icon-tag',
		'icon-camera',
		'icon-megaphone',
		'icon-moon',
		'icon-palette',
		'icon-leaf',
		'icon-music',
		'icon-music2',
		'icon-new',
		'icon-graduation',
		'icon-book',
		'icon-newspaper',
		'icon-bag',
		'icon-airplane',
		'icon-lifebuoy',
		'icon-eye',
		'icon-clock',
		'icon-microphone',
		'icon-calendar2',
		'icon-bolt',
		'icon-thunder',
		'icon-droplet',
		'icon-cd',
		'icon-briefcase',
		'icon-air',
		'icon-hourglass',
		'icon-gauge',
		'icon-language',
		'icon-network',
		'icon-key',
		'icon-battery',
		'icon-bucket',
		'icon-magnet',
		'icon-drive',
		'icon-cup',
		'icon-rocket',
		'icon-brush',
		'icon-suitcase',
		'icon-cone',
		'icon-earth',
		'icon-keyboard',
		'icon-browser',
		'icon-publish',
		'icon-progress-3',
		'icon-progress-2',
		'icon-brogress-1',
		'icon-progress-0',
		'icon-sun',
		'icon-sun2',
		'icon-adjust',
		'icon-code',
		'icon-screen',
		'icon-infinity',
		'icon-light-bulb',
		'icon-creditcard',
		'icon-database',
		'icon-voicemail',
		'icon-clipboard',
		'icon-cart2',
		'icon-box',
		'icon-ticket',
		'icon-rss2',
		'icon-signal',
		'icon-thermometer',
		'icon-droplets',
		'icon-uniE66E',
		'icon-statistics',
		'icon-pie',
		'icon-bars',
		'icon-graph',
		'icon-lock',
		'icon-lock-open',
		'icon-logout',
		'icon-login2',
		'icon-checkmark',
		'icon-cross',
		'icon-minus',
		'icon-plus',
		'icon-cross2',
		'icon-minus2',
		'icon-plus2',
		'icon-cross3',
		'icon-minus3',
		'icon-plus3',
		'icon-erase',
		'icon-blocked',
		'icon-info',
		'icon-info2',
		'icon-question',
		'icon-help',
		'icon-warning',
		'icon-cycle',
		'icon-cw',
		'icon-ccw',
		'icon-shuffle',
		'icon-arrow',
		'icon-arrow2',
		'icon-retweet',
		'icon-loop',
		'icon-history',
		'icon-back',
		'icon-switch',
		'icon-list',
		'icon-add-to-list',
		'icon-layout',
		'icon-list2',
		'icon-text',
		'icon-text2',
		'icon-document',
		'icon-docs',
		'icon-landscape',
		'icon-pictures',
		'icon-video',
		'icon-music3',
		'icon-folder',
		'icon-archive',
		'icon-trash',
		'icon-upload',
		'icon-download',
		'icon-disk',
		'icon-install',
		'icon-cloud',
		'icon-upload2',
		'icon-bookmark',
		'icon-bookmarks',
		'icon-book2',
		'icon-play',
		'icon-pause',
		'icon-record',
		'icon-stop',
		'icon-next',
		'icon-previous',
		'icon-first',
		'icon-last',
		'icon-resize-enlarge',
		'icon-resize-shrink',
		'icon-volume',
		'icon-sound',
		'icon-mute',
		'icon-flow-cascade',
		'icon-flow-branch',
		'icon-flow-tree',
		'icon-flow-line',
		'icon-flow-parallel',
		'icon-arrow-left',
		'icon-arrow-down',
		'icon-arrow-up-upload',
		'icon-arrow-right',
		'icon-arrow-left2',
		'icon-arrow-down2',
		'icon-arrow-up',
		'icon-arrow-right2',
		'icon-arrow-left3',
		'icon-arrow-down3',
		'icon-arrow-up2',
		'icon-arrow-right3',
		'icon-arrow-left4',
		'icon-arrow-down4',
		'icon-arrow-up3',
		'icon-arrow-right4',
		'icon-arrow-left5',
		'icon-arrow-down5',
		'icon-arrow-up4',
		'icon-arrow-right5',
		'icon-arrow-left6',
		'icon-arrow-down6',
		'icon-arrow-up5',
		'icon-arrow-right6',
		'icon-arrow-left7',
		'icon-arrow-down7',
		'icon-arrow-up6',
		'icon-uniE6D8',
		'icon-arrow-left8',
		'icon-arrow-down8',
		'icon-arrow-up7',
		'icon-arrow-right7',
		'icon-menu',
		'icon-ellipsis',
		'icon-dots',
		'icon-dot',
		'icon-cc2',
		'icon-cc-by',
		'icon-cc-nc',
		'icon-cc-nc-eu',
		'icon-cc-nc-jp',
		'icon-cc-sa',
		'icon-cc-nd',
		'icon-cc-pd',
		'icon-cc-zero',
		'icon-cc-share',
		'icon-cc-share2',
		'icon-danielbruce',
		'icon-danielbruce2',
		'icon-github2',
		'icon-github3',
		'icon-flickr2',
		'icon-flickr3',
		'icon-vimeo2',
		'icon-vimeo3',
		'icon-twitter2',
		'icon-twitter3',
		'icon-facebook2',
		'icon-facebook3',
		'icon-facebook4',
		'icon-googleplus',
		'icon-googleplus2',
		'icon-pinterest2',
		'icon-pinterest3',
		'icon-tumblr2',
		'icon-tumblr3',
		'icon-linkedin2',
		'icon-linkedin3',
		'icon-dribbble2',
		'icon-dribbble3',
		'icon-stumbleupon2',
		'icon-stumbleupon3',
		'icon-lastfm2',
		'icon-lastfm3',
		'icon-rdio',
		'icon-rdio2',
		'icon-spotify2',
		'icon-spotify3',
		'icon-qq',
		'icon-instagram2',
		'icon-dropbox2',
		'icon-evernote2',
		'icon-flattr2',
		'icon-skype2',
		'icon-skype3',
		'icon-renren',
		'icon-sina-weibo',
		'icon-paypal2',
		'icon-picasa',
		'icon-soundcloud2',
		'icon-mixi',
		'icon-behance',
		'icon-circles',
		'icon-vk2',
		'icon-smashing',
		'icon-mobile2',
		'icon-laptop',
		'icon-desktop',
		'icon-tablet',
		'icon-phone2',
		'icon-document2',
		'icon-documents',
		'icon-search2',
		'icon-clipboard2',
		'icon-newspaper2',
		'icon-notebook',
		'icon-book-open',
		'icon-browser2',
		'icon-calendar3',
		'icon-presentation',
		'icon-picture',
		'icon-pictures2',
		'icon-video2',
		'icon-camera2',
		'icon-printer2',
		'icon-toolbox',
		'icon-briefcase2',
		'icon-wallet',
		'icon-gift',
		'icon-bargraph',
		'icon-grid',
		'icon-expand',
		'icon-focus',
		'icon-edit',
		'icon-adjustments',
		'icon-ribbon',
		'icon-hourglass2',
		'icon-lock2',
		'icon-megaphone2',
		'icon-shield',
		'icon-trophy2',
		'icon-flag2',
		'icon-map2',
		'icon-puzzle',
		'icon-basket',
		'icon-envelope',
		'icon-streetsign',
		'icon-telescope',
		'icon-gears',
		'icon-key2',
		'icon-paperclip2',
		'icon-attachment',
		'icon-pricetags',
		'icon-lightbulb',
		'icon-layers',
		'icon-pencil2',
		'icon-tools2',
		'icon-tools-2',
		'icon-scissors',
		'icon-paintbrush',
		'icon-magnifying-glass',
		'icon-circle-compass',
		'icon-linegraph',
		'icon-mic',
		'icon-strategy',
		'icon-beaker',
		'icon-caution',
		'icon-recycle',
		'icon-anchor',
		'icon-profile-male',
		'icon-profile-female',
		'icon-bike',
		'icon-wine',
		'icon-hotairballoon',
		'icon-globe',
		'icon-genius',
		'icon-map-pin',
		'icon-dial',
		'icon-chat2',
		'icon-heart3',
		'icon-cloud2',
		'icon-upload3',
		'icon-download2',
		'icon-target2',
		'icon-hazardous',
		'icon-piechart',
		'icon-speedometer',
		'icon-global',
		'icon-compass2',
		'icon-lifesaver',
		'icon-clock2',
		'icon-aperture',
		'icon-quote2',
		'icon-scope',
		'icon-alarmclock',
		'icon-refresh',
		'icon-happy',
		'icon-sad',
		'icon-facebook5',
		'icon-twitter4',
		'icon-googleplus3',
		'icon-rss3',
		'icon-tumblr4',
		'icon-linkedin4',
		'icon-dribbble4'
	);
	asort($be_font_icon_elegant);
	
	$animations = array (
		'flipInX', 
		'flipInY', 
		'fadeIn', 
		'fadeInDown', 
		'fadeInLeft', 
		'fadeInRight', 
		'fadeInUp', 
		'slideInDown', 
		'slideInLeft', 
		'slideInRight', 
		'rollIn', 
		'rollOut',
		'bounce',
		'bounceIn',
		'bounceInUp',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'fadeInUpBig',
		'fadeInDownBig',
		'fadeInLeftBig',
		'fadeInRightBig',
		'flash',
		'flip',
		'lightSpeedIn',
		'pulse',
		'rotateIn',
		'rotateInUpLeft',
		'rotateInDownLeft',
		'rotateInUpRight',
		'rotateInDownRight',
		'shake',
		'swing',
		'tada',
		'wiggle',
		'wobble',
		'infiniteJump',
		'zoomIn',
		'none'
	);
	
	$portfolio_hover_style = array (
		'title' =>	__('Hover Style', 'be-themes'),
		'type' => 	'select',
		'options' => array (
			'Style1 - FadeToggle' => 'style1-hover',
			'Style2 - 3D FLIP Horizontal' => 'style2-hover',
			'Style3 - Direction Aware' => 'style3-hover',
			'Style4 - Direction Aware Inverse' => 'style4-hover',
			'Style5 - FadeIn & Scale' => 'style5-hover',
			'Style6 - Fall' => 'style6-hover',
			'Style7 - 3D FLIP Vertical' => 'style7-hover',
			'Style8 - 3D Rotate' => 'style8-hover',
			//'Style9 -' => 'style9-hover',
			//'Style10' => 'style10-hover'
		),
		'default'=> 'style1-hover'
	);

	$justified_gal_hover_style = array (
		'title' =>	__('Hover Style', 'be-themes'),
		'type' => 	'select',
		'options' => array (
			'Style1 - FadeToggle' => 'style1-hover',
			'Style2 - 3D FLIP Horizontal' => 'style2-hover',
			'Style3 - FadeIn & Scale' => 'style5-hover',
			'Style4 - Fall' => 'style6-hover',
			'Style5 - 3D FLIP Vertical' => 'style7-hover',
			'Style6 - 3D Rotate' => 'style8-hover',
		),
		'default'=> 'style1-hover'
	);
	
	$be_shortcode['portfolio'] = array (
		'name' => __('Portfolio', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			'col' =>array (
				'title' => __('Number of Columns','be-themes'),
				'type' => 'select',
				'options' => array (
					'One Column' => 'one',
					'Two Columns' => 'two',
					'Three Columns' => 'three',
					'Four Columns' => 'four',
					'Five Columns' => 'five',
				),
				'default' => 'three'
			),
			'gutter_style' =>array (
				'title' =>__('Gutter Style','be-themes'),
				'type' =>'select',
				'options' => array (
					'With Margin' => 'style1',
					'Without Margin' => 'style2',
				),
				'default'=> 'style1'
			),
			'gutter_width' =>array (
				'title' => __('Gutter Width','be-themes'),
				'type' => 'text',
				'default' => '40'
			),
			'show_filters' =>array (
				'title' =>__('Filterable Portfolio','be-themes'),
				'type' =>'select',
				'options' => array('yes','no'),
				'default' => 'yes'
			),
			'filter' =>array (
				'title' =>__('Filter to use','be-themes'),
				'type' =>'select',
				'options' => array (
					'Categories' => 'portfolio_categories',
					'Tags' => 'portfolio_tags'
				),
				'default' => 'categories'
			),
			'category' => array (
				'title' => __('Portfolio Categories','be-themes'),
				'type' =>'taxo',
				'taxonomy' => 'portfolio_categories'
			),		
			'items_per_page' =>array (
				'title' =>__('Number of Items per Page','be-themes'),
				'type' =>'text',
				'default' => '12'
			),
			'masonry' =>array (
				'title' =>__('Enable Masonry Layout','be-themes'),
				'type' =>'checkbox',
				'default' => '',
			),
			'pagination' => array (
				'title' => __('Pagination Style','be-themes'),
				'type' => 'select',
				'options' => array (
					'None' => 'none',
					'Infinite Scrolling' => 'infinite',
					'Load More' => 'loadmore'
				),
				'default'=> 'none'
			),
			'initial_load_style' => array (
				'title'=>__('Image Load Animation','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Slide Left' => 'init-slide-left',
					'Slide Right' => 'init-slide-right',
					'Slide Top' => 'init-slide-top',
					'Slide Bottom' => 'init-slide-bottom',
					'Scale' => 'init-scale',
					'None' => 'none',
				),
				'default'=> 'none'
			),
			'item_parallax' =>array (
				'title' => __('Enable Parallax Effect to Portfolio Items','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'hover_style' => $portfolio_hover_style,
			'title_style' => array (
				'title'=>__('Title Style','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Boxed Title and Meta - Middle' => 'style1',
					'Title and Meta - Top' => 'style2',
					'Title and Meta - Middle' => 'style3',
					'Title and Meta - Bottom' => 'style4',
					'Title and Meta - Below Thumbnail' => 'style5',
					'Title and Meta - Below Thumbnail with no Margin' => 'style6',
					'Title and Meta - Slide Up from Bottom' => 'style7'
				),
				'default'=> 'style1'
			),
			'title_alignment_static' => array (
				'title' => __('Title alignment - for Title Below Thumbnail styles','be-themes'),
				'type' => 'select',
				'options' => array (
					'Left' => 'left',
					'Center' => 'center',
					'Right' => 'right'
				),
				'default'=> 'none'
			),
			'overlay_color' =>array (
				'title' =>__('Thumbnail Color / Gradient Start Color','be-themes'),
				'type' =>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),			
			'show_overlay' =>array (
				'title' => __('Show Overlay and Title by default','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'gradient' =>array (
				'title' => __('Enable Gradient Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'gradient_color' =>array (
				'title' => __('Thumbnail Overlay Gradient End Color','be-themes'),
				'type' => 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient_direction' => array (
				'title'=>__('Gradient Direction','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Horizontal' => 'right',
					'Vertical' => 'bottom'
				),
				'default'=> 'style1'
			),
			'title_color' =>array (
				'title'=>__('Title Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'cat_color' =>array (
				'title'=>__('Categories Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),	
           'cat_hide' =>array (
                'title'=>__('Hide Categories','be-themes'),
                'type'=> 'checkbox',
                'default'=> 0
            ), 
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'image_effect' => array (
				'title'=>__('Image Effects','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Zoom In' => 'zoom-in',
					'Zoom Out' => 'zoom-out',
					'Zoom In Rotate' => 'zoom-in-rotate',
					'Zoom Out Rotate' => 'zoom-out-rotate',
					'None' => 'none'
				),
				'default'=> 'none'
			),
			'title_animation_type' =>array (
				'title' => __('Portfolio Title Animation','be-themes'),
				'type' => 'select',
				'options' => $animations,
				'default' => 'none',
			),
			'cat_animation_type' =>array (
				'title' => __('Portfolio Categories Animation','be-themes'),
				'type' => 'select',
				'options' => $animations,
				'default' => 'none',
			),
			'like_button' =>array (
				'title' => __('Disable Like Button','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)
	);
	$be_shortcode['portfolio_carousel'] = array (
		'name' => __('Portfolio Carousel', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),
			'items_per_page' =>array(
				'title'=>__('Number of Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '8'
			),
			'hover_style' => $portfolio_hover_style,
			'overlay_color' =>array (
				'title' =>__('Thumbnail Overlay Color / Gradient Start Color','be-themes'),
				'type' =>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),
			'gradient' =>array (
				'title' => __('Enable Gradient Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'gradient_color' =>array (
				'title' => __('Thumbnail Overlay Gradient End Color','be-themes'),
				'type' => 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient_direction' => array (
				'title'=>__('Gradient Direction','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Horizontal' => 'right',
					'Vertical' => 'bottom'
				),
				'default'=> 'style1'
			),
			'title_color' =>array (
				'title'=>__('Title Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'cat_color' =>array (
				'title'=>__('Categories Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),	
			'title_style' => array (
				'title'=>__('Title Style','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Style1' => 'style1',
					'Style2' => 'style2',
					'Style3' => 'style3',
					'Style4' => 'style4'
				),
				'default'=> 'style1'
			),
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'image_effect' => array (
				'title'=>__('Image Effects','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Zoom In' => 'zoom-in',
					'Zoom Out' => 'zoom-out',
					'Zoom In Rotate' => 'zoom-in-rotate',
					'Zoom Out Rotate' => 'zoom-out-rotate',
					'None' => 'none'
				),
				'default'=> 'none'
			),
			'title_animation_type' =>array (
				'title' => __('Portfolio Title Animation Type','be-themes'),
				'type' => 'select',
				'options' => $animations,
				'default' => 'none',
			),
			'cat_animation_type' =>array (
				'title' => __('Portfolio Categories Animation Type','be-themes'),
				'type' => 'select',
				'options' => $animations,
				'default' => 'none',
			),
			'like_button' =>array (
				'title' => __('Disable Like Button','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)
	);
	
	$be_shortcode['gallery'] = array (
		'name' => __('Gallery', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			'col' =>array (
				'title'=>__('Number of Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					'One Column' => 'one',
					'Two Columns' => 'two',
					'Three Columns' => 'three',
					'Four Columns' => 'four',
					'Five Columns' => 'five'
				),
				'default'=> 'three'
			),
			'lightbox_type' =>array (
				'title' =>__('Lightbox Style','be-themes'),
				'type' =>'select',
				'options' => array (
					'Photo Swipe' => 'photoswipe',
					'Magnific Popup (Supports Video)' => 'magnific',
				),
				'default'=> 'photoswipe'
			),
			'items_per_load' =>array (
				'title' => __('Items Per Load','be-themes'),
				'type' => 'text',
				'default' => '9'
			),
			'gallery_paginate' =>array (
				'title' =>__('Gallery Pagination Style','be-themes'),
				'type' =>'select',
				'options' => array (
					'None'	=> 'none',
					'Infinite Scrolling' => 'infinite',
					'Load More' => 'loadmore',
				),
				'default'=> 'none'
			),
			'gutter_style' =>array (
				'title' =>__('Gutter Style','be-themes'),
				'type' =>'select',
				'options' => array (
					'Style1' => 'style1',
					'Style2' => 'style2',
				),
				'default'=> 'style1'
			),
			'gutter_width' =>array (
				'title' => __('Gutter Width','be-themes'),
				'type' => 'text',
				'default' => '40'
			),
			'masonry' =>array (
				'title'=>__('Enable Masonry Layout','be-themes'),
				'type'=>'checkbox',
				'default'=> 0,
			),
			'initial_load_style' => array (
				'title'=>__('Image Load Animation','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Slide Left' => 'init-slide-left',
					'Slide Right' => 'init-slide-right',
					'Slide Top' => 'init-slide-top',
					'Slide Bottom' => 'init-slide-bottom',
					'Scale' => 'init-scale',
					'None' => 'none',
				),
				'default'=> 'none'
			),
			'item_parallax' =>array (
				'title' => __('Enable Parallax Effect to Portfolio Items','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'hover_style' => $portfolio_hover_style,
			'hover_content_option' => array (
				'title'=>__('On Image Hover','be-themes'),
				'type'=> 'select',
				'options'=> array('None' => 'none', 'Show Icon' => 'icon', 'Show Title' => 'title'),
				'default' => 'icon',
			), 
			'hover_content_color' => array(
				'title' => 'Hover Content Color',
				'type'  => 'color',
				'default' => ''
			),
			// 'disable_hover_icon' => array (
			// 	'title' => __('Disable Hover Icon/Title (+) on Items','be-themes'),
			// 	'type' => 'checkbox',
			// 	'default' => 0,
			// ),
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'image_effect' => array (
				'title'=>__('Image Effects','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Zoom In' => 'zoom-in',
					'Zoom Out' => 'zoom-out',
					'Zoom In Rotate' => 'zoom-in-rotate',
					'Zoom Out Rotate' => 'zoom-out-rotate',
					'None' => 'none'
				),
				'default'=> 'none'
			),
			'overlay_color' =>array (
				'title'=>__('Thumbnail Overlay Color / Gradient Start Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient' =>array (
				'title' => __('Enable Gradient Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'gradient_color' =>array (
				'title' => __('Thumbnail Overlay Gradient End Color','be-themes'),
				'type' => 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient_direction' => array (
				'title'=>__('Gradient Direction','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Horizontal' => 'right',
					'Vertical' => 'bottom'
				),
				'default'=> 'style1'
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),
			'like_button' =>array (
				'title' => __('Disable Like Button','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'image_source' => array (
				'title'=>__('Image Source','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Selected Images' => 'selected',
					'Instagram' => 'instagram',
					'Pintrest' => 'pintrest',
					'Dribble' => 'dribble',
					'Flickr' => 'flickr'
				),
				'default'=> 'selected'
			),
			'images' => array (
				'title'=> __('Upload Image','be-themes'),
				'type'=>'media',
				'select'=> 'multiple'
			),
			'account_name' =>array (
				'title'=> __('Account Name','be-themes'),
				'type'=> 'text',
				'default'=> 'themeforest'
			),
			'count' => array (
				'title'=> __('Images Count','be-themes'),
				'type' => 'text',
				'default' => 10,
			),
		)
	);

	$be_shortcode['justified_gallery'] = array (
		'name' => __('Justified Gallery', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			'gutter_width' => array (
				'title' => __('Gutter Width','be-themes'),
				'type' => 'text',
				'default' => '40'
			),
			'image_height' => array (
				'title' => __('Image Height','be-themes'),
				'type' => 'text',
				'default' => '200'
			),
			'initial_load_style' => array (
				'title'=>__('Image Load Animation','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Slide Left' => 'init-slide-left',
					'Slide Right' => 'init-slide-right',
					'Slide Top' => 'init-slide-top',
					'Slide Bottom' => 'init-slide-bottom',
					'Scale' => 'init-scale',
					'None' => 'none',
				),
				'default'=> 'none'
			),
			'hover_style' => $justified_gal_hover_style,
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'image_effect' => array (
				'title'=>__('Image Effects','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Zoom In' => 'zoom-in',
					'Zoom Out' => 'zoom-out',
					'Zoom In Rotate' => 'zoom-in-rotate',
					'Zoom Out Rotate' => 'zoom-out-rotate',
					'None' => 'none'
				),
				'default'=> 'none'
			),
			'disable_overlay' => array (
				'title' => __('Disable Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'overlay_color' =>array (
				'title'=>__('Thumbnail Overlay Color / Gradient Start Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient' =>array (
				'title' => __('Enable Gradient Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'gradient_color' =>array (
				'title' => __('Thumbnail Overlay Gradient End Color','be-themes'),
				'type' => 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'gradient_direction' => array (
				'title'=>__('Gradient Direction','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Horizontal' => 'right',
					'Vertical' => 'bottom'
				),
				'default'=> 'style1'
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),
			'gallery_paginate' =>array (
				'title' => __('Enable Infinite Scroll','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'items_per_load' =>array (
				'title' => __('Items Per Load','be-themes'),
				'type' => 'text',
				'default' => '9'
			),
			'like_button' =>array (
				'title' => __('Disable Like Button','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'images' => array (
				'title'=> __('Upload Image','be-themes'),
				'type'=>'media',
				'select'=> 'multiple'
			),
		)
	);

	$be_shortcode['portfolio_navigation_module'] = array (
		'name' => __('Portfolio Navigation', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'backend_output'=>false,
		'options' => array (
			'style' => array (
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array (
					'Style1' => 'style1',
					'Style2' => 'style2'
				),
				'default'=> 'style1'
			),
			'title_align' => array (
				'title'=>__('Style1 Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','center','right'),
				'default'=> 'center',
			),
			'nav_links_color' => array (
				'title' => __('Next and Previous Page Navigation Color','be-themes'),
				'type' => 'color',
				'default' => '',
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);
	
	$be_shortcode['blog'] = array (
		'name' => __('Blog', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			'col' =>array (
				'title'=>__('Blog Masonry Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					'Three Columns' => 'three',
					'Four Columns' => 'four',
					'Five Columns' => 'five',
				),
				'default'=> 'three'
			),
			'gutter_style' =>array (
				'title' =>__('Gutter Style','be-themes'),
				'type' =>'select',
				'options' => array (
					'Without Margin' => 'style1',
					'With Margin' => 'style2',
				),
				'default'=> 'style1'
			),
			'gutter_width' =>array (
				'title' => __('Gutter Width','be-themes'),
				'type' => 'text',
				'default' => '40'
			)	
		)
	);

	$be_shortcode['text'] = array (
		'name' => __('Text Block', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'backend_output'=>true,
		'options' => array(
			'text_block' =>array(
				'title'=>__('Text Block Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true,
			),
			'max_width' =>array(
				'title'=> __('Maximum Width','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
            'wrap_alignment' =>array(
                'title'=> __('Wrapper alignment(Will apply only if Max width is specified)','be-themes'),
                'type'=> 'select',
                'options'=> array('left','center','right'),
                'default'=> 'center',
            ),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),											
		)
	);	

	$be_shortcode['shortcode_modules'] = array (
		'name' => __('Plugin Shortcodes', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array(
			'text_block' =>array(
				'title'=>__('Shortcode','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
		)
	);		

	$be_shortcode['dropcap'] = array(
		'name' => __('Dropcaps', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'letter'=>array(
				'title'=>__('Letter to be Dropcapped','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'icon' =>array(
				'title'=>__('Icon to be Dropcapped  - prioritized over letter','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),			
			'type' =>array(
				'title'=>__('Dropcap Style','be-themes'),
				'type'=>'select',
				'options'=> array('circle','rounded','letter'),
				'default'=> 'circle'
			),
			'size' =>array(
				'title'=>__('Dropcap Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','big'),
				'default'=> 'small'
			),
			'color' =>array(
				'title'=>__('Dropcap Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),						
			'dropcap_content' => array(
				'title'=> __('Dropcap Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);	

 	$be_shortcode['team'] = array (
		'name' => __('Team', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h6',
			),	
			'designation' => array(
				'title' => __('Designation', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'description' => array(
				'title' => __('Description', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),					
			'image' => array(
				'title'=> __('Upload Team Member Image','be-themes'),
				'type'=>'media',
				'select'=> 'single'
			),		
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'description_color' => array(
				'title'=> __('Description Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'designation_color' => array(
				'title'=> __('Designation Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'facebook' => array(
				'title' => __('Facebook Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'twitter' => array(
				'title' => __('Twitter Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'google_plus' => array(
				'title' => __('Google Plus Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'linkedin' => array(
				'title' => __('LinkedIn Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'youtube' => array(
				'title' => __('Youtube Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'vimeo' => array(
				'title' => __('Vimeo Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),	
			'email' => array(
				'title' => __('Email', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),									
			'dribbble' => array(
				'title' => __('Dribbble Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'icon_hover_color' => array(
				'title'=> __('Icon Hover Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'icon_bg_color' => array(
				'title'=> __('Icon Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'icon_hover_bg_color' => array(
				'title'=> __('Icon Hover Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'hover_style' => $portfolio_hover_style,
			'title_style' => array (
				'title'=>__('Title Style','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Title and Meta - On Image' => 'style3',
					'Title and Meta - Below Thumbnail' => 'style5',
				),
				'default'=> 'style1'
			),			
			'smedia_icon_position' => array (
				'title' => __('Social Media Icons Position','be-themes'),
				'type' => 'select',
				'options' => array (
					'On Image' => 'over',
					'Below Image' => 'below'
				),
				'default'=> 'none'
			),
			'title_alignment_static' => array (
				'title' => __('Title alignment for "Below Thumbnail" type','be-themes'),
				'type' => 'select',
				'options' => array (
					'Left' => 'left',
					'Center' => 'center',
					'Right' => 'right'
				),
				'default'=> 'none'
			),
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'image_effect' => array (
				'title'=>__('Image Effects','be-themes'),
				'type'=> 'select',
				'options' => array (
					'Zoom In' => 'zoom-in',
					'Zoom Out' => 'zoom-out',
					'Zoom In Rotate' => 'zoom-in-rotate',
					'Zoom Out Rotate' => 'zoom-out-rotate',
					'None' => 'none'
				),
				'default'=> 'none'
			),
			'overlay_color' =>array (
				'title' =>__('Thumbnail Overlay Color','be-themes'),
				'type' =>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),
			'overlay_transparent' =>array(
				'title' => __('Transparent Overlay','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Css Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);	


	$be_shortcode['separator'] = array(
	'name' => __('Divider', 'be-themes'),
	'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
	'type' => 'single',
	'backend_output' => true,
	'options' => array (
			'height' => array(
				'title' => __('Divider Height', 'be-themes'),
				'type' => 'text',
				'default' => '1'
			),
			'width' => array(
				'title' => __('Divider Width (In Percentage)', 'be-themes'),
				'type' => 'text',
				'default' => '20'
			),
	 		'color' => array(
	 			'title'=> __('Divider Color','be-themes'),
	 			'type'=>'color',
	 			'default' => (isset($be_themes_data['sec_border']) && !empty($be_themes_data['sec_border'])) ? $be_themes_data['sec_border'] : ''
			),
		)
	);

	$be_shortcode['special_heading'] = array(
		'name' => __('Special Title - Style 1', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title_align' => array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','center','right'),
				'default'=> 'center',
			),
			'title_content' => array (
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h5',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'sub_title' =>array(
				'title'=> __('Sub Title','be-themes'),
				'type'=> 'tinymce',
				'default'=> '',
				'content'=> true
			),
			'subtitle_spl_font' => array(
				'title'=> __('Apply "Special-Subtitle" font to Sub-Title','be-themes'),
				'type'=>'checkbox',
				'default'=> '0'
			),
			'disable_separator' => array(
				'title'=> __('Disable Separator','be-themes'),
				'type'=>'checkbox',
				'default'=> '0'
			),
			'separator_style' => array(
				'title'=> __('Separator Type','be-themes'),
				'type'=> 'select',
				'options' =>array(
								"No Icon" => "no-icon" ,
								"With Icon" => "with-icon"
							),
				'default'=> 'no-icon'
			),	
			'icon_name' =>array(
				'title'=>__('Icon in Separator','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'default_icon' => array(
				'title'=> __('Default Icon','be-themes'),
				'type'=> 'checkbox',
				'default'=> '0'
			),
			'icon_color' =>array(
				'title'=>__('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'separator_color' => array(
				'title'=> __('Divider Color','be-themes'),
				'type'=>'color',
				'default'=> '#e8e8e8'
			),
			'separator_thickness' => array(
				'title'=> __('Separator Thickness','be-themes'),
				'type'=>'text',
				'default'=> '2'
			),
			'separator_width' => array(
				'title'=> __('Separator Width (In Pixels)','be-themes'),
				'type'=>'text',
				'default'=> '40'
			),
			'separator_pos' => array(
				'title'=> __('Place Divider above Sub Title','be-themes'),
				'type'=>'checkbox',
				'default'=> '0'
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['special_heading2'] = array(
		'name' => __('Special Title - Style 2', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output' => true,
		'options' => array (
			'title_content' => array (
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h5',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'border_thickness' => array(
				'title'=> __('Border Thickness (In Pixels)','be-themes'),
				'type'=>'text',
				'default'=> '2',
			),
			'padding_value' => array(
				'title'=> __('Padding Value in','be-themes'),
				'type'=>'select',
				'options'=> array (
					"Percentage" => '%',
					"Pixels" => 'px'
				),
				'default'=> 'px',
			),
			'title_padding_vertical' => array(
				'title'=> __('Title Top and Bottom Padding','be-themes'),
				'type'=>'text',
				'default'=> '20',
			),
			'title_padding_horizontal' => array(
				'title'=> __('Title Left and Right Padding','be-themes'),
				'type'=>'text',
				'default'=> '30',
			),
			'title_alignment' => array(
				'title'=> __('Title Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('center','right','left'),
				'default'=> 'center',
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);
	
	// $be_shortcode['special_heading2'] = array(
	// 	'name' => __('Special Title Style2', 'be-themes'),
	// 	'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
	// 	'type' => 'single',
	// 	'options' => array(
	// 		'title_content' =>array(
	// 			'title'=> __('Title','be-themes'),
	// 			'type'=> 'text',
	// 			'default'=> '',
	// 		),
	// 		'h_tag' =>array(
	// 			'title'=>__('Heading tag to use for Title','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> array('h1','h2','h3','h4','h5','h6'),
	// 			'default'=> 'h3',
	// 		),
	// 		'title_color' => array(
	// 			'title'=> __('Title Color','be-themes'),
	// 			'type'=>'color',
	// 			'default'=> ''
	// 		),
	// 		'sub_title' =>array(
	// 			'title'=> __('Sub Title','be-themes'),
	// 			'type'=> 'tinymce',
	// 			'default'=> '',
	// 			'content'=> true
	// 		),
	// 		'separator_color' => array(
	// 			'title'=> __('Divider Color','be-themes'),
	// 			'type'=>'color',
	// 			'default'=> '#141414'
	// 		),
	// 		'border_color' => array(
	// 			'title'=> __('Border Color','be-themes'),
	// 			'type'=>'color',
	// 			'default'=> '#ffffff'
	// 		),
	// 		'bg_color' => array(
	// 			'title'=> __('Background Color','be-themes'),
	// 			'type'=>'color',
	// 			'default'=> '#ffffff'
	// 		),
	// 		'bg_opacity' => array(
	// 			'title'=> __('Background Opacity','be-themes'),
	// 			'type'=> 'text',
	// 			'default'=> '50'
	// 		),
	// 		'scroll_to_animate' => array (
	// 			'title'=> __('Enable Animation When Scrolling','be-themes'),
	// 			'type'=> 'checkbox',
	// 			'default'=> '',
	// 		),
	// 		'animate' =>array(
	// 			'title'=>__('Enable CSS Animation','be-themes'),
	// 			'type'=>'checkbox',
	// 			'default'=> '',
	// 		),
	// 		'animation_type' =>array(
	// 			'title'=>__('Animation Type','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> $animations,
	// 			'default'=> 'fadeIn',
	// 		),
	// 	)
	// );
	
	$be_shortcode['special_heading3'] = array (
		'name' => __('Special Title Style3', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output' => true,
		'options' => array(
			'title_content' =>array(
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'sub_title1' =>array(
				'title'=> __('Top Caption','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'sub_title2' =>array(
				'title'=> __('Bottom Caption','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'top_caption_color' => array(
				'title'=> __('Top Caption Color','be-themes'),
				'type'=>'color',
				'default'=> '#999999'
			),
			'bottom_caption_color' => array(
				'title'=> __('Bottom Caption Color','be-themes'),
				'type'=>'color',
				'default'=> '#999999'
			),
			'top_caption_size' => array(
				'title'=> __('Top Caption Font Size','be-themes'),
				'type'=>'text',
				'default'=> '16'
			),
			'bottom_caption_size' => array(
				'title'=> __('Bottom Caption Font Size','be-themes'),
				'type'=>'text',
				'default'=> '16'
			),
			'top_caption_font' => array(
				'title'=> __('Font for Top Caption','be-themes'),
				'type'=>'select',
				'options' => array('Body'=> 'body', 'Special Title Font' => 'special', 'Heading 6' => 'h6'),
				'default'=> 'h6'
			),
			'bottom_caption_font' => array(
				'title'=> __('Font for Bottom Caption','be-themes'),
				'type'=>'select',
				'options' => array('Body'=> 'body', 'Special Title Font' => 'special', 'Heading 6' => 'h6'),
				'default'=> 'h6'
			),
			'top_caption_separator_color' => array(
				'title'=> __('Top Caption Separator Color','be-themes'),
				'type'=>'color',
				'default'=> '#efefef'
			),
			'bottom_caption_separator_color' => array(
				'title'=> __('Bottom Caption Separator Color','be-themes'),
				'type'=>'color',
				'default'=> '#efefef'
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['special_sub_title'] = array(
		'name' => __('Special Sub Title', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title_content' => array (
				'title'=> __('Sub Title Text','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'font_size' =>array(
				'title'=>__('Font Size','be-themes'),
				'type'=>'text',
				'default'=> '18',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'title_alignment' => array(
				'title'=> __('Title Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('center','right','left'),
				'default'=> 'center',
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'max_width' =>array (
				'title'=> __('Maximum Width','be-themes'),
				'type'=> 'text',
				'default'=> 100,
			),
			'margin_bottom' =>array (
				'title'=> __('Margin Bottom (In Pixels)','be-themes'),
				'type'=> 'text',
				'default'=> 30,
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['title_icon'] = array(
		'name' => __('Title with Icon', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(			
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'size' =>array(
				'title'=>__('Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium'),
				'default'=> 'medium'
			),
			'alignment' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','right'),
				'default'=> 'left'
			),
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('circled','plain'),
				'default'=> 'circled'
			),			
			'icon_bg' => array(
				'title'=> __('Background Color of Icon if circled','be-themes'),
				'type'=> 'color',
				'default'=> ''
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000'
			),
			'icon_border_color' => array(
				'title'=> __('Icon Border Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000'
			),
			'description' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['video'] = array(
		'name' => __('Video', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'options' => array(
			'source' =>array(
				'title'=>__('Choose a Video style','be-themes'),
				'type'=>'select',
				'options'=> array('youtube','vimeo'),
				'default'=> 'youtube'
			),
			'url' => array(
				'title'=> __('Enter the video url','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),			
		)
	);

	$be_shortcode['notifications'] = array(
		'name' => __('Notifications', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'bg_color' =>array(
				'title'=>__('Background Color of Notification box','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			),
			'notice' => array(
				'title'=> __('Notification Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),			
		)
	);


	$be_shortcode['button'] = array (
		'name' => __('Buttons', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'button_text' =>array(
				'title'=>__('Button Text','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'icon_alignment' =>array (
				'title' => __('Icon Alignment','be-themes'),
				'type' => 'select',
				'options' => array('Left' => 'left', 'Right' => 'right'),
				'default' => 'left',
			),
			'url' => array (
				'title'=> __('Button Link','be-themes'),
				'type'=>'text',
				'default'=> 'http://themeforest.net'
			),
			'new_tab' =>array(
				'title'=>__('Open Link in New Tab','be-themes'),
				'type'=>'select',
				'options'=> array('No' => 'no', 'Yes' => 'yes'),
				'default'=> 'no',
			),					
			'type' =>array (
				'title'=>__('Button Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium','large','block'),
				'default'=> 'medium'
			),
			'alignment' =>array (
				'title'=>__('Button Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('none', 'left', 'center', 'right'),
				'default'=> 'none',
			),							
			'bg_color' =>array (
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'hover_bg_color' =>array (
				'title'=>__('Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> '',
			),
			'color' =>array (
				'title'=>__('Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_color' =>array (
				'title'=>__('Hover Text Color','be-themes'),
				'type'=> 'color',
				'default'=> '',
			),
			'border_width' => array (
				'title'=> __('Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),			
			'border_color' => array (
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000',
			),
			'hover_border_color' => array (
				'title'=> __('Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'button_style' =>array (
				'title'=>__('Button Style','be-themes'),
				'type'=>'select',
				'options'=> array (
					'None' => 'none', 
					'Rounded' => 'rounded',
					'Circular' => 'circular',
				),
				'default'=> 'none'
			),		
			'image' => array (
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'background_animation' =>array (
				'title' => __('Hover BG Animation Type','be-themes'),
				'type' => 'select',
				'options'=> array (
					'None' => 'bg-animation-none', 
					'Slide Left' => 'bg-animation-slide-left',
					'Slide Right' => 'bg-animation-slide-right',
					'Slide Top' => 'bg-animation-slide-top',
					'Slide Bottom' => 'bg-animation-slide-bottom',
				),
				'default' => 'fadeIn',
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);



 	$be_shortcode['call_to_action'] = array (
		'name' => __('Call to Action', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'bg_color' =>array (
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h4',
			),			
			'title_color' =>array(
				'title'=>__('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),						
			'button_text' => array(
				'title' => __('Button Text', 'be-themes'),
				'type' => 'text',
				'default' => __('Click Here', 'be-themes')
			),
			'button_link' => array(
				'title' => __('URL to be linked to the button', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'new_tab' =>array(
				'title'=>__('Open Link in New Tab','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'no',
			),
			'button_bg_color' =>array(
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'hover_bg_color' =>array(
				'title'=>__('Button Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000',
			),
			'color' =>array(
				'title'=>__('Button Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_color' =>array(
				'title'=>__('Button Hover Text Color','be-themes'),
				'type'=> 'color',
				'default'=> '#ffffff'
			),
			'border_width' => array (
				'title'=> __('Button Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '1',
			),			
			'border_color' => array(
				'title'=> __('Button Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_border_color' => array (
				'title'=> __('Button Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'image' => array (
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),				
		)
	);			       

	$be_shortcode['tabs'] = array (
		'name' => __('Tabs', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'tab'		
	);

	$be_shortcode['tab'] = array (
		'name' => __('Tab', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,			
		'options' => array (
			'title' => array (
				'title'=> __('Tab Title','be-themes'),
				'type'=>'text'
			),
			'icon' => array (
				'title'=> __('Choose icon','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
			),
			'tab_content' => array(
				'title'=> __('Tab Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			),
			'title_color' =>array (
				'title'=>__('Title Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_color']) && !empty($be_themes_data['sec_color'])) ? $be_themes_data['sec_color'] : ''
			),
		)		
	);	

	$be_shortcode['accordion'] = array(
		'name' => __('Accordion Toggles', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'toggle',
		'options' => array (
			'collapsed' => array (
				'title' => __('Collapse content','be-themes'),
				'type' => 'checkbox',
				'default' => 0
			)
		)
	);

	$be_shortcode['toggle'] = array (
		'name' => __('Toggle', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,
		'options' => array (
			'title' => array (
				'title'=> __('Accordian Title','be-themes'),
				'type'=>'text'
			),
			'accordion_content' => array(
				'title'=> __('Accordian Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			),
			'title_color' =>array(
				'title'=>__('Title Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_color']) && !empty($be_themes_data['sec_color'])) ? $be_themes_data['sec_color'] : ''
			),
		)		
	);



	$be_shortcode['lists'] = array(
		'name' => __('Lists', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'list'		
	);

	$be_shortcode['list'] = array(
		'name' => __('List Item', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,
		'options' => array(
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'circled' =>array(
				'title'=>__('Circled ?','be-themes'),
				'type'=>'checkbox',
				'default'=> 0
			),
			'icon_bg' => array(
				'title'=> __('Background Color if circled','be-themes'),
				'type'=>'color',
				'default'=>(isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '#141414'
			),
			'list_content' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			)																							
		)
	);		



	$be_shortcode['flex_slider'] = array (
		'name' => __('BE Image Slider', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'flex_slide',
		'options' => array(
			// 'animation' => array(
			// 	'title'=> __('Animation Style','be-themes'),
			// 	'type'=>'select',
			// 	'options' => array('slide','fade'),
			// 	'default'=>'fade'
			// ),
			'auto_slide' => array(
				'title'=> __('Auto Slide','be-themes'),
				'type'=>'select',
				'options' => array('yes','no'),
				'default'=>'yes'
			),
			'slide_interval' => array(
				'title'=> __('Slide Interval if auto slide is enabled','be-themes'),
				'type'=>'number',
				'metric' => 'ms'
			),
		)		
	);

	$be_shortcode['flex_slide'] = array(
		'name' => __('Slide', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a slider image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'video' => array(
				'title'=> __('Enter Youtube/ Vimeo url if you wish to have video in the slide','be-themes'),
				'type'=>'text',
			)									
		)		
	);

	$be_shortcode['testimonials'] = array (
		'name' => __('Testimonials', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field' => true,
		'single_field' => 'testimonial',
		'options' => array (
			'testimonial_font_size' => array (
				'title' => __('Testimonial Font Size (In Pixels)','be-themes'),
				'type' => 'text',
				'default' => '14',
			),
			'author_role_font' => array (
				'title' => __('Author Role - Font Type','be-themes'),
				'type' => 'select',
				'options' => array('Body'=> 'body', 'Special Title Font' => 'special', 'Heading 6' => 'h6'),
				'default' => 'body',
			),
			'alignment' => array (
				'title' => __('Alignment','be-themes'),
				'type' => 'select',
				'options' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
				'default' => 'center'
			),
			'pagination' => array(
				'title'=> __('Enable Pagination','be-themes'),
				'type'=>'checkbox',
				'default'=>'0',
			),
			'slide_show' =>array (
				'title' => __('Enable Slide Show','be-themes'),
				'type' => 'select',
				'options' => array('Yes' => 'yes', 'No' => 'no'),
				'default' => 'no'
			),
			'slide_show_speed' =>array (
				'title' => __('Slide Show Speed','be-themes'),
				'type'=>'number',
				'metric' => 'ms',
				'default' => 4000,
			),
			'animate' =>array (
				'title' => __('Enable CSS Animation','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'animation_type' =>array (
				'title' =>__('Animation Type','be-themes'),
				'type' =>'select',
				'options' => $animations,
				'default' => 'fadeIn',
			),			
		)		
	);
	
	$be_shortcode['testimonial'] = array (
		'name' => __('Testimonial', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,			
		'options' => array (
			'description' => array (
				'title'=> __('Testimonial Content','be-themes'),
				'type'=>'tinymce',
				'content'=> true,
			),
			'author_image' => array (
				'title'=> __('Testimonial Author Image','be-themes'),
				'type' => 'media',
				'default'=>'',
				'select' => 'single'
			),
			'quote_color' => array (
				'title' => __('Quote Icon Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'author' => array (
				'title' => __('Testimonial Author','be-themes'),
				'type' => 'text',
				'default' => '',
			),			
			'author_color' => array (
				'title' => __('Testimonial Author Text Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'author_role' => array (
				'title' => __('Testimonial Author Role','be-themes'),
				'type' => 'text',
				'default' => '',
			),			
			'author_role_color' => array (
				'title' => __('Testimonial Author Role Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
		)		
	);

	$be_shortcode['content_slides'] = array (
		'name' => __('Content Slider', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field' => true,
		'single_field' => 'content_slide',
		'options' => array (
			// 'slide_animation_type' =>array (
			// 	'title' => __('Slide Animation type','be-themes'),
			// 	'type' => 'select',
			// 	'options' => array('Fade' => 'fade', 'Slide' => 'slide'),
			// 	'default' => 'slide'
			// ),
			'slide_show' =>array (
				'title' => __('Enable Slide Show','be-themes'),
				'type' => 'select',
				'options' => array('Yes' => 'yes', 'No' => 'no'),
				'default' => 'yes'
			),
			'slide_show_speed' =>array (
				'title' => __('Slide Show Speed','be-themes'),
				'type'=>'number',
				'metric' => 'ms',
				'default' => 4000,
			),
			'content_max_width' =>array (
				'title' => __('Content Max Width','be-themes'),
				'type' => 'text',
				'default' => 100,
			),
			'bullets_color' => array (
				'title'=> __('Navigation Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000'
			),
			'animate' =>array (
				'title' => __('Enable CSS Animation','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'animation_type' =>array (
				'title' =>__('Animation Type','be-themes'),
				'type' =>'select',
				'options' => $animations,
				'default' => 'fadeIn',
			),			
		)		
	);
	
	$be_shortcode['content_slide'] = array (
		'name' => __('Content Slide', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,
		'options' => array (
			'content' => array (
				'title'=> __('Content','be-themes'),
				'type'=> 'tinymce',
				'content' => true,
			)
		)		
	);

	$be_shortcode['project_details'] = array (
		'name' => __('Portfolio Details', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'options' => array (
			'style' => array (
				'title'=> __('Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Style1' => 'style1', 'Style2' => 'style2'),
				'default'=> 'style1'
			),		
			'alignment' => array (
				'title' => __('Alignment','be-themes'),
				'type' => 'select',
				'options' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
				'default' => 'left'
			)
		)
	);

	$be_shortcode['linebreak'] = array(
		'name' => __('Extra Spacing', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'options' => array (
			'height' => array (
				'title'=> __('Height in px','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'hide_mobile' => array (
				'title' => __('Hide If Mobile Devices','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)			
	);	 


	$be_shortcode['recent_posts'] = array(
		'name' => __('Recent - Blog Posts Masonry Style', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array(
			'number' => array(
				'title'=> __('Number of Items','be-themes'),
				'type'=>'select',
				'options'=>array('three','four'),
				'default'=>'three'
			),
			'hide_excerpt' =>array (
				'title' => __('Hide Excerpt','be-themes'),
				'type' => 'checkbox',
				'default' => 'true'
			)								
		)
	);	

	// $be_shortcode['recent_posts_style_2'] = array(
	// 	'name' => __('Recent - Blog Posts Bar Style2', 'be-themes'),
	// 	'type' => 'single',
	// 	'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
	// 	'options' => array (
	// 		'number' => array (
	// 			'title' => __('Number of Items','be-themes'),
	// 			'type' => 'text',
	// 			'default' => 3
	// 		)							
	// 	)
	// );	

	$be_shortcode['section'] = array(
		'name' => __('Section Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array(
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),			
			'bg_image' => array(
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_repeat' => array(
				'title'=> __('Background Repeat','be-themes'),
				'type'=>'select',
				'options'=> array('repeat','repeat-x','four','repeat-y', 'no-repeat'),
				'default'=>'repeat'
			),
			'bg_attachment' => array(
				'title'=> __('Background Attachment','be-themes'),
				'type'=>'select',
				'options'=>array('scroll','fixed'),
				'default'=>'scroll'
			),
			'bg_position' => array(
				'title'=> __('Background Position','be-themes'),
				'type'=>'select',
				'options'=> array('top left','top right','top center', 'center left', 'center right', 'center center','bottom left','bottom right','bottom center'),
				'default'=> 'top left'
			),
			'bg_stretch' =>array(
				'title'=>__('Center Scale Image to occupy container','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'bg_animation' => array (
				'title'=> __('Background Image Animation','be-themes'),
				'type'=> 'select',
				'options'=> array (
						'None' => 'none',
						'Parallax' => 'be-bg-parallax',
						'Mouse Move' => 'be-bg-mousemove-parallax',
						'Horizontal Loop Animation' => 'background-horizontal-animation',
						'Vertical Loop Animation' => 'background-vertical-animation',
				),
				'default'=> 'none'
			),
			'border_size' => array(
				'title'=> __('Border Size','be-themes'),
				'type'=>'text',
				'default'=> '1'
			),
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'padding_top' => array(
				'title'=> __('Top Padding','be-themes'),
				'type'=>'number',
				'default'=> '60',
				'metric' => 'px'
			),		
			'padding_bottom' => array(
				'title'=> __('Bottom Padding','be-themes'),
				'type'=>'number',
				'default'=> '60',
				'metric' => 'px'
			),
			'padding_edge' => array(
				'title'=> __('Left and Right Padding','be-themes'),
				'type'=>'number',
				'default'=> '',
				'metric' => '%'
			),
			'offset_section' =>array(
				'title'=>__('Offset Section (to value equal to Top Padding)','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),	
			'bg_video' =>array(
				'title'=>__('Enable Background Video','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),				
			'bg_video_mp4_src' => array(
				'title'=> __('.MP4 Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_ogg_src' => array(
				'title'=> __('.OGG Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_webm_src' => array(
				'title'=> __('.Webm Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_overlay' =>array(
				'title'=>__('Enable Background Overlay','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' => array (
				'title'=> __('Background Overlay Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'overlay_opacity' => array (
				'title'=> __('Background Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'section_id' => array (
				'title'=> __('Section Id','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'section_class' => array (
				'title'=> __('Section Class (Split multiple classes using Comma)','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'section_title' => array (
				'title'=> __('Section Title','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'full_screen' =>array (
				'title'=>__('Full Screen Section','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'full_screen_header_scheme' =>array (
				'title'=>__('Full Screen Section Transparent Header Scheme','be-themes'),
				'type'=>'select',
				'options'=> array (
						"Dark" => "background--light",
						"Light" => "background--dark"
				),
				'default'=> 'background--dark',
			),
			'hide_mobile' => array (
				'title' => __('Hide If Mobile Devices','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)
	);
	
	$column = array (
		'name' => __('Column Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'exclude' => true,
		'options' => array (
			'bg_color' => array (
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),			
			'bg_image' => array (
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_repeat' => array (
				'title'=> __('Background Repeat','be-themes'),
				'type'=>'select',
				'options'=>array('repeat','repeat-x','four','repeat-y', 'no-repeat'),
				'default'=>'repeat'
			),
			'bg_attachment' => array (
				'title'=> __('Background Attachment','be-themes'),
				'type'=>'select',
				'options'=>array('scroll','fixed'),
				'default'=>'scroll'
			),
			'bg_position' => array (
				'title'=> __('Background Position','be-themes'),
				'type'=>'select',
				'options'=>array('top left','top right','top center', 'center left', 'center right', 'center center','bottom left','bottom right','bottom center'),
				'default'=>'top left'
			),
			'bg_stretch' =>array(
				'title'=>__('Center Scale Image to occupy container','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'top_pad' =>array(
				'title'=> __('Top Padding','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'right_pad' =>array(
				'title'=> __('Right Padding','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'bottom_pad' =>array(
				'title'=> __('Bottom Padding','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'left_pad' =>array(
				'title'=> __('Left Padding','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'padding_value' => array(
				'title'=> __('Padding Values To','be-themes'),
				'type'=> 'select',
				'options'=> array (
						"Percentage" => '%',
						"Pixels" => 'px',
				),
				'default'=> 'px'
			),
			'center_pad' =>array(
				'title'=>__('Column Padding','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'bottom_margin' =>array(
				'title'=>__('Bottom Margin <br/> <span style = "color: red; font-size: 10px">Enter only numbers</span>','be-themes'),
				'type'=>'text',
				'default'=> 50,
			),
			'bg_video' =>array(
				'title'=>__('Enable Background Video','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),				
			'bg_video_mp4_src' => array(
				'title'=> __('.MP4 Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_ogg_src' => array(
				'title'=> __('.OGG Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_webm_src' => array(
				'title'=> __('.Webm Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_overlay' =>array(
				'title'=>__('Enable Background Overlay','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' => array (
				'title'=> __('Background Overlay Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'overlay_opacity' => array (
				'title'=> __('Background Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'animate_overlay' => array (
				'title'=> __('Animate Overlay','be-themes'),
				'type'=> 'select',
				'options'=> array('None' => 'none', 'Hidden by default and Show on Hover' => 'hide', 'Shown by default and Hide on Hover' => 'show'),
				'default'=> 'none'
			),
			'link_overlay' => array (
				'title'=> __('Link Overlay/Column URL','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'vertical_align' => array (
				'title'=> __('Vertical Alignment','be-themes'),
				'type'=> 'select',
				'options'=> array('none', 'top', 'middle', 'bottom'),
				'default'=> 'none'
			),
			'animate' =>array (
				'title'=> __('Enable CSS Animation','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=> __('Animation Type','be-themes'),
				'type'=> 'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
			'col_id' => array (
				'title'=> __('Column Id','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'column_class' => array (
				'title'=> __('Column Class (Split multiple classes using Comma)','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'hide_mobile' => array (
				'title' => __('Hide If Mobile Devices','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)
	);
	
	$be_shortcode['one_col'] = $column;
	$be_shortcode['one_half'] = $column;
	$be_shortcode['one_third'] = $column;
	$be_shortcode['one_fourth'] = $column;
	$be_shortcode['one_fifth'] = $column;
	$be_shortcode['two_third'] = $column;
	$be_shortcode['three_fourth'] = $column;

	$be_shortcode['row'] = array (
		'name' => __('Row Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array(
			'no_wrapper' =>array(
				'title'=>__('No Wrap ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'no_margin_bottom' =>array(
				'title'=>__('Zero Bottom Margin ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'no_space_columns' =>array (
				'title'=>__('Edge to Edge Columns','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'column_spacing' =>array(
				'title'=> __('Column Spacing','be-themes'),
				'type'=> 'number',
				'default'=> '',
				'metric'=>'px'
			),
			'row_id' => array (
				'title'=> __('Row Id','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'row_class' => array (
				'title'=> __('Row Class (Split multiple classes using Comma)','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'hide_mobile' => array (
				'title' => __('Hide If Mobile Devices','be-themes'),
				'type' => 'checkbox',
				'default' => 0,
			),
		)
	);



	$be_shortcode['gmaps'] = array(
		'name' => __('Google Map', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array (
			// 'api_key' => array (
			// 	'title'=> __('Your Google Geocoding API Key','be-themes'),
			// 	'type'=>'text',
			// 	'default'=>'',
			// ),
			'address' => array (
				'title'=> __('Address','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'latitude' => array (
				'title'=> __('Latitude','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'longitude' => array (
				'title'=> __('Longitude','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'height' => array(
				'title'=> __('Height in px (only numbers)','be-themes'),
				'type'=>'text',
				'default'=>'300',
			),
			'zoom' => array(
				'title'=> __('Zoom Value','be-themes'),
				'type'=>'text',
				'default'=>'14',
			),
			'style'=> array(
				'title'=> __('Style','be-themes'),
				'type'=>'select',
				'options'=>array('standard','greyscale', 'bluewater', 'midnight','black'),
				'default'=>'standard' 
			),
			'marker' => array(
				'title'=> __('Custom Marker Pin','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),			
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['grids'] = array (
		'name' => __('Icon/Image Grid', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'grid_content',
		'options' => array (
			'column' => array (
				'title' => __('Columns','be-themes'),
				'type' => 'text',
				'default'=> 1
			),
			'border_color' => array (
				'title' => __('Border Color','be-themes'),
				'type' => 'color',
				'default' => '',
			),
		)	
	);

	$be_shortcode['grid_content'] = array (
		'name' => __('Grid Content', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array (
			'icon' =>array (
				'title'=> __('Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'icon_size' =>array (
				'title'=> __('Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> array('tiny','small','medium', 'large','xlarge'),
				'default'=> 'medium',
			),
			'icon_color' => array (
				'title' => __('Icon Color','be-themes'),
				'type' => 'color',
				'default' => (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'content' => array (
				'title'=> __('Content','be-themes'),
				'type' => 'tinymce',
				'default'=> '',
				'content'=>true,
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);

	$be_shortcode['icon'] = array (
		'name' => __('Icons', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'backend_output' => true,
		'options' => array (
			'name' => array (
				'title'=>__('Icon','be-themes'),
				'type'=>'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none',
				//'content'=>true,
			),
			'size' =>array(
				'title'=>__('Size','be-themes'),
				'type'=>'select',
				'options' => array('tiny','small','medium','large','xlarge'),
				'default'=> 'medium',
			),			
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('circle','plain','square','diamond'),
				'default'=> 'circle',
			),
			'bg_color' =>array(
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'hover_bg_color' =>array(
				'title'=>__('Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'color' =>array(
				'title'=>__('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_color' =>array(
				'title'=>__('Hover Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'border_width' => array(
				'title'=> __('Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '1',
			),			
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_border_color' => array(
				'title'=> __('Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'alignment' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('none', 'left', 'center', 'right'),
				'default'=> 'none',
			),
			'href' => array(
				'title'=> __('URL to be linked to the Icon','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'new_tab' =>array (
				'title'=>__('Open as new tab','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'image' => array(
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['pricing_column'] = array(
		'name' => __('Pricing Table', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'pricing_feature',
		'backend_output' => false,
		'options' => array(
			'style' =>array(
				'title'=>__('Style Options','be-themes'),
				'type'=>'select',
				'options'=> array('Normal Header' => 'style-1', 'Colored Header' => 'style-2'),
				'default'=> 'style-1',
			),
			'header_bg_color' =>array(
				'title'=>__('Header Background Color (Applied on Colored Header)','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'header_color' =>array(
				'title'=>__('Header Text Color (Applied on Colored Header)','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Title Heading Tag','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h5',
			),
			'price' => array(
				'title' => __('Price', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),					
			'duration' => array(
				'title' => __('Duration', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'currency' => array(
				'title' => __('Currency', 'be-themes'),
				'type' => 'text',
				'default' => __('$', 'be-themes')
			),			
			'button_text' => array(
				'title' => __('Button Text', 'be-themes'),
				'type' => 'text',
				'default' => __('Click Here', 'be-themes')
			),
			'button_link' => array(
				'title' => __('Url to be linked to the button', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'button_color' =>array(
				'title'=>__('Button Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'button_hover_color' =>array(
				'title'=>__('Button Hover Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'button_bg_color' =>array(
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'button_bg_hover_color' =>array(
				'title'=>__('Button Background Hover Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'button_border_color' =>array(
				'title'=>__('Button Border Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'button_border_hover_color' =>array(
				'title'=>__('Button Border Hover Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),									
			'highlight' =>array(
				'title'=>__('Highlight Column','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'no',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)				
	);

	$be_shortcode['pricing_feature'] = array(
		'name' => __('Pricing Feature', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => true,		
		'options' => array(
			'feature' => array(
				'title'=> __('Feature','be-themes'),
				'type'=>'text',
			),
			'highlight' =>array(
				'title'=>__('Highlight this section ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'highlight_color' =>array(
				'title'=>__('Highlight Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			),			
			'highlight_text_color' =>array(
				'title'=>__('Highlight Text Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_color']) && !empty($be_themes_data['sec_color'])) ? $be_themes_data['sec_color'] : ''
			)

		)		
	);
	
	$be_shortcode['skills'] = array(
		'name' => __('Skills', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'skill',
		'options' => array (
			'direction' => array (
				'title' => __('Direction','be-themes'),
				'type' => 'select',
				'options' => array('Horizontal' => 'horizontal', 'Vertical' => 'vertical'),
				'default' => 'horizontal'
			),
			'height' => array (
				'title' => __('Skill Height if Vertical Direction','be-themes'),
				'type' => 'text',
				'default' => 400
			),
		)	
	);

	$be_shortcode['skill'] = array(
		'name' => __('Skill Option', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'options' => array(
			'title' => array(
				'title'=> __('Skill Name','be-themes'),
				'type'=>'text',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['sec_color']) && !empty($be_themes_data['sec_color'])) ? $be_themes_data['sec_color'] : ''
			),
			'value' => array(
				'title'=> __('Skill Score in %','be-themes'),
				'type'=>'text',
				'default'=>'50',
			),
			'fill_color' => array(
				'title'=> __('Fill Color','be-themes'),
				'type'=>'color',
				'default'=>(isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			), 			  							
		)		
	);
	$be_shortcode['clients'] = array(
		'name' => __('Clients', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'client',
		'options' => array (
			'slide_show' =>array (
				'title' => __('Enable Slide Show','be-themes'),
				'type' => 'select',
				'options' => array('Yes' => 'yes', 'No' => 'no'),
				'default' => 'yes'
			),
			'slide_show_speed' =>array (
				'title' => __('Slide Show Speed','be-themes'),
				'type'=>'number',
				'metric' => 'ms',
				'default' => 4000,
			)
		)
	);	

	$be_shortcode['client'] = array(
		'name' => __('Client', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a Client image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'link' => array(
				'title'=> __('URL to be linked to Client Website','be-themes'),
				'type'=>'text',
			),
			'new_tab' => array(
				'title'=> __('Open Link in New tab','be-themes'),
				'type'=>'select',
				'options'=>array('yes','no'),
				'default'=>'yes'
			),
			'default_image_style' => array (
				'title'=>__('Default Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),
			'hover_image_style' => array (
				'title'=>__('Hover Image Style','be-themes'),
				'type'=> 'select',
				'options'=> array('Black And White' => 'black_white', 'Color' => 'color'),
				'default' => 'color',
			),								
		)		
	);
	
	$be_shortcode['services'] = array(
		'name' => __('Services', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'service',
		'options' => array (
			'line_color' =>array (
				'title'=>__('Timeline Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['sec_border']) && !empty($be_themes_data['sec_border'])) ? $be_themes_data['sec_border'] : ''
			)
		)
	);	

	$be_shortcode['service'] = array(
		'name' => __('Service', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array (
			'icon' =>array (
				'title'=>__('Service Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'icon_size' =>array (
				'title'=>__('Service Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> array('small','medium','large'),
				'default'=> 'medium',
			),
			'icon_bg_color' =>array (
				'title'=>__('Service Icon Background Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			),
			'icon_color' =>array (
				'title'=>__('Service Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> '#141414'
			),
			'icon_hover_bg_color' =>array (
				'title'=>__('Service Icon Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'icon_hover_color' =>array (
				'title'=>__('Service Icon Hover Color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['alt_bg_text_color']) && !empty($be_themes_data['alt_bg_text_color'])) ? $be_themes_data['alt_bg_text_color'] : ''
			),
			'content' => array(
				'title'=> __('Servies Content','be-themes'),
				'type'=> 'tinymce',
				'content'=>true
			),
			'content_bg_color' =>array (
				'title'=>__('Services content BG color','be-themes'),
				'type'=> 'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			),
		)		
	);
	
	$be_shortcode['animated_numbers'] = array(
		'name' => __('Animated Numbers', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'options' => array(
			'number' => array(
				'title'=> __('Number','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'caption' => array(
				'title'=> __('Caption','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'number_size' => array(
				'title'=> __('Number Size','be-themes'),
				'type'=>'text',
				'default'=> '45'
			),
			'number_color' => array(
				'title'=> __('Number Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),			
			'caption_size' => array(
				'title'=> __('Caption Size','be-themes'),
				'type'=>'text',
				'default'=> '13'
			),	
			'caption_color' => array(
				'title'=> __('Caption Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),	
			'alignment' => array (
				'title' => __('Alignment','be-themes'),
				'type' => 'select',
				'options' => array (
					'Left' => 'left',
					'Center' => 'center',
					'Right' => 'right'
				),
				'default'=> 'center'
			),																				
		)
	);
	
	$be_shortcode['chart'] = array (
		'name' => __('Animated Chart', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',
		'options' => array(
			'percentage' => array (
				'title'=> __('Percentage','be-themes'),
				'type'=> 'text',
				'default'=> 70
			),
			'icon' =>array (
				'title'=>__('Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'percentage_font_size' => array (
				'title'=> __('Percentage / Icon - Font Size','be-themes'),
				'type'=> 'text',
				'default'=> '14'
			),
			'percentage_color' => array(
				'title'=> __('Percentage / Icon - Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'caption' => array (
				'title'=> __('Caption','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'caption_size' => array (
				'title'=> __('Caption Font Size','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'caption_color' => array(
				'title'=> __('Caption Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'percentage_bar_color' => array(
				'title'=> __('Percentage Bar Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'percentage_track_color' => array(
				'title'=> __('Percentage Track Color','be-themes'),
				'type'=>'color',
				'default'=> (isset($be_themes_data['sec_bg']) && !empty($be_themes_data['sec_bg'])) ? $be_themes_data['sec_bg'] : ''
			),
			'percentage_scale_color' => array(
				'title'=> __('Percentage Scale Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'size' => array(
				'title'=> __('Chart Size','be-themes'),
				'type'=> 'text',
				'default'=> 100
			),
			'linewidth' => array(
				'title'=> __('Bar Width','be-themes'),
				'type'=> 'text',
				'default'=> 5
			),
		)
	);
	$be_shortcode['contact_form'] = array (
		'name' => __('Contact Form', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'backend_output'=>false,
		'options' => array (
			'input_bg_color' => array (
				'title'=> __('Input Background Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'input_color' => array (
				'title'=> __('Input Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'input_border_color' => array (
				'title' => __('Input border Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'border_width' => array (
				'title' => __('Border Width','be-themes'),
				'type' => 'text',
				'default' => ''
			),
			'input_height' => array (
				'title' => __('Input Height','be-themes'),
				'type' => 'text',
				'default' => ''
			),
			'input_style' => array (
				'title' => __('Input Style','be-themes'),
				'type' => 'select',
				'options' => array('Bordered' => 'style1', 'Under-line' => 'style2'),
				'default' => 'style1'
			),
			'input_button_style' => array (
				'title' => __('Button Style','be-themes'),
				'type' => 'select',
				'options' => array('Small' => 'small', 'Medium' => 'medium', 'Large' => 'large', 'Block' => 'block'),
				'default' => 'medium'
			),
			'bg_color' =>array (
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'color' =>array (
				'title'=>__('Button Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
		)
	);

	$be_shortcode['animate_icons_style1'] = array (
		'name' => __('Fixed Height Animated Module', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'animate_icon_style1',
		'options' => array (
			'height' => array (
				'title'=> __('Height','be-themes'),
				'type' => 'text',
				'default' => 300
			),
			'gutter' => array (
				'title'=> __('Gutter Width','be-themes'),
				'type' => 'text',
				'default' => 30
			)
		)
	);

	$be_shortcode['animate_icon_style1'] = array (
		'name' => __('Animate Module Element', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => false,
		'options' => array (
			'link_to_url' => array (
				'title'=> __('URL to be linked','be-themes'),
				'type' => 'text',
				'default' => ''
			),
			'bg_image' => array (
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_color' => array (
				'title'=> __('Background Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'hover_bg_color' => array (
				'title'=> __('Background Color - Hover State','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'bg_overlay' =>array(
				'title'=>__('Enable Overlay','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' => array (
				'title'=> __('Overlay Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'overlay_opacity' => array (
				'title'=> __('Overlay Background Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'hover_overlay_color' => array (
				'title'=> __('Hover Overlay Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'hover_overlay_opacity' => array (
				'title'=> __('Hover Overlay Background Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'icon' => array (
				'title'=> __('Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'size' => array (
				'title'=> __('Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> $be_font_size,
				'default'=> 30
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'content' => array (
				'title'=> __('Content on Hover','be-themes'),
				'type'=> 'tinymce',
				'default'=> '',
				'content'=> true,
			),
			'animate_direction' => array (
				'title'=> __('Animate Direction','be-themes'),
				'type'=> 'select',
				'options'=> array('Top' => 'top', 'Left' => 'left', 'Right' => 'right', 'Bottom' => 'bottom', 'Fade' => 'fade'),
				'default'=> 'top'
			),
		)
	);

	$be_shortcode['animate_icons_style2'] = array (
		'name' => __('Variable Height Animated Module', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'animate_icon_style2'
	);

	$be_shortcode['animate_icon_style2'] = array (
		'name' => __('Animated Module Element', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',
		'backend_output' => false,
		'options' => array (
			'bg_color' => array (
				'title'=> __('Background Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'hover_bg_color' => array (
				'title'=> __('Background Color - Hover State','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'icon' => array (
				'title'=> __('Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'size' => array (
				'title'=> __('Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> $be_font_size,
				'default'=> 30
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'icon_color_hover_state' => array (
				'title'=> __('Icon Color - Hover State','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h6',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'title_color_hover_state' => array(
				'title'=> __('Title Color - Hover State','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'content' => array (
				'title'=> __('Content on Hover','be-themes'),
				'type'=> 'tinymce',
				'default'=> '',
				'content'=> true,
			),
		)
	);

	$be_shortcode['tweets'] = array(
		'name' => __('Tweets', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'options' => array(
			'account_name' =>array(
				'title'=> __('Tweet Account Name','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'count' => array(
				'title'=> __('Tweet Count','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'content_size' => array(
				'title'=> __('Tweet Font Size (In Pixels)','be-themes'),
				'type'=>'text',
				'default'=>'12',
			),
			'tweet_bird_color' => array(
				'title'=> __('Tweet Bird Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> '',
			),
			'color' => array(
				'title'=> __('Text Color','be-themes'),
				'type'=> 'color',
				'default'=> '',
			),
			'alignment' => array (
				'title' => __('Alignment','be-themes'),
				'type' => 'select',
				'options' => array('Left' => 'left', 'Center' => 'center'),
				'default' => 'center'
			),
			'autoplay' => array(
				'title'=> __('Autoplay Duration ( Enter 0 to turn autoplay off)','be-themes'),
				'type'=>'number',
				'default'=>'0',
				'metric' => 'ms'
			),
			'pagination' => array(
				'title'=> __('Enable Pagination','be-themes'),
				'type'=>'checkbox',
				'default'=>'0',
			),
			'animate' =>array (
				'title' => __('Enable CSS Animation','be-themes'),
				'type' => 'checkbox',
				'default' => '',
			),
			'animation_type' =>array (
				'title' =>__('Animation Type','be-themes'),
				'type' =>'select',
				'options' => $animations,
				'default' => 'fadeIn',
			),
		)
	);
	
	$be_shortcode['be_slider'] = array (
		'name' => __('Be Slider', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'be_slide',
		'options' => array (
			'animation_type' => array (
				'title'=> __('Slider Animation Type','be-themes'),
				'type'=> 'select',
				'options'=> array('fxSoftScale', 'fxPressAway', 'fxSideSwing', 'fxFortuneWheel', 'fxSwipe', 'fxPushReveal', 'fxSnapIn', 'fxLetMeIn', 'fxStickIt', 'fxArchiveMe', 'fxVGrowth', 'fxSlideBehind', 'fxSoftPulse', 'fxEarthquake', 'fxCliffDiving'),
				'default'=> 'fxSoftScale'
			),
			'slider_height' => array (
				'title'=> __('Slider Height','be-themes'),
				'type'=> 'text',
				'default'=> '360'
			),
			'slider_mobile_height' => array (
				'title'=> __('Slider Height in mobile device','be-themes'),
				'type'=> 'text',
				'default'=> '360'
			),
		)	
	);

	$be_shortcode['be_slide'] = array (
		'name' => __('Slide', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array (
			'image' => array (
				'title'=> __('Choose a slider image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_video' =>array (
				'title'=>__('Enable Background Video','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),				
			'bg_video_mp4_src' => array (
				'title'=> __('.MP4 Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_ogg_src' => array (
				'title'=> __('.OGG Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_webm_src' => array (
				'title'=> __('.Webm Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'content_width' => array (
				'title' => __('Content Width','be-themes'),
				'type' => 'text',
				'default'=> ''
			),
			'left' => array (
				'title' => __('Left - Position %','be-themes'),
				'type' => 'text',
				'default' => '10'
			),
			'right' => array (
				'title' => __('Right - Position %','be-themes'),
				'type' => 'text',
				'default' => '10'
			),
			'top' => array (
				'title' => __('Top - Position %','be-themes'),
				'type' => 'text',
				'default' => '10'
			),
			'bottom' => array (
				'title' => __('Bottom - Position %','be-themes'),
				'type' => 'text',
				'default' => '10'
			),
			'content' => array (
				'title'=> __('Slide Content','be-themes'),
				'type'=> 'tinymce',
				'content'=>true
			),
			'content_animation_type' =>array (
				'title'=>__('Content Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);

	$be_shortcode['process_style1'] = array (
		'name' => __('Process Style', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'process_col',
		'options' => array (
			'border_color' => array (
				'title' => __('Border Color','be-themes'),
				'type' => 'color',
				'default' => '',
			),
		)	
	);

	$be_shortcode['process_col'] = array (
		'name' => __('Process', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'multi_single',			
		'options' => array (
			'icon' =>array (
				'title'=> __('Icon','be-themes'),
				'type'=> 'select_icon',
				'options'=> $be_font_icon_elegant,
				'default'=> 'none'
			),
			'icon_color' => array (
				'title' => __('Icon Color','be-themes'),
				'type' => 'color',
				'default' => (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'icon_size' => array (
				'title'=> __('Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> $be_font_size,
				'default'=> 60
			),
			'content' => array (
				'title'=> __('Content','be-themes'),
				'type'=> 'tinymce',
				'content'=>true
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);

	$be_shortcode['menu_card'] = array (
		'name' => __('Menu Card', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',			
		'options' => array (
			'title' => array (
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'ingredients' => array (
				'title'=> __('Ingredients','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'price' => array (
				'title'=> __('Price','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'title_color' => array (
				'title' => __('Title Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'ingredients_color' => array (
				'title' => __('Ingredients Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'price_color' => array (
				'title' => __('Price Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'highlight' =>array (
				'title'=> __('Highlight this item','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'highlight_color' => array (
				'title' => __('highlight Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'star' =>array (
				'title'=> __('Important','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'star_color' => array (
				'title' => __('Star Color','be-themes'),
				'type' => 'color',
				'default' => (isset($be_themes_data['color_scheme']) && !empty($be_themes_data['color_scheme'])) ? $be_themes_data['color_scheme'] : ''
			),
			'border_color' => array (
				'title' => __('Border Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);
	$be_shortcode['newsletter'] = array (
		'name' => __('News Letter', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',			
		'options' => array (
			'api_key' => array (
				'title'=> __('Mailchimp.com Api key','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'id' => array (
				'title'=> __('Mailchimp.com List ID','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'width' => array (
				'title'=> __('Width (In Percentage)','be-themes'),
				'type'=> 'text',
				'default'=> '100',
			),
			'alignment' => array (
				'title' => __('Alignment','be-themes'),
				'type' => 'select',
				'options' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
				'default' => 'left'
			),
			'button_text' => array(
				'title' => __('Button Text', 'be-themes'),
				'type' => 'text',
				'default' => __('Submit', 'be-themes')
			),
			'bg_color' =>array(
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'hover_bg_color' =>array(
				'title'=>__('Button Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000',
			),
			'color' =>array(
				'title'=>__('Button Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_color' =>array(
				'title'=>__('Button Hover Text Color','be-themes'),
				'type'=> 'color',
				'default'=> '#ffffff'
			),
			'border_width' => array (
				'title'=> __('Button Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '1',
			),			
			'border_color' => array(
				'title'=> __('Button Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_border_color' => array (
				'title'=> __('Button Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);

	$be_shortcode['be_countdown'] = array (
		'name' => __('Countdown', 'be-themes'),
		'icon' => BE_PB_ROOT_URL.'images/shortcodes/plus-white.png',
		'type' => 'single',			
		'options' => array (
			'date_time' => array (
				'title'=> __('Countdown End Date & Time in YYYY-MM-DD HH:MM:SS format','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'text_color' => array (
				'title' => __('Text Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),			
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)		
	);

}

?>