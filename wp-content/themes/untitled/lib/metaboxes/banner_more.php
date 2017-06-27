<?php
add_action('admin_menu', 'page_url_det');

function page_url_det() {
    add_meta_box('Home Banner Link', 'Home Banner Link', 'banners', 'banners');
}

function banners($post_id) {
    global $post;
    global $wpdb;
    $see_more_url = get_post_meta($post->ID, 'see_more_url', true);
    ?>
			<p class="left">See More Url*</p>
            <input type="text" name="see_more_url" style="min-width: 700px;" value="<?php echo $see_more_url;?>" />
    <?php
}


add_action('save_post', 'save_page_url');

function save_page_url($post_id) {
    global $post;
    if (get_post_type($post_id) == 'banners' && isset($_POST['see_more_url'])) {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
        update_post_meta($post_id, 'see_more_url', $_POST['see_more_url']);
    }
}
?>