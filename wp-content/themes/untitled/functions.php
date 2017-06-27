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

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/******
For post type:admin-config
******/
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

    <!-- <div class="form-row">
        <label class="floating-item" data-error="Please enter your telephone number">
        <input type="text" class="floating-item-input input-item validate" name="telephone" id="telephone" value="<?php if ( ! empty( $_POST['telephone'] ) ) echo esc_attr( $_POST['telephone'] ); ?>" autocomplete="off"  onkeypress="return isNumber(event)" maxlength="15" />
        <span class="floating-item-label">TELEPHONE</span>
        </label>
    </div> -->
    <?php
}
add_action( 'woocommerce_register_form_end', 'wooc_extra_register_fields' );
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
        // WordPress default first name field.
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }

    if ( isset( $_POST['last_name'] ) ) {
        // WordPress default last name field.
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
     // WooCommerce billing phone
    /*if ( isset( $_POST['telephone'] ) ) {
        update_user_meta( $customer_id, 'telephone', sanitize_text_field( $_POST['telephone'] ) );
    }*/

    if ( isset( $_POST['newsletter'] ) ) {
        update_user_meta( $customer_id, 'newsletter', sanitize_text_field( $_POST['newsletter'] ) );
    }

}
  
add_filter( 'woocommerce_checkout_fields' , 'custom_get_address_fields' );
function custom_get_address_fields( $fields ) {

    $fields['billing']['billing_email'] = array(
        'label'     => __('Email', 'woocommerce'),
        'class'       => array( 'floating-item '),
        'custom_attributes' => array( "maxlength" => "100"  ),
        'input_class'       => array( 'validate validate-email'),
        'required'  => true,
    );
    /*$fields['billing']['billing_phone'] = array(
        'label'     => __('Telephone', 'woocommerce'),
        'class'       => array( 'floating-item'),
        'required'  => true,
        'custom_attributes' => array( "maxlength" => "15" ,"onkeypress" => "return isNumber(event)"  ),
        'input_class'       => array( 'validate'),
        
    ); */ 
         $fields['shipping']['shipping_email'] = array(
        'label'     => __('Email', 'woocommerce'),
        'class'       => array( 'floating-item'),
        'input_class'       => array( 'validate validate-email'),
        'required'  => true,
    );
    /*$fields['shipping']['shipping_phone'] = array(
        'label'     => __('Telephone', 'woocommerce'),
        'class'       => array( 'floating-item'),
        'required'  => true,
        'custom_attributes' => array( "maxlength" => "15" ,"onkeypress" => "return isNumber(event)"  ),
        
    );*/
    $fields['order']['order_comments'] = array(
                'type' => 'textarea',
                'class' => array('notes textarea-row floating-item-input input-item'),
                'label' => __( 'Any delivery instructions?', 'woocommerce' ),
                'placeholder' => _x('For example: Preferred delivery time, who to deliver your package to if you are unavailable at the time of delivery, etc.', 'placeholder', 'woocommerce')
            );
        return $fields;

    }

