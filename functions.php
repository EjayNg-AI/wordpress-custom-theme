<?php
/**
 * Custom Landing Page Theme Functions
 *
 * @package CustomLandingPage
 */

/**
 * Set up theme defaults and register support for various WordPress features.
 */
function custom_landing_page_setup() {
  // Register the main menu
  register_nav_menus( array(
    'main-menu' => __( 'Main Menu', 'custom-landing-page' ),
  ) );

  // Add theme support for title tag
  add_theme_support( 'title-tag' );

  // Add theme support for post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add HTML5 support
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

  // Add theme support for custom logo
  add_theme_support( 'custom-logo', array(
    'height'      => 50,
    'width'       => 200,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

  // Set up a dedicated page for blog posts if not already set
  if ( get_option( 'page_for_posts' ) == 0 ) {
    $blog_page_title = 'Blog';
    $blog_page_check = get_page_by_title( $blog_page_title );
    if ( ! isset( $blog_page_check->ID ) ) {
      $new_blog_page = array(
        'post_type'    => 'page',
        'post_title'   => $blog_page_title,
        'post_content' => '',
        'post_status'  => 'publish',
        'post_author'  => 1,
      );
      $blog_page_id = wp_insert_post( $new_blog_page );
      update_option( 'page_for_posts', $blog_page_id );
    }
  }
}
add_action( 'after_setup_theme', 'custom_landing_page_setup' );

/**
 * Register custom customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function custom_landing_page_customizer( $wp_customize ) {
  // Logo Section
  $wp_customize->add_section( 'custom_logo_section' , array(
    'title'      => __( 'Logo', 'custom-landing-page' ),
    'priority'   => 30,
  ) );

  // Footer Settings Section
  $wp_customize->add_section( 'footer_settings', array(
    'title'    => __( 'Footer Settings', 'custom-landing-page' ),
    'priority' => 40,
  ) );

  // Footer Text Setting
  $wp_customize->add_setting( 'footer_text', array(
    'default'           => '&copy; ' . date('Y') . ' Your Company Name. All Rights Reserved.',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'footer_text', array(
    'label'    => __( 'Footer Text', 'custom-landing-page' ),
    'section'  => 'footer_settings',
    'type'     => 'text',
  ) );

  // Footer Contact Email Setting
  $wp_customize->add_setting( 'footer_contact_email', array(
    'default'           => 'info@example.com',
    'sanitize_callback' => 'sanitize_email',
  ) );

  $wp_customize->add_control( 'footer_contact_email', array(
    'label'    => __( 'Footer Contact Email', 'custom-landing-page' ),
    'section'  => 'footer_settings',
    'type'     => 'email',
  ) );
}
add_action( 'customize_register', 'custom_landing_page_customizer' );

/**
 * Enqueue theme styles conditionally.
 */
function custom_landing_page_enqueue_styles() {
  // Enqueue main stylesheet on all pages
  wp_enqueue_style( 'custom-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

  // Enqueue additional styles for single posts
  if ( is_single() ) {
    wp_enqueue_style( 'single-post-style', get_template_directory_uri() . '/css/single-post.css', array(), '1.0' );
  }

  // Enqueue additional styles for archives
  if ( is_archive() ) {
    wp_enqueue_style( 'archive-style', get_template_directory_uri() . '/css/archive.css', array(), '1.0' );
  }
}
add_action( 'wp_enqueue_scripts', 'custom_landing_page_enqueue_styles' );

/**
 * Add support for selective refresh in the customizer for the footer text.
 */
function custom_landing_page_customize_partial_footer_text() {
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      wp.customize('footer_text', function(value) {
        value.bind(function(newval) {
          var footerText = document.querySelector('.footer-content p:first-child');
          if (footerText) {
            footerText.innerHTML = newval;
          }
        });
      });

      wp.customize('footer_contact_email', function(value) {
        value.bind(function(newval) {
          var contactLink = document.querySelector('.footer-content p:last-child a');
          if (contactLink) {
            contactLink.setAttribute('href', 'mailto:' + newval);
            contactLink.textContent = newval;
          }
        });
      });
    });
  </script>
  <?php
}
add_action( 'customize_preview_init', 'custom_landing_page_customize_partial_footer_text' );
