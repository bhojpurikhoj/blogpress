<?php 
/**/
//Include admin
include dirname( __FILE__ ) .'/main.php';
include dirname( __FILE__ ) .'/g/simple-menu.php';
// Add shortcodes
add_shortcode('custom-facebook-feed', 'display_blogpress');
function display_blogpress($atts) {
    
    //Style options
    $options = get_option('blogpress_style_settings');
    //Create the types string to set as shortcode default
    $include_string = '';
    if($options[ 'blogpress_show_author' ]) $include_string .= 'author,';
    if($options[ 'blogpress_show_text' ]) $include_string .= 'text,';
    if($options[ 'blogpress_show_desc' ]) $include_string .= 'desc,';
    if($options[ 'blogpress_show_shared_links' ]) $include_string .= 'sharedlinks,';
    if($options[ 'blogpress_show_date' ]) $include_string .= 'date,';
    if($options[ 'blogpress_show_media' ]) $include_string .= 'media,';
    if($options[ 'blogpress_show_event_title' ]) $include_string .= 'eventtitle,';
    if($options[ 'blogpress_show_event_details' ]) $include_string .= 'eventdetails,';
    if($options[ 'blogpress_show_meta' ]) $include_string .= 'social,';
    if($options[ 'blogpress_show_link' ]) $include_string .= 'link,';
    if($options[ 'blogpress_show_like_box' ]) $include_string .= 'likebox,';
    //Pass in shortcode attrbutes
    $atts = shortcode_atts(
    array(
        'accesstoken' => trim( get_option('blogpress_access_token') ),
        'id' => get_option('blogpress_page_id'),
        'pagetype' => get_option('blogpress_page_type'),
        'num' => get_option('blogpress_num_show'),
        'limit' => get_option('blogpress_post_limit'),
        'others' => '',
        'showpostsby' => get_option('blogpress_show_others'),
        'cachetime' => get_option('blogpress_cache_time'),
        'cacheunit' => get_option('blogpress_cache_time_unit'),
        'locale' => get_option('blogpress_locale'),
        'ajax' => get_option('blogpress_ajax'),
        'width' => isset($options[ 'blogpress_feed_width' ]) ? $options[ 'blogpress_feed_width' ] : '',
        'height' => isset($options[ 'blogpress_feed_height' ]) ? $options[ 'blogpress_feed_height' ] : '',
        'padding' => isset($options[ 'blogpress_feed_padding' ]) ? $options[ 'blogpress_feed_padding' ] : '',
        'bgcolor' => isset($options[ 'blogpress_bg_color' ]) ? $options[ 'blogpress_bg_color' ] : '',
        'showauthor' => '',
        'showauthornew' => isset($options[ 'blogpress_show_author' ]) ? $options[ 'blogpress_show_author' ] : '',
        'class' => isset($options[ 'blogpress_class' ]) ? $options[ 'blogpress_class' ] : '',
        'layout' => isset($options[ 'blogpress_preset_layout' ]) ? $options[ 'blogpress_preset_layout' ] : '',
        'include' => $include_string,
        'exclude' => '',
        //Post Style
        'postbgcolor' => isset($options[ 'blogpress_post_bg_color' ]) ? $options[ 'blogpress_post_bg_color' ] : '',
        'postcorners' => isset($options[ 'blogpress_post_rounded' ]) ? $options[ 'blogpress_post_rounded' ] : '',

        //Typography
        'textformat' => isset($options[ 'blogpress_title_format' ]) ? $options[ 'blogpress_title_format' ] : '',
        'textsize' => isset($options[ 'blogpress_title_size' ]) ? $options[ 'blogpress_title_size' ] : '',
        'textweight' => isset($options[ 'blogpress_title_weight' ]) ? $options[ 'blogpress_title_weight' ] : '',
        'textcolor' => isset($options[ 'blogpress_title_color' ]) ? $options[ 'blogpress_title_color' ] : '',
        'textlinkcolor' => isset($options[ 'blogpress_posttext_link_color' ]) ? $options[ 'blogpress_posttext_link_color' ] : '',
        'textlink' => isset($options[ 'blogpress_title_link' ]) ? $options[ 'blogpress_title_link' ] : '',
        'posttags' => isset($options[ 'blogpress_post_tags' ]) ? $options[ 'blogpress_post_tags' ] : '',
        'linkhashtags' => isset($options[ 'blogpress_link_hashtags' ]) ? $options[ 'blogpress_link_hashtags' ] : '',

        //Description
        'descsize' => isset($options[ 'blogpress_body_size' ]) ? $options[ 'blogpress_body_size' ] : '',
        'descweight' => isset($options[ 'blogpress_body_weight' ]) ? $options[ 'blogpress_body_weight' ] : '',
        'desccolor' => isset($options[ 'blogpress_body_color' ]) ? $options[ 'blogpress_body_color' ] : '',
        'linktitleformat' => isset($options[ 'blogpress_link_title_format' ]) ? $options[ 'blogpress_link_title_format' ] : '',
        'linktitlesize' => isset($options[ 'blogpress_link_title_size' ]) ? $options[ 'blogpress_link_title_size' ] : '',
        'linktitlecolor' => isset($options[ 'blogpress_link_title_color' ]) ? $options[ 'blogpress_link_title_color' ] : '',
        'linkurlcolor' => isset($options[ 'blogpress_link_url_color' ]) ? $options[ 'blogpress_link_url_color' ] : '',
        'linkbgcolor' => isset($options[ 'blogpress_link_bg_color' ]) ? $options[ 'blogpress_link_bg_color' ] : '',
        'linkbordercolor' => isset($options[ 'blogpress_link_border_color' ]) ? $options[ 'blogpress_link_border_color' ] : '',
        'disablelinkbox' => isset($options[ 'blogpress_disable_link_box' ]) ? $options[ 'blogpress_disable_link_box' ] : '',

        //Author
        'authorsize' => isset($options[ 'blogpress_author_size' ]) ? $options[ 'blogpress_author_size' ] : '',
        'authorcolor' => isset($options[ 'blogpress_author_color' ]) ? $options[ 'blogpress_author_color' ] : '',

        //Event title
        'eventtitleformat' => isset($options[ 'blogpress_event_title_format' ]) ? $options[ 'blogpress_event_title_format' ] : '',
        'eventtitlesize' => isset($options[ 'blogpress_event_title_size' ]) ? $options[ 'blogpress_event_title_size' ] : '',
        'eventtitleweight' => isset($options[ 'blogpress_event_title_weight' ]) ? $options[ 'blogpress_event_title_weight' ] : '',
        'eventtitlecolor' => isset($options[ 'blogpress_event_title_color' ]) ? $options[ 'blogpress_event_title_color' ] : '',
        'eventtitlelink' => isset($options[ 'blogpress_event_title_link' ]) ? $options[ 'blogpress_event_title_link' ] : '',
        //Event date
        'eventdatesize' => isset($options[ 'blogpress_event_date_size' ]) ? $options[ 'blogpress_event_date_size' ] : '',
        'eventdateweight' => isset($options[ 'blogpress_event_date_weight' ]) ? $options[ 'blogpress_event_date_weight' ] : '',
        'eventdatecolor' => isset($options[ 'blogpress_event_date_color' ]) ? $options[ 'blogpress_event_date_color' ] : '',
        'eventdatepos' => isset($options[ 'blogpress_event_date_position' ]) ? $options[ 'blogpress_event_date_position' ] : '',
        'eventdateformat' => isset($options[ 'blogpress_event_date_formatting' ]) ? $options[ 'blogpress_event_date_formatting' ] : '',
        'eventdatecustom' => isset($options[ 'blogpress_event_date_custom' ]) ? $options[ 'blogpress_event_date_custom' ] : '',
        //Event details
        'eventdetailssize' => isset($options[ 'blogpress_event_details_size' ]) ? $options[ 'blogpress_event_details_size' ] : '',
        'eventdetailsweight' => isset($options[ 'blogpress_event_details_weight' ]) ? $options[ 'blogpress_event_details_weight' ] : '',
        'eventdetailscolor' => isset($options[ 'blogpress_event_details_color' ]) ? $options[ 'blogpress_event_details_color' ] : '',
        'eventlinkcolor' => isset($options[ 'blogpress_event_link_color' ]) ? $options[ 'blogpress_event_link_color' ] : '',
        //Date
        'datepos' => isset($options[ 'blogpress_date_position' ]) ? $options[ 'blogpress_date_position' ] : '',
        'datesize' => isset($options[ 'blogpress_date_size' ]) ? $options[ 'blogpress_date_size' ] : '',
        'dateweight' => isset($options[ 'blogpress_date_weight' ]) ? $options[ 'blogpress_date_weight' ] : '',
        'datecolor' => isset($options[ 'blogpress_date_color' ]) ? $options[ 'blogpress_date_color' ] : '',
        'dateformat' => isset($options[ 'blogpress_date_formatting' ]) ? $options[ 'blogpress_date_formatting' ] : '',
        'datecustom' => isset($options[ 'blogpress_date_custom' ]) ? $options[ 'blogpress_date_custom' ] : '',
        'timezone' => isset($options[ 'blogpress_timezone' ]) ? $options[ 'blogpress_timezone' ] : 'America/Chicago',

        //Link to Facebook
        'linksize' => isset($options[ 'blogpress_link_size' ]) ? $options[ 'blogpress_link_size' ] : '',
        'linkweight' => isset($options[ 'blogpress_link_weight' ]) ? $options[ 'blogpress_link_weight' ] : '',
        'linkcolor' => isset($options[ 'blogpress_link_color' ]) ? $options[ 'blogpress_link_color' ] : '',
        'viewlinktext' => isset($options[ 'blogpress_view_link_text' ]) ? $options[ 'blogpress_view_link_text' ] : '',
        'linktotimeline' => isset($options[ 'blogpress_link_to_timeline' ]) ? $options[ 'blogpress_link_to_timeline' ] : '',
        //Social
        'iconstyle' => isset($options[ 'blogpress_icon_style' ]) ? $options[ 'blogpress_icon_style' ] : '',
        'socialtextcolor' => isset($options[ 'blogpress_meta_text_color' ]) ? $options[ 'blogpress_meta_text_color' ] : '',
        'socialbgcolor' => isset($options[ 'blogpress_meta_bg_color' ]) ? $options[ 'blogpress_meta_bg_color' ] : '',
        //Misc
        'textlength' => get_option('blogpress_title_length'),
        'desclength' => get_option('blogpress_body_length'),
        'likeboxpos' => isset($options[ 'blogpress_like_box_position' ]) ? $options[ 'blogpress_like_box_position' ] : '',
        'likeboxoutside' => isset($options[ 'blogpress_like_box_outside' ]) ? $options[ 'blogpress_like_box_outside' ] : '',
        'likeboxcolor' => isset($options[ 'blogpress_likebox_bg_color' ]) ? $options[ 'blogpress_likebox_bg_color' ] : '',
        'likeboxtextcolor' => isset($options[ 'blogpress_like_box_text_color' ]) ? $options[ 'blogpress_like_box_text_color' ] : '',
        'likeboxwidth' => isset($options[ 'blogpress_likebox_width' ]) ? $options[ 'blogpress_likebox_width' ] : '',
        'likeboxheight' => isset($options[ 'blogpress_likebox_height' ]) ? $options[ 'blogpress_likebox_height' ] : '',
        'likeboxfaces' => isset($options[ 'blogpress_like_box_faces' ]) ? $options[ 'blogpress_like_box_faces' ] : '',
        'likeboxborder' => isset($options[ 'blogpress_like_box_border' ]) ? $options[ 'blogpress_like_box_border' ] : '',

        //Page Header
        'showheader' => isset($options[ 'blogpress_show_header' ]) ? $options[ 'blogpress_show_header' ] : '',
        'headeroutside' => isset($options[ 'blogpress_header_outside' ]) ? $options[ 'blogpress_header_outside' ] : '',
        'headertext' => isset($options[ 'blogpress_header_text' ]) ? $options[ 'blogpress_header_text' ] : '',
        'headerbg' => isset($options[ 'blogpress_header_bg_color' ]) ? $options[ 'blogpress_header_bg_color' ] : '',
        'headerpadding' => isset($options[ 'blogpress_header_padding' ]) ? $options[ 'blogpress_header_padding' ] : '',
        'headertextsize' => isset($options[ 'blogpress_header_text_size' ]) ? $options[ 'blogpress_header_text_size' ] : '',
        'headertextweight' => isset($options[ 'blogpress_header_text_weight' ]) ? $options[ 'blogpress_header_text_weight' ] : '',
        'headertextcolor' => isset($options[ 'blogpress_header_text_color' ]) ? $options[ 'blogpress_header_text_color' ] : '',
        'headericon' => isset($options[ 'blogpress_header_icon' ]) ? $options[ 'blogpress_header_icon' ] : '',
        'headericoncolor' => isset($options[ 'blogpress_header_icon_color' ]) ? $options[ 'blogpress_header_icon_color' ] : '',
        'headericonsize' => isset($options[ 'blogpress_header_icon_size' ]) ? $options[ 'blogpress_header_icon_size' ] : '',

        'videoheight' => isset($options[ 'blogpress_video_height' ]) ? $options[ 'blogpress_video_height' ] : '',
        'videoaction' => isset($options[ 'blogpress_video_action' ]) ? $options[ 'blogpress_video_action' ] : '',
        'sepcolor' => isset($options[ 'blogpress_sep_color' ]) ? $options[ 'blogpress_sep_color' ] : '',
        'sepsize' => isset($options[ 'blogpress_sep_size' ]) ? $options[ 'blogpress_sep_size' ] : '',

        //Translate
        'seemoretext' => isset($options[ 'blogpress_see_more_text' ]) ? $options[ 'blogpress_see_more_text' ] : '',
        'seelesstext' => isset($options[ 'blogpress_see_less_text' ]) ? $options[ 'blogpress_see_less_text' ] : '',
        'facebooklinktext' => isset($options[ 'blogpress_facebook_link_text' ]) ? $options[ 'blogpress_facebook_link_text' ] : '',
        'photostext' => isset($options[ 'blogpress_translate_photos_text' ]) ? $options[ 'blogpress_translate_photos_text' ] : ''
    ), $atts);

    /********** GENERAL **********/
    $blogpress_page_type = $atts[ 'pagetype' ];
    ($blogpress_page_type == 'group') ? $blogpress_is_group = true : $blogpress_is_group = false;

    $blogpress_feed_width = $atts['width'];
    $blogpress_feed_height = $atts[ 'height' ];
    $blogpress_feed_padding = $atts[ 'padding' ];
    $blogpress_bg_color = $atts[ 'bgcolor' ];
    $blogpress_show_author = $atts[ 'showauthornew' ];
    $blogpress_cache_time = $atts[ 'cachetime' ];
    $blogpress_locale = $atts[ 'locale' ];
    if ( empty($blogpress_locale) || !isset($blogpress_locale) || $blogpress_locale == '' ) $blogpress_locale = 'en_US';
    if (!isset($blogpress_cache_time)) $blogpress_cache_time = 0;
    $blogpress_cache_time_unit = $atts[ 'cacheunit' ];
    $blogpress_class = $atts['class'];
    //Compile feed styles
    $blogpress_feed_styles = 'style="';
    if ( !empty($blogpress_feed_width) ) $blogpress_feed_styles .= 'width:' . $blogpress_feed_width . '; ';
    if ( !empty($blogpress_feed_height) ) $blogpress_feed_styles .= 'height:' . $blogpress_feed_height . '; ';
    if ( !empty($blogpress_feed_padding) ) $blogpress_feed_styles .= 'padding:' . $blogpress_feed_padding . '; ';
    if ( !empty($blogpress_bg_color) ) $blogpress_feed_styles .= 'background-color:#' . str_replace('#', '', $blogpress_bg_color) . '; ';
    $blogpress_feed_styles .= '"';
    //Like box
    $blogpress_like_box_position = $atts[ 'likeboxpos' ];
    $blogpress_like_box_outside = $atts[ 'likeboxoutside' ];
    //Open links in new window?
    $target = 'target="_blank"';
    /********** POST TYPES **********/
    $blogpress_show_links_type = true;
    $blogpress_show_event_type = true;
    $blogpress_show_video_type = true;
    $blogpress_show_photos_type = true;
    $blogpress_show_status_type = true;
    $blogpress_events_only = false;
    //Are we showing ONLY events?
    if ($blogpress_show_event_type && !$blogpress_show_links_type && !$blogpress_show_video_type && !$blogpress_show_photos_type && !$blogpress_show_status_type) $blogpress_events_only = true;
    /********** LAYOUT **********/
    $blogpress_includes = $atts[ 'include' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $blogpress_show_author = false;
    $blogpress_show_text = false;
    $blogpress_show_desc = false;
    $blogpress_show_shared_links = false;
    $blogpress_show_date = false;
    $blogpress_show_media = false;
    $blogpress_show_event_title = false;
    $blogpress_show_event_details = false;
    $blogpress_show_meta = false;
    $blogpress_show_link = false;
    $blogpress_show_like_box = false;
    if ( stripos($blogpress_includes, 'author') !== false ) $blogpress_show_author = true;
    if ( stripos($blogpress_includes, 'text') !== false ) $blogpress_show_text = true;
    if ( stripos($blogpress_includes, 'desc') !== false ) $blogpress_show_desc = true;
    if ( stripos($blogpress_includes, 'sharedlink') !== false ) $blogpress_show_shared_links = true;
    if ( stripos($blogpress_includes, 'date') !== false ) $blogpress_show_date = true;
    if ( stripos($blogpress_includes, 'media') !== false ) $blogpress_show_media = true;
    if ( stripos($blogpress_includes, 'eventtitle') !== false ) $blogpress_show_event_title = true;
    if ( stripos($blogpress_includes, 'eventdetail') !== false ) $blogpress_show_event_details = true;
    if ( stripos($blogpress_includes, 'social') !== false ) $blogpress_show_meta = true;
    if ( stripos($blogpress_includes, ',link') !== false ) $blogpress_show_link = true; //comma used to separate it from 'sharedlinks' - which also contains 'link' string
    if ( stripos($blogpress_includes, 'like') !== false ) $blogpress_show_like_box = true;


    //Exclude string
    $blogpress_excludes = $atts[ 'exclude' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    if ( stripos($blogpress_excludes, 'author') !== false ) $blogpress_show_author = false;
    if ( stripos($blogpress_excludes, 'text') !== false ) $blogpress_show_text = false;
    if ( stripos($blogpress_excludes, 'desc') !== false ) $blogpress_show_desc = false;
    if ( stripos($blogpress_excludes, 'sharedlink') !== false ) $blogpress_show_shared_links = false;
    if ( stripos($blogpress_excludes, 'date') !== false ) $blogpress_show_date = false;
    if ( stripos($blogpress_excludes, 'media') !== false ) $blogpress_show_media = false;
    if ( stripos($blogpress_excludes, 'eventtitle') !== false ) $blogpress_show_event_title = false;
    if ( stripos($blogpress_excludes, 'eventdetail') !== false ) $blogpress_show_event_details = false;
    if ( stripos($blogpress_excludes, 'social') !== false ) $blogpress_show_meta = false;
    if ( stripos($blogpress_excludes, ',link') !== false ) $blogpress_show_link = false; //comma used to separate it from 'sharedlinks' - which also contains 'link' string
    if ( stripos($blogpress_excludes, 'like') !== false ) $blogpress_show_like_box = false;


    //Set free version to thumb layout by default as layout option not available on settings page
    $blogpress_preset_layout = 'thumb';

    //If the old shortcode option 'showauthor' is being used then apply it
    $blogpress_show_author_old = $atts[ 'showauthor' ];
    if( $blogpress_show_author_old == 'false' ) $blogpress_show_author = false;
    if( $blogpress_show_author_old == 'true' ) $blogpress_show_author = true;

    
    /********** META **********/
    $blogpress_icon_style = $atts[ 'iconstyle' ];
    $blogpress_meta_text_color = $atts[ 'socialtextcolor' ];
    $blogpress_meta_bg_color = $atts[ 'socialbgcolor' ];
    $blogpress_meta_styles = 'style="';
    if ( !empty($blogpress_meta_text_color) ) $blogpress_meta_styles .= 'color:#' . str_replace('#', '', $blogpress_meta_text_color) . ';';
    if ( !empty($blogpress_meta_bg_color) ) $blogpress_meta_styles .= 'background-color:#' . str_replace('#', '', $blogpress_meta_bg_color) . ';';
    $blogpress_meta_styles .= '"';
    $blogpress_nocomments_text = isset($options[ 'blogpress_nocomments_text' ]) ? $options[ 'blogpress_nocomments_text' ] : '';
    $blogpress_hide_comments = isset($options[ 'blogpress_hide_comments' ]) ? $options[ 'blogpress_hide_comments' ] : '';
    if (!isset($blogpress_nocomments_text) || empty($blogpress_nocomments_text)) $blogpress_hide_comments = true;
    /********** TYPOGRAPHY **********/
    //See More text
    $blogpress_see_more_text = $atts[ 'seemoretext' ];
    $blogpress_see_less_text = $atts[ 'seelesstext' ];
    //See Less text
    //Title
    $blogpress_title_format = $atts[ 'textformat' ];
    if (empty($blogpress_title_format)) $blogpress_title_format = 'p';
    $blogpress_title_size = $atts[ 'textsize' ];
    $blogpress_title_weight = $atts[ 'textweight' ];
    $blogpress_title_color = $atts[ 'textcolor' ];
    $blogpress_title_styles = 'style="';
    if ( !empty($blogpress_title_size) && $blogpress_title_size != 'inherit' ) $blogpress_title_styles .=  'font-size:' . $blogpress_title_size . 'px; ';
    if ( !empty($blogpress_title_weight) && $blogpress_title_weight != 'inherit' ) $blogpress_title_styles .= 'font-weight:' . $blogpress_title_weight . '; ';
    if ( !empty($blogpress_title_color) ) $blogpress_title_styles .= 'color:#' . str_replace('#', '', $blogpress_title_color) . ';';
    $blogpress_title_styles .= '"';
    $blogpress_title_link = $atts[ 'textlink' ];

    ( $blogpress_title_link == 'on' || $blogpress_title_link == 'true' || $blogpress_title_link == true ) ? $blogpress_title_link = true : $blogpress_title_link = false;
    if( $atts[ 'textlink' ] == 'false' ) $blogpress_title_link = false;

    //Author
    $blogpress_author_size = $atts[ 'authorsize' ];
    $blogpress_author_color = $atts[ 'authorcolor' ];
    $blogpress_author_styles = 'style="';
    if ( !empty($blogpress_author_size) && $blogpress_author_size != 'inherit' ) $blogpress_author_styles .=  'font-size:' . $blogpress_author_size . 'px; ';
    if ( !empty($blogpress_author_color) ) $blogpress_author_styles .= 'color:#' . str_replace('#', '', $blogpress_author_color) . ';';
    $blogpress_author_styles .= '"';

    //Description
    $blogpress_body_size = $atts[ 'descsize' ];
    $blogpress_body_weight = $atts[ 'descweight' ];
    $blogpress_body_color = $atts[ 'desccolor' ];
    $blogpress_body_styles = 'style="';
    if ( !empty($blogpress_body_size) && $blogpress_body_size != 'inherit' ) $blogpress_body_styles .=  'font-size:' . $blogpress_body_size . 'px; ';
    if ( !empty($blogpress_body_weight) && $blogpress_body_weight != 'inherit' ) $blogpress_body_styles .= 'font-weight:' . $blogpress_body_weight . '; ';
    if ( !empty($blogpress_body_color) ) $blogpress_body_styles .= 'color:#' . str_replace('#', '', $blogpress_body_color) . ';';
    $blogpress_body_styles .= '"';

    //Shared link title
    $blogpress_link_title_format = $atts[ 'linktitleformat' ];
    if (empty($blogpress_link_title_format)) $blogpress_link_title_format = 'p';
    $blogpress_link_title_size = $atts[ 'linktitlesize' ];
    $blogpress_link_title_color = $atts[ 'linktitlecolor' ];
    $blogpress_link_url_color = $atts[ 'linkurlcolor' ];

    $blogpress_link_title_styles = 'style="';
    if ( !empty($blogpress_link_title_size) && $blogpress_link_title_size != 'inherit' ) $blogpress_link_title_styles .=  'font-size:' . $blogpress_link_title_size . 'px;';
    $blogpress_link_title_styles .= '"';

    //Shared link box
    $blogpress_link_bg_color = $atts[ 'linkbgcolor' ];
    $blogpress_link_border_color = $atts[ 'linkbordercolor' ];
    $blogpress_disable_link_box = $atts['disablelinkbox'];
    ($blogpress_disable_link_box == 'true' || $blogpress_disable_link_box == 'on') ? $blogpress_disable_link_box = true : $blogpress_disable_link_box = false;

    $blogpress_link_box_styles = 'style="';
    if ( !empty($blogpress_link_border_color) ) $blogpress_link_box_styles .=  'border: 1px solid #' . str_replace('#', '', $blogpress_link_border_color) . '; ';
    if ( !empty($blogpress_link_bg_color) ) $blogpress_link_box_styles .= 'background-color: #' . str_replace('#', '', $blogpress_link_bg_color) . ';';
    $blogpress_link_box_styles .= '"';

    //Event Title
    $blogpress_event_title_format = $atts[ 'eventtitleformat' ];
    if (empty($blogpress_event_title_format)) $blogpress_event_title_format = 'p';
    $blogpress_event_title_size = $atts[ 'eventtitlesize' ];
    $blogpress_event_title_weight = $atts[ 'eventtitleweight' ];
    $blogpress_event_title_color = $atts[ 'eventtitlecolor' ];
    $blogpress_event_title_styles = 'style="';
    if ( !empty($blogpress_event_title_size) && $blogpress_event_title_size != 'inherit' ) $blogpress_event_title_styles .=  'font-size:' . $blogpress_event_title_size . 'px; ';
    if ( !empty($blogpress_event_title_weight) && $blogpress_event_title_weight != 'inherit' ) $blogpress_event_title_styles .= 'font-weight:' . $blogpress_event_title_weight . '; ';
    if ( !empty($blogpress_event_title_color) ) $blogpress_event_title_styles .= 'color:#' . str_replace('#', '', $blogpress_event_title_color) . ';';
    $blogpress_event_title_styles .= '"';
    $blogpress_event_title_link = $atts[ 'eventtitlelink' ];
    //Event Date
    $blogpress_event_date_size = $atts[ 'eventdatesize' ];
    $blogpress_event_date_weight = $atts[ 'eventdateweight' ];
    $blogpress_event_date_color = $atts[ 'eventdatecolor' ];
    $blogpress_event_date_position = $atts[ 'eventdatepos' ];
    $blogpress_event_date_formatting = $atts[ 'eventdateformat' ];
    $blogpress_event_date_custom = $atts[ 'eventdatecustom' ];
    $blogpress_event_date_styles = 'style="';
    if ( !empty($blogpress_event_date_size) && $blogpress_event_date_size != 'inherit' ) $blogpress_event_date_styles .=  'font-size:' . $blogpress_event_date_size . 'px; ';
    if ( !empty($blogpress_event_date_weight) && $blogpress_event_date_weight != 'inherit' ) $blogpress_event_date_styles .= 'font-weight:' . $blogpress_event_date_weight . '; ';
    if ( !empty($blogpress_event_date_color) ) $blogpress_event_date_styles .= 'color:#' . str_replace('#', '', $blogpress_event_date_color) . ';';
    $blogpress_event_date_styles .= '"';
    //Event Details
    $blogpress_event_details_size = $atts[ 'eventdetailssize' ];
    $blogpress_event_details_weight = $atts[ 'eventdetailsweight' ];
    $blogpress_event_details_color = $atts[ 'eventdetailscolor' ];
    $blogpress_event_link_color = $atts[ 'eventlinkcolor' ];
    $blogpress_event_details_styles = 'style="';
    if ( !empty($blogpress_event_details_size) && $blogpress_event_details_size != 'inherit' ) $blogpress_event_details_styles .=  'font-size:' . $blogpress_event_details_size . 'px; ';
    if ( !empty($blogpress_event_details_weight) && $blogpress_event_details_weight != 'inherit' ) $blogpress_event_details_styles .= 'font-weight:' . $blogpress_event_details_weight . '; ';
    if ( !empty($blogpress_event_details_color) ) $blogpress_event_details_styles .= 'color:#' . str_replace('#', '', $blogpress_event_details_color) . ';';
    $blogpress_event_details_styles .= '"';
    //Date
    $blogpress_date_position = $atts[ 'datepos' ];
    if (!isset($blogpress_date_position)) $blogpress_date_position = 'below';
    $blogpress_date_size = $atts[ 'datesize' ];
    $blogpress_date_weight = $atts[ 'dateweight' ];
    $blogpress_date_color = $atts[ 'datecolor' ];
    $blogpress_date_styles = 'style="';
    if ( !empty($blogpress_date_size) && $blogpress_date_size != 'inherit' ) $blogpress_date_styles .=  'font-size:' . $blogpress_date_size . 'px; ';
    if ( !empty($blogpress_date_weight) && $blogpress_date_weight != 'inherit' ) $blogpress_date_styles .= 'font-weight:' . $blogpress_date_weight . '; ';
    if ( !empty($blogpress_date_color) ) $blogpress_date_styles .= 'color:#' . str_replace('#', '', $blogpress_date_color) . ';';
    $blogpress_date_styles .= '"';
    $blogpress_date_before = isset($options[ 'blogpress_date_before' ]) ? $options[ 'blogpress_date_before' ] : '';
    $blogpress_date_after = isset($options[ 'blogpress_date_after' ]) ? $options[ 'blogpress_date_after' ] : '';
    //Set user's timezone based on setting
    $blogpress_timezone = $atts['timezone'];
    $blogpress_orig_timezone = date_default_timezone_get();
    date_default_timezone_set($blogpress_timezone);
    //Link to Facebook
    $blogpress_link_size = $atts[ 'linksize' ];
    $blogpress_link_weight = $atts[ 'linkweight' ];
    $blogpress_link_color = $atts[ 'linkcolor' ];
    $blogpress_link_styles = 'style="';
    if ( !empty($blogpress_link_size) && $blogpress_link_size != 'inherit' ) $blogpress_link_styles .=  'font-size:' . $blogpress_link_size . 'px; ';
    if ( !empty($blogpress_link_weight) && $blogpress_link_weight != 'inherit' ) $blogpress_link_styles .= 'font-weight:' . $blogpress_link_weight . '; ';
    if ( !empty($blogpress_link_color) ) $blogpress_link_styles .= 'color:#' . str_replace('#', '', $blogpress_link_color) . ';';
    $blogpress_link_styles .= '"';
    $blogpress_facebook_link_text = $atts[ 'facebooklinktext' ];
    $blogpress_view_link_text = $atts[ 'viewlinktext' ];
    $blogpress_link_to_timeline = $atts[ 'linktotimeline' ];
    /********** MISC **********/
    //Like Box styles
    $blogpress_likebox_bg_color = $atts[ 'likeboxcolor' ];

    $blogpress_like_box_text_color = $atts[ 'likeboxtextcolor' ];
    $blogpress_like_box_colorscheme = 'light';
    if ($blogpress_like_box_text_color == 'white') $blogpress_like_box_colorscheme = 'dark';

    $blogpress_likebox_width = $atts[ 'likeboxwidth' ];
    $blogpress_likebox_height = $atts[ 'likeboxheight' ];
    $blogpress_likebox_height = preg_replace('/px$/', '', $blogpress_likebox_height);

    if ( !isset($blogpress_likebox_width) || empty($blogpress_likebox_width) || $blogpress_likebox_width == '' ) $blogpress_likebox_width = '100%';
    $blogpress_like_box_faces = $atts[ 'likeboxfaces' ];
    if ( !isset($blogpress_like_box_faces) || empty($blogpress_like_box_faces) ) $blogpress_like_box_faces = 'false';
    $blogpress_like_box_border = $atts[ 'likeboxborder' ];
    if ($blogpress_like_box_border) {
        $blogpress_like_box_border = 'true';
    } else {
        $blogpress_like_box_border = 'false';
    }

    //Compile Like box styles
    $blogpress_likebox_styles = 'style="width: ' . $blogpress_likebox_width . ';';
    if ( !empty($blogpress_likebox_bg_color) ) $blogpress_likebox_styles .= ' background-color: #' . str_replace('#', '', $blogpress_likebox_bg_color) . ';';

    //Set the left margin on the like box based on how it's being displayed
    if ( (!empty($blogpress_likebox_bg_color) && $blogpress_likebox_bg_color != '#') || ($blogpress_like_box_faces == 'true' || $blogpress_like_box_faces == 'on') ) $blogpress_likebox_styles .= ' margin-left: 0px;';  

    $blogpress_likebox_styles .= '"';

    //Get feed header settings
    $blogpress_header_bg_color = $atts['headerbg'];
    $blogpress_header_padding = $atts['headerpadding'];
    $blogpress_header_text_size = $atts['headertextsize'];
    $blogpress_header_text_weight = $atts['headertextweight'];
    $blogpress_header_text_color = $atts['headertextcolor'];

    //Compile feed header styles
    $blogpress_header_styles = 'style="';
    if ( !empty($blogpress_header_bg_color) ) $blogpress_header_styles .= 'background-color: #' . str_replace('#', '', $blogpress_header_bg_color) . ';';
    if ( !empty($blogpress_header_padding) ) $blogpress_header_styles .= ' padding: ' . $blogpress_header_padding . ';';
    if ( !empty($blogpress_header_text_size) ) $blogpress_header_styles .= ' font-size: ' . $blogpress_header_text_size . 'px;';
    if ( !empty($blogpress_header_text_weight) ) $blogpress_header_styles .= ' font-weight: ' . $blogpress_header_text_weight . ';';
    if ( !empty($blogpress_header_text_color) ) $blogpress_header_styles .= ' color: #' . str_replace('#', '', $blogpress_header_text_color) . ';';
    $blogpress_header_styles .= '"';

    //Video
    //Dimensions
    $blogpress_video_width = 640;
    $blogpress_video_height = $atts[ 'videoheight' ];
    
    //Action
    $blogpress_video_action = $atts[ 'videoaction' ];
    //Separating Line
    $blogpress_sep_color = $atts[ 'sepcolor' ];
    if (empty($blogpress_sep_color)) $blogpress_sep_color = 'ddd';
    $blogpress_sep_size = $atts[ 'sepsize' ];
    //If empty then set a 0px border
    if ( empty($blogpress_sep_size) || $blogpress_sep_size == '' ) {
        $blogpress_sep_size = 0;
        //Need to set a color otherwise the CSS is invalid
        $blogpress_sep_color = 'fff';
    }

    $blogpress_post_bg_color = $atts['postbgcolor'];
    $blogpress_post_rounded = $atts['postcorners'];
    ($blogpress_post_bg_color !== '#' && $blogpress_post_bg_color !== '') ? $blogpress_post_bg_color_check = true : $blogpress_post_bg_color_check = false;
    ($blogpress_sep_color !== '#' && $blogpress_sep_color !== '') ? $blogpress_sep_color_check = true : $blogpress_sep_color_check = false;
    
    $blogpress_item_styles = '';
    //blogpress item styles
    if( $blogpress_sep_color_check || $blogpress_post_bg_color_check ){
        $blogpress_item_styles = 'style="';
        if($blogpress_sep_color_check && !$blogpress_post_bg_color_check) $blogpress_item_styles .= 'border-bottom: ' . $blogpress_sep_size . 'px solid #' . str_replace('#', '', $blogpress_sep_color) . '; ';
        if($blogpress_post_bg_color_check) $blogpress_item_styles .= 'background-color: ' . $blogpress_post_bg_color . '; ';
        if(isset($blogpress_post_rounded)) $blogpress_item_styles .= '-webkit-border-radius: ' . $blogpress_post_rounded . 'px; -moz-border-radius: ' . $blogpress_post_rounded . 'px; border-radius: ' . $blogpress_post_rounded . 'px; ';
        $blogpress_item_styles .= '"';
    }
   
    //Text limits
    $title_limit = $atts['textlength'];
    if (!isset($title_limit)) $title_limit = 9999;
    $body_limit = $atts['desclength'];
    //Assign the Access Token and Page ID variables
    $access_token = $atts['accesstoken'];
    $page_id = trim( $atts['id'] );

    //If user pastes their full URL into the Page ID field then strip it out
    $blogpress_facebook_string = 'facebook.com';
    $blogpress_page_id_url_check = stripos($page_id, $blogpress_facebook_string);

    if ( $blogpress_page_id_url_check ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }

    //If the Page ID contains a query string at the end then remove it
    if ( stripos( $page_id, '?') !== false ) $page_id = substr($page_id, 0, strrpos($page_id, '?'));

    //Get show posts attribute. If not set then default to 25
    $show_posts = $atts['num'];
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;
    
    //If the 'Enter my own Access Token' box is unchecked then don't use the user's access token, even if there's one in the field
    get_option('blogpress_show_access_token') ? $blogpress_show_access_token = true : $blogpress_show_access_token = false;

    //If there's no Access Token then use the default
    // if ($access_token == '' || !$blogpress_show_access_token) $access_token = '1436737606570258|MGh1BX4_b_D9HzJtKe702cwMRPI';
    $access_token_array = array(
        '1489500477999288|KFys5ppNi3sreihdreqPkU2ChIE',
        '859332767418162|BR-YU8zjzvonNrszlll_1a4y_xE',
        '360558880785446|4jyruti_VkxxK7gS7JeyX-EuSXs',
        '1487072591579718|0KQzP-O2E4mvFCPxTLWP1b87I4Q',
        '640861236031365|2rENQzxtWtG12DtlZwqfZ6Vu6BE'
    );
    if ($access_token == '' || !$blogpress_show_access_token) $access_token = $access_token_array[rand(0, 4)];



    //Check whether a Page ID has been defined
    if ($page_id == '') {
        echo "Please enter the Page ID of the Facebook feed you'd like to display. You can do this in either the Custom Facebook Feed plugin settings or in the shortcode itself. For example, [custom-facebook-feed id=YOUR_PAGE_ID_HERE].<br /><br />";
        return false;
    }


    //Is it SSL?
    $blogpress_ssl = '';
    if (is_ssl()) $blogpress_ssl = '&return_ssl_resources=true';

    //Use posts? or feed?
    $old_others_option = get_option('blogpress_show_others'); //Use this to help depreciate the old option
    $show_others = $atts['others'];
    $show_posts_by = $atts['showpostsby'];
    $graph_query = 'posts';
    $blogpress_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if ($show_others || $old_others_option == 'on') {
        //Show posts by everyone
        if ( $old_others_option == 'on' || $show_others == 'on' || $show_others == 'true' || $show_others == true || $blogpress_is_group ) $graph_query = 'feed';

        //Only show posts by me
        if ( $show_others == 'false' ) $graph_query = 'posts';

    } else {
    //Else use the settings page option or the 'showpostsby' shortcode option

        //Only show posts by me
        if ( $show_posts_by == 'me' ) $graph_query = 'posts';

        //Show posts by everyone
        if ( $show_posts_by == 'others' || $blogpress_is_group ) $graph_query = 'feed';

        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$blogpress_is_group ) {
            $graph_query = 'feed';
            $blogpress_show_only_others = true;
        }

    }


    //If the limit isn't set then set it to be 5 more than the number of posts defined
    if ( isset($atts['limit']) && $atts['limit'] !== '' ) {
        $blogpress_post_limit = $atts['limit'];
    } else {
        $blogpress_post_limit = intval(intval($show_posts) + 7);
    }


    //Calculate the cache time in seconds
    if($blogpress_cache_time_unit == 'minutes') $blogpress_cache_time_unit = 60;
    if($blogpress_cache_time_unit == 'hours') $blogpress_cache_time_unit = 60*60;
    if($blogpress_cache_time_unit == 'days') $blogpress_cache_time_unit = 60*60*24;
    $cache_seconds = $blogpress_cache_time * $blogpress_cache_time_unit;

    //Get like box vars
    $blogpress_likebox_width = $atts[ 'likeboxwidth' ];
    if ( !isset($blogpress_likebox_width) || empty($blogpress_likebox_width) || $blogpress_likebox_width == '' ) $blogpress_likebox_width = 300;
    $blogpress_like_box_faces = $atts[ 'likeboxfaces' ];
    if ( !isset($blogpress_like_box_faces) || empty($blogpress_like_box_faces) ) $blogpress_like_box_faces = 'false';

    //Set like box variable
    isset( $options[ 'blogpress_app_id' ] ) ? $blogpress_app_id = $options[ 'blogpress_app_id' ] : $blogpress_app_id = '';
    ( isset($blogpress_app_id) && !empty($blogpress_app_id) ) ? $blogpress_like_box_params = '&appId=' .$blogpress_app_id : $blogpress_like_box_params = '';
    $like_box = '<div class="blogpress-likebox';
    if ($blogpress_like_box_outside) $like_box .= ' blogpress-outside';
    $like_box .= ($blogpress_like_box_position == 'top') ? ' top' : ' bottom';
    $like_box .= '" ' . $blogpress_likebox_styles . '><script src="https://connect.facebook.net/' . $blogpress_locale . '/all.js#xfbml=1 '.$blogpress_like_box_params.'"></script><fb:like-box href="http://www.facebook.com/' . $page_id . '" show_faces="'.$blogpress_like_box_faces.'" stream="false" header="false" colorscheme="'. $blogpress_like_box_colorscheme .'" show_border="'. $blogpress_like_box_border .'" data-height="'.$blogpress_likebox_height.'"></fb:like-box><div id="fb-root"></div></div>';
    //Don't show like box if it's a group
    if($blogpress_is_group) $like_box = '';


    //Feed header
    $blogpress_show_header = $atts['showheader'];
    ($blogpress_show_header == 'true' || $blogpress_show_header == 'on') ? $blogpress_show_header = true : $blogpress_show_header = false;

    $blogpress_header_outside = $atts['headeroutside'];
    ($blogpress_header_outside == 'true' || $blogpress_header_outside == 'on') ? $blogpress_header_outside = true : $blogpress_header_outside = false;

    $blogpress_header_text = $atts['headertext'];
    $blogpress_header_icon = $atts['headericon'];
    $blogpress_header_icon_color = $atts['headericoncolor'];
    $blogpress_header_icon_size = $atts['headericonsize'];

    $blogpress_header = '<h3 class="blogpress-header';
    if ($blogpress_header_outside) $blogpress_header .= ' blogpress-outside';
    $blogpress_header .= '"' . $blogpress_header_styles . '>';
    $blogpress_header .= '<i class="fa fa-' . $blogpress_header_icon . '"';
    if(!empty($blogpress_header_icon_color) || !empty($blogpress_header_icon_size)) $blogpress_header .= ' style="';
    if(!empty($blogpress_header_icon_color)) $blogpress_header .= 'color: #' . str_replace('#', '', $blogpress_header_icon_color) . ';';
    if(!empty($blogpress_header_icon_size)) $blogpress_header .= ' font-size: ' . $blogpress_header_icon_size . 'px;';
    if(!empty($blogpress_header_icon_color) || !empty($blogpress_header_icon_size))$blogpress_header .= '"';
    $blogpress_header .= '></i>';
    $blogpress_header .= '<span class="header-text" style="height: '.$blogpress_header_icon_size.'px;">' . $blogpress_header_text . '</span>';
    $blogpress_header .= '</h3>';


    //***START FEED***
    $blogpress_content = '';

    //Add the page header to the outside of the top of feed
    if ($blogpress_show_header && $blogpress_header_outside) $blogpress_content .= $blogpress_header;

    //Add like box to the outside of the top of feed
    if ($blogpress_like_box_position == 'top' && $blogpress_show_like_box && $blogpress_like_box_outside) $blogpress_content .= $like_box;

    //Create blogpress container HTML
    $blogpress_content .= '<div class="blogpress-wrapper">';
    $blogpress_content .= '<div id="blogpress" rel="'.$title_limit.'" class="';
    if( !empty($blogpress_class) ) $blogpress_content .= $blogpress_class . ' ';
    if ( !empty($blogpress_feed_height) ) $blogpress_content .= 'blogpress-fixed-height ';
    $blogpress_content .= '" ' . $blogpress_feed_styles . '>';

    //Add the page header to the inside of the top of feed
    if ($blogpress_show_header && !$blogpress_header_outside) $blogpress_content .= $blogpress_header;

    //Add like box to the inside of the top of feed
    if ($blogpress_like_box_position == 'top' && $blogpress_show_like_box && !$blogpress_like_box_outside) $blogpress_content .= $like_box;
    //Limit var
    $i = 0;

    //Define array for post items
    $blogpress_posts_array = array();
    
    //ALL POSTS
    if (!$blogpress_events_only){

        $blogpress_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/' . $graph_query . '?access_token=' . $access_token . '&limit=' . $blogpress_post_limit . '&locale=' . $blogpress_locale . $blogpress_ssl;

        //Don't use caching if the cache time is set to zero
        if ($blogpress_cache_time != 0){
            // Get any existing copy of our transient data
            $transient_name = 'blogpress_'. $graph_query .'_json_' . $page_id;
            if ( false === ( $posts_json = get_transient( $transient_name ) ) || $posts_json === null ) {
                //Get the contents of the Facebook page
                $posts_json = blogpress_fetchUrl($blogpress_posts_json_url);

                //Check whether any data is returned from the API. If it isn't then don't cache the error response and instead keep checking the API on every page load until data is returned.
                $FBdata = json_decode($posts_json);
                if( !empty($FBdata->data) ) {
                    //Cache the JSON
                    set_transient( $transient_name, $posts_json, $cache_seconds );
                }
            } else {
                $posts_json = get_transient( $transient_name );
                //If we can't find the transient then fall back to just getting the json from the api
                if ($posts_json == false) $posts_json = blogpress_fetchUrl($blogpress_posts_json_url);
            }
        } else {
            $posts_json = blogpress_fetchUrl($blogpress_posts_json_url);
        }

        
        //Interpret data with JSON
        $FBdata = json_decode($posts_json);

        //If there's no data then show a pretty error message
        if( empty($FBdata->data) ) {
            $blogpress_content .= '<div class="blogpress-error-msg"><p>Unable to display Facebook posts.<br/><a href="javascript:void(0);" id="blogpress-show-error" onclick="blogpressShowError()">Show error</a>';
            $blogpress_content .= '<script type="text/javascript">function blogpressShowError() { document.getElementById("blogpress-error-reason").style.display = "block"; document.getElementById("blogpress-show-error").style.display = "none"; }</script>';
            $blogpress_content .= '</p><div id="blogpress-error-reason">';
            
            if( isset($FBdata->error->message) ) $blogpress_content .= 'Error: ' . $FBdata->error->message;
            if( isset($FBdata->error->type) ) $blogpress_content .= '<br />Type: ' . $FBdata->error->type;
            if( isset($FBdata->error->code) ) $blogpress_content .= '<br />Code: ' . $FBdata->error->code;
            if( isset($FBdata->error->error_subcode) ) $blogpress_content .= '<br />Subcode: ' . $FBdata->error->error_subcode;

            if( isset($FBdata->error_msg) ) $blogpress_content .= 'Error: ' . $FBdata->error_msg;
            if( isset($FBdata->error_code) ) $blogpress_content .= '<br />Code: ' . $FBdata->error_code;
            
            if($FBdata == null) $blogpress_content .= 'Error: Server configuration issue';

            if( empty($FBdata->error) && empty($FBdata->error_msg) && $FBdata !== null ) $blogpress_content .= 'Error: No posts available for this Facebook ID';

            $blogpress_content .= '<br />Please refer to our <a href="http://smashballoon.com/custom-facebook-feed/docs/errors/" target="_blank">Error Message Reference</a>.';
            $blogpress_content .= '</div></div>'; //End .blogpress-error-msg and #blogpress-error-reason
            $blogpress_content .= '</div></div>'; //End #blogpress and .blogpress-wrapper

            return $blogpress_content;
        }

        //***STARTS POSTS LOOP***
        foreach ($FBdata->data as $news )
        {
            //Explode News and Page ID's into 2 values
            $PostID = explode("_", $news->id);
            //Check the post type
            $blogpress_post_type = $news->type;
            if ($blogpress_post_type == 'link') {
                isset($news->story) ? $story = $news->story : $story = '';
                //Check whether it's an event
                $event_link_check = "facebook.com/events/";
                $event_link_check = stripos($news->link, $event_link_check);
                if ( $event_link_check ) $blogpress_post_type = 'event';
            }
            //Should we show this post or not?
            $blogpress_show_post = false;
            switch ($blogpress_post_type) {
                case 'link':
                    if ( $blogpress_show_links_type ) $blogpress_show_post = true;
                    break;
                case 'event':
                    if ( $blogpress_show_event_type ) $blogpress_show_post = true;
                    break;
                case 'video':
                     if ( $blogpress_show_video_type ) $blogpress_show_post = true;
                    break;
                case 'swf':
                     if ( $blogpress_show_video_type ) $blogpress_show_post = true;
                    break;
                case 'photo':
                     if ( $blogpress_show_photos_type ) $blogpress_show_post = true;
                    break;
                case 'offer':
                     $blogpress_show_post = true;
                    break;
                case 'status':
                    //Check whether it's a status (author comment or like)
                    if ( $blogpress_show_status_type && !empty($news->message) ) $blogpress_show_post = true;
                    break;
            }


            //ONLY show posts by others
            if ( $blogpress_show_only_others ) {
                //Get the numeric ID of the page
                $page_object = blogpress_fetchUrl('https://graph.facebook.com/' . $page_id);
                $page_object = json_decode($page_object);
                $numeric_page_id = $page_object->id;

                //If the post author's ID is the same as the page ID then don't show the post
                if ( $numeric_page_id == $news->from->id ) $blogpress_show_post = false;
            }


            //Is it a duplicate post?
            if (!isset($prev_post_message)) $prev_post_message = '';
            if (!isset($prev_post_link)) $prev_post_link = '';
            if (!isset($prev_post_description)) $prev_post_description = '';
            isset($news->message) ? $pm = $news->message : $pm = '';
            isset($news->link) ? $pl = $news->link : $pl = '';
            isset($news->description) ? $pd = $news->description : $pd = '';

            if ( ($prev_post_message == $pm) && ($prev_post_link == $pl) && ($prev_post_description == $pd) ) $blogpress_show_post = false;

            //Check post type and display post if selected
            if ( $blogpress_show_post ) {
                //If it isn't then create the post
                //Only create posts for the amount of posts specified
                if ( $i == $show_posts ) break;
                $i++;
                //********************************//
                //***COMPILE SECTION VARIABLES***//
                //********************************//
                //Set the post link
                isset($news->link) ? $link = htmlspecialchars($news->link) : $link = '';
                //Is it a shared album?
                $shared_album_string = 'shared an album:';
                isset($news->story) ? $story = $news->story : $story = '';
                $shared_album = stripos($story, $shared_album_string);
                if ( $shared_album ) {
                    $link = str_replace('photo.php?','media/set/?',$link);
                }

                //Is it an album?
                $blogpress_album = false;
                $album_string = 'relevant_count=';
                $relevant_count = stripos($link, $album_string);

                if ( $relevant_count ) {
                    //If relevant_count is larger than 1 then there are multiple photos
                    $relevant_count = explode('relevant_count=', $link);
                    $num_photos = intval($relevant_count[1]);
                    if ( $num_photos > 1 ) {
                        $blogpress_album = true;
                    
                        //Link to the album instead of the photo
                        $album_link = str_replace('photo.php?','media/set/?',$link);
                        $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                    }
                }

                //If there's no link provided then link to either the Facebook page or the individual status
                if (empty($news->link)) {
                    if ($blogpress_link_to_timeline == true){
                        //Link to page
                        $link = 'http://facebook.com/' . $page_id;
                    } else {
                        //Link to status
                        $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                    }
                }

                //DATE
                $blogpress_date_formatting = $atts[ 'dateformat' ];
                $blogpress_date_custom = $atts[ 'datecustom' ];

                $post_time = $news->created_time;
                $blogpress_date = '<p class="blogpress-date" '.$blogpress_date_styles.'>'. $blogpress_date_before . ' ' . blogpress_getdate(strtotime($post_time), $blogpress_date_formatting, $blogpress_date_custom) . ' ' . $blogpress_date_after;
                if($blogpress_date_position == 'below' || (!$blogpress_show_author && $blogpress_date_position == 'author') ) $blogpress_date .= '<span class="blogpress-date-dot">&nbsp;&middot;&nbsp;&nbsp;</span>';
                $blogpress_date .= '</p>';
                
                //POST AUTHOR
                $blogpress_author = '<div class="blogpress-author">';
                
                //Author text
                $blogpress_author .= '<a href="https://facebook.com/' . $news->from->id . '" '.$target.' title="'.$news->from->name.' on Facebook" '.$blogpress_author_styles.'><div class="blogpress-author-text">';

                if($blogpress_show_date && $blogpress_date_position !== 'above' && $blogpress_date_position !== 'below'){
                    $blogpress_author .= '<p class="blogpress-page-name blogpress-author-date">'.$news->from->name.'</p>';
                    $blogpress_author .= $blogpress_date;
                } else {
                    $blogpress_author .= '<span class="blogpress-page-name">'.$news->from->name.'</span>';
                }

                $blogpress_author .= '</div>';

                //Author image
                //Set the author image as a variable. If it already exists then don't query the api for it again.
                $blogpress_author_img_var = '$blogpress_author_img_' . $news->from->id;
                if ( !isset($$blogpress_author_img_var) ) $$blogpress_author_img_var = 'https://graph.facebook.com/' . $news->from->id . '/picture?type=square';
                $blogpress_author .= '<div class="blogpress-author-img"><img src="'.$$blogpress_author_img_var.'" title="'.$news->from->name.'" alt="'.$news->from->name.'" width=40 height=40></div>';

                $blogpress_author .= '</a></div>'; //End .blogpress-author


                //POST TEXT
                $blogpress_translate_photos_text = $atts['photostext'];
                if (!isset($blogpress_translate_photos_text) || empty($blogpress_translate_photos_text)) $blogpress_translate_photos_text = 'photos';
                $blogpress_post_text = '<' . $blogpress_title_format . ' class="blogpress-post-text" ' . $blogpress_title_styles . '>';
                $blogpress_post_text .= '<span class="blogpress-text">';
                if ($blogpress_title_link) $blogpress_post_text .= '<a class="blogpress-post-text-link" '.$blogpress_title_styles.' href="'.$link.'" '.$target.'>';
                //Which content should we use?
                $blogpress_post_text_type = '';
                //Use the story
                if (!empty($news->story)) {
                    $post_text = htmlspecialchars($news->story);
                    $blogpress_post_text_type = 'story';
                }
                //Use the message
                if (!empty($news->message)) {
                    $post_text = htmlspecialchars($news->message);
                    $blogpress_post_text_type = 'message';
                }
                //Use the name
                if (!empty($news->name) && empty($news->story) && empty($news->message)) {
                    $post_text = htmlspecialchars($news->name);
                    $blogpress_post_text_type = 'name';
                }
                if ($blogpress_album) {
                    if (!empty($news->name)) {
                        $post_text = htmlspecialchars($news->name);
                        $blogpress_post_text_type = 'name';
                    }
                    if (!empty($news->message) && empty($news->name)) {
                        $post_text = htmlspecialchars($news->message);
                        $blogpress_post_text_type = 'message';
                    }
                    $post_text .= ' (' . $num_photos . ' '.$blogpress_translate_photos_text.')';
                }


                //MESSAGE TAGS
                $blogpress_post_tags = $atts[ 'posttags' ];
                //If the post tags option doesn't exist yet (ie. on plugin update) then set them as true
                if ( !array_key_exists( 'blogpress_post_tags', $options ) ) $blogpress_post_tags = true;
                //Add message and story tags if there are any and the post text is the message or the story
                if( $blogpress_post_tags && ( isset($news->message_tags) || isset($news->story_tags) ) && ($blogpress_post_text_type == 'message' || $blogpress_post_text_type == 'story')  && !$blogpress_title_link){
                    //Use message_tags or story_tags?
                    ( isset($news->message_tags) )? $text_tags = $news->message_tags : $text_tags = $news->story_tags;

                    //If message tags and message is being used as the post text, or same with story. This stops story tags being used to replace the message inadvertently.
                    if( ( $blogpress_post_text_type == 'message' && isset($news->message_tags) ) || ( $blogpress_post_text_type == 'story' && !isset($news->message_tags) ) ) {

                        //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                        $blogpress_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;');

                        //always use the text replace method
                        if( blogpress_stripos_arr($post_text, $blogpress_html_check_array) !== false ) {
                            //Loop through the tags
                            foreach($text_tags as $message_tag ) {
                                $tag_name = $message_tag[0]->name;
                                $tag_link = '<a href="http://facebook.com/' . $message_tag[0]->id . '" style="color: #'.str_replace('#', '', $atts['textlinkcolor']).';" target="_blank">' . $message_tag[0]->name . '</a>';

                                $post_text = str_replace($tag_name, $tag_link, $post_text);
                            }

                        } else {
                        //If it doesn't contain HTMl tags then use the offset to replace message tags
                            $message_tags_arr = array();

                            $i = 0;
                            foreach($text_tags as $message_tag ) {
                                $i++;
                                $message_tags_arr = blogpress_array_push_assoc(
                                    $message_tags_arr,
                                    $i,
                                    array(
                                        'id' => $message_tag[0]->id,
                                        'name' => $message_tag[0]->name,
                                        'type' => $message_tag[0]->type,
                                        'offset' => $message_tag[0]->offset,
                                        'length' => $message_tag[0]->length
                                    )
                                );
                            }

                            for($i = count($message_tags_arr); $i >= 1; $i--) {
                               
                                $b = '<a href="http://facebook.com/' . $message_tags_arr[$i]['id'] . '" style="color: #'.str_replace('#', '', $atts['textlinkcolor']).';" target="_blank">' . $message_tags_arr[$i]['name'] . '</a>';
                                $c = $message_tags_arr[$i]['offset'];
                                $d = $message_tags_arr[$i]['length'];

                                $post_text = blogpress_mb_substr_replace( $post_text, $b, $c, $d);

                            }   

                        } // end if/else

                    } // end message check

                } //END MESSAGE TAGS

                //Replace line breaks in text (needed for IE8)
                $post_text = preg_replace("/\r\n|\r|\n/",'<br/>', $post_text);

                //If the text is wrapped in a link then don't hyperlink any text within
                if ($blogpress_title_link) {
                    //Wrap links in a span so we can break the text if it's too long
                    $blogpress_post_text .= blogpress_wrap_span( $post_text ) . ' ';
                } else {
                    //Don't use htmlspecialchars for post_text as it's added above so that it doesn't mess up the message_tag offsets
                    $blogpress_post_text .= blogpress_autolink( $post_text, $link_color=str_replace('#', '', $atts['textlinkcolor']) ) . ' ';
                }
                
                if ($blogpress_title_link) $blogpress_post_text .= '</a>';
                $blogpress_post_text .= '</span>';
                //'See More' link
                $blogpress_post_text .= '<span class="blogpress-expand">... <a href="#" style="color: #'.str_replace('#', '', $atts['textlinkcolor']).'"><span class="blogpress-more">' . $blogpress_see_more_text . '</span><span class="blogpress-less">' . $blogpress_see_less_text . '</span></a></span>';
                $blogpress_post_text .= '</' . $blogpress_title_format . '>';

                //DESCRIPTION
                $blogpress_description = '';
                //Use the description if it's available and the post type isn't set to offer (offer description isn't useful)
                if ( ( !empty($news->description)  || !empty($news->caption) ) && $blogpress_post_type != 'offer') {

                    $description_text = '';
                    if ( !empty($news->description) ) {
                        $description_text = $news->description;
                    } else {
                        $description_text = $news->caption;
                    }

                    if (!empty($body_limit)) {
                        if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                    }
                    $blogpress_description .= '<p class="blogpress-post-desc" '.$blogpress_body_styles.'><span>' . blogpress_autolink( htmlspecialchars($description_text) )  . ' </span></p>';

                    //If the post text and description/caption are the same then don't show the description
                    if($post_text == $description_text) $blogpress_description = '';

                }

                //LINK
                $blogpress_shared_link = '';
                //Display shared link
                if ($blogpress_post_type == 'link') {
                    $blogpress_shared_link .= '<div class="blogpress-shared-link';
                    if($blogpress_disable_link_box) $blogpress_shared_link .= ' blogpress-no-styles"';
                    if(!$blogpress_disable_link_box) $blogpress_shared_link .= '" ' . $blogpress_link_box_styles;
                    $blogpress_shared_link .= '>';

                    //Display link name and description
                    if (!empty($news->description)) {
                        $blogpress_shared_link .= '<div class="blogpress-text-link ';
                        $blogpress_shared_link .= 'blogpress-no-image';
                        //The link title:
                        $blogpress_shared_link .= '"><'.$blogpress_link_title_format.' class="blogpress-link-title" '.$blogpress_link_title_styles.'><a href="'.$link.'" '.$target.' style="color:#' . str_replace('#', '', $blogpress_link_title_color) . ';">'. $news->name . '</a></'.$blogpress_link_title_format.'>';
                        //The link source:
                        if(!empty($news->caption)) $blogpress_shared_link .= '<p class="blogpress-link-caption" style="color:#' . str_replace('#', '', $blogpress_link_url_color) . ';">'.$news->caption.'</p>';
                        if ($blogpress_show_desc) {
                            $blogpress_shared_link .= $blogpress_description;
                        }
                        $blogpress_shared_link .= '</div>';
                    }

                    $blogpress_shared_link .= '</div>';
                }

                //EVENT
                $blogpress_event = '';
                if ($blogpress_show_event_title || $blogpress_show_event_details) {
                    //Check for media
                    if ($blogpress_post_type == 'event') {
                        
                        //Get the event id from the event URL. eg: http://www.facebook.com/events/123451234512345/
                        $event_url = parse_url($link);
                        $url_parts = explode('/', $event_url['path']);
                        //Get the id from the parts
                        $eventID = $url_parts[count($url_parts)-2];
                        
                        //Get the contents of the event using the WP HTTP API
                        $event_json_url = 'https://graph.facebook.com/'.$eventID.'?access_token=' . $access_token . $blogpress_ssl;

                        //Don't use caching if the cache time is set to zero
                        if ($blogpress_cache_time != 0){
                            // Get any existing copy of our transient data
                            $transient_name = 'blogpress_timeline_event_json_' . $eventID;
                            if ( false === ( $event_json = get_transient( $transient_name ) ) || $event_json === null ) {
                                //Get the contents of the Facebook page
                                $event_json = blogpress_fetchUrl($event_json_url);
                                //Cache the JSON
                                set_transient( $transient_name, $event_json, $cache_seconds );
                            } else {
                                $event_json = get_transient( $transient_name );
                                //If we can't find the transient then fall back to just getting the json from the api
                                if ($event_json == false) $event_json = blogpress_fetchUrl($event_json_url);
                            }
                        } else {
                            $event_json = blogpress_fetchUrl($event_json_url);
                        }

                        //Interpret data with JSON
                        $event_object = json_decode($event_json);

                        //Event date
                        $event_time = $event_object->start_time;
                        isset($event_object->end_time) ? $event_end_time = ' - ' . blogpress_eventdate(strtotime($event_object->end_time), $blogpress_event_date_formatting, $blogpress_event_date_custom) : $event_end_time = '';
                        //If timezone migration is enabled then remove last 5 characters
                        if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
                        if (!empty($event_time)) $blogpress_event_date = '<p class="blogpress-date" '.$blogpress_event_date_styles.'>' . blogpress_eventdate(strtotime($event_time), $blogpress_event_date_formatting, $blogpress_event_date_custom) . $event_end_time.'</p>';


                        //EVENT
                        //Display the event details
                        $blogpress_event .= '<div class="blogpress-details">';
                        //show event date above title
                        if ($blogpress_event_date_position == 'above') $blogpress_event .= $blogpress_event_date;
                        //Show event title
                        if ($blogpress_show_event_title && !empty($event_object->name)) {
                            if ($blogpress_event_title_link) $blogpress_event .= '<a href="'.$link.'">';
                            $blogpress_event .= '<' . $blogpress_event_title_format . ' ' . $blogpress_event_title_styles . '>' . $event_object->name . '</' . $blogpress_event_title_format . '>';
                            if ($blogpress_event_title_link) $blogpress_event .= '</a>';
                        }
                        //show event date below title
                        if ($blogpress_event_date_position !== 'above') $blogpress_event .= $blogpress_event_date;
                        //Show event details
                        if ($blogpress_show_event_details){
                            //Location
                            if (!empty($event_object->location)) $blogpress_event .= '<p class="blogpress-where" ' . $blogpress_event_details_styles . '>' . $event_object->location . '</p>';
                            //Description
                            if (!empty($event_object->description)){
                                $description = $event_object->description;
                                if (!empty($body_limit)) {
                                    if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                                }
                                $blogpress_event .= '<p class="blogpress-info" ' . $blogpress_event_details_styles . '>' . blogpress_autolink($description, $link_color=str_replace('#', '', $blogpress_event_link_color) ) . '</p>';
                            }
                        }
                        $blogpress_event .= '</div>';
                        
                    }
                }

                /* VIDEO */

                //Check to see whether it's an embedded video so that we can show the name above the post text if necessary
                $blogpress_is_video_embed = false;
                if ($news->type == 'video'){
                    $url = $news->source;
                    //Embeddable video strings
                    $youtube = 'youtube';
                    $youtu = 'youtu';
                    $vimeo = 'vimeo';
                    $youtubeembed = 'youtube.com/embed';
                    //Check whether it's a youtube video
                    $youtube = stripos($url, $youtube);
                    $youtu = stripos($url, $youtu);
                    $youtubeembed = stripos($url, $youtubeembed);
                    //Check whether it's a youtube video
                    if($youtube || $youtu || $youtubeembed || (stripos($url, $vimeo) !== false)) {
                        $blogpress_is_video_embed = true;
                    }
                }


                $blogpress_media = '';
                if ($news->type == 'video') {
                    //Add the name to the description if it's a video embed
                    if($blogpress_is_video_embed) {
                        isset($news->name) ? $video_name = $news->name : $video_name = $link;
                        isset($news->description) ? $description_text = $news->description : $description_text = '';
                        //Add the 'blogpress-shared-link' class so that embedded videos display in a box
                        $blogpress_description = '<div class="blogpress-desc-wrap blogpress-shared-link ';
                        if (empty($picture)) $blogpress_description .= 'blogpress-no-image';
                        if($blogpress_disable_link_box) $blogpress_description .= ' blogpress-no-styles"';
                        if(!$blogpress_disable_link_box) $blogpress_description .= '" ' . $blogpress_link_box_styles;
                        $blogpress_description .= '>';

                        if( isset($news->name) ) $blogpress_description .= '<'.$blogpress_link_title_format.' class="blogpress-link-title" '.$blogpress_link_title_styles.'><a href="'.$link.'" '.$target.' style="color:#' . str_replace('#', '', $blogpress_link_title_color) . ';">'. $news->name . '</a></'.$blogpress_link_title_format.'>';

                        if (!empty($body_limit)) {
                            if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                        }

                        $blogpress_description .= '<p class="blogpress-post-desc" '.$blogpress_body_styles.'><span>' . blogpress_autolink( htmlspecialchars($description_text) ) . '</span></p></div>';
                    } else {
                        isset($news->name) ? $video_name = $news->name : $video_name = $link;
                        if( isset($news->name) ) $blogpress_description .= '<'.$blogpress_link_title_format.' class="blogpress-link-title" '.$blogpress_link_title_styles.'><a href="'.$link.'" '.$target.' style="color:#' . str_replace('#', '', $blogpress_link_title_color) . ';">'. $news->name . '</a></'.$blogpress_link_title_format.'>';
                    }
                }


                //Display the link to the Facebook post or external link
                $blogpress_link = '';
                //Default link
                $blogpress_viewpost_class = 'blogpress-viewpost-facebook';
                if ($blogpress_facebook_link_text == '') $blogpress_facebook_link_text = 'View on Facebook';
                $link_text = $blogpress_facebook_link_text;

                //Link to the Facebook post if it's a link or a video
                if($blogpress_post_type == 'link' || $blogpress_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                if ($blogpress_post_type == 'offer') $link_text = 'View Offer';
                $blogpress_link = '<a class="' . $blogpress_viewpost_class . '" href="' . $link . '" title="' . $link_text . '" ' . $target . ' ' . $blogpress_link_styles . '>' . $link_text . '</a>';


                //**************************//
                //***CREATE THE POST HTML***//
                //**************************//
                //Start the container
                $blogpress_post_item = '<div class="blogpress-item ';
                if ($blogpress_post_type == 'link') $blogpress_post_item .= 'blogpress-link-item';
                if ($blogpress_post_type == 'event') $blogpress_post_item .= 'blogpress-timeline-event';
                if ($blogpress_post_type == 'photo') $blogpress_post_item .= 'blogpress-photo-post';
                if ($blogpress_post_type == 'video') $blogpress_post_item .= 'blogpress-video-post';
                if ($blogpress_post_type == 'swf') $blogpress_post_item .= 'blogpress-swf-post';
                if ($blogpress_post_type == 'status') $blogpress_post_item .= 'blogpress-status-post';
                if ($blogpress_post_type == 'offer') $blogpress_post_item .= 'blogpress-offer-post';
                if ($blogpress_album) $blogpress_post_item .= ' blogpress-album';
                if ($blogpress_post_bg_color_check) $blogpress_post_item .= ' blogpress-box';
                $blogpress_post_item .=  ' author-'. blogpress_to_slug($news->from->name) .'" id="'. $news->id .'" ' . $blogpress_item_styles . '>';
                
                    //POST AUTHOR
                    if($blogpress_show_author) $blogpress_post_item .= $blogpress_author;
                    //DATE ABOVE
                    if ($blogpress_show_date && $blogpress_date_position == 'above') $blogpress_post_item .= $blogpress_date;
                    //POST TEXT
                    if($blogpress_show_text) $blogpress_post_item .= $blogpress_post_text;
                    //DESCRIPTION
                    if($blogpress_show_desc && $blogpress_post_type != 'offer' && $blogpress_post_type != 'link') $blogpress_post_item .= $blogpress_description;
                    //LINK
                    if($blogpress_show_shared_links) $blogpress_post_item .= $blogpress_shared_link;
                    //DATE BELOW
                    if ( (!$blogpress_show_author && $blogpress_date_position == 'author') || $blogpress_show_date && $blogpress_date_position == 'below') {
                        if($blogpress_show_date && $blogpress_post_type !== 'event') $blogpress_post_item .= $blogpress_date;
                    }
                    //EVENT
                    if($blogpress_show_event_title || $blogpress_show_event_details) $blogpress_post_item .= $blogpress_event;
                    //DATE BELOW (only for Event posts)
                    if ( (!$blogpress_show_author && $blogpress_date_position == 'author') || $blogpress_show_date && $blogpress_date_position == 'below') {
                        if($blogpress_show_date && $blogpress_post_type == 'event') $blogpress_post_item .= $blogpress_date;
                    }
                    //VIEW ON FACEBOOK LINK
                    if($blogpress_show_link) $blogpress_post_item .= $blogpress_link;
                
                //End the post item
                $blogpress_post_item .= '</div>';

                //PUSH TO ARRAY
                $blogpress_posts_array = blogpress_array_push_assoc($blogpress_posts_array, strtotime($post_time), $blogpress_post_item);

            } // End post type check

            if (isset($news->message)) $prev_post_message = $news->message;
            if (isset($news->link))  $prev_post_link = $news->link;
            if (isset($news->description))  $prev_post_description = $news->description;

        } // End the loop

        //Sort the array in reverse order (newest first)
        krsort($blogpress_posts_array);

    } // End ALL POSTS


    //Output the posts array
    $p = 0;
    foreach ($blogpress_posts_array as $post ) {
        if ( $p == $show_posts ) break;
        $blogpress_content .= $post;
        $p++;
    }

    //Reset the timezone
    date_default_timezone_set( $blogpress_orig_timezone );
    //Add the Like Box inside
    if ($blogpress_like_box_position == 'bottom' && $blogpress_show_like_box && !$blogpress_like_box_outside) $blogpress_content .= $like_box;
    //End the feed
    $blogpress_content .= '</div><div class="blogpress-clear"></div>';
    //Add the Like Box outside
    if ($blogpress_like_box_position == 'bottom' && $blogpress_show_like_box && $blogpress_like_box_outside) $blogpress_content .= $like_box;
    
    //If the feed is loaded via Ajax then put the scripts into the shortcode itself
    $ajax_theme = $atts['ajax'];
    ( $ajax_theme == 'on' || $ajax_theme == 'true' || $ajax_theme == true ) ? $ajax_theme = true : $ajax_theme = false;
    if( $atts[ 'ajax' ] == 'false' ) $ajax_theme = false;
    if ($ajax_theme) {
        $blogpress_link_hashtags = $atts['linkhashtags'];
        ($blogpress_link_hashtags == 'true' || $blogpress_link_hashtags == 'on') ? $blogpress_link_hashtags = 'true' : $blogpress_link_hashtags = 'false';
        if($blogpress_title_link == 'true' || $blogpress_title_link == 'on') $blogpress_link_hashtags = 'false';
        $blogpress_content .= '<script type="text/javascript">var blogpresslinkhashtags = "' . $blogpress_link_hashtags . '";</script>';
        $blogpress_content .= '<script type="text/javascript" src="' . plugins_url( '/js/blogpress-scripts.js?11' , __FILE__ ) . '"></script>';
    }

    $blogpress_content .= '</div>';

    //Return our feed HTML to display
    return $blogpress_content;
}

//***FUNCTIONS***

//Get JSON object of feed data
function blogpress_fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    //Or else use the WP HTTP API
    } else {
        if( !class_exists( 'WP_Http' ) ) include_once( ABSPATH . WPINC. '/class-http.php' );
        $request = new WP_Http;
        $result = $request->request($url);
        $feedData = $result['body'];
    }
    
    return $feedData;
}

