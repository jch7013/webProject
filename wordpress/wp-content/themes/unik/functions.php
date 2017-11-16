<?php
add_action( 'after_setup_theme', 'unik_setup' ); 	
function unik_setup()
{	
	global $content_width;
	//content width
	if ( ! isset( $content_width ) ) $content_width = 630; //px
	
	load_theme_textdomain( 'unik', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' ); //supports featured image
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 200,
	'flex-width' => true,
) );
}

add_action('wp_enqueue_scripts', 'unik_style');

function unik_style(){
	wp_enqueue_style('bootstrap',get_stylesheet_directory_uri(). '/css/bootstrap/bootstrap.min.css');
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri(). '/css/font-awesome.min.css');
	wp_enqueue_style('unik-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans|Prompt');
	wp_enqueue_style('unik-theme-style', get_stylesheet_directory_uri(). '/style.css');
	wp_enqueue_style('unik-theme-media', get_stylesheet_directory_uri(). '/css/media.css');
	
	//js 
	wp_enqueue_script('bootstrap', get_stylesheet_directory_uri(). '/css/bootstrap/bootstrap.min.js', array('jquery'));
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}
add_action('wp_footer','unik_footer_scripts');

function unik_footer_scripts(){
	wp_enqueue_script('unik-main-js', get_stylesheet_directory_uri(). '/js/script.js');
}
 
 //including customizer
