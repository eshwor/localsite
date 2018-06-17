<?php
/* Template Name: Flex Layout
* @author: Ishwor
*/
?>

<?php get_header(); ?>

<?php

if ( have_rows('flex_layout')) :
  while ( have_rows('flex_layout')) : the_row();

    if ( get_row_layout() == 'default_layout') :
      echo $content = get_sub_field('content');
    endif;


    if ( get_row_layout() == 'full_width_layout') :
      echo $content = get_sub_field('content');
      $image = get_sub_field('image');
      // echo '<img alt="'.$image['alt'].'" src="'.$image['url'].'"/>';
    endif;

  endwhile;
endif;
?>

<!-- Select Options  -->
<?php $class_name = get_field('select_option'); ?>



<style media="screen">
  .full-full_width_layout {
    min-height: 20em;
    width: 100%;
    border-top: 5px solid black;
    border-bottom: 5px solid black;
  }

  .red {
    background: red;
    color:white;
    padding: 3em;
  }
  .green {
    background: green;
    color:white;
    padding: 3em;
  }
  .blue {
    background: blue;
    color:white;
    padding: 3em;
  }
  h1{
    text-align: center;
  }
</style>
<div class="full-full_width_layout" style="background-image:url(<?php echo $image['url']; ?>); background-repeat: no-repeat; background-size: cover;">
<h1>Background Bird Picture</h1>
</div>


<div class="<?php echo $class_name; ?>">
  <h1>You Have Select <span style="text-decoration:underline;"><?php echo ucfirst($class_name); ?></span> Background</h1>
</div>



<?php get_footer(); ?>
