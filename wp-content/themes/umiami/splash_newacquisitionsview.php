<?php
/**
 * Template Name: Splash_NewAcquisitionsView
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

error_reporting(0);

function getSub(array $s, $sub, $m, $y)
{
	// 10 = New Acquisitions category, adjust accordingly based on array
	$sql = "SELECT * FROM acq_monthly WHERE acq_call REGEXP '" . $s[$sub] . "'" . ' AND acq_category = ' . "'" . 14 . "'" . ' AND acq_year = ' . "'" 
	. $y . "'" . ' AND acq_month = ' . "'" . $m . "' ORDER BY acq_author";
	
	return $sql;
}

/* 
 * get_week_range accepts numeric $month, $day, and $year values.   
 * It will find the first sunday and the last saturday of the week for the 
 * given day, and return them as YYYY-MM-DD
 * 
 * @param month: numeric value of the month (01 - 12) 
 * @param day  : numeric value of the day (01 - 31) 
 * @param year : four-digit value of the year (2008) 
 * @return     : array('first' => sunday of week, 'last' => saturday of week); 
 */ 
function get_week_range($day='', $month='', $year='') 
{ 
// default empties to current values 
    if (empty($day)) $day = date('d'); 
    if (empty($month)) $month = date('m'); 
    if (empty($year)) $year = date('Y'); 
    
 
    $weekday = date('w', mktime(0,0,0,$month, $day, $year)); 
    $sunday  = $day - $weekday; 
	$sunday = $sunday - 7;
    $start_week = date('Y-m-d', mktime(0,0,0,$month, $sunday, $year)); 
    $start_day = date('d', mktime(0,0,0,$month, $sunday, $year)); 
    $end_week   = date('Y-m-d', mktime(0,0,0,$month, $sunday+6, $year)); 
    $end_day   = date('d', mktime(0,0,0,$month, $sunday+6, $year)); 


    if (!empty($start_week) && !empty($end_week)) 
    { 
        return array('first'=>$start_week, 'last'=>$end_week, 'sday'=>$start_day, 'eday'=>$end_day); 
    } 
    // otherwise there was an error :'( 
    return false; 
} 

$month = sprintf("%02s", (date('m') -1));
$year = date('Y');
	
$category = array(	'Architecture Library',
					'Contemporary Fiction',
					'Cuban Heritage Collection',
					'Government Documents',
					'Graphic Novels',
					'Juveline Collection',
					'Marine Library',
					'Reference Collection',
					'Video & DVD Collection',
					'Music Libray - Books, Dissertations, Theses',
					'Music Library - Jazz CD\'s',
					'Music Library - Scores',
					'Music Library - Sound Recordings',
					'Special Collections',
					'New Acquisitions');

