<?php
add_action('admin_menu', 'theme_menu');

function theme_menu() {
    add_menu_page('VOGT Theme Options', 'Theme Options', 'administrator', 'options_page', 'theme_options_page');
}
function theme_options_page() {
    if (isset($_REQUEST['submit'])) {
         update_option('facebook', $_REQUEST['facebook']);
         update_option('twitter', $_REQUEST['twitter']);
         update_option('instagram', $_REQUEST['instagram']);
         update_option('feed', $_REQUEST['feed']);
         update_option('contact_us_email', $_REQUEST['contact_us_email']);
         $updated = 1;
}
?>
<?php if ($updated == 1) { ?>
        <div class="updated" style="margin-top: 10px;"><p>Details Updated Successfully</p></div>
    <?php } ?>
<div id="usual2" class="usual">
        <form name="options" id="options" action="" method="post">
            <h1>VOGT Theme Options</h1>
            <h2>General Settings</h2>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Facebook:</div>
                    <div class="field"><input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Twitter:</div>
                    <div class="field"><input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Instagram</div>
                    <div class="field"><input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>"  />
                    </div><br />
                </div>
            </div> 
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Feed</div>
                    <div class="field"><input type="text" name="feed" id="feed" value="<?php echo get_option('feed'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Contact us email</div>
                    <div class="field"><input type="text" name="contact_us_email" id="contact_us_email" value="<?php echo get_option('contact_us_email'); ?>"  />
                    </div><br />
                </div>
            </div>
            <br style="clear:both;" />
            <input type="submit" class="btn" name="submit" value="Save Options" style="margin-top:20px;" />
        </form>
     </div>
     <script type="text/javascript">
        jQuery("#usual2 ul").idTabs();
    </script>
    <?php } ?>