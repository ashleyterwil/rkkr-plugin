<?php
/**
 *                         _
 *                        | \
 *                        | |
 *                        | |
 *   |\                   | |
 *  /, ~\                / /
 * X     `-.....-------./ /
 *  ~-. ~  ~              |
 *     \             /    |
 *      \  /_     ___\   /
 *      | /\ ~~~~~    \ |
 *      | | \        || |
 *      | |\ \       || )
 *     (_/ (_/      ((_/
 */

/* Plugin Name: Refuge Kitty-Kat Rescue
*  Plugin URI: http://refugekittykat.com/
*  Description: Functionakitty plugin for the RKKR site
*  Version: 1.0.0
*  Author: do_action Team RKKR
*  Author URI: https://doaction.org/event/montreal-2017/
*  Text Domain: rkkr-plugin
*  Domain Path: /languages
 */


define( 'RKKR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RKKR_PLUGIN_URI', plugin_dir_url( __FILE__ ) );


/*
 * Helps with the Cat CPT
 */
include_once 'modules/cpt-cat.php';
$rkkr_cpt_cat = new Rkkr_Cpt_Cat();
$rkkr_cpt_cat->init();


/*
 * Helps us keep the ACF fields synchronised
 *
 * Turn off if it becomes a problem / battle between webmasters / devs
 */
include_once 'modules/acf-helpers.php';
$rkkr_acf_helpers = new Rkkr_Acf_Helpers();
$rkkr_acf_helpers->init();