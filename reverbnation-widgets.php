<?php
/*
  Plugin Name: ReverbNation Widgets
  Plugin URI: http://www.reverbnation.com/wordpress-plugin
  Description: Display ReverbNation widgets in posts and on your blog. Widget code should be generated in the Widgets section in your ReverbNation Control Panel. Simply paste the <code>[reverbnation]widget_url_here[/reverbnation]</code> code anywhere on your WordPress blog for instant widget action!
  Version: 2.0
  Author: ReverbNation
  Author URI: http://www.reverbnation.com
  License: As-Is
*/

define('REVERBNATION_WIDGET_URL_PREFIX', 'http://cache.reverbnation.com/widgets/swf/');
define('REVERBNATION_PLUGIN_VERSION', '2.0');

function rn_widgets_shortcode($atts, $url) {
  global $wp_embed;
  
  //make sure it's a valid ReverbNation url
  if(0 !== strpos($url, REVERBNATION_WIDGET_URL_PREFIX))
    return '<strong>Invalid ReverbNation widget url. Your widget code should be pasted exactly as shown in the Widgets section of your account Control Panel.</strong><br/>Example: <code>[reverbnation]widget_url_here[/reverbnation]</code>';
  
  //remove any html entities
  $url = html_entity_decode($url);
  
  //add the wordpress widget version on to the url. this helps for caching such that we can upgrade the plugin when the oembed changes
  $url .= '&wp_plugin_version=' . REVERBNATION_PLUGIN_VERSION;
  
  //finally, return whatever the media autoembed returns
  return $wp_embed->autoembed($url);
}


add_shortcode('reverbnation', 'rn_widgets_shortcode');
wp_oembed_add_provider('#' . REVERBNATION_WIDGET_URL_PREFIX . '([0-9]+)/.*#i', 'http://www.reverbnation.com/oembed', true);