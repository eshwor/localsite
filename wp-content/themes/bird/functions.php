<?php
//Add styles and scripts :::::

function create_styles_now (){
  //wp_enqueue_style( 'style', get_stylesheet_uri() ); //default way
  wp_enqueue_style('style' , get_template_directory_uri() . '/dist/css/style.min.css', array(), '1.0.0', 'all');
  wp_enqueue_script('javascript' , get_template_directory_uri() . '/dist/js/global.min.js', array(), '1.0.0', true);
}
add_action( "wp_enqueue_scripts", "create_styles_now" );


//Register the menu

function register_menu() {
  //register_nav_menu('Primary-Menu', __('Primary Menu'));
  register_nav_menus(
    array(
      'Primary-menu'    =>  __('Primary Menu'),
      'Secondary-menu'  =>  __('Secondary Menu')
    )
  );
}
add_action('init', 'register_menu' );

//Post Thumbnails
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, array( 'left', 'center')  ); //Reset the thumbnail size

//Register sidebar // widget
function my_register_sidebar() {
  register_sidebar(
    array(
      'name'  =>  'Sidebar',
      'id'    =>  'sidebar-1',
      'class' =>  'sidebar-1',
      'description' =>  'Standard Sidebar',
      'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  =>  '</aside>',
      'before_title'  =>  '<h1 class="widget-title">',
      'after_title'   =>  '</h1>',
    )
  );
}
add_action('widgets_init','my_register_sidebar');

//Register Custom Post Type
function create_post_type() {
  $labels = array(
    'name'                    =>  'Portfolio',
    'singular_name'           =>  'Portfolio',
    'add_new'                 =>  'Add New',
    'add_new_item'            =>  'Add New Item',
    'edit_item'               =>  'Edit Item',
    'new_item'                =>  'New Item',
    'view_item'               =>  'View Item',
    'view_items'              =>  'View Items',
    'search_items'            =>  'Search Portfolio',
    'not_found'               =>  'Portfolio not found',
    'not_found_in_trash'      =>  'Portfolio not found in trash',
    'parent_item_colon'       =>  'Parent Item',
    'all_items'               =>  "All Items",
    'archives'                =>  'All Posts',
    'attribues'               =>  'Page Attributes',
    'insert_into_item'        =>  'insert into page',
    'uploaded_to_this_item'   =>  'Uploaded to this page',
    'featured_image'          =>  'Featured Image',
    'set_featured_image'      =>  'Set featured image',
    'remove_featured_image'   =>  'Remove featured image',
    'use_featured_image'      =>  'Use as featured image',
  );

  $args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

  register_post_type( 'Portfolio', $args );
}
add_action( 'init', 'create_post_type' );








?>
