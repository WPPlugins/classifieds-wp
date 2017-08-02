<?php
/**
 * WP_Classified_Manager_Forms class.
 */
class WP_Classified_Manager_Forms {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'load_posted_form' ) );
	}

	/**
	 * If a form was posted, load its class so that it can be processed before display.
	 */
	public function load_posted_form() {
		if ( ! empty( $_POST['classified_manager_form'] ) ) {
			$this->load_form_class( sanitize_title( $_POST['classified_manager_form'] ) );
		}
	}

	/**
	 * Load a form's class
	 *
	 * @param  string $form_name
	 * @return string class name on success, false on failure
	 */
	private function load_form_class( $form_name ) {
		if ( ! class_exists( 'WP_Classified_Manager_Form' ) ) {
			include( 'abstracts/abstract-wp-classified-manager-form.php' );
		}

		// Now try to load the form_name
		$form_class  = 'WP_Classified_Manager_Form_' . str_replace( '-', '_', $form_name );
		$form_file   = WP_CLASSIFIED_MANAGER_PLUGIN_DIR . '/includes/forms/class-wp-classified-manager-form-' . $form_name . '.php';

		if ( class_exists( $form_class ) ) {
			return call_user_func( array( $form_class, 'instance' ) );
		}

		if ( ! file_exists( $form_file ) ) {
			return false;
		}

		if ( ! class_exists( $form_class ) ) {
			include $form_file;
		}

		// Init the form
		return call_user_func( array( $form_class, 'instance' ) );
	}

	/**
	 * get_form function.
	 *
	 * @param string $form_name
	 * @param  array $atts Optional passed attributes
	 * @return string
	 */
	public function get_form( $form_name, $atts = array() ) {
		if ( $form = $this->load_form_class( $form_name ) ) {
			ob_start();
			$form->output( $atts );
			return ob_get_clean();
		}
	}
}