<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
	   			<!-- Breadcrumbs -->
				<div class="block">
					<?php pageline_breadcrumbs(); ?>
				</div>

		   		<div id="primary">
					<?php if ( have_posts() ) : ?>
						<header class="page-header">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );

								// Show an optional term description.
								$term_description = term_description();
								if ( ! empty( $term_description ) ) :
									printf( '<div class="taxonomy-description">%s</div>', $term_description );
								endif;
							?>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
						endwhile;
						pageline_navigation();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>
				</div><!-- #primary -->
				<?php  pageline_sidebar_select(); ?>
	   		</div><!-- end nnc-container -->
		</main><!-- #main -->
	</div><!-- #content -->
	<?php do_action( 'pageline_after_body_content' ); ?>
<?php get_footer(); ?>