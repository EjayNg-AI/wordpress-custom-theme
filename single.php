<?php get_header(); ?>

<main class="single-post-content">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title('<h1>', '</h1>'); ?>
          <p class="post-date"><?php echo esc_html( get_the_date() ); ?></p>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
      <?php
    endwhile;
  else :
    echo '<p>' . esc_html__( 'No posts found.', 'custom-landing-page' ) . '</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>
