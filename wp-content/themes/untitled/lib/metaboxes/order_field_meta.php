<?php
add_action('admin_menu', 'product_meta');

function product_meta() {
    add_meta_box('Order Link', 'Order Link', 'product', 'product');
}

function product($post_id) {
    global $post;
    global $wpdb;
    $order_meta_field = get_post_meta($post->ID, 'order_meta_field', true);
    ?>
			<p class="left">Order</p>
            <input type="text" name="order_meta_field" style="min-width: 700px;" value="<?php echo $order_meta_field;?>" />
    <?php
}


add_action('save_post', 'save_order_url');

function save_order_url($post_id) {
    global $post;
    if (get_post_type($post_id) == 'product' && isset($_POST['order_meta_field'])) {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
        update_post_meta($post_id, 'order_meta_field', $_POST['order_meta_field']);
    }
}
?>