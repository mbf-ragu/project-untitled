<?php add_action('init', 'create_press', 0);

function create_press() {
    $labels = array(
        'name' => _x('Press', 'post type general name'),
        'singular_name' => _x('Press', 'post type singular name'),
        'add_new' => _x('Add Press', 'Press'),
        'add_new_item' => __('Add Press'),
        'edit_item' => __('Edit Press'),
        'new_item' => __('New Press'),
        'view_item' => __('View Press'),
        'search_items' => __('Search Press'),
        'not_found' => __('No Press found'),
        'not_found_in_trash' => __('No Press found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'press','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('press', $args);
    register_taxonomy("press_cat", "press", array("hierarchical" => true,
        "label" => "Press Categories",
        "singular_label" => "Press",
        'rewrite' => array('slug' => 'press','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>