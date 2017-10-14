<?php


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class Rkkr_Acf_Helpers {

	public function __construct() {

	}

	public function init() {
				add_action( 'init', array( $this, 'register_option_pages' ) );

		// https://www.advancedcustomfields.com/resources/local-json/
		add_filter( 'acf/settings/save_json', array( $this, 'save_acf_json' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'load_acf_json' ) );
	}

	public function register_option_pages() {
		if ( function_exists( 'acf_add_options_page' ) ) {

			$option_page_args = array(

				/* (string) The title displayed on the options page. Required. */
				'page_title'  => __( 'RKKR Options', 'rkkr-plugin' ),

				/* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
				'menu_title'  => '',

				/* (string) The slug name to refer to this menu by (should be unique for this menu).
				Defaults to a url friendly version of menu_slug */
				'menu_slug'   => 'rkkr-site-options',

				/* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
				Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
				'capability'  => 'edit_posts',

				/* (int|string) The position in the menu order this menu should appear.
				WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
				Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
				Defaults to bottom of utility menu items */
				'position'    => 24,

				/* (string) The slug of another WP admin page. if set, this will become a child page. */
				'parent_slug' => '',

				/* (string) The icon url for this menu. Defaults to default WordPress gear */
				'icon_url'    => 'dashicons-admin-generic',

				/* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
				If set to false, this parent page will appear alongside any child pages. Defaults to true */
				'redirect'    => true,

				/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
				Defaults to 'options'. Added in v5.2.7 */
				'post_id'     => 'options',

				/* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
				Defaults to false. Added in v5.2.8. */
				'autoload'    => false,

			);

			acf_add_options_page( $option_page_args );


		}


	}

	public function save_acf_json(  ) {
		// update path
		$path = trailingslashit( RKKR_PLUGIN_PATH ) . trailingslashit( 'acf-json' );

		// return
		return $path;
	}

	function load_acf_json( $paths ) {
		// append path
		$paths[] = trailingslashit( RKKR_PLUGIN_PATH ) . trailingslashit( 'acf-json' );;

		// return
		return $paths;

	}


}