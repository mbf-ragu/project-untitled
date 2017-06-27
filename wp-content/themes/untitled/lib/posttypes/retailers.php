<?php add_action('init', 'create_retailers', 0);

function create_retailers() {
    $labels = array(
        'name' => _x('Retailers', 'post type general name'),
        'singular_name' => _x('Retailers', 'post type singular name'),
        'add_new' => _x('Add Retailers', 'Retailers'),
        'add_new_item' => __('Add Retailers'),
        'edit_item' => __('Edit Retailers'),
        'new_item' => __('New Retailers'),
        'view_item' => __('View Retailers'),
        'search_items' => __('Search Retailers'),
        'not_found' => __('No Retailers found'),
        'not_found_in_trash' => __('No Retailers found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'retailers','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('retailers', $args);
    register_taxonomy("retailers_cat", "retailers", array("hierarchical" => true,
        "label" => "Retailers Categories",
        "singular_label" => "Retailers",
        'rewrite' => array('slug' => 'retailers','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>