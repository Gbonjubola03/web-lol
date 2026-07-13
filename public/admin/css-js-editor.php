
<?php
require_once('header.php');
do_winfo('COSMIC THEME CUSTOMIZER');

if (!defined('eu_active')) {
    define('eu_active', 'admin_theme');
}
    
$cssJsFilePath = '../css-js.php';

// Handle form submission
if (isset($_POST['apply_theme'])) {
    if (isset($_POST['theme_off']) && $_POST['theme_off'] === '1') {
        file_put_contents($cssJsFilePath, '');
        $success = "Theme has been turned off and styles cleared.";
    } else {
        $css = '
<style>
/* Cosmic Interface Override Styles - Will force apply to all elements */
:root {
  /* Base Colors */
  --cosmic-dark-bg: ' . ($_POST['cosmic_dark_bg'] ?? '#0a0a1a') . ';
  --cosmic-dark-text: ' . ($_POST['cosmic_dark_text'] ?? '#e0e0ff') . ';
  --cosmic-light-bg: ' . ($_POST['cosmic_light_bg'] ?? '#f0f5ff') . ';
  --cosmic-light-text: ' . ($_POST['cosmic_light_text'] ?? '#121225') . ';
  --cosmic-primary: ' . ($_POST['cosmic_primary'] ?? '#00ccff') . ';
  --cosmic-secondary: ' . ($_POST['cosmic_secondary'] ?? '#ff00ff') . ';
  --cosmic-tertiary: ' . ($_POST['cosmic_tertiary'] ?? '#ffff00') . ';
  --cosmic-glow: ' . ($_POST['cosmic_glow'] ?? '0 0 20px') . ';
  --cosmic-accent: ' . ($_POST['cosmic_accent'] ?? '#7b68ee') . ';
  
  /* Container Styles */
  --container-border-radius: ' . ($_POST['container_border_radius'] ?? '15px') . ';
  --container-padding: ' . ($_POST['container_padding'] ?? '30px') . ';
  --container-margin: ' . ($_POST['container_margin'] ?? '30px auto') . ';
  --container-max-width: ' . ($_POST['container_max_width'] ?? '1200px') . ';
  --container-bg-dark: ' . ($_POST['container_bg_dark'] ?? 'rgba(18, 18, 37, 0.8)') . ';
  --container-bg-light: ' . ($_POST['container_bg_light'] ?? 'rgba(255, 255, 255, 0.8)') . ';
  --container-border-dark: ' . ($_POST['container_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.2)') . ';
  --container-border-light: ' . ($_POST['container_border_light'] ?? '1px solid rgba(0, 102, 255, 0.2)') . ';
  --container-shadow: ' . ($_POST['container_shadow'] ?? '0 10px 30px rgba(0, 0, 0, 0.3)') . ';
  
  /* Button Styles */
  --button-bg-primary: ' . ($_POST['button_bg_primary'] ?? 'linear-gradient(45deg, #00ccff, #0066ff)') . ';
  --button-bg-secondary: ' . ($_POST['button_bg_secondary'] ?? 'linear-gradient(45deg, #ff00aa, #ff6a00)') . ';
  --button-padding: ' . ($_POST['button_padding'] ?? '12px 25px') . ';
  --button-border-radius: ' . ($_POST['button_border_radius'] ?? '8px') . ';
  --button-font-size: ' . ($_POST['button_font_size'] ?? '1rem') . ';
  --button-font-weight: ' . ($_POST['button_font_weight'] ?? 'bold') . ';
  --button-color-dark: ' . ($_POST['button_color_dark'] ?? '#000') . ';
  --button-color-light: ' . ($_POST['button_color_light'] ?? '#fff') . ';
  --button-shadow-dark: ' . ($_POST['button_shadow_dark'] ?? '0 0 15px rgba(0, 204, 255, 0.5)') . ';
  --button-shadow-light: ' . ($_POST['button_shadow_light'] ?? '0 0 15px rgba(0, 102, 255, 0.5)') . ';
  --button-hover-transform: ' . ($_POST['button_hover_transform'] ?? 'translateY(-3px)') . ';
  --button-hover-glow: ' . ($_POST['button_hover_glow'] ?? '0 0 20px rgba(0, 255, 255, 0.8)') . ';
  
  /* Typography */
  --typography-font-family: ' . ($_POST['typography_font_family'] ?? "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif") . ';
  --typography-font-size: ' . ($_POST['typography_font_size'] ?? '1rem') . ';
  --typography-line-height: ' . ($_POST['typography_line_height'] ?? '1.6') . ';
  --typography-font-weight: ' . ($_POST['typography_font_weight'] ?? '400') . ';
  --typography-heading-margin: ' . ($_POST['typography_heading_margin'] ?? '0 0 20px 0') . ';
  --typography-heading-font-weight: ' . ($_POST['typography_heading_font_weight'] ?? '600') . ';
  --typography-heading-letter-spacing: ' . ($_POST['typography_heading_letter_spacing'] ?? '0.5px') . ';
  --typography-color-dark: ' . ($_POST['typography_color_dark'] ?? '#e0e0ff') . ';
  --typography-color-light: ' . ($_POST['typography_color_light'] ?? '#121225') . ';
  --typography-heading-color-dark: ' . ($_POST['typography_heading_color_dark'] ?? 'var(--cosmic-primary)') . ';
  --typography-heading-color-light: ' . ($_POST['typography_heading_color_light'] ?? 'var(--cosmic-accent)') . ';
  --typography-heading-shadow-dark: ' . ($_POST['typography_heading_shadow_dark'] ?? '0 0 10px rgba(0, 204, 255, 0.5)') . ';
  --typography-heading-shadow-light: ' . ($_POST['typography_heading_shadow_light'] ?? '0 0 10px rgba(123, 104, 238, 0.3)') . ';
  
  /* Card Styles */
  --card-bg-dark: ' . ($_POST['card_bg_dark'] ?? 'rgba(0, 0, 0, 0.2)') . ';
  --card-bg-light: ' . ($_POST['card_bg_light'] ?? 'rgba(255, 255, 255, 0.8)') . ';
  --card-border-dark: ' . ($_POST['card_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.2)') . ';
  --card-border-light: ' . ($_POST['card_border_light'] ?? '1px solid rgba(123, 104, 238, 0.2)') . ';
  --card-border-radius: ' . ($_POST['card_border_radius'] ?? '10px') . ';
  --card-padding: ' . ($_POST['card_padding'] ?? '20px') . ';
  --card-margin: ' . ($_POST['card_margin'] ?? '15px 0') . ';
  --card-shadow-dark: ' . ($_POST['card_shadow_dark'] ?? '0 5px 15px rgba(0, 0, 0, 0.3)') . ';
  --card-shadow-light: ' . ($_POST['card_shadow_light'] ?? '0 5px 15px rgba(0, 0, 0, 0.1)') . ';
  --card-hover-transform: ' . ($_POST['card_hover_transform'] ?? 'translateY(-5px)') . ';
  --card-hover-shadow-dark: ' . ($_POST['card_hover_shadow_dark'] ?? '0 8px 25px rgba(0, 255, 255, 0.2)') . ';
  --card-hover-shadow-light: ' . ($_POST['card_hover_shadow_light'] ?? '0 8px 25px rgba(123, 104, 238, 0.2)') . ';
  --card-header-bg-dark: ' . ($_POST['card_header_bg_dark'] ?? 'rgba(0, 0, 0, 0.3)') . ';
  --card-header-bg-light: ' . ($_POST['card_header_bg_light'] ?? 'rgba(123, 104, 238, 0.05)') . ';
  --card-header-border-dark: ' . ($_POST['card_header_border_dark'] ?? 'rgba(0, 255, 255, 0.1)') . ';
  --card-header-border-light: ' . ($_POST['card_header_border_light'] ?? 'rgba(123, 104, 238, 0.1)') . ';
  --card-footer-bg-dark: ' . ($_POST['card_footer_bg_dark'] ?? 'rgba(0, 0, 0, 0.2)') . ';
  --card-footer-bg-light: ' . ($_POST['card_footer_bg_light'] ?? 'rgba(123, 104, 238, 0.03)') . ';
  --card-footer-border-dark: ' . ($_POST['card_footer_border_dark'] ?? 'rgba(0, 255, 255, 0.1)') . ';
  --card-footer-border-light: ' . ($_POST['card_footer_border_light'] ?? 'rgba(123, 104, 238, 0.1)') . ';
  
  /* Modal Styles */
  --modal-bg-dark: ' . ($_POST['modal_bg_dark'] ?? 'linear-gradient(135deg, rgba(18, 18, 37, 0.9), rgba(10, 10, 30, 0.95))') . ';
  --modal-bg-light: ' . ($_POST['modal_bg_light'] ?? 'linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 245, 255, 0.95))') . ';
  --modal-border-dark: ' . ($_POST['modal_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.2)') . ';
  --modal-border-light: ' . ($_POST['modal_border_light'] ?? '1px solid rgba(0, 102, 255, 0.2)') . ';
  --modal-border-radius: ' . ($_POST['modal_border_radius'] ?? '15px') . ';
  --modal-shadow: ' . ($_POST['modal_shadow'] ?? '0 10px 30px rgba(0, 0, 0, 0.3)') . ';
  --modal-header-border-dark: ' . ($_POST['modal_header_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.1)') . ';
  --modal-header-border-light: ' . ($_POST['modal_header_border_light'] ?? '1px solid rgba(0, 102, 255, 0.1)') . ';
  --modal-header-padding: ' . ($_POST['modal_header_padding'] ?? '20px 25px') . ';
  --modal-body-padding: ' . ($_POST['modal_body_padding'] ?? '25px') . ';
  --modal-footer-border-dark: ' . ($_POST['modal_footer_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.1)') . ';
  --modal-footer-border-light: ' . ($_POST['modal_footer_border_light'] ?? '1px solid rgba(0, 102, 255, 0.1)') . ';
  --modal-footer-padding: ' . ($_POST['modal_footer_padding'] ?? '15px 25px 25px') . ';
  
  /* Notification Styles */
  --notification-success-bg-dark: ' . ($_POST['notification_success_bg_dark'] ?? 'rgba(0, 50, 20, 0.8)') . ';
  --notification-success-border-dark: ' . ($_POST['notification_success_border_dark'] ?? '#00ff9d') . ';
  --notification-success-text-dark: ' . ($_POST['notification_success_text_dark'] ?? '#e0ffe0') . ';
  --notification-error-bg-dark: ' . ($_POST['notification_error_bg_dark'] ?? 'rgba(50, 0, 0, 0.8)') . ';
  --notification-error-border-dark: ' . ($_POST['notification_error_border_dark'] ?? '#ff5555') . ';
  --notification-error-text-dark: ' . ($_POST['notification_error_text_dark'] ?? '#ffe0e0') . ';
  --notification-info-bg-dark: ' . ($_POST['notification_info_bg_dark'] ?? 'rgba(0, 20, 50, 0.8)') . ';
  --notification-info-border-dark: ' . ($_POST['notification_info_border_dark'] ?? '#55aaff') . ';
  --notification-info-text-dark: ' . ($_POST['notification_info_text_dark'] ?? '#e0e0ff') . ';
  --notification-success-bg-light: ' . ($_POST['notification_success_bg_light'] ?? 'rgba(240, 255, 240, 0.9)') . ';
  --notification-success-border-light: ' . ($_POST['notification_success_border_light'] ?? '#00cc66') . ';
  --notification-success-text-light: ' . ($_POST['notification_success_text_light'] ?? '#006633') . ';
  --notification-error-bg-light: ' . ($_POST['notification_error_bg_light'] ?? 'rgba(255, 240, 240, 0.9)') . ';
  --notification-error-border-light: ' . ($_POST['notification_error_border_light'] ?? '#cc0000') . ';
  --notification-error-text-light: ' . ($_POST['notification_error_text_light'] ?? '#660000') . ';
  --notification-info-bg-light: ' . ($_POST['notification_info_bg_light'] ?? 'rgba(240, 240, 255, 0.9)') . ';
  --notification-info-border-light: ' . ($_POST['notification_info_border_light'] ?? '#0066cc') . ';
  --notification-info-text-light: ' . ($_POST['notification_info_text_light'] ?? '#003366') . ';
  --notification-border-radius: ' . ($_POST['notification_border_radius'] ?? '10px') . ';
  --notification-padding: ' . ($_POST['notification_padding'] ?? '15px 25px') . ';
  --notification-box-shadow: ' . ($_POST['notification_box_shadow'] ?? '0 5px 15px rgba(0, 0, 0, 0.3)') . ';
  
  /* Form Elements */
  --form-input-bg-dark: ' . ($_POST['form_input_bg_dark'] ?? 'rgba(0, 0, 0, 0.2)') . ';
  --form-input-bg-light: ' . ($_POST['form_input_bg_light'] ?? 'rgba(255, 255, 255, 0.8)') . ';
  --form-input-border-dark: ' . ($_POST['form_input_border_dark'] ?? '1px solid rgba(0, 255, 255, 0.3)') . ';
  --form-input-border-light: ' . ($_POST['form_input_border_light'] ?? '1px solid rgba(0, 102, 255, 0.3)') . ';
  --form-input-color-dark: ' . ($_POST['form_input_color_dark'] ?? '#fff') . ';
  --form-input-color-light: ' . ($_POST['form_input_color_light'] ?? '#000') . ';
  --form-input-shadow-dark: ' . ($_POST['form_input_shadow_dark'] ?? 'inset 0 0 5px rgba(0, 255, 255, 0.2)') . ';
  --form-input-shadow-light: ' . ($_POST['form_input_shadow_light'] ?? 'inset 0 0 5px rgba(0, 102, 255, 0.2)') . ';
  --form-input-focus-bg-dark: ' . ($_POST['form_input_focus_bg_dark'] ?? 'rgba(0, 0, 0, 0.3)') . ';
  --form-input-focus-bg-light: ' . ($_POST['form_input_focus_bg_light'] ?? 'rgba(255, 255, 255, 1)') . ';
  --form-input-focus-border-dark: ' . ($_POST['form_input_focus_border_dark'] ?? 'var(--cosmic-primary)') . ';
  --form-input-focus-border-light: ' . ($_POST['form_input_focus_border_light'] ?? '#0066cc') . ';
  --form-input-focus-shadow-dark: ' . ($_POST['form_input_focus_shadow_dark'] ?? '0 0 10px var(--cosmic-primary)') . ';
  --form-input-focus-shadow-light: ' . ($_POST['form_input_focus_shadow_light'] ?? '0 0 10px rgba(0, 102, 255, 0.5)') . ';
  --form-input-border-radius: ' . ($_POST['form_input_border_radius'] ?? '8px') . ';
  --form-input-padding: ' . ($_POST['form_input_padding'] ?? '12px 15px') . ';
  --form-input-margin: ' . ($_POST['form_input_margin'] ?? '10px 0') . ';
  --form-label-margin: ' . ($_POST['form_label_margin'] ?? '0 0 5px 0') . ';
  --form-label-font-weight: ' . ($_POST['form_label_font_weight'] ?? '500') . ';
  --form-label-color-dark: ' . ($_POST['form_label_color_dark'] ?? 'var(--cosmic-primary)') . ';
  --form-label-color-light: ' . ($_POST['form_label_color_light'] ?? 'var(--cosmic-accent)') . ';
  
  /* Table Styles */
  --table-bg-dark: ' . ($_POST['table_bg_dark'] ?? 'rgba(0, 0, 0, 0.2)') . ';
  --table-bg-light: ' . ($_POST['table_bg_light'] ?? 'rgba(255, 255, 255, 0.8)') . ';
  --table-shadow-dark: ' . ($_POST['table_shadow_dark'] ?? '0 0 20px rgba(0, 255, 255, 0.1)') . ';
  --table-shadow-light: ' . ($_POST['table_shadow_light'] ?? '0 0 20px rgba(0, 102, 255, 0.1)') . ';
  --table-border-radius: ' . ($_POST['table_border_radius'] ?? '10px') . ';
  --table-margin: ' . ($_POST['table_margin'] ?? '20px 0') . ';
  --table-header-bg-dark: ' . ($_POST['table_header_bg_dark'] ?? 'rgba(0, 255, 255, 0.1)') . ';
  --table-header-bg-light: ' . ($_POST['table_header_bg_light'] ?? 'rgba(0, 102, 255, 0.1)') . ';
  --table-header-color-dark: ' . ($_POST['table_header_color_dark'] ?? 'var(--cosmic-primary)') . ';
  --table-header-color-light: ' . ($_POST['table_header_color_light'] ?? '#0066cc') . ';
  --table-header-border-dark: ' . ($_POST['table_header_border_dark'] ?? 'rgba(0, 255, 255, 0.2)') . ';
  --table-header-border-light: ' . ($_POST['table_header_border_light'] ?? 'rgba(0, 102, 255, 0.2)') . ';
  --table-cell-padding: ' . ($_POST['table_cell_padding'] ?? '12px 15px') . ';
  --table-row-border-dark: ' . ($_POST['table_row_border_dark'] ?? 'rgba(255, 255, 255, 0.05)') . ';
  --table-row-border-light: ' . ($_POST['table_row_border_light'] ?? 'rgba(0, 0, 0, 0.05)') . ';
  --table-row-hover-bg-dark: ' . ($_POST['table_row_hover_bg_dark'] ?? 'rgba(0, 255, 255, 0.05)') . ';
  --table-row-hover-bg-light: ' . ($_POST['table_row_hover_bg_light'] ?? 'rgba(0, 102, 255, 0.05)') . ';
  
  /* Link Styles */
  --link-color-dark: ' . ($_POST['link_color_dark'] ?? 'var(--cosmic-primary)') . ';
  --link-color-light: ' . ($_POST['link_color_light'] ?? 'var(--cosmic-accent)') . ';
  --link-hover-color-dark: ' . ($_POST['link_hover_color_dark'] ?? 'var(--cosmic-primary)') . ';
  --link-hover-color-light: ' . ($_POST['link_hover_color_light'] ?? 'var(--cosmic-accent)') . ';
  --link-decoration: ' . ($_POST['link_decoration'] ?? 'none') . ';
  --link-hover-decoration: ' . ($_POST['link_hover_decoration'] ?? 'none') . ';
  --link-transition: ' . ($_POST['link_transition'] ?? 'all 0.3s ease') . ';
  
  /* Badge Styles */
  --badge-padding: ' . ($_POST['badge_padding'] ?? '5px 10px') . ';
  --badge-border-radius: ' . ($_POST['badge_border_radius'] ?? '20px') . ';
  --badge-font-size: ' . ($_POST['badge_font_size'] ?? '0.8rem') . ';
  --badge-font-weight: ' . ($_POST['badge_font_weight'] ?? 'bold') . ';
  --badge-primary-bg-dark: ' . ($_POST['badge_primary_bg_dark'] ?? 'var(--cosmic-primary)') . ';
  --badge-primary-text-dark: ' . ($_POST['badge_primary_text_dark'] ?? '#000') . ';
  --badge-primary-bg-light: ' . ($_POST['badge_primary_bg_light'] ?? 'var(--cosmic-accent)') . ';
  --badge-primary-text-light: ' . ($_POST['badge_primary_text_light'] ?? '#fff') . ';
  --badge-secondary-bg-dark: ' . ($_POST['badge_secondary_bg_dark'] ?? 'var(--cosmic-secondary)') . ';
  --badge-secondary-text-dark: ' . ($_POST['badge_secondary_text_dark'] ?? '#fff') . ';
  --badge-secondary-bg-light: ' . ($_POST['badge_secondary_bg_light'] ?? '#ff6a00') . ';
  --badge-secondary-text-light: ' . ($_POST['badge_secondary_text_light'] ?? '#fff') . ';
  
  /* Marketplace Specific */
  --marketplace-hacker-title-dark: ' . ($_POST['marketplace_hacker_title_dark'] ?? 'var(--cosmic-primary)') . ';
  --marketplace-hacker-title-light: ' . ($_POST['marketplace_hacker_title_light'] ?? '#0066cc') . ';
  --marketplace-hacker-title-shadow-dark: ' . ($_POST['marketplace_hacker_title_shadow_dark'] ?? '0 0 10px rgba(0, 255, 255, 0.5)') . ';
  --marketplace-hacker-title-shadow-light: ' . ($_POST['marketplace_hacker_title_shadow_light'] ?? '0 0 10px rgba(0, 102, 204, 0.3)') . ';
  --marketplace-card-content-bg-dark: ' . ($_POST['marketplace_card_content_bg_dark'] ?? 'rgba(10, 10, 26, 0.8)') . ';
  --marketplace-card-content-bg-light: ' . ($_POST['marketplace_card_content_bg_light'] ?? 'rgba(240, 245, 255, 0.8)') . ';
  --marketplace-primary-text-dark: ' . ($_POST['marketplace_primary_text_dark'] ?? 'var(--cosmic-primary)') . ';
  --marketplace-primary-text-light: ' . ($_POST['marketplace_primary_text_light'] ?? '#0066cc') . ';
  --marketplace-card-price-bg-dark: ' . ($_POST['marketplace_card_price_bg_dark'] ?? 'rgba(0, 255, 255, 0.05)') . ';
  --marketplace-card-price-bg-light: ' . ($_POST['marketplace_card_price_bg_light'] ?? 'rgba(0, 102, 255, 0.05)') . ';
  --marketplace-terminal-header-bg-dark: ' . ($_POST['marketplace_terminal_header_bg_dark'] ?? 'rgba(0, 0, 0, 0.5)') . ';
  --marketplace-terminal-header-bg-light: ' . ($_POST['marketplace_terminal_header_bg_light'] ?? 'rgba(0, 102, 255, 0.1)') . ';
  --marketplace-grid-gap: ' . ($_POST['marketplace_grid_gap'] ?? '20px') . ';
  --marketplace-card-min-height: ' . ($_POST['marketplace_card_min_height'] ?? '300px') . ';
  --marketplace-card-max-width: ' . ($_POST['marketplace_card_max_width'] ?? '350px') . ';
  --marketplace-search-max-width: ' . ($_POST['marketplace_search_max_width'] ?? '600px') . ';
  
  /* Animation Settings */
  --animation-speed: ' . ($_POST['animation_speed'] ?? '0.3') . 's;
  --animation-type: ' . ($_POST['animation_type'] ?? 'ease') . ';
  --animation-duration-long: ' . ($_POST['animation_duration_long'] ?? '10s') . ';
  --cosmic-float-duration: ' . ($_POST['cosmic_float_duration'] ?? '8s') . ';
  --cosmic-pulse-duration: ' . ($_POST['cosmic_pulse_duration'] ?? '5s') . ';
  --cosmic-float-distance: ' . ($_POST['cosmic_float_distance'] ?? '-10px') . ';
}

