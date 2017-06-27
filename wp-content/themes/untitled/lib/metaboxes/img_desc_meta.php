<?php
add_action('admin_menu', 'img_size');
function img_size() {
    add_meta_box('img_size', 'Options', 'work_with_us_fn', 'work_with_us','side');
    add_meta_box('img_size', 'Options', 'banners_fn', 'banners','side');
    add_meta_box('img_size', 'Options', 'product_fn', 'product','side');
    add_meta_box('img_size', 'Options', 'page_fn', 'page','side');
    add_meta_box('img_size', 'Options', 'post_fn', 'post','side');
    add_meta_box('img_size', 'Options', 'news_letter_fn', 'news_letter','side');
    add_meta_box('img_size', 'Options', 'retailers_fn', 'retailers','side');
    add_meta_box('img_size', 'Options', 'press_fn', 'press','side');
}

function work_with_us_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:436*546</label></td>
        </tr>
    </table>
    <?php
}
function banners_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Desktop Image size:1660*790</label></td>
            <td class="left"><label for="url_link">Mobile Image size:750*1040</label></td>
        </tr>
    </table>
    <?php
}
function product_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:436*546</label></td>
        </tr>
    </table>
    <?php
}
function page_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:436*546</label></td>
        </tr>
    </table>
    <?php
}
function post_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:436*546</label></td>
        </tr>
    </table>
    <?php
}
function news_letter_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:260*174</label></td>
        </tr>
    </table>
    <?php
}
function retailers_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:260*174</label></td>
        </tr>
    </table>
    <?php
}
function press_fn($post_id) { ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="url_link">Image size:260*174</label></td>
        </tr>
    </table>
    <?php
}
?>