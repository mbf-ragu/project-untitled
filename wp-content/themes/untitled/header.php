<?php
    $link_array = explode('/',$_SERVER['REQUEST_URI']);
    $page_title=$link_array[count($link_array)-2];

    if (!is_user_logged_in() && !in_array("forgot-password", $link_array) && in_array("dashboard", $link_array)) {
        header('Location: '.get_bloginfo('url').'/login/');
    }

    if ((is_user_logged_in() && in_array("forgot-password", $link_array)) || (strpos($page_title,'login') !== false && is_user_logged_in())) {
        header('Location: '.get_bloginfo('url').'/dashboard/');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>
            <?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
        </title>
        <!-- Bootstrap -->
        <link href="<?php echo TMPL_URL; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo TMPL_URL; ?>/style.css" rel="stylesheet">
        <!-- Modernizr -->
        <script src="<?php echo TMPL_URL; ?>/js/lib/modernizr.min.js"></script>
        <script src="<?php echo TMPL_URL; ?>/js/build/global.min.js"></script>
        <script src="<?php echo TMPL_URL; ?>/js/lib/ripple.min.js"></script>
        <script src="<?php echo TMPL_URL; ?>/js/lib/custom.js"></script>
        <script src="<?php echo TMPL_URL; ?>/js/lib/jquery.form.js"></script>
        <?php  wp_head(); ?>
        <noscript>
            <style>
                body{
                    opacity: 1;
                }
            </style>
        </noscript>
        <script type="text/javascript">
          var blogUri = "<?php echo get_bloginfo('url'); ?>";
        </script>
    </head>
    <body <?php body_class(); ?>>
        <header>
        <?php $id = get_the_ID();   ?>
            <div class="header-inner">
                <div class="container">
                    <div id="navTrigger">
                        <span><!-- --></span>
                    </div>
                    <a href="<?php echo get_bloginfo('url'); ?>/" class="logo">
                        <img src="<?php echo get_bloginfo('template_url');?>/images/logo.png" alt="images">
                    </a>
                    <script type="text/javascript">
                        var user_id = "<?php echo get_current_user_id(); ?>";
                    </script>
                    <div class="fR">
                        <nav>
                            <ul class="inline">
                                <?php
                                    $mainmenu_args = array(
                                        'order' => 'ASC', 
                                        'post_type' => 'nav_menu_item', 
                                        'post_status' => 'publish',
                                        'output' => ARRAY_A,
                                        'output_key' => 'menu_order', 
                                        'nopaging' => true,
                                        'update_post_term_cache' => false,
                                        'menu_item_parent' => 0
                                    );
                                    $mainmenu_items = wp_get_nav_menu_items('mainmenu', $mainmenu_args);
                                    if(is_array($mainmenu_items) && count($mainmenu_items)>0){
                                        foreach ($mainmenu_items as $mainmenu_item) { 
                                ?>
                                <li><a href="<?php echo $mainmenu_item->url; ?>" <?php if ($post->post_title==$mainmenu_item->title) { echo ' class="active" '; }?> ><?php echo $mainmenu_item->title; ?></a></li>
                                <?php 
                                        } 
                                    } 
                                ?>
                                <?php if(is_user_logged_in()){ ?>
                                    <li class="userblk-mobile"><a href="<?php echo get_bloginfo('url'); ?>/dashboard/">Dashboard</a></li>
                                    <li class="userblk-mobile"><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                                <?php }else{ ?>
                                    <li class="userblk-mobile"><a href="<?php echo get_bloginfo('url'); ?>/login/">Login</a></li>
                                    <li class="userblk-mobile"><a href="<?php echo get_bloginfo('url'); ?>/register/">Register</a></li>
                                <?php } ?>
                            </ul>
                            <img src="<?php echo get_bloginfo('template_url');?>/images/nav-close.png" alt="images" class="close-icon" />
                        </nav>
                        <ul class="cart inline">
                            <li class="user_blk">
                                <a href="javascript:void(0)"><img src="<?php echo get_bloginfo('template_url');?>/images/user.png" alt="images" /></a>
                                <div class="userbox">
                                    <h5>YOUR ACCOUNT</h5>
                                    <p>Access account and manage orders</p>
                                    <?php if(is_user_logged_in()){?>
                                        <a href="<?php echo get_bloginfo('url'); ?>/dashboard/" class="btn btn-primary">Dashboard</a>
                                        <a href="<?php echo wp_logout_url(); ?>" class="btn">Logout</a>
                                    <?php } else {  ?>
                                        <a href="<?php echo get_bloginfo('url'); ?>/login/" class="btn btn-primary">Login</a>
                                        <a href="<?php echo get_bloginfo('url'); ?>/register/" class="btn">Register</a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
