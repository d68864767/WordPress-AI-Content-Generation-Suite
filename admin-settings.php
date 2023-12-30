```php
<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Create menu page
function wp_ai_content_gen_suite_menu() {
    add_menu_page(
        'AI Content Generation Suite', // Page title
        'AI Content Generation Suite', // Menu title
        'manage_options', // Capability
        'ai-content-gen-suite', // Menu slug
        'wp_ai_content_gen_suite_settings_page', // Function that handles the page content
        'dashicons-admin-generic', // Icon URL
        100 // Position on the menu
    );
}

add_action('admin_menu', 'wp_ai_content_gen_suite_menu');

// Create settings page
function wp_ai_content_gen_suite_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Add settings error/update message
    settings_errors('wp_ai_content_gen_suite_messages');

    // Show settings form
    echo '<div class="wrap">';
    echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
    echo '<form action="options.php" method="post">';

    // Output security fields
    settings_fields('wp_ai_content_gen_suite');
    // Output setting sections and fields
    do_settings_sections('wp_ai_content_gen_suite');
    // Output save settings button
    submit_button('Save Settings');

    echo '</form>';
    echo '</div>';
}

// Register settings
function wp_ai_content_gen_suite_settings_init() {
    // Register a new setting for the AI Content Generation Suite page
    register_setting('wp_ai_content_gen_suite', 'wp_ai_content_gen_suite_options');

    // Add a new section to the AI Content Generation Suite page
    add_settings_section(
        'wp_ai_content_gen_suite_section', // ID
        'AI Content Generation Suite Settings', // Title
        'wp_ai_content_gen_suite_section_callback', // Callback
        'wp_ai_content_gen_suite' // Page
    );

    // Add a new field to the 'wp_ai_content_gen_suite_section' section
    add_settings_field(
        'wp_ai_content_gen_suite_field', // ID
        'Keyword', // Title
        'wp_ai_content_gen_suite_field_callback', // Callback
        'wp_ai_content_gen_suite', // Page
        'wp_ai_content_gen_suite_section' // Section
    );
}

add_action('admin_init', 'wp_ai_content_gen_suite_settings_init');

// Section callback
function wp_ai_content_gen_suite_section_callback($args) {
    echo '<p>Enter your settings below:</p>';
}

// Field callback
function wp_ai_content_gen_suite_field_callback($args) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option('wp_ai_content_gen_suite_options');
    // Output the field
    echo '<input type="text" id="wp_ai_content_gen_suite_field" name="wp_ai_content_gen_suite_options[wp_ai_content_gen_suite_field]" value="' . esc_attr($options['wp_ai_content_gen_suite_field']) . '">';
}
```
</p>