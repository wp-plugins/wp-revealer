<?php
/*
Plugin Name: WP Revealer
Plugin URI: http://www.pluginresults.com/free/wprevealer
Description: The WP Revealer plugin is the Magic Button for WordPress.  Create a timed release content on any page or post by closing the text within a shortcode. [reveal-after-delay x = minutes.seconds] PLACE YOUR CONTENT , IMAGES or VIDEOS[/reveal-after-delay].
Author: Process Driven Results Inc.
Version: 1.0
Author URI: http://www.pluginresults.com
License: GPLv2 or later

*/

define("START_TIME", "0.0");

if(!class_exists('wpRevealer')) {

  class wpRevealer {

    /**
    * PHP 4 Compatible Constructor.
    */
    function wpRevealer() {
      $this->__construct();
    }

    function __construct() {
      add_shortcode( 'reveal-after-delay', array(&$this, 'handleShortcode') );
      add_action('init', array(&$this, 'getHeader'));
    }
    
    function getHeader() {
      wp_register_script( 'revelerScript', plugins_url('/js/content_revealer.js', __FILE__)); 
      wp_enqueue_script('jquery');
      wp_enqueue_script('revelerScript');
    }

    function handleShortcode($atts, $content = null) {
      $time = isset($atts['x']) ? $atts['x'] : START_TIME;
      $time_array = explode('.', $time);
      if(!empty($time_array)){
	$mins = intval($time_array[0]);
	$secs = intval($time_array[1]);
	$time = ($mins * 60) + ($secs);
      }
      return "<div id='" .uniqid('wpr_'). "' class='reveal' rel='".$time."' style='display:none' >".$content."</div>";
    }

  }/*wpRevealer class ends*/

}/* class_exists condition ends */

  if(class_exists('wpRevealer')) {
    $wpRevealer = new wpRevealer();
  }

?>
