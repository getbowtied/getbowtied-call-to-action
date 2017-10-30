<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// enqueue scripts
add_action('wp_enqueue_scripts', 'getbowtied_get_this_theme_button_styles', 99);
function getbowtied_get_this_theme_button_styles() {
	wp_enqueue_style('getbowtied_get_this_theme_button', plugins_url('/css/styles.css', __FILE__), array(), '1.0', 'all' );
	wp_enqueue_script('getbowtied_buttons', plugins_url('/js/scripts.js', __FILE__), array('jquery'), '1.0', TRUE);
	wp_enqueue_script('getbowtied_buttons_svg', plugins_url('/js/svg.js', __FILE__), array('jquery'), '1.0', FALSE);
}


add_action('wp_footer','getbowtied_get_this_theme_button_output');
function getbowtied_get_this_theme_button_output() {

	global $post, $buttons_number;
	ob_start();

	//if (trim(get_option('button_text')) !== "") {
	
	?>
    
    <a class="getbowtied_get_this_theme" 
    	href="<?php echo get_option('button_link'); ?>" 
    	target="_blank" onclick="_gaq.push(['_trackEvent', '<?php echo get_option('button_event_tracking_identifier'); ?>', 'Purchase', 'Clicked']);">
    	 <span class="purchase-btn">
    	 	<img class="envato-logo svg" src="<?php echo plugins_url('/img/envato-logo.svg', __FILE__); ?>" /> 
    	 	<?php _e('PURCHASE $69 ', 'getbowtied'); ?>
    	 </span>
    	
    </a>
	
	<?php

	//}	
	
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	echo $content;

}