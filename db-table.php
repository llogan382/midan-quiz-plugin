<?php
global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name1 = $wpdb->prefix . 'mdn_social_quizzes';
	$table_name2 = $wpdb->prefix . 'mdn_social_questions';


	$charset_collate = $wpdb->get_charset_collate();

	$sql1 = "CREATE TABLE $table_name1 (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

$sql2 = "CREATE TABLE $table_name2 (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	question mediumint(9) NOT NULL AUTO_INCREMENT,
	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	name tinytext NOT NULL,
	text text NOT NULL,
	url varchar(55) DEFAULT '' NOT NULL,
	PRIMARY KEY  (id)
) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql1 );
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql2 );


	add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
	global $wpdb;

	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';

	$table_name = $wpdb1->prefix . 'liveshoutbox';

	$wpdb1->insert(
		$table_name,
		array(
			'time' => current_time( 'mysql' ),
			'quiz_title' => $welcome_name,
			'text' => $welcome_text,
		)
	);

	$wpdb2->insert(
		$table_name,
		array(
			'time' => current_time( 'mysql' ),
			'quiz_title' => $welcome_name,
			'text' => $welcome_text,
		)
	);
}