/* Force override for all elements */
* {
  transition: background-color var(--animation-speed) var(--animation-type), 
              color var(--animation-speed) var(--animation-type), 
              box-shadow var(--animation-speed) var(--animation-type), 
              border-color var(--animation-speed) var(--animation-type) !important;
}

/* Body styles based on theme */
body {
  margin: 0 !important;
  padding: 0 !important;
  font-family: var(--typography-font-family) !important;
  font-size: var(--typography-font-size) !important;
  line-height: var(--typography-line-height) !important;
  font-weight: var(--typography-font-weight) !important;
  -webkit-font-smoothing: antialiased !important;
  -moz-osx-font-smoothing: grayscale !important;
  position: relative !important;
  overflow-x: hidden !important;
}

body.cosmic-dark {
  background-color: var(--cosmic-dark-bg) !important;
  color: var(--cosmic-dark-text) !important;
  background-image: 
    url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'400\' viewBox=\'0 0 800 800\'%3E%3Cg fill=\'none\' stroke=\'%23032437\' stroke-width=\'1\'%3E%3Cpath d=\'M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63\'/%3E%3Cpath d=\'M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764\'/%3E%3Cpath d=\'M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880\'/%3E%3Cpath d=\'M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382\'/%3E%3Cpath d=\'M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269\'/%3E%3C/g%3E%3Cg fill=\'%2300264d\'%3E%3Ccircle cx=\'769\' cy=\'229\' r=\'5\'/%3E%3Ccircle cx=\'539\' cy=\'269\' r=\'5\'/%3E%3Ccircle cx=\'603\' cy=\'493\' r=\'5\'/%3E%3Ccircle cx=\'731\' cy=\'737\' r=\'5\'/%3E%3Ccircle cx=\'520\' cy=\'660\' r=\'5\'/%3E%3Ccircle cx=\'309\' cy=\'538\' r=\'5\'/%3E%3Ccircle cx=\'295\' cy=\'764\' r=\'5\'/%3E%3Ccircle cx=\'40\' cy=\'599\' r=\'5\'/%3E%3Ccircle cx=\'102\' cy=\'382\' r=\'5\'/%3E%3Ccircle cx=\'127\' cy=\'80\' r=\'5\'/%3E%3Ccircle cx=\'370\' cy=\'105\' r=\'5\'/%3E%3Ccircle cx=\'578\' cy=\'42\' r=\'5\'/%3E%3Ccircle cx=\'237\' cy=\'261\' r=\'5\'/%3E%3Ccircle cx=\'390\' cy=\'382\' r=\'5\'/%3E%3C/g%3E%3C/svg%3E"),
    radial-gradient(circle at 10% 20%, rgba(0, 255, 255, 0.08) 0%, transparent 30%),
    radial-gradient(circle at 90% 50%, rgba(255, 0, 255, 0.08) 0%, transparent 35%),
    radial-gradient(circle at 50% 80%, rgba(255, 255, 0, 0.08) 0%, transparent 40%) !important;
  background-attachment: fixed !important;
  background-size: cover !important;
}

body.cosmic-light {
  background-color: var(--cosmic-light-bg) !important;
  color: var(--cosmic-light-text) !important;
  background-image: 
    url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'400\' viewBox=\'0 0 800 800\'%3E%3Cg fill=\'none\' stroke=\'%23e6f0ff\' stroke-width=\'1\'%3E%3Cpath d=\'M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63\'/%3E%3Cpath d=\'M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764\'/%3E%3Cpath d=\'M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880\'/%3E%3Cpath d=\'M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382\'/%3E%3Cpath d=\'M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269\'/%3E%3C/g%3E%3Cg fill=\'%23cce0ff\'%3E%3Ccircle cx=\'769\' cy=\'229\' r=\'5\'/%3E%3Ccircle cx=\'539\' cy=\'269\' r=\'5\'/%3E%3Ccircle cx=\'603\' cy=\'493\' r=\'5\'/%3E%3Ccircle cx=\'731\' cy=\'737\' r=\'5\'/%3E%3Ccircle cx=\'520\' cy=\'660\' r=\'5\'/%3E%3Ccircle cx=\'309\' cy=\'538\' r=\'5\'/%3E%3Ccircle cx=\'295\' cy=\'764\' r=\'5\'/%3E%3Ccircle cx=\'40\' cy=\'599\' r=\'5\'/%3E%3Ccircle cx=\'102\' cy=\'382\' r=\'5\'/%3E%3Ccircle cx=\'127\' cy=\'80\' r=\'5\'/%3E%3Ccircle cx=\'370\' cy=\'105\' r=\'5\'/%3E%3Ccircle cx=\'578\' cy=\'42\' r=\'5\'/%3E%3Ccircle cx=\'237\' cy=\'261\' r=\'5\'/%3E%3Ccircle cx=\'390\' cy=\'382\' r=\'5\'/%3E%3C/g%3E%3C/svg%3E"),
    radial-gradient(circle at 10% 20%, rgba(0, 102, 255, 0.08) 0%, transparent 30%),
    radial-gradient(circle at 90% 50%, rgba(102, 0, 255, 0.08) 0%, transparent 35%),
    radial-gradient(circle at 50% 80%, rgba(0, 204, 255, 0.08) 0%, transparent 40%) !important;
  background-attachment: fixed !important;
  background-size: cover !important;
}

