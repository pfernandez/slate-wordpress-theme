<?php
/**
 * Slate functions
 *
 * @package Slate
 * @since Slate 1.0
 */

/* Set the content width */
if ( ! isset( $content_width ) )
	$content_width = 760; /* pixels */


if ( ! function_exists( 'slate_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since Slate 1.0
 */
function slate_setup() {

	/* Add Customizer settings */
	require( get_template_directory() . '/customizer.php' );

	/* Add theme update class */
	//require( get_template_directory() . '/includes/updates/EDD_SL_Setup.php' );

	/* Add extra post styles */
	require( get_template_directory() . '/includes/editor/add-styles.php' );

	/* Load custom metabox */
	require( get_template_directory() . '/includes/metabox/metabox.php' );

	/* Load widgets */
	require( get_template_directory() . '/includes/widgets/recent-widgets.php' );
	require( get_template_directory() . '/includes/widgets/text-column.php' );
	require( get_template_directory() . '/includes/widgets/recent-portfolio.php' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add editor styles */
	add_editor_style();

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
	add_image_size( 'portfolio-image', 450, 309, true ); // Portfolio Block Image
	add_image_size( 'large-image', 980, 9999, false ); // Large Image
	add_image_size( 'sidebar-image', 400, 275, true ); // Sidebar Slider Image
	add_image_size( 'blog-image', 800, 9999, false ); // Blog Image
	add_image_size( 'blog-thumb', 360, 200, true ); // Blog Thumb

	/* Enable portfolio, gallery, slider and metabox */
	add_theme_support('okay_themes_portfolio_support');
	add_theme_support('okay_themes_gallery_support');
	add_theme_support('okay_themes_slider_support');
	add_theme_support('okay_themes_metabox_support');

	/* Custom Background Support */
	add_theme_support( 'custom-background' );

	/* Register Menu */
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'okay' ),
		'footer' => __( 'Footer Menu', 'okay' ),
		'custom' => __( 'Custom Menu', 'okay' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'okay', get_template_directory() . '/languages' );

	/* Gallery Post Format */
	add_theme_support( 'post-formats', array( 'gallery' ) );

}
endif; // slate_setup
add_action( 'after_setup_theme', 'slate_setup' );


/* Load Scripts & Styles */
function slate_scripts_styles() {

	// Load Styles

	//Main Stylesheet
	wp_enqueue_style( 'slate-style', get_stylesheet_uri() );

	//Media Queries CSS
	wp_enqueue_style( 'media-queries-css', get_template_directory_uri() . "/media-queries.css", array(), '0.1', 'screen' );

	//Dark Stylesheet
	if ( get_option( 'okay_theme_customizer_color_scheme' ) == 'dark' ) {
		wp_enqueue_style( 'slate-style-dark', get_template_directory_uri() . "/style-dark.css", array(), '0.1', 'screen' );
	}

	//Add Flexslider Styles
	wp_enqueue_style( 'flex-css', get_template_directory_uri() . '/includes/js/flex/flexslider.css', array(), '0.1', 'screen' );

	//Font Awesome CSS
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.css", array(), '0.1', 'screen' );

	//Google Merriweather Font
	wp_enqueue_style('google-merriweather', 'http://fonts.googleapis.com/css?family=Merriweather:400,700');

	// Load Scripts

	//Register jQuery
	wp_enqueue_script('jquery');

	//Custom JS
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/includes/js/custom/custom.js', array(), '20130731', true );

	wp_localize_script('custom-js', 'custom_js_vars', array(
			'flexslider_auto' => get_option( 'okay_theme_customizer_slider_auto' )
		)
	);

    //Flex
    wp_enqueue_script('flex-js', get_template_directory_uri() . '/includes/js/flex/jquery.flexslider.js', array(), '20130731', true );

    //Tabs
    wp_enqueue_script('tabs-js', get_template_directory_uri() . '/includes/js/tabs/jquery.tabs.min.js', array(), '20130731', true );

    //Fitvid
    wp_enqueue_script('fitvid-js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', array(), '20130731', true );

   	//Mobile Menu
	wp_enqueue_script('mobile-js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', array(), '20130731', true );

}
add_action( 'wp_enqueue_scripts', 'slate_scripts_styles' );


/* Add Customizer CSS To Header */
function slate_customizer_css() {
    ?>
	<style type="text/css">
		a {
			color: <?php echo get_theme_mod( 'okay_theme_customizer_link', '#60BDDB' ); ?>;
		}

		<?php echo get_theme_mod( 'okay_theme_customizer_css', '' ); ?>
	</style>
    <?php
}
add_action('wp_head', 'slate_customizer_css');


/* Custom Excerpt Length */
function string_limit_words( $string, $word_limit ) {
  $words = explode( ' ', $string, ($word_limit + 1) );
  if( count( $words ) > $word_limit )
  	array_pop( $words );
  	return implode( ' ', $words );
}


/* Pagination */
function okay_page_has_nav() {
	global $wp_query;
	return ( $wp_query->max_num_pages > 1 );
}


/* Register Widget Areas */
if ( function_exists('register_sidebars') )

register_sidebar( array(
	'name' 			=> __( 'Header Toggle Icons', 'okay' ),
	'description' 	=> __( 'This section is for the social media icons widget provided by the Okay Toolkit.', 'okay' ),
	'before_widget' => '<div id="%1$s" class="%2$s">',
	'after_widget' 	=> '</div>'
) );

register_sidebar( array(
	'name' 			=> __( 'Services Text Columns', 'okay' ),
	'description' 	=> __( 'This section is for the Services section on the homepage.', 'okay' ),
	'before_widget' => '<div id="%1$s" class="column %2$s">',
	'after_widget' 	=> '</div>'
) );

register_sidebar( array(
	'name' 			=> __( 'Testimonials', 'okay' ),
	'description' 	=> __( 'Widgets in this area will be shown on the left side of the note area on the homepage.', 'okay' ),
	'before_widget' => '<li id="%1$s" class="%2$s">',
	'after_widget' 	=> '</li>'
) );

register_sidebar( array(
	'name' 			=> __( 'Sidebar', 'okay' ),
	'description' 	=> __( 'Widgets in this area will be shown on the sidebar of all pages.', 'okay' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
) );

register_sidebar( array(
	'name' 			=> __( 'Footer', 'okay' ),
	'description' 	=> __( 'Widgets in this area will be shown own on the left side of the footer of all pages.', 'okay' ),
	'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
	'after_widget' 	=> '</div>'
) );


/* Custom Comment Output */
function okay_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 35 ); ?>

					<div class="comment-meta commentmetadata">
						<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
						<div class="clear"></div>
						<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'okay'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','okay'),'  ','') ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="comment-text">
				<?php comment_text() ?>
				<p class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</p>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','okay') ?></em>
			<?php endif; ?>
		</div>
<?php
}


/* Check for Okay Toolkit Notice */
if ( !function_exists('okaysocial_init') ) {

	add_action('admin_notices', 'okay_toolkit_notice');
	function okay_toolkit_notice() {
	    global $current_user ;
	    $user_id = $current_user->ID;

	    $adminurl = admin_url('plugin-install.php?tab=plugin-information&plugin=okay-toolkit&TB_iframe=true&width=640&height=589');

	    if ( ! get_user_meta($user_id, 'okay_toolkit_ignore_notice') ) {
	        echo '<div class="updated"><p>';

	        echo 'This theme supports the Okay Toolkit! Install it to extend the features of your theme. ';

	        echo '<a class="thickbox onclick" href=" ' . $adminurl . ' ">Install Now</a> | ';

	        printf(__('<a href="%1$s">Hide Notice</a>'), '?okay_toolkit_nag_ignore=0');

	        echo "</p></div>";
	    }
	}

	add_action('admin_init', 'okay_toolkit_nag_ignore');
	function okay_toolkit_nag_ignore() {
	    global $current_user;
	        $user_id = $current_user->ID;
	        /* If user clicks to ignore the notice, add that to their user meta */
	        if ( isset($_GET['okay_toolkit_nag_ignore']) && '0' == $_GET['okay_toolkit_nag_ignore'] ) {
	             add_user_meta($user_id, 'okay_toolkit_ignore_notice', 'true', true);
	    }
	}
}
