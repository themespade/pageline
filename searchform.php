<?php
/**
 * The template for displaying search forms in PageLine.
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form">
		<div class="nnc-close-icon"><i class="fa fa-close"></i></div>
		<input type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pageline' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</div> 
</form> 