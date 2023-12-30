```php
<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Function to run when the plugin is activated
function wp_ai_content_gen_suite_install() {
    // Check if WordPress version is compatible with the plugin
    global $wp_version;
    if (version_compare($wp_version, '5.0', '<')) {
        wp_die('This plugin requires WordPress version 5.0 or higher.');
    }

    // Create necessary database tables
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Table for storing generated content
    $table_name = $wpdb->prefix . 'ai_content_gen_suite_content';
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title text NOT NULL,
        content longtext NOT NULL,
        length varchar(10) NOT NULL,
        seo_optimized tinyint(1) NOT NULL DEFAULT 0,
        plagiarism_checked tinyint(1) NOT NULL DEFAULT 0,
        UNIQUE KEY id (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Table for storing SEO keywords
    $table_name = $wpdb->prefix . 'ai_content_gen_suite_seo_keywords';
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        keyword text NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";
    dbDelta($sql);

    // Add default options
    add_option('wp_ai_content_gen_suite_options', array(
        'default_length' => 'Medium',
        'default_seo_optimization' => 1,
        'default_plagiarism_check' => 1
    ));
}

// Register the function to run when the plugin is activated
register_activation_hook(__FILE__, 'wp_ai_content_gen_suite_install');
```
