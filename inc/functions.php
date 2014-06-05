<?php
//--codigo jquery mobile
function active_jqm() {
wp_enqueue_script(
 'jqm_js',
 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js',
 array('jquery'),
 '1.2.0'
 );

wp_register_style(
 'jqm_css',
 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css',
 '',
 '1.2.0'
 );
wp_enqueue_style(
 'jqm_css',
 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css',
 '',
 '1.2.0'
 );
 }
 add_action('wp_enqueue_scripts', 'get_jqm');
?>
