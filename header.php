<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php
    // Dynamically get the custom logo URL
    if ( has_custom_logo() ) {
      $custom_logo_id = get_theme_mod( 'custom_logo' );
      $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      $logo_url = esc_url( $logo[0] );
    } else {
      $logo_url = esc_url( get_template_directory_uri() . '/images/logo.png' );
    }
  ?>

  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?php bloginfo( 'name' ); ?>",
    "url": "<?php echo esc_url( home_url() ); ?>",
    "logo": "<?php echo $logo_url; ?>",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+1-800-555-5555",
      "contactType": "Customer Service"
    }
  }
  </script>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
  <div class="header-container" style="display: flex; align-items: center; width: 100%;">
    <?php
      if ( has_custom_logo() ) {
        the_custom_logo();
      } else {
        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo">';
      }
    ?>

    <!-- Mobile Menu Toggle -->
    <input type="checkbox" id="menu-toggle" class="menu-toggle-checkbox" aria-controls="primary-menu" aria-expanded="false" />
    <label for="menu-toggle" class="menu-toggle-label" aria-label="<?php esc_attr_e( 'Toggle Menu', 'custom-landing-page' ); ?>">
      <span class="menu-icon" aria-hidden="true">&#9776;</span>
    </label>

    <!-- Navigation Menu -->
    <nav role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'custom-landing-page' ); ?>">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'main-menu',
          'container' => false, // Removed container to avoid nesting issues
          'menu_class' => 'menu-ul',
          'fallback_cb' => false,
          'depth' => 2, // For drop-down menus
          // 'walker' => new WP_Bootstrap_Navwalker(), // Removed custom walker
        ));
      ?>
    </nav>
  </div>
</header>