require( get_template_directory().'/customizer.php');
add_action( 'wp_head', 'unik_color_css',999);
function unik_color_css(){ 
	$wl_theme_options = get_theme_mod('unik_options');

	if($wl_theme_options['site_color']!=''){
	$color= $wl_theme_options['site_color'];
	}else{
	$color ='#0098ff'; 
	} ?>
	<style>
	<?php if(isset($wl_theme_options['breadcrump_bg']) && $wl_theme_options['breadcrump_bg']!=''){ ?>
	.breadcum_bg {
	 background-image: url(<?php echo esc_url($wl_theme_options['breadcrump_bg']); ?>) !important;
	}
	<?php } if(isset($wl_theme_options['site_bg']) && $wl_theme_options['site_bg']!=''){ ?>
	.w_blog, .main_page, .educa-error {
		background: url(<?php echo esc_url($wl_theme_options['site_bg']); ?>) fixed !important;
	}
	<?php } ?>
.menu.navbar-default .navbar-nav > .open > a,
.menu.navbar-default .navbar-nav > .open > a:focus,
.menu.navbar-default .navbar-nav > .open > a:hover,
.menu.navbar-default .navbar-nav  a:hover{
color: <?php echo esc_html( $color ); ?> !important;
}
.menu.navbar-default .navbar-nav > .active > a,
.menu.navbar-default .navbar-nav > .active > a:focus,
.menu.navbar-default .navbar-nav > .active > a:hover{
color: <?php echo esc_html( $color ); ?> !important;
}
.menu.navbar-default .navbar-nav > .open > a,
.menu.navbar-default .navbar-nav > .open > a:focus,
.menu.navbar-default .navbar-nav > .open > a:hover,
.menu.navbar-default .navbar-nav  a:hover{
color: <?php echo esc_html( $color ); ?> !important;
}
.slider-text p  a{
color: <?php echo esc_html( $color ); ?>;
}
.carousel-caption .btn {
background-color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.swiper-pagination-bullet-active {
background: <?php echo esc_html( $color ); ?>;
}
.w_blogs_post_desc {
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.post-info li i{
color:<?php echo esc_html( $color ); ?>;
}
.w_blogs_post_desc .btn {
color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.w_blogs_post_desc .btn:hover {
border: 1px solid <?php echo esc_html( $color ); ?>;
background-color:<?php echo esc_html( $color ); ?>;
}
.widget-text .f_help li::before {
color: <?php echo esc_html( $color ); ?>;
}
.widget-text .tags li a:hover{
background-color:<?php echo esc_html( $color ); ?>;
}
.footer-copy a,.footer-copy a:hover{
color:<?php echo esc_html( $color ); ?>;
}
.widget_contact .post-text:hover  p a{
color: <?php echo esc_html( $color ); ?>;
}
.back-to-top i {
background-color: <?php echo esc_html( $color ); ?>;
}
.w_sidebar {
border: 1px solid <?php echo esc_html( $color ); ?> ;
}
.w_sidebar .btn-search {
background-color: <?php echo esc_html( $color ); ?>  !important;
}
.w_sidebar li::before {
color: <?php echo esc_html( $color ); ?> ;
}
.w_sidebar h2 {
background-color: <?php echo esc_html( $color ); ?> ;
}
.w_sidebar .tags li  a{
border:1px solid <?php echo esc_html( $color ); ?> ;
}
.w_sidebar .tags li  a:hover{
background-color:<?php echo esc_html( $color ); ?> ;
}
.footer-widget #footer-subscribe-btn {
background: <?php echo esc_html( $color ); ?>;
border: 2px solid <?php echo esc_html( $color ); ?>;
}
.w_subject .w_ser .icon {
color: <?php echo esc_html( $color ); ?>;
}
.w_subject.subject-single h3 {
color: <?php echo esc_html( $color ); ?>;
}
.w_blog_btn ul li a {
border: 1px solid <?php echo esc_html( $color ); ?>;
color: <?php echo esc_html( $color ); ?>;
}
.w_blog_btn ul li a:hover{
border: 1px solid <?php echo esc_html( $color ); ?>;
 background-color: <?php echo esc_html( $color ); ?>;
}
.w_chapter .w_ser .tags  li a:hover {
color: <?php echo esc_html( $color ); ?>;
}
.w_chapter .w_ser .cat  li a:hover {
color: <?php echo esc_html( $color ); ?>;
}
.w_chapter .w_ser_text .button {
background-color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.w_chapter .dropcaps .first {
color: <?php echo esc_html( $color ); ?>;
}
.w_blog_pagination .next a,
.w_blog_pagination .previous a {
background-color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.pager li a:focus,
.pager li a:hover {
color:<?php echo esc_html( $color ); ?>;
}
.educa-error p.text-number {
color: <?php echo esc_html( $color ); ?>;
border-bottom: 2px dashed <?php echo esc_html( $color ); ?>;
}
.educa-error .error-text a.btn {
background-color: <?php echo esc_html( $color ); ?>;
}
.w_post_desc h2 a {
color: <?php echo esc_html( $color ); ?>;
}
.w_post_desc  span i {
color: <?php echo esc_html( $color ); ?>;
}
.w_blog_post  .post-cat a {
color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.blog-post-pagination .next a,
.blog-post-pagination .previous a {
background-color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.blog-post-pagination .pager li a:focus,
.blog-post-pagination .pager li a:hover {
color:<?php echo esc_html( $color ); ?>;
}
.fixed-pagination .page .arrow {
background-color: <?php echo esc_html( $color ); ?>;
}
.fixed-pagination .page .content {
color:<?php echo esc_html( $color ); ?>;
border:1px solid <?php echo esc_html( $color ); ?>;
}
.comment-respond .btn{
background-color:<?php echo esc_html( $color ); ?>;
}
.blog-post-other h2 a {
color: <?php echo esc_html( $color ); ?>;
}
.blog-post-chapter .w_post_desc p  a{
color: <?php echo esc_html( $color ); ?>;
}
.w_toggle_type1 p, .w_toggle_type2 p {
background-color: <?php echo esc_html( $color ); ?>;
}
.table  th {
background-color: <?php echo esc_html( $color ); ?>;
}
.w_blog_post .img-thumbnail .overlay .icon{
border:1px solid <?php echo esc_html( $color ); ?>;
color:<?php echo esc_html( $color ); ?>;
}
.w_post_desc h2 a {
color: <?php echo esc_html( $color ); ?>;
}
.w_post_desc  span i {
color: <?php echo esc_html( $color ); ?>;
}
.w_post_desc .tags  li a {
color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.w_post_desc  .cat  li a {
color: <?php echo esc_html( $color ); ?>;
border: 1px solid <?php echo esc_html( $color ); ?>;
}
.w_home_chapter h1.heading  a{
    background-color: <?php echo esc_html( $color ); ?>;
}
.w_home_chapter h1.heading{
	border-bottom: 2px solid <?php echo esc_html( $color ); ?>;
}
.back-to-top i {
background-color: <?php echo esc_html( $color ); ?>;
}
#typed{
	color:<?php echo esc_html( $color ); ?>;
}
.footer-widget a, .footer-widget a:hover,#respond a,#respond a:hover {
	color:<?php echo esc_html( $color ); ?>;
}
.contact1 .btn {
  border: 1px solid <?php echo esc_html( $color ); ?>;
}
.contact1 .btn:hover {
  background-color: <?php echo esc_html( $color ); ?>;
}
.contact1-details .social li:hover {
background-color:<?php echo esc_html( $color ); ?>;
  border: 1px solid <?php echo esc_html( $color ); ?>;
}
.contact1-details   .social:hover h3 {
    color:<?php echo esc_html( $color ); ?>;
}
.edu-data a{
   color:<?php echo esc_html( $color ); ?>;
  }
 .edu-data .topic_link{
  color:#000;
  }
  .cat_post .w_post_desc {
    border: 1px solid <?php echo esc_html( $color ); ?>;
}
</style>
<?php }

add_action( 'init', 'unik_menu' );
//Register area for custom menu
function unik_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu','unik' ) );
}
	
// for menu
function unik_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'unik_page_menu_args' );

 
function unik_fallback_page_menu( $args = array() ) {

	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home','unik');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' .   esc_url( home_url('/')) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new unik_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = '<div class="' . esc_attr($args['container_class']) . '">' . $menu . "</div>\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class unik_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='dropdown-menu'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}
}

/** nav-menu-walker.php */
class unik_nav_walker extends Walker_Nav_Menu {	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if(array_search("current-menu-item",$classes) || array_search("current-menu-ancestor",$classes)){
			$active_item= 1;
		}
		if ($args->has_children && $depth > 0) {
			$classes[] = 'dropdown dropdown-submenu';
		} else if($args->has_children && $depth === 0) {
			$classes[] = 'dropdown main-menu';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		if(isset($active_item)){
		$attributes .= ' class="active-menu-item"';
		}
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '<i class="fa fa-angle-down"></i></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}
}
function unik_nav_menu_css_class( $classes ) {
	if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) ){
		$classes[]	=	'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'unik_nav_menu_css_class' );

function unik_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="center blog-pagination "><ul class="pagination">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( __('Old Posts','unik')) );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( __('Next Posts','unik')) );

	echo '</ul></div>' . "\n";

}

function unik_navigation_posts() { ?>
<div class="row blog-post-pagination">
	<ul class="pager">
	<li class="next">
	<?php previous_post_link('%link', '%title', TRUE, ' '); ?>
	</li>
	<li class="previous">
	<?php next_post_link( '%link', '%title', TRUE, ' '); ?>
	</li>
	</ul>
	</div>	
<?php 
}
	
// comment function
if ( ! function_exists( 'unik_theme_comment' ) ) :
function unik_theme_comment($comment, $args, $depth){
$GLOBALS['comment'] = $comment;
	//get theme data
	global $comment_data;
	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','unik'); ?>
    <div class="col-xs-12 comment-detail">
		<div class="col-xs-2 comments-pics">
			<?php echo get_avatar($comment,$size = '100'); ?>
		</div>
		<div class="col-xs-10 comments-text">
			<span><?php if ( ('d M  y') == get_option( 'date_format' ) ) : ?>				
				<?php comment_date('F j, Y');?>
				<?php else : ?>
				<?php comment_date(); ?><?php _e('at','unik');?>&nbsp;<?php comment_time('g:i a'); ?>
				<?php endif; ?></span> <?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			<h3><?php comment_author();?></h3>
			<p><?php comment_text() ; ?></p>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'unik' ); ?></em>
				<?php endif; ?>
		</div>
	</div>
<?php
}
endif;

