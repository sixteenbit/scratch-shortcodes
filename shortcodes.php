<?php
/*
Plugin Name: Scratch Shortcodes
Plugin URI: https://github.com/mrdink/scratch-shortcodes/
Description: Shortcodes for themes generated by Scratch.
Author: Justin Peacock
Version: 1.0.0
Author URI: https://sixteenbit.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Work in Widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Grid
 */

//
// Row
//
function scratch_sc_row( $atts, $content = null ) {

	// Output
	ob_start(); ?>

	<div class="row">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- .row -->

	<?php return ob_get_clean();
}

add_shortcode( 'row', 'scratch_sc_row' );

//
// Column
//
function scratch_sc_column( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'small'  => '',
				'medium' => '',
				'large'  => '',
				'align'  => ''
			), $atts )
	);

	ob_start(); ?>

	<div class="<?php
	if ( ! empty( $small ) ) {
		echo 'small-' . esc_attr( $small ) . '';
	}
	if ( ! empty( $medium ) ) {
		echo ' medium-' . esc_attr( $medium ) . '';
	}
	if ( ! empty( $large ) ) {
		echo ' large-' . esc_attr( $large ) . '';
	}
	if ( ! empty( $align ) ) {
		echo ' ' . esc_attr( $align ) . '';
	} ?> columns">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- .columns -->

	<?php return ob_get_clean();
}

add_shortcode( 'column', 'scratch_sc_column' );

/**
 * UI
 */

//
// Button
//
function scratch_sc_button( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'link'  => '#',
				'size'  => '',// [tiny small large expand]
				'type'  => '',// [radius round]
				'style' => ''// [secondary success alert]
			), $atts )
	);

	ob_start(); ?>

	<a class="button<?php
	echo $size ? ' ' . esc_attr( $size ) . '' : '';
	echo $type ? ' ' . esc_attr( $type ) . '' : '';
	echo $style ? ' ' . esc_attr( $style ) . '' : ''; ?>" href="<?php echo $link ? esc_url( $link ) : ''; ?>">
		<?php echo do_shortcode( $content ); ?>
	</a>

	<?php return ob_get_clean();
}

add_shortcode( 'button', 'scratch_sc_button' );

// Panel
function scratch_sc_panel( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'type'  => '',// [radius]
				'style' => '',// [callout]
			), $atts )
	);

	ob_start(); ?>

	<div class="panel <?php echo esc_attr( $type ); ?> <?php echo esc_attr( $style ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- .panel -->

	<?php return ob_get_clean();
}

add_shortcode( 'panel', 'scratch_sc_panel' );

// Alert
function scratch_sc_alert( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'type'  => '',// [radius round]
				'style' => '',// [secondary success alert]
			), $atts )
	);

	ob_start(); ?>

	<div class="alert-box <?php echo esc_attr( $type ); ?> <?php echo esc_attr( $style ); ?>" data-alert>
		<?php echo do_shortcode( $content ); ?>
		<a href="#" class="close">&times;</a>
	</div><!-- .alert-box -->

	<?php return ob_get_clean();
}

add_shortcode( 'alert', 'scratch_sc_alert' );

// Tooltip
function scratch_sc_tooltip( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'tip'      => '',
				'position' => '',// [tip-top tip-bottom tip-left tip-right]
				'type'     => ''// [radius round]
			), $atts )
	);

	ob_start(); ?>

	<span
		class="has-tip <?php echo esc_attr( $position ); ?> <?php echo esc_attr( $type ); ?> <?php echo esc_attr( $tip ); ?>"
		data-tooltip><?php echo do_shortcode( $content ); ?></span>

	<?php return ob_get_clean();
}

add_shortcode( 'tooltip', 'scratch_sc_tooltip' );

// Label
function scratch_sc_label( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'type'  => '',// [round radius]
				'style' => ''// [success alert secondary]
			), $atts )
	);

	ob_start(); ?>

	<span
		class="label <?php echo esc_attr( $type ); ?> <?php echo esc_attr( $style ); ?>"><?php echo do_shortcode( $content ); ?></span>

	<?php return ob_get_clean();
}

add_shortcode( 'label', 'scratch_sc_label' );

// Flex Video
function scratch_sc_flex_video( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'type' => '',
				'size' => '',
			), $atts )
	);

	ob_start(); ?>

	<div class="flex-video <?php echo esc_attr( $type ); ?> <?php echo esc_attr( $size ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- .flex-video -->

	<?php return ob_get_clean();
}

add_shortcode( 'flex-video', 'scratch_sc_flex_video' );

// Visibility Classes
function scratch_sc_visibility( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'hide' => '',// [small-only medium-up medium-only large-up large-only xlarge-up xlarge-only xxlarge-up]
				'show' => '',// [small-only medium-up medium-only large-up large-only xlarge-up xlarge-only xxlarge-up]
			), $atts )
	);

	ob_start(); ?>

	<span class="<?php
	if ( ! empty( $hide ) ) {
		echo 'hide-for-' . esc_attr( $hide ) . '';
	}
	if ( ! empty( $show ) ) {
		echo 'show-for-' . esc_attr( $show ) . '';
	} ?>"><?php echo do_shortcode( $content ); ?></span>

	<?php return ob_get_clean();
}

add_shortcode( 'visibility', 'scratch_sc_visibility' );

/**
 * TinyMCE Button
 */
add_action( 'admin_head', 'FS_tinymce_button' );

function FS_tinymce_button() {
	global $typenow;
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( "mce_external_plugins", "FS_add_tinymce_plugin" );
		add_filter( 'mce_buttons', 'FS_register_my_tc_button' );
	}
}

function FS_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['FS_tc_button'] = plugins_url( 'assets/js/editor.min.js', __FILE__ );

	return $plugin_array;
}

function FS_register_my_tc_button( $buttons ) {
	array_push( $buttons, "FS_tc_button" );

	return $buttons;
}

/**
 * Dashicons
 */
function FS_tinymce_icon() { ?>
	<style type="text/css" media="screen">
		i.mce-i-icon {
			font: 400 20px/1 dashicons;
			padding: 0;
			vertical-align: top;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			margin-left: -2px;
			padding-right: 2px
		}
	</style>
	<?php

}

add_action( 'admin_head', 'FS_tinymce_icon' );
