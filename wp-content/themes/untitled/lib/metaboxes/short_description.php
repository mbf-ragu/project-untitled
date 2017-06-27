<?php
add_action('admin_menu', 'short_descriptions_meta_options');

function short_descriptions_meta_options() {   
    foreach (array('news_letter','press') as $type) {
        add_meta_box('short_descriptions_meta_options', 'Short Description', 'short_description', $type);
    }
}

function short_description($post_id) {
    global $post;
    $short_description = get_post_meta($post->ID, 'short_description', true);
    ?>
    <p class="left">Short Description</p>
            
<?php 
        $settings = array(
            'textarea_name' => 'short_description',
            'quicktags'     => array( 'buttons' => 'em,strong,link' ),
            'tinymce'       => array(
                'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons2' => '',
            ),
            'editor_css'    => '<style>#wp-short_description-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
        );

        wp_editor( htmlspecialchars_decode( $short_description ), 'short_description', apply_filters( 'woocommerce_product_short_description_editor_settings', $settings ) );
?>

    <?php
}
add_action('save_post', 'short_descriptions_meta_options_save');
function short_descriptions_meta_options_save($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if(isset($_POST['short_description'])){
        update_post_meta($post_id, 'short_description',$_POST['short_description']);
    }
   }
?>