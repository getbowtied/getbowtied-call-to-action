<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// enqueue scripts
add_action('wp_enqueue_scripts', 'getbowtied_get_this_theme_button_styles', 99);
function getbowtied_get_this_theme_button_styles() {
	wp_enqueue_style('getbowtied_get_this_theme_button', plugins_url('/css/styles.css', __FILE__), array(), '1.0', 'all' );
	wp_enqueue_script('getbowtied_buttons', plugins_url('/js/scripts.js', __FILE__), array('jquery'), '1.0', TRUE);
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
    	<img class="envato-logo" src="<?php echo plugins_url('/img/envato-logo.png', __FILE__); ?>" />
    	<img class="price" src="<?php echo plugins_url('/img/69.png', __FILE__); ?>" />
    </a>
	
	<?php

	//}	
	
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	echo $content;

}