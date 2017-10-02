<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Noko
 */
?>

<a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
  <div>
  <?php if( has_post_thumbnail() ): ?>
    <div class="card-image" style="background: url(<?php 
    the_post_thumbnail_url('medium'); ?>) no-repeat center/cover; height: 10em;"></div>
  <?php endif;?>
    <div class="text-content">
      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
      <span style="float:right">By <?php echo get_the_author(); ?></span>
    </div>
  </div>
</a>

