<?php
/*
 *  Author: Grant Imbo
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1280, '', true); // Large Thumbnail
    add_image_size('medium', 600, '', true); // Medium Thumbnail
    add_image_size('small', 350, '', true); // Small Thumbnail
    add_image_size('product-thumb', 300, 300, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function grantex_nav() {
    wp_nav_menu( 
        array(
           'items_wrap' => '<ul class="nav clear">%3$s</ul>',
           )
        );
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function custom_wp_nav_menu($args) {
    return is_array($args) ? array_intersect($args, array(
        // List of useful classes to keep
        'current_page_item',
        'current_page_parent',
        'current_page_ancestor'
        )
    ) : '';
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if (!is_admin()) {

    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!

    	// wp_register_script('conditionizr', '//cdnjs.cloudflare.com/ajax/libs/conditionizr.js/4.0.0/conditionizr.js', array(), '4.0.0'); // Conditionizr
     //    wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); // Site Functionalities
        wp_enqueue_script('html5blankscripts'); // Enqueue it!


    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    // if (is_page('pagenamehere')) {
    //     wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
    //     wp_enqueue_script('scriptname'); // Enqueue it!
    // }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    // wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    // wp_enqueue_style('html5blank'); // Enqueue it!

}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}





// REPLACE "current_page_" WITH CLASS "active"
function current_to_active($text){
    $replace = array(
        // List of classes to replace with "active"
        'current_page_item' => 'active',
        'current_page_parent' => 'active',
        'current_page_ancestor' => 'active',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
        return $text;
}


// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{

    // Sidebar Widgets
    register_sidebar(array(
        'name' => __('Sidebar', 'html5blank'),
        'description' => __('Contents for the Sidebar', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="sidebar-men" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

/*
// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 8;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 8;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

function new_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

*/

function wp_trim_all_excerpt($text) {
// Creates an excerpt if needed; and shortens the manual excerpt as well
global $post;
   $raw_excerpt = $text;
   if ( '' == $text ) {
      $text = get_the_content('');
      $text = strip_shortcodes( $text );
      $text = apply_filters('the_content', $text);
      $text = str_replace(']]>', ']]&gt;', $text);
   }

$text = strip_tags($text);
$excerpt_length = apply_filters('excerpt_length', 16);
$excerpt_more = apply_filters('excerpt_more', '...');
$text = wp_trim_words( $text, $excerpt_length, $excerpt_more ); 

return apply_filters('wp_trim_excerpt', $text, $raw_excerpt); 
}


// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read More', 'html5blank') . '</a>';
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our Portfolio Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter ('wp_nav_menu','current_to_active');
add_filter('nav_menu_css_class', 'custom_wp_nav_menu'); // Remove Navigation <li> injected classes (Commented out by default)
add_filter('nav_menu_item_id', 'custom_wp_nav_menu'); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('page_css_class', 'custom_wp_nav_menu'); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_trim_all_excerpt');
// add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
// add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
// add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
// add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('fullwidth', 'fullwidth'); // Place [fullwidth] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [fullwidth] Here's the page title! [/fullwidth] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('products', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Products', 'html5blank'), // Rename these to suit
            'singular_name' => __('Product', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Product', 'html5blank'),
            'edit' => __('Edit Product', 'html5blank'),
            'edit_item' => __('Edit Product', 'html5blank'),
            'new_item' => __('New Product', 'html5blank'),
            'view' => __('View Product', 'html5blank'),
            'view_item' => __('View Product', 'html5blank'),
            'search_items' => __('Search Products', 'html5blank'),
            'not_found' => __('No Products found', 'html5blank'),
            'not_found_in_trash' => __('No Products found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_icon' => 'dashicons-cart',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function fullwidth($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    extract( shortcode_atts( array(
        'background' => 'transparent',
    ), $atts ) );

    return '<div class="folio-full" style="background:'. esc_attr($background) .'">' . $content . '</div>';
}

// suppress_filters for custom post types
function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'portfolio', 'nav_menu_item'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );


// change the login form
function custom_login_css() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login/login-styles.css" />';
}

add_action('login_head', 'custom_login_css');

// change logo link on login form
add_filter( 'login_headerurl', 'custom_login_header_url' );
    function custom_login_header_url($url) {
    return 'http://grantimbo.com/';
}