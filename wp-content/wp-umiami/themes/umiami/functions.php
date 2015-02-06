<?php
/**
 * Based on twentyeleven theme.  Most (all?) functions removed from original.
 *
 * @package WordPress
 * @subpackage Umiami
 * @since
 */
/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action('after_setup_theme', 'twentyeleven_setup');

if (!function_exists('twentyeleven_setup')):

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which runs
   * before the init hook. The init hook is too late for some features, such as indicating
   * support post thumbnails.
   *
   * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
   * functions.php file.
   *
   * @uses load_theme_textdomain() For translation/localization support.
   * @uses add_editor_style() To style the visual editor.
   * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
   * @uses register_nav_menus() To add support for navigation menus.
   * @uses add_custom_background() To add support for a custom background.
   * @uses add_custom_image_header() To add support for a custom header.
   * @uses register_default_headers() To register the default custom header images provided with the theme.
   * @uses set_post_thumbnail_size() Two set a custom post thumbnail size.
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_setup() {

    /* Make Twenty Eleven available for translation.
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Twenty Eleven, use a find and replace
     * to change 'twentyeleven' to the name of your theme in all the template files.
     */
    load_theme_textdomain('twentyeleven', TEMPLATEPATH . '/languages');

    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if (is_readable($locale_file))
      require_once( $locale_file );

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Load up our theme options page and related code.
    require( dirname(__FILE__) . '/inc/theme-options.php' );

    // Grab Twenty Eleven's Ephemera widget.
    require( dirname(__FILE__) . '/inc/widgets.php' );

    // Add default posts and comments RSS feed links to <head>.
    add_theme_support('automatic-feed-links');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'twentyeleven'));

    // Add support for a variety of post formats
    add_theme_support('post-formats', array('aside', 'link', 'gallery', 'status', 'quote', 'image'));

    // Add support for custom backgrounds
    add_custom_background();

    // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
    add_theme_support('post-thumbnails');

    // The next four constants set how Twenty Eleven supports custom headers.
    // The default header text color
    define('HEADER_TEXTCOLOR', '000');

    // By leaving empty, we allow for random image rotation.
    define('HEADER_IMAGE', '');

    // The height and width of your custom header.
    // Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
    define('HEADER_IMAGE_WIDTH', apply_filters('twentyeleven_header_image_width', 1000));
    define('HEADER_IMAGE_HEIGHT', apply_filters('twentyeleven_header_image_height', 288));

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be the size of the header image that we just defined
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);

    // Add Twenty Eleven's custom image sizes
    add_image_size('large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true); // Used for large feature (header) images
    add_image_size('small-feature', 500, 300); // Used for featured posts if a large-feature doesn't exist
    // Turn on random header image rotation by default.
    add_theme_support('custom-header', array('random-default' => true));

    // Add a way for the custom header to be styled in the admin panel that controls
    // custom headers. See twentyeleven_admin_header_style(), below.
    add_custom_image_header('twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image');

    // ... and thus ends the changeable header business.
    // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
    register_default_headers(array(
        'wheel' => array(
            'url' => '%s/images/headers/wheel.jpg',
            'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Wheel', 'twentyeleven')
        ),
        'shore' => array(
            'url' => '%s/images/headers/shore.jpg',
            'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Shore', 'twentyeleven')
        ),
        'trolley' => array(
            'url' => '%s/images/headers/trolley.jpg',
            'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Trolley', 'twentyeleven')
        ),
        'pine-cone' => array(
            'url' => '%s/images/headers/pine-cone.jpg',
            'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Pine Cone', 'twentyeleven')
        ),
        'chessboard' => array(
            'url' => '%s/images/headers/chessboard.jpg',
            'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Chessboard', 'twentyeleven')
        ),
        'lanterns' => array(
            'url' => '%s/images/headers/lanterns.jpg',
            'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Lanterns', 'twentyeleven')
        ),
        'willow' => array(
            'url' => '%s/images/headers/willow.jpg',
            'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Willow', 'twentyeleven')
        ),
        'hanoi' => array(
            'url' => '%s/images/headers/hanoi.jpg',
            'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
            /* translators: header image description */
            'description' => __('Hanoi Plant', 'twentyeleven')
        )
    ));
  }

endif; // twentyeleven_setup

