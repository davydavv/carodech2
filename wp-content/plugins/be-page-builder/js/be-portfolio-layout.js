;(function (jQuery) {
    var ajax_url = jQuery('#ajax_url').val();

    function portfolioModule() {  

        this.portfolioContainer = null,
        this.closest_portfolio = null,
        this.isotopeAction = null,

        this.init = function(element,actionParam){
            this.portfolioContainer = element.find('.portfolio-container');
            this.closest_portfolio = element; 
            this.setColumnWidth();
            this.isotopeAction = actionParam;
            var self = this;
        },
        this.getContainerWidth = function(){
            return this.closest_portfolio.width();
        },
        this.setContainerWidth = function(roundedWidthParam){
            this.portfolioContainer.width(roundedWidthParam);
        },
        this.gutter_width = function(){
            return Number(this.closest_portfolio.attr('data-gutter-width'));
        },
        this.elementNormalHeight = function () {
            return this.portfolioContainer.find('.element.no-wide-width-height:visible').find('.flip-wrap').height();
        },
        this.noOfColumns = function () {
            var windowTotalWidth = jQuery(window).width() + jQuery.getScrollbarWidth() ;
            if( windowTotalWidth < 1280 && windowTotalWidth >= 768 ) {
                switch(this.closest_portfolio.attr('data-col')){
                    case 'two':
                        return 2;
                    break;
                    case 'one':
                        return 1;
                    break;
                    default :
                        return 3;
                    break;
                }
            }else if ( windowTotalWidth < 768 && windowTotalWidth > 481 ){
                switch(this.closest_portfolio.attr('data-col')){
                    case 'one':
                        return 1;
                    break;
                    default :
                        return 2;
                    break;
                }
            }else if ( windowTotalWidth <= 481 ){
                return 1;
            }else{
                switch(this.closest_portfolio.attr('data-col')){
                    case 'five':
                        return 5;
                    break;
                    case 'four':
                        return 4;
                    break;
                    case 'three':
                        return 3;
                    break;
                    case 'two':
                        return 2;
                    break;
                    case 'one':
                        return 1;
                    break;
                    default :
                        return 3;
                    break;
                }
            }
        },
        this.getRoundedWidth = function () {
            var rounded_width = this.getContainerWidth() ;
            while ((rounded_width % this.noOfColumns()) !== 0) {
                rounded_width = rounded_width + 1;
            }
            this.setContainerWidth( rounded_width );
            return rounded_width; 
        },
        this.setColumnWidth = function () {
            this.columnWidth = this.getRoundedWidth() / this.noOfColumns();
        },
        this.multiGridSetup = function () {
            var self = this;
            
            this.portfolioContainer.imagesLoaded(function(){
                
                var vNormalHeight = self.elementNormalHeight(), vGutterWidth = self.gutter_width();
                if (self.closest_portfolio.hasClass('full-screen-gutter') && Number(self.closest_portfolio.attr('data-masonry')) != 1  ) {  
                    self.portfolioContainer.find('.wide-width-height, .wide-height').find('.flip-img-wrap').height((vNormalHeight * 2) + vGutterWidth);
                    self.portfolioContainer.find('.wide-width').find('.flip-img-wrap').height(vNormalHeight);
                    self.portfolioContainer.find('.element.wide-width-height, .element.wide-height, .element.wide-width').find('.element-inner .flip-wrap .flip-img-wrap img').resizeToParent();
                }
                if(self.isotopeAction == 'initial'){
                    self.applyIsotope(1);
                } else {
                    self.portfolioContainer.isotope('layout');

                }
                
           });
        },
        this.applyIsotope = function (flag){
            var column_width = this.columnWidth;
            this.portfolioContainer.isotope({
                itemSelector : '.element',
                masonry: {
                    columnWidth : column_width
                }
            }).isotope('on','layoutComplete', function( laidOutItems ) {
                Waypoint.refreshAll();
            }); 
            if(flag == 1){
                this.delayLoad(this.portfolioContainer);
            }
        },
        this.appendIsotope = function(newItemsParam){
            var vnewItems = newItemsParam, self = this; 

            this.portfolioContainer.append(vnewItems).isotope('appended', vnewItems).isotope('on', 'layoutComplete', function( laidOutItems ) {
                Waypoint.refreshAll();
            });
            
            this.delayLoad(this.portfolioContainer);
        },
        this.delayLoad = function (portfolioContainerParam) {
            if (portfolioContainerParam.hasClass('portfolio-shortcode')) {
                var delay = 1;
                portfolioContainerParam.find('.element').each(function () {
                    jQuery(this).find('img').one("load", function () {
                            jQuery(this).parent().delay(delay).addClass('img-loaded',300);
                            jQuery(this).closest('.flip-wrap').next().delay(delay).addClass('img-loaded',300);
                            delay += 200;
                        }).each(function () {
                            if (this.complete) {
                                jQuery(this).load();
                            }
                        });
                    });
            }
        },
        this.applyFilters = function(filteredItemParam, myClassParam){
            filteredItemParam.closest(".filters").find(".sort").removeClass("current_choice");
            filteredItemParam.addClass("current_choice");
            this.portfolioContainer.isotope({
                filter: '.' + myClassParam
            });
            this.applyIsotope(0);
        },
        this.portfolioParallaxSetup = function(){
            if(this.portfolioContainer.hasClass('portfolio-item-parallax')) {
                this.portfolioContainer.parentsUntil('.be-section').css('overflow', 'visible');
                this.portfolioContainer.closest('.be-section').css('overflow', 'visible');
                this.portfolioContainer.css('overflow', 'visible').find('.element').css('overflow', 'visible');
            }
        } 
    }
    function portfolioMainModule(portfolioContainerParam){
        var portfolioModuleInst = [], i = 0; 
        // Loop for Each Portfolio Item
        portfolioContainerParam.each(function () {
            // Default Portfolio Layout
            portfolioModuleInst[i] = new portfolioModule();
            portfolioModuleInst[i].init(jQuery(this), 'initial');
            portfolioModuleInst[i].multiGridSetup();
            portfolioModuleInst[i].portfolioParallaxSetup();
            // Increment loop Counter
            i++;
        }); //End of Loop
    }
    function paginationData(triggerParam, portfolioParam, elementParam) {
        var $portfolio = portfolioParam,
        $trigger = triggerParam,
        $ajaxData = '';

        switch(elementParam){
            case 'portfolio' : 
                $action = $portfolio.attr("data-action"),
                $col = $portfolio.attr("data-col"),
                $data_gutter_width = Number($portfolio.attr("data-gutter-width")),
                $category = $portfolio.attr("data-category"),
                $masonry = $portfolio.attr("data-masonry"),
                $showposts = $portfolio.attr("data-showposts"),
                $gallery = $portfolio.attr("data-gallery"),
                $filter = $portfolio.attr("data-filter"),
                $show_filters = $portfolio.attr("data-show_filters"),
                $data_thumbnail_bg_color = $portfolio.attr("data-thumbnail-bg-color"),
                $data_title_style = $portfolio.attr("data-title-style"),
                $data_title_color = $portfolio.attr("data-title-color"),
                $data_cat_color = $portfolio.attr("data-cat-color"),
                $title_animation_type = $portfolio.attr("data-title-animation-type"),
                $cat_animation_type = $portfolio.attr("data-cat-animation-type"),
                $img_grayscale = $portfolio.attr("data-img-grayscale"),
                $image_effect = $portfolio.attr("data-image-effect"),
                $gradient_style_color = $portfolio.attr("data-gradient-style-color"),
                $data_hover_style = $portfolio.attr("data-hover-style"),
                $dat_cat_hide = $portfolio.attr("data-cat-hide"),
                $data_like_indicator = $portfolio.attr("data-like-indicator"),
                $ajaxData = "action=" + $action + "&category=" + $category + "&masonry=" + $masonry + "&showposts=" + $showposts + "&col=" + $col + "&gallery=" + $gallery + "&filter=" + $filter + "&show_filters=" + $show_filters + "&thumb_overlay_color=" + $data_thumbnail_bg_color + "&title_style=" + $data_title_style + "&title_color=" + $data_title_color + "&cat_color=" + $data_cat_color + "&title_animation_type=" + $title_animation_type + "&cat_animation_type=" + $cat_animation_type + "&gutter_width=" + $data_gutter_width + "&hover_style=" + $data_hover_style + "&img_grayscale=" + $img_grayscale + "&image_effect=" + $image_effect + "&gradient_style_color=" + $gradient_style_color + "&cat_hide=" + $dat_cat_hide + "&like_button=" + $data_like_indicator;

                return $ajaxData;
            break;

            case 'gallery' :
                $action = $portfolio.attr("data-action"),
                $masonry = $portfolio.attr("data-masonry"),
                $source = $portfolio.attr("data-source"),
                $gutter_width = $portfolio.attr("data-gutter-width"),
                $col = $portfolio.attr("data-col"),
                $data_gutter_width = Number($portfolio.attr("data-gutter-width")),
                $images_arr = $portfolio.attr("data-images-array"),
                $items_per_load = $portfolio.attr("data-items-per-load"),
                $hover_style = $portfolio.attr("data-hover-style"),
                $img_grayscale = $portfolio.attr("data-image-grayscale"),
                $lightbox_type = $portfolio.attr("data-lightbox-type"),
                $image_source = $portfolio.attr("data-image-source"),
                $image_effect = $portfolio.attr("data-image-effect"),
                $thumb_overlay_color = $portfolio.attr("data-thumb-overlay-color"),
                $gradient_style_color = $portfolio.attr("data-grad-style-color"),
                $like_button =  $portfolio.attr("data-like-button"),
                $hover_content_option = $portfolio.attr("data-hover-content"),     
                $hover_content_color = $portfolio.attr("data-hover-content-color"),
                $ajaxData = "action=" + $action + "&masonry=" + $masonry + "&source=" + $source + "&gutter_width=" + $gutter_width + "&col=" + $col + "&data_gutter_width=" + $data_gutter_width + "&images_arr=" + $images_arr + "&items_per_load=" + $items_per_load + "&hover_style=" + $hover_style + "&img_grayscale=" + $img_grayscale + "&lightbox_type=" + $lightbox_type + "&image_source=" + $image_source + "&image_effect=" + $image_effect + "&thumb_overlay_color=" + $thumb_overlay_color + "&gradient_style_color=" + $gradient_style_color + "&like_button=" + $like_button + "&hover_content_option=" + $hover_content_option + "&hover_content_color=" + $hover_content_color;

                return $ajaxData;
            break;

            case 'blog' :
                $total_items = $trigger.attr('data-total-items'),
                $action = $portfolio.attr("data-action"),
                $showposts = $portfolio.attr("data-showposts"),
                $data_gutter_width = Number($portfolio.attr("data-gutter-width")),
                $ajaxData = "action=" + $action + "&showposts=" + $showposts + "&gutter_width=" + $data_gutter_width + "&total_items=" + $total_items ;

                return $ajaxData;
            break;

        }
    }
    function infiniteScroll(triggerParam, portfolioParam, pagedParam, elementTypeParam){

        var $this = triggerParam,
        $portfolio = portfolioParam,
        $paged = pagedParam;
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
                        data: paginationData($this, $portfolio, elementTypeParam) + "&paged=" + $paged 
                    }).done(function (data) {
                        if (data !== 0 && data !== '0' && data) {
                            var $newItems = jQuery(data);
                            $newItems.imagesLoaded(function () {

                                portfolioModuleInst = new portfolioModule();
                                portfolioModuleInst.init($portfolio,'append');
                                portfolioModuleInst.appendIsotope($newItems);
                                portfolioModuleInst.multiGridSetup();
                                
                                if(elementTypeParam == 'portfolio'){
                                    be_lightbox(); 
                                    jQuery('.element.style3-hover .element-inner').each(function () {
                                        jQuery(this).hoverdir();
                                    });
                                    
                                    jQuery('.element.style4-hover .element-inner').each(function () {
                                        jQuery(this).hoverdir({
                                            inverse : true
                                        });
                                    });
                                }
                                if(elementTypeParam == 'gallery'){
                                    be_lightbox(); 
                                }
                                if(elementTypeParam == 'blog'){
                                    be_lightbox();
                                    $newItems.find('.be_image_slider').each(function () {
                                        var $this = jQuery(this).find('.image_slider_module');
                                        be_blog_gallery($this); 
                                    });
                                    $newItems.fitVids();
                                }

                                $this_waypoint.enable(); //Enable Waypoint 
                                $paged = Number($paged) + 1;
                                $page_loader.fadeOut();

                            });
                        } else {
                            $this_waypoint.destroy();
                            $page_loader.fadeOut();
                        }
                    });
               }
            }, 
            offset: 'bottom-in-view'    
        })
    }
    function loadmore(triggerParam, portfolioParam, pagedParam, elementTypeParam){
        var $this = triggerParam,
        $portfolio = portfolioParam,
        $paged = pagedParam,
        $page_loader = jQuery('.page-loader');
        $page_loader.fadeIn();
        $this.addClass('disabled');
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: paginationData($this, $portfolio , elementTypeParam) + "&paged=" + $paged ,
            success: function (data) {

                if (data!== 0 && data !== '0' && data) {
                    var $newItems = jQuery(data);
                    $newItems.imagesLoaded(function () {
                        
                        portfolioModuleInst = new portfolioModule();
                        portfolioModuleInst.init($portfolio,'append');
                        portfolioModuleInst.multiGridSetup();
                        portfolioModuleInst.appendIsotope($newItems);

                        if(elementTypeParam == 'portfolio'){
                            be_lightbox(); 
                            jQuery('.element.style3-hover .element-inner').each(function () {
                                jQuery(this).hoverdir();
                            });
                            
                            jQuery('.element.style4-hover .element-inner').each(function () {
                                jQuery(this).hoverdir({
                                    inverse : true
                                });
                            });
                        }
                        if(elementTypeParam == 'gallery'){
                            be_lightbox(); 
                        }
                        if(elementTypeParam == 'blog'){
                            be_lightbox();
                            $newItems.find('.be_image_slider').each(function () {
                                var $this = jQuery(this).find('.image_slider_module');
                                be_blog_gallery($this); 
                            });
                            $newItems.fitVids();
                        }

                        $portfolio.attr("data-paged", Number($paged) + 1);
                        
                        $this.attr("data-total-items", function () {
                            return (Number(jQuery(this).attr('data-total-items')) - $newItems.find('.element-inner').length);
                        });

                        if ($this.attr("data-total-items") <= 0) {
                            $this.fadeOut(500, function () {
                                $this.remove();
                            });
                        }
                        $this.removeClass('disabled');
                        $page_loader.fadeOut();
                    });
                } else {
                    $this.addClass('disabled');
                    $page_loader.fadeOut();
                }
            }
        });
    }
    function be_blog_gallery(blog_gallery_post){
        var $this = blog_gallery_post,
        $slideshow = $this.attr('data-auto-slide'),
        $slideshowspeed = 1000;
        if('no' == $slideshow){
            $slideshow = false;
        }else{
            $slideshow = true;
            $slideshowspeed = $this.attr('data-slide-interval');
        }
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
    function portfolioInfiniteScroll(){
        if(jQuery(".trigger_infinite_scroll.portfolio_infinite_scroll").length > 0) {
            jQuery(".trigger_infinite_scroll.portfolio_infinite_scroll").each(function () {
                var $this = jQuery(this),
                $portfolio = $this.closest('.portfolio'),
                $paged = Number($portfolio.attr("data-paged"));
                infiniteScroll($this, $portfolio, $paged, 'portfolio');
            });
        } 
    }
    function galleryInfiniteScroll(){
        if(jQuery(".trigger_infinite_scroll.gallery_infinite_scroll").length > 0) {
            jQuery(".trigger_infinite_scroll.gallery_infinite_scroll").each(function () {
                var $this = jQuery(this),
                $portfolio = $this.closest('.portfolio'),
                $paged = Number($portfolio.attr("data-paged"));
                infiniteScroll($this, $portfolio, $paged, 'gallery');    
            });
        }
    }
    function blogInfiniteScroll(){
        if(jQuery(".trigger_infinite_scroll.blog_infinite_scroll").length > 0) {
            jQuery(".trigger_infinite_scroll.blog_infinite_scroll").each(function () {
                
                var $this = jQuery(this),
                $portfolio = $this.closest('.portfolio'),
                $paged = Number($portfolio.attr("data-paged"));
                infiniteScroll($this, $portfolio, $paged, 'blog');  
            });
        }
    }

    //ON READY EVENT
    jQuery(document).ready(function () {
        if(jQuery('.portfolio').length > 0){
            jQuery('html').addClass('show-overflow');
            var $portfolio_container = jQuery('.portfolio');
            portfolioMainModule($portfolio_container);
            portfolioInfiniteScroll();
            galleryInfiniteScroll();
            blogInfiniteScroll();
        }
        //Portfolio Filters
        jQuery(document).on('click', '.sort', function () {
            portfolioModuleFilter = new portfolioModule();
            var filteredItem = jQuery(this), myClass = filteredItem.attr("data-id");
            portfolioModuleFilter.init(filteredItem.closest('.portfolio'));
            portfolioModuleFilter.applyFilters(filteredItem, myClass);

        });
        //Portfolio Load More
        jQuery(document).on('click', '.trigger_load_more.portfolio_load_more:not(.disabled)', function () {
            var $this = jQuery(this),
            $portfolio = $this.closest('.portfolio'),
            $paged = Number($portfolio.attr("data-paged"));
            loadmore($this, $portfolio, $paged, 'portfolio');
        });
        //Gallery Load More
        jQuery(document).on('click', '.trigger_load_more.gallery_load_more:not(.disabled)', function () {
            var $this = jQuery(this),
            $portfolio = $this.closest('.portfolio'),
            $paged = Number($portfolio.attr("data-paged"));
            loadmore($this, $portfolio, $paged, 'gallery');
        });
        //Blog Load More
        jQuery(document).on('click', '.trigger_load_more.blog_load_more:not(.disabled)', function () {
            var $this = jQuery(this),
            $portfolio = $this.closest('.portfolio'),
            $paged = Number($portfolio.attr("data-paged"));
            loadmore($this, $portfolio, $paged, 'blog'); ;
        });

    }); 
    //ON RESIZE EVENT
    jQuery(window).smartresize( function() {
        if(jQuery('.portfolio').length > 0){
            var $portfolio_container = jQuery('.portfolio');
            portfolioMainModule($portfolio_container);
        }
    });
    //ON UPDATE EVENT
    jQuery(document).on('update_content', function(){
        if(jQuery('.portfolio').length > 0){
            var $portfolio_container = jQuery('.portfolio');
            portfolioMainModule($portfolio_container);
            Waypoint.destroyAll();
            portfolioInfiniteScroll();
            galleryInfiniteScroll();
            blogInfiniteScroll();
        }
    });
}(jQuery));