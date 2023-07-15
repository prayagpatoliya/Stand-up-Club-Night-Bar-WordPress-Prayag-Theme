<?php
/* TI WooCommerce Wishlist support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('thegig_wishlist_theme_setup9')) {
	add_action( 'after_setup_theme', 'thegig_wishlist_theme_setup9', 9 );
	function thegig_wishlist_theme_setup9() {
		if (is_admin()) {
			add_filter( 'thegig_filter_tgmpa_required_plugins',		'thegig_wishlist_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'thegig_wishlist_tgmpa_required_plugins' ) ) {
	function thegig_wishlist_tgmpa_required_plugins($list=array()) {
		if (thegig_storage_isset('required_plugins', 'ti-woocommerce-wishlist') && thegig_storage_get_array( 'required_plugins', 'ti-woocommerce-wishlist', 'install' ) !== false) {
			$list[] = array(
				'name' 		=> thegig_storage_get_array('required_plugins', 'ti-woocommerce-wishlist', 'title'),
				'slug' 		=> 'ti-woocommerce-wishlist',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'thegig_exists_wishlist' ) ) {
	function thegig_exists_wishlist() {
		return function_exists('activation_tinv_wishlist');
	}
}


// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'thegig_wishlist_importer_required_plugins' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins',	'thegig_wishlist_importer_required_plugins', 10, 2 );
    function thegig_wishlist_importer_required_plugins($not_installed='', $list='') {
        if (strpos($list, 'ti-woocommerce-wishlist')!==false && !thegig_exists_wishlist() )
            $not_installed .= '<br>' . esc_html__('WooCommerce Wishlist', 'thegig');
        return $not_installed;
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'thegig_wishlist_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',	'thegig_wishlist_importer_set_options' );
    function thegig_wishlist_importer_set_options($options=array()) {
        if ( thegig_exists_wishlist() && in_array('ti-woocommerce-wishlist', $options['required_plugins']) ) {
            $options['additional_options'][] = 'tinvwl-%';
        }
        return $options;
    }
}


?>