add_filter( 'woocommerce_default_address_fields' , 'custom_get_default_address_fields' );
function custom_get_default_address_fields() {
        $fields = array(
            'first_name' => array(
                'label'    => __( 'FIRST NAME', 'woocommerce' ),
                'class'    => array( 'form-row floating-item' ),
                'input_class'       => array( 'validate'),
                'custom_attributes' => array( "maxlength" => "75" ,"onkeypress" => "return onlyAlphabets(event, this)"  ),
                'required' => true,
            ),
            'last_name' => array(
                'label'    => __( 'LAST NAME', 'woocommerce' ),
                'required' => true,
                'class'    => array( 'form-row floating-item' ),
                'input_class' => array( 'validate'),
                'custom_attributes' => array( "maxlength" => "75" ,"onkeypress" => "return onlyAlphabets(event, this)"  ),
                'clear'    => true
            ),
            'email' => array(
                'label'    => __( 'EMAIL', 'woocommerce' ),
                'required' => true,
                'class'    => array( 'form-row floating-item' ),
                'input_class'       => array( 'validate  validate-email'),
                'clear'    => true
            ),
            /*'phone' => array(
                'label'    => __( 'TELEPHONE', 'woocommerce' ),
                'type'     => 'text',
                'required' => true,
                'class'    => array( 'form-row floating-item' ),
                'custom_attributes' => array( "maxlength" => "15" ,"onkeypress" => "return isNumber(event)"),
                'input_class'       => array( 'validate'),
                'clear'    => true
            ),*/
            
            'address_1' => array(
                'label'       => __( 'ADDRESS', 'woocommerce' ),
                'type'     => 'textarea',
                'required'    => true,
                'input_class'       => array( 'input-item validate'),
                'custom_attributes' => array( "maxlength" => "49" ),
                'class'       => array( 'form-row floating-item', 'address-field' )
            ),
            'city' => array(
                'label'       => __( 'CITY', 'woocommerce' ),
                'required'    => true,
                'class'       => array( 'form-row floating-item', 'address-field' ),
                'custom_attributes' => array("onkeypress" => "return blockSpecialChar(event)"  ),
                'input_class'       => array( 'validate'),
            ),
            'state' => array(
                'label'       => __( 'STATE/COUNTY', 'woocommerce' ),
                'type'        => 'state',
                'required'    => true,
                'class'       => array( 'form-row floating-item', 'address-field' ),
                // 'input_class'       => array( 'validate'),
                'custom_attributes' => array("onkeypress" => "return blockSpecialChar(event)"  ),
            ),
           
            'country' => array(
                'type'     => 'country',
                'label'    => __( 'COUNTRY', 'woocommerce' ),
                'required' => true,
                'class'    => array( 'form-row floating-item select-row', 'address-field', 'update_totals_on_change' ),
                'custom_attributes' => array("onkeypress" => "return blockSpecialChar(event)"  ),
            ),

            'postcode' => array(
                'label'       => __( 'POSTCODE ', 'woocommerce' ),
                'required'    => true,
                'class'       => array( 'form-row floating-item', 'address-field' ),
                'input_class'       => array( 'validate'),
                'custom_attributes' => array("onkeypress" => "return blockSpecialChar(event)"  ),
                'clear'       => true,
           
            ),

        );
        return $fields;
    }
    /********
    Save telephone field in edit-account address
    ********/

/*add_action( 'woocommerce_save_account_details', 'my_woocommerce_save_account_details' );
 
function my_woocommerce_save_account_details( $current_user ) {
 $current_user=get_current_user_id();
  update_user_meta( $current_user, 'telephone', $_POST[ 'telephone' ]);
}*/
function content_formatter($content) {

    $bad_content = array('<p></div></p>', '<p><div class="full', '_width"></p>', '</div></p>', '<p><ul', '</ul></p>', '<p><div', '<p><block', 'quote></p>', '<p><hr /></p>', '<p><table>', '<td></p>', '<p></td>', '</table></p>', '<p></div>', 'nosidebar"></p>', '<p><p>', '<p><a', '</a></p>', '_half"></p>', '_third"></p>', '_fourth"></p>', '<p><p', '</p></p>', 'child"></p>', '<p></p>');
    $good_content = array('</div>', '<div class="full', '_width">', '</div>', '<ul', '</ul>', '<div', '<block', 'quote>', '<hr />', '<table>', '<td>', '</td>', '</table>', '</div>', 'nosidebar">', '<p>', '<a', '</a>', '_half">', '_third">', '_fourth">', '<p', '</p>', 'child">', '');

    $new_content = str_replace($bad_content, $good_content, $content);
    return $new_content;
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 10);
add_filter('the_content', 'content_formatter', 11);

add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_title', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
// add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_meta', 10 );
add_action( 'woocommerce_custom_single_product_summary', 'woocommerce_template_single_sharing', 10 );
add_filter('the_content', 'content_formatter', 11);

