<?php
add_action('admin_menu', 'author_meta_options');

function author_meta_options() {   
    add_meta_box('author_type_options', 'Author Meta', 'author_meta', 'press');
}

function author_meta($post_id) {
    global $post;
    $author_meta = get_post_meta($post->ID, 'author_meta', true);
    ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="author_meta">Author:</label></td>
            <td  class="right" >
                <input type="textbox" id="author_meta" name="author_meta" value="<?php echo $author_meta; ?>">
            </td>
        </tr>
    </table>
    <?php
}
add_action('save_post', 'author_meta_options_save');
function author_meta_options_save($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if(isset($_POST['author_meta'])){
        update_post_meta($post_id, 'author_meta',$_POST['author_meta']);
    }
   }
?>