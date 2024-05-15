<?php
/**
 * Plugin Name:       jl_Contact
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       contact
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_contact_block_init() {
	register_block_type( __DIR__ . '/build' );
}
function jl_init_db_table()
{
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	global $wpdb;
	$table_name = $wpdb->prefix. 'jl_contact';
	
	$ddl ="CREATE TABLE $table_name (
		id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
		email VARCHAR(255) DEFAULT '' NOT NULL,
		PRIMARY KEY(id)
	)";	
	maybe_create_table($table_name , $ddl );
}


register_activation_hook(__FILE__, 'jl_init_db_table' );


function add_contact(){
	$_POST= filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$email= $_POST['email'];
	echo $email;
}


add_action( 'init', 'create_block_contact_block_init' );
add_action('wp_ajax_jl_contact_form', 'add_contact');
add_action('wp_ajax_no_priv_jl_contact_form', 'add_contact');
