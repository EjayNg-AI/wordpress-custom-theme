<?php get_header(); ?>

<main class="page-content">
  <?php
  // Function to detect mobile devices
  function is_mobile_device_custom() {
    return wp_is_mobile();
  }

  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_title('<h1>', '</h1>'); ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>

        <!-- Example of desktop-only content -->
        <?php if ( ! is_mobile_device_custom() ) : ?>
          <div class="desktop-only" aria-hidden="true">
            <p>This content is visible only on desktop devices.</p>
          </div>
        <?php endif; ?>

        <!-- Example of mobile-only content -->
        <?php if ( is_mobile_device_custom() ) : ?>
          <div class="mobile-only" aria-hidden="true">
            <p>This content is visible only on mobile devices.</p>
          </div>
        <?php endif; ?>
      </article>
      <?php
    endwhile;
  endif;
  ?>
</main>

<?php get_footer(); ?>
