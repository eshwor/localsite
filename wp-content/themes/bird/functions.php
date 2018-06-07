<?php
//Add styles and scripts :::::

function create_styles_now (){
  wp_enqueue_style( 'style', get_stylesheet_uri() ); //default way
}
add_action( "wp_enqueue_scripts", "create_styles_now" );



?>
