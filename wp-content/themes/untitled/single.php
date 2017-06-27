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
      <div class="intro-text">
      <?php echo apply_filters('the_content',$post->post_content ); ?>
      </div>
    </div>
<?php 
get_footer(); 
?>
