<?php

// Add scripts and stylesheets
function mrcobra_scripts() {

    wp_enqueue_style( 'mrcobra-styles', get_template_directory_uri() . '/dist/styles.css' );

    wp_enqueue_script( 'mrcobra-js', get_template_directory_uri() . '/dist/app.js', array(), '20161014', true );

}
add_action( 'wp_enqueue_scripts', 'mrcobra_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function popper_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Widget Area', 'popper' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'popper_widgets_init' );

// Custom settings
function custom_settings_add_menu() {
    add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99);
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
    <div class="wrap">
        <h1>Custom Settings</h1>
        <form method="post" action="options.php">
            <?php
               settings_fields('section');
               do_settings_sections('theme-options');
               submit_button();
            ?>
        </form>
    </div>
<?php }

//social links input fields
function setting_twitter() { ?>
    <input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>" />
<?php }

function setting_googleplus() { ?>
    <input type="text" name="googleplus" id="googleplus" value="<?php echo get_option('googleplus'); ?>" />
<?php }

function setting_facebook() { ?>
    <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

function setting_linkedin() { ?>
    <input type="text" name="linkedin" id="linkedin" value="<?php echo get_option('linkedin'); ?>" />
<?php }

function custom_settings_page_setup() {
    add_settings_section('section', 'All Settings', null, 'theme-options');
    add_settings_field('twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section');
    add_settings_field('googleplus', 'Google+ URL', 'setting_googleplus', 'theme-options', 'section');
    add_settings_field('facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section');
    add_settings_field('linkedin', 'Linkedin URL', 'setting_linkedin', 'theme-options', 'section');

    register_setting('section', 'twitter');
    register_setting('section', 'googleplus');
    register_setting('section', 'facebook');
    register_setting('section', 'linkedin');
}
add_action( 'admin_init', 'custom_settings_page_setup' );

// Support Featured Images
add_theme_support( 'post-thumbnails' );

//add menus
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

// Custom Post Types
function create_my_custom_post() {
    register_post_type('my-custom-post',
        array(
            'labels' => array(
                'name' => __('My Custom Post'),
                'singular_name' => __('My Custom Post'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => [
                'title',
                'author',
                'thumbnail',
                'custom-fields'
            ],
            'taxonomies'         => [
                'category',
                'post_tag',
            ],
        )
    );
}
add_action('init', 'create_my_custom_post');

// Custom Video Types
function create_video() {
    $labels = array(
        'name'               => esc_html__( 'Videos', 'fsc' ),
        'singular_name'      => esc_html__( 'Video', 'fsc' ),
        'add_new'            => esc_html__( 'Add New Video', 'fsc' ),
        'add_new_item'       => esc_html__( 'Add New Video', 'fsc' ),
        'new_item'           => esc_html__( 'New Video', 'fsc' ),
        'edit_item'          => esc_html__( 'Edit Video', 'fsc' ),
        'view_item'          => esc_html__( 'View Videos', 'fsc' ),
        'all_items'          => esc_html__( 'All Videos', 'fsc' ),
        'search_items'       => esc_html__( 'Search Videos', 'fsc' ),
        'not_found'          => esc_html__( 'No Video found', 'fsc' ),
        'not_found_in_trash' => esc_html__( 'No Video found in Trash', 'fsc' ),
    );

    $args = array(
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-video',
        'query_var'          => true,
        'labels'             => $labels,
        'rewrite'            => true,
        'hierarchical'       => false,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports'           => [
            'title',
            'thumbnail',
            'author',
            'custom-fields',
            'auto-tag',
        ],
        'taxonomies'         => [
            'category',
            'post_tag',
        ],
    );

    register_post_type( 'video', $args );
}
add_action('init', 'create_video');


// Custom Post Types
function create_press_post() {
    register_post_type('press-post',
        array(
            'labels' => array(
                'name' => __('Press Post'),
                'singular_name' => __('Press Post'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => [
                'title',
                'author',
                'thumbnail',
                'custom-fields'
            ],
            'taxonomies'         => [
                'category',
                'post_tag',
            ],
        )
    );
}
add_action('init', 'create_press_post');

//function create_press_post() {
//    register_post_type('press_post',
//        array(
//            'labels' => array(
//                'name' => __('Press Post'),
//                'singular_name' => __('Press Post'),
//            ),
//            'public' => true,
//            'has_archive' => true,
//            'supports' => [
//                'title',
//                'author',
//                'thumbnail',
//                'custom-fields'
//            ],
//            'taxonomies'         => [
//                'category',
//                'post_tag',
//            ],
//        )
//    );
//}
//add_action('init', 'create_press_post');
