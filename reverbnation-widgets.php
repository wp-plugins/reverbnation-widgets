<?php
/*
  Plugin Name: ReverbNation Widgets
  Plugin URI: http://www.reverbnation.com
  Description: Display ReverbNation widgets on your blog.
  Version: 0.1
  Author: ReverbNation
  Author URI: http://www.reverbnation.com
  License: As-Is
*/

// Development:
define("RN_WIDGETS_CACHE_SERVER", 'http://192.168.0.148:10148');
define("RN_WIDGETS_WEB_SERVER", 'http://192.168.0.148:10148');
define("RN_WIDGETS_AUDIOLIFE_CACHE_SERVER", 'http://cache.audiolifeqa.com/');
define("RN_WIDGETS_AUDIOLIFE_WEB_SERVER", 'http://ws.audiolifeva.com/');

// Autobuild / Tunehive:
// define("RN_WIDGETS_CACHE_SERVER", 'http://cache.tunehive.com');
// define("RN_WIDGETS_WEB_SERVER", 'http://www.tunehive.com:83');
// define("RN_WIDGETS_AUDIOLIFE_CACHE_SERVER", 'http://cache.audiolifeqa.com/');
// define("RN_WIDGETS_AUDIOLIFE_WEB_SERVER", 'http://ws.audiolifeva.com/');

// Production:
// define("RN_WIDGETS_CACHE_SERVER", 'http://cache.reverbnation.com');
// define("RN_WIDGETS_WEB_SERVER", 'http://www.reverbnation.com');
// define("RN_WIDGETS_AUDIOLIFE_CACHE_SERVER", 'http://cache.audiolife.com//');
// define("RN_WIDGETS_AUDIOLIFE_WEB_SERVER", 'http://ws.audiolife.com/');

// helper functions...

function rn_widgets_quantcast_tracking_code() {
  return '<a href="http://www.quantcast.com/p-05---xoNhTXVc" target="_blank"><img src="http://pixel.quantserve.com/pixel/p-05---xoNhTXVc.gif" style="display: none" border="0" height="1" width="1" alt="Quantcast"/></a>';
}

function rn_widgets_footer_link($widget, $page_object, $posted_by, $width, $height) {
  list($pot, $poid) = explode('_', $page_object);
  list($pat, $paid) = explode('_', $posted_by);
  $pot = ucfirst($pot); $pat = ucfirst($pat);
  return "<a href=\"" . RN_WIDGETS_WEB_SERVER . "/fanreachpro\" onclick=\"javascript:window.location.href=&quot;" . RN_WIDGETS_WEB_SERVER . "/c./a4/{$widget}/{$poid}/{$pot}/{$paid}/{$pat}/link&quot;; return false;\"><img alt=\"Band email marketing\" border=\"0\" height=\"{$height}\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/content/{$widget}/footer.png\" width=\"{$width}\" /></a>";
}

function rn_widgets_tracking_pixel($widget, $page_object, $posted_by) {
  return "<img style=\"visibility:hidden;width:0px;height:0px;\" border=\"0\" width=\"0\" height=\"0\" src=\"" . RN_WIDGETS_WEB_SERVER . "/widgets/trk/{$widget}/{$page_object}/{$posted_by}/t.gif\"/>";
}

function rn_widgets_top_link($page_object, $width, $height) {
  // This really should go to the page object homepage, but we don't know the 
  // homepage, only the ID.  We could link to the homepage by ID, but that 
  // might poison Google.
  return "<a href=\"" . RN_WIDGETS_WEB_SERVER . "/main/widgets_overview\"><img alt=\"Blank\" height=\"{$height}}\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/images/blank.gif\" style=\"border:none !important;position:absolute;top:0;left:0;width:300px;height:26px;\" width=\"{$width}\" /></a>";
}