$subcategory = array(	'Africana'				 			=> '^E29\.N3|E184\.[567]|E185\.[1-9]',
						'Anthropology' 						=> '^G[NRT]', 
						'Architecture' 						=> '^NA', 
						'Art & Art History'					=> '^N\d|N[B-E|K|X]', 
						'Biology'							=> '^Q[HKLMPR]', 
						'Business'							=> '^H[EFGJ]',
						'Chemistry'							=> '^QD',
						'Classics'							=> '^DE|DF1|DF2|DT5[6789]\.|DT6[123456789]\.|DT73|DT[789][456789]\.|DT1[12345][12345]\.|DG[123]|PA[12346]',
						'Communication'						=> '^P8[7-9]\D|P9\d[\D\s]|PN199\d\D|PN4[6-8]\d\d\D|PN4[01]\d\d\D|PN5\d\d\d\D|TR',
						'Computer Science'					=> '^QA76\D',
						'Economics'							=> '^H[BCD]',
						'Education'							=> '^L',
						'Engineering'						=> '^T[ACDEFGHJKLNPS]',
						'English Literature'				=> '^PN4[3-5]\d\d\D|P[ERSZ]|P[123][0127][1-9]\D|PN841|PN[1-7]\d\d\D|PN1[013]\d\d\D|PN6[01]\d\d\D',
						'Environmental Science'				=> '^GE|GF|HC79\D|KF3775|QH[12]\d\d\D|QH54[0-9]\D|QK9[0-8]\d\D|S589\D7|S9[0-7][0-2]|SD4[12][1-8]|TD',
						'Foreign Languages & Literature'	=> '^PN8[05]\d\D|P[CDQT]',
						'Geography & Regional Studies'		=> '^G\d|G[AB]|GF|geograph|geo',
						'Geology'							=> '^QE',
						'Health Science'					=> '^R|QP\d|QR|QM',
						'History'							=> '^\d|C[BCEJNRST]|CD\d|D|E|F|U|V[ABCDEFGH]',
						'International Studies'				=> '^([J][A|C|F|K-Z])|D8[3-5][0-9]|D10\d\d\D|D[ST][1-9]\d\d\D|KZ|E183\D[7-9]|E804\D|J[1-9]\d\d\D|D[DPQ]2\d\d\D|DG5[78]\d\D|# = DK2[6-9]\d\D|DR|DS[4-9]\d\D|DS1[12]\d\D|DS6[1-6]\D|F114\d\D|F[1-3]\d\d\d\D',
						'Judaic Studies'					=> '^BM|S119|DS1[12345]1',
						'Latin American Studies'			=> '^F1[2456789][013456789][0123456789]\.|F2[012345678][013456789][0123456789]\.|F3[0234567][013456789][0123456789]\.|JL1[123456789][123456789][123456789]\.|LE[789]\.|LE1[123]\.|LE2[34567][123456789]\.|KG3.\|KH|HN110\.5|HN120\.|HN14[0123456789]\.|HN15[037]\.|HN16[03]\.|HN17[0235]\.|HN18[34]\.|HN190\.|HN203\.|HN210\.|HN21[789]\.|HN220\.|HN253\.|HN26[013]\.|HN270\.|HN28[23]\.|HN30[01234567]\.|HN31[037]\.|HN320\.|HN33[0123]\.|HN34[01]\.|HN350\.|HN37[01]\.',
						'Mathematics'						=> '^QA',
						'Nursing'							=> '^RT|RA',
						'Philosophy'						=> '^B\d|B[CDHJ]',
						'Physics & Astronomy'				=> '^Q[BC]',
						'Political Science'					=> '^J\d|J[ACFKLNQV]|political|politics',
                        'Psychology'						=> '^BF|RC|[Pp]sych|[Mm]ental|[Bb]ehavioral|[Nn]euro',
						'Religious Studies'					=> '^B[LMPQRSTVX]|religion|religious|spiritual|[Cc]hurch|Protestant|Reformation',
						'Sociology'							=> '^H[MNQSTVX]|H\d|RA|[Ss]ociolog',
						'Statistics'						=> '^HA',
						'Theatre Arts'						=> '^[pP]lays|[dD]rama|[Tt]heatre|PN3[012]\d\d|PN2\d\d\d|PN1[568]\d\d\DPN6120\.\D|PN611[0-9]\.[5-9]\D|GT1741|GV1[5-7]\d\d\D/',
						'Womens Studies'					=> '^[wW]om.n.|[fF]emale|[fF]eminist |[lL]esbian.|[gG]ender');

		$month = array( ' ',
						'January',
						'February',
						'March',
						'April',
						'May',
						'June',
						'July',
						'August',
						'September',
						'October',
						'November',
						'December');

$data_flag = 0;

$subName = array_keys($subcategory);

$acq = $_GET['acq'];
$view = $_GET['view'];

if(isset($acq) && strlen($acq) < 8 || isset($acq) && strlen($acq) > 16 )
{
    header('Location: list.php');
}

// weekly - specified range
if(isset($acq) && strlen($acq) == 16)
{
	// |    start     |    end 	    |
	//  year month day year month day
	//  2011 05	  01   2011 05	  07
	
	$data_flag = 2;
	
	$y 	 = substr($acq, 0, 4);
	$m 	 = substr($acq, 4, 2);
	$d	 = substr($acq, 6, 2);
	$yr  = substr($acq, 8, 4);
	$mth = substr($acq, 10, 2);
	$day = substr($acq, 12, 2);
	
	$title = Weekly;
		
//	echo $data_flag;
}

if(!isset($acq) && isset($view))
{
   $title = Weekly; 
}

/************************** CATEGORY *************************/

