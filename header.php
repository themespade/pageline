<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'pageline_before' ); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'pageline' ); ?></a>
	<?php do_action( 'pageline_before_header' ); ?>
	<!-- header-start --> 
	<?php if ( is_front_page() && !is_home() ) { $header_class = 'site-header'; } else { $header_class = 'site-header sh-2'; } ?>
	<header role="banner" class="<?php echo esc_attr( $header_class ); ?>" id="masthead"> 
		<div class="nnc-header">
			<div class="nnc-container">
				<div class="site-branding">

					<div class="header-logo">
						<?php if( ( get_theme_mod( 'pageline_header_logo_placement', 'header_text_only' ) == 'show_both' || get_theme_mod( 'pageline_header_logo_placement', 'header_text_only' ) == 'header_logo_only' ) && has_custom_logo() ) : ?>
							<div class="logo">
								<?php pageline_the_custom_logo(); ?>
							</div><!-- .logo-->
							<?php
						 endif; ?>
					</div><!-- .header-logo -->
					<?php 
					$logo_only =get_theme_mod( 'pageline_header_logo_placement', 'header_text_only' );
					if($logo_only != 'header_logo_only'){ ?>
						 <div id="header-text">
								<?php
								if ( is_front_page() || is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
								<?php
								endif; ?>
							</div>
					<?php }?>

					
				</div><!-- .site-branding -->

				<div class="nnc-search">
					<div class="search-icon"><i class="fa fa-search"></i></div>
					<div class="s-form">
						<?php get_search_form(); ?>
					</div>
				</div><!-- .nnc-search -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="menu-main-menu-container">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'menu' ) ); ?>
					</div>	
				</nav><!-- #site-navigation -->

				<div class="ts-nav-icon"><i class="fa fa-navicon"></i></div>
			</div>
		</div> 
	</header>
	<!-- header-end -->
	<?php do_action( 'pageline_after_header' ); ?>
	<?php
	if( get_theme_mod( 'pageline_slider_activation' ) == '1' && is_front_page() && !is_home() ){
		get_template_part( 'template-parts/content', 'slider' );
	}
	?>
	<?php do_action( 'pageline_before_main' ); ?>
