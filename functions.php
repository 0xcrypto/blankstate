<?php
/**
 * Noko functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Noko
 */

if ( ! function_exists( 'noko_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function noko_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Noko, use a find and replace
		* to change 'noko' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'noko', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'noko' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'noko_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'noko_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function noko_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'noko_content_width', 640 );
}
add_action( 'after_setup_theme', 'noko_content_width', 0 );

/**
 * Set the Read More Excerpt.
 *
 * @link https://developer.wordpress.org/reference/hooks/the_content_more_link/
 */
function noko_excerpt( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	return '<a class="more-link btn-primary" href="' . esc_url( get_the_permalink() ) . '">Read More</a>';

}
add_filter( 'the_content_more_link', 'noko_excerpt' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function noko_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'noko' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'noko' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'noko_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function noko_scripts() {
	wp_enqueue_style( 'noko-style', get_stylesheet_uri() );

	wp_enqueue_style( 'noko-fonts', 'https://fonts.googleapis.com/css?family=Dosis' );
	wp_enqueue_style( 'noko-icon-font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );

	wp_enqueue_script( 'noko-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'noko-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'noko_scripts' );


function noko_show_activation_message() {
	add_action(
		'admin_notices',
		function () {          ?>
			<div class="notice notice-success">
				<p><span class="dashicons dashicons-heart" style="color: #f50011"></span>
					<strong>
					<?php _e( 'Thank you for installing Noko!', 'noko' ); ?>
					</strong>
					<?php _e( 'The all new Noko! After a whole year of being dormant, Noko is now being maintained by <a href="https://stirpot.co">Stirpot</a> and we are committed to give regular updates and support. <img src="//bit.ly/stirpottrackbeacon" />', 'noko' ); ?></p>
			</div>
			<?php
		}
	);
}
add_action( 'after_switch_theme', 'noko_show_activation_message' );


function noko_admin_page() {
	?>
	<h3><i>Developer's Note</i></h3>
	<p style="width: 70%">Started as an hobby project, Noko was released on 2nd of October, 2017. But due to lack of time, I had to stop the development very soon. On 23rd of January, 2019, I realised that Noko was empowering way too many websites than I ever expected! 400+ websites already using Noko in production. So, I am restarting the development. This time, under the banner of <a href="https://stirpot.co" target="_blank">Stirpot</a>. So now, there will be regular updates, support and more features.</p>

	<h3>Support Noko</h3>
	<p style="width: 70%">Thank you for using Noko. If you like it, please leave a nice review <a href="https://wordpress.org/support/theme/noko/reviews/#new-post" target="_blank">here</a>. Facing an issue? We are <a href="https://wordpress.org/support/theme/noko/#new-post" target="_blank">here</a> to help you. <br>
	<a class="github-button" href="https://github.com/stirpot/noko" data-size="large" aria-label="Star stirpot/noko on GitHub">Star Noko on GitHub</a>
	<script async defer src="https://buttons.github.io/buttons.js"></script></p>
	

	<a class="twitter-timeline" data-width="400" data-link-color="#2B7BB9" href="https://twitter.com/stirpot_co?ref_src=twsrc%5Etfw">Tweets by stirpot_co</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

	
	<?php
}
add_action(
	'admin_menu',
	function () {
		add_theme_page( 'Noko WordPress Theme', 'About Noko', 'manage_options', 'noko-theme', 'noko_admin_page' );
	}
);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	include get_template_directory() . '/inc/jetpack.php';
}

