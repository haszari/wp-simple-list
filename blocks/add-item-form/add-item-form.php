<?php
/**
 * Plugin Name:       Add Item Form
 * Description:       Example static block scaffolded with Create Block tool.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       add-item-form
 *
 * @package           create-block
 */

function cbr_add_item_form_render_block( array $attributes ) : string {
    $class = 'cbr-add-item-form';

    ob_start();
    ?>

    <div
        class="<?php echo esc_attr( $class ); ?>"
    >
        Add form coming soon
    </div>

    <?php
    return ob_get_clean();
}
function cbr_add_item_form_block_init() {
	register_block_type(
		__DIR__ . '/build',
		[
			'render_callback' => 'cbr_add_item_form_render_block'
		]
	);
}
add_action( 'init', 'cbr_add_item_form_block_init' );

function cbr_add_item_form_add_frontend_scripts() {

	// Problem: this file is not built by my wp-env setup
	//http://localhost:8732/wp-content/plugins/artist-list-app/blocks/add-item-form/build/frontend.js
	$frontend_js_path = '/build/' . 'frontend.js';
	wp_enqueue_script(
		'cbr_add_item_form_add_frontend',
		plugins_url( $frontend_js_path, __FILE__ ),
		[  'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-api-fetch' ],
		filemtime( __DIR__ . $frontend_js_path )
	);
}
add_action( 'enqueue_block_assets', 'cbr_add_item_form_add_frontend_scripts' );