if (!function_exists('twentyeleven_header_style')) :

  /**
   * Styles the header image and text displayed on the blog
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_header_style() {

    // If no custom options for text are set, let's bail
    // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
    if (HEADER_TEXTCOLOR == get_header_textcolor())
      return;
    // If we get this far, we have custom styles. Let's do this.
    ?>
    <style type="text/css">
    <?php
    // Has the text been hidden?
    if ('blank' == get_header_textcolor()) :
      ?>
        #site-title,
        #site-description {
          position: absolute !important;
          clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
          clip: rect(1px, 1px, 1px, 1px);
        }
      <?php
    // If the user has set a custom color for the text use that
    else :
      ?>
        #site-title a,
        #site-description {
          color: #<?php echo get_header_textcolor(); ?> !important;
        }
    <?php endif; ?>
    </style>
    <?php
  }

endif; // twentyeleven_header_style

if (!function_exists('twentyeleven_admin_header_style')) :

  /**
   * Styles the header image displayed on the Appearance > Header admin panel.
   *
   * Referenced via add_custom_image_header() in twentyeleven_setup().
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_admin_header_style() {
    ?>
    <style type="text/css">
      .appearance_page_custom-header #headimg {
        border: none;
      }
      #headimg h1,
      #desc {
        font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
      }
      #headimg h1 {
        margin: 0;
      }
      #headimg h1 a {
        font-size: 32px;
        line-height: 36px;
        text-decoration: none;
      }
      #desc {
        font-size: 14px;
        line-height: 23px;
        padding: 0 0 3em;
      }
      <?php
      // If the user has set a custom color for the text use that
      if (get_header_textcolor() != HEADER_TEXTCOLOR) :
        ?>
        #site-title a,
        #site-description {
          color: #<?php echo get_header_textcolor(); ?>;
        }
      <?php endif; ?>
      #headimg img {
        max-width: 1000px;
        height: auto;
        width: 100%;
      }
    </style>
    <?php
  }

endif; // twentyeleven_admin_header_style

if (!function_exists('twentyeleven_admin_header_image')) :

  /**
   * Custom header image markup displayed on the Appearance > Header admin panel.
   *
   * Referenced via add_custom_image_header() in twentyeleven_setup().
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_admin_header_image() {
    ?>
    <div id="headimg">
      <?php
      if ('blank' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR) || '' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR))
        $style = ' style="display:none;"';
      else
        $style = ' style="color:#' . get_theme_mod('header_textcolor', HEADER_TEXTCOLOR) . ';"';
      ?>
      <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
      <div id="desc"<?php echo $style; ?>><?php bloginfo('description'); ?></div>
      <?php $header_image = get_header_image();
      if (!empty($header_image)) : ?>
        <img src="<?php echo esc_url($header_image); ?>" alt="" />
    <?php endif; ?>
    </div>
  <?php
  }

endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length($length) {
  return 40;
}

add_filter('excerpt_length', 'twentyeleven_excerpt_length');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
  return ' <a href="' . esc_url(get_permalink()) . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven') . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more($more) {
  return ' &hellip;' . twentyeleven_continue_reading_link();
}

add_filter('excerpt_more', 'twentyeleven_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more($output) {
  if (has_excerpt() && !is_attachment()) {
    $output .= twentyeleven_continue_reading_link();
  }
  return $output;
}

add_filter('get_the_excerpt', 'twentyeleven_custom_excerpt_more');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args($args) {
  $args['show_home'] = true;
  return $args;
}

add_filter('wp_page_menu_args', 'twentyeleven_page_menu_args');

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

  register_widget('Twenty_Eleven_Ephemera_Widget');

  register_sidebar(array(
      'name' => __('Main Sidebar', 'twentyeleven'),
      'id' => 'sidebar-1',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
  ));

  register_sidebar(array(
      'name' => __('Showcase Sidebar', 'twentyeleven'),
      'id' => 'sidebar-2',
      'description' => __('The sidebar for the optional Showcase Template', 'twentyeleven'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
  ));

  register_sidebar(array(
      'name' => __('Footer Area One', 'twentyeleven'),
      'id' => 'sidebar-3',
      'description' => __('An optional widget area for your site footer', 'twentyeleven'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
  ));

  register_sidebar(array(
      'name' => __('Footer Area Two', 'twentyeleven'),
      'id' => 'sidebar-4',
      'description' => __('An optional widget area for your site footer', 'twentyeleven'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
  ));

  register_sidebar(array(
      'name' => __('Footer Area Three', 'twentyeleven'),
      'id' => 'sidebar-5',
      'description' => __('An optional widget area for your site footer', 'twentyeleven'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
  ));
}

add_action('widgets_init', 'twentyeleven_widgets_init');

/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav($nav_id) {
  global $wp_query;

  if ($wp_query->max_num_pages > 1) :
    ?>
    <nav id="<?php echo $nav_id; ?>">
      <h3 class="assistive-text"><?php _e('Post navigation', 'twentyeleven'); ?></h3>
      <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven')); ?></div>
      <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven')); ?></div>
    </nav><!-- #nav-above -->
  <?php
  endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
  if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches))
    return false;

  return esc_url_raw($matches[1]);
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
  $count = 0;

  if (is_active_sidebar('sidebar-3'))
    $count++;

  if (is_active_sidebar('sidebar-4'))
    $count++;

  if (is_active_sidebar('sidebar-5'))
    $count++;

  $class = '';

  switch ($count) {
    case '1':
      $class = 'one';
      break;
    case '2':
      $class = 'two';
      break;
    case '3':
      $class = 'three';
      break;
  }

  if ($class)
    echo 'class="' . $class . '"';
}

if (!function_exists('twentyeleven_comment')) :

  /**
   * Template for comments and pingbacks.
   *
   * To override this walker in a child theme without modifying the comments template
   * simply create your own twentyeleven_comment(), and that function will be used instead.
   *
   * Used as a callback by wp_list_comments() for displaying the comments.
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
      case 'pingback' :
      case 'trackback' :
        ?>
        <li class="post pingback">
          <p><?php _e('Pingback:', 'twentyeleven'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'twentyeleven'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
              default :
                ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
          <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer class="comment-meta">
              <div class="comment-author vcard">
                <?php
                $avatar_size = 68;
                if ('0' != $comment->comment_parent)
                  $avatar_size = 39;

                echo get_avatar($comment, $avatar_size);

                /* translators: 1: comment author, 2: date and time */
                printf(__('%1$s on %2$s <span class="says">said:</span>', 'twentyeleven'), sprintf('<span class="fn">%s</span>', get_comment_author_link()), sprintf('<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                /* translators: 1: date, 2: time */ sprintf(__('%1$s at %2$s', 'twentyeleven'), get_comment_date(), get_comment_time())
                        )
                );
                ?>

        <?php edit_comment_link(__('Edit', 'twentyeleven'), '<span class="edit-link">', '</span>'); ?>
              </div><!-- .comment-author .vcard -->

        <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'twentyeleven'); ?></em>
                <br />
        <?php endif; ?>

            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
          <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>', 'twentyeleven'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div><!-- .reply -->
          </article><!-- #comment-## -->

          <?php
          break;
      endswitch;
    }

  endif; // ends check for twentyeleven_comment()

  if (!function_exists('twentyeleven_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     * Create your own twentyeleven_posted_on to override in a child theme
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_posted_on() {
      printf(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven'), esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), sprintf(esc_attr__('View all posts by %s', 'twentyeleven'), get_the_author()), esc_html(get_the_author())
      );
    }

  endif;

  /**
   * Adds two classes to the array of body classes.
   * The first is if the site has only had one author with published posts.
   * The second is if a singular post being displayed
   *
   * @since Twenty Eleven 1.0
   */
  function twentyeleven_body_classes($classes) {

    if (!is_multi_author()) {
      $classes[] = 'single-author';
    }

    if (is_singular() && !is_home() && !is_page_template('showcase.php') && !is_page_template('sidebar-page.php'))
      $classes[] = 'singular';

    return $classes;
  }

  add_filter('body_class', 'twentyeleven_body_classes');

  // Databases Functions
  function getLetters($table, $selected = "A", $numbers = 1, $abc_link='', $size='normal', $showsearch = 0) {

    //$selected = scrubData($selected);
// If it's an array, just plunk that stuff in //

    if (is_array($table)) {
      $letterz = $table;
    } else {

      $shownew = 1;
      $extras = "";

      switch ($table) {
        case "databases":
          $lq = "SELECT distinct UCASE(left(title,1)) AS initial
                    FROM location l, location_title lt, title t
                    WHERE l.location_id = lt.location_id AND lt.title_id = t.title_id
                    AND eres_display = 'Y'
                    AND left(title,1) REGEXP '[A-Z]'
                    ORDER BY initial";
          $abc_link = "databases.php";
          $shownew = 0;
          break;
      }

//print $lq;

      $lr = MYSQL_QUERY($lq);

      while ($mylets = mysql_fetch_row($lr)) {
        $letterz[] = $mylets[0];
      }
      if ($numbers == 1) {
        $letterz[] = "Num";
      }

      $letterz[] = "All";

      if (!$selected) {
        $selected = "ALL";
      }
    }


    if ($size == "normal") {
      $alphabet = "<div id=\"letterhead\" align=\"center\">";
    } else {
      $alphabet = "<div id=\"letterhead_small\" align=\"center\">";
    }

    foreach ($letterz as $value) {
      if ($value == $selected) {
        $alphabet .= "<span id=\"selected_letter\">$value</span> ";
      } else {
        $alphabet .= "<a href=\"$abc_link$value\">$value</a>";
      }
    }

    if ($table == "databases") {
      $alphabet .= "<a href=\"databases.php?letter=images\" title=\"" . _("Databases with Images") . "\">" . _("Images") . "</a>
                        <a href=\"databases.php?letter=audio\" title=\"" . _("Databases with Audio") . "\">" . _("Audio") . "</a>
                        <a href=\"databases.php?letter=video\" title=\"" . _("Databases with Video") . "\">" . _("Video") . "</a>";
    }

    if ($showsearch != 0) {
      $alphabet .= "<input type=\"text\" id=\"letterhead_suggest\" size=\"30\"  />
        ";
    }


    $alphabet .= "</div>";

    return $alphabet;
  }

  function uml_setSidebarBgImg() {

    switch (THIS_BRANCH) {
      case "musiclib":
        $sidebar_images = array(
            "sidebar_bg_music_exterior.jpg",
            "sidebar_bg_music_fountain.jpg",
            "sidebar_bg_music_fountain2.jpg",
            "sidebar_bg_music_stairs.jpg",
            "sidebar_bg_music_study.jpg",
            "sidebar_bg_music_record.jpg",
            "sidebar_bg_music_reading.jpg",
            "sidebar_bg_music_piano.jpg",
            "sidebar_bg_music_staff.jpg"
        );
        $sidebar_selected = mt_rand(0, 8);

        break;
      case "architecture":
        $sidebar_images = array(
            "sidebar_bg_arch_sketcher.jpg",
            "sidebar_bg_arch_mags.jpg",
            "sidebar_bg_arch_map_reader.jpg",
            "sidebar_bg_arch_arches.jpg",
            "sidebar_bg_arch_magazine_reader.jpg",
            "sidebar_bg_arch_materials.jpg"
        );
        $sidebar_selected = mt_rand(0, 5);
        break;
      default:
        $sidebar_images = array(
            "sidebar_bg_richter_outside.jpg",
            "sidebar_bg_richter_stairwell.jpg",
            "sidebar_bg_richter_stacks1.jpg",
            "sidebar_bg_richter_outside2.jpg",
            "sidebar_bg_richter_stacks2.jpg",
            "sidebar_bg_richter_special.jpg");
        $sidebar_selected = mt_rand(0, 5);
    }

    print "style=\"background: url(";
    print bloginfo('template_url');
    print "/images/" . $sidebar_images[$sidebar_selected] . "); min-height: 500px; background-repeat: no-repeat;\"";
  }

  function uml_getTips() {

    if (get_field("sidebar_tips")) {
      $tip_text = get_field("sidebar_tips");
      $the_tip = "<div class=\"tip\">" . $tip_text . "</div><div class=\"tipend\"></div>";
      return $the_tip;
    }
  }

  function uml_showStaff($check_lib = "") {
    if (isset($check_lib) && $check_lib != "") {
      $staffers = explode(",", $check_lib);
      print uml_openTip();
      print "<h2>Need Help with this Page?</h2>";
      $count = 1;
      foreach ($staffers as $staffer) {
        $our_lib = new uml_Librarianify($staffer);
        //if ($count > 0) { print "<br style=\"clear:both;\" />"; }
        print $our_lib->display();
        $count++;
      }
      print uml_closeTip();
    }
  }

  function uml_openTip() {
    return "<div class=\"tip\">";
  }

  function uml_closeTip() {
    return "</div><div class=\"tipend\"></div>";
  }

  if ($_SERVER['HTTP_HOST'] != "localhost") {
    define("SP_DB", "subjectsplus");
    define("SP_USERNAME", "librarywebu");
    define("SP_PASSWORD", "7cogB1iM");
    define("SP_HOSTNAME", "127.0.0.1:3308");
    // for connection to library hours, for instance
    define("UM_USERNAME", "webuser01");
    define("UM_PASSWORD", "w3bpas2");
    define("UM_HOSTNAME", "127.0.0.1:3310");
  } else {

    define("SP_DB", "sp");
    define("SP_USERNAME", "root");
    define("SP_PASSWORD", "");
    define("SP_HOSTNAME", "localhost");
    // for connection to hours
    define("UM_DB", "sp");
    define("UM_USERNAME", "root");
    define("UM_PASSWORD", "");
    define("UM_HOSTNAME", "localhost");
  }

  function plusConnect($dbName) {
    // make connection to database
    MYSQL_CONNECT(SP_HOSTNAME, SP_USERNAME, SP_PASSWORD) OR DIE("Unable to connect to database");

    @mysql_select_db($dbName) or die("Unable to select database $dbName");
  }

// Taxonomy attempt for patron types
  /*
    add_action('init', 'create_patron_views');

    function create_patron_views() {
    $labels = array(
    'name' => _x('Patron Views', 'taxonomy general name'),
    'singular_name' => _x('Patron View', 'taxonomy singular name'),
    'search_items' => __('Search PView'),
    'all_items' => __('All Pviews'),
    'parent_item' => __('Parent Pview'),
    'parent_item_colon' => __('Parent Pview:'),
    'edit_item' => __('Edit Pview'),
    'update_item' => __('Update Pview'),
    'add_new_item' => __('Add New Pview'),
    'new_item_name' => __('New Pview Name'),
    );

    register_taxonomy('patron_views', 'page', array(
    'hierarchical' => true,
    'labels' => $labels
    ));
    }

   */

  function uml_shortcode_faq_func($atts) {
    extract(shortcode_atts(array(
                'id' => 'NULL',
                'collection' => '1',
                'show' => '5'
                    ), $atts));

    //return "faq id = {$id}, collection id = {$collection}";
    $id_clean = absint($collection);
    $faq_list = "";  // init

    $wpdb_sp = new wpdb(SP_USERNAME, SP_PASSWORD, SP_DB, SP_HOSTNAME);
    $wpdb_sp->show_errors();
    $q = "SELECT f.faq_id, question
      FROM faq f, faq_faqpage ff, faqpage fp
      WHERE f.faq_id = ff.faq_id
      AND fp.faqpage_id = ff.faqpage_id
      AND fp.faqpage_id = '{$id_clean}'
      ORDER BY fp.name, question
      LIMIT 0,{$show}";

    //print $q;
    $myfaqs = $wpdb_sp->get_results($q);

    if (!empty($myfaqs)) {

      $faq_list = "<ul>";
      $result_count = 1;
      foreach ($myfaqs as $value) {
        $url = PATH_TO_SP . "subjects/faq.php?coll_id=" . $collection . "#faq-" . $result_count;
        $faq_list .= "<li><a href=\"$url\">" . $value->question . "</a></li>";
        $result_count++;
      }
      // see if we should add a view all
      if ($result_count > ($show)) {
        $url2 = PATH_TO_SP . "subjects/faq.php?coll_id=" . $collection;
        $faq_list .= "<li><a href=\"$url2\">view all</a></li>";
      }
      $faq_list .= "</ul>";
    }

    return $faq_list;
  }

  add_shortcode('faq', 'uml_shortcode_faq_func');

  function uml_shortcode_tipbreaker($atts) {
    extract(shortcode_atts(array(
                'title' => ''
                    ), $atts));


    $tipbreaker = uml_closeTip();
    $tipbreaker .= uml_openTip();

    if (isset($title) && $title != '') {
      $tipbreaker .= "<h2>$title</h2>";
    }

    return $tipbreaker;
  }

  add_shortcode('tipbreaker', 'uml_shortcode_tipbreaker');

  function todaysHours() {
    return "workin' 9-5";
  }

  function uml_isReferred() {
    // Check our referrer
    $referred_from = "";
    $referrer = $_SERVER['HTTP_REFERER'];
    $ref_bits = explode(UM_PARTIAL_PATH, $referrer);
    $current_site = explode("/", get_stylesheet_directory());
    $our_folder = array_pop($current_site);

    if (preg_match('/musiclib/', $ref_bits[1]) && $our_folder != "um-music") {
      $referred_from = "music";
    }

    if ($referred_from != "") {
      print "<span class=\"referU" . $referred_from . "\"><a href=\"$referrer\">Return to $referred_from</a></span>";
    }
  }

////////////////
// Hours functions
///////////////

  function get_schedule($get_date, $weekday) {
    // connect
    $wpdb_sp = new wpdb(UM_USERNAME, UM_PASSWORD, 'rlibcalendar', UM_HOSTNAME);
    $wpdb_sp->show_errors();

    // check for exceptions
    $exceptions = $wpdb_sp->get_results($wpdb_sp->prepare("SELECT exception_name, exception_date, exception_schedule FROM schedule_exceptions WHERE exception_date = '%s' LIMIT 1", $get_date));

    // if exceptions, return that value
    if (!empty($exceptions)) {
      $todays_hours = $exceptions[0]->exception_schedule;
    } else {
      // no exceptions--return hours
    	$q = "SELECT " . $weekday . " FROM schedules WHERE schedule_start <= '%s' && schedule_end >= '%s' LIMIT 1";
    	$get_hours = $wpdb_sp->get_results($wpdb_sp->prepare("$q", $get_date, $get_date));
      $todays_hours = $get_hours[0]->$weekday;
    }

    return $todays_hours;
  }

  function show_seven_day_schedule($selected_date) {
    $days = 6;
    $Date = strtotime($selected_date);
    $Month = date('n', $Date);
    $Day = date('j', $Date);
    $DayByNumber = date('w', $Date);
    $Year = date('Y', $Date);
    // set up striping
    $colour1 = "odd";
    $colour2 = "even";

    $schedule_table = '<table class="item_listing" width="600" border="0" cellspacing="0" cellpadding="0">';
    for ($i = 0; $i <= $days; $i++) {
      $row_colour = ($i % 2) ? $colour1 : $colour2;

      $query_date_display = date('F j, Y', mktime(0, 0, 0, $Month, $Day + $i, $Year));
      $query_date = date('Y-m-d', mktime(0, 0, 0, $Month, $Day + $i, $Year));
      $query_weekday = date('l', mktime(0, 0, 0, $Month, $Day + $i, $Year));
      $day_numeric = date('w', mktime(0, 0, 0, $Month, $Day + $i, $Year));
      $schedule = get_schedule($query_date, $query_weekday);

      if ($day_numeric == $DayByNumber) {
        $row_colour .= " highlight";
      }

      $schedule_table .= '  <tr class="' . $row_colour . '">' . "\n";
      $schedule_table .= '   <td>' . $query_weekday . '</td> <td>' . $query_date_display . '</td>' . "\n";
      $schedule_table .= '    <td>' . $schedule . '</td>' . "\n";
      $schedule_table .= '  </tr>' . "\n";
    }
    $schedule_table .= '</table>' . "\n";
    return $schedule_table;
  }

// Time to enqueue -- from http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes

  add_action('wp_enqueue_scripts', 'uml_load_javascript_files');

// Register some javascript files, because we love javascript files. Enqueue a couple as well

  if (!function_exists('uml_load_javascript_files')) {

    function uml_load_javascript_files() {

      // if we're on the public site, let's use the cdn; have to de-register a core file's load of jquery
      if (!is_admin()) {
        wp_deregister_script('jquery');

      	if( isset( $_SERVER['HTTPS'] ) )
      	{
      		$lstrJqueryURL = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';
      	}else
      	{
      		$lstrJqueryURL = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';
      	}

      	wp_register_script('jquery', $lstrJqueryURL, false, '1.7.2', true);
      }

      //wp_register_script( 'info-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', array('jquery'), '1.7', true );

      wp_register_script('info-caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-5.6.1-packed.js', array('jquery'), '5.6.1', true);
      wp_register_script('info-hoverintent', get_template_directory_uri() . '/js/hoverIntent.minified.js', array('jquery'), '1.5.1', true);
      wp_register_script('info-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '1.0', true);
      wp_register_script('info-colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array('jquery'), '1.0', true);
      wp_register_script('info-footer_data', get_template_directory_uri() . '/js/footer_data.js', array('jquery'), '0.1', true);
      wp_register_script('info-front_page_data', get_template_directory_uri() . '/js/front_page_data.js', array('jquery'), '0.1', true);
      wp_register_script('mobile-detection', get_template_directory_uri() . '/js/mobile-detection.js', array('jquery'), '1.0', true);

      wp_enqueue_script('jquery');
      wp_enqueue_script('info-hoverintent');
      wp_enqueue_script('info-footer_data');

      wp_enqueue_script('info-cookie');

      if (is_front_page()) {
      	wp_enqueue_script('mobile-detection');
        wp_enqueue_script('info-caroufredsel');
        wp_enqueue_script('info-front_page_data');
      }
    }

  }

  /* This gets hours for branches FROM THE ADVANCED CUSTOM FIELDS ON THEIR HOURS PAGE */

  function uml_getHours($label="Library Hours", $monday = "", $tuesday = "", $wednesday = "", $thursday = "", $friday = "", $saturday = "", $sunday = "") {

    // set up striping
    $colour1 = "odd";
    $colour2 = "even";
    $i = 1;

    $week = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");

    if ($label != "") {
      print "<h2>$label</h2>\n";
    }
    print "
    <table class=\"item_listing\" width=\"450\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> ";
    foreach ($week as $day) {
      $this_day = $$day;
      $row_colour = ($i % 2) ? $colour1 : $colour2;
      print "<tr class=\"$row_colour\">
        <td width=\"250\">" . ucfirst($day) . "</td>
        <td>$this_day</td>
      </tr>";
      $i++;
    }
    print "</table>";
  }

  function uml_getBranchHours($post_id, $range="all") {
    // get from appropriate post, based on id
    // will be diff on localhost vs live
    $lc_range = lcfirst($range);
    $ok_days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");

    if ($lc_range != "all" && in_array($lc_range, $ok_days)) {

      $result = get_field($lc_range, $post_id);

      return $result;
    }
  }

/////////////////////
// Display the content of our home page carousel
// Main site + branches
////////////////////

  function uml_getCarouselPosts($num_posts=9, $this_branch="main", $parent_news=1) {

    global $post;

    $top_news = array();
    $our_news = array();

  	echo "<!--$this_branch-->";

    // get posts from main blog, if we're not there already
    if ($this_branch != "main") {
      switch_to_blog(1);
    	echo "<!--$this_branch-->";
    }

    // Since the categories in WP can differ depending on install, we resort to this
    if ($_SERVER['HTTP_HOST'] != "localhost") {
      $main_branch_category_id = '5';
      $music_branch_category_id = '73';
      $archives_branch_category_id = '5';
    } else {
      $main_branch_category_id = '5';
      $music_branch_category_id = '73';
      $archives_branch_category_id = '5';
    }

    switch ($this_branch) {
      case "musiclib":
        // $categories = $main_branch_category_id . ',' . $music_branch_category_id;
        $categories = $music_branch_category_id;
        $weighted_news = $music_branch_category_id;
        break;
      case "archives":

        break;
      case "main":
        case "rsmaslib":
      default:
        $categories = '5';
        $weighted_news = '';
    }

    // Assemble the get_posts arguments you'd like to use
    $args = array('numberposts' => $num_posts, 'category' => $categories);
    $myposts = get_posts($args);

    // Loop through our myposts data
    foreach ($myposts as $post) {

      setup_postdata($post);

      // check for image; show default if there isn't one
      if (has_post_thumbnail()) {
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        $featured_image = $featured_image[0]; // because the previous sent result as array
      } else {
        $featured_image = get_template_directory_uri() . "/images/generic_news_item.jpg";
      }

      //////////////////////////
      // Everything with a "get_field" is using data from
      // The Advanced Custom Field called SuperPost
      //////////////////////////
      // If this field is set, we link the image directly somewhere other than the post
      if (get_field("link_image_to")) {
        $linkie = get_field("link_image_to");
      } else {
        $linkie = get_permalink();
      }

      // Now we start assembling our HTML
      $item = "<div class=\"mini_feature\"><a href=\"" . $linkie . "\"><img src=\"" . $featured_image . "\" class=\"staff_picture\" alt=\"Image for News Item\" width=\"75\" height=\"75\" /></a>
              <h3><a href=\"" . $linkie . "\">";

      // Grab short form of title if it exists
      if (get_field("front_page_title")) {
        $item .= get_field("front_page_title");
      } else {
        $item .= get_the_title();
      }
      $item .= "</a></h3>";

      // See if a front page blurb is set via SuperPost
      if (get_field("front_page_blurb")) {
        $item .= get_field("front_page_blurb");
      } else {
        $item .= "<a href=\"" . get_permalink() . "\">Read full news story . . .</a>";
      }
      $item .= "</div>";

      // Let's divide these into local and main site news
      $these_cats = wp_get_post_categories($post->ID);

      if (in_array($weighted_news, $these_cats)) {
        $top_news[] = $item;
      } else {
        $our_news[] = $item;
      }
    } // ending foreach loop!

    wp_reset_postdata();

    if ($our_news != "" || $top_news != "") {

      // Reverse both our arrays so newest items near end
      // this is so our carousel will end with these items
      // rather than begin with them
      //$our_news = array_reverse($our_news);
      //$top_news = array_reverse($top_news);

      $total_news = array_merge($our_news, $top_news);

      // loop through our array of news items
      foreach ($total_news as $item) {
        print $item;
      }
    }

    // Only restore our current blog if we've switched
    if (THIS_BRANCH != "main") {
      restore_current_blog();
    }
  }

  /**
   * web_mail_form() - this function helps build web forms. The elements array
   * specify the HTML elements in the form and the options of those elements.
   * Example Element: [ "type" => "input", "label" => "First Name", "name" =>
   * 	"first_name", "value" => "David" ]
   * will result in this HTML:
   * <tr><td valign="top">First Name </td><td valign="top"><input name="first_name"
   * 	size="35" /></td></tr>
   *
   * @param string $lstrToEmails
   * @param array $lobjElements
   * @param string $lstrAction
   * @param string $lstrMethod
   * @param array $lobjErrors
   * @return string
   */
  function web_mail_form( $lobjElements, $lstrAction = "#", $lstrMethod = "POST", $lobjErrors = array() )
  {
  	$lstrHTMLForm = "";
  	$lstrPrependHTMLForm = "";

  	//add all errors to html
  	foreach( $lobjErrors as $lstrError )
  	{
  		$lstrHTMLForm .= "<p class=\"form_error\">\n";
  		$lstrHTMLForm .= "<img src=\"" . get_theme_root_uri() . "/umiami/images/xmark.png\" />\n";
  		$lstrHTMLForm .= " $lstrError</p>\n";
  	}

  	$lstrHTMLForm .= "<form action=\"$lstrAction\" method=\"$lstrMethod\">\n";

  	//determines even or odd input row and input number
  	$lintInputNumber = 1;

  	foreach( $lobjElements as $lobjElement )
  	{
  		switch( strtolower( $lobjElement['type'] ) )
  		{
  			case "title":
  				$lstrValue = isset($lobjElement['value']) ? $lobjElement['value'] : '';
  				$lstrHTMLForm .= "<p><strong>$lstrValue</strong></p>\n";
  				break;
  			case "start_table":
  				$lstrHTMLForm .= "<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\" width=\"98%\" class=\"item_listing\">\n";
  				break;
  			case "end_table":
			  	$lstrHTMLForm .= "</table>";
  			  	break;
  			case "input":
  				$lstrLabel = isset($lobjElement['label']) ? htmlentities( $lobjElement['label'] ) : 'Input Box';
  				$lstrLabel = str_replace( "&lt;strong&gt;", "<strong>", $lstrLabel);
  				$lstrLabel = str_replace( "&lt;/strong&gt;", "</strong>", $lstrLabel);
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'input' . $lintInputNumber;
  				$lstrSize = isset($lobjElement['size']) ? $lobjElement['size'] : '35';
  				$lstrValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_STRING) : '';

  				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
  				$lstrHTMLForm .= "<td valign=\"top\">$lstrLabel</td>\n";
  				$lstrHTMLForm .= "<td valign=\"top\"><input name=\"$lstrName\" size=\"$lstrSize\" value=\"$lstrValue\"/></td>\n";
  				$lstrHTMLForm .= "</tr>\n";

  				$lintInputNumber++;
  				break;
  			case "hidden_input":
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'input' . $lintInputNumber;
  				$lstrValue = isset($lobjElement['value']) ? $lobjElement['value'] : '';
  				$lstrValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_URL ) : $lstrValue;

  				$lstrHTMLForm .= "<input type=\"hidden\" name=\"$lstrName\" value=\"$lstrValue\"/>\n";

  				$lintInputNumber++;
  				break;
  			case "select":
  				$lstrLabel = isset($lobjElement['label']) ? htmlentities( $lobjElement['label'] ) : 'Select Box';
  				$lstrLabel = str_replace( "&lt;strong&gt;", "<strong>", $lstrLabel);
  				$lstrLabel = str_replace( "&lt;/strong&gt;", "</strong>", $lstrLabel);
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'select' . $lintInputNumber;
  				$lobjOptions = isset($lobjElement['options']) ? $lobjElement['options'] : array();
  				$lstrpValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_STRING) : '';

  				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
  				$lstrHTMLForm .= "<td valign=\"top\">$lstrLabel</td>\n";
  				$lstrHTMLForm .= "<td valign=\"top\">\n<select name=\"$lstrName\">\n";

  				foreach($lobjOptions as $lstrKey => $lstrValue)
  				{
  					$lstrHTMLForm .=  $lstrpValue == $lstrValue ? "<option value=\"$lstrValue\" selected>$lstrKey</option>"
  						: "<option value=\"$lstrValue\">$lstrKey</option>";
  				}

  				$lstrHTMLForm .= "</select>\n</td>\n</tr>\n";

  				$lintInputNumber++;
  				break;
  			case "textarea":
  				$lstrLabel = isset($lobjElement['label']) ? htmlentities( $lobjElement['label'] ) : 'Textarea';
  				$lstrLabel = str_replace( "&lt;strong&gt;", "<strong>", $lstrLabel);
  				$lstrLabel = str_replace( "&lt;/strong&gt;", "</strong>", $lstrLabel);
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'textarea' . $lintInputNumber;
  				$lstrRow = isset($lobjElement['rows']) ? $lobjElement['rows'] : '2';
  				$lstrCols = isset($lobjElement['cols']) ? $lobjElement['cols'] : '55';
  				$lstrValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_STRING) : '';

  				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
  				$lstrHTMLForm .= "<td valign=\"top\" colspan=\"2\">$lstrLabel\n<br />\n";
  				$lstrHTMLForm .= "<textarea name=\"$lstrName\" rows=\"$lstrRow\" cols=\"$lstrCols\">$lstrValue</textarea></td>\n";
  				$lstrHTMLForm .= "</tr>\n";

  				$lintInputNumber++;
  				break;
  			case "radio_list":
  				$lstrLabel = isset($lobjElement['label']) ? htmlentities( $lobjElement['label'] ) : 'Radio Buttons';
  				$lstrLabel = str_replace( "&lt;strong&gt;", "<strong>", $lstrLabel);
  				$lstrLabel = str_replace( "&lt;/strong&gt;", "</strong>", $lstrLabel);
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'radio' . $lintInputNumber;
  				$lobjNotes = isset($lobjElement['notes']) ? $lobjElement['notes'] : array();
  				$lobjRadioList = isset($lobjElement['list']) ? $lobjElement['list'] : array();
  				$lstrpValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_STRING) : '';

  				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
  				$lstrHTMLForm .= "<td valign=\"top\">$lstrLabel</td>\n";
  				$lstrHTMLForm .= "<td valign=\"top\">\n";

  				foreach($lobjRadioList as $lstrKey => $lstrValue)
  				{
  					$lstrHTMLForm .=  $lstrpValue == $lstrValue ?
  						"<input type=\"radio\" value=\"$lstrValue\" name=\"$lstrName\" checked>$lstrKey<br />\n"
  						: "<input type=\"radio\" value=\"$lstrValue\" name=\"$lstrName\">$lstrKey<br />\n";

  					$lstrHTMLForm .= isset($lobjNotes[$lstrKey]) && $lobjNotes[$lstrKey] != '' ? "<span style=\"display: inline-block; margin-left: 30px;\">{$lobjNotes[$lstrKey]}</span><br />" : '';
  				}

  				$lstrHTMLForm .= "</td>\n</tr>\n";

  				$lintInputNumber++;
  				break;
			case 'date':
				$lstrLabel = isset($lobjElement['label']) ? htmlentities( $lobjElement['label'] ) : 'Input Box';
				$lstrLabel = str_replace( "&lt;strong&gt;", "<strong>", $lstrLabel);
				$lstrLabel = str_replace( "&lt;/strong&gt;", "</strong>", $lstrLabel);
				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'input' . $lintInputNumber;
				$lstrSize = isset($lobjElement['size']) ? $lobjElement['size'] : '35';
				$lstrValue = isset($_POST[$lstrName]) ? filter_var( $_POST[$lstrName], FILTER_SANITIZE_STRING) : '';

				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
				$lstrHTMLForm .= "<td valign=\"top\">$lstrLabel</td>\n";
				$lstrHTMLForm .= "<td valign=\"top\"><input id=\"$lstrName\" name=\"$lstrName\" size=\"$lstrSize\" value=\"$lstrValue\"/>\n";

				if( isset( $_SERVER['HTTPS'] ) )
				{
					$lstrHTMLForm .= "<a href=\"javascript:NewCssCal('sep_date')\"><img src=\"https://library.miami.edu/images/cal.gif\" width=\"16\" height=\"16\"></a>&nbsp;<span style=\"font-size:10px;\">Click to select date</span>\n";
				}else
				{
					$lstrHTMLForm .= "<a href=\"javascript:NewCssCal('sep_date')\"><img src=\"http://www.library.miami.edu/images/cal.gif\" width=\"16\" height=\"16\"></a>&nbsp;<span style=\"font-size:10px;\">Click to select date</span>\n";
				}

				$lstrHTMLForm .= "</td>\n";
				$lstrHTMLForm .= "</tr>\n";

				$lstrPrependHTMLForm .= "<script type=\"text/javascript\" src=\"" . get_theme_root_uri() . "/umiami/js/datetimepicker_css.js\"></script>\n";

				$lintInputNumber++;
				break;
  			case 'math_test':
  				$lintFirst = rand(1,10);
  				$lintSecond = rand(1,10);
  				$lintAnswer = $lintFirst + $lintSecond;
  				$lstrSecretAnswer = md5('math') . $lintAnswer . md5('answer');

  				$lstrHTMLForm .= $lintInputNumber % 2 == 1 ? "<tr>\n" : "<tr class=\"evenrow\">\n";
  				$lstrHTMLForm .= "<td valign=\"top\">$lintFirst plus $lintSecond = </td>\n";
  				$lstrHTMLForm .= "<td valign=\"top\">\n<input name=\"math_try\" size=\"2\" />\n
									<input name=\"math_answer\" type=\"hidden\" value=\"$lstrSecretAnswer\"/>\n</td>\n";
  				$lstrHTMLForm .= "</tr>\n";

  				$lintInputNumber++;
  				break;

  			case "submit_button":
  				$lstrName = isset($lobjElement['name']) ? $lobjElement['name'] : 'submit' . $lintInputNumber;
  				$lstrValue = isset($lobjElement['value']) ? $lobjElement['value'] : '';

  				$lstrHTMLForm .= "<p>\n<input type=\"submit\" name=\"$lstrName\" value=\"$lstrValue\" />\n";
  				$lstrHTMLForm .= "&nbsp;<input type=\"reset\" value=\"Reset\">\n</p>\n";
  				break;
  		}
  	}

  	$lstrHTMLForm .= "</form>\n";

  	return $lstrPrependHTMLForm . $lstrHTMLForm;
  }

  /**
   * web_mail_form_is_human() - this function makes sure the math test generated by the web_mail_form function
   * is correct
   *
   * @return boolean
   */
  function web_mail_form_is_human()
  {
  	$lintTry = isset($_POST['math_try'])	? intval( $_POST['math_try'] ) : NULL;
  	$lstrAnswer = isset($_POST['math_answer'])	? filter_var( $_POST['math_answer'], FILTER_SANITIZE_STRING ) : NULL;

  	if($lintTry != NULL && $lstrAnswer != NULL && $lstrAnswer == md5('math') . $lintTry . md5('answer'))
  	{
  		return TRUE;
  	}else
  	{
  		return FALSE;
  	}
  }