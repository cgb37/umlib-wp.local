<?php
/**
 * Template Name: Splash_Ask
 * The template for the Ask Us splash page.
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
get_header();
?>

<?php the_post(); ?>

<div class="container_12">
  <div class="grid_12" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
    <div class="phases">
      <h4>Chat with Us</h4>
      <p>Use the chat box for quick questions.</p>
    </div>
        <div class="phases">   
      <h4><strong>Email Us</strong></h4>
      <p>Great for a more detailed question.  Give us 1 business day to respond.</p>
    </div>
        <div class="phases">
      <h4><strong>Call Us</strong></h4>
      <p>If we can't pick up, we'll call back within 1 business day.</p>
    </div>
            <div class="phases">    
      <h4>Consult Us</h4>
      <p>Set up a research consultation if you really need to dig into a topic.</p>
    </div>
  </div>
  <div class="grid_8">    
     <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <br />
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/email.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 1em;"/> </p>
      <h2 style="border: none; color: #f37421;">Email a Librarian</h2>
      <p style="font-size: 22px;"><a href="mailto:richterreference@miami.edu">richterreference@miami.edu</a></p>

      <br style="clear:both;" />
      </div>
    <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/phone.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 1em;"/> </p>
      <h2 style="border: none; color: #f37421;">Phone a Librarian</h2>
      <p style="font-size: 22px;">305-284-4722</p>

      <br style="clear:both;" />
    </div>

    <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/text.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 1em;"/> </p>
      <h2 style="border: none; color: #f37421;">Text a Librarian</h2>
      <p style="font-size: 22px;">305-809-7770</p>
      <br style="clear:both;" />
    </div>
    
        <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/consult.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 1em;"/> </p>
      <h2 style="border: none; color: #f37421;">Consult a Librarian</h2>
      <p>Use the <a href="/consultation-request-form/">consultation request form</a> to request a consultation session with a librarian who 
        specializes in your area of interest. Or contact a librarian directly from the list of <a href="/sp/subjects/staff.php?letter=Subject Librarians A-Z">subject librarians</a>.</p>
      <br style="clear:both;" />
    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <div class="tip">
      <h2>Chat with a Librarian</h2>
<!-- Place this div in your web page where you want your chat widget to appear. -->
<div class="needs-js">JavaScript disabled or chat unavailable. For reference assistance, please e-mail richterreference@miami.edu.</div>

<!-- Place this script as near to the end of your BODY as possible. -->
<script type="text/javascript">
  (function() {
    var x = document.createElement("script"); x.type = "text/javascript"; x.async = true;
    x.src = (document.location.protocol === "https:" ? "https://" : "http://") + "libraryh3lp.com/js/libraryh3lp.js?2571";
    var y = document.getElementsByTagName("script")[0]; y.parentNode.insertBefore(x, y);
  })();
</script>
<!--Old Meebo Code-->
<!--<embed height="275" rel="lightbox" src="http://widget.meebo.com/mm.swf?MdQnpwiGXE" type="application/x-shockwave-flash" width="185" wmode="transparent"></embed>-->
    </div>
    <div class="tipend"></div>
  </div>

</div>
<br />



<?php get_footer(); ?>