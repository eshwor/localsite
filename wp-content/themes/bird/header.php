<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(array('main-class')); ?>>

      <nav id="main-menu" class="main-menu">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'Primary-Menu',
              'container_class'  =>  'parent_menu'
            )
          );
         ?>
      </nav>
    <hr>
    <main>
