<?php

/*

Plugin Name: Report System

Description:

Version: 1.0.0

Author: Bader Almutairi

Text Domain: Report System

*/

define('ROOTDIR_Report_System', plugin_dir_path(__FILE__));

function my_admin_menu() {
add_menu_page( 'Report_System', 'Report System', 'manage_options', 'report_system', 'Report_System', 'dashicons-media-document' );
add_submenu_page( 'report_system', 'Donor Report', 'Donor Report', 'manage_options', 'report_system', 'donor_page' );
add_submenu_page( 'report_system', 'Lister Report', 'Lister Report', 'manage_options', 'Lister_Report', 'lister_page' );
}


add_action( 'admin_menu', 'my_admin_menu' );






require_once(ROOTDIR_Report_System . 'include/DonorReport.php');
require_once(ROOTDIR_Report_System . 'include/ListerReport.php');

?>
