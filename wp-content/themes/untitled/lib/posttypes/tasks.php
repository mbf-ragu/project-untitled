<?php add_action('init', 'create_tasks', 0);

function create_tasks() {
    $labels = array(
        'name' => _x('Tasks', 'post type general name'),
        'singular_name' => _x('Task', 'post type singular name'),
        'add_new' => _x('Add Task', 'Task'),
        'add_new_item' => __('Add Task'),
        'edit_item' => __('Edit Task'),
        'new_item' => __('New Task'),
        'view_item' => __('View Task'),
        'search_items' => __('Search Tasks'),
        'not_found' => __('No Tasks found'),
        'not_found_in_trash' => __('No Tasks found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'task','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('tasks', $args);
    register_taxonomy("tasks_cat", "tasks", array("hierarchical" => true,
        "label" => "Task Categories",
        "singular_label" => "Task",
        'rewrite' => array('slug' => 'task','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>