function get_variation_data_from_variation_id( $item_id ) {
    $_product = new WC_Product_Variation( $item_id );
    $variation_data = $_product->get_variation_attributes();
    $variation_detail = woocommerce_get_formatted_variation( $variation_data, true );  // this will give all variation detail in one line
    // $variation_detail = woocommerce_get_formatted_variation( $variation_data, false);  // this will give all variation detail one by one
    return $variation_detail; // $variation_detail will return string containing variation detail which can be used to print on website
    // return $variation_data; // $variation_data will return only the data which can be used to store variation data
}

// for color picker
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_color_fields', 10, 2 );
function save_variation_settings_color_fields($post_id){
    $variation_color = $_POST[$post_id.'_color'];
    if( ! empty( $variation_color ) ) {
        update_post_meta( $post_id, $post_id.'_color', esc_attr( $variation_color ) );
    }
}

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

/**
 * Only display minimum price for WooCommerce variable products
 **/
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
 
function custom_variation_price( $price, $product ) {
     $price = '';
     $price .= woocommerce_price($product->get_price());
     return $price;
}

add_filter('wpseo_title', 'filter_product_wpseo_title');
function filter_product_wpseo_title($title) {
    $title = "sample title";
    return $title;
}

function changeTitle( $title ) {
   // Return a custom document title for
   // the boat details custom page template

   if ( is_wc_endpoint_url( 'lost-password' ) ) {
       return 'Forgot Password';
   }
   // Otherwise, don't modify the document title
   return $title;
}
add_filter( 'wp_title', 'changeTitle',0 );

add_action('wp_logout','logout_redirect');

function logout_redirect(){

    wp_redirect( home_url() );
    
    exit;

}

// WooCommerce Checkout Fields Hook
add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );
 
// Change order comments placeholder and label, and set billing phone number to not required.
function custom_wc_checkout_fields( $fields ) {
$fields['billing']['billing_state']['label'] = 'STATE / COUNTY';
return $fields;
}

if ( ! function_exists( 'woocommerce_register_form' ) ) {
    function woocommerce_register_form( $args = array() ) {
        $defaults = array(
            'message'  => '',
            'redirect' => '',
            'hidden'   => false
        );
        $args = wp_parse_args( $args, $defaults  );
        woocommerce_get_template( 'shop/form-register.php', $args );
    }
}

add_filter( 'default_checkout_country', 'change_default_checkout_country' );

function change_default_checkout_country() {
  return 'GB'; // country code
}
/*******
Short code for generic page
*******/
function break_tag( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<br />';
}
add_shortcode('break_tag', 'break_tag');

function full_image( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="full-image">'.do_shortcode($content).'</div>';
}
add_shortcode('full_image', 'full_image');

function caption_image( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="captionimage">'.do_shortcode($content).'</div>';
}
add_shortcode('caption_image', 'caption_image');

function ul_dotlist( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="dotlist">'.do_shortcode($content).'</div>';
}
add_shortcode('ul_dotlist', 'ul_dotlist');

function accordion( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion', 'accordion');

function accordion_item( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion__item">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_item', 'accordion_item');

function accordion_title( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<h3 class="accordion__title">'.do_shortcode($content).'</h3>';
}
add_shortcode('accordion_title', 'accordion_title');

function accordion_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion__copy">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_content', 'accordion_content');

add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name", 
        "billing_email", 
        /*"billing_phone",*/
        "billing_address_1", 
        "billing_city", 
        "billing_state", 
        "billing_country", 
        "billing_postcode"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}
add_action( 'user_register', 'tele_registration_save', 10, 1 );

/*function tele_registration_save( $user_id ) {

    if ( isset( $_POST['billing_phone'] ) )
        update_user_meta($user_id, 'telephone', $_POST['billing_phone']);

}*/
function custom_override_checkout_fields_ek( $fields ) {
unset($fields['billing']['billing_phone']);
return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_ek', 99 );

?>
