<?php
/**
 * Swiss Design Group functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Swiss_Design_Group
 * @since Swiss Design Group 1.0
 */

ini_set( 'display_errors', 1 );

@define( 'HB_THEME_NAME', 'Swiss Design Group' );
@define( 'HB_THEME_VERSION', '2.0' );
@define( 'HB_DOMAIN_TXT', 'SDG' );
@define( 'HB_DEV_MODE', false );
@define( 'HB_THEME_PATH', get_template_directory() );
@define( 'HB_THEME_URL',  get_template_directory_uri() );
@define( 'HB_CHILD_PATH', get_stylesheet_directory() );
@define( 'HB_CHILD_URL',  get_stylesheet_directory_uri() );

/* Mobile Detect */
if ( ! class_exists('Mobile_Detect') ) { 
	
	include_once( HB_THEME_PATH . '/inc/hb-mobile-detect-class.php' );
	$detect = new Mobile_Detect();

} elseif( class_exists('Mobile_Detect') ) {
   
    $detect = new Mobile_Detect();

}

if ( ! function_exists( 'hb_is_plugin_active' ) ):

	/*
	 * Helper function to detect if already plugin is installed
	 *
	 */	
	function hb_is_plugin_active( $plugin ) {
		
	    if ( is_multisite() && array_key_exists( $plugin , get_site_option('active_sitewide_plugins', array() ) ) )
	                    
	        return array_key_exists( $plugin , get_site_option('active_sitewide_plugins', array() ) );
	        
	    elseif ( is_multisite() && in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) )
	                    
	        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	        
	    else
	        
	        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	    
	}

endif;


/*
|--------------------------------------------------------------------------
| Option Tree Integration
|--------------------------------------------------------------------------
*/
if ( ! hb_is_plugin_active( 'option-tree/ot-loader.php' ) ) {

	add_filter( 'ot_show_new_layout', '__return_false' ); // Hide New Layout
	add_filter( 'ot_theme_mode', '__return_true' ); // Required: set 'ot_theme_mode' filter to true.
	
	if( ! HB_DEV_MODE )
		add_filter( 'ot_show_pages', '__return_false' ); // Show / hide Settings Pages

	/**
	 * Required: include OptionTree.
	 */
	load_template( trailingslashit( HB_THEME_PATH ) . 'admin/ot-loader.php' );

	/**
	 * Theme Options
	 */
	load_template( trailingslashit( HB_THEME_PATH ) . 'admin/hb-theme-options.php' );

	/**
	 * Metaboxes
	 */
	load_template( trailingslashit( HB_THEME_PATH ) . 'admin/hb-meta-boxes.php' );

	/**
	 * Google fonts
	 */
	load_template( trailingslashit( HB_THEME_PATH ) . 'admin/hb-google-fonts.php' );

} else {
	
	function notify_user_ot_detected() {
		
		$alert = '<div style="position:fixed; z-index:9999; width:100%; text-align:center; padding: 20px; background: #f6f6f6;border-bottom: 4px solid #FF7979;font-size: 16px;">';
			$alert .= __('Option Tree Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', HB_DOMAIN_TXT );
	 	$alert .= '</div>';
		
		echo $alert;
		
	}
	
	/* display user information on front page with the help of the ut_before_header_hook */
	add_action( 'ut_before_header_hook', 'notify_user_ot_detected' );
}


if ( ! function_exists( 'r' ) ):

	/**
	 * 
	 * Helper function
	 *
	 */
	function r( $str ){

		echo "<pre>", var_dump($str), "</pre>";
	}
endif;

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Swiss Design Group 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980;
}

