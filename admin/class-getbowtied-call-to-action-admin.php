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
		add_options_page( 'Call-to-Action', 'Call-to-Action', 'manage_options', 'getbowtied-call-to-action', array( $this, 'call_to_action_options' ) );
	}

	/**
	 * Register buttons settings
	 *
	 * @since    1.0.0
	 */
	function register_getbowtied_call_to_action_settings() {
		// header
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_product_title' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_description' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_purchase_button_text' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_purchase_button_link' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_background_image_url' );

		// testimonial
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_testimonial_author' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_testimonial_text' );

		// page layouts
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_page_layouts_description' );
		for( $i = 1; $i <=9; $i++) {
			register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_layout_thumb_'.$i.'_link' );
			register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_layout_thumb_'.$i.'_image_url' );
		}

		// documentation link
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_documentation_button_text' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_documentation_button_link' );

		// support link
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_support_button_text' );
		register_setting( 'getbowtied-call-to-action-settings-group', 'getbowtied_support_button_link' );
	}

	/**
	 * Admin Call-To-Action page
	 *
	 * @since    1.0.0
	 */
	public function call_to_action_options() {
	?>
		<div class="wrap">
			<h2><?php esc_html_e( 'GetBowtied Call-to-Action', 'getbowtied-call-to-action' ); ?></h2>

			<form method="post" action="options.php" novalidate="novalidate">

				<?php settings_fields( 'getbowtied-call-to-action-settings-group' ); ?>
    			<?php do_settings_sections( 'getbowtied-call-to-action-settings-group' ); ?>

				<table class="form-table getbowtied-call-to-action-table">
					<tbody class="table-section">
						<tr>
							<td colspan="2"><?php esc_html_e( 'Header', 'getbowtied-call-to-action' ); ?></td>
						</tr>
					</tbody>
					<tbody>
						<?php $this->get_call_to_action_text_option( 'getbowtied_product_title', 'Title' ); ?>
						<?php $this->get_call_to_action_textarea_option( 'getbowtied_description', 'Description' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_purchase_button_text', 'Purchase Button Text' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_purchase_button_link', 'Purchase Button Link' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_background_image_url', 'Background Image URL' ); ?>
					</tbody>
					<tbody class="table-section">
						<tr>
							<td colspan="2"><?php esc_html_e( 'Testimonial', 'getbowtied-call-to-action' ); ?></td>
						</tr>
					</tbody>
					<tbody>
						<?php $this->get_call_to_action_text_option( 'getbowtied_testimonial_author', 'Title' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_testimonial_text', 'Text' ); ?>
					</tbody>
					<tbody class="table-section">
						<tr>
							<td colspan="2"><?php esc_html_e( 'Page Layouts', 'getbowtied-call-to-action' ); ?></td>
						</tr>
					</tbody>
					<tbody>
						<?php $this->get_call_to_action_text_option( 'getbowtied_page_layouts_description', 'Description' ); ?>
						<?php
							for( $i = 1; $i <=9; $i++) {
								$this->get_call_to_action_text_option( 'getbowtied_layout_thumb_'.$i.'_link', 'Layout '.$i.' Link' );
								$this->get_call_to_action_text_option( 'getbowtied_layout_thumb_'.$i.'_image_url', 'Layout '.$i.' Image URL' );
							}
						?>
					</tbody>
					<tbody class="table-section">
						<tr>
							<td colspan="2"><?php esc_html_e( 'Documentation Button', 'getbowtied-call-to-action' ); ?></td>
						</tr>
					</tbody>
					<tbody>
						<?php $this->get_call_to_action_text_option( 'getbowtied_documentation_button_text', 'Text' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_documentation_button_link', 'Link' ); ?>
					</tbody>
					<tbody class="table-section">
						<tr>
							<td colspan="2"><?php esc_html_e( 'Support Button', 'getbowtied-call-to-action' ); ?></td>
						</tr>
					</tbody>
					<tbody>
						<?php $this->get_call_to_action_text_option( 'getbowtied_support_button_text', 'Text' ); ?>
						<?php $this->get_call_to_action_text_option( 'getbowtied_support_button_link', 'Link' ); ?>
					</tbody>
				</table>

				<?php submit_button(); ?>

			</form>
		</div>
	<?php
	}

	/**
	 * Prints text field html.
	 *
	 * @since    1.1.0
	 */
	public function get_call_to_action_text_option( $option = '', $label = '' ) {
		if( empty($option) || !is_string($option) ) return;

		printf(
			'<tr><th scope="row"><label for="%s">%s</label></th><td><input type="text" name="%s" id="%s" value="%s" class="regular-text" /></td></tr>',
			$option,
			esc_html( $label, 'getbowtied-call-to-action' ),
			$option,
			$option,
			get_option( $option, '' )
		);

		return;
	}

	/**
	 * Prints textarea field html.
	 *
	 * @since    1.1.0
	 */
	public function get_call_to_action_textarea_option( $option = '', $label = '' ) {
		if( empty($option) || !is_string($option) ) return;

		printf(
			'<tr><th scope="row"><label for="%s">%s</label></th><td><textarea name="%s" id="%s" value="%s" class="regular-text"></textarea></td></tr>',
			$option,
			esc_html( $label, 'getbowtied-call-to-action' ),
			$option,
			$option,
			get_option( $option, '' )
		);

		return;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/getbowtied-call-to-action-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/getbowtied-call-to-action-admin.js', array('jquery'), $this->version, true );
	}

}