// monthly - category ONLY
if(isset($acq) && strlen($acq) == 8)
{
	// cat year month
	// 00  2011 05
	
	$data_flag = 1;
	
	$cat = substr($acq, 0, 2);
	$y 	 = substr($acq, 2, 4);
	$m 	 = substr($acq, 6, 2);
	
	$title = $category[(int)$cat];
	
//	echo $cat . "\n" . $y . "\n" . $m . '<br />';
//		
//	echo $data_flag;
}

/************************** SUBCATEGORY *************************/

// monthly - with subcategory
if(isset($acq) && strlen($acq) == 10)
{
	// cat sub year month
	// 00  01  2011 05
	
	$data_flag = 3;
	
	$cat = substr($acq, 0, 2);
	$sub = substr($acq, 2, 2);
	$y 	 = substr($acq, 4, 4);
	$m 	 = substr($acq, 8, 2);
	
	$title = $category[(int)$cat] . ' - ' . $subName[(int)$sub];
	
//	echo $cat . "\n" . $sub . "\n" . $y . "\n" . $m . '<br />';
//		
//	echo $data_flag;
}

get_header(); ?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
  </div>

  <div class="grid_8">
    <div class="breather">

		<div id="primary">
			<div id="content" role="main">
<?php 
		if(!isset($acq) && !isset($view))
		{
			header('Location: list.php'); 
		}
		?>

		
		<?php
			
			$dbh = new PDO('mysql:host=127.0.0.1;port=3310;dbname=libacq', 'webuser01', 'w3bpas2');

			if (!isset($acq) && isset($view) )
			{
			
    			// Weekly
    			
    		    // 7 day range
    		    // get first date of current week
    		    // get last date of current week  		    
			    $current_week = get_week_range(date('d'), date('m'), date('Y'));
			    
				// order by author
				if((int)$view == 0)
			    {
					$sql = "SELECT * FROM acq_weekly WHERE acq_start >= '" . str_replace('-', '', $current_week['first']) . "' AND acq_end <= '" . str_replace('-', '', $current_week['last']) . "' ORDER BY acq_author ASC";
				}
				
				// order by title
				if((int)$view == 1)
			    {
					$sql = "SELECT * FROM acq_weekly WHERE acq_start >= '" . str_replace('-', '', $current_week['first']) . "' AND acq_end <= '" . str_replace('-', '', $current_week['last']) . "' ORDER BY acq_title ASC";
				}
				
				// order by call #
				if((int)$view == 2)
			    {
					$sql = "SELECT * FROM acq_weekly WHERE acq_start >= '" . str_replace('-', '', $current_week['first']) . "' AND acq_end <= '" . str_replace('-', '', $current_week['last']) . "' ORDER BY acq_call ASC";
				}
				
				
			    // select * from acq_weekly where acq_end is <= lastDayOfWeek AND acq_start is >= firstDayOfWeek
				//$sql = "SELECT * FROM acq_weekly WHERE acq_start >= '" . str_replace('-', '', $current_week['first']) . "' AND acq_end <= '" . str_replace('-', '', $current_week['last']) . "'";
			    
			    $sth = $dbh->prepare($sql);
			     
			    $sth->execute();
			     
			    $wdata = $sth->fetchAll();			    
			    
			    // weekly - author
			    if((int)$view == 0)
			    {
			    
			    	echo '<h2>New Acquisitions to the University of Miami Libraries arranged by AUTHOR</h2>';
			    
			    	echo '<p><font face="verdana,arial,helvetica,sans serif" size="2">This list contains books, music scores, sound recording, government documents, videos and other resources added 
			    	to the Library\'s collection <b><font color="red">';
			    	echo date('M') . ' ' .  $current_week['sday'] . '-' . $current_week['eday'] . ', ' . date('Y');
			    	echo '</font></b>. Search the catalog Catalog (<strong><a href="http://catalog.library.miami.edu">http://catalog.library.miami.edu</a></strong>) 
			    	for additional books and other materials on this subject. \'<b>Full record</b>\' links to the complete catalog description and location 
			    	information. <br><br />Receive monthly updates of this list automatically.  Click the RSS icon and copy the url to your RSS reader:';
			    	echo '<a "application/rss+xml" href="rss.php?view=0"><img border="0" src="_src/img/rssfeed.png"></a>.</font></p>';
			    
			    
			    
			        foreach ($wdata as $row)
    			    {    
    			        if(!empty($row['acq_oclc']))
    			        {
                           	echo "\n\t<p>\n";
    				   		echo "\t\t<strong>" . $row['acq_author'] . "</strong><br />\n";
    				   		echo "\t\t" . $row['acq_title'] . "<br />\n";
    				   		echo "\t\t" . $row['acq_imprint'] . "<br />\n";
    				   		echo "\t\t" . $row['acq_call'] . "<br />\n";
    						echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
    						echo "\t</p>\n";			             
    			        }
    			    }
			    }
			    
			    // weekly - title
			    if((int)$view == 1)
			    {
			    
			    	echo '<h2>New Acquisitions to the University of Miami Libraries arranged by TITLE</h2>';
			    
			    	echo '<p><font face="verdana,arial,helvetica,sans serif" size="2">This list contains books, music scores, sound recording, government documents, videos and other resources added 
			    	to the Library\'s collection <b><font color="red">';
			    	echo date('M') . ' ' .  $current_week['sday'] . '-' . $current_week['eday'] . ', ' . date('Y');
			    	echo '</font></b>. Search the catalog Catalog (<strong><a href="http://catalog.library.miami.edu">http://catalog.library.miami.edu</a></strong>) 
			    	for additional books and other materials on this subject. \'<b>Full record</b>\' links to the complete catalog description and location 
			    	information. <br><br />Receive monthly updates of this list automatically.  Click the RSS icon and copy the url to your RSS reader:';
			    	echo '<a "application/rss+xml" href="rss.php?view=0"><img border="0" src="_src/img/rssfeed.png"></a>.</font></p>';
			    
			    
			    
			        foreach ($wdata as $row)
    			    {    
    			        if(!empty($row['acq_oclc']))
    			        {
                           	echo "\n\t<p>\n";
    				   		echo "\t\t<strong>" . $row['acq_title'] . "</strong><br />\n";
    				   		echo "\t\t" . $row['acq_imprint'] . "<br />\n";
    				   		echo "\t\t" . $row['acq_call'] . "<br />\n";
    						echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
    						echo "\t</p>\n";			             
    			        }
    			    }
			    }
			    
                // weekly - call #
			    if((int)$view == 2)
			    {
			    
			    	echo '<h2>New Acquisitions to the University of Miami Libraries arranged by CALL NUMBER</h2>';
			    
			    	echo '<p><font face="verdana,arial,helvetica,sans serif" size="2">This list contains books, music scores, sound recording, government documents, videos and other resources added 
			    	to the Library\'s collection <b><font color="red">';
			    	echo date('M') . ' ' .  $current_week['sday'] . '-' . $current_week['eday'] . ', ' . date('Y');
			    	echo '</font></b>. Search the catalog Catalog (<strong><a href="http://catalog.library.miami.edu">http://catalog.library.miami.edu</a></strong>) 
			    	for additional books and other materials on this subject. \'<b>Full record</b>\' links to the complete catalog description and location 
			    	information. <br><br />Receive monthly updates of this list automatically.  Click the RSS icon and copy the url to your RSS reader:';
			    	echo '<a "application/rss+xml" href="rss.php?view=0"><img border="0" src="_src/img/rssfeed.png"></a>.</font></p>';
			    
			        foreach ($wdata as $row)
    			    {    
    			        if(!empty($row['acq_oclc']))
    			        {
                           	echo "\n\t<p>\n";
                           	echo "\t\t<strong>" . $row['acq_call'] . "</strong><br />\n";
                           	echo "\t\t" . $row['acq_title'] . "<br />\n";
    				   		echo "\t\t" . $row['acq_imprint'] . "<br />\n";
    						echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
    						echo "\t</p>\n";			             
    			        }
    			    }
			    }

    		}
			elseif((int)$cat != 14)
			{
			    // Everything but New Acquisitions
			    
				$sql = "SELECT * FROM acq_monthly WHERE acq_category = '" . $cat ."'" . ' AND acq_year = ' . "'" 
				. $y . "'" . ' AND acq_month = ' . "'" . $m . "' ORDER BY acq_title ASC";
				
				
				
                // prepared query -> mysql_real_escape_string()
				$sth = $dbh->prepare($sql);
				
                $sth->execute();
                
                $rdata = $sth->fetchAll();
                
                if ((int)$cat < 10)
                {
                	$ct = '0' . (int)$cat;
                }
                
                echo '<h2>' . $title . '</h2>';
				
		        echo '<p>This list contains books added to the Library\'s collection during the previous month. Search the catalog Catalog (<strong><a href="http://catalog.library.miami.edu">http://catalog.library.miami.edu</a></strong>) for 
                	 additional books and other materials on this subject. \'Full record\' links to the complete catalog description and location information.<br />';

				echo '<br />Receive monthly updates of this list automatically. Click the RSS icon and copy the URL to your RSS reader: <a type="application/rss+xml" 
					 href="feed://collage.library.miami.edu/db/libacq/rss.php?acq=' . $ct . (int)$year . (int)$m . '&view=0"><img border="0" src="_src/img/rssfeed.png"></a>. 
					 more information</p>';
				
				if (!empty($rdata))
				{
					foreach ($rdata as $row) 
					{   
						if(!empty($row['acq_oclc']) && (int)$view == 0)
						{
							echo "\n\t<p>\n";
							echo "\t\t<strong>" . $row['acq_title'] . "</strong><br />\n";
							echo "\t\t" . $row['acq_imprint'] . "<br />\n";
							echo "\t\t" . $row['acq_call'] . "<br />\n";
							echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
							echo "\t</p>\n";
						}
						elseif (!empty($row['acq_oclc']) && (int)$view == 1)
						{
							echo "\n\t<p>\n";
							echo "\t\t<strong>" . $row['acq_author'] . "</strong><br />\n";
							echo "\t\t" . $row['acq_title'] . "<br />\n";
							echo "\t\t" . $row['acq_imprint'] . "<br />\n";
							echo "\t\t" . $row['acq_call'] . "<br />\n";
							echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
							echo "\t</p>\n";
						}
						elseif (!empty($row['acq_oclc']) && (int)$view == 2) 
						{
							echo "\n\t<p>\n";
							echo "\t\t<strong>" . $row['acq_title'] . "</strong><br />\n";
							echo "\t\t" . $row['acq_imprint'] . "<br />\n";
							echo "\t\t" . $row['acq_call'] . "<br />\n";
							echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
							echo "\t</p>\n";
						}
						elseif (empty($row['acq_oclc']) || $row['acq_oclc'] == 0)
						{
							echo "\n\t<p>\n";
							echo "\t\t<strong>" . $row['acq_title'] . "</strong><br />\n";
							echo "\t\t" . $row['acq_imprint'] . "<br />\n";
							echo "\t\t" . $row['acq_call'] . "<br />\n";
							echo "\t\t<a href=\"http://catalog.library.miami.edu/search~S11/?searchtype=l&searcharg=". $row['acq_call'] . "\">Full Record</a><br />\n";
							echo "\t</p>\n";
						}
					}
				}
				else
				{
					echo "\n\t<p>\n";
					echo "<h1 style=\"text-align: center;\">No records for $title</h1>";
					echo "\t</p>\n";
				}
				
			}
			elseif ((int)$cat == 14) 
			{
			    // New Acquisitions
			    
				switch ((int)$sub)
				{
					case 0:
						$sql = getSub($subcategory, 'Africana', $m, $y);
						break;
					case 1:
						$sql = getSub($subcategory, 'Anthropology', $m, $y);
						break;
					case 2:
						$sql = getSub($subcategory, 'Architecture', $m, $y);
						break;
					case 3:
						$sql = getSub($subcategory, 'Art & Art History', $m, $y);
						break;
					case 4:
						$sql = getSub($subcategory, 'Biology', $m, $y);
						break;
					case 5:
						$sql = getSub($subcategory, 'Business', $m, $y);
						break;
					case 6:
						$sql = getSub($subcategory, 'Chemistry', $m, $y);
						break;
					case 7:
						$sql = getSub($subcategory, 'Classics', $m, $y);
						break;
					case 8:
						$sql = getSub($subcategory, 'Communication', $m, $y);
						break;
					case 9:
						$sql = getSub($subcategory, 'Computer Science', $m, $y);
						break;
					case 10:
						$sql = getSub($subcategory, 'Economics', $m, $y);
						break;
					case 11:
						$sql = getSub($subcategory, 'Education', $m, $y);
						break;
					case 12:
						$sql = getSub($subcategory, 'Engineering', $m, $y);
						break;
					case 13:
						$sql = getSub($subcategory, 'English Literature', $m, $y);
						break;
					case 14:
						$sql = getSub($subcategory, 'Environmental Science', $m, $y);
						break;
					case 15:
						$sql = getSub($subcategory, 'Foreign Languages & Literature', $m, $y);
						break;
					case 16:
						$sql = getSub($subcategory, 'Geography & Regional Studies', $m, $y);
						break;
					case 17:
						$sql = getSub($subcategory, 'Geology', $m, $y);
						break;
					case 18:
						$sql = getSub($subcategory, 'Health Science', $m, $y);
						break;
					case 19:
						$sql = getSub($subcategory, 'History', $m, $y);
						break;
					case 20:
						$sql = getSub($subcategory, 'International Studies', $m, $y);
						break;
					case 21:
						$sql = getSub($subcategory, 'Judaic Studies', $m, $y);
						break;
					case 22:
						$sql = getSub($subcategory, 'Latin American Studies', $m, $y);
						break;
					case 23:
						$sql = getSub($subcategory, 'Mathematics', $m, $y);
						break;
					case 24:
						$sql = getSub($subcategory, 'Nursing', $m, $y);
						break;
					case 25:
						$sql = getSub($subcategory, 'Philosophy', $m, $y);
						break;
					case 26:
						$sql = getSub($subcategory, 'Physics & Astronomy', $m, $y);
						break;
					case 27:
						$sql = getSub($subcategory, 'Political Science', $m, $y);
						break;
					case 28:
						$sql = getSub($subcategory, 'Psychology', $m, $y);
						break;
					case 29:
						$sql = getSub($subcategory, 'Religious Studies', $m, $y);
						break;
					case 30:
						$sql = getSub($subcategory, 'Sociology', $m, $y);
						break;
					case 31:
						$sql = getSub($subcategory, 'Statistics', $m, $y);
						break;
					case 32:
						$sql = getSub($subcategory, 'Theatre Arts', $m, $y);
						break;
					case 33:
						$sql = getSub($subcategory, 'Womens Studies', $m, $y);
						break;						
				    }
				    
                // prepared query -> mysql_real_escape_string()
				$sth = $dbh->prepare($sql);
				
                $sth->execute();
                
                $rdata = $sth->fetchAll();
                
                echo '<h2>' . $title . '</h2>';
                
                echo '<p>This list contains books added to the Library\'s collection during the previous month. Search the catalog Catalog (<strong><a href="http://catalog.library.miami.edu">http://catalog.library.miami.edu</a></strong>) for 
                	 additional books and other materials on this subject. \'Full record\' links to the complete catalog description and location information.<br />';

				echo '<br />Receive monthly updates of this list automatically. Click the RSS icon and copy the URL to your RSS reader: <a type="application/rss+xml" 
					 href="feed://collage.library.miami.edu/db/libacq/rss.php?acq=' . (int)$cat . (int)$sub . (int)$year . (int)$m . '&view=0"><img border="0" src="_src/img/rssfeed.png"></a>. 
					 more information</p>';
				
				foreach ($rdata as $row) 
				{   
				   	if(!empty($row['acq_oclc']))
				   	{
				   		echo "\n\t<p>\n";
				   		echo "\t\t<strong>" . $row['acq_title'] . "</strong><br />\n";
				   		echo "\t\t" . $row['acq_imprint'] . "<br />\n";
				   		echo "\t\t" . $row['acq_call'] . "<br />\n";
						echo "\t\t<a href=\"http://catalog.library.miami.edu/search/o?SEARCH=". $row['acq_oclc'] . "\">Full Record</a><br />\n";
						echo "\t</p>\n";
				   	}       
				}
				
			}
		?>
			</div><!-- #content -->
		</div><!-- #primary -->
        
            </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
<?php print uml_getTips();
print uml_showStaff(get_field("contact"));  ?>
  </div>
</div><!-- .container_12 -->


<?php get_footer(); ?>
