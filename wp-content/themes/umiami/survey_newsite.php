<?php
/**
 * Template Name: Survey_Newsite
 * The template for the survey on website launch
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />

<body style="min-width: 500px !important; background: none;">
  <div class="" style="margin: 1em 2em 0 2em;">
    <div style=""><img src="http://new.library.miami.edu/wp-content/themes/umiami/images/logo.png" alt="University of Miami Libraries" border="0" /></div>
    
<br /><h3>Thank you for your comments.  They are appreciated.</h3>  
    <p>If you have other questions or concerns about the new website, please contact:</p>
    
<p>Andrew Darby<br />
    Head, Web & Emerging Technologies<br />
    agdarby@miami.edu<br />
    305.284.1817<p>
    <br />
    <p><em>Click the little x or anywhere in the black background to close this window.</em></p>
    
  </div>
<?php    

exit;
if (isset($_POST["submit"])) {
  // capture results
  
  // Report all PHP errors
  ini_set('display_errors',1); 
  error_reporting(E_ALL);
  
  // date and time stuff
  $today = getdate();
  $month = $today['month'];
  $mday = $today['mday'];
  $year = $today['year'];
  $this_year = date("Y");

  $sent_from = "agdarby@gmail.com";
  $send_to = "agdarby@miami.edu";
  
  $email_server = "";
  ini_set("SMTP", $email_server);
  ini_set("sendmail_from", $sent_from);

    // sanitize
  $clean_like = sanitize_text_field($_POST['like']);
  $clean_dislike = sanitize_text_field($_POST['dislike']);
  $clean_whyvisit = sanitize_text_field($_POST['whyvisit']);
  $clean_iam = sanitize_text_field($_POST['iam']);
  /* here the subject and header are assembled */

  $subject = "New Website Survey 2012";
  $header = "Return-Path: $sent_from\r\n";
  $header .= "From:  $sent_from\r\n";
  $header .= "Content-Type: text/html; charset=iso-8859-1;\n\n\r\n";

  $message = "<html><body><h2>Survey Results</h2>\n\n";
  $message .= "<strong>Date Submitted</strong>: $month $mday, $year<br />\n\n";
  $message .= "<strong>Liked</strong>:  ";
  $message .= mysql_real_escape_string($clean_like);
  $message .= "<br />\n\n
		<strong>Disliked</strong>:  ";
  $message .= mysql_real_escape_string($clean_dislike);
    $message .= "<br />\n\n
		<strong>Visited because</strong>:  ";
  $message .= mysql_real_escape_string($clean_whyvisit);
    $message .= "<br />\n\n
		<strong>Affiliation</strong>:  ";
  $message .= mysql_real_escape_string($clean_iam);
  $message .= "<br /><br />\n\n";
  $message .= "</body></html>";

  // begin assembling actual message

  $success = mail($send_to, "$subject", $message, $header);
  // The below is just for testing purposes
  if ($success) {
    $content = "<br /><h3>Thank you for your comments.  They are appreciated.</h3>  
    <p>If you have other questions or concerns about the new website, please contact:</p>";
  } else {
    //print "mail didn't go to $send_to";
    $content = "<br /><h3>Problem</h3>  
    <p>It appears there was a problem with your submission, please contact:</p>";
  }
  
  
    $content .= "<p>Andrew Darby<br />
    Head, Web & Emerging Technologies<br />
    agdarby@miami.edu<br />
    305.284.1817<p>
    <br />
    <p><em>Click the little x or anywhere in the black background to close this window.</em></p>";

  // post form contents
} else {
  $content = '<p>Please take a minute to fill out this survey.  Your comments are confidential, and will be used to improve the  new website.  All answers are optional.</p>
    <br />

    <form action="" method="post">
      <fieldset>
        <legend>What do you like about the new website?</legend>
        <textarea name="like" cols="60" rows="5"></textarea>
        <br />
        <legend>What do you dislike about the new website?</legend>
        <textarea name="dislike" cols="60" rows="5"></textarea>
        <br />
        <legend>Why did you visit the library website today (optional)?</legend>
        <textarea name="whyvisit" cols="50" rows="1"></textarea>
        <br />
        <legend>I am (optional)</legend>
        <select name="iam">
          <option value=""> -- choose one -- </option>
          <option value="faculty">Faculty</option>
          <option value="student">Student</option>
          <option value="other">Other user</option>
        </select>

        <input type="submit" name="submit" value="SUBMIT" />
      </fieldset>
</form>';
}
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<style>
  textarea {margin-bottom: 2em;}
  input {margin-left: 2em;}
</style>
<body style="min-width: 500px !important; background: none;">
  <div class="" style="margin: 1em 2em 0 2em;">
    <div style=""><img src="http://new.library.miami.edu/wp-content/themes/umiami/images/logo.png" alt="University of Miami Libraries" border="0" /></div>

    <?php print $content; ?>


  </div>


</body>
<script>
  $(document).ready(function(){
    $('#closeme').live('click', function(){
      parent.$.fn.colorbox.close()

    });

  });
</script>