//Make links into span instead when the post text is made clickable
function blogpress_wrap_span($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'blogpress_wrap_span_callback', $text);
}
function blogpress_wrap_span_callback($matches) {
    $max_url_length = 100;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    return "<span class='blogpress-break-word'>$url_short</span>";
}

//2013-04-28T21:06:56+0000
//Time stamp function - used for posts
function blogpress_getdate($original, $date_format, $custom_date) {
    switch ($date_format) {
        
        case '2':
            $print = date_i18n('F jS, g:i a', $original);
            break;
        case '3':
            $print = date_i18n('F jS', $original);
            break;
        case '4':
            $print = date_i18n('D F jS', $original);
            break;
        case '5':
            $print = date_i18n('l F jS', $original);
            break;
        case '6':
            $print = date_i18n('D M jS, Y', $original);
            break;
        case '7':
            $print = date_i18n('l F jS, Y', $original);
            break;
        case '8':
            $print = date_i18n('l F jS, Y - g:i a', $original);
            break;
        case '9':
            $print = date_i18n("l M jS, 'y", $original);
            break;
        case '10':
            $print = date_i18n('m.d.y', $original);
            break;
        case '11':
            $print = date_i18n('m/d/y', $original);
            break;
        case '12':
            $print = date_i18n('d.m.y', $original);
            break;
        case '13':
            $print = date_i18n('d/m/y', $original);
            break;
        default:
            
            $options = get_option('blogpress_style_settings');

            $blogpress_second = isset($options['blogpress_translate_second']) ? $options['blogpress_translate_second'] : '';
            if ( empty($blogpress_second) ) $blogpress_second = 'second';

            $blogpress_seconds = isset($options['blogpress_translate_seconds']) ? $options['blogpress_translate_seconds'] : '';
            if ( empty($blogpress_seconds) ) $blogpress_seconds = 'seconds';

            $blogpress_minute = isset($options['blogpress_translate_minute']) ? $options['blogpress_translate_minute'] : '';
            if ( empty($blogpress_minute) ) $blogpress_minute = 'minute';

            $blogpress_minutes = isset($options['blogpress_translate_minutes']) ? $options['blogpress_translate_minutes'] : '';
            if ( empty($blogpress_minutes) ) $blogpress_minutes = 'minutes';

            $blogpress_hour = isset($options['blogpress_translate_hour']) ? $options['blogpress_translate_hour'] : '';
            if ( empty($blogpress_hour) ) $blogpress_hour = 'hour';

            $blogpress_hours = isset($options['blogpress_translate_hours']) ? $options['blogpress_translate_hours'] : '';
            if ( empty($blogpress_hours) ) $blogpress_hours = 'hours';

            $blogpress_day = isset($options['blogpress_translate_day']) ? $options['blogpress_translate_day'] : '';
            if ( empty($blogpress_day) ) $blogpress_day = 'day';

            $blogpress_days = isset($options['blogpress_translate_days']) ? $options['blogpress_translate_days'] : '';
            if ( empty($blogpress_days) ) $blogpress_days = 'days';

            $blogpress_week = isset($options['blogpress_translate_week']) ? $options['blogpress_translate_week'] : '';
            if ( empty($blogpress_week) ) $blogpress_week = 'week';

            $blogpress_weeks = isset($options['blogpress_translate_weeks']) ? $options['blogpress_translate_weeks'] : '';
            if ( empty($blogpress_weeks) ) $blogpress_weeks = 'weeks';

            $blogpress_month = isset($options['blogpress_translate_month']) ? $options['blogpress_translate_month'] : '';
            if ( empty($blogpress_month) ) $blogpress_month = 'month';

            $blogpress_months = isset($options['blogpress_translate_months']) ? $options['blogpress_translate_months'] : '';
            if ( empty($blogpress_months) ) $blogpress_months = 'months';

            $blogpress_year = isset($options['blogpress_translate_year']) ? $options['blogpress_translate_year'] : '';
            if ( empty($blogpress_year) ) $blogpress_year = 'year';

            $blogpress_years = isset($options['blogpress_translate_years']) ? $options['blogpress_translate_years'] : '';
            if ( empty($blogpress_years) ) $blogpress_years = 'years';

            $blogpress_ago = isset($options['blogpress_translate_ago']) ? $options['blogpress_translate_ago'] : '';
            if ( empty($blogpress_ago) ) $blogpress_ago = 'ago';

            
            $periods = array($blogpress_second, $blogpress_minute, $blogpress_hour, $blogpress_day, $blogpress_week, $blogpress_month, $blogpress_year, "decade");
            $periods_plural = array($blogpress_seconds, $blogpress_minutes, $blogpress_hours, $blogpress_days, $blogpress_weeks, $blogpress_months, $blogpress_years, "decade");

            $lengths = array("60","60","24","7","4.35","12","10");
            $now = time();
            
            // is it future date or past date
            if($now > $original) {    
                $difference = $now - $original;
                $tense = $blogpress_ago;
            } else {
                $difference = $original - $now;
                $tense = $blogpress_ago;
            }
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j] = $periods_plural[$j];
            }
            $print = "$difference $periods[$j] {$tense}";

            break;
        
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }

    return $print;
}
function blogpress_eventdate($original, $date_format, $custom_date) {
    switch ($date_format) {
        
        case '2':
            $print = date_i18n('F jS, g:ia', $original);
            break;
        case '3':
            $print = date_i18n('g:ia - F jS', $original);
            break;
        case '4':
            $print = date_i18n('g:ia, F jS', $original);
            break;
        case '5':
            $print = date_i18n('l F jS - g:ia', $original);
            break;
        case '6':
            $print = date_i18n('D M jS, Y, g:iA', $original);
            break;
        case '7':
            $print = date_i18n('l F jS, Y, g:iA', $original);
            break;
        case '8':
            $print = date_i18n('l F jS, Y - g:ia', $original);
            break;
        case '9':
            $print = date_i18n("l M jS, 'y", $original);
            break;
        case '10':
            $print = date_i18n('m.d.y - g:iA', $original);
            break;
        case '11':
            $print = date_i18n('m/d/y, g:ia', $original);
            break;
        case '12':
            $print = date_i18n('d.m.y - g:iA', $original);
            break;
        case '13':
            $print = date_i18n('d/m/y, g:ia', $original);
            break;
        default:
            $print = date_i18n('F j, Y, g:ia', $original);
            break;
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }
    return $print;
}
//Time stamp function - used for comments
function blogpress_timesince($original) {
            
    $options = get_option('blogpress_style_settings');

    $blogpress_second = isset($options['blogpress_translate_second']) ? $options['blogpress_translate_second'] : '';
    if ( empty($blogpress_second) ) $blogpress_second = 'second';

    $blogpress_seconds = isset($options['blogpress_translate_seconds']) ? $options['blogpress_translate_seconds'] : '';
    if ( empty($blogpress_seconds) ) $blogpress_seconds = 'seconds';

    $blogpress_minute = isset($options['blogpress_translate_minute']) ? $options['blogpress_translate_minute'] : '';
    if ( empty($blogpress_minute) ) $blogpress_minute = 'minute';

    $blogpress_minutes = isset($options['blogpress_translate_minutes']) ? $options['blogpress_translate_minutes'] : '';
    if ( empty($blogpress_minutes) ) $blogpress_minutes = 'minutes';

    $blogpress_hour = isset($options['blogpress_translate_hour']) ? $options['blogpress_translate_hour'] : '';
    if ( empty($blogpress_hour) ) $blogpress_hour = 'hour';

    $blogpress_hours = isset($options['blogpress_translate_hours']) ? $options['blogpress_translate_hours'] : '';
    if ( empty($blogpress_hours) ) $blogpress_hours = 'hours';

    $blogpress_day = isset($options['blogpress_translate_day']) ? $options['blogpress_translate_day'] : '';
    if ( empty($blogpress_day) ) $blogpress_day = 'day';

    $blogpress_days = isset($options['blogpress_translate_days']) ? $options['blogpress_translate_days'] : '';
    if ( empty($blogpress_days) ) $blogpress_days = 'days';

    $blogpress_week = isset($options['blogpress_translate_week']) ? $options['blogpress_translate_week'] : '';
    if ( empty($blogpress_week) ) $blogpress_week = 'week';

    $blogpress_weeks = isset($options['blogpress_translate_weeks']) ? $options['blogpress_translate_weeks'] : '';
    if ( empty($blogpress_weeks) ) $blogpress_weeks = 'weeks';

    $blogpress_month = isset($options['blogpress_translate_month']) ? $options['blogpress_translate_month'] : '';
    if ( empty($blogpress_month) ) $blogpress_month = 'month';

    $blogpress_months = isset($options['blogpress_translate_months']) ? $options['blogpress_translate_months'] : '';
    if ( empty($blogpress_months) ) $blogpress_months = 'months';

    $blogpress_year = isset($options['blogpress_translate_year']) ? $options['blogpress_translate_year'] : '';
    if ( empty($blogpress_year) ) $blogpress_year = 'year';

    $blogpress_years = isset($options['blogpress_translate_years']) ? $options['blogpress_translate_years'] : '';
    if ( empty($blogpress_years) ) $blogpress_years = 'years';

    $blogpress_ago = isset($options['blogpress_translate_ago']) ? $options['blogpress_translate_ago'] : '';
    if ( empty($blogpress_ago) ) $blogpress_ago = 'ago';

    
    $periods = array($blogpress_second, $blogpress_minute, $blogpress_hour, $blogpress_day, $blogpress_week, $blogpress_month, $blogpress_year, "decade");
    $periods_plural = array($blogpress_seconds, $blogpress_minutes, $blogpress_hours, $blogpress_days, $blogpress_weeks, $blogpress_months, $blogpress_years, "decade");

    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    
    // is it future date or past date
    if($now > $original) {    
        $difference = $now - $original;
        $tense = $blogpress_ago;
    } else {
        $difference = $original - $now;
        $tense = $blogpress_ago;
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j] = $periods_plural[$j];
    }
    return "$difference $periods[$j] {$tense}";
            
}
//Use custom stripos function if it's not available (only available in PHP 5+)
if(!is_callable('stripos')){
    function stripos($haystack, $needle){
        return strpos($haystack, stristr( $haystack, $needle ));
    }
}
function blogpress_stripos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, ltrim($what) ))!==false) return $pos;
    }
    return false;
}
function blogpress_mb_substr_replace($string, $replacement, $start, $length=NULL) {
    if (is_array($string)) {
        $num = count($string);
        // $replacement
        $replacement = is_array($replacement) ? array_slice($replacement, 0, $num) : array_pad(array($replacement), $num, $replacement);
        // $start
        if (is_array($start)) {
            $start = array_slice($start, 0, $num);
            foreach ($start as $key => $value)
                $start[$key] = is_int($value) ? $value : 0;
        }
        else {
            $start = array_pad(array($start), $num, $start);
        }
        // $length
        if (!isset($length)) {
            $length = array_fill(0, $num, 0);
        }
        elseif (is_array($length)) {
            $length = array_slice($length, 0, $num);
            foreach ($length as $key => $value)
                $length[$key] = isset($value) ? (is_int($value) ? $value : $num) : 0;
        }
        else {
            $length = array_pad(array($length), $num, $length);
        }
        // Recursive call
        return array_map(__FUNCTION__, $string, $replacement, $start, $length);
    }
    preg_match_all('/./us', (string)$string, $smatches);
    preg_match_all('/./us', (string)$replacement, $rmatches);
    if ($length === NULL) $length = mb_strlen($string);
    array_splice($smatches[0], $start, $length, $rmatches[0]);
    return join($smatches[0]);
}

