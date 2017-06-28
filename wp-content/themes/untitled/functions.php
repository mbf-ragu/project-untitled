<?php 
/*****
For style
*****/
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );    
add_action('init', 'init_custom_load');
if (!defined('TMPL_URL')) {
    define('TMPL_URL', get_template_directory_uri());
}
function init_custom_load(){
    if(is_admin()) {
        wp_enqueue_style('admin_css', TMPL_URL.'/lib/css/admin_css.css', false, '1.0', 'all');
        wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
        wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_script('admin_js', TMPL_URL.'/js/lib/admin.js', false, '1.0', 'all');
    }
}
show_admin_bar(false);
require_once(TEMPLATEPATH . "/lib/admin-config.php");
/********
    Featured Image
********/
add_theme_support('post-thumbnails');
/*******
    Menu Backend
*******/
add_theme_support( 'menus' );
/******
    Multipost Thumbnail Image
******/
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(array(
        'label' => 'mobile image',
        'id' => 'mobileimage',
        'post_type' => 'banners'
        )
    );
}
/*******
    For Excerpt
*******/
add_post_type_support('page', 'excerpt');

/*******
    Register Extra Fields
*******/
function wooc_extra_register_fields() {
    ?>
    <div class="form-row">
        <label class="floating-item" data-error="Please enter your first name">
        <input type="text" class="floating-item-input input-item validate" name="first_name" id="first_name" value="<?php if ( ! empty( $_POST['first_name'] ) ) echo esc_attr( $_POST['first_name'] ); ?>" autocomplete="off" maxlength="75" onkeypress="return onlyAlphabets(event, this)"   />
        <span class="floating-item-label">FIRST NAME</span>
        </label>
    </div>

    <div class="form-row">
        <label class="floating-item" data-error="Please enter your last name">
        <input type="text" class="floating-item-input input-item validate" name="last_name" id="last_name" value="<?php if ( ! empty( $_POST['last_name'] ) ) echo esc_attr( $_POST['last_name'] ); ?>" autocomplete="off" maxlength="75" onkeypress="return onlyAlphabets(event, this)"/>
        <span class="floating-item-label">LAST NAME</span>
        </label>
    </div>

    <div class="form-row">
        <label class="floating-item" data-error="Please enter your telephone number">
        <input type="text" class="floating-item-input input-item validate" name="telephone" id="telephone" value="<?php if ( ! empty( $_POST['telephone'] ) ) echo esc_attr( $_POST['telephone'] ); ?>" autocomplete="off"  onkeypress="return isNumber(event)" maxlength="15" />
        <span class="floating-item-label">TELEPHONE</span>
        </label>
    </div>
    <?php
}
add_action( 'woocommerce_register_form_end', 'wooc_extra_register_fields' );
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }

    if ( isset( $_POST['last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( isset( $_POST['telephone'] ) ) {
        update_user_meta( $customer_id, 'telephone', sanitize_text_field( $_POST['telephone'] ) );
    }
    if ( isset( $_POST['newsletter'] ) ) {
        update_user_meta( $customer_id, 'newsletter', sanitize_text_field( $_POST['newsletter'] ) );
    }
}
  
function content_formatter($content) {

    $bad_content = array('<p></div></p>', '<p><div class="full', '_width"></p>', '</div></p>', '<p><ul', '</ul></p>', '<p><div', '<p><block', 'quote></p>', '<p><hr /></p>', '<p><table>', '<td></p>', '<p></td>', '</table></p>', '<p></div>', 'nosidebar"></p>', '<p><p>', '<p><a', '</a></p>', '_half"></p>', '_third"></p>', '_fourth"></p>', '<p><p', '</p></p>', 'child"></p>', '<p></p>');
    $good_content = array('</div>', '<div class="full', '_width">', '</div>', '<ul', '</ul>', '<div', '<block', 'quote>', '<hr />', '<table>', '<td>', '</td>', '</table>', '</div>', 'nosidebar">', '<p>', '<a', '</a>', '_half">', '_third">', '_fourth">', '<p', '</p>', 'child">', '');

    $new_content = str_replace($bad_content, $good_content, $content);
    return $new_content;
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 10);
add_filter('the_content', 'content_formatter', 11);

/*******
For empty paragraph
*******/
function shortcode_empty_paragraph_fix_tag($content) {
    $array = array(
        '<p>[' => '[',
        ']</p>' => ']',
        '<p></p>' => '',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
/******
For short code
******/
function dotlist( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="dotlist features">'.do_shortcode($content).'</div>';
}
add_shortcode('dotlist', 'dotlist');

add_action('wp_logout','logout_redirect');

function logout_redirect(){

    wp_redirect( home_url() );
    
    exit;

}
