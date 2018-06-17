<?php
if( post_password_required() ) {
  return;
}
?>

<div class="comment-box">
  <?php comment_form(); ?>
</div>
