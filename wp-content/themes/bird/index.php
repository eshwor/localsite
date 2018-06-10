<?php get_header(); ?>

<!-- <h2>Example of Custome Query Post</h2> -->
<?php
//Custom Query Post Override //Need To Learn More About It
// $args = array(
//   'type'  =>  'post',
//   'posts_per_page'  => 4,
// );
// $the_query = new WP_Query( $args );
// if ($the_query->have_posts()) :
//   while ($the_query->have_posts()) : $the_query->the_post();
//     the_content();
//   endwhile;
// else:
//   echo "No Post fount !!";
// endif;
// wp_reset_postdata();
 ?>



<?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
    //check if there is featured image or not
    if( has_post_thumbnail() ) :
      the_post_thumbnail('medium', array('class' => 'image-class'));
    endif;
      ?>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <?php
      the_content();
    endwhile;
    ?>
  
    <?php
  else:
    echo wpautop('Sorry, No Post Found ! ');
  endif;

 ?>










<?php get_footer(); ?>