//Push to assoc array
function blogpress_array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
}
//Convert string to slug
function blogpress_to_slug($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop', 99 );


//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

//Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'blogpress_add_my_stylesheet' );
function blogpress_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'blogpress', plugins_url('css/blogpress-style.css?8', __FILE__) );
    wp_enqueue_style( 'blogpress' );
    wp_enqueue_style( 'blogpress-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}
//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'blogpress_scripts_method' );
function blogpress_scripts_method() {
    //Register the script to make it available
    wp_register_script( 'blogpressscripts', plugins_url( '/js/blogpress-scripts.js?7' , __FILE__ ), array('jquery'), '1.9', true );
    //Enqueue it to load it onto the page
    wp_enqueue_script('blogpressscripts');
}

function blogpress_activate() {
    $options = get_option('blogpress_style_settings');
    $options[ 'blogpress_show_links_type' ] = true;
    $options[ 'blogpress_show_event_type' ] = true;
    $options[ 'blogpress_show_video_type' ] = true;
    $options[ 'blogpress_show_photos_type' ] = true;
    $options[ 'blogpress_show_status_type' ] = true;
    $options[ 'blogpress_show_author' ] = true;
    $options[ 'blogpress_show_text' ] = true;
    $options[ 'blogpress_show_desc' ] = true;
    $options[ 'blogpress_show_shared_links' ] = true;
    $options[ 'blogpress_show_date' ] = true;
    $options[ 'blogpress_show_media' ] = true;
    $options[ 'blogpress_show_event_title' ] = true;
    $options[ 'blogpress_show_event_details' ] = true;
    $options[ 'blogpress_show_meta' ] = true;
    $options[ 'blogpress_show_link' ] = true;
    $options[ 'blogpress_show_like_box' ] = true;
    update_option( 'blogpress_style_settings', $options );

    get_option('blogpress_show_access_token');
    update_option( 'blogpress_show_access_token', false );
}
register_activation_hook( __FILE__, 'blogpress_activate' );
//Uninstall
function blogpress_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;

    //If the user is preserving the settings then don't delete them
    $blogpress_preserve_settings = get_option('blogpress_preserve_settings');
    if($blogpress_preserve_settings) return;

    //Settings
    delete_option( 'blogpress_show_access_token' );
    delete_option( 'blogpress_access_token' );
    delete_option( 'blogpress_page_id' );
    delete_option( 'blogpress_num_show' );
    delete_option( 'blogpress_post_limit' );
    delete_option( 'blogpress_show_others' );
    delete_option('blogpress_cache_time');
    delete_option('blogpress_cache_time_unit');
    delete_option( 'blogpress_locale' );
    delete_option( 'blogpress_ajax' );
    delete_option( 'blogpress_preserve_settings' );
    //Style & Layout
    delete_option( 'blogpress_title_length' );
    delete_option( 'blogpress_body_length' );
    delete_option('blogpress_style_settings');
}
register_uninstall_hook( __FILE__, 'blogpress_uninstall' );
add_action( 'wp_head', 'blogpress_custom_css' );
function blogpress_custom_css() {
    $options = get_option('blogpress_style_settings');
    isset($options[ 'blogpress_custom_css' ]) ? $blogpress_custom_css = $options[ 'blogpress_custom_css' ] : $blogpress_custom_css = '';

    if( !empty($blogpress_custom_css) ) echo "\r\n";
    if( !empty($blogpress_custom_css) ) echo '<!-- Custom Facebook Feed Custom CSS -->';
    if( !empty($blogpress_custom_css) ) echo "\r\n";
    if( !empty($blogpress_custom_css) ) echo '<style type="text/css">';
    if( !empty($blogpress_custom_css) ) echo "\r\n";
    if( !empty($blogpress_custom_css) ) echo stripslashes($blogpress_custom_css);
    if( !empty($blogpress_custom_css) ) echo "\r\n";
    if( !empty($blogpress_custom_css) ) echo '</style>';
    if( !empty($blogpress_custom_css) ) echo "\r\n";
}
add_action( 'wp_footer', 'blogpress_js' );
function blogpress_js() {
    $options = get_option('blogpress_style_settings');
    $blogpress_custom_js = isset($options[ 'blogpress_custom_js' ]) ? $options[ 'blogpress_custom_js' ] : '';

    //Link hashtags?
    isset($options[ 'blogpress_link_hashtags' ]) ? $blogpress_link_hashtags = $options[ 'blogpress_link_hashtags' ] : $blogpress_link_hashtags = 'true';
    ($blogpress_link_hashtags == 'true' || $blogpress_link_hashtags == 'on') ? $blogpress_link_hashtags = 'true' : $blogpress_link_hashtags = 'false';

    //If linking the post text then don't link the hashtags
    isset($options[ 'blogpress_title_link' ]) ? $blogpress_title_link = $options[ 'blogpress_title_link' ] : $blogpress_title_link = false;
    ($blogpress_title_link == 'true' || $blogpress_title_link == 'on') ? $blogpress_title_link = true : $blogpress_title_link = false;
    if ($blogpress_title_link) $blogpress_link_hashtags = 'false';

    
    echo '<!-- Custom Facebook Feed JS -->';
    echo "\r\n";
    echo '<script type="text/javascript">';
    echo "\r\n";
    echo 'var blogpresslinkhashtags = "' . $blogpress_link_hashtags . '";';
    echo "\r\n";
    if( !empty($blogpress_custom_js) ) echo "jQuery( document ).ready(function($) {";
    if( !empty($blogpress_custom_js) ) echo "\r\n";
    if( !empty($blogpress_custom_js) ) echo stripslashes($blogpress_custom_js);
    if( !empty($blogpress_custom_js) ) echo "\r\n";
    if( !empty($blogpress_custom_js) ) echo "});";
    if( !empty($blogpress_custom_js) ) echo "\r\n";
    echo '</script>';
    echo "\r\n";
}



