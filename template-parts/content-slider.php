<?php
/**
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

?>

<?php
$page_array = array();
for ( $i=1; $i<=4; $i++ ) {
  $page_id = get_theme_mod( 'pageline_slide'.$i );
    if ( !empty ( $page_id ) )
    array_push( $page_array, $page_id );
}
$get_featured_posts = new WP_Query(
  array(
    'posts_per_page'     => -1,
    'post_type'          =>  array( 'page' ),
    'post__in'           => $page_array,
    'orderby'            => 'post__in'
) ); ?>
<?php if ( ! empty( $page_array ) ) : ?>
  <!-- Slider-start -->
  <section id="home" class="banner-slider">
    <div class="owl-carousel">
      <?php while( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); ?>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="item slider">
              <div class="b-img" style="background: url(<?php the_post_thumbnail_url( 'pageline-slider' ); ?>); background-position: center; background-size: cover; background-repeat: no-repeat; height: 100%;"> 
              <div class="bg"></div>
            </div>     
            <div class="caption">
              <div class="outer">
                <div class="inner">
                  <h2><?php the_title(); ?></h2> 
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>"><?php echo esc_html( 'Read More', 'pageline' ); ?></a>
                </div> 
              </div> 
            </div> 
            </div>
        <?php endif; ?>
      <?php endwhile;
      // Reset Post Data
      wp_reset_query(); ?>
    </div>
  </section> 
  <!-- Slider-end -->
<?php endif; ?>