/**
 * Swiss Design Group only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'SDG_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on SDG, use a find and replace
	 * to change HB_DOMAIN_TXT to the name of your theme in all the template files
	 */
	load_theme_textdomain( HB_DOMAIN_TXT, get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'logged_in_users' 	=> __( 'Logged-in Users Menu',	HB_DOMAIN_TXT ),
		'guest_users' 		=> __( 'Guest Users Menu',	HB_DOMAIN_TXT ),
		'footer'  			=> __( 'Footer Menu', 	HB_DOMAIN_TXT ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */

	//	add_theme_support( 'post-formats', array(
	//		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	//	) );

	// $color_scheme  = SDG_get_color_scheme();
	// $default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'SDG_custom_background_args', array(
	// 	'default-color'      => $default_color,
	// 	'default-attachment' => 'fixed',
	// ) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', SDG_fonts() ) );
}
endif; // SDG_setup
add_action( 'after_setup_theme', 'SDG_setup' );

function hb_after_switch_theme(){

	$freelancer = add_role(
	    'freelancer',
	    __( 'Freelancer' ),
	    array(
	        'read'         => true,
	        'edit_posts'   => false,
	        'delete_posts' => false,
	    )
	);

	$company = add_role(
	    'company',
	    __( 'Company' ),
	    array(
	        'read'         => true,
	        'edit_posts'   => false,
	        'delete_posts' => false,
	    )
	);
}
add_action('after_switch_theme', 'hb_after_switch_theme');

/**
 * Register widget area.
 *
 * @since Swiss Design Group 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function SDG_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', HB_DOMAIN_TXT ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', HB_DOMAIN_TXT ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'SDG_widgets_init' );



if ( ! function_exists( 'SDG_get_google_font_url' ) ) :
/**
 * Register Google fonts for Swiss Design Group.
 *
 * @since Swiss Design Group 1.0
 *
 * @note should be call in wp_enqueue_scripts.
 */
function SDG_get_google_font_url( $fonts_object ) {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	foreach ( $fonts_object as $font ) {

		/* translators: If there are characters in your language that are not supported by font familiy, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', $font['family'].' font: on or off', HB_DOMAIN_TXT ) ) {
			$fonts[] = $font['family']. ':' .$font['weight'];
		}
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', HB_DOMAIN_TXT );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => implode( '|', $fonts ),
			'subset' => $subsets,
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

if ( ! function_exists( 'SDG_print_typekit' ) ) :
function SDG_print_typekit(){

	echo ot_get_option('typekit');
}
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_scripts() {

	global $detect;

	$tablet = $detect->isTablet();
	$mobile = $detect->isMobile();
	$chrome = preg_match("/chrome/",strtolower($_SERVER['HTTP_USER_AGENT']));

	$minify = '.min';

	// Add custom fonts
	switch ( ot_get_option('site_fonts_type') ) {

		case 'typekit':

			add_action( 'wp_head', 'SDG_print_typekit', 99 );

			break;

		case 'google-fonts':

			/* available google fonts */
			$google_fonts = hb_recognized_google_fonts();
			
			/* custom array of all affected option tree options */
			$option_keys = array(

				'body' 		=> ot_get_option('body_typo'),
				'alt'		=> ot_get_option('headlines_typo'),
			);

			$option_keys['body']['font-weight'] = '400';

			if ( 'italic' 	== $option_keys['alt']['font-weight'] ) $option_keys['alt']['font-weight'] = '400italic';
			if ( 'regular' 	== $option_keys['alt']['font-weight'] ) $option_keys['alt']['font-weight'] = '400';
				
			$fonts = array(
				'body' => array(
					'id'     => '',
					'family' => '',
					'font-family' => '',
					'weight' => array('300', '300italic', '400italic', '700', '700italic')
				),

				'alt' => array(
					'id'     => '',
					'family' => '',
					'font-family' => '',
					'weight' => array()
				)
			);

			/* create query string */		
			foreach( $option_keys as $key => $option ) {
				
				if( isset($option['font-id']) && !empty($google_fonts[$option['font-id']]) ) {

					/* replace whitespace with + */
					$family = preg_replace("/\s+/" , '+' , $google_fonts[$option['font-id']]['family'] );

					$fonts[$key]['id'] 			= $option['font-id'];
					$fonts[$key]['family'] 		= $family;
					$fonts[$key]['font-family'] = $google_fonts[$option['font-id']]['family'];
					$fonts[$key]['weight'][] 	= $option['font-weight'];
					$fonts[$key]['weight'] 		= array_unique( $fonts[$key]['weight'] );
					$fonts[$key]['weight'] 		= implode(',', $fonts[$key]['weight']);
				}
			}


			if ( empty($fonts['body']['font-family']) ){

				$fonts['body']['family'] = 'Inconsolata';
				$fonts['body']['font-family'] = 'Inconsolata';
				$fonts['body']['weight'] = '400,700';
			}

			if ( empty($fonts['alt']['font-family']) ){

				$fonts['alt']['family'] = 'Montserrat';
				$fonts['alt']['font-family'] = 'Montserrat';
				$fonts['alt']['weight'] = '700';
			}

			$alt_fint_style  = 'normal';
			$alt_font_weight = !empty($option_keys['alt']['font-weight']) ? $option_keys['alt']['font-weight'] : '700';

			if ( strpos( $alt_font_weight, 'italic') ){

				$alt_font_weight = str_replace('italic', '', $alt_font_weight);
				$alt_fint_style  = 'italic';
			}

			$css  = "";
			$css .= "h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6{";
			$css .= "font-family:'".$fonts['alt']['font-family']."',sans-serif;";
			$css .= "font-weight:".$alt_font_weight.";";
			$css .= "font-style:".$alt_fint_style.";";

			if ( !empty($option_keys['alt']['text-transform']) )
				$css .= "text-transform:".$option_keys['alt']['text-transform'].";";
			if ( !empty($option_keys['alt']['text-decoration']) )
				$css .= "text-decoration:".$option_keys['alt']['text-decoration'].";";
			if ( !empty($option_keys['alt']['letter-spacing']) )
				$css .= "letter-spacing:".$option_keys['alt']['letter-spacing'].";";

			$css .= "}";
			$css .= "body{font-family: '".$fonts['body']['font-family']."',sans-serif}";

			$font_url = SDG_get_google_font_url( $fonts );

			wp_enqueue_style( 'SDG-google-fonts', $font_url, array('bootstrap'), null );

			wp_add_inline_style( 'SDG-google-fonts', $css );

			break;
		
		default:

 			// slience

			break;
	}

	// Load our main stylesheet.
	wp_enqueue_style( 
		'SDG-style', 
		get_stylesheet_uri(), 
		array( 'bootstrap' ) 
	);

	$hidden_nav = ot_get_option('mobile_menu');
	if ( ! $hidden_nav ) $hidden_nav = 'md';
	$media = array(
		'xs' => '@media (max-width: 767px){ .page-template-default #content { padding-top: 3.9rem } }',
		'sm' => '@media (max-width: 991px){ .page-template-default #content { padding-top: 3.9rem } }',
		'md' => '@media (max-width: 1199px){ .page-template-default #content { padding-top: 3.9rem } }',
	);

	wp_add_inline_style( 'SDG-style', $media[ $hidden_nav ] );


	// Include bootstrap
	wp_enqueue_style( 'bootstrap', HB_THEME_URL . "/bootstrap-3.3.1/css/bootstrap{$minify}.css", array(), '3.3.1' );
	wp_enqueue_script( 'bootstrap', HB_THEME_URL . "/bootstrap-3.3.1/js/bootstrap{$minify}.js", array( 'jquery' ), '3.3.1', true );

	// DIN fonts
	wp_enqueue_style( 'DIN', HB_THEME_URL . "/DIN/stylesheet.css", array(), '1.0' );

	//Styeles
	wp_enqueue_style( 'css-animation', HB_THEME_URL . "/css/animate.css", array(), '1.0' );

  	// MBC Bootstrap slider
  	wp_enqueue_style( 'css-bs', HB_THEME_URL . "/css/bootstrap-slider.css", array(), '1.0' );

  	// MBC Styles
  	wp_enqueue_style( 'css-MBC', HB_THEME_URL . "/css/component.css", array(), '1.0' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'SDG-ie', get_template_directory_uri() . '/css/ie.css', array( 'SDG-style' ), '20141010' );
	wp_style_add_data( 'SDG-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'SDG-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'SDG-style' ), '20141010' );
	wp_style_add_data( 'SDG-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'SDG-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'SDG-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'SDG-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'SDG-script', 'detect', array(
		'mobile' => $detect->isMobile(),
		'tablet' => $detect->isTablet(),
		'chrome' => $chrome,
		'is_user_logged_in' => is_user_logged_in(),
		'user_id' => get_current_user_id(),
		'ajaxurl' 	=> admin_url( 'admin-ajax.php'),
		'nonce' 	=> wp_create_nonce('hb-ajax')
	) );
	wp_localize_script( 'SDG-script', 'page', array(
		'home' 		=> esc_url(site_url()),
		'register' 	=> esc_url(site_url('/register/')),
		'login' 	=> esc_url(site_url('/login/')),
		'edit'		=> esc_url(site_url('/edit-profile/')),
		'profile'   => esc_url(site_url('/profile/')),
	) );
	wp_localize_script( 'SDG-script', 'error', array(
		'fb_login_success'	=> esc_js(__('Something went wrong! Please try again.', HB_DOMAIN_TXT)),
	) );

	if( !$mobile && !$tablet ) {
		// YTPlayer
		wp_enqueue_script( 'ytplayer', HB_THEME_URL . '/js/jquery.mb.YTPlayer.js', array( 'jquery' ), '2.6.3', true );
		wp_enqueue_script( 'desktop-app', HB_THEME_URL . '/js/desktop.js', array( 'jquery' ), '1.0', true );
	}

	if( $chrome && !$mobile && !$tablet ) 
		wp_enqueue_script( 'smooth-scroll', HB_THEME_URL . '/js/SmoothScroll.min.js', array( 'jquery' ), '1.2.1', true );

}

