<?php

/**
 * TwoByteCode functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TwoByteCode
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.4');
}

if (!function_exists('twobytecode_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twobytecode_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TwoByteCode, use a find and replace
		 * to change 'twobytecode' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('twobytecode', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'twobytecode'),
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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'twobytecode_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'twobytecode_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twobytecode_content_width()
{
	$GLOBALS['content_width'] = apply_filters('twobytecode_content_width', 640);
}
add_action('after_setup_theme', 'twobytecode_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twobytecode_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'twobytecode'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'twobytecode'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'twobytecode_widgets_init');











/**
 * Enqueue scripts and styles.
 */
function twobytecode_scripts()
{
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style('twobytecode-main', get_template_directory_uri() . '/assets/css/main.css', '', _S_VERSION, "all");
	wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css');
	wp_enqueue_style('codemirror-style', get_template_directory_uri() . '/assets/highlighter/codemirror.css');
	wp_enqueue_style('codemirror-monokai', get_template_directory_uri() . '/assets/highlighter/monokai.css');
	wp_enqueue_style('twobytecode-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('twobytecode-style', 'rtl', 'replace');


	wp_enqueue_script('jquery-script', get_template_directory_uri() . '/assets/js/jquery-3.6.0.min.js');
	wp_enqueue_script('popper-script', get_template_directory_uri() . '/assets/js/popper.min.js');
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
	wp_enqueue_script('codemirror-script', get_template_directory_uri() . '/assets/highlighter/codemirror.js');
	wp_enqueue_script('codemirror-dart', get_template_directory_uri() . '/assets/highlighter/dart.js');
	wp_enqueue_script('codemirror-clike', get_template_directory_uri() . '/assets/highlighter/clike.js');
	wp_enqueue_script("bodymovin", "https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.6.6/lottie.min.js");
	wp_register_script('twobytecode-main', get_template_directory_uri() . '/assets/js/main.js', '', _S_VERSION, true);
	wp_enqueue_script('twobytecode-main');
	wp_localize_script( 'twobytecode-main', 'twobytecode', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap',[], null);

	// add woo css
	if ( is_page( array( 'cart', 'checkout', 'order-received' )) ) {
        wp_enqueue_style( 'woocommerce',  get_template_directory_uri() . '/assets/css/woocommerce.css', "", _S_VERSION, "all" );
    }
	if(is_page("quiz")){
		wp_register_script('twobytecode-quiz-level', get_template_directory_uri() . '/assets/js/quiz-level.js', '', _S_VERSION, true);
		wp_enqueue_script('twobytecode-quiz-level');
	}
	if(is_page("course-quiz")){
		wp_register_script('twobytecode-course-quiz', get_template_directory_uri() . '/assets/js/course-quiz.js', '', _S_VERSION, true);
		wp_enqueue_script('twobytecode-course-quiz');
	}
}
add_action('wp_enqueue_scripts', 'twobytecode_scripts');


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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_theme_support('post-thumbnails'); //Adds thumbnails compatibility to the theme 
// set_post_thumbnail_size( 300, 400, true ); // Sets the Post Main Thumbnails 
// add_image_size( 'twobytecode-recent-thumbnails', 55, 55, true ); // Sets Recent Posts Thumbnails



add_post_type_support('post', 'excerpt');

add_filter('big_image_size_threshold', '__return_false');


// function disable_wp_auto_p( $content ) {
// 	remove_filter( 'the_content', 'wpautop' );
// 	remove_filter( 'the_excerpt', 'wpautop' );
// 	return $content;
//   }
// add_filter( 'the_content', 'disable_wp_auto_p', 0 );

function tbc_add_required_body_class($classes)
{
	global $post;
	if (isset($post->post_title) && $post->post_title == 'Terms and Conditions' || $post->post_title == 'Privacy Policy' || $post->post_title == 'Disclaimer') {
		$classes[] = 'other-pages';
		return $classes;
	} else {
		return $classes;
	}
}

add_filter('body_class', 'tbc_add_required_body_class');


function custom_jpeg_quality($quality, $context)
{
	return 100;
}
add_filter('jpeg_quality', 'custom_jpeg_quality', 10, 2);

/* setup
create primary menu by name: header-menu
js add 1 for active menu check
*/






// single doc page animation
function dart_doc_last_post_anm($atts)
{

	$params = shortcode_atts(array(
		"current_doc" => "Beginner Level",
		"next_doc" => "Intermediate Level",
	), $atts);

	echo
	'<div class="doc-animation">
		<span class="doc-animation-overlay"></span>

		 <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_dwm2hi59.json"  background="transparent"  speed="1"  class="lottie-doc-anam-left"  loop></lottie-player>

		 <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_llqi3lop.json" background="transparent" speed="1" class="lottie-doc-anam d-none d-md-block" loop></lottie-player>

		 <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_tkeaajkc.json" background="transparent" speed="1" class="lottie-doc-anam-upper"></lottie-player>
		 <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_dwm2hi59.json"  background="transparent"  speed="1"  class="lottie-doc-anam-right"  loop></lottie-player>


		<div class="card border-0 shadow text-center">
			<h1 class="">YAY!!</h1>
			<p class="">You have <span class="text-dark">successfully</span> <br/> completed ' . $params['current_doc'] . '</p>
			<a href="#" class="btn btn-primary">Go to ' . $params['next_doc'] . '</a>
		</div>

		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	</div>';
}

add_shortcode('dart_doc_anm_add_resources', 'dart_doc_last_post_anm');

// support for woocommerce
add_theme_support('woocommerce');











// dart doc

function tbc_register_custom_post_type_docs()
{

	$dart_supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'post-formats',
	);

	$dart_labels = array(
		'name' => _x('Dart Docs', 'plural'),
		'singular_name' => _x('Dart Doc', 'singular'),
		'menu_name' => _x('Dart Docs', 'admin menu'),
		'name_admin_bar' => _x('Dart Docs', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New'),
		'new_item' => __('New Dart Doc'),
		'edit_item' => __('Edit Dart Doc'),
		'view_item' => __('View Dart Doc'),
		'all_items' => __('All Dart Docs'),
		'search_items' => __('Search Dart Docs'),
		'not_found' => __('No Dart Documentation Found.'),
	);

	$dart_args = array(
		'supports' => $dart_supports,
		'labels' => $dart_labels,
		'public' => true,
		'query_var' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'rewrite' => array(
			'with_front' => false,
			'slug' => 'dart'
		),
		'has_archive' => "dart",
		'hierarchical' => true,
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies'          => array('dart-level'),
		'menu_icon' => 'dashicons-media-document',
	);

	register_post_type('dart-doc', $dart_args);

	register_taxonomy(
		"dart-level",
		array("dart-doc"),
		array(
			"hierarchical" => true,
			'show_in_rest' => true,
			'show_ui' => true,
			'query_var' => true,
			'public' => true,
			'publicly_queryable' => true,
			'labels' => array(
				'name' => "Dart Levels",
				'singular_name' => "Dart Level",
				'search_items' =>  __('Search Dart Levels'),
				'all_items' => __('All Dart Levels'),
				'parent_item' => __('Parent Dart Level'),
				'parent_item_colon' => __('Parent Dart Level:'),
				'edit_item' => __('Edit Dart Level'),
				'update_item' => __('Update Dart Level'),
				'add_new_item' => __('Add New Dart Level'),
				'new_item_name' => __('New Dart Level Name'),
				'menu_name' => __('Dart Levels'),
			),
			"rewrite" => array(
				'slug' => 'dart',
				'with_front' => false,
			)
		),
	);






	$flutter_supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'post-formats',
	);

	$flutter_labels = array(
		'name' => _x('Flutter Docs', 'plural'),
		'singular_name' => _x('Flutter Doc', 'singular'),
		'menu_name' => _x('Flutter Docs', 'admin menu'),
		'name_admin_bar' => _x('Flutter Docs', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New'),
		'new_item' => __('New Flutter Doc'),
		'edit_item' => __('Edit Flutter Doc'),
		'view_item' => __('View Flutter Doc'),
		'all_items' => __('All Flutter Docs'),
		'search_items' => __('Search Flutter Docs'),
		'not_found' => __('No Flutter Documentation Found.'),
	);

	$flutter_args = array(
		'supports' => $flutter_supports,
		'labels' => $flutter_labels,
		'public' => true,
		'query_var' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'rewrite' => array(
			'with_front' => false,
			'slug' => 'flutter'
		),
		'has_archive' => "flutter",
		'hierarchical' => true,
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies'          => array('flutter-categories'),
		'menu_icon' => 'dashicons-media-document',
	);

	register_post_type('flutter-doc', $flutter_args);

	register_taxonomy(
		"flutter-categories",
		array("flutter-doc"),
		array(
			"hierarchical" => true,
			'show_in_rest' => true,
			'show_ui' => true,
			'query_var' => true,
			'public' => true,
			'publicly_queryable' => true,
			'labels' => array(
				'name' => "Flutter Categories",
				'singular_name' => "Flutter Category",
				'search_items' =>  __('Search Flutter Categories'),
				'all_items' => __('All Flutter Categories'),
				'parent_item' => __('Parent Flutter Category'),
				'parent_item_colon' => __('Parent Flutter Category:'),
				'edit_item' => __('Edit Flutter Category'),
				'update_item' => __('Update Flutter Category'),
				'add_new_item' => __('Add New Flutter Category'),
				'new_item_name' => __('New Flutter Category Name'),
				'menu_name' => __('Flutter Categories'),
			),
			"rewrite" => array(
				'slug' => 'flutter',
				'with_front' => false,
			)
		),
	);




	// 	$labels = array(
	//     'name' => _x( 'Tags', 'taxonomy general name' ),
	//     'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
	//     'search_items' =>  __( 'Search Tags' ),
	//     'popular_items' => __( 'Popular Tags' ),
	//     'all_items' => __( 'All Tags' ),
	//     'parent_item' => null,
	//     'parent_item_colon' => null,
	//     'edit_item' => __( 'Edit Tag' ), 
	//     'update_item' => __( 'Update Tag' ),
	//     'add_new_item' => __( 'Add New Tag' ),
	//     'new_item_name' => __( 'New Tag Name' ),
	//     'separate_items_with_commas' => __( 'Separate tags with commas' ),
	//     'add_or_remove_items' => __( 'Add or remove tags' ),
	//     'choose_from_most_used' => __( 'Choose from the most used tags' ),
	//     'menu_name' => __( 'Tags' ),
	//   ); 

	//   register_taxonomy('tag','docs',array(
	//     'hierarchical' => false,
	//     'labels' => $labels,
	//     'show_ui' => true,
	// 	'show_in_rest' => true,
	//     'update_count_callback' => '_update_post_term_count',
	//     'query_var' => true,
	//     'rewrite' => array( 'slug' => 'tag' ),
	//   ));

}
add_action('init', 'tbc_register_custom_post_type_docs', 0);





// add extra product meta

// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_course_fields');
// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_course_fields_save');

function woocommerce_product_course_fields()
{
    global $woocommerce, $post;
    echo '<div class="product_course_field">';
	// text field
    woocommerce_wp_text_input(
        array(
            'id' => '_total_lessons',
            'placeholder' => 'Total Lessons',
            'label' => __('Total Lessons', 'woocommerce'),
            'type' => 'number'
        )
    );

	woocommerce_wp_text_input(
        array(
            'id' => '_total_duration',
            'placeholder' => 'Total Duration',
            'label' => __('Total Duration', 'woocommerce'),
            'type' => 'number'
        )
    );

	woocommerce_wp_text_input(
        array(
            'id' => '_course_type',
            'placeholder' => 'Course Type',
            'label' => __('Course Type', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );

    echo '</div>';
}

function woocommerce_product_course_fields_save($post_id){
	    // Course Type
		$courseType = $_POST['_course_type'];
		if (!empty($courseType))
			update_post_meta($post_id, '_course_type', esc_attr($courseType));
	// Total Lessons
		$totalLessons = $_POST['_total_lessons'];
		if (!empty($totalLessons))
			update_post_meta($post_id, '_total_lessons', esc_attr($totalLessons));
	// Total Course Duration
		$totalDuration = $_POST['_total_duration'];
		if (!empty($totalDuration))
			update_post_meta($post_id, '_total_duration', esc_html($totalDuration));
}



// remove added to cart message
// add_filter( 'wc_add_to_cart_message_html', '__return_false' );


add_filter( 'woocommerce_checkout_fields' , 'tbc_remove_checkout_fields' ); 

function tbc_remove_checkout_fields( $fields ) { 
	unset($fields['billing']['billing_first_name']);
	unset($fields['billing']['billing_last_name']);
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_phone']);
	unset($fields['order']['order_comments']);
	unset($fields['billing']['billing_email']);
	unset($fields['account']['account_username']);
	unset($fields['account']['account_password']);
	unset($fields['account']['account_password-2']);

	$fields['billing']['billing_country']["class"] = array("col-6");
	$fields['billing']['billing_state']["class"] = array("col-6");

	return $fields; 
}
// Removes Order Notes Title
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

// Detaching `payment` from `woocommerce_checkout_order_review` hook
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
// Attaching `payment` to my `woocommerce_checkout_payment_hook`
add_action('woocommerce_checkout_payment_hook', 'woocommerce_checkout_payment', 10 ); 


function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}





/**
*	remove/add cart message
*/
add_filter( 'wc_add_to_cart_message', '__return_false' );
add_filter( 'woocommerce_cart_item_removed_notice_type', '__return_false' );


// signup redirect
function tbc_redirect_register( $redirect ){
    if ( isset($_REQUEST['redirect_to'])){
        $redirect = $_REQUEST['redirect_to'];
        // return $redirect;
    }else if (wp_get_referer()){
		$redirect = wp_get_referer();
	}
    return $redirect;
}
add_filter('woocommerce_registration_redirect', 'tbc_redirect_register');
