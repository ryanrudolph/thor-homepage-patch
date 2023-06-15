<?php
/*
Plugin Name: Thor Home Patch
*/

function thor_add_functions() {

    // Overwrite front-page.php
    function custom_front_page_template($template) {
        if (is_front_page()) {
            $custom_template = plugin_dir_path(__FILE__) . 'new-front-page.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }
    add_filter('template_include', 'custom_front_page_template');
    
    // Add CSS
    function enqueue_custom_home_scripts() {
        wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/home.css', array(), '1.0', 'all' );
        wp_enqueue_script( 'gp-accordion', get_stylesheet_directory_uri() . '/gp-accordion.js', '1.0.0', );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_custom_home_scripts' );    

    // Add theme functions CSS
    add_action( 'wp_head', 'thor_customize_css' );
    /*
     * Output custom colors from the customizer
     *
     */
    function thor_customize_css() {
        ?>
             <style type="text/css">
                 .accordion-toggle, .home .section-1 .button { background: <?php echo get_theme_mod( 'thor_primary_color', '#333333' ); ?> -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0)), to(rgba(0, 0, 0, 0.1))); }
             </style>
        <?php
    }
    
    // Add ACF import
    function display_plugin_setup_page() {
        include_once( plugin_dir_path( __FILE__ ) . 'setup-page.php' );
    }
    
    function add_plugin_setup_page() {
        add_menu_page( 'Home Page Setup', 'Plugin Setup', 'manage_options', 'plugin-setup', 'display_plugin_setup_page' );
    }
    
    add_action( 'admin_menu', 'add_plugin_setup_page' );

}
add_action('after_setup_theme', 'thor_add_functions');