// widgets function
function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __('Sidebar Widget Area','unik'),
		'id'            => 'theme_sidebar_widget',
		'before_widget' => '<div class="row w_sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __('Sidebar Widget Area For Page','unik'),
		'id'            => 'theme_sidebar_page',
		'before_widget' => '<div class="row w_sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __('Footer Widget Area','unik'),
		'id'            => 'theme_footer_widget',
		'before_widget' => '<div class="col-md-3 col-sm-6 footer-widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="col-md-12 widget-heading"><h1>',
		'after_title'   => '</h1></div><div class="col-md-12 widget-text">',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

//breadcrums
function unik_breadcrumbs() {
    $delimiter = '';
    $home = __('Home', 'unik' ); // text for the 'Home' link
    $before = '<li>'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb
    echo '<ul>';
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before .__("Archive by category","unik") .' '. single_cat_title('', false) . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
		if(get_the_category_list() != '') { ?>
			<li><?php the_category(' '); ?> </li>
		<?php }
            echo $before . get_the_title() . $after;
        }
		
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for: ','unik')  . get_search_query()  . $after;

    } elseif (is_tag()) {        
		echo $before . __('Tag: ','unik') . single_tag_title('', false) . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __("Articles posted by: ","unik") . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . __("Error 404","unik") . $after;
    }
    echo '</ul>';
	}

?>