/* Pattern Backgrounds for Light Theme */
body.cosmic-light.pattern1 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: linear-gradient(#0066ff1a 1px, transparent 1px), 
                      linear-gradient(to right, #0066ff1a 1px, transparent 1px) !important;
    background-size: 20px 20px !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern2 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: 
        url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'20\' viewBox=\'0 0 100 20\'%3E%3Cpath d=\'M21.184 20c.357-.13.72-.264.888-.14 1.24-.874 1.454-.874 1.454-.874v-1.093l.003-.245c-.4.073-.76.22-1.456.334-.7.115-1.456.132-1.456.267-.458.11-.256.11-.437.11 0 .114-.038.114-.157.23-.12.114-.64.232-.28.232-.152 0-.307.114-.307.232 0 .117.152.116.307.22.345.12.617.12.855.328h-.032c-.325.026-.307.026-.315.232-.007.206.034.232.248.232v-1.858H10c.199.9 3.177.534 4.438 1.42 1.26.888 2.2.436 2.2.436l1.392.03a.4.4 0 0 0 .138-.232c.025-.23.2-.232.38-.232.186 0 .348.12.595.12.246 0 .2-.118.36-.118.16 0 .413.118.612.118v1.161c.08-.063.203-.036.203-.5a.205.205 0 0 0-.368-.117M73.052 4.23c.72-.098 1.428-.213 2.146-.345.71-.134 1.318-.35 1.99-.244.67.106.876.506.56.948-.224.312-.456.697-.342 1.18.102.39.443.584.68.188-.106.232-.266.633-.213.952.066.408.525.614.64.4.067-.13.4-.184 1.045-.184v-.015c.685-.003 1.318-.25 1.49-.61a.483.483 0 0 0 .026-.362.624.624 0 0 0-.122-.178c-.396-.46-.576-.585-.88-.815a.112.112 0 0 0-.145.034 2.1 2.1 0 0 0-.156.295 1.03 1.03 0 0 1-.157.224c-.087.1-.216.16-.352.162-.174.002-.346-.094-.458-.248l-.06-.084a.483.483 0 0 1-.088-.286.572.572 0 0 1 .043-.193c.067-.164.148-.324.356-.4.273-.095.405-.096.478.48.71.43.24.026.266-.163.02-.192.03-.505.413-.505.353 0 .515-.2.594-.7H73.05v-.218a.108.108 0 0 1 .007-.04\' fill=\'%235C34DB\' fill-opacity=\'0.06\' fill-rule=\'evenodd\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
    background-size: cover !important;
}


body.cosmic-light.pattern3 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: radial-gradient(#0066ff1a 2px, transparent 2px) !important;
    background-size: 30px 30px !important;
    background-attachment: fixed !important;
}
body.cosmic-light.pattern4 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'28\' height=\'49\' viewBox=\'0 0 28 49\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'hexagons\' fill=\'%230066ff\' fill-opacity=\'0.08\' fill-rule=\'nonzero\'%3E%3Cpath d=\'M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern5 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg width=\'84\' height=\'48\' viewBox=\'0 0 84 48\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M0 0h12v6H0V0zm28 8h12v6H28V8zm14-8h12v6H42V0zm14 0h12v6H56V0zm0 8h12v6H56V8zM42 8h12v6H42V8zm0 16h12v6H42v-6zm14-8h12v6H56v-6zm14 0h12v6H70v-6zm0-16h12v6H70V0zM28 32h12v6H28v-6zM14 16h12v6H14v-6zM0 24h12v6H0v-6zm0 8h12v6H0v-6zm14 0h12v6H14v-6zm14 8h12v6H28v-6zm-14 0h12v6H14v-6zm28 0h12v6H42v-6zm14-8h12v6H56v-6zm0-8h12v6H56v-6zm14 8h12v6H70v-6zm0 8h12v6H70v-6zM14 24h12v6H14v-6zm14-8h12v6H28v-6zM14 8h12v6H14V8zM0 8h12v6H0V8z\' fill=\'%230066ff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern6 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: linear-gradient(45deg, #0066ff0d 25%, transparent 25%, transparent 75%, #0066ff0d 75%, #0066ff0d),
                      linear-gradient(45deg, #0066ff0d 25%, transparent 25%, transparent 75%, #0066ff0d 75%, #0066ff0d) !important;
    background-size: 60px 60px !important;
    background-position: 0 0, 30px 30px !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern7 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 304 304\' width=\'304\' height=\'304\'%3E%3Cpath fill=\'%230066ff\' fill-opacity=\'0.08\' d=\'M44.1 224a5 5 0 1 1 0 2H0v-2h44.1zm160 48a5 5 0 1 1 0 2H82v-2h122.1zm57.8-46a5 5 0 1 1 0-2H304v2h-42.1zm0 16a5 5 0 1 1 0-2H304v2h-42.1zm6.2-114a5 5 0 1 1 0 2h-86.2a5 5 0 1 1 0-2h86.2zm-256-48a5 5 0 1 1 0 2H0v-2h12.1zm185.8 34a5 5 0 1 1 0-2h86.2a5 5 0 1 1 0 2h-86.2zM258 12.1a5 5 0 1 1-2 0V0h2v12.1zm-64 208a5 5 0 1 1-2 0v-54.2a5 5 0 1 1 2 0v54.2zm48-198.2V80h62v2h-64V21.9a5 5 0 1 1 2 0zm16 16V64h46v2h-48V37.9a5 5 0 1 1 2 0zm-128 96V208h16v12.1a5 5 0 1 1-2 0V210h-16v-76.1a5 5 0 1 1 2 0zm-5.9-21.9a5 5 0 1 1 0 2H114v48H85.9a5 5 0 1 1 0-2H112v-48h12.1zm-6.2 130a5 5 0 1 1 0-2H176v-74.1a5 5 0 1 1 2 0V242h-60.1zm-16-64a5 5 0 1 1 0-2H114v48h10.1a5 5 0 1 1 0 2H112v-48h-10.1zM66 284.1a5 5 0 1 1-2 0V274H50v30h-2v-32h18v12.1zM236.1 176a5 5 0 1 1 0 2H226v94h48v32h-2v-30h-48v-98h12.1zm25.8-30a5 5 0 1 1 0-2H274v44.1a5 5 0 1 1-2 0V146h-10.1zm-64 96a5 5 0 1 1 0-2H208v-80h16v-14h-42.1a5 5 0 1 1 0-2H226v18h-16v80h-12.1zm86.2-210a5 5 0 1 1 0 2H272V0h2v32h10.1zM98 101.9V146H53.9a5 5 0 1 1 0-2H96v-42.1a5 5 0 1 1 2 0zM53.9 34a5 5 0 1 1 0-2H80V0h2v34H53.9z\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern8 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'36\' height=\'72\' viewBox=\'0 0 36 72\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg fill=\'%230066ff\' fill-opacity=\'0.07\'%3E%3Cpath d=\'M2 6h12L8 18 2 6zm18 36h12l-6 12-6-12z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern9 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'20\' height=\'12\' viewBox=\'0 0 20 12\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'charlie-brown\' fill=\'%230066ff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M9.8 12L0 2.2V.8l10 10 10-10v1.4L10.2 12h-.4zm-4 0L0 6.2V4.8L7.2 12H5.8zm8.4 0L20 6.2V4.8L12.8 12h1.4zM9.8 0l.2.2.2-.2h-.4zm-4 0L10 4.2 14.2 0h-1.4L10 2.8 7.2 0H5.8z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-light.pattern10 {
    background-color: var(--cosmic-light-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%230066ff\' fill-opacity=\'0.06\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

/* Pattern Backgrounds for Dark Theme */
body.cosmic-dark.pattern1 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: linear-gradient(#00ffff1a 1px, transparent 1px),
                      linear-gradient(to right, #00ffff1a 1px, transparent 1px) !important;
    background-size: 20px 20px !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern2 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'20\' viewBox=\'0 0 100 20\'%3E%3Cpath d=\'M21.184 20c.357-.13.72-.264.888-.14 1.24-.874 1.454-.874 1.454-.874v-1.093l.003-.245c-.4.073-.76.22-1.456.334-.7.115-1.456.132-1.456.267-.458.11-.256.11-.437.11 0 .114-.038.114-.157.23-.12.114-.64.232-.28.232-.152 0-.307.114-.307.232 0 .117.152.116.307.22.345.12.617.12.855.328h-.032c-.325.026-.307.026-.315.232-.007.206.034.232.248.232v-1.858H10c.199.9 3.177.534 4.438 1.42 1.26.888 2.2.436 2.2.436l1.392.03a.4.4 0 0 0 .138-.232c.025-.23.2-.232.38-.232.186 0 .348.12.595.12.246 0 .2-.118.36-.118.16 0 .413.118.612.118v1.161c.08-.063.203-.036.203-.5a.205.205 0 0 0-.368-.117M73.052 4.23c.72-.098 1.428-.213 2.146-.345.71-.134 1.318-.35 1.99-.244.67.106.876.506.56.948-.224.312-.456.697-.342 1.18.102.39.443.584.68.188-.106.232-.266.633-.213.952.066.408.525.614.64.4.067-.13.4-.184 1.045-.184v-.015c.685-.003 1.318-.25 1.49-.61a.483.483 0 0 0 .026-.362.624.624 0 0 0-.122-.178c-.396-.46-.576-.585-.88-.815a.112.112 0 0 0-.145.034 2.1 2.1 0 0 0-.156.295 1.03 1.03 0 0 1-.157.224c-.087.1-.216.16-.352.162-.174.002-.346-.094-.458-.248l-.06-.084a.483.483 0 0 1-.088-.286.572.572 0 0 1 .043-.193c.067-.164.148-.324.356-.4.273-.095.405-.096.478.48.71.43.24.026.266-.163.02-.192.03-.505.413-.505.353 0 .515-.2.594-.7H73.05v-.218a.108.108 0 0 1 .007-.04\' fill=\'%2300ffff\' fill-opacity=\'0.06\' fill-rule=\'evenodd\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
    background-size: cover !important;
}

body.cosmic-dark.pattern3 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: radial-gradient(#00ffff1a 2px, transparent 2px) !important;
    background-size: 30px 30px !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern4 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'28\' height=\'49\' viewBox=\'0 0 28 49\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'hexagons\' fill=\'%2300ffff\' fill-opacity=\'0.08\' fill-rule=\'nonzero\'%3E%3Cpath d=\'M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern5 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg width=\'84\' height=\'48\' viewBox=\'0 0 84 48\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M0 0h12v6H0V0zm28 8h12v6H28V8zm14-8h12v6H42V0zm14 0h12v6H56V0zm0 8h12v6H56V8zM42 8h12v6H42V8zm0 16h12v6H42v-6zm14-8h12v6H56v-6zm14 0h12v6H70v-6zm0-16h12v6H70V0zM28 32h12v6H28v-6zM14 16h12v6H14v-6zM0 24h12v6H0v-6zm0 8h12v6H0v-6zm14 0h12v6H14v-6zm14 8h12v6H28v-6zm-14 0h12v6H14v-6zm28 0h12v6H42v-6zm14-8h12v6H56v-6zm0-8h12v6H56v-6zm14 8h12v6H70v-6zm0 8h12v6H70v-6zM14 24h12v6H14v-6zm14-8h12v6H28v-6zM14 8h12v6H14V8zM0 8h12v6H0V8z\' fill=\'%2300ffff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern6 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: linear-gradient(45deg, #00ffff0d 25%, transparent 25%, transparent 75%, #00ffff0d 75%, #00ffff0d),
                      linear-gradient(45deg, #00ffff0d 25%, transparent 25%, transparent 75%, #00ffff0d 75%, #00ffff0d) !important;
    background-size: 60px 60px !important;
    background-position: 0 0, 30px 30px !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern7 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 304 304\' width=\'304\' height=\'304\'%3E%3Cpath fill=\'%2300ffff\' fill-opacity=\'0.08\' d=\'M44.1 224a5 5 0 1 1 0 2H0v-2h44.1zm160 48a5 5 0 1 1 0 2H82v-2h122.1zm57.8-46a5 5 0 1 1 0-2H304v2h-42.1zm0 16a5 5 0 1 1 0-2H304v2h-42.1zm6.2-114a5 5 0 1 1 0 2h-86.2a5 5 0 1 1 0-2h86.2zm-256-48a5 5 0 1 1 0 2H0v-2h12.1zm185.8 34a5 5 0 1 1 0-2h86.2a5 5 0 1 1 0 2h-86.2zM258 12.1a5 5 0 1 1-2 0V0h2v12.1zm-64 208a5 5 0 1 1-2 0v-54.2a5 5 0 1 1 2 0v54.2zm48-198.2V80h62v2h-64V21.9a5 5 0 1 1 2 0zm16 16V64h46v2h-48V37.9a5 5 0 1 1 2 0zm-128 96V208h16v12.1a5 5 0 1 1-2 0V210h-16v-76.1a5 5 0 1 1 2 0zm-5.9-21.9a5 5 0 1 1 0 2H114v48H85.9a5 5 0 1 1 0-2H112v-48h12.1zm-6.2 130a5 5 0 1 1 0-2H176v-74.1a5 5 0 1 1 2 0V242h-60.1zm-16-64a5 5 0 1 1 0-2H114v48h10.1a5 5 0 1 1 0 2H112v-48h-10.1zM66 284.1a5 5 0 1 1-2 0V274H50v30h-2v-32h18v12.1zM236.1 176a5 5 0 1 1 0 2H226v94h48v32h-2v-30h-48v-98h12.1zm25.8-30a5 5 0 1 1 0-2H274v44.1a5 5 0 1 1-2 0V146h-10.1zm-64 96a5 5 0 1 1 0-2H208v-80h16v-14h-42.1a5 5 0 1 1 0-2H226v18h-16v80h-12.1zm86.2-210a5 5 0 1 1 0 2H272V0h2v32h10.1zM98 101.9V146H53.9a5 5 0 1 1 0-2H96v-42.1a5 5 0 1 1 2 0zM53.9 34a5 5 0 1 1 0-2H80V0h2v34H53.9z\'/%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern8 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'36\' height=\'72\' viewBox=\'0 0 36 72\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg fill=\'%2300ffff\' fill-opacity=\'0.07\'%3E%3Cpath d=\'M2 6h12L8 18 2 6zm18 36h12l-6 12-6-12z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern9 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'20\' height=\'12\' viewBox=\'0 0 20 12\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'charlie-brown\' fill=\'%2300ffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M9.8 12L0 2.2V.8l10 10 10-10v1.4L10.2 12h-.4zm-4 0L0 6.2V4.8L7.2 12H5.8zm8.4 0L20 6.2V4.8L12.8 12h1.4zM9.8 0l.2.2.2-.2h-.4zm-4 0L10 4.2 14.2 0h-1.4L10 2.8 7.2 0H5.8z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}

body.cosmic-dark.pattern10 {
    background-color: var(--cosmic-dark-bg) !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%2300ffff\' fill-opacity=\'0.06\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") !important;
    background-attachment: fixed !important;
}


/* Animated Background Effects */
@keyframes gradient-shift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

body.cosmic-light.animated-gradient-shift {
    background: linear-gradient(-45deg, #f0f8ff, #e6f0ff, #cce0ff, #b3d1ff) !important;
    background-size: 400% 400% !important;
    animation: gradient-shift 15s ease infinite !important;
}

body.cosmic-dark.animated-gradient-shift {
    background: linear-gradient(-45deg, #001a33, #00264d, #003366, #004080) !important;
    background-size: 400% 400% !important;
    animation: gradient-shift 15s ease infinite !important;
}

@keyframes pulse-bg {
    0% {
        background-color: var(--cosmic-light-bg);
    }
    50% {
        background-color: #e6f0ff;
    }
    100% {
        background-color: var(--cosmic-light-bg);
    }
}

body.cosmic-light.animated-pulse {
    animation: pulse-bg 10s infinite;
}

@keyframes pulse-bg-dark {
    0% {
        background-color: var(--cosmic-dark-bg);
    }
    50% {
        background-color: #001a33;
    }
    100% {
        background-color: var(--cosmic-dark-bg);
    }
}

body.cosmic-dark.animated-pulse {
    animation: pulse-bg-dark 10s infinite;
}

/* Waves Animation */
body.cosmic-light.animated-wave,
body.cosmic-dark.animated-wave {
    position: relative;
    overflow: hidden;
}

body.cosmic-light.animated-wave::before,
body.cosmic-dark.animated-wave::before {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background-repeat: repeat-x;
    z-index: -1;
    opacity: 0.2;
}

body.cosmic-light.animated-wave::before {
    background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 120%22 preserveAspectRatio=%22none%22%3E%3Cpath fill=%22%230066ff%22 d=%22M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z%22 opacity=%22.25%22 class=%22shape-fill%22%3E%3C/path%3E%3Cpath fill=%22%230066ff%22 d=%22M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z%22 opacity=%22.5%22 class=%22shape-fill%22%3E%3C/path%3E%3Cpath fill=%22%230066ff%22 d=%22M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z%22 class=%22shape-fill%22%3E%3C/path%3E%3C/svg%3E");
    animation: wave-animation 12s linear infinite;
}

body.cosmic-dark.animated-wave::before {
    background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 120%22 preserveAspectRatio=%22none%22%3E%3Cpath fill=%22%2300ffff%22 d=%22M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z%22 opacity=%22.25%22 class=%22shape-fill%22%3E%3C/path%3E%3Cpath fill=%22%2300ffff%22 d=%22M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z%22 opacity=%22.5%22 class=%22shape-fill%22%3E%3C/path%3E%3Cpath fill=%22%2300ffff%22 d=%22M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z%22 class=%22shape-fill%22%3E%3C/path%3E%3C/svg%3E");
    animation: wave-animation 12s linear infinite;
}


@keyframes wave-animation {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Aurora Effect */
body.cosmic-light.animated-aurora,
body.cosmic-dark.animated-aurora {
    position: relative;
    overflow: hidden;
}

body.cosmic-light.animated-aurora::before,
body.cosmic-dark.animated-aurora::before {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.3;
}

body.cosmic-light.animated-aurora::before {
    background: linear-gradient(125deg, #0066ff, #00ffcc, #33ccff, #3399ff);
    background-size: 400% 400%;
    animation: aurora-animation 15s ease infinite;
}

body.cosmic-dark.animated-aurora::before {
    background: linear-gradient(125deg, #00264d, #00ffcc, #003366, #00ccff);
    background-size: 400% 400%;
    animation: aurora-animation 15s ease infinite;
}

@keyframes aurora-animation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Matrix Effect */
@keyframes matrix-fall {
    0% {
        opacity: 0;
        transform: translateY(-100px);
    }
    10% {
        opacity: 0.8;
    }
    100% {
        opacity: 0;
        transform: translateY(calc(100vh + 100px));
    }
}

body.cosmic-dark.animated-matrix {
    position: relative;
}

body.cosmic-dark.animated-matrix::before {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: var(--cosmic-dark-bg);
    background-image: 
        repeating-linear-gradient(0deg, 
            rgba(0, 255, 0, 0.15), 
            rgba(0, 255, 0, 0.15) 1px, 
            transparent 1px, 
            transparent 30px),
        repeating-linear-gradient(90deg, 
            rgba(0, 255, 0, 0.15), 
            rgba(0, 255, 0, 0.15) 1px, 
            transparent 1px, 
            transparent 30px);
    filter: drop-shadow(0 0 2px rgba(0, 255, 0, 0.5));
    z-index: -1;
    animation: matrix-fall 20s linear infinite;
}

/* Fireflies Effect */
@keyframes firefly {
    0% {
        opacity: 0;
        transform: translateY(0) scale(0.3);
    }
    50% {
        opacity: 0.5;
        transform: translateY(-10px) scale(0.7);
    }
    100% {
        opacity: 0;
        transform: translateY(0) scale(0.3);
    }
}

body.cosmic-dark.animated-fireflies {
    position: relative;
    background-image: radial-gradient(circle at 10% 20%, rgba(0, 255, 255, 0.08) 0%, transparent 30%),
                      radial-gradient(circle at 90% 50%, rgba(255, 0, 255, 0.08) 0%, transparent 35%),
                      radial-gradient(circle at 50% 80%, rgba(255, 255, 0, 0.08) 0%, transparent 40%) !important;
    background-attachment: fixed !important;
    background-size: cover !important;
}

body.cosmic-dark.animated-fireflies::before {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(0, 255, 255, 0.5) 0%, rgba(0, 255, 255, 0) 2%),
        radial-gradient(circle at 60% 70%, rgba(0, 255, 255, 0.5) 0%, rgba(0, 255, 255, 0) 2%),
        radial-gradient(circle at 90% 20%, rgba(0, 255, 255, 0.5) 0%, rgba(0, 255, 255, 0) 2%),
        radial-gradient(circle at 30% 60%, rgba(0, 255, 255, 0.5) 0%, rgba(0, 255, 255, 0) 2%),
        radial-gradient(circle at 70% 40%, rgba(0, 255, 255, 0.5) 0%, rgba(0, 255, 255, 0) 2%);
    background-size: 200% 200%;
    z-index: -1;
    opacity: 0.3;
    animation: firefly 8s ease-in-out infinite alternate;
}

/* Nebula Effect */
body.cosmic-dark.animated-nebula {
    position: relative;
    background-color: var(--cosmic-dark-bg) !important;
}

body.cosmic-dark.animated-nebula::before {
    
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background-image: 
        radial-gradient(circle at 30% 50%, rgba(255, 0, 255, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 70% 50%, rgba(0, 255, 255, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 50% 30%, rgba(255, 255, 0, 0.2) 0%, transparent 50%);
    background-size: 200% 200%;
    filter: blur(30px);
    animation: nebula-pulse 20s ease-in-out infinite alternate;
}

@keyframes nebula-pulse {
    0% {
        background-position: 0% 0%;
        opacity: 0.3;
    }
    50% {
        background-position: 100% 100%;
        opacity: 0.5;
    }
    100% {
        background-position: 0% 0%;
        opacity: 0.3;
    }
}



/* Session notification styles */
.session-notification {
  position: fixed !important;
  top: 80px !important;
  right: 20px !important;
   padding: var(--notification-padding) !important;
  border-radius: var(--notification-border-radius) !important;
  z-index: 9998 !important;
  transform: translateX(150%) !important;
  animation: slide-in 0.5s forwards, fade-out 0.5s 5s forwards !important;
  box-shadow: var(--notification-box-shadow) !important;
  max-width: 350px !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}

body.cosmic-dark .session-notification.success {
  background: var(--notification-success-bg-dark) !important;
  border-left: 5px solid var(--notification-success-border-dark) !important;
  color: var(--notification-success-text-dark) !important;
}

body.cosmic-dark .session-notification.error {
  background: var(--notification-error-bg-dark) !important;
  border-left: 5px solid var(--notification-error-border-dark) !important;
  color: var(--notification-error-text-dark) !important;
}

body.cosmic-dark .session-notification.info {
  background: var(--notification-info-bg-dark) !important;
  border-left: 5px solid var(--notification-info-border-dark) !important;
  color: var(--notification-info-text-dark) !important;
}

body.cosmic-light .session-notification.success {
  background: var(--notification-success-bg-light) !important;
  border-left: 5px solid var(--notification-success-border-light) !important;
  color: var(--notification-success-text-light) !important;
}

body.cosmic-light .session-notification.error {
  background: var(--notification-error-bg-light) !important;
  border-left: 5px solid var(--notification-error-border-light) !important;
  color: var(--notification-error-text-light) !important;
}

body.cosmic-light .session-notification.info {
  background: var(--notification-info-bg-light) !important;
  border-left: 5px solid var(--notification-info-border-light) !important;
  color: var(--notification-info-text-light) !important;
}

@keyframes slide-in {
  100% { transform: translateX(0%); }
}

@keyframes fade-out {
  0% { opacity: 1; }
  100% { opacity: 0; }
}

/* Theme toggle button */
.cosmic-theme-toggle {
  position: fixed !important;
  top: 20px !important;
  left: 20px !important;
  z-index: 9999 !important;
  width: 50px !important;
  height: 50px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  box-shadow: var(--cosmic-glow) rgba(0, 255, 255, 0.5) !important;
  border: 2px solid var(--cosmic-primary) !important;
  background-color: transparent !important;
  overflow: hidden !important;
}

body.cosmic-dark .cosmic-theme-toggle {
  color: #fff !important;
}

body.cosmic-light .cosmic-theme-toggle {
  color: #000 !important;
}

.cosmic-theme-toggle:hover {
  transform: scale(1.1) !important;
}

/* Cosmic particles container */
.cosmic-particles {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  z-index: -1 !important;
}

/* Override for all containers */
.signup-container,
.reset-password-container,
.recover-account-container,
.withdraw-container,
.withdraw-history-container,
.view-links-container,
.view-orders-container,
.view-services-container .service-card,
.invoice-container,
.terminal-section,
.hacker-card,
.search-form,
.grid-container,
.block-container {
  position: relative !important;
  overflow: hidden !important;
  border-radius: var(--container-border-radius) !important;
  box-shadow: var(--container-shadow) !important;
  transform: translateZ(0) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  margin: var(--container-margin) !important;
  padding: var(--container-padding) !important;
  max-width: var(--container-max-width) !important;
}

/* Dark mode container styles */
body.cosmic-dark .signup-container,
body.cosmic-dark .reset-password-container,
body.cosmic-dark .recover-account-container,
body.cosmic-dark .withdraw-container,
body.cosmic-dark .withdraw-history-container,
body.cosmic-dark .view-links-container,
body.cosmic-dark .view-orders-container,
body.cosmic-dark .view-services-container .service-card,
body.cosmic-dark .invoice-container,
body.cosmic-dark .terminal-section,
body.cosmic-dark .hacker-card,
body.cosmic-dark .search-form,
body.cosmic-dark .block-container {
  background: var(--container-bg-dark) !important;
  border: var(--container-border-dark) !important;
  color: var(--cosmic-dark-text) !important;
}

/* Light mode container styles */
body.cosmic-light .signup-container,
body.cosmic-light .reset-password-container,
body.cosmic-light .recover-account-container,
body.cosmic-light .withdraw-container,
body.cosmic-light .withdraw-history-container,
body.cosmic-light .view-links-container,
body.cosmic-light .view-orders-container,
body.cosmic-light .view-services-container .service-card,
body.cosmic-light .invoice-container,
body.cosmic-light .terminal-section,
body.cosmic-light .hacker-card,
body.cosmic-light .search-form,
body.cosmic-light .block-container {
  background: var(--container-bg-light) !important;
  border: var(--container-border-light) !important;
  color: var(--cosmic-light-text) !important;
}

/* Cosmic glow effect for all containers */
.signup-container::before,
.reset-password-container::before,
.recover-account-container::before,
.withdraw-container::before,
.withdraw-history-container::before,
.view-links-container::before,
.view-orders-container::before,
.view-services-container .service-card::before,
.invoice-container::before,
.terminal-section::before,
.hacker-card::before,
.block-container::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate var(--animation-duration-long) linear infinite !important;
  z-index: -1 !important;
}

/* Block elements styling */
.block {
  position: relative !important;
  margin: 20px 0 !important;
  padding: 20px !important;
  border-radius: 10px !important;
  overflow: hidden !important;
}

body.cosmic-dark .block {
  background: rgba(0, 0, 0, 0.2) !important;
  border-left: 3px solid var(--cosmic-primary) !important;
}

body.cosmic-light .block {
  background: rgba(255, 255, 255, 0.5) !important;
  border-left: 3px solid var(--cosmic-accent) !important;
}

.block-title {
  font-size: 1.2rem !important;
  margin-bottom: 15px !important;
  font-weight: bold !important;
  display: flex !important;
  align-items: center !important;
}

body.cosmic-dark .block-title {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .block-title {
  color: var(--cosmic-accent) !important;
}

.block-title i {
  margin-right: 10px !important;
}

.block-content {
  position: relative !important;
}

/* Headings */
h1, h2, h3, h4, h5, h6,
.section-title,
.card-title {
  position: relative !important;
  display: inline-block !important;
  margin: var(--typography-heading-margin) !important;
  font-weight: var(--typography-heading-font-weight) !important;
  letter-spacing: var(--typography-heading-letter-spacing) !important;
}

body.cosmic-dark h1, 
body.cosmic-dark h2, 
body.cosmic-dark h3, 
body.cosmic-dark h4, 
body.cosmic-dark h5, 
body.cosmic-dark h6,
body.cosmic-dark .section-title,
body.cosmic-dark .card-title {
  color: var(--typography-heading-color-dark) !important;
  text-shadow: var(--typography-heading-shadow-dark) !important;
}

body.cosmic-light h1, 
body.cosmic-light h2, 
body.cosmic-light h3, 
body.cosmic-light h4, 
body.cosmic-light h5, 
body.cosmic-light h6,
body.cosmic-light .section-title,
body.cosmic-light .card-title {
  color: var(--typography-heading-color-light) !important;
  text-shadow: var(--typography-heading-shadow-light) !important;
}

/* Text styles */
p, span, div, li {
  line-height: var(--typography-line-height) !important;
}

body.cosmic-dark p, 
body.cosmic-dark span, 
body.cosmic-dark div, 
body.cosmic-dark li {
  color: var(--typography-color-dark) !important;
}

body.cosmic-light p, 
body.cosmic-light span, 
body.cosmic-light div, 
body.cosmic-light li {
  color: var(--typography-color-light) !important;
}

/* Links */
a {
  text-decoration: var(--link-decoration) !important;
  position: relative !important;
  transition: var(--link-transition) !important;
}

body.cosmic-dark a {
  color: var(--link-color-dark) !important;
}

body.cosmic-light a {
  color: var(--link-color-light) !important;
}

a:hover {
  text-decoration: var(--link-hover-decoration) !important;
}

body.cosmic-dark a:hover {
  color: var(--link-hover-color-dark) !important;
}

body.cosmic-light a:hover {
  color: var(--link-hover-color-light) !important;
}

a::after {
  content: "" !important;
  position: absolute !important;
  width: 100% !important;
  height: 1px !important;
  bottom: -2px !important;
  left: 0 !important;
  transform: scaleX(0) !important;
  transform-origin: bottom right !important;
  transition: transform 0.3s ease !important;
}

body.cosmic-dark a::after {
  background-color: var(--link-color-dark) !important;
}

body.cosmic-light a::after {
  background-color: var(--link-color-light) !important;
}

a:hover::after {
  transform: scaleX(1) !important;
  transform-origin: bottom left !important;
}

/* Input fields */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
textarea,
select,
#search-input {
  width: 100% !important;
  padding: var(--form-input-padding) !important;
  margin: var(--form-input-margin) !important;
  border-radius: var(--form-input-border-radius) !important;
  font-size: 1rem !important;
  transition: all 0.3s ease !important;
  position: relative !important;
}

body.cosmic-dark input[type="text"],
body.cosmic-dark input[type="email"],
body.cosmic-dark input[type="password"],
body.cosmic-dark input[type="number"],
body.cosmic-dark textarea,
body.cosmic-dark select,
body.cosmic-dark #search-input {
  background: var(--form-input-bg-dark) !important;
  border: var(--form-input-border-dark) !important;
  color: var(--form-input-color-dark) !important;
  box-shadow: var(--form-input-shadow-dark) !important;
}

body.cosmic-light input[type="text"],
body.cosmic-light input[type="email"],
body.cosmic-light input[type="password"],
body.cosmic-light input[type="number"],
body.cosmic-light textarea,
body.cosmic-light select,
body.cosmic-light #search-input {
  background: var(--form-input-bg-light) !important;
  border: var(--form-input-border-light) !important;
  color: var(--form-input-color-light) !important;
  box-shadow: var(--form-input-shadow-light) !important;
}

body.cosmic-dark input[type="text"]:focus,
body.cosmic-dark input[type="email"]:focus,
body.cosmic-dark input[type="password"]:focus,
body.cosmic-dark input[type="number"]:focus,
body.cosmic-dark textarea:focus,
body.cosmic-dark select:focus,
body.cosmic-dark #search-input:focus {
  background: var(--form-input-focus-bg-dark) !important;
  border-color: var(--form-input-focus-border-dark) !important;
  box-shadow: var(--form-input-focus-shadow-dark) !important;
  outline: none !important;
}

body.cosmic-light input[type="text"]:focus,
body.cosmic-light input[type="email"]:focus,
body.cosmic-light input[type="password"]:focus,
body.cosmic-light input[type="number"]:focus,
body.cosmic-light textarea:focus,
body.cosmic-light select:focus,
body.cosmic-light #search-input:focus {
  background: var(--form-input-focus-bg-light) !important;
  border-color: var(--form-input-focus-border-light) !important;
  box-shadow: var(--form-input-focus-shadow-light) !important;
  outline: none !important;
}

/* Labels */
label {
  display: block !important;
  margin: var(--form-label-margin) !important;
  font-weight: var(--form-label-font-weight) !important;
}

body.cosmic-dark label {
  color: var(--form-label-color-dark) !important;
}

body.cosmic-light label {
  color: var(--form-label-color-light) !important;
}

/* Buttons */
button, 
.btn,
input[type="submit"],
.buy-button,
.view-all,
#search-button {
  background: var(--button-bg-primary) !important;
  border: none !important;
  padding: var(--button-padding) !important;
  border-radius: var(--button-border-radius) !important;
  font-size: var(--button-font-size) !important;
  font-weight: var(--button-font-weight) !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
}

body.cosmic-dark button,
body.cosmic-dark .btn,
body.cosmic-dark input[type="submit"],
body.cosmic-dark .buy-button,
body.cosmic-dark .view-all,
body.cosmic-dark #search-button {
  color: var(--button-color-dark) !important;
  box-shadow: var(--button-shadow-dark) !important;
}

body.cosmic-light button,
body.cosmic-light .btn,
body.cosmic-light input[type="submit"],
body.cosmic-light .buy-button,
body.cosmic-light .view-all,
body.cosmic-light #search-button {
  color: var(--button-color-light) !important;
  box-shadow: var(--button-shadow-light) !important;
}

button::before,
.btn::before,
input[type="submit"]::before,
.buy-button::before,
.view-all::before,
#search-button::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

button:hover,
.btn:hover,
input[type="submit"]:hover,
.buy-button:hover,
.view-all:hover,
#search-button:hover {
  transform: var(--button-hover-transform) !important;
}

button:hover::before,
.btn:hover::before,
input[type="submit"]:hover::before,
.buy-button:hover::before,
.view-all:hover::before,
#search-button:hover::before {
  left: 100% !important;
}

/* Secondary button */
.btn-secondary {
  background: var(--button-bg-secondary) !important;
}

/* Tables */
table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: var(--table-margin) !important;
  overflow: hidden !important;
  border-radius: var(--table-border-radius) !important;
}

body.cosmic-dark table {
  background-color: var(--table-bg-dark) !important;
  box-shadow: var(--table-shadow-dark) !important;
}

body.cosmic-light table {
  background-color: var(--table-bg-light) !important;
  box-shadow: var(--table-shadow-light) !important;
}

th, td {
  padding: var(--table-cell-padding) !important;
  text-align: left !important;
}

body.cosmic-dark th {
  background-color: var(--table-header-bg-dark) !important;
  color: var(--table-header-color-dark) !important;
  border-bottom: 1px solid var(--table-header-border-dark) !important;
}

body.cosmic-light th {
  background-color: var(--table-header-bg-light) !important;
  color: var(--table-header-color-light) !important;
  border-bottom: 1px solid var(--table-header-border-light) !important;
}

body.cosmic-dark td {
  border-bottom: 1px solid var(--table-row-border-dark) !important;
}

body.cosmic-light td {
  border-bottom: 1px solid var(--table-row-border-light) !important;
}

body.cosmic-dark tr:hover {
  background-color: var(--table-row-hover-bg-dark) !important;
}

body.cosmic-light tr:hover {
  background-color: var(--table-row-hover-bg-light) !important;
}

/* Cards */
.card,
.hacker-card {
  border-radius: var(--card-border-radius) !important;
  overflow: hidden !important;
  margin: var(--card-margin) !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
}

body.cosmic-dark .card,
body.cosmic-dark .hacker-card {
  background: var(--card-bg-dark) !important;
  border: var(--card-border-dark) !important;
  box-shadow: var(--card-shadow-dark) !important;
}

body.cosmic-light .card,
body.cosmic-light .hacker-card {
  background: var(--card-bg-light) !important;
  border: var(--card-border-light) !important;
  box-shadow: var(--card-shadow-light) !important;
}

.card:hover,
.hacker-card:hover {
  transform: var(--card-hover-transform) !important;
}

body.cosmic-dark .card:hover,
body.cosmic-dark .hacker-card:hover {
  box-shadow: var(--card-hover-shadow-dark) !important;
}

body.cosmic-light .card:hover,
body.cosmic-light .hacker-card:hover {
  box-shadow: var(--card-hover-shadow-light) !important;
}

.card-header {
  padding: 15px 20px !important;
  border-bottom: 1px solid !important;
}

body.cosmic-dark .card-header {
  border-color: var(--card-header-border-dark) !important;
  background: var(--card-header-bg-dark) !important;
}

body.cosmic-light .card-header {
  border-color: var(--card-header-border-light) !important;
  background: var(--card-header-bg-light) !important;
}

.card-body {
  padding: var(--card-padding) !important;
}

.card-footer {
  padding: 15px 20px !important;
  border-top: 1px solid !important;
}

body.cosmic-dark .card-footer {
  border-color: var(--card-footer-border-dark) !important;
  background: var(--card-footer-bg-dark) !important;
}

body.cosmic-light .card-footer {
  border-color: var(--card-footer-border-light) !important;
  background: var(--card-footer-bg-light) !important;
}

/* Badges */
.badge {
  display: inline-block !important;
  padding: var(--badge-padding) !important;
  border-radius: var(--badge-border-radius) !important;
  font-size: var(--badge-font-size) !important;
  font-weight: var(--badge-font-weight) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

body.cosmic-dark .badge-primary {
  background: var(--badge-primary-bg-dark) !important;
  color: var(--badge-primary-text-dark) !important;
}

body.cosmic-light .badge-primary {
  background: var(--badge-primary-bg-light) !important;
  color: var(--badge-primary-text-light) !important;
}

body.cosmic-dark .badge-secondary {
  background: var(--badge-secondary-bg-dark) !important;
  color: var(--badge-secondary-text-dark) !important;
}




body.cosmic-light .badge-secondary {
  background: var(--badge-secondary-bg-light) !important;
  color: var(--badge-secondary-text-light) !important;
}

/* Marketplace specific styles */
body.cosmic-dark .hacker-title {
  color: var(--marketplace-hacker-title-dark) !important;
  text-shadow: var(--marketplace-hacker-title-shadow-dark) !important;
}

body.cosmic-light .hacker-title {
  color: var(--marketplace-hacker-title-light) !important;
  text-shadow: var(--marketplace-hacker-title-shadow-light) !important;
}

body.cosmic-dark .card-content {
  background-color: var(--marketplace-card-content-bg-dark) !important;
}

body.cosmic-light .card-content {
  background-color: var(--marketplace-card-content-bg-light) !important;
}

body.cosmic-dark .primary-text {
  color: var(--marketplace-primary-text-dark) !important;
}

body.cosmic-light .primary-text {
  color: var(--marketplace-primary-text-light) !important;
}

body.cosmic-dark .card-price {
  background-color: var(--marketplace-card-price-bg-dark) !important;
}

body.cosmic-light .card-price {
  background-color: var(--marketplace-card-price-bg-light) !important;
}

body.cosmic-dark .terminal-header {
  background-color: var(--marketplace-terminal-header-bg-dark) !important;
}

body.cosmic-light .terminal-header {
  background-color: var(--marketplace-terminal-header-bg-light) !important;
}

/* Marketplace layout styles */
.marketplace-container,
.grid-container {
  width: 100% !important;
  max-width: var(--container-max-width) !important;
  margin-left: auto !important;
  margin-right: auto !important;
  padding: 20px !important;
  box-sizing: border-box !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
}

.grid-container {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
  gap: var(--marketplace-grid-gap) !important;
  justify-items: center !important;
  align-items: stretch !important;
}

.hacker-card {
  width: 100% !important;
  max-width: var(--marketplace-card-max-width) !important;
  margin: 15px auto !important;
  display: flex !important;
  flex-direction: column !important;
  height: 100% !important;
  min-height: var(--marketplace-card-min-height) !important;
  box-sizing: border-box !important;
}

.terminal-section {
  width: 100% !important;
  max-width: 1000px !important;
  margin: 20px auto !important;
  box-sizing: border-box !important;
}

.search-form {
  width: 100% !important;
  max-width: var(--marketplace-search-max-width) !important;
  margin: 20px auto !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  gap: 10px !important;
}

#search-input {
  flex: 1 !important;
  max-width: 70% !important;
}

#search-button {
  min-width: 120px !important;
}

