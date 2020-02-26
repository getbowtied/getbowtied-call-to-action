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
	?>

	<div class="call-to-action-canvas">
		<button class="call-to-action-toggle"><span class="icon"></span></button>
		<div class="call-to-action-canvas-content">
			<div class="call-to-action-header" style="background-image:url(<?php esc_html_e( get_option( 'getbowtied_background_image_url', '' ) ); ?>);background-color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;">
				<button class="call-to-action-close"></button>
				<?php if( !empty(get_option( 'getbowtied_product_title', '' )) ) { ?>
					<h4 class="call-to-action-title"><?php echo wp_kses_post( get_option( 'getbowtied_product_title', '' ) ); ?></h4>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_description', '' )) ) { ?>
					<p class="call-to-action-description"><?php echo wp_kses_post( get_option( 'getbowtied_description', '' ) ); ?></p>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_purchase_button_link', '' )) && !empty(get_option( 'getbowtied_purchase_button_text', '' )) ) { ?>
					<a href="<?php echo esc_url( get_option( 'getbowtied_purchase_button_link', '' ) ); ?>" class="call-to-action-purchase-link" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;"><?php echo wp_kses_post( get_option( 'getbowtied_purchase_button_text', '' ) ); ?></a>
				<?php } ?>
			</div>

			<div class="call-to-action-testimonial">
				<?php if( !empty(get_option( 'getbowtied_testimonial_text', '' )) && !empty(get_option( 'getbowtied_testimonial_author', '' )) ) { ?>
					<div class="call-to-action-testimonial-rating" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;"></div>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_testimonial_text', '' )) ) { ?>
					<p class="call-to-action-testimonial-text"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_text', '' ) ); ?></p>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_testimonial_author', '' )) ) { ?>
					<h5 class="call-to-action-testimonial-author"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_author', '' ) ); ?></h5>
				<?php } ?>
			</div>
			<div class="call-to-action-page-layouts"></div>
			<div class="call-to-action-links"></div>

	    </div>
	</div>
	<div class="call-to-action-canvas-overlay"></div>

	<?php
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/getbowtied-call-to-action-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/getbowtied-call-to-action-public.js', array('jquery'), $this->version, true );
	}

}
