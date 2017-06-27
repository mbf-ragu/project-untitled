<?php

add_action('admin_menu', 'short_code');

function short_code() {
foreach (array('work_with_us','banners','product','page','post','news_letter','retailers','press') as $type) {
       add_meta_box('shortcodes', 'Short codes', 'short_codes_fn', $type);
   }
}
function short_codes_fn($post_id) {
    global $post;
    ?>

    <table class="shtCode" style="width:100%">
        <tr>
            <th class="left"><label for="image_left_aside">Short Codes</label></th>
            <th  class="right" ><p>Description</p></th>
    </tr>
    <tr>
        <td class="left">[dotlist]</td>
        <td  class="right" ><p>Style for list</p></td>
    </tr>
    <tr>
        <td class="left">[break_tag]</td>
        <td  class="right" ><p>For break tag</p></td>
    </tr>
    <tr>
        <td class="left">[full_image]</td>
        <td  class="right" ><p>For full image</p></td>
    </tr>
    <tr>
        <td class="left">[caption_image]</td>
        <td  class="right" ><p>For caption below the full image</p></td>
    </tr>
    <tr>
        <td class="left">[ul_dotlist]</td>
        <td  class="right" ><p>For unordered list with class</p></td>
    </tr>
    <tr>
        <td class="left">[accordion]</td>
        <td  class="right" ><p>For accordion</p></td>
    </tr>
    <tr>
        <td class="left">[accordion_item]</td>
        <td  class="right" ><p>For accordion list</p></td>
    </tr>
    <tr>
        <td class="left">[accordion_title]</td>
        <td  class="right" ><p>For accordion title</p></td>
    </tr>
    <tr>
        <td class="left">[accordion_content]</td>
        <td  class="right" ><p>For accordion content</p></td>
    </tr>
    </table>
    <?php
}
?>