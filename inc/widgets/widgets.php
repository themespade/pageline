<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pageline_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'pageline' ),
		'id'            => 'pageline_sidebar_right',
		'description'   => esc_html__( 'Add widgets in your right sidebar of  theme.', 'pageline' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'pageline' ),
		'id'            => 'pageline_sidebar_left',
		'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'pageline' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
  register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar First', 'pageline' ),
        'id'            => 'pageline_footer_section_1',
        'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'pageline' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
  ) );
  register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar Second', 'pageline' ),
        'id'            => 'pageline_footer_section_2',
        'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'pageline' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
  ) );
  register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar Third', 'pageline' ),
        'id'            => 'pageline_footer_section_3',
        'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'pageline' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
  ) );
  register_sidebar( array(
        'name'          => esc_html__( 'Footer Sidebar Fourth', 'pageline' ),
        'id'            => 'pageline_footer_section_4',
        'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'pageline' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
  ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front page builder', 'pageline' ),
		'id'            => 'pageline_frontpage_section',
		'description'   => esc_html__( 'Add widgets in your front page content area.', 'pageline' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

  register_widget( "Pageline_AboutUs_Widget" );
  register_widget( "Pageline_Services_Widget" );
  register_widget( "Pageline_Project_Widget" );
  register_widget( "Pageline_Funs_Widget" );
  register_widget( "Pageline_CTA_Widget" );
  register_widget( "Pageline_blogs_Widget" );
  register_widget( "Pageline_Contact_Widget" );
  register_widget( "Pageline_Testimonials_Widget" );
  
  
}
add_action( 'widgets_init', 'pageline_widgets_init' );

/********************************************************/
/**
 * Widget API: Pageline_AboutUs_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a About Us widget.
 *
 * @see WP_Widget
 */
class Pageline_AboutUs_Widget extends WP_Widget {

  /**
   * Sets up a new About Us widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops                     = array(
      'classname'                   => 'widget_about_us_block',
      'description'                 => esc_html__( 'Display about us details of page content.', 'pageline' ),
      'customize_selective_refresh' => true,
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: About Us', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current About Us widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current About Us widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title    = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text     = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id         = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $page_id         = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
    $content_display = isset( $instance['content_display'] ) ? $instance['content_display'] : '';

    // Custom query to get single page details.
    $get_page          = new WP_Query( array(
      'posts_per_page' => 1,
      'post_type'      => array('page'),
      'page_id'        => $page_id
    ) );
    echo $before_widget; ?>
    <!-- About-start -->
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-about">
      <div class="nnc-container">
      <?php if ( !empty( $widget_title ) || !empty( $text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_attr( $widget_title ).'<span></span></h2>';
          }
          if ( !empty( $widget_text ) ) {
            echo wpautop( esc_textarea( $widget_text ) );
          } ?>
        </div><!-- .nnc-title -->
      <?php endif; ?>

      <?php if ( !empty( $page_id ) ) : ?>
        <div class="nnc-about-content">
        <?php while ( $get_page->have_posts() ) : $get_page->the_post(); ?>
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="nnc-about-img">
              <?php the_post_thumbnail( 'pageline-about' ); ?>
            </div><!-- .nnc-about-img -->
          <?php endif; ?>
          <div class="nnc-about-desc">
            <h4><?php the_title(); ?></h4>
            <?php if ( $content_display == 'excerpt' ) {
              the_excerpt();
            } else {
              the_content();
            }?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'pageline' ); ?></a>
          </div><!-- .nnc-about-desc --> 
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        </div><!-- .nnc-about-content -->
      <?php endif; ?>
      </div><!-- .nnc-container -->
    </div><!-- .nnc-about -->
    <!-- About-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current About Us widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['menu_id']         = sanitize_text_field( $new_instance['menu_id'] );
    $instance['title']           = sanitize_text_field( $new_instance['title'] );
    $instance['page_id']         = absint( $new_instance['page_id'] );
    $instance['content_display'] = sanitize_text_field( $new_instance['content_display'] );
    if ( current_user_can('unfiltered_html') ){
      $instance['text']     =  $new_instance['text'];
      }
    else{
      $instance['text']     = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the About Us widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $instance        = wp_parse_args( (array) $instance, array('menu_id' => '','title' => '','text' => '','page_id' => '','content_display' => 'excerpt' ) );
    $menu_id         = $instance['menu_id'];
    $title           = $instance['title'];
    $text            = $instance['text'];
    $page_id         = $instance['page_id'];
    $content_display = $instance['content_display'];
    ?>
    <p><?php esc_html_e( 'Note: Enter the Section ID and use same for Menu item. Only used for One Page Menu.', 'pageline' ); ?></p>

    <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'About Us Menu ID:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('menu_id'); ?>" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr($menu_id); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><label for="<?php echo $this->get_field_id('page_id'); ?>"><?php esc_html_e( 'Page ', 'pageline' ); ?></label>
      <?php
      $arg         = array(
        'class'    => 'widefat',
        'name'     => $this->get_field_name('page_id'),
        'id'       => $this->get_field_id('page_id'),
        'selected' => absint( $page_id )
      );
      wp_dropdown_pages( $arg ); ?></p>

    <p><label for="<?php echo $this->get_field_id( 'content_display' ); ?>"><?php esc_html_e( 'Content Display:', 'pageline' ); ?></label>
      <input type="radio" <?php checked( $content_display, 'excerpt' ) ?> id="<?php echo $this->get_field_id('content_display'); ?>" class="widefat" name="<?php echo $this->get_field_name('content_display'); ?>" value="excerpt"/><?php esc_html_e( 'Excerpt', 'pageline' );?>
      <input type="radio" <?php checked( $content_display,'full' ) ?> id="<?php echo $this->get_field_id('content_display'); ?>" class="widefat" name="<?php echo $this->get_field_name('content_display'); ?>" value="full"/><?php esc_html_e( 'Full', 'pageline' );?></p>
    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_Services_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Services widget.
 *
 * @see WP_Widget
 */
class Pageline_Services_Widget extends WP_Widget {

  /**
   * Sets up a new Services widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname' => 'widget_services_block',
      'description' => esc_html__( 'Display details of page content as Services.', 'pageline' ),
      'customize_selective_refresh' => true,
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Services', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Services widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current Services widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id      = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $pages        = array();
    $font_icons   = array();
    for ($i=0; $i < 4; $i++) { 
      $pages[]      = isset( $instance['page_id_'.$i] ) ? $instance['page_id_'.$i] : '';
      $font_icons[] = isset( $instance['font_icon_'.$i] ) ? $instance['font_icon_'.$i] : '';
    }
    // Custom query to get selected pages details.
    $get_pages = new WP_Query( array(
      'posts_per_page' => -1,
      'post_type'      => array('page'),
      'post__in'       => $pages,
      'orderby'        => 'post__in'
    ) );
    echo $before_widget; ?>
    <!-- Services-start --> 
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-services">
      <div class="nnc-container">
        <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_html( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo wpautop( esc_textarea( $widget_text ) );
          }?>
        </div>
      <?php endif; ?>

      <?php if ( !empty( $pages ) ) : $key=0;?>
        <div class="nnc-service-box">
          <?php while ( $get_pages->have_posts() ) : $get_pages->the_post(); ?>
            <div class="nnc-service">
              <?php if( !empty ( $font_icons[$key] ) ) : ?>
                <div class="s-icon">
                  <i class="fa <?php echo esc_attr( $font_icons[$key] ); ?>"></i>
                </div>
              <?php endif; ?>
              <h4><?php the_title(); ?></h4>
              <p><?php echo wp_trim_words( get_the_content(),14 ) ; ?></p>
              <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'pageline' ); ?></a>
            </div>
          <?php $key++; endwhile;?>
          <?php wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>
      </div>  
    </div>
    <!-- Services-end -->
    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Services widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['menu_id']    = sanitize_text_field( $new_instance['menu_id'] );
    $instance['title']      = sanitize_text_field( $new_instance['title'] );
    for ($i=0; $i < 4; $i++) { 
      $instance['page_id_'.$i]   = absint( $new_instance['page_id_'.$i] );
      $instance['font_icon_'.$i] = sanitize_text_field( $new_instance['font_icon_'.$i] );
    }
    if ( current_user_can('unfiltered_html') ){
      $instance['text'] = $new_instance['text'];
      }
    else{
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the About Us widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $defaults            = array();
    $defaults['menu_id'] = '';
    $defaults['title']   = '';
    $defaults['text']    = '';
    for ($i=0; $i < 4 ; $i++) { 
      $defaults['page_id_'.$i]   = '';
      $defaults['font_icon_'.$i] = '';
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
    $menu_id = $instance['menu_id'];
    $title = $instance['title'];
    $text = $instance['text'];
    ?>
    <p><?php esc_html_e( 'Note: Enter the Section ID and use same for Menu item. Only used for One Page Menu.', 'pageline' ); ?></p>

    <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'Services Menu ID:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('menu_id'); ?>" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr($menu_id); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><?php $url = 'http://fontawesome.io/icons/';
      $link = sprintf( wp_kses( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'pageline' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
      echo $link;
      ?></p>

    <?php for ($i=0; $i < 4; $i++) : ?>
      <p><label for="<?php echo $this->get_field_id('page_id_'.$i); ?>"><?php esc_html_e( 'Page:', 'pageline' ); ?></label>
        <?php
        $arg = array(
          'class'            => 'widefat',
          'show_option_none' => esc_html__( '--- select ---', 'pageline' ),
          'name'             => $this->get_field_name('page_id_'.$i),
          'id'               => $this->get_field_id('page_id_'.$i),
          'selected'         => absint( $instance['page_id_'.$i] )
        );
        wp_dropdown_pages( $arg ); ?></p>

      <p><label for="<?php echo $this->get_field_id('font_icon_'.$i); ?>"><?php esc_html_e( 'Icon Class:', 'pageline' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('font_icon_'.$i); ?>" name="<?php echo $this->get_field_name('font_icon_'.$i); ?>" type="text" value="<?php echo esc_attr($instance['font_icon_'.$i]); ?>" /></p>

      <hr/>
    <?php endfor;
  }
}

/********************************************************/
/**
 * Widget API: Pageline_Project_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Projects widget.
 *
 * @see WP_Widget
 */
class Pageline_Project_Widget extends WP_Widget {

  /**
   * Sets up a new Projects widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname'                   => 'widget_projects_block',
      'description'                 => esc_html__( 'Display posts related to category as Projects.', 'pageline' ),
      'customize_selective_refresh' => true,
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Projects', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Projects widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current Projects widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id      = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $number       = empty( $instance['number'] ) ? 3 : $instance['number'];
    $category     = isset( $instance['category'] ) ? $instance['category'] : '';

    $get_featured_posts = new WP_Query( array(
      'posts_per_page' => absint( $number ),
      'post_type'      => 'post',
      'category__in'   => absint( $category )
      ) );
    echo $before_widget; ?>
    <!-- Portfolio-start -->
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-projects">
      <div class="nnc-container"> 
        <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_attr( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
          
        </div>
      <?php endif; ?>
      </div>
      <div class="nnc-list-project">
        <div class="nnc-container">
        <?php while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
          <div class="nnc-project"> 
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'pageline-project' ); ?>
            <?php endif; ?>
            <div class="nnc-dtl-hover">
              <div class="nnc-project-dtl">
                <div class="nnc-inside-dtl">
                  <h4><?php the_title(); ?></h4>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Project', 'pageline' ); ?></a>
                </div>
              </div>
            </div> 
          </div>
        <?php endwhile;?>
        <?php wp_reset_postdata(); ?> 
        </div> 
      </div>
    </div>
    <!-- Portfolio-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Projects widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']    = sanitize_text_field( $new_instance['title'] );
    $instance['menu_id']  = sanitize_text_field( $new_instance['menu_id'] );
    $instance['number']   = absint( $new_instance['number'] );
    $instance['category'] = absint( $new_instance['category'] );

    if ( current_user_can('unfiltered_html') ){
      $instance['text']   = $new_instance['text'];
      }
    else{
      $instance['text']   = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the Projects widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {

    $instance = wp_parse_args( (array) $instance, array('menu_id' => '', 'title' => '', 'text' => '', 'number' => '3', 'category' => '', 'btn_text' => '', 'btn_url' => '' ) );
    $menu_id  = $instance['menu_id'];
    $title    = $instance['title'];
    $text     = $instance['text'];
    $number   = $instance['number'];
    $category = $instance['category'];

    ?>
     <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'Project Menu ID:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('menu_id'); ?>" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr($menu_id); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts to show:', 'pageline' ); ?></label>
    <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo absint( $number ); ?>" size="3" /></p>

    <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Select category', 'pageline' ); ?>:</label>
      <?php wp_dropdown_categories(
        array(
          'class'    => 'widefat',
          'name'     => $this->get_field_name('category'),
          'selected' => absint( $category ) 
        ) 
      ); ?>
    </p>

    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_Funs_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Funs widget.
 *
 * @see WP_Widget
 */
class Pageline_Funs_Widget extends WP_Widget {

  /**
   * Sets up a new Funs widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname'                   => 'widget_funs_block',
      'description'                 => esc_html__( 'Display some cotent and numbers just for Funs.', 'pageline' ),
      'customize_selective_refresh' => true,
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Funs Widget', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Funs widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current About Us widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $funs_numbers = array();
    $funs_text    = array();
    $funs_icons   = array();
    for ($i=0; $i < 4; $i++) {
      $funs_numbers[] = isset( $instance['funs_num_'.$i] ) ? $instance['funs_num_'.$i] : '';
      $funs_text[]    = isset( $instance['funs_text_'.$i] ) ? $instance['funs_text_'.$i] : '';
      $funs_icons[]   = isset( $instance['funs_font_icon_'.$i] ) ? $instance['funs_font_icon_'.$i] : '';
     } 

    echo $before_widget; ?>
    <!-- Status-start -->
    <div id="" class="nnc-statuses">
      <div class="nnc-container"> 
        <?php if ( !empty( $widget_title ) || !empty( $text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_html( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
          
        </div>
      <?php endif; ?>
      <?php if ( !empty( $funs_numbers ) ) : ?>  
        <div class="nnc-status-block nnc-status-column-n">
        <?php for ($i=0; $i < 4; $i++) :
          if( $funs_numbers[$i] != '' ) : ?>
            <div class="nnc-status">
              <i class="fa <?php echo esc_attr( $funs_icons[$i] ); ?>"></i> <span class="counter"><?php echo absint( $funs_numbers[$i] ); ?></span>
              <p><?php if( isset( $funs_text[$i] ) ) { echo esc_html( $funs_text[$i] ) ;} ?></p>
            </div>
          <?php endif;
        endfor;
        ?>
        </div>
      <?php endif; ?>   
      </div>
    </div> 
    <!-- Status-end -->
    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Funs widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']                = sanitize_text_field( $new_instance['title'] );
    for ($i=0; $i < 4; $i++) { 
      $instance['funs_num_'.$i]       = absint( $new_instance['funs_num_'.$i] );
      $instance['funs_text_'.$i]      = sanitize_text_field( $new_instance['funs_text_'.$i] );
      $instance['funs_font_icon_'.$i] = sanitize_text_field( $new_instance['funs_font_icon_'.$i] );
    }
    if ( current_user_can('unfiltered_html') ){
      $instance['text'] = $new_instance['text'];
      }
    else{
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the Funs widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $defaults[]        = array();
    $defaults['title'] = '';
    $defaults['text']  = '';
    for ($i=0; $i < 4; $i++) {
      $defaults['funs_num_'.$i]       = '';
      $defaults['funs_text_'.$i]      = '';
      $defaults['funs_font_icon_'.$i] = '';
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
    $title    = $instance['title'];
    $text     = $instance['text'];
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><?php $url = 'http://fontawesome.io/icons/';
      $link = sprintf( wp_kses( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'pageline' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
      echo $link;
      ?></p>

    <?php for ($i=0; $i < 4; $i++) : ?>
      <p><label for="<?php echo $this->get_field_id('funs_num_'.$i); ?>"><?php esc_html_e( 'Funs Numbers:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('funs_num_'.$i); ?>" name="<?php echo $this->get_field_name('funs_num_'.$i); ?>" type="number" min="1" step="1" value="<?php echo absint($instance['funs_num_'.$i]); ?>" /></p>

      <p><label for="<?php echo $this->get_field_id('funs_text_'.$i); ?>"><?php esc_html_e( 'Funs Text:', 'pageline' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('funs_text_'.$i); ?>" name="<?php echo $this->get_field_name('funs_text_'.$i); ?>" type="text" value="<?php echo esc_attr($instance['funs_text_'.$i]); ?>" /></p>

      <p><label for="<?php echo $this->get_field_id('funs_font_icon_'.$i); ?>"><?php esc_html_e( 'Funs Font Icon:', 'pageline' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('funs_font_icon_'.$i); ?>" name="<?php echo $this->get_field_name('funs_font_icon_'.$i); ?>" type="text" value="<?php echo esc_attr($instance['funs_font_icon_'.$i]); ?>" /></p>
      <hr/>
    <?php endfor; ?>

    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_CTA_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a CTA widget.
 *
 * @see WP_Widget
 */
class Pageline_CTA_Widget extends WP_Widget {

  /**
   * Sets up a new CTA widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname'                   => 'widget_cta_block',
      'description'                 => esc_html__( 'Display title, description, image and buttons as call to action.', 'pageline' ),
      'customize_selective_refresh' => true
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Call Action Widget', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current CTA widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current CTA widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $button_text  = isset( $instance['btn_txt'] ) ? $instance['btn_txt'] : '';
    $button_url   = isset( $instance['btn_url'] ) ? $instance['btn_url'] : '';

    echo $before_widget; ?>

    <!-- CTA-start -->
    <section class="nnc-cta">
      <div class="nnc-container">
        <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-cta-block">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_html( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
          
        </div>
      <?php endif; ?>

      <?php if( !empty( $button_text ) ) : ?>
          <div class="nnc-dtl">
            <a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?></a>
          </div>
      <?php endif; ?>
      </div>
    </section>
    <!-- CTA-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current CTA widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']   = sanitize_text_field( $new_instance['title'] );
    $instance['btn_txt'] = sanitize_text_field( $new_instance['btn_txt'] );
    $instance['btn_url'] = esc_url_raw( $new_instance['btn_url'] );
    if ( current_user_can('unfiltered_html') )
      $instance['text']  = $new_instance['text'];
    else
      $instance['text']  = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the CTA widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {

    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'btn_txt' => '', 'btn_url' => '' ) );
    $title    = $instance['title'];
    $text     = $instance['text'];
    $btn_text = $instance['btn_txt'];
    $btn_link = $instance['btn_url'];
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><label for="<?php echo $this->get_field_id('btn_txt'); ?>"><?php esc_html_e( 'Button Text:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('btn_txt'); ?>" name="<?php echo $this->get_field_name('btn_txt'); ?>" type="text" value="<?php echo esc_attr($btn_text); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('btn_url'); ?>"><?php esc_html_e( 'Button URL:', 'pageline' );?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('btn_url'); ?>" name="<?php echo $this->get_field_name('btn_url'); ?>" type="text" value="<?php echo esc_url( $btn_link ); ?>" /></p>

    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_blogs_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Blog Posts widget.
 *
 * @see WP_Widget
 */
class Pageline_blogs_Widget extends WP_Widget {

  /**
   * Sets up a new Blog Posts widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops                     = array(
      'classname'                   => 'widget_blog_posts_block',
      'description'                 => esc_html__( 'Display blog posts.', 'pageline' ),
      'customize_selective_refresh' => true
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Blog Posts', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Blog Posts widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current Blog Posts widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id      = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $number       = empty( $instance['number'] ) ? 3 : $instance['number'];
    $type         = isset( $instance['type'] ) ? $instance['type'] : 'latest' ;
    $category     = isset( $instance['category'] ) ? $instance['category'] : '';

    if( $type == 'latest' ) {
      $get_featured_posts = new WP_Query(
        array(
          'posts_per_page'        => $number,
          'post_type'             => 'post',
          'ignore_sticky_posts'   => true,
          'no_found_rows'         => true
       ) );
    } else {
      $get_featured_posts = new WP_Query(
        array(
          'posts_per_page'        => $number,
          'post_type'             => 'post',
          'category__in'          => $category,
          'no_found_rows'         => true
       ) );
    }

    echo $before_widget; ?>

    <!-- Blogs-start --> 
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-blogs">
      <div class="nnc-container"> 
        <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_attr( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
        <?php endif; ?>  
        <div class="nnc-blog-news">

        <?php while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
          <div class="nnc-blog-block"> 
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="nnc-blog-img">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'pageline-blog-post' ); ?></a> 
                <div class="bg-black">
                <span><i class="fa fa-user"></i><?php echo esc_html( get_the_author() ); ?></span>
                  <?php
                  $time_string = '<span datetime="%1$s"><i class="fa fa-calendar"></i> %2$s</span>';
                  $time_string = printf( $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    esc_html( get_the_date( 'j F, Y' ) )
                    );
                  ?>
                </div>
              </div>
            <?php endif; ?>
            <div class="nnc-blog-desc">
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php the_excerpt(); ?>
            </div> 
          </div>
        <?php endwhile;?>
        <?php wp_reset_postdata(); ?>
           
        </div> 

      </div>
    </div>
    <!-- Blogs-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Blog Posts widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance             = $old_instance;
    $instance['title']    = sanitize_text_field( $new_instance['title'] );
    $instance['menu_id']  = sanitize_text_field( $new_instance['menu_id'] );
    $instance['number']   = absint( $new_instance['number'] );
    $instance['type']     = sanitize_key( $new_instance['type'] );
    $instance['category'] = absint( $new_instance['category'] );

    if ( current_user_can('unfiltered_html') )
      $instance['text']   = $new_instance['text'];
    else
      $instance['text']   = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the Blog Posts widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'menu_id' => '', 'title' => '', 'text' => '', 'number' => '3', 'type' => 'latest', 'category' => '', 'btn_txt' => '', 'btn_url' => '' ) );
    $title    = $instance['title'];
    $text     = $instance['text'];
    $menu_id  = $instance['menu_id'];
    $number   = $instance['number'];
    $type     = $instance['type'];
    $category = $instance['category'];

    ?>
    <p>
      <?php esc_html_e( 'Note: Enter the Section ID and use same for Menu item. Only used for One Page Menu.', 'pageline' ); ?>
    </p>

    <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'Section ID:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('menu_id'); ?>" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr($menu_id); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts to display:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" min="1" step="1" value="<?php echo absint($number); ?>" /></p>

    <p><input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'pageline' );?><br />
      <input type="radio" <?php checked( $type,'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'pageline' );?></p>

    <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Select category', 'pageline' ); ?>:</label>
      <?php wp_dropdown_categories(
        array(
          'class'    => 'widefat',
          'id'       => $this->get_field_id('category'),
          'name'     => $this->get_field_name('category'),
          'selected' => absint( $category ) 
        ) 
      ); ?> </p>

    <p><?php esc_html_e( 'Info: To display posts from specific category, select the Category in above radio option than select the category from the drop-down list.', 'pageline' ); ?></p>

    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_Contact_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Contact widget.
 *
 * @see WP_Widget
 */
class Pageline_Contact_Widget extends WP_Widget {

  /**
   * Sets up a new Contact widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname'                   => 'widget_contact_block',
      'description'                 => esc_html__( 'Display contact details.', 'pageline' ),
      'customize_selective_refresh' => true
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Contact Us', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Contact widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current Contact widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id      = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $phone_icon   = isset( $instance['phone_icon'] ) ? $instance['phone_icon'] : '';
    $phone_info   = isset( $instance['phone_info'] ) ? $instance['phone_info'] : '';
    $email_icon   = isset( $instance['email_icon'] ) ? $instance['email_icon'] : '';
    $email_info   = isset( $instance['email_info'] ) ? $instance['email_info'] : '';
    $address_icon = isset( $instance['address_icon'] ) ? $instance['address_icon'] : '';
    $address_info = isset( $instance['address_info'] ) ? $instance['address_info'] : '';
    $shortcode    = isset( $instance['shortcode'] ) ? $instance['shortcode'] : '';

    echo $before_widget; ?>
    <!-- Contact-start -->
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-about">
      <div class="nnc-container">
      <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_html( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
          
        </div>
      <?php endif; ?>

      <div class="nnc-contact-content">
        <div class="nnc-contact-info">
          <?php if ( !empty( $phone_info ) ) : ?>
            <div class="nnc-col-one-third">
              <i class="fa <?php echo esc_attr( $phone_icon ); ?>" aria-hidden="true"></i>
              <span><?php echo esc_html( $phone_info ); ?></span>
            </div>
          <?php endif; ?>

          <?php if ( !empty( $email_info ) ) : ?>
            <div class="nnc-col-one-third">
              <i class="fa <?php echo esc_attr( $email_icon ); ?>" aria-hidden="true"></i>
              <span><?php echo esc_url( $email_info ); ?></span>
            </div>
          <?php endif; ?>

          <?php if ( !empty( $address_info ) ) : ?>
            <div class="nnc-col-one-third">
              <i class="fa <?php echo esc_attr( $address_icon ); ?>" aria-hidden="true"></i>
              <span><?php echo esc_html( $address_info ); ?></span>
            </div>
          <?php endif; ?>
        </div>
        <?php if ( !empty( $shortcode ) ) : ?>
          <div class="nnc-contact-fields">
            <?php echo do_shortcode( $shortcode ); ?>
          </div>
        <?php endif; ?>
      </div>
      </div>
    </div>
    <!-- Contact-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Contact widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['menu_id']      = sanitize_text_field( $new_instance['menu_id'] );
    $instance['title']        = sanitize_text_field( $new_instance['title'] );
    $instance['phone_icon']   = sanitize_text_field( $new_instance['phone_icon'] );
    $instance['phone_info']   = sanitize_text_field( $new_instance['phone_info'] );
    $instance['email_icon']   = sanitize_text_field( $new_instance['email_icon'] );
    $instance['email_info']   = esc_url_raw( $new_instance['email_info'] );
    $instance['address_icon'] = sanitize_text_field( $new_instance['address_icon'] );
    $instance['address_info'] = sanitize_text_field( $new_instance['address_info'] );
    $instance['shortcode']    = strip_tags( $new_instance['shortcode'] );
    if ( current_user_can('unfiltered_html') ){
      $instance['text']      = $new_instance['text'];
      }
    else{
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the Contact widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $defaults[] = array();
    $defaults['menu_id']      = '';
    $defaults['title']        = '';
    $defaults['text']         = '';
    $defaults['phone_icon']   = '';
    $defaults['phone_info']   = '';
    $defaults['email_icon']   = '';
    $defaults['email_info']   = '';
    $defaults['address_icon'] = '';
    $defaults['address_info'] = '';
    $defaults['shortcode']    = '';
    $instance = wp_parse_args( (array) $instance, $defaults );
    $menu_id      = $instance['menu_id'];
    $title        = $instance['title'];
    $text         = $instance['text'];
    $phone_icon   = $instance['phone_icon'];
    $phone_info   = $instance['phone_info'];
    $email_icon   = $instance['email_icon'];
    $email_info   = $instance['email_info'];
    $address_icon = $instance['address_icon'];
    $address_info = $instance['address_info'];
    $shortcode    = $instance['shortcode'];
    ?>
    <p><?php esc_html_e( 'Note: Enter the Section ID and use same for Menu item. Only used for One Page Menu.', 'pageline' ); ?></p>

    <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'Section ID:', 'pageline' ); ?></label>
    <input id="<?php echo $this->get_field_id('menu_id'); ?>" class="widefat" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr( $menu_id ); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Content:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <p><label for="<?php echo $this->get_field_id('phone_icon'); ?>"><?php esc_html_e( 'Icon Class:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('phone_icon'); ?>" class="widefat" name="<?php echo $this->get_field_name('phone_icon'); ?>" type="text" value="<?php echo esc_attr( $phone_icon ); ?>" placeholder="fa-coffee"/></p>

    <p><label for="<?php echo $this->get_field_id('phone_info'); ?>"><?php esc_html_e( 'Contact Number:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('phone_info'); ?>" class="widefat" name="<?php echo $this->get_field_name('phone_info'); ?>" type="text" value="<?php echo esc_attr( $phone_info ); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('email_icon'); ?>"><?php esc_html_e( 'Icon Class:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('email_icon'); ?>" class="widefat" name="<?php echo $this->get_field_name('email_icon'); ?>" type="text" value="<?php echo esc_attr( $email_icon ); ?>" placeholder="fa-coffee"/></p>

    <p><label for="<?php echo $this->get_field_id('email_info'); ?>"><?php esc_html_e( 'Email Address:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('email_info'); ?>" class="widefat" name="<?php echo $this->get_field_name('email_info'); ?>" type="text" value="<?php echo esc_url( $email_info ); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('address_icon'); ?>"><?php esc_html_e( 'Icon Class:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('address_icon'); ?>" class="widefat" name="<?php echo $this->get_field_name('address_icon'); ?>" type="text" value="<?php echo esc_attr( $address_icon ); ?>" placeholder="fa-coffee"/></p>

    <p><label for="<?php echo $this->get_field_id('address_info'); ?>"><?php esc_html_e( 'Address Details:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('address_info'); ?>" class="widefat" name="<?php echo $this->get_field_name('address_info'); ?>" type="text" value="<?php echo esc_attr( $address_info ); ?>" /></p>

    <p>
    <?php
      $url = 'https://wordpress.org/plugins/contact-form-7/';
      $link = sprintf( wp_kses( __( '<a href="%s" target="_blank">Download Plugin</a> For Contact Form 7', 'pageline' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
      echo $link;
    ?></p>

    <p><label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php esc_html_e( 'Shortcode:', 'pageline' ); ?></label>
    <input type="text" id="<?php echo $this->get_field_id( 'shortcode' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" value="<?php echo esc_attr( $shortcode ); ?>"/></p>

    <?php
  }
}

/********************************************************/
/**
 * Widget API: Pageline_Testimonials_Widget class
 *
 * @package 99colorthemes
 * @subpackage PageLine
 * @since PageLine 1.0
 */

/**
 * Core class used to implement a Testimonials widget.
 *
 * @see WP_Widget
 */
class Pageline_Testimonials_Widget extends WP_Widget {

  /**
   * Sets up a new Testimonials widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops                     = array(
      'classname'                   => 'widget_testimonials_block',
      'description'                 => esc_html__( 'Display testimonials of page content.', 'pageline' ),
      'customize_selective_refresh' => true
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 
      false, 
      $name = esc_html__( 'NNC: Testimonials', 'pageline' ), 
      $widget_ops, 
      $control_ops
    );
  }

  /**
   * Outputs the content for the current Testimonials widget instance.
   *
   * @access public
   *
   * @param array $args Display arguments including 'before_title' and 'after_title'.
   * @param array $instance Settings for the current Testimonials widget instance.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    extract( $instance );
    $widget_title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '');
    $widget_text  = isset( $instance['text'] ) ? $instance['text'] : '';
    $menu_id      = isset( $instance['menu_id'] ) ? $instance['menu_id'] : '';
    $desc         = array();
    $name         = array();
    $tagby        = array();
    $image        = array();
    for ($i=0; $i<3; $i++) { 
      $desc[]  = isset( $instance['desc_'.$i] ) ? $instance['desc_'.$i] : '';
      $name[]  = isset( $instance['name_'.$i] ) ? $instance['name_'.$i] : '';
      $tagby[] = isset( $instance['tagby_'.$i] ) ? $instance['tagby_'.$i] : '';
      $image[] = isset( $instance['image_'.$i] ) ? $instance['image_'.$i] : '';
    }
    
    echo $before_widget; ?>
    <!-- Testimonials-start --> 
    <div id="<?php echo esc_attr( $menu_id ); ?>" class="nnc-testimonials">
      <div class="nnc-container">
        <?php if ( !empty( $widget_title ) || !empty( $widget_text ) ) : ?>
        <div class="nnc-title">
          <?php if ( !empty( $widget_title ) ) {
            echo '<h2>'.esc_attr( $widget_title ).'<span></span></h2>';
          }
          ?>
          <?php if ( !empty( $widget_text ) ) {
            echo '<p>'.esc_textarea( $widget_text ).'</p>';
          }?>
        </div>
      <?php endif; ?>

      <?php if ( !empty( $desc ) ) : ?>
        <div class="nnc-testimonial">
          <div class="owl-testimonial">
          <?php for ($i=0; $i<3; $i++) : ?>
            <div class="testimonial item">
              <?php if ( !empty( $desc[$i] ) || !empty( $tagby[$i] ) || !empty( $name[$i] ) ) : ?>
                <div class="nnc-dtl-info">
                  <?php if ( !empty( $desc[$i] ) ) { echo '<p>'.esc_textarea( $desc[$i] ).'</p>'; } ?>
                  <?php if ( !empty( $tagby[$i] ) ) { echo '<span>'.esc_attr( $tagby[$i] ).'</span>'; } ?>
                  <?php if ( !empty( $name[$i] ) ) { echo '<h4>'.esc_attr( $name[$i] ).'</h4>'; } ?>
                </div>
              <?php endif; ?>
                <?php if ( !empty( $image[$i] ) ) { echo '<div class="nnc-t-img"><img src='.esc_url( $image[$i] ).' alt='.esc_attr( $name[$i] ).'></div>'; } ?>
            </div>
          <?php endfor; ?>
        </div>
        </div>
      <?php endif; ?>
      </div>  
    </div>
    <!-- Testimonials-end -->

    <?php echo $after_widget;
  }

  /**
   * Handles updating settings for the current Testimonials widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Settings to save or bool false to cancel saving.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['menu_id']     = sanitize_text_field( $new_instance['menu_id'] );
    $instance['title']       = sanitize_text_field( $new_instance['title'] );
    for( $i=0; $i<3; $i++ ) {
      $instance['name_'.$i]  = sanitize_text_field( $new_instance['name_'.$i] );
      $instance['tagby_'.$i] = sanitize_text_field( $new_instance['tagby_'.$i] );
      $instance['image_'.$i] = esc_url_raw( $new_instance['image_'.$i] );
      if ( current_user_can('unfiltered_html') ){
        $instance['desc_'.$i] = $new_instance['desc_'.$i];
        }
      else{
        $instance['desc_'.$i] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['desc_'.$i] ) ) );
        }
        // wp_filter_post_kses() expects slashed
    }
    if ( current_user_can('unfiltered_html') ){
      $instance['text'] = $new_instance['text'];
      }
    else{
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
      }
      // wp_filter_post_kses() expects slashed
    return $instance;
  }

  /**
   * Outputs the Testimonials widget settings form.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $defaults[]              = array();
    $defaults['menu_id']     = '';
    $defaults['title']       = '';
    $defaults['text']        = '';
    for ($i=0; $i<3; $i++) { 
      $defaults['desc_'.$i]  = '';
      $defaults['name_'.$i]  = '';
      $defaults['tagby_'.$i] = '';
      $defaults['image_'.$i] = '';
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
    $menu_id  = $instance['menu_id'];
    $title    = $instance['title'];
    $text     = $instance['text'];
    ?>
    <p><?php esc_html_e( 'Note: Enter the Section ID and use same for Menu item. Only used for One Page Menu.', 'pageline' ); ?></p>

    <p><label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php esc_html_e( 'Section ID:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('menu_id'); ?>" class="widefat" name="<?php echo $this->get_field_name('menu_id'); ?>" type="text" value="<?php echo esc_attr( $menu_id ); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'pageline' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Description:', 'pageline' ); ?></label>
    <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>

    <?php for ($i=0; $i<3; $i++) :?>

      <p><label for="<?php echo $this->get_field_id('name_'.$i); ?>"><?php esc_html_e( 'Name:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('name_'.$i); ?>" class="widefat" name="<?php echo $this->get_field_name('name_'.$i); ?>" type="text" value="<?php echo esc_attr( $instance['name_'.$i] ); ?>" /></p>

      <p><label for="<?php echo $this->get_field_id('desc_'.$i); ?>"><?php esc_html_e( 'Words to Say:', 'pageline' ); ?></label>
      <textarea class="widefat" rows="7" cols="20" id="<?php echo $this->get_field_id('desc_'.$i); ?>" name="<?php echo $this->get_field_name('desc_'.$i); ?>"><?php echo esc_textarea( $instance['desc_'.$i] ); ?></textarea></p>

      <p><label for="<?php echo $this->get_field_id('tagby_'.$i); ?>"><?php esc_html_e( 'Tagby:', 'pageline' ); ?></label>
      <input id="<?php echo $this->get_field_id('tagby_'.$i); ?>" class="widefat" name="<?php echo $this->get_field_name('tagby_'.$i); ?>" type="text" value="<?php echo esc_attr( $instance['tagby_'.$i] ); ?>" /></p>

      <p><label for="<?php echo $this->get_field_id('image_'.$i); ?>"> <?php esc_html_e( 'Image:', 'pageline' );?></label> <br />
        <div class="media-uploader" id="<?php echo $this->get_field_id('image_'.$i); ?>">
          <div class="custom_media_preview">
             <?php if ( $instance['image_'.$i] != '' ) : ?>
                <img class="custom_media_preview_default" src="<?php echo $instance['image_'.$i]; ?>" style="max-width:100%;" />
             <?php endif; ?>
          </div>
          <input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id('image_'.$i); ?>" name="<?php echo $this->get_field_name('image_'.$i); ?>" value="<?php echo $instance['image_'.$i]; ?>" style="margin-top:5px;" />
          <button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id('image_'.$i); ?>" data-choose="<?php echo esc_attr( 'Choose an image', 'pageline' ); ?>" data-update="<?php echo esc_attr( 'Use image', 'pageline' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php echo esc_html( 'Select an Image', 'pageline' ); ?></button>
        </div></p>
      <hr/>

    <?php
    endfor;
  }
}
