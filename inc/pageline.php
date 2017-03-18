<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pageline_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Add class site layout style.
	if ( get_theme_mod ( 'pageline_site_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'wide';
	} else {
		$classes[] = 'box';
	}

	// Add a dynamic with slider active.
	$slide = 0;
	for( $i=1; $i<=4; $i++ ) {
		$page_id = get_theme_mod( 'pageline_slide'.$i );
		if ( !empty ( $page_id ) ) $slide++;
	}
	if(  ( ( $slide < 1 ) || get_theme_mod( 'pageline_slider_activation', 0 ) != 1 ) && is_front_page() && !is_home() ) {
		$classes[] = "no-slider";
	} else {
		$classes[] = "slider-active";
	}

	return $classes;
}
add_filter( 'body_class', 'pageline_body_classes' );

/*************************** HEADER LOGO **********************************/
if ( ! function_exists( 'pageline_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo Introduced in WordPress 4.5 .
 *
 * Does nothing if the custom logo is not available.
 *
 */
	function pageline_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

/******************************** FOOTER COPYRIGHT ***************************/
/**
 * function to show the footer info, copyright information
 */

function pageline_footer_copyright_info() {
	$site_link = '<a href="' . esc_url_raw( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';

	$tm_link =  '<a href="'. 'http://themespade.com/' .'" target="_blank" title="'.esc_attr__( 'ThemeSpade', 'pageline' ).'" rel="designer">'.esc_html__( 'ThemeSpade', 'pageline') .'</a>';

	$default_footer_value = '<p>'.sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'pageline' ), date_i18n( 'Y' ), $site_link ) . '</p><p>'. sprintf( esc_html__( 'Designed by %s.', 'pageline' ), $tm_link ).'</p>';

	$pageline_footer_copyright = '<div class="nnc-footer-bottom"><div class="nnc-container">'.$default_footer_value.'</div></div>';
	echo $pageline_footer_copyright;
}
add_action( 'pageline_footer_copyright', 'pageline_footer_copyright_info', 10 );


/********************************** SIDEBAR LAYOUT SELECTION *******************/
if ( ! function_exists( 'pageline_layout_class' ) ) :
/**
 * Generate layout class for sidebar based on customizer and post meta settings.
 */
function pageline_layout_class() {
    global $post;
    $layout = get_theme_mod( 'pageline_global_layout', 'right_sidebar' );

    // Get Layout meta
    if($post) {
        $layout_meta = get_post_meta( $post->ID, 'pageline_page_specific_layout', true );
    }
    // Home page if Posts page is assigned
    if( is_home() && !( is_front_page() ) ) {
        $queried_id = get_option( 'page_for_posts' );
        $layout_meta = get_post_meta( $queried_id, 'pageline_page_specific_layout', true );

        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $queried_id, 'pageline_page_specific_layout', true );
        }
    }
    elseif( is_page() ) {
        $layout = get_theme_mod( 'pageline_default_page_layout', 'right_sidebar' );
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'pageline_page_specific_layout', true );
        }
    }
    elseif( is_single() ) {
        $layout = get_theme_mod( 'pageline_default_single_post_layout', 'right_sidebar' );
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'pageline_page_specific_layout', true );
        }
    }
    return $layout;
}
endif;


if ( ! function_exists( 'pageline_sidebar_select' ) ) :
/**
 * Select and show sidebar based on post meta and customizer default settings
 */
function pageline_sidebar_select() {
    $layout = pageline_layout_class();
    if( $layout != "no_sidebar_full_width" &&  $layout != "no_sidebar_content_centered" ) {
        if ( $layout == "right_sidebar" ) {
            get_sidebar();
        } else {
            get_sidebar('left');
        }
    }
}
endif;

/******************************** POST-NAVIGATION *****************************************/
if ( ! function_exists( 'pageline_navigation' ) ) :
/**
 * Return the navigations.
 */
function pageline_navigation() {
    if( is_archive() || is_home() || is_search() ) {
    /**
     * Checking WP-PageNaviplugin exist
     */
    if ( function_exists('wp_pagenavi' ) ) :
      wp_pagenavi();
    else:
      global $wp_query;
      if ( $wp_query->max_num_pages > 1 ) :
      ?>
      <ul class="default-wp-page clearfix">
        <li class="previous"><?php previous_posts_link( esc_html__( '&larr; Previous', 'pageline' ) ); ?></li>
        <li class="next"><?php next_posts_link( esc_html__( 'Next &rarr;', 'pageline' ) ); ?></li>
      </ul>
      <?php
      endif;
    endif;
  }

  if ( is_single() ) {
    if( is_attachment() ) {
    ?>
      <ul class="default-wp-page clearfix">
        <li class="previous"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'pageline' ) ); ?></li>
        <li class="next"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'pageline' ) ); ?></li>
      </ul>
    <?php
    }
    else {
    ?>
      <ul class="default-wp-page clearfix">
        <li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . esc_html_x( '&larr; Previous Post', 'Previous post link', 'pageline' ) . '</span>' ); ?></li>
        <li class="next"><?php next_post_link( '%link', '<span class="meta-nav">' . esc_html_x( 'Next Post &rarr;', 'Next post link', 'pageline' ) . '</span>' ); ?></li>
      </ul>
    <?php
    }
  } 
}
endif;

/****************************** BREADCRUMBS ******************************************/
if ( ! function_exists( 'pageline_breadcrumbs' ) ) :
/**
 * Display Breadcrumbs
 *
 * This code is a modified version of Melissacabral's original menu code for dimox_breadcrumbs().
 *
 */
function pageline_breadcrumbs(){
  /* === OPTIONS === */
	$text['home']     = esc_html__('Home', 'pageline'); // text for the 'Home' link
	$text['category'] = esc_html__('Archive by Category "%s"', 'pageline'); // text for a category page
	$text['tax'] 	  = esc_html__('Archive for "%s"', 'pageline'); // text for a taxonomy page
	$text['search']   = esc_html__('Search Results for "%s" query', 'pageline'); // text for a search results page
	$text['tag']      = esc_html__('Posts Tagged "%s"', 'pageline'); // text for a tag page
	$text['author']   = esc_html__('Articles Posted by %s', 'pageline'); // text for an author page
	$text['404']      = esc_html__('Error 404', 'pageline'); // text for the 404 page
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = '&nbsp;&frasl;&nbsp;'; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$homeLink   = esc_url(home_url()) . '/';
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
	} else {
		echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;

		}elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo esc_html__( 'Page', 'pageline' ) . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div>';
	}
} // end pageline_breadcrumbs()
endif;

/******************************** EXCERPT LIMIT **********************************/
/**
 * Sets the post excerpt length to 35 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function pageline_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'pageline_excerpt_length' );

/************************************* EXCERPT COUTINEW READING *******************/
/**
 * Returns a "Continue Reading" link for excerpts
 */
function pageline_continue_reading() {
  return '';
}
add_filter( 'excerpt_more', 'pageline_continue_reading' );

/***************************************** REMOVE DEFAULT GALLERY **********************/
/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/******************************************* ADD GALLERY IMAGE SIZE *********************/
/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function pageline_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'medium',
	), $atts );
	$out['size'] = $atts['size'];
	return $out;
}
add_filter( 'shortcode_atts_gallery', 'pageline_gallery_atts', 10, 3 );

/********************************** COMMENT DISPLAY ****************************************/
if ( ! function_exists( 'pageline_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * 
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function pageline_comment( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_html_e( 'Pingback:', 'pageline' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'pageline' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo '<figure>'.esc_url( get_avatar( $comment, 74 ) ).'</figure>';
					echo '<div class="comment-meta-wrapper">';
					printf( '<div class="comment-author-link"><i class="fa fa-user" aria-hidden="true"></i> %1$s%2$s</div>',
						wp_kses( get_comment_author_link(), array( 'a'=> array( 'href' => array(), 'rel' => array(), 'class' => array() ) ) ),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'pageline' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time"><i class="fa fa-calendar-o" aria-hidden="true"></i> %1$s</div>',
						sprintf( __( '%1$s at %2$s', 'pageline' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) )
					);
					printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link aria-hidden="true""></i> Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
					echo '</div>';
				?>
			</header><!-- .comment-meta -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'pageline' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply-all" aria-hidden="true"></i> Reply', 'pageline' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function pageline_hex2rgb($hexstr) {
    $int = hexdec($hexstr);
    $rgb = array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
    $r = $rgb['red'];
    $g = $rgb['green'];
    $b = $rgb['blue'];

    return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function pageline_lightcolor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(+255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

add_action( 'wp_head', 'pageline_custom_css' );
/**
 * Hooks the Custom Internal CSS to head section
 */
function pageline_custom_css() {

	$primary_color   = esc_attr( get_theme_mod( 'pageline_primary_color', '#ff4a1c' ) );
	$primary_opacity = pageline_hex2rgb($primary_color);
	$primary_light    = pageline_lightcolor($primary_color, -20);

	$pageline_internal_css = '';
	if( $primary_color != '#00aced' ) {
		$pageline_internal_css = '.nnc-service .s-icon i,.nnc-inside-dtl h4,.nnc-footer-bottom p a,.nnc-status:hover i,.site-branding h1 a,.main-navigation li:hover > a, .main-navigation li.focus > a,.entry-meta span i,.entry-meta span a:hover,.entry-footer span i,.entry-footer span a:hover,h2.entry-title a:hover,.block span,h1.entry-title:hover,p.site-title a,.site-branding h1 a:hover,.nnc-sticky .main-navigation ul a:hover,.owl-prev i:hover,.owl-next i:hover,.nnc-service:hover a,.widget ul li a:hover,.block span a:visited:hover,.comment-author-link i,.comment-date-time i,.block span a:hover,.nnc-testimonials .testimonial .nnc-dtl-info span,a.post-edit-link:before,a.comment-permalink i,a.comment-edit-link:before,a.comment-edit-link:hover,p.logged-in-as a:hover,a.comment-permalink:hover,.comment-author-link a:hover,.has-post-thumbnail h1.entry-title:hover,figure.nnc-entry-image .nnc-img-hover i,.widget .search-form input[placeholder],.entry-content a,.textwidget p a,.search-form input[placeholder],.error-404 h1.page-title,span.error-404-num,.menu .page_item a.mPS2id-highlight,.nnc-sticky .menu .page_item a,.menu .page_item a,.nnc-sticky .main-navigation ul.menu a:hover,a._mPS2id-h.mPS2id-highlight.mPS2id-highlight-first.mPS2id-highlight-last,.search-icon i,.nnc-col-one-third i { color: '.$primary_opacity.' } .comment-form textarea:focus,.comment-form input:focus,.widget .search-form input:focus,.search-form input:focus,span.wpcf7-form-control-wrap input,span.wpcf7-form-control-wrap textarea { outline-color: ' .$primary_color. ' } .nnc-service:hover .s-icon,.nnc-service:hover a,.tagcloud a:hover,.main-navigation ul ul li:hover > a, .main-navigation ul ul li.focus > a,blockquote { border-color: '.$primary_color.'} .nnc-about-desc a:hover,.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span,.inner a:hover,.nnc-service:hover .s-icon,.nnc-service a:hover,.nnc-dtl a:hover,.nnc-view-all a:hover,.nnc-inside-dtl a:hover,.nnc-blog-block:hover,.nnc-scroll-top:hover,li.previous a:hover,li.next a:hover,input.submit:hover,span.read-more.pull-right:hover,.nnc-title h2 span:after,.nnc-testimonials .testimonial:hover .nnc-dtl-info,h4.widget-title:after,.tagcloud a:hover,a.comment-reply-link:hover,.nnc-header .search-form input,.comment-content a.comment-reply-link:hover,.nnc-blogs .nnc-view-all a:hover,h3.widget-title:after,.nnc-close-icon i,input.wpcf7-form-control.wpcf7-submit:hover,input.wpcf7-form-control.wpcf7-submit { background-color: '.$primary_color.'} .nnc-testimonials .testimonial:hover .nnc-dtl-info:after { border-top: 20px solid '.$primary_color.'}';
	}

	if( !empty( $pageline_internal_css ) ) {
	?>
		<style type="text/css"><?php echo $pageline_internal_css; ?></style>
	<?php
	}

	$pageline_custom_css = get_theme_mod( 'pageline_custom_css', '' );
	if( !empty( $pageline_custom_css ) ) {
		echo '<!-- '.get_bloginfo('name').' Custom Styles -->';
	?>
		<style type="text/css"><?php echo esc_html( $pageline_custom_css ); ?></style>
	<?php
	}
}

/** Plugin Install ***/
function pageline_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'page_title'                      => __( 'Install Required Plugins', 'pageline' ),
		'menu_title'                      => __( 'Install Plugins', 'pageline' ),
		'installing'                      => __( 'Installing Plugin: %s', 'pageline' ),
		'oops'                            => __( 'Something went wrong with the plugin API.', 'pageline' ),
		'notice_can_install_required'     => _n_noop(
			'This theme requires the following plugin: %1$s.',
			'This theme requires the following plugins: %1$s.',
			'pageline'
		),
		'notice_can_install_recommended'  => _n_noop(
			'This theme recommends the following plugin: %1$s.',
			'This theme recommends the following plugins: %1$s.',
			'pageline'
		),
		'notice_cannot_install'           => _n_noop(
			'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
			'pageline'
		),
		'notice_ask_to_update'            => _n_noop(
			'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
			'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
			'pageline'
		),
		'notice_ask_to_update_maybe'      => _n_noop(
			'There is an update available for: %1$s.',
			'There are updates available for the following plugins: %1$s.',
			'pageline'
		),
		'notice_cannot_update'            => _n_noop(
			'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
			'pageline'
		),
		'notice_can_activate_required'    => _n_noop(
			'The following required plugin is currently inactive: %1$s.',
			'The following required plugins are currently inactive: %1$s.',
			'pageline'
		),
		'notice_can_activate_recommended' => _n_noop(
			'The following recommended plugin is currently inactive: %1$s.',
			'The following recommended plugins are currently inactive: %1$s.',
			'pageline'
		),
		'notice_cannot_activate'          => _n_noop(
			'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
			'pageline'
		),
		'install_link'                    => _n_noop(
			'Begin installing plugin',
			'Begin installing plugins',
			'pageline'
		),
		'update_link'                     => _n_noop(
			'Begin updating plugin',
			'Begin updating plugins',
			'pageline'
		),
		'activate_link'                   => _n_noop(
			'Begin activating plugin',
			'Begin activating plugins',
			'pageline'
		),
		'return'                          => __( 'Return to Required Plugins Installer', 'pageline' ),
		'dashboard'                       => __( 'Return to the dashboard', 'pageline' ),
		'plugin_activated'                => __( 'Plugin activated successfully.', 'pageline' ),
		'activated_successfully'          => __( 'The following plugin was activated successfully:', 'pageline' ),
		'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'pageline' ),
		'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'pageline' ),
		'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'pageline' ),
		'dismiss'                         => __( 'Dismiss this notice', 'pageline' ),
		'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'pageline' ),
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'pageline_required_plugins' );