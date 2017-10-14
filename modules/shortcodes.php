<?php


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Rkkr_Shortcodes {


	public static function cat_meta( $atts, $content = "" ) {
		$post_id = get_the_ID();

		$cat_breeds_out = array();
		$cat_breeds     = get_the_terms( $post_id, 'rkkr_cat_breeds' );
		if(!empty($cat_breeds)) {
			foreach ( $cat_breeds as $cat_breed ) {
				/* @var WP_Term $cat_breed  */
				$cat_breeds_out[] = $cat_breed->name;
			}
		}


		$cat_colours_out = array();
		$cat_colours     = get_the_terms( $post_id, 'rkkr_cat_colours' );
		if(!empty($cat_colours)) {
			foreach ( $cat_colours as $cat_colour ) {
				/* @var WP_Term $cat_colour  */
				$cat_colours_out[] = $cat_colour->name;
			}
		}

		$cat_genders_out = array();
		$cat_genders     = get_the_terms( $post_id, 'rkkr_cat_genders' );
		if(!empty($cat_genders)) {
			foreach ( $cat_genders as $cat_gender ) {
				/* @var WP_Term $cat_gender  */
				$cat_genders_out[] = $cat_gender->name;
			}
		}

		$cat_ages_out = array();
		$cat_ages     = get_the_terms( $post_id, 'rkkr_cat_ages' );
		if(!empty($cat_ages)) {
			foreach ( $cat_ages as $cat_age ) {
				/* @var WP_Term $cat_gender  */
				$cat_ages_out[] = $cat_age->name;
			}
		}


		return '			<div class="cat-meta">
							<div class="cat-meta-row cat-meta-breed">
								<span class="cat-meta-label">' . __( 'Breed:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode(', ', $cat_breeds_out) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-colour">
								<span class="cat-meta-label">' . __( 'Colour:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode(', ', $cat_colours_out) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-gender">
								<span class="cat-meta-label">' . __( 'Gender:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode(', ', $cat_genders_out) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-age">
								<span class="cat-meta-label">' . __( 'Age:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' .  implode(', ',  $cat_ages_out  ) . '</span>
							</div>
						</div>';
	}


	public static function donation_form( $atts, $content = "" ) {

		return '<script id="ch_cdn_embed" type="text/javascript" data-page-id="' . trim($atts['id']) . '" data-cfasync="false" src="https://www.canadahelps.org/services/wa/js/apps/donatenow/embed.min.js"></script>';

	}





}


// declare shortcodes
add_shortcode( 'rkkr_cat_meta', array( 'Rkkr_Shortcodes', 'cat_meta' ) );

// 
add_shortcode( 'rkkr_donation_form', array( 'Rkkr_Shortcodes', 'donation_form' ) );



