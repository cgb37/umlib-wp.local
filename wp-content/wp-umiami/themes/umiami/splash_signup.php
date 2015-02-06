<?php
/**
 * Template Name: Splash_Subscribe
 * The template for the subscribe splash page
 *
 * This is the template that displays the form to subcribe to chc mailing list
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();
?>
<div class="container_12">

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <?php print $patron_tip;
	uml_isReferred();  ?>
  </div>

  <div class="grid_8">
    <div class="breather">

      <?php the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">&nbsp;
      	<?php the_content(); ?>

<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//miami.us8.list-manage.com/subscribe/post?u=55065e65fd5d55fe40cf938e5&amp;id=36c77a3bfb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<h2>Subscribe to our mailing list</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group input-group">
    <strong>Relationship  <span class="asterisk">*</span>
</strong>
    <ul><li><input type="radio" value="Student" name="MMERGE1" id="mce-MMERGE1-0"><label for="mce-MMERGE1-0">Student</label></li>
<li><input type="radio" value="Faculty" name="MMERGE1" id="mce-MMERGE1-1"><label for="mce-MMERGE1-1">Faculty</label></li>
<li><input type="radio" value="Staff" name="MMERGE1" id="mce-MMERGE1-2"><label for="mce-MMERGE1-2">Staff</label></li>
<li><input type="radio" value="Other" name="MMERGE1" id="mce-MMERGE1-3"><label for="mce-MMERGE1-3">Other</label></li>
</ul>
</div>
<div class="mc-field-group input-group">
    <strong>Optional:  If a student . . . </strong>
    <ul><li><input type="radio" value="Undergraduate" name="MMERGE3" id="mce-MMERGE3-0"><label for="mce-MMERGE3-0">Undergraduate</label></li>
<li><input type="radio" value="Graduate" name="MMERGE3" id="mce-MMERGE3-1"><label for="mce-MMERGE3-1">Graduate</label></li>
</ul>
</div>
<div class="mc-field-group">
	<label for="mce-MMERGE2">School or College: </label>
	<select name="MMERGE2" class="" id="mce-MMERGE2">
	<option value=""></option>
	<option value="School of Architecture">School of Architecture</option>
<option value="College of Arts and Sciences">College of Arts and Sciences</option>
<option value="School of Business Administration">School of Business Administration</option>
<option value="School of Communication">School of Communication</option>
<option value="School of Education and Human Development">School of Education and Human Development</option>
<option value="College of Engineering">College of Engineering</option>
<option value="School of Law">School of Law</option>
<option value="Rosenstiel School of Marine and Atmospheric Science">Rosenstiel School of Marine and Atmospheric Science</option>
<option value="Miller School of Medicine">Miller School of Medicine</option>
<option value="Frost School of Music">Frost School of Music</option>
<option value="School of Nursing and Health Studies">School of Nursing and Health Studies</option>
<option value="The Graduate School">The Graduate School</option>

	</select>
</div>
	<div id="mce-responses" class="kittens">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_55065e65fd5d55fe40cf938e5_36c77a3bfb" tabindex="-1" value=""></div>
    <div class="kittens"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>

<!--End mc_embed_signup-->

        </div><!-- .entry-content -->
        <footer class="entry-meta">

        </footer><!-- .entry-meta -->
      </article><!-- #post-<?php the_ID(); ?> -->

    </div>
  </div>



  <div class="grid_4">
    <?php
print uml_getTips();
?>
  </div>
</div><!-- .container_12 -->

<?php get_footer(); ?>