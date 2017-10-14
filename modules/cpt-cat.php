<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Rkkr_Cpt_Cat
 *
 * Handles aspects of the cat
 *
 */
class Rkkr_Cpt_Cat {

	public static $cpt = 'rkkr-cat';


	public function __construct() {
		// Not auto-contructing, use the init() method
	}


	public function init() {
		// Registers post_types and custom columns
		add_action( 'init', array( $this, 'setup_post_type' ) );


		add_action( 'init', array( $this, 'prepopulate_cat_taxonomies' ) );

		// tell Divi about us

		add_filter( 'et_builder_post_types', arraY( $this, 'add_cpt_to_divi' ) );

	}


	public function setup_post_type() {

		// Registers our custom taxonomies for the Cat CPT
		$this->register_tax();

		// Registers gthe CPT itself
		$this->register_cpt();

		// Adds columns to make the Cats easier to manage in the back-end
		$this->setup_custom_columns();
	}


	public function register_tax() {

		/*
		 * Breed
		 * 
		 * PetFinder equivalent = breed
		 */
		$labels = array(
			'name'                       => _x( 'Cat Breeds', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Cat Breed', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Cat Breeds', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Cat Breeds', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Cat Breed', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Cat Breed:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Cat Breed Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Cat Breed', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Cat Breed', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Cat Breed', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Cat Breed', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Cat Breeds', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cat Breeds', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Cat Breeds', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Cat Breeds', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Cat Breeds', 'rkkr-plugin' ),
			'items_list'                 => __( 'Cat Breeds list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Cat Breeds list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-breeds', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_breeds', array( self::$cpt ), $args );


		/*
		 * Colours
		 *
		 * PetFinder equivalent = [none]
		 */
		$labels = array(
			'name'                       => _x( 'Cat Colours', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Cat Colour', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Cat Colours', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Cat Colours', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Cat Colour', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Cat Colour:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Cat Colour Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Cat Colour', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Cat Colour', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Cat Colour', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Cat Colour', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Cat Colours', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cat Colours', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Cat Colours', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Cat Colours', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Cat Colours', 'rkkr-plugin' ),
			'items_list'                 => __( 'Cat Colours list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Cat Colours list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-colours', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_colours', array( self::$cpt ), $args );


		/*
		 * Gender
		 *
		 * PetFinder equivalent = gender
		 */
		$labels = array(
			'name'                       => _x( 'Cat Genders', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Cat Gender', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Cat Genders', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Cat Genders', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Cat Gender', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Cat Gender:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Cat Gender Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Cat Gender', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Cat Gender', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Cat Gender', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Cat Gender', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Cat Genders', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cat Genders', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Cat Genders', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Cat Genders', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Cat Genders', 'rkkr-plugin' ),
			'items_list'                 => __( 'Cat Genders list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Cat Genders list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-genders', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_genders', array( self::$cpt ), $args );


		/*
		 * Age
		 *
		 * PetFinder equivalent = age
		 */

		$labels = array(
			'name'                       => _x( 'Cat Ages', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Cat Age', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Cat Ages', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Cat Ages', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Cat Age', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Cat Age:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Cat Age Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Cat Age', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Cat Age', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Cat Age', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Cat Age', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Cat Ages', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cat Ages', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Cat Ages', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Cat Ages', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Cat Ages', 'rkkr-plugin' ),
			'items_list'                 => __( 'Cat Ages list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Cat Ages list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-ages', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_ages', array( self::$cpt ), $args );




		$labels = array(
			'name'                       => _x( 'Adoption Statuses', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Adoption Status', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Adoption Statuses', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Adoption Statuses', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Adoption Status', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Adoption Status:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Adoption Status Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Adoption Status', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Adoption Status', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Adoption Status', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Adoption Status', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Adoption Statuses', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Adoption Statuses', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Adoption Statuses', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Adoption Statuses', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Adoption Statuses', 'rkkr-plugin' ),
			'items_list'                 => __( 'Adoption Statuses list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Adoption Statuses list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-adoption-statuses', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_adoption_statuses', array( self::$cpt ), $args );


		$labels = array(
			'name'                       => _x( 'Cat Sizes', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Cat Size', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Cat Sizes', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Cat Sizes', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Cat Size', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Cat Size:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Cat Size Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Cat Size', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Cat Size', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Cat Size', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Cat Size', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Cat Sizes', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cat Sizes', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Cat Sizes', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Cat Sizes', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Cat Sizes', 'rkkr-plugin' ),
			'items_list'                 => __( 'Cat Sizes list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Cat Sizes list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-sizes', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_sizes', array( self::$cpt ), $args );







		$labels = array(
			'name'                       => _x( 'Coat Lengths', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Coat Length', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Coat Lengths', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Coat Lengths', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Coat Length', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Coat Length:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Coat Length Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Coat Length', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Coat Length', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Coat Length', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Coat Length', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Coat Lengths', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Coat Lengths', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Coat Lengths', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Coat Lengths', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Coat Lengths', 'rkkr-plugin' ),
			'items_list'                 => __( 'Coat Lengths list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Coat Lengths list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-coat-lengths', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_coat_lengths', array( self::$cpt ), $args );






		$labels = array(
			'name'                       => _x( 'Personalities', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Personality', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Personalities', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Personalities', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Personality', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Personality:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Personality Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Personality', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Personality', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Personality', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Personality', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Personalities', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Personalities', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Personalities', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Personalities', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Personalities', 'rkkr-plugin' ),
			'items_list'                 => __( 'Personalities list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Personalities list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-personalities', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_personalities', array( self::$cpt ), $args );




		$labels = array(
			'name'                       => _x( 'Spayed/Neutered', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Spayed/Neutered', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Spayed/Neutered', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Spayed/Neutered', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Spayed/Neutered', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Spayed/Neutered:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Spayed/Neutered Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Spayed/Neutered', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Spayed/Neutered', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Spayed/Neutered', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Spayed/Neutered', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Spayed/Neutered', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Spayed/Neutered', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Spayed/Neutered', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Spayed/Neutered', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Spayed/Neutered', 'rkkr-plugin' ),
			'items_list'                 => __( 'Spayed/Neutered list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Spayed/Neutered list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-spayed', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_spayed', array( self::$cpt ), $args );

		$labels = array(
			'name'                       => _x( 'Current on vaccinations', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Current on vaccinations', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Current on vaccinations', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Current on vaccinations', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Current on vaccinations', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Current on vaccinations:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Current on vaccinations Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Current on vaccinations', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Current on vaccinations', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Current on vaccinations', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Current on vaccinations', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Current on vaccinations', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Current on vaccinations', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Current on vaccinations', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Current on vaccinations', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Current on vaccinations', 'rkkr-plugin' ),
			'items_list'                 => __( 'Current on vaccinations list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Current on vaccinations list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-vaccinations', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_vaccinations', array( self::$cpt ), $args );


		$labels = array(
			'name'                       => _x( 'Special needs', 'Taxonomy General Name', 'rkkr-plugin' ),
			'singular_name'              => _x( 'Special needs', 'Taxonomy Singular Name', 'rkkr-plugin' ),
			'menu_name'                  => __( 'Special needs', 'rkkr-plugin' ),
			'all_items'                  => __( 'All Special needs', 'rkkr-plugin' ),
			'parent_item'                => __( 'Parent Special needs', 'rkkr-plugin' ),
			'parent_item_colon'          => __( 'Parent Special needs:', 'rkkr-plugin' ),
			'new_item_name'              => __( 'New Special needs Name', 'rkkr-plugin' ),
			'add_new_item'               => __( 'Add New Special needs', 'rkkr-plugin' ),
			'edit_item'                  => __( 'Edit Special needs', 'rkkr-plugin' ),
			'update_item'                => __( 'Update Special needs', 'rkkr-plugin' ),
			'view_item'                  => __( 'View Special needs', 'rkkr-plugin' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'rkkr-plugin' ),
			'add_or_remove_items'        => __( 'Add or remove Special needs', 'rkkr-plugin' ),
			'choose_from_most_used'      => __( 'Choose from the most used Special needs', 'rkkr-plugin' ),
			'popular_items'              => __( 'Popular Special needs', 'rkkr-plugin' ),
			'search_items'               => __( 'Search Special needs', 'rkkr-plugin' ),
			'not_found'                  => __( 'Not Found', 'rkkr-plugin' ),
			'no_terms'                   => __( 'No Special needs', 'rkkr-plugin' ),
			'items_list'                 => __( 'Special needs list', 'rkkr-plugin' ),
			'items_list_navigation'      => __( 'Special needs list navigation', 'rkkr-plugin' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => _x( 'cat-special-needs', 'Slug for the Custom taxonomy URL', 'rkkr-plugin' ) ),
		);
		register_taxonomy( 'rkkr_cat_special_needs', array( self::$cpt ), $args );
	}


	public function register_cpt() {
		$labels  = array(
			'name'                  => _x( 'Cats', 'Post Type General Name', 'rkkr-plugin' ),
			'singular_name'         => _x( 'Cat', 'Post Type Singular Name', 'rkkr-plugin' ),
			'menu_name'             => __( 'Cats', 'rkkr-plugin' ),
			'name_admin_bar'        => __( 'Cat', 'rkkr-plugin' ),
			'archives'              => __( 'Cat Archives', 'rkkr-plugin' ),
			'parent_item_colon'     => __( 'Parent Cat:', 'rkkr-plugin' ),
			'all_items'             => __( 'All Cats', 'rkkr-plugin' ),
			'add_new_item'          => __( 'Add New Cat', 'rkkr-plugin' ),
			'add_new'               => _x( 'Add New Cat', 'Add New -> Cats', 'rkkr-plugin' ),
			'new_item'              => __( 'New Cat', 'rkkr-plugin' ),
			'edit_item'             => __( 'Edit Cat', 'rkkr-plugin' ),
			'update_item'           => __( 'Update Cat', 'rkkr-plugin' ),
			'view_item'             => __( 'View Cat', 'rkkr-plugin' ),
			'search_items'          => __( 'Search Cat', 'rkkr-plugin' ),
			'not_found'             => __( 'Not found', 'rkkr-plugin' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'rkkr-plugin' ),
			'featured_image'        => __( 'Featured Image', 'rkkr-plugin' ),
			'set_featured_image'    => __( 'Set featured image', 'rkkr-plugin' ),
			'remove_featured_image' => __( 'Remove featured image', 'rkkr-plugin' ),
			'use_featured_image'    => __( 'Use as featured image', 'rkkr-plugin' ),
			'insert_into_item'      => __( 'Insert into cat', 'rkkr-plugin' ),
			'uploaded_to_this_item' => __( 'Uploaded to this cat', 'rkkr-plugin' ),
			'items_list'            => __( 'Cats list', 'rkkr-plugin' ),
			'items_list_navigation' => __( 'Cats list navigation', 'rkkr-plugin' ),
			'filter_items_list'     => __( 'Filter cat list', 'rkkr-plugin' ),
		);
		$rewrite = array(
			'slug'       => _x( 'cats', 'Slug for Cats CPT', 'rkkr-plugin' ),
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Cat', 'rkkr-plugin' ),
			'description'         => __( 'Cats CPT', 'rkkr-plugin' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'excerpt',
				'revisions',
				'thumbnail',
			),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'data:image/svg+xml;base64,' . base64_encode( '<svg  width="20" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path  fill="black" d="M844 472q0 60-19 113.5t-63 92.5-105 39q-76 0-138-57.5t-92-135.5-30-151q0-60 19-113.5t63-92.5 105-39q77 0 138.5 57.5t91.5 135 30 151.5zm-342 483q0 80-42 139t-119 59q-76 0-141.5-55.5t-100.5-133.5-35-152q0-80 42-139.5t119-59.5q76 0 141.5 55.5t100.5 134 35 152.5zm394-27q118 0 255 97.5t229 237 92 254.5q0 46-17 76.5t-48.5 45-64.5 20-76 5.5q-68 0-187.5-45t-182.5-45q-66 0-192.5 44.5t-200.5 44.5q-183 0-183-146 0-86 56-191.5t139.5-192.5 187.5-146 193-59zm239-211q-61 0-105-39t-63-92.5-19-113.5q0-74 30-151.5t91.5-135 138.5-57.5q61 0 105 39t63 92.5 19 113.5q0 73-30 151t-92 135.5-138 57.5zm432-104q77 0 119 59.5t42 139.5q0 74-35 152t-100.5 133.5-141.5 55.5q-77 0-119-59t-42-139q0-74 35-152.5t100.5-134 141.5-55.5z"/></svg>' ),
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true, // _x( 'cats', 'rkkr-plugin' ),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'taxonomies'          => array(),
		);
		register_post_type( self::$cpt, $args );
		
		
		
		
		
		
		
		
		
	}


	public function setup_custom_columns() {
		// https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$post_type_posts_columns
		add_filter( 'manage_' . self::$cpt . '_posts_columns', array(
			$this,
			'set_custom_columns',
		) );

		// https://codex.wordpress.org/Plugin_API/Action_Reference/manage_$post_type_posts_custom_column
		add_action( 'manage_' . self::$cpt . '_posts_custom_column', array(
			$this,
			'display_custom_columns',
		), 10, 2 );
	}


	public function set_custom_columns( $columns ) {
		unset( $columns['date'] );

		// stick a thumb before the title
		$columns_out = array_slice( $columns, 0, 1, true ) +
		               array( 'thumb' => __( 'Thumbnail', 'rkkr-plugin' ) ) +
		               array_slice( $columns, 1, count( $columns ) - 1, true );


		return $columns_out;
	}


	public function display_custom_columns( $column, $post_id ) {

		switch ( $column ) {
			case 'thumb' :
				if ( has_post_thumbnail( $post_id ) ) {

					$thumbnail_url = get_the_post_thumbnail_url( $post_id, 'thumb' );

					echo '<image class="cat-thumbnail" style="max-width: 50px; height: auto;" src="' . esc_url( $thumbnail_url ) . '" />';

				}
				break;

		}
	}


	public function prepopulate_cat_taxonomies() {
		$option_name = 'rkkr-prepulated-taxonomies';

		$already_run = get_option( $option_name, false );

		if ( $already_run ) {
			return;
		}


		/*
		 * rkkr_cat_breeds
		 * based on petfinder http://api.petfinder.com/schemas/0.9/petfinder.xsd
		 */

		$cat_breeds = array(
			'Abyssinian',
			'American Curl',
			'American Shorthair',
			'American Wirehair',
			'Applehead Siamese',
			'Balinese',
			'Bengal',
			'Birman',
			'Bobtail',
			'Bombay',
			'British Shorthair',
			'Burmese',
			'Burmilla',
			'Calico',
			'Canadian Hairless',
			'Chartreux',
			'Chausie',
			'Chinchilla',
			'Cornish Rex',
			'Cymric',
			'Devon Rex',
			'Dilute Calico',
			'Dilute Tortoiseshell',
			'Domestic Long Hair',
			'Domestic Long Hair - brown',
			'Domestic Long Hair - buff',
			'Domestic Long Hair - buff and white',
			'Domestic Long Hair - gray and white',
			'Domestic Long Hair - orange',
			'Domestic Long Hair - orange and white',
			'Domestic Long Hair-black',
			'Domestic Long Hair-black and white',
			'Domestic Long Hair-gray',
			'Domestic Long Hair-white',
			'Domestic Medium Hair',
			'Domestic Medium Hair - brown',
			'Domestic Medium Hair - buff',
			'Domestic Medium Hair - buff and white',
			'Domestic Medium Hair - gray and white',
			'Domestic Medium Hair - orange and white',
			'Domestic Medium Hair-black',
			'Domestic Medium Hair-black and white',
			'Domestic Medium Hair-gray',
			'Domestic Medium Hair-orange',
			'Domestic Medium Hair-white',
			'Domestic Short Hair',
			'Domestic Short Hair - brown',
			'Domestic Short Hair - buff',
			'Domestic Short Hair - buff and white',
			'Domestic Short Hair - gray and white',
			'Domestic Short Hair - orange and white',
			'Domestic Short Hair-black',
			'Domestic Short Hair-black and white',
			'Domestic Short Hair-gray',
			'Domestic Short Hair-mitted',
			'Domestic Short Hair-orange',
			'Domestic Short Hair-white',
			'Egyptian Mau',
			'Exotic Shorthair',
			'Extra-Toes Cat (Hemingway Polydactyl)',
			'Havana',
			'Himalayan',
			'Japanese Bobtail',
			'Javanese',
			'Korat',
			'LaPerm',
			'Maine Coon',
			'Manx',
			'Munchkin',
			'Nebelung',
			'Norwegian Forest Cat',
			'Ocicat',
			'Oriental Long Hair',
			'Oriental Short Hair',
			'Oriental Tabby',
			'Persian',
			'Pixie-Bob',
			'Ragamuffin',
			'Ragdoll',
			'Russian Blue',
			'Scottish Fold',
			'Selkirk Rex',
			'Siamese',
			'Siberian',
			'Silver',
			'Singapura',
			'Snowshoe',
			'Somali',
			'Sphynx (hairless cat)',
			'Tabby',
			'Tabby - black',
			'Tabby - Brown',
			'Tabby - buff',
			'Tabby - Grey',
			'Tabby - Orange',
			'Tabby - white',
			'Tiger',
			'Tonkinese',
			'Torbie',
			'Tortoiseshell',
			'Turkish Angora',
			'Turkish Van',
			'Tuxedo',
		);

		foreach ( $cat_breeds as $cat_breed ) {
			wp_insert_term( $cat_breed, 'rkkr_cat_breeds' );

		}

		$cat_genders = array(
			'Male',
			'Female',
			'Unknown',
		);

		foreach ( $cat_genders as $cat_gender ) {
			wp_insert_term( $cat_gender, 'rkkr_cat_genders' );
		}


		$cat_ages = array(
			'Baby',
			'Young',
			'Adult',
			'Senior',
		);

		foreach ( $cat_ages as $cat_age ) {
			wp_insert_term( $cat_age, 'rkkr_cat_ages' );
		}


		update_option( $option_name, true, true );
	}

	public function add_cpt_to_divi( $post_types ) {
		$post_types[] = self::$cpt;

		return $post_types;

	}


}