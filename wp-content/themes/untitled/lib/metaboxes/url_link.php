<?php
add_action('admin_menu', 'common_url');

function common_url() {
    foreach (array('news_letter','retailers','press') as $type) {
        add_meta_box('common_url', 'Options', 'common_url_design', $type);
    }
}

function common_url_design($post_id) {
    global $post;
    $url_link = get_post_meta($post->ID, 'url_link', true); 
    ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Url:</label></td>
            <td  class="right" >
                <input type="textbox" id="url_link" name="url_link" value="<?php echo $url_link; ?>">
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post', 'save_common_url');

function save_common_url($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if(isset($_POST['url_link']) && $_POST['url_link']!=""){
    if(strpos($_POST['url_link'],'http') !== false ){
        update_post_meta($post_id, 'url_link', $_REQUEST['url_link']);
    }else{
        update_post_meta($post_id, 'url_link', 'https://'.$_REQUEST['url_link']);    
   }
 }
 elseif(isset($_POST['url_link']))
 {
    update_post_meta($post_id, 'url_link', ''); 
 }
}
?>