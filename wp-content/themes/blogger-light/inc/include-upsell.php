<?php
/**
 * This file implements upsell message in customizer
 * It can be used as-is in themes (drop-in).
 *
 * @package blogger-light
 */



if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'blogger_light_upsell_section' ) ) {
	/**
	 * Recommend the installation of blogger using a custom section.
	 *
	 * @see WP_Customize_Section
	 */
	class blogger_light_upsell_section extends WP_Customize_Section {

		/**
		 * Render the section.
		 *
		 * @access protected
		 */
		protected function render() {

			$classes = 'cannot-expand accordion-section control-section control-section-themes control-section-' . $this->type;
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;padding:15px;margin-top:10px;background-color:#f5f5f5;text-align: right;">

				<span style="float:left;line-height:2;font-weight:700;"><?php esc_attr_e( 'Are you ready for more?', 'blogger-light' ); ?></span>
				<a class="install-now button-primary button" href="https://niteothemes.com/downloads/blogger-wordpress-theme/" aria-label="<?php esc_attr_e( 'Get Blogger PRO', 'blogger-light' ); ?>" style="background-color: #d65050;color: #fff;box-shadow: none;text-shadow: none; border: none;">
					<?php esc_html_e( 'Get Blogger PRO', 'blogger-light' ); ?>
				</a>

			</li>
			<?php
		}
	}
}

if ( ! function_exists( 'blogger_light_upsell_register' ) ) {
	/**
	 * Registers the section, setting & control for the blogger installer.
	 *
	 * @param object $wp_customize The main customizer object.
	 */
	function blogger_light_upsell_register( $wp_customize ) {
		$wp_customize->add_section( new blogger_light_upsell_section( $wp_customize, 'blogger_light_upsell', array(
			'title'      => '',
			'capability' => 'install_plugins',
			'priority'   => 999,
		) ) );

		$wp_customize->add_setting( 'blogger_light_upsell_setting', array(
			'sanitize_callback' => '__return_true',
		) );

		$wp_customize->add_control( 'blogger_light_upsell_control', array(
			'section'    => 'blogger_light_upsell',
			'settings'   => 'blogger_light_upsell_setting',
		) );

	}
	add_action( 'customize_register', 'blogger_light_upsell_register' );
}
