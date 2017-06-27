<?php add_action('init', 'create_collection', 0);

function create_collection() {
    $labels = array(
        'name' => _x('Collection', 'post type general name'),
        'singular_name' => _x('Collection', 'post type singular name'),
        'add_new' => _x('Add Collection', 'Collection'),
        'add_new_item' => __('Add Collection'),
        'edit_item' => __('Edit Collection'),
        'new_item' => __('New Collection'),
        'view_item' => __('View Collection'),
        'search_items' => __('Search Collection'),
        'not_found' => __('No Collection found'),
        'not_found_in_trash' => __('No Collection found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'collection','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('collection', $args);
    register_taxonomy("collection_cat", "collection", array("hierarchical" => true,
        "label" => "Collection Categories",
        "singular_label" => "Collection",
        'rewrite' => array('slug' => 'collection','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>