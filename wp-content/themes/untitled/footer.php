<footer>
    <ul class="newsletter inline">
    <?php
        $mainMenuArgs = array(
            'order' => 'ASC', 
            'post_type' => 'nav_menu_item', 
            'post_status' => 'publish',
            'output' => ARRAY_A,
            'output_key' => 'menu_order', 
            'nopaging' => true,
            'update_post_term_cache' => false,
            'menu_item_parent' => 0
        );
        $mainMenuItems = wp_get_nav_menu_items('first_footermenu', $mainMenuArgs);
        if (is_array($mainMenuItems) && count($mainMenuItems)>0 ){
            foreach ($mainMenuItems as $mainMenuItem) { 
    ?>
                <li><a href="<?php echo $mainMenuItem->url; ?>" <?php if ($post->post_title==$mainMenuItem->title ) { echo ' class="active" '; }?> ><?php echo $mainMenuItem->title; ?></a></li>
    <?php   }
        } 
    ?>
    </ul>
    <?php 
        $currentYear = date("Y");
        $designYear = 2017;
        $year = ($currentYear > $designYear) ? $designYear." - ".date("y") : $currentYear;
    ?>
    <div class="container">
        <ul class="copy inline text-center">
            <li>&#169; <?php echo $year; ?> UNTITLED PROJECT. ALL RIGHTS RESERVED</li>
            <?php
                $secondFooterMenuArgs = array(
                    'order' => 'ASC', 
                    'post_type' => 'nav_menu_item', 
                    'post_status' => 'publish',
                    'output' => ARRAY_A,
                    'output_key' => 'menu_order', 
                    'nopaging' => true,
                    'update_post_term_cache' => false,
                    'menu_item_parent' => 0);
                $footerMenuItems = wp_get_nav_menu_items('second_footermenu', $secondFooterMenuArgs);
                if (is_array($footerMenuItems) && count($footerMenuItems)>0 ){ 
                    foreach ($footerMenuItems as $footerMenuItem) {
            ?>
                        <li class="checkout-footer"><a href="<?php echo $footerMenuItem->url; ?>" <?php if ($post->post_title==$footerMenuItem->title ) { echo ' class="active" '; }?>><?php echo $footerMenuItem->title; ?></a></li>
            <?php   }
                }
            ?>
        </ul>
    </div>
</footer>
<?php wp_footer();  ?> 
<script src="<?php echo TMPL_URL; ?>/js/lib/custom.js"></script>
<script src="<?php echo TMPL_URL; ?>/js/lib/validation.js"></script>
</body>
</html>