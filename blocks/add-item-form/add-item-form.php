<?php
/**
 * Plugin Name:       CBR Simple List
 * Description:       WordPress plugin for adding items (posts) quickly from front end of site.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.2.0
 * Author:            haszari
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cbr-simple-list
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

	// Only render the front-end form for users who can publish posts.
	if ( ! current_user_can( 'edit_posts' ) || ! current_user_can( 'publish_posts' ) ) {
		return;
	}

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
