<?php add_action('init', 'create_work_with_us', 0);

function create_work_with_us() {
    $labels = array(
        'name' => _x('Work with us', 'post type general name'),
        'singular_name' => _x('Work with us', 'post type singular name'),
        'add_new' => _x('Add Work with us', 'Work with us'),
        'add_new_item' => __('Add Work with us'),
        'edit_item' => __('Edit Work with us'),
        'new_item' => __('New Work with us'),
        'view_item' => __('View Work with us'),
        'search_items' => __('Search Work with us'),
        'not_found' => __('No Work with us found'),
        'not_found_in_trash' => __('No Work with us found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'work_with_us','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('work_with_us', $args);
    register_taxonomy("work_with_us_cat", "work_with_us", array("hierarchical" => true,
        "label" => "Work with us Categories",
        "singular_label" => "Work with us",
        'rewrite' => array('slug' => 'work_with_us','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>