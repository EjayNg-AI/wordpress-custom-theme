<?php get_header(); ?>

<main class="blog-archive">
  <h1><?php the_archive_title(); ?></h1>
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-summary' ); ?>>
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-excerpt">
          <?php the_excerpt(); ?>
        </div>
      </article>
      <?php
    endwhile;

    // Pagination
    the_posts_pagination( array(
      'mid_size'  => 2,
      'prev_text' => __( 'Back', 'custom-landing-page' ),
      'next_text' => __( 'Next', 'custom-landing-page' ),
    ) );
  else :
    echo '<p>' . esc_html__( 'No posts found.', 'custom-landing-page' ) . '</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>
