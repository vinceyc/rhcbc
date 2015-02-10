<?php
class CycloneSlider_Frontend extends CycloneSlider_Base {
    public $slider_count;

    public function bootstrap() {

        // Set defaults
        $this->slider_count = 0;

        // Our shortcode
        add_shortcode('cycloneslider', array( $this, 'cycloneslider_shortcode') );

    }

    /**
     * Cycloneslider Shortcode
     *
     * Displays shortcode on pages
     *
     * @param array $shortcode_settings Array of shortcode parameters
     * @return string Slider HTML
     */
    public function cycloneslider_shortcode( $shortcode_settings ) {
        // Apply defaults
        $shortcode_settings = shortcode_atts(
            array(
                'id' => 0,
                'easing' => null,
                'fx' => null,
                'timeout' => null,
                'speed' => null,
                'width' => null,
                'height' => null,
                'hover_pause' => null,
                'show_prev_next' => null,
                'show_nav' => null,
                'tile_count' => null,
                'tile_delay' => null,
                'tile_vertical' => null,
                'random' => null,
                'resize' => null,
                'resize_option' => null,
                'easing' => null,
                'allow_wrap' => null,
                'dynamic_height' => null,
                'delay' => null,
                'swipe' => null,
                'width_management' => null
            ),
            $shortcode_settings,
            'cycloneslider'
        );

        $slider_slug = $shortcode_settings['id']; // Slideshow slug passed from shortcode
        $slider = $this->plugin['data']->get_slider_by_slug( $slider_slug ); // Get slider by slug

        // Abort if slider not found!
        if( $slider === false ){
            return sprintf(__('[Slideshow "%s" not found]', 'cycloneslider'), $slider_slug);
        }

        $slider_count = ++$this->slider_count; // Make each call to shortcode unique
        $slider_html_id = 'cycloneslider-'.$slider_slug.'-'.$slider_count; // UID


        // Assign important variables
        $admin_settings = isset($slider['slider_settings']) ? $slider['slider_settings'] : array(); // Assign slider settings
        $slides = isset($slider['slides']) ? $slider['slides'] : array(); // Assign slides

        $template_name = $admin_settings['template'];
        $view_file = $this->plugin['data']->get_view_file( $template_name );


        if( $view_file === false ){ // Abort if template not found!
            return sprintf(__('[Template "%s" not found]', 'cycloneslider'), $template_name);
        }

        $slider_settings = $this->plugin['data']->combine_slider_settings( $admin_settings, $shortcode_settings );

        $image_count = 0; // Number of image slides
        $video_count = 0; // Number of video slides
        $custom_count = 0; // Number of custom slides
        $youtube_count = 0; // Number of youtube slides
        $vimeo_count = 0; // Number of Vimeo slides

        // Do some last minute logic
        // Translations and counters
        foreach($slides as $i=>$slide){
            $slides[$i]['title'] = __($slide['title']); // Needed by some translation plugins to work
            $slides[$i]['description'] = __($slide['description']); // Needed by some translation plugins to work
            $slides[$i]['slide_data_attributes'] = $this->plugin['data']->slide_data_attributes( $slide, $slider_settings );

            if($slides[$i]['type']=='image'){

                list($full_image_url, $orig_width, $orig_height) = wp_get_attachment_image_src($slide['id'], 'full');

                $slides[$i]['full_image_url'] = $full_image_url;
                $slides[$i]['image_url'] = $this->plugin['data']->get_slide_image_url( $slide['id'], $slider_settings );

                $slides[$i]['image_thumbnails'] = array();
                foreach($this->plugin['image_sizes'] as $key=>$size){
                    $slides[$i]['image_thumbnails'][$key] = $this->plugin['data']->get_slide_thumbnail_url( $slide['id'], $slider_settings['width'], $slider_settings['height'], $slider_settings['resize'] );
                }

                $image_count++;
            } else if($slides[$i]['type']=='video'){
                $video_count++;
                $video_url = wp_get_attachment_url($slides[$i]['video_id']);
                $poster_url = wp_get_attachment_url($slides[$i]['poster_id']);
                $slides[$i]['video_id'] = $video_id;

                $slides[$i]['video_embed_code'] =
                '
                <video class="video-js vjs-default-skin"
                controls autoplay poster="'.$poster_url.'" preload="auto" width="100%" height="100%"
                data-setup="{"controls": true}">"
                    <source src="'.$video_url.'" type="video/mp4" />
                </video>
                ';

            } else if($slides[$i]['type']=='video'){
                $video_count++;
            } else if($slides[$i]['type']=='custom'){
                $custom_count++;
            } else if($slides[$i]['type']=='youtube'){
                $youtube_count++;
                $youtube_id = $this->plugin['youtube']->get_youtube_id($slides[$i]['youtube_url']);

                $youtube_related = '';
                if( 'true' == $slides[$i]['youtube_related'] ) {
                    $youtube_related = '&rel=0';
                }

                $slides[$i]['youtube_embed_code'] = '<iframe id="'.$slider_html_id.'-iframe-'.$i.'" width="'.$slider_settings['width'].'" height="'.$slider_settings['height'].'" src="//www.youtube.com/embed/'.$youtube_id.'?wmode=transparent'.$youtube_related.'" frameborder="0" allowfullscreen></iframe>';
                $slides[$i]['youtube_id'] = $youtube_id;
                $slides[$i]['thumbnail_small'] = $this->plugin['youtube']->get_youtube_thumb($youtube_id);

            } else if($slides[$i]['type']=='vimeo'){
                $vimeo_count++;
                $vimeo_id = $this->plugin['vimeo']->get_vimeo_id($slides[$i]['vimeo_url']);

                $slides[$i]['vimeo_embed_code'] = '<iframe id="'.$slider_html_id.'-iframe-'.$i.'" width="'.$slider_settings['width'].'" height="'.$slider_settings['height'].'" src="http://player.vimeo.com/video/'.$vimeo_id.'?api=1&wmode=transparent" frameborder="0"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                $slides[$i]['vimeo_id'] = $vimeo_id;
                $slides[$i]['thumbnail_small'] = $this->plugin['vimeo']->get_vimeo_thumb($vimeo_id);
            }
        }

        // Randomize slides
        if($slider_settings['random']){
            shuffle($slides);
        }

        // Hardcoded for now
        $slider_settings['hide_non_active'] = "true";
        $slider_settings['auto_height'] = "{$slider_settings['width']}:{$slider_settings['height']}"; // Use ratio for backward compat
        if( 'on' == $slider_settings['dynamic_height'] ) {
            $slider_settings['auto_height'] = 0; // Disable autoheight when dynamic height is on. To prevent slider returning to wrong (ratio height) height when browser is resized.
        }
        if( ($youtube_count+$vimeo_count) > 0 or  'on' == $slider_settings['dynamic_height'] ){
            $slider_settings['hide_non_active'] = "false"; // Do not hide non active slides to prevent reloading of videos and for getBoundingClientRect() to not return 0.
        }
        $slider_settings['auto_height_speed'] = 250; // Will be editable in admin in the future
        $slider_settings['auto_height_easing'] = "null"; // Will be editable in admin in the future

        // Pass this vars to template
        $vars = array();
        $vars['slider_html_id'] = $slider_html_id; // The unique HTML ID for slider
        $vars['slider_count'] = $slider_count;
        $vars['slides'] = $slides;
        $vars['image_count'] = $image_count;
        $vars['video_count'] = $video_count;
        $vars['custom_count'] = $custom_count;
        $vars['youtube_count'] = $youtube_count;
        $vars['slider_id'] = $slider_slug; // (Deprecated since 2.6.0, use $slider_html_id instead) Unique string to identify the slideshow.
        $vars['slider_metas'] = $slides; // (Deprecated since 2.5.5, use $slides instead) An array containing slides properties.
        $vars['slider_settings'] = $slider_settings;


        $current_view_folder = $this->plugin['view']->get_view_folder(); // Back it up

        $this->plugin['view']->set_view_folder( dirname( $view_file ) ); // Set to template folder
        $slider_html = $this->plugin['view']->get_render( basename($view_file), $vars );

        $this->plugin['view']->set_view_folder( $current_view_folder ); // Restore

        // Remove whitespace to prevent WP from adding rogue paragraphs
        $slider_html = $this->plugin['data']->trim_white_spaces( $slider_html );

        // Return HTML
        return $slider_html;
    }


} // end class
