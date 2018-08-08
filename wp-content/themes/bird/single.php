<?php get_header(); ?>


<?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
    //check if there is featured image or not
    if( has_post_thumbnail() ) :
      the_post_thumbnail('full', array('class' => 'image-class'));
    endif;
      the_content();
      if( comments_open() ){
        comments_template();
      }
    endwhile;
  else:
    echo wpautop('Sorry, No Post Found ! ');
  endif;
 ?>



<?php get_footer(); ?>
