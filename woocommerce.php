<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pagline
 */

get_header();
?>
	<div id="content" class="site-content">
		<main id="main" class="clearfix <?php echo esc_attr( $pageline_layout ); ?>">
			<div class="nnc-container">
				<!-- Breadcrumbs -->
				<div class="block">
					<?php pageline_breadcrumbs(); ?>
				</div>

				<div id="primary">
				<?php woocommerce_content(); ?>
				</div><!-- #primary -->
				<?php  pageline_sidebar_select(); ?>
			</div><!-- .tg-container -->
		</main><!-- #main -->
	</div><!-- #content -->
<?php do_action( 'pageline_after_body_content' );

get_footer();