//AUTOLINK
$GLOBALS['autolink_options'] = array(

    # Should http:// be visibly stripped from the front
    # of URLs?
    'strip_protocols' => true,

);

####################################################################

function blogpress_autolink($text, $link_color='', $span_tag = false, $limit=100, $tagfill='class="blogpress-break-word"', $auto_title = true){

    $text = blogpress_autolink_do($text, $link_color, '![a-z][a-z-]+://!i',    $limit, $tagfill, $auto_title, $span_tag);
    $text = blogpress_autolink_do($text, $link_color, '!(mailto|skype):!i',    $limit, $tagfill, $auto_title, $span_tag);
    $text = blogpress_autolink_do($text, $link_color, '!www\\.!i',         $limit, $tagfill, $auto_title, 'http://', $span_tag);
    return $text;
}

####################################################################

function blogpress_autolink_do($text, $link_color, $sub, $limit, $tagfill, $auto_title, $span_tag, $force_prefix=null){

    $text_l = StrToLower($text);
    $cursor = 0;
    $loop = 1;
    $buffer = '';

    while (($cursor < strlen($text)) && $loop){

        $ok = 1;
        $matched = preg_match($sub, $text_l, $m, PREG_OFFSET_CAPTURE, $cursor);

        if (!$matched){

            $loop = 0;
            $ok = 0;

        }else{

            $pos = $m[0][1];
            $sub_len = strlen($m[0][0]);

            $pre_hit = substr($text, $cursor, $pos-$cursor);
            $hit = substr($text, $pos, $sub_len);
            $pre = substr($text, 0, $pos);
            $post = substr($text, $pos + $sub_len);

            $fail_text = $pre_hit.$hit;
            $fail_len = strlen($fail_text);

            #
            # substring found - first check to see if we're inside a link tag already...
            #

            $bits = preg_split("!</a>!i", $pre);
            $last_bit = array_pop($bits);
            if (preg_match("!<a\s!i", $last_bit)){

                #echo "fail 1 at $cursor<br />\n";

                $ok = 0;
                $cursor += $fail_len;
                $buffer .= $fail_text;
            }
        }

        #
        # looks like a nice spot to autolink from - check the pre
        # to see if there was whitespace before this match
        #

        if ($ok){

            if ($pre){
                if (!preg_match('![\s\(\[\{>]$!s', $pre)){

                    #echo "fail 2 at $cursor ($pre)<br />\n";

                    $ok = 0;
                    $cursor += $fail_len;
                    $buffer .= $fail_text;
                }
            }
        }

        #
        # we want to autolink here - find the extent of the url
        #

        if ($ok){
            if (preg_match('/^([a-z0-9\-\.\/\-_%~!?=,:;&+*#@\(\)\$]+)/i', $post, $matches)){

                $url = $hit.$matches[1];

                $cursor += strlen($url) + strlen($pre_hit);
                $buffer .= $pre_hit;

                $url = html_entity_decode($url);


                #
                # remove trailing punctuation from url
                #

                while (preg_match('|[.,!;:?]$|', $url)){
                    $url = substr($url, 0, strlen($url)-1);
                    $cursor--;
                }
                foreach (array('()', '[]', '{}') as $pair){
                    $o = substr($pair, 0, 1);
                    $c = substr($pair, 1, 1);
                    if (preg_match("!^(\\$c|^)[^\\$o]+\\$c$!", $url)){
                        $url = substr($url, 0, strlen($url)-1);
                        $cursor--;
                    }
                }


                #
                # nice-i-fy url here
                #

                $link_url = $url;
                $display_url = $url;

                if ($force_prefix) $link_url = $force_prefix.$link_url;

                if ($GLOBALS['autolink_options']['strip_protocols']){
                    if (preg_match('!^(http|https)://!i', $display_url, $m)){

                        $display_url = substr($display_url, strlen($m[1])+3);
                    }
                }

                $display_url = blogpress_autolink_label($display_url, $limit);


                #
                # add the url
                #
                
                if ($display_url != $link_url && !preg_match('@title=@msi',$tagfill) && $auto_title) {

                    $display_quoted = preg_quote($display_url, '!');

                    if (!preg_match("!^(http|https)://{$display_quoted}$!i", $link_url)){

                        $tagfill .= ' title="'.$link_url.'"';
                    }
                }

                $link_url_enc = HtmlSpecialChars($link_url);
                $display_url_enc = HtmlSpecialChars($display_url);

                
                if( substr( $link_url_enc, 0, 4 ) !== "http" ) $link_url_enc = 'http://' . $link_url_enc;
                $buffer .= "<a target='_blank' style='color: #".$link_color."' href=\"{$link_url_enc}\"$tagfill>{$display_url_enc}</a>";
                
            
            }else{
                #echo "fail 3 at $cursor<br />\n";

                $ok = 0;
                $cursor += $fail_len;
                $buffer .= $fail_text;
            }
        }

    }

    #
    # add everything from the cursor to the end onto the buffer.
    #

    $buffer .= substr($text, $cursor);

    return $buffer;
}

