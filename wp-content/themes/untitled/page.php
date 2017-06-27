<?php
get_header();
?>
 <div class="container subwrap">
 <ul class="breadcrumb">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
      ?>
      </ul>
   <div class="intro-text privacy_policy">
     <h1><?php echo $post->post_title;?></h1>
  <?php echo apply_filters('the_content',wpautop($post->post_content)); ?>
    </div>
  </div>
<?php get_footer(); ?>