add_action( 'wp_enqueue_scripts', 'SDG_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Swiss Design Group 1.0
 *
 * @see wp_add_inline_style()
 */
function SDG_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'SDG-style', $css );
}
add_action( 'wp_enqueue_scripts', 'SDG_post_nav_background' );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Swiss Design Group 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function SDG_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'SDG_search_form_modify' );


/**
* Site logo
*
*/
function SDG_site_logo_func( $option = '' ) {
	
	if ( ! $option ) $option = 'logo';
	$site_title	= addslashes( get_bloginfo( 'name' ) );
	$logo 		= ot_get_option( $option );

	echo ( $logo ) 

		?

		"<img src='{$logo}' alt='{$site_title}'>"

		:

		"<span>{$site_title}</span>";
}
add_action( 'hb_site_logo', 'SDG_site_logo_func', 10, 1 );

if ( ! function_exists( 'hb_desktop_hidden_class_filter' ) ):

	/**
	 *
	 * Generate hidden classes
	 *
	 */
	function hb_desktop_hidden_class_filter( $hidden ){

		if ( ! $hidden ) $hidden = 'md';

		$classes = array('hidden-xs');

		if ( 'sm' == $hidden ) $classes[] = 'hidden-sm';

		if ( 'md' == $hidden ) $classes[] = 'hidden-sm hidden-md';

		$classes = implode(' ', $classes);

		return " {$classes} ";
	}
	add_filter( 'hb_desktop_hidden_class', 'hb_desktop_hidden_class_filter', 10, 1 );