.card-content {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  width: 100% !important;
  justify-content: space-between !important;
}

.hacker-card img {
  width: 100% !important;
  height: auto !important;
  max-height: 200px !important;
  object-fit: cover !important;
  border-radius: 8px 8px 0 0 !important;
}

/* Animations */
@keyframes cosmic-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes cosmic-pulse {
  0%, 100% {
    opacity: 0.5;
  }
  50% {
    opacity: 1;
  }
}

@keyframes cosmic-float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(var(--cosmic-float-distance));
  }
}

@keyframes cosmic-glow {
  0%, 100% {
    box-shadow: 0 0 10px rgba(0, 204, 255, 0.5);
  }
  50% {
    box-shadow: 0 0 20px rgba(0, 204, 255, 0.8);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .signup-container,
  .reset-password-container,
  .recover-account-container,
  .withdraw-container,
  .withdraw-history-container,
  .view-links-container,
  .view-orders-container,
  .invoice-container,
  .block-container,
  .terminal-section,
  .grid-container {
    padding: 20px !important;
    margin: 30px auto !important;
    width: 90% !important;
  }
  
  h1 {
    font-size: 2rem !important;
  }
  
  h2 {
    font-size: 1.8rem !important;
  }
  
  .cosmic-theme-toggle {
    top: 10px !important;
    left: 10px !important;
    width: 40px !important;
    height: 40px !important;
  }
  
  .block {
    padding: 15px !important;
  }
  
  .grid-container {
    grid-template-columns: 1fr !important;
  }
  
  .hacker-card {
    max-width: 100% !important;
  }
  
  .search-form {
    flex-direction: column !important;
    align-items: stretch !important;
  }
  
  #search-input {
    max-width: 100% !important;
    margin-bottom: 10px !important;
  }
  
  #search-button {
    width: 100% !important;
  }
}
/* Marketplace centering fixes */
.marketplace-container,
.grid-container {
  width: 100% !important;
  max-width: 1200px !important;
  margin-left: auto !important;
  margin-right: auto !important;
  padding: 20px !important;
  box-sizing: border-box !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
}

/* Grid layout with proper centering */
.grid-container {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
  gap: 20px !important;
  justify-items: center !important;
  align-items: stretch !important;
}

/* Ensure cards have consistent width */
.hacker-card {
  width: 100% !important;
  max-width: 350px !important;
  margin: 15px auto !important;
  display: flex !important;
  flex-direction: column !important;
  height: 100% !important;
  min-height: 300px !important;
  box-sizing: border-box !important;
}

/* Terminal section centering */
.terminal-section {
  width: 100% !important;
  max-width: 1000px !important;
  margin: 20px auto !important;
  box-sizing: border-box !important;
}

/* Search form centering */
.search-form {
  width: 100% !important;
  max-width: 600px !important;
  margin: 20px auto !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  gap: 10px !important;
}

/* Fix for search input and button */
#search-input {
  flex: 1 !important;
  max-width: 70% !important;
}

#search-button {
  min-width: 120px !important;
}

/* Fix for card content */
.card-content {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  width: 100% !important;
  justify-content: space-between !important;
}

/* Fix for card images */
.hacker-card img {
  width: 100% !important;
  height: auto !important;
  max-height: 200px !important;
  object-fit: cover !important;
  border-radius: 8px 8px 0 0 !important;
}

/* Fix for any overflow issues */
.hacker-card,
.terminal-section {
  overflow: hidden !important; /* Contain content */
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr !important; /* Single column on mobile */
  }
  
  .hacker-card {
    max-width: 100% !important;
  }
  
  .search-form {
    flex-direction: column !important;
    align-items: stretch !important;
  }
  
  #search-input {
    max-width: 100% !important;
    margin-bottom: 10px !important;
  }
  
  #search-button {
    width: 100% !important;
  }
}

/* Override for marketplace containers in admin */
body.cosmic-dark .terminal-section, 
body.cosmic-dark .hacker-card, 
body.cosmic-dark .search-form {
  background-color: rgba(18, 18, 37, 0.8) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .terminal-section, 
body.cosmic-light .hacker-card, 
body.cosmic-light .search-form {
  background-color: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

/* Cosmic glow effect for marketplace containers */
.terminal-section::before,
.hacker-card::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

/* Marketplace section titles */
body.cosmic-dark .section-title,
body.cosmic-dark .card-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 255, 255, 0.5) !important;
}

body.cosmic-light .section-title,
body.cosmic-light .card-title {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

/* Special styling for marketplace buttons */
.buy-button,
.view-all,
#search-button {
  background: linear-gradient(45deg, #00ccff, #0066ff) !important;
  border: none !important;
  padding: 12px 25px !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  font-weight: bold !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
}

body.cosmic-dark .buy-button,
body.cosmic-dark .view-all,
body.cosmic-dark #search-button {
  color: #000 !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .buy-button,
body.cosmic-light .view-all,
body.cosmic-light #search-button {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(0, 102, 255, 0.5) !important;
}

.buy-button::before,
.view-all::before,
#search-button::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

.buy-button:hover,
.view-all:hover,
#search-button:hover {
  transform: translateY(-3px) !important;
}

.buy-button:hover::before,
.view-all:hover::before,
#search-button:hover::before {
  left: 100% !important;
}

/* Service Marketplace Styling with !important overrides */
body {
    background-color: var(--bg-color) !important;
}

.service-container {
    background: var(--bg-card) !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    padding: 25px !important;
    margin-bottom: 40px !important;
    border: 1px solid var(--border-color) !important;
    position: relative !important;
}

.service-container::before {
    
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 4px !important;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)) !important;
}

/* Service Header */
.service-header {
    padding-bottom: 20px !important;
    margin-bottom: 20px !important;
    border-bottom: 1px solid var(--border-color) !important;
}

.service-title {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: var(--primary-color) !important;
    margin-bottom: 12px !important;
}

.service-header description {
    display: block !important;
    font-size: 16px !important;
    margin-bottom: 18px !important;
    color: var(--text-color) !important;
    line-height: 1.5 !important;
}

/* Vendor Profile */
.vendor-profile {
    display: flex !important;
    align-items: center !important;
    padding: 12px !important;
    background: rgba(0, 0, 0, 0.05) !important;
    border-radius: 8px !important;
    border: 1px solid var(--border-color) !important;
}

.vendor-avatar {
    margin-right: 15px !important;
}

.vendor-avatar img {
    width: 50px !important;
    height: 50px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    border: 2px solid var(--primary-color) !important;
}

.vendor-name {
    font-size: 16px !important;
    font-weight: 600 !important;
    margin-bottom: 4px !important;
    display: flex !important;
    align-items: center !important;
}

.vendor-name i {
    color: var(--primary-color) !important;
    margin-left: 6px !important;
    font-size: 14px !important;
}

.vendor-date {
    font-size: 13px !important;
    color: var(--text-muted) !important;
    margin-bottom: 6px !important;
}

.vendor-stats {
    display: flex !important;
    gap: 12px !important;
}

.vendor-stat {
    font-size: 13px !important;
    display: flex !important;
    align-items: center !important;
}

.vendor-stat i {
    color: var(--primary-color) !important;
    margin-right: 4px !important;
}

/* Service Content */
.service-content {
    margin-top: 25px !important;
}

.service-image-container {
    border-radius: 8px !important;
    overflow: hidden !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    margin-bottom: 20px !important;
}

.service-image {
    width: 100% !important;
    object-fit: cover !important;
    aspect-ratio: 16/9 !important;
    transition: transform 0.3s ease !important;
}

.service-image:hover {
    transform: scale(1.02) !important;
}

/* Locked Content Overlay */
.locked-overlay {
    background: rgba(15, 22, 32, 0.9) !important;
    border-radius: 8px !important;
    padding: 25px !important;
    text-align: center !important;
    border: 1px solid var(--border-color) !important;
    margin-top: 15px !important;
}

.lock-icon {
    font-size: 36px !important;
    color: var(--primary-color) !important;
    margin-bottom: 12px !important;
    animation: pulse 2s infinite !important;
}

@keyframes pulse {
    0% {
        transform: scale(1) !important;
        opacity: 1 !important;
    }
    50% {
        transform: scale(1.1) !important;
        opacity: 0.8 !important;
    }
    100% {
        transform: scale(1) !important;
        opacity: 1 !important;
    }
}

.locked-content {
    font-size: 20px !important;
    font-weight: 600 !important;
    margin-bottom: 12px !important;
}

/* Purchase Card */
.purchase-card {
    background: var(--bg-card) !important;
    border-radius: 8px !important;
    border: 1px solid var(--border-color) !important;
    padding: 20px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    height: 100% !important;
}

.price-tag {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: var(--primary-color) !important;
    text-align: center !important;
    margin-bottom: 18px !important;
    position: relative !important;
    padding-bottom: 12px !important;
}

.price-tag::after {
    
    position: absolute !important;
    bottom: 0 !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: 70px !important;
    height: 2px !important;
    background: linear-gradient(90deg, var(--primary-color), transparent) !important;
}

.price-tag small {
    font-size: 14px !important;
    opacity: 0.8 !important;
}

/* Security Badges */
.security-badges {
    display: flex !important;
    justify-content: space-between !important;
    margin-bottom: 18px !important;
}

.security-badge {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    text-align: center !important;
    flex: 1 !important;
}

.security-badge i {
    font-size: 20px !important;
    color: var(--primary-color) !important;
    margin-bottom: 4px !important;
}

.security-badge span {
    font-size: 13px !important;
    font-weight: 500 !important;
}

/* Purchase Button */
.purchase-button {
    width: 100% !important;
    padding: 12px 18px !important;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    margin: 18px 0 !important;
    position: relative !important;
    overflow: hidden !important;
    text-align: center !important;
}

.purchase-button::before {
    
    position: absolute !important;
    top: 0 !important;
    left: -100% !important;
    width: 100% !important;
    height: 100% !important;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
    transition: 0.5s !important;
}

.purchase-button:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
}

.purchase-button:hover::before {
    left: 100% !important;
}

.spinner {
    width: 18px !important;
    height: 18px !important;
    border: 3px solid transparent !important;
    border-top-color: #fff !important;
    border-radius: 50% !important;
    animation: spin 1s linear infinite !important;
    display: inline-block !important;
    vertical-align: middle !important;
    margin-right: 8px !important;
}

@keyframes spin {
    to {
        transform: rotate(360deg) !important;
    }
}

/* What You Get Section */
.list-group-item {
    display: flex !important;
    align-items: center !important;
    margin-bottom: 8px !important;
    background: var(--bg-card) !important;
    border-radius: 6px !important;
    padding: 10px 12px !important;
    transition: all 0.3s ease !important;
    border: 1px solid var(--border-color) !important;
}

.list-group-item:hover {
    transform: translateX(5px) !important;
    border-left: 3px solid var(--primary-color) !important;
}

.list-group-item i {
    margin-right: 8px !important;
    color: var(--primary-color) !important;
}

/* Security Notice */
.security-notice {
    margin-top: 20px !important;
    border-radius: 8px !important;
    border: 1px solid var(--border-color) !important;
    overflow: hidden !important;
    background: var(--bg-card) !important;
}

.security-notice-title {
    padding: 12px 18px !important;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)) !important;
    color: #fff !important;
    font-weight: 600 !important;
    display: flex !important;
    align-items: center !important;
    font-size: 15px !important;
}

.security-notice-title i {
    margin-right: 8px !important;
}

.security-notice-content {
    padding: 18px !important;
    font-size: 14px !important;
}

.security-notice-content p {
    margin-bottom: 12px !important;
    line-height: 1.5 !important;
}

.security-notice-content ul,
.security-notice-content ol {
    padding-left: 20px !important;
    margin-bottom: 12px !important;
}

.security-notice-content li {
    margin-bottom: 6px !important;
    line-height: 1.5 !important;
}

/* Related Services Section */
.related-section {
    margin-top: 50px !important;
    margin-bottom: 50px !important;
}

.related-title {
    font-size: 24px !important;
    font-weight: 700 !important;
    margin-bottom: 25px !important;
    color: var(--primary-color) !important;
    position: relative !important;
    padding-bottom: 8px !important;
    display: inline-block !important;
}

.related-title::after {
    
    position: absolute !important;
    bottom: 0 !important;
    left: 0 !important;
    width: 60% !important;
    height: 2px !important;
    background: linear-gradient(90deg, var(--primary-color), transparent) !important;
}

.related-card {
    background: var(--bg-card) !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease !important;
    height: 100% !important;
    border: 1px solid var(--border-color) !important;
    position: relative !important;
}

.related-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
}

.related-card::before {
    
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 3px !important;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)) !important;
    z-index: 1 !important;
}

.related-image {
    width: 100% !important;
    height: 160px !important;
    overflow: hidden !important;
    position: relative !important;
}

.related-image img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transition: all 0.3s ease !important;
}

.related-card:hover .related-image img {
    transform: scale(1.05) !important;
}

.related-content {
    padding: 15px !important;
}

.related-name {
    font-size: 16px !important;
    font-weight: 600 !important;
    margin-bottom: 12px !important;
    transition: all 0.3s ease !important;
}

.related-card:hover .related-name {
    color: var(--primary-color) !important;
}

.related-vendor {
    display: flex !important;
    align-items: center !important;
    margin-bottom: 12px !important;
}

.related-vendor-avatar {
    width: 26px !important;
    height: 26px !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    margin-right: 8px !important;
    border: 2px solid var(--primary-color) !important;
}

.related-vendor-avatar img {
       width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
}

.related-vendor-name {
    font-size: 13px !important;
    color: var(--text-muted) !important;
}

.related-price {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: var(--primary-color) !important;
    margin-bottom: 12px !important;
}

.related-buy {
    display: block !important;
    padding: 8px !important;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)) !important;
    color: #fff !important;
    text-align: center !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.related-buy:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15) !important;
    text-decoration: none !important;
    color: #fff !important;
}

/* Share Container Styles */
.share-container {
    margin-top: 30px !important;
    padding: 18px !important;
    background: var(--bg-card) !important;
    border-radius: 8px !important;
    text-align: center !important;
    border: 1px solid var(--border-color) !important;
}

.share-title {
    font-size: 16px !important;
    font-weight: 600 !important;
    margin-bottom: 12px !important;
    color: var(--primary-color) !important;
}

.share-buttons {
    display: flex !important;
    justify-content: center !important;
    gap: 12px !important;
}

.share-button {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 18px !important;
    color: #fff !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
}

.share-button:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15) !important;
    text-decoration: none !important;
    color: #fff !important;
}

.share-button.facebook {
    background: #3b5998 !important;
}

.share-button.twitter {
    background: #1da1f2 !important;
}

.share-button.pinterest {
    background: #bd081c !important;
}

/* Body and Background Overrides */
body.service-page {
    background-color: var(--bg-color, #f5f7fa) !important;
}

body.service-page.dark-mode {
    background-color: var(--bg-color-dark, #0f1620) !important;
    color: var(--text-color-dark, #e0e0e0) !important;
}

/* Alert Styling */
.alert {
    padding: 15px !important;
    border-radius: 8px !important;
    margin-bottom: 20px !important;
}

.alert-success {
    background-color: rgba(46, 204, 113, 0.1) !important;
    border: 1px solid rgba(46, 204, 113, 0.3) !important;
    color: #2ecc71 !important;
}

.alert-warning {
    background-color: rgba(241, 196, 15, 0.1) !important;
    border: 1px solid rgba(241, 196, 15, 0.3) !important;
    color: #f1c40f !important;
}

.alert-info {
    background-color: rgba(52, 152, 219, 0.1) !important;
    border: 1px solid rgba(52, 152, 219, 0.3) !important;
    color: #3498db !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .service-container {
        padding: 15px !important;
    }
    
    .service-title {
        font-size: 22px !important;
    }
    
    .vendor-profile {
        flex-direction: column !important;
        text-align: center !important;
    }
    
    .vendor-avatar {
        margin-right: 0 !important;
        margin-bottom: 10px !important;
    }
    
    .vendor-stats {
        justify-content: center !important;
    }
    
    .security-badges {
        flex-wrap: wrap !important;
    }
    
    .security-badge {
        flex: 0 0 50% !important;
        margin-bottom: 10px !important;
    }
    
    .related-card {
        margin-bottom: 20px !important;
    }
}

/* Additional overrides for theme compatibility */
.service-container h1, 
.service-container h2, 
.service-container h3, 
.service-container h4, 
.service-container h5, 
.service-container h6 {
    color: var(--primary-color) !important;
    margin-top: 15px !important;
    margin-bottom: 10px !important;
    font-weight: 600 !important;
}

.service-container p {
    margin-bottom: 15px !important;
    line-height: 1.6 !important;
}

.service-container a:not(.purchase-button):not(.related-buy):not(.share-button) {
    color: var(--primary-color) !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: color 0.3s ease !important;
}

.service-container a:not(.purchase-button):not(.related-buy):not(.share-button):hover {
    color: var(--secondary-color) !important;
    text-decoration: underline !important;
}

/* Custom scrollbar for better UX */
.service-container::-webkit-scrollbar {
    width: 8px !important;
}

.service-container::-webkit-scrollbar-track {
    background: var(--bg-card) !important;
}

.service-container::-webkit-scrollbar-thumb {
    background-color: var(--primary-color) !important;
    border-radius: 20px !important;
}

/* Force dark mode styles */
body.dark-mode .service-container,
body.dark-mode .purchase-card,
body.dark-mode .list-group-item,
body.dark-mode .security-notice,
body.dark-mode .related-card {
    background-color: var(--bg-card-dark, #151f2e) !important;
    border-color: var(--border-color-dark, #1e2a3a) !important;
    color: var(--text-color-dark, #e0e0e0) !important;
}

/* Force body background */
html body {
    background-color: var(--bg-color, #f5f7fa) !important;
}

html body.dark-mode {
    background-color: var(--bg-color-dark, #0f1620) !important;
}





/* Announcement ticker cosmic styling */
.pn-feed,
.pn-announcement,
.pn-announcement-header,
.pn-ticker,
.pn-ticker-items,
.pn-ticker-item {
  position: relative !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}

.pn-announcement {
  margin: 20px 0 !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-dark .pn-announcement {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.8), rgba(10, 10, 30, 0.9)) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .pn-announcement {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(240, 245, 255, 0.9)) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

.pn-announcement-header {
  padding: 15px !important;
  display: flex !important;
  align-items: center !important;
}

body.cosmic-dark .pn-announcement-header {
  border-bottom: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .pn-announcement-header {
  border-bottom: 1px solid rgba(0, 102, 255, 0.1) !important;
}

.pn-announcement-icon {
  width: 40px !important;
  height: 40px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-right: 15px !important;
}

body.cosmic-dark .pn-announcement-icon {
  background: rgba(0, 255, 255, 0.1) !important;
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-icon {
  background: rgba(0, 102, 255, 0.1) !important;
  color: var(--cosmic-accent) !important;
}

.pn-announcement-title {
  font-weight: 600 !important;
  font-size: 1.1rem !important;
}

body.cosmic-dark .pn-announcement-title {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-title {
  color: var(--cosmic-accent) !important;
}

.pn-announcement-time {
  font-size: 0.9rem !important;
}

body.cosmic-dark .pn-announcement-time {
  color: rgba(224, 224, 255, 0.7) !important;
}

body.cosmic-light .pn-announcement-time {
  color: rgba(18, 18, 37, 0.7) !important;
}

.pn-ticker {
  padding: 15px !important;
  position: relative !important;
}

.pn-ticker-item {
  padding: 10px !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .pn-ticker-item {
  background: rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-light .pn-ticker-item {
  background: rgba(255, 255, 255, 0.5) !important;
}

.pn-announcement-link {
  display: inline-flex !important;
  align-items: center !important;
  margin-top: 8px !important;
  font-size: 0.9rem !important;
  font-weight: 600 !important;
}

body.cosmic-dark .pn-announcement-link {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-link {
  color: var(--cosmic-accent) !important;
}

.pn-announcement-link-icon {
  margin-left: 5px !important;
  transition: transform 0.3s ease !important;
}

.pn-announcement-link:hover .pn-announcement-link-icon {
  transform: translateX(3px) !important;
}

.pn-ticker-dots {
  display: flex !important;
  justify-content: center !important;
  margin-top: 15px !important;
  padding-bottom: 10px !important;
}

.pn-ticker-dot {
  width: 10px !important;
  height: 10px !important;
  border-radius: 50% !important;
  margin: 0 5px !important;
  cursor: pointer !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .pn-ticker-dot {
  background: rgba(255, 255, 255, 0.3) !important;
}

body.cosmic-light .pn-ticker-dot {
  background: rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-dark .pn-ticker-dot.active {
  background: var(--cosmic-primary) !important;
  box-shadow: 0 0 10px var(--cosmic-primary) !important;
}

body.cosmic-light .pn-ticker-dot.active {
  background: var(--cosmic-accent) !important;
  box-shadow: 0 0 10px var(--cosmic-accent) !important;
}

/* Background image if enabled for light theme */
' . (($_POST['background_type'] ?? 'none') === 'image' && !empty($_POST['background_image_url_light']) ? '
body.cosmic-light::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("' . $_POST['background_image_url_light'] . '");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: ' . ($_POST['background_image_opacity'] ?? '0.2') . ';
    mix-blend-mode: ' . ($_POST['background_blend_mode'] ?? 'normal') . ';
    z-index: -1;
}' : '') . '

/* Background image if enabled for dark theme */
' . (($_POST['background_type'] ?? 'none') === 'image' && !empty($_POST['background_image_url_dark']) ? '
body.cosmic-dark::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("' . $_POST['background_image_url_dark'] . '");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: ' . ($_POST['background_image_opacity'] ?? '0.2') . ';
    mix-blend-mode: ' . ($_POST['background_blend_mode'] ?? 'normal') . ';
    z-index: -1;
}' : '') . '
</style>

<script>
// Create and append theme toggle button
document.addEventListener("DOMContentLoaded", function() {
  // Add cosmic classes to body - always start with dark mode
  document.body.classList.add("cosmic-dark");
  
  // Create particles container
  const particlesContainer = document.createElement("div");
  particlesContainer.className = "cosmic-particles";
  particlesContainer.id = "cosmic-particles";
  document.body.appendChild(particlesContainer);
  
  // Create theme toggle button
  const themeToggle = document.createElement("button");
  themeToggle.className = "cosmic-theme-toggle";
  themeToggle.innerHTML = \'<i class="fas fa-moon"></i>\';
  themeToggle.title = "Toggle Light/Dark Mode";
  
  // Check if Font Awesome is loaded, if not, load it
  if (!document.querySelector(\'link[href*="font-awesome"]\')) {
    const fontAwesome = document.createElement("link");
    fontAwesome.rel = "stylesheet";
    fontAwesome.href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css";
    document.head.appendChild(fontAwesome);
  }
  
  document.body.appendChild(themeToggle);
  
  // Theme toggle functionality
  themeToggle.addEventListener("click", function() {
    if (document.body.classList.contains("cosmic-dark")) {
      document.body.classList.remove("cosmic-dark");
      document.body.classList.add("cosmic-light");
      this.innerHTML = \'<i class="fas fa-sun"></i>\';
      localStorage.setItem("cosmic-theme", "light");
    } else {
      document.body.classList.remove("cosmic-light");
      document.body.classList.add("cosmic-dark");
      this.innerHTML = \'<i class="fas fa-moon"></i>\';
      localStorage.setItem("cosmic-theme", "dark");
    }
  });
  
  // Check for saved theme preference
  const savedTheme = localStorage.getItem("cosmic-theme");
  if (savedTheme === "light") {
    document.body.classList.remove("cosmic-dark");
    document.body.classList.add("cosmic-light");
    themeToggle.innerHTML = \'<i class="fas fa-sun"></i>\';
  }

  // Apply pattern or animation classes if needed
  const backgroundType = "' . ($_POST['background_type'] ?? 'none') . '";
  
  if (backgroundType === "patterns") {
    const patternClass = "' . ($_POST['pattern_style'] ?? 'pattern1') . '";
    document.body.classList.add(patternClass);
  } else if (backgroundType === "animated") {
    const animationClass = "animated-' . ($_POST['animation_style'] ?? 'gradient-shift') . '";
    document.body.classList.add(animationClass);
  } else if (backgroundType === "particles") {
    initializeParticles("' . ($_POST['particle_type'] ?? 'circles') . '", 
                        ' . ($_POST['particle_density'] ?? '50') . ', 
                        ' . ($_POST['particle_speed'] ?? '3') . ', 
                        ' . ($_POST['particle_size'] ?? '3') . ');
  }
  
  // Create and animate particles
  createParticles();
  
  // Add hover effects to all buttons
  addButtonEffects();
  
  // Add floating animation to containers
  addFloatingEffect();
  
  // Process any session messages
  processSessionMessages();
  
  // Add block styling
  enhanceBlocks();
  
  // Initialize announcement ticker
  initAnnouncementTicker();
  
  // Set up observer for dynamically loaded content
  setupDynamicContentObserver();
});

// Initialize particles for particle background type
function initializeParticles(type, density, speed, size) {
  if (typeof particlesJS === "undefined") {
    // Load particles.js if not already loaded
    const script = document.createElement("script");
    script.src = "https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js";
    script.onload = function() {
      setupParticles(type, density, speed, size);
    };
    document.head.appendChild(script);
  } else {
    setupParticles(type, density, speed, size);
  }
}

function setupParticles(type, density, speed, size) {
  // Create particles container if needed
  let particlesContainer = document.getElementById("particles-js");
  if (!particlesContainer) {
    particlesContainer = document.createElement("div");
    particlesContainer.id = "particles-js";
    particlesContainer.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    `;
    document.body.appendChild(particlesContainer);
  }
  
  // Configure particles
  const isDark = document.body.classList.contains("cosmic-dark");
  particlesJS("particles-js", {
    particles: {
      number: { value: density },
      color: { value: isDark ? "#00ffff" : "#0066ff" },
      shape: { type: type },
      size: { value: size },
      move: {
        enable: true,
        speed: speed,
        direction: "none",
        random: true,
        straight: false,
        out_mode: "out"
      },
      line_linked: {
        enable: type !== "snow" && type !== "confetti",
        distance: 150,
        color: isDark ? "#00ffff" : "#0066ff",
        opacity: 0.4,
        width: 1
      },
      opacity: { value: 0.5, random: true }
    },
    interactivity: {
      detect_on: "canvas",
      events: {
        onhover: { enable: true, mode: "grab" },
        onclick: { enable: true, mode: "push" }
      }
    }
  });
}

// Create cosmic particles
function createParticles() {
  const particlesContainer = document.getElementById("cosmic-particles");
  const particleCount = 50;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div");
    particle.className = "cosmic-particle";
    
    // Random particle styling
    const size = Math.random() * 5 + 1;
    const isDark = document.body.classList.contains("cosmic-dark");
    
    particle.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      background-color: ${isDark ? 
        `rgba(${Math.floor(Math.random() * 100 + 155)}, ${Math.floor(Math.random() * 100 + 155)}, 255, ${Math.random() * 0.5 + 0.2})` : 
        `rgba(${Math.floor(Math.random() * 50 + 100)}, ${Math.floor(Math.random() * 50 + 50)}, ${Math.floor(Math.random() * 100 + 155)}, ${Math.random() * 0.5 + 0.2})`};
      border-radius: 50%;
      top: ${Math.random() * 100}vh;
      left: ${Math.random() * 100}vw;
      box-shadow: 0 0 ${size * 2}px ${isDark ? "rgba(0, 255, 255, 0.8)" : "rgba(123, 104, 238, 0.8)"};
      animation: cosmic-float ${Math.random() * 10 + 10}s infinite ease-in-out, 
                 cosmic-pulse ${Math.random() * 5 + 5}s infinite ease-in-out;
      animation-delay: ${Math.random() * 5}s;
      z-index: -1;
      pointer-events: none;
    `;
    
    particlesContainer.appendChild(particle);
  }
  
  // Update particles when theme changes
  document.querySelector(".cosmic-theme-toggle").addEventListener("click", function() {
    particlesContainer.innerHTML = "";
    setTimeout(createParticles, 100);
  });
}

// Add hover effects to buttons
function addButtonEffects() {
  const buttons = document.querySelectorAll("button, .btn, input[type=\'submit\'], .buy-button, .view-all, #search-button");
  
  buttons.forEach(button => {
    // Skip the theme toggle button
    if (button.classList.contains("cosmic-theme-toggle")) return;
    
    button.addEventListener("mouseover", function() {
      const isDark = document.body.classList.contains("cosmic-dark");
      this.style.boxShadow = isDark ? 
        "0 0 20px rgba(0, 255, 255, 0.8)" : 
        "0 0 20px rgba(123, 104, 238, 0.8)";
    });
    
    button.addEventListener("mouseout", function() {
      const isDark = document.body.classList.contains("cosmic-dark");
      this.style.boxShadow = isDark ? 
        "0 0 15px rgba(0, 204, 255, 0.5)" : 
        "0 0 15px rgba(123, 104, 238, 0.5)";
    });
  });
}

// Add floating animation to containers
function addFloatingEffect() {
  const containers = document.querySelectorAll(".signup-container, .reset-password-container, .recover-account-container, .withdraw-container, .withdraw-history-container, .view-links-container, .view-orders-container, .view-services-container .service-card, .invoice-container, .block-container");
  
  containers.forEach(container => {
    container.style.animation = `cosmic-float ${Math.random() * 2 + 8}s infinite ease-in-out`;
    container.style.animationDelay = `${Math.random() * 2}s`;
  });
}

// Process session messages
function processSessionMessages() {
  // Check for PHP session messages in hidden elements
  const sessionMessages = document.querySelectorAll(".session-message");
  
  sessionMessages.forEach(message => {
    const type = message.dataset.type || "info";
    const text = message.textContent;
    
    if (text && text.trim() !== "") {
      showNotification(text, type);
      // Hide the original message
          message.style.display = "none";
    }
  });
}

// Show notification
function showNotification(message, type = "info") {
  const notification = document.createElement("div");
  notification.className = `session-notification ${type}`;
  notification.innerHTML = message;
  
  document.body.appendChild(notification);
  
  // Remove notification after animation completes
  setTimeout(() => {
    notification.remove();
  }, 5500);
}

// Enhance blocks with icons and styling
function enhanceBlocks() {
  const blocks = document.querySelectorAll(".block");
  
  blocks.forEach(block => {
    const title = block.querySelector(".block-title");
    if (title) {
      // Add icon based on block type
      const blockType = block.dataset.type || "";
      let icon = "fa-info-circle";
      
      switch(blockType.toLowerCase()) {
        case "info":
          icon = "fa-info-circle";
          break;
        case "success":
          icon = "fa-check-circle";
          break;
        case "warning":
          icon = "fa-exclamation-triangle";
          break;
        case "error":
          icon = "fa-times-circle";
          break;
        case "user":
          icon = "fa-user";
          break;
        case "settings":
          icon = "fa-cog";
          break;
        case "stats":
          icon = "fa-chart-bar";
          break;
      }
      
      // Add icon if not already present
      if (!title.querySelector("i")) {
        title.innerHTML = `<i class="fas ${icon}"></i> ${title.innerHTML}`;
      }
    }
  });
}

// Initialize announcement ticker
function initAnnouncementTicker() {
  const tickerItems = document.querySelectorAll(".pn-ticker-item");
  const tickerDots = document.querySelectorAll(".pn-ticker-dot");
  
  if (tickerItems.length === 0) return;
  
  // Hide all items except the first one
  tickerItems.forEach((item, index) => {
    if (index !== 0) {
      item.style.display = "none";
    }
  });
  
  // Add click event to dots
  tickerDots.forEach(dot => {
    dot.addEventListener("click", function() {
      const index = this.getAttribute("data-index");
      
      // Hide all items
      tickerItems.forEach(item => {
        item.style.display = "none";
      });
      
      // Show selected item
      const selectedItem = document.querySelector(`.pn-ticker-item[data-index="${index}"]`);
      if (selectedItem) {
        selectedItem.style.display = "block";
      }
      
      // Update active dot
      tickerDots.forEach(d => {
        d.classList.remove("active");
      });
      this.classList.add("active");
    });
  });
  
  // Auto rotate announcements
  let currentIndex = 0;
  setInterval(() => {
    currentIndex = (currentIndex + 1) % tickerItems.length;
    const nextDot = document.querySelector(`.pn-ticker-dot[data-index="${currentIndex+1}"]`);
    if (nextDot) {
      nextDot.click();
    } else if (tickerDots.length > 0) {
      document.querySelector(`.pn-ticker-dot[data-index="1"]`).click();
    }
  }, 5000);
}

// Set up observer for dynamically loaded content
function setupDynamicContentObserver() {
  // Create a MutationObserver to watch for new content
  const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.addedNodes && mutation.addedNodes.length > 0) {
        // Check for newly added elements
        const dynamicElements = document.querySelectorAll(".terminal-section, .hacker-card, .buy-button, .view-all, #search-button, .card, .btn");
        if (dynamicElements.length > 0) {
          // Apply effects to new elements
          addButtonEffects();
          addFloatingEffect();
        }
      }
    });
  });
  
  // Start observing the document with the configured parameters
  observer.observe(document.body, { childList: true, subtree: true });
}

// Apply cosmic theme to new content
function applyCosmicThemeToNewContent() {
  // Re-apply styles to dynamic content
  addButtonEffects();
  addFloatingEffect();
  enhanceBlocks();
}
</script>
';


        
        file_put_contents($cssJsFilePath, $css);
        $success = "Theme has been updated successfully!";
    }
}

// Read current CSS content
$currentCss = file_get_contents($cssJsFilePath);

// Function to extract value from CSS
function extractCssValue($css, $property, $default) {
    preg_match('/--' . $property . ':\s*([^;]+);/', $css, $matches);
    return isset($matches[1]) ? trim($matches[1]) : $default;
}

?>

<div class="container">
    <?php if (isset($success)): ?>
        <div class="notification-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <h2>Cosmic Theme Customizer</h2>
    <p>Customize your Cosmic interface with these comprehensive theme settings.</p>

    <form method="post" action="">
        <div class="tabs">
            <div class="tab-header">
                <button type="button" class="tab-btn active" data-tab="general">General</button>
                <button type="button" class="tab-btn" data-tab="colors">Colors</button>
                <button type="button" class="tab-btn" data-tab="typography">Typography</button>
                <button type="button" class="tab-btn" data-tab="containers">Containers</button>
                <button type="button" class="tab-btn" data-tab="forms">Forms & Inputs</button>
                <button type="button" class="tab-btn" data-tab="buttons">Buttons</button>
                <button type="button" class="tab-btn" data-tab="tables">Tables</button>
                <button type="button" class="tab-btn" data-tab="cards">Cards & Modals</button>
                <button type="button" class="tab-btn" data-tab="notifications">Notifications</button>
                <button type="button" class="tab-btn" data-tab="marketplace">Marketplace</button>
                <button type="button" class="tab-btn" data-tab="animations">Animations</button>
                <button type="button" class="tab-btn" data-tab="advanced">Advanced</button>
            </div>

            <div class="tab-content active" id="general">
                <h3>General Theme Settings</h3>
                
                <div class="form-group toggle-group">
                    <label>
                        <input type="checkbox" name="theme_off" value="1" <?php echo empty($currentCss) ? 'checked' : ''; ?>>
                        Turn off custom theme (use default styles)
                    </label>
                </div>
                
                <h4>Background Settings</h4>
<div class="form-group">
    <label>Background Type</label>
    <select name="background_type" id="background-type">
        <option value="none" <?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'none' ? 'selected' : ''; ?>>None (Use gradient background)</option>
        <option value="image" <?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'image' ? 'selected' : ''; ?>>Custom Image</option>
        <option value="particles" <?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'particles' ? 'selected' : ''; ?>>Particles Effect</option>
        <option value="patterns" <?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'patterns' ? 'selected' : ''; ?>>Pattern Background</option>
        <option value="animated" <?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'animated' ? 'selected' : ''; ?>>Animated Background</option>
    </select>
</div>

<!-- Hidden fields to store values -->
<input type="hidden" id="background_type_selected" name="background_type_selected" value="<?php echo isset($_POST['background_type']) ? $_POST['background_type'] : 'none'; ?>">
<input type="hidden" id="selected_pattern_class" name="selected_pattern_class" value="<?php 
    // First check POST, then fall back to CSS pattern detection
    if (isset($_POST['selected_pattern_class']) && !empty($_POST['selected_pattern_class'])) {
        echo $_POST['selected_pattern_class'];
    } else {
        preg_match('/body\.cosmic-(light|dark)\.([a-zA-Z0-9-]+)\s*{/', $currentCss, $matches);
        echo isset($matches[2]) && strpos($matches[2], 'pattern') === 0 ? $matches[2] : '';
    }
?>">
<input type="hidden" id="selected_animation_class" name="selected_animation_class" value="<?php 
    // First check POST, then fall back to CSS animation detection
    if (isset($_POST['selected_animation_class']) && !empty($_POST['selected_animation_class'])) {
        echo $_POST['selected_animation_class']; 
    } else {
        preg_match('/body\.cosmic-(light|dark)\.animated-([a-zA-Z0-9-]+)\s*{/', $currentCss, $matches);
        echo isset($matches[2]) ? 'animated-' . $matches[2] : '';
    }
?>">

<!-- Custom Image Settings -->
<div class="background-settings background-image-group" style="<?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'image' ? 'display: block;' : 'display: none;'; ?>">
    <div class="form-group">
        <label>Background Image URL (Light Theme)</label>
        <input type="text" name="background_image_url_light" value="<?php
            preg_match('/body.cosmic-light::before.*?background-image: url\("([^"]+)"\);/s', $currentCss, $matches);
            echo isset($matches[1]) ? $matches[1] : '';
        ?>" placeholder="https://example.com/light-image.jpg">
    </div>
    <div class="form-group">
        <label>Background Image URL (Dark Theme)</label>
        <input type="text" name="background_image_url_dark" value="<?php
            preg_match('/body.cosmic-dark::before.*?background-image: url\("([^"]+)"\);/s', $currentCss, $matches);
            echo isset($matches[1]) ? $matches[1] : '';
        ?>" placeholder="https://example.com/dark-image.jpg">
    </div>
    <div class="form-group">
        <label>Background Image Opacity</label>
        <input type="range" name="background_image_opacity" min="0.1" max="1" step="0.1" value="<?php
            preg_match('/opacity: ([0-9.]+);/', $currentCss, $matches);
            echo isset($matches[1]) ? $matches[1] : '0.2';
        ?>">
        <span class="range-value">0.2</span>
    </div>
    <div class="form-group">
        <label>Background Blend Mode</label>
        <select name="background_blend_mode">
            <option value="normal" <?php echo (strpos($currentCss, 'blend-mode: normal') !== false) ? 'selected' : ''; ?>>Normal</option>
            <option value="multiply" <?php echo (strpos($currentCss, 'blend-mode: multiply') !== false) ? 'selected' : ''; ?>>Multiply</option>
            <option value="screen" <?php echo (strpos($currentCss, 'blend-mode: screen') !== false) ? 'selected' : ''; ?>>Screen</option>
            <option value="overlay" <?php echo (strpos($currentCss, 'blend-mode: overlay') !== false) ? 'selected' : ''; ?>>Overlay</option>
            <option value="darken" <?php echo (strpos($currentCss, 'blend-mode: darken') !== false) ? 'selected' : ''; ?>>Darken</option>
            <option value="lighten" <?php echo (strpos($currentCss, 'blend-mode: lighten') !== false) ? 'selected' : ''; ?>>Lighten</option>
        </select>
    </div>
</div>

<!-- Particles Effect Settings -->
<div class="background-settings background-particles-settings" style="<?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'particles' ? 'display: block;' : 'display: none;'; ?>">
    <div class="form-group">
        <label>Particle Type</label>
        <select name="particle_type">
            <option value="circles" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'circles' ? 'selected' : ''; ?>>Circles</option>
            <option value="squares" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'squares' ? 'selected' : ''; ?>>Squares</option>
            <option value="triangles" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'triangles' ? 'selected' : ''; ?>>Triangles</option>
            <option value="lines" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'lines' ? 'selected' : ''; ?>>Lines</option>
            <option value="bubbles" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'bubbles' ? 'selected' : ''; ?>>Bubbles</option>
            <option value="stars" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'stars' ? 'selected' : ''; ?>>Stars</option>
            <option value="snow" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'snow' ? 'selected' : ''; ?>>Snow</option>
            <option value="confetti" <?php echo isset($_POST['particle_type']) && $_POST['particle_type'] === 'confetti' ? 'selected' : ''; ?>>Confetti</option>
        </select>
    </div>
    <div class="form-group">
        <label>Particle Density</label>
        <input type="range" name="particle_density" min="10" max="200" step="10" value="<?php echo isset($_POST['particle_density']) ? $_POST['particle_density'] : '50'; ?>">
        <span class="range-value"><?php echo isset($_POST['particle_density']) ? $_POST['particle_density'] : '50'; ?></span>
    </div>
    <div class="form-group">
        <label>Particle Speed</label>
        <input type="range" name="particle_speed" min="1" max="10" step="1" value="<?php echo isset($_POST['particle_speed']) ? $_POST['particle_speed'] : '3'; ?>">
        <span class="range-value"><?php echo isset($_POST['particle_speed']) ? $_POST['particle_speed'] : '3'; ?></span>
    </div>
    <div class="form-group">
        <label>Particle Size</label>
        <input type="range" name="particle_size" min="1" max="10" step="1" value="<?php echo isset($_POST['particle_size']) ? $_POST['particle_size'] : '3'; ?>">
        <span class="range-value"><?php echo isset($_POST['particle_size']) ? $_POST['particle_size'] : '3'; ?></span>
    </div>
</div>

<!-- Pattern Background Settings -->
<div class="background-settings background-patterns-settings" style="<?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'patterns' ? 'display: block;' : 'display: none;'; ?>">
    <div class="form-group">
        <label>Pattern Style</label>
        <select name="pattern_style" id="pattern-style">
            <?php 
            $patterns = [
                'pattern1' => 'Geometric Grid',
                'pattern2' => 'Wavy Lines',
                'pattern3' => 'Dots Grid',
                'pattern4' => 'Hexagons',
                'pattern5' => 'Chevron',
                'pattern6' => 'Diagonal Lines',
                'pattern7' => 'Circuit Board',
                'pattern8' => 'Triangles',
                'pattern9' => 'Carbon Fiber',
                'pattern10' => 'Topography'
            ];
            
            $selected_pattern = isset($_POST['pattern_style']) ? $_POST['pattern_style'] : 
                               (isset($_POST['selected_pattern_class']) ? $_POST['selected_pattern_class'] : 'pattern1');
            
            foreach ($patterns as $value => $label) {
                echo '<option value="' . $value . '"' . ($selected_pattern === $value ? ' selected' : '') . '>' . $label . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Pattern Scale</label>
        <input type="range" name="pattern_scale" min="0.5" max="5" step="0.5" value="<?php echo isset($_POST['pattern_scale']) ? $_POST['pattern_scale'] : '1'; ?>">
        <span class="range-value"><?php echo isset($_POST['pattern_scale']) ? $_POST['pattern_scale'] : '1'; ?></span>
    </div>
    <div class="form-group">
        <label>Pattern Opacity</label>
        <input type="range" name="pattern_opacity" min="0.1" max="1" step="0.1" value="<?php echo isset($_POST['pattern_opacity']) ? $_POST['pattern_opacity'] : '0.2'; ?>">
        <span class="range-value"><?php echo isset($_POST['pattern_opacity']) ? $_POST['pattern_opacity'] : '0.2'; ?></span>
    </div>
    
    <!-- Pattern Previews (hidden initially) -->
    <div class="pattern-previews">
        <?php for($i=1; $i<=10; $i++): ?>
        <div id="preview-pattern<?php echo $i; ?>" class="pattern-preview" style="display: <?php echo $selected_pattern === 'pattern'.$i ? 'block' : 'none'; ?>;">
            <div class="preview-box pattern<?php echo $i; ?>"></div>
        </div>
        <?php endfor; ?>
    </div>
</div>

<!-- Animated Background Settings -->
<div class="background-settings background-animated-settings" style="<?php echo isset($_POST['background_type']) && $_POST['background_type'] === 'animated' ? 'display: block;' : 'display: none;'; ?>">
    <div class="form-group">
        <label>Animation Style</label>
        <select name="animation_style">
            <?php 
            $animations = [
                'gradient-shift' => 'Gradient Shift',
                'pulse' => 'Pulse',
                'wave' => 'Wave',
                'aurora' => 'Aurora',
                'matrix' => 'Matrix',
                'fireflies' => 'Fireflies',
                'nebula' => 'Nebula'
            ];
            
            $selected_animation = isset($_POST['animation_style']) ? $_POST['animation_style'] : 'gradient-shift';
            
            foreach ($animations as $value => $label) {
                echo '<option value="' . $value . '"' . ($selected_animation === $value ? ' selected' : '') . '>' . $label . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Animation Speed</label>
        <input type="range" name="bg_animation_speed" min="5" max="60" step="5" value="<?php echo isset($_POST['bg_animation_speed']) ? $_POST['bg_animation_speed'] : '20'; ?>">
        <span class="range-value"><?php echo isset($_POST['bg_animation_speed']) ? $_POST['bg_animation_speed'] : '20'; ?></span>
    </div>
    <div class="form-group">
        <label>Animation Intensity</label>
        <input type="range" name="animation_intensity" min="1" max="10" step="1" value="<?php echo isset($_POST['animation_intensity']) ? $_POST['animation_intensity'] : '5'; ?>">
        <span class="range-value"><?php echo isset($_POST['animation_intensity']) ? $_POST['animation_intensity'] : '5'; ?></span>
    </div>
</div>



                
                <h4>Animation Settings</h4>
                <div class="form-group toggle-group">
                    <label>
                        <input type="checkbox" name="animation_enabled" value="1" <?php echo strpos($currentCss, 'transition: all') !== false ? 'checked' : ''; ?>>
                        Enable animations
                    </label>
                </div>
                
                <div class="form-group animation-group" style="<?php echo strpos($currentCss, 'transition: all') === false ? 'display: none;' : ''; ?>">
                    <label>Animation Speed (seconds)</label>
                    <input type="number" name="animation_speed" min="0.1" max="3" step="0.1" value="<?php echo extractCssValue($currentCss, 'animation-speed', '0.3'); ?>">
                </div>
                
                <div class="form-group animation-group" style="<?php echo strpos($currentCss, 'transition: all') === false ? 'display: none;' : ''; ?>">
                    <label>Animation Type</label>
                    <select name="animation_type">
                        <option value="ease" <?php echo extractCssValue($currentCss, 'animation-type', 'ease') === 'ease' ? 'selected' : ''; ?>>Ease</option>
                        <option value="linear" <?php echo extractCssValue($currentCss, 'animation-type', 'ease') === 'linear' ? 'selected' : ''; ?>>Linear</option>
                        <option value="ease-in" <?php echo extractCssValue($currentCss, 'animation-type', 'ease') === 'ease-in' ? 'selected' : ''; ?>>Ease In</option>
                        <option value="ease-out" <?php echo extractCssValue($currentCss, 'animation-type', 'ease') === 'ease-out' ? 'selected' : ''; ?>>Ease Out</option>
                        <option value="ease-in-out" <?php echo extractCssValue($currentCss, 'animation-type', 'ease') === 'ease-in-out' ? 'selected' : ''; ?>>Ease In Out</option>
                    </select>
                </div>
            </div>

            <div class="tab-content" id="colors">
                <h3>Color Settings</h3>
                
                <h4>Base Colors</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="color" name="cosmic_dark_bg" value="<?php echo extractCssValue($currentCss, 'cosmic-dark-bg', '#0a0a1a'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-dark-bg', '#0a0a1a'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Text</label>
                        <input type="color" name="cosmic_dark_text" value="<?php echo extractCssValue($currentCss, 'cosmic-dark-text', '#e0e0ff'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-dark-text', '#e0e0ff'); ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="color" name="cosmic_light_bg" value="<?php echo extractCssValue($currentCss, 'cosmic-light-bg', '#f0f5ff'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-light-bg', '#f0f5ff'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Text</label>
                        <input type="color" name="cosmic_light_text" value="<?php echo extractCssValue($currentCss, 'cosmic-light-text', '#121225'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-light-text', '#121225'); ?>">
                    </div>
                </div>
                
                <h4>Accent Colors</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Primary Color</label>
                        <input type="color" name="cosmic_primary" value="<?php echo extractCssValue($currentCss, 'cosmic-primary', '#00ccff'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-primary', '#00ccff'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Secondary Color</label>
                        <input type="color" name="cosmic_secondary" value="<?php echo extractCssValue($currentCss, 'cosmic-secondary', '#ff00ff'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-secondary', '#ff00ff'); ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Tertiary Color</label>
                        <input type="color" name="cosmic_tertiary" value="<?php echo extractCssValue($currentCss, 'cosmic-tertiary', '#ffff00'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-tertiary', '#ffff00'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Accent Color</label>
                        <input type="color" name="cosmic_accent" value="<?php echo extractCssValue($currentCss, 'cosmic-accent', '#7b68ee'); ?>">
                        <input type="text" class="color-text" value="<?php echo extractCssValue($currentCss, 'cosmic-accent', '#7b68ee'); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Glow Effect</label>
                    <input type="text" name="cosmic_glow" value="<?php echo extractCssValue($currentCss, 'cosmic-glow', '0 0 20px'); ?>" placeholder="e.g. 0 0 20px">
                </div>
                
                <h4>Link Colors</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Link Color</label>
                        <input type="text" name="link_color_dark" value="<?php echo extractCssValue($currentCss, 'link-color-dark', 'var(--cosmic-primary)'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Link Hover Color</label>
                        <input type="text" name="link_hover_color_dark" value="<?php echo extractCssValue($currentCss, 'link-hover-color-dark', 'var(--cosmic-primary)'); ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Link Color</label>
                        <input type="text" name="link_color_light" value="<?php echo extractCssValue($currentCss, 'link-color-light', 'var(--cosmic-accent)'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Link Hover Color</label>
                        <input type="text" name="link_hover_color_light" value="<?php echo extractCssValue($currentCss, 'link-hover-color-light', 'var(--cosmic-accent)'); ?>">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="typography">
                <h3>Typography Settings</h3>
                
                <div class="form-group">
                    <label>Font Family</label>
                    <input type="text" name="typography_font_family" value="<?php echo extractCssValue($currentCss, 'typography-font-family', "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"); ?>" placeholder="e.g. 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Font Size</label>
                        <input type="text" name="typography_font_size" value="<?php echo extractCssValue($currentCss, 'typography-font-size', '1rem'); ?>" placeholder="e.g. 1rem">
                    </div>
                    <div class="form-group">
                        <label>Line Height</label>
                        <input type="text" name="typography_line_height" value="<?php echo extractCssValue($currentCss, 'typography-line-height', '1.6'); ?>" placeholder="e.g. 1.6">
                    </div>
                    <div class="form-group">
                        <label>Font Weight</label>
                        <input type="text" name="typography_font_weight" value="<?php echo extractCssValue($currentCss, 'typography-font-weight', '400'); ?>" placeholder="e.g. 400">
                    </div>
                </div>
                
                <h4>Heading Typography</h4>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Heading Margin</label>
                        <input type="text" name="typography_heading_margin" value="<?php echo extractCssValue($currentCss, 'typography-heading-margin', '0 0 20px 0'); ?>" placeholder="e.g. 0 0 20px 0">
                    </div>
                    <div class="form-group">
                        <label>Heading Font Weight</label>
                        <input type="text" name="typography_heading_font_weight" value="<?php echo extractCssValue($currentCss, 'typography-heading-font-weight', '600'); ?>" placeholder="e.g. 600">
                    </div>
                    <div class="form-group">
                        <label>Heading Letter Spacing</label>
                        <input type="text" name="typography_heading_letter_spacing" value="<?php echo extractCssValue($currentCss, 'typography-heading-letter-spacing', '0.5px'); ?>" placeholder="e.g. 0.5px">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Heading Color</label>
                        <input type="text" name="typography_heading_color_dark" value="<?php echo extractCssValue($currentCss, 'typography-heading-color-dark', 'var(--cosmic-primary)'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Heading Shadow</label>
                        <input type="text" name="typography_heading_shadow_dark" value="<?php echo extractCssValue($currentCss, 'typography-heading-shadow-dark', '0 0 10px rgba(0, 204, 255, 0.5)'); ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Heading Color</label>
                        <input type="text" name="typography_heading_color_light" value="<?php echo extractCssValue($currentCss, 'typography-heading-color-light', 'var(--cosmic-accent)'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Heading Shadow</label>
                        <input type="text" name="typography_heading_shadow_light" value="<?php echo extractCssValue($currentCss, 'typography-heading-shadow-light', '0 0 10px rgba(123, 104, 238, 0.3)'); ?>">
                    </div>
                </div>
                
                <h4>Link Styling</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Link Decoration</label>
                        <select name="link_decoration">
                            <option value="none" <?php echo extractCssValue($currentCss, 'link-decoration', 'none') === 'none' ? 'selected' : ''; ?>>None</option>
                            <option value="underline" <?php echo extractCssValue($currentCss, 'link-decoration', 'none') === 'underline' ? 'selected' : ''; ?>>Underline</option>
                            <option value="dotted" <?php echo extractCssValue($currentCss, 'link-decoration', 'none') === 'dotted' ? 'selected' : ''; ?>>Dotted</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Link Hover Decoration</label>
                        <select name="link_hover_decoration">
                            <option value="none" <?php echo extractCssValue($currentCss, 'link-hover-decoration', 'none') === 'none' ? 'selected' : ''; ?>>None</option>
                            <option value="underline" <?php echo extractCssValue($currentCss, 'link-hover-decoration', 'none') === 'underline' ? 'selected' : ''; ?>>Underline</option>
                            <option value="dotted" <?php echo extractCssValue($currentCss, 'link-hover-decoration', 'none') === 'dotted' ? 'selected' : ''; ?>>Dotted</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="containers">
                <h3>Container Settings</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="container_border_radius" value="<?php echo extractCssValue($currentCss, 'container-border-radius', '15px'); ?>" placeholder="e.g. 15px">
                    </div>
                    <div class="form-group">
                        <label>Padding</label>
                        <input type="text" name="container_padding" value="<?php echo extractCssValue($currentCss, 'container-padding', '30px'); ?>" placeholder="e.g. 30px">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Margin</label>
                        <input type="text" name="container_margin" value="<?php echo extractCssValue($currentCss, 'container-margin', '30px auto'); ?>" placeholder="e.g. 30px auto">
                    </div>
                    <div class="form-group">
                        <label>Max Width</label>
                        <input type="text" name="container_max_width" value="<?php echo extractCssValue($currentCss, 'container-max-width', '1200px'); ?>" placeholder="e.g. 1200px">
                    </div>
                </div>
                
                <h4>Dark Mode Containers</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="container_bg_dark" value="<?php echo extractCssValue($currentCss, 'container-bg-dark', 'rgba(18, 18, 37, 0.8)'); ?>" placeholder="e.g. rgba(18, 18, 37, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="container_border_dark" value="<?php echo extractCssValue($currentCss, 'container-border-dark', '1px solid rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(0, 255, 255, 0.2)">
                    </div>
                </div>
                
                <h4>Light Mode Containers</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="container_bg_light" value="<?php echo extractCssValue($currentCss, 'container-bg-light', 'rgba(255, 255, 255, 0.8)'); ?>" placeholder="e.g. rgba(255, 255, 255, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="container_border_light" value="<?php echo extractCssValue($currentCss, 'container-border-light', '1px solid rgba(0, 102, 255, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(0, 102, 255, 0.2)">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Container Shadow</label>
                    <input type="text" name="container_shadow" value="<?php echo extractCssValue($currentCss, 'container-shadow', '0 10px 30px rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. 0 10px 30px rgba(0, 0, 0, 0.3)">
                </div>
                
                <h4>Block Container Styling</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Block Padding</label>
                        <input type="text" name="block_padding" value="<?php echo extractCssValue($currentCss, 'block-padding', '20px'); ?>" placeholder="e.g. 20px">
                    </div>
                    <div class="form-group">
                        <label>Block Margin</label>
                        <input type="text" name="block_margin" value="<?php echo extractCssValue($currentCss, 'block-margin', '20px 0'); ?>" placeholder="e.g. 20px 0">
                    </div>
                    <div class="form-group">
                        <label>Block Border Radius</label>
                        <input type="text" name="block_border_radius" value="<?php echo extractCssValue($currentCss, 'block-border-radius', '10px'); ?>" placeholder="e.g. 10px">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="forms">
                <h3>Form & Input Settings</h3>
                
                <h4>Input Fields</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="form_input_border_radius" value="<?php echo extractCssValue($currentCss, 'form-input-border-radius', '8px'); ?>" placeholder="e.g. 8px">
                    </div>
                    <div class="form-group">
                        <label>Padding</label>
                        <input type="text" name="form_input_padding" value="<?php echo extractCssValue($currentCss, 'form-input-padding', '12px 15px'); ?>" placeholder="e.g. 12px 15px">
                    </div>
                    <div class="form-group">
                        <label>Margin</label>
                        <input type="text" name="form_input_margin" value="<?php echo extractCssValue($currentCss, 'form-input-margin', '10px 0'); ?>" placeholder="e.g. 10px 0">
                    </div>
                </div>
                
                <h4>Dark Mode Input Fields</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="form_input_bg_dark" value="<?php echo extractCssValue($currentCss, 'form-input-bg-dark', 'rgba(0, 0, 0, 0.2)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="form_input_border_dark" value="<?php echo extractCssValue($currentCss, 'form-input-border-dark', '1px solid rgba(0, 255, 255, 0.3)'); ?>" placeholder="e.g. 1px solid rgba(0, 255, 255, 0.3)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="text" name="form_input_color_dark" value="<?php echo extractCssValue($currentCss, 'form-input-color-dark', '#fff'); ?>" placeholder="e.g. #fff">
                    </div>
                    <div class="form-group">
                        <label>Shadow</label>
                        <input type="text" name="form_input_shadow_dark" value="<?php echo extractCssValue($currentCss, 'form-input-shadow-dark', 'inset 0 0 5px rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. inset 0 0 5px rgba(0, 255, 255, 0.2)">
                    </div>
                </div>
                
                <h4>Light Mode Input Fields</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="form_input_bg_light" value="<?php echo extractCssValue($currentCss, 'form-input-bg-light', 'rgba(255, 255, 255, 0.8)'); ?>" placeholder="e.g. rgba(255, 255, 255, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="form_input_border_light" value="<?php echo extractCssValue($currentCss, 'form-input-border-light', '1px solid rgba(0, 102, 255, 0.3)'); ?>" placeholder="e.g. 1px solid rgba(0, 102, 255, 0.3)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="text" name="form_input_color_light" value="<?php echo extractCssValue($currentCss, 'form-input-color-light', '#000'); ?>" placeholder="e.g. #000">
                    </div>
                    <div class="form-group">
                        <label>Shadow</label>
                        <input type="text" name="form_input_shadow_light" value="<?php echo extractCssValue($currentCss, 'form-input-shadow-light', 'inset 0 0 5px rgba(0, 102, 255, 0.2)'); ?>" placeholder="e.g. inset 0 0 5px rgba(0, 102, 255, 0.2)">
                    </div>
                </div>
                
                <h4>Input Focus States</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Focus Background</label>
                        <input type="text" name="form_input_focus_bg_dark" value="<?php echo extractCssValue($currentCss, 'form-input-focus-bg-dark', 'rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.3)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Focus Border</label>
                        <input type="text" name="form_input_focus_border_dark" value="<?php echo extractCssValue($currentCss, 'form-input-focus-border-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Focus Background</label>
                        <input type="text" name="form_input_focus_bg_light" value="<?php echo extractCssValue($currentCss, 'form-input-focus-bg-light', 'rgba(255, 255, 255, 1)'); ?>" placeholder="e.g. rgba(255, 255, 255, 1)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Focus Border</label>
                        <input type="text" name="form_input_focus_border_light" value="<?php echo extractCssValue($currentCss, 'form-input-focus-border-light', '#0066cc'); ?>" placeholder="e.g. #0066cc">
                    </div>
                </div>
                
                <h4>Form Labels</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Label Margin</label>
                        <input type="text" name="form_label_margin" value="<?php echo extractCssValue($currentCss, 'form-label-margin', '0 0 5px 0'); ?>" placeholder="e.g. 0 0 5px 0">
                    </div>
                    <div class="form-group">
                        <label>Label Font Weight</label>
                        <input type="text" name="form_label_font_weight" value="<?php echo extractCssValue($currentCss, 'form-label-font-weight', '500'); ?>" placeholder="e.g. 500">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Label Color</label>
                        <input type="text" name="form_label_color_dark" value="<?php echo extractCssValue($currentCss, 'form-label-color-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Label Color</label>
                        <input type="text" name="form_label_color_light" value="<?php echo extractCssValue($currentCss, 'form-label-color-light', 'var(--cosmic-accent)'); ?>" placeholder="e.g. var(--cosmic-accent)">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="buttons">
                <h3>Button Settings</h3>
                
                <h4>Button Appearance</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Primary Button Background</label>
                        <input type="text" name="button_bg_primary" value="<?php echo extractCssValue($currentCss, 'button-bg-primary', 'linear-gradient(45deg, #00ccff, #0066ff)'); ?>" placeholder="e.g. linear-gradient(45deg, #00ccff, #0066ff)">
                    </div>
                    <div class="form-group">
                        <label>Secondary Button Background</label>
                        <input type="text" name="button_bg_secondary" value="<?php echo extractCssValue($currentCss, 'button-bg-secondary', 'linear-gradient(45deg, #ff00aa, #ff6a00)'); ?>" placeholder="e.g. linear-gradient(45deg, #ff00aa, #ff6a00)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Padding</label>
                        <input type="text" name="button_padding" value="<?php echo extractCssValue($currentCss, 'button-padding', '12px 25px'); ?>" placeholder="e.g. 12px 25px">
                    </div>
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="button_border_radius" value="<?php echo extractCssValue($currentCss, 'button-border-radius', '8px'); ?>" placeholder="e.g. 8px">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Font Size</label>
                        <input type="text" name="button_font_size" value="<?php echo extractCssValue($currentCss, 'button-font-size', '1rem'); ?>" placeholder="e.g. 1rem">
                    </div>
                    <div class="form-group">
                        <label>Font Weight</label>
                        <input type="text" name="button_font_weight" value="<?php echo extractCssValue($currentCss, 'button-font-weight', 'bold'); ?>" placeholder="e.g. bold">
                    </div>
                </div>
                
                <h4>Button Colors</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Text Color</label>
                        <input type="text" name="button_color_dark" value="<?php echo extractCssValue($currentCss, 'button-color-dark', '#000'); ?>" placeholder="e.g. #000">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Text Color</label>
                        <input type="text" name="button_color_light" value="<?php echo extractCssValue($currentCss, 'button-color-light', '#fff'); ?>" placeholder="e.g. #fff">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Shadow</label>
                        <input type="text" name="button_shadow_dark" value="<?php echo extractCssValue($currentCss, 'button-shadow-dark', '0 0 15px rgba(0, 204, 255, 0.5)'); ?>" placeholder="e.g. 0 0 15px rgba(0, 204, 255, 0.5)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Shadow</label>
                        <input type="text" name="button_shadow_light" value="<?php echo extractCssValue($currentCss, 'button-shadow-light', '0 0 15px rgba(0, 102, 255, 0.5)'); ?>" placeholder="e.g. 0 0 15px rgba(0, 102, 255, 0.5)">
                    </div>
                </div>
                
                <h4>Button Hover Effects</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Hover Transform</label>
                        <input type="text" name="button_hover_transform" value="<?php echo extractCssValue($currentCss, 'button-hover-transform', 'translateY(-3px)'); ?>" placeholder="e.g. translateY(-3px)">
                    </div>
                    <div class="form-group">
                        <label>Hover Glow</label>
                        <input type="text" name="button_hover_glow" value="<?php echo extractCssValue($currentCss, 'button-hover-glow', '0 0 20px rgba(0, 255, 255, 0.8)'); ?>" placeholder="e.g. 0 0 20px rgba(0, 255, 255, 0.8)">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="tables">
                <h3>Table Settings</h3>
                
                <h4>Table Structure</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="table_border_radius" value="<?php echo extractCssValue($currentCss, 'table-border-radius', '10px'); ?>" placeholder="e.g. 10px">
                    </div>
                    <div class="form-group">
                        <label>Margin</label>
                        <input type="text" name="table_margin" value="<?php echo extractCssValue($currentCss, 'table-margin', '20px 0'); ?>" placeholder="e.g. 20px 0">
                    </div>
                    <div class="form-group">
                        <label>Cell Padding</label>
                        <input type="text" name="table_cell_padding" value="<?php echo extractCssValue($currentCss, 'table-cell-padding', '12px 15px'); ?>" placeholder="e.g. 12px 15px">
                    </div>
                </div>
                
                <h4>Table Background</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="text" name="table_bg_dark" value="<?php echo extractCssValue($currentCss, 'table-bg-dark', 'rgba(0, 0, 0, 0.2)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Shadow</label>
                        <input type="text" name="table_shadow_dark" value="<?php echo extractCssValue($currentCss, 'table-shadow-dark', '0 0 20px rgba(0, 255, 255, 0.1)'); ?>" placeholder="e.g. 0 0 20px rgba(0, 255, 255, 0.1)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="text" name="table_bg_light" value="<?php echo extractCssValue($currentCss, 'table-bg-light', 'rgba(255, 255, 255, 0.8)'); ?>" placeholder="e.g. rgba(255, 255, 255, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Shadow</label>
                        <input type="text" name="table_shadow_light" value="<?php echo extractCssValue($currentCss, 'table-shadow-light', '0 0 20px rgba(0, 102, 255, 0.1)'); ?>" placeholder="e.g. 0 0 20px rgba(0, 102, 255, 0.1)">
                    </div>
                </div>
                
                <h4>Table Headers</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Header Background</label>
                        <input type="text" name="table_header_bg_dark" value="<?php echo extractCssValue($currentCss, 'table-header-bg-dark', 'rgba(0, 255, 255, 0.1)'); ?>" placeholder="e.g. rgba(0, 255, 255, 0.1)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Header Color</label>
                        <input type="text" name="table_header_color_dark" value="<?php echo extractCssValue($currentCss, 'table-header-color-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Header Background</label>
                        <input type="text" name="table_header_bg_light" value="<?php echo extractCssValue($currentCss, 'table-header-bg-light', 'rgba(0, 102, 255, 0.1)'); ?>" placeholder="e.g. rgba(0, 102, 255, 0.1)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Header Color</label>
                        <input type="text" name="table_header_color_light" value="<?php echo extractCssValue($currentCss, 'table-header-color-light', '#0066cc'); ?>" placeholder="e.g. #0066cc">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Header Border</label>
                        <input type="text" name="table_header_border_dark" value="<?php echo extractCssValue($currentCss, 'table-header-border-dark', 'rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. rgba(0, 255, 255, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Header Border</label>
                        <input type="text" name="table_header_border_light" value="<?php echo extractCssValue($currentCss, 'table-header-border-light', 'rgba(0, 102, 255, 0.2)'); ?>" placeholder="e.g. rgba(0, 102, 255, 0.2)">
                    </div>
                </div>
                
                <h4>Table Rows & Cells</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Row Border</label>
                        <input type="text" name="table_row_border_dark" value="<?php echo extractCssValue($currentCss, 'table-row-border-dark', 'rgba(255, 255, 255, 0.05)'); ?>" placeholder="e.g. rgba(255, 255, 255, 0.05)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Row Border</label>
                        <input type="text" name="table_row_border_light" value="<?php echo extractCssValue($currentCss, 'table-row-border-light', 'rgba(0, 0, 0, 0.05)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.05)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Row Hover Background</label>
                        <input type="text" name="table_row_hover_bg_dark" value="<?php echo extractCssValue($currentCss, 'table-row-hover-bg-dark', 'rgba(0, 255, 255, 0.05)'); ?>" placeholder="e.g. rgba(0, 255, 255, 0.05)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Row Hover Background</label>
                        <input type="text" name="table_row_hover_bg_light" value="<?php echo extractCssValue($currentCss, 'table-row-hover-bg-light', 'rgba(0, 102, 255, 0.05)'); ?>" placeholder="e.g. rgba(0, 102, 255, 0.05)">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="cards">
                <h3>Cards & Modals Settings</h3>
                
                <h4>Card Appearance</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="card_border_radius" value="<?php echo extractCssValue($currentCss, 'card-border-radius', '10px'); ?>" placeholder="e.g. 10px">
                    </div>
                    <div class="form-group">
                        <label>Padding</label>
                        <input type="text" name="card_padding" value="<?php echo extractCssValue($currentCss, 'card-padding', '20px'); ?>" placeholder="e.g. 20px">
                    </div>
                    <div class="form-group">
                        <label>Margin</label>
                        <input type="text" name="card_margin" value="<?php echo extractCssValue($currentCss, 'card-margin', '15px 0'); ?>" placeholder="e.g. 15px 0">
                    </div>
                </div>
                
                <h4>Dark Mode Cards</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="card_bg_dark" value="<?php echo extractCssValue($currentCss, 'card-bg-dark', 'rgba(0, 0, 0, 0.2)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="card_border_dark" value="<?php echo extractCssValue($currentCss, 'card-border-dark', '1px solid rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(0, 255, 255, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Shadow</label>
                        <input type="text" name="card_shadow_dark" value="<?php echo extractCssValue($currentCss, 'card-shadow-dark', '0 5px 15px rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. 0 5px 15px rgba(0, 0, 0, 0.3)">
                    </div>
                </div>
                
                <h4>Light Mode Cards</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Background</label>
                        <input type="text" name="card_bg_light" value="<?php echo extractCssValue($currentCss, 'card-bg-light', 'rgba(255, 255, 255, 0.8)'); ?>" placeholder="e.g. rgba(255, 255, 255, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Border</label>
                        <input type="text" name="card_border_light" value="<?php echo extractCssValue($currentCss, 'card-border-light', '1px solid rgba(123, 104, 238, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(123, 104, 238, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Shadow</label>
                        <input type="text" name="card_shadow_light" value="<?php echo extractCssValue($currentCss, 'card-shadow-light', '0 5px 15px rgba(0, 0, 0, 0.1)'); ?>" placeholder="e.g. 0 5px 15px rgba(0, 0, 0, 0.1)">
                    </div>
                </div>
                
                <h4>Card Hover Effects</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Hover Transform</label>
                        <input type="text" name="card_hover_transform" value="<?php echo extractCssValue($currentCss, 'card-hover-transform', 'translateY(-5px)'); ?>" placeholder="e.g. translateY(-5px)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Hover Shadow</label>
                        <input type="text" name="card_hover_shadow_dark" value="<?php echo extractCssValue($currentCss, 'card-hover-shadow-dark', '0 8px 25px rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. 0 8px 25px rgba(0, 255, 255, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Hover Shadow</label>
                        <input type="text" name="card_hover_shadow_light" value="<?php echo extractCssValue($currentCss, 'card-hover-shadow-light', '0 8px 25px rgba(123, 104, 238, 0.2)'); ?>" placeholder="e.g. 0 8px 25px rgba(123, 104, 238, 0.2)">
                    </div>
                </div>
                
                <h4>Card Headers & Footers</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Header Background</label>
                        <input type="text" name="card_header_bg_dark" value="<?php echo extractCssValue($currentCss, 'card-header-bg-dark', 'rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.3)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Header Border</label>
                        <input type="text" name="card_header_border_dark" value="<?php echo extractCssValue($currentCss, 'card-header-border-dark', 'rgba(0, 255, 255, 0.1)'); ?>" placeholder="e.g. rgba(0, 255, 255, 0.1)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Header Background</label>
                        <input type="text" name="card_header_bg_light" value="<?php echo extractCssValue($currentCss, 'card-header-bg-light', 'rgba(123, 104, 238, 0.05)'); ?>" placeholder="e.g. rgba(123, 104, 238, 0.05)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Header Border</label>
                        <input type="text" name="card_header_border_light" value="<?php echo extractCssValue($currentCss, 'card-header-border-light', 'rgba(123, 104, 238, 0.1)'); ?>" placeholder="e.g. rgba(123, 104, 238, 0.1)">
                    </div>
                </div>
                
                <h4>Modals</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="modal_border_radius" value="<?php echo extractCssValue($currentCss, 'modal-border-radius', '15px'); ?>" placeholder="e.g. 15px">
                    </div>
                    <div class="form-group">
                        <label>Shadow</label>
                        <input type="text" name="modal_shadow" value="<?php echo extractCssValue($currentCss, 'modal-shadow', '0 10px 30px rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. 0 10px 30px rgba(0, 0, 0, 0.3)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="text" name="modal_bg_dark" value="<?php echo extractCssValue($currentCss, 'modal-bg-dark', 'linear-gradient(135deg, rgba(18, 18, 37, 0.9), rgba(10, 10, 30, 0.95))'); ?>" placeholder="e.g. linear-gradient(135deg, rgba(18, 18, 37, 0.9), rgba(10, 10, 30, 0.95))">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="text" name="modal_bg_light" value="<?php echo extractCssValue($currentCss, 'modal-bg-light', 'linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 245, 255, 0.95))'); ?>" placeholder="e.g. linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 245, 255, 0.95))">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Border</label>
                        <input type="text" name="modal_border_dark" value="<?php echo extractCssValue($currentCss, 'modal-border-dark', '1px solid rgba(0, 255, 255, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(0, 255, 255, 0.2)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Border</label>
                        <input type="text" name="modal_border_light" value="<?php echo extractCssValue($currentCss, 'modal-border-light', '1px solid rgba(0, 102, 255, 0.2)'); ?>" placeholder="e.g. 1px solid rgba(0, 102, 255, 0.2)">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="notifications">
                <h3>Notification Settings</h3>
                
                <h4>Notification Structure</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Border Radius</label>
                        <input type="text" name="notification_border_radius" value="<?php echo extractCssValue($currentCss, 'notification-border-radius', '10px'); ?>" placeholder="e.g. 10px">
                    </div>
                    <div class="form-group">
                        <label>Padding</label>
                        <input type="text" name="notification_padding" value="<?php echo extractCssValue($currentCss, 'notification-padding', '15px 25px'); ?>" placeholder="e.g. 15px 25px">
                    </div>
                    <div class="form-group">
                        <label>Box Shadow</label>
                        <input type="text" name="notification_box_shadow" value="<?php echo extractCssValue($currentCss, 'notification-box-shadow', '0 5px 15px rgba(0, 0, 0, 0.3)'); ?>" placeholder="e.g. 0 5px 15px rgba(0, 0, 0, 0.3)">
                    </div>
                </div>
                
                <h4>Success Notifications</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="text" name="notification_success_bg_dark" value="<?php echo extractCssValue($currentCss, 'notification-success-bg-dark', 'rgba(0, 50, 20, 0.8)'); ?>" placeholder="e.g. rgba(0, 50, 20, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Border</label>
                        <input type="text" name="notification_success_border_dark" value="<?php echo extractCssValue($currentCss, 'notification-success-border-dark', '#00ff9d'); ?>" placeholder="e.g. #00ff9d">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Text</label>
                        <input type="text" name="notification_success_text_dark" value="<?php echo extractCssValue($currentCss, 'notification-success-text-dark', '#e0ffe0'); ?>" placeholder="e.g. #e0ffe0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="text" name="notification_success_bg_light" value="<?php echo extractCssValue($currentCss, 'notification-success-bg-light', 'rgba(240, 255, 240, 0.9)'); ?>" placeholder="e.g. rgba(240, 255, 240, 0.9)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Border</label>
                        <input type="text" name="notification_success_border_light" value="<?php echo extractCssValue($currentCss, 'notification-success-border-light', '#00cc66'); ?>" placeholder="e.g. #00cc66">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Text</label>
                        <input type="text" name="notification_success_text_light" value="<?php echo extractCssValue($currentCss, 'notification-success-text-light', '#006633'); ?>" placeholder="e.g. #006633">
                    </div>
                </div>
                
                <h4>Error Notifications</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="text" name="notification_error_bg_dark" value="<?php echo extractCssValue($currentCss, 'notification-error-bg-dark', 'rgba(50, 0, 0, 0.8)'); ?>" placeholder="e.g. rgba(50, 0, 0, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Border</label>
                        <input type="text" name="notification_error_border_dark" value="<?php echo extractCssValue($currentCss, 'notification-error-border-dark', '#ff5555'); ?>" placeholder="e.g. #ff5555">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Text</label>
                        <input type="text" name="notification_error_text_dark" value="<?php echo extractCssValue($currentCss, 'notification-error-text-dark', '#ffe0e0'); ?>" placeholder="e.g. #ffe0e0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="text" name="notification_error_bg_light" value="<?php echo extractCssValue($currentCss, 'notification-error-bg-light', 'rgba(255, 240, 240, 0.9)'); ?>" placeholder="e.g. rgba(255, 240, 240, 0.9)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Border</label>
                        <input type="text" name="notification_error_border_light" value="<?php echo extractCssValue($currentCss, 'notification-error-border-light', '#cc0000'); ?>" placeholder="e.g. #cc0000">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Text</label>
                        <input type="text" name="notification_error_text_light" value="<?php echo extractCssValue($currentCss, 'notification-error-text-light', '#660000'); ?>" placeholder="e.g. #660000">
                    </div>
                </div>
                
                <h4>Info Notifications</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Background</label>
                        <input type="text" name="notification_info_bg_dark" value="<?php echo extractCssValue($currentCss, 'notification-info-bg-dark', 'rgba(0, 20, 50, 0.8)'); ?>" placeholder="e.g. rgba(0, 20, 50, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Border</label>
                        <input type="text" name="notification_info_border_dark" value="<?php echo extractCssValue($currentCss, 'notification-info-border-dark', '#55aaff'); ?>" placeholder="e.g. #55aaff">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Text</label>
                        <input type="text" name="notification_info_text_dark" value="<?php echo extractCssValue($currentCss, 'notification-info-text-dark', '#e0e0ff'); ?>" placeholder="e.g. #e0e0ff">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Background</label>
                        <input type="text" name="notification_info_bg_light" value="<?php echo extractCssValue($currentCss, 'notification-info-bg-light', 'rgba(240, 240, 255, 0.9)'); ?>" placeholder="e.g. rgba(240, 240, 255, 0.9)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Border</label>
                        <input type="text" name="notification_info_border_light" value="<?php echo extractCssValue($currentCss, 'notification-info-border-light', '#0066cc'); ?>" placeholder="e.g. #0066cc">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Text</label>
                        <input type="text" name="notification_info_text_light" value="<?php echo extractCssValue($currentCss, 'notification-info-text-light', '#003366'); ?>" placeholder="e.g. #003366">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="marketplace">
                <h3>Marketplace Settings</h3>
                
                <h4>Hacker Cards</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Card Max Width</label>
                        <input type="text" name="marketplace_card_max_width" value="<?php echo extractCssValue($currentCss, 'marketplace-card-max-width', '350px'); ?>" placeholder="e.g. 350px">
                    </div>
                    <div class="form-group">
                        <label>Card Min Height</label>
                        <input type="text" name="marketplace_card_min_height" value="<?php echo extractCssValue($currentCss, 'marketplace-card-min-height', '300px'); ?>" placeholder="e.g. 300px">
                    </div>
                    <div class="form-group">
                        <label>Grid Gap</label>
                        <input type="text" name="marketplace_grid_gap" value="<?php echo extractCssValue($currentCss, 'marketplace-grid-gap', '20px'); ?>" placeholder="e.g. 20px">
                    </div>
                </div>
                
                <h4>Hacker Title</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Title Color</label>
                        <input type="text" name="marketplace_hacker_title_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-hacker-title-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Title Shadow</label>
                        <input type="text" name="marketplace_hacker_title_shadow_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-hacker-title-shadow-dark', '0 0 10px rgba(0, 255, 255, 0.5)'); ?>" placeholder="e.g. 0 0 10px rgba(0, 255, 255, 0.5)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Title Color</label>
                        <input type="text" name="marketplace_hacker_title_light" value="<?php echo extractCssValue($currentCss, 'marketplace-hacker-title-light', '#0066cc'); ?>" placeholder="e.g. #0066cc">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Title Shadow</label>
                        <input type="text" name="marketplace_hacker_title_shadow_light" value="<?php echo extractCssValue($currentCss, 'marketplace-hacker-title-shadow-light', '0 0 10px rgba(0, 102, 204, 0.3)'); ?>" placeholder="e.g. 0 0 10px rgba(0, 102, 204, 0.3)">
                    </div>
                </div>
                
                <h4>Card Content</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Card Content Background</label>
                        <input type="text" name="marketplace_card_content_bg_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-card-content-bg-dark', 'rgba(10, 10, 26, 0.8)'); ?>" placeholder="e.g. rgba(10, 10, 26, 0.8)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Card Content Background</label>
                        <input type="text" name="marketplace_card_content_bg_light" value="<?php echo extractCssValue($currentCss, 'marketplace-card-content-bg-light', 'rgba(240, 245, 255, 0.8)'); ?>" placeholder="e.g. rgba(240, 245, 255, 0.8)">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Primary Text</label>
                        <input type="text" name="marketplace_primary_text_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-primary-text-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Primary Text</label>
                        <input type="text" name="marketplace_primary_text_light" value="<?php echo extractCssValue($currentCss, 'marketplace-primary-text-light', '#0066cc'); ?>" placeholder="e.g. #0066cc">
                    </div>
                </div>
                
                <h4>Price Display</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Price Background</label>
                        <input type="text" name="marketplace_card_price_bg_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-card-price-bg-dark', 'rgba(0, 255, 255, 0.05)'); ?>" placeholder="e.g. rgba(0, 255, 255, 0.05)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Price Background</label>
                        <input type="text" name="marketplace_card_price_bg_light" value="<?php echo extractCssValue($currentCss, 'marketplace-card-price-bg-light', 'rgba(0, 102, 255, 0.05)'); ?>" placeholder="e.g. rgba(0, 102, 255, 0.05)">
                    </div>
                </div>
                
                <h4>Terminal Section</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Terminal Header</label>
                        <input type="text" name="marketplace_terminal_header_bg_dark" value="<?php echo extractCssValue($currentCss, 'marketplace-terminal-header-bg-dark', 'rgba(0, 0, 0, 0.5)'); ?>" placeholder="e.g. rgba(0, 0, 0, 0.5)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Terminal Header</label>
                        <input type="text" name="marketplace_terminal_header_bg_light" value="<?php echo extractCssValue($currentCss, 'marketplace-terminal-header-bg-light', 'rgba(0, 102, 255, 0.1)'); ?>" placeholder="e.g. rgba(0, 102, 255, 0.1)">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Search Form Max Width</label>
                    <input type="text" name="marketplace_search_max_width" value="<?php echo extractCssValue($currentCss, 'marketplace-search-max-width', '600px'); ?>" placeholder="e.g. 600px">
                </div>
            </div>

            <div class="tab-content" id="animations">
                <h3>Animation Settings</h3>
                
                <h4>Animation Durations</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Long Animation Duration</label>
                        <input type="text" name="animation_duration_long" value="<?php echo extractCssValue($currentCss, 'animation-duration-long', '10s'); ?>" placeholder="e.g. 10s">
                    </div>
                    <div class="form-group">
                        <label>Cosmic Float Duration</label>
                        <input type="text" name="cosmic_float_duration" value="<?php echo extractCssValue($currentCss, 'cosmic-float-duration', '8s'); ?>" placeholder="e.g. 8s">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Cosmic Pulse Duration</label>
                        <input type="text" name="cosmic_pulse_duration" value="<?php echo extractCssValue($currentCss, 'cosmic-pulse-duration', '5s'); ?>" placeholder="e.g. 5s">
                    </div>
                    <div class="form-group">
                        <label>Cosmic Float Distance</label>
                        <input type="text" name="cosmic_float_distance" value="<?php echo extractCssValue($currentCss, 'cosmic-float-distance', '-10px'); ?>" placeholder="e.g. -10px">
                    </div>
                </div>
                
                <h4>Badge Styles</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Badge Padding</label>
                        <input type="text" name="badge_padding" value="<?php echo extractCssValue($currentCss, 'badge-padding', '5px 10px'); ?>" placeholder="e.g. 5px 10px">
                    </div>
                    <div class="form-group">
                        <label>Badge Border Radius</label>
                        <input type="text" name="badge_border_radius" value="<?php echo extractCssValue($currentCss, 'badge-border-radius', '20px'); ?>" placeholder="e.g. 20px">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Badge Font Size</label>
                                               <input type="text" name="badge_font_size" value="<?php echo extractCssValue($currentCss, 'badge-font-size', '0.8rem'); ?>" placeholder="e.g. 0.8rem">
                    </div>
                    <div class="form-group">
                        <label>Badge Font Weight</label>
                        <input type="text" name="badge_font_weight" value="<?php echo extractCssValue($currentCss, 'badge-font-weight', 'bold'); ?>" placeholder="e.g. bold">
                    </div>
                </div>
                
                <h4>Badge Colors</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Dark Mode Primary Badge Background</label>
                        <input type="text" name="badge_primary_bg_dark" value="<?php echo extractCssValue($currentCss, 'badge-primary-bg-dark', 'var(--cosmic-primary)'); ?>" placeholder="e.g. var(--cosmic-primary)">
                    </div>
                    <div class="form-group">
                        <label>Dark Mode Primary Badge Text</label>
                        <input type="text" name="badge_primary_text_dark" value="<?php echo extractCssValue($currentCss, 'badge-primary-text-dark', '#000'); ?>" placeholder="e.g. #000">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Light Mode Primary Badge Background</label>
                        <input type="text" name="badge_primary_bg_light" value="<?php echo extractCssValue($currentCss, 'badge-primary-bg-light', 'var(--cosmic-accent)'); ?>" placeholder="e.g. var(--cosmic-accent)">
                    </div>
                    <div class="form-group">
                        <label>Light Mode Primary Badge Text</label>
                        <input type="text" name="badge_primary_text_light" value="<?php echo extractCssValue($currentCss, 'badge-primary-text-light', '#fff'); ?>" placeholder="e.g. #fff">
                    </div>
                </div>
                
                <h4>Particle Animation Settings</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>Particle Count</label>
                        <input type="number" name="particle_count" min="0" max="100" value="<?php echo extractCssValue($currentCss, 'particle-count', '50'); ?>" placeholder="e.g. 50">
                    </div>
                    <div class="form-group">
                        <label>Particle Size Range</label>
                        <input type="text" name="particle_size_range" value="<?php echo extractCssValue($currentCss, 'particle-size-range', '1-6'); ?>" placeholder="e.g. 1-6">
                    </div>
                </div>
            </div>

            <div class="tab-content" id="advanced">
                <h3>Advanced Settings</h3>
                
                <h4>Custom CSS</h4>
                <div class="form-group">
                    <label>Add Custom CSS (will be added at the end of the stylesheet)</label>
                    <textarea name="custom_css" rows="10" placeholder="Your custom CSS here..."><?php
                        if (preg_match('/\/\* Custom CSS \*\/\s*(.*?)\s*\/\* End Custom CSS \*\//s', $currentCss, $matches)) {
                            echo trim($matches[1]);
                        }
                    ?></textarea>
                </div>
                
                <h4>CSS Variables</h4>
                <div class="form-group">
                    <p>Want to add more CSS variables to the :root? Add them here, one per line in the format: <code>--variable-name: value;</code></p>
                    <textarea name="custom_variables" rows="5" placeholder="--my-custom-color: #ff0000;"><?php
                        if (preg_match('/\/\* Custom Variables \*\/\s*(.*?)\s*\/\* End Custom Variables \*\//s', $currentCss, $matches)) {
                            echo trim($matches[1]);
                        }
                    ?></textarea>
                </div>
                
                <h4>Script Modifications</h4>
                <div class="form-group">
                    <label>Custom JavaScript (modifies the cosmic theme script)</label>
                    <textarea name="custom_js" rows="10" placeholder="// Your custom JavaScript here..."><?php
                        if (preg_match('/\/\* Custom JS \*\/\s*(.*?)\s*\/\* End Custom JS \*\//s', $currentCss, $matches)) {
                            echo trim($matches[1]);
                        }
                    ?></textarea>
                </div>
                
                <h4>Theme Settings</h4>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="disable_cosmic_particles" value="1" <?php echo strpos($currentCss, '/* Disable Particles */') !== false ? 'checked' : ''; ?>>
                        Disable Cosmic Particles (improves performance)
                    </label>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="disable_container_glow" value="1" <?php echo strpos($currentCss, '/* Disable Container Glow */') !== false ? 'checked' : ''; ?>>
                        Disable Container Glow Effect
                    </label>
                </div>
                
                <div class="form-group">
    <label>
        <input type="checkbox" name="use_system_theme_preference" value="1" <?php echo strpos($currentCss, '/* Use System Theme Preference */') !== false ? 'checked' : ''; ?>>
        Use System Theme Preference (light/dark) if available
    </label>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="optimize_for_mobile" value="1" <?php echo strpos($currentCss, '/* Optimize for Mobile */') !== false ? 'checked' : ''; ?>>
        Optimize for Mobile (reduces effects on small screens)
    </label>
</div>

<h4>Import/Export</h4>
<div class="form-group">
    <label>Export Theme Settings</label>
    <div class="form-actions sub-actions">
        <button type="button" id="export-theme" class="btn btn-secondary">Export Theme</button>
    </div>
</div>

<div class="form-group">
    <label>Import Theme Settings</label>
    <textarea id="import-text" rows="5" placeholder="Paste exported theme settings here..."></textarea>
    <div class="form-actions sub-actions">
        <button type="button" id="import-theme" class="btn btn-secondary">Import Theme</button>
    </div>
</div>
            </div>
        </div>

<div class="form-actions">
    <!-- Hidden fields added here -->
    <input type="hidden" id="selected_pattern_class" name="selected_pattern_class" value="">
    <input type="hidden" id="selected_animation_class" name="selected_animation_class" value="">
    <button type="submit" name="apply_theme" class="btn btn-primary">Apply Theme</button>
    <button type="reset" class="btn btn-secondary">Reset Changes</button>
    <button type="button" id="preview-theme" class="btn btn-outline">Preview Changes</button>
</div>
    </form>
</div>

<!-- Preview modal -->
<div id="preview-modal" class="preview-modal-overlay" style="display:none;">
    <div class="preview-modal-content">
        <div class="preview-modal-header">
            <h3>Theme Preview</h3>
            <button type="button" id="close-preview" class="btn-close">&times;</button>
        </div>
        <div class="preview-modal-body">
            <iframe id="preview-frame" src="about:blank" width="100%" height="500px"></iframe>
        </div>
        <div class="preview-modal-footer">
            <button type="button" id="apply-preview" class="btn btn-primary">Apply Theme</button>
            <button type="button" id="cancel-preview" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</div>


<style>
/* Styles for the theme customizer interface */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.notification-success {
    background-color: rgba(0, 50, 20, 0.8);
    border: 1px solid #00ff9d;
    color: #e0ffe0;
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

h2 {
    margin-bottom: 20px;
    color: var(--cosmic-primary, #00ccff);
}

.tabs {
    margin-top: 30px;
}

.tab-header {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.tab-btn {
    background: transparent;
    border: none;
    padding: 10px 15px;
    margin-right: 5px;
    cursor: pointer;
    color: inherit;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.tab-btn.active {
    opacity: 1;
    border-bottom: 2px solid var(--cosmic-primary, #00ccff);
}

.tab-content {
    display: none;
    padding: 20px 0;
}

.tab-content.active {
    display: block;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
}

.form-group {
    margin-bottom: 20px;
    padding: 0 10px;
    flex: 1 0 200px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

input[type="text"],
input[type="number"],
input[type="color"],
textarea,
select {
    width: 100%;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.2);
    color: inherit;
}

input[type="color"] {
    height: 40px;
    padding: 2px;
}

.color-text {
    margin-top: 5px;
    font-size: 0.9em;
}

input[type="checkbox"] {
    margin-right: 8px;
}

.range-value {
    margin-left: 10px;
    font-weight: bold;
}

textarea {
    font-family: monospace;
    min-height: 100px;
}

h3 {
    margin-bottom: 20px;
    color: var(--cosmic-primary, #00ccff);
}

h4 {
    margin: 20px 0 10px;
    color: var(--cosmic-secondary, #ff00ff);
}

code {
    background: rgba(0, 0, 0, 0.3);
    padding: 3px 5px;
    border-radius: 4px;
    font-family: monospace;
}

.form-actions {
    margin-top: 30px;
    display: flex;
    gap: 10px;
}

.sub-actions {
    margin-top: 10px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: var(--cosmic-primary, #00ccff);
    color: #fff;
}

.btn-primary:hover {
    box-shadow: 0 0 15px var(--cosmic-primary, #00ccff);
}

.btn-secondary {
    background-color: rgba(255, 255, 255, 0.1);
    color: inherit;
}

.btn-secondary:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--cosmic-primary, #00ccff);
    color: var(--cosmic-primary, #00ccff);
}

.btn-outline:hover {
    background-color: rgba(0, 204, 255, 0.1);
}

.btn-close {
    background: transparent;
    border: none;
    font-size: 24px;
    color: inherit;
    cursor: pointer;
}

/* Preview modal */
.preview-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.preview-modal-content {
    width: 90%;
    max-width: 1200px;
    background-color: rgba(18, 18, 37, 0.95);
    border-radius: 10px;
    border: 1px solid rgba(0, 255, 255, 0.2);
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
}

.preview-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid rgba(0, 255, 255, 0.1);
}

.preview-modal-header h3 {
    margin: 0;
}

.preview-modal-body {
    padding: 20px;
}

.preview-modal-footer {
    padding: 15px 20px;
    border-top: 1px solid rgba(0, 255, 255, 0.1);
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

#preview-frame {
    border: none;
    border-radius: 5px;
    background-color: white;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .tab-header {
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .form-group {
        flex: 1 0 100%;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .preview-modal-content {
        width: 95%;
        height: 90%;
    }
    
    #preview-frame {
        height: 400px;
    }
}
</style>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and contents
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Background type toggle
    const backgroundType = document.getElementById('background-type');
    const allBackgroundSettings = document.querySelectorAll('.background-settings');
    
  // Function to toggle background settings
function toggleBackgroundSettings() {
    // Hide all settings first
    allBackgroundSettings.forEach(settingGroup => {
        settingGroup.style.display = 'none';
    });
    
    // Show only the relevant settings based on selection
    const selectedType = backgroundType.value;
    console.log("Selected background type:", selectedType); // Debug logging
    
    if (selectedType === 'image') {
        const imageGroup = document.querySelector('.background-image-group');
        if (imageGroup) {
            imageGroup.style.display = 'block';
            console.log("Showing image settings");
        } else {
            console.error("Could not find .background-image-group element");
        }
    } else if (selectedType === 'particles') {
        const particlesGroup = document.querySelector('.background-particles-settings');
        if (particlesGroup) {
            particlesGroup.style.display = 'block';
            console.log("Showing particles settings");
        } else {
            console.error("Could not find .background-particles-settings element");
        }
    } else if (selectedType === 'patterns') {
        const patternsGroup = document.querySelector('.background-patterns-settings');
        if (patternsGroup) {
            patternsGroup.style.display = 'block';
            console.log("Showing patterns settings");
        } else {
            console.error("Could not find .background-patterns-settings element");
        }
    } else if (selectedType === 'animated') {
        const animatedGroup = document.querySelector('.background-animated-settings');
        if (animatedGroup) {
            animatedGroup.style.display = 'block';
            console.log("Showing animated settings");
        } else {
            console.error("Could not find .background-animated-settings element");
        }
    }
}

    // Initialize and set up event listeners for background type
    if (backgroundType) {
        backgroundType.addEventListener('change', toggleBackgroundSettings);
        toggleBackgroundSettings(); // Initial state
    }
    
    // Pattern style change handler
    const patternStyleSelect = document.getElementById('pattern-style');
    if (patternStyleSelect) {
        patternStyleSelect.addEventListener('change', function() {
            // Update previews or live changes here
            const patternStyle = this.value;
            
            // Update pattern previews if they exist
            const patternPreviews = document.querySelectorAll('.pattern-preview');
            if (patternPreviews.length > 0) {
                patternPreviews.forEach(preview => {
                    preview.style.display = 'none';
                });
                const activePreview = document.getElementById('preview-' + patternStyle);
                if (activePreview) {
                    activePreview.style.display = 'block';
                }
            }
            
            // Ensure the hidden field exists
            let hiddenField = document.getElementById('selected_pattern_class');
            if (!hiddenField) {
                hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.id = 'selected_pattern_class';
                hiddenField.name = 'selected_pattern_class';
                document.querySelector('form').appendChild(hiddenField);
            }
            
            // Update the hidden field
            hiddenField.value = patternStyle;
            console.log('Pattern class set to:', patternStyle);
            
            // If you have a live preview element, update it as well
            const previewElement = document.getElementById('live-preview') || document.body;
            
            // Remove any existing pattern classes
            const patternClasses = ['pattern1', 'pattern2', 'pattern3', 'pattern4', 'pattern5',
                                   'pattern6', 'pattern7', 'pattern8', 'pattern9', 'pattern10'];
            patternClasses.forEach(cls => previewElement.classList.remove(cls));
            
            // Add the selected pattern class
            previewElement.classList.add(patternStyle);
        });
    }
    
    // Range value displays
    document.querySelectorAll('input[type="range"]').forEach(range => {
        const valueDisplay = range.nextElementSibling;
        if (valueDisplay && valueDisplay.classList.contains('range-value')) {
            // Update value display when slider moves
            range.addEventListener('input', function() {
                valueDisplay.textContent = this.value;
            });
            
            // Set initial value
            valueDisplay.textContent = range.value;
        }
    });
    
    // Animation toggle
    const animationEnabled = document.querySelector('input[name="animation_enabled"]');
    const animationGroups = document.querySelectorAll('.animation-group');
    
    function toggleAnimationSpeedField() {
        if (!animationEnabled) return;
        
        animationGroups.forEach(group => {
            if (animationEnabled.checked) {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        });
    }
    
    if (animationEnabled) {
        animationEnabled.addEventListener('change', toggleAnimationSpeedField);
        toggleAnimationSpeedField(); // Initial state
    }
    
    // Theme off toggle
    const themeOff = document.querySelector('input[name="theme_off"]');
    const formGroups = document.querySelectorAll('.form-group:not(.toggle-group), .form-row, h3, h4');
    
    function toggleThemeFields() {
        if (!themeOff) return;
        
        formGroups.forEach(group => {
            if (themeOff.checked) {
                group.style.opacity = '0.5';
                group.style.pointerEvents = 'none';
            } else {
                group.style.opacity = '1';
                group.style.pointerEvents = 'auto';
            }
        });
    }
    
    if (themeOff) {
        themeOff.addEventListener('change', toggleThemeFields);
        toggleThemeFields(); // Initial state
    }
    
    // Sync color inputs with text inputs
    const colorInputs = document.querySelectorAll('input[type="color"]');
    
    colorInputs.forEach(input => {
        const textInput = input.nextElementSibling;
        if (textInput && textInput.classList.contains('color-text')) {
            // Sync from color picker to text
            input.addEventListener('input', function() {
                textInput.value = this.value;
            });
            
            // Sync from text to color picker
            textInput.addEventListener('input', function() {
                input.value = this.value;
            });
        }
    });
    
    // Function to apply pattern class to body on form submission
    function applySelectedPattern() {
        const patternType = document.getElementById('background-type');
        if (!patternType) return;
        
        // Create hidden fields for pattern and animation classes if they don't exist
        const form = document.querySelector('form');
        if (!form) return;
        
        let patternClassField = document.getElementById('selected_pattern_class');
        if (!patternClassField) {
            patternClassField = document.createElement('input');
            patternClassField.type = 'hidden';
            patternClassField.id = 'selected_pattern_class';
            patternClassField.name = 'selected_pattern_class';
            form.appendChild(patternClassField);
        }
        
        let animationClassField = document.getElementById('selected_animation_class');
        if (!animationClassField) {
            animationClassField = document.createElement('input');
            animationClassField.type = 'hidden';
            animationClassField.id = 'selected_animation_class';
            animationClassField.name = 'selected_animation_class';
            form.appendChild(animationClassField);
        }
        
        if (patternType.value === 'patterns') {
            const patternStyle = document.getElementById('pattern-style');
            if (patternStyle) {
                // Store current class to be applied to body later
                patternClassField.value = patternStyle.value;
                // Clear any animation class
                animationClassField.value = '';
                console.log('Applied pattern:', patternStyle.value);
            }
        } else if (patternType.value === 'animated') {
            const animationStyle = document.querySelector('select[name="animation_style"]');
            if (animationStyle) {
                // Store current animation class to be applied to body later
                animationClassField.value = 'animated-' + animationStyle.value;
                // Clear any pattern class
                patternClassField.value = '';
                console.log('Applied animation:', 'animated-' + animationStyle.value);
            }
        } else {
            // Clear both for other background types
            patternClassField.value = '';
            animationClassField.value = '';
        }
    }
    
    // Add form submit event listener
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            applySelectedPattern();
            console.log('Form submitted with:');
            console.log('- Pattern class:', document.getElementById('selected_pattern_class')?.value);
            console.log('- Animation class:', document.getElementById('selected_animation_class')?.value);
        });
    }
    
    // Preview functionality
    const previewBtn = document.getElementById('preview-theme');
    const previewModal = document.getElementById('preview-modal');
    const closePreviewBtn = document.getElementById('close-preview');
    const cancelPreviewBtn = document.getElementById('cancel-preview');
    const applyPreviewBtn = document.getElementById('apply-preview');
    const previewFrame = document.getElementById('preview-frame');
    
    if (previewBtn && previewModal && previewFrame) {
        previewBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Apply the selected pattern/animation before preview
            applySelectedPattern();
            
            // Create a form data object
            const formData = new FormData(form);
            formData.append('preview_theme', '1'); // Add flag to indicate preview
            
            // Open the modal
            previewModal.style.display = 'flex';
            
            // Post the form data to a temp preview script
            fetch('preview-theme.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Load the preview into the iframe
                previewFrame.srcdoc = data;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to generate preview: ' + error);
            });
        });
        
        if (closePreviewBtn) {
            closePreviewBtn.addEventListener('click', function() {
                previewModal.style.display = 'none';
            });
        }
        
        if (cancelPreviewBtn) {
            cancelPreviewBtn.addEventListener('click', function() {
                previewModal.style.display = 'none';
            });
        }
        
        if (applyPreviewBtn) {
            applyPreviewBtn.addEventListener('click', function() {
                // Submit the form to apply the theme
                form.submit();
            });
        }
    }
    
    // Export/Import functionality
    const exportBtn = document.getElementById('export-theme');
    const importBtn = document.getElementById('import-theme');
    const importText = document.getElementById('import-text');
    
    if (exportBtn && importBtn && importText) {
        exportBtn.addEventListener('click', function() {
            // Create an object with all form values
            const formData = new FormData(form);
            const exportObj = {};
            
            for (let [key, value] of formData.entries()) {
                exportObj[key] = value;
            }
            
            // Convert to JSON and encode
            const exportData = btoa(JSON.stringify(exportObj));
            
            // Set to textarea
            importText.value = exportData;
            
            // Also copy to clipboard
            navigator.clipboard.writeText(exportData)
                .then(() => {
                    alert('Theme settings copied to clipboard and added to the import box!');
                })
                .catch(err => {
                    alert('Theme settings added to the import box! Error copying to clipboard: ' + err);
                });
        });
        
        importBtn.addEventListener('click', function() {
            try {
                // Get the import text
                const importData = importText.value.trim();
                
                if (!importData) {
                    alert('Please paste exported theme settings first!');
                    return;
                }
                
                // Decode and parse the data
                const importObj = JSON.parse(atob(importData));
                
                // Populate the form fields
                for (let key in importObj) {
                    const input = form.elements[key];
                    if (input) {
                        if (input.type === 'checkbox') {
                            input.checked = importObj[key] === '1';
                        } else {
                            input.value = importObj[key];
                        }
                    }
                }
                
                // Trigger change events to update dependent fields
                if (form.elements['theme_off']) {
                    const event = new Event('change');
                    form.elements['theme_off'].dispatchEvent(event);
                }
                
                if (form.elements['background_type']) {
                    const event = new Event('change');
                    form.elements['background_type'].dispatchEvent(event);
                }
                
                if (form.elements['animation_enabled']) {
                    const event = new Event('change');
                    form.elements['animation_enabled'].dispatchEvent(event);
                }
                
                alert('Theme settings imported successfully!');
            } catch (error) {
                alert('Error importing theme settings: ' + error);
            }
        });
    }
});
</script>



<?php
require_once('footer.php');
?>
