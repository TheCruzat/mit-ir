<?php
/**
 * Master file for all "smaller" includes in inc
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

// Always set Output CSS setting to No. We want to use our own _gravity-forms.scss
/*function dequeue_gf_stylesheets() {
  wp_dequeue_style( 'gforms_reset_css' );
  wp_dequeue_style( 'gforms_datepicker_css' );
  wp_dequeue_style( 'gforms_formsmain_css' );
  wp_dequeue_style( 'gforms_ready_class_css' );
  wp_dequeue_style( 'gforms_browsers_css' );
}
add_action( 'gform_enqueue_scripts', __NAMESPACE__ . '\dequeue_gf_stylesheets', 999 ); */
add_filter( 'gform_disable_form_theme_css', '__return_true' );

// Disable printing Gravity Forms js straight after <head> (invalid HTML)
add_filter( 'gform_force_hooks_js_output', '__return_false' );

add_filter( 'gform_required_legend', function( $legend, $form ) {
	return '<span class="gfield_required gfield_required_asterisk">*</span> Indicates required fields';
	//return 'your custom legend here';
}, 10, 2 );