function rn_widgets_bottom_link($widget, $page_object, $posted_by, $width, $height) {
  list($pot, $poid) = explode('_', $page_object);
  list($pat, $paid) = explode('_', $posted_by);
  $pot = ucfirst($pot); $pat = ucfirst($pat);
  return "<a href=\"" . RN_WIDGETS_WEB_SERVER . "/main/widgets_overview\" onclick=\"javascript:window.location.href=&quot;" . RN_WIDGETS_WEB_SERVER . "/c./a4/{$widget}/{$poid}/{$pot}/{$paid}/{$pat}/link&quot;; return false;\"><img alt=\"standalone player\" height=\"{$height}\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/images/blank.gif\" style=\"border:none !important;position:absolute;bottom:0px;left:0;width:{$width}px;height:{$height}px;\" width=\"{$width}\" /></a>";
}

function rn_widgets_redefault_value($atts, $key, $new_default) {
  if ($atts[$key]) {
    return $atts[$key];
  } else {
    return $new_default;
  }
}

function rn_widgets_need_page_object($page_objects) {
  foreach ($page_objects as $po) {
    if (preg_match("/^([a-z]+)_([0-9]+)$/", $po, $matches)) {
      if (($matches[1] == 'artist' || $matches[1] == 'label' || 
           $matches[1] == 'venue' || $matches[1] == 'fan') &&
          intval($matches[2]) > 0) {
        return $po;
      }
    }
  }
  return 'user_0';
}

// The widgets themselves...

function rn_widgets_get_artist_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view) {
  $url_params = http_build_query(array('bandId' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundColor' => $bgcolor, 
                                       'font_color' => $fontcolor, 
                                       'posted_by' => $posted_by,
                                       'view' => $view));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/10/schedule.swf?{$url_params}\" height=\"247\" width=\"434\" />";
  $footer = rn_widgets_footer_link(10, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(10, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_fan_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor, $streetteam) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'hide_street_team' => $streetteam == 'true' ? 'false' : 'true'));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/11/fancollector.swf?{$url_params}\" height=\"100\" width=\"434\" />";
  $footer = rn_widgets_footer_link(11, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(11, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_artist_shows_map_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view) {
  $url_params = http_build_query(array('bandId' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundColor' => $bgcolor, 
                                       'font_color' => $fontcolor, 
                                       'posted_by' => $posted_by,
                                       'view' => $view));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/12/schedule.swf?{$url_params}\" height=\"538\" width=\"434\" />";
  $footer = rn_widgets_footer_link(12, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(12, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_mini_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay) {
  $url_params = http_build_query(array('emailPlaylist' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor, 
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'shuffle' => $shuffle, 
                                       'autoPlay' => $autoplay));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/13/widgetPlayerMini.swf?{$url_params}\" height=\"83\" width=\"262\" />";
  $footer = rn_widgets_footer_link(13, $page_object, $posted_by, 262, 12);
  $tracking_image = rn_widgets_tracking_pixel(13, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_venue_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('venueId' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor, 
                                       'font_color' => $fontcolor, 
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/14/venue_schedule.swf?{$url_params}\" height=\"600\" width=\"434\" />";
  $footer = rn_widgets_footer_link(14, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(14, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay) {
  $url_params = http_build_query(array('emailPlaylist' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor, 
                                       'font_color' => $fontcolor,
                                       'shuffle' => $shuffle, 
                                       'autoPlay' => $autoplay,
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/15/widgetPlayer.swf?{$url_params}\" height=\"228\" width=\"434\" />";
  $footer = rn_widgets_footer_link(15, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(15, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_tunewidget($page_object, $posted_by, $shuffle, $autoplay, $blogbuzz) {
  $url_params = http_build_query(array('twID' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'shuffle' => $shuffle, 
                                       'autoPlay' => $autoplay,
                                       'blogBuzz' => $blogbuzz,
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/19/tuneWidget.swf?{$url_params}\" height=\"415\" width=\"434\" />";
  $footer = rn_widgets_footer_link(19, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(19, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_grab_box_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('page_object_id' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor, 
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"http://cache.tunehive.com/widgets/swf/25/grab_box.swf?page_object_id=artist_3193&webServer=http%3A%2F%2Fwww.tunehive.com%3A83&backgroundcolor=EEEEEE&font_color=000000&posted_by=fan_3\" height=\"300\" width=\"300\" wmode=\"opaque\"/>";
  $tracking_image = rn_widgets_tracking_pixel(25, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  $top_link = rn_widgets_top_link($page_object, 300, 26);
  $bottom_link = rn_widgets_bottom_link(25, $page_object, $posted_by, 300, 16);
  return "<div style=\"position:relative\">" . $embed . "<br/>" . $tracking_image . $quantcast . $top_link . $bottom_link . "</div>";
}

function rn_widgets_get_local_charts_widget($title, $subtitle, $bgcolor, $fontcolor, $posted_by, $latitude, $longitude, $distance, $genres) {
  $url_params = http_build_query(array('w' => '0',
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'title' => $title,
                                       'subtitle' => $subtitle,
                                       'background_color' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'latitude' => $latitude,
                                       'longitude' => $longitude,
                                       'distance' => $distance,
                                       'genres' => $genres));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/27/localcharts_v1xx.swf?{$url_params}\" height=\"285\" width=\"434\" wmode=\"opaque\"/>";
  $tracking_image = rn_widgets_tracking_pixel(27, 'main_0', $posted_by);
  return "<div style=\"position:relative\">" . $embed . "<br/>" . $tracking_image . "</div>";
}

function rn_widgets_get_blog_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay) {
  $url_params = http_build_query(array('emailPlaylist' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'shuffle' => $shuffle,
                                       'autoPlay' => $autoplay));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"http://localhost:10148/widgets/swf/28/blog_player.swf?{$url_params}\" height=\"300\" width=\"180\"/>";
  $footer = rn_widgets_footer_link(28, $page_object, $posted_by, 180, 12);
  $tracking_image = rn_widgets_tracking_pixel(28, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . "<br/>" . $footer . "<br/>" . $tracking_image . $quantcast;
}

function rn_widgets_get_blog_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view) {
  $url_params = http_build_query(array('bandId' => $page_object, 
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor, 
                                       'font_color' => $fontcolor, 
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/29/schedule.swf?{$url_params}\" height=\"300\" width=\"180\" />";
  $footer = rn_widgets_footer_link(29, $page_object, $posted_by, 180, 12);
  $tracking_image = rn_widgets_tracking_pixel(29, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_blog_fan_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/30/fancollector.swf?{$url_params}\" height=\"180\" width=\"180\" />";
  $footer = rn_widgets_footer_link(30, $page_object, $posted_by, 180, 12);
  $tracking_image = rn_widgets_tracking_pixel(30, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_micro_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay) {
  $url_params = http_build_query(array('emailPlaylist' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'shuffle' => $shuffle,
                                       'autoPlay' => $autoplay));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/31/widgetPlayerMicro.swf?{$url_params}\" height=\"125\" width=\"160\" wmode=\"transparent\"/>";
  $tracking_image = rn_widgets_tracking_pixel(31, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . "<br/>" . $tracking_image . $quantcast;
}

function rn_widgets_get_press_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/32/press.swf?{$url_params}\" height=\"110\" width=\"434\" wmode=\"transparent\"/>";
  $tracking_image = rn_widgets_tracking_pixel(32, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking_image;
}

function rn_widgets_get_video_gallery_widget($page_object, $posted_by, $bgcolor, $fontcolor, $autoplay) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'autoPlay' => $autoplay));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/33/video_gallery_widget.swf?{$url_params}\" height=\"374\" width=\"332\" />";
  $footer = rn_widgets_footer_link(33, $page_object, $posted_by, 332, 19);
  $tracking = rn_widgets_tracking_pixel(33, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . "<br/>" . $footer . "<br/>"  . $tracking . $quantcast;
}

function rn_widgets_get_street_team_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'backgroundcolor' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'street_team' => 'true'));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/11/fancollector.swf?{$url_params}\" height=\"100\" width=\"434\" />";
  $footer = rn_widgets_footer_link(11, $page_object, $posted_by, 434, 19);
  $tracking_image = rn_widgets_tracking_pixel(11, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();
  return $embed . '<br/>' . $footer . '<br/>' . $tracking_image . $quantcast;
}

function rn_widgets_get_fan_exclusive_widget($page_object, $posted_by, $bgcolor, $fontcolor) {
  $url_params = http_build_query(array('page_object_id' => $page_object,
                                       'webServer' => RN_WIDGETS_WEB_SERVER,
                                       'border_color' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'posted_by' => $posted_by,
                                       'default_song' => ''));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/36/fanexclusive_v1xx.swf?{$url_params}\" height=\"130\" width=\"180\" wmode=\"opaque\"/>";
  $tracking = rn_widgets_tracking_pixel(36, $page_object, $posted_by);
  $top_link = rn_widgets_top_link($page_object, 180, 15);
  $bottom_link = rn_widgets_bottom_link(36, $page_object, $posted_by, 180, 12);
  return "<div style=\"position:relative\">" . $embed . "<br/>" . $tracking . $top_link . $bottom_link . "</div>";
}

function rn_widgets_get_store_widget($page_object, $posted_by, $store_id, $width, $height) {
  $widget_flash_vars = http_build_query(array('r' => 'a',
                                              'userId' => $store_id,
                                              'swfpath' => RN_WIDGETS_AUDIOLIFE_CACHE_SERVER . 'Widget/',
                                              'wsBasePath' => RN_WIDGETS_AUDIOLIFE_WEB_SERVER . 'Webservices/',
                                              'publicFSBasePath' => RN_WIDGETS_AUDIOLIFE_CACHE_SERVER . 'PublicFS/',
                                              'widgettype' => 'reverbnation'));
  $track_image_url = RN_WIDGETS_WEB_SERVER . '/widgets/trk/38/{$page_object}/{$posted_by}/t.gif';
  
  $open_object = "<object width=\"{$width}\" height=\"{$height}\">";
  $param_movie = "<param name=\"movie\" value=\"" . RN_WIDGETS_AUDIOLIFE_WEB_SERVER . "Webservices/GetWidget.aspx?{$widget_flash_vars}";
  $param_fs = "<param name=\"allowFullScreen\" value=\"true\"></param>";
  $param_flashv = "<param name=\"FlashVars\" value=\"{$widget_flash_vars}&track_img={$track_image_url}";
  $param_asa = "<param name=\"allowScriptAccess\" value=\"always\"></param>";
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_AUDIOLIFE_WEB_SERVER . "Webservices/GetWidget.aspx?{$widget_flash_vars}&posted_by={$posted_by}\" allowfullscreen=\"true\" allowScriptAccess=\"always\" FlashVars=\"{$widget_flash_vars}&track_img={$track_image_url}\" height=\"{$height}\" width=\"{$width}\" wmode=\"opaque\"/>";
  $close_object = "</object>";
  $track_image = rn_widgets_tracking_pixel(38, $page_object, $posted_by);
  $quantcast = rn_widgets_quantcast_tracking_code();

  return "<div style=\"position:relative\">" . 
    $open_object . $param_movie . $param_fs . $param_flashv . $param_asa . $embed . $close_object . "<br/>" . 
    $track_image . $quantcast . "</div>";
}

function rn_widgets_get_pro_player_widget($page_object, $posted_by, $bgcolor, $bordercolor, $skin_id, $width, $height, $autoplay, $shuffle) {
  $flash_vars = http_build_query(array('id' => $page_object,
                                       'web_server' => RN_WIDGETS_WEB_SERVER,
                                       'posted_by' => $posted_by,
                                       'skin_id' => $skin_id,
                                       'background_color' => $bgcolor,
                                       'border_color' => $bordercolor,
                                       'auto_play' => $autoplay,
                                       'shuffle' => $shuffle));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/40/pro_widget.swf\" height=\"{$height}\" width=\"{$width}\" align=\"top\" bgcolor=\"#ffffff\" loop=\"false\" wmode=\"opaque\" quality=\"best\" allowScriptAccess=\"always\" allowNetworking=\"all\" allowFullScreen=\"true\" seamlesstabbing=\"false\" flashvars=\"{$flash_vars}\"/>";
  $tracking = rn_widgets_tracking_pixel(40, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking;
}

function rn_widgets_get_pro_video_player_widget($page_object, $posted_by, $bgcolor, $bordercolor, $skin_id, $width, $height, $autoplay, $shuffle) {
  $flash_vars = http_build_query(array('id' => $page_object,
                                       'web_server' => RN_WIDGETS_WEB_SERVER,
                                       'posted_by' => $posted_by,
                                       'skin_id' => $skin_id,
                                       'background_color' => $bgcolor,
                                       'border_color' => $bordercolor,
                                       'auto_play' => $autoplay,
                                       'shuffle' => $shuffle));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/41/pro_widget.swf\" height=\"{$height}\" width=\"{$width}\" align=\"top\" bgcolor=\"#ffffff\" loop=\"false\" wmode=\"opaque\" quality=\"best\" allowScriptAccess=\"always\" allowNetworking=\"all\" allowFullScreen=\"true\" seamlesstabbing=\"false\" flashvars=\"{$flash_vars}\"/>";
  $tracking = rn_widgets_tracking_pixel(41, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking;
}

function rn_widgets_get_pro_schedule_widget($page_object, $posted_by, $bgcolor, $bordercolor, $show_map, $skin_id, $width, $height) {
  $flash_vars = http_build_query(array('id' => $page_object,
                                       'web_server' => RN_WIDGETS_WEB_SERVER,
                                       'posted_by' => $posted_by,
                                       'skin_id' => $skin_id,
                                       'background_color' => $bgcolor,
                                       'border_color' => $bordercolor,
                                       'show_map' => $show_map));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/42/pro_widget.swf\" height=\"{$height}\" width=\"{$width}\" align=\"top\" bgcolor=\"#ffffff\" loop=\"false\" wmode=\"opaque\" quality=\"best\" allowScriptAccess=\"always\" allowNetworking=\"all\" allowFullScreen=\"true\" seamlesstabbing=\"false\" flashvars=\"{$flash_vars}\"/>";
  $tracking = rn_widgets_tracking_pixel(42, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking;
}

function rn_widgets_get_pro_press_widget($page_object, $posted_by, $bgcolor, $bordercolor, $fontcolor, $skin_id, $width, $height) {
  $flash_vars = http_build_query(array('id' => $page_object,
                                       'web_server' => RN_WIDGETS_WEB_SERVER,
                                       'posted_by' => $posted_by,
                                       'skin_id' => $skin_id,
                                       'background_color' => $bgcolor,
                                       'font_color' => $fontcolor,
                                       'border_color' => $bordercolor));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/43/pro_widget.swf\" height=\"{$height}\" width=\"{$width}\" align=\"top\" bgcolor=\"#ffffff\" loop=\"false\" wmode=\"opaque\" quality=\"best\" allowScriptAccess=\"always\" allowNetworking=\"all\" allowFullScreen=\"true\" seamlesstabbing=\"false\" flashvars=\"{$flash_vars}\"/>";
  $tracking = rn_widgets_tracking_pixel(43, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking;
}

function rn_widgets_get_pro_fan_collector_widget($page_object, $posted_by, $bordercolor, $skin_id, $width, $height, $street_team) {
  $flash_vars = http_build_query(array('id' => $page_object,
                                       'web_server' => RN_WIDGETS_WEB_SERVER,
                                       'posted_by' => $posted_by,
                                       'skin_id' => $skin_id,
                                       'border_color' => $bordercolor,
                                       'street_team' => $street_team));
  $embed = "<embed type=\"application/x-shockwave-flash\" src=\"" . RN_WIDGETS_CACHE_SERVER . "/widgets/swf/44/pro_widget.swf\" height=\"{$height}\" width=\"{$width}\" align=\"top\" bgcolor=\"#ffffff\" loop=\"false\" wmode=\"opaque\" quality=\"best\" allowScriptAccess=\"always\" allowNetworking=\"all\" allowFullScreen=\"true\" seamlesstabbing=\"false\" flashvars=\"{$flash_vars}\"/>";
  $tracking = rn_widgets_tracking_pixel(44, $page_object, $posted_by);
  return $embed . "<br/>" . $tracking;
}

// Wordpress API stuff...

function rn_widgets_shortcode($atts) {
  $defaults = 
    array('widget' => 'player',
          // Page object identification attributes
          // 'artist_id' => '149',  // Scotty and the Reverbs
          // 'label_id' => '2', // Pox World Empire
          // 'venue_id' => '40146', // Detestable Dave's Donut Dive
          // Poster identification attributes
          'poster_id' => '0',
          'poster_type' => 'User',
          // Common attributes
          'bgcolor' => 'EEEEEE',
          'fontcolor' => '000000',
          // Fan Collector attributes
          'street_team' => 'true',
          // Player attributes
          'shuffle' => 'false',
          'autoplay' => 'false',
          // Show list attributes
          'view' => 'smart',
          // TuneWidget attributes
          'blogbuzz' => 'buzz',
          // Local Charts attributes
          'title' => 'Music Charts',
          'subtitle' => '',
          'latitude' => '35.9989014',
          'longitude' => '-78.899063',
          'distance' => '25',
          'genres' => 'all',
          // Store attributes
          'store_id' => '0',
          'width' => '350',
          'height' => '434',
          // Pro widget attributes
          'skin_id' => 'PWAS1003',
          'bordercolor' => '000000',
          'show_map' => 'true');

  extract(shortcode_atts($defaults, $atts));

  $artist = 'artist_' . intval($atts['artist_id']);
  $venue = 'venue_' . intval($atts['venue_id']);
  $label = 'label_' . intval($atts['label_id']);
  $posted_by = rn_widgets_need_page_object(array(strtolower($poster_type) . '_' . intval($poster_id)));

  switch ($widget) {
  case 'artist_show':
  case 'artist_shows':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_artist_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view);
  case 'fan_collector':
    $page_object = rn_widgets_need_page_object(array($artist, $label, $venue));
    return rn_widgets_get_fan_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor, $street_team);
  case 'artist_show_map':
  case 'artist_shows_map':
    $page_object = rn_widgets_need_page_object(array($artist));
    return rn_widgets_get_artist_shows_map_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view);
  case 'mini_player':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_mini_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay);
  case 'venue_shows':
    $page_object = rn_widgets_need_page_object(array($label, $venue));
    return rn_widgets_get_venue_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'player':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay);
  case 'tunewidget':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_tunewidget($page_object, $posted_by, $shuffle, $autoplay, $blogbuzz);
  case 'grab_box':
    $page_object = rn_widgets_need_page_object(array($artist));
    return rn_widgets_get_grab_box_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'local_shows':
    // No local shows :(
  case 'local_charts':
    return rn_widgets_get_local_charts_widget($title, $subtitle, $bgcolor, $fontcolor, $posted_by, $latitude, $longitude, $distance, $genres);
  case 'blog_player':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_blog_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay);
  case 'blog_shows':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_blog_shows_widget($page_object, $posted_by, $bgcolor, $fontcolor, $view);
  case 'blog_fan_collector':
    $page_object = rn_widgets_need_page_object(array($artist, $label, $venue));
    return rn_widgets_get_blog_fan_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'micro_player':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_micro_player_widget($page_object, $posted_by, $bgcolor, $fontcolor, $shuffle, $autoplay);
  case 'press':
    $page_object = rn_widgets_need_page_object(array($artist));
    return rn_widgets_get_press_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'video_gallery':
    $page_object = rn_widgets_need_page_object(array($artist, $label));
    return rn_widgets_get_video_gallery_widget($page_object, $posted_by, $bgcolor, $fontcolor, $autoplay);
  case 'street_team_collector':
    $page_object = rn_widgets_need_page_object(array($artist, $label, $venue));
    return rn_widgets_get_street_team_collector_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'fan_exclusive':
  case 'fan_exclusives':
    $page_object = rn_widgets_need_page_object(array($artist));
    return rn_widgets_get_fan_exclusive_widget($page_object, $posted_by, $bgcolor, $fontcolor);
  case 'store':
    $page_object = rn_widgets_need_page_object(array($artist));
    return rn_widgets_get_store_widget($page_object, $posted_by, $store_id, $width, $height);
  case 'pro_player':
    $page_object = rn_widgets_need_page_object(array($artist));
    $width = rn_widgets_redefault_value($atts, 'width', '262');
    $height = rn_widgets_redefault_value($atts, 'height', '200');
    return rn_widgets_get_pro_player_widget($page_object, $posted_by, $bgcolor, $bordercolor, $skin_id, $width, $height, $autoplay, $shuffle);
  case 'pro_video_player':
    $page_object = rn_widgets_need_page_object(array($artist));
    $width = rn_widgets_redefault_value($atts, 'width', '262');
    $height = rn_widgets_redefault_value($atts, 'height', '200');
    $skin_id = rn_widgets_redefault_value($atts, 'skin_id', 'PWVS2003');
    return rn_widgets_get_pro_video_player_widget($page_object, $posted_by, $bgcolor, $bordercolor, $skin_id, $width, $height, $autoplay, $shuffle);
  case 'pro_schedule':
    $page_object = rn_widgets_need_page_object(array($artist));
    $width = rn_widgets_redefault_value($atts, 'width', '262');
    $height = rn_widgets_redefault_value($atts, 'height', '200');
    $skin_id = rn_widgets_redefault_value($atts, 'skin_id', 'PWSS3003');
    return rn_widgets_get_pro_schedule_widget($page_object, $posted_by, $bgcolor, $bordercolor, $show_map, $skin_id, $width, $height);
  case 'pro_press':
    $page_object = rn_widgets_need_page_object(array($artist));
    $width = rn_widgets_redefault_value($atts, 'width', '262');
    $height = rn_widgets_redefault_value($atts, 'height', '200');
    $skin_id = rn_widgets_redefault_value($atts, 'skin_id', 'PWPS4003');
    return rn_widgets_get_pro_press_widget($page_object, $posted_by, $bgcolor, $bordercolor, $fontcolor, $skin_id, $width, $height);
  case 'pro_fan_collector':
    $page_object = rn_widgets_need_page_object(array($artist));
    $width = rn_widgets_redefault_value($atts, 'width', '262');
    $height = rn_widgets_redefault_value($atts, 'height', '200');
    $skin_id = rn_widgets_redefault_value($atts, 'skin_id', 'PWFS5003');
    $street_team = rn_widgets_redefault_value($atts, 'street_team', 'false');
    return rn_widgets_get_pro_fan_collector_widget($page_object, $posted_by, $bordercolor, $skin_id, $width, $height, $street_team);
  }
  return "(ReverbNation widget \"{$widget}\" could not be displayed)";
}

add_shortcode('reverbnation', 'rn_widgets_shortcode');
?>
