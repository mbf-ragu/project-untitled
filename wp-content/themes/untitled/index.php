<?php
/******
Template Name:Home Page
******/
get_header();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php if (!is_user_logged_in()){ ?>
        <div class="login">
            <form action="/action_page.php">
                <div class="container">
                    <h2>Login Form</h2>
                    <label class="label">Username</label>
                    <input type="text" placeholder="Enter Username" name="uname" required>
                    <label class="label">Password</label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <button type="submit">Login</button>
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <input type="checkbox" id ="remember" checked="checked"> <label for = "remember">Remember me</label>
                    <!-- <button type="button" class="cancelbtn">Cancel</button> -->
                    <span class="psw"><a href="#">Forgot password?</a></span>
                </div>
            </form>
        </div>
        <?php } else { ?>
        <div class="container">
            <h2>My Account</h2>
            <?php 
                $current_user = wp_get_current_user();
                echo 'Username: ' . $current_user->user_login . '<br />';
                echo 'User email: ' . $current_user->user_email . '<br />';
                echo 'User first name: ' . $current_user->user_firstname . '<br />';
                echo 'User last name: ' . $current_user->user_lastname . '<br />';
                echo 'User display name: ' . $current_user->display_name . '<br />';
                echo 'User ID: ' . $current_user->ID . '<br />';
            ?>
        </div>
        <?php } ?>

    </body>
</html>

<?php get_footer(); ?>
  
