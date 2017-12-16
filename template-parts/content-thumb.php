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
      <span style="float:right; padding: 10px;">
      <?php

      $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_attr( get_the_modified_date( 'c' ) ),
      esc_html( get_the_modified_date() )
    );

    echo $time_string; ?> - 
    <?php printf(__('By %s', 'noko'), get_the_author()); ?>
      </span>
    </div>
  </div>
</a>

