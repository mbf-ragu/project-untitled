<?php
ob_start();
global $wpdb;
if(isset($_REQUEST['export']) && $_REQUEST['export'] == 'newsletter_list'):
    /*
     * #Export (Currency Orders)
     */
    $file_name = 'newsletter_list_'.date("M_d_Y_H_i").'.csv';
    $field_args = array(
        'first_name'=> 'FIRST NAME',
        'last_name'=> 'LAST NAME',
        'user_email '  => 'EMAIL',
        'telephone '  => 'TELEPHONE'
    );

    // Send Header info.
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename='".$file_name."'");
    
    $fh = fopen('php://output', 'w');
    
    // Send Export file columns.
    fputcsv($fh, $field_args);
   
    // Read from Database.
    $users =  get_users(
      array(
       'meta_key' => 'newsletter',
       'meta_value' => 'on',
       'number' => -1,
       'count_total' => false
      )
    );
    $user_count = count($users);
    
    if($user_count > 0):
            // Write to export file.
            foreach($users as $x=>$row):
                $id =$row->ID;
                $user_info = get_userdata($id);
                $line = array();
                $line[] = $user_info->first_name;
                $line[] = $user_info->last_name;
                $line[] = $user_info->user_email;
                $line[] = $user_info->telephone;
                fputcsv($fh, $line);
            endforeach;
    else:
        fputcsv($fh, array('No results found!.'));
    endif;
    exit;
endif; /** Export - End **/
add_action('admin_menu', 'newsletter_ip_list');

function newsletter_ip_list() {
    add_menu_page('Newsletter List', 'Newsletter List', 'add_users', 'newsletter_listing.php', 'newsletter_list');
}

function newsletter_list() {
        global $wpdb;
?>
<style type="text/css">
        wp-list-table
        {
            border-collapse:collapse;
            text-align: left;
        }
        table,th, td
        {
            border: 1px solid black !important;
        }
        td
        {
            border-left:  1px solid black !important;
        }
        th{
            text-align: right;
        }
    </style>
    
    
<div class="wrap">
    <h2 style="float:left; clear: both;">Newsletter List</h2>
    <span style="float:right; margin-bottom: 29px; margin-top: 9px;"><a href="?page=<?php echo $_REQUEST['page']?>&export=newsletter_list" id="export-newsletter_list" class="button" >Export</a></span>
   <table class="wp-list-table widefat fixed posts">
      <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Telephone</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php
            $users =  get_users(
                  array(
                   'meta_key' => 'newsletter',
                   'meta_value' => 'on',
                   'number' => -1,
                   'count_total' => false
                  )
                );
            $rows = $users;
            $pagination = new pagination();
            $paged_rows = $pagination->generate($rows, 30);
            foreach($users as $user) {
                $id =$user->ID;
                $user_info = get_userdata($id);
            ?>             
                <tr valign="top" class="<?php echo $class; ?>">            
                    <td><?php echo $user_info->first_name; ?></td>
                    <td><?php echo $user_info->last_name; ?></td>
                    <td><?php echo $user_info->user_email; ?></td>
                    <td><?php echo $user_info->telephone; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php
    echo '<ul class="pagination">';
    echo $pagination->links();
    echo '</ul>';?>
</div>

<?php   }
?>
