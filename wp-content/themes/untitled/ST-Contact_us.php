<?php 
/*******
Template Name:Contact us
*******/
get_header();
global $wpdb;
if ($_POST['firstname'] != "" && $_POST['contactform'] == "") {
    $table = $wpdb->prefix . "contact";
    $data['firstname']        = sanitize_text_field($_POST['firstname']);
    $data['email']            = sanitize_text_field($_POST['email']);
    $data['telephone']        = sanitize_text_field($_POST['telephone']);
    $data['message']          = sanitize_text_field($_POST['message']);
    $data['posted_date']      = date('Y-m-d H:i:s');
    $format = array('%s','%s','%s','%s','%s');

      if (isset( $_POST['contact_us_form'] ) && wp_verify_nonce($_POST['contact_us_form'], 'conactus_nonce') ) {
        $insert_contact = $wpdb->insert($table, $data, $format);
        $lastid = $wpdb->insert_id;
        if($lastid != "") { ?>
        
          <?php $message = '
          <html>
           <body>
          <table id="addresses" cellspacing="0" cellpadding="20"  style="border:1px solid #ccc; border-collapse: collapse; background-color:#fdfdfd;">
    <tr>
        <td class="contact_mail" style="border-bottom:1px solid #fdfdfd; padding-bottom: 50px">
            <img src="'.get_bloginfo('template_url').'/images/logo.png"  alt="images" style="border: none;
  margin-left: 45%;
  display: inline;
  font-size: 14px;
  font-weight: bold;
  width: 59px;
  height: 80px;
  line-height: 100%;
  outline: none;
  text-decoration: none;
  text-transform: capitalize;
  margin-right: 489px;
  padding-top: 17px;">
        </td>
    </tr>
    <table border="0">
        <tr>
            <td><p>Dear Admin,</p></td>
            <td><p>A new request has been received. Please find the details below.</p></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:'. $data['firstname'] .'</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: ' . $data['email'] . '</td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>: ' . $data['telephone'] . '</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>: ' . $data['message'] . '</td>
        </tr>
    </table>
    <tr id="template_footer">
        <td valign="top" style="padding: 0;
  -webkit-border-radius: 0px;">
            <table border="0" cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2" valign="middle" id="credit" style="text-align: center; border:0;
  color: #fff;
  font-family: Arial;
  font-size:12px;
  text-align:center;
  padding: 5px; 
  background-color: #000;
  border-top:0;" >
                        <p>Regards, Untitled Team</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';
          $from = "Untitled <no-reply@untitled.in>";
          $subject = "Untitled Website: Request";
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
          $headers .= "From: " .  $from."\r\n";
          $to = get_option('contact_us_email');
          if (wp_mail($to, $subject, $message, $headers)) {
          unset($_POST);
          $redirect_url = get_bloginfo('url') . "/contact/thank-you/";
          wp_redirect( $redirect_url );
          exit;
          }
        }
      }
    }
?>
<div class="container subwrap">
<ul class="breadcrumb">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
      ?>
      </ul>
      <div class="row">
        <div class="col-xs-8 center-block">
          <h1><?php echo $post->post_title;  ?></h1>
          <form name="contact_us_frm" id="contact_us_frm" method="post" action="">
          <?php wp_nonce_field('conactus_nonce','contact_us_form'); ?>
          <div class="form-wrap">
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your name">
                <input type="text" name="firstname" id="firstname" onkeypress="return onlyAlphabets(event, this)"  class="floating-item-input input-item validate" value="" maxlength="75" />
                <span class="floating-item-label">Name</span>
              </label>
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter a email address">
                <input type="text" name="email" id="email" class="floating-item-input input-item validate validate-email" value="" maxlength="100" />
                <span class="floating-item-label">Email</span>
              </label>
                <div class="not_valid_message">Please enter a valid email address</div>
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your telephone number">
                <input type="text" name="telephone" onkeypress="return isNumber(event)" id="telephone" class="floating-item-input input-item validate" value="" maxlength="12"/>
                <span class="floating-item-label">Telephone</span>
              </label>
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your message">
                <textarea name="message" id="message" maxlength = "500" rows="7" class="floating-item-input input-item validate" ></textarea>
                <span class="floating-item-label">Message</span>
              </label>
            </div>
            <div class="form-row">
              <button name="contact_submit" id="contact_submit" class="btn btn-primary button-submit ripple" value="submit">Send</button>
            </div>
            <div id ="dispnone" class="dispnone">
          <input type="text" name="contactform" id="contactform" value="">
        </div>
          </div> 
          </form>
        </div>
      </div>
    </div>
    
<?php 
get_footer();
?>
