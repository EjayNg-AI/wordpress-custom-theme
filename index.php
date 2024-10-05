<?php
// index.php - Main template file
get_header();
?>

<main class="content-area">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_title('<h1>', '</h1>'); ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
      <?php
    endwhile;
  else :
    echo '<p>' . esc_html__( 'No content found', 'custom-landing-page' ) . '</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>
