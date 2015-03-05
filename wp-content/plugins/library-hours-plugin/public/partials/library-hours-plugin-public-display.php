<?php
/**
 * Template Name: Splash_Hours
 * The template for the Books splash page.
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

<?php while ( have_posts() ) : the_post(); ?>

    <div class="pure-g" xmlns="http://www.w3.org/1999/html">

        <div class="pure-u-1">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->
        </div>

        <div class="pure-g">
            <div class="breather libraries-container">
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/architecture/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/architecture_lib.jpg" alt="Architecture Library" title="Architecture Library" /></a>
                    <p><a href="/architecture/hours/">Architecture</a></p>
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/business/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" alt="Business Library" title="Business Library" /></a>
                    <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" align="left" alt="Business Library" title="Business Library" /></a>-->
                    <p><a href="/business/hours/">Business</a></p>
                    <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html">Business</a>-->
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/rsmaslib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/rsmas.jpg" alt="Marine Library" title="Marine Library" /></a>
                    <p><a href="/rsmaslib/hours/">Marine</a></p>
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/musiclib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/music_lib.jpg" alt="Music Library" title="Music Library" /></a>
                    <p><a href="/musiclib/hours/">Music</a></p>
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/chc/hoursdirections/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/chc_icon.jpg" alt="Cuban Heritage Coll." title="Cuban Heritage Coll." /></a>
                    <p><a href="/chc/hoursdirections/">Cuban Heritage Coll.</a></p>
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/specialcollections/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/speccoll_icon.jpg" alt="Special Collections" title="Special Collections"/></a>
                    <p><a href="/specialcollections/hours/">Special Collections</a></p>
                </div>
                <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
                    <a href="/universityarchives/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/universityarchives_icon.jpg" alt="University Archives" title="University Archives"  /></a>
                    <p><a href="/universityarchives/hours/">University Archives</a></p>
                </div>
            </div>
        </div>


        <!--main content-->
        <div class="pure-u-1">
            <div class="breather track_me_Page_Click">



                <div><?php echo the_content(); ?></div>

                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-1-2">
                        <div class="breather">
                            <h2>Branch Libraries</h2>
                            <table class="item_listing hours-listing" width="100%">
                                <tr class="even">
                                    <td class="lib">
                                        Architecture Library</td>
                                    <td class="lib-item">
                                        <a href="/architecture/hours/">View</a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="lib">Business Library</td>
                                    <td class="lib-item"><a href="http://library.miami.edu/business/hours/">View</a></td>
                                </tr>
                                <tr class="even">
                                    <td class="lib">Marine Library</td>
                                    <td class="lib-item"><a href="/rsmaslib/hours/">View</a></td>
                                </tr>
                                <tr class="odd">
                                    <td class="lib">Music Library</td>
                                    <td class="lib-item"><a href="/musiclib/hours/">View</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="pure-u-1 pure-u-md-1-2">
                        <div class="breather">
                            <h2>Collections</h2>
                            <table class="item_listing hours-listing" width="100%">
                                <tr class="even">
                                    <td class="lib">Cuban Heritage Collection</td>
                                    <td class="lib-item"><a href="/chc/hoursdirections/">View</a></td>
                                </tr>
                                <tr class="odd">
                                    <td class="lib">Special Collections</td>
                                    <td class="lib-item"><a href="/specialcollections/hours/">View</a></td>
                                </tr>
                                <tr class="even">
                                    <td class="lib">University Archives</td>
                                    <td class="lib-item"><a href="/universityarchives/hours/">View</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!--end main content-->

    </div><!-- .pure-g -->

<?php endwhile; // end of the loop. ?>

<?php /*echo date('l jS \of F Y h:i:s A');*/  get_footer(); ?>