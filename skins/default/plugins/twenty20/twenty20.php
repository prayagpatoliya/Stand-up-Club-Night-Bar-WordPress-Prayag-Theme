<?php
/* Twenty20 Image Before-After support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('thegig_twenty20_theme_setup9')) {
	add_action( 'after_setup_theme', 'thegig_twenty20_theme_setup9', 9 );
	function thegig_twenty20_theme_setup9() {
		if (is_admin()) {
			add_filter( 'thegig_filter_tgmpa_required_plugins',		'thegig_twenty20_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'thegig_twenty20_tgmpa_required_plugins' ) ) {
	function thegig_twenty20_tgmpa_required_plugins($list=array()) {
		if (thegig_storage_isset('required_plugins', 'twenty20') && thegig_storage_get_array( 'required_plugins', 'twenty20', 'install' ) !== false) {
			$list[] = array(
				'name' 		=> thegig_storage_get_array('required_plugins', 'twenty20', 'title'),
				'slug' 		=> 'twenty20',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'thegig_exists_twenty20' ) ) {
	function thegig_exists_twenty20() {
		return function_exists('twenty20_dir_init');
	}
}

?>