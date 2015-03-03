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
                <?php $postmeta = get_post_meta(get_the_ID()); ?>
                <h2><?php echo the_title(); ?></h2>


                <div id="page_lvl_tabs">
                    <ul>
                        <li class="active"><a href="#tabs-1" rel="tab-1">This Week's Hours</a></li>
                        <li><a href="#tabs-2" rel="tab-2">Exceptions</a></li>
                        <li><a href="#tabs-3" rel="tab-3">Events</a></li>
                        <li><a href="<?php echo $postmeta['wpcf-printable-hours'][0]; ?>" target="_blank">Printable Hours (.pdf)</a></li>
                    </ul>

                    <div class="tab-1 breather">
                        <br />
                        <?php //print $schedule7; ?>
                        <?php $openHours = new Open_Hours(); ?>

                        <?php
                        $todays_hours = $openHours->get_todays_hours_formatted();
                        $is_closed        = $todays_hours['is_closed'];
                        $is_holiday       = $todays_hours['is_holiday'];
                        $today_open_hour  = $todays_hours['open'];
                        $today_close_hour = $todays_hours['close'];

                        ?>


                        <?php $calendar_period = $openHours->get_calendar_period_formatted(); ?>

                        <h2>
                            <?php echo $calendar_period['semester']; ?> <?php echo $calendar_period['year']; ?>: <?php echo $calendar_period['start']; ?> to <?php echo $calendar_period['end']; ?>
                        </h2>

                        <?php $data = $openHours->get_times_formatted(); ?>
                        <div id="schedule_box">
                            <p class="display_date">
                            <table class="form_listing" style="background-color: #FFF;">
                                <?php foreach($data as $datum): ?>
                                        <?php foreach($datum as $key => $day): ?>
                                            <tr><td class="time-entry"><?php echo $key; ?></td><td class="time-entry"> <?php echo $day['open']; ?> - <?php echo $day['close']; ?></td></tr>
                                        <?php endforeach; ?>
                                <?php endforeach; ?>
                            </table>
                            </p>
                        </div>
                        <p><?php echo the_content(); ?></p>
                    </div>



                    <div class="tab-2 breather" style="display: none;">
                        <p><strong>Exceptions to the Richter Library Building Hours<br /><?php echo $calendar_period['semester']; ?> <?php echo $calendar_period['year']; ?>
                            </strong></p>


                        <div>
                            <?php $holidays = $openHours->get_holidays_formatted(); ?>
                            <?php

                            function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
                                $reference_array = array();

                                foreach($array as $key => $row) {
                                    $reference_array[$key] = strtotime($row[$column]);
                                }

                                array_multisort($reference_array, $direction, $array);
                            }

                            ?>

                            <?php  array_sort_by_column($holidays, 'start-datetime'); ?>

                            <table class="form_listing" style="background-color: #FFF;">
                                <tr class="even">
                                    <td class="time-entry"><strong>Day</strong></td>
                                    <td class="time-entry"><strong>Library Hours</strong></td>
                                </tr>


                                <?php foreach($holidays as $holiday): ?>

                                    <tr>
                                        <?php
                                        if($holiday['is-closed'] == 'Closed') {

                                            if($holiday['start-date'] == $holiday['end-date']) {
                                                echo "<td class='time-entry'>". $holiday['name']. "</td><td class='time-entry'> ".$holiday['start-date']." Closed</td>";
                                            } else {
                                                echo "<td class='time-entry'>". $holiday['name']. "</td><td class='time-entry'> ".$holiday['start-date']. " - ".$holiday['end-date']." Closed</td>";
                                            }

                                        } else {
                                            echo "<td class='time-entry'>". $holiday['name']."</td><td class='time-entry'> ". $holiday['start-datetime']." - ".$holiday['end-datetime']." ".$holiday['is-closed']."</td>";
                                        }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>

                    <div class="tab-3 breather" style="display: none;">
                        <br />
                        <?php $events = $openHours->get_events_formatted(); ?>
                        <?php  array_sort_by_column($events, 'start-datetime'); ?>
                        <table class="form_listing" style="background-color: #FFF;">
                            <?php foreach($events as $event): ?>
                                <?php
                                if($event['event-url'] != "") {

                                    $title = "<a href='{$event['event-url']}'>{$event['title']}</a>";
                                } else {
                                    $title = $event['title'];
                                }

                                ?>

                                <?php echo "<tr><td class='time-entry'>". $title." ". $event['start-datetime']." ".$event['end-datetime']. "</td></tr>"; ?>
                            <?php endforeach; ?>
                        </table>


                    </div>

                </div><!--end tabs area-->

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