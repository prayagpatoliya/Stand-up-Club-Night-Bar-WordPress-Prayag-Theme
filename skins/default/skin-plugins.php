<?php
/**
 * Required plugins
 *
 * @package THEGIG
 * @since THEGIG 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$thegig_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'thegig' ),
	'page_builders' => esc_html__( 'Page Builders', 'thegig' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'thegig' ),
	'socials'       => esc_html__( 'Socials and Communities', 'thegig' ),
	'events'        => esc_html__( 'Events and Appointments', 'thegig' ),
	'content'       => esc_html__( 'Content', 'thegig' ),
	'other'         => esc_html__( 'Other', 'thegig' ),
);
$thegig_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'thegig' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'thegig' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $thegig_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'thegig' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'thegig' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $thegig_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'thegig' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'thegig' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $thegig_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'thegig' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'thegig' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $thegig_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'thegig' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'thegig' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $thegig_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'thegig' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'thegig' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $thegig_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'thegig' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'thegig' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $thegig_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'thegig' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'thegig' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $thegig_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $thegig_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'thegig' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $thegig_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'thegig' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'thegig' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => thegig_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $thegig_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'thegig' ),
		'description' => '',
		'required'    => false,
		'logo'        => thegig_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => thegig_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'thegig' ),
		'description' => '',
		'required'    => false,
		'logo'        => thegig_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $thegig_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => thegig_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $thegig_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => thegig_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'thegig' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'thegig' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'thegig' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'thegig' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $thegig_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'thegig' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'thegig' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $thegig_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'thegig' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'thegig' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $thegig_theme_required_plugins_groups['other'],
	),
);

if ( THEGIG_THEME_FREE ) {
	unset( $thegig_theme_required_plugins['js_composer'] );
	unset( $thegig_theme_required_plugins['booked'] );
	unset( $thegig_theme_required_plugins['the-events-calendar'] );
	unset( $thegig_theme_required_plugins['calculated-fields-form'] );
	unset( $thegig_theme_required_plugins['essential-grid'] );
	unset( $thegig_theme_required_plugins['revslider'] );
	unset( $thegig_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $thegig_theme_required_plugins['trx_updater'] );
	unset( $thegig_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
thegig_storage_set( 'required_plugins', $thegig_theme_required_plugins );
