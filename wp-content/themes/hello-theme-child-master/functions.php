<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Add the ability to make the image full width
 */
add_theme_support( 'align-wide' );


/**
 * Simple Templating function
 *
 * @param $name   - PHP file that acts as a template.
 * @param $args   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */
function theme_render( $name, $args ){
  $file = get_stylesheet_directory() . '/templates/' . $name . '.php';  
  // ensure the file exists
  if ( !file_exists( $file ) ) {
    return '';
  }

  // Make values in the associative array easier to access by extracting them
  if ( is_array( $args ) ){
    extract( $args );
  }

  // buffer the output (including the file is "output")
  ob_start();
    include $file;
  return ob_get_clean();
}

/**
 * Gets the list of Contacts
 * Each contact is the content of the post
 * The category name is Contacts
 */
function get_posts_by_category($category) {
    $args = [
        'numberposts' => -1, 
        'category_name' => $category,
        'orderby' => 'date',
        'order' => 'ASC',
    ];

    return get_posts( $args );
}


/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [
                'hello-elementor-theme-style',
        ],
        '1.0.0'
    );
    
    // Nav mobile menu
    wp_enqueue_script( 'wpb_togglemenu', get_stylesheet_directory_uri() . '/js/navigation.js', array('jquery'), '20201027', true );

    // Tooltip
    wp_enqueue_script( 'wpb_tooltip', get_stylesheet_directory_uri() . '/js/tooltip.js', array('jquery'), '20201027', true );
}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

/**
 *  Add a class to the body part - this one help getting full width page
 */
add_filter( 'body_class', 'huji_body_classes' );
function huji_body_classes( $classes ) {
 
    $classes[] = 'elementor-page-huji';
     
    return $classes;
     
}

add_filter('post_class', 'set_post_class_huji', 10, 3);
function set_post_class_huji($classes, $class, $post_id){
    if (is_admin()) { //make sure we are i the dashboard 
        return $classes;
    }

    $post = get_post($post_id); 
    $classes[] = $post->post_name;
 
    // Return the array
    return $classes;
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
    /**
     * Set up theme support.
     *
     * @return void
     */
    function hello_elementor_setup() {
        $hook_result = apply_filters_deprecated( 'elementor_hello_theme_load_textdomain', [ true ], '2.0', 'hello_elementor_load_textdomain' );
        if ( apply_filters( 'hello_elementor_load_textdomain', $hook_result ) ) {
                load_theme_textdomain( 'hello-elementor', get_template_directory() . '/languages' );
        }

        $hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_elementor_register_menus' );
        if ( apply_filters( 'hello_elementor_register_menus', $hook_result ) ) {
                register_nav_menus( [ 
                    'header' => __( 'Header', 'hello-elementor' ),
                    'mobile' => __( 'Mobile', 'hello-elementor' ),                
                ]  );
        }

        $hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_elementor_add_theme_support' );
        if ( apply_filters( 'hello_elementor_add_theme_support', $hook_result ) ) {
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'title-tag' );
            add_theme_support(
                'html5',
                array(
                    'search-form',
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                )
            );
            add_theme_support(
                'custom-logo',
                array(
                    'height'      => 100,
                    'width'       => 350,
                    'flex-height' => true,
                    'flex-width'  => true,
                )
            );

            /*
             * Editor Style.
             */
            add_editor_style( 'editor-style.css' );

            /*
             * WooCommerce.
             */
            $hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_elementor_add_woocommerce_support' );
            if ( apply_filters( 'hello_elementor_add_woocommerce_support', $hook_result ) ) {
                // WooCommerce in general.
                add_theme_support( 'woocommerce' );
                // Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
                // zoom.
                add_theme_support( 'wc-product-gallery-zoom' );
                // lightbox.
                add_theme_support( 'wc-product-gallery-lightbox' );
                // swipe.
                add_theme_support( 'wc-product-gallery-slider' );
            }
        }
    }
}

// Load translation files from your child theme instead of the parent theme
function hello_child_locale() {
    load_child_theme_textdomain('hello_child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'hello_child_locale' );

function themeslug_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.// Add a footer/copyright information section.
    $wp_customize->add_section( 'hello_child_footer' , array(
        'title' => __( 'Footer', 'hello_child' ),
        'priority' => 105, // Before Widgets.
    ) );

    $wp_customize->add_setting( 'hello_child_footer_right_title' );
    $wp_customize->add_control( 'hello_child_footer_right_title', array(
        'label' => __( 'Footer Right Title', 'hello_child' ),
        'section' => 'hello_child_footer',
    ) );

    $wp_customize->add_setting( 'hello_child_footer_right' );
    $wp_customize->add_control( 'hello_child_footer_right', array(
        'label' => __( 'Footer Right', 'hello_child' ),
        'type' => 'textarea',
        'section' => 'hello_child_footer',
    ) );

    $wp_customize->add_setting( 'hello_child_footer_center_title' );
    $wp_customize->add_control( 'hello_child_footer_center_title', array(
        'label' => __( 'Footer Center Title', 'hello_child' ),
        'section' => 'hello_child_footer',
    ) );

    $wp_customize->add_setting( 'hello_child_footer_center' );
    $wp_customize->add_control( 'hello_child_footer_center', array(
        'label' => __( 'Footer Center', 'hello_child' ),
        'type' => 'textarea',
        'section' => 'hello_child_footer',
    ) );

    $wp_customize->add_setting( 'hello_child_footer_left_title' );
    $wp_customize->add_control( 'hello_child_footer_left_title', array(
        'label' => __( 'Footer Left Title', 'hello_child' ),
        'section' => 'hello_child_footer',
    ) );

    $wp_customize->add_setting( 'hello_child_footer_left' );
    $wp_customize->add_control( 'hello_child_footer_left', array(
        'label' => __( 'Footer Left', 'hello_child' ),
        'type' => 'textarea',
        'section' => 'hello_child_footer',
    ) );
}
add_action( 'customize_register', 'themeslug_customize_register' );
