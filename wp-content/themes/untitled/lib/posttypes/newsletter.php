<?php add_action('init', 'create_news_letter', 0);

function create_news_letter() {
    $labels = array(
        'name' => _x('News Letter', 'post type general name'),
        'singular_name' => _x('News Letter', 'post type singular name'),
        'add_new' => _x('Add News Letter', 'News Letter'),
        'add_new_item' => __('Add News Letter'),
        'edit_item' => __('Edit News Letter'),
        'new_item' => __('New News Letter'),
        'view_item' => __('View News Letter'),
        'search_items' => __('Search News Letter'),
        'not_found' => __('No News Letter found'),
        'not_found_in_trash' => __('No News Letter found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news_letter','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('news_letter', $args);
    register_taxonomy("news_letter_cat", "news_letter", array("hierarchical" => true,
        "label" => "News Letter Categories",
        "singular_label" => "News Letter",
        'rewrite' => array('slug' => 'news_letter','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>