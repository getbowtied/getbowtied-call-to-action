<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://getbowtied.com/
 * @since      1.0.0
 *
 * @package    Getbowtied_Call_To_Action
 * @subpackage Getbowtied_Call_To_Action/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Getbowtied_Call_To_Action
 * @subpackage Getbowtied_Call_To_Action/admin
 * @author     GetBowtied <vanesa@getbowtied.com>
 */
class Getbowtied_Call_To_Action_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'register_getbowtied_call_to_action_settings' ) );
	}

	/**
	 * Creates dashboard menu item
	 *
	 * @since    1.0.0
	 */
	function add_plugin_page() {
		add_options_page( 'Call-to-Action', 'Call-to-Action', 'manage_options', 'getbowtied-call-to-action', 'Getbowtied_Call_To_Action_Admin::call_to_action_options' );
	}

	/**
	 * Register buttons settings
	 *
	 * @since    1.0.0
	 */
	function register_getbowtied_call_to_action_settings() {
		register_setting( 'getbowtied-call-to-action-settings-group', 'purchase_button_text' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'purchase_button_link' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'message_button_text' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'message_button_link' );
	}

	/**
	 * Admin Call-To-Action page
	 *
	 * @since    1.0.0
	 */
	public static function call_to_action_options() {
	?>
		<div class="wrap">
			<h2>GetBowtied Call-to-Action</h2>

			<form method="post" action="options.php" novalidate="novalidate">

				<?php settings_fields( 'getbowtied-call-to-action-settings-group' ); ?>
    			<?php do_settings_sections( 'getbowtied-call-to-action-settings-group' ); ?>

				<h3>Purchase Button</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="purchase_button_text">Button Text</label>
							</th>
							<td>
								<input type="text" name="purchase_button_text" id="purchase_button_text" value="<?php echo get_option( 'purchase_button_text', '' ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="purchase_button_link">Button Link</label>
							</th>
							<td>
								<input type="text" name="purchase_button_link" id="purchase_button_link" value="<?php echo get_option( 'purchase_button_link', '' ); ?>" class="regular-text" />
							</td>
						</tr>
					</tbody>
				</table>

				<h3>Message Button</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="message_button_text">Button Text</label>
							</th>
							<td>
								<input type="text" name="message_button_text" id="message_button_text" value="<?php echo get_option( 'message_button_text', '' ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="message_button_link">Button Link</label>
							</th>
							<td>
								<input type="text" name="message_button_link" id="message_button_link" value="<?php echo get_option( 'message_button_link', '' ); ?>" class="regular-text" />
							</td>
						</tr>
					</tbody>
				</table>

				<?php submit_button(); ?>

			</form>
		</div>
	<?php
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {}

}