endif;

if ( ! function_exists( 'hb_shortcode_active_option_values' ) ):

	/**
	 *
	 * Activated values which user might use
	 *
	 * @since sTheme 1.0
	 *
	 * @return string
	 */
	function hb_shortcode_active_option_values(){

		return apply_filters( 'hb_shortcode_active_option_values', array(
			'1',
			'true',
			'active',
			'yes',
			'on',
			'whatever',
			'yup',
			'xo',
		));
	}

endif;

if ( ! function_exists( 'hb_get_background_video' ) ):
	/**
	* Background Video code
	*
	*/
	function hb_get_background_video( $id, $video_url, $ratio = '16/9' ) {
	    
		if ( ! wp_script_is( 'ytplayer' ) || ! preg_match('/youtu/', $video_url) ) return;

	    $uniqid = uniqid();

	    $mute_btn = get_post_meta( $id, 'page_banner_video_mute_btn', true );
	    $vol = ( 'on' == $mute_btn ) ? get_post_meta( $id, 'page_banner_video_vol', true ) : '0';

	    ob_start();
	    ?>

	    <div id="video-player-<?php echo $uniqid; ?>" class="bg-video-wrapper"></div>

	    <a style="display:none"
	    id="video-trigger-<?php echo $uniqid; ?>"
	    class="bg-video-trigger"
	    <?php echo ( 'on' == $mute_btn )? ' data-mute="#mute-trigger-'. $uniqid.'" ' : '' ?>
	    data-property="{videoURL:'<?php echo $video_url; ?>',containment:'#video-player-<?php echo $uniqid; ?>',autoPlay:true, mute:true, startAt:0, opacity:1, showControls:0, ratio:<?php echo $ratio; ?>, showYTLogo:0, vol:<?php echo $vol; ?>}"></a>

	    <?php if ( 'on' == $mute_btn ): ?>
	    	<span id="mute-trigger-<?php echo $uniqid; ?>" class="vol-trigger unmute"><i class="fa fa-volume-up"></i><i class="fa fa-volume-off"></i></span>
	    <?php endif; ?>
	    <?php
	    $output = ob_get_contents();
	    ob_end_clean();

	    return $output;
	}
endif;


function hb_nav_menu_link_attributes( $atts, $item, $args ) {

	$color = false;

	if ( isset($item->object)
		 && "page" == $item->object
		 && isset($item->object_id)
		 && !empty($item->object_id) )

		$color = get_post_meta( $item->object_id, 'color', true );

	if ( $color )
		$atts['data-color'] = $color;

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'hb_nav_menu_link_attributes', 99, 3 );


/**
 * Implement the Custom Header feature.
 *
 * @since Swiss Design Group 1.0
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Swiss Design Group 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Swiss Design Group 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Login / logout / Signup functions.
 *
 * @since Swiss Design Group 1.0
 */
require get_template_directory() . '/inc/login-logout-signup.php';

/**
 * Questions.
 *
 * @since Swiss Design Group 1.0
 */
require get_template_directory() . '/inc/questions.php';

// Shortcodes
require get_template_directory() . '/shortcodes/shortcode-functions.php';

function hb_show_admin_bar(){

	if ( is_admin() || current_user_can( 'manage_options' ) ) return;

	add_filter( 'show_admin_bar', '__return_false' );
	add_filter( 'wp_admin_bar_class', '__return_false' );
}
add_action('init', 'hb_show_admin_bar', 9);


remove_action('wp_head', 'wp_print_head_scripts', 9);
add_action('wp_footer', 'wp_print_head_scripts', 5);