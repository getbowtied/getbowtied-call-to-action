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

		add_action('wp_ajax_set_cookie', array( $this, 'set_cookie' ));
        add_action('wp_ajax_nopriv_set_cookie', array( $this, 'set_cookie' ));

		add_action('wp_ajax_check_cookie', array( $this, 'check_cookie' ));
        add_action('wp_ajax_nopriv_check_cookie', array( $this, 'check_cookie' ));

		add_action( 'wp_footer', array( $this, 'get_buttons' ) );
	}

	/**
     * Manage body classes based on cookie.
     *
     * @param array $classes Body classes.
	 *
     * @return void
     */
	public function check_cookie( $classes ) {

		$cookie_value = isset( $_COOKIE[ 'keep_canvas_open' ] ) ? wp_unslash( $_COOKIE[ 'keep_canvas_open' ] ) : '1'; // @codingStandardsIgnoreLine.
        if ( '1' === $cookie_value) {
            wp_send_json_success(true);
        }

		wp_send_json_success(false);
	}

	/**
     * Set a cookie - wrapper for setcookie using WP constants.
     *
     * @param bool $secure Whether the cookie should be served only over https.
	 * @param bool $httponly
	 *
     * @return void
     */
    public function set_cookie( $secure = false, $httponly = false ) {
		if (! ( isset($_POST['data']) && $_POST['data'] && isset($_POST['data']['is_canvas_open']) )) {
            wp_send_json_error( "no info received" );
        }

        if (! headers_sent() ) {
			setcookie( 'keep_canvas_open', $_POST['data']['is_canvas_open'], null, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, $secure, $httponly); // session cookie
		} elseif (defined('WP_DEBUG') && WP_DEBUG) {
            headers_sent($file, $line);
			trigger_error( "close_canvas cookie cannot be set - headers already sent", E_USER_NOTICE ); // @codingStandardsIgnoreLine
        }

        wp_send_json_success(true);
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
				<?php if( !empty(get_option( 'getbowtied_testimonial_1_text', '' )) && !empty(get_option( 'getbowtied_testimonial_1_author', '' )) ) { ?>
					<div class="call-to-action-testimonial-rating" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;"></div>
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
					<div class="call-to-action-testimonial-rating" style="color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;"></div>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_testimonial_2_text', '' )) ) { ?>
					<p class="call-to-action-testimonial-text"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_2_text', '' ) ); ?></p>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_testimonial_2_author', '' )) ) { ?>
					<h5 class="call-to-action-testimonial-author"><?php echo wp_kses_post( get_option( 'getbowtied_testimonial_2_author', '' ) ); ?></h5>
				<?php } ?>
			</div>

			<?php if( !empty(get_option( 'getbowtied_purchase_button_link', '' )) && !empty(get_option( 'getbowtied_purchase_button_text', '' )) ) { ?>
				<a href="<?php echo esc_url( get_option( 'getbowtied_purchase_button_link', '' ) ); ?>" class="call-to-action-bottom-purchase-link" style="background-color:<?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>;box-shadow: -8px 8px 35px -5px <?php echo esc_url( get_option( 'getbowtied_product_color', '' ) ); ?>a1;"><?php echo wp_kses_post( get_option( 'getbowtied_purchase_button_text', '' ) ); ?></a>
			<?php } ?>

			<div class="call-to-action-links">
				<?php if( !empty(get_option( 'getbowtied_documentation_button_text', '' )) && !empty(get_option( 'getbowtied_documentation_button_link', '' )) ) { ?>
					<a href="<?php echo esc_url( get_option( 'getbowtied_documentation_button_link', '' ) ); ?>" class="call-to-action-documentation-link"><?php echo wp_kses_post( get_option( 'getbowtied_documentation_button_text', '' ) ); ?></a>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_support_button_text', '' )) && !empty(get_option( 'getbowtied_support_button_link', '' )) ) { ?>
					<a href="<?php echo esc_url( get_option( 'getbowtied_support_button_link', '' ) ); ?>" class="call-to-action-support-link"><?php echo wp_kses_post( get_option( 'getbowtied_support_button_text', '' ) ); ?></a>
				<?php } ?>
				<?php if( !empty(get_option( 'getbowtied_facebook_button_text', '' )) && !empty(get_option( 'getbowtied_facebook_button_link', '' )) ) { ?>
					<a href="<?php echo esc_url( get_option( 'getbowtied_facebook_button_link', '' ) ); ?>" class="call-to-action-facebook-link"><?php echo wp_kses_post( get_option( 'getbowtied_facebook_button_text', '' ) ); ?></a>
				<?php } ?>
			</div>

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
		$args = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		);
		wp_localize_script( $this->plugin_name, 'call_to_action_vars', $args );
	}

}
