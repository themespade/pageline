<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */
?>
	<!-- Footer-end -->
	<?php if ( is_active_sidebar( 'pageline_footer_section_1' ) || is_active_sidebar( 'pageline_footer_section_2' ) || is_active_sidebar( 'pageline_footer_section_3' ) || is_active_sidebar( 'pageline_footer_section_4' ) ) : ?>
		<footer class="nnc-footer">
			<div class="nnc-container">
				<div class="nnc-footer-box nnc-footer-column-n">
					<?php if( is_active_sidebar( 'pageline_footer_section_1' ) ) : ?>
						<div class="nnc-footer-block">
							<?php dynamic_sidebar( 'pageline_footer_section_1' )?>
						</div>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'pageline_footer_section_2' ) ) : ?>
						<div class="nnc-footer-block">
							<?php dynamic_sidebar( 'pageline_footer_section_2' )?>
						</div>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'pageline_footer_section_3' ) ) : ?>
						<div class="nnc-footer-block">
							<?php dynamic_sidebar( 'pageline_footer_section_3' )?>
						</div>
					<?php endif; ?>

					<?php if( is_active_sidebar( 'pageline_footer_section_4' ) ) : ?>
						<div class="nnc-footer-block">
							<?php dynamic_sidebar( 'pageline_footer_section_4' )?>
						</div>
					<?php endif; ?>
				</div> 
			</div>
		</footer>
	<?php endif;?>

	<?php do_action('pageline_footer_copyright'); ?>
	<!-- Footer-end -->

</div><!-- #page -->

<?php wp_footer(); ?>

<div class="nnc-scroll-top">
	<span class="nnc-scroll-top-inner"><i class="fa fa-angle-up"></i></span>
</div>

</body>
</html>
