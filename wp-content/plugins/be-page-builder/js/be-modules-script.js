;(function (jQuery) {
    "use strict";
    /*jslint browser: true, unparam: true, regexp: true, node: true*/
    /*global $, jQuery, alert, google, no_ajax_pages*/
    var $page_loader = jQuery('.page-loader'), ajax_url = jQuery('#ajax_url').val(), transition, $exclude_links;
 
    /************************************
        COUNTDOWN
    ************************************/

    function be_countdown() {
      //  jQuery.countdown.setDefaults();
       if(jQuery('.be-countdown').length > 0) {  
            jQuery('.be-countdown').each( function() {
                var $this = jQuery(this);
                var $date = moment( $this.attr('data-time'), 'YYYY-MM-DD HH:mm:ss').toDate();  //new Date( $this.attr('data-time') );
                //alert( $date);
                jQuery(this).countdown({until: $date});
               // $(this).countdown($.countdown.regionalOptions[$langcode]); 
            }); 
       }
    }    


    /************************************
        GOOGLE MAPS
    ************************************/
    function be_google_maps() {
        if(jQuery('.gmap').length > 0) {
            var styles = {
                black : [{"featureType" : "water", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 17}]}, {"featureType" : "landscape", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 20}]}, {"featureType" : "road.highway", "elementType" : "geometry.fill", "stylers" : [{"color" : "#000000"}, {"lightness" : 17}]}, {"featureType" : "road.highway", "elementType" : "geometry.stroke", "stylers" : [{"color" : "#000000"}, {"lightness" : 29}, {"weight" : 0.2}]}, {"featureType" : "road.arterial", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 18}]}, {"featureType" : "road.local", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 16}]}, {"featureType" : "poi", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 21}]}, {"elementType" : "labels.text.stroke", "stylers" : [{"visibility" : "on"}, {"color" : "#000000"}, {"lightness" : 16}]}, {"elementType" : "labels.text.fill", "stylers" : [{"saturation" : 36}, {"color" : "#000000"}, {"lightness" : 40}]}, {"elementType" : "labels.icon", "stylers" : [{"visibility" : "off"}]}, {"featureType" : "transit", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}, {"lightness" : 19}]}, {"featureType" : "administrative", "elementType" : "geometry.fill", "stylers" : [{"color" : "#000000"}, {"lightness" : 20}]}, {"featureType" : "administrative", "elementType" : "geometry.stroke", "stylers" : [{"color" : "#000000"}, {"lightness" : 17}, {"weight" : 1.2}]}],
                greyscale: [{"featureType" : "landscape", "stylers" : [{"saturation" : -100}, {"lightness" : 65}, {"visibility" : "on"}]}, {"featureType" : "poi", "stylers" : [{"saturation" : -100}, {"lightness" : 51}, {"visibility" : "simplified"}]}, {"featureType" : "road.highway", "stylers" : [{"saturation" : -100}, {"visibility" : "simplified"}]}, {"featureType" : "road.arterial", "stylers" : [{"saturation" : -100}, {"lightness" : 30}, {"visibility" : "on"}]}, {"featureType" : "road.local", "stylers" : [{"saturation" : -100}, {"lightness" : 40}, {"visibility" : "on"}]}, {"featureType" : "transit", "stylers" : [{"saturation" : -100}, {"visibility" : "simplified"}]}, {"featureType" : "administrative.province", "stylers" : [{"visibility" : "off"}]}, {"featureType" : "water", "elementType" : "labels", "stylers" : [{"visibility" : "on"}, {"lightness" : -25}, {"saturation" : -100}]}, {"featureType" : "water", "elementType" : "geometry", "stylers" : [{"hue" : "#ffff00"}, {"lightness" : -25}, {"saturation" : -97}]}],
                midnight: [{"featureType" : "water", "stylers" : [{"color" : "#021019"}]}, {"featureType" : "landscape", "stylers" : [{"color" : "#08304b"}]}, {"featureType" : "poi", "elementType" : "geometry", "stylers" : [{"color" : "#0c4152"}, {"lightness" : 5}]}, {"featureType" : "road.highway", "elementType" : "geometry.fill", "stylers" : [{"color" : "#000000"}]}, {"featureType" : "road.highway", "elementType" : "geometry.stroke", "stylers" : [{"color" : "#0b434f"}, {"lightness" : 25}]}, {"featureType" : "road.arterial", "elementType" : "geometry.fill", "stylers" : [{"color" : "#000000"}]}, {"featureType" : "road.arterial", "elementType" : "geometry.stroke", "stylers" : [{"color" : "#0b3d51"}, {"lightness" : 16}]}, {"featureType" : "road.local", "elementType" : "geometry", "stylers" : [{"color" : "#000000"}]}, {"elementType" : "labels.text.fill", "stylers" : [{"color" : "#ffffff"}]}, {"elementType" : "labels.text.stroke", "stylers" : [{"color" : "#000000"}, {"lightness" : 13}]}, {"featureType" : "transit", "stylers" : [{"color" : "#146474"}]}, {"featureType" : "administrative", "elementType" : "geometry.fill", "stylers" : [{"color" : "#000000"}]}, {"featureType" : "administrative", "elementType" : "geometry.stroke", "stylers" : [{"color" : "#144b53"}, {"lightness" : 14}, {"weight" : 1.4}]}],
                standard: [],
                bluewater: [{"featureType" : "water", "stylers" : [{"color" : "#46bcec"}, {"visibility" : "on"}]}, {"featureType" : "landscape", "stylers" : [{"color" : "#f2f2f2"}]}, {"featureType" : "road", "stylers" : [{"saturation" : -100}, {"lightness" : 45}]}, {"featureType" : "road.highway", "stylers" : [{"visibility" : "simplified"}]}, {"featureType" : "road.arterial", "elementType" : "labels.icon", "stylers" : [{"visibility" : "off"}]}, {"featureType" : "administrative", "elementType" : "labels.text.fill", "stylers" : [{"color" : "#444444"}]}, {"featureType" : "transit", "stylers" : [{"visibility" : "off"}]}, {"featureType" : "poi", "stylers" : [{"visibility" : "off"}]}]
            };
            jQuery('.gmap').each(function () {
                var $address = jQuery(this).data('address'), $zoom = jQuery(this).data('zoom'), $lat = jQuery(this).attr('data-latitude'), $lan = jQuery(this).attr('data-longitude'), $custom_marker = jQuery(this).attr('data-marker'), map_style = jQuery(this).attr('data-style'), mapOptions = {
                    zoom: $zoom,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    center: new google.maps.LatLng(parseFloat($lat), parseFloat($lan)),
                    styles: styles[map_style]
                }, map = new google.maps.Map(jQuery(this)[0], mapOptions), marker = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat($lat), parseFloat($lan)),
                    map: map,
                    title: $address,
                    icon: $custom_marker
                });
                marker.setMap(map);
            });
        }
    }

    /************************************
       TEAM
    ************************************/
    function arrange_team() {
        jQuery('.grid-wrap:not(.changed)').each(function () {
            var $this = jQuery(this), $col = Number($this.attr('data-col')), i = 0;
            $this.addClass('changed');
            $this.find('.grid-col').css('width', 100 / $col + '%');
            $this.find('.grid-col:nth-of-type(' + $col + 'n)').css('border-right', 'none');
            for (i; i < $this.find('.grid-col').length; i += $col) {
                $this.find('.grid-col').slice(i, i + $col).wrapAll("<div class='grid-row clearfix'></div>");
            }
            $this.find('.grid-row:last-child').find('.grid-col').css('border-bottom', 'none');
            $this.css('opacity', 1);
        });
        if(jQuery('.process-style1').length > 0) {
            jQuery('.process-style1').each(function () {
                jQuery(this).find('.process-divider:last-child').remove();
            });
        }
    }
    function arrange_animate_icon() {
        jQuery('.animate-icon-module-style1').each(function () {
            var $this = jQuery(this), $width, $gutter = Number($this.closest('.animate-icon-module-style1-wrap').attr('data-gutter-width')), $item_width;
            $width = Number($this.closest('.animate-icon-module-style1-wrap-container').width());
            $this.closest('.animate-icon-module-style1-wrap').width($width);
            $item_width = ($width - (($this.siblings().length) * $gutter));
            $this.width($item_width / ($this.siblings().length + 1));
            if ($this.is(':last-child')) {
                $this.css('margin-right', '0px');
            } else {
                $this.css('margin-right', $gutter + 'px');
            }
            $this.css('opacity', 1);
        });
        jQuery('.animate-icon-module-style2-wrap').each(function(){

            var $this = jQuery(this), $normal_content_height = 0, $hover_content_height = 0, $module_height = 0;
            var $max_module_height = 0;
            var i=1;

            // Find the Height of the Tallest Sibling
            $this.find('.animate-icon-module-style2').each(function () {
                var $this_module = jQuery(this);

                $normal_content_height = Number($this_module.find('.animate-icon-module-style2-normal-content').innerHeight());
                $hover_content_height = Number($this_module.find('.animate-icon-module-style2-hover-content').innerHeight());
                $module_height = $normal_content_height + $hover_content_height;
                
                if(jQuery(window).width() <= 960){
                    $this_module.closest('.animate-icon-module-style2-wrap').css('height', 'auto');
                    $this_module.find('.animate-icon-module-style2-inner-wrap').css('height', $module_height + 115 + 'px');
                }else{
                    if(i==1){
                        $max_module_height = $module_height; 
                    }else{
                        if($module_height >= $max_module_height){
                            $max_module_height = $module_height;    
                        }
                    }
                    i=i+1;
                }
            });
            // Set the Padding and Height to individual modules
            // jQuery('.animate-icon-module-style2').each(function () {
            //     var $this_module = jQuery(this);

            //     $normal_content_height = Number($this_module.find('.animate-icon-module-style2-normal-content').innerHeight());

            //     $this_module.find('.animate-icon-module-style2-normal-content').css('padding-top', ($max_module_height - ($normal_content_height / 2)));
                
            // });
            if(jQuery(window).width() > 960){
                $this.css('height', $max_module_height * 2 + 40 + 'px');
                $this.find('.animate-icon-module-style2-inner-wrap').css('height', 'auto');
            }
            
            $this.find('.animate-icon-module-style2').css('opacity', 1);

        });
    }
    function be_lightbox() {
        if (jQuery('.image-popup-vertical-fit').length > 0) {
            jQuery('.image-popup-vertical-fit').magnificPopup({
                mainClass: 'mfp-img-mobile my-mfp-zoom-in',
                closeOnContentClick: true,
                gallery: {
                    enabled: true
                },
                image: {
                    verticalFit: true,
                    titleSrc: 'title'
                },
                zoom: {
                    enabled: true,
                    duration: 300
                },
                preloader: true,
                type: 'inline',
                overflowY: 'auto',
                removalDelay: 300,
                callbacks: {
                    afterClose: function () {
                        // jQuery(window).trigger('resize');
                        if (jQuery('body').hasClass('smooth-scroll')) {
                            jQuery('html').css('overflow-y', 'scroll');
                        }
                    },
                    open: function () {
                        jQuery('body').addClass('mfp-active-state');
                        if (jQuery('#main').hasClass('layout-border')) {
                            jQuery('.mfp-content').addClass('layout-border');
                        }
                    },
                    close: function () {
                        jQuery('body').removeClass('mfp-active-state');
                    }
                }
            });
        }
        if (jQuery('.mfp-iframe').length > 0) {
            jQuery('.mfp-iframe').magnificPopup({
                iframe: {  
                    patterns: {
                        youtube: {
                          index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                          id: 'v=', // String that splits URL in a two parts, second part should be %id%
                          // Or null - full URL will be returned
                          // Or a function that should return %id%, for example:
                          // id: function(url) { return 'parsed id'; }

                          src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&showinfo=0' // URL that will be set as a source for iframe.
                        }
                    }
                }
            });
        }
        if (jQuery('.popup-gallery').length > 0) {
            jQuery('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                },
                preloader: true,
                callbacks: {
                    afterClose: function () {
                        // jQuery(window).trigger('resize');
                        if (jQuery('body').hasClass('smooth-scroll')) {
                            jQuery('html').css('overflow-y', 'scroll');
                        }
                    },
                    open: function () {
                        jQuery('body').addClass('mfp-active-state');
                        if (jQuery('#main').hasClass('layout-border')) {
                            jQuery('.mfp-content').addClass('layout-border');
                        }
                    },
                    close: function () {
                        jQuery('body').removeClass('mfp-active-state');
                    }
                }
            });
        }
        if (jQuery('.popup-with-content').length > 0) {
            jQuery('.popup-with-content').magnificPopup({
                type: 'inline',
                preloader: false
            });
        }
    }
    function be_custom_scroll_animation() {
        if(jQuery('.animate-number.animate').length > 0) {
            jQuery('.animate-number.animate').each(function (i, el) {
                var el = jQuery(el);
                if (el.visible(true)) {
                    el.removeClass('animate');
                    var $endval = Number(el.attr('data-number'));
                    el.countTo({
                        from : 0,
                        to : $endval,
                        speed : 1500,
                        refreshInterval : 30
                    });
                }
            });
        }
        if(jQuery('.chart').length > 0) {
            jQuery('.chart').each(function (i, el) {
                var el = jQuery(el);
                if (el.visible(true)) {
                    var $this = jQuery(this), $barColor = $this.attr('data-percentage-bar-color'), $trackColor = $this.attr('data-percentage-track-color'), $scaleColor = $this.attr('data-percentage-scale-color'), $size = $this.attr('data-size'), $lineWidth = $this.attr('data-linewidth');
                    $this.easyPieChart({
                        animate : 1000,
                        barColor : $barColor,
                        trackColor : $trackColor,
                        scaleColor : $scaleColor,
                        size : $size,
                        lineWidth : $lineWidth,
                        onStep : function (from, to, percent) {
                            jQuery(this.el).find('span.percentage').text(Math.round(percent));
                            jQuery(this.el).find('span.percentage').attr('data-from', from);
                            jQuery(this.el).find('span.percentage').attr('data-to', to);
                        }
                    });
                }
            });
        }
        if(jQuery('.be-skill').length > 0) {
            jQuery('.be-skill').each(function (i, el) {
                var el = jQuery(el);
                if (el.visible(true)) {
                    var $this = jQuery(this), $animate_property = 'width';
                    if ($this.closest('.skill_container').hasClass('skill-vertical')) {
                        $animate_property = 'height';
                    }
                    $this.css($animate_property, jQuery(this).attr('data-skill-value'));
                }
            });
        }
        if(jQuery('.be-animate').length > 0) {
            jQuery('.be-animate').each(function (i, el) {
                var el = jQuery(el);
                if (el.visible(true)) {
                    el.addClass("already-visible");
                    el.addClass(el.attr('data-animation'));
                    el.addClass('animated');
                }
            });
        }
        if(jQuery('.be-section.be-bg-parallax').length > 0) {
            jQuery('.be-section.be-bg-parallax').each(function (i, el) {
                var el = jQuery(el);
                if (el.visible(true)) {
                    if(!jQuery(this).hasClass('parallaxed')) {
                        jQuery(this).parallax("50%", 0.4);
                        jQuery(this).addClass('parallaxed');
                    }
                }
            });
        }
        if(jQuery('.portfolio-container.portfolio-item-parallax').length > 0) {
            if(jQuery('html').hasClass('no-touch') && (jQuery(window).width() >= 768)) {
                jQuery('.portfolio-container.portfolio-item-parallax').each(function() {
                    var $window_height = jQuery(window).height(), $window_scroll_top = jQuery(window).scrollTop();
                    jQuery(this).find('.element.parallax-effect').each(function() {
                        var $this = jQuery(this), offset = $this.offset().top, animate_pos = offset-($window_height/2), opacity = ((animate_pos) - $window_scroll_top)/1.5, opacity_2 = opacity*1.7;
                        $this.find('.element-inner').css({
                            '-webkit-transform' : 'translatey('+opacity_2+'px) scale(0.7) translatez(0px)',
                            '-moz-transform' : 'translatey('+opacity_2+'px) scale(0.7) translatez(0px)',
                            '-o-transform' : 'translatey('+opacity_2+'px) scale(0.7) translatez(0px)',
                            '-ms-transform' : 'translatey('+opacity_2+'px) scale(0.7) translatez(0px)',
                            'transform' : 'translatey('+opacity_2+'px) scale(0.7) translatez(0px)'
                        });
                        $this.find('.thumb-title-wrap, .custom-like-button').css({
                            '-webkit-transform' : 'scale(1.4) translatez(0px)',
                            '-moz-transform' : 'scale(1.4) translatez(0px)',
                            '-o-transform' : 'scale(1.4) translatez(0px)',
                            '-ms-transform' : 'scale(1.4) translatez(0px)',
                            'transform' : 'scale(1.4) translatez(0px)'
                        });
                    });
                    jQuery(this).find('.element.no-parallax-effect').each(function() {
                        var $this = jQuery(this), offset = $this.offset().top, animate_pos = offset-($window_height/2), opacity = ((animate_pos) - $window_scroll_top)/2;
                        $this.find('.element-inner').css({
                            '-webkit-transform' : 'translatey('+opacity+'px) translatez(0px)',
                            '-moz-transform' : 'translatey('+opacity+'px) translatez(0px)',
                            '-o-transform' : 'translatey('+opacity+'px) translatez(0px)',
                            '-ms-transform' : 'translatey('+opacity+'px) translatez(0px)',
                            'transform' : 'translatey('+opacity+'px) translatez(0px)',
                        });
                    });
                });
            }
        }
    }
    /************************************    
    Column Block Min Height Reset
    ************************************/
    function be_reset_colblock_height(){
        if(jQuery(window).width() < 768){   
            jQuery('.be-no-space .column-block').each(function() {
                if(jQuery(this).children('div').children().length > 0){
                    jQuery(this).css('min-height','initial');    
                }
            });       
        }   
    }
    /************************************
        DOCUMEnT READY EVENT
    ************************************/
    function do_ajax_complete() {

        /********************************
            Justified Gallery
        ********************************/
        if(jQuery('.justified-gallery').length > 0){
            jQuery('.justified-gallery').each(function () {
                var $this = jQuery(this),
                    $gutter_width = $this.attr('data-gutter-width'),
                    $image_height = $this.attr('data-image-height');

                $this.imagesLoaded(function () {
                    $this.justifiedGallery({
                        rowHeight : $image_height,
                        margins : $gutter_width,
                    })

                    var delay = 1;
                    $this.find('.element').each(function () {
                    jQuery(this).find('img').one("load", function () {
                            jQuery(this).parent().delay(delay).addClass('img-loaded',300);
                            delay += 200;
                        }).each(function () {
                            if (this.complete) {
                                jQuery(this).load();
                            }
                        });
                    });
                });
            });
        }
        /********************************
            Justified Gallery Infinite Scroll
        ********************************/
        if(jQuery(".trigger_infinite_scroll.justified_gallery_infinite_scroll").length > 0) {
            jQuery(".trigger_infinite_scroll.justified_gallery_infinite_scroll").each(function () {
                var $this = jQuery(this),
                $justified_gallery_wrap = $this.closest('.justified-gallery-inner-wrap'),
                $justified_gallery = $justified_gallery_wrap.find('.justified-gallery'),
                $paged = Number($justified_gallery_wrap.attr("data-paged")),
                $action = $justified_gallery_wrap.attr("data-action"),
                $source = $justified_gallery_wrap.attr("data-source"),
                $images_arr = $justified_gallery_wrap.attr("data-images-array"),
                $items_per_load = $justified_gallery_wrap.attr("data-items-per-load"),
                $hover_style = $justified_gallery_wrap.attr("data-hover-style"),
                $img_grayscale = $justified_gallery_wrap.attr("data-image-grayscale"),
                $image_effect = $justified_gallery_wrap.attr("data-image-effect"),
                $thumb_overlay_color = $justified_gallery_wrap.attr("data-thumb-overlay-color"),
                $gradient_style_color = $justified_gallery_wrap.attr("data-grad-style-color"),
                $like_button =  $justified_gallery_wrap.attr("data-like-button"),
                $disable_overlay =  $justified_gallery_wrap.attr("data-disable-overlay"),
                $ajaxData = "action=" + $action + "&source=" + $source + "&images_arr=" + $images_arr + "&items_per_load=" + $items_per_load + "&hover_style=" + $hover_style + "&img_grayscale=" + $img_grayscale + "&image_effect=" + $image_effect + "&thumb_overlay_color=" + $thumb_overlay_color + "&gradient_style_color=" + $gradient_style_color + "&like_button=" + $like_button + "&disable_overlay=" + $disable_overlay ;
                
                var be_waypoint = new Waypoint({
                    element: $this,
                    handler: function (direction) {
                        if (direction === 'down') {
                            var $this_waypoint = this, 
                            $page_loader = jQuery('.page-loader');
                            $this_waypoint.disable(); //Disable Waypoint untill Images are Loaded
                            $page_loader.fadeIn();
                            jQuery.ajax({
                                type: "POST",
                                url: ajax_url,
                                data: $ajaxData + "&paged=" + $paged 
                            }).done(function (data) {
                                if (data != 'Array0' ) {
                                    var $newItems = jQuery(data);
                                    $newItems.imagesLoaded(function () {
                                        
                                        $justified_gallery.append($newItems).justifiedGallery('norewind').on('jg.complete', function () {
                                            Waypoint.refreshAll();    
                                            $this_waypoint.enable(); //Enable Waypoint 
                                        });
                                        
                                        var delay = 1;
                                        $justified_gallery.find('.element').each(function () {
                                        jQuery(this).find('img').one("load", function () {
                                                jQuery(this).parent().delay(delay).addClass('img-loaded',300);
                                                delay += 200;
                                            }).each(function () {
                                                if (this.complete) {
                                                    jQuery(this).load();
                                                }
                                            });
                                        });
                                        $paged = Number($paged) + 1;
                                        $page_loader.fadeOut();

                                    });
                                } else {
                                    $this_waypoint.destroy();
                                    $this.fadeOut();
                                    $page_loader.fadeOut();
                                }
                            });
                       }
                    }, 
                    offset: 'bottom-in-view'
                })

            });
        }
        /********************************
            Force Show Portfolio Title
        ********************************/        
        jQuery('.portfolio-container').imagesLoaded(function () {
            jQuery('.portfolio-container.force-show-thumb-overlay').css('opacity','1');
        });
        /********************************
            Accordion
        ********************************/
        if(jQuery('.accordion').length > 0) {
            jQuery('.accordion').each(function () {
                var $accordion = jQuery(this), $collapse = Number($accordion.attr('data-collapsed'));
                if ($collapse === 1) {
                    $accordion.accordion({
                        collapsible: $collapse,
                        heightStyle: "content",
                        active: false
                    }).css('opacity', 1);
                } else {
                    $accordion.accordion({
                        collapsible: $collapse,
                        heightStyle: "content"
                    }).css('opacity', 1);
                }
            });
        }
         

        /********************************
            Tabs
        ********************************/
        if (jQuery('.tabs').length > 0) {
            jQuery('.tabs').tabs({
                fx : {
                    opacity : 'toggle',
                    duration : 200
                }
            }).css('opacity', 1);
        }
        /********************************
            Parallax
        ********************************/
        if ((!jQuery('html').hasClass('touch')) && (jQuery('.be-section.be-bg-parallax').length > 0)) {
            jQuery('.be-section.be-bg-parallax').appear();
            jQuery('.be-section.be-bg-parallax').each(function () {
                if (jQuery(this).is(':appeared')) {
                    if(!jQuery(this).hasClass('parallaxed')) {
                        jQuery(this).parallax("50%", 0.5);
                        jQuery(this).addClass('parallaxed');
                    }
                }
            });
        }
        /********************************
            Photo Swipe Gallery 
        ********************************/

        (function() {

                var initPhotoSwipeFromDOM = function(gallerySelector) {

                    var parseThumbnailElements = function(el) {
                       // var thumbElements = el.childNodes,
                        //    numNodes = thumbElements.length,
                        var items = [],
                            el,
                            childElements,
                            thumbnailEl,
                            size,
                            item;

                        var anchor = jQuery(el).find('a.thumb-wrap');
                        anchor.each( function() {
                            size = jQuery(this).attr('data-size').split('x');
                            item = {
                                src: jQuery(this).attr('href'),
                                w: parseInt(size[0], 10),
                                h: parseInt(size[1], 10),
                                author: jQuery(this).attr('data-author')
                            };
                            item.title = jQuery(this).attr('title');
                            item.el = jQuery(this);
                            item.o = {
                                src: item.src,
                                w: item.w,
                                h: item.h
                            };

                            items.push(item);
                        });
                        return items;
                    };

                    // find nearest parent element
                    var closest = function closest(el, fn) {
                        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
                    };

                    var onThumbnailsClick = function(e) {
                        e = e || window.event;
                        e.preventDefault ? e.preventDefault() : e.returnValue = false;

                        var eTarget = e.target || e.srcElement;

                        if(!clickedListItem) {
                            return;
                        }

                        var clickedGallery = clickedListItem.parentNode;

                        var childNodes = clickedListItem.parentNode.childNodes,
                            numChildNodes = childNodes.length,
                            nodeIndex = 0,
                            index;

                        for (var i = 0; i < numChildNodes; i++) {
                            if(childNodes[i].nodeType !== 1) { 
                                continue; 
                            }

                            if(childNodes[i] === clickedListItem) {
                                index = nodeIndex;
                                break;
                            }
                            nodeIndex++;
                        }

                        if(index >= 0) {
                            openPhotoSwipe( index, clickedGallery );
                        }
                        return false;
                    };

                    var photoswipeParseHash = function() {
                        var hash = window.location.hash.substring(1),
                        params = {};

                        if(hash.length < 5) { // pid=1
                            return params;
                        }

                        var vars = hash.split('&');
                        for (var i = 0; i < vars.length; i++) {
                            if(!vars[i]) {
                                continue;
                            }
                            var pair = vars[i].split('=');  
                            if(pair.length < 2) {
                                continue;
                            }           
                            params[pair[0]] = pair[1];
                        }

                        if(params.gid) {
                            params.gid = parseInt(params.gid, 10);
                        }

                        if(!params.hasOwnProperty('pid')) {
                            return params;
                        }
                        params.pid = parseInt(params.pid, 10);
                        return params;
                    };

                    var openPhotoSwipe = function(index, galleryElement, disableAnimation) {

                        var pswpElement = document.querySelectorAll('.pswp')[0],
                            gallery,
                            options,
                            items,
                            history = true;

                        if(jQuery('body').hasClass('all-ajax-content')){
                            history = false;
                        }

                        items = parseThumbnailElements(galleryElement); //Parse Demo Gallery
                        
                        // define options (if needed)
                        options = {
                            index: index,
                            history: history,
                            galleryUID: galleryElement.attr('data-pswp-uid'),

                            getThumbBoundsFn: function(index) {
                                // See Options->getThumbBoundsFn section of docs for more info
                                
                                var thumbnail = items[index].el.find('img')[0],
                                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                                    rect = thumbnail.getBoundingClientRect(); 

                                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                            },

                            addCaptionHTMLFn: function(item, captionEl, isFake) {

                                if(!item.title) {
                                    captionEl.children[0].innerText = '';
                                    return false;
                                }
                                captionEl.children[0].innerHTML = item.title; //+  '<br/><small>Photo: ' + item.author + '</small>';
                                return true;
                            }
                            
                        };

                        var radios = document.getElementsByName('gallery-style');
                        for (var i = 0, length = radios.length; i < length; i++) {
                            if (radios[i].checked) {
                                if(radios[i].id == 'radio-all-controls') {

                                } else if(radios[i].id == 'radio-minimal-black') {
                                    options.mainClass = 'pswp--minimal--dark';
                                    options.barsSize = {top:0,bottom:0};
                                    options.captionEl = false;
                                    options.fullscreenEl = false;
                                    options.shareEl = false;
                                    options.bgOpacity = 0.85;
                                    options.tapToClose = true;
                                    options.tapToToggleControls = false;
                                }
                                break;
                            }
                        }

                        if(disableAnimation) {
                            options.showAnimationDuration = 0;
                        }

                        // Pass data to PhotoSwipe and initialize it
                        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);


                        // see: http://photoswipe.com/documentation/responsive-images.html
                        var realViewportWidth,
                            useLargeImages = false,
                            firstResize = true,
                            imageSrcWillChange;

                        gallery.listen('beforeResize', function() {

                            var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
                            dpiRatio = Math.min(dpiRatio, 2.5);
                            realViewportWidth = gallery.viewportSize.x * dpiRatio;


                            if(realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200 ) {
                                if(!useLargeImages) {
                                    useLargeImages = true;
                                    imageSrcWillChange = true;
                                }
                                
                            } else {
                                if(useLargeImages) {
                                    useLargeImages = false;
                                    imageSrcWillChange = true;
                                }
                            }

                            if(imageSrcWillChange && !firstResize) {
                                gallery.invalidateCurrItems();
                            }

                            if(firstResize) {
                                firstResize = false;
                            }

                            imageSrcWillChange = false;

                        });

                        gallery.listen('gettingData', function(index, item) {
                            //if( useLargeImages ) {
                                item.src = item.o.src;
                                item.w = item.o.w;
                                item.h = item.o.h;
                            // } else {
                            //     item.src = item.m.src;
                            //     item.w = item.m.w;
                            //     item.h = item.m.h;
                            // }
                        });

                        gallery.init();
                    };

                    // select all gallery elements
                    //var galleryElements = document.querySelectorAll( gallerySelector );

                    // for(var i = 0, l = galleryElements.length; i < l; i++) {
                    //     galleryElements[i].setAttribute('data-pswp-uid', i+1);
                    //     galleryElements[i].onclick = onThumbnailsClick;
                    // }

                    var galleryElements = jQuery(gallerySelector);
                    var i = 0;
                    galleryElements.each( function() {
                        var $this = jQuery(this);
                        $this.attr('data-pswp-uid',i+1);
                        $this.off('click');
                        $this.on('click', 'a.thumb-wrap', function(e) {
                            e.preventDefault();
                            openPhotoSwipe(jQuery(this).closest('.element').index(), $this );
                        });
                        i++;
                    });

                    // var galleryElements = $(this).find(gallerySelector);
                    // alert(galleryElements.length);

                    // Parse URL and open gallery if it contains #&pid=3&gid=1
                    var hashData = photoswipeParseHash();
                    if(hashData.pid > 0 && hashData.gid > 0) {
                        openPhotoSwipe( hashData.pid - 1 ,  galleryElements.eq( hashData.gid - 1 ), true );
                    }
                };

                initPhotoSwipeFromDOM('.be-photoswipe-gallery');

            })();
        /********************************
            Portfolio 
        ********************************/
        // be_portfolio_layout();
        if(jQuery('.portfolio-container').length > 0) {
            jQuery('.portfolio-container').each(function () {
                var $this = jQuery(this), $i = 0;
                if($this.closest('.portfolio').hasClass('two-col')) {
                    $this.find('.element').each(function() {
                        if($i == 1 || $i == 2) {
                            jQuery(this).addClass('parallax-effect');
                            $i = $i+1;
                        } else if($i == 3) {
                            jQuery(this).addClass('no-parallax-effect');
                            $i = 0;
                        } else {
                            jQuery(this).addClass('no-parallax-effect');
                            $i = $i+1;
                        }
                    });
                } else {
                    $this.find('.element:odd').addClass('parallax-effect');
                    $this.find('.element:even').addClass('no-parallax-effect');
                }
            }); 
        }
        if(jQuery('.element.style3-hover .element-inner').length > 0) {
            jQuery('.element.style3-hover .element-inner').each(function () {
                jQuery(this).hoverdir();
            });
        }
        if(jQuery('.element.style4-hover .element-inner').length > 0) {
            jQuery('.element.style4-hover .element-inner').each(function () {
                jQuery(this).hoverdir({
                    inverse : true
                });
            });
        }
        /********************************
            Text Rotate
        ********************************/
        if(jQuery(".rotates").length > 0) {
            jQuery(".rotates").each(function () {
                var $animation = jQuery(this).attr('data-animation'), $speed = Number(jQuery(this).attr('data-speed'));
                jQuery(this).textrotator({
                    animation : $animation,
                    separator : "||",
                    speed : $speed
                }).css('opacity', 1);
            });
        }
        /********************************
            Text Typed
        ********************************/
        if(jQuery(".typed").length > 0) {
            jQuery(".typed").each(function () {
                var $this = jQuery(this), $typed_text = $this.text(), $typed_text_arr = $typed_text.split('||');
                $this.empty().typed({
                    strings: $typed_text_arr,
                    typeSpeed: 30,
                    backDelay: 500,
                    loop: true,
                    loopCount: false
                }).css('opacity', 1);
            });
        }
        /********************************
            Services
        ********************************/
        if(jQuery(".be-services").length > 0) {
            jQuery('.be-services').each(function () {
                var $this = jQuery(this);
                $this.find('li:even').addClass('even');
                $this.find('li:odd').addClass('odd');
                $this.find('li:last-child').addClass('last');
                $this.animate({opacity: 1});
            });
        }

        /**********************************
            Client Carousel - Owl Implementation
        ********************************/

        if(jQuery('.client-carousel-module').length > 0){
            jQuery('.client-carousel-module').imagesLoaded(function () {
                jQuery('.client-carousel-module').each(function () {
                    var $this = jQuery(this),
                    $slideShow = $this.attr('data-slide-show'),
                    $slideshowspeed = 4000,
                    $item_number = $this.children('.client-carousel-item').length;

                    if($item_number > 5){
                        $item_number = 5;
                    }

                    if(0 == $slideShow){
                        $slideShow = false;
                    }else{
                        $slideShow = true;
                        $slideshowspeed = $this.attr('data-slide-show-speed');
                    }

                    if($item_number == 1){
                        $this.fadeIn();
                    }else{                    
                        $this.owlCarousel({
                            navSpeed: 500,
                            autoplay: $slideShow,
                            autoplayTimeout: $slideshowspeed,
                            autoplaySpeed: 1000,
                            autoplayHoverPause: true,
                            loop: true,
                            navRewind: false,
                            nav: false,
                            responsiveRefreshRate: 0,
                            responsive: {
                                0:{
                                    items:2,
                                    dots:true
                                },
                                768:{
                                    items:$item_number,
                                    dots:false
                                }
                            },
                            onInitialize: function() {
                                $this.fadeIn(500);
                                $this.trigger('refresh.owl.carousel');
                            },
                        });
                    }
                });
            });
        }   

        /**********************************
            Portfolio Carousel - Owl Implementation
        ********************************/  

        if(jQuery('.portfolio-carousel-module').length > 0){
            jQuery('.portfolio-carousel-module').imagesLoaded(function () {
                jQuery('.portfolio-carousel-module').each(function () {
                    var $this = jQuery(this),
                    $item_number = $this.children('.carousel-item').length;

                    if($item_number > 5){
                        $item_number = 5;
                    }

                    if($item_number == 1){
                        $this.fadeIn();
                    }else{
                        $this.owlCarousel({
                            autoplay: false,
                            autoplayHoverPause: true,
                            navRewind: false,
                            navText: ['<i class="font-icon icon-arrow_carrot-left"></i>','<i class="font-icon icon-arrow_carrot-right"></i>'],
                            responsiveRefreshRate: 0,
                            responsive: {
                                0:{
                                    items:2,
                                    dots:true,
                                    nav: false
                                },
                                767:{
                                    items:$item_number,
                                    dots:false,
                                    nav: true
                                }
                            },
                            onInitialize: function() {
                                $this.fadeIn(500);
                                $this.trigger('refresh.owl.carousel');
                            }
                        });
                    }
                });
            });
        }

        /********************************
            Image Slider(Flex Slider in the Past)
        ********************************/   
        
        if (jQuery('.be_image_slider').length > 0) {
            jQuery('.be_image_slider').imagesLoaded(function () {
                jQuery('.be_image_slider').each(function () {
                    var $this = jQuery(this).find('.image_slider_module'), 
                        $slideshow = $this.attr('data-auto-slide'), 
                        $slideshowspeed = 5000,
                        $number = $this.find('.be_image_slide').length;  

                    if('no' == $slideshow){
                        $slideshow = false;
                    }else{
                        $slideshow = true;
                        $slideshowspeed = $this.attr('data-slide-interval');
                    }

                    if($number == 1){
                        $this.fadeIn();
                    }else{
                        $this.owlCarousel({
                            items:1,
                            autoHeight: true,
                            autoplay: $slideshow,
                            autoplayTimeout: $slideshowspeed, 
                            autoplaySpeed: 1000,
                            autoplayHoverPause: true,
                            navRewind: false,
                            nav: true,
                            loop: true,
                            navText: ['<i class="font-icon icon-arrow_carrot-left"></i>','<i class="font-icon icon-arrow_carrot-right"></i>'],
                            dots:false,
                            onInitialize: function() {
                                $this.fadeIn(500);
                                $this.trigger('refresh.owl.carousel');
                            }
                        });
                    }
                });
            });
        }

        /********************************
                Testimonial Slider 
        ********************************/
        if (jQuery('.testimonials-slides').length > 0) {
            jQuery('.testimonials-slides').imagesLoaded(function () {
                jQuery('.testimonials-slides').each(function () {
                    
                    var $slide = jQuery(this),
                        $this = jQuery(this).find('.testimonial_module'), 
                        $slideshow = Number($this.attr('data-slide-show')), 
                        $slideshowspeed = 4000, 
                        $pagination = Number($this.attr('data-pagination')),
                        $number = $slide.find('.testimonial_slide').length;  

                    if(0 == $slideshow){
                        $slideshow = false;
                    }else{
                        $slideshow = true;
                        $slideshowspeed = $this.attr('data-slide-show-speed');
                    }

                    if($pagination == 0){
                        $pagination = false;
                    }else{
                        $pagination = true;
                    }
                    
                    if($number == 1){
                        $slide.fadeIn();
                    }else{
                        $this.owlCarousel({
                            items: 1 ,
                            autoHeight: true,
                            autoplay: $slideshow,
                            autoplayTimeout: $slideshowspeed,
                            autoplaySpeed: 1000,
                            autoplayHoverPause: true,
                            navRewind: false,
                            loop: true,
                            dots: $pagination,
                            onInitialize: function() {
                                $slide.fadeIn();
                                $this.trigger('refresh.owl.carousel');
                            }
                        });
                    }
                });
            });
        }

        /********************************
                Tweets Slider 
        ********************************/
        if (jQuery('.tweet-slides').length > 0) {
            jQuery('.tweet-slides').each(function () {
                var $slide = jQuery(this),
                $this = jQuery(this).find('.twitter_module'), 
                $autoplayTime = Number($this.attr('data-autoplay')) , 
                $autoplay = false,
                $pagination = Number($this.attr('data-pagination')),
                $number = $this.children('.tweet_list').length;

                if($autoplayTime == 0){
                    $autoplay = false;
                }else{
                    $autoplay = true;
                }
                if($pagination == 0){
                    $pagination = false;
                }else{
                    $pagination = true;
                }

                if($number == 1){
                    $slide.fadeIn();
                }else{
                    $this.owlCarousel({
                        items:1,
                        autoHeight: true,
                        autoplay: $autoplay,
                        autoplayTimeout: $autoplayTime,
                        autoplaySpeed: 1000,
                        autoplayHoverPause: true,
                        navRewind: false,
                        loop: true,
                        dots: $pagination,
                        onInitialize: function () {
                            $slide.fadeIn();
                            $this.trigger('refresh.owl.carousel');
                        }
                    });  
                }
            });
        }

        /********************************
            Content Slider 
        ********************************/
        if (jQuery('.content-slider').length > 0) {
            jQuery('.content-slider').imagesLoaded(function () {
                jQuery('.content-slider').each(function () {
                    var $slide = jQuery(this),
                        $this = jQuery(this).find('.content_slider_module'), 
                        $slideshow = Number($this.attr('data-slide-show')), 
                        $slideshowspeed = 4000,
                        $item_number = $this.children('.content_slide').length;
                    
                    if(0 == $slideshow){
                        $slideshow = false;
                    }else{
                        $slideshow = true;
                        $slideshowspeed = $this.attr('data-slide-show-speed');
                    }

                    if($item_number == 1){
                        $slide.fadeIn();
                    }else{
                        $this.owlCarousel({
                            items:1,
                            autoHeight: true,
                            autoplay: $slideshow,
                            autoplayTimeout: $slideshowspeed,
                            autoplaySpeed: 1000,
                            autoplayHoverPause: true,
                            navRewind: false,
                            loop: true,
                            dots: true,
                            onInitialize: function () {
                                $slide.fadeIn();
                                $this.trigger('refresh.owl.carousel');
                            }
                        });
                    }
                });
            });
        }

        /********************************
            Skill bar
        ********************************/
        if(jQuery('.skill_container.skill-vertical').length > 0) {
            jQuery('.skill_container.skill-vertical').each(function () {
                var $this = jQuery(this), $width = (100 / $this.find('.skill-wrap').length) + '%';
                $this.find('.skill-wrap').css('width', $width).css('display', 'block');
            });
        }
        arrange_team();
        arrange_animate_icon();
        be_google_maps();
        be_custom_scroll_animation();
        be_countdown();
        be_lightbox();
        be_reset_colblock_height();
    }
    /*******************************************************
    Ajax Load Pages with HTML Pushstate and page transitions
    ********************************************************/
    jQuery(document).on('update_content', function(){
        do_ajax_complete();
    });
    /************************************
        DOCUMET READY EVENT
    ************************************/
    jQuery(document).ready(function () {
        do_ajax_complete();
        
        /********************************
            Lightbox 
        ********************************/
        jQuery(document).on('click', '.be-lightbox-gallery', function (e) {
            e.preventDefault();
            jQuery(this).next('.popup-gallery').magnificPopup('open');
        });
        /********************************
            Notifications 
        ********************************/
        jQuery(document).on('click', '.be-notification .close', function (e) {
            e.preventDefault();
            jQuery(this).closest('.be-notification').slideUp(500);
        });
        jQuery(document).on('mouseenter', '.owl-carousel', function () {
            jQuery(this).find('.owl-buttons').css('opacity',1);
        });
        jQuery(document).on('mouseleave', '.owl-carousel', function () {
            jQuery(this).find('.owl-buttons').css('opacity',0);
        });
        /********************************
            Columns 
        ********************************/
        jQuery(document).on('mouseenter', '.column-block', function () {
            var data_opacity = jQuery(this).find('.section-overlay.animate-hide').attr("data-opacity");
            jQuery(this).find('.section-overlay.animate-hide').css('opacity',data_opacity);
        });
        jQuery(document).on('mouseleave', '.column-block', function () {
            jQuery(this).find('.section-overlay.animate-hide').css('opacity',0);
        });
        jQuery(document).on('mouseenter', '.column-block', function () {
            jQuery(this).find('.section-overlay.animate-show').css('opacity',0);
        });
        jQuery(document).on('mouseleave', '.column-block', function () {
            var data_opacity = jQuery(this).find('.section-overlay.animate-show').attr("data-opacity");
            jQuery(this).find('.section-overlay.animate-show').css('opacity',data_opacity);
        });
        /********************************
            Portfolio 
        ********************************/
        // Hover effect moved to CSS
        // jQuery(document).on('mouseenter', '.style1-hover .element-inner', function () {
        //     jQuery(this).find('.thumb-overlay').stop(true, true).fadeIn(400);
        // });
        // jQuery(document).on('mouseleave', '.style1-hover .element-inner', function () {
        //     jQuery(this).find('.thumb-overlay').stop(true, true).fadeOut(400);
        // });

        jQuery(document).on('mouseenter', '.no-touch .justified-gallery .style1-hover .element-inner', function () {
            jQuery(this).find('.thumb-overlay').stop(true, true).fadeIn(400);
        });
        jQuery(document).on('mouseleave', '.no-touch .justified-gallery .style1-hover .element-inner', function () {
            jQuery(this).find('.thumb-overlay').stop(true, true).fadeOut(400);
        });
        
        /********************************
            Contact Form
        ********************************/
        jQuery(document).on('click', '.contact_submit', function () {
            var $this = jQuery(this), $contact_status = $this.closest('.contact_form').find(".contact_status"), $contact_loader = $this.closest('.contact_form').find(".contact_loader");
            $contact_loader.fadeIn();
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                dataType: 'json',
                data: "action=contact_authentication&" + jQuery(this).closest(".contact").serialize(),
                success    : function (msg) {
                    $contact_loader.fadeOut();
                    if (msg.status === "error") {
                        $contact_status.removeClass("success").addClass("error");
                    } else {
                        $contact_status.addClass("success").removeClass("error");
                    }
                    $contact_status.html(msg.data).slideDown();
                },
                error: function () {
                    $contact_status.html("Please Try Again Later").slideDown();
                }
            });
            return false;
        });
        /********************************
            Contact Form
        ********************************/
        jQuery(document).on('click', '.mail-chimp-submit', function () {
            var $this = jQuery(this), $subscribe_status = $this.closest('.mail-chimp-wrap').find(".subscribe_status"), $subscribe_loader = $this.closest('.mail-chimp-wrap').find(".subscribe_loader");
            $subscribe_loader.fadeIn();
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                dataType: 'json',
                data: "action=mailchimp_subscription&" + jQuery(this).closest(".mail-chimp-form").serialize(),
                success : function (msg) {
                    $subscribe_loader.fadeOut();
                    if (msg.status === "error") {
                        $subscribe_status.removeClass("success").addClass("error");
                    } else {
                        $subscribe_status.addClass("success").removeClass("error");
                    }
                    $subscribe_status.html(msg.data).slideDown();
                },
                error: function () {
                    $subscribe_status.html("Please Try Again Later").slideDown();
                    $subscribe_loader.fadeOut();
                }
            });
            return false;
        });
        /********************************
            BUTTON 
        ********************************/
        jQuery(document).on('mouseenter', '.be-button', function () {
            var $border_color = jQuery(this).attr("data-hover-border-color"), $bg_color = jQuery(this).attr("data-hover-bg-color"), $color = jQuery(this).attr("data-hover-color"), $icon_color = jQuery(this).attr("data-hover-icon-color");
            jQuery(this).css('border-color', $border_color);
            jQuery(this).css('color', $color);
            jQuery(this).find('i').css('color', $icon_color);
            if(!((jQuery('html').hasClass('cssgradients')) && (jQuery(this).hasClass('bg-animation-slide-top') || jQuery(this).hasClass('bg-animation-slide-left') || jQuery(this).hasClass('bg-animation-slide-bottom') || jQuery(this).hasClass('bg-animation-slide-right')))) {
                jQuery(this).css('background-color', $bg_color);
            }
        });
        jQuery(document).on('mouseleave', '.be-button', function () {
            var $border_color = jQuery(this).attr("data-border-color"), $bg_color = jQuery(this).attr("data-bg-color"), $color = jQuery(this).attr("data-color"), $icon_color = jQuery(this).attr("data-icon-color");
            jQuery(this).css('border-color', $border_color);
            jQuery(this).css('color', $color);
            jQuery(this).find('i').css('color', $icon_color);
            if(!((jQuery('html').hasClass('cssgradients')) && (jQuery(this).hasClass('bg-animation-slide-top') || jQuery(this).hasClass('bg-animation-slide-left') || jQuery(this).hasClass('bg-animation-slide-bottom') || jQuery(this).hasClass('bg-animation-slide-right')))) {
                jQuery(this).css('background-color', $bg_color);
            }
        });
        /********************************
            ANIMATED ICONS 
        ********************************/
        jQuery(document).on('mouseenter', '.animate-icon-module', function () {
            var $bg_color = jQuery(this).attr("data-hover-bg-color");
            jQuery(this).css('background-color', $bg_color);
        });
        jQuery(document).on('mouseleave', '.animate-icon-module', function () {
            var $bg_color = jQuery(this).attr("data-bg-color");
            jQuery(this).css('background-color', $bg_color);
        });
        /********************************
            Font Icon 
        ********************************/
        jQuery(document).on('mouseenter', '.icon-shortcode .font-icon', function () {
            var $border_color = jQuery(this).attr("data-hover-border-color"), $bg_color = jQuery(this).attr("data-hover-bg-color"), $color = jQuery(this).attr("data-hover-color");
            jQuery(this).css('border-color', $border_color);
            jQuery(this).css('background-color', $bg_color);
            jQuery(this).css('color', $color);
        });
        jQuery(document).on('mouseleave', '.icon-shortcode .font-icon', function () {
            var $border_color = jQuery(this).attr("data-border-color"), $bg_color = jQuery(this).attr("data-bg-color"), $color = jQuery(this).attr("data-color");
            jQuery(this).css('border-color', $border_color);
            jQuery(this).css('background-color', $bg_color);
            jQuery(this).css('color', $color);
        });
        /********************************
            Services
        ********************************/
        jQuery(document).on('mouseenter', '.service-wrap', function () {
            var $hover_bg_color = jQuery(this).attr("data-hover-bg-color"), $hover_color = jQuery(this).attr("data-hover-color");
            jQuery(this).find('.font-icon').css({
                "background-color": $hover_bg_color,
                "color": $hover_color
            });
        });
        jQuery(document).on('mouseleave', '.service-wrap', function () {
            var $default_bg_color = jQuery(this).attr("data-bg-color"), $default_color = jQuery(this).attr("data-color");
            jQuery(this).find('.font-icon').css({
                "background-color": $default_bg_color,
                "color": $default_color
            });
        });
        /********************************
            Custom Like Button
        ********************************/
        jQuery(document).on('click', '.custom-like-button', function (e) {
            var $this = jQuery(this), $post_id = $this.attr('data-post-id');
            $this.addClass('disable');
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                dataType: 'json',
                data: "action=post_like&post_id=" + $post_id,
                success : function (msg) {
                    if (msg.status === "success") {
                        $this.addClass('liked');
                        $this.removeClass('no-liked');
                        $this.find('span').text(msg.count);
                    }
                },
                error: function (msg) {
                    alert(msg);
                }
            });
            return false;
        });
        jQuery(document).on('mouseenter', '.element-inner', function (e) {
            jQuery(this).find('.animation-trigger').addClass(function () {
                return jQuery(this).attr('data-animation-type');
            });
        });
        jQuery(document).on('mouseleave', '.element-inner', function (e) {
            jQuery(this).find('.animation-trigger').removeClass(function () {
                return jQuery(this).attr('data-animation-type');
            });
        });
        /********************************
            Animate Icon Module
        ********************************/
        jQuery(document).on('mouseenter', '.animate-icon-module-style2', function () {
            var $this = jQuery(this);
                // $normal_content_height = Number($this.find('.animate-icon-module-style2-normal-content').height()), 
                // $distence = 2;
            $this.css('background-color', $this.attr('data-hover-bg-color'));
            $this.find('.animate-icon-title').css('color', $this.attr('data-hover-title-color'));
            $this.find('.animate-icon-icon').css('color', $this.attr('data-hover-icon-color'));
            // if ($this.find('.animate-icon-module-style2-hover-content').height() < 1) {
            //     $distence = 4;
            // }
            // jQuery(this).find('.animate-icon-module-style2-normal-content').stop().animate({
            //     top: '-' + ($normal_content_height / $distence)
            // }, {
            //     duration: 400,
            //     easing: 'easeOutBack'
            // });
            // jQuery(this).find('.animate-icon-module-style2-hover-content').stop().animate({
            //     top: '50%'
            // }, {
            //     duration: 400,
            //     easing: 'easeOutExpo'
            // });
        });
        jQuery(document).on('mouseleave', '.animate-icon-module-style2', function () {
            var $this = jQuery(this);
            $this.css('background-color', $this.attr('data-bg-color'));
            $this.find('.animate-icon-title').css('color', $this.attr('data-title-color'));
            $this.find('.animate-icon-icon').css('color', $this.attr('data-icon-color'));
            // $this.find('.animate-icon-module-style2-normal-content').stop().animate({
            //     top: '0%'
            // }, {
            //     duration: 400,
            //     easing: 'easeOutBack'
            // });
            // $this.find('.animate-icon-module-style2-hover-content').stop().animate({
            //     top: '100%',
            //     opacity: 1
            // }, {
            //     duration: 400,
            //     easing: 'easeOutExpo'
            // });
        });
        jQuery(document).on('mouseenter', '.animate-icon-module-style1.be-bg-overlay', function (e) {
            var $this = jQuery(this);
            $this.find('.section-overlay').css('background-color', $this.find('.section-overlay').attr('data-hover-bg-color'));
        });
        jQuery(document).on('mouseleave', '.animate-icon-module-style1.be-bg-overlay', function (e) {
            var $this = jQuery(this);
            $this.find('.section-overlay').css('background-color', $this.find('.section-overlay').attr('data-default-bg-color'));
        });
    });// END DOCUMENT READY EVENT
    jQuery(window).smartresize(function() {
        // be_portfolio_layout();
        arrange_animate_icon();
        be_custom_scroll_animation();
        be_reset_colblock_height();

    });// END WINDOW RESIZE EVENT
    jQuery(window).on('scroll', function() {
        be_custom_scroll_animation();
    });// END WINDOW SCROLL EVENT
}(jQuery));