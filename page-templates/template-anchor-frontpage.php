<?php
/**
 * Template Name: PageLine Startpage
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */
?>

<?php get_header(); ?>

  <?php do_action( 'pageline_before_body_content' ); ?>

  <?php if( is_active_sidebar( 'pageline_frontpage_section' ) ) {
    if( !dynamic_sidebar( 'pageline_frontpage_section' ) ):
    endif;
  } ?>

  <?php do_action( 'pageline_before_body_content' ); ?>

<?php get_footer(); ?>