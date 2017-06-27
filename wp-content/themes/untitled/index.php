<?php
/******
Template Name:Home Page
******/
get_header();
?>
<!DOCTYPE html>
<html>
    <body>
        <div class="login">
            <form action="/action_page.php">
                <h2>Login Form</h2>
                <div class="container">
                    <label class="label">Username</label>
                    <input type="text" placeholder="Enter Username" name="uname" required>
                    <label class="label">Password</label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <button type="submit">Login</button>
                    <input type="checkbox" checked="checked"> Remember me
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw"><a href="#">Forgot password?</a></span>
                </div>
            </form>
        </div>
    </body>
</html>

<?php get_footer(); ?>
  
