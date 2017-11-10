<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Call-to-Action', 'Call-to-Action', 'manage_options', 'test-plugin', 'global_custom_options' );
}

function global_custom_options() {
?>
    <div class="wrap">
        <h2>Get Bowtied - Call-to-Action Button - Options</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            <p>
            	<strong>Button Text</strong><br />
                <input type="text" name="button_text" size="45" value="<?php echo get_option('button_text'); ?>" />
            </p>
            <p>
            	<strong>Button Link</strong><br />
                <input type="text" name="button_link" size="45" value="<?php echo get_option('button_link'); ?>" />
            </p>
            <p>
            	<strong>Event Tracking Identifier</strong><br />
                <input type="text" name="button_event_tracking_identifier" size="45" value="<?php echo get_option('button_event_tracking_identifier'); ?>" />
            </p>
            <p><input type="submit" name="Submit" value="Save Options" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="button_link, button_text, button_event_tracking_identifier" />
        </form>
    </div>
<?php
}
?>
