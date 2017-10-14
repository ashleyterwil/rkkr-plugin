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
		if ( ! empty( $cat_breeds ) ) {
			foreach ( $cat_breeds as $cat_breed ) {
				/* @var WP_Term $cat_breed */
				$cat_breeds_out[] = $cat_breed->name;
			}
		}


		$cat_colours_out = array();
		$cat_colours     = get_the_terms( $post_id, 'rkkr_cat_colours' );
		if ( ! empty( $cat_colours ) ) {
			foreach ( $cat_colours as $cat_colour ) {
				/* @var WP_Term $cat_colour */
				$cat_colours_out[] = $cat_colour->name;
			}
		}

		$cat_genders_out = array();
		$cat_genders     = get_the_terms( $post_id, 'rkkr_cat_genders' );
		if ( ! empty( $cat_genders ) ) {
			foreach ( $cat_genders as $cat_gender ) {
				/* @var WP_Term $cat_gender */
				$cat_genders_out[] = $cat_gender->name;
			}
		}

		$cat_ages_out = array();
		$cat_ages     = get_the_terms( $post_id, 'rkkr_cat_ages' );
		if ( ! empty( $cat_ages ) ) {
			foreach ( $cat_ages as $cat_age ) {
				/* @var WP_Term $cat_gender */
				$cat_ages_out[] = $cat_age->name;
			}
		}


		$cat_adoption_statuses_out = array();
		$cat_statuses    = get_the_terms( $post_id, 'rkkr_cat_adoption_statuses' );
		if ( ! empty( $cat_statuses ) ) {
			foreach ( $cat_statuses as $cat_status ) {
				/* @var WP_Term $cat_gender */
				$cat_adoption_statuses_out[] = $cat_status->name;
			}
		}



		$cat_sizes_out = array();
		$cat_sizes    = get_the_terms( $post_id, 'rkkr_cat_sizes' );
		if ( ! empty( $cat_sizes ) ) {
			foreach ( $cat_sizes as $cat_size ) {
				/* @var WP_Term $cat_gender */
				$cat_sizes_out[] = $cat_size->name;
			}
		}




		$cat_coats_out = array();
		$cat_coats    = get_the_terms( $post_id, 'rkkr_cat_coat_lengths' );
		if ( ! empty( $cat_coats ) ) {
			foreach ( $cat_coats as $cat_coat ) {
				/* @var WP_Term $cat_gender */
				$cat_coats_out[] = $cat_coat->name;
			}
		}


		$cat_personalities_out = array();
		$cat_personalities    = get_the_terms( $post_id, 'rkkr_cat_personalities' );
		if ( ! empty( $cat_personalities ) ) {
			foreach ( $cat_personalities as $cat_personality ) {
				/* @var WP_Term $cat_gender */
				$cat_personalities_out[] = $cat_personality->name;
			}
		}


		$cat_spayed_out = array();
		$cat_spayeds    = get_the_terms( $post_id, 'rkkr_cat_spayed' );
		if ( ! empty( $cat_spayeds ) ) {
			foreach ( $cat_spayeds as $cat_spayed ) {
				/* @var WP_Term $cat_gender */
				$cat_spayed_out[] = $cat_spayed->name;
			}
		}



		$cat_vaccinations_out = array();
		$cat_vaccinations    = get_the_terms( $post_id, 'rkkr_cat_vaccinations' );
		if ( ! empty( $cat_vaccinations ) ) {
			foreach ( $cat_vaccinations as $cat_vaccination ) {
				/* @var WP_Term $cat_gender */
				$cat_vaccinations_out[] = $cat_vaccination->name;
			}
		}




		$cat_special_needs_out = array();
		$cat_special_needs   = get_the_terms( $post_id, 'rkkr_cat_special_needs' );
		if ( ! empty( $cat_special_needs ) ) {
			foreach ( $cat_special_needs as $cat_special_need ) {
				/* @var WP_Term $cat_gender */
				$cat_special_needs_out[] = $cat_special_need->name;
			}
		}

		return '			<div class="cat-meta">
							<div class="cat-meta-row cat-meta-breed">
								<span class="cat-meta-label">' . __( 'Breed:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_breeds_out ) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-colour">
								<span class="cat-meta-label">' . __( 'Colour:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_colours_out ) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-gender">
								<span class="cat-meta-label">' . __( 'Gender:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_genders_out ) . '</span>
							</div>

							<div class="cat-meta-row cat-meta-adoption-status">
								<span class="cat-meta-label">' . __( 'Adoption Status:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_adoption_statuses_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-size">
								<span class="cat-meta-label">' . __( 'Size:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_sizes_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-coat">
								<span class="cat-meta-label">' . __( 'Coat:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_coats_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-personality">
								<span class="cat-meta-label">' . __( 'Personality:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_personalities_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-spayed">
								<span class="cat-meta-label">' . __( 'Spayed/Neutered:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_spayed_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-vaccinations">
								<span class="cat-meta-label">' . __( 'Current on Vaccinations:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_vaccinations_out ) . '</span>
							</div>
							
									<div class="cat-meta-row cat-meta-special-needs">
								<span class="cat-meta-label">' . __( 'Special Needs:', 'rkkr-plugin' ) . '</span>
								<span class="cat-meta-value">' . implode( ', ', $cat_special_needs_out ) . '</span>
							</div>
						</div>';
	}


	public static function donation_form( $atts, $content = "" ) {

		$locale   = get_locale();
		$language = 'en';
		if ( in_array( $locale, array( 'fr_CA', 'fr_FR' ) )!== false  ) {
			$language = 'fr';
		}

		return '<script id="ch_cdn_embed" type="text/javascript" data-page-id="' . trim( $atts['id'] ) . '" data-language="' . $language . '" data-cfasync="false" src="https://www.canadahelps.org/services/wa/js/apps/donatenow/embed.min.js"></script>';

	}


}


// declare shortcodes
add_shortcode( 'rkkr_cat_meta', array( 'Rkkr_Shortcodes', 'cat_meta' ) );

// 
add_shortcode( 'rkkr_donation_form', array( 'Rkkr_Shortcodes', 'donation_form' ) );



