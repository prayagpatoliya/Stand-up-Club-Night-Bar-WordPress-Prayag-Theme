<div class="front_page_section front_page_section_team<?php
	$thegig_scheme = thegig_get_theme_option( 'front_page_team_scheme' );
	if ( ! empty( $thegig_scheme ) && ! thegig_is_inherit( $thegig_scheme ) ) {
		echo ' scheme_' . esc_attr( $thegig_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( thegig_get_theme_option( 'front_page_team_paddings' ) );
	if ( thegig_get_theme_option( 'front_page_team_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$thegig_css      = '';
		$thegig_bg_image = thegig_get_theme_option( 'front_page_team_bg_image' );
		if ( ! empty( $thegig_bg_image ) ) {
			$thegig_css .= 'background-image: url(' . esc_url( thegig_get_attachment_url( $thegig_bg_image ) ) . ');';
		}
		if ( ! empty( $thegig_css ) ) {
			echo ' style="' . esc_attr( $thegig_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$thegig_anchor_icon = thegig_get_theme_option( 'front_page_team_anchor_icon' );
	$thegig_anchor_text = thegig_get_theme_option( 'front_page_team_anchor_text' );
if ( ( ! empty( $thegig_anchor_icon ) || ! empty( $thegig_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_team"'
									. ( ! empty( $thegig_anchor_icon ) ? ' icon="' . esc_attr( $thegig_anchor_icon ) . '"' : '' )
									. ( ! empty( $thegig_anchor_text ) ? ' title="' . esc_attr( $thegig_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_team_inner
	<?php
	if ( thegig_get_theme_option( 'front_page_team_fullheight' ) ) {
		echo ' thegig-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$thegig_css      = '';
			$thegig_bg_mask  = thegig_get_theme_option( 'front_page_team_bg_mask' );
			$thegig_bg_color_type = thegig_get_theme_option( 'front_page_team_bg_color_type' );
			if ( 'custom' == $thegig_bg_color_type ) {
				$thegig_bg_color = thegig_get_theme_option( 'front_page_team_bg_color' );
			} elseif ( 'scheme_bg_color' == $thegig_bg_color_type ) {
				$thegig_bg_color = thegig_get_scheme_color( 'bg_color', $thegig_scheme );
			} else {
				$thegig_bg_color = '';
			}
			if ( ! empty( $thegig_bg_color ) && $thegig_bg_mask > 0 ) {
				$thegig_css .= 'background-color: ' . esc_attr(
					1 == $thegig_bg_mask ? $thegig_bg_color : thegig_hex2rgba( $thegig_bg_color, $thegig_bg_mask )
				) . ';';
			}
			if ( ! empty( $thegig_css ) ) {
				echo ' style="' . esc_attr( $thegig_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_team_content_wrap content_wrap">
			<?php
			// Caption
			$thegig_caption = thegig_get_theme_option( 'front_page_team_caption' );
			if ( ! empty( $thegig_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_team_caption front_page_block_<?php echo ! empty( $thegig_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $thegig_caption, 'thegig_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$thegig_description = thegig_get_theme_option( 'front_page_team_description' );
			if ( ! empty( $thegig_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_team_description front_page_block_<?php echo ! empty( $thegig_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $thegig_description ), 'thegig_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_team_output">
				<?php
				if ( is_active_sidebar( 'front_page_team_widgets' ) ) {
					dynamic_sidebar( 'front_page_team_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! thegig_exists_trx_addons() ) {
						thegig_customizer_need_trx_addons_message();
					} else {
						thegig_customizer_need_widgets_message( 'front_page_team_caption', 'ThemeREX Addons - Team' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
