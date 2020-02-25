<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://getbowtied.com/
 * @since      1.0.0
 *
 * @package    Getbowtied_Call_To_Action
 * @subpackage Getbowtied_Call_To_Action/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Getbowtied_Call_To_Action
 * @subpackage Getbowtied_Call_To_Action/public
 * @author     GetBowtied <vanesa@getbowtied.com>
 */
class Getbowtied_Call_To_Action_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'wp_footer', array( $this, 'get_buttons' ) );
	}

	public function get_buttons() {

		$purchase_link = get_option( 'purchase_button_link', '' );
		$purchase_text = get_option( 'purchase_button_text', '' );
	?>

		<div class="getbowtied_call_to_action">

			<?php if( !empty($purchase_link) && !empty($purchase_text) ) { ?>
				<a class="call_to_action_button purchase_button" href="<?php echo esc_url($purchase_link); ?>" target="_blank">
					<span class="action-btn purchase-btn">
						<svg
							xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							width="18" height="18"
							viewBox="0 0 50 50"
							fill="#ffffff">
							<path d="M25.0224609,0 C38.7509766,0 50,11.2484375 50,25.0224609 C50,38.7509766 38.7509766,50 25.0224609,50 C11.2484375,50 0,38.7509766 0,25.0224609 C0,11.2484375 11.2484375,0 25.0224609,0 Z M25.5976562,12.0456055 C20.415625,16.0314453 17.5374023,23.8706055 17.6258789,30.0269531 C17.6258789,30.7348633 17.1833984,30.8675781 16.7844727,30.4693359 C14.0832031,27.9 14.9246094,22.7629883 15.9430664,19.0875 C16.3419922,17.5373047 15.5005859,17.1391602 14.5699219,18.1132812 C11.9571289,20.9030273 10.5847656,23.8262695 10.8944336,27.9 C11.6473633,37.4219727 18.9990234,41.5857422 27.8115234,40.4337891 C33.4369141,39.7243164 36.5797852,35.5621094 38.2183594,31.4427734 C39.3260742,28.6980469 39.5030273,22.6302734 38.3526367,17.3162109 C37.8644531,15.2786133 36.5355469,10.7617187 34.587207,9.74326172 C32.2848633,8.54716797 27.5016602,10.5847656 25.5976562,12.0456055 Z"></path>
						</svg>
						<span><?php echo esc_attr($purchase_text); ?></span>
					</span>
				</a>
			<?php } ?>
		</div>

	<?php
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/getbowtied-call-to-action-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {}

}
