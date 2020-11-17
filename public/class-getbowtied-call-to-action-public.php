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

		if( !empty(get_option( 'getbowtied_visible_to_public', '' )) ||
	 	( empty(get_option( 'getbowtied_visible_to_public', '' )) && is_user_logged_in() && current_user_can( 'administrator' ) ) ) {
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
					<?php if( !empty(get_option( 'getbowtied_refund_text', '' )) ) { ?>
						<p class="call-to-action-refund-text"><?php echo wp_kses_post( get_option( 'getbowtied_refund_text', '' ) ); ?></p>
					<?php } ?>
				</div>

				<div class="call-to-action-testimonial">
					<?php if( !empty(get_option( 'getbowtied_testimonial_1_text', '' )) && !empty(get_option( 'getbowtied_testimonial_1_author', '' )) ) { ?>
						<div class="call-to-action-testimonial-rating" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_testimonial_1_text', '' )) ) { ?>
						<p class="call-to-action-testimonial-text"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_1_text', '' ) ); ?></p>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_testimonial_1_author', '' )) ) { ?>
						<h5 class="call-to-action-testimonial-author"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_1_author', '' ) ); ?></h5>
					<?php } ?>
				</div>

				<div class="call-to-latest-layout">
					<?php if( !empty(get_option( 'getbowtied_latest_layout_title', '' )) && !empty(get_option( 'getbowtied_latest_layout_image_url', '' )) && !empty(get_option( 'getbowtied_latest_layout_link', '' )) ) { ?>
						<h4 class="call-to-action-latest-layout-title"><?php echo wp_kses_post( get_option( 'getbowtied_latest_layout_title', '' ) ); ?></h4>
						<a class="call-to-action-latest-layout-image" href="<?php echo wp_kses_post( get_option( 'getbowtied_latest_layout_link', '' ) ); ?>">
							<img src="<?php echo wp_kses_post( get_option( 'getbowtied_latest_layout_image_url', '' ) ); ?>" />
						</a>
					<?php } ?>
				</div>

				<div class="call-to-action-page-layouts">
					<?php if( !empty(get_option( 'getbowtied_page_layouts_description', '' )) ) { ?>
						<p class="call-to-action-layouts-description"><?php echo wp_kses_post( get_option( 'getbowtied_page_layouts_description', '' ) ); ?></p>
					<?php } ?>
					<div class="call-to-action-layouts-grid">
						<?php for( $i = 1; $i <= 9; $i++) { ?>
							<?php if( !empty(get_option( 'getbowtied_layout_thumb_'.$i.'_link', '' )) && !empty(get_option( 'getbowtied_layout_thumb_'.$i.'_image_url', '' )) ) { ?>
								<a href="<?php echo esc_url( get_option( 'getbowtied_layout_thumb_'.$i.'_link', '' ) ); ?>" class="call-to-action-layout-image">
									<?php if( !empty(get_option( 'getbowtied_layout_thumb_'.$i.'_show_badge', '' )) ) { ?>
										<span class="call-to-action-layout-badge"  style="background-color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;"><?php echo wp_kses_post( get_option( 'getbowtied_page_layout_badge_text', '' ) ); ?></span>
									<?php } ?>
									<img src="<?php echo esc_url( get_option(  'getbowtied_layout_thumb_'.$i.'_image_url', '' ) ); ?>" />
								</a>
							<?php } ?>
						<?php } ?>
						<?php for( $i = 1; $i <= 3; $i++) { ?>
							<div class="call-to-action-layout-coming-soon"><?php esc_html_e( 'New Layouts Coming Soon', 'getbowtied-call-to-action' ); ?></div>
							<?php } ?>
					</div>
					<?php if( !empty(get_option( 'getbowtied_page_layouts_footer_text', '' )) ) { ?>
						<p class="call-to-action-layouts-footer-text"><?php echo wp_kses_post( get_option( 'getbowtied_page_layouts_footer_text', '' ) ); ?></p>
					<?php } ?>
				</div>

				<div class="call-to-action-testimonial">
					<?php if( !empty(get_option( 'getbowtied_testimonial_2_text', '' )) && !empty(get_option( 'getbowtied_testimonial_2_author', '' )) ) { ?>
						<div class="call-to-action-testimonial-rating" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_testimonial_2_text', '' )) ) { ?>
						<p class="call-to-action-testimonial-text"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_2_text', '' ) ); ?></p>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_testimonial_2_author', '' )) ) { ?>
						<h5 class="call-to-action-testimonial-author"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_2_author', '' ) ); ?></h5>
					<?php } ?>
				</div>

				<?php if( !empty(get_option( 'getbowtied_purchase_button_link', '' )) && !empty(get_option( 'getbowtied_purchase_button_text', '' )) ) { ?>
					<a href="<?php echo esc_url( get_option( 'getbowtied_purchase_button_link', '' ) ); ?>" class="call-to-action-bottom-purchase-link" style="background-color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;box-shadow: -8px 8px 35px -5px <?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>a1;">
						<?php echo wp_kses_post( get_option( 'getbowtied_purchase_button_text', '' ) ); ?>
					</a>
				<?php } ?>

				<div class="call-to-action-links">
					<?php if( !empty(get_option( 'getbowtied_documentation_button_text', '' )) && !empty(get_option( 'getbowtied_documentation_button_link', '' )) ) { ?>
						<a href="<?php echo esc_url( get_option( 'getbowtied_documentation_button_link', '' ) ); ?>" class="call-to-action-documentation-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
		                        <path d="M 2 4 L 2 18 C 2 19.093063 2.9069372 20 4 20 L 10.587891 20 A 1.5 1.5 0 0 0 12 21 A 1.5 1.5 0 0 0 13.412109 20 L 20 20 C 21.093063 20 22 19.093063 22 18 L 22 4 L 15 4 C 13.789062 4 12.735556 4.5762461 12 5.4355469 C 11.264444 4.5762461 10.210938 4 9 4 L 2 4 z M 4 6 L 9 6 C 10.116666 6 11 6.8833339 11 8 L 13 8 C 13 6.8833339 13.883334 6 15 6 L 20 6 L 20 18 L 4 18 L 4 6 z M 15 9 L 15 11 L 17 11 L 17 9 L 15 9 z M 15 12 L 15 16 L 17 16 L 17 12 L 15 12 z"/>
		                    </svg>
							<?php echo wp_kses_post( get_option( 'getbowtied_documentation_button_text', '' ) ); ?>
						</a>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_support_button_text', '' )) && !empty(get_option( 'getbowtied_support_button_link', '' )) ) { ?>
						<a href="<?php echo esc_url( get_option( 'getbowtied_support_button_link', '' ) ); ?>" class="call-to-action-support-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
		                        <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 12 6 C 9.79 6 8 7.79 8 10 L 10 10 C 10 8.9 10.9 8 12 8 C 13.1 8 14 8.9 14 10 C 14 12 11 12.367 11 15 L 13 15 C 13 13.349 16 12.5 16 10 C 16 7.79 14.21 6 12 6 z M 11 16 L 11 18 L 13 18 L 13 16 L 11 16 z"/>
		                    </svg>
							<?php echo wp_kses_post( get_option( 'getbowtied_support_button_text', '' ) ); ?>
						</a>
					<?php } ?>
					<?php if( !empty(get_option( 'getbowtied_facebook_button_text', '' )) && !empty(get_option( 'getbowtied_facebook_button_link', '' )) ) { ?>
						<a href="<?php echo esc_url( get_option( 'getbowtied_facebook_button_link', '' ) ); ?>" class="call-to-action-facebook-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
		                        <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.014467 17.065322 19.313017 13.21875 19.898438 L 13.21875 14.384766 L 15.546875 14.384766 L 15.912109 12.019531 L 13.21875 12.019531 L 13.21875 10.726562 C 13.21875 9.7435625 13.538984 8.8710938 14.458984 8.8710938 L 15.935547 8.8710938 L 15.935547 6.8066406 C 15.675547 6.7716406 15.126844 6.6953125 14.089844 6.6953125 C 11.923844 6.6953125 10.654297 7.8393125 10.654297 10.445312 L 10.654297 12.019531 L 8.4277344 12.019531 L 8.4277344 14.384766 L 10.654297 14.384766 L 10.654297 19.878906 C 6.8702905 19.240845 4 15.970237 4 12 C 4 7.5698774 7.5698774 4 12 4 z"/>
		                    </svg>
							<?php echo wp_kses_post( get_option( 'getbowtied_facebook_button_text', '' ) ); ?>
						</a>
					<?php } ?>
				</div>

		    </div>
		</div>
		<div class="call-to-action-canvas-overlay"></div>

		<?php
		}
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
		wp_enqueue_script( 'js-cookie' , plugin_dir_url( __FILE__ ) . 'assets/js/js.cookie.min.js', array('jquery'), '2.2.1', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/getbowtied-call-to-action-public.js', array('jquery'), $this->version, true );
		$args = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		);
		wp_localize_script( $this->plugin_name, 'call_to_action_vars', $args );
	}

}
