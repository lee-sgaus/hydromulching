<?php
/**
 * Incubator functions file
 *
 * @package incubator
 * by KeyDesign
 */

 add_action( 'wp_enqueue_scripts', 'kd_enqueue_parent_theme_style', 5 );

 if ( ! function_exists( 'kd_enqueue_parent_theme_style' ) ) {
     /**
      * enqueue the parent css file
      */
     function kd_enqueue_parent_theme_style() {

         wp_enqueue_style( 'bootstrap' );
         wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );
         wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
     }
 }

 add_action( 'after_setup_theme', 'kd_child_theme_setup' );

 if ( ! function_exists( 'kd_child_theme_setup' ) ) {
     /**
      * load child language files
      */
     function kd_child_theme_setup() {
         load_child_theme_textdomain( 'incubator', get_stylesheet_directory() . '/languages' );
     }
 }

 // -------------------------------------
 // Edit below this line
 // -------------------------------------
 
/* Remove dashboard items */
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 999 );

/* Remove header bar items */
function remove_admin_bar_links() {
    global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('archive');
    $wp_admin_bar->remove_menu('preview');
    $wp_admin_bar->remove_menu('view');
	$wp_admin_bar->remove_menu('wpfc-toolbar-parent');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links', 999 );

/* Login Logo */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/hydromulching_logo_login.png);
		height:80px;
		width:80px;
		background-size: 80px 80px;
		background-repeat: no-repeat;
        	padding-bottom: 20px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );