<?php
add_action('admin_menu', 'product_meta_dis');

function product_meta_dis() {
    add_meta_box('Product Details', 'Product Details', 'product_meta_fields', 'product');
}

function product_meta_fields($post_id) {
    global $post;
    global $wpdb;
    $measurements = get_post_meta($post->ID, 'measurements', true);
    $features = get_post_meta($post->ID, 'features', true);
    ?>
            <p class="left">MEASUREMENTS</p>
            
<?php 
        $settings = array(
            'textarea_name' => 'measurements',
            'quicktags'     => array( 'buttons' => 'em,strong,link' ),
            'tinymce'       => array(
                'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons2' => '',
            ),
            'editor_css'    => '<style>#wp-measurements-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
        );

        wp_editor( htmlspecialchars_decode( $measurements ), 'measurements', apply_filters( 'woocommerce_product_short_description_editor_settings', $settings ) );?>
			<p class="left">FEATURES</p>
            <?php 
        $settings = array(
            'textarea_name' => 'features',
            'quicktags'     => array( 'buttons' => 'em,strong,link' ),
            'tinymce'       => array(
                'theme_advanced_buttons3' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons4' => '',
            ),
            'editor_css'    => '<style>#wp-features-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
        );

        wp_editor( htmlspecialchars_decode( $features ), 'features', apply_filters( 'woocommerce_product_short_description_editor_settings', $settings ) );?>
    <?php
}


add_action('save_post', 'save_product_meta');

function save_product_meta($post_id) {
    global $post;
    if (get_post_type($post_id) == 'product') {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
        if(isset($_POST['measurements'])){
            update_post_meta($post_id, 'measurements', $_POST['measurements']);
        }
        if(isset($_POST['features'])){
            update_post_meta($post_id, 'features', $_POST['features']);
        }
    }
}
?>