<footer>
    <ul class="newsletter inline">
<?php
      $mainmenu_args = array(
      'order' => 'ASC', 
      'post_type' => 'nav_menu_item', 
      'post_status' => 'publish',
      'output' => ARRAY_A,
      'output_key' => 'menu_order', 
      'nopaging' => true,
      'update_post_term_cache' => false,
      'menu_item_parent' => 0);
      $mainmenu_items = wp_get_nav_menu_items('first_footermenu', $mainmenu_args);
      if(is_array($mainmenu_items) && count($mainmenu_items)>0){
      foreach ($mainmenu_items as $mainmenu_item) {
      ?>
      <li><a href="<?php echo $mainmenu_item->url; ?>" <?php if ($post->post_title==$mainmenu_item->title) { echo ' class="active" '; }?> ><?php echo $mainmenu_item->title; ?></a></li>
      <?php } } ?>
    </ul>


    <?php 
      $currentYear = date("Y");
      $designYear = 2017;
      $year = ($currentYear > $designYear) ? $designYear." - ".date("y") : $currentYear;
      ?>
 
  <div class="container">
    <ul class="socialmedia inline">
      <?php 
      $twitter_url=get_option('twitter');
      $facebook_url=get_option('facebook');
      $instagram_url=get_option('instagram');
      $feed_url=get_option('feed');
      ?>
      <?php if ($twitter_url): ?>
      <li>
      <a href="<?php echo $twitter_url; ?>" target="_blank">
      <img src="<?php echo get_bloginfo('template_url');?>/images/twitter.png" alt="twitter"></a>
      </li>
      <?php endif;?>
      <?php if ($facebook_url): ?>
      <li>
      <a href="<?php echo $facebook_url; ?>" target="_blank">
      <img src="<?php echo get_bloginfo('template_url');?>/images/facebook.png" alt="facebook"></a>
      </li>
      <?php endif;?>
      <?php if ($instagram_url): ?>
      <li>
      <a href="<?php echo $instagram_url; ?>" target="_blank">
      <img src="<?php echo get_bloginfo('template_url');?>/images/instagram.png" alt="instagram"></a>
      </li>
      <?php endif;?>
      <?php if ($feed_url): ?>
      <li>
      <a href="<?php echo $feed_url; ?>" target="_blank">
      <img src="<?php echo get_bloginfo('template_url');?>/images/feed.png" alt="feed"></a>
      </li>
      <?php endif;?>
    </ul>
    <ul class="copy inline text-center">
    <li>&#169; <?php echo $year; ?> VOGT STOCKHOLM AB. ALL RIGHTS RESERVED</li>
    <?php
      $second_footermenu_args = array(
            'order' => 'ASC', 
            'post_type' => 'nav_menu_item', 
            'post_status' => 'publish',
            'output' => ARRAY_A,
            'output_key' => 'menu_order', 
            'nopaging' => true,
            'update_post_term_cache' => false,
            'menu_item_parent' => 0);
      $footermenu_items = wp_get_nav_menu_items('second_footermenu', $second_footermenu_args);
       if(is_array($footermenu_items) && count($footermenu_items)>0){ 
      foreach ($footermenu_items as $footermenu_item) {
    ?>
    <li class="checkout-footer"><a href="<?php echo $footermenu_item->url; ?>" <?php if ($post->post_title==$footermenu_item->title) { echo ' class="active" '; }?>><?php echo $footermenu_item->title; ?></a></li>
    <?php } }?>
    </ul>
  </div>
</footer>
<?php wp_footer();  ?> 
<?php /*<script src="<?php echo TMPL_URL; ?>/js/build/global.min.js"></script> */ ?>
<script type="text/javascript">
  if(jQuery('.theme-globalerror .container').html().trim().length!=0){
    jQuery('.theme-globalerror').show();
  }
</script>

<script src="<?php echo TMPL_URL; ?>/js/lib/custom.js"></script>
<script src="<?php echo TMPL_URL; ?>/js/lib/validation.js"></script>

</body>
</html>