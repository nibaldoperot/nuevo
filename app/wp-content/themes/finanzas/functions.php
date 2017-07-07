<?php
/**
 * MVPWP functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MVPWP
 */

if ( ! function_exists( 'mvpwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mvpwp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MVPWP, use a find and replace
	 * to change 'mvpwp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mvpwp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mvpwp' ),
    'footer' => esc_html__( 'Footer', 'mvpwp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

  // Add logo upload in customizer WordPress 4.5+
  add_theme_support( 'custom-logo' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mvpwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	
}
endif;
add_action( 'after_setup_theme', 'mvpwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mvpwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mvpwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'mvpwp_content_width', 0 );

function jsfromgulp(){
	wp_enqueue_script( 'finanzas', get_theme_file_uri( '/js/finanzas.min.js' ), array('jquery'), '1.0.0', false );
	wp_script_add_data( 'finanzas', 'conditional', '' );
}

add_action('init', 'jsfromgulp');

//Agrergo JQueryUI despues de Jquery
function jqueryUI(){
	wp_enqueue_script( 'jquery-ui','https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.0.0', false );
	wp_script_add_data( 'jquery-ui', 'conditional', '' );
}

add_action('init', 'jqueryUI');

if ( !function_exists( 'mvpwp_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function mvpwp_the_custom_logo() {
    // Try to retrieve the Custom Logo
    $output = '';
    if (function_exists('get_custom_logo'))
        $output = get_custom_logo();

    // Nothing in the output: Custom Logo is not supported, or there is no selected logo
    // In both cases we display the site's name
    if (empty($output))
        $output = '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';

    echo $output;
}
endif;

/**
 * Read more link
 */
function modify_read_more_link() {
  return '<div class="more-link">
            <a class="btn btn-default" href="' . get_permalink() . '">Read More</a>
          </div>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 * Editing the Tag Widget
 */
function my_widget_tag_cloud_args( $args ) {
  $args['largest'] = 11;
  $args['smallest'] = 11;
  $args['unit'] = 'px';
  return $args;
}
add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );


/*********************************************************************************************/
// Our custom post type function
function create_posttype() {

	register_post_type( 'Facturas',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Facturas' ),
				'singular_name' => __( 'Factura' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Facturas'),
		)
	);


	register_post_type( 'Boletas',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Boletas' ),
				'singular_name' => __( 'Boleta' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Boletas'),
		)
	);

	register_post_type( 'Campanas',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Campanas' ),
				'singular_name' => __( 'Campana' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Campanas'),
		)
	);

	register_post_type( 'Participantes',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Participantes' ),
				'singular_name' => __( 'Participante' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Participantes'),
		)
	);

}
// Hooking up our function to theme setup 
add_action( 'init', 'create_posttype' );


add_filter('acf/load_field/name=user_groups', 'populateUserGroups');

function populateUserGroups( $field )
{	
	// reset choices
	$field['choices'] = array();
	
	$users = get_users();
	
	foreach ($users as $user) {
		$field['choices'][ $user->ID ] = $user->display_name;
	}

	return $field;
}

//Remove admin bar from user externo (upper menu)
function my_admin_bar_render() {
	$user = wp_get_current_user();
	if ( in_array( 'usuario_externo', (array) $user->roles ) || in_array( 'usuario_interno', (array) $user->roles ) ) {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('user-info');
		$wp_admin_bar->remove_menu('edit-profile');
		$wp_admin_bar->remove_menu('bar-archive');
		//The user has the "author" role
	}
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );


//Remove admin menu bar to user externo (side menu)
function remove_menus(){
  	$user = wp_get_current_user();
	if ( in_array( 'usuario_externo', (array) $user->roles ) || in_array( 'usuario_interno', (array) $user->roles ) ) {
  		remove_menu_page( 'index.php' );                  //Dashboard
  		remove_menu_page( 'jetpack' );                    //Jetpack* 
  		remove_menu_page( 'edit.php' );                   //Posts
  		remove_menu_page( 'upload.php' );                 //Media
  		remove_menu_page( 'edit.php?post_type=page' );    //Pages
  		remove_menu_page( 'edit-comments.php' );          //Comments
  		remove_menu_page( 'themes.php' );                 //Appearance
  		remove_menu_page( 'plugins.php' );                //Plugins
  		remove_menu_page( 'users.php' );                  //Users
  		remove_menu_page( 'tools.php' );                  //Tools
  		remove_menu_page( 'options-general.php' );        //Settings
	}
}
add_action( 'admin_menu', 'remove_menus' );

//change Howdy
function change_howdy( $wp_admin_bar ) {
	$user = wp_get_current_user();
	if ( in_array( 'usuario_externo', (array) $user->roles ) || in_array( 'usuario_interno', (array) $user->roles ) ) {
		$my_account = $wp_admin_bar->get_node( 'my-account' );
		$new_title   = str_replace( 'Howdy,', '', $my_account->title );
		$wp_admin_bar->add_node( array(
			'id'    => 'my-account',
			'title' => $new_title,
		) );
	}
}
add_filter( 'admin_bar_menu', 'change_howdy', 25 );

//redirect on login
function admin_default_page() {
  return admin_url( 'edit.php?post_type=facturas');
}

add_filter('login_redirect', 'admin_default_page');

//Change text Add Media
function rename_media_button( $translation, $text ) {
    if( is_admin() && 'Add Media' === $text ) {
        return 'Agregar Documento';
    }
    return $translation;
}
add_filter( 'gettext', 'rename_media_button', 10, 2 );

//Change text Submit for Review
function rename_submit( $translation, $text ) {
    if( is_admin() && 'Submit for Review' === $text ) {
        return 'Subir Documento';
    }
    return $translation;
}
add_filter( 'gettext', 'rename_submit', 10, 2 );

//Change text Add New Post
function rename_agregar( $translation, $text ) {
    if( is_admin() && 'Add New Post' === $text ) {
        return 'Agregar Boleta/Factura';
    }
    return $translation;
}
add_filter( 'gettext', 'rename_agregar', 10, 2 );

function rename_placeholder_titulo( $translation, $text ) {
    if( is_admin() && 'Introduce el título aquí' === $text ) {
        return 'Agregar Boleta/Factura';
    }
    return $translation;
}
add_filter( 'gettext', 'rename_placeholder_titulo', 10, 2 );


function wpfstop_change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'boletas' == $screen->post_type || 'facturas' == $screen->post_type ){
        $title = 'Título de Boleta/Factura';
    }
    return $title;
}


add_filter( 'enter_title_here', 'wpfstop_change_default_title' );


function remove_screen_options($display_boolean, $wp_screen_object){
  $blacklist = array('post.php', 'post-new.php', 'index.php', 'edit.php');
  if (in_array($GLOBALS['pagenow'], $blacklist)) {
    $wp_screen_object->render_screen_layout();
    $wp_screen_object->render_per_page_options();
    return false;
  } else {
    return true;
  }
}
add_filter('screen_options_show_screen', 'remove_screen_options', 10, 2);


function my_remove_meta_boxes() {
	//if ( ! current_user_can( 'manage_options' ) ) {
		remove_meta_box( 'linktargetdiv', 'link', 'normal' );
		remove_meta_box( 'linkxfndiv', 'link', 'normal' );
		remove_meta_box( 'linkadvanceddiv', 'link', 'normal' );
		remove_meta_box( 'postexcerpt', 'post', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
		remove_meta_box( 'postcustom', 'post', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
		remove_meta_box( 'commentsdiv', 'post', 'normal' );
		remove_meta_box( 'revisionsdiv', 'post', 'normal' );
		remove_meta_box( 'authordiv', 'post', 'normal' );
		remove_meta_box( 'sqpt-meta-tags', 'post', 'normal' );
	//}
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );

function theme_styles()  
{ 
	wp_register_style( 'finanzascss', get_template_directory_uri() . '/css/finanzas.min.css' );
	wp_enqueue_style('finanzascss');

}
add_action('wp_enqueue_scripts', 'theme_styles');

function JqueryUiCss()  
{ 
	wp_register_style( 'jqueryui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	wp_enqueue_style('jqueryui');
	//Validación de formulario JQuery para generar nuevo post desde vista
	// custom jquery
	wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
	wp_enqueue_script( 'custom_js' );
	
	// validation
	wp_register_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'validation' );

}
add_action('wp_enqueue_scripts', 'JqueryUiCss');

//Ajax Cambio de estado de Pago
function update_pago() {

	$post_id = $_POST['post_id'];
	$status = $_POST['status'];
	$tipo = $_POST['tipo'];
	if($tipo == 'factura'){
		update_field('pago_factura', $status, $post_id);
		
	}
	if($tipo == 'boleta'){
		update_field('pago_boleta', $status, $post_id);
	}
}
add_action( 'wp_ajax_nopriv_update_pago',  'update_pago' );
add_action( 'wp_ajax_update_pago','update_pago' );





/*********************************************************************************************/

/**
 * Add scripts
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Add widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Bootstrap Walker Menu
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

/**
 * Comments
 */
require get_template_directory() . '/inc/comments-callback.php';

/**
 * Include Kirki
 */
require get_template_directory() . '/inc/include-kirki.php';
require get_template_directory() . '/inc/mvpwp-kirki.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widget - Post Thumnail
 */
require get_template_directory() . '/inc/widget-post-thumbnails.php';
