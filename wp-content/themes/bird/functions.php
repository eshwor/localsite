<?php
//Add styles and scripts :::::

function create_styles_now (){
  //wp_enqueue_style( 'style', get_stylesheet_uri() ); //default way
  wp_enqueue_style('style' , get_template_directory_uri() . '/dist/css/style.min.css', array(), '1.0.0', 'all');
  wp_enqueue_script('javascript' , get_template_directory_uri() . '/dist/js/global.min.js', array(), '1.0.0', true);
}
add_action( "wp_enqueue_scripts", "create_styles_now" );



?>