####################################################################

function blogpress_autolink_label($text, $limit){

    if (!$limit){ return $text; }

    if (strlen($text) > $limit){
        return substr($text, 0, $limit-3).'...';
    }

    return $text;
}

####################################################################

function blogpress_autolink_email($text, $tagfill=''){

    $atom = '[^()<>@,;:\\\\".\\[\\]\\x00-\\x20\\x7f]+'; # from RFC822

    #die($atom);

    $text_l = StrToLower($text);
    $cursor = 0;
    $loop = 1;
    $buffer = '';

    while(($cursor < strlen($text)) && $loop){

        #
        # find an '@' symbol
        #

        $ok = 1;
        $pos = strpos($text_l, '@', $cursor);

        if ($pos === false){

            $loop = 0;
            $ok = 0;

        }else{

            $pre = substr($text, $cursor, $pos-$cursor);
            $hit = substr($text, $pos, 1);
            $post = substr($text, $pos + 1);

            $fail_text = $pre.$hit;
            $fail_len = strlen($fail_text);

            #die("$pre::$hit::$post::$fail_text");

            #
            # substring found - first check to see if we're inside a link tag already...
            #

            $bits = preg_split("!</a>!i", $pre);
            $last_bit = array_pop($bits);
            if (preg_match("!<a\s!i", $last_bit)){

                #echo "fail 1 at $cursor<br />\n";

                $ok = 0;
                $cursor += $fail_len;
                $buffer .= $fail_text;
            }
        }

        #
        # check backwards
        #

        if ($ok){
            if (preg_match("!($atom(\.$atom)*)\$!", $pre, $matches)){

                # move matched part of address into $hit

                $len = strlen($matches[1]);
                $plen = strlen($pre);

                $hit = substr($pre, $plen-$len).$hit;
                $pre = substr($pre, 0, $plen-$len);

            }else{

                #echo "fail 2 at $cursor ($pre)<br />\n";

                $ok = 0;
                $cursor += $fail_len;
                $buffer .= $fail_text;
            }
        }

        #
        # check forwards
        #

        if ($ok){
            if (preg_match("!^($atom(\.$atom)*)!", $post, $matches)){

                # move matched part of address into $hit

                $len = strlen($matches[1]);

                $hit .= substr($post, 0, $len);
                $post = substr($post, $len);

            }else{
                #echo "fail 3 at $cursor ($post)<br />\n";

                $ok = 0;
                $cursor += $fail_len;
                $buffer .= $fail_text;
            }
        }

        #
        # commit
        #

        if ($ok) {

            $cursor += strlen($pre) + strlen($hit);
            $buffer .= $pre;
            $buffer .= "<a href=\"mailto:$hit\"$tagfill>$hit</a>";

        }

    }

    #
    # add everything from the cursor to the end onto the buffer.
    #

    $buffer .= substr($text, $cursor);

    return $buffer;
}

####################################################################


//Comment out the line below to view errors
//error_reporting(0);
?>
