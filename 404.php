<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */
?>

<?php get_header(); ?>
	<?php do_action( 'pageline_before_body_content' );
	$pageline_layout = pageline_layout_class(); ?>

	<div id="content" class="site-content">
	   	<main id="main" class="clearfix <?php echo esc_attr( $pageline_layout ); ?>">
		   	<div class="nnc-container">

				<div id="primary">
			   		<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pageline' ); ?></h1>
						</header><!-- .page-header -->
						<div class="page-content">
							<span class="error-404-num"><?php esc_html_e('404 Error', 'pageline'); ?></span>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search ?', 'pageline' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->				
				</div><!-- #primary -->

				<?php  pageline_sidebar_select(); ?>
		   	</div><!-- end nnc-container -->
		</main><!-- #main -->
	</div><!-- #content -->

	<?php do_action( 'pageline_after_body_content' ); ?>
<?php get_footer(); ?>