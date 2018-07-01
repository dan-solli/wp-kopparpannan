<?php 
    /*
    Plugin Name: Kopparpannan's Whisky Handler
    Plugin URI: http://www.dansolli.com
    Description: Plugin for handling relations and Kopparpannan specific stuff. 
    Author: D. Solli
    Version: 0.1
    Author URI: http://www.dansolli.se
    */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));

register_activation_hook( __FILE__, 'kopparpannan_create_tables' );

function kopparpannan_create_tables() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	
	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';

	$sql = "CREATE TABLE $table_name (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		event bigint(20) NOT NULL,
		whisky bigint(20) NOT NULL,
		registered_by bigint(20) NOT NULL,
		registered datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		betyg decimal(3,2) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;\n";

	$table_name = $wpdb->prefix . 'kopparpannan_anmalningar';

	$sql .= "CREATE TABLE $table_name (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		event bigint(20) NOT NULL,
		user bigint(20) NOT NULL,
		registered datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;\n";

	$table_name = $wpdb->prefix . 'kopparpannan_gast_anmalningar';

	$sql .= "CREATE TABLE $table_name (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		event bigint(20) NOT NULL,
		invited_by_user bigint(20) NOT NULL,
		guest_name varchar(80) NOT NULL,
		guest_email varchar(200),
		registered datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;\n";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function add_whiskybetyg($event_id, $whisky_id, $betyg) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';
	$wpdb->insert($table_name, array(
		'event' => $event_id,
		'whisky' => $whisky_id,
		'registered_by' => get_current_user_id(),
		'registered' => 'now()',
		'betyg' => $betyg
	));
}

function add_event_anmalan($event_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_anmalningar';
	$wpdb->insert($table_name, array(
		'event' => $event_id,
		'user' => get_current_user_id(),
		'registered' => 'now()',
	));
}

function add_event_guest_anmalan($event_id, $guest_name, $guest_contact) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_gast_anmalningar';
	$wpdb->insert($table_name, array(
		'event' => $event_id,
		'invited_by_user' => get_current_user_id(),
		'guest_name' => $guest_name,
		'guest_email' => $guest_contact,
		'registered' => 'now()',
	)); 
}

function get_whiskybetyg($whisky_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';
	return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE whisky = %d", $whisky_id), ARRAY_A);
}

function get_whisky_toplist() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';
	return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY betyg DESC"), ARRAY_A);
}

function get_event_whisky($event_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';
	return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE event = %d", $event_id), ARRAY_A);
}

function get_event_anmalan($event_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_anmalningar';
	return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE event = %d", $event_id), ARRAY_A);
}

function is_signed_up($event_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_anmalningar';
	$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE event = %d AND user = %s", $event_id, get_current_user_id()), ARRAY_A);
	return count($result) != 0;
}

function get_event_guest_anmalan($event_id, $user_id = NULL) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_gast_anmalningar';
	if ($user_id == NULL) {
		return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE event = %d", $event_id), ARRAY_A);
	} else {
		return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE event = %d and invited_by_user = %d", $event_id, $user_id), ARRAY_A);
	}
}

function get_alla_anmalan($event_id) {
	global $wpdb;

	return $wpdb->get_results($wpdb->prepare(
		"SELECT id, event, user, '' AS guest_name, '' AS guest_contact, registered FROM wp_kopparpannan_anmalningar WHERE id = %d
			UNION ALL
			SELECT id, event, invited_by_user, guest_name, guest_email, registered FROM wp_kopparpannan_gast_anmalningar WHERE id = %d", $event_id, $event_id), ARRAY_A);
}

function remove_whiskybetyg($betyg_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_whiskybetyg';
	$wpdb->query("DELETE FROM $table_name WHERE id = $betyg_id");
}

function remove_event_anmalan($anmalan_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_anmalningar';
	$wpdb->query("DELETE FROM $table_name WHERE id = $anmalan_id");
}

function remove_event_guest_anmalan($anmalan_id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'kopparpannan_gast_anmalningar';
	$wpdb->query("DELETE FROM $table_name WHERE id = $anmalan_id");
}

/////////////////////////////////////////////////////////////////////

function calculate_signups($id) {
	global $wpdb;

	$result = $wpdb->get_results($wpdb->prepare(
		"SELECT (SELECT COUNT(a.user) FROM wp_kopparpannan_anmalningar a WHERE a.event = %d) AS medlemmar, (SELECT COUNT(g.invited_by_user) FROM wp_kopparpannan_gast_anmalningar g WHERE g.event = %d) AS gaster", $id, $id));
	$result = $result[0];
	if ($result->gaster < 1) {
		echo $result->medlemmar;
	} else {
		echo $result->medlemmar . " + " . $result->gaster; 
	}
}

?>