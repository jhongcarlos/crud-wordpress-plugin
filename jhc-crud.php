<?php
/**
* Plugin Name: Manage Branches
* Plugin URI: http://localhost/test_booking/
* Description: A plugin that allows you to add, edit, delete and view a data in database.
* Version: 1.0
* Author: John Harold Carlos
* Author URI: http://localhost/test_booking/
**/

add_action('init', function(){

	include dirname(__FILE__) . '/includes/class-jhc-admin-menu.php';
	include dirname(__FILE__) . '/includes/class-jhccrud-list-table.php';
	include dirname(__FILE__) . '/includes/class-form-handler.php';
	include dirname(__FILE__) . '/includes/jhccrud-functions.php';

	new jhc_admin